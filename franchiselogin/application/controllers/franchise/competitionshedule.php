<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class competitionshedule extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        }
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('competitionshedulemodel');
        // $this->load->model('periodmodel');
        $this->load->model('loginModel');
        $this->load->model('franchisemodel');
        // $this->load->model('competitionlevelmodel');
        // $this->load->model('categorymodel');
// 		 $this->load->model('servicemodel');

    }
    
    public function competition_list()
    {
        
        if(isset($_POST['Search'])){
            // print_r($_POST);die;
            
            $fr_id = $this->session->userdata('franchise_id');
            $query = $this->db->query("SELECT state_id FROM franchise where franchise_id=  '{$fr_id}';");
    		$state=$query->row_array()['state_id'];
    		
            $this->db->select('competition_level_byproduct.level_name,period.academic_year,competition_product_state.*,competition_product_state.id as sch_id');
            $this->db->from('competition_product_state');
            $this->db->join('period', 'period.period_id = competition_product_state.period_id');
            $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
            $this->db->where('competition_product_state.state_id', $state);
            $this->db->where('competition_product_state.status', 'Live');
            $this->db->where('competition_product_state.product_name = competition_level_byproduct.product_name');
            
            if($_POST['product'] != ''){
                $this->db->where('competition_product_state.product_name',$_POST['product']);
            }
            if($_POST['level'] != ''){
                $this->db->where('competition_product_state.clevel',$_POST['level']);
            }
            if($_POST['period_id'] != ''){
                $this->db->where('competition_product_state.period_id',$_POST['period_id']);
            }
            $this->db->order_by('competition_product_state.id','DESC');
            $query = $this->db->get();
            $data['message']='Showing '.$_POST['product'].' Competition List';
            $data['registration_details']=$query->result_array();
            $data['result']=$_POST;
        }
        else{
            $fr_id = $this->session->userdata('franchise_id');
            $query = $this->db->query("SELECT state_id FROM franchise where franchise_id=  '{$fr_id}';");
    		$state = $query->row_array()['state_id'];
            $this->db->select('*,competition_product_state.id as sch_id');
            $this->db->from('competition_product_state');
            $this->db->join('period', 'period.period_id = competition_product_state.period_id');
            $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
            $this->db->where('competition_product_state.state_id', $state);
            $this->db->where('competition_product_state.status', 'Live');
            $this->db->where('competition_product_state.product_name = competition_level_byproduct.product_name');
            $this->db->order_by('competition_product_state.id','DESC');
            $this->db->limit(10);
            $query = $this->db->get();
            $data['message']='Showing Last 10 Competitions.';
            $data['registration_details']=$query->result_array();
        
        }
        
        
        // if (isset($_POST['export'])) {
        //     $id = $_POST['export'];
        
        //     if ($id > 145) {
                
        //         $this->db->select('*');
        //         $this->db->from('competition_product_state');
        //         $this->db->where('id', $id);
        //         $query = $this->db->get();
        //         $level = $query->row();
        //         $level_id = $level->clevel;
                
                
        //         $this->db->select('cin');
        //         $this->db->from('new_cart');
        //         $this->db->where('new_cart.clevel', $level_id);
        //         $this->db->where('new_cart.status', 'Paid');
        //         $this->db->group_by('cin');
        //         $query = $this->db->get();
        //         $registered_cins = $query->result(); 
        //         $all_cins = array_column($registered_cins, 'cin'); 
                
        //         $this->db->select('*');
        //         $this->db->from('cin_uploade');
        //         $this->db->join('cin_list', 'cin_list.cin = cin_uploade.cin');
        //         $this->db->join('school_new', 'school_new.id = cin_list.school_id');
        //         $this->db->where('comp_id', $id);
        //         $this->db->group_by('cin_uploade.cin');
        //         if (!empty($all_cins)) {
        //             $this->db->where_not_in('cin_uploade.cin', $all_cins);
        //         }
        //         $query = $this->db->get();
        //         $unregistered_cins = $query->result();
                
        //         // print_r($unregistered_cins); die();
               
                
        //     } 
        //     else {
        //         $this->db->select('*');
        //         $this->db->from('competition_product_state');
        //         $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
        //         $this->db->where('competition_product_state.id', $id);
        //         $query = $this->db->get();
        //         $competition = $query->row();
        
        //         if (!$competition) {
        //             die("Error: No competition data found.");
        //         }
        
        //         $medal = $competition->medal_no - 1;
        
        //         $this->db->select('*');
        //         $this->db->from('competition_level_byproduct');
        //         $this->db->where('medal_no', $medal);
        //         $this->db->where('product_name', $competition->product_name);
        //         $query = $this->db->get();
        //         $level = $query->row();
        
        //         if (!$level) {
        //             die("Error: No level data found.");
        //         }
        
        //         $clevel = $level->level_id;
        
        //         $this->db->select('cr.cin, cin_list.*');
        //         $this->db->from('cin_result as cr');
        //         $this->db->where('cr.clevel', $clevel);
        //         $this->db->where('cr.status', 'Q');
                
        //         if (!empty($competition->clevel)) {
        //             $this->db->join('new_cart as nc', 'cr.cin = nc.cin AND nc.clevel = ' . (int) $competition->clevel . ' AND nc.product_name = "' . $competition->product_name . '"', 'left');
        //         }
        
        //         $this->db->join('cin_list', 'cin_list.cin = cr.cin');
        //         $this->db->where('nc.cin IS NULL');
        //         $this->db->where('nc.product_name', $competition->product_name);
        //         $this->db->where('nc.period_id', $competition->period_id);
        //         $query = $this->db->get();
        //         $unregistered_cins = $query->result();
        //     }
            
        //     if (!empty($unregistered_cins)) {
        
        //         $headers = [
        //             'Sr. No', 'Student Name', 'CIN', 'Product', 'School',
        //             'Email', 'Phone', 'Class'
        //         ];

        //         $data = [];
        //         $sr_no = 1;
        
        //         foreach ($unregistered_cins as $payment) {
        //             // print_R($payment->student_name);die;
        //             $data[] = [
        //                 $sr_no++,
        //                 $payment->student_name, 
        //                 $payment->cin,
        //                 $payment->product_name,
        //                 $payment->school_name,
        //                 $payment->stud_email,
        //                 $payment->stud_phone,
        //                 $payment->class,
        //             ];
        //         }
        
        //         header('Content-Type: text/csv');
        //         header('Content-Disposition: attachment; filename="un_registered.csv"');
        //         header('Pragma: no-cache');
        //         header('Expires: 0');
        
        //         $handle = fopen('php://output', 'w');
        //         fputcsv($handle, $headers);
        
        //         foreach ($data as $row) {
        //             fputcsv($handle, $row);
        //         }
        
        //         fclose($handle);
        //         exit();
        //     } 
            
        // }
        
        
        
        // if (isset($_POST['add'])) {
        //     $id = $_POST['add'];
        
            
        //         $this->db->select('*');
        //         $this->db->from('cin_uploade');
        //         $this->db->join('competition_product_state', 'cin_uploade.comp_id = competition_product_state.id');
        //         $this->db->join('cin_list', 'cin_list.cin = cin_uploade.cin');
        //         $this->db->where('cin_uploade.id', $id);
        //         $this->db->group_by('cin_uploade.cin');
        //         $query = $this->db->get();
        //         $unregistered_cins = $query->result();
            
            
        //     if (!empty($unregistered_cins)) {
        
        //         $headers = [
        //             'Sr. No', 'Student Name', 'CIN', 'Product', 'School',
        //             'Email', 'Phone', 'Class'
        //         ];

        //         $data = [];
        //         $sr_no = 1;
        
        //         foreach ($unregistered_cins as $payment) {
        //             // print_R($payment->student_name);die;
        //             $data[] = [
        //                 $sr_no++,
        //                 $payment->student_name, 
        //                 $payment->cin,
        //                 $payment->product_name,
        //                 $payment->school_name,
        //                 $payment->stud_email,
        //                 $payment->stud_phone,
        //                 $payment->class,
        //             ];
        //         }
        
        //         header('Content-Type: text/csv');
        //         header('Content-Disposition: attachment; filename="all_registered.csv"');
        //         header('Pragma: no-cache');
        //         header('Expires: 0');
        
        //         $handle = fopen('php://output', 'w');
        //         fputcsv($handle, $headers);
        
        //         foreach ($data as $row) {
        //             fputcsv($handle, $row);
        //         }
        
        //         fclose($handle);
        //         exit();
        //     } 
            
        // }
        
        
            $this->db->select('*');  
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product']);
            $query = $this->db->get();   
            $data['load_level']=$query->result_array();
            
    
            $this->db->select('*');  
            $this->db->from('products');
            $this->db->where('status','Active');  
            $query = $this->db->get();   
            $data['load_product']=$query->result_array();
    
            $this->db->select('*');  
            $this->db->from('period');
            $this->db->where('period_id >','12');  
            $query = $this->db->get();   
            $data['loadperiod']=$query->result_array();
        
        
        $this->load->view("competition_list.php", $data);
        
    }
   
    
    public function activate_cin()
    {
        $uri = $this->uri->uri_to_assoc(4);
        $competion_schedule_id = $id = $this->uri->segment(4);
        
        $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->join('states', 'states.state_subdivision_id = competition_product_state.state_id');
        $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel','left');
        $this->db->where('competition_product_state.id', $competion_schedule_id);
        
        $query = $this->db->get();
        $data['competition'] = $competition = $query->row();
        
        // print_r($schedule);die;
        
        $data['level_id'] = $schedule['clevel'];
        $data['period_id'] = $schedule['period_id'];
        $data['product_id'] = $schedule['product_id'];

        if($data['product_id'] == 0 or empty($data['product_id']))
        {
            $product = $this->db->get_where('products',array('product_name'=>$schedule['product_name']))->row();
            $data['product_id']=$product->product_id;
        }
        
        
        $data['message'] = '';
        // print_r($insert_array);die;
    
        // ====================== CSV Upload ========================= //
        if (isset($_POST['submit']) && isset($_FILES['csv']) && $_FILES['csv']['size'] > 0) {
            
            $file = $_FILES['csv']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
            $arr = [];
    
            
            if ($ext === 'csv') {
                
                
                
                $handle = fopen($file, "r");
                $i = 0;
    
                while (($row = fgetcsv($handle, 1000)) !== false) {
                    
                    $cin = addslashes($row[0]);
                    // print_R($row);    
                    // echo $cin;die;
                    
                        $paid = $this->db->get_where('new_cart', [
                            'clevel' => $competition->clevel,
                            'cin' => $cin,
                            'status' => 'Paid'
                        ])->row();
                        
                        
                        $unpaid = $this->db->get_where('payment_split', [
                            'clevel' => $competition->clevel,
                            'cin' => $cin,
                            'status' => 0
                        ])->row();
                    
                        $ar = [
                            'comp_id' => $id,
                            'cin' => $cin
                        ];
                        
                        // print_r($ar);die;
                    
                        // Remove if CIN already uploaded
                        $existing = $this->db->get_where('cin_uploade', [
                            'comp_id' => $id,
                            'cin' => $cin
                        ])->row();
                        
                        
                    
                        if ($existing) {
                            $this->db->delete('cin_uploade', ['id' => $existing->id]);
                        }
                        
                        
                    
                        if (isset($_POST['competition']) && $_POST['competition'] === 'on' && empty($unpaid)) {
                            
                            echo 'ok';die;
                            
                            $re = $this->add_cart($cin, $id, $settlement_details, $insert_array, $text);
                    
                            // print_r($re);
                            // echo 'cofee result';die;
                            
                                if ($re['status'] == 1) {
                                    
                                    $this->db->insert('cin_uploade', $ar);
                                    $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . $re['error'] . ' Cofee Notification Sent Successfully.';
                                    
                                } else {
                                    $ar['message'] = $re['error'] . ' No Cofee Notification Sent.';
                                }
                            
                            
                            
                            
                        } else {
                            
                            
                            $this->db->insert('cin_uploade', $ar);
                    
                            
                            $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . 'CIN activated successfully for competition.';
                        }
                    
                        $arr[] = $ar;
                    }
                        
                fclose($handle);
                
                $data['ar'] = $arr;
                $data['message'] = 'File uploaded successfully.';
            } else {
                $data['message'] = 'Error: Not a CSV file.';
            }
        } 
        
         
         
         
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
           
    	$this->load->view("cin_upload.php",$data);
    }
    
    
    public function cin_upload()
    {
        $id = $this->uri->segment(4);
        $text='MaRRS SE Interschool';
        // Fetch competition data
        $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->join('states', 'states.state_subdivision_id = competition_product_state.state_id');
        // $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
        $this->db->where('competition_product_state.id', $id);
        
        $query = $this->db->get();
        $data['competition'] = $competition = $query->row();
        
        
        $this->db->select('*');
        $this->db->from('competition_level_byproduct');
        $this->db->where('product_name', $competition->product_name);
        $this->db->where('level_id', $competition->clevel);
        $query = $this->db->get();
        $level = $query->row();
        
        $message=$competition->product_name.' Registration for '.$level->level_name;
    
    
        $state_id = $competition->state_id;
        $period_id = $competition->period_id;
        $clevel = $competition->clevel;
        $product_name = $competition->product_name;
        $franchise_id = $competition->franchise_id;
        $comp_id = $competition->id;
    
        $franchise_per = $competition->com_per;
        $aviansys_per = $competition->com_peravian;
        $manage_per = $competition->manageper;
        $franchise_gst = $competition->franchise_gst;
        $aviansys_gst = $competition->aviansys_gst;
        $crm_fix = $competition->crm_fix;
    
        
    
        $total_amount = $competition->product_price; // 736
        $razpay_service = 0;
        $gross_settlement = $total_amount - $razpay_service; // 726.196
        
        // Base without GST (726.196 / 1.18)
        $base_cost = round($gross_settlement / 1.18, 6); // 615.420635
        $GST = $gross_settlement - $base_cost; // 110.775714
        
        // === Shares on base cost (before any CRM deduction) ===
        $Franchise_pay = round($base_cost * $franchise_per / 100, 6); // 307.71
        $Aviasys_pay = round($base_cost * $aviansys_per / 100, 6);     // 92.313
        $management_pay = round($base_cost * $manage_per / 100, 6);    // 92.313
        
        // === GST distribution ===
        $GST_fr = ($franchise_gst == 'yes') ? round($GST * $franchise_per / 100, 6) : 0; // 0
        $GST_av = ($aviansys_gst == 'yes') ? round($GST * $aviansys_per / 100, 6) : 16.616; // 15% of 110.775
        $GST_rest = $GST - $GST_fr - $GST_av; // Goes to Coral (SIB)
        
        // === Total to be credited ===
        $total_AvianSys = $Aviasys_pay + $GST_av; // 108.929
        $total_Franchise = $Franchise_pay + $GST_fr; // 307.71
        $totalcut = $total_AvianSys + $total_Franchise + $management_pay;
        
        // === Remaining after all above ===
        $MaRRS_bal = $base_cost - ($Franchise_pay + $Aviasys_pay + $management_pay); // approx 123.08
        
        // Settlement breakdown
        
            $management_pay = round($management_pay);            // 92.31
            $Franchise_pay = round($Franchise_pay);                // 307.71
            $Aviasys_pay = round($Aviasys_pay);                   // 92.31
            $GST_Av = round($GST_av);                     // 16.62
            $crm_fix = $crm_fix;                                       // 40
            $MaRRS_bal = round($MaRRS_bal);                 // 123.08
            $rest_GST = round($GST_rest);                    // 94.16
            $GST_fr = round($GST_fr);   

       
            $totalFranchise_pay=$Franchise_pay+$GST_fr;
            $totalAviasys_pay=$Aviasys_pay+$GST_Av;
        
        // Insert array build
        $insert_array = [
            'franchise_id' => $franchise_id,
            'clevel' => $clevel,
            // 'cin' => $cin,
            'payment_id' => '',
            'total_amount' => $total_amount,
            'comp_id' => $comp_id,
            'razpay_service' => $razpay_service,
            'franchise_gst' => $GST_fr,
            'aviansys_gst' => $GST_Av,
            'crm_fix' => $crm_fix,
            'crm_fix_tranfer_id' => '',
            'gst_amount' => $rest_GST,
            'gst_tranfer_id' => '',
            'management_amount' => $management_pay,
            'management_tranfer_id' => '',
            'franchise_amount' => $Franchise_pay,
            'franchise_tranfer_id' => '',
            'aviansys_amount' => $Aviasys_pay,
            'aviansys_tranfer_id' => '',
            'MaRRS_bal' => $MaRRS_bal,
            'date_of_payment' => date("Y-m-d"),
            'status' => 0
        ];
        
        
       
        $settlement_details = [];

        $settlement = [];
        
        // management  pay
        if($management_pay > 0){
            $manage = $this->db->get_where('gst_account_marrs',array('id' =>'7'))->row();
            $manage_account_id=$manage->cofee_account_id;
            $settlement_details[] = [
                "account_reference_id" => $manage_account_id,
                "amount" => $management_pay
            ];
            $settlement[] = [
                "account_number" => $manage->account_number,
                "amount" => $management_pay,
                'for'=>' Management '
            ];
        }
        // Marrs GST
        if($rest_GST > 0){
            $gst = $this->db->get_where('gst_account_marrs',array('id' =>'1'))->row();
    	    $gst_account_id=$gst->cofee_account_id; 
    	    $settlement_details[] = [
                "account_reference_id" => $gst_account_id,
                "amount" => $rest_GST
            ];
            $settlement[] = [
                "account_number" => $gst->account_number,
                "amount" => $rest_GST,
                'for'=>' MaRRS GST '
            ];
        }
          
        // CRM Split
        if($crm_fix > 0){
            $gsts = $this->db->get_where('gst_account_marrs',array('id' =>'5'))->row();
    	    $crm_account_id=$gsts->cofee_account_id;
    	    $settlement_details[] = [
                "account_reference_id" => $crm_account_id,
                "amount" => $crm_fix
            ];
            $settlement[] = [
                "account_number" => $gsts->account_number,
                "amount" => $crm_fix,
                'for'=>' CRM '
            ];
        }    

        // Franchise Split
        if($Franchise_pay > 0){
            $franchise = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row();
    	    $franchiseaccount_id=$franchise->cofee_account_id;
    	    $settlement_details[] = [
                "account_reference_id" => $franchiseaccount_id,
                "amount" => $totalFranchise_pay
            ];
            $settlement[] = [
                "account_number" => $franchise->account_number,
                "amount" => $totalFranchise_pay,
                'for'=>' Franchise '
            ];
        }    
        
        // AvianSys split
        if ($Aviasys_pay > 0) {
            $aviansys = $this->db->get_where('gst_account_marrs',array('id' =>'2'))->row();
    	    $aviansys_cofee_id=$aviansys->cofee_account_id;
    	    
            $settlement_details[] = [
                "account_reference_id" => $aviansys_cofee_id,
                "amount" => $totalAviasys_pay
            ];
            $settlement[] = [
                "account_number" => $aviansys->account_number,
                "amount" => $totalAviasys_pay,
                'for'=>' AvianSys '
            ];
        }
        
        // rest amount to marrs
        $settlement_total = 0;
        foreach ($settlement_details as $item) {
            $settlement_total += $item['amount'];
        }
        
        
        $diff = $total_amount - $settlement_total;
        
        $settlement_total=round($settlement_total);
    
        
        if ($settlement_total != $total_amount) {
            $diff = $total_amount - $settlement_total;
        
            if ($diff != 0) {
                $default = $this->db->get_where('gst_account_marrs', array('id' => '6'))->row();
                $default_cofee_account_id = $default->cofee_account_id;
        
                $settlement_details[] = [
                    "account_reference_id" => $default_cofee_account_id,
                    "amount" => $diff
                ];
                $settlement[] = [
                    "account_number" => $aviansys->account_number,
                    "amount" => $diff,
                    'for'=>' Rest MaRRS '
                ];
                
            }
        }

        // echo $total_amount.'<br>';
        // echo $diff.'<br>';
        // echo $settlement_total;die;
        
        $data['message'] = '';
        // print_r($insert_array);die;
    
        // ====================== CSV Upload ========================= //
        if (isset($_POST['submit']) && isset($_FILES['csv']) && $_FILES['csv']['size'] > 0) {
            
            $file = $_FILES['csv']['tmp_name'];
            $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
            $arr = [];
    
            
            if ($ext === 'csv') {
                
                
                
                $handle = fopen($file, "r");
                $i = 0;
    
                while (($row = fgetcsv($handle, 1000)) !== false) {
                    
                     $cin = addslashes($row[0]);
                        
                        $paid = $this->db->get_where('new_cart', [
                            'clevel' => $competition->clevel,
                            'cin' => $cin,
                            'status' => 'Paid'
                        ])->row();
                        
                        
                        $unpaid = $this->db->get_where('payment_split', [
                            'clevel' => $competition->clevel,
                            'cin' => $cin,
                            'status' => 0
                        ])->row();
                    
                                $ar = [
                                    'comp_id' => $id,
                                    'cin' => $cin
                                ];
                        
                    
                        // Remove if CIN already uploaded
                        $existing = $this->db->get_where('cin_uploade', [
                            'comp_id' => $id,
                            'cin' => $cin
                        ])->row();
                        
                        
                    
                        if ($existing) {
                            $this->db->delete('cin_uploade', ['id' => $existing->id]);
                        }
                        // print_r($existing);die;
                    
                        if (isset($_POST['competition']) && $_POST['competition'] === 'on' && empty($unpaid)) {
                            
                        
                            $re = $this->add_cart($cin, $id, $settlement_details, $insert_array, $text);
                    
                            // print_r($re);
                            // echo 'cofee result';die;
                            
                                if ($re['status'] == 1) {
                                    
                                    $this->db->insert('cin_uploade', $ar);
                                    $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . $re['error'] . ' Cofee Notification Sent Successfully.';
                                    
                                } else {
                                    $ar['message'] = $re['error'] . ' No Cofee Notification Sent.';
                                }
                            
                            
                            
                            
                        } else {
                            
                            
                            $this->db->insert('cin_uploade', $ar);
                    
                            
                            $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . 'CIN activated successfully for razorpay.';
                        }
                    
                        $arr[] = $ar;
                    }
                        
                fclose($handle);
                
                $data['ar'] = $arr;
                $data['message'] = 'File uploaded successfully.';
            } else {
                $data['message'] = 'Error: Not a CSV file.';
            }
        } 
        
        // else {
        //     $data['message'] = 'Error: Form not submitted or file missing.';
        // }
    
        $this->load->view("cin_upload.php", $data);
    }
    
	
    public function upload()
    {
        $uri = $this->uri->uri_to_assoc(4);
        $competion_schedule_id = $uri['id'];
                
        // echo $competion_schedule_id;die;
        
        $schedule      = $this->db->get_where('competition_product_state',array('id'=>$competion_schedule_id))->row_array();
        
        
        // print_r($schedule);die;
        
        $data['level_id']=$schedule['clevel'];
        $data['period_id']=$schedule['period_id'];
        $data['product_id']= $schedule['product_id'];

        if($data['product_id'] == 0 or empty($data['product_id']))
        {
            $product = $this->db->get_where('products',array('product_name'=>$schedule['product_name']))->row();
            $data['product_id']=$product->product_id;
        }
        
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
        {  
            //print_r($_POST);die;
    
    	    $subject           = $this->input->post('subject');
    
    	    $series          =  $this->input->post('series');
    
    		$csvResult_upolad_logArray = array();
    
    		 
    
			$start_cell_row=2;/*skip first 2 heading rows */

			$i=0;
    
    		 
    
    		 if($_FILES['csv']['size'] > 0) 
    		 {   
    
    			 	//get the csv file 
    
    				$file = $_FILES['csv']['tmp_name']; 
    
    				$handle = fopen($file,"r"); 
    
    				//loop through the csv file and insert into database 
    
    				do
    
    				{	
    
    				  if($i >= $start_cell_row)
    
    				  { //echo 'okk';die;
    				      //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];die;
    
    				     if($resultRow_from_csv[0]) 
    
    					 { 
    
    						
    						$prid           =  addslashes($resultRow_from_csv[0]);
    						$result            =  addslashes($resultRow_from_csv[1]);
    						$grade            =  addslashes($resultRow_from_csv[2]);
                            $rank            =  addslashes($resultRow_from_csv[3]);
                            $marks            =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller            =  addslashes($resultRow_from_csv[6]);
                            
        //                     $venue            =  addslashes($resultRow_from_csv[9]);
    
    				// 		$comp_date            =  addslashes($resultRow_from_csv[10]);
    						
    						$csv_result_array  =  array('period_id'                => $data['period_id'] , 
    
    						                               'clevel'              => $data['level_id'] ,
    
    													   'product_id'            =>$data['product_id'],
    
    													   'cin'               =>$prid,
    
    													   'status'             =>$result,
    
    													   'search_period'          => $data['period_id'],
    
    													   'search_level'           => $data['level_id'],
    
    													   'search_product'         => $data['product_id'],
    													   
    													   'grade'=>$grade,
    													   'rank'=>$rank,
    													   'performer'=>$performer,
    													   'speller'=>$speller,
    													   'marks'=>$marks,
    													   
    													 );
    
    
    
    				// 			echo "<pre>";print_r($csv_result_array);exit;					   
    
    						 $csv_upload_status = $this->loginModel->result_check($csv_result_array,$schedule,$subject,$series);
    
    						 array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    					 }/*End if*/
    
    					 
    
    					}
    
    				$i=$i+1;	
    
    			   }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
    
    			    
    
    			   /*............ End Do while ................*/
    
    			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    
    			   /*unset($_FILES);*/
    
    			   $this->notifications->notify('Result Uploaded Successfully','success');
    
    		   }/* End if */
    
         }/* End of if */
         
         
        if(isset($_POST['download']))
        {
            
            $filepath="public/template/MARRS_RESULT_UPLOAD.csv";
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
         
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
           
    	$this->load->view("upload_result.php",$data);
    }
    
    
    public function upload1()
    {
        $uri = $this->uri->uri_to_assoc(4);
        $competion_schedule_id = $uri['id'];
                
        // echo $competion_schedule_id;die;
        
        $schedule      = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$competion_schedule_id))->row_array();
        
        
        // print_r($schedule);die;
        
        $data['level_id'] = $schedule['competition_level_id'];
        $data['period_id'] = $schedule['period_id'];
        $data['product_id'] = $schedule['product_id'];

        if($data['product_id'] == 0 or empty($data['product_id']))
        {
            $product = $this->db->get_where('products',array('product_name'=>$schedule['product_name']))->row();
            $data['product_id']=$product->product_id;
        }
        
        
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
        {  
            //print_r($_POST);die;
    
    	    $subject                   =  $this->input->post('subject');
    
    	    $series                    =  $this->input->post('series');
    
            $venue                     =  $schedule['center_address'];
            
            $comp_date                 =  $schedule['competition_date'];
            
    		$csvResult_upolad_logArray = array();
    
    		 
    
			$start_cell_row=2;/*skip first 2 heading rows */

			$i=0;
    
    		 
    
    		 if($_FILES['csv']['size'] > 0) 
    		 {   
    
    			 	//get the csv file 
    
    				$file = $_FILES['csv']['tmp_name']; 
    
    				$handle = fopen($file,"r"); 
    
    				//loop through the csv file and insert into database 
    
    				do
    
    				{	
    
    				  if($i >= $start_cell_row)
    
    				  { //echo 'okk';die;
    				      //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];die;
    
    				     if($resultRow_from_csv[0]) 
    					 { 
    
    						
    						$prid                 =  addslashes($resultRow_from_csv[0]);
    						$result               =  addslashes($resultRow_from_csv[1]);
    						$grade                =  addslashes($resultRow_from_csv[2]);
                            $rank                 =  addslashes($resultRow_from_csv[3]);
                            $marks                =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller              =  addslashes($resultRow_from_csv[6]);
                            //  $venue            =  addslashes($resultRow_from_csv[9]);
    				        // 	$comp_date        =  addslashes($resultRow_from_csv[10]);
    						
    						$csv_result_array  =  array(   
						                                'period_id'              => $data['period_id'] , 
						                                'clevel'                 => $data['level_id'] ,
													    'product_id'             => $data['product_id'],
													    'cin'                    => $prid,
													    'status'                 => $result,
													    'search_period'          => $data['period_id'],
													    'search_level'           => $data['level_id'],
													    'search_product'         => $data['product_id'],
													    'grade'                  => $grade,
													    'rank'                   => $rank,
													    'performer'              => $performer,
													    'speller'                => $speller,
													    'marks'                  => $marks,
													    'venue'                  => $venue,
													    'competition_date'       => $comp_date
    												);
    
				// 			echo "<pre>";print_r($csv_result_array);exit;					   
    
    						$csv_upload_status = $this->loginModel->result_checkfranchise($csv_result_array,$schedule,$subject,$series);
    
                            // echo "<pre>";print_r($csv_upload_status);exit;
                            
    						array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    					 }/*End if*/
    
    				}
    
    				$i=$i+1;	
    
    			   }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
    
    			    
    
    			   /*............ End Do while ................*/
    
    			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    
    			   /*unset($_FILES);*/
    
    			   $this->notifications->notify('Result Uploaded Successfully','success');
    
    		   }/* End if */
    
         }/* End of if */
         
         
        if(isset($_POST['download']))
        {
            
            $filepath="public/template/MARRS_RESULT_UPLOAD.csv";
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
         
         
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
           
    	$this->load->view("upload_result.php",$data);
    }
    
    
    public function close_exam()    
    {
           
            $id=$this->uri->segment(4);
            $data['id'] = $id;
            
            if (isset($_POST['back'])) {
                redirect('franchise/competitionshedule/competition_list');
            }
            
            $stat = $this->db->get_where('exam_centers', array('center_id' => $id))->row_array();
            
            if (isset($_POST['submit'])) {
                $ar = array(
                    'center_name' => $_POST['center_name'] !== '' ? $_POST['center_name'] : $stat['center_name'],
                    'center_address' => $_POST['center_address'] !== '' ? $_POST['center_address'] : $stat['center_address'],
                    'exam_date' => $_POST['exam_date'] !== '' ? $_POST['exam_date'] : $stat['exam_date'],
                    'exam_time' => $_POST['exam_time'] !== '' ? $_POST['exam_time'] : $stat['exam_time'],
                );
        
                $this->db->where('center_id', $id);
                $this->db->update('exam_centers', $ar);
                redirect('franchise/competitionshedule/competition_list');
            }
        
        $this->load->view("close_exam.php", $data);
    }
    
    
    public function offline_payments()
    {
        //echo 'ok';die;
        $fr_id = $this->session->userdata('franchise_id');
        $query = $this->db->query("SELECT state_id FROM franchise where franchise_id=  '{$fr_id}';");
		$state=$query->row_array()['state_id'];
        //echo $state;
        
        
        //echo $fr_id;die;
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            
                $this->db->select('status');
                $this->db->from('competition_product_state');
                $this->db->where('competition_product_state.product_name', $_POST['product']);
                $this->db->where('competition_product_state.clevel', $_POST['level']);
                // $this->db->where('competition_product_state.product_name = competition_level_byproduct.product_name');
                $query = $this->db->get();
                //echo $this->db->last_query();
                $stat=$query->result_array()[0]['status'];
                if($stat=='Live'){
                    $data['msg']='Competition Is Live.';
                }else{
                    $data['msg']='Competition Is not Live.';
                    
                };
        }
        $this->load->view("offline_payments.php", $data);
    }
    
    
    public function cin_enquiries()
    {
        $fr_id = $this->session->userdata('franchise_id');
        $query = $this->db->query("SELECT state_id FROM franchise where franchise_id=  '{$fr_id}';");
		$state_id =$query->row_array()['state_id'];
		
        if(isset($_POST['submit'])){
            $this->db->select('enquiry.ticket_number,enquiry.enquiry_id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_list.state_id,enquiry.enquiry,enquiry.date,enquiry.status,enquiry.ticket_number,enquiry.evidence,enquiry_type.enquiry_name');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type','left');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin','left');
            $this->db->where('enquiry.state_id', $state_id);
            if($_POST['status']!='All'){
                $this->db->where('enquiry.status', $_POST['status']);
            }
            if($_POST['enquiry_type']!='All'){
                $this->db->where('enquiry_type.enquiry_id', $_POST['enquiry_type']);
            }
            
            $this->db->where('date >=', $_POST['start_date']);
            $this->db->where('date <=', $_POST['end_date']);
            $this->db->order_by('enquiry.enquiry_id','DESC');
            // $this->db->limit('50');
            $query = $this->db->get();
            $data['registration_details']=$query->result_array();
            if(empty($data['registration_details'])){
                $data['message']='No Enquiry Found ...';
            }else{
                $data['message']='Enquiries Found ...';
            }
        }else{
            $this->db->select('enquiry.ticket_number,enquiry.enquiry_id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_list.state_id,enquiry.enquiry,enquiry.date,enquiry.status,enquiry.ticket_number,enquiry.evidence,enquiry_type.enquiry_name');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type','left');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin','left');
            $this->db->where('enquiry.state_id', $state_id);
            // $this->db->where('enquiry.status', 'Open');
            $this->db->order_by('enquiry.enquiry_id','DESC');
            $this->db->limit('50');
            $query = $this->db->get();
            $data['registration_details']=$query->result_array();
            
            if(empty($data['registration_details'])){
                $data['message']='No Enquiry Found ...';
            }else{
                $data['message']='By Default Showing Last 50 Enquiries...';
            }
        }
        
        if(isset($_POST['status'])){
            $this->db->where('enquiry_id',$_POST['enquiry_id']);
            $this->db->update('enquiry',array('status'=>$_POST['status'],'reply'=>$_POST['reply']));
            $data['message']='Status Updated ...';
        }
        
        
        
    $this->load->view("cin_enquiries.php", $data);
        
    }
    
    
    public function index() 
    {
        $fr_id = $this->session->userdata('franchise_id');
		$fr_service_id = $this->session->userdata('fr_service_id');        
		if (isset($_POST['Search'])) {
            $link = SITE_URL . "competitionshedule/index/";
            if ($this->input->post('period_id')) {
                $link .= "period_id/" . $this->input->post('period_id') . "/";
            }
            if ($this->input->post('competition_level_id')) {
                $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/";
            }
            redirect($link, 'refresh');
        } 
		else {
            $uri = $this->uri->uri_to_assoc(4);
            if (isset($uri['period_id'])) {
                $period_id = $uri['period_id'];
            } else {
                $period_id = '';
            }
            if (isset($uri['competition_level_id'])) {
                $competition_level_id = $uri['competition_level_id'];
            } else {
                $competition_level_id = '';
            }
            $params       = array(
                'fr_id' => $fr_id,
                'period_id' => $period_id,
                'competition_level_id' => $competition_level_id
            );
            $data['list'] = $this->competitionshedulemodel->listcompetitionshedule($params);
        }
		 $params=array( "fr_id" => $this->session->userdata('franchise_id') , "service_id" => $this->session->userdata('fr_service_id'));
		$data['franchise']            = $this->franchisemodel->listFranchise();
        $data['period']               = $this->periodmodel->listperiod();
        $data['level']                = $this->competitionlevelmodel->listcompetitionlevel( $params);
        $data['fr_id']                = $fr_id;
        $data['period_id']            = $period_id;
        $data['competition_level_id'] = $competition_level_id;
        $this->load->view("competitionsheduleList.php", $data);
    }
	
	
	public function search()
    {
        $fr_id = $this->session->userdata('franchise_id');
    
        // Get state safely
        $state = $this->db
            ->select('state_id')
            ->where('franchise_id', $fr_id)
            ->get('franchise')
            ->row()
            ->state_id;
    
        $isSearch = $this->input->post('Search');
    
        $this->db->select('
            categoryBYProduct.category_name,
            competition_level_byproduct.level_name,
            period.academic_year,
            competition_schedule.*,
            competition_schedule.competition_schedule_id AS sch_id
        ');
        
        $this->db->from('competition_schedule');
        $this->db->join('period', 'period.period_id = competition_schedule.period_id');
        $this->db->join(
            'categoryBYProduct',
            'categoryBYProduct.category_id = competition_schedule.category_id',
            'left'
        );
        $this->db->join(
            'competition_level_byproduct',
            'competition_level_byproduct.level_id = competition_schedule.competition_level_id'
        );
    
        $this->db->where('competition_schedule.franchise_id', $fr_id);
    
        $this->db->group_by('competition_schedule.competition_schedule_id');
        
        if(isset($_POST['Search']))
        {
            if ($this->input->post('product'))
            {
                $this->db->where('competition_schedule.product_name', $this->input->post('product'));
            }
    
            if ($this->input->post('level'))
            {
                $this->db->where('competition_schedule.competition_level_id', $this->input->post('level'));
            }
    
            if ($this->input->post('period_id'))
            {
                $this->db->where('competition_schedule.period_id', $this->input->post('period_id'));
            }
    
            $data['message'] = 'Showing Competition Schedule List';
            $data['result']  = $this->input->post();
        }
        else{
            $this->db->limit(10);
            $data['message'] = 'Showing Last 10 Competitions.';
            $data['result']  = [];
        }    
        
    
        $this->db->order_by('competition_schedule.competition_schedule_id', 'DESC');
        
        $query = $this->db->get();
        $data['registration_details'] = $query->result_array();
    
    
        /* ---------- LOAD DROPDOWNS ---------- */
    
        // Load levels only if product selected
        if (!empty($data['result']['product']))
        {
            $data['load_level'] = $this->db
                ->where('product_name', $data['result']['product'])
                ->get('competition_level_byproduct')
                ->result_array();
        }
        else
        {
            $data['load_level'] = [];
        }
    
        $data['load_product'] = $this->db
            ->where('status', 'Active')
            ->get('products')
            ->result_array();
    
        $data['loadperiod'] = $this->db
            ->where('period_id >', 12)
            ->get('period')
            ->result_array();
    
        // print_r($data['registration_details'] );die;
        
        $this->load->view("competition_schedule_list.php", $data);
    }


    public function cin_genration()
    {
        $sch_id = $this->uri->segment(4);
// 		echo $sch_id;die;
		
		$this->db->select('
            categoryBYProduct.category_name,
            competition_level_byproduct.level_name,
            period.academic_year,
            competition_schedule.*,
            competition_schedule.competition_schedule_id AS sch_id
        ');
        
        $this->db->from('competition_schedule');
        $this->db->join('period', 'period.period_id = competition_schedule.period_id');
        $this->db->join(
            'categoryBYProduct',
            'categoryBYProduct.category_id = competition_schedule.category_id',
            'left'
        );
        $this->db->join(
            'competition_level_byproduct',
            'competition_level_byproduct.level_id = competition_schedule.competition_level_id'
        );
    
        $this->db->where('competition_schedule.competition_schedule_id', $sch_id);
        $this->db->group_by('competition_schedule.competition_schedule_id');
        
		$query = $this->db->get();
        $data['schedule'] = $schedule = $query->row();
    
// 		print_r($schedule);
		
		if(isset($_POST['submit'])) 
		{
	      
    	    $product      = $this->input->post('product');
    		$franchise_id = $this->session->userdata('franchise_id');
    		$school       = $this->input->post('school');
    		$period_id    = $this->input->post('period_id');
    		$clevel       = $this->input->post('1');
    		$state_id     = $this->input->post('state_id');
    		$country_id   = $this->input->post('country');
    		$area_code    = $this->input->post('area_code');
    		
    		$pro = $this->db->get_where('products',array('product_id'=>$product))->row();
        
    		$product = $pro->product_name; 
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row = 2;/*skip first 2 heading rows */
    		$i=0;
		
    		if($_FILES['csv']['size'] > 0) 
    		{   
				  //get the csv file 
				  $file = $_FILES['csv']['tmp_name']; 
				  $handle = fopen($file,"r"); 
				  $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
				  $type = $_FILES['csv']['type'];
				  
				  if($ext === 'csv')
				  {
				  
					 //loop through the csv file and insert into database 
					do
					{	
					if($i >= $start_cell_row)
					{ //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];
					   if($resultRow_from_csv[0]) 
					   { 
					       //print_r($resultRow_from_csv);die;
						
						  $class_id            =  addslashes($resultRow_from_csv[0]);
						  //$category_id            =  addslashes($resultRow_from_csv[1]);
						  $stud_name            =  addslashes($resultRow_from_csv[1]);
						  $gender            =  addslashes($resultRow_from_csv[2]);
						  $father_name            =  addslashes($resultRow_from_csv[3]);
						  $mother_name            =  addslashes($resultRow_from_csv[4]);
						  $communication_address  =  addslashes($resultRow_from_csv[5]);
						  $communication_address1  =  addslashes($resultRow_from_csv[6]);
						  $pincode  =  addslashes($resultRow_from_csv[7]);
						  $email  =  addslashes($resultRow_from_csv[8]);
						  $mobile_number  =  addslashes($resultRow_from_csv[9]);  
						  
						  if($class_id==1){  $class = 'Nursery';}
						   if($class_id==2){  $class = 'LKG';}
						   if($class_id==3){  $class = 'UKG';}
						   if($class_id==4){  $class = 'Class-1';}
						   if($class_id==5){  $class = 'Class-2';}
						   if($class_id==6){  $class = 'Class-3';}
						   if($class_id==7){  $class = 'Class-4';}
						   if($class_id==8){  $class = 'class-5';}
						   if($class_id==9){  $class = 'Class-6';}
						   if($class_id==10){  $class = 'Class-7';}
						   if($class_id==11){  $class = 'Class-8';}
						   if($class_id==12){  $class = 'Class-9';}
						   if($class_id==13){  $class = 'Class-10';}
						   if($class_id==14){  $class = 'Class-11';}
						   if($class_id==15){  $class = 'Class-12';}
						  
						    $csv_result_array  =  array(   
	                                    'period_id'  => $period_id , 
									    'school_id'  => $school,
									    'country_id' =>  $country_id,
									    'state_id'   => $state_id,
									    'class_id'   =>  $class_id,
									    'class'      =>$class,
									    'area_code'  =>$area_code,
									    'category_id' =>  $category_id,
									    'clevel'      => $clevel,
									    'stud_name'  =>  $stud_name,
									    'gender'        => $gender  ,
									    'father_name'   => $father_name,
									    'mother_name'   =>  $mother_name,
									    'communication_address'   =>  $communication_address ,
									    'communication_address1'  =>  	$communication_address1,
									    'pincode' => $pincode,
									    'email'      => $email,
									    'mobile_number'  => $mobile_number,
									    'franchise_id' => $franchise_id,
									    'status'      =>'Active',
									    'competition_schedule_id' => $schedule->competition_schedule_id
								);
														 
						  //  echo "<pre>";print_r($csv_result_array);die; 
						   
						    $csv_upload_status = $this->franchisemodel->generate_cin_franchise($csv_result_array,$product); 
						    array_push($csvResult_upolad_logArray,$csv_upload_status);
						   // echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
						   //array_push($csvResult_upolad_logArray,$csv_upload_status);
					   }/*End if*/
					   
					  }
				  $i=$i+1;	
				 }while($resultRow_from_csv = fgetcsv($handle,1000));
				 
				 /*while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));*/
				  
					   /*............ End Do while ................*/
					   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
					   /*unset($_FILES);*/
						$this->notifications->notify('CIN Generated Successfully','success');redirect('franchise/franchise/cin_list');	
					 
				  }    /*END OF TYPE CHECKING*/
				  else
					{
							$this->notifications->notify('Not a csv file ','error');
					}/*END OF ELSE TYPE CHECKING*/
					  
		    }/* End if */
		}

        $query = $this->db->query("SELECT * FROM period where status =  'Active';");
	    $data['period'] =$query->result_array();
        
        
        if(isset($data['result']['product'])){
        $query = $this->db->query("SELECT level_id,level_name FROM competition_level_byproduct where product_id = '{$data['result']['product']}';");
	    $data['level'] =$query->result_array();
        }
	    
	    $query = $this->db->query("SELECT product_id,product_name FROM products;");
	    $data['product'] =$query->result_array();
           
	    $this->load->view("cin_genrationfranchiseschedule.php",$data);  
		
	}

    
    public function cin_list()
    {
        $fr_id = $this->session->userdata('franchise_id');
        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$fr_id))->row();
        $sch_id = $this->uri->segment(4);
// 		echo $sch_id;die;
		$this->db->select('
            categoryBYProduct.category_name,
            competition_level_byproduct.level_name,
            period.academic_year,
            competition_schedule.*,
            competition_schedule.competition_schedule_id AS sch_id
        ');
        
        $this->db->from('competition_schedule');
        $this->db->join('period', 'period.period_id = competition_schedule.period_id');
        $this->db->join(
            'categoryBYProduct',
            'categoryBYProduct.category_id = competition_schedule.category_id',
            'left'
        );
        $this->db->join(
            'competition_level_byproduct',
            'competition_level_byproduct.level_id = competition_schedule.competition_level_id'
        );
    
        $this->db->where('competition_schedule.competition_schedule_id', $sch_id);
        $this->db->group_by('competition_schedule.competition_schedule_id');
        
		$query = $this->db->get();
        $data['schedule'] = $schedule = $query->row();
        
        $this->db->select('*');
        $this->db->from('areas');
        // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
        // $this->db->where('area_to_franchise.franchise_id',$fr_id);
        $this->db->where('areas.state_id',$franchise->state_id);
        $query=$this->db->get();
        $data['area']=$query->result_array();
        
        //echo "<pre>";print_r( $data['area']);
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            
            $per = $this->db->get_where('period',array('period_id'=>$this->input->post('period_id')))->row();
            $school = $this->input->post('school');
            $area_code= $this->input->post('area_code');
            $class= $this->input->post('class');
            $period = $this->input->post('period_id');
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->join('areas','areas.area_code=cin_list.franchise_code');
            $this->db->join('school_new','school_new.id=cin_list.school_id','left');
            if($school != '' && $school !='All'){
                $this->db->where('cin_list.school_id',$school);
            }
            if($_POST['product'] != ''){
                $this->db->like('cin_list.cin',$per->initials.$_POST['product']);
            }
            $this->db->where('cin_list.franchise_code',$area_code);
            $this->db->where('cin_list.period_id',$period);
            if($class!=''){
                $this->db->where('cin_list.class',$class);
            }
            $this->db->where('cin_list.competition_schedule_id',$sch_id);
            
            
            // $this->db->order_by("cin_list.id","desc");
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            
            $data['cin_list']=$query->result_array();
            // print_r($data['cin_list']);die;
            $data['result']=$_POST;
        }
        
        
        if (isset($_POST['export'])) {
            $data['result'] = $_POST;
            $per = $this->db->get_where('period',array('period_id'=>$this->input->post('period_id')))->row();
        
            $school = $this->input->post('school');
            $area_code= $this->input->post('area_code');
            $class= $this->input->post('class');
            $period = $this->input->post('period_id');
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->join('areas','areas.area_code=cin_list.franchise_code');
            $this->db->join('school_new','school_new.id=cin_list.school_id');
            if($school != '' && $school !='All'){
                $this->db->where('cin_list.school_id',$school);
            }
            if($_POST['product'] != ''){
                $this->db->like('cin_list.cin',$per->initials.$_POST['product']);
            }
            $this->db->where('cin_list.franchise_code',$area_code);
            $this->db->where('cin_list.period_id',$period);
            // $this->db->where('cin_list.state_id',$franchise->state_id);
            if($class!=''){
                $this->db->where('cin_list.class',$class);
            }
            $this->db->where('cin_list.competition_schedule_id',$sch_id);
            
            // $this->db->order_by("cin_list.id","desc");
            $query=$this->db->get();
            $cin_list = $query->result_array();
        
            $n = 1;
            $student = array();
        
            foreach ($cin_list as $item) {
                $item['serial_no'] = $n;
        
                $cin_part = substr($item['cin'], 2, 2);
                $this->db->select('product_name');
                $this->db->from('products');
                $this->db->where('in13', $cin_part);
                $product_query = $this->db->get();
                $product_name = '';
                
                if ($product_query->num_rows() > 0) {
                    $product_result = $product_query->row();
                    $product_name = $product_result->product_name;
                } else {
                    $per = $this->db->get_where('products',array('in13'=>$this->input->post('product')))->row();
                    $product_name = $per->product_name; 
                }
        
                // Append the product name to the data
                $student[] = array(
                    $item['serial_no'],
                    //$item['period_id'],
                    $item['cin'],
                    $item['student_name'],
                    $item['stud_phone'],
                    $item['stud_email'],
                    $item['class'],
                    $item['father_name'],
                    $item['mother_name'],
                    $item['school_name'],
                    $item['school_address'],
                    $item['area_code'],
                    $item['city_name'],
                    $product_name  
                );
        
                $n++;
            }
        
            // Define the CSV headers (including Product Name)
            $this->csv->export($student, array('Slno', 'Cin', 'Name', 'Mobile', 'Email', 'Class', 'Father Name', 'Mother Name', 'School', 'School Address', 'Area Code', 'City', 'Product Name'), 'studentlist.csv');
            exit;
        }

        
        if(isset($data['result']['school'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('school_new.area_code',$data['result']['area_code']);
            $this->db->where('school_new.state',$franchise->state_id);
            $query=$this->db->get();
            $data['school']=$query->result_array();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        
       $this->load->view("cin_listfranchiseschedule.php",$data); 
    }
    

    public function view_result()
    {
        $fr_id = $this->session->userdata('franchise_id');
        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$fr_id))->row();
        $sch_id = $this->uri->segment(4);
// 		echo $sch_id;die;
		$this->db->select('
            categoryBYProduct.category_name,
            competition_level_byproduct.level_name,
            period.academic_year,
            competition_schedule.*,
            competition_schedule.competition_schedule_id AS sch_id
        ');
        
        $this->db->from('competition_schedule');
        $this->db->join('period', 'period.period_id = competition_schedule.period_id');
        $this->db->join(
            'categoryBYProduct',
            'categoryBYProduct.category_id = competition_schedule.category_id',
            'left'
        );
        $this->db->join(
            'competition_level_byproduct',
            'competition_level_byproduct.level_id = competition_schedule.competition_level_id'
        );
    
        $this->db->where('competition_schedule.competition_schedule_id', $sch_id);
        $this->db->group_by('competition_schedule.competition_schedule_id');
        
		$query = $this->db->get();
        $data['schedule'] = $schedule = $query->row();
        
        $this->db->select('*');
        $this->db->from('areas');
        // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
        // $this->db->where('area_to_franchise.franchise_id',$fr_id);
        $this->db->where('areas.state_id',$franchise->state_id);
        $query=$this->db->get();
        $data['area']=$query->result_array();
        
        //echo "<pre>";print_r( $data['area']);
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            
            $per = $this->db->get_where('period',array('period_id'=>$this->input->post('period_id')))->row();
            $school = $this->input->post('school');
            $area_code= $this->input->post('area_code');
            $class= $this->input->post('class');
            $period = $this->input->post('period_id');
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->join('areas','areas.area_code=cin_list.franchise_code');
            $this->db->join('school_new','school_new.id=cin_list.school_id','left');
            if($school != '' && $school !='All'){
                $this->db->where('cin_list.school_id',$school);
            }
            if($_POST['product'] != ''){
                $this->db->like('cin_list.cin',$per->initials.$_POST['product']);
            }
            $this->db->where('cin_list.franchise_code',$area_code);
            $this->db->where('cin_list.period_id',$period);
            if($class!=''){
                $this->db->where('cin_list.class',$class);
            }
            $this->db->where('cin_list.competition_schedule_id',$sch_id);
            
            
            // $this->db->order_by("cin_list.id","desc");
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            
            $data['cin_list']=$query->result_array();
            // print_r($data['cin_list']);die;
            $data['result']=$_POST;
        }
        
        
        if (isset($_POST['export'])) {
            $data['result'] = $_POST;
            $per = $this->db->get_where('period',array('period_id'=>$this->input->post('period_id')))->row();
        
            $school = $this->input->post('school');
            $area_code= $this->input->post('area_code');
            $class= $this->input->post('class');
            $period = $this->input->post('period_id');
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->join('areas','areas.area_code=cin_list.franchise_code');
            $this->db->join('school_new','school_new.id=cin_list.school_id');
            if($school != '' && $school !='All'){
                $this->db->where('cin_list.school_id',$school);
            }
            if($_POST['product'] != ''){
                $this->db->like('cin_list.cin',$per->initials.$_POST['product']);
            }
            $this->db->where('cin_list.franchise_code',$area_code);
            $this->db->where('cin_list.period_id',$period);
            // $this->db->where('cin_list.state_id',$franchise->state_id);
            if($class!=''){
                $this->db->where('cin_list.class',$class);
            }
            $this->db->where('cin_list.competition_schedule_id',$sch_id);
            
            // $this->db->order_by("cin_list.id","desc");
            $query=$this->db->get();
            $cin_list = $query->result_array();
        
            $n = 1;
            $student = array();
        
            foreach ($cin_list as $item) {
                $item['serial_no'] = $n;
        
                $cin_part = substr($item['cin'], 2, 2);
                $this->db->select('product_name');
                $this->db->from('products');
                $this->db->where('in13', $cin_part);
                $product_query = $this->db->get();
                $product_name = '';
                
                if ($product_query->num_rows() > 0) {
                    $product_result = $product_query->row();
                    $product_name = $product_result->product_name;
                } else {
                    $per = $this->db->get_where('products',array('in13'=>$this->input->post('product')))->row();
                    $product_name = $per->product_name; 
                }
        
                // Append the product name to the data
                $student[] = array(
                    $item['serial_no'],
                    //$item['period_id'],
                    $item['cin'],
                    $item['student_name'],
                    $item['stud_phone'],
                    $item['stud_email'],
                    $item['class'],
                    $item['father_name'],
                    $item['mother_name'],
                    $item['school_name'],
                    $item['school_address'],
                    $item['area_code'],
                    $item['city_name'],
                    $product_name  
                );
        
                $n++;
            }
        
            // Define the CSV headers (including Product Name)
            $this->csv->export($student, array('Slno', 'Cin', 'Name', 'Mobile', 'Email', 'Class', 'Father Name', 'Mother Name', 'School', 'School Address', 'Area Code', 'City', 'Product Name'), 'studentlist.csv');
            exit;
        }

        
        if(isset($data['result']['school'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('school_new.area_code',$data['result']['area_code']);
            $this->db->where('school_new.state',$franchise->state_id);
            $query=$this->db->get();
            $data['school']=$query->result_array();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        
       $this->load->view("cin_listfranchiseschedule.php",$data); 
    }

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */


    public function add() 
    {
        $fr_id = $this->session->userdata('franchise_id');
        
        $data['competition_schedule_id'] = '';
        
        if (isset($_POST['submit'])) 
		{
		    
		    
		    
			$this->notifications->clear();
            $scd          = $this->input->post('competition_date');
            $timestamp    = strtotime($scd);
            $cdate        = date('Y-m-d', $timestamp);
            $franchise_id = $this->session->userdata('franchise_id');
 			$fr_service_id = $this->session->userdata('fr_service_id');  
 			
 			$franchise = $this->db->get_where('franchise', array('franchise_id' => $franchise_id))->row();
            
 			$product = $this->db->get_where('products', array('product_id' => $this->input->post('product')))->row();
            
			$data         = array(
                'period_id' => $this->input->post('period_id'),
                'competition_center_id' => $this->input->post('competition_center_id') ?? null,
                'competition_level_id' => $this->input->post('competition_level_id'),
                'category_id' => $this->input->post('category_id') ?? null,
                'competition_date' => $cdate,
                'reporting_time' => $this->input->post('reporting_time'),
				'competition_fee' => $this->input->post('competition_fee'),
                'franchise_id' => $franchise_id,
				'schedule_confirm_status' => $this->input->post('schedule_confirm_status'),
                'competition_caption' => $this->input->post('competition_caption'),
                'center_address' => $this->input->post('center_address'),
                'product_id' => $this->input->post('product'),
                'competition_caption' => $this->input->post('competition_caption'),
                'product_name' => $product->product_name,
                'country_id' => $franchise->country_id,
                'state_id' => $franchise->state_id,
            );
            
            // print_r($data);die;
			
            $this->validation->set_data($data);
            $this->validation->set_rules('period_id', 'period', 'required');
            // $this->validation->set_rules('competition_center_id', 'competition center', 'required');
            $this->validation->set_rules('competition_level_id', 'level', 'required');
            // $this->validation->set_rules('category_id', 'category', 'required');
            $this->validation->set_rules('competition_date', 'competition date', 'required');
            $this->validation->set_rules('reporting_time', 'reporting time', 'required');
			$this->validation->set_rules('competition_fee', 'Fee', 'required');
			$this->validation->set_rules('schedule_confirm_status', 'confirm status', 'required');
            $this->validation->set_rules('center_address', 'center address', 'required');

            if ($this->validation->run() === FALSE) 
			{
                $this->notifications->notify('Please make all entries', 'error');
            } 
			else 
		
                {
                    $duplicate = $this->db
                        ->where('period_id', $data['period_id'])
                        ->where('competition_level_id', $data['competition_level_id'])
                        ->where('category_id', $data['category_id'])
                        ->where('competition_date', $data['competition_date'])
                        ->where('product_id', $data['product_id'])
                        ->where('franchise_id', $franchise_id)
                        ->get('competition_schedule')
                        ->num_rows();

                    // 1️⃣ Check duplicate FIRST
                    if ($duplicate > 0)
                    {
                        $this->notifications->clear();
                        $this->notifications->notify('This Competition Schedule already exists', 'error');
                        redirect('franchise/competitionshedule/add', 'refresh');
                        return;
                    }
                
                    // 2️⃣ Insert only if not duplicate
                    $insert = $this->db->insert('competition_schedule', $data);
                
                    if ($insert)
                    {
                        $this->notifications->clear();
                        $this->notifications->notify('Competition Schedule Added Successfully', 'success');
                        redirect('franchise/competitionshedule/add', 'refresh');
                    }
                    else
                    {
                        $this->notifications->clear();
                        $this->notifications->notify('Failed to add Schedule Details', 'error');
                    }
                }

            $data['result'] = $_POST;
        }
        
            // $query = $this->db->query("SELECT * FROM period where status = 'Active';");
            $query = $this->db->query("SELECT * FROM period");
		    $data['period'] =$query->result_array();
            
            
            if(isset($data['result']['product'])){
            $query = $this->db->query("SELECT level_id,level_name FROM competition_level_byproduct where product_id = '{$data['result']['product']}' and level_name like 'SCH%';");
		    $data['level'] =$query->result_array();
            }
		    
		    $query = $this->db->query("SELECT product_id,product_name FROM products;");
		    $data['product'] =$query->result_array();
         
         
		$this->load->view("competitionsheduleadd.php", $data);
    }



    public function edit()
    {
        $id = $this->uri->segment('5');
        
        if(empty($id)){
            redirect('franchise/competitionshedule/search');
        }
    
        $franchise_id = $this->session->userdata('franchise_id');
    
        // Fetch existing record
        $result = $this->db
            ->where('competition_schedule_id', $id)
            ->get('competition_schedule')
            ->row_array();
    
        if(!$result){
            redirect('franchise/competitionshedule');
        }
    
        $data['result'] = $result;
    
        /* ---------- UPDATE SUBMIT ---------- */
    
        if(isset($_POST['submit']))
        {
            
            
            
            $this->notifications->clear();
    
            $scd = $this->input->post('competition_date');
            $timestamp = strtotime($scd);
            $cdate = date('Y-m-d', $timestamp);
    
            $franchise = $this->db
                ->get_where('franchise', ['franchise_id'=>$franchise_id])
                ->row();
    
            
            $product = $this->db
                ->get_where('products', ['product_id'=>$this->input->post('product')])
                ->row();
    
            
            
            $updateData = [
                'period_id' => $this->input->post('period_id'),
                'competition_center_id' => $this->input->post('competition_center_id') ?? null,
                'competition_level_id' => $this->input->post('competition_level_id'),
                'category_id' => $this->input->post('category_id') ?? null,
                'competition_date' => $cdate,
                'reporting_time' => $this->input->post('reporting_time'),
                'competition_fee' => $this->input->post('competition_fee'),
                'schedule_confirm_status' => $this->input->post('schedule_confirm_status'),
                'competition_caption' => $this->input->post('competition_caption'),
                'center_address' => $this->input->post('center_address'),
                'product_id' => $this->input->post('product'),
                'product_name' => $product->product_name,
                'country_id' => $franchise->country_id,
                'state_id' => $franchise->state_id
            ];
    
            /* ---------- Validation ---------- */
    
            $this->validation->set_data($updateData);
            $this->validation->set_rules('period_id', 'Period', 'required');
            $this->validation->set_rules('competition_level_id', 'Level', 'required');
            $this->validation->set_rules('competition_date', 'Competition Date', 'required');
            $this->validation->set_rules('reporting_time', 'Reporting Time', 'required');
            $this->validation->set_rules('competition_fee', 'Fee', 'required');
            $this->validation->set_rules('schedule_confirm_status', 'Confirm Status', 'required');
            $this->validation->set_rules('center_address', 'Center Address', 'required');
    
            if ($this->validation->run() === FALSE)
            {
                $this->notifications->notify('Please make all entries', 'error');
            }
            else
            {
                /* ---------- Duplicate Check (Ignore Same ID) ---------- */
    
                $duplicate = $this->db
                    ->where('period_id', $updateData['period_id'])
                    ->where('competition_level_id', $updateData['competition_level_id'])
                    ->where('category_id', $updateData['category_id'])
                    ->where('competition_date', $updateData['competition_date'])
                    ->where('product_id', $updateData['product_id'])
                    ->where('franchise_id', $franchise_id)
                    ->where('competition_schedule_id !=', $id)
                    ->get('competition_schedule')
                    ->num_rows();
    
    
            
            
                if($duplicate > 0)
                {
                    $this->notifications->notify('Duplicate Schedule Exists', 'error');
                }
                else
                {
                    
                    $this->db->where('competition_schedule_id', $id);
                    $update = $this->db->update('competition_schedule', $updateData);
    
                    if($update)
                    {
                        $this->notifications->notify('Schedule Updated Successfully', 'success');
                        redirect('franchise/competitionshedule/edit/'.$id);
                    }
                    else
                    {
                        $this->notifications->notify('Update Failed', 'error');
                    }
                }
            }
    
            $data['result'] = $_POST;
        }
    
        /* ---------- Dropdown Data ---------- */
    
        $data['period'] = $this->db
            ->where('status','Active')
            ->get('period')
            ->result_array();
    
        $data['product'] = $this->db->get('products')->result_array();
    
        if(isset($data['result']['product']))
        {
            $data['level'] = $this->db
                ->query("SELECT level_id,level_name 
                         FROM competition_level_byproduct 
                         WHERE product_id='".$data['result']['product']."' 
                         AND level_name LIKE 'SCH%'")
                ->result_array();
        }
    
        $this->load->view("competitionsheduleadd.php",$data);
    }



/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

	
    public function edit__()
	{
        $uri                   = $this->uri->uri_to_assoc(4);
        $competition_schedule_id = $uri['id'];
        if (isset($_POST['submit'])) {
            $scd          = $this->input->post('competition_date');
            $timestamp    = strtotime($scd);
            $cdate        = date('Y-m-d', $timestamp);
            $franchise_id = $this->session->userdata('franchise_id');
            $data         = array(
                'period_id' => $this->input->post('period_id'),
                'competition_center_id' => $this->input->post('competition_center_id'),
                'competition_level_id' => $this->input->post('competition_level_id'),
                'category_id' => $this->input->post('category_id'),
                'competition_date' => $cdate,
                'reporting_time' => $this->input->post('reporting_time'),
                'franchise_id' => $franchise_id,
				'schedule_confirm_status' =>$this->input->post('schedule_confirm_status')
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('period_id', 'period', 'required');
            $this->validation->set_rules('competition_center_id', 'competition center', 'required');
            $this->validation->set_rules('competition_level_id', 'level', 'required');
            $this->validation->set_rules('category_id', 'category', 'required');
            $this->validation->set_rules('competition_date', 'competition date', 'required');
            $this->validation->set_rules('reporting_time', 'reporting time', 'required');
			$this->validation->set_rules('schedule_confirm_status', 'confirm status', 'required');

            if ($this->validation->run() === FALSE) 
			{
                $this->notifications->clear();	
				$this->notifications->notify('Please make all entries', 'error');
            } else 
			{
				$this->notifications->clear();		
                $str=$this->competitionshedulemodel->insert($data, $franchise_id, $competition_schedule_id);
				if($str)
				{
				  $this->notifications->notify('Competition Schedule Updated Successfuly', 'success');
 			      redirect('franchise/competitionshedule/', 'refresh');
				}
				else
				{
					 $this->notifications->notify('Failed to Update Competition Schedule', 'error');

				}
            }
            $data['result'] = $_POST;
        }
		
        $data['mode']     = 'Edit';
		$params=array( "fr_id" => $this->session->userdata('franchise_id') , "service_id" => $this->session->userdata('fr_service_id'));
		$data['schedule_confirm_status'] = $this->franchisemodel->enum_select('sb_competition_schedule', 'schedule_confirm_status');
        
		$data['category'] = $this->categorymodel->listCategory($params);
        $data['level']    = $this->competitionlevelmodel->listcompetitionlevel($params);
        $data['center']   = $this->competitioncentermodel->listcompetition_center($params);
	    $data['result']   = $this->competitionshedulemodel->getcompetitionshedule($competition_schedule_id);
        $data['period']   = $this->periodmodel->listperiod();
        $this->load->view("competitionsheduleadd.php", $data);
    }

	
    public function delete() 
    {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) 
		{
            $competition_schedule_id = $uri['id'];
            $this->notifications->notify('competition schedule Deleted successfully', 'success');
            $this->competitionshedulemodel->changeStatus($competition_schedule_id);
            redirect('franchise/competitionshedule/index/', 'refresh');
        }
    }
	
	
	public function search_material()
    {
        if(isset($_POST['search'])){
            // print_r($_POST);die;
            
            $query = $this->db->query("SELECT product_name,product_id FROM products where product_name=  '{$_POST['product']}';");
		    $product =$query->row_array()['product_id'];
            
            
            // $product=$_POST['product'];
            
            
            $period=$_POST['period_id'];
            $clevel=$_POST['level'];
            $class=$_POST['class'];
            $type=$_POST['type'];
            $product_name=$_POST['product'];
            
            // echo $product.'  '.$period.'  '.$clevel.'  '.$class.'  '.$type.'   '.$product_name;die;
            
            $data['list_materials'] = $this->franchisemodel->list_search_material($product,$period,$clevel,$class,$type,$subject,$varient,$series,$product_name);
            
        //   print_r($data['list_materials']);die;  
           
            $data['result']=$_POST;
           
        }
       
        if(isset($_POST['Delete'])){
           $arr=$_POST['ids'];
        //   print_R($_POST);die;
            foreach($arr as $row){
                $this->db->where('id',$row);
                $this->db->delete('study_material');    
            }
        }
        
        if(isset($data['result']['product'])){ 
                $this->db->select('*');  
                $this->db->from('competition_level_byproduct');
                
                $this->db->where('product_name',$data['result']['product']);
                
                $query = $this->db->get();   
                $data['load_level']=$query->result_array();
            }
    
    
        $this->db->select('*');  
        $this->db->from('products');
        $this->db->where('status','Active');  
        $query = $this->db->get();   
        $data['load_product']=$query->result_array();

        $this->db->select('*');  
        $this->db->from('period');
        $this->db->where('period_id >','11');  
        $query = $this->db->get();   
        $data['loadperiod']=$query->result_array();


        $this->load->view("study_material_search.php",$data);
    }

	public function delete2() 
	{
        $uri                   = $this->uri->segment(4);
        $competion_schedule_id = $uri;
        // echo $competion_schedule_id;die;
		$this->db->where('competition_schedule_id',$competion_schedule_id);
		$this->db->delete('competition_schedule');
		redirect('franchise/competitionshedule/schedule_list');
	}
   public function schedule_list()
    {
      
      $franchise_id = $this->session->userdata('franchise_id');
      $statfr =$this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
     
        if(isset($_POST['submit'])){
            //print_R($_SESSION);die;
        
            $data=array(
                'period_id'=>$this->input->post('period_id'),
                'product_name'=>$this->input->post('product_name'),
                'country'=>$this->input->post('country'),
                'state_id'=>$statfr->state_id,
                'franchise_id'=>$franchise_id,
                'competition_level_id'=>$this->input->post('competition_level_id')
                );
                
            $data['list'] = $this->competitionshedulemodel->search_schedule2($data);  
              $data['result']=$_POST;
        }else{
            
            // $query = $this->db
            //     ->select('period.*, competition_schedule.*, competition_level_byproduct.level_name, franchise.franchise_code')
            //     ->from('competition_schedule')
            //     ->join('period', 'period.period_id = competition_schedule.period_id')
            //     ->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_schedule.competition_level_id')
            //     ->join('franchise', 'competition_schedule.franchise_id = franchise.franchise_id')
            //     ->where('competition_schedule.period_id', 16)
            //     ->where('competition_schedule.franchise_id', $this->session->userdata('franchise_id'))
            //     ->group_by('competition_schedule_id')
            //     ->order_by('competition_schedule_id', 'DESC')
            //     ->get();
             $query = $this->db
            ->select('period.*, competition_schedule.*, school_new.school_name, competition_level_byproduct.level_name, franchise.franchise_code')
            ->from('competition_schedule')
            ->join('period', 'period.period_id = competition_schedule.period_id')
            ->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_schedule.competition_level_id AND competition_level_byproduct.product_id = competition_schedule.product_id')
            ->join('franchise', 'competition_schedule.franchise_id = franchise.franchise_id')
            ->join('school_new', 'school_new.id = competition_schedule.school_id', 'left')
            ->where('competition_schedule.period_id', 16)
            ->where('competition_schedule.franchise_id', $this->session->userdata('franchise_id'))
            ->group_by('competition_schedule.competition_schedule_id')
            ->order_by('competition_schedule.competition_schedule_id', 'DESC')
            ->get();
            $data['list'] = $query->result_array();
        }
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['franchise']  = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row_array();
       // print_R( $data['result']);die;
            
     $this->load->view("schedule_list.php", $data);    
    }
    
   public function offline_cin_genration()
{
    $this->load->model('franchisemodel');
     $competition_schedule_id = $this->uri->segment(4);

    $competition = $this->db->get_where('competition_schedule', ['competition_schedule_id' => $competition_schedule_id])->row();
  
    if (!$competition) {
        $this->notifications->notify('Invalid competition schedule', 'error');
        redirect('franchise/competitionshedule/schedule_list'); // adjust if cin_list lives elsewhere
        return;
    }

    $product      = $competition->product_name;
    $franchise_id = $this->session->userdata('franchise_id');
    $period       = $competition->period_id;

    $product_to_school = $this->db->select('*')
        ->from('product_to_school')
        ->join('competition_schedule', 'competition_schedule.product_id = product_to_school.product_id')
        ->where([
            'competition_schedule.competition_schedule_id'  => $competition_schedule_id,

        ])
        ->get()->row();
        
    $area_code = $this->db->get_where('school_new',array('id'=>$product_to_school->school_id))->row()->area_code ?? null;
    $school_id = $product_to_school->school_id ?? null; // ASSUMPTION: school = product_to_school.school_id
    $state_id=  $product_to_school->state_id ?? null; 
    //echo $area_code;die;
    $data = [
        'comschid'  => $competition_schedule_id,
        'school_id' => $school_id,
    ];

  
    if ($this->input->post('submit')) {

        
        if (empty($_FILES['csv']['name'])) {
            $this->notifications->notify('Please choose a CSV file', 'error');
            redirect('franchise/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        if ($_FILES['csv']['size'] <= 0) {
            $this->notifications->notify('Uploaded file is empty', 'error');
            redirect('franchise/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'csv') {
            $this->notifications->notify('Not a csv file', 'error');
            redirect('franchise/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        $handle = fopen($_FILES['csv']['tmp_name'], 'r');
        if ($handle === false) {
            $this->notifications->notify('Unable to read uploaded file', 'error');
            redirect('franchise/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        $classes = [
            1 => 'Nursery', 2 => 'LKG', 3 => 'UKG', 4 => 'Class-1', 5 => 'Class-2',
            6 => 'Class-3', 7 => 'Class-4', 8 => 'class-5', 9 => 'Class-6', 10 => 'Class-7',
            11 => 'Class-8', 12 => 'Class-9', 13 => 'Class-10', 14 => 'Class-11', 15 => 'Class-12',
        ];

        $rowNum = 0;
        $successCount = 0;
        $failCount = 0;
        $csvResult_upolad_logArray = [];

       
        while (($row = fgetcsv($handle, 1000)) !== false) {
            $rowNum++;
            if ($rowNum <= 2) continue; // skip 2 header rows
            if (empty($row[0])) continue;

            $class_id      = addslashes(trim($row[0]));
            $stud_name     = addslashes(trim($row[1] ?? ''));
            $gender        = addslashes(trim($row[2] ?? ''));
            $father_name   = addslashes(trim($row[3] ?? ''));
            $mother_name   = addslashes(trim($row[4] ?? ''));
            $address_1     = addslashes(trim($row[5] ?? ''));
            $address_2     = addslashes(trim($row[6] ?? ''));
            $pincode       = addslashes(trim($row[7] ?? ''));
            $email         = addslashes(trim($row[8] ?? ''));
            $mobile_number = addslashes(trim($row[9] ?? ''));

            $class = $classes[$class_id] ?? '';

            $csv_result_array = [
                'period_id'               => $period,
                'school_id'               => $school_id,
                'class_id'                => $class_id,
                'class'                   => $class,
                'category_id'             => $class_id,
                'stud_name'               => $stud_name,
                'gender'                  => $gender,
                'father_name'             => $father_name,
                'mother_name'             => $mother_name,
                'communication_address'   => $address_1,
                'communication_address1'  => $address_2,
                'pincode'                 => $pincode,
                'email'                   => $email,
                'state_id'                => $state_id,
                'mobile_number'           => $mobile_number,
                'area_code'               => $area_code,
                'franchise_id'            => $franchise_id,
                'competition_schedule_id' => $competition_schedule_id,
            ];
          
            $result = $this->franchisemodel->offline_generate_cin($csv_result_array, $product); 
           
            if ($result) {
                $successCount++;
            } else {
                $failCount++;
            }
           //  print_r($result);die;
 
            $csvResult_upolad_logArray[] = [
                'row'       => $rowNum,
                'cin'       => $result[0],
                'stud_name' => $stud_name,
                'result'    => $result,
            ];
        }
        fclose($handle);

        $this->session->set_flashdata('csvResult_upoload_logArray', $csvResult_upolad_logArray);

        if ($successCount > 0) {
            $this->notifications->notify("CIN generated for $successCount record(s)" . ($failCount ? ", $failCount failed" : ''), 'success');
        } else {
            $this->notifications->notify('No CIN records were generated. Please check your CSV file.', 'error');
        }

        redirect('franchise/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
        return;
    }
   

    $data['csvResult_upoload_logArray'] = $this->session->flashdata('csvResult_upoload_logArray');

    $this->load->view("offline_cin_genration.php", $data);
}  


public function ajax_process_cin_batch()
{
    // This endpoint handles ONE SMALL BATCH of rows at a time (e.g. 5 rows),
    // so each individual request stays light — avoids the server/LVE killing
    // a single huge request that tries to process all 23+ rows at once.
 
    if (!isset($this->db)) {
        $this->load->database();
    }
    $this->load->model('franchisemodel');
 
    header('Content-Type: application/json');
 
    $competition_schedule_id = $this->input->post('competition_schedule_id');
    $rows_json                = $this->input->post('rows'); // JSON string of row arrays
 
    if (empty($competition_schedule_id) || empty($rows_json)) {
        echo json_encode(['success' => false, 'message' => 'Missing competition_schedule_id or rows']);
        return;
    }
 
    $rows = json_decode($rows_json, true);
    if (!is_array($rows)) {
        echo json_encode(['success' => false, 'message' => 'Invalid rows payload']);
        return;
    }
 
    $competition = $this->db->get_where('competition_schedule', ['competition_schedule_id' => $competition_schedule_id])->row();
    if (!$competition) {
        echo json_encode(['success' => false, 'message' => 'Invalid competition schedule']);
        return;
    }
 
    $product      = $competition->product_name;
    $franchise_id = $this->session->userdata('franchise_id');
    $period       = $competition->period_id;
 
    $product_to_school = $this->db->select('*')
        ->from('product_to_school')
        ->join('competition_schedule', 'competition_schedule.product_id = product_to_school.product_id')
        ->where(['competition_schedule.competition_schedule_id' => $competition_schedule_id])
        ->get()->row();
 
    if (!$product_to_school) {
        echo json_encode(['success' => false, 'message' => 'No school mapping found for this competition schedule']);
        return;
    }
 
    $school_id = $product_to_school->school_id ?? null;
    $state_id  = $product_to_school->state_id ?? null;
 
    $area_code = null;
    if ($school_id) {
        $school_row = $this->db->get_where('school_new', ['id' => $school_id])->row();
        $area_code  = $school_row->area_code ?? null;
    }
 
    $classes = [
        1 => 'Nursery', 2 => 'LKG', 3 => 'UKG', 4 => 'Class-1', 5 => 'Class-2',
        6 => 'Class-3', 7 => 'Class-4', 8 => 'class-5', 9 => 'Class-6', 10 => 'Class-7',
        11 => 'Class-8', 12 => 'Class-9', 13 => 'Class-10', 14 => 'Class-11', 15 => 'Class-12',
    ];
 
    $results = [];
 
    foreach ($rows as $row) {
        // $row is an array of column values already split client-side, same
        // order as the original CSV columns.
        if (empty($row[0])) continue;
 
        $class_id      = addslashes(trim($row[0]));
        $stud_name     = addslashes(trim($row[1] ?? ''));
        $gender        = addslashes(trim($row[2] ?? ''));
        $father_name   = addslashes(trim($row[3] ?? ''));
        $mother_name   = addslashes(trim($row[4] ?? ''));
        $address_1     = addslashes(trim($row[5] ?? ''));
        $address_2     = addslashes(trim($row[6] ?? ''));
        $pincode       = addslashes(trim($row[7] ?? ''));
        $email         = addslashes(trim($row[8] ?? ''));
        $mobile_number = addslashes(trim($row[9] ?? ''));
 
        $class = $classes[$class_id] ?? '';
 
        $csv_result_array = [
            'period_id'               => $period,
            'school_id'               => $school_id,
            'class_id'                => $class_id,
            'class'                   => $class,
            'category_id'             => $class_id,
            'stud_name'               => $stud_name,
            'gender'                  => $gender,
            'father_name'             => $father_name,
            'mother_name'             => $mother_name,
            'communication_address'   => $address_1,
            'communication_address1'  => $address_2,
            'pincode'                 => $pincode,
            'email'                   => $email,
            'state_id'                => $state_id,
            'mobile_number'           => $mobile_number,
            'area_code'               => $area_code,
            'franchise_id'            => $franchise_id,
            'competition_schedule_id' => $competition_schedule_id,
        ];
 
        $result = $this->franchisemodel->offline_generate_cin($csv_result_array, $product);
 
        $results[] = [
            'cin'       => $result[0] ?? null,
            'stud_name' => $stud_name,
            'status'    => $result[6] ?? 'Unknown',
        ];
 
        unset($result, $csv_result_array);
    }
 
    echo json_encode([
        'success'    => true,
        'results'    => $results,
        'csrf_hash'  => $this->security->get_csrf_hash(), // send updated token for the next batch
    ]);
}

}


