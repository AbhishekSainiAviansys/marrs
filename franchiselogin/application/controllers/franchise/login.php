<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->load->library('encrypt');
        $this->load->library('session');
            $this->load->model("franchiseModel");
    }
	
	
    public function index() 
	{ 
      if ($this->session->userdata('franchise_id') > 0 || $this->session->userdata('franchise_id'))
		 {
            redirect('franchise/index/', 'refresh');
         }
	 
       if (isset($_POST['submit'])) 
         {
            $result = $this->franchiseModel->loginCheck();
		//	print_r($result);die;
            if (!$result) 
			{
                $this->notifications->notify('Wrong username/password; Login Failed', 'error');
            }
			 else 
			 {
                $this->session->set_userdata('franchise_id', $result['franchise_id']);
                $this->session->set_userdata('username', $result['username']);
				$this->session->set_userdata('fr_service_id', $result['service_id']);
                redirect('franchise/index/', 'refresh'); // load index controller
            }
        }
        $this->load->view("login.php");
    }
	
	
	public function changestatusschoolandsavebank()
    {
        print_r($_POST);die;
    }
	
	
    public function logout() {
        $this->session->unset_userdata('franchise_id');
        $this->session->unset_userdata('username');
        $siteUrl = getenv('APP_BASE_URL');
        if ($siteUrl === FALSE || $siteUrl === '')
        {
            $siteUrl = 'https://marrs.in';
        }
        redirect(rtrim($siteUrl, '/') . '/', 'refresh');
    }
}

