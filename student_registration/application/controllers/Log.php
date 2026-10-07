<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
    public function __construct() {
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
    
    
// 	public function payments(){
	     
// 	   if(isset($_POST['submit'])){
    
//   $startDate = $_POST['start_date'];
// $endDate   = $_POST['end_date'];

// $this->db->select('*');

// if($_POST['type']=='competition'){
//     $this->db->from('payment_split');
//     $this->db->join(
//         'competition_product_state',
//         'competition_product_state.id = payment_split.comp_id',
//         'left'
//     );
//     $this->db->where('payment_split.status','1');
//     $this->db->group_by('payment_split.payment_id');

//     $this->db->where('payment_split.date_of_payment >=', $startDate);
//     $this->db->where('payment_split.date_of_payment <=', $endDate);
//     $this->db->order_by('payment_split.pay_id', 'DESC');
// }

// elseif($_POST['type']=='school'){
//     $this->db->from('payment_split_prid');
//     $this->db->group_by('payment_split_prid.payment_id');

//     $this->db->where('payment_split_prid.date_of_payment >=', $startDate);
//     $this->db->where('payment_split_prid.date_of_payment <=', $endDate);
//     $this->db->order_by('payment_split_prid.pay_id', 'DESC');
// }

// $query = $this->db->get();

// $data['payments'] = $query->result_array();
// $data['message'] = 'Showing payments from ' . $startDate . ' to ' . $endDate;
// $data['result'] = $_POST;

// } else {

//     $this->db->select('*');
//     $this->db->from('payment_split');
//     $this->db->join(
//         'competition_product_state',
//         'competition_product_state.id = payment_split.comp_id',
//         'left'
//     );

//     $this->db->order_by('pay_id', 'DESC');
//     $this->db->where('payment_split.status','1');

//     $this->db->group_by('payment_split.payment_id');
//     $this->db->limit(100);

//     $query = $this->db->get();

//     $data['payments'] = $query->result_array();
//     $data['message'] = 'Showing Last 100 Payments';
// }
	    
// 	   //  echo count($data['payments']);
	     
	     
// 	        if (isset($_POST['export_csv']) && $_POST['export_csv'] == '1') {
// 	            if(empty($_POST['start_date'])){
	                
// 	                $this->db->select('*');
//                     $this->db->from('payment_split');
//                     $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
                
//                     $this->db->order_by('pay_id', 'DESC');
//                     $this->db->where('payment_split.status','1');
//                     $this->db->group_by('payment_split.payment_id');
//                     $this->db->limit(100);
//                     $query = $this->db->get();
                
//                     $data['payments'] = $query->result_array();
//                     $data['message'] = 'Showing Last 100 Payments';
                
// 	            }else{     
//     	            $startDate = $_POST['start_date'];
//                     $endDate = $_POST['end_date'];
            
//                     $this->db->select('*');
//                     if($_POST['type']=='competition'){
                        
//                         $this->db->from('payment_split');
//                         $this->db->where('payment_split.status','1');
//                     }
//                     if($_POST['type']=='school'){
//                         $this->db->from('payment_split_prid');
                        
//                     }
//                     $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
                
//                     $this->db->where('date_of_payment >=', $startDate);
//                     $this->db->where('date_of_payment <=', $endDate);
//                     $this->db->order_by('pay_id', 'DESC');
//                     $this->db->group_by('payment_split.payment_id');
//                     $query = $this->db->get();
//                     $data['payments'] = $query->result_array();
// 	            }
	            
//                 $filename = "payments_" . date('YmdHis') . ".csv";
//                 header("Content-Description: File Transfer");
//                 header("Content-Disposition: attachment; filename=$filename");
//                 header("Content-Type: application/csv; ");
            
//                 // File pointer
//                 $file = fopen('php://output', 'w');
            
//                 // CSV header
//                 $header = array("Sr. No", "Date", "CIN/PRID", "Total Pay Amount", "Franchise Amount", "Franchise GST", "MaRRS GST", "CRM Fix Amount", "Razorpay Cut", "Management Cut", "MaRRS Left", "Aviansys Amount", "Aviansys GST","Maker Cut");
//                 fputcsv($file, $header);
            
//                 // Write data
//                 $i = 1;
//                 foreach ($data['payments'] as $value) {
                    
//                                 $price=0;
//                                             if(!empty($value['revenue_setting_id'])){
//                                                 $price=0;
//                                                 $res = $this->db->get_where('makers_splits',array('comp_id'=>$value['comp_id'],'revenue_setting_id'=>$value['revenue_setting_id'],'order_id'=>$value['payment_id'],'transaction_id !='=>null))->result();
//                                                 foreach($res as $row){
                                                    
//                                                     $price=$price+$row->price;
//                                                     $mes='';
//                                                 }
                                                
                                                
//                                             }else{
//                                                 $mes= 'No split for Maker';
//                                             }  
                                   
                                   
//                         $res = $this->db->get_where('payment_split',array('comp_id'=>$value['comp_id'],'cin'=>$value['cin'],'payment_id'=>$value['payment_id']))->row();
                                                                         
                    
//                     $row = array(
//                         $i,
//                         $res->date_of_payment,
//                         !empty($res->cin) ? $res->cin : $value['prid'],
//                         $res->total_amount,
//                         $res->franchise_amount,
//                         $res->franchise_gst,
//                         $res->gst_amount,
//                         $res->crm_fix,
//                         $res->razpay_service,
//                         $res->management_amount,
//                         $res->MaRRS_bal,
//                         $res->aviansys_amount,
//                         // $value['aviansys_gst'],
//                         $res->aviansys_gst,
//                         $price.$mes
//                     );
//                     fputcsv($file, $row);
//                     $i++;
//                 }
            
//                 fclose($file);
//                 exit;
//             }

	    
	    
	    
	    
// 	    $this->load->view('payments.php',$data);
	     
// 	}


    public function payments()
    {
    
        if(isset($_POST['submit'])){
    
            // ✅ DATE FIX (IMPORTANT)
            $startDate = $_POST['start_date'];
            $endDate   = !empty($_POST['end_date']) 
                ? date('Y-m-d', strtotime($_POST['end_date'].' +1 day')) 
                : '';
    
            $this->db->select('*');
    
            if($_POST['type']=='competition'){
                $this->db->from('payment_split');
                $this->db->join(
                    'competition_product_state',
                    'competition_product_state.id = payment_split.comp_id',
                    'left'
                );
                $this->db->where('payment_split.status','1');
                $this->db->group_by('payment_split.payment_id');
    
                // ✅ DATE CONDITION FIX
                if(!empty($startDate)){
                    $this->db->where('payment_split.date_of_payment >=', $startDate);
                }
                if(!empty($endDate)){
                    $this->db->where('payment_split.date_of_payment <', $endDate);
                }
    
                $this->db->order_by('payment_split.pay_id', 'DESC');
            }
    
            elseif($_POST['type']=='school'){
                $this->db->from('payment_split_prid');
                $this->db->group_by('payment_split_prid.payment_id');
    
                // ✅ DATE CONDITION FIX
                if(!empty($startDate)){
                    $this->db->where('payment_split_prid.date_of_payment >=', $startDate);
                }
                if(!empty($endDate)){
                    $this->db->where('payment_split_prid.date_of_payment <', $endDate);
                }
    
                $this->db->order_by('payment_split_prid.pay_id', 'DESC');
            }
    
            $query = $this->db->get();
    
            $data['payments'] = $query->result_array();
            $data['message'] = 'Showing payments from ' . $_POST['start_date'] . ' to ' . $_POST['end_date'];
            $data['result'] = $_POST;
    
        } else {
    
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->join(
                'competition_product_state',
                'competition_product_state.id = payment_split.comp_id',
                'left'
            );
    
            $this->db->order_by('pay_id', 'DESC');
            $this->db->where('payment_split.status','1');
            $this->db->group_by('payment_split.payment_id');
            $this->db->limit(100);
    
            $query = $this->db->get();
    
            $data['payments'] = $query->result_array();
            $data['message'] = 'Showing Last 100 Payments';
        }
    
    
        // ================= CSV EXPORT =================
        if (isset($_POST['export_csv']) && $_POST['export_csv'] == '1') {
    
            if(empty($_POST['start_date'])){
    
                $this->db->select('*');
                $this->db->from('payment_split');
                $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
    
                $this->db->order_by('pay_id', 'DESC');
                $this->db->where('payment_split.status','1');
                $this->db->group_by('payment_split.payment_id');
                $this->db->limit(100);
    
                $query = $this->db->get();
                $data['payments'] = $query->result_array();
    
            } else {
    
                // ✅ DATE FIX AGAIN FOR CSV
                $startDate = $_POST['start_date'];
                $endDate   = date('Y-m-d', strtotime($_POST['end_date'].' +1 day'));
    
                $this->db->select('*');
    
                if($_POST['type']=='competition'){
                    $this->db->from('payment_split');
                    $this->db->where('payment_split.status','1');
                }
    
                if($_POST['type']=='school'){
                    $this->db->from('payment_split_prid');
                }
    
                $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
    
                // ✅ DATE CONDITION FIX
                $this->db->where('date_of_payment >=', $startDate);
                $this->db->where('date_of_payment <', $endDate);
    
                $this->db->order_by('pay_id', 'DESC');
                $this->db->group_by('payment_split.payment_id');
    
                $query = $this->db->get();
                $data['payments'] = $query->result_array();
            }
    
            // ================= DOWNLOAD CSV =================
            $filename = "payments_" . date('YmdHis') . ".csv";
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");
    
            $file = fopen('php://output', 'w');
    
            $header = array(
                "Sr. No", "Date", "CIN/PRID", "Total Pay Amount",
                "Franchise Amount", "Franchise GST", "MaRRS GST",
                "CRM Fix Amount",  "IT Amount", "Razorpay Cut", "Management Cut",
                "MaRRS Left", "Aviansys Amount", "Aviansys GST","Maker Cut"
            );
            fputcsv($file, $header);
    
            $i = 1;
    
            foreach ($data['payments'] as $value) {
    
                // Maker calculation
                $price = 0;
                $mes = '';
    
                if(!empty($value['revenue_setting_id'])){
                    $resMaker = $this->db->get_where('makers_splits',[
                        'comp_id'=>$value['comp_id'],
                        'revenue_setting_id'=>$value['revenue_setting_id'],
                        'order_id'=>$value['payment_id'],
                        'transaction_id !='=>null
                    ])->result();
    
                    foreach($resMaker as $row){
                        $price += $row->price;
                    }
                } else {
                    $mes = 'No split for Maker';
                }
    
                // Main row fetch
                $res = $this->db->get_where('payment_split',[
                    'comp_id'=>$value['comp_id'],
                    'cin'=>$value['cin'],
                    'payment_id'=>$value['payment_id']
                ])->row();
    
                $row = array(
                    $i,
                    $res->date_of_payment ?? '',
                    !empty($res->cin) ? $res->cin : ($value['prid'] ?? ''),
                    $res->total_amount ?? 0,
                    $res->franchise_amount ?? 0,
                    $res->franchise_gst ?? 0,
                    $res->gst_amount ?? 0,
                    $res->crm_fix ?? 0,
                    $res->it_fix ?? 0,
                    $res->razpay_service ?? 0,
                    $res->management_amount ?? 0,
                    $res->MaRRS_bal ?? 0,
                    $res->aviansys_amount ?? 0,
                    $res->aviansys_gst ?? 0,
                    $price . ' ' . $mes
                );
    
                fputcsv($file, $row);
                $i++;
            }
    
            fclose($file);
            exit;
        }
    
        $this->load->view('payments.php',$data);
    }


// public function payments(){

//     if(isset($_POST['submit'])){

//         // ✅ DATE FIX (IMPORTANT)
//         $startDate = $_POST['start_date'];
//         $endDate   = !empty($_POST['end_date']) 
//             ? date('Y-m-d', strtotime($_POST['end_date'].' +1 day')) 
//             : '';

//         $this->db->select('*');

//         if($_POST['type']=='competition'){
//             $this->db->from('payment_split');
//             $this->db->join(
//                 'competition_product_state',
//                 'competition_product_state.id = payment_split.comp_id',
//                 'left'
//             );
//             $this->db->where('payment_split.status','1');
//             $this->db->group_by('payment_split.payment_id');

//             if(!empty($startDate)){
//                 $this->db->where('payment_split.date_of_payment >=', $startDate);
//             }
//             if(!empty($endDate)){
//                 $this->db->where('payment_split.date_of_payment <', $endDate);
//             }

//             $this->db->order_by('payment_split.pay_id', 'DESC');

//             $data['payments'] = $this->db->get()->result_array();
//             foreach ($data['payments'] as &$row) { $row['type'] = 'competition'; }
//             unset($row);
//         }

//         elseif($_POST['type']=='school'){
//             $this->db->from('payment_split_prid');
//             $this->db->group_by('payment_split_prid.payment_id');

//             if(!empty($startDate)){
//                 $this->db->where('payment_split_prid.date_of_payment >=', $startDate);
//             }
//             if(!empty($endDate)){
//                 $this->db->where('payment_split_prid.date_of_payment <', $endDate);
//             }

//             $this->db->order_by('payment_split_prid.pay_id', 'DESC');

//             $data['payments'] = $this->db->get()->result_array();
//             foreach ($data['payments'] as &$row) { $row['type'] = 'school'; }
//             unset($row);
//         }

//         else { // 'all' — merge both, respecting the same date filters

//             // Competition payments
//             $this->db->select('*');
//             $this->db->from('payment_split');
//             $this->db->join(
//                 'competition_product_state',
//                 'competition_product_state.id = payment_split.comp_id',
//                 'left'
//             );
//             $this->db->where('payment_split.status','1');
//             if(!empty($startDate)){
//                 $this->db->where('payment_split.date_of_payment >=', $startDate);
//             }
//             if(!empty($endDate)){
//                 $this->db->where('payment_split.date_of_payment <', $endDate);
//             }
//             $this->db->group_by('payment_split.payment_id');
//             $this->db->order_by('payment_split.pay_id', 'DESC');
//             $competitionPayments = $this->db->get()->result_array();

//             // School payments
//             $this->db->select('*');
//             $this->db->from('payment_split_prid');
//             if(!empty($startDate)){
//                 $this->db->where('payment_split_prid.date_of_payment >=', $startDate);
//             }
//             if(!empty($endDate)){
//                 $this->db->where('payment_split_prid.date_of_payment <', $endDate);
//             }
//             $this->db->group_by('payment_split_prid.payment_id');
//             $this->db->order_by('payment_split_prid.pay_id', 'DESC');
//             $schoolPayments = $this->db->get()->result_array();

//             foreach ($competitionPayments as &$row) { $row['type'] = 'competition'; }
//             foreach ($schoolPayments as &$row) { $row['type'] = 'school'; }
//             unset($row);

//             $data['payments'] = array_merge($competitionPayments, $schoolPayments);
//             usort($data['payments'], function ($a, $b) {
//                 return strtotime($b['date_of_payment']) <=> strtotime($a['date_of_payment']);
//             });
//         }

//         $data['message'] = 'Showing payments from ' . $_POST['start_date'] . ' to ' . $_POST['end_date'];
//         $data['result'] = $_POST;

//     } else {

//         // Competition payments
//         $this->db->select('*');
//         $this->db->from('payment_split');
//         $this->db->join(
//             'competition_product_state',
//             'competition_product_state.id = payment_split.comp_id',
//             'left'
//         );
//         $this->db->where('payment_split.status', '1');
//         $this->db->group_by('payment_split.payment_id');
//         $this->db->order_by('payment_split.pay_id', 'DESC');
//         $this->db->limit(100);
//         $competitionPayments = $this->db->get()->result_array();

//         // School payments
//         $this->db->select('*');
//         $this->db->from('payment_split_prid');
//         $this->db->group_by('payment_split_prid.payment_id');
//         $this->db->order_by('payment_split_prid.pay_id', 'DESC');
//         $this->db->limit(100);
//         $schoolPayments = $this->db->get()->result_array();

//         foreach ($competitionPayments as &$row) { $row['type'] = 'competition'; }
//         foreach ($schoolPayments as &$row) { $row['type'] = 'school'; }
//         unset($row);

//         $data['payments'] = array_merge($competitionPayments, $schoolPayments);
//         usort($data['payments'], function ($a, $b) {
//             return strtotime($b['date_of_payment']) <=> strtotime($a['date_of_payment']);
//         });

//         // Keep only the most recent 100 across both types
//         $data['payments'] = array_slice($data['payments'], 0, 100);

//         $data['message'] = 'Showing Last 100 Payments (All Types)';
//     }


//     // ================= CSV EXPORT =================
//     if (isset($_POST['export_csv']) && $_POST['export_csv'] == '1') {

//         if(empty($_POST['start_date'])){

//             // Competition payments
//             $this->db->select('*');
//             $this->db->from('payment_split');
//             $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
//             $this->db->where('payment_split.status','1');
//             $this->db->group_by('payment_split.payment_id');
//             $this->db->order_by('payment_split.pay_id', 'DESC');
//             $this->db->limit(100);
//             $competitionPayments = $this->db->get()->result_array();

//             // School payments
//             $this->db->select('*');
//             $this->db->from('payment_split_prid');
//             $this->db->group_by('payment_split_prid.payment_id');
//             $this->db->order_by('payment_split_prid.pay_id', 'DESC');
//             $this->db->limit(100);
//             $schoolPayments = $this->db->get()->result_array();

//             foreach ($competitionPayments as &$row) { $row['type'] = 'competition'; }
//             foreach ($schoolPayments as &$row) { $row['type'] = 'school'; }
//             unset($row);

//             $data['payments'] = array_merge($competitionPayments, $schoolPayments);
//             usort($data['payments'], function ($a, $b) {
//                 return strtotime($b['date_of_payment']) <=> strtotime($a['date_of_payment']);
//             });
//             $data['payments'] = array_slice($data['payments'], 0, 100);

//         } else {

//             // ✅ DATE FIX AGAIN FOR CSV
//             $startDate = $_POST['start_date'];
//             $endDate   = date('Y-m-d', strtotime($_POST['end_date'].' +1 day'));

//             if($_POST['type']=='competition'){

//                 $this->db->select('*');
//                 $this->db->from('payment_split');
//                 $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
//                 $this->db->where('payment_split.status','1');
//                 $this->db->where('payment_split.date_of_payment >=', $startDate);
//                 $this->db->where('payment_split.date_of_payment <', $endDate);
//                 $this->db->group_by('payment_split.payment_id');
//                 $this->db->order_by('payment_split.pay_id', 'DESC');
//                 $data['payments'] = $this->db->get()->result_array();
//                 foreach ($data['payments'] as &$row) { $row['type'] = 'competition'; }
//                 unset($row);

//             } elseif($_POST['type']=='school'){

//                 $this->db->select('*');
//                 $this->db->from('payment_split_prid');
//                 $this->db->where('date_of_payment >=', $startDate);
//                 $this->db->where('date_of_payment <', $endDate);
//                 $this->db->group_by('payment_split_prid.payment_id');
//                 $this->db->order_by('payment_split_prid.pay_id', 'DESC');
//                 $data['payments'] = $this->db->get()->result_array();
//                 foreach ($data['payments'] as &$row) { $row['type'] = 'school'; }
//                 unset($row);

//             } else { // 'all'

//                 $this->db->select('*');
//                 $this->db->from('payment_split');
//                 $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
//                 $this->db->where('payment_split.status','1');
//                 $this->db->where('payment_split.date_of_payment >=', $startDate);
//                 $this->db->where('payment_split.date_of_payment <', $endDate);
//                 $this->db->group_by('payment_split.payment_id');
//                 $this->db->order_by('payment_split.pay_id', 'DESC');
//                 $competitionPayments = $this->db->get()->result_array();

//                 $this->db->select('*');
//                 $this->db->from('payment_split_prid');
//                 $this->db->where('date_of_payment >=', $startDate);
//                 $this->db->where('date_of_payment <', $endDate);
//                 $this->db->group_by('payment_split_prid.payment_id');
//                 $this->db->order_by('payment_split_prid.pay_id', 'DESC');
//                 $schoolPayments = $this->db->get()->result_array();

//                 foreach ($competitionPayments as &$row) { $row['type'] = 'competition'; }
//                 foreach ($schoolPayments as &$row) { $row['type'] = 'school'; }
//                 unset($row);

//                 $data['payments'] = array_merge($competitionPayments, $schoolPayments);
//                 usort($data['payments'], function ($a, $b) {
//                     return strtotime($b['date_of_payment']) <=> strtotime($a['date_of_payment']);
//                 });
//             }
//         }

//         // ================= DOWNLOAD CSV =================
//         $filename = "payments_" . date('YmdHis') . ".csv";
//         header("Content-Description: File Transfer");
//         header("Content-Disposition: attachment; filename=$filename");
//         header("Content-Type: application/csv; ");

//         $file = fopen('php://output', 'w');

//         $header = array(
//             "Sr. No", "Date", "CIN/PRID", "Total Pay Amount",
//             "Franchise Amount", "Franchise GST", "MaRRS GST",
//             "CRM Fix Amount", "Razorpay Cut", "Management Cut",
//             "MaRRS Left", "Aviansys Amount", "Aviansys GST","Maker Cut"
//         );
//         fputcsv($file, $header);

//         $i = 1;

//         foreach ($data['payments'] as $value) {

//             // Maker calculation
//             $price = 0;
//             $mes = '';

//             if(!empty($value['revenue_setting_id'])){
//                 $resMaker = $this->db->get_where('makers_splits',[
//                     'comp_id'=>$value['comp_id'],
//                     'revenue_setting_id'=>$value['revenue_setting_id'],
//                     'order_id'=>$value['payment_id'],
//                     'transaction_id !='=>null
//                 ])->result();

//                 foreach($resMaker as $row){
//                     $price += $row->price;
//                 }
//             } else {
//                 $mes = 'No split for Maker';
//             }

//             // Main row fetch — use per-row type instead of $_POST['type']
//             $rowType = $value['type'] ?? 'competition';

//             if ($rowType == 'school') {
//                 $res = (object)$value; // school payments, no join needed
//             } else {
//                 $res = $this->db->get_where('payment_split',[
//                     'comp_id'=>$value['comp_id'],
//                     'cin'=>$value['cin'],
//                     'payment_id'=>$value['payment_id']
//                 ])->row();
//             }

//             $row = array(
//                 $i,
//                 $res->date_of_payment ?? '',
//                 !empty($res->cin) ? $res->cin : ($value['prid'] ?? ''),
//                 $res->total_amount ?? 0,
//                 $res->franchise_amount ?? 0,
//                 $res->franchise_gst ?? 0,
//                 $res->gst_amount ?? 0,
//                 $res->crm_fix ?? 0,
//                 $res->razpay_service ?? 0,
//                 $res->management_amount ?? 0,
//                 $res->MaRRS_bal ?? 0,
//                 $res->aviansys_amount ?? 0,
//                 $res->aviansys_gst ?? 0,
//                 $price . ' ' . $mes
//             );

//             fputcsv($file, $row);
//             $i++;
//         }

//         fclose($file);
//         exit;
//     }

//     $this->load->view('payments.php',$data);
// }



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

    $startDate = $_POST['start_date'];
    $endDate   = $_POST['end_date'];
    $type      = $_POST['type'];

    $this->db->select('*');

    // ✅ TABLE SELECTION
    if($type == 'competition'){
        $this->db->from('payment_split');
        $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');
        $this->db->where('payment_split.status','1');
        $this->db->group_by('payment_split.payment_id');
    } 
    else if($type == 'school'){
        $this->db->from('payment_split_prid');
        $this->db->group_by('payment_split_prid.payment_id'); // ✅ FIXED
    }

    // ✅ DATE FILTER (IMPORTANT FIX)
    if(!empty($startDate) && !empty($endDate)){
        $this->db->where("DATE(date_of_payment) >=", $startDate);
        $this->db->where("DATE(date_of_payment) <=", $endDate);
    }

    $this->db->order_by('pay_id', 'DESC');

    $query = $this->db->get();

    $data['payments'] = $query->result_array();
    $data['message'] = 'Showing payments from ' . $startDate . ' to ' . $endDate;
    $data['result'] = $_POST;
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

