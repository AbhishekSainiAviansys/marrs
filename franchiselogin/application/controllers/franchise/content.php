<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Content extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        } 
        $this->load->library('validation');
        // $this->load->model('contentModel');
        $this->load->model('SchoolModel');
    }
    public function index() {
        $data['list'] = $this->contentModel->listcontentPosts();
        $this->load->view("contentList.php", $data);
    }
    // ============= bulk template ========== // 
    public function school_template(){
    //echo 'ok';die;
    $filepath="public/template/bulk_schoolnew.csv";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
    die();
    
}

    // ============== //
    public function add() {
        
        $this->load->view("contentAdd", $data);
    }
    public function edit() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
       
        if (isset($_POST['submit'])) {
            $data = array(
                'contentTitle' => $this->input->post('contentTitle'),
                'contentKey' => $this->input->post('contentKey'),
                'content' => $this->input->post('content'),
                'contentStatus' => $this->input->post('contentStatus'),
                'franchise_id' => $this->session->userdata('franchise_id'),
                'contentKey' => $this->input->post('contentKey')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('contentTitle', 'Title of content', 'required');
            $this->validation->set_rules('contentKey', 'Content key', 'required');
            $this->validation->set_rules('content', 'Content', 'required');
            $this->validation->set_rules('contentStatus', 'Status of content', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                $res = $this->contentModel->insert($data, $uri['id']);
                redirect('manage/content/index/', 'refresh');
            }
        }
		$data['mode']      = 'Edit';
        $data['list'] = $this->contentModel->getcontentPosts($uri['id']);
        $this->load->view("contentAdd.php", $data);
    }
    public function view() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
        $data['mode']      = 'View';
        $data['list']      = $this->contentModel->getcontentPosts($uri['id']);
        $this->load->view("contentAdd.php", $data);
    }
    public function delete() {
        $uri               = $this->uri->uri_to_assoc(4);
        $data['contentID'] = $uri['id'];
        $data['list']      = $this->contentModel->changeStatus($uri['id']);
        redirect('manage/content/index/', 'refresh');
    }
    
    public function school_add_bulk(){
       
       $franchise=$this->session->userdata('franchise_id');
       $this->db->select('*');
        $this->db->from('franchise');
       // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id'); 
        $this->db->where('franchise_id',$franchise);
		$get_STEP1_query   =  $this->db->get();
		$data['franchisedata']=$franchisedata=$get_STEP1_query->row();
       
       
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {
	       
		 $area_code=$this->input->post('area_code');
		$csvResult_upolad_logArray = array();
		$start_cell_row=2;/*skip first 2 heading rows */
		$i=0;
		
                    if($_FILES['csv']['size'] > 0) 
                    	{   
                    		  //get the csv file 
                    		  $file = $_FILES['csv']['tmp_name']; 
                    		  $handle = fopen($file,"r"); 
                    		  $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
                    		  $type = $_FILES['csv']['type'];
                    		  
                    		  if($ext === 'csv')
                    		  {
                    		  
                    			 //loop through the csv file and insert into database 
                    			do
                    			{	
                    			if($i >= $start_cell_row)
                    			{ /*echo "<br>"; echo $i ."-". $resultRow_from_csv[0];*/
                    			   if($resultRow_from_csv[0]) 
                    			   { 
                    				  $pin               =  addslashes($resultRow_from_csv[0]);
                    				//   $country            =  addslashes($resultRow_from_csv[1]);
                    				//   $state            =  addslashes($resultRow_from_csv[2]);
                    				  $district           =  addslashes($resultRow_from_csv[1]);
                    				  $city            =  addslashes($resultRow_from_csv[2]);
                    				  $school_name            =  addslashes($resultRow_from_csv[3]);
                    				  $affil            =  addslashes($resultRow_from_csv[4]);
                    				  $school_phone            =  addslashes($resultRow_from_csv[5]);
                    				  $school_mobile            =  addslashes($resultRow_from_csv[6]);
                    				  $address            =  addslashes($resultRow_from_csv[7]);
                    				  
                    				  $principal            =  addslashes($resultRow_from_csv[8]);
                    				//   $principal2            =  addslashes($resultRow_from_csv[11]);
                    				  $school_mail            =  addslashes($resultRow_from_csv[9]);
                    				  $board            =  addslashes($resultRow_from_csv[10]);
                    				  $medium            =  addslashes($resultRow_from_csv[11]);
                    				  $cordinator1           =  addslashes($resultRow_from_csv[12]);
                    				//   $cordinator2	            =  addslashes($resultRow_from_csv[16]);
                    				  $cordinator_mail  =  addslashes($resultRow_from_csv[13]);
                    				  $cordinator_mobile  =  addslashes($resultRow_from_csv[14]);
                    				  $principal_email  =  addslashes($resultRow_from_csv[15]);
                    				  $principal_phone =  addslashes($resultRow_from_csv[16]);
                    				//   $marrs_coordinator_last_name =  addslashes($resultRow_from_csv[20]);
                    				//   $marrs_coordinator_email =  addslashes($resultRow_from_csv[21]);
                    				//   $marrs_coordinator_phone =  addslashes($resultRow_from_csv[22]);
                    				  $csv_result_array  =  array(   'pin'  => $pin , 
                    				                                    // 'school_code'=>,
                    												  'country'  => $franchisedata->country_id,
                    												  'state' =>  $franchisedata->state_id,
                    												  'district'   => $district,
                    												  'city'   =>  $city,
                    												  'school_name' =>  $school_name,
                    												  'affiliation_number' =>  $affil ,
                    												  'school_phone'    =>  $school_phone,
                    												  'school_mobile'   =>  $school_mobile ,
                    												  'school_address'     =>  $address ,
                    												  
                    												  'school_principal_name'        =>  	$principal ,
                    												//   'principal_last_name'   => $principal2,
                    												  'school_email'  =>  $school_mail,
                    												  'school_board'  =>  $board ,
                    												  'school_medium'   =>  $medium,
                    												  'school_coordinator_name'  =>  $cordinator1 ,
                    												//   'school_cordinator_last_name'  =>  $cordinator2,
                    												  'school_coordinator_email'   =>  $cordinator_mail ,
                    												  'coordinator_phone'  =>  	$cordinator_mobile,
                    												  'franchise_id' => $franchise,
                    												 // 'misb_amount_code'=>$misb_amount,
                    												  'area_code'=>$area_code,
								                                      'principal_email'=>$principal_email,
								                                      'principal_phone'=>$principal_phone,
								                                    //   'marrs_coordinator_phone'=>$marrs_coordinator_phone
								                                      //'franchise_id'=>$franchise
                    											);
                    					
                    				
                    				    	
                    				 // print_r($csv_result_array);die;
                    				//   print_r($csv_product);die;
                    				//   $csv_upload_status = $this->SchoolModel->bulk_upload($csv_result_array,$items);
                    				   $csv_upload_status = $this->SchoolModel->bulk_upload_new($csv_result_array,$items);
                    				   array_push($csvResult_upolad_logArray,$csv_upload_status);
                    				   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
                    				   
                    				   //array_push($csvResult_upolad_logArray,$csv_upload_status);
                    			   }/*End if*/
                    			   
                    			  }
                    		  $i=$i+1;	
		 }while($resultRow_from_csv = fgetcsv($handle,1000));
		 
		 /*while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));*/
		  
			   /*............ End Do while ................*/
			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
			   /*unset($_FILES);*/
			    $this->notifications->notify('School Added Successfully','success');	
			 
		  }    /*END OF TYPE CHECKING*/
		  else
			{
					$this->notifications->notify('Not a csv file ','error');
			}/*END OF ELSE TYPE CHECKING*/
			   
		  
		  
			  
	   }/* End if */
	  }
		
		$this->db->select('*');
        $this->db->from('areas');
        $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id'); 
        $this->db->where('area_to_franchise.franchise_id',$franchise);
		//$this->db->where('period_id',$period);
		 //$this->db->where('product_id','35');
		$get_STEP1_query   =  $this->db->get();
		$data['areaload']=$get_STEP1_query->result_array();
	    	
		 $this->load->view("upload_school.php",$data);
        
    }
    
    
    public function bulk_upload() {
        // echo 'ok';die;
        $franchise=$this->session->userdata('franchise_id');
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {
	        $this->db->select('period_id');
         $this->db->from('period');
		 $this->db->where('status','Active');
// 		 $this->db->where('period_id',$period_id);
		 $get_STEP1_query   =  $this->db->get();
		 //echo "<br>"."<br>----".$this->db->last_query();exit;
		 $get_STEP1_result_row=$get_STEP1_query->result_array(); 
		  //print_r($get_STEP1_result_row[0]['period_id']);die;
		 $period  = $get_STEP1_result_row[0]['period_id'];
// 		echo $period;die;
	        $this->db->select('price_code');
         $this->db->from('price_codegenration');
		 $this->db->where('franchise_id',$franchise);
		 $this->db->where('period_id',$period);
		 //$this->db->where('product_id','35');
		 $get_STEP1_query   =  $this->db->get();
		 //echo "<br>"."<br>----".$this->db->last_query();exit;
		 $get_STEP1_result_row=$get_STEP1_query->result_array(); 
		  //print_r($get_STEP1_result_row[0]['period_id']);die;
		 $price_code  = $get_STEP1_result_row['price_code'];
		 $items=array();
	     foreach($get_STEP1_result_row as $value){
	       $items[] = $value['price_code'];
	     }
	     
	     // print_r($items);exit;
		$csvResult_upolad_logArray = array();
		$start_cell_row=2;/*skip first 2 heading rows */
		$i=0;
		
                    if($_FILES['csv']['size'] > 0) 
                    	{   
                    		  //get the csv file 
                    		  $file = $_FILES['csv']['tmp_name']; 
                    		  $handle = fopen($file,"r"); 
                    		  $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
                    		  $type = $_FILES['csv']['type'];
                    		  
                    		  if($ext === 'csv')
                    		  {
                    		  
                    			 //loop through the csv file and insert into database 
                    			do
                    			{	
                    			if($i >= $start_cell_row)
                    			{ /*echo "<br>"; echo $i ."-". $resultRow_from_csv[0];*/
                    			   if($resultRow_from_csv[0]) 
                    			   { 
                    				  $pin               =  addslashes($resultRow_from_csv[0]);
                    				  $country            =  addslashes($resultRow_from_csv[1]);
                    				  $state            =  addslashes($resultRow_from_csv[2]);
                    				  $district           =  addslashes($resultRow_from_csv[3]);
                    				  $city            =  addslashes($resultRow_from_csv[4]);
                    				  $school_name            =  addslashes($resultRow_from_csv[5]);
                    				  $affil            =  addslashes($resultRow_from_csv[6]);
                    				  $school_phone            =  addslashes($resultRow_from_csv[7]);
                    				  $school_mobile            =  addslashes($resultRow_from_csv[8]);
                    				  $address            =  addslashes($resultRow_from_csv[9]);
                    				  
                    				  $principal1            =  addslashes($resultRow_from_csv[10]);
                    				  $principal2            =  addslashes($resultRow_from_csv[11]);
                    				  $school_mail            =  addslashes($resultRow_from_csv[12]);
                    				  $board            =  addslashes($resultRow_from_csv[13]);
                    				  $medium            =  addslashes($resultRow_from_csv[14]);
                    				  $cordinator1           =  addslashes($resultRow_from_csv[15]);
                    				  $cordinator2	            =  addslashes($resultRow_from_csv[16]);
                    				  $cordinator_mail  =  addslashes($resultRow_from_csv[17]);
                    				  $cordinator_mobile  =  addslashes($resultRow_from_csv[18]);
                    				  //$misb_amount  =  addslashes($resultRow_from_csv[19]);
                    				  $marrs_coordinator_first_name =  addslashes($resultRow_from_csv[19]);
                    				  $marrs_coordinator_last_name =  addslashes($resultRow_from_csv[20]);
                    				  $marrs_coordinator_email =  addslashes($resultRow_from_csv[21]);
                    				  $marrs_coordinator_phone =  addslashes($resultRow_from_csv[22]);
                    				  $csv_result_array  =  array(   'school_pincode'  => $pin , 
                    												  'country_id'  => $country,
                    												  'stateID' =>  $state,
                    												  'school_district'   => $district,
                    												  'school_city'   =>  $city,
                    												  'school_name' =>  $school_name,
                    												  'affiliation_number' =>  $affil ,
                    												  'school_phone'    =>  $school_phone,
                    												  'school_mobile'   =>  $school_mobile ,
                    												  'school_address'     =>  $address ,
                    												  
                    												  'principal_first_name'        =>  	$principal1 ,
                    												  'principal_last_name'   => $principal2,
                    												  'school_email'  =>  $school_mail,
                    												  'school_board'  =>  $board ,
                    												  'school_medium'   =>  $medium,
                    												  'school_cordinator_first_name'  =>  $cordinator1 ,
                    												  'school_cordinator_last_name'  =>  $cordinator2,
                    												  'school_cordiantor_email'   =>  $cordinator_mail ,
                    												  'sc_cordinator_phone'  =>  	$cordinator_mobile,
                    												  'franchise_id' => $franchise,
                    												 // 'misb_amount_code'=>$misb_amount,
                    												  'marrs_coordinator_first_name'=>$marrs_coordinator_first_name,
								                                      'marrs_coordinator_last_name'=>$marrs_coordinator_last_name,
								                                      'marrs_coordinator_email'=>$marrs_coordinator_email,
								                                      'marrs_coordinator_phone'=>$marrs_coordinator_phone
								                                      //'franchise_id'=>$franchise
                    											);
                    					
                    				
                    				    	
                    				//   print_r($csv_result_array);die;
                    				//   print_r($csv_product);die;
                    				   $csv_upload_status = $this->SchoolModel->bulk_upload($csv_result_array,$items);
                    				   array_push($csvResult_upolad_logArray,$csv_upload_status);
                    				   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
                    				   
                    				   //array_push($csvResult_upolad_logArray,$csv_upload_status);
                    			   }/*End if*/
                    			   
                    			  }
                    		  $i=$i+1;	
		 }while($resultRow_from_csv = fgetcsv($handle,1000));
		 
		 /*while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));*/
		  
			   /*............ End Do while ................*/
			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
			   /*unset($_FILES);*/
			    $this->notifications->notify('School Added Successfully','success');	
			 
		  }    /*END OF TYPE CHECKING*/
		  else
			{
					$this->notifications->notify('Not a csv file ','error');
			}/*END OF ELSE TYPE CHECKING*/
			   
		  
		  
			  
	   }/* End if */
	  }
		
		$this->db->select('*');
        $this->db->from('areas');
        $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id'); 
        $this->db->where('area_to_franchise.franchise_id',$franchise);
		//$this->db->where('period_id',$period);
		 //$this->db->where('product_id','35');
		$get_STEP1_query   =  $this->db->get();
		$data['areaload']=$get_STEP1_query->result_array();
	    	
		 $this->load->view("upload_school.php",$data);
		
		
	} /* end of function generate_cin() */
    
}