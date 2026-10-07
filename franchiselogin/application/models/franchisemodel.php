<?php
class franchiseModel extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /*////////////// START FUNCTIONS  FOR  LOGIN//////*/
    public function loginCheck() 
    {
       $username = $this->input->post('username');
       $password = $this->input->post('password');
	   //echo $password;
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('username',$username);
        $this->db->where('franchise_status','Active');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        $row   = $query->row_array();
		//print_r($row);exit;
		//echo $this->encrypt->decode($row['password'], ENC_KEY);die;
        //         if($query->num_rows() > 0 && ($this->encrypt->decode($row['password'], ENC_KEY) == $password)) {
        // 			//echo "in";exit;
        //             $agent = $this->input->user_agent();
        //             $ip    = $this->input->ip_address();generate_cin
        //             $data  = array(
        //                 'user_id' => $row['franchise_id'],
        //                 'user_agent' => $agent,
        //                 'user_type' => 'franchise',
        //                 'ip' => $ip
        //             );
        //             $str   = $this->db->insert('userlog', $data);
        //             return $row;
        //         } else
        //             return false;
         return $row;
    }
    
    
    
    public function get_faq_by_schedule($comp_id)
    {
        return $this->db
            ->where('lunar_schedule_id', $comp_id)
            ->get('faq')
            ->result_array();
    }

    public function insert_faq($data)
    {
        return $this->db->insert('faq', $data);
    }

    public function update_faq($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('faq', $data);
    }
    
    /* ///////////////////FOLLOWING FUNCTIONS USED FOR  INSERT DATA INTO TABLES///////*/
    
    public function all_franchise()
    {
        $this->db->select('*');
        $this->db->from('franchise_to_zoomzoom');
        //$this->db->where('franchise_type', 'M');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function get_students_details($data,$like)
    {
        // print_r($data);die;
        $this->db->select('*');
        $this->db->from('cin_list');
        if($data['school_id']!='All' && $data['school_id']!=''){
            
             $this->db->where('cin_list.school_id',$data['school_id']);
        }
        if($data['area']!='All' && $data['area']!=''){
            
             $this->db->where('cin_list.franchise_code',$data['area']);
        }
        //$this->db->where('cin_list.period_id', $data['period_id']);
        $this->db->where('cin_list.state_id', $data['state_id']);
        $this->db->where('cin_list.franchise_id', $data['franchise']);
        // if(!empty($data['series'])){
        //     $this->db->where('cin_list.series',$data['series']);
        // }
        // if(!empty($data['subject'])){
        //     $this->db->where('cin_list.franchise_code',$data['subject']);
        // }
        $this->db->like('cin_list.cin',$like,'after');
        $this->db->group_by('cin_list.cin');
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        return $query->result_array();
        
    }
    
    
    public function actionzoomzoom($id,$state)
    {
        echo 'ok';die;
    }
    
    
    public function insert($data, $franchise_id = '')
    {
        /*echo"<pre>";print_r($data);exit;*/
        if ($franchise_id != '')
        {
            $this->db->where('franchise_id', $franchise_id);
            $this->db->set('modified_date', 'NOW()', FALSE);
            return $this->db->update('franchise', $data);
        } /* end of if*/
        else
         {
            $str = $this->db->insert('franchise', $data);
			$fr_inserted_id=$this->db->insert_id();
			$this->db->select('CONCAT(franchise.franchise_code , LOWER(employee.emp_first_name)) as fr_username');
			$this->db->from('franchise');
			$this->db->join('employee','employee.emp_id=franchise.emp_id');
			$this->db->where('franchise.franchise_id',$fr_inserted_id);
			$query = $this->db->get();
			$user_name_arr=$query->row_array();
			$user_name=$user_name_arr['fr_username'];
			$password = $this->encrypt->encode($user_name, ENC_KEY);
			 $data = array(
								'username'=>$user_name,
								'password' =>$password
                        );
            $this->db->where('franchise_id', $fr_inserted_id);
            $this->db->set('modified_date', 'NOW()', FALSE);
            return $this->db->update('franchise', $data);
            /*echo $this-*/
        }
    /* END  FUNCTION FOR INSERT FRANCHISE DETAILS */
    /* START FUNCTION FOR SELECT ALL ENUM DATA FROM TABLE  */
    }
    
    
    function enum_select($table, $field) 
	{
		
        $query = "SHOW COLUMNS FROM " . $table . " LIKE '$field'";
        $row   = $this->db->query("SHOW COLUMNS FROM " . $table . " LIKE '$field'")->row()->Type;
        print_r($row);
		        	   $regex = "/'(.*?)'/";
                       preg_match_all($regex, $row, $enum_array);
					   $enum_fields = $enum_array[1];
                       foreach ($enum_fields as $key => $value):
                            $enums[$value] = $value;
                       endforeach;
					   return $enums;
    }
    
    /* END FUNCTION FOR SELECT ALL franchise_type ENUM DATA STORED IN FRANCHISE TABLE  */
    /* START FUNCTION FOR GET ALL franchise_ref  DETAILS (LIST ALL MAIN FRANCHISE)  */
    
    public function export_result_zoomzoom($period,$level,$product_name,$category,$status,$class)
    {
       // echo $period.$level.$product_name;
        $this->db->select('*');
        $this->db->from('zoomzoom_to_cin');
        $this->db->join('student_to_zoomzoom','student_to_zoomzoom.zoomzoom_prid=zoomzoom_to_cin.prid');
        $this->db->join('competition_levels','competition_levels.id=zoomzoom_to_cin.level_id');
        
        if($category==1){
             $this->db->where('student_to_zoomzoom.class_id < 4');
             
        }
        if($category==2){
             $this->db->where('student_to_zoomzoom.class_id > 3');
        }
        $this->db->join('zoomzoom_result','zoomzoom_result.prid=zoomzoom_to_cin.prid');
        $this->db->where('period', $period);
        $this->db->where('zoomzoom_to_cin.level_id', $level);
        $this->db->where('zoomzoom_result.product_name', $product_name);
        if($status!=''){
            $this->db->where('zoomzoom_result.status', $status);
        }
        $this->db->group_by('zoomzoom_result.cin');
        
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    
    public function export_result_all_new($period, $level, $product_name, $status, $class, $state, $school, $area, $series, $subject, $rank, $performer, $speller)
    {
    
        $periods = $this->db->get_where('period', array('period_id' => $period))->row();
        $products = $this->db->get_where('products', array('product_name' => $product_name))->row();
                
        // print_r($products);die;
        
        $check = $periods->initials.$products->in13;
        
        $this->db->select('*');
        $this->db->from('cin_result');
        $this->db->join('cin_list', 'cin_result.cin = cin_list.cin');
        $this->db->like('cin_result.cin', $check);
        $this->db->where('cin_result.status !=','' );
        
        if ($school != 'All' && $school!='0' && $school!='') {
            $this->db->where('cin_list.school_id', $school);
        }
        
        if ($area != '' && $area!='All') {
            $this->db->where('cin_list.franchise_code', $area);
        }
        
        if ($state != '' && $state!='All') {
            $this->db->where('cin_list.state_id', $state);
        } 
    
        if ($status != 'All') {
            $this->db->where('cin_result.status', $status);
        }
    
        if ($class != 'All') {
            $this->db->where('cin_list.class', $class);
        }
        
        $this->db->group_by('cin_result.cin');
    
        $query = $this->db->get();
        
        // echo $this->db->last_query();
        
        return $query->result_array();
        
    }    
    
    
    public function export_result_all($period, $level, $product_name, $status, $class, $state, $school, $area, $series, $subject, $rank, $performer, $speller)
    {
        // echo $rank.$performer.$speller.'no';die;
         
         
        $this->db->select('cin_list.id, cin_list.cin,cin_list.stud_phone,cin_list.stud_email, cin_list.class, cin_list.student_name, cin_list.school_name,cin_list.student_name as sch_name,cin_list.school_id as sch_id,
            cin_result.product_name, cin_result.period_id, cin_result.clevel, cin_result.grade, cin_result.rank, cin_result.status,cin_result.performer,cin_result.speller,cin_result.competition_schedule_id,cin_result.competition_date,cin_result.venue,cin_result.marks,cin_result.show');
        $this->db->from('cin_result');
        $this->db->join('cin_list', 'cin_result.cin = cin_list.cin');
        
        // $this->db->join('class_category_product', 'class_category_product.class = cin_list.class');
        
        if ($period >= '13') {
            $this->db->select('school_new.school_name');
            $this->db->join('school_new', 'school_new.id = cin_list.school_id');
            $this->db->where('cin_result.status !=','');
        
        }


        // $this->db->where('class_category_product.product_name',$product_name);
        
        $this->db->where('cin_list.period_id', $period);
        
        if ($state != '' && $state!='All') {
            $this->db->where('cin_list.state_id', $state);
        }
        
        if ($level != '' && $level != 'All') {
            $this->db->where('cin_result.clevel', $level);
        }
        
        $this->db->where('cin_result.product_name', $product_name);
        if ($school != 'All' && $school!='0' && $school!='') {
            $this->db->where('cin_list.school_id', $school);
        }
        
        if ($area != '' && $area!='All') {
            $this->db->where('cin_list.franchise_code', $area);
        }
    
        if ($status != 'All') {
            $this->db->where('cin_result.status', $status);
        }
    
        if ($class != 'All') {
            $this->db->where('cin_list.class', $class);
        }
        
        if ($performer != 'All') {
            if($performer=='yes'){
                $this->db->like('cin_result.performer', $performer);
            }else{
                $this->db->like('cin_result.performer', '');
            }
            
        }
    
        if ($speller != 'All') {
            if($speller=='yes'){
                $this->db->like('cin_result.speller', $speller);
            }else{
                $this->db->like('cin_result.speller', '');
            }
        }
        
        if ($rank != 'All') {
            if($rank==1){
                $ar=['RANK-1','RANK-2','RANK-3','RANK-4','RANK-5','Rank-1','Rank-2','Rank-3','Rank-4','Rank-5','Rank I','Rank II','Rank III','Rank IV','Rank V','RANK I','RANK II','RANK III','RANK IV','RANK V'];
                $this->db->where_in('cin_result.rank', $ar);
            }
            if($rank==2){
                $ar=['RANK-6','RANK-7','RANK-8','RANK-9','RANK-10','Rank-6','Rank-7','Rank-8','Rank-9','Rank-10','Rank VI','Rank VII','Rank VIII','Rank IX','Rank X','RANK VI','RANK VII','RANK VIII','RANK IX','RANK X'];
                $this->db->where_in('cin_result.rank', $ar);
            }
            if($rank == 3){
                $ar = [
                    'RANK-11', 'RANK-12', 'RANK-13', 'RANK-14', 'RANK-15', 
                    'RANK-16', 'RANK-17', 'RANK-18', 'RANK-19', 'RANK-20',
                    'Rank-11', 'Rank-12', 'Rank-13', 'Rank-14', 'Rank-15', 
                    'Rank-16', 'Rank-17', 'Rank-18', 'Rank-19', 'Rank-20',
                    'Rank XI', 'Rank XII', 'Rank XIII', 'Rank XIV', 'Rank XV',
                    'Rank XVI', 'Rank XVII', 'Rank XVIII', 'Rank XIX', 'Rank XX',
                    'RANK XI', 'RANK XII', 'RANK XIII', 'RANK XIV', 'RANK XV',
                    'RANK XVI', 'RANK XVII', 'RANK XVIII', 'RANK XIX', 'RANK XX'
                ];
                $this->db->where_in('cin_result.rank', $ar);
            }

        }
        
        
        // if ($series != '') {
        //     $this->db->where('cin_result.series', $series);
        // }
    
        // if ($subject != '') {
        //     $this->db->where('cin_list.subject', $subject);
        // }
        
        // $this->db->where('cin_result.show !=', 'skip');
        $this->db->where('cin_result.status !=','' );
        $this->db->order_by('cin_result.id','DESC');
        // $this->db->group_by('cin_list.cin');
    
        $query = $this->db->get();
        //  echo $this->db->last_query();
        
        
        return $query->result_array();
    }
    

    public function export_result_lunar($period, $level, $product_name, $status, $class, $state,$school,$area) 
    {
         //print_r($product_name);die;
        $this->db->select('cin_list.id, cin_list.cin,cin_list.stud_phone,cin_list.stud_email, cin_list.class, cin_list.student_name, cin_list.school_name,lunar_cin_result.subject, lunar_cin_result.series,
            lunar_cin_result.product_name, lunar_cin_result.period_id, lunar_cin_result.clevel, lunar_cin_result.grade, lunar_cin_result.rank, lunar_cin_result.status,lunar_cin_result.performer,lunar_cin_result.speller,lunar_cin_result.competition_schedule_id,lunar_cin_result.competition_date,lunar_cin_result.venue,lunar_cin_result.marks');
        $this->db->from('lunar_cin_result');
        $this->db->join('cin_list', 'lunar_cin_result.cin = cin_list.cin');
        //$this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel');
        if ($period >= '13') {
            $this->db->select('school_new.school_name');
            $this->db->join('school_new', 'school_new.id = cin_list.school_id');
            $this->db->where('lunar_cin_result.status !=','');
        
        }



        $this->db->where('lunar_cin_result.period_id', $period);
        
        $this->db->where('cin_list.state_id', $state);
        $this->db->where('lunar_cin_result.clevel', $level);
        
        $this->db->where('lunar_cin_result.product_name', $product_name);
        if ($school != 'All' && $school!='0' && $school!='') {
            $this->db->where('cin_list.school_id', $school);
        }
        if ($area != '' && $area!='All') {
            $this->db->where('cin_list.franchise_code', $area);
        }
    
        if ($status != 'All') {
            $this->db->where('lunar_cin_result.status', $status);
        }
    
        if ($class != 'All') {
            $this->db->where('cin_list.class', $class);
        }
        // if ($series != '') {
        //     $this->db->where('lunar_cin_result.series', $series);
        // }
    
        // if ($subject != '') {
        //     $this->db->where('cin_list.subject', $subject);
        // }
        $this->db->where('lunar_cin_result.status !=','' );
        $this->db->order_by('lunar_cin_result.id','DESC');
        $this->db->group_by('cin_list.cin');
    
        $query = $this->db->get();
    // echo $this->db->last_query();die;
        return $query->result_array();
    }
	
    
    public function getSubFranchise_count($parentID)
    {
		 $this->db->select('COUNT(*) AS count');
		  $this->db->from('franchise');
		$this->db->where('franchise_ref',$parentID);
		$query = $this->db->get();
		$frc=$query->row_array();
		return $frc['count'];

    }
    
    
    public function get_franchiseref() 
    {
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_type', 'M');
        $query = $this->db->get();
        return $query->result_array();
    } 
    /* end of if its for list all main fr*/
    
    /* END  FUNCTION FOR GET ALL franchise_ref  DETAILS (LIST ALL MAIN FRANCHISE)  */
    
    /* START FUNCTION FOR SELECT ALL FRANCHISE DETAILS */
    
    
    public function listFranchise($params)
    {
        extract($params);
        
        

		if($bulk_service_id=='')
		{
            $this->db->select('franchise.*,services.service_name,employee.emp_first_name,employee.emp_middle_name,employee.emp_last_name,countries.country_name,states.state_subdivision_name');
            $this->db->from('franchise');      
            /*$this->db->join( 'franchise_to_service',"franchise.franchise_id = franchise_to_service.franchise_id");*/
            $this->db->join('services', "franchise.service_id=services.service_id");
            $this->db->join('employee', 'franchise.emp_id = employee.emp_id');
            $this->db->join('countries', 'franchise.country_id = countries.country_id');
            $this->db->join('states', 'franchise.state_id=states.state_subdivision_id');
        if ($service_id != '') {
            $this->db->where('franchise.service_id', $service_id);
        }
        if ($franchise_type != '') {
            $this->db->where('franchise.franchise_type', $franchise_type);
        }
        if ($franchise_code != '') {
            $this->db->like('franchise.franchise_code', $franchise_code);
        }
        $this->db->where('franchise.franchise_status', 'Active');
        $this->db->ORDER_BY('franchise_code', 'ASC');
        $query = $this->db->get();
       /*echo $this->db->last_query();exit;*/
        return $query->result_array();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('franchise');
	        $this->db->where('service_id', $bulk_service_id);
	        $query = $this->db->get();
           /*echo $this->db->last_query();exit;*/
           return $query->result_array();
		}
		
    }
    /* END  FUNCTION FOR  SELECT ALL  FRANCHISE DETAILS */
    
    public function zoomzoom_studymaterial()
    {
        $this->db->select('*');
        $this->db->from('zoomzoom_studymaterial');
        //$this->db->where('franchise_id', $franchise_id);
        $query = $this->db->get();
        /*echo $this->db->last_query();*/
        return $query->result_array();
    }
    
    
   /* ////////////////////////// START FUNCTIONS USED FOR  EDIT DATA FROM TABLES///////////////////*/
    
    
    public function getFranchise($franchise_id) 
    {
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id', $franchise_id);
        $query = $this->db->get();
        /*echo $this->db->last_query();*/
        return $query->row_array();
        
    }
    /*/////////////// END FUNCTIONS USED FOR  EDIT DATA FROM TABLES/////////*/
    
    
    /*//////////////// START FUNCTIONS USED FOR  DELETE DATA FROM TABLES/////*/
    public function changeStatus($franchise_id) 
    {
        $data = array(
            'franchise_status' => 'Deleted'
        );
        $this->db->where('franchise_id', $franchise_id);
        return $this->db->update('franchise', $data);
    }
    /*//////////////// END FUNCTIONS USED FOR  DELETE DATA FROM TABLES////////
	
      ////////////////////////// START FUNCTIONS USED FOR  EDIT DATA FROM TABLES///////////////////*/
      
    public function getFranchisecode() 
    {
        $this->db->select('*');
        $this->db->from('franchiseecode_generation');
        $this->db->where("franchise_code not in (select LEFT(franchise_code , 2) from franchise where franchise_code like CONCAT(franchise_code, '%'))");
        $query = $this->db->get();
    
        return $query->result_array();
    }

    /*/////////////// END FUNCTIONS USED FOR  EDIT DATA FROM TABLES/////////*/
    
    public function getFranchiseProfile($franchise_id) 
    {
        $this->db->select('franchise.*,
		                       services.service_name,
		                       employee.emp_id,employee.emp_first_name,employee.emp_middle_name,employee.emp_last_name,
						       employee.emp_personal_email,employee.emp_official_email,employee.emp_mobile,employee.emp_phone,employee.emp_ca,
		                       countries.country_name,states.state_subdivision_name,department.department_name');
        $this->db->from('franchise');
        $this->db->join('services', "franchise.service_id=services.service_id");
        $this->db->join('employee', 'franchise.emp_id = employee.emp_id');
        $this->db->join('department', 'employee.emp_dept_id = department.department_id');
        $this->db->join('countries', 'franchise.country_id = countries.country_id');
        $this->db->join('states', 'franchise.state_id=states.state_subdivision_id');
        $this->db->where('franchise.franchise_id', $franchise_id);
        $query = $this->db->get();
       /* echo $this->db->last_query();exit;*/
        return $query->row_array();
        /*$this->db->join( 'franchise_to_service',"franchise.franchise_id = franchise_to_service.franchise_id");
        $this->db->join( 'services',"franchise_to_service.service_id=services.service_id");*/
    }
	
	
	public function Get_FranchiseState($franchise_id) 
	{
		 
        $this->db->select('*');
        $this->db->from('franchise');
		$this->db->join('countries', 'franchise.country_id = countries.country_id');
        $this->db->join('states', 'franchise.state_id=states.state_subdivision_id');
        $this->db->where('franchise.franchise_id', $franchise_id);
        $query = $this->db->get();
		//echo $this->db->last_query();exit;
        return $query->row_array();
    }


    public function Get_Statewise_Franchise($state_id)
    {
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise.state_id', $state_id);
        $query = $this->db->get();
    /*		echo $this->db->last_query();exit;
    */        return $query->result_array();
    }/*Get_Statewise_Franchise*/
 
 
    public function franchise_details($franchise_id)
    {
	   
	  /* SELECT *, IF(a.franchise_ref = 0, "Main",(SELECT  b.franchise_code FROM franchise b where b.franchise_id=a.franchise_ref) ) as new_franchiseRef           FROM (franchise a ) 
         JOIN employee emp ON emp.emp_id=a.emp_id 
         JOIN servicesser ON ser.service_id=a.service_id 
         JOIN states  st ON a.state_id=st.state_subdivision_id 
         WHERE a.franchise_status = 'Active'
	  */
	   
	   
	    $this->db->select('*,IF(a.franchise_ref = 0,"Main",(SELECT  b.franchise_code FROM franchise b where b.franchise_id=a.franchise_ref) ) as new_franchiseRef ',FALSE);
		

        $this->db->from('franchise a');
		$this->db->join('employee','employee.emp_id=a.emp_id');
		$this->db->join('services','services.service_id=a.service_id');
        $this->db->join('states', 'a.state_id=states.state_subdivision_id');
        $this->db->where('a.franchise_status', 'Active');
        $query = $this->db->get();
		
		/*echo $this->db->last_query();exit;*/
        return $query->result_array();
        /*
        SELECT a.*, 
        
        IF(a.franchise_ref = 0, "Main",(SELECT  b.franchise_code FROM franchise b where b.franchise_id=a.franchise_ref) ) as new_franchiseRef 
        
        FROM (franchise a ) 
        
        WHERE a.franchise_status = 'Active'
        
        */
    }
 
 
    public function zoomzoom_studymaterial_extract($franchise,$level,$period,$class,$product)
    {
    // echo $class;die;
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
    
         $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        if($franchise!='All'){
 	       $this->db->where('student_to_zoomzoom.franchise_id',$franchise);
 	    }
 	    
 	    
 	    if(!empty($class)){
 	       $this->db->where('student_to_zoomzoom.class_id',$class);
 	    }
 	    
        
        $this->db->join('zoomzoom_studymaterial_purchase', 'zoomzoom_studymaterial_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
       
        $this->db->where('zoomzoom_studymaterial_purchase.product_name', $product);
         $this->db->where('zoomzoom_studymaterial_purchase.level_id', $level);
        $this->db->where('zoomzoom_studymaterial_purchase.period', $period);
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
	  //print_r($query->result());exit;
        return $query->result_array();
    }
 

    public function zoomzoom_mocktest_extract($franchise,$level,$period,$class,$product)
    {
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
    
        $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        if($franchise!='All'){
 	       $this->db->where('student_to_zoomzoom.franchise_id',$franchise);
 	    }
    
 	    if(!empty($class)){
 	       $this->db->where('student_to_zoomzoom.class_id',$class);
 	    }
        
        $this->db->join('zoomzoom_mocktest_purchase', 'zoomzoom_mocktest_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
       
        $this->db->where('zoomzoom_mocktest_purchase.product_name', $product);
         $this->db->where('zoomzoom_mocktest_purchase.level_id', $level);
        $this->db->where('zoomzoom_mocktest_purchase.period', $period);
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
	  //print_r($query->result());exit;
        return $query->result_array();
    }
    
 
    public function zoomzoom_export_new($school,$class,$level)
    {
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
        $this->db->join('zoomzoom_to_purchase', 'zoomzoom_to_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
        if($school!=''){
 	       $this->db->where('student_to_zoomzoom.school_name',$school);
 	    }
 	    if($class!='All'){
 	       $this->db->where('student_to_zoomzoom.class_id',$class);
 	    }
 	    $this->db->where('zoomzoom_to_purchase.payment_status', 'Success');
        $this->db->where('zoomzoom_to_purchase.clevel', $level);
        $this->db->where('zoomzoom_to_purchase.period_id', '12');
        $query = $this->db->get();
	//    echo $this->db->last_query();exit;
	 // print_r($query->result());exit;
        return $query->result_array();
 	    
    }
    
    
    public function zoomzoom_orientation_extract($franchise,$level,$period,$class,$product)
    {
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
        $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        if($franchise!='All'){
 	       $this->db->where('student_to_zoomzoom.franchise_id',$franchise);
 	    }
 	    if(!empty($class)){
 	       $this->db->where('student_to_zoomzoom.class_id',$class);
 	    }
        
        $this->db->join('zoomzoom_orientatition_purchase', 'zoomzoom_orientatition_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
       
        $this->db->where('zoomzoom_orientatition_purchase.product_name', $product);
        $this->db->where('zoomzoom_orientatition_purchase.level_id', $level);
        $this->db->where('zoomzoom_orientatition_purchase.period', $period);
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
	  //print_r($query->result());exit;
        return $query->result_array();
    }
 
 
    public function zoomzoom_student_list($franchise,$level,$period,$class)
    {
        $this->db->select('student_to_zoomzoom.zoomzoom_prid');
        $this->db->from('student_to_zoomzoom');
        
        $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        
        $this->db->where('franchise_to_zoomzoom.franchise_id', $franchise);
        
        $this->db->where('student_to_zoomzoom.level_id', $level);
        $this->db->where('student_to_zoomzoom.period_id', $period);
           
 	    if(!empty($class)){
 	     //  echo $class;die;
 	       // $this->db->join('cart', 'students.PRID=cart.prid');
 	       $this->db->where('class_id',$class);
         //	$this->db->where_in('cart.product_name', $product);
                
 	    }
        
        
        $this->db->join('zoomzoom_to_cin', 'zoomzoom_to_cin.prid=student_to_zoomzoom.zoomzoom_prid');
        $this->db->where('zoomzoom_to_cin.product_name', 'MaRRS ZoomZoom');
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
	  //print_r($query->result());exit;
        return $query->result();
    }
 
 
    public function cin_list_allstate($period_id,$from,$to)
    {
        $this->db->select('cin_list.id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,school_new.school_name,cin_list.school_address1,cin_list.franchise_code
        ,cin_result.product_name,cin_result.clevel,cin_result.period_id,study_material_byprid.amount,study_material_byprid.rozarpay_payment_id,study_material_byprid.time,states.state_subdivision_name');
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin','left');
        $this->db->join('study_material_byprid', 'cin_list.cin = study_material_byprid.cin','left');
        $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
        $this->db->join('states', 'school_new.state = states.state_subdivision_id','left');
        $this->db->where('study_material_byprid.time BETWEEN "'.$from.'" AND "'.$to.'"');
        $this->db->where('cin_result.period_id', $period_id);
         $this->db->group_by('cin_list.cin');
        $query = $this->db->get();
	 // echo $this->db->last_query();exit;
	 //echo "<pre>";print_r($query->result_array());die;
	   
        return $query->result_array();
    }
 
 
    public function cin_list_allproducts($state_id,$period_id,$from,$to)
    {
        $this->db->select('cin_list.id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,school_new.school_name,cin_list.school_address1,cin_list.franchise_code
        ,cin_result.product_name,cin_result.clevel,cin_result.period_id,study_material_byprid.amount,study_material_byprid.rozarpay_payment_id,study_material_byprid.time,states.state_subdivision_name');
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin','left');
        $this->db->join('study_material_byprid', 'cin_list.cin = study_material_byprid.cin','left');
        $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
        $this->db->join('states', 'cin_list.state_id = states.state_subdivision_id','left');
        $this->db->where('study_material_byprid.time BETWEEN "'.$from.'" AND "'.$to.'"');
        $this->db->where('cin_result.period_id', $period_id);
        $this->db->where('cin_list.state_id', $state_id);
        $this->db->group_by('cin_list.cin');
        $query = $this->db->get();
	 // echo $this->db->last_query();exit;
	// echo "<pre>";print_r($query->result_array());die;
	   
        return $query->result_array();
    }
 
 
    public function cin_list_allproductfranchise($franchise_id,$product,$state_id,$period_id,$from,$to)
    {
        $this->db->select('cin_list.id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,school_new.school_name,cin_list.school_address1,cin_list.franchise_code
        ,cin_result.product_name,cin_result.clevel,cin_result.period_id,study_material_byprid.amount,study_material_byprid.rozarpay_payment_id,study_material_byprid.time,states.state_subdivision_name,franchise.username as franchise_name');
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin','left');
        $this->db->join('study_material_byprid', 'cin_list.cin = study_material_byprid.cin','left');
        $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
        $this->db->join('states', 'cin_list.state_id = states.state_subdivision_id','left');
        $this->db->join('franchise', 'school_new.franchise_id = franchise.franchise_id','left');
        $this->db->where('study_material_byprid.time BETWEEN "'.$from.'" AND "'.$to.'"');
        $this->db->where('cin_result.period_id', $period_id);
        $this->db->where('cin_list.state_id', $state_id);
        $this->db->where('cin_result.product_name', $product);
        $this->db->where('school_new.franchise_id', $franchise_id);
        $this->db->group_by('cin_list.cin');
        $query = $this->db->get();
	 //echo $this->db->last_query();exit;
	// echo "<pre>";print_r($query->result_array());die;
	   
        return $query->result_array();
    }
 
 
    public function cin_list_export_new($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to,$status_extract,$level)
    {
     
           if($status_extract=='offline_extract')
           {
          
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                //$this->db->join('areas','cin_list.franchise_code=areas.area_code');
                //$this->db->join('states','cin_list.state_id=states.state_subdivision_id');
                //$this->db->join('school_new','cin_list.school_id=school_new.id');
                //$this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id');
                $this->db->where('cin_result.period_id', $period_id);
               // $this->db->where('cin_list.insert_date BETWEEN "'.$from.'" AND "'.$to.'"');
               
                if($product!='All'){
                    $this->db->where('cin_result.product_name', $product);
                }
               
                if($level!='All'){
                 $this->db->where('cin_result.clevel', $level);
                }
                
                
                //$this->db->group_by('cin_list.cin');
                 
               $query = $this->db->get();
                           
                
          //print_r($this->db->last_query());die;
              }elseif($status_extract=='online'){
                   //echo $status_extract;die;
                $this->db->select('*');
                $this->db->from('study_material_byprid');
                $this->db->join('cin_list', 'cin_list.cin = study_material_byprid.cin');
                $this->db->join('states', 'cin_list.state_id = states.state_subdivision_id','left');
                $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
                $this->db->join('franchise', 'cin_list.franchise_id = franchise.franchise_id');
                $this->db->where('study_material_byprid.time BETWEEN "'.$from.'" AND "'.$to.'"');
                if($franchise_id!='All'){
                   // $this->db->join('franchise', 'school_new.franchise_id = franchise.franchise_id');
                    $this->db->where('cin_list.franchise_id', $franchise_id);
                 }
                if($class!='All'){
                    $this->db->where('cin_list.class', $class);
                }
                    $this->db->where('study_material_byprid.period', $period_id);
               
         	    if($school_id!='All'){
                    $this->db->where('school_new.id', $school_id);
                }
                if($product!='All'){
                    $this->db->where('study_material_byprid.product_name', $product);
                }
                if($state_id!='All'){
                    $this->db->where('cin_list.state_id', $state_id);
                }
                 if($level!='All'){
                 $this->db->where('study_material_byprid.clevel', $level);
                }
                
                $this->db->group_by('cin_list.cin');
                $query = $this->db->get();
               //print_r($this->db->last_query());die;
               
	         //print_r($query->result_array());die;
              }elseif($status_extract=='mocktest'){
          
               $query = $this->db->select("new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,
               new_cart.amount,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,
               cin_list.stud_email,cin_list.class,cin_list.stud_phone,school_new.school_name,school_new.school_address,cin_list.address1,
               cin_list.address2,cin_list.father_name,cin_list.mother_name,franchise.username,states.state_subdivision_name FROM new_cart");
               //print_r($query->result_array());die;
                $this->db->join('cin_list','cin_list.cin=new_cart.cin','left');
                $this->db->join('states', 'cin_list.state_id = states.state_subdivision_id','left');
                $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
                $this->db->join('franchise', 'cin_list.franchise_id = franchise.franchise_id');
                $this->db->where('new_cart.period_id', $period_id);
                $this->db->where('new_cart.amount','199');
                $this->db->where('new_cart.mock_test','Yes');
               
                if($state_id!='All'){
                 $this->db->where('cin_list.state_id', $state_id);
                }
                 if($product!='All'){
                    $this->db->where('new_cart.product_name', $product);
                }
                  if($level!='All'){
                 $this->db->where('new_cart.clevel', $level);
                }
                $this->db->where('new_cart.time BETWEEN "'.$from.'" AND "'.$to.'"');
                $this->db->group_by('new_cart.cin');
                $this->db->order_by('new_cart.time','DESC');
                $query = $this->db->get();
                
           }elseif($status_extract=='orientation'){
               
           $query = $this->db->select("new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,
                   new_cart.amount,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,
                   cin_list.stud_email,cin_list.class,cin_list.stud_phone,school_new.school_name,school_new.school_address,cin_list.address1,
                   cin_list.address2,cin_list.father_name,cin_list.mother_name,franchise.username,states.state_subdivision_name FROM new_cart");
                   //print_r($query->result_array());die;
                    $this->db->join('cin_list','cin_list.cin=new_cart.cin','left');
                    $this->db->join('states', 'cin_list.state_id = states.state_subdivision_id','left');
                    $this->db->join('school_new', 'cin_list.school_id = school_new.id','left');
                    $this->db->join('franchise', 'cin_list.franchise_id = franchise.franchise_id');
                    $this->db->where('new_cart.period_id', $period_id);
                    //$this->db->where('new_cart.amount','199');
                    $this->db->where('new_cart.orientation','Yes');
                    if($state_id!='All'){
                     $this->db->where('cin_list.state_id', $state_id);
                    }
                    $this->db->group_by('new_cart.cin');
                    $this->db->order_by('new_cart.time','DESC');
                    //echo $this->db->_error_number();;die;
                    $query = $this->db->get();
           }elseif($status_extract=='studymaterial'){
               
           $query = $this->db->query("SELECT new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,
           new_cart.amount,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,
           cin_list.stud_email,cin_list.class,cin_list.stud_phone,cin_list.school_name,cin_list.school_address1 FROM `new_cart`
           left join cin_list ON cin_list.cin=new_cart.cin WHERE 
           and new_cart.period_id='12' and new_cart.study_material='Yes' GROUP by new_cart.cin order by time DESC");
           }
           
          
           return $query->result_array();
           
    }
 
 
    public function cin_list_export_new_offline($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to)
    {
       // echo $franchise_id;die;
        if($franchise_id!=''){
        
        // echo 'ok'.$school_id;die;
            if($school_id!='All'){
                $this->db->select('cin_list.cin,cin_list.class,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_result.product_name,school_new.school_name,areas.area_code,franchise.username,states.state_subdivision_name');
                $this->db->from('cin_list');
                $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                $this->db->join('areas','cin_list.franchise_code=areas.area_code');
                $this->db->join('states','areas.state_id=states.state_subdivision_id');
                $this->db->join('school_new','cin_list.school_id=school_new.id');
                 $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id');
              
                if($class!='All'){
                    $this->db->where('cin_list.class', $class);
                }
                
                $this->db->where('cin_result.period_id', $period_id);
               
         	    if($school_id!='All'){
                    $this->db->where('school_new.id', $school_id);
                }
                if($product!='All Products'){
                    $this->db->where('cin_result.product_name', $product);
                }
                
                $this->db->group_by('cin_list.cin');
                
                $query = $this->db->get();
        	  //echo $this->db->last_query();exit;
        	 
                return $query->result_array();
            }else{
              //  echo 'okkk'.$franchise_code;die;
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                // $this->db->join('areas','cin_list.franchise_code=areas.area_code');
                $this->db->join('school_new','cin_list.school_id=school_new.id');
                $this->db->join('states','cin_list.state_id=states.state_subdivision_id');
                $this->db->group_by('cin_list.cin');
                if($class!='All'){
                    $this->db->where('cin_list.class', $class);
                }
                if($product!='All Products'){
                    $this->db->where('cin_result.product_name', $product);
                }
                $this->db->where('cin_result.period_id', $period_id);
               $this->db->where('cin_list.franchise_code', $franchise_code);
               $this->db->group_by('cin_list.cin');
                $query = $this->db->get();
        //	  echo $this->db->last_query();exit;
        	 
                return $query->result_array();
                
            }
            
            
        }else{
         //echo $period_id.'okkl';die;
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id');
                $this->db->join('school_new','cin_list.school_id=school_new.id');
                 $this->db->join('states','cin_list.state_id=states.state_subdivision_id');
                // $this->db->group_by('cin_list.cin');
                if($class!='All'){
                    $this->db->where('cin_list.class', $class);
                }
                if($product!='All Products'){
                    $this->db->where('cin_result.product_name', $product);
                }
                $this->db->where('cin_result.period_id', $period_id);
                 $this->db->where('cin_list.state_id', $state_id);
               
                $query = $this->db->get();
        	 //echo $this->db->last_query();exit;
        	 
                return $query->result_array();
         
        }
        
    }
 
 
    public function zoomzoom_student_list_data($franchise,$level,$period,$class)
    {
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
        
        $this->db->join('period', 'student_to_zoomzoom.period_id=period.period_id');
        $this->db->join('zoomzoom_to_purchase', 'zoomzoom_to_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
        $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        if($franchise!='All'){
        $this->db->where('student_to_zoomzoom.franchise_id', $franchise);
         
        }
        $this->db->where('student_to_zoomzoom.level_id', $level);
        $this->db->where('student_to_zoomzoom.period_id', $period);
        
        
 	    if(!empty($class)){
 	       // $this->db->join('cart', 'students.PRID=cart.prid');
 	       $this->db->where('class_id',$class);
         //	$this->db->where_in('cart.product_name', $product);
                
 	    }
        
        
        //$this->db->join('zoomzoom_mocktest_purchase', 'zoomzoom_mocktest_purchase.prid=student_to_zoomzoom.zoomzoom_prid');
      
       // $this->db->where('zoomzoom_to_cin.product_name', 'MaRRS ZoomZoom');
       // $this->db->group_by('student_to_zoomzoom.zoomzoom_prid');
        $query = $this->db->get();
	 // echo $this->db->last_query();exit;
	   $pr=$query->result()[0]->zoomzoom_prid;
	   //echo $pr;
	   
	   
	   // $this->db->select('product_name as "mock_product"');
    //     $this->db->from('zoomzoom_mocktest_purchase');
    //     $this->db->where('prid',$pr);
    //      $this->db->where('level_id', $level);
    //     $this->db->where('period', $period);
    //     $query = $this->db->get();
    //     print_r($query->result_array()[0]['product_name']);
	   //exit;
	  
        return $query->result_array();
    }
    
     
    public function zoomzoom_student_list_data_unpaid($arr,$class,$franchise,$level,$period)
    {
        //print_r($arr);die;
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
        //$this->db->join('period', 'student_to_zoomzoom.period_id=period.period_id');

        $this->db->join('franchise_to_zoomzoom', 'franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
        if($franchise!='All'){
        $this->db->where('student_to_zoomzoom.franchise_id', $franchise);
         
        }

        if(!empty($class)){
            $this->db->where('class_id',$class);
        }
        $this->db->where_in('zoomzoom_prid',$arr);
        // $this->db->where('franchise_id',$franchise);
        $this->db->where('level_id',$level);
        $this->db->where('period_id',$period);
        
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
	   //print_r($query->result());exit;
        return $query->result_array();
     }
     
     
 	public function student_list($para,$schools,$level,$product,$class)
 	{
	   // print_r($product); echo 'ok'; die;
	    $this->db->select('*');
        $this->db->from('students');
        $this->db->where_in('students.school_code', $schools);
        $this->db->where_in('students.level_id', $level);
        $this->db->where_in('students.class', $class);
           
 	    if(!empty($product)){
 	        $this->db->join('cart', 'students.PRID=cart.prid');
 	      //  $this->db->where('cart.payment_status','Paid');
         	$this->db->where_in('cart.product_name', $product);
                
 	    }
        
        $this->db->where('period_id', $_POST['period']);
        
        $query = $this->db->get();
	   // echo $this->db->last_query();exit;
        return $query->result_array();
	    
	}
 
 
    public function school_codes($franchise)
    {
         $this->db->select('school_code');
		 $this->db->from('schools');
		 $this->db->where_in('franchise_id',$franchise);
		 $query = $this->db->get(); 
		 //echo $this->db->last_query();
	     return $query->result_array();
    }
  
//   ======================================== //

    // public function save_csv_result($csv_result_array)
    // {
    //     extract($csv_result_array);
    //     echo "<pre>";print_r($csv_result_array);exit;
        
    //     $insert_result_OK='no';
    //     $result_status =  trim($status);
    //     $period            =  trim($period);
    //     $level             =  trim($level);
    //     $product           =  trim($product);
    //     $prid            =  trim($prid);
    //     $result  =  trim($result);
    //     $period_id=  trim($period_id);
    //     $level_id=  trim($level_id);
    //     $product_id=  trim($product_id);
    //     $grade=trim($grade);
    //     $rank=trim($rank);
    //     $performer=trim($performer);
    //     $speller=trim($speller);
    //     /*...........................................................*/
    //      /*STEP 1 : Get STUDENT DATA*/
    //     /*...........................................................*/
    
    //     if($period!=$period_id)
    //     {
    //     	  /*echo "empty ";exit;*/
    //     	   $insert_result_OK="no";
    //     	   $csv_result_LOG_array = array($prid,$period_id,$result," Error : Invalid Period ");
        
    //     } /* end of IF - STEP1*/
          
    //     else
    //     {
    // 	  /*echo "not empty ";exit;*/
    	 
    // 	    if($level_id!=$level)
    // 	    {
    //     		/* echo " emptystud_shcode ";exit;*/
    //     		 $insert_result_OK="no";
    //     		 $csv_result_LOG_array = array($prid,$period_id,$level," Error : Competition Level Not Match");
    // 	    }
    	 
    //         else
    //     	{
    //     	    if($product_id != $product)
    //     	    {
        			 
    //     		    $insert_result_OK="no";
    //                 $csv_result_LOG_array = array($prid,$period_id,$level," Error : Competition Level Not Match");
        		 
    //     	    }
    // 	        else{
    //         	     $this->db->select('*');
    //         		 $this->db->from('student_result');
    //         		 $this->db->where('product_id',$product_id);
    //         		 $this->db->where('PRID',$prid);
    //         		 $this->db->where('period',$period);
    //         		 $this->db->where('clevel',$level);
    //         		 $query = $this->db->get();
    //         		 $result_array=$query->result_array();
    //         	    if(!empty($result_array)){
    // 	                $insert_result_OK="no";
    // 		            $csv_result_LOG_array = array($prid,$period_id,$result," Error : Already Exist");
    //         	    }
    //                 else
    //         		{
    //     		        $insert_result_OK="yes";
    //     		    }
    // 	        }
     
    //         }
    
    //   }
    // /*............................................................................*/
    //   /*STEP 6 : $insert_result_OK="yes" then insert result into result table*/
    // /*..............................................................................*/
    	
    // if($insert_result_OK=="yes")
    // 	 {
    // 	   $ins_array  = array(	
    // 	                        'PRID'      => $prid,
    // 							'clevel'    => $level,
    // 							'period'    => $period,
    // 							'result'    => $result,
    // 							'product_id'    => $product_id,
    // 							'grade'=>$grade,
    // 						    'rank'=>$rank,
    // 						    'performer'=>$performer,
    // 						    'speller'=>$speller
    // 		                );
    						
    // 					 //echo"<pre>"."inserted array";print_r($ins_array);exit;	
    
    // 	 			/*---------------------------------------------------------------*/
    // 				  /* 1) INSERT result in sb_student_result*/	
    // 				/*---------------------------------------------------------------*/	
    // 			$ins_status = $this->db->insert('student_result',$ins_array);
    // 			if(!$ins_status)
    // 			{  $csv_result_LOG_array  = array($prid,$period_id,$result," Unknown Error : Result not uploaded(Query : ".$update_qry.")");
    // 			}/*End of if $update_status */
    // 			else
    // 			{ $csv_result_LOG_array  = array($prid,$period_id,$result," Success : Result uploaded "); }/* End of else */
    							
    // 	 } /* END OF if($insert_result_OK=="yes") */	
    	
    // 	 return $csv_result_LOG_array;
    // }
	

// ==================14/10/2023===================== //	
    
   public function save_csv_result1($csv_result_array)
    {
        extract($csv_result_array);
        
        //echo "<pre>";print_r($csv_result_array);echo 'ok';exit;
        $insert_result_OK='no';
        $status =  trim($status);
        //$period_id            =  trim($period_id);
        $clevel             =  trim($clevel);
        //$product_id           =  trim($product_id);
        
        $search_period            =  trim($search_period);
        $search_level             =  trim($search_level);
        $search_product           =  trim($search_product);
        
        $competition_date=trim($competition_date);
        
        $cin            =  trim($cin);
        $result  =  trim($result);
        $period_id=  trim($period_id);
        $level_id=  trim($level_id);
        $product_id=  trim($product_id);
        $grade=trim($grade);
        $rank=trim($rank);
        $marks=trim($marks);
        $performer=trim($performer);
        $speller=trim($speller);
        /*...........................................................*/
         /*STEP 1 : Get STUDENT DATA*/
        /*...........................................................*/
        
           $insert_result_OK="no";
             $ins_array  = array(	
                 'cin'          => $cin,
                 'clevel'       => $clevel,
                 'period_id'    => $period_id,
                 'status'       => $status,
                 'product_id'   => $product_id,
                 'product_name' =>$product_name,
                 'grade'        =>$grade,
                 'rank'         =>$rank,
                 'performer'    =>$performer,
                 'speller'      =>$speller,
                 'marks'        =>$marks
                         ); 
                    	              
                    	            
                    	       //    print_r($ins_array);die;
                   $csv_result_LOG_array  = array($cin,$period_id,$status," Success : Result uploaded ");
                   $ins_status = $this->db->insert('cin_result',$ins_array);
                                    	 
            
    
                                  
      
        return $csv_result_LOG_array;
    } 
    
    
    public function save_csv_result($csv_result_array)
    {
        extract($csv_result_array);
        
        //echo "<pre>";print_r($csv_result_array);echo 'ok';exit;
        $insert_result_OK='no';
        $status =  trim($status);
        //$period_id            =  trim($period_id);
        $clevel             =  trim($clevel);
        //$product_id           =  trim($product_id);
        
        $search_period            =  trim($search_period);
        $search_level             =  trim($search_level);
        $search_product           =  trim($search_product);
        
        $competition_date=trim($competition_date);
        
        $cin            =  trim($cin);
        $result  =  trim($result);
        $period_id=  trim($period_id);
        $level_id=  trim($level_id);
        $product_id=  trim($product_id);
        $grade=trim($grade);
        $rank=trim($rank);
        $marks=trim($marks);
        $performer=trim($performer);
        $speller=trim($speller);
        /*...........................................................*/
         /*STEP 1 : Get STUDENT DATA*/
        /*...........................................................*/
        
        
        //echo $search_period.'-'.$period_id;die;
        if($search_period!=$period_id)
        {
    	  //echo "empty ";exit;
    	   $insert_result_OK="no";
    	   $csv_result_LOG_array = array($cin,$period_id,$status," Error : Invalid search Period ");
    
        } /* end of IF - STEP1*/
      
        else
        {
    	  //echo "not empty ";exit;
    	 
    	    if($search_level!=$clevel)
    	    {
    		 
    		    $insert_result_OK="no";
    		    $csv_result_LOG_array = array($cin,$period_id,$clevel," Error : Competition Level Not Match");
    	    }
    	 
    	    else
    	    {
    	        if($search_product != $product_id)
    	        {
    			 
    		        $insert_result_OK="no";
                    $csv_result_LOG_array = array($cin,$period_id,$clevel," Error : Search Product Not Match");
    		 
    	        }
    	        else
    	        {
    	       
    	       
    	            if($period_id>12){
    	           //echo 'ok';die;
    	                $this->db->select('*');
            		    $this->db->from('competition_level_byproduct');
            		    $this->db->where('product_id',$product_id);
            		    $this->db->order_by('level_id','ASC');
            		    $query = $this->db->get();
            		   // echo $this->db->last_query();die;
            		    $product_details=$query->row_array();
            		    //print_R($product_details['level_id']);echo $search_level;die;
            		    
    	              
    	                if($product_details['level_id']!=$search_level){
    	           
            	         //  echo 'ko';die;
            	                $this->db->select('*');
                    		    $this->db->from('cin_list');
                    		    $this->db->where('cin',$cin);
                    		    $query = $this->db->get();
                    		   // echo $this->db->last_query();die;
                    		    $student_details=$query->row_array();
                	         //  print_r($student_details);die;
                	           $franchise_id=$student_details['franchise_id'];
                	           $class=$student_details['class'];
                	           $school_id=$student_details['school_id'];
    	           
            	                $this->db->select('*');
                    		    $this->db->from('competition_schedule');
                    		    $this->db->where('category_id',$class);
                    		    $this->db->where('franchise_id',$franchise_id);
                    		    $this->db->where('product_id',$product_id);
                    		    $this->db->where('competition_level_id',$clevel);
                    		    $this->db->where('period_id',$period_id);
                    		    $query = $this->db->get();
                    		  //  echo $this->db->last_query();die;
                    		    $schedule_details=$query->row_array();
            	           //print_r($student_details);die;
    	           
            	           if(empty($schedule_details)){
            	            $insert_result_OK="no";
                            $csv_result_LOG_array = array($cin,$period_id,$franchise_id," Error : No Schedule Fixed.");
            	           }else{
            	               $competition_schedule_id=$schedule_details['competition_schedule_id'];
            	                $this->db->select('*');
                    		    $this->db->from('schedule_to_school');
                    		    $this->db->where('competition_schedule_id',$schedule_details['competition_schedule_id']);
                    		    $this->db->where('school_id',$school_id);
                    		    $query = $this->db->get();
                    		   // echo $this->db->last_query();die;
                    		    $schedule_to_school=$query->row_array();
            	         //  print_r($student_details);die;
            	         
            	                if(empty($schedule_to_school)){
            	                    $insert_result_OK="no";
                                    $csv_result_LOG_array = array($cin,$period_id,$schedule_details['competition_schedule_id']," Error : Schedule not assigned to school.");
            	                }else{
            	                    
            	                    $insert_result_OK="yes";
            	                }
            	                
            	               
            	           }
            	           
            	           
    	            }else{
    	       
    	      // echo 'ok';die;
    	                $this->db->select('product_name');
            		    $this->db->from('products');
            		    $this->db->where('product_id',$product_id);
            		    $query = $this->db->get();
            		    //echo $this->db->last_query();die;
            		    $product_name=$query->row_array();
    	                $product_name=$product_name['product_name'];
    	     //  echo $product_name;die;
    	       
    	      
    	       
            	     $this->db->select('status,product_name');
            		 $this->db->from('cin_result');
            // 		 $this->db->where('product_name',$product_name);
            		 $this->db->where('cin',$cin);
            // 		 $this->db->where('period_id',$period_id);
            		 $this->db->where('clevel',$clevel);
            		 
            		 $query = $this->db->get();
            		
            		 //echo $this->db->last_query();die;
            		 $result_array=$query->row_array();
            		 $result_status=$result_array['status'];
            		 $result_product=$result_array['product_name'];
            		 
            	//	print_r($result_status);	print_r($result_product);die;
            		
            		 if($result_product!=''){
            		    
            	       if($result_status!=''){
             	            $insert_result_OK="no";
             	           
            		        $csv_result_LOG_array = array($cin,$period_id,$status," Error : Already Exist.");
            	       }
            	       	else
                		{
                		    
                		    
                		  //  if(empty($competition_date)){
                		        
                		  //      $insert_result_OK="no";
             	           
            		      //  $csv_result_LOG_array = array($cin,$period_id,$competition_date," Error : Enter competition date.");
                		        
                		  //  }else{
                        		   $insert_result_OK="no";
                        		        $ins_array  = array(	
                	                        'cin'      => $cin,
                							'clevel'    => $clevel,
                							'period_id'    => $period_id,
                							'status'    => $status,
                							'product_id'    => $product_id,
                							'product_name'=>$product_name,
                							'grade'=>$grade,
                						    'rank'=>$rank,
                						    'performer'=>$performer,
                						    'speller'=>$speller,
                						    'marks'=>$marks,
                						    'competition_date'=>$competition_date,
                						    'competition_schedule_id'=>'',
                						    'venue'=>''
            		                        ); 
                    	            
                    	            
                    	            //print_r($ins_array);die;
                    	                $this->db->where('cin', $cin);
                    	                $this->db->where('clevel', $clevel);
                                        $this->db->update('cin_result',$ins_array);
                                        $csv_result_LOG_array  = array($cin,$period_id,$status," Success : Result uploaded ");
                		    }
                	//	}
            		     
            		 }else{
                		    $insert_result_OK="yes";
                		}
                		
            	   }
    	       }
    	       
    	       else
    	       {
    	           //echo 'ok';die;
    	            $this->db->select('status');
            		 $this->db->from('cin_result');
            // 		 $this->db->where('product_name',$product_name);
            		 $this->db->where('cin',$cin);
            // 		 $this->db->where('period_id',$period_id);
            		 $this->db->where('clevel',$clevel);
            		 
            		 $query = $this->db->get();
            		
            // 		 echo $this->db->last_query();die;
            		 $result_array=$query->row_array();
            		// print_r($result_array['status']);die;
            		 if(!empty($result_array['status'])){
            		      $csv_result_LOG_array = array($cin,$period_id,$status," Error : Already Exist.");
            		     //print_r($csv_result_LOG_array);die;
            		     
            		     
            		     $insert_result_OK="no";
             	           
            		       
            		 }else{
            		      //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
    	                    
            		     if(empty($competition_date)){
                		        
                		        $insert_result_OK="no";
             	           
            		        $csv_result_LOG_array = array($cin,$period_id,$competition_date," Error : Enter competition date.");
                		        
                		    }else{
                		       // echo 'o';die;
                		       
                		       if(empty($venue)){
                		        
                		        $insert_result_OK="no";
             	           
            		        $csv_result_LOG_array = array($cin,$period_id,$competition_date," Error : Enter venue date.");
                		        
                		    }else{
                        		   $insert_result_OK="no";
                        		        $ins_array  = array(	
                	                        'cin'      => $cin,
                							'clevel'    => $clevel,
                							'period_id'    => $period_id,
                							'status'    => $status,
                							'product_id'    => $product_id,
                							'product_name'=>$product_name,
                							'grade'=>$grade,
                						    'rank'=>$rank,
                						    'performer'=>$performer,
                						    'speller'=>$speller,
                						    'marks'=>$marks,
                						    'competition_date'=>$competition_date,
                						    'competition_schedule_id'=>'',
                						    'venue'=>$venue
            		                        ); 
                    	            
                    	            
                    	           // print_r($ins_array);die;
                    	                
                                       $csv_result_LOG_array  = array($cin,$period_id,$status," Success : Result uploaded ");
                                       
                                       //print_r($csv_result_LOG_array);die;
                                    	$ins_status = $this->db->insert('cin_result',$ins_array);
                                    	 
                		    }
                		       
                		       
                		       
                		    }
            		     
            		 }
            		 
            		 
            		 
    	           
    	       }
    	   }
     
            }
    
        }
      
        return $csv_result_LOG_array;
    }
    
// ========= end ============ //

    public function edit_csv_result($csv_result_array)
    {
        extract($csv_result_array);
    
        $insert_result_OK  = 'no';
    
        $result_status = trim($status);
        $clevel        = trim($clevel);
        $cin           = trim($cin);
        $marks         = trim($marks);
        $product_name  = trim($product_name);
        $product_id    = trim($product_id);
        $grade         = trim($grade);
        $rank          = trim($rank);
        $performer     = trim($performer);
        $speller       = trim($speller);
    
        // ✅ Validate CIN
        if (preg_match('/^cin$/i', $cin) || empty($cin)) 
        {
            return array($cin, $product_name, $level, "Error : Header line or CIN empty.");
        }
    
        // ✅ Check existing record
        $res = $this->db->where('cin', $cin)
                        ->where('clevel', $clevel)
                        ->where('product_name', $product_name)
                        ->order_by('id','DESC')
                        ->get('cin_result');
                        
        $db_result = $res->row();
    
        // echo $this->db->last_query();die;
        
        if (empty($db_result))
        {
            return array($cin, $product_name, $level, "Error : Result Not Found.");
        }
    
        // ✅ Prepare update array
        $ins_array = array();

        if($result_status !== '') $ins_array['status'] = $result_status;
        if($product_id !== '')   $ins_array['product_id'] = $product_id;
        if($grade !== '')        $ins_array['grade'] = $grade;
        if($rank !== '')         $ins_array['rank'] = $rank;
        if($performer !== '')    $ins_array['performer'] = $performer;
        if($speller !== '')      $ins_array['speller'] = $speller;
        if($product_name !== '') $ins_array['product_name'] = $product_name;
        if($marks !== '')        $ins_array['marks'] = $marks;

    
        // print_r($ins_array);die;
        // ✅ IMPORTANT WHERE condition
        $this->db->where('cin', $cin);
        $this->db->where('product_name', $product_name);
        $this->db->where('clevel', $clevel);
        $this->db->where('id',$db_result->id);
        
        $ins_status = $this->db->update('cin_result', $ins_array);
        if (!$ins_status)
        {
            return array($cin, $product_name, $result_status, "Error : Result not updated.");
        }
    
        return array($cin, $product_name, $result_status, "Success : Result updated.");
    }


	
	public function insert_zoomzoommaterials($insert_data)
	{
	    extract($insert_data);
	   
	    $ins_status=$this->db->insert('zoomzoom_studymaterial',$insert_data);
	    //print_r($ins_status);die;
	    
	    if($ins_status=1){
	        return 'Yes';
	    }else{
	   
	    
	    return 'No';
	        
	    }
	}
	
	
	public function insert_materials($insert_data)
	{
	    extract($insert_data);
	    //print_r($insert_data);
	    $it=explode('-',$insert_data['status']);
	   
	    
	    $arr=array(
	        'title'=>$insert_data['title'],
	        'status'=>$it[0],
	        'type'=>$it[1],
	        'period'=>$insert_data['period'],
	        'clevel'=>$insert_data['clevel'],
	        'folder'=>$insert_data['folder'],
	        'class'=>$insert_data['class'],
	        'price'=>'',
	        'product_id'=>$insert_data['product_id'],
	        'product_name'=>$insert_data['product_name'],
	        
    		'material_maker_id'=>$insert_data['material_maker_id'],
    		'maker_price'=>$insert_data['maker_price'],
	        'subject'=>$insert_data['subject'],
			'sub_type'=>$insert_data['varient'],
			'series'=>$insert_data['series'],
	        );
	    
	    
// 	     $this->db->select('*');
// 		 $this->db->from('study_material');
// 		 $this->db->where('period',$insert_data['period']);
// 		 $this->db->where('clevel',$insert_data['clevel']);
// 		 $this->db->where('class',$insert_data['class']);
// 		 $this->db->where('product_id',$insert_data['product_id']);
// // 		 $this->db->where('folder',$insert_data['folder']);
// 		 $this->db->where('status',$insert_data['status']);
// 		 $query = $this->db->get();
//  	//	 echo $this->db->last_query();die;
// 		 $result_array=$query->result_array();
		// print_r($result_array);die;
	   //if(empty($result_array)){
	   //print_r($insert_data);die;
	   
	   //  echo "<pre>";print_r($arr);die;
	   
	   
	    $this->db->insert('study_material',$arr);
	       $ins_status='yes';
	   //}else{
	      //$ins_status='no';
	   //}
	    
	    return $ins_status;
	}
	
	
	public function list_materials()
	{
	    $this->db->select('study_material.type,study_material.series,study_material.subject,study_material.sub_type,study_material.id,study_material.clevel,study_material.class,study_material.status,study_material.price,study_material.title,study_material.subject,study_material.product_name,study_material.folder,period.academic_year,study_material.maker_price,study_material.material_maker_id');
		 $this->db->from('study_material');
		 $this->db->join('period', 'study_material.period=period.period_id');
		 $this->db->limit('20');
		 $this->db->order_by('id','DESC');
		 $query = $this->db->get();
 		 //echo $this->db->last_query();die; 
		 $result_array=$query->result_array();
		 return $result_array;
	}
	
	
	public function list_search_material($product,$period,$clevel,$class,$type,$subject,$varient,$series,$product_name)
	{
		    
		  //  echo $product.'    '.$period.'  '.$clevel.'  '.$class.'   '.$type.'  '.$subject.'  '.$varient.'  '.$series.'   '.$product_name;die;
		    
    	    $this->db->select('study_material.title,study_material.folder,study_material.status,period.academic_year,competition_level_byproduct.level_name,assigned_materials.*,study_material.product_name,study_material.id,study_material.type,study_material.subject,study_material.series,study_material.sub_type,study_material.class');
    		$this->db->from('study_material');
    		$this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id=study_material.clevel','left');
    		$this->db->join('assigned_materials', 'assigned_materials.mat_id=study_material.id');
            $this->db->join('period', 'period.period_id=assigned_materials.period_id');
    		$this->db->where('competition_level_byproduct.product_name',$product_name);
    		$this->db->where('study_material.product_name',$product_name);
    		
    // 		$this->db->where('study_material.product_id',$product);
    		
    		if($type!=''){
    		    $this->db->where('study_material.type',$type);
    		}
    		
    		if($period!=''){
    		    $this->db->where('assigned_materials.period_id',$period);
    		}
    		
    		if($clevel!='' || !empty($clevel)){
    		    $this->db->where('study_material.clevel',$clevel);
    		}
    		
    		if($class!='All'){
    		    $this->db->where('class',$class);
    		}
    		
    		if($subject!='' || !empty($subject)){
    		    $this->db->where('study_material.subject',$subject);
    		}
    		
    		if($varient!='' || !empty($varient)){
    		    $this->db->where('study_material.sub_type',$varient);
    		}
    		
    		if($series!='' || !empty($series)){
    		    $this->db->where('study_material.series',$series);
    		}
    		
    		 $query = $this->db->get();
     		 
     		 //echo $this->db->last_query();die; 
     		 
    		 $result_array=$query->result_array();
    		 return $result_array;
    	}
	
	
	public function list_search_materialadmin($product,$period,$clevel,$class,$type,$subject,$varient,$series,$product_name)
	{
		    
		  //  echo $product.'    '.$period.'  '.$clevel.'  '.$class.'   '.$type.'  '.$subject.'  '.$varient.'  '.$series.'   '.$product_name;die;
		    
    	    $this->db->select('study_material.title,study_material.folder,study_material.status,period.academic_year,competition_level_byproduct.level_name,study_material.product_name,study_material.id,study_material.type,study_material.subject,study_material.series,study_material.sub_type,study_material.class');
    		$this->db->from('study_material');
    		$this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id=study_material.clevel','left');
    // 		$this->db->join('assigned_materials', 'assigned_materials.mat_id=study_material.id');
            $this->db->join('period', 'period.period_id=study_material.period');
    		$this->db->where('competition_level_byproduct.product_name',$product_name);
    		$this->db->where('study_material.product_name',$product_name);
    		
    		if($type!=''){
    		    $this->db->where('study_material.type',$type);
    		}
    		
    		if($clevel!='' || !empty($clevel)){
    		    $this->db->where('study_material.clevel',$clevel);
    		}
    		
    		if($class!='All'){
    		    $this->db->where('class',$class);
    		}
    		
    		if($subject!='' || !empty($subject)){
    		    $this->db->where('study_material.subject',$subject);
    		}
    		
    		if($varient!='' || !empty($varient)){
    		    $this->db->where('study_material.sub_type',$varient);
    		}
    		
    		if($series!='' || !empty($series)){
    		    $this->db->where('study_material.series',$series);
    		}
    		
    		 $query = $this->db->get();
     		 
     		 //echo $this->db->last_query();die; 
     		 
    		 $result_array=$query->result_array();
    		 return $result_array;
    	}
	
	
	public function list_materialsedit($id)
	{
	    $this->db->select('study_material.id,study_material.clevel,study_material.class,study_material.status,study_material.period,study_material.price,study_material.title,study_material.subject,study_material.product_name,period.academic_year');
		 $this->db->from('study_material');
		 $this->db->join('period', 'study_material.period=period.period_id');
		 $this->db->where('id',$id);
		 $query = $this->db->get(); 
 		 //echo $this->db->last_query();die;
		 $result_array=$query->row();  
		 return $result_array;
	}
	
	
	public function orientatition_list_2021($product,$class,$status)
	{
	   // echo $class;die;
	   // $this->db->select('*');
	    $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,new_cart.product_name');

		$this->db->from('cin_list');
		$this->db->join('new_cart', 'new_cart.cin=cin_list.cin');
		$this->db->where('new_cart.orientation',$status);
		$this->db->where('new_cart.product_name',$product);
		if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		$query = $this->db->get();
	//	echo $this->db->last_query();die;
		$result_array=$query->result_array();
	//	$result=array();
 	//	print_r($result_array);die;
 	if(!empty($result_array)){
		$cin_array=array();
        foreach($result_array as $row){
           $name1=$row['cin'];
           if(!in_array($cin,$cin_array)){
           array_push($cin_array,$name1);
           }
           
        }
 	}
        // print_r($cin_array);
                // echo count($cin_array);
    	if(!empty($cin_array)){
        $this->db->select('cin');
        $this->db->from('new_cart');
        $this->db->where_in('cin', $cin_array);
        $this->db->where('new_cart.orientation','Yes');
        $query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result=$query->result_array();
    	}
// 		print_r($result);die;
//	echo count($result);
	 $cin_array_final=array();
		 //$product_array=array();
        foreach($result as $row){
           $name1=$row['cin'];
        //   if(!in_array($cin,$cin_array)){
           array_push($cin_array_final,$name1);
        //   }
          
        }
//	print_r($cin_array_final);die;
	
	    $cin_paid=array();
	    $cin_unpaid=array();

        foreach($cin_array as $row){
            // echo $row;die;
            if(!in_array($row,$cin_array_final)){
                
            	array_push($cin_unpaid,$row);
            	
            }else{
                // echo $row;die;
                array_push($cin_paid,$row);  
            }
            
        }
        // echo count($cin_array);die;
        // echo count($cin_array);die;
        // print_r($cin_paid);die;
        
        

        if($status=='Yes' && !empty($cin_paid)){
            
            $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
            
            $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
            $this->db->from('cin_list');
            $this->db->where_in('cin_list.cin', $cin_paid);
            //echo $this->db->last_query();die;
            $query = $this->db->get();
            
		    $arrayresult=$query->result_array();
		    
            return $arrayresult;
        }else{
            //print_r($cin_unpaid);die;
            if(!empty($cin_unpaid)){
                $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                
                $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                $this->db->from('cin_list');
                $this->db->where_in('cin_list.cin', $cin_unpaid);
                $query = $this->db->get();
    		    $arrayresult=$query->result_array();
    		  //  echo $this->db->last_query();die;
                return $arrayresult;
            }
            else{
                return $arrayresult=array();
            }
        }
	    
	}
	
	
	public function competition_list_2021($product,$class,$status,$period,$level,$state_id)
	{
	    
	     $this->db->select('cin_list.cin,new_cart.product_name');
		 $this->db->from('cin_list');
		 $this->db->join('new_cart', 'new_cart.cin=cin_list.cin');
		 //$this->db->where('cin_result.status','Q');
		 $this->db->where('new_cart.clevel',$level);
		 $this->db->where('new_cart.period_id',$period);
		 $this->db->where('cin_list.state_id',$state_id);
		 $this->db->where('new_cart.product_name',$product);
		 if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		if($product!='all'){
		    $this->db->where('new_cart.product_name',$product);
		}
		 $query = $this->db->get(); 
 		 //echo $this->db->last_query();die;
		 $result_array=$query->result_array();
 		 //print_r($result_array);die;
		 $cin_array=array();
		 //$product_array=array();
        	if(!empty($result_array)){
                foreach($result_array as $row){
                   $name1=$row['cin'];
                //   if(!in_array($cin,$cin_array)){
                   array_push($cin_array,$name1);
                //   }
                  
                }
        	}
                // print_r($cin_array);die;
                // echo count($cin_array);
                
            if(!empty($cin_array)){ 
                $this->db->select('cin');
                $this->db->from('new_cart');
                $this->db->where_in('cin', $cin_array);
                $this->db->where('new_cart.status','Paid');
                $query = $this->db->get();
        // 		echo $this->db->last_query();die;
        		$result=$query->result_array();
        		
            }
        // 		print_r($result);die;
        //	echo count($result);
        	 $cin_array_final=array();
        		 //$product_array=array();
                foreach($result as $row){
                   $name1=$row['cin'];
                //   if(!in_array($cin,$cin_array)){
                   array_push($cin_array_final,$name1);
                //   }
                  
                }
        //	print_r($cin_array_final);die;
        	
    	    $cin_paid=array();
    	    $cin_unpaid=array();
            foreach($cin_array as $row){
                // echo $row;die;
                if(!in_array($row,$cin_array_final)){
                    
                	array_push($cin_unpaid,$row);
                	
                }else{
                    // echo $row;die;
                    array_push($cin_paid,$row);  
                }
                
            }
        
        if(!empty($cin_paid)){
            $this->db->select(' new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,cin_list.school_name,cin_list.school_address1');
            
            $this->db->join('cin_list', 'cin_list.cin=new_cart.cin','left');
            $this->db->from('new_cart');
            $this->db->where_in('cin_list.cin', $cin_paid);
            $query = $this->db->get();
		    $arrayresult=$query->result_array();
		   // echo $this->db->last_query();die;
            return $arrayresult;
        }else{
            //print_r($cin_unpaid);die;
            if(!empty($cin_unpaid)){
                $this->db->select(' new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,cin_list.school_name,cin_list.school_address1');
                
                $this->db->join('cin_list', 'cin_list.cin=new_cart.cin','left');
                $this->db->from('new_cart');
                $this->db->where_in('new_cart.cin', $cin_unpaid);
                $query = $this->db->get();
    		    $arrayresult=$query->result_array();
    		    //echo $this->db->last_query();die;
                return $arrayresult;
            }
            else{
                return $arrayresult=array();
            }
        }
       //print_r($cin_paid);die;
        
	}
	
	
	public function competition_list_2022($product,$class,$status,$period,$clevel)
	{
	    
	    //echo $product.$class.$status.$period.$clevel;exit;
		    $this->db->select('new_cart.cin,new_cart.product_name,new_cart.clevel,new_cart.period_id,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone');
            $this->db->join('cin_list', 'cin_list.cin=new_cart.cin');
            $this->db->from('new_cart');
            $this->db->where('new_cart.status', $status);
            $this->db->where('new_cart.clevel', $clevel);
            $this->db->where('new_cart.period_id', $period);
            $this->db->where('new_cart.product_name', $product);
            $query = $this->db->get();
		    return $arrayresult=$query->result_array();
		   //print_r($arrayresult);exit;
	}
	
	
	public function mock_test_list_2021($product,$class,$status)
	{
	   // $this->db->select('*');
	    $this->db->select('cin_list.cin');
		$this->db->from('cin_list');
		$this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
		$this->db->where('cin_result.status','Q');
		$this->db->where('cin_result.product_name',$product);
		if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result_array=$query->result_array();
	//	$result=array();
// 		print_r($result_array);die;
		$cin_array=array();
	if(!empty($result_array)){
        foreach($result_array as $row){
           $name1=$row['cin'];
           if(!in_array($cin,$cin_array)){
           array_push($cin_array,$name1);
           }
           
        }
	}
        // print_r($cin_array);
// 		die;
        if(!empty($cin_array)){
        $this->db->select('cin');
        $this->db->from('new_cart');
        $this->db->where_in('cin', $cin_array);
        $this->db->where('new_cart.mock_test','Yes');
        $query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result=$query->result_array();
        }
// 		print_r($result);die;
//	echo count($result);
	 $cin_array_final=array();
		 //$product_array=array();
        foreach($result as $row){
           $name1=$row['cin'];
        //   if(!in_array($cin,$cin_array)){
           array_push($cin_array_final,$name1);
        //   }
          
        }
//	print_r($cin_array_final);die;
	
	    $cin_paid=array();
	    $cin_unpaid=array();
        foreach($cin_array as $row){
            // echo $row;die;
            if(!in_array($row,$cin_array_final)){
                
            	array_push($cin_unpaid,$row);
            	
            }else{
                // echo $row;die;
                array_push($cin_paid,$row);  
            }
            
        }
        // echo count($cin_array);die;
        // echo count($cin_array);die;
        // print_r($cin_unpaid);die;
        //echo $status;die;

        if($status=='Yes' && !empty($cin_paid)){
                    $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                    
                    $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                    $this->db->from('cin_list');
                    $this->db->where_in('cin_list.cin', $cin_paid);
                    $query = $this->db->get();
        		    $arrayresult=$query->result_array();
                    return $arrayresult;
                }else{
                    if(!empty($cin_unpaid)){
                    $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                    
                    $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                    $this->db->from('cin_list');
                    $this->db->where_in('cin_list.cin',$cin_unpaid);
                    $query = $this->db->get();
        		    $arrayresult=$query->result_array();
                    return $arrayresult;}else{return $arrayresult=array();}
                    
                }
                
        	}
	
	
	public function study_material_list_2021($product,$class,$status)
    {
        // $this->db->select('*');
	    $this->db->select('cin_list.cin');
		$this->db->from('cin_list');
		$this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
		$this->db->where('cin_result.status','Q');
		$this->db->where('cin_result.product_name',$product);
		if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result_array=$query->result_array();
	//	$result=array();
// 		print_r($result_array);die;
		$cin_array=array();
	if(!empty($result_array)){
        foreach($result_array as $row){
           $name1=$row['cin'];
           if(!in_array($cin,$cin_array)){
           array_push($cin_array,$name1);
           }
           
        }
	}
        // print_r($cin_array);
// 		die;

if(!empty($cin_array)){
        $this->db->select('cin');
        $this->db->from('new_cart');
        $this->db->where_in('cin', $cin_array);
        $this->db->where('new_cart.study_material','Yes');
        $query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result=$query->result_array();
}
// 		print_r($result);die;
//	echo count($result);
	 $cin_array_final=array();
		 //$product_array=array();
        foreach($result as $row){
           $name1=$row['cin'];
        //   if(!in_array($cin,$cin_array)){
           array_push($cin_array_final,$name1);
        //   }
          
        }
//	print_r($cin_array_final);die;
	
	    $cin_paid=array();
	    $cin_unpaid=array();
        foreach($cin_array as $row){
            // echo $row;die;
            if(!in_array($row,$cin_array_final)){
                
            	array_push($cin_unpaid,$row);
            	
            }else{
                // echo $row;die;
                array_push($cin_paid,$row);  
            }
            
        }
        // echo count($cin_array);die;
        // echo count($cin_array);die;
        // print_r($cin_unpaid);die;
        //echo $status;die;


        if($status=='Yes' && !empty($cin_paid)){
                    $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                    
                    $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                    $this->db->from('cin_list');
                    $this->db->where_in('cin_list.cin', $cin_paid);
                    $query = $this->db->get();
        		    $arrayresult=$query->result_array();
                    return $arrayresult;
                }else{
                    if(!empty($cin_unpaid)){
                        $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                        
                        $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                        $this->db->from('cin_list');
                        $this->db->where_in('cin_list.cin',$cin_unpaid);
                        $query = $this->db->get();
            		    $arrayresult=$query->result_array();
                        return $arrayresult;
                        }
                    else{
                        return $arrayresult=array();
                    }
                }
        	
    }	
    
    
	public function not_applied($product,$class)
	{
	    $this->db->select('cin_list.cin');
		$this->db->from('cin_list');
// 		$this->db->join('new_cart', 'new_cart.cin=cin_list.cin');
		$this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
		$this->db->where('cin_result.status','Q');
		if($product!='all'){
		    $this->db->where('cin_result.product_name',$product);
		}
		if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		$query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result_array=$query->result_array();
		//print_r($result_array);die;
          $cin_array=array();
            foreach($result_array as $row){
                $cin=$row['cin'];
                // echo $row;die;
                // print_r($row['cin']);die;
                array_push($cin_array,$cin);  
            }
            //print_r($cin_unpaid);die;
            // print_r($cin_array);die;
        $this->db->select('cin');
        $this->db->from('new_cart');
        $this->db->where('product_name',$product);
        $query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result=$query->result_array();
// 		print_r($result);die;
		$result_array=array();
            foreach($result as $row){
                $cin=$row['cin'];
                array_push($result_array,$cin);  
            }
        //   print_r($result_array);die; 
        
		$cin_unpaid=array();
	if(!empty($cin_array)){
		foreach($cin_array as $row){
		  //  echo $row;die;
		    if(!in_array($row,$result_array)){
		        array_push($cin_unpaid,$row);
		    }
		}
		
	 }     
	 if(!empty($cin_unpaid)){
	        $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
            $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
            $this->db->from('cin_list');
            $this->db->where_in('cin_list.cin',$cin_unpaid);
            $query = $this->db->get();
		    $arrayresult=$query->result_array();
            return $arrayresult;
        
	}
	    
	}
	
	
	public function rivision($product,$class,$status)
	{
	    
        // $this->db->select('*');
	    $this->db->select('cin_list.cin');
		$this->db->from('cin_list');
		$this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
		$this->db->where('cin_result.product_name',$product);
		$this->db->where('cin_result.status','Q');
		if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result_array=$query->result_array();
	//	$result=array();
// 		print_r($result_array);die;
		$cin_array=array();
if(!empty($result_array)){
        foreach($result_array as $row){
           $name1=$row['cin'];
           if(!in_array($cin,$cin_array)){
           array_push($cin_array,$name1);
           }
           
        }
}
        // print_r($cin_array);
// 		die;

if(!empty($cin_array)){
        $this->db->select('cin');
        $this->db->from('new_cart');
        $this->db->where_in('cin', $cin_array);
        $this->db->where('new_cart.revision','Yes');
        $query = $this->db->get();
// 		echo $this->db->last_query();die;
		$result=$query->result_array();
}
// 		print_r($result);die;
//	echo count($result);
	 $cin_array_final=array();
		 //$product_array=array();
        foreach($result as $row){
           $name1=$row['cin'];
        //   if(!in_array($cin,$cin_array)){
           array_push($cin_array_final,$name1);
        //   }
          
        }
//	print_r($cin_array_final);die;
	
	    $cin_paid=array();
	    $cin_unpaid=array();
        foreach($cin_array as $row){
            // echo $row;die;
            if(!in_array($row,$cin_array_final)){
                
            	array_push($cin_unpaid,$row);
            	
            }else{
                // echo $row;die;
                array_push($cin_paid,$row);  
            }
            
        }
        // echo count($cin_array);die;
        // echo count($cin_array);die;
        // print_r($cin_unpaid);die;
        //echo $status;die;


        if($status=='Yes' && !empty($cin_paid) ){
                    $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                    
                    $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                    $this->db->from('cin_list');
                    $this->db->where_in('cin_list.cin', $cin_paid);
                    $query = $this->db->get();
        		    $arrayresult=$query->result_array();
                    return $arrayresult;
                }else{
                    if(!empty($cin_unpaid)){
                        $this->db->select('cin_list.cin,cin_list.student_name,cin_list.school_name,cin_list.school_address1,cin_list.class,cin_list.father_name,cin_list.mother_name,cin_list.stud_phone,cin_list.father_phone,cin_list.mother_phone,cin_list.stud_email,cin_list.father_email,cin_list.mother_email,cin_result.product_name');
                        
                        $this->db->join('cin_result', 'cin_result.cin=cin_list.cin');
                        $this->db->from('cin_list');
                        $this->db->where_in('cin_list.cin',$cin_unpaid);
                        $query = $this->db->get();
            		    $arrayresult=$query->result_array();
                        return $arrayresult;
                        }
                    else{
                        return $arrayresult=array();
                    }
                }
        	
	}
	
	
	public function competition_statewise()
	{
	    $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->where('status','Active');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $arrayresult=$query->result_array();
        return $arrayresult;
	}
	
	
	public function cin_login_activate()
	{
	    $this->db->select('products_cin_parts.product_name as product,products_cin_parts.status as product_status,products_cin_parts.study_material as material_status,products_cin_parts.orientation as orientation_status,products_cin_parts.rivision as revision_status,products_cin_parts.mock_test as mock_test_status,pricing_cin.product_price as product_price,pricing_cin.orientation1 as orientation_price,pricing_cin.study_material as material_price,pricing_cin.revision1 as revision_price,pricing_cin.mock_test as mock_test_price,pricing_cin.clevel as clevel,pricing_cin.period_id as period_id');
        $this->db->join('products_cin_parts','products_cin_parts.product_name=pricing_cin.product');
        $this->db->from('pricing_cin');
        $this->db->where('products_cin_parts.status','Active');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $arrayresult=$query->result_array();
        return $arrayresult;
	}
	
	
	public function insert_pricing_cin($arr)
	{
	    //print_r($arr);die;
	    
	    $this->db->select('*');
        $this->db->from('pricing_cin');
        $this->db->where('product',$arr['product']);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $result=$query->result_array();
	    
	    //$result = $this->db->where_in('pricing_cin', $arr)->row_array();
	    
	    //print_r($result);die;
	    if(empty($result)){$this->db->insert('pricing_cin',$arr);}
	    
	}
	
	
	public function insert_products_cin_parts($arr)
	{
	    //print_r($arr['product_name']);die;
	    $this->db->select('*');
        $this->db->from('products_cin_parts');
        $this->db->where('product_name',$arr['product_name']);
        $query = $this->db->get();
	    $result=$query->result_array();
	    //print_r($result);die;
	    if(empty($result)){$this->db->insert('products_cin_parts',$arr);}
	}
	
	
	public function deactiate($product)
	{
	    //echo $product;die;
	    $this->db->where('product_name', $product);
        $this->db->delete('products_cin_parts');
	    $this->db->where('product', $product);
        $this->db->delete('pricing_cin');
	}
	
	
	public function primary_color_export($class,$franchise,$period,$status,$study_material,$orientation,$mock_test)
	{
	    //echo $period;die;
	    $this->db->select('*');
	   $this->db->from('new_cart');
	   if($class!='All'){
		    $this->db->where('cin_list.class',$class);
		}
		if($franchise!='All'){
		    $this->db->where('cin_list.franchise_code',$franchise);
		}
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    
	    $this->db->where('new_cart.status', $status);
	    $this->db->where('new_cart.study_material', $study_material);
	    $this->db->where('new_cart.orientation', $orientation);
	    $this->db->where('new_cart.mock_test', $mock_test);
	    
	    
	    $this->db->where('new_cart.clevel', '4');
	    $this->db->where('new_cart.period_id', $period);
	    $this->db->group_by('new_cart.cin');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $result=$query->result_array();
	    //print_r($result);die;
        return $result;
	}
	
	
	public function generate_cin_franchise($csv_result_array,$product)
	{
		
		extract($csv_result_array);
		$insert_CIN_OK='no';
		$csv_result_LOG_array=array();
            // 	print_r($csv_result_array);exit;
		    $this->db->select('period_id,period_name,initials');
            $this->db->from('period');
            // 		 $this->db->where('status','Active');
		    $this->db->where('period_id',$csv_result_array['period_id']);
		    $get_STEP1_query   =  $this->db->get();
		    $get_STEP1_result_row=$get_STEP1_query->row_array(); 
		 
		    $period_initials  = $get_STEP1_result_row['initials'];
		   
		    $franchise_code = $area_code;
		      
            $this->db->select('in13');
            $this->db->from('products');
    		$this->db->where('status','Active');
    		$this->db->where('product_name',$product);
    		$get_STEP1_query   =  $this->db->get();
		    $get_STEP1_result_row = $get_STEP1_query->row_array(); 
		 
		    $product_initials  = $get_STEP1_result_row['in13'];
	
	
            $check= $period_initials.$product_initials.$area_code;
            	
            // echo $check;die;
            	
	        $this->db->select('cin');
			$this->db->from('cin_list');
			$this->db->like('cin',$check,'after');
            // $this->db->where('id > 19540');
			$this->db->where('franchise_code',$area_code);
			$this->db->order_by('id','DESC');
	        $get_STEP5_query = $this->db->get();   
			$get_STEP5_result_row= $get_STEP5_query->row_array();
		    //  echo $this->db->last_query();die;
		    $cin = $get_STEP5_result_row['cin'];
		
		
            // echo $cin;exit;
	
        	if(empty($cin)){
        	    $finlcin = $check.'1100000';
        	}else{
        	    $result = str_replace($check, "", $cin);
        	     $result=$result+1;
        	    
        	    $finlcin = $check.$result;
        	  
        	}
              
            // echo $finlcin;die;
              
        		if($finlcin)
        		{
		            $insert_data=array(  
			                      'gender'  => $csv_result_array['gender'] , 
								  'school_id'  => $school_id,
								//   'country_id' =>  '105',
								  'state_id'   => $state_id,
								  'class_id'   =>  $class_id,
								  'class'       =>$class,
								  'category_id' =>  $category_id,
								  'franchise_id' =>  $franchise_id,
								  'franchise_code' => $franchise_code,
								  'cin'        => $finlcin,
								  'password'   =>$finlcin,
								  'student_name'    =>  $stud_name,
								  'class'        =>  	$class  ,
								  'father_name'   => $father_name,
								  'mother_name'   =>  $mother_name,
								  'address1'   =>  $communication_address ,
								  'address2'  =>  	$communication_address1,
								  'period_id' => $csv_result_array['period_id'],
								  'stud_email'      => $email,
								  'stud_phone'  => $mobile_number,
								  'status'      =>  $status
							);
            // 	echo "<pre>";print_r($insert_data);exit;
    		$dataresult = array(
    		    'product_name' =>$product,
    		    //  'clevel'       =>'1',
    		    'period_id'    =>$csv_result_array['period_id'],
    		    'cin'          =>$finlcin,
    		    'grade'       =>'No'
    		    );
	        //  	echo "<pre>";print_r($dataresult);exit;
		    $ins_status=$this->db->insert('cin_result', $dataresult);
            // 	echo "<pre>";print_r($ins_status);exit;
    		 
    		 $ins_status  = $this->db->insert('cin_list', $insert_data);
    		 
    		 if(!$ins_status)
    		 {
    		   $csv_cin_LOG_array  = array($cin,$period_id,$state_id,$school_id,$class_id,$category_id,$first_name,$middle_name, $last_name," Unknown Error : CIN not Generated(Query : ".$update_qry.")");
    		   
    		 }
    		 else
    		 {  
    		   $csv_cin_LOG_array  = array($cin,$period_id,$state_id,$school_id,$class_id,$category_id,$first_name,$middle_name, $last_name," Success : CIN Generated ");
    		   
    		 }
	    }
		
	    return $csv_cin_LOG_array;	
		
	} 

////===================== old =============== ////	
	public function _generate_cin($csv_result_array,$product)
	{
		
		 extract($csv_result_array);
		 //print_r($csv_result_array);die;
		 $insert_CIN_OK='no';
		 $csv_result_LOG_array=array();
	//print_r($period_id);exit;
		 $this->db->select('period_id,period_name,initials');
         $this->db->from('period');
		 //$this->db->where('status','Active');
		 $this->db->where('period_id',$period_id);
		 $get_STEP1_query   =  $this->db->get();
		  $get_STEP1_result_row=$get_STEP1_query->row_array(); 
		 
		   $period_initials  = $get_STEP1_result_row['initials'];
		   $period_id  = $get_STEP1_result_row['period_id'];
		    $fcode = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id,'account_id !'=>''))->row_array();
		
			
		      $franchise_code = $area_code;
			  
			 if($product=='MaRRS International Spelling Bee Junior'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
			      $cin_gen =$period_initials.'SJ'.$area_code; 
			      $pro='SJ';
				    
			 }elseif($product=='MaRRS International Spelling Bee'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		          $cin_gen =$period_initials.'SB'.$area_code;
		          $pro='SB';
				
             }elseif($product=='MaRRS Play 2 Learn'){	
			      $last=substr($cin,7,11);
				  $last2 = $last+1;
		         $cin_gen =$period_initials.'PL'.$area_code;
				  $pro='PL';
		     }elseif($product=='MaRRS Scientia Exertus'){
		         
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'SE'.$area_code;
		         $pro='SE';
		        
		     }elseif($product=='MaRRS International Math Bee'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MB'.$area_code;
		         $pro='MB';
		        
		     }elseif($product=='MaRRS Preschool Bee Math'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PM'.substr($franchise_code,0,2);
		         $pro='PM';
		     }elseif($product=='MaRRS Preschool Bee Science'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PS'.$area_code;
		         $pro='PS';
		     }elseif($product=='MaRRS Preschool Bee English'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PB'.$area_code;
		         $pro='PB';
		     }elseif($product=='MaRRS Preschool Bee Humanities'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PH'.$area_code;
		         $pro='PH';
		     }elseif($product=='MaRRS Word Chase'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'WC'.$area_code;
		         $pro='WC';
		     }elseif($product=='MaRRS Maze of Words'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MW'.$area_code;
		         $pro='MW';
		     }elseif($product=='MaRRS Xpress Math'){
				  $pro='XM';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'XM'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - Science'){
				  $pro='CS';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CS'.$area_code;
		     }
		     elseif($product=='MaRRS Primary Colors - Math'){
				  $pro='CM';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CM'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - English'){
				  $pro='CE';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CE'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - Humanities'){
				  $pro='CH';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CH'.$area_code;
		        
		     }elseif($product=='MaRRS Math Zoom Zoom Challenge'){
				  $pro='MZ';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MZ'.$area_code;
		     }
		     
	//	echo $cin_gen;die;
	$check= $period_initials.$pro.$area_code;
	
	        $this->db->select('cin');
			$this->db->from('cin_list');
			$this->db->like('cin',$check,'after');
			$this->db->where('id > 19540');
			$this->db->where('franchise_code',$area_code);
			$this->db->order_by('id','DESC');
	        $get_STEP5_query = $this->db->get();   
			$get_STEP5_result_row= $get_STEP5_query->row_array();
		//	echo $this->db->last_query();die;
		$cin=$get_STEP5_result_row['cin'];
	//		print_r($cin_gen);echo 'ko'.$cin.'ko';exit;
	
	if(empty($cin)){
	    $fcin = $check.'110000';
	}else{
	    $result = str_replace($check, "", $cin);
	     $result=$result+1;
	    
	    $fcin = $check.$result;
	   // $this->db->from('cin_list');
    //     $this->db->where('cin', $fcin);
    //     $query = $this->db->get();
	   // $get= $query->row_array();
	   // if(!empty($get)){
	        
	   // }
	}
	
	
//echo	$cin.'==='.$fcin;die;




	
		   
		    $this->db->select('MAX(cin) AS cin_number');
			$this->db->from('cin_result');
			$this->db->where('product_name',$product);
		    $this->db->where('period_id',$period_id);
		   $this->db->like('cin',$area_code);
		  //  $this->db->order_by('id','DESC');
			$get_STEP5_query = $this->db->get();   
			$get_STEP5_result_row= $get_STEP5_query->row_array();
			//echo $this->db->last_query();die;
			//print_r($cin_gen);exit;
			$cin= $get_STEP5_result_row['cin_number'];
		//	echo $cin;die;
	       	//print_r($cin);exit;
	       	if($cin==''){
			
			 $last2='10000';
		   
			  $finalcin = $cin_gen.$last2;
			 
			 
            }else{
            echo $last1 =substr($cin, -5);
                $last2= $last1+1;
		   
			  $finalcin = $cin_gen.$last2;
		
         }
	       
	      //echo $finalcin;die;
	      
		  
	       
	       
	       
	       
	       $insert_data=array(  
			                      'period_id'  => $period_id , 
								  'school_id'  => $school_id,
								  //'country_id' =>  $country_id,
								  'state_id'   => $state_id,
								  'class_id'   =>  $class_id,
								  'class'      =>$class,
								  'category_id' =>  $category_id,
								  'franchise_id' =>  $franchise_id,
								  'franchise_code' => $area_code,
								  'cin'        => $fcin,
								  'password'   =>$fcin,
								  'student_name'    =>  $stud_name,
								 // 'gender'        =>  	$gender  ,
								  'father_name'   => $father_name,
								  'mother_name'   =>  $mother_name,
								  'address1'   =>  $communication_address ,
								  'address2'  =>  	$communication_address1,
								  //'pincode' => $pincode,
								  'stud_email'      => $email,
								  'stud_phone'  => $mobile_number
								  //'land_phone'      =>  $land_phone
							);
							
		  $dataresult = array(
		      'product_name' =>$product,
		      'clevel'       =>'1',
		      'period_id'    =>$period_id,
		      'cin'          =>$fcin,
		      'grade'        =>'No'
		      
		      );
		$this->db->insert('cin_result', $dataresult);
		//echo "<pre>";print_r($insert_data);exit;
		 $ins_status  = $this->db->insert('cin_list', $insert_data);
		 if(!$ins_status)
		 {
		   $csv_cin_LOG_array  = array($cin,$period_id,$state_id,$school_id,$class_id,$category_id,$first_name,$middle_name, $last_name," Unknown Error : CIN not Generated(Query : ".$update_qry.")");
		   
		 }
		 else
		 {  
		   $csv_cin_LOG_array  = array($cin,$period_id,$state_id,$school_id,$class_id,$category_id,$first_name,$middle_name, $last_name," Success : CIN Generated ");
		   
		 }
	   
		
	  return $csv_cin_LOG_array;	
		
	} 
	
///================== new ================ ////
    public function generate_cin($csv_result_array,$product)
	{
		
		 extract($csv_result_array);
		 
 		 //print_r($csv_result_array);		 echo $product.'ok';die;
		 $insert_CIN_OK='no';
		 $csv_result_LOG_array=array();
	//print_r($period_id);exit;
	
	    $result_status='';
	
		 $this->db->select('*');
         $this->db->from('product_class_applicable');
		 $this->db->where('product_name',$product);
// 		 $this->db->where('period_id',$period_id);
		 
		 $this->db->where('category_id',$class_id);
		 $get_STEP1_query   =  $this->db->get();
// 		 echo $this->db->last_query();die;
		  $get=$get_STEP1_query->row_array();	
	
 	//print_r($get);die;
	
	if(!empty($get)){
	   // echo $product;die;
		 $this->db->select('period_id,period_name,initials');
         $this->db->from('period');
		 $this->db->where('period_id',$period_id);
		 //$this->db->where('period_id',$period_id);
		 $get_STEP1_query   =  $this->db->get();
		  $get_STEP1_result_row=$get_STEP1_query->row_array(); 
		 
		   $period_initials  = $get_STEP1_result_row['initials'];

		    $fcode = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row_array();
		   $nationalf=$fcode['franchise_type'];
		      $franchise_code = $area_code;
			 
			 if($product=='MaRRS International Spelling Bee Junior'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
			      $cin_gen =$period_initials.'SJ'.$area_code; 
			      $pro='SJ';
				    
			 }elseif($product=='MaRRS International Spelling Bee'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		          $cin_gen =$period_initials.'SB'.$area_code;
		          $pro='SB';
				
             }elseif($product=='MaRRS Play 2 Learn'){	
			      $last=substr($cin,7,11);
				  $last2 = $last+1;
		         $cin_gen =$period_initials.'PL'.$area_code;
				  $pro='PL';
		     }elseif($product=='MaRRS Scientia Exertus'){
		         
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'SE'.$area_code;
		         $pro='SE';
		        
		     }elseif($product=='MaRRS International Math Bee'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MB'.$area_code;
		         $pro='MB';
		        
		     }elseif($product=='MaRRS Preschool Bee Math'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PM'.substr($franchise_code,0,2);
		         $pro='PM';
		     }elseif($product=='MaRRS Preschool Bee Science'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PS'.$area_code;
		         $pro='PS';
		     }elseif($product=='MaRRS Preschool Bee English'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PB'.$area_code;
		         $pro='PB';
		     }elseif($product=='MaRRS Preschool Bee Humanities'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PH'.$area_code;
		         $pro='PH';
		     }elseif($product=='MaRRS Word Chase'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'WC'.$area_code;
		         $pro='WC';
		     }elseif($product=='MaRRS Maze of Words'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MW'.$area_code;
		         $pro='MW';
		     }elseif($product=='MaRRS Xpress Math'){
				  $pro='XM';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'XM'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - Science'){
				  $pro='CS';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CS'.$area_code;
		     }
		     elseif($product=='MaRRS Primary Colors - Math'){
				  $pro='CM';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CM'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - English'){
				  $pro='CE';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CE'.$area_code;
		        
		     }elseif($product=='MaRRS Primary Colors - Humanities'){
				  $pro='CH';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CH'.$area_code;
		        
		     }elseif($product=='MaRRS Math Zoom Zoom Challenge'){
				  $pro='MZ';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MZ'.$area_code;
		     }elseif($product=='Lunar Skill Test'){
		         $pro='LU';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'LU'.$area_code;
		     }elseif($product=='Lunar Skill Test'){
		         $pro='LU';
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'LU'.$area_code;
		     }
	         if($nationalf=='NF'){
			   $check= $period_initials.$pro.'NF'.$area_code;   
			  }else{
		     $check= $period_initials.$pro.$area_code;
			  }
	        $this->db->select('cin');
	        if($product=='Lunar Skill Test'){
	            $this->db->from('cin_list');
	        }else{     
			    $this->db->from('cin_list');
	        }
			$this->db->like('cin',$check,'after');
			$this->db->order_by('id','DESC');
	        $get_STEP5_query = $this->db->get();  
	       // echo $this->db->last_query();die;
			$get_STEP5_result_row= $get_STEP5_query->result_array();
// 			print_r($get_STEP5_result_row);die;

			$cin_array=array();
			foreach($get_STEP5_result_row as $row){
			   $cin= $row['cin'];
			   $outputString = str_replace($check, "", $cin);
			   array_push($cin_array,$outputString);
			}
// 			print_r($cin_array);die;
			$maxNumber = max($cin_array);
// 			echo $maxNumber;die;
		
	if(empty($cin_array)){
	    $fcin = $check.'110000';
	}else{
	   // $result = str_replace($check, "", $cin);
	     $result=$maxNumber+1;
	    
	    $fcin = $check.$result;
	   
	}
	
	
 //echo	$cin.'==='.$fcin;die;




	
		   
		    $this->db->select('MAX(cin) AS cin_number');
			$this->db->from('cin_result');
			$this->db->where('product_name',$product);
		    $this->db->where('period_id',$period_id);
		   $this->db->like('cin',$area_code);
		  //  $this->db->order_by('id','DESC');
			$get_STEP5_query = $this->db->get();   
			$get_STEP5_result_row= $get_STEP5_query->row_array();
			//echo $this->db->last_query();die;
			//print_r($cin_gen);exit;
			$cin= $get_STEP5_result_row['cin_number'];
		//	echo $cin;die;
	       //	print_r($cin);exit;
	       	if($cin==''){
			
			 $last2='10000';
		   
			  $finalcin = $cin_gen.$last2;
			 
			 
            }else{
             $last1 =substr($cin, -5);
                $last2= $last1+1;
		   
			  $finalcin = $cin_gen.$last2;
		
         }
	     // print_r($csv_result_array) ;
	      //echo $stud_name;die;
	      
		  
	       
	       
	       
	       
	       $insert_data = array(  
			                      'period_id'  => $period_id , 
								  'school_id'  => $school_id,
								  //'country_id' =>  $country_id,
								  'state_id'   => $state_id,
								  'class_id'   =>  $class_id,
								  'class'      =>$class,
								  'category_id' =>  $class_id,
								  'franchise_id' =>  $franchise_id,
								  'franchise_code' => $area_code,
								  'cin'        => $fcin,
								  'password'   => $fcin,
								  'student_name'    =>  $stud_name,
								 // 'gender'        =>  	$gender  ,
								  'father_name'   => $father_name,
								  'mother_name'   =>  $mother_name,
								  'subject'   =>  $subject ,
								  'series'  =>  	$series,
								  'type' => $type,
								  'stud_email'      => $email,
								  'stud_phone'  => $mobile_number,
								  'gender'      =>  $gender,
								  'status'=>'Active'
							);
							
		 
		$level = $this->db->get_where('competition_level_byproduct',array('product_name' =>$product))->row_array();
			$lev=$level['level_id'];		
			
			
		  $dataresult = array(
		      'product_name' =>$product,
		      'clevel'       =>$lev,
		      'period_id'    =>$period_id,
		      'cin'          =>$fcin,
		      'grade'        =>'No'
		      
		      );
		//print_r($dataresult);die;
		// echo $ins_status;die;
		 $result_status='Yes';
		 
	}else{
	    echo 'ok';die;
	    $result_status='No';
	}	 
	
	if($result_status=='Yes'){	 
	   // print_r($dataresult);die;
	    
	    $this->db->insert('cin_result', $dataresult);
	//	echo "<pre>";print_r($insert_data);exit;
	if($product=='Lunar Skill Test'){
	    $ins_status  = $this->db->insert('cin_list', $insert_data);
	}else{
	    $ins_status  = $this->db->insert('cin_list', $insert_data);
	}    
		 
		  if(!$ins_status)
		 {
		   $csv_cin_LOG_array  = array($fcin,$stud_name,$class,$period_id,$product,$school_id," Unknown Error : CIN not Generated(Query : ".$update_qry.")");
		   
		 }
		 else
		 {  
		   $csv_cin_LOG_array  = array($fcin,$stud_name,$class,$period_id,$product,$school_id," Success : CIN Generated ");
		   
		 }
	}
	if($result_status=='No'){
	    //echo 'ok';die;
	      $csv_cin_LOG_array  = array('',$stud_name,$class,$period_id,$product,$school_id," Class ID Error : Class is not allowed for this product.");
	
	}
		
	  return $csv_cin_LOG_array;	
		
	} 


/////================ ////
	
	public function extract_cin_student($para)
	{
	    //echo 'ok';
	    //print_r($_POST['product');die;
	    $product=$para['product'];
	    $class=$para['class'];
	    $level=$para['level'];
	    $state_id=$para['state'];
	    $school=$para['school'];
	    $area=$para['area'];
	    //echo $school;die;
	    
	    $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*,states.state_subdivision_name');
        $this->db->from('new_cart');
        $this->db->join('cin_list', 'cin_list.cin = new_cart.cin');
        $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = new_cart.clevel');
        $this->db->join('states', 'states.state_subdivision_id = cin_list.state_id');
        // $this->db->where('competition_level_byproduct.product_name',$product);
        if($class!=''){
		    $this->db->where('cin_list.class',$class);
		}
        $this->db->where('new_cart.product_name', $product);
        $this->db->where('new_cart.period_id', '12');
        $this->db->where('new_cart.status', 'Paid');
        if($product=='MaRRS International Spelling Bee' && $level=='3'){
	        $this->db->where('new_cart.clevel',$level-1);
	    }else{
	        $this->db->where('new_cart.clevel',$level);
	    }
        //$this->db->where('cin_list.state_id', $state_id);
         if($state_id!='All' && $state_id!=''){
           $this->db->where('cin_list.state_id',$state_id);
         }
        if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
        $this->db->group_by('cin_list.cin');
        
        $query = $this->db->get();
        $result = $query->result_array();
//echo $this->db->last_query();die;
	        return $result;
	  
	}
	
	 // ========================= //
        
    public function extract_orientation_student($para)
    {
	    //echo 'ok';
	    //print_r($_POST['product');die;
	    $product=$para['product'];
	    $period='12';
	    $class=$para['class'];
	    $level=$para['level'];
	    $status=$para['status'];
	    $state_id=$para['state'];
	    $area=$para['area'];
	    $school=$para['school'];
	   // echo $class;die;
	    
	    $this->db->select('new_cart.*,cin_list.*,states.state_subdivision_name,competition_level_byproduct.level_name');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = new_cart.clevel');
	    $this->db->join('states','cin_list.state_id=states.state_subdivision_id');
	    if($class!=''){
		    $this->db->where('cin_list.class',$class);
		}
        $this->db->where('new_cart.product_name', $product);
        $this->db->where('new_cart.period_id', '12');
		
		if($status=='A'){
	    $this->db->where('new_cart.orientation', 'Yes');
		}
		if($status=='B'){
	    $this->db->where('new_cart.orientation_b', 'Yes');
		}
		if($status=='C'){
	    $this->db->where('new_cart.orientation_c', 'Yes');
		}
		if($product=='MaRRS International Spelling Bee' && $level=='3'){
	        $this->db->where('new_cart.clevel',$level-1);
	    }else{
	        $this->db->where('new_cart.clevel',$level);
	    }
        $this->db->where('cin_list.state_id', $state_id);
        if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
        $this->db->group_by('cin_list.cin');
        
        $query = $this->db->get();
       // echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
	       return $result;
	 
    }  
    
    
    public function extract_mock_student($para)
    {
	    //echo 'ok';
	    //print_r($_POST);die;
	    $product=$para['product'];
	    $period='12';
	    $class=$para['class'];
	    $level=$para['level'];
	    $status=$para['status'];
	    $state_id=$para['state'];
	    $school=$para['sch'];
	    $area=$para['are'];
	   // echo $class;die;
	    
	    $this->db->select('new_cart.*,cin_list.*,states.state_subdivision_name,competition_level_byproduct.level_name');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = new_cart.clevel');
	    $this->db->join('states','cin_list.state_id=states.state_subdivision_id');
	    if($class!=''){
		    $this->db->where('cin_list.class',$class);
		}
        $this->db->where('new_cart.product_name', $product);
        $this->db->where('new_cart.period_id', '12');
		
		if($status=='A'){
	    $this->db->where('new_cart.mock_test', 'Yes');
		}
		if($status=='B'){
	    $this->db->where('new_cart.orientation_b', 'Yes');
		}
		
		if($product=='MaRRS International Spelling Bee' && $level=='3'){
	        $this->db->where('new_cart.clevel',$level-1);
	    }else{
	        $this->db->where('new_cart.clevel',$level);
	    }
        $this->db->where('cin_list.state_id', $state_id);
        if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
        $this->db->group_by('cin_list.cin');
        
        $query = $this->db->get();
       // echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
	       return $result;
	 
    }  
    
    
    public function extract_material_student($para)
    {
	    //echo 'ok';
	    //print_r($_POST['product');die;
	    $product=$para['product'];
	    $period='12';
	    $class=$para['class'];
	    $level=$para['level'];
	    $status=$para['status'];
	    $state_id=$para['state'];
	    $school=$para['school'];
	    $area=$para['area'];
	    //echo $school.'ok';die;
	    
	    $this->db->select('new_cart.*,cin_list.*,states.state_subdivision_name,competition_level_byproduct.level_name');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = new_cart.clevel');
	    $this->db->join('states','cin_list.state_id=states.state_subdivision_id');
	    if($class!=''){
		    $this->db->where('cin_list.class',$class);
		}
        $this->db->where('new_cart.product_name', $product);
        $this->db->where('new_cart.period_id', '12');
		
		if($status=='A'){
	    $this->db->where('new_cart.study_material', 'Yes');
		}
		if($status=='B'){
	    $this->db->where('new_cart.study_material_b', 'Yes');
		}
		if($status=='C'){
	    $this->db->where('new_cart.study_material_c', 'Yes');
		}
		
		if($product=='MaRRS International Spelling Bee' && $level=='3'){
	        $this->db->where('new_cart.clevel',$level-1);
	    }else{
	        $this->db->where('new_cart.clevel',$level);
	    }
        $this->db->where('cin_list.state_id', $state_id);
        if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
        $this->db->group_by('cin_list.cin');
        
        $query = $this->db->get();
       // echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
	       return $result;
	 
    }  
    
    
    public function extract_material_student_file($product,$period,$class,$level,$status,$state_id,$school,$area)
    {
    	  //  echo $school.$area;die;
	    $period='12';
	    $this->db->select('*');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
		$this->db->join('states','cin_list.state_id=states.state_subdivision_id');
		$this->db->where('cin_list.state_id', $state_id);
		$this->db->where('new_cart.product_name',$product);
		if($status=='A'){
	    $this->db->where('new_cart.study_material', 'Yes');}
	    if($status=='B'){
	    $this->db->where('new_cart.orientation_b', 'Yes');}
	    if($status=='C'){
	    $this->db->where('new_cart.orientation_c', 'Yes');}
	    if($level>3){$this->db->where('new_cart.clevel',$level);}else{
	    $this->db->where('new_cart.clevel',$level-1);}
	    $this->db->where('new_cart.period_id', $period);
	    $this->db->group_by('new_cart.cin');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
        return $result;
	    
	}
	
    
	public function extract_cin_student_file($product,$period,$class,$level,$status,$state_id,$school,$area)
	{
	    //echo $school;die;
	    $this->db->select('*');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    
	    if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		if( $school!='' and $school!='All'){
		    
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
		$this->db->join('states','cin_list.state_id=states.state_subdivision_id');
		$this->db->where('cin_list.state_id', $state_id);
		if($product!=''){
		$this->db->where('new_cart.product_name',$product);}
	    $this->db->where('new_cart.status', $status);
	    if($level>3){
	        $this->db->where('new_cart.clevel',$level);
	    }else{
	    $this->db->where('new_cart.clevel',$level-1);}
	    $this->db->where('new_cart.period_id', $period);
	    $this->db->group_by('new_cart.cin');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
        return $result;
	    
	}
	
	
	public function extract_orientation_student_file($product,$period,$class,$level,$status,$state_id,$area,$school)
	{
	    $period='12';
	    $this->db->select('*');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
		$this->db->join('states','cin_list.state_id=states.state_subdivision_id');
		$this->db->where('cin_list.state_id', $state_id);
		$this->db->where('new_cart.product_name',$product);
		if($status=='A'){
	    $this->db->where('new_cart.orientation', 'Yes');}
	    if($status=='B'){
	    $this->db->where('new_cart.orientation_b', 'Yes');}
	    if($level>3){$this->db->where('new_cart.clevel',$level);}else{
	    $this->db->where('new_cart.clevel',$level-1);}
	    $this->db->where('new_cart.period_id', $period);
	    $this->db->group_by('new_cart.cin');
        $query = $this->db->get();
        // echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
        return $result;
	    
	}
	
	
	public function extract_mock_student_file($product,$period,$class,$level,$status,$state_id,$school,$area)
	{
	    
	    $this->db->select('*');
	    $this->db->from('new_cart');
	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
	    if($class!='all'){
		    $this->db->where('cin_list.class',$class);
		}
		if($school!='All' and $school!=''){
		    $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		    $this->db->where('cin_list.franchise_code',$area);
		}
		$this->db->join('states','cin_list.state_id=states.state_subdivision_id');
		$this->db->where('cin_list.state_id', $state_id);
		$this->db->where('new_cart.product_name',$product);
		if($status=='1' or $status=='A'){
	    $this->db->where('new_cart.mock_test', 'Yes');}
	    if($status=='2' or $status=='B'){
	    $this->db->where('new_cart.orientation_b', 'Yes');}
	    if($level>3){$this->db->where('new_cart.clevel',$level);}else{
	    $this->db->where('new_cart.clevel',$level-1);}
	    $this->db->where('new_cart.period_id', $period);
	    $this->db->group_by('new_cart.cin');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $result=$query->result_array();
	   // print_r($result);die;
	   
        return $result;
	    
	}
	
	
	public function school_list_fr22($state)
	{
	    $this->db->select('cin_list.school_name');
	    $this->db->from('cin_list');
	    $this->db->join('cin_result','cin_result.cin=cin_list.cin');
		$this->db->like('cin_list.state_id',$state);
	    $this->db->where('cin_list.period_id', '12');
	    $this->db->group_by('cin_list.school_name');
	    $this->db->order_by('cin_list.school_name','ASC');
	   
        $query = $this->db->get();
        //  echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
	
	public function area_list22($state)
	{
	    $this->db->select('*');
	    $this->db->from('areas');
	   // $this->db->join('cin_list','cin_list.state_id=areas.state_id');
	    $this->db->where('areas.state_id',$state);
        $query = $this->db->get();
        //  echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
	
	public function studentreg_list_fr22($school,$class,$level,$product,$check,$state_id,$area)
	{
	    $this->db->select('*');
	    $this->db->from('cin_list');
	    $this->db->join('new_cart','new_cart.cin=cin_list.cin');
		
		if($class!='All Class'){
		     $this->db->where('cin_list.class', $class);
		}
		if($school!='All' and $school!=''){
		     $this->db->where('cin_list.school_name',$school);
		}
		if($area!=''){
		     $this->db->where('cin_list.franchise_code',$area);
		}
		if($level =='3'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level-1);
		}
		elseif($level =='1'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level);
		}
		else{
		     $this->db->where('new_cart.clevel',$level);
		}
		 $this->db->where('new_cart.period_id', '12');
		
	    $this->db->where('new_cart.status', 'Paid');
	    $this->db->where('new_cart.product_name', $product);
	    $this->db->where('cin_list.state_id', $state_id);
	   // $this->db->like('new_cart.cin', $check);
	    
	    $this->db->group_by('cin_list.cin');
	   // $this->db->order_by('cin_list.school_name','ASC');
	   
        $query = $this->db->get();
        //echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
    	
	public function studentori_list_fr22($school,$class,$level,$product,$check,$state_id,$type,$area)
	{
	    $this->db->select('*');
	    $this->db->from('cin_list');
	    $this->db->join('new_cart','new_cart.cin=cin_list.cin');
		if($area!=''){
		     $this->db->where('cin_list.franchise_code', $area);
		}
		if($class!='All Class'){
		     $this->db->where('cin_list.class', $class);
		}
		if($school!='All' and $school!=''){
		     $this->db->where('cin_list.school_name',$school);
		}
		if($level =='3'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level-1);
		}
		elseif($level =='1'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level);
		}
		else{
		     $this->db->where('new_cart.clevel',$level);
		}
		 $this->db->where('new_cart.period_id', '12');
		if($type=='A'){
		 $this->db->where('new_cart.orientation', 'Yes');   
		}
		if($type=='B'){
		 $this->db->where('new_cart.orientation_b', 'Yes');   
		}
		if($type=='C'){
		 $this->db->where('new_cart.orientation_C', 'Yes');   
		}
	    $this->db->where('new_cart.product_name', $product);
	    $this->db->where('cin_list.state_id', $state_id);
	   // $this->db->like('new_cart.cin', $check);
	    
	    $this->db->group_by('cin_list.cin');
	   // $this->db->order_by('cin_list.school_name','ASC');
	   
        $query = $this->db->get();
        // echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
	
	public function studentmoc_list_fr22($school,$class,$level,$product,$check,$state_id,$type)
	{
	    $this->db->select('*');
	    $this->db->from('cin_list');
	    $this->db->join('new_cart','new_cart.cin=cin_list.cin');
		if($area!=''){
		     $this->db->where('cin_list.franchise_code', $area);
		}
		if($class!='All Class'){
		     $this->db->where('cin_list.class', $class);
		}
		if($school!='All' and $school!=''){
		     $this->db->where('cin_list.school_name',$school);
		}
		if($level =='3'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level-1);
		}
		elseif($level =='1'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level);
		}
		else{
		     $this->db->where('new_cart.clevel',$level);
		}
		 $this->db->where('new_cart.period_id', '12');
		if($type=='A'){
		 $this->db->where('new_cart.mock_test', 'Yes');   
		}
		
	    $this->db->where('new_cart.product_name', $product);
	    $this->db->where('cin_list.state_id', $state_id);
	   // $this->db->like('new_cart.cin', $check);
	    
	    $this->db->group_by('cin_list.cin');
	   // $this->db->order_by('cin_list.school_name','ASC');
	   
        $query = $this->db->get();
        // echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
	
	public function studentmat_list_fr22($school,$class,$level,$product,$check,$state_id,$type)
	{
	    $this->db->select('*');
	    $this->db->from('cin_list');
	    $this->db->join('new_cart','new_cart.cin=cin_list.cin');
		if($area!=''){
		     $this->db->where('cin_list.franchise_code', $area);
		}
		if($class!='All Class'){
		     $this->db->where('cin_list.class', $class);
		}
		if($school!='All' and $school!=''){
		     $this->db->where('cin_list.school_name',$school);
		}
		if($level =='3'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level-1);
		}
		elseif($level =='1'){
		    //echo 'ok';
		      $this->db->where('new_cart.clevel',$level);
		}
		else{
		     $this->db->where('new_cart.clevel',$level);
		}
		 $this->db->where('new_cart.period_id', '12');
		if($type=='A'){
		 $this->db->where('new_cart.study_material', 'Yes');   
		}
		if($type=='B'){
		 $this->db->where('new_cart.study_material_b', 'Yes');   
		}
		if($type=='C'){
		 $this->db->where('new_cart.study_material_C', 'Yes');   
		}
	    $this->db->where('new_cart.product_name', $product);
	    $this->db->where('cin_list.state_id', $state_id);
	   // $this->db->like('new_cart.cin', $check);
	    
	    $this->db->group_by('cin_list.cin');
	   // $this->db->order_by('cin_list.school_name','ASC');
	   
        $query = $this->db->get();
        // echo $this->db->last_query();die;
	    $result=$query->result_array();
	    return $result;
	}
	
	
	public function save_csv_result_zoomzoom($csv_result_array)
	{
	    extract($csv_result_array);
        // echo "<pre>";print_r($csv_result_array);exit;
        $insert_result_OK='no';
        $status =  trim($status);
        $period            =  trim($period);
        $level             =  trim($level);
        $product           =  trim($product);
        $prid            =  trim($prid);
        $grade=trim($grade);
        $rank=trim($rank);
        
        
        /*...........................................................*/
         /*STEP 1 : Get STUDENT DATA*/
        /*...........................................................*/
        
                 $this->db->select('cin');
        		 $this->db->from('zoomzoom_to_cin');
        		 $this->db->where('product_name',$product);
        		 $this->db->where('prid',$prid);
        		 $this->db->where('period',$period);
        		 $this->db->where('level_id',$level);
        		 $query = $this->db->get();
         		 //echo $this->db->last_query();die;
        		 $result_array=$query->result_array();
        		 $cin=$result_array[0]['cin'];
        		 //print_r($result_array);die;
        	       if(empty($result_array)){
        	            $insert_result_OK="no";
        		        $csv_result_LOG_array = array($prid,$product,$status," Student : Not Registered for this Product. ");
        	       }
        	       	else
            		{
            		   // echo 'ok';die;
            		   $insert_result_OK="yes";
            		
                	     $this->db->select('*');
                		 $this->db->from('zoomzoom_result');
                		 $this->db->where('product_name',$product);
                		 $this->db->where('clevel',$level);
                		 $this->db->where('cin',$cin);
                		 
                		 $query = $this->db->get();
                		 //echo $this->db->last_query();die;
                		 $result_array=$query->result_array();
                		// echo 'ok';print_r($result_array);die;
        	            if(!empty($result_array)){
            	            $insert_result_OK="no";
            		        $csv_result_LOG_array = array($prid,$product,$status," Error : Already Exist");
        	            }
            	       	else
                		{
                		   $insert_result_OK="yes";
                		}
        }
        /*............................................................................*/
          /*STEP 6 : $insert_result_OK="yes" then insert result into result table*/
        /*..............................................................................*/
        	
        if($insert_result_OK=="yes")
        	 {
        	   $ins_array  = array(	
        	                        'status'      => $status,
        							'grade'    => $grade,
        							'cin'    => $cin,
        							'clevel'    => $level,
        							'marks'    => $marks,
        							'product_name'=>$product,
        						    'rank'=>$rank,
        						    'prid'=>$prid
        		                );
        						
        				//	 echo"<pre>"."inserted array";print_r($ins_array);exit;	
        
        	 			/*---------------------------------------------------------------*/
        				  /* 1) INSERT result in sb_student_result*/	
        				/*---------------------------------------------------------------*/	
        			$ins_status = $this->db->insert('zoomzoom_result',$ins_array);
        			if(!$ins_status)
        			{  $csv_result_LOG_array  = array($prid,$product,$status," Unknown Error : Result not uploaded(Query : ".$update_qry.")");
        			}/*End of if $update_status */
        			else
        			{ $csv_result_LOG_array  = array($prid,$product,$status," Success : Result uploaded "); }/* End of else */
        							
        	 } /* END OF if($insert_result_OK=="yes") */	
        	
        return $csv_result_LOG_array;   
    }
        	
    public function offline_generate_cin($csv_result_array, $product)
{
    extract($csv_result_array);

    $csv_cin_LOG_array = array();
    $result_status = 'No';
  
    // Step 1: is this class_id allowed for this product?
    $this->db->select('*');
    $this->db->from('product_class_applicable');
    $this->db->where('product_name', $product);
    $this->db->where('category_id', $class_id);
    $get = $this->db->get()->row_array();
//print_r($get);die;
    if (empty($get)) {
        // Class not allowed for this product
        $csv_cin_LOG_array = array('', $stud_name, $class, $period_id, $product, $school_id,
            "Class ID Error : Class is not allowed for this product.");
        return $csv_cin_LOG_array;
    }

    // Step 2: period initials
    $period_row = $this->db->select('period_id,period_name,initials')
        ->from('period')
        ->where('period_id', $period_id)
        ->get()->row_array();
    $period_initials = $period_row['initials'] ?? '';
     
    // Step 3: franchise info
    $fcode = $this->db->get_where('franchise', array('franchise_id' => $franchise_id))->row_array();
    $nationalf = $fcode['franchise_type'] ?? '';

    // Step 4: product code map (kept from original — ONLY $pro is actually needed downstream)
    $product_codes = array(
        'MaRRS International Spelling Bee Junior' => 'SJ',
        'MaRRS International Spelling Bee'        => 'SB',
        'MaRRS Play 2 Learn'                      => 'PL',
        'MaRRS Scientia Exertus'                  => 'SE',
        'MaRRS International Math Bee'            => 'MB',
        'MaRRS Preschool Bee Math'                => 'PM',
        'MaRRS Preschool Bee Science'             => 'PS',
        'MaRRS Preschool Bee English'             => 'PB',
        'MaRRS Preschool Bee Humanities'          => 'PH',
        'MaRRS Word Chase'                        => 'WC',
        'MaRRS Maze of Words'                     => 'MW',
        'MaRRS Xpress Math'                       => 'XM',
        'MaRRS Primary Colors - Science'          => 'CS',
        'MaRRS Primary Colors - Math'             => 'CM',
        'MaRRS Primary Colors - English'          => 'CE',
        'MaRRS Primary Colors - Humanities'       => 'CH',
        'MaRRS Math Zoom Zoom Challenge'          => 'MZ',
        'Lunar Skill Test'                        => 'LU',
        'MaRRS Math, English & Science Attainment Test' => 'AT',
    );

    if (!isset($product_codes[$product])) {
        // Unknown product — nothing to generate against
        $csv_cin_LOG_array = array('', $stud_name, $class, $period_id, $product, $school_id,
            "Product Error : No CIN code mapping for this product.");
        return $csv_cin_LOG_array;
    }
    $pro = $product_codes[$product];

    // Step 5: build the prefix used both to search existing CINs and to build the new one
    if ($nationalf == 'NF') {
        $check = $period_initials . $pro . 'NF' . $area_code;
    } else {
        $check = $period_initials . $pro . $area_code;
    }

    // Step 6: find the highest existing numeric suffix for this exact prefix
    // NOTE: uses LIKE 'check%' — if any area_code is a literal prefix of another
    // area_code (e.g. "1" vs "10"), this WILL collide. Confirm this isn't happening
    // for your franchises; if it is, this query needs an exact-length check added.
    $existing = $this->db->select('cin')
        ->from('cin_list')
        ->like('cin', $check, 'after')
        ->order_by('id', 'DESC')
        ->get()->result_array();

    $max_suffix_len = 6; // adjust to match your actual fixed suffix width
    $maxNumber = 0;
    $found = false;
    foreach ($existing as $row) {
        $suffix = substr($row['cin'], strlen($check));
        if ($suffix !== '' && is_numeric($suffix)) {
            $found = true;
            $maxNumber = max($maxNumber, (int) $suffix);
        }
    }

    if (!$found) {
        $fcin = $check . str_pad('110000', $max_suffix_len, '0', STR_PAD_LEFT);
    } else {
        $fcin = $check . str_pad($maxNumber + 1, $max_suffix_len, '0', STR_PAD_LEFT);
    }
    
   

    // Step 7: level lookup
    $level = $this->db->get_where('competition_level_byproduct', array('product_name' => $product))->row_array();
    $lev = $level['level_id'] ?? null;

    $dataresult = array(
        'product_name' => $product,
        'clevel'       => $lev,
        'period_id'    => $period_id,
        'cin'          => $fcin,
        'grade'        => 'No',
        'competition_schedule_id' => $competition_schedule_id,
    );

    $insert_data = array(
        'period_id'      => $period_id,
        'school_id'      => $school_id,
        'state_id'       => $state_id ?? null,
        'class_id'       => $class_id,
        'class'          => $class,
        'category_id'    => $class_id,
        'franchise_id'   => $franchise_id,
        'franchise_code' => $area_code,
        'cin'            => $fcin,
        'password'       => $fcin,
        'student_name'   => $stud_name,
        'father_name'    => $father_name,
        'mother_name'    => $mother_name,
        'state_id'       =>  $state_id,
        // CSV/controller in the original code and were always inserting as blank.
        // Add them back explicitly once you confirm where they should come from.
        'stud_email'     => $email,
        'stud_phone'     => $mobile_number,
        'gender'         => $gender,
        'status'         => 'Active',
        'competition_schedule_id' => $competition_schedule_id,
    );

    $this->db->insert('cin_result', $dataresult);
    $ins_status = $this->db->insert('cin_list', $insert_data);

    if (!$ins_status) {
        $csv_cin_LOG_array = array($fcin, $stud_name, $class, $period_id, $product, $school_id,
            "Unknown Error : CIN not Generated");
    } else {
        $csv_cin_LOG_array = array($fcin, $stud_name, $class, $period_id, $product, $school_id,
            "Success : CIN Generated");
    }

    return $csv_cin_LOG_array;
}    	
    	
} 
?>