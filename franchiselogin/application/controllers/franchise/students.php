<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Students extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        }
        $this->load->library('encrypt');
		$this->load->library('csv');
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('locationmodel');
        $this->load->model('schoolmodel');
        $this->load->model('studentsmodel');
    }
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */		
    public function index() 
	{
        $franchiseID = $this->session->userdata('franchise_id');
        if (isset($_POST['Search'])) 
		{
				$link = SITE_URL . "students/index/";
				if ($this->input->post('school_id')) { $link .= 'school_id/' . $this->input->post('school_id') . "/"; }
				if ($this->input->post('cin')) {$link .= "cin/" . $this->input->post('cin') . "/"; }
				if ($this->input->post('name')) {$link .= "name/" . $this->input->post('name') . "/"; }
				redirect($link, 'refresh');
        }/* End of IF  if (isset($_POST['Search'])) */
		else 
		{
				 $uri = $this->uri->uri_to_assoc(4);
				 if (isset($uri['school_id']))   {$school_id = $uri['school_id']; } 
				 else { $school_id = '';}
				 if (isset($uri['cin']))  { $cin = $uri['cin']; } 
				 else { $cin = ''; }
				 if (isset($uri['name'])) { $name = $uri['name'];}
				 else { $name = ''; }
				 $params       = array(
										'school_id' => $school_id,
										'cin' => $cin,
										'name' => $name,
										'franchiseID' => $franchiseID
									 );
				$data['list'] = $this->studentsmodel->listStudents($params);
        }/* End of else if (isset($_POST['Search']))*/
		$params       = array( 'fr_id' =>$this->session->userdata('franchise_id'));
        $data['schools']   = $this->schoolmodel->listSchool($params );
        $data['school_id'] = $school_id;
        $data['cin']       = $cin;
        $data['name']      = $name;
        $this->load->view("studentsList.php", $data);
    } /* End of function index() */
	
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */	
	
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
            }
            $dob       = $this->input->post('dob');
            $timestamp = strtotime($dob);
            $date      = date('Y-m-d', $timestamp);
            $franchise_id =  $this->session->userdata('franchise_id');
            $data      = array(
                                 'school_id'             => $this->input->post('school_id'),
                                 'country_id'            => $this->input->post('country_id'),
                                 'stateID'               => $this->input->post('stateID'),
                                 'first_name'            => $this->input->post('first_name'),
                                 'middle_name'           => $this->input->post('middle_name'),
                                 'last_name'             => $this->input->post('last_name'),
                                 'dob'                   => $date,
                                 'gender'                => $this->input->post('gender'),
                                 'photo'                 => $photo_path,
                                 'father_name'           => $this->input->post('father_name'),
                                 'mother_name'           => $this->input->post('mother_name'),
                                 'phone'                 => $this->input->post('phone'),
                                 'parent_id_proof'       => $this->input->post('parent_id_proof'),
                                 'parent_id_proof_no'    => $this->input->post('parent_id_proof_no'),
                                 'communication_address' => $this->input->post('communication_address'),
                                 'ca_pincode'            => $this->input->post('ca_pincode'),
                                 'permenet_address'      => $this->input->post('permenet_address'),
                                 'pa_pincode'            => $this->input->post('pa_pincode'),   
                                 'student_title'         => $this->input->post('student_title'),
                                 'father_name1'          => $this->input->post('father_name1'),
                                 'father_name2'          => $this->input->post('father_name2'),
                                 'mother_name1'          => $this->input->post('mother_name1'),
                                 'mother_name2'          => $this->input->post('mother_name2'),
                                 'communication_address1'=> $this->input->post('communication_address1'),
                                 'communication_address2'=> $this->input->post('communication_address2'),
                                 'permenet_address1'     => $this->input->post('permenet_address1'),
                                 'permenet_address2'     => $this->input->post('permenet_address2'),
                                 'father_email'          => $this->input->post('father_email'),
                                 'father_p_code'         => $this->input->post('father_p_code'),
                                 'father_phone'          => $this->input->post('father_phone'),
                                 'mother_p_code'         => $this->input->post('mother_p_code'),
                                 'mother_phone'          => $this->input->post('mother_phone'),
                                 'mother_email'          => $this->input->post('mother_email'),
                                 'mother_id_proof'       => $this->input->post('mother_id_proof'),
                                 'mother_id_proof_no'    => $this->input->post('mother_id_proof_no'),
                                 'std_code'              => $this->input->post('std_code')
                                );
            $this->validation->set_data($data);
            $this->validation->set_rules('school_id', 'School', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'State', 'required');
            $this->validation->set_rules('first_name', 'First Name', 'required');     
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
            $this->validation->set_rules('father_name2', 'Father last Name', 'required|alpha');
            $this->validation->set_rules('mother_name2', 'Mother last Name', 'required|alpha');
            
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
            
            if ($this->validation->run() === FALSE) 
            {
                $this->notifications->notify('Please make all entries', 'error');
            } 
            else
            { 
                  if ($flag != "") 
                  {
                    $this->notifications->notify('Photo uploading failed', 'error');
                  }
                  $this->studentsmodel->insert($data,$franchise_id);
                  redirect('franchise/students/', 'refresh');
           }
           $data['result'] = $_POST;
        }
        $data['countries']   = $this->locationmodel->listCountries();
        $data['stateatload'] = $this->locationmodel->getstateatload();
        $params              = array();
        $data['school']      = $this->schoolmodel->listSchool($params);
        $data['student_id']  = 'a';
        $this->load->view("studentsAdd.php", $data);
        
    }  /*End of function add*/

/**********************************************************************************************************************/

    public function edit() {
        extract($_FILES);
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $studentID = $uri['id'];
            $data['result'] = $this->studentsmodel->getStudent($studentID);
            if (empty($data['result'])) {
                redirect('franchise/students/', 'refresh');
            }
            if (isset($_POST['submit'])) {
                $img_val      = $this->studentsmodel->getStudent($studentID);
                $photo_val    = $img_val['photo'];
                $photo_unlink = "";
                if ($_FILES['photo']['name'] != "") {
                    if ($photo_val != '') {
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
                    }
                } else {
                    $photo_path = $photo_val;
                }
                $data['photo_unlink'] = $photo_unlink;
                $dob                  = $this->input->post('dob');
                $timestamp            = strtotime($dob);
                $date                 = date('Y-m-d', $timestamp);
                $franchise_id =  $this->session->userdata('franchise_id');
                $data                 = array
                                       (
                                         'school_id'             => $this->input->post('school_id'),
                                         'country_id'            => $this->input->post('country_id'),
                                         'stateID'               => $this->input->post('stateID'),
                                         'first_name'            => $this->input->post('first_name'),
                                         'middle_name'           => $this->input->post('middle_name'),
                                         'last_name'             => $this->input->post('last_name'),
                                         'dob'                   => $date,
                                         'gender'                => $this->input->post('gender'),
                                         'photo'                 => $photo_path,
                                         'father_name'           => $this->input->post('father_name'),
                                         'mother_name'           => $this->input->post('mother_name'),
                                         'phone'                 => $this->input->post('phone'),
                                         'parent_id_proof'       => $this->input->post('parent_id_proof'),
                                         'parent_id_proof_no'    => $this->input->post('parent_id_proof_no'),
                                         'communication_address' => $this->input->post('communication_address'),
                                         'ca_pincode'            => $this->input->post('ca_pincode'),
                                         'permenet_address'      => $this->input->post('permenet_address'),
                                         'pa_pincode'            => $this->input->post('pa_pincode'),   
                                         'student_title'         => $this->input->post('student_title'),
                                         'father_name1'          => $this->input->post('father_name1'),
                                         'father_name2'          => $this->input->post('father_name2'),
                                         'mother_name1'          => $this->input->post('mother_name1'),
                                         'mother_name2'          => $this->input->post('mother_name2'),
                                         'communication_address1'=> $this->input->post('communication_address1'),
                                         'communication_address2'=> $this->input->post('communication_address2'),
                                         'permenet_address1'     => $this->input->post('permenet_address1'),
                                         'permenet_address2'     => $this->input->post('permenet_address2'),
                                         'father_email'          => $this->input->post('father_email'),
                                         'father_p_code'         => $this->input->post('father_p_code'),
                                         'father_phone'          => $this->input->post('father_phone'),
                                         'mother_p_code'         => $this->input->post('mother_p_code'),
                                         'mother_phone'          => $this->input->post('mother_phone'),
                                         'mother_email'          => $this->input->post('mother_email'),
                                         'mother_id_proof'       => $this->input->post('mother_id_proof'),
                                         'mother_id_proof_no'    => $this->input->post('mother_id_proof_no'),
                                         'std_code'              => $this->input->post('std_code')
                                         
                                         
                                       );

                $this->validation->set_data($data);
            $this->validation->set_rules('school_id', 'School', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'State', 'required');
            $this->validation->set_rules('first_name', 'First Name', 'required');     
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
            $this->validation->set_rules('father_name2', 'Father last Name', 'required|alpha');
            $this->validation->set_rules('mother_name2', 'Mother last Name', 'required|alpha');
            
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
                if ($this->validation->run() === FALSE) {
                    /* var_dump($this->validation->show_errors());*/
                                        
                    $this->notifications->notify('Please make all entries', 'error');
                } else {
                    if ($flag != "") {
                        var_dump($this->validation->show_errors());
                        $this->notifications->notify('Photo uploading failed', 'error');
                    }
                    $this->studentsmodel->insert($data,$franchise_id,$studentID);
                    if (isset($photo_unlink)) {
                        $unlink_path = getcwd() . "/public/uploads/students/";
                        unlink($unlink_path . $photo_unlink);
                    }
                    redirect('franchise/students/', 'refresh');
                }
             $data['result'] = $_POST;
             /*echo '<pre>'; print_r( $data['result']);*/
            }
           
            $data['countries']   = $this->locationmodel->listCountries();
            $data['stateatload'] = $this->locationmodel->getstateatload();
            $params              = array();
            $data['school']      = $this->schoolmodel->listSchool($params);
            $this->load->view("studentsAdd.php", $data);
        }
    }
    public function getstate() {
        $data['res'] = $this->locationmodel->listStates();
        $this->load->view("getStateAjax.php", $data);
    }
    public function delete() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $studentID = $uri['id'];
            $this->studentsmodel->changeStatus($studentID);
            redirect('franchise/students/', 'refresh');
        }
    }
    public function Pending() {
        $params        = array(
            'status' => 'Pending'
        );
        $data['plist'] = $this->studentsmodel->listStudents($params);
		
        $this->load->view("studentPendingList.php", $data);
    }
	
	
/* 0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000 */
	
    public function approve() 
	{
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $studentID = $uri['id'];
            $status    = 'Active';
            $this->studentsmodel->changeStatus($studentID, $status);
            redirect('franchise/students/Pending', 'refresh');
        }
    }/* function approve()*/ 
	
	
	/* CREATED ON 7-8-14 @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
	public function Pending_Students()
    {
		$franchiseID = $this->session->userdata('franchise_id');
        $params        = array( 'status' => 'Pending' ,'franchiseID' => $franchiseID);
        $data['plist'] = $this->studentsmodel->list_new_registeration($params);
        if (isset($_POST['Export'])) 
		{
			$pending_list=$data['plist'];
            $data = array();
            $n    = 1;
            foreach ($pending_list as $item) {
                $item['serial_no'] = $n;
                $data[]            = array(
                    $item['serial_no'],
					$item['tac_number'],
                    $item['first_name'] . " " . $item['middle_name'] . " " . $item['last_name'],
                    $item['categoryKey'],
					$item['class_key'],
                    $item['school_name'],
                    $item['school_address'],
					$item['father_phone'],
					$item['father_email'],
					$item['mother_phone'],
					$item['mother_email'],
					$item['std_code']."-".$item['phone']
					
                );
                /*echo $item['serial_no'];exit;*/
               $n++;
            }
            $this->csv->export($data, array(
                'serialno','First Time Registration Code','Student Name','Category','Class','School Name','School Address','Father Mobile','Father Emailid',
				'Mother Mobile','Mother Emailid','Residential Phno',), 'new_registrationlist.csv');  exit;
        }
		$this->load->view("studentPendingList.php", $data);
    }
	/* CREATED ON 7-8-14 @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
	
	
	
}


