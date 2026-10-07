<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Events extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model('eventModel');
    }
    public function index() {
        $data['list'] = $this->eventModel->listeventPosts();
        $this->load->view("eventList.php", $data);
    }
    public function add() {
        $data['eventID'] = '';
        if (isset($_POST['submit'])) {
            $date     = $this->input->post('eventDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('eventDate')))):'';
            $fromdate = $this->input->post('displayFromDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayFromDate')))):'';
            $todate   = $this->input->post('displayToDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayToDate')))):'';
            $data     = array(
                'eventTitle' => $this->input->post('eventTitle'),
                'eventDate' => $date,
                'eventStatus' => $this->input->post('eventStatus'),
                'event' => $this->input->post('event'),
                'indexMessage' => $this->input->post('indexMessage'),
                'scrollMessage' => $this->input->post('scrollMessage'),
                'popUpMessage' => $this->input->post('popUpMessage'),
                'displayFromDate' => $fromdate,
                'displayToDate' => $todate
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('eventTitle', 'Title of event', 'required');
            $this->validation->set_rules('eventDate', 'Event Date', 'required');
            $this->validation->set_rules('event', 'Event Specification', 'required');
            $this->validation->set_rules('eventStatus', 'Event Status', 'required');
            $this->validation->set_rules('displayFromDate', 'From date', 'required');
            $this->validation->set_rules('displayToDate', 'To date', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->eventModel->insert($data);
                if (isset($_POST['informParents'])) {
                    if ($_POST['informParents'] == 'Yes') {
                        $resultmail = $this->eventModel->getParentsmails($this->session->userdata('instituteID'));
                    }
                }
                redirect('manage/content/index/', 'refresh');
            }
        }
		$data['mode']    = 'Add';
        $this->load->view("eventAdd", $data);
    }
    public function edit() {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
       
        if (isset($_POST['submit'])) {
          $date     = $this->input->post('eventDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('eventDate')))):'';
            $fromdate = $this->input->post('displayFromDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayFromDate')))):'';
            $todate   = $this->input->post('displayToDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayToDate')))):'';
            $data     = array(
                'eventTitle' => $this->input->post('eventTitle'),
                'eventDate' => $date,
                'eventStatus' => $this->input->post('eventStatus'),
                'event' => $this->input->post('event'),
				'indexMessage' => $this->input->post('indexMessage'),
                'scrollMessage' => $this->input->post('scrollMessage'),
                'popUpMessage' => $this->input->post('popUpMessage'),
                'displayFromDate' => $fromdate,
                'displayToDate' => $todate
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('eventTitle', 'Title of event', 'required');
            $this->validation->set_rules('eventDate', 'Event Date', 'required');
            $this->validation->set_rules('event', 'Event Specification', 'required');
            $this->validation->set_rules('eventStatus', 'Event Status', 'required');
            $this->validation->set_rules('displayFromDate', 'From date', 'required');
            $this->validation->set_rules('displayToDate', 'To date', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->eventModel->insert($data, $uri['id']);
                redirect('manage/events/index/', 'refresh');
            }
        }
		$data['mode']    = 'Edit';
        $data['list'] = $this->eventModel->geteventPosts( $uri['id']);
        $this->load->view("eventAdd.php", $data);
    }
    public function view() {
     
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
        $data['mode']    = 'View';
        $data['list']    = $this->eventModel->geteventPosts( $uri['id']);
        $this->load->view("eventAdd", $data);
    }
    public function changeStatus() {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
        $data['list']    = $this->eventModel->changeStatus($uri['id']);
        redirect('manage/events/index/', 'refresh');
    }
}