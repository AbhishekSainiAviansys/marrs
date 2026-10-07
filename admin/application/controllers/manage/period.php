<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class period extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
		if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model('periodmodel');
    }
    public function index() {
         $data['list'] = $this->periodmodel->listperiod();
        $this->load->view("periodList.php", $data);
    }
    public function add() {
        $data['period_id'] = '';
        
        if (isset($_POST['submit'])) {
         
            $data     = array(
			       'period_name' => $this->input->post('period_name'),
                'period_year' => $this->input->post('period_year'),
            );
            $this->validation->set_data($data);
		            $this->validation->set_rules('period_name', 'period name', 'required');
            $this->validation->set_rules('period_year', 'period year', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
            	$this->notifications->notify('Period added successfully', 'success');
                $res = $this->periodmodel->insert($data);
                               redirect('manage/period/index/', 'refresh');
            }
         $data['result'] = $_POST;
        }
		$data['mode']    = 'Add';
        $this->load->view("periodAdd", $data);
    }
    public function edit() {
        $uri             = $this->uri->uri_to_assoc(4);
        $period_id = $uri['id'];
        $user_id = $this->session->userdata('user_id');
       
       if (isset($_POST['submit'])) {
         
            $data     = array(
			       'period_name' => $this->input->post('period_name'),
                   'period_year' => $this->input->post('period_year'),
            );
			
            $this->validation->set_data($data);
		    $this->validation->set_rules('period_name', 'period name', 'required');
            $this->validation->set_rules('period_year', 'period year', 'required');
            if($this->validation->run() === FALSE) 
			{
                $this->notifications->notify('Please make all entries', 'error');
            } 
			else 
			{
            	$this->notifications->notify('Period updated successfully', 'success');
                $res = $this->periodmodel->insert($data,$period_id);
                redirect('manage/period/index/', 'refresh');
            }
        	$data['result'] = $_POST;
        }
		$data['mode']    = 'Edit';
        $data['result'] = $this->periodmodel->getperiod($period_id);
        $this->load->view("periodAdd.php", $data);
    }
   
    public function changeStatus() {
        $uri             = $this->uri->uri_to_assoc(4);
         if (isset($uri['id'])) {
         	            $this->notifications->notify('Period Deleted successfully', 'success');
        $period_id = $uri['id'];
        $data['list']    = $this->periodmodel->changeStatus($period_id);
        redirect('manage/period/index/', 'refresh');
        }
    }



}//end class