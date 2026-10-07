<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
    
class assign_cin extends CI_Controller
 {
	 
    public function __construct() 
    {
			parent::__construct();
			$this->load->library('session');
			if (!$this->session->userdata('user_id'))
			{
				redirect('manage/login/', 'refresh');
			} 
			$this->load->library('email');
			$this->load->library('validation');
			$this->load->library('csv');
			
			$this->load->model('franchiseModel');
			$this->load->model('serviceModel');
			$this->load->model('periodModel');
			$this->load->model('schoolModel');
			$this->load->model('cinmodel');
    }
/*================================= ========================================== ================================*/

 public function index() 
 {
 	if (isset($_POST['Search']))
	{
		$link = SITE_URL . "assign_cin/index/aim/list/";
		if ($this->input->post('period_id'))     {  $link .= "period_id/" .$this->input->post('period_id') . "/";       }
	    if ($this->input->post('franchise_id'))  {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/"; }
 	    if ($this->input->post('service_id'))    {  $link .= "service_id/" . $this->input->post('service_id') . "/";    }
 	    if ($this->input->post('school_id'))     {  $link .= "school_id/" . $this->input->post('school_id') . "/";      }
 	    $this->session->set_userdata('link', $link);
 	    redirect($link, 'refresh');
        $data['list']=$_POST;
 	}  /*END OF  IF ISSET POST*/
    else
    {
		   $data['info']='';
		   $uri = $this->uri->uri_to_assoc(4);
		   $aim=$uri['aim'];
		   if( $uri['service_id'] == ""){ $data['franchise']=$this->franchiseModel->listFranchise();} /*END OF if( $uri['service_id'] == "") */
		   else
		   {
			  $params=array("service_id"=>$uri['service_id']);			   
			  $data['period']=$this->periodModel->listperiod();	
			  $data['franchise']=$this->franchiseModel->listFranchise($params);	
			  $params=array("fr_id"=>$uri['franchise_id']);	
			  $data['schools'] = $this->schoolModel->listSchool($params);                            				 			  
		   }/* END ELSE OF if( $uri['service_id'] == "") */
		   if($uri['period_id']!='' && $uri['service_id']!='')
		   {	
			  $params   = array(
								 'period_id'    =>  $uri['period_id'],							                  
								 'franchise_id' => $uri['franchise_id'],
								 'school_id'    => $uri['school_id'],
								 'service_id'   =>$uri['service_id'],
								 'aim'          =>$aim
							  );		
			  $data['list'] = $this->cinmodel-> paid_student_list($params);      
		   } /* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
		   else	{  $data['info']="empty";  }	
 	 }    /*END OF ELSE IF ISSET POST OF SEARCH*/
 	  
/* *****************END OF FIRST  ISSET OF POST  SERCH**********/	
    if (isset($_POST['Assign_cin'])) /* BELOW CODE GENERATE CIN */
	{
	   $data = $this->input->post('student_id');
		 $uri = $this->uri->uri_to_assoc(4);
		 $no_stud_id=count($data);                     /*echo "........<pre>.......";print_r($data); exit;*/
		 for($i=0;$i<$no_stud_id;$i++)
       { 
       	  foreach ($data[$i] as $value => $key)
       	    $frcode= $value;
       	    $stud_id=$key;
       	    $params   = array( 'period_name' => $uri['period_id'] ,	
       	                  	 'franchise_code'  => $frcode		
                             );
		       $cin_data=$this->cinmodel->get_cin_count($params);                /*print_r($cin_data);exit;*/
	          $period=$cin_data[0];                                            /*echo "period".$period; */
		       $franchisecode=$cin_data[1];                                    /*echo "franchisecode".$franchisecode; exit;*/
             $new_cin=$period.$franchisecode;
		       if(empty($cin_data[2]))
		       {                                                             /*echo "empty data"; exit;*/
                 $inc_value=10000;	   
		       }
	          else 
	          {
                $cin=$cin_data[2];                                          /*echo "--------------".$cin; exit;*/
                $cin_first_half=substr($cin,0,2);
		          $cin_second_half=substr($cin,5,10);
                $inc_value =  $cin_second_half+1;                          /* echo $inc_value; exit;*/   
	         }  
	             $cin= $new_cin.$inc_value;                                  /*echo "ndfgnfkdjnh".$key ;   echo "cin=".$cin;	exit;*/
                $inc_value++; 
	             $update_data=array 
	                               (   'cin'                 => $cin,
	                                   'cin_assigned_status' =>'Assign',
	                                   'student_id'          =>$stud_id,
									   
	                               ); 
	               /*echo "........<pre>.......";print_r($update_data); exit;*/
	               
	        $inserted_data = $this->cinmodel->insert($update_data);     /*echo "insetred status=". $inserted_data;exit;*/  
	           
	    
/* ========================= MAILING CODE ============================ ======================== */
				
		//   $email_ids=array('student_id'=> $stud_id,'cin' => $new_pidcode.$cin);        /*print_r($email_ids); exit;*/  
	    //  $email_data=$this->cinmodel->get_emails($email_ids);                        /* echo "<pre>" ;print_r($email_data); echo $email_data[0]['cin']; exit; */ 
    
	      /*$father_email=$email_data[0]['father_email'];
	      $mother_email=$email_data[0]['mother_email'];*/
	   //   $stud_name=$email_data[0]['first_name']."  ".$email_data[0]['middle_name']."  ".$email_data[0]['last_name'];
	      
	    //           $this->email->from('marrsspellingbee.com','Marrs Spelling Bee');   
         //          $this->email->to('webteam2@marrs.in');
			//		    $this->email->cc('webteam3@marrs.in');   
				   /* $this->email->to($father_email);
                   $this->email->cc($mother_email);*/
				    
          //        $this->email->subject('FROM LOCAL SERVER :MaRRS SpellingBee : CIN ');   
         /*         $this->email->message(' <b>
				                              Following is your CIN number. <br/>
                                               Your CIN is : '.$email_data[0]['cin'].'<br/>
											   NAME        : '.$stud_name.'<br/>
												Procedure for LOGIN
												<ul>
												<li>
												 You may logon to our website :www.marrsspellingbee.com </li>
												 <li>Click on the link "period 14-15"</li>
												 <li>On the website, click on LOGIN button and provide the above login credentials to login to your profile page.For the first time, use your CIN as your username and password. you may change the password after you login .</li>
												<li>Update your profile and verify whether the details entered are correct.</li>
												<li>You may practice the online contents by logging into your profile.</li>
                                               
                                           </b>'
                                       );   */
               //   $this->email->send(); 
                  
/* ========================= MAILING CODE ============================ ======================== */
	 
}                    /* END OF  for($i=0;$i<$no_stud_id;$i++) */

if($inserted_data==1)
 {	
     
		$this->notifications->notify('CIN Successfully Generated', 'success');  
 }
else
 {
	  $this->notifications->notify('CIN Generation Failed', 'error'); 	
 }		 
       $link_redirect=$this->session->userdata('link');
       redirect($link_redirect, 'refresh'); 	
}                                                             /* END OF ISSET OF POST */

    $data['services'] = $this->serviceModel->listservice();	
    $data['period']=$this->periodModel->listperiod();        /*$data['schools']=$this->schoolModel->listSchool();*/ 
	 $data['aim']=$uri['aim'];		   
	 $data['period_id']= $uri['period_id'];
	 $data['service_id']= $uri['service_id'];
	 $data['school_id']=$uri['school_id'];
	 $data['franchise_id']=$uri['franchise_id'];	 
    $this->load->view("list_Paid_students", $data);
        
}                                                          /* END OF INDEX FUNCTION  */

/*================================= ========================================== ================================*/


public function listDetails()
 {
	$service_id=$this->input->post('service_id');
	$params = array("service_id" => $service_id); 
	$data['franchise']=$this->franchiseModel->listFranchise($params);		    
	$data['period']=$this->periodModel->listperiod(); 
	$this->load->view("pid_list.php",$data); 
}/*end function  listDetails*/
   
/*================================= ========================================== ================================*/

public function list_schoolDetails()
   {
	$fr_id=$this->input->post('franchise_id');
	$params = array("fr_id" => $fr_id);
	$data['schools']=$this->schoolModel->listSchool($params);	 
	$this->load->view("pid_school_list.php",$data); 
  }/* end of function list_schoolDetails()*/ 
 /*================================= ========================================== ================================*/
 
public function view()
 {
   	
    if (isset($_POST['Search']))
	 {
		 $link = SITE_URL."assign_cin/view/aim/view_cin/";
		 
		 if ($this->input->post('period_id'))     {  $link .= "period_id/" .$this->input->post('period_id') . "/";          }
	     if ($this->input->post('franchise_id'))  {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";    }
 	     if ($this->input->post('service_id'))    {  $link .= "service_id/" . $this->input->post('service_id') . "/";       }
 	     if ($this->input->post('school_id'))     {  $link .= "school_id/" . $this->input->post('school_id') . "/";         }
		 
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
  	 
			 if($uri['period_id']!='' && $uri['service_id']!='')
			 {	
		         $params   = array(
								    'period_id'       => $uri['period_id'],							                  
									'franchise_id'    => $uri['franchise_id'],
									'school_id'       => $uri['school_id'],
									'service_id'      => $uri['service_id'],
									'aim'             => $aim	
						           );		
					 $data['list'] = $this->cinmodel-> paid_student_list($params);	
	   				                    
			   }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
			 	  
			   else		
			   {
			 	        $data['info']="empty";
			   }	
	   	      	
 	} /*END OF ELSE IF ISSET POST OF SEARCH*/
 	
 	if (isset($_POST['Export']))
	 {
	 	
	 	  
		  $params   = array(
								           'period_id' =>  $uri['period_id'],							                  
											  'franchise_id'  => $uri['franchise_id'],
											  'school_id'  => $uri['school_id'],
											  'service_id'=>$uri['service_id'],
											  'aim'=>'view_cin'
						               );	
						               
         $listcin= $this->cinmodel->paid_student_list($params);   /*echo "<pre>"; print_r($listcin);exit;*/
            /*echo "<pre>"; /*print_r($listcin);exit;
            echo "<br/>cin".$listcin[0]['cin'];exit;
            echo "name".$listcin[0]['first_name'].$listcin[0]['middle_name'].$listcin[0]['last_name'];
				echo "<br/>cin".$listcin[0]['cin'];
				echo "<br/>category".$listcin[0]['categoryKey'];
				echo "<br/>schoolname".$listcin[0]['school_name'];
				echo "<br/>school address".$listcin[0]['school_address'];
				echo "<br/>franchise".$listcin[0]['franchise_code']; 
				echo "<br/>state".$listcin[0]['state_subdivision_name']; exit;*/
				
				/*echo "<pre>";print_r($listcin);exit;*/
				$data=array();	
				$n=1;
		   foreach($listcin as $item)
		   {
		   	
		   	$item['serial_no']=$n;
			   $data []=array( 
			  
			   $item['serial_no'],
				$item['first_name']. " " .$item['middle_name']. " " .$item['last_name'],
				$item['cin'] ,
				$item['categoryKey']  ,
				$item['school_name']  ,
				$item['school_address'] ,
				$item['franchise_code'], 
				$item['state_subdivision_name'],
				$item['father_phone']." / ".$item['mother_phone'], 
				$item['father_email']." / ".$item['mother_email'],  
			);
			   /*echo $item['serial_no'];exit;*/
			$n++;
		}
		$this->csv->export($data,array('serialno','Student Name','Cin','Category','School Name','School Address','Franchise Code','State','ContactNumbers','EmailId'),'cinlist.csv');
		exit;
	 	
	 }
 	
 	
 	
        $data['services'] = $this->serviceModel->listservice();	
		  $data['period']=$this->periodModel->listperiod();   /*$data['schools']=$this->schoolModel->listSchool();*/

		  $data['period_id']= $uri['period_id'];
		  $data['service_id']= $uri['service_id'];
		  $data['school_id']=$uri['school_id'];
		  $data['franchise_id']=$uri['franchise_id'];
		  $data['aim']=$uri['aim'];
        $this->load->view("list_Paid_students", $data);
   	
   }
   
 /*=================================end of view function ========================================== ================================*/

/*=================================CREATED ON 16-3-2015 BY HIMA ========================================== ================================*/
	
	public function reset_to_cin() 
   {
	if (isset($_POST['Search'])) 
	{
		 
				$link = SITE_URL . "assign_cin/reset_to_cin/";	  
				if ($this->input->post('cin'))   {  $link .= "cin/" .$this->input->post('cin') . "/";  }
				redirect($link, 'refresh');
				$data['list']=$_POST;
	} /* End of  isset($_POST['Search']*/
	
	else
    {
     	     $data['info']='';
	         $uri = $this->uri->uri_to_assoc(4);
	         $aim=$uri['aim'];
             if($uri['cin']!='')
			 {	
			      $cin= $uri['cin']; 
			      $data['stud_data']=$this->cinmodel->get_CIN($cin); /*echo "<pre>";print_r($data['stud_data']);exit;*/
				  
				 if($data['stud_data']=='1')  {  echo  $this->notifications->notify('INVALID CIN', 'error'); }
				 else if($data['stud_data']=='2') { $this->notifications->notify('Password rest to CIN', 'success');}
			     else { $this->notifications->notify('Failed to rest CIN', 'error'); }
                 
             }	
		     else		 {    $data['info']="empty";     } /*END OF ELSE if*/
		   
	}
	  $this->load->view("password_reset_to_cin", $data);
	  
   }

/*=================================CREATED ON 16-3-2015 BY HIMA ========================================== ================================*/


/*public function export()
{
	
     /*echo "inside export fn0";exit;*/
		/*$this->load->library('csv');
		$params   = array(
								           'period_id' =>  $uri['period_id'],							                  
											  'franchise_id'  => $uri['franchise_id'],
											  'school_id'  => $uri['school_id'],
											  'service_id'=>$uri['service_id'],
											  'aim'=>'view_cin'
						               );		
      $listcin= $this->cinmodel->paid_student_list($params); print_r($listcin)  exit;	
		$data=array();	
		foreach($listschool as $item){
			$data[] =array(
				$item['school_name'],
				$item['principal_titile'] . " " .$item['school_principal_name']  ,
				$item['school_phone']  ,
				$item['school_email']  ,
				$item['school_city']  
			);
		}
		$this->csv->export($data,array('School Name','Principal Name','School Phone',	'School Email','City'),'schools.csv');
		exit;
	}*/


   } /*END OF CLASS*/
   
   
   
   
   