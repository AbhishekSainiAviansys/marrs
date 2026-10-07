<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class school extends CI_Controller
{


 public function __construct() 
	{
        parent::__construct();
        if (!$this->session->userdata('user_id')) { redirect('manage/login/', 'refresh'); }
        $this->load->library('encrypt');
        $this->load->library('session');
	    $this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->library('csv');
// 		$this->load->model('periodmodel');
//         $this->load->model('locationmodel');
//         $this->load->model('schoolmodel');
//         $this->load->model('studentsmodel');
        $this->load->model('franchisemodel');
        // $this->load->model('cinmodel');
        // $this->load->model('manage_schoolmodel');
    }
    
  
    public function competition_extraction()
    {
      
     // echo 'ok';die;
	   
        if (isset($_POST['Search'])) {

            if ($_POST['product'] != 'Select Product') {
        
                if ($_POST['area'] != 'All Area') {
        
                    $data['result'] = $_POST;
        
                    $this->db->select('*,new_cart.Time as reg_date');
                    $this->db->from('new_cart');
        
                    // ✅ IMPORTANT: जोड़ो cin_list (MAIN FIX)
                    $this->db->join('cin_list', 'cin_list.cin = new_cart.cin', 'inner');
        
                    // optional school join
                    if ($_POST['school'] !== 'All') {
                        $this->db->join('school_new', 'school_new.id = cin_list.school_id', 'left');
                    }
        
                    $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = new_cart.clevel');
                    $this->db->join('period', 'period.period_id = new_cart.period_id');
        
                    // ===== REQUIRED FILTERS =====
                    $this->db->where('new_cart.period_id', $_POST['period_id']);
                    $this->db->where('new_cart.product_name', $_POST['product']);
                    $this->db->where('competition_level_byproduct.product_name', $_POST['product']);
                    $this->db->where('new_cart.clevel', $_POST['level']);
                    $this->db->where('new_cart.status', 'Paid');
        
                    // ===== OPTIONAL FILTERS =====
        
                    // ❌ removed duplicate state condition
                    if (!empty($_POST['state_id']) && $_POST['state_id'] != 'All') {
                        $this->db->where('cin_list.state_id', $_POST['state_id']);
                    }
        
                    if (!empty($_POST['school']) && $_POST['school'] != 'All') {
                        $this->db->where('cin_list.school_id', $_POST['school']);
                    }
        
                    if (!empty($_POST['area'])) {
                        $this->db->where('cin_list.franchise_code', $_POST['area']);
                    }
        
                    if (!empty($_POST['series'])) {
                        $this->db->where('cin_list.series', $_POST['series']);
                    }
        
                    if (!empty($_POST['subject'])) {
                        $this->db->where('cin_list.subject', $_POST['subject']);
                    }
        
                    $this->db->group_by('cin_list.cin');
        
                    $query = $this->db->get();
        
                    // DEBUG (optional)
                    // echo $this->db->last_query(); die;
        
                    $data['student'] = $query->result_array();
        
                    if (empty($data['student'])) {
                        $data['message'] = 'No data found with selected parameters...';
                    }
        
                } else {
                    $data['message'] = 'Error: Select one area...';
                }
        
            } else {
                $data['message'] = 'Error: Select product...';
            }
        }
        if(isset($_POST['Export'])){
                        $this->db->select('*');
                        $this->db->from('states');
                       // $this->db->where('state_subdivision_id',$_POST['state_id']);
                       
                       if (!empty($_POST['state_id']) && $_POST['state_id'] != 'All') {
                            $this->db->where('state_subdivision_id', $_POST['state_id']);
                        }
                        $query = $this->db->get();
                        $state=$query->row_array();
                        
                        $state=$state['state_subdivision_name'];
                        
                        $data['result']=$_POST;
                        
                        $this->db->select('*,new_cart.Time as reg_date');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        //$this->db->join('school_new','school_new.id=cin_list.school_id');
                        if ($_POST['school'] !== 'All') {

                        $this->db->join('school_new', 'school_new.id = cin_list.school_id', 'left');
                        
                        }
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id','left');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        //$this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                         if (!empty($_POST['state_id']) && $_POST['state_id'] != 'All') {
                            $this->db->where('cin_list.state_id', $_POST['state_id']);
                        }
                        
                        if($_POST['school']!='All' && $_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        if($_POST['area']!=''){
                            
                            $this->db->where('cin_list.franchise_code',$_POST['area']);
                        }
                        if($_POST['series']!=''){
                            
                            $this->db->where('cin_list.series',$_POST['series']);
                        }
                        if($_POST['subject']!=''){
                            
                            $this->db->where('cin_list.subject',$_POST['subject']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        
                        $query = $this->db->get();
                       // echo $this->db->last_query();die;
                        
                       $orientation=$query->result_array();
                       
                       
                       
                       
                       $n=1;
                      // echo $status;die;
            		 $data = []; 
                    foreach ($orientation as $index => $item) {
                                         $school_name = $item['school_name'] ?? '';
            
                // if school_name empty → fetch using school_id
                if (empty($item['school_name'])) {
            
                    $this->db->select('school_name');
                    $this->db->from('school_new');
                    $this->db->where('id', $item['school_id']);
            
                    $q = $this->db->get();
                    $res = $q->row();
                    $school_name = $res->school_name;
                            
                        }

  
            
                            $this->db->select('*');
                            $this->db->from('cin_result');
                            $this->db->where('product_name',$item['product_name']);
                            $this->db->where('clevel',$item['clevel']);
                            $this->db->where('cin',$item['cin']);
                            $query = $this->db->get();
                            $dd=$query->row();
                            
						  
						    if(!$dd->venue){
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->where('comp_id',$dd->competition_schedule_id);
                                $query = $this->db->get();
                                $ddd=$query->row();
                                if($ddd->center_name){
                                    $center= $ddd->center_name;
                                }
                                else{
                                    $this->db->select('*');
                                    $this->db->from('competition_schedule');
                                    $this->db->where('competition_schedule_id',$dd->competition_schedule_id);
                                    $query = $this->db->get();
                                    $dddd=$query->row();
                                    
                                    $center=  $dddd->center_address;
                                }
                                
						    }
						    if($dd->venue){
						        $center=  $dd->venue;
						        $close_date='';
						    }
						 
						 if(empty($center)){
						                    $this->db->select('*');
                                            $this->db->from('new_cart');
                                            $this->db->where('product_name',$item['product_name']);
                                            $this->db->where('clevel',$item['clevel']);
                                            $this->db->where('cin',$item['cin']);
                                            $query = $this->db->get();
                                            $cd=$query->row();
                            //   print_r($cd->comp_date);          
						        
						                    $this->db->select('*');
                                            $this->db->from('cin_uploade');
                                            $this->db->where('cin',$item['cin']);
                                            $this->db->order_by('cin_uploade.id','DESC');
                                            $query = $this->db->get();
                                            $cp=$query->row();
						        
						        
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->join('competition_product_state','competition_product_state.id=exam_centers.comp_id');
                                $this->db->where('exam_centers.comp_id',$cp->comp_id);
                                $this->db->where('exam_centers.exam_date',$cd->comp_date);
                                $query = $this->db->get();
                                $cds=$query->row();
                                $center=$cds->center_name;
                                
                                $close_date=$cds->exam_date;
						 }
            
    
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                'Yes', 
                $item['academic_year'],
                $item['level_name'],
                $item['reg_date'],
                $school_name,
                $item['city'],
                $item['class'],
                $center,
                $close_date,
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['level_name'].'_'.$state.'_CompetitionRegistartion';
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Competition','Period_id','Level','Time','School Name','School Address','Class','Center Name','Exam Date','Reg Date','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
            $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id >','12');
            $query = $this->db->get();
            $data['loadperiod']=$query->result_array();
           // print_r($franchise);
           
            if(isset($_POST['state_id'])){
                $this->db->select('*');
                $this->db->from('school_new');
                if(isset($_POST['state_id'])){
                $this->db->where('state',$_POST['state_id']);
                }
                if(isset($_POST['area'])){
                $this->db->where('area_code',$_POST['area']);
                }
                $query = $this->db->get();
                $data['schoolload']=$query->result_array();
            }
            
            $this->db->select('*');
            $this->db->from('class');
            // $this->db->where('franchise_id',$franchise_id);
            $query = $this->db->get();
            $data['classload']=$query->result_array();
            
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('status','Active');
            $query = $this->db->get();
            $data['productload']=$query->result_array();
            

            if(isset($_POST['product'])){
                $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                
                $this->db->where('product_name',$_POST['product']);
                $query = $this->db->get();
                $data['levelload']=$query->result_array();
            }
                        

            $this->db->select('*');
            $this->db->from('countries');
            // $this->db->where('country_id','105');
            $query = $this->db->get();
            $data['countryload']=$query->result_array();
            
            if(isset($_POST['country'])){
                $this->db->select('*');
                $this->db->from('states');
                $this->db->where('country_id',$_POST['country']);
                $query = $this->db->get();
                $data['stateload']=$query->result_array();
            }
            
            if(isset($_POST['state_id'])){
                $this->db->select('*');
                $this->db->from('franchise');
                $this->db->where('state_id',$_POST['state_id']);
                $query = $this->db->get();
                $data['franchiseload']=$query->result_array();
            }
            if(isset($_POST['state_id'])){
                $this->db->select('*');
                $this->db->from('areas');
                
                $this->db->where('state_id',$_POST['state_id']);
                
                $query = $this->db->get();
                $data['areaload']=$query->result_array();
            }

        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series']= $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject']= $res->result();
        

       $this->load->view("competition_extraction13.php",$data); 
   }

    public function mock_extraction()
    {
	    if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['product']!='Select Product'){
               
                if($_POST['area']!='All Area'){
                   
                    $data['result']=$_POST;
               
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        if($_POST['area']!='')
                        {
                            $this->db->select('*');
                            $this->db->from('areas');
                            $this->db->where('area_code',$_POST['area']);
                            $query = $this->db->get();
                            $area = $query->row();
                            
                            // print_r($area->area_code);die;
                        }else{
                            $area = '';
                        }
                        
                        
                        $like = $initials.$product_in.$area->area_code;
               
                    //print_R($_POST);die;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$_POST['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['state_id']!='All' && $_POST['state_id']!=''){
                            
                            $this->db->where('cin_list.state_id',$_POST['state_id']);
                        }
                        if($_POST['school']!='All' && $_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        // if($_POST['area']!=''){
                            
                        //     $this->db->where('cin_list.franchise_code',$_POST['area']);
                        // }
                        if ($_POST['mock'] == 'A') {
                            $this->db->where("(new_cart.mock_test = 'Yes' OR new_cart.mock_test_a = 'Yes')");
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        // if($_POST['series']!=''){
                            
                        //     $this->db->where('cin_list.series',$_POST['series']);
                        // }
                        // if($_POST['subject']!=''){
                            
                        //     $this->db->where('cin_list.subject',$_POST['subject']);
                        // }
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                       // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                        if(empty($data['student'])){
                            $data['message']='No data found with selected parameters...';
                        }
                    
                    
                   
                }else{
                $data['message']='Error: Select one area...';
                }    
           }else{
               $data['message']='Error: Select product...';
           }        
                    
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        if($_POST['area']!='')
                        {
                            $this->db->select('*');
                            $this->db->from('areas');
                            $this->db->where('area_code',$_POST['area']);
                            $query = $this->db->get();
                            $area = $query->row();
                            
                            // print_r($area->area_code);die;
                        }else{
                            $area = '';
                        }
                        
                        
                        $like = $initials.$product_in.$area->area_code;
                        
                        $this->db->select('*');
                        $this->db->from('states');
                        $this->db->where('state_subdivision_id',$_POST['state_id']);
                        $query = $this->db->get();
                        $state=$query->row_array();
                        
                        $state=$state['state_subdivision_name'];
                        
                        $data['result']=$_POST;
                        
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$_POST['state_id']);
                        
                        $this->db->like('cin_list.cin',$like);
                        
                        
                        if($_POST['school']!='All' && $_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        // if($_POST['area']!=''){
                            
                        //     $this->db->where('cin_list.franchise_code',$_POST['area']);
                        // }
                        
                        
                        if ($_POST['mock'] == 'A') {
                            $this->db->where("(new_cart.mock_test = 'Yes' OR new_cart.mock_test_a = 'Yes')");
                        }
                        
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        // if($_POST['series']!=''){
                            
                        //     $this->db->where('cin_list.series',$_POST['series']);
                        // }
                        // if($_POST['subject']!=''){
                            
                        //     $this->db->where('cin_list.subject',$_POST['subject']);
                        // }
                        $this->db->group_by('cin_list.cin');
                        
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
            if($item['state_id'] == $_POST['state_id']){
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['level_name'].'_'.$state.'_MockRegistartion';
            }
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Mock Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('school_new');
                            if(isset($_POST['state_id'])){
                            $this->db->where('state',$_POST['state_id']);
                            }
                            if(isset($_POST['area'])){
                            $this->db->where('area_code',$_POST['area']);
                            }
                            $query = $this->db->get();
                            $data['schoolload']=$query->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        if(isset($_POST['product'])){
                            $this->db->select('*');
                            $this->db->from('competition_level_byproduct');
                            
                            $this->db->where('product_name',$_POST['product']);
                            $query = $this->db->get();
                            $data['levelload']=$query->result_array();
                        }
                        
        
                        $this->db->select('*');
                        $this->db->from('countries');
                        // $this->db->where('country_id','105');
                        $query = $this->db->get();
                        $data['countryload']=$query->result_array();
                        
                        if(isset($_POST['country'])){
                            $this->db->select('*');
                            $this->db->from('states');
                            $this->db->where('country_id',$_POST['country']);
                            $query = $this->db->get();
                            $data['stateload']=$query->result_array();
                        }
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('franchise');
                            $this->db->where('state_id',$_POST['state_id']);
                            $query = $this->db->get();
                            $data['franchiseload']=$query->result_array();
                        }
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('areas');
                            
                            $this->db->where('state_id',$_POST['state_id']);
                            
                            $query = $this->db->get();
                            $data['areaload']=$query->result_array();
                        }
        
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series']= $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject']= $res->result();
        
       $this->load->view("mock_extraction13.php",$data); 
   }
    
    public function material_extraction()
    {
	    if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['product']!='Select Product'){
               
                if($_POST['area']!='All Area'){
                   
                    $data['result']=$_POST;
               
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        if($_POST['area']!='')
                        {
                            $this->db->select('*');
                            $this->db->from('areas');
                            $this->db->where('area_code',$_POST['area']);
                            $query = $this->db->get();
                            $area = $query->row();
                            
                            // print_r($area->area_code);die;
                        }else{
                            $area = '';
                        }
                        
                        
                        $like = $initials.$product_in.$area->area_code;
                        
                    //print_R($_POST);die;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$_POST['state_id']);
                        
                        $this->db->like('cin_list.cin',$like);
                        
                        if($_POST['school']!='All' && $_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        // if($_POST['area']!=''){
                            
                        //     $this->db->where('cin_list.franchise_code',$_POST['area']);
                        // }
                        if ($_POST['mock'] == 'A') {
                            $this->db->where("(new_cart.study_material = 'Yes' OR new_cart.study_material_a = 'Yes')");
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        // if($_POST['series']!=''){
                            
                        //     $this->db->where('cin_list.series',$_POST['series']);
                        // }
                        // if($_POST['subject']!=''){
                            
                        //     $this->db->where('cin_list.subject',$_POST['subject']);
                        // }
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                       // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                        if(empty($data['student'])){
                            $data['message']='No data found with selected parameters...';
                        }
                    
                    
                   
                }else{
                $data['message']='Error: Select one area...';
                }    
           }else{
               $data['message']='Error: Select product...';
           }        
                    
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
            
            // print_R($_POST['level');die;
            
            $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id',$_POST['period_id']);
            $query = $this->db->get();
            $period = $query->row();
   
            $initials = $period->initials;
            
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('product_name',$_POST['product']);
            $query = $this->db->get();
            $product = $query->row();
   
            $product_in = $product->in13;
            
            // print_r($_POST['state_id']);die;
            
            if($_POST['area']!='')
            {
                $this->db->select('*');
                $this->db->from('areas');
                $this->db->where('area_code',$_POST['area']);
                $query = $this->db->get();
                $area = $query->row();
                
                // print_r($area->area_code);die;
            }else{
                $area = '';
            }
                        
                        
            $like = $initials.$product_in.$area->area_code;
            
            $this->db->select('*');
            $this->db->from('states');
            $this->db->where('state_subdivision_id',$_POST['state_id']);
            $query = $this->db->get();
            $state=$query->row_array();
            
            $state=$state['state_subdivision_name'];
            
            $data['result']=$_POST;
            
            $this->db->select('*');
            $this->db->from('new_cart');
            $this->db->join('cin_list','new_cart.cin=cin_list.cin');
            $this->db->join('school_new','school_new.id=cin_list.school_id');
            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
            $this->db->join('period','period.period_id=new_cart.period_id');
            $this->db->where('new_cart.period_id',$_POST['period_id']);
            $this->db->where('new_cart.product_name',$_POST['product']);
            $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
            $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
            $this->db->where('new_cart.clevel',$_POST['level']);
            $this->db->where('cin_list.state_id',$_POST['state_id']);
            
            $this->db->like('cin_list.cin',$like);
            
            if($_POST['school']!='All' && $_POST['school']!=''){
                
                $this->db->where('cin_list.school_id',$_POST['school']);
            }
            // if($_POST['area']!=''){
                
                // $this->db->where('cin_list.franchise_code',$_POST['area']);
            // }
            // if($_POST['mock']=='A'){
            //     $this->db->where('new_cart.study_material','Yes');
            //     $this->db->or_where('new_cart.study_material_a','Yes');
            // }
            
            
            if ($_POST['mock'] == 'A') {
                $this->db->where("(new_cart.study_material = 'Yes' OR new_cart.study_material_a = 'Yes')");
            }
            
            
            if($_POST['mock']=='B'){
                $this->db->where('new_cart.study_material_b','Yes');
            }
            if($_POST['mock']=='C'){
                $this->db->where('new_cart.study_material_c','Yes');
            }
            // if($_POST['series']!=''){
                
            //     $this->db->where('cin_list.series',$_POST['series']);
            // }
            // if($_POST['subject']!=''){
                
            //     $this->db->where('cin_list.subject',$_POST['subject']);
            // }
            $this->db->group_by('cin_list.cin');
            
            $query = $this->db->get();
            // echo $this->db->last_query();die;
                        
            $orientation=$query->result_array();
            
            // print_R($orientation[0]);die;
            
            $n=1;
            // echo $status;die;
		    $data = []; 
            foreach ($orientation as $index => $item) {
                if($item['state_id'] == $_POST['state_id']){
                $serial_no = $index + 1;
            
                $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
            
                $data[] = [
                    $serial_no,
                    $item['cin'],
                    $item['student_name'],
                    $item['product_name'],
                    $_POST['mock'], 
                    $item['academic_year'],
                    $item['level_name'],
                    $item['time'],
                    $item['school_name'],
                    $item['city'],
                    $item['class'],
                    $contact_numbers,
                    $contact_emails,
                    $status 
                ];
                $file_name=$item['product_name'].'_'.$item['level_name'].'_'.$state.'_MaterialRegistartion';
                }
            }

	        //	print_r($data);die;
    		header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");
    
            $handle = fopen('php://output', 'w');
            fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Material Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
            $cnt=1;
            foreach ($data as $key) {
                
                fputcsv($handle, $key);
            }
                fclose($handle);
            exit;
        }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       
                       
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('school_new');
                            if(isset($_POST['state_id'])){
                            $this->db->where('state',$_POST['state_id']);
                            }
                            if(isset($_POST['area'])){
                            $this->db->where('area_code',$_POST['area']);
                            }
                            $query = $this->db->get();
                            $data['schoolload']=$query->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
                        if(isset($_POST['product'])){
                            $this->db->select('*');
                            $this->db->from('competition_level_byproduct');
                            
                            $this->db->where('product_name',$_POST['product']);
                            $query = $this->db->get();
                            $data['levelload']=$query->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('countries');
                        // $this->db->where('country_id','105');
                        $query = $this->db->get();
                        $data['countryload']=$query->result_array();
                        
                        if(isset($_POST['country'])){
                            $this->db->select('*');
                            $this->db->from('states');
                            $this->db->where('country_id',$_POST['country']);
                            $query = $this->db->get();
                            $data['stateload']=$query->result_array();
                        }
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('franchise');
                            $this->db->where('state_id',$_POST['state_id']);
                            $query = $this->db->get();
                            $data['franchiseload']=$query->result_array();
                        }
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('areas');
                            
                            $this->db->where('state_id',$_POST['state_id']);
                            
                            $query = $this->db->get();
                            $data['areaload']=$query->result_array();
                        }
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series']= $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject']= $res->result();
        
       $this->load->view("material_extraction13.php",$data); 
   }
   
    public function orientation_extraction()
    {
	    if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['product']!='Select Product'){
               
                if($_POST['area']!='All Area'){
                   
                    $data['result']=$_POST;
                    
                    
                    
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        if($_POST['area']!='')
                        {
                            $this->db->select('*');
                            $this->db->from('areas');
                            $this->db->where('area_code',$_POST['area']);
                            $query = $this->db->get();
                            $area = $query->row();
                            
                            // print_r($area->area_code);die;
                        }else{
                            $area = '';
                        }
                        
                        
                        $like = $initials.$product_in.$area->area_code;
                        
                        // echo $like;die;
                        
                    
                        $this->db->select('new_cart.*,cin_list.*,competition_level_byproduct.level_name,competition_level_byproduct.level_id,period.academic_year,school_new.school_name');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->like('new_cart.cin', $like, 'after');
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$_POST['state_id']);
                        
                        if($_POST['school']!='All' && $_POST['school']!=''){
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        
                        if($_POST['area']!=''){
                            $this->db->where('cin_list.franchise_code',$_POST['area']);
                        }
                        
                        if (!empty($_POST['mock'])) {

                            if ($_POST['mock'] == 'A') {
                               
                                $this->db->where("(new_cart.orientation = 'Yes' OR new_cart.orientation_a = 'Yes')");

                            }
                        
                            if ($_POST['mock'] == 'B') {
                                $this->db->where('new_cart.orientation_b', 'Yes');
                            }
                        
                            if ($_POST['mock'] == 'C') {
                                $this->db->where('new_cart.orientation_c', 'Yes');
                            }
                        }

                        
                        
                        
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        
                        
                        
                        // error_reporting(E_ALL);
                        // ini_set('display_errors', 1);

                    // echo $this->db->last_query();die;
                        
                        $data['student'] = $query->result_array();
                        
                        if(empty($data['student'])){
                            $data['message']='No data found with selected parameters...';
                        }
                    
                    
                   
                        }else{
                        $data['message']='Error: Select one area...';
                        }    
                   }else{
                       $data['message']='Error: Select product...';
                   }        
                            
                   //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
                }
        
        if(isset($_POST['Export'])){
    
                $this->db->select('*');
                $this->db->from('period');
                $this->db->where('period_id', $_POST['period_id']);
                $query = $this->db->get();
                $period = $query->row();
       
                $initials = $period->initials;
                
                $this->db->select('*');
                $this->db->from('products');
                $this->db->where('product_name', $_POST['product']);
                $query = $this->db->get();
                $product = $query->row();
       
                $product_in = $product->in13;
                
                // print_r($_POST['state_id']);die;
                
                if($_POST['area']!='')
                {
                    $this->db->select('*');
                    $this->db->from('areas');
                    $this->db->where('area_code', $_POST['area']);
                    $query = $this->db->get();
                    $area = $query->row();
                    
                    // print_r($area->area_code);die;
                }else{
                    $area = '';
                }
                
                
                $like = $initials.$product_in.$area->area_code;
    
    
                $this->db->select('*');
                $this->db->from('states');
                $this->db->where('state_subdivision_id', $_POST['state_id']);
                $query = $this->db->get();
                $state = $query->row_array();
                
                $state = $state['state_subdivision_name'];
                
                $data['result'] = $_POST;
                
                $this->db->select('*');
                $this->db->from('new_cart');
                $this->db->join('cin_list', 'new_cart.cin=cin_list.cin');
                $this->db->join('school_new', 'school_new.id=cin_list.school_id');
                $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id=new_cart.clevel');
                $this->db->join('period', 'period.period_id=new_cart.period_id');
                $this->db->where('new_cart.period_id', $_POST['period_id']);
                $this->db->where('new_cart.product_name', $_POST['product']);
                $this->db->where('competition_level_byproduct.product_name', $_POST['product']);
                $this->db->where('new_cart.clevel', $_POST['level']);
                $this->db->where('cin_list.state_id', $_POST['state_id']);
                
                $this->db->like('new_cart.cin', $like);
                
                if($_POST['school'] != 'All' && $_POST['school'] != ''){
                    $this->db->where('cin_list.school_id', $_POST['school']);
                }
                if($_POST['area'] != ''){
                    $this->db->where('cin_list.franchise_code', $_POST['area']);
                }
                if ($_POST['mock'] == 'A') {
                       
                        $this->db->where("(new_cart.orientation = 'Yes' OR new_cart.orientation_a = 'Yes')");

                }
                if($_POST['mock'] == 'B'){
                    $this->db->where('new_cart.orientation_b', 'Yes');
                }
                if($_POST['mock'] == 'C'){
                    $this->db->where('new_cart.orientation_c', 'Yes');
                }
                // if($_POST['series'] != ''){
                    
                //     $this->db->where('cin_list.series',$_POST['series']);
                // }
                // if($_POST['subject'] != ''){
                    
                //     $this->db->where('cin_list.subject',$_POST['subject']);
                // }
                $this->db->group_by('cin_list.cin');
                
                $query = $this->db->get();
                //echo $this->db->last_query();die;
                
            $orientation=$query->result_array();
           
            $n=1;
          // echo $status;die;
		    $data = []; 
            foreach ($orientation as $index => $item) {
                
                if($item['state_id'] == $_POST['state_id']){
            
                    $serial_no = $index + 1;
                
                    $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                    $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
                
                    $data[] = [
                        $serial_no,
                        $item['cin'],
                        $item['student_name'],
                        $item['product_name'],
                        $_POST['mock'], 
                        $item['academic_year'],
                        $item['level_name'],
                        $item['time'],
                        $item['school_name'],
                        $item['city'],
                        $item['class'],
                        $contact_numbers,
                        $contact_emails,
                        $status 
                    ];
                    $file_name=$item['product_name'].'_'.$item['level_name'].'_'.$state.'_OrientationRegistartion';
                }
                }

	            //	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Orientation Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
            }

                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('school_new');
                            if(isset($_POST['state_id'])){
                            $this->db->where('state',$_POST['state_id']);
                            }
                            if(isset($_POST['area'])){
                            $this->db->where('area_code',$_POST['area']);
                            }
                            $query = $this->db->get();
                            $data['schoolload']=$query->result_array();
                        }
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        if(isset($_POST['product'])){
                            $this->db->select('*');
                            $this->db->from('competition_level_byproduct');
                            
                            $this->db->where('product_name',$_POST['product']);
                            $query = $this->db->get();
                            $data['levelload']=$query->result_array();
                        }
                        
        
                        $this->db->select('*');
                        $this->db->from('countries');
                        // $this->db->where('country_id','105');
                        $query = $this->db->get();
                        $data['countryload']=$query->result_array();
                        
                        if(isset($_POST['country'])){
                            $this->db->select('*');
                            $this->db->from('states');
                            $this->db->where('country_id',$_POST['country']);
                            $query = $this->db->get();
                            $data['stateload']=$query->result_array();
                        }
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('franchise');
                            $this->db->where('state_id',$_POST['state_id']);
                            $query = $this->db->get();
                            $data['franchiseload']=$query->result_array();
                        }
                        
                        if(isset($_POST['state_id'])){
                            $this->db->select('*');
                            $this->db->from('areas');
                            
                            $this->db->where('state_id',$_POST['state_id']);
                            
                            $query = $this->db->get();
                            $data['areaload']=$query->result_array();
                        }
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series']= $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject']= $res->result();
        
       $this->load->view("orientation_extraction13.php",$data); 
    }
  
  
  
public function index() 
{
   if (isset($_POST['Search']))
	{
		  $validation_field=
		      array(
			           'state_subdivision_id'  =>$this->input->post('state_subdivision_id'), 
					   'school_status'  =>$this->input->post('school_status') 
				 );
		  $this->validation->set_data($validation_field);
		  $this->validation->set_rules('state_subdivision_id', 'State', 'required');
		  $this->validation->set_rules('school_status', 'Status', 'required');
          if ($this->validation->run() === FALSE) 
            {
                /*var_dump($this->validation->show_errors());*/
                $this->notifications->notify('Please Select State', 'error');
            } 
            else
            {		 
			     $search_data=array(
				             'school_status'  =>$this->input->post('school_status'),
							 'state_subdivision_id'  =>$this->input->post('state_subdivision_id'),
							 'franchise_id'  =>$this->input->post('franchise_id'),
							 'school_name'  =>$this->input->post('school_name')
						    );
			    /*echo "<pre>";print_r($search_data);exit;*/
		         $data['school'] =$this->manage_schoolmodel->export_all_schools($search_data);
		        /*echo "<pre>";print_r($data['school']);exit;*/				  
			}
			
			$data['result']=$_POST;
	  }
	
	   if(isset($_POST['Export']))
	     {  
	   
		  
			$search_data=array(
				             'school_status'  =>$this->input->post('school_status'),
							 'state_subdivision_id'  =>$this->input->post('state_subdivision_id'),
							 'franchise_id'  =>$this->input->post('franchise_id'),
							 'school_name'  =>$this->input->post('school_name')
				 
			  );

		   $list_school=$this->manage_schoolmodel->export_all_schools($search_data);
		   /* echo "<pre>";print_r($list_school);exit;*/
		   $listexport_Request=$list_school['schools'];
		   
		   $data = array();
		   $n    = 1;
		   foreach ($listexport_Request as $item) {
			$item['serial_no'] = $n;
			$data[]            = array(
				$item['serial_no'],
				$item['school_code'],$item['access_code'],$item['school_name'],
				$item['school_address'].",".$item['school_address1'].",".$item['[school_city'].",".$item['[school_pincode'],
				$item['school_principal_name'],$item['school_coordinator_name'],
				$item['school_mobile'],$item['school_email'],
				$item['school_stdcode']."-".$item['school_phone'], $item['sh_coordinator_phone'],$item['school_coordinator_email'],
				$item['franchise_code'],$item['state_subdivision_name'],$item['school_status']
			 );
			
			$n++;
		}
		$this->csv->export($data, array(
			'SerialNo','SchoolCode','AccessCode','School Name','Address','Principal Name','Co-ordinator Name','School Mobile','School Email',
			'School Landphone','Co-ordinator Mobile','Co-ordinator Email','Franchise Code','State','School Status'
		), 'Schoollist.csv');
		exit;
		   
	   }
		
		
		
		$data['stateatload'] = $this->locationmodel->get_indian_states();
		$this->load->view("schoolList.php", $data);
		
    } /* End of  index() */    

    public function onlineSchoolRegistrationList()
    {
        if (isset($_POST['submit']))
        {
            $state_id = $this->input->post('state_id');
            $franchise = $this->input->post('franchise');
            $area_code = $this->input->post('area_code');
            $status = $this->input->post('status');
    
            $this->db->select('school_new.*,states.state_subdivision_name,franchise.franchise_code,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('school_new');
            $this->db->join('states','states.state_subdivision_id=school_new.state');
            $this->db->join('franchise','franchise.franchise_id=school_new.franchise_id');
    
            if($status!='All'){
                $this->db->where('school_status',$status);
            }
            if($franchise!='All' && $franchise!=''){
                $this->db->where('school_new.franchise_id',$franchise);
            }
            if($area_code!='All' && $area_code!=''){
                $this->db->where('area_code',$area_code);
            }
    
            //$this->db->where('school_new.profile IS NOT NULL');
            //$this->db->where('school_new.profile !=', "");
            $this->db->where('state', $state_id);
    
            $res = $this->db->get();
            $data['schoolList'] = $res->result_array();
            
            $data['result'] = $_POST;
        }
        else  // ← ADD else here
        {
            $this->db->select('school_new.*,states.state_subdivision_name,franchise.franchise_code,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('school_new');
            $this->db->join('states','states.state_subdivision_id=school_new.state');
            $this->db->join('franchise','franchise.franchise_id=school_new.franchise_id');
            $this->db->where('school_new.profile IS NOT NULL');
            $this->db->where('school_new.profile !=', "");
            $res = $this->db->get();
            $data['schoolList'] = $res->result_array();
        }
    
    
        $data['country']    = $this->db->get_where('countries')->result_array();
        if(isset($data['result']['country'])){
	    $data['state']    = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['period']     = $this->db->get_where('period')->result_array();
        if(isset($data['result']['state_id'])){
        $data['franchise']  = $this->db->get_where('franchise',['state_id'=>$data['result']['state_id']])->result_array();
        }
    
        $this->load->view('online_school_registration.php', $data);
    }
    
    
    public function adminSchooldelete()
    {
         $uri= $this->uri->segment(4);
        $this->db->where('id',$uri);
        $this->db->delete('school_new');
        redirect('manage/school/onlineSchoolRegistrationList');
    }
    
    public function paidschoolcode()
    {

    if (isset($_POST['Search']))
	{
		  $validation_field=
		      array(
			           'school_code'  =>$this->input->post('school_code')  , 
					
				 );
		  $this->validation->set_data($validation_field);
		  $this->validation->set_rules('school_code', 'code', 'required');
          if ($this->validation->run() === FALSE) 
            {
                /*var_dump($this->validation->show_errors());*/
                $this->notifications->notify('Please Select School code', 'error');
            } 
            else
            {		 
			     $search_data=array(
				             'school_code'  =>$this->input->post('school_code'),
							 
						    );
			    /*echo "<pre>";print_r($search_data);exit;*/
		         $data['schools'] =$this->manage_schoolmodel->export_all_paid_schools_code($search_data);
		       // echo "<pre>";print_r($data['school']);exit;				  
			}
			
			$data['result']=$_POST;
	  }
	
	   if(isset($_POST['Export']))
	     {  
	   
		  
			$search_data=array(
				             'school_code'  =>$this->input->post('code'),
							
				 
			  );

		   $list_school=$this->manage_schoolmodel->export_all_paid_schools_code($search_data);
		   /* echo "<pre>";print_r($list_school);exit;*/
		   $listexport_Request=$list_school['schools'];
		   //print_r($listexport_Request);exit;
		   $data = array();
		   $n    = 1;
		   foreach ($listexport_Request as $item) {
			$item['serial_no'] = $n;
			$data[]            = array(
				$item['serial_no'],
				$item['access_code'],$item['school'],
				$item['state'],$item['district'],
				
			 );
			
			$n++;
		}
		$this->csv->export($data, array(
			'SerialNo','School Access Code','School Name','State','District'
		), 'AccesscodePaidSchoollist.csv');
		exit;
		   
	   }
		
		
		
		$data['schoolcode'] = $this->locationmodel->get_paid_school_code();
		$this->load->view("paidschoolListcode.php", $data);


}

   public function index_old()
   {
	   
	   if (isset($_POST['Search'])) 
	  {
		  
		  if($this->input->post('stateID')!='')
		  {
		  
		     $search_data=array(
		                       'stateID'  =>$this->input->post('stateID'),
							   'fr_id'  =>$this->input->post('fr_id'),
							   'school_name'=>$this->input->post('school_name'),
		                    );
				//echo "<pre>";print_r($search_data);exit;			
			 $data['state_wise_schools']=$this->schoolmodel->state_wise_schools($search_data);			
		  
		  } /*end of if($this->input->post('stateID')!='') */
		  
		  else
		  {
			  $data['info']="empty";
		  }
		  
		} /* Else of  if (isset($_POST['Search']))*/
	   
	   if (isset($_POST['Export']))
		{
			$search_data=array(
		                       'stateID'  =>$this->input->post('stateID'),
							   'fr_id'  =>$this->input->post('fr_id'),
							   'school_name'=>$this->input->post('school_name'),
		                    );
				// echo "<pre>";print_r($search_data);exit;			
			 $state_wise_schools=$this->schoolmodel->state_wise_schools($search_data);	
			 $data = array();
			$n    = 1;
			foreach ($state_wise_schools as $item) 
			{
				$item['serial_no'] = $n;
				$data[]            = array(
								$item['serial_no'],
								$item['school_code'],
								$item['access_code'],
								$item['school_name'],
								$item['school_address']."<br>".$item['school_address1'],
								$item['school_city']." pincode:-".$item['school_pincode'],
								$item['school_principal_name'],
								$item['franchise_code'],
								$item['state_subdivision_name'],
								$item['school_stdcode']."-".$item['school_phone'],
								$item['school_mobile'],
								$item['school_email'],
								$item['school_board'],
								$item['school_medium'],
								$item['school_concern_status'],
								$item['school_status'],
								
							);
							/*echo $item['serial_no'];exit;*/
							$n++;
					}
					$this->csv->export($data, array(
						'serialno','School Code ','Access Code','School','School Address ','City with pincode','Principal ',
						'Franchisee Code ','State','Phone','Mobile','Email','Board','School Medium','Concern Status','School Status',
					), 'schoollist.csv');
					exit;
		}
	   
	   
        $data['stateatload'] = $this->locationmodel->get_indian_states();
		$data['fr_id']=$fr_id;
		$data['stateID']=$stateID;
		$data['school_name']=$school_name;
        $this->load->view("schoolList.php", $data);
		
  }/*end function index*/
     
/*  --------------------------------------- ------------------------------------------ ----------------------------  */

	public function view()
	{
		extract($_FILES);
        $uri = $this->uri->uri_to_assoc(4);
		$school_id=$uri['id'];
		$school_data['school'] =$this->schoolmodel->getschool($school_id);
		$this->load->view("schoolProfile.php", $school_data);
		
	} /* End of function View*/

/*  --------------------------------------- ------------------------------------------ ----------------------------  */

    public function edit2() 
	{
        $uri               = $this->uri->segment(4);
       $data['school_id'] = $uri;
       $schoolID          = $uri;
       if (isset($_POST['submit'])) 
	   {
           $scd       = $this->input->post('school_created_date');
           $timestamp = strtotime($scd);
           $cdate     = date('Y-m-d', $timestamp);
           $franchise_id = $this->input->post('franchise_id');
		   $val_insert_data      = array(
								'school_name'        => $this->input->post('school_name'),
								'affiliation_number' => $this->input->post('affiliation_number'),
								'school_code'        => $nschoolcode,
								'school_address'     => $this->input->post('school_address'),
								'school_address1'    => $this->input->post('school_address1'),
								'principal_titile'   => $this->input->post('principal_titile'),
								'school_principal_name'    => $this->input->post('school_principal_name'),
								'coordinator_titile'       => $this->input->post('coordinator_titile'),
								'school_coordinator_name'  => $this->input->post('school_coordinator_name'),
								'school_coordinator_email' => $this->input->post('school_coordinator_email'),
								'school_c_countrycode'     => $this->input->post('school_c_countrycode'),
								'sh_coordinator_phone'     => $this->input->post('sh_coordinator_phone'),
								'country_id'               => $this->input->post('country_id'),
								'stateID'                  => $this->input->post('stateID'),
								'school_city'              => $this->input->post('school_city'),
								'school_stdcode'           => $this->input->post('school_stdcode'),
								'school_phone'             => $this->input->post('school_phone'),
								'school_countrycode'       => $this->input->post('school_countrycode'),
								'school_mobile'            => $this->input->post('school_mobile'),
								'school_email'             => $this->input->post('school_email'),
								'school_board'             => $this->input->post('school_board'),
								'school_medium'            => $this->input->post('school_medium'),
								'school_concern_status'    => $this->input->post('school_concern_status'),
								'school_pincode'           => $this->input->post('school_pincode'),
								'school_latitude'          => $this->input->post('school_latitude'),
								'school_longitude'         => $this->input->post('school_longitude'),
								'school_created_date'      => $cdate
							);
            $this->validation->set_data($val_insert_data);
            $this->validation->set_rules('school_name', 'school name', 'required');
            $this->validation->set_rules('affiliation_number', 'affiliation number', 'required');
            $this->validation->set_rules('school_address', 'school address1', 'required');
            $this->validation->set_rules('school_address1', 'school address2', 'required');
            $this->validation->set_rules('principal_titile', 'title', 'required');
            $this->validation->set_rules('school_principal_name', 'principal name', 'required');
            $this->validation->set_rules('coordinator_titile', 'Title', 'required');
            $this->validation->set_rules('school_coordinator_name', 'school coordinator name', 'required');
            $this->validation->set_rules('school_coordinator_email', 'school coordinator email','trim|required|valid_email|xss_clean');
            $this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
            $this->validation->set_rules('school_c_countrycode', 'Country code', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'state', 'required');
            $this->validation->set_rules('school_city', 'school city', 'required');
            $this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
            $this->validation->set_rules('school_phone', 'school phone', 'required');
            $this->validation->set_rules('school_mobile', 'school mobile', 'required');
            $this->validation->set_rules('school_countrycode', 'countrycode', 'required');
            $this->validation->set_rules('school_email', 'school email', 'trim|required|valid_email|xss_clean');
            $this->validation->set_rules('school_board', 'school board', 'required');
            $this->validation->set_rules('school_medium', 'school medium', 'required');
            $this->validation->set_rules('school_concern_status', 'school concern status', 'required');
            $this->validation->set_rules('school_pincode', 'school pincode', 'required');
            $this->validation->set_rules('school_latitude', 'school latitude', 'required');
            $this->validation->set_rules('school_longitude', 'school longitude', 'required');
            $this->validation->set_rules('school_created_date', 'school created date', 'required');
           /*$this->validation->set_rules('is_competition_center', 'competition center', 'required');
             $this->validation->set_rules('school_email1', 'does not match  Email','matches[school_email]|trim|required|valid_email|xss_clean');         
             $this->validation->set_rules('school_coordinator_email1', 'does not match  Email','matches[school_coordinator_email]|trim|required|valid_email|xss_clean'); */  
		   
		   if ($this->validation->run() === FALSE)
		   {
               $this->notifications->notify('Please make all entries', 'error');   /*echo 	var_dump($this->validation->show_errors());*/
           } 
		   else 
		   {
			  $school_insert_status=$this->schoolmodel->insert($val_insert_data,$franchise_id,$schoolID, $is_competition_center);
			  if($school_insert_status)
			  {
                $this->notifications->notify('School updated successfully', 'success');
			  }
			  else
			  {
                $this->notifications->notify('School updated failed', 'error');
			  }
              redirect('manage/school/', 'refresh');
           }
        }/*end if isset submit*/
    
      $data['result'] = $_POST;
      $data['mode']        = 'Edit';
      $data['result']      = $this->schoolmodel->getschool($schoolID);
	  
      $data['countries']   = $this->locationmodel->listCountries();
      $data['stateatload'] = $this->locationmodel->getstateatload();
      $data['franchise'] = $this->franchisemodel->listFranchise();
      $this->load->view("schoolAdd.php", $data);
  
  }/*end function edit*/

public function edit()
{
    $schoolID = $this->uri->segment(4);

    if (!$schoolID) {
        $this->notifications->notify('Invalid school selected', 'error');
        redirect('manage/school/', 'refresh');
        return;
    }

    // ADJUST THIS: table name + primary key column for schools
    $result = $this->db->get_where('school_new', array('id' => $schoolID))->row();

    if (!$result) {
        $this->notifications->notify('School not found', 'error');
        redirect('manage/school/', 'refresh');
        return;
    }

    // ADJUST THIS: table/column names for countries
    $country = $this->db->get('countries')->result_array();

    // States scoped to the school's saved country, so the initial render
    // (before the JS cascade fires) already shows the right list and the
    // saved stateID can actually be matched/selected in the view.
    $stateatload = array();
    if (!empty($result->country)) {
        $stateatload = $this->db
            ->get_where('states', array('country_id' => $result->country))
            ->result_array();
    } 

    // Franchises scoped to the school's saved state — same reasoning.
    // ADJUST THIS: confirm the FK column name on the franchise table
    // (assumed here to be `stateID` to match the states table's PK).
    $franchise = array();
    if (!empty($result->franchise_id)) {
        $franchise = $this->db
            ->get_where('franchise')
            ->result_array();
    }

    $data['school_id']   = $schoolID;
    $data['studentID']   = $schoolID; // view uses $studentID for Edit/Add label + breadcrumb
    $data['mode']        = 'Edit';
    $data['result']      = $result;
    $data['country']     = $country;
    $data['stateatload'] = $stateatload;
    $data['franchise']   = $franchise;

    $this->load->view("school_edit.php", $data);
}
 
/**
 * Handles the school update form submission.
 * URL pattern: .../manage/school/update/<school_id>
 */
public function update()
{
     $schoolID = $this->input->post('school_id');
 
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirect('manage/school/edit/' . $schoolID, 'refresh');
        return;
    }
   
    $franchise_id = $this->input->post('franchise');
 
    $val_update_data = array(
        'country'                    => $this->input->post('country_id'),
        'state'                       => $this->input->post('stateID'),
        'area_code'                     => $this->input->post('area_code'),
        'franchise_id'                  => $franchise_id, // ADJUST THIS: confirm this column exists on schools table
 
        'school_name'                   => $this->input->post('school_name'),
        'affiliation_number'            => $this->input->post('affiliation_number'),
        'school_phone'                  => $this->input->post('school_phone'),
        'school_mobile'                 => $this->input->post('school_mobile'),
        'school_address'                => $this->input->post('school_address'),
      
        'school_email'                  => $this->input->post('school_email'),
        'school_board'                  => $this->input->post('school_board'),
        'school_medium'                 => $this->input->post('school_medium'),
 
        'school_principal_name'          => $this->input->post('principal_first_name'),
        'principal_email'               => $this->input->post('principal_email'),
        'principal_phone'               => $this->input->post('principal_phone'),
 
        'school_coordinator_name' => $this->input->post('school_coordinator_first_name'),
        'school_coordinator_email'      => $this->input->post('school_coordinator_email'),
        'coordinator_phone'      => $this->input->post('school_coordinator_phone'),
    );
    
 
    // --- Perform update directly against the DB ---
    // ADJUST THIS: table name + primary key column
    $this->db->where('id', $schoolID);
    $school_update_status = $this->db->update('school_new', $val_update_data);
 
    if ($school_update_status) {
        $this->notifications->notify('School updated successfully', 'success');
    } else {
        $this->notifications->notify('School update failed', 'error');
    }
 
    redirect('manage/franchise/schooListView/');
}
/*  --------------------------------------- ------------------------------------------ ----------------------------  */

    public function delete() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $schoolID = $uri['id'];
            $this->notifications->notify('School Deleted successfully', 'success');
            $this->schoolmodel->changeStatus($schoolID);
            redirect('manage/school/', 'refresh');
        }
    }/*end function delete*/


/*  --------------------------------------- ------------------------------------------ ----------------------------  */
    
	public function Pending()
	{
        $params = array(
                         'status' => 'Pending'
                       );
        $data['plist'] = $this->schoolmodel->listschool($params);
        $this->load->view("schoolPendingList.php", $data);
    }/*end function pending*/
	
	
/*  --------------------------------------- ------------------------------------------ ----------------------------  */
	
	
   public function approve()
   {
        $uri = $this->uri->uri_to_assoc(4);
        $schoolID = $uri['id'];
        $getschool= $this->schoolmodel->getschool($schoolID);
        $franchise_refID= $getschool['franchise_id'];
        $getFranchise =  $this->franchisemodel->getFranchise($franchise_refID);
	    $pFranchiseCode =  $getFranchise['franchise_code'];
        $schoolcode = $this->schoolmodel->getlastschoolcode($pFranchiseCode);
        $output = str_split($schoolcode,4);
        $scode=$output[1];

        if($scode=='')
        {
	      $scode='1000';
        }
        $sc=$scode+1;
        $nschoolcode= $pFranchiseCode.'S'.$sc;  
        if (isset($uri['id']))
	    {
            $schoolID = $uri['id'];
            $status   = 'Active';
            $this->schoolmodel->changeStatus($schoolID, $status,$nschoolcode);
            redirect('manage/school/Pending', 'refresh');
        }
   }/*end function approve*/

/*  --------------------------------------- ------------------------------------------ ----------------------------  */


public function export(){
		$this->load->library('csv');
        $listschool= $this->schoolmodel->listschool($params);   	
		$data=array();	
		foreach($listschool as $item){
			$data[] =array(
				$item['school_name'],
				$item['principal_titile'] . " " .$item['school_principal_name']  ,
				$item['school_phone']  ,
				$item['school_email']  ,
				$item['school_city']  
			);
		}
		$this->csv->export($data,array('School Name','Principal Name','School Phone',	'School Email','City'),'schools.csv');
		exit;
	}
	 
	 
	 
	 
	public function import(){
		 	 if (isset($_POST['Filesubmit'])) {
			$this->load->library('csv');
		   $data = $this->csv->getContent($_FILES["file"]["tmp_name"]);
			unset($data[0],$data[1]);
			$importData =array();
			foreach($data as $item){
				
			}
 		 echo '<pre>'; print_r($data);
			  exit;
			
			}
			    $this->load->view("csvUpload.php", $data);
	}
	
	
	
		
    public function add() {
          if (isset($_POST['submit'])) {
            $scd       = $this->input->post('school_created_date');
            $timestamp = strtotime($scd);
            $cdate     = date('Y-m-d', $timestamp);
         $franchise_id = $this->input->post('franchise_id');
          $franchise_refID= $this->input->post('franchise_id');
        $getFranchise =  $this->franchisemodel->getFranchise($franchise_refID);
	    $pFranchiseCode =  $getFranchise['franchise_code'];
  $schoolcode = $this->schoolmodel->getlastschoolcode($pFranchiseCode);
$output = str_split($schoolcode,4);
 $scode=$output[1];

if($scode=='')
{
	$scode='1000';
}
 $sc=$scode+1;
 
    $nschoolcode= $pFranchiseCode.'S'.$sc;  
          $is_competition_center = $this->input->post('is_competition_center');
            $schoolID="";
            $data      = array(               
                'school_name' => $this->input->post('school_name'),
                'affiliation_number' => $this->input->post('affiliation_number'),
                'school_code' => $nschoolcode,
                'school_address' => $this->input->post('school_address'),
                'school_address1' => $this->input->post('school_address1'),
                'principal_titile' => $this->input->post('principal_titile'),
                'school_principal_name' => $this->input->post('school_principal_name'),
                'coordinator_titile' => $this->input->post('coordinator_titile'),
                'school_coordinator_name' => $this->input->post('school_coordinator_name'),
                'school_coordinator_email' => $this->input->post('school_coordinator_email'),
                'school_c_countrycode' => $this->input->post('school_c_countrycode'),
                'sh_coordinator_phone' => $this->input->post('sh_coordinator_phone'),
                'country_id' => $this->input->post('country_id'),
                'stateID' => $this->input->post('stateID'),
                'school_city' => $this->input->post('school_city'),
                'school_stdcode' => $this->input->post('school_stdcode'),
                'school_phone' => $this->input->post('school_phone'), 
                     'school_countrycode' => $this->input->post('school_countrycode'),
                'school_mobile' => $this->input->post('school_mobile'),
                'school_email' => $this->input->post('school_email'),
                'school_board' => $this->input->post('school_board'),
                'school_medium' => $this->input->post('school_medium'),
                'school_concern_status' => $this->input->post('school_concern_status'),
                'school_pincode' => $this->input->post('school_pincode'),
                'school_latitude' => $this->input->post('school_latitude'),
                'school_longitude' => $this->input->post('school_longitude'),
                'school_created_date' => $cdate,
				'school_status'  => 'Active'
            );
            $this->validation->set_data($data);
             $this->validation->set_rules('school_name', 'school name', 'required');
             $this->validation->set_rules('affiliation_number', 'affiliation number', 'required');
            $this->validation->set_rules('school_address', 'school address1', 'required');
                $this->validation->set_rules('school_address1', 'school address2', 'required');
                 $this->validation->set_rules('principal_titile', 'title', 'required');
            $this->validation->set_rules('school_principal_name', 'principal name', 'required');
             $this->validation->set_rules('coordinator_titile', 'Title', 'required');
            $this->validation->set_rules('school_coordinator_name', 'school coordinator name', 'required');
            $this->validation->set_rules('school_coordinator_email', 'school coordinator email','trim|required|valid_email|xss_clean');
  /*$this->validation->set_rules('school_coordinator_email1', 'does not match  Email','matches[school_coordinator_email]|trim|required|valid_email|xss_clean');*/   
            $this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
            $this->validation->set_rules('school_c_countrycode', 'Country code', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('stateID', 'state', 'required');
            $this->validation->set_rules('school_city', 'school city', 'required');
            $this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
            $this->validation->set_rules('school_phone', 'school phone', 'required');
              $this->validation->set_rules('school_mobile', 'school mobile', 'required');
            $this->validation->set_rules('school_countrycode', 'countrycode', 'required');
            $this->validation->set_rules('school_email', 'school email', 'trim|required|valid_email|xss_clean');
              /*$this->validation->set_rules('school_email1', 'does not match  Email','matches[school_email]|trim|required|valid_email|xss_clean');  */       
            $this->validation->set_rules('school_board', 'school board', 'required');
            $this->validation->set_rules('school_medium', 'school medium', 'required');
            $this->validation->set_rules('school_concern_status', 'school concern status', 'required');
            $this->validation->set_rules('school_pincode', 'school pincode', 'required');
            $this->validation->set_rules('school_latitude', 'school latitude', 'required');
            $this->validation->set_rules('school_longitude', 'school longitude', 'required');
            $this->validation->set_rules('school_created_date', 'school created date', 'required');
           /* $this->validation->set_rules('is_competition_center', 'competition center', 'required');*/
            if ($this->validation->run() === FALSE) {
              /* var_dump($this->validation->show_errors());*/
                                
                $this->notifications->notify('Please make all entries', 'error');
            } else {
            	$this->notifications->notify('School added successfully', 'success');
                $this->schoolmodel->insert($data,$franchise_id,$schoolID,$is_competition_center);
                redirect('manage/school/', 'refresh');
                
            }
            $data['result'] = $_POST;
        }/*end if isset submit*/
        $data['countries']   = $this->locationmodel->listCountries();
        $data['stateatload'] = $this->locationmodel->getstateatload();
         $data['franchise'] = $this->franchisemodel->listFranchise();
        $this->load->view("schoolAdd.php", $data);
    }/*end function add*/
    public function getstate() {
        $data['res'] = $this->locationmodel->listStates();
        $this->load->view("getStateAjax.php", $data);
    }/*end function getstate*/
	


/*** new code ***/


public function schoolcode()
{

if (isset($_POST['Search']))
	{
		  $validation_field=
		      array(
			           'school_code'  =>$this->input->post('school_code')  , 
					
				 );
		  $this->validation->set_data($validation_field);
		  $this->validation->set_rules('school_code', 'code', 'required');
          if ($this->validation->run() === FALSE) 
            {
                /*var_dump($this->validation->show_errors());*/
                $this->notifications->notify('Please Select School code', 'error');
            } 
            else
            {		 
			     $search_data=array(
				             'school_code'  =>$this->input->post('school_code'),
							 
						    );
			    /*echo "<pre>";print_r($search_data);exit;*/
		         $data['schools'] =$this->manage_schoolmodel->export_all_schools_code($search_data);
		        /*echo "<pre>";print_r($data['school']);exit;*/				  
			}
			
			$data['result']=$_POST;
	  }
	
	   if(isset($_POST['Export']))
	     {  
	   
		  
			$search_data=array(
				             'school_code'  =>$this->input->post('code'),
							
				 
			  );

		   $list_school=$this->manage_schoolmodel->export_all_schools_code($search_data);
		   /* echo "<pre>";print_r($list_school);exit;*/
		   $listexport_Request=$list_school['schools'];
		   //print_r($listexport_Request);exit;
		   $data = array();
		   $n    = 1;
		   foreach ($listexport_Request as $item) {
			$item['serial_no'] = $n;
			$data[]            = array(
				$item['serial_no'],
				$item['access_code'],$item['school'],
				$item['state'],$item['district'],
				
			 );
			
			$n++;
		}
		$this->csv->export($data, array(
			'SerialNo','School Access Code','School Name','State','District'
		), 'AccesscodeSchoollist.csv');
		exit;
		   
	   }
		
		
		
		$data['schoolcode'] = $this->locationmodel->get_school_code();
		$this->load->view("schoolListcode.php", $data);


}
public function student_list(){
        echo 'ok';die;
    }

}/*end class school*/

