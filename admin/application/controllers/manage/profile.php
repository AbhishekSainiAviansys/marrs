<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Profile extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model("instituteModel");
        $this->load->model("locationModel");
        $this->load->model("institutetypeModel");
    }
    public function index() {
        $this->show();
    }
    public function show() {
        $instituteID    = $this->session->userdata('instituteID');
        $data['result'] = $this->instituteModel->getInstitute($instituteID);
        $this->load->view("profileDetails", $data);
    }
    public function edit() {
        $instituteID       = $this->session->userdata('instituteID');
        $instituteUserName = $this->session->userdata('instituteUserName');
        $instituteName     = $this->session->userdata('instituteName');
        $this->load->model("emailModel");
        $data['result']        = $this->instituteModel->getInstitute($instituteID);
        $data['instituteytpe'] = $this->institutetypeModel->listInstitutetype();
        if (!empty($data['result']['instituteTypeIDs']))
            $data['institutetypes'] = explode(",", $data['result']['instituteTypeIDs']);
        else
            $data['institutetypes'] = array();
        if (isset($_POST['submit'])) {
            $data = array(
                'instituteName' => $this->input->post('instituteName'),
                'instituteBoard' => $this->input->post('instituteBoard'),
                'location' => $this->input->post('location'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'countryID' => $this->input->post('countryID'),
                'stateID' => $this->input->post('stateID'),
                'addressForCommunication' => $this->input->post('addressForCommunication'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'contactPerson' => $this->input->post('contactPerson'),
                'phone' => $this->input->post('phone'),
                'zipCode' => $this->input->post('zipCode'),
                'emailID' => $this->input->post('emailID'),
                'userName' => $this->input->post('userName')
            );
            if ($this->input->post('changepassword') != '') {
                $data2 = array(
                    'password' => $this->input->post('changepassword'),
                    'confirmPassword' => $this->input->post('changeconfirmPassword')
                );
            }
            $this->validation->set_data($data);
            $this->validation->set_rules('instituteName', 'Institute Name', 'required|trim|xss_clean');
            $this->validation->set_rules('instituteBoard', 'Institute Board', 'required|trim|xss_clean');
            $this->validation->set_rules('location', 'Location', 'required');
            $this->validation->set_rules('address1', 'Address1', 'required');
            $this->validation->set_rules('address2', 'Address2', 'required');
            $this->validation->set_rules('city', 'City', 'required|alpha');
            $this->validation->set_rules('countryID', 'Country', 'required');
            $this->validation->set_rules('stateID', 'State', 'required');
            $this->validation->set_rules('zipCode', 'zipCode', 'required');
            $this->validation->set_rules('addressForCommunication', 'Address for communication', 'required');
            $this->validation->set_rules('latitude', 'Latitude', 'required');
            $this->validation->set_rules('longitude', 'longitude', 'required');
            $this->validation->set_rules('contactPerson', 'Contact person', 'required|trim|xss_clean');
            $this->validation->set_rules('phone', 'Phone', 'required|integer');
            $this->validation->set_rules('emailID', 'Email', 'required|valid_email');
            $this->validation->set_rules('userName', 'User name', 'required');
            if ($this->input->post('changepassword') != '') {
                $this->validation->set_rules('changeconfirmPassword', 'Confirm Password', 'matches[changepassword]');
            }
            if ($this->validation->run() === FALSE) {
                var_dump($this->validation->show_errors());
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $result = $this->instituteModel->insert($instituteID);
                if ($this->input->post('changepassword') != '') {
                    $mailresult = $this->emailModel->getmailtemplate('institute_modify');
                    $to         = $this->input->post('emailID');
                    $subject    = $mailresult['subject'];
                    $fromName   = $mailresult['fromName'];
                    $emailBody  = $mailresult['emailBody'];
                    $body       = str_replace("[userName]", $this->input->post('userName'), $mailresult['emailBody']);
                    $body       = str_replace("[password]", $this->input->post('password'), $body);
                    $fromID     = $mailresult['fromID'];
                    $password   = $mailresult['password'];
                    $this->load->library('email');
                    $this->email->from('marrsspellingbee.com', 'Career Entrance Team');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($body);
                    $this->email->send();
                    $mailresult = $this->emailModel->getmailtemplate('institute_profile_modified');
                    $to         = $this->input->post('emailID');
                    $subject    = $mailresult['subject'];
                    $fromName   = $mailresult['fromName'];
                    $emailBody  = $mailresult['emailBody'];
                    $body       = str_replace("[instituteID]", $instituteID, $mailresult['emailBody']);
                    $body       = str_replace("[instituteUserName]", $instituteUserName, $body);
                    $body       = str_replace("[instituteName]", $instituteName, $body);
                    $fromID     = $mailresult['fromID'];
                    $password   = $mailresult['password'];
                    $this->load->library('email');
                    $this->email->from('marrsspellingbee.com', 'Career Entrance Team');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($body);
                    $this->email->send();
                }
                $this->notifications->notify('Updations done successfully', 'success');
                redirect('wb-institute/profile/edit/', 'refresh');
            }
            $data['result'] = $_POST;
        }
        $data['country']     = $this->locationModel->listCountries();
        $data['stateatload'] = $this->locationModel->getstateatload();
        $this->load->view("instituteProfileEdit", $data);
    }
}


