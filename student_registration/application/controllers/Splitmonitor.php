<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Splitpay.php';

/**
 * Splitmonitor - last-24-hours webhook calls, split details and error logs.
 *
 * URLs:
 *   /splitmonitor       -> view page (auto-refreshes every 30s)
 *   /splitmonitor/data  -> JSON with every section the view renders
 *
 * Shows: webhook_calls + payment_split(_prid) + makers_splits of the last
 * 24h, plus exact errors from splitpay.log / webhook.log (tail) and the PHP
 * error_log - so webhook setup/call problems are visible in one place.
 *
 * Standalone webhook/split simulator. NO login, NO dashboard coupling.
 */
class Splitmonitor extends CI_Controller
{
    /** Read only the last 2 MB of the (19+ MB) webhook.log. */
    const TAIL_BYTES = 2097152;

    private $account;

    public function __construct()
    {
        parent::__construct();

        // Standalone webhook/split simulator: NO dashboard login, NO email/password.
        // Deliberately NOT using the other team's dashboard_accounts / dash_login.
        $this->load->database();
        $this->load->helper('url');

        $this->account = null;
    }

    public function index()
    {
        $data['account'] = $this->account;
        $this->load->view('splitmonitor.php', $data);
    }

    public function data()
    {
        $days = (int)$this->input->get('days');
        if ($days < 1 || $days > 7) { $days = 1; }
        $cutoff    = time() - $days * 86400;
        $since_day = date('Y-m-d', $cutoff);
        $since_dt  = date('Y-m-d H:i:s', $cutoff);

        // ---------- webhook_calls (selected day window by inserted_date) ----------
        $webhook_calls = $this->db->query(
            "SELECT * FROM webhook_calls WHERE inserted_date >= ? ORDER BY id DESC LIMIT 300",
            [$since_day]
        )->result();

        // ---------- splits ----------
        $split_prid = $this->db->query(
            "SELECT * FROM payment_split_prid WHERE date_of_payment >= ? ORDER BY pay_id DESC LIMIT 300",
            [$since_dt]
        )->result();
        $split = $this->db->query(
            "SELECT * FROM payment_split WHERE date_of_payment >= ? ORDER BY pay_id DESC LIMIT 300",
            [$since_dt]
        )->result();

        // ---------- order ids from ALL split tables + CIN webhooks ----------
        $order_ids = [];
        foreach ($webhook_calls as $r) { $order_ids[$r->payment_id] = true; }
        foreach ($split_prid as $r)    { $order_ids[$r->payment_id] = true; }
        foreach ($split as $r)         { $order_ids[$r->payment_id] = true; }

        // ---------- pay2/CIN flow: webhook_calls_cin (same selected window) ----------
        $webhook_cin = [];
        try {
            $webhook_cin = $this->db->query(
                "SELECT * FROM webhook_calls_cin WHERE inserted_date >= ? ORDER BY id DESC LIMIT 300",
                [$since_day]
            )->result();
        } catch (\Exception $e) { $webhook_cin = []; }
        foreach ($webhook_cin as $r) { $order_ids[$r->payment_id] = true; }
        $order_ids = array_slice(array_keys(array_filter($order_ids)), 0, 300);

        // split lookup sets (per-order trace across BOTH flows)
        $in_split_prid = [];
        foreach ($split_prid as $r) { $in_split_prid[$r->payment_id] = true; }
        $in_split = [];
        foreach ($split as $r) { $in_split[$r->payment_id] = true; }

        // pending cart items (amount_cart): group by payment_id for the Cart tab
        $amount_cart = [];
        try {
            $amount_cart = $this->db->query(
                "SELECT payment_id, cin, comp_id, COUNT(*) items, SUM(amount) amount, GROUP_CONCAT(DISTINCT title SEPARATOR ', ') titles FROM amount_cart GROUP BY payment_id, cin, comp_id ORDER BY payment_id DESC LIMIT 300"
            )->result();
        } catch (\Exception $e) { $amount_cart = []; }

        // activated rows (new_cart) keyed by razorpay_payment_id for per-order flags
        $active_map = [];
        try {
            $act_rows = $this->db->query(
                "SELECT razorpay_payment_id, COUNT(*) n FROM new_cart WHERE razorpay_payment_id IS NOT NULL AND razorpay_payment_id <> '' GROUP BY razorpay_payment_id LIMIT 500"
            )->result();
            foreach ($act_rows as $a) { $active_map[$a->razorpay_payment_id] = (int)$a->n; }
        } catch (\Exception $e) { /* leave empty */ }

        // pending items keyed by payment_id (for per-order "activate?" flags)
        $pending_map = [];
        foreach ($amount_cart as $c) { $pending_map[$c->payment_id] = (int)$c->items; }


        $makers = [];
        if (!empty($order_ids)) {
            $in  = implode(',', array_fill(0, count($order_ids), '?'));
            $makers = $this->db->query(
                "SELECT * FROM makers_splits WHERE order_id IN ($in) ORDER BY id DESC LIMIT 500",
                $order_ids
            )->result();
        }

        // ---------- CINs created per order (from product_purchase.cin - the
        // CIN string; product_name is the product label, NOT the CIN) ----------
        $cin_map = [];   // order_id => [cin, ...]
        $prid_set = [];
        if (!empty($order_ids)) {
            $in  = implode(',', array_fill(0, count($order_ids), '?'));
            $pp = $this->db->query(
                "SELECT payment_id, prid, cin FROM product_purchase WHERE payment_id IN ($in) AND cin IS NOT NULL AND cin <> '' ORDER BY id ASC",
                $order_ids
            )->result();
            foreach ($pp as $p) {
                $cin_map[$p->payment_id][] = $p->cin;
                if (!empty($p->prid)) { $prid_set[$p->prid] = true; }
            }
        }
        // student fcm_token per prid (has the student opted a device in?)
        // NOTE: students.fcm_token may not exist on older DBs (Splitpay adds
        // it lazily); probe first so data() NEVER 500s.
        $fcm_by_prid = [];
        foreach ($webhook_calls as $r) { if (!empty($r->prid)) { $prid_set[$r->prid] = true; } }
        if (!empty($prid_set)) {
            try {
                $dbn = $this->db->database;
                $has_fcm = (int)$this->db->query(
                    "SELECT COUNT(*) n FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME='students' AND COLUMN_NAME='fcm_token'",
                    [$dbn]
                )->row()->n;
                if ($has_fcm) {
                    $prids = array_slice(array_keys($prid_set), 0, 300);
                    $inq  = implode(',', array_fill(0, count($prids), '?'));
                    $stu = $this->db->query("SELECT PRID, fcm_token FROM students WHERE PRID IN ($inq)", $prids)->result();
                    foreach ($stu as $s) { $fcm_by_prid[$s->PRID] = !empty($s->fcm_token); }
                }
            } catch (\Throwable $e) { /* leave map empty */ }
        }

        // ---------- per-order trace: which tables have this order ----------
        $wc_by_order   = [];
        foreach ($webhook_calls as $r) { $wc_by_order[$r->payment_id] = $r; }
        $wc_cin_by_order = [];
        foreach ($webhook_cin as $r) { $wc_cin_by_order[$r->payment_id] = $r; }
        $sp_by_order   = [];
        foreach ($split_prid as $r)    { $sp_by_order[$r->payment_id] = true; }
        $split_by_order = [];
        foreach ($split as $r)         { $split_by_order[$r->payment_id] = true; }

        // ---------- per-maker diagnostic: WHY was it (not) transferred ----------
        $maker_rows = [];
        foreach ($makers as $m) {
            $reason = '';
            $state  = 'paid';
            if (!empty($m->transaction_id)) {
                $state = 'paid';
            } else {
                $state = 'unpaid';
                $maker = $this->db->get_where('material_maker', ['material_maker_id' => $m->maker_id])->row();
                if (empty($m->order_id)) {
                    $reason = 'order_id empty (orphan row - never linked to an order)';
                } elseif (empty($maker) || empty($maker->razorpay_id)) {
                    $reason = 'material_maker / razorpay_id missing (maker_id ' . $m->maker_id . ')';
                } elseif ((float)$m->price <= 0) {
                    $reason = 'price is 0 - nothing to transfer';
                } elseif (empty($wc_by_order[$m->order_id])) {
                    $reason = 'no webhook_calls row for this order - Splitpay::process never ran';
                } elseif ((int)$wc_by_order[$m->order_id]->status !== 1) {
                    $reason = 'webhook_calls status=' . $wc_by_order[$m->order_id]->status . ' (not processed) - Splitpay::process did not complete';
                } else {
                    $reason = 'order processed but this row still unpaid - re-run splitpay/retry';
                }
            }
            $row = (array)$m;
            $row['state']  = $state;
            $row['reason'] = $reason;
            $cin_webhook = isset($wc_cin_by_order[$m->order_id]) ? $wc_cin_by_order[$m->order_id] : null;
            $prid_webhook = isset($wc_by_order[$m->order_id]) ? $wc_by_order[$m->order_id] : null;
            $row['flow'] = $cin_webhook ? 'CIN' : ($prid_webhook ? 'PRID' : 'ORPHAN');
            $source_webhook = $cin_webhook ?: $prid_webhook;
            $row['product_name'] = !empty($source_webhook->product_name) ? $source_webhook->product_name : '';
            $split_record = isset($split_by_order[$m->order_id]) ? $this->find_order_row($split, $m->order_id) : null;
            if (!$split_record && isset($sp_by_order[$m->order_id])) {
                $split_record = $this->find_order_row($split_prid, $m->order_id);
            }
            $row['time'] = $source_webhook
                ? trim((isset($source_webhook->inserted_date) ? $source_webhook->inserted_date : '') . ' ' . (isset($source_webhook->inserted_time) ? $source_webhook->inserted_time : ''))
                : ($split_record && isset($split_record->date_of_payment) ? $split_record->date_of_payment : '');
            $maker_rows[]  = $row;
        }


        // ---------- log scans ----------
        $logs = [
            'splitpay' => $this->scan_splitpay_log($cutoff),
            'webhook'  => $this->scan_webhook_log($cutoff),
            'php'      => $this->scan_php_error_log($cutoff),
        ];

        // ---------- keys status (masked - secret is never returned) ----------
        $keys = Splitpay::razorpay_keys();
        $keys_status = [
            'source'         => $keys['source'],
            'in_credentials' => $keys['source'] === 'credentials_table',
            'key_id_masked'  => substr($keys['key_id'], 0, 8) . '****',
            'secret_masked'  => '****',
        ];

        // ---------- summary ----------
        $status = ['pending' => 0, 'processing' => 0, 'done' => 0];
        foreach ($webhook_calls as $r) {
            if ((int)$r->status === 1) { $status['done']++; }
            elseif ((int)$r->status === 2) { $status['processing']++; }
            else { $status['pending']++; }
        }
        $makers_paid = 0; $makers_unpaid = 0;
        foreach ($maker_rows as $m) {
            if ($m['state'] === 'paid') { $makers_paid++; } else { $makers_unpaid++; }
        }

        // enrich webhook_calls rows with an order trace + CIN count + reconciliation
        $wc_rows = [];
        $cin_rows = [];
        $cins_total = 0; $paid_no_cin = 0;
        foreach ($webhook_calls as $r) {
            $row = (array)$r;
            $row['in_split_prid'] = !empty($sp_by_order[$r->payment_id]);
            $row['flow'] = 'prid';
            $row['needs_split'] = empty($sp_by_order[$r->payment_id]) && empty($split_by_order[$r->payment_id]);
            $row['in_split']      = !empty($split_by_order[$r->payment_id]);

            $cins = isset($cin_map[$r->payment_id]) ? $cin_map[$r->payment_id] : [];
            $row['cin_count'] = count($cins);
            $cins_total += count($cins);

            // reconciliation: total vs (allocated transfers + retained platform amount)
            $allocated = (float)$r->franchise_amount + (float)$r->franchise_gst + (float)$r->school_amount
                + (float)$r->associate_amount + (float)$r->associate_gst
                + (float)$r->crm_fix + (float)$r->it_fix
                + (float)$r->aviansys_amount + (float)$r->aviansys_gst
                + (float)$r->management_amount + (float)$r->marrs_gst
                + (float)$r->total_maker_amount;
            $retained = (float)$r->MaRRS_bal + (float)$r->razpay_service;
            $gap = round((float)$r->total_amount - ($allocated + $retained), 2);
            $row['recon_gap'] = $gap;
            $row['recon_ok']  = (abs($gap) < 1);

            $has_token = !empty($fcm_by_prid[$r->prid]);
            $row['has_token'] = $has_token;

            // paid but no CIN = the failure we guard against
            if ((int)$r->status === 1 && count($cins) === 0) { $paid_no_cin++; }
            $wc_rows[] = $row;

            $cin_rows[] = [
                'order_id'   => $r->payment_id,
                'prid'       => $r->prid,
                'name'       => $r->name,
                'total'      => $r->total_amount,
                'status'     => (int)$r->status,
                'cin_count'  => count($cins),
                'cins'       => array_slice($cins, 0, 8),
                'has_token'  => $has_token,
                'recon_gap'  => $gap,
                'recon_ok'   => (abs($gap) < 1),
            ];
        }

        // enrich CIN rows: split/activation/action flags
        $wc_cin_rows = [];
        foreach ($webhook_cin as $r) {
            $row = (array)$r;
            $row['flow'] = 'cin';
            $row['in_split'] = !empty($split_by_order[$r->payment_id]);
            $row['needs_split'] = empty($split_by_order[$r->payment_id]);
            $row['activated'] = isset($active_map[$r->payment_id]) ? $active_map[$r->payment_id] : 0;
            $row['pending_items'] = isset($pending_map[$r->payment_id]) ? $pending_map[$r->payment_id] : 0;
            $row['needs_activation'] = ($row['pending_items'] > 0 && $row['activated'] == 0);
            $wc_cin_rows[] = $row;
        }

        $summary = [
            'deliveries'        => $logs['webhook']['counts']['deliveries'],
            'verified'          => $logs['webhook']['counts']['verified'],
            'invalid_signature' => $logs['webhook']['counts']['invalid'],
            'no_signature'      => $logs['webhook']['counts']['no_signature'],
            'on_hold_errors'    => $logs['webhook']['counts']['on_hold'],
            'delegate_failed'   => $logs['webhook']['counts']['delegate_failed'],
            'splitpay_errors'   => $logs['splitpay']['counts']['errors'],
            'ev_captured'       => $logs['splitpay']['counts']['ev_captured'],
            'ev_order_paid'     => $logs['splitpay']['counts']['ev_order_paid'],
            'ev_transfer'       => $logs['splitpay']['counts']['ev_transfer'],
            'ev_authorized'     => $logs['splitpay']['counts']['ev_authorized'],
            'ev_failed'         => $logs['splitpay']['counts']['ev_failed'],
            'notify_sent'       => $logs['splitpay']['counts']['notify_sent'],
            'notify_failed'     => $logs['splitpay']['counts']['notify_failed'],
            'php_errors'        => $logs['php']['counts']['errors'],
            'wc_pending'        => $status['pending'],
            'wc_processing'     => $status['processing'],
            'wc_done'           => $status['done'],
            'splits_prid'       => count($split_prid),
            'splits'            => count($split),
            'cin_orders'        => count($webhook_cin),
            'cin_done'          => count(array_filter($webhook_cin, function ($r) { return (int)$r->status === 1; })),
            'needs_split'       => count(array_filter($wc_rows, function ($r) { return !empty($r['needs_split']) && (int)$r['status'] !== 1; }))
                                + count(array_filter($wc_cin_rows, function ($r) { return !empty($r['needs_split']) && (int)$r['status'] !== 1; })),
            'needs_activation'  => count(array_filter($wc_cin_rows, function ($r) { return !empty($r['needs_activation']); })),
            'makers_paid'       => $makers_paid,
            'makers_unpaid'     => $makers_unpaid,
            'cins_total'        => $cins_total,
            'paid_no_cin'       => $paid_no_cin,
        ];

        $paid_cart_items = [];
        if ($this->db->table_exists('payment_success_items')) {
            $paid_cart_items = $this->db->where('created_at >=', $since_dt)
                ->order_by('id', 'DESC')
                ->limit(1000)
                ->get('payment_success_items')
                ->result_array();
        }

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode([
            'generated_at'  => date('Y-m-d H:i:s'),
            'window_hours'  => $days * 24,
            'window_days'   => $days,
            'summary'       => $summary,
            'keys'          => $keys_status,
            'webhook_calls' => $wc_rows,
            'split_prid'    => $split_prid,
            'split'         => $split,
            'makers'        => $maker_rows,
            'webhook_cin'   => $wc_cin_rows,
            'amount_cart'   => $amount_cart,
            'paid_cart_items' => $paid_cart_items,
            'cins'          => $cin_rows,
            'logs'          => $logs,
        ]);
    }

    public function razorpay_payments()
    {
        if (strtoupper((string)$this->input->method(TRUE)) !== 'POST') {
            return $this->output->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'POST is required.']));
        }

        $day = trim((string)$this->input->post('day'));
        $parts = explode('-', $day);
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/D', $day) || count($parts) !== 3
            || !checkdate((int)$parts[1], (int)$parts[2], (int)$parts[0])) {
            return $this->output->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Choose a valid day in YYYY-MM-DD format.']));
        }
        $result = Splitpay::razorpay_payments_for_day($day);
        if (empty($result['success'])) {
            return $this->output->set_status_header(502)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => $result['error']]));
        }

        $this->db->query(
            "CREATE TABLE IF NOT EXISTS razorpay_payments (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                payment_id VARCHAR(80) NOT NULL,
                order_id VARCHAR(100) NOT NULL DEFAULT '',
                status VARCHAR(40) NOT NULL DEFAULT '',
                amount DECIMAL(14,2) NULL,
                currency VARCHAR(12) NOT NULL DEFAULT '',
                method VARCHAR(40) NOT NULL DEFAULT '',
                captured TINYINT(1) NOT NULL DEFAULT 0,
                contact VARCHAR(80) NOT NULL DEFAULT '',
                email VARCHAR(190) NOT NULL DEFAULT '',
                created_at DATETIME NULL,
                razorpay_created_at BIGINT NULL,
                payment_json LONGTEXT NOT NULL,
                synced_at DATETIME NOT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY uq_razorpay_payment_id (payment_id),
                KEY idx_razorpay_order_id (order_id),
                KEY idx_razorpay_created_at (razorpay_created_at),
                KEY idx_razorpay_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
        );
        $table_error = $this->db->error();
        if (!empty($table_error['code'])) {
            log_message('error', 'Splitmonitor could not create razorpay_payments: ' . $table_error['message']);
            return $this->output->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Could not prepare local Razorpay payment storage.']));
        }

        $synced = [];
        foreach ($result['payments'] as $payment) {
            if (empty($payment['id'])) {
                return $this->output->set_status_header(502)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Razorpay returned a payment without an ID; sync stopped.']));
            }

            $raw_json = json_encode($payment);
            if ($raw_json === false) {
                return $this->output->set_status_header(500)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Could not encode a Razorpay payment for local storage.']));
            }

            $created_at = !empty($payment['created_at']) ? date('Y-m-d H:i:s', (int)$payment['created_at']) : null;
            $record = [
                'payment_id' => (string)$payment['id'],
                'order_id' => isset($payment['order_id']) ? (string)$payment['order_id'] : '',
                'status' => isset($payment['status']) ? (string)$payment['status'] : '',
                'amount' => isset($payment['amount']) ? ((float)$payment['amount'] / 100) : null,
                'currency' => isset($payment['currency']) ? (string)$payment['currency'] : '',
                'method' => isset($payment['method']) ? (string)$payment['method'] : '',
                'captured' => !empty($payment['captured']) ? 1 : 0,
                'contact' => isset($payment['contact']) ? (string)$payment['contact'] : '',
                'email' => isset($payment['email']) ? (string)$payment['email'] : '',
                'created_at' => $created_at,
                'razorpay_created_at' => isset($payment['created_at']) ? (int)$payment['created_at'] : null,
                'payment_json' => $raw_json,
                'synced_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->query(
                'INSERT INTO razorpay_payments
                    (payment_id, order_id, status, amount, currency, method, captured, contact, email, created_at, razorpay_created_at, payment_json, synced_at)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE
                    order_id = VALUES(order_id), status = VALUES(status), amount = VALUES(amount),
                    currency = VALUES(currency), method = VALUES(method), captured = VALUES(captured),
                    contact = VALUES(contact), email = VALUES(email), created_at = VALUES(created_at),
                    razorpay_created_at = VALUES(razorpay_created_at), payment_json = VALUES(payment_json),
                    synced_at = VALUES(synced_at)',
                array_values($record)
            );
            $insert_error = $this->db->error();
            if (!empty($insert_error['code'])) {
                log_message('error', 'Splitmonitor Razorpay sync failed for ' . $record['payment_id'] . ': ' . $insert_error['message']);
                return $this->output->set_status_header(500)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Local database write failed while syncing Razorpay payments.']));
            }
            $synced[] = $payment;
        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'day' => $result['day'],
                'synced_count' => count($synced),
                'payments' => $synced,
            ]));
    }

    public function order_detail()
    {
        if (strtoupper((string)$this->input->method(TRUE)) !== 'POST') {
            return $this->output->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'POST is required.']));
        }

        $order_id = trim((string)$this->input->post('order_id'));
        if (!preg_match('/^order_[A-Za-z0-9_-]{1,100}$/', $order_id)) {
            return $this->output->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Enter a valid Razorpay order ID.']));
        }

        $webhook = $this->get_order_rows('webhook_calls', $order_id, [
            'payment_id', 'prid', 'cin', 'name', 'product_name', 'total_amount',
            'status', 'inserted_date', 'inserted_time', 'date_of_payment', 'comp_id',
        ]);
        $webhook_cin = $this->get_order_rows('webhook_calls_cin', $order_id, [
            'payment_id', 'prid', 'cin', 'name', 'product_name', 'total_amount',
            'status', 'inserted_date', 'inserted_time', 'date_of_payment', 'comp_id',
        ]);
        $split_prid = $this->get_order_rows('payment_split_prid', $order_id, [
            'pay_id', 'payment_id', 'prid', 'total_amount', 'franchise_amount',
            'franchise_gst', 'franchise_tranfer_id', 'school_amount', 'associate_amount',
            'associate_gst', 'associate_tranfer_id', 'crm_fix', 'crm_fix_tranfer_id',
            'it_fix', 'it_fix_tranfer_id', 'aviansys_amount', 'aviansys_gst',
            'aviansys_tranfer_id', 'management_amount', 'management_tranfer_id',
            'gst_amount', 'gst_tranfer_id', 'total_maker_amount', 'maker_transfer_id',
            'MaRRS_bal', 'razpay_service', 'status', 'date_of_payment',
        ]);
        $split = $this->get_order_rows('payment_split', $order_id, [
            'pay_id', 'payment_id', 'cin', 'total_amount', 'franchise_amount',
            'franchise_gst', 'franchise_tranfer_id', 'school_amount', 'associate_amount',
            'associate_gst', 'associate_tranfer_id', 'crm_fix', 'crm_fix_tranfer_id',
            'it_fix', 'it_fix_tranfer_id', 'aviansys_amount', 'aviansys_gst',
            'aviansys_tranfer_id', 'management_amount', 'management_tranfer_id',
            'gst_amount', 'gst_tranfer_id', 'total_maker_amount', 'maker_transfer_id',
            'MaRRS_bal', 'razpay_service', 'status', 'date_of_payment',
        ]);
        $makers = $this->get_order_rows('makers_splits', $order_id, [
            'id', 'order_id', 'title', 'maker_id', 'price', 'transaction_id',
            'product_name', 'state', 'prid',
        ], 'id', 'DESC', 500);
        $products = $this->get_order_rows('product_purchase', $order_id, [
            'id', 'payment_id', 'prid', 'cin', 'product_name', 'student_name',
            'amount', 'who',
        ], 'id', 'ASC', 100);

        $cins = [];
        foreach (array_merge($webhook, $webhook_cin, $products) as $row) {
            if (!empty($row['cin'])) {
                $cins[$row['cin']] = $row['cin'];
            }
        }
        $cins = array_values($cins);

        $contact = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'cin' => !empty($cins) ? implode(', ', $cins) : '',
            'prid' => !empty($webhook[0]['prid']) ? $webhook[0]['prid'] : '',
        ];
        $contacts = [];

        if (!empty($contact['prid']) && $this->db->table_exists('students')) {
            $fields = array_intersect(
                ['PRID', 'first_name', 'middle_name', 'last_name', 'student_name', 'email', 'mobile'],
                $this->db->list_fields('students')
            );
            if (in_array('PRID', $fields, true)) {
                $this->db->select($fields);
                $student = $this->db->get_where('students', ['PRID' => $contact['prid']])->row_array();
                if ($student) {
                    $name = trim(implode(' ', array_filter([
                        isset($student['first_name']) ? $student['first_name'] : '',
                        isset($student['middle_name']) ? $student['middle_name'] : '',
                        isset($student['last_name']) ? $student['last_name'] : '',
                    ])));
                    $contact['name'] = $name !== '' ? $name : (isset($student['student_name']) ? $student['student_name'] : '');
                    $contact['email'] = isset($student['email']) ? $student['email'] : '';
                    $contact['phone'] = isset($student['mobile']) ? $student['mobile'] : '';
                    $contacts[] = [
                        'name' => $contact['name'],
                        'phone' => $contact['phone'],
                        'email' => $contact['email'],
                        'cin' => '',
                        'source' => 'student record',
                    ];
                }
            }
        }

        if (!empty($cins) && $this->db->table_exists('cin_list')) {
            $fields = array_intersect(
                ['cin', 'student_name', 'stud_phone', 'stud_email', 'prid'],
                $this->db->list_fields('cin_list')
            );
            if (in_array('cin', $fields, true)) {
                $this->db->select($fields);
                $cin_rows = $this->db->where_in('cin', $cins)->limit(100)->get('cin_list')->result_array();
                foreach ($cin_rows as $row) {
                    $entry = [
                        'name' => isset($row['student_name']) ? $row['student_name'] : '',
                        'phone' => isset($row['stud_phone']) ? $row['stud_phone'] : '',
                        'email' => isset($row['stud_email']) ? $row['stud_email'] : '',
                        'cin' => isset($row['cin']) ? $row['cin'] : '',
                        'source' => 'CIN record',
                    ];
                    $contacts[] = $entry;
                    if ($contact['name'] === '') { $contact['name'] = $entry['name']; }
                    if ($contact['phone'] === '') { $contact['phone'] = $entry['phone']; }
                    if ($contact['email'] === '') { $contact['email'] = $entry['email']; }
                }
            }
        }

        foreach ($webhook_cin as $row) {
            if ($contact['name'] === '' && !empty($row['name'])) { $contact['name'] = $row['name']; }
        }
        foreach ($products as $row) {
            if ($contact['name'] === '' && !empty($row['student_name'])) { $contact['name'] = $row['student_name']; }
        }

        $razorpay = Splitpay::razorpay_order_status($order_id);
        if ($contact['phone'] === '' && !empty($razorpay['contact'])) { $contact['phone'] = $razorpay['contact']; }
        if ($contact['email'] === '' && !empty($razorpay['email'])) { $contact['email'] = $razorpay['email']; }

        $found = !empty($webhook) || !empty($webhook_cin) || !empty($split_prid)
            || !empty($split) || !empty($makers) || !empty($products);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'success' => true,
                'found' => $found,
                'order_id' => $order_id,
                'flow' => !empty($webhook_cin) ? 'CIN' : (!empty($webhook) ? 'PRID' : 'UNKNOWN'),
                'webhook_calls' => $webhook,
                'webhook_calls_cin' => $webhook_cin,
                'split_prid' => $split_prid,
                'split' => $split,
                'makers' => $makers,
                'products' => $products,
                'contact' => $contact,
                'contacts' => $contacts,
                'razorpay' => $razorpay,
            ]));
    }

    private function get_order_rows($table, $order_id, array $allowed_fields, $order_by = null, $direction = 'ASC', $limit = 100)
    {
        if (!$this->db->table_exists($table)) {
            return [];
        }

        $fields = array_values(array_intersect($allowed_fields, $this->db->list_fields($table)));
        if (!in_array('payment_id', $fields, true) && !in_array('order_id', $fields, true)) {
            return [];
        }

        $this->db->select($fields)->where(
            in_array('payment_id', $fields, true) ? 'payment_id' : 'order_id',
            $order_id
        );
        if ($order_by && in_array($order_by, $this->db->list_fields($table), true)) {
            $this->db->order_by($order_by, $direction === 'DESC' ? 'DESC' : 'ASC');
        }
        return $this->db->limit((int)$limit)->get($table)->result_array();
    }

    private function find_order_row(array $rows, $order_id)
    {
        foreach ($rows as $row) {
            if (isset($row->payment_id) && $row->payment_id === $order_id) {
                return $row;
            }
        }
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Log scanners
    |--------------------------------------------------------------------------
    */

    /** splitpay.log (small - read whole file). */
    private function scan_splitpay_log($cutoff)
    {
        $counts = [
            'entries' => 0, 'errors' => 0,
            'ev_captured' => 0, 'ev_order_paid' => 0, 'ev_transfer' => 0,
            'ev_authorized' => 0, 'ev_failed' => 0, 'notify_sent' => 0, 'notify_failed' => 0,
        ];
        $errors = [];
        $file = APPPATH . 'logs/splitpay.log';
        if (!is_file($file)) {
            return ['counts' => $counts, 'errors' => $errors];
        }
        foreach (file($file, FILE_IGNORE_NEW_LINES) as $line) {
            $ts = 0;
            if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $line, $m)) {
                $ts = strtotime($m[1]);
            }
            if ($ts < $cutoff) { continue; }
            $counts['entries']++;

            // Informational webhook payload: count real events, NEVER an "error".
            // (Razorpay payloads always contain error_code/error_description:null,
            //  which a naive case-insensitive /ERROR/ regex would falsely match.)
            if (strpos($line, 'WEBHOOK RAW:') !== false) {
                if (strpos($line, '"payment.captured"')    !== false) { $counts['ev_captured']++; }
                elseif (strpos($line, '"order.paid"')      !== false) { $counts['ev_order_paid']++; }
                elseif (strpos($line, '"transfer.processed"') !== false) { $counts['ev_transfer']++; }
                elseif (strpos($line, '"payment.authorized"') !== false) { $counts['ev_authorized']++; }
                elseif (strpos($line, '"payment.failed"')  !== false) { $counts['ev_failed']++; }
                continue;
            }

            // notification outcome lines (informational, not errors)
            if (strpos($line, 'NOTIFY ') !== false && strpos($line, ': sent ') !== false) { $counts['notify_sent']++; }
            if (strpos($line, 'NOTIFY ') !== false && strpos($line, ': FAILED ') !== false) { $counts['notify_failed']++; }

            // Only OUR own error wording counts (no bare /ERROR/i - avoids false positives).
            $is_error = (bool)preg_match(
                '/: ERROR\b|no webhook_calls row|DELEGATE FAILED|WEBHOOK: exception|insert failed|NOTIFY ERROR/i',
                $line
            );
            if ($is_error) {
                $counts['errors']++;
                if (count($errors) < 150) {
                    $errors[] = ['ts' => date('Y-m-d H:i:s', $ts), 'line' => mb_substr($line, 0, 500)];
                }
            }
        }
        return ['counts' => $counts, 'errors' => $errors];
    }

    /** webhook.log - tail only (file is 19+ MB). */
    private function scan_webhook_log($cutoff)
    {
        $counts = ['deliveries' => 0, 'verified' => 0, 'invalid' => 0, 'no_signature' => 0, 'on_hold' => 0, 'delegate_failed' => 0];
        $errors = [];
        $file = APPPATH . 'logs/webhook.log';
        if (!is_file($file)) {
            return ['counts' => $counts, 'errors' => $errors];
        }

        $fp = fopen($file, 'rb');
        $size = filesize($file);
        $start = max(0, $size - self::TAIL_BYTES);
        fseek($fp, $start);
        $chunk = fread($fp, self::TAIL_BYTES);
        fclose($fp);
        if ($start > 0) {
            $nl = strpos($chunk, "\n");                 // drop partial first line
            if ($nl !== false) { $chunk = substr($chunk, $nl + 1); }
        }

        $last_ts = 0;
        foreach (explode("\n", $chunk) as $line) {
            if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $line, $m)) {
                $last_ts = strtotime($m[1]);
            }
            $in_window = $last_ts >= $cutoff;

            if ($in_window) {
                if (strpos($line, 'RAW:') !== false) { $counts['deliveries']++; }
                if (strpos($line, 'Signature verified') !== false) { $counts['verified']++; }
            }

            $kind = '';
            if (strpos($line, 'Invalid signature') !== false)       { $kind = 'invalid'; }
            elseif (strpos($line, 'No signature header') !== false) { $kind = 'no_signature'; }
            elseif (strpos($line, 'DELEGATE FAILED') !== false)     { $kind = 'delegate_failed'; }
            elseif (strpos($line, 'on_hold_until') !== false
                 || strpos($line, 'BAD_REQUEST') !== false)         { $kind = 'razorpay_rejected'; }

            if ($kind !== '' && $in_window) {
                $counts[$kind === 'razorpay_rejected' ? 'on_hold' : $kind]++;
                if (count($errors) < 150) {
                    $errors[] = ['ts' => $last_ts ? date('Y-m-d H:i:s', $last_ts) : '?', 'kind' => $kind, 'line' => mb_substr(trim($line), 0, 400)];
                }
            }
        }
        return ['counts' => $counts, 'errors' => $errors];
    }

    /** student_registration/error_log - PHP fatals/warnings. */
    private function scan_php_error_log($cutoff)
    {
        $counts = ['errors' => 0];
        $errors = [];
        $file = FCPATH . 'error_log';
        if (!is_file($file)) {
            return ['counts' => $counts, 'errors' => $errors];
        }
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach (array_slice($lines, -500) as $line) {
            $ts = 0;
            if (preg_match('/^\[(\d{2}-[A-Za-z]{3}-\d{4} \d{2}:\d{2}:\d{2})/', $line, $m)) {
                $d = DateTime::createFromFormat('d-M-Y H:i:s', $m[1]);
                if ($d) { $ts = $d->getTimestamp(); }
            }
            if ($ts < $cutoff) { continue; }
            $counts['errors']++;
            if (count($errors) < 150) {
                $errors[] = ['ts' => date('Y-m-d H:i:s', $ts), 'line' => mb_substr($line, 0, 600)];
            }
        }
        return ['counts' => $counts, 'errors' => $errors];
    }
}
