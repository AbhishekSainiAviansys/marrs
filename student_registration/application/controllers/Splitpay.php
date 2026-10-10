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
    //    Idempotent. Safe to call from webhook AND verify3 concurrently.
    // ================================================================== //
    public function process($order_id)
    {
        $order_id = trim((string)$order_id);
        if ($order_id === '') {
            return ['status' => 'error', 'message' => 'order_id missing'];
        }

        $wc = $this->db->get_where('webhook_calls', ['payment_id' => $order_id])->row();
        if (empty($wc)) {
            $this->log_line("PROCESS ".$order_id.": no webhook_calls row - nothing to split.");
            return ['status' => 'not_found', 'order_id' => $order_id];
        }

        // Already done -> only top-up unpaid maker rows (never re-run aggregate legs).
        if ((int)$wc->status === 1) {
            $maker = $this->split_makers($order_id, false);
            $this->log_line("PROCESS ".$order_id.": already status=1. maker top-up: ".json_encode($maker));
            return ['status' => 'already_done', 'order_id' => $order_id, 'makers' => $maker];
        }

        // Atomic claim: status 0 -> 2. Only one worker can win.
        $this->db->where('payment_id', $order_id);
        $this->db->where('prid', $wc->prid);
        $this->db->where('status', 0);
        $this->db->update('webhook_calls', ['status' => 2]);
        if ($this->db->affected_rows() === 0) {
            $this->log_line("PROCESS ".$order_id.": claim failed (status=".$wc->status.") - another worker owns it.");
            return ['status' => 'busy', 'order_id' => $order_id];
        }

        $report = ['status' => 'error', 'order_id' => $order_id, 'legs' => []];

        try {
            $legs = $this->split_legs($wc);
            $report['legs'] = $legs;
            $report['makers'] = $this->split_makers($order_id, false);

            $this->record_split($wc, $legs, $report['makers']);
            $this->db->where('payment_id', $order_id);
            $this->db->where('prid', $wc->prid);
            $this->db->update('webhook_calls', ['status' => 1, 'date_of_payment' => date('Y-m-d H:i:s')]);
            $this->db->where('prid', $wc->prid);
            $this->db->where('payment_order_id', $order_id);
            $this->db->delete('cart_prid');

            $report['status'] = 'processed';
            $this->log_line("PROCESS ".$order_id.": DONE ".json_encode($report));
            return $report;

        } catch (\Throwable $e) {
            // Roll claim back to 0 so it is safely retryable.
            $this->db->where('payment_id', $order_id);
            $this->db->where('prid', $wc->prid);
            $this->db->update('webhook_calls', ['status' => 0]);
            $report['status'] = 'error';
            $report['error']  = $e->getMessage();
            $this->log_line("PROCESS ".$order_id.": ERROR ".$e->getMessage());
            return $report;
        }
    }

    // ------------------------------------------------------------------ //
    // Aggregate transfer legs. Each leg runs only when amount > 0 AND an
    // account id exists. Every leg returns transfer_id or the raw error.
    // ------------------------------------------------------------------ //
    private function split_legs($wc)
    {
        $legs = [];

        $fr_total = (float)$wc->franchise_amount + (float)$wc->franchise_gst + (float)$wc->school_amount;
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
    // ------------------------------------------------------------------ //
    private function record_split($wc, $legs, $makers_report)
    {
        $tid = function ($key) use ($legs) {
            return isset($legs[$key]['transfer_id']) ? $legs[$key]['transfer_id'] : '';
        };

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

        $now = date('Y-m-d H:i:s');

        // ---------- payment_split_prid ----------
        $exists = $this->db->get_where('payment_split_prid', ['payment_id' => $wc->payment_id])->row();
        if (empty($exists)) {
            $inst = [
                'prid'                  => $wc->prid,
                'clevel'                => $wc->clevel,
                'total_amount'          => $wc->total_amount,
                'franchise_amount'      => $wc->franchise_amount,
                'franchise_tranfer_id'  => $tid('franchise'),
                'franchise_id'          => $wc->franchise_id,
                'franchise_gst'         => $wc->franchise_gst,
                'school_amount'         => $wc->school_amount,
                'payment_id'            => $wc->payment_id,
                'aviansys_amount'       => $wc->aviansys_amount,
                'aviansys_gst'          => $wc->aviansys_gst,
                'aviansys_tranfer_id'   => $tid('aviansys'),
                'gst_amount'            => $wc->marrs_gst,
                'gst_tranfer_id'        => $tid('gst'),
                'razpay_service'        => $wc->razpay_service,
                'crm_fix'               => $wc->crm_fix,
                'crm_fix_tranfer_id'    => $tid('crm'),
                'it_fix'                => $wc->it_fix,
                'it_fix_tranfer_id'     => $tid('it'),
                'MaRRS_bal'             => $wc->MaRRS_bal,
                'date_of_payment'       => $now,
                'management_amount'     => $wc->management_amount,
                'management_tranfer_id' => $tid('management'),
                'associate_gst'         => $wc->associate_gst,
                'associate_tranfer_id'  => $tid('associate'),
                'associate_amount'      => $wc->associate_amount,
                'associate_id'          => $wc->associate_id,
                'comp_id'               => $wc->comp_id,
                'status'                => 1,
                'maker_id'              => $maker_id,
                'total_maker_amount'    => $wc->total_maker_amount,
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
                'cin'                   => $wc->cin,
                'clevel'                => $wc->clevel,
                'total_amount'          => $wc->total_amount,
                'franchise_amount'      => $wc->franchise_amount,
                'franchise_tranfer_id'  => $tid('franchise'),
                'franchise_id'          => $wc->franchise_id,
                'franchise_gst'         => $wc->franchise_gst,
                'school_amount'         => $wc->school_amount,
                'payment_id'            => $wc->payment_id,
                'aviansys_amount'       => $wc->aviansys_amount,
                'aviansys_gst'          => $wc->aviansys_gst,
                'aviansys_tranfer_id'   => $tid('aviansys'),
                'gst_amount'            => $wc->marrs_gst,
                'gst_tranfer_id'        => $tid('gst'),
                'razpay_service'        => $wc->razpay_service,
                'crm_fix'               => $wc->crm_fix,
                'crm_fix_tranfer_id'    => $tid('crm'),
                'it_fix'                => $wc->it_fix,
                'it_fix_tranfer_id'     => $tid('it'),
                'MaRRS_bal'             => $wc->MaRRS_bal,
                'date_of_payment'       => $now,
                'management_amount'     => $wc->management_amount,
                'management_tranfer_id' => $tid('management'),
                'associate_gst'         => $wc->associate_gst,
                'associate_tranfer_id'  => $tid('associate'),
                'associate_amount'      => $wc->associate_amount,
                'associate_id'          => $wc->associate_id,
                'comp_id'               => $wc->comp_id,
                'status'                => 1,
                'maker_id'              => $maker_id,
                'total_maker_amount'    => $wc->total_maker_amount,
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

        $wc      = $this->db->get_where('webhook_calls', ['payment_id' => $order_id])->row();
        $makers  = $this->split_makers($order_id, true); // dry_run = true -> no API, no writes

        $plan = [];
        if (!empty($wc)) {
            $fr_total = (float)$wc->franchise_amount + (float)$wc->franchise_gst + (float)$wc->school_amount;
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

        return $this->json_out([
            'status'        => 'dry_run',
            'order_id'      => $order_id,
            'webhook_calls' => $wc ? (array)$wc : null,
            'legs'          => $plan,
            'legs_total'    => $plan_total,
            'makers'        => $makers,
            'makers_total'  => $maker_total,
            'grand_total'   => $plan_total + $maker_total,
            'paid_total'    => $wc ? (float)$wc->total_amount : null,
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






