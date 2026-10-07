<?php
class SchoolModel extends CI_Model
 {
    function __construct()
	 {
        parent::__construct();
        $this->load->database();
     }
/*  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@     */


    public function save_csv_result($csv_result_array)
    {
        extract($csv_result_array);
        // echo "<pre>";print_r($csv_result_array);exit;
        
        $insert_result_OK='no';
        $result_status     =  trim($status);
        $period            =  trim($period);
        $level             =  trim($level);
        $product_name      =  trim($product_name);
        $status            =  trim($status);
        $rank              =  trim($rank);
        $period            =  trim($period);
        $center            =  trim($center);
        $cin               =  trim($cin);
        $competition_date  =  trim($competition_date);
        $subject           =  trim($subject);
        $performer         =  trim($performer);
        $speller           =  trim($speller);
        $type              =  trim($type);
        $series            =  trim($series);
        
        
        
        /*...........................................................*/
         /*STEP 1 : Get STUDENT DATA*/
        /*...........................................................*/
    
        if($period!=$period)
        {
        	  /*echo "empty ";exit;*/
        	   $insert_result_OK="no";
        	   $csv_result_LOG_array = array($cin,$period,$result," Error : Invalid Period ");
        
        } /* end of IF - STEP1*/
          
        else
        {
    	  /*echo "not empty ";exit;*/
    	 
    	    if($level!=$level)
    	    {
        		/* echo " emptystud_shcode ";exit;*/
        		 $insert_result_OK="no";
        		 $csv_result_LOG_array = array($cin,$period,$level," Error : Competition Level Not Match");
    	    }
    	 
            else
        	{
        	    if($product_name != $product_name)
        	    {
        			 
        		    $insert_result_OK="no";
                    $csv_result_LOG_array = array($cin,$period,$level," Error : Competition Level Not Match");
        		 
        	    }
    	        else{
            	     $this->db->select('*');
            		 $this->db->from('cin_result');
            		 $this->db->where('product_name',$product_name);
            		 $this->db->where('cin',$cin);
            		 $this->db->where('period_id',$period);
            		 $this->db->where('clevel',$level);
            		 $this->db->where('type',$type);
            		 $this->db->where('series',$series);
            		 $this->db->where('subject',$subject);
            		 $query = $this->db->get();
            		 $result_array=$query->result_array();
            		 
            	    if(!empty($result_array)){
    	                $insert_result_OK="no";
    		            $csv_result_LOG_array = array($cin,$period,$subject," Error : Already Exist");
            	    }
                    else
            		{
        		        $insert_result_OK="yes";
        		    }
    	        }
     
            }
    
      }
    /*............................................................................*/
      /*STEP 6 : $insert_result_OK="yes" then insert result into result table*/
    /*..............................................................................*/
    	
    if($insert_result_OK=="yes")
    	 {
    	   $ins_array  = array(	
    	                        'cin'              => $cin,
    							'clevel'           => $level,
    							'period_id'        => $period,
    							'status'           => $status,
    							'product_name'     => $product_name,
    							'grade'            => $grade,
    						    'rank'             => $rank,
    						    'performer'        => $performer,
    						    'speller'          => $speller,
    						    'competition_date' => $competition_date,
                                'subject'          => $subject,
                                'series'           => $series,
                                'type'             => $type,
                                'venue'            => $center
                                
    		                );
    						
    				// 	 echo"<pre>"."inserted array";print_r($ins_array);exit;	
    
    	 			/*---------------------------------------------------------------*/
    				  /* 1) INSERT result in sb_student_result*/	
    				/*---------------------------------------------------------------*/	
    			$ins_status = $this->db->insert('cin_result',$ins_array);
    			if(!$ins_status)
    			{  $csv_result_LOG_array  = array($cin,$period,$status," Unknown Error : Result not uploaded(Query : ".$update_qry.")");
    			}/*End of if $update_status */
    			else
    			{ $csv_result_LOG_array  = array($cin,$period,$status," Success : Result uploaded "); }/* End of else */
    							
    	 } /* END OF if($insert_result_OK=="yes") */	
    	
    	 return $csv_result_LOG_array;
    }


    public function get_product($franchise_id) 
	 {
		//echo $franchise_id;die;
		 $this->db->select('services.*');
		 $this->db->from('services');
		 $this->db->join('franchiseproduct', "franchiseproduct.service_id = services.service_id  AND franchise_id='" . $franchise_id."'");
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }
	 
	 public function extract_student($pararm){
	    // print_r($pararm);die;
	     $this->db->select('*');
        $this->db->from('students');
        $this->db->join('schools', 'schools.school_code = students.school_code');
        $this->db->where('schools.school_id',$pararm['school']);
       // $this->db->where('students.school_code',$school);
        $this->db->where('students.period_id',$pararm['period']);
        if(!empty($pararm['class'])){
            // echo $pararm['class'];die;
            $this->db->join('class', 'class.class_name = students.class');
            $this->db->where('class_id',$pararm['class']);
        }
        if(!empty($pararm['level'])){
            // echo $pararm['class'];die;
            $this->db->join('competition_levels', 'students.level_id = competition_levels.id');
            $this->db->where('competition_levels.id',$pararm['level']);
        }
        $res = $this->db->get();
        //echo $this->db->last_query();die;
       return  $result = $res->result_array();
        //print_r($result = $res->result_array());die;
	 }
	 
	    public function schoolListfran($id)
    {
        
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('franchise_id',$id);
        $res = $this->db->get();
       return  $result = $res->result_array();
    }
	   public function listschool($data) 
    {
		 extract($data);
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('franchise_id',$franchise_id);
		//if(!empty($state_id)){
        //$this->db->where('stateID',$state_id);
		//}
		 
        $res = $this->db->get();
       return  $result = $res->result_array();
    }
	
	
	
       public function getfranchisedata($id)
    {
        
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$id);
        $res = $this->db->get();
       return  $result = $res->row_array();
    } 
    
    
        public function getschoolAccess()
    {
        
        $this->db->select('*');
        $this->db->from('school_new'); 
        //$this->db->where('school_status','Active');
        $res = $this->db->get();
       return  $result = $res->result_array();
       
    }
    public function schoolList_all($status,$franchise)
    {
        $this->db->select('*');
        $this->db->from('schools');
        if($status!=''){
            $this->db->where('school_status',$status);
        }
        
        $this->db->where('franchise_id',$franchise);
        $res = $this->db->get();
       return  $result = $res->result_array();
       
    }
    
    
    public function getschoolList_all($params)
    {
        // print_r($params);die;
        // Extract parameters safely with fallbacks
        $status    = isset($params['status'])    ? trim($params['status'])    : 'All';
        $area_code = isset($params['area_code']) ? trim($params['area_code']) : 'All';
        $franchise = isset($params['franchise']) ? trim($params['franchise']) : 'All';
        $state_id  = isset($params['state_id'])  ? trim($params['state_id'])  : 'All';
        $search    = isset($params['search'])    ? trim($params['search'])    : '';
    
        $this->db->select('school_new.*, states.state_subdivision_name, franchise.franchise_code, franchise.franchise_first_name, franchise.franchise_last_name');
        $this->db->from('school_new');
        $this->db->join('states', 'states.state_subdivision_id = school_new.state', 'left');
        $this->db->join('franchise', 'franchise.franchise_id = school_new.franchise_id', 'left');
    
        // Filters
        if ($status !== 'All' && $status !== '') {
            $this->db->where('school_new.school_status', $status);
        }
    
        if ($franchise !== 'All' && $franchise !== '') {
            $this->db->where('school_new.franchise_id', $franchise);
        }
    
        if ($area_code !== 'All' && $area_code !== '') {
            $this->db->where('school_new.area_code', $area_code);
        }
    
        if ($state_id !== 'All' && $state_id !== '') {
            $this->db->where('school_new.state', $state_id);
        }
    
        // Search Query (School Name or School Code)
        if ($search !== '') {
            
            $this->db->where("(school_new.school_name LIKE '%{$this->db->escape_like_str($search)}%' OR school_new.school_code LIKE '%{$this->db->escape_like_str($search)}%')", null, false);
            
            // $this->db->group_start();
            // $this->db->like('school_new.school_name', $search);
            // // $this->db->or_like('school_new.school_code', $search);
            // $this->db->group_end();
        }
    
        $res = $this->db->get();
        return $res->result_array();
    }
    
    
    public function getschoolList_all_($params)
    {
        print_R($params);die;
        $status=$params['status'];
        $area_code=$params['area_code'];
        $franchise=$params['franchise'];
        $state_id=$params['state_id'];
        $search = $params['search'];
        
        $this->db->select('school_new.*,states.state_subdivision_name,franchise.franchise_code,franchise.franchise_first_name,franchise.franchise_last_name');
        $this->db->from('school_new');
        $this->db->join('states','states.state_subdivision_id=school_new.state');
        $this->db->join('franchise','franchise.franchise_id=school_new.franchise_id');
        if($status!='All'){
            $this->db->where('school_status',$status);
        }
        
        if($franchise!='All' && $franchise!=''){
           
            $this->db->where('school_new.franchise_id',$franchise);
        }
        if($area_code!='All' && $area_code!=''){
            $this->db->where('area_code',$area_code);
        }
        // $this->db->where('state',$state_id);
        if($state_id != 'All' && $state_id != ''){
            $this->db->where('state', $state_id);
        }
        
        if (!empty($search) or $search != '') {
            $this->db->group_start();
            $this->db->like('school_new.school_name', $search);
            $this->db->or_like('school_new.school_code', $search);
            $this->db->group_end();
        }
        
        $res = $this->db->get();
        //echo $this->db->last_query();die;
        return  $result = $res->result_array();
       
    }
    
       public function codeView($id)
    {
       
        $this->db->select('*');
        $this->db->from('price_codegenration');
        $this->db->where('status','Active');
        $this->db->where('period_id >','12');
        $this->db->where('franchise_id',$id);
        $res = $this->db->get();
       return  $result = $res->result_array();
    }
    
    
	 
	   public function schoolAccess($id)
    {
        
        $this->db->select('*');
        $this->db->from('school_new');
        $this->db->where('id',$id);
        $res = $this->db->get();
       return  $result = $res->result_array();
    }
    
    
    
    
	   public function stusentList($id)
    {
        
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('franchise_id',$id);
        $res = $this->db->get();
       return  $result = $res->result_array();
    }
	 
	 
    public function	getaccescode()
    {
         $this->db->select('*');
		 $this->db->from('price_codegenration');
		 $this->db->where('status','Deactive');
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array(); 
    }
	 
	  public function getaccescodeapporved()
    {
         $this->db->select('*');
		 $this->db->from('price_codegenration');
		 $this->db->where('status','Active');
		 $this->db->where('period_id >','12');
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array(); 
    }
	 
	 
     public function productList() {
       
        
		 $this->db->select('*');
		 $this->db->from('products');
		 //$this->db->where('status','Active');
		 $this->db->order_by("product_id", "desc");
	     $res=$this->db->get();
	     
	    return  $result = $res->result_array(); 
    }
   
     public function getfrachiselist() {
       
        
		 $this->db->select('*');
		 $this->db->from('areas');
		 //$this->db->where('status','Active');
		 //$this->db->order_by("product_key", "asc");
	     $res=$this->db->get();
	    return  $result = $res->result_array(); 
	     
		
   }
    public function productListfran($id) {
       
        
		 $this->db->select('*');
		 $this->db->from('product_allotted_fr');
		 $this->db->join('products', 'product_allotted_fr.product_id = products.product_id');
		 $this->db->where('product_allotted_fr.franchise_id',$id);
		 //$this->db->order_by("product_key", "asc");
	     $res=$this->db->get();
	    return  $result = $res->result_array(); 
	     
		
   }
   
   
	
	 
	 public function set_access_code($franchise_id) 
	 {
		//echo $franchise_id;die;
		 $this->db->select('services.*');
		 $this->db->from('services');
		 $this->db->join('franchiseproduct', "franchiseproduct.service_id = services.service_id  AND franchise_id='" . $franchise_id."'");
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }
	 
	 
	 
	 
public function insertdata($data)
{
	//print_r($data);die;
	$this->db->insert('franchiseproduct_details',$data);
    $res="ok";
	return $res;
}

public function insertschooldata($data)
{
	//echo '---';print_r($data);die;
	$this->db->insert('school_new',$data);
    $insertid = $this->db->insert_id();
    $res="ok";
	return $insertid;
}

public function insertpricecode($array)
{
    
    //print_r($array);exit;
    	$this->db->select('MAX(price_code) AS pricecode');
			$this->db->from('price_code');
			$get_STEP5_query      = $this->db->get();
			//echo "<br>". $this->db->last_query(); exit;
			$get_STEP5_result_row     = $get_STEP5_query->row_array();
			   $max_cin=$get_STEP5_result_row['pricecode'];
                $cin_first_half=substr($max_cin,-1);
                
                $i =$cin_first_half+1;
                $price_code = 'PC'.$i;
		 //print_r($price_code);exit;
			   $array1 = array(
					        
					        'product_id' =>$array['product_id'],
					       // 'amount' => $array['amount'],
					        'school_id' =>$array['school_id'],
					        'price_code' =>$price_code,
					        'status' =>'Deactive',
					        //'period_id' =>'7'
					        );
					        $res = $this->db->insert('price_code',$array1);
					        return $res;
		
			
            
	
}

public function get_frcode($franchise_id)
{
	$this->db->select('franchise.*');
	$this->db->from('franchise');
	$this->db->where('franchise_id',$franchise_id);
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}
 public function list_accesscode_School($fr_id){
     
         	$this->db->select('*');
			$this->db->from('schools');
			$this->db->where('school_status','Pending');
			//$this->db->where('productname', $data['productname']);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//$n = $query->num_rows();//echo $n;die;
		    return $query->result_array(); 
     
 }
 public function no_accescode_schools($param){
     
         	$this->db->select('*');
			$this->db->from('schools');
			$this->db->where('school_status','Deactive');
			$this->db->where('school_code','');
			//$this->db->where('productname', $data['productname']);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//$n = $query->num_rows();//echo $n;die;
		    return $query->result_array(); 
     
 }
 

 public function get_numfranchisefiles($data)
	 {
			$this->db->select('*');
			$this->db->from('franchiseproduct_details');
			$this->db->where('franchise_id', $data['franchise_id']);
			$this->db->where('productname', $data['productname']);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//$n = $query->num_rows();//echo $n;die;
		    return $query->num_rows();  
    }/*end function getStudent*/

public function getfranchise($franchise_id)
{
	$this->db->select('*');
	$this->db->from('products');
	$this->db->where('franchise_id', $franchise_id);
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}


public function getfranchisess()
{
	$this->db->select('*');
	$this->db->from('franchiseproduct_details');
	//$this->db->where('franchise_id', $franchise_id);
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}


public function getfranchisedetails($detail_id)
{
	$this->db->select('*');
	$this->db->from('franchiseproduct_details');
	//$this->db->join('school_to_franchise', "school_to_franchise.school_id=schools.school_id");
	$this->db->where('detail_id', $detail_id);
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}

public function insertd($data, $detail_id = '')
     {
         $this->db->where('detail_id', $detail_id);
         $this->db->set('date', 'NOW()', FALSE);
         $r = $this->db->update('franchiseproduct_details', $data);
		 return $r;
    }
	
	
public function getuploadedfile($id) 
	 {
		//echo $id;die;
		 $this->db->select('file,downloads');
		 $this->db->from('franchiseproduct_details');
		 $this->db->where('detail_id', $id);
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }
	 public function getcountries() 
	 {
		//echo $id;die;
		 $this->db->select('*');
		 $this->db->from('countries');
		 $this->db->order_by('country_name','desc');
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }
	 
	 
public function get_franchiseschool($franchise_id) 
	 {
		//echo $franchise_id;die;
		 $this->db->select('*');
		 $this->db->from('schools');
		 $this->db->join('school_to_franchise', "school_to_franchise.school_id=schools.school_id");
		 $this->db->where('school_to_franchise.franchise_id', $franchise_id);
		  
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }

public function getservices()
{
	$this->db->select('*');
	$this->db->from('services');
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}
public function getfranchiselist()
{
	$this->db->select('*');
	$this->db->from('franchise');
	$query = $this->db->get(); //echo $this->db->last_query();
	return $query->result_array();
}

public function insertproduct_franchise($data)
{
	//print_r($data);die;
	$this->db->where('service_id', $data['service_id']);
	$this->db->where('franchise_id', $data['franchise_id']);
    $this->db->delete('franchiseproduct');
	
	
	$this->db->insert('franchiseproduct',$data);
    $res="ok";
	return $res;
}


public function get_franchiseservice($franchise_id) 
	 {
		//echo $franchise_id;die;
		 $this->db->select('franchiseproduct.*,services.service_name');
		 $this->db->from('franchiseproduct');
		  $this->db->join('services', "services.service_id=franchiseproduct.service_id");
		 $this->db->where('franchiseproduct.franchise_id', $franchise_id);
		  
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }

public function get_franchiseschools($param) 
	 {
		extract($param);
		//echo $franchise_id;die;
		//print_r($param);die;
		
		$productid = $param['productid'];
		$franchiseid = $param['franchiseid'];
		
		 $this->db->select('schools.*,states.state_subdivision_name');
		 $this->db->from('schools');
		 $this->db->join('school_to_franchise', "school_to_franchise.school_id=schools.school_id");
		 $this->db->join('states', "states.state_subdivision_id=schools.stateID");
		 $this->db->where('school_to_franchise.service_id', $productid);
		  $this->db->where('school_to_franchise.franchise_id', $franchiseid);
		 $query = $this->db->get(); //echo $this->db->last_query();
	     return $query->result_array();
					 
	 }
	 
public function getfranchise_login()
{
	$this->db->select('username,password');
	$this->db->from('franchise');
	$query = $this->db->get(); //echo $this->db->last_query();
	//$arr = $query->result_array();
    //print_r($arr[0]['password']);die;
	return $query->result_array();
}

public function bulk_upload($csv_result_array,$price_code)
{
    // echo $price_code;die;
    extract($csv_result_array);
		 $insert_CIN_OK='no';
		 $csv_result_LOG_array=array();
// 	print_r($csv_result_array);die;
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
	   /*STEP1 : check period_id is valid */
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
	    if(empty($price_code)){
	       // $insert_result_OK="no";
	       // $csv_cin_LOG_array = array($school_name,$school_address," Error : Invalid Price Code");
	    }
	    else{
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
		 
		 if(empty($school_pincode))
	    {
		  //echo $school_pincode;die;
		   $insert_result_OK="no";
		   $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty Pin Code");
		
	    }/* end if */
		 
	    else {
			 
		    if(empty($country_id))
    	    {
    		  $insert_result_OK="no";
    		  $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty Country Name");
    	    }/* end if */
    		 
    		else{ 
        		 if(empty($stateID))
        	    {
        		  $insert_result_OK="no";
        		 $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty State Name");
        	    }/* end if */
    	
		        else{
			  
            		 if(empty($school_district))
            	    {
            		  $insert_result_OK="no";
            		  $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty District Name");
            	    }/* end if */
        		 
		 
            		else{ 
            	 
            			if(empty($school_city))
            	        {
            				$insert_result_OK="no";
            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School City");
            			}
            			else
            			{
            				if(empty($school_name))
            	            {
            				$insert_result_OK="no";
            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Name");
            			    }
                			else
                			{
                				
                			 //   if(empty($affiliation_number))
                	   //         {
                				// $insert_result_OK="no";
                		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty Affiliation Number");
                			 //   }
                    // 			else
                    // 			{
                    				
                    			    if(empty($school_phone))
                    	            {
                    				$insert_result_OK="no";
                    		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Phone");
                    			    }
                        			else
                        			{
                        				
                            			 if(empty($school_mobile))
                            	         {
                            				$insert_result_OK="no";
                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Mobile");
                            			 }
                            			 else
                            			 {
                            				
                                			 if(empty($school_address))
                                	         {
                                				$insert_result_OK="no";
                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Address");
                                			 }
                                			 else
                                			 {
                                			    if(empty($principal_first_name))
                                	            {
                                				$insert_result_OK="no";
                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Principal First Name");
                                			    }
                                    			else
                                    			{
                                    				// if(empty($principal_last_name))
                                    	   //         {
                                    				// $insert_result_OK="no";
                                    		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Principal Last Name");
                                    			 //   }
                                        // 			else
                                        // 			{
                                        				// if(empty($school_email))
                                        	   //         {
                                        				// $insert_result_OK="no";
                                        		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Email");
                                        			 //   }
                                            // 			else
                                            // 			{
                                            				
                                            			    if(empty($school_board))
                                            	            {
                                            				$insert_result_OK="no";
                                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Board");
                                            			    }
                                                			else
                                                			{
                                                			    if(empty($school_medium))
                                                	            {
                                                				$insert_result_OK="no";
                                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Medium");
                                                			    }
                                                    			else
                                                    			{
                                                    				if(empty($school_cordinator_first_name))
                                                    	            {
                                                    				$insert_result_OK="no";
                                                    		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator First Name");
                                                    			    }
                                                        			else
                                                        			{
                                                        				if(empty($school_cordinator_last_name))
                                                        	             {
                                                        				$insert_result_OK="no";
                                                        		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Last Name");
                                                        			    }
                                                            			else
                                                            			{
                                                            				if(empty($school_cordiantor_email))
                                                            	            {
                                                            				$insert_result_OK="no";
                                                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Email");
                                                            			    }
                                                                			else
                                                                			{
                                                                				// if(empty($sc_cordinator_phone))
                                                                	   //         {
                                                                				// $insert_result_OK="no";
                                                                		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Phone");
                                                                    // 			}
                                                                    // 			else
                                                                    // 			{
                                                                    				$insert_result_OK="yes";
                                                                    			}
			   
		}	}}}}}}} }}}}} } }
    
//}}}}
	   
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
	   /*STEP6 : Insert student data with CIN to 'students_to_cin table
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
		if($insert_result_OK=="yes")
		{
		  //  $username='MRS'.$principal_first_name;
		    $sch=substr($school_name,1,4);
		    $res = preg_replace('/[0-9\@\.\;\" "]+/', '', $sch);
			$user= 'MRS'.$res.rand(10,1000);
			
			$this->db->select('*');
            $this->db->from('schools');
            $this->db->like('username', $user);
            $query=$this->db->get();
            // print_r($query->result().'ok');
            if(!empty($query->result())){
                $user= 'MRS'.$sch.rand(10,1000);
            }
		    $insert_data=array(  
			                     'school_pincode'  => $school_pincode , 
								  'country_id'  => $country_id,
								  'stateID' =>  $stateID,
								  'school_district'   => $school_district,
								  'school_city'   =>  $school_city,
								  'school_name' =>  $school_name,
								  'affiliation_number' =>  $affiliation_number,
								  'school_phone'    =>  $school_phone,
								  'school_mobile'   =>  $school_mobile ,
								  'school_address'     =>  $school_address ,
								  
								  'principal_first_name'     =>	$principal_first_name,
								  'principal_last_name'   => $principal_last_name,
								  'school_email'  =>  $school_email,
								  'school_board'  =>  $school_board ,
								  'school_medium'   =>  $school_medium,
								  'school_coordinator_first_name'  =>  $school_cordinator_first_name,
								  'school_coordinator_last_name'  =>  $school_cordinator_last_name,
								  'school_coordinator_email'   =>  $school_cordiantor_email ,
								  'sh_coordinator_phone'  =>  	$sc_cordinator_phone,
								  'franchise_id' => $franchise_id,
								  'school_status'=> 'Deactive',
								  'username'=>$user,
								  'password'=>$user,
								  'marrs_coordinator_first_name'=>$marrs_coordinator_first_name,
								  'marrs_coordinator_last_name'=>$marrs_coordinator_last_name,
								  'marrs_coordinator_email'=>$marrs_coordinator_email,
								  'marrs_coordinator_phone'=>$marrs_coordinator_phone
								//   'franchise_id'=>$franchise
							);
		
                    				    	
        
		
//  		echo "<pre>";print_r($insert_data);exit;
           $ins_status = $this->db->insert('schools', $insert_data);
        $insert_id = $this->db->insert_id('school_id');
        //echo $insert_id;die;
        
//         $this->db->select('product_id');
//         $this->db->from('products');
//         $this->db->where('status','Active');
//         $res = $this->db->get();
//         $result = $res->result_array();
        
//         foreach($result as $valu){
// 		 $csv_filter_code = array(
// 		    'price_code'=>'PC22AA1-250',
//                     				'period_id'=>$period,
//                     				'product_id'=>$valu['product_id'],
//                     				'franchise_id'=>$franchise_id,
//                     				'school_id'=>$insert_id
//                     				);
//          $ins_status= $this->db->insert('filter', $csv_filter_code);    
         
// 	    $csv_price_code = array(
// 	        'price_code'=>'PC22AA1-250',
//                     				'period_id'=>$period,
//                     				'product_id'=>$valu['product_id'],
                    			
//                     				'school_id'=>$insert_id,
//                     				'status'=>'Active'
//                     				);
		 
// 		 $this->db->insert('price_code', $csv_price_code); 
//       }
	        if(!$insert_data)
		    {
		        
		        $csv_cin_LOG_array  = array($school_name,$school_address," Unknown Error : School not Generated(Query : ".$update_qry.")");
		   
		    }/*End of if $update_status */
		    else
		    {  
		        $csv_cin_LOG_array  = array($school_name,$school_address," Success : School Added ");
		   
		    }/* End of else */
	 }
		
	//echo "<pre>";print_r($csv_cin_LOG_array);exit;
		
	  return $csv_cin_LOG_array;	
}

public function bulk_upload_new($csv_result_array){
        // echo $price_code;die;
    extract($csv_result_array);
		 $insert_CIN_OK='no';
		 $csv_result_LOG_array=array();
// 	print_r($csv_result_array);die;
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
	   /*STEP1 : check period_id is valid */
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/

			  
            		 if(empty($district))
            	    {
            		  $insert_result_OK="no";
            		  $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty District Name");
            	    }/* end if */
        		 
		 
            		else{ 
            	 
            			if(empty($city))
            	        {
            				$insert_result_OK="no";
            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School City");
            			}
            			else
            			{
            				if(empty($school_name))
            	            {
            				$insert_result_OK="no";
            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Name");
            			    }
                			else
                			{
                				
                			 //   if(empty($affiliation_number))
                	   //         {
                				// $insert_result_OK="no";
                		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty Affiliation Number");
                			 //   }
                    // 			else
                    // 			{
                    				
                    			    if(empty($school_phone))
                    	            {
                    				$insert_result_OK="no";
                    		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Phone");
                    			    }
                        			else
                        			{
                        				
                            			 if(empty($school_mobile))
                            	         {
                            				$insert_result_OK="no";
                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Mobile");
                            			 }
                            			 else
                            			 {
                            				
                                			 if(empty($school_address))
                                	         {
                                				$insert_result_OK="no";
                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Address");
                                			 }
                                			 else
                                			 {
                                			    if(empty($school_principal_name))
                                	            {
                                				$insert_result_OK="no";
                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Principal First Name");
                                			    }
                                    			else
                                    			{
                                    				// if(empty($principal_last_name))
                                    	   //         {
                                    				// $insert_result_OK="no";
                                    		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Principal Last Name");
                                    			 //   }
                                        // 			else
                                        // 			{
                                        				// if(empty($school_email))
                                        	   //         {
                                        				// $insert_result_OK="no";
                                        		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Email");
                                        			 //   }
                                            // 			else
                                            // 			{
                                            				
                                            			    if(empty($school_board))
                                            	            {
                                            				$insert_result_OK="no";
                                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Board");
                                            			    }
                                                			else
                                                			{
                                                			    if(empty($school_medium))
                                                	            {
                                                				$insert_result_OK="no";
                                                		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Medium");
                                                			    }
                                                    			else
                                                    			{
                                                    				if(empty($school_coordinator_name))
                                                    	            {
                                                    				$insert_result_OK="no";
                                                    		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator First Name");
                                                    			    }
                                                        			else
                                                        			{
                                                        				if(empty($coordinator_phone))
                                                        	             {
                                                        				$insert_result_OK="no";
                                                        		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Phone");
                                                        			    }
                                                            			else
                                                            			{
                                                            				if(empty($school_coordinator_email))
                                                            	            {
                                                            				$insert_result_OK="no";
                                                            		        $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Email");
                                                            			    }
                                                                			else
                                                                			{
                                                                				// if(empty($sc_cordinator_phone))
                                                                	   //         {
                                                                				// $insert_result_OK="no";
                                                                		  //      $csv_cin_LOG_array = array($school_name,$school_address," Error : Empty School Cordinator Phone");
                                                                    // 			}
                                                                    // 			else
                                                                    // 			{
                                                                    				$insert_result_OK="yes";
                                                                    			}
			   
		}	}}}}}}} }}}
    
// }} } }
    
//}}}}
	   
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
	   /*STEP6 : Insert student data with CIN to 'students_to_cin table
	 /*----------------------------------------------------------------------------------------------------------------------------------------------*/
		if($insert_result_OK=="yes")
		{
		    
		   $this->db->select('school_code');
        	   	$this->db->from('school_new');
                $this->db->where('area_code',$_POST['area_code']);
                $this->db->order_by('id','DESC');
                $query = $this->db->get(); 
                $que = $query->row(); 
                
                if(empty($que->school_code)){
                    $school_code=$_POST['area_code'].'S'.'1000';
                }else{
                    // echo 'yes';
                    $trimmed = str_replace($_POST['area_code'].'S', '', $que->school_code) ;
                    $num=$trimmed+1;
                    $school_code= $_POST['area_code'].'S'.$num;
                }
		                                        $insert_data=array(   
		                                                              'pin'                   =>  $pin , 
                    				                                  'school_code'           =>  $school_code,
                    												  'country'               =>  $country,
                    												  'state'                 =>  $state,
                    												  'district'              =>  $district,
                    												  'city'                  =>  $city,
                    												  'school_name'           =>  $school_name,
                    												  'affiliation_number'    =>  $affiliation_number,
                    												  'school_phone'          =>  $school_phone,
                    												  'school_mobile'         =>  $school_mobile ,
                    												  'school_address'        =>  $school_address,
                    												  'school_principal_name' =>  $school_principal_name,
                    												  'school_email'          =>  $school_email,
                    												  'school_board'          =>  $school_board,
                    												  'school_medium'         =>  $school_medium,
                    												  'school_coordinator_name'=> $school_coordinator_name ,
                    												  'school_coordinator_email'=>$school_coordinator_email ,
                    												  'coordinator_phone'     =>  $coordinator_phone,
                    												  'franchise_id'          =>  $franchise_id,
                    												  'area_code'             =>  $area_code,
								                                      'principal_email'       =>  $principal_email,
								                                      'principal_phone'       =>  $principal_phone,
								                                      'password'              =>  $school_code,
								                                      'school_status'         =>  'Inactive'
                    											);
                    					
	
 		//echo "<pre>";print_r($insert_data);exit;
           $ins_status = $this->db->insert('school_new', $insert_data);
        $insert_id = $this->db->insert_id('id');
      
	        if(!$insert_data)
		    {
		        
		        $csv_cin_LOG_array  = array($school_name,$school_address," Unknown Error : School not Generated(Query : ".$update_qry.")");
		   
		    }/*End of if $update_status */
		    else
		    {  
		        $csv_cin_LOG_array  = array($school_name,$school_address," Success : School Added ");
		   
		    }/* End of else */
	 }
		
	//echo "<pre>";print_r($csv_cin_LOG_array);exit;
		
	  return $csv_cin_LOG_array;
}


 public function assignschool($id)
 {
     $this->db->select('product_allotted_fr.franchise_id,products.product_name,products.status,products.product_id');
     $this->db->from('product_allotted_fr');
     $this->db->join('products', 'products.product_id = product_allotted_fr.product_id');
     $this->db->where('franchise_id',$id);
     $res = $this->db->get();
     $result = $res->result();
     return $result;
 }
     
 public function pricecodelavel($id)
 {
     $this->db->select('price_code,level,status');
     $this->db->from('price_codegenration');
     $this->db->where('franchise_id',$id);
     $res = $this->db->get();
     $result = $res->result();
     return $result;
 }

 public function school_level($id)
 {
     $this->db->select('*');
     $this->db->from('schools');
     $this->db->where('franchise_id',$id);
     $res = $this->db->get();
     $result = $res->result();
     return $result;
 }
 
 public function competition_list_2021($product,$class,$status,$period,$level,$state_id){
	    
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
	
	
 
 
 
 
 
 
 
}
?>