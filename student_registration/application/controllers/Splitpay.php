<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

/**
 * Splitpay - Optimized payment-split engine (single source of truth).
 *
 * Replaces the duplicated/broken split logic that lived in:
 *   - Webhook::webhooksplit()     (had a fatal $this->update() + a debug die() + on_hold_until bug)
 *   - Razorpay::processPaymentSplits1()
 *
 * Guarantees:
 *   - Idempotent: one atomic claim per order, row-level idempotency for maker rows.
 *   - Every Razorpay transfer leg logs its transfer_id OR the raw error (nothing silently swallowed).
 *   - Never fatals / never die()s; the webhook always answers HTTP 200 so Razorpay stops retrying.
 *
 * Public entry points:
 *   - splitpay/webhook          : Razorpay webhook receiver (verify3 + pay2 flows).
 *   - splitpay/processEndpoint  : async target called by Razorpay::verify3() (POST order_id).
 *   - splitpay/dryRun/<order_id> : JSON preview of what would be paid. Makes NO API calls, writes NOTHING.
 *   - splitpay/retry/<order_id>  : force re-run for a stuck order (or just top-up unpaid maker rows).
 */
class Splitpay extends CI_Controller {

    // Fallback Razorpay REST credentials - used ONLY when the credentials
    // table row (title='razorpay_api') is missing. Production is seeded
    // automatically by ensure_credentials_row().
    const FALLBACK_KEY_ID     = 'rzp_live_kG7f8nF6sKGPhx';
    const FALLBACK_KEY_SECRET = '68nusLbguizulOSBn47VpfmS';

    // Webhook secret configured on the Razorpay dashboard (verified: signatures match).
    const WEBHOOK_SECRET = 'alkanairwebhook';

    // credentials-table row that stores the Razorpay API keys
    // (public = key id, private = key secret).
    const CRED_TITLE = 'razorpay_api';

    /**
     * Razorpay API keys, read from the `credentials` table.
     * Falls back to the built-in live values if the row is missing/empty so
     * production never breaks. Result is cached for the request.
     */
    public static function razorpay_keys()
    {
        static $keys = null;
        if ($keys !== null) {
            return $keys;
        }

        $key_id = self::FALLBACK_KEY_ID;
        $secret = self::FALLBACK_KEY_SECRET;
        $source = 'fallback';

        $CI =& get_instance();
        if (isset($CI->db)) {
            $row = $CI->db->get_where('credentials', ['title' => self::CRED_TITLE])->row();
            if (empty($row)) {
                self::ensure_credentials_row();
                $row = $CI->db->get_where('credentials', ['title' => self::CRED_TITLE])->row();
            }
            if (!empty($row) && !empty($row->public) && !empty($row->private)) {
                $key_id = $row->public;
                $secret = $row->private;
                $source = 'credentials_table';
            }
        }

        $keys = [
            'key_id'      => $key_id,
            'secret'      => $secret,
            'source'      => $source,
            'auth_header' => 'Authorization: Basic ' . base64_encode($key_id . ':' . $secret),
        ];
        return $keys;
    }

    /**
     * Idempotent seed: inserts the razorpay_api row only when absent.
     * (public / private are backticked - they are reserved-ish words.)
     */
    private static function ensure_credentials_row()
    {
        $CI =& get_instance();
        if (!isset($CI->db)) {
            return;
        }
        $sql = "INSERT INTO credentials (title, fordecription, `public`, `private`, sdkapijson, status)
                SELECT ?, ?, ?, ?, 1, 1 FROM DUAL
                WHERE NOT EXISTS (SELECT 1 FROM credentials WHERE title = ?)";
        $CI->db->query($sql, [
            self::CRED_TITLE,
            'Razorpay live key id + key secret - used by Splitpay engine',
            self::FALLBACK_KEY_ID,
            self::FALLBACK_KEY_SECRET,
            self::CRED_TITLE,
        ]);
    }


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ------------------------------------------------------------------ //
    // Logging helper
    // ------------------------------------------------------------------ //
    private function log_line($msg)
    {
        $line = date('Y-m-d H:i:s')." ".$msg.PHP_EOL;
        @file_put_contents(APPPATH.'logs/splitpay.log', $line, FILE_APPEND);
        log_message('info', '[Splitpay] '.$msg);
    }

    // ------------------------------------------------------------------ //
    // Admin push notification on a successful payment.
    // Token comes from credentials(title='admin_fcm_token', public=token).
    // NEVER throws - a push failure must not break the split.
    // ------------------------------------------------------------------ //
    private function notify_admin($order_id, $wc, $report)
    {
        try {
            $CI =& get_instance();
            $CI->load->library('fcm_push');

            $row = $CI->db->get_where('credentials', ['title' => 'admin_fcm_token'])->row();
            $token = (!empty($row) && !empty($row->public)) ? trim((string)$row->public) : '';
            if ($token === '') {
                $this->log_line("NOTIFY: no admin_fcm_token in credentials - skipping push for ".$order_id);
                return;
            }

            $amount   = isset($wc->total_amount) ? $wc->total_amount : '';
            $makers   = isset($report['makers']) ? (array)$report['makers'] : array();
            $paid = 0; $unpaid = 0;
            foreach ($makers as $m) {
                if (isset($m['action']) && $m['action'] === 'paid') { $paid++; }
                elseif (isset($m['action']) && in_array($m['action'], ['error_transfer', 'error_missing_maker'], true)) { $unpaid++; }
            }
            $body = "Order ".$order_id." | Rs ".$amount." | split done | makers paid ".$paid.", unpaid ".$unpaid;

            $res = $CI->fcm_push->send_to_token($token, "Payment received", $body, array(
                'order_id' => (string)$order_id,
                'amount'   => (string)$amount,
                'type'     => 'payment_success',
            ));
            $ok = !empty($res['success']);
            $this->log_line("NOTIFY ".$order_id.": ".($ok ? 'sent' : 'FAILED')." ".json_encode($res));
        } catch (\Throwable $e) {
            $this->log_line("NOTIFY ERROR ".$order_id.": ".$e->getMessage());
        }
    }

    // ------------------------------------------------------------------ //
    // Manual test push (for the monitor's "Test push" button).
    // URL: /splitpay/testPush
    // ------------------------------------------------------------------ //
    public function testPush()
    {
        $result = null;
        try {
            $CI =& get_instance();
            $CI->load->library('fcm_push');
            $row = $CI->db->get_where('credentials', ['title' => 'admin_fcm_token'])->row();
            $token = (!empty($row) && !empty($row->public)) ? trim((string)$row->public) : '';
            if ($token === '') {
                $result = ['success' => false, 'error' => 'no admin_fcm_token in credentials'];
            } else {
                $result = $CI->fcm_push->send_to_token($token, "Test push", "Splitpay admin notification test", array('type' => 'test'));
            }
            $this->log_line("TESTPUSH: ".json_encode($result));
        } catch (\Throwable $e) {
            $result = ['success' => false, 'error' => $e->getMessage()];
            $this->log_line("TESTPUSH ERROR: ".$e->getMessage());
        }
        return $this->json_out(['status' => 'ok', 'result' => $result]);
    }

    // ------------------------------------------------------------------ //
    // Ensure students.fcm_token exists (idempotent, cached per request).
    // ------------------------------------------------------------------ //
    private function ensure_students_fcm_column()
    {
        static $done = false;
        if ($done) { return; }
        $done = true;
        try {
            $db = $this->db->database;
            $has = $this->db->query(
                "SELECT COUNT(*) n FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME='students' AND COLUMN_NAME='fcm_token'",
                [$db]
            )->row()->n;
            if (!(int)$has) {
                $this->db->query("ALTER TABLE students ADD fcm_token VARCHAR(255) NULL");
                $this->log_line("CIN: added students.fcm_token column");
            }
        } catch (\Throwable $e) {
            $this->log_line("CIN: ensure fcm_token column failed: ".$e->getMessage());
        }
    }

    // ================================================================== //
    // CIN CREATION (pay3 flow) - idempotent, runs from the webhook.
    // Ported from Razorpay::verify3() so CINs are created reliably
    // server-side on payment success (not only in the browser redirect).
    // ================================================================== //
    public function create_cins($order_id)
    {
        $this->ensure_students_fcm_column();

        $wc = $this->db->get_where('webhook_calls', ['payment_id' => $order_id])->row();
        if (empty($wc)) {
            return ['status' => 'not_found', 'order_id' => $order_id];
        }
        $prid = $wc->prid;

        $student   = $this->db->get_where('students', ['PRID' => $prid])->row();
        $cart_data = $this->db->get_where('cart_prid', ['prid' => $prid])->result();
        if (empty($student) || empty($cart_data)) {
            $this->log_line("CIN ".$order_id.": no student or cart_prid for prid ".$prid." - cannot create CIN");
            return ['status' => 'no_data', 'order_id' => $order_id, 'prid' => $prid];
        }

        $school = $this->db->get_where('school_new', ['id' => $student->school_code])->row();
        if (empty($school)) {
            // verify3 looks up school_new by PK (students.school_code holds the
            // school_new id); fall back to a literal code lookup just in case.
            $school = $this->db->get_where('school_new', ['school_code' => $student->school_code])->row();
        }
        $period = $this->db->get_where('period', ['period_id' => $student->period_id])->row();
        if (empty($school) || empty($period)) {
            $this->log_line("CIN ".$order_id.": missing school/period for prid ".$prid." - cannot create CIN");
            return ['status' => 'no_data', 'order_id' => $order_id, 'prid' => $prid];
        }
        $pieces = explode("S", $student->school_code);
        $who = 0; $created = []; $skipped = 0;
        $fcm = isset($student->fcm_token) ? $student->fcm_token : '';

        foreach ($cart_data as $row) {
            $who = $this->create_one_cin($order_id, $prid, $row, $student, $school, $period, $pieces, $who, $fcm, $created);
        }

        $notified = false;
        if (!empty($created) && !empty($fcm)) {
            $notified = $this->notify_student($fcm, $order_id, $created);
        }
        $this->log_line("CIN ".$order_id.": created ".count($created).", notified ".($notified?'yes':'no'));
        return ['status' => 'ok', 'order_id' => $order_id, 'prid' => $prid, 'created' => $created, 'notified' => $notified];
    }

    private function notify_student($token, $order_id, $cins)
    {
        try {
            $CI =& get_instance();
            $CI->load->library('fcm_push');
            $list = implode(', ', array_slice($cins, 0, 5)) . (count($cins) > 5 ? '...' : '');
            $res = $CI->fcm_push->send_to_token($token, "Registration confirmed", "Your CIN: ".$list, [
                'order_id' => (string)$order_id, 'type' => 'cin_created',
            ]);
            $ok = !empty($res['success']);
            $this->log_line("CIN NOTIFY ".$order_id.": ".($ok?'sent':'FAILED')." ".json_encode($res));
            return $ok;
        } catch (\Throwable $e) {
            $this->log_line("CIN NOTIFY ERROR ".$order_id.": ".$e->getMessage());
            return false;
        }
    }

    // Create ONE CIN for a cart row (idempotent). Appends the CIN to $created.
    // Mirrors Razorpay::verify3() exactly (incl. its $who pre-increment quirk:
    // the first CIN ends in ...1, not ...0).
    private function create_one_cin($order_id, $prid, $row, $student, $school, $period, $pieces, $who, $fcm, &$created)
    {
        $product = $this->db->get_where('products', ['product_name' => $row->product])->row();
        if (empty($product)) { return $who; }

        $competition = $this->db->select('product_to_school.*, revenue_setting.*')
            ->from('product_to_school')
            ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
            ->where(['product_to_school.period_id' => $student->period_id,
                'product_to_school.school_id' => $student->school_id,
                'product_to_school.product_id' => $product->product_id])
            ->get()->row();
        // verify3 parity: competition row may be absent for this school (then
        // CINs are still created - registration is offline). Fall back to a
        // period+product row or a level-1 default so CINs are NEVER skipped.
        if (empty($competition)) {
            $this->log_line("CIN ".$order_id.": no product_to_school for school ".$student->school_id."/period ".$student->period_id."/product ".$product->product_id." - using level-1 default");
            $competition = $this->db->select('product_to_school.*, revenue_setting.*')
                ->from('product_to_school')
                ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
                ->where(['product_to_school.period_id' => $student->period_id,
                    'product_to_school.product_id' => $product->product_id])
                ->get()->row();
        }
        $level_id = (!empty($competition) && isset($competition->level_id) && $competition->level_id !== '') ? $competition->level_id : 1;
        $comp_date = (!empty($competition) && isset($competition->comp_date)) ? $competition->comp_date : null;

        $comp_scd = $this->db->get_where('competition_schedule', [
            'period_id' => $student->period_id,
            'product_id' => $product->product_id,
            'school_id' => $student->school_id,
            'state_id'  => $student->state,
            'competition_level_id' => $level_id,
        ])->row();
        if (empty($comp_scd)) {
            // verify3 would fatal here ($comp_scd->... on null); Splitpay must
            // NOT - registration is offline, so keep NULL schedule refs.
            $this->log_line("CIN ".$order_id.": no competition_schedule for school ".$student->school_id."/period ".$student->period_id."/product ".$product->product_id."/level ".$level_id." - NULL schedule ref");
            $comp_scd_id = null;
        } else {
            $comp_scd_id = $comp_scd->competition_schedule_id;
        }

        $period_id = $student->period_id;
        $who = $who + 1; // verify3 parity: pre-increment, first CIN ends in ...1
        $ini  = $product->in13;
        $p_ini = isset($product->initials) ? $product->initials : '';
        $code = empty($school->area_code) ? $pieces[0] : $school->area_code;
        $it   = explode("MREG", $prid);
        $it1  = isset($it[1]) ? $it[1] : $prid;
        $cin  = $period->initials . $p_ini . $ini . $code . $who . $it1;

        // per-CIN idempotency: skip if this CIN already exists
        if ($this->db->get_where('cin_list', ['cin' => $cin])->row()) { return $who; }

        $student_flag = (stripos((string)$row->name, (string)$student->first_name) !== false) ? 0 : 1;

        $this->db->insert('product_purchase', [
            'product_name' => $row->product, 'prid' => $prid, 'period_id' => $period_id,
            'amount' => $row->amount, 'payment_id' => $order_id, 'cin' => $cin,
            'who' => $student_flag, 'student_name' => $row->name,
        ]);
        $this->db->insert('cin_list', [
            'cin' => $cin, 'password' => $cin, 'period_id' => $period_id,
            'student_name' => $row->name,
            'franchise_id' => (!empty($competition) && isset($competition->franchise_id)) ? $competition->franchise_id : null,
            'franchise_code' => $code, 'address1' => $student->address1, 'address2' => $student->address2,
            'stud_email' => $student->email, 'stud_phone' => $student->mobile, 'class' => $row->class,
            'father_name' => $student->father_name, 'mother_name' => $student->mother_name,
            'school_id' => $student->school_id, 'state_id' => $student->state, 'status' => 'Active',
            'gender' => $student->gender, 'prid' => $prid,
            'competition_schedule_id' => $comp_scd_id, 'fcm_token' => $fcm,
        ]);
        if ($level_id > 1) {
            $this->db->insert('cin_result', [
                'cin' => $cin, 'period_id' => $period_id, 'product_name' => $row->product,
                'clevel' => $level_id, 'status' => 'Q',
                'competition_date' => $comp_date,
                'competition_schedule_id' => $comp_scd_id,
            ]);
        } else {
            $this->db->insert('cin_result', [
                'cin' => $cin, 'period_id' => $period_id, 'product_name' => $row->product,
                'clevel' => $level_id,
                'competition_schedule_id' => $comp_scd_id,
            ]);
        }
        $this->db->insert('new_cart', [
            'cin' => $cin, 'period_id' => $period_id, 'product_name' => $row->product,
            'clevel' => $level_id,
            'status' => 'Paid', 'comp_date' => $comp_date,
        ]);
        $comp_state = (!empty($competition) && isset($competition->state)) ? $competition->state : null;
        $comp = $this->db->get_where('competition_product_state', [
            'product_name' => $row->product, 'period_id' => $period_id,
            'clevel' => $level_id, 'state_id' => $comp_state,
        ])->row();
        if ($comp) {
            $this->db->insert('cin_uploade', ['cin' => $cin, 'comp_id' => $comp->id]);
        }
        $created[] = $cin;
        return $who;
    }




    // ------------------------------------------------------------------ //
    // HTTP JSON helpers
    // ------------------------------------------------------------------ //
    private function json_out($data, $http = 200)
    {
        http_response_code($http);
        header('Content-Type: application/json');
        echo json_encode($data);
        return $data;
    }

    // ================================================================== //
    // 1. WEBHOOK RECEIVER  ->  /splitpay/webhook
    // ================================================================== //
    public function webhook()
    {
        $rawData = file_get_contents("php://input");
        $this->log_line("WEBHOOK RAW: ".$rawData);

        $data = json_decode($rawData, true);
        if (!is_array($data)) {
            $this->log_line("WEBHOOK: body was not valid JSON - ignoring.");
            return $this->json_out(['status' => 'ignored', 'reason' => 'invalid_json']);
        }

        // --- signature verification (several header fallbacks for cPanel/GoDaddy) ---
        $signature = '';
        $headers = function_exists('getallheaders') ? getallheaders() : array();
        foreach (['X-Razorpay-Signature', 'x-razorpay-signature'] as $h) {
            if (!empty($headers[$h])) { $signature = $headers[$h]; break; }
        }
        if ($signature === '' && isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE'])) {
            $signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];
        }
        if ($signature === '' && isset($_SERVER['REDIRECT_HTTP_X_RAZORPAY_SIGNATURE'])) {
            $signature = $_SERVER['REDIRECT_HTTP_X_RAZORPAY_SIGNATURE'];
        }

        if (empty($signature)) {
            $this->log_line("WEBHOOK: no signature header -> ignored.");
            return $this->json_out(['status' => 'ignored', 'reason' => 'no_signature']);
        }

        $expected = hash_hmac('sha256', $rawData, self::WEBHOOK_SECRET);
        if (!hash_equals($expected, $signature)) {
            $this->log_line("WEBHOOK: invalid signature -> ignored.");
            return $this->json_out(['status' => 'ignored', 'reason' => 'bad_signature']);
        }
        $this->log_line("WEBHOOK: signature verified.");

        $event  = isset($data['event']) ? $data['event'] : '';
        $order_id = '';
        if (isset($data['payload']['payment']['entity']['order_id'])) {
            $order_id = $data['payload']['payment']['entity']['order_id'];
        }

        try {
            if ($event === 'payment.captured') {
                $result = $this->process($order_id);
                return $this->json_out(['status' => 'ok', 'event' => $event, 'order_id' => $order_id, 'result' => $result]);
            } elseif ($event === 'payment.failed') {
                $payment_id = $data['payload']['payment']['entity']['id'] ?? '';
                $reason     = $data['payload']['payment']['entity']['error_description'] ?? 'Unknown error';
                $this->log_line("PAYMENT FAILED: ".$payment_id." | ".$reason);
                return $this->json_out(['status' => 'ok', 'event' => $event, 'order_id' => $order_id]);
            } else {
                $this->log_line("WEBHOOK: unhandled event '".$event."' - acknowledged.");
                return $this->json_out(['status' => 'ignored', 'event' => $event]);
            }
        } catch (\Throwable $e) {
            // Must NOT fatal (a 500 makes Razorpay retry). Log and answer 200.
            $this->log_line("WEBHOOK: exception for order ".$order_id.": ".$e->getMessage());
            return $this->json_out(['status' => 'error', 'order_id' => $order_id, 'error' => $e->getMessage()]);
        }
    }

    // ================================================================== //
    // 2. CORE ENGINE  ->  process($order_id)
    //    Idempotent. Safe to call from webhook AND verify3/verify2 concurrently.
    //    Unified: detects pay3 flow (webhook_calls, by prid) vs pay2/CIN flow
    //    (webhook_calls_cin, by cin). Flow stays the same, execution is one engine.
    // ================================================================== //
    public function process($order_id)
    {
        $order_id = trim((string)$order_id);
        if ($order_id === '') {
            return ['status' => 'error', 'message' => 'order_id missing'];
        }

        $flow = $this->detect_flow($order_id);
        if ($flow === null) {
            $this->log_line("PROCESS ".$order_id.": no webhook_calls / webhook_calls_cin row - nothing to split.");
            return ['status' => 'not_found', 'order_id' => $order_id];
        }
        $wc    = $flow['row'];
        $table = $flow['table'];   // 'webhook_calls' (pay3) or 'webhook_calls_cin' (pay2/CIN)
        $is_cin = ($table === 'webhook_calls_cin');

        // Already done -> only top-up unpaid maker rows (never re-run aggregate legs).
        if ((int)$wc->status === 1) {
            $maker = $this->split_makers($order_id, false);
            $extra = [];
            if ($is_cin) {
                // Split done but cart may still be inactive -> auto-heal activation too.
                $extra = $this->activate_cart($order_id);
            }
            $this->log_line("PROCESS ".$order_id." [".$table."]: already status=1. maker top-up: ".json_encode($maker).($extra ? " activation: ".json_encode($extra) : ""));
            $out = ['status' => 'already_done', 'order_id' => $order_id, 'flow' => $table, 'makers' => $maker];
            if ($extra) { $out['activation'] = $extra; }
            return $out;
        }

        // Atomic claim: status 0 -> 2. Only one worker can win.
        $this->db->where('payment_id', $order_id);
        if (!$is_cin) { $this->db->where('prid', $wc->prid); }
        $this->db->where('status', 0);
        $this->db->update($table, ['status' => 2]);
        if ($this->db->affected_rows() === 0) {
            $this->log_line("PROCESS ".$order_id." [".$table."]: claim failed (status=".$wc->status.") - another worker owns it.");
            return ['status' => 'busy', 'order_id' => $order_id, 'flow' => $table];
        }

        $report = ['status' => 'error', 'order_id' => $order_id, 'flow' => $table, 'legs' => []];

        try {
            $legs = $this->split_legs($wc);
            $report['legs'] = $legs;
            $report['makers'] = $this->split_makers($order_id, false);

            $this->record_split($wc, $legs, $report['makers'], $table);

            if ($is_cin) {
                // CIN flow: activate cart items (new_cart) BEFORE clearing amount_cart.
                $report['activation'] = $this->activate_cart($order_id);
                $act_failed = !empty($report['activation']['failed']);
            } else {
                // Create CINs (pay3 flow) BEFORE any cart cleanup - needs cart_prid.
                $report['cins'] = $this->create_cins($order_id);
            }

            $this->db->where('payment_id', $order_id);
            if (!$is_cin) { $this->db->where('prid', $wc->prid); }
            $this->db->update($table, ['status' => 1, 'date_of_payment' => date('Y-m-d H:i:s')]);

            if ($is_cin) {
                // verify2 parity: clear the pending cart ONLY when split + activation
                // both succeeded, so a failed activation stays visible + retryable.
                if (empty($act_failed)) {
                    $this->db->where('cin', $wc->cin);
                    $this->db->where('payment_id', $order_id);
                    $this->db->delete('amount_cart');
                } else {
                    $this->log_line("PROCESS ".$order_id." [cin]: activation had failures - amount_cart kept for retry.");
                }
            } else {
                // verify3 parity: cart cleanup is by prid only (column is
                // payment_order_id, NOT payment_id - old filter matched nothing).
                $this->db->where('prid', $wc->prid);
                $this->db->delete('cart_prid');
            }

            $report['status'] = 'processed';
            $this->log_line("PROCESS ".$order_id." [".$table."]: DONE ".json_encode($report));

            // Admin push on successful payment (never breaks the split).
            $this->notify_admin($order_id, $wc, $report);

            return $report;

        } catch (\Throwable $e) {
            // Roll claim back to 0 so it is safely retryable.
            $this->db->where('payment_id', $order_id);
            if (!$is_cin) { $this->db->where('prid', $wc->prid); }
            $this->db->update($table, ['status' => 0]);
            $report['status'] = 'error';
            $report['error']  = $e->getMessage();
            $this->log_line("PROCESS ".$order_id." [".$table."]: ERROR ".$e->getMessage());
            return $report;
        }
    }

    // ------------------------------------------------------------------ //
    // Flow detector: pay3 (webhook_calls) wins when both exist; otherwise
    // pay2/CIN (webhook_calls_cin). Returns null when neither has the order.
    // ------------------------------------------------------------------ //
    private function detect_flow($order_id)
    {
        $wc = $this->db->get_where('webhook_calls', ['payment_id' => $order_id])->row();
        if (!empty($wc)) {
            return ['table' => 'webhook_calls', 'row' => $wc];
        }
        if ($this->db->table_exists('webhook_calls_cin')) {
            $wcc = $this->db->get_where('webhook_calls_cin', ['payment_id' => $order_id])->row();
            if (!empty($wcc)) {
                return ['table' => 'webhook_calls_cin', 'row' => $wcc];
            }
        }
        return null;
    }

    // ------------------------------------------------------------------ //
    // Aggregate transfer legs. Each leg runs only when amount > 0 AND an
    // account id exists. Every leg returns transfer_id or the raw error.
    // ------------------------------------------------------------------ //
    private function split_legs($wc)
    {
        $legs = [];

        // webhook_calls_cin has no school_amount column - default to 0.
        $school_amt = isset($wc->school_amount) ? (float)$wc->school_amount : 0.0;
        $fr_total = (float)$wc->franchise_amount + (float)$wc->franchise_gst + $school_amt;
        if ($fr_total > 0 && !empty($wc->franchise_account_id)) {
            $legs['franchise'] = $this->fetch($wc->payment_id, $wc->franchise_account_id, $fr_total * 100, $wc->franchise_razorpay_name);
        }

        $as_total = (float)$wc->associate_amount + (float)$wc->associate_gst;
        if ($as_total > 0 && !empty($wc->associate_account_id)) {
            $legs['associate'] = $this->fetch($wc->payment_id, $wc->associate_account_id, $as_total * 100, $wc->associate_razorpay_name);
        }

        if ((float)$wc->crm_fix > 0 && !empty($wc->crm_account_id)) {
            $legs['crm'] = $this->fetch($wc->payment_id, $wc->crm_account_id, $wc->crm_fix * 100, $wc->crm_razorpay_name);
        }

        if ((float)$wc->it_fix > 0) {
            $it_acc = $this->db->get_where('gst_account_marrs', ['id' => 9])->row();
            if (!empty($it_acc)) {
                $legs['it'] = $this->fetch($wc->payment_id, $it_acc->rozarpay_id, $wc->it_fix * 100, $it_acc->account_name);
            }
        }

        $av_total = (float)$wc->aviansys_amount + (float)$wc->aviansys_gst;
        if ($av_total > 0 && !empty($wc->aviansys_account_id)) {
            $legs['aviansys'] = $this->fetch($wc->payment_id, $wc->aviansys_account_id, $av_total * 100, $wc->aviansys_razorpay_name);
        }

        if ((float)$wc->management_amount > 0 && !empty($wc->marrsmanage_rozarpay_id)) {
            $legs['management'] = $this->fetch($wc->payment_id, $wc->marrsmanage_rozarpay_id, $wc->management_amount * 100, $wc->marrsmanage_razorpay_name);
        }

        if ((float)$wc->marrs_gst > 0) {
            $gst = $this->db->get_where('gst_account_marrs', ['id' => 1])->row();
            if (!empty($gst)) {
                $legs['gst'] = $this->fetch($wc->payment_id, $gst->rozarpay_id, $wc->marrs_gst * 100, $gst->account_name);
            }
        }

        return $legs;
    }

    // CART ACTIVATION (pay2/CIN flow) - ported from
    // Razorpay::processCartItems() with the live bugs fixed:
    //   - iterates the makers_splits ARRAY (old line 2230 did
    //     $makers_split->cin on an array -> activation died);
    //   - duplicate check RESTORED (old one was commented out ->
    //     double new_cart rows on every re-run);
    //   - falls back to amount_cart titles when no maker rows exist.
    // Idempotent: re-runs insert nothing new. Never throws.
    // Also exposed as /splitpay/activate/<order_id> for the monitor button.
    // ------------------------------------------------------------------ //
    public function activate_cart($order_id)
    {
        $order_id = trim((string)$order_id);
        $out = ['status' => 'error', 'order_id' => $order_id, 'activated' => [], 'skipped' => [], 'failed' => []];

        $wc = $this->db->table_exists('webhook_calls_cin')
            ? $this->db->get_where('webhook_calls_cin', ['payment_id' => $order_id])->row()
            : null;
        if (empty($wc)) {
            $out['status'] = 'not_found';
            return $out;
        }

        $comp_ids = array_filter(array_map('trim', explode(',', (string)$wc->comp_id)));
        $competition = null;
        foreach ($comp_ids as $cid) {
            $competition = $this->db->get_where('competition_product_state', ['id' => $cid])->row();
            if (!empty($competition)) { break; }
        }
        if (empty($competition)) {
            $this->log_line("ACTIVATE ".$order_id.": competition not found for comp_id ".$wc->comp_id);
            $out['status'] = 'no_competition';
            $out['failed'][] = 'competition not found';
            return $out;
        }

        $normalize = function ($str) {
            return strtolower(trim(preg_replace('/\s+/', ' ', (string)$str)));
        };
        // Same title -> flags mapping as Razorpay::processCartItems().
        $cart_mappings = [
            'competition'   => ['status' => 'Paid'],
            'material a'    => ['study_material_a' => 'Yes', 'study_material' => 'Yes'],
            'material b'    => ['study_material_b' => 'Yes'],
            'material c'    => ['study_material_c' => 'Yes'],
            'material d'    => ['study_material_d' => 'Yes'],
            'material e'    => ['study_material_e' => 'Yes'],
            'material f'    => ['study_material_f' => 'Yes'],
            'mocktest a'    => ['mock_test_a' => 'Yes', 'mock_test' => 'Yes'],
            'mocktest b'    => ['mock_test_b' => 'Yes'],
            'mocktest c'    => ['mock_test_c' => 'Yes'],
            'mocktest d'    => ['mock_test_d' => 'Yes'],
            'mocktest e'    => ['mock_test_e' => 'Yes'],
            'mocktest f'    => ['mock_test_f' => 'Yes'],
            'orientation a' => ['orientation_a' => 'Yes'],
            'orientation b' => ['orientation_b' => 'Yes'],
            'orientation c' => ['orientation_c' => 'Yes'],
            'orientation d' => ['orientation_d' => 'Yes'],
            'orientation e' => ['orientation_e' => 'Yes'],
            'orientation f' => ['orientation_f' => 'Yes'],
        ];

        // Item titles: prefer maker rows (verify2's source); fall back to
        // amount_cart titles when pay2 never stamped makers_splits.
        $titles = [];
        $maker_rows = $this->db->get_where('makers_splits', ['order_id' => $order_id])->result();
        foreach ($maker_rows as $mr) {
            if (!empty($mr->title)) { $titles[] = $mr->title; }
        }
        if (empty($titles)) {
            $cart_rows = $this->db->get_where('amount_cart', ['payment_id' => $order_id])->result();
            foreach ($cart_rows as $cr) {
                if (!empty($cr->title)) { $titles[] = $cr->title; }
            }
        }
        $titles = array_values(array_unique($titles));
        if (empty($titles)) {
            $this->log_line("ACTIVATE ".$order_id.": no maker/cart titles - nothing to activate.");
            $out['status'] = 'no_items';
            return $out;
        }

        foreach ($titles as $title) {
            $key = $normalize($title);
            if (!isset($cart_mappings[$key])) {
                $out['skipped'][] = ['title' => $title, 'reason' => 'unknown_title'];
                continue;
            }
            $cart_data = $cart_mappings[$key];
            $cart_data['cin']                 = $wc->cin;
            $cart_data['razorpay_payment_id'] = $order_id;
            $cart_data['product_name']        = $wc->product_name;
            $cart_data['clevel']              = $competition->clevel;
            $cart_data['period_id']           = $competition->period_id;
            $cart_data['comp_id']             = $competition->id;

            // Idempotency: same cin + product + competition + item flags.
            $check = [
                'cin'          => $wc->cin,
                'product_name' => $wc->product_name,
                'clevel'       => $competition->clevel,
                'period_id'    => $competition->period_id,
            ];
            foreach ($cart_data as $k => $v) {
                if ($k === 'status') { continue; }
                $check[$k] = $v;
            }
            try {
                $exists = $this->db->get_where('new_cart', $check)->row();
            } catch (\Throwable $e) {
                $exists = null;
            }
            if (!empty($exists)) {
                $out['skipped'][] = ['title' => $title, 'reason' => 'already_active'];
                continue;
            }
            try {
                $this->db->insert('new_cart', $cart_data);
                $out['activated'][] = $title;
            } catch (\Throwable $e) {
                $out['failed'][] = ['title' => $title, 'error' => $e->getMessage()];
                $this->log_line("ACTIVATE ".$order_id." [".$title."]: ERROR ".$e->getMessage());
            }
        }

        $out['status'] = empty($out['failed']) ? 'ok' : 'partial';
        $this->log_line("ACTIVATE ".$order_id.": ".json_encode($out));
        return $out;
    }

    // Standalone endpoint for the monitor's "Activate" button.
    public function activate($order_id = null)
    {
        if (empty($order_id)) { $order_id = $this->uri->segment(3); }
        if (empty($order_id)) { $order_id = $this->input->get('order_id'); }
        $order_id = trim((string)$order_id);
        if ($order_id === '') {
            return $this->json_out(['status' => 'error', 'message' => 'order_id required'], 400);
        }
        $result = $this->activate_cart($order_id);
        return $this->json_out(['status' => 'ok', 'result' => $result]);
    }

    // ------------------------------------------------------------------ //
    // Maker royalty rows (makers_splits). Row-level idempotent: a row is
    // only paid when its transaction_id is still empty. Skips price <= 0.
    // ------------------------------------------------------------------ //
    private function split_makers($order_id, $dry_run)
    {
        $rows = $this->db->get_where('makers_splits', ['order_id' => $order_id])->result();
        $out  = [];
        foreach ($rows as $row) {
            if (!empty($row->transaction_id)) {
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'action' => 'skipped_already_paid'];
                continue;
            }
            if ((float)$row->price <= 0) {
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'action' => 'skipped_zero_price'];
                continue;
            }

            $maker = $this->db->get_where('material_maker', ['material_maker_id' => $row->maker_id])->row();
            if (empty($maker) || empty($maker->razorpay_id)) {
                $this->log_line("MAKERS order ".$order_id." row ".$row->id.": material_maker / razorpay_id missing (maker_id ".$row->maker_id.")");
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'action' => 'error_missing_maker'];
                continue;
            }

            if ($dry_run) {
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'account' => $maker->razorpay_id, 'action' => 'would_pay'];
                continue;
            }

            $pay = $this->fetch($order_id, $maker->razorpay_id, $row->price * 100, $maker->account_name);
            $tid = isset($pay['transfer_id']) ? $pay['transfer_id'] : '';
            $this->log_line("MAKERS order ".$order_id." row ".$row->id." maker ".$row->maker_id." price ".$row->price." -> ".json_encode($pay));

            if (!empty($tid)) {
                $this->db->where('id', $row->id);
                $this->db->update('makers_splits', ['transaction_id' => $tid]);
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'transfer_id' => $tid, 'action' => 'paid'];
            } else {
                $out[] = ['id' => $row->id, 'maker_id' => $row->maker_id, 'price' => $row->price, 'action' => 'error_transfer', 'raw' => $pay['raw_response'] ?? null];
            }
        }
        return $out;
    }

    // ------------------------------------------------------------------ //
    // Record the completed split into payment_split_prid + payment_split
    // (both are read by the dashboards). Guarded: never inserts twice.
    // CIN flow (webhook_calls_cin): no prid, no school_amount -> writes
    // payment_split only (verify2 parity); prid table needs a prid.
    // ------------------------------------------------------------------ //
    private function record_split($wc, $legs, $makers_report, $flow = 'webhook_calls')
    {
        $tid = function ($key) use ($legs) {
            return isset($legs[$key]['transfer_id']) ? $legs[$key]['transfer_id'] : '';
        };
        $has_franchise_id = isset($wc->franchise_id) && $wc->franchise_id !== null && $wc->franchise_id !== '';
        // NOTE: payment_split_prid columns are NOT NULL *without* defaults,
        // while webhook_calls.* is all TEXT (often NULL). Build inserts with
        // only NOT NULL-safe values: '' for strings, '0' for int-ish columns.
        // payment_split is mostly nullable, but we reuse the same arrays.
        $franchise_id = $has_franchise_id ? $wc->franchise_id : '0';
        $s  = function ($v) { return ($v === null || $v === '') ? '' : $v; };
        $n0 = function ($v) { return ($v === null || $v === '') ? '0' : $v; };

        // maker identity: first maker row that got paid (or was already paid)
        $maker_id = '';
        $maker_tid = '';
        foreach ((array)$makers_report as $m) {
            if (isset($m['action']) && in_array($m['action'], ['paid', 'skipped_already_paid'], true)) {
                $maker_id = $m['maker_id'];
                $maker_tid = isset($m['transfer_id']) ? $m['transfer_id'] : '';
                break;
            }
        }
        if ($maker_id === null || $maker_id === '') { $maker_id = '0'; }

        $now = date('Y-m-d H:i:s');
        $is_cin = ($flow === 'webhook_calls_cin');
        // CIN rows have no prid / school_amount columns - use safe defaults.
        $prid_val   = $is_cin ? '' : $s(isset($wc->prid) ? $wc->prid : '');
        $school_val = $is_cin ? '' : $s(isset($wc->school_amount) ? $wc->school_amount : '');

        // ---------- payment_split_prid (prid flow only) ----------
        $exists = $this->db->get_where('payment_split_prid', ['payment_id' => $wc->payment_id])->row();
        if (empty($exists) && !$is_cin) {
            $inst = [
                'prid'                  => $prid_val,
                'clevel'                => $s($wc->clevel),
                'total_amount'          => $s($wc->total_amount),
                'franchise_amount'      => $s($wc->franchise_amount),
                'franchise_tranfer_id'  => $tid('franchise'),
                'franchise_id'          => $franchise_id,
                'franchise_gst'         => $s($wc->franchise_gst),
                'school_amount'         => $school_val,
                'payment_id'            => $s($wc->payment_id),
                'aviansys_amount'       => $s($wc->aviansys_amount),
                'aviansys_gst'          => $s($wc->aviansys_gst),
                'aviansys_tranfer_id'   => $tid('aviansys'),
                'gst_amount'            => $s($wc->marrs_gst),
                'gst_tranfer_id'        => $tid('gst'),
                'razpay_service'        => $s($wc->razpay_service),
                'crm_fix'               => $n0($wc->crm_fix),
                'crm_fix_tranfer_id'    => $tid('crm'),
                'it_fix'                => $n0($wc->it_fix),
                'it_fix_tranfer_id'     => $tid('it'),
                'MaRRS_bal'             => $s($wc->MaRRS_bal),
                'date_of_payment'       => substr($now, 0, 10),
                'management_amount'     => $s($wc->management_amount),
                'management_tranfer_id' => $tid('management'),
                'associate_gst'         => $n0($wc->associate_gst),
                'associate_tranfer_id'  => $tid('associate'),
                'associate_amount'      => $n0($wc->associate_amount),
                'associate_id'          => $n0($wc->associate_id),
                'comp_id'               => $n0($wc->comp_id),
                'status'                => 1,
                'maker_id'              => $maker_id,
                'total_maker_amount'    => $s($wc->total_maker_amount),
                'maker_transfer_id'     => $maker_tid,
            ];
            if (!$this->db->insert('payment_split_prid', $inst)) {
                $this->log_line("RECORD: payment_split_prid insert failed for ".$wc->payment_id." : ".$this->db->error()['message']);
            }
        }

        // ---------- payment_split ----------
        $exists2 = $this->db->get_where('payment_split', ['payment_id' => $wc->payment_id])->row();
        if (empty($exists2)) {
            $inst2 = [
                'cin'                   => $s($wc->cin),
                'clevel'                => $n0($wc->clevel),
                'total_amount'          => $s($wc->total_amount),
                'franchise_amount'      => $s($wc->franchise_amount),
                'franchise_tranfer_id'  => $tid('franchise'),
                'franchise_id'          => $franchise_id,
                'franchise_gst'         => $s($wc->franchise_gst),
                'school_amount'         => $school_val,
                'payment_id'            => $s($wc->payment_id),
                'aviansys_amount'       => $s($wc->aviansys_amount),
                'aviansys_gst'          => $s($wc->aviansys_gst),
                'aviansys_tranfer_id'   => $tid('aviansys'),
                'gst_amount'            => $s($wc->marrs_gst),
                'gst_tranfer_id'        => $tid('gst'),
                'razpay_service'        => $s($wc->razpay_service),
                'crm_fix'               => $s($wc->crm_fix),
                'crm_fix_tranfer_id'    => $tid('crm'),
                'it_fix'                => $n0($wc->it_fix),
                'it_fix_tranfer_id'     => $tid('it'),
                'MaRRS_bal'             => $s($wc->MaRRS_bal),
                'date_of_payment'       => $now,
                'management_amount'     => $s($wc->management_amount),
                'management_tranfer_id' => $tid('management'),
                'associate_gst'         => $s($wc->associate_gst),
                'associate_tranfer_id'  => $tid('associate'),
                'associate_amount'      => $s($wc->associate_amount),
                'associate_id'          => $s($wc->associate_id),
                'comp_id'               => $s($wc->comp_id),
                'status'                => 1,
                'maker_id'              => $maker_id,
                'total_maker_amount'    => $s($wc->total_maker_amount),
                'maker_transfer_id'     => $maker_tid,
            ];
            if (!$this->db->insert('payment_split', $inst2)) {
                $this->log_line("RECORD: payment_split insert failed for ".$wc->payment_id." : ".$this->db->error()['message']);
            }
        }
    }

    // ================================================================== //
    // 3. TRANSFER HELPER (corrected)
    //    NOTE: the old Webhook::fetch() sent on_hold_until together with
    //    on_hold=false, which Razorpay rejected on EVERY call
    //    (BAD_REQUEST_VALIDATION_FAILURE). That is why the makers-split pay
    //    was never transferred. This payload omits on_hold_until.
    // ================================================================== //
    public function fetch($order_id, $account_id, $amount, $account_razorpay_name)
    {
        $amount = (int)round((float)$amount);
        if (empty($order_id) || empty($account_id) || $amount <= 0) {
            return ['payment_id' => null, 'transfer_id' => '', 'tranfer_id' => '', 'transfer_amount' => $amount, 'error' => 'missing_order_account_or_amount'];
        }

        // Step 1: find the captured payment for this order
        $auth = self::razorpay_keys()['auth_header'];
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://api.razorpay.com/v1/orders/'.$order_id.'/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => [$auth],
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $payments   = json_decode($response, true);
        $payment_id = isset($payments['items'][0]['id']) ? $payments['items'][0]['id'] : null;
        if (!$payment_id) {
            return ['payment_id' => null, 'transfer_id' => '', 'tranfer_id' => '', 'transfer_amount' => $amount, 'error' => 'no_payment_found_for_order', 'raw_response' => $payments];
        }

        // Step 2: create the transfer. on_hold=false, NO on_hold_until.
        $payload = json_encode([
            'transfers' => [[
                'account'  => (string)$account_id,
                'amount'   => (string)$amount,
                'currency' => 'INR',
                'notes'    => [
                    'name'    => (string)$account_razorpay_name,
                    'roll_no' => 'IEC2011025',
                ],
                'linked_account_notes' => ['roll_no'],
                'on_hold' => false,
            ]],
        ]);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://api.razorpay.com/v1/payments/'.$payment_id.'/transfers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json', $auth],
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);

        $transfer_id = '';
        $error = '';
        if (isset($data['error'])) {
            $error = $data['error']['description'] ?? 'razorpay_error';
        } elseif (isset($data['items'][0]['id'])) {
            $transfer_id = $data['items'][0]['id'];
        } elseif (isset($data['id'])) {
            $transfer_id = $data['id'];
        }

        return [
            'payment_id'      => $payment_id,
            'transfer_id'     => $transfer_id,
            'tranfer_id'      => $transfer_id, // legacy typo key kept for compatibility
            'transfer_amount' => $amount,
            'error'           => $error,
            'raw_response'    => $data,
        ];
    }

    // ================================================================== //
    // 4. ASYNC ENDPOINT (called by Razorpay::verify3 via cURL)
    //    POST order_id  ->  same engine as the webhook.
    // ================================================================== //
    public function processEndpoint()
    {
        @set_time_limit(300);
        $order_id = $this->input->post('order_id');
        if (empty($order_id)) {
            $order_id = $this->input->get('order_id');
        }
        $result = $this->process($order_id);
        return $this->json_out(['status' => 'ok', 'result' => $result]);
    }

    // ================================================================== //
    // 5. DRY RUN  ->  /splitpay/dryRun/<order_id>   (or ?order_id=)
    //    Makes NO Razorpay API calls. Writes NOTHING to the DB.
    //    Flow-aware: previews legs + cart activation for CIN orders too.
    //    This is the local test surface.
    // ================================================================== //
    public function dryRun($order_id = null)
    {
        if (empty($order_id)) { $order_id = $this->uri->segment(3); }
        if (empty($order_id)) { $order_id = $this->input->get('order_id'); }
        $order_id = trim((string)$order_id);
        if ($order_id === '') {
            return $this->json_out(['status' => 'error', 'message' => 'order_id required'], 400);
        }

        $flow  = $this->detect_flow($order_id);
        $wc    = $flow ? $flow['row'] : null;
        $table = $flow ? $flow['table'] : null;
        $makers  = $this->split_makers($order_id, true); // dry_run = true -> no API, no writes

        $plan = [];
        if (!empty($wc)) {
            $school_amt = isset($wc->school_amount) ? (float)$wc->school_amount : 0.0;
            $fr_total = (float)$wc->franchise_amount + (float)$wc->franchise_gst + $school_amt;
            if ($fr_total > 0 && !empty($wc->franchise_account_id)) { $plan['franchise'] = ['amount' => $fr_total, 'account' => $wc->franchise_account_id]; }
            $as_total = (float)$wc->associate_amount + (float)$wc->associate_gst;
            if ($as_total > 0 && !empty($wc->associate_account_id)) { $plan['associate'] = ['amount' => $as_total, 'account' => $wc->associate_account_id]; }
            if ((float)$wc->crm_fix > 0 && !empty($wc->crm_account_id)) { $plan['crm'] = ['amount' => (float)$wc->crm_fix, 'account' => $wc->crm_account_id]; }
            if ((float)$wc->it_fix > 0) { $it = $this->db->get_where('gst_account_marrs', ['id' => 9])->row(); if ($it) { $plan['it'] = ['amount' => (float)$wc->it_fix, 'account' => $it->rozarpay_id]; } }
            $av_total = (float)$wc->aviansys_amount + (float)$wc->aviansys_gst;
            if ($av_total > 0 && !empty($wc->aviansys_account_id)) { $plan['aviansys'] = ['amount' => $av_total, 'account' => $wc->aviansys_account_id]; }
            if ((float)$wc->management_amount > 0 && !empty($wc->marrsmanage_rozarpay_id)) { $plan['management'] = ['amount' => (float)$wc->management_amount, 'account' => $wc->marrsmanage_rozarpay_id]; }
            if ((float)$wc->marrs_gst > 0) { $g = $this->db->get_where('gst_account_marrs', ['id' => 1])->row(); if ($g) { $plan['gst'] = ['amount' => (float)$wc->marrs_gst, 'account' => $g->rozarpay_id]; } }
        }

        $maker_total = 0.0;
        foreach ($makers as $m) { if (isset($m['action']) && $m['action'] === 'would_pay') { $maker_total += (float)$m['price']; } }
        $plan_total = 0.0;
        foreach ($plan as $p) { $plan_total += (float)$p['amount']; }

        // CIN flow: also preview cart items that would be activated (read-only).
        $cart_preview = null;
        if ($table === 'webhook_calls_cin' && !empty($wc)) {
            $titles = [];
            foreach ($this->db->get_where('makers_splits', ['order_id' => $order_id])->result() as $mr) {
                if (!empty($mr->title)) { $titles[] = $mr->title; }
            }
            if (empty($titles)) {
                foreach ($this->db->get_where('amount_cart', ['payment_id' => $order_id])->result() as $cr) {
                    if (!empty($cr->title)) { $titles[] = $cr->title; }
                }
            }
            $titles = array_values(array_unique($titles));
            $cart_preview = ['cin' => $wc->cin, 'titles' => $titles, 'activated_rows' => $this->db->get_where('new_cart', ['cin' => $wc->cin, 'razorpay_payment_id' => $order_id])->num_rows(), 'pending_amount_cart' => $this->db->get_where('amount_cart', ['payment_id' => $order_id])->num_rows()];
        }

        return $this->json_out([
            'status'        => 'dry_run',
            'order_id'      => $order_id,
            'flow'          => $table,
            'webhook_calls' => $wc ? (array)$wc : null,
            'legs'          => $plan,
            'legs_total'    => $plan_total,
            'makers'        => $makers,
            'makers_total'  => $maker_total,
            'grand_total'   => $plan_total + $maker_total,
            'paid_total'    => $wc ? (float)$wc->total_amount : null,
            'cart_preview'  => $cart_preview,
        ]);
    }

    // ================================================================== //
    // 6. RETRY  ->  /splitpay/retry/<order_id>
    //    Re-runs the engine for a stuck order. If the order is already
    //    status=1 it will ONLY top-up unpaid maker rows (never re-pay legs).
    // ================================================================== //
    public function retry($order_id = null)
    {
        if (empty($order_id)) { $order_id = $this->uri->segment(3); }
        if (empty($order_id)) { $order_id = $this->input->get('order_id'); }
        $order_id = trim((string)$order_id);
        if ($order_id === '') {
            return $this->json_out(['status' => 'error', 'message' => 'order_id required'], 400);
        }
        $result = $this->process($order_id);
        return $this->json_out(['status' => 'ok', 'result' => $result]);
    }
}






