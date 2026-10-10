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
 * Auth: same dashboard_accounts session as Payment_dashboard.
 */
class Splitmonitor extends CI_Controller
{
    /** Read only the last 2 MB of the (19+ MB) webhook.log. */
    const TAIL_BYTES = 2097152;

    private $account;

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');

        $id = (int)$this->session->userdata('dash_account_id');

        $this->account = $id
            ? $this->db->get_where('dashboard_accounts', [
                'id'         => $id,
                'is_active'  => 1,
                'deleted_at' => NULL,
            ])->row()
            : NULL;

        if (!$this->account) {
            if ($this->router->fetch_method() === 'data') {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Session expired']);
                exit;
            }
            redirect('/dash_login');
            exit;
        }
    }

    public function index()
    {
        $data['account'] = $this->account;
        $this->load->view('splitmonitor.php', $data);
    }

    public function data()
    {
        $cutoff    = time() - 86400;
        $since_day = date('Y-m-d', $cutoff);

        // ---------- webhook_calls (last 24h window by inserted_date) ----------
        $webhook_calls = $this->db->query(
            "SELECT * FROM webhook_calls WHERE inserted_date >= ? ORDER BY id DESC LIMIT 300",
            [$since_day]
        )->result();

        // ---------- splits ----------
        $split_prid = $this->db->query(
            "SELECT * FROM payment_split_prid WHERE date_of_payment >= ? ORDER BY pay_id DESC LIMIT 300",
            [date('Y-m-d H:i:s', $cutoff)]
        )->result();
        $split = $this->db->query(
            "SELECT * FROM payment_split WHERE date_of_payment >= ? ORDER BY pay_id DESC LIMIT 300",
            [date('Y-m-d H:i:s', $cutoff)]
        )->result();

        // ---------- makers for those orders ----------
        $order_ids = [];
        foreach ($webhook_calls as $r) { $order_ids[$r->payment_id] = true; }
        foreach ($split_prid as $r)    { $order_ids[$r->payment_id] = true; }
        $order_ids = array_slice(array_keys(array_filter($order_ids)), 0, 300);

        $makers = [];
        if (!empty($order_ids)) {
            $in  = implode(',', array_fill(0, count($order_ids), '?'));
            $makers = $this->db->query(
                "SELECT * FROM makers_splits WHERE order_id IN ($in) ORDER BY id DESC LIMIT 300",
                $order_ids
            )->result();
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
        foreach ($makers as $m) {
            if (!empty($m->transaction_id)) { $makers_paid++; } else { $makers_unpaid++; }
        }

        $summary = [
            'deliveries'        => $logs['webhook']['counts']['deliveries'],
            'verified'          => $logs['webhook']['counts']['verified'],
            'invalid_signature' => $logs['webhook']['counts']['invalid'],
            'on_hold_errors'    => $logs['webhook']['counts']['on_hold'],
            'delegate_failed'   => $logs['webhook']['counts']['delegate_failed'],
            'splitpay_errors'   => $logs['splitpay']['counts']['errors'],
            'php_errors'        => $logs['php']['counts']['errors'],
            'wc_pending'        => $status['pending'],
            'wc_processing'     => $status['processing'],
            'wc_done'           => $status['done'],
            'splits_prid'       => count($split_prid),
            'splits'            => count($split),
            'makers_paid'       => $makers_paid,
            'makers_unpaid'     => $makers_unpaid,
        ];

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode([
            'generated_at'  => date('Y-m-d H:i:s'),
            'window_hours'  => 24,
            'summary'       => $summary,
            'keys'          => $keys_status,
            'webhook_calls' => $webhook_calls,
            'split_prid'    => $split_prid,
            'split'         => $split,
            'makers'        => $makers,
            'logs'          => $logs,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Log scanners
    |--------------------------------------------------------------------------
    */

    /** splitpay.log (small - read whole file). */
    private function scan_splitpay_log($cutoff)
    {
        $counts = ['entries' => 0, 'errors' => 0];
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
            $is_error = (bool)preg_match(
                '/ERROR|error_transfer|error_missing_maker|claim failed|no webhook_calls row|exception|DELEGATE FAILED/i',
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

