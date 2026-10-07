<?php
class StudentsModel extends CI_Model {
    function __construct()
	 {
        parent::__construct();
        $this->load->database();$this->load->library('encrypt');
		
    }/*end function __construct*/

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */

	public function loginCheck()
	 {
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->db->select('*');
        $this->db->from('student_to_cin');
        $this->db->where(array(
								'cin' => $username,
								'status' => 'Active'
       						 ));
		$query = $this->db->get();
		/*echo  $this->db->last_query(); exit;*/
      /* echo"SHLOKA123                     is". $cin= $this->encrypt->encode('SHLOKA123', ENC_KEY);exit;*/
        $row   = $query->row_array();
        //echo $this->encrypt->decode($row['password'], ENC_KEY);die;
        if ($query->num_rows() > 0 && $this->encrypt->decode($row['password'], ENC_KEY) == $password)
        {
            $agent = $this->input->user_agent();
            $ip    = $this->input->ip_address();
            $data  = array(
                'user_id' => $row['student_id'],
                'user_agent' => $agent,
                'user_type' => 'student',
                'ip' => $ip
            );
            $str   = $this->db->insert('userlog', $data);
            return $row;
        }/*end if*/
        else
            return false;                                                                                                                                                                        
    }/*end function logincheck*/
    
    
   public function paidlevelloginCheck()
	 {
	$username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->db->select('*');
        $this->db->from('paidschoolstudent_to_cin');
        $this->db->where(array(
								'cin' => $username,
								'status' => 'Active'
       						 ));
		$query = $this->db->get();
		//echo  $this->db->last_query(); exit;
      /* echo"SHLOKA123                     is". $cin= $this->encrypt->encode('SHLOKA123', ENC_KEY);exit;*/
        $row   = $query->row_array();
        //print_r($row);die;
       // echo $query->num_rows();die;
        //echo $row['password'];die;
        if ($query->num_rows() > 0 && $row['password'] == $password)
        {
            $agent = $this->input->user_agent();
            $ip    = $this->input->ip_address();
            $data  = array(
                'user_id' => $row['student_id'],
                'user_agent' => $agent,
                'user_type' => 'student',
                'ip' => $ip
            );
            $str   = $this->db->insert('userlog', $data);
            return $row;
        }/*end if*/
        else
            return false;                                                                                                  
    }/*end function logincheck*/
    
    
     public function freelevelloginCheck()
	 {
	$username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->db->select('*');
        $this->db->from('sb_freeschoolstudent_to_cin');
        $this->db->where(array(
								'cin' => $username,
								'status' => 'Active'
       						 ));
		$query = $this->db->get();
		//echo  $this->db->last_query(); exit;
      /* echo"SHLOKA123                     is". $cin= $this->encrypt->encode('SHLOKA123', ENC_KEY);exit;*/
        $row   = $query->row_array();
        //print_r($row);die;
       // echo $query->num_rows();die;
        //echo $row['password'];die;
        if ($query->num_rows() > 0 && $row['password'] == $password)
        {
            $agent = $this->input->user_agent();
            $ip    = $this->input->ip_address();
            $data  = array(
                'user_id' => $row['student_id'],
                'user_agent' => $agent,
                'user_type' => 'student',
                'ip' => $ip
            );
            $str   = $this->db->insert('userlog', $data);
            return $row;
        }/*end if*/
        else
            return false;                                                                                                  
    }/*end function logincheck*/
    public function check_complete_freelevelprofile($id) 
	{
			//echo $id;die;
			$this->db->select('sb_freeschoolstudents.*');
			$this->db->from('sb_freeschoolstudents');
			 
			/*$this->db->where('profile_status','no');*/
			$this->db->where('student_id',$id);
			$query = $this->db->get();//echo $this->db->last_query();exit;
		    $result=$query->row_array();
			return $result;
			/*$profile_status=$result['profile_status'];
			return $profile_status;*/
	}
    public function getpaidlevelStudent($studentID)
	 {
		 //echo $studentID;exit;
			$this->db->select('sb_paidschoolstudents.*,sb_paidschoolstudent_to_cin.cin');

			$this->db->from('sb_paidschoolstudents');
            
 $this->db->join('sb_paidschoolstudent_to_cin','sb_paidschoolstudent_to_cin.student_id = sb_paidschoolstudents.student_id');
			
			$this->db->where('sb_paidschoolstudents.student_id', $studentID);
			$query = $this->db->get();//echo $this->db->last_query();exit;

		//print_r($query->row_array());die;
		    return $query->row_array();  
			 
    }/*end function getStudent*/
     public function getfreelevelStudent($studentID)
	 {
		 //echo $studentID;exit;
			$this->db->select('sb_freeschoolstudents.*,sb_freeschoolstudent_to_cin.cin');

			$this->db->from('sb_freeschoolstudents');
            
 $this->db->join('sb_freeschoolstudent_to_cin','sb_freeschoolstudent_to_cin.student_id = sb_freeschoolstudents.student_id');
			
			$this->db->where('sb_freeschoolstudents.student_id', $studentID);
			$query = $this->db->get();//echo $this->db->last_query();exit;

	//	print_r($query->row_array());die;
		    return $query->row_array();  
			 
    }/*end function getStudent*/
    
    
    
    public function check_complete_paidlevelprofile($id) 
	{
		   
			$this->db->select('sb_paidschoolstudents.*');
			$this->db->from('sb_paidschoolstudents');
			 
			/*$this->db->where('profile_status','no');*/
			$this->db->where('student_id',$id);
			$query = $this->db->get(); //echo $this->db->last_query();exit;
		    $result=$query->row_array();
			return $result;
			/*$profile_status=$result['profile_status'];
			return $profile_status;*/
	}
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
	public function forgotpassword($data)
	 {
	     //print_r($data);die;
		$username = $this->input->post('username');//echo $username;die;
       // $password = $this->input->post('password');
        $this->db->select('student_to_cin.*,students.father_email');
        $this->db->from('student_to_cin');
        $this->db->join('students','student_to_cin.student_id = students.student_id');
        $this->db->where('cin',$username);
		$query = $this->db->get();
		//echo $this->db->last_query($query);exit;
        //print_r($query);die;
        $row   = $query->row_array();
        //echo $this->encrypt->decode($row['password'], ENC_KEY);die;
        //print_r($row);die;
        return $row;
    }/*end function logincheck*/
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
public function update_profile($updated_data,$student_id)
	 {
		 /*echo $student_id;echo "<pre>";print_r($updated_data);exit;*/
		  if ($student_id != '') 
		  {
                          $this->db->where('student_id', $student_id);
			  $this->db->set('modified_date', 'NOW()', FALSE);
			  $query=$this->db->update('students', $updated_data);
                           return  $query ;
                           //echo $this->db->last_query($query);exit;	
			   /*$this->db->where('student_id', $studentID);*/
                          /*  $this->db->update('student_to_franchise', $sf);*/
        }
		else 
		{
                      return 0;
                }
	 }
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
        public function studentinsert($data,$params,$studentID = 0) 
		{ 
        	extract($params); 
			
			$insert_status=0;
		    $this->db->trans_begin();
		
		    $ins = $this->db->insert('students', $data);
			 if($ins)
			{ 
				   $student_insert_id=$this->db->insert_id();
				   
				   if($category_id=='')
				   {
					   $this->db->select('category_id')->from('class');
					   $this->db->where('class_id',$class_id);
					   $query = $this->db->get();
					   $category_id=$query->row_array();$category_id=$category_id['category_id'];
					   }
				   
					   $sf = array('student_id' => $student_insert_id,
						'service_id' => $service_id,
						'period_id' => $period_id,
						'class_id' => $class_id,
						'category_id' => $category_id,
						'tac_number' => $tac_number,
						'competition_level_id'=>'10',
						'competition_level_status'=>'Inactive',
									);
						$status= $this->db->insert('student_to_cin', $sf);
			} /* if for if($ins)*/

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$insert_status=1;
			echo $insert_status;
			$this->db->trans_commit();
		}
		return $insert_status;	
        }
/* @@@@@@@@@@@@@   BELOW FUNCTION insert_new_registration CREATED FOR PERIOD 15-16 STUDENTS AND DONE BY HIMA ON 14-5-2015 @@@@@@@@@@@@  */
			public function insert_new_registration($insert_data)
		{
			extract($insert_data); /*print_r($insert_data);exit;*/
			$ins = $this->db->insert('new_year_students', $insert_data);
			return  $ins;
		}
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
    public function insert($data,$franchise_id,$studentID = 0) { 
    /*echo "<pre>";print_r($_POST);print_r($_FILES);exit;*/
        if ($studentID != '') {
		  $sf = array(
                           'franchise_id' => $franchise_id
				     );
              $this->db->where('student_id', $studentID);
              $this->db->set('profile_status', 'Yes');
              return $this->db->update('students', $data);/*echo $this->db->last_query($query);exit;*/			 
			   /*$this->db->where('student_id', $studentID);*/
             /*  $this->db->update('student_to_franchise', $sf);*/
			
        }
		else 
		{
            $this->db->insert('students', $data);
                       $sf = array(
                 'student_id' => $this->db->insert_id(),
                'franchise_id' => $franchise_id
            );
             /*$this->db->insert('student_to_franchise', $sf);*/
			 
        }
    }/*end function insert*/
/* @@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
	
      public function already_exist($data,$params) 
		{ 
		
	/*	SELECT * FROM (`sb_students`) JOIN `sb_student_to_cin` ON `sb_students`.`student_id` = `sb_student_to_cin`.`student_id` WHERE `sb_students`.`school_id` = '105' AND `sb_students`.`stateID` = '14684' AND `sb_student_to_cin`.`service_id` = '1' AND `sb_student_to_cin`.`period_id` = '4' AND `sb_student_to_cin`.`category_id` = '1' AND `sb_student_to_cin`.`class_id` = '1' AND TRIM(CONCAT(sb_students.first_name,sb_students.last_name)) = 'AACC' AND TRIM(students.father_email) = 'webteam3@marrs.in' AND TRIM(students.mother_email) = 'webteam3@marrs.in' AND `sb_students`.`communication_address` LIKE '%near HDFC ,Thrikakara %'*/
        	extract($params);
			extract($data); /*echo "<pre>";print_r($data); print_r($params); exit;*/

           	$this->db->select('*');
			$this->db->from('students');
			$this->db->join('student_to_cin','students.student_id = student_to_cin.student_id');
            $this->db->where('students.school_id',trim($school_id));
            $this->db->where('students.stateID',trim($stateID));
            $this->db->where('student_to_cin.service_id',trim($service_id));
            $this->db->where('student_to_cin.period_id',trim($period_id));
            $this->db->where('student_to_cin.category_id',trim($category_id));
            $this->db->where('student_to_cin.class_id',trim($class_id));
           /* $this->db->where('TRIM(CONCAT(sb_students.communication_address,sb_students.communication_address1,sb_students.communication_address2))',trim($communication_address.$communication_address1.$communication_address2));*/
		   /* $this->db->like('sb_students.communication_address',$communication_address,'after');*/
            $this->db->where('TRIM(CONCAT(sb_students.first_name,sb_students.last_name))',trim($first_name.$last_name));
			
			if($father_email !='')
			{   $this->db->where('TRIM(sb_students.father_email)',trim($father_email)); }
			if($mother_email !='')
			{   $this->db->where('TRIM(sb_students.mother_email)',trim($mother_email)); }
            $query = $this->db->get();
			/*echo $this->db->last_query($query);exit;*/
            return $query->row_array();   
		}/* function already_exist($data,$params)  */
		
/* @@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
    public function getStudent($studentID)
	 {
		 /*echo $studentID;exit;*/
			$this->db->select('students.*,schools.*, states.state_subdivision_name, countries.country_name,class.class_key,class.class_id,category.category_id,
							  student_to_cin.cin,sb_category.categoryKey, period.period_name,school_to_franchise.franchise_id as franchise_id');
			$this->db->from('students');
			$this->db->join('student_to_cin','students.student_id = student_to_cin.student_id');
			$this->db->join('class','student_to_cin.class_id = class.class_id'); /*class.class_key,*/
			$this->db->join('category','class.category_id = category.category_id');
			
			/*$this->db->join('category','student_to_cin.category_id = category.category_id');
			$this->db->join('class','category.category_id = class.category_id');*/
			/*$this->db->join('student_to_franchise','students.student_id = student_to_franchise.student_id');*/
			$this->db->join('schools','students.school_id = schools.school_id');
			$this->db->join('school_to_franchise','schools.school_id=school_to_franchise.school_id');	
			$this->db->join('countries','students.country_id = countries.country_id');
			$this->db->join('states','students.stateID = states.state_subdivision_id');
			$this->db->join('period','student_to_cin.period_id = period.period_id');
			$this->db->where('students.student_id', $studentID);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//print_r($query->row_array());die;
		    return $query->row_array();  
			 
    }/*end function getStudent*/
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
	public function get_maxTacNo($str){
          /*  echo "from controller";print_r($str);*/
		$this->db->select('MAX(CONVERT(SUBSTRING( tac_number, 11),UNSIGNED INTEGER))  as tac_number',FALSE);
		/*select('SUBSTRING(tac_number,11),FALSE) as tac_number');
        $this->db->select('MAX(SUBSTRING( tac_number, 11))')->from('items')->where('LEFT( locationID , 2)', arg)->get()		
		/*$this->db->select("(CONVERT(SUBSTRING(tac_number,11),UNSIGNED INTEGER))as tac_number");*/

        $this->db->like('tac_number', $str); 		
		$query = $this->db->get('student_to_cin');
		
		/*$this->db->last_query();*/
         return $query->row_array();
		
   }/*end function get_maxTacNo*/
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
    public function listStudents($params)
	 {
        extract($params);
        $this->db->select('*');
        $this->db->from('students');
		$this->db->join('student_to_cin', "student_to_cin.student_id = students.student_id AND sb_student_to_cin.status='Active'");
		$this->db->join('category', "category.category_id = student_to_cin.category_id");
		$this->db->join('schools','students.school_id = schools.school_id');
		$this->db->join('period','student_to_cin.period_id = period.period_id');
		$this->db->join('school_to_franchise',"school_to_franchise.school_id=schools.school_id AND sb_school_to_franchise.status='Active'");	
		$this->db->join('franchise',"franchise.franchise_id=school_to_franchise.franchise_id");	
		$this->db->order_by('student_to_cin.cin', 'ASC');
			$this->db->join('states','students.stateID = states.state_subdivision_id');
        if($cin != '') 
		{
            $this->db->where('student_to_cin.cin', $cin);
        }
		if($franchiseID!= '')
		{
			$this->db->where('school_to_franchise.franchise_id' ,$franchiseID);		
        }
		if($pricipal_id != '')
		{
            $this->db->join('schedule_to_school', "schedule_to_school.student_id = students.student_id AND schedule_to_school.status='Active' AND schedule_to_school.school_id='" . $pricipal_id . "'");
        }

        if($name != '')
		{
            $this->db->like('students.first_name', $name); 
        }
        if($school_id != '')
		{
            $this->db->where('students.school_id', $school_id);
        }
        if($period_id != '')
		{
            $this->db->where('student_to_cin.period_id', $period_id); 
        }		
        if($status == 'Pending') 
		{
            $this->db->where_in('students.status', $status);
        }
		else 
		{
            $status = array(
							'Active',
							'Inactive'
                          );
            $this->db->where_in('students.status', $status);
			$this->db->where('student_to_cin.status', 'Active');
			$this->db->where('student_to_cin.cin_assigned_status','Assign');
        }
		
        $query = $this->db->get();  //echo $this->db->last_query(); 
        return $query->result_array();
		
    }/*end function listStudents*/
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */
    public function changeStatus($studentID, $status) {
        $studentIDs = array(
            $studentID
        );
        if ($status == 'Active') {
            $action = 'Active';
            $data   = array(
                'status' => $action
            );
        } else {
            $action = 'Deleted';
            $data   = array(
                'status' => $action
            );
        }
        $this->db->where_in('student_id', $studentIDs);
        return $this->db->update('students', $data);
    }/*end function changeStatus*/
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */

    public function requestedit($action, $studentID) {
        $data = array(
            'status' => $action
        );
        $this->db->where_in('studentID', $studentID);
        return $this->db->update('students', $data);
    }/*end function requestedit*/
    
   /* @@@@@@@@@@@@@@@@@@@@@@@ @ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
    
public function Changepassword($data,$student_id,$status)
   {   
            extract($data); //print_r($data); exit;
            $this->db->select('*');
            $this->db->from('student_to_cin');
            $this->db->where('student_id',$student_id);
            $this->db->where(array(  'status' => 'Active' ));
            $query = $this->db->get();  /*echo $this->db->last_query();exit;*/
            $row   = $query->row_array();
            /*$password=$this->encrypt->decode($row['password'], ENC_KEY);echo $password;exit;*/
           if ($query->num_rows() > 0 && $this->encrypt->decode($row['password'], ENC_KEY) == $opassword)
          {
					 $this->db->where('student_id',$student_id);
					 $np=$this->encrypt->encode($npassword, ENC_KEY);
					 
					 /*echo $np;exit;*/
					 $datas  = array(  'password' => $np  );
					if($this->db->update('student_to_cin', $datas)) 
					{
						/*$status= "Password Changed Successfully";*/
						   $status=1;
						   return $status;
					}
				    else
					{
						/*$status= "OOps Something Went wrongWrong ";*/
						  $status=2;
						  return $status;
					}          
          }
	      else
	      {
                 /*$status= "Wrong Old Password";*/
                 $status=3;
                 return $status;
          }
   }	
   /* @@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  */	
    public function student_school($params) 
	{
		
		 extract($params); /*print_r($params);exit;*/
		 $this->db->select('*');
         $this->db->from('students');
		 $this->db->join('schools', 'schools.school_id = students.school_id');
		 $this->db->where('student_id',$student_id);
		 $query = $this->db->get(); 
		 return $query->result_array();  /*echo $this->db->last_query();exit;*/    
    }/*end function requestedit*/
	
	/* @@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	

    public function list_new_registeration($params) 
	{
		
		 extract($params); /*print_r($params);exit;*/
		 $this->db->select('student_to_cin.tac_number,students.first_name,students.middle_name,students.last_name,students.communication_address,
		                    students.communication_address1,students.communication_address2,category.categoryKey,class.class_key,
							schools.school_name,schools.school_address,schools.school_address1,schools.school_city,students.father_email,
							students.std_code,students.phone,students.created_date');
         $this->db->from('students');
		 $this->db->join('schools', 'schools.school_id = students.school_id');
		 $this->db->join('student_to_cin', 'students.student_id = student_to_cin.student_id');
		 $this->db->join('class','student_to_cin.class_id = class.class_id'); /*class.class_key,*/
		 $this->db->join('category','class.category_id = category.category_id');
		 $this->db->join('school_to_franchise AS stuToFra',"stuToFra.school_id=schools.school_id AND stuToFra.status='Active' AND stuToFra.franchise_id='" . $franchiseID . "'");		

		 $this->db->where('student_to_cin.pay_status','no');
		 $this->db->where('student_to_cin.cin_assigned_status','Notassign');
		 $query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		 return $query->result_array();    
    }/*end function requestedit*/
/* @@@@@@@@@@@@@@@@@@@@@@@ BELOW FUNCTION CREATED ON 21-10-14  FOR PROFILE UPDATION DIALOG BOX @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

    public function check_comlplete_profile($student_id) 
	{
		   
			$this->db->select('students.profile_status,students.photo');
			$this->db->from('students');
			/*$this->db->where('profile_status','no');*/
			$this->db->where('student_id',$student_id);
			$query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		    $result=$query->row_array();
			return $result;
			/*$profile_status=$result['profile_status'];
			return $profile_status;*/
	
	}
/* @@@@@@@@@@@@@@@@@@@@@@@ BELOW FUNCTION CREATED ON 10-2-2015  FOR CHECK PROFILE IMAGE UPLOADED @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
   
    public function check_profile_photo($student_id) 
	{
			 $this->db->select('photo');
			 $this->db->from('students');
			 $this->db->where('student_id',$student_id);
			 $student_photo_array  = $this->db->get(); /*echo $this->db->last_query();exit;  /*!empty($student_photo) && */
			 $student_photo=$student_photo_array->row_array();	
			 if(trim($student_photo['photo'])!= "" || trim($student_photo['photo'])!=NULL) 
		     { $photo_status="yes"; }
			 else
			 {  $photo_status="no"; }
				 
			 return $photo_status;
	}
/* @@@@@@@@@@@@@@@@@@@@@@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
public function get_stud_details($stu)
{
   $this->db->select('student_to_cin.*,students.*');
         $this->db->from('student_to_cin');
		 $this->db->join('students', 'student_to_cin.student_id = students.student_id');
	
		 $this->db->where('student_to_cin.student_id',$stu);
		
		 $query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		 $row=$query->result_array(); 
		 return $row;     
}
public function insert_ccave_paymentfirst($data)
{
     $this->db->select('student_id,paymentstatus,amount');
			 $this->db->from('morepractice_ccave');
			 $this->db->where('student_id',$data['student_id']);
			 $this->db->where('amount',$data['amount']);
			 $student_array  = $this->db->get(); /*echo $this->db->last_query();exit;  /*!empty($student_photo) && */
			 $student_idd=$student_array->row_array();
   if(empty($student_idd))
   {
    $this->db->insert('morepractice_ccave',$data);
    $res="ok";
   }
   else if(empty($student_idd['paymentstatus']))
   {
     $res="no";
   }
    return $res;
}
public function update_ccave_paymentsecond($s,$datas)
{
    
                    $this->db->where('student_id', $s);
					$r=$this->db->update('morepractice_ccave', $datas);
					return $r;
  
}
public function insert_ccave_payment_morepractice_registration($student_id)
{
    $data=array('student_id' =>$student_id,
                'receipt_date' =>date('Y-m-d'),
                 'register_date'=>date('Y-m-d'),
                'branch_name' =>'CCAvenue',
                'confirm' => 'Yes',
                    );
 $this->db->insert('cin_morepractice_registration',$data);
}
public function update_ccave_payment_morepractice_registration($student_id)
{
 
   $data=array(
                'unsubscribe_status' => 'Yes',
                'modified_date' => date('Y-m-d'),
       
       );
        $this->db->where('student_id', $student_id);
					$r=$this->db->update('cin_morepractice_registration', $data);
					return $r;
}
public function get_details_student($student_id)
{
     $this->db->select('*');
         $this->db->from('students');
		 
	
		 $this->db->where('student_id',$student_id);
		
		 $query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		 $row=$query->result_array(); 
		 return $row;     
}


/** free and paid student ***/
public function getfreeschoolStudent($studentID)
	 {
		// echo $studentID;exit;
$this->db->select('sb_freeschoolstudent_to_cin.*,class.class_key');
			$this->db->from('sb_freeschoolstudent_to_cin');
			$this->db->join('class','sb_freeschoolstudent_to_cin.class_id = class.class_id');
			//$this->db->join('class','freeschoolstudent_to_cin.class_id = class.class_id'); /*class.class_key,*/
			
			//$this->db->join('sb_access_code_school','freeschoolstudents.school_id = sb_access_code_school.id');
			//$this->db->join('countries','freeschoolstudents.country_id = countries.country_id');
			//$this->db->join('states','freeschoolstudents.stateID = states.state_subdivision_id');
			$this->db->where('sb_freeschoolstudent_to_cin.student_id', $studentID);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//print_r($query->row_array());die;
		    return $query->row_array();  
			 
    }/*end function getStudent*/
    public function get_freestud_details($stu)
{
   $this->db->select('freeschoolstudent_to_cin.*,sb_freeschoolstudents.*');
         $this->db->from('freeschoolstudent_to_cin');
		 $this->db->join('sb_freeschoolstudents', 'freeschoolstudent_to_cin.student_id = sb_freeschoolstudents.student_id');
	
		 $this->db->where('freeschoolstudent_to_cin.student_id',$stu);
		
		 $query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		 $row=$query->result_array(); 
		 return $row;     
}

public function insert_ccave_paymentfirstfree($data)
{
     $this->db->select('student_id,paymentstatus,amount');
			 $this->db->from('freemorepractice_ccave');
			 $this->db->where('student_id',$data['student_id']);
			 $this->db->where('amount',$data['amount']);
			 $student_array  = $this->db->get(); /*echo $this->db->last_query();exit;  /*!empty($student_photo) && */
			 $student_idd=$student_array->row_array();
   if(empty($student_idd))
   {
    $this->db->insert('freemorepractice_ccave',$data);
    $res="ok";
   }
   else if(empty($student_idd['paymentstatus']))
   {
     $res="no";
   }
    return $res;
}
public function getpaidschoolStudent($studentID)
	 {
		// echo $studentID;exit;
$this->db->select('sb_paidschoolstudent_to_cin.*,class.class_key');
			$this->db->from('sb_paidschoolstudent_to_cin');
			$this->db->join('class','sb_paidschoolstudent_to_cin.class_id = class.class_id');
			//$this->db->join('class','freeschoolstudent_to_cin.class_id = class.class_id'); /*class.class_key,*/
			
			//$this->db->join('sb_access_code_school','freeschoolstudents.school_id = sb_access_code_school.id');
			//$this->db->join('countries','freeschoolstudents.country_id = countries.country_id');
			//$this->db->join('states','freeschoolstudents.stateID = states.state_subdivision_id');
			$this->db->where('sb_paidschoolstudent_to_cin.student_id', $studentID);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//print_r($query->row_array());die;
		    return $query->row_array();  
			 
    }/*end function getStudent*/
    
    
    public function get_paidstud_details($stu)
{
   $this->db->select('paidschoolstudent_to_cin.*,sb_paidschoolstudents.*');
         $this->db->from('paidschoolstudent_to_cin');
		 $this->db->join('sb_paidschoolstudents', 'paidschoolstudent_to_cin.student_id = sb_paidschoolstudents.student_id');
	
		 $this->db->where('paidschoolstudent_to_cin.student_id',$stu);
		
		 $query = $this->db->get(); /*echo $this->db->last_query();exit;*/
		 $row=$query->result_array(); 
		 return $row;     
}


public function insert_ccave_paymentfirstpaid($data)
{
     $this->db->select('student_id,paymentstatus,amount');
			 $this->db->from('paidmorepractice_ccave');
			 $this->db->where('student_id',$data['student_id']);
			 $this->db->where('amount',$data['amount']);
			 $student_array  = $this->db->get(); /*echo $this->db->last_query();exit;  /*!empty($student_photo) && */
			 $student_idd=$student_array->row_array();
   if(empty($student_idd))
   {
    $this->db->insert('paidmorepractice_ccave',$data);
    $res="ok";
   }
   else if(empty($student_idd['paymentstatus']))
   {
     $res="no";
   }
    return $res;
}

public function insert_ccave_payment_morepractice_registrationfree($student_id)
{
    $data=array('student_id' =>$student_id,
                'receipt_date' =>date('Y-m-d'),
                 'register_date'=>date('Y-m-d'),
                'branch_name' =>'CCAvenue',
                'confirm' => 'Yes',
                    );
 $this->db->insert('cin_freeschoollevelmorepractice_registration',$data);
}


public function insert_ccave_payment_morepractice_registrationpaid($student_id)
{
    $data=array('student_id' =>$student_id,
                'receipt_date' =>date('Y-m-d'),
                 'register_date'=>date('Y-m-d'),
                'branch_name' =>'CCAvenue',
                'confirm' => 'Yes',
                    );
 $this->db->insert('cin_paidschoollevelmorepractice_registration',$data);
}


public function searchstudent($student_id)
	 {
	      $this->db->select('competition_registration.*,competition_schedule.*');
		  $this->db->from('competition_registration');
		  $this->db->join('sb_competition_schedule', 'sb_competition_schedule.competition_schedule_id = sb_competition_registration.competition_schedule_id');
		  $this->db->where('student_id',$student_id);
			 $query  = $this->db->get();// echo $this->db->last_query();exit; 
			 $row=$query->result_array(); 
		     return $row; 
	 }
    
}//end class
?>