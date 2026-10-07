<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
    public function __constructs() {
        parent::__construct();
	
	    $this->load->helper('url');
	//	$this->load->library('encrypt');
		$this->load->library('email');
		$this->load->library('form_validation');
       // $this->load->library('form-validation'); 
		$this->load->library('session');
        $this->load->library('upload');
        $this->load->model('Index');
        
   }

	
    public function index() 
	{	
        if(isset($_POST['submit'])){
          $this->db->select('*');
         $this->db->from('cin_list');
         $this->db->where('cin',$_POST['cin']);
         $this->db->where('password',$_POST['password']);
         $result = $this->db->get()->result_array();
           
 		//	print_r($result);die;
            if (!$result) 
			{
                $this->session->set_flashdata('error','Wrong cin or password ...');
            }
			 else 
			 {
			   
                 $this->session->set_userdata('cin', $result[0]['cin']);
    
                redirect('cin_login/index', 'refresh'); // load index controller
            }
        }
        
        if(isset($_POST['z'])){redirect('zoomzoom/index', 'refresh');}
        
	    $this->load->view('cin_login/Login.php');
	
    }
	
	
	 public function index2() 
	{	
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $result = $this->Index->cin_login($_POST['cin'],$_POST['password']);
 		//	print_r($result);die;
            if (!$result) 
			{
                $this->session->set_flashdata('error','Wrong cin or password ...');
            }
			 else 
			 {
			   
                 $this->session->set_userdata('cin', $result[0]['cin']);
    
                redirect('cin_login/index', 'refresh'); // load index controller
            }
        }
        
        if(isset($_POST['z'])){redirect('zoomzoom/index', 'refresh');}
        
	    $this->load->view('cin_login/login_national.php');
	
    }
	 public function payments(){
	     
	    if(isset($_POST['submit'])){
	       //print_r($_POST); die;
	        $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
        
            // Query the database for records within the date range
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->where('date_of_payment >=', $startDate);
            $this->db->where('date_of_payment <=', $endDate);
            $this->db->order_by('pay_id', 'DESC');
            // $this->db->limit(100);
            $query = $this->db->get();
        
            // Get the result and store it in the $data array
            $data['payments'] = $query->result_array();
            $data['message'] = 'Showing payments from ' . $startDate . ' to ' . $endDate;
            $data['result'] = $_POST;
            } else {
                // Default case to show the last 100 payments
                $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->order_by('pay_id', 'DESC');
                $this->db->limit(100);
                $query = $this->db->get();
            
                // Get the result and store it in the $data array
                $data['payments'] = $query->result_array();
                $data['message'] = 'Showing Last 100 Payments';
            }
	    
	    $this->load->view('payments.php',$data);
	     
	}
	
	public function enquiry(){
	    
	    
        
        if(isset($_POST['status'])){
            $res = $this->db->get_where('enquiry',array('enquiry_id'=>$_POST['enquiry_id']))->row();
            //print_r($res->email);die;
            $this->db->where('enquiry_id',$_POST['enquiry_id']);
            $this->db->update('enquiry',array('status'=>$_POST['status'],'reply'=>$_POST['reply']));
            
             $message .='<p>Your Open issue is closed. Please review the solution. If not satisfactory raise another ticket.</p><br>';
             $message .='<p>Thanks & Regards,</p>';
             $message .='<p>MaRRS Team</p>';
            //  $headers['From'] = 'enquiry@marrs.in';
            //  $headers['MIME-Version'] = 'MIME-Version: 1.0';
            //  $headers['Content-type'] = 'text/html; charset=iso-8859-1';
            //  $this->load->library('email'); 
            //  $subject ='MaRRS Enquiry Ticket'; 
             
                $data = array(
                    'email' => $res->email,
                    'otp' => '',
                    'message' => $message
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
                // print_r($response);die;
            $data['message']='Status Updated to '.$_POST['status'].' ...';
            $data['result']=$_POST;
        }
	    if(isset($_POST['submit'])){
            $this->db->select('enquiry.ticket_number,enquiry.enquiry_id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_list.state_id,enquiry.enquiry,enquiry.date,enquiry.status,enquiry.ticket_number,enquiry.evidence,enquiry_type.enquiry_name');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type','left');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin','left');
            $this->db->where('date >=', $_POST['start_date']);
            $this->db->where('date <=', $_POST['end_date']);
            // $this->db->where('enquiry.state_id', $_POST['state_id']);
            if($_POST['status']!='All'){
                $this->db->where('enquiry.status', $_POST['status']);
            }
            if($_POST['enquiry_type']!='All'){
                $this->db->where('enquiry_type.enquiry_id', $_POST['enquiry_type']);
            }
            
            
            $this->db->order_by('enquiry.enquiry_id','DESC');
            // $this->db->limit('50');
            $query = $this->db->get();
            // echo $this->db->last_query();
            $data['payments']=$query->result_array();
            if(empty($data['payments'])){
                $data['message']='No Enquiry Found ...';
            }else{
                $data['message']='Enquiries Found ...';
            }
            $data['result']=$_POST;
        }else{
            $this->db->select('enquiry.ticket_number,enquiry.enquiry_id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_list.state_id,enquiry.enquiry,enquiry.date,enquiry.status,enquiry.ticket_number,enquiry.evidence,enquiry_type.enquiry_name');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type','left');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin','left');
            // $this->db->where('enquiry.status', 'Open');
            $this->db->order_by('enquiry.enquiry_id','DESC');
            $this->db->limit('50');
            $query = $this->db->get();
            // echo $this->db->last_query();
            $data['payments']=$query->result_array();
            
            if(empty($data['payments'])){
                $data['message']='No Enquiry Found ...';
            }else{
                $data['message']='By Default Showing Last 50 Enquiries...';
            }
        }
	    
	    $this->load->view('enquiry.php',$data);
	}
	
    
    public function submit_reply()
    {
        // print_r($_FILES);die;
        $enquiryId = $this->input->post('enquiry_id');
        $reply = $this->input->post('reply');
        
        // Retrieve enquiry details from the database
        $enquiry = $this->db->get_where('enquiry', array('enquiry_id' => $enquiryId))->row();
    
            if (!$enquiry) {
                echo 0; 
                return;
            }
        
        if(!empty($_FILES['replyFile'])){
            $fileLink = '';
            $target_dir = FCPATH . "images/evidence/"; 
            $target_file = $target_dir . basename($_FILES["replyFile"]["name"]);
            
            if (move_uploaded_file($_FILES["replyFile"]["tmp_name"], $target_file)) {
               $fileLink='https://marrs.in/student_registration/images/evidence/'.$_FILES["replyFile"]["name"];
            } else {
                $data['message']=$_FILES["replyFile"]["error"];
            }
        }
       
        // $subject = 'MaRRS Enquiry Ticket Closure';
        $message = '<p>Your open issue is closed. Please review the solution. If not satisfactory, raise another ticket.</p><br>';
        $message .= $reply;
        $message .= '<p>Thanks & Regards,</p>';
        $message .= '<p>MaRRS Team</p>';
        
        if ($fileLink) {
            $message .= '<p>You can download the file from the following link: <a href="' . $fileLink . '">' . basename($fileLink) . '</a></p>';
        }
    
                $pas = array(
                    'email' => $enquiry->email,  
                    'otp' => '',  
                    'message' => $message
                    );

                
                $postFields = json_encode($pas);
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
                
            // print_r($response);die;    
        if (!empty($response)) {
            $this->db->where('enquiry_id', $enquiryId);
            $this->db->update('enquiry', array('status' => 'Close', 'reply' => $reply));
    
            echo 1;
        } else {
            echo 0; 
           
        }
    }

        
    
          
	
	
}/* END OF CLASS*/

