<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;

class Webhook extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();

     
    }


    public function webhooksplit_() 
    {
        
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
        //print_r($data);die;
        // Log parsed data
        file_put_contents(APPPATH . 'logs/webhook.log', date("Y-m-d H:i:s") . " Parsed: " . print_r($data, true) . PHP_EOL, FILE_APPEND);

        // Example: verify Razorpay signature if needed
        $signature = $this->input->get_request_header('X-Razorpay-Signature');
        
        
        if (!empty($signature)) {
            
            $expected = hash_hmac('sha256', $rawData, $webhookSecret);
              
            
            if (hash_equals($expected, $signature)) {
                // echo $signature.'okkk'.$expected;die;
                
                // Signature valid
                file_put_contents(APPPATH . 'logs/webhook.log', "✅ Signature verified" . PHP_EOL, FILE_APPEND);

                // Do something with $data
                if (isset($data['event']) && $data['event'] === "payment.captured") {
                    // Example: save payment id
                    $payment_id = $data['payload']['payment']['entity']['id'];
                    // TODO: save to DB
                    
                    $order_id = $data['payload']['payment']['entity']['order_id'];
                    $webhook = $this->db->get_where('webhook_calls',array('payment_id' => $order_id))->row();
		          
        		    if(!empty($webhook)){
        		      print_r($webhook);
        		      if($webhook->franchise_amount != 0){
        		          $total_franchise = $webhook->franchise_amount + $webhook->franchise_gst + $webhook->school_amount ;die;
        		          $maker_pay = $this->fetch($order_id,$webhook->franchise_account_id,$total_franchise * 100,$webhook->franchise_razorpay_name);
        		          print_r($maker_pay);die;
        		      }
        		      
        		      
        		      
        		    }
                    
                }
            } else {
                // echo 'np';die;
                file_put_contents(APPPATH . 'logs/webhook.log', "❌ Invalid signature" . PHP_EOL, FILE_APPEND);
            }
        } else {
            file_put_contents(APPPATH . 'logs/webhook.log', "❌ No signature header found" . PHP_EOL, FILE_APPEND);
        }

        // Respond 200 to Razorpay
        echo http_response_code(200);
        print_r($data);
    
    }
    
    
    public function webhooksplit()  
    {
      

        $webhookSecret = "alkanairwebhook";
        $rawData = file_get_contents("php://input");
    
        // Log
        file_put_contents(APPPATH . 'logs/webhook.log', date("Y-m-d H:i:s") . " RAW: " . $rawData . PHP_EOL, FILE_APPEND);
    
        $data = json_decode($rawData, true);
        file_put_contents(APPPATH . 'logs/webhook.log', date("Y-m-d H:i:s") . " Parsed: " . print_r($data, true) . PHP_EOL, FILE_APPEND);
    
       $headers = getallheaders();
        $signature = "";
        if (isset($headers['X-Razorpay-Signature'])) {
            $signature = $headers['X-Razorpay-Signature'];
        } elseif (isset($headers['x-razorpay-signature'])) {
            // sometimes lowercase depending on server
            $signature = $headers['x-razorpay-signature'];
        } elseif (isset($_SERVER['HTTP_X_RAZORPAY_SIGNATURE'])) {
            // fallback in GoDaddy / cPanel hosting
            $signature = $_SERVER['HTTP_X_RAZORPAY_SIGNATURE'];
        } elseif (isset($_SERVER['REDIRECT_HTTP_X_RAZORPAY_SIGNATURE'])) {
            $signature = $_SERVER['REDIRECT_HTTP_X_RAZORPAY_SIGNATURE'];
        }
    
        
       try {
        if (!empty($signature)) {
            $expected = hash_hmac('sha256', $rawData, $webhookSecret);
            // echo $expected;die;
            if (hash_equals($expected, $signature)) {
                file_put_contents(APPPATH . 'logs/webhook.log', "✅ Signature verified" . PHP_EOL, FILE_APPEND);
    
                if (isset($data['event']) && $data['event'] === "payment.captured") {
                    
                    $payment_id = $data['payload']['payment']['entity']['id'];
                    $order_id   = $data['payload']['payment']['entity']['order_id'];
    
                    // lookup order in DB
                    $webhook = $this->db->get_where('webhook_calls',['payment_id' => $order_id , 'status' => 0])->row();
                    
                    if(!empty($webhook)){
                        
                        if (!empty($webhook) && $webhook->franchise_amount > 0) {
                            $total_franchise = $webhook->franchise_amount + $webhook->franchise_gst + $webhook->school_amount;
                            $franchise_pay = $this->fetch($order_id, $webhook->franchise_account_id, $total_franchise * 100, $webhook->franchise_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($franchise_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook) && $webhook->associate_amount > 0) {
                            $total_associate = $webhook->associate_amount + $webhook->associate_gst;
                            $associate_pay = $this->fetch($order_id, $webhook->associate_account_id, $total_associate * 100, $webhook->associate_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($associate_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook) && $webhook->crm_fix > 0) {
                            $crmacc = $this->db->get_where('gst_account_marrs',['rozarpay_id' => $webhook->crm_account_id])->row();
                            $crm_pay = $this->fetch($order_id, $webhook->crm_account_id, $webhook->crm_fix * 100, $crmacc->account_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($crm_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook) && $webhook->total_maker_amount > 0) {
                            $maker = $this->db->get_where('material_maker',['razorpay_id' => $webhook->maker_razorpay_id])->row();
                            $maker_pay = $this->fetch($order_id, $webhook->maker_razorpay_id, $webhook->total_maker_amount * 100, $webhook->maker_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($maker_pay, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        if (!empty($webhook) && $webhook->aviansys_amount > 0) {
                            $total_aviansys = $webhook->aviansys_amount + $webhook->aviansys_gst;
                            $aviansys_pay = $this->fetch($order_id, $webhook->aviansys_account_id, $total_aviansys * 100, $webhook->aviansys_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($aviansys_pay, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        if (!empty($webhook) && $webhook->management_amount > 0) {
                            $management_amount_pay = $this->fetch($order_id, $webhook->marrsmanage_rozarpay_id, $webhook->management_amount * 100, $webhook->marrsmanage_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($management_amount_pay, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        if (!empty($webhook) && $webhook->marrs_gst > 0) {
                            $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
                	        $gst_account_id=$gst->rozarpay_id;
                	        $gst_razorpay_name=$gst->account_name;
                            $gst_pay_marrs = $this->fetch($order_id, $gst_account_id, $webhook->marrs_gst * 100, $gst_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($gst_pay_marrs, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        
                        
                        
                        $this->db->where('payment_id',$order_id);
                        $this->update('webhook_calls',['status'=>'1']);
                        
                        
    
                        $inst=[	
                            'cin'=>$webhook->cin,
                            'clevel'=>$webhook->clevel,
                            'total_amount'=>$webhook->total_amount,
                            'franchise_amount'=>$webhook->franchise_amount,
                            'franchise_tranfer_id'=>$franchise_pay['transfer_id'] ?? '',
                            'franchise_id'=>$webhook->franchise_id,
                            'payment_id'=>$webhook->payment_id,
                            'aviansys_amount'=>$webhook->aviansys_amount,
                            'gst_amount'=>$webhook->marrs_gst,
                            'comp_id'=>$webhook->comp_id,
                            'aviansys_tranfer_id'=>$aviansys_pay['transfer_id'] ?? '',
                            'gst_tranfer_id'=>$gst_pay_marrs['transfer_id'] ?? '',
                            'razpay_service'=>$webhook->razpay_service,
                            'crm_fix'=>$webhook->crm_fix,
                            'crm_fix_tranfer_id'=>$crm_pay['transfer_id'] ?? '',
                            'MaRRS_bal'=>$webhook->MaRRS_bal,
                            'date_of_payment'=>$webhook->date_of_payment,
                            'management_amount'=>$webhook->management_amount,
                            'management_tranfer_id'=>$management_amount_pay['transfer_id'] ?? '',
                            'franchise_gst'=>$webhook->franchise_gst,
                            'aviansys_gst'=>$webhook->aviansys_gst,
                            'status'=>'1',
                            'maker_id'=>$maker->material_maker_id,
                            'total_maker_amount'=>$webhook->total_maker_amount,
                            'maker_transfer_id'=>$maker_pay['transfer_id'] ?? '',
                            'associate_gst'=>$webhook->associate_gst,
                            'associate_tranfer_id'=>$associate_pay['transfer_id'] ?? '',
                            'associate_amount'=>$webhook->associate_amount,
                            'associate_id'=>$webhook->associate_id,
                            'school_amount'=>$webhook->school_amount
                        ];
                        
                        $this->db->insert('payment_split',$inst);
                    }
                    
                    
                    
                    $webhook_calls_cin = $this->db->get_where('webhook_calls_cin',['payment_id' => $order_id , 'status' => 0])->row();
                    // echo $this->db->last_query().' ok';
                    // die;
                    if(!empty($webhook_calls_cin)){
                        print_r($webhook_calls_cin);die;
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->franchise_amount > 0) {
                            $total_franchise = $webhook_calls_cin->franchise_amount + $webhook_calls_cin->franchise_gst;
                            $franchise_pay = $this->fetch($order_id, $webhook_calls_cin->franchise_account_id, $total_franchise * 100, $webhook_calls_cin->franchise_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($franchise_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->associate_amount > 0) {
                            $total_associate = $webhook_calls_cin->associate_amount + $webhook_calls_cin->associate_gst;
                            $associate_pay = $this->fetch($order_id, $webhook_calls_cin->associate_account_id, $total_associate * 100, $webhook_calls_cin->associate_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($associate_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->crm_fix > 0 && !empty($webhook_calls_cin->crm_fix)) {
                            $crm_pay = $this->fetch($order_id, $webhook_calls_cin->crm_account_id, $webhook_calls_cin->crm_fix * 100, $webhook_calls_cin->crm_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($crm_pay, true) . PHP_EOL, FILE_APPEND);
                        } 
                        
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->aviansys_amount > 0) {
                            $total_aviansys = $webhook_calls_cin->aviansys_amount + $webhook_calls_cin->aviansys_gst;
                            $aviansys_pay = $this->fetch($order_id, $webhook_calls_cin->aviansys_account_id, $total_aviansys * 100, $webhook_calls_cin->aviansys_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($aviansys_pay, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->management_amount > 0 && !empty($webhook_calls_cin->management_amount)) {
                            $management_amount_pay = $this->fetch($order_id, $webhook_calls_cin->marrsmanage_rozarpay_id, $webhook_calls_cin->management_amount * 100, $webhook_calls_cin->marrsmanage_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($management_amount_pay, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        if (!empty($webhook_calls_cin) && $webhook_calls_cin->marrs_gst > 0) {
                            $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
                	        $gst_account_id=$gst->rozarpay_id;
                	        $gst_razorpay_name=$gst->account_name;
                            $gst_pay_marrs = $this->fetch($order_id, $gst_account_id, $webhook_calls_cin->marrs_gst * 100, $gst_razorpay_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($gst_pay_marrs, true) . PHP_EOL, FILE_APPEND);
                        }
                        
                        $inst=[	
                            'cin'=>$webhook_calls_cin->cin ?? '',
                            'clevel'=>$webhook_calls_cin->clevel ?? '',
                            'total_amount'=>$webhook_calls_cin->total_amount ?? '',
                            'franchise_amount'=>$webhook_calls_cin->franchise_amount ?? '',
                            'franchise_tranfer_id'=>$franchise_pay['transfer_id'] ?? '',
                            'franchise_id'=>$webhook_calls_cin->franchise_id ?? '',
                            'payment_id'=>$webhook_calls_cin->payment_id ?? '',
                            'aviansys_amount'=>$webhook_calls_cin->aviansys_amount ?? '',
                            'gst_amount'=>$webhook_calls_cin->marrs_gst ?? '',
                            'comp_id'=>$webhook_calls_cin->comp_id ?? '',
                            'aviansys_tranfer_id'=>$aviansys_pay['transfer_id'] ?? '',
                            'gst_tranfer_id'=>$gst_pay_marrs['transfer_id'] ?? '',
                            'razpay_service'=>$webhook_calls_cin->razpay_service ?? '',
                            'crm_fix'=>$webhook_calls_cin->crm_fix ?? '',
                            'crm_fix_tranfer_id'=>$crm_pay['transfer_id'] ?? '',
                            'MaRRS_bal'=>$webhook_calls_cin->MaRRS_bal ?? '',
                            'date_of_payment'=>date('Y-m-d h:s:i'),
                            'management_amount'=>$webhook_calls_cin->management_amount ?? '',
                            'management_tranfer_id'=>$management_amount_pay['transfer_id'] ?? '',
                            'franchise_gst'=>$webhook_calls_cin->franchise_gst ?? '',
                            'aviansys_gst'=>$webhook_calls_cin->aviansys_gst ?? '',
                            'status'=>'1',
                            'maker_id'=>$maker->material_maker_id ?? '',
                            'total_maker_amount'=>$webhook_calls_cin->total_maker_amount ?? '',
                            'maker_transfer_id'=>$maker_pay['transfer_id'] ?? '',
                            'associate_gst'=>$webhook_calls_cin->associate_gst ?? '',
                            'associate_tranfer_id'=>$associate_pay['transfer_id'] ?? '',
                            'associate_amount'=>$webhook_calls_cin->associate_amount ?? '',
                            'associate_id'=>$webhook_calls_cin->associate_id ?? ''
                        ];
                        
                        $this->db->insert('payment_split',$inst);
                        
                        
                        
                        
                        $makers_splits = $this->db->get_where('makers_splits',['payment_id' => $order_id , 'cin' => $webhook_calls_cin->cin])->result();
                    
                        foreach($makers_splits as $makers_split) {
                            
                            $maker = $this->db->get_where('material_maker',['material_maker_id' => $makers_split->maker_id])->row();
                            $maker_pay = $this->fetch($order_id, $maker->razorpay_id, $makers_split->price * 100, $maker->account_name);
                            file_put_contents(APPPATH . 'logs/webhook.log', "💰 Transfer Response: " . print_r($maker_pay, true) . PHP_EOL, FILE_APPEND);
                            
                            $this->db->where('id',$makers_split->id);
                            $this->db->update('makers_splits',['transaction_id' => $maker_pay['transfer_id']]);
                            
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
                            
                        }
                        
                        $this->db->where('payment_id',$webhook_calls_cin->payment_id);
                        $this->db->where('cin',$webhook_calls_cin->cin);
                        $this->db->update('webhook_calls_cin',['status'=>1,'date_of_payment'=>date('Y-m-d h:s:i')]);
                        
                        
                        $this->db->where('cin',$webhook_calls_cin->cin);
                        $this->db->where('payment_id',$webhook_calls_cin->payment_id);
                        $this->db->delete('amount_cart');
                        
                    }
                    
                    
                   }elseif ($event['event'] === 'payment.failed') {
                    $paymentId = $event['payload']['payment']['entity']['id'];
                    $reason    = $event['payload']['payment']['entity']['error_description'] ?? 'Unknown error';
                    file_put_contents($_SERVER['DOCUMENT_ROOT']."/razorpay_webhook.log", 
                        "❌ Payment failed: ".$paymentId." | Reason: ".$reason.PHP_EOL, FILE_APPEND);
                }
                
                
                
            } else {
                file_put_contents(APPPATH . 'logs/webhook.log', "❌ Invalid signature" . PHP_EOL, FILE_APPEND);
            }
        } else {
            file_put_contents(APPPATH . 'logs/webhook.log', "❌ No signature header found" . PHP_EOL, FILE_APPEND);
        }
       } catch (Exception $e) {
                // Log error, but don’t break webhook
                file_put_contents($_SERVER['DOCUMENT_ROOT']."/razorpay_webhook_error.log", 
                    "Error: ".$e->getMessage().PHP_EOL, FILE_APPEND);
            }
    
        http_response_code(200);
    }


    
    public function fetch($order_id, $account_id, $amount, $account_razorpay_name)
    {
        // Step 1: Fetch payments for order
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.razorpay.com/v1/orders/'.$order_id.'/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
              ),
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $payments = json_decode($response, true);
        $payment_id = $payments['items'][0]['id'] ?? null;
        if (!$payment_id) return null;
    
        // Step 2: Transfer to account
        $on_hold_until = strtotime("+2 days");
    
        $transferPayload = json_encode([
            "transfers" => [[
                "account" => $account_id,
                "amount"  => $amount,
                "currency" => "INR",
                "notes" => [
                    "name" => $account_razorpay_name,
                    "roll_no" => "IEC2011025"
                ],
                "linked_account_notes" => ["roll_no"],
                "on_hold" => false,
                "on_hold_until" => $on_hold_until
            ]]
        ]);
    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.razorpay.com/v1/payments/'.$payment_id.'/transfers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $transferPayload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Basic cnpwX2xpdmVfa0c3ZjhuRjZzS0dQaHg6NjhudXNMYmd1aXp1bE9TQm40N1ZwZm1T'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $data = json_decode($response, true);
    
        return [
            'payment_id' => $payment_id,
            'transfer_id' => $data['id'] ?? null,
            'transfer_amount' => $amount,
            'raw_response' => $data
        ];
    }



}
