<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class assign_pid extends CI_Controller
 {
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('session');
		  if (!$this->session->userdata('user_id'))
		  {
            redirect('manage/login/', 'refresh');
        } 
        $this->load->library('validation');
        $this->load->model('franchiseModel');
        $this->load->model('serviceModel');
        $this->load->model('periodModel');
        $this->load->model('schoolModel');
        $this->load->model('pidModel');
    }
public function index() 
 {
 	
 	if (isset($_POST['Search']))
	{
		
		 $link = SITE_URL . "assign_pid/index/aim/list/";
		 
		  if ($this->input->post('period_id'))  {  $link .= "period_id/" .$this->input->post('period_id') . "/";    }
	     if ($this->input->post('franchise_id'))  {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";    }
 	     if ($this->input->post('service_id')) {  $link .= "service_id/" . $this->input->post('service_id') . "/"; }
 	     if ($this->input->post('school_id')) {  $link .= "school_id/" . $this->input->post('school_id') . "/"; }
 	     $this->session->set_userdata('link', $link);
 	     redirect($link, 'refresh');
        $data['list']=$_POST;
 	
 	}/*END OF  IF ISSET POST*/
 	else
  {
  	      $data['info']='';
	      $uri = $this->uri->uri_to_assoc(4);
	      $aim=$uri['aim'];
  	      if( $uri['service_id'] == "") 
			{
              $data['franchise']=$this->franchiseModel->listFranchise();   
					  
			} /*END OF if( $uri['service_id'] == "") */
			
		   else
			{
						$params=array("service_id"=>$uri['service_id']);			   
		            $data['period']=$this->periodModel->listperiod();	
	               $data['franchise']=$this->franchiseModel->listFranchise($params);	
	               $params=array("fr_id"=>$uri['franchise_id']);	
                  $data['schools'] = $this->schoolModel->listSchool($params);                            				 			  
			 }/* END ELSE OF if( $uri['service_id'] == "") */
  	 
			 if($uri['period_id']!='' && $uri['service_id']!='' && $uri['franchise_id']!=''&& $uri['school_id']!='')
			 {	
		         $params   = array(
								           'period_id' =>  $uri['period_id'],							                  
											  'franchise_id'  => $uri['franchise_id'],
											  'school_id'  => $uri['school_id'],
											  'service_id'=>$uri['service_id'],
											  'aim'=>$aim
						               );		
					$data['list'] = $this->pidModel-> paid_student_list($params);	
					   				                    
			   }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
			 	  
			   else		
			   {
			 	        $data['info']="empty";
			   }	
	   	      	
 	} /*END OF ELSE IF ISSET POST OF SEARCH*/
 	  
 
/* ******************************END OF FIRST  ISSET OF POST  SERCH*****************/		

  if (isset($_POST['Assign_pid']))
	{
		 
		 $data = $this->input->post('student_id');
		 $no_stud_id=count($data); 
       $params   = array(
                            'period_name' =>  $this->input->post('period_name'),							                  
									 'school_code'  => $this->input->post('school_code')		      
						      );	
				                
		$pid_data=$this->pidModel->get_pid_count($params);
		
	    $period=$pid_data[0];
		 $schoolcode=$pid_data[1];
       $new_pidcode=$period.$schoolcode."_";
		if(empty($pid_data[2]))
		{
		     /*echo "empty data";*/
     
           $inc_value=0;	   
		}
	
	else 
	{
		     /*echo "already data";*/
           $pid=$pid_data[2];
           /*echo "--------------".$pid;*/
           $pid_split=explode('_',$pid);
           $pid_firsthalf= $pid_split[1];
           $inc_value=$pid_firsthalf; 
          
      
	}
  
for($i=0;$i<$no_stud_id;$i++)
{
	
	$inc_value++;
	/*echo $new_pidcode.$inc_value;*/
	
	$update_data=array 
	               (   'pid' => $new_pidcode.$inc_value,
	                   'pid_status'=>'Assign',
	                   'student_id'=>$data[$i]
	               );
	 $updated_data = $this->pidModel->insert($update_data);
	 /*print_r($updated_data);exit;*/
	            
}
if($updated_data)
		{
			$this->notifications->notify('PID Successfully Generated', 'success'); 	
		}
		else
		{
			$this->notifications->notify('PID Generation Failed', 'error'); 	
		}		 
      $link_redirect=$this->session->userdata('link');
      redirect($link_redirect, 'refresh'); 
		
	}

    
        $data['services'] = $this->serviceModel->listservice();	
       
		  $data['period']=$this->periodModel->listperiod();
		  /*$data['schools']=$this->schoolModel->listSchool();*/
		  
		 $data['aim']=$uri['aim'];		   
		  $data['period_id']= $uri['period_id'];
		  $data['service_id']= $uri['service_id'];
		  $data['school_id']=$uri['school_id'];
		  $data['franchise_id']=$uri['franchise_id'];	 
        $this->load->view("list_Paid_students", $data);
        
    }

public function listDetails()
   {
   	
	      $service_id=$this->input->post('service_id');
		   $params = array("service_id" => $service_id); 
		   
		   $data['franchise']=$this->franchiseModel->listFranchise($params);		    
		   $data['period']=$this->periodModel->listperiod(); 
	      $this->load->view("pid_list.php",$data); 
	       
   }/*end function  listDetails*/
   

public function list_schoolDetails()
   {
   	   
	      $fr_id=$this->input->post('franchise_id');
		   $params = array("fr_id" => $fr_id);
		   $data['schools']=$this->schoolModel->listSchool($params);	 
	      $this->load->view("pid_school_list.php",$data); 
	      
  } 
   
   
   public function view()
   {
   	
    if (isset($_POST['Search']))
	{
		
		  $link = SITE_URL . "assign_pid/view/aim/view_pid/";
		 
		  if ($this->input->post('period_id'))  {  $link .= "period_id/" .$this->input->post('period_id') . "/";    }
	     if ($this->input->post('franchise_id'))  {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";    }
 	     if ($this->input->post('service_id')) {  $link .= "service_id/" . $this->input->post('service_id') . "/"; }
 	     if ($this->input->post('school_id')) {  $link .= "school_id/" . $this->input->post('school_id') . "/"; }
 	     $this->session->set_userdata('link', $link);
 	     redirect($link, 'refresh');
        $data['list']=$_POST;
 	
 	}/*END OF  IF ISSET POST*/
 	else
  {
  	      $data['info']='';
	      $uri = $this->uri->uri_to_assoc(4);
	      $aim=$uri['aim'];
	     
  	      if( $uri['service_id'] == "") 
			{
              $data['franchise']=$this->franchiseModel->listFranchise();   
					  
			} /*END OF if( $uri['service_id'] == "") */
			
		   else
			{
						$params=array("service_id"=>$uri['service_id']);			   
		            $data['period']=$this->periodModel->listperiod();	
	               $data['franchise']=$this->franchiseModel->listFranchise($params);	
	               $params=array("fr_id"=>$uri['franchise_id']);	
                  $data['schools'] = $this->schoolModel->listSchool($params);                            				 			  
			 }/* END ELSE OF if( $uri['service_id'] == "") */
  	 
			 if($uri['period_id']!='' && $uri['service_id']!='' && $uri['franchise_id']!=''&& $uri['school_id']!='')
			 {	
		         $params   = array(
								           'period_id' =>  $uri['period_id'],							                  
											  'franchise_id'  => $uri['franchise_id'],
											  'school_id'  => $uri['school_id'],
											  'service_id'=>$uri['service_id'],
											   'aim'=>$aim	
						               );		
					$data['list'] = $this->pidModel-> paid_student_list($params);	
               
					   				                    
			   }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
			 	  
			   else		
			   {
			 	        $data['info']="empty";
			   }	
	   	      	
 	} /*END OF ELSE IF ISSET POST OF SEARCH*/
 	
        $data['services'] = $this->serviceModel->listservice();	
		  $data['period']=$this->periodModel->listperiod();
		  /*$data['schools']=$this->schoolModel->listSchool();*/
		  
		  $data['period_id']= $uri['period_id'];
		  $data['service_id']= $uri['service_id'];
		  $data['school_id']=$uri['school_id'];
		  $data['franchise_id']=$uri['franchise_id'];
		  $data['aim']=$uri['aim'];
        $this->load->view("list_Paid_students", $data);
   	
   }
   
   } /*END OF CLASS*/
   
   
   
   
   /*echo "generate pid for students";
             print_r($data);
             print_r($data);*/
	    	/*print_r($params);
         $pid_data=$this->pidModel->get_pid_count($params);
         echo "<pre>";
		   print_r($data);
		   $no_data=count($data);
		   echo "counts of data". $no_data;
         /*echo "generate pid for students";
         print_r($data);
         echo "<br/>";
         $no_data=count($data);
         echo "counts of data".$no_data; 
         $pid_data=$this->pidModel->get_pid_count($params);
         /*echo "<br/>";
         print_r(array_count_values($data));
         /*print_r(array_count_values($data));*/
         /*$no_data=count($data);*/
         /*echo "counts of data".$no_data;*/