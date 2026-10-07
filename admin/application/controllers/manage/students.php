<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');
class Students extends CI_Controller
{
    public function __construct() 
	{
        parent::__construct();
        if (!$this->session->userdata('user_id')) { redirect('manage/login/', 'refresh'); }
        $this->load->library('encrypt');
        $this->load->library('session');
	    $this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->library('csv');
		$this->load->model('periodmodel');
        $this->load->model('locationmodel');
        $this->load->model('schoolmodel');
        $this->load->model('studentsmodel');
        $this->load->model('franchisemodel');
        $this->load->model('cinmodel');
    }
    
    
     
    
    
    
    
    
    
    
    
    public function index()
	{
       if(isset($_POST['Search']))
		 {
			    
				$period_id   = $this->input->post('period_id');
				$school_id   = $this->input->post('school_id');
				$cin         = $this->input->post('cin');
				$stud_name   = $this->input->post('stud_name');
				$franchiseID = $this->input->post('franchise_id');
			    
				$params       = array(
				                        'period_id'   => $period_id,
										'school_id'   => $school_id,
										'cin'         => $cin,
										'stud_name'   => $stud_name,
										'franchiseID' => $franchiseID 
									  );
				$data['period_id']      = $period_id;					  
				$data['school_id']      = $school_id;
				$data['cin']            = $cin;
				$data['stud_name']      = $stud_name;
				$data['franchise_id']   = $franchiseID;
				if($period_id!='' || $franchiseID!='' || $cin!='' || $stud_name!='')
				{
			       $data['stud_list']      = $this->studentsmodel->listStudents($params);
				  /* $student_list= $data['stud_list'];
				   $this->session->set_userdata('deliverdata', $data['stud_list'] );
				   $deliveryData   = $this->session->userdata('deliverdata'); 
				   print_r($deliveryData);exit;*/
				   
				}
				
				else
				{
					$this->notifications->notify('Please select any of the  search option', 'error');	
				}
				
		 }/*END of if(isset($_POST['Search']))*/
		if($franchiseID !='')
		{  
			$p=array('fr_id' => $franchiseID); 
			$data['post_schools']   = $this->schoolmodel->listSchool($p);	
	    }
		
	/* !!!!!!!!!!!!!!!!!!!! EXPORT CSV FILE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
		
	if(isset($_POST['Export']))
	{
					
	$franchiseID=$this->input->post('franchise_id');
	$period_id=$this->input->post('period_id');
	$school_id=$this->input->post('school_id');
	$cin=$this->input->post('cin');
	$stud_name=$this->input->post('stud_name');
	
	$params       = array(
				            'period_id'   => $period_id,
							'school_id'   => $school_id,
							'cin'         => $cin,
							'stud_name'   => $stud_name,
							'franchiseID' => $franchiseID 
						);
    $data['stud_list']      = $this->studentsmodel->listStudents($params);
	$listschool=$data['stud_list'];
    $data = array();
	$n    = 1;
	foreach ($listschool as $item):
	$item['serial_no'] = $n;
	$data[]  = array(
					  $item['serial_no'],
					  $item['period_name'],
					  $item['cin'],
					  $item['first_name']." ".$item['middle_name']." ".$item['last_name'],
					  $item['categoryKey'],
					  $item['school_name'],
					  $item['school_address']." ".$item['school_address1'],
					  $item['communication_address']." ".$item['communication_address1']." ".$item['communication_address2'],
					  $item['std_code']."-".$item['phone'],
					  $item['father_p_code']."-".$item['father_phone'],
					  $item['father_email'],
					  $item['franchise_code'],
					  $item['state_subdivision_name']
				   );
			$n++;
	endforeach;
	$this->csv->export($data, array('Slno','Period','CIN','Name','Category','School','School Address','Communication address','Land phone','Mobile number','Email','Fr_code','State'), 'studentlist.csv');
	exit;		
				
  }		
	    $data['period']=$this->periodmodel->listperiod();
        $data['franchise']     = $this->franchisemodel->listFranchise(); 
        $this->load->view("studentsList.php",$data);
    

	
}

/*   -------------------------------------------------------------------------  */	
	
	
public function edit()
 {
     extract($_FILES);
     $uri = $this->uri->uri_to_assoc(4);
     if (isset($uri['id'])) 
	 {
           $studentID = $uri['id'];
           if (isset($_POST['submit']))
		   {
                $img_val      = $this->studentsmodel->getStudent($studentID);
                $photo_val    = $img_val['photo'];
                $photo_unlink = "";
                if ($_FILES['photo']['name'] != "")
				 {
						if ($photo_val != '') 
						{
							$photo_chk    = explode("public/uploads/students/", $photo_val);
							$photo_unlink = $photo_chk[1];
						}
						$photo_path = "";
						$flag       = "";
						$f_type_chk = $_FILES['photo']['type'];
						if ($f_type_chk != "image/gif" && $f_type_chk != "image/jpg" && $f_type_chk != "image/jpeg" && $f_type_chk != "image/bmp" && $f_type_chk != "image/png" && $f_type_chk != "") {
							$flag = "Select allowed file type and size for photo";
						}
						if ($_FILES['photo']['size'] >= 5242880) {
							$flag = "Select allowed file type and size for photo";
						}
						$target_path = getcwd() . "/public/uploads/students/";
						$db_path     = "public/uploads/students/";
						if ($_FILES['photo']['name'] != '')
						{
							$file_name     = $_FILES["photo"]["name"];
							$file_size     = $_FILES["photo"]["size"] / 1024;
							$file_type     = $_FILES["photo"]["type"];
							$file_tmp_name = $_FILES["photo"]["tmp_name"];
							$random        = rand(111, 999);
							$new_file_name = $random . $file_name;
							$upload_path   = $target_path . $new_file_name;
							if (move_uploaded_file($file_tmp_name, $upload_path)) { $photo_path = addslashes($db_path . $new_file_name); } 
							else {
									var_dump($this->validation->show_errors());
									$this->notifications->notify('Photo canot upload', 'error');
							    }
                        }
                }  /*End of   if ($_FILES['photo']['name'] != "")*/
				else { $photo_path = $photo_val;   } /* Else of  if ($_FILES['photo']['name'] != "")*/
                $data['photo_unlink'] = $photo_unlink;
                $dob                  = $this->input->post('dob');
                $timestamp            = strtotime($dob);
                $date                 = date('Y-m-d', $timestamp);
                $franchise_id = $this->input->post('franchise_id');
                $insert_data                 = array(
                    'school_id' => $this->input->post('school_id'),
                    'country_id' => $this->input->post('country_id'),
                    'stateID' => $this->input->post('stateID'),
                    'first_name' => $this->input->post('first_name'),
                    'middle_name' => $this->input->post('middle_name'),
                    'last_name' => $this->input->post('last_name'),
                    'dob' => $date,
                    'gender' => $this->input->post('gender'),
                    'photo' => $photo_path,
                    'father_name' => $this->input->post('father_name'),
                    'mother_name' => $this->input->post('mother_name'),
                    'phone' => $this->input->post('phone'),
                    'parent_id_proof' => $this->input->post('parent_id_proof'),
                    'parent_id_proof_no' => $this->input->post('parent_id_proof_no'),
                    'communication_address' => $this->input->post('communication_address'),
                    'ca_pincode' => $this->input->post('ca_pincode'),
                    'permenet_address' => $this->input->post('permenet_address'),
                    'pa_pincode' => $this->input->post('pa_pincode'),
                    'student_title' => $this->input->post('student_title'),
					'father_name1' => $this->input->post('father_name1'),
					'father_name2' => $this->input->post('father_name2'),
					'mother_name1' => $this->input->post('mother_name1'),
					'mother_name2' => $this->input->post('mother_name2'),
					 'communication_address1' => $this->input->post('communication_address1'),
					'communication_address2' => $this->input->post('communication_address2'),
					'permenet_address1' => $this->input->post('permenet_address1'),
					'permenet_address2' => $this->input->post('permenet_address2'),
					'father_email' => $this->input->post('father_email'),
					'father_p_code' => $this->input->post('father_p_code'),
					'father_phone' => $this->input->post('father_phone'),
					'mother_p_code' => $this->input->post('mother_p_code'),
					'mother_phone' => $this->input->post('mother_phone'),
					'mother_email' => $this->input->post('mother_email'),
					 'mother_id_proof' => $this->input->post('mother_id_proof'),
					'mother_id_proof_no' => $this->input->post('mother_id_proof_no'),
					'std_code' => $this->input->post('std_code')
                );
                
                $this->validation->set_data($insert_data);
                $this->validation->set_rules('school_id', 'School', 'required');
                $this->validation->set_rules('country_id', 'country', 'required');
                $this->validation->set_rules('stateID', 'State', 'required');
                $this->validation->set_rules('first_name', 'First Name', 'required|alpha_space');
                $this->validation->set_rules('last_name', 'Last Name', 'required|alpha_space');
                $this->validation->set_rules('dob', 'Date Of Birth', 'required');
                $this->validation->set_rules('gender', 'Gender', 'required');
                $this->validation->set_rules('photo', 'Photo', 'required');
                $this->validation->set_rules('father_name', 'Father Name', 'required|alpha_space');
                $this->validation->set_rules('mother_name', 'Mother Name', 'required|alpha_space');
                $this->validation->set_rules('phone', 'phone', 'required');
            
                $this->validation->set_rules('parent_id_proof', 'Proof', 'required');
                $this->validation->set_rules('parent_id_proof_no', 'Proof No', 'required');
                $this->validation->set_rules('communication_address', 'Communication Address', 'required');
                $this->validation->set_rules('ca_pincode', 'Communication Pin', 'required');
                $this->validation->set_rules('permenet_address', 'Permenet Address', 'required');
                $this->validation->set_rules('pa_pincode', 'Permenet Pin', 'required');
                $this->validation->set_rules('student_title', 'title', 'required');
                $this->validation->set_rules('father_name2', 'Father last Name', 'required|alpha_space');
                $this->validation->set_rules('mother_name2', 'Mother last Name', 'required|alpha_space');
                $this->validation->set_rules('communication_address1', 'communication address1', 'required');
                $this->validation->set_rules('communication_address2', 'city', 'required');
                $this->validation->set_rules('permenet_address1', 'permenet address1', 'required');
                $this->validation->set_rules('permenet_address2', 'city', 'required');
                $this->validation->set_rules('father_email', 'father_email',  'trim|required|valid_email|xss_clean');
                $this->validation->set_rules('father_p_code', 'country code', 'required');
                $this->validation->set_rules('father_phone', 'father phonenumber ', 'required');
                $this->validation->set_rules('mother_email', 'mother_email',  'trim|required|valid_email|xss_clean');
                $this->validation->set_rules('mother_p_code', 'country code', 'required');
                $this->validation->set_rules('mother_phone', 'mother phonenumber ', 'required');
                $this->validation->set_rules('mother_id_proof', 'Proof', 'required');
                $this->validation->set_rules('mother_id_proof_no', 'Proof No', 'required');
                $this->validation->set_rules('std_code', 'std code', 'required');
                //$this->form_validation->set_rules('mother_email1', 'does not match  Email','trim|matches[mother_email]|required|valid_email|xss_clean');         
               // $this->form_validation->set_rules('father_email1', 'does not match  Email','trim|matches[father_email]|required|valid_email|xss_clean');
               // $this->validation->set_rules('father_name1', 'father midle name', 'required');
               // $this->validation->set_rules('middle_name', 'Middle Name', 'required');
		   
                if ($this->validation->run() === FALSE) 
				{
                    // var_dump($this->validation->show_errors());
                    $this->notifications->notify('Please make all entries', 'error');
                } 
				else 
				{
                   if ($flag != "") {$this->notifications->notify('Photo uploading failed', 'error'); }
                   $update_status= $this->studentsmodel->insert($insert_data, $franchise_id, $studentID);
				   
				   if($update_status)
				   {
				     $this->notifications->notify('Student updated successfully', 'success');
				   }
					 
                   if (isset($photo_unlink))
				   {
                      $unlink_path = getcwd() . "/public/uploads/students/";
                      unlink($unlink_path . $photo_unlink);
                   }
                   redirect('manage/students/', 'refresh');
                }
              
            }/*end if isset submit*/
            $data['result'] = $this->studentsmodel->getStudent($studentID);
           
            $data['countries']   = $this->locationmodel->listCountries();
            $data['stateatload'] = $this->locationmodel->getstateatload();
            $data['franchise']   = $this->franchisemodel->listFranchise();
            $params              = array();
            $data['school']      = $this->schoolmodel->listSchool($params);
            $this->load->view("studentsAdd.php", $data);
        }
    } /*End of Edit Function*/

	
/*   -------------------------------------------------------------------------  */	

public function view()
{
	$uri = $this->uri->uri_to_assoc(4);
	$studentID=$uri['id'];
	if(isset($uri['id'])) {  $data['studentProfileDetails']= $this->studentsmodel->getStudent($studentID); }
     $this->load->view("studentProfile.php",$data);	
}



	
	
/*   -------------------------------------------------------------------------  */	
	
    public function add() {
        if (isset($_POST['submit'])) {
            $photo_path = "";
            $flag       = "";
            $f_type_chk = $_FILES['photo']['type'];
            if ($f_type_chk != "image/gif" && $f_type_chk != "image/jpg" && $f_type_chk != "image/jpeg" && $f_type_chk != "image/bmp" && $f_type_chk != "image/png" && $f_type_chk != "") {
                $flag = "Select allowed file type and size for photo";
            }
            if ($_FILES['photo']['size'] >= 5242880) {
                $flag = "Select allowed file type and size for photo";
            }
            $target_path = getcwd() . "/public/uploads/students/";
            $db_path     = "public/uploads/students/";
            if ($_FILES['photo']['name'] != '') {
                $file_name     = $_FILES["photo"]["name"];
                $file_size     = $_FILES["photo"]["size"] / 1024;
                $file_type     = $_FILES["photo"]["type"];
                $file_tmp_name = $_FILES["photo"]["tmp_name"];
                $random        = rand(111, 999);
                $new_file_name = $random . $file_name;
                $upload_path   = $target_path . $new_file_name;
                if (move_uploaded_file($file_tmp_name, $upload_path)) {
                    $photo_path = addslashes($db_path . $new_file_name);
                } else {
                    var_dump($this->validation->show_errors());
                    $this->notifications->notify('Photo canot upload', 'error');
                }
            }            $dob          = $this->input->post('dob');
            $timestamp    = strtotime($dob);
            $date         = date('Y-m-d', $timestamp);
            $franchise_id = $this->input->post('franchise_id');
            $status       = 'Active';
            $data         = array
                            (
                             'school_id' => $this->input->post('school_id'),
                             'country_id' => $this->input->post('country_id'),
                             'stateID' => $this->input->post('stateID'),
                             'first_name' => $this->input->post('first_name'),
                             'middle_name' => $this->input->post('middle_name'),
                             'last_name' => $this->input->post('last_name'),
                             'dob' => $date,
                             'gender' => $this->input->post('gender'),
                             'photo' => $photo_path,
                             'father_name' => $this->input->post('father_name'),
                             'mother_name' => $this->input->post('mother_name'),
                             'phone' => $this->input->post('phone'), 
                             'parent_id_proof' => $this->input->post('parent_id_proof'),
                             'parent_id_proof_no' => $this->input->post('parent_id_proof_no'),
                             'communication_address' => $this->input->post('communication_address'),
                             'ca_pincode' => $this->input->post('ca_pincode'),
                             'permenet_address' => $this->input->post('permenet_address'),
                             'pa_pincode' => $this->input->post('pa_pincode'),
                             'status' => $status,
                             'student_title' => $this->input->post('student_title'),
                             'father_name1' => $this->input->post('father_name1'),
                             'father_name2' => $this->input->post('father_name2'),
                             'mother_name1' => $this->input->post('mother_name1'),
                             'mother_name2' => $this->input->post('mother_name2'),
                             'communication_address1' => $this->input->post('communication_address1'),
                             'communication_address2' => $this->input->post('communication_address2'),
                             'permenet_address1' => $this->input->post('permenet_address1'),
                             'permenet_address2' => $this->input->post('permenet_address2'),
                             'father_email' => $this->input->post('father_email'),
                             'father_p_code' => $this->input->post('father_p_code'),
                             'father_phone' => $this->input->post('father_phone'),
                             'mother_p_code' => $this->input->post('mother_p_code'),
                             'mother_phone' => $this->input->post('mother_phone'),
                             'mother_email' => $this->input->post('mother_email'),
                             'mother_id_proof' => $this->input->post('mother_id_proof'),
                             'mother_id_proof_no' => $this->input->post('mother_id_proof_no'),
                             'std_code' => $this->input->post('std_code')
                /* 'mobile' => $this->input->post('mobile'),*/
                      /*'emailID' => $this->input->post('emailID'),*/
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('school_id', 'School', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'State', 'required');
            $this->validation->set_rules('first_name', 'First Name', 'required');
           /* $this->validation->set_rules('middle_name', 'Middle Name', 'required');*/
            $this->validation->set_rules('last_name', 'Last Name', 'required');
            $this->validation->set_rules('dob', 'Date Of Birth', 'required');
            $this->validation->set_rules('gender', 'Gender', 'required');
            $this->validation->set_rules('photo', 'Photo', 'required');
            $this->validation->set_rules('father_name', 'Father first Name', 'required|alpha');
            $this->validation->set_rules('mother_name', 'Mother Name', 'required');
             $this->validation->set_rules('phone', 'phone', 'required');

            $this->validation->set_rules('parent_id_proof', 'Proof', 'required');
            $this->validation->set_rules('parent_id_proof_no', 'Proof No', 'required');
            $this->validation->set_rules('communication_address', 'Communication Address', 'required');
            $this->validation->set_rules('ca_pincode', 'Communication Pin', 'required');
            $this->validation->set_rules('permenet_address', 'Permenet Address', 'required');
            $this->validation->set_rules('pa_pincode', 'Permenet Pin', 'required');
            $this->validation->set_rules('student_title', 'title', 'required');
           /* $this->validation->set_rules('father_name1', 'father midle name', 'required');*/
            $this->validation->set_rules('father_name2', 'Father last Name', 'required|alpha');
            $this->validation->set_rules('mother_name2', 'Mother last Name', 'required|alpha');
              $this->validation->set_rules('communication_address1', 'communication address1', 'required');
             $this->validation->set_rules('communication_address2', 'city', 'required');
              $this->validation->set_rules('permenet_address1', 'permenet address1', 'required');
               $this->validation->set_rules('permenet_address2', 'city', 'required');
            $this->validation->set_rules('father_email', 'father_email',  'trim|required|valid_email|xss_clean');
         /* $this->form_validation->set_rules('father_email1', 'does not match  Email','trim|matches[father_email]|required|valid_email|xss_clean');*/
            $this->validation->set_rules('father_p_code', 'country code', 'required');
            $this->validation->set_rules('father_phone', 'father phonenumber ', 'required');
             $this->validation->set_rules('mother_email', 'mother_email',  'trim|required|valid_email|xss_clean');
  /*$this->form_validation->set_rules('mother_email1', 'does not match  Email','trim|matches[mother_email]|required|valid_email|xss_clean');     */    
            $this->validation->set_rules('mother_p_code', 'country code', 'required');
            $this->validation->set_rules('mother_phone', 'mother phonenumber ', 'required');
              $this->validation->set_rules('mother_id_proof', 'Proof', 'required');
            $this->validation->set_rules('mother_id_proof_no', 'Proof No', 'required');
            $this->validation->set_rules('std_code', 'std code', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                if ($flag != "") {
                    $this->notifications->notify('Photo uploading failed', 'error');
                }
                $this->notifications->notify('Students added successfully', 'success');
                $this->studentsmodel->insert($data, $franchise_id);
                redirect('manage/students/', 'refresh');
            }
            $data['result'] = $_POST;
        }/*end if isset submit*/
        $data['countries']   = $this->locationmodel->listCountries();
        $data['stateatload'] = $this->locationmodel->getstateatload();
        $data['franchise']   = $this->franchisemodel->listFranchise();
        $params              = array();
        $data['school']      = $this->schoolmodel->listSchool($params);
        $data['student_id']  = 'a';
        $this->load->view("studentsAdd.php", $data);
    }
    public function getstate() {
        $data['res'] = $this->locationmodel->listStates();
        $this->load->view("getStateAjax.php", $data);
    }

    public function delete() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $studentID = $uri['id'];
            $this->notifications->notify('Students Deleted successfully', 'success');
            $this->studentsmodel->changeStatus($studentID);
            redirect('manage/students/', 'refresh');
        }
    }
    public function Pending() {
        $params        = array(
            'status' => 'Pending'
        );
        $data['plist'] = $this->studentsmodel->listStudents($params);
        $this->load->view("studentPendingList.php", $data);
    }
    public function approve() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $studentID = $uri['id'];
            $status    = 'Active';
            $this->studentsmodel->changeStatus($studentID, $status);
            redirect('manage/students/Pending', 'refresh');
        }
    }
    public function student_list(){
        echo 'ok';die;
    }
    
}


