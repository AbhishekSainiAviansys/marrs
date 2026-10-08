 <?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
// echo 'ok';die; 
class Welcome extends CI_Controller {
    
        // Brevo API config
    private $brevo_api_key  = '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';       // ← update
    private $brevo_url      = 'https://api.brevo.com/v3/smtp/email';
    private $sender_email   = 'donotreply@marrs.in';        // ← update
    private $sender_name    = 'MaRRS Enquiry';               // ← update


    
    public function __construct() {
         parent::__construct();
		
		
       
// 	    $this->load->helper('url');
// 		//$this->load->library('encrypt');current_registration
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
	    
    	    //print_r($_SESSION);die;
    	     $data['school_code']= $this->session->userdata('school_code');
    	     $school_code=$this->session->userdata('school_code');
    	     $data['school']=$this->db->get_where('school_new',array('school_code'=>$school_code))->row(); 
    	     //print_r($data['school_code']);exit;
	        $this->load->view('index',$data); 
    	}
    	
    	public function setCinSession()
        {
            $cin = $this->input->post('cin');
        
            $this->session->set_userdata('cin', $cin);
        
            redirect('cin_login/index');
        }
    	
    	public function payment_success_() 
	    {	
	        $cin = $this->uri->segment('3');
	      
    		$data['student'] = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
    		
    		
    		$this->db->where('cin', $cin);
    		$this->db->where('status', '1');
            $this->db->order_by('pay_id', 'DESC');
            $data['competition'] = $this->db->get('payment_split')->row();

            $data['comp'] = $this->db->get_where('competition_product_state',array('id'=>$data['competition']->comp_id))->row();

            if(isset($_POST['submit'])){
    	        
    	         $this->session->set_userdata('cin',$cin);
                 redirect('cin_login/index', 'refresh');
    	        
    	    }
            
    		$this->load->view('cofee_success',$data);
    
    	}
    	
    	public function payment_success() 
        {	
            $cin = $this->uri->segment('3');
            
            // Get student data
            $data['student'] = $this->db->get_where('cin_list', array('cin' => $cin))->row();
        
            // Get latest payment_split entry by pay_id
            $this->db->where('cin', $cin);
            $this->db->where('status', '1');
            $this->db->order_by('pay_id', 'DESC');
            $data['competition'] = $this->db->get('payment_split')->row();
        
            // Handle case if no payment record found
            if ($data['competition']) {
                $data['comp'] = $this->db
                    ->get_where('competition_product_state', ['id' => $data['competition']->comp_id])
                    ->row();
            } else {
                $data['comp'] = null;
                log_message('error', "No payment_split entry found for CIN: $cin with status=1");
            }
        
            // Handle form submit
            if (isset($_POST['submit'])) {
                $this->session->set_userdata('cin', $cin);
                redirect('cin_login/index', 'refresh');
            }
        
            $this->load->view('cofee_success', $data);
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
        $data = [];

        if (isset($_POST['submit'])) {
            if (!empty($_POST['value'])) {

                $data['value'] = $_POST['value'];
                $year          = $_POST['year'];
                $is_number     = is_numeric($_POST['value']);

                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('cin_result', 'cin_list.cin = cin_result.cin', 'left');

                if ($is_number) {
                    $this->db->like('cin_list.cin', $year, 'after');
                    $this->db->where('stud_phone', $_POST['value']);
                } else {
                    $this->db->where('stud_email', $_POST['value']);
                    if ($year == '22') {
                        $this->db->like('cin_list.period_id', '12');
                    } else {
                        $this->db->like('cin_list.cin', $year, 'after');
                    }
                }

                $this->db->group_by('cin_list.cin');
                $query       = $this->db->get();
                $cin_records = $query->result_array();

                if (!empty($cin_records)) {

                    $stud_email = $cin_records[0]['stud_email'];

                    // Generate 6-digit OTP
                    $otp = rand(100000, 999999);

                    // Store in session
                    $this->session->set_userdata([
                        'otp_code'    => $otp,
                        'otp_expiry'  => time() + 600, // 10 minutes
                        'otp_email'   => $stud_email,
                        'cin_records' => $cin_records,
                    ]);

                    // Send OTP via Brevo API
                    $send = $this->_send_otp_email($stud_email, $otp);

                    if ($send['success']) {
                        $data['email_masked'] = $this->_mask_email($stud_email);
                        $this->load->view('verify_otp', $data);
                        return;
                    } else {
                        $this->session->set_flashdata('error', 'Failed to send OTP. Please try again.');
                        log_message('error', 'Brevo OTP error: ' . $send['response']);
                    }

                } else {
                    $this->session->set_flashdata('error', 'No records found for the given details.');
                }

                $data['result'] = $_POST;

            } else {
                $this->session->set_flashdata('error', 'Enter the email or mobile.');
            }
        }

        $this->load->view('find_cin', $data);
    }

    //My Code
    public function generateOtp()
    {
        header('Content-Type: application/json');
    
        try {
    
            $data = json_decode(file_get_contents("php://input"), true);
            if(empty($data)){
                $data = $this->input->post();
            }
    
            if (empty($data['type']) || empty($data['value'])) {
                echo json_encode(["status" => "error", "message" => "Invalid request"]);
                exit;
            }
    
            $type  = $data['type'];
            $value = $data['value'];
    
            $otp = rand(100000, 999999);
    
            $this->session->set_userdata("otp_$type", [
                'otp' => $otp,
                'expires' => time() + 300
            ]);
    
            // 🔴 TRY sending OTP but DON'T crash if fails
            if ($type == "email") {
                $this->sendEmailOtp($value, $otp);
            } else {
                $this->sendSmsOtp($value, $otp);
            }
    // if ($type == "email") {
    //     $this->sendEmailOtp($value, $otp);
    
    // } elseif ($type == "whatsapp") {
    //     $this->sendWhatsappOtp($value, $otp);
    
    // } else {
    //     // fallback SMS
    //     $this->sendSmsOtp($value, $otp);
    // }
            echo json_encode(["status" => "success"]);
            exit;
    
        } catch (Exception $e) {
    
            echo json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
            exit;
        }
    }
    public function checkOtp()
    {
        header('Content-Type: application/json');
    
        try {
    
            $data = json_decode(file_get_contents("php://input"), true);
            if(empty($data)){
                $data = $this->input->post();
            }
    
            if (empty($data['type']) || empty($data['otp'])) {
                echo json_encode(["status" => "error"]);
                exit;
            }
    
            $type = $data['type'];
            $userOtp = $data['otp'];
    
            $sessionData = $this->session->userdata("otp_$type");
    
            if (!$sessionData) {
                echo json_encode(["status"=>"error","message"=>"No OTP"]);
                exit;
            }
    
            if (time() > $sessionData['expires']) {
                $this->session->unset_userdata("otp_$type");
                echo json_encode(["status"=>"expired"]);
                exit;
            }
    
            if ($sessionData['otp'] == $userOtp) {
    
                $this->session->set_userdata("verified_$type", true);
                $this->session->unset_userdata("otp_$type");
    
                echo json_encode(["status"=>"success"]);
            } else {
                echo json_encode(["status"=>"error"]);
            }
    
            exit;
    
        } catch (Exception $e) {
    
            echo json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
            exit;
        }
    }
    private function sendEmailOtp($email, $otp)
    {
        $apiKey = "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";
    
        $data = [
            "sender" => [
                "email" => "donotreply@marrs.in",
                "name" => "MARRS"
            ],
            "to" => [
                ["email" => $email]
            ],
            "subject" => "Your OTP Code",
            "htmlContent" => "<h3>Your OTP is: $otp</h3>"
        ];
    
        $ch = curl_init("https://api.brevo.com/v3/smtp/email");
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "api-key: $apiKey",
            "Content-Type: application/json"
        ]);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            log_message('error', 'EMAIL ERROR: ' . curl_error($ch));
        }
    
        curl_close($ch);
    }
    private function sendSmsOtp($mobile, $otp)
    {
        $apiKey = "ac182a44-542c-11f1-9800-0200cd936042";
    
        // 2Factor direct OTP send API
        $url = "https://2factor.in/API/V1/$apiKey/SMS/+91$mobile/$otp";
    
        $ch = curl_init();
    
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPGET => true,
        ]);
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            log_message('error', 'SMS ERROR: ' . curl_error($ch));
        } else {
            log_message('info', 'SMS RESPONSE: ' . $response);
        }
    
        curl_close($ch);
    }
    // private function sendWhatsappOtp($mobile, $otp)
    // {
    //     $apiKey = "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";
    
    //     $data = [
    //         "to" => "91" . $mobile,
    //         "type" => "template",
    //         "template" => [
    //             "name" => "otp_template", // approved template
    //             "language" => "en",
    //             "components" => [
    //                 [
    //                     "type" => "body",
    //                     "parameters" => [
    //                         [
    //                             "type" => "text",
    //                             "text" => (string)$otp
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ]
    //     ];
    
    //     $ch = curl_init("https://api.brevo.com/v3/conversations/messages");
    
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //         "api-key: $apiKey",
    //         "Content-Type: application/json"
    //     ]);
    
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    //     $response = curl_exec($ch);
    
    //     if (curl_errno($ch)) {
    //         log_message('error', 'WHATSAPP ERROR: ' . curl_error($ch));
    //         return false;
    //     }
    
    //     curl_close($ch);
    //     return $response;
    // }
    // -----------------------------------------------------------------------


    public function verify_otp()
    {
        if (!isset($_POST['otp'])) {
            redirect('welcome/check_cin');
            return;
        }

        $submitted_otp = trim($_POST['otp']);
        $stored_otp    = $this->session->userdata('otp_code');
        $expiry        = $this->session->userdata('otp_expiry');
        $stud_email    = $this->session->userdata('otp_email');
        $cin_records   = $this->session->userdata('cin_records');

        // Check session exists
        if (empty($stored_otp) || empty($expiry)) {
            $this->session->set_flashdata('error', 'Session expired. Please search again.');
            redirect('welcome/check_cin');
            return;
        }

        // Check OTP expiry
        if (time() > $expiry) {
            $this->session->unset_userdata(['otp_code', 'otp_expiry', 'otp_email', 'cin_records']);
            $this->session->set_flashdata('error', 'OTP expired. Please search again.');
            redirect('welcome/check_cin');
            return;
        }

        // Check OTP match
        if ($submitted_otp != $stored_otp) {
            $data['error']        = 'Invalid OTP. Please try again.';
            $data['email_masked'] = $this->_mask_email($stud_email);
            $this->load->view('verify_otp', $data);
            return;
        }

        // OTP valid — send CIN list email via Brevo API
        $send = $this->_send_cin_list_email($stud_email, $cin_records);

        if (!$send['success']) {
            log_message('error', 'Brevo CIN list email error: ' . $send['response']);
        }

        // Clear OTP session data
        $this->session->unset_userdata(['otp_code', 'otp_expiry', 'otp_email', 'cin_records']);

        $this->session->set_flashdata('success', 'Your CIN list has been sent to ' . $stud_email);
        redirect('welcome/check_cin');
    }


    // -----------------------------------------------------------------------


    private function _send_otp_email($to_email, $otp)
    {
        $emailData = [
            "sender" => [
                "name"  => $this->sender_name,
                "email" => $this->sender_email
            ],
            "to" => [
                [
                    "email" => $to_email,
                    "name"  => "User"
                ]
            ],
            "subject"     => "Your OTP Code – Email Verification",
            "htmlContent" => "
                <div style='font-family:Arial,sans-serif;max-width:480px;margin:auto;padding:24px;border:1px solid #e0e0e0;border-radius:8px;'>
                    <h2 style='color:#333;margin-top:0;'>Email Verification</h2>
                    <p style='color:#555;'>Use the OTP below to verify your email and receive your CIN list.</p>
                    <div style='font-size:32px;font-weight:bold;letter-spacing:10px;color:#1a73e8;padding:16px 0;'>
                        {$otp}
                    </div>
                    <p style='color:#999;font-size:13px;'>
                        This OTP is valid for <strong>10 minutes</strong>. Do not share it with anyone.
                    </p>
                    <hr style='border:none;border-top:1px solid #eee;margin:16px 0;'>
                    <p style='color:#bbb;font-size:12px;'>
                        If you did not request this, please ignore this email.
                    </p>
                </div>
            ",
            "textContent" => "Your OTP is: {$otp}. Valid for 10 minutes. Do not share it with anyone."
        ];

        return $this->_brevo_send($emailData);
    }


    // -----------------------------------------------------------------------


    private function _send_cin_list_email($to_email, $cin_records)
    {
        // Build HTML table rows
        $rows = '';
        foreach ($cin_records as $row) {
            $rows .= '
                <tr>
                    <td style="padding:10px 12px;border-bottom:1px solid #f0f0f0;">'
                        . htmlspecialchars($row['cin'])             .
                    '</td>
                    <td style="padding:10px 12px;border-bottom:1px solid #f0f0f0;">'
                        . htmlspecialchars($row['student_name'] ?? '') .
                    '</td>
                    <td style="padding:10px 12px;border-bottom:1px solid #f0f0f0;">'
                        . htmlspecialchars($row['stud_email'])      .
                    '</td>
                </tr>';
        }

        $emailData = [
            "sender" => [
                "name"  => $this->sender_name,
                "email" => $this->sender_email
            ],
            "to" => [
                [
                    "email" => $to_email,
                    "name"  => "User"
                ]
            ],
            "subject"     => "Your CIN List",
            "htmlContent" => "
                <div style='font-family:Arial,sans-serif;max-width:600px;margin:auto;padding:24px;border:1px solid #e0e0e0;border-radius:8px;'>
                    <h2 style='color:#333;margin-top:0;'>Your CIN List</h2>
                    <p style='color:#555;'>Your identity has been verified. Here is your CIN list:</p>
                    <table style='width:100%;border-collapse:collapse;margin-top:16px;'>
                        <thead>
                            <tr style='background:#1a73e8;color:#fff;'>
                                <th style='padding:10px 12px;text-align:left;'>CIN</th>
                                <th style='padding:10px 12px;text-align:left;'>Name</th>
                                <th style='padding:10px 12px;text-align:left;'>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            {$rows}
                        </tbody>
                    </table>
                    <hr style='border:none;border-top:1px solid #eee;margin:24px 0;'>
                    <p style='color:#bbb;font-size:12px;'>
                        Please keep this information confidential.<br>
                        This email was sent to {$to_email}.
                    </p>
                </div>
            ",
            "textContent" => "Your CIN list has been sent. Please check the HTML version of this email."
        ];

        return $this->_brevo_send($emailData);
    }


    // -----------------------------------------------------------------------


    private function _brevo_send($emailData)
    {
        $jsonData = json_encode($emailData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            $this->brevo_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST,           true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,     $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "accept: application/json",
            "api-key: " . $this->brevo_api_key,
            "content-type: application/json"
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'success'  => ($httpCode == 201),
            'httpCode' => $httpCode,
            'response' => $response,
        ];
    }


    // -----------------------------------------------------------------------


    private function _mask_email($email)
    {
        // john.doe@example.com → jo***oe@example.com
        list($local, $domain) = explode('@', $email);
        $len    = strlen($local);
        $masked = substr($local, 0, 2)
                . str_repeat('*', max($len - 4, 2))
                . substr($local, -2);
        return $masked . '@' . $domain;
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
            // echo $this->session->userdata('prid');die;
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
    	  // print_r($_POST);die; 
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
	           
	            $folder= $this->uri->segment();
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
	        
	       // $cinns = $this->uri->segment(3);
	       // if(isset($_POST['submit'])){
        //         $code = $this->input->post('code');
        //         //   print_r($code);exit;
                
        //         if($code=='SCHOOL' or $code=='school'){
        //             //echo 'ok';die;
                    redirect('https://marrsdev.marrs.in/signin?tab=signin/');
                    
                // }else{
                //     if($code!=''){
                //         if($code=='Aviansys@payments'){
                //             // echo 'ok';die;
                //             redirect('Log/payments');
                //         }
                //         elseif($code=='Aviansys@enquiry'){
                //             redirect('Log/enquiry');
                //         }
                //         else{
                //             $franchise_code = $this->db->get_where('franchise', array('username' => $code))->row_array();
                            
                //             $admin_code = $this->db->get_where('admin_user', array('username' => $code))->row_array();
                            
                //             $zoomacess_code = $this->db->get_where('franchise_to_zoomzoom', array('zoomzoom_access_code' => $code))->row_array();
                            
                //             $marrsacess_code = $this->db->get_where('school_new', array('school_code' => $code))->row_array();
                            
                //             $marrsacess_code_mid = $this->db->get_where('product_to_school_mid', array('school_code' => $code))->row_array();
                        
                //             $result_prid     = $this->db->get_where('students', array('prid' => $code ,'period_id'=>'14'))->row_array();
                            
                //             $lunar_schedule_cin    = $this->db->get_where('lunar_schedule_cin', array('registration_code' => $code))->row_array();
                            
                //             $zoomzoom_schedule_cin    = $this->db->get_where('zoomzoom_schedule_cin', array('registration_code' => $code))->row_array();
                            
                            
                //             $spark_schedule_cin    = $this->db->get_where('spark_schedule_cin', array('registration_code' => $code))->row_array();
                            
                //             $cin    = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
                            
                            
                //             // $result_cin    = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
                            
                //             // $lunar_cin = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
    
                            
                            
                            
    
                //             if (strpos($cin['cin'], 'MZ') !== false) {
                //                 $zoom_cin=$cin;
                //                 // echo 'zoom';
                //             }
                //             // else{
                //             //     print_r($cin['cin']);die;
                //             // }
                            
                //             if (strpos($cin['cin'], 'LU') !== false) {
                //                 $lunar_cin=$cin;
                //             }else{
                //                 $result_cin=$cin;
                //             }
                            
                //             if (strpos($cin['cin'], 'SK') !== false) {
                //                 $spark_cin=$cin;
                //             }else{
                //                 $result_cin=$cin;
                //             }
                            
                //             // echo $cin['cin'].'<pre>';
                //             // print_r($lunar_cin);die;
                             
                //             $zoomzoom_prid = $this->db->get_where('student_to_zoomzoom', array('zoomzoom_prid' => $code))->row_array();
                           
                //             //   $exit_email = $this->db->get_where('cin_list', array('stud_email' => $code))->row_array();
                //             //   $zoomemail = $this->db->get_where('cin_zoomzoom', array('email' => $code))->row_array();
                //             //   $email = $this->db->get_where('cin_list', array('stud_email' => $code))->row_array();
                             
                //             //   $newregister_email = $this->db->get_where('students', array('email' => $code,'period_id'=>'14'))->row_array();
                //         }
                //     }
                // }   
               
            // if(!empty($newregister_email)){
            //      //print_r($zoomemail['email']);die;
            //      $data['email']=$newregister_email['email'];
            //      if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
            //             {
            //                 $this->session->set_userdata('email', $newregister_email['email']);
            //                 $this->session->set_userdata('prid', $newregister_email['PRID']);
                            
            //                     $otp = rand(100000, 999999); 
            //         	        $_SESSION['session_otp_email'] = $otp;
            //         	        $sender = 'donotreply@marrs.in';
            //                     $recipient = $newregister_email['email'];
                    
            //                     $subject = "Marrs Email Verification";
            //                     $message = " Your one time email verification code is ".$otp;
            //                     $headers = 'From:' . $sender;
                                
            //                     if (mail($recipient, $subject, $message, $headers))
            //                     {
            //                         echo " ";
            //                     }
            //                     else
            //                     {
            //                         echo " ";
            //                     }
	                
                            
            //             }
            //             if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
            //             {
            //                 //echo '----test----';die;
            //                 $email = $newregister_email['email'];
                                
            //                 redirect('welcome/registration_log'); 
                           
            //             }
                
               
            //   }
            // elseif(!empty($zoomemail)){
            //      //print_r($zoomemail['email']);die;
            //      $data['email']=$zoomemail['email'];
            //      if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
            //             {
            //                 $this->session->set_userdata('email', $zoomemail['email']);
            //               // $this->session->set_userdata('cin', $exit_email['cin']);
                            
            //                     $otp = rand(100000, 999999); 
            //         	        $_SESSION['session_otp_email'] = $otp;
            //         	        $sender = 'donotreply@marrs.in';
            //                     $recipient = $zoomemail['email'];
                    
            //                     $subject = "Marrs Email Verification";
            //                     $message = " Your one time email verification code is ".$otp;
            //                     $headers = 'From:' . $sender;
                                
            //                     if (mail($recipient, $subject, $message, $headers))
            //                     {
            //                         echo " ";
            //                     }
            //                     else
            //                     {
            //                         echo " ";
            //                     }
	                
                            
                            
                            
            //             }
            //             if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
            //             {
            //                 //echo '----test----';die;
            //                 $email = $zoomemail['email'];
            //                 redirect('zoomzoom/studentdata'); 
                           
            //             }
                
               
            //   }
             
            //  openschool_zoom = $this->db->get_where('cin_', array('school_code' => $code))->row_array();
               
    //         elseif(!empty($openschool_zoom)){
               
    //                     $data['data'] = $openschool_zoom['school_code']; 
    //                     if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                     {
    //                         // echo 'ok';die;
    //                         $this->session->set_userdata('school_code', $openschool_zoom['school_code']);
    //                         // print_r($openschool_zoom);exit;
    //                         redirect('zoomzoom/open_registrationzoom');   
    //                     }
    //          }
             
    //         elseif(!empty($marrsacess_code)){
    //             // print_r($marrsacess_code);die;
                
    //               $this->session->set_userdata('school_code',$this->input->post('code'));
    //               $url='https://marrs.in/student_registration/welcome/scanner/'.$marrsacess_code['school_code'];
    //                 redirect($url);
                
                
    //         }elseif(!empty($marrsacess_code_mid)){
    //             // print_r($marrsacess_code_mid);die;
                
    //               $this->session->set_userdata('access_code',$this->input->post('code'));
    //               $url='https://marrs.in/student_registration/welcome/scanner1/'.$marrsacess_code_mid['school_code'];
    //                 redirect($url);    
                
    //         }elseif(!empty($zoomacess_code)){
                
    //               redirect('zoomzoom');
                
    //         }elseif(!empty($admin_code)){
                
    //                   redirect('https://marrs.in/admin/manage/login');   
                       
    //         }elseif(!empty($franchise_code)){
                
    //                   redirect('https://marrs.in/franchiselogin/franchise/index');   
                       
    //         }
            
    //         elseif(!empty($lunar_cin)){
    //             // print_r($lunar_cin);die;
                
    //             $data['data'] = $lunar_cin['cin']; 
    //                 if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 {
    //                     $this->session->set_userdata('cin', $lunar_cin['cin']);
    //                     redirect('https://marrs.in/lunar');   
                        
    //                 }  
                
    //         }
             
            
    //         elseif(!empty($zoom_cin)){
                
    //             // echo 'zoom cin';die;
    //             // print_r($zoom_cin);die;
                
    //             $data['data'] = $zoom_cin['cin']; 
    //                 if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 {
    //                     $this->session->set_userdata('cin', $zoom_cin['cin']);
    //                     redirect('https://marrs.in/zoomzoom');   
                        
    //                 }  
                
    //         } 
             
    //         elseif(!empty($result_cin) ){
                
                
    //              $data['data'] = $result_cin['cin']; 
    //                     if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                     {
    //                         $this->session->set_userdata('cin', $result_cin['cin']);
    //                         redirect('cin_login/index');   
                            
    //                     }  
                
    //          }
             
             
    //          elseif(!empty($spark_cin)){
    //             // print_r($lunar_cin);die;
                
    //             $data['data'] = $spark_cin['cin']; 
    //                 if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 {
    //                     $this->session->set_userdata('cin', $spark_cin['cin']);
    //                     redirect('https://marrs.in/spark');   
                        
    //                 }  
                
    //          }
             
    //          elseif(!empty($lunar_schedule_cin)){
    //             // print_r($lunar_schedule_cin);die;
                
    //             // $data['data'] = $lunar_schedule_cin['registration_code']; 
    //                 // if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 // {
    //                     $this->session->set_userdata('registration_code', $lunar_schedule_cin['registration_code']);
    //                     redirect('https://marrs.in/lunar/welcome/current_registration');     
                        
    //                 // }  
                
    //          }
             
    //          elseif(!empty($zoomzoom_schedule_cin)){
    //             // print_r($lunar_schedule_cin);die;
                
    //             // $data['data'] = $lunar_schedule_cin['registration_code']; 
    //                 // if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 // {
    //                     $this->session->set_userdata('registration_code', $zoomzoom_schedule_cin['registration_code']);
    //                     redirect('https://marrs.in/zoomzoom/welcome/current_registration');     
                        
    //                 // }  
                
    //          }
            
    //          elseif(!empty($spark_schedule_cin)){
    //             // print_r($lunar_schedule_cin);die;
                
    //             // $data['data'] = $lunar_schedule_cin['registration_code']; 
    //                 // if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                 // {
    //                     $this->session->set_userdata('registration_code', $spark_schedule_cin['registration_code']);
    //                     redirect('https://marrs.in/spark/welcome/current_registration');     
                        
    //                 // }  
                
    //          }
             
    //          elseif(!empty($result_prid)){
                
                        
    //                     $data['data'] = $result_prid['PRID']; 
    //                     if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                     {
    //                         $this->session->set_userdata('prid',$result_prid['PRID']);
    //                         redirect('welcome/registration_log');   
                            
    //                     }    
             
    //         }elseif(!empty($zoomzoom_prid)){
               
    //                     $data['data'] = $zoomzoom_prid['zoomzoom_prid']; 
    //                     if(!empty($this->input->post('code')) && !empty($this->input->post('password')))
    //                     {
    //                         $this->session->set_userdata('id', $zoomzoom_prid['zoomzoom_prid']);
    //                         redirect('zoomzoom/profile_zoom');   
    //                     }
                
                
                
    //         } elseif(empty($email)){
    //              $_SESSION['email'] = $this->input->post('code');
    //              redirect('welcome/current_registration');
                 
    //         }elseif(!empty($exit_email)){
    //               $data['email'] = $exit_email['stud_email'];
    //              if(!empty($this->input->post('code')) && empty($this->input->post('otp')))
    //                     {
    //                         $this->session->set_userdata('email', $exit_email['stud_email']);
    //                         $this->session->set_userdata('cin', $exit_email['cin']);
                            
    //                             $otp = rand(100000, 999999); 
    //                 	        $_SESSION['session_otp_email'] = $otp;
    //                 	        $sender = 'donotreply@marrs.in';
    //                             $recipient = $exit_email['stud_email'];
                    
    //                             $subject = "Marrs Email Verification";
    //                             $message = " Your one time email verification code is ".$otp;
    //                             $headers = 'From:' . $sender;
                                
    //                             if (mail($recipient, $subject, $message, $headers))
    //                             {
    //                                 echo " ";
    //                             }
    //                             else
    //                             {
    //                                 echo " ";
    //                             }
	                
                            
                            
                            
    //                     }
                        
    //                     if($this->input->post('otp')==$this->session->userdata('session_otp_email'))
    //                     {
    //                         $email = $exit_email['stud_email'];
    //                         redirect('cin_login/studentdata'); 
                           
    //                     }
                 
    //         }else{   
    //             $this->session->set_flashdata('schoolerror', 'Enter Wrong Id.');
    //              redirect('https://marrs.in/', 'refresh');
    //         }
          
    //     } 
	        
	   //   if(!empty($cinns)){
    //               $this->session->set_userdata('cin', $cinns);
    //                         redirect('cin_login/index');   
                            
    //          }  
	        
	   //  $this->load->view('/signin',$data);   
	    }
	    
	    
	    public function loginDasboard()
        { 
            
            $code = trim($this->input->post('code'));
            $password = $this->input->post('password');
            
            // echo $code;die;
        
            if (empty($code)) {
                $this->session->set_flashdata('schoolerror', 'Enter Id.');
                redirect('https://marrsdev.marrs.in/');
                return;
            }
        
            // ===== STATIC CODES =====
            if (strtolower($code) == 'school') {
                redirect('https://marrsdev.marrs.in/school_login/');
            }
        
            if ($code == 'Aviansys@payments') {
                redirect('Log/payments');
            }
        
            if ($code == 'Aviansys@enquiry') {
                redirect('Log/enquiry');
            }
        
            // ===== FETCH DATA =====
            $franchise_code = $this->db->get_where('franchise', ['username' => $code])->row_array();
            $admin_code = $this->db->get_where('admin_user', ['username' => $code])->row_array();
            $zoomacess_code = $this->db->get_where('franchise_to_zoomzoom', ['zoomzoom_access_code' => $code])->row_array();
            $marrsacess_code = $this->db->get_where('school_new', ['school_code' => $code])->row_array();
            $marrsacess_code_mid = $this->db->get_where('product_to_school_mid', ['school_code' => $code])->row_array();
        
            $result_prid = $this->db->get_where('students', ['prid' => $code, 'period_id' => '14'])->row_array();
        
            $lunar_schedule_cin = $this->db->get_where('lunar_schedule_cin', ['registration_code' => $code])->row_array();
            $zoomzoom_schedule_cin = $this->db->get_where('zoomzoom_schedule_cin', ['registration_code' => $code])->row_array();
            $spark_schedule_cin = $this->db->get_where('spark_schedule_cin', ['registration_code' => $code])->row_array();
        
            $cin = $this->db->get_where('cin_list', ['cin' => $code])->row_array();
            $zoomzoom_prid = $this->db->get_where('student_to_zoomzoom', ['zoomzoom_prid' => $code])->row_array();
        
            // ===== SAFE CIN CHECK =====
            $zoom_cin = $lunar_cin = $spark_cin = $result_cin = null;
        
            if (!empty($cin['cin'])) {
                if (strpos($cin['cin'], 'MZ') !== false) {
                    $zoom_cin = $cin;
                } elseif (strpos($cin['cin'], 'LU') !== false) {
                    $lunar_cin = $cin;
                } elseif (strpos($cin['cin'], 'SK') !== false) {
                    $spark_cin = $cin;
                } else {
                    $result_cin = $cin;
                }
            }
        
            // ===== REDIRECT LOGIC =====
        
            if (!empty($marrsacess_code)) {
                $this->session->set_userdata('school_code', $code);
                redirect('https://marrsdev.marrs.in/student_registration/welcome/scanner/' . $code);
            }
        
            if (!empty($marrsacess_code_mid)) {
                $this->session->set_userdata('access_code', $code);
                redirect('https://marrsdev.marrs.in/student_registration/welcome/scanner1/' . $code);
            }
        
            if (!empty($zoomacess_code)) {
                redirect('zoomzoom');
            }
        
            if (!empty($admin_code)) {
                redirect('https://marrsdev.marrs.in/admin/manage/login');
            }
        
            if (!empty($franchise_code)) {
                redirect('https://marrsdev.marrs.in/franchiselogin/franchise/index');
            }
        
            if (!empty($lunar_cin) && !empty($password)) {
                $this->session->set_userdata('cin', $lunar_cin['cin']);
                redirect('https://marrsdev.marrs.in/lunar');
            }
        
            if (!empty($zoom_cin) && !empty($password)) {
                $this->session->set_userdata('cin', $zoom_cin['cin']);
                redirect('https://marrsdev.marrs.in/zoomzoom');
            }
        
            if (!empty($spark_cin) && !empty($password)) {
                $this->session->set_userdata('cin', $spark_cin['cin']);
                redirect('https://marrsdev.marrs.in/spark');
            }
        
            if (!empty($result_cin) && !empty($password)) {
                $this->session->set_userdata('cin', $result_cin['cin']);
                redirect('cin_login/index');
            }
        
            if (!empty($lunar_schedule_cin)) {
                $this->session->set_userdata('registration_code', $code);
                redirect('https://marrsdev.marrs.in/lunar/welcome/current_registration');
            }
        
            if (!empty($zoomzoom_schedule_cin)) {
                $this->session->set_userdata('registration_code', $code);
                redirect('https://marrsdev.marrs.in/zoomzoom/welcome/current_registration');
            }
        
            if (!empty($spark_schedule_cin)) {
                $this->session->set_userdata('registration_code', $code);
                redirect('https://marrsdev.marrs.in/spark/welcome/current_registration');
            }
        
            if (!empty($result_prid) && !empty($password)) {
                $this->session->set_userdata('prid', $result_prid['PRID']);
                redirect('welcome/registration_log');
            }
        
            if (!empty($zoomzoom_prid) && !empty($password)) {
                $this->session->set_userdata('id', $zoomzoom_prid['zoomzoom_prid']);
                redirect('zoomzoom/profile_zoom');
            }
        
            // ===== DEFAULT =====
            $_SESSION['email'] = $code;
            redirect('welcome/current_registration');
        }
        

	    public function get_access_code($id='')
	    {
	        $id = $_POST['school_id'];
		    //print_r($id);exit; 
		    $sc = $this->db->get_where('schools',array('school_id'=>$id))->row(); 
            print_r($sc->school_code); 
		 
	    }  
	
	    public function current_registration_()
	    {
	        $data['reg_email']=$_SESSION['email'];
	        $data['email'] = $_POST['email'];
	        if(!empty($data['email']) && empty($_POST['otp'])){
	      
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
	   
	 
		    }
	    
	        elseif(!empty($_POST['email']) && !empty($_POST['otp'])){
	            $this->session->set_flashdata('otperror','Otp not Valid. Please enter valid Otp');
    	        if($_POST['otp'] == $_SESSION['session_otp']){
    	            $_SESSION['email']=$_POST['email'];
    	            redirect('welcome/registration_detail', 'refresh');  
    	        }
	         
	        }
	     
	    $this->load->view('new_registration_email',$data);
		 
	}
	
	
	    public function current_registration2()
        {
            // session_start();
            $apiKey = "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";
            $url = "https://api.brevo.com/v3/smtp/email";
        
            $data['reg_email'] = $_SESSION['email'];
            $data['email'] = $this->input->post('email');
        
            if (!empty($data['email']) && empty($this->input->post('otp'))) {
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
                    echo "OTP sent successfully!";
                } else {
                    echo "Error: " . $response;
                }
            }
    
            // OTP Verification
            elseif (!empty($data['email']) && !empty($this->input->post('otp'))) {
                $this->session->set_flashdata('otperror', 'Otp not Valid. Please enter valid Otp');
                if ($this->input->post('otp') == $_SESSION['session_otp']) {
                    $_SESSION['email'] = $data['email'];
                    redirect('welcome/registration_detail', 'refresh');
                }
            }
            
            $this->load->view('new_registration_email', $data);
        }
        // Working code for student registration
        public function current_registration()
        {
            $code = $this->input->post('access_code');
            $marrsacess_code = $this->db->get_where('school_new', array('school_code' => $code,'status_new'=>'Active'))->row_array();
            
            if (!empty($marrsacess_code)) {
                $this->session->set_userdata('school_code', $marrsacess_code['school_code']);
                // redirect('welcome/emailenter');
                redirect('welcome/current_registration_new');
            }else {
                redirect('https://marrs.in');
            }
        
        
            $apiKey = "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";
            $url = "https://api.brevo.com/v3/smtp/email";
        
            $data['reg_email'] = $_SESSION['email'];
            $this->session->set_userdata('access_code', $access_code);
            $data['email'] = $this->input->post('email');
        
            if (!empty($data['email']) && empty($this->input->post('otp'))) {
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
                    $data['status'] = 'success';
                    $data['message'] = 'OTP sent successfully to your email';
                } else {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed to send OTP. Try again.';
                }
            }
    
            // OTP Verification
            elseif (!empty($data['email']) && !empty($this->input->post('otp'))) {
                if ($this->input->post('otp') == $_SESSION['session_otp']) {
                    $_SESSION['email'] = $data['email'];
                    redirect('welcome/registration_detail', 'refresh');
                } else {
                    $this->session->set_flashdata('otperror', 'Otp not Valid. Please enter valid Otp');
                }
            }
            
            $this->load->view('new_reg2', $data);
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
            }else {
                redirect('https://marrs.in');
            }
            
            
        }
        
        public function scanner1() 
    	{
   
            $code = $this->uri->segment(3);
            
            $this->load->library('session');
            
            
            $marrsacess_code_mid = $this->db->get_where('product_to_school_mid', array('school_code' => $code))->row_array();
            // print_r($marrsacess_code_mid);die;
            if(!empty($marrsacess_code_mid)){        
                $this->session->set_userdata('access_code', $marrsacess_code_mid['school_code']);
                // redirect('welcome/emailenter');
                redirect('welcome/current_registration_new1');
            } else {
                redirect('https://marrs.in');
            }
            
            
        }
        
// qr registration

    	public function current_registration_new()
    	{
	       // echo $this->session->userdata('school_code');die;
	     
	        $data['school'] = $school = $this->db->get_where('school_new', array('school_code' => $this->session->userdata('school_code')))->row();
            
            $this->db->select('product_to_school.period_id,period.academic_year');
            $this->db->from('product_to_school');
            $this->db->join('period','period.period_id=product_to_school.period_id');
            $this->db->where('school_id',$school->id);
            $this->db->order_by('product_to_school.id','DESC');
            $query=$this->db->get();
	        $data['reg'] =$query->row();
	        
	       // echo $this->db->last_query();
	        
	        $data['email'] = $_POST['email'];
	        
	        if(!empty($data['email']) && empty($_POST['otp']))
	        {
	      
    	        $otp = rand(100000, 999999); 
    	        $_SESSION['session_otp'] = $otp;
    	        
        	

                $payload = [
                    "sender" => [
                        "name"  => "MaRRS",
                        "email" => "enquiry@marrs.in"
                    ],
                    "to" => [
                        [
                            "email" => $data['email']
                        ]
                    ],
                    "subject" => "Email Verification Code",
                    "htmlContent" => "
                        <!DOCTYPE html>
                        <html>
                          <body>
                            <h2>{$data['message']} <b>{$_SESSION['session_otp']}</b></h2>
                          </body>
                        </html>
                    ",
                    "replyTo" => [
                        "email" => "enquiry@marrs.in",
                        "name"  => "Marrs"
                    ],
                    "tags" => ["otp", "verification"]
                ];
            
                // Init CURL
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL            => 'https://api.brevo.com/v3/smtp/email',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING       => '',
                    CURLOPT_MAXREDIRS      => 10,
                    CURLOPT_TIMEOUT        => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST  => 'POST',
                    CURLOPT_POSTFIELDS     => json_encode($payload),
                    CURLOPT_HTTPHEADER     => [
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'API-key: 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'
                    ],
                ]);
                
                $response = curl_exec($curl);
                
                // if (curl_errno($curl)) {
                //     echo "cURL Error: " . curl_error($curl);
                // } else {
                //     echo $response;  // Brevo API response
                // }
                
                curl_close($curl);
            
                // print_r($response);
                // die;
                    
                $result = json_decode($response, true);
    
                if (isset($result['messageId'])) {
                    // success
                    $data['status'] = 'success';
                    $data['message'] = "✅ Email sent successfully!";
                    $data['otp'] = $_SESSION['session_otp']; // show OTP in view if you want
                } else {
                    // failure
                    $data['status'] = 'error';
                    $data['message'] = "❌ Error sending email: " . ($result['message'] ?? $response);
                }
                
                
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
    	            
    	            
    	           // echo $this->session->userdata('school_code');
    	           // echo  $op=strpos($this->session->userdata('school_code'), 'OP');die;
    	        
    	        
        	        if (strpos($this->session->userdata('school_code'), 'OP') !== 0) {
        	            
        	           //  echo '--'.$period.'--'.$_SESSION['email'];die;
        	             
                        $student = $this->db->get_where('students', array(
                            'email' => $_SESSION['email'],
                            'period_id' => $period,
                            'school_code' => $this->session->userdata('school_code')))->row();
                        // print_r($student);die;
                    
                        if (!empty($student)) {
                            $this->session->set_userdata('prid', $student->PRID);
                            redirect('welcome/registration_log', 'refresh');
                        } else {
                            // echo $this->session->userdata('school_code');
                            $checkOpenSchool = $this->db
                                ->select('product_to_school.*, competition_schedule.competition_schedule_id')
                                ->from('product_to_school')
                                ->join(
                                    'competition_schedule',
                                    'competition_schedule.school_id = product_to_school.school_id',
                                    'left'
                                )
                                ->where('product_to_school.school_code', $this->session->userdata('school_code'))
                                ->get()
                                ->row();
                                
                            // echo $this->db->last_query();
                            
                            // print_r($checkOpenSchool);die;
                            
                            $this->session->set_userdata('competition_schedule_id', $checkOpenSchool->school_id);
                            $isOpen = ($checkOpenSchool->competition_type == "open");
                         
                            if ($isOpen) {
                                redirect('welcome/school_form', 'refresh');
                            }else{
                            
                                redirect('welcome/register_form', 'refresh');
                                
                            }
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
	     
	     
    	    $this->load->view('student_registration_qr',$data);
    	}
	
	
	    public function current_registration_new1()
    	{
	       // echo $this->session->userdata('access_code');die;
	        $ar=explode('-',$this->session->userdata('access_code'));
	       // print_r($ar);die;
	        $school_code=$ar[0];
	        
	        $this->db->select('*');
            $this->db->from('school_new');
            $this->db->like('school_code',$school_code);
            $query=$this->db->get();
	        $data['school']= $school = $query->row();
	        
            $this->db->select('product_to_school_mid.period_id,period.academic_year');
            $this->db->from('product_to_school_mid');
            $this->db->join('period','period.period_id=product_to_school_mid.period_id');
            $this->db->where('school_id',$school->id);
            $this->db->order_by('product_to_school_mid.id','DESC');
            $query = $this->db->get();
	        $data['reg'] = $query->row();
	        
	       // echo $this->db->last_query();
	        $data['response']='';
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
                // $postFields = json_encode($data);
               
                // $curl = curl_init();
                // curl_setopt_array($curl, array(
                // // CURLOPT_URL => 'https://api.cambridgeolympiads.com/email',
                // CURLOPT_URL => 'https://api.marrs.in/email',
                // CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => '',
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 0,
                // CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => 'POST',
                
                // CURLOPT_POSTFIELDS => $postFields,
            
                //   CURLOPT_HTTPHEADER => array(
                //     'Content-Type: application/json'
                //   ),
                // ));


                // $response = curl_exec($curl);
                // curl_close($curl);

                // $data['response']=$response;
                // die;
                
                // $decodedResponse = json_decode($response, true);

                // // Attach debug info
                // $data['response'] = [
                //     'raw'     => $response,
                //     'httpCode'=> $httpCode,
                //     'error'   => $error,
                //     'parsed'  => $decodedResponse
                // ];
        
        
       $payload = [
                "sender" => [
                    "name"  => "MaRRS",
                    "email" => "enquiry@marrs.in"
                ],
                "to" => [
                    [
                        "email" => $data['email']
                    ]
                ],
                "subject" => "Email Verification Code",
                "htmlContent" => "
                    <!DOCTYPE html>
                    <html>
                      <body>
                        <h2>{$data['message']} <b>{$_SESSION['session_otp']}</b></h2>
                      </body>
                    </html>
                ",
                "replyTo" => [
                    "email" => "enquiry@marrs.in",
                    "name"  => "Marrs"
                ],
                "tags" => ["otp", "verification"]
            ];
            
            // Init CURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://api.brevo.com/v3/smtp/email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => json_encode($payload),
                CURLOPT_HTTPHEADER     => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'API-key: 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'
                ],
            ]);
            
            $response = curl_exec($curl);
            
            // if (curl_errno($curl)) {
            //     echo "cURL Error: " . curl_error($curl);
            // } else {
            //     echo $response;  // Brevo API response
            // }
            
            curl_close($curl);
            
            // print_r($response);
            // die;
                    
            $result = json_decode($response, true);

            if (isset($result['messageId'])) {
                // success
                $data['status'] = 'success';
                $data['message'] = "✅ Email sent successfully!";
                $data['otp'] = $_SESSION['session_otp']; // show OTP in view if you want
            } else {
                // failure
                $data['status'] = 'error';
                $data['message'] = "❌ Error sending email: " . ($result['message'] ?? $response);
            }
        
        
        
                $this->session->set_userdata('email',$_POST['email']);
                $this->session->set_flashdata('otpdelay','OTP will be generated in a minutes time');
    	           
           
		   }
		    elseif(!empty($_POST['email']) && !empty($_POST['otp'])){
		       
	           $this->session->set_flashdata('otperror','Otp not Valid. Please enter valid Otp');
	           
    	        if($_POST['otp'] == $_SESSION['session_otp']){
    	            
    	            $_SESSION['email']=$_POST['email'];
    	            $this->session->set_userdata('school_code',$school_code);
    	            $this->session->set_userdata('email',$this->session->userdata('email'));
    	            
    	            $this->db->select('period_id');
    	            $this->db->from('period');
    	            $this->db->where('status','Active');
    	            $query=$this->db->get();
    	            $period=$query->row();
    	            $period=$period->period_id;
    	            
    	            
    	       //     echo $this->session->userdata('school_code');
    	       // echo  $op=strpos($this->session->userdata('school_code'), 'OP');die;
    	        
    	        
    	        if (strpos($this->session->userdata('access_code'), 'OP') !== 0) {
    	            
    	            $access_code= $this->session->userdata('access_code');
    	            $ar=explode('-',$access_code);
    	            
    	            
    	            $school_code=$ar[0];
    	           // print_r();die;
                    $student = $this->db->get_where('students', array(
                        'email' => $_SESSION['email'],
                        'period_id' => $period,
                        'registration_code'=>$access_code,
                        'school_code' => $school_code))->row();
                
                    // echo $this->db->last_query();die;
                    if (!empty($student)) {
                        $this->session->set_userdata('prid', $student->PRID);
                        redirect('welcome/registration_log1', 'refresh');
                    } else {
                        redirect('welcome/register_form1', 'refresh');
                    }
                } else {
    	            $this->session->set_flashdata('otpdelay','Some Error ecounter, contact admin.');
    	            redirect('https://marrs.in');
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
                    'state'=>$data['state']->state_subdivision_id,
                    'competition_schedule_id' =>$competition_schedule_id
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
           // print_r($_SESSION);die;
            
            $data['email']=$email=$_SESSION['email'];
            if(!empty($this->session->userdata('school_id'))){
            
            $data['school']= $this->db->get_where('school_new',array('id'=>$this->session->userdata('school_id')))->row();
            }else{
                $data['school']= $this->db->get_where('school_new',array('school_code'=>$this->session->userdata('school_code')))->row();
            }
            
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
                   // 'competition_schedule_id'   => $this->session->userdata('competition_schedule_id'),
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
        
        
        //  public function school_form()
        // {
        //     // $code='AA1S10583';
        //     $data['email']=$email=$_SESSION['email'];
        //     // echo $this->session->userdata('school_code');die;
        //     $data['school']= $this->db->get_where('school_new',array('school_code'=>$this->session->userdata('school_code')))->row();
        //     $data['states'] = $this->db->order_by('state_subdivision_name','ASC')
        //                         ->get('states')->result();
            
        //      $this->load->view('open_school_form',$data);
               
            
        // }
        
    // public function school_form()
    // {
    //     $data['email']  = $email = $_SESSION['email'];
    //     $data['school'] = $this->db->get_where('school_new', array('school_code' => $this->session->userdata('school_code')))->row();
    
    //     $data['countries'] = $this->db->order_by('country_name', 'ASC')
    //                                 ->get('countries')->result();
    
    //     $data['states'] = $this->db->order_by('state_subdivision_name', 'ASC')
    //                                 ->get('states')->result();
    
    // $data['city'] = $this->db
    //     ->where('state_id', $school->state_id)
    //     ->order_by('district_name', 'ASC')
    //     ->get('districts')->result();
    //     $this->load->view('open_school_form', $data);
    // }

    
    public function school_form()
    {
        $data['email'] = $_SESSION['email'];
    
        // GET SCHOOL DATA FIRST
        $school = $this->db->get_where(
            'school_new',
            ['school_code' => $this->session->userdata('school_code')]
        )->row();
    
        $data['school'] = $school;
        $data['competition_schedule_product'] = $this->db
                            ->select('*')
                            ->from('product_to_school')->group_by('competition_schedule.product_name')
                            ->join(
                                'competition_schedule',
                                'competition_schedule.school_id = product_to_school.school_id',
                                'left'
                            )
                            ->where('product_to_school.school_code', $this->session->userdata('school_code'))
                            ->get()
                            ->result();
        // LOAD COUNTRIES ONLY
        $data['countries'] = $this->db
            ->order_by('country_name', 'ASC')
            ->get('countries')
            ->result();
    
        // LOAD STATES BASED ON SCHOOL COUNTRY
        $data['states'] = $this->db
            ->where('country_id', $school->country) 
            ->order_by('state_subdivision_name', 'ASC')
            ->get('states')
            ->result();
    
        // LOAD CITIES BASED ON SCHOOL STATE
        $data['city'] = $this->db
            ->where('state_id', $school->state) 
            ->order_by('district_name', 'ASC')
            ->get('districts')
            ->result();
            
        $data['area'] = $this->db
            ->select('id, area_code, city_name') // 👈 add this
            ->where('state_id', $school->state)
            ->order_by('city_name', 'ASC')
            ->get('areas')
            ->result();
        $this->load->view('open_school_form', $data);
    }
    

    //AJAX Area code
    public function get_areas()
    {
        $state_id    = $this->input->post('state_id');
    
        $areas = $this->db
            ->where('state_id', $state_id)
            ->get('areas')
            ->result();
    
        echo json_encode($areas);
    }
    // AJAX: states filtered by country
    
    public function get_states()
    {
        $country_id = $this->input->get('country_id');
    
        $states = $this->db->where('country_id', $country_id)
                            ->order_by('state_subdivision_name', 'ASC')
                            ->get('states')
                            ->result();
    
        echo json_encode($states);
    }
    
    // AJAX: cities filtered by state, pulled from `areas`
    public function get_cities()
    {
        $state_id = $this->input->get('state_id');
    
        $cities = $this->db
            ->select('id, district_name')
            ->where('state_id', $state_id)
            ->order_by('district_name', 'ASC')
            ->get('districts')
            ->result();
    
        echo json_encode($cities);
    }
        
    public function search()
    {
        $query = trim($this->input->get('q'));
 
        if (strlen($query) < 2) {
            header('Content-Type: application/json');
            echo json_encode([]);
            return;
        }
 
        $this->db->select('
            school_new.id,
            school_new.school_name,
            school_new.school_code,
            school_new.school_address,
            school_new.city,
            school_new.district,
            school_new.state,
            school_new.country,
            school_new.pin,
            school_new.school_mobile,
            states.state_subdivision_name,
            school_new.school_principal_name,
            school_new.principal_email
        ');
        $this->db->from('school_new');
        $this->db->join('states', 'school_new.state = states.state_subdivision_id');
        $this->db->like('school_name', $query);
        $this->db->order_by('school_name', 'ASC');
 
        $schools = $this->db->get()->result();
 
        header('Content-Type: application/json');
        echo json_encode($schools);
    }
 
    /**
     * Handle form submission (POST) from welcome/save.
     * Resolves a school_id + school_code (existing or newly created),
     * then INSERTS a new row into the students table with both.
     */
    public function save() {
        
       
        
        if ($this->input->method() !== 'post') {
            show_404();
            return;
        }
 
         $posted_school_id = $this->input->post('school_id', TRUE);
       
            
            if (!empty($posted_school_id)) {
                $this->session->set_userdata('school_id', $posted_school_id);
                $school = $this->db->get_where('school_new', ['id' => $posted_school_id])->row();
               
                // echo '<pre>';
                // print_R($school);die;
               
               
                if (!$school) {
                    echo 'Selected school not found. Please search again.';
                    return;
                }
     
                $available_school_id   = $school->id;
                $available_school_code = $school->school_code;
                                    // ✅ INSERT NEW SCHOOL
                       
                        
                        //    ==========================product To School==================================//
                        $res = $this->db->get_where('product_to_school', array('school_code' => $this->session->userdata('school_code'), 'period_id' => '16'))->result_array();
                        
                        if (!empty($res)) {
                            $insert_data = array();
                            foreach ($res as $row) {
                                unset($row['id']);
                                $row['school_id']   = $available_school_id;
                                $row['school_code'] = $available_school_code;
                                $insert_data[] = $row;
                            }
                            $this->db->insert_batch('product_to_school', $insert_data);
                        
                            // debug
                            if ($this->db->error()['code'] != 0) {
                                log_message('error', 'product_to_school insert failed: ' . print_r($this->db->error(), true));
                            }
                        }
                        
                            //    ==========================schedule==================================//
                            $fetch_school_id_row = $this->db->get_where('school_new', array('school_code' => $this->session->userdata('school_code')))->row();
                            
                            if ($fetch_school_id_row) {
                                $school_id_row = $fetch_school_id_row->id;
                            
                                $res = $this->db->get_where('competition_schedule', array('school_id' => $school_id_row, 'period_id' => '16'))->result_array();
                            
                                if (!empty($res)) {
                                    $insert_data = array();
                                    foreach ($res as $row) {
                                        unset($row['competition_schedule_id']);
                                        $row['school_id'] = $available_school_id;
                                        $insert_data[] = $row;
                                    }
                                    $this->db->insert_batch('competition_schedule', $insert_data);
                            
                                    // debug
                                    if ($this->db->error()['code'] != 0) {
                                        log_message('error', 'competition_schedule insert failed: ' . print_r($this->db->error(), true));
                                    }
                                } else {
                                    log_message('error', 'competition_schedule: no rows found for old_school_id=' . $old_school_id);
                                }
                            } else {
                                log_message('error', 'school_new: old school not found for code=' . $old_schoolcode);
                            }
                       
                
                
                
     
            } else {
                
                // echo '<pre>';
                // print_r($_POST);
                // echo '<pre>';
                // print_r($_SESSION);die;
               
                // ✅ GET AREA CODE
                $area_code = $this->input->post('area_code', TRUE);
                
                // ✅ GET LAST SCHOOL CODE FOR THIS AREA
                $this->db->like('school_code', $area_code . 'S', 'after');
                $this->db->order_by('id', 'DESC');
                $this->db->limit(1);
        
                $last = $this->db->get('school_new')->row();
                
                if ($last && strpos($last->school_code, 'S') !== false) {
                
                    $parts = explode('S', $last->school_code);
                    $num   = isset($parts[1]) ? (int)$parts[1] : 0;
                
                    $newnum = $num + 1;
                
                } else {
                
                    // ✅ FIRST ENTRY STARTS FROM 10000
                    $newnum = 10000;
                }
                
                // ✅ FINAL SCHOOL CODE
                $school_code = $area_code . 'S' . $newnum;
                
                $schoolfranchise = $this->db
                    ->select('franchise_id')
                    ->where('school_code', $this->session->userdata('school_code'))
                    ->get('school_new')
                    ->row();
        
                $franchise_id = $schoolfranchise ? $schoolfranchise->franchise_id : 0;
                // ✅ BUILD DATA
                $school_data = [
                    'school_name'    => $this->input->post('school_name', TRUE),
                    'school_code'    => $school_code, // ✅ auto generated
                    'school_address' => $this->input->post('school_address', TRUE),
                    'city'           => $this->input->post('city', TRUE),
                    'district'       => $this->input->post('district', TRUE),
                    'state'          => $this->input->post('state', TRUE),
                    'country'        => $this->input->post('country', TRUE),
                    'pin'            => $this->input->post('pin', false),
                    'school_mobile'  => $this->input->post('school_mobile', TRUE),
                    'principal_email'=> $this->input->post('principal_email', TRUE),
                    'area_code'      => $area_code,
                    'franchise_id'   => $franchise_id,
                    'status_new'     => 'Active',
                    'competition_mode' => 'online',
                    'password'       => $school_code
                ];
                
                // ✅ VALIDATION (skip these fields — not required)
                $not_required = ['pin', 'city', 'school_address', 'district','principal_email'];
                
                foreach ($school_data as $key => $value) {
                    if (in_array($key, $not_required, true)) {
                        continue;
                    }
                    if (empty($value)) {
                        echo 'Missing required field: ' . $key;
                        return;
                    }
                }
                
                // ✅ DEFAULT VALUES (avoid NOT NULL error)
                $school_data += [
                    'affiliation_number'       => '',
                    'school_email'             => '',
                    'school_phone'             => '',
                    'principal_titile'         => '',
                    'school_principal_name'    => '',
                    'principal_phone'          => '',
                    'coordinator_titile'       => '',
                    'school_coordinator_name'  => '',
                    'school_coordinator_email' => '',
                    'coordinator_phone'        => '',
                    'school_board'             => '',
                    'school_medium'            => '',
                    'franchise_id'             => '',
                    'profile'                  => '',
                ];
                
                
                // echo '<pre>';
                // print_r($_SESSION);die;
                // print_r($school_data);die;
                
                
                
                // ✅ INSERT NEW SCHOOL
                $this->db->insert('school_new', $school_data);
                $school_inserted_id = $this->db->insert_id(); // ✅ move this up — capture immediately
                $this->session->set_userdata('school_id', $school_inserted_id);
                $old_schoolcode = $this->session->userdata('school_code');
                $school_code = $school_code; // this is fine, just the newly generated code
                $school_name =  $this->input->post('school_name', TRUE);
                
                //    ==========================product To School==================================//
                $res = $this->db->get_where('product_to_school', array('school_code' => $old_schoolcode, 'period_id' => '16'))->result_array();
        
                if (!empty($res)) {
                    $insert_data = array();
                    foreach ($res as $row) {
                        unset($row['id']);
                        $row['school_id']   = $school_inserted_id;
                        $row['school_code'] = $school_code;
                        $insert_data[] = $row;
                    }
                    $this->db->insert_batch('product_to_school', $insert_data);
                
                    // debug
                    if ($this->db->error()['code'] != 0) {
                        log_message('error', 'product_to_school insert failed: ' . print_r($this->db->error(), true));
                    }
                }
                
                //    ==========================schedule==================================//
                $old_school_id_row = $this->db->get_where('school_new', array('school_code' => $old_schoolcode))->row();
                
                if ($old_school_id_row) {
                    $old_school_id = $old_school_id_row->id;
                
                    $res = $this->db->get_where('competition_schedule', array('school_id' => $old_school_id, 'period_id' => '16'))->result_array();
                
                    if (!empty($res)) {
                        $insert_data = array();
                        foreach ($res as $row) {
                            unset($row['competition_schedule_id']);
                            $row['school_id'] = $school_inserted_id;
                            $row['center_address'] = $school_name; 
                            $insert_data[] = $row;
                        }
                        
                        // echo $school_name;
                        // echo '<pre>';
                        // print_r($insert_data);die;
                        
                        
                        $this->db->insert_batch('competition_schedule', $insert_data);
                
                            
                        // debug
                        if ($this->db->error()['code'] != 0) {
                            log_message('error', 'competition_schedule insert failed: ' . print_r($this->db->error(), true));
                        }
                    } else {
                        log_message('error', 'competition_schedule: no rows found for old_school_id=' . $old_school_id);
                    }
                    
                } else {
                    log_message('error', 'school_new: old school not found for code=' . $old_schoolcode);
                } 
            }
     
            // ---- Build the student record ----
            $class = $this->input->post('class', TRUE);
     
            $student_data = [
                
                'school_code'        => $school_code,
                'school_id'          => $school_id
            ];
     
           
            // print_R($_SESSION);die;
           
            redirect('welcome/register_form', 'refresh');
           
        }


        
        public function register_form1()
        {
            // echo $this->session->userdata('access_code');
            // $code='AA1S10583';
            $data['email']=$email=$_SESSION['email'];
            $a=explode('-',$this->session->userdata('access_code'));
            
                // $school_code=$ar[0];
                
                $this->db->select('*');
                $this->db->from('school_new');
                $this->db->like('school_code',$a[0]);
                $query=$this->db->get();
                // echo $this->db->last_query();die;
                $data['school'] = $school = $query->row();
            
            // print_r($school);    
                
            $this->db->select('product_to_school_mid.period_id,period.academic_year,competition_level_byproduct.level_name,product_to_school_mid.product_name');
            $this->db->from('product_to_school_mid');
            $this->db->join('period','period.period_id=product_to_school_mid.period_id');
            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=product_to_school_mid.level_id');
            $this->db->where('school_id',$school->id);
            // $this->db->where('competition_level_byproduct.product',$school->id);
            $this->db->order_by('product_to_school_mid.id','DESC');
            $query = $this->db->get();
	        $data['reg'] = $query->row();
            
            // echo $this->db->last_query();
            // print_r($data['reg']);die;
            
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
                    'school_id'=>$school_id,
                    'registration_code'=>$this->session->userdata('access_code')
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
                  
                    redirect('welcome/registration_log1', 'refresh'); 
                }else{
                    redirect('https://marrs.in', 'refresh'); 
                }
                
                
            }
            
            $this->load->view('register_form',$data);
        }
    
        public function registration_log()
        {
        
            if(!empty($this->session->userdata('prid'))){
                // $prid=$this->session->userdata('prid');
    
        
                $data['student']= $student = $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
                if(!empty($student)){    
                    
                    $this->db->select('product_name');
                        // ->where('status', 'Active');  
                            // Array to hold the OR conditions
                            // $or_conditions = array();
                            
                            // if ($student->class == 'Nursery') {
                            //     $or_conditions[] = array('class_key' => '1');
                                
                            // }
                            
                            // if ($student->class == 'LKG' || $student->class == 'UKG') {
                            //     $or_conditions[] = array('class_key' => '5');
                            //     $or_conditions[] = array('class_key' => '1');
                            //     $or_conditions[] = array('class_key' => '4');
                                
                            // }
                            
                            // if (in_array($student->class, array('Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5', 'Class-6', 'Class-7', 'Class-8'))) {
                            //     $or_conditions[] = array('class_key' => '2');
                            //     $or_conditions[] = array('class_key' => '4');
                                
                            // }
                            
                            // if (in_array($student->class, array('Class-9', 'Class-10', 'Class-11', 'Class-12'))) {
                            //     $or_conditions[] = array('class_key' => '2');
                            // }
                            
                            // Apply the OR conditions
                            // if (!empty($or_conditions)) {
                            //     $this->db->group_start();  
                            //     foreach ($or_conditions as $condition) {
                            //         $this->db->or_where($condition);
                            //     }
                            //     $this->db->group_end();  
                            // }
                            
                            // Complete the query and get the results
                            // $all_products = $this->db->get('products')->result();
                            $all_products = $this->db->get_where('product_class_applicable',array('class'=>$student->class))->result();
                            // Debug the query
                            // echo $this->db->last_query();
                    
                            // print_r($all_products);die;
                            $school_products = $this->db->select('product_name')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->group_by('product_name')
                                     ->get('product_to_school')
                                     ->result();
                        // echo $this->db->last_query();
                        // print_r($school_products);
                        // $all_product_names = array_map(function($product) {
                        //     return $product->product_name;
                        // }, $all_products);
                        
                        // $school_product_names = array_map(function($product) {
                        //     return $product->product_name;
                        // }, $school_products);
                        $all_product_names = array_column($all_products, 'product_name');
                        $school_product_names = array_column($school_products, 'product_name');
                        // print_r($all_product_names);
                        // print_r($school_product_names);
                        $data['product_list'] = array_intersect($all_product_names, $school_product_names);
                        // print_r($data['product_list']);
                        
                        if(isset($_POST['Edit'])){
                            redirect('welcome/edit_registration_log', 'refresh');
                        }
                        
                        
                        $data['school_dates'] = $this->db->select('start_date,end_date')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->get('product_to_school')
                                     ->row();
                     //echo $this->db->last_query();die;
                    
                    
                    $this->load->view('registration_login_test',$data);
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
        }
        
        public function registration_log1()
        {
        
            if(!empty($this->session->userdata('prid'))){
                $prid=$this->session->userdata('prid');
    
        // print_r($prid);die;
                $data['student']=$student= $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                     //print_r($student);die;
                if(!empty($student)){    
                    
                    $a=explode('-',$this->session->userdata('access_code'));
            
                         
                        
                        $this->db->select('*');
                        $this->db->from('school_new');
                        $this->db->where('school_code', $student->school_code);
                        $query = $this->db->get();
                        
                        // echo $this->db->last_query(); die;
                        
                        $data['school'] = $query->row();
                         
                        
                    $this->db->select('product_to_school.competition_mode_start_date,product_to_school.amount,product_to_school.competition_mode_end_date,product_to_school.period_id,period.academic_year,competition_level_byproduct.level_name,product_to_school.product_name,product_to_school.level_id');
                    $this->db->from('product_to_school');
                    $this->db->join('period','period.period_id=product_to_school.period_id');
                    $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=product_to_school.level_id');
                    $this->db->where('school_id',$data['school']->id);
                    
                    // $this->db->where('competition_level_byproduct.product',$school->id);
                    $this->db->order_by('product_to_school.id','DESC');
                    $query = $this->db->get();
        	        $data['product_list'] =  $query->row();
                    
                    // echo $this->db->last_query();
                     //print_r($data['product_list']);die;
                    
            	    $school_id=$data['school']->id;
                    
                     
                    // print_r($data['product_list']);die;
                    
                    if(isset($_POST['Edit'])){
                        
                        redirect('welcome/edit_registration_log', 'refresh');
                    }
                    
                    
                    $data['school_dates'] = $this->db->select('start_date,end_date')
                                     ->where(array('school_id' => $data['student']->school_id, 'period_id' => $student->period_id))
                                     ->order_by('id','DESC')
                                     ->get('product_to_school')
                                     ->row();
                    // echo $this->db->last_query();
                    
                    
                    $this->load->view('registration_login_test2',$data);
                }else{
                    redirect('https://marrs.in', 'refresh');
                }        
            }else{
                redirect('https://marrs.in', 'refresh');
            }     
            
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
                    
                    
            
                    $prid = $this->session->userdata('prid');
                    $this->db->where('prid', $prid);
                    $this->db->delete('cart_prid');
                    
                    
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
            
             //print_r($_SESSION);die;
            
            $prid = $this->session->userdata('prid');
            
            $school = $this->db->get_where('school_new',array('school_code' => $_SESSION['school_code']))->row();
            $chool_id = $school->id;
            
            $student = $this->db->get_where('students',array('PRID' => $prid))->row(); 
            $period_id = $student->period_id;
            
            $a = explode("+",$_POST['value']);
            
            $product_to_school = $this->db->get_where('product_to_school',array('product_name'=>$a[1],'school_id'=>$chool_id,'period_id'=>$period_id))->row();
           
            $revenue_setting = $this->db->get_where('revenue_setting',array('id'=>$product_to_school->revenue_setting_id))->row();
            
	           // print_r($revenue_setting);die; 
	            
	                
	        $product_name = $a[1];
	                
            // ---------------------------------------------------------------- //
            $ress = $this->db->order_by('id','DESC')->get_where('competition_product_state',array('product_name'=>$product_name,'clevel'=>1,'period_id'=>$student->period_id,'revenue_setting_id'=>$product_to_school->revenue_setting_id))->row();
            
            
            
            $return = $this->revenue_calculation2($prid, $revenue_setting->id, $ress->id, $a[0], $product_name, $chool_id, $a[2], $a[3]);
            //  echo '<br>';
            //  print_r($return);die; 
                    
            $res = $this->db->get_where('cart_prid', [
                'prid'    => $prid,
                'product' => $product_name,  // adjust according to your $return structure
                'name'    => $a[2],
                'item'    => 'Competition',
            ])->row();
        
            // print_r($res);die;
            if(!empty($res)){
                
                $res = $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }    
            else{   
                $this->db->insert('cart_prid',$return);
                $res=$this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }
            
            // $res = $this->db->get_where('cart_prid',array('amount'=>$a[0],'product'=>$a[1],'prid'=>$prid,'name'=>$a[2]))->row();
            
            
            
            // $ar=array(
            //     'amount'=>$a[0],
            //     'prid'=>$prid,
            //     'product'=>$a[1],
            //     'name'=>$a[2],
            //     'class'=>$a[3]
            // );
            
            // if(!empty($res)){
            //     // $this->db->where('id',$res->id);
            //     // $this->db->delete('cart_prid');
            //     $res = $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
            //     echo count($res);
            // }    
            // else{   
            //     $this->db->insert('cart_prid',$ar);
            //     $res = $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
            //     echo count($res);
            // }
            
            
        }
        
        public function revenue_calculation2($prid, $revenue_setting_id, $comp_id, $amount, $product_name, $school_id,$name,$class)
        {
        
            $student = $this->db->get_where('students', ['PRID' => $this->session->userdata('prid')])->row();
        
            // Fetch competition and revenue setting details
            $this->db->select('competition_product_state.*, revenue_setting.*');
            $this->db->from('competition_product_state');
            $this->db->join('revenue_setting', 'revenue_setting.id = competition_product_state.revenue_setting_id', 'left');
            $this->db->where('competition_product_state.revenue_setting_id', $revenue_setting_id);
            $competition = $this->db->get()->row();
       
            // print_r($competition);die;
       
            // Fetch product_to_school info
            $product_to_school = $this->db->get_where('product_to_school', [
                'product_name' => $product_name,
                'school_id'    => $school_id,
                'period_id'    => $competition->period_id
            ])->row();
       
            // echo $this->db->last_query();
            // print_r($product_to_school);die;
       
            $school = $this->db->get_where('school_new', [
                    'id'    => $product_to_school->school_id
                ])->row();
       
       
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
            
            // echo $this->db->last_query();die;
            
            
          //print_r($maker_gst_per);die;
            // Extract revenue percentages
            // $franchise_per = $product_to_school->franchise_per ?? $competition->com_per ??  0;
            $franchise_per = (!empty($product_to_school->franchise_per)) 
                ? $product_to_school->franchise_per 
                : ((!empty($competition->com_per)) ? $competition->com_per : 0);
    
            $aviansys_per  = $product_to_school->com_peravian ?? 0;
            $manage_per    = $product_to_school->manageper ?? 0;
            $crm_fix       = $product_to_school->crm_per ?? 0;
            $school_amount = $product_to_school->school_amount ?? 0;
            $associate_per = $product_to_school->associate_per ?? 0;
            
            // echo $franchise_per;die;
            // $amount = 354;
            // Step 1: Razorpay charge (4%)
            $after_razorpay = round($amount / 1.04, 0);
            
            $razorpay_cut = $amount - $after_razorpay;
            // Step 2: Balance after Razorpay
            // $after_razorpay = round($amount - $razorpay_cut, 2);
            
            // echo $razorpay_cut.'<-razorpay_cut'.$after_razorpay.'<-after_razorpay';die;
            
            // Step 3: GST (18% of balance after Razorpay)
            // $gst_total = round($after_razorpay * 18 / 100, 2);
            $base_amount = round($after_razorpay / 1.18, 0);
            
            $gst_total = $after_razorpay - $base_amount;
            
            // echo $gst_total;die;
            
            // Step 4: Base amount after deducting GST
            // $base_amount = round($after_razorpay - $gst_total, 2);
       
            
            // Step 3: Deduct CRM, school, free royalty
            $net_baseR = $base_amount  - $school_amount;
            
        // echo $net_baseR .'<=net_baseR' .$base_amount.'<=base'.$school_amount.'<=school';
        
            // Initialize maker details
            $free_royalty = 0;
            $maker_id = $maker_razorpay_id = $maker_razorpay_name = '';
            $maker_gst = 0;
            if (!empty($mat_free)) {
                
                $maker_id = $mat_free->material_maker_id;
                $maker_razorpay_id = $mat_free->razorpay_id;
                $maker_razorpay_name = $mat_free->account_name;
                $maker_gst_per = $mat_free->gst;
                $free_royalty = $product_to_school->free_mat_royalty;
                if($maker_gst_per > 0){
                    $maker_gst = round($gst_total * $maker_gst_per / 100, 0);
                }
                $free_royalty = $free_royalty + $maker_gst;
            }
            
            $net_base = $net_baseR - $free_royalty;
            
            //  echo $free_royalty.'<-free royilaity'.$mat_free->gst.'<-mat gst'.$net_base.'<-net base';die;
             
             
            // $franchise = $this->db->get_where('franchise', ['franchise_id' => $competition->franchise_id])->row();
            $franchise = $this->db->get_where('franchise', ['franchise_id' => $school->franchise_id])->row();
            $aviansys = $this->db->get_where('gst_account_marrs', ['id' => '2'])->row();
            $manage   = $this->db->get_where('gst_account_marrs', ['id' => '3'])->row();
            $crm_acc  = $this->db->get_where('gst_account_marrs', ['id' => '5'])->row();
            $gst_acc  = $this->db->get_where('gst_account_marrs', ['id' => '1'])->row();
            $it_acc   = $this->db->get_where('gst_account_marrs', ['id' => '9', 'status' => 'Active'])->row();
        
            // if(!empty($it_acc) && $competition->it_fix > 0){
            //     $net_base = $net_base - $competition->it_fix;
            // }
            
            $it_fix_amount = 0;
            if($competition->it_fix > 0 ){
                $it_fix_amount = round($amount * ($competition->it_fix / 100), 0); // from MRP
            }
            
            
            // echo $it_fix_amount;die;
            
            $net_base = $net_base - $it_fix_amount;
            // echo $net_base;die;
            
        
            $associate_gst = 0;
            $associate_amount = 0;
            $associate_id = null;
            $associate_name = null;
            $associate_account_id = null;
            
            if (!empty($product_to_school->associate_id)) {
                $associate = $this->db->get_where('associates', ['associate_id' => $product_to_school->associate_id])->row();
            
                if ($associate) {
                    $associate_id = $associate->associate_id;
                    $associate_name = $associate->account_razorpay_name ?? '';
                    $associate_account_id = $associate->razorpay_account_id ?? '';
            
                    
            
                    $associate_amount = round($net_base * (floatval($associate_per) / 100));
                  
                    if (strtolower($associate->gst) == 'yes') {
                        $associate_gst = round($associate_amount * (18 / 100));
                         
                    }
            
                }
                
               // $franchise_per = $franchise_per - $associate_per;
               
            }
                
            
            // Step 4: Compute shares
           // Franchise share after excluding associate percentage
            $franchise_amount = round($net_base * (($franchise_per - $associate_per) / 100), 0);
            // echo $franchise_amount;die;
            
            
            // Aviansys share
            $aviansys_amount = round($net_base * ($aviansys_per / 100), 0);
            // echo $aviansys_amount;die;
            
            
            // Management share
            $management_amount = round($net_base * ($manage_per / 100), 0);
            // echo $management_amount;die;
            
            
            $franchise_gst = 0;
            if(strtolower($franchise->gst) == 'yes'){
                $franchise_gst = round($franchise_amount * 18 / 100, 0);
            }
            // echo $franchise_gst;die;
            
            
            $aviansys_gst  = round($aviansys_amount * 18 / 100, 0);
            // echo $aviansys_gst;die;
            
            
            $management_gst = 0;
            
            if($manage->gst > 0){
                $management_gst = round($management_amount * 18 / 100, 0);
            }
           
            
            // echo $net_base.'<-net_base'.$crm_fix;die;
            
            $crm_gst=0;
            $crm_fix_amount = round($net_base * $crm_fix / 100, 0);
            if($crm_acc->gst > 0 ){
                $crm_gst = round($crm_fix_amount *  18 / 100, 0);
            }
            
            // echo $crm_gst;die;
            
            // Step 6: Remaining GST to Marrs
            
            
            $marrs_gst = round($gst_total - ($franchise_gst + $aviansys_gst + $maker_gst + $crm_gst + $management_gst + $associate_gst), 0);
            
            // echo $gst_total.'<-total'.$franchise_gst.'<-fra avi->'.$aviansys_gst.'maker ->'.$maker_gst.'crm->'.$crm_gst.'manage->'.$management_gst.'ass->'.$associate_gst;die;
            
            
            
            $marrs_left = round($net_base - ($franchise_amount + $aviansys_amount + $management_amount + $associate_amount + $crm_fix_amount), 0);
            
           
           
            // Final return array
            
            return [
                'prid'                => $student->PRID,
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
                'it_fix'              => $it_fix_amount ?? 0,
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
                'franchise_id'        => $product_to_school->franchise_id,
                'school_id'           => $student->school_id,
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
                'gst_total'           => $gst_total,
                'crm_gst'             => $crm_gst,    
                'manage_gst'          => $management_gst,
            ];
            
        }

        
        
        public function revenue_calculation2_test($prid,$revenue_setting_id,$comp_id,$amount,$product_name,$chool_id)
	    {   
	        $data['student'] = $student = $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
	       // echo $prid.' '.$revenue_setting_id.'  '.$comp_id;die; 
	        
	        $return=array();
	        
	        $maker_amount=0;
	   
	        
	            
	           // $competition = $this->db->order_by('id','DESC')->get_where('competition_product_state',array('id'=>$comp_id))->row();
                $this->db->select('competition_product_state.period_id,competition_product_state.associate_id, revenue_setting.*');
                $this->db->from('competition_product_state');
                $this->db->join('revenue_setting', 'revenue_setting.id = competition_product_state.revenue_setting_id', 'left');
                $this->db->where('competition_product_state.id', $comp_id);
                $this->db->group_by('revenue_setting.id');
                $competition = $this->db->get()->row();
                // print_r($competition);die;

                $product_to_school = $this->db->get_where('product_to_school',array('product_name'=>$product_name,'school_id'=>$chool_id,'period_id'=>$competition->period_id))->row();
            


                $this->db->select('material_maker.*,assigned_materials.price');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                $this->db->where(array(
                    'assigned_materials.period_id' => $competition->period_id,
                    'study_material.status' => 'Free',
                    'class' => $student->class,
                    'product_name' => $product_name,
                    'clevel' => $competition->clevel
                ));
                $this->db->order_by('study_material.id', 'DESC');
                $mat_free = $this->db->get()->row();
                    
                    
                    
                // echo $this->db->last_query();
                
                // print_r($mat_free);die;
            
                $free_royalti_amount=0;  
                
	                if(!empty($mat_free)){
	                    $return['maker_id'] = $mat_free->material_maker_id;
	                    $return['maker_razorpay_id'] = $mat_free->razorpay_id;
	                    $return['free_royalti_amount'] = $free_royalti_amount = $competition->study_material_free_royalty;
    	                $return['maker_razorpay_name'] = $mat_free->account_name;
	                }else{
	                    $return['maker_id'] = '';
	                    $return['maker_razorpay_id'] = '';
	                    $return['free_royalti_amount'] = 0;
    	                $return['maker_razorpay_name'] = $maker->account_name;
	                }
	               
	               //echo $return['maker_razorpay_id'].' - '.$return['maker_razorpay_name'].' - '.$free_royalti_amount;die;
	               // print_r($competition);die;
	                
	                $franchise_per = $product_to_school->franchise_per;
        	        $aviansys_per = $competition->com_peravian;
        	        $manage_per = $competition->manageper;
        	  
        	        $crm_fix = $competition->crm_fix;
        	        
        	        
        	        
        	        
        	        $school_amount = $product_to_school->school_amount;       
        	       
	                
	                $total_amount = $amount;
	                
        	        $Base_GR = $total_amount;    // GR=>GST+Razorpay
        	        $Base_G = round($Base_GR/1.03);   
        	        $Base_cost = round($Base_G/1.18); 
        	        
        	        $Base_cost = $Base_cost - $crm_fix;
        	        $Base_cost = $Base_cost - $school_amount;
        	        $Base_code = $Base_cost - $free_royalti_amount;
        	        
        	        $razpay_service = $Base_GR - $Base_G;         // razorpay service charge for transaction is 3% aasumed
        	        
        	        
        	        $GST = round($Base_cost * 0.18);           // GST account money
        	                
        	        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$competition->franchise_id))->row();
	                               
        	        $franchise_id = $competition->franchise_id;  
        	        $GST_fr=0;
        	        if($franchise->gst == 'Yes'){
        	            $GST_fr =round($GST * $franchise_per/100);
        	        }          
        	        
        	        $franchise_gst = $GST_fr;
        	        
        	        $associate_per=0;
        	        if($competition->associate_id){
            	        $associate = $this->db->get_where('associates',array('associate_id'=>$competition->associate_id))->row();
    	                $associate_per = $competition->associate_per;
            	        $associate_id = $competition->associate_id;
        	        }
        	        
        	        $GST_As=0;
        	        if($associate->gst == 'Yes'){
        	            $GST_As = round($GST_fr * $associate_per/100);
        	        }
        	        $associate_gst = $GST_As ?? 0;
        	        
        	        $GST_Av =round($GST * $aviansys_per/100);
        	        $aviansys_gst = $GST_Av;
        	        
        	        $rest_GST= round($GST - $GST_fr - $GST_Av - $GST_As);
        	        $marrs_gst = $rest_GST;
        	        
        	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);
        	        $totalAviasys_pay = $Aviasys_pay + $GST_Av; // payment made to aviansys per user transaction
        	        
        	        
        	        $Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
        	        
        	        $Associate_pay = round ($Franchise_pay * $associate_per/100);   // payment made to franchise per user transaction
        	        $totalAssociate_pay = $Associate_pay + $GST_As;
        	        
        	        $totalFranchise_pay = $Franchise_pay + $GST_fr + $school_amount - $Associate_pay - $GST_As;
        	        
        	        
        	        
        	        $management_pay = round ($Base_cost * $manage_per/100);
        	        $totalmanagement = $management_pay;
        	        
        	        $return['franchise_id'] = $competition->franchise_id;
                    $return['school_id'] = $student->school_id;
                    $return['razpay_service'] = $razpay_service;
                    $return['franchise_gst'] = $franchise_gst;
                    $return['aviansys_gst'] = $aviansys_gst;
                    $return['marrs_gst'] = $marrs_gst;
        	        
        	        $totalcut = 0;
        	        $totalcut = $totalcut + $totalFranchise_pay;
        	        $totalcut = $totalcut + $totalAssociate_pay;
        	        $totalcut = $totalcut + $totalAviasys_pay;
        	        $MaRRS_Bal = $Base_cost - $totalcut;
        	        
        	        
            	    $franchise = $this->db->get_where('franchise',array('franchise_id' =>$competition->franchise_id))->row();
    	            $return['franchise_account_id'] = $franchise->account_id;
        	        $return['franchise_razorpay_name'] = $franchise->account_razorpay_name;      
            	        
            	    $this->db->select('*');
                    $this->db->from('associates');
                    $this->db->join('associate_bank_details','associate_bank_details.bank_detail_id=associates.associate_id');
                    $this->db->where('associates.associate_id',$associate_id);
                    $query=$this->db->get();
                    $associates = $query->row();
	            
	                $return['associate_id'] = $associate_id;
    	            $return['associate_account_id'] = $associates->razorpay_id;
        	        $return['associate_razorpay_name'] = $associates->account_razorpay_name;     
            	        
            	    $crm_account = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
        	        $return['crm_account_id'] = $crm_account->rozarpay_id;
        	        $return['crm_razorpay_name'] = $crm_account->account_name;     
            	        
            	    $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $return['marrsgst_account_id'] = $gst->rozarpay_id;
        	        $return['marrsgstgst_razorpay_name'] = $gst->account_name;     
            	        
            	        
            	    $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $return['marrsmanage_account_id']=$manage->rozarpay_id;
        	        $return['marrsmanage_razorpay_name']=$manage->account_name;
        	        
        	        
        	        $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $return['aviansys_account_id'] = $aviansys->rozarpay_id;
    	            $return['aviansys_razorpay_name'] = $aviansys->account_name;
            	        
                // echo $return['aviansys_account_id'].' - '.$return['aviansys_razorpay_name'];	die;        
        	        
        	   //echo $Base_GR.'=>BGR '.$Base_G.'=>BG '.$free_royalti_amount.'=>Free_matRolaity '.$crm_fix.'=>CRM '.$Base_cost.'=>BASE '.$school_amount.'=>Shcool '.$razpay_service.'=>razorpay '.$GST.'=>totalGST <br>'. 
        	   //     $franchise_gst.'=>fraGST(no gst in franchise table) '.$franchise_per.'FR% '.$Franchise_pay.'=>BsFR+FR_GST'.$GST_fr.'TotalFR(BS+GS+SC)=>'.$totalFranchise_pay.' <br>'
        	   //     .$aviansys_per.'AV%:'.$Aviasys_pay.'=>BsAV+AV_GST'.$GST_Av.'TotalAV=>'.$totalAviasys_pay.' <br>'
        	   //     .$associate_per.'ASO% '.$Associate_pay.'=>BsASO+ASO_GST'.$GST_As.'TotalASO=>'.$totalAssociate_pay.' <br>'
        	   //     .$manage_per.'MN% TotalMN=>'.$management_pay.' <br>'
        	   //     .'=>MaRRS_GST'.$rest_GST.' MaRRS_bal=>'.$MaRRS_Bal
        	   //     ;die;
        	
        	
      
            $return=[
                'prid'=>$student->PRID,
                'product'=>$competition->product_name,
                'amount'=>$Base_GR,
                'marrs_gst'=>$rest_GST,
                'marrs_left'=>$MaRRS_Bal,
                'name'=>$student->first_name.' '.$student->middle_name.' '.$student->last_name,
                'class'=>$student->class,
                'franchise_amount'=>$Franchise_pay,
                'franchise_gst'=>$GST_fr,
                'school_amount'=>$school_amount,
                'associate_amount'=>$Associate_pay,
                'associate_gst'=>$GST_As,
                'free_mat_royalty'=>$free_royalti_amount,
                'crm_fix'=>$crm_fix,
                'manage_amount'=>$management_pay,
                'aviansys_amount'=>$Aviasys_pay,
                'aviansys_gst'=>$GST_Av,
                'razorpay_cut'=>$razpay_service,
                'payment_order_id'=>'',
                'inserted_date'=>date("Y-m-d"),
                'inserted_time'=>date("H:i:s"),
                'maker_id' => $mat_free->material_maker_id,
	            'maker_razorpay_id' => $mat_free->razorpay_id,
	            'free_royalti_amount' => $free_royalti_amount,
    	        'maker_razorpay_name' => $mat_free->account_name,
               
                'franchise_id' => $competition->franchise_id,
                'school_id' => $student->school_id,
                'razpay_service' => $razpay_service,
                'franchise_gst' => $franchise_gst,
                'aviansys_gst' => $aviansys_gst,
                'marrs_gst' => $marrs_gst,
                
                'franchise_account_id' => $franchise->account_id,
        	    'franchise_razorpay_name' => $franchise->account_razorpay_name,
                
                'associate_id' => $associate_id,
    	        'associate_account_id' => $associates->razorpay_id,
        	    'associate_razorpay_name' => $associates->account_razorpay_name,
            	        
        	    'crm_account_id' => $crm_account->rozarpay_id,
        	    'crm_razorpay_name' => $crm_account->account_name,    
            	        
        	    'marrsgst_account_id' => $gst->rozarpay_id,
        	    'marrsgstgst_razorpay_name' => $gst->account_name,    
            	        
            	        
        	    'marrsmanage_account_id' => $manage->rozarpay_id,
        	    'marrsmanage_razorpay_name' => $manage->account_name,
        	        
        	        
    	        'aviansys_account_id' => $aviansys->rozarpay_id,
    	        'aviansys_razorpay_name' => $aviansys->account_name,
    	            
            ];
            
        return $return;
       
	}
        
        
        public function add_rem1()
        {
            // print_r($_POST['value']);
            $prid=$this->session->userdata('prid');
            
            $access_code=$this->session->userdata('access_code');
            $ress=$this->db->get_where('product_to_school_mid',array('school_code'=>$access_code))->row();
            
            $return = $this->revenue_calculation($prid, $ress->revenue_setting_id, $ress->comp_id);
            
            // echo '<pre>';
            // print_r($return);
            // die;
            
            //$res = $this->db->get_where('cart_prid',$return)->row();
            
            $res = $this->db->get_where('cart_prid', [
                'prid'    => $prid,
                'product' => $return['product'],  // adjust according to your $return structure
                'name'    => $return['name']      // adjust accordingly
            ])->row();
    
            // print_r($res);die;
            if(!empty($res)){
            
                $res = $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }    
            else{   
                $this->db->insert('cart_prid',$return);
                $res=$this->db->get_where('cart_prid',array('prid'=>$prid))->result();
                echo count($res);
            }
            
        }
        
        
        public function revenue_calculation($prid,$revenue_setting_id,$comp_id)
	    {   
	        $data['student'] = $student = $this->db->get_where('students',array('PRID'=>$this->session->userdata('prid')))->row();
                    // print_r($student);die;
	       // echo $prid.' '.$revenue_setting_id.'  '.$comp_id;die; 
	        
	        $return=array();
	        
	        $maker_amount=0;
	            
	            
    	            $competition = $this->db->select('product_to_school_mid.*, revenue_setting.*,competition_product_state.associate_id')
                        ->from('product_to_school_mid')
                        ->join('revenue_setting', 'revenue_setting.id = product_to_school_mid.revenue_setting_id', 'left')
                        ->join('competition_product_state', 'competition_product_state.id = product_to_school_mid.comp_id', 'left')
                        ->where([
                            // 'product_to_school.product_name' => $item->product,
                            'product_to_school_mid.comp_id' => $comp_id,
                            'product_to_school_mid.revenue_setting_id' => $revenue_setting_id
                        ])
                    ->get()
                    ->row();

                

	                $this->db->select('material_maker.*,assigned_materials.price');
                    $this->db->from('study_material');
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Free',
                        'class'=>$student->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
                    
                    // echo $this->db->last_query();
                    
                    // print_r($competition);die;
            
	                if(!empty($mat_free)){
	                    $return['maker_id'] = $mat_free->material_maker_id;
	                    $return['maker_razorpay_id'] = $mat_free->razorpay_id;
	                    $return['free_royalti_amount'] = $free_royalti_amount = $competition->study_material_free_royalty;
    	                $return['maker_razorpay_name'] = $mat_free->account_name;
	                }else{
	                    $return['maker_id'] = '';
	                    $return['maker_razorpay_id'] = '';
	                    $return['free_royalti_amount'] = 0;
    	                $return['maker_razorpay_name'] = $maker->account_name;
	                }
	               
	               //echo $return['maker_account_id'].' - '.$return['maker_razorpay_name'];die;
	               // print_r($competition);die;
	                
	                $franchise_per = $competition->com_per;
        	        $aviansys_per = $competition->com_peravian;
        	        $manage_per = $competition->manageper;
        	  
        	        $crm_fix = $competition->crm_fix;
        	        
        	        
        	        $associate_per = $competition->associate_per;
        	        $associate_id = $competition->associate_id;
        	        $school_amount = $competition->school_amount;       
        	       
	                
	                $total_amount = $competition->amount;
        	        $Base_GR = $total_amount;    // GR=>GST+Razorpay
        	        $Base_G = round($Base_GR/1.03);   
        	        $Base_cost = round($Base_G/1.18); 
        	        
        	        $Base_cost = $Base_cost - $crm_fix;
        	        $Base_cost = $Base_cost - $school_amount;
        	        $Base_code = $Base_cost - $free_royalti_amount;
        	        
        	        $razpay_service = $Base_GR - $Base_G;         // razorpay service charge for transaction is 3% aasumed
        	        
        	        
        	        $GST = round($Base_cost * 0.18);           // GST account money
        	                
        	        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$competition->franchise_id))->row();
	                               
        	        $franchise_id = $competition->franchise_id;  
        	        $GST_fr=0;
        	        if($franchise->gst == 'Yes'){
        	            $GST_fr =round($GST * $franchise_per/100);
        	        }          
        	        
        	        $franchise_gst = $GST_fr;
        	        
        	        
        	        
        	        $associate = $this->db->get_where('associates',array('associate_id'=>$competition->associate_id))->row();
	                               
        	        $associate_id = $associate->associate_id; 
        	        
        	        $GST_As=0;
        	        if($associate->gst == 'Yes'){
        	            $GST_As = round($GST_fr * $associate_per/100);
        	        }
        	        $associate_gst = $GST_As;
        	        
        	        $GST_Av =round($GST * $aviansys_per/100);
        	        $aviansys_gst = $GST_Av;
        	        
        	        $rest_GST= round($GST - $GST_fr - $GST_Av - $GST_As);
        	        $marrs_gst = $rest_GST;
        	        
        	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);
        	        $totalAviasys_pay = $Aviasys_pay + $GST_Av; // payment made to aviansys per user transaction
        	        
        	        
        	        $Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
        	        
        	        $Associate_pay = round ($Franchise_pay * $associate_per/100);   // payment made to franchise per user transaction
        	        $totalAssociate_pay = $Associate_pay + $GST_As;
        	        
        	        $totalFranchise_pay = $Franchise_pay + $GST_fr + $school_amount - $Associate_pay - $GST_As;
        	        
        	        
        	        
        	        $management_pay = round ($Base_cost * $manage_per/100);
        	        $totalmanagement = $management_pay;
        	        
        	        $return['franchise_id'] = $competition->franchise_id;
                    $return['school_id'] = $student->school_id;
                    $return['razpay_service'] = $razpay_service;
                    $return['franchise_gst'] = $franchise_gst;
                    $return['aviansys_gst'] = $aviansys_gst;
                    $return['marrs_gst'] = $marrs_gst;
        	        
        	        $totalcut = 0;
        	        $totalcut = $totalcut + $totalFranchise_pay;
        	        $totalcut = $totalcut + $totalAssociate_pay;
        	        $totalcut = $totalcut + $totalAviasys_pay;
        	        $MaRRS_Bal = $Base_cost - $totalcut;
        	        
        	        
            	    $franchise = $this->db->get_where('franchise',array('franchise_id' =>$competition->franchise_id))->row();
    	            $return['franchise_account_id'] = $franchise->account_id;
        	        $return['franchise_razorpay_name'] = $franchise->account_razorpay_name;      
            	        
            	    $this->db->select('*');
                    $this->db->from('associates');
                    $this->db->join('associate_bank_details','associate_bank_details.bank_detail_id=associates.associate_id');
                    $this->db->where('associates.associate_id',$associate_id);
                    $query=$this->db->get();
                    $associates = $query->row();
	            
	                $return['associate_id'] = $associate_id;
    	            $return['associate_account_id'] = $associates->razorpay_id;
        	        $return['associate_razorpay_name'] = $associates->account_razorpay_name;     
            	        
            	    $crm_account = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
        	        $return['crm_account_id'] = $crm_account->rozarpay_id;
        	        $return['crm_razorpay_name'] = $crm_account->account_name;     
            	        
            	    $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $return['marrsgst_account_id'] = $gst->rozarpay_id;
        	        $return['marrsgstgst_razorpay_name'] = $gst->account_name;     
            	        
            	        
            	    $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $return['marrsmanage_account_id']=$manage->rozarpay_id;
        	        $return['marrsmanage_razorpay_name']=$manage->account_name;
        	        
        	        
        	        $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'4'))->row();
    	            $return['aviansys_account_id'] = $aviansys->rozarpay_id;
    	            $return['aviansys_razorpay_name'] = $aviansys->account_name;
            	        
                // echo $return['aviansys_account_id'].' - '.$return['aviansys_razorpay_name'];	die;        
        	        
        	   //echo $Base_GR.'=>BGR '.$Base_G.'=>BG '.$free_royalti_amount.'=>Free_matRolaity '.$crm_fix.'=>CRM '.$Base_cost.'=>BASE '.$school_amount.'=>Shcool '.$razpay_service.'=>razorpay '.$GST.'=>totalGST <br>'. 
        	   //     $franchise_gst.'=>fraGST(no gst in franchise table) '.$franchise_per.'FR% '.$Franchise_pay.'=>BsFR+FR_GST'.$GST_fr.'TotalFR(BS+GS+SC)=>'.$totalFranchise_pay.' <br>'
        	   //     .$aviansys_per.'AV%:'.$Aviasys_pay.'=>BsAV+AV_GST'.$GST_Av.'TotalAV=>'.$totalAviasys_pay.' <br>'
        	   //     .$associate_per.'ASO% '.$Associate_pay.'=>BsASO+ASO_GST'.$GST_As.'TotalASO=>'.$totalAssociate_pay.' <br>'
        	   //     .$manage_per.'MN% TotalMN=>'.$management_pay.' <br>'
        	   //     .'=>MaRRS_GST'.$rest_GST.' MaRRS_bal=>'.$MaRRS_Bal
        	   //     ;die;
        	
        	
      
            $return=[
                'prid'=>$student->PRID,
                'product'=>$competition->product_name,
                'amount'=>$Base_GR,
                'marrs_gst'=>$rest_GST,
                'marrs_left'=>$MaRRS_Bal,
                'name'=>$student->first_name.' '.$student->middle_name.' '.$student->last_name,
                'class'=>$student->class,
                'franchise_amount'=>$Franchise_pay,
                'franchise_gst'=>$GST_fr,
                'school_amount'=>$school_amount,
                'associate_amount'=>$Associate_pay,
                'associate_gst'=>$GST_As,
                'free_mat_royalty'=>$free_royalti_amount,
                'crm_fix'=>$crm_fix,
                'manage_amount'=>$management_pay,
                'aviansys_amount'=>$Aviasys_pay,
                'aviansys_gst'=>$GST_Av,
                'razorpay_cut'=>$razpay_service,
                'payment_order_id'=>'',
                'inserted_time'=>date("Y-m-d"),
                'inserted_date'=>date("h:i:sa"),
                'maker_id' => $mat_free->material_maker_id,
	            'maker_razorpay_id' => $mat_free->razorpay_id,
	            'free_royalti_amount' => $free_royalti_amount,
    	        'maker_razorpay_name' => $mat_free->account_name,
               
                'franchise_id' => $competition->franchise_id,
                'school_id' => $student->school_id,
                'razpay_service' => $razpay_service,
                'franchise_gst' => $franchise_gst,
                'aviansys_gst' => $aviansys_gst,
                'marrs_gst' => $marrs_gst,
                
                'franchise_account_id' => $franchise->account_id,
        	    'franchise_razorpay_name' => $franchise->account_razorpay_name,
                
                'associate_id' => $associate_id,
    	        'associate_account_id' => $associates->razorpay_id,
        	    'associate_razorpay_name' => $associates->account_razorpay_name,
            	        
        	    'crm_account_id' => $crm_account->rozarpay_id,
        	    'crm_razorpay_name' => $crm_account->account_name,    
            	        
        	    'marrsgst_account_id' => $gst->rozarpay_id,
        	    'marrsgstgst_razorpay_name' => $gst->account_name,    
            	        
            	        
        	    'marrsmanage_account_id' => $manage->rozarpay_id,
        	    'marrsmanage_razorpay_name' => $manage->account_name,
        	        
        	        
    	        'aviansys_account_id' => $aviansys->rozarpay_id,
    	        'aviansys_razorpay_name' => $aviansys->account_name,
    	            
            ];
            
        return $return;
       
	}

        public function add_rem_pro()
        {
            $prid=$this->session->userdata('prid');
                
            
                $this->db->where('id',$_POST['value']);
                $this->db->delete('cart_prid');
            $res=$this->db->get_where('cart_prid',array('prid'=>$prid))->result();
            echo count($res);
        }
    
        public function get_cart()
        {
             $prid=$this->session->userdata('prid');
             $cartData = $this->db->select('id,product,amount,name')
                             ->where(array('prid' => $prid))
                             ->get('cart_prid')
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
	
		public function registration_detail($data='')
	    { 
    	    $this->session->unset_userdata('post');
    	    $data['state']= $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result_array();
    	    $data['detail']= $_POST;
    	    $this->load->view('registration_detail',$data);
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

        public function resendotp($id='')
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
           redirect('https://marrs.in/signin.php');
        }
        
        public function wcregistration_new()
    	{
	   //  echo $this->session->userdata('school_code');die;
	        $data['email'] = $_POST['email'];
	        if(!empty($data['email']) && empty($_POST['otp'])){
	      
	        $otp = rand(100000, 999999); 
	        $_SESSION['session_otp'] = $otp;
	        
        	   // $data = array(
            //         'email' => $data['email'],
            //         'otp' => $_SESSION['session_otp'],
            //         'message' => " Your one time email verification code is "
            //     );
            //     // print_r($data);die;
            //     $postFields = json_encode($data);
               
            //     $curl = curl_init();
            //     curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://api.cambridgeolympiads.com/email',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
                
            //     CURLOPT_POSTFIELDS => $postFields,
            
            //       CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/json'
            //       ),
            //     ));


            //     $response = curl_exec($curl);
            //     curl_close($curl);

                // print_r($response);
                // die;
                
                
                
            $payload = [
                "sender" => [
                    "name"  => "MaRRS",
                    "email" => "enquiry@marrs.in"
                ],
                "to" => [
                    [
                        "email" => $data['email']
                    ]
                ],
                "subject" => "Email Verification Code",
                "htmlContent" => "
                    <!DOCTYPE html>
                    <html>
                      <body>
                        <h2>{$data['message']} <b>{$_SESSION['session_otp']}</b></h2>
                      </body>
                    </html>
                ",
                "replyTo" => [
                    "email" => "enquiry@marrs.in",
                    "name"  => "Marrs"
                ],
                "tags" => ["otp", "verification"]
            ];
            
            // Init CURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => 'https://api.brevo.com/v3/smtp/email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => json_encode($payload),
                CURLOPT_HTTPHEADER     => [
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'API-key: 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'
                ],
            ]);
            
            $response = curl_exec($curl);
            
            // if (curl_errno($curl)) {
            //     echo "cURL Error: " . curl_error($curl);
            // } else {
            //     echo $response;  // Brevo API response
            // }
            
            curl_close($curl);
            
            // print_r($response);
            // die;
                    
            $result = json_decode($response, true);

            if (isset($result['messageId'])) {
                // success
                $data['status'] = 'success';
                $data['message'] = "✅ Email sent successfully!";
                $data['otp'] = $_SESSION['session_otp']; // show OTP in view if you want
            } else {
                // failure
                $data['status'] = 'error';
                $data['message'] = "❌ Error sending email: " . ($result['message'] ?? $response);
            }
                
        
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