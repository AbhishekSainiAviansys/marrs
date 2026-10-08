<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
class Lunar extends CI_Controller 
{
    
    public function __construct() 
    {
			parent::__construct();
			if (!$this->session->userdata('user_id')) 
			{
				redirect('manage/login/', 'refresh');
			}
			
			$this->load->library('encrypt');
 			$this->load->library('email');
			$this->load->library('csv');
			$this->load->library('session');
			$this->load->library('upload');
			$this->load->library('form_validation');
			$this->load->library('validation');
        	$this->load->model('franchisemodel');
			$this->load->model('schoolmodel');
		    $this->load->model('lunarmodel');
        // 	echo 'ok';die;
    }
         
    
    
    public function index()
    {
        echo 'okk';die;
        echo $this->session->userdata('user_id');
    }
    
    
    
    public function export_cin()
    {
        
        if(isset($_POST['submit'])){
            $data['result']=$_POST;
            // print_r($_POST);die;
            $this->db->select('lunar_cin_list.student_name,lunar_cin_list.subject,lunar_cin_list.series,product_purchase.clevel,lunar_cin_list.class,product_purchase.cin,product_purchase.prid,school_new.school_name,students.email,students.mobile,lunar_cin_list.franchise_code,students.address1,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('product_purchase');
            $this->db->join('lunar_cin_list','lunar_cin_list.cin=product_purchase.cin');
            $this->db->join('students','students.PRID=product_purchase.prid','LEFT');
            $this->db->join('school_new','school_new.id=lunar_cin_list.school_id','LEFT');
            $this->db->join('franchise','franchise.franchise_id=lunar_cin_list.franchise_id','LEFT');
            if($_POST['school']!='All'){
                $this->db->where('school_new.id',$_POST['school']);
            }
            $this->db->where('product_purchase.product_name','Lunar Skill Test');
            $this->db->where('lunar_cin_list.franchise_code',$_POST['area']);
            $this->db->group_by('product_purchase.cin');
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            $data['pay_list']=$query->result();
        }
        
        if (isset($_POST['Export'])) {
            $this->db->select('lunar_cin_list.student_name,lunar_cin_list.subject,lunar_cin_list.series,product_purchase.clevel,lunar_cin_list.class,product_purchase.cin,product_purchase.prid,school_new.school_name,students.email,students.mobile,lunar_cin_list.franchise_code,students.address1,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('product_purchase');
            $this->db->join('lunar_cin_list','lunar_cin_list.cin=product_purchase.cin');
            $this->db->join('students','students.PRID=product_purchase.prid','LEFT');
            $this->db->join('school_new','school_new.id=lunar_cin_list.school_id','LEFT');
            $this->db->join('franchise','franchise.franchise_id=lunar_cin_list.franchise_id','LEFT');
            if($_POST['school']!='All'){
                $this->db->where('school_new.id',$_POST['school']);
            }
            $this->db->where('product_purchase.product_name','Lunar Skill Test');
            $this->db->where('lunar_cin_list.franchise_code',$_POST['area']);
            $this->db->group_by('product_purchase.cin');
            $query=$this->db->get();
        
            $students = $query->result();
            $data = [];
            $n = 0;

                foreach ($students as $item) {
                    $serial_no = $n + 1; // Increment the serial number
                    $data[] = [
                        'serial_no' => $serial_no,
                        'cin' => $item->cin,
                        'prid' => $item->prid,
                        'subject'=>$item->subject,
                        'series'=>$item->series,
                        'student_name' => $item->student_name,
                        'school_name' => $item->school_name,
                        'class' => $item->class,
                        'mobile' => $item->mobile,
                        'email' => $item->email,
                        'franchise_code' => $item->franchise_code
                    ];
            
                    $file_name = $item->franchise_code . '_Lunar Skill Test' . '_CIN_PRID';
                    $n++;
                }

    
                header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
            
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Serial No', 'CIN', 'PRID','Subject','Series', 'Student Name', 'School', 'Class', 'Mobile', 'Email', 'Area Code']);
            
                foreach ($data as $key) {
                    fputcsv($handle, $key);
                }
                fclose($handle);
                exit;
            }

        
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
            }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        if(isset($data['result']['area'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        $this->load->view('export_cin_lunar',$data);
    }
    
    
    
   /**
 * Search + Export dono yahi query use karenge.
 */
private function _cin_export_query($post)
{
    $this->db->select('*');
    $this->db->from('cin_list');
    $this->db->join('period', 'period.period_id = cin_list.period_id');
   // $this->db->join('associates', 'associates.associate_id = cin_list.associate_id', 'left');

    $this->db->where('cin_list.cin LIKE', '%26LU%');
    $this->db->where('cin_list.period_id', $post['period']);

    // Class
    if (!empty($post['class']) && $post['class'] != 'All') {
        $this->db->where('cin_list.class', $post['class']);
    }

    // Subject (cin_list.subject mein id ho ya name, dono match karega)
    // if (!empty($post['subject'])) {
    //     $sub = $this->db->get_where('lunar_subjects', ['sub_id' => $post['subject']])->row_array();
    //     $this->db->group_start();
    //     $this->db->where('cin_list.subject', $post['subject']);
    //     if ($sub) {
    //         $this->db->or_where('cin_list.subject', $sub['sub_name']);
    //     }
    //     $this->db->group_end();
    // }

    // Program (student ne jo program Paid order mein kharida hai)
    if (!empty($post['program'])) {
        $pid = (int) $post['program'];
        $this->db->where(
            "EXISTS (SELECT 1 FROM orders o
                     JOIN order_items oi ON oi.order_id = o.id
                     WHERE o.status = 'Paid'
                       AND oi.program_id = {$pid}
                       AND (o.cin = cin_list.prid OR o.cin = cin_list.cin))",
            NULL, FALSE
        );
    }

    $this->db->group_by('cin_list.cin');
    return $this->db->get()->result();
}

public function export_cin_all()
{
    if (isset($_POST['submit'])) {
        $data['result']   = $_POST;
        $data['pay_list'] = $this->_cin_export_query($_POST);
        $data['message']  = !empty($data['pay_list']) ? 'Student Find Successfully ...' : 'No Data Found..';
    }

    if (isset($_POST['Export'])) {
        $students = $this->_cin_export_query($_POST);

        $rows = [];
        $n = 1;
        foreach ($students as $item) {
            if (empty($item->school_name)) {
                $s = $this->db->get_where('school_new', ['id' => $item->school_id])->row();
                $school_name = $s ? $s->school_name : '';
            } else {
                $school_name = $item->school_name;
            }

            $rows[] = [
                $n++,
                $item->cin,
                $item->prid,
                $item->subject,
                'Series-' . $item->series,
                $item->student_name,
                $item->class,
                $school_name,
                $item->stud_phone,
                $item->stud_email,
                trim($item->first_name . ' ' . $item->last_name),
                $item->address1,
            ];
        }

        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"Lunar_CIN_List.csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Serial No','CIN','PRID','Subject','Series','Student Name','Class','School','Mobile','Email','Associate','Address']);
        foreach ($rows as $r) { fputcsv($handle, $r); }
        fclose($handle);
        exit;
    }

    $data['programs']   = $this->db->get('lunar_programs')->result_array();
    $data['periodload'] = $this->db->where('period_id >', 13)->get('period')->result_array();
    $data['subject']    = $this->db->get('lunar_subjects')->result_array();
    // $data['classload'] bhi agar pehle yahan set hota tha to waise hi rakho

    $this->load->view('export_cin_lunar_all', $data);
}

/**
 * AJAX Delete: cin_list + uske cin_result / new_cart rows
 */
public function delete_cin()
{
    $cin = trim((string) $this->input->post('cin'));
    if ($cin === '') {
        echo json_encode(['success' => false, 'message' => 'CIN missing']);
        return;
    }

    $this->db->trans_start();
    $this->db->delete('cin_result', ['cin' => $cin]);
    $this->db->delete('new_cart',   ['cin' => $cin]);
    $this->db->delete('cin_list',   ['cin' => $cin]);
    $this->db->trans_complete();

    echo json_encode(['success' => $this->db->trans_status() !== FALSE]);
}
    
    
    
    public function export_result()
    {
     
        if(isset($_POST['submit'])){
        
    	    $this->db->select('*');
    		$this->db->from('cin_result');
    		$this->db->join('cin_list','cin_list.cin=cin_result.cin');
    		$this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
    		$this->db->join('period','period.period_id=cin_result.period_id');
    		$this->db->where('cin_result.period_id',$this->input->post('period'));
    		if($_POST['status'] !='All'){
    		    $this->db->where('status',$this->input->post('status'));
    		}
    		if($_POST['class'] !='All'){
    		    $this->db->where('cin_list.class',$this->input->post('class'));
    		}
    		
    		$this->db->where('cin_result.subject',$this->input->post('subject'));
    		$this->db->where('cin_result.series',$this->input->post('series'));
    		$this->db->where('cin_result.type',$this->input->post('type'));
    		$this->db->where('cin_result.clevel',$this->input->post('level'));
    		
    		$res = $this->db->get();
    		$data['students']= $res->result_array();
		
            if(empty($data['students'])){
                $data['message']='No student result found with selected parameters ...';
            }
            $data['result']=$_POST; 
        }
     
     
        if(isset($_POST['Export'])){
            
            $this->db->select('*');
    		$this->db->from('cin_result');
    		$this->db->join('cin_list','cin_list.cin=cin_result.cin');
    		$this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=cin_result.clevel');
    		$this->db->join('period','period.period_id=cin_result.period_id');
    		$this->db->where('cin_result.period_id',$this->input->post('period'));
    		if($_POST['status'] !='All'){
    		    $this->db->where('status',$this->input->post('status'));
    		}
    		if($_POST['class'] !='All'){
    		    $this->db->where('cin_list.class',$this->input->post('class'));
    		}
    		
    		$this->db->where('cin_result.subject',$this->input->post('subject'));
    		$this->db->where('cin_result.series',$this->input->post('series'));
    		$this->db->where('cin_result.type',$this->input->post('type'));
    		$this->db->where('cin_result.clevel',$this->input->post('level'));
    		
    		$res = $this->db->get();
    		
    		
    		$students= $res->result_array();
    		
            $n=1;
            //  print_r($students);die;
            $level_by = $this->db->get_where('competition_level_byproduct',array('level_id'=>$students[0]['clevel']))->row()->level_name;
    		
    		$data=array(); 	
    		
                foreach ($students as $item) {
                    if (!empty($item['competition_schedule_id'])) {
                        $competition_schedule = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $item['competition_schedule_id']))->row();
                        $item['competition_date'] = $competition_schedule->competition_date;
                        $item['venue'] = $competition_schedule->center_address;
                    } else {
                        $item['competition_date'] = $item['competition_date'];
                        $item['venue'] = empty($item['venue']) ? '' : $item['venue'];
                    }
                    $data[] = array(
                        $n,
                        $item['cin'],
                        $item['student_name'],
                        $item['school_name'],
                        $item['class'],
                        $item['stud_phone'],
                        $item['stud_email'],
                        $item['status'],
                        $item['rank'],
                        $item['grade'],
                        $item['level_name'],
                        $item['product_name'],
                        $item['marks'],
                        $item['performer'],
                        $item['speller'],
                        $item['competition_date'],
                        $item['venue'],
                        $item['series'],
                        $item['subject'],
                        $item['type']
                    );
                    $n++;
                    $level_name=$item['level_name'];
                    $series=$item['series'];
                    $subject=$item['subject'];
                    $type=$item['type'];
                }
		
	            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$state))->row()->state_subdivision_name;
     
	            $file_name='Lunar_'.$level_name.'_Result_'.$type.'_'.$subject.'_'.$series;
	            //echo $file_name;die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Mobile','Email','Status','Rank','Grade','Level','Product name','Marks','Performer','Speller','Date','Venue','Series','Subject','Type'));
                $cnt=1;
                
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                
        }
        
		
        $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		$this->db->where('product_name','Lunar Skill Test');
		$res = $this->db->get();
		$data['level_load']= $res->result_array();
		
		$this->db->select('*');
		$this->db->from('class');
		$res = $this->db->get();
		$data['classload']= $res->result_array();
     
        $this->db->select('series');
		$this->db->from('cin_result');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series']= $res->result();
		
		$this->db->select('Subject_key');
		$this->db->from('subjects');
		$res = $this->db->get();
		$data['subject']= $res->result();
     
        $this->db->select('type');
		$this->db->from('cin_result');
		$this->db->where('type !=','');
		$this->db->group_by('type');
		$res = $this->db->get();
		$data['type']= $res->result();
     
        $this->load->view("resultexport_lunar.php",$data);
 
    }
    
    
    
    public function add_subject()
    {
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $ubject = $this->db->get_where('lunar_subjects', ['sub_name' => $_POST['sub_name']])->row();
            if(empty($ubject)){
                $ar=array(
                    'sub_name'=>$_POST['sub_name'],
                    'subject_key'=>strtoupper($_POST['sub_name']),
                    'status'=>'Active'
                    );
                $this->db->insert('lunar_subjects',$ar);
                $data['message']='Subject Added Successfully.';
            }else{
                $data['message']='Subject Already Exist.';
            }   
        }
        
        if(isset($_POST['delete'])){
           
            $this->db->where('sub_id',$_POST['delete']);
            $this->db->delete('lunar_subjects');
            $data['message']='Subject Deleted Successfully.';
        }
            
        $data['subjects'] = $this->db->get_where('lunar_subjects', ['status' => 'Active'])->result();
        $this->load->view("add_subject.php",$data);
    }
    
    
    
    public function add_varient()
    {
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $ubject = $this->db->get_where('lunar_varient', ['sub_id' => $_POST['sub_id'],'varient_name'=>$_POST['varient_name']])->row();
            if(empty($ubject) && !empty($_POST['varient_name']) && !empty($_POST['sub_id'])){
                $ar=array(
                    'sub_id'=>$_POST['sub_id'],
                    'varient_name'=>strtoupper($_POST['varient_name']),
                    'status'=>'Active'
                    );
                $this->db->insert('lunar_varient',$ar);
                $data['message']='Varient Added Successfully.';
            }else{
                $data['message']='Varient Already Exist.';
            }   
        }
        
        if(isset($_POST['delete'])){
            // print_r($_POST);die;
            $this->db->where('varient_id',$_POST['delete']);
            $this->db->delete('lunar_varient');
            $data['message']='Variant Deleted Successfully.';
        }
        
        $data['subjects'] = $this->db->get_where('lunar_subjects', ['status' => 'Active'])->result();
        
            $this->db->select('lunar_varient.varient_id,lunar_varient.varient_name,lunar_varient.sub_id,lunar_subjects.subject_key');
            $this->db->from('lunar_varient');
            $this->db->join('lunar_subjects','lunar_subjects.sub_id=lunar_varient.sub_id');
            $this->db->where('lunar_subjects.status','Active');
            $this->db->where('lunar_varient.status','Active');
            $query=$this->db->get();
            
            $data['lunar_varient'] = $query->result();
        
        $this->load->view("add_varient.php",$data);
    }
    
    
    
    public function upload_result()
    {
        
        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {  

                $data['period_id']  = $search_period_id = $this->input->post('period_id');
                $data['subject']    = $search_level_id = $this->input->post('subject');
                $data['type']       = $search_service_id = $this->input->post('type');
                $data['level']      = $search_service_id = $this->input->post('level');
                $data['series']     = $search_service_id = $this->input->post('series');
            
                $csvResult_upolad_logArray = array();
            
                $start_cell_row = 1; // Skip first 4 rows (index starts from 0)
                $i = 0;
            
                if ($_FILES['csv']['size'] > 0) { 
                    
                    $file = $_FILES['csv']['tmp_name']; 
                    $handle = fopen($file, "r");
            
                    for ($skip = 0; $skip < $start_cell_row; $skip++) {
                        fgetcsv($handle, 1000, ",", "'");
                    }
                    
                       
                    
                    while (($resultRow_from_csv = fgetcsv($handle, 1000, ",", "'")) !== FALSE) {
                        
                        
                        if (!empty($resultRow_from_csv[0])) { 
                            $period     = addslashes($resultRow_from_csv[0]);
                            $level      = addslashes($resultRow_from_csv[1]);
                            $cin        = addslashes($resultRow_from_csv[2]);
                            $status     = addslashes($resultRow_from_csv[3]);
                            $grade      = addslashes($resultRow_from_csv[4]);
                            $rank       = addslashes($resultRow_from_csv[5]);
                            $performer  = addslashes($resultRow_from_csv[6]);
                            $speller    = addslashes($resultRow_from_csv[7]);
                            $mark       = addslashes($resultRow_from_csv[8]);
                            $center     = addslashes($resultRow_from_csv[9]);
                            $date       = addslashes($resultRow_from_csv[10]);
                            
                            // echo 'Get the CSV file'.$resultRow_from_csv[0];die;
            
                            $csv_result_array = array(
                                'cin'              => $cin, 
                                'status'           => $status,
                                'period'           => $period,
                                'level'            => $data['level'],
                                'grade'            => $grade,
                                'marks'            => $mark,
                                'center'           => $center,
                                'rank'             => $rank,
                                'performer'        => $performer,
                                'speller'          => $speller,
                                'competition_date' => $date,
                                'subject'          => $data['subject'],
                                'series'           => $data['series'],
                                'type'             => $data['type'],
                                'product_name'     => 'Lunar Skill Test',
                            );
            
                            // Save to database
                            $csv_upload_status = $this->schoolmodel->save_csv_result($csv_result_array);
                            array_push($csvResult_upolad_logArray, $csv_upload_status);
                        }
                    }
                    fclose($handle);
            
                    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
                    $this->notifications->notify('Result Uploaded Successfully', 'success');
                }
            }

        
    
            $this->db->select('*');
    		$this->db->from('competition_level_byproduct');
    		$this->db->where('product_name','Lunar Skill Test');
    		$res = $this->db->get();
    		$data['level_load']= $res->result_array();
    		
    		$this->db->select('*');
    		$this->db->from('class');
    		$res = $this->db->get();
    		$data['classload']= $res->result_array();
         
            $this->db->select('series');
    		$this->db->from('lunar_schedule_cin');
    		$this->db->where('series !=','');
    		$this->db->group_by('series');
    		$res = $this->db->get();
    		$data['series']= $res->result();
    		
    		$this->db->select('Subject_key');
    		$this->db->from('subjects');
    		$res = $this->db->get();
    		$data['subject']= $res->result();
         
            $this->db->select('type');
    		$this->db->from('lunar_schedule_cin');
    		$this->db->where('type !=','');
    		$this->db->group_by('type');
    		$res = $this->db->get();
    		$data['type']= $res->result();
    
    	$this->load->view("lunar_upload_result.php",$data);
    
    }
    
     private function empty_registration_result()
    {
        return [
            'period_id' => '', 'subject' => '', 'level' => '', 'crm_per' => '',
        ];
    }
    
    public function schedule_lunar()
    {
        $data['categories']  = $this->lunarmodel->get_categories();
        $data['test_types']  = $this->lunarmodel->get_test_types();
        $data['programs']    = $this->lunarmodel->get_programs();  // new Program Management redesign
        $data['subjects']    = $this->lunarmodel->get_subjects();
        $data['domains']    = $this->lunarmodel->get_domains();
        
 
        // --- existing Activate Registration dependencies (unchanged) ---
        //$data['message']    = $this->session->flashdata('message') ?? '';
        $data['periodload']     = $this->db->get('period')->result(); // adjust table name if different
        $data['academic_years'] = $this->lunarmodel->get_academic_years();
        $data['result']     = $this->empty_registration_result();
       
        if(isset($_POST['submit']))
        {
            // print_r($_POST);die;
            
            if(empty($_POST['period_id'])){
                $period = $this->db->get_where('period', ['status' => 'Active'])->row();
            }else{
                $period = $this->db->get_where('period', ['period_id' => $_POST['period_id']])->row();
            }
            $period_id = $period->period_id;
            
            
            $this->db->order_by('lunar_schedule_id', 'DESC');
            $series = $this->db->get_where('lunar_schedule_cin', [
                'period_id' => $period_id,
                'subject' => $_POST['subject']
            ])->row();

            if(empty($series)){
                $ser=10001;
            }else{
                $ser=$series->series;
                $ser=$ser+1;
            }
        
            function generate_unique_code($db, $period_year) {
                do {
                    $random_number = rand(1000, 9999);
                    // if($period_year == '25'){
                    //     $registration_code = 'L257096';
                    // }
                    // if($period_year == '26'){
                    //     $registration_code = 'L267096';
                    // }
                    // if($period_year == '27'){
                    //     $registration_code = 'L277096';
                    // }
                    $registration_code = 'L' . $period_year . $random_number;
                    
                    $existing_entry = $db->get_where('lunar_schedule_cin', ['registration_code' => $registration_code])->row();
                } while ($existing_entry); 
        
                return $registration_code;
            }
        
        
    //        $registration_code = generate_unique_code($this->db, $period->initials);

                    if($period->initials == '25'){
                        $registration_code = 'L257096';
                    }
                    if($period->initials == '26'){
                        $registration_code = 'L267096';
                    }
                    if($period->initials == '27'){
                        $registration_code = 'L277096';
                    }

                $ar = array(
                    // 'school'=>$_POST['school'],
                    'product_name'=>'Lunar Skill Test',
                    'period_id'=>$period_id,
                    'registration_code'=>$registration_code,
                    'amount'=>$_POST['amount'],
                    'associate_cut'=>$_POST['franchise_cut'],
                    'associate_id'=>$_POST['associate_id'],
                    'start_date'=>$_POST['start_date'],
                    'end_date'=>$_POST['end_date'],
                    'subject'=>$_POST['subject'],
                    'series'=>$ser,
                    //'level_id'=>$_POST['level'],
                    'crm_per'=>$_POST['crm_per'] ?? 0,
                    'school_amount'=>$_POST['school_amount'] ?? 0,
                    // 'orientation'=>$_POST['orientation'],
                    'state_id'=>$_POST['state_id'],
                    'franchise_percentage'=>$_POST['franchise_percentage'],
                    'franchise_id'=>$_POST['franchise_id'],
                    'aviansys_percentage'=>$_POST['aviansys_percentage'],
                    'management_percentage'=>$_POST['management_percentage'],
                    'type'=>$_POST['varient'],
                    'season'=>$_POST['season'],
                    'title'=> $_POST['title'] ?? '',
                    'description' => $_POST['description']
                );
                // echo '<pre>';
                // print_r($ar);die;
                
                $this->db->insert('lunar_schedule_cin',$ar);
                $last_inserted_id = $this->db->insert_id();

                foreach($_POST['classes'] as $class){
                    $ar=array('class'=>$class,'sch_id'=>$last_inserted_id);
                    $this->db->insert('lunar_schedule_class',$ar);
                }
                
                if(!empty($_POST['schools'])){
                    foreach($_POST['schools'] as $school){
                        $ar=array('school_id'=>$school,'sch_id'=>$last_inserted_id);
                        $this->db->insert('lunar_schedule_school',$ar);
                    }
                }
                
                redirect('manage/lunar/schedule_list', 'refresh');
            
            $data['message']='Products assigned to school successfully ...';
            $data['result'] = $_POST;
        }
        
        $data['productload'] = $this->db->get_where('products',array('product_name'=>'Lunar Skill Test'))->result_array();
        
        $data['periodload'] = $this->db->get_where('period',array('period_id >'=>'14'))->result();
        
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            // if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
            // }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
            $this->db->select('associates.associate_id,first_name,last_name');
            $this->db->from('associates');
            $this->db->join('associate_bank_details','associate_bank_details.associate_id=associates.associate_id');
            $this->db->where('associates.status','Active');
            $query=$this->db->get();
            $data['associates'] = $query->result();
            
        if(isset($data['result']['subject'])){
            $data['domains']    = $this->lunarmodel->get_domains1($data['result']['subject']);
        }
        
        $this->load->view("schedule_lunar",$data);
    }
    
    public function ajax_schedule_list()
{
    $rows = $this->db->order_by('week_start', 'ASC')
                      ->get('study_schedule_lunar')
                      ->result();
    echo json_encode($rows);
}


public function ajax_schedule_save()
{
    $id = $this->input->post('id');

    $data = [
        'week_start'         => (int) $this->input->post('week_start'),
        'week_end'           => (int) $this->input->post('week_end'),
        'phase'              => trim((string) $this->input->post('phase')),
        'milestone'          => trim((string) $this->input->post('milestone')),
        'milestone_week'     => (int) $this->input->post('milestone_week'),
        'description'        => $this->input->post('description') ?: null,
        'study_material'     => $this->input->post('study_material') ?: null,
        'test_activate_date' => $this->input->post('test_activate_date') ?: null,
        'Mover_test'         => $this->input->post('Mover_test') ?: null,
        'Flyer_test'         => $this->input->post('Flyer_test') ?: null,
        'national'           => $this->input->post('national') ?: null,
        'training'           => $this->input->post('training') ?: null,
        'mock_test'          => $this->input->post('mock_test') ?: null,
        'price'              => (int) $this->input->post('price'),
    ];

    if ($data['phase'] === '' || $data['milestone'] === '') {
        return $this->_json(['error' => 'Phase and milestone are required.'], 422);
    }

    if ($id) {
        $this->db->where('id', $id)->update('study_schedule_lunar', $data);
        return $this->_json(['success' => true, 'id' => (int) $id]);
    }

    $this->db->insert('study_schedule_lunar', $data);
    $this->_json(['success' => true, 'id' => $this->db->insert_id()]);
}
    public function ajax_categories_list()
    {
        $this->_json($this->lunarmodel->get_categories());
    }
 
    public function ajax_categories_save()
    {
        $id   = $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        $desc = trim((string) $this->input->post('description'));
 
        if ($name === '') {
            return $this->_json(['error' => 'Category name is required.'], 422);
        }
        if ($this->lunarmodel->category_name_exists($name, $id ?: null)) {
            return $this->_json(['error' => 'A category with that name already exists.'], 422);
        }
 
        $payload = ['name' => $name, 'description' => $desc ?: null];
 
        if ($id) {
            $ok = $this->lunarmodel->update_category($id, $payload);
            return $this->_json(['success' => (bool) $ok, 'id' => (int) $id]);
        }
 
        $new_id = $this->lunarmodel->create_category($payload);
        $this->_json(['success' => (bool) $new_id, 'id' => $new_id]);
    }

    public function ajax_categories_delete($id)
    {
        $result = $this->lunarmodel->delete_category((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_product_categories_list()
    {
        $this->_json($this->lunarmodel->get_product_categories());
    }

    public function ajax_product_categories_save()
    {
        $id     = (int) $this->input->post('id');
        $sub_id = (int) $this->input->post('sub_id');
        $name   = trim((string) $this->input->post('category_name'));
        $status = $this->input->post('status') ?: 'Active';

        if ($name === '' || !$sub_id) {
            return $this->_json(['error' => 'Subject and subject category name are required.'], 422);
        }
        if (!$this->lunarmodel->product_category_subject_exists($sub_id)) {
            return $this->_json(['error' => 'Selected subject was not found.'], 422);
        }
        if ($this->lunarmodel->product_category_name_exists($name, $sub_id, $id ?: null)) {
            return $this->_json(['error' => 'This subject already has a category with that name.'], 422);
        }

        $saved_id = $this->lunarmodel->save_product_category([
            'sub_id'        => $sub_id,
            'category_name' => $name,
            'status'        => $status,
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_product_categories_delete($id = null)
    {
        $id = $id ?: $this->input->post('id');
        $result = $this->lunarmodel->delete_product_category((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_program_subjects_list()
    {
        $this->_json($this->lunarmodel->get_program_subjects());
    }

    public function ajax_program_domains_list()
    {
        $this->_json($this->lunarmodel->get_program_domains());
    }

    public function ajax_program_subjects_save()
    {
        $id = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '') return $this->_json(['error' => 'Subject name is required.'], 422);
        if ($this->lunarmodel->product_name_exists($name, $id ?: null)) {
            return $this->_json(['error' => 'A subject with that name already exists.'], 422);
        }
        $saved_id = $this->lunarmodel->save_product([
            'sub_name' => $name,
            'status' => $this->input->post('status') ?: 'Active',
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_program_subjects_delete($id = null)
    {
        $result = $this->lunarmodel->delete_product((int) ($id ?: $this->input->post('id')));
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_program_domains_save()
    {
        $id = (int) $this->input->post('id');
        $sub_id = (int) $this->input->post('sub_id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '' || !$sub_id) {
            return $this->_json(['error' => 'Subject and domain name are required.'], 422);
        }
        if ($this->lunarmodel->product_category_name_exists($name, $sub_id, $id ?: null)) {
            return $this->_json(['error' => 'This subject already has a domain with that name.'], 422);
        }
        $saved_id = $this->lunarmodel->save_product_category([
            'sub_id' => $sub_id,
            'category_name' => $name,
            'status' => $this->input->post('status') ?: 'Active',
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_program_domains_delete($id = null)
    {
        $result = $this->lunarmodel->delete_product_category((int) ($id ?: $this->input->post('id')));
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_program_material_types_list()
    {
        $this->_json($this->lunarmodel->get_program_material_types());
    }

    public function ajax_program_material_types_save()
    {
        $id = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '') return $this->_json(['error' => 'Material type name is required.'], 422);
        if ($this->lunarmodel->material_type_name_exists($name, $id ?: null)) {
            return $this->_json(['error' => 'A material type with that name already exists.'], 422);
        }
        $saved_id = $this->lunarmodel->save_program_material_type([
            'name' => $name,
            'status' => $this->input->post('status') ?: 'Active',
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_program_material_types_delete($id = null)
    {
        $result = $this->lunarmodel->delete_program_material_type((int) ($id ?: $this->input->post('id')));
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    /* Read-only: material makers are managed elsewhere in the app
       (their own vendor/payee record). This just lists them for the
       Upload Learning Materials dropdowns. */
    public function ajax_material_makers_list()
    {
        $this->_json($this->lunarmodel->get_material_makers());
    }

    public function ajax_component_types_list()
    {
        $this->_json($this->lunarmodel->get_component_types());
    }

    public function ajax_component_types_save()
    {
        $id = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '') return $this->_json(['error' => 'Component type name is required.'], 422);
        if ($this->lunarmodel->component_type_name_exists($name, $id ?: null)) {
            return $this->_json(['error' => 'A component type with that name already exists.'], 422);
        }
        $saved_id = $this->lunarmodel->save_component_type([
            'name' => $name,
            'status' => $this->input->post('status') ?: 'Active',
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_component_types_delete($id = null)
    {
        $result = $this->lunarmodel->delete_component_type((int) ($id ?: $this->input->post('id')));
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_products_list()
    {
        $this->_json($this->lunarmodel->get_products());
    }

    public function ajax_products_save()
    {
        $id   = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('product_name'));

        if ($name === '') {
            return $this->_json(['error' => 'Product name is required.'], 422);
        }
        if ($this->lunarmodel->product_name_exists($name, $id ?: null)) {
            return $this->_json(['error' => 'A product with that name already exists.'], 422);
        }

        $saved_id = $this->lunarmodel->save_product([
            'sub_name' => $name,
            'status'   => $this->input->post('status') ?: 'Active',
        ], $id ?: null);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_products_delete($id = null)
    {
        $id = $id ?: $this->input->post('id');
        $result = $this->lunarmodel->delete_product((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }
 
    /* =========================================================
     * AJAX — TEST TYPES  (legacy component master)
     * =======================================================*/

    public function ajax_test_types_list()
    {
        $this->_json($this->lunarmodel->get_test_types());
    }

    public function ajax_test_types_save()
    {
        $id   = (int) $this->input->post('id');
        $name = trim((string) $this->input->post('name'));
        if ($name === '') return $this->_json(['error' => 'Component name is required.'], 422);
        $data = [
            'name'        => $name,
            'max_allowed' => $this->input->post('max_allowed') === '' ? null : max(0, (int) $this->input->post('max_allowed')),
            'description' => trim((string) $this->input->post('description')) ?: null,
        ];
        $saved = $id ? $this->lunarmodel->update_test_type($id, $data) : $this->lunarmodel->create_test_type($data);
        $this->_json(['success' => (bool) $saved, 'id' => $id ?: $saved]);
    }

    public function ajax_test_types_delete($id)
    {
        $result = $this->lunarmodel->delete_test_type((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    /* =========================================================
     * AJAX — CATEGORIES  (legacy)
     * =======================================================*/

    public function ajax_programs_list()
    {
        try {
            $data = $this->lunarmodel->get_programs();
            $this->_json(array_values($data));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_programs_save()
    {
        try {
            $id   = $this->input->post('id');
            $name = trim((string) $this->input->post('program_name'));
            if ($name === '') {
                return $this->_json(['error' => 'Program name is required.'], 422);
            }

            $grade_from = $this->input->post('grade_from') ?: $this->input->post('from_grade') ?: $this->input->post('grade');
            $grade_to   = $this->input->post('grade_to') ?: $this->input->post('to_grade') ?: $this->input->post('grade');
            $grade_from = trim((string) $grade_from);
            $grade_to   = trim((string) $grade_to);
            if ($grade_from !== '' && $grade_to !== '') {
                $normal_from = $this->lunarmodel->normalize_grade_value($grade_from);
                $normal_to   = $this->lunarmodel->normalize_grade_value($grade_to);
                if ($normal_from !== '' && $normal_to !== '') {
                    $from_rank = $this->lunarmodel->build_grade_label($normal_from, $normal_from) === 'Preschool' ? 0 : (int) preg_replace('/\D+/', '', $normal_from);
                    $to_rank   = $this->lunarmodel->build_grade_label($normal_to, $normal_to) === 'Preschool' ? 0 : (int) preg_replace('/\D+/', '', $normal_to);
                    if (strtolower($normal_from) === 'adults' || strtolower($normal_to) === 'adults') {
                        $from_rank = 99;
                        $to_rank = 99;
                    }
                    if ($from_rank > $to_rank) {
                        return $this->_json(['error' => 'Applicable From grade cannot be greater than Applicable To grade.'], 422);
                    }
                }
            }

           $data = [
                'program_name'  => $name,
                'subject'       => trim((string) $this->input->post('subject')),
                'description' => trim((string) $this->input->post('description')),
                'domain'        => trim((string) $this->input->post('domain')),
                'material_type' => trim((string) $this->input->post('material_type')),
                'grade_from'    => $grade_from,
                'grade_to'      => $grade_to,
                'grade'         => trim((string) $this->input->post('grade')),
                'season'        => $this->input->post('season'),
                'academic_year' => trim((string) $this->input->post('academic_year')),
                'status'        => $this->input->post('status') ?: 'Active',
                'management_percentage' => $this->input->post('management_percentage'),
                'aviansys_percentage' => $this->input->post('aviansys_percentage'),
                'crm_per' => $this->input->post('crm_per'),
                'maker_percentage' => $this->input->post('maker_percentage'),
                'associate_id' => $this->input->post('associate_id'),
                'associate_percentage' => $this->input->post('associate_percentage'),
                'it_percentage' => $this->input->post('it_percentage'),
            ];
            if (!empty($_FILES['syllabus']['name'])) {
                $upload_dir = FCPATH . 'public/lunar_programs/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $this->upload->initialize([
                    'upload_path' => $upload_dir,
                    'allowed_types' => 'pdf|doc|docx|xls|xlsx',
                    'max_size' => 20480,
                    'encrypt_name' => true,
                ]);
                if (!$this->upload->do_upload('syllabus')) {
                    return $this->_json(['error' => 'Syllabus upload failed: ' . $this->upload->display_errors('', '')], 422);
                }
                $upload = $this->upload->data();
                $data['syllabus_path'] = 'public/lunar_programs/' . $upload['file_name'];
            }
            if (!empty($_FILES['test_schedule']['name'])) {
                $upload_dir = FCPATH . 'public/lunar_programs/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $this->upload->initialize([
                    'upload_path' => $upload_dir,
                    'allowed_types' => 'pdf|doc|docx|xls|xlsx',
                    'max_size' => 20480,
                    'encrypt_name' => true,
                ]);
                if (!$this->upload->do_upload('test_schedule')) {
                    return $this->_json(['error' => 'Test Schedule upload failed: ' . $this->upload->display_errors('', '')], 422);
                }
                $upload = $this->upload->data();
                $data['test_schedule_path'] = 'public/lunar_programs/' . $upload['file_name'];
            }
            if (!empty($_FILES['what_you_get']['name'])) {
                $upload_dir = FCPATH . 'public/lunar_programs/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $this->upload->initialize([
                    'upload_path' => $upload_dir,
                    'allowed_types' => 'pdf',
                    'max_size' => 20480,
                    'encrypt_name' => true,
                ]);
                if (!$this->upload->do_upload('what_you_get')) {
                    return $this->_json(['error' => 'What You Get upload failed: ' . $this->upload->display_errors('', '')], 422);
                }
                $upload = $this->upload->data();
                $data['what_you_get_path'] = 'public/lunar_programs/' . $upload['file_name'];
            }
            $saved_id = $this->lunarmodel->save_program($data, $id ?: null);
            $this->_json(['success' => true, 'id' => $saved_id]);
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_programs_delete($id = null)
    {
        $id     = $id ?: $this->input->post('id');
        $result = $this->lunarmodel->delete_program((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    /* =========================================================
     * AJAX — LUNAR COMPONENTS  (new redesign)
     * =======================================================*/

    public function ajax_components_list()
    {
        try {
            $program_id = $this->input->get('program_id') ?: $this->input->post('program_id');
            if (!$program_id) {
                return $this->_json(['error' => 'program_id is required.'], 422);
            }
            $data = $this->lunarmodel->get_components((int) $program_id);
            $this->_json(array_values($data));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

     public function ajax_components_save()
    {
        try {
            $id         = $this->input->post('id');
            $program_id = $this->input->post('program_id');
            $name       = trim((string) $this->input->post('component_name'));
            $type       = trim((string) $this->input->post('component_type'));
            $mode       = trim((string) $this->input->post('component_mode'));
            $domain     = trim((string) $this->input->post('domain'));
            $venue      = trim((string) $this->input->post('venue'));
            $start_date = trim((string) $this->input->post('start_date'));
            $end_date   = trim((string) $this->input->post('end_date'));
            $competition_date = trim((string) $this->input->post('competition_date'));
            // Multiple venues for Offline mode, sent as a JSON array of
            // {country_id,country_name,state_id,state_name,city,venue_date,venue_name}.
            $venues_raw = $this->input->post('venues');
            $venues     = [];
            if ($venues_raw) {
                $decoded = json_decode($venues_raw, true);
                if (is_array($decoded)) {
                    $venues = $decoded;
                }
            }
            // View sends both 'price' and 'unit_price' with the same value;
            // accept either so older callers keep working.
            $price = $this->input->post('unit_price');
            if ($price === null || $price === '') {
                $price = $this->input->post('price');
            }
 
            if (!$program_id || $name === '' || $price === '' || $price === null) {
                return $this->_json(['error' => 'program_id, component_name and price are required.'], 422);
            }
            if (!is_numeric($price) || (float) $price < 0) {
                return $this->_json(['error' => 'Price must be a non-negative number.'], 422);
            }
            if ($mode === 'Online') {
                if ($start_date === '' || $end_date === '') {
                    return $this->_json(['error' => 'Start Date and End Date are required for Online mode.'], 422);
                }
                if ($start_date > $end_date) {
                    return $this->_json(['error' => 'Start Date cannot be after End Date.'], 422);
                }
            } elseif ($mode === 'Offline') {
                $has_venue_row = false;
                foreach ($venues as $v) {
                    if (trim((string) ($v['venue_name'] ?? '')) !== '' && trim((string) ($v['venue_date'] ?? '')) !== '') {
                        $has_venue_row = true;
                        break;
                    }
                }
                // Legacy single competition_date still satisfies the check,
                // so existing single-venue offline components keep working.
                if (!$has_venue_row && $competition_date === '') {
                    return $this->_json(['error' => 'Add at least one venue with a date for Offline mode.'], 422);
                }
            }
 
            // On edit, start from whatever is already saved so that
            // NOT re-uploading a file on this save doesn't wipe out the
            // previously uploaded circular/admit path. Only a fresh file
            // in THIS request should change these values.
            $circular_path = '';
            $admit_path    = '';
            if ($id) {
                $existing = $this->lunarmodel->get_component($id);
                if ($existing) {
                    $circular_path = (string) ($existing->circular_path ?? '');
                    $admit_path    = (string) ($existing->admit_path ?? '');
                }
            }
 
            $upload_dir = FCPATH . 'public/lunar_components/' . (int) $program_id . '/';
            if ((!empty($_FILES['circular']['name'])) || (!empty($_FILES['admit']['name']))) {
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $file_config = [
                    'upload_path'   => $upload_dir,
                    'allowed_types' => 'pdf|doc|docx|jpg|jpeg|png',
                    'max_size'      => 10240,
                    // Keep the original file name instead of a random
                    // encrypted one. overwrite=false makes CodeIgniter
                    // auto-suffix (_1, _2, ...) on a name clash rather
                    // than silently overwriting an unrelated file.
                    'encrypt_name'  => false,
                    'overwrite'     => false,
                ];
 
                if (!empty($_FILES['circular']['name'])) {
                    $this->upload->initialize($file_config);
                    if (!$this->upload->do_upload('circular')) {
                        return $this->_json(['error' => 'Circular upload failed: ' . $this->upload->display_errors('', '')], 422);
                    }
                    $circular_upload = $this->upload->data();
                    $circular_path   = 'public/lunar_components/' . (int) $program_id . '/' . $circular_upload['file_name'];
                }
                if (!empty($_FILES['admit']['name'])) {
                    $this->upload->initialize($file_config);
                    if (!$this->upload->do_upload('admit')) {
                        return $this->_json(['error' => 'Admit upload failed: ' . $this->upload->display_errors('', '')], 422);
                    }
                    $admit_upload = $this->upload->data();
                    $admit_path   = 'public/lunar_components/' . (int) $program_id . '/' . $admit_upload['file_name'];
                }
            }
 
            $data = [
                'program_id'     => (int) $program_id,
                'component_name' => $name,
                'component_type' => $type,
                'domain'         => $domain,
                'component_mode' => $mode,
                'venue'          => $venue,
                'price'          => (float) $price,
                'unit_price'     => (float) $price,
                'circular_path'  => $circular_path,
                'admit_path'     => $admit_path,
                'start_date'        => $mode === 'Online'  ? $start_date       : '',
                'end_date'          => $mode === 'Online'  ? $end_date         : '',
                'competition_date'  => $mode === 'Offline' ? $competition_date : '',
                'status'         => $this->input->post('status') ?: 'Active', 
                'venues'         => $mode === 'Offline' ? $venues : [],
            ];
            $saved_id = $this->lunarmodel->save_component($data, $id ?: null);
            $this->_json(['success' => true, 'id' => $saved_id]);
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }
 
 

    public function ajax_components_delete($id = null)
    {
        $id     = $id ?: $this->input->post('id');
        $result = $this->lunarmodel->delete_component((int) $id);
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    /* ---- Offline component venues: country/state dropdowns + CRUD ---- */

    public function ajax_component_countries_list()
    {
        try {
            $this->_json($this->lunarmodel->get_countries());
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_component_states_list()
    {
        try {
            $country_id = $this->input->get('country_id') ?: $this->input->post('country_id');
            if (!$country_id) {
                return $this->_json(['error' => 'country_id is required.'], 422);
            }
            $this->_json($this->lunarmodel->get_states_by_country((int) $country_id));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }
    
     public function ajax_component_cities_list()
    {
        try {
            $state_id = $this->input->get('state_id') ?: $this->input->post('state_id');
            if (!$state_id) {
                return $this->_json(['error' => 'state_id is required.'], 422);
            }
            $this->_json($this->lunarmodel->get_cities_by_state((int) $state_id));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_component_venues_list($component_id = null)
    {
        try {
            $component_id = $component_id ?: ($this->input->get('component_id') ?: $this->input->post('component_id'));
            if (!$component_id) {
                return $this->_json(['error' => 'component_id is required.'], 422);
            }
            $this->_json($this->lunarmodel->get_component_venues((int) $component_id));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_component_venue_delete($id = null)
    {
        $id = $id ?: $this->input->post('id');
        $ok = $this->lunarmodel->delete_component_venue((int) $id);
        $this->_json(['success' => $ok], $ok ? 200 : 409);
    }

    /* =========================================================
     * AJAX — LUNAR PLANS  (new redesign)
     * =======================================================*/

    public function ajax_plans_list()
    {
        try {
            // Check if request is for new lunar_plans or legacy plans
            $program_id = $this->input->get('program_id');
            if ($program_id) {
                // New redesign: per-program plans
                $data = $this->lunarmodel->get_plans_by_program((int) $program_id);
                return $this->_json(array_values($data));
            }
            // Legacy fallback
            $filters = [];
            if ($cat = $this->input->get('category_id')) {
                $filters['category_id'] = $cat;
            }
            $plans = $this->lunarmodel->get_plans($filters);
            $this->_json(array_values($plans));
        } catch (\Throwable $e) {
            log_message('error', 'ajax_plans_list: ' . $e->getMessage());
            $this->_json(['error' => 'Server error loading plans: ' . $e->getMessage()], 500);
        }
    }

    public function ajax_plans_save()
    {
        try {
            $program_id = $this->input->post('program_id');

            // New redesign path: has program_id but no category_id
            if ($program_id && !$this->input->post('category_id')) {
                $id            = $this->input->post('id');
                $plan_name     = trim((string) $this->input->post('plan_name'));
                $component_id  = $this->input->post('component_id');
                $component_ids = $this->input->post('component_ids');
                $component_ids = is_array($component_ids) ? array_values(array_unique(array_filter(array_map('intval', $component_ids)))) : [];
                if (!$component_ids && $component_id !== null && $component_id !== '') {
                    $component_ids = [(int) $component_id];
                }
                // The Add Plan modal now sends one quantity PER component,
                // e.g. component_units[5]=2&component_units[7]=6 — parsed
                // by PHP into an assoc array keyed by component_id. This
                // replaces the old single "units" value that used to be
                // applied to every selected component uniformly.
                $component_units_raw = $this->input->post('component_units');
                $component_units_map = is_array($component_units_raw) ? $component_units_raw : [];

                if ($plan_name === '') {
                    return $this->_json(['error' => 'Plan name is required.'], 422);
                }

                // Plan Type: Learning Material / Test / Learning Material + Test
                $plan_type_raw = $this->input->post('plan_type');
                $plan_type     = $plan_type_raw === null ? null : trim((string) $plan_type_raw);
                $allowed_plan_types = ['Learning Material', 'Test', 'Learning Material + Test'];
                if ($plan_type !== null && !in_array($plan_type, $allowed_plan_types, true)) {
                    return $this->_json(['error' => 'Please select a valid Plan Type.'], 422);
                }

                // ---- Component + Quantity selection (new) ---------------
                // When the Add Plan modal is used with a component/quantity
                // selection, the server recalculates price, discount and
                // final amount itself rather than trusting the client's
                // numbers — the client-side figures are only a live
                // preview.
                if (!empty($component_ids)) {

                    $components  = [];
                    $line_items  = [];
                    $base_amount = 0.0;
                    $max_units   = 0;

                    foreach ($component_ids as $selected_component_id) {
                        $component = $this->lunarmodel->get_component($selected_component_id);
                        if (!$component) {
                            return $this->_json(['error' => 'Selected component was not found.'], 422);
                        }
                        if ((int) $component->program_id !== (int) $program_id) {
                            return $this->_json(['error' => 'Selected component does not belong to this program.'], 422);
                        }

                        $qty_raw = $component_units_map[$selected_component_id] ?? $component_units_map[(string) $selected_component_id] ?? null;
                        $qty     = (int) $qty_raw;
                        if ($qty_raw === null || $qty_raw === '' || !ctype_digit((string) $qty_raw) || $qty < 1 || $qty > 365) {
                            return $this->_json(['error' => 'Enter units (1–365) for "' . $component->component_name . '".'], 422);
                        }

                        $components[]  = $component;
                        $line_total    = round((float) $component->unit_price * $qty, 2);
                        $base_amount  += $line_total;
                        $max_units     = max($max_units, $qty);
                        $line_items[]  = [
                            'component_id'   => (int) $selected_component_id,
                            'component_name' => $component->component_name,
                            'unit_price'     => (float) $component->unit_price,
                            'units'          => $qty,
                            'line_total'     => $line_total,
                        ];
                    }
                    $base_amount = round($base_amount, 2);

                    // Discount tiers now key off the LARGEST per-component
                    // quantity selected (there's no longer one uniform
                    // "units" value shared by every component):
                    //   max qty 1–32  -> no discount
                    //   max qty 33–51 -> configured discount % (admin-entered, 0-100)
                    //   max qty 52    -> fixed 10% discount
                    if ($max_units <= 32) {
                        $discount_percent = 0.0;
                    } elseif ($max_units <= 51) {
                        $configured = $this->input->post('discount_percent');
                        if ($configured === null || $configured === '' || !is_numeric($configured) || (float) $configured < 0 || (float) $configured > 100) {
                            return $this->_json(['error' => 'A discount % between 0 and 100 is required for 33–51 units.'], 422);
                        }
                        $discount_percent = (float) $configured;
                    } else { // 52
                        $discount_percent = 10.0;
                    }

                    $discount_amount = round($base_amount * ($discount_percent / 100), 2);
                    $final_amount    = round($base_amount - $discount_amount, 2);

                    $data = [
                        'program_id'       => (int) $program_id,
                        'plan_name'        => $plan_name,
                        'plan_type'        => $plan_type,
                        'duration'         => $this->input->post('duration') ?: 'Monthly',
                        'price'            => $final_amount,
                        'discount_percent' => $discount_percent,
                        'total_value'      => $base_amount,
                        'discount_amount'  => $discount_amount,
                        'final_price'      => $final_amount,
                        'status'           => $this->input->post('status') ?: 'Active',
                    ];

                    $component_units = [];
                    foreach ($component_ids as $selected_component_id) {
                        $qty = $component_units_map[$selected_component_id] ?? $component_units_map[(string) $selected_component_id] ?? 0;
                        $component_units[$selected_component_id] = (int) $qty;
                    }
                    $saved_id = $this->lunarmodel->save_lunar_plan($data, $component_units, $id ?: null);
                    return $this->_json([
                        'success'          => true,
                        'id'               => $saved_id,
                        'component_id'     => $component_ids[0],
                        'component_ids'    => $component_ids,
                        'line_items'       => $line_items,
                        'base_amount'      => $base_amount,
                        'discount_percent' => $discount_percent,
                        'discount_amount'  => $discount_amount,
                        'final_amount'     => $final_amount,
                    ]);
                }

                // ---- Legacy simplified path (no component/unit picked) --
                // component_ids is optional here: older callers of this
                // simplified plan modal (name/price/duration/status) don't
                // collect components, so don't hard-require them.
                $price         = $this->input->post('price');
                $component_ids = $this->input->post('component_ids') ?: [];

                // Editing an existing plan without submitting any
                // component selection must not silently wipe out
                // components/units that were already linked to it.
                if ($id && empty($component_ids)) {
                    $existing_links = [];
                    foreach ($this->lunarmodel->get_plan_components((int) $id) as $link) {
                        $existing_links[(int) $link->component_id] = (int) $link->units;
                    }
                    if (!empty($existing_links)) {
                        $component_ids = $existing_links;
                    }
                }

                if ($price === null || $price === '' || !is_numeric($price) || (float) $price < 0) {
                    return $this->_json(['error' => 'Price must be a non-negative number.'], 422);
                }

                $data = [
                    'program_id'       => (int) $program_id,
                    'plan_name'        => $plan_name,
                    'plan_type'        => $plan_type,
                    'duration'         => $this->input->post('duration') ?: 'Monthly',
                    'price'            => (float) $price,
                    'discount_percent' => (float) ($this->input->post('discount_percent') ?? 0),
                    'total_value'      => (float) ($this->input->post('total_value') ?? $price),
                    'discount_amount'  => (float) ($this->input->post('discount_amount') ?? 0),
                    'final_price'      => (float) $price,
                    'status'           => $this->input->post('status') ?: 'Active',
                ];

                $saved_id = $this->lunarmodel->save_lunar_plan($data, $component_ids, $id ?: null);
                return $this->_json(['success' => true, 'id' => $saved_id]);
            }

            // Legacy plan save (category-based)
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $id          = $this->input->post('id');
            $allocations = $this->input->post('allocations');
            $allocations = is_array($allocations) ? $allocations : [];

            $data = [
                'category_id'          => $this->input->post('category_id'),
                'plan_name'            => trim((string) $this->input->post('plan_name')),
                'start_week'           => $this->input->post('start_week'),
                'end_week'             => $this->input->post('end_week'),
                'units'                => $this->input->post('units'),
                'total_study_material' => $this->input->post('total_study_material'),
                'starter_tests'        => $this->input->post('starter_tests'),
                'mover_tests'          => $this->input->post('mover_tests'),
                'mock_tests'           => $this->input->post('mock_tests'),
                'price_per_unit'       => $this->input->post('price_per_unit'),
                'total_amount'         => $this->input->post('total_amount'),
                'discount_percent'     => $this->input->post('discount_percent'),
                'discount_amount'      => $this->input->post('discount_amount'),
                'final_amount'         => $this->input->post('final_amount'),
                'start_date'           => $this->input->post('start_date'),
                'end_date'             => $this->input->post('end_date'),
                'status'               => $this->input->post('status') === '0' ? 'Inactive' : 'Active',
            ];

            if ($data['plan_name'] === '' || !is_numeric($data['category_id']) || (int) $data['category_id'] <= 0) {
                return $this->_json(['error' => 'Category and plan name are required.'], 422);
            }

            $valid_durations = [8, 16, 24, 32, 40, 48, 52];
            if ((int) $data['start_week'] !== 1) {
                return $this->_json(['error' => 'Start week must be 1.'], 422);
            }
            if (!in_array((int) $data['end_week'], $valid_durations, true)) {
                return $this->_json(['error' => 'End week must be one of: 8, 16, 24, 32, 40, 48, or 52.'], 422);
            }

            $data['discount_percent'] = ((int) $data['end_week'] === 365) ? 10 : (((int) $data['end_week'] > 32) ? 5 : 0);
            $data['total_amount']     = $this->lunarmodel->calculate_component_total($allocations);
            $data['discount_amount']  = round($data['total_amount'] * ((float) $data['discount_percent'] / 100), 2);
            $data['final_amount']     = round($data['total_amount'] - $data['discount_amount'], 2);
            $data['price_per_unit']   = $data['total_amount'];

            if ($id) {
                $ok = $this->lunarmodel->update_plan($id, $data, $allocations);
                return $this->_json(['success' => (bool) $ok, 'id' => (int) $id]);
            }
            $new_id = $this->lunarmodel->create_plan($data, $allocations);
            $this->_json(['success' => (bool) $new_id, 'id' => $new_id]);

        } catch (\Throwable $e) {
            log_message('error', 'ajax_plans_save: ' . $e->getMessage());
            $this->_json(['error' => 'Server error while saving the plan: ' . $e->getMessage()], 500);
        }
    }

    public function ajax_plans_toggle($id = null)
    {
        $id = $id ?: $this->input->post('id');
        // Try new lunar_plans table first
        $plan = $this->db->where('id', (int) $id)->get('lunar_plans')->row();
        if ($plan) {
            $ok = $this->lunarmodel->toggle_lunar_plan_status((int) $id);
        } else {
            $ok = $this->lunarmodel->toggle_plan_status($id);
        }
        $this->_json(['success' => (bool) $ok]);
    }

    public function ajax_plans_delete($id = null)
    {
        $id = $id ?: $this->input->post('id');
        // Try new lunar_plans first
        $plan = $this->db->where('id', (int) $id)->get('lunar_plans')->row();
        if ($plan) {
            $result = $this->lunarmodel->delete_lunar_plan((int) $id);
        } else {
            $result = $this->lunarmodel->delete_plan((int) $id);
        }
        $this->_json($result, $result['success'] ? 200 : 409);
    }

    public function ajax_plans_get($id = null)
    {
        $plan = $this->lunarmodel->get_plan($id);
        if (!$plan) {
            return $this->_json(['error' => 'Plan not found.'], 404);
        }
        $plan->allocations = $this->lunarmodel->get_plan_allocations($id);
        $this->_json($plan);
    }

    public function ajax_plans_history($id = null)
    {
        $this->_json($this->lunarmodel->get_price_history($id));
    }

    /* =========================================================
     * AJAX — PLAN COMPONENT UNIT-WISE STUDY MATERIAL
     * (Add Plan -> Component + Unit selection: upload/verify)
     * =======================================================*/

    /**
     * GET manage/lunar/ajax_plan_unit_status?plan_id=&component_id=
     * Returns { required, uploaded, remaining, uploaded_units, missing_units }.
     * Always checked against the database — never assumes all units
     * are available just because the plan's unit count says so.
     */
    public function ajax_plan_unit_status()
    {
        try {
            $plan_id      = (int) $this->input->get('plan_id');
            $component_id = (int) $this->input->get('component_id');
            if (!$plan_id || !$component_id) {
                return $this->_json(['error' => 'plan_id and component_id are required.'], 422);
            }
            $this->_json($this->lunarmodel->get_plan_unit_upload_status($plan_id, $component_id));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * POST manage/lunar/ajax_plan_unit_upload (multipart/form-data)
     * Fields: plan_id, component_id, unit, file
     * Saves against lm_content (start_unit = end_unit = unit) and
     * returns the refreshed verification status so the UI can update
     * "Uploaded X / Required Y" immediately.
     */
    public function ajax_plan_unit_upload()
    {
        try {
            $plan_id      = (int) $this->input->post('plan_id');
            $component_id = (int) $this->input->post('component_id');
            $unit         = (int) $this->input->post('unit');

            if (!$plan_id || !$component_id) {
                return $this->_json(['error' => 'plan_id and component_id are required.'], 422);
            }

            $plan = $this->lunarmodel->get_lunar_plan($plan_id);
            if (!$plan) {
                return $this->_json(['error' => 'Plan not found.'], 404);
            }
            $component = $this->lunarmodel->get_component($component_id);
            if (!$component) {
                return $this->_json(['error' => 'Component not found.'], 404);
            }

            $required = $this->lunarmodel->get_plan_component_units($plan_id, $component_id);
            if ($required < 1) {
                return $this->_json(['error' => 'This component has no units configured on this plan.'], 422);
            }
            if ($unit < 1 || $unit > $required) {
                return $this->_json(['error' => "Unit must be between 1 and {$required} for this plan."], 422);
            }
            if (empty($_FILES['file']['name'])) {
                return $this->_json(['error' => 'No file uploaded.'], 422);
            }

            $program_id   = (int) $component->program_id;
            $relative_dir = "uploads/lunar_plan_content/{$program_id}/plan{$plan_id}/component{$component_id}/";
            $upload_dir   = FCPATH . $relative_dir;
            if (!is_dir($upload_dir)) {
                if (!mkdir($upload_dir, 0755, true) && !is_dir($upload_dir)) {
                    return $this->_json(['error' => 'Upload directory could not be created. Check folder permissions.'], 500);
                }
            }

            $config = [
                'upload_path'   => $upload_dir,
                'file_name'     => 'unit' . $unit . '_' . time(),
                'allowed_types' => 'pdf|doc|docx|zip',
                'max_size'      => 20480, // 20 MB
                'encrypt_name'  => false,
                'overwrite'     => false,
            ];
            $this->upload->initialize($config, true);

            if (!$this->upload->do_upload('file')) {
                return $this->_json(['error' => $this->upload->display_errors('', '')], 422);
            }
            $upload_data = $this->upload->data();
            if (empty($upload_data['file_name'])) {
                return $this->_json(['error' => 'Upload succeeded but the file name could not be determined.'], 500);
            }

            $component_type_name = strtolower((string) $component->component_type . ' ' . $component->component_name);
            $content_type = 'study_pack';
            if (strpos($component_type_name, 'video') !== false) {
                $content_type = 'video';
            } elseif (strpos($component_type_name, 'study') === false && strpos($component_type_name, 'material') === false) {
                $content_type = preg_replace('/[^a-z0-9]+/', '_', trim(strtolower($component->component_name)));
                $content_type = trim($content_type, '_') ?: 'study_pack';
            }

            $new_id = $this->lunarmodel->save_unit_content([
                'plan_id'      => $plan_id,
                'component_id' => $component_id,
                'start_unit'   => $unit,
                'end_unit'     => $unit,
                'content_type' => $content_type,
                'file_path'    => $relative_dir . $upload_data['file_name'],
            ]);

            $status = $this->lunarmodel->get_plan_unit_upload_status($plan_id, $component_id);
            $this->_json(['success' => true, 'id' => $new_id, 'unit' => $unit] + $status);
        } catch (\Throwable $e) {
            log_message('error', 'ajax_plan_unit_upload: ' . $e->getMessage());
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    /* =========================================================
     * AJAX — LUNAR LEARNING MODULES  (new redesign)
     * =======================================================*/

    public function ajax_modules_upload()
    {
        try {
            $program_id   = (int) $this->input->post('program_id');
            $component_id = (int) $this->input->post('component_id');
            $day_number   = (int) $this->input->post('day_number');
            $from_day     = (int) $this->input->post('from_day');
            $to_day       = (int) $this->input->post('to_day');

            if (!$program_id || !$component_id || !$day_number) {
                return $this->_json(['error' => 'program_id, component_id and day_number are required.'], 422);
            }
            if ($day_number < 1 || $day_number > 365) {
                return $this->_json(['error' => 'day_number must be between 1 and 365.'], 422);
            }

            if (empty($_FILES['file']['name'])) {
                return $this->_json(['error' => 'No file uploaded.'], 422);
            }

            $upload_path = FCPATH . 'public/lunar_modules/' . $program_id . '/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0755, true);
            }

            $config = [
                'upload_path'   => $upload_path,
                'allowed_types' => 'pdf|zip|mp4|avi|mov|jpg|jpeg|png|ppt|pptx|doc|docx|xlsx|xls',
                'max_size'      => 102400, // 100 MB
                'encrypt_name'  => true,
            ];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                return $this->_json(['error' => $this->upload->display_errors('', '')], 422);
            }

            $upload_data = $this->upload->data();
            $relative_path = 'public/lunar_modules/' . $program_id . '/' . $upload_data['file_name'];

            $meta = [
                'program_id'        => $program_id,
                'component_id'      => $component_id,
                'day_number'        => $day_number,
                'from_day'          => $from_day,
                'to_day'            => $to_day,
                'original_filename' => $upload_data['orig_name'],
                'file_path'         => $relative_path,
                'file_size'         => $upload_data['file_size'],
                'file_type'         => $upload_data['file_type'],
            ];

            $new_id = $this->lunarmodel->save_module($meta);
            $this->_json(['success' => true, 'id' => $new_id, 'file' => $upload_data['orig_name']]);

        } catch (\Throwable $e) {
            log_message('error', 'ajax_modules_upload: ' . $e->getMessage());
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_modules_list()
    {
        try {
            $program_id = $this->input->get('program_id');
            if (!$program_id) {
                return $this->_json(['error' => 'program_id is required.'], 422);
            }
            $filters = [];
            if ($cid = $this->input->get('component_id')) $filters['component_id'] = $cid;
            if ($day = $this->input->get('day_number'))    $filters['day_number']   = $day;
            $data = $this->lunarmodel->get_modules((int) $program_id, $filters);
            $this->_json(array_values($data));
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    public function ajax_modules_delete($id = null)
    {
        $id = $id ?: $this->input->post('id');
        try {
            $ok = $this->lunarmodel->delete_module((int) $id);
            $this->_json(['success' => (bool) $ok]);
        } catch (\Throwable $e) {
            $this->_json(['error' => $e->getMessage()], 500);
        }
    }

    /* =========================================================
     * AJAX — LEGACY RATES & CATALOGUE
     * =======================================================*/

    public function ajax_rates_get()
    {
        $this->_json($this->lunarmodel->get_mix_match_rates());
    }

    public function ajax_rates_save()
    {
        $id     = $this->input->post('id');
        $fields = [
            'rate_learning_material_per_lm', 'rate_daily_test_per_lm',
            'rate_mock_test_per_lm', 'rate_starter_test_per_lm',
            'rate_video_per_lm', 'rate_mover_test', 'rate_flyer_test', 'rate_national_test',
        ];
        $data = [];
        foreach ($fields as $f) {
            $val = $this->input->post($f);
            if ($val === null || $val === '' || !is_numeric($val)) {
                return $this->_json(['error' => 'All rate fields are required and must be numeric.'], 422);
            }
            $data[$f] = $val;
        }
        $saved_id = $this->lunarmodel->save_mix_match_rates($id ?: null, $data);
        $this->_json(['success' => (bool) $saved_id, 'id' => $saved_id]);
    }

    public function ajax_catalogue()
    {
        $this->_json($this->lunarmodel->get_catalogue());
    }

    /* =========================================================
     * helpers
     * =======================================================*/
 
    private function _json($payload, $status_code = 200)
    {
        // json_encode() returns false (=> a silently empty response
        // body, HTTP 200) if ANY string in $payload contains invalid
        // UTF-8 bytes — e.g. an em dash or curly quote saved through
        // a non-UTF-8 DB connection. JSON_INVALID_UTF8_SUBSTITUTE
        // swaps those bytes for U+FFFD instead of failing outright.
        $json = json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE);

        // CodeIgniter's set_status_header() throws its own fatal
        // "No status text available" error page if $status_code isn't
        // in its internal reason-phrase table (older CI builds are
        // missing several 4xx codes we use here, e.g. 422). Passing
        // an explicit reason phrase avoids that lookup entirely.
        $reasons = [
            200 => 'OK', 201 => 'Created', 204 => 'No Content',
            400 => 'Bad Request', 401 => 'Unauthorized', 403 => 'Forbidden',
            404 => 'Not Found', 409 => 'Conflict', 422 => 'Unprocessable Entity',
            429 => 'Too Many Requests', 500 => 'Internal Server Error',
        ];
        $reason = $reasons[$status_code] ?? 'Error';

        if ($json === false) {
            log_message('error', '_json: json_encode failed — ' . json_last_error_msg());
            $this->output
                 ->set_status_header(500, $reasons[500])
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Server error encoding response: ' . json_last_error_msg()]));
            return;
        }

        $this->output
             ->set_status_header($status_code, $reason)
             ->set_content_type('application/json')
             ->set_output($json);
    }

    
    public function lunar_schedule_update()
    {
        $lunar_schedule_id = $this->uri->segment('4');
        // Fetch existing schedule data
        $schedule = $this->db->get_where('lunar_schedule_cin', ['lunar_schedule_id' => $lunar_schedule_id])->row_array();
        $data['result'] = $schedule;
    
        // On form submit
        if (isset($_POST['submit'])) {
    
            $updateData = [
                'state_id' => $_POST['state_id'],
                'franchise_id' => $_POST['franchise_id'],
                'period_id' => $_POST['period'],
                'subject' => $_POST['subject'],
                'series' => $_POST['series'],
                'level_id' => $_POST['clevel'],
                'associate_id' => $_POST['associate_id'],
                'associate_cut' => $_POST['associate_per'],
                'school_amount' => $_POST['school_amount'] ?? 0,
                'crm_per' => $_POST['crm_per'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'amount' => $_POST['amount'],
                'management_percentage' => $_POST['management_percentage'],
                'aviansys_percentage' => $_POST['aviansys_percentage'],
                'franchise_percentage' => $_POST['franchise_percentage'],
                'type' => $_POST['type'],
                'season' => $_POST['season'],
                'title' => $_POST['title'],
                'study_material_a_price' => $_POST['study_material_a_price'],
                'description' => $_POST['description']
            ];
    
             //print_r($updateData);die;
            
            // Update main record
            $this->db->where('lunar_schedule_id', $lunar_schedule_id);
            $this->db->update('lunar_schedule_cin', $updateData);
    
            
    
            $data['message'] = "Lunar Schedule updated successfully.";
        }
    
        // Load dropdown data
        $data['stateload'] = $this->db->get_where('states', ['country_id' => '105'])->result_array();
        $data['franchiseload'] = $this->db->get('franchise')->result_array();
        $data['areaload'] = $this->db->get('areas')->result_array();
        $data['periodload'] = $this->db->get_where('period', ['period_id >=' => '14'])->result();
        $data['pricecodes'] = $this->db->get_where('price_code', ['status' => 'Active'])->result_array();
    
        $this->db->select('associate_id, first_name, last_name');
        $this->db->from('associates');
        // $this->db->where('status', 'Active');
        $data['associates'] = $this->db->get()->result_array();
    
        $data['classes'] = $this->db->get('class')->result_array();
        
        $data['levelload'] = $this->db->get_where('competition_level_byproduct', ['product_name' => 'Lunar Skill Test'])->result_array();
        $data['material'] = $this->db->get_where('study_material', ['product_name' => 'Lunar Skill Test','subject'=>$data['result']['subject'],'series'=>$data['result']['series']])->result_array();
       //print_r($data['material'][0]['price']);die;
        // Fetch already linked classes
        $linked_classes = $this->db->get_where('lunar_schedule_class', ['sch_id' => $lunar_schedule_id])->result_array();
        $data['active_classes'] = array_column($linked_classes, 'class');
    
        $this->load->view('lunar_schedule_update', $data);
    }
    
    

    public function lunar_schedule_delete($lunar_schedule_id)
    {
        // First, check if record exists
        $schedule = $this->db->get_where('lunar_schedule_cin', ['lunar_schedule_id' => $lunar_schedule_id])->row_array();
    
        if (!$schedule) {
            $this->session->set_flashdata('error', 'Record not found or already deleted.');
            // redirect('lunar/schedule_list');
            redirect('manage/lunar/schedule_list', 'refresh');
            return;
        }
    
        // Delete linked classes first
        $this->db->where('sch_id', $lunar_schedule_id);
        $this->db->delete('lunar_schedule_class');
    
        // Then delete main schedule entry
        $this->db->where('lunar_schedule_id', $lunar_schedule_id);
        $this->db->delete('lunar_schedule_cin');
    
        $this->session->set_flashdata('success', 'Schedule deleted successfully.');
        // redirect('lunar/schedule_list');
         redirect('manage/lunar/schedule_list', 'refresh');
    }


    
    public function upload_rank()
    {
        
        if(isset($_POST['submit'])) {
	        
    		
    		
    		$product_id = $_POST['product'];
    		$level_id = $_POST['level'];
    		
    		
    		$product_level = $this->db->get_where('products',array( 'product_id'=> $product_id))->row();
    		
    		
		    $csvResult_upolad_logArray = array();
            $resultRow_from_csv = array_map('trim', $_FILES);

		    
			$file = $_FILES['csv']['tmp_name']; 
			$handle = fopen($file,"r"); 
			$ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
			  
		    if($ext === 'csv')
		    {
                    
                $i = 1;

                while (($resultRow_from_csv = fgetcsv($handle, 1000)) !== false) {
                    
                    // ✅ Skip CSV header row
                    if ($i == 1) {
                        $i++;
                        continue;
                    }
                
                    if (!empty($resultRow_from_csv[0])) {
                        
                        
                
                        $logRow = $resultRow_from_csv;
                    
                        $cin        = addslashes($resultRow_from_csv[0]);
                        $rank       = addslashes($resultRow_from_csv[1]);
                        $speller        = addslashes($resultRow_from_csv[2]);
                        $performer       = addslashes($resultRow_from_csv[3]);
                        
            //            echo $rank;die;       
                
                        $status = 'Not Updated Rank for this CIN';    
                        
                            
                            $student_result = $this->db->get_where('cin_result',array( 'cin'=> $cin ))->row();
    		
    		                $student = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
                            $period  = $this->db->get_where('period',array('period_id'=>$student->period_id))->row();
                            
                            
    		                if($student->school_name){
    		                    $school = $student->school_name; 
    		                }else{
    		                    
    		                    $studentSchool = $this->db->get_where('school_new',array('id'=>$student->school_id))->row();
    		                    $school = $studentSchool->school_name;
    		                }    
    		            
    		
                            $pay = [
                                'cin' => $cin,
                                'student_name' => $student->student_name,
                                'stud_email' => $student->stud_email,
                                'stud_phone' => $student->stud_phone,
                                'class' => $student->class,
                                'school' => $school,
                                'level_name' => $level_id,
                                'period' => $period->academic_year,
                                'period_id' => $period->period_id,
                                'rank' => $rank,
                                'product_name' => $product_level->product_name,
                                'speller' => $speller,
                                'performer' => $performer
                            ];
                            
                            // print_r($pay);die;
                            
                            $logRow[3] = $speller;
                            $logRow[4] = $performer;
                            $logRow[5] = 'red';
                            $logRow[6] = $level_id;
                            $rank_list = $this->db->get_where('rank_list',['cin'=> $cin, 'level_name'=> $level_id])->row();
    		
                            if(empty($rank_list)){

                                $this->db->insert('rank_list', $pay);
                                
                                if ($this->db->affected_rows() > 0) {
                                    $status = 'Inserted RANK';
                                    $logRow[5] = 'green';
                                    
                                    
                                } else {
                                    $status = 'MaRRS update failed / no changes';
                                }

                            }
                            
                        
                        $logRow[2] = $status;
                        $csvResult_upolad_logArray[] = $logRow;
                    }
                    $i++;
                }
                
                $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
			}
		}
    
        if(isset($data['result']['product'])){
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product']);
            $query=$this->db->get();
    	    $data['level']    = $query->result();
        }
    	
            $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id >','11');
            $query=$this->db->get();
    	    $data['period']   = $query->result();
    
    	$this->load->view("upload_rank.php",$data);
    }
    
    
    
    public function filter_rank()
    {
        if (isset($_POST['submit'])) 
        {

            $product_id = $_POST['product'] ?? null;
            $period_id  = $_POST['period'] ?? null;
            $class      = $_POST['class'] ?? null;
        
            if (!$product_id || !$period_id) {
                show_error('Invalid request');
            }
        
            // Get product-level mapping
            $product_level = $this->db
                ->get_where('products', ['product_id' => $product_id])
                ->row();
        
            if (!$product_level) {
                show_error('Product level not found');
            }
        
            // Fetch rank list
            $this->db->from('rank_list');
            $this->db->where('product_name', $product_level->product_name);
            $this->db->where('period_id', $period_id);
        
            if (!empty($class)) {
                $this->db->where('class', $class);
            }
        
            $query = $this->db->get();
            $data['ranklist'] = $query->result(); // array of objects
        
            $data['message'] = 'Rank data found';    
            if (empty($data['ranklist'])) {
                // show_error('No rank data found');
                $data['message'] = 'No rank data found';
            }
        
            // Result data
            $data['result'] = $_POST;
            $data['result']['product_name'] = $product_level->product_name;
            $data['result']['level_name']   = $data['ranklist'][0]->level_name;
        
            // Product info
            $product = $this->db
                ->get_where('products', ['product_id' => $product_id])
                ->row();
        
            // Period info
            $period = $this->db
                ->get_where('period', ['period_id' => $period_id])
                ->row();
        
            $data['result']['logo_url'] = $product->logo_url ?? '';
            $data['result']['period']   = $period->period_id ?? '';
        }
            // echo 'okl';die;
    
        if(isset($data['result']['product'])){
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product']);
            $this->db->order_by('product_name','DESC');
            $query=$this->db->get();
    	    $data['level']    = $query->result();
        }
        
        
    	
            $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id >','11');
            $query=$this->db->get();
    	    $data['period']   = $query->result();
    
    	$this->load->view("filter_rank.php",$data);
    }
    
    
    
    public function delete()
    {
        $id = $this->input->post('id');
    
        if(empty($id)){
            echo json_encode(['status'=>'error']);
            return;
        }
    
        // echo $id;die;
        $this->db->where('id', $id);
        $this->db->delete('rank_list');
    
        echo json_encode(['status'=>'success']);
    }

    
    
    public function add_associate()
    {
        $data = []; 
        if (isset($_POST['submit'])) {
        $associate_data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code'),
            'country' => $this->input->post('country')
        ];

        $bank_data = [
            'bank_name' => $this->input->post('bank_name'),
            'account_number' => $this->input->post('account_number'),
            'ifsc_code' => $this->input->post('ifsc_code'),
            'branch_name' => $this->input->post('branch_name'),
            'status'=>'Inactive'
        ];

        $email_exists = $this->db->get_where('associates', ['email' => $associate_data['email']])->num_rows() > 0;

        $phone_exists = $this->db->get_where('associates', ['phone' => $associate_data['phone']])->num_rows() > 0;

            if ($email_exists) {
                $data['message'] = 'The email address is already in use. Please use a different email.';
            } elseif ($phone_exists) {
                $data['message'] = 'The phone number is already in use. Please use a different phone number.';
            } else {
                $this->db->trans_start();
    
                $this->db->insert('associates', $associate_data);
                $associate_id = $this->db->insert_id(); 
    
                if ($associate_id) {
                    $bank_data['associate_id'] = $associate_id;
                    $this->db->insert('associate_bank_details', $bank_data);
                }
    
                $this->db->trans_complete();
    
                if ($this->db->trans_status()) {
                    $data['message'] = 'Associate and bank details added successfully.';
                } else {
                    $data['message'] = 'Failed to add associate and bank details. Please try again.';
                }
            }
        }
        
        $data['stateload']=$this->db->get_where('states', ['country_id' => '105'])->result_array();
    
        $this->load->view("add_associate.php", $data);
    }
    
    
    
    public function update_associate()
    {
        
        $this->db->select('associates.*, associate_bank_details.bank_name, associate_bank_details.account_number, associate_bank_details.ifsc_code');
        $this->db->from('associates');
        $this->db->join('associate_bank_details', 'associate_bank_details.associate_id = associates.associate_id', 'left');
        $this->db->join('countries', 'countries.country_id = associates.country', 'left');
        $this->db->join('states', 'states.state_subdivision_id = associates.state', 'left');
        $query = $this->db->get();
        $data['associates'] = $query->result_array();

        $data['states'] = $this->db->get_where('states', ['country_id' => '105'])->result_array();

    
        $this->load->view("update_associate.php", $data);
    }
    
    public function competitionlist_associate()
    {
        $data = [];
        $data['type'] = '';
        $data['program_type'] = '';
    
        if (isset($_POST['submit'])) {
            $type = $this->input->post('type', true);
            $program_type = $this->input->post('program_type', true);
    
            $data['type'] = $type;
            $data['program_type'] = $program_type;
    
            if ($type == 'franchise') {
                $this->db->where('status', 'Active');
                $this->db->where('account_id !=', '');
                // no program_type filter here - franchise table doesn't have this column
                $query = $this->db->get('franchise');
                $data['associates'] = $query->result_array();
                // echo $this->db->last_query();
            
            } else if ($type == 'associate') {
                $this->db->select('associates.*, associate_bank_details.bank_name, associate_bank_details.account_number, associate_bank_details.ifsc_code');
                $this->db->from('associates');
                $this->db->join('associate_bank_details', 'associate_bank_details.associate_id = associates.associate_id', 'left');
                $this->db->join('countries', 'countries.country_id = associates.country', 'left');
                $this->db->join('states', 'states.state_subdivision_id = associates.state', 'left');
                $this->db->where('associates.status','Active');
                
            
                $query = $this->db->get();
                $data['associates'] = $query->result_array();
            
                $data['states'] = $this->db->get_where('states', ['country_id' => '105'])->result_array();
            }
    
            $this->load->view("competitionlist_associate", $data);
            return;
        }
    
        $this->load->view("competitionlist_associate", $data);
    }


 public function DeactivateFr()
{
    $id = $this->input->post('id');

    $this->db->where('franchise_id', $id)
              ->update('franchise', ['status' => 'Deactive']);

   echo json_encode(['status' => 'success', 'message' => 'Link deactivated successfully.']);
}

public function DeactivateAsso()
{
    $id = $this->input->post('id');

    $this->db->where('associate_id', $id)
              ->update('associates', ['status' => 'Deactive']);

    echo json_encode(['status' => 'success', 'message' => 'Link deactivated successfully.']);
}

public function update_franchise_status()
{
    $franchise_id = (int) $this->input->post('franchise_id');
    $status = $this->input->post('status', true);

    if (!$franchise_id || !in_array($status, ['Active', 'Deactive'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid status.'
        ]);
        return;
    }

    $this->db
        ->where('franchise_id', $franchise_id)
        ->update('franchise', [
            'status' => $status
        ]);

    echo json_encode([
        'status' => true,
        'message' => 'Status updated successfully.'
    ]);
}
  public function update_associate_status()
{
    $associate_id = (int) $this->input->post('associate_id');
    $status       = $this->input->post('status', true);

    if (!$associate_id || !in_array($status, ['Active', 'Deactive'])) {
        echo json_encode([
            'status' => false,
            'message' => 'Invalid request.'
        ]);
        return;
    }

    $latest_link = $this->db
        ->where('associate_id', $associate_id)
        ->order_by('associate_link_id', 'DESC')
        ->limit(1)
        ->get('associate_link')
        ->row();

    if (!$latest_link) {
        echo json_encode([
            'status' => false,
            'message' => 'No link found for this affiliate.'
        ]);
        return;
    }

    $this->db
        ->where('associate_link_id', $latest_link->associate_link_id)
        ->update('associate_link', [
            'status' => $status
        ]);

    echo json_encode([
        'status' => true,
        'message' => 'Affiliate status updated successfully.'
    ]);
}  
    public function deletelink()
    {
        $id =$this->uri->segment(4);
    
        $this->db->where('associate_link_id', $id);
        $this->db->delete('associate_link');
    
       redirect('manage/lunar/competitionlist_associate');
    }

    
 
public function createlink()
{
    $associate_id = $this->uri->segment('4');
 
    $type = $this->input->get('type') ? $this->input->get('type') : $this->input->post('type');
 
    if (isset($_POST['submit'])) {
 
        $link = 'https://marrs.in/lunar/Welcome/associatelink/';
 
        $post_type = $this->input->post('type');
 
        $schedule_data = [
            'associate_id'          => $associate_id,
            'link'                  => $link,
            'inserted_date'         => date('Y-m-d'),
            'expire_date'           => $this->input->post('expire_date'),
            'status'                => 'Active',
            'franchise_percentage'  => $this->input->post('franchise_percentage'),
            'associate_percentage'  => $this->input->post('associate_percentage'),
            'crm_percentage'        => $this->input->post('crm_percentage'),
            'crm_id'                => $this->input->post('crm'),
            'franchise_id'          => $this->input->post('franchise'),
            'program_type'          => $post_type, // requires ALTER TABLE associate_link ADD program_type
        ];
 
        $this->db->insert('associate_link', $schedule_data);
        $insert_id = $this->db->insert_id();
 
        $program_ids = $this->input->post('ids');
 
        if (!empty($program_ids) && is_array($program_ids)) {
 
            $program_insert_data = [];
 
            foreach ($program_ids as $program_id) {
                $program_insert_data[] = [
                    'associate_link_id' => $insert_id,
                    'lunar_schedule_id' => $program_id,
                    'program_type'      => $post_type,
                ];
            }
 
            $this->db->insert_batch('associatelink_to_lunar', $program_insert_data);
        }
 
        if ($this->db->affected_rows() > 0) {
            $data['message'] = 'Associate link created successfully.';
            $data['status']  = 'success';
        } else {
            $data['message'] = 'Link creation failed.';
            $data['status']  = 'error';
        }
 
        $type = $post_type;
    }
 
    $data['associate'] = $this->db->get_where('associates', ['associate_id' => $associate_id])->row();
 
    if (empty($data['associate'])) {
        show_404();
        return;
    }
 
    $data['states']    = $this->db->get_where('states', ['country_id' => '105'])->result_array();
    $data['franchise'] = $this->db->get_where('franchise', ['status' => 'Active', 'account_id !=' => ''])->result();
    $data['crm']       = $this->db->get_where('gst_account_marrs', ['title' => 'CRM'])->result();
 
    $schedules_lunar = [];
    $schedules_marrs = [];
 
    if ($type == 'lunar') {
        $schedules_lunar = $this->db->get_where('lunar_schedule_cin', ['period_id' => '16'])->result();
    } elseif ($type == 'marrs') {
        $schedules_marrs = $this->db->get_where('competition_product_state', ['period_id' => '16', 'status' => 'Live'])->result();
    }
 
    $data['type']            = $type;
    $data['schedules_lunar'] = $schedules_lunar;
    $data['schedules_marrs'] = $schedules_marrs;
 
    $this->load->view("createlink.php", $data);
}
 
 
/*
|--------------------------------------------------------------------------
| AJAX endpoint: get_schedule_list
|--------------------------------------------------------------------------
| Called via JS fetch() when the Lunar/MaRRS dropdown changes.
| Returns ONLY the schedule list HTML fragment — no header/footer, no
| page reload. Keeps whatever the user already typed in the main form.
|--------------------------------------------------------------------------
*/
public function get_schedule_list()
{
    $type = $this->input->get('type');
 
    $schedules_lunar = [];
    $schedules_marrs = [];
 
    if ($type == 'lunar') {
        $schedules_lunar = $this->db->get_where('lunar_schedule_cin', ['period_id' => '16'])->result();
    } elseif ($type == 'marrs') {
        $schedules_marrs = $this->db->get_where('competition_product_state', ['period_id' => '16', 'status' => 'Live'])->result();
    }
 
    $data['type']            = $type;
    $data['schedules_lunar'] = $schedules_lunar;
    $data['schedules_marrs'] = $schedules_marrs;
 
    // Render ONLY the partial, no header/footer wrapper
    $this->load->view('schedule_list.php', $data);
}   
  
  
 public function createlinkfranchise()
{
    $franchise_id = $this->uri->segment('4');

    $type = $this->input->get('type') ? $this->input->get('type') : $this->input->post('type');

    if (isset($_POST['submit'])) {

        $link = 'https://marrs.in/lunar/Welcome/franchiselink/';

        $post_type = $this->input->post('type');

        $schedule_data = [

            'link'                  => $link,
            'inserted_date'         => date('Y-m-d'),
            'expire_date'           => $this->input->post('expire_date'),
            'status'                => 'Active',
            'franchise_percentage'  => $this->input->post('franchise_percentage'),

            'crm_percentage'        => $this->input->post('crm_percentage'),
            'crm_id'                => $this->input->post('crm'),
            'franchise_id'          => $this->input->post('franchise'),
            'program_type'          => $post_type,
        ];
//print_r($schedule_data);die;
        $this->db->insert('associate_link', $schedule_data);
        $insert_id = $this->db->insert_id();

        // Insert multiple program ids linked to this new associate_link, along with
        // the amount entered against each one (previously collected in the form
        // but never actually saved — the amount[] fields were being dropped).
        $ids     = $this->input->post('ids');    // array of schedule ids from checkboxes
        $amounts = $this->input->post('amount'); // amount[<id>] => value

        if (!empty($ids) && is_array($ids)) {
            $program_insert_data = [];

            foreach ($ids as $id) {

                $amount = isset($amounts[$id]) ? $amounts[$id] : 0;

                $program_insert_data[] = [
                    'franchise_link_id' => $insert_id,
                    'lunar_schedule_id' => $id,
                    'program_type'      => $post_type,
                    'amount'            => $amount,
                ];
            }

            $this->db->insert_batch('associatelink_to_lunar', $program_insert_data);
        }

        if ($this->db->affected_rows() > 0) {
            $data['message'] = 'Franchise link created successfully.';
            $data['status'] = 'success';
        } else {
            $data['message'] = 'Link creation failed.';
            $data['status'] = 'error';
        }

        $type = $post_type;
    }

    // Note: the old $associate_id lookup here was undefined and always errored —
    // franchise links have no associate, so it's removed rather than fixed.
    $data['states'] = $this->db->get_where('states', ['country_id' => '105'])->result_array();
    $data['franchise'] = $this->db->get_where('franchise', ['franchise_id' => $franchise_id])->row();

    if (empty($data['franchise'])) {
        show_404();
        return;
    }

    $data['crm'] = $this->db->get_where('gst_account_marrs', array('title' => 'CRM'))->result();

    $schedules_lunar = [];
    $schedules_marrs = [];

    if ($type == 'lunar') {
        $schedules_lunar = $this->db->get_where('lunar_schedule_cin', ['period_id' => '16'])->result();
    } elseif ($type == 'marrs') {
        $schedules_marrs = $this->db->get_where('competition_product_state', ['period_id' => '16', 'status' => 'Live'])->result();
    }

    $data['type'] = $type;
    $data['schedules_lunar'] = $schedules_lunar;
    $data['schedules_marrs'] = $schedules_marrs;

    $this->load->view("createlinkfranchise.php", $data);
}

public function editlinkfranchise()
{
    $link_id = $this->uri->segment('4');

    // Get the associate_link row for this franchise link
    $data['associate_link_data'] = $associate_link_data = $this->db->get_where('associate_link', ['associate_link_id' => $link_id])->row();

    if (empty($associate_link_data)) {
        show_404();
        return;
    }

    // Franchise links created before the program-type filter existed have no program_type
    // saved — treat those as 'lunar' since that's all createlinkfranchise() ever used.
    $original_type = $associate_link_data->program_type ? $associate_link_data->program_type : 'lunar';

    // Type shown on screen: GET (type switcher) wins, then POST (hidden field on submit),
    // else fall back to whatever is already saved (or defaulted above).
    $type = $this->input->get('type')
        ? $this->input->get('type')
        : ($this->input->post('type') ? $this->input->post('type') : $original_type);

    // Handle form submission
    if (isset($_POST['submit'])) {

        $post_type = $this->input->post('type');

        $schedule_data = [
            'expire_date'          => $this->input->post('expire_date'),
            'status'               => $this->input->post('status'),
            'franchise_percentage' => $this->input->post('franchise_percentage'),
            'crm_id'               => $this->input->post('crm'),
            'crm_percentage'       => $this->input->post('crm_percentage'),
            'program_type'         => $post_type,
            // franchise_id is intentionally not updated here — it's fixed for this link, same
            // as it's fixed (from the URL) when the link is first created.
        ];

        $this->db->where('associate_link_id', $link_id);
        $this->db->update('associate_link', $schedule_data);

        // Delete all existing schedule associations for this link
        $this->db->where('associate_link_id', $link_id);
        $this->db->delete('associatelink_to_lunar');

        // Insert new associations
        $ids     = $this->input->post('ids');
        $amounts = $this->input->post('amount'); // amount[<id>] => value

        if (!empty($ids) && is_array($ids)) {

            $program_insert_data = [];

            foreach ($ids as $id) {

                $amount = isset($amounts[$id]) ? $amounts[$id] : 0;

                $program_insert_data[] = [
                    'associate_link_id' => $link_id,
                    'lunar_schedule_id' => $id,
                    'program_type'      => $post_type,
                    'amount'            => $amount,
                ];
            }

            $this->db->insert_batch('associatelink_to_lunar', $program_insert_data);
        }

        if ($this->db->affected_rows() > 0) {
            $data['message'] = 'Franchise link updated successfully!';
            $data['status']  = 'success';
        } else {
            $data['message'] = 'No changes made.';
            $data['status']  = 'warning';
        }

        // Refresh the row so the form below reflects what was just saved
        $data['associate_link_data'] = $associate_link_data = $this->db->get_where('associate_link', ['associate_link_id' => $link_id])->row();
        $original_type = $associate_link_data->program_type ? $associate_link_data->program_type : 'lunar';
        $type = $original_type;
    }

    // Franchise is fixed for this link — just fetch the one record to display it read-only
    $data['franchise'] = $this->db->get_where('franchise', ['franchise_id' => $associate_link_data->franchise_id])->row();
    $data['crm']       = $this->db->get_where('gst_account_marrs', ['title' => 'CRM'])->result();

    $data['type'] = $type;

    $schedules_lunar = [];
    $schedules_marrs = [];

    if ($type == 'lunar') {
        $schedules_lunar = $this->db->get_where('lunar_schedule_cin', ['period_id' => '16'])->result();
    } elseif ($type == 'marrs') {
        $schedules_marrs = $this->db->get_where('competition_product_state', ['period_id' => '16', 'status' => 'Live'])->result();
    }

    $data['schedules_lunar'] = $schedules_lunar;
    $data['schedules_marrs'] = $schedules_marrs;

    // Only pre-check/pre-fill existing selections when we're still viewing the type
    // that's actually saved on the link — a freshly switched-to type has no matches yet.
    $selected_ids     = [];
    $selected_amounts = [];

    if ($type == $original_type) {

        $selected = $this->db->get_where('associatelink_to_lunar', ['associate_link_id' => $link_id])->result();

        foreach ($selected as $row) {
            $selected_ids[] = $row->lunar_schedule_id;
            $selected_amounts[$row->lunar_schedule_id] = $row->amount;
        }
    }

    $data['selected_ids']     = $selected_ids;
    $data['selected_amounts'] = $selected_amounts;

    $this->load->view("editlinkfranchise.php", $data);
}
    
    
   public function editlink()
{
    $link_id = $this->uri->segment('4');

    // Get the associate link data
    $data['associate_link_data'] = $associate_link_data = $this->db->get_where('associate_link', ['associate_link_id' => $link_id])->row();

    if (empty($associate_link_data)) {
        show_404();
        return;
    }

    // Get the associate data
    $associate_id = $associate_link_data->associate_id;
    $data['associate'] = $this->db->get_where('associates', ['associate_id' => $associate_id])->row();

    // The type currently saved on this link (before anything in this request changes it)
    $original_type = $associate_link_data->program_type;

    // Type shown on screen: GET (type switcher) wins, then POST (hidden field on submit),
    // else fall back to whatever is already saved on the link.
    $type = $this->input->get('type')
        ? $this->input->get('type')
        : ($this->input->post('type') ? $this->input->post('type') : $original_type);

    // Handle form submission
    if (isset($_POST['submit'])) {

        $post_type = $this->input->post('type');

        $schedule_data = [
            'expire_date'           => $this->input->post('expire_date'),
            'status'                => $this->input->post('status'),
            'franchise_id'          => $this->input->post('franchise'),
            'franchise_percentage'  => $this->input->post('franchise_percentage'),
            'associate_percentage'  => $this->input->post('associate_percentage'),
            'crm_id'                => $this->input->post('crm'),
            'crm_percentage'        => $this->input->post('crm_percentage'),
            'program_type'          => $post_type,
        ];

        $this->db->where('associate_link_id', $link_id);
        $this->db->update('associate_link', $schedule_data);

        // Delete all existing associations for this link (old type's or new type's — either way, replaced below)
        $this->db->where('associate_link_id', $link_id);
        $this->db->delete('associatelink_to_lunar');

        // Insert new associations
        $ids     = $this->input->post('ids');
        $amounts = $this->input->post('amount'); // amount[<id>] => value

        if (!empty($ids) && is_array($ids)) {

            $program_insert_data = [];

            foreach ($ids as $id) {

                $amount = isset($amounts[$id]) ? $amounts[$id] : 0;

                $program_insert_data[] = [
                    'associate_link_id' => $link_id,
                    'lunar_schedule_id' => $id,
                    'program_type'      => $post_type,
                    'amount'            => $amount,
                ];
            }

            $this->db->insert_batch('associatelink_to_lunar', $program_insert_data);
        }

        if ($this->db->affected_rows() > 0) {
            $data['message'] = 'Associate link updated successfully!';
            $data['status']  = 'success';
        } else {
            $data['message'] = 'No changes made.';
            $data['status']  = 'warning';
        }

        // Refresh the row so the form below reflects what was just saved
        $data['associate_link_data'] = $associate_link_data = $this->db->get_where('associate_link', ['associate_link_id' => $link_id])->row();
        $original_type = $associate_link_data->program_type;
        $type = $original_type;
    }

    $data['states']    = $this->db->get_where('states', ['country_id' => '105'])->result_array();
    $data['franchise'] = $this->db->get_where('franchise', ['status' => 'Active', 'account_id !=' => ''])->result();
    $data['crm']       = $this->db->get_where('gst_account_marrs', ['title' => 'CRM'])->result();

    $data['type'] = $type;

    $schedules_lunar = [];
    $schedules_marrs = [];

    if ($type == 'lunar') {
        $schedules_lunar = $this->db->get_where('lunar_schedule_cin', ['period_id' => '16'])->result();
    } elseif ($type == 'marrs') {
        $schedules_marrs = $this->db->get_where('competition_product_state', ['period_id' => '16', 'status' => 'Live'])->result();
    }

    $data['schedules_lunar'] = $schedules_lunar;
    $data['schedules_marrs'] = $schedules_marrs;

    // Only pre-check/pre-fill existing selections when we're still viewing the type
    // that's actually saved on the link — a freshly switched-to type has no matches yet.
    $selected_ids     = [];
    $selected_amounts = [];

    if ($type == $original_type) {

        $selected = $this->db->get_where('associatelink_to_lunar', ['associate_link_id' => $link_id])->result();

        foreach ($selected as $row) {
            $selected_ids[] = $row->lunar_schedule_id;
            $selected_amounts[$row->lunar_schedule_id] = $row->amount;
        }
    }

    $data['selected_ids']     = $selected_ids;
    $data['selected_amounts'] = $selected_amounts;

    $this->load->view("editlink.php", $data);
}
    
    public function edit_profile()
    {
        $associate_id = $this->uri->segment('4');

            if (isset($_POST['submit'])) {
                $associate_data = [
                    'first_name'    => $this->input->post('first_name'),
                    'last_name'     => $this->input->post('last_name'),
                    'email'         => $this->input->post('email'),
                    'phone'         => $this->input->post('phone'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'gender'        => $this->input->post('gender'),
                    'address'       => $this->input->post('address'),
                    'city'          => $this->input->post('city'),
                    'state'         => $this->input->post('state'),
                    'postal_code'   => $this->input->post('postal_code'),
                    'country'       => $this->input->post('country'),
                ];

            $email_exists = $this->db->where('email', $associate_data['email'])
                                    ->where('associate_id !=', $associate_id)
                                    ->count_all_results('associates') > 0;
    
            $phone_exists = $this->db->where('phone', $associate_data['phone'])
                                    ->where('associate_id !=', $associate_id)
                                    ->count_all_results('associates') > 0;
    
            if ($email_exists) {
                $data['message'] = 'The email address is already in use. Please use a different email.';
                $data['status'] = 'error';
            } elseif ($phone_exists) {
                $data['message'] = 'The phone number is already in use. Please use a different phone number.';
                $data['status'] = 'error';
            } else {
                $this->db->where('associate_id', $associate_id);
                $this->db->update('associates', $associate_data);
    
                if ($this->db->affected_rows() > 0) {
                    $data['message'] = 'Associate details updated successfully.';
                    $data['status'] = 'success';
                } else {
                    $data['message'] = 'No changes were made or update failed.';
                    $data['status'] = 'error';
                }
            }
        }
    
        $data['associate'] = $this->db->get_where('associates', ['associate_id' => $associate_id])->row();
        // print_r($data['associate']);die;
        $data['states'] = $this->db->get_where('states', ['country_id' => '105'])->result_array();
    
        $this->load->view("edit_profile.php", $data);
    }
    
    
    
    public function edit_bank()
    {
        $associate_id = $this->uri->segment('4');
        $data['bank_details'] = $this->db->get_where('associate_bank_details', ['associate_id' => $associate_id])->row();

        if (isset($_POST['submit'])) {
            // Prepare data for update
            $bank_data = [
                'bank_name' => $this->input->post('bank_name'),
                'account_number' => $this->input->post('account_number'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'branch_name' => $this->input->post('branch_name'),
            ];
    
            // Update bank details in the database
            $this->db->where('associate_id', $associate_id);
            $update = $this->db->update('associate_bank_details', $bank_data);
    
            // Feedback message
            if ($update) {
                $data['message'] = "Bank details updated successfully.";
            } else {
                $data['message'] = "Failed to update bank details. Please try again.";
            }
    
            // Fetch updated details
            $data['bank_details'] = $this->db->get_where('associate_bank_details', ['associate_id' => $associate_id])->row();
        }
    
        $this->load->view("edit_bank.php", $data);
    }
    
    
    
    public function lunarcompetition_activate()
    {
        //echo '9k';die;
        // $today = date('Y-m-d');
        // $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        // $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        // $this->db->where('lunar_schedule_cin.start_date <=', $today);
        // $this->db->order_by('lunar_schedule_id','DESC');
        // $this->db->limit(10);
        // $data['competition'] = $this->db->get('lunar_schedule_cin')->result();
        
            if(isset($_POST['submit'])){
                
                // print_r($_POST);die;
                
                $ar=array(
                    'period_id'=>$data['competition'][0]->period_id,
                    'subject'=>$data['competition'][0]->subject,
                    'type'=>$data['competition'][0]->type,
                    'series'=>$data['competition'][0]->series,
                    'product_name'=>$data['competition'][0]->product_name,
                    'clevel'=>$data['competition'][0]->level_id
                );
                
                
                $this->db->where('id',$data['competition'][0]->revenue_setting);
                $this->db->delete('revenue_setting');
                
                $this->db->where('id',$_POST['submit']);
                $this->db->delete('competition_product_state');
                
                
            }
            
            if(isset($_POST['search'])){
                // print_r($_POST);die;
                $this->db->select('*');
                $this->db->from('lunar_schedule_cin');
                $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id', 'left');
                $this->db->join('period','period.period_id=lunar_schedule_cin.period_id', 'left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id', 'left');
                $this->db->where('lunar_schedule_cin.period_id',$_POST['period']);
                // $this->db->where('lunar_schedule_cin.state_id',$_POST['state_id']);
                $this->db->where('subject',$_POST['subject']);
                // $this->db->where('series',$_POST['series']);
                $this->db->where('lunar_schedule_cin.level_id',$_POST['level']);
                $this->db->order_by('lunar_schedule_id','DESC');
                $query=$this->db->get();
                $data['competition']=$query->result();
                $data['result']=$_POST;
            }
        
            $this->db->select('*');
            $this->db->from('lunar_subjects');
            // $this->db->where('subject !=','');
            // $this->db->where('series !=','');
            // $this->db->where('product_name','Lunar Skill Test');
            $this->db->where('status','Active');
            $this->db->order_by('sub_id','DESC');
            $query = $this->db->get();
            $data['sub']= $query->row();
        
        
    // echo $this->db->last_query();
        $this->db->where('period_id >', 13);
        $data['period'] = $this->db->get('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct',['product_name'=>'Lunar Skill Test'])->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active','product_id'=>'8'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        
            $this->db->select('associates.first_name,associates.associate_id,associates.last_name');
            $this->db->from('associates');
            $this->db->join('associate_bank_details','associate_bank_details.associate_id=associates.associate_id');
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['associate']= $query->result_array();
            
        $this->load->view("lunarcompetition_activate.php", $data); 
    }



    public function lunarcompetition_assign()
    {
        $comp_id = $exam_id = $this->uri->segment(4);
        
        $this->db->join('products','products.product_name=lunar_schedule_cin.product_name');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id' ,'left');
        $data['competition'] = $competition = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id'=>$comp_id))->row();
        // print_r($data['competition']);die;
        
        $data['freemat'] =  $study_material = $this->db
            ->select('study_material.*, assigned_materials.maker_id')
            ->from('study_material')
            ->join(
                'assigned_materials',
                'assigned_materials.mat_id = study_material.id'
            )
            ->where([
                'study_material.product_name' => $competition->product_name,
                'study_material.status'       => 'Free',
                'study_material.clevel'       => $competition->level_id,
                'study_material.subject'      => $competition->subject,
                'study_material.series'       => $competition->series,
                'study_material.sub_type'     => $competition->type,
                'assigned_materials.period_id'=> $competition->period_id
            ])
            ->limit(1)
            ->get()
            ->row();

       
        
        // echo $this->db->last_query();
        
        if(isset($_POST['submit']))
        {
            
            
            // echo '<pre>';
            // print_R($_POST);
            // print_r($data['competition']);die;
            
            
            $period_id = $data['competition']->period_id;
            // $state_id = $data['competition']state_id');
            $product_name = $data['competition']->product_name;
            $competition_level_id = $data['competition']->level_id;
            $product_price = $data['competition']->amount;
            
            $study_material_a = $this->input->post('study_material_a');
            $study_material_a_price = $this->input->post('study_material_a_price');
            $study_material_b = $this->input->post('study_material_b');
            $study_material_b_price = $this->input->post('study_material_b_price');
            $study_material_c = $this->input->post('study_material_c');
            $study_material_c_price = $this->input->post('study_material_c_price');
            $study_material_d = $this->input->post('study_material_d');
            $study_material_d_price = $this->input->post('study_material_d_price');
            $study_material_e = $this->input->post('study_material_e');
            $study_material_e_price = $this->input->post('study_material_e_price');
            $study_material_f = $this->input->post('study_material_f');
            $study_material_f_price = $this->input->post('study_material_f_price');

            $orientation_a = $this->input->post('orientation_a');
            $orientation_a_price = $this->input->post('orientation_a_price');
            $orientation_b = $this->input->post('orientation_b');
            $orientation_b_price = $this->input->post('orientation_b_price');
            $orientation_c = $this->input->post('orientation_c');
            $orientation_c_price = $this->input->post('orientation_c_price');
            $orientation_d = $this->input->post('orientation_d');
            $orientation_d_price = $this->input->post('orientation_d_price');
            $orientation_e = $this->input->post('orientation_e');
            $orientation_e_price = $this->input->post('orientation_e_price');
            $orientation_f = $this->input->post('orientation_f');
            $orientation_f_price = $this->input->post('orientation_f_price');
            
            // $mock_test = $this->input->post('mock_test');
            // $mock_test_price = $this->input->post('mock_test_price');
            
            
            $mock_test_a = $this->input->post('mock_a');
            $mock_test_a_price = $this->input->post('mock_a_price');
            $mock_test_b = $this->input->post('mock_b');
            $mock_test_b_price = $this->input->post('mock_b_price');
            $mock_test_c = $this->input->post('mock_c');
            $mock_test_c_price = $this->input->post('mock_c_price');
            $mock_test_d = $this->input->post('mock_d');
            $mock_test_d_price = $this->input->post('mock_d_price');
            $mock_test_e = $this->input->post('mock_e');
            $mock_test_e_price = $this->input->post('mock_e_price');
            $mock_test_f = $this->input->post('mock_f');
            $mock_test_f_price = $this->input->post('mock_f_price');
            $product_price = $this->input->post('mock_f_price');
            
            
            $crm_fix = $data['competition']->crm_fix;
            // $close_date = $this->input->post('close_date');
            
            $arr = array(
                'product_name' => 'Lunar Skill Test',
                'product_price' => $product_price,
                'mock_test' => $mock_test,
                'clevel'    => $competition_level_id,
                'status'    => 'Live',
                'state_id'  => $data['competition']->state_id,
                // 'period_id' => $period_id
            );
            
            
            $arr['series'] = $data['competition']->series;
            $arr['subject'] = $data['competition']->subject;
            $arr['type'] = $data['competition']->type;
            
            if ($study_material_a == 'on') {
                $arr['study_material_a'] = 'study_material_a';
            }
            if ($study_material_b == 'on') {
                $arr['study_material_b'] = 'study_material_b';
            }
            if ($study_material_c == 'on') {
                $arr['study_material_c'] = 'study_material_c';
            }
            if ($study_material_d == 'on') {
                $arr['study_material_d'] = 'study_material_d';
            }
            if ($study_material_e == 'on') {
                $arr['study_material_e'] = 'study_material_e';
            }
            if ($study_material_f == 'on') {
                $arr['study_material_f'] = 'study_material_f';
            }
            
            
            if ($orientation_a == 'on') {
                $arr['orientation_a'] = 'orientation_a';
            }
            if ($orientation_b == 'on') {
                $arr['orientation_b'] = 'orientation_b';
            }
            if ($orientation_c == 'on') {
                $arr['orientation_c'] = 'orientation_c';
            }
            if ($orientation_d == 'on') {
                $arr['orientation_d'] = 'orientation_d';
            }
            if ($orientation_e == 'on') {
                $arr['orientation_e'] = 'orientation_e';
            }
            if ($orientation_f == 'on') {
                $arr['orientation_f'] = 'orientation_f';
            }
            
            
            if ($mock_test == 'on') {
                $arr['mock_test'] = 'mock_test';
            }
            
            
            
            if ($mock_test_a == 'on') {
                $arr['mock_test_a'] = 'mock_test_a';
            }
            if ($mock_test_b == 'on') {
                $arr['mock_test_b'] = 'mock_test_b';
            }
            if ($mock_test_c == 'on') {
                $arr['mock_test_c'] = 'mock_test_c';
            }
            if ($mock_test_d == 'on') {
                $arr['mock_test_d'] = 'mock_test_d';
            }
            if ($mock_test_e == 'on') {
                $arr['mock_test_e'] = 'mock_test_e';
            }
            if ($mock_test_f == 'on') {
                $arr['mock_test_f'] = 'mock_test_f';
            }
            
            
            
            $arr['orientation_a_price'] = $orientation_a_price;
            $arr['orientation_b_price'] = $orientation_b_price;
            $arr['orientation_c_price'] = $orientation_c_price;
            $arr['orientation_d_price'] = $orientation_d_price;
            $arr['orientation_e_price'] = $orientation_e_price;
            $arr['orientation_f_price'] = $orientation_f_price;
            
            $arr['mock_test_a_price'] = $mock_test_a_price;
            $arr['mock_test_b_price'] = $mock_test_b_price;
            $arr['mock_test_c_price'] = $mock_test_c_price;
            $arr['mock_test_d_price'] = $mock_test_d_price;
            $arr['mock_test_e_price'] = $mock_test_e_price;
            $arr['mock_test_f_price'] = $mock_test_f_price;
            
            $arr['period_id'] = $data['competition']->period_id;
            
            
                $arr['associate_split']='Yes';
                $arr['com_per']=$data['competition']->franchise_percentage;
                $arr['associate_per']=$data['competition']->associate_cut;
                $arr['franchise_id']=$data['competition']->franchise_id;
                $arr['associate_id']=$data['competition']->associate_id;
                $arr['aviansys_split']='yes';
                $arr['manageper']=$data['competition']->management_percentage;
                $arr['com_peravian']=$data['competition']->aviansys_percentage;
                $arr['associate_gst']='Yes';
                $arr['close_date']=$_POST['exam_date'];
                $arr['aviansys_gst']='Yes';
                
                $arr['crm_fix']=$crm_fix;
                $arr['scheme']='new';
                
                if(!empty($data['competition']->franchise_percentage) or $data['competition']->franchise_percentage != 0 ){
                    $arr['franchise_split']='Yes';
                    $franchise = $this->db->get_where('franchise',array('franchise_id'=>$data['competition']->franchise_id))->row();
                    if($franchise->gst == 'Yes'){
                        $arr['franchise_gst']='Yes';
                    }
                    
                }
                $arr['compschdule_id']=$exam_id;
                
            // echo '<pre>';    
            // print_r($_POST);
            // echo '<br>'.$_POST['study_material_b_maker_price'];
            
            
            $revenue_setting=[
                'period_id'=>$period_id,
                'product_name'=>'Lunar Skill Test',
                'product_id'=>$data['competition']->product_id,
                'clevel'=>$competition_level_id,
                'com_per'=>$data['competition']->franchise_percentage,
                'manageper'=>$data['competition']->management_percentage,
                'com_peravian'=>$data['competition']->aviansys_percentage,
                'associate_per'=>$data['competition']->associate_cut,
                'crm_fix'=>$crm_fix,
                'study_material_a_price'=>$_POST['study_material_a_price'],
                'study_material_b_price'=>$_POST['study_material_b_price'],
                'study_material_c_price'=>$_POST['study_material_c_price'],
                'study_material_d_price'=>$_POST['study_material_d_price'],
                'study_material_e_price'=>$_POST['study_material_e_price'],
                'study_material_f_price'=>$_POST['study_material_f_price'],
                'mock_test_a_price'=>$_POST['mock_test_a_price'],
                'mock_test_b_price'=>$_POST['mock_test_b_price'],
                'mock_test_c_price'=>$_POST['mock_test_c_price'],
                'mock_test_d_price'=>$_POST['mock_test_d_price'],
                'mock_test_e_price'=>$_POST['mock_test_e_price'],
                'mock_test_f_price'=>$_POST['mock_test_f_price'],
                'orientation_a_price'=>$_POST['orientation_a_price'],
                'orientation_b_price'=>$_POST['orientation_b_price'],
                'orientation_c_price'=>$_POST['orientation_c_price'],
                'orientation_d_price'=>$_POST['orientation_d_price'],
                'orientation_e_price'=>$_POST['orientation_e_price'],
                'orientation_f_price'=>$_POST['orientation_f_price'],
                'product_price'=>$product_price,
                'study_material_a_price_royalty'=>$_POST['study_material_a_price_royalty'],
                'study_material_b_price_royalty'=>$_POST['study_material_b_price_royalty'],
                'study_material_c_price_royalty'=>$_POST['study_material_c_price_royalty'],
                'study_material_d_price_royalty'=>$_POST['study_material_d_price_royalty'],
                'study_material_e_price_royalty'=>$_POST['study_material_e_price_royalty'],
                'study_material_f_price_royalty'=>$_POST['study_material_f_price_royalty'],
                'mock_test_a_price_royalty'=>$_POST['mock_test_a_price_royalty'],
                'mock_test_b_price_royalty'=>$_POST['mock_test_b_price_royalty'],
                'mock_test_c_price_royalty'=>$_POST['mock_test_c_price_royalty'],
                'mock_test_d_price_royalty'=>$_POST['mock_test_d_price_royalty'],
                'mock_test_e_price_royalty'=>$_POST['mock_test_e_price_royalty'],
                'mock_test_f_price_royalty'=>$_POST['mock_test_f_price_royalty'],
                'series' => $data['competition']->series,
                'subject' => $data['competition']->subject,
                'type' => $data['competition']->type,
                'study_material_free_royalty' => $_POST['study_material_free_royalty'],
                // 'mock_Test_free_royalty' => $this->input->post('mock_Test_free_royalty')
                 'compschdule_id'=>$exam_id
            ];
            
            // echo '<pre>';
            // print_R($arr);
            // print_r($revenue_setting);
            // die;
            
            
            $this->db->insert('revenue_setting',$revenue_setting);
            $revenue_setting_id = $this->db->insert_id();
            
            
            
            $arr['revenue_setting_id'] = $revenue_setting_id;
            
            $this->db->insert('competition_product_state',$arr);
            // $comp_id = $this->db->insert_id();
           
            $this->db->where('lunar_schedule_id',$exam_id);
            $this->db->update('lunar_schedule_cin',['maker_id'=>$_POST['maker_id']]);
            
            redirect('manage/lunar/lunarcompetition_activate', 'refresh');
        }
        
        $this->db->join('products','products.product_name=lunar_schedule_cin.product_name');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id' ,'left');
        $data['competition'] = $competition = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id'=>$comp_id))->row();
        // print_r($data['competition']);die;
        
        // echo $this->db->last_query();
        
        
        $data['lunar_schedule_class'] = $this->db->get_where('lunar_schedule_class',array('sch_id'=>$comp_id))->result();
        
        
        $this->load->view("competition_assign.php", $data);
    }
    
    
    public function lunarcompetition_assignupdate()
    {
         $comp_id = $exam_id = $this->uri->segment(4);
         $data['revenuesettingedit']= $this->db->get_where('competition_product_state',array('compschdule_id'=>$comp_id))->row();
          $data['royality']= $this->db->get_where('revenue_setting',array('compschdule_id'=>$comp_id))->row();
         if(!empty($data['revenuesettingedit'])){
             
        
        
        $this->db->join('products','products.product_name=lunar_schedule_cin.product_name');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id' ,'left');
        $data['competition'] = $competition = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id'=>$comp_id))->row();
         //print_r($data['competition']);die;
        
        $data['freemat'] =  $study_material = $this->db
            ->select('study_material.*, assigned_materials.maker_id')
            ->from('study_material')
            ->join(
                'assigned_materials',
                'assigned_materials.mat_id = study_material.id'
            )
            ->where([
                'study_material.product_name' => $competition->product_name,
                'study_material.status'       => 'Free',
                'study_material.clevel'       => $competition->level_id,
                'study_material.subject'      => $competition->subject,
                'study_material.series'       => $competition->series,
                'study_material.sub_type'     => $competition->type,
                'assigned_materials.period_id'=> $competition->period_id
            ])
            ->limit(1)
            ->get()
            ->row();

       
        
        // echo $this->db->last_query();
        
        if(isset($_POST['submit']))
        {
            
            
            // echo '<pre>';
            // print_R($_POST);
            // print_r($data['competition']);die;
            
            
            $period_id = $data['competition']->period_id;
            // $state_id = $data['competition']state_id');
            $product_name = $data['competition']->product_name;
            $competition_level_id = $data['competition']->level_id;
            $product_price = $data['competition']->amount;
            
            $study_material_a = $this->input->post('study_material_a');
            $study_material_a_price = $this->input->post('study_material_a_price');
            $study_material_b = $this->input->post('study_material_b');
            $study_material_b_price = $this->input->post('study_material_b_price');
            $study_material_c = $this->input->post('study_material_c');
            $study_material_c_price = $this->input->post('study_material_c_price');
            $study_material_d = $this->input->post('study_material_d');
            $study_material_d_price = $this->input->post('study_material_d_price');
            $study_material_e = $this->input->post('study_material_e');
            $study_material_e_price = $this->input->post('study_material_e_price');
            $study_material_f = $this->input->post('study_material_f');
            $study_material_f_price = $this->input->post('study_material_f_price');

            $orientation_a = $this->input->post('orientation_a');
            $orientation_a_price = $this->input->post('orientation_a_price');
            $orientation_b = $this->input->post('orientation_b');
            $orientation_b_price = $this->input->post('orientation_b_price');
            $orientation_c = $this->input->post('orientation_c');
            $orientation_c_price = $this->input->post('orientation_c_price');
            $orientation_d = $this->input->post('orientation_d');
            $orientation_d_price = $this->input->post('orientation_d_price');
            $orientation_e = $this->input->post('orientation_e');
            $orientation_e_price = $this->input->post('orientation_e_price');
            $orientation_f = $this->input->post('orientation_f');
            $orientation_f_price = $this->input->post('orientation_f_price');
            
            // $mock_test = $this->input->post('mock_test');
            // $mock_test_price = $this->input->post('mock_test_price');
            
            
            $mock_test_a = $this->input->post('mock_a');
            $mock_test_a_price = $this->input->post('mock_a_price');
            $mock_test_b = $this->input->post('mock_b');
            $mock_test_b_price = $this->input->post('mock_b_price');
            $mock_test_c = $this->input->post('mock_c');
            $mock_test_c_price = $this->input->post('mock_c_price');
            $mock_test_d = $this->input->post('mock_d');
            $mock_test_d_price = $this->input->post('mock_d_price');
            $mock_test_e = $this->input->post('mock_e');
            $mock_test_e_price = $this->input->post('mock_e_price');
            $mock_test_f = $this->input->post('mock_f');
            $mock_test_f_price = $this->input->post('mock_f_price');
            $product_price = $this->input->post('mock_f_price');
            
            
            $crm_fix = $data['competition']->crm_fix;
            // $close_date = $this->input->post('close_date');
            
            $arr = array(
                'product_name' => 'Lunar Skill Test',
                'product_price' => $product_price,
                'mock_test' => $mock_test,
                'clevel'    => $competition_level_id,
                'status'    => 'Live',
                'state_id'  => $data['competition']->state_id,
                // 'period_id' => $period_id
            );
            
            
            $arr['series'] = $data['competition']->series;
            $arr['subject'] = $data['competition']->subject;
            $arr['type'] = $data['competition']->type;
            
            if ($study_material_a == 'on') {
                $arr['study_material_a'] = 'study_material_a';
            }
            if ($study_material_b == 'on') {
                $arr['study_material_b'] = 'study_material_b';
            }
            if ($study_material_c == 'on') {
                $arr['study_material_c'] = 'study_material_c';
            }
            if ($study_material_d == 'on') {
                $arr['study_material_d'] = 'study_material_d';
            }
            if ($study_material_e == 'on') {
                $arr['study_material_e'] = 'study_material_e';
            }
            if ($study_material_f == 'on') {
                $arr['study_material_f'] = 'study_material_f';
            }
            
            
            if ($orientation_a == 'on') {
                $arr['orientation_a'] = 'orientation_a';
            }
            if ($orientation_b == 'on') {
                $arr['orientation_b'] = 'orientation_b';
            }
            if ($orientation_c == 'on') {
                $arr['orientation_c'] = 'orientation_c';
            }
            if ($orientation_d == 'on') {
                $arr['orientation_d'] = 'orientation_d';
            }
            if ($orientation_e == 'on') {
                $arr['orientation_e'] = 'orientation_e';
            }
            if ($orientation_f == 'on') {
                $arr['orientation_f'] = 'orientation_f';
            }
            
            
            if ($mock_test == 'on') {
                $arr['mock_test'] = 'mock_test';
            }
            
            
            
            if ($mock_test_a == 'on') {
                $arr['mock_test_a'] = 'mock_test_a';
            }
            if ($mock_test_b == 'on') {
                $arr['mock_test_b'] = 'mock_test_b';
            }
            if ($mock_test_c == 'on') {
                $arr['mock_test_c'] = 'mock_test_c';
            }
            if ($mock_test_d == 'on') {
                $arr['mock_test_d'] = 'mock_test_d';
            }
            if ($mock_test_e == 'on') {
                $arr['mock_test_e'] = 'mock_test_e';
            }
            if ($mock_test_f == 'on') {
                $arr['mock_test_f'] = 'mock_test_f';
            }
            
            
            
            $arr['orientation_a_price'] = $orientation_a_price;
            $arr['orientation_b_price'] = $orientation_b_price;
            $arr['orientation_c_price'] = $orientation_c_price;
            $arr['orientation_d_price'] = $orientation_d_price;
            $arr['orientation_e_price'] = $orientation_e_price;
            $arr['orientation_f_price'] = $orientation_f_price;
            
            $arr['mock_test_a_price'] = $mock_test_a_price;
            $arr['mock_test_b_price'] = $mock_test_b_price;
            $arr['mock_test_c_price'] = $mock_test_c_price;
            $arr['mock_test_d_price'] = $mock_test_d_price;
            $arr['mock_test_e_price'] = $mock_test_e_price;
            $arr['mock_test_f_price'] = $mock_test_f_price;
            
            $arr['period_id'] = $data['competition']->period_id;
            
            
                $arr['associate_split']='Yes';
                $arr['com_per']=$data['competition']->franchise_percentage;
                $arr['associate_per']=$data['competition']->associate_cut;
                $arr['franchise_id']=$data['competition']->franchise_id;
                $arr['associate_id']=$data['competition']->associate_id;
                $arr['aviansys_split']='yes';
                $arr['manageper']=$data['competition']->management_percentage;
                $arr['com_peravian']=$data['competition']->aviansys_percentage;
                $arr['associate_gst']='Yes';
                $arr['close_date']=$_POST['exam_date'];
                $arr['aviansys_gst']='Yes';
                
                $arr['crm_fix']=$crm_fix;
                $arr['scheme']='new';
                
                if(!empty($data['competition']->franchise_percentage) or $data['competition']->franchise_percentage != 0 ){
                    $arr['franchise_split']='Yes';
                    $franchise = $this->db->get_where('franchise',array('franchise_id'=>$data['competition']->franchise_id))->row();
                    if($franchise->gst == 'Yes'){
                        $arr['franchise_gst']='Yes';
                    }
                    
                }
               
               $arr['compschdule_id']=$exam_id;
            // echo '<pre>';    
            // print_r($_POST);
            // echo '<br>'.$_POST['study_material_b_maker_price'];
            
            
            $revenue_setting=[
                'period_id'=>$period_id,
                'product_name'=>'Lunar Skill Test',
                'product_id'=>$data['competition']->product_id,
                'clevel'=>$competition_level_id,
                'com_per'=>$data['competition']->franchise_percentage,
                'manageper'=>$data['competition']->management_percentage,
                'com_peravian'=>$data['competition']->aviansys_percentage,
                'associate_per'=>$data['competition']->associate_cut,
                'crm_fix'=>$crm_fix,
                'study_material_a_price'=>$_POST['study_material_a_price'],
                'study_material_b_price'=>$_POST['study_material_b_price'],
                'study_material_c_price'=>$_POST['study_material_c_price'],
                'study_material_d_price'=>$_POST['study_material_d_price'],
                'study_material_e_price'=>$_POST['study_material_e_price'],
                'study_material_f_price'=>$_POST['study_material_f_price'],
                'mock_test_a_price'=>$_POST['mock_test_a_price'],
                'mock_test_b_price'=>$_POST['mock_test_b_price'],
                'mock_test_c_price'=>$_POST['mock_test_c_price'],
                'mock_test_d_price'=>$_POST['mock_test_d_price'],
                'mock_test_e_price'=>$_POST['mock_test_e_price'],
                'mock_test_f_price'=>$_POST['mock_test_f_price'],
                'orientation_a_price'=>$_POST['orientation_a_price'],
                'orientation_b_price'=>$_POST['orientation_b_price'],
                'orientation_c_price'=>$_POST['orientation_c_price'],
                'orientation_d_price'=>$_POST['orientation_d_price'],
                'orientation_e_price'=>$_POST['orientation_e_price'],
                'orientation_f_price'=>$_POST['orientation_f_price'],
                'product_price'=>$product_price,
                'study_material_a_price_royalty'=>$_POST['study_material_a_price_royalty'],
                'study_material_b_price_royalty'=>$_POST['study_material_b_price_royalty'],
                'study_material_c_price_royalty'=>$_POST['study_material_c_price_royalty'],
                'study_material_d_price_royalty'=>$_POST['study_material_d_price_royalty'],
                'study_material_e_price_royalty'=>$_POST['study_material_e_price_royalty'],
                'study_material_f_price_royalty'=>$_POST['study_material_f_price_royalty'],
                'mock_test_a_price_royalty'=>$_POST['mock_test_a_price_royalty'],
                'mock_test_b_price_royalty'=>$_POST['mock_test_b_price_royalty'],
                'mock_test_c_price_royalty'=>$_POST['mock_test_c_price_royalty'],
                'mock_test_d_price_royalty'=>$_POST['mock_test_d_price_royalty'],
                'mock_test_e_price_royalty'=>$_POST['mock_test_e_price_royalty'],
                'mock_test_f_price_royalty'=>$_POST['mock_test_f_price_royalty'],
                'series' => $data['competition']->series,
                'subject' => $data['competition']->subject,
                'type' => $data['competition']->type,
                'study_material_free_royalty' => $_POST['study_material_free_royalty'],
                // 'mock_Test_free_royalty' => $this->input->post('mock_Test_free_royalty')
                'compschdule_id'=>$exam_id
                
            ];
            
            // echo '<pre>';
            // print_R($arr);
            // print_r($revenue_setting);
            // die;
            
            $this->db->where('compschdule_id',$exam_id);
            $this->db->update('revenue_setting',$revenue_setting);
            //$revenue_setting_id = $this->db->insert_id();
            
            
            
            $arr['revenue_setting_id'] = $revenue_setting_id;
            $this->db->where('compschdule_id',$exam_id);
            $this->db->update('competition_product_state',$arr);
            // $comp_id = $this->db->insert_id();
           
            $this->db->where('lunar_schedule_id',$exam_id);
            $this->db->update('lunar_schedule_cin',['maker_id'=>$_POST['maker_id']]);
            
            redirect('manage/lunar/lunarcompetition_activate', 'refresh');
           }
         }
        $this->db->join('products','products.product_name=lunar_schedule_cin.product_name');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id' ,'left');
        $data['competition'] = $competition = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id'=>$comp_id))->row();
        // print_r($data['competition']);die;
        
        // echo $this->db->last_query();
        
        
        $data['lunar_schedule_class'] = $this->db->get_where('lunar_schedule_class',array('sch_id'=>$comp_id))->result();
        
        
        $this->load->view("competition_assignupdate.php", $data);
    }


    public function schedule_list()
    {
        // echo 'ok';die;
            if(isset($_POST['submit'])){
                // print_r($_POST);die;
                $this->db->select('*');
                $this->db->from('lunar_schedule_cin');
                $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id', 'left');
                $this->db->join('franchise','franchise.franchise_id=lunar_schedule_cin.franchise_id', 'left');
                $this->db->join('period','period.period_id=lunar_schedule_cin.period_id', 'left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id', 'left');
                $this->db->where('lunar_schedule_cin.period_id',$_POST['period']);
                // $this->db->where('lunar_schedule_cin.state_id',$_POST['state_id']);
                $this->db->where('subject',$_POST['subject']);
                // $this->db->where('series',$_POST['series']);
                $this->db->where('lunar_schedule_cin.level_id',$_POST['level']);
                $this->db->order_by('lunar_schedule_id','DESC');
                $query=$this->db->get();
                $data['list']=$query->result_array();
                $data['result']=$_POST;
            }else{
                $this->db->select('*');
                $this->db->from('lunar_schedule_cin');
                $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id', 'left');
                $this->db->join('franchise','franchise.franchise_id=lunar_schedule_cin.franchise_id', 'left');
                $this->db->join('period','period.period_id=lunar_schedule_cin.period_id', 'left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id', 'left');
                $this->db->order_by('lunar_schedule_id','DESC');
                $query=$this->db->get();
                // echo $this->db->last_query();
                $data['list']=$query->result_array();
            }
        
        
            $data['productload'] = $this->db->get_where('products',array('product_name'=>'Lunar Skill Test'))->result_array();
            $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
            
                if(isset($data['result']['state_id'])){
                    $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
                }
            
                if(isset($data['result']['country'])){
                    $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
                }
                
            if(isset($data['result']['franchise_id'])){
                $this->db->select('*');
                $this->db->from('areas');
                $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
                $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
                $query=$this->db->get();
                $data['areaload'] = $query->result_array();
            }
            
            $this->db->select('associates.associate_id,first_name,last_name');
            $this->db->from('associates');
            $this->db->join('associate_bank_details','associate_bank_details.associate_id=associates.associate_id');
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['associates'] = $query->result_array();
            
            $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>'Lunar Skill Test'))->result_array();
        
        $this->load->view("schedule_list_lunar",$data);
    }
    
 public function lunar_program_list()
{
    // -----------------------------------------
    // 1. Get all active programs
    // -----------------------------------------
    $this->db->select('
        lp.id AS program_id,
        lp.program_name,
        lp.status AS program_status,
        lp.franchise_percentage,
        lp.franchise_cut,
        lp.management_percentage,
        lp.aviansys_percentage,
        lp.maker_percentage,
        lp.associate_id,
        lp.associate_percentage,
        lp.it_percentage,
        lp.crm_per
    ');
    $this->db->from('lunar_programs AS lp');
    $this->db->where('lp.status', 'Active');
    $this->db->order_by('lp.id', 'ASC');

    $programs = $this->db->get()->result_array();

    $list = [];

    // -----------------------------------------
    // 2. Get Plans + Components for each Program
    // -----------------------------------------
    foreach ($programs as $program) {

        $program_id = (int) $program['program_id'];

        // Plans
        $this->db->select('
            id,
            program_id,
            plan_name,
            final_price
        ');
        $this->db->from('lunar_plans');
        $this->db->where('program_id', $program_id);
        $this->db->where('status', 'Active');
        $this->db->order_by('id', 'ASC');

        $plans = $this->db->get()->result_array();

        // Components
        $this->db->select('
            id,
            program_id,
            component_name,
            unit_price
        ');
        $this->db->from('lp_components');
        $this->db->where('program_id', $program_id);
        $this->db->where('status', 'Active');
        $this->db->order_by('id', 'ASC');

        $components = $this->db->get()->result_array();

        // -----------------------------------------
        // Prepare simple display rows
        // -----------------------------------------
        $items = [];

        // Plan rows
        foreach ($plans as $plan) {
            $items[] = [
                'program_id'      => $program_id,
                'program_name'    => $program['program_name'],
                'plan_name'       => $plan['plan_name'],
                'component_name'  => '',
                'amount'          => $plan['final_price'],
                'item_type'       => 'Plan'
            ];
        }

        // Component rows
        foreach ($components as $component) {
            $items[] = [
                'program_id'      => $program_id,
                'program_name'    => $program['program_name'],
                'plan_name'       => '',
                'component_name' => $component['component_name'],
                'amount'          => $component['unit_price'],
                'item_type'       => 'Component'
            ];
        }

        $list[] = [
            'program_id'             => $program_id,
            'program_name'           => $program['program_name'],
            'program_status'         => $program['program_status'],
            'franchise_percentage'   => $program['franchise_percentage'],
            'franchise_cut'          => $program['franchise_cut'],
            'management_percentage' => $program['management_percentage'],
            'aviansys_percentage'    => $program['aviansys_percentage'],
            'maker_percentage'       => $program['maker_percentage'],
            'associate_id'           => $program['associate_id'],
            'associate_percentage'   => $program['associate_percentage'],
            'it_percentage'          => $program['it_percentage'],
            'crm_per'                => $program['crm_per'],
            'plans'                  => $plans,
            'components'             => $components,
            'items'                  => $items
        ];
    }

    $data['list'] = $list;

    $this->load->view('lunar_program_list', $data);
}
    public function lunar_schedule_faq()
    {
        // Fetch existing FAQs
        $comp_id = $this->uri->segment(4);
        
        if (isset($_POST['submit'])) {
    
            $faq_ids   = $this->input->post('faq_id');
            $questions = $this->input->post('question');
            $answers   = $this->input->post('answer');
    
            if (!empty($questions)) {
    
                foreach ($questions as $key => $question) {
    
                    $question = trim($question);
                    $answer   = trim($answers[$key]);
    
                    if ($question == '' && $answer == '') {
                        continue;
                    }
    
                    $faq_data = [
                        'lunar_schedule_id' => $comp_id,
                        'question' => $question,
                        'answer'   => $answer
                    ];
                    
                    // print_R($faq_data);die;
    
                    // Update existing FAQ
                    if (!empty($faq_ids[$key])) {
    
                        $this->franchisemodel->update_faq($faq_ids[$key], $faq_data);
    
                    } 
                    // Insert new FAQ
                    else {
    
                        $this->franchisemodel->insert_faq($faq_data);
                    }
                }
            }
    
            $this->session->set_flashdata('success', 'FAQs updated successfully');
            // redirect(current_url());
        }
    
        $data['faq'] = $this->franchisemodel->get_faq_by_schedule($comp_id);
        $data['comp_id'] = $comp_id;
            
        $this->load->view('faq_update_lunar.php', $data);
    }
    
    public function lunar_study_material()
    {
        // Fetch existing FAQs
        $series = $this->uri->segment(4);
        
       
    
            $this->db->select('study_material.*');
            $this->db->from('study_material');
            $this->db->join('assigned_materials', 'assigned_materials.mat_id = study_material.id');
           
            $this->db->where([
                'assigned_materials.period_id' => 15,
                'study_material.status'        => 'Paid','study_material.series'=>$series,
                'assigned_materials.maker_id'=>1
            ]);
            
            $data['material'] = $this->db->get()->result();
            
              //print_r($data['material']);die;
    
       $data['mock']=  $this->db->get_where('assigned_mock',array('maker_id'=>'1','period_id'=>'15'))->result();
       
            
        $this->load->view('lunar_study_material.php', $data);
    }
    
    
    public function class_update()
    {
        $comp_id = $this->uri->segment(4);
    
        // If form submitted (POST)
        if(isset($_POST['submit'])){
            
            $selected_classes = $this->input->post('selected_classes');
    
            // Remove all old classes for this comp_id
            $this->db->where('sch_id', $comp_id);
            $this->db->delete('lunar_schedule_class');
            
            // $assigned = $this->db->query("SELECT class FROM `lunar_schedule_class` WHERE sch_id='" . $comp_id . "'")->result_array();
        
            // print_R($selected_classes);die;
            
            // Insert newly selected classes
            if (!empty($selected_classes)) {
                foreach ($selected_classes as $class_name) {
                    $this->db->insert('lunar_schedule_class', [
                        'sch_id' => $comp_id,
                        'class'  => $class_name
                    ]);
                }
            }
    
            $this->session->set_flashdata('success', 'Classes updated successfully!');
            // redirect('your_controller/class_update/' . $comp_id);
            // return;
        }
    
        // Fetch all classes
        $data['all_classes'] = $this->db->query("SELECT * FROM `class` ORDER BY class_id ASC")->result_array();
    
        // Fetch classes already assigned to this schedule
        $assigned = $this->db->query("SELECT class FROM `lunar_schedule_class` WHERE sch_id='" . $comp_id . "'")->result_array();
        $data['assigned_classes'] = array_column($assigned, 'class');
    
        $data['comp_id'] = $comp_id;
        $this->load->view('class_update_lunar.php', $data);
    }



    public function class_update_syllabus()
    {
        $comp_id = $this->uri->segment(4);
       if(isset($_POST['submit'])) {

    $csvResult_upolad_logArray = array();
    $file = $_FILES['csv']['tmp_name'];
    $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));

    if ($ext == 'csv') {

        $handle = fopen($file, "r");
        $i = 0;

        while (($resultRow_from_csv = fgetcsv($handle, 5000, ",")) !== FALSE) {

            $i++;

            // Skip header
            if ($i == 1) continue;

            if (!empty($resultRow_from_csv[0])) {

                $logRow = $resultRow_from_csv;

                $class       = trim($resultRow_from_csv[0]);
                $title       = trim($resultRow_from_csv[1]);
                $topic       = trim($resultRow_from_csv[2]);
                $description = trim($resultRow_from_csv[3]);

                $status = '';

                // ✅ Check if same data already exists
                $existing = $this->db->get_where(
                    'lunar_schedule_class',
                    [
                        'sch_id'     => $comp_id,
                        'class'      => $class,
                        'title'      => $title,
                        'topic'      => $topic,
                        'description'=> $description
                    ]
                )->row();

                $logRow[0] = $comp_id;
                $logRow[1] = $class;
                $logRow[5] = 'red';
                $logRow[3] = $title . ' - ' . $description;

                if (!empty($title)) {

                    if(empty($existing)) {
                        // ✅ Insert only if not exists
                        $insert = $this->db->insert('lunar_schedule_class', [
                            'sch_id'      => $comp_id,
                            'class'       => $class,
                            'title'       => $title,
                            'topic'       => $topic,
                            'description' => $description
                        ]);

                        if ($insert) {
                            $status = 'Inserted Successfully';
                            $logRow[5] = 'green';
                        } else {
                            $status = 'Insert Failed';
                        }
                    } else {
                        $status = 'Already Exists';
                        $logRow[5] = 'orange';
                    }

                } else {
                    $status = 'Empty Title';
                    $logRow[5] = 'red';
                }

                $logRow[2] = $status;
                $csvResult_upolad_logArray[] = $logRow;
            }
        }

        fclose($handle);
        $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    }
}
    
        if(isset($data['result']['product'])){
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product']);
            $query=$this->db->get();
    	    $data['level']    = $query->result();
        }
        if(isset($_POST['submittest'])) {
            
              $id = $this->input->post('id');

                $data = [
                    'class' => $this->input->post('class'),
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description')
                ];
            
                $this->db->where('id', $id);
                $this->db->update('lunar_schedule_class', $data);
                redirect('manage/lunar/'.$comp_id);
            
        }
    	
            $this->db->select('*');
            $this->db->from('period');
            $this->db->where('period_id >','11');
            $query=$this->db->get();
    	    $data['period']   = $query->result();
    	    
    	   $this->db->select('*');
            $this->db->from('lunar_schedule_class');
            $this->db->where('sch_id',$comp_id);
            $query=$this->db->get();
    	    $data['test_descrption']   = $query->result();  
          //print_r($data['test_descrption']);die;
    	$this->load->view("class_update_syllabus.php",$data);
    }
    

    
     public function classdeletetest() 
    { 
         $id=$this->uri->segment(4);
         $schid=$this->uri->segment(5);
         $this->db->where('id', $id);
         $this->db->delete('lunar_schedule_class');

    redirect('manage/lunar/class_update_syllabus/'.$schid);
    }
    
    
    public function payments()
    {
        $comp_id = $this->uri->segment(4);
    
        // echo $comp_id;
    
        if(isset($_POST['Export'])){
            
            // print_r($_POST);die;
            $this->db->select('*');
            $this->db->from('lunar_split_prid');
            $this->db->join('lunar_prid','lunar_prid.prid=lunar_split_prid.prid');
            $this->db->where('lunar_split_prid.sch_id', $comp_id);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                // Prepare data for CSV
                $headers = [
                    'Sr. No', 'Date', 'Student Email', 'Total Pay Amount', 'Associate Amount',
                    'Associate GST', 'GST Amount', 'Management Amount', 'Razorpay Cut',
                    'MaRRs Left', 'Aviansys Amount', 'Aviansys GST'
                ];
    
                $payments = $query->result_array();
                $data = [];
                $sr_no = 1;
    
                foreach ($payments as $payment) {
                    $data[] = [
                        $sr_no++, // Sr. No
                        $payment['date_of_payment'], // Date
                        $payment['email'], // CIN
                        $payment['total_amount'], // Total Pay Amount
                        $payment['associate_amount'], // Franchise Amount
                        $payment['associate_gst'], // Franchise GST
                        $payment['gst_amount'], // GST Amount
                        $payment['management_amount'], // Management Amount
                        $payment['razpay_service'], // Razorpay Cut
                        $payment['MaRRS_bal'], // MaRRs Left
                        $payment['aviansys_amount'], // Aviansys Amount
                        $payment['aviansys_gst'], // Aviansys GST
                    ];
                }
    
                // Set headers for CSV download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="payments_data.csv"');
                header('Pragma: no-cache');
                header('Expires: 0');
    
                // Open output stream
                $handle = fopen('php://output', 'w');
                fputcsv($handle, $headers);
    
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }

            fclose($handle);
            exit();
            } 
            
        }    
            
        $this->db->select('*');
        $this->db->from('lunar_split_prid');
        $this->db->join('lunar_prid','lunar_prid.prid=lunar_split_prid.prid');
        $this->db->where('lunar_split_prid.sch_id', $comp_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['payments'] = $query->result_array();
        
        
        $data['comp_id'] = $comp_id; // Pass comp_id to the view
        $this->load->view("payments_lunar.php", $data);
    }
    
    
    
    public function payments_reg()
    {
        $comp_id = $this->uri->segment(4);
    
        if(isset($_POST['Export'])){
            
            // print_r($_POST);die;
            $this->db->select('*');
            $this->db->from('competition_product_state');
            $this->db->join('associates','associates.associate_id=competition_product_state.associate_id', 'left');
            $this->db->join('period','period.period_id=competition_product_state.period_id', 'left');
            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_product_state.clevel', 'left');
            $this->db->join('payment_split_associate','payment_split_associate.sch_id=competition_product_state.id');
            $this->db->where('competition_product_state.id', $comp_id);
            $query = $this->db->get();
            // echo $this->db->last_query();
            $payments = $query->result_array();
    
            if ($query->num_rows() > 0) {
                // Prepare data for CSV
                $headers = [
                    'Sr. No', 'Date', 'Student Email', 'Total Pay Amount', 'Associate Amount',
                    'Associate GST', 'GST Amount', 'Management Amount', 'Razorpay Cut',
                    'MaRRs Left', 'Aviansys Amount', 'Aviansys GST'
                ];
    
                $payments = $query->result_array();
                $data = [];
                $sr_no = 1;
    
                foreach ($payments as $payment) {
                    $data[] = [
                        $sr_no++, // Sr. No
                        $payment['date_of_payment'], // Date
                        $payment['email'], // CIN
                        $payment['total_amount'], // Total Pay Amount
                        $payment['associate_amount'], // Franchise Amount
                        $payment['associate_gst'], // Franchise GST
                        $payment['gst_amount'], // GST Amount
                        $payment['management_amount'], // Management Amount
                        $payment['razpay_service'], // Razorpay Cut
                        $payment['MaRRS_bal'], // MaRRs Left
                        $payment['aviansys_amount'], // Aviansys Amount
                        $payment['aviansys_gst'], // Aviansys GST
                    ];
                }
    
                // Set headers for CSV download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="payments_data.csv"');
                header('Pragma: no-cache');
                header('Expires: 0');
    
                // Open output stream
                $handle = fopen('php://output', 'w');
                fputcsv($handle, $headers);
    
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }

            fclose($handle);
            exit();
            } 
            
        }    
            
        $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->join('associates','associates.associate_id=competition_product_state.associate_id', 'left');
        $this->db->join('period','period.period_id=competition_product_state.period_id', 'left');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_product_state.clevel', 'left');
        $this->db->join('payment_split_associate','payment_split_associate.sch_id=competition_product_state.id');
       // $this->db->where('competition_product_state.id', $comp_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        $data['payments'] = $query->result_array();
        $data['comp_id'] = $comp_id; // Pass comp_id to the view
        $this->load->view("payments_lunar.php", $data);
    }
    
    
    
    public function edit($id)
    {
        $comp_id= $this->uri->segment('5');
        
            if(isset($_POST['submit'])){
                
               
                
                $ar=array(
                    'school'=>$_POST['school'],
                    'product_name'=>'Lunar Skill Test',
                    'period_id'=>$_POST['period'],
                    'type'=>$_POST['type'],
                    'amount'=>$_POST['amount'],
                    'associate_cut'=>$_POST['franchise_cut'],
                    'associate_id'=>$_POST['associate_id'],
                    'start_date'=>$_POST['start_date'],
                    'end_date'=>$_POST['end_date'],
                    'subject'=>$_POST['subject'],
                    'series'=>$_POST['series'],
                    'level_id'=>$_POST['level'],
                    // 'material'=>$_POST['material'],
                    // 'orientation'=>$_POST['orientation'],
                    // 'mock'=>$_POST['mock'],
                    // 'area'=>$_POST['area'],
                    // 'state_id'=>$_POST['state_id'],
                    'crm_fix'=>$_POST['crm_fix'],
                    'aviansys_percentage'=>$_POST['aviansys_percentage'],
                    'management_percentage'=>$_POST['management_percentage']
                    
                );
                $this->db->where('lunar_schedule_id',$comp_id);
                $this->db->update('lunar_schedule_cin',$ar);
                
                $schedule_id = $comp_id;
                $classes = $_POST['classes'] ?? []; 
                $this->db->where('sch_id', $schedule_id);
                $this->db->delete('lunar_schedule_class');
            
                foreach ($classes as $class_name) {
                    $data = array(
                        'sch_id' => $schedule_id,
                        'class' => $class_name
                    );
                    $this->db->insert('lunar_schedule_class', $data);
                }
                
                redirect('manage/lunar/schedule_list', 'refresh');
            }
        
               
            $this->db->select('*');
            $this->db->from('lunar_schedule_cin');
            $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id','left');
            $this->db->join('period','period.period_id=lunar_schedule_cin.period_id','left');
            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id','left');
            // $this->db->order_by('lunar_schedule_id','DESC');
            $this->db->where('lunar_schedule_id',$comp_id);
            
            // echo $this->db->last_query();die;
            
            $query=$this->db->get();
            $data['list']=$query->row();
                
        
        
            $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
            $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
            
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
            
               
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
                
                
            if(isset($data['list']->state_id)){
                $this->db->select('*');
                $this->db->from('areas');
                // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
                $this->db->where('state_id',$data['list']->state_id);
                $query=$this->db->get();
                $data['areaload'] = $query->result_array();
            }
            
            $this->db->select('associates.associate_id,first_name,last_name');
            $this->db->from('associates');
            $this->db->join('associate_bank_details','associate_bank_details.associate_id=associates.associate_id');
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['associates'] = $query->result_array();
            $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>'Lunar Skill Test'))->result_array();
                 
                
        $this->load->view("schedule_list_lunar_edit",$data);        
    }
    
    /**
     * GET manage/lunar/ajax_content_list
     * Optional query params: plan_id, week_number, class_number, content_type, status
     * Admin view always gets every row (Active + Inactive) unless a
     * status filter is explicitly passed.
     */
    public function ajax_content_list()
{
        try {
            $filters = [
                'program_id'   => $this->input->get('program_id') ?: $this->input->post('program_id'),
                'plan_id'      => $this->input->get('plan_id') ?: $this->input->post('plan_id'),
                'component_id' => $this->input->get('component_id') ?: $this->input->post('component_id'),
                'week_number'  => $this->input->get('week_number'),
                'class_number' => $this->input->get('class_number'),
                'content_type' => $this->input->get('content_type'),
                'status'       => $this->input->get('status'),
            ];
            $this->_json($this->lunarmodel->get_content_list($filters));
        } catch (Throwable $e) {
            log_message('error', 'ajax_content_list: ' . $e->getMessage());
            $this->_json(['error' => 'Unable to load content: ' . $e->getMessage()], 500);
        }
}
 
/**
 * Folder (inside an uploaded Unit ZIP) -> lm_content.content_type mapping.
 * Anything not in this list is ignored during extraction.
 */
private $zip_folder_type_map = [
    'study_material' => 'study_pack',
    'mock_test'       => 'mock_test',
    'skill_test'      => 'starter_test',
];

/**
 * Validate ZIP -> Check Program+Class+Unit -> reject if already uploaded
 * -> extract -> read study_material/mock_test/skill_test folders -> save
 * each file into lm_content -> delete the temp zip -> return count.
 *
 * $zip_full_path  Absolute path to the already-uploaded .zip on disk.
 * $meta           program_id, class_number, week_number, end_unit,
 *                  grade_from, grade_to, relative_dir, upload_dir.
 *
 * Returns ['saved_ids' => [...], 'extracted_count' => n] on success, or
 * ['error' => '...', 'code' => 4xx] on failure. The temp zip is always
 * removed before this method returns, success or failure.
 */
private function _extract_unit_zip($zip_full_path, array $meta)
{
    $cleanup = function () use ($zip_full_path) {
        if ($zip_full_path && file_exists($zip_full_path)) {
            @unlink($zip_full_path);
        }
    };

    // --- Check Program + Class + Unit ---
    if (empty($meta['program_id'])) {
        $cleanup();
        return ['error' => 'A program is required for ZIP uploads.', 'code' => 400];
    }
    if ($meta['week_number'] < 1) {
        $cleanup();
        return ['error' => 'A valid Unit number is required for ZIP uploads.', 'code' => 400];
    }

    // --- Already uploaded? ---
    if ($this->lunarmodel->bundle_exists($meta['program_id'], $meta['class_number'], $meta['week_number'], $meta['end_unit'])) {
        $cleanup();
        return [
            'error' => "This Unit {$meta['week_number']} bundle has already been uploaded for this Program/Class.",
            'code'  => 409,
        ];
    }

    // --- Validate ZIP ---
    if (!class_exists('ZipArchive')) {
        $cleanup();
        return ['error' => 'Server is missing the PHP zip extension (ZipArchive).', 'code' => 500];
    }

    $zip = new ZipArchive();
    if ($zip->open($zip_full_path) !== true) {
        $cleanup();
        return ['error' => 'Uploaded file is not a valid ZIP archive.', 'code' => 422];
    }

    // --- Extract ZIP to a scratch dir next to the final upload location ---
    $extract_dir = rtrim($meta['upload_dir'], '/') . '/_extract_' . uniqid() . '/';
    if (!mkdir($extract_dir, 0755, true) && !is_dir($extract_dir)) {
        $zip->close();
        $cleanup();
        return ['error' => 'Could not create a temporary extraction folder. Check permissions.', 'code' => 500];
    }
    $zip->extractTo($extract_dir);
    $zip->close();

    // --- Read folder: study_material / mock_test / skill_test ---
    $saved_ids = [];
    foreach ($this->zip_folder_type_map as $folder_name => $content_type) {
        $folder_path = $this->_find_zip_subfolder($extract_dir, $folder_name);
        if (!$folder_path) {
            continue; // this bundle doesn't include this content type, skip it
        }

        $dest_dir = rtrim($meta['relative_dir'], '/') . '/' . $content_type . '/';
        $dest_abs_dir = FCPATH . $dest_dir;
        if (!is_dir($dest_abs_dir)) {
            @mkdir($dest_abs_dir, 0755, true);
        }

        foreach (scandir($folder_path) as $entry_name) {
            if ($entry_name === '.' || $entry_name === '..' || $entry_name === '__MACOSX') continue;
            $entry_full_path = $folder_path . '/' . $entry_name;
            if (!is_file($entry_full_path)) continue; // one level deep only
            if (strpos($entry_name, '.') === 0) continue; // skip dotfiles (.DS_Store etc.)

            $ext       = pathinfo($entry_name, PATHINFO_EXTENSION);
            $base_name = pathinfo($entry_name, PATHINFO_FILENAME);
            $safe_base = preg_replace('/[^A-Za-z0-9_\-]/', '_', $base_name);
            $target_name = $safe_base . '.' . $ext;
            if (file_exists($dest_abs_dir . $target_name)) {
                $target_name = $safe_base . '_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
            }

            if (!copy($entry_full_path, $dest_abs_dir . $target_name)) {
                continue; // best-effort: skip files that fail to move, keep processing the rest
            }

            $saved_ids[] = $this->lunarmodel->save_content([
                'program_id'   => $meta['program_id'],
                'plan_id'      => $meta['plan_id'] ?: null,
                'component_id' => $meta['component_id'] ?: null,
                'week_number'  => $meta['week_number'],
                'end_unit'     => $meta['end_unit'],
                'class_number' => $meta['class_number'],
                'content_type' => $content_type,
                'file_path'    => $dest_dir . $target_name,
                'grade_from'   => $meta['grade_from'],
                'grade_to'     => $meta['grade_to'],
                'status'       => 'Active',
            ]);
        }
    }

    // --- Delete temporary ZIP + scratch extraction folder ---
    $this->_rrmdir($extract_dir);
    $cleanup();

    if (empty($saved_ids)) {
        return [
            'error' => 'ZIP did not contain any recognized folders (study_material, mock_test, skill_test) with files in them.',
            'code'  => 422,
        ];
    }

    // --- Return extracted file count ---
    return ['saved_ids' => $saved_ids, 'extracted_count' => count($saved_ids)];
}

/**
 * Case-insensitive search for a top-level folder inside the extracted
 * ZIP. Handles ZIPs that were zipped with a single wrapper folder
 * (e.g. Unit-1/study_material/...) as well as flat ones
 * (study_material/... at the archive root).
 */
private function _find_zip_subfolder($extract_dir, $folder_name)
{
    $candidates = glob(rtrim($extract_dir, '/') . '/*', GLOB_ONLYDIR) ?: [];
    foreach ($candidates as $dir) {
        if (strcasecmp(basename($dir), $folder_name) === 0) {
            return $dir;
        }
    }
    // One level deeper, in case everything sits under a single wrapper folder.
    foreach ($candidates as $dir) {
        $nested = glob(rtrim($dir, '/') . '/*', GLOB_ONLYDIR) ?: [];
        foreach ($nested as $inner) {
            if (strcasecmp(basename($inner), $folder_name) === 0) {
                return $inner;
            }
        }
    }
    return null;
}

/** Recursively delete a directory (used to clean up the extraction scratch folder). */
private function _rrmdir($dir)
{
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $entry) {
        if ($entry === '.' || $entry === '..') continue;
        $path = $dir . '/' . $entry;
        is_dir($path) ? $this->_rrmdir($path) : @unlink($path);
    }
    @rmdir($dir);
}

/**
 * POST manage/lunar/ajax_content_upload (multipart/form-data)
 * Fields: plan_id, week_number, class_number, content_type,
 *         [day_number], [video_slot], [file], [video_url]
 */
/**
 * POST manage/lunar/ajax_content_upload (multipart/form-data)
 *
 * upload_source = 'zip'        -> sirf .zip, auto-extract (study pack / mock test / skill test)
 * upload_source = 'individual' -> PDF, DOC, PPT, XLS, images, VIDEO, AUDIO (ek request = ek file)
 */
public function ajax_content_upload()
{
    try {

        $plan_id      = (int) $this->input->post('plan_id');
        $program_id   = (int) $this->input->post('program_id');
        $week_number  = (int) $this->input->post('week_number');
        $end_unit     = (int) $this->input->post('end_unit');
        $class_number = (int) $this->input->post('class_number');
        $component_id = (int) $this->input->post('component_id');
        $material_maker_id = (int) $this->input->post('material_maker_id');

        $content_type  = trim((string) $this->input->post('content_type'));
        $upload_source = strtolower(trim((string) $this->input->post('upload_source')));
        $upload_source = $upload_source ?: 'individual';

        $grade_from = trim((string) ($this->input->post('grade_from') ?: $this->input->post('from_grade') ?: ''));
        $grade_to   = trim((string) ($this->input->post('grade_to')   ?: $this->input->post('to_grade')   ?: ''));

        /* =========================================================
         * BASIC VALIDATION
         * ======================================================= */
        if (!$program_id) {
            return $this->_json(['error' => 'Program is required.'], 422);
        }
        if (!$week_number || $week_number < 1 || $week_number > 365) {
            return $this->_json(['error' => 'Unit must be between 1 and 365.'], 422);
        }
        if (!$end_unit || $end_unit < $week_number) {
            $end_unit = $week_number;
        }
        if ($end_unit > 365) {
            return $this->_json(['error' => 'End Unit cannot be greater than 365.'], 422);
        }
        if ($class_number < -3 || $class_number > 12) {
            return $this->_json(['error' => 'Invalid class.'], 422);
        }
        if (empty($_FILES['file']['name'])) {
            return $this->_json(['error' => 'Please select a file.'], 422);
        }

        $original_name = $_FILES['file']['name'];
        $extension     = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        /* =========================================================
         * ZIP UPLOAD  (sirf .zip)
         * ======================================================= */
        if ($upload_source === 'zip') {

            if ($extension !== 'zip') {
                return $this->_json(['error' => 'ZIP upload only accepts .zip files.'], 422);
            }
            if (!class_exists('ZipArchive')) {
                return $this->_json(['error' => 'PHP ZipArchive extension is not enabled on the server.'], 500);
            }

            // Program ke saare active components
            $components = $this->db
                ->select('id, program_id, component_name, component_code, component_type, status')
                ->from('lp_components')
                ->where('program_id', $program_id)
                ->where('status', 'Active')
                ->get()
                ->result();

            if (empty($components)) {
                return $this->_json(['error' => 'No active components were found for this program.'], 422);
            }

            $relative_dir = 'uploads/lm_content/' . $program_id . '/';
            $upload_dir   = FCPATH . $relative_dir;

            if (!is_dir($upload_dir) && !mkdir($upload_dir, 0755, true) && !is_dir($upload_dir)) {
                return $this->_json(['error' => 'Upload directory could not be created. Check permissions.'], 500);
            }

            // Outer ZIP save
            $zip_name = 'bundle_' . time() . '_' . mt_rand(1000, 9999) . '.zip';
            $zip_path = $upload_dir . $zip_name;

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $zip_path)) {
                return $this->_json(['error' => 'Could not save the uploaded ZIP file.'], 500);
            }

            $zip = new ZipArchive();
            if ($zip->open($zip_path) !== true) {
                @unlink($zip_path);
                return $this->_json(['error' => 'Uploaded file is not a valid ZIP archive.'], 422);
            }

            $extract_dir = $upload_dir . '_extract_' . uniqid('', true) . '/';
            if (!mkdir($extract_dir, 0755, true) && !is_dir($extract_dir)) {
                $zip->close();
                @unlink($zip_path);
                return $this->_json(['error' => 'Could not create temporary extraction directory.'], 500);
            }

            if (!$zip->extractTo($extract_dir)) {
                $zip->close();
                $this->_rrmdir($extract_dir);
                @unlink($zip_path);
                return $this->_json(['error' => 'Could not extract the ZIP file.'], 422);
            }
            $zip->close();

            // Recursive scanner (nested ZIP bhi support)
            $collect_files = function ($directory) use (&$collect_files) {
                $result = [];
                if (!is_dir($directory)) {
                    return $result;
                }
                $items = scandir($directory);
                if (!$items) {
                    return $result;
                }
                foreach ($items as $item) {
                    if ($item === '.' || $item === '..' || $item === '__MACOSX') {
                        continue;
                    }
                    $path = $directory . '/' . $item;

                    if (is_dir($path)) {
                        $result = array_merge($result, $collect_files($path));
                        continue;
                    }
                    if (!is_file($path)) {
                        continue;
                    }

                    $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));

                    if ($ext === 'zip') {
                        $nested_dir = $directory . '/_nested_' . uniqid('', true);
                        if (!mkdir($nested_dir, 0755, true) && !is_dir($nested_dir)) {
                            continue;
                        }
                        $nested_zip = new ZipArchive();
                        if ($nested_zip->open($path) === true) {
                            if ($nested_zip->extractTo($nested_dir)) {
                                $nested_zip->close();
                                $result = array_merge($result, $collect_files($nested_dir));
                            } else {
                                $nested_zip->close();
                            }
                        }
                        @unlink($path);
                        continue;
                    }

                    $result[] = $path;
                }
                return $result;
            };

            $files = $collect_files($extract_dir);

            if (empty($files)) {
                $this->_rrmdir($extract_dir);
                @unlink($zip_path);
                return $this->_json(['error' => 'The ZIP did not contain any files.'], 422);
            }

            // Dynamic component matcher
                       // Dynamic component matcher (file name -> component_code / component_name)
            $squash = function ($t) {
                return preg_replace('/[^a-z0-9]+/', '', strtolower((string) $t));
            };

            $norm_tokens = function ($t) {
                $t   = strtolower(preg_replace('/[^a-z0-9]+/i', ' ', (string) $t));
                $out = [];
                foreach (preg_split('/\s+/', trim($t), -1, PREG_SPLIT_NO_EMPTY) as $w) {
                    if (strlen($w) > 3 && substr($w, -1) === 's') {
                        $w = substr($w, 0, -1); // solutions -> solution
                    }
                    $out[$w] = true;
                }
                return array_keys($out);
            };

            // "<label>_<unit>_Class_<n>_<anything>"
            $parse_zip_filename = function ($filename) {
                $base = pathinfo($filename, PATHINFO_FILENAME);
                if (preg_match('/^(.*?)[\s_\-]*(\d+)[\s_\-]*class[\s_\-]*(-?\d+)/i', $base, $m)) {
                    return ['label' => trim($m[1]), 'unit' => (int) $m[2]];
                }
                if (preg_match('/^(.*?)[\s_\-]*(\d+)/', $base, $m)) {
                    return ['label' => trim($m[1]), 'unit' => (int) $m[2]];
                }
                return ['label' => trim($base), 'unit' => 0];
            };

            $resolve_component = function ($label, $components) use ($squash, $norm_tokens) {
                $label_sq = $squash($label);
                $label_tk = $norm_tokens($label);
                if ($label_sq === '' || !$label_tk) {
                    return null;
                }

                // 1) exact component_code (unique per program)
                foreach ($components as $c) {
                    $code_sq = $squash($c->component_code);
                    if ($code_sq !== '' && $code_sq === $label_sq) {
                        return $c;
                    }
                }

                // 2) exact component_name (name is not unique, so never guess)
                $by_name = [];
                foreach ($components as $c) {
                    if ($squash($c->component_name) === $label_sq) {
                        $by_name[] = $c;
                    }
                }
                if (count($by_name) === 1) return $by_name[0];
                if (count($by_name) > 1)  return null;

                // 3) word match: all words of the label must be in name/code, fewest extra words wins
                $best = null; $best_score = 0; $tie = false;
                foreach ($components as $c) {
                    $comp_tk = array_unique(array_merge($norm_tokens($c->component_name), $norm_tokens($c->component_code)));
                    $common  = count(array_intersect($label_tk, $comp_tk));
                    if (!$comp_tk || $common < count($label_tk)) {
                        continue;
                    }
                    $score = $common / count($comp_tk);
                    if ($score > $best_score)      { $best_score = $score; $best = $c; $tie = false; }
                    elseif ($score == $best_score) { $tie = true; }
                }
                return $tie ? null : $best;
            };

            // Same rules as getComponentContentKey() in the schedule page
            $content_type_for = function ($c) {
                $n = strtolower((string) $c->component_name);
                if (strpos($n, 'learning') !== false || strpos($n, 'material') !== false || strpos($n, 'study') !== false) return 'study_pack';
                if (strpos($n, 'mock') !== false) return 'mock_test';
                if (strpos($n, 'starter') !== false || strpos($n, 'skill') !== false) return 'starter_test';
                $slug = trim(preg_replace('/[^a-z0-9]+/', '_', $n), '_');
                return $slug !== '' ? $slug : 'study_pack';
            };

            $zip_allowed = ['pdf','doc','docx','ppt','pptx','xls','xlsx','jpg','jpeg','png','gif'];

            $saved_ids   = [];
            $skipped     = [];
            $processed   = 0;
            $total_files = count($files);

            foreach ($files as $file_path) {

                $processed++;
                $filename = basename($file_path);

                if (!$filename || strpos($filename, '.') === 0) {
                    continue;
                }

                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (!in_array($ext, $zip_allowed, true)) {
                    continue;
                }

                 // Unit + component from the file name
                $parsed = $parse_zip_filename($filename);
                $unit   = $parsed['unit'] >= 1 ? $parsed['unit'] : $week_number;
                if ($unit < 1 || $unit > 365) {
                    $skipped[] = $filename . ' - invalid Unit';
                    continue;
                }

                $component = $resolve_component($parsed['label'], $components);
                if (!$component) {
                    $skipped[] = $filename . ' - no component matches "' . $parsed['label'] . '"';
                    continue;
                }
                $zip_ctype = $content_type_for($component);

                if ($this->lunarmodel->component_unit_exists($program_id, $class_number, $unit, (int) $component->id)) {
                    $skipped[] = $filename . ' - Unit ' . $unit . ' already uploaded for ' . $component->component_name;
                    continue;
                }
                $destination_dir = $relative_dir . $zip_ctype . '/';
                $destination_abs = FCPATH . $destination_dir;

                if (!is_dir($destination_abs) && !mkdir($destination_abs, 0755, true) && !is_dir($destination_abs)) {
                    $skipped[] = $filename . ' - destination directory failed';
                    continue;
                }

                $safe_base = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($filename, PATHINFO_FILENAME));
                $safe_base = trim($safe_base, '_');
                if ($safe_base === '') {
                    $safe_base = 'content_' . time();
                }

                $target_name = $safe_base . '.' . $ext;
                if (file_exists($destination_abs . $target_name)) {
                    $target_name = $safe_base . '_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                }

                if (!copy($file_path, $destination_abs . $target_name)) {
                    $skipped[] = $filename . ' - copy failed';
                    continue;
                }

                $new_id = $this->lunarmodel->save_content([
                    'program_id'   => $program_id,
                    'plan_id'      => $plan_id ?: null,
                    'component_id' => (int) $component->id,
                    'material_maker_id' => $material_maker_id ?: null,
                    'week_number'  => $unit,
                    'end_unit'     => $unit,
                    'class_number' => $class_number,
                    'content_type' => $zip_ctype,
                    'file_path'    => $destination_dir . $target_name,
                    'grade_from'   => $grade_from !== '' ? $this->lunarmodel->normalize_grade_value($grade_from) : null,
                    'grade_to'     => $grade_to   !== '' ? $this->lunarmodel->normalize_grade_value($grade_to)   : null,
                    'status'       => 'Active',
                ]);

                if (!$new_id) {
                    @unlink($destination_abs . $target_name);
                    $skipped[] = $filename . ' - database insert failed';
                    continue;
                }

                $saved_ids[] = $new_id;
            }

            // Cleanup
            $this->_rrmdir($extract_dir);
            @unlink($zip_path);

            if (empty($saved_ids)) {
                return $this->_json([
                    'success'     => false,
                    'error'       => 'No recognized content files were uploaded.',
                    'processed'   => $processed,
                    'total_files' => $total_files,
                    'skipped'     => $skipped,
                ], 422);
            }

            return $this->_json([
                'success'         => true,
                'extracted_count' => count($saved_ids),
                'uploaded_count'  => count($saved_ids),
                'processed'       => $processed,
                'total_files'     => $total_files,
                'skipped_count'   => count($skipped),
                'skipped'         => $skipped,
                'ids'             => $saved_ids,
                'message'         => count($saved_ids) . ' file(s) uploaded successfully.',
            ]);
        }

        /* =========================================================
         * INDIVIDUAL UPLOAD
         * PDF / DOC / PPT / XLS / images / VIDEO / AUDIO
         * ======================================================= */

        if (!$component_id) {
            return $this->_json(['error' => 'Component is required.'], 422);
        }

        $component = $this->lunarmodel->get_component($component_id);
        if (!$component || (int) $component->program_id !== $program_id) {
            return $this->_json(['error' => 'Selected component does not belong to this program.'], 422);
        }

        $document_ext = ['pdf','doc','docx','ppt','pptx','xls','xlsx','jpg','jpeg','png','gif'];
        $video_ext    = ['mp4','mov','avi','mkv','webm'];
        $audio_ext    = ['mp3','wav','m4a','aac','ogg'];
        $all_allowed  = array_merge($document_ext, $video_ext, $audio_ext);

        if ($extension === 'zip') {
            return $this->_json(['error' => 'ZIP files must be uploaded from the ZIP Upload tab.'], 422);
        }
        if (!in_array($extension, $all_allowed, true)) {
            return $this->_json(['error' => 'File type .' . $extension . ' is not allowed.'], 422);
        }

        // Content type decide karo
        if (in_array($extension, $video_ext, true)) {
            $content_type = 'video';
        } elseif (in_array($extension, $audio_ext, true)) {
            $content_type = 'audio';
        } elseif ($content_type === '' || !preg_match('/^[a-z0-9_]{1,50}$/', $content_type)) {
            $content_type = 'study_pack';
        }

        $relative_dir = 'uploads/lm_content/' . $program_id . '/' . $content_type . '/';
        $upload_dir   = FCPATH . $relative_dir;

        if (!is_dir($upload_dir) && !mkdir($upload_dir, 0755, true) && !is_dir($upload_dir)) {
            return $this->_json(['error' => 'Upload directory could not be created. Check permissions.'], 500);
        }

        $safe_base = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($original_name, PATHINFO_FILENAME));
        $safe_base = trim($safe_base, '_');
        if ($safe_base === '') {
            $safe_base = 'content';
        }

        $this->upload->initialize([
            'upload_path'   => $upload_dir,
            'allowed_types' => implode('|', $all_allowed),
            'max_size'      => 512000, // KB => 500 MB
            'file_name'     => $safe_base . '_' . time() . '_' . mt_rand(1000, 9999),
            'encrypt_name'  => false,
            'overwrite'     => false,
        ], true);

        if (!$this->upload->do_upload('file')) {
            return $this->_json(['error' => $this->upload->display_errors('', '')], 422);
        } 
        $upload_data = $this->upload->data();

        $new_id = $this->lunarmodel->save_content([
            'program_id'   => $program_id,
            'plan_id'      => $plan_id ?: null,
            'component_id' => $component_id,
            'material_maker_id' => $material_maker_id ?: null,
            'week_number'  => $week_number,
            'end_unit'     => $end_unit,
            'class_number' => $class_number,
            'content_type' => $content_type,
            'file_path'    => $relative_dir . $upload_data['file_name'],
            'grade_from'   => $grade_from !== '' ? $this->lunarmodel->normalize_grade_value($grade_from) : null,
            'grade_to'     => $grade_to   !== '' ? $this->lunarmodel->normalize_grade_value($grade_to)   : null,
            'status'       => 'Active',
        ]);

        if (!$new_id) {
            @unlink($upload_dir . $upload_data['file_name']);
            return $this->_json(['error' => 'Database insert failed.'], 500);
        }

        return $this->_json([
            'success'      => true,
            'id'           => $new_id,
            'content_type' => $content_type,
            'file'         => $upload_data['orig_name'],
        ]);

    } catch (Throwable $e) {

        log_message('error', 'ajax_content_upload: ' . $e->getMessage() . "\n" . $e->getTraceAsString());

        return $this->_json(['error' => 'Content upload failed: ' . $e->getMessage()], 500);
    }
}
public function ajax_content_toggle($id)
{
    $ok = $this->lunarmodel->toggle_content_status((int) $id);
    echo json_encode(['success' => (bool) $ok]);
}
 
/**
 * POST manage/lunar/ajax_content_delete/{id}
 */
public function ajax_content_delete($id)
{
    try {
        // Keep database errors from being rendered as an HTML page. The
        // frontend expects this endpoint to always return JSON.
        $previous_db_debug = $this->db->db_debug;
        $this->db->db_debug = false;
        $ok = $this->lunarmodel->delete_content((int) $id);
        $this->db->db_debug = $previous_db_debug;

        if (!$ok) {
            return $this->_json(['success' => false, 'error' => 'Upload could not be deleted.'], 409);
        }
        $this->_json(['success' => (bool) $ok]);
    } catch (Throwable $e) {
        $this->_json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}
 

/**
 * POST manage/lunar/ajax_content_delete_multiple
 * Fields: ids[]  (array of lm_content.id)
 */
public function ajax_content_delete_multiple()
{
    try {
        $ids = $this->input->post('ids');
        if (!is_array($ids)) {
            $ids = ($ids === null || $ids === '') ? [] : explode(',', (string) $ids);
        }
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids))));

        if (empty($ids)) {
            return $this->_json(['success' => false, 'error' => 'No files selected.'], 422);
        }

        $previous_db_debug = $this->db->db_debug;
        $this->db->db_debug = false;
        $deleted = $this->lunarmodel->delete_content_multiple($ids);
        $this->db->db_debug = $previous_db_debug;

        if ($deleted === false) {
            return $this->_json(['success' => false, 'error' => 'Selected files could not be deleted.'], 409);
        }

        return $this->_json([
            'success' => true,
            'deleted' => (int) $deleted,
            'skipped' => count($ids) - (int) $deleted,
        ]);
    } catch (Throwable $e) {
        return $this->_json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}


/** "Study Pack #1" -> "study_pack_1" */
private function _slug_component_code($text)
{
    $code = strtolower(trim((string) $text));
    $code = preg_replace('/[^a-z0-9]+/', '_', $code);
    $code = trim($code, '_');
    return substr($code !== '' ? $code : 'component', 0, 45);
}

private function _component_code_exists($program_id, $code, $exclude_id = null)
{
    $this->db->where('program_id', (int) $program_id);
    $this->db->where('component_code', $code);
    if ($exclude_id) {
        $this->db->where('id !=', (int) $exclude_id);
    }
    return $this->db->count_all_results('lp_components') > 0;
}

/** Same program ke andar unique code: study_pack, study_pack_2, study_pack_3 ... */
private function _unique_component_code($program_id, $base, $exclude_id = null)
{
    $code = $base;
    $i    = 2;
    while ($this->_component_code_exists($program_id, $code, $exclude_id)) {
        $code = $base . '_' . $i++;
    }
    return $code;
}
}