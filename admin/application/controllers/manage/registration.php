<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Registration extends CI_Controller
 {
    public function __construct()
	 {
        parent::__construct();
         if (!$this->session->userdata('user_id'))
          {
             redirect('manage/login/', 'refresh');
          }
         $this->load->library('encrypt');
         $this->load->library('session');
         $this->load->library('validation');
		 $this->load->library('csv');
		 
         $this->load->model('servicemodel');
         $this->load->model('franchisemodel');
		 $this->load->model('periodmodel');
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
	  
	    echo $uri['aim'];
       if($uri['aim']=='approve')	
       {
     	    $link = SITE_URL . "registration/registrationList/aim/approve/";	  
		    if ($this->input->post('period_id'))                {  $link .= "period_id/" .$this->input->post('period_id') . "/";                        }
	        if ($this->input->post('franchise_id'))             {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";                  }
		    if ($this->input->post('cin'))                      {  $link .= "cin/" .$this->input->post('cin') . "/";                                    }
            if ($this->input->post('service_id'))               {  $link .= "service_id/" . $this->input->post('service_id') . "/";                     }  
            if ($this->input->post('competition_level_id'))     {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
            $this->session->set_userdata('link', $link);
            redirect($link, 'refresh');
            $data['list']=$_POST;
      }	
      if($uri['aim']=='approved_list')	
      {
     	    $link = SITE_URL . "registration/registrationList/aim/approved_list/";  
		    if ($this->input->post('period_id'))              {  $link .= "period_id/" .$this->input->post('period_id') . "/";                        }
	        if ($this->input->post('franchise_id'))           {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";                  }
		    if ($this->input->post('cin'))                    {  $link .= "cin/" .$this->input->post('cin') . "/";                                    }
            if ($this->input->post('service_id'))             {  $link .= "service_id/" . $this->input->post('service_id') . "/";                     }  
            if ($this->input->post('competition_level_id'))   {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
            redirect($link, 'refresh');
            $data['list']=$_POST;
      }	
      else
      {
		   $link = SITE_URL . "registration/registrationList/aim/reg_list_view/";	  
		   if ($this->input->post('period_id'))              {  $link .= "period_id/" .$this->input->post('period_id') . "/";                         }
	       if ($this->input->post('franchise_id'))           {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";                   }
		   if ($this->input->post('cin'))                    {  $link .= "cin/" .$this->input->post('cin') . "/";                                     }
           if ($this->input->post('service_id'))             {  $link .= "service_id/" . $this->input->post('service_id') . "/";                      }  
           if ($this->input->post('competition_level_id'))   {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/";  }
           redirect($link, 'refresh');
           $data['list']=$_POST;        
     }
  }/*end if(isset($_POST['bulk_search'])) */
  else
  {
     	     $data['info']='';
	         $uri = $this->uri->uri_to_assoc(4);
	         $aim=$uri['aim'];
			 $service_id=$uri['service_id'];		 
	         if( $uri['service_id']!="") 
		     {
				  
				   $params=array("service_id"=>$uri['service_id']);			   
	               $data['level']=$this->competitionlevelmodel->listcompetitionlevel($params);	
	               $data['franchise']=$this->franchisemodel->listFranchise($params);	             				 			  
		     }/* END ELSE OF if( $uri['service_id'] == "") */
             if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='')
			 {	
			      $params   = array(
										  'period_id'             =>  $uri['period_id'],							               
										  'competition_level_id'  =>  $uri['competition_level_id'],
										  'cin'                   => $uri['cin'],
										  'fr_id'          => $uri['franchise_id'],
										  'aim'                   => $aim								   
								   );
				  $data['list'] = $this->competitionregistermodel->registrationList_and_approvedList($params);  
															                    
           }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
		   else		 {    $data['info']="empty";     } /*END OF ELSE if($uri['period_id']!='' || $uri['service_id']!='' || $uri['competition_level_id']!='')*/
			 			          								
    }
/* ============ =================== ===================== ========================= =================== ================== */

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


	   $data['services'] = $this->servicemodel->listservice();
	   $data['period']=$this->periodmodel->listperiod();
	   $data['period_id']= $uri['period_id'];
	   $data['service_id']= $uri['service_id'];
	   $data['competition_level_id']= $uri['competition_level_id'];
	   $data['cin']=$uri['cin'];
	   $data['franchise_id']=$uri['franchise_id'];
	   $data['aim']=$uri['aim'];
	   
	   $this->load->view("registrationList.php",$data);
}   /*END OF FUNCTION public function registrationList()*/
	

	
/******************************--------------------------------------------********************************/	
	
public function view()
{
	$data['mode']   = 'View';
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
  
} /*END OF VIEW FUNCTION*/

/******************************--------------------------------------------********************************/	

public function edit()
{
   $data['mode']   = 'Edit';
   $uri            = $this->uri->uri_to_assoc(4);
   $data['reg_id'] = $uri['reg_id'];
   $registration_id=$uri['reg_id'];
   if (isset($_POST['submit'])) 
   {
		 $compatition_data = array(
									'receipt_number'=>$this->input->post('receipt_number'),
									'branch_name'=>$this->input->post('branch_name'),
									'receipt_date' => $this->input->post('receipt_date'),
									'competition_registration_id' => $registration_id,
					  );
		/*print_r($update_data);exit;	*/		  
				  
		 $res = $this->competitionregistermodel->insert($compatition_data); 
		 if($res==1)
		 {
			$this->notifications->notify('Updated successfully', 'success'); 
			redirect('manage/registration/view/reg_id/'.$registration_id, 'refresh');
		 }
		 else
		 {
			$this->notifications->notify('Updation Failed', 'error'); 

		 }
   } /*END OF ISSET*/	
   if(isset($uri['reg_id']))
   {  
		$param =array("status" => "reg","comp_reg_id" => $uri['reg_id']);
        $data['registration_details']   = $this->competitionregistermodel->viewRegistration($param);      
	}
   $this->load->view("registrationView", $data);
	
}/*END OF EDIT FUNCTION*/

/******************************--------------------------------------------********************************/

public function delete()
 {
 	    $data['mode']   = 'Delete';
        $uri = $this->uri->uri_to_assoc(4);
		$competition_registration_id=$uri['reg_id'];
		
        if (isset($competition_registration_id))
		 {
				$res = $this->competitionregistermodel->delete($competition_registration_id);
				if($res==1)
				{
						$this->notifications->notify('Deleted successfully', 'success'); 
						redirect('manage/registration/registrationList', 'refresh');
				}
				else
				{
				   $this->notifications->notify('Updation Failed', 'error'); 
				}
				redirect('manage/registration/registrationList/', 'refresh');
		}
}


/******************************--------------------------------------------********************************/

public function approve()
{
	 $uri = $this->uri->uri_to_assoc(4);
	 $params=array(
	                  "competition_registration_id" => $uri['reg_id'],
	                  "student_id" =>$uri['student_id'],
					  "status" => "approve_prn",
	                   );
	 $prn_status=$this->competitionregistermodel->get_TRN_PRN_count($params);
	 if($prn_status==1)
	 {
		$this->notifications->notify('Approved successfully', 'success'); 
		redirect('manage/registration/registrationList/aim/approve/period_id/4/service_id/1/competition_level_id/2/', 'refresh');
	 }
	 else
	 {
		$this->notifications->notify('Approved Failed', 'error'); 
	 }
	 redirect('manage/registration/registrationList/aim/approve', 'refresh');
	 
	 
}/*End of function approve()*/


/******************************--------------------------------------------********************************/



	
public function NoregistrationList()

{   


   if (isset($_POST['Search']))
	{
		
		/*echo "hai";exit;*/
		
		
		  $link = SITE_URL . "registration/NoregistrationList/";
			  
		  if ($this->input->post('period_id'))  {  $link .= "period_id/" .$this->input->post('period_id') . "/";    }
	     if ($this->input->post('franchise_id'))  {  $link .= "franchise_id/" .$this->input->post('franchise_id') . "/";    }
		  if ($this->input->post('cin'))  {  $link .= "cin/" .$this->input->post('cin') . "/";    }
        if ($this->input->post('service_id')) {  $link .= "service_id/" . $this->input->post('service_id') . "/"; }  
        if ($this->input->post('competition_level_id')) {  $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/"; }
             
            /*echo $link;exit;*/
            
             redirect($link, 'refresh');
             $data['list']=$_POST;
             
    }/*end if(isset($_POST['bulk_search'])) */
    
    else
     {
     	       $data['info']='';
	           $uri = $this->uri->uri_to_assoc(4);
	           
			    echo "uri['service_id']".$uri['service_id'];
				 if( $uri['service_id'] == "") 
				  {
					   $data['level']=$this->competitionlevelmodel->listcompetitionlevel();
					   $data['franchise']=$this->franchisemodel->listFranchise();
					  
				  } /*END OF if( $uri['service_id'] == "") */
				  
				  
				  else
				 {
						$params=array("service_id"=>$uri['service_id']);			   
		            $data['period']=$this->periodmodel->listperiod();
	               $data['level']=$this->competitionlevelmodel->listcompetitionlevel( $uri['service_id']);	
	               $data['franchise']=$this->franchisemodel->listFranchise($params);	             			
					 			  
				 }/* END ELSE OF if( $uri['service_id'] == "") */
     	
			    if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='')
			    {	
		            $params   = array(
								        'period_id' =>  $uri['period_id'],							               
								        'competition_level_id' =>  $uri['competition_level_id'],
										'cin'  => $uri['cin'],
											      'franchise_id'  => $uri['franchise_id']
						               );
							/*echo "controller paramas";print_r($params);	exit;	  */ 
					
					 $data['list'] = $this->competitionregistermodel->listNotRegistration($params);
						            
			              /*$data['list'] = $this->competitionregistermodel->listNotRegistration($params);   */ 
									          
			   }	/* END OF if($uri['period_id']!='' && $uri['service_id']!='' && $uri['competition_level_id']!='' )*/
			   else		
			   {        $data['info']="empty";
			   	
			    }	  /*END OF ELSE if($uri['period_id']!='' || $uri['service_id']!='' || $uri['competition_level_id']!='' )   */
			 			          								
  } /* END OF ELSE if (isset($_POST['Search']))*/

	    $data['services'] = $this->servicemodel->listservice();
		$data['period']=$this->periodmodel->listperiod();
		$data['period_id']= $uri['period_id'];
		$data['service_id']= $uri['service_id'];
		$data['competition_level_id']= $uri['competition_level_id'];
		$data['cin']=$uri['cin'];
		$data['franchise_id']=$uri['franchise_id'];
		
		$this->load->view("no_registrationList .php",$data);
}   /*END OF FUNCTION public function registrationList();*/

/******************************--------------------------------------------********************************/	

public function listDetails()
   {
   	
	       $service_id=$this->input->post('service_id');
		   $params = array("service_id" => $service_id); 
		   $data['franchise']=$this->franchisemodel->listFranchise($params);
		   $data['level']=$this->competitionlevelmodel->listcompetitionlevel($params);
		   $data['period']=$this->periodmodel->listperiod();
	       $this->load->view("list.php",$data); 
	       
   }/*end function  listDetails*/
   
   	
/******************************--------------------------------------------********************************/	
	
	
} /*END OF CLASS*/
