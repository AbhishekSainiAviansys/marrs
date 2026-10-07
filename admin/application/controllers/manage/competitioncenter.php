<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class competitioncenter extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('locationModel');
        $this->load->model('competitioncenterModel');
        $this->load->model('franchiseModel');
    }
    public function index() 
    {
        if (isset($_POST['Search'])) {
            $link = SITE_URL . "competitioncenter/index/";
            if ($this->input->post('fr_id')) {
                $link .= 'fr_id/' . $this->input->post('fr_id') . "/";
            }
            if ($this->input->post('stateID')) {
                $link .= "stateID/" . $this->input->post('stateID') . "/";
            }
            redirect($link, 'refresh');
        } else {
            $uri = $this->uri->uri_to_assoc(4);
            if (isset($uri['fr_id'])) {
                $fr_id = $uri['fr_id'];
            } else {
                $fr_id = '';
            }
            if (isset($uri['stateID'])) {
                $stateID = $uri['stateID'];
            } else {
                $stateID = '';
            }
            $params       = array(
                'fr_id' => $fr_id,
                'stateID' => $stateID
            );
            $data['list'] = $this->competitioncenterModel->listcompetition_center($params);
        }
        $data['countries']   = $this->locationModel->listCountries();
        $data['stateatload'] = $this->locationModel->getstateatload();
        $data['franchise']   = $this->franchiseModel->listFranchise();
        $data['fr_id']       = $fr_id;
        $data['stateID']     = $stateID;
        $this->load->view("competitioncenterList.php", $data);
    }
    public function add() {
        $data['competition_centre_id'] = '';
        if (isset($_POST['submit'])) {
            $data = array(
                'center_name' => $this->input->post('center_name'),
                'state_id' => $this->input->post('state_id'),
                'country_id' => $this->input->post('country_id'),
                'franchise_id' => $this->input->post('franchise_id'),
                'center_latitude' => $this->input->post('center_latitude'),
                'center_longitude' => $this->input->post('center_longitude')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('center_name', 'center name', 'required');
            $this->validation->set_rules('state_id', 'state', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('franchise_id', 'franchise', 'required');
            $this->validation->set_rules('center_latitude', 'latitude', 'required');
            $this->validation->set_rules('center_longitude', 'longitude', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
            		$this->notifications->notify('competition center added successfully', 'success');
                $res = $this->competitioncenterModel->insert($data);
                redirect('manage/competitioncenter/index/', 'refresh');
            }
        }
        $data['mode']        = 'Add';
        $data['countries']   = $this->locationModel->listCountries();
        $data['stateatload'] = $this->locationModel->getstateatload();
        $data['franchise']   = $this->franchiseModel->listFranchise();
        $data['result']      = $_POST;
        $this->load->view("competitioncenterAdd.php", $data);
    }
    public function edit() {
        $uri                   = $this->uri->uri_to_assoc(4);
        $competition_centre_id = $uri['id'];
        if (isset($_POST['submit'])) {
            $data = array(
                'center_name' => $this->input->post('center_name'),
                'state_id' => $this->input->post('state_id'),
                'country_id' => $this->input->post('country_id'),
                'franchise_id' => $this->input->post('franchise_id'),
                'center_latitude' => $this->input->post('center_latitude'),
                'center_longitude' => $this->input->post('center_longitude')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('center_name', 'center name', 'required');
            $this->validation->set_rules('state_id', 'state', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('franchise_id', 'franchise', 'required');
            $this->validation->set_rules('center_latitude', 'latitude', 'required');
            $this->validation->set_rules('center_longitude', 'longitude', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
            	$this->notifications->notify('competition center updated successfully', 'success');
                $res = $this->competitioncenterModel->insert($data, $competition_centre_id);
                redirect('manage/competitioncenter/index/', 'refresh');
            }
            $data['result'] = $_POST;
        }
        $data['mode']        = 'Edit';
        $data['countries']   = $this->locationModel->listCountries();
        $data['stateatload'] = $this->locationModel->getstateatload();
        $data['franchise']   = $this->franchiseModel->listFranchise();
        $data['result']      = $this->competitioncenterModel->getcompetitioncenter($competition_centre_id);
        $this->load->view("competitioncenterAdd.php", $data);
    }
    /*public function view() {
    $instituteID     = $this->session->userdata('instituteID');
    $uri             = $this->uri->uri_to_assoc(4);
    $data['eventID'] = $uri['id'];
    $data['mode']    = 'View';
    $data['list']    = $this->eventModel->geteventPosts($instituteID, $uri['id']);
    $this->load->view("eventAdd", $data);
    }*/
    public function changeStatus() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $competition_centre_id = $uri['id'];
            $this->notifications->notify('competition center Deleted successfully', 'success');
            $this->competitioncenterModel->changeStatus($competition_centre_id);
            redirect('manage/competitioncenter/index/', 'refresh');
        }
    }
}