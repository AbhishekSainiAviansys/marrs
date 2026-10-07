<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MaRRS Math Bee – Brevo Reminder Email Sender
 * Controller: BrevoReminder
 *
 * Sends transactional emails via Brevo API (template ID: 915)
 * to all students with comp_id LIKE '%521%' using stud_email.
 *
 * Usage:
 *   CLI  : php index.php brevoreminder send_reminder
 *   Browser: /brevoreminder/send_reminder
 */
class reminder extends CI_Controller {

    // ─── Brevo Config ────────────────────────────────────────────────────────
    private $brevo_api_key  = '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';   // <-- replace
    private $brevo_template = 915;
    private $sender_email   = 'noreply@marrs.in';           // <-- replace
    private $sender_name    = 'Team MaRRS Rediscover';

    // ─── Batch / throttle ────────────────────────────────────────────────────
    private $batch_size     = 50;   // emails per batch
    private $sleep_between  = 1;    // seconds between batches (avoid rate limit)

    // ─────────────────────────────────────────────────────────────────────────

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    // =========================================================================
    // PUBLIC ENTRY POINT
    // =========================================================================

    /**
     * Fetch all records with comp_id LIKE '%521%' and send reminder emails.
     * Skips rows where stud_email is empty or invalid.
     */
    public function send_reminder()
    {
        $students = $this->_get_students();

        if (empty($students)) {
            $this->_log('No students found for comp_id LIKE %521%');
            return;
        }

        $total    = count($students);
        $success  = 0;
        $failed   = 0;
        $skipped  = 0;
        $batches  = array_chunk($students, $this->batch_size);

        $this->_log("Total students found : {$total}");
        $this->_log("Batches              : " . count($batches));
        $this->_log(str_repeat('-', 55));

        foreach ($batches as $batch_no => $batch) {
            $this->_log("Processing batch " . ($batch_no + 1) . " / " . count($batches));

            foreach ($batch as $student) {

                $email = trim($student->stud_email);

                // ── Skip empty / invalid emails ──────────────────────────────
                if (empty($email) || !$this->_is_valid_email($email)) {
                    $this->_log("  SKIP  [{$student->cin}] – invalid email: '{$email}'");
                    $skipped++;
                    continue;
                }

                // ── Build Brevo params ───────────────────────────────────────
                $params = [
                    'student_name' => trim($student->student_name),
                    'cin'          => trim($student->cin),
                    'class'        => trim($student->class),
                    'father_name'  => trim($student->father_name),
                ];

                // ── Send ─────────────────────────────────────────────────────
                $result = $this->_send_brevo_email($email, $params, $student->student_name);

                if ($result['success']) {
                    $this->_log("  OK    [{$student->cin}] → {$email}");
                    $success++;
                } else {
                    $this->_log("  FAIL  [{$student->cin}] → {$email} | " . $result['error']);
                    $failed++;
                }
            }

            // Throttle between batches
            if (($batch_no + 1) < count($batches)) {
                sleep($this->sleep_between);
            }
        }

        // ── Summary ──────────────────────────────────────────────────────────
        $this->_log(str_repeat('=', 55));
        $this->_log("DONE  | Total: {$total} | Sent: {$success} | Failed: {$failed} | Skipped: {$skipped}");
    }

    // =========================================================================
    // PRIVATE HELPERS
    // =========================================================================

    /**
     * Fetch students from cin_uploade where comp_id LIKE '%521%'
     */
    private function _get_students()
    {
        $query = $this->db->query("
            SELECT
                cin,
                student_name,
                stud_email,
                class,
                father_name,
                comp_id
            FROM `cin_uploade`
            WHERE `comp_id` LIKE '%521%'
              AND `status` = 'Active'
            ORDER BY `id` ASC
        ");

        return $query->result();
    }

    /**
     * Send a single transactional email via Brevo REST API
     *
     * @param  string $to_email    Recipient email
     * @param  array  $params      Template variables (student_name, cin, etc.)
     * @param  string $to_name     Recipient display name
     * @return array               ['success' => bool, 'error' => string|null]
     */
    private function _send_brevo_email($to_email, $params, $to_name = '')
    {
        $payload = json_encode([
            'sender' => [
                'name'  => $this->sender_name,
                'email' => $this->sender_email,
            ],
            'to' => [
                [
                    'email' => $to_email,
                    'name'  => $to_name,
                ]
            ],
            'templateId' => (int) $this->brevo_template,
            'params'     => $params,
        ]);

        $ch = curl_init('https://api.brevo.com/v3/smtp/email');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'accept: application/json',
                'api-key: ' . $this->brevo_api_key,
                'content-type: application/json',
            ],
            CURLOPT_TIMEOUT        => 15,
        ]);

        $response    = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error  = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return ['success' => false, 'error' => 'cURL error: ' . $curl_error];
        }

        $decoded = json_decode($response, true);

        // Brevo returns 201 on success
        if ($http_status === 201) {
            return ['success' => true, 'error' => null];
        }

        $msg = isset($decoded['message']) ? $decoded['message'] : $response;
        return ['success' => false, 'error' => "HTTP {$http_status}: {$msg}"];
    }

    /**
     * Basic email validation (filter_var + no spaces)
     */
    private function _is_valid_email($email)
    {
        return (strpos($email, ' ') === false) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Simple log output — works in CLI and browser
     */
    private function _log($msg)
    {
        $line = '[' . date('Y-m-d H:i:s') . '] ' . $msg;

        if (is_cli()) {
            echo $line . PHP_EOL;
        } else {
            echo $line . '<br>' . PHP_EOL;
            @ob_flush(); @flush();
        }

        log_message('info', 'BrevoReminder: ' . $msg);
    }
}
