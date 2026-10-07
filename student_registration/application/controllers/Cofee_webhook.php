<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cofee_webhook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    public function index()
    {
        
        
        $input = file_get_contents('php://input');
        $payload = json_decode($input, true);

        if (!isset($payload['data']) || !isset($payload['data']['merchant_order_id'])) {
            log_message('error', 'Cofee Webhook: Missing merchant_order_id');
            http_response_code(400);
            return;
        }
        
        $merchant_order_id = $payload['data']['merchant_order_id'];
                
        $payment = $this->db->get_where('payment_split', ['payment_id' => $merchant_order_id,'status'=>0])->row();
    
        
        
        if (!$payment) {
            log_message('error', 'Cofee Webhook: payment_id not found: ' . $merchant_order_id);
            http_response_code(404);
            return;
        }
    
        $update_data = [
            'status' => 1
        ];
    
    
        
    
        $fields = [
            'franchise_tranfer_id',
            'aviansys_tranfer_id',
            'crm_fix_tranfer_id',
            'gst_tranfer_id',
            'management_tranfer_id'
        ];
    
        foreach ($fields as $field) {
            if (isset($payload[$field])) {
                $update_data[$field] = $payload[$field];
            }
        }
    
        $this->db->where('payment_id', $merchant_order_id);
        $this->db->update('payment_split', $update_data);
    
        $comp = $this->db->get_where('competition_product_state', ['id' => $payment->comp_id])->row();
        
        $cart_data = [
            'status' => 'Paid',
            'merchant_order_id' => $merchant_order_id,
            'cin' => $payment->cin,
            'period_id' => $comp->period_id,
            'clevel' => $payment->clevel,
            // 'comp_id' => $payment->comp_id,
            'amount' => $payment->total_amount,
            'product_name'=>$comp->product_name,
            'razorpay_payment_id'=>$payment->payment_id
        ];
    
        // print_r($comp);die;  
        
            
        // $this->db->where('cin', $payment->cin);
        // $this->db->where('comp_id', $payment->comp_id);
        $this->db->insert('new_cart', $cart_data);
    
      
        http_response_code(200);
        echo json_encode(['status' => 'success']);


    }
    
    
}
