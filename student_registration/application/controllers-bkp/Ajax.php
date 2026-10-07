<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // if (!$this->session->userdata('user_id')) {
        //     redirect('manage/login/', 'refresh');
        // } 
		
		$this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('validation');
// 		$this->load->library("csv");
// 		$this->load->helper('form');
		$this->load->library('form_validation');


       $this->load->model('schoolmodel');
       $this->load->model('indexmodel');
	   
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