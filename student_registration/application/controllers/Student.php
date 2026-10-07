<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MaRRS Student Portal Controller
 * File: application/controllers/Student.php
 */
class Student extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        //$this->load->model('Program_model');
        $this->load->library(['session', 'email', 'form_validation']);
        $this->load->helper(['url', 'form', 'string']);
    }

    public function register()
    {
        $data['programs'] = $this->db->get_where('products',array('status'=>'active'))->result_array();
        $this->load->view('student/register', $data);
    }

    public function do_register()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|max_length[60]');
        $this->form_validation->set_rules('last_name',  'Last Name',  'required|trim|max_length[60]');
        $this->form_validation->set_rules('email',      'Email',      'required|trim|valid_email');
        $this->form_validation->set_rules('dob',        'Date of Birth', 'required');
        $this->form_validation->set_rules('grade',      'Grade',      'required');
        $this->form_validation->set_rules('program_id', 'Program',    'required|integer');

        if ($this->form_validation->run() === FALSE) {
            return $this->_json_error(validation_errors());
        }

        $access_code = $this->input->post('access_code');
        $school_id   = NULL;
        if (!empty($access_code)) {
            $school = $this->Student_model->validate_school_code(trim($access_code));
            if (!$school) return $this->_json_error('Invalid School Access Code.');
            $school_id = $school->id;
        }

        $cin = $this->_generate_cin();
        $student_data = [
            'cin'        => $cin,
            'first_name' => $this->input->post('first_name', TRUE),
            'last_name'  => $this->input->post('last_name',  TRUE),
            'email'      => $this->input->post('email',      TRUE),
            'dob'        => $this->input->post('dob'),
            'grade'      => $this->input->post('grade',      TRUE),
            'program_id' => (int) $this->input->post('program_id'),
            'school_id'  => $school_id,
            'status'     => 'pending_payment',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $reg_id = $this->Student_model->create_registration($student_data);
        if (!$reg_id) return $this->_json_error('Registration failed. Please try again.');

        $this->Student_model->update_payment_status($reg_id, 'paid');
        $this->_send_welcome_mail($student_data);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => TRUE, 'cin' => $cin, 'message' => 'Registration successful! CIN sent to your email.']));
    }

    public function do_existing()
    {
        $this->form_validation->set_rules('existing_cin', 'Existing CIN', 'required|trim');
        $this->form_validation->set_rules('program_id',   'Program',      'required|integer');

        if ($this->form_validation->run() === FALSE) {
            return $this->_json_error(validation_errors());
        }

        $existing_cin = strtoupper(trim($this->input->post('existing_cin')));
        $program_id   = (int) $this->input->post('program_id');

        $student = $this->Student_model->get_by_cin($existing_cin);
        if (!$student) return $this->_json_error('CIN not found. Please check and try again.');

        $access_code = $this->input->post('access_code');
        $school_id   = $student->school_id;
        if (!empty($access_code)) {
            $school = $this->Student_model->validate_school_code(trim($access_code));
            if (!$school) return $this->_json_error('Invalid School Access Code.');
            $school_id = $school->id;
        }

        $new_cin = $this->_generate_cin();
        $new_reg = [
            'cin'        => $new_cin,
            'first_name' => $student->first_name,
            'last_name'  => $student->last_name,
            'email'      => $student->email,
            'dob'        => $student->dob,
            'grade'      => $student->grade,
            'program_id' => $program_id,
            'school_id'  => $school_id,
            'parent_cin' => $existing_cin,
            'status'     => 'pending_payment',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $reg_id = $this->Student_model->create_registration($new_reg);
        if (!$reg_id) return $this->_json_error('Could not create new registration.');

        $this->Student_model->update_payment_status($reg_id, 'paid');
        $this->_send_welcome_mail($new_reg);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => TRUE, 'cin' => $new_cin, 'message' => 'New CIN generated and sent to your registered email.']));
    }

    public function login()
    {
        if ($this->session->userdata('student_cin')) redirect('student/dashboard');
        $this->load->view('student/login');
    }

    public function do_login()
    {
        $cin   = strtoupper(trim($this->input->post('cin')));
        $dob   = $this->input->post('dob');
        $email = trim($this->input->post('email'));

        if (empty($cin))                          return $this->_json_error('CIN is required.');
        if (empty($dob) && empty($email))         return $this->_json_error('Provide Date of Birth or Email for verification.');

        $student = $this->Student_model->authenticate($cin, $dob, $email);
        if (!$student)                            return $this->_json_error('Invalid credentials. Please check your CIN and DOB/Email.');

        $this->session->set_userdata([
            'student_cin'  => $student->cin,
            'student_name' => $student->first_name . ' ' . $student->last_name,
            'student_id'   => $student->id,
            'program_id'   => $student->program_id,
        ]);

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => TRUE, 'redirect' => base_url('student/dashboard')]));
    }

    public function dashboard()
    {
        $this->_require_auth();
        $id = $this->session->userdata('student_id');
        $data['student'] = $this->Student_model->get_by_id($id);
        $data['tests']   = $this->Student_model->get_available_tests($id);
        $data['results'] = $this->Student_model->get_results($id);
        $data['program'] = $this->Program_model->get_by_id($this->session->userdata('program_id'));
        $this->load->view('student/dashboard', $data);
    }

    public function results()
    {
        $this->_require_auth();
        $data['results'] = $this->Student_model->get_results($this->session->userdata('student_id'));
        $this->load->view('student/results', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('student/login');
    }

    // ── Private Helpers ──

    private function _generate_cin($attempts = 5)
    {
        for ($i = 0; $i < $attempts; $i++) {
            $cin = 'CIN-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            if (!$this->Student_model->cin_exists($cin)) return $cin;
        }
        return 'CIN-' . date('Y') . '-' . uniqid();
    }

    private function _send_welcome_mail(array $data)
    {
        $program = $this->Program_model->get_by_id($data['program_id']);
        $this->email->initialize([
            'protocol'  => 'smtp',
            'smtp_host' => getenv('SMTP_HOST') ?: 'ssl://smtp.gmail.com',
            'smtp_port' => getenv('SMTP_PORT') ?: 465,
            'smtp_user' => getenv('SMTP_USER'),
            'smtp_pass' => getenv('SMTP_PASS'),
            'charset'   => 'utf-8',
            'mailtype'  => 'html',
        ]);
        $this->email->from('noreply@marrs.in', 'MaRRS Olympiad Portal');
        $this->email->to($data['email']);
        $this->email->subject('Your MaRRS CIN & Login Details – ' . ($program->name ?? ''));
        $body = $this->load->view('emails/welcome_cin', ['student' => $data, 'cin' => $data['cin'], 'program' => $program], TRUE);
        $this->email->message($body);
        if (!$this->email->send()) {
            log_message('error', 'MaRRS Welcome Mail failed: ' . $this->email->print_debugger());
        }
    }

    private function _require_auth()
    {
        if (!$this->session->userdata('student_cin')) redirect('student/login');
    }

    private function _json_error($msg)
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['success' => FALSE, 'message' => $msg]));
    }
}