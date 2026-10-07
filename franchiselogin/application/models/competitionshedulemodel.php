<?php
class competitionshedulemodel extends CI_Model
 {
    function __construct()
     {
        parent::__construct();
        $this->load->database();
     }	 
/* ---------------------------------------------------------------------- */	

// FUNCTION NO:- 1   -   SELECT ENUM STATUS OF COMPETITION SCHEDULE	
	
    // public function list_student_product($data)     
    // {
        
    //     $this->db->select('cin_list.student_name,cin_list.cin, cin_list.franchise_code, cin_list.address1, cin_list.stud_email, cin_list.stud_phone, cin_list.class, cin_list.father_name, cin_list.mother_name, cin_result.grade, cin_result.rank, cin_result.status, cin_result.marks,school_new.school_name');
    //     $this->db->from('cin_result');
    //     $this->db->join('cin_list', 'cin_list.cin = cin_result.cin');
    //     $this->db->join('school_new', 'school_new.id = cin_list.school_id');
    //     $this->db->where('cin_list.state_id', $data['state_id']);
    //     $this->db->where('clevel', 1);
    //     $this->db->where('cin_result.status !=', '');
    //     $this->db->like('cin_result.product_name',$data['product_id']);
    //     $this->db->where('cin_result.period_id', $data['period_id']);
    //     if(cin_result.competition_schedule_id!=''){
    //         $this->db->select('competition_schedule.competition_date');
    //         $this->db->join('competition_schedule','cin_result.competition_schedule_id=competition_schedule.competition_schedule_id'); 
    //     }else{
    //         $this->db->select('cin_result.competition_date');
    //     }
    //     if($data['school_id']!='All'){
    //         $this->db->where('school_new.id', $data['school_id']);
    //     }
    //     if($data['area_id']!=''){
    //         $this->db->where('cin_list.franchise_code', $data['area_id']);
    //     }
    //     $query = $this->db->get();
    //     //$this->db->group_by('cin_list.cin');
    //   // echo $this->db->last_query();exit;
    //     return $query->result_array();

    // }    
 
 public function list_student_product($data)     
{
   // print_r($data);echo 'ok';die;
    $this->db->select('cin_list.student_name, cin_list.cin, cin_list.franchise_code, cin_list.address1, cin_list.stud_email, cin_list.stud_phone, cin_list.class, cin_list.father_name, cin_list.mother_name, cin_result.grade, cin_result.rank, cin_result.status, cin_result.marks,cin_result.competition_date');

    $this->db->from('cin_result');
    $this->db->join('cin_list', 'cin_list.cin = cin_result.cin');
   
    $this->db->where('cin_list.cin', $data['search_cin']);
   
    
    $query = $this->db->get();
    //echo $this->db->last_query();echo 'ok';die;
    return $query->result_array();
}


 
	 public function insert_schedule($insert_array,$category_id) 
	 {
		 extract($insert_array);
		
		
        foreach($category_id as $value){		
        $data = array(
                'period_id' => $period_id,
                'state_id' => $state_id,
                'category_id' =>$value,
                'competition_level_id' => $competition_level_id,
                'competition_caption' => $competition_caption,
                'center_address' => $center_address,
                'franchise_id' => $franchise_id,
				'product_name' => $product_name
            );	
           //print_r($data);die;			
		 $insert_query  = $this->db->insert('competition_schedule', $data);
		 //echo $this->db->last_query();exit;
		 //$last_id=$this->db->insert_id();
          }          
		 return 'Yes';
		 
	 }	 
/* ---------------------------------------------------------------------- */	
// FUNCTION NO:- 3  -   ASSIGN " NEW COMPETITION SCHEDULE"  TO SCHOOLS
/* ---------------------------------------------------------------------- */		 
	 function select_schools($competition_schedule_id)
{
	$this->db->select('competition_schedule.franchise_id');
	$this->db->from('competition_schedule');
	$this->db->join('franchise','competition_schedule.franchise_id=franchise.franchise_id');
	$this->db->where('competition_schedule_id' ,$competition_schedule_id);
	$STEP1_query=$this->db->get();  /*echo $this->db->last_query();exit;*/
	$STEP1_array_result=$STEP1_query->row_array();
	$franchise_id=$STEP1_array_result['franchise_id'];
	
	
	$this->db->select('*');
	$this->db->from('schools');
	$this->db->join('school_to_franchise','school_to_franchise.school_id=schools.school_id');
	$this->db->where('school_to_franchise.franchise_id',$franchise_id);
	$this->db->where('schools.school_status','Active');
	$STEP2_query=$this->db->get(); /*echo $this->db->last_query();exit;*/
	$STEP2_array_result=$STEP2_query->result_array();
	
	if(empty($STEP2_array_result))
	{
		$school_schedule['status']="No_school_data_found";
		
	} /* end of if empty step2*/
	
	else
	{
				foreach($STEP2_array_result as $value):
					
					  $school_id[]=$value['school_id'];
				endforeach;
				
				$this->db->select('*');
				$this->db->from('schedule_to_school');
				$this->db->where_in('school_id',$school_id);
				$this->db->where('competition_schedule_id',$competition_schedule_id);
				$STEP3_query=$this->db->get();/*echo $this->db->last_query();exit;*/
				$STEP3_array_result=$STEP3_query->result_array();
				
				if(empty($STEP3_array_result))
				{
					$school_schedule['status']="No_school_assign";
					$school_schedule['data']=$STEP2_array_result;
				}
				else
				{
					
					foreach($STEP3_array_result as $value):
					
					  $assign_school_id[]=$value['school_id'];
					 endforeach;
				
				
					  $this->db->select('*');
					  $this->db->from('schools');
					  $this->db->join('school_to_franchise','school_to_franchise.school_id=schools.school_id');
	                  $this->db->where('school_to_franchise.franchise_id',$franchise_id);
					  $this->db->where_not_in('schools.school_id',$assign_school_id);
					  $this->db->where('schools.school_status','Active');
					  
					  $STEP4_query=$this->db->get(); /*echo $this->db->last_query();exit;*/
					  $STEP4_array_result=$STEP4_query->result_array();
					  
					  if(empty($STEP4_array_result))
					  {
						  $school_schedule['status']="All_schools_assign";
					  }
					  else
					  {
						  $school_schedule['status']="Not_All_schools_assign";
						  $school_schedule['data']=$STEP4_array_result;
						  
					  }
					  
					  
				}
				
	} /* end of else of  empty step2*/
	
	/*echo "<pre>";print_r($school_schedule);exit;*/
	return $school_schedule;
}	 
/* ---------------------------------------------------------------------- */	

// FUNCTION NO:- 4  -   INSERT SCHOOL ID TO SCHEDULE TO SCHOOL 
	
/* ---------------------------------------------------------------------- */		 
public function insert_schedule_to_school($insert_shool_to_schedule_params)
  {
	  extract($insert_shool_to_schedule_params);
	  
	  foreach($school_id as $value):
		  
			$data1[]=array('competition_schedule_id' =>$competition_schedule_id,
						  'school_id'  =>$value,
						  'status'     =>'Active'
						 );
	  endforeach;
	  
						 
	// echo "------.<pre>";print_r($data1);exit;				 
	  $inserted_schedule_status=$this->db->insert_batch('schedule_to_school', $data1);
	  return  $inserted_schedule_status;
	  
  } 
/* ---------------------------------------------------------------------- */	

// FUNCTION NO:- 5  -   LIST SCHEDULE BASED ON THE CONDITION ( LEVEL & PERIOD) 
	
/* ---------------------------------------------------------------------- */	 
 public function  list_schedule($search_params)
   {
	   
	  extract($search_params);
	  /*echo "<pre>";print_r($search_params);exit;*/
	  $this->db->select('competition_schedule.*,period.period_name,competition_level_name,category.categoryKey'); 
	  $this->db->from('competition_schedule');
	  $this->db->join('period','period.period_id=competition_schedule.period_id');
	  $this->db->join('competition_levels','competition_levels.competition_level_id=competition_schedule.competition_level_id');
	  $this->db->join('category','category.category_id=competition_schedule.category_id');
	  $this->db->where('competition_schedule.period_id',$period_id);
	  $this->db->where('competition_schedule.competition_level_id',$competition_level_id);
	  $this->db->where('franchise_id',$franchise_id);
	  $result_query=$this->db->get();  /*echo $this->db->last_query();exit;*/
	  $result_array=$result_query->result_array();
	  
	  if(empty($result_array))
	  {
			
		 $schedule_data['status']="No_schedule_found";
			
	   }
	   else
	   { 
	     $schedule_data['status']="Schedule_found";
		 $schedule_data['sch_list']=$result_array;
		 
	   }
	  
	  
	  return  $schedule_data;
	  /*echo $last_id=$this->db->insert_id();exit;
	  return $this->db->insert_id();*/
   }
/* ---------------------------------------------------------------------- */	

// FUNCTION NO:- 6  -   SELECT SCHEDULE ASSIGNED SCHOOLS ) 
	
/* ---------------------------------------------------------------------- */	
 
 public function  select_assign_schools($search_param)
   {
	   extract($search_param);
		$this->db->select('*');
		$this->db->from('schedule_to_school');
		$this->db->where('competition_schedule_id',$competition_schedule_id);
		$this->db->where('status',"Active");
		$STEP1_query=$this->db->get(); /*echo $this->db->last_query();exit;*/
		$STEP1_array_result=$STEP1_query->result_array();
		
		if(empty($STEP1_array_result))
		{
			
			$school_schedule['status']="No_schools_assign";
			
		}
		else
		{
			foreach($STEP1_array_result as $value):
			   
			   $assign_school_id[]=$value['school_id'];
			   
			endforeach;
			
			$this->db->select('*');
			$this->db->from('schools');
			$this->db->join('school_to_franchise','school_to_franchise.school_id=schools.school_id');
			$this->db->where('school_to_franchise.franchise_id',$franchise_id);
			$this->db->where_in('schools.school_id',$assign_school_id);
			$this->db->where('schools.school_status','Active');
			
			
				/*$this->db->select('*');
				$this->db->from('school_reg');
				$this->db->where_in('id',$assign_school_id);*/
				
				
				$STEP2_query=$this->db->get(); /*echo $this->db->last_query();exit;*/
				$STEP2_array_result=$STEP2_query->result_array();
				
				$school_schedule['status']="schools_assign";
				$school_schedule['data']=$STEP2_array_result;

		}
		
		return $school_schedule;
		
   }

 public function getcompetitionshedule($competition_schedule_id)
     {
        $this->db->select('*');
        $this->db->from('competition_schedule');
        $this->db->where('competition_schedule_id',$competition_schedule_id);
        $query = $this->db->get();
        return $query->row_array();
    }	


public function update_schedule($update_array,$competition_schedule_id) 
	 {
		   extract($update_array); /*echo $competition_schedule_id;print_r($update_array);exit;*/
          if ($competition_schedule_id != '')
          {
                $this->db->where('competition_schedule_id', $competition_schedule_id);
                $status=$this->db->update('competition_schedule', $update_array);			  
			    /*echo $this->db->last_query();*/
				return $status;
          } 
		  else
		  {
			  return 0;
		  }
	 }
/* ---------------------------------------------------------------------- */	

// FUNCTION NO:- 6  -   SELECT SCHEDULE ASSIGNED SCHOOLS ) 
	
/* ---------------------------------------------------------------------- */	
 
 public function  update_schedule_to_school($update_shool_to_schedule_params)
 
  {
	  extract($update_shool_to_schedule_params); 
	  
	  
	    foreach($school_id as $value)
		{
		   $data=array('status'     =>'Deleted');
		   $where=array(   'competition_schedule_id' => $competition_schedule_id,
		                   'school_id'  => $value
		                );
		   $this->db->where($where);
		   $status=$this->db->update('schedule_to_school', $data);		  
		   return  $status;
		}	  
  }

	public function  schedule_lists()  
	 {
		$this->db->select('*');
		$this->db->from('competition_schedule');
		$this->db->join('franchise','franchise.franchise_id=competition_schedule.franchise_id');
		$this->db->join('period','period.period_id=competition_schedule.period_id');
		$this->db->join('competition_levels','competition_levels.id=competition_schedule.competition_level_id');
		//$this->db->where('competition_schedule_id' ,$competition_schedule_id);
		$STEP1_query=$this->db->get();  /*echo $this->db->last_query();exit;*/
		return $STEP1_array_result=$STEP1_query->result_array();   
	  }
 public function  list_schedule_product($search_params)
   {
	   
	  extract($search_params);
// 	echo "<pre>";print_r($search_params);exit;
	  $this->db->select('*'); 
	  $this->db->from('competition_schedule');
	  $this->db->join('period','period.period_id=competition_schedule.period_id');
 	  //$this->db->join('competition_level_byproduct','competition_level_byproduct.level_name=competition_schedule.product_name');
	  $this->db->join('class','class.class_id=competition_schedule.category_id');
	  $this->db->join('franchise','franchise.franchise_id=competition_schedule.franchise_id');
	  $this->db->where('competition_schedule.period_id',$period_id);
	  $this->db->where('competition_schedule.competition_level_id',$competition_level_id);
	  $this->db->where('competition_schedule.franchise_id',$franchise_id);
	  $this->db->where('competition_schedule.product_id',$product_name);
	  
	  $this->db->group_by('competition_schedule_id');
	  
	  $result_query=$this->db->get(); 
	  
 	  //echo $this->db->last_query();exit;
	  
	  $result_array=$result_query->result_array();
	  
	  //print_R($result_array);die;
	  return  $result_array;
	  /*echo $last_id=$this->db->insert_id();exit;
	  return $this->db->insert_id();*/
    }
 
    public function inset_sch($data){
                extract($data);
        // 		print_r($data);die;
        		
        		$insert_query  = $this->db->insert('competition_schedule', $data);
        		return $insert_query;
    }
        
        
 
    public function search_schedule($insert_array){
	     // extract($insert_array);
		//print_r($insert_array);die;
		
    		$this->db->select('*');
        	$this->db->from('competition_schedule');
        	$this->db->join('period','period.period_id=competition_schedule.period_id');
        	
	        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_schedule.competition_level_id');
	        
	       // $this->db->join('category','category.category_id=competition_schedule.category_id');
	        $this->db->join('franchise','competition_schedule.franchise_id=franchise.franchise_id');
        	$this->db->where('competition_schedule.period_id',$insert_array['period_id']);
        	$this->db->where('competition_schedule.product_id',$insert_array['product_name']);
        	$this->db->where('competition_level_byproduct.product_id',$insert_array['product_name']);
        	$this->db->where('competition_schedule.state_id',$insert_array['state_id']);
        // 	$this->db->where('competition_schedule.franchise_id',$insert_array['franchise_id']);
        	$this->db->where('competition_schedule.competition_level_id',$insert_array['competition_level_id']);
        	$this->db->group_by('competition_schedule_id');
        	$STEP2_query=$this->db->get(); 
      //  echo $this->db->last_query();exit;
        	$STEP2_array_result=$STEP2_query->result_array();
        	
	     return $STEP2_array_result;
	 }
 
 	 public function schools_not_assign($fr_id,$schedule_id){
 	            //echo $schedule_id.'ok'.$fr_id;die;
 	        $this->db->select('*');
            $this->db->from('school_new');
            $this->db->where("school_new.franchise_id", $fr_id);
            $this->db->where("school_new.id NOT IN (SELECT school_id FROM schedule_to_school WHERE competition_schedule_id = '$schedule_id')");
            $query = $this->db->get();
            
           // echo $this->db->last_query() . ' ok'; die();
            
            // Execute the query and retrieve the results
            $result = $query->result_array();
            return $result;
 	 }
 	 
 	  public function search_schedule2($insert_array){
	     // extract($insert_array);
		//print_r($insert_array);die;
		
    		$this->db->select('*');
        	$this->db->from('competition_schedule');
        	$this->db->join('period','period.period_id=competition_schedule.period_id');
        	
	        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_schedule.competition_level_id');
	        
	       // $this->db->join('category','category.category_id=competition_schedule.category_id');
	        $this->db->join('franchise','competition_schedule.franchise_id=franchise.franchise_id');
        	$this->db->where('competition_schedule.period_id',$insert_array['period_id']);
        	$this->db->where('competition_schedule.product_name',$insert_array['product_name']);
        	//$this->db->where('competition_level_byproduct.product_id',$insert_array['product_name']);
        	$this->db->where('competition_schedule.state_id',$insert_array['state_id']);
         	$this->db->where('competition_schedule.franchise_id',$insert_array['franchise_id']);
        	$this->db->where('competition_schedule.competition_level_id',$insert_array['competition_level_id']);
        	$this->db->where('competition_schedule.franchise_id',$insert_array['franchise_id']);
        	$this->db->group_by('competition_schedule_id');
        	$STEP2_query=$this->db->get(); 
        //echo $this->db->last_query();exit;
        	$STEP2_array_result=$STEP2_query->result_array();
        	
	     return $STEP2_array_result;
	 }
 
 	 
 	 
}
?>