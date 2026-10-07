 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Welcome extends CI_Controller {
  
	
	public function index()
	{
	    if(isset($_POST['submit'])){
	        //unset($_POST['submit']); 
	        print_r($_POST);echo 'ok';die;
	        $data['student_id']=$this->Index->save_student($_POST);
	        //print_r($data['student_id']);die;
	        
	        $this->session->set_userdata('student_id', $data['student_id']);
            $this->session->set_userdata('details', $_POST);
            // ----------- email ------------  // 
            
	    }
	    $data['school']=$this->Index->schools();
		$this->load->view('index',$data); 
	}
	public function product_cat_pay(){
	    $student_id=$this->session->userdata('student_id');
	    $details=$this->session->userdata('details');
	   // echo $student_id;print_r($details);
	    $this->load->view('offer');
	}
	
	
	 function schoolcode(){
	     if(isset($_POST['check'])){
	        //print_r($_POST['schoolaccesscode']);die;
	        $this->db->select('school_id,school_name,school_address,school_address1,school_code');
    	    $this->db->from('schools');
    	    $this->db->where('school_code',trim($_POST['schoolaccesscode']));
    	    $this->db->where('school_status','Active');
    	    
    	    $res = $this->db->get(); 
    	  //  echo $this->db->last_query();
    	    $result =  $res->row_array();
			if(!empty($result)){
    	   //print_r($result['school_id']);die;
		   $this->session->set_flashdata('school_id',$result['school_id']);
    	   $this->session->set_flashdata('schoolcode',$result['school_code']);
    	   $this->session->set_flashdata('schoolname',$result['school_name']);
    	   $this->session->set_flashdata('schooladdress',$result['school_address']);
    	   $this->session->set_flashdata('schooladdress1',$result['school_address1']);
		   
            redirect('Welcome/index', 'refresh');
			}else{
				$this->session->set_flashdata('schoolerror','School Code Not Valid');
				redirect('Welcome/index', 'refresh');
			}
			
			
	     }
	     if(isset($_POST['conform'])){
	        //print_r($_POST);die;
	       $schoolCode = $this->input->post('schoolaccesscode');
	        if($schoolCode!=''){
	             $this->session->set_userdata('school_code', $schoolCode);
	            redirect('Welcome/offer', 'refresh');
	        }
	        else{
	            $this->session->set_flashdata('schoolerror','Invalid School Access Code, please contact your school.');
            redirect('Welcome/index', 'refresh');
	        }
	     }
	  
	}
	public function offer(){
	    $school_code=$this->session->userdata('school_code');
	    //echo $school_code;die;
	   
	   
	   $data['school']= $this->Index->get_school($school_code);
	     if(isset($_POST['submit'])){
	        
	         
	       //  echo $message;die;
	        //print_r($_POST);die; 
	        //unset($_POST['submit']);  
	      
	       
	       $data['prid']= $this->Index->save_student($_POST,$school_code);
	       $email=$_POST['email'];
	       $from_email = "customerrelations@marrs.in"; 
            $to_email =$email; 
            
       
            
             $message="Hello, congratulations ".$_POST['first_name'].' '.$_POST['middle_name'].' '.$_POST['last_name'].' for registering successfully! <br> Your Participant Registration Number  (PRN) is '.$data['prid'].' . <br> You can log on to the student portal using the PRN as username and password and purchase products.<br> A Candidate Identification Number would be generated for each activity you have registered for .<br> Once this is communicated to you will be able to log on the respective portals and download learning materials.';
            $this->load->library('email'); 
            $this->email->from($from_email, 'MaRRS'); 
            $this->email->to($to_email);
            $this->email->subject('Participent Registration Number'); 
            $this->email->message($message);
            if($this->email->send()) {
             $em= "email sent Email sent successfully.";} 
             else {
             $em= "email sent error in sending Email.";
             }
            //  die;
	        if(!empty($data)){
	            $this->session->set_flashdata('message', $em);
	            $this->session->set_userdata('school_code',$school_code);
	            $this->session->set_userdata('prid',$data['prid']);
                redirect('Welcome/out1', 'refresh');
	        }
	       
	     }
	    
	    $this->load->view('offer.php',$data);
	    
	}
	public function login(){
	    
	    
	    
	    if($this->session->userdata('prid')){
	        $school_code=$this->session->userdata('school_code');
    	    $prid=$this->session->userdata('prid');
    	    //echo $prid.$school_code;die;
    	    $data['student']=$this->Index->get_student($prid);
    	    $this->load->view('prof.php',$data);
	    }else{
	        $message='Invalid Id or Password';
                  $this->session->set_userdata('message', $message);
                  redirect('welcome/student/', 'refresh');
	    }
	    if (isset($_POST['logout'])){
	        //echo 'ok';die;
	        $this->session->unset_userdata('prid');
	        redirect('welcome/student/', 'refresh');
	    }
	    if(isset($_POST['add'])){
	       // print_r($_POST);echo'ok';die;
	       $cart=$this->Index->get_value($_POST);
	      //print_r($cart);die;
	       $this->session->set_userdata('prid', $_POST['prid']);
	       $this->session->set_userdata('message', $_POST['school']);
	      // $this->session->set_userdata('cart', $cart);
	       redirect('welcome/login/', 'refresh');
	    }
	    $prid=$this->session->userdata('prid');
	    if(isset($_POST['delete'])){
	        $arr=$_POST['delete'];
	        $pieces = explode("ok", $arr);
	       // print_r($pieces);die;
	        $category=$pieces[0];
	       $product=$pieces[1];
	       $period=$pieces[2];
	        $this->Index->delete_product($product,$prid,$category,$period);
	    }
	    
	}
	
    public function ajax($id=''){
		  //print_r($_POST);die;
	        $this->Index->insert($_POST['id'],$_POST['prid']);

	}
	
	
	public function student(){
	   // echo 'ok';die;
      
        if (isset($_POST['submit'])) {
           // echo 'ok';
           
            if($_POST['user']!=$_POST['password']){
                  $message='Invalid Id or Password';
                  $this->session->set_flashdata('message', $message);
                  redirect('welcome/student/', 'refresh');
            }
            else{
                $result = $this->Index->loginCheck($_POST);
                 //print_r($result);die;
                if ($result=='yes' ){
                    //print_r($_POST['user']);die;
                    $this->session->set_userdata('prid', $_POST['user']);
                    redirect('welcome/out1/', 'refresh');
                }
            }
        }
        $data['message']=$this->session->userdata('message');
	    $this->load->view('student.php',$data);
	}
	
	public function cart(){
	    if(isset($_POST['add'])){
	       // print_r($_POST);die;
	        $this->Index->get_value($_POST);
	        
	   
	        $this->session->set_userdata('prid', $_POST['prid']);
	        $this->session->set_userdata('message', $_POST['school']);
	      // $this->session->set_userdata('cart', $cart);
	       redirect('welcome/login/', 'refresh');
	    }
	}
	
	   public function pay()
	{
	    
	    $prid  = $_POST['pay'];
	    //print_r($_POST);die; 
	    
		$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
	    if($_POST['amount'] > 0){
		$amount = $_POST['amount'];
		
       
		
		$razorpayOrder = $api->order->create(array(
			'receipt'         => rand(),
			'amount'          => $amount * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture
		));


	

		$razorpayOrderId = $razorpayOrder['id'];
		
		$Pay_array = array(
		
		'razorpay_order_id' => $razorpayOrderId,
		'amount'            => $amount,
		'prid'               => $prid
	
		);
		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);
       
		$this->load->view('verify',array('data' => $data));
	   }else{
	     
	       if(!empty($this->session->userdata('prid'))){
	        $this->load->view('verify');
	        $resutl_cart = $this->db->get_where('cart', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Unpaid'))->result();
	        //print_r($resutl_cart);exit;
	                  if(!empty($resutl_cart)){
	                      
	                      $array = array(
	                          'payment_status' => 'Paid'
	                          );
	                     $this->db->where('prid',$this->session->userdata('prid'));
	                     $updated =  $this->db->update('cart',$array);
	                     redirect(base_url().'welcome/registraion_success_zero/'.$this->session->userdata('prid'));
	                     
	                      
	                  }else{  ?>
	                      
	                    <script>
                	     alert('No item in Cart First Go Add to Cart');
                	     window.location.href="<?php echo base_url('welcome/product_purchase/id/'.$this->session->userdata('prid'));?>";
                	     </script>   
                	                      
                	     <?php 
                	     
                    }   
        
	       }else{
	           
	             redirect(base_url().'welcome/student/');
	       }
        
	              
	   }
	}






      public function registraion_success_zero()
    	{
         $data['prid'] = $this->uri->segment(3);
    
       $this->load->view('registration_success_zero',$data);
       }
	/**
	 * This function verifies the payment,after successful payment
	 */
	public function verify()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		//print_r($order_id);exit;
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
    		try {
    				$attributes = array(
    					'razorpay_order_id' => $order_id,
    					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
    					'razorpay_signature' => $_POST['razorpay_signature']
    				);
    				$api->utility->verifyPaymentSignature($attributes);
    			} 
    		catch(SignatureVerificationError $e) {
    				$success = false;
    				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
			redirect(base_url().'welcome/success'); 
		}
		else {
			redirect(base_url().'welcome/paymentFailed');
		}
	}

	/**
	 * This function preprares payment parameters
	 * @param $amount
	 * @param $razorpayOrderId
	 * @return array 
	 */
	public function prepareData($amount,$razorpayOrderId)
	{
		$data = array(
			"key" => 'rzp_live_UMziCF38129HCi',
			"amount" => $amount,
			"name" => "MaRRS",
			"description" => "",
			"image" => "https://marrs.in/images/marrs-logo.png",
			"prefill" => array(
				"name"  => $this->input->post('name'),
				"email"  => $this->input->post('email'),
				"contact" => $this->input->post('contact'),
			),
			"notes"  => array(
				"address"  => "",
				"merchant_order_id" => rand(),
			),
			"theme"  => array(
				"color"  => "#38aee5"
			),
			"order_id" => $razorpayOrderId,
		);
		return $data;
	}

	/**
	 * This function saves your form data to session,
	 * After successfull payment you can save it to database
	 */
	public function setRegistrationData()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$contact = $this->input->post('contact');
		$amount = $_SESSION['payable_amount'];

		$registrationData = array(
			'order_id' => $_SESSION['razorpay_order_id'],
			'name' => $name,
			'email' => $email,
			'contact' => $contact,
			'amount' => $amount,
		);
		// save this to database

	} 
    public function success() {
      
        $arr=$this->session->userdata('payment_data');
       
        $data['title'] = 'Razorpay Success ';  
       
        $prid=$arr['prid']='22MRREG3238';
        //print_r($arr);die;
       // echo $prid;die;
        $data['session']=$this->session->userdata('payment_data');
        //echo 'ok';print_r($data['session']);die;
        
        $this->Index->stud_material_cart($prid,$data['session']['razorpay_order_id']);
        //die;
        $data['student']=$this->Index->get_student($prid);
        $this->load->view('success', $data);
    }  
    public function failed() {
        $datares = $this->session->userdata('payment_data');
        $data['arr']=$this->session->userdata('payment_data');
        $data['amount']=$datares['amount'];
        $prid= $datares['prid'];
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']=$this->Index->get_student($prid);
        $this->load->view('tranctionfailed', $data);
    } 
	
	public function out2($id=''){
	   $prid=$this->uri->segment(4);
	   $this->session->set_userdata('prid', $prid);
	    redirect('Welcome/out1', 'refresh');
	   //$this->load->view('prof', $data); 
	}
	public function subscribe_product(){
	    $prid=$this->uri->segment(4);
	   //echo $prid;die;
	   $data['prid']=$prid;
	   $data['student']=$this->Index->get_student($prid);
	  // print_r($data);die;
	   $data['student_cart']=$this->Index->subscribe_product($prid);
	   $this->load->view('subscribe_product', $data);
	}
		
	public function product_purchase(){
		    $prid=$this->uri->segment(4);
		  // echo $prid;die;
		   $data['prid']=$prid;
	       $data['student']=$this->Index->get_student($prid);
	        $data['result']=$this->Index->get_result($prid);
	       if(isset($_POST['add'])){
	           //print_r($_POST);die;   
	           if(isset($_POST['product'])){
	               //print_r($_POST);exit;  
	               $this->Index->insert_cart($_POST,$prid);
	           }
	           else{
	                $this->session->set_flashdata('message', 'Check Product List'); 
	           }
	           //$this->Index->insert_cart($_POST,$prid);
	       }
	       if(isset($_POST['delete'])){
	        
	           $arr=$_POST['delete'];
	           $pieces = explode("ok", $arr);
	           $product=$pieces[0];
	           $period=$pieces[1];
	           $this->Index->delete_product($product,$prid,$period);
	       }
		   $this->load->view('product_purchase', $data); 
		}
	public function logout(){
	    $this->session->unset_userdata('prid');
	    redirect('welcome/student/', 'refresh');
	}
	public function out1(){
	    if(isset($_POST['edit'])){
	        //print_r($_POST['edit']);die;
	        $this->session->set_userdata('prid', $_POST['edit']);
	        redirect('welcome/edit_profile/', 'refresh');
	    }
	        $school_code=$this->session->userdata('school_code');
    	    $data['prid']=$this->session->userdata('prid');
    	     $prid=$this->session->userdata('prid');
    	  //  echo $prid.$school_code;die;
    	    $data['student']=$this->Index->get_student($prid);
    	    foreach ($data['student'] as $row){
                $school=$row->school_code;
    	    }
    	   $this->load->view('prof', $data); 
	    }
	public function edit_profile(){
	    $prid=$this->session->userdata('prid');
	    //echo $prid;die;
	     $data['student']=$this->Index->get_student($prid);
	     
	     $students=$this->Index->get_student($prid);
	     foreach ($students as $row){
            $school=$row->school_code;
	     }

	     if(isset($_POST['submit'])){
	       // print_r($_POST);echo 'ok';die;
	       $this->Index->edit_profile($prid,$_POST);
	        $this->session->set_userdata('school_code', $school);
	       $this->session->set_userdata('prid', $prid);
	       redirect('welcome/out1/', 'refresh');
	    }
	    $this->load->view('edit_profile', $data);
	}
	
	public function not(){
	     $prid=$this->uri->segment(4);
		 //echo $prid;die;
		   $data['prid']=$prid;
	       $data['student']=$this->Index->get_student1($prid);
	      
	       $active=$this->Index->active_level();
	      // print_r($active);exit;
	       $status=$active['id'];
	       
	       if($status>1){
	           $data['result']=$this->Index->get_result1($prid,$status);
	          
	       }
	       else{
	         
	           $status=2;
	           $data['result']=$this->Index->get_result1($prid,$status);
	       }
	       
	      // print_r($data['result']);die;
	      // $data['product']=$this->Index->get_product($prid,$status);
	       //print_r($data['product']);die;
	       if(isset($_POST['add'])){
	          // print_r($_POST);die;
	           if(isset($_POST['product'])){
	          // print_r($_POST);exit;
	               $this->student_level->insert_cart1($_POST,$prid);
	           }
	          
	          if(isset($_POST['study_product'])){
	                 foreach($_POST['study_product'] as $pid){
    	            $this->db->select('*');
                    $this->db->from('study_material');
                    $this->db->where('id', $pid);
                    $this->db->where('clevel','2');
                    $query = $this->db->get();
                    //$this->db->last_query();die;
                    $arrr=$query->row_array();
                   //print_r($arrr);exit;
                
             $insert_data=array(  
        			                      'prid'  => $prid, 
        			                      'study_material_id' =>$pid,
        								  'product_name'  => $arrr['title'],
        								  'product_id' =>  $arrr['product_id'],
        								  'amount'   =>  $arrr['price'],
        								  'class_name'    => 'Nursery',
        								  'period'=>'12',
        								  'payment_status'=>"Unpaid",
        								  'level' => $arrr['clevel']
        								  );
        				 //	print_r($insert_data);die;
			    $this->db->insert('cart', $insert_data);
	           }
	          }
	            if(isset($_POST['orentation_product'])){
	                 foreach($_POST['orentation_product'] as $pid){
    	            $this->db->select('*');
                    $this->db->from('orentation_level');
                    $this->db->where('id', $pid);
                    $this->db->where('clevel','2');
                    $query = $this->db->get();
                    //$this->db->last_query();die;
                    $arrr=$query->row_array();
                   //print_r($arrr);exit;
                
             $insert_data=array(  
        			                      'prid'  => $prid, 
        			                      'orentatio_id' =>$pid,
        								  'product_name'  => $arrr['orentation_title'],
        								  'product_id' =>  $arrr['product_id'],
        								  'amount'   =>  $arrr['price'],
        								  'class_name'    => 'Nursery',
        								  'period'=>'12',
        								  'payment_status'=>"Unpaid",
        								  'level' => $arrr['clevel']
        								  );
        				 //	print_r($insert_data);die;
			    $this->db->insert('cart', $insert_data);
	           }
	          }
	           
	           
	           //$this->Index->insert_cart($_POST,$prid);
	       }
	       if(isset($_POST['delete'])){
	        
	           $arr=$_POST['delete'];
	           $pieces = explode("ok", $arr);
	           $product=$pieces[0];
	           $period=$pieces[1];
	           $this->Index->delete_product($product,$prid,$period);
	       }
		   $this->load->view('product_test', $data);
	    }
	
	public function statelevel(){
	     $prid=$this->uri->segment(4);
		 //echo $prid;die;
		   $data['prid']=$prid;
	       $data['student']=$this->Index->get_student1($prid);
	       
	       $active=$this->Index->active_level();
	       $status=$active[0]['id'];
	       
	       if($status>1){
	           $data['result']=$this->Index->get_result1($prid,$status);
	       }
	       else{
	           $status=2;
	           $data['result']=$this->Index->get_result1($prid,$status);
	       }
	       
	       //print_r($data['result']);die;
	      // $data['product']=$this->Index->get_product($prid,$status);
	       //print_r($data['product']);die;
	       if(isset($_POST['add'])){
	           //print_r($_POST);die;
	           if(isset($_POST['product'])){
	          // print_r($_POST);exit;
	               $this->student_level->insert_cartstate($_POST,$prid);
	           }
	           else{
	                $this->session->set_flashdata('message', 'Check Product List'); 
	           }
	           //$this->Index->insert_cart($_POST,$prid);
	       }
	       if(isset($_POST['delete'])){
	        
	           $arr=$_POST['delete'];
	           $pieces = explode("ok", $arr);
	           $product=$pieces[0];
	           $period=$pieces[1];
	           $this->Index->delete_product($product,$prid,$period);
	       }
		   $this->load->view('product_test_statelevel', $data);
	    }
	
	public function nationallevel(){
	     $prid=$this->uri->segment(4);
		 //echo $prid;die;
		   $data['prid']=$prid;
	       $data['student']=$this->Index->get_student1($prid);
	       
	       $active=$this->Index->active_level();
	       $status=$active[0]['id'];
	       
	       if($status>1){
	           $data['result']=$this->Index->get_result1($prid,$status);
	       }
	       else{
	           $status=2;
	           $data['result']=$this->Index->get_result1($prid,$status);
	       }
	       
	       //print_r($data['result']);die;
	      // $data['product']=$this->Index->get_product($prid,$status);
	       //print_r($data['product']);die;
	       if(isset($_POST['add'])){
	           //print_r($_POST);die;
	           if(isset($_POST['product'])){
	          // print_r($_POST);exit;
	               $this->student_level->insert_cartnational($_POST,$prid);
	           }
	           else{
	                $this->session->set_flashdata('message', 'Check Product List'); 
	           }
	           //$this->Index->insert_cart($_POST,$prid);
	       }
	       if(isset($_POST['delete'])){
	        
	           $arr=$_POST['delete'];
	           $pieces = explode("ok", $arr);
	           $product=$pieces[0];
	           $period=$pieces[1];
	           $this->Index->delete_product($product,$prid,$period);
	       }
		   $this->load->view('product_test_nationallevel', $data);
	    }  
	    
	    
	    public function studymaterial()
	    {
	       $prid=$this->uri->segment(4);
		   $data['prid']=$prid;
		   $data['list']=$this->Index->get_purchase_competition($prid,'12');
		   $data['paidmaterialdata']=$this->Index->paid_purchase_competition_material($data['list']);
		   $data['student']=$this->Index->get_student($prid);
		   
	        if(isset($_POST['add']) && !empty($_POST['check']))
	        {
	            //print_r($_POST['check']);die;
	            $this->Index->get_purchase_product_cart($_POST['check'],$prid);
	        }
	      
	        
	        if(isset($_POST['delete'])){
	            //print_r($_POST['delete']);die;
	           $this->Index->delete_material_prid($_POST['delete']);
	       }
	        
	        
	        //print( $data['list']);exit;
	        $data['materialdata']=$this->Index->get_purchase_competition_material($data['list']);
	        $data['purchasematerialdata']=$this->Index->purchase_material_data($data['list'],$prid);
	        
	        $this->load->view('studymaterial',$data);
	    }
	    
	    public function free_material(){
	           
	            $folder= $this->uri->segment(4);
                $filepath="../study_material_free/".$folder;
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                flush(); // Flush system output buffer
                readfile($filepath);
                die();
               
        
    }
	     public function paid_material(){
	           
	            $folder= $this->uri->segment(3);
	           // echo $folder;die;
                $filepath="../study_material_paid/".$folder;
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                flush(); // Flush system output buffer
                readfile($filepath);
                die();
               
        
    }
	    
	    
	    
	    public function commonLogin()
	    {
	        if(isset($_POST['submit'])){
            $code = $this->input->post('code');
          //print_r($code);exit; 
            
            
                $franchise_code = $this->db->get_where('franchise', array('username' => $code))->row_array();
                
                $admin_code = $this->db->get_where('admin_user', array('username' => $code))->row_array();
                
                $zoomacess_code = $this->db->get_where('franchise_to_zoomzoom', array('zoomzoom_access_code' => $code))->row_array();
                
                 $marrsacess_code = $this->db->get_where('schools', array('school_code' => $code))->row_array();
            
                $result_prid     = $this->db->get_where('students', array('prid' => $code))->row_array();
             
                $result_cin    = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
                 
               $zoomzoom_prid = $this->db->get_where('student_to_zoomzoom', array('zoomzoom_prid' => $code))->row_array();
			   
			   $result_email    = $this->db->get_where('cin_list', array('stud_email' => $code))->row_array();
             
            if(!empty($marrsacess_code)){
                
                   redirect('welcome');
                
            }elseif(!empty($zoomacess_code)){
                
                   redirect('zoomzoom');
                
            }elseif(!empty($admin_code)){
                
                      redirect('https://marrs.in/franchiselogin/manage/login');   
                       
             }elseif(!empty($franchise_code)){
                
                      redirect('https://marrs.in/franchiselogin/franchise/index');   
                       
             }elseif(!empty($result_cin)){
                
                
                 $data['data'] = $result_cin['cin']; 
                        if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
                        {
                            $this->session->set_userdata('cin', $result_cin['cin']);
                            redirect('cin_login/index');   
                            
                        }  
                
             }elseif(!empty($result_prid)){
                
                        
                        $data['data'] = $result_prid['PRID']; 
                        if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
                        {
                            $this->session->set_userdata('prid',  $result_prid['PRID']);
                            redirect('welcome/out1');   
                            
                        }    
             
            }elseif(!empty($zoomzoom_prid)){
               
                        $data['data'] = $zoomzoom_prid['zoomzoom_prid']; 
                        if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
                        {
                            $this->session->set_userdata('id', $zoomzoom_prid['zoomzoom_prid']);
                            redirect('zoomzoom/profile_zoom');   
                        }
                
                
                
            }elseif(!empty($result_email)){
               
                        $data['data1'] = $result_email['stud_email'];   
                        if(!empty($this->input->post('code')))
                        {
                
                          			 $this->session->set_userdata('email',$this->input->post('code')); 
									 if(empty($this->input->post('password'))){
								     $otp= mt_rand(100000, 999999); 
									 $this->session->set_userdata('otp',$otp);
									 
									 }
									 $message='Your Valid OTP 5 Minutes : '.$otp;  
									 $this->load->library('email');          
								 		
									$this->email->from('enquiry@marrs.in', 'MaRRS');   
									$to_email = $this->input->post('code');	         
									$this->email->to($to_email);   
									$this->email->subject('Participent Registration Number');  
									$this->email->message($message);
									if($this->email->send()){
									 $this->session->set_flashdata('verify', 'Email Verification link sent on email Successfully.');
										} 
										else
										{
										 $this->session->set_flashdata('error', 'Email Not Valid .');	  		 
										}
			                    
			                    if($this->input->post('password')==$this->session->userdata('otp'))
								{
									
									redirect('welcome/list_cinproductdata');   
								}


							   
                        }
                
                
                
            }else{
                $this->session->set_flashdata('schoolerror', 'Enter Wrong Id.');
                 redirect('welcome/commonLogin', 'refresh');
            }
          
        } 
	        
	        
	        
	     $this->load->view('commonlogin',$data);   
	    }
	    
	    
	public function list_cinproductdata($id=''){
		 $code= $this->session->userdata('email'); 
          
		  $this->db->select('*');
		  $this->db->from('cin_list');
		  $this->db->join('cin_result','cin_result.cin=cin_list.cin','left');
		  $this->db->where('stud_email',$code);
		  $res = $this->db->get();
		 
		 $data['student'] = $res->result_array();
		 //print_r($res->result_array());exit; 
		$this->load->view('list_cinproductdata',$data);  
	}
		
		
		
		
	 public function get_access_code($id=''){
	    $id = $_POST['school_id'];
		 //print_r($id);exit; 
		 $sc = $this->db->get_where('schools',array('school_id'=>$id))->row(); 
          print_r($sc->school_code); 
		 
	}   
	
}
?>