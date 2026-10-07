<?php
class Index extends CI_Model {
   
	 public function get_result($prid){
	     $this->db->select('*');
         $this->db->from('student_result');
         $this->db->where('PRID',$prid);
        //  $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result();
	 }
	 	 public function get_result1($prid){
	     $this->db->select('*');
         $this->db->from('student_result');
         $this->db->where('PRID',$prid);
        //  $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result();
	 }
	 
	 
	 	 public function active_level(){
	 	     
	 	      $this->db->select('*');
	 	      $this->db->from('comp_level');
	 	      $this->db->where('status','Active');
	 	      $result = $this->db->get();
	 	      return  $result->row_array();
	 	 }
	 
	 public function save_student($pram,$school_code2){
		  //print_r($school_code);die;
	     extract($pram);
	     //print_r($school_code2);die;
	     $this->db->select('period_id,initials');
         $this->db->from('period');
		 $this->db->where('status','Active');
		 $period_data  =  $this->db->get();
		 $period_array=$period_data->result_array(); 
		 $period=$period_array[0]['initials'];
		 $period_id=$period_array[0]['period_id'];
 	//	echo $period;die;
	    
	     $this->db->select('id,level_name');
         $this->db->from('competition_levels');
		 $this->db->where('status','Active');
		 $get_STEP1_query   =  $this->db->get();
		 $get_STEP1_result_row=$get_STEP1_query->result_array(); 
		 $level  = $get_STEP1_result_row[0]['id'];
 	//	echo $level;die;
	    
	    
	     $class=$pram['class'];
	     $query1=$this->db->query("select class_name,class_key from class where class_id='$class;'");
	     foreach ($query1->result() as $row)
                            {
                            $stud_class= $row->class_name;
                            $class_key=$row->class_key;
                            }
	    $query=$this->db->query("select PRID from students ORDER BY id DESC LIMIT 1");
	     foreach ($query->result() as $row)
                            {
                            $pid= $row->PRID;
                            }
                            // echo $pid;die;
                     $first=$period;
                     $mid='MRREG';
                     $last=substr($pid, 7);
                     $last=$last+1;
                    // echo $last;die;
	     $prid=$first.$mid.$last;
	    // echo $class_key;die;
	    
	    
	    if(empty($school_code)){
		$school_code = $school_code2;	
		}
	     $insert_data=array(  
			                      'first_name'  => $first_name , 
								  'middle_name'  => $middle_name,
								  'last_name' =>  $last_name,
								  
								  'email'   =>  $email,
					
								  'period_id'    =>  $period_id,
								  'level_id'   =>  $level,
								//   'year'     =>  $year ,
								  'class_key'  => $class_key,
								  'class'        =>  	$stud_class  ,
								  'father_name'   => $father_name,
								  
								  'mother_name'  =>  $mother_name,
								  'gender'=> $gender,
								  'email'      => $email,
								  'mobile'  => $mobile,
								  'whatsapp'      =>  $whatsapp,
								  'PRID'=>$prid,
								  'school_code'=>$school_code
							);
 		//	print_r($insert_data);die;
	     
	  $this->db->insert('students', $insert_data);
	 ///$this->db->insert_id();
	 //echo $insert_id;die;
	 return $prid;
	 }
	 public function get_school($school){
	     $this->db->select('school_name,school_address,school_address1,school_code');
         $this->db->from('schools');
         $this->db->where('school_code',$school);
         $query = $this->db->get();
         /*echo "<br>". $this->db->last_query();exit;*/
        return $query->result_array();
	 }
	 public function schools(){
	      $this->db->select('school_code');
         $this->db->from('schools');
         $query = $this->db->get();
         echo "<br>". $this->db->last_query();exit;
        return $query->result();
	 }
	 public function get_student($prid){
	     $this->db->select('*');
         $this->db->from('students');
         $this->db->where('PRID',$prid);
         $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result();
	 }
	 public function get_category($product_id){
	     //echo $product_id;die;
	     $this->db->select('*');
         $this->db->from('category');
         $this->db->where('pid',$product_id);
         $query = $this->db->get();
         //echo $this->db->last_query();die;
         
         return $query->result_array();
	 }
	 public function loginCheck($data){
	    $username=$data['user'];
        
        $this->db->select('*');
        $this->db->from('students');
        $this->db->where('prid', $username);
        $query = $this->db->get();
        //echo $this->db->last_query();
//print_r($query);
        $row   = $query->row_array();
       // print_r($row);die;
        if(!empty($row)){
            $agg='yes';
        }
        else{
            $agg='no';
        }
        return $agg;
     
	 }
	    public function insert($pid,$prid){
	       // echo $pid.$prid;die;
	        $this->db->select('period_id');
            $this->db->from('period');
            $this->db->where('status', 'Active');
            $query = $this->db->get();
            $arrrr=$query->result_array();
            $period=$arrrr[0]['period_id'];
           // echo $period;die;
            $this->db->select('*');
            $this->db->from('students');
            $this->db->where('PRID', $prid);
            $query = $this->db->get();
            $arr=$query->result_array();
            $school =$arr[0]['school_code'];
            //echo $school;die;
            $this->db->select('*');
            $this->db->from('price_code');
            $this->db->join('products', 'products.product_id=price_code.product_id');
            $this->db->where('price_code.product_id', $pid);
            $this->db->where('school_code', $school);
            $this->db->where('period_id', $period);
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            $arrr=$query->result_array();
           // print_r($arrr);die;
           // echo $arrr[0]['amount'];die;
            $this->db->select('*');
            $this->db->from('cart');
            $this->db->where('prid', $prid);
            $this->db->where('product_id', $pid);
            $this->db->where('payment_status', "Unpaid");
            $query = $this->db->get();
            $status=$query->result_array();
            // echo $this->db->last_query();die;
            // print_r($status);die;
            if(empty($status)){
	         $insert_data=array(  
			                      'prid'  => $prid, 
								  'product_name'  => $arrr[0]['product_name'],
								  'product_id' => $pid,
								  'amount'   => $arrr[0]['amount'],
								 
								  'class_name'    =>  $arr[0]['class'],
								  'class_id'   =>  $arr[0]['class_key'],
					
								  'price_code'    =>  $arrr[0]['price_code'],
								  'period'=>$period,
								  'payment_status'=>"Unpaid"
								  );
				//print_r($insert_data);die;
				 $this->db->insert('cart', $insert_data);
            }
            // else{
            //     echo 'ok';die;
            // }
			   
	    }

    
        public function insert_cart($params,$prid){
          
            $this->db->select('*');
            $this->db->from('students');
            $this->db->where('PRID',$prid);
            $query = $this->db->get();
            $arr=$query->row_array();
            $school=$arr['school_code'];
            $period=$arr['period_id'];
            
            foreach($params['product'] as $pid){
                // echo $pid;exit;
                $this->db->select('products.product_id,products.product_name,price_code.price_code');
                $this->db->from('price_code');
                $this->db->join('products', 'products.product_id=price_code.product_id');
                //$this->db->join('price_codegenration', 'products.product_id=price_code.product_id');
                $this->db->where('price_code.product_id', $pid);
                //$this->db->where('price_code.school_code', $school);
                //$this->db->where('price_code.period_id', $period);
                
                $query = $this->db->get();
               //echo $this->db->last_query();die;
                $arrr=$query->row_array();
                $product_name = $arrr['product_name'];
                $pricecode = $arrr['price_code'];
              // print_r($pricecode);exit;
                $this->db->select('product_id');
                $this->db->from('cart');
                $this->db->where('prid', $prid);
                $this->db->where('product_id', $pid);
                $query = $this->db->get();
                $pro_id=$query->result();
                // echo $this->db->last_query();die;
                
                //print_r($pro_id);die;
                if(empty($pro_id)){
                    // echo 'ok';die;
                        $price=str_split($pricecode,8)[1];
                        $insert_data=array(  
        			                      'prid'  => $prid, 
        								  'product_name'  => trim($product_name),
        								  'product_id' =>  $pid,
        								//   'amount'   => $arrr['amount'],
        								 
        								  'class_name'    =>  $arr['class'],
        								  'amount'   =>  $price,
        					
        								 'price_code'    =>  trim($pricecode),
        								  'period'=>$period,
        								  'payment_status'=>"Unpaid"
        								  );
        			 	//print_r($insert_data);die;
			    $this->db->insert('cart', $insert_data); 
                }
            }
        }
        public function insert_cart1($params,$prid){
          // print_r($params);echo $prid;die;
            // $this->db->select('*');
            // $this->db->from('class');
            // $this->db->where('class_id', $params['class_id']);
            // $query = $this->db->get();
            // $arr1=$query->result_array();
            // print_r($arr1[0]['class_name']);die;
            $this->db->select('*');
            $this->db->from('students');
            $this->db->where('PRID', $prid);
            $query = $this->db->get();
            $arr=$query->result_array();
            
            
            $school =$arr[0]['school_code'];
            $this->db->select('period_id');
            $this->db->from('period');
            $this->db->where('status', 'Active');
            $query = $this->db->get();
            $arrrr=$query->result_array();
            $period=$arrrr[0]['period_id'];
            
            foreach($params['product'] as $pid){
                // echo $pid;
                $this->db->select('products.product_id,products.product_name,price_code.price_code');
                $this->db->from('price_code');
                $this->db->join('products', 'products.product_id=price_code.product_id');
               // $this->db->join('price_codegenration', 'products.product_id=price_codegenration.price_code');
                $this->db->where('price_code.product_id', $pid);
                $this->db->where('school_code', $school);
                $this->db->where('price_code.period_id', $period);
                
                $query = $this->db->get();
               // echo $this->db->last_query();die;
                $arrr=$query->row_array();
                print_r($arrr);exit;
                $product_name = $arrr['product_name'];
                $pricecode = $arrr['price_code'];
               
                $this->db->select('product_id');
                $this->db->from('cart');
                $this->db->where('prid', $prid);
                $this->db->where('product_id', $pid);
                $query = $this->db->get();
                $pro_id=$query->result();
                // echo $this->db->last_query();die;
                
                $this->db->select('*');
                $this->db->from('comp_level');
                $this->db->where('status', 'Active');
                $query = $this->db->get()->row();
                $level=$query->id;
                // print_r($pro_id);die;
                if(empty($pro_id)){
                    // echo 'ok';die;
                        $price=str_split($pricecode,8)[1];
                        $insert_data=array(  
        			                      'prid'  => $prid, 
        								  'product_name'  => trim($product_name),
        								  'product_id' =>  $pid,
        								//   'amount'   => $arrr['amount'],
        								 
        								  'class_name'    =>  $arr[0]['class'],
        								  'amount'   =>  $price,
        					
        								 'price_code'    =>  trim($pricecode),
        								  'period'=>$period,
        								  'payment_status'=>"Unpaid",
        								  'level' => $level
        								  );
        			//	 	print_r($insert_data);die;
			    $this->db->insert('cart', $insert_data); 
                }
            }
        }
        public function update_cart($prid){
            // echo $prid;die;
         $query1=$this->db->query("UPDATE cart SET payment_status='Paid' WHERE prid='$prid';" );
        }
        public function delete_product($product,$prid,$period){
            $this->db->where('product_name', $product);
            $this->db->where('prid', $prid);
            // $this->db->where('class_name', $class);
            $this->db->where('period', $period);
            $this->db->delete('cart');
            // echo $this->db->last_query();die;
            // $query = $this->db->get();
            // $arr=$query->result_array();
        }
        
        public function cart_data($params){
            
            $this->db->select_sum('amount');
            $this->db->from('cart');
            $this->db->join('period', 'period.period_id=cart.period');
            $this->db->where('period.status', "Active");
            $this->db->where('prid', $params);
            $this->db->where('payment_status', 'Unpaid');
            $query = $this->db->get();
            return $query->result_array();
            
        }
        public function get_student_array($prid){
	     $this->db->select('*');
         $this->db->from('students');
         $this->db->where('PRID',$prid);
         $query = $this->db->get();
         return $query->result_array();
	 }
	 public function subscribe_product($prid){
	     $this->db->select('*');
         $this->db->from('cart');
         $this->db->where('PRID',$prid);
         $this->db->where('payment_status','Paid');
         $query = $this->db->get();
         return $query->result();
	 }
	 public function edit_profile($prid,$params){
	      extract($params);
	      $class=$params['class'];
	     $query1=$this->db->query("select class_name,class_key from class where class_id='$class;'");
	     foreach ($query1->result() as $row)
                            {
                            $stud_class= $row->class_name;
                            $class_key=$row->class_key;
                            }
         // echo $class_key; die;                 
        $insert_data=array(  
			                      'first_name'  => $first_name , 
								  'middle_name'  => $middle_name,
								  'last_name' =>  $last_name,
								  
								  'email'   =>  $email,
					
								  'class_key'    =>  $class_key,
								//   'month'   =>  $month,
								//   'year'     =>  $year ,
								  
								  'class'        =>  	$stud_class  ,
								  'father_name'   => $father_name,
								  
								  'mother_name'  =>  $mother_name,
								 
								  'email'      => $email,
								  'mobile'  => $mobile,
								  'whatsapp'      =>  $whatsapp
								  
								  );
			//	print_r($insert_data);die;
			$this->db->where('prid', $prid);
	        $this->db->update('students', $insert_data);
	 }
	public function cin_login($cin,$pass){
	    $this->db->select('*');
         $this->db->from('cin_list');
         $this->db->where('cin',$cin);
         $this->db->where('password',$pass);
         $query = $this->db->get();
         return $query->result_array();
	}
	
	
	
	 public function get_student1($prid){
	     $this->db->select('*');
         $this->db->from('students');
         $this->db->where('PRID',$prid);
         $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result();
	 }
	 public function get_category1($product_id){
	     //echo $product_id;die;
	     $this->db->select('*');
         $this->db->from('category');
         $this->db->where('pid',$product_id);
         $query = $this->db->get();
         //echo $this->db->last_query();die;
         
         return $query->result_array();
	 }
	 
	 
	 
	 
	 
	  public function get_purchase_competition($prid,$period)
	  {
	      $this->db->select('product_name,period,class_name');
         $this->db->from('cart');
         $this->db->where('prid',$prid);
         $this->db->where('period',$period);
         $query = $this->db->get();
         //echo $this->db->last_query();die;
         
         return $query->result();
	  }
	  public function get_purchase_competition_material($arr){
	     // print_r($arr);die;
	     $array1=array();
	        foreach($arr as $row){
	            //print_r($row);die;
	            $this->db->select('*');
                $this->db->from('study_material');
                $this->db->where('product_name',$row->product_name);
                $this->db->where('clevel','1');
                $this->db->where('class',$row->class_name);
                $this->db->where('period',$row->period);
                $this->db->where('status','Free');
                $query = $this->db->get();
                //echo $this->db->last_query();die;
                 
                 $res= $query->result_array();
                // print_r($res);die;
                 $ar=array(
                     'product'=>$row->product_name,
                     'title'=>$res[0]['title'],
                     'folder'=>$res[0]['folder']
                     );
                //    print_r($ar);die;
                 array_push($array1,$ar);
                // print_r($array1);die;
	        }
	      //  print_r($array1);die;
	      //die;
	      	return $array1;
	  }
	  
	  public function paid_purchase_competition_material($arr){
	       $array1=array();
	        foreach($arr as $row){
	           
	            $this->db->select('*');
                $this->db->from('study_material');
                $this->db->where('product_name',$row->product_name);
                $this->db->where('clevel','1');
                $this->db->where('class',$row->class_name);
                $this->db->where('period',$row->period);
                $this->db->where('status','Paid');
                $query = $this->db->get();
                //echo $this->db->last_query();die;
                 $res= $query->result_array();
                 //print_r($res[0]['price']);die;
                 $ar=array(
                     'product'=>$row->product_name,
                     'title'=>$res[0]['title'],
                     'folder'=>$res[0]['folder'],
                     'price' =>$res[0]['price'],
                     'product_id' =>$row->id 
                     );
                //    print_r($ar);die;
                 array_push($array1,$ar);
               
	        }
	      
	      	return $array1;
	  }
	  
	  public function purchase_material_data($arr,$prid){
	     // print_r($arr);die;
	     $array1=array();
	        foreach($arr as $row){
	           $priod=$row->period;
	           $class_name=$row->class_name;
              // $product_name=$row->product_name;
	        }
	        
	            $this->db->select('product_name');
                $this->db->from('study_material_byprid');
                //$this->db->where('product_name',$product_name);
                $this->db->where('clevel','1');
                //$this->db->where('class',$class_name);
                $this->db->where('period',$priod);
                $this->db->where('prid',$prid);
                $query = $this->db->get();
            //echo $this->db->last_query();die;
                 $res= $query->result_array();
                 //print_r($res[0]['price']);die;
	     
	      	return $res;

	      
	  }
	  
	  public function get_purchase_product_cart($arr,$prid){
	      
	    foreach($arr as $row){
	       // print_r($row);die;
	           $it=explode(" ",$row);
	           //print_r($it);die;
	           $amount=end($it);
	           //echo $amount; die;
	            array_pop($it);
	            
	          $str=implode(" ",$it);
	         // echo $str;die;
                $data=array(
                    'prid'=>$prid,
                    'product_name'=>$str,
                    'amount'=>$amount
                    );
                    
                $this->db->select('*');
                $this->db->from('study_material_purchase');
                $this->db->where('product_name',$str);
                $this->db->where('prid',$prid);
                $this->db->where('amount',$amount);
                $query = $this->db->get();
           // echo $this->db->last_query();die;
                 $res= $query->result_array();
                 
                  if(empty($res)){
                  
	        $this->db->insert('study_material_purchase',$data);
                  }   
	    }
	  
	  }
	  public function delete_material_prid($id){
	      //echo $id;die;
	       $this->db->where('id', $id);
            $this->db->delete('study_material_purchase');
	  }
	  
	  public function stud_material_cart($data){
	      
	     $rozarpay_payment_id=  $data['razorpay_order_id'];
	     $prid =  $data['prid'];
	     $amount = $data['amount'];
	     $this->db->select('*');
         $this->db->from('cart');
		 //print_r($data);   die;
         $this->db->where('prid',$prid);
         $this->db->where('payment_status','Unpaid');
         $query = $this->db->get();   
         $res= $query->result();
		 //print_r($res);exit;  
		  $que_schol=$this->db->get_where('students',array('PRID'=>$prid))->row();
		  $school_code = $que_schol->school_code;
		   $school_id = $que_schol->school_id;
		  $school=$this->db->get_where('school_new',array('school_code'=>$school_code))->row();
		  $franchise_id = $school->area_code;
		  //print_r($franchise_id);exit;
		  $period = $que_schol->period_id;
          $period_year=$this->db->get_where('period',array('period_id'=>$period))->row();	
		  $period_initials  = $period_year->initials;
		 //-----------------cin---------// 
		  
			$area_code =  $school->area_code; 
			//print_r($school_code);exit;
		
         foreach($res as $row){
			 //print_r($row->product_name);exit;  
			 $this->db->select_max('cin_result.cin');
			 $this->db->from('cin_result');
			 $this->db->join('cin_list','cin_result.cin=cin_list.cin');
		     $this->db->where('cin_result.product_name',$row->product_name); 
			 $this->db->where('cin_result.period_id',$period);
			 $this->db->like('cin_list.cin',$area_code);
			 $query = $this->db->get();  
			 $res1= $query->row(); 
			     $cin = $res1->cin;
			if(!empty($cin)){
				 
			 
			 if($row->product_name=='MaRRS International Spelling Bee Junior'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
			      $cin_gen =$period_initials.'SJ'.$area_code; 
				    
			 }elseif($row->product_name=='MaRRS International Spelling Bee'){
			     
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		          $cin_gen =$period_initials.'SB'.$area_code;
				
             }elseif($row->product_name=='MaRRS Play 2 Learn'){	
			      $last=substr($cin,7,11);
				  $last2 = $last+1;
		         $cin_gen =$period_initials.'PL'.$area_code;
				 
		     }elseif($row->product_name=='MaRRS Scientia Exertus'){
		         
				  $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'SE'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS International Math Bee'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MB'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Math'){
				 
				 $last=substr($cin,7,11);
				   $last2 = $last+1;
		        $cin_gen =$period_initials.'PM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Science'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PS'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee English'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PB'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Humanities'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'PH'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Word Chase'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'WC'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Maze of Words'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MW'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Xpress Math'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'XM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - Science'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CS'.$area_code;
		     }
		     elseif($row->product_name=='MaRRS Primary Colors - Math'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - English'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CE'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - Humanities'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'CH'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Math Zoom Zoom Challenge'){
				 
				 $last=substr($cin,7,11);
				  $last2 = $last+1;
		        $cin_gen =$period_initials.'MZ'.$area_code;
		     }
		     
		   
			  $finlcin = $cin_gen.$last2;
			 
			 
            }else{
             
             	 
			 if($row->product_name=='MaRRS International Spelling Bee Junior'){
			     
				  
				  $last2 = '10000';
			      $cin_gen =$period_initials.'SJ'.$area_code; 
				    
			 }elseif($row->product_name=='MaRRS International Spelling Bee'){
			     
				 
				  $last2 = '10000';
		          $cin_gen =$period_initials.'SB'.$area_code;
				
             }elseif($row->product_name=='MaRRS Play 2 Learn'){	
			     
				  $last2 = '10000';
		         $cin_gen =$period_initials.'PL'.$area_code;
				 
		     }elseif($row->product_name=='MaRRS Scientia Exertus'){
		         
				  
				  $last2 = '10000';
		        $cin_gen =$period_initials.'SE'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS International Math Bee'){
				 
				 
				  $last2 = '10000';
		        $cin_gen =$period_initials.'MB'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Math'){
				 
				 
				  $last2 = '10000';
		        $cin_gen =$period_initials.'PM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Science'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'PS'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee English'){
				 
			
				  $last2 = '10000';
		        $cin_gen =$period_initials.'PB'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Preschool Bee Humanities'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'PH'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Word Chase'){
				 
				 
				  $last2 = '10000';
		        $cin_gen =$period_initials.'WC'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Maze of Words'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'MW'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Xpress Math'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'XM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - Science'){
				 
				
				  $last2 ='10000';
		        $cin_gen =$period_initials.'CS'.$area_code;
		     }
		     elseif($row->product_name=='MaRRS Primary Colors - Math'){
				 
			
				  $last2 = '10000';
		        $cin_gen = $period_initials.'CM'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - English'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'CE'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Primary Colors - Humanities'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'CH'.$area_code;
		        
		     }elseif($row->product_name=='MaRRS Math Zoom Zoom Challenge'){
				 
				
				  $last2 = '10000';
		        $cin_gen =$period_initials.'MZ'.$area_code;
		     }
		     
		     
		   
			  $finlcin = $cin_gen.$last2;
		
         }
         
         
         if($row->product_name=='MaRRS Math Zoom Zoom Challenge'){
             $level ='14';
         }else{
              $level ='1';
         }
             $data=array(
                 'prid'=>$prid, 
                  'material_id'=>'',
                 'clevel'=>$level,
                  'product_id'=>$row->product_id,
                 'product_name'=>$row->product_name,
                  'amount'=>$row->amount,
                  'period'=>'13',
                  'payment_status'=>'Success',
                  'rozarpay_payment_id'=>$rozarpay_payment_id,
                  'merchant_order_id'=>$rozarpay_payment_id,
                  
				  'cin'              =>$finlcin
                 
                  );
                 $dataresult=array(
                 'product_name'     =>$row->product_name,
                 'period_id'           =>'13',
                 'clevel'           => $level,
				 'cin'              =>$finlcin
                 
                 );
                 $datacin=array(
                 
                 'password'       => $finlcin,
				 'cin'            =>$finlcin,
				 'Student_name'   =>$que_schol->first_name.$que_schol->last_name,
				 'stud_email'    =>$que_schol->email,
				 'stud_phone'    =>$que_schol->mobile,
				 'class'         =>$que_schol->class,
				 'father_name'   =>$que_schol->father_name,
				 'franchise_code'  =>$school->area_code,
                 'state_id'        =>$school->state,
                 'franchise_id'    =>$school->franchise_id,
                 'school_id'      =>$school->id, 
				 'mother_name'   =>$que_schol->mother_name
                 
                 );
               // print_r($data);die;
                  $this->db->insert('cin_result', $dataresult);
                  $this->db->insert('cin_list', $datacin);
                 
                 $this->db->insert('study_material_byprid', $data);
         
         
         
         $this->db->where('prid', $prid); 
         $this->db->delete('cart');
         
	  }
	  }
	  
}
?>