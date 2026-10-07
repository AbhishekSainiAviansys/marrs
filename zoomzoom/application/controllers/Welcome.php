<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
// echo 'ok';die; 
class Welcome extends CI_Controller {
    
    public function __construct() {
         parent::__construct();
		
		
       
// 	    $this->load->helper('url');
// 		//$this->load->library('encrypt');
 		$this->load->library('email');
// 		$this->load->library('form_validation');
//       // $this->load->library('form-validation'); 
 		$this->load->library('session');
//         $this->load->library('upload');
     $this->load->model('Index');
//          $this->load->model('student_level');
   }

	
    	public function index()
    	{
	    
	       // echo $this->session->userdata('cin').'zomzzomm';die;
	        if($this->session->userdata('cin')){
	             redirect('https://marrs.in/zoomzoom/cin_login'); 
	        }
    	    else{
    	         redirect('https://marrs.in/'); 
    	    }
    	}
    	
    	
    	public function reg()
    	{
    	    if($this->session->userdata('registration_code')){
    	        
    	        $registration_code= $this->session->userdata('registration_code');
    	        
    	       // echo $registration_code;die;
    	        
    	        $data['result'] = $this->db
                    ->select('zoomzoom_schedule_cin.*') // Selects all columns; adjust as needed
                    ->from('zoomzoom_schedule_cin')
                    ->join('period', 'period.period_id = zoomzoom_schedule_cin.period_id','left')
                    ->join('faq_zoomzoom', 'faq_zoomzoom.zoomzoom_schedule_id = zoomzoom_schedule_cin.zoomzoom_schedule_id', 'left')
                    ->where('zoomzoom_schedule_cin.registration_code', $this->session->userdata('registration_code'))
                    
                    ->get()
                    ->row();
                    
                // echo $this->db->last_query();

                if(isset($_POST['submit'])){
                    
                    $this->db->select('*');
                    $this->db->from('zoomzoom_prid');
                    //$this->db->where('sch_id', $this->session->userdata('registration_code'));
                    $this->db->where('email',$_POST['email']);
                    $query = $this->db->get();
                    $prido = $query->row();
                    
                     //print_r($prido);die;   
                    
                    if(!empty($prido)){
                        
                            $period_id=$data['result']->period_id;
                            
                            $res = $this->db->get_where('period', array('period_id' => $period_id))->row();

                            $initials=$res->initials;
                            
                            $res = $this->db->get_where('zoomzoom_schedule_cin', array('registration_code' => $this->session->userdata('registration_code')))->row();

                            $sch_id=$res->zoomzoom_schedule_id;
                            
                            
                            $this->db->select('prid');
                            $this->db->from('zoomzoom_prid');
                            // $this->db->where('period_id', $period_id);
                            // $this->db->where('sch_id',$sch_id);
                            $this->db->order_by('zoomzoom_prid_id', 'DESC');
                            $query = $this->db->get();
                            $prido = $query->row();
                            
                            $prido = $prido ? $prido->prid : null;
                            
                            //print_r($prido);die;
                            // echo $this->db->last_query();die;
                            
                            if ($prido !='') {
                                $p=explode('ZZREG',$prido);
                                $prido_number=$p[1];
                                // $prido_number = (int)substr($prido, 6);
                                
                                $prido_number++; // Increment by 1
                                $prid = $initials . 'ZZREG' . $prido_number;
                            } else {
                                // Set default `prid` if `$prido` is empty
                                $prid = $initials . 'ZZREG' . '500000';
                            }
                            
                             //echo $prid;die;
                            
                            $ar=array(
                                'name'=>$_POST['student_name'],
                                // 'school'=>$_POST['school_name'],
                                'school_id'=>$_POST['school_id'] ?? '',
                                'father_name'=>$_POST['father_name'],
                                'mother_name'=>$_POST['mother_name'],
                                'class'=>$_POST['class'],
                                'sch_id'=>$data['result']->zoomzoom_schedule_id,
                                'email'=>$_POST['email'],
                                'period_id'=>$period_id,
                                'address1'=>$_POST['address'],
                                'mobile'=>$_POST['mobile'],
                                // 'school_code'=>$this->session->userdata('school_code'),
                                'gender'=>$_POST['gender'],
                                'prid'=>$prid,
                                'created_date'=> date('Y-m-d'),
                                'level'=>$data['result']->level_id,
                                'state_id'=>$_POST['state'],
                                'district_code'=>$_POST['district'],
                                // 'prid'=>$prid
                            );
                             //echo '<pre>';    
                             //print_R($ar);die;
                            $this->db->insert('zoomzoom_prid',$ar);
                            
                            $this->session->set_userdata('prid',$prid);
                            redirect('welcome/registration_log');  
                    }else{
                        $data['message']='Already Registered';
                    }       
                    
                }
                
                //$data['faq'] = $this->db->get_where('faq_zoomzoom',array('zoomzoom_schedule_id'=>$data['result']->zoomzoom_schedule_id))->result();
                //print_r($data['faq']);die;
                $this->load->view('open_register_form',$data);
    		 }else{
    		     redirect('https://marrs.in/');
    		 }
    	}
    	
    	public function get_districts()
        {
            $state_id = $this->input->post('state_id');
            if (!empty($state_id)) {
                $query = $this->db->query("SELECT * FROM districts WHERE state_id = ?", array($state_id));
                $districts = $query->result();
                
                foreach ($districts as $district) {
                    echo '<option value="' . $district->id . '">' . $district->district_name . '</option>';
                }
            } else {
                echo '<option value="">-- Select District --</option>';
            }
        }

    	public function registration_log()
        {
        
            if(!empty($this->session->userdata('prid'))){
               
                $data['student']=$student= $this->db->get_where('zoomzoom_prid',array('prid'=>$this->session->userdata('prid')))->row();
                
                 //print_r($data['student']);die;
                // echo $this->db->last_query();die;
                
                $data['schedule']=$schedule= $this->db->get_where('zoomzoom_schedule_cin',array('zoomzoom_schedule_id'=>$student->sch_id))->row();
                
                // echo $this->db->last_query();die;
               // print_r($schedule);die;
                
                
                if(!empty($student)){   
                    
                    print_r($schedule->material);
                    $data['product_pur']='no';
                    
                    $data['product_sho']='yes';
                    $data['mat_sho']='no';
                    $data['moc_sho']='no';
                    $data['moc_pur']='no';
                    $data['mat_pur']='no';
                    $data['ori_sho']='no';
                    $data['ori_pur']='no';
                    
                    $proche= $this->db->get_where('zoomzoom_purchase',array('prid'=>$this->session->userdata('prid'),'status'=>'Paid','item'=>'product','sch_id'=>$schedule->zoomzoom_schedule_id))->row();
                    // echo $this->db->last_query();die;
                    
                    if($proche){
                        $data['product_pur']='yes';
                    }
                    if($schedule->material !='' and $schedule->material != 0){
                        $data['mat_sho']='yes';
                    }
                    
                    // echo $data['mat_sho'];
                    
                    $matche= $this->db->get_where('zoomzoom_purchase',array('prid'=>$this->session->userdata('prid'),'status'=>'Paid','item'=>'material'))->row();
                    // echo $this->db->last_query();die;
                    if($matche){
                        $data['mat_pur']='yes';
                    }
                    
                    
                    
                    $mocche= $this->db->get_where('zoomzoom_purchase',array('prid'=>$this->session->userdata('prid'),'status'=>'Paid','item'=>'mock'))->row();
                    if($mocche){
                        $data['moc_pur']='yes';
                    }
                    
                    if($schedule->mock !='' and $schedule->mock != 0){
                        $data['moc_sho']='yes';
                    }
                    
                    
                    $oriche= $this->db->get_where('zoomzoom_purchase',array('prid'=>$this->session->userdata('prid'),'status'=>'Paid','item'=>'orientation'))->row();
                    if($oriche){
                        $data['ori_pur']='yes';
                    }
                    if($schedule->orientation !='' and $schedule->orientation != 0){
                        $data['ori_sho']='yes';
                    }
                    
                    
                    if(isset($_POST['cin'])){
                        $this->session->set_userdata('prid',$_POST['cin']);
                        redirect('cin_login/index', 'refresh');
                    }
                   
                    
                    if(isset($_POST['Edit'])){
                        
                        redirect('welcome/edit_registration_log', 'refresh');
                    }
                    
                    $data['proche']=$proche;
                    
                    $this->load->view('registration_login_test2',$data);
                    
                    
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
        }
    	
    	
    	
    	public function current_registration_()
	    {
	       // print_R($_SESSION);die;
	        
    	     $data['reg_email']=$_SESSION['email'];
    	     $data['email'] = $_POST['email'];
    	     
    	     
    	     if(!empty($data['email']) && empty($_POST['otp']))
    	     {
	      
    	        $otp = rand(100000, 999999); 
    	        $_SESSION['session_otp'] = $otp;
    	        $sender = 'donotreply@marrs.in';
                $recipient = $_POST['email'];
    
                $subject = "Marrs Email Verification";
                $message = " Your one time email verification code is ".$otp;
                $headers = 'From:' . $sender;
            
                if (mail($recipient, $subject, $message, $headers))
                {
                    echo " ";
                }
                else
                {
                    echo " ";
                }
	       
	       
	      
	 
    		}elseif(!empty($_POST['email']) && !empty($_POST['otp'])){
    	            $this->session->set_flashdata('otperror','Otp not Valid. Please enter valid Otp');
        	        if($_POST['otp'] == $_SESSION['session_otp']){
        	        $_SESSION['email']=$_POST['email'];
        	       // print_r($_SESSION);
        	            $sch= $this->db->get_where('lunar_schedule_cin',array('registration_code'=>$this->session->userdata('registration_code')))->row();
        	           // echo $this->db->last_query();
            	        $student= $this->db->get_where('lunar_prid',array('sch_id'=>$sch->lunar_schedule_id,'email'=>$this->session->userdata('email')))->row();
            	       // echo $this->db->last_query();
            	       // print_r($student);die;
            	        
            	               
            	        if($student){
            	            $this->session->set_userdata('prid',$student->prid);
            	            redirect('welcome/registration_log', 'refresh');  
            	        }else{
            	            redirect('welcome/reg', 'refresh');
            	        }
               
                        
        	       // print_r($_SESSION);die;
        	       //redirect('welcome/registration_detail', 'refresh');  
        	   }
    	         
    	    }
    	     
    	    $this->load->view('new_registration_email',$data);
    		 
    	}
    	
	public function current_registration()
    {
        // if(isset($this->session->userdata('registration_code'))){
            
            $data['schedule'] = $this->db->get_where('zoomzoom_schedule_cin', ['registration_code' => $this->session->userdata('registration_code')])->row();
            
            
            session_start(); // Ensure session is started
        
            // Set API key for Brevo
            $apiKey = "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";
            $url = "https://api.brevo.com/v3/smtp/email";
        
            $data['reg_email'] = $_SESSION['email'];
            $data['email'] = $this->input->post('email');
            
            if (!empty($data['email']) && empty($this->input->post('otp'))) {
                
                $_SESSION['email'] = $data['email'];
                // Generate OTP
                $otp = rand(100000, 999999);
                $_SESSION['session_otp'] = $otp;
        
                // Email Data for Brevo API
                $emailData = [
                    "sender" => [
                        "name" => "MaRRS Enquiry",
                        "email" => "donotreply@marrs.in"
                    ],
                    "to" => [
                        [
                            "email" => $data['email'],
                            "name" => "User"
                        ]
                    ],
                    "subject" => "Marrs Email Verification",
                    "htmlContent" => "<p>Your one-time email verification code is <strong>$otp</strong>.</p>",
                    "textContent" => "Your one-time email verification code is $otp."
                ];
        
                // Convert data to JSON
                $jsonData = json_encode($emailData);
        
                // cURL request
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "accept: application/json",
                    "api-key: $apiKey",
                    "content-type: application/json"
                ]);
        
                // Execute request
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
        
                // Check API response
                if ($httpCode == 201) {
                    echo "";
                    $this->session->set_flashdata('otpsuccess', 'Otp sent successfully.');
                } else {
                    echo "Error: " . $response;
                }
            }
            
            
            
            if(isset($_POST['submit'])){
                
                if(isset($_POST['otp']) && !empty($_POST['otp'])) {
                
                // echo 'okkk';
                //print_r($_SESSION);die;
                
                
                    
                    if ($_POST['otp'] == $_SESSION['session_otp']) {
                        $this->session->set_flashdata('otpsuccess', 'Otp verification successfully, continue to registeration.');
                        //$_SESSION['email'] = $data['email'];
                        $sch = $this->db->get_where('zoomzoom_schedule_cin', ['registration_code' => $this->session->userdata('registration_code')])->row();
                        
                        
                        $student = $this->db->get_where('zoomzoom_prid', ['sch_id' => $sch->zoomzoom_schedule_id, 'email' => $_SESSION['email']])->row();
                        // echo $this->db->last_query();    
                         //print_r($student);die;    
            
                        if (!empty($student)) {
                            $this->session->set_userdata('prid', $student->prid);
                            redirect('welcome/reg', 'refresh');
                        } else {
                            redirect('welcome/reg', 'refresh');
                        }
                    }elseif(isset($_POST['otp'])){
                        $this->session->set_flashdata('otperror', 'Otp not Valid. Please enter a valid OTP');
                    }
                    
                }
            }
            
            $this->load->view('new_registration_email_1', $data);
            
        // }
        // else{
        //     redirect('https://marrs.in/');  
        // }
    }

    	
    	public function winnerlist()
    	{
    	    
    	    if(isset($_POST['submit'])){
    	        $level=$_POST['level'];
    	        $data['result']=$_POST;
    	        $ar=["10", "8", "7", "2", "5", "3"];
    	        
    	        
    	        $this->db->select('*');
    	        $this->db->from('cin_result');
    	        $this->db->join('cin_list','cin_list.cin=cin_result.cin');
    	        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
        	        if ($level == "1") {
                        if($data['result']['period']>12){
                            $this->db->join('school_new','school_new.id=cin_list.school_id');
                            $this->db->where('school_name',$_POST['school']);
                	    }else{    
                        
                            $this->db->where('cin_list.school_name',$_POST['school']);
                	    } 
                    } 
                    // else if ($level == "12") {
                        
                    // } 
                    else if (in_array($level,$ar)) {
                        $this->db->where('cin_list.state_id',$_POST['state_id']);
                    }
            	        
        	        $this->db->where('cin_result.product_name',$_POST['product']);
                    $this->db->where('cin_result.status','Q');
                    $this->db->where('cin_result.clevel',$_POST['level']);
                    $this->db->where('cin_result.period_id',$_POST['period']);
                    $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                    $this->db->where('rank !=','-');
                    $this->db->where('rank !=','');
                    $this->db->group_by('cin_result.cin');
                    $query = $this->db->get();
                    $data['students']=$query->result();
                    
                // echo $this->db->last_query();die;    
    	        
    	    }
    	    
    	    $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id >=','12');
            $query = $this->db->get();
            $data['periodload']=$query->result();
            
            $this->db->select('*');
            $this->db->from('states');
            $this->db->where('country_id','105');
            $query = $this->db->get();
            $data['stateload']=$query->result();
            
    	    
    	    $this->db->select('*');
            $this->db->from('products');
            $this->db->where('status','Active');
            $this->db->where('product_id <','39');
            $query = $this->db->get();
            $data['products']=$query->result();
            
    	    if(isset($data['result']['product'])){
        	    $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                $this->db->where('product_name',$data['result']['product']);
                $query = $this->db->get();
                $data['levels']=$query->result();
                
    	    }
    	    
    	    if(isset($data['result']['product'])){
        	    $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                $this->db->where('product_name',$data['result']['product']);
                $query = $this->db->get();
                $data['levels']=$query->result();
    	    }
    	    
    	    if(isset($data['result']['state_id'])){
        	    $this->db->select('*');
                $this->db->from('areas');
                $this->db->where('state_id',$data['result']['state_id']);
                $query = $this->db->get();
                $data['areas']=$query->result();
    	    }
    	    
    	    if(isset($data['result']['area'])){
        	    $this->db->select('school_name');
        	    if($data['result']['period']>12){
                    $this->db->from('school_new');
                    $this->db->where('area_code',$data['result']['area']);
        	    }else{    
                    $this->db->from('cin_list');
                    $this->db->where('franchise_code',$data['result']['area']);
                    $this->db->group_by('school_name');
        	    }    
                $query = $this->db->get();
                $data['schools']=$query->result();
                
    	    }
    	    
    	    
    	    $this->load->view('winnerlist',$data);
    	}
    	
    	public function check_cin()
    	{
    	    
    	    if(isset($_POST['submit'])){
    	       // print_R($_POST);die;
    	        if(!empty($_POST['value'])){
    	            
        	        $data['value']=$_POST['value'];
        	        
        	        
        	        $year=$_POST['year'];
        	       // echo $year;die;
        	        $result=is_numeric($_POST['value']);
        	        
        	       // print_r($result);die;
        	        
    	            if($result=='1'){
        	            //echo 'number';die;
        	            $this->db->select('*');
        	            $this->db->from('cin_list');
        	           // $this->db->join('cin_result','cin_list.cin=cin_result.cin');
        	            //$this->db->or_where('stud_phone',$_POST['value']);
        	            //$this->db->or_where('stud_phone',$_POST['value'].'91');
        	            //$this->db->like('cin_list.cin',$year);
        	            $this->db->like('cin_list.cin', $year, 'after'); 
        	            $this->db->where('stud_phone',$_POST['value']);
        	            
        	            $this->db->group_by('cin_list.cin');
        	            $query = $this->db->get();
                        $data['cin']=$query->result_array();
    	            
        	        }else{
        	         //echo 'emal';die;
        	          $value= strtolower($_POST['value']);
        	            $this->db->select('*');
        	            $this->db->from('cin_list');
        	           // $this->db->join('cin_result','cin_list.cin=cin_result.cin');
        	            $this->db->where('stud_email',$_POST['value']);
        	            if($year=='22'){
        	                $this->db->like('cin_list.period_id','12');
        	            }else{
        	                $this->db->like('cin_list.cin', $year, 'after'); 
        	            }
        	            $this->db->group_by('cin_list.cin');
        	            $query = $this->db->get();
        	           // echo $this->db->last_query();die;
        	           // print_r($query->result_array());die;
                        $data['cin']=$query->result_array();
        	        }
        	        
        	        $data['result']=$_POST;
    	        }else{
    	            $this->session->set_flashdata('error','Enter the email or mobile.');
    	        }
    	        
    	    }
    	     $this->load->view('find_cin',$data);
    	}
    	
    	public function new_product()
    	{
    		    
    		 $id = $this->uri->segment('3');
    		 
    		 $data_student = $this->db->get_where('students',array('id'=>$id))->row_array();
    		 if(!empty($data_student)){ 
    		     
    		 $data['class']=$data_student['class'];
    		 $data['schol_code']=$data_student['school_code'];
    		 $this->session->set_userdata('prid',$data_student['PRID']);
    		 }else{
    		     
    		     $student = $this->db->get_where('cin_list',array('id'=>$id))->row_array();
    		     $data['class']=$student['class'];
    		     
    		     $query=$this->db->query("select PRID from students ORDER BY id DESC LIMIT 1")->row_array();
	                 $pid = $query['PRID'];
                     $first='23';
                     $mid='MRREG';
                     $last=substr($pid, 7);
                     $last=$last+1;
                     $prid=$first.$mid.$last;
	                 
	                 $array=array(
    		         'first_name'=>$student['student_name'],
    		         'email'=>$student['stud_email'],
    		         'mobile'=>$student['stud_phone'],
    		         'class'=>$student['class'],
    		         'PRID' =>$prid
    		         );
    		         //print_r($array);die;
    		         $this->db->insert('students',$array);
    		         $this->session->set_userdata('prid',$prid);
    		 }
		     $this->load->view('register_new_product',$data); 
		    
		}
		
		public function profile_cin() 
	    {	
	         $id = $this->uri->segment('3');
    // 		 $student = $this->db->get_where('cin_list',array('id'=>$id))->row_array();
    // 		print_r($student);die;
    		  $this->session->set_userdata('cin',$id);
    		  redirect('cin_login/index');  
    	}
		   
		public function Purchase_ByClass()
		{
		   	    
    		 $class_data = $this->db->get_where('class',array('class_id'=>$this->input->post('class')))->row();
    		  $prid = $this->session->userdata('prid');
    		  //print_r($_POST);die;
    	          
    		    $data['class_name']= $class_data->class_name;
    		    $data['school'] = $this->input->post('access_code');
    			
    		  $this->load->view('purchase',$data); 
		    
		}
	
 	    public function addtocart()
 	    {
 	      $prid=$this->session->userdata('prid');
 	     $product_name = $_POST['product_name'];
 	     $amount = $_POST['amount'];
 	     $class =  $_POST['class'];
 	     $already_added= $this->db->get_where('cart',array('product_name' =>$product_name,'prid'=>$prid))->row();
 	      $pid = $this->db->get_where('products',array('product_name' =>$product_name))->row()->product_id;
                 $this->db->select('*');
                $this->db->from('students');
                $this->db->where('PRID',$prid);
                $query = $this->db->get();
                $arr=$query->row_array();
                $school=$arr['school_code'];
                $period=$arr['period_id'];
           
                        
                        $insert_data=array(  
        			                      'prid'  => $prid, 
        								  'product_name'  => $product_name,
        								  'product_id' =>  $pid,
        								//'amount'   => $amount,
        								  'class_name'    => $class,
        								  'amount'   =>  $amount,
        					              'price_code'    => '23PC'.'-'.$amount,
        								  'period'=>$period,
        								  'payment_status'=>"Unpaid"
        								  );
        			 //	print_r($insert_data);die;
        			 
        		if(empty($already_added)){
			    $this->db->insert('cart', $insert_data); 
        		}else{
                 $this->session->set_flashdata('message','Product already Added in cart.');
        		}
 	     //print_r($_POST);die;
 	    
 	}
 	
 	    public function deletecartitem()
 	    {
     	     $id =$this->input->post('id');
     	     $this->db->where('id',$id);
     	     $this->db->delete('cart');
     	     //redirect('welcome/Purchase_ByClass');
     	}
 	
 	    public function product_cat_pay()
 	    {
    	    $student_id=$this->session->userdata('student_id');
    	    $details=$this->session->userdata('details');
    	   // echo $student_id;print_r($details);
    	    $this->load->view('offer');
	    }
	
	    public function schoolcode()
	    {

    	     if(isset($_POST['conform'])){
    	        //print_r($_POST);die;
    	       $schoolCode = $this->input->post('schoolaccesscode');
    	       $school_code = $this->db->get_where('school_new',array('school_code'=>$schoolCode))->row();
    	        if($school_code!=''){
    	             $this->session->set_userdata('school_code', $schoolCode);
    	            redirect('Welcome/offer', 'refresh');
    	        }
    	        else{
    	         $this->session->set_flashdata('schoolerror','Invalid School Access Code, please contact your school.');
                 redirect('Welcome/index', 'refresh');
    	        }
    	     }
    	  
    	}
	
	    public function offer()
	    {
	    //print_r($_POST);die;
	  
	   
    	     if(isset($_POST['submit'])){
    	         
    	     if(!empty($_POST['franchise_id']) && !empty($_POST['product_id'])){
    	        $res = $this->db->get_where('franchise',array('franchise_id'=>$_POST['franchise_id']))->row();
	            $state_id = $res->state_id;
	            $ress = $this->db->get_where('areas',array('state_id'=>$state_id))->row();
	            $area_code = $ress->area_code; 
	          
	            $scholcode = $this->db->get_where('school_new',array('franchise_id'=>$_POST['franchise_id']))->row()->school_code;
	            $this->db->select('period_id,initials');
                $this->db->from('period');
    		    $this->db->where('status','Active');
    		    $period_data  =  $this->db->get();
    		    $period_array=$period_data->result_array(); 
    		    $period=$period_array[0]['initials'];
    		    $period_id=$period_array[0]['period_id'];
     		
    	        $class=$_POST['class'];
    	        $query1=$this->db->query("select class_name,class_key from class where class_id='$class;'");
    	        foreach ($query1->result() as $row) { $stud_class= $row->class_name; $class_key=$row->class_key; }
	            $query=$this->db->query("select PRID from students ORDER BY id DESC LIMIT 1");
	            foreach ($query->result() as $row)
                            {
                            $pid= $row->PRID;
                            }
                           
                     $first=$period;
                     $mid='MRREG';
                     $last=substr($pid, 7);
                     $last=$last+1;
                   
    	     $prid=$first.$mid.$last;
    	   
    	     $insert_data=array(  
			                      'first_name'  => $_POST['first_name'], 
								  'middle_name'  =>  $_POST['middle_name'],
								  'last_name' =>   $_POST['last_name'],
								  
								  'email'   =>   $_POST['email'],
					
								  'period_id'    =>   $period_id,
								  'level_id'   =>   '14',
								  'state'     =>  $_POST['state'],
								  'class_key'  =>  $class_key,
								  'class'        =>  	 $stud_class,
								  'father_name'   =>  $_POST['father_name'],
								  
								  'mother_name'  =>   $_POST['mother_name'],
								  'gender'=>  $_POST['gender'],
								  'email'      =>  $_POST['email'],
								  'mobile'  =>  $_POST['mobile'],
								  'whatsapp'      =>   $_POST['whatsapp'],
								  'PRID'=>$prid,
								  'school_code'=>$scholcode,
								  'area_code' =>$area_code
							);
 			//print_r($insert_data);die;
	     
	        $this->db->insert('students', $insert_data);
	        $this->session->set_flashdata('Sucees_m','Congratulations, Profile has been Submited.');
	        $_SESSION['prid']=$prid;
	        $_SESSION['email']=$_POST['email'];
	  
	        $from_email = "donotreply@marrs.in"; 
            $to_email = $_POST['email']; 
            
             $message .='<h4>Registration Successful</h4>';
            $message .='<h4> Hello, Congratulations '.$_POST['first_name'].' '.$_POST['middle_name'].' '.$_POST['last_name'].'for successfully registering on the https://marrs.in/ portal.</h4>';

            $message .='<p>You have not paid to participate in any of the MaRRS Challenges.</p>';
            
            $message .='<p>You can at any time log on to your account using your email id and OTP sent to the email id. You can then register for any of the MaRRS Competitions.</p>';
             $message .='<p>Once you pay and register for any of the MaRRS Competitions you will receive the Candidate Identification Number (CIN) for the same. You can then access the Learning Material for the product by logging in using the CIN.</p>';
            
            $message .='<p>You will be able to download any learning material immediately on its purchase. Please ensure that you download Registration Slips when you enlist for Orientation or Mock Tests.</p>';
            $message .='<p>Thanks & Regards,</p>';
            $message .='<p>MaRRS Team</p>';
            
             $headers  = 'MIME-Version: 1.0' . "\r\n";
             $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             //$this->load->library('email'); 
             $subject ='Participent Registration Number'; 
             $sender = 'donotreply@marrs.in';
             mail($to_email, $subject, $message, $sender, $headers);
             
              redirect('welcome/new_purchase');
	         
	     }else{
	         
	  
	         
	        if(!empty($this->input->post('school'))){
	    
	           $school_code=$this->input->post('school');
	        
	       }else{
	            $school_code=$this->session->userdata('school_code'); 
	        }
	        $_SESSION['post']=$_POST;
	     $data['school']= $this->db->get_where('school_new',array('school_code' =>$school_code))->row_array();
	     
	     $schoolcode =$data['school']['school_code'];
	     if(!empty($schoolcode)){
	         $schoolcode = $schoolcode;
	     }else{
	         $schoolcode = 'AA1S10071';
	     }
	      //print_r($data['school']);die;
	     $this->db->select('period_id,initials');
         $this->db->from('period');
		 $this->db->where('status','Active');
		 $period_data  =  $this->db->get();
		 $period_array=$period_data->result_array(); 
		 $period=$period_array[0]['initials'];
		 $period_id=$period_array[0]['period_id'];
 		//echo $period;die;
	    
	     $this->db->select('id,level_name');
         $this->db->from('competition_levels');
		 $this->db->where('status','Active');
		 $get_STEP1_query   =  $this->db->get();
		 $get_STEP1_result_row=$get_STEP1_query->result_array(); 
		 $level  = $get_STEP1_result_row[0]['id'];
 	//	echo $level;die;
	    
	    
	     $class=$_POST['class'];
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
	    // echo $prid;die;
	    
	     $insert_data=array(  
			                      'first_name'  => $_POST['first_name'], 
								  'middle_name'  =>  $_POST['middle_name'],
								  'last_name' =>   $_POST['last_name'],
								  
								  'email'   =>   $_POST['email'],
					
								  'period_id'    =>   $period_id,
								  'level_id'   =>   $level,
								  'state'     =>  $_POST['state'],
								  'class_key'  =>  $class_key,
								  'class'        =>  	 $stud_class,
								  'father_name'   =>  $_POST['father_name'],
								  
								  'mother_name'  =>   $_POST['mother_name'],
								  'gender'=>  $_POST['gender'],
								  'email'      =>  $_POST['email'],
								  'mobile'  =>  $_POST['mobile'],
								  'whatsapp'      =>   $_POST['whatsapp'],
								  'PRID'=>$prid,
								  'school_code'=>$schoolcode,
								  'area_code' =>$_POST['area_code']
							);
 			//print_r($insert_data);die;
	     
	     $this->db->insert('students', $insert_data);
	   $this->session->set_flashdata('Sucees_m','Congratulations, Profile has been Submited.');
	        $data['prid']=$prid;
	       $email=$_POST['email'];
	       $from_email = "donotreply@marrs.in"; 
            $to_email =$_SESSION['email']; 
            
             $message .='<h4>Registration Successful</h4>';
            $message .='<h4> Hello, Congratulations '.$_POST['first_name'].' '.$_POST['middle_name'].' '.$_POST['last_name'].'for successfully registering on the https://marrs.in/ portal.</h4>';

            $message .='<p>You have not paid to participate in any of the MaRRS Challenges.</p>';
            
            $message .='<p>You can at any time log on to your account using your email id and OTP sent to the email id. You can then register for any of the MaRRS Competitions.</p>';
             $message .='<p>Once you pay and register for any of the MaRRS Competitions you will receive the Candidate Identification Number (CIN) for the same. You can then access the Learning Material for the product by logging in using the CIN.</p>';
            
            $message .='<p>You will be able to download any learning material immediately on its purchase. Please ensure that you download Registration Slips when you enlist for Orientation or Mock Tests.</p>';
            $message .='<p>Thanks & Regards,</p>';
            $message .='<p>MaRRS Team</p>';
       
            
            
             $headers  = 'MIME-Version: 1.0' . "\r\n";
             $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             $this->load->library('email'); 
             $subject ='Participent Registration Number'; 
             $sender = 'donotreply@marrs.in';
             mail($to_email, $subject, $message, $sender, $headers);
                               
            
           
	        if(!empty($data)){
	            $this->session->set_flashdata('message', $em);
	            $this->session->set_userdata('school_code',$school_code);
	            $this->session->set_userdata('prid',$data['prid']);
	             $this->session->set_userdata('email',$email);
                redirect('product_purchase', 'refresh');
	        }
	     }
	       
	     }
	    
	    $this->load->view('offer.php',$data);
	    
	}
	
	    public function login()
	    {
	    
	    
	    
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
	
        public function ajax($id='')
        {
		  //print_r($_POST);die;
	        $this->Index->insert($_POST['id'],$_POST['prid']);
    
	    }

		public function student()
		{
	   // echo 'ok';die;
      
            if (isset($_POST['submit'])) {
           
                $row = $this->db->get_where('students',array('PRID'=>$_POST['user']))->row_array();
        
                if(!empty($row)){
                 $this->session->set_userdata('prid', $_POST['user']);
                  redirect('welcome/out1/', 'refresh');
                }
                else{
                    $agg='no';
                }
              
            }
        
            $data['message']=$this->session->userdata('message');
    	    $this->load->view('student.php',$data);
    	}
	
	    public function cart()
	    {
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
    		
          // $amount = 1;
    		
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
    	                     redirect(base_url().'product_purchase');
    	                     
    	                      
    	                  }else{  ?>
    	                      
    	                    <script>
                    	     alert('No item in Cart First Go Add to Cart');
                    	     window.location.href="<?php echo base_url('product_purchase');?>";
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
	
        public function success() 
        {
      
            $arr=$this->session->userdata('payment_data');
           
            $data['title'] = 'Razorpay Success ';  
           
            $data['session']=$this->session->userdata('payment_data');
        //echo 'ok';print_r($_SESSION);die;
            $prid = $_SESSION['prid'];
          
            $this->Index->stud_material_cart($data['session']);
           
            $data['student']=$this->Index->get_student($prid);
            //print_r($data['student'][0]->first_name);die;
            $data['cin']=$this->db->get_where('study_material_byprid',array('prid'=>$prid))->result();
            
            $final_amount = $data['session']['amount']; 
            $to_email =$data['student'][0]->email; 
             //print_r($to_email);die;
             $from_email = "donotreply@marrs.in";
               $message .='<h3 style="margin:auto">Registration Successful</h3><br>
    
                 <h4 style="margin:auto">Hello, Congratulations '. $data['student'][0]->first_name .' '.$data['student'][0]->middle_name .' '. $data['student'][0]->last_name.' for successfully registering for (product name).</h4> 
    
                  <h4>  Your candidate Identification Number (CIN) is / are -';
                    foreach($data['cin'] as $value){
                    $message .=$value->cin.', '.'</h4>';
                    }
                     $message .='<p>You can at any time log on to your account on <a href="https://marrs.in/"> https://marrs.in/ </a>using your CIN as your username and password or your email id and OTP sent to the email id.</p>
                     <p>You can then access the Learning Material for the product that you registered for. You can also make any additional purchases if you so desire.</p>
    
                   <p> Please note that you will be able to download any learning material immediately upon its purchase. Please ensure that you download Registration Slips when you enlist for Orientation or Mock Tests.</p>
    
                    <p>Your payment receipt is as below:</p><br>';
           $message .= ' <table class="table" width="100%">
                 
                    <tr><th style="border:solid">Sr.No</th>
                   <th style="border:solid">CIN</th>
                   <th style="border:solid">Product Name</th>
                   <th style="border:solid">Tranction ID</th>
                   <th style="border:solid">Amount</th></tr>
                '; 

                $i=1; foreach($data['cin'] as $value){
                $message .= '<tr>
                    <td style="border:solid">'.$i.'</td>
                    <td style="border:solid">'.$value->cin.'</td>
                    <td style="border:solid">'.$value->product_name.'</td>
                    
                    <td style="border:solid">'.$value->rozarpay_payment_id.'</td>
                    <td style="border:solid"> &#8377; '.$value->amount.'</td>
                </tr>';
            }
                $message .= '<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="border:solid">Total Amount </td>
                    <td style="border:solid"> &#8377; '.$final_amount.'</td>
                </tr>
            </table>';
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             //echo $message;die;
                               $this->load->library('email'); 
            
                               $subject ='Participent Registration Number'; 
            
                               $sender = 'donotreply@marrs.in';
                               
                              
                                
                                if (mail($to_email, $subject, $message, $headers))
                                {
                                    echo " ";
                                }
                                else
                                {
                                    echo " ";
                                }
        
            $this->load->view('success', $data);
        }  
    
        public function failed() 
        {
            $datares = $this->session->userdata('payment_data');
            $data['arr']=$this->session->userdata('payment_data');
            $data['amount']=$datares['amount'];
            $prid= $datares['prid'];
            $data['title'] = 'Razorpay Failed';   
            $data['session']=$this->session->userdata('payment_data');
            $data['student']=$this->Index->get_student($prid);
            $this->load->view('tranctionfailed', $data);
        } 
	
	    public function out2($id='')
	    {
    	   $prid=$this->uri->segment(4);
    	   $this->session->set_userdata('prid', $prid);
    	    redirect('Welcome/out1', 'refresh');
    	   //$this->load->view('prof', $data); 
    	}
	
	    public function subscribe_product()
	    {
    	    $prid=$this->uri->segment(4);
    	   //echo $prid;die;
    	   $data['prid']=$prid;
    	   $data['student']=$this->Index->get_student($prid);
    	  // print_r($data);die;
    	   $data['student_cart']=$this->Index->subscribe_product($prid);
    	   $this->load->view('subscribe_product', $data);
    	}
		
	    public function product_purchase()
	    {
    	    //print_r($_SESSION);die;
    	    //echo 'ok';
    	    if(!empty($this->session->userdata('prid'))){
    	        $prid=$this->session->userdata('prid');
    	    }else{
    	        $prid=$this->uri->segment(4);
    	    }
		    
		   // $this->load->model('Index');
		   //echo $prid;die;
		   $data['prid']=$prid;
	       $data['student']=$this->db->get_where('students',array('PRID'=>$prid))->result();
	       $data['result']=$this->db->get_where('student_result',array('PRID'=>$prid))->result();
	        $student=$this->db->get_where('students',array('PRID'=>$prid))->row_array();
	        $period=$student['period_id'];
	        $school_code=$student['school_code'];
	       if(isset($_POST['add'])){
	           //print_r($_POST);die;   
	           if(isset($_POST['product'])){
	               //print_r($_POST);exit;
	               
	             $this->db->select('*');
                $this->db->from('students');
                $this->db->where('PRID',$prid);
                $query = $this->db->get();
                $arr=$query->row_array();
                $school=$arr['school_code'];
                $period=$arr['period_id'];
            
            foreach($_POST['product'] as $key=>$row){
                // echo $pid;exit;
                 $product_name= $row;
                 $amount = $_POST['amount'][$key];
                 $pid = $this->db->get_where('products',array('product_name' =>$product_name))->row()->product_id;
                if(empty($pro_id)){
                    // echo 'ok';die;
                        
                        $insert_data=array(  
        			                      'prid'  => $prid, 
        								  'product_name'  => $product_name,
        								  'product_id' =>  $pid,
        								//'amount'   => $amount,
        								  'class_name'    => $arr['class'],
        								  'amount'   =>  $amount,
        					              'price_code'    => '23PC'.'-'.$amount,
        								  'period'=>$period,
        								  'payment_status'=>"Unpaid"
        								  );
        			 	//print_r($insert_data);die;
			    $this->db->insert('cart', $insert_data); 
                }
            }
	             
	             
	             
	             
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
	           
	        $this->db->where('product_name', $product);
            $this->db->where('prid', $prid);
            //$this->db->where('class_name', $class);
            $this->db->where('period', $period);
            $this->db->delete('cart');
	           
	           
	       }
	       
	      if(isset($_POST['Invoice'])){
	        //echo 'ji';die;
	           redirect('welcome/invoice/', 'refresh');
	           
	       }
	       
	       
	       
		   $this->load->view('product_purchase', $data); 
		}
		
		public function invoice()
		{
		    //echo 'jiji';die;
		    
		    $prid=$this->session->userdata('prid');
		    $data['cart']=$this->db->get_where('study_material_byprid',array('PRID'=>$prid))->result_array();
		    $data['student']=$this->db->get_where('students',array('PRID'=>$prid))->row_array();
		    $this->load->view('invoice', $data);
		}
		
		public function api_invoice() 
        {
            $prid = $this->session->userdata('prid');
        
            $data = array(
            'prid' => $prid
        );
    
            $postFields = json_encode($data);
        //print_r($data);die;
            // Initialize cURL session
            $curl = curl_init();
        
            // Set cURL options
            curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.aviansys.in/school_level_invoice',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    
                    CURLOPT_POSTFIELDS => $postFields,
                // CURLOPT_POSTFIELDS =>'{
                //     "cin": "23SBAC510133",
                //     "clevel": "1",
                //     "schedule": "710",
                //     "product": "MaRRS International Spelling Bee"    
                // }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));


        $response = curl_exec($curl);
    
        // Close cURL session
        curl_close($curl);
    
        // Set headers for PDF download
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=downloaded.pdf");
    
        // Output the PDF response
        echo $response;
    }
		
	    public function logout()
	    {
    	    $this->session->unset_userdata('school_code');
    	    $this->session->unset_userdata('prid');
    	    session_destroy();
    	    redirect('https://marrs.in/');
    	}
	
		public function logout2()
		{
		         
        	     $sender = 'donotreply@marrs.in';
                $recipient = $_SESSION['email'];
                $message .='<p>Thank you for visiting us on the MaRRS portal <a href="https://marrs.in">https://marrs.in.</a></p>';
                $message .='<p>You can return any time and login using your registered email id to register for any MaRRS activities or to download learning materials and certificates.</p>';
                $message .='<p>Thanks & Regards,</p>';
                $message .='<p> MaRRS Team</p>';
                $subject = "Marrs Email Verification";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                
                mail($recipient, $subject, $message, $headers);
	            session_destroy();
    	    redirect('https://marrs.in/');
    	}
	
	    public function out1()
	    {
    	    //print_r($_SESSION);die;
    	    if(isset($_POST['edit'])){
    	        //print_r($_POST['edit']);die;
    	        $this->session->set_userdata('prid', $_POST['edit']);
    	        redirect('welcome/edit_profile/', 'refresh');
    	    }
    	        $school_code=$this->session->userdata('school_code');
        	    $data['prid']=$this->session->userdata('prid');
        	     $prid=$this->session->userdata('prid');
        	    //echo $prid.$school_code;die;
        	    
            	     $this->db->select('*');
                     $this->db->from('students');
                     $this->db->where('PRID',$prid);
                     $this->db->order_by("class_key","desc");
                    
        	    $data['student']=$this->db->get()->result();
        	    foreach ($data['student'] as $row){
                    $school=$row->school_code;
        	    }
        	   $this->load->view('prof', $data); 
	    }
	    
	    public function edit_profile()
	    {
    	    $prid=$this->session->userdata('prid');
    	    //echo $prid;die;
    	     $data['student']=$this->db->get_where('students',array('PRID'=>$prid))->result();
    	     
    	     $students=$this->db->get_where('students',array('PRID'=>$prid))->result();
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
	
	    public function not()
	    {
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
	
	    public function statelevel()
	    {
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
	
	    public function nationallevel()
	    {
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
	       $period = 12;
		   $data['prid']=$prid;
		   $this->db->select('product_name,period,class_name');
           $this->db->from('cart');
           $this->db->where('prid',$prid);
           $this->db->where('period',$period);
            
		   $data['list']= $this->db->get()->result();
		 // print_r($data['list']);exit;
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
		   
		    $data['paidmaterialdata']= $array1;
		    $data['student']=$this->db->get_where('students',array('PRID',$prid))->result();
		   
	        if(isset($_POST['add']) && !empty($_POST['check']))
	        {
	             foreach($_POST['check'] as $row){
	       
	           $it=explode(" ",$row);
	          
	           $amount=end($it);
	          
	            array_pop($it);
	            
	          $str=implode(" ",$it);
	        
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
	      
	        
	        if(isset($_POST['delete'])){
	         
	         $this->db->where('id', $_POST['delete']);
             $this->db->delete('study_material_purchase');
	          
	       }
	        
	        
	        //print( $data['list']);exit;
	        //$data['materialdata']=$this->Index->get_purchase_competition_material($data['list']);
	        //$data['purchasematerialdata']=$this->Index->purchase_material_data($data['list'],$prid);
	        
	        $this->load->view('studymaterial',$data);
	    }
	    
	    public function free_material()
	    {
	           
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
    
	    public function paid_material()
	    {
	           
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
            
            if($code=='SCHOOL' or $code=='school'){
                //echo 'ok';die;
                redirect('https://marrs.in/school_login/');
                
            }else{
                if($code!=''){
                    if($code=='Aviansys@payments'){
                        // echo 'ok';die;
                        redirect('Log/payments');
                    }
                    elseif($code=='Aviansys@enquiry'){
                        redirect('Log/enquiry');
                    }
                    else{
                        $franchise_code = $this->db->get_where('franchise', array('username' => $code))->row_array();
                        
                        $admin_code = $this->db->get_where('admin_user', array('username' => $code))->row_array();
                        
                        $zoomacess_code = $this->db->get_where('franchise_to_zoomzoom', array('zoomzoom_access_code' => $code))->row_array();
                        
                        $marrsacess_code = $this->db->get_where('school_new', array('school_code' => $code))->row_array();
                    
                        $result_prid     = $this->db->get_where('students', array('prid' => $code ,'period_id'=>'14'))->row_array();
                     
                        $result_cin    = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
                         
                       $zoomzoom_prid = $this->db->get_where('student_to_zoomzoom', array('zoomzoom_prid' => $code))->row_array();
                       
                    //   $exit_email = $this->db->get_where('cin_list', array('stud_email' => $code))->row_array();
                    //   $zoomemail = $this->db->get_where('cin_zoomzoom', array('email' => $code))->row_array();
                    //   $email = $this->db->get_where('cin_list', array('stud_email' => $code))->row_array();
                     
                    //   $newregister_email = $this->db->get_where('students', array('email' => $code,'period_id'=>'14'))->row_array();
                }
                }
            }   
               
             if(!empty($newregister_email)){
                 //print_r($zoomemail['email']);die;
                 $data['email']=$newregister_email['email'];
                 if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
                        {
                            $this->session->set_userdata('email', $newregister_email['email']);
                            $this->session->set_userdata('prid', $newregister_email['PRID']);
                            
                                $otp = rand(100000, 999999); 
                    	        $_SESSION['session_otp_email'] = $otp;
                    	        $sender = 'donotreply@marrs.in';
                                $recipient = $newregister_email['email'];
                    
                                $subject = "Marrs Email Verification";
                                $message = " Your one time email verification code is ".$otp;
                                $headers = 'From:' . $sender;
                                
                                if (mail($recipient, $subject, $message, $headers))
                                {
                                    echo " ";
                                }
                                else
                                {
                                    echo " ";
                                }
	                
                            
                        }
                        if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
                        {
                            //echo '----test----';die;
                            $email = $newregister_email['email'];
                                
                            redirect('welcome/registration_log'); 
                           
                        }
                
               
              }
             elseif(!empty($zoomemail)){
                 //print_r($zoomemail['email']);die;
                 $data['email']=$zoomemail['email'];
                 if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
                        {
                            $this->session->set_userdata('email', $zoomemail['email']);
                           // $this->session->set_userdata('cin', $exit_email['cin']);
                            
                                $otp = rand(100000, 999999); 
                    	        $_SESSION['session_otp_email'] = $otp;
                    	        $sender = 'donotreply@marrs.in';
                                $recipient = $zoomemail['email'];
                    
                                $subject = "Marrs Email Verification";
                                $message = " Your one time email verification code is ".$otp;
                                $headers = 'From:' . $sender;
                                
                                if (mail($recipient, $subject, $message, $headers))
                                {
                                    echo " ";
                                }
                                else
                                {
                                    echo " ";
                                }
	                
                            
                            
                            
                        }
                        if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
                        {
                            //echo '----test----';die;
                            $email = $zoomemail['email'];
                            redirect('zoomzoom/studentdata'); 
                           
                        }
                
               
              }
             
            //  openschool_zoom = $this->db->get_where('cin_', array('school_code' => $code))->row_array();
               
             elseif(!empty($openschool_zoom)){
               
                        $data['data'] = $openschool_zoom['school_code']; 
                        if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
                        {
                            // echo 'ok';die;
                            $this->session->set_userdata('school_code', $openschool_zoom['school_code']);
                            // print_r($openschool_zoom);exit;
                            redirect('zoomzoom/open_registrationzoom');   
                        }
             }
             
            elseif(!empty($marrsacess_code)){
                // print_r($marrsacess_code);die;
                
                   $this->session->set_userdata('school_code',$this->input->post('code'));
                   $url='https://marrs.in/student_registration/welcome/scanner/'.$marrsacess_code['school_code'];
                    redirect($url);
                
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
                            $this->session->set_userdata('prid',$result_prid['PRID']);
                            redirect('welcome/registration_log');   
                            
                        }    
             
            }elseif(!empty($zoomzoom_prid)){
               
                        $data['data'] = $zoomzoom_prid['zoomzoom_prid']; 
                        if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
                        {
                            $this->session->set_userdata('id', $zoomzoom_prid['zoomzoom_prid']);
                            redirect('zoomzoom/profile_zoom');   
                        }
                
                
                
            } elseif(empty($email)){
                 $_SESSION['email'] = $this->input->post('code');
                 redirect('welcome/current_registration');
                 
            }elseif(!empty($exit_email)){
                  $data['email'] = $exit_email['stud_email'];
                 if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
                        {
                            $this->session->set_userdata('email', $exit_email['stud_email']);
                            $this->session->set_userdata('cin', $exit_email['cin']);
                            
                                $otp = rand(100000, 999999); 
                    	        $_SESSION['session_otp_email'] = $otp;
                    	        $sender = 'donotreply@marrs.in';
                                $recipient = $exit_email['stud_email'];
                    
                                $subject = "Marrs Email Verification";
                                $message = " Your one time email verification code is ".$otp;
                                $headers = 'From:' . $sender;
                                
                                if (mail($recipient, $subject, $message, $headers))
                                {
                                    echo " ";
                                }
                                else
                                {
                                    echo " ";
                                }
	                
                            
                            
                            
                        }
                        
                        if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
                        {
                            $email = $exit_email['stud_email'];
                            redirect('cin_login/studentdata'); 
                           
                        }
                 
            }else{   
                $this->session->set_flashdata('schoolerror', 'Enter Wrong Id.');
                 redirect('https://marrs.in/', 'refresh');
            }
          
        } 
	        
	        
	        
	     $this->load->view('commonlogin',$data);   
	    }
	    
	    public function get_access_code($id='')
	    {
	    $id = $_POST['school_id'];
		 //print_r($id);exit; 
		 $sc = $this->db->get_where('schools',array('school_id'=>$id))->row(); 
          print_r($sc->school_code); 
		 
	    }  
	
    	public function scanner() 
    	{
   
        $code = $this->uri->segment(3);
        
        $this->load->library('session');
        $marrsacess_code = $this->db->get_where('school_new', array('school_code' => $code))->row_array();

        if (!empty($marrsacess_code)) {
            $this->session->set_userdata('school_code', $marrsacess_code['school_code']);
            // redirect('welcome/emailenter');
            redirect('welcome/current_registration_new');
        } else {
            redirect('https://marrs.in');
        }
    }

    	public function current_registration_new()
    	{
	   //  echo $this->session->userdata('school_code');die;
	        $data['email'] = $_POST['email'];
	        if(!empty($data['email']) && empty($_POST['otp'])){
	      
	        $otp = rand(100000, 999999); 
	        $_SESSION['session_otp'] = $otp;
	        
        	    $data = array(
                    'email' => $data['email'],
                    'otp' => $_SESSION['session_otp'],
                    'message' => " Your one time email verification code is "
                );
                // print_r($data);die;
                $postFields = json_encode($data);
               
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.cambridgeolympiads.com/email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                
                CURLOPT_POSTFIELDS => $postFields,
            
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));


                $response = curl_exec($curl);
                curl_close($curl);

                // print_r($response);
                // die;
        
                $this->session->set_userdata('email',$_POST['email']);
                $this->session->set_flashdata('otpdelay','OTP will be generated in a minutes time');
    	           
           
		   }
		   elseif(!empty($_POST['email']) && !empty($_POST['otp'])){
		       
	           $this->session->set_flashdata('otperror','Otp not Valid. Please enter valid Otp');
	           
    	        if($_POST['otp'] == $_SESSION['session_otp']){
    	            
    	            $_SESSION['email']=$_POST['email'];
    	            $this->session->set_userdata('school_code',$this->session->userdata('school_code'));
    	            $this->session->set_userdata('email',$this->session->userdata('email'));
    	            
    	            $this->db->select('period_id');
    	            $this->db->from('period');
    	            $this->db->where('status','Active');
    	            $query=$this->db->get();
    	            $period=$query->row();
    	            $period=$period->period_id;
    	            
    	            
    	       //     echo $this->session->userdata('school_code');
    	       // echo  $op=strpos($this->session->userdata('school_code'), 'OP');die;
    	        
    	        
    	        if (strpos($this->session->userdata('school_code'), 'OP') !==0) {
                    $student = $this->db->get_where('students', array(
                        'email' => $_SESSION['email'],
                        'period_id' => $period,
                        'school_code' => $this->session->userdata('school_code')))->row();
                
                    if (!empty($student)) {
                        $this->session->set_userdata('prid', $student->PRID);
                        redirect('welcome/registration_log', 'refresh');
                    } else {
                        redirect('welcome/register_form', 'refresh');
                    }
                } else {
    	           //  echo 'ok';die;
    	             $student = $this->db->get_where('students_openschool', array(
                        'email' => $_SESSION['email'],
                        'period' => $period,
                        'school_code' => $this->session->userdata('school_code')))->row();
                
                    if (!empty($student)) {
                        $this->session->set_userdata('prid', $student->PRID);
                        redirect('welcome/open_registration_log', 'refresh');
                    } else {
                        redirect('welcome/open_register_form', 'refresh');
                    }
    	             
    	             
    	        }
    	        
    	        
    	    }
	     }
	    $this->load->view('new_registration_email',$data);
		 
	}
	
    	public function emailenter()
    	{
    	    if(isset($_POST['submit'])){
    	   // print_r($_POST);die;
                $student= $this->db->get_where('students',array('email'=>$_POST['email'],'period_id'=>'14','school_code'=>$this->session->userdata('school_code')))->row();
                // echo $this->db->last_query();
                // print_r($student);die;
                
                if(!empty($student)){
                    $this->session->set_userdata('prid',$student->PRID);
                    redirect('welcome/open_registration_log', 'refresh'); 
                }else{
                    redirect('welcome/open_register_form', 'refresh'); 
                }
        	}
    	    $this->load->view('emailenter',$data);
    		  
    	}
    
        public function open_register_form()
        {
            // $code='AA1S10583';
            $data['email']=$email=$_SESSION['email'];
            $this->session->userdata('school_code');
            $data['school']= $this->db->get_where('school_new',array('school_code'=>$this->session->userdata('school_code')))->row();
            $data['per']=$this->db->get_where('period',array('status'=>'Active'))->row();
            // print_r($data['school']);die;
    	    $school_id=$data['school']->id;
            $state_id=$data['school']->state;
            $data['state']= $this->db->get_where('states',array('state_subdivision_name'=>$_POST['state']))->row();
            $data['period']=$period= $this->db->get_where('period',array('status'=>'Active'))->row();
           
            if(isset($_POST['submit'])){
                
                $this->db->select('prid');
                $this->db->from('students_openschool');
                $this->db->where('period', $period->period_id);
                $this->db->order_by('prid', 'DESC');
                $query = $this->db->get();
                
                // Get the row result and retrieve `prid` value
                $prido = $query->row();
                $prido = $prido ? $prido->prid : null;
                
                if (!empty($prido) && strlen($prido) > 6) {
                    // Remove the first 6 characters and increment the remaining number
                    $prido_number = (int)substr($prido, 6); // Convert remaining part to integer
                    $prido_number++; // Increment by 1
                    $prid = $period->initials . 'MREG' . $prido_number;
                } else {
                    // Set default `prid` if `$prido` is empty
                    $prid = $period->initials . 'MREG' . '800000';
                }
                
                $ar=array(
                    'student_name'=>$_POST['student_name'],
                    'school_name'=>$_POST['school_name'],
                    'school_address'=>$_POST['school_address'],
                    'father_name'=>$_POST['father_name'],
                    'mother_name'=>$_POST['mother_name'],
                    'class'=>$_POST['class'],
                    // 'state'=>$state,
                    'email'=>$_POST['email'],
                    'period'=>$period->period_id,
                    'address1'=>$_POST['address'],
                    'mobile'=>$_POST['mobile'],
                    'school_code'=>$this->session->userdata('school_code'),
                    'gender'=>$_POST['gender'],
                    'prid'=>$prid,
                    'created_date'=> date('Y-m-d'),
                    'school_id'=>$school_id,
                    'state'=>$data['state']->state_subdivision_id
                    );
                    
                // print_R($ar);die;
                 $this->db->insert('students_openschool',$ar);
                $id= $this->db->insert_id();
                // echo $prid;die;
                $stu=$this->db->get_where('students_openschool',array('student_id'=>$id))->row();
                $prid=$stu->prid;
                $this->session->set_userdata('prid',$prid);
                
                // $sender = 'donotreply@marrs.in';
                // $recipient = $_POST['email'];
    
                // $subject = "Marrs School Level Login PRID";
                // $message = " Use this PRID as username and password. To login and purchase products, donload invoice PRID ".$prid;
                // $headers = 'From:' . $sender;
                // mail($recipient, $subject, $message, $headers);
                
                
                if(isset($prid)){
                  
                    redirect('welcome/open_registration_log', 'refresh'); 
                }else{
                    redirect('https://marrs.in', 'refresh'); 
                }
                
                
            }
            
            $this->load->view('open_register_form',$data);
        }

        public function open_registration_log()
        {
            
            if(!empty($this->session->userdata('prid'))){
                    $prid=$this->session->userdata('prid');
                    // echo $prid;die;
                $data['per']=$this->db->get_where('period',array('status'=>'Active'))->row();
                
                $data['student']=$student= $this->db->get_where('students_openschool',array('prid'=>$this->session->userdata('prid')))->row();
                    
                if(!empty($student)){    
                        
                        $query = $this->db->select('open_school_assign.*')
                             ->from('open_school_assign')
                             ->join('open_school_assign_class', 'open_school_assign.open_school_assign_id = open_school_assign_class.open_school_assign_id')
                             ->where('open_school_assign_class.class', $student->class)
                             ->where('open_school_assign.period', $student->period)
                             ->where('open_school_assign.school_id', $student->school_id)
                             ->get();
                        $data['list'] = $query->result();
                        // print_r($data['list']);die;
                        if(isset($_POST['Edit'])){
                            
                            redirect('welcome/edit_registration_log', 'refresh');
                        }
                        
                        
                        $this->load->view('registration_login_test1',$data);
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
        }
    
        public function gen_cin_($id='')
        {
        $product=$_POST['id'];
        $prid=$this->session->userdata('prid');
        $student= $this->db->get_where('students_openschool',array('prid'=>$this->session->userdata('prid')))->row();
        $prid_number = (int)substr($prid, 6);
        $per=$this->db->get_where('period',array('period_id'=>$student->period))->row();
        $pro=$this->db->get_where('products',array('product_name'=>$product))->row();
        
        $aro=$this->db->get_where('areas',array('state_id'=>$student->state))->row();
    
        $cin=$per->initials.$pro->in13.'O'.$aro->area_code.$prid_number;
        
        $fra = $this->db->order_by('franchise_id', 'DESC')
                ->get_where('franchise', array('state_id' => $student->state))
                ->row();
        // echo $this->db->last_query();die;        
        $class = $student->class;
        
        $class_map = [
            'Nursery' => ['class_id' => 1, 'category_id' => 1],
            'LKG' => ['class_id' => 2, 'category_id' => 2],
            'UKG' => ['class_id' => 3, 'category_id' => 3],
            'Class-1' => ['class_id' => 4, 'category_id' => 4],
            'Class-2' => ['class_id' => 5, 'category_id' => 5],
            'Class-3' => ['class_id' => 6, 'category_id' => 6],
            'Class-4' => ['class_id' => 7, 'category_id' => 7],
            'Class-5' => ['class_id' => 8, 'category_id' => 8],
            'Class-6' => ['class_id' => 9, 'category_id' => 9],
            'Class-7' => ['class_id' => 10, 'category_id' => 10],
            'Class-8' => ['class_id' => 11, 'category_id' => 11],
            'Class-9' => ['class_id' => 12, 'category_id' => 12],
            'Class-10' => ['class_id' => 13, 'category_id' => 13],
            'Class-11' => ['class_id' => 14, 'category_id' => 14],
            'Class-12' => ['class_id' => 15, 'category_id' => 15],
        ];
        
        
        if (isset($class_map[$class])) {
            $class_id = $class_map[$class]['class_id'];
            $category_id = $class_map[$class]['category_id'];
        } else {
            // Handle case where class is not found in the map
            $class_id = '';
            $category_id= '';
        }
        
            $insert_data=array(  
                  'gender'  => $student->gender, 
				  'school_id'  => $student->school_id,
				  'school_name' => $student->school_name,
				  'state_id'   => $student->state,
				  'class_id'   =>  $class_id,
				  'class'       =>$student->class,
				  'category_id' =>  $category_id,
				  'franchise_id' =>  $fra->franchise_id,
				  'franchise_code' => $aro->area_code,
				  'cin'        => $cin,
				  'password'   =>$cin,
				  'student_name'    =>  $student->student_name,
				  'father_name'   => $student->father_name,
				  'mother_name'   =>  $student->mother_name,
				  'address1'   =>  $student->address1,
				  'school_address1'  =>  	$student->school_address,
				  'period_id' => $student->period,
				  'stud_email'      => $student->email,
				  'stud_phone'  => $student->mobile,
				  'status'      =>  'Active'
			);
        // print_r($insert_data);die;
        
        $this->db->insert('cin_list',$insert_data);
        
        $this->db->insert('prid_to_cin',array('cin'=>$cin,'product_name'=>$product,'prid'=>$prid));
    }
    
        public function gen_cin($id = '') 
        {
            $product = $this->input->post('id');
            $prid = $this->session->userdata('prid');
            $student = $this->db->get_where('students_openschool', array('prid' => $prid))->row();
            $prid_number = (int)substr($prid, 6);
            $per = $this->db->get_where('period', array('period_id' => $student->period))->row();
            $pro = $this->db->get_where('products', array('product_name' => $product))->row();
            $aro = $this->db->get_where('areas', array('state_id' => $student->state))->row();
            $cin = $per->initials . $pro->in13 . 'O' . $aro->area_code . $prid_number;
            
            $fra = $this->db->order_by('franchise_id', 'DESC')
                        ->get_where('franchise', array('state_id' => $student->state))
                        ->row();
        
            $class_map = [
                'Nursery' => ['class_id' => 1, 'category_id' => 1],
                'LKG' => ['class_id' => 2, 'category_id' => 2],
                'UKG' => ['class_id' => 3, 'category_id' => 3],
                'Class-1' => ['class_id' => 4, 'category_id' => 4],
                'Class-2' => ['class_id' => 5, 'category_id' => 5],
                'Class-3' => ['class_id' => 6, 'category_id' => 6],
                'Class-4' => ['class_id' => 7, 'category_id' => 7],
                'Class-5' => ['class_id' => 8, 'category_id' => 8],
                'Class-6' => ['class_id' => 9, 'category_id' => 9],
                'Class-7' => ['class_id' => 10, 'category_id' => 10],
                'Class-8' => ['class_id' => 11, 'category_id' => 11],
                'Class-9' => ['class_id' => 12, 'category_id' => 12],
                'Class-10' => ['class_id' => 13, 'category_id' => 13],
                'Class-11' => ['class_id' => 14, 'category_id' => 14],
                'Class-12' => ['class_id' => 15, 'category_id' => 15],
            ];
    
            $class = $student->class;
            $class_id = isset($class_map[$class]) ? $class_map[$class]['class_id'] : '';
            $category_id = isset($class_map[$class]) ? $class_map[$class]['category_id'] : '';
        
            $insert_data = array(
                'gender' => $student->gender,
                'school_id' => $student->school_id,
                'school_name' => $student->school_name,
                'state_id' => $student->state,
                'class_id' => $class_id,
                'class' => $student->class,
                'category_id' => $category_id,
                'franchise_id' => $fra->franchise_id,
                'franchise_code' => $aro->area_code,
                'cin' => $cin,
                'password' => $cin,
                'student_name' => $student->student_name,
                'father_name' => $student->father_name,
                'mother_name' => $student->mother_name,
                'address1' => $student->address1,
                'school_address1' => $student->school_address,
                'period_id' => $student->period,
                'stud_email' => $student->email,
                'stud_phone' => $student->mobile,
                'status' => 'Active'
            );
        
            $this->db->insert('cin_list', $insert_data);
            $this->db->insert('prid_to_cin', array('cin' => $cin, 'product_name' => $product, 'prid' => $prid));
            
            // Respond with a message
            echo "CIN generated successfully!";
        }
    
        public function register_form()
        {
        // $code='AA1S10583';
        $data['email']=$email=$_SESSION['email'];
        // echo $this->session->userdata('school_code');die;
        $data['school']= $this->db->get_where('school_new',array('school_code'=>$this->session->userdata('school_code')))->row();
        
        // print_r($data['school']);die;
	    $school_id=$data['school']->id;
        $state_id=$data['school']->state;
        $data['state']= $this->db->get_where('states',array('state_subdivision_id'=>$state_id))->row();
        $data['period']=$period= $this->db->get_where('period',array('status'=>'Active'))->row();
       
        if(isset($_POST['submit'])){
            
            $this->db->select('*');
            $this->db->from('students');
            // $this->db->where('period_id',$period->period_id);
            $this->db->order_by('id','DESC');
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            $student= $query->row();
            $student_id=$student->id;
            $prid=$period->initials.'MREG'.$student_id;
            
            $ar=array(
                'first_name'=>$_POST['first_name'],
                'middle_name'=>$_POST['middle_name'],
                'last_name'=>$_POST['last_name'],
                'father_name'=>$_POST['father_name'],
                'mother_name'=>$_POST['mother_name'],
                'class'=>$_POST['class'],
                'state'=>$state_id,
                'email'=>$_POST['email'],
                'period_id'=>$period->period_id,
                'address1'=>$_POST['address'],
                'mobile'=>$_POST['mobile'],
                'school_code'=>$data['school']->school_code,
                'gender'=>$_POST['gender'],
                'PRID'=>$prid,
                'date'=> date('Y-m-d'),
                'school_id'=>$school_id
                );
                
            // print_R($ar);die;
             $this->db->insert('students',$ar);
            $id= $this->db->insert_id();
            // echo $prid;die;
            $stu=$this->db->get_where('students',array('id'=>$id))->row();
            $prid=$stu->PRID;
            $this->session->set_userdata('prid',$prid);
            
            // $sender = 'donotreply@marrs.in';
            // $recipient = $_POST['email'];

            // $subject = "Marrs School Level Login PRID";
            // $message = " Use this PRID as username and password. To login and purchase products, donload invoice PRID ".$prid;
            // $headers = 'From:' . $sender;
            // mail($recipient, $subject, $message, $headers);
            
            
            if(isset($prid)){
              
                redirect('welcome/registration_log', 'refresh'); 
            }else{
                redirect('https://marrs.in', 'refresh'); 
            }
            
            
        }
        
        $this->load->view('register_form',$data);
    }
  
        public function edit_registration_log()
        {
            if(!empty($this->session->userdata('prid'))){
                if(isset($_POST['submit'])){
                    // print_r($_POST);die;
                    $ar=array(
                    'gender'=>$_POST['gender'],
                    'first_name'=>$_POST['first_name'],
                    'middle_name'=>$_POST['middle_name'],
                    'last_name'=>$_POST['last_name'],
                    'class'=>$_POST['class']
                    );
                $this->db->where('PRID',$this->session->userdata('prid'));
                $this->db->update('students',$ar);
                $this->session->set_flashdata('success','Stduent Details Updated Successfully ...');
                redirect('welcome/registration_log', 'refresh');
                }
                if(isset($_POST['back'])){
                    redirect('welcome/registration_log', 'refresh');
                }
                $this->db->select('first_name,middle_name,last_name,class,gender');
                $this->db->from('students');
                $this->db->where('PRID',$this->session->userdata('prid'));
                $query=$this->db->get();
                $data['student']=$query->row();
                // print_r($data['student']);die;
                
                $this->load->view('edit_registration_log',$data);
                
            }else{
                redirect('https://marrs.in', 'refresh');
            }    
            
        }
    
        public function chlid_form()
        {
            if(!empty($this->session->userdata('prid'))){
                    // $prid=$this->session->userdata('prid');
        
            
                $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
                if(!empty($student)){ 
                    if(isset($_POST['submit'])){    
                        $ar=array(
                            'name'=>$_POST['first_name'].'-'.$_POST['last_name'],
                            'class'=>$_POST['class'],
                            'gender'=>$_POST['gender'],
                            
                        );
                        $this->session->set_userdata('child',$ar);
                        redirect('welcome/child_cart', 'refresh');
                    }          
                    if(isset($_POST['back'])){    
                        redirect('welcome/registration_log', 'refresh');
                    }    
                    
                    $this->load->view('registration_form_child',$data);            
                }else{
                    redirect('https://marrs.in', 'refresh');
                }
            }else{
                redirect('https://marrs.in', 'refresh');
            }
            
        }
    
        public function registration_log_test()
        {
        
            if(!empty($this->session->userdata('prid'))){
                // $prid=$this->session->userdata('prid');
    
        
                $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
                if(!empty($student)){    
                    
                    $this->db->select('product_name')
                        ->where('status', 'Active');  // Mandatory condition

                            // Array to hold the OR conditions
                            $or_conditions = array();
                            
                            if ($student->class == 'Nursery') {
                                $or_conditions[] = array('class_key' => '1');
                                
                            }
                            
                            if ($student->class == 'LKG' || $student->class == 'UKG') {
                                $or_conditions[] = array('class_key' => '5');
                                $or_conditions[] = array('class_key' => '1');
                                $or_conditions[] = array('class_key' => '4');
                                
                            }
                            
                            if (in_array($student->class, array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                                $or_conditions[] = array('class_key' => '2');
                                $or_conditions[] = array('class_key' => '4');
                                
                            }
                            
                            if (in_array($student->class, array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                                $or_conditions[] = array('class_key' => '2');
                            }
                            
                            // Apply the OR conditions
                            if (!empty($or_conditions)) {
                                $this->db->group_start();  // Open bracket for grouping OR conditions
                                foreach ($or_conditions as $condition) {
                                    $this->db->or_where($condition);
                                }
                                $this->db->group_end();  // Close bracket for grouping OR conditions
                            }
                            
                            // Complete the query and get the results
                            $all_products = $this->db->get('products')
                                                     ->result();
                            
                            // Debug the query
                            // echo $this->db->last_query();
                    
                    
                    $school_products = $this->db->select('product_name')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->group_by('product_name')
                                     ->get('product_to_school')
                                     ->result();
                   
                    // print_r($school_products);die;
                    $all_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $all_products);
                    
                    $school_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $school_products);
                    $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                    // print_r($data['product_list']);die;
                    
                    if(isset($_POST['Edit'])){
                        
                        redirect('welcome/edit_registration_log', 'refresh');
                    }
                    
                    
                    $this->load->view('registration_login_test',$data);
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
        }
        
        public function child_cart()
        {
        // print_r($_SESSION);die;
            if(!empty($this->session->userdata('prid'))){
                    // $prid=$this->session->userdata('prid');
                
            
                $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
                if(!empty($student)){ 
                    $data['child']=$this->session->userdata('child');
                    $this->db->select('product_name')
                            ->where('status', 'Active');  // Mandatory condition
    
                                // Array to hold the OR conditions
                                $or_conditions = array();
                                
                                if ($data['child']['class'] == 'Nursery') {
                                    $or_conditions[] = array('class_key' => '1');
                                }
                                
                                if ($data['child']['class'] == 'LKG' || $data['child']['class'] == 'UKG') {
                                    $or_conditions[] = array('class_key' => '5');
                                    $or_conditions[] = array('class_key' => '1');
                                    $or_conditions[] = array('class_key' => '4');
                                }
                                
                                if (in_array($data['child']['class'], array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                                    $or_conditions[] = array('class_key' => '2');
                                    $or_conditions[] = array('class_key' => '4');
                                }
                                
                                if (in_array($data['child']['class'], array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                                    $or_conditions[] = array('class_key' => '2');
                                }
                                
                                // Apply the OR conditions
                                if (!empty($or_conditions)) {
                                    $this->db->group_start();  // Open bracket for grouping OR conditions
                                    foreach ($or_conditions as $condition) {
                                        $this->db->or_where($condition);
                                    }
                                    $this->db->group_end();  // Close bracket for grouping OR conditions
                                }
                                
                                // Complete the query and get the results
                                $all_products = $this->db->get('products')
                                                         ->result();
                                
                                // Debug the query
                                // echo $this->db->last_query();
                        
                        
                                    $school_products = $this->db->select('product_name')
                                         ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                         ->order_by('id','DESC')
                                         ->group_by('product_name')
                                         ->get('product_to_school')
                                         ->result();
                       
                        // print_r($school_products);die;
                        $all_product_names = array_map(function($product) {
                            return $product->product_name;
                        }, $all_products);
                        
                        $school_product_names = array_map(function($product) {
                            return $product->product_name;
                        }, $school_products);
                        
                        
                        $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                        
                        
                        if(isset($_POST['back'])){
                            $this->db->where('prid',$this->session->userdata('prid'));
                            $this->db->delete('cart_prid_child');
                            redirect('welcome/registration_log', 'refresh');
                        }
                        
                    $this->load->view('child_cart',$data); 
                }else{
                    redirect('https://marrs.in', 'refresh');
                }
            }else{
                redirect('https://marrs.in', 'refresh');
            }    
                    
        
        }
    
        public function reg_logout()
        {
            $this->session->unset_userdata('school_code');
            $this->session->unset_userdata('otp');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('prid');
            redirect('https://marrs.in', 'refresh');
        }
    
        public function add_rem_()
        {
        // print_r($_POST['value']);
        $prid=$this->session->userdata('prid');
        // echo $prid;die;
        $a=explode("+",$_POST['value']);
        $res=$this->db->get_where('cart_prid_child',array('amount'=>$a[0],'product'=>$a[1],'prid'=>$prid))->row();
        // echo $this->db->last_query();die;
        $ar=array(
            'amount'=>$a[0],
            'prid'=>$prid,
            'product'=>$a[1],
            'class'=>$a[2],
            );
        
        if(!empty($res)){
            $this->db->where('id',$res->id);
            $this->db->delete('cart_prid_child');
        }    
        else{   
            $this->db->insert('cart_prid_child',$ar);
        }
        
        $res=$this->db->get_where('cart_prid_child',array('prid'=>$prid))->result();
        echo count($res);
    }

        public function get_cart_()
        {
             $prid=$this->session->userdata('prid');
             $cartData = $this->db->select('product,amount')
                             ->where(array('prid' => $prid))
                             ->get('cart_prid_child')
                             ->result();
            echo json_encode($cartData);
        }
    
        public function add_rem()
        {
            // print_r($_POST['value']);die;
            // $prid=$this->session->userdata('prid');
            
            $a=explode("+",$_POST['value']);
            
            
          
            
                // print_r($_SESSION);die;
                
                $prid = $this->session->userdata('prid');
                
                
                $student = $this->db->get_where('zoomzoom_prid',array('prid' => $prid))->row();
                $period_id = $student->period_id;
                
                
                $product_to_school = $this->db->get_where('zoomzoom_schedule_cin',array('zoomzoom_schedule_id'=>$student->sch_id))->row();
                $competition = $this->db->get_where('competition_product_state',array('id' => $product_to_school->comp_id))->row();
            
                $revenue_setting = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
            
	           // print_r($revenue_setting);die;    
	            
                $return = $this->revenue_calculation2($prid, $revenue_setting->id, $competition->id, $a[0], $competition->product_name, $student->name, $student->class);
                // echo '<br>';
                // print_r($return);die;
                        
                $res=$this->db->get_where('zoomzoom_purchase',array('amount'=>$a[0],'item'=>$a[1],'prid'=>$prid,'student_name'=>$a[2],'class'=>$a['3'],'sch_id'=>$a['4']))->row();
                $ar=array(
                    'amount'=>$a[0],
                    'prid'=>$prid,
                    'item'=>$a[1],
                    'student_name'=>$a[2],
                    'class'=>$a[3],
                    'status'=>'Pending',
                    'sch_id'=>$a['4']
                );
            
                if(!empty($res)){
                    // $this->db->where('id',$res->id);
                    // $this->db->delete('cart_prid');
                    $res=$this->db->get_where('zoomzoom_purchase',array('prid'=>$prid,'status'=>'Pending'))->result();
                    echo count($res);
                }    
                else{  
                    $this->db->insert('cart_prid_lunar',$return);
                    
                    $this->db->insert('zoomzoom_purchase',$ar);
                    $res=$this->db->get_where('zoomzoom_purchase',array('prid'=>$prid,'status'=>'Pending'))->result();
                    echo count($res);
                }
        }
        
        
        public function revenue_calculation2($prid, $revenue_setting_id, $comp_id, $amount, $product_name, $name, $class)
        {
            // Fetch student
            $student = $this->db->get_where('zoomzoom_prid',array('prid' => $prid))->row();
        
            // Fetch competition and revenue setting details
            $this->db->select('competition_product_state.*, revenue_setting.*');
            $this->db->from('competition_product_state');
            $this->db->join('revenue_setting', 'revenue_setting.id = competition_product_state.revenue_setting_id', 'left');
            $this->db->where('competition_product_state.id', $comp_id);
            $competition = $this->db->get()->row();
        
            // Fetch product_to_school info
            // $product_to_school = $this->db->get_where('product_to_school', [
            //     'product_name' => $product_name,
            //     'school_id'    => $school_id,
            //     'period_id'    => $competition->period_id
            // ])->row();
            
            $product_to_school = $this->db->get_where('zoomzoom_schedule_cin',array('zoomzoom_schedule_id'=>$student->sch_id))->row();
        
            // Fetch free material maker if available
            $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id, assigned_materials.price');
            $this->db->from('study_material');
            $this->db->join('assigned_materials', 'assigned_materials.mat_id = study_material.id');
            $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_materials.maker_id');
            $this->db->where([
                'assigned_materials.period_id' => $competition->period_id,
                'study_material.status'        => 'Free',
                'class'                        => $student->class,
                'product_name'                 => $product_name,
                'clevel'                       => $competition->clevel
            ]);
            $this->db->order_by('study_material.id', 'DESC');
            $mat_free = $this->db->get()->row();
            $maker_gst_per = $mat_free->maker_gst_per;
            $maker_id = $mat_free->maker_id;
        
            // Extract revenue percentages
            $franchise_per = $product_to_school->franchise_percentage ?? 0;
            $aviansys_per  = $product_to_school->aviansys_percentage ?? 0;
            $manage_per    = $product_to_school->management_percentage ?? 0;
            $crm_fix       = $product_to_school->crm_fix ?? 0;
            $school_amount = $product_to_school->school_amount ?? 0;
        
            // Step 1: Razorpay charge
            $razorpay_cut = round($amount * 0.03); // 3% assumed
            $after_razorpay = $amount - $razorpay_cut;
            
        
            // Step 2: Split GST (assuming inclusive)
            $base_amount = round($after_razorpay / 1.18, 0);
            $total_gst = $gst_total = round($after_razorpay - $base_amount, 0);
            
            // Initialize maker details
            $free_royalty = 0;
            $maker_id = $maker_razorpay_id = $maker_razorpay_name = '';
            $maker_gst = 0;
            if (!empty($mat_free)) {
                
                $maker_id = $mat_free->material_maker_id;
                $maker_razorpay_id = $mat_free->razorpay_id;
                $maker_razorpay_name = $mat_free->account_name;
                $maker_gst_per = $mat_free->gst;
                $free_royalty = $competition->study_material_free_royalty;
                if($maker_gst_per > 0){
                    $maker_gst = round($gst_total * $maker_gst_per / 100, 0);
                }
                $free_royalty = $free_royalty + $maker_gst;
            }
            
            $net_base = $base_amount - $free_royalty;
            
            // echo $base_amount.'<- base after free royaty->'.$net_base;die;
            // Step 3: Deduct CRM, school, free royalty
            $net_base = $net_base  - $school_amount;
            // echo $school_amount.'<-school after school->'.$net_base;die;
            
            
            // echo $net_base;die;
            $franchise = $this->db->get_where('franchise', ['franchise_id' => $product_to_school->franchise_id])->row();
            $aviansys = $this->db->get_where('gst_account_marrs', ['id' => '2'])->row();
            $manage   = $this->db->get_where('gst_account_marrs', ['id' => '3'])->row();
            $crm_acc  = $this->db->get_where('gst_account_marrs', ['id' => '5'])->row();
            $gst_acc  = $this->db->get_where('gst_account_marrs', ['id' => '1'])->row();
        
        
            $associate_gst = 0;
            $associate_amount = 0;
            $associate_id = null;
            $associate_name = null;
            $associate_account_id = null;
            
            
            if (!empty($product_to_school->associate_id)) {
                $associate = $this->db->get_where('associates', ['associate_id' => $product_to_school->associate_id])->row();
                $associate_bank_details = $this->db->get_where('associate_bank_details', ['associate_id' => $product_to_school->associate_id])->row();
                
                if ($associate) {
                    $associate_id = $associate->associate_id;
                    $associate_name = $associate_bank_details->account_razorpay_name ?? '';
                    $associate_account_id = $associate_bank_details->razorpay_id ?? '';
            
                    $associate_per = $product_to_school->associate_cut ?? 0;
            
                    $associate_amount = round($net_base * ($associate_per / 100), 0);
            
                    if (strtolower($associate->gst) == 'yes') {
                        $associate_gst = round($gst_total * ($associate_per / 100), 0);
                    }
                }
                
                if($franchise_per > 0){
                    $franchise_per = $franchise_per - $associate_per;
                }
            }
           
            
            
            // Step 4: Compute shares
            $franchise_amount = round($net_base * $franchise_per / 100, 0);
            $aviansys_amount  = round($net_base * $aviansys_per / 100, 0);
            $management_amount = round($net_base * $manage_per / 100, 0);
            
            
            
            // Step 5: GST distribution
            $franchise_gst = 0;
            if(strtolower($franchise->gst) == 'yes'){
                $franchise_gst = round($gst_total * $franchise_per / 100, 0);
            }
            $aviansys_gst  = round($gst_total * $aviansys_per / 100, 0);
            $management_gst = 0;
            
            if($manage->gst > 0){
                $management_gst = round($management_amount * $manage->gst / 100, 0);
            }
            $crm_gst=0;
            
            if($crm_acc->gst > 0 ){
                $crm_gst = round($crm_fix *  $crm_acc->gst/ 100, 0);
            }
            // echo $net_base.'<-Total '.$franchise_amount.' + '.$aviansys_amount.' + '.$management_amount.' + '.$associate_amount.' + '.$crm_fix;die;
            
            // Step 6: Remaining GST to Marrs
            $marrs_gst = round($gst_total - ($franchise_gst + $aviansys_gst + $maker_gst + $crm_gst + $management_gst + $associate_gst), 0);
            $marrs_left = round($net_base - ($franchise_amount + $aviansys_amount + $management_amount + $associate_amount + $crm_fix ), 0);
            
            // echo $marrs_left;die;
            // Final return array
            
            
            return [
                'prid'                => $student->prid,
                'product'             => $product_name,
                'class'               => $class,
                'name'                => $name,
                'item'                => 'Competition',
                'amount'              => $amount,
                'marrs_gst'           => $marrs_gst,
                'marrs_left'          => $marrs_left,
                'franchise_amount'    => $franchise_amount,
                'franchise_gst'       => $franchise_gst,
                'school_amount'       => $school_amount,
                'associate_amount'    => $associate_amount,
                'associate_gst'       => $associate_gst,
                'free_mat_royalty'    => $free_royalty,
                'crm_fix'             => $crm_fix,
                'manage_amount'       => $management_amount,
                'aviansys_amount'     => $aviansys_amount,
                'aviansys_gst'        => $aviansys_gst,
                'razorpay_cut'        => $razorpay_cut,
                'payment_order_id'    => '',
                'inserted_date'       => date("Y-m-d"),
                'inserted_time'       => date("H:i:s"),
                'maker_id'            => $maker_id,
                'maker_razorpay_id'   => $maker_razorpay_id,
                'free_royalti_amount' => $free_royalty,
                'maker_razorpay_name' => $maker_razorpay_name,
                'franchise_id'        => $competition->franchise_id,
                'school_id'           => $student->school_id ?? '',
                'razpay_service'      => $razorpay_cut,
                'franchise_account_id'=> $franchise->account_id ?? '',
                'franchise_razorpay_name' => $franchise->account_razorpay_name ?? '',
                'associate_id'        => $associate_id,
                'associate_account_id'=> $associate_account_id,
                'associate_razorpay_name' => $associate_name,
                'crm_account_id'      => $crm_acc->rozarpay_id ?? '',
                'crm_razorpay_name'   => $crm_acc->account_name ?? '',
                'marrsgst_account_id' => $gst_acc->rozarpay_id ?? '',
                'marrsgstgst_razorpay_name' => $gst_acc->account_name ?? '',
                'marrsmanage_account_id' => $manage->rozarpay_id ?? '',
                'marrsmanage_razorpay_name' => $manage->account_name ?? '',
                'aviansys_account_id' => $aviansys->rozarpay_id ?? '',
                'aviansys_razorpay_name' => $aviansys->account_name ?? '',
                
                'base_amount'         => $base_amount,
                'gst_total'           => $total_gst,
                'crm_gst'             => $crm_gst,    
                'manage_gst'          => $management_gst,
            ];
            
        }
        

        public function add_rem_pro()
        {
            $prid=$this->session->userdata('prid');
            $this->db->where('zoomzoom_purchase_id',$_POST['value']);
            $this->db->delete('zoomzoom_purchase');
            
            $this->db->where('prid',$prid);
            $this->db->delete('cart_prid_lunar');
            
            $res=$this->db->get_where('zoomzoom_purchase',array('prid'=>$prid,'status'=>'Pending'))->result();
            echo count($res);
        }
    
        public function get_cart()
        {
            $prid=$this->session->userdata('prid');
            $cartData = $this->db->select('zoomzoom_purchase_id,item,amount,student_name,class')
                            ->where(array('prid' => $prid,'status !='=>'Paid'))
                        
                            ->get('zoomzoom_purchase')
                            ->result();
            echo json_encode($cartData);
        }
    
        public function class_product()
        {
            // print_r($_SESSION);
            // print_r($_POST['class_name']);
            $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
                if(!empty($student)){    
                        
                        $this->db->select('product_name')
                            ->where('status', 'Active');  // Mandatory condition
    
                                // Array to hold the OR conditions
                                $or_conditions = array();
                                
                                if ($_POST['class_name'] == 'Nursery') {
                                    $or_conditions[] = array('class_key' => '1');
                                    
                                }
                                
                                if ($_POST['class_name'] == 'LKG' || $_POST['class_name'] == 'UKG') {
                                    $or_conditions[] = array('class_key' => '5');
                                    $or_conditions[] = array('class_key' => '1');
                                    $or_conditions[] = array('class_key' => '4');
                                    
                                }
                                
                                if (in_array($_POST['class_name'], array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                                    $or_conditions[] = array('class_key' => '2');
                                    $or_conditions[] = array('class_key' => '4');
                                    
                                }
                                
                                if (in_array($_POST['class_name'], array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                                    $or_conditions[] = array('class_key' => '2');
                                }
                                
                                // Apply the OR conditions
                                if (!empty($or_conditions)) {
                                    $this->db->group_start();  // Open bracket for grouping OR conditions
                                    foreach ($or_conditions as $condition) {
                                        $this->db->or_where($condition);
                                    }
                                    $this->db->group_end();  // Close bracket for grouping OR conditions
                                }
                                
                                // Complete the query and get the results
                                $all_products = $this->db->get('products')
                                                         ->result();
                                
                                // Debug the query
                                // echo $this->db->last_query();
                        
                        
                        $school_products = $this->db->select('product_name')
                                         ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                         ->order_by('id','DESC')
                                         ->group_by('product_name')
                                         ->get('product_to_school')
                                         ->result();
                       
                        // print_r($school_products);die;
                        $all_product_names = array_map(function($product) {
                            return $product->product_name;
                        }, $all_products);
                        
                        $school_product_names = array_map(function($product) {
                            return $product->product_name;
                        }, $school_products);
                        $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                        // print_r($data['product_list']);die;
                        
                        
                        if(!empty($data['product_list'])){
                            $ar=array();
                            foreach($data['product_list'] as $product){
                                // print_r($product);
                                $price= $this->db->get_where('product_to_school',array('product_name'=>$product,'school_id'=>$student->school_id,'period_id'=>$student->period_id))->row();
                                $amount=$price->amount;   
                                $a=array('product_name'=>$product,'amount'=>$amount);
                                array_push($ar,$a);
                            }
                            // die;
                            echo json_encode($ar);  
                        }else{
                            echo json_encode();  
                        }
                      
                }
        }

    	public function schoolList($id='')
        {
    	    $state_id =$this->input->post('state_id');
    	    $data['schools']=$this->db->get_where('schools',array('stateID'=>$state_id))->result_array();	 
    	    $this->load->view("getSchoolList.php",$data); 
        }
    
    	public function schoolListByArea($id='')
        {
    	    $area_code =$this->input->post('area_code');
    	    $data['schools']=$this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$area_code))->result_array();	
    	    //print_r($data['schools']);die;
    	$this->load->view("getSchoolList.php",$data); 
    	
      }

	    public function arescodeList($id='')
        {
        	$state_id =$this->input->post('state_id');
        	$data['area']=$this->db->get_where('areas',array('state_id'=>$state_id))->result_array();	 
        	$this->load->view("getAreacodeList.php",$data); 
        	
          }
	
		public function registration_detail($data)
	    { 
	        print_r($_SESSION);die;
    	   // $this->session->unset_userdata('post');
    	   // $data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();
    	   // $data['detail']= $_POST;
    	   // $this->load->view('registration_detail',$data);
	    }
	    
	    public function registration_detail_access()
    	{
	    
    	    $data['school']= $this->db->get_where('school_new',array('school_code'=>$_SESSION['school_code']))->row();
    	    
    	    $data['state_id']=$data['school']->state;
    	    $data['area_code']=$data['school']->area_code;
    	    $data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();
    	    $data['detail']= $_POST;
    	    
    	    $this->load->view('registration_detail_access',$data);
    	}

        public function registeration()
        {
            $email=$_SESSION['email'];
            $this->load->view();
    	    $this->db->select('*');
    	    $this->db->from('product_to_school');
    	    $this->db->where();
    	    $this->db->where();
    	    $this->db->where();
    	    $query=$this->db->get();
            $data['product_to_school']= $query->result_array();
            
            $this->load->view('registeration',$data);
        }
	
	    public function add_school($id='')
	    {
	        if(isset($_POST['submit'])) {
	        
	        $code = $this->input->post('areacode');
	        
	        $this->db->select_max('id');
            $schol_id = $this->db->get('school_new')->row()->id;
            //print_r($schol_id);die;
            $school = $this->db->get_where('school_new',array('id'=>$schol_id))->row();
           
            if(empty($school->school_code)){ 
                
                $increment = 'S10000';
                $acess = $code.$increment;
                
            }else{
                
                 $last_half = substr($school->school_code,4,9)+1;
                 $acess =$code.'S'.$last_half;
                
            }
	          //print_r($acess);die;
	        $school_array = array(
	            'country'                 => $this->input->post('country'),
	            'school_code'            =>  $acess,
	            'state'                  =>  $this->input->post('state_id'),
	            'area_code'              =>  $this->input->post('areacode'),
	            'school_name'             =>  $this->input->post('school_name'),
	            'school_email'             =>  $this->input->post('school_email'),
	            'school_phone'             =>  $this->input->post('school_phone'),
	            'school_mobile'             =>  $this->input->post('school_phone'),
	            'school_address'             =>  $this->input->post('school_address1').$this->input->post('school_address2'),
	            'school_principal_name'      =>  $this->input->post('school_principal_name'),
	            'principal_email'            =>  $this->input->post('principal_email'),   
	            'principal_phone'            => $this->input->post('principal_phone'),
	            'school_coordinator_name'    => $this->input->post('coordinator_name'),
	            'school_coordinator_email'    =>$this->input->post('coordinator_email'),
	            'coordinator_phone'           =>$this->input->post('coordinator_phone'),
	            'school_medium'              => $this->input->post('school_medium'),
	            'school_board'              => $this->input->post('school_board'),
	            'pin'                       => $this->input->post('pincode')
	            
	            );
	           //print_r($school_array);die; 
	            //$this->registration_detail($this->input->post('state_id'),$this->input->post('areacode'),$acess);
	            //$data =array('school_code'=>$acess);
	            
	            $msg = $this->session->set_flashdata('msg','School Code : ' .$acess.' Genrated Successfully');
	            $this->db->insert('school_new',$school_array);
	            redirect('welcome/registration_detail');
	            
	            
	    }
	    
	$data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();    
    $this->load->view("addschool.php",$data); 
       
    }
    
        public function studentdata()
        {
    
               $email = $this->session->userdata('email');
               $prid = $this->session->userdata('prid');
             // $data['studentzoom']= $this->db->get_where('cin_zoomzoom', array('email' => $email))->result_array();
              $data['students']= $this->db->get_where('students', array('email' => $email))->row_array();
               //$data['student']= $this->db->get_where('students', array('email' => $email))->result_array();
               
                     $this->db->select('students.id,students.first_name,students.last_name,students.email,students.mobile,students.class,study_material_byprid.cin');
                     $this->db->from('students');
                     $this->db->join('study_material_byprid','study_material_byprid.prid=students.PRID','left');
                     $this->db->where('students.PRID',$prid);
                     $data['student']= $this->db->get()->result_array();
                    //echo $prid;
                    
                    
                     $this->db->select('cin_list.id,cin_list.cin,cin_list.class,cin_list.student_name,cin_result.product_name');
                     $this->db->from('cin_list');
                     $this->db->join('cin_result','cin_result.cin=cin_list.cin');
                     $this->db->where('cin_list.stud_email',$email);
                   $data['student_cin']= $this->db->get()->result_array();
        	    
             
             //print_r($data['student']);die;
             $this->load->view('list_cinproductdata',$data);
        }

        public function student_profile()
        {
    
               $id = $this->uri->segment('3');
               
               if(isset($_POST['submit']))
               {
                   $array = array(
                       'mobile'=>$this->input->post('mobile'),
                       'whatsapp'=>$this->input->post('whatsapp'),
                       'email'=>$this->input->post('email'),
                       'address1'=>$this->input->post('address1'),
                       'class'=>$this->input->post('class'),
                       'pin'=>$this->input->post('pin')
                       );
                       $this->db->where('id', $id);
                       $this->db->update('students', $array);
                       $this->session->set_flashdata('success','Updated record Successfully');
                       redirect('welcome/studentdata');
               }
               $data['studentdata']= $this->db->get_where('students', array('id' => $id))->row_array();
               $data['class']= $this->db->get_where('class')->result_array();
              $data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();  
             // print_r($data['state']);die;
             $this->load->view('student_profile',$data);
             
             
             
        }

        public function student_profile_cin()
        {
    
                $id = $this->uri->segment('3');
                
                
               if(isset($_POST['submit']))
               {
                   $array = array(
                       'stud_phone'=>$this->input->post('mobile'),
                       //'whatsapp'=>$this->input->post('whatsapp'),
                       'stud_email'=>$this->input->post('email'),
                       'address1'=>$this->input->post('address1'),
                       'class'=>$this->input->post('class')
                       //'pin'=>$this->input->post('pin')
                       );
                       $this->db->where('id', $id);
                       $this->db->update('cin_list', $array);
                       $this->session->set_flashdata('success','Updated record Successfully');
                       redirect('welcome/studentdata');
               }
                $data['studentdata']=$this->db->get_where('cin_list', array('id' => $id))->row_array();
              // echo $this->db->last_query();die;
               $data['class']= $this->db->get_where('class')->result_array();
              $data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();  
              //print_r($data['studentdata_cin']);die;
             $this->load->view('student_profile_cin',$data);
             
             
             
        }

        public function marrsChallenges()
        {
            $this->load->view('puchase_withoutaccesscode.php');
        }
 
        public function removeItem($id='')
        {
              $prid=$this->session->userdata('prid');
         	  $product_name = $_POST['product_name'];
         	  $this->db->where('prid',$prid);
         	  $this->db->where('product_name',$product_name);
         	  $this->db->delete('cart');
     
        }

        public function resendotp_($id='')
        {
     
             $email = $this->input->post('email');
             $otp = rand(100000, 999999); 
             $_SESSION['session_otp_email'] = $otp;
             $sender = 'donotreply@marrs.in';
             $recipient = $email;
             $subject = "Marrs Email Verification";
             $message = " Your one time email verification code is ".$otp;
             $headers = 'From:' . $sender;
             mail($recipient, $subject, $message, $headers);
                                
        }
 
 
        public function resendotp($id='')
        {
            session_start(); // Ensure session is started
        
            $email = $this->input->post('email');
            $otp = rand(100000, 999999);
            $_SESSION['session_otp_email'] = $otp;
        
            // Set API key for Brevo
            $apiKey = "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";
            $url = "https://api.brevo.com/v3/smtp/email";
        
            // Email Data for Brevo API
            $emailData = [
                "sender" => [
                    "name" => "MaRRS Enquiry",
                    "email" => "donotreply@marrs.in"
                ],
                "to" => [
                    [
                        "email" => $email,
                        "name" => "User"
                    ]
                ],
                "subject" => "Marrs Email Verification",
                "htmlContent" => "<p>Your one-time email verification code is <strong>$otp</strong>.</p>",
                "textContent" => "Your one-time email verification code is $otp."
            ];
        
            // Convert data to JSON
            $jsonData = json_encode($emailData);
        
            // cURL request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "accept: application/json",
                "api-key: $apiKey",
                "content-type: application/json"
            ]);
        
            // Execute request
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            // Check API response
            if ($httpCode == 201) {
                echo "OTP resent successfully!";
            } else {
                echo "Error: " . $response;
            }
        }

 
 
        public function directregistration($id='')
        {
           $fid = $this->uri->segment('4');
           $pid = $this->uri->segment('6');
           $_SESSION['franchise_id']=$fid;
           $_SESSION['product_id']=$pid;
           $res = $this->db->get_where('school_new',array('franchise_id'=>$fid))->row();
         
           if(!empty($res->school_name)){
    	   redirect('welcome/current_registration');
           }else{
               $franchise = $this->db->get_where('franchise',array('franchise_id'=>$fid))->row();
               
               $school = $franchise->franchise_first_name.'ZoomZoom-Online School';
               $sh = $this->db->order_by('id','DESC')->get_where('school_new')->row()->school_code;
               
                     $first='OG1';
                     $mid='S';
                     $last=substr($sh, 4);
                     $last=$last+1;
                     $school_code=$first.$mid.$last;
                     
                $new_array = array(
                   'school_name'  =>$school,
                   'franchise_id' =>$fid,
                   'country'     =>'105',
                   'state'       =>$franchise->state_id,
                   'area_code'   =>'OG1',
                   'school_code' =>$school_code
                   
                   );
                   //print_r($new_array);die;
                $this->db->insert('school_new',$new_array);
                redirect('welcome/current_registration');
               
            } 
	
        }
 
        public function new_purchase($id='')
        {
        // print_r($_SESSION);die;
          $this->load->view('new_purchase');
    	
        }
 
        public function logintopage($id='')
        {
           $id = $this->uri->segment(3);
           $this->session->set_userdata('cin',$id);
           redirect('welcome/commonlogin');
        }
        
        public function wcregistration_new()
    	{
	   //  echo $this->session->userdata('school_code');die;
	        $data['email'] = $_POST['email'];
	        if(!empty($data['email']) && empty($_POST['otp'])){
	      
	        $otp = rand(100000, 999999); 
	        $_SESSION['session_otp'] = $otp;
	        
        	    $data = array(
                    'email' => $data['email'],
                    'otp' => $_SESSION['session_otp'],
                    'message' => " Your one time email verification code is "
                );
                // print_r($data);die;
                $postFields = json_encode($data);
               
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.cambridgeolympiads.com/email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                
                CURLOPT_POSTFIELDS => $postFields,
            
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));


                $response = curl_exec($curl);
                curl_close($curl);

                // print_r($response);
                // die;
        
                $this->session->set_userdata('email',$_POST['email']);
                $this->session->set_flashdata('otpdelay','OTP will be generated in a minutes time');
    	           
           
    		   }
    		   elseif(!empty($_POST['email']) && !empty($_POST['otp'])){
    		       
    	           $this->session->set_flashdata('otperror','Otp not Valid. Please enter valid Otp');
    	           
        	        if($_POST['otp'] == $_SESSION['session_otp']){
        	            
        	            $_SESSION['email']=$_POST['email'];
        	            $this->session->set_userdata('school_code',$this->session->userdata('wc_school_code'));
        	            $this->session->set_userdata('email',$this->session->userdata('email'));
        	            $student= $this->db->get_where('students',array('email'=>$_SESSION['email'],'period_id'=>'14','school_code'=>'AA1S1180000'))->row();
    	                    if(!empty($student)){
    	                        $this->session->set_userdata('prid',$student->PRID);
    	                        redirect('welcome/registration_log2', 'refresh'); 
    	                    }else{
    	                        redirect('welcome/register_form2', 'refresh'); 
    	                    }
        	            
        	             
        	        }
    	         
    	     }
    	    $this->load->view('wcregistration_new',$data);
    	}
    	
        public function register_form2()
        {
            // $code='AA1S10583';
            $data['email']=$email=$_SESSION['email'];
            // echo $this->session->userdata('school_code');die;
            $data['school']= $this->db->get_where('school_new',array('school_code'=>$this->session->userdata('wc_school_code')))->row();
            
            // print_r($data['school']);die;
    	    $school_id=$data['school']->id;
            $state_id=$data['school']->state;
            $data['state']= $this->db->get_where('states',array('state_subdivision_id'=>$state_id))->row();
            $data['period']=$period= $this->db->get_where('period',array('status'=>'Active'))->row();
           
            if(isset($_POST['submit'])){
                
                $this->db->select('*');
                $this->db->from('students');
                // $this->db->where('period_id',$period->period_id);
                $this->db->order_by('id','DESC');
                $query=$this->db->get();
                // echo $this->db->last_query();die;
                $student= $query->row();
                $student_id=$student->id;
                $prid=$period->initials.'MREG'.$student_id;
                
                $ar=array(
                'first_name'=>$_POST['first_name'],
                'middle_name'=>$_POST['middle_name'],
                'last_name'=>$_POST['last_name'],
                'father_name'=>$_POST['father_name'],
                'mother_name'=>$_POST['mother_name'],
                'class'=>$_POST['class'],
                'state'=>$state_id,
                'email'=>$_POST['email'],
                'period_id'=>$period->period_id,
                'address1'=>$_POST['address'],
                'mobile'=>$_POST['mobile'],
                'school_code'=>$data['school']->school_code,
                'gender'=>$_POST['gender'],
                'PRID'=>$prid,
                'date'=> date('Y-m-d'),
                'school_id'=>$school_id
                );
                
            // print_R($ar);die;
             $this->db->insert('students',$ar);
            $id= $this->db->insert_id();
            // echo $prid;die;
            $stu=$this->db->get_where('students',array('id'=>$id))->row();
            $prid=$stu->PRID;
            $this->session->set_userdata('prid',$prid);
            
            if(isset($prid)){
              
                redirect('welcome/registration_log2', 'refresh'); 
            }else{
                redirect('https://marrs.in', 'refresh'); 
            }
            
            
            }
            
            $this->load->view('register_form2',$data);
        }
    
        public function registration_log2()
        {
        
            if(!empty($this->session->userdata('prid'))){
                    // $prid=$this->session->userdata('prid');
        
            
                $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                     //print_r($student);die;
                if(!empty($student)){    
                    
                    $this->db->select('product_name')
                        ->where('status', 'Active');  // Mandatory condition

                            // Array to hold the OR conditions
                            $or_conditions = array();
                            
                            if ($student->class == 'Nursery') {
                                $or_conditions[] = array('class_key' => '1');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if ($student->class == 'LKG' || $student->class == 'UKG') {
                                $or_conditions[] = array('class_key' => '5');
                                $or_conditions[] = array('class_key' => '1');
                                $or_conditions[] = array('class_key' => '4');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if (in_array($student->class, array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                                $or_conditions[] = array('class_key' => '2');
                                $or_conditions[] = array('class_key' => '4');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if (in_array($student->class, array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                                $or_conditions[] = array('class_key' => '2');
                            }
                            
                            // Apply the OR conditions
                            if (!empty($or_conditions)) {
                                $this->db->group_start();  // Open bracket for grouping OR conditions
                                foreach ($or_conditions as $condition) {
                                    $this->db->or_where($condition);
                                }
                                $this->db->group_end();  // Close bracket for grouping OR conditions
                            }
                            
                            // Complete the query and get the results
                            $all_products = $this->db->get('products')
                                                     ->result();
                            
                            // Debug the query
                            // echo $this->db->last_query();
                    
                    
                    $school_products = $this->db->select('product_name')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->group_by('product_name')
                                     ->get('product_to_school')
                                     ->result();
                   
                    // print_r($school_products);die;
                    $all_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $all_products);
                    
                    $school_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $school_products);
                    $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                    
                    $this->load->view('registration_login2',$data);
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
        }
    	
        public function wenew_registration($id='')
        {
        	$product=$this->input->post('product_name');
        	
        	$amount=$this->input->post('amount');
        	$prid=$this->input->post('prid');
        	$name=$this->input->post('name');
        	$class=$this->input->post('class');
        	$array = array('prid'=>$prid,'product'=>$product,'amount'=>$amount,'name'=>$name,'class'=>$class);
        	$res = $this->db->get_where('cart_prid',array('prid'=>$prid))->row();
        	if(empty($res)){
        	$insert = $this->db->insert('cart_prid',$array);
               return ;
               }else{
                  echo ''; 
                   
               }
               
            	
          } 	
  
        public function delete_registration($id='')
        {
    	
        	$prid=$this->input->post('prid');
        	$array = array('prid'=>$prid,);
        	 $this->db->delete('cart_prid',$array);
          
        	
          } 
  
        public function new_registrationwc()
        {
            if($_POST['school_code']){
              //echo '---';die;
              $this->session->set_userdata('wc_school_code',$_POST['school_code']);
              redirect('welcome/wcregistration_new');
        }
	
    $this->load->view('new_registrationwc');
	
  } 
  
        public function edit_registrationdata()
        {
            if(!empty($_POST['prid'])){
                if(isset($_POST['submit'])){
                    // print_r($_POST);die;
                    $ar=array(
                        'gender'=>$_POST['gender'],
                        'first_name'=>$_POST['first_name'],
                        'middle_name'=>$_POST['middle_name'],
                        'last_name'=>$_POST['last_name'],
                        'class'=>$_POST['class']
                        );
                    $this->db->where('PRID',$this->session->userdata('prid'));
                    $this->db->update('students',$ar);
                    $this->session->set_flashdata('success','Stduent Details Updated Successfully ...');
                    redirect('welcome/registration_log2', 'refresh');
                }
                if(isset($_POST['back'])){
                    redirect('welcome/registration_log2', 'refresh');
                }
                $this->db->select('first_name,middle_name,last_name,class,gender');
                $this->db->from('students');
                $this->db->where('PRID',$this->session->userdata('prid'));
                $query=$this->db->get();
                $data['student']=$query->row();
                // print_r($data['student']);die;
                
                $this->load->view('edit_registration_log2',$data);
                
            }else{
                redirect('https://marrs.in', 'refresh');
            }    
            
        }
  
        public function class_productword()
        {
            $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                     //print_r($student);die;
                if(!empty($student)){    
                    
                    $this->db->select('product_name')
                        ->where('status', 'Active');  // Mandatory condition

                            // Array to hold the OR conditions
                            $or_conditions = array();
                            
                            if ($student->class == 'Nursery') {
                                $or_conditions[] = array('class_key' => '1');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if ($student->class == 'LKG' || $student->class == 'UKG') {
                                $or_conditions[] = array('class_key' => '5');
                                $or_conditions[] = array('class_key' => '1');
                                $or_conditions[] = array('class_key' => '4');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if (in_array($student->class, array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                                $or_conditions[] = array('class_key' => '2');
                                $or_conditions[] = array('class_key' => '4');
                                $or_conditions[] = array('class_key' => '6');
                            }
                            
                            if (in_array($student->class, array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                                $or_conditions[] = array('class_key' => '2');
                            }
                            
                            // Apply the OR conditions
                            if (!empty($or_conditions)) {
                                $this->db->group_start();  // Open bracket for grouping OR conditions
                                foreach ($or_conditions as $condition) {
                                    $this->db->or_where($condition);
                                }
                                $this->db->group_end();  // Close bracket for grouping OR conditions
                            }
                            
                            // Complete the query and get the results
                            $all_products = $this->db->get('products')
                                                     ->result();
                            
                            // Debug the query
                            // echo $this->db->last_query();
                    
                    
                    $school_products = $this->db->select('product_name')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->group_by('product_name')
                                     ->get('product_to_school')
                                     ->result();
                   
                    // print_r($school_products);die;
                    $all_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $all_products);
                    
                    $school_product_names = array_map(function($product) {
                        return $product->product_name;
                    }, $school_products);
                    $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                      if(!empty($data['product_list'])){
                        $ar=array();
                        foreach($data['product_list'] as $product){
                            // print_r($product);
                            if($product=='MaRRS Word Chase NW'){
                               $products='MaRRS Word Chase';
                            }else{
                               $products= $product;
                            }
                            
                            $price= $this->db->get_where('product_to_school',array('product_name'=>$product,'school_id'=>$student->school_id,'period_id'=>$student->period_id))->row();
                            $amount=$price->amount;   
                            $a=array('product_name'=>$products,'amount'=>$amount);
                            array_push($ar,$a);
                        }}
                        // die;
                        echo json_encode($ar); 
                    
                  
            }
        }
  
        public function add_remwp()
        {
           // print_r($_POST['value']);
            $prid=$this->session->userdata('prid');
            
            $a=explode("+",$_POST['value']);
            $res=$this->db->get_where('cart_prid',array('amount'=>$a[0],'product'=>$a[1],'prid'=>$prid,'name'=>$a[2],'class'=>$a[3]))->row();
            $ar=array(
                'amount'=>$a[0],
                'prid'=>$prid,
                'product'=>$a[1],
                'name'=>$a[2],
                'class'=>$a[3]
                );
                
                 if(!empty($res)){
                // $this->db->where('id',$res->id);
                // $this->db->delete('cart_prid');
                $res=$this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }    
            else{   
                $this->db->insert('cart_prid',$ar);
                $res=$this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }
            
        
        }

}
?>