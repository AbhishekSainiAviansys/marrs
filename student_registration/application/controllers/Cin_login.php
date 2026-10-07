<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Cin_login extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        //$this->cartempty();
        // $this->session->set_userdata('cin',$this->uri->segment(3));
    //   echo $this->uri->segment(3);die;
    
    
        if (!$this->session->userdata('cin')) {
            redirect('/welcome/commonLogin', 'refresh');
        } 
		
		//$this->load->library('encrypt');
		$this->load->library('session');
       // $this->load->library('cart');
// 		$this->load->library("csv");
// 		$this->load->helper('form');
// 		$this->load->library('form_validation');
       
    }


//     public function index() 
// 	{	
// 	   // echo $this->uri->segment(3);
//         $this->load->model('newmodel');
// 	    $cin=$this->session->userdata('cin');

// 	   //echo $cin;die;
	   
// 	        $this->db->select('clevel,product_name,period_id');
//             $this->db->from('cin_result');
//             $this->db->where('cin',$cin);
//             if (strpos($cin, 'LU') === false) {
            
//                 $this->db->where('status !=', null);
//             }
            
            
//             // $this->db->or_where('status !=', '');
//             $this->db->order_by("clevel", "desc");
//             $this->db->order_by("id", "desc");
//             $query = $this->db->get();
            
            
//             // echo $this->db->last_query();
            
//             $ress= $query->row_array();
// 	        $data['clevel']=$level=$ress['clevel'];
	        
	        
// 	       // if($ress['period_id']){
// 	            $data['period']=$period=$ress['period_id'];
// 	       // }else{
// 	       //     $this->db->select('period_id');
//         //         $this->db->from('cin_list');
//         //         $this->db->where('cin',$cin);
//         //         $query = $this->db->get();
            
// 	       //     $data['period']=$period=$ress['period_id'];
// 	       // }
// 	        $data['product']=$product=$ress['product_name'];
// 	    //echo $level;
	   
// 	        $this->db->select('medal_no');
//             $this->db->from('competition_level_byproduct');
//             $this->db->where('level_id',$level);
// 	        $this->db->where('product_name',$product);
// 	        $query = $this->db->get();
//             $resss= $query->row_array();
            
// 	        $medal=$resss['medal_no'];
// 	        //echo $medal;
// 	        $medal=$medal+1;
	   
// 	   //echo $medal;
// 	        $this->db->select('level_id');
//             $this->db->from('competition_level_byproduct');
//             $this->db->where('medal_no',$medal);
// 	        $this->db->where('product_name',$product);
// 	        $query = $this->db->get();
//             $ressss= $query->row_array();
            
//             //echo $this->db->last_query();exit;
// 	        $data['nlev']=$nlev=$ressss['level_id'];
	         
	        
	   
// 	    $data['student']=$this->newmodel->get_student_data($cin);
	   
// 	   // print_r($data['student']);
// 	    //$status='';
// 	    if(isset($_POST['register'])){
// 	        redirect('cin_login/net', 'refresh');
// 	    }
// 	    if(isset($_POST['submit'])){
// 	        //print_r($_POST);die;
// 	        if(array_key_exists("mother_name",$_POST)){
// 	            //print_r($_POST);die;
// 	            $status=$this->newmodel->update_student_data($cin,$_POST);
// 	        }
	        
// 	    }
	    
// 	    if($status=='yes'){
// 	       $this->session->set_flashdata('error',"Details update successful ...");
// 	    }else{
// 	       $this->session->set_flashdata('error',"OOPS, Details not updated ...");
//     	}
	    
// 	    // ========== edited by abhishek 28/9/23 ========== //
// 	        $this->db->select('status');
//             $this->db->from('cin_result');
//             $this->db->where('cin',$cin);
//                 if($student['period_id']!='12'){
//                     $this->db->where('status !=', '');
//                     $this->db->order_by("id", "desc");
//                 }
//                 if($student['period_id']=='12'){
//                     $this->db->where('venue !=', '');
//                 }
                
//             $this->db->order_by("clevel", "desc");
//             $query = $this->db->get();
//             //echo $this->db->last_query();
//             $res= $query->row_array();
//             //print_r($res);
            
// 	    $stat=$res['status'];
// 	    if($stat==''){
// 	        $data['status']='Yes';
// 	    }else{
// 	        $data['status']='No';
// 	    }
	    
// 	    // ===== end ======= //
	    
	        
// 	    $this->load->view('cin_login/profile.php',$data);
//     }


    public function index()
    {
        $this->load->model('newmodel');
        $cin = $this->session->userdata('cin');
    
        $data = [];
        $status = '';
    
        // ================= GET LATEST RESULT =================
        $this->db->select('clevel, product_name, period_id');
        $this->db->from('cin_result');
        $this->db->where('cin', $cin);
    
        if (strpos($cin, 'LU') === false) {
            $this->db->where('status IS NOT NULL', null, false);
        }
    
        $this->db->order_by("clevel", "desc");
        $this->db->order_by("id", "desc");
    
        $ress = $this->db->get()->row_array();
    
        $level   = $ress['clevel'] ?? '';
        $period  = $ress['period_id'] ?? '';
        $product = $ress['product_name'] ?? '';
    
        $data['clevel']  = $level;
        $data['period']  = $period;
        $data['product'] = $product;
    
        // ================= MEDAL LOGIC =================
        $this->db->select('medal_no');
        $this->db->from('competition_level_byproduct');
        $this->db->where('level_id', $level);
        $this->db->where('product_name', $product);
    
        $res = $this->db->get()->row_array();
    
        $medal = ($res['medal_no'] ?? 0) + 1;
    
        $this->db->select('level_id');
        $this->db->from('competition_level_byproduct');
        $this->db->where('medal_no', $medal);
        $this->db->where('product_name', $product);
    
        $res2 = $this->db->get()->row_array();
    
        $data['nlev'] = $res2['level_id'] ?? '';
    
        // ================= STUDENT =================
        $student = $this->newmodel->get_student_data($cin);
        $data['student'] = $student;
    
        // ================= FORM ACTIONS =================
        if ($this->input->post('register')) {
            redirect('cin_login/net', 'refresh');
        }
    
        if ($this->input->post('submit')) {
            if ($this->input->post('mother_name')) {
                $status = $this->newmodel->update_student_data($cin, $_POST);
            }
        }
    
        if ($status == 'yes') {
            $this->session->set_flashdata('error', "Details update successful ...");
        } elseif ($this->input->post('submit')) {
            $this->session->set_flashdata('error', "OOPS, Details not updated ...");
        }
    
        // ================= STATUS =================
        $this->db->select('status');
        $this->db->from('cin_result');
        $this->db->where('cin', $cin);
    
        if (!empty($student['period_id']) && $student['period_id'] != '12') {
            $this->db->where('status <>', '');
            $this->db->order_by("id", "desc");
        }
    
        if (!empty($student['period_id']) && $student['period_id'] == '12') {
            $this->db->where('venue <>', '');
        }
    
        $this->db->order_by("clevel", "desc");
    
        $res = $this->db->get()->row_array();
    
        $stat = $res['status'] ?? '';
        $data['status'] = ($stat == '') ? 'Yes' : 'No';
    
        // ================= SEARCH =================
        $data['rank_list'] = [];
        $data['message'] = '';
    
        // if ($this->input->post('searchBtn')) {
    
        //     $product = $this->input->post('product_name');
        //     $level   = $this->input->post('level_id');
        //     $period  = $this->input->post('period_id');
    
        //     if (empty($product) || empty($level) || empty($period)) {
        //         $data['message'] = "Please select all filters";
        //     } else {
    
        //         // FIXED QUERY ORDER + STUDENT ARRAY FIX
        //         $this->db->select('*');
        //         $this->db->from('rank_list');
        //         $this->db->where('period_id', $period);
        //         $this->db->where('product_name', $product);
        //         $this->db->where('level_name', $level);
    
        //         if (!empty($student['class'])) {
        //             $this->db->where('class', $student['class']);
        //         }
    
        //         $query = $this->db->get();
        //         $data['rank_list'] = $query->result_array();
    
        //         // SECOND FILTER (optional)
        //         $this->load->model('franchisemodel');
    
        //         $students = $this->franchisemodel->export_result_all(
        //             $period, $level, $product, '', '', '', '', '', '', '', '', '', ''
        //         );
    
        //         $filtered = [];
    
        //         if (!empty($students)) {
        //             foreach ($students as $item) {
        //                 if ($item['cin'] == $cin) {
        //                     $filtered[] = [
        //                         'student_name' => $item['student_name'],
        //                         'category'     => $item['performer'] ?? '-',
        //                         'rank'         => $item['rank'] ?? '-'
        //                     ];
        //                 }
        //             }
        //         }
    
        //         $data['rank_list'] = $filtered;
    
        //         $data['message'] = empty($filtered)
        //             ? "No results found"
        //             : count($filtered) . " record(s) found";
        //     }
        // }
    //     if ($this->input->post('searchBtn')) {
    
    //     $product = $this->input->post('product_name');
    //     $level   = $this->input->post('level_id');
    //     $period  = $this->input->post('period_id');
    
    //     if (empty($product) || empty($level) || empty($period)) {
    //         $data['message'] = "Please select all filters";
    //     } else {
    
    //         // ===== MAIN QUERY WITH JOIN =====
    //         $this->db->select('cin_result.*, cin_list.class');
    //         $this->db->from('cin_result');
    
    //         // 🔥 JOIN WITH cin_list USING CIN
    //         $this->db->join('cin_list', 'cin_list.cin = cin_result.cin', 'left');
    
    //         $this->db->where('cin_result.period_id', $period);
    //         $this->db->where('cin_result.product_name', $product);
    //         $this->db->where('cin_result.clevel', $level);
    
    //         // 🔥 FILTER BY CURRENT USER CIN
    //         $this->db->where('cin_result.cin', $cin);
    
    //         $query = $this->db->get();
    //         $dbData = $query->result_array();
    
    //         // 🔍 DEBUG (use once)
    //         // echo $this->db->last_query(); exit;
    
    //         // ===== SECOND FILTER (OPTIONAL) =====
    //         $this->load->model('franchisemodel');
    
    //         $students = $this->franchisemodel->export_result_all(
    //             $period, $level, $product, '', '', '', '', '', '', '', '', '', ''
    //         );
    
    //         $filtered = [];
    
    //         if (!empty($students)) {
    //             foreach ($students as $item) {
    
    //                 if ($item['cin'] == $cin) {
    //                     $filtered[] = [
    //                         'student_name' => $item['student_name'],
    //                         'category'     => $item['performer'] ?? '-',
    //                         'rank'         => $item['rank'] ?? '-'
    //                     ];
    //                 }
    //             }
    //         }
    
    //         // ===== FINAL OUTPUT =====
    //         if (!empty($filtered)) {
    //             $data['rank_list'] = $filtered;
    //         } else {
    //             // $data['rank_list'] = $dbData;
    //             $final = [];
    
    //             if (!empty($dbData)) {
    //                 foreach ($dbData as $row) {
    //                     $final[] = [
    //                         'student_name' => $student['student_name'] ?? 'N/A',
    //                         'class'        => $row['class'] ?? '-',
    //                         'performer'    => $row['performer'] ?? '-',
    //                         'speller'      => $row['speller'] ?? '-',
    //                         'status'       => $row['status'] ?? '-'
    //                     ];
    //                 }
    //             }
                
    //             $data['rank_list'] = $final;
    //         }
    
    //         $data['message'] = empty($data['rank_list'])
    //             ? "No results found"
    //             : count($data['rank_list']) . " record(s) found";
    //     }
    // }
    // ================= SEARCH =================
    if ($this->input->post('searchBtn')) {
    
        $product = $this->input->post('product_name');
        $level   = $this->input->post('level_id');
        $period  = $this->input->post('period_id');
        $class   = $this->input->post('class'); // ✅ NEW
    
        if (empty($product) || empty($level) || empty($period)) {
            $data['message'] = "Please select all filters";
        } else {
    
            $this->db->select('
        cr.cin,
        cr.performer,
        cr.speller,
        cr.status,
        cr.rank,
        cr.clevel,
        cl.class,
        cl.student_name,
        lp.level_name
    ');
    
    $this->db->from('cin_result cr');
    $this->db->join('cin_list cl', 'cl.cin = cr.cin', 'left');
    $this->db->join('competition_level_byproduct lp', 'lp.level_id = cr.clevel', 'left'); // ✅ ADD THIS
    
            $this->db->where('cr.period_id', $period);
            $this->db->where('cr.product_name', $product); // ✅ FIXED (no like)
            $this->db->where('cr.clevel', $level);
    
            // ✅ CLASS FILTER
            if (!empty($class)) {
                $this->db->where('cl.class', $class);
            }
    
            // ⚠️ If rank is stored as STRING like "1,2,3"
            // $this->db->group_start();
            //     $this->db->like('cr.rank', 'Budding star');
            //     $this->db->or_like('cr.rank', '1');
            //     $this->db->or_like('cr.rank', '2');
            //     $this->db->or_like('cr.rank', '3');
            //     $this->db->or_like('cr.rank', '4');
            //     $this->db->or_like('cr.rank', '5');
            // $this->db->group_end();
    
            $this->db->order_by('cr.rank', 'ASC');
    
            $query = $this->db->get();
            $result = $query->result_array();
    
            $final = [];
    
            if (!empty($result)) {
                foreach ($result as $row) {
                    $final[] = [
                        'student_name' => $row['student_name'] ?? 'N/A',
                        'class'        => $row['class'] ?? '-',
                        'rank'         => $row['rank'] ?? '-',
                        'performer'    => $row['performer'] ?? '-',
                        'speller'      => $row['speller'] ?? '-',
                        'status'       => $row['status'] ?? '-',
                        'level_name'   => $row['level_name'] ?? '-',
                    ];
                }
            }
    
            $data['rank_list'] = $final;
    
            $data['message'] = empty($final)
                ? "No results found"
                : count($final) . " record(s) found";
            }
        }
        // ================= DROPDOWN DATA =================
        
        // PRODUCTS
        $this->db->distinct();
        $this->db->select('product_name');
        $this->db->from('cin_result');
        $this->db->where('status !=', '');
        $data['products'] = $this->db->get()->result_array();
        
        
        // LEVELS
        $this->db->distinct();
        $this->db->select('level_id, level_name');
        $this->db->from('competition_level_byproduct');
        
        if (!empty($product)) {
            $this->db->where('product_name', $product);
        }
        
        $this->db->group_by('level_id');
        
        $this->db->order_by('level_id', 'ASC');
        
        $data['levels'] = $this->db->get()->result_array();
        
        // PERIODS
        $this->db->distinct();
        $this->db->select('period_id');
        $this->db->from('cin_result');
        $this->db->where('status !=', '');
        $data['periods'] = $this->db->get()->result_array();
        
        
        // ✅ CLASS FILTER (Nursery to Class-8 only)
        $this->db->distinct();
        $this->db->select('class');
        $this->db->from('cin_list');
        
        // Allowed classes
        $allowed_classes = [
            'Nursery', 'LKG', 'UKG',
            'Class-1', 'Class-2', 'Class-3', 'Class-4',
            'Class-5', 'Class-6', 'Class-7', 'Class-8'
        ];
        
        // Apply filter
        $this->db->where_in('class', $allowed_classes);
        
        // Optional: sort properly
        $this->db->order_by("
            FIELD(class, 
                'Nursery','LKG','UKG',
                'Class-1','Class-2','Class-3','Class-4',
                'Class-5','Class-6','Class-7','Class-8'
            )
        ", null, false);
        
        $data['classes'] = $this->db->get()->result_array();
        // echo "<pre>";
        // print_r($data['rank_list']);
        // exit;
    
        // ================= LOAD VIEW =================
        $this->load->view('cin_login/profile.php', $data);
    }


    public function get_periods() {
        $this->load->model('newmodel');
        $product_name = trim($this->input->post('product_name'));
        $level_id     = trim($this->input->post('level_id'));
    
        
    
        $periods = $this->newmodel->get_periods_by_product_level($product_name, $level_id);
    
        echo json_encode([
            'success' => true,
            'periods' => $periods
        ]);
    }	
	
	// ── GET LEVELS BY PRODUCT ──
    public function get_levels() 
    {
        $this->load->model('newmodel');
        $product_name = trim($this->input->post('product_name'));
    
        if (empty($product_name)) {
            echo json_encode(['success' => false, 'message' => 'Product name required']);
            return;
        }
    
        $levels = $this->newmodel->get_levels_by_product($product_name);
    
        echo json_encode([
            'success' => true,
            'levels'  => $levels
        ]);
    }
        
    // ── GET RANK HOLDERS ──
    public function get_rank_holders() 
    {
        // Get data from POST (sent by AJAX)
        $product_name = $this->input->post('product_name');
        $level_id     = $this->input->post('level_id');
        $period       = $this->input->post('period');
    
        
    
        $this->db->select('*');
        $this->db->from('cin_result');
        $this->db->join('cin_list', 'cin_list.cin = cin_result.cin');
       
        $this->db->join('category', 'category.category_id = cin_list.category_id');
        $this->db->where('cin_result.product_name', $product_name);
        $this->db->where('cin_result.clevel', $level_id);
        $this->db->where('cin_result.period_id', $period);
        $this->db->where_in('cin_result.rank', ['Rank-1', 'Rank-2', 'Rank-3']);
        $this->db->group_by('cin_result.cin', 'ASC');
    
        $query = $this->db->get();
       // echo $this->db->last_query();die;
        $ranks = $query->result_array();
    
        if (!empty($ranks)) {
            echo json_encode([
                'success' => true,
                'message' => count($ranks) . ' rank holder(s) found.',
                'ranks'   => $ranks
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No rank holders found for the selected filters.',
                'ranks'   => []
            ]);
        }
    }

	public function onlinetest()
	{
	   $userproduct = $this->db->get_where('cin_result',array('cin'=>$_SESSION['cin']))->row();
	   $data['product_name']=$userproduct->product_name;
	  $this->load->view('onlinetest.php',$data);   
	}
	
	 public function profileView()
    {
         $cin = $this->uri->segment(4);
         $user = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
         $this->session->set_userdata('cin', $cin);
        // Check session
         print_r($cin);die;
    
         redirect('cin_login/index');
    }
    
	 public function attemschedule()
    {
        
    
        $this->load->view("attemschedule.php");
    }
    
    
    public function unscd_description()
    {
        $usercin     = $this->db->get_where('cin_list', array('cin' => $_SESSION['cin']))->row();
        $userproduct = $this->db->get_where('cin_result', array('cin' => $_SESSION['cin']))->row();
    
        $exam_id = $this->input->post('exam_id'); // ✅ get exam_id from POST
        $cin     = $_SESSION['cin'];
    
        $payload = [
            "cin"          => $cin,
            "student_name" => $usercin->student_name,
            "email"        => $usercin->stud_email,
            "class"        => $usercin->class,
            "mobile"       => $usercin->stud_phone,
            "product_name" => $userproduct->product_name,
            "exam_id"      => $exam_id  // ✅ this was missing!
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://grademarker.online/api/GettingTheExamMISB',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json']
        ]);
    
        $response   = curl_exec($curl);
        curl_close($curl);
    
        $responseArr = json_decode($response, true);
    
        echo json_encode($responseArr);
    }
        
    
    public function generate_login_url()
    {
        
       
        $series = $this->input->post('series');
        $status = $this->input->post('status');
        $exam_id = $this->input->post('exam_id');
        $product = $this->input->post('product_name');
    
        // 🔐 Safe session check
        if (!isset($_SESSION['cin'])) {
            show_error("Session expired or CIN missing", 500);
            return;
        }
    
        $res = $this->db->get_where('cin_list', array('cin' => $_SESSION['cin']))->row();
    
        if (!$res) {
            show_error("User not found in CIN list", 500);
            return;
        }
    
        // ---------------- PROFILE API ----------------
        $data_profile = [
            "profile" => [
                "student_name" => $res->student_name,
                "email"        => $res->stud_email,
                "phone_no"     => $res->stud_phone,
                "cin"          => $res->cin,
                "school"       => 'null',
                "class"        => $res->class
            ],
            "registration" => [
                "product_name"   => $product,
                "com_level"      => "school_level",
                "period_id"      => "24/25",
                "test_status"    => "Registered",
                "test_startDate" => "2026-01-07",
                "test_endDate"   => "2026-01-07",
                "status"         => "Active"
            ]
        ];
    
        $payload = json_encode($data_profile);
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://grademarker.online/api/profile_update',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
        ]);
    
        $response = curl_exec($curl);
    
        if (curl_errno($curl)) {
            log_message('error', curl_error($curl));
        }
    
        curl_close($curl);
    
        // ---------------- LOGIN TOKEN DATA ----------------
    
        $email = $res->stud_email;
    
        $login_data = json_encode([
            "email"  => $email,
            "cin"    => $res->cin,
            "week"   => 'W1',
            "month"  => 'M1',
            "series" => $series,
            "class"  => $res->class,
            "level"  => '',
            "time"   => time(),
            "status" => $status,
            "exam_id"=> $exam_id ?? '',
            "product_name" =>$product
        ]);
    
        $token = $this->encrypt_string($login_data);
    
        $url = "https://grademarker.online/auth/auto_login?token=" . $token;
    
        redirect($url);
    }
    
    function encrypt_string($string)
    {
    
        $key = 'YourSecretKey123!@#';   // SAME on both servers
    
        $cipher = "AES-128-CTR";
    
        $iv = '1234567891011121';       // 16 bytes
     
         $encrypted = openssl_encrypt($string, $cipher, $key, 0, $iv);
     
        return urlencode(base64_encode($encrypted));
    
    }
    
	public function testt() 
	{	
	   // echo $this->uri->segment(3);
        $this->load->model('newmodel');
	    $cin=$this->session->userdata('cin');

	   //echo $cin;die;
	   
	        $this->db->select('clevel,product_name,period_id');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            if (strpos($cin, 'LU') === false) {
            
                $this->db->where('status !=', null);
            }
            
            
            // $this->db->or_where('status !=', '');
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            
            
            // echo $this->db->last_query();
            
            $ress= $query->row_array();
	        $data['clevel']=$level=$ress['clevel'];
	        
	        
	       // if($ress['period_id']){
	            $data['period']=$period=$ress['period_id'];
	       // }else{
	       //     $this->db->select('period_id');
        //         $this->db->from('cin_list');
        //         $this->db->where('cin',$cin);
        //         $query = $this->db->get();
            
	       //     $data['period']=$period=$ress['period_id'];
	       // }
	        $data['product']=$product=$ress['product_name'];
	    //echo $level;
	   
	        $this->db->select('medal_no');
            $this->db->from('competition_level_byproduct');
            $this->db->where('level_id',$level);
	        $this->db->where('product_name',$product);
	        $query = $this->db->get();
            $resss= $query->row_array();
            
	        $medal=$resss['medal_no'];
	        //echo $medal;
	        $medal=$medal+1;
	   
	   //echo $medal;
	        $this->db->select('level_id');
            $this->db->from('competition_level_byproduct');
            $this->db->where('medal_no',$medal);
	        $this->db->where('product_name',$product);
	        $query = $this->db->get();
            $ressss= $query->row_array();
            
            //echo $this->db->last_query();exit;
	        $data['nlev']=$nlev=$ressss['level_id'];
	         
	        
	   
	    $data['student']=$this->newmodel->get_student_data($cin);
	   
	   // print_r($data['student']);
	    //$status='';
	    if(isset($_POST['register'])){
	        redirect('cin_login/net', 'refresh');
	    }
	    if(isset($_POST['submit'])){
	        //print_r($_POST);die;
	        if(array_key_exists("mother_name",$_POST)){
	            //print_r($_POST);die;
	            $status=$this->newmodel->update_student_data($cin,$_POST);
	        }
	        
	    }
	    
	    if($status=='yes'){
	       $this->session->set_flashdata('error',"Details update successful ...");
	    }else{
	       $this->session->set_flashdata('error',"OOPS, Details not updated ...");
    	}
	    
	    // ========== edited by abhishek 28/9/23 ========== //
	        $this->db->select('status');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
                if($student['period_id']!='12'){
                    $this->db->where('status !=', '');
                    $this->db->order_by("id", "desc");
                }
                if($student['period_id']=='12'){
                    $this->db->where('venue !=', '');
                }
                
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $res= $query->row_array();
            //print_r($res);
            
	    $stat=$res['status'];
	    if($stat==''){
	        $data['status']='Yes';
	    }else{
	        $data['status']='No';
	    }
	    
	    // ===== end ======= //
	    
	        
	    $this->load->view('cin_login/profile1.php',$data);
    }
	
	
	public function profile_cin() 
	{	
	    echo $this->uri->segment(3);die;
	}
	
	
	public function profile_edit()
	{
	   // echo 'ok';die;
	   $status='';
	   $cin=$this->session->userdata('cin');
	   if(isset($_POST['submit'])){
	       //print_r($_POST);die;
	       $status=$this->newmodel->update_student_data($cin,$_POST);
	       //print_r($status);die;
	   }
	   if($status=='yes'){
	       $this->session->set_flashdata('error',"Details update successful ...");
	       redirect('Cin_login');
	   }else{
	       $this->session->set_flashdata('error',"OOPS, Details not updated ...");
	   }
	     
	     $data['student']=$this->newmodel->get_student_data($cin);
	     $this->load->view('cin_login/profile_edit.php',$data);
	}
	
// ================= Added by abhishek 28/9/2023 ============= //
    public function special_certificate()
    {
            $this->load->model('newmodel');
            $id = $this->uri->segment(3);
            $cin=$this->session->userdata('cin');
            //echo $id;die;
            $is=explode('_',$id);
            //print_R($is);die;
            $level=$is[1];
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('status !=', null);
            $this->db->where('clevel',$level);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $result=$data['result']= $query->row_array();
            
            
            if($is[0]=='P'){
                $data['stat']='BEST PERFORMER';
            }else{
                $data['stat']='STAR SPELLER';
            }
            $this->db->select('medal_no,level_name');
            $this->db->from('competition_level_byproduct');
            $this->db->where('level_id',$level);
            $this->db->where('product_name', $data['result']['product_name']);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $res=$query->row_array();
            $data['level_name']=$res['level_name'];
            
            if($result['level_id']!=$level){
            
            
                        $this->db->select('level_name');
                        $this->db->from('competition_level_byproduct');
                        $this->db->where('product_name',$data['result']['product_name']);
                        $this->db->where('level_id !=', $level);
                        $this->db->where('level_id >=', '1');
                        $this->db->order_by("level_id", "ASC");
                        $query = $this->db->get();
                        //echo $this->db->last_query();exit;
                        $result= $query->row_array();
 	                    //echo $result['level_name'];die;
 	                   
                        $data['nex_level']= $result['level_name'];
                        
            }   else{
                 $data['nex_level']='';
            }
            
            if($result['period_id']=='12'){
                $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$cin);
            // $this->db->where('status !=', null);
            // $this->db->where('clevel',$id);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['student']= $query->row_array();
            }else{
              $data['student']=$this->newmodel->get_student_data_cin($cin);
               
            }
            
            // if(isset($_POST['back'])){
            //     redirect('cin_login/result_view', 'refresh');
            // }
            if(isset($_POST['profile'])){
                redirect('cin_login/index', 'refresh');
            }
            
            
            
            
            
            $this->load->view('current_year/special_certificate', $data);
	 }
	 
	 
	public function result_view22()
	{
      	    $this->load->model('newmodel');
            $cin=$this->session->userdata('cin');
            $data['cin']=$cin;
              
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->where('cin',$cin);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
            $data['student'] =  $student= $query->row_array();
	   // print_r($student);die;  
            
            
                $this->db->select('*');
                $this->db->from('cin_result');
                $this->db->where('cin',$cin);
                $this->db->group_by('cin_result.clevel');
                $this->db->order_by('id','DESC');
                $query = $this->db->get();
               // echo $this->db->last_query();exit;
                $d= $query->result_array();
                //print_r($d);die;
                $length = count($d);
                
                $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                $this->db->where('product_name',$d[0]['product_name']);
                $this->db->limit($length);
                $query = $this->db->get();
               // echo $this->db->last_query();exit;
                $levels= $query->result_array();
                //print_r($levels); echo '<br>';die;
                $result_array=array();
                for($i=0;$i<$length; $i++){
                    $this->db->select('*');
                    $this->db->from('cin_result');
                    $this->db->where('clevel',$levels[$i]['level_id']);
                    $this->db->where('cin',$cin);
                    //$this->db->where('status !=','');
                    $this->db->order_by('id', 'desc');
                    $query = $this->db->get();
                    $res= $query->row();
                    //$res = $this->db->order_by('id', 'desc')->get_where('cin_result', array('clevel' => $levels[$i]['level_id']))->row();

                   // print_r($res->cin);die;
                    
                    if(!empty($res)){
                    
                    $q=array(
                        'level_id'=>$levels[$i]['level_id'],
                        'level_name'=>$levels[$i]['level_name'],
                        'cin'=>$res->cin,
                        'marks'=>$res->marks,
                        'grade'=>$res->grade,
                        'status'=>$res->status,
                        'rank'=>$res->rank,
                        'performer'=>$res->performer,
                        'speller'=>$res->speller,
                        'clevel'=>$res->clevel,
                        'product_name'=>$res->product_name,
                        'show'=>$res->show,
                        'period_id'=>$res->period_id
                        );
                    //print_r($q);die;   
                    array_push($result_array,$q);
                    }
                }
                
                //print_R($result_array);die;
                // $this->db->join('competition_level_byproduct','competition_level_byproduct.product_name=cin_result.product_name');
                // $query = $this->db->get();
                //  echo $this->db->last_query();exit;
                // $d= $query->row_array();
                // if(!empty($d)){
                //     array_push($result_array,$d);
                // }
            $this->session->set_userdata('product',$d[0]['product_name']);
                
            $data['result_array']=$result_array;
            $this->load->view('current_year/result_view.php',$data);
      	      
      	  }
      	  
    
    public function api_call_()
    {
        $cin=$this->session->userdata('cin');
        $product=$this->session->userdata('product');
                    
        $level = $this->uri->segment(3); 
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'product'=>$product
        );

        $url = 'https://marrs.in/student_registration/api';
        
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        echo $response;
        redirect('cin_login/index', 'refresh');
    
    }  	
    
    
    public function load_pdf()
    {
        echo 'ok';die;
    }
    
    
    // public function api_call() {
    // $cin = $this->session->userdata('cin');
    // $product = $this->session->userdata('product');
    // $level = $this->uri->segment(3);
    // $data = array(
    //     'cin' => $cin,
    //     'clevel' => $level,
    //     'product' => $product
    // );
   // print_r($data);die;
// ========================== //
        // $url = 'https://abhishekmarrs.cambridgeolympiads.com/certificate';
        
        // $ch = curl_init($url);
        
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        // $response = curl_exec($ch);
        // curl_close($ch);
        
        // echo $response;

// ----------------------- //
// ob_clean();
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://abhishekmarrs.cambridgeolympiads.com/certificate',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'[
//             {
//                 "cin":  "'.$cin.'",
//                 "competitionLevel": "'.$level.'",
//                 "Product": "'.$product.'",
//             }
//         ]',
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;


//         header("Content-type:application/pdf");
//         header("Content-Disposition:attachment;filename=downloaded.pdf");


// }


    public function api_call() 
    {
        $cin = $this->session->userdata('cin');
    
        $this->db->select('*');
                        $this->db->from('cin_result');
                        $this->db->where('cin',$cin);
                        $query = $this->db->get();
                        $res= $query->row();
                        $product=$res->product_name;
        
     
        $level = $this->uri->segment(3);
        $sch = $this->uri->segment(4);
        // Prepare the data to be sent in the request
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'schedule'=>$sch,
            'product' => $product,
            
        );
    
        $postFields = json_encode($data);
        //print_r($data);die;
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.marrs.in/certificate',
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


    public function api_callb() 
    {
        $cin = $this->session->userdata('cin');
    
        $this->db->select('*');
                        $this->db->from('cin_result');
                        $this->db->where('cin',$cin);
                        $query = $this->db->get();
                        $res= $query->row();
                        $product=$res->product_name;
        
     
        $level = $this->uri->segment(3);
        $sch = $this->uri->segment(4);
        // Prepare the data to be sent in the request
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'schedule'=>$sch,
            'product' => $product,
            
        );
        
        $postFields = json_encode($data);
    //print_r($data);die;
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.marrs.in/bpcertificate',
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
        header("Content-Disposition:attachment;filename=bestperformer.pdf");
    
        // Output the PDF response
        echo $response;
    }
    
    public function api_callp() 
    {
        $cin = $this->session->userdata('cin');
       $id = $this->uri->segment(3);
        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->where('id',$id);
                        $this->db->where('cin',$cin);
                        $query = $this->db->get();
                        $res= $query->row();
                        $product=$res->product_name;
        
     
         $level= $res->clevel;   
        $sch = $res->comp_id;
        // Prepare the data to be sent in the request
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'schedule'=>$sch,
            'product' => $product,
            
        );
        
        $postFields = json_encode($data);
    //print_r($data);die;
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.marrs.in/bpcertificate',
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
        header("Content-Disposition:attachment;filename=bestperformer.pdf");
    
        // Output the PDF response
        echo $response;
    }	  
      	  
    public function api_calls() 
    {
        $cin = $this->session->userdata('cin');
    
        $this->db->select('*');
                        $this->db->from('cin_result');
                        $this->db->where('cin',$cin);
                        $query = $this->db->get();
                        $res= $query->row();
                        $product=$res->product_name;
        
     
        $level = $this->uri->segment(3);
        $sch = $this->uri->segment(4);
        // Prepare the data to be sent in the request
        $data = array(
            'cin' => $cin,
            'clevel' => $level,
            'schedule'=>$sch,
            'product' => $product,
            
        );
        
        $postFields = json_encode($data);
    //print_r($data);die;
        // Initialize cURL session
        $curl = curl_init();
    
        // Set cURL options
        curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.marrs.in/sscertificate',
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
        header("Content-Disposition:attachment;filename=bestperformer.pdf");
    
        // Output the PDF response
        echo $response;
    }      	  
      	  
      	  
    public function result_view()
    {
        $this->load->model('newmodel');
        $cin=$this->session->userdata('cin');
        $data['cin']=$cin;
            //  echo $cin;
            $student=$this->newmodel->get_student_data_cin($cin);
	   // print_r($student);die;  
            $data['student']=$student; 
            $this->db->select('level_id');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$student['product_name']);
            $this->db->order_by('level_id','ASC');
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $d= $query->result();  
           //   print_r($d);die;
            $level_array=array();
            foreach($d as $row){
                array_push($level_array,$row->level_id);
            }
            //  print_r($level_array);die;
              
            $result_array=array();
            
            foreach($level_array as $level){
                
                $this->db->select('*');
                $this->db->from('cin_result');
                $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel','left');
                $this->db->where('cin', $cin);
                $this->db->where('status !=', '');
                $this->db->where('clevel', $level);
                $this->db->where('competition_level_byproduct.product_name=cin_result.product_name');

                $query = $this->db->get();
                //echo $this->db->last_query();exit;
                $d= $query->row_array();
               // print_r($d['product_name']);die;
                if(!empty($d)){
                    array_push($result_array,$d);
                }
                // $this->session->set_userdata('amount', $amount);
                $this->session->set_userdata('product',$d['product_name']);
            }
                
        $data['result_array']=$result_array;
        //print_r($result_array);die;
         
        
        $this->load->view('current_year/result_view.php',$data);
    } 
    
//--------------- -///
//// ------------- Added by abhishek 5/10/2023 ------------ //

    public function download_certificate()
    {
                $this->load->model('newmodel');
                $id = $this->uri->segment(3);
                $cin=$this->session->userdata('cin');
              
               // $data['student']=$this->newmodel->get_student_data_cin($cin);
             //   print_r($data['student']);die;
             
            // echo 'jj';
             
             
                
                $this->db->select('*');
                $this->db->from('cin_result');
                $this->db->where('cin',$cin);
                $this->db->where('status !=', '');
                $this->db->where('clevel',$id);
                $this->db->order_by('id','DESC');
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $data['result']=$result_array= $query->row_array();
                
                if($result_array['period_id']=='12'){
                   
                   
                    $this->db->select('level_name,medal_no,level_id');
                    $this->db->from('competition_level_byproduct');
                    $this->db->where('product_name', $result_array['product_name']);
                    $this->db->where('level_id',$result_array['clevel']); 
                    $query = $this->db->get();
                    //echo $this->db->last_query();exit;
                    $resul=$query->row_array();
                    $nl= $resul['medal_no'];
                    // print_r($resul);die;
                    
                    $this->db->select('level_name,medal_no,level_id');
                    $this->db->from('competition_level_byproduct');
                    $this->db->where('product_name', $result_array['product_name']);
                    $this->db->where('medal_no',$nl+1); 
                    $query = $this->db->get();
                    $resul=$query->row_array();
                    $res = $this->db->order_by('id', 'desc')->get_where('cin_result', array('clevel' => $resul['level_id']))->row();
                    
                     if($res->show=='skip'){
                         $res = $this->db->get_where('competition_level_byproduct', array('medal_no' => $nl+2,'product_name'=>$res->product_name))->row();
                         //echo $this->db->last_query();die;
                         $data['nex_level']= $res->level_name;
                    
                     }else{
    
                     $data['nex_level']= $resul['level_name'];
                   }
                // echo $nl;die;
                }
                
                
                
                $this->db->select('medal_no,level_name,level_id');
                $this->db->from('competition_level_byproduct');
                $this->db->where('level_id',$id);
                $this->db->where('product_name', $data['result']['product_name']);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $res=$query->row_array();
                $data['level_name']=$res['level_name'];
                $data['medal']= $res['medal_no'];
                
                $this->db->select('show');
                $this->db->from('cin_result');
                $this->db->where('clevel',$res['level_id']);
                $this->db->where('cin',$cin);
                $this->db->order_by("id", "DESC");
                $query = $this->db->get();
                $result= $query->row_array();
                //print_r($result);
                
                // echo $result['level_id'];die;
                
                
               // echo $result_array['period_id'];die;
                
                if($result_array['period_id']!='12')
                {
                   
                        if($result['level_id']!=$id){
                
                 
                           $this->db->select('level_name');
                            $this->db->from('competition_level_byproduct');
                            $this->db->where('product_name', $data['result']['product_name']);
                            $this->db->where('level_id >', $id);
                            $this->db->order_by('level_id', 'ASC');
                            $this->db->limit(1);
                            $query = $this->db->get();
                            //  echo $this->db->last_query();
                            $result= $query->row_array();
     	                   // echo $result['level_name'];die; 
     	                   //print_r($result);die;
                            $data['nex_level']= $result['level_name'];
                            
                        }   else{
                             $data['nex_level']='';
                        }
                $data['student']=$this->newmodel->get_student_data_cin($cin);
                
                
                }else{
                    
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->where('cin',$cin);
                // $this->db->where('status !=', null);
                // $this->db->where('clevel',$id);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $data['student']= $query->row_array();
             
                }
                
             //   echo $data['nex_level'];die;
                
                if(isset($_POST['back'])){
                    redirect('cin_login/result_view', 'refresh');
                }
                if(isset($_POST['profile'])){
                    redirect('cin_login/index', 'refresh');
                }
                
            $this->load->view('current_year/download_certificate', $data);    
    }
    
    
     public function download_certificate_primary()
    {
                $this->load->model('newmodel');
                $id = $this->uri->segment(3);
                $cin=$this->session->userdata('cin');
              
                $this->db->select('*');
                $this->db->from('new_cart');
                $this->db->where('cin',$cin);
                $this->db->where('status !=', '');
                $this->db->where('id',$id);
                $this->db->order_by('id','DESC');
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $data['result']=$result_array= $query->row_array();
                
               
                $this->db->select('medal_no,level_name,level_id');
                $this->db->from('competition_level_byproduct');
                $this->db->where('level_id','13');
                $this->db->where('product_name', $data['result']['product_name']);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $res=$query->row_array();
                $data['level_name']=$res['level_name'];
                $data['medal']= $res['medal_no'];
                
                $this->db->select('*');
                $this->db->from('cin_result');
                $this->db->where('clevel','13');
                $this->db->where('cin',$cin);
                
                $query = $this->db->get();
                $result2= $query->row_array();
                $data['competition_date']= $result2['competition_date'];
                $data['venue']= $result2['venue'];
                $data['grade']= $result2['grade'];
                $data['rank']= $result2['rank'];
                $data['status']= $result2['status'];
                //print_r($result); 
                
                // echo $result['level_id'];die;
                
                
               // echo $result_array['period_id'];die;
                
                if($result_array['period_id']!='12')
                {
                   
                        if($result['level_id']!=$id){
                
                 
                            $this->db->select('level_name');
                            $this->db->from('competition_level_byproduct');
                            $this->db->where('product_name',$data['result']['product_name']);
                            //$this->db->where('level_id !=', $id);
                            $this->db->where('level_id >=', $id);
                            $this->db->order_by("level_id", "ASC");
                            $query = $this->db->get();
                             //echo $this->db->last_query();exit;
                            $result= $query->row_array();
     	                   // echo $result['level_name'];die; 
     	                   
                            $data['nex_level']= $result['level_name'];
                            
                        }   else{
                             $data['nex_level']='';
                        }
                $data['student']=$this->newmodel->get_student_data_cin($cin);
                
                
                }else{
                    
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->where('cin',$cin);
                // $this->db->where('status !=', null);
                // $this->db->where('clevel',$id);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $data['student']= $query->row_array();
             
                }
                
             //   echo $data['nex_level'];die;
                
                if(isset($_POST['back'])){
                    redirect('cin_login/result_view', 'refresh');
                }
                if(isset($_POST['profile'])){
                    redirect('cin_login/index', 'refresh');
                }
                
            $this->load->view('current_year/download_certificate_primary', $data);    
    }

////======================== ////
	public function edit_cin_login()
	{
	    $this->load->model('newmodel');
	    $cin=$this->session->userdata('cin'); 
	    $data['class'] = $this->db->get_where('class')->result_array();
	   //print_r($data['res']);die;
	    if(isset($_POST['submit'])){
	      // print_r($_POST);die;
			 $q=array(
	            'stud_email'=>$_POST['stud_email'],
	            'stud_phone'=>$_POST['stud_phone'],
				'father_email'=>$_POST['father_email'],
				'mother_name'=>$_POST['mother_name'],
				'father_name'=>$_POST['father_name'],
				// 'class' =>$_POST['class']
	            );
	            
	            $payload = [
                        'email'        => $_POST['stud_email'] ?? '',
                        'phone_no'     => $_POST['stud_phone'] ?? '',
                        'cin'          => $cin,
                        'mother_name'  => $_POST['mother_name'] ?? '',
				        'father_name'  => $_POST['father_name'] ?? '',
                    ];
                
                    // print_r($payload);    
                    
                $syncResult = $this->sync_to_grademarker($payload);
	            
	            
			$this->db->where('cin', $cin);
			$query = $this->db->update('cin_list',$q);
			$this->session->set_flashdata('message', 'Profile Updated Successfully.');
			redirect('cin_login/index');
	    }
	    if(isset($_POST['back'])){
	        redirect('cin_login/index');
	    }
	     $data['student']=$this->newmodel->get_student_data($cin);
	    $this->load->view('cin_login/profile_edit_contact.php',$data);
	}
	
	
	private function sync_to_grademarker($payload)
    {
        $ch = curl_init();
    
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://grademarker.online/api',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 10,
        ]);
    
        $response = curl_exec($ch);
        curl_close($ch);
        
        // print_r($response);die;
        
        return  $response;
    }
	
	
	public function emailverify()
	{
		
		  $otp = $this->uri->segment(3);
		  $email = $this->session->userdata('email');
		  $phone = $this->session->userdata('phone');
		  $vfotp = $this->session->userdata('otp');
		  $cin = $this->session->userdata('cin');
		 if($vfotp==$otp){
		     //echo '-------';die;
		        $q = array(
	            'stud_email'=>$email,
	            'stud_phone'=>$phone
	            );     
				
				$this->db->where('cin',$cin);
				$query = $this->db->update('cin_list',$q);
				//echo $query;die;
				$this->session->set_flashdata('success', 'Email Update Successfully.'); 
				redirect('cin_login/edit_cin_login', 'refresh');	 
			
		}
		
	}
	
	
	public function product()
	{
	    $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	   // print_r($school_id[0]['class']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    if(empty($data['cart'])){
	   // $data['product']=$this->newmodel->get_student_product($school);
	   
	        $data['product']=array('price_code'=>'21NT5500',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'5500',
                    );
	    }
	    $class=$school_id[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period);
	    $check=$this->newmodel->get_student_material_paid($cin,$product,$clevel,$class);
	    if(!empty($check)){
	    $data['material']=$this->newmodel->get_student_material($class,$subject,$product,$clevel);}
	    
	    
	    $this->load->view('cin_login/product.php',$data);
	}
	
	
	public function logout()
	{
	    $cin=$this->session->userdata('cin');
	    $this->db->where('cin', $cin);
        $this->db->delete('amount_cart');
	    $this->session->unset_userdata('cin');
	    redirect('https://marrs.in/signin.php');
	    
	}
	
	
	public function free_material_()
	{
	    $this->load->model('newmodel');
	   
	    $class=$this->input->post('class');
	   // $subject=$this->input->post('subject');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	    $status=$this->input->post('status');
	    $type=$this->input->post('type');
	    // $clevel=$clevel;
	    //echo $class.$status.$product.$clevel.$period.$type;die;
	    $data['material']=$this->newmodel->get_student_material_free_($class,$status,$product,$clevel,$period,$type); 
	    //print_r($data['material']);
       
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_free/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
	    
	}
	
	public function primary_colors_free_mat_download($id)
    {
        $this->db->select('folder,class,title');
        $this->db->from('study_material');
        $this->db->where("id", $id); // ✅ FIXED
        $query = $this->db->get();
        $material = $query->row();
    
        if(!empty($material)){
            $filepath = "../study_material_free/" . $material->folder;
    
            if(file_exists($filepath)){
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filepath));
                flush();
                readfile($filepath);
                exit;
            } else {
                echo "File not found.";
            }
        } else {
            echo "Invalid material.";
        }
    }
    // Free Material Download Function Universal except primary colors international.

    public function free_material_down()
	{
	   
	    $this->db->select('folder,class,title');
        $this->db->from('study_material');
        $this->db->where("id",$_POST['mat_id']);
        $query = $this->db->get();
        $data['material']= $query->result_array();
       
    //   echo $this->db->last_query();die;
       
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_free/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/enroll', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
	    
	}


	public function free_material()
	{
	   // echo $this->session->userdata('cin');
	// print_r($_POST);die;
	    $this->load->model('newmodel');
	   
	    $class=$this->input->post('class');
	   // $subject=$this->input->post('subject');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	    $status=$this->input->post('status');
	  
	   $clevel=$clevel-1;
	  
	    $data['material']=$this->newmodel->get_student_material_free($class,$status,$product,$clevel,$period); 
	    //print_r($data['material']);
       
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_free/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
    }
    
    
    public function paid_mat_new()
    {
        $this->load->model('newmodel');
	    $class=$this->input->post('class');
	    $status=$this->input->post('status');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	    $type=$this->input->post('type');
	   // echo $class.'<br>';
///echo $subject.'<br>';
	   // echo $product.'<br>';
	   // echo $period.'<br>';
	   // echo $clevel.'<br>';
	   
	   //$clevel=$clevel-1;
	   // echo $clevel;
	   // die;
	    $data['material']=$this->newmodel->get_student_material_d_($class,$product,$clevel,$period,$status,$type); 
	   // print_r($data['material']);
        //echo 'ok';die;
        
        if(isset($_POST['download'])){
               $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_paid/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
       
    }
    
    
    public function paid_mat_new_down()
    {
        $this->db->select('folder,class,title');
        $this->db->from('study_material');
        $this->db->where("id",$_POST['mat_id']);
        $query = $this->db->get();
        $data['material']= $query->result_array();
        
        if(isset($_POST['download'])){
               $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_paid/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('Cin_login/enroll', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
    }
    
    
    public function paid_material()
    {
         $this->load->model('newmodel');
	    $class=$this->input->post('class');
	    $status=$this->input->post('status');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	   // echo $class.'<br>';
///echo $subject.'<br>';
	   // echo $product.'<br>';
	   // echo $period.'<br>';
	   // echo $clevel.'<br>';
	   
	   $clevel=$clevel-1;
	   // echo $clevel;
	   // die;
	    $data['material']=$this->newmodel->get_student_material_d($class,$product,$clevel,$period,$status); 
	   // print_r($data['material']);
        //echo 'ok';die;
        
        if(isset($_POST['download'])){
               $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_paid/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
    
    }
// ------------------------------------------------- //

    public function checkout() 
    {
            $cin=$this->session->userdata('cin');
            $student=$this->newmodel->get_student_data($cin);
            $amount=$_POST['amount'];
            //print_r($student[0]);die;
            $name=$student[0]['student_name'];
            $email=$student[0]['stud_email'];
            $mobile=$student[0]['stud_phone'];
      // print_r($mobile);die;
            $data['name']=$name;
            $data['email']=$email;
            $data['mobile']=$mobile;
            $data['amount']=$amount;
    	    $data['title'] = 'Checkout payment ';  
            $data['product_name'] = $_POST['product_name'];
            $data['return_url'] = base_url().'neww/callback';
            $data['surl'] = base_url().'neww/success';
            $data['furl'] = base_url().'neww/failed';
            $data['currency_code'] = 'INR';
            $this->session->set_userdata('amount', $amount);
            $this->session->set_userdata('products', $_POST['product_name']);
            $this->load->view('cin_login/checkout', $data);
    }
    
    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  
    {
        $arr=$this->session->userdata('products');
        $this->session->set_userdata('amount', $amount);
        $this->session->set_userdata('products', $arr);
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = 'rzp_live_UMziCF38129HCi';
        $key_secret = 'nMj5U0daHbD6KxINizRDg8m6';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function callback()
    {   
       // print_r($_POST);exit;
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $this->session->set_userdata('amount_data',$_POST);
            redirect('cin_login/success');
            
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    
    
    public function success() 
    {
        $cin=$this->session->userdata('cin');
        
        $amount_data=$this->session->userdata('amount_data');
        $amount=0;
        $arr=$this->session->set_userdata('products');
        $this->session->set_userdata('amount', $amount);
        $this->session->set_userdata('products', $arr);
        $product_name=$this->session->userdata('products');    
        $data['title'] = 'Razorpay Success ';  
        // echo 'success'.'<br>';
        $prid=$_SESSION['cin'];
        $data['session']=$_SESSION;
        $this->newmodel->cart_new($cin,$amount_data);
        $this->db->where('cin', $cin);
        $this->db->delete('amount_cart');
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/success', $data);
    }  
    
    
    public function failed() 
    {
        $cin=$this->session->userdata('cin');
        $data['arr']=$this->session->userdata('products');
        $data['amount']=$this->session->userdata('amount');
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$_SESSION;
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/tranctionfailed', $data);
    } 


    public function study_material()
    {
        $cin=$this->session->userdata('cin');
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel);
	    //$check=$this->newmodel->get_student_material_paid($cin,$product,$clevel,$class);
	    $data['material']=$this->newmodel->get_student_material($class,$subject,$product,$clevel);
        $this->load->view('cin_login/material', $data);
    }
    
    
    public function net_abc($id='')
    {
         $cin  = $this->session->userdata('cin');
        $amount = $this->input->post('id');
        //echo $amount;die;
        $c=explode("+",$amount);
        //print_R($c);die;
        // if($c[1]=='Combo-1' or $c[1]=='Combo-2' or $c[1]=='Combo-3' or $c[1]=='Combo-4'){
        //     echo $c[0].' '.$c[1];die;
            
            
        // }else{
            //echo $c[1];die;
            $data = array('amount' => $c[0],'cin' =>$cin,'title'=>$c[1]);
            //print_R($data);die;
            $res = $this->db->get_where('amount_cart',array('amount' =>$c[0],'cin' =>$cin,'title'=>$c[1]))->row();
                if($c[0] != $res->amount){
                    $query = $this->db->insert('amount_cart',$data);
                }
        // }
        
        
        // $cin  = $this->session->userdata('cin');
        // $data = array('amount' => $amount,'cin' =>$cin);
        // $res = $this->db->get_where('amount_cart',array('amount' =>$amount,'cin' =>$cin))->row();
        // if($amount != $res->amount){
        //  $query = $this->db->insert('amount_cart',$data);
        // }
        
       return $data;
        
    }
	   
	   
	public function net_abc_($id='')
	{
         $cin  = $this->session->userdata('cin');
        $amount = $this->input->post('id');
        //echo $amount;die;
        $c=explode("+",$amount);
        // print_R($c);die;
        if($c[1]=='Combo-1' or $c[1]=='Combo-2' or $c[1]=='Combo-3' or $c[1]=='Combo-4'){
            //echo 'pl';die;
            $this->db->where('cin',$cin);
            $this->db->delete('amount_cart');
            //echo $this->db->last_query();die;
            $data = array('amount' => $c[0],'cin' =>$cin,'title'=>$c[1]);
            //print_R($data);die;
            $res = $this->db->get_where('amount_cart',array('amount' =>$c[0],'cin' =>$cin,'title'=>$c[1]))->row();
                if($c[0] != $res->amount){
                    $query = $this->db->insert('amount_cart',$data);
                }
            //echo $this->db->last_query();die;    
        }else{
            //echo $c[1];die;
            $data = array('amount' => $c[0],'cin' =>$cin,'title'=>$c[1]);
            //print_R($data);die;
            $res = $this->db->get_where('amount_cart',array('amount' =>$c[0],'cin' =>$cin,'title'=>$c[1]))->row();
                if($c[0] != $res->amount){
                    $query = $this->db->insert('amount_cart',$data);
                }
        }
        
        
        // $cin  = $this->session->userdata('cin');
        // $data = array('amount' => $amount,'cin' =>$cin);
        // $res = $this->db->get_where('amount_cart',array('amount' =>$amount,'cin' =>$cin))->row();
        // if($amount != $res->amount){
        //  $query = $this->db->insert('amount_cart',$data);
        // }
        
       return $data;
        
    }
    
    
    public function net_abc___backup($id = '') 
	{
        $cin = $this->session->userdata('cin');
        $clevel = $this->session->userdata('clevel');
        $product = $this->session->userdata('product');
        $this->load->model('newmodel');
        $student = $this->newmodel->get_student_data($cin);
        $state = $student[0]['state_id'];
        $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
    
        $amount = $this->input->post('id');
        $c = explode("+", $amount);
    
        $conditionMet = 'Yes';
    
        $comp_id=$_SESSION['exam_id'];
        $resrr = $this->db->get_where('competition_product_state', ['id' => $comp_id])->row();
    
        $return = $this->revenue_calculation($cin,$c[0],$comp_id,$c[1]);
        // print_r($return);die;
        
        
        switch ($c[1]) {
            case 'Combo-1':
            case 'Combo-2':
            case 'Combo-3':
            case 'Combo-4':
            $str = str_replace('-', ' ', $res->{'combo_' . substr($c[1], -1)});
            $str = explode('+', $str);

            foreach ($str as $ro) {
                $ress = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $ro])->row();
                if (!empty($ress)) {
                    $conditionMet = 'No';
                    break;
                }
            }

            if ($conditionMet == 'Yes') {
                foreach ($str as $row) {
                    $res = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $row])->row();

                    if (empty($res)) {
                        $this->db->insert('amount_cart', ['amount' => $c[0], 'title' => $row, 'ini' => $c[1], 'cin' => $cin, 'comp_id'=> $_SESSION['exam_id']]);
                    } else {
                        $this->db->where(['cin' => $cin, 'title' => $row]);
                        $this->db->update('amount_cart', ['ini' => $c[1], 'amount' => $i[0], 'cin' => $cin, 'title' => $row, 'comp_id'=> $_SESSION['exam_id']]);
                    }
                }
            }
            break;

            case 'Material A':
            case 'Material B':
            case 'Material C':
            case 'Material D':
            case 'Material E':
            case 'Material F':
            case 'Orientation A':
            case 'Orientation B':
            case 'Orientation C':
            case 'MockTest':
            case 'MockTest A':
            case 'MockTest B':
            case 'MockTest C':
            case 'MockTest D':
            case 'MockTest E':
            case 'MockTest F':
            case 'Competition':
                $sch_id = $this->session->userdata('selected_close_date');
                if( $c[1]=='Competition' && $_SESSION['in']==1){
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];
                }else{
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1], 'comp_id'=> $_SESSION['exam_id']];
                }
                
                
                $res = $this->db->get_where('amount_cart', ['title' => $c[1], 'cin' => $cin, 'comp_id'=> $_SESSION['exam_id']])->row();
    
    
                if (empty($res)) {
                    $this->db->insert('amount_cart', $data);
                }
    
                break;
        }
    
        return $data;
    }
    
	
	public function net_abc___($id = '') 
	{
	    
	    
        // $cin = !empty($this->session->userdata('cin')) 
        // ? $this->session->userdata('cin') 
        // : $this->session->userdata('cinm');
        
        // $comp_id = !empty($this->session->userdata('exam_id')) 
        // ? $this->session->userdata('exam_id') 
        // : $this->session->userdata('exam_idm');
        
        // $cin = (isset($this->session->userdata('cinm')) && !empty($this->session->userdata('cinm')))
        // ? $this->session->userdata('cinm')
        // : $this->session->userdata('cin');

        // $comp_id = (isset($this->session->userdata('exam_idm')) && !empty($this->session->userdata('exam_idm')))
        // ? $this->session->userdata('exam_idm')
        // : $this->session->userdata('exam_id');
        
        $comp_id = $this->session->userdata('exam_idm');
        $cin = $this->session->userdata('cinm');
        $clevel = $this->session->userdata('clevel');
        $product = $this->session->userdata('product');
        
        $this->load->model('newmodel');
        
        
        $student = $this->newmodel->get_student_data($cin);
        // $state = $student[0]['state_id'];
        // $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
    
        $amount = $this->input->post('id');
        $c = explode("+", $amount);
    
        $conditionMet = 'Yes';
    
        // $comp_id = $_SESSION['exam_id'];
        
        
        $resrr = $this->db->get_where('competition_product_state', ['id' => $comp_id])->row();
    
        $return = $this->revenue_calculation($cin,$c[0],$comp_id,$c[1]);
        // echo '<pre>';
        // print_r($return);die;
        
        switch ($c[1]) {

            case 'Material A':
            case 'Material B':
            case 'Material C':
            case 'Material D':
            case 'Material E':
            case 'Material F':
            case 'Orientation A':
            case 'Orientation B':
            case 'Orientation C':
            case 'Orientation D':
            case 'Orientation E':
            case 'Orientation F':
            case 'MockTest':
            case 'MockTest A':
            case 'MockTest B':
            case 'MockTest C':
            case 'MockTest D':
            case 'MockTest E':
            case 'MockTest F':
            case 'Competition':
            case 'Learning Material A Training A':      
            case 'Learning Material B Training B':      
            case 'Learning Material C Training C':       
            case 'MaRRS Primary Colors - English':
            case 'MaRRS Primary Colors - Math':
            case 'MaRRS Primary Colors - Science':
            case 'MaRRS Primary Colors - Humanities':
                $sch_id = $this->session->userdata('selected_close_date');
                if( $c[1]=='Competition' && $_SESSION['in']==1){
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];
                }elseif( $c[1]=='MaRRS Primary Colors - English' && $_SESSION['in']==1){
                  $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];   
                    
                
                }elseif( $c[1]=='MaRRS Primary Colors - Math' && $_SESSION['in']==1){
                  $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];   
                    
                }elseif( $c[1]=='MaRRS Primary Colors - Science' && $_SESSION['in']==1){
                  $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];   
                    
                }elseif( $c[1]=='MaRRS Primary Colors - Humanities' && $_SESSION['in']==1){
                  $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1] ,'sch_id' => $sch_id, 'comp_id'=>$_SESSION['exam_id']];   
                    
                
                }else{
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = $c[1];
                    $return['comp_id'] = $comp_id;
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1], 'comp_id'=> $_SESSION['exam_id']];
                }
                
               
                $res = $this->db->get_where('amount_cart', ['title' => $c[1], 'cin' => $cin])->row();
    
    
                if (empty($res)) {
                    // $this->db->insert('amount_cart', $data);
                    $this->db->insert('amount_cart', $return);
                }
    
                break;
        }
    
        return $data;
    }
    
    
    public function net_abc___pri($id = '') 
	{
	    
	    
        // $cin = !empty($this->session->userdata('cin')) 
        // ? $this->session->userdata('cin') 
        // : $this->session->userdata('cinm');
        
        // $comp_id = !empty($this->session->userdata('exam_id')) 
        // ? $this->session->userdata('exam_id') 
        // : $this->session->userdata('exam_idm');
        
        // $cin = (isset($this->session->userdata('cinm')) && !empty($this->session->userdata('cinm')))
        // ? $this->session->userdata('cinm')
        // : $this->session->userdata('cin');

        // $comp_id = (isset($this->session->userdata('exam_idm')) && !empty($this->session->userdata('exam_idm')))
        // ? $this->session->userdata('exam_idm')
        // : $this->session->userdata('exam_id');
        
        $comp_id = $this->session->userdata('exam_idm');
        $cin = $this->session->userdata('cinm');
        $clevel = $this->session->userdata('clevel');
        $product = $this->session->userdata('product');
        
        $this->load->model('newmodel');
        
        
        $student = $this->newmodel->get_student_data($cin);
        // $state = $student[0]['state_id'];
        // $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
    
        $amount = $this->input->post('id');
        $c = explode("+", $amount);
    
        $conditionMet = 'Yes';
    
        // $comp_id = $_SESSION['exam_id'];
        
        $comp_id = $sch_id = $c[2];
        $resrr = $this->db->get_where('competition_product_state', ['id' => $comp_id])->row();
        $amount = $c[0];
        
        $return = $this->revenue_calculation($cin,$c[0],$c[2],'Competition');
        
        // echo $c[1];
        // echo '<pre>';
        // print_r($return);die;
        
        switch ($c[1]) {

            // case 'Material A':
            // case 'Material B':
            // case 'Material C':
            // case 'Material D':
            // case 'Material E':
            // case 'Material F':
            // case 'Orientation A':
            // case 'Orientation B':
            // case 'Orientation C':
            // case 'Orientation D':
            // case 'Orientation E':
            // case 'Orientation F':
            // case 'MockTest':
            // case 'MockTest A':
            // case 'MockTest B':
            // case 'MockTest C':
            // case 'MockTest D':
            // case 'MockTest E':
            // case 'MockTest F':
            // case 'Competition':
                
            case 'MaRRS Primary Colors - English':
            case 'MaRRS Primary Colors - Math':
            case 'MaRRS Primary Colors - Science':
            case 'MaRRS Primary Colors - Humanities':
              
                
                if( $c[1] == 'MaRRS Primary Colors - English' && $_SESSION['in'] == 1){
                    
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = 'Competition';
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => 'Competition' ,'sch_id' => $sch_id, 'comp_id'=>$comp_id];   
                    
                
                }elseif( $c[1] == 'MaRRS Primary Colors - Math' && $_SESSION['in'] == 1){
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = 'Competition';
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => 'Competition' ,'sch_id' => $sch_id, 'comp_id'=>$comp_id];   
                    
                }elseif( $c[1] == 'MaRRS Primary Colors - Science' && $_SESSION['in'] == 1){
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = 'Competition';
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => 'Competition' ,'sch_id' => $sch_id, 'comp_id'=>$comp_id];   
                    
                }elseif( $c[1]=='MaRRS Primary Colors - Humanities' && $_SESSION['in']==1){
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = 'Competition';
                    $return['comp_id'] = $comp_id;
                    $return['sch_id']  = $sch_id;
                    
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => 'Competition' ,'sch_id' => $sch_id, 'comp_id'=>$comp_id];   
                    
                
                }else{
                    $return['cin']     = $cin;
                    $return['amount']  = $amount;
                    $return['title']   = 'Competition';
                    $return['comp_id'] = $comp_id;
                   
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => 'Competition','sch_id' => $sch_id, 'comp_id'=> $comp_id];
                }
                
               
                $res = $this->db->get_where('amount_cart', ['title' => 'Competition', 'cin' => $cin, 'product_name'=> $c[1]])->row();
    
    
                if (empty($res)) {
                    // $this->db->insert('amount_cart', $data);
                    $this->db->insert('amount_cart', $return);
                }
    
                break;
        }
    
        return $data;
    }
    
    
    public function revenue_calculation($cin, $amount, $comp_id, $item)
    {   
        // Get student data
        $student = $this->db->get_where('cin_list', array('cin' => $cin))->row();
        
        // Fetch competition and revenue setting details
        $this->db->select('competition_product_state.*, revenue_setting.*,revenue_setting.com_per as franchise_per');
        $this->db->from('competition_product_state');
        $this->db->join('revenue_setting', 'revenue_setting.id = competition_product_state.revenue_setting_id', 'left');
        $this->db->where('competition_product_state.id', $comp_id);
        $competition = $this->db->get()->row();
       
        // print_r($competition);die;
        
        // Initialize variables
        $maker_id = $maker_razorpay_id = $maker_razorpay_name = '';
        $maker_gst = 0;
        $free_royalty = 0;
        $mat_free = null;
        
        // Fetch material maker based on item type
        if ($item == 'Competition') {
            $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id, assigned_materials.price');
            $this->db->from('study_material');
            $this->db->join('assigned_materials', 'assigned_materials.mat_id = study_material.id');
            $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_materials.maker_id');
            $this->db->where([
                'assigned_materials.period_id' => $competition->period_id,
                'study_material.status'        => 'Free',
                'class'                        => $student->class,
                'product_name'                 => $competition->product_name,
                'clevel'                       => $competition->clevel
            ]);
            if(!empty($student->subject)){
                $this->db->where('study_material.subject', $student->subject);
            }
            if(!empty($student->series)){
                $this->db->where('study_material.series', $student->series);
            }
            if(!empty($student->type)){
                $this->db->where('study_material.sub_type', $student->type);
            }
            $this->db->order_by('study_material.id', 'DESC');
            $mat_free = $this->db->get()->row();
        } 
        else if (strpos($item, 'Material') !== false) {
            $material_type = substr($item, -1); // Get A, B, C, etc.
            $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id, assigned_materials.price');
            $this->db->from('study_material');
            $this->db->join('assigned_materials', 'assigned_materials.mat_id = study_material.id');
            $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_materials.maker_id');
            $this->db->where([
                'assigned_materials.period_id' => $competition->period_id,
                'study_material.status'        => 'Paid',
                'study_material.type'          => $material_type,
                'class'                        => $student->class,
                'product_name'                 => $competition->product_name,
                'clevel'                       => $competition->clevel
            ]);
            if(!empty($student->subject)){
                $this->db->where('study_material.subject', $student->subject);
            }
            if(!empty($student->series)){
                $this->db->where('study_material.series', $student->series);
            }
            if(!empty($student->type)){
                $this->db->where('study_material.sub_type', $student->type);
            }
            $this->db->order_by('study_material.id', 'DESC');
            $mat_free = $this->db->get()->row();
        }
        else if (strpos($item, 'MockTest') !== false) {
            $mock_type = substr($item, -1); // Get A, B, C, etc.
            $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id');
            $this->db->from('mock_papers');
            $this->db->join('assigned_mock', 'assigned_mock.mat_id = mock_papers.paper_id');
            $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_mock.maker_id');
            $this->db->where([
                'assigned_mock.period_id' => $competition->period_id,
                'mock_papers.pay_status'  => 'Paid',
                'mock_papers.type'        => $mock_type,
                'mock_papers.class'       => $student->class,
                'mock_papers.product_name'=> $competition->product_name,
                'mock_papers.clevel'      => $competition->clevel
            ]);
            if(!empty($student->subject)){
                $this->db->where('mock_papers.subject', $student->subject);
            }
            if(!empty($student->series)){
                $this->db->where('mock_papers.series', $student->series);
            }
            if(!empty($student->type)){
                $this->db->where('mock_papers.sub_type', $student->type);
            }
            $this->db->order_by('mock_papers.paper_id', 'DESC');
            $mat_free = $this->db->get()->row();
        }
        
        // Extract revenue percentages from competition and revenue_setting
        $franchise_per = $competition->franchise_per;
        
        $aviansys_per  = $competition->com_peravian;
        $manage_per    = $competition->manageper;
        $crm_fix       = $competition->crm_fix;
        $it_fix        = $competition->it_fix;
        // $crm_fix       = 0;
        $school_amount = $competition->school_amount ?? 0;
        $associate_per = $competition->associate_per ?? 0;
        $associate_id  = $competition->associate_id;
        
        // Step 1: Razorpay charge
        // $razorpay_cut = round($amount * 0.04); // 3% assumed
        // $after_razorpay = $amount - $razorpay_cut;
        $after_razorpay = round($amount / 1.04, 0);
            
        $razorpay_cut = $amount - $after_razorpay;
        
        // Step 2: Split GST (assuming inclusive)
        // $base_amount = round($after_razorpay / 1.18, 0);
        // $gst_total = round($after_razorpay - $base_amount, 0);
        $base_amount = round($after_razorpay / 1.18, 0);
            
        $gst_total = $after_razorpay - $base_amount;
        
        // Step 3: Deduct CRM, school, free royalty
        $net_base = $base_amount - $school_amount;
        
        
        $it_fix_amount = 0;
        if($competition->it_fix > 0 ){
            $it_fix_amount = round($amount * ($competition->it_fix / 100), 0); // from MRP
        }
        
        
        // echo $it_fix_amount;die;
        
        $net_base = $net_base - $it_fix_amount;
        
        // Initialize maker details
        if (!empty($mat_free)) {
            $maker_id = $mat_free->material_maker_id;
            $maker_razorpay_id = $mat_free->razorpay_id;
            $maker_razorpay_name = $mat_free->account_name;
            $maker_gst_per = $mat_free->gst;
            
            // Set free royalty based on item type
            if ($item == 'Competition') {
                // $crm_fix       = $competition->crm_fix;
                $free_royalty = $competition->study_material_free_royalty;
            } else if ($item == 'Material A') {
                $free_royalty = $competition->study_material_a_price_royalty;
            } else if ($item == 'Material B') {
                $free_royalty = $competition->study_material_b_price_royalty;
            } else if ($item == 'Material C') {
                $free_royalty = $competition->study_material_c_price_royalty;
            } else if ($item == 'Material D') {
                $free_royalty = $competition->study_material_d_price_royalty;
            } else if ($item == 'Material E') {
                $free_royalty = $competition->study_material_e_price_royalty;
            } else if ($item == 'Material F') {
                $free_royalty = $competition->study_material_f_price_royalty;
            } else if ($item == 'MockTest A') {
                $free_royalty = $competition->mock_test_a_price_royalty;
            } else if ($item == 'MockTest B') {
                $free_royalty = $competition->mock_test_b_price_royalty;
            } else if ($item == 'MockTest C') {
                $free_royalty = $competition->mock_test_c_price_royalty;
            } else if ($item == 'MockTest D') {
                $free_royalty = $competition->mock_test_d_price_royalty;
            } else if ($item == 'MockTest E') {
                $free_royalty = $competition->mock_test_e_price_royalty;
            } else if ($item == 'MockTest F') {
                $free_royalty = $competition->mock_test_f_price_royalty;
            } else if ($item == 'MockTest F') {
                $free_royalty = $competition->mock_test_f_price_royalty;
            }else if ($item == 'Learning Material A Training A') {
                $bundle_a_royality = $competition->bundle_price_a_royality;
            } else if ($item == 'Learning Material B Training B') {
                $bundle_b_royality = $competition->bundle_price_b_royality;
            } else if ($item == 'Learning Material C Training C') {
                $bundle_c_royality = $competition->bundle_price_c_royality;
            }
            
            
            if($maker_gst_per > 0){
                $maker_gst = round($gst_total * $maker_gst_per / 100, 0);
            }
            $free_royalty = $free_royalty + $maker_gst;
            
        }
        
        $net_base_fr = $net_base - $free_royalty;
        $net_base_bra = $net_base_fr - $bundle_a_royality;
        $net_base_brb = $net_base_bra - $bundle_b_royality;
        $net_base = $net_base_brb - $bundle_c_royality;
        
        
        // Get account details
        $franchise = $this->db->get_where('franchise', ['franchise_id' => $competition->franchise_id])->row();
        $aviansys = $this->db->get_where('gst_account_marrs', ['id' => '2'])->row();
        $manage   = $this->db->get_where('gst_account_marrs', ['id' => '3'])->row();
        
        $crm_account_id = !empty($competition->crm_account_id) ? $competition->crm_account_id : 5;

        
        $crm_acc = $this->db
            ->get_where('gst_account_marrs', ['id' => $crm_account_id])
            ->row();
                
        $gst_acc  = $this->db->get_where('gst_account_marrs', ['id' => '1'])->row();
        
        // Associate details
        $associate_gst = 0;
        $associate_amount = 0;
        $associate_name = null;
        $associate_account_id = null;
        
        if (!empty($associate_id)) {
            $associate = $this->db->get_where('associates', ['associate_id' => $associate_id])->row();
        
            if ($associate) {
                $associate_bank_details = $this->db->get_where('associate_bank_details', ['associate_id' => $associate_id])->row();
                    
                    $associate_name = $associate_bank_details->account_razorpay_name ?? '';
                    $associate_account_id = $associate_bank_details->razorpay_id ?? '';
        
                $associate_amount = round($net_base * ($associate_per / 100), 2);
        
                if (strtolower($associate->gst) == 'yes') {
                    $associate_gst = round($associate_amount * (18 / 100), 2);
                }
            }
            
            $franchise_per = $franchise_per - $associate_per;
        }
        
        // echo $franchise_per;
        // Step 4: Compute shares
        $franchise_amount = round($net_base * $franchise_per / 100, 0);
        
        // echo $franchise_amount;die;
        
        $aviansys_amount  = round($net_base * $aviansys_per / 100, 0);
        $management_amount = round($net_base * $manage_per / 100, 0);
        
        // Step 5: GST distribution
        $franchise_gst = 0;
        if(strtolower($franchise->gst) == 'yes'){
            $franchise_gst = round($franchise_amount * 18 / 100, 0);
        }
        $aviansys_gst  = round($aviansys_amount * 18 / 100, 0);
        $management_gst = 0;
        
        if($manage->gst > 0){
            $management_gst = round($management_amount * $manage->gst / 100, 0);
        }
        
        $crm_fix = !empty($competition->crm_fix) ? $competition->crm_fix : 0;

       

        if (!empty($competition->crm_per) && $competition->crm_per > 0) {
            $crm_fix = round(($net_base * $competition->crm_per) / 100, 0);
        }
        
        // echo $crm_fix;die;
         
        $crm_gst = 0;

        if (!empty($crm_acc) && is_numeric($crm_acc->gst) && $crm_fix > 0) {
            $crm_gst = round(($crm_fix * $crm_acc->gst) / 100, 0);
        }
        
        // Step 6: Remaining GST to Marrs
        $marrs_gst = round($gst_total - ($franchise_gst + $aviansys_gst + $maker_gst + $crm_gst + $management_gst + $associate_gst), 0);
        $marrs_left = round($net_base - ($franchise_amount + $aviansys_amount + $management_amount + $associate_amount + $crm_fix ), 0);
        
        // Insert maker splits if needed
        if (!empty($maker_id) && !empty($free_royalty)) {
            $makers_splits = [
                'title'             => $item,
                'maker_id'          => $maker_id,
                'price'             => $free_royalty,
                'revenue_setting_id'=> $competition->revenue_setting_id,
                'comp_id'           => $comp_id,
                'cin'               => $cin,
                'gst_amount'        => $maker_gst,
                'net_amount'        => $free_royalty - $maker_gst,
                'product_name'      => $competition->product_name
                // 'inserted_date'     => date("Y-m-d"),
                // 'inserted_time'     => date("H:i:s")
            ];
            
            $inser = $this->db->get_where('makers_splits', [
                'title'             => $item,
                'maker_id'          => $maker_id,
                'revenue_setting_id'=> $competition->revenue_setting_id,
                'comp_id'           => $comp_id,
                'cin'               => $cin
            ])->row();
            
            if(empty($inser)) {
                $this->db->insert('makers_splits', $makers_splits);
            } else {
                // Update existing record
                $this->db->where('id', $inser->id);
                $this->db->update('makers_splits', $makers_splits);
            }
        }
        
        // For materials and mock tests, we might need to handle multiple makers
        // Let's check if there are additional makers for this item
        if (strpos($item, 'Material') !== false || strpos($item, 'MockTest') !== false) {
            $additional_makers = [];
            
            if (strpos($item, 'Material') !== false) {
                $material_type = substr($item, -1); // Get A, B, C, etc.
                $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id, assigned_materials.price');
                $this->db->from('study_material');
                $this->db->join('assigned_materials', 'assigned_materials.mat_id = study_material.id');
                $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_materials.maker_id');
                $this->db->where([
                    'assigned_materials.period_id' => $competition->period_id,
                    'study_material.status'        => 'Paid',
                    'study_material.type'          => $material_type,
                    'class'                        => $student->class,
                    'product_name'                 => $competition->product_name,
                    'clevel'                       => $competition->clevel,
                    'material_maker.material_maker_id !=' => $maker_id
                ]);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject', $student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series', $student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type', $student->type);
                }
                $additional_makers = $this->db->get()->result();
            }
            else if (strpos($item, 'MockTest') !== false) {
                $mock_type = substr($item, -1); // Get A, B, C, etc.
                $this->db->select('material_maker.*,material_maker.gst as maker_gst_per,material_maker.material_maker_id as maker_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock', 'assigned_mock.mat_id = mock_papers.paper_id');
                $this->db->join('material_maker', 'material_maker.material_maker_id = assigned_mock.maker_id');
                $this->db->where([
                    'assigned_mock.period_id' => $competition->period_id,
                    'mock_papers.pay_status'  => 'Paid',
                    'mock_papers.type'        => $mock_type,
                    'mock_papers.class'       => $student->class,
                    'mock_papers.product_name'=> $competition->product_name,
                    'mock_papers.clevel'      => $competition->clevel,
                    'material_maker.material_maker_id !=' => $maker_id
                ]);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject', $student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series', $student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type', $student->type);
                }
                $additional_makers = $this->db->get()->result();
            }
            
            // Insert records for additional makers
            foreach ($additional_makers as $add_maker) {
                $add_maker_gst = 0;
                if($add_maker->gst > 0){
                    $add_maker_gst = round($gst_total * $add_maker->gst / 100, 0);
                }
                
                // Calculate royalty for additional maker (proportionally split)
                $add_maker_royalty = round($free_royalty / (count($additional_makers) + 1), 0);
                
                $add_makers_splits = [
                    'title'             => $item,
                    'maker_id'          => $add_maker->material_maker_id,
                    'price'             => $add_maker_royalty,
                    'revenue_setting_id'=> $competition->id,
                    'comp_id'           => $comp_id,
                    'cin'               => $cin,
                    'gst_amount'        => $add_maker_gst,
                    'net_amount'        => $add_maker_royalty - $add_maker_gst,
                    'inserted_date'     => date("Y-m-d"),
                    'inserted_time'     => date("H:i:s"),
                    'product_name'      => $competition->product_name
                ];
                
                $add_inser = $this->db->get_where('makers_splits', [
                    'title'             => $item,
                    'maker_id'          => $add_maker->material_maker_id,
                    'revenue_setting_id'=> $competition->id,
                    'comp_id'           => $comp_id,
                    'cin'               => $cin
                ])->row();
                
                if(empty($add_inser)) {
                    $this->db->insert('makers_splits', $add_makers_splits);
                } else {
                    // Update existing record
                    $this->db->where('id', $add_inser->id);
                    $this->db->update('makers_splits', $add_makers_splits);
                }
            }
        }
        
        // Return array with all fields
        return [
            'cin'                 => $student->cin ?? '',
            'product'             => $competition->product_name,
            'product_name'        => $competition->product_name,
            'class'               => $student->class,
            'name'                => $student->student_name ?? '',
            'item'                => $item,
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
            'it_fix'              => $it_fix_amount,
            'manage_amount'       => $management_amount,
            'aviansys_amount'     => $aviansys_amount,
            'aviansys_gst'        => $aviansys_gst,
            'razorpay_cut'        => $razorpay_cut,
            'payment_order_id'    => '',
            'inserted_date'       => date("Y-m-d"),
            'inserted_time'       => date("H:i:s"),
            'maker_id'            => $maker_id,
            'maker_razorpay_id'   => $maker_razorpay_id,
            'free_royalti_amount' => $free_royalty ?? '',
            'bundle_a_royality'   => $bundle_a_royality,
            'bundle_b_royality'   => $bundle_b_royality,
            'bundle_c_royality'   => $bundle_c_royality,
            'maker_razorpay_name' => $maker_razorpay_name,
            'franchise_id'        => $competition->franchise_id,
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
            
            // Legacy fields for backward compatibility
            'franchise_pay'       => $franchise_amount + $franchise_gst,
            'associate_pay'       => $associate_amount + $associate_gst,
            'aviansys_pay'        => $aviansys_amount + $aviansys_gst,
            'aviasys_pay'         => $aviansys_amount + $aviansys_gst,
            'MaRRS_Bal'           => $marrs_left,
            'management_pay'      => $management_amount + $management_gst,
        ];
    }
    
    
    public function revenue_calculation_($cin,$amount,$comp_id,$item)
    {   
        
        $data['student'] = $student = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
                // print_r($student);die;
       // echo $cin.' - '.$amount.' - '.$comp_id.' - '.$item;
        
        $return=array();
        
        $competition = $this->db->select('revenue_setting.*,competition_product_state.franchise_id,competition_product_state.associate_id')
                    ->from('competition_product_state')
                    ->join('revenue_setting', 'revenue_setting.id = competition_product_state.revenue_setting_id', 'left')
                    ->where([
                        'competition_product_state.id' => $comp_id
                        ])
                    ->get()
                    ->row();
        // print_r($competition);die;
        
                $franchise_per = $competition->com_per;
    	        $aviansys_per = $competition->com_peravian;
    	        $manageper = $competition->manageper;
    	        $crm_fix = $competition->crm_fix;
    	        $associate_per = $competition->associate_per;
    	        $associate_id = $competition->associate_id;
    	        
    	        $total_amount = $amount;
    	        $Base_GR = $total_amount;    // GR=>GST+Razorpay
    	        $Base_G = round($Base_GR/1.03);   
    	        $Base_cost = round($Base_G/1.18); 
    	        
    	         $Base_cost = $Base_cost - $crm_fix;
    	        $Base_code = $Base_cost - $free_royalti_amount;
    	        
    	        $razpay_service = $Base_GR - $Base_G;         // razorpay service charge for transaction is 3% aasumed
    	        
    	        $GST = round($Base_cost * 0.18);           // GST account money
    	                
    	        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$competition->franchise_id))->row();
                               
    	        $franchise_id = $competition->franchise_id;  
    	        
    	        $franchise_per = $franchise_per - $associate_per;
    	        
    	       // echo $franchise_per;die;
    	        
    	        $GST_fr=0;
    	        if($franchise->gst == 'Yes'){
    	            $GST_fr =round($GST * $franchise_per/100);
    	        }          
    	        
    	        $franchise_gst = $GST_fr;
    	        
    	        
    	        
    	       // $associate = $this->db->get_where('associates',array('associate_id'=>$competition->associate_id))->row();
    	       
                    $this->db->select('abd.*');
                    $this->db->from('associates a');
                    $this->db->join('associate_bank_details abd', 'abd.associate_id = a.associate_id', 'left');
                    $this->db->where('a.associate_id', $competition->associate_id);
                    $associate = $this->db->get()->row();
         
    	        $associate_id = $associate->associate_id; 
    	        
    	        $GST_As=0;
    	        if($associate->gst == 'Yes'){
    	            $GST_As = round($GST_fr * $associate_per/100);
    	        }
    	        $associate_gst = $GST_As;
    	        
    	        $GST_Av = round($GST * $aviansys_per/100);
    	        $aviansys_gst = $GST_Av;
    	        
    	        $rest_GST = round($GST - $GST_fr - $GST_Av - $GST_As);
    	        
    	        
        $maker='';
        $free_royalti_amount = 0;
        $total_gst = 0;
        
        if($item == 'Competition'){
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount = $competition->study_material_free_royalty + $make_gst;
                    
                }
        }   
        
    	if($item == 'Material A'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount = $competition->study_material_a_price_royalty;
                }
    	}     
    	if($item == 'Material B'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount=$competition->study_material_b_price_royalty;
                }
    	}   
    	if($item == 'Material C'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                } 
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount=$competition->study_material_c_price_royalty;
                }
    	}   
    	if($item == 'Material D'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount=$competition->study_material_d_price_royalty;
                }
    	}   
    	if($item == 'Material E'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount=$competition->study_material_e_price_royalty;
                }
    	}   
    	if($item == 'Material F'){  
                
                $this->db->select('study_material.*,assigned_materials.maker_id as maker');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$competition->clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$competition->product_name);
                $this->db->where('class',$student->class);
                $this->db->where('assigned_materials.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_materials.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_materials.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_materials.sub_type',$student->type);
                }
                $query=$this->db->get();
                $resa=$query->row();
                if($resa){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$resa->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$resa->maker;
                    $free_royalti_amount=$competition->study_material_f_price_royalty;
                }
    	}   
    	
    	if($item == 'MockTest A'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_a_price_royalty;
                }
    	}   
    	if($item == 'MockTest B'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_b_price_royalty;
                }
    	}
    	if($item == 'MockTest C'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_c_price_royalty;
                }
    	}
    	if($item == 'MockTest D'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_d_price_royalty;
                }
    	}
    	if($item == 'MockTest E'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_e_price_royalty;
                }
    	}
    	if($item == 'MockTest F'){  
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$competition->clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$competition->product_name);
                $this->db->where('mock_papers.class',$student->class);
                $this->db->where('assigned_mock.period_id',$student->period_id);
                if(!empty($student->subject)){
                    $this->db->where('assigned_mock.subject',$student->subject);
                }
                if(!empty($student->series)){
                    $this->db->where('assigned_mock.series',$student->series);
                }
                if(!empty($student->type)){
                    $this->db->where('assigned_mock.sub_type',$student->type);
                }
                $query=$this->db->get();
                $mata = $query->row();
                if($mata){
                    $make = $this->db->get_where('material_maker',array('material_maker_id'=>$mata->maker))->row();
                    $make_gst = 0;
    	            if(!empty($make->gst) && $make->gst != 0){
    	                $make_gst = round($rest_GST * $make->gst/100);
    	            }
    	            $total_gst=$total_gst+$make_gst;
                    $maker=$mata->maker;
                    $free_royalti_amount=$competition->mock_test_f_price_royalty;
                }
    	}
    	
    	$marrs_gst = $rest_GST-$total_gst;
    	
    	$makers_splits=[
    	    'title'=>$item,
    	    'maker_id'=>$maker,
    	    'price'=>$free_royalti_amount,
    	    'revenue_setting_id'=>$competition->id,
    	    'comp_id'=>$comp_id,
    	    'cin'=>$cin,
    	    'product_name' => $competition->product_name
    	];
    // 	print_r($makers_splits);die;
    	$inser = $this->db->get_where('makers_splits',$makers_splits)->row();
    	if(empty($inser)){$this->db->insert('makers_splits',$makers_splits);}
    // 	echo $maker;
    //     echo $free_royalti_amount;
    //     die;            
                    
    	       
    	        
    	        $Aviasys_pay = round($Base_cost * $aviansys_per/100);
    	        $totalAviasys_pay = $Aviasys_pay + $GST_Av; // payment made to aviansys per user transaction
    	        
    	        
    	        $Franchise_pay = round ($Base_cost * $franchise_per/100);   // payment made to franchise per user transaction
    	        
    	        $Associate_pay = round ($Franchise_pay * $associate_per/100);   // payment made to franchise per user transaction
    	        $totalAssociate_pay = $Associate_pay + $GST_As;
    	        
    	        $totalFranchise_pay = $Franchise_pay + $GST_fr  - $Associate_pay - $GST_As;
    	        
    	        
    	        $management_pay = round ($Base_cost * $manageper/100);
    	        
    	        $return['franchise_id'] = $competition->franchise_id;
                // $return['school_id'] = $student->school_id;
                
                $return['razpay_service'] = $razpay_service;
                $return['franchise_gst'] = $franchise_gst;
                $return['aviansys_gst'] = $aviansys_gst;
                $return['marrs_gst'] = $marrs_gst;
    	        $return['crm_fix'] = $crm_fix;
    	        
    	        $totalcut = 0;
    	        $totalcut = $totalcut + $totalFranchise_pay;
    	        $totalcut = $totalcut + $totalAssociate_pay;
    	        $totalcut = $totalcut + $totalAviasys_pay;
    	        $MaRRS_Bal = $Base_cost - $totalcut;
    	        
    	        $return['franchise_pay'] = $totalFranchise_pay;
    	        $return['associate_pay'] = $totalAssociate_pay;
    	        $return['aviasys_pay'] = $totalAviasys_pay;
    	        $return['MaRRS_Bal'] = $MaRRS_Bal;
    	        $return['management_pay'] = $management_pay;
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
        	        
    	        
             
       // echo '<pre>';
       // print_r($return);die;
        
        
        
    return $return;
   
}
    
    
    public function save_close_date() 
    {
        $date = $this->input->post('close_date');
        $this->session->set_userdata('selected_close_date', $date);
    }
    

	public function cart_remove($id='')
	{
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            $state = $student[0]['state_id'];
            $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
        
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
        
            $this->db->where('cin', $cin);
        
            switch ($c[1]) {
                case 'Combo-1':
                case 'Combo-2':
                case 'Combo-3':
                case 'Combo-4':
                    $this->db->where('ini', $c[1]);
                    break;
                default:
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    break;
            }
        
            $this->db->delete('amount_cart');
	   }
	   
// ================= cart work ================== //	  
	  
	public function cart_remove_($id = '') 
	{
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            $state = $student[0]['state_id'];
            $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
        
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
            if($c[1]=='Material A'){
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation A');
                    $this->db->where('ini', '');
                    $message='Material A and Orientation A is Deleted.';
                    $this->db->delete('amount_cart');
            }
            
            elseif($c[1]=='Material B'){
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation B');
                    $this->db->where('ini', '');
                    $message='Material B and Orientation B is Deleted.';
                    $this->db->delete('amount_cart');
            }
            elseif($c[1]=='Material C'){
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation C');
                    $this->db->where('ini', '');
                    $message='Material C and Orientation C is Deleted.';
                    $this->db->delete('amount_cart');
            }
            else{
            $this->db->where('cin', $cin);
        
            switch ($c[1]) {
                case 'Combo-1':
                case 'Combo-2':
                case 'Combo-3':
                case 'Combo-4':
                    $this->db->where('ini', $c[1]);
                    $message=$c[1].' Deleted';
                    break;
                default:
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $message=$c[1].' is Deleted.';
                    break;
                    
            }
            $this->db->delete('amount_cart');
        }
            
        echo $message;    
        return $message;
    }
	   
	   
	public function net_abc__($id = '') 
	{
	    
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            $state = $student[0]['state_id'];
            $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
        
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
        
            $conditionMet = 'Yes';
        
            switch ($c[1]) {
                case 'Combo-1':
                case 'Combo-2':
                case 'Combo-3':
                case 'Combo-4':
                    $str = str_replace('-', ' ', $res->{'combo_' . substr($c[1], -1)});
                    $str = explode('+', $str);
        
                    foreach ($str as $ro) {
                        $ress = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $ro])->row();
                        if (!empty($ress)) {
                            $conditionMet = 'No';
                            break;
                        }
                    }
        
                    if ($conditionMet == 'Yes') {
                        foreach ($str as $row) {
                            $res = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $row])->row();
        
                            if (empty($res)) {
                                $this->db->insert('amount_cart', ['amount' => $c[0], 'title' => $row, 'ini' => $c[1], 'cin' => $cin]);
                            } else {
                                $this->db->where(['cin' => $cin, 'title' => $row]);
                                $this->db->update('amount_cart', ['ini' => $c[1], 'amount' => $i[0], 'cin' => $cin, 'title' => $row]);
                            }
                        }
                        $message=' Combo added in Cart.';
                    }else{
                        $message=' Combo item alredy in Cart.';
                    }
                    break;
        
                case 'Material A':
                case 'Material B':
                case 'Material C':
                case 'Orientation A':
                case 'Orientation B':
                case 'Orientation C':
                case 'MockTest':
                case 'Competition':
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1]];
                    $res = $this->db->get_where('amount_cart', ['title' => $c[1], 'cin' => $cin])->row();
        
                    if (empty($res)) {
                        $this->db->insert('amount_cart', $data);
                        $message=$c[1].' Added to cart';
                    }else{
                        $message=$c[1].' Already in Cart.';
                    }
        
                    break;
            }
        echo $message;
    return $message;
    }

// ========= end ========== //

// ========== test cart ================ //
    public function net_abc____($id = '') 
    {
	    
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            $state = $student[0]['state_id'];
            $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
        
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
        
            $conditionMet = 'Yes';
        
            switch ($c[1]) {
                case 'Combo-1':
                case 'Combo-2':
                case 'Combo-3':
                case 'Combo-4':
                    $str = str_replace('-', ' ', $res->{'combo_' . substr($c[1], -1)});
                    $str = explode('+', $str);
        
                    foreach ($str as $ro) {
                        $ress = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $ro])->row();
                        if (!empty($ress)) {
                            $conditionMet = 'No';
                            break;
                        }
                    }
        
                    if ($conditionMet == 'Yes') {
                        foreach ($str as $row) {
                            $res = $this->db->get_where('amount_cart', ['cin' => $cin, 'title' => $row])->row();
        
                            if (empty($res)) {
                                $this->db->insert('amount_cart', ['amount' => $c[0], 'title' => $row, 'ini' => $c[1], 'cin' => $cin]);
                            } else {
                                $this->db->where(['cin' => $cin, 'title' => $row]);
                                $this->db->update('amount_cart', ['ini' => $c[1], 'amount' => $i[0], 'cin' => $cin, 'title' => $row]);
                            }
                        }
                        $message=' Combo added in Cart.';
                    }else{
                        $message=' Combo item alredy in Cart.';
                    }
                    break;
        
                case 'Material A':
                case 'Material B':
                case 'Material C':
                case 'Material D':
                case 'Material E':
                case 'Material F':
                case 'Orientation A':
                case 'Orientation B':
                case 'Orientation C':
                case 'MockTest':
                case 'MockTest A':    
                case 'MockTest B':
                case 'MockTest C':
                case 'MockTest D':
                case 'MockTest E':
                case 'MockTest F':    
                case 'Competition':
                    $data = ['amount' => $amount, 'cin' => $cin, 'title' => $c[1]];
                    $res = $this->db->get_where('amount_cart', ['title' => $c[1], 'cin' => $cin])->row();
        
                    if (empty($res)) {
                        $this->db->insert('amount_cart', $data);
                        $message=$c[1].' Added to cart';
                    }else{
                        $message=$c[1].' Already in Cart.';
                    }
        
                    break;
            }
        echo $message;
        return $message;
    }
    
    
    public function cart_remove___pri($id = '') 
    {
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
            
            $amount = $c[0];
            $comp_id = $sch_id = $exam_id = $c[2];
            
            // print_R($c);die;
            
            
                $this->db->where('cin', $cin);
                $this->db->where('title', 'Competition');
                $this->db->where('product_name', $c[1]);
                $this->db->delete('amount_cart');
                
                
                $message = $c[1].' is Deleted.';
               
                
                
                
                $this->db->where('comp_id',$comp_id);
            	$this->db->where('title', 'Competition');
            	$this->db->where('cin', $cin);
            	$this->db->where('product_name', $c[1]);
            	$this->db->delete('makers_splits');
            
            
        echo $message;    
        return $message;
    }
    
    
    public function cart_remove___($id = '') 
    {
            $cin = $this->session->userdata('cin');
            $clevel = $this->session->userdata('clevel');
            $product = $this->session->userdata('product');
            $this->load->model('newmodel');
            $student = $this->newmodel->get_student_data($cin);
            $state = $student[0]['state_id'];
            $res = $this->db->get_where('competition_product_state', ['state_id' => $state, 'product_name' => $product, 'clevel' => $clevel])->row();
        
            $amount = $this->input->post('id');
            $c = explode("+", $amount);
            
            // echo $_SESSION['exam_id'];
            // print_r($c);die;
            
            if($c[1]=='Material A'){
                
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    // echo $this->db->last_query();die;
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation A');
                    $this->db->where('ini', '');
                    $message='Material A and Orientation A is Deleted.';
                    $this->db->delete('amount_cart');
                    
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material A');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation A');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
            }
            elseif($c[1]=='Material B'){
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation B');
                    $this->db->where('ini', '');
                    $message='Material B and Orientation B is Deleted.';
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material B');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation B');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
            }
            elseif($c[1]=='Material C'){
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation C');
                    $this->db->where('ini', '');
                    $message='Material C and Orientation C is Deleted.';
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material C');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation C');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
            }
            elseif($c[1]=='Material D'){
                
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    // echo $this->db->last_query();die;
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation D');
                    $this->db->where('ini', '');
                    $message='Material D and Orientation D is Deleted.';
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material D');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation D');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
            }
            elseif($c[1]=='Material E'){
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation E');
                    $this->db->where('ini', '');
                    $message='Material E and Orientation E is Deleted.';
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material E');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation E');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
            }
            elseif($c[1]=='Material F'){
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', $c[1]);
                    $this->db->where('ini', '');
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                    $this->db->where('cin', $cin);
                    $this->db->where('title', 'Orientation F');
                    $this->db->where('ini', '');
                    $message='Material F and Orientation F is Deleted.';
                    $this->db->delete('amount_cart');
                    
                    $this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Material F');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
                	
                	$this->db->where('comp_id',$_SESSION['exam_id']);
                	$this->db->where('title', 'Orientation F');
                	$this->db->where('cin', $cin);
                	$this->db->delete('makers_splits');
            }
            
            elseif($c[1]=='Learning Material A Training A' || $c[1]=='Learning Material B Training B' || $c[1]=='Learning Material C Training C'){
                
                $this->db->where('comp_id', $_SESSION['exam_id']);
                $this->db->where('cin', $cin);
                $this->db->where('title', $c[1]);
                $this->db->where('ini', '');
                $this->db->delete('amount_cart');
                
                $this->db->where('comp_id', $_SESSION['exam_id']);
                $this->db->where('title', $c[1]);
                $this->db->where('cin', $cin);
                $this->db->delete('makers_splits');
                
                $message = $c[1].' is Deleted.';
            }
            
            else{
                
                $this->db->where('cin', $cin);
            
                    switch ($c[1]) {
                        case 'Combo-1':
                        case 'Combo-2':
                        case 'Combo-3':
                        case 'Combo-4':
                            $this->db->where('ini', $c[1]);
                            $message=$c[1].' Deleted';
                            break;
                        default:
                            $this->db->where('title', $c[1]);
                            $this->db->where('ini', '');
                            $message=$c[1].' is Deleted.';
                            break;
                            
                    }
                $this->db->delete('amount_cart');
                
                
                $this->db->where('comp_id',$_SESSION['exam_id']);
            	$this->db->where('title', $c[1]);
            	$this->db->where('cin', $cin);
            	$this->db->delete('makers_splits');
            }
            
        echo $message;    
        return $message;
    }
    
// ========= test end ========== //
	   
	public function new_statewise($id='')
	{
        $amount = $this->input->post('id');
		$material = $this->input->post('material'); 
		$level = $this->input->post('level'); 
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin,'material_name' =>$material,'clevel' =>$level);
        $res = $this->db->get_where('statewise_addtocart',array('amount' =>$amount,'cin' =>$cin))->row();
        if($amount != $res->amount){
         $query = $this->db->insert('statewise_addtocart',$data);  
        }
        
       return $data;
        
       }
       
       
    public function remove_misb($id='')
    {
        $cin  = $this->session->userdata('cin');
        $amount = $this->input->post('id');
        //echo $amount;die;
        $c=explode("+",$amount);
        //print_R($c);die;
        // if($c[1]=='Combo_1' or $c[1]=='Combo_2' or $c[1]=='Combo_3' or $c[1]=='Combo_3'){
        //     echo $c[1];die;
        // }else{
            //echo $c[1];die;
            $data = array('amount' => $c[0],'cin' =>$cin,'title'=>$c[1]);
            //print_R($data);die;
            $res = $this->db->get_where('amount_cart',array('amount' =>$c[0],'cin' =>$cin,'title'=>$c[1]))->row();
                if($amount != $res->amount){
                    $query = $this->db->delete('amount_cart',$data);
                }
        // }
       }
	   
	   
	public function remove_misb_state($id='')
	{
        $amount = $this->input->post('id');
		
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin);
        $res = $this->db->get_where('statewise_addtocart',array('amount' =>$amount,'cin' =>$cin))->row();
		//print_r($res);exit;  
        if(!empty($res->amount)){
          
         $query = $this->db->delete('statewise_addtocart',$data);
        }
        
       return $data;
        
    }
       
       
    public function close()
    {
        $this->load->view('cin_login/registration_close');
    }   
    
    
    public function play_learn()
    {
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
        
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	    //print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);
	    // print_r( $data['result']);exit;
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'22IN350',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'350'
                    );
        
            $data['study_material_new']=array('price_code'=>'22INT250',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'250'
                    );
            $data['orientation_new']=array('price_code'=>'22IN950',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'959'
                    );
            $data['mock_test_new']= array('price_code'=>'22IN200',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'200'
	    );
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	    if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'22INT350',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'350'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2='';
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'22IN250',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'250'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'22NT950',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'950'
                                );
                                $d3='d3';
                	        }
                	       // ==== mock test ==== //
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT200',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'200'
                                );
                	            $d4='d4';
                	        }
                	        
                	        
                	        // =====  end  ===== //
                	        
                	        
                	       // echo 'okk'.'-'.$d4;die;
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       //   echo 'okk';die;
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         // echo 'ok';die;
                        	     }
                        	     
	    }	
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $clevel;die;
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,'Free',$product,$clevel,$period); 
	    //print_r($data['material_free']);exit;
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period,'Paid');
	    // print_r($data['material_free']);exit;  
	    
	    
	    
	   // ------------------------------------ //
	   
	    $data['orientation1']=$student=$this->newmodel->check($cin,$period,'orientation',$clevel);
	    $data['rivision']=$student=$this->newmodel->check($cin,$period,'revision',$clevel);
	    $data['mock_test']=$student=$this->newmodel->check($cin,$period,'mock_test',$clevel);
	    $data['study_material']=$student=$this->newmodel->check($cin,$period,'study_material',$clevel);
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    $data['activate']=$this->newmodel->activate($product);
	    
	    
	    
	    // ------------------------------------- //
         $this->load->view('cin_login/play_learn',$data);
         
    }  
       
       
    public function register()
    {    
        $data['open_modal']=0;
        
        if($_SESSION['exam_id']){
            $this->db->select('*');
            $this->db->from('competition_dates');   
            $this->db->where('comp_id',$_SESSION['exam_id']);
            $query = $this->db->get();
            $data['centers']= $query->result();
            
            if(!empty($data['centers'])){
                $_SESSION['in']=1;
            }else{
                $_SESSION['in']=0;
            }
        }
        
        
        
        $this->load->model('newmodel');
    //   print_r($_SESSION);
    
        $data['cin']=$cin=$this->session->userdata('cin');
        
	    $student=$data['student']=$this->newmodel->get_student_data_cin_($cin);
	    $data['result']=$this->newmodel->get_student_result_($cin);
	    
	   // print_r($data['result']['clevel']);
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result']['clevel']);
	    //print_r($data['cart']);
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$data['result']['medal_no']+1,'product_name' =>$data['result']['product_name']))->row();
	   //  print_r($res);
	     
		$nlev=$res->level_id;
		//echo $nlev;
	    $data['clevel']=$res->level_id;
	    
        // $data['activate']=$this->newmodel->activate_state($data['result']['product_name'],$nlev,$student['state_id']);
        
        $this->db->select('*');
        $this->db->from('competition_product_state');   
        $this->db->where('id',$_SESSION['exam_id']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['activate']= $query->result_array();  
        
        // print_r($data['activate']);die;
        // foreach($data['activate'] as $reo){
        //     echo $reo['id'];      
        // }
        
        if($data['activate'][0]['id'] > 137){
            foreach($data['activate'] as $reo){
               
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
                $this->db->where('comp_id',$reo['id']);
                $this->db->where('cin',$cin); 
                $this->db->where('competition_product_state.status','Live');
                $query=$this->db->get();
                $res=$query->result();
                if(!empty($res)){
                    $data['activate'][0]=$res;
                }
            }
        }else{
            $data['activate'][0]=$data['activate'][0];
        }
        
        $ar=array();
        foreach($data['activate'] as $roe){
            array_push($ar,$roe['id']);
        }
        // print_r($ar);
        
        
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        
        if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) > 1 && empty($res->comp_date)) {
            $data['open_modal'] = 1;
            $data['new_id']=$res->id;
        }

        
        // print_r($res);
        // echo $this->db->last_query();
        $data['material_paid_a']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
       //echo $this->db->last_query();die;
        $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        //print_r($data['material_paid_b']);
        $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        $data['material_free_a']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // echo $this->db->last_query();
        
        $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        //print_r($material_free_a);
        
        $a=array();
		if(empty($res)){
		    $data['competition']='Yes';
		}else{
		    $data['competition']='No';
		}
		
		$data['mock_av']= $this->db->get_where('mock_papers',array('clevel' =>$data['clevel'],'product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
// 		echo $this->db->last_query();die;
		
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';
		    array_push($a,"Material-A");
		}
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
            
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
              
            
            
            
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
           
           
           
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        $data['comps'] = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->result();
        
        $compt_id=$res1->id;
        // echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$compt_id))->result_array();
        //print_R($res2);
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
        
             $ro1=$res1->combo_1;$ro2=$res1->combo_2;$ro3=$res1->combo_3;$ro4=$res1->combo_4;
             
             
             $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
             $ro1=explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
             foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
             }       
                foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
             }
             foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
             }
             foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
             }
            
            
            
            if(isset($_POST['invoice'])){
                //print_r($_POST);die;
                // $link='cin_login/invoice_current/'.$_POST['invoice'];
                
                $link='cin_login/api_callinvoice/'.$_POST['invoice'];
	            redirect($link, 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$data['clevel']);
        //$this->session->set_userdata('period',$data['clevel']);
        
        $this->load->view('cin_login/register',$data);
    }   

    
    public function enroll1()
    {    
        $this->load->model('newmodel');
        $uri_exam_id = $this->uri->segment(3);
        $uri_cin     = $this->uri->segment(4);

        // ✅ Step 2: Apply priority (URI > SESSION)
        $data['comp_id'] = $exam_id = $comp_id = !empty($uri_exam_id) ? $uri_exam_id : $this->session->userdata('exam_id');
        $data['cin'] = $cin = !empty($uri_cin)  ? $uri_cin  : $this->session->userdata('cin');
        // print_r($_SESSION);
        $this->session->set_userdata('cinm',$cin);
        
        $this->session->set_userdata('exam_idm',$exam_id);
            
        // echo $this->session->userdata('exam_idm');
        // echo $this->session->userdata('cinm');    

        // die;
        
        $this->db->select('competition_product_state.id as comp_id,competition_product_state.pemplate,competition_product_state.status,competition_product_state.id,competition_product_state.close_date,competition_product_state.study_material_a,competition_product_state.study_material_b,competition_product_state.study_material_c,competition_product_state.study_material_d,
            competition_product_state.study_material_e,competition_product_state.study_material_f,competition_product_state.orientation_a,competition_product_state.orientation_b,competition_product_state.orientation_c,competition_product_state.orientation_d,competition_product_state.orientation_e,competition_product_state.orientation_f,
            competition_product_state.mock_test_a,competition_product_state.mock_test_b,competition_product_state.mock_test_c,competition_product_state.mock_test_d,competition_product_state.mock_test_e,competition_product_state.mock_test_f,
            competition_product_state.franchise_split,competition_product_state.aviansys_split,competition_product_state.franchise_gst,competition_product_state.aviansys_gst,competition_product_state.associate_gst,
            revenue_setting.*');
        
        $this->db->from('competition_product_state');   
        $this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id');
        $this->db->where_in('competition_product_state.id',['512','515','516','517']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['activate'] = $query->result_array(); 
        // print_r( $data['activate']);die;
        $data['product_name'] = $product_name = $data['activate'][0]['product_name'];
        // print_r(  $data['product_name']);die;
        $data['clevel'] = $clevel = $data['activate'][0]['clevel'];
        $data['period_id'] = $period_id = $data['activate'][0]['period_id'];
        
        // $data['open_modal']=0;
        // $comp_id = $_SESSION['exam_id'];
        
        // if($_SESSION['exam_id']){
            
            $this->db->select('*');
            $this->db->from('exam_centers');   
            $this->db->where('comp_id',$comp_id);
            $query = $this->db->get();
            $data['centers'] = $query->result();
            
            // echo $this->db->last_query();
            
            if(!empty($data['centers'])){
                $_SESSION['in'] = 1;
            }else{
                $_SESSION['in'] = 0;
            }
        // }
        
        
	    $student = $data['student'] = $this->newmodel->get_student_data_cin_($cin);
	    $data['result'] = $this->newmodel->get_student_result_n($cin,$product_name,$data['activate'][0]['clevel']);
	    
	   // print_r($data['result']);
	    
	    $data['cart'] = $this->newmodel->get_student_cart($cin,$clevel);
	    //print_r($data['cart']);
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' => 4,'product_name' =>$product_name))->row();
	   //  print_r($res);
	     
		$nlev = $res->level_id;
	    $data['clevel'] = $res->level_id;
	  
        
        
        if($data['activate'][0]['id'] > 137){
            foreach($data['activate'] as $reo){
               
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
                $this->db->where('comp_id',$reo['id']);
                $this->db->where('cin',$cin); 
                $this->db->where('competition_product_state.status','Live');
                $query=$this->db->get();
                $res=$query->result();
                if(!empty($res)){
                    $data['activate'][0]=$res;
                }
            }
        }else{
            $data['activate'][0]=$data['activate'][0];
        }
        
        // print_r($data['activate']);
        
        
        $ar=array();
        foreach($data['activate'] as $roe){
            array_push($ar,$roe['id']);
        }
        
        // print_r($ar);
        // die;
        // if($data['result']['product_name'] == 'Lunar Skill Test'){
        //     $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel']-1,'status'=>'Paid','cin'=>$cin))->row();
        // }else{
            // $res = $this->db->get_where('new_cart',array('clevel' =>$clevel,'status'=>'Paid','cin'=>$cin))->row();
        // }
        // echo $this->db->last_query();
        
        
        if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) > 1 && empty($res->comp_date)) {
            $data['open_modal'] = 1;
            $data['new_id'] = $res->id;
        }
        // echo $this->db->last_query();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                if($data['result']['product_name'] == 'Lunar Skill Test'){
                    $this->db->where('study_material.clevel',$clevel - 1);
                    $this->db->where('study_material.subject',$student['subject']); 
                    $this->db->where('study_material.sub_type',$student['type']);
                    $this->db->where('study_material.series',$student['series']);
                }
                else{
                    $this->db->where('study_material.clevel',$clevel);
                }
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                
                $query = $this->db->get();
                $resa = $query->row();
                
        // echo $this->db->last_query();
        
        $data['material_paid_a'] = $resa;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resb = $query->row();
        
        $data['material_paid_b'] = $resb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resc = $query->row();
        
        $data['material_paid_c']= $resc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resd = $query->row();
        
        $data['material_paid_d']= $resd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $rese = $query->row();
        
        $data['material_paid_e']= $rese;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $resf=$query->row();
        
        $data['material_paid_f']= $resf;
        
        
    //     $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
    //     $data['material_paid_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //   //echo $this->db->last_query();die;
    //     $data['material_paid_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfa=$query->row();
                
        // echo $this->db->last_query();
        
        $data['material_free_a']= $matfa;
        
        // print_r($data['material_free_a']);
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                
                $query = $this->db->get();
                $matfb = $query->row();
                
        $data['material_free_b']= $matfb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfc=$query->row();
        $data['material_free_c']= $matfc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfd=$query->row();
                
        $data['material_free_d']= $matfd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfe=$query->row();
        $data['material_free_e']= $matfe;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matff=$query->row();
        $data['material_free_f']= $matff;
            
        // $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        
        
        //print_r($material_free_a);
        
        $a=array();
        
        // $res = $this->db->get_where('new_cart',array('clevel' =>13,'status'=>'Paid','cin'=>$cin))->result();
        
        $this->db->where([
            'clevel' => 13,
            'status' => 'Paid',
            'cin'    => $cin
        ]);
        
        $this->db->like('product_name', 'Primary');
        
        $paiditems = $this->db->get('new_cart')->result();
        
        $data['competition'] = (count($paiditems) < 4) ? 'Yes' : 'No';
        		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_mock.period_id',$period_id);
                }
                
                
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av']= $mata;
		
// 		echo $this->db->last_query();
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv']= $matf;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av_free']= $mata;
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv_free']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv_free']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv_free']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev_free']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv_free']= $matf;
        
		$this->db->where('product_name', $product_name);
		$this->db->where('clevel', $clevel);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('study_material', 'Yes');
        $this->db->or_where('study_material_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row(); 
        
// 		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_a'=>'Yes','cin'=>$cin))->row();
// 		echo $this->db->last_query();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';array_push($a,"Material-A");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_d'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_d']='Yes';}else{$data['study_material_d']='No';array_push($a,"Material-D");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_e']='Yes';}else{$data['study_material_e']='No';array_push($a,"Material-E");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_f']='Yes';}else{$data['study_material_f']='No';array_push($a,"Material-F");}
                  
            
        $this->db->where('product_name', $product_name);
        $this->db->where('clevel', $clevel);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('orientation', 'Yes');
        $this->db->or_where('orientation_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();    
            
            
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_d']='Yes';}else{$data['orientation_d']='No';array_push($a,"Orientation-D");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_e']='Yes';}else{$data['orientation_e']='No';array_push($a,"Orientation-E");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_f']='Yes';}else{$data['orientation_f']='No';array_push($a,"Orientation-F");}
              
           
           
        $this->db->where('product_name', $product_name);
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('mock_test', 'Yes');
        $this->db->or_where('mock_test_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();
   
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_a']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
        
        // echo $this->db->last_query();

		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_b']='Yes';}else{$data['mock_test_b']='No';array_push($a,"MockTest B");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_c']='Yes';}else{$data['mock_test_c']='No';array_push($a,"MockTest C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_d']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest D");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_e']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest E");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_f']='Yes';}else{$data['mock_test_f']='No';array_push($a,"MockTest F");}
		
		
		
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('product_name' =>$product_name,'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        $data['comps'] = $this->db->get_where('competition_product_state',array('product_name' =>$product_name,'clevel'=>$clevel))->result();
        
        $compt_id=$res1->id;
        // echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$comp_id))->result_array();
        //print_R($res2);
        
        if(!empty($res2)){  $data['admit_card_av']  = 'yes';   $data['admit_id']   =  $compt_id;}
        
            $ro1 = $res1->combo_1; $ro2 = $res1->combo_2; $ro3 = $res1->combo_3; $ro4 = $res1->combo_4;
             
             
            $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
            $ro1 = explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
            foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
            }       
            
            foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
            }
            
            foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
            }
            
            foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
            }
            
            
            
            if(isset($_POST['invoice'])){
                //print_r($_POST);die;
                // $link='cin_login/invoice_current/'.$_POST['invoice'];
                
                $link='cin_login/api_callinvoice/'.$_POST['invoice'];
	            redirect($link, 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$product_name);
        $this->session->set_userdata('clevel',$clevel);
        //$this->session->set_userdata('period',$data['clevel']);
        
        
        $this->load->view('cin_login/register',$data);
    }
  
    public function enroll2()
    {    
        $this->load->model('newmodel');
        $uri_exam_id = $this->uri->segment(3);
        $uri_cin     = $this->uri->segment(4);

        // ✅ Step 2: Apply priority (URI > SESSION)
        $data['comp_id'] = $exam_id = $comp_id = !empty($uri_exam_id) ? $uri_exam_id : $this->session->userdata('exam_id');
        $data['cin'] = $cin = !empty($uri_cin)  ? $uri_cin  : $this->session->userdata('cin');
        // print_r($_SESSION);
        $this->session->set_userdata('cinm',$cin);
        
        $this->session->set_userdata('exam_idm',$exam_id);
            
        // echo $this->session->userdata('exam_idm');
        // echo $this->session->userdata('cinm');    

        // die;
        
        $this->db->select('competition_product_state.id as comp_id,competition_product_state.pemplate,competition_product_state.status,competition_product_state.id,competition_product_state.close_date,competition_product_state.study_material_a,competition_product_state.study_material_b,competition_product_state.study_material_c,competition_product_state.study_material_d,
            competition_product_state.study_material_e,competition_product_state.study_material_f,competition_product_state.orientation_a,competition_product_state.orientation_b,competition_product_state.orientation_c,competition_product_state.orientation_d,competition_product_state.orientation_e,competition_product_state.orientation_f,
            competition_product_state.mock_test_a,competition_product_state.mock_test_b,competition_product_state.mock_test_c,competition_product_state.mock_test_d,competition_product_state.mock_test_e,competition_product_state.mock_test_f,
            competition_product_state.franchise_split,competition_product_state.aviansys_split,competition_product_state.franchise_gst,competition_product_state.aviansys_gst,competition_product_state.associate_gst,
            revenue_setting.*');
        
        $this->db->from('competition_product_state');   
        $this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id');
        $this->db->where_in('competition_product_state.id',['512','515','516','517']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['activate'] = $query->result_array(); 
        // print_r( $data['activate']);die;
        $data['product_name'] = $product_name = $data['activate'][0]['product_name'];
        // print_r(  $data['product_name']);die;
        $data['clevel'] = $clevel = $data['activate'][0]['clevel'];
        $data['period_id'] = $period_id = $data['activate'][0]['period_id'];
        
        // $data['open_modal']=0;
        // $comp_id = $_SESSION['exam_id'];
        
        // if($_SESSION['exam_id']){
            
            $this->db->select('*');
            $this->db->from('exam_centers');   
            $this->db->where('comp_id',$comp_id);
            $query = $this->db->get();
            $data['centers'] = $query->result();
            
            // echo $this->db->last_query();
            
            if(!empty($data['centers'])){
                $_SESSION['in'] = 1;
            }else{
                $_SESSION['in'] = 0;
            }
        // }
        
        
	    $student = $data['student'] = $this->newmodel->get_student_data_cin_($cin);
	    $data['result'] = $this->newmodel->get_student_result_n($cin,$product_name,$data['activate'][0]['clevel']);
	    
	   // print_r($data['result']);
	    
	    $data['cart'] = $this->newmodel->get_student_cart($cin,$clevel);
	    //print_r($data['cart']);
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' => 4,'product_name' =>$product_name))->row();
	   //  print_r($res);
	     
		$nlev = $res->level_id;
	    $data['clevel'] = $res->level_id;
	  
        
        
        if($data['activate'][0]['id'] > 137){
            foreach($data['activate'] as $reo){
               
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
                $this->db->where('comp_id',$reo['id']);
                $this->db->where('cin',$cin); 
                $this->db->where('competition_product_state.status','Live');
                $query=$this->db->get();
                $res=$query->result();
                if(!empty($res)){
                    $data['activate'][0]=$res;
                }
            }
        }else{
            $data['activate'][0]=$data['activate'][0];
        }
        
        // print_r($data['activate']);
        
        
        $ar=array();
        foreach($data['activate'] as $roe){
            array_push($ar,$roe['id']);
        }
        
        // print_r($ar);
        // die;
        // if($data['result']['product_name'] == 'Lunar Skill Test'){
        //     $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel']-1,'status'=>'Paid','cin'=>$cin))->row();
        // }else{
            // $res = $this->db->get_where('new_cart',array('clevel' =>$clevel,'status'=>'Paid','cin'=>$cin))->row();
        // }
        // echo $this->db->last_query();
        
        
        if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) > 1 && empty($res->comp_date)) {
            $data['open_modal'] = 1;
            $data['new_id'] = $res->id;
        }
        // echo $this->db->last_query();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                if($data['result']['product_name'] == 'Lunar Skill Test'){
                    $this->db->where('study_material.clevel',$clevel - 1);
                    $this->db->where('study_material.subject',$student['subject']); 
                    $this->db->where('study_material.sub_type',$student['type']);
                    $this->db->where('study_material.series',$student['series']);
                }
                else{
                    $this->db->where('study_material.clevel',$clevel);
                }
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                
                $query = $this->db->get();
                $resa = $query->row();
                
        // echo $this->db->last_query();
        
        $data['material_paid_a'] = $resa;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resb = $query->row();
        
        $data['material_paid_b'] = $resb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resc = $query->row();
        
        $data['material_paid_c']= $resc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $resd = $query->row();
        
        $data['material_paid_d']= $resd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query = $this->db->get();
                $rese = $query->row();
        
        $data['material_paid_e']= $rese;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $resf=$query->row();
        
        $data['material_paid_f']= $resf;
        
        
    //     $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
    //     $data['material_paid_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //   //echo $this->db->last_query();die;
    //     $data['material_paid_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfa=$query->row();
                
        // echo $this->db->last_query();
        
        $data['material_free_a']= $matfa;
        
        // print_r($data['material_free_a']);
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                
                $query = $this->db->get();
                $matfb = $query->row();
                
        $data['material_free_b']= $matfb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfc=$query->row();
        $data['material_free_c']= $matfc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfd=$query->row();
                
        $data['material_free_d']= $matfd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$clevel);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matfe=$query->row();
        $data['material_free_e']= $matfe;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$product_name);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_materials.period_id',$period_id);
                }
                $query=$this->db->get();
                $matff=$query->row();
        $data['material_free_f']= $matff;
            
        // $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        
        
        //print_r($material_free_a);
        
        $a=array();
        
        // $res = $this->db->get_where('new_cart',array('clevel' =>13,'status'=>'Paid','cin'=>$cin))->result();
        
        $this->db->where([
            'clevel' => 13,
            'status' => 'Paid',
            'cin'    => $cin
        ]);
        
        $this->db->like('product_name', 'Primary');
        
        $paiditems = $this->db->get('new_cart')->result();
        
        $data['competition'] = (count($paiditems) < 4) ? 'Yes' : 'No';
        		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($comp_id,$a)){
                    $this->db->where('assigned_mock.period_id',$period_id);
                }
                
                
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av']= $mata;
		
// 		echo $this->db->last_query();
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv']= $matf;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av_free']= $mata;
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv_free']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv_free']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv_free']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev_free']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$clevel);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$product_name);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$period_id);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv_free']= $matf;
        
		$this->db->where('product_name', $product_name);
		$this->db->where('clevel', $clevel);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('study_material', 'Yes');
        $this->db->or_where('study_material_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row(); 
        
// 		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_a'=>'Yes','cin'=>$cin))->row();
// 		echo $this->db->last_query();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';array_push($a,"Material-A");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_d'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_d']='Yes';}else{$data['study_material_d']='No';array_push($a,"Material-D");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_e']='Yes';}else{$data['study_material_e']='No';array_push($a,"Material-E");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_f']='Yes';}else{$data['study_material_f']='No';array_push($a,"Material-F");}
                  
            
        $this->db->where('product_name', $product_name);
        $this->db->where('clevel', $clevel);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('orientation', 'Yes');
        $this->db->or_where('orientation_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();    
            
            
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_d']='Yes';}else{$data['orientation_d']='No';array_push($a,"Orientation-D");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_e']='Yes';}else{$data['orientation_e']='No';array_push($a,"Orientation-E");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_f']='Yes';}else{$data['orientation_f']='No';array_push($a,"Orientation-F");}
              
           
           
        $this->db->where('product_name', $product_name);
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('mock_test', 'Yes');
        $this->db->or_where('mock_test_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();
   
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_a']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
        
        // echo $this->db->last_query();

		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_b']='Yes';}else{$data['mock_test_b']='No';array_push($a,"MockTest B");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_c']='Yes';}else{$data['mock_test_c']='No';array_push($a,"MockTest C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_d']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest D");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_e']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest E");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_f']='Yes';}else{$data['mock_test_f']='No';array_push($a,"MockTest F");}
		
		
		
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('product_name' =>$product_name,'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        $data['comps'] = $this->db->get_where('competition_product_state',array('product_name' =>$product_name,'clevel'=>$clevel))->result();
        
        $compt_id=$res1->id;
        // echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$comp_id))->result_array();
        //print_R($res2);
        
        if(!empty($res2)){  $data['admit_card_av']  = 'yes';   $data['admit_id']   =  $compt_id;}
        
            $ro1 = $res1->combo_1; $ro2 = $res1->combo_2; $ro3 = $res1->combo_3; $ro4 = $res1->combo_4;
             
             
            $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
            $ro1 = explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
            foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
            }       
            
            foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
            }
            
            foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
            }
            
            foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
            }
            
            
            
            if(isset($_POST['invoice'])){
                //print_r($_POST);die;
                // $link='cin_login/invoice_current/'.$_POST['invoice'];
                
                $link='cin_login/api_callinvoice/'.$_POST['invoice'];
	            redirect($link, 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$product_name);
        $this->session->set_userdata('clevel',$clevel);
        //$this->session->set_userdata('period',$data['clevel']);
        
        
        $this->load->view('cin_login/registration_cart',$data);
    }
    
    public function enroll()
    {    
      
        
        $data['open_modal']=0;
        $comp_id = $exam_id = $_SESSION['exam_id'];
        
        if($_SESSION['exam_id']){
            
            $this->db->select('*');
            $this->db->from('exam_centers');   
            $this->db->where('comp_id',$_SESSION['exam_id']);
            $query = $this->db->get();
            $data['centers']= $query->result();
            
            // echo $this->db->last_query();
            
            if(!empty($data['centers'])){
                $_SESSION['in']=1;
            }else{
                $_SESSION['in']=0;
            }
        }
        
        
        
        $this->load->model('newmodel');
    //   print_r($_SESSION);
    
        $data['cin']=$cin=$this->session->userdata('cin');
        
        $this->session->set_userdata('cinm',$cin);
        
        $this->session->set_userdata('exam_idm',$exam_id);
        // echo $exam_id;
        
	    $student = $data['student']=$this->newmodel->get_student_data_cin_($cin);
	    $data['result'] = $this->newmodel->get_student_result_($cin);
	    
	   // print_r($data['result']);
	    
	    $data['cart'] = $this->newmodel->get_student_cart($cin,$data['result']['clevel']);
	   // print_r($data['cart']);die;
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$data['result']['medal_no']+1,'product_name' =>$data['result']['product_name']))->row();
	   //  print_r($res);
	     
		$nlev=$res->level_id;
	    $data['clevel'] = $res->level_id;
	    
	   // if($data['result']['product_name'] == 'Lunar Skill Test'){
	   //     $nlev=$nlev-1;
	   //     $data['clevel'] = $data['clevel'] - 1;
	   // }
	    
	   // echo     $data['clevel'];
	    
        // $data['activate']=$this->newmodel->activate_state($data['result']['product_name'],$nlev,$student['state_id']);
        
        $this->db->select('competition_product_state.pemplate,competition_product_state.status,competition_product_state.id,competition_product_state.close_date,competition_product_state.study_material_a,competition_product_state.study_material_b,competition_product_state.study_material_c,competition_product_state.study_material_d,
            competition_product_state.study_material_e,competition_product_state.study_material_f,competition_product_state.orientation_a,competition_product_state.orientation_b,competition_product_state.orientation_c,competition_product_state.orientation_d,competition_product_state.orientation_e,competition_product_state.orientation_f,
            competition_product_state.mock_test_a,competition_product_state.mock_test_b,competition_product_state.mock_test_c,competition_product_state.mock_test_d,competition_product_state.mock_test_e,competition_product_state.mock_test_f,
            competition_product_state.franchise_split,competition_product_state.aviansys_split,competition_product_state.franchise_gst,competition_product_state.aviansys_gst,competition_product_state.associate_gst,competition_product_state.bundle_a,competition_product_state.bundle_b,competition_product_state.bundle_c,
            revenue_setting.*');
        
        $this->db->from('competition_product_state');   
        $this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id');
        $this->db->where('competition_product_state.id',$_SESSION['exam_id']);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['activate']= $query->result_array();  
        
     //print_r($_SESSION['exam_id']);die;
        
        // foreach($data['activate'] as $reo){
        //     echo $reo['id'];      
        // }
        
        
        if($data['activate'][0]['id'] > 137){
            foreach($data['activate'] as $reo){
               
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
                $this->db->where('comp_id',$reo['id']);
                $this->db->where('cin',$cin); 
                $this->db->where('competition_product_state.status','Live');
                $query=$this->db->get();
                $res=$query->result();
                if(!empty($res)){
                    $data['activate'][0]=$res;
                }
            }
        }else{
            $data['activate'][0]=$data['activate'][0];
        }
        
        // print_r($data['activate']);
        
        
        $ar=array();
        foreach($data['activate'] as $roe){
            array_push($ar,$roe['id']);
        }
        
        // print_r($ar);
        // die;
        // if($data['result']['product_name'] == 'Lunar Skill Test'){
        //     $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel']-1,'status'=>'Paid','cin'=>$cin))->row();
        // }else{
            // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        // }
        // echo $this->db->last_query();
        
        
        // if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) >= 1 && empty($res->comp_date)) {
        //     $data['open_modal'] = 1;
        //     $data['new_id'] = $res->id;
        // }
        // Change this line (remove the empty($res->comp_date) check):
        // if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) >= 1) {
        //     $data['open_modal'] = 1;
        //     $data['new_id'] = $res->id;
        // }
        // changes for comp. select modal
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        
        // Show modal if: paid, no competition date yet, and centers available
        if (!empty($res)) {
            $data['cart_entry'] = $res;
            
            if (empty($res->comp_date) && !empty($data['centers']) && count($data['centers']) > 0) {
                // Student paid but hasn't selected competition date yet
                $data['open_modal'] = 0;
                $data['new_id'] = $res->id;
            } else if (!empty($res->comp_date)) {
                // Student already registered
                $data['open_modal'] = 0;
                $data['registered'] = true;
            } else if (empty($data['centers'])) {
                // No competition centers available
                $data['open_modal'] = 0;
                $data['no_centers'] = true;
            }
        } else {
            // No paid entry found
            $data['open_modal'] = 0;
        }
        // echo $this->db->last_query();
        
            $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
            $resa = $query->row();
                
            // echo $this->db->last_query();
        
        $data['material_paid_a'] = $resa;
        // print_r($data['material_paid_a']);die;
       
       
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join(
                    'assigned_materials',
                    'assigned_materials.mat_id = study_material.id',
                    'inner'
                );
                
                $this->db->where('study_material.clevel', $data['clevel']);
                $this->db->where('study_material.status', 'Paid'); 
                $this->db->where('study_material.type', 'B');
                $this->db->where('study_material.product_name', $data['result']['product_name']);
                $this->db->where('study_material.class', $student['class']); // ✅ FIXED
                
                $a = ['511', '510', '509', '508'];
                
                if (!in_array($_SESSION['exam_id'], $a)) {
                    $this->db->where('assigned_materials.period_id', $student['period_id']);
                }
                
                $query = $this->db->get();
                $resb = $query->row();
        
        $data['material_paid_b'] = $resb;
        //print_r($data['material_paid_b']);die;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $resc = $query->row();
        
        $data['material_paid_c']= $resc;
        
        $data['bundle_a']= 'Yes';
        $data['bundle_b']= 'Yes';
        $data['bundle_c']= 'Yes';
        
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $resd = $query->row();
        
        $data['material_paid_d']= $resd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $rese = $query->row();
        
        $data['material_paid_e']= $rese;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $resf=$query->row();
        
        $data['material_paid_f']= $resf;
        
        
    //     $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
    //     $data['material_paid_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //   //echo $this->db->last_query();die;
    //     $data['material_paid_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
    //     //print_r($data['material_paid_b']);
    //     $data['material_paid_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfa=$query->row();
                
        // echo $this->db->last_query();
        
        $data['material_free_a']= $matfa;
        
        // print_r($data['material_free_a']);
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                
                $query = $this->db->get();
                $matfb = $query->row();
                
        $data['material_free_b']= $matfb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfc=$query->row();
        $data['material_free_c']= $matfc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfd=$query->row();
        $data['material_free_d']= $matfd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfe=$query->row();
        $data['material_free_e']= $matfe;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matff=$query->row();
        $data['material_free_f']= $matff;
            
        // $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        
        
        //print_r($material_free_a);
        
        $a=array();
		if(empty($res)){
		    $data['competition']='Yes';
		}else{
		    $data['competition']='No';
		}
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_mock.period_id',$student['period_id']);
                }
                
                
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av']= $mata;
		
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matb = $query->row();
				// echo $this->db->last_query();

        $data['mock_bv']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv']= $matf;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av_free']= $mata;
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv_free']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv_free']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv_free']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev_free']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv_free']= $matf;
        
		
		$this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('study_material', 'Yes');
        $this->db->or_where('study_material_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row(); 
        
// 		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_a'=>'Yes','cin'=>$cin))->row();
// 		echo $this->db->last_query();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';array_push($a,"Material-A");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_d'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_d']='Yes';}else{$data['study_material_d']='No';array_push($a,"Material-D");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_e']='Yes';}else{$data['study_material_e']='No';array_push($a,"Material-E");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_f']='Yes';}else{$data['study_material_f']='No';array_push($a,"Material-F");}
                  
            
            
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('orientation', 'Yes');
        $this->db->or_where('orientation_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();    
            
            
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_d']='Yes';}else{$data['orientation_d']='No';array_push($a,"Orientation-D");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_e']='Yes';}else{$data['orientation_e']='No';array_push($a,"Orientation-E");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_f']='Yes';}else{$data['orientation_f']='No';array_push($a,"Orientation-F");}
              
           
           
           
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('mock_test', 'Yes');
        $this->db->or_where('mock_test_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();
   
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_a']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
        
        // echo $this->db->last_query();

		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_b']='Yes';}else{$data['mock_test_b']='No';array_push($a,"MockTest B");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_c']='Yes';}else{$data['mock_test_c']='No';array_push($a,"MockTest C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_d']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest D");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_e']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest E");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_f']='Yes';}else{$data['mock_test_f']='No';array_push($a,"MockTest F");}
		
		
		
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        $data['comps'] = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->result();
        
        $compt_id=$res1->id;
        // echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$comp_id))->result_array();
        // print_R($res2);
        // echo $this->db->last_query();
        
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
        
             $ro1=$res1->combo_1;$ro2=$res1->combo_2;$ro3=$res1->combo_3;$ro4=$res1->combo_4;
             
             
             $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
             $ro1=explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
             foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
             }       
                foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
             }
             foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
             }
             foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
             }
            
            
            
            if(isset($_POST['invoice'])){
                //print_r($_POST);die;
                // $link='cin_login/invoice_current/'.$_POST['invoice'];
                
                $link='cin_login/api_callinvoice/'.$_POST['invoice'];
	            redirect($link, 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$data['clevel']);
        //$this->session->set_userdata('period',$data['clevel']);
        
        

        $this->load->view('cin_login/enroll',$data);
    }
    
    
    public function register_school_level()
    {    
        $this->load->model('newmodel');
        $cin = $this->session->userdata('cin');
        $this->session->set_userdata('cinm',$cin);
        
        
        $student = $data['student']=$this->newmodel->get_student_data_cin_($cin);
        
        
        $data['open_modal']=0;
        $comp_id = $exam_id = $student['competition_schedule_id'];
        $this->session->set_userdata('exam_idm',$exam_id);
        $this->session->set_userdata('exam_id',$exam_id);
        
        if($_SESSION['exam_id']){
            
            $this->db->select('*');
            $this->db->from('exam_centers');   
            $this->db->where('comp_id',$_SESSION['exam_id']);
            $query = $this->db->get();
            $data['centers']= $query->result();
            
            // echo $this->db->last_query();
            
            if(!empty($data['centers'])){
                $_SESSION['in']=1;
            }else{
                $_SESSION['in']=0;
            }
        }
        
        
        
       
        //   print_r($_SESSION);die;
    
        $data['cin']=$cin=$this->session->userdata('cin');
        
        
        
        
	    $data['result'] = $this->newmodel->get_student_result_($cin);
	    
	   // print_r($data['result']);die;
	    
	    $data['cart'] = $this->newmodel->get_student_cart($cin,$data['result']['clevel']);
	   // print_r($data['cart']);die;
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$data['result']['medal_no']+1,'product_name' =>$data['result']['product_name']))->row();
	   //  print_r($res);die;
	   
		$nlev=$res->level_id;
	    $data['clevel'] = $res->level_id;
	    
	   // if($data['result']['product_name'] == 'Lunar Skill Test'){
	   //     $nlev=$nlev-1;
	   //     $data['clevel'] = $data['clevel'] - 1;
	   // }
	    
	   // echo     $data['clevel'];
	    
        // $data['activate']=$this->newmodel->activate_state($data['result']['product_name'],$nlev,$student['state_id']);
        
        $this->db->select('competition_product_state.pemplate,competition_product_state.status,competition_product_state.id,competition_product_state.close_date,competition_product_state.study_material_a,competition_product_state.study_material_b,competition_product_state.study_material_c,competition_product_state.study_material_d,
            competition_product_state.study_material_e,competition_product_state.study_material_f,competition_product_state.orientation_a,competition_product_state.orientation_b,competition_product_state.orientation_c,competition_product_state.orientation_d,competition_product_state.orientation_e,competition_product_state.orientation_f,
            competition_product_state.mock_test_a,competition_product_state.mock_test_b,competition_product_state.mock_test_c,competition_product_state.mock_test_d,competition_product_state.mock_test_e,competition_product_state.mock_test_f,
            competition_product_state.franchise_split,competition_product_state.aviansys_split,competition_product_state.franchise_gst,competition_product_state.aviansys_gst,competition_product_state.associate_gst,competition_product_state.bundle_a,competition_product_state.bundle_b,competition_product_state.bundle_c,
            revenue_setting.*');
        
        $this->db->from('competition_product_state');   
        $this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id');
        $this->db->where('competition_product_state.id',$_SESSION['exam_id']);
        $query = $this->db->get();
        // echo $this->db->last_query();1
        $data['activate']= $query->result_array();  
        
        //print_r($_SESSION['exam_id']);die;
        
        // foreach($data['activate'] as $reo){
        //     echo $reo['id'];      
        // }
        
        
        if($data['activate'][0]['id'] > 137){
            foreach($data['activate'] as $reo){
               
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
                $this->db->where('comp_id',$reo['id']);
                $this->db->where('cin',$cin); 
                $this->db->where('competition_product_state.status','Live');
                $query=$this->db->get();
                $res=$query->result();
                if(!empty($res)){
                    $data['activate'][0]=$res;
                }
            }
        }else{
            $data['activate'][0]=$data['activate'][0];
        }
        
        // print_r($data['activate']);
        
        
        $ar=array();
        foreach($data['activate'] as $roe){
            array_push($ar,$roe['id']);
        }
        
        // print_r($ar);
        // die;
        // if($data['result']['product_name'] == 'Lunar Skill Test'){
        //     $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel']-1,'status'=>'Paid','cin'=>$cin))->row();
        // }else{
            // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        // }
        // echo $this->db->last_query();
        
        
        // if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) >= 1 && empty($res->comp_date)) {
        //     $data['open_modal'] = 1;
        //     $data['new_id'] = $res->id;
        // }
        // Change this line (remove the empty($res->comp_date) check):
        // if (!empty($res) && isset($data['centers']) && is_array($data['centers']) && count($data['centers']) >= 1) {
        //     $data['open_modal'] = 1;
        //     $data['new_id'] = $res->id;
        // }
        // changes for comp. select modal
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        
        // Show modal if: paid, no competition date yet, and centers available
        if (!empty($res)) {
            $data['cart_entry'] = $res;
            
            if (empty($res->comp_date) && !empty($data['centers']) && count($data['centers']) > 0) {
                // Student paid but hasn't selected competition date yet
                $data['open_modal'] = 0;
                $data['new_id'] = $res->id;
            } else if (!empty($res->comp_date)) {
                // Student already registered
                $data['open_modal'] = 0;
                $data['registered'] = true;
            } else if (empty($data['centers'])) {
                // No competition centers available
                $data['open_modal'] = 0;
                $data['no_centers'] = true;
            }
        } else {
            // No paid entry found
            $data['open_modal'] = 0;
        }
        // echo $this->db->last_query();
        
            $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
            $resa = $query->row();
                
        
        
        $data['material_paid_a'] = $resa;
       // print_r($data['material_paid_a']);die;
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join(
                    'assigned_materials',
                    'assigned_materials.mat_id = study_material.id',
                    'inner'
                );
                
                $this->db->where('study_material.clevel', $data['clevel']);
                $this->db->where('study_material.status', 'Paid'); 
                $this->db->where('study_material.type', 'B');
                $this->db->where('study_material.product_name', $data['result']['product_name']);
                $this->db->where('study_material.class', $student['class']); // ✅ FIXED
                
                $a = ['511', '510', '509', '508'];
                
                if (!in_array($_SESSION['exam_id'], $a)) {
                    $this->db->where('assigned_materials.period_id', $student['period_id']);
                }
                
                $query = $this->db->get();
                $resb = $query->row();
        
        $data['material_paid_b'] = $resb;
        //print_r($data['material_paid_b']);die;
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $resc = $query->row();
        
        $data['material_paid_c']= $resc;
        
        $data['bundle_a']= 'Yes';
        $data['bundle_b']= 'Yes';
        $data['bundle_c']= 'Yes';
        
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $resd = $query->row();
        
        $data['material_paid_d']= $resd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query = $this->db->get();
                $rese = $query->row();
        
        $data['material_paid_e']= $rese;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Paid'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $resf=$query->row();
        
        $data['material_paid_f']= $resf;
        
        
                //     $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
                //     //print_r($data['material_paid_b']);
                //     $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
                    
                //     $data['material_paid_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
                //   //echo $this->db->last_query();die;
                //     $data['material_paid_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
                //     //print_r($data['material_paid_b']);
                //     $data['material_paid_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','A');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfa=$query->row();
                
        // echo $this->db->last_query();
        
        $data['material_free_a']= $matfa;
        
        // print_r($data['material_free_a']);
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','B');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                
                
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                
                $query = $this->db->get();
                $matfb = $query->row();
                
        $data['material_free_b']= $matfb;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','C');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfc=$query->row();
        $data['material_free_c']= $matfc;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','D');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfd=$query->row();
        $data['material_free_d']= $matfd;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','E');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matfe=$query->row();
        $data['material_free_e']= $matfe;
        
                $this->db->select('study_material.*');
                $this->db->from('study_material');
                $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
                $this->db->where('study_material.clevel',$data['clevel']);
                $this->db->where('study_material.status','Free'); 
                $this->db->where('study_material.type','F');
                $this->db->where('study_material.product_name',$data['result']['product_name']);
                $this->db->where('class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_materials.period_id',$student['period_id']);
                }
                $query=$this->db->get();
                $matff=$query->row();
        $data['material_free_f']= $matff;
            
        // $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_d']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'D','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_e']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'E','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        // $data['material_free_f']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'F','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        
        
        //print_r($material_free_a);
        
        $a=array();
		if(empty($res)){
		    $data['competition']='Yes';
		}else{
		    $data['competition']='No';
		}
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $a = [
                    '511',
                    '510',
                    '509',
                    '508'
                ];
                
                if(!in_array($_SESSION['exam_id'],$a)){
                    $this->db->where('assigned_mock.period_id',$student['period_id']);
                }
                
                
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av']= $mata;
		
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matb = $query->row();
				// echo $this->db->last_query();

        $data['mock_bv']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Paid'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv']= $matf;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','A');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mata = $query->row();
        	
		$data['mock_av_free']= $mata;
		
		        $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','B');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matb = $query->row();
		
        $data['mock_bv_free']= $matb;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','C');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matc = $query->row();
		
        $data['mock_cv_free']= $matc;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','D');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matd = $query->row();
		
        $data['mock_dv_free']= $matd;
                
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','E');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $mate = $query->row();
		
        $data['mock_ev_free']= $mate;
        
                $this->db->select('mock_papers.paper_id,assigned_mock.period_id');
                $this->db->from('mock_papers');
                $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
                $this->db->where('mock_papers.clevel',$data['clevel']);
                $this->db->where('mock_papers.pay_status','Free'); 
                $this->db->where('mock_papers.type','F');
                $this->db->where('mock_papers.product_name',$data['result']['product_name']);
                $this->db->where('mock_papers.class',$student['class']);
                $this->db->where('assigned_mock.period_id',$student['period_id']);
                $query=$this->db->get();
                $matf = $query->row();
		
        $data['mock_fv_free']= $matf;
        
		
		$this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('study_material', 'Yes');
        $this->db->or_where('study_material_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row(); 
        
// 		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_a'=>'Yes','cin'=>$cin))->row();
// 		echo $this->db->last_query();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';array_push($a,"Material-A");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_d'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_d']='Yes';}else{$data['study_material_d']='No';array_push($a,"Material-D");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_e']='Yes';}else{$data['study_material_e']='No';array_push($a,"Material-E");}
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_f']='Yes';}else{$data['study_material_f']='No';array_push($a,"Material-F");}
                  
            
            
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('orientation', 'Yes');
        $this->db->or_where('orientation_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();    
            
            
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_d']='Yes';}else{$data['orientation_d']='No';array_push($a,"Orientation-D");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_e']='Yes';}else{$data['orientation_e']='No';array_push($a,"Orientation-E");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_f']='Yes';}else{$data['orientation_f']='No';array_push($a,"Orientation-F");}
              
           
           
           
        $this->db->where('clevel', $data['clevel']);
        $this->db->where('cin', $cin);
        $this->db->group_start();
        $this->db->where('mock_test', 'Yes');
        $this->db->or_where('mock_test_a', 'Yes');
        $this->db->group_end();
        
        $res = $this->db->get('new_cart')->row();
   
        // $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_a']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
        
        // echo $this->db->last_query();

		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_b']='Yes';}else{$data['mock_test_b']='No';array_push($a,"MockTest B");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_c']='Yes';}else{$data['mock_test_c']='No';array_push($a,"MockTest C");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_d'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_d']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest D");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_e'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_e']='Yes';}else{$data['mock_test_e']='No';array_push($a,"MockTest E");}
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test_f'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test_f']='Yes';}else{$data['mock_test_f']='No';array_push($a,"MockTest F");}
		
		
		
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        $data['comps'] = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->result();
        
        $compt_id=$res1->id;
        // echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$comp_id))->result_array();
        //print_R($res2);
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
        
             $ro1=$res1->combo_1;$ro2=$res1->combo_2;$ro3=$res1->combo_3;$ro4=$res1->combo_4;
             
             
             $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
             $ro1=explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
             foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
             }       
                foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
             }
             foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
             }
             foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
             }
            
            
            
            if(isset($_POST['invoice'])){
                //print_r($_POST);die;
                // $link='cin_login/invoice_current/'.$_POST['invoice'];
                
                $link='cin_login/api_callinvoice/'.$_POST['invoice'];
	            redirect($link, 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$data['clevel']);
        //$this->session->set_userdata('period',$data['clevel']);
        
        

        $this->load->view('cin_login/register_school_level',$data);
    }
    
    
    public function save_selected_close_date() 
    {
        $close_date = $this->input->post('exam_date');
        $new_id = $this->input->post('new_id');
    
        // print_r($_POST);die;
        
        
        if ($close_date && $new_id) {
            $this->db->where('id', $new_id);
            $this->db->update('new_cart', ['comp_date' => $close_date]);
        }
    
        echo json_encode(['status' => 'success']);
    }

//  ========================= register copy for update  =============  //
    public function register_work()
    {
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
        
	    $student=$data['student']=$this->newmodel->get_student_data_cin_($cin);
	    $data['result']=$this->newmodel->get_student_result_($cin);
	    
	   // print_r($data['result']['clevel']);
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result']['clevel']);
	    //print_r($data['cart']);
	    
	     $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$data['result']['medal_no']+1,'product_name' =>$data['result']['product_name']))->row();
	   //  print_r($res);
	     
		$nlev=$res->level_id;
		//echo $nlev;
	    $data['clevel']=$res->level_id;
	    
        $data['activate']=$this->newmodel->activate_state($data['result']['product_name'],$nlev,$student['state_id']);
       // print_r($data['activate']);
        
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'status'=>'Paid','cin'=>$cin))->row();
        // print_r($res);
        // echo $this->db->last_query();
        $data['material_paid_a']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
       //echo $this->db->last_query();die;
        $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        //print_r($data['material_paid_b']);
        $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        $data['material_free_a']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        //echo $this->db->last_query();
        
        $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$data['clevel'],'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        //print_r($material_free_a);
        
        $a=array();
		if(empty($res)){
		$data['competition']='Yes';}else{$data['competition']='No';}
		
		$data['mock_av']= $this->db->get_where('mock_papers',array('clevel' =>$data['clevel'],'product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
		
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';
		    array_push($a,"Material-A");
		}
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
            
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
              
         
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
         
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$data['clevel'],'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['mock_test']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");}
           // print_r($student);
        $res1 = $this->db->get_where('competition_product_state',array('state_id' =>$student['state_id'],'product_name' =>$data['result']['product_name'],'clevel'=>$data['clevel']))->row();
        //    echo $this->db->last_query();die;
        
        $compt_id=$res1->id;
        //echo $compt_id;
        $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$compt_id))->result_array();
        //print_R($res2);
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
        
             $ro1=$res1->combo_1;$ro2=$res1->combo_2;$ro3=$res1->combo_3;$ro4=$res1->combo_4;
             
             
             $combo1='Yes';$combo2='Yes';$combo3='Yes';$combo4='Yes';
             $ro1=explode('+',$ro1);$ro2=explode('+',$ro2);$ro3=explode('+',$ro3);$ro4=explode('+',$ro4);
             foreach($ro1 as $row){
                //  echo $row;
                 if (in_array($row, $a)){$combo1='No';
                     break; 
                 }
                     
             }       
                foreach($ro2 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo2='No';
                      break; 
                 }
                    
             }
             foreach($ro3 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo3='No';
                      break; 
                 }
                    
             }
             foreach($ro4 as $row){
                 //echo $row;
                 if (in_array($row, $a)){$combo4='No';
                     break;
                 }
                      
             }
            
            
            
            if(isset($_POST['invoice'])){
                
	            redirect('cin_login/invoice_current', 'refresh');
	        }
	      $data['combo1']=$combo1;$data['combo2']=$combo2;$data['combo3']=$combo3;$data['combo4']=$combo4;
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$data['clevel']);
        //$this->session->set_userdata('period',$data['clevel']);
        
        $this->load->view('cin_login/register_work',$data);
    }  
    
// =============  end  ================  // 
 
    public function api_callinvoice() 
    {
        
        $cin = $this->session->userdata('cin');
        $level = $this->uri->segment(3);
    // echo $level.'ok'.$cin;die;
    
                    $this->db->select('*');
                    $this->db->from('cin_result');
                    $this->db->where('cin',$cin);
                    $query = $this->db->get();
                    $res= $query->row();
                    $product=$res->product_name;
    
            $data = array(
                'cin' => $cin,
                'clevel' => $level,
                'product' => $product,
                
            );
    
        // echo $_SESSION['exam_id'];die;
        
                    $this->db->select('*');
                    $this->db->from('competition_product_state');
                    $this->db->where('id',$_SESSION['exam_id']);
                    $query = $this->db->get();
                    $res= $query->row();
                    $competition=$res->revenue_setting_id;
                    
        // print_r($competition);die;            
                    
        if(!empty($competition)){
            $url='https://api.marrs.in/invoice';
        }else{
            $url='https://api.marrs.in/invoice_';
        }
        
        // echo $url;die;
    
        $postFields = json_encode($data);
        
    // print_r($data);die;
    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
        curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
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

    // Close cURL session
    curl_close($curl);

    
    header("Content-type:application/pdf");
    header("Content-Disposition:attachment;filename=invoice.pdf");

    // Output the PDF response
    echo $response;
}
    
    
//      public function api_callinvoice2() 
//     {
        
//         $cin = $this->session->userdata('cin');
//         $level = $this->uri->segment(3);
//      //echo $level.'ok'.$cin;die;
    
//                     $this->db->select('*');
//                     $this->db->from('cin_result');
//                     $this->db->where('cin',$cin);
//                     $query = $this->db->get();
//                     $res= $query->row();
//                     $product=$res->product_name;
    
//             $data = array(
//                 'cin' => $cin,
//                 'clevel' => $level,
//                 'product' => $product,
                
//             );
    
//         // echo $_SESSION['exam_id'];die;
//           $this->db->select('*');
//                     $this->db->from('webhook_calls_cin');
//                     $this->db->where('cin',$cin);
//                     $this->db->where('clevel',$level);
//                     $this->db->order_by('id','DESC');
//                     $query = $this->db->get();
//                     $res= $query->row();
//                     $exam_id=$res->comp_id;
                    
//                      $data = array(
//                             'cin' => $cin,
//                             'clevel' => $level,
//                             'product' => $product,
                            
//                         );
                    
//                     $this->db->select('*');
//                     $this->db->from('competition_product_state');
//                     $this->db->where('id',$exam_id);
//                     $query = $this->db->get();
//                     $res= $query->row();
//                     $competition=$res->revenue_setting_id;
                    
//      //print_r($exam_id);die;            
                    
//         if(!empty($competition)){
//             $url='https://api.aviansys.in/invoice';
//         }else{
//             $url='https://api.aviansys.in/invoice_';
//         }
        
//         // echo $url;die;
    
//         $postFields = json_encode($data);
        
//     // print_r($data);die;
//     // Initialize cURL session
//     $curl = curl_init();

//     // Set cURL options
//         curl_setopt_array($curl, array(
//                 CURLOPT_URL => $url,
//                 CURLOPT_RETURNTRANSFER => true,
//                 CURLOPT_ENCODING => '',
//                 CURLOPT_MAXREDIRS => 10,
//                 CURLOPT_TIMEOUT => 0,
//                 CURLOPT_FOLLOWLOCATION => true,
//                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                 CURLOPT_CUSTOMREQUEST => 'POST',
                
//                 CURLOPT_POSTFIELDS => $postFields,
            
//           CURLOPT_HTTPHEADER => array(
//             'Content-Type: application/json'
//           ),
//         ));


//     $response = curl_exec($curl);

//     // Close cURL session
//     curl_close($curl);

    
//     header("Content-type:application/pdf");
//     header("Content-Disposition:attachment;filename=invoice.pdf");

//     // Output the PDF response
//     echo $response;
// }
    // public function api_callinvoice2() 
    // {
    //     $cin = $this->session->userdata('cin');
    //     $level = $this->uri->segment(3);
    
    //     // Add detailed logging
    //     log_message('error', 'Invoice Request - CIN: ' . $cin . ', Level: ' . $level);
    
    //     // Validate input
    //     if(empty($cin)) {
    //         log_message('error', 'Invoice Error: CIN is empty');
    //         header('Content-Type: application/json');
    //         http_response_code(400);
    //         echo json_encode(['error' => 'User not logged in']);
    //         return;
    //     }
    
    //     if(empty($level)) {
    //         log_message('error', 'Invoice Error: Level is empty');
    //         header('Content-Type: application/json');
    //         http_response_code(400);
    //         echo json_encode(['error' => 'Level not provided']);
    //         return;
    //     }
    
    //     // Ensure level is numeric
    //     $level = intval($level);
    //     if ($level <= 0) {
    //         log_message('error', 'Invoice Error: Invalid level - ' . $level);
    //         header('Content-Type: application/json');
    //         http_response_code(400);
    //         echo json_encode(['error' => 'Invalid level']);
    //         return;
    //     }
    
    //     // Get student info
    //     $student = $this->db->get_where('cin_result', array('cin' => $cin))->row();
    //     if(empty($student)) {
    //         log_message('error', 'Invoice Error: Student not found - CIN: ' . $cin);
    //         header('Content-Type: application/json');
    //         http_response_code(404);
    //         echo json_encode(['error' => 'Student record not found']);
    //         return;
    //     }
    //     $product = $student->product_name;
    
    //     // Get payment record
    //     $webhook = $this->db->where('cin', $cin)
    //         ->where('clevel', $level)
    //         ->order_by('id', 'DESC')
    //         ->limit(1)
    //         ->get('webhook_calls_cin')
    //         ->row();
        
    //     if(empty($webhook)) {
    //         log_message('error', 'Invoice Error: No webhook record - CIN: ' . $cin . ', Level: ' . $level);
    //         // Don't fail - just continue with what we have
    //         $exam_id = 0;
    //     } else {
    //         $exam_id = $webhook->comp_id;
    //     }
    
    //     // Get competition details
    //     $comp = $this->db->get_where('competition_product_state', array('id' => $exam_id))->row();
    //     $competition = !empty($comp) ? $comp->revenue_setting_id : null;
    
    //     // Determine API URL
    //     $url = !empty($competition) 
    //         ? 'https://api.aviansys.in/invoice' 
    //         : 'https://api.aviansys.in/invoice_';
    
    //     log_message('error', 'Invoice API URL: ' . $url);
    
    //     // Prepare POST data
    //     $postData = json_encode([
    //         'cin' => $cin,
    //         'clevel' => $level,
    //         'product' => $product,
    //     ]);
    
    //     log_message('error', 'Invoice POST Data: ' . $postData);
    
    //     // Initialize cURL
    //     $curl = curl_init();
    
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => $url,
    //         CURLOPT_POST => 1,
    //         CURLOPT_POSTFIELDS => $postData,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json',
    //             'Content-Length: ' . strlen($postData)
    //         ),
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_SSL_VERIFYHOST => false,
    //     ));
    
    //     $response = curl_exec($curl);
    //     $curl_errno = curl_errno($curl);
    //     $curl_error = curl_error($curl);
    //     $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //     curl_close($curl);
    
    //     // Log response
    //     log_message('error', 'Invoice Response - HTTP: ' . $http_code . ', cURL Error: ' . $curl_error . ', Length: ' . strlen($response));
    
    //     // ============= ERROR HANDLING =============
    //     if ($curl_errno) {
    //         log_message('error', 'Invoice cURL Error: ' . $curl_error);
    //         header('Content-Type: application/json');
    //         http_response_code(500);
    //         echo json_encode(['error' => 'cURL Error: ' . $curl_error]);
    //         return;
    //     }
    
    //     if ($http_code != 200) {
    //         log_message('error', 'Invoice API Error - HTTP ' . $http_code . ': ' . substr($response, 0, 500));
    //         header('Content-Type: application/json');
    //         http_response_code($http_code);
    //         echo json_encode([
    //             'error' => 'API Error HTTP ' . $http_code,
    //             'details' => substr($response, 0, 500)
    //         ]);
    //         return;
    //     }
    
    //     if (empty($response)) {
    //         log_message('error', 'Invoice API returned empty response');
    //         header('Content-Type: application/json');
    //         http_response_code(500);
    //         echo json_encode(['error' => 'API returned empty response']);
    //         return;
    //     }
    
    //     // Check if response is valid PDF
    //     $is_pdf = strpos($response, '%PDF') === 0;
        
    //     if (!$is_pdf) {
    //         log_message('error', 'Invoice Response is not PDF: ' . substr($response, 0, 500));
    //         header('Content-Type: application/json');
    //         http_response_code(400);
    //         echo json_encode([
    //             'error' => 'Invalid response - not a PDF',
    //             'response_start' => substr($response, 0, 200)
    //         ]);
    //         return;
    //     }
    
    //     // ============= SEND PDF TO USER =============
    //     header('Content-Type: application/pdf');
    //     header('Content-Disposition: attachment; filename="invoice_' . $cin . '.pdf"');
    //     header('Content-Length: ' . strlen($response));
    //     header('Cache-Control: no-cache, no-store, must-revalidate');
    //     header('Pragma: no-cache');
    //     header('Expires: 0');
        
    //     echo $response;
    // }
    public function api_callinvoice2() 
    {
        $cin = $this->session->userdata('cin');
        $level = $this->uri->segment(3);
    
        log_message('error', 'Invoice Request - CIN: ' . $cin . ', Level: ' . $level);
    
        // Validate input
        if(empty($cin)) {
            log_message('error', 'Invoice Error: CIN is empty');
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'User not logged in']);
            return;
        }
    
        if(empty($level)) {
            log_message('error', 'Invoice Error: Level is empty');
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['error' => 'Level not provided']);
            return;
        }
    
        $level = intval($level);
    
        // ============= GET FROM new_cart (NOT webhook_calls_cin) =============
        // Get the MOST RECENT Paid record for this CIN and level
        $paid_record = $this->db
            ->where('cin', $cin)
            ->where('clevel', $level)
            ->where('status', 'Paid')  // ✅ ONLY paid records
            ->order_by('Time', 'DESC')  // ✅ Most recent first
            ->limit(1)
            ->get('new_cart')
            ->row();
    
        if(empty($paid_record)) {
            log_message('error', 'Invoice Error: No paid record found - CIN: ' . $cin . ', Level: ' . $level);
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => 'No paid invoice found for this level']);
            return;
        }
    
        log_message('error', 'Invoice: Found paid record - ID: ' . $paid_record->id . ', Amount: ' . $paid_record->amount . ', Product: ' . $paid_record->product_name);
    
        $product_name = $paid_record->product_name;
        $comp_id = $paid_record->comp_id;
    
        // Determine API URL based on comp_id
        $comp = $this->db->get_where('competition_product_state', array('id' => $comp_id))->row();
        // $url = !empty($comp) && !empty($comp->revenue_setting_id)
        //     ? 'https://api.aviansys.in/invoice' 
        //     : 'https://api.aviansys.in/invoice_';
    // $url = 'https://api.aviansys.in/invoice_';
    $url = !empty($competition) 
             ? 'https://api.marrs.in/invoice' 
             : 'https://api.marrs.in/invoice_';
        // Prepare POST data
        $postData = json_encode([
            'cin' => $cin,
            'clevel' => $level,
            'product' => $product_name,
        ]);
    
        log_message('error', 'Invoice API URL: ' . $url);
        log_message('error', 'Invoice POST Data: ' . $postData);
    
        // Initialize cURL
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData)
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
    
        $response = curl_exec($curl);
        $curl_errno = curl_errno($curl);
        $curl_error = curl_error($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    
        // Log response
        log_message('error', 'Invoice Response - HTTP: ' . $http_code . ', cURL Error: ' . $curl_error . ', Length: ' . strlen($response));
    
        // ============= ERROR HANDLING =============
        if ($curl_errno) {
            log_message('error', 'Invoice cURL Error: ' . $curl_error);
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'cURL Error: ' . $curl_error]);
            return;
        }
    
        if ($http_code != 200) {
            log_message('error', 'Invoice API Error - HTTP ' . $http_code . ': ' . substr($response, 0, 500));
            header('Content-Type: application/json');
            http_response_code($http_code);
            echo json_encode([
                'error' => 'API Error HTTP ' . $http_code,
                'details' => substr($response, 0, 500)
            ]);
            return;
        }
    
        if (empty($response)) {
            log_message('error', 'Invoice API returned empty response');
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(['error' => 'API returned empty response']);
            return;
        }
    
        // Check if response is valid PDF
        $is_pdf = strpos($response, '%PDF') === 0;
        
        if (!$is_pdf) {
            log_message('error', 'Invoice Response is not PDF: ' . substr($response, 0, 500));
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode([
                'error' => 'Invalid response - not a PDF',
                'response_start' => substr($response, 0, 200)
            ]);
            return;
        }
    
        // ============= SEND PDF TO USER =============
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="invoice_' . $cin . '_' . $level . '.pdf"');
        header('Content-Length: ' . strlen($response));
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        log_message('error', 'Invoice: PDF sent to user - Size: ' . strlen($response));
        
        echo $response;
    }
    
    //     public function api_calladmit_card() 
    //     {
            
    //         $cin = $this->session->userdata('cin');
    //         $level = $this->uri->segment(3);
    //     // echo $level.'ok'.$cin;
        
    //                     $this->db->select('*');
    //                     $this->db->from('cin_result');
    //                     $this->db->where('cin',$cin);
    //                     $query = $this->db->get();
    //                     $res= $query->row();
    //                     $product=$res->product_name;
        
    //             $data = array(
    //                 'cin' => $cin,
    //                 'clevel' => $level,
    //                 'product' => $product,
                    
    //             );
        
    //         $postFields = json_encode($data);
    // // print_r($data);die;
    //     // Initialize cURL session
    //     $curl = curl_init();
    
    //     // Set cURL options
    //         curl_setopt_array($curl, array(
    //                 CURLOPT_URL => 'https://api.aviansys.in/admit_card',
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_ENCODING => '',
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 0,
    //                 CURLOPT_FOLLOWLOCATION => true,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => 'POST',
                    
    //                 CURLOPT_POSTFIELDS => $postFields,
    //             // CURLOPT_POSTFIELDS =>'{
    //             //     "cin": "23SBAC510133",
    //             //     "clevel": "1",
    //             //     "schedule": "710",
    //             //     "product": "MaRRS International Spelling Bee"    
    //             // }',
    //           CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //           ),
    //         ));
    
    
    //     $response = curl_exec($curl);
    
    //     // Close cURL session
    //     curl_close($curl);
    
        
    //     header("Content-type:application/pdf");
    //     header("Content-Disposition:attachment;filename=AdmitCard.pdf");
    
    //     // Output the PDF response
    //     echo $response;
    // }
    //      public function api_calladmit_card_primary() 
    //     {
            
    //         $cin = $this->session->userdata('cin');
    //         $product = $this->uri->segment(3);
    //     // echo $cin.'product name'.$product;die;
        
        
    //             $data = array(
    //                 'cin' => $cin,
    //                 'clevel' => $clevel,
    //                 'product' => $product,
                    
    //             );
        
    //         $postFields = json_encode($data);
    // // print_r($data);die;
    //     // Initialize cURL session
    //     $curl = curl_init();
    
    //     // Set cURL options
    //         curl_setopt_array($curl, array(
    //                 CURLOPT_URL => 'https://api.aviansys.in/admit_card_primary',
    //                 CURLOPT_RETURNTRANSFER => true,
    //                 CURLOPT_ENCODING => '',
    //                 CURLOPT_MAXREDIRS => 10,
    //                 CURLOPT_TIMEOUT => 0,
    //                 CURLOPT_FOLLOWLOCATION => true,
    //                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                 CURLOPT_CUSTOMREQUEST => 'POST',
                    
    //                 CURLOPT_POSTFIELDS => $postFields,
    //             // CURLOPT_POSTFIELDS =>'{
    //             //     "cin": "23SBAC510133",
    //             //     "clevel": "1",
    //             //     "schedule": "710",
    //             //     "product": "MaRRS International Spelling Bee"    
    //             // }',
    //           CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //           ),
    //         ));
    
    
    //     $response = curl_exec($curl);
    
    //     // Close cURL session
    //     curl_close($curl);
    
        
    //     header("Content-type:application/pdf");
    //     header("Content-Disposition:attachment;filename=AdmitCard.pdf");
    
    //     // Output the PDF response
    //     echo $response;
    // }
    //     public function api_calladmit_card()
    // {
    //     $cin = $this->session->userdata('cin');
    //     $level = $this->uri->segment(3);
    
    //     $this->db->select('product_name');
    //     $this->db->from('cin_result');
    //     $this->db->where('cin', $cin);
    //     $res = $this->db->get()->row();
    
    //     $product = $res->product_name ?? '';
    
    //     $data = [
    //         'cin' => $cin,
    //         'clevel' => $level,
    //         'product' => $product
    //     ];
    //     $ch = curl_init('https://api.aviansys.in/admit_card_primary');
    
    //     curl_setopt_array($ch, [
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POST => true,
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: application/json'
    //         ],
    //         CURLOPT_POSTFIELDS => json_encode($data),
    //         CURLOPT_BINARYTRANSFER => true,
    //         CURLOPT_TIMEOUT => 60
    //     ]);
    
    //     $response = curl_exec($ch);
    
    //     if ($response === false) {
    //         die('Curl Error: ' . curl_error($ch));
    //     }
    
    //     curl_close($ch);
    
    //     // IMPORTANT: clear buffer
    //     if (ob_get_length()) ob_end_clean();
    
    //     header("Content-Type: application/pdf");
    //     header("Content-Disposition: attachment; filename=AdmitCard.pdf");
    //     header("Content-Length: " . strlen($response));
    
    //     echo $response;
    //     exit;
    // }
    public function api_calladmit_card()
    {
        $cin = $this->session->userdata('cin');
        $level = $this->input->post('level');
        $prod = $this->input->post('product_name');
        if (empty($level)) {
            $level = $this->input->post('clevel');
        }
    
        if (empty($level)) {
            $level = $this->session->userdata('clevel');
        }
    
        $this->db->select('product_name');
        $this->db->from('cin_result');
        $this->db->where('cin', $cin);
        $res = $this->db->get()->row();
        if(empty($prod)){
        $product = $res->product_name ?? '';
        }else{
           $product= $prod;
        }
        $data = [
            'cin' => $cin,
            'clevel' => $level,
            'product' => $product
        ];
    
        // print_r($data);
        // die;
        
        // $ch = curl_init('https://api.marrs.in/admit_card_primary');
        $ch = curl_init('https://api.marrs.in/admit_card');
    
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_TIMEOUT => 60
        ]);
    
        $response = curl_exec($ch);
    
        if ($response === false) {
            die('Curl Error: ' . curl_error($ch));
        }
    
        curl_close($ch);
    
        if (ob_get_length()) ob_end_clean();
    
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=AdmitCard.pdf");
    
        echo $response;
        exit;
    }

    public function register_close()
    {
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
        
	    $data['student']=$student=$this->newmodel->get_student_data_cin_($cin);
	    
	        $this->db->select('clevel,period_id,product_name');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
            $result_level=$d['clevel'];
            $period=$d['period_id'];
            $data['product_name']=$d['product_name'];
            
            $this->db->select('clevel');
            $this->db->from('new_cart');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
            $cart_level=$d['clevel'];
            
            if($result_level>$cart_level){$level=$result_level;}if($result_level<$cart_level){$level=$cart_level;}if($result_level==$cart_level){$level=$cart_level;}
	   // echo $level.'ok';
	   $data['result_level']=$result_level;
	   $data['cart_level']=$cart_level;
	   
	        $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('status!=','');
	        $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $data['result']=$d= $query->row_array();
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$cin);
            $query = $this->db->get();
            //echo $this->db->last_query();
            $s= $query->row_array();
            
            
            $res5 = $this->db->get_where('competition_product_state',array('product_name' =>$data['result']['product_name'], 'clevel'=>$level,'state_id'=>$s['state_id'],'period_id'=>$data['result']['period_id']))->row_array();
       //echo $this->db->last_query();
        $compt_id=$res5['id'];
            
          //  echo $compt_id.'ok';
            $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$compt_id))->result_array();
        //print_R($res2);
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
            
            
	    $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$level+1,'product_name' =>$data['result']['product_name']))->row();
		$nlev=$res->level_id;
		//echo $nlev;
	    $data['clevel']=$level;
	    
        $data['material_paid_a']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        $data['material_free_a']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
		
		$data['mock_av']= $this->db->get_where('mock_papers',array('clevel' =>$level,'product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';
		    array_push($a,"Material-A");
		}
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
            
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
           
          
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
	    	$data['mock_test']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");
		}
           // print_r($student);
           
        if(isset($_POST['invoice'])){
            
            redirect('cin_login/invoice_current', 'refresh');
        }
	   
	   $this->db->select('*');    
	   $this->db->from('orientation_school');
	   $this->db->where('period_id',$student['period_id']);
	   $this->db->where('school_id',$student['school_id']);
	   $this->db->order_by('con_id','DESC');
	   $query=$this->db->get();
	   //echo $this->db->last_query();die;
	    $data['ori_act']=$object=$query->row();
	    $end_date = $object->end_date; 
        $current_date = date('Y-m-d');
        
        if (strtotime($end_date) < strtotime($current_date)) {
            $data['oron']= "no";
        } else {
            $data['oron']= "yes";
        }   
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$level);
        //$this->session->set_userdata('period',$data['clevel']);
        
        $this->load->view('cin_login/register_close_test',$data);
    }
    
    
    public function register_close_test()
    {
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
        
	    $data['student']=$student=$this->newmodel->get_student_data_cin_($cin);
	    
	        $this->db->select('clevel,period_id,product_name');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
            $result_level=$d['clevel'];
            $period=$d['period_id'];
            $data['product_name']=$d['product_name'];
            
            $this->db->select('clevel');
            $this->db->from('new_cart');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
            $cart_level=$d['clevel'];
            
            if($result_level>$cart_level){$level=$result_level;}if($result_level<$cart_level){$level=$cart_level;}if($result_level==$cart_level){$level=$cart_level;}
	   // echo $level.'ok';
	   $data['result_level']=$result_level;
	   $data['cart_level']=$cart_level;
	   
	        $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('status!=','');
	        $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $data['result']=$d= $query->row_array();
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$cin);
            $query = $this->db->get();
            //echo $this->db->last_query();
            $s= $query->row_array();
            
            
            $res5 = $this->db->get_where('competition_product_state',array('product_name' =>$data['result']['product_name'], 'clevel'=>$level,'state_id'=>$s['state_id'],'period_id'=>$data['result']['period_id']))->row_array();
       //echo $this->db->last_query();
        $compt_id=$res5['id'];
            
          //  echo $compt_id.'ok';
            $res2 = $this->db->get_where('closing_competition_details',array('competition_id' =>$compt_id))->result_array();
        //print_R($res2);
        if(!empty($res2)){$data['admit_card_av']='yes';$data['admit_id']=$compt_id;}
            
            
	    $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$level+1,'product_name' =>$data['result']['product_name']))->row();
		$nlev=$res->level_id;
		//echo $nlev;
	    $data['clevel']=$level;
	    
        $data['material_paid_a']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_paid_b']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_paid_c']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Paid','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        
        $data['material_free_a']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'A','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_b']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'B','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
        $data['material_free_c']= $this->db->get_where('study_material',array('clevel' =>$level,'status'=>'Free','type'=>'C','product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
		
		$data['mock_av']= $this->db->get_where('mock_papers',array('clevel' =>$level,'product_name'=>$data['result']['product_name'],'class'=>$student['class']))->row();
		
		$res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material'=>'Yes','cin'=>$cin))->row();
		if(empty($res)){
		$data['study_material_a']='Yes';}else{$data['study_material_a']='No';
		    array_push($a,"Material-A");
		}
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_b']='Yes';}else{$data['study_material_b']='No';array_push($a,"Material-B");}
            
        //print_r($res);die;
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'study_material_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['study_material_c']='Yes';}else{$data['study_material_c']='No';array_push($a,"Material-C");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_a']='Yes';}else{$data['orientation_a']='No';array_push($a,"Orientation-A");}
            
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation_b'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_b']='Yes';}else{$data['orientation_b']='No';array_push($a,"Orientation-B");}
           
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'orientation_c'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
		$data['orientation_c']='Yes';}else{$data['orientation_c']='No';array_push($a,"Orientation-C");}
           
          
        $res = $this->db->get_where('new_cart',array('clevel' =>$level,'mock_test'=>'Yes','cin'=>$cin))->row();
        if(empty($res)){
	    	$data['mock_test']='Yes';}else{$data['mock_test']='No';array_push($a,"MockTest");
		}
           // print_r($student);
           
        if(isset($_POST['invoice'])){
            
            redirect('cin_login/invoice_current', 'refresh');
        }
	   
	   $this->db->select('*');    
	   $this->db->from('orientation_school');
	   $this->db->where('period_id',$student['period_id']);
	   $this->db->where('school_id',$student['school_id']);
	   $this->db->order_by('con_id','DESC');
	   $query=$this->db->get();
	   //echo $this->db->last_query();die;
	    $data['ori_act']=$object=$query->row();
	    $end_date = $object->end_date; 
        $current_date = date('Y-m-d');
        
        if (strtotime($end_date) < strtotime($current_date)) {
            $data['oron']= "no";
        } else {
            $data['oron']= "yes";
        }   
	       
	    $this->session->set_userdata('product',$data['result']['product_name']);
        $this->session->set_userdata('clevel',$level);
        //$this->session->set_userdata('period',$data['clevel']);
        
        $this->load->view('cin_login/register_close_test',$data);
    }
    
    
    public function add_ca()
    {
        // print_r($_POST);die;
        if($_POST['type']=='orientation'){
            $res= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$_POST['id'],'orientation'=>'no'))->row();
        }
        if($_POST['type']=='mock'){
            $res= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$_POST['id'],'mock'=>'no'))->row();
        }
        // print_r($res);die;
        if(empty($res)){                                                             
            $ress= $this->db->get_where('orientation_school',array('con_id'=>$_POST['id']))->row();
                                      
            $ar = array(
                'cin' => $this->session->userdata('cin'),
                'con_id' => $ress->con_id,
                'franchise_id' => $ress->franchise_id,
                'franchise_per' => $ress->franchise_cut,
                'inserted_date' => date('Y-m-d'),
                'inserted_time' => date('h:i:s')
            );
            
            if ($_POST['type'] == 'orientation') {
                $ar['orientation'] = 'no';
                $ar['orientation_amt'] = $ress->price;
            } 
            if($_POST['type'] == 'mock') {
                $ar['mock'] = 'no';
                $ar['mock_amt'] = $ress->mock_price;
            }

            // print_r($ar);die;  
            $this->db->insert('orientation_school_cart',$ar);
            $ress= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$_POST['id']))->result();
            echo  count($ress);
        }else{
            $ress= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$_POST['id']))->result();
            echo count($ress);
        }
        
    }
    
    
    public function get_cart_items()
    {
        $cartItems = $this->db->get_where('orientation_school_cart', array('cin' => $this->session->userdata('cin')))->result();
        
        if (!empty($cartItems)) {
            $item=[];
            foreach($cartItems as $row){
                if ($row->orientation_amt != '') {
                    // echo 'ok1';
                    $items[] = array(
                        'id' => $row->orientation_school_cart_id,
                        'details' => 'orientation',
                        'price' => $row->orientation_amt
                    );
                }
                if ($row->mock_amt != '' ) {
                    // print_r($row);die;
                    $items[] = array(
                        'id' => $row->orientation_school_cart_id,
                        'details' => 'mock',
                        'price' => $row->mock_amt
                    );
                }
                // print_r($items);die;
            }
            
            $response = array(
            'status' => true,
            'cartData' => $items
            );
        } else {
            // If the cart is empty, return status false
            $response = array(
                'status' => false,
                'message' => 'Cart is empty'
            );
        }
    // print_r($response);die;
        echo json_encode($response);
    }


    public function remove_ori_cart()
    {
        
        $this->db->where('orientation_school_cart_id',$_POST['id']);
        $this->db->delete('orientation_school_cart');
        $ress= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin')))->result();
        echo count($ress);
    }
    
    
    public function count_cart()
    {
        $ress= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin')))->result();
        echo count($ress);
    }
    
     // =========================== admit card dynamic ============================= // 
    public function admitcard_download_()
    {
	    $data['com_id']=$_POST['https://marrs_in/student_registration/cin_login/admitcard_download'];
	    
	    $data['cin']=$this->session->userdata('cin');
	    $data['clevel']=$clevel=$this->session->userdata('clevel');
	    $data['product']=$product=$this->session->userdata('product');
	     $res = $this->db->get_where('competition_product_state',array('clevel' =>$clevel,'status'=>'Live','product_name'=>$product))->row();
        $data['id']=$res->id;
	    
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	    
	    //echo $clevel;
	    
	    
	  $this->load->view('cin_login/admitcard',$data);
	}  
	
     // =========================== admit card dynamic ============================= // 
    public function admitcard_download()
    {
	    $data['com_id']=$_POST['https://marrs_in/student_registration/cin_login/admitcard_download'];
	    $data['cin']=$this->session->userdata('cin');
	    $data['clevel']=$clevel=$this->session->userdata('clevel');
	    $data['product']=$product=$this->session->userdata('product');
	     $res = $this->db->get_where('competition_product_state',array('clevel' =>$clevel,'status'=>'Live','product_name'=>$product))->row();
        $data['id']=$res->id;
	    
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	    
	    //echo $clevel;
	    
	    
	  $this->load->view('cin_login/admitcard',$data);
	}  
	
    // ============= end =============== //
     
    public function available()
    {
        $cin=$_SESSION['cin'];
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
           // print_r($d);echo '<br>';
            
            $this->db->select('*');
            $this->db->from('new_cart');
            $this->db->where('cin',$cin);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $p= $query->row_array();
           // print_r($p);die;
            
            $rlevel=$d['clevel'];$plevel=$p['clevel'];
           echo $rlevel.$plevel;die;
    }
    
    // ======= end ========= //
    public function nationallevel()
    {
        //echo 'ok';die;
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	    //print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);
	    // print_r( $data['result']);exit; 
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'21IN6850',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'6850'
                    ); 
        
            $data['study_material_new']=array('price_code'=>'21INT550',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'550'
                    );
            $data['orientation_new']=array('price_code'=>'21IN999',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'999'
                    );
            $data['mock_test_new']= array('price_code'=>'21IN350',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'350'
	    );   
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	    if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'21INT6800',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'6800'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2=''; 
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'21IN550',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'550'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'21NT999',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'999'
                                );
                                $d3='d3';
                	        }
                	       // ==== mock test ==== //
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT350',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'350'
                                );
                	            $d4='d4';  
                	        }
                	        
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         
                        	     }
                        	     
	    }	
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $clevel;die;
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period); 
	    
	    
	    
	    
	   // ------------------------------------ //
	   
	    $data['orientation1']=$student=$this->newmodel->check($cin,$period,'orientation',$clevel);
	    $data['rivision']=$student=$this->newmodel->check($cin,$period,'revision',$clevel);
	    $data['mock_test']=$student=$this->newmodel->check($cin,$period,'mock_test',$clevel);
	    $data['study_material']=$student=$this->newmodel->check($cin,$period,'study_material',$clevel);
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    $data['activate']=$this->newmodel->activate123($product,$clevel);
	    //print_r($data['activate']);exit;   
	    
	    
	    // ------------------------------------- //
         $this->load->view('cin_login/national_level',$data);
    }  
    
    
    public function current_year()
    {  
        
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
		$state_id = $school_id[0]['state_id'];
	    //print_r($school_id[0]['state_id']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	   // print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	   // echo $period.' '.$clevel.' '.$product.' '.$class;
	    
	    $data['material_free']=$this->db->get_where('study_material',array('period'=>$period,'clevel'=>$clevel,'product_name'=>$product,'status'=>'Free','class'=>$class))->result_array(); 
	  //echo $this->db->last_query();
	  //print($data['material_free']);   
	   // $data['material_free_b']=$this->newmodel->get_student_material_free_a($class,$product,$clevel,$period,'module_b_free');
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period,'Paid');  
	   // $data['material_b_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period,'module_b_paid'); 
		//print_r($result);exit;
		
	    //$data['orientation1']=$student=$this->newmodel->checkorientation($cin,$period,'orientation',$clevel);
	    //$data['orientation_b']=$student=$this->newmodel->checkorientation_b($cin,$period,'orientation_b',$clevel);
	    //	print_r($data['orientation_b']);exit;
	    $data['mock_test']=$student=$this->newmodel->checkmock($cin,$period,'mock_test',$clevel);
	    
		$data['study_material']=$student=$this->newmodel->checkstudy($cin,$period,'study_material',$clevel); 
		
		
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
//print_r($data['cometition']);exit; 
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    
	   // echo $clevel;die;
	    $data['activate']=$this->db->get_where('competition_product_state',array('product_name'=>$product,'clevel'=>'1','period_id'=>'13'))->result_array();
	//	print_r($data['activate']);exit; 
	
	
// 	============== edit by abhishek 28/9/23 ============= //
	       	$data['cin']=$cin;
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            $this->db->where('status !=', null);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();
            $d= $query->row_array();
            //print_r($d);
            $data['n']=$d;
            
            if($d['status']==''){
                $data['register']='Yes';
            }else{
                $data['register']='No';
            }
            
            if($d['clevel']!=''){
                $cl=$d['clevel'];
            }
            if($d['status']!=''){
               $st=$d['status'];
            }
            
            
            
             $query1=$this->db->query("SELECT * FROM `new_cart` JOIN cin_list ON cin_list.cin=new_cart.cin JOIN cin_result ON cin_result.cin=new_cart.cin WHERE new_cart.period_id='13' and new_cart.mock_test='Yes' and cin_list.cin='$cin' ");
    	   //  echo $this->db->last_query();die;
    	     
    	     if(!empty($query1->result())){$data['mock_new']='Yes';}
            $query2=$this->db->query("SELECT * FROM `new_cart` JOIN cin_list ON cin_list.cin=new_cart.cin JOIN cin_result ON cin_result.cin=new_cart.cin WHERE new_cart.period_id='13' and new_cart.orientation='Yes' and cin_list.cin='$cin' ");
    	   //  echo $this->db->last_query();die;
    	     
    	     if(!empty($query2->result())){$data['orien_new']='Yes';}
            
            
	   $data['new_mate']='';
	   
	   
	   if(isset($_POST['invoice'])){
	       redirect('cin_login/invoice_cart', 'refresh');
	   }
	   
	// ========== end =========== //
	
	
	    $this->load->view('current_year/current_year.php',$data);     
    } 


    public function invoice_cart()
    {
        $cin = $this->session->userdata('cin');
        $data['cin'] = $this->session->userdata('cin');
        $data['data']= $this->db->get_where('cin_list',array('cin'=>$cin))->row();
        
    
            $this->db->select('*');
            $this->db->from('new_cart');
            $this->db->where('cin',$cin);
            //$this->db->where('status !=', null);
            $this->db->order_by("clevel", "desc");
            $query = $this->db->get();
            //echo $this->db->last_query();die;
        $data['payment']=    $d= $query->result_array();
            if(isset($_POST['back'])){
                 redirect('cin_login/current_year', 'refresh');
            }
            
    // $data['payment']= $this->db->get_where('new_cart',array('cin'=>$cin))->row();
    
    
    
    $this->load->view('current_year/invoice_cart',$data);
}

	
    public function invoice_current()
    {
        $cin = $this->session->userdata('cin');
        $clevel = $this->session->userdata('clevel');
        $data['cin'] = $this->session->userdata('cin');
        $data['data']= $this->db->get_where('cin_list',array('cin'=>$cin))->row();
        
    
            $this->db->select('*');
            $this->db->from('new_cart');
            $this->db->where('cin',$cin);
            //$this->db->where('status !=', null);
            
            $this->db->where('clevel',$clevel);
            $this->db->group_by("razorpay_payment_id");
            $query = $this->db->get();
            //echo $this->db->last_query();die;
            $data['payment']=    $d= $query->result_array();
            if(isset($_POST['back'])){
                 redirect('cin_login/register', 'refresh');
            }
            
     $data['nlev']= $this->db->get_where('competition_level_byproduct',array('level_id'=>$clevel))->row();
    //print_r($data['nlev']);die;
    
    
    $this->load->view('cin_login/invoice_cart',$data);
}


    public function competition_statewise()
    {  
        
        $this->load->model('newmodel');
       
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
		$state_id = $school_id[0]['state_id'];
	    //print_r($school_id[0]['state_id']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	   // print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $product;die;  
	    
	    $data['material_free']=$this->newmodel->get_student_material_free_a($class,$product,$clevel,$period,'Free'); 
	    $data['material_free_b']=$this->newmodel->get_student_material_free_a($class,$product,$clevel,$period,'module_b_free');
	   //print($data['material_free_b']);exit;    
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period,'Paid');  
	    $data['material_b_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period,'module_b_paid'); 
	//	print_r($data['material_b_paid']);exit;
		
	    $data['orientation1']=$student=$this->newmodel->checkorientation($cin,$period,'orientation',$clevel);
	    $data['orientation_b']=$student=$this->newmodel->checkorientation_b($cin,$period,'orientation_b',$clevel);
	    //	print_r($data['orientation_b']);exit;
	    $data['mock_test']=$student=$this->newmodel->checkmock($cin,$period,'mock_test',$clevel);
	    
		$data['study_material']=$student=$this->newmodel->checkstudy($cin,$period,'study_material',$clevel); 
		$data['study_material_bm']=$student=$this->newmodel->checkstudy_bmat($cin,$period,'study_material_b',$clevel); 
		//print_r($data['study_material_bm']);exit; 
		
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
//print_r($data['cometition']);exit; 
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    
	   // echo $clevel;die;
	    $data['activate']=$this->newmodel->activate_state($product,$clevel,$state_id,$product);
		//print_r($data['activate']);exit; 
	    $this->load->view('cin_login/competition_statewise.php',$data);     
    }  
    
  
    public function products()
    {
        //echo 'ok';die;
            error_reporting(E_ALL);
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);die;
	    //$data['cart']='';
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'21NT5500',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'5500'
                    );
        
            $data['study_material_new']=array('price_code'=>'21NT450',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'450'
                    );
            $data['orientation_new']=array('price_code'=>'21NT900',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'900'
                    );
            $data['mock_test_new']= array('price_code'=>'21NT900',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'250'
	    );
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	            	   // print_r($row['status']);
            	            if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'21NT5500',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'5500'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2='';
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'21NT450',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'450'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'21NT900',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'900'
                                );
                                $d3='d3';
                	        }
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT240',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'250'
                                );
                	            $d4='d4';
                	        }
                	       // echo 'okk'.'-'.$d4;die;
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       //   echo 'okk';die;
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         // echo 'ok';die;
                        	     }
                        	     
	    }	
	     //     // ================ ok ===================== //
	   //    $data['orientation_status']=$this->newmodel->orientation_status();
	   
	    
	   //  $data['amount']=$this->newmodel->c_data($cin);
	   
	   //  if(isset($_POST['add'])){
	   //            // $amt=$this->input->post('amount');
	   //             $amt= $_POST['add'];
	   //            // echo $amt;die;
	   //             $this->newmodel->add($amt,$cin);
	   //  }
	   //  if(isset($_POST['remove'])){
	   //             $amt= $_POST['remove'];
	   //             $this->newmodel->remove($amt,$cin);
	   //  }
	     
	     
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);
	    
        $this->load->view('cin_login/product',$data);
        
        
    //     error_reporting(E_ALL);
    //     ini_set('display_errors', 0);
    //     $cin=$this->session->userdata('cin');
	   // $school_id=$this->newmodel->get_student_data($cin);
	   // $school=$school_id[0]['school_id'];
	   // //print_r($school_id[0]['class']);die;
	   // $data['cart']=$this->newmodel->get_student_cart($cin);
	   // $data['result']=$this->newmodel->get_student_result($cin);
	   // $data['student']=$this->newmodel->get_student_data($cin);
	   // $student=$this->newmodel->get_student_data($cin);
	   // //print_r($data['cart']);die;
	   // //$data['cart']='';
	    
	   // if(empty($data['cart'])){
	   //    // echo 'ok';die;
	   //     $data['product_new']=array('price_code'=>'21NT5500',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'5500'
    //                 );
        
    //         $data['study_material_new']=array('price_code'=>'21NT450',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'450'
    //                 );
    //         $data['orientation_new']=array('price_code'=>'21NT900',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'900'
    //                 );
    //         $data['mock_test_new']= array('price_code'=>'21NT900',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'250'
    //                 );
	   // }
	   // else{
	        
	   //    // ================ ok ===================== //
	       
	   //    $copp=$data['cart'];
	   //    //print_r($copp[0]);die;
	   //    $copp1=$copp[0];
	   //    $copp2=$copp[1];
	   //    $copp3=$copp[2];
	   //    $copp4=$copp[3];
	   //    //print_r($copp2);die;
            	        
    //         	   // print_r($row['status']);
    //         	            if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
    //         	               $data['product_new']='';
    //         	               $d1='';
    //         	               // echo 'ok';die;
    //         	            }else{
    //         	            $data['product_new']=array('price_code'=>'21NT5500',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'5500'
    //                             );
    //                             $d1='d1';
    //                             // echo 'ok';die;
    //         	            }
    //         	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
    //         	                $data['study_material_new']='';
    //         	                $d2='';
    //         	            }else{
            	            
    //         	            $data['study_material_new']=array('price_code'=>'21NT450',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'450'
    //                             );
    //                             $d2='d2';
    //         	            }
            	            
    //         	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
    //         	                $data['orientation_new']=''; 
    //         	                 $d3='';
    //             	        }
    //             	        else{
                	            
    //             	            $data['orientation_new']=array('price_code'=>'21NT900',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'900'
    //                             );
    //                             $d3='d3';
    //             	        }
    //             	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
    //         	                 $data['mock_test_new']='';
            	                 
    //         	                  $d4='';
    //             	        }else{
                	           
    //             	            $data['mock_test_new']= array('price_code'=>'21NT240',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'250'
    //                             );
    //             	            $d4='d4';
    //             	        }
    //             	       // echo 'okk'.'-'.$d4;die;
                	        
    //         	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
    //         	                    $data['all_paid_new']='yes';
    //         	       //   echo 'okk';die;
    //                 	         }
    //                     	     else{
    //                     	         $data['all_paid_new']='';
    //                     	         // echo 'ok';die;
    //                     	     }
                        	     
	   // }	        
            	        
	   //     // ================ ok ===================== //
	   //    $data['orientation_status']=$this->newmodel->orientation_status();
	   
	    
	   //  $data['amount']=$this->newmodel->c_data($cin);
	   
	   //  if(isset($_POST['add'])){
	   //            // $amt=$this->input->post('amount');
	   //             $amt= $_POST['add'];
	   //            // echo $amt;die;
	   //             $this->newmodel->add($amt,$cin);
	   //  }
	   //  if(isset($_POST['remove'])){
	   //             $amt= $_POST['remove'];
	   //             $this->newmodel->remove($amt,$cin);
	   //  }
	     
	     
	   // $class=$student[0]['class'];
	   // $subject='';
	   // $product=$data['result'][0]['product_name'];
	   // $clevel=$data['result'][0]['clevel'];
	   // $period=$data['result'][0]['period_id'];
	   // $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	   // $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);
	   // $this->load->view('cin_login/product',$data);
    }
    

	public function orientationslip()
	{
	   
	       $cin = $_SESSION['cin'];
	    
	    $this->db->select('product_name');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $datalogo = $this->db->get()->row()->product_name;
             //echo $datalogo;die;
             
             
             if($datalogo=='MaRRS International Spelling Bee'){
             $image  = base_url().'images/misb_logo.jpg';
             
            
             }
             if($datalogo=='MaRRS Preschool Bee Math'){
              $image  = base_url().'images/math_logo.png';
            
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                  $image  = base_url().'images/english_logo.png';
             
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                  $image  = base_url().'images/science_logo.png';
              
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 $image  = base_url().'images/humanities_logo.png';
               
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                  $image  = base_url().'images/jun.png';
               
             }
             
	    
	         $this->db->select('cin,class,student_name');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
	    
	    
	    
	    
$fname =  $data->student_name;;
$cin =  $data->cin;

$product = $datalogo;

$categoery = $data->class;

include APPPATH . 'third_party/fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","",16);

$pdf->Cell( 190, 30, $pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 1, 'C' );
$pdf->Cell(190,10,"Participation Slip - Orientation Class ",0,1,'C');
$pdf->Cell(0,10,"",0,1);


$pdf->Cell(70,10,"CIN Number :",1,0);
$pdf->Cell(120,10,$cin,1,1); 

$pdf->Cell(70,10,"Name of the participant :",1,0);
$pdf->Cell(120,10,$fname,1,1);

$pdf->Cell(70,10,"Category:",1,0);
$pdf->Cell(120,10,$categoery,1,1);

$pdf->Cell(70,10,"Product Name:",1,0);
$pdf->Cell(120,10,$product,1,1);

$pdf->Cell(70,10," Orientation Slip Number:",1,0);
$pdf->Cell(120,10,"OR ".$cin,1,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Thank you for registering for the orientation program for 
",0,1);
$pdf->Cell(100,10, $product ." National Level Championship 2021/22",0,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Your participation is confirmed.
",0,1);

$pdf->Cell(100,10,"The schedule of your session will be communicated to you shortly.
",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
//$pdf->Cell(0,10,"",0,1);
$pdf->Cell(190,4," Powered By Aviansys Technologies Private Limited "
,0,1,'C');

$pdf->output();


	   
	}
	
	
	public function mocktest()
	{
         $cin = $_SESSION['cin'];
         
           
           $this->db->select('*');
           $this->db->from('new_cart');
           $this->db->where('cin',$cin);
           //$this->db->where('clevel','4');
           $result = $this->db->get()->row();
           $product =  $result->product_name;
           if($product=='MaRRS Preschool Bee Math'){
               $pname = "PSBM";
           }elseif($product=='MaRRS Preschool Bee English'){
               $pname = "PSBE";
           }elseif($product=='MaRRS Preschool Bee Science'){
               $pname = "PSBS";
           }elseif($product=='MaRRS Preschool Bee Humanities'){
               $pname = "PSBH";
           }elseif($product=='MaRRS Play 2 Learn'){
               $pname = "MAP2L";
           }elseif($product=='MaRRS International Spelling Bee'){
                $pname = "MISB";
           }elseif($product=='MaRRS Scientia Exertus'){
               $pname = "MASE";
           
           }
           
           $register_paid = $result->status;
           $slip = $result->mocktest_slip;
           $this->db->select('max(mocktest_slip) as mocktest_slip');
            $this->db->from('new_cart');
        		     $this->db->like('mocktest_slip',$pname);
        		     $Step2Query = $this->db->get();  
        		     $Step2QueryResult=$Step2Query->row_array();
        			 
        			 $max_access_code =$Step2QueryResult['mocktest_slip'];
        			 
        			 if(empty($max_access_code) || $max_access_code ==" ")
        			 {
        				
        			    $chestnumber=$pname."1000";
        				   //echo "empty";exit;
        			 }
        			 else
        			 {
        				  $firsthalf_test_school_code = substr($max_access_code,'0','4');
        			     $test_school_code = substr($max_access_code,'4','8') +1;
        				 $chestnumber = $firsthalf_test_school_code.$test_school_code;
        			
        			 }
           //echo $chestnumber;exit;
           
           
         if($register_paid=='Paid' && empty($slip)){
          $chest_number = $chestnumber;
          $data = array('mocktest_slip' =>$chest_number
              );
          $this->db->where('cin',$cin);
          $this->db->where('status','Paid');
          $this->db->update('new_cart',$data); 
         }
        $data['mocktest_slip'] = $slip;
             
          $this->load->view('cin_login/mocktest_slip',$data);
             
       // }
        
    }
    
    
    public function orientation()
    {
        $cin = $_SESSION['cin'];
        $product = $_SESSION['product'];
        $clevel = $_SESSION['clevel'];
          
           $this->db->select('*');
           $this->db->from('new_cart');
           $this->db->where('cin',$cin);
          // $this->db->where('clevel','4');
           $result = $this->db->get()->row();
            $product =  $result->product_name;
           if($product=='MaRRS Preschool Bee Math'){
               $pname = "PSBM";
           }elseif($product=='MaRRS Preschool Bee English'){
               $pname = "PSBE";
           }elseif($product=='MaRRS Preschool Bee Science'){
               $pname = "PSBS";
           }elseif($product=='MaRRS Preschool Bee Humanities'){
               $pname = "PSBH";
           }elseif($product=='MaRRS Play 2 Learn'){
               $pname = "MAP2L";
           }elseif($product=='MaRRS International Spelling Bee'){
                $pname = "MISB";
           }elseif($product=='MaRRS Scientia Exertus'){
               $pname = "MASE";
           
           }
           
           
           $register_paid = $result->status;
           $slip = $result->orientation_slip;
           $this->db->select('max(orientation_slip) as orientation_slip');
            $this->db->from('new_cart');
        		     $this->db->like('orientation_slip',$pname);
        		     $Step2Query = $this->db->get();  
        		     $Step2QueryResult=$Step2Query->row_array();
        			 
        			 $max_access_code =$Step2QueryResult['orientation_slip'];
        			 
        			 if(empty($max_access_code) || $max_access_code ==" ")
        			 {
        				
        			    $chestnumber=$pname."1000";
        				   //echo "empty";exit;
        			 }
        			 else
        			 {
        				 $firsthalf_test_school_code = substr($max_access_code,'0','4');
        			     $test_school_code = substr($max_access_code,'4','8') +1;
        				 $chestnumber = $firsthalf_test_school_code.$test_school_code;
        			
        			 }
           // echo $chestnumber;exit;
           
           
         if($register_paid=='Paid' && empty($slip)){
          $chest_number = $chestnumber;
          $data = array('orientation_slip' =>$chest_number
              );
          $this->db->where('cin',$cin);
          $this->db->where('status','Paid');
          //$this->db->where('product_name',$product);
          $this->db->update('new_cart',$data); 
         }
        $data['orientation_slip'] = $slip;
        $this->load->view('cin_login/orientation_slip',$data);
        
        
    }
    
    
    public function orientation_()
    {
         $cin = $_SESSION['cin'];
         $data['product']=$product = $_SESSION['product'];
         $data['clevel']=$clevel = $_SESSION['clevel'];
        
          $data['type']=  $this->input->post('type');
        
        $this->load->view('cin_login/orienation_slip.php',$data);
        
    }
    
    
    public function orientation_new()
    {
         $cin = $_SESSION['cin'];
         $data['product']=$product = $_SESSION['product'];
         $data['clevel']=$clevel = $_SESSION['clevel'];
        
          $data['type']=  $this->input->post('type');
        
        $this->load->view('cin_login/orienation_slip_new.php',$data);
        
    }
	
	
	public function mocktest_ss()
	{
	   
	       $cin = $_SESSION['cin'];
	    
	    $this->db->select('product_name');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $datalogo = $this->db->get()->row()->product_name;
             //echo $datalogo;die;
             
             
             if($datalogo=='MaRRS International Spelling Bee'){
             $image  = base_url().'images/misb_logo.jpg';
             
            
             }
             if($datalogo=='MaRRS Preschool Bee Math'){
              $image  = base_url().'images/math_logo.png';
            
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                  $image  = base_url().'images/english_logo.png';
             
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                  $image  = base_url().'images/science_logo.png';
              
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 $image  = base_url().'images/humanities_logo.png';
               
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                  $image  = base_url().'images/jun.png';
               
             }
             
	    
	         $this->db->select('cin,class,student_name');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
	    
	    
	    
	    
$fname =  $data->student_name;;
$cin =  $data->cin;

$product = $datalogo;

$categoery = $data->class;

include APPPATH . 'third_party/fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","",16);

$pdf->Cell( 190, 30, $pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 1, 'C' );
$pdf->Cell(190,10,"Participation Slip - Mock Test ",0,1,'C');
$pdf->Cell(0,10,"",0,1);


$pdf->Cell(70,10,"CIN Number :",1,0);
$pdf->Cell(120,10,$cin,1,1); 

$pdf->Cell(70,10,"Name of the participant :",1,0);
$pdf->Cell(120,10,$fname,1,1);

$pdf->Cell(70,10,"Category:",1,0);
$pdf->Cell(120,10,$categoery,1,1);

$pdf->Cell(70,10,"Product Name:",1,0);
$pdf->Cell(120,10,$product,1,1);

$pdf->Cell(70,10," Slip Number:",1,0);
$pdf->Cell(120,10,"MC ".$cin,1,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Thank you for registering for the Mock Test program for 
",0,1);
$pdf->Cell(100,10, $product ." National Level Championship 2021/22",0,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Your participation is confirmed.
",0,1);

//$pdf->Cell(100,10,"The schedule of your session will be communicated to you shortly.",0,1);
$pdf->Cell(100,10,"Note - Please note that the MOCK TEST will be conducted on 28th onwards.
",0,1);


$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
//$pdf->Cell(0,10,"",0,1);
$pdf->Cell(190,4," Powered  By Aviansys Technologies Private Limited "
,0,1,'C');

$pdf->output();

}
	
	
	public function admitcard()
	{
	    $data['cin']=$this->session->userdata('cin');
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	  $this->load->view('cin_login/admitcard',$data);
	}
	
	
	public function admitcardodisha()
	{
	    $data['cin']=$this->session->userdata('cin');
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	  $this->load->view('cin_login/admitcard_orisha',$data);
	}
	
	
    public function certificateform()
    {
        $this->load->view('cin_login/certificateform');
    }	
    
	
	public function certificate()
    {
        $this->load->view('cin_login/certificate');
    
    }
    
    
    public function studentdata()
    {
          $email = $this->session->userdata('email');
          $this->db->select('*');
          $this->db->from('cin_list');
          $this->db->join('cin_result','cin_result.cin=cin_list.cin');
          $this->db->where('cin_list.stud_email',$email);
          $res = $this->db->get();
        
         if(!empty($res->result_array())){
           $data['student']=$res->result_array();
         }else{
           $data['student']= $this->db->get_where('cin_zoomzoom', array('email' => $email))->row_array();
         }
         $this->load->view('list_cinproductdata',$data);
    }


    public function invoice()
    {
        $cin = $this->session->userdata('cin');
        $data['cin'] = $this->session->userdata('cin');
        $data['data']= $this->db->get_where('cin_list',array('cin'=>$cin))->row();
        $data['payment']= $this->db->get_where('new_cart',array('cin'=>$cin))->result();
        $this->load->view('cin_login/invoice',$data);
    }
    
	
	public function zoom_cin_login()
	{
	    echo 'ok';die;
	}
	
	
	public function resetpassword($id='')
	{
      
       $cin =  $this->session->userdata('cin');
      
        if(isset($_POST['submit'])){
            $old_pass = $this->input->post('old_password');
            $new_pass = $this->input->post('new_password');
             $pas = $this->db->get_where('cin_list',array('password'=>$old_pass))->row();
             if(!empty($pas->cin)){
                 $array = array(
                     'password' =>$new_pass
                     );
                $this->db->where('cin',$pas->cin);
                $this->db->update('cin_list',$array);
                $this->session->set_flashdata('success','Password Reset Successfully');
             }
            
        }
        
       $this->load->view('resetpassword',$data);
    }
	
	
	public function mock_paper()
	{
	     $this->load->model('newmodel');
	   
	    $class=$this->input->post('class');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	    
	  // $clevel=$clevel;
// 	  echo $class.$product.$clevel.$period.'ok';die;
	  $this->db->select('*');
	  $this->db->from('mock_papers');
	  //$this->db->where('period_id',$period);
	  $this->db->where('clevel',$clevel);
	  $this->db->where('product_name',$product);
	  $this->db->where('class',$class);
	  $res = $this->db->get();
    
     
	  //echo $this->db->last_query();die;
	    $data['row']=$res->row_array(); 
	    //print_r($data['row']);
       
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../mock_papers/".$file_name;
              //echo $filepath;die;
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
        if(isset($_POST['back'])){
            redirect('cin_login/register', 'refresh');
        }
        $this->load->view('cin_login/mock_paper', $data);
	    
	}
	
	
	public function mock_paper_new()
	{
	    $this->db->select('*'); 
	    $this->db->from('mock_papers');
	    $this->db->where('paper_id',$_POST['paper_id']);
	    $res = $this->db->get();
    
     
	  //echo $this->db->last_query();die;
	    $data['row']=$res->row_array(); 
	    //print_r($data['row']);
       
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../mock_papers/".$file_name;
              //echo $filepath;die;
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
        if(isset($_POST['back'])){
            redirect('cin_login/enroll', 'refresh');
        }
        $this->load->view('cin_login/mock_paper', $data);
	    
	}
	
	
	public function enquiry($id='')
	{
        $data['cin']= $cin = $this->session->userdata('cin');
      
        if(isset($_POST['submit'])){
            $target_dir = FCPATH . "images/evidence/"; // FCPATH is the full path to your CodeIgniter project directory
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $data['message']= "The evidence " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                // echo "Sorry, there was an error uploading your file.";
                $data['message']=$_FILES["fileToUpload"]["error"];
            }
            
            $ticket_number = $this->generateUniqueTicketNumber();
    
            $student = $this->db->get_where('cin_list', array('cin' => $cin))->row();
            $ar = array(
                'cin' => $cin,
                'state_id' => $student->state_id,
                'enquiry_type' => $_POST['enquiry_type'],
                'enquiry' => $_POST['enquiry'],
                'evidence' => $_FILES["fileToUpload"]["name"],  
                'name' => $student->student_name,
                'mobile' => $_POST['mobile'],
                'email' => $_POST['email'],
                'date' => date('Y-m-d'),
                'status' => 'Open',
                'ticket_number'=>$ticket_number
            );



            // print_r($_POST['email']);    die;
                
            $this->db->insert('enquiry',$ar);
            $data['message']='Enquiry Raised ...';
            
            
            

            // echo $ticket_number;die;
                $pas = array(
                    'email' => $_POST['email'],  
                    'otp' => '',  
                    'message' => "We have received your request. You will receive an update from us soon. If you need to communicate anything more, please do not reply to this email raise new support ticket quoting the Ticket Number: $ticket_number."
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


                $pas = array(
                    'email' => 'anupama.kumari@aviansys-tech.com',  
                    'otp' => '',  
                    'message' => "You have received enquiry request. Ticket Number: $ticket_number."
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


            $pas = array(
                    'email' => 'viswanath.singh@aviansys-tech.com',  
                    'otp' => ' CIN:'.$cin,   
                    'message' => "You have received enquiry request. Ticket Number: $ticket_number."
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

                $pas = array(
                    'email' => 'abhishek.saini@aviansys-tech.com',  
                    'otp' => ' CIN:'.$cin,   
                    'message' => "You have received enquiry request. Ticket Number: $ticket_number."
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
            $franchise = $this->db->get_where('franchise', array('state_id' => $student->state_id,'company_email_id != '=>''))->row();
            if(!empty($franchise)){
                $pas = array(
                    'email' => $franchise->company_email_id,  
                    'otp' => ' CIN:'.$cin,  
                    'message' => "You have received enquiry request. Ticket Number: $ticket_number."
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

            }

        }
      
        if(isset($_POST['delete'])){
            // print_r($_POST);die;
            $this->db->where('enquiry_id',$_POST['delete']);
            $this->db->delete('enquiry');
            // echo $this->db->last_query();
        }    
      
            $this->db->select('enquiry.ticket_number,enquiry.enquiry_id,cin_list.cin,cin_list.student_name,cin_list.stud_email,cin_list.stud_phone,cin_list.state_id,enquiry.enquiry,enquiry.date,enquiry.status,enquiry.ticket_number,enquiry.evidence,enquiry_type.enquiry_name');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type','left');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin','left');
            $this->db->where('cin_list.cin', $cin);
            $this->db->where('enquiry.cin',$cin);
            $this->db->order_by('enquiry.enquiry_id','DESC');
            // $this->db->limit('50');
            $query = $this->db->get();
            // echo $this->db->last_query();
            $data['payments']=$query->result_array();
            
            if(empty($data['payments'])){
                $data['message']='No Enquiry Found ...';
            }else{
                $data['message']='Showing All Enquiries...';
            }
        $data['student'] = $this->db->get_where('cin_list', array('cin' => $cin))->row();
           
       $this->load->view('cin_login/enquiry',$data);
    }
    
	
	public function generateUniqueTicketNumber() 
	{
        $prefix = "ST-";
        $isUnique = false;
    
        while (!$isUnique) {
            $ticketNumber = $prefix . uniqid() . '-' . rand(100000, 9999999);
    
            $ci =& get_instance();
            $ci->load->database();
    
            $ci->db->where('ticket_number', $ticketNumber);
            $query = $ci->db->get('enquiry');
            if ($query->num_rows() == 0) {
                
                $isUnique = true;
            }
        }

    return $ticketNumber;
}

}/* END OF CLASS*/