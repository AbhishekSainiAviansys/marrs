<?php
 
// echo 'ok';die; 
 
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
	 
	 
	// ======================== Payment New Year ========================= // 	
 	
	 
	public function pay()
	{
	    
	    $cin = $_POST['cin'];
	    $comp_id = $_SESSION['exam_id'];
	   // print_r($_POST);die;
	    
	    $cart_data = $this->db->get_where('amount_cart',array('cin'=>$cin,'comp_id'=>$comp_id))->result();
	    $amount = 0;
	    foreach($cart_data as $row){
	        $amount = $amount + $row->amount;
	    }
	   // echo $amount;die;
	   // $amount=10;
	    $this->session->set_userdata('amount',$amount);
	    $stuent = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
	    
	    
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
		 
// 		print_r($_SESSION); 
// 		print_r($_POST);exit;
		
		
	    //$amount = 1*100;
	    $amount =	$amount * 100;     
		$cin  = $_SESSION['cin'];
        $product_name  = $_POST['product_name']; 
		$student_name  = $_POST['name'];
		$stud_email    = $_POST['email'];
		$stud_phone    = $_POST['contact'];
		
		
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
        $responseData    = json_decode($response);
        $paymentDatas    = json_decode(json_encode($responseData), true);
        $razorpayOrderId = $paymentDatas['id'];

		$Pay_array = array(
    		'razorpay_order_id' => $razorpayOrderId,
    		'amount'            => $amount,
    		'cin'               => $cin,
    		'comp_id'           => $comp_id
		);
		
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

        $lunar_schedule_cin = $this->db->get_where('competition_product_state',array('id' => $comp_id))->row();

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
        $maker_razorpay_name = '';
        
		foreach($cart_data as $row){
		  //  echo '<pre>';
	   //     print_r($row); die;
	        $marrs_gst += $row->marrs_gst;
	        $marrs_left += $row->marrs_left;
	        $franchise_amount += $row->franchise_amount;
	        $franchise_gst += $row->franchise_gst;
	       // $school_amount += $row->school_amount;
	        $associate_amount += $row->associate_amount;
	        $associate_gst += $row->associate_gst;
	        $free_mat_royalty += $row->free_mat_royalty;
	        $crm_fix += $row->crm_fix + $row->crm_gst;
	        $manage_amount += $row->manage_amount + $row->manage_gst;
	        $aviansys_amount += $row->aviansys_amount;
	        $aviansys_gst += $row->aviansys_gst;
	        $razorpay_cut += $row->razorpay_cut;
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
	        $maker_razorpay_name = $row->maker_razorpay_name;
	        $maker_razorpay_id = $row->maker_razorpay_id;
	        $razorpay_cut += $row->razorpay_cut;
	    }
	    
	   
	    
	    $ar=
            [	
            	'cin'	              => $cin,
            // 	'prid'                => '',
            	'clevel'	          => $lunar_schedule_cin->level_id,	
            	'product_name'	      => $lunar_schedule_cin->product_name,
            	'name'		          => $stuent->student_name,
            	'class'               => $stuent->class,
            	'total_amount'        => $amount,		
            	'payment_id'	      => $razorpayOrderId,	
            // 	'school_amount'	      => $school_amount,	
            	'franchise_id'	      => $franchise_id,	
            	'franchise_amount'    => $franchise_amount,		
            	'franchise_gst'		  => $franchise_gst,
            	'franchise_account_id'=> $franchise_account_id,	
            	'franchise_razorpay_name' => $franchise_razorpay_name,		
            	'associate_id'		  => $associate_id,
            	'associate_account_id'=> $associate_account_id,		
            	'associate_razorpay_name' => $associate_razorpay_name,	
            	'associate_gst'		  => $associate_gst,
            	'associate_amount'	  => $associate_amount,	
            	'crm_account_id'	  => $crm_account_id,	
            	'crm_razorpay_name'	  => $crm_razorpay_name,	
            	'crm_fix'		      => $crm_fix,
            	'maker_razorpay_name' => $maker_razorpay_name,		
            	'maker_razorpay_id'		=> $maker_razorpay_id,
            	'razpay_service'		=> $razorpay_cut,
            	'total_maker_amount'	=> $free_mat_royalty,	
            	'aviansys_account_id'	=> $aviansys_account_id,
            	'aviansys_razorpay_name' => $aviansys_razorpay_name,	
            	'aviansys_amount'	  => $aviansys_amount,
            	'aviansys_gst'	      => $aviansys_gst,
            	'marrsmanage_rozarpay_id'	=> $marrsmanage_account_id,
            	'marrsmanage_razorpay_name'	=> $marrsmanage_razorpay_name,
            	'management_amount'	  => $manage_amount,
            	'inserted_time'	      => date('H:s:i'),
            	'inserted_date'	      => date('Y-m-d'),
            	'status'	          => 0,
            	'MaRRS_bal'	          => $marrs_left,
            	'marrs_gst'	          => $marrs_gst,
            	'gst_amount'          => $marrs_gst,	
            	'date_of_payment'     => date('Y-m-d'),	
            	'comp_id'             => $comp_id,
            ];		
// 		echo '<pre>';
// 		print_r($ar);die;
		
		$webhook_calls = $this->db->get_where('webhook_calls_zoomzoom',array('cin' => $_SESSION['cin'] , 'payment_id'	=> $razorpayOrderId, 'total_amount' => $amount))->row();
		if(!$webhook_calls){
		    
		    $this->db->insert('webhook_calls_zoomzoom',$ar);
		    $this->db->insert('webhook_calls_cin',$ar);
		    
		    $this->db->where('cin', $cin);
            $this->db->where('comp_id', $comp_id);
            $this->db->where('transaction_id IS NULL', null, false);
            
            $this->db->update('makers_splits', [
                'order_id' => $razorpayOrderId
            ]);

		}

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
			
			$cin = $_SESSION['cin']; 
		    $comp_id = $_SESSION['exam_id'];
			$this->setRegistrationData();
           
            $this->processPaymentSplitsAsync2($order_id);
            $this->processPaymentSplits2($order_id);
            $this->updatePaymentStatus2($cin, $orderId,$comp_id);
           
// 			redirect(base_url().'razorpay/success3'); 
			
			redirect(base_url().'razorpay/success'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed');
		}
	}
	
	private function processPaymentSplitsAsync2($order_id)
    {
        // Option 1: Use exec() to run in background (if shell access available)
        if (function_exists('exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $command = "php " . FCPATH . "index.php razorpay processPaymentSplitsEndpoint " . escapeshellarg($order_id) . " > /dev/null 2>&1 &";
            @exec($command);
            return;
        }
        
        // Option 2: Use cURL to call internal API endpoint
        $this->callAsyncEndpoint2($order_id);
    }
    
    private function callAsyncEndpoint2($order_id)
    {
        $url = base_url('razorpay/processPaymentSplitsEndpoint2');
        
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
    
    private function processPaymentSplits2($order_id)
    {
        $webhook_calls_cin = $this->db->get_where('webhook_calls_zoomzoom', array('payment_id' => $order_id))->row();
        
        if (!$webhook_calls_cin) {
            throw new Exception('Webhook data not found for order: ' . $order_id);
        }
        
        // Process franchise payment
        $total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst + $webhook_calls_cin->school_amount;
        $franchise_pay   = $this->fetch($order_id, $webhook_calls_cin->franchise_account_id, $total_franchise * 100, $webhook_calls_cin->franchise_razorpay_name);
        
        // Process associate payment (if applicable)
        $associate_pay   = ['transfer_id' => null];
        if ($webhook_calls_cin->associate_amount > 0 && !empty($webhook_calls_cin->associate_amount)) {
            $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
            $associate_pay   = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
        }
        
        // Process CRM payment
        $crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id,  $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
        
        // Process Aviansys payment
        $total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
        $aviansys_pay   = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id,  $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
        
        // Process management payment
        $management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id,  $webhook_calls_cin->management_amount  * 100,  $webhook_calls_cin->marrsmanage_razorpay_name);
        
        // Process GST payment
        $gst = $this->db->get_where('gst_account_marrs', array('id' => '1'))->row();
        $gst_pay_marrs    = $this->fetch($order_id, $gst->rozarpay_id, $webhook_calls_cin->marrs_gst * 100, $gst->account_name);
        
        
        $makers_pay = $this->db->get_where('makers_splits', array('order_id' => $order_id))->row();
        
        foreach($makers_pay as $pay){
            $maker = $this->db->get_where('material_maker', array('material_maker_id' => $pay->maker_id))->row();
            
            $maker_amount_pay = $this->fetch($order_id, $maker->razorpay_id,  $pay->price  * 100,  $maker->account_name);
            
            $this->db->where('id',$pay->id);
            $this->db->update('makers_splits',['transaction_id',$maker_amount_pay['transfer_id']]);
        }
        
        
        // Insert payment split record
        $inst = array(
            // 'prid'         => $webhook_calls_cin->prid  ?? '',
            'cin'          => $webhook_calls_cin->cin  ?? '',
            'clevel'       => $webhook_calls_cin->clevel ?? '',
            'total_amount' => isset($webhook_calls_cin->total_amount) ? $webhook_calls_cin->total_amount : '',
            'franchise_amount' => isset($webhook_calls_cin->franchise_amount) ? $webhook_calls_cin->franchise_amount : '',
            'franchise_tranfer_id' => isset($franchise_pay['transfer_id']) ? $franchise_pay['transfer_id'] : '',
            'franchise_id' => isset($webhook_calls_cin->franchise_id) ? $webhook_calls_cin->franchise_id : '',
            'payment_id'   => $order_id ?? '',
            'aviansys_amount' => isset($webhook_calls_cin->aviansys_amount) ? $webhook_calls_cin->aviansys_amount : '',
            'gst_amount'   => isset($webhook_calls_cin->marrs_gst) ? $webhook_calls_cin->marrs_gst : '',
            'comp_id'      => isset($webhook_calls_cin->comp_id) ? $webhook_calls_cin->comp_id : '',
            'aviansys_tranfer_id' => isset($aviansys_pay['transfer_id']) ? $aviansys_pay['transfer_id'] : '',
            'gst_tranfer_id' => isset($gst_pay_marrs['transfer_id']) ? $gst_pay_marrs['transfer_id'] : '',
            'razpay_service' => isset($webhook_calls_cin->razpay_service) ? $webhook_calls_cin->razpay_service : '',
            'crm_fix'      => isset($webhook_calls_cin->crm_fix) ? $webhook_calls_cin->crm_fix : '',
            'crm_fix_tranfer_id' => isset($crm_pay['transfer_id']) ? $crm_pay['transfer_id'] : '',
            'MaRRS_bal'    => isset($webhook_calls_cin->MaRRS_bal) ? $webhook_calls_cin->MaRRS_bal : '',
            'date_of_payment' => date('Y-m-d H:i:s'),
            'management_amount' => isset($webhook_calls_cin->management_amount) ? $webhook_calls_cin->management_amount : '',
            'management_tranfer_id' => isset($management_amount_pay['transfer_id']) ? $management_amount_pay['transfer_id'] : '',
            'franchise_gst'=> isset($webhook_calls_cin->franchise_gst) ? $webhook_calls_cin->franchise_gst : '',
            'aviansys_gst' => isset($webhook_calls_cin->aviansys_gst) ? $webhook_calls_cin->aviansys_gst : '',
            'status'       => '1',
            'maker_id'     => '',
            'total_maker_amount' => isset($webhook_calls_cin->total_maker_amount) ? $webhook_calls_cin->total_maker_amount : '',
            'maker_transfer_id' =>   isset($maker_amount_pay['transfer_id']) ? $maker_amount_pay['transfer_id'] : '',
            'associate_gst' => isset($webhook_calls_cin->associate_gst) ? $webhook_calls_cin->associate_gst : '',
            'associate_tranfer_id' => isset($associate_pay['transfer_id']) ? $associate_pay['transfer_id'] : '',
            'associate_amount' => isset($webhook_calls_cin->associate_amount) ? $webhook_calls_cin->associate_amount : '',
            'associate_id' => isset($webhook_calls_cin->associate_id) ? $webhook_calls_cin->associate_id : ''
        );
        
        $this->db->insert('payment_split', $inst);
        
        
        
        // Update webhook status
        $this->db->where('payment_id', $webhook_calls_cin->payment_id);
        $this->db->where('cin', $webhook_calls_cin->cin);
        $this->db->update('webhook_calls_lunar', array(
            'status' => 1, 
            'date_of_payment' => date('Y-m-d H:i:s')
        ));
        
        // Clear amount cart
        $this->db->where('cin', $webhook_calls_cin->cin);
        $this->db->where('comp_id', $webhook_calls_cin->comp_id);
        $this->db->delete('amount_cart');
    }  

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
	
	private function updatePaymentStatus2($cin, $orderId,$comp_id)
    {
        $competition = $this->db->get_where('competition_product_state',array('id' => $comp_id))->row();
        
        $cart_data = $this->db->get_where('amount_cart',array('cin' => $cin, 'comp_id' => $comp_id, 'razorpay_payment_id' => $orderId))->result();
	    
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
                // 'subject' => $competition->subject ?? null,
                // 'series' => $competition->series ?? null,
                // 'type' => $competition->type ?? null
            ];
    
            // Merge updateFields into Data if you need to persist flags
            $Data = array_merge($Data, $updateFields);
                
            $this->db->insert('new_cart', $Data);
        }
        
    }

    public function success()
	{   
	    $data = $this->session->userdata('payment_data');
	        
	        //print_r($data);exit; 
        $comp_id = $_SESSION['exam_id'];

		$cin = $data['cin'];
	
		$data['cin'] = $data['cin'];
       
	//	$this->newmodel->cart_newstate($cin,$data,$statid->state_id); 
		$this->newmodel->cart_new_add($data);
// 		echo 'ok';
// 		die;
		$student = $this->newmodel->get_student_data_cin_($cin);
		
	// ================== //	
// 		$data['clevel'];
// 		$cin;
		
		 $this->db->select('*');
         $this->db->from('new_cart');
         $this->db->where('cin',$data['cin']);
         $this->db->where("comp_id",$comp_id);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         $res = $query->result_array();
		
	
// 		======================== email ============================== //
           $to = $student['stud_email'];
            
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
                    
                    if($item['study_material_a'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - A</p>';
                    }
                    if($item['study_material_b'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - B</p>';
                    }
                    if($item['study_material_c'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - C</p>';
                    }
                    if($item['study_material_d'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - D</p>';
                    }
                    if($item['study_material_e'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - E</p>';
                    }
                    if($item['study_material_f'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Study Material - F</p>';
                    }
                    
                           
                    
                    if($item['orientation_a'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - A</p>';
                    }
                    if($item['orientation_b'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - B</p>';
                    }
                    if($item['orientation_c'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - C</p>';
                    }
                    if($item['orientation_d'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - D</p>';
                    }
                    if($item['orientation_e'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - E</p>';
                    }
                    if($item['orientation_f'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Orientation - F</p>';
                    }
                    
                    
                    
                    
                    if($item['mock_test_a'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test A</p>';
                    }
                    if($item['mock_test_b'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test B</p>';
                    }
                    if($item['mock_test_c'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test C</p>';
                    }
                    if($item['mock_test_d'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test D</p>';
                    }
                    if($item['mock_test_e'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test E</p>';
                    }
                    if($item['mock_test_f'] == 'Yes') {
                        // Handle other cases if needed
                        $htmlContent .= '<p>&nbsp Mock Test F</p>';
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



		
// 		$this->db->where('cin',$cin);
// 		$this->db->delete('amount_cart');
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


//  ================== end =================== //






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
	
	public function pay2()
	{
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
// 		print_r($_POST);exit; 
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

		$this->load->view('razorpay2',array('data' => $data));
	}
	
	public function verify2()
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
           
			redirect(base_url().'razorpay/success2'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed2');
		}
	}
	
	public function success2()
	{   
	    $data = $this->session->userdata('payment_data');
	        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$data['cin']))->row();
	       // echo $this->db->last_query();
	       // $franchise_id=$paid_idd->franchise_id;
	        $state_id=$paid_idd->state_id;
	        $period_id=$paid_idd->period_id;
	        $clevel=$data['clevel'];
	        $product_name=$data['product_name'];
	       // $competition = $this->db->get_where('competition_product_state',array('franchise_id' =>$franchise_id,'state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        
	        $competition = $this->db->get_where('competition_product_state',array('state_id'=>$state_id,'product_name'=>$product_name,'clevel'=>$clevel,'period_id'=>$period_id))->row();
	        $franchise_id=$competition->franchise_id;
	        
	        $comp_id=$competition->id;
	        
	        $franchise_per=$competition->com_per;
	        $aviansys_per=$competition->com_peravian;
	        $manage_per=$competition->manageper;
	        $franchise_split=$competition->franchise_split;
	        $aviansys_split=$competition->aviansys_split;
	        $franchise_gst = $competition->franchise_gst;
	        $aviansys_gst = $competition->aviansys_gst;
	        
	        $total_amount=$data['amount']/100;
	        //echo $comp_id;
	         //print_r($franchise_split);die;
	        
	        
	        $Base_GR=$data['amount']/100;    // GR=>GST+Razorpay
	        $Base_G=round($Base_GR/1.03);   
	        $Base_cost = round($Base_G/1.18); 
	        
	        $GST = round($Base_cost * 0.18);           // GST account money
	        
	        if($franchise_gst=='yes' || $franchise_gst=='Yes'){            //Aviansys and Franchise Gst Activated 23-11-2024 After 12:00 Noon
	            
	          $GST_fr =round($GST*$franchise_per/100);
	          
	        }
	        if($aviansys_gst=='yes' || $aviansys_gst=='Yes'){
	          $GST_Av =round($GST*$aviansys_per/100);
	        }
	        
	        $total_GST= round($GST-$GST_fr-$GST_Av);
	        
	        $Aviasys_pay = round($Base_cost * $aviansys_per/100)+$GST_Av;     // payment made to aviansys per user transaction
	        $Franchise_pay = round ($Base_cost * $franchise_per/100)+$GST_fr;   // payment made to franchise per user transaction
	        
	        //$Aviasys_pay = round($Base_cost * $aviansys_per/100);     // payment made to aviansys per user transaction
	        //$Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
	        $management_pay = round ($Base_cost * $manage_per/100);
	        $razpay_service = $Base_GR-$Base_G;         // razorpay service charge for transaction is 3% aasumed
	        $MaRRS_bal = $Base_cost-($Aviasys_pay + $Franchise_pay + $management_pay);      // balance to marrs account
	        
	       
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
            $insert_array['MaRRS_bal'] =$MaRRS_bal;
            $insert_array['franchise_gst'] =$GST_fr;
            $insert_array['aviansys_gst'] =$GST_Av;
            //echo $gst_amount;die;
            
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->where('cin',$data['cin']);
            $this->db->where('comp_id',$comp_id);
            $this->db->where('payment_id',$data['razorpay_order_id']);
            $this->db->where('gst_tranfer_id !=','');
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
                $this->db->from('payment_split');
                $this->db->where('cin',$data['cin']);
                $this->db->where('comp_id',$comp_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'4'))->row();
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
            
            
    	    $insert_array['date_of_payment'] = date("Y-m-d");
    	    if(!empty($insert_array['aviansys_tranfer_id'])){
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
	
	
	
	
        $this->load->view('cin_login/success', $data);
        //die;
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
	
	public function fetch($merchant_order_id,$account_id,$amount,$account_razorpay_name)
	{
	    
	    
    	 // $res = $this->db->order_by('id','DESC')->get_where('new_cart')->row();
    	  
    	 //if(!empty($merchant_order_id)){ $order_id = $merchant_order_id; $amount;  }
    	
        //  echo $amount.'ok'.$merchant_order_id;die;
         if(!empty($merchant_order_id)){
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders/'.$merchant_order_id.'/payments',
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
        // print_r($response);die;
        curl_close($curl);
        
        $data = json_decode($response, true);
        $responseData = json_decode($response);
        $paymentDatas = json_decode(json_encode($responseData), true);
        $payment_id = $paymentDatas['items'][0]['id'];
                
        // print_r($paymentDatas);
        // echo $payment_id;die;     
                
         $on_hold_until = strtotime("+2 day");   
       // echo $account_id.' - '.$payment_id.' - '.$on_hold_until.' - '.$amount.' - '.$account_razorpay_name;die;
    // 
    
        $postFields = json_encode($dat);
    
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
                            "on_hold": false,
                            "on_hold_until": "'.$on_hold_until.'"
                        }
                    ]
                }',
    
                //$postFields,
                  CURLOPT_HTTPHEADER => array(
                    'content-type: application/json',
                    'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                //echo $response;die;
                 
                //print_r($response);die;
                $response_data =$response;
                
                
                $data = json_decode($response_data, true);
                
                // print_r($data);die;
                if (isset($data['items']) && !empty($data['items'])) {
                    $first_item = $data['items'][0];
                    if (isset($first_item['id'])) {
                        $id = $first_item['id'];
                        //echo "ID: " . $id;
                    } 
                }
                //die;
                $arr=array(
                    'payment_id'=>$payment_id,
                    'tranfer_id'=>$id,
                    'tranfer_amount'=>$amount,
                    //'total_amount'=>$amount
                    ); 
                
                //echo $response;exit;
               // print_r($arr);die;
                return $arr;
     	} 	
    	    
    }
 	
 	
 	
 	
 	
//  	=============== end =================== //
 	
 	
// ======================== Payment New Year ========================= // 	
 	
 	
 	
// ====================== end ============================ //	
    public function pay3(){

        $prid = $this->input->post('prid');
        $sch_id = $this->input->post('sch_id');
    
        $cart_data = $this->db->get_where('zoomzoom_purchase',['prid'=>$prid,'status'=>'Pending','sch_id'=>$sch_id])->result();
        $lunar_schedule_cin = $this->db->get_where('zoomzoom_schedule_cin',array('zoomzoom_schedule_id' => $sch_id))->row();

        $amount = array_sum(array_column($cart_data,'amount'));
        $this->session->set_userdata('amount',$amount);
	   // print_r($_SESSION);
	   
	   // echo $amount;die;
	   // $amount=1;
	   // $this->session->set_userdata('amount',$amount);
	    $stuent=$this->db->get_where('zoomzoom_prid',array('PRID'=>$prid))->row();
		//$api = new Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
// 		$stud_phone = $student->mobile;
// 		$stud_email = $student->email;
		$api = new Razorpay\Api\Api('rzp_live_kG7f8nF6sKGPhx', '68nusLbguizulOSBn47VpfmS');
		
	    $amount =	$lunar_schedule_cin->amount*100; 
	    
	   // $amount = 1*100;
	   
// 		$cin  = $_POST['cin'];
        
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
    		'prid'              =>$prid,
    		'sch_id'            =>$sch_id
		);
		
// 		print_r($Pay_array);exit;
		$this->session->set_userdata('payment_data',$Pay_array);

        $student = $this->db->get_where('zoomzoom_prid',array('prid' => $prid))->row();
        // 		print_r($student);die;
        $cart_data = $this->db->get_where('cart_prid_lunar',array('prid'=>$prid))->result();
        
        
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
        $maker_razorpay_name = '';
		foreach($cart_data as $row){
		  //  echo '<pre>';
	   //     print_r($row); die;
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
	        $razorpay_cut += $row->razorpay_cut;
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
	        $maker_razorpay_name = $row->maker_razorpay_name;
	        $maker_razorpay_id = $row->maker_razorpay_id;
	        $razorpay_cut += $row->razorpay_cut;
	       // $ar=[
	       //         'title' => 'Competition',
	       //         'maker_id' => $row->maker_id,
	       //         'price' => $row->free_mat_royalty,
	       //         'transaction_id' => '',
	       //         'revenue_setting_id' => '',
	       //         'comp_id' => '',
	       //         'order_id' => $razorpayOrderId,
	       //         'prid' => $prid,
	       //         'i'=>$i
	       //     ];
	            
	       // $makers_splits = $this->db->get_where('makers_splits',$ar)->row();
	       // if(!$makers_splits){
	       //     $this->db->insert('makers_splits',$ar);
	       // }
	       // $i=$i+1;
	    }
	    
	   // $period = $this->db->get_where('period',['period_id'=>$lunar_schedule_cin->period_id])->row();
	    $a=explode("ZZREG",$_SESSION['prid']);
	    
	    $ar=
            [	
            	'cin'	=> $a[0].'ZZ'.$lunar_schedule_cin->area.$a[1],
            	'prid'    => $_SESSION['prid'],
            	'clevel'	=> $lunar_schedule_cin->level_id,	
            	'product_name'	=> $lunar_schedule_cin->product_name,
            	'name'		=> $student->name,
            	'class'     => $student->class,
            	'total_amount'=> $amount,		
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
            	'crm_fix'		=> $crm_fix,
            	'maker_razorpay_name' => $maker_razorpay_name,		
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
            	'status'	=> 0,
            	'MaRRS_bal'	=> $marrs_left,
            	'marrs_gst'	=> $marrs_gst,
            	'gst_amount' => $marrs_gst,	
            	'date_of_payment' => date('Y-m-d'),	
            	'comp_id' => $lunar_schedule_cin->comp_id,
            	'sch_id'=> $lunar_schedule_cin->zoomzoom_schedule_id
            ];		
		
// 		print_r($ar);die;
		
		$webhook_calls = $this->db->get_where('webhook_calls_lunar',array('prid'=>$_SESSION['prid'] , 'payment_id'	=> $razorpayOrderId, 'total_amount'=>$amount))->row();
		if(!$webhook_calls){
		    $this->db->insert('webhook_calls_zoomzoom',$ar);
		}



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
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();
           
            $this->processPaymentSplitsAsync1($order_id);
           
           
// 			redirect(base_url().'razorpay/success3'); 
			
			redirect(base_url().'razorpay/success3_test'); 
		}
		else {
			redirect(base_url().'razorpay/paymentFailed3');
		}
	}
    

    private function processPaymentSplitsAsync1($order_id)
    {
        // Option 1: Use exec() to run in background (if shell access available)
        if (function_exists('exec') && strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $command = "php " . FCPATH . "index.php razorpay processPaymentSplitsEndpoint " . escapeshellarg($order_id) . " > /dev/null 2>&1 &";
            @exec($command);
            return;
        }
        
        // Option 2: Use cURL to call internal API endpoint
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
    private function processPaymentSplits1($order_id)
    {
        $webhook_calls_cin = $this->db->get_where('webhook_calls_zoomzoom', array('payment_id' => $order_id))->row();
        
        if (!$webhook_calls_cin) {
            throw new Exception('Webhook data not found for order: ' . $order_id);
        }
        
        // Process franchise payment
        $total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst + $webhook_calls_cin->school_amount;
        $franchise_pay = $this->fetch($order_id, $webhook_calls_cin->franchise_account_id, $total_franchise * 100, $webhook_calls_cin->franchise_razorpay_name);
        
        // Process associate payment (if applicable)
        $associate_pay = ['transfer_id' => null];
        if ($webhook_calls_cin->associate_amount > 0 && !empty($webhook_calls_cin->associate_amount)) {
            $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
            $associate_pay = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
        }
        
        // Process CRM payment
        $crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id,  $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
        
        // Process Aviansys payment
        $total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
        $aviansys_pay = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id,  $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
        
        // Process management payment
        $management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id,  $webhook_calls_cin->management_amount  * 100,  $webhook_calls_cin->marrsmanage_razorpay_name);
        
        // Process GST payment
        $gst = $this->db->get_where('gst_account_marrs', array('id' => '1'))->row();
        $gst_pay_marrs = $this->fetch($order_id, $gst->rozarpay_id, $webhook_calls_cin->marrs_gst * 100, $gst->account_name);
        
        
        $maker_amount_pay = $this->fetch($order_id, $webhook_calls_cin->maker_razorpay_id,  $webhook_calls_cin->total_maker_amount  * 100,  $webhook_calls_cin->maker_razorpay_name);
        
        
        
        // Insert payment split record
        $inst = array(
            'prid' => $webhook_calls_cin->prid  ?? '',
            'clevel' => $webhook_calls_cin->clevel ?? '',
            'total_amount' => isset($webhook_calls_cin->total_amount) ? $webhook_calls_cin->total_amount : '',
            'franchise_amount' => isset($webhook_calls_cin->franchise_amount) ? $webhook_calls_cin->franchise_amount : '',
            'franchise_tranfer_id' => isset($franchise_pay['transfer_id']) ? $franchise_pay['transfer_id'] : '',
            'franchise_id' => isset($webhook_calls_cin->franchise_id) ? $webhook_calls_cin->franchise_id : '',
            'payment_id' => $order_id ?? '',
            'aviansys_amount' => isset($webhook_calls_cin->aviansys_amount) ? $webhook_calls_cin->aviansys_amount : '',
            'gst_amount' => isset($webhook_calls_cin->marrs_gst) ? $webhook_calls_cin->marrs_gst : '',
            'comp_id' => isset($webhook_calls_cin->comp_id) ? $webhook_calls_cin->comp_id : '',
            'aviansys_tranfer_id' => isset($aviansys_pay['transfer_id']) ? $aviansys_pay['transfer_id'] : '',
            'gst_tranfer_id' => isset($gst_pay_marrs['transfer_id']) ? $gst_pay_marrs['transfer_id'] : '',
            'razpay_service' => isset($webhook_calls_cin->razpay_service) ? $webhook_calls_cin->razpay_service : '',
            'crm_fix' => isset($webhook_calls_cin->crm_fix) ? $webhook_calls_cin->crm_fix : '',
            'crm_fix_tranfer_id' => isset($crm_pay['transfer_id']) ? $crm_pay['transfer_id'] : '',
            'MaRRS_bal' => isset($webhook_calls_cin->MaRRS_bal) ? $webhook_calls_cin->MaRRS_bal : '',
            'date_of_payment' => date('Y-m-d H:i:s'),
            'management_amount' => isset($webhook_calls_cin->management_amount) ? $webhook_calls_cin->management_amount : '',
            'management_tranfer_id' => isset($management_amount_pay['transfer_id']) ? $management_amount_pay['transfer_id'] : '',
            'franchise_gst' => isset($webhook_calls_cin->franchise_gst) ? $webhook_calls_cin->franchise_gst : '',
            'aviansys_gst' => isset($webhook_calls_cin->aviansys_gst) ? $webhook_calls_cin->aviansys_gst : '',
            'status' => '1',
            'maker_id' => '',
            'total_maker_amount' => isset($webhook_calls_cin->total_maker_amount) ? $webhook_calls_cin->total_maker_amount : '',
            'maker_transfer_id' =>   isset($maker_amount_pay['transfer_id']) ? $maker_amount_pay['transfer_id'] : '',
            'associate_gst' => isset($webhook_calls_cin->associate_gst) ? $webhook_calls_cin->associate_gst : '',
            'associate_tranfer_id' => isset($associate_pay['transfer_id']) ? $associate_pay['transfer_id'] : '',
            'associate_amount' => isset($webhook_calls_cin->associate_amount) ? $webhook_calls_cin->associate_amount : '',
            'associate_id' => isset($webhook_calls_cin->associate_id) ? $webhook_calls_cin->associate_id : ''
        );
        
        $this->db->insert('payment_split_prid', $inst);
        
        $student = $this->db->get_where('zoomzoom_prid',array('prid' => $webhook_calls_cin->prid))->row();
        
        $arrrrrr = [
            'sch_id'=> $student->sch_id,
            'school_amount'=> '', 
            'payment_id'=> $order_id,	 
            'total_amount'=> isset($webhook_calls_cin->total_amount) ? $webhook_calls_cin->total_amount : '',  
            'prid' => $webhook_calls_cin->prid  ?? '',
            'associate_id' => isset($webhook_calls_cin->associate_id) ? $webhook_calls_cin->associate_id : '',
            'razpay_service' => isset($webhook_calls_cin->razpay_service) ? $webhook_calls_cin->razpay_service : '',
            'MaRRS_bal' => isset($webhook_calls_cin->MaRRS_bal) ? $webhook_calls_cin->MaRRS_bal : '',
            'gst_amount' => isset($webhook_calls_cin->marrs_gst) ? $webhook_calls_cin->marrs_gst : '',
            'gst_tranfer_id' => isset($gst_pay_marrs['transfer_id']) ? $gst_pay_marrs['transfer_id'] : '',
            'associate_amount' => isset($webhook_calls_cin->associate_amount) ? $webhook_calls_cin->associate_amount : '',
            'associate_tranfer_id' => isset($associate_pay['transfer_id']) ? $associate_pay['transfer_id'] : '',
            'aviansys_amount' => isset($webhook_calls_cin->aviansys_amount) ? $webhook_calls_cin->aviansys_amount : '',
            'aviansys_tranfer_id' => isset($aviansys_pay['transfer_id']) ? $aviansys_pay['transfer_id'] : '',
            'date_of_payment'=> date('Y-m-d H:i:s'),
            'management_amount' => isset($webhook_calls_cin->management_amount) ? $webhook_calls_cin->management_amount : '',
            'management_tranfer_id' => isset($management_amount_pay['transfer_id']) ? $management_amount_pay['transfer_id'] : '',
            'aviansys_gst' => isset($webhook_calls_cin->aviansys_gst) ? $webhook_calls_cin->aviansys_gst : '',
            'associate_gst' => isset($webhook_calls_cin->associate_gst) ? $webhook_calls_cin->associate_gst : '',
            'crm_fix' => isset($webhook_calls_cin->crm_fix) ? $webhook_calls_cin->crm_fix : '',
            'crm_fix_tranfer_id' => isset($crm_pay['transfer_id']) ? $crm_pay['transfer_id'] : '',
            'maker_amount' => isset($webhook_calls_cin->total_maker_amount) ? $webhook_calls_cin->total_maker_amount : '',
            'maker_tranfer_id'=>isset($maker_amount_pay['transfer_id']) ? $maker_amount_pay['transfer_id'] : '',
            'material_maker_fix'=>isset($webhook_calls_cin->total_maker_amount) ? $webhook_calls_cin->total_maker_amount : '',
            'mock_maker_fix'=>'',
            'franchise_id' => isset($webhook_calls_cin->franchise_id) ? $webhook_calls_cin->franchise_id : '',
            'franchise_gst' => isset($webhook_calls_cin->franchise_gst) ? $webhook_calls_cin->franchise_gst : '',
            'franchise_transfer_id'=> isset($franchise_pay['transfer_id']) ? $franchise_pay['transfer_id'] : '',
            'franchise_amount' => isset($webhook_calls_cin->franchise_amount) ? $webhook_calls_cin->franchise_amount : '',
            
            ];
        
                   
            $this->db->insert('zoomzoom_split_prid',$arrrrrr);
              
        
        
        // Update webhook status
        $this->db->where('payment_id', $webhook_calls_cin->payment_id);
        $this->db->where('prid', $webhook_calls_cin->prid);
        $this->db->update('webhook_calls_zoomzoom', array(
            'status' => 1, 
            'date_of_payment' => date('Y-m-d H:i:s')
        ));
        
        // Clear amount cart
        $this->db->where('prid', $webhook_calls_cin->prid);
        $this->db->where('payment_id', $webhook_calls_cin->payment_id);
        $this->db->update('cart_prid_lunar', array(
            'status' => 1, 
        ));
    }    
    
    
    public function success3_test()
    {
        try {
            // Get payment data from session
            $paymentData = $this->session->userdata('payment_data');
            $prid = $paymentData['prid'];
            
            $cart_data = $this->db->get_where('cart_prid_lunar',array('prid'=> $prid))->row();
        
            
            // Get student information
            $student = $this->getStudentByPrid($prid);
            if (!$student) {
                throw new Exception("Student not found with PRID: $prid");
            }
            
            // Get schedule information
            $schedule = $this->getScheduleById($student->sch_id);
            if (!$schedule) {
                throw new Exception("Schedule not found with ID: {$student->sch_id}");
            }
            
            // Process the payment and registration
            $this->processPaymentRegistration($student, $schedule, $paymentData);
            
            // Update payment status
            $this->updatePaymentStatus($prid, $paymentData['razorpay_order_id']);
            
            // Get updated purchase data for view
            $purchaseData = $this->getPurchaseDataByPrid($prid);
            $cinData = $this->getCinDataByEmailAndPrid($student->email, $prid);
            
            // Prepare data for view
            $viewData = [
                'cins' => $purchaseData,
                'student' => $student,
                'schedule' => $schedule,
                'cin' => $cinData
            ];
            // print_r($viewData);die;
            $this->load->view('success3', $viewData);
            
        } catch (Exception $e) {
            log_message('error', 'Error in success3_test: ' . $e->getMessage());
            show_error('An error occurred during payment processing. Please try again later.');
        }
    }

    /**
     * Get student information by PRID
     */
    private function getStudentByPrid($prid)
    {
        return $this->db->get_where('zoomzoom_prid', ['prid' => $prid])->row();
    }
    
    /**
     * Get schedule information by ID
     */
    private function getScheduleById($scheduleId)
    {
        return $this->db->get_where('zoomzoom_schedule_cin', ['zoomzoom_schedule_id' => $scheduleId])->row();
    }
    
    /**
     * Process payment and registration
     */
    private function processPaymentRegistration($student, $schedule, $paymentData)
    {
        // Check for pending purchase
        $pendingPurchase = $this->getPendingPurchase($student->prid, $schedule->zoomzoom_schedule_id);
        
        if (!$pendingPurchase) {
            return;
        }
        
        $paymentData = $this->session->userdata('payment_data');
        $prid = $paymentData['prid'];
        
        $cart_data = $this->db->get_where('cart_prid_lunar',array('prid'=> $prid))->row();
        
        
        // Generate CIN
        $cin = $this->generateCin($student, $schedule);
        
        // Get franchise information
        // $franchise = $this->getFranchiseByState($student->state_id);
        // $franchiseId = $franchise ? $franchise->franchise_id : 0;
        $franchiseId = $schedule->franchise_id;
        $franchise = $this->db->get_where('franchise', ['franchise_id' => $franchiseId])->row();
        
        
        // Prepare data for cin_list
        $cinListData = [
            'cin' => $cin,
            'password' => $cin,
            'period_id' => $student->period_id,
            'student_name' => $student->name,
            'franchise_id' => $franchiseId,
            'franchise_code' => $franchise->franchise_code,
            'address1' => $student->address1,
            'stud_email' => $student->email,
            'stud_phone' => $student->mobile,
            'class' => $pendingPurchase->class,
            'father_name' => $student->father_name,
            'mother_name' => $student->mother_name,
            'school_name' => '',
            'school_id' => $cart_data->school_id,
            'state_id' => $student->state_id,
            'status' => 'Active',
            'gender' => $student->gender,
            'subject' => $schedule->subject,
            'series' => $schedule->series,
            'sch_id' => $schedule->zoomzoom_schedule_id,
            'level_id' => $schedule->level_id,
            'prid' => $student->prid,
            'district_code' => $schedule->district_code,
            'associate_id' => $schedule->associate_id,
            'type' => $schedule->type
        ];
        
        // Check if CIN already exists
        $existingCin = $this->db->get_where('cin_list', ['cin' => $cin])->row();
        
        if (!$existingCin) {
            // Insert into cin_list
            $this->db->insert('cin_list', $cinListData);
            
            // Insert into cin_result
            $cinResultData = [
                'cin' => $cin,
                'clevel' => $schedule->level_id,
                'product_name' => $schedule->product_name,
                'period_id' => $student->period_id
            ];
            $this->db->insert('cin_result', $cinResultData);
            
            // Insert into cin_uploade
            $cinUploadData = [
                'comp_id' => $this->getCompetitionId(),
                'cin' => $cin
            ];
            $this->db->insert('cin_uploade', $cinUploadData);
        }
        
        // Insert into new_cart
        $newCartData = [
            'status' => 'Paid',
            'study_material' => 'No',
            'study_material_b' => 'No',
            'study_material_c' => 'No',
            'orientation' => 'No',
            'orientation_b' => 'No',
            'orientation_c' => 'No',
            'mock_test' => 'No',
            'cin' => $cin,
            'subject' => $schedule->subject,
            'type' => $schedule->type,
            'clevel' => $schedule->level_id,
            'series' => $schedule->series,
            'period_id' => $schedule->period_id,
            'amount' => $this->getBaseGR(),
            'razorpay_payment_id' => $paymentData['razorpay_order_id'] ?? '',
            'merchant_order_id' => $paymentData['razorpay_order_id'] ?? '',
            'product_name' => $schedule->product_name
        ];
        $this->db->insert('new_cart', $newCartData);
        
        // Send confirmation email
        $this->sendRegistrationEmail($student, $cin);
    }
    
    /**
     * Get pending purchase
     */
    private function getPendingPurchase($prid, $scheduleId)
    {
        $this->db->select('*');
        $this->db->from('zoomzoom_purchase');
        $this->db->where('prid', $prid);
        $this->db->where('sch_id', $scheduleId);
        $this->db->where('item', 'product');
        $this->db->where('status', 'Pending');
        
        return $this->db->get()->row();
    }

    /**
     * Generate CIN
     */
    private function generateCin($student, $schedule)
    {
        $it = explode("ZZREG", $student->prid);
        // $it = explode("ZZREG",$_SESSION['prid']);
        
        // Get district information
        $district = $this->db->get_where('districts', ['state_id' => $student->state_id])->row();
        
        // Get district count
        $this->db->select('*');
        $this->db->from('districts');
        $this->db->where('ini', $district->ini);
        $this->db->where('id <=', $student->district_code);
        $query = $this->db->get();
        $count = $query->num_rows();
        
        // Get product and period initials
        $product = $this->db->get_where('products', ['product_name' => $schedule->product_name])->row();
        $period = $this->db->get_where('period', ['period_id' => $schedule->period_id])->row();
        
        // Generate CIN
        if(!empty($schedule->area)){
        return $period->initials . $product->in13 . $district->ini . $schedule->area . $it[1];
        }else{
            return $period->initials . $product->in13 . $district->ini. $it[1];
        }
    }
    
    /**
     * Get franchise by state
     */
    private function getFranchiseByState($stateId)
    {
        return $this->db->get_where('franchise', [
            'account_id !=' => '',
            'state_id' => $stateId
        ])->row();
    }
    
    /**
     * Generate franchise code
     */
    private function generateFranchiseCode($stateId, $districtCode)
    {
        $district = $this->db->get_where('districts', ['state_id' => $stateId])->row();
        
        $this->db->select('*');
        $this->db->from('districts');
        $this->db->where('ini', $district->ini);
        $this->db->where('id <=', $districtCode);
        $query = $this->db->get();
        $count = $query->num_rows();
        
        return $district->ini . $count;
    }
    
    /**
     * Get associate ID
     */
    private function getAssociateId($prid)
    {
        // Implementation depends on your business logic
        return 0; // Default value
    }
    
    /**
     * Get competition ID
     */
    private function getCompetitionId()
    {
        // Implementation depends on your business logic
        return 1; // Default value
    }
    
    /**
     * Get Base GR
     */
    private function getBaseGR()
    {
        // Implementation depends on your business logic
        return 0; // Default value
    }
    
    /**
     * Update payment status
     */
    private function updatePaymentStatus($prid, $orderId)
    {
        $updateData = [
            'date' => date("Y-m-d"),
            'time' => date("h:i:sa"),
            'order_id' => $orderId,
            'status' => 'Paid',
            'payment_id' => $orderId
        ];
        
        $this->db->where('status', 'Pending');
        $this->db->where('prid', $prid);
        $this->db->update('zoomzoom_purchase', $updateData);
    }
    
    /**
     * Get purchase data by PRID
     */
    private function getPurchaseDataByPrid($prid)
    {
        $this->db->select('*');
        $this->db->from('zoomzoom_purchase');
        $this->db->where('prid', $prid);
        
        return $this->db->get()->result();
    }
    
    /**
     * Get CIN data by email and PRID
     */
    private function getCinDataByEmailAndPrid($email, $prid)
    {
        return $this->db->get_where('cin_list', [
            'stud_email' => $email,
            'prid' => $prid
        ])->row();
    }
    
    /**
     * Send registration confirmation email
     */
    private function sendRegistrationEmail($student, $cin)
    {
        $apiKey = "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";
        $url = "https://api.brevo.com/v3/smtp/email";
        
        $message = $this->generateEmailMessage($student, $cin);
        
        // Email Data for Brevo API
        $emailData = [
            "sender" => [
                "name" => "MaRRS Enquiry",
                "email" => "donotreply@marrs.in"
            ],
            "to" => [
                [
                    "email" => $student->email,
                    "name" => "MaRRS Math Zoomzoom Registration"
                ]
            ],
            "subject" => "MaRRS Math ZoomZoom Registration Successful",
            "htmlContent" => $message,
            "textContent" => "Congratulations " . $student->name . "! Your registration on the MaRRS Portal was successful. Your CIN is: $cin."
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
        
        // Log API response
        if ($httpCode != 201) {
            log_message('error', 'Email sending failed: ' . $response);
        }
    }
    
    /**
     * Generate email message
     */
    private function generateEmailMessage($student, $cin)
    {
        return '
            <p>Dear Student '.$student->name.',</p>
            
            <p>Thank you for registering for the <strong>MaRRS Math ZoomZoom</strong> !!! We\'re thrilled to have you participate.</p>
            
            <p>This email confirms your successful registration.</p>
            
            <p><strong>Your Candidate Identification Number (CIN)</strong>, which will serve as both your username and password for the MaRRS portal, is:</p>
            
            <h2 style="color: #ff4d6d;">' . $cin . '</h2>
            
            <p>Please keep this CIN safe. You can use it to log in to our portal at <a href="https://marrs.in/" target="_blank">https://marrs.in/</a> to:</p>
            <ul>
              <li>Download learning materials</li>
              <li>Check your test results</li>
              <li>Download your certificates</li>
            </ul>
            
            <p>We wish you all the best for the Lunar Skill Test !!!</p>
            
            <p>Sincerely,</p>
            <p><strong>The MaRRS Team</strong></p>
        ';
    }
    
    public function success3_test_()
	{   
	        $data = $this->session->userdata('payment_data');
	        $data['student']= $student = $this->db->get_where('lunar_prid',array('prid' =>$_SESSION['prid']))->row();
	        $schedule = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id' =>$student->sch_id))->row();
	        //print_r($schedule);
	       // echo $this->db->last_query();die;
	       // echo $school_id = $schedule->school_id;
	        $state_id = $schedule->state_id;
	        $period_id = $student->period_id;
	        
	            
	        $insert_array = array();
	        
	        $cart_data = $this->db->get_where('lunar_purchase',array('prid'=>$data['prid']))->result();
	      
	       

        
                
       
    		$this->db->select('*');
            $this->db->from('lunar_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);
            $this->db->where('sch_id',$schedule->lunar_schedule_id);
            $this->db->where('item','product');
            $this->db->where('status','Pending');
            $query = $this->db->get();
            $res= $query->row();
	
		    $it=explode("MREG",$_SESSION['payment_data']['prid']);

        
		    if($res){
		    
        		    
        		    $student_to_prid = $this->db->get_where('lunar_prid',array('prid'=>$_SESSION['payment_data']['prid']))->row();
        		    
        		  //  print_r($student_to_prid);die;
        		    
        		    $district= $this->db->get_where('districts',array('state_id'=>$student_to_prid->state_id))->row();
        		    
        		    
        		    
        		    $this->db->select('*');
                    $this->db->from('districts');
                    $this->db->where('ini', $district->ini);
                    $this->db->where('id <=', $student_to_prid->district_code);
                    $query = $this->db->get();
                    $rest = $query->result();
                    // echo $this->db->last_query();
                    $count = count($rest);
                    		    
        		  //  echo $count;
        		    
        		  //  print_r($district);die;
        		    
        		    $pr_ini= $this->db->get_where('products',array('product_name'=>$schedule->product_name))->row();
        		    $ini=$pr_ini->in13;
        		    $period_id=$schedule->period_id;
        		    $period_ini= $this->db->get_where('period',array('period_id'=>$period_id))->row();
        		    $cin=$period_ini->initials.$ini.$district->ini.$count.$it[1];
        		    
        		    $franchise= $this->db->get_where('franchise',array('account_id !='=>'','state_id'=>$student_to_prid->state_id))->row();
        		    $franchise_id=$franchise->franchise_id;
        		    
        		    $arr=array(
        		        'cin'=>$cin,
        		        'password'=>$cin,
        		        'period_id'=>$period_id,
        		        'student_name'=>$student->name,
        		        'franchise_id'=>$franchise_id,
        		        'franchise_code'=>$district->ini.$count,
        		        'address1'=>$student->address1,
        		      //  'address2'=>$student->address2,
        		        'stud_email'=>$student->email,
        		        'stud_phone'=>$student->mobile,
        		        'class'=>$res->class,
        		        'father_name'=>$student->father_name,
        		        'mother_name'=>$student->mother_name,
        		        'school_name'=>'',
        		        'state_id'=>$student_to_prid->state_id,
        		        'status'=>'Active',
        		        'gender'=>$student->gender,
        		        'subject'=>$schedule->subject,
        		        'series'=>$schedule->series,
        		        'sch_id'=>$schedule->lunar_schedule_id,
        		        'level_id'=>$schedule->level_id,
        		        'prid'=>$student->prid,
        		        'district_code'=>$student->district_code,
        		        'associate_id'=>$associate_id,
        		        'type'=>$schedule->type,
        		      //  'franchise_id'=>0,
        		      //  'franchise_code'=>'OP1'
        		        );
        		        
        		  //  echo '<per>';  
        		  //  print_r($arr);die;
        		      
        		    $cincheck= $this->db->get_where('cin_list',array('cin'=>$cin))->row();
        		  //  print_r($cincheck);die;
        		    
        		    if(!$cincheck){    
        		        
        		        $this->db->insert('cin_list',$arr);
        		        
        		        $ar=array(
        		            'cin'=>$cin,
        		            'clevel'=>$schedule->level_id,
        		            'product_name'=>$schedule->product_name,
        		            'period_id'=>$period_id
        		          //  'status'=>'Q'
        		        );
        		        $this->db->insert('cin_result',$ar);
        		        
        		       
                        $arrr=array(
                            'comp_id'=>$competition->id,
                            'cin'=>$cin
                            );  
                            
                        $this->db->insert('cin_uploade',$arrr);    
        		    }
        		    
        		    
        		    $arnew = [
                        'status' => 'Paid',
                        'study_material' => 'No',
                        'study_material_b' => 'No',
                        'study_material_c' => 'No',
                        'orientation' => 'No',
                        'orientation_b' => 'No',
                        'orientation_c' => 'No',
                        'mock_test' => 'No'
                    ];
            
                   
                            // Additional data to insert
                    $arnew['cin'] = $cin;
                    $arnew['subject'] = $schedule->subject;
                    $arnew['type'] = $schedule->type;
                    $arnew['clevel'] = $competition->clevel;
                    $arnew['series'] = $schedule->series;
                    $arnew['period_id'] = $schedule->period_id;
                    $arnew['amount'] = $Base_GR;
                    $arnew['razorpay_payment_id'] = $data['razorpay_order_id'] ?? ''; 
                    $arnew['merchant_order_id'] = $data['razorpay_order_id'] ?? ''; 
                    $arnew['product_name'] = $schedule->product_name;
                      
                      
            	    $this->db->insert('new_cart', $arnew);
                // 	====================	inserting product purchased data in new_Cart table ================= //
                
                //  ======================================== sending mail =================================================== //
            
                $apiKey = "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";
                $url = "https://api.brevo.com/v3/smtp/email";
            
                // $message = '<h4>Registration Successful</h4>';
                // $message .= '<h4>Hello, Congratulations ' . $student->name . ' for successfully registering on the <a href="https://marrs.in/">MaRRS Portal</a>.</h4>';
                // $message .= '<p>You have paid to participate in the MaRRS Lunar Challenges.</p>';
                // $message .= '<p>You can access the Learning Material for the product by logging in using your CIN: <strong>' . $cin . '</strong>.</p>';
                // $message .= '<p>You will be able to download <strong>Free</strong> learning material and mock papers immediately, as well as purchase Paid Materials, Orientation, and Mock Tests.</p>';
                // $message .= '<p>Thanks & Regards,</p>';
                // $message .= '<p><strong>MaRRS Team</strong></p>';
                   
                // echo $message;die;   
                
                $message = '
                    <p>Dear Student '.$student->name.',</p>
                    
                    <p>Thank you for registering for the <strong>Lunar Skill Test</strong> !!! We\'re thrilled to have you participate.</p>
                    
                    <p>This email confirms your successful registration.</p>
                    
                    <p><strong>Your Candidate Identification Number (CIN)</strong>, which will serve as both your username and password for the MaRRS portal, is:</p>
                    
                    <h2 style="color: #ff4d6d;">' . $cin . '</h2>
                    
                    <p>Please keep this CIN safe. You can use it to log in to our portal at <a href="https://marrs.in/" target="_blank">https://marrs.in/</a> to:</p>
                    <ul>
                      <li>Download learning materials</li>
                      <li>Check your test results</li>
                      <li>Download your certificates</li>
                    </ul>
                    
                    <p>We wish you all the best for the Lunar Skill Test !!!</p>
                    
                    <p>Sincerely,</p>
                    <p><strong>The MaRRS Team</strong></p>
                    ';

            
            
            
            
               
                // Email Data for Brevo API
                $emailData = [
                    "sender" => [
                        "name" => "MaRRS Enquiry",
                        "email" => "donotreply@marrs.in"
                    ],
                    "to" => [
                        [
                            "email" => $student->email,
                            "name" => "Lunar Registration"
                        ]
                    ],
                    "subject" => "MaRRS Registration Successful",
                    "htmlContent" => $message,
                    "textContent" => "Congratulations " . $student->name . "! Your registration on the MaRRS Portal was successful. Your CIN is: $cin."
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
                    echo "Registration successfully!";
                } 
                
                else {
                    echo "Error: " . $response;
                }



		}
		
	
    // 	echo $cin;die; 
    		    $ar = array(
    		        'date'=>date("Y-m-d"),
    		        'time'=>date("h:i:sa"),
    		        'order_id'=>$data['razorpay_order_id'],
    		        'status'=>'Paid',
    		        'payment_id'=>$data['razorpay_order_id'],
    		    );
		        
		        //  print_r($ar);die;
    		    $this->db->where('status','Pending');
    		  //  $this->db->where('sch_id',$sch_id);
    		    $this->db->where('prid',$_SESSION['payment_data']['prid']);
    		    $this->db->update('lunar_purchase',$ar);
    		    
		      //  echo $this->db->last_query();die;
		
                $this->db->select('*');
                $this->db->from('lunar_purchase');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);   
            	$query=$this->db->get();
            	$data['cins']=$query->result();
            	
            	
                $lcin = $this->db->get_where('cin_list',array('stud_email'=>$student->email,'prid'=>$_SESSION['payment_data']['prid']))->row();
    		  //  $data['cin'] = $lcin;
            // print_r($data['cins']);die;
        
            $this->load->view('success3', $data);
     
	}
    
    public function success3()
	{   
	    $data = $this->session->userdata('payment_data');
	    
	   //print_r($_SESSION);die;
	   
	        $data['student']= $student = $this->db->get_where('zoomzoom_prid',array('prid' =>$_SESSION['prid']))->row();
	       
	      //print_r($data['student']);die;
	       
	        $schedule = $this->db->get_where('zoomzoom_schedule_cin',array('zoomzoom_schedule_id ' =>$student->sch_id))->row();
	        //echo $student->sch_id;
	        //print_r($schedule);die;
	          
	       // echo $this->db->last_query();
	       //print_r($schedule);die;
	        $state_id=$schedule->state_id;
	       // $school_id=$student->school_id;
	        $sch_id=$schedule->lunar_schedule_id;
	       // echo $school_id.' '.$state_id;
	        $crm_fix = $schedule->crm_fix;
	        
	        $school_amount = $schedule->school_amount;
	        
	        
	        $this->db->select('*');
	        $this->db->from('associates');
	        $this->db->join('associate_bank_details','associates.associate_id=associate_bank_details.associate_id');
	        $this->db->where('associates.associate_id',$schedule->associate_id);
	       // $this->db->where('account_id !=','');
	        $query=$this->db->get();
	        $associate = $query->row();
	        $associate_id=$associate->associate_id;
	         
	       // $data['amount']=120000;
	       // $total_amount=$data['amount']/100;
	       
	        $aviansys_per = $schedule->aviansys_percentage;
	        $management_per = $schedule->management_percentage;
	        $associate_per = $schedule->associate_cut;
	        
	        $Base_GR = $_SESSION['payment_data']['amount']/100;
	        
	        $Base_G = round($Base_GR/1.03);
	        
	       // echo ' Base_G '.$Base_G;
	        
	        $Base_cost1 = round($Base_G/1.18); 
	        
	       // echo ' Base before crm'.$Base_cost1;
	        
	        $GST = round($Base_cost1 * 0.18);
	        
	       // echo ' Total gst '.$GST;
	        if (!empty($crm_fix) && $crm_fix != 0 ) {
	            $Base_cost1 = $Base_cost1 - $crm_fix;
	        }
	        if(!empty($school_amount) && $school_amount != 0){
	            $Base_cost1 = $Base_cost1 - $school_amount;
	        }
	        
	        $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE subject='" . $schedule->subject . "'  and clevel='" . $schedule->level_id . "' and product_name='" . $schedule->product_name . "' and series='" . $schedule->series . "' and type='" . $schedule->type . "' and period_id='" . $schedule->period_id . "' ;");
                                        
            $res= $competition =$query->row();
            $comp_id=$res->id;
          
            // print_r($competition);die;
            
            $revenue = $this->db->get_where('revenue_setting',array('id' =>$competition->revenue_setting_id))->row();
           
            
	       // print_r($competition);die;
	        
	        $franchise_per=$competition->com_per;
            $totalmaker_price = $revenue->study_material_free_royalty;
            // $totalmaker_price = $maker_price_material + $maker_price_mock;
            
            // echo $totalmaker_price;die;
            
            // Deduct Total Maker Price (if any)
            if ($totalmaker_price > 0) {
                $Base_cost1 -= $totalmaker_price;
            }
            
            // echo $Base_cost1;die;
    
                
                $this->db->select('assigned_materials.maker_id,assigned_materials.mat_id');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.status', 'Free');
                $this->db->where('study_material.subject',$competition->subject);
                $this->db->where('study_material.series',$competition->series);
                $this->db->where('study_material.sub_type',$competition->type);
                $this->db->where('assigned_materials.period_id',$competition->period_id);
                $this->db->order_by('assigned_materials.id',"DESC");
                $query=$this->db->get();
                $material = $query->row();   
               
            // print_r($material);die;
            
            $material_id =   $material->mat_id;
            $maker_id =   $material->maker_id;
            
            $insert_array['material_maker_fix'] = '';
            $insert_array['mock_maker_fix'] = '';
            $insert_array['school_amount'] = $school_amount;
            
	       // echo $material_count.' '.$Base_cost1;die;
            	       
            $franchise_per = $franchise_per - $associate_per;       
            	       
            $GST_as =round($GST*$franchise_per/100);	       
	        $GST_fr =round($GST*$associate_per/100);
	        $GST_Av =round($GST*$aviansys_per/100);
	        
	        $marrs_GST= round($GST - $GST_fr - $GST_Av - $GST_as);
	        
	        $franchise_id = $competition->franchise_id;
	        
	        
	        $franchise_pay = round ($Base_cost1 * $franchise_per/100);
	        $totalfranchise_pay = $franchise_pay + $GST_as;   // payment made to franchise per user transaction
	        $Aviasys_pay = round($Base_cost1 * $aviansys_per/100);
	        $totalAviasys_pay = $Aviasys_pay + $GST_Av;     // payment made to aviansys per user transaction
	        $associate_pay = round ($Base_cost1 * $associate_per/100);
	        $totalassociate_pay = $associate_pay + $GST_fr;   // payment made to franchise per user transaction
	        $management_pay = round ($Base_cost1 * $management_per/100);
	        $razpay_service = $Base_GR - $Base_G;
	        
	         
	        $totalcut=0;    
	        
	       // echo $totalfranchise_pay.'  '.'Total=>'.$Base_GR.' Rz Pay '.$razpay_service.' Base_cost=>'.$Base_cost1.' GST_cost=>'.$GST.' Aviansys=>'.$Aviasys_pay.' Associate=>'.$associate_pay.' Management => '.$management_pay;die;
	       
	       // echo $gst_amt=$GST*100;
	       // die;
	        $insert_array=array();
	        $insert_array['associate_id'] = $associate_id;
            // $insert_array['clevel'] = $data['clevel'];
            $insert_array['prid'] = $_SESSION['payment_data']['prid'];
            $insert_array['payment_id'] = $data['razorpay_order_id'];
            $insert_array['total_amount'] = $Base_GR;
            // $insert_array['school_id'] = $school_id;
            $insert_array['razpay_service'] = $razpay_service;
            $insert_array['associate_gst'] = $GST_fr;
            $insert_array['aviansys_gst'] = $GST_Av;
            //echo $gst_amount;die;
            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
           
            $insert_array['franchise_id'] = $franchise_id;
            // $insert_array['franchise_amount'] = $totalfranchise_pay;
            $insert_array['franchise_gst'] = $GST_as;
	        
	       // ($Aviasys_pay+$associate_pay+$management_pay)
	             
	       // ============== crm transfer ================== //
	       
	            $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                // $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('crm_fix_tranfer_id !=','');
                $query=$this->db->get();
                $resulcrm = $query->row();
                
                
	            if (!empty($crm_fix) && $crm_fix != 0 && empty($resulcrm)) {
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
    	        
    	        
    	        
	             
	       // ============== maker transfer ================== //
	       
	            $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                // $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('maker_tranfer_id !=','');
                $query=$this->db->get();
                $resultm = $query->row();
	       
    	        if (!empty($totalmaker_price) && $totalmaker_price != 0 ) {
    	           // echo $crm_fix;die;
                // ============== gst transfer ================== //
        	        $gst = $this->db->get_where('material_maker',array('material_maker_id' => $maker_id))->row();
        	        $maker_account_id=$gst->razorpay_id;
        	        $maker_razorpay_name=$gst->account_name;
        	        if($gst){
            	        $maker_pay=$this->fetch($data['razorpay_order_id'],$maker_account_id,$totalmaker_price * 100,$maker_razorpay_name);
            	       // print_r($crm_pay);die;
            	        if(!empty($crm_pay['tranfer_id'])){
                            $insert_array['maker_amount'] = $maker_pay['tranfer_amount']/100;
                    	    $insert_array['maker_tranfer_id'] = $maker_pay['tranfer_id'];
                    	    
            	        }
        	        }
    	        } 
    	        
    	        
    	        
	        // ============== management transfer ================== //
                $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                // $this->db->where('school_id',$school_id);
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
            	        $totalcut=$totaalcut+$management_pay;
        	        }
    	        }     
    	    // ====== end ===== //
            
            
            // ============== gst transfer ================== //
                $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                // $this->db->where('school_id',$school_id);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('gst_tranfer_id !=','');
                $query=$this->db->get();
                $resultt = $query->row();
	        
	        
    	        if(empty($resultt)){
                
        	        $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
        	        $gst_account_id=$gst->rozarpay_id;
        	        $gst_razorpay_name=$gst->account_name;
        	        //echo $gst_account_id;die;
        	        $gst_pay=$this->fetch($data['razorpay_order_id'],$gst_account_id,$marrs_GST*100,$gst_razorpay_name);
        	        //print_r($gst_pay);die;
        	        if(!empty($gst_pay['tranfer_id'])){
                        $insert_array['gst_amount'] = $gst_pay['tranfer_amount']/100;
                	    $insert_array['gst_tranfer_id'] = $gst_pay['tranfer_id'];
                	    
        	        }
    	        }     
    	    // ====== end ===== //
    	    
	       // ============== associate transfer ================== //
	       
	            
	            $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('associate_tranfer_id !=','');
                $query=$this->db->get();
                $resultf = $query->row();
            
                if(empty($resultf)){
    	           // $associate = $this->db->get_where('associates',array('associate_id' =>$associate_id))->row();
    	            $franchiseaccount_id=$associate->razorpay_id;
    	            $franchiseaccount_razorpay_name=$associate->account_type;
    	           // $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$totalassociate_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
            	        $insert_array['associate_amount'] = $Franchisepay['tranfer_amount']/100;
            	        $insert_array['associate_tranfer_id'] = $Franchisepay['tranfer_id'];
            	        $totalcut=$totaalcut+$associate_pay;
        	        }
    	        
	            }
	        
	       // ====== end ===== // 
	       
	       // ============== franchise transfer ================== //
	       
	       // print_r($franchise);die;
	            
	            $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('franchise_transfer_id !=','');
                $query=$this->db->get();
                $resultf = $query->row();
            
            
                if(empty($resultf)){
    	           // $associate = $this->db->get_where('associates',array('associate_id' =>$associate_id))->row();
    	            $franchiseaccount_id = $franchise->account_id;
    	            $franchiseaccount_razorpay_name = $franchise->account_razorpay_name;
    	            
    	           // $franchise_amount=round($franchise_per/100*$base_price,2);
        	        $Franchisepay=$this->fetch($data['razorpay_order_id'],$franchiseaccount_id,$totalfranchise_pay*100,$franchiseaccount_razorpay_name);
        	        if(!empty($Franchisepay['tranfer_id'])){
            	        $insert_array['franchise_amount'] = $Franchisepay['tranfer_amount']/100;
            	        $insert_array['franchise_transfer_id'] = $Franchisepay['tranfer_id'];
            	        $totalcut = $totaalcut + $totalfranchise_pay;
        	        }
    	        
	            }
	        
	       // ====== end ===== // 
	       
            // ============== aviansys transfer ================== //
	        
	            $this->db->select('*');
                $this->db->from('lunar_split_prid');
                $this->db->where('prid',$_SESSION['payment_data']['prid']);
               
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $this->db->where('aviansys_tranfer_id !=','');
                $query=$this->db->get();
                $resulta = $query->row();
            
                if(empty($resulta)){
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	            $aviansys_id=$aviansys->rozarpay_id;
    	            $aviansys_razorpay_name=$aviansys->account_name;
    	           // $aviansys_amount=round($aviansys_per/100*$base_price,2);
    	            $avianpay=$this->fetch($data['razorpay_order_id'],$aviansys_id,$totalAviasys_pay*100,$aviansys_razorpay_name);
    	            if(!empty($avianpay['tranfer_id'])){
        	            $insert_array['aviansys_amount'] = $avianpay['tranfer_amount']/100;
            	        $insert_array['aviansys_tranfer_id'] = $avianpay['tranfer_id'];
            	        $totalcut=$totaalcut+$Aviasys_pay;
    	            }
	            }
	        
            // ====== end ===== //
            
            $this->db->select('*');
                $this->db->from('zoomzoom_split_prid');
                $this->db->where('payment_id',$data['razorpay_order_id']);
                $query=$this->db->get();
                $resultpay = $query->row();
                $MaRRS_bal=$Base_cost1-$totalcut;
                if(empty($resultpay)){
                    
                    $insert_array['MaRRS_bal'] =$MaRRS_bal;
    	            $insert_array['date_of_payment'] = date("Y-m-d");
    	            $insert_array['sch_id'] = $sch_id;
    	           
    	           //print_r($insert_array);die;
                    $this->db->insert('zoomzoom_split_prid',$insert_array);
                }
       
		$this->db->select('*');
        $this->db->from('zoomzoom_purchase');
        $this->db->where('prid',$_SESSION['payment_data']['prid']);
        $this->db->where('sch_id',$schedule->zoomzoom_schedule_id );
        $this->db->where('item','product');
        $this->db->where('status','Pending');
        $query = $this->db->get();
        $res= $query->row();
	
		$it=explode("MREG",$_SESSION['payment_data']['prid']);
 
        // print_r($cin);
        // echo 'ok';die;
        
		if($res){
		    
		    
		    $student_to_prid= $this->db->get_where('zoomzoom_prid',array('prid'=>$_SESSION['payment_data']['prid']))->row();
		    
		    
		    $district= $this->db->get_where('districts',array('state_id'=>$student_to_prid->state_id))->row();
		    
		    
		    
		    $this->db->select('*');
            $this->db->from('districts');
            $this->db->where('ini', $district->ini);
            $this->db->where('id <=', $student_to_prid->district_code);
            $query = $this->db->get();
            $rest = $query->result();
            // echo $this->db->last_query();
            $count = count($rest);
            		    
		    $this->db->like('cin', '25MZ');   // LIKE '%25LU%'
            $this->db->order_by('id', 'DESC');
            $CINS = $this->db->get('cin_list')->row();
            if(!empty($CINS->cin)){
		    $cin = $CINS->cin;   // sample

            // Get last 6 digits
            $lastSix = substr($cin, -6);   // "100000"
            
            // Convert to int and increment
            $next = (int)$lastSix + 1;      
            
            // Convert back to 6-digit number with leading zeros
             $newSix = str_pad($next, 6, '0', STR_PAD_LEFT);
            }else{
                $newSix=500000;
            }
		    
		    $pr_ini= $this->db->get_where('products',array('product_name'=>$schedule->product_name))->row();
		    $ini=$pr_ini->in13;
		    $period_id=$schedule->period_id;
		    $period_ini= $this->db->get_where('period',array('period_id'=>$period_id))->row();
		    $cin=$period_ini->initials.$ini.$district->ini.$count.$newSix;
		    
		    $franchise= $this->db->get_where('franchise',array('account_id !='=>'','state_id'=>$student_to_prid->state_id))->row();
		    $franchise_id=$franchise->franchise_id;
		    
		    $arr=array(
		        'cin'=>$cin,
		        'password'=>$cin,
		        'period_id'=>$period_id,
		        'student_name'=>$student->name,
		        'franchise_id'=>$franchise_id,
		        'franchise_code'=>$district->ini.$count,
		        'address1'=>$student->address1,
		      //  'address2'=>$student->address2,
		        'stud_email'=>$student->email,
		        'stud_phone'=>$student->mobile,
		        'class'=>$res->class,
		        'father_name'=>$student->father_name,
		        'mother_name'=>$student->mother_name,
		        'school_name'=>'',
		        'state_id'=>$student_to_prid->state_id,
		        'status'=>'Active',
		        'gender'=>$student->gender,
		        'subject'=>$schedule->subject,
		        'series'=>$schedule->series,
		        'sch_id'=>$schedule->lunar_schedule_id,
		        'level_id'=>$schedule->level_id,
		        'prid'=>$student->prid,
		        'district_code'=>$student->district_code,
		        'associate_id'=>$associate_id,
		        'type'=>$schedule->type,
		      //  'franchise_id'=>0,
		      //  'franchise_code'=>'OP1'
		        );
		   // print_r($arr);die;
		      
		    $cincheck= $this->db->get_where('cin_list',array('cin'=>$cin))->row();
		    
		    if(!$cincheck){    
		        
		        $this->db->insert('cin_list',$arr);
		        
		        $ar=array(
		            'cin'=>$cin,
		            'clevel'=>$schedule->level_id,
		            'product_name'=>$schedule->product_name,
		            'period_id'=>$period_id
		          //  'status'=>'Q'
		        );
		        $this->db->insert('cin_result',$ar);
		        
		       
                $arrr=array(
                    'comp_id'=>$competition->id,
                    'cin'=>$cin
                    );  
                    
                $this->db->insert('cin_uploade',$arrr);    
		    }
		    
		    
		    $arnew = [
                'status' => 'Paid',
                'study_material' => 'No',
                'study_material_b' => 'No',
                'study_material_c' => 'No',
                'orientation' => 'No',
                'orientation_b' => 'No',
                'orientation_c' => 'No',
                'mock_test' => 'No'
            ];
    
           
                    // Additional data to insert
            $arnew['cin'] = $cin;
            $arnew['subject'] = $schedule->subject;
            $arnew['type'] = $schedule->type;
            $arnew['clevel'] = $schedule->level_id;
            $arnew['series'] = $schedule->series;
            $arnew['period_id'] = $schedule->period_id;
            $arnew['amount'] = $Base_GR;
            $arnew['razorpay_payment_id'] = $data['razorpay_order_id'] ?? ''; 
            $arnew['merchant_order_id'] = $data['razorpay_order_id'] ?? ''; 
            $arnew['product_name'] = $schedule->product_name;
              
    	    $this->db->insert('new_cart', $arnew);
            // 	====================	inserting product purchased data in new_Cart table ================= //
            
            //  ======================================== sending mail =================================================== //
        
            $apiKey = "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";
            $url = "https://api.brevo.com/v3/smtp/email";
        
            // $message = '<h4>Registration Successful</h4>';
            // $message .= '<h4>Hello, Congratulations ' . $student->name . ' for successfully registering on the <a href="https://marrs.in/">MaRRS Portal</a>.</h4>';
            // $message .= '<p>You have paid to participate in the MaRRS Lunar Challenges.</p>';
            // $message .= '<p>You can access the Learning Material for the product by logging in using your CIN: <strong>' . $cin . '</strong>.</p>';
            // $message .= '<p>You will be able to download <strong>Free</strong> learning material and mock papers immediately, as well as purchase Paid Materials, Orientation, and Mock Tests.</p>';
            // $message .= '<p>Thanks & Regards,</p>';
            // $message .= '<p><strong>MaRRS Team</strong></p>';
               
            // echo $message;die;   
            
            $message = '
                    <p>Dear Student '.$student->name.',</p>
                    
                    <p>Thank you for registering for the <strong>MaRRS Zoom Zoom </strong>! We\'re thrilled to have you participate.</p>
                    
                    <p>This email confirms your successful registration.</p>
                    
                    <p><strong>Your Candidate Identification Number (CIN)</strong>, which will serve as both your username and password for the MaRRS portal, is:</p>
                    
                    <h2 style="color: #ff4d6d;">' . $cin . '</h2>
                    
                    <p>Please keep this CIN safe. You can use it to log in to our portal at <a href="https://marrs.in/" target="_blank">https://marrs.in/</a> to:</p>
                    <ul>
                      <li>Download learning materials</li>
                      <li>Check your test results</li>
                      <li>Download your certificates</li>
                    </ul>
                    
                    <p>We wish you all the best for the MaRRS Lunar Tests!</p>
                    
                    <p>Sincerely,</p>
                    <p><strong>The MaRRS Team</strong></p>
                    ';

            
            
            
            
               
                // Email Data for Brevo API
                $emailData = [
                    "sender" => [
                        "name" => "MaRRS Enquiry",
                        "email" => "donotreply@marrs.in"
                    ],
                    "to" => [
                        [
                            "email" => $student->email,
                            "name" => "Lunar Registration"
                        ]
                    ],
                    "subject" => "MaRRS Registration Successful",
                    "htmlContent" => $message,
                    "textContent" => "Congratulations " . $student->name . "! Your registration on the MaRRS Portal was successful. Your CIN is: $cin."
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
                    echo "Registration successfully!";
                } 
                
                else {
                    echo "Error: " . $response;
                }



		}
		
		
        
        
		
		
// 		================ end ================== //
		//  echo $cin;die; 
		    $ar=array(
		        'date'=>date("Y-m-d"),
		        'time'=>date("h:i:sa"),
		        'order_id'=>$data['razorpay_order_id'],
		        'status'=>'Paid',
		        'payment_id'=>$data['razorpay_order_id'],
		    );
		        
		      //  print_r($ar);die;
		  $this->db->where('status','Pending');
		  $this->db->where('sch_id',$sch_id);
		  $this->db->where('prid',$_SESSION['payment_data']['prid']);
		  $this->db->update('lunar_purchase',$ar);
		
            $this->db->select('*');
            $this->db->from('lunar_purchase');
            $this->db->where('prid',$_SESSION['payment_data']['prid']);   
        	$query=$this->db->get();
        	$data['cins']=$query->result();
        	
        	
            $lcin= $this->db->get_where('cin_list',array('stud_email'=>$student->email,'sch_id'=>$sch_id))->row();
		    $data['cin']=$lcin->cin;
        

            
        
        
      
        // if(empty($data['cins'])){
        //     $this->load->view('loader');
        // }else{
        
        
            $this->load->view('success3', $data);
        
        // }	
        	
        
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
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'4'))->row();
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
    	            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'4'))->row();
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
    
	
}
