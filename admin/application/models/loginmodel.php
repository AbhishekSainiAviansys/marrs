<?php
class loginModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
   public function loginCheck($username,$password)
    {
		
			 
	
// 		echo $password;
				// $username = $this->input->post('username');
				// $password = $this->input->post('password');
				$this->db->select('*');
				$this->db->from('admin_user');
				$this->db->where(array(
					'username' => $username,
					'status' => 'Active',
					'password'=>$password
				));
				$query = $this->db->get();
				//  echo $this->db->last_query();exit;
				$row   = $query->row_array();
				if ($query->num_rows() > 0 && $this->encrypt->decode($row['password'], ENC_KEY) == $password)
				{
					$agent = $this->input->user_agent();
					$ip    = $this->input->ip_address();
					$data  = array(
						'user_id' => $row['user_id'],
						'user_agent' => $agent,
						'user_type' => 'admin',
						'ip' => $ip
					);
					$str   = $this->db->insert('userlog', $data);
					return $row;
        }
        else
            return $row;
    }
	
	
	
	public function result_check($csv_result_array,$schedule,$subject,$series)
	{
	    // echo "<pre>";
	    // print_r($schedule);
	    // echo 'oj';die;
	    
	    extract($csv_result_array);
        // echo "<pre>";print_r($csv_result_array);echo 'ok';exit;
    
        $insert_result_OK         =  'no';
        
        
        $status                   =  trim($status);
        $clevel                   =  trim($clevel);
        $venue                    =  trim($venue) ?? null;
        $search_period            =  trim($search_period);
        $search_level             =  trim($search_level);
        $search_product           =  trim($search_product);
        $competition_date         =  trim($competition_date);
        $cin                      =  trim($cin);
        $result                   =  trim($result);
        $period_id                =  trim($period_id);
        $level_id                 =  trim($level_id);
        $product_id               =  trim($product_id);
        $grade                    =  trim($grade);
        $rank                     =  trim($rank);
        $marks                    =  trim($marks);
        $performer                =  trim($performer);
        $speller                  =  trim($speller);
        $student                  =  $this->db->get_where('cin_list',array('cin'=>$cin))->row_array();
        
        // print_R($student);die;
         
        // ================================================================= //
        // echo $cin.'-'.$period_id;die;
    
        if(!empty($student))
        {
    	    $products = $this->db->get_where('products',array('product_id'=>$search_product))->row_array();
    	    // print_r($products['product_name']);
    	    // echo "not empty ";exit;
            $this->db->select('*');
		    $this->db->from('cin_result');
		    $this->db->where('cin',$cin);
		    $this->db->where('product_name',$products['product_name']);
		    // $this->db->order_by('level_id','ASC');
		    $query = $this->db->get();
		    // echo $this->db->last_query();die;
		    $product_details=$query->row_array();
		    // echo $search_product;
		    // print_R($product_details['product_name']);die;
        		    
    	      
    	      
            if(empty($product_details))
    	    {
    		    //	echo 'empty';die;
                if($search_level==1)
    		    {
    		    
    		
    		        $this->db->select('status');
        		    $this->db->from('cin_result');
         		    $this->db->where('product_name',$products['product_name']);
        		    $this->db->where('cin',$cin);
        		    $this->db->where('clevel',$search_level);
        		 
        		    $query = $this->db->get();
        		
        		    //echo $this->db->last_query();die;
        		    $result_array=$query->row_array();
        		    // print_r($result_array['status']);die;
        		    if(!empty($result_array['status']))
        		    {
        		        $insert_result_OK="no";
         	           //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
        		        $csv_result_LOG_array = array($cin,'Stud-Product : '.$products['product_name'],$status," Error : Result Already Exist.");
        		    }else{
        		        // echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
            		        
            		    $insert_result_OK="yes";
    		 
    	            }
    	            
    		    }
    	    }
    	    else
    	    {
	            // echo 'ok';die;

	            $this->db->select('status');
        	    $this->db->from('cin_result');
         		$this->db->where('product_name',$products['product_name']);
        	    $this->db->where('cin',$cin);
        		$this->db->where('clevel',$search_level);
        		 
        		$query = $this->db->get();
        		
        		//echo $this->db->last_query();die;
        		$result_array=$query->row_array();
        		// print_r($result_array['status']);die;
        		if(!empty($result_array['status'])){
        		     $insert_result_OK="no";
         	           //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
        		        $csv_result_LOG_array = array($cin,'Stud-Product : '.$products['product_name'],$status," Error : Result Already Exist.");
        		}else{
        		     // echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
                    $insert_result_OK="yes";
                  	 
	            }
            }
        //echo $insert_result_OK.'ok';die;
        }
        else
        {
            $insert_result_OK="no";
            //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
            $csv_result_LOG_array = array($cin,'Stud-Not Found : '.$products['product_name'],$status," Error : Student Not Exist.");
        }
      
        /*..............................................................................*/
        /*  STEP 6 : $insert_result_OK="yes" then insert result into result table       */
        /*..............................................................................*/
	
        if($insert_result_OK=="yes")
    	{
    	    
    	        $ins_array  = array(	
                        'cin'                     => $cin,
						'clevel'                  => $clevel,
						'period_id'               => $period_id,
						'status'                  => $status,
						'product_id'              => $search_product,
						'grade'                   => $grade,
					    'rank'                    => $rank,
					    'performer'               => $performer,
					    'speller'                 => $speller,
					    'marks'                   => $marks,
					    'product_name'            => $products['product_name'],
					    'competition_schedule_id' => $schedule['competition_schedule_id'],
					    'competition_date'        => $competition_date ?? null,
					    'venue'                   => $venue ?? null
	                );
        						
        	   // echo"<pre>"."inserted array";print_r($ins_array);exit;	
            
         		/*---------------------------------------------------------------*/
        		/* 1) INSERT result in sb_student_result*/	
        		/*---------------------------------------------------------------*/	
        				
        		if($products['product_name']=='MaRRS Lunar Olympiads'){
        		    $ins_array['subject'] = $subject;
        		    $ins_array['series'] = $series;
        		    $ins_status = $this->db->insert('lunar_cin_result',$ins_array);
        		}
        		else
        		{		
        			$ins_status = $this->db->insert('cin_result',$ins_array);
        		}	
        			
        			if(!$ins_status)
        			{  
        			    $csv_result_LOG_array  = array($cin,$period_id,$status," Unknown Error : Result not uploaded(Query : ".$update_qry.")");
        			}/*End of if $update_status */
        			else
        			{ 
        			    $csv_result_LOG_array  = array($cin,$period_id,$status," Success : Result uploaded "); 
        			}/* End of else */
        							
        	 } /* END OF if($insert_result_OK=="yes") */	
	    
	    
	    return $csv_result_LOG_array;
	}

    public function result_checkfranchise($csv_result_array,$schedule,$subject,$series)
	{
	    // echo "<pre>";
	    // print_r($schedule);
	    // echo 'oj';die;
	    
	    extract($csv_result_array);
        // echo "<pre>";print_r($csv_result_array);echo 'ok';exit;
    
        $insert_result_OK         =  'no';
        
        
        $status                   =  trim($status);
        $clevel                   =  trim($clevel);
        $venue                    =  trim($venue) ?? null;
        $search_period            =  trim($search_period);
        $search_level             =  trim($search_level);
        $search_product           =  trim($search_product);
        $competition_date         =  trim($competition_date);
        $cin                      =  trim($cin);
        $result                   =  trim($result);
        $period_id                =  trim($period_id);
        $level_id                 =  trim($level_id);
        $product_id               =  trim($product_id);
        $grade                    =  trim($grade);
        $rank                     =  trim($rank);
        $marks                    =  trim($marks);
        $performer                =  trim($performer);
        $speller                  =  trim($speller);
        $student                  =  $this->db->get_where('cin_list',array('cin'=>$cin))->row_array();
        
        // print_R($student);die;
         
        // ================================================================= //
        // echo $cin.'-'.$period_id;die;
    
        if(!empty($student))
        {
    	    $products = $this->db->get_where('products',array('product_id'=>$search_product))->row_array();
    	    // print_r($products['product_name']);
    	    // echo "not empty ";exit;
            $this->db->select('*');
		    $this->db->from('cin_result');
		    $this->db->where('cin',$cin);
		    $this->db->where('product_name',$products['product_name']);
		    // $this->db->order_by('level_id','ASC');
		    $query = $this->db->get();
		    // echo $this->db->last_query();die;
		    $product_details=$query->row_array();
		    // echo $search_product;
		    // print_R($product_details['product_name']);die;
        		    
    	      
    	      
            if(empty($product_details))
    	    {
    		    //	echo 'empty';die;
                if($search_level==1)
    		    {
    		    
    		
    		        $this->db->select('status');
        		    $this->db->from('cin_result');
         		    $this->db->where('product_name',$products['product_name']);
        		    $this->db->where('cin',$cin);
        		    $this->db->where('clevel',$search_level);
        		 
        		    $query = $this->db->get();
        		
        		    //echo $this->db->last_query();die;
        		    $result_array=$query->row_array();
        		    // print_r($result_array['status']);die;
        		    if(!empty($result_array['status']))
        		    {
        		        $insert_result_OK="no";
         	           //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
        		        $csv_result_LOG_array = array($cin,'Stud-Product : '.$products['product_name'],$status," Error : Result Already Exist.");
        		    }else{
        		        // echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
            		        
            		    $insert_result_OK="yes";
    		 
    	            }
    	            
    		    }
    	    }
    	    else
    	    {
	            // echo 'ok';die;

	            $this->db->select('status');
        	    $this->db->from('cin_result');
         		$this->db->where('product_name',$products['product_name']);
        	    $this->db->where('cin',$cin);
        		$this->db->where('clevel',$search_level);
        		 
        		$query = $this->db->get();
        		
        		//echo $this->db->last_query();die;
        		$result_array=$query->row_array();
        		// print_r($result_array['status']);die;
        		if(!empty($result_array['status'])){
        		     $insert_result_OK="no";
         	           //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
        		        $csv_result_LOG_array = array($cin,'Stud-Product : '.$products['product_name'],$status," Error : Result Already Exist.");
        		}else{
        		     // echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
                    $insert_result_OK="yes";
                  	 
	            }
            }
        //echo $insert_result_OK.'ok';die;
        }
        else
        {
            $insert_result_OK="no";
            //echo "<pre>";print_r($csv_result_array);echo 'oook';exit;
            $csv_result_LOG_array = array($cin,'Stud-Not Found : '.$products['product_name'],$status," Error : Student Not Exist.");
        }
      
        /*..............................................................................*/
        /*  STEP 6 : $insert_result_OK="yes" then insert result into result table       */
        /*..............................................................................*/
	
        if($insert_result_OK=="yes")
    	{
    	    
    	        $ins_array  = array(	
                        'cin'                     => $cin,
						'clevel'                  => $clevel,
						'period_id'               => $period_id,
						'status'                  => $status,
						'product_id'              => $search_product,
						'grade'                   => $grade,
					    'rank'                    => $rank,
					    'performer'               => $performer,
					    'speller'                 => $speller,
					    'marks'                   => $marks,
					    'product_name'            => $products['product_name'],
					   // 'competition_schedule_id' => $schedule['competition_schedule_id'],
					    'competition_date'        => $competition_date ?? null,
					    'venue'                   => $venue ?? null
	                );
        						
        	   // echo"<pre>"."inserted array";print_r($ins_array);exit;	
            
         		/*---------------------------------------------------------------*/
        		/* 1) INSERT result in sb_student_result*/	
        		/*---------------------------------------------------------------*/	
        				
        		if($products['product_name']=='MaRRS Lunar Olympiads'){
        		    $ins_array['subject'] = $subject;
        		    $ins_array['series'] = $series;
        		    $ins_status = $this->db->insert('lunar_cin_result',$ins_array);
        		}
        		else
        		{		
        			$ins_status = $this->db->insert('cin_result',$ins_array);
        		}	
        			
        			if(!$ins_status)
        			{  
        			    $csv_result_LOG_array  = array($cin,$period_id,$status," Unknown Error : Result not uploaded(Query : ".$update_qry.")");
        			}/*End of if $update_status */
        			else
        			{ 
        			    $csv_result_LOG_array  = array($cin,$period_id,$status," Success : Result uploaded "); 
        			}/* End of else */
        							
        	 } /* END OF if($insert_result_OK=="yes") */	
	    
	    
	    return $csv_result_LOG_array;
	}


}

?>
