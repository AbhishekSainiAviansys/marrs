<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Registration extends CI_Controller {
    public function __construct()
	 {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
      }
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
		 $this->load->library('csv');
		
        $this->load->model('serviceModel');
		$this->load->model('periodModel');
		$this->load->model('competitionlevelmodel');
        $this->load->model('periodmodel');
		$this->load->model('competitionlevelmodel');
		$this->load->model('competitionregistermodel');
    }
	 public function index()
	  {
        
    } /*end function index*/
	
	
    public function registrationList()
    {
      $uri = $this->uri->uri_to_assoc(4);
      if (isset($_POST['Search']))
     {
          if($uri['aim']=='approved_list')	
          {
         	    $link = SITE_URL . "registration/registrationList/aim/approved_list/";  
    		    if ($this->input->post('period_id'))              {  $link .= "period_id/" .$this->input->post('period_id') . "/";                        }
                if ($this->input->post('service_id'))             {  $link .= "service_id/" . $this->input->post('service_id') . "/";                     }  
                if ($this->input->post('competition_level_id'))   {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
                redirect($link, 'refresh');
                $data['list']=$_POST;
          }	
          else
    	  {
    	 
    		   $link = SITE_URL . "registration/registrationList/aim/reg_list_view/";
    		   if ($this->input->post('period_id'))  {  $link .= "period_id/" .$this->input->post('period_id') . "/";    }
    		   if ($this->input->post('cin'))  {  $link .= "cin/" .$this->input->post('cin') . "/";    }
    		   if ($this->input->post('service_id')) {  $link .= "service_id/" . $this->input->post('service_id') . "/"; }  
    		   if ($this->input->post('competition_level_id')) {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
    		   redirect($link, 'refresh');
    		   $data['list']=$_POST;
    	  }
         }/*end if(isset($_POST['bulk_search'])) */
         else 
         {
           $data['info']='';
           $uri = $this->uri->uri_to_assoc(4);
           $aim=$uri['aim'];
           if( $uri['service_id'] == "") {   $data['level']=$this->competitionlevelmodel->listcompetitionlevel(); } /*END OF if( $uri['service_id'] == "") */
           
           else { $data['level']=$this->competitionlevelmodel->listcompetitionlevel( $uri['service_id']); }/*END ELSE OF if( $uri['service_id'] == "") */
        				 
              if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='')
              {	
            	$params   = array(
            						  'period_id' =>  $uri['period_id'],							               
            						  'competition_level_id' =>  $uri['competition_level_id'],
            						  'cin'  => $uri['cin'],
            						  'fr_id'=>$this->session->userdata('franchise_id'),
            						  'aim' =>$aim
            					   );
            					   $data['list'] = $this->competitionregistermodel->registrationList_and_approvedList($params); 
            	//$data['list'] = $this->competitionregistermodel->listregistered_students($params);
              }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
              
              else { $data['info']="empty"; }	  /*END OF ELSE if($uri['period_id']!='' || $uri['service_id']!='' || $uri['competition_level_id']!='' ) */  
            
             }/* END OF ELSE if (isset($_POST['Search']))*/
            if (isset($_POST['Export']))
    	    {
    		 
    	    $listcin= $data['list'];  /*echo "<pre>"; print_r($listcin);exit;*/
    		$competition_level_name=$listcin['schedule_list'][0]['competition_level_name'];
    		$period_name=$listcin['schedule_list'][0]['period_name'];
    	 	
    		if($listcin['status']=='reg_list_view')
    		{
    			$reglist=$listcin['reg_list'];
    			$data = array();
                $n    = 1;
    		     foreach($reglist as $item)
    		     {
    		   	   
    			     $item['serial_no'] = $n;
    			     $data []=array( 
    			                      $item['serial_no'],
    				                  $item['first_name']. " " .$item['middle_name']. " " .$item['last_name'],
    				                  $item['cin'] ,
    								  $item['school_name']."  ".$item['school_address'],
    				                  $item['categoryKey']  ,
    								  $item['period_name']  ,
    								  $item['competition_level_name']  ,
    								  $item['competition_date']  ,
    								  $item['reporting_time']  ,
    								  $item['center_name']  ,
    								  $item['temperory_registration_number']  ,
    								  $item['permenent_registration_number']  ,
    								  $item['receipt_number']  ,
    								  $item['branch_name']  ,
    								  $item['receipt_date']  ,
    				                  $item['franchise_code'], 
    				                  $item['state_subdivision_name'],
    			                  );                              /* echo $item['serial_no'];exit;*/
    			      $n++;
    		      }
    			  
    			$heading= array("MaRRS Spelling Bee :".$competition_level_name."  "."Competition Registration List period ".$period_name."      Date : ".date("d-M-Y [H:i:s]"));
    			$columns= array('serialno','Student Name','CIN','School Name','Category','Period','Comp Level','Comp Date','Reporing Time','Centre','TRN','PRN','DD Number','Bank','DD Date','Franchise Code','State');
    		    $this->csv->export_download($data,$heading,$columns,'registrationlist.csv');
    		   exit;
    			
    			
    		}
    	 }
    
    	
    	
    		
    	$data['services'] = $this->serviceModel->listservice();
    	$data['period']=$this->periodModel->listperiod();
    
    	$data['period_id']= $uri['period_id'];
    	$data['service_id']= $uri['service_id'];
    	$data['competition_level_id']= $uri['competition_level_id'];
    	$data['cin']=$uri['cin'];
    	
    	$this->load->view("registrationList.php",$data);
    } /*END OF FUNCTION public function registrationList()*/
	
	
/******************************--------------------------------------------********************************/	
	
    public function notregisteredList()
    {
    	if (isset($_POST['Search']))
    	{
    		  $link = SITE_URL . "registration/notregisteredList/";
    		  if ($this->input->post('period_id'))  {  $link .= "period_id/" .$this->input->post('period_id') . "/";    }
    		   if ($this->input->post('cin'))  {  $link .= "cin/" .$this->input->post('cin') . "/";    }
              if ($this->input->post('service_id')) {  $link .= "service_id/" . $this->input->post('service_id') . "/"; }  
              if ($this->input->post('competition_level_id')) {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
                 redirect($link, 'refresh');
                 $data['list']=$_POST;
         }/*end if(isset($_POST['bulk_search'])) */
          
    	  
    	else 
    	{
    		 $data['info']='';
    	     $uri = $this->uri->uri_to_assoc(4);
    		 /*echo "uri['service_id']".$uri['service_id'];*/
    	     if( $uri['service_id'] == "") 
    		 {
    			 $data['level']=$this->competitionlevelmodel->listcompetitionlevel();
    					  
    		 }
    		else
    		 {
    			 $data['level']=$this->competitionlevelmodel->listcompetitionlevel( $uri['service_id']);
    					  /*echo "<pre>" ;print_r($data['level']);exit;*/
    		 }
    		   
    		 if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )
    		 {	
    				 	
    		            $params   = array(
    								               'period_id' =>  $uri['period_id'],							               
    								               'competition_level_id' =>  $uri['competition_level_id'],
    											      'cin'  => $uri['cin'],
    											      'service_id'  => $uri['service_id']
    						               );
    						            
    			        $data['list'] = $this->competitionregistermodel->listNotRegistration($params);    
    		 }	
    		 else		
    		{
    			 	     $data['info']="empty";
    				
    		 }	  /*END OF ELSE if($uri['period_id']!='' || $uri['service_id']!='' || $uri['competition_level_id']!='' )  */ 
    			 			          
    		      
    }/* END OF ELSE if (isset($_POST['Search']))*/
    		 
    		
    		$data['services'] = $this->serviceModel->listservice();
    		$data['period']=$this->periodModel->listperiod();
    	
    		$data['period_id']= $uri['period_id'];
    		$data['service_id']= $uri['service_id'];
    		$data['competition_level_id']= $uri['competition_level_id'];
    		$data['cin']=$uri['cin'];
    		
    		$this->load->view("notregisteredList.php",$data);
    		
    		
    	}/*END OF FUNCTION public function registrationList()*/
    	
	
	
	public function get_service_complevel()
    {
	       $service_id=$this->input->post('service_id');
		   $params = array("service_id" => $service_id);
		   $data['level']=$this->competitionlevelmodel->listcompetitionlevel($params);
		   $data['period']=$this->periodModel->listperiod();
		   $this->load->view("service_based_details.php",$data); 
   }/*end function  listDetails*/
   
   
   
/******************************--------------------------------------------********************************/	
   
    public function view()
    {
       	 $uri = $this->uri->uri_to_assoc(4);
    	 if(isset($uri['reg_id']))
         {  
    		 $param =array("status" => "reg","comp_reg_id" => $uri['reg_id'] );
             $data['registration_details']   = $this->competitionregistermodel->viewRegistration($param);
    	 }
         if(isset($uri['unreg_id']))
         { 
    		 $param =array("status" => "un_reg","stud_id" => $uri['unreg_id'] );	
    		 $data['registration_details']   = $this->competitionregistermodel->viewRegistration($param);
      
    	 }
    	 
      $this->load->view("registrationView", $data);
    }
    	
	
	
/******************************--------------------------------------------********************************/	

	
} /*END OF CLASS*/

