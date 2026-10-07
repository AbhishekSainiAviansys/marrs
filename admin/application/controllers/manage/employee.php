<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Employee extends CI_Controller 
{
    public function __construct() 
	{
        parent::__construct();
		
        $this->load->library('encrypt');
        $this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->model('locationModel');
        $this->load->model('departmentModel');
        $this->load->model('employeeModel');
        $this->load->model('employeeTypeModel');
		
    }//end function __construct
	
    public function index() {

        if (isset($_POST['Search'])) {
			
					$link =SITE_URL."employee/index/";
					if ($this->input->post('emp_dept_id')) 
					{
						$link.= 'emp_dept_id/' . $this->input->post('emp_dept_id') . "/";
					}
					/*--------------*/
					if ($this->input->post('emp_first_name')) 
					{
						$link.= "emp_first_name/" . $this->input->post('emp_first_name') . "/";
					}
					/*--------------*/
					if ($this->input->post('status')) 
					{
						$link.= "status/" . $this->input->post('status') . "/";
					}
					/*--------------*/
					redirect($link, 'refresh');
        }/*end if $_POST['Search'];*/
	    else 
		{
				$uri = $this->uri->uri_to_assoc(4);
				if (isset($uri['emp_dept_id'])) {
					$emp_dept_id = $uri['emp_dept_id'];
				} else {
					$emp_dept_id = '';
				}
				if (isset($uri['status'])) {
					$status = $uri['status'];
				} else {
					$cin = '';
				}
				if (isset($uri['emp_first_name'])) {
					$emp_first_name = $uri['emp_first_name'];
				} else {
					$name = '';
			}
                    $params       = array(
                'emp_dept_id' => $emp_dept_id,
                'status' => $status,
                'emp_first_name' => $emp_first_name
            );
            $data['list'] = $this->employeeModel->listEmployee($params);
       }
		$data['emp_status']=$this->employeeModel->enum_select('sb_employee','status');
		$data['departments']=$this->departmentModel->listDepartments();
        $data['emp_dept_id'] = $emp_dept_id;
        $data['status']  = $status;
        $data['emp_first_name']      = $emp_first_name;
        $this->load->view("employeeList.php", $data);
    }/*end function index*/
	
	public function add() 
	{
        $data['employeeID'] = '';
        $data['mode']   = 'Add';
        if(isset($_POST['submit'])) 
		{
            $hire_date       = $this->input->post('emp_hire_date');
            $timestamp = strtotime($hire_date);
			$emp_hire_date   =   date('Y-m-d', $timestamp);
            $dob       = $this->input->post('emp_dob');
            $timestamp = strtotime($dob);
			$dob     = date('Y-m-d', $timestamp);
			$data = array(
			                'emp_tiltle'=>$this->input->post('emp_tiltle'),
							'emp_first_name'=>$this->input->post('emp_first_name'),
							'emp_middle_name'=>$this->input->post('emp_middle_name'),
							'emp_last_name' => $this->input->post('emp_last_name'),
							'emp_dept_id' => $this->input->post('emp_dept_id'),
							'emp_reporting_officer_id' => $this->input->post('emp_reporting_officer_id'),
							'emp_type_id'=>$this->input->post('emp_type_id'),
							'emp_dob'=>$dob,
							'emp_gender' => $this->input->post('emp_gender'),
							'country_id' =>  $this->input->post('country_id'),
							'state_subdivision_id' =>  $this->input->post('state_subdivision_id'),
							'emp_ca' => $this->input->post('emp_ca'),
			                'emp_ca1' => $this->input->post('emp_ca1'),
					   	    'emp_ca_city' => $this->input->post('emp_ca_city'),
							'emp_ca_pincode'=>$this->input->post('emp_ca_pincode'),
							'emp_pa'=>$this->input->post('emp_pa'),
							'emp_pa1'=>$this->input->post('emp_pa1'),
							'emp_pa_city'=>$this->input->post('emp_pa_city'),								
							'emp_pa_pincode' => $this->input->post('emp_pa_pincode'),
							'emp_stdcode' => $this->input->post('emp_stdcode'),
							'emp_phone' => $this->input->post('emp_phone'),
							'emp_country_code'=>$this->input->post('emp_country_code'),
							'emp_mobile'=>$this->input->post('emp_mobile'),
							'emp_personal_email'=>$this->input->post('emp_personal_email'),
							'emp_official_email' => $this->input->post('emp_official_email'),
							'emp_code' => $this->input->post('emp_code'),
							'emp_idproof'=>$this->input->post('emp_idproof'),
							'emp_idproof_no'=>$this->input->post('emp_idproof_no'),
							'emp_blood_group' => $this->input->post('emp_blood_group'),
							'emp_hire_date' => $emp_hire_date,
							'emp_experience'=>$this->input->post('emp_experience'),
							'emp_past_history'=>$this->input->post('emp_past_history'),
							'emp_salary' => $this->input->post('emp_salary'),
							'emp_qualification' => $this->input->post('emp_qualification'),
							'emp_qualify_subject' => $this->input->post('emp_qualify_subject')
	                    );
			
			$this->form_validation->set_rules('emp_tiltle', 'Title', 'required');
            $this->form_validation->set_rules('emp_first_name','First Name','alpha|required');
            $this->form_validation->set_rules('emp_last_name', 'Last Name', 'alpha|required');
            $this->form_validation->set_rules('emp_dept_id', 'Department', 'required');

            $this->form_validation->set_rules('emp_reporting_officer_id','Reporting Officer','required');
            $this->form_validation->set_rules('emp_type_id', 'Employee Type', 'required');
            $this->form_validation->set_rules('emp_dob', 'Date of Birth', 'required');
			
            $this->form_validation->set_rules('emp_gender','Gender','required');
            $this->form_validation->set_rules('country_id','Country','required');
            $this->form_validation->set_rules('state_subdivision_id','State','required');
			
            $this->form_validation->set_rules('emp_ca', 'Communication Address1', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca1', 'Communication Address2', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca_city', 'Communication Address city', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca_pincode', 'Pincode', 'numeric|required');
			
            $this->form_validation->set_rules('emp_pa','Permanent Address1','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa1','Permanent Address2','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa_city','Permanent Address city','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa_pincode', 'Pincode', 'numeric|required');
            $this->form_validation->set_rules('emp_stdcode', 'std code', 'numeric|required');
            $this->form_validation->set_rules('emp_phone', 'Contact Number( Residence )', 'numeric|required');
            $this->form_validation->set_rules('emp_country_code','country code','required');
            $this->form_validation->set_rules('emp_mobile','Mobile Number','required');
            $this->form_validation->set_rules('emp_personal_email', 'Personal Email Id', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_personal_email1', 'does not match conform Personal Email','trim|matches[emp_personal_email]|required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_official_email', 'Official Email Id', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_official_email1', 'does not match conform Official Email ','trim|matches[emp_official_email]|required|valid_email|xss_clean');   
            $this->form_validation->set_rules('emp_code','Employee Code','alpha_numeric|required');
            $this->form_validation->set_rules('emp_idproof', 'ID Proof', 'required');
            $this->form_validation->set_rules('emp_idproof_no', 'ID Proof Number', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_blood_group','Blood Group','required');
            $this->form_validation->set_rules('emp_hire_date', 'Date of Join', 'required');
            $this->form_validation->set_rules('emp_experience', 'Work experience', 'alpha_numeric|required');
            $this->form_validation->set_rules('emp_past_history','Past Employment history','alpha|required');
            $this->form_validation->set_rules('emp_salary', 'Salary', 'numeric|required');
            $this->form_validation->set_rules('emp_qualification', 'Qualification', 'required');
            $this->form_validation->set_rules('emp_qualify_subject','Specialization','alpha|required');
			if ($this->form_validation->run() === FALSE) {
				  /* var_dump($this->validation->show_errors());*/
                $this->notifications->notify('Please make all entries', 'error');
            }/*end if*/
			else 
			{
                $res = $this->employeeModel->insert($data);
                redirect('manage/employee/index/','refresh');
            }/*end else/*/
		   $data['list'] = $_POST;	 
		   $data['mode']   = 'Add'; 
        }/*end if isset submit*/
		
			$data['departments']=$this->departmentModel->listDepartments();
			$data['employee_types']=$this->employeeTypeModel->listEmployeeTypes();
			$data['countries']   = $this->locationModel->listCountries();
			$data['stateatload'] = $this->locationModel->getstateatload();
        	$this->load->view("employeeAdd.php",$data);
    }/*end function add()*/
	
	
	
    public function edit() 
	{

        $data['mode']   = 'Edit';
        $uri            = $this->uri->uri_to_assoc(4);
        $data['employeeID'] = $uri['id'];
		
		if (isset($_POST['submit'])) 
		{
			$data['mode']   = 'Edit';
            $hire_date       = $this->input->post('emp_hire_date');
            $timestamp = strtotime($hire_date);
			$emp_hire_date     = date('Y-m-d', $timestamp);
            $dob       = $this->input->post('emp_dob');
            $timestamp = strtotime($dob);
			$dob     = date('Y-m-d', $timestamp);
			
		    $data = array(
							'emp_tiltle'=>$this->input->post('emp_tiltle'),
							'emp_first_name'=>$this->input->post('emp_first_name'),
							'emp_middle_name'=>$this->input->post('emp_middle_name'),
							'emp_last_name' => $this->input->post('emp_last_name'),
							'emp_dept_id' => $this->input->post('emp_dept_id'),
							'emp_reporting_officer_id' => $this->input->post('emp_reporting_officer_id'),
							'emp_type_id'=>$this->input->post('emp_type_id'),
							'emp_dob'=>$dob,
							'emp_gender' => $this->input->post('emp_gender'),
							'country_id' =>  $this->input->post('country_id'),
							'state_subdivision_id' =>  $this->input->post('state_subdivision_id'),
							'emp_ca' => $this->input->post('emp_ca'),
			                'emp_ca1' => $this->input->post('emp_ca1'),
					   	    'emp_ca_city' => $this->input->post('emp_ca_city'),
							'emp_ca_pincode'=>$this->input->post('emp_ca_pincode'),
							'emp_pa'=>$this->input->post('emp_pa'),
							'emp_pa1'=>$this->input->post('emp_pa1'),
							'emp_pa_city'=>$this->input->post('emp_pa_city'),								
							'emp_pa_pincode' => $this->input->post('emp_pa_pincode'),
							'emp_stdcode' => $this->input->post('emp_stdcode'),
							'emp_phone' => $this->input->post('emp_phone'),
							'emp_country_code'=>$this->input->post('emp_country_code'),
							'emp_mobile'=>$this->input->post('emp_mobile'),
							'emp_personal_email'=>$this->input->post('emp_personal_email'),
							'emp_official_email' => $this->input->post('emp_official_email'),
							'emp_code' => $this->input->post('emp_code'),
							'emp_idproof'=>$this->input->post('emp_idproof'),
							'emp_idproof_no'=>$this->input->post('emp_idproof_no'),
							'emp_blood_group' => $this->input->post('emp_blood_group'),
							'emp_hire_date' => $emp_hire_date,
							'emp_experience'=>$this->input->post('emp_experience'),
							'emp_past_history'=>$this->input->post('emp_past_history'),
							'emp_salary' => $this->input->post('emp_salary'),
							'emp_qualification' => $this->input->post('emp_qualification'),
							'emp_qualify_subject' => $this->input->post('emp_qualify_subject')
	                    );
				
            $this->form_validation->set_rules('emp_tiltle', 'Title', 'required');
            $this->form_validation->set_rules('emp_first_name','First Name','alpha|required');
            $this->form_validation->set_rules('emp_last_name', 'Last Name', 'alpha|required');
            $this->form_validation->set_rules('emp_dept_id', 'Department', 'required');

            $this->form_validation->set_rules('emp_reporting_officer_id','Reporting Officer','required');
            $this->form_validation->set_rules('emp_type_id', 'Employee Type', 'required');
            $this->form_validation->set_rules('emp_dob', 'Date of Birth', 'required');
			
            $this->form_validation->set_rules('emp_gender','Gender','required');
            $this->form_validation->set_rules('country_id','Country','required');
            $this->form_validation->set_rules('state_subdivision_id','State','required');
			
            $this->form_validation->set_rules('emp_ca', 'Communication Address1', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca1', 'Communication Address2', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca_city', 'Communication Address city', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_ca_pincode', 'Pincode', 'numeric|required');
			
            $this->form_validation->set_rules('emp_pa','Permanent Address1','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa1','Permanent Address2','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa_city','Permanent Address city','alpha_dash|required');
            $this->form_validation->set_rules('emp_pa_pincode', 'Pincode', 'numeric|required');
            $this->form_validation->set_rules('emp_stdcode', 'std code', 'numeric|required');
            $this->form_validation->set_rules('emp_phone', 'Contact Number( Residence )', 'numeric|required');
            $this->form_validation->set_rules('emp_country_code','country code','required');
            $this->form_validation->set_rules('emp_mobile','Mobile Number','required');
            $this->form_validation->set_rules('emp_personal_email', 'Personal Email Id', 'trim|required|valid_email|xss_clean');
            $this->validation->set_rules('emp_personal_email1', 'does not match conform Personal Email','trim|matches[emp_personal_email]|required|valid_email|xss_clean');
            $this->form_validation->set_rules('emp_official_email', 'Official Email Id', 'trim|required|valid_email|xss_clean');
            $this->validation->set_rules('emp_official_email1', 'does not match conform Official Email ','trim|matches[emp_official_email]|required|valid_email|xss_clean');   
            $this->form_validation->set_rules('emp_code','Employee Code','alpha_numeric|required');
            $this->form_validation->set_rules('emp_idproof', 'ID Proof', 'required');
            $this->form_validation->set_rules('emp_idproof_no', 'ID Proof Number', 'alpha_dash|required');
            $this->form_validation->set_rules('emp_blood_group','Blood Group','required');
            $this->form_validation->set_rules('emp_hire_date', 'Date of Join', 'required');
            $this->form_validation->set_rules('emp_experience', 'Work experience', 'alpha_numeric|required');
            $this->form_validation->set_rules('emp_past_history','Past Employment history','alpha|required');
            $this->form_validation->set_rules('emp_salary', 'Salary', 'numeric|required');
            $this->form_validation->set_rules('emp_qualification', 'Qualification', 'required');
            $this->form_validation->set_rules('emp_qualify_subject','Specialization','alpha|required');
			
            if ($this->form_validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } /*end if*/
			else {
                $res = $this->employeeModel->insert($data, $uri['id']);
                redirect('manage/employee/index/', 'refresh');
            }
			  
        }
		$data['departments']=$this->departmentModel->listDepartments();
		$data['employee_types']=$this->employeeTypeModel->listEmployeeTypes();
        $data['countries']   = $this->locationModel->listCountries();
        $data['stateatload'] = $this->locationModel->getstateatload();
		$data['list'] = $this->employeeModel->getEmployee($uri['id']);
        $this->load->view("employeeAdd.php", $data);
    }
	
	/*change status field of employee table /delete employeee*/
    public function changeStatus() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $res = $this->employeeModel->changeStatus($uri['id']);
            redirect('manage/employee/index/', 'refresh');
		}
	}
		
}/*end class*/