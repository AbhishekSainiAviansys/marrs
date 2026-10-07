<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Students_cin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        }
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
         $this->load->library('csv');
        $this->load->model('locationModel');
        $this->load->model('schoolModel');
        $this->load->model('studentsModel');
        $this->load->model('franchiseModel');
    }
    public function index() {
    	        if (isset($_POST['submit'])) {
    	        echo $data=$_FILES["file"]["tmp_name"];        
          $as= $this->csv->getContent($data);
          echo '<pre>';print_r($as);
          exit;
           }
       
        $this->load->view("studentscin.php");
    }
  
}


