<?php
class Newmodel extends CI_Model {
 
	 public function get_student_data($prid){
	     //echo $prid;die;
	 
	     $this->db->select('*');
         $this->db->from('cin_list');
        // $this->db->join('school_new','cin_list.school_id=school_new.id');
         $this->db->where('cin',$prid);
         $query = $this->db->get();
         // echo $this->db->last_query();exit;
         return $query->result_array();
         
	 }
public function get_periods_by_product_level($product_name, $level_id) {
    $this->db->distinct();
    $this->db->select('*');
    $this->db->from('period');       // replace with your actual table
    //$this->db->where('product_name', $product_name);
   // $this->db->where('level_id', $level_id);
    $this->db->order_by('period_id', 'ASC');

    $query = $this->db->get();
    return $query->result_array();
}	 
	 // ── FETCH LEVELS BY PRODUCT ──
public function get_levels_by_product($product_name) {
    $this->db->select('level_id, level_name, medal_no');
    $this->db->from('competition_level_byproduct');
    $this->db->where('product_name', $product_name);
    $this->db->order_by('level_id', 'ASC');

    $query = $this->db->get();
    return $query->result_array();
}

// ── FETCH TOP RANK HOLDERS ──
public function get_rank_holders($product_name, $level_id, $period) {
    $this->db->select('student_name, school_name as school, rank, speller, performer');
    $this->db->from('cin_result'); 
    $this->db->join('cin_list','cin_list.cin=cin_result.cin');// replace with your actual table
    $this->db->where('cin_result.product_name', $product_name);
    $this->db->where('cin_result.clevel', $level_id);
   // $this->db->where('cin_result.period_id', $period);
    $this->db->where_in('cin_result.rank', ['Rank-1', 'Rank-2', 'Rank-3']);
    //$this->db->order_by('cin_result.rank', 'ASC');

    $query = $this->db->get();
    return $query->result_array();
}
	 
	  public function get_allresult_data($cin,$product_name){
        
        
        
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('cin_result.status !=', '');
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            return $query->result_array();
        
    }
    
    
    public function get_student_data_cin_($cin){
	     //echo $cin;die;
	 
	     $this->db->select('*');
         $this->db->from('cin_list');
         $this->db->where('cin',$cin);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         return $query->row_array();
         
	 }
    
    
    
     public function get_student_data_cin($cin){
	     $this->db->select('*');
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin');
        $this->db->join('school_new', 'school_new.id = cin_list.school_id AND cin_list.school_id IS NOT NULL AND cin_list.school_id != 0', 'left');
        $this->db->where('cin_list.cin', $cin);
        $this->db->group_by('cin_list.cin');
        $query = $this->db->get();


         //echo $this->db->last_query();exit;
         return $query->row_array();
         
	 }
    
	 public function update_student_data($cin,$data){
	     //print_r($data);die;
	      $insert_data=array(  
								  'stud_email'   =>  $data['stud_email'],
								  'father_name'   => $data['father_name'],
								  'mother_name'  =>  $data['mother_name'],
								  'stud_phone'   =>  $data['stud_phone'],
								  'father_phone'   => $data['father_phone'],
								  'mother_phone'  =>  $data['mother_phone'],
								  'father_email'   => $data['father_email'],
								  'mother_email'  =>  $data['mother_email'],
							);
 		//	print_r($insert_data);die;
	    $this->db->where('cin',$cin);
	    $this->db->update('cin_list', $insert_data); 
	    $status='yes';
	    return $status;
	}
	
 	public function get_student_result($cin){
        $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin_result.status !=','');
         $this->db->where('cin',$cin);
         $query = $this->db->get();
         return $query->result_array();
    }
    
    public function get_student_result_($cin){
        $this->db->select('*');
        $this->db->from('cin_result');
        $this->db->where('cin',$cin);
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
        
        // $this->db->join('period','period.period_id=cin_result.period_id','left');
        
        $this->db->order_by("clevel", "desc");
        $this->db->where('competition_level_byproduct.product_name=cin_result.product_name');
        
        // echo $cin;
        if (!strpos($cin , 'LU') !== false) {
            $this->db->where('cin_result.status !=','');
        } 
        
        
        
        $query = $this->db->get();
        
        //  echo $this->db->last_query();
         
        return $query->row_array();
    }
    
    public function get_student_result_n($cin,$product_name,$clevel)
    {
        $this->db->select('*');
        $this->db->from('cin_result');
        $this->db->where('cin',$cin);
        $this->db->join('competition_level_byproduct','competition_level_byproduct.product_name=cin_result.product_name');
        $this->db->order_by("clevel", "desc");
        $this->db->where('competition_level_byproduct.product_name',$product_name);
        $this->db->where('competition_level_byproduct.level_id',$clevel);
        // echo $cin;
        if (!strpos($cin , 'LU') !== false) {
            $this->db->where('cin_result.status !=','');
        } 
        
        $query = $this->db->get();
        
        // echo $this->db->last_query();
         
        return $query->row_array();
    }
    
    public function get_student_product($school_id){
        // $this->db->select('*');
        // $this->db->from('new_product');
        // $this->db->where('school_id',$school_id);
        // $query = $this->db->get();
        //  //echo $this->db->last_query();exit;
         
        
        // return $query->result_array();
       // return $data;
    }
    
    public function get_student_cart($cin,$clevel){
        $this->db->select('*');
        $this->db->from('new_cart');
        $this->db->where('cin',$cin);
        $this->db->where('clevel',$clevel);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    public function cart_new_enter($cin,$data){
        $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin',$cin);
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $result= $query->result_array();
        $product_name=$result[0]['product_name'];
        $clevel=$result[0]['clevel'];
        $period=$result[0]['period_id'];
        $orientation='No';
        $status='Unpaid';
        $study_material='No';
        //$mock_test='No';
// total
        if($data['amount']=='1750'){
            $orientation='Yes';
            $study_material='Yes';
            $status='Paid';
            $mock_test='Yes';
            $price_code='22NT1750';
        }
// single
        if($data['amount']=='250'){
            $study_material='Yes';
            $price_code='22NT250';
        }
        if($data['amount']=='950'){
            $orientation='Yes';
            $price_code='22NT950';
        }
        if($data['amount']=='350'){
            $status='Paid';
            $price_code='22NT350';
        }
        if($data['amount']=='200'){
            $mock_test='Yes';
            $price_code='22NT200';
        }
        
        if($data['amount']=='600'){
            $study_material='Yes';
            $status='Paid';
            $price_code='22NT60';
        }
        if($data['amount']=='450'){
            $study_material='Yes';
            $mock_test='Yes';
            $price_code='22NT450';
        }
        if($data['amount']=='1300'){
            $orientation='Yes';
            $status='Paid';
            $price_code='22NT1300';
        }
        if($data['amount']=='1200'){
            $orientation='Yes';
            $study_material='Yes';
            $price_code='22NT1200';
        }
        if($data['amount']=='550'){
            $mock_test='Yes';
            $status='Paid';
            $price_code='22NT550';
        }
        if($data['amount']=='1500'){
            $mock_test='Yes';
            $orientation='Yes';
            $status='Paid';
            $price_code='22NT1500';
        }
         if($data['amount']=='1400'){
            $mock_test='Yes';
            $orientation='Yes';
            $study_material='Yes';
            $price_code='22NT1400';
        }
        if($data['amount']=='800'){
            $mock_test='Yes';
            $status='Paid';
            $study_material='Yes';
            $price_code='22NT800';
        }
		if($data['amount']=='750'){
            $mock_test='Yes';
            $status='Paid';
            $study_material='Yes';
            $price_code='22NT750';
        }
		if($data['amount']=='1350'){
            $mock_test='Yes';
            $orientation='Yes';
            $study_material='Yes';
            $price_code='22NT1350';  
        }
       
        
        $insert_data=array(  
								  'cin'   =>  $cin,
								  'clevel'=> $clevel,
								  'product_name'=>$product_name,
								  'status'   => $status,
								  'period_id'=>'11',
								  'price_code'=>$data['price_code'],
								  'razorpay_payment_id'  =>  $data['razorpay_order_id'],
								  'merchant_order_id'   =>  $data['razorpay_order_id'],
								  'merchant_trans_id'   => $data['razorpay_order_id'],
								  'merchant_product_info_id'  =>  $data['razorpay_order_id'],
								  'card_holder_name_id'   => $data['razorpay_order_id'],
								  'merchant_amount'  =>  $data['amount'],
								  'amount'=>$data['amount'],
								  'orientation'=>$orientation,
								  'study_material'=>$study_material,
								  'mock_test'=>'No',
								  'revision'=>'No'
							);
 //	print_r($insert_data);die;
	   
	    $this->db->insert('new_cart', $insert_data); 
    
    
    }
    
    
    
    public function cart_new($cin,$data){
		//print_r($data);exit;
        $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin',$cin);
         $this->db->where('cin_result.status !=','');
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
       //  echo $this->db->last_query();exit;
         $result= $query->result_array();
        $product_name=$result[0]['product_name'];
        $clevel=$result[0]['clevel'];
        $period=$result[0]['period_id'];
        
        
        if($data['amount']=='1750'){
            $orientation='Yes';
            $study_material='Yes';
            $status='Paid';
            $mock_test='Yes';
            $price_code='22IS1750';
        }

        if($data['amount']=='250'){
            $study_material='Yes';
            $price_code='22IS250';
        }
        if($data['amount']=='950'){
            $orientation='Yes';
            $price_code='22IS950';
        }
        if($data['amount']=='200'){
            $mock_test='Yes';
            $price_code='22IS200';
        }
        if($data['amount']=='350'){
            $status='Paid';
            $price_code='22IS350';
        }
  
        if($data['amount']=='550'){
            $mock_test='Yes';
            $status='Paid';
            $price_code='22IS550';
        }
        if($data['amount']=='1300'){
            $orientation='Yes';
            $status='Paid';
            $price_code='22IS1300';
        }
        if($data['amount']=='600'){
            $status='Paid';
            $study_material='Yes';
            $price_code='22IS600';
        }
        //mock      
        
        if($data['amount']=='1150'){
            $mock_test='Yes';
            $orientation='Yes';
            $price_code='22IS1150';
        }
        if($data['amount']=='450'){
            $mock_test='Yes';
            $study_material='Yes';
            $price_code='22IS450';
        }
        
        if($data['amount']=='1200'){
            $orientation='Yes';
            $study_material='Yes';
            $price_code='22IS1200';
        }
       
        if($data['amount']=='1500'){
            $orientation='Yes';
            $mock_test='Yes';
            $status='Paid';
            $price_code='22IS1550';
        }
       
        if($data['amount']=='1550'){
            $study_material='Yes';
            $orientation='Yes';
            $status='Paid';
            $price_code='22IS1550';
        }
        
        
        if($data['amount']=='1400'){
            $study_material='Yes';
            $orientation='Yes';
            $mock_test='Yes';
            $price_code='22IS1400';
        }
		if($data['amount']=='400'){
            $study_material='Yes';
            $mock_test='Yes';
            $price_code='22IS400';
        }
		if($data['amount']=='1350'){
            $study_material='Yes';
            $mock_test='Yes';
			$orientation='Yes';
            $price_code='22IS1350';
        }
		if($data['amount']=='750'){
            $study_material='Yes';
            $mock_test='Yes';
			$status='Paid';
            $price_code='22IS750';
        }if($data['amount']=='1700'){
            $study_material='Yes';
            $mock_test='Yes';
			$status='Paid';
			$orientation='Yes';
            $price_code='22IS1700';
        } if($data['amount'] < 1000){
            $study_material='Yes';
            $mock_test='Yes';
			$status='Paid';
			$orientation='No';
            $price_code='22IS1700';
            //echo '-----';exit;
        }    
        
        
        $insert_data=array(  
								  'cin'   =>  $cin,
								  'clevel'=> $clevel,
								  'product_name'=>$product_name,
								  'status'   => $status,
								  'price_code'=>$data['price_code'],
								  'razorpay_payment_id'  =>  $data['razorpay_order_id'],
								  'merchant_order_id'   =>  $data['razorpay_order_id'],
								  'merchant_trans_id'   => $data['razorpay_order_id'],
								  'merchant_product_info_id'  =>  $data['razorpay_order_id'],
								  'card_holder_name_id'   => $data['razorpay_order_id'],
								  'merchant_amount'  =>  $data['amount'],
								  'amount'=>$data['amount'],
								  'orientation'=>$orientation,
								  'study_material'=>$study_material,
								  'mock_test'=>$mock_test,
								  'period_id'=>$period,
								  'revision'=>'No'
							);
 	//print_r($insert_data);die;
	   
	    $res=$this->db->insert('new_cart', $insert_data); 
    return $res;
    
    }
    
	 public function cart_newstate($cin,$data,$state_id){
		 $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin',$cin);
         $this->db->where('cin_result.status !=','');
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
         $result= $query->result_array();
		 
        $product_name=$result[0]['product_name'];
        $clevel=$result[0]['clevel'];
        $period=$result[0]['period_id'];
        
        $Competition = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>$clevel,'material_name'=>$product_name))->row();
			if(!empty($Competition)){
			$Competition='Paid';
		}else{ $Competition='Unpaid'; }
		
		$study_mat = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>$clevel,'material_name'=>'study_material'))->row();
		if(!empty($study_mat)){
			$study_material='Yes';
		}else{ $study_material='No'; }
		$orient = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>
		$clevel,'material_name'=>'orientation_a'))->row();
		if(!empty($orient)){
			$orientation='Yes';
		}else{ $orientation='No'; }
		$mockt = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>$clevel,'material_name'=>'mock_test'))->row();
		if(!empty($mockt)){
			$mock_test='Yes';
		}else{ $mock_test='No'; }  
		
			$study_mats = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>$clevel,'material_name'=>'study_material_b'))->row();
		if(!empty($study_mats)){
			$study_material_b ='Yes';
		}else{ $study_material_b ='No'; }
		
		$orientation_b = $this->db->get_where('statewise_addtocart',array('cin'=>$cin,'clevel'=>
		$clevel,'material_name'=>'orientation_b'))->row();
			if(!empty($orientation_b)){
			$orientation_b='Yes';
		}else{ $orientation_b='No'; }
		
		
		 $insert_data=array(  
								  'cin'   =>  $cin,
								  'clevel'=> $clevel,
								  'product_name'=>$product_name,
								  'status'   => $Competition,
								  'price_code'=>$data['price_code'],
								  'razorpay_payment_id'  =>  $data['razorpay_order_id'],
								  'merchant_order_id'   =>  $data['razorpay_order_id'],
								  'merchant_trans_id'   => $data['razorpay_order_id'],
								  'merchant_product_info_id'  =>  $data['razorpay_order_id'],
								  'card_holder_name_id'   => $data['razorpay_order_id'],
								  'merchant_amount'  =>  $data['amount'],
								  'amount'=>$data['amount'],
								  'orientation'=>$orientation,
								  'study_material'=>$study_material,
								  'study_material_b'=>$study_material_b,
								  'orientation_b'=>$orientation_b,
								  'mock_test'=>$mock_test,
								  'period_id'=>$period
								  
							);
    //print_r($insert_data);die;
	   
	    $ress = $this->db->insert('new_cart', $insert_data);
	    
        return $ress;
		
	 }
	
	public function cart_new_add($data){
	    //print_r($data['product_name']);exit;  
	     $this->db->select('clevel,period_id,product_name');
         $this->db->from('cin_result');
         $this->db->where('cin',$data['cin']);
         $this->db->where('cin_result.status !=','');
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->row_array();
	    $period=$res['period_id'];
	    $product=$data['product_name'];
	     $this->db->select('state_id');
         $this->db->from('cin_list');
         $this->db->where('cin',$data['cin']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $ress= $query->row_array();
	    $state=$ress['state_id'];
	    
	    
	    
	    //print_r($data);
	    //print_r($data);echo 'ok';die;
	    
	    $this->db->select('*');
         $this->db->from('amount_cart');
         $this->db->where('cin',$data['cin']);
         $query = $this->db->get();
       //  echo $this->db->last_query();exit;
         $result= $query->result_array();
	    //print_r($result);die;
	   
	                $arr=array(
                        'product_name'=>$product,
                        'amount'=>$data['amount']/100,
                        'cin'=>$data['cin'],
                        'razorpay_payment_id'=>$data['razorpay_order_id'],
                        'merchant_order_id'=>$data['razorpay_order_id'],
                        'merchant_trans_id'=>$data['razorpay_order_id'],
                        'clevel'=>$data['clevel'],
                        'period_id'=>$period,
                        'merchant_amount'=>$data['amount']
                        );
	   
	    foreach($result as $row){
	      
	            $r=$row['title'];
	            
                    if($r=='Material A' || $r=='Material'){
                        $arr['study_material'] = 'Yes';
                        $arr['study_material_a'] = 'Yes';
                    }
                    if($r=='Material B'){
                        $arr['study_material_b'] = 'Yes';
                    }
                    if($r=='Material C'){
                        $arr['study_material_c'] = 'Yes';
                    }
                    if($r=='Material D'){
                        $arr['study_material_d'] = 'Yes';
                    }
                    if($r=='Material E'){
                        $arr['study_material_e'] = 'Yes';
                    }
                    if($r=='Material F'){
                        $arr['study_material_f'] = 'Yes';
                    }
                    
                    
                    
                    if($r=='Orientation A'){
                        $arr['orientation']= 'Yes';
                        $arr['orientation_a']='Yes';
                    }
                    if($r=='Orientation B'){
                        $arr['orientation_b'] = 'Yes';
                    }
                    if($r=='Orientation C'){
                        $arr['orientation_c'] = 'Yes';
                    }
                    if($r=='Orientation D'){
                        $arr['orientation_d']= 'Yes';
                    }
                    if($r=='Orientation E'){
                        $arr['orientation_e'] = 'Yes';
                    }
                    if($r=='Orientation F'){
                        $arr['orientation_f'] = 'Yes';
                    }
                    
                    
                    if($r=='Competition'){
                        $arr['status'] = 'Paid';
                        $arr['comp_date']=$row['sch_id'];
                    }
                    
                    
                    
                    if($r=='MockTest' || $r=='MockTest A'){
                        $arr['mock_test'] = 'Yes';
                        $arr['mock_test_a'] = 'Yes';
                    }
                    if($r=='MockTest B'){
                        $arr['mock_test_b'] = 'Yes';
                    }
                    if($r=='MockTest C'){
                        $arr['mock_test_c'] = 'Yes';
                    }
                    if($r=='MockTest D'){
                        $arr['mock_test_d'] = 'Yes';
                    }
                    if($r=='MockTest E'){
                        $arr['mock_test_e'] = 'Yes';
                    }
                    if($r=='MockTest F'){
                        $arr['mock_test_f'] = 'Yes';
                    }
                    
	                
	                   // die;
	            
	       // }
	        
	    }
	    
	   // print_r($arr);die;
	    $ress = $this->db->insert('new_cart', $arr);
                         
                        
	    return $ress;
	    
	}
	
    
    public function cart_new_national($cin,$data){
        $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin',$cin);
         $this->db->where('cin_result.status !=','');
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
       //  echo $this->db->last_query();exit;
         $result= $query->result_array();
        $product_name=$result[0]['product_name'];
        $clevel=$result[0]['clevel'];
        $period=$result[0]['period_id'];
        $orientation='No';
        $status='Unpaid';
        $study_material='No';
        $mock_test='No';
        
        if($data['amount']=='8749'){
            $orientation='Yes';
            $study_material='Yes';
            $status='Paid';
            $mock_test='Yes';
            $price_code='21IS18749';
        }
// single
        if($data['amount']=='550'){
            $study_material='Yes';
            $price_code='21IS550';
        }
        if($data['amount']=='999'){
            $orientation='Yes';
            $price_code='21IS999';
        }
        if($data['amount']=='350'){
            $mock_test='Yes';
            $price_code='21IS350';
        }
        if($data['amount']=='6850'){
            $status='Paid';
            $price_code='21IS6850';
        }
  
        if($data['amount']=='7200'){
            $mock_test='Yes';
            $status='Paid';
            $price_code='21IS7200';
        }
        if($data['amount']=='7849'){
            $orientation='Yes';
            $status='Paid';
            $price_code='21IS7849';
        }
        if($data['amount']=='7400'){
            $status='Paid';
            $study_material='Yes';
            $price_code='21IS7400';
        }
        //mock      
        
        if($data['amount']=='1349'){
            $mock_test='Yes';
            $orientation='Yes';
            $price_code='21IS1349';
        }
        if($data['amount']=='900'){
            $mock_test='Yes';
            $study_material='Yes';
            $price_code='21IS900';
        }
        
        if($data['amount']=='1549'){
            $orientation='Yes';
            $study_material='Yes';
            $price_code='21IS1549';
        }
       
        if($data['amount']=='8199'){
            $orientation='Yes';
            $mock_test='Yes';
            $status='Paid';
            $price_code='21IS8199';
        }
        if($data['amount']=='7750'){
            $study_material='Yes';
            $mock_test='Yes';
            $status='Paid';
            $price_code='21IS7750';
        }
        if($data['amount']=='8399'){
            $study_material='Yes';
            $orientation='Yes';
            $status='Paid';
            $price_code='21IS8399';
        }
        
        
        if($data['amount']=='1999'){
            $study_material='Yes';
            $orientation='Yes';
            $mock_test='Yes';
            $price_code='21IS1999';
        }
		
		 
        $insert_data=array(  
								  'cin'   =>  $cin,
								  'clevel'=> $clevel,
								  'product_name'=>$product_name,
								  'status'   => $status,
								  'price_code'=>$data['price_code'],
								  'razorpay_payment_id'  =>  $data['razorpay_order_id'],
								  'merchant_order_id'   =>  $data['razorpay_order_id'],
								  'merchant_trans_id'   => $data['razorpay_order_id'],
								  'merchant_product_info_id'  =>  $data['razorpay_order_id'],
								  'card_holder_name_id'   => $data['razorpay_order_id'],
								  'merchant_amount'  =>  $data['amount'],
								  'amount'=>$data['amount'],
								  'orientation'=>$orientation,
								  'study_material'=>$study_material,
								  'mock_test'=>$mock_test,
								  'period_id'=>$period,
								  'revision'=>'No'
							);
 //	print_r($insert_data);die;
	   
	    $this->db->insert('new_cart', $insert_data); 
    
    
    }
    
    
    
    public function cart($cin,$data){
        $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin_result.status !=','');
         $this->db->where('cin',$cin);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $result= $query->result_array();
        $product_name=$result[0]['product_name'];
        $orientation='No';
        $status='Unpaid';
        $study_material='No';
        if($data['merchant_total']=='900'){
            $orientation='Yes';
        }
        if($data['merchant_total']=='450'){
            $study_material='Yes';
        }
        if($data['merchant_total']=='5500'){
            $status='Paid';
        }
        if($data['merchant_total']=='5950'){
            $study_material='Yes';
            $status='Paid';
        }
        if($data['merchant_total']=='6400'){
            $orientation='Yes';
            $status='Paid';
        }
        if($data['merchant_total']=='1350'){
            $orientation='Yes';
            $study_material='Yes';
        }
        
        $insert_data=array(  
								  'cin'   =>  $cin,
								  'product_name'=>$product_name,
								  'status'   => $status,
								  'price_code'=>"21NT5500",
								  'razorpay_payment_id'  =>  $data['razorpay_payment_id'],
								  'merchant_order_id'   =>  $data['merchant_order_id'],
								  'merchant_trans_id'   => $data['merchant_trans_id'],
								  'merchant_product_info_id'  =>  $data['merchant_product_info_id'],
								  'card_holder_name_id'   => $data['card_holder_name_id'],
								  'merchant_amount'  =>  $data['merchant_amount'],
								  'amount'=>$data['merchant_total'],
								  'orientation'=>$orientation,
								  'study_material'=>$study_material
							);
 		//	print_r($insert_data);die;
	   
	    $this->db->insert('new_cart', $insert_data); 
	    
        
        
    }
    
    
    public function get_student_material($class,$subject,$product,$clevel,$period,$status){
        //echo $product;die;
        //$arr=explode(" ",$product);
        //$ir=end($arr);
        //$at='MaRRS Primary Colors - '.$ir;
        
        $this->db->select('*');
        $this->db->from('study_material');
        
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel+1);
        $this->db->where('status',$status);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
     public function get_student_material_d($class,$product,$clevel,$period,$status){
        //echo $product;die;
        //$arr=explode(" ",$product);
        //$ir=end($arr);
        //$at='MaRRS Primary Colors - '.$ir;
        
        $this->db->select('*');
        $this->db->from('study_material');
        
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel+1);
        $this->db->where('status',$status);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    public function get_student_material_d_($class,$product,$clevel,$period,$status,$type){
        //echo $product;die;
        //$arr=explode(" ",$product);
        //$ir=end($arr);
        //$at='MaRRS Primary Colors - '.$ir;
        
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->where('type',$type);
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel);
        $this->db->where('status',$status);
        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    
    public function get_student_material_free_a($class,$product,$clevel,$period,$status){
        
        $arr=explode(" ",$product);
        $ir=end($arr);
        
        $at='MaRRS Primary Colors - '.$ir;
        //echo $at;
      // print_r($arr);
	 // print_r($product);die;
        $this->db->select('*');
        $this->db->from('study_material');
        
        $this->db->where('period',$period);
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel+1);
        $this->db->where('status',$status);
        $query = $this->db->get();
    //echo $this->db->last_query();exit; 
        return $query->result_array();
    }
    
     public function get_student_material_free_($class,$status,$product,$clevel,$period,$type){
        
       //echo $class.$status.$product.$clevel.$period.$type;die;
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->where('type',$type);
        $this->db->where('period',$period);
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel);
        $this->db->where('status',$status);
        $query = $this->db->get();
       // echo $this->db->last_query();exit; 
        return $query->result_array();
    }
    
    public function get_student_material_free($class,$status,$product,$clevel,$period){
        
        $arr=explode(" ",$product);
        $ir=end($arr);
        
        $at='MaRRS Primary Colors - '.$ir;
       // echo $at;
      // print_r($arr);
	  //print_r($class);die;
        $this->db->select('*');
        $this->db->from('study_material');
        
        $this->db->where('period',$period);
        $this->db->where('class',$class);
        $this->db->where('product_name',$product);
        $this->db->where('clevel',$clevel+1);
        $this->db->where('status',$status);
        $query = $this->db->get();
       // echo $this->db->last_query();exit; 
        return $query->result_array();
    }
    public function get_student_material_paid($cin,$product,$clevel,$class,$period){
        
        $arr=explode(" ",$product);
        $ir=end($arr);
        $at='MaRRS Primary Colors - '.$ir;
        
        $this->db->select('*');
        $this->db->from('study_material_purchase');
        $this->db->where('cin',$cin);
        $this->db->where('period',$at);
        $this->db->where('product',$period);
        $this->db->where('clevel',$clevel+1);
        $this->db->where('class',$class);
        $query = $this->db->get();
       //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    public function c_data($cin){
        $this->db->select('*');
        $this->db->from('amount_cart');
        $this->db->where('cin',$cin);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $amt=0;
        $array=$query->result();
        foreach($array as $row){
            $amt=$amt+$row->amount;
            // echo $row->amount;
        }
        // echo $amt;
        // die;
        return $amt;
    }
    public function add($amt,$cin){
        //echo $amt.$cin.'ok';die;
        $this->db->select('*');
        $this->db->from('amount_cart');
        $this->db->where('cin',$cin);
        $this->db->where('amount', $amt);
        $query = $this->db->get();
        // echo $this->db->last_query();exit;
        $array=$query->result();
        // print_r($array);die;
        if(empty($array)){
        $insert_data=array(  
								  'cin'   =>  $cin,
								  'amount'=>$amt
							);
	    $this->db->insert('amount_cart', $insert_data); }
    }
    public function remove($amt,$cin){
        // echo $amt.$cin.'ok';die;
        $this->db->where('cin', $cin);
        $this->db->where('amount', $amt);
        $this->db->delete('amount_cart');
    }
    
    public function price($product,$period,$clevel){
        // echo $product.$period;die;
        $this->db->select('*');
         $this->db->from('pricing_cin');
         $this->db->where('clevel',$clevel);
         $this->db->where('period_id',$period);
         $this->db->where('product',$product);
         $query = $this->db->get();
        //  echo $this->db->last_query();exit;
         return $query->result_array();
    }
    public function check($cin,$period,$check,$clevel){
        $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('period_id',$period);
         $this->db->where('cin',$cin);
         $this->db->where($check,'Yes');
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $result=$query->result_array();
        //print_r($result);die;
         if(!empty($result)){
             return 'Yes';
         }
         else{
             return 'No';
         }
         
    }
	
	
	 public function checkstudy($cin,$period,$check,$clevel){
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('study_material','Yes');
         $query = $this->db->get();
         return $result=$query->result_array();
       //print_r($result);die;
        }
        
        public function checkstudy_bmat($cin,$period,$check,$clevel){
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('study_material_b','Yes');
         $query = $this->db->get();
        // echo $this->db->last_query();
         return $result=$query->result_array();
       //print_r($result);die;
        }
		public function checkorientation($cin,$period,$check,$clevel){
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('orientation','Yes');
         $query = $this->db->get();
         return $result=$query->result_array();
       //print_r($result);die;
        }
        public function checkorientation_b($cin,$period,$check,$clevel){
            //echo $cin;
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('orientation_b','Yes');
         $query = $this->db->get();
         return $result=$query->result_array();
       //print_r($result);die;
        }
		public function checkmock($cin,$period,$check,$clevel){
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('mock_test','Yes');
         $query = $this->db->get();
         return $result=$query->result_array();
       //print_r($result);die;
        }
		public function check_cometitions($cin,$period,$check,$clevel){
		    // print_r($clevel);die;
         $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('cin',$cin);
         $this->db->where('status','Paid');
         $query = $this->db->get();
         return $result=$query->result_array();
      
        }
		
	
	
	
	
	
	
    public function check_cometition($cin,$period,$clevel){
        // print_r($clevel);die;
        $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('clevel',$clevel);
         $this->db->where('period_id',$period);
         $this->db->where('cin',$cin);
         $this->db->where('status','Paid');
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $result=$query->result_array();
        //print_r($result);die;
         if(!empty($result)){
             return 'Yes';
         }
         else{
             return 'No';
         }
    }
    public function activate($product){

        $this->db->select('*');
        $this->db->from('products_cin_parts');
        $this->db->where('product_name',$product);
        $query = $this->db->get();
         //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    
    public function activate123($product,$clevel){

        $this->db->select('products_cin_parts.*,pricing_cin.product_price as product_price,pricing_cin.orientation1 as orientation_price,pricing_cin.study_material  as study_material_price,pricing_cin.mock_test as mock_test_price');
        $this->db->from('products_cin_parts');   
		$this->db->join('pricing_cin','pricing_cin.product=products_cin_parts.product_name','left');
        $this->db->where('products_cin_parts.product_name',$product);
		$this->db->where('pricing_cin.clevel',$clevel); 
        $query = $this->db->get();
         //echo $this->db->last_query();exit;
        return $query->result_array();
    }
	
	public function activate_state($product,$clevel,$state_id){
  //echo '-------------';die;
        $this->db->select('*');
        $this->db->from('competition_product_state');   
        $this->db->where('state_id',$state_id);
		$this->db->where('clevel',$clevel); 
		$this->db->where('product_name',$product); 
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();  
    }
    	
}
?>