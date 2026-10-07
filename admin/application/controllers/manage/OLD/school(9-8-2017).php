<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class school extends CI_Controller
{
   public function __construct()
   {
	    parent::__construct();
        if (!$this->session->userdata('user_id')) { redirect('manage/login/', 'refresh'); }
        $this->load->library('encrypt');
        $this->load->library('session');
		$this->load->library('csv');
        $this->load->library('validation');
        $this->load->model('locationmodel');
        $this->load->model('schoolmodel');
        $this->load->model('franchisemodel');
    }/*end function _construct*/
    
	
/*  --------------------------------------- ------------------------------------------ ----------------------------  */

   public function index()
   {
	   
	   if (isset($_POST['Search'])) 
	  {
		  
		  if($this->input->post('stateID')!='')
		  {
		  
		     $search_data=array(
		                       'stateID'  =>$this->input->post('stateID'),
							   'fr_id'  =>$this->input->post('fr_id'),
							   'school_name'=>$this->input->post('school_name'),
		                    );
				//echo "<pre>";print_r($search_data);exit;			
			 $data['state_wise_schools']=$this->schoolmodel->state_wise_schools($search_data);			
		  
		  } /*end of if($this->input->post('stateID')!='') */
		  
		  else
		  {
			  $data['info']="empty";
		  }
		  
		} /* Else of  if (isset($_POST['Search']))*/
	   
	   if (isset($_POST['Export']))
		{
			$search_data=array(
		                       'stateID'  =>$this->input->post('stateID'),
							   'fr_id'  =>$this->input->post('fr_id'),
							   'school_name'=>$this->input->post('school_name'),
		                    );
				echo "<pre>";print_r($search_data);exit;			
			 $state_wise_schools=$this->schoolmodel->state_wise_schools($search_data);	
			 $data = array();
			$n    = 1;
			foreach ($state_wise_schools as $item) 
			{
				$item['serial_no'] = $n;
				$data[]            = array(
								$item['serial_no'],
								$item['school_code'],
								$item['access_code'],
								$item['school_name'],
								$item['school_address']."<br>".$item['school_address1'],
								$item['school_city']." pincode:-".$item['school_pincode'],
								$item['school_principal_name'],
								$item['franchise_code'],
								$item['state_subdivision_name'],
								$item['school_stdcode']."-".$item['school_phone'],
								$item['school_mobile'],
								$item['school_email'],
								$item['school_board'],
								$item['school_medium'],
								$item['school_concern_status'],
								$item['school_status'],
								
							);
							/*echo $item['serial_no'];exit;*/
							$n++;
					}
					$this->csv->export($data, array(
						'serialno','School Code ','Access Code','School','School Address ','City with pincode','Principal ',
						'Franchisee Code ','State','Phone','Mobile','Email','Board','School Medium','Concern Status','School Status',
					), 'schoollist.csv');
					exit;
		}
	   
	   
        $data['stateatload'] = $this->locationmodel->get_indian_states();
		$data['fr_id']=$fr_id;
		$data['stateID']=$stateID;
		$data['school_name']=$school_name;
        $this->load->view("schoolList.php", $data);
		
  }/*end function index*/
     
/*  --------------------------------------- ------------------------------------------ ----------------------------  */

	public function view()
	{
		extract($_FILES);
        $uri = $this->uri->uri_to_assoc(4);
		$school_id=$uri['id'];
		$school_data['school'] =$this->schoolmodel->getschool($school_id);
		$this->load->view("schoolProfile.php", $school_data);
		
	} /* End of function View*/

/*  --------------------------------------- ------------------------------------------ ----------------------------  */

    public function edit() 
	{
       $uri               = $this->uri->uri_to_assoc(4);
       $data['school_id'] = $uri['id'];
       $schoolID          = $uri['id'];
       if (isset($_POST['submit'])) 
	   {
           $scd       = $this->input->post('school_created_date');
           $timestamp = strtotime($scd);
           $cdate     = date('Y-m-d', $timestamp);
           $franchise_id = $this->input->post('franchise_id');
		   $val_insert_data      = array(
								'school_name'        => $this->input->post('school_name'),
								'affiliation_number' => $this->input->post('affiliation_number'),
								'school_code'        => $nschoolcode,
								'school_address'     => $this->input->post('school_address'),
								'school_address1'    => $this->input->post('school_address1'),
								'principal_titile'   => $this->input->post('principal_titile'),
								'school_principal_name'    => $this->input->post('school_principal_name'),
								'coordinator_titile'       => $this->input->post('coordinator_titile'),
								'school_coordinator_name'  => $this->input->post('school_coordinator_name'),
								'school_coordinator_email' => $this->input->post('school_coordinator_email'),
								'school_c_countrycode'     => $this->input->post('school_c_countrycode'),
								'sh_coordinator_phone'     => $this->input->post('sh_coordinator_phone'),
								'country_id'               => $this->input->post('country_id'),
								'stateID'                  => $this->input->post('stateID'),
								'school_city'              => $this->input->post('school_city'),
								'school_stdcode'           => $this->input->post('school_stdcode'),
								'school_phone'             => $this->input->post('school_phone'),
								'school_countrycode'       => $this->input->post('school_countrycode'),
								'school_mobile'            => $this->input->post('school_mobile'),
								'school_email'             => $this->input->post('school_email'),
								'school_board'             => $this->input->post('school_board'),
								'school_medium'            => $this->input->post('school_medium'),
								'school_concern_status'    => $this->input->post('school_concern_status'),
								'school_pincode'           => $this->input->post('school_pincode'),
								'school_latitude'          => $this->input->post('school_latitude'),
								'school_longitude'         => $this->input->post('school_longitude'),
								'school_created_date'      => $cdate
							);
            $this->validation->set_data($val_insert_data);
            $this->validation->set_rules('school_name', 'school name', 'required');
            $this->validation->set_rules('affiliation_number', 'affiliation number', 'required');
            $this->validation->set_rules('school_address', 'school address1', 'required');
            $this->validation->set_rules('school_address1', 'school address2', 'required');
            $this->validation->set_rules('principal_titile', 'title', 'required');
            $this->validation->set_rules('school_principal_name', 'principal name', 'required');
            $this->validation->set_rules('coordinator_titile', 'Title', 'required');
            $this->validation->set_rules('school_coordinator_name', 'school coordinator name', 'required');
            $this->validation->set_rules('school_coordinator_email', 'school coordinator email','trim|required|valid_email|xss_clean');
            $this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
            $this->validation->set_rules('school_c_countrycode', 'Country code', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'state', 'required');
            $this->validation->set_rules('school_city', 'school city', 'required');
            $this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
            $this->validation->set_rules('school_phone', 'school phone', 'required');
            $this->validation->set_rules('school_mobile', 'school mobile', 'required');
            $this->validation->set_rules('school_countrycode', 'countrycode', 'required');
            $this->validation->set_rules('school_email', 'school email', 'trim|required|valid_email|xss_clean');
            $this->validation->set_rules('school_board', 'school board', 'required');
            $this->validation->set_rules('school_medium', 'school medium', 'required');
            $this->validation->set_rules('school_concern_status', 'school concern status', 'required');
            $this->validation->set_rules('school_pincode', 'school pincode', 'required');
            $this->validation->set_rules('school_latitude', 'school latitude', 'required');
            $this->validation->set_rules('school_longitude', 'school longitude', 'required');
            $this->validation->set_rules('school_created_date', 'school created date', 'required');
           /*$this->validation->set_rules('is_competition_center', 'competition center', 'required');
             $this->validation->set_rules('school_email1', 'does not match  Email','matches[school_email]|trim|required|valid_email|xss_clean');         
             $this->validation->set_rules('school_coordinator_email1', 'does not match  Email','matches[school_coordinator_email]|trim|required|valid_email|xss_clean'); */  
		   
		   if ($this->validation->run() === FALSE)
		   {
               $this->notifications->notify('Please make all entries', 'error');   /*echo 	var_dump($this->validation->show_errors());*/
           } 
		   else 
		   {
			  $school_insert_status=$this->schoolmodel->insert($val_insert_data,$franchise_id,$schoolID, $is_competition_center);
			  if($school_insert_status)
			  {
                $this->notifications->notify('School updated successfully', 'success');
			  }
			  else
			  {
                $this->notifications->notify('School updated failed', 'error');
			  }
              redirect('manage/school/', 'refresh');
           }
        }/*end if isset submit*/
    
      $data['result'] = $_POST;
      $data['mode']        = 'Edit';
      $data['result']      = $this->schoolmodel->getschool($schoolID);
	  
      $data['countries']   = $this->locationmodel->listCountries();
      $data['stateatload'] = $this->locationmodel->getstateatload();
      $data['franchise'] = $this->franchisemodel->listFranchise();
      $this->load->view("schoolAdd.php", $data);
  
  }/*end function edit*/


/*  --------------------------------------- ------------------------------------------ ----------------------------  */

    public function delete() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $schoolID = $uri['id'];
            $this->notifications->notify('School Deleted successfully', 'success');
            $this->schoolmodel->changeStatus($schoolID);
            redirect('manage/school/', 'refresh');
        }
    }/*end function delete*/


/*  --------------------------------------- ------------------------------------------ ----------------------------  */
    
	public function Pending()
	{
        $params = array(
                         'status' => 'Pending'
                       );
        $data['plist'] = $this->schoolmodel->listschool($params);
        $this->load->view("schoolPendingList.php", $data);
    }/*end function pending*/
	
	
/*  --------------------------------------- ------------------------------------------ ----------------------------  */
	
	
   public function approve()
   {
        $uri = $this->uri->uri_to_assoc(4);
        $schoolID = $uri['id'];
        $getschool= $this->schoolmodel->getschool($schoolID);
        $franchise_refID= $getschool['franchise_id'];
        $getFranchise =  $this->franchisemodel->getFranchise($franchise_refID);
	    $pFranchiseCode =  $getFranchise['franchise_code'];
        $schoolcode = $this->schoolmodel->getlastschoolcode($pFranchiseCode);
        $output = str_split($schoolcode,4);
        $scode=$output[1];

        if($scode=='')
        {
	      $scode='1000';
        }
        $sc=$scode+1;
        $nschoolcode= $pFranchiseCode.'S'.$sc;  
        if (isset($uri['id']))
	    {
            $schoolID = $uri['id'];
            $status   = 'Active';
            $this->schoolmodel->changeStatus($schoolID, $status,$nschoolcode);
            redirect('manage/school/Pending', 'refresh');
        }
   }/*end function approve*/

/*  --------------------------------------- ------------------------------------------ ----------------------------  */


public function export(){
		$this->load->library('csv');
        $listschool= $this->schoolmodel->listschool($params);   	
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
	}
	 
	 
	 
	 
	public function import(){
		 	 if (isset($_POST['Filesubmit'])) {
			$this->load->library('csv');
		   $data = $this->csv->getContent($_FILES["file"]["tmp_name"]);
			unset($data[0],$data[1]);
			$importData =array();
			foreach($data as $item){
				
			}
 		 echo '<pre>'; print_r($data);
			  exit;
			
			}
			    $this->load->view("csvUpload.php", $data);
	}
	
	
	
		
    public function add() {
          if (isset($_POST['submit'])) {
            $scd       = $this->input->post('school_created_date');
            $timestamp = strtotime($scd);
            $cdate     = date('Y-m-d', $timestamp);
         $franchise_id = $this->input->post('franchise_id');
          $franchise_refID= $this->input->post('franchise_id');
        $getFranchise =  $this->franchisemodel->getFranchise($franchise_refID);
	    $pFranchiseCode =  $getFranchise['franchise_code'];
  $schoolcode = $this->schoolmodel->getlastschoolcode($pFranchiseCode);
$output = str_split($schoolcode,4);
 $scode=$output[1];

if($scode=='')
{
	$scode='1000';
}
 $sc=$scode+1;
 
    $nschoolcode= $pFranchiseCode.'S'.$sc;  
          $is_competition_center = $this->input->post('is_competition_center');
            $schoolID="";
            $data      = array(               
                'school_name' => $this->input->post('school_name'),
                'affiliation_number' => $this->input->post('affiliation_number'),
                'school_code' => $nschoolcode,
                'school_address' => $this->input->post('school_address'),
                'school_address1' => $this->input->post('school_address1'),
                'principal_titile' => $this->input->post('principal_titile'),
                'school_principal_name' => $this->input->post('school_principal_name'),
                'coordinator_titile' => $this->input->post('coordinator_titile'),
                'school_coordinator_name' => $this->input->post('school_coordinator_name'),
                'school_coordinator_email' => $this->input->post('school_coordinator_email'),
                'school_c_countrycode' => $this->input->post('school_c_countrycode'),
                'sh_coordinator_phone' => $this->input->post('sh_coordinator_phone'),
                'country_id' => $this->input->post('country_id'),
                'stateID' => $this->input->post('stateID'),
                'school_city' => $this->input->post('school_city'),
                'school_stdcode' => $this->input->post('school_stdcode'),
                'school_phone' => $this->input->post('school_phone'), 
                     'school_countrycode' => $this->input->post('school_countrycode'),
                'school_mobile' => $this->input->post('school_mobile'),
                'school_email' => $this->input->post('school_email'),
                'school_board' => $this->input->post('school_board'),
                'school_medium' => $this->input->post('school_medium'),
                'school_concern_status' => $this->input->post('school_concern_status'),
                'school_pincode' => $this->input->post('school_pincode'),
                'school_latitude' => $this->input->post('school_latitude'),
                'school_longitude' => $this->input->post('school_longitude'),
                'school_created_date' => $cdate,
				'school_status'  => 'Active'
            );
            $this->validation->set_data($data);
             $this->validation->set_rules('school_name', 'school name', 'required');
             $this->validation->set_rules('affiliation_number', 'affiliation number', 'required');
            $this->validation->set_rules('school_address', 'school address1', 'required');
                $this->validation->set_rules('school_address1', 'school address2', 'required');
                 $this->validation->set_rules('principal_titile', 'title', 'required');
            $this->validation->set_rules('school_principal_name', 'principal name', 'required');
             $this->validation->set_rules('coordinator_titile', 'Title', 'required');
            $this->validation->set_rules('school_coordinator_name', 'school coordinator name', 'required');
            $this->validation->set_rules('school_coordinator_email', 'school coordinator email','trim|required|valid_email|xss_clean');
  /*$this->validation->set_rules('school_coordinator_email1', 'does not match  Email','matches[school_coordinator_email]|trim|required|valid_email|xss_clean');*/   
            $this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
            $this->validation->set_rules('school_c_countrycode', 'Country code', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'state', 'required');
            $this->validation->set_rules('school_city', 'school city', 'required');
            $this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
            $this->validation->set_rules('school_phone', 'school phone', 'required');
              $this->validation->set_rules('school_mobile', 'school mobile', 'required');
            $this->validation->set_rules('school_countrycode', 'countrycode', 'required');
            $this->validation->set_rules('school_email', 'school email', 'trim|required|valid_email|xss_clean');
              /*$this->validation->set_rules('school_email1', 'does not match  Email','matches[school_email]|trim|required|valid_email|xss_clean');  */       
            $this->validation->set_rules('school_board', 'school board', 'required');
            $this->validation->set_rules('school_medium', 'school medium', 'required');
            $this->validation->set_rules('school_concern_status', 'school concern status', 'required');
            $this->validation->set_rules('school_pincode', 'school pincode', 'required');
            $this->validation->set_rules('school_latitude', 'school latitude', 'required');
            $this->validation->set_rules('school_longitude', 'school longitude', 'required');
            $this->validation->set_rules('school_created_date', 'school created date', 'required');
           /* $this->validation->set_rules('is_competition_center', 'competition center', 'required');*/
            if ($this->validation->run() === FALSE) {
              /* var_dump($this->validation->show_errors());*/
                                
                $this->notifications->notify('Please make all entries', 'error');
            } else {
            	$this->notifications->notify('School added successfully', 'success');
                $this->schoolmodel->insert($data,$franchise_id,$schoolID,$is_competition_center);
                redirect('manage/school/', 'refresh');
                
            }
            $data['result'] = $_POST;
        }/*end if isset submit*/
        $data['countries']   = $this->locationmodel->listCountries();
        $data['stateatload'] = $this->locationmodel->getstateatload();
         $data['franchise'] = $this->franchisemodel->listFranchise();
        $this->load->view("schoolAdd.php", $data);
    }/*end function add*/
    public function getstate() {
        $data['res'] = $this->locationmodel->listStates();
        $this->load->view("getStateAjax.php", $data);
    }/*end function getstate*/
	



}/*end class school*/

