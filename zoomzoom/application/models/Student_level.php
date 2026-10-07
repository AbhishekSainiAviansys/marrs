<?php
class Student_level extends CI_Model {
    function __construct()
	 {
        parent::__construct();
        $this->load->database();$this->load->library('encrypt');
		
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
               //his->db->join('price_codegenration', 'price_codegenration.price_code=price_code.price_code');
                $this->db->where('price_code.product_id', $pid);
                $this->db->where('school_code', $school);
                $this->db->where('price_code.period_id', $period);
                $this->db->where('price_code.level','2');
                $query = $this->db->get();
                //$this->db->last_query();die;
                $arrr=$query->row_array();
              //print_r($arrr);exit;
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
	 
	   public function insert_cartstate($params,$prid){
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
               //his->db->join('price_codegenration', 'price_codegenration.price_code=price_code.price_code');
                $this->db->where('price_code.product_id', $pid);
                $this->db->where('school_code', $school);
                $this->db->where('price_code.period_id', $period);
                $this->db->where('price_code.level','3');
                $query = $this->db->get();
                //$this->db->last_query();die;
                $arrr=$query->row_array();
              //print_r($arrr);exit;
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
	 
	   public function insert_cartnational($params,$prid){
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
               //his->db->join('price_codegenration', 'price_codegenration.price_code=price_code.price_code');
                $this->db->where('price_code.product_id', $pid);
                $this->db->where('school_code', $school);
                $this->db->where('price_code.period_id', $period);
                $this->db->where('price_code.level','4');
                $query = $this->db->get();
                //$this->db->last_query();die;
                $arrr=$query->row_array();
              //print_r($arrr);exit;
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
        
        
      
	   public function insert_material_cart($params,$prid){
         
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
               //his->db->join('price_codegenration', 'price_codegenration.price_code=price_code.price_code');
                $this->db->where('price_code.product_id', $pid);
                $this->db->where('school_code', $school);
                $this->db->where('price_code.period_id', $period);
                $this->db->where('price_code.level','2');
                $query = $this->db->get();
                //$this->db->last_query();die;
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
         public function delete_product($product,$prid){
            $this->db->where('id', $product);
            $this->db->where('prid', $prid);
            // $this->db->where('class_name', $class);
           // $this->db->where('period', $period);
            $this->db->delete('study_material_byprid');
            // echo $this->db->last_query();die;
            // $query = $this->db->get();
            // $arr=$query->result_array();
        }
        
        
        
}