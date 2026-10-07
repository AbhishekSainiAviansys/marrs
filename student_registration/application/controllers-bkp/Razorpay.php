 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Razorpay extends CI_Controller {
	 public function __construct() {
        parent::__construct();
		$this->load->model('newmodel');
        $this->load->model('zoommodel');
	   $this->load->library('session');
		
	 }

	
	public function index()
	{
		$this->load->view('registration-form');
	}


	 	public function zoompay()
	{
	    
		$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
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
	 
	 public function verifypz()
	{
		 
		$razorpay_order_id = $this->session->userdata('payment_data');
		//echo 'aaa';print_r($razorpay_order_id);exit;
		$order_id = $razorpay_order_id['razorpay_order_id'];
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
		$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
		//print_r($_POST);exit; 
		//$amount = 1;
	    $amount =	$_POST['amount'];    
		$cin  = $_POST['cin'];
        $product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		$price_code = $_POST['price_code'];
		
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
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay',array('data' => $data));
	}

//-----------------Start statwise---------------//
public function statepay()
	{
		$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
		
		//print_r($_POST);exit; 
		//$amount = 1;        
	    $amount =	$_POST['amount']; 
		$cin  = $_POST['cin'];
        $product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email  = $_POST['email'];
		$stud_phone = $_POST['contact'];
		$price_code = $_POST['price_code'];
		
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
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('razorpay',array('data' => $data));
	}
//-----------------end statwise---------------//





	public function interlevel()
	{ 
		$api = new Api('rzp_live_UMziCF38129HCi', 'nMj5U0daHbD6KxINizRDg8m6');
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
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api('rzp_live_UMziCF38129HCi','nMj5U0daHbD6KxINizRDg8m6');
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
        $statid = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
		if($statid->state_id=='14686'){ 
			//echo '---';exit;
			 $this->newmodel->cart_newstate($cin,$data,$statid->state_id);  
			 $this->db->where('cin',$cin);
             $this->db->delete('statewise_addtocart');    
			 
			 
		}else{
			
        $data = $this->session->userdata('payment_data');
		//print_r($data);exit;
		$cin=$data['cin'];
	    $insertt = $this->newmodel->cart_new($cin,$data);
		if(!empty($insertt)){
			
			
			/* $competition = $this->db->get_where('competition_product_state',array('cin'=>$cin))->row();
			$this->load->library('email'); 		
			$message='Thank You Registration.<br>CIN :'.$cin.'<br> Study Material :'.$study_material.'<br> orientation : '.$orientation.'<br> Mock Test : '.$mocktest;
            $this->email->from('enquiry@marrs.in', 'MaRRS');   
            $to_email = $data['email'];	 
            $this->email->to($to_email);   
            $this->email->subject('MaRRS interschool Competition Registration');  
            $this->email->message($message);
            if($this->email->send()){
			 $this->session->set_flashdata('verify', 'Email Verification link sent on email Successfully.');
				} 
				else
				   {
				 $this->session->set_flashdata('error', 'Email Not Valid .');	  		 
				 }
			}
			 */
			       
			
        $this->db->where('cin', $cin);
        $this->db->delete('amount_cart');
		}
        $data['student']=$this->newmodel->get_student_data($cin);
		}
		
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
	
	
	
	
		public function fetch()
	{
	  $res = $this->db->get_where('cart',array('prid' =>$this->session->userdata('prid')))->row();
	  $res2 = $this->db->get_where('new_cart',array('cin' =>$this->session->userdata('cin')))->row();
	 
	 if(!empty($res->merchant_order_id)){ $order_id = $res->merchant_order_id; $amount = $res->amount;  }
	 if(!empty($res2->merchant_order_id)){ $order_id = $res2->merchant_order_id;  $amount = $res2->amount;  }
     //echo $order_id;
     if(!empty($order_id)){
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.razorpay.com/v1/orders/'.$order_id.'/payments',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic cnpwX2xpdmVfVU16aUNGMzgxMjlIQ2k6bk1qNVUwZGFIYkQ2S3hJTml6UkRnOG02'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);


    $responseData = json_decode($response);
    $paymentDatas = json_decode(json_encode($responseData), true);
    $payment_id = $paymentDatas ['items'][0]['id'];
                
    $taxRate=18;
    $GSTtax = $amount*$taxRate/100;
    $totalcalamount = $amount-$GSTtax; 
    $franchise = 40;
    $totalfranchise = $totalcalamount*$franchise/100;
 
    // exit;   
 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.razorpay.com/v1/payments/'.$payment_id.'/transfers',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "transfers": [
        {
            "account": "acc_Kd8veyGg002OEL",
            "amount": $totalfranchise,
            "currency": "INR"
            
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'content-type: application/json',
    'Authorization: Basic cnpwX2xpdmVfVU16aUNGMzgxMjlIQ2k6bk1qNVUwZGFIYkQ2S3hJTml6UkRnOG02'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;exit;


 	} 	}
	
	
}
