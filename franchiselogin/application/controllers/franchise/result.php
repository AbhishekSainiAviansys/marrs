<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Result extends CI_Controller {
/*....................................................................................................................*/	
   
    public $mark_overview = array();
    public function __construct() {
    	
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
	     $this->load->library('validation');
        $this->load->helper('form');
		
       /*$this->CI =& get_instance();   */    
	   
	    $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
		
        $this->load->library('csv');
		$this->load->library('email');
		$this->load->helper('download');
		
// 		$this->load->model('resultmodel');
 //       $this->load->model('servicemodel');
        // $this->load->model('schoolmodel');
        $this->load->model('franchisemodel');
		
        // $this->load->model('competitionlevelmodel');
// 		$this->load->model('competitioncentermodel');
        // $this->load->model('Categorymodel');
		
        // $this->load->model('cinmodel');
        // $this->load->model('periodmodel');
    } /*end function __constructfranchisemodel*/
/*....................................................................................................................*/	
    public function index() {
        // echo 'ok';die;
        $franchise_id = $this->session->userdata('franchise_id');
        $data['franchise']=$franchise = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row_array();
        
        
            if(isset($_POST['submit'])) 
            {
                $data['result']=$_POST;
                try {
                    // print_r($franchise);die;
                    $this->db->select('cin_list.*, cin_result.*, cin_result.status as result_status, competition_level_byproduct.level_name');
                    $this->db->from('cin_list');
                    $this->db->join('cin_result', 'cin_result.cin = cin_list.cin');
                    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel', 'left');
                    
                    $this->db->where('cin_result.product_name',$_POST['product']);
                    $this->db->where('cin_result.period_id',$_POST['period']);
                    $this->db->where('cin_result.clevel',$_POST['level']);
                    if($_POST['class']!=''){
                        $this->db->where('cin_list.class',$_POST['class']);
                    }
                    if($_POST['status']!=''){
                        $this->db->where('cin_result.status',$_POST['status']);
                    }
                    if($_POST['area']!=''){
                        $this->db->where('cin_list.franchise_code',$_POST['area']);
                    }
                    if($_POST['school']!=''){
                        $this->db->where('cin_list.school_id',$_POST['school']);
                    }
                    $this->db->where('cin_list.state_id',$franchise['state_id']);
                    $this->db->where('cin_result.status !=','');
                    $this->db->group_by('cin_list.cin');
                    $query = $this->db->get();

                    // echo $this->db->last_query();
                    
                    // $this->db->select('cin_list.*,cin_result.*,cin_result.status as result_status,competition_level_byproduct.level_name');
                    // $this->db->from('cin_list');
                    // $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                    // $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel','left');
                    // $this->db->where('cin_result.product_name',$_POST['product']);
                    // $this->db->where('cin_result.period_id',$_POST['period']);
                    // $this->db->where('cin_result.clevel',$_POST['level']);
                    // // $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                    // if($_POST['class']!=''){
                    //     $this->db->where('cin_list.class',$_POST['class']);
                    // }
                    // if($_POST['status']!=''){
                    //     $this->db->where('cin_result.status',$_POST['status']);
                    // }
                    // if($_POST['area']!=''){
                    //     $this->db->where('cin_list.franchise_code',$_POST['area']);
                    // }
                    // if($_POST['school']!=''){
                    //     $this->db->where('cin_list.school_id',$_POST['school']);
                    // }
                    // $this->db->where('cin_list.state_id',$franchise['state_id']);
                    // $this->db->where('cin_result.status !=','');
                    // // $this->db->group_by('cin_list.cin');
                    // $query = $this->db->get();
                    
                    
            
                    if ($query) {
                        $data['student'] = $query->result_array();
                        if(empty($data['student'])) {
                            $data['message'] = 'Students result not found with selected parameters...';
                        }
                    } else {
                        // Log the query and any database errors
                        $error_message = $this->db->error()['message'];
                        error_log("Database error: $error_message. Query: " . $this->db->last_query());
                        $data['message'] = 'An error occurred while fetching data from the database.';
                    }
                } catch (Exception $e) {
                    // Log any exceptions that might occur during query execution
                    error_log('Exception caught: ' . $e->getMessage());
                    $data['message'] = 'An unexpected error occurred. Please try again later.';
                }
                
            }
            
            if(isset($_POST['Export'])) 
            {

                    $this->db->select('cin_list.*, cin_result.*, cin_result.status as result_status, competition_level_byproduct.level_name');
                    $this->db->from('cin_list');
                    $this->db->join('cin_result', 'cin_result.cin = cin_list.cin');
                    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel', 'left');
                    
                    $this->db->where('cin_result.product_name',$_POST['product']);
                    $this->db->where('cin_result.period_id',$_POST['period']);
                    $this->db->where('cin_result.clevel',$_POST['level']);
                    if($_POST['class']!=''){
                        $this->db->where('cin_list.class',$_POST['class']);
                    }
                    if($_POST['status']!=''){
                        $this->db->where('cin_result.status',$_POST['status']);
                    }
                    if($_POST['area']!=''){
                        $this->db->where('cin_list.franchise_code',$_POST['area']);
                    }
                    if($_POST['school']!=''){
                        $this->db->where('cin_list.school_id',$_POST['school']);
                    }
                    $this->db->where('cin_list.state_id',$franchise['state_id']);
                    $this->db->where('cin_result.status !=','');
                    $this->db->group_by('cin_list.cin');
                    $query = $this->db->get();
                    $student=$query->result_array();
               
                    $pe= $this->db->get_where('period',array('period_id'=>$this->input->post('period_id')))->row_array();
                    $academic_year=$pe['academic_year'];
                   $n=1;
                   //echo $status;die;
        		  foreach($student as $item)
        		  {
    		      if(empty($item['school_name'])){
    		      $school_name = $this->db->get_where('school_new',array('id'=>$item['school_id']))->row()->school_name;
    		      }else{
    		        $school_name = $item['school_name'].' - '.$school_name['school_address'];
    		      } 
    		      
    		   	    $item['serial_no']=$n;
        		    $data1 []=array( 
            		
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'],
        			   $item['stud_email'],
        			   
        			   $this->input->post('product'),
        			   $school_name,
        			   $item['franchise_code'],
        			   $item['status'],
        			   $item['rank'],
        			   $item['marks'],
        			   $item['grade'],
        			   $item['level_name']
        			   );
    			   $file_name=$this->input->post('product')."_".$academic_year;
    			$n++;
    		}
		//echo $file_name;die;
		//print_r($data1);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School','Area','status','Rank','Marks','Grade','Level'));
                $cnt=1;
                foreach ($data1 as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	        
        }
        
        $this->db->select('*');
        $this->db->from('areas');
        $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
        $this->db->where('area_to_franchise.franchise_id',$franchise_id);
        $query=$this->db->get();
        $data['areaload']=$query->result_array();
        
        $this->db->select('*');$this->db->from('period');$this->db->where('period_id >','12');$query=$this->db->get();
        $data['periodload']=$query->result_array();
        $this->db->select('*');$this->db->from('class');$query=$this->db->get();
        $data['classload']=$query->result_array();
        $this->db->select('*');$this->db->from('products');$this->db->where('products.status','Active');$query=$this->db->get();
        $data['productload']=$query->result_array();
        
        if(isset($data['result']['product'])){
            
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product']);
            $query=$this->db->get();
            $data['levelload']=$query->result_array();
        }
                
        if(isset($data['result']['area'])){
            $this->db->select('*');
            $this->db->from('school_new');
            $this->db->where('area_code',$data['result']['area']);
            $this->db->order_by('school_name','ASC');
            $query=$this->db->get();
            $data['schoolload']=$query->result_array();
        }
            
        
        $this->load->view("export_result.php", $data);
	    
    } /*end function index*/
	
	/*@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@*/	

    public function upload_marks() 
	{
		
        $fr_id = $this->session->userdata('franchise_id');
		$service_id=$this->session->userdata('fr_service_id');
	/*  if(isset($_POST['submit_result']))
	   {
		 $students=$this->input->post('students');
      	 foreach($students as $stud_id=>$details):
		 	    $student_id= $stud_id;
			 foreach($details as $comp_id=>$round_marks ):
			        $competition_schedule_id=$comp_id;
			 	  foreach($round_marks as $comp_round_id =>$mark):
					  endforeach;
			 endforeach;
		 endforeach;exit;
	   }
	   */
	   
       if(isset($_POST['stud_search'])) 
		{
            $link = SITE_URL . "result/upload_marks/";
			
            if ($this->input->post('period_id') != '') {
                $link .= "period_id/" . $this->input->post('period_id') . "/";
            }
			
            if ($this->input->post('competition_level_id') != '') {
                $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/";
            }
			
            if ($this->input->post('competition_center_id') != '') {
                $link .= "competition_center_id/" . $this->input->post('competition_center_id') . "/";
            }
			
            if ($this->input->post('category_id') != '') {
                $link .= "category_id/" . $this->input->post('category_id') . "/";
            }
			
			
            if ($this->input->post('school_id') != '') {
			    $school_id = $this->input->post('school_id');
                $school_id =  str_replace('%20', '', $school_id);
			    $link .= "school_id/" . trim($school_id) . "/";
					  $link = rawurldecode($link);
				
			   /* $link .= "school_id/  " . trim($school_id) . "/";*/
            }
            /* if ($this->input->post('service_id') != '') {
                $link .= "service_id/" . $this->input->post('service_id') . "/";
            }*/
			
            /*echo "---".$link;*/
            redirect($link, 'refresh');
            $data['list'] = $_POST;
        }
        /*end if(isset($_POST['bulk_search'])) */
        else 
		{			$data['info'] = '';
					$uri          = $this->uri->uri_to_assoc(4);
					$params       = array("service_id" => $service_id);
					/*$data['levels']   = $this->competitionlevelmodel->listcompetitionlevel($params);
					$data['category'] = $this->Categorymodel->listCategory($params);*/
			   if ($uri['period_id'] != '' && $uri['competition_level_id'] != '' && $uri['category_id'] != '') 
			   {				
				  $search_data  = array(
								'period_id' => $uri['period_id'],
								'service_id' => $service_id,
								'competition_level_id' => $uri['competition_level_id'],
								'competition_center_id' => $uri['competition_center_id'],
								'school_id' => $uri['school_id'],
								'category_id' => $uri['category_id']
							   );
							   
				  $data['search_data']=$search_data;
				  $data['returned_list'] = $this->resultmodel->studentlist_result_view($search_data);
				  $data['mark_entry_status'] = $this->resultmodel->check_mark_entry($search_data);
                  $data['result_sent_to_HO_status'] = $this->resultmodel->get_result_HO_status($search_data);				  
				  /*echo "result_sent_to_HO_status  : ";print_r($data['result_sent_to_HO_status']);*/

				  
				  $data['period_id'] = $uri['period_id'];
				  $data['category_id'] = $uri['category_id'];
				  $mark_entry_status_array["level_name"]=$comp_level['competition_level_name'];
				} 
				else 
				{    $data['info'] = "empty";   }/*end else*/
        } /*end outer else*/
		
		$params    = array(
			"service_id" => $service_id,
            "fr_id" => $fr_id
        );
        $data['periods']   = $this->periodmodel->listperiod();
        $data['services']  = $this->servicemodel->listservice();
        $data['franchise'] = $this->franchisemodel->listFranchise($params);
        $data['levels']    = $this->competitionlevelmodel->listcompetitionlevel($params);
        $data['category']  = $this->Categorymodel->listCategory($params);
        $data['periods']   = $this->periodmodel->listperiod();
        $data['school']    = $this->schoolmodel->listSchool($params);
		
		$data['service_id']            = $service_id ;
        $data['competition_level_id']  = $uri['competition_level_id'];
		$data['competition_center_id'] = $uri['competition_center_id'];
        $data['school_id']             = trim($uri['school_id']);
		$data['site_reload_link']      = $link;
		
		$this->load->view("upload_result.php", $data);
		
    }


     		/* $cinRequest_emailMessage = $this->cinmodel->export_cinRequestList($params);	*/
            /* $status = $this->email->send(); 
			 if($status=='1')
			   { $this->notifications->notify('<font color="#FF0000" ><b>Feedback sent Successfully<b></font>', 'success'); } /*End if */
			/* else 
			   {  
			      $this->notifications->notify('<font color="#FF0000"><b>Sorry ! Email Sent Failed<b></font>', 'error');	} /*End else*/
			  /*    $this->notifications->notify('CIN Request send Successfully', 'success');
            /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /*end function public */
   /* public function listDetails() {
		if($this->input->post('service_id')!='')
        $service_id        = $this->input->post('service_id');
		else
		$service_id=$this->session->userdata('fr_service_id');
		
        $fr_id             = $this->session->userdata('franchise_id');
        $params            = array(
            "bulk_service_id" => $service_id,
			"service_id" => $service_id,
            "fr_id" => $fr_id
        );
        $data['franchise'] = $this->franchisemodel->listFranchise($params);
        $data['levels']    = $this->competitionlevelmodel->listcompetitionlevel($params);
        $data['category']  = $this->Categorymodel->listCategory($params);
        $data['periods']   = $this->periodmodel->listperiod();
        $data['school']    = $this->schoolmodel->listSchool($params);
        $this->load->view("detailView.php", $data);*/
/*    }/*end function  listDetails*/
	
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    public function listVenue() 
	{
      $levelID        = $this->input->post('level_id');
      $fr_id             = $this->session->userdata('franchise_id');
      $params            = array( "levelID" => $levelID, "fr_id" => $fr_id  );
      $data['venue'] = $this->competitioncentermodel->listcompetition_center($params); 
	  $this->load->view("view_venue.php", $data);
	}/* End function  listVenue*/
	
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function saveRoundmarks()
	{
      $studID = $this->input->post('studID');
      $compID = $this->input->post('compID');
	  $compRoundID = $this->input->post('compRoundID');
	  $mark = $this->input->post('mark');
      $mark_params    = array( "studID" => $studID,  "compID" => $compID,  "compRoundID" => $compRoundID ,"mark" => $mark);
      $status = $this->resultmodel->saveRoundmarks($mark_params);    
	  echo $status;
    }/*End Function SaveRoundmarks*/

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    public function view_result()
    {
        $fr_id = $this->session->userdata('franchise_id');
        /*echo $fr_id;exit;*/
        if (isset($_POST['Search'])) 
		{
            $link = SITE_URL . "result/view_result/aim/export/";
            if ($this->input->post('period_id') != '') {
                $link .= "period_id/" . $this->input->post('period_id') . "/";
            }
            if ($this->input->post('competition_level_id') != '') {
                $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/";
            }
            if ($this->input->post('school_id') != '') {
                $link .= "school_id/" . $this->input->post('school_id') . "/";
            }
            redirect($link, 'refresh');
            $data['result_list'] = $_POST;
        }
        /*end if(isset($_POST['Search'])) */
        else 
		{
            $uri            = $this->uri->uri_to_assoc(4);
            /* print_r($uri);exit;*/
			
            if ($uri['period_id'] != '' ) 
			{
                $params = array(
                    'period_id' => $uri['period_id'],
                    'franchise_id' => $fr_id,
                    'school_id' => $uri['school_id'],
                    'competition_level_id' => $uri['competition_level_id']
                );
              $data['result_list'] = $this->resultmodel->franchiselist_result($params);
            } 
			else 
			{
                $data['info'] = "empty";
            }
        }/*End of else */
        
        if (isset($_POST['Export'])) 
		{
			
                $params = array(
                    'period_id' => $uri['period_id'],
                    'franchise_id' => $fr_id,
                    'school_id' => $uri['school_id'],
                    'competition_level_id' => $uri['competition_level_id']
                );
        
		  $listResult=  $this->resultmodel->franchiselist_result($params);
		 /* print_r($listResult);exit;*/
          $data = array();
          $n    = 1;
          foreach ($listResult as $item) {
                $item['serial_no'] = $n;
				$item['school']    =  $item['school_name']." , ".$item['school_address'];
				/*----------------------------------------------------------*/

				if($item['father_email'] !='')
				  {    $item['Email']     =  $item['father_email'];   }
				
				if($item['mother_email'] !='')
				  {    
				       if($item['Email']!='')
					      { $item['Email']     .=  " , ".$item['mother_email'];  }
					   else 
					      { $item['Email']     .= $item['mother_email'];  }  
				  }/* End if */
				/*----------------------------------------------------------*/
				
				if($item['father_phone'] !='')
				  {    $item['Mobile']     =  $item['father_phone'];   }
				if($item['mother_phone'] !='')
				  {    
				       if($item['Mobile']!='')
					      { $item['Mobile']     .=  " , ".$item['mother_phone'];  }
					   else 
					      { $item['Mobile']     .= $item['mother_phone'];  }  
				  }				  
				/*----------------------------------------------------------*/
				
				$item['Mobile']     ='';
				if($item['father_phone'] !='')
				  {    $item['Mobile']     =  $item['father_phone'];   }
				if($item['mother_phone'] !='')
				  {    
				       if($item['Mobile']!='')
					      { $item['Mobile']     .=  " , ".$item['mother_phone'];  }
					   else 
					      { $item['Mobile']     .= $item['mother_phone'];  }  
				  }				  
				/*----------------------------------------------------------*/
				$item['LandPone'] =  $item['std_code']." - ".$item['phone'];
				
                $data[]            =
				 array(
						$item['serial_no'],
						$item['competition_level_name'],
						$item['period_name'],
						$item['first_name'] . " " . $item['middle_name'] . " " . $item['last_name'],
						$item['cin'],
						$item['class_key'],
						$item['categoryKey'],
						$item['school'],
						$item['temperory_registration_number'],
						$item['permenent_registration_number'],
						$item['status'],
						$item['franchise_code'],
						$item['Email'],
						$item['Mobile'],
						$item['LandPone']
                );
                /*echo $item['serial_no'];exit;*/
                $n++;
            }/*End foreach */
            $this->csv->export($data, array(
                'SiNo',
				'Competition level888888888888',
				'Period',
				'Student Name',
                'CIN',
				'Class',
                'Category',
				'School',
				'TRN',
                'PRN',
                'Result Status',
				'franchise_code',
				'Email',
				'Mobile',
				'LandPone'
            ), 'result_list.csv');
            exit;
        }
		
		
        $data['periods']              = $this->periodmodel->listperiod();
		$params                       = array('service_id' => 1);
		$data['levels']               = $this->competitionlevelmodel->listcompetitionlevel($params);
        $param         = array("fr_id" => $fr_id);
        $data['school'] = $this->schoolmodel->listSchool($param);
        $data['aim']                  = $uri['aim'];
        $data['competition_level_id'] = $uri['competition_level_id'];
        $data['period_id']            = $uri['period_id'];
        $data['school_id']            = $uri['school_id'];
        $this->load->view("view_result.php", $data);
    }


    public function search_result()
    {
        $fr_id = $this->session->userdata('franchise_id');
        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$fr_id))->row();
        
        $this->db->select('*');
        $this->db->from('areas');
        // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
        // $this->db->where('area_to_franchise.franchise_id',$fr_id);
        $this->db->where('areas.state_id',$franchise->state_id);
        $query=$this->db->get();
        $data['area']=$query->result_array();
        
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            
                $this->db->select('*,cin_result.status as result_status');
                $this->db->from('cin_result');
                $this->db->join('cin_list','cin_list.cin=cin_result.cin');
                $this->db->join('period','period.period_id=cin_result.period_id');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
                $this->db->where('cin_result.cin',$_POST['cin']);
                $this->db->where('cin_result.product_name',$_POST['product']);
                $this->db->where('cin_result.clevel',$_POST['level']);
                $this->db->where('cin_result.status !=','');
                $this->db->where('cin_result.period_id',$_POST['period_id']);
                $this->db->group_by('cin_result.cin');
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // echo $this->db->last_query();die;
                $data['result']=$_POST;
        }
        
        
        if (isset($_POST['export'])) {
            
            $this->db->select('*,cin_result.status as result_status');
            $this->db->from('cin_result');
            $this->db->join('cin_list','cin_list.cin=cin_result.cin');
            $this->db->join('period','period.period_id=cin_result.period_id');
            $this->db->join('areas','areas.area_code=cin_list.franchise_code');
            $this->db->join('school_new','school_new.id=cin_list.school_id','left');
            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
            $this->db->where('cin_result.cin',$_POST['cin']);
            $this->db->where('cin_result.product_name',$_POST['product']);
            $this->db->where('cin_result.clevel',$_POST['level']);
            $this->db->where('cin_result.status !=','');
            $this->db->where('cin_result.period_id',$_POST['period_id']);
            $this->db->group_by('cin_result.cin');
            $query=$this->db->get();
            $cin_list=$query->result_array();
            
            $n = 1;
            $student = array();
        
            foreach ($cin_list as $item) {
                $item['serial_no'] = $n;
        
        
                // Append the product name to the data
                $student[] = array(
                    $item['serial_no'],
                    //$item['period_id'],
                    $item['cin'],
                    $item['student_name'],
                    $item['stud_phone'],
                    $item['stud_email'],
                    $item['class'],
                    $item['father_name'],
                    $item['mother_name'],
                    $item['school_name'],
                    $item['result_status'],
                    $item['grade'],
                    $item['marks'],
                    $item['rank'],
                    $item['academic_year'],
                );
        
                $n++;
            }
        
            // Define the CSV headers (including Product Name)
            $this->csv->export($student, array('Slno', 'Cin', 'Name', 'Mobile', 'Email', 'Class', 'Father Name', 'Mother Name', 'School', 'Status', 'Grade', 'Marks','Rank','Session'), 'studentlist.csv');
            exit;
        }

        if (isset($_POST['download'])) {
            $level = $this->input->post('clevel');
            $sch = $this->input->post('schedule_id');
            $cin = $this->input->post('cin');
        
            // Validate required fields
            if (empty($level) || empty($sch) || empty($cin)) {
                die("Error: Missing required parameters.");
            }
        
            // Fetch product name from database
            $this->db->select('product_name');
            $this->db->from('cin_result');
            $this->db->where('cin', $cin);
            $query = $this->db->get();
            $res = $query->row();
        
            if (!$res) {
                die("Error: CIN not found in cin_result table.");
            }
        
            $product = $res->product_name;
        
            $data = array(
                'cin' => $cin,
                'clevel' => $level,
                'schedule' => $sch,
                'product' => $product,
            );
            // print_R($data);die;
            $postFields = json_encode($data);

        
            // Initialize cURL session
            $curl = curl_init();
        
            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.aviansys.in/certificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                
                CURLOPT_POSTFIELDS => $postFields,
            
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));
    
    
            $response = curl_exec($curl);
            curl_close($curl);
            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=downloaded.pdf");
        
            echo $response;
        }

        
        if(isset($data['result']['school'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('school_new.area_code',$data['result']['area_code']);
            $this->db->where('school_new.state',$franchise->state_id);
            $query=$this->db->get();
            $data['school']=$query->result_array();
        }
        
        if(isset($data['result']['product'])){
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('competition_level_byproduct.product_name',$data['result']['product']);
            $query=$this->db->get();
            $data['load_level']=$query->result_array();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['periodload'] = $this->db->get_where('period',array('period_id >'=>12))->result_array();
        
       $this->load->view("search_result.php",$data); 
    
        
    }

    public function api_call() 
    {
        $level = $this->uri->segment(3);
        $sch = $this->uri->segment(4);
        $cin = $this->uri->segment(5);
    
        // Fetch product name
        $this->db->select('*');
        $this->db->from('cin_result');
        $this->db->where('cin', $cin);
        $query = $this->db->get();
        $res = $query->row();
    
        if (!$res) {
            die("Error: CIN not found in cin_result table.");
        }
    
        $product = $res->product_name;
    
        // Prepare API data
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'schedule' => $sch,
            'product' => $product,
        );
        print_r($data);die;
        $postFields = json_encode($data);

        
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.aviansys.in/certificate',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                
                CURLOPT_POSTFIELDS => $postFields,
            // CURLOPT_POSTFIELDS =>'{
            //     "cin": "23SBAC510133",
            //     "clevel": "1",
            //     "schedule": "710",
            //     "product": "MaRRS International Spelling Bee"    
            // }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));
    
    
        $response = curl_exec($curl);
    
        curl_close($curl);

            // 🔹 Clean any previous output before sending the PDF
            ob_clean();
            flush();
        // Set headers for PDF download
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=downloaded.pdf");
    
        // Output the PDF response
        echo $response;
    }

}/*end class*/