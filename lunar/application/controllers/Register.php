<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    
    public function __construct() {
         parent::__construct();
		
        }
        
     public function landing()
        {
            // echo $code = $this->uri->segment(3);die;
            
            // print_r($_SESSION);die;
            
            if(!empty($this->session->userdata('cin'))){
                
                $code = $this->uri->segment(3);
                
                $this->db->order_by('lunar_schedule_id', 'DESC');
                $res = $this->db->get_where(
                    'lunar_schedule_cin',
                    array('registration_code' => $code)
                )->row();
                
                $student = $this->db->get_where('cin_list',array('cin'=>$this->session->userdata('cin')))->row();
                $this->session->set_userdata('selected_class',$student->class);
                
                redirect('Register/associatelink/3','refresh');
                
                
                $data['student'] = $student = $this->db->get_where('cin_list',array('cin'=>$this->session->userdata('cin')))->row();
                    
                    // print_r($student->sch_id);die;
                    // echo $this->db->last_query();die;
                    
                $this->db->order_by('lunar_schedule_id', 'DESC');
                $res = $this->db->get_where(
                    'lunar_schedule_cin',
                    array('registration_code' => $code)
                )->row();
                
                
                $sch_id = $res->lunar_schedule_id;
                $data['schedule'] = $schedule = $res;
            
            
                    $this->db->select('*');
                    $this->db->from('lunar_prid');
                    $this->db->where('period_id', $schedule->period_id);
                    $this->db->where('email',$student->stud_email);
                    $this->db->where('name',$student->student_name);
                    $query = $this->db->get();
                    $prido = $query->row();
            
            
            
            // print_r($student);
            
               	// print_r($prido);
                // echo $code;die;
            
                if(empty($prido)){
        	        
        	       // $registration_code= $this->session->userdata('registration_code');
        	        
        	       // echo $registration_code;die;
        	        
        	        $data['result'] = $this->db
                        ->select('lunar_schedule_cin.*,lunar_schedule_cin.lunar_schedule_id as sch_id') // Selects all columns; adjust as needed
                        ->from('lunar_schedule_cin')
                        ->join('period', 'period.period_id = lunar_schedule_cin.period_id','left')
                        ->join('faq', 'faq.lunar_schedule_id = lunar_schedule_cin.lunar_schedule_id', 'left')
                        ->where('lunar_schedule_cin.lunar_schedule_id', $sch_id)
                        ->order_by('lunar_schedule_cin.lunar_schedule_id','DESC')
                        ->get()
                        ->row();
                        
                    // echo $this->db->last_query();die;
    
                    if(isset($_POST['submit'])){
                        
                            
                                $period_id=$data['result']->period_id;
                                
                                $res = $this->db->get_where('period', array('period_id' => $period_id))->row();
    
                                $initials=$res->initials;
                                
                                // $this->db->order_by('lunar_schedule_id', 'DESC');
                                //     $res = $this->db->get_where(
                                //         'lunar_schedule_cin',
                                //         array('lunar_schedule_id' => $sch_id)
                                //     )->row();
                                    
                                $period_id = $schedule->period_id;
    
                                // echo $this->db->last_query();die;
                                
                                $this->db->select('prid');
                                $this->db->from('lunar_prid');
                                $this->db->where('period_id', $period_id);
                                $this->db->where('sch_id',$sch_id);
                                $this->db->order_by('lunar_prid_id', 'DESC');
                                $query = $this->db->get();
                                $prido = $query->row();
                                
                                // $prido = $prido ? $prido->prid : null . $res->series;
                                
                                $prido = $prido ? $prido->prid : ($res->series ?? '');
    
                                // echo $this->db->last_query();
                                
                                // echo $prido;die;
                                
                                if (!empty($prido)){
                                    $p=explode('MREG',$prido);
                                    $prido_number = $p[1];
                                    // $prido_number = (int)substr($prido, 6);
                                    
                                    $prido_number++; // Increment by 1
                                    $prid = $initials . 'MREG'. $prido_number;
                                } else {
                                    // Set default `prid` if `$prido` is empty
                                    $prid = $initials . 'MREG'.$res->series . '100';
                                }
                                
                                // echo $prid;die;
                                
                                $ar=array(
                                    'name'=>$_POST['student_name'],
                                    // 'school'=>$_POST['school_name'],
                                    // 'school_address'=>$_POST['school_address'],
                                    'father_name'=>$_POST['father_name'],
                                    'mother_name'=>$_POST['mother_name'],
                                    'class'=>$_POST['class'],
                                    'sch_id'=>$data['result']->lunar_schedule_id,
                                    'email'=>$_POST['email'],
                                    'period_id'=>$period_id,
                                    'address1'=>$_POST['address'],
                                    'mobile'=>$_POST['mobile'],
                                    // 'school_code'=>$this->session->userdata('school_code'),
                                    'gender'=>$_POST['gender'],
                                    'prid'=>$prid,
                                    'created_date'=> date('Y-m-d'),
                                    'series'=>$data['result']->series,
                                    'subject'=>$data['result']->subject,
                                    'level'=>$data['result']->level_id,
                                    'state_id'=>$_POST['state'],
                                    'type'=>$data['result']->type,
                                    'district_code'=>$_POST['district'],
                                    // 'prid'=>$prid
                                );
                                // echo '<pre>';    
                                // print_r($ar);die;
                                
                                $this->db->insert('lunar_prid',$ar);
                                
                                $this->session->set_userdata('prid',$prid);
                                redirect('welcome/registration_log');
                        
                    }
                    
                    
                    $data['faq'] = $this->db->get_where('faq',array('lunar_schedule_id'=>$data['result']->lunar_schedule_id))->result();
                    
                    $this->load->view('open_register_form',$data);
                    
        		}else{
        		    
        		    $this->session->set_userdata('prid',$prido->prid);
                    redirect('https://marrs.in/lunar/Welcome/registration_log');
        		}
    		 
  
            }else{
                redirect('https://marrs.in', 'refresh');
            } 
    		 
        }
        
        public function reg()
    	{
    	    
    	     $lunar_schedule_id = $this->input->post('lunar_schedule_id');
    	    
    	    $res = $this->db->get_where('lunar_schedule_cin', array('lunar_schedule_id' => $lunar_schedule_id))->row();
            $this->session->set_userdata('registration_code',$res->registration_code);
    	     
    	    if(!empty($this->session->userdata('registration_code'))){
    	        
    	        //print_r($_POST);die;
    	        
    	        $registration_code = $this->session->userdata('registration_code');
    	       
                
    	        
    	        $this->db->select('lunar_schedule_cin.*, lunar_schedule_cin.lunar_schedule_id as sch_id,period.academic_year')
                    ->from('lunar_schedule_cin')
                    ->join('period', 'period.period_id = lunar_schedule_cin.period_id', 'left')
                    ->join('faq', 'faq.lunar_schedule_id = lunar_schedule_cin.lunar_schedule_id', 'left')
                    ->where('lunar_schedule_cin.registration_code', $this->session->userdata('registration_code'));
                
                if(!empty($lunar_schedule_id))
                {
                    $this->db->where('lunar_schedule_cin.lunar_schedule_id', $lunar_schedule_id);
                }
                
                $this->db->group_by('lunar_schedule_cin.lunar_schedule_id');
                
                $data['result'] = $this->db
                    ->order_by('lunar_schedule_cin.lunar_schedule_id','DESC')
                    ->get()
                    ->row();
        
                 //echo $this->db->last_query();die;

              
                
                 
                    
                    $this->db->select('*');
                    $this->db->from('lunar_prid');
                    $this->db->where('class', $_POST['class']);
                    $this->db->where('email',$_POST['email']);
                    $query = $this->db->get();
                    $prido = $query->row_array(); 
                    $data['student']=$_POST; 
                    
                    
                    $stud = $this->db->get_where('cin_list',array('stud_email'=>$_POST['email'],'cin like'=> '%LU%','prid !='=>'null'))->row();    
                     //echo $this->db->last_query();
                     //print_r($stud);die;
                     
                
                
                if(empty($stud))
                {
                     
                    if(empty($prido)){
                        
                        
                      $this->newPridCreation();   
                        
                      $this->load->view('open_register_formout',$data); 
                    }else{
                        
                          $this->session->userdata('lunar_schedule_id');
                        
                        $associatelink_to_lunar = $this->db
                            ->select('lunar_schedule_cin.*, associatelink_to_lunar.amount AS price_amount')
                            ->from('associatelink_to_lunar')
                            ->join(
                                'lunar_schedule_cin',
                                'associatelink_to_lunar.lunar_schedule_id = lunar_schedule_cin.lunar_schedule_id'
                            )
                            ->where('associatelink_to_lunar.lunar_schedule_id', $lunar_schedule_id)
                            ->where('associatelink_to_lunar.associate_link_id', $this->session->userdata('associate_link_id'))
                            ->get()
                            ->row();

                         
                         //echo '<pre>';
                         //print_r($associatelink_to_lunar); 
                        $ar=[
                            'sch_id'        => $lunar_schedule_id,
                            'series'        => $associatelink_to_lunar->series,
                            'subject'       => $associatelink_to_lunar->subject,
                            'level'         => $associatelink_to_lunar->level_id,
                            'type'          => $associatelink_to_lunar->type,
                            'associate_id'  => $_SESSION['associate_id'] ,
                            'franchise_id'  => $_SESSION['franchise_id'] ,
                            'associate_link_id'=> $_SESSION['associate_link_id'],
                            'amount'        => $associatelink_to_lunar->price_amount
                        ];
                        
                        //print_R($ar);die;
                        
                        $this->db->update('lunar_prid',$ar);
                        
                        $this->session->set_userdata('prid',$prido->prid);
                        redirect('https://marrs.in/lunar/Welcome/registration_log','refresh');
                    }      
                    
                }
                else{
                    
                    $this->session->set_userdata('cin',$stud->cin);  
                    $this->session->set_userdata('message','Already Registered');  
                    
                    redirect('https://marrs.in/lunar/Cin_login/index','refresh');
                }
                
    		}else{
    		  //  echo 'ok';die;
    		    
    	        //redirect('https://marrs.in/');
    		}
    	}
    		public function newPridCreation()
    	{
    	     if(isset($_POST['submit'])){
                            
                            $stude = $this->db
                                ->where('stud_email', $this->input->post('email'))
                                ->like('cin', 'LU')
                                ->where('prid IS NOT NULL', null, false)
                                ->order_by('id', 'DESC')
                                ->limit(1)
                                ->get('cin_list')
                                ->row();

                            // $stude = $this->db->get_where('cin_list',array('stud_email'=>$_POST['email'],'cin like'=> '%LU%','prid !='=>'null'))->row();    
                            if(empty($stude)){
                            
                                    $period_id = $_POST['period_id'];
                                    
                                    $res = $this->db->get_where('period', array('period_id' => $period_id))->row();
        
                                    $initials=$res->initials;
                                    
                                    $this->db->order_by('lunar_schedule_id', 'DESC');
                                        $res = $this->db->get_where(
                                            'lunar_schedule_cin',
                                            array('registration_code' => $this->session->userdata('registration_code'))
                                        )->row();
                                        
                                    $sch_id = $res->lunar_schedule_id;
        
                                    
                                    $this->db->from('lunar_prid');
                                    $this->db->where('period_id', $period_id);
                                    $this->db->order_by('lunar_prid_id', 'DESC'); 
                                    $this->db->limit(1);
                                    
                                    $query = $this->db->get();
                                    $row = $query->row();
                                    
                                    $last_prid = $row ? $row->prid : '';
        
                                     //echo $last_prid;die;
                                    
                                    $last_prid = $row ? $row->prid : '';

                                        if (!empty($last_prid)) {
                                        
                                            // Example: 25MREG100025000015
                                            
                                            $parts = explode('MREG', $last_prid);
                                        
                                            $prefix = $initials . 'MREG';
                                        
                                            $after_mreg = $parts[1];
                                        
                                            // Separate series + running number
                                            $series = substr($after_mreg, 0, 4); 
                                            $running = substr($after_mreg, 4);
                                        
                                            // Increment running number
                                            $running++;
                                        
                                            // Keep zero padding
                                            $running = str_pad($running, strlen(substr($after_mreg, 4)), '0', STR_PAD_LEFT);
                                        
                                            $prid = $prefix . $series . $running;
                                        
                                        }
                                        else {
                                        
                                            $prid = $initials . 'MREG' . $initials .'00001';
                                        }
                                        
                                         //echo $prid;die;
                                    
                                    $ar=array(
                                        'name'          => $_POST['student_name'],
                                        // 'school'     => $_POST['school_name'],
                                        // 'school_address' => $_POST['school_address'],
                                        'father_name'   => $_POST['father_name'],
                                        'mother_name'   => $_POST['mother_name'],
                                        'class'         => $_POST['class'],
                                        'sch_id'        => $_POST['lunar_schedule_id'],
                                        'email'         => $_POST['email'],
                                        'period_id'     => $period_id,
                                        'address1'      => $_POST['address'],
                                        'mobile'        => $_POST['mobile'],
                                        // 'school_code'=>$this->session->userdata('school_code'),
                                        'gender'        => $_POST['gender'],
                                        'prid'          => $prid,
                                        'created_date'  => date('Y-m-d'),
                                        'series'        => $_POST['series'],
                                        'subject'       => $_POST['subject'],
                                        'level'         => $_POST['level_id'],
                                        'state_id'      => $_POST['state'],
                                        'type'          => $_POST['type'],
                                        'district_code' => $_POST['district'],
                                        'associate_id'  => $_SESSION['associate_id'] ,
                                        'franchise_id'  => $_SESSION['franchise_id'] ,
                                        'associate_link_id'=> $_SESSION['associate_link_id'],
                                        'amount'        => $_POST['amount']
                                    );
                                    
                                      
                                     // print_r($_POST);die;
                                    
                                    $this->db->insert('lunar_prid',$ar);
                                    
                                    $this->session->set_userdata('prid',$prid);
                                    redirect('welcome/registration_log');  
                                
                                }
                            else{
                
                                $this->session->set_userdata('cin',$stude->cin);    
                                redirect('https://marrs.in/lunar/Cin_login','refresh');
                            }
            
               }else{
                $data['message']='Already Registered';
                }   
    	}
    public function associatelink()
        {
            
            $code = $this->uri->segment(3);
            
            $associate_link = $this->db
                ->get_where('associate_link', ['associate_link_id' => $code])
                ->row();
            
             //print_R($associate_link);die;
            
            if (!empty($associate_link)) {
            
                $expire_date = $associate_link->expire_date;
            
                if (!empty($expire_date) && strtotime($expire_date) < strtotime(date('Y-m-d'))) {
                    echo "Link Expired";
                } else {
                    
                    $data['lunar_schedules'] = $this->db
                        ->select('associatelink_to_lunar.lunar_schedule_id')
                        ->join('lunar_schedule_cin','lunar_schedule_cin.lunar_schedule_id=associatelink_to_lunar.lunar_schedule_id')
                        ->get_where('associatelink_to_lunar', ['associate_link_id' => $code])
                        ->result();
                    
                 //echo $this->db->last_query();die;
                    
                    $this->session->set_userdata('associate_id', $associate_link->associate_id);
                    $this->session->set_userdata('franchise_id', $associate_link->franchise_id);
                    
                    
                    $this->session->set_userdata('associate_link_id', $code);
                    
                    if (isset($_POST['submit'])) {

                        $schedule_id = $this->input->post('schedule_id');
                    
                        $associatelink_to_lunar = $this->db
                            ->get_where('associatelink_to_lunar', [
                                'lunar_schedule_id' => $schedule_id,
                                'associate_link_id' => $code
                            ])
                            ->row();
                    
                        if (!empty($associatelink_to_lunar) && $associatelink_to_lunar->amount !== null) {
                    
                            $this->session->set_userdata([
                                'amount' => $associatelink_to_lunar->amount,
                                'lunar_schedule_id' => $schedule_id
                            ]);
                    
                            redirect('Welcome/reg', 'refresh');
                    
                        } else {
                            show_error('Invalid schedule or amount.', 400);
                        }
                    }
                     //print_r($_SESSION);die;
                    
                    $this->load->view('registration_landing_pageout',$data);
                    // $this->load->view('registration_landing_page1',$data);
                }
            
            } else {
                echo "Invalid Link";
            }

        }
         public function scheduleSeriesList()
        {
                    $class = $_POST['class'];
                    $subject = $_POST['subject'];
                            $associate_id = $_SESSION['associate_id'];
                            $associate_link_id = $_SESSION['associate_link_id'];
                            $this->db->select('lunar_schedule_cin.*');
                            $this->db->from('lunar_schedule_cin');
                            if($associate_id) {
                                $this->db->join('associatelink_to_lunar', 'lunar_schedule_cin.lunar_schedule_id = associatelink_to_lunar.lunar_schedule_id');
                                $this->db->where('associatelink_to_lunar.associate_link_id', $associate_link_id);
                            }
                            $this->db->where('lunar_schedule_cin.subject',$subject);
                            $schedules = $this->db->get()->result();
                            
                             //echo $this->db->last_query();
                             //print_r($schedules);die;
                            
                            // Filter schedules based on class
                            $eligible_schedules = [];
                            foreach($schedules as $schedule) {
                                // Check if this schedule is available for the selected class
                                $class_check = $this->db->get_where('lunar_schedule_class', [
                                    'sch_id' => $schedule->lunar_schedule_id,
                                    'class' => $class
                                ])->row();
                                
                                if($class_check) {
                                    $eligible_schedules[] = $schedule;
                                }
                            }
                            
             $data['eligible_schedules'] = $eligible_schedules;
        
            $this->load->view("scheduleSeriesListout", $data);               
        }		 
    
     public function sendOtp()
        {
 
        $apiKey = "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";
               // API endpoint
        $url = "https://api.brevo.com/v3/smtp/email";
        
        // Get email from POST
        $email = trim($_POST['email'] ?? '');
        
        if (empty($email)) {
            echo "Email is required";
            exit;
        }
        
   
    
    // Generate OTP and save in session
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    $_SESSION['otp_time'] = time();
    
    // Prepare email data for Brevo 
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
    "textContent" => "Your one-time email verification code is $otp.",

    // ✅ ADD THIS BLOCK
    "tracking" => [
        "clicks" => false,
        "opens" => false
    ]
];
    
    // Convert to JSON
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
    if ($httpCode == 201 || $httpCode == 200) {
        // Only echo "sent" for JS modal
        
        echo "sent".$_SESSION['otp'];
    } else {
        // Send error for debugging
        echo "Error: " . $response;
    }

        }
        
       public function verifyOtp()
       {
        
        $this->db->where('stud_email', $_SESSION['email']);
        $this->db->like('cin', 'LU');
        $query = $this->db->get('cin_list');
        // echo $this->db->last_query();die;
        
        if ($query->num_rows() > 0) {
            // print_r($query->row()->cin);die;
            
            $exist=1;
            $this->session->set_userdata('cin', $query->row()->cin);
            //  print_r($_SESSION);die;

        } else {
            $exist=0;
        }
        $otp = $_POST['otp'];
        
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp) {
            echo "verified".$exist;
        } else {
            echo "invalid";
        }

       }
       
        public function checkNameEmail()
       {
        $email = $this->input->post('email', TRUE);
        $name  = $this->input->post('name', TRUE);

        $this->db->where('stud_email', $email);
        $this->db->like('student_name', $name);
         $this->db->like('cin', '25LU');
        $query = $this->db->get('cin_list');
         
        if ($query->num_rows() > 0) {
            $this->session->set_userdata('cin', $query->row()->cin);
            $response = ['status' => 'exists'];
        } else {
            $response = ['status' => 'not_found'];
        }

        echo json_encode($response);
       }
       
}