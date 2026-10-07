<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // if (!$this->session->userdata('user_id')) {
        //     redirect('manage/login/', 'refresh');
        // } 
		
        header('Content-Type: application/json');
		//$this->load->library('encrypt');
		$this->load->library('session');
		//$this->load->library('validation');
// 		$this->load->library("csv");
// 		$this->load->helper('form');
		$this->load->library('form_validation');


       $this->load->model('schoolmodel');
       $this->load->model('indexmodel');
	   
    }
    
      public function generate_login_url()
    {
       

      $series = $this->input->post('series');
         $res = $this->db->get_where('cin_list', array('cin' => $_SESSION['cin']))->row();
     // print_r($res).'--------';die; 


        $email = $res->stud_email;
     
       
    
       $data = json_encode([
    
            "email" => $email,
            "cin"  =>$res->cin,
            "week" =>'W1',
            "month" =>'M1',
            "series" =>$series,
            "class" =>$res->class,
            "level" =>'',
            "time"  => time()
    
        ]);
     
        // Encrypt
    
         $token = $this->encrypt_string($data);
     
        $url = "https://grademarker.online/auth/auto_login?token=" . $token;
     
        redirect($url);
    
    }
    
	
public function ajx_liststate_franchise($id='')
{
    print_r($_POST);exit;  
	echo $state_subdivision_id.'ok';die;
	$pid=$this->input->post('state_subdivision_id');

	$data['category']=$this->indexmodel->get_category($pid);		    
	 
	$this->load->view("payment.php",$data); 

	
	
}/* end of function ajx_liststate_franchise()*/


public function list_schoolDetails()

{
	$franchise_id=$this->input->post('franchise_id');
	
//	echo $franchise_id;die;
	
	$data['schools']=$this->schoolmodel->list_franchise_School($franchise_id);	 
	$this->load->view("franchise_school_list.php",$data); 
	
  } /* end of function list_schoolDetails()*/ 



	
}/* END OF CLASS*/