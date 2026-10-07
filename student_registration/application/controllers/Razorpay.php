<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class Razorpay extends CI_Controller {
    public function __construct() {
        parent::__construct();
    	$this->load->model('newmodel');
        $this->load->model('zoommodel');
        $this->load->library('session');
    	
    }

    public function test_razor()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        $api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
    
        try {
            $order = $api->order->create([
                'amount' => 100,
                'currency' => 'INR',
                'receipt' => 'test_' . time()
            ]);
    
            echo "<pre>";
            print_r($order);
    
        } catch (Exception $e) {
            echo "<h3>RAZORPAY ERROR</h3>";
            echo "<pre>";
            echo $e->getMessage(); // This is the important part
            echo "</pre>";
        }
    }


	public function index()
	{
		$this->load->view('registration-form');
	}


	public function zoompay()
	{
	    
		$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
	 
		$amount = $_POST['amount'];
		$prid  = $_POST['prid'];
        //$product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		//$price_code = $_POST['price_code'];
		
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
		'prid'    =>$prid
	
		);
		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('zoomzoom/razorpay',array('data' => $data));
	}
	 
	 
	public function zoompay_isc()
	{
	     
	     	$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
	 
		$amount = $_POST['amount'];
//	$amount=1;
		$prid  = $_POST['prid'];
        //$product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		//$price_code = $_POST['price_code'];
		
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
		'prid'    =>$prid
	
		);
		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('zoomzoom/razorpay1',array('data' => $data));
	     
	 }
	 
	 
	public function verifyics()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		//echo 'aaa';print_r($razorpay_order_id);exit;
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
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
           
			redirect(base_url().'razorpay/zoomsuccessics'); 
		}
		else {
			redirect(base_url().'razorpay/zoompaymentFailedics');
		}
	}
	 
	 
	public function zoomsuccessics()
	{   
	    $data = $this->session->userdata('payment_data');
		
		//print_r($data);die;
		$data['ar']=array(
		    'razorpay_order_id'=>$data['razorpay_order_id'],
		    'amount'=>$data['amount'],
		    'prid'=>$data['prid']
		    );
		
	
		$data['prid'] =$data['prid'];
	
	$prid=$data['prid'];
	$cin=str_replace("REG","ZZZ",$prid);
	
//	echo $cin.' '.$prid;die; 
		$this->db->select('*');
		$this->db->from('zoom_add');
		$this->db->where('pid',$data['prid']);
		$query = $this->db->get();
         //echo $this->db->last_query();exit;
        $res=$query->result_array();
	    foreach($res as $row){
	     if($row['token']=='MockTest'){
	         $rr=array(
	             'product_name'=>'MaRRS Math Zoom Zoom Challenge',
	             'razorpay_payment_id'=>$data['razorpay_order_id'],
	             'prid'=>$row['pid'],
	             'token'=>'MockTest',
	             'level_id'=>'2',
	             'period'=>'12',
	             'cin'=>$cin,
	             'amount'=>'400'
	             );
	         $this->db->insert('zoomzoom_mocktest_purchase',$rr);
	     }
	     if($row['token']=='Orientation'){
	         $rr=array(
	              'product_name'=>'MaRRS Math Zoom Zoom Challenge',
	              'razorpay_payment_id'=>$data['razorpay_order_id'],
	             'prid'=>$row['pid'],
	             'token'=>'Orientation',
	             'level_id'=>'2',
	             'period'=>'12',
	             'cin'=>$cin,
	             'amount'=>'1250'
	             );
	         $this->db->insert('zoomzoom_orientatition_purchase',$rr);
	     }
	     if($row['token']=='Competition'){
	         $rr=array(
	             'razorpay_payment_id'=>$data['razorpay_order_id'],
	             'merchant_order_id'=>$data['razorpay_order_id'],
	             'amount'=>$row['amount'],
	             'clevel'=>'2',
	             'period_id'=>'12',
	             'payment_status'=>'Success',
	             'prid'=>$prid
	             );
	         $this->db->insert('zoomzoom_to_purchase',$rr);
	     }
	     $this->db->where('pid',$prid);
	     $this->db->delete('zoom_add');
	     
	 }
		$this->session->set_userdata('prid',$prid);
 
        $this->load->view('zoomzoom/success2', $data);
	}
	/**
	 * This is a function called when payment failed,
	 * and shows the error message
	 */
	public function zoompaymentFailedics()
	{
	    $data = $this->session->userdata('payment_data');
    	$prid = $data['prid'];
       
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
      //  $data['student']=$this->newmodel->get_student_data($prid);
        $this->load->view('zoomzoom/tranctionfailed', $data);
	} 
	 
	 
	 
	public function verifypz()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		//echo 'aaa';print_r($razorpay_order_id);exit;
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
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
           
			redirect(base_url().'razorpay/zoomsuccess'); 
		}
		else {
			redirect(base_url().'razorpay/zoompaymentFailed');
		}
	}
	 
	 
	 
	public function pay()
	{
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
		//print_r($_POST);exit; 
	    //$amount = 1*100;
	    $amount =	$_POST['amount']*100;     
		$cin  = $_POST['cin'];
        $product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		$price_code = $_POST['price_code'];
		$clevel = $_POST['clevel'];
		
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		
		$Pay_array = array(
		
		'razorpay_order_id' => $razorpayOrderId,
		'amount'            => $amount,
		'cin'               =>$cin,
		'product_name'    =>$product_name,
		'price_code'      =>$price_code,
		'clevel'=>$clevel
		);
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay',array('data' => $data));
	}


//-----------------Start statwise---------------//
    public function statepay()
	{
		$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
		//print_r($_POST);exit; 
		//$amount = 1;        
	    $amount =	$_POST['amount']; 
		$cin  = $_POST['cin'];
        $stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		
		
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
		'cin'               =>$cin,
		'product_name'    =>$product_name,
		'price_code'      =>$price_code
		);
 		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay',array('data' => $data));
	}
	
//-----------------end statwise---------------//


	public function interlevel()
	{ 
		$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
	//print_r($_POST);exit; 
		$amount = $_POST['amount'];   
		$cin  = $_POST['cin'];
        //$product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		//$price_code = $_POST['price_code'];  
		
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
		'cin'               =>$cin,
		//'product_name'    =>$product_name,
		//'price_code'      =>$price_code
		);
		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay',array('data' => $data));
	}

	
	public function verify()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
			redirect(base_url().'razorpay/success'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed');
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
			"key" => 'rzp_live_kG7f8nF6sKGPhx',
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

	/**
	 * This is a function called when payment successfull,
	 * and shows the success message
	 */
	 
	public function success()
	{   
	    $data = $this->session->userdata('payment_data');
	        
	        //print_r($data);exit; 

		$cin=$data['cin'];
	
		$data['cin']=$data['cin'];
       
	//	$this->newmodel->cart_newstate($cin,$data,$statid->state_id); 
		$this->newmodel->cart_new_add($data);
// 		echo 'ok';
// 		die;
		$student=$this->newmodel->get_student_data_cin_($cin);
		
	// ================== //	
// 		$data['clevel'];
// 		$cin;
		
		$this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('cin',$data['cin']);
         $this->db->where("clevel",$data['clevel']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
		
	
// 		======================== email ============================== //
           $to=$student['stud_email'];
            
            // $to = "recipient@example.com";
            $subject = "MaRRS purchase Invoice";
            
            // HTML message
            $htmlContent = '<html><body>';
            
            $htmlContent .= '<h2>' . 'Hello &nbsp'.$student['student_name'] .'&nbsp Your purchase is successful. Find the list of purchase items. '. '</h2><br>';
            
                foreach ($res as $item) {
                    $htmlContent .= '<h2>&nbsp' . $item['product_name'] . '</h2>';
                    // Add other details from your array as needed
                    $htmlContent .= '<p>&nbsp Amount: &nbsp' . $item['amount'] . '</p>';
                    
                    // Check if the status is 'Paid'
                    if ($item['status'] == 'Paid') {
                        $htmlContent .= '<p>&nbsp Competition </p>';
                    } 
                    
                    if($item['study_material'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - A</p>';
                    }
                    if($item['study_material_b'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - B</p>';
                    }
                    if($item['orientation'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - A</p>';
                    }
                    if($item['orientation_b'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - B</p>';
                    }
                    if($item['mock_test'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test</p>';
                    }
                    $htmlContent .= '<p>&nbsp &nbsp Payment ID</p>'.' '.$item['razorpay_payment_id'];
                    // Add more fields as needed
                    $htmlContent .= '<br><hr>';
                }
                
                
                $htmlContent .= '</body></html>';
            
            // Additional headers
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: <enquiry@marrs.in>' . "\r\n";
            // $headers .= 'Cc: another-email@example.com' . "\r\n";
            
            // Send the email
            
           // echo $to;die;
            
            
            mail($to, $subject, $message, $headers);





//  ================== end =================== //
		
		
		$this->db->where('cin',$cin);
		$this->db->delete('amount_cart');
        // $this->db->delete('statewise_addtocart');    
		$data['student']=$this->newmodel->get_student_data($cin);
	//print_r($data);
        $this->load->view('cin_login/success', $data);
        
	}
	
	public function paymentFailed()
	{
	    $data = $this->session->userdata('payment_data');
    	$cin = $data['cin'];
        $data['arr']=$data['product_name'];
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/tranctionfailed', $data);
	}
	
	public function zoomsuccess()
	{   
	    $data = $this->session->userdata('payment_data');
		
		$level ='1';
		$period = '12';
	//	echo 'ok';
//		$data['prid'] ='22ZREG100001';
		$data_cart=$this->zoommodel->get_student_cart_data($data['prid']); 
		
		//	print_r($data_cart);die;
		
		$ck=$this->zoommodel->get_student_key($data['prid']); 
		//print_r($data_cart);
		$class_key=$ck[0]['class_key'];
		$all_product=$this->zoommodel->get_all_product_name($class_key); 
		
	
	    if(!empty($data_cart)){	
		foreach($data_cart as $row){    
		   //print_r($row['token'][0]);die;
		    if($row['token'][0]=='z'){
		       //print_r($row);die;
		        $it=explode("REG",$data['prid']);
		        //print_r($it);die;
		        foreach($all_product as $row){
		            
		           // print_r($row);die;
    		        $cin='22Z'.$row['initial'].$it[1];
    		        
    		        
    		        $ar=array(
    		            'cin'=>$cin,
    		            'product_name'=>$row['product_name'],
    		            'prid' => $data['prid'],
    		            'level_id'  =>  $level,
                        'period' =>$period,
                        'status'=>'Active'
    		            );
    		    //print_r($ar);die;
    		           
    		        $this->db->insert('zoomzoom_to_cin',$ar);
		            }
		        
		           
		        }
		        
		    if($row['token'][0]=='s'){
		       // print_r($row);die;
		         $it=explode("G",$data['prid']);
		        $op=$row['token'][2].$row['token'][3].$row['token'][4];
		        $pa = $this->db->select('product_name')->where('initial',$op)->get('zoomzoom_product_activate')->result_array();
                // print_r($pa[0]['product_name']);
		        $cin='22Z'.$row['token'][2].$row['token'][3].$row['token'][4].$it[1];
		        
		        $ar=array(
		            'cin'=>$cin,
		            'product_name'=>$pa[0]['product_name'],
		            'prid' => $data['prid'],
		            'level_id'  =>  $level,
                    'period' =>$period,
                    'status'=>'Active',
                    'token'=>$row['token']
		            );
		    //print_r($ar);die;
		           
		        $this->db->insert('zoomzoom_studymaterial_purchase',$ar); 
		        $this->db->delete('zoomzoom_amount_cart', array('prid' => $data['prid'],'token'=>$row['token']));
		    }
		    
		    if($row['token'][0]=='o'){
		       // print_r($row);die;
		         $it=explode("G",$data['prid']);
		        $op=$row['token'][2].$row['token'][3].$row['token'][4];
		        $pa = $this->db->select('product_name')->where('initial',$op)->get('zoomzoom_product_activate')->result_array();
                // print_r($pa[0]['product_name']);
		        $cin='22Z'.$row['token'][2].$row['token'][3].$row['token'][4].$it[1];
		        
		        $ar=array(
		            'cin'=>$cin,
		            'product_name'=>$pa[0]['product_name'],
		            'prid' => $data['prid'],
		            'level_id'  =>  $level,
                    'period' =>$period,
                    'token'=>$row['token']
		            );
		   // print_r($ar);die;
		           
		        $this->db->insert('zoomzoom_orientatition_purchase',$ar);
		        $this->db->delete('zoomzoom_amount_cart', array('prid' => $data['prid'],'token'=>$row['token']));
		    }
		    
		    if($row['token'][0]=='m'){
		       // print_r($row);die;
		         $it=explode("G",$data['prid']);
		        $op=$row['token'][2].$row['token'][3].$row['token'][4];
		        $pa = $this->db->select('product_name')->where('initial',$op)->get('zoomzoom_product_activate')->result_array();
                // print_r($pa[0]['product_name']);
		        $cin='22Z'.$row['token'][2].$row['token'][3].$row['token'][4].$it[1];
		        
		        $ar=array(
		            'cin'=>$cin,
		            'product_name'=>$pa[0]['product_name'],
		            'prid' => $data['prid'],
		            'level_id'  =>  $level,
                    'period' =>$period,
                    
                    'token'=>$row['token']
		            );
		   // print_r($ar);die;
		           
		        $this->db->insert('zoomzoom_mocktest_purchase',$ar);
		        $this->db->delete('zoomzoom_amount_cart', array('prid' => $data['prid'],'token'=>$row['token']));
		    }
		    
		}
		
	}	
		
		
		
            $data_array = array(
                
                'prid' => $data['prid'],
                'razorpay_payment_id' => $data['razorpay_order_id'],
                'merchant_order_id' => $data['razorpay_order_id'],
                'amount' => $data['amount'],
                'Payment_status' => 'Success',
                'clevel'  =>  $level,
                'period_id' =>$period
            );
            $payment_multiple = $this->db->get_where('zoomzoom_to_purchase',array('prid' =>$data['prid']))->result();
           // print_r($payment_multiple);die;
            if(empty($payment_multiple)){  
            $res = $this->db->insert('zoomzoom_to_purchase',$data_array);
            $this->db->delete('zoomzoom_amount_cart', array('prid' => $data['prid'])); 
            if($res){
              $this->session->set_flashdata('success','Transaction Completed Successfully'); 
              
              
            }
        }
    	     
    	   
        $data=array(
             'prid' => $data['prid'],
            'razorpay_payment_id' => $data['razorpay_order_id'],
            'merchant_order_id' => $data['razorpay_order_id'],
            'amount' => $data['amount'],
            'Payment_status' => 'Success',
            'clevel'  =>  $level,
            'period_id' =>$period
            );
        
        
        
        $amount_data=$data['amount'];
         $data['title'] = 'Razorpay Success ';  
       
        $data['session']=$this->session->userdata('payment_data');
        //$this->newmodel->cart_new($cin,$data);
        // $this->newmodel->cart_new_enter($cin,$data);
        // $this->db->where('cin', $cin);
        // $this->db->delete('zoomzoom_cart');
        //$data['student']=$this->newmodel->get_student_data($prid);
        $this->load->view('zoomzoom/success', $data);
	}
	
	/**
	 * This is a function called when payment failed,
	 * and shows the error message
	 */
	 
	public function zoompaymentFailed()
	{
	    $data = $this->session->userdata('payment_data');
    	$prid = $data['prid'];
       
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
      //  $data['student']=$this->newmodel->get_student_data($prid);
        $this->load->view('zoomzoom/tranctionfailed', $data);
	}
	
	public function statecurrent()
	{
		$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
		//print_r($_POST);exit; 
		//$amount = 1;        
	    $amount =	$_POST['amount']; 
		$cin  = $_POST['cin'];
        $stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		
		
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
		'cin'               =>$cin,
		'product_name'    =>$product_name,
		'price_code'      =>$price_code
		);
 		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpaycurrent',array('data' => $data));
	}
	
	public function verifycurrent()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
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
           
			redirect(base_url().'razorpay/currentsuccess'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed');
		}
	}

	public function currentsuccess()
	{   
	   $data = $this->session->userdata('payment_data');
	//print_r($data);exit; 
		$cin=$data['cin'];
	
		$data['cin']=$data['cin'];
        $statid = $this->db->get_where('new_cart',array('cin'=>$cin))->row();
        if(!empty($statid)){
        $this->db->where('cin',$cin);
        $arry = array(
            'mock_test' =>'Yes'
            );
        $this->db->update('new_cart',$arry);
        
        }else{
             $product = $this->db->get_where('cin_result',array('cin'=>$cin))->row();
             $product_name= $product->product_name;
             $level = $product->clevel;
             
            $arry = array(
                'mock_test' =>'Yes',
                'amount' => $data['amount'],
                'cin' =>$cin,
                'product_name'=>$product_name,
                'clevel'=>$level,
                'razorpay_payment_id'=>$data['razorpay_order_id'],
                'period_id'=>'13'
                
            
            );
            $this->db->insert('new_cart',$arry);
            $this->db->where('cin',$cin);
            $this->db->delete('statewise_addtocart');
            
        }
        
	
        $this->load->view('cin_login/success', $data);
	}
	
	
	
// ============================ Payment Split code start ========================== //	
	
	public function pay2_()
	{
	   $data = $this->session->userdata('payment_data');
	   
	   //print_r($data);
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
// 		print_r($_POST);exit; 

	   // $amount = 2*100; 
	   
	    
	    $amount =	$_POST['amount']*100;     
		$cin  = $_POST['cin'];
        $product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		$price_code = $_POST['price_code'];
		$clevel = $_POST['clevel'];
		
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];


        $comp_id = $_SESSION['exam_id'];
        
        
        $this->db->where('comp_id',$comp_id);
        $this->db->where('cin',$cin);
        $this->db->update('amount_cart',['payment_id'=>$razorpayOrderId,'payment_order_id'=>$razorpayOrderId]);
		
		$this->db->where('comp_id',$comp_id);
        $this->db->where('cin',$cin);
        $this->db->where('transaction_id',null); // checking for null transfer id to maker pay
        $this->db->update('makers_splits',['order_id'=>$razorpayOrderId]);
		
		 
	    
	   // print_r($data);die;
	    
	        $this->db->select('*');
	        $this->db->from('competition_product_state');
	        $this->db->where('id',$_SESSION['exam_id']);
	        $query = $this->db->get();
	        $competition = $query->row();
	        
	        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$cin))->row();
	       // echo '<pre>';
	       // print_r($paid_idd);die;
	       
	       // $total_amount = $data['amount']/100; // ---------- 1 RS test
	        $total_amount = $_POST['amount'];    // ---------- original amount
	        
	       // echo $total_amount;die;
	       // print_r($_SESSION);die;
	       
	        $state_id = $paid_idd->state_id;
	        $period_id = $paid_idd->period_id;
	        $clevel = $competition->clevel;
	        $product_name = $competition->product_name;
	       
	        
	       // print_r($competition);die;
	        $franchise_id = $competition->franchise_id;
	        $comp_id = $competition->id;
	        
	        $insert_array = array();
	        $cart_data = $this->db->get_where('amount_cart',array('cin'=>$cin,'comp_id'=>$comp_id))->result();
	      
    	        $razpay_service=0;
    	        $franchise_gst=0;
                $aviansys_gst=0;
                $marrs_gst=0;
                $franchise_pay=0;
                $associate_pay=0;
                $aviasys_pay=0;
                $MaRRS_Bal=0;
                $associate_gst=0;
                $crm=0;
                $management_pay=0;
                $marrs_gst=0;
                
    	        $maker_push=array();
    	        
    	        foreach($cart_data as $item){
    	           // echo '<pre>';
    	           // print_r($item);die;
    	            
    	            $razpay_service = $razpay_service + $item->razpay_service;
    	            $marrs_gst = $marrs_gst + $item->marrs_gst;
    	            $franchise_gst = $franchise_gst + $item->franchise_gst;
    	            $aviansys_gst = $aviansys_gst + $item->aviansys_gst;
    	            
    	            $franchise_pay = $franchise_pay + $item->franchise_pay;
                    $associate_pay = $associate_pay + $item->associate_pay;
                    $associate_gst = $associate_gst + $item->associate_gst;
                    $aviasys_pay = $aviasys_pay + $item->aviasys_pay;
                    $MaRRS_Bal = $MaRRS_Bal + $item->MaRRS_Bal;
                    $crm = $crm + $item->crm_fix;
                    $management_pay = $management_pay + $item->management_pay;
                    $marrs_gst = $marrs_gst + $item->marrs_gst;
    	        }
    	        
    	        $insert_array=[
        	        'cin' => $cin,
        	        'clevel' => $competition->clevel,
        	        'product_name' => $competition->product_name,
        	        'name' => $paid_idd->student_name,
        	        'class' => $paid_idd->class,
        	        'total_amount' => $total_amount,
        	        'payment_id' => $razorpayOrderId,
        	        'franchise_id' => $franchise_id,
        	        'franchise_amount' => $franchise_pay - $franchise_gst,
        	        'franchise_gst' => $franchise_gst,
        	        'franchise_account_id' => $cart_data[0]->franchise_account_id,
        	        'franchise_razorpay_name' => $cart_data[0]->franchise_razorpay_name,
        	        'associate_id' => $associate_id,
        	        'associate_account_id' => $cart_data[0]->associate_account_id,
        	        'associate_razorpay_name' => $cart_data[0]->associate_razorpay_name,
        	        'associate_gst' => $associate_gst,
        	        'associate_amount' => $associate_pay-$associate_gst,
        	        'crm_account_id' => $cart_data[0]->crm_account_id,
        	        'crm_razorpay_name' => $cart_data[0]->crm_razorpay_name,
        	        'crm_fix' => $crm,
        	        'maker_razorpay_name' => '',
        	        'maker_razorpay_id' => '',
        	        'razpay_service' => $razpay_service,
        	        'total_maker_amount' => '',
        	        'aviansys_account_id' => $cart_data[0]->aviansys_account_id,
        	        'aviansys_razorpay_name' => $cart_data[0]->aviansys_razorpay_name,
        	        'aviansys_amount' => $aviasys_pay-$aviansys_gst,
        	        'aviansys_gst' => $aviansys_gst,
        	        'marrsmanage_rozarpay_id' => $cart_data[0]->marrsmanage_account_id,
        	        'marrsmanage_razorpay_name' => $cart_data[0]->marrsmanage_razorpay_name,
        	        'management_amount' => $management_pay,
        	        'inserted_time' => date("h:s:i"),
        	        'inserted_date' => date("Y-m-d"),
        	        'status' => 0,
        	        'MaRRS_bal' => $MaRRS_Bal,
        	        'marrs_gst' => $marrs_gst,
        	        'gst_amount' => '',
        	        'date_of_payment' => '',
        	        'comp_id' => $comp_id
    	        ];
    	       // echo '<pre>';
    	       
    	       // print_r($insert_array);die;
    	        
    	        $webhook_calls_cin = $this->db->get_where('webhook_calls_cin',array('payment_id'=>$razorpayOrderId))->row();
    	        
    	        $this->db->where('comp_id',$comp_id);
    	        $this->db->where('cin',$cin);
    	        $this->db->where('total_amount',$total_amount);
    	        $this->db->delete('webhook_calls_cin');
    	       // echo $this->db->last_query();
    	      
                $this->db->insert('webhook_calls_cin',$insert_array);
                 
	        
        // 		$cin=$data['cin'];
        	
        // 		$data['cin']=$data['cin'];
		
		
		
		
		$Pay_array = array(
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'cin'               => $cin,
    		'product_name'      => $product_name,
    		'price_code'        => $price_code,
    		'clevel'            => $clevel
		);
		
// 		print_r($Pay_array);die;
		
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay2',array('data' => $data));
	}
	
	public function pay2()
    {
        
        // print_r($_SESSION);die;
      
        $student_name = $_POST['name'];
        $stud_email = $_POST['email'];
        $stud_phone = $_POST['contact'];
        $price_code = $_POST['price_code'];
        $amount = $_POST['amount'] * 100;
        
        
        $comp_id = $this->session->userdata('exam_idm');
        $cin = $this->session->userdata('cinm');
        
        
        $clevel = $this->session->userdata('clevel');   
        $product_name = $this->session->userdata('product');
        
        
        // Initialize Razorpay API
        $api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
        
        // Create Razorpay order
        $orderData = [
            'amount' => $amount,
            'currency' => 'INR'
        ];
        
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        $this->db->where(['comp_id' => $comp_id, 'cin' => $cin])
                 ->update('amount_cart', [
                     'payment_id' => $razorpayOrderId,
                     'payment_order_id' => $razorpayOrderId
                 ]);
        
        $this->db->where(['comp_id' => $comp_id, 'cin' => $cin, 'transaction_id' => null])
                 ->update('makers_splits', ['order_id' => $razorpayOrderId]);
        
        // Get competition and student details
        $competition = $this->db->get_where('competition_product_state', ['id' => $comp_id])->row();
        $student = $this->db->get_where('cin_list', ['cin' => $cin])->row();
        
        // Get cart data with all calculated values
        $cart_data = $this->db->get_where('amount_cart', [
            'cin' => $cin, 
            'comp_id' => $comp_id,
            'payment_id' => $razorpayOrderId
        ])->result();
        
        // Calculate totals from amount_cart (matching the exact values stored)
        $totals = $this->calculateWebhookTotals($cart_data);
        
        // Prepare webhook data using calculated totals
        $webhook_data = [
            'cin' => $cin,
            'clevel' => $competition->clevel,
            'product_name' => $competition->product_name,
            'name' => $student->student_name,
            'class' => $student->class,
            'total_amount' => $_POST['amount'],
            'payment_id' => $razorpayOrderId,
            'franchise_id' => $competition->franchise_id,
            'franchise_amount' => $totals['franchise_amount'],
            'franchise_gst' => $totals['franchise_gst'],
            'franchise_account_id' => $totals['franchise_account_id'],
            'franchise_razorpay_name' => $totals['franchise_razorpay_name'],
            'associate_id' => $totals['associate_id'],
            'associate_account_id' => $totals['associate_account_id'],
            'associate_razorpay_name' => $totals['associate_razorpay_name'],
            'associate_gst' => $totals['associate_gst'],
            'associate_amount' => $totals['associate_amount'],
            'crm_account_id' => $totals['crm_account_id'],
            'crm_razorpay_name' => $totals['crm_razorpay_name'],
            'crm_fix' => $totals['crm_fix'],
            'it_fix' => $totals['it_fix'],
            'maker_razorpay_name' => $totals['maker_razorpay_name'],
            'maker_razorpay_id' => $totals['maker_razorpay_id'],
            'razpay_service' => $totals['razpay_service'],
            'total_maker_amount' => $totals['total_maker_amount'],
            'aviansys_account_id' => $totals['aviansys_account_id'],
            'aviansys_razorpay_name' => $totals['aviansys_razorpay_name'],
            'aviansys_amount' => $totals['aviansys_amount'],
            'aviansys_gst' => $totals['aviansys_gst'],
            'marrsmanage_rozarpay_id' => $totals['marrsmanage_account_id'],
            'marrsmanage_razorpay_name' => $totals['marrsmanage_razorpay_name'],
            'management_amount' => $totals['management_amount'],
            'inserted_time' => date("H:i:s"),
            'inserted_date' => date("Y-m-d"),
            'status' => 0,
            'MaRRS_bal' => $totals['MaRRS_Bal'],
            'marrs_gst' => $totals['marrs_gst'],
            'gst_amount' => $totals['gst_amount'],
            'date_of_payment' => '',
            'comp_id' => $comp_id
        ];
        
        // echo '<pre>';
        // print_r($webhook_data);die;
        
        // Delete existing webhook record and insert new one
        $this->db->delete('webhook_calls_cin', [
            'payment_id' => $razorpayOrderId,
            'comp_id' => $comp_id,
            'cin' => $cin,
            'total_amount' => $_POST['amount']
        ]);
        
        $this->db->insert('webhook_calls_cin', $webhook_data);
        
        // Prepare payment data for session
        $payment_data = [
            'razorpay_order_id' => $razorpayOrderId,
            'amount' => $_POST['amount'],
            'cin' => $cin,
            'product_name' => $product_name,
            'price_code' => $price_code,
            'clevel' => $clevel
        ];
        
        $this->session->set_userdata('payment_data', $payment_data);
        
        // Prepare data for view
        $view_data = $this->prepareData($_POST['amount'], $razorpayOrderId);
        
        $this->load->view('razorpay2', ['data' => $view_data]);
    }
    

    public function pay2primary()
    {
       
        $student_name = $_POST['name'];
        $stud_email = $_POST['email'];
        $stud_phone = $_POST['contact'];
        $price_code = $_POST['price_code'];
        //$amount = 10 * 100;
        $amount = $_POST['amount'] * 100;
        $cin = $this->session->userdata('cinm');
        
        
        $clevel = 13;
        
        
        // Initialize Razorpay API
        $api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
        
        // Create Razorpay order
        $orderData = [
            'amount' => $amount,
            'currency' => 'INR'
        ];
        
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        
        $this->db->where('cin' , $cin);
        $this->db->like('product_name', 'Primary');
        $this->db->update('amount_cart', [
             'payment_id' => $razorpayOrderId,
             'payment_order_id' => $razorpayOrderId
        ]);
        
        // $this->db->where(['cin' => $cin, 'transaction_id' => null]) and where product_name like "%Primary%"
        //          ->update('makers_splits', ['order_id' => $razorpayOrderId]);
        
        $this->db->where('cin', $cin);
        $this->db->where('transaction_id IS NULL', null, false); // important for NULL
        $this->db->like('product_name', 'Primary'); // automatically becomes %Primary%
        $this->db->update('makers_splits', ['order_id' => $razorpayOrderId]);
        
        // Get competition and student details
        $competition = $this->db->get_where('competition_product_state', ['id' => $comp_id])->row();
        $student = $this->db->get_where('cin_list', ['cin' => $cin])->row();
        
        // Get cart data with all calculated values
        $cart_data = $this->db->get_where('amount_cart', [
            'cin' => $cin, 
            'payment_id' => $razorpayOrderId
        ])->result();
        
        
        $totals = $this->calculateWebhookTotalsPrimary($cart_data);

            // ✅ delete once
            $this->db->where('payment_id', $razorpayOrderId);
            $this->db->where('cin', $cin);
            $this->db->delete('webhook_calls_cin');
            
            // ✅ insert ONE row
            $webhook_data = [
                'cin' => $cin,
                'clevel' => $competition->clevel ?? '',
                
                // ✅ MULTIPLE VALUES
                'product_name' => $totals['product_names'],
                'comp_id'      => $totals['comp_ids'],
            
                'name' => $student->student_name,
                'class' => $student->class,
                'total_amount' => $this->input->post('amount'),
                'payment_id' => $razorpayOrderId,
            
                'franchise_id' => $competition->franchise_id ?? '',
                'franchise_amount' => $totals['franchise_amount'],
                'franchise_gst' => $totals['franchise_gst'],
                'franchise_account_id' => $totals['franchise_account_id'],
                'franchise_razorpay_name' => $totals['franchise_razorpay_name'],
            
                'associate_id' => $totals['associate_id'],
                'associate_account_id' => $totals['associate_account_id'],
                'associate_razorpay_name' => $totals['associate_razorpay_name'],
                'associate_gst' => $totals['associate_gst'],
                'associate_amount' => $totals['associate_amount'],
            
                'crm_account_id' => $totals['crm_account_id'],
                'crm_razorpay_name' => $totals['crm_razorpay_name'],
                'crm_fix' => $totals['crm_fix'],
            
                'maker_razorpay_name' => $totals['maker_razorpay_name'],
                'maker_razorpay_id' => $totals['maker_razorpay_id'],
            
                'razpay_service' => $totals['razpay_service'],
                'total_maker_amount' => $totals['total_maker_amount'],
            
                'aviansys_account_id' => $totals['aviansys_account_id'],
                'aviansys_razorpay_name' => $totals['aviansys_razorpay_name'],
                'aviansys_amount' => $totals['aviansys_amount'],
                'aviansys_gst' => $totals['aviansys_gst'],
            
                'marrsmanage_rozarpay_id' => $totals['marrsmanage_account_id'],
                'marrsmanage_razorpay_name' => $totals['marrsmanage_razorpay_name'],
                'management_amount' => $totals['management_amount'],
            
                'inserted_time' => date("H:i:s"),
                'inserted_date' => date("Y-m-d"),
                'status' => 0,
            
                'MaRRS_bal' => $totals['MaRRS_Bal'],
                'marrs_gst' => $totals['marrs_gst'],
                'gst_amount' => $totals['gst_amount'],
                'date_of_payment' => ''
            ];
        
        // echo '<pre>';   
        // print_r($cart_data);
        // print_R($webhook_data);die;
        $this->session->set_userdata('cart_data', $cart_data);
        $this->session->set_userdata('webhook_data', $webhook_data);
        $this->session->set_userdata('primaryColor', '1');
        $this->db->insert('webhook_calls_cin', $webhook_data);
                    
        // Prepare payment data for session
        $payment_data = [
            'razorpay_order_id' => $razorpayOrderId,
            'amount' => $_POST['amount'],
            'cin' => $cin,
            'product_name' => $product_name,
            'price_code' => $price_code,
            'clevel' => $clevel
        ];
        
        $this->session->set_userdata('payment_data', $payment_data);
        
        // Prepare data for view
        $view_data = $this->prepareData($_POST['amount'], $razorpayOrderId);
        
        $this->load->view('razorpay2', ['data' => $view_data]);
    }

    /*
     * Helper function to calculate webhook totals from amount_cart data
     * This ensures webhook_calls_cin has the exact same calculations as amount_cart
    */
    
    
    private function calculateWebhookTotalsPrimary($cart_data)
    {
        $totals = [
            'razpay_service' => 0,
            'marrs_gst' => 0,
            'franchise_gst' => 0,
            'aviansys_gst' => 0,
            'franchise_amount' => 0,
            'associate_amount' => 0,
            'associate_gst' => 0,
            'aviansys_amount' => 0,
            'MaRRS_Bal' => 0,
            'crm_fix' => 0,
            'it_fix' => 0,
            'management_amount' => 0,
            'gst_amount' => 0,
            'total_maker_amount' => 0,
    
            // ✅ NEW: for comma separated values
            'comp_ids' => [],
            'product_names' => [],
    
            // account fields
            'franchise_account_id' => '',
            'franchise_razorpay_name' => '',
            'associate_id' => '',
            'associate_account_id' => '',
            'associate_razorpay_name' => '',
            'crm_account_id' => '',
            'crm_razorpay_name' => '',
            'maker_razorpay_name' => '',
            'maker_razorpay_id' => '',
            'aviansys_account_id' => '',
            'aviansys_razorpay_name' => '',
            'marrsmanage_account_id' => '',
            'marrsmanage_razorpay_name' => ''
        ];
    
        if (empty($cart_data)) return $totals;
    
        foreach ($cart_data as $item) {
    
            // ✅ sums
            $totals['razpay_service'] += $item->razpay_service;
            $totals['marrs_gst'] += $item->marrs_gst;
            $totals['franchise_gst'] += $item->franchise_gst;
            $totals['aviansys_gst'] += $item->aviansys_gst;
            $totals['franchise_amount'] += $item->franchise_amount;
            $totals['associate_amount'] += $item->associate_amount;
            $totals['associate_gst'] += $item->associate_gst;
            $totals['aviansys_amount'] += $item->aviansys_amount;
            $totals['MaRRS_Bal'] += $item->MaRRS_Bal;
            $totals['crm_fix'] += $item->crm_fix;
            $totals['it_fix'] += $item->it_fix;
            $totals['management_amount'] += $item->manage_amount;
            $totals['gst_amount'] += $item->gst_total ?? 0;
            $totals['total_maker_amount'] += $item->free_royalti_amount ?? 0;
    
            // ✅ collect comp_id & product_name
            if (!empty($item->comp_id)) {
                $totals['comp_ids'][] = $item->comp_id;
            }
    
            if (!empty($item->product_name)) {
                $totals['product_names'][] = $item->product_name;
            }
        }
    
        // ✅ make unique + comma separated
        $totals['comp_ids'] = implode(',', array_unique($totals['comp_ids']));
        $totals['product_names'] = implode(',', array_unique($totals['product_names']));
    
        // ✅ first item accounts
        $first = $cart_data[0];
        $totals['franchise_account_id'] = $first->franchise_account_id;
        $totals['franchise_razorpay_name'] = $first->franchise_razorpay_name;
        $totals['associate_id'] = $first->associate_id;
        $totals['associate_account_id'] = $first->associate_account_id;
        $totals['associate_razorpay_name'] = $first->associate_razorpay_name;
        $totals['crm_account_id'] = $first->crm_account_id;
        $totals['crm_razorpay_name'] = $first->crm_razorpay_name;
        $totals['maker_razorpay_name'] = $first->maker_razorpay_name ?? '';
        $totals['maker_razorpay_id'] = $first->maker_razorpay_id ?? '';
        $totals['aviansys_account_id'] = $first->aviansys_account_id;
        $totals['aviansys_razorpay_name'] = $first->aviansys_razorpay_name;
        $totals['marrsmanage_account_id'] = $first->marrsmanage_account_id;
        $totals['marrsmanage_razorpay_name'] = $first->marrsmanage_razorpay_name;
    
        return $totals;
    }
        
    private function calculateWebhookTotals($cart_data)
    {
        // Initialize totals with default values
        $totals = [
            'razpay_service' => 0,
            'marrs_gst' => 0,
            'franchise_gst' => 0,
            'aviansys_gst' => 0,
            'franchise_amount' => 0,
            'associate_amount' => 0,
            'associate_gst' => 0,
            'aviansys_amount' => 0,
            'MaRRS_Bal' => 0,
            'crm_fix' => 0,
            'management_amount' => 0,
            'gst_amount' => 0,
            'total_maker_amount' => 0,
            // Account IDs and names (take from first cart item)
            'franchise_account_id' => '',
            'franchise_razorpay_name' => '',
            'associate_id' => '',
            'associate_account_id' => '',
            'associate_razorpay_name' => '',
            'crm_account_id' => '',
            'crm_razorpay_name' => '',
            'maker_razorpay_name' => '',
            'maker_razorpay_id' => '',
            'aviansys_account_id' => '',
            'aviansys_razorpay_name' => '',
            'marrsmanage_account_id' => '',
            'marrsmanage_razorpay_name' => '',
            'it_fix' => 0
        ];
        
        if (empty($cart_data)) {
            return $totals;
        }
        
        // Sum up all monetary values from cart items
        foreach ($cart_data as $item) {
            $totals['razpay_service'] += $item->razpay_service;
            $totals['marrs_gst'] += $item->marrs_gst;
            $totals['franchise_gst'] += $item->franchise_gst;
            $totals['aviansys_gst'] += $item->aviansys_gst;
            $totals['franchise_amount'] += $item->franchise_amount;
            $totals['associate_amount'] += $item->associate_amount;
            $totals['associate_gst'] += $item->associate_gst;
            $totals['aviansys_amount'] += $item->aviansys_amount;
            $totals['MaRRS_Bal'] += $item->MaRRS_Bal;
            $totals['crm_fix'] += $item->crm_fix;
            $totals['it_fix'] += $item->it_fix;
            $totals['management_amount'] += $item->manage_amount;
            $totals['gst_amount'] += $item->gst_total ?? 0;
            $totals['total_maker_amount'] += 
            ($item->free_royalti_amount ?? 0) + 
            ($item->bundle_a_royality ?? 0) + 
            ($item->bundle_b_royality ?? 0) + 
            ($item->bundle_c_royality ?? 0);
            
        }
        
        // Get account details from first cart item (they should be the same for all items)
        $first_item = $cart_data[0];
        $totals['franchise_account_id'] = $first_item->franchise_account_id;
        $totals['franchise_razorpay_name'] = $first_item->franchise_razorpay_name;
        $totals['associate_id'] = $first_item->associate_id;
        $totals['associate_account_id'] = $first_item->associate_account_id;
        $totals['associate_razorpay_name'] = $first_item->associate_razorpay_name;
        $totals['crm_account_id'] = $first_item->crm_account_id;
        $totals['crm_razorpay_name'] = $first_item->crm_razorpay_name;
        $totals['maker_razorpay_name'] = $first_item->maker_razorpay_name ?? '';
        $totals['maker_razorpay_id'] = $first_item->maker_razorpay_id ?? '';
        $totals['aviansys_account_id'] = $first_item->aviansys_account_id;
        $totals['aviansys_razorpay_name'] = $first_item->aviansys_razorpay_name;
        $totals['marrsmanage_account_id'] = $first_item->marrsmanage_account_id;
        $totals['marrsmanage_razorpay_name'] = $first_item->marrsmanage_razorpay_name;
        
        return $totals;
    }
        
        
	public function verify2()
    {
        $razorpay_order_id = $this->session->userdata('payment_data');
        $order_id = $razorpay_order_id['razorpay_order_id'];
        $success = true;
        $error = "payment_failed";
              // Verify payment signature
        if (empty($_POST['razorpay_payment_id']) === false) {
            $api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
            try {
                $attributes = array(
                    'razorpay_order_id' => $order_id,
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                $api->utility->verifyPaymentSignature($attributes);
            } catch(SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }
        
        if ($success === true) {
                 // Save registration data
            $this->setRegistrationData();
            
            $cart_data    = $this->session->userdata('payment_data');
            
            $webhook_data = $this->session->userdata('webhook_data');
            $primaryColor = $this->session->userdata('primaryColor');
            if (!empty($primaryColor) && $primaryColor === '1') {
                $this->processWebhookCartData($webhook_data);
            }else{
              $webhook_calls_cin = $this->db->get_where('webhook_calls_cin', array('payment_id' => $order_id))->row();
            }
            $makers_split = $this->db->get_where('makers_splits', array('order_id' => $order_id))->result();
        
            $this->processCartItems($webhook_calls_cin, $makers_split);
            
            $this->processPaymentSplitsEndpoint($order_id);
            
            
            // Determine redirect based on competition
            $this->db->select('revenue_setting_id');
            $this->db->from('competition_product_state');
            $this->db->where('id', $_SESSION['exam_id']);
            $query = $this->db->get();
            $competition = $query->row();
            
            if ($competition) {
                redirect(base_url().'razorpay/success2_test_test');
            } else {
                redirect(base_url().'razorpay/success2'); 
            }
        } else {
            redirect(base_url().'razorpay/paymentFailed2');
        }
    }
    
    
    private function updatePaymentStatus2($cin, $orderId,$comp_id)
    {
        $competition = $this->db->get_where('competition_product_state',array('id' => $comp_id))->row();
        
        $cart_data = $this->db->get_where('amount_cart',array('cin' => $cin,  'razorpay_payment_id' => $orderId))->result();
	    
        foreach($cart_data as $cart){
            
            if($cart->title == 'Competition'){
                $updateFields['status'] = 'Paid';
            }
            
            if($cart->title == 'Material A'){
                $updateFields['study_material_a'] = 'Yes';
            }
            if($cart->title == 'Material B'){
                $updateFields['study_material_b'] = 'Yes';
            }
            if($cart->title == 'Material C'){
                $updateFields['study_material_c'] = 'Yes';
            }
            if($cart->title == 'Material D'){
                $updateFields['study_material_d'] = 'Yes';
            }
            if($cart->title == 'Material E'){
                $updateFields['study_material_e'] = 'Yes';
            }
            if($cart->title == 'Material F'){
                $updateFields['study_material_f'] = 'Yes';
            }
            
            
            
            if($cart->title == 'Orientation A'){
                $updateFields['orientation_a'] = 'Yes';
            }
            if($cart->title == 'Orientation B'){
                $updateFields['orientation_b'] = 'Yes';
            }
            if($cart->title == 'Orientation C'){
                $updateFields['orientation_c'] = 'Yes';
            }
            if($cart->title == 'Orientation D'){
                $updateFields['orientation_d'] = 'Yes';
            }
            if($cart->title == 'Orientation E'){
                $updateFields['orientation_e'] = 'Yes';
            }
            if($cart->title == 'Orientation F'){
                $updateFields['orientation_f'] = 'Yes';
            }
            
            
            if($cart->title == 'MockTest A'){
                $updateFields['mock_test_a'] = 'Yes';
            }
            if($cart->title == 'MockTest B'){
                $updateFields['mock_test_b'] = 'Yes';
            }
            if($cart->title == 'MockTest C'){
                $updateFields['mock_test_c'] = 'Yes';
            }
            if($cart->title == 'MockTest D'){
                $updateFields['mock_test_d'] = 'Yes';
            }
            if($cart->title == 'MockTest E'){
                $updateFields['mock_test_e'] = 'Yes';
            }
            if($cart->title == 'MockTest F'){
                $updateFields['mock_test_f'] = 'Yes';
            }
            
            
            $Data = [
                'cin' => $cin,
                'comp_id' => $comp_id,
                'razorpay_payment_id' => $order_id,
                'merchant_order_id' => $order_id,
                'Time' => date("Y-m-d H:i:s"),
                'order_id' => $order_id,
                'payment_id' => $order_id,
                'subject' => $competition->subject ?? null,
                'series' => $competition->series ?? null,
                'type' => $competition->type ?? null
            ];
    
            // Merge updateFields into Data if you need to persist flags
            $Data = array_merge($Data, $updateFields);
                
            $this->db->insert('new_cart', $Data);
        }
        
    }
    
    
    /**
     * Process payment splits asynchronously
     * This can be called via AJAX, cron job, or queue system
     */
    private function processPaymentSplitsAsync($order_id)
    {
        // Option 1: Use exec() to run in background (if shell access available)
        if (function_exists('exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $command = "php " . FCPATH . "index.php razorpay processPaymentSplitsEndpoint " . escapeshellarg($order_id) . " > /dev/null 2>&1 &";
            @exec($command);
            return;
        }
        
        // Option 2: Use cURL to call internal API endpoint
        // $this->callAsyncEndpoint($order_id);
    }
    
    /**
     * Call async endpoint using cURL with timeout (for CI3)
     */
    private function callAsyncEndpoint($order_id)
    {
        $url = base_url('razorpay/processPaymentSplitsEndpoint');
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('order_id' => $order_id)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 500); // Very short timeout
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For local development
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // For local development
        @curl_exec($ch);
        curl_close($ch);
    }
    
    /**
     * Endpoint to process payment splits (called asynchronously)
     * This method does the heavy lifting
     * Can be called via HTTP or CLI
     */
     
    public function processPaymentSplitsEndpoint($order_id)
    {
        // Increase execution time for background process
        @set_time_limit(300);
        @ini_set('max_execution_time', 300);
        
        // Get order_id from POST or CLI argument
        if (empty($order_id)) {
            $order_id = $this->input->post('order_id');
        }
        
        if (empty($order_id)) {
            log_message('error', 'Payment split processing: Order ID missing');
            echo json_encode(array('status' => 'error', 'message' => 'Order ID missing'));
            return;
        }
        
        try {
            $this->processPaymentSplits($order_id);
            log_message('info', 'Payment splits processed successfully for order: ' . $order_id);
            echo json_encode(array('status' => 'success'));
        } catch (Exception $e) {
            log_message('error', 'Payment split processing failed for order ' . $order_id . ': ' . $e->getMessage());
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
   
    /**
     * Log payment split errors
     */
    private function logPaymentSplitError($order_id, $split_type, $error_message)
    {
        $error_data = array(
            'order_id' => $order_id,
            'split_type' => $split_type,
            'error_message' => $error_message,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('payment_split_errors', $error_data);
        
        // Also log to CodeIgniter's log file
        log_message('error', "Payment split error for order {$order_id}, type {$split_type}: {$error_message}");
    }
           
    /**
     * Core payment split processing logic
     */
    private function processPaymentSplits($order_id)
    {
        
        $payment = $this->db->get_where('payment_split', array('payment_id' => $order_id))->row();
        
        if (!$payment) {
        
            $webhook_calls_cin = $this->db->get_where('webhook_calls_cin', array('payment_id' => $order_id))->row();
            
            if (!$webhook_calls_cin) {
                $this->logPaymentSplitError($order_id, null, 'Webhook data not found for order');
                throw new Exception('Webhook data not found for order: ' . $order_id);
            }
            
            // Initialize transfer IDs array
            $transfer_ids = array();
            
            // Process CRM payment
            if (!empty($webhook_calls_cin->crm_fix) && !empty($webhook_calls_cin->crm_account_id)) {
                try {
                    $crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id, 
                                            $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
                    if ($crm_pay) {
                        $transfer_ids['crm'] = $crm_pay['tranfer_id'];
                    } else {
                        $this->logPaymentSplitError($order_id, 'CRM', 'Failed to process CRM payment');
                    }
                } catch (Exception $e) {
                    $this->logPaymentSplitError($order_id, 'CRM', 'Exception: ' . $e->getMessage());
                }
            }
            
            
            // Process IT Fix
            $it_acc = $this->db->get_where('gst_account_marrs', array('id' => '9'))->row();
            
            if (!empty($webhook_calls_cin->it_fix) && $webhook_calls_cin->it_fix > 0 ) {
                try {
                    $it_pay = $this->fetch($order_id, $it_acc->rozarpay_id, 
                                            $webhook_calls_cin->it_fix * 100, $it_acc->account_name);
                    if ($it_pay) {
                        $transfer_ids['it'] = $it_pay['tranfer_id'];
                    } else {
                        $this->logPaymentSplitError($order_id, 'IT', 'Failed to process IT payment');
                    }
                } catch (Exception $e) {
                    $this->logPaymentSplitError($order_id, 'IT', 'Exception: ' . $e->getMessage());
                }
            }
            
            // Process management payment
            if (!empty($webhook_calls_cin->management_amount) && !empty($webhook_calls_cin->marrsmanage_rozarpay_id)) {
                try {
                    $management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id, 
                                                          $webhook_calls_cin->management_amount  * 100, 
                                                          $webhook_calls_cin->marrsmanage_razorpay_name);
                    if ($management_amount_pay) {
                        $transfer_ids['management'] = $management_amount_pay['tranfer_id'];
                    } else {
                        $this->logPaymentSplitError($order_id, 'Management', 'Failed to process management payment');
                    }
                } catch (Exception $e) {
                    $this->logPaymentSplitError($order_id, 'Management', 'Exception: ' . $e->getMessage());
                }
            }
            
            // Process GST payment
            if (!empty($webhook_calls_cin->marrs_gst)) {
                try {
                    $gst = $this->db->get_where('gst_account_marrs', array('id' => '1'))->row();
                    if ($gst) {
                        $gst_pay_marrs = $this->fetch($order_id, $gst->rozarpay_id, 
                                                       $webhook_calls_cin->marrs_gst * 100, $gst->account_name);
                        if ($gst_pay_marrs) {
                            $transfer_ids['gst'] = $gst_pay_marrs['tranfer_id'];
                        } else {
                            $this->logPaymentSplitError($order_id, 'GST', 'Failed to process GST payment');
                        }
                    } else {
                        $this->logPaymentSplitError($order_id, 'GST', 'GST account not found');
                    }
                } catch (Exception $e) {
                    $this->logPaymentSplitError($order_id, 'GST', 'Exception: ' . $e->getMessage());
                }
            }
            
            
            // Process franchise payment
            $total_franchise = ['tranfer_id' => null];
            $total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst + $webhook_calls_cin->school_amount;
            $franchise_pay = ['tranfer_id' => null];
            // if ($total_franchise > 0 && !empty($total_franchise)) {
                $franchise_pay = $this->fetch($order_id, $webhook_calls_cin->franchise_account_id, $total_franchise * 100, $webhook_calls_cin->franchise_razorpay_name);
            // }
            
            // Process associate payment (if applicable)
            $associate_pay = ['tranfer_id' => null];
            
            if ($webhook_calls_cin->associate_amount > 0 && !empty($webhook_calls_cin->associate_amount)) {
                $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
                $associate_pay = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
            }
            
    
            // Process Aviansys payment
            $aviansys_pay = ['tranfer_id' => null];
            $total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
            $aviansys_pay = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id,  $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
            
            
            // Process maker payments
            $makers_split = $this->db->get_where('makers_splits', 
                                                  array('order_id' => $order_id))->result();
            
            $maker_transfer_ids = array();
            $total_maker_amount = 0;
            $maker_ids = array();
            
            if (!empty($makers_split)) {
                foreach($makers_split as $makers){
                    try {
                        $maker = $this->db->get_where('material_maker', 
                                                       array('material_maker_id' => $makers->maker_id))->row();
                        if(!empty($maker) && $makers->price > 0){
                            $maker_pay = $this->fetch($order_id, $maker->razorpay_id, 
                                                       $makers->price * 100, $maker->account_name);
                            if($maker_pay){
                                $this->db->where('id', $makers->id);
                                $this->db->update('makers_splits', array('transaction_id' => $maker_pay['tranfer_id']));
                                $maker_transfer_ids[] = $maker_pay['tranfer_id'];
                                $total_maker_amount += $makers->price;
                                $maker_ids[] = $makers->maker_id;
                            } else {
                                $this->logPaymentSplitError($order_id, 'Maker-'.$makers->maker_id, 'Failed to process maker payment');
                            }
                        } else {
                            $this->logPaymentSplitError($order_id, 'Maker-'.$makers->maker_id, 'Maker not found or price is zero');
                        }
                    } catch (Exception $e) {
                        $this->logPaymentSplitError($order_id, 'Maker-'.$makers->maker_id, 'Exception: ' . $e->getMessage());
                    }
                }
            }
            
            // Prepare payment split data according to table structure
            $payment_split_data = array(
                'cin' => $webhook_calls_cin->cin ?? '',
                'clevel' => $webhook_calls_cin->clevel ?? '',
                'total_amount' => $webhook_calls_cin->total_amount ?? 0,
                'franchise_amount' => $webhook_calls_cin->franchise_amount ?? 0,
                'franchise_tranfer_id' => $franchise_pay['tranfer_id'], // No transfer for franchise
                'franchise_id' => $webhook_calls_cin->franchise_id ?? '',
                'payment_id' => $order_id,
                'aviansys_amount' => $webhook_calls_cin->aviansys_amount ?? 0,
                'gst_amount' => $webhook_calls_cin->marrs_gst ?? 0,
                'comp_id' => $webhook_calls_cin->comp_id ?? '',
                'aviansys_tranfer_id' => $aviansys_pay['tranfer_id'],
                'gst_tranfer_id' => $transfer_ids['gst'] ?? '',
                'razpay_service' => $webhook_calls_cin->razpay_service ?? 0,
                'crm_fix' => $webhook_calls_cin->crm_fix ?? 0,
                'crm_fix_tranfer_id' => $transfer_ids['crm'] ?? '',
                
                'it_fix' => $webhook_calls_cin->it_fix ?? 0,
                'it_fix_tranfer_id' => $transfer_ids['it'] ?? '',
                
                'MaRRS_bal' => $webhook_calls_cin->MaRRS_bal ?? 0,
                'date_of_payment' => date('Y-m-d H:i:s'),
                'management_amount' => $webhook_calls_cin->management_amount ?? 0,
                'management_tranfer_id' => $transfer_ids['management'] ?? '',
                'franchise_gst' => $webhook_calls_cin->franchise_gst ?? 0,
                'aviansys_gst' => $webhook_calls_cin->aviansys_gst ?? 0,
                'status' => '1',
                'maker_id' => !empty($maker_ids) ? implode(',', $maker_ids) : '',
                'total_maker_amount' => $total_maker_amount ?? 0,
                'maker_transfer_id' => !empty($maker_transfer_ids) ? implode(',', $maker_transfer_ids) : '',
                'associate_gst' => $webhook_calls_cin->associate_gst ?? 0,
                'associate_tranfer_id' => $associate_pay['tranfer_id'], // No transfer for associate
                'associate_amount' => $webhook_calls_cin->associate_amount ?? 0,
                'associate_id' => $webhook_calls_cin->associate_id ?? ''
            );
            
            
            // Insert payment split record
            $paym = $this->db->get_where('payment_split', array('payment_id' => $order_id))->row();
            if(!$paym){
                $this->db->insert('payment_split', $payment_split_data);
            }
            
            // Process cart items based on maker split title
            // $this->processCartItems($webhook_calls_cin, $makers_split);
            
            // Update webhook status
            $this->db->where('payment_id', $webhook_calls_cin->payment_id);
            $this->db->where('cin', $webhook_calls_cin->cin);
            $this->db->update('webhook_calls_cin', array(
                'status' => 1, 
                'date_of_payment' => date('Y-m-d H:i:s')
            ));
            
            // Clear amount cart
            $this->db->where('cin', $webhook_calls_cin->cin);
            $this->db->where('payment_id', $webhook_calls_cin->payment_id);
            $this->db->delete('amount_cart');
        }else{
            
            $this->logPaymentSplitError($order_id, $payment->id, 'Payment split alredy found for this order');
            throw new Exception('Payment split alredy found for this order: ' . $order_id);
        
        }
    }
    
    /**
     * Process cart items based on product type
     */
    private function processCartItems_backup($webhook_calls_cin, $makers_split)
    {
        // Get competition details
        $competition = $this->db->get_where('competition_product_state', 
                                             array('id' => $webhook_calls_cin->comp_id))->row();
        
        if (!$competition) {
            return;
        }
        
        $data = $this->session->userdata('payment_data');
        $total_amount = $data['amount']/100;
        $comp_id = $competition->id;
        
        // Map of titles to cart fields
        $cart_mappings = array(
            'amount'     => $total_amount ?? 0,
            'comp_id'    => $comp_id,
            'Competition'=> array('status' => 'Paid'),
            'Material A' => array('study_material_a' => 'Yes', 'study_material' => 'Yes'),
            'Material B' => array('study_material_b' => 'Yes'),
            'Material C' => array('study_material_c' => 'Yes'),
            'Material D' => array('study_material_d' => 'Yes'),
            'Material E' => array('study_material_e' => 'Yes'),
            'Material F' => array('study_material_f' => 'Yes'),
            'MockTest A' => array('mock_test_a' => 'Yes', 'mock_test' => 'Yes'),
            'MockTest B' => array('mock_test_b' => 'Yes'),
            'MockTest C' => array('mock_test_c' => 'Yes'),
            'MockTest D' => array('mock_test_d' => 'Yes'),
            'MockTest E' => array('mock_test_e' => 'Yes'),
            'MockTest F' => array('mock_test_f' => 'Yes'),
            'Orientation A' => array('orientation_a' => 'Yes'),
            'Orientation B' => array('orientation_b' => 'Yes'),
            'Orientation C' => array('orientation_c' => 'Yes'),
            'Orientation D' => array('orientation_d' => 'Yes'),
            'Orientation E' => array('orientation_e' => 'Yes'),
            'Orientation F' => array('orientation_f' => 'Yes')
        );
        
        // Process cart items for each makers_split item
        if (!empty($makers_split)) {
            foreach($makers_split as $maker_item) {
                if (isset($cart_mappings[$maker_item->title])) {
                    $cart_data = $cart_mappings[$maker_item->title];
                    $cart_data['cin'] = $webhook_calls_cin->cin;
                    $cart_data['razorpay_payment_id'] = $webhook_calls_cin->payment_id;
                    $cart_data['product_name'] = $webhook_calls_cin->product_name;
                    $cart_data['clevel'] = $competition->clevel;
                    $cart_data['period_id'] = $competition->period_id;
                    
                    // Set amount based on product type
                    // if (strpos($maker_item->title, 'Orientation') === false) {
                    //     // Get the price from the maker split
                    //     $cart_data['amount'] = $maker_item->price;
                    // } else {
                    //     $cart_data['amount'] = 0;
                    // }
                    
                    // Check if item already exists
                    $check_conditions = array(
                        'cin' => $webhook_calls_cin->cin,
                        'clevel' => $competition->clevel,
                        'period_id' => $competition->period_id,
                        'product_name' => $webhook_calls_cin->product_name
                    );
                    
                    // Add specific field check based on product type
                    foreach ($cart_mappings[$maker_item->title] as $key => $value) {
                        if ($key !== 'status') {
                            $check_conditions[$key] = $value;
                        }
                    }
                    
                    // $existing = $this->db->get_where('new_cart', $check_conditions)->row();
                    
                    // if (!$existing) {
                        $this->db->insert('new_cart', $cart_data);
                    // }
                }
            }
        }
        
    }
    
    
    private function processCartItems($webhook_calls_cin, $makers_split)
    {
        
        $competition = $this->db
            ->get_where('competition_product_state', ['id' => $webhook_calls_cin->comp_id])
            ->row();
    
        if (!$competition) {
            return;
        }
    
        $data = $this->session->userdata('payment_data');
    
        $total_amount = isset($data['amount']) ? ($data['amount'] / 100) : 0;
        $comp_id = $competition->id;
    
        $normalize = function($str) {
            return strtolower(trim(preg_replace('/\s+/', ' ', $str)));
        };
    
        $cart_mappings = [
            'competition' => ['status' => 'Paid'],
    
            'material a' => ['study_material_a' => 'Yes', 'study_material' => 'Yes'],
            'material b' => ['study_material_b' => 'Yes'],
            'material c' => ['study_material_c' => 'Yes'],
            'material d' => ['study_material_d' => 'Yes'],
            'material e' => ['study_material_e' => 'Yes'],
            'material f' => ['study_material_f' => 'Yes'],
    
            'mocktest a' => ['mock_test_a' => 'Yes', 'mock_test' => 'Yes'],
            'mocktest b' => ['mock_test_b' => 'Yes'],
            'mocktest c' => ['mock_test_c' => 'Yes'],
            'mocktest d' => ['mock_test_d' => 'Yes'],
            'mocktest e' => ['mock_test_e' => 'Yes'],
            'mocktest f' => ['mock_test_f' => 'Yes'],
    
            'orientation a' => ['orientation_a' => 'Yes'],
            'orientation b' => ['orientation_b' => 'Yes'],
            'orientation c' => ['orientation_c' => 'Yes'],
            'orientation d' => ['orientation_d' => 'Yes'],
            'orientation e' => ['orientation_e' => 'Yes'],
            'orientation f' => ['orientation_f' => 'Yes'],
        ];
   
        //print_r($makers_split->cin);die;
            $comp_title=$this->db->get_where('amount_cart',array('cin'=>$makers_split->cin))->row()->title;
   
        if (!empty($makers_split)) {
    
            foreach ($makers_split as $maker_item) {
    
                $title = $normalize($maker_item->title);
    
                if (!isset($cart_mappings[$title])) {
                    continue;
                }
    
                $cart_data = $cart_mappings[$title];
    
                // ✅ Common fields
                $cart_data['cin'] = $webhook_calls_cin->cin;
                $cart_data['razorpay_payment_id'] = $webhook_calls_cin->payment_id;
                $cart_data['product_name'] = $webhook_calls_cin->product_name;
                $cart_data['clevel'] = $competition->clevel;
                $cart_data['period_id'] = $competition->period_id;
                $cart_data['comp_id'] = $comp_id;
    
                // ✅ Assign amount (if exists in split)
                 $cart_data['amount'] = isset($maker_item->price) ? $maker_item->price : 0;
    
                $cart_items = $this->db->get_where('amount_cart', ['cin' => $webhook_calls_cin->cin])->result();
                    
                    $titles = array_map(function($row) {
                        return strtolower(trim($row->title));
                    }, $cart_items);
                    
                    // Base conditions (for duplicate check)
                    $check_conditions = [
                        'cin'          => $webhook_calls_cin->cin,
                        'product_name' => $webhook_calls_cin->product_name,
                        'clevel'       => $competition->clevel,
                        'period_id'    => $competition->period_id,
                    ];
                    
                    // Title -> extra flags mapping
                    $title_flag_mappings = [
                        'competition' => [
                            'status' => 'Paid',
                        ],
                        'learning material a training a' => [
                            'study_material_a' => 'Yes',
                            'orientation_a'     => 'Yes',
                        ],
                        'learning material b training b' => [
                            'study_material_b' => 'Yes',
                            'orientation_b'     => 'Yes',
                        ],
                        'learning material c training c' => [
                            'study_material_c' => 'Yes',
                            'orientation_c'     => 'Yes',
                        ],
                        'mocktest a' => [
                            'mock_test_a' => 'Yes',
                        ],
                        'mocktest b' => [
                            'mock_test_b' => 'Yes',
                        ],
                    ];
                    
                    // Flags collect karo — check_conditions ke liye AND insert data ke liye
                    $extra_flags = [];
                    foreach ($titles as $title) {
                        if (isset($title_flag_mappings[$title])) {
                            foreach ($title_flag_mappings[$title] as $key => $value) {
                                $extra_flags[$key] = $value;
                            }
                        }
                    }
                    
                    // Duplicate-check conditions mein flags merge karo
                    $check_conditions = array_merge($check_conditions, $extra_flags);
                    
                    // ✅ Ab $cart_data banao — insert ke liye
                    $cart_data = array_merge([
                        'cin'                 => $webhook_calls_cin->cin,
                        'product_name'        => $webhook_calls_cin->product_name,
                        'clevel'               => $competition->clevel,
                        'period_id'            => $competition->period_id,
                        'razorpay_payment_id' => $webhook_calls_cin->payment_id,
                        'comp_id'              => $comp_id,
                    ], $extra_flags);
                    
                    $existing = $this->db->get_where('new_cart', $check_conditions)->row();
                        
                    if (!$existing) {
                        $this->db->insert('new_cart', $cart_data);
                    }
            }
        }
    
        if (!empty($competition->combo_1)) {
    
            $combo_items = explode('+', $competition->combo_1);
    
            foreach ($combo_items as $combo_item) {
    
                $title = $normalize(str_replace('-', ' ', $combo_item)); 
                // Material-A → material a
    
                if (!isset($cart_mappings[$title])) {
                    continue;
                }
    
                $cart_data = $cart_mappings[$title];
    
                $cart_data['cin'] = $webhook_calls_cin->cin;
                $cart_data['razorpay_payment_id'] = $webhook_calls_cin->payment_id;
                $cart_data['product_name'] = $webhook_calls_cin->product_name;
                $cart_data['clevel'] = $competition->clevel;
                $cart_data['period_id'] = $competition->period_id;
                $cart_data['comp_id'] = $comp_id;
                $cart_data['amount'] = 0; // combo items handled separately
    
                $this->db->insert('new_cart', $cart_data);
            }
        }
    }
        	
    	
	public function verify2_()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		
		if ($success === true) {
		    
		 
    		$webhook_calls_cin = $this->db->get_where('webhook_calls_cin',array('payment_id'=>$order_id))->row();
        	            
            // 		print_r($webhook_calls_cin);die;
    		
    		$total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst;
    		$franchise_pay = $this->fetch($order_id,$webhook_calls_cin->franchise_account_id,$total_franchise * 100,$webhook_calls_cin->franchise_razorpay_name);
    		if($webhook_calls_cin->associate_amount > 0 or !empty($webhook_calls_cin->associate_amount)){
    		    $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
                $associate_pay = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
    		}                            
    		$crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id, $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
    		$total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
            $aviansys_pay = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id, $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
    		$management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id, $webhook_calls_cin->management_amount * 100, $webhook_calls_cin->marrsmanage_razorpay_name);
            $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
            $gst_account_id = $gst->rozarpay_id;
            $gst_razorpay_name = $gst->account_name;
            $gst_pay_marrs = $this->fetch($order_id, $gst_account_id, $webhook_calls_cin->marrs_gst * 100, $gst_razorpay_name);                   
    		$inst=[	
                'cin'=>$webhook_calls_cin->cin ?? '',
                'clevel'=>$webhook_calls_cin->clevel ?? '',
                'total_amount'=>$webhook_calls_cin->total_amount ?? '',
                'franchise_amount'=>$webhook_calls_cin->franchise_amount ?? '',
                'franchise_tranfer_id'=>$franchise_pay['tranfer_id'] ?? '',
                'franchise_id'=>$webhook_calls_cin->franchise_id ?? '',
                'payment_id'=>$webhook_calls_cin->payment_id ?? '',
                'aviansys_amount'=>$webhook_calls_cin->aviansys_amount ?? '',
                'gst_amount'=>$webhook_calls_cin->marrs_gst ?? '',
                'comp_id'=>$webhook_calls_cin->comp_id ?? '',
                'aviansys_tranfer_id'=>$aviansys_pay['tranfer_id'] ?? '',
                'gst_tranfer_id'=>$gst_pay_marrs['tranfer_id'] ?? '',
                'razpay_service'=>$webhook_calls_cin->razpay_service ?? '',
                'crm_fix'=>$webhook_calls_cin->crm_fix ?? '',
                'crm_fix_tranfer_id'=>$crm_pay['tranfer_id'] ?? '',
                'MaRRS_bal'=>$webhook_calls_cin->MaRRS_bal ?? '',
                'date_of_payment'=>date('Y-m-d h:s:i'),
                'management_amount'=>$webhook_calls_cin->management_amount ?? '',
                'management_tranfer_id'=>$management_amount_pay['tranfer_id'] ?? '',
                'franchise_gst'=>$webhook_calls_cin->franchise_gst ?? '',
                'aviansys_gst'=>$webhook_calls_cin->aviansys_gst ?? '',
                'status'=>'1',
                'maker_id'=>$maker->material_maker_id ?? '',
                'total_maker_amount'=>$webhook_calls_cin->total_maker_amount ?? '',
                'maker_transfer_id'=>$maker_pay['tranfer_id'] ?? '',
                'associate_gst'=>$webhook_calls_cin->associate_gst ?? '',
                'associate_tranfer_id'=>$associate_pay['tranfer_id'] ?? '',
                'associate_amount'=>$webhook_calls_cin->associate_amount ?? '',
                'associate_id'=>$webhook_calls_cin->associate_id ?? ''
            ];
            
            $this->db->insert('payment_split',$inst);
            
    		$this->db->where('id',$makers_split->id);
            $this->db->update('makers_splits',['transaction_id' => $maker_pay['tranfer_id']]);
                                
                            $revenue_setting_id = $webhook_calls_cin->revenue_setting_id;
                            $revenue_setting = $this->db->get_where('revenue_setting',['id' => $revenue_setting_id])->row();
                                
                            if($makers_split->title == 'Competition'){
                                $ar=[
                                    'status'=>'Paid',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['status' => 'Paid' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material A'){
                                $ar=[
                                    'study_material_a'=>'Yes',
                                    'study_material'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_a' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material B'){
                                $ar=[
                                    'study_material_b'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_b' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material C'){
                                $ar=[
                                    'study_material_c'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_c' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material D'){
                                $ar=[
                                    'study_material_d'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_d' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material E'){
                                $ar=[
                                    'study_material_e'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_e' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Material F'){
                                $ar=[
                                    'study_material_f'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['study_material_f' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest A'){
                                $ar=[
                                    'mock_test_a'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_a' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest B'){
                                $ar=[
                                    'mock_test_b'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_b' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest C'){
                                $ar=[
                                    'mock_test_c'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_c' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest D'){
                                $ar=[
                                    'mock_test_d'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_d' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest E'){
                                $ar=[
                                    'mock_test_e'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price,
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_e' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'MockTest F'){
                                $ar=[
                                    'mock_test_f'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>$revenue_setting->product_price ?? '',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['mock_test_f' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation A'){
                                $ar=[
                                    'orientation_a'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_a' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation B'){
                                $ar=[
                                    'orientation_b'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_b' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation C'){
                                $ar=[
                                    'orientation_c'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_c' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation D'){
                                $ar=[
                                    'orientation_d'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_d' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation E'){
                                $ar=[
                                    'orientation_e'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_e' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                            if($makers_split->title == 'Orientation F'){
                                $ar=[
                                    'orientation_f'=>'Yes',
                                    'cin'=>$webhook_calls_cin->cin,
                                    'razorpay_payment_id'=>$webhook_calls_cin->payment_id,
                                    'product_name'=>$webhook_calls_cin->product_name,
                                    'amount'=>'',
                                    'clevel'=>$revenue_setting->clevel,
                                    'period_id'=>$revenue_setting->period_id
                                ];
                                $competition = $this->db->get_where('new_cart',['orientation_f' => 'Yes' , 'cin' => $webhook_calls_cin->cin,'clevel'=>$revenue_setting->clevel,'period_id'=>$revenue_setting->period_id])->row();
                                if(!$competition){
                                    $this->db->insert('new_cart',$ar);
                                }        
                            }
                            
                        
                        
                        $this->db->where('payment_id',$webhook_calls_cin->payment_id);
                         $this->db->where('cin',$webhook_calls_cin->cin);
                           $this->db->update('webhook_calls_cin',['status'=>1,'date_of_payment'=>date('Y-m-d h:s:i')]);
                          
                        
                        $this->db->where('cin',$webhook_calls_cin->cin);
                        $this->db->where('payment_id',$webhook_calls_cin->payment_id);
                        $this->db->delete('amount_cart');
                        
                    
		
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
			
            $this->db->select('revenue_setting_id');
	        $this->db->from('competition_product_state');
	        $this->db->where('id',$_SESSION['exam_id']);
	        $query=$this->db->get();
	        $competition=$query->row();
	        
	       // print_r($competition);die;
	        
	        if($competition){
	           // redirect(base_url().'razorpay/payment_success');
	            redirect(base_url().'razorpay/success2_test_test');
	           // redirect(base_url().'razorpay/success2_test'); 
	        }else{
			    redirect(base_url().'razorpay/success2'); 
	        }
			
		}
		else {
			redirect(base_url().'razorpay/paymentFailed2');
		}
	}
	
	
    public function processWebhookCartData($webhook_data)
    {
        // 🔥 convert to object safety (if array comes)
        if (is_array($webhook_data)) {
            $webhook_data = (object)$webhook_data;
        }
    
        // ✅ validation
        if (empty($webhook_data->cin) || empty($webhook_data->comp_id)) {
            echo "Missing CIN or COMP_ID";
            return;
        }
    
        // explode values
        $product_names = explode(',', $webhook_data->product_name);
        $comp_ids      = explode(',', $webhook_data->comp_id);
    
        $count = min(count($product_names), count($comp_ids));
    
        for ($i = 0; $i < $count; $i++) {
    
            $product_name = trim($product_names[$i]);
            $comp_id      = trim($comp_ids[$i]);
    
            // 🔍 fetch competition
            $competition = $this->db
                ->get_where('competition_product_state', ['id' => $comp_id])
                ->row();
    
            if (!$competition) {
                echo "❌ Competition not found: ".$comp_id."<br>";
                continue;
            }
    
            // ✅ prepare data
            $cart_data = [
                'status' => 'Paid',
                'cin' => $webhook_data->cin,
                'razorpay_payment_id' => $webhook_data->payment_id,
                'product_name' => $product_name,
                'clevel' => $competition->clevel,
                'period_id' => $competition->period_id,
                'comp_id' => $comp_id,
                'amount' => $webhook_data->total_amount / $count
            ];
    
            // 🔍 duplicate check
            $check_conditions = [
                'cin' => $webhook_data->cin,
                'product_name' => $product_name,
                'comp_id' => $comp_id
            ];
    
            $existing = $this->db->get_where('new_cart', $check_conditions)->row();
    
            if (!$existing) {
    
                $insert = $this->db->insert('new_cart', $cart_data);
    
                if (!$insert) {
                    echo "❌ DB Error:";
                    print_r($this->db->error());
                    die;
                } else {
                    echo "✅ Inserted: ".$product_name."<br>";
                }
    
            } else {
                echo "⚠️ Duplicate skipped: ".$product_name."<br>";
            }
        }
    }


	public function success2()
	{    
	    $data = $this->session->userdata('payment_data');
	    if(!empty($this->session->userdata('primaryColor'))){
	        $data['payment_data']= $this->session->userdata('payment_data');
	        $this->load->view('cin_login/success', $data);
	        
	    }else{
	        $primary = $this->session->userdata('primaryColor');
	        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$data['cin']))->row();
	       
	        $state_id=$paid_idd->state_id;
	        $period_id=$paid_idd->period_id;
	        $clevel=$data['clevel'];
	        $product_name=$data['product_name'];
	        
	       // $competition = $this->db->get_where('competition_product_state',array('franchise_id' =>$franchise_id,'state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	       // $competition = $this->db->get_where('competition_product_state',array('state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	        $this->db->select('*');
	        $this->db->from('competition_product_state');
	        $this->db->where('id',$_SESSION['exam_id']);
	        $query = $this->db->get();
	        $competition = $query->row();
	        
	       // print_r($competition);die;
	        $franchise_id = $competition->franchise_id;
	        
	        $comp_id = $competition->id;
	        
	    
	        
	        $franchise_per = $competition->com_per;
	        $aviansys_per = $competition->com_peravian;
	        $manage_per = $competition->manageper;
	        $franchise_split = $competition->franchise_split;
	        $aviansys_split = $competition->aviansys_split;
	        $franchise_gst = $competition->franchise_gst;
	        $aviansys_gst = $competition->aviansys_gst;
	        $crm_fix = $competition->crm_fix;
	        
	        $total_amount = $data['amount']/100;
	       // echo $crm_fix;die;
	         //print_r($franchise_split);die;
	        
	        
	        $Base_GR = $data['amount']/100;    // GR=>GST+Razorpay
	        $Base_G = round($Base_GR/1.03);   
	        $Base_cost = round($Base_G/1.18); 
	        
	        
	        
	       
	        if (!empty($crm_fix) && $crm_fix != 0 ) {
	            $this->db->select('*');
                $this->db->from('amount_cart');
                $this->db->where('cin',$data['cin']);
                $query = $this->db->get();
                $cart_items= $query->result();
                $crm_fix=$crm_fix*count($cart_items);
	            $Base_cost=$Base_cost-$crm_fix;
	        }
	        
	       // echo $crm_fix;die;
	        
	        $GST = round($Base_cost * 0.18);           // GST account money
	        
	        if($franchise_gst=='yes' || $franchise_gst=='Yes'){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	            
	          $GST_fr =round($GST*$franchise_per/100);
	          
	        }
	        if($aviansys_gst=='yes' || $aviansys_gst=='Yes'){
	          $GST_Av =round($GST*$aviansys_per/100);
	        }
	        
	        $total_GST= round($GST-$GST_fr-$GST_Av);
	        
	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);
	        $totalAviasys_pay=$Aviasys_pay+$GST_Av; // payment made to aviansys per user transaction
	        $Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
	        $totalFranchise_pay=$Franchise_pay+$GST_fr;
	        
	        //$Aviasys_pay = round($Base_cost * $aviansys_per/100);     // payment made to aviansys per user transaction
	        //$Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
	        $management_pay = round ($Base_cost * $manage_per/100);
	        $razpay_service = $Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
	       // $MaRRS_bal = $Base_cost-($Aviasys_pay + $Franchise_pay + $management_pay);      // balance to marrs account
	        $totalcut=0;
	       
	       //echo 'Total=>'.$Base_GR.' Base_cost=>'.$Base_cost.' GST_cost=>'.$GST.' Aviansys_15%_cost=>'.$Aviasys_pay.' Franchise_40%_cost=>'.$Franchise_pay.'avi-gst : '.$GST_Av.'fra-gst : '.$GST_fr;die;
	        //$gst_amt=$GST*100;
	         $gst_amt=$total_GST*100;
	        //die;
	        $insert_array=array();
	        $insert_array['franchise_id'] = $franchise_id;
            $insert_array['clevel'] = $data['clevel'];
            $insert_array['cin'] = $data['cin'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['comp_id'] =$comp_id;
            $insert_array['razpay_service'] =$razpay_service;
            
            $insert_array['franchise_gst'] =$GST_fr;
            $insert_array['aviansys_gst'] =$GST_Av;
            //echo $gst_amount;die;
            
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->where('cin',$data['cin']);
            $this->db->where('comp_id',$comp_id);
            $this->db->where('payment_id',$data['razorpay_order_id']);
            $this->db->where('gst_tranfer_id !=','');
            $this->db->where('status','1');
            $query=$this->db->get();
            $resultt = $query->row();
            
	        // ============== gst transfer ================== //
	        
	        if(empty($resultt)){
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
    	        $gst_account_id=$gst->rozarpay_id;
    	        $gst_razorpay_name=$gst->account_name;
    	        //echo $gst_account_id;die;
    	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$gst_amt,$gst_razorpay_name);
    	        //print_r($gst_pay);die;
    	        if(!empty($gst_pay['tranfer_id'])){
                $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
        	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
    	        }
	        } 
	        
	        
    	    // ====== end ===== //
    	    
	        // ============== CRM transfer ================== //
	        
	        if (!empty($crm_fix) && $crm_fix != 0 ) {
	            // echo $crm_fix;die;
                // ============== gst transfer ================== //
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
    	        $crm_account_id=$gst->rozarpay_id;
    	        $crm_razorpay_name=$gst->account_name;
    	        //echo $gst_account_id;die;
    	        $crm_pay=$this->fetch($data['razorpay_order_id'],$crm_account_id,$crm_fix*100,$crm_razorpay_name);
    	       // print_r($crm_pay);die;
    	        if(!empty($crm_pay['tranfer_id'])){
                    $insert_array['crm_fix'] = $crm_pay['tranfer_amount']/100;
            	    $insert_array['crm_fix_tranfer_id'] = $crm_pay['tranfer_id'];
    	        }
	        } 
	        
	        // ============== CRM transfer ================== //
	        
	        if (!empty($it_fix) && $it_fix != 0 ) {
	            // echo $crm_fix;die;
                // ============== gst transfer ================== //
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'9'))->row();
    	        $it_account_id=$gst->rozarpay_id;
    	        $it_razorpay_name=$gst->account_name;
    	        //echo $gst_account_id;die;
    	        $it_pay=$this->fetch($data['razorpay_order_id'],$it_account_id,$it_fix*100,$it_razorpay_name);
    	       // print_r($crm_pay);die;
    	        if(!empty($it_pay['tranfer_id'])){
                    $insert_array['it_fix'] = $it_pay['tranfer_amount']/100;
            	    $insert_array['it_fix_tranfer_id'] = $it_pay['tranfer_id'];
    	        }
	        } 
	        
	        // print_r($insert_array);
	        // die;
	       
	        // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultma = $query->row();
	        
	        
    	        if(empty($resultma)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$management_pay*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
            	    $totalcut=$totalcut+$management_pay;
        	        }
    	        }     
    	       
    	    // ====== end ===== //
	       // ============== franchise transfer ================== //
	        if($franchise_split=='yes'){
	            
	            $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	            $franchiseaccount_id=$franchise->account_id;
    	            $franchiseaccount_razorpay_name=$franchise->account_razorpay_name;
    	            $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$totalFranchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
        	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
        	        $insert_array['franchise_tranfer_id'] = $Franchisepay['tranfer_id'];
        	        $totalcut=$totalcut+$Franchise_pay;
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
	       
            // ============== aviansys transfer ================== //
	        if($aviansys_split=='yes'){
	            $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$totalAviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
    	                
        	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
            	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
            	        $totalcut=$totalcut+$Aviasys_pay;
    	            }
	            }
	        }
            // ====== end ===== //
            
            
    	    $insert_array['date_of_payment'] = date("Y-m-d");
    	    if(!empty($insert_array['aviansys_tranfer_id'])){
    	        $MaRRS_bal = $Base_cost-$totalcut;
    	        $insert_array['MaRRS_bal'] =$MaRRS_bal;
    	        $insert_array['status']=1;
                $this->db->insert('payment_split',$insert_array);
    	    }
            
            //print_r($insert_array).'--';exit;
	        // echo '<br>';
	        // print_r($data);exit; 
    		$cin=$data['cin'];
    	
    		$data['cin']=$data['cin'];
           
    	    //	$this->newmodel->cart_newstate($cin,$data,$statid->state_id); 
    		$this->newmodel->cart_new_add($data);
            // 		echo 'ok';
            // 		die;
    		$student=$this->newmodel->get_student_data_cin_($cin);
    		
    	    // ================== //	
            // 		$data['clevel'];
            // 		$cin;
        		
		    $this->db->select('*');
            $this->db->from('new_cart');
            $this->db->where('cin',$data['cin']);
            $this->db->where("clevel",$data['clevel']);
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $res= $query->result_array();
		
		    $this->db->where('cin',$cin);
		    $this->db->delete('amount_cart');
            // $this->db->delete('statewise_addtocart');    
		    $data['student']=$this->newmodel->get_student_data($cin);
	        //print_r($data);
	
	    }
	
	
        $this->load->view('cin_login/success', $data);
        //die;
	}
	
	
	public function success2_test()
	{   
	    $data = $this->session->userdata('payment_data');
	    
	        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$data['cin']))->row();
	       // print_r($data);die;
	       // print_r($_SESSION);die;
	       
	       // echo $this->db->last_query();die;
	       // $franchise_id=$paid_idd->franchise_id;
	       
	        $state_id=$paid_idd->state_id;
	        $period_id=$paid_idd->period_id;
	        $clevel=$data['clevel'];
	        $product_name=$data['product_name'];
	        
	       // $competition = $this->db->get_where('competition_product_state',array('franchise_id' =>$franchise_id,'state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	       // $competition = $this->db->get_where('competition_product_state',array('state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	        $this->db->select('*');
	        $this->db->from('competition_product_state');
	        $this->db->where('id',$_SESSION['exam_id']);
	        $query=$this->db->get();
	        $competition=$query->row();
	        
	       // print_r($competition);die;
	        $franchise_id=$competition->franchise_id;
	        
	        $comp_id=$competition->id;
	        
	        $insert_array=array();
	        $cart_data = $this->db->get_where('amount_cart',array('cin'=>$data['cin'],'comp_id'=>$comp_id))->result();
	      
	        $maker_push=array();
	        
	        foreach($cart_data as $item){  
	            
	            $maker_amount=0;
	            
	            if($item->title == 'Competition'){
	                
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Free',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    $ar=array('price'=>$price->study_material_free_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                
	                array_push($maker_push,$ar);
	                
	            }
	           
	           
	            if($item->title == 'Material A'){
	                
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'A',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    $ar=array('price'=>$price->study_material_a_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	                
	                
	            }
	            if($item->title == 'Material B'){
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'B',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    $ar=array('price'=>$price->study_material_b_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'Material C'){
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'C',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    $ar=array('price'=>$price->study_material_c_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'Material D'){
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'D',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	 
	                    $ar=array('price'=>$price->study_material_d_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'Material E'){
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'E',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    
	                    $ar=array('price'=>$price->study_material_e_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'Material F'){
	                $this->db->select('*');
                    $this->db->from('study_material');
                    
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Paid',
                        'type'=>'F',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    
	                    $ar=array('price'=>$price->study_material_f_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            
	            
	            if($item->title == 'MockTest A'){
	                
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'A',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                   
	                    $ar=array('price'=>$price->mock_test_a_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'MockTest B'){
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'B',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    
	                    $ar=array('price'=>$price->mock_test_b_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'MockTest C'){
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'C',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                   
	                    $ar=array('price'=>$price->mock_test_c_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'MockTest D'){
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'D',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    
	                    $ar=array('price'=>$price->mock_test_d_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'MockTest E'){
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'E',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    
	                    $ar=array('price'=>$price->mock_test_e_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            if($item->title == 'MockTest F'){
	                $this->db->select('*');
                    $this->db->from('mock_papers');
                    
                    $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_mock.maker_id');
                    
                    $this->db->where(array(
                        'assigned_mock.period_id' => $competition->period_id,
                        'mock_papers.pay_status' => 'Paid',
                        'type'=>'F',
                        'class'=>$paid_idd->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>$competition->clevel
                    ));
                   
                    $this->db->order_by('mock_papers.paper_id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                 
	                    $ar=array('price'=>$price->mock_test_f_price_royalty,'maker_id'=>$maker_id,'title'=>$item->title);
	                }
	                
	                array_push($maker_push,$ar);
	            }
	            
	        }
	        
	        $revenue_setting = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	      
	       // print_r($maker_push);
	       //print_r($revenue_setting);
	        //die;
	       // print_r($insert_array).'--';exit;
	        
	        $franchise_per = $revenue_setting->com_per;
	        $aviansys_per = $revenue_setting->com_peravian;
	        $manage_per = $revenue_setting->manageper;
	        $franchise_split = $competition->franchise_split;
	        $aviansys_split = $competition->aviansys_split;
	        $franchise_gst = $competition->franchise_gst;
	        $aviansys_gst = $competition->aviansys_gst;
	        $crm_fix = $revenue_setting->crm_fix;
	        $it_fix = $revenue_setting->it_fix;
	        $associate_per = $revenue_setting->associate_per;
	        $associate_gst = $competition->associate_gst;
	        $associate_split = $competition->associate_split;
	        $associate_id = $competition->associate_id;
	        
	        
	        $total_amount=$data['amount']/100;
	       // echo $crm_fix;die;
	       //  print_r($revenue_setting);die;
	        
	        
	        $Base_GR=$data['amount']/100;    // GR=>GST+Razorpay
	        $Base_G=round($Base_GR/1.03);   
	        $Base_cost = round($Base_G/1.18);  // ACTUAL BASE COST  (excluding GST)
	        
	        if ($maker_amount > 0) {
                $Base_cost -= $maker_amount; // revised base cost - 1
            }
	        
	       
	        if (!empty($crm_fix) && $crm_fix != 0 ) {
	            $this->db->select('*');
                $this->db->from('amount_cart');
                $this->db->where('cin',$data['cin']);
                $query = $this->db->get();
                $cart_items= $query->result();
                $crm_fix=$crm_fix*count($cart_items);
                
	            $Base_cost = $Base_cost-$crm_fix;  // revised BASE COST - 2
	        }
	        
	        if (!empty($it_fix) && $it_fix != 0 ) {
	            $this->db->select('*');
                $this->db->from('amount_cart');
                $this->db->where('cin',$data['cin']);
                $query = $this->db->get();
                $cart_items= $query->result();
                $it_fix=$it_fix*count($cart_items);
                
	            $Base_cost = $Base_cost-$it_fix;  // revised BASE COST - 2
	        }
	        
	     //    echo $Base_cost.'   '.$franchise_per;die;
	        
	        
	        $GST = round($Base_cost * 0.18);           // GST account money calculated with revised base cost - 2
	        
	        if($franchise_gst=='yes' || $franchise_gst=='Yes'){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	          $GST_fr =round($GST * $franchise_per/100); 
	        }
	        
	        if($associate_gst == 'yes' || $associate_gst == 'Yes'){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	          $GST_As =round($GST * $associate_per/100);
	        }
	        
	        if($aviansys_gst == 'yes' || $aviansys_gst == 'Yes'){
	          $GST_Av =round($GST*$aviansys_per/100);
	        }
	        
	        //echo $GST_fr;die;
	        
	        
	        $total_GST= round($GST-$GST_fr-$GST_Av-$GST_As); // MaRRS GST is left out GST by paying franchise + aviansys + associate
	        
	       // echo $GST_Av;die;
	        
	        
	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);      // calculated with revised base cost - 2
	        $totalAviasys_pay=$Aviasys_pay + $GST_Av;                  // payment made to aviansys per user transaction to be displayed on aviansys dashboard which includes GST
	        
	        $Franchise_pay = round ($Base_cost * $franchise_per/100);  // payment made to franchise per user transaction
	        $totalFranchise_pay=$Franchise_pay + $GST_fr;               //  to be displayed on franchise dashboard which includes GST
	        
	        $Associate_pay = round ($Base_cost * $associate_per/100);  // payment made to franchise per user transaction
	        $totalAssociate_pay=$Associate_pay + $GST_As;              //  to be displayed on associate dashboard which includes GST
	        
	        
	        //$Aviasys_pay = round($Base_cost * $aviansys_per/100);     // payment made to aviansys per user transaction
	        //$Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
	        
	        
	        $management_pay = round ($Base_cost * $manage_per/100);      //  to be displayed on management dashboard (exclude gst)
	        $razpay_service = $Base_GR-$Base_G;                            // razorpay service charge for transaction is 3% aasumed   to be displayed on aviansys dashboard 
	        
	       // $MaRRS_bal = $Base_cost-($Aviasys_pay + $Franchise_pay + $management_pay);      // balance to marrs account
	       
	        $totalcut=0;
	       
	       //echo 'Total=>'.$Base_GR.' Base_cost=>'.$Base_cost.' GST_cost=>'.$GST.' Aviansys_15%_cost=>'.$Aviasys_pay.' Franchise_40%_cost=>'.$Franchise_pay.'avi-gst : '.$GST_Av.'fra-gst : '.$GST_fr;die;
	        
	        
	        //$gst_amt=$GST*100;
	       // echo $management_pay;
	        
	        $gst_amt = $total_GST * 100;    // Left MaRRS GST (excude aviansys, franchise, associate) display on dashboard
	       // echo $gst_amt; 
	       // die;
	        
	        $insert_array['franchise_id'] = $franchise_id;
            $insert_array['clevel'] = $data['clevel'];
            $insert_array['cin'] = $data['cin'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['comp_id'] = $comp_id;
            $insert_array['razpay_service'] = $razpay_service;
            
            $insert_array['franchise_gst'] = $GST_fr;
            $insert_array['aviansys_gst'] = $GST_Av;
            $insert_array['associate_gst'] = $GST_As;
            
            
            // echo $gst_amt;die;
            
            
            
            foreach($maker_push as $row){
            
                $maker = $this->db->get_where('material_maker',array('material_maker_id' =>$row['maker_id']))->row();
    	        $maker_account_id=$maker->razorpay_id;
    	        $maker_razorpay_name=$maker->account_name;
    	        
    	        
    	        
    	        if(!empty($maker)){
                    
                    $maker_pay=$this->fetch($data['razorpay_order_id'],$maker_account_id,$row['price']*100,$maker_razorpay_name);
    	        }
    	        
    	        if(!empty($maker_pay['tranfer_id'])){
            	    $ar = array(
                        'maker_id'            => $row['maker_id'],
                        'price'               => $row['price'],
                        'title'               => $row['title'],
                        'transaction_id'      => $maker_pay['tranfer_id'],
                        'order_id'            => $data['razorpay_order_id'],
                        'comp_id'             => $competition->id,
                        'revenue_setting_id'  => $competition->revenue_setting_id,
                    );
                    
                    $totalcut=$totalcut+$row['price'];
                    
                    $this->db->insert('makers_splits', $ar);
    	        }
            }
            
            
        
            // ============== crm transfer ================== //
            
             if (!empty($crm_fix) && $crm_fix != 0 ) {
	           // echo $crm_fix;die;
            
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
    	        $crm_account_id=$gst->rozarpay_id;
    	        $crm_razorpay_name=$gst->account_name;
    	        //echo $gst_account_id;die;
    	        $crm_pay=$this->fetch($data['razorpay_order_id'],$crm_account_id,$crm_fix*100,$crm_razorpay_name);
    	       // print_r($crm_pay);die;
    	        if(!empty($crm_pay['tranfer_id'])){
                    $insert_array['crm_fix'] = $crm_pay['tranfer_amount']/100;
            	    $insert_array['crm_fix_tranfer_id'] = $crm_pay['tranfer_id'];
    	        }
	        } 
	        
	        
	        // ============== crm transfer ================== //
            
             if (!empty($it_fix) && $it_fix != 0 ) {
	           // echo $crm_fix;die;
            
    	        $it_acc = $this->db->get_where('gst_account_marrs',array('id' =>'9'))->row();
    	        $crm_account_id=$it_acc->rozarpay_id;
    	        $crm_razorpay_name=$it_acc->account_name;
    	        //echo $gst_account_id;die;
    	        $it_pay=$this->fetch($data['razorpay_order_id'],$crm_account_id,$it_fix*100,$crm_razorpay_name);
    	       // print_r($crm_pay);die;
    	        if(!empty($crm_pay['tranfer_id'])){
                    $insert_array['it_fix'] = $it_pay['tranfer_amount']/100;
            	    $insert_array['it_fix_tranfer_id'] = $it_pay['tranfer_id'];
    	        }
	        } 
	      
            
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->where('cin',$data['cin']);
            $this->db->where('comp_id',$comp_id);
            $this->db->where('payment_id',$data['razorpay_order_id']);
            $this->db->where('gst_tranfer_id !=','');
            $this->db->where('status','1');
            $query=$this->db->get();
            $resultt = $query->row();
	        
	       
	        if(empty($resultt)){
            // ============== gst transfer ================== //
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
    	        $gst_account_id=$gst->rozarpay_id;
    	        $gst_razorpay_name=$gst->account_name;
    	        //echo $gst_account_id;die;
    	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$gst_amt,$gst_razorpay_name);
    	        //print_r($gst_pay);die;
    	        if(!empty($gst_pay['tranfer_id'])){
                $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
        	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
    	        }
	        } 
	        
	        
    	    // ====== end ===== //
    	 
    	     
    	    
    	    // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultma = $query->row();
	        
	        
    	        if(empty($resultma)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$management_pay*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
            	    $totalcut=$totalcut+$management_pay;
        	        }
    	        }     
    	       
    	    // ====== end ===== //
    	    
    	   
    	    // ============== associate transfer ================== //
	        if($associate_split=='yes' && $associate_id){
	            
	            $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('associate_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultass = $query->row();
            
                if(empty($resultass)){
    	            $associate = $this->db->get_where('associate_bank_details',array('associate_id' =>$associate_id))->row();
    	            $franchiseaccount_id=$associate->razorpay_id;
    	            $franchiseaccount_razorpay_name=$associate->account_razorpay_name;
        	        $Associate_pay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$totalAssociate_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Associate_pay['tranfer_id'])){
            	        $insert_array['associate_amount'] = $Associate_pay['tranfer_amount']/100;
            	        $insert_array['associate_tranfer_id'] = $Associate_pay['tranfer_id'];
            	        $totalcut=$totalcut+$Associate_pay;
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
    	       
    	    
	       // ============== franchise transfer ================== //
	        if($franchise_split=='yes'){
	            
	            $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	            $franchiseaccount_id=$franchise->account_id;
    	            $franchiseaccount_razorpay_name=$franchise->account_razorpay_name;
    	            $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$totalFranchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
        	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
        	        $insert_array['franchise_tranfer_id'] = $Franchisepay['tranfer_id'];
        	        $totalcut=$totalcut+$Franchise_pay;
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
	       
	       
    	    
            // ============== aviansys transfer ================== //
	        if($aviansys_split=='yes'){
	            $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$totalAviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
    	                
        	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
            	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
            	        $totalcut=$totalcut+$Aviasys_pay;
    	            }
	            }
	        }
            // ====== end ===== //
             
    	    
            
    	        $insert_array['date_of_payment'] = date("Y-m-d");
    	    
    	    
    	        $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $res = $query->row();
            
            
            // echo '<pre>';
            // print_r($insert_array);die;
            
    	    if(empty($res)){
    	        
    	        $MaRRS_bal = $Base_cost-$totalcut;  // MaRRS balance going to coral ventures (MaRRS_left) displayed on dashboard
    	        $insert_array['MaRRS_bal'] =$MaRRS_bal;
    	        $insert_array['status']=1;
    	        
    	       // print_r($insert_array).'--';die;
    	        
                $this->db->insert('payment_split',$insert_array);
    	    }
            
          
        // echo '<br>';
        // print_r($data);die; 
	        
		$cin=$data['cin'];
	
		$data['cin']=$data['cin'];
       
	//	$this->newmodel->cart_newstate($cin,$data,$statid->state_id); 
		$this->newmodel->cart_new_add($data);
// 		echo 'ok';
// 		die;
		$student=$this->newmodel->get_student_data_cin_($cin);
		
	// ================== //	
// 		$data['clevel'];
// 		$cin;
		
		$this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('cin',$data['cin']);
         $this->db->where("clevel",$data['clevel']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
		
		$this->db->where('cin',$cin);
		$this->db->delete('amount_cart');
        // $this->db->delete('statewise_addtocart');    
		$data['student']=$this->newmodel->get_student_data($cin);
	//print_r($data);
	
	
	
	
        $this->load->view('cin_login/success', $data);
        //die;
	}
	
	
	public function payment_success()
	{
	    
	    $cin = $_SESSION['cin'];
	        $data = $this->session->userdata('payment_data');
	    
	        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$cin))->row();
	        
	        $data['student']=$this->newmodel->get_student_data($cin);
	
	        $this->db->where('cin',$cin);
    		$this->db->delete('amount_cart');
    		        
        $this->load->view('cin_login/success', $data);
	} 
	
	
	public function success2_test_test()
	{   
	    $comp_id = $this->session->userdata('exam_idm');
        $cin = $this->session->userdata('cinm');
        
	    $data = $this->session->userdata('payment_data');
	    
	    $paid_idd = $this->db->get_where('cin_list',array('cin' => $data['cin'] ))->row();
	    
        // echo '<pre>';
        // print_r($data);die;
	       
	       
	        $total_amount = $data['amount']/100;
	       // print_r($_SESSION);die;
	       
	        $state_id = $paid_idd->state_id;
	        $period_id = $paid_idd->period_id;
	        $clevel = $data['clevel'];
	        $product_name = $data['product_name'];
	       
	        $this->db->select('*');
	        $this->db->from('competition_product_state');
	        $this->db->where('id',$comp_id);
	        $query = $this->db->get();
	        $competition = $query->row();
	        
	       // print_r($competition);die;
	        
	        $franchise_id = $competition->franchise_id;
	        $comp_id = $competition->id;
	        
	        $insert_array = array();
	        $cart_data = $this->db->get_where('amount_cart',array('cin'=>$data['cin'],'comp_id'=>$comp_id))->result();
	        
	       // echo '<pre>';
	       // print_r($cart_data);die;
	      
	        if($cart_data){
    	       // $razpay_service=0;
    	       // $franchise_gst=0;
                //     $aviansys_gst=0;
                //     $marrs_gst=0;
                //     $franchise_pay=0;
                //     $associate_pay=0;
                //     $aviasys_pay=0;
                //     $MaRRS_Bal=0;
                //     $associate_gst=0;
                //     $crm=0;
                //     $management_pay=0;
                //     $marrs_gst=0;
                
    	       // $maker_push=array();
    	        
    	       // foreach($cart_data as $item){
    	       //     echo '<pre>';
    	       //     print_r($item);die;
    	            
    	       //     $razpay_service = $razpay_service+$item->razpay_service;
    	       //     $marrs_gst = $marrs_gst+$item->marrs_gst;
    	       //     $franchise_gst = $franchise_gst+$item->franchise_gst;
    	       //     $aviansys_gst = $aviansys_gst+$item->aviansys_gst;
    	            
    	       //     $franchise_pay = $franchise_pay + $item->franchise_pay;
            //         $associate_pay = $associate_pay + $item->associate_pay;
            //         $associate_gst = $associate_gst + $item->associate_gst;
            //         $aviasys_pay = $aviasys_pay + $item->aviasys_pay;
            //         $MaRRS_Bal = $MaRRS_Bal + $item->MaRRS_Bal;
            //         $crm = $crm + $item->crm_fix;
            //         $management_pay = $management_pay + $item->management_pay;
            //         $marrs_gst = $marrs_gst + $item->marrs_gst;
    	       // }
    	        
    	       // $insert_array=[
        	   //     'cin'=>$data['cin'],
        	   //     'clevel'=>$competition->clevel,
        	   //     'product_name'=>$competition->product_name,
        	   //     'name'=>$paid_idd->student_name,
        	   //     'class'=>$paid_idd->class,
        	   //     'total_amount'=>$total_amount,
        	   //     'payment_id'=>$data['razorpay_order_id'],
        	   //     'franchise_id'=>$franchise_id,
        	   //     'franchise_amount'=>$franchise_pay-$franchise_gst,
        	   //     'franchise_gst'=>$franchise_gst,
        	   //     'franchise_account_id'=>$cart_data[0]->franchise_account_id,
        	   //     'franchise_razorpay_name'=>$cart_data[0]->franchise_razorpay_name,
        	   //     'associate_id'=>$associate_id,
        	   //     'associate_account_id'=>$cart_data[0]->associate_account_id,
        	   //     'associate_razorpay_name'=>$cart_data[0]->associate_razorpay_name,
        	   //     'associate_gst'=>$associate_gst,
        	   //     'associate_amount'=>$associate_pay-$associate_gst,
        	   //     'crm_account_id'=>$cart_data[0]->crm_account_id,
        	   //     'crm_razorpay_name'=>$cart_data[0]->crm_razorpay_name,
        	   //     'crm_fix'=>$crm,
        	   //     'maker_razorpay_name'=>'',
        	   //     'maker_razorpay_id'=>'',
        	   //     'razpay_service'=>$razpay_service,
        	   //     'total_maker_amount'=>'',
        	   //     'aviansys_account_id'=>$cart_data[0]->aviansys_account_id,
        	   //     'aviansys_razorpay_name'=>$cart_data[0]->aviansys_razorpay_name,
        	   //     'aviansys_amount'=>$aviasys_pay-$aviansys_gst,
        	   //     'aviansys_gst'=>$aviansys_gst,
        	   //     'marrsmanage_rozarpay_id'=>$cart_data[0]->marrsmanage_account_id,
        	   //     'marrsmanage_razorpay_name'=>$cart_data[0]->marrsmanage_razorpay_name,
        	   //     'management_amount'=>$management_pay,
        	   //     'inserted_time'=>date("h:s:i"),
        	   //     'inserted_date'=>date("Y-m-d"),
        	   //     'status'=>0,
        	   //     'MaRRS_bal'=>$MaRRS_Bal,
        	   //     'marrs_gst'=>$marrs_gst,
        	   //     'gst_amount'=>'',
        	   //     'date_of_payment'=>'',
        	   //     'comp_id'=>$comp_id
    	       // ];
    	        
    	       // print_r($insert_array);die;
    	        
    	        $webhook_calls_cin = $this->db->get_where('webhook_calls_cin',array('payment_id'=>$data['razorpay_order_id']))->row();
    	      
    	        if(empty($webhook_calls_cin)){
    	            $this->db->where('id',$webhook_calls_cin->id);
                    $this->db->update('webhook_calls_cin',['status'=>1]);
                    
                    $this->db->where('cin',$cin);
    		        $this->db->delete('amount_cart');
    	        }
	        
        		$cin = $data['cin'];
        	
        		$data['cin'] = $data['cin'];
         
	        }
	        
		$data['student'] = $this->newmodel->get_student_data($cin);
	
        $this->load->view('cin_login/success', $data);
	}
	
	
	public function paymentFailed2()
	{
	    $data = $this->session->userdata('payment_data');
    	$cin = $data['cin'];
        $data['arr']=$data['product_name'];
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/tranctionfailed', $data);
	}
	
	
    public function fetch($merchant_order_id, $account_id, $amount, $account_razorpay_name)
    {
        if (!empty($merchant_order_id)) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.razorpay.com/v1/orders/' . $merchant_order_id . '/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
                ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            $paymentDatas = json_decode($response, true);
            $payment_id = isset($paymentDatas['items'][0]['id']) ? $paymentDatas['items'][0]['id'] : null;
    
           // echo "DEBUG fetch(): payment lookup response = <pre>" . htmlspecialchars($response) . "</pre>";
    
            if (empty($payment_id)) {
                //echo "DEBUG fetch(): ERROR - no payment_id found for order $merchant_order_id, aborting transfer.<br>";
                return array('payment_id' => null, 'tranfer_id' => '', 'tranfer_amount' => $amount);
            }
    
            $on_hold_until = strtotime("+2 day");
           
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.razorpay.com/v1/payments/' . $payment_id . '/transfers',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>
                                '{
                                    "transfers": [
                                        {
                                            "account": "'.$account_id.'",
                                            "amount": "'.$amount.'",
                                            "currency": "INR",
                                            "notes": {
                                                "name": "'.$account_razorpay_name.'",
                                                "roll_no": "IEC2011025"
                                            },
                                            "linked_account_notes": [
                                                "roll_no"
                                            ],
                                            "on_hold": false
                                        }
                                    ]
                                }',
                CURLOPT_HTTPHEADER => array(
                    'content-type: application/json',
                    'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
                ),
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
    
           // echo "DEBUG fetch(): RAW TRANSFER API RESPONSE for account $account_id = <pre>" . htmlspecialchars($response) . "</pre>";
    
            $data = json_decode($response, true);
    
            if (isset($data['error'])) {
                //echo "DEBUG fetch(): RAZORPAY ERROR = <pre>" . print_r($data['error'], true) . "</pre>";
                $id = '';
            }
            elseif (isset($data['items'][0]['id'])) {
                $id = $data['items'][0]['id'];
            }
            elseif (isset($data['id'])) {
                $id = $data['id'];
            } else {
               // echo "DEBUG fetch(): UNRECOGNIZED RESPONSE SHAPE, tranfer_id will be blank.<br>";
                $id = '';
            }
    
            $arr = array(
                'payment_id' => $payment_id,
                'tranfer_id' => $id,
                'tranfer_amount' => $amount,
            );
    
            return $arr;
        }
    }
     	
 	
 	
    // ====================== end ============================ //	
    public function pay3()
	{
	    
	    $prid=$_POST['prid'];
	    
	    $cart_data= $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
	    $amount=0;
	    foreach($cart_data as $row){
	        $amount = $amount + $row->amount;
	    }
	   // $amount=1;
	   
	    $stuent = $this->db->get_where('students',array('PRID'=>$prid))->row();
	
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
	
	    $amount =	$amount*100; 
	   
		$cin  = $_POST['cin'];
        
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		
		$Pay_array = array(
		
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'prid'              => $prid,
    		
		);
		
		$student = $this->db->get_where('students',array('PRID'=>$_SESSION['prid']))->row();
 		//print_r($cart_data);die;


        $marrs_gst = 0;
        $marrs_left = 0;
        $franchise_amount = 0;
        $franchise_gst = 0;
        $school_amount = 0;
        $associate_amount = 0;
        $associate_gst = 0;
        $free_mat_royalty = 0; 
        $crm_fix = 0;
        $manage_amount = 0;
        $aviansys_amount = 0;
        $aviansys_gst = 0;
        $razorpay_cut = 0;
        $amount = 0;
        $i=1;
		foreach($cart_data as $row){
		  // echo '<pre>';
	   //    print_r($row); 
	        $marrs_gst += $row->marrs_gst;
	        $marrs_left += $row->marrs_left;
	        $franchise_amount += $row->franchise_amount;
	        $franchise_gst += $row->franchise_gst;
	        $school_amount += $row->school_amount;
	        $associate_amount += $row->associate_amount;
	        $associate_gst += $row->associate_gst;
	        $free_mat_royalty += $row->free_mat_royalty;
	        $crm_fix += $row->crm_fix + $row->crm_gst;
	        $manage_amount += $row->manage_amount + $row->manage_gst;
	        $aviansys_amount += $row->aviansys_amount;
	        $aviansys_gst += $row->aviansys_gst;
	        $razorpay_cut += $row->razpay_service;
	        $amount += $row->amount;
	        $franchise_id = $row->franchise_id;
	        $franchise_account_id = $row->franchise_account_id;
	        $franchise_razorpay_name = $row->franchise_razorpay_name;
	        $associate_id = $row->associate_id;
	        $associate_account_id = $row->associate_account_id;
	        $associate_razorpay_name = $row->associate_razorpay_name;
	        $crm_account_id = $row->crm_account_id;
	        $crm_razorpay_name = $row->crm_razorpay_name;
	        $marrsgst_account_id = $row->marrsgst_account_id;
	        $aviansys_account_id = $row->aviansys_account_id;
	        $aviansys_razorpay_name = $row->aviansys_razorpay_name;
	        $marrsmanage_account_id = $row->marrsmanage_account_id;
	        $marrsmanage_razorpay_name = $row->marrsmanage_razorpay_name;
	        $it_fix += $row->it_fix;
	        $maker_razorpay_name = $row->maker_razorpay_name;
	        $maker_razorpay_id = $row->maker_razorpay_id;
	        $maker_id = $row->maker_id;
	        
	        $ar=[
	                'title' => 'Competition',
	                'maker_id' => $row->maker_id,
	                'price' => $row->free_mat_royalty,
	                'transaction_id' => '',
	                'revenue_setting_id' => '',
	                'comp_id' => '',
	                'order_id' => $razorpayOrderId,
	                'prid' => $prid,
	                'i'=>$i,
	                'product_name'=> $row->product,
	                'gst_amount' => 0,
	                'net_amount' => 0
	            ];
	            
	        $makers_splits = $this->db->get_where('makers_splits',$ar)->row();
	        
	        if(!$makers_splits){
	            $this->db->insert('makers_splits',$ar);
	        }
	        $i=$i+1;
	    }
	    
	   //die;
	    
	    $ar=
            [	
            	'cin'	        => '',
            	'prid'          => $_SESSION['prid'],
            	'clevel'	    => 1,	
            	'product_name'	=> '',
            	'name'		    => $student->first_name.' '.$student->middle_name.' '.$student->last_name,
            	'total_amount'  => $amount,		
            	'payment_id'	=> $razorpayOrderId,	
            	'school_amount'	=> $school_amount,	
            	'franchise_id'	=> $franchise_id,	
            	'franchise_amount'=> $franchise_amount,		
            	'franchise_gst'		=> $franchise_gst,
            	'franchise_account_id' => $franchise_account_id,	
            	'franchise_razorpay_name' => $franchise_razorpay_name,		
            	'associate_id'		=> $associate_id,
            	'associate_account_id' => $associate_account_id,		
            	'associate_razorpay_name' => $associate_razorpay_name,	
            	'associate_gst'		=> $associate_gst,
            	'associate_amount'	=> $associate_amount,	
            	'crm_account_id'	=> $crm_account_id,	
            	'crm_razorpay_name'	=> $crm_razorpay_name,	
            	'crm_fix'		    => $crm_fix,
            	'maker_razorpay_name' => $maker_razorpay_name ?? NULL,		
            	'maker_razorpay_id'		=> $maker_razorpay_id,
            	'razpay_service'		=> $razorpay_cut,
            	'total_maker_amount'	=> $free_mat_royalty,	
            	'aviansys_account_id'	=> $aviansys_account_id,
            	'aviansys_razorpay_name' => $aviansys_razorpay_name,	
            	'aviansys_amount'	=> $aviansys_amount,
            	'aviansys_gst'	=> $aviansys_gst,
            	'marrsmanage_rozarpay_id'	=> $marrsmanage_account_id,
            	'marrsmanage_razorpay_name'	=> $marrsmanage_razorpay_name,
            	'management_amount'	=> $manage_amount,
            	'inserted_time'	=> date('H:s:i'),
            	'inserted_date'	=> date('Y-m-d'),
            	'status'	    => 0,
            	'MaRRS_bal'	    => $marrs_left,
            	'marrs_gst'	    => $marrs_gst,
            	'gst_amount'    => $marrs_gst,	
            	'date_of_payment' => date('Y-m-d'),	
            	'comp_id'       => '',
            	'it_fix'        => $it_fix
            ];		
// 		echo '<pre>';
// 		print_r($ar);die;
		
		$webhook_calls = $this->db->get_where('webhook_calls',array('prid'=>$_SESSION['prid'] , 'payment_id' => $razorpayOrderId, 'total_amount' => $amount))->row();
		if(!$webhook_calls){
		    $this->db->insert('webhook_calls',$ar);
		}
		
		
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay3',array('data' => $data));
	}
    
    public function verify3()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
		    
		  //  echo $order_id;die;
		    
		    $this->processPaymentSplitsAsync1($order_id);
		    
		           
                    $student = $this->db->get_where('students', array('PRID' => $_SESSION['prid']))->row();
        		    $cart_data = $this->db->get_where('cart_prid', array('prid' => $_SESSION['prid']))->result();
            	    $school = $this->db->get_where('school_new', array('id' => $student->school_code))->row();
            	    $period = $this->db->get_where('period', array('period_id' => $student->period_id))->row();
            	    $who = 0;
            	    $pieces = explode("S", $student->school_code);
            	    
            	        foreach($cart_data as $row){
                    	        
                    	       // echo '<pre>';
                    	       // print_r($student->school_code);
                    	        
                    	        $product = $this->db->get_where('products', array('product_name' => $row->product))->row();
                    	    
                    	        $competition = $this->db->select('product_to_school.*, revenue_setting.*')
                                    ->from('product_to_school')
                                    ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
                                    ->where(['product_to_school.period_id' => $student->period_id,
                                        'product_to_school.school_id' => $school->school_id,
                                        'product_to_school.product_id'=> $product->product_id
                                    ])
                                    ->get()
                                    ->row();
                                    
                                    
                                    $comp_scd = $this->db->get_where('competition_schedule',
                                             array(
                                            'period_id' => $student->period_id,
                                            'product_id' => $product->product_id,
                                            'school_id' => $school->school_id,
                                            'state_id' => $student->state,
                                            'competition_level_id' => $competition->level_id
                                        )
                                    )->row();
                                    
                    	        $period_id = $student->period_id;
                    	        $who = $who+1;
                    	        
                    		    $ini = $product->in13;
                    		    if(empty($school->area_code)){
                    		        $code = $pieces[0];
                    		    }else{
                    		        $code = $school->area_code;
                    		    }
                    		    
                    		    $it = explode("MREG", $_SESSION['prid']);
                    		    
                    		    $cin = $period->initials.$product->initials.$ini.$code.$who.$it[1];
                    		    
                    		  //  echo $cin;die;
                    		    
                    		    if (stripos($row->name, $student->first_name) !== false) {
                                    $student_flag = 0;
                                } else {
                                    $student_flag = 1;
                                }
                    		    
                    		    $ar=array(
                    		        'product_name'=>$row->product,
                    		        'prid'=>$_SESSION['payment_data']['prid'],
                    		        'period_id'=>$period_id,
                    		        'amount'=>$row->amount,
                    		        'payment_id'=>$order_id,
                    		        'cin'=>$cin,
                    		        'who'=>$student_flag,
                    		        'student_name'=>$row->name
                    		        );
                    		    $this->db->insert('product_purchase',$ar);
                    		    
                    		    $arr=array(
                    		        'cin' => $cin,
                    		        'password' => $cin,
                    		        'period_id' => $period_id,
                    		        'student_name' => $row->name,
                    		        'franchise_id' => $competition->franchise_id,
                    		        'franchise_code' => $code,
                    		        'address1' => $student->address1,
                    		        'address2' => $student->address2,
                    		        'stud_email' => $student->email,
                    		        'stud_phone' => $student->mobile,
                    		        'class' => $row->class,
                    		        'father_name' => $student->father_name,
                    		        'mother_name' => $student->mother_name,
                    		        'school_id' => $student->school_id,
                    		        'state_id' => $student->state,
                    		        'status' => 'Active',
                    		        'gender' => $student->gender,
                    		        'prid' => $_SESSION['payment_data']['prid'],
                    		        'competition_schedule_id'=>$comp_scd->competition_schedule_id,
                    		        
                    		    );
                    		    
                                $this->db->insert('cin_list',$arr); 
                    		    
                    		    if ($competition->level_id > 1) {
                                      
                                        $arrrrr = array(
                                            'cin'          => $cin,
                                            'period_id'    => $period_id,
                                            'product_name' => $row->product,
                                            'clevel'       => $competition->level_id,
                                            'status'       => 'Q',
                                            'competition_date'    => $competition->comp_date,
                                            'competition_schedule_id'=>$comp_scd->competition_schedule_id,
                                             );
                                         
                    		            $this->db->insert('cin_result',$arrrrr);
                                         
                                }else{
                        		    $araa=array(
                        		        'cin' => $cin,
                        		        'period_id' => $period_id,
                        		        'product_name' => $row->product,
                        		        'clevel' => $competition->level_id,
                        		        'competition_schedule_id'=>$comp_scd->competition_schedule_id
                        		        );
                        		    $this->db->insert('cin_result',$araa);
                        		    
                                }
                    		    
                    		    
                    		   
                    		    $ar=array(
                    		        'cin' => $cin,
                    		        'period_id' => $period_id,
                    		        'product_name' => $row->product,
                    		        'clevel' => $competition->level_id ?? 1,
                    		        'status' => 'Paid',
                    		        'comp_date' => $competition->comp_date
                    		        );
                    		       
                    		          
                    		    $this->db->insert('new_cart',$ar);
                    		    
                    		    $comp = $this->db->get_where('competition_product_state',array('product_name' => $row->product, 'period_id' => $period_id,'clevel' => $competition->level_id,'state_id' => $competition->state))->row();
                    		    $arrr=array(
                    		        'cin' => $cin,
                    		        'comp_id' => $comp->id
                    		        );
                    		    $this->db->insert('cin_uploade',$arrr);
    	                    }
		    
		          //  die;
		            
		   // echo $cin;die;
		    
		            $this->db->where('prid',$_SESSION['prid']);
		            $this->db->delete('cart_prid');
		            
		            $makers_split = $this->db->get_where('cart_prid', array('prid' => $_SESSION['prid'],'order_id'=>$order_id,'transaction_id'=>NULL))->result();
            	    
		            if (!empty($makers_split)) {
                        foreach ($makers_split as $makers) {
                            try {
                                $maker = $this->db->get_where('material_maker', array('material_maker_id' => $makers->maker_id))->row();
            
                                if (!empty($maker) && $makers->price > 0) {
                                    $maker_pay = $this->fetch($order_id, $maker->razorpay_id, $makers->price * 100, $maker->account_name);
            
                                    if ($maker_pay) {
                                        $this->db->where('id', $makers->id);
                                        $this->db->update('makers_splits', array('transaction_id' => $maker_pay['tranfer_id']));
                                    }
                                }
                            } catch (Exception $e) {
                                log_message('error', 'Maker split failed for order ' . $order_id . ', maker_id ' . $makers->maker_id . ': ' . $e->getMessage());
                            }
                        }
                    }
		    
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
// 			redirect(base_url().'razorpay/success3_test');

            redirect(base_url().'razorpay/success3_test_ne');

		}
		else {
			redirect(base_url().'razorpay/paymentFailed3');
		}
	}
	
	
    private function processPaymentSplitsAsync1($order_id)
    {
        
        // cPanel shared hosting: exec() is normally disabled, skip straight to cURL
        $this->callAsyncEndpoint1($order_id);
        
    }
    
    /**
     * Call async endpoint using cURL with timeout (for CI3)
     */
    private function callAsyncEndpoint1($order_id)
    {
        $url = base_url('razorpay/processPaymentSplitsEndpoint1');
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('order_id' => $order_id)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);
    
        //THIS is where your debug echoes actually end up — print the whole thing
        echo "<h3>FULL ASYNC RESPONSE BODY:</h3>";
        echo "<pre>" . htmlspecialchars($result) . "</pre>";
        echo "<h3>HTTP code:</h3> " . $httpCode . "<br>";
        echo "<h3>curl error:</h3> " . ($err ? $err : '(none)') . "<br>";
    }
    
    /**
     * Endpoint to process payment splits (called asynchronously)
     * This method does the heavy lifting
     * Can be called via HTTP or CLI
     */
    public function processPaymentSplitsEndpoint1($order_id = null)
    {
        // Increase execution time for background process
        @set_time_limit(300);
        @ini_set('max_execution_time', 300);
        
        // Get order_id from POST or CLI argument
        if (empty($order_id)) {
            $order_id = $this->input->post('order_id');
        }
        
        if (empty($order_id)) {
            log_message('error', 'Payment split processing: Order ID missing');
            echo json_encode(array('status' => 'error', 'message' => 'Order ID missing'));
            return;
        }
        
        try {
            $this->processPaymentSplits1($order_id);
            log_message('info', 'Payment splits processed successfully for order: ' . $order_id);
            echo json_encode(array('status' => 'success'));
        } catch (Exception $e) {
            log_message('error', 'Payment split processing failed for order ' . $order_id . ': ' . $e->getMessage());
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
        
    /**
     * Core payment split processing logic
     */
    /**
     * Core payment split processing logic
     */
    private function processPaymentSplits1($order_id)
    {
        $webhook_calls_cin = $this->db->get_where('webhook_calls', array('payment_id' => $order_id))->row();
    
        if (!$webhook_calls_cin) {
            throw new Exception('Webhook data not found for order: ' . $order_id);
        }
    
        if ((int)$webhook_calls_cin->status === 1) {
            log_message('info', 'Payment splits already processed for order: ' . $order_id . ', skipping duplicate.');
            return;
        }
    
        $this->db->where('payment_id', $webhook_calls_cin->payment_id);
        $this->db->where('prid', $webhook_calls_cin->prid);
        $this->db->where('status', 0);
        $this->db->update('webhook_calls', array('status' => 2));
    
        if ($this->db->affected_rows() == 0) {
            log_message('info', 'Payment splits already being processed/claimed for order: ' . $order_id . ', skipping duplicate.');
            return;
        }
    
        try {
            $existing_split = $this->db->get_where('payment_split_prid', array('payment_id' => $order_id))->row();
    
            if (!empty($existing_split)) {
                log_message('info', 'payment_split_prid already exists for order: ' . $order_id . ', skipping duplicate.');
                $this->db->where('payment_id', $webhook_calls_cin->payment_id);
                $this->db->where('prid', $webhook_calls_cin->prid);
                $this->db->update('webhook_calls', array('status' => 1, 'date_of_payment' => date('Y-m-d H:i:s')));
                return;
            }
    
            // Franchise payment (skip cleanly if no franchise assigned)
            if (!empty($webhook_calls_cin->franchise_account_id)) {
                $total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst + $webhook_calls_cin->school_amount;
                $franchise_pay = $this->fetch($order_id, $webhook_calls_cin->franchise_account_id, $total_franchise * 100, $webhook_calls_cin->franchise_razorpay_name);
            } else {
                log_message('info', 'No franchise account for order ' . $order_id . ', skipping franchise transfer.');
                $franchise_pay = ['tranfer_id' => null];
            }
    
            // Associate payment (if applicable)
            $associate_pay = ['tranfer_id' => null];
            if ($webhook_calls_cin->associate_amount > 0 && !empty($webhook_calls_cin->associate_amount)) {
                $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
                $associate_pay = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
            }
    
            // CRM payment
            $crm_pay['tranfer_id'] = '';
            if($webhook_calls_cin->crm_fix>0){
                $crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id, $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
            }
            
            // IT payment
            $it_pay['tranfer_id'] = '';
            if($webhook_calls_cin->it_fix>0){
                $it_account_marrs = $this->db->get_where('gst_account_marrs', array('id' => 9))->row();
                $it_pay = $this->fetch($order_id, $it_account_marrs->rozarpay_id, $webhook_calls_cin->it_fix * 100, $it_account_marrs->account_name);
            }
            
            // Aviansys payment
            $aviansys_pay['tranfer_id'] = '';
            $total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
            $aviansys_pay = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id, $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
    
            // Management payment
            $management_amount_pay['tranfer_id'] = '';
            $management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id, $webhook_calls_cin->management_amount * 100, $webhook_calls_cin->marrsmanage_razorpay_name);
    
            // GST payment
            $gst = $this->db->get_where('gst_account_marrs', array('id' => '1'))->row();
            $gst_pay_marrs = $this->fetch($order_id, $gst->rozarpay_id, $webhook_calls_cin->marrs_gst * 100, $gst->account_name);
    
            // Maker payments
            $makers_split = $this->db->get_where('makers_splits', array('order_id' => $order_id))->result();
    
            if (!empty($makers_split)) {
                foreach ($makers_split as $makers) {
                    try {
                        $maker = $this->db->get_where('material_maker', array('material_maker_id' => $makers->maker_id))->row();
    
                        if (!empty($maker) && $makers->price > 0) {
                            $maker_pay = $this->fetch($order_id, $maker->razorpay_id, $makers->price * 100, $maker->account_name);
    
                            if ($maker_pay) {
                                $this->db->where('id', $makers->id);
                                $this->db->update('makers_splits', array('transaction_id' => $maker_pay['tranfer_id']));
                            }
                        }
                    } catch (Exception $e) {
                        log_message('error', 'Maker split failed for order ' . $order_id . ', maker_id ' . $makers->maker_id . ': ' . $e->getMessage());
                    }
                }
            }
    
            // Insert payment split record
            $inst = array(
                'prid' => $webhook_calls_cin->prid ?? '',
                'clevel' => $webhook_calls_cin->clevel ?? '',
                'total_amount' => isset($webhook_calls_cin->total_amount) ? $webhook_calls_cin->total_amount : '',
                'franchise_amount' => isset($webhook_calls_cin->franchise_amount) ? $webhook_calls_cin->franchise_amount : '',
                'franchise_tranfer_id' => isset($franchise_pay['tranfer_id']) ? $franchise_pay['tranfer_id'] : '',
                'franchise_id' => isset($webhook_calls_cin->franchise_id) ? $webhook_calls_cin->franchise_id : '',
                'payment_id' => $order_id ?? '',
                'aviansys_amount' => isset($webhook_calls_cin->aviansys_amount) ? $webhook_calls_cin->aviansys_amount : '',
                'gst_amount' => isset($webhook_calls_cin->marrs_gst) ? $webhook_calls_cin->marrs_gst : '',
                'comp_id' => isset($webhook_calls_cin->comp_id) ? $webhook_calls_cin->comp_id : '',
                'aviansys_tranfer_id' => isset($aviansys_pay['tranfer_id']) ? $aviansys_pay['tranfer_id'] : '',
                'gst_tranfer_id' => isset($gst_pay_marrs['tranfer_id']) ? $gst_pay_marrs['tranfer_id'] : '',
                'razpay_service' => isset($webhook_calls_cin->razpay_service) ? $webhook_calls_cin->razpay_service : '',
                'crm_fix' => isset($webhook_calls_cin->crm_fix) ? $webhook_calls_cin->crm_fix : '',
                'crm_fix_tranfer_id' => isset($crm_pay['tranfer_id']) ? $crm_pay['tranfer_id'] : '',
                
                'it_fix' => isset($webhook_calls_cin->it_fix) ? $webhook_calls_cin->it_fix : '',
                'it_fix_tranfer_id' => isset($it_pay['tranfer_id']) ? $it_pay['tranfer_id'] : '',
                
                'MaRRS_bal' => isset($webhook_calls_cin->MaRRS_bal) ? $webhook_calls_cin->MaRRS_bal : '',
                'date_of_payment' => date('Y-m-d H:i:s'),
                'management_amount' => isset($webhook_calls_cin->management_amount) ? $webhook_calls_cin->management_amount : '',
                'management_tranfer_id' => isset($management_amount_pay['tranfer_id']) ? $management_amount_pay['tranfer_id'] : '',
                'franchise_gst' => isset($webhook_calls_cin->franchise_gst) ? $webhook_calls_cin->franchise_gst : '',
                'aviansys_gst' => isset($webhook_calls_cin->aviansys_gst) ? $webhook_calls_cin->aviansys_gst : '',
                'status' => '1',
                'maker_id' => '',
                'total_maker_amount' => '',
                'maker_transfer_id' => '',
                'associate_gst' => isset($webhook_calls_cin->associate_gst) ? $webhook_calls_cin->associate_gst : '',
                'associate_tranfer_id' => isset($associate_pay['tranfer_id']) ? $associate_pay['tranfer_id'] : '',
                'associate_amount' => isset($webhook_calls_cin->associate_amount) ? $webhook_calls_cin->associate_amount : '',
                'associate_id' => isset($webhook_calls_cin->associate_id) ? $webhook_calls_cin->associate_id : ''
            );
    
            $insert_ok = $this->db->insert('payment_split_prid', $inst);
            if (!$insert_ok) {
                log_message('error', 'payment_split_prid insert failed for order ' . $order_id . ': ' . json_encode($this->db->error()));
            }
    
            // Update webhook status -> done
            $this->db->where('payment_id', $webhook_calls_cin->payment_id);
            $this->db->where('prid', $webhook_calls_cin->prid);
            $this->db->update('webhook_calls', array(
                'status' => 1,
                'date_of_payment' => date('Y-m-d H:i:s')
            ));
    
            // Clear amount cart
            $this->db->where('prid', $webhook_calls_cin->prid);
            $this->db->where('payment_order_id', $webhook_calls_cin->payment_id);
            $this->db->delete('cart_prid');
    
            log_message('info', 'processPaymentSplits1 COMPLETE for order: ' . $order_id);
    
        } catch (Exception $e) {
            // Roll the lock back to 0 so this can be safely retried instead of staying stuck at 2
            $this->db->where('payment_id', $webhook_calls_cin->payment_id);
            $this->db->where('prid', $webhook_calls_cin->prid);
            $this->db->update('webhook_calls', array('status' => 0));
            throw $e; // bubble up so processPaymentSplitsEndpoint1() logs the failure
        }
    }
        
    
    public function success3_test_ne()
	{   
	        
	        $data['student'] =  $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       // echo $this->db->last_query();die;
	        
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);  
        	$query=$this->db->get();
        	$data['cins'] =$query->result();
        
            $full_name = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;

            $message = "<p>Dear {$full_name},</p>
                
                <p>We're excited to have you registered for our competitions!</p>
                
                <p><strong>Below are your Candidate Identification Numbers (CINs) for the products you've enrolled in:</strong></p>
                <ul>";
                
                foreach ($data['cins'] as $cin) {
                    $message .= "<li><strong>{$cin->product_name}</strong>: <a href='https://marrs.in/' target='_blank'>{$cin->cin}</a></li>";

                }
                
                $message .= "</ul>
                
                <p>This CIN will serve as your primary identification throughout the competition, right up to its conclusion. It's crucial to save your CIN securely as it's required for several essential activities, including:</p>
                
                <ul>
                    <li>Accessing and downloading learning materials</li>
                    <li>Participating in online competitions</li>
                    <li>Viewing your results</li>
                    <li>Downloading your digital certificates</li>
                </ul>
                
                <p>Please mention your CIN whenever requesting any competition-related service.</p>
                
                <p>You can now access the participant portal at: <a href='https://marrs.in/' target='_blank'>https://marrs.in/</a><br>
                Use your CIN as both <strong>username</strong> and <strong>password</strong> to log in.</p>
                
                <p><em>Because First Steps Last! The healthy competitive spirit motivates the students to learn on their own without any compulsion.</em></p>";


            
                $data2 = array(
                    'email' => $student->email,
                    'otp' => '',
                    'message' => $message
                );
                // print_r($data);die;
                $postFields = json_encode($data2);
               
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
       
            $this->load->view('success3', $data);
       	
        	
        
	}
    
    
    public function success3_test()
	{   
	        $data = $this->session->userdata('payment_data');
	    
	        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       // echo $this->db->last_query();die;
	        $state_id=$student->state;
	        $school_id=$student->school_id;
	   
	        $state_id=$student->state;
	        $period_id=$student->period_id;
	        
	       // $competition = $this->db->get_where('competition_product_state',array('franchise_id' =>$franchise_id,'state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	       // $competition = $this->db->get_where('competition_product_state',array('state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	            
	        $insert_array=array();
	        
	        $cart_data = $this->db->get_where('cart_prid',array('prid'=>$data['prid']))->result();
	      
	        $maker_push=array();
	        $franchise_push=array();
	        $associate_push=array();
	        $marrs_gst=0;
	        $franchise_gst=0;
	        $associate_gst=0;
	        $aviansys_gst=0;
	        $totalrazorpay=0;
	        $totalmanagement=0;
	        $totalcrm=0;
	        $totalschoolcut=0;
	        $totalaviansys=0;
	        $total_amount=0;
	        $totalBase_cost=0;
	        
	        foreach($cart_data as $item){  
	            
	            $maker_amount=0;
	            
	            $product = $this->db->get_where('products',array('product_name'=>$item->product))->row();
	            
	            $competition = $this->db->select('product_to_school.*, revenue_setting.*')
                    ->from('product_to_school')
                    ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
                    ->where([
                        // 'product_to_school.product_name' => $item->product,
                        'product_to_school.period_id' => $student->period_id,
                        'product_to_school.school_id' => $student->school_id,
                        'product_to_school.product_id'=> $product->product_id
                    ])
                    ->get()
                    ->row();
                

	                $this->db->select('*');
                    $this->db->from('study_material');
                    $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                    $this->db->join('material_maker','material_maker.material_maker_id=assigned_materials.maker_id');
                    $this->db->where(array(
                        'assigned_materials.period_id' => $competition->period_id,
                        'study_material.status' => 'Free',
                        'class'=>$item->class,
                        'product_name'=>$competition->product_name,
                        'clevel'=>1
                    ));
                    $this->db->order_by('study_material.id', 'DESC');
                    $mat_free = $this->db->get()->row();
            
                    // print_r($mat_free);die;
            
	                if(!empty($mat_free)){
	                    $maker_id = $mat_free->maker_id;
	                    $price = $this->db->get_where('revenue_setting',array('id'=>$competition->revenue_setting_id))->row();
	                    $ar=array('price'=>$price->study_material_free_royalty,'maker_id'=>$maker_id,'title'=>$item->product);
	                }
	                
	                array_push($maker_push,$ar);
	                
	               // echo '<pre>';
                // print_r($competition);die;
	               // print_r($maker_push);die;
	                
	                $franchise_per = $price->com_per;
        	        $aviansys_per = $price->com_peravian;
        	        $manage_per = $price->manageper;
        	  
        	        $crm_fix = $price->crm_fix;
        	        $totalcrm+=$crm_fix;
        	        
        	        $associate_per = $price->associate_per;
        	        $associate_id = $price->associate_id;
        	                
        	        $school_amount = $competition->school_amount;       
        	       
	                
	                $total_amount+=$item->amount;
        	        $Base_GR=$item->amount;    // GR=>GST+Razorpay
        	        $Base_G=round($Base_GR/1.03);   
        	        $Base_cost = round($Base_G/1.18); 
        	        
        	        $Base_cost=$Base_cost-$crm_fix;
        	        $Base_cost=$Base_cost-$school_amount;
        	        
        	        $totalschoolcut += $school_amount;
        	        
        	       // echo $Base_G.' -BG '.$crm_fix.' -CRM BC- '.$Base_cost.'  '.$school_amount;die;
        	       
        	        
        	        $GST = round($Base_cost * 0.18);           // GST account money
        	                
        	        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$competition->franchise_id))->row();
	                               
        	        $franchise_id=$competition->franchise_id;  
        	        $GST_fr=0;
        	        if($franchise->gst == 'Yes'){
        	            $GST_fr =round($GST * $franchise_per/100);
        	        }          
        	        
        	        $franchise_gst+=$GST_fr;
        	        
        	        $associate = $this->db->get_where('associates',array('associate_id'=>$competition->associate_id))->row();
	                               
        	        $associate_id=$associate->associate_id; 
        	        
        	        $GST_As=0;
        	        if($associate->gst == 'Yes'){
        	            $GST_As =round($GST * $associate_per/100);
        	        }
        	        $associate_gst+=$GST_As;
        	        
        	        $GST_Av =round($GST * $aviansys_per/100);
        	        $aviansys_gst+=$GST_Av;
        	        
        	        $rest_GST= round($GST-$GST_fr-$GST_Av-$GST_As);
        	        $marrs_gst+=$rest_GST;
        	        
        	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);
        	        $totalAviasys_pay = $Aviasys_pay + $GST_Av; // payment made to aviansys per user transaction
        	        
        	        $totalaviansys += $totalAviasys_pay;
        	        $franchise_per = $franchise_per - $associate_per;
        	        $Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
        	        $totalFranchise_pay = $Franchise_pay + $GST_fr;
        	        
        	        $Associate_pay = round ($Base_cost * $associate_per/100);   // payment made to franchise per user transaction
        	        $totalAssociate_pay = $Associate_pay + $GST_As;
        	        
        	        $management_pay = round ($Base_cost * $manage_per/100);
        	        $totalmanagement += $management_pay;
        	        
        	        $razpay_service = $Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
        	        $totalrazorpay += $razpay_service;
        	                
        	        $franchi=array(
	                    'price'=>$totalFranchise_pay,
	                    'franchise_id'=>$competition->franchise_id,
	                    'title'=>$item->product,
	                    'revenue_setting_id'=>$competition->revenue_setting_id,
	                    'school_cut'=>$school_amount
	                    );
	                
	                array_push($franchise_push,$franchi);
	                
	                $associ=array(
	                    'price'=>$totalAssociate_pay,
	                    'associate_id'=>$competition->associate_id,
	                    'title'=>$item->product,
	                    'revenue_setting_id'=>$competition->revenue_setting_id,
	                    'school_cut'=>$school_amount
	                    );
	                
	                array_push($associate_push,$associ); 
	                
        	        $franchise_id=$competition->franchise_id;
        	        
        	        $totalBase_cost += $Base_cost;
        	        $associate_id = $competition->associate_id;
	        }
	        
	       // echo '<pre>';
	       // print_R($maker_push);
	        
	       // echo '<br>'. ' MaRRS GST-> ';
	       // echo $marrs_gst;
	       // echo '<br>'. ' FRAN GST-> ';
	       // echo $franchise_gst;
	       // echo '<br>'. ' ASO GST-> ';
	       // echo $associate_gst;
	       // echo '<br>'. ' Av GST-> ';
	       // echo $aviansys_gst;
	       // echo '<br>';
	       // echo $total_amount;
        //     echo '<pre>'. ' Franchise-> ';
	       // print_r($franchise_push);
	       // echo '<pre>'. ' Associ-> ';
	       // print_r($associate_push);
	       // echo '<br>'. ' Razor-> ';
	       // echo $totalrazorpay;
	       // echo '<br>'. ' Manage-> ';
	       // echo $totalmanagement;
	       // echo '<br>'. ' CRM-> ';
	       // echo $totalcrm;
	       // echo '<br>'. ' SChoool-> ';
	       // echo $totalschoolcut;
	       // echo '<br>'. ' Aviansys-> ';
	       // echo $totalaviansys;
    	   // echo '<pre>';
    	   // print_r($_SESSION);die;	      
	    
	       
	        $insert_array=array();
	        $insert_array['franchise_id'] = $franchise_id;
            $insert_array['prid'] = $_SESSION['payment_data']['prid'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['school_id'] = $student->school_id;
            $insert_array['razpay_service'] = $totalrazorpay;
            $insert_array['franchise_gst'] = $franchise_gst;
            $insert_array['aviansys_gst'] = $aviansys_gst;
            $insert_array['associate_id'] = $associate_id;
            
            // echo $gst_amt;die;
            
            $totalcut=0;
            
            // ================== maker transfer ================== //
            
            foreach($maker_push as $row)
            {
            
                $maker = $this->db->get_where('material_maker',array('material_maker_id' =>$row['maker_id']))->row();
                
    	        $maker_account_id=$maker->razorpay_id;
    	        $maker_razorpay_name=$maker->account_name;
    	        
    	        $ar = array(
                        'maker_id'            => $row['maker_id'],
                        'price'               => $row['price'],
                        'title'               => $row['title'],
                        'order_id'            => $data['razorpay_order_id'],
                        'comp_id'             => $competition->id,
                        'revenue_setting_id'  => $competition->revenue_setting_id,
                        'prid'                => $data['prid']
                    );
    	        
    	        
    	        $split = $this->db->get_where('makers_splits',$ar)->row();
                
    	        if(!empty($maker) && $row['price'] != 0 && !empty($row['price']) && empty($split)){
    	           
                    $maker_pay = $this->fetch($data['razorpay_order_id'],$maker_account_id,$row['price']*100,$maker_razorpay_name);
    	        }
    	        if(!empty($maker_pay['tranfer_id'])){
            	    $ar = array(
                        'maker_id'            => $row['maker_id'],
                        'price'               => $row['price'],
                        'title'               => $row['title'],
                        'transaction_id'      => $maker_pay['tranfer_id'],
                        'order_id'            => $data['razorpay_order_id'],
                        'comp_id'             => $competition->id,
                        'revenue_setting_id'  => $competition->revenue_setting_id,
                        'prid'                => $data['prid']
                    );
                    
                    $totalcut = $totalcut + $row['price'];
                    
                    $this->db->insert('makers_splits', $ar);
    	        }
    	      
            }
            
            // ======== end ========= //
            
            // ============== franchise transfer ================== //
            
	        
            
                $maker = $this->db->get_where('franchise',array('franchise_id' =>$row['franchise_id']))->row();
	            
	            $franchise_account_id = $maker->razorpay_id;
    	        $franchise_razorpay_name = $maker->account_name;
    	        //echo $totalFranchise_pay.' => totalFranchise_pay ';
    	        
    	        $this->db->select('payment_split_prid.franchise_tranfer_id');
    	        $this->db->from('payment_split_prid');
    	        $this->db->where('franchise_tranfer_id !=','');
    	        $this->db->where('prid', $data['prid']);
    	        $this->db->where('payment_id',$data['razorpay_order_id']);
    	        $query=$this->db->get();
    	        $split=$query->row();
    	        
    	        $total = $totalschoolcut + $totalFranchise_pay;
    	        
    	        if(!empty($maker) && !empty($total) && $total != 0 && empty($split)){
                    $maker_pay = $this->fetch($data['razorpay_order_id'], $franchise_account_id, $total * 100, $franchise_razorpay_name);
    	        }
    	        
    	        if(!empty($maker_pay['tranfer_id'])){
                    $totalcut=$totalcut + $total;
                    $insert_array['franchise_amount'] = $totalFranchise_pay - $franchise_gst;
                    $insert_array['franchise_tranfer_id'] = $maker_pay['tranfer_id'];
    	        }
	        
	        // ====== end ===== // 
	       
	        // ============== associate transfer ================== //
	        
	            
                $this->db->select('*');
                $this->db->from('associates');
                $this->db->join('associate_bank_details','associate_bank_details.bank_detail_id=associates.associate_id');
                $this->db->where('associates.associate_id',$associate_id);
                $query = $this->db->get();
                $maker = $query->row();
	            
	           // print_r($maker);die;
	            
	            $franchise_account_id=$maker->razorpay_id;
    	        $franchise_razorpay_name=$maker->account_name;
    	        
    	        $this->db->select('payment_split_prid.franchise_tranfer_id');
    	        $this->db->from('payment_split_prid');
    	        $this->db->where('associate_tranfer_id !=','');
    	        $this->db->where('prid', $data['prid']);
    	        $this->db->where('payment_id',$data['razorpay_order_id']);
    	        $query = $this->db->get();
    	        $split = $query->row();
    	        
    	       // echo $totalAssociate_pay.'o kk';die;
    	        
    	        if(!empty($maker) && !empty($total) && $totalAssociate_pay != 0 && empty($split)){
                    
                    $maker_pay=$this->fetch($data['razorpay_order_id'], $franchise_account_id, $totalAssociate_pay * 100, $franchise_razorpay_name);
    	        }
    	        
    	        if(!empty($maker_pay['tranfer_id'])){
                    $totalcut = $totalcut + $total;
                    $insert_array['associate_amount'] = $totalAssociate_pay - $franchise_gst;
                    $insert_array['associate_tranfer_id'] = $maker_pay['tranfer_id'];
    	        }
    	        
	        // ====== end ===== // 
	       
            // ============== crm transfer ================== //
            
            // echo $totalcrm;die;
            
            if (!empty($totalcrm) && $totalcrm != 0 ) 
            {
                $this->db->select('payment_split_prid.franchise_tranfer_id');
    	        $this->db->from('payment_split_prid');
    	        $this->db->where('crm_fix_tranfer_id !=','');
    	        $this->db->where('prid', $data['prid']);
    	        $this->db->where('payment_id',$data['razorpay_order_id']);
    	        $query = $this->db->get();
    	        $split = $query->row();
	           
    	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
    	        $crm_account_id=$gst->rozarpay_id;
    	        $crm_razorpay_name=$gst->account_name;
    	        if(empty($split)){
    	        $crm_pay=$this->fetch($data['razorpay_order_id'],$crm_account_id,$totalcrm*100,$crm_razorpay_name);
    	        }
    	        if(!empty($crm_pay['tranfer_id'])){
                    $insert_array['crm_fix'] = $crm_pay['tranfer_amount']/100;
            	    $insert_array['crm_fix_tranfer_id'] = $crm_pay['tranfer_id'];
    	        }
	        } 
	      
            // ========= end ============== //
            
            // ============== gst transfer ================== //
            
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$data['prid']);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('gst_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
    	        
    	        if(empty($resultt))
    	        {
                
        	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $gst_account_id=$gst->rozarpay_id;
        	        $gst_razorpay_name=$gst->account_name;
        	        //echo $gst_account_id;die;
        	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$marrs_gst*100,$gst_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($gst_pay['tranfer_id'])){
                    $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
            	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
        	        }
    	        } 
	        
    	    // ====== end ===== //
    	    
    	    // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$data['prid']);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $query=$this->db->get();
                $resultma = $query->row();
	        
	        
    	        if(empty($resultma)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$totalmanagement*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
            	    $totalcut = $totalcut+$management_pay;
        	        }
    	        }     
    	       
    	        // ====== end ===== //
    	    
    	    
                // ============== aviansys transfer ================== //
    	        if($totalaviansys != 0 or !empty($totalaviansys)){
    	            $this->db->select('*');
                    $this->db->from('payment_split_prid');
                    $this->db->where('prid',$data['prid']);
                    $this->db->where('payment_id',$data['razorpay_order_id']);
                    $this->db->where('aviansys_tranfer_id !=','');
                    $query=$this->db->get();
                    $resulta = $query->row();
                
                    if(empty($resulta)){
        	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
        	            $aviansys_id=$aviansys->rozarpay_id;
        	            $aviansys_razorpay_name=$aviansys->account_name;
        	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
        	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$totalaviansys*100,$aviansys_razorpay_name);
        	            if(!empty($avianpay['tranfer_id'])){
        	                
            	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
                	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
                	        $totalcut = $totalcut + $Aviasys_pay;
        	            }
    	            }
    	        }
                // ====== end ===== //
             
    	    
            
    	        $insert_array['date_of_payment'] = date("Y-m-d");
    	        
    	        $insert_array['MaRRS_bal'] = $totalBase_cost - $totalcut;
    	        
    	    
    	        $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$data['prid']);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $resultpay = $query->row();
           
                $insert_array['date_of_payment'] = date("Y-m-d");
	            $insert_array['school_amount'] = $totalschoolcut;
	            
            // print_r($resultpay);die;
            
            if(empty($resultpay)){ 
                $this->db->insert('payment_split_prid',$insert_array);
            }
        
        
		 $this->db->select('*');
         $this->db->from('cart_prid');
         $this->db->where('prid',$_SESSION['payment_data']['prid']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
		$school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
		$it=explode("MREG",$_SESSION['payment_data']['prid']);
		
		$this->db->where('prid', $_SESSION['payment_data']['prid']);
        $this->db->order_by('id', 'DESC');
        $qqq = $this->db->get('product_purchase')->row();

		$who=$qqq->who;
		if($who ==''){
		    $who=0;
		}else{
		    $who=$who;
		}    
		    
		foreach($res as $row){
		    $who=$who+1;
		    $pr_ini= $this->db->get_where('products',array('product_name'=>$row['product']))->row();
		    $ini=$pr_ini->in13;
		    
		    $cin=$it[0].$ini.$school->area_code.$who.$it[1];
		    if($it[0]=='24'){
		        $period_id='14';
		    }
		    if($it[0]=='25'){
		        $period_id='15';
		    }
		    if($it[0]=='26'){
		        $period_id='16';
		    }
		    if($it[0]=='27'){
		        $period_id='17';
		    }if($it[0]=='28'){
		        $period_id='18';
		    }
		    if($it[0]=='29'){
		        $period_id='19';
		    }
		    if($it[0]=='30'){
		        $period_id='20';
		    }
		    $ar=array(
		        'product_name'=>$row['product'],
		        'prid'=>$_SESSION['payment_data']['prid'],
		        'period_id'=>$period_id,
		        'amount'=>$row['amount'],
		        'payment_id'=>$data['razorpay_order_id'],
		        'cin'=>$cin,
		        'who'=>$who,
		        'student_name'=>$row['name']
		        );
		    $this->db->insert('product_purchase',$ar);
		    
		    $arr=array(
		        'cin'=>$cin,
		        'password'=>$cin,
		        'period_id'=>$period_id,
		        'student_name'=>$row['name'],
		        'franchise_id'=>$franchise_id,
		        'franchise_code'=>$school->area_code,
		        'address1'=>$student->address1,
		        'address2'=>$student->address2,
		        'stud_email'=>$student->email,
		        'stud_phone'=>$student->mobile,
		        'class'=>$row['class'],
		        'father_name'=>$student->father_name,
		        'mother_name'=>$student->mother_name,
		        'school_id'=>$school_id,
		        'state_id'=>$state_id,
		        'status'=>'Active',
		        'gender'=>$student->gender,
		        'prid'=>$_SESSION['payment_data']['prid'],
		        
		    );
		        
		      //  print_r($arr);die;
		      
            $this->db->insert('cin_list',$arr); 
		    
		    $araa=array(
		        'cin'=>$cin,
		        'period_id'=>$period_id,
		        'product_name'=>$row['product'],
		        'clevel'=>1
		        );
		    $this->db->insert('cin_result',$araa);
		    
		    
		        $product = $this->db->get_where('products',array('product_name'=>$row['product']))->row();
	            
	            $competition = $this->db->select('product_to_school.*')
                    ->from('product_to_school')
                    ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
                    ->where([
                        // 'product_to_school.product_name' => $item->product,
                        'product_to_school.period_id' => $period_id,
                        'product_to_school.school_id' => $school_id,
                        'product_to_school.product_id'=> $product->product_id
                    ])
                    ->order_by('product_to_school.id','DESC')
                    ->get()
                    ->row();
                    
                    
		    $ar=array(
		        'cin'=>$cin,
		        'period_id'=>$period_id,
		        'product_name'=>$row['product'],
		        'clevel'=>1,
		        'status'=>'Paid',
		        'comp_date'=>$competition->comp_date
		        );
		        
		    $this->db->insert('new_cart',$ar);
		    
		    $comp = $this->db->get_where('competition_product_state',array('product_name'=>$row['product'],'period_id'=>$period_id,'clevel'=>1))->row();
		    $arrr=array(
		        'cin'=>$cin,
		        'comp_id'=>$comp->id
		        );
		    $this->db->insert('cin_uploade',$arrr);
		}
		
		
    		$this->db->where('prid',$_SESSION['payment_data']['prid']);
    		$this->db->delete('cart_prid');
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);   
        	$query=$this->db->get();
        	$data['cins']=$query->result();
        
        // if(empty($data['cins'])){
            // $this->load->view('loader');
        // }else{
            $this->load->view('success3', $data);
        // }	
        	
        
	}
    
    public function success3_test_free()
	{   
	   // print_r($_SESSION);die;
	    
	        $data = $this->session->userdata('payment_data');
	    
	        $data['student'] = $student = $this->db->get_where('students',array('PRID' =>$_SESSION['prid']))->row();
	        // echo $this->db->last_query();
	        
	       // print_r($student);die;
	        
	        $state_id=$student->state;
	        $school_id=$student->school_id;
	   
	        $state_id=$student->state;
	        $period_id=$student->period_id;
	       
	            
	        $insert_array=array();
	        
	        $cart_data = $this->db->get_where('cart_prid',array('prid'=>$student->PRID))->result();
	      
	       // print_r($cart_data);die;
        
        
    		$this->db->select('*');
            $this->db->from('cart_prid');
            $this->db->where('prid',$student->PRID);
            $query = $this->db->get();
            //  echo $this->db->last_query();exit;
            $res= $query->result_array();
    		
    		$school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
    		$it=explode("MREG",$student->PRID);
    		
    		$this->db->where('prid', $student->PRID);
            $this->db->order_by('id', 'DESC');
            $qqq = $this->db->get('product_purchase')->row();
    
    		$who=$qqq->who;
    		if($who ==''){
    		    $who=0;
    		}else{
    		    $who=$who;
    		}    
		
            // 		print_r($student);
            // 		echo $who;
            // 		print_r($res);die;
    		    
    		foreach($res as $row){
    		    $who=$who+1;
    		    $pr_ini= $this->db->get_where('products',array('product_name'=>$row['product']))->row();
    		    $ini=$pr_ini->in13;
    		    
    		    $cin=$it[0].$ini.$school->area_code.$who.$it[1];
    		    if($it[0]=='24'){
    		        $period_id='14';
    		    }
    		    if($it[0]=='25'){
    		        $period_id='15';
    		    }
    		    if($it[0]=='26'){
    		        $period_id='16';
    		    }
    		    if($it[0]=='27'){
    		        $period_id='17';
    		    }if($it[0]=='28'){
    		        $period_id='18';
    		    }
    		    if($it[0]=='29'){
    		        $period_id='19';
    		    }
    		    if($it[0]=='30'){
    		        $period_id='20';
    		    }
    		    $ar=array(
    		        'product_name'=>$row['product'],
    		        'prid'=>$student->PRID,
    		        'period_id'=>$period_id,
    		        'amount'=>$row['amount'],
    		        'payment_id'=>'Free',
    		        'cin'=>$cin,
    		        'who'=>$who,
    		        'student_name'=>$row['name']
    		    );
    		    
    		    $this->db->insert('product_purchase',$ar);
    		    
    		    $product = $this->db->get_where('products',array('product_name'=>$row['product']))->row();
    	            
    	        $competition = $this->db->select('product_to_school.*')
                        ->from('product_to_school')
                        ->join('revenue_setting', 'revenue_setting.id = product_to_school.revenue_setting_id', 'left')
                        ->where([
                            // 'product_to_school.product_name' => $item->product,
                            'product_to_school.period_id' => $period_id,
                            'product_to_school.school_id' => $school_id,
                            'product_to_school.product_id'=> $product->product_id
                        ])
                        ->order_by('product_to_school.id','DESC')
                        ->get()
                        ->row();
    		    $rowschdule = $this->db->get_where('competition_schedule', [
                    'competition_schedule.period_id'  => $period_id,
                    'competition_schedule.school_id'  => $school_id,
                    'competition_schedule.product_id' => $product->product_id
                ])->row();
    		    //print_r($rowschdule);die;
    		    
    		    $arr=array(
    		        'cin'=>$cin,
    		        'password'=>$cin,
    		        'period_id'=>$period_id,
    		        'student_name'=>$row['name'],
    		        'franchise_id'=>$competition->franchise_id,
    		        'franchise_code'=>$school->area_code,
    		        'address1'=>$student->address1,
    		        'address2'=>$student->address2,
    		        'stud_email'=>$student->email,
    		        'stud_phone'=>$student->mobile,
    		        'class'=>$row['class'],
    		        'father_name'=>$student->father_name,
    		        'mother_name'=>$student->mother_name,
    		        'school_id'=>$school_id,
    		        'state_id'=>$state_id,
    		        'status'=>'Active',
    		        'gender'=>$student->gender,
    		        'prid'=>$student->PRID,
    		        'competition_schedule_id'   => $rowschdule->competition_schedule_id,
    		        
    		    );
    		        
    		    //    print_r($arr);die;
    		      
                $this->db->insert('cin_list',$arr); 
    		    
    		    $araa=array(
    		        'cin'=>$cin,
    		        'period_id'=>$period_id,
    		        'product_name'=>$row['product'],
    		        'competition_schedule_id'   => $rowschdule->competition_schedule_id,
    		        'clevel'=>1
    		        );
    		    $this->db->insert('cin_result',$araa);
    		    
    		    
    		        
                        
                        
    		    $arrrrrr=array(
    		        'cin'=>$cin,
    		        'period_id'=>$period_id,
    		        'product_name'=>$row['product'],
    		        'clevel'=>1,
    		        'status'=>'Paid',
    		        'comp_date'=>$competition->comp_date
    		        );
    		        
    		    $this->db->insert('new_cart',$arrrrrr);
    		    
    		    $comp = $this->db->get_where('competition_product_state',array('product_name'=>$row['product'],'period_id'=>$period_id,'clevel'=>1))->row();
    		    $arrrw=array(
    		        'cin'=>$cin,
    		        'comp_id'=>$comp->id
    		        );
    		    $this->db->insert('cin_uploade',$arrrw);
    		}
		
		
    		$this->db->where('prid',$student->PRID);
    		$this->db->delete('cart_prid');
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$student->PRID);   
        	$query=$this->db->get();
        	$data['cins'] =$query->result_array();
        
            $full_name = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;

            $message = "<p>Dear {$full_name},</p>
                
                <p>We're excited to have you registered for our competitions!</p>
                
                <p><strong>Below are your Candidate Identification Numbers (CINs) for the products you've enrolled in:</strong></p>
                <ul>";
                
                foreach ($data['cins'] as $cin) {
                    $message .= "<li><strong>{$cin['product_name']}</strong>: {$cin['cin']}</li>";
                }
                
                $message .= "</ul>
                
                <p>This CIN will serve as your primary identification throughout the competition, right up to its conclusion. It's crucial to save your CIN securely as it's required for several essential activities, including:</p>
                
                <ul>
                    <li>Accessing and downloading learning materials</li>
                    <li>Participating in online competitions</li>
                    <li>Viewing your results</li>
                    <li>Downloading your digital certificates</li>
                </ul>
                
                <p>Please mention your CIN whenever requesting any competition-related service.</p>
                
                <p>You can now access the participant portal at: <a href='https://marrs.in/' target='_blank'>https://marrs.in/</a><br>
                Use your CIN as both <strong>username</strong> and <strong>password</strong> to log in.</p>
                
                <p><em>Because First Steps Last! The healthy competitive spirit motivates the students to learn on their own without any compulsion.</em></p>";


            
                $data2 = array(
                    'email' => $student->email,
                    'otp' => '',
                    'message' => $message
                );
                // print_r($data);die;
                $postFields = json_encode($data2);
               
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
       
       
       
            $this->load->view('success6', $data);
	}
    
    public function success3()
	{   
	    $data = $this->session->userdata('payment_data');
	    
	        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	        // echo $this->db->last_query();
	        $state_id=$student->state;
	        $school_id=$student->school_id;
	        // echo $school_id.' '.$state_id;
	       
	       
    //     print_r($student);
	   // echo '<pre>';
	   // print_r($_SESSION);die;	      
	        
	        
	        $this->db->select('*');
	        $this->db->from('franchise');
	        $this->db->where('state_id',$state_id);
	        $this->db->where('account_id !=','');
	        $query=$this->db->get();
	        $masterfranchise = $query->row();
	        $franchise_id=$masterfranchise->franchise_id;
	        
	        $fracnhise = $this->db->get_where('product_to_school',array('school_id' =>$school_id,'period_id'=>$student->period_id))->row();
	        
	        //print_r($fracnhise);die;
	       $fracnhise_per= $fracnhise->franchise_per;
	       $aviansys_per = '20';
	       $school_fix=$fracnhise->school_amount;
	       
	        $total_amount=$data['amount']/100;
	        
	        $Base_GR=$data['amount']/100;
	       // $Base_GR=1000;
	        
	        $Base_G=round($Base_GR/1.03);
	        $Base_cost1 = round($Base_G/1.18); 
	        
	         $GST = round($Base_cost1 * 0.18);           // GST account money  
	        
	        
	        if(!empty($fracnhise_per)){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	             $abc = $fracnhise_per/100;
	          $GST_fr =round($GST*$abc);
	          
	        }
	        if(!empty($aviansys_per)){
	          $GST_Av =round($GST*$aviansys_per/100);
	        }
	        
	         $RemainingGST = round($GST-$GST_fr-$GST_Av);
	        $Base_cost2=$Base_cost1-$school_fix;
	        
	        
	        $Aviasys_pay = round($Base_cost2 * 20/100)+$GST_Av;     // payment made to aviansys per user transaction
	        
	        $management_pay = round($Base_cost2 * 15/100);   // management 5 %
	        $Franchise_cal = round ($Base_cost2 * $fracnhise->franchise_per/100);   // payment made to franchise per user transaction
	        $Franchise_pay=($Franchise_cal+$school_fix)+ $GST_fr;
	      // echo $GST_fr;die;
	        $razpay_service=$Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
	        
	        $MaRRS_bal=$Base_cost1-($Aviasys_pay+$Franchise_pay+$management_pay);     
	        $MaRRSBalance = 0;
	        $aviansys_split='yes';
	        $franchise_split='yes';
	       //echo 'Total=>'.$Base_GR.' Rz Pay '.$razpay_service.' Base_cost=>'.$Base_cost2.' GST_cost=>'.$GST.' Aviansys_18%_cost2=>'.$Aviasys_pay.' Franchise_60%_cost2=>'.$Franchise_pay.' Management Pay 5% => '.$management_pay.' school fix '.$school_fix.' MaRRS Bal '.$MaRRS_bal;die;
	       
	        $gst_amt=$RemainingGST*100;
	        //die;
	        $insert_array=array();
	        $insert_array['franchise_id'] = $franchise_id;
            // $insert_array['clevel'] = $data['clevel'];
            $insert_array['prid'] = $_SESSION['payment_data']['prid'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['school_id'] =$school_id;
            $insert_array['razpay_service'] =$razpay_service;
            // $insert_array['MaRRS_bal'] =$MaRRS_bal;
            $insert_array['franchise_gst'] =$GST_fr;
            $insert_array['aviansys_gst'] =$GST_Av;
            //echo $gst_amount;die;
           
            
            // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$management_pay*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
            
            
            // ============== gst transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('gst_tranfer_id !=','');
                $this->db->where('status','1');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $gst_account_id=$gst->rozarpay_id;
        	        $gst_razorpay_name=$gst->account_name;
        	        //echo $gst_account_id;die;
        	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$gst_amt,$gst_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($gst_pay['tranfer_id'])){
                    $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
            	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
    	    
	       // ============== franchise transfer ================== //
	        if($franchise_split=='yes'){
	            
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_tranfer_id !=','');
                
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	            $franchiseaccount_id=$franchise->account_id;
    	            $franchiseaccount_razorpay_name=$franchise->account_razorpay_name;
    	            $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$Franchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
        	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
        	        $insert_array['franchise_tranfer_id'] = $Franchisepay['tranfer_id'];
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
	       
            // ============== aviansys transfer ================== //
	        if($aviansys_split=='yes'){
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
               
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$Aviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
    	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
        	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
    	            }
	            }
	        }
            // ====== end ===== //
            
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $resultpay = $query->row();
            
                if(!empty($resultpay)){
                    // print_r($insert_arra);die;
    	            $insert_array['date_of_payment'] = date("Y-m-d");
    	            $insert_array['school_amount'] = $school_fix;
                    $this->db->insert('payment_split_prid',$insert_array);
                }
        
		 $this->db->select('*');
         $this->db->from('cart_prid');
         $this->db->where('prid',$_SESSION['payment_data']['prid']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
		$school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
		$it=explode("MREG",$_SESSION['payment_data']['prid']);
		
		$this->db->where('prid', $_SESSION['payment_data']['prid']);
        $this->db->order_by('id', 'DESC');
        $qqq = $this->db->get('product_purchase')->row();

		$who=$qqq->who;
		if($who ==''){
		    $who=0;
		}else{
		    $who=$who;
		}    
		    
		foreach($res as $row){
		    $who=$who+1;
		    $pr_ini= $this->db->get_where('products',array('product_name'=>$row['product']))->row();
		    $ini=$pr_ini->in13;
		    
		    $cin=$it[0].$ini.$school->area_code.$who.$it[1];
		    if($it[0]=='24'){
		        $period_id='14';
		    }
		    if($it[0]=='25'){
		        $period_id='15';
		    }
		    if($it[0]=='26'){
		        $period_id='16';
		    }
		    if($it[0]=='27'){
		        $period_id='17';
		    }if($it[0]=='28'){
		        $period_id='18';
		    }
		    if($it[0]=='29'){
		        $period_id='19';
		    }
		    if($it[0]=='30'){
		        $period_id='20';
		    }
		    $ar=array(
		        'product_name'=>$row['product'],
		        'prid'=>$_SESSION['payment_data']['prid'],
		        'period_id'=>$period_id,
		        'amount'=>$row['amount'],
		        'payment_id'=>$data['razorpay_order_id'],
		        'cin'=>$cin,
		        'who'=>$who,
		        'student_name'=>$row['name']
		        );
		    $this->db->insert('product_purchase',$ar);
		    
		    $arr=array(
		        'cin'=>$cin,
		        'password'=>$cin,
		        'period_id'=>$period_id,
		        'student_name'=>$row['name'],
		        'franchise_id'=>$franchise_id,
		        'franchise_code'=>$school->area_code,
		        'address1'=>$student->address1,
		        'address2'=>$student->address2,
		        'stud_email'=>$student->email,
		        'stud_phone'=>$student->mobile,
		        'class'=>$row['class'],
		        'father_name'=>$student->father_name,
		        'mother_name'=>$student->mother_name,
		        'school_id'=>$school_id,
		        'state_id'=>$state_id,
		        'status'=>'Active',
		        'gender'=>$student->gender
		        
		        );
		    if($row['product']=='MaRRS Lunar Olympiads'){
		        
		        $lev = $this->db->get_where('product_to_school',array('school_id' =>$school_id,'period_id'=>$student->period_id,'product_name'=>'MaRRS Lunar Olympiads'))->row();
	        
		        
		        $arr['subject']=$lev->subject;
		        $arr['series']=$lev->series;
		        $arr['level_id']=$lev->level_id;
		        $this->db->insert('lunar_cin_list',$arr);
		    }else{      
		        $this->db->insert('cin_list',$arr); 
		    }
		}
		
		
    		$this->db->where('prid',$_SESSION['payment_data']['prid']);
    		$this->db->delete('cart_prid');
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);   
        	$query=$this->db->get();
        	$data['cins']=$query->result();
        
        if(empty($data['cins'])){
            $this->load->view('loader');
        }else{
            $this->load->view('success3', $data);
        }	
        	
        
        //die;
	}
	
	public function paymentFailed3()
	{
	    $data = $this->session->userdata('payment_data');
    // 	$cin = $data['prid'];
        
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       $this->db->where('prid',$_SESSION['payment_data']['prid']);
	    $this->db->delete('cart_prid');  
        $this->load->view('tranctionfailed3', $data);
	}
    
    
    // ======================== start ======================== //
    
    public function pay3_new()
	{
	    
	    
	    
	    $prid=$_POST['prid'];
	    
	   // if($_SESSION['payment_data']['amount'] == 0){
	   //     redirect(base_url().'razorpay/success3'); 
	   // }
	   // echo '<pre>';
	   // print_r($_POST);die;
	    
	    $cart_data= $this->db->get_where('cart_prid',array('prid'=>$prid))->row();
	   // $amount=0;
	   // foreach($cart_data as $row){
	        $amount = $cart_data->amount;
	   // }
	   // $amount=10;
	   
	    $stuent=$this->db->get_where('students',array('PRID'=>$prid))->row();
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
// 		$stud_phone = $student->mobile;
// 		$stud_email = $student->email;
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
	    $amount =	$amount * 100; 
	   //$amount=500;
		$cin  = $_POST['cin'];
        
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		
		$Pay_array = array(
		
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'prid'               =>$prid,
    		
		);
		
		$this->db->where('prid',$prid);
		$this->db->update('cart_prid',array('payment_order_id'=>$razorpayOrderId));
		
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay3_new',array('data' => $data));
	}
    
    public function verify3_new()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
			redirect(base_url().'razorpay/success3_test_free_new'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed3_new');
		}
	}
    
    public function paymentFailed3_new()
	{
	    $data = $this->session->userdata('payment_data');
    // 	$cin = $data['prid'];
        
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       $this->db->where('prid',$_SESSION['payment_data']['prid']);
	    $this->db->delete('cart_prid');  
        $this->load->view('tranctionfailed3', $data);
	}
    
    public function success3_test_free_new()
	{   
	   // print_r($_SESSION);die;
	    
	        $data = $this->session->userdata('payment_data');
	    
	        $data['student'] = $student = $this->db->get_where('students',array('PRID' =>$data['prid']))->row();
	        // echo $this->db->last_query();
	        
	       // print_r($student);die;
	        
	        $state_id=$student->state;
	        $school_id=$student->school_id;
	   
	        $state_id=$student->state;
	        $period_id=$student->period_id;
	       
	            
	        $insert_array=array();
	        $manage = $this->db->get_where('gst_account_marrs',array('account_name'=>$cart_data->marrsmanage_razorpay_name))->row();
	        $cart_data = $this->db->get_where('cart_prid',array('prid'=>$student->PRID))->row();
	       
        
		    $school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
		    $it=explode("MREG",$student->PRID);
		  
		    
		    $pr_ini = $this->db->get_where('products',array('product_name'=>$cart_data->product))->row();
		    $ini = $pr_ini->in13;
		    
		    $cin = $it[0].$ini.$school->area_code.'5'.$it[1];
		    
		    $registration = $this->db->get_where('product_to_school_mid',array('school_code'=>$student->registration_code))->row();
		    $competition = $this->db->get_where('competition_product_state',array('id'=>$registration->comp_id))->row();
		  
		    
		    $ar=array(
		        'prid'=>$cart_data->prid,
		        'product_name'=>$cart_data->product,
		        'period_id'=>$period_id,
		        'amount'=>$cart_data->amount,
		        'cin'=>$cin,
		        'payment_id'=>$data['razorpay_order_id'],
		        'who'=>0,
		        'student_name'=>$cart_data->name,
		        'clevel'=>$registration->level_id,
		        'subject'=>$registration->subject,
		        'series'=>$registration->series,
		        'varient'=>$registration->varient,
		        'type'=>''
		    );
		        
		  //  print_r($ar);die;
		  
		  
		    $purchase_mid = $this->db->get_where('product_purchase_mid',array('prid'=>$cart_data->prid,'payment_id'=>$data['razorpay_order_id']))->row();
		    
		    if(empty($purchase_mid)){    
                $this->db->insert('product_purchase_mid',$ar);
		    }
		    
	        
		    $arr=array(
		        'cin'=>$cin,
		        'password'=>$cin,
		        'period_id'=>$period_id,
		        'student_name'=>$cart_data->name,
		        'franchise_id'=>$registration->franchise_id,
		        'franchise_code'=>$school->area_code,
		        'address1'=>$student->address1,
		        'address2'=>$student->address2,
		        'stud_email'=>$student->email,
		        'stud_phone'=>$student->mobile,
		        'class'=>$student->class,
		        'father_name'=>$student->father_name,
		        'mother_name'=>$student->mother_name,
		        'school_id'=>$school_id,
		        'state_id'=>$state_id,
		        'status'=>'Active',
		        'gender'=>$student->gender,
		        'prid'=>$student->PRID,
		        
		    );
		    $cin_list = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
		    
		    if(empty($cin_list)){    
                $this->db->insert('cin_list',$arr); 
		    }
		    
		    $levels = $this->db->get_where('competition_level_byproduct',array('product_name'=>$cart_data->product,'level_id <'=>$registration->level_id))->result();
		    foreach($levels as $level){
    		    $araa=array(
        		        'cin'=>$cin,
        		        'period_id'=>$period_id,
        		        'product_name'=>$cart_data->product,
        		        'clevel'=>$level->level_id,
        		        'show'=>'skip',
        		        'status'=>'Q'
    		        );
    		  //  print_r($araa);die;
    		        $cin_relist = $this->db->get_where('cin_result',array('cin'=>$cin,'clevel'=>$level->level_id))->row();
            		if(empty($cin_relist)){    
                        $this->db->insert('cin_result',$araa);
        		    }
		    }
		        
                    
                    
		        $arrrrrr=array(
    		        'cin'=>$cin,
    		        'period_id'=>$period_id,
    		        'product_name'=>$cart_data->product,
    		        'clevel'=>$registration->level_id,
    		        'status'=>'Paid',
    		        'comp_date'=>$competition->close_date
		        );
		  //  print_r($arrrrrr);die; 
		        $new = $this->db->get_where('new_cart',array('cin'=>$cin,'clevel'=>$registration->level_id))->row();
        		if(empty($new)){    
                    $this->db->insert('new_cart',$arrrrrr);
    		    }
		    
		    
		        $comp = $this->db->get_where('competition_product_state',array('product_name'=>$cart_data->product,'period_id'=>$period_id,'clevel'=>$registration->level_id))->row();
		        $arrrw=array(
    		        'cin'=>$cin,
    		        'comp_id'=>$comp->id
		        );
		        $ncom = $this->db->get_where('new_cart',array('cin'=>$cin,'comp_id'=>$comp->id))->row();
        		if(empty($ncom)){    
                    $this->db->insert('cin_uploade',$arrrw);
    		    }
		    
		    
		        $pay=[
                    'prid'=>$cart_data->prid,
                    'product_name'=>$cart_data->product,
                    'marrs_gst'=>$cart_data->marrs_gst,
                    'name'=>$cart_data->name,
                    'class'=>$cart_data->class,
                    'school_amount'=>$cart_data->school_amount,
                    
                    
                    'maker_razorpay_name'=>$cart_data->maker_razorpay_name,
                    'maker_razorpay_id'=>$cart_data->maker_razorpay_id,
                    'franchise_account_id'=>$cart_data->franchise_account_id,
                    'franchise_razorpay_name'=>$cart_data->franchise_razorpay_name,
                    
                    'associate_id'=>$cart_data->associate_id,
                    'associate_account_id'=>$cart_data->associate_account_id,
                    'associate_razorpay_name'=>$cart_data->associate_razorpay_name,
                    'crm_account_id'=>$cart_data->crm_account_id,
                    
                    'crm_razorpay_name'=>$cart_data->crm_razorpay_name,
                    // 'marrsgst_account_id'=>$cart_data->marrsgst_account_id,
                    'marrsmanage_razorpay_name'=>$cart_data->marrsmanage_razorpay_name,
                    'marrsmanage_rozarpay_id'=>$manage->rozarpay_id,
                    'aviansys_account_id'=>$cart_data->aviansys_account_id,
                    'aviansys_razorpay_name'=>$cart_data->aviansys_razorpay_name,
                    
                    
                    'inserted_time' => $cart_data->inserted_time,
                    'inserted_date' => $cart_data->inserted_date,
                    'cin'=>$cin,
                    'clevel'=>$registration->level_id,
                    'total_amount'=>$cart_data->amount,
                    'franchise_amount'=>$cart_data->franchise_amount,
                    // 'franchise_tranfer_id'=>'',
                    'franchise_id'=>$registration->franchise_id,
                    'payment_id'=>$data['razorpay_order_id'],
                    'aviansys_amount'=>$cart_data->aviansys_amount,
                    'gst_amount'=> $cart_data->marrs_gst + $cart_data->franchise_gst + $cart_data->aviansys_gst,
                    'comp_id'=>$competition->id,
                    // 'aviansys_tranfer_id'=>'',
                    // 'gst_tranfer_id'=>'',
                    'razpay_service'=>$cart_data->razpay_service,
                    'crm_fix'=>$cart_data->crm_fix,
                    // 'crm_fix_tranfer_id'=>'',
                    'MaRRS_bal'=>$cart_data->marrs_left,
                    'date_of_payment'=>date('Y-m-d'),
                    'management_amount'=>$cart_data->manage_amount,
                    // 'management_tranfer_id'=>'',
                    'franchise_gst'=>$cart_data->franchise_gst,
                    'aviansys_gst'=>$cart_data->aviansys_gst,
                    'status'=>0,
                    // 'maker_id'=>$cart_data->maker_id,
                    'total_maker_amount'=>$cart_data->free_mat_royalty,
                    // 'maker_transfer_id'=>'',
                    'associate_gst'=>$cart_data->associate_gst,
                    // 'associate_tranfer_id'=>'',
                    'associate_amount'=>$cart_data->associate_amount,
	            ];
	            
		        
    		    
    		    $webhook = $this->db->get_where('webhook_calls',array('payment_id'=>$data['razorpay_order_id']))->row();
    		    
    		    if(empty($webhook)){
    		        $this->db->insert('webhook_calls',$pay);
    		    }
    		    
        		$this->db->where('prid',$student->PRID);
        		$this->db->delete('cart_prid');
        
        
                $full_name = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
    
                $message = "<p>Dear {$full_name},</p>
                    
                    <p>We're excited to have you registered for our competitions!</p>
                    
                    <p><strong>Below are your Candidate Identification Numbers (CINs) for the products you've enrolled in:</strong></p>
                    <ul>";
                    
                    
                        $message .= "<li><strong>{$cart_data->product}</strong>: {$cin}</li>";
                    
                    
                    $message .= "</ul>
                    
                    <p>This CIN will serve as your primary identification throughout the competition, right up to its conclusion. It's crucial to save your CIN securely as it's required for several essential activities, including:</p>
                    
                    <ul>
                        <li>Accessing and downloading learning materials</li>
                        <li>Participating in online competitions</li>
                        <li>Viewing your results</li>
                        <li>Downloading your digital certificates</li>
                    </ul>
                    
                    <p>Please mention your CIN whenever requesting any competition-related service.</p>
                    
                    <p>You can now access the participant portal at: <a href='https://marrs.in/' target='_blank'>https://marrs.in/</a><br>
                    Use your CIN as both <strong>username</strong> and <strong>password</strong> to log in.</p>
                    
                    <p><em>Because First Steps Last! The healthy competitive spirit motivates the students to learn on their own without any compulsion.</em></p>";
    

            
                $data = array(
                    'email' => $student->email,
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
       
                $data['cins']=[
                    'cin' => $cin,
                    'product_name' => $cart_data->product,
                    'payment_id' => $data['razorpay_order_id']
                ];  
                
        // $ret=$this->webhooksplit();
        // print_r($ret);
        // echo 'okkk';
        // die;
        
        $this->load->view('success6', $data);
	}
    
    public function webhooksplit() {
        
        // Webhook secret from Razorpay Dashboard
        $webhookSecret = "alkanairwebhook";

        // Get raw body from Razorpay
        //$rawData = file_get_contents("php://input");

        // Get signature from header
        //$signature = $this->input->get_request_header('X-Razorpay-Signature');
     
     
        $rawData = file_get_contents("php://input");

        // Log for debugging
        file_put_contents(APPPATH . 'logs/webhook.log', date("Y-m-d H:i:s") . " RAW: " . $rawData . PHP_EOL, FILE_APPEND);

        // Decode JSON
        $data = json_decode($rawData, true);

        // Log parsed data
        file_put_contents(APPPATH . 'logs/webhook.log', date("Y-m-d H:i:s") . " Parsed: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

        // Example: verify Razorpay signature if needed
        // $signature = $this->input->get_request_header('X-Razorpay-Signature');
        $signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'] ?? '';
        
        if (!empty($signature)) {
            $expected = hash_hmac('sha256', $rawData, $webhookSecret);

            if (hash_equals($expected, $signature)) {
                // Signature valid
                file_put_contents(APPPATH . 'logs/webhook.log', "✅ Signature verified" . PHP_EOL, FILE_APPEND);

                // Do something with $data
                if (isset($data['event']) && $data['event'] === "payment.captured") {
                    print_R($data['event']);die;
                    // Example: save payment id
                    $payment_id = $data['payload']['payment']['entity']['id'];
                    // TODO: save to DB
                }
            } else {
                file_put_contents(APPPATH . 'logs/webhook.log', "❌ Invalid signature" . PHP_EOL, FILE_APPEND);
            }
        } else {
            file_put_contents(APPPATH . 'logs/webhook.log', "❌ No signature header found" . PHP_EOL, FILE_APPEND);
        }

        // Respond 200 to Razorpay
        http_response_code(200);
        print_r($data);
        return $data;
    }
    // ====================== end ============================ //	
    public function pay4()
	{
	    $prid=$_POST['prid'];
	    
	    
	    $cart_data= $this->db->get_where('cart_prid_child',array('prid'=>$prid))->result();
	    $amount=0;
	    foreach($cart_data as $row){
	        $amount=$amount+$row->amount;
	    }
	   
	    $stuent=$this->db->get_where('students',array('PRID'=>$prid))->row();
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
// 		$stud_phone = $student->mobile;
// 		$stud_email = $student->email;
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
	    $amount =	$amount*100; 
	   //$amount=500;
		$cin  = $_POST['cin'];
        
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		
		$Pay_array = array(
		
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'prid'               =>$prid,
    		
		);
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay4',array('data' => $data));
	}
    
    public function verify4()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
			redirect(base_url().'razorpay/success4'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed4');
		}
	}
    
    public function success4()
	{   
	    $data = $this->session->userdata('payment_data');
	    $child = $this->session->userdata('child');
	   //print_r($child);die;
	       $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       // echo $this->db->last_query();
	       $state_id=$student->state;
	        $school_id=$student->school_id;
	       // echo $school_id.' '.$state_id;
	        
	        
	        $this->db->select('*');
	        $this->db->from('franchise');
	        $this->db->where('state_id',$state_id);
	        $this->db->where('account_id !=','');
	        $query=$this->db->get();
	        $masterfranchise = $query->row();
	        $franchise_id=$masterfranchise->franchise_id;
	        
	        $fracnhise = $this->db->get_where('product_to_school',array('school_id' =>$school_id,'period_id'=>$student->period_id))->row();
	        
	       // print_r($fracnhise);die;
	        $fracnhise_per= $fracnhise->franchise_per;
	        $aviansys_per = '20';
	       $school_fix=$fracnhise->school_amount;
	        
	        $total_amount=$data['amount']/100;
	        
	        $Base_GR=$data['amount']/100;
	       // $Base_GR=1000;
	        
	        $Base_G=round($Base_GR/1.03);
	        $Base_cost1 = round($Base_G/1.18); 
	        
	        $GST = round($Base_cost1 * 0.18);           // GST account money  
	        
	        $Base_cost2=$Base_cost1-$school_fix;
	        
	        
	        $Aviasys_pay = round($Base_cost2 * 18/100);     // payment made to aviansys per user transaction
	        
	        $management_pay = round($Base_cost2 * 5/100);   // management 5 %
	        $Franchise_cal = round ($Base_cost2 * $fracnhise->franchise_per/100);   // payment made to franchise per user transaction
	        $Franchise_pay=$Franchise_cal+$school_fix;
	       // echo $Franchise_pay;die;
	        $razpay_service=$Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
	        
	      if(!empty($fracnhise_per)){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	             $abc = $fracnhise_per/100;
	          $GST_fr =round($GST*$abc);
	          
	        }
	        if(!empty($aviansys_per)){
	          $GST_Av =round($GST*$aviansys_per/100);
	        }
	        
	         $RemainingGST = round($GST-$GST_fr-$GST_Av);
	        
	       // $MaRRS_bal=$Base_cost1-($Aviasys_pay+$Franchise_pay+$management_pay);      // balance to marrs account
	        
	        $aviansys_split='yes';
	        $franchise_split='yes';
	       // echo 'Total=>'.$Base_GR.' Rz Pay '.$razpay_service.' Base_cost=>'.$Base_cost2.' GST_cost=>'.$GST.' Aviansys_18%_cost2=>'.$Aviasys_pay.' Franchise_60%_cost2=>'.$Franchise_pay.' Management Pay 5% => '.$management_pay.' school fix '.$school_fix.' MaRRS Bal '.$MaRRS_bal;die;
	       
	        $gst_amt=$GST*100;
	        //die;
	        $insert_array=array();
	        $insert_array['franchise_id'] = $franchise_id;
            // $insert_array['clevel'] = $data['clevel'];
            $insert_array['prid'] = $_SESSION['payment_data']['prid'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['school_id'] =$school_id;
            $insert_array['razpay_service'] =$razpay_service;
            $insert_array['MaRRS_bal'] =$MaRRS_bal;
            //echo $gst_amount;die;
            
            
            // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$management_pay*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
            
            
            // ============== gst transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('gst_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $gst_account_id=$gst->rozarpay_id;
        	        $gst_razorpay_name=$gst->account_name;
        	        //echo $gst_account_id;die;
        	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$gst_amt,$gst_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($gst_pay['tranfer_id'])){
                    $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
            	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
    	    
	       // ============== franchise transfer ================== //
	        if($franchise_split=='yes'){
	            
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_tranfer_id !=','');
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	            $franchiseaccount_id=$franchise->account_id;
    	            $franchiseaccount_razorpay_name=$franchise->account_razorpay_name;
    	            $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$Franchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
        	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
        	        $insert_array['franchise_tranfer_id'] = $Franchisepay['tranfer_id'];
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
	       
            // ============== aviansys transfer ================== //
	        if($aviansys_split=='yes'){
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
               
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$Aviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
    	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
        	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
    	            }
	            }
	        }
            // ====== end ===== //
            
            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $resultpay = $query->row();
            
                if(empty($resultpay)){
    	            $insert_array['date_of_payment'] = date("Y-m-d");
    	            $insert_array['school_amount'] = $school_fix;
                    $this->db->insert('payment_split_prid',$insert_array);
                }
        
		 $this->db->select('*');
         $this->db->from('cart_prid_child');
         $this->db->where('prid',$_SESSION['payment_data']['prid']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
		$school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
		$it=explode("MREG",$_SESSION['payment_data']['prid']);
		$r=rand(10,99);
		
// 	echo $r;die;
	
		foreach($res as $row){
		    $pr_ini= $this->db->get_where('products',array('product_name'=>$row['product']))->row();
		    $ini=$pr_ini->in13;
		    
		    $cin=$it[0].$ini.$school->area_code.$r.$it[1];
		  //  echo $cin;die;
		    if($it[0]=='24'){
		        $period_id='14';
		    }
		    if($it[0]=='25'){
		        $period_id='15';
		    }
		    if($it[0]=='26'){
		        $period_id='16';
		    }
		    if($it[0]=='27'){
		        $period_id='17';
		    }if($it[0]=='28'){
		        $period_id='18';
		    }
		    
		    $nm = str_replace('-', ' ', $child['name']);
		    
		    $arr=array(
		        'cin'=>$cin,
		        'password'=>$cin,
		        'period_id'=>$period_id,
		        'student_name'=>$nm,
		        'franchise_id'=>$franchise_id,
		        'franchise_code'=>$school->area_code,
		        'address1'=>$student->address1,
		        'address2'=>$student->address2,
		        'stud_email'=>$student->email,
		        'stud_phone'=>$student->mobile,
		        'class'=>$child['class'],
		        'father_name'=>$student->father_name,
		        'mother_name'=>$student->mother_name,
		        'school_id'=>$school_id,
		        'state_id'=>$state_id,
		        'status'=>'Active',
		        'gender'=>$child['gender']
		        
		        );
		  //  print_r($arr);die;      
		    
		    
		    
		    $ar=array(
		        'product_name'=>$row['product'],
		        'prid'=>$_SESSION['payment_data']['prid'],
		        'period_id'=>$period_id,
		        'amount'=>$row['amount'],
		        'payment_id'=>$data['razorpay_order_id'],
		        'cin'=>$cin,
		        'who'=>'1',
		        'student_name'=>$nm,
		        );
		    $this->db->insert('product_purchase',$ar);
		    
		    
		    $this->db->insert('cin_list',$arr);      
		}
		
		$data['child']=$child;
		$this->db->where('prid',$_SESSION['payment_data']['prid']);
		$this->db->delete('cart_prid_child');
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);   
        	$query=$this->db->get();
        	$data['cins']=$query->result();
        $this->load->view('success4', $data);
        //die;
	}
	
	public function paymentFailed4()
	{
	    $data = $this->session->userdata('payment_data');
    // 	$cin = $data['prid'];
        
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	    $this->db->where('prid',$_SESSION['payment_data']['prid']);
	    $this->db->delete('cart_prid_child');    
        $this->load->view('tranctionfailed4', $data);
	}
	
	// ====================== end ============================ //	
	
	public function pay5()
	{
	    $prid=$_POST['prid'];
	    //print_r($_POST);die;
	    
	    $cart_data= $this->db->get_where('cart_prid',array('prid'=>$prid))->result();
	   // $amount=0;
	   // foreach($cart_data as $row){
	   //     $amount=$amount+$row->amount;
	   // }
	    $amount=10;
	   
	    $stuent=$this->db->get_where('students',array('PRID'=>$prid))->row();
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
// 		$stud_phone = $student->mobile;
// 		$stud_email = $student->email;
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
	    $amount =	$amount*100; 
	   //$amount=500;
		$cin  = $_POST['cin'];
        
    	$curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount":'.$amount.',
          "currency": "INR"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		
		$Pay_array = array(
		
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'prid'               =>$prid,
    		
		);
 		//print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay5',array('data' => $data));
	}
    
    public function verify5()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		$order_id = $razorpay_order_id['razorpay_order_id'];
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === true) {
			$api = new Api('rzp_live_kG7f8nF6sKGPhx','68nusLbguizulOSBn47VpfmS');
		try {
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = true;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
			redirect(base_url().'razorpay/success5'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed5');
		}
	}
    
    public function success5()
	{   
	    $data = $this->session->userdata('payment_data');
	   //print_r($_SESSION);die;
	       $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       // echo $this->db->last_query();
	       $state_id=$student->state;
	        $school_id=$student->school_id;
	       // echo $school_id.' '.$state_id;
	        
	        
	        $this->db->select('*');
	        $this->db->from('franchise');
	        $this->db->where('state_id',$state_id);
	        $this->db->where('account_id !=','');
	        $query=$this->db->get();
	        $masterfranchise = $query->row();
	        $franchise_id=$masterfranchise->franchise_id;
	        
	        $fracnhise = $this->db->get_where('product_to_school',array('school_id' =>$school_id,'period_id'=>$student->period_id))->row();
	        
	       //print_r($fracnhise);die;
	       
	       $school_fix=$fracnhise->school_amount;
	       
	        $total_amount=$data['amount']/100;
	        
	        $Base_GR=$data['amount']/100;
	       // $Base_GR=1000;
	        
	        $Base_G=round($Base_GR/1.03);
	        $Base_cost1 = round($Base_G/1.18); 
	        
	        $GST = round($Base_cost1 * 0.18);           // GST account money  
	        
	        $Base_cost2=$Base_cost1-$school_fix;
	        
	        
	        $Aviasys_pay = round($Base_cost2 * 18/100);     // payment made to aviansys per user transaction
	        
	        $management_pay = round($Base_cost2 * 5/100);   // management 5 %
	        $Franchise_cal = round ($Base_cost2 * $fracnhise->franchise_per/100);   // payment made to franchise per user transaction
	        $Franchise_pay=$Franchise_cal+$school_fix;
	       // echo $Franchise_pay;die;
	        $razpay_service=$Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
	        
	        $MaRRS_bal=$Base_cost1-($Aviasys_pay+$Franchise_pay+$management_pay);      // balance to marrs account
	        
	        $aviansys_split='yes';
	        $franchise_split='yes';
	       // echo 'Total=>'.$Base_GR.' Rz Pay '.$razpay_service.' Base_cost=>'.$Base_cost2.' GST_cost=>'.$GST.' Aviansys_18%_cost2=>'.$Aviasys_pay.' Franchise_60%_cost2=>'.$Franchise_pay.' Management Pay 5% => '.$management_pay.' school fix '.$school_fix.' MaRRS Bal '.$MaRRS_bal;die;
	       
	        $gst_amt=$GST*100;
	        //die;
	        $insert_array=array();
	        $insert_array['franchise_id'] = $franchise_id;
            // $insert_array['clevel'] = $data['clevel'];
            $insert_array['prid'] = $_SESSION['payment_data']['prid'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $total_amount;
            $insert_array['school_id'] =$school_id;
            $insert_array['razpay_service'] =$razpay_service;
            $insert_array['MaRRS_bal'] =$MaRRS_bal;
            //echo $gst_amount;die;
            
            
            // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('management_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $manage = $this->db->get_where('gst_account_marrs',array('id' =>'3'))->row();
        	        $manage_account_id=$manage->rozarpay_id;
        	        $manage_razorpay_name=$manage->account_name;
        	        //echo $gst_account_id;die;
        	        $manage_pay=$this->fetch($data['razorpay_order_id'],$manage_account_id,$management_pay*100,$manage_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($manage_pay['tranfer_id'])){
                    $insert_array['management_amount'] = $manage_pay['tranfer_amount']/100;
            	    $insert_array['management_tranfer_id'] = $manage_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
            
            
            // ============== gst transfer ================== //
                $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('gst_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
	        
    	        if(empty($resultt)){
                
        	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $gst_account_id=$gst->rozarpay_id;
        	        $gst_razorpay_name=$gst->account_name;
        	        //echo $gst_account_id;die;
        	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$gst_amt,$gst_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($gst_pay['tranfer_id'])){
                    $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
            	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
        	        }
    	        }     
    	    // ====== end ===== //
    	    
	       // ============== franchise transfer ================== //
	        if($franchise_split=='yes'){
	            
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_tranfer_id !=','');
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	            $franchiseaccount_id=$franchise->account_id;
    	            $franchiseaccount_razorpay_name=$franchise->account_razorpay_name;
    	            $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$Franchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
        	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
        	        $insert_array['franchise_tranfer_id'] = $Franchisepay['tranfer_id'];
        	        }
    	        
	            }
	        }
	       // ====== end ===== // 
	       
            // ============== aviansys transfer ================== //
	        if($aviansys_split=='yes'){
	            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
               
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	            $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$Aviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
    	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
        	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
    	            }
	            }
	        }
            // ====== end ===== //
            
            $this->db->select('*');
                $this->db->from('payment_split_prid');
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $resultpay = $query->row();
            
                if(empty($resultpay)){
    	            $insert_array['date_of_payment'] = date("Y-m-d");
    	            $insert_array['school_amount'] = $school_fix;
                    $this->db->insert('payment_split_prid',$insert_array);
                }
        
		 $this->db->select('*');
         $this->db->from('cart_prid');
         $this->db->where('prid',$_SESSION['payment_data']['prid']);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res= $query->result_array();
         //print_r($res);
		$school= $this->db->get_where('school_new',array('id'=>$school_id))->row();
		//print_r($school);
		$it=explode("MREG",$_SESSION['payment_data']['prid']);
		
		$this->db->where('prid', $_SESSION['payment_data']['prid']);
        $this->db->order_by('id', 'DESC');
        $qqq = $this->db->get('product_purchase')->row();
         
        $prid_student = $this->db->get_where('product_purchase',array('PRID',$_SESSION['payment_data']['prid']))->row(); 
        $name=$prid_student->first_name.' '.$prid_student->middle_name.' '.$prid_student->last_name;
		$who=$qqq->who;
// 		if($who ==''){
// 		    $who=1;
// 		}else{
// 		    $who=$who;
// 		}    
		    
		$stud=array();
		foreach($res as  $valuewp){
		    
		    if($valuewp['name'] == $name){
		        $who=0;
		    }else{
		        $who=$who+1;
		    }
		    
		    $pr_ini= $this->db->get_where('products',array('product_name'=>$valuewp['product']))->row();
		    $ini=$pr_ini->in13;
		   // print_r($it[1]+1);die;
		    $cin=$it[0].$ini.$school->area_code.$who.$it[1];
		    if($it[0]=='24'){
		        $period_id='14';
		    }
		    if($it[0]=='25'){
		        $period_id='15';
		    }
		    if($it[0]=='26'){
		        $period_id='16';
		    }
		    if($it[0]=='27'){
		        $period_id='17';
		    }if($it[0]=='28'){
		        $period_id='18';
		    }
		    
		     
    		  $ar=array(
		        'product_name'=>$valuewp['product'],
		        'prid'=>$_SESSION['payment_data']['prid'],
		        'period_id'=>$period_id,
		        'amount'=>$valuewp['amount'],
		        'payment_id'=>$data['razorpay_order_id'],
		        'cin'=>$cin,
		        'who'=>$who,
		        'student_name'=>$valuewp['name'],
		        'clevel'=>'1'
		        );
        		    $this->db->insert('product_purchase',$ar);
        		    
        		    $arr=array(
        		        'cin'=>$cin,
        		        'password'=>$cin,
        		        'period_id'=>$period_id,
        		        'student_name'=>$valuewp['name'],
        		        'franchise_id'=>$franchise_id,
        		        'franchise_code'=>$school->area_code,
        		        'address1'=>$student->address1,
        		        'address2'=>$student->address2,
        		        'stud_email'=>$student->email,
        		        'stud_phone'=>$student->mobile,
        		        'class'=>$valuewp['class'],
        		        'father_name'=>$student->father_name,
        		        'mother_name'=>$student->mother_name,
        		        'school_id'=>$school_id,
        		        'state_id'=>$state_id,
        		        'status'=>'Active',
        		        'gender'=>$student->gender
        		        
        		        );
        		        //print_r($arr);die;
        		    $this->db->insert('cin_list',$arr);
    		        $arr=array('cin'=>$cin,
    		            'name'=>$valuewp['name']
    		        );
    		    array_push($stud,$arr);
		          
		}
		
		
    		$this->db->where('prid',$_SESSION['payment_data']['prid']);
    		$this->db->delete('cart_prid');
    
            $this->db->select('*');
            $this->db->from('product_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);   
        	$query=$this->db->get();
        	$data['cins']=$query->result();
        	
        	
            $competitionName = "MaRRS School Level Registration 2024-25";

            $message = "Thank you for registering for " . $competitionName . ".\n\n";
            $message .= "Here are the details of your registration:\n\n";
            
            foreach ($stud as $student) {
                $message .= "Name: " . $student['name'] . "\n";
                $message .= "Your Candidate Identification Number (CIN) is: " . $student['cin'] . "\n";
                
            }
            
            
            $message .= "Please log on to Marrs CIN Login using the CIN as the username and password.\n\n";
            $message .= "You will be able to download the Learning Materials.";

    		$data = array(
                    'email' => $data['email'],
                    'otp' =>'',
                    'message' =>$message
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
        
        	
        $this->load->view('success5', $data);
        //die;
	}
	
	public function paymentFailed5()
	{
	    $data = $this->session->userdata('payment_data');
    // 	$cin = $data['prid'];
        
        $data['amount']=$data['amount'];
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$this->session->userdata('payment_data');
        $data['student']= $student = $this->db->get_where('students',array('PRID' =>$_SESSION['payment_data']['prid']))->row();
	       $this->db->where('prid',$_SESSION['payment_data']['prid']);
	    $this->db->delete('cart_prid');  
        $this->load->view('tranctionfailed3', $data);
	}
	
	public function success_api()
	{
	
	    $json_data = file_get_contents('php://input');
        $item = json_decode($json_data, true);
	    print_r($item);die;
	    
    }


   



    
	
}
