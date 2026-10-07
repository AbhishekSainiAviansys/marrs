<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
    public function __construct() {
        parent::__construct();
		

	    $this->load->helper('url');
		$this->load->library('encrypt');
		$this->load->library('email');
		$this->load->library('form_validation');
       // $this->load->library('form-validation'); 
		$this->load->library('session');
        $this->load->library('upload');
        $this->load->model('Index');
        
   }

	
    public function index() 
	{	
	   $cin =  $this->uri->segment(3);
        if(isset($_POST['submit'])){
            
            $result = $this->Index->cin_login($_POST['cin'],$_POST['password']);
 		
            if (!$result) 
			{
                $this->session->set_flashdata('error','Wrong cin or password ...');
            }
			 else 
			 {
			   
                 $this->session->set_userdata('cin', $result[0]['cin']);
    
                redirect('cin_login/index', 'refresh'); // load index controller
            }
        }
		if(isset($cin)){
			 $result = $this->Index->cin_login($cin,$cin);
 		
            if (!$result) 
			{
                $this->session->set_flashdata('error','Wrong cin or password ...');
            }
			 else 
			 {
			   
                 $this->session->set_userdata('cin', $result[0]['cin']);
    
                redirect('cin_login/index', 'refresh'); // load index controller
            }
		}
        
        if(isset($_POST['z'])){redirect('zoomzoom/index', 'refresh');}
        
	    $this->load->view('cin_login/Login.php');
	
    }
	
	
	 public function index2() 
	{	
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $result = $this->Index->cin_login($_POST['cin'],$_POST['password']);
 		//	print_r($result);die;
            if (!$result) 
			{
                $this->session->set_flashdata('error','Wrong cin or password ...');
            }
			 else 
			 {
			   
                 $this->session->set_userdata('cin', $result[0]['cin']);
    
                redirect('cin_login/index', 'refresh'); // load index controller
            }
        }
        
        if(isset($_POST['z'])){redirect('zoomzoom/index', 'refresh');}
        
	    $this->load->view('cin_login/login_national.php');
	
    }
	
	
}/* END OF CLASS*/

