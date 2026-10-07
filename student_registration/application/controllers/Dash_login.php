<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login for the Payment Split Dashboard.
 * Put in: application/controllers/manage/Dash_login.php
 * URL:    /manage/dash_login
 */
class Dash_login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        if ($this->session->userdata('dash_account_id')) {
            redirect('/payment_dashboard');
        }
        $data['error'] = $this->session->flashdata('login_error');
        $this->load->view('dash_login.php', $data);
    }

    public function auth()
    {
        if ($this->input->method() !== 'post') {
            redirect('/dash_login');
        }

        $email    = trim((string) $this->input->post('email', TRUE));
        $password = (string) $this->input->post('password');

        $acc = $this->db->get_where('dashboard_accounts', [
            'email'      => $email,
            'is_active'  => 1,
            'deleted_at' => NULL,
        ])->row();

        if ($acc && hash_equals((string) $acc->password, $password)) {
            $this->session->sess_regenerate(TRUE);
            // Only the id is kept in the session; role and acc_id are
            // read from dashboard_accounts on every request.
            $this->session->set_userdata('dash_account_id', (int) $acc->id);
            $this->db->update('dashboard_accounts',
                ['last_login_at' => date('Y-m-d H:i:s')],
                ['id' => $acc->id]
            );
            redirect('/payment_dashboard');
        }

        $this->session->set_flashdata('login_error', 'Invalid email or password.');
        redirect('/dash_login');
    }

    public function logout()
    {
        $this->session->unset_userdata('dash_account_id');
        redirect('/dash_login');
    }
}