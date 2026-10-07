<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Lunar Razorpay Subscription Controller
 * File:  application/controllers/Lunar.php
 * Class: Lunar  ← matches URL  marrs.in/lunar/Lunar/...
 *
 * Flow: Enter Name/Email → Verify OTP → Check Registration →
 *       Select Products → Cart → Payment → Generate CIN
 *
 * CIN Format: 26LUAB1100001
 *   YY(2) + LU(2) + Series(2) + Level(2) + RunningNo(5)
 */
class Lunar extends CI_Controller {

    // ─── Razorpay Keys ───────────────────────────────────────────────────────
    // ⚠️  Move these to application/config/config.php in production
    private $rp_key_id     = 'rzp_live_kG7f8nF6sKGPhx';
    private $rp_key_secret = '68nusLbguizulOSBn47VpfmS';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lunar_subscription_model', 'lsm');
        $this->load->library(['session', 'email', 'form_validation']);
        $this->load->helper(['url', 'form']);
       
    }

    // =========================================================================
    // STEP 1 – Landing: Enter Name & Email
    // =========================================================================
    public function index()
    {
        $this->load->view('lunar_subscription/step1_email');
    }

    // =========================================================================
    // STEP 2 – Send OTP to email (AJAX)
    // =========================================================================
    public function send_otp()
    {
        $email = trim($this->input->post('email'));
        $name  = trim($this->input->post('name'));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
            return;
        }

        $otp = rand(100000, 999999);

        $this->session->set_userdata([
            'otp_email'   => $email,
            'otp_name'    => $name,
            'otp_code'    => $otp,
            'otp_expires' => time() + 600  // 10 minutes
        ]);

        // ── Brevo API ─────────────────────────────────────────────────────────
        $apiKey = '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';
        $url    = 'https://api.brevo.com/v3/smtp/email';

        $emailData = [
            'sender'      => ['name' => 'MaRRS Enquiry', 'email' => 'donotreply@marrs.in'],
            'to'          => [['email' => $email, 'name' => $name]],
            'subject'     => 'Your Lunar OTP Verification Code',
            'htmlContent' => "
                <p>Dear {$name},</p>
                <p>Your OTP for Lunar subscription is: <strong style='font-size:24px'>{$otp}</strong></p>
                <p>This OTP is valid for 10 minutes.</p>
                <p>– Lunar Team</p>
            ",
            'textContent' => "Dear {$name}, Your OTP is: {$otp}. Valid for 10 minutes. – Lunar Team",
            'tracking'    => ['clicks' => false, 'opens' => false]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($emailData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            "api-key: {$apiKey}",
            'content-type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // ── End Brevo API ─────────────────────────────────────────────────────

        if ($httpCode == 200 || $httpCode == 201) {
            echo json_encode(['status' => 'success', 'message' => 'OTP sent to ' . $email]);
        } else {
            $error = json_decode($response, true);
            $msg   = $error['message'] ?? 'Failed to send OTP. Try again.';
            echo json_encode(['status' => 'error', 'message' => $msg]);
        }
    }

    // =========================================================================
    // STEP 3 – Verify OTP (AJAX)
    // =========================================================================
    public function verify_otp()
    {
        $otp_input  = trim($this->input->post('otp'));
        $otp_stored = $this->session->userdata('otp_code');
        $expires    = $this->session->userdata('otp_expires');
        $email      = $this->session->userdata('otp_email');

        if (empty($otp_stored)) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired. Please restart.']);
            return;
        }

        if (time() > $expires) {
            echo json_encode(['status' => 'error', 'message' => 'OTP expired. Please request a new one.']);
            return;
        }

        if ($otp_input != $otp_stored) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid OTP. Please try again.']);
            return;
        }

        // OTP correct – mark as verified
        $this->session->set_userdata('otp_verified', true);

        // Check if already fully registered
        $existing = $this->db
            ->where('stud_email', $email)
            ->like('cin', 'LU')
            ->where('prid IS NOT NULL', null, false)
            ->get('cin_list')
            ->row();

        if (!empty($existing)) {
            $this->session->set_userdata('cin', $existing->cin);
            echo json_encode([
                'status'   => 'registered',
                'message'  => 'Already registered.',
                'redirect' => site_url('Cin_login/index')
            ]);
            return;
        }

        // Check for partial registration
        $prid_row = $this->db
            ->get_where('lunar_prid', ['email' => $email])
            ->row();

        echo json_encode([
            'status'   => 'success',
            'message'  => 'OTP verified.',
            'has_prid' => !empty($prid_row)
        ]);
    }

    // =========================================================================
    // STEP 4 – Product selection page
    // =========================================================================
    public function products()
    {
        if (!$this->session->userdata('otp_verified')) {
            redirect(site_url('Lunar'));
            return;
        }

        $associate_link_id = 1;

        $data['schedules'] = $this->lsm->get_schedules_for_associate($associate_link_id);
        $data['email']     = $this->session->userdata('otp_email');
        $data['name']      = $this->session->userdata('otp_name');

        $this->load->view('lunar_subscription/step2_products', $data);
    }

    // =========================================================================
    // STEP 5 – Get schedule options for class + subject (AJAX)
    // =========================================================================
    public function get_schedule_options()
    {
        $class             = $this->input->post('class');
        $subject           = $this->input->post('subject');
        $associate_link_id = $this->session->userdata('associate_link_id');

        $data = $this->lsm->get_eligible_schedules($class, $subject, $associate_link_id);
        echo json_encode($data);
    }

    // =========================================================================
    // STEP 6 – Cart page
    // =========================================================================
    public function cart()
    {
        
        if (!$this->session->userdata('otp_verified')) {
            redirect(base_url('Lunar'));
            return;
        }

        $cart_items = $this->session->userdata('cart') ?? [];

        if (empty($cart_items)) {
            redirect(site_url('Lunar/products'));
            return;
        }

        $data['cart']  = $cart_items;
        $data['total'] = array_sum(array_column($cart_items, 'amount'));
        $data['email'] = $this->session->userdata('otp_email');
        $data['name']  = $this->session->userdata('otp_name');

        $this->load->view('lunar_subscription/step3_cart', $data);
    }

    // =========================================================================
    // STEP 6a – Add item to cart (AJAX)
    // =========================================================================
    public function add_to_cart()
    {
        if (!$this->session->userdata('otp_verified')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
            return;
        }

        $schedule_id       = $this->input->post('lunar_schedule_id');
        $associate_link_id = 1;

        if (empty($schedule_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing schedule ID.']);
            return;
        }

        $schedule = $this->db
            ->select('lunar_schedule_cin.*, associatelink_to_lunar.amount AS price_amount')
            ->from('associatelink_to_lunar')
            ->join('lunar_schedule_cin', 'associatelink_to_lunar.lunar_schedule_id = lunar_schedule_cin.lunar_schedule_id')
            ->where('associatelink_to_lunar.lunar_schedule_id', $schedule_id)
            ->where('associatelink_to_lunar.associate_link_id', $associate_link_id)
            ->get()->row();

        if (empty($schedule)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid schedule.']);
            return;
        }

        $cart = $this->session->userdata('cart') ?? [];

        foreach ($cart as $item) {
            if ($item['lunar_schedule_id'] == $schedule_id) {
                echo json_encode(['status' => 'error', 'message' => 'Already in cart.']);
                return;
            }
        }

        $cart[] = [
            'lunar_schedule_id' => $schedule->lunar_schedule_id,
            'series'            => $schedule->series,
            'subject'           => $schedule->subject,
            'level'             => $schedule->level_id,
            'type'              => $schedule->type,
            'amount'            => $schedule->price_amount,
            'registration_code' => $schedule->registration_code,
        ];

        $this->session->set_userdata('cart', $cart);
        echo json_encode(['status' => 'success', 'cart_count' => count($cart)]);
    }

    // =========================================================================
    // STEP 6b – Remove item from cart (AJAX)
    // =========================================================================
    public function remove_from_cart()
    {
        if (!$this->session->userdata('otp_verified')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
            return;
        }

        $schedule_id = $this->input->post('lunar_schedule_id');

        if (empty($schedule_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing schedule ID.']);
            return;
        }

        $cart = $this->session->userdata('cart') ?? [];
        $cart = array_values(array_filter($cart, function ($i) use ($schedule_id) {
            return $i['lunar_schedule_id'] != $schedule_id;
        }));

        $this->session->set_userdata('cart', $cart);

        $new_total = array_sum(array_column($cart, 'amount'));

        echo json_encode([
            'status'     => 'success',
            'cart_count' => count($cart),
            'new_total'  => $new_total   // ✅ used by JS to update price display
        ]);
    }

    // =========================================================================
    // STEP 7 – Create Razorpay Order (AJAX)
    // =========================================================================
    public function create_razorpay_order()
    {
        if (!$this->session->userdata('otp_verified')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized.']);
            return;
        }

        $cart  = $this->session->userdata('cart') ?? [];
        $total = array_sum(array_column($cart, 'amount'));

        if (empty($cart) || $total <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid cart total.']);
            return;
        }

        $order_data = json_encode([
            'amount'          => $total * 100, // in paise
            'currency'        => 'INR',
            'receipt'         => 'LU_' . time(),
            'payment_capture' => 1
        ]);

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt_array($ch, [
            CURLOPT_USERPWD        => $this->rp_key_id . ':' . $this->rp_key_secret,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $order_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json']
        ]);
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (!empty($response['id'])) {
            $this->session->set_userdata('razorpay_order_id', $response['id']);
            echo json_encode([
                'status'   => 'success',
                'order_id' => $response['id'],
                'amount'   => $total * 100,
                'key_id'   => $this->rp_key_id,
                'name'     => $this->session->userdata('otp_name'),
                'email'    => $this->session->userdata('otp_email')
            ]);
        } else {
            log_message('error', 'Razorpay order creation failed: ' . json_encode($response));
            echo json_encode(['status' => 'error', 'message' => 'Failed to create payment order. Please try again.']);
        }
    }

    // =========================================================================
    // STEP 8 – Payment callback & CIN generation (POST from hidden form)
    // =========================================================================
    public function payment_success()
    {
        $rp_order_id   = $this->input->post('razorpay_order_id');
        $rp_payment_id = $this->input->post('razorpay_payment_id');
        $rp_signature  = $this->input->post('razorpay_signature');

        // ── Verify Razorpay signature ─────────────────────────────────────────
        $expected = hash_hmac('sha256', $rp_order_id . '|' . $rp_payment_id, $this->rp_key_secret);

        if (!hash_equals($expected, $rp_signature)) {
            show_error('Payment verification failed. Please contact support.', 403);
            return;
        }

        $email = $this->session->userdata('otp_email');
        $name  = $this->session->userdata('otp_name');
        $cart  = $this->session->userdata('cart') ?? [];

        if (empty($cart)) {
            show_error('Cart is empty. Please try again.', 400);
            return;
        }

        // Prevent duplicate registration
        $existing = $this->db
            ->where('stud_email', $email)
            ->like('cin', 'LU')
            ->get('cin_list')->row();

        if (!empty($existing)) {
            redirect(site_url('Cin_login/index'));
            return;
        }

        $generated_cins = [];

        $this->db->trans_start();

        foreach ($cart as $item) {

            $schedule = $this->db->get_where('lunar_schedule_cin',
                ['lunar_schedule_id' => $item['lunar_schedule_id']])->row();

            if (empty($schedule)) continue;

            $period   = $this->db->get_where('period', ['period_id' => $schedule->period_id])->row();
            $initials = $period ? $period->initials : date('y');

            // ── Generate PRID ─────────────────────────────────────────────────
            $last_prid_row = $this->db
                ->where('period_id', $schedule->period_id)
                ->order_by('lunar_prid_id', 'DESC')
                ->limit(1)
                ->get('lunar_prid')->row();

            $last_prid = $last_prid_row ? $last_prid_row->prid : '';
            $prid      = $this->_generate_prid($initials, $item['series'], $last_prid);

            // ── Insert into lunar_prid ────────────────────────────────────────
            $this->db->insert('lunar_prid', [
                'name'              => $name,
                'email'             => $email,
                'class'             => $this->session->userdata('student_class') ?? '',
                'sch_id'            => $item['lunar_schedule_id'],
                'period_id'         => $schedule->period_id,
                'series'            => $item['series'],
                'subject'           => $item['subject'],
                'level'             => $item['level'],
                'type'              => $item['type'],
                'prid'              => $prid,
                'amount'            => $item['amount'],
                'associate_id'      => $this->session->userdata('associate_id') ?? null,
                'franchise_id'      => $this->session->userdata('franchise_id') ?? null,
                'associate_link_id' => $this->session->userdata('associate_link_id') ?? 1,
                'created_date'      => date('Y-m-d'),
            ]);

            // ── Generate CIN ──────────────────────────────────────────────────
            $cin = $this->_generate_cin($item['series'], $item['level']);

            // ── Insert into cin_list ──────────────────────────────────────────
            $this->db->insert('cin_list', [
                'cin'               => $cin,
                'prid'              => $prid,
                'stud_email'        => $email,
                'stud_name'         => $name,
                'lunar_schedule_id' => $item['lunar_schedule_id'],
                'created_date'      => date('Y-m-d'),
            ]);

            // ── Log payment ───────────────────────────────────────────────────
            $this->db->insert('lunar_payment_log', [
                'email'               => $email,
                'prid'                => $prid,
                'cin'                 => $cin,
                'razorpay_order_id'   => $rp_order_id,
                'razorpay_payment_id' => $rp_payment_id,
                'amount'              => $item['amount'],
                'status'              => 'success',
                'created_date'        => date('Y-m-d H:i:s'),
            ]);

            $generated_cins[] = [
                'cin'     => $cin,
                'prid'    => $prid,
                'subject' => $item['subject'],
                'series'  => $item['series'],
                'amount'  => $item['amount']
            ];
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            log_message('error', 'CIN generation failed for payment: ' . $rp_payment_id);
            show_error('Registration failed after payment. Contact support with Payment ID: ' . $rp_payment_id, 500);
            return;
        }

        $this->session->set_userdata('generated_cins', $generated_cins);
        $this->session->unset_userdata(['cart', 'otp_verified', 'otp_code', 'razorpay_order_id']);

        redirect(site_url('Lunar/success'));
    }

    // =========================================================================
    // STEP 9 – Success page
    // =========================================================================
    public function success()
    {
        $data['cins']  = $this->session->userdata('generated_cins') ?? [];
        $data['name']  = $this->session->userdata('otp_name');
        $data['email'] = $this->session->userdata('otp_email');

        if (empty($data['cins'])) {
            redirect(site_url('Lunar'));
            return;
        }

        $this->load->view('lunar_subscription/step4_success', $data);
    }

    // =========================================================================
    // Private Helpers
    // =========================================================================

    /**
     * Generate PRID
     * Format: {initials}MREG{series}{running}
     */
    private function _generate_prid($initials, $series, $last_prid)
    {
        if (!empty($last_prid) && strpos($last_prid, 'MREG') !== false) {
            $parts      = explode('MREG', $last_prid);
            $prefix     = $initials . 'MREG';
            $after_mreg = $parts[1];
            $series_p   = substr($after_mreg, 0, 4);
            $running    = (int) substr($after_mreg, 4);
            $running++;
            return $prefix . $series_p . str_pad($running, strlen(substr($after_mreg, 4)), '0', STR_PAD_LEFT);
        }

        return $initials . 'MREG' . $initials . '00001';
    }

    /**
     * Generate CIN
     * Format: 26LUAB1100001
     *   YY(2) + LU(2) + Series(2) + Level(2) + RunningNo(5)
     */
    private function _generate_cin($series, $level)
    {
        $yy     = date('y');
        $prefix = $yy . 'LU' . strtoupper(substr($series, 0, 2)) . str_pad($level, 2, '0', STR_PAD_LEFT);

        $last = $this->db
            ->like('cin', $prefix)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('cin_list')
            ->row();

        $next_num = !empty($last) ? ((int) substr($last->cin, -5)) + 1 : 1;

        return $prefix . str_pad($next_num, 5, '0', STR_PAD_LEFT);
    }
}