<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
class zoomzoom extends CI_Controller {
    
    public function __construct() 
    {
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('manage/login/', 'refresh');
			}
			
			$this->load->library('encrypt');
 			$this->load->library('email');
			$this->load->library('csv');
			$this->load->library('session');
			$this->load->library('upload');
			$this->load->library('form_validation');
			$this->load->library('validation');
// 			$this->load->model('franchisemodel');
			$this->load->model('schoolmodel');
// 			echo 'ok';die;
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
    
    public function export_cin_all()
    {
        
            if(isset($_POST['submit'])){
                $data['result']=$_POST;
                // print_r($_POST);die;
                $this->db->select('zoomzoom_schedule_id');
        		$this->db->from('zoomzoom_schedule_cin');
        	
        		$this->db->where('period_id',$_POST['period']);
        		$this->db->where('level_id',$_POST['level']);
        		$this->db->order_by('zoomzoom_schedule_id','DESC');
        		$res = $this->db->get();
        		$schedule= $res->row();
        // 		echo $this->db->last_query();
                if($schedule){
                    
                    $this->db->select('*');
                    $this->db->from('cin_list');
                    $this->db->join('period','period.period_id=cin_list.period_id');
                    $this->db->join('zoomzoom_schedule_cin','zoomzoom_schedule_cin.zoomzoom_schedule_id=cin_list.sch_id');
                    $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=zoomzoom_schedule_cin.level_id');
                    $this->db->join('associates','associates.associate_id=cin_list.associate_id','LEFT');
                    $this->db->where('sch_id',$schedule->zoomzoom_schedule_id);
                    $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                    $query=$this->db->get();
                    // echo $this->db->last_query();
                    $data['pay_list']=$query->result();
                    $data['message']='Student Find Successfully ...';
                }
                else{
                    $data['pay_list']='';
                    $data['message']='No Schedule Found ...';
                }
            }
            
            if (isset($_POST['Export'])) {
                
                $this->db->select('zoomzoom_schedule_id');
        		$this->db->from('zoomzoom_schedule_cin');
        		
        		$this->db->where('period_id',$_POST['period']);
        		$this->db->where('level_id',$_POST['level']);
        		$this->db->order_by('zoomzoom_schedule_id','DESC');
        		$res = $this->db->get();
        		$schedule= $res->row();
                    $this->db->from('cin_list');
                    $this->db->join('period','period.period_id=cin_list.period_id');
                    $this->db->join('zoomzoom_schedule_cin','zoomzoom_schedule_cin.zoomzoom_schedule_id=cin_list.sch_id');
                    $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=zoomzoom_schedule_cin.level_id');
                    $this->db->join('associates','associates.associate_id=cin_list.associate_id','LEFT');
                    $this->db->where('sch_id',$schedule->zoomzoom_schedule_id);
                    $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                    $query=$this->db->get();
                    // echo $this->db->last_query();die;
                    $students=$query->result();
                $data = [];
                $n = 0;
    
                    foreach ($students as $item) {
                        $serial_no = $n + 1; // Increment the serial number
                        $data[] = [
                            'serial_no' => $serial_no,
                            'cin' => $item->cin,
                            'prid' => $item->prid,
                            
                            'period'=>$item->academic_year,
                            'student_name' => $item->student_name,
                            'school_name' => $item->school_name,
                            'class' => $item->class,
                            'stud_phone' => $item->stud_phone,
                            'stud_email' => $item->email,
                            'associate' => $item->first_name.' '.$item->last_name
                        ];
                
                        $file_name = $item->associate_code . '_Zoomzoom Skill Test' . '_CIN_PRID';
                        $n++;
                    }
    
        
                    header("Content-type: application/csv");
                    header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                
                    $handle = fopen('php://output', 'w');
                    fputcsv($handle, ['Serial No', 'CIN', 'PRID','Period','Student Name', 'School', 'Class', 'Mobile', 'Email', 'Assocaite']);
                
                    foreach ($data as $key) {
                        fputcsv($handle, $key);
                    }
                    fclose($handle);
                    exit;
                }

        
        
            $this->db->select('*');
    		$this->db->from('competition_level_byproduct');
    		$this->db->where('product_name','MaRRS Math Zoom Zoom Challenge');
    		$res = $this->db->get();
    		$data['level_load']= $res->result_array();
    		
    		$this->db->select('*');
    		$this->db->from('class');
    		$res = $this->db->get();
    		$data['classload']= $res->result_array();
         
            $this->db->select('series');
    		$this->db->from('zoomzoom_schedule_cin');
    		$this->db->where('series !=','');
    		$this->db->group_by('series');
    		$res = $this->db->get();
    		$data['series']= $res->result();
    		
    		$this->db->select('Subject_key');
    		$this->db->from('subjects');
    		$res = $this->db->get();
    		$data['subject']= $res->result();
         
            $this->db->select('type');
    		$this->db->from('zoomzoom_schedule_cin');
    		$this->db->where('type !=','');
    		$this->db->group_by('type');
    		$res = $this->db->get();
    		$data['type']= $res->result();
    		
    		$this->db->select('*');
    		$this->db->from('period');
    		$this->db->where('period_id >=',13);
    		$res = $this->db->get();
    		$data['periodload']= $res->result_array();
    		
		
        $this->load->view('export_cin_zoomzoom_all',$data);
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
    
    public function schedule_lunar()
    {
        if(isset($_POST['submit'])){
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
                    $registration_code = 'L' . $period_year . $random_number;
                    $existing_entry = $db->get_where('lunar_schedule_cin', ['registration_code' => $registration_code])->row();
                } while ($existing_entry); 
        
                return $registration_code;
            }
        
            $registration_code = generate_unique_code($this->db, $period->initials);

                $ar=array(
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
                    'level_id'=>$_POST['level'],
                    'crm_fix'=>$_POST['crm_fix'],
                    'school_amount'=>$_POST['school_amount'],
                    // 'orientation'=>$_POST['orientation'],
                    'state_id'=>$_POST['state_id'],
                    'franchise_percentage'=>$_POST['franchise_percentage'],
                    'franchise_id'=>$_POST['franchise_id'],
                    'aviansys_percentage'=>$_POST['aviansys_percentage'],
                    'management_percentage'=>$_POST['management_percentage'],
                    'type'=>$_POST['varient']
                );
                // print_r($ar);die;
                
                $this->db->insert('lunar_schedule_cin',$ar);
                $last_inserted_id = $this->db->insert_id();

                foreach($_POST['classes'] as $class){
                    $ar=array('class'=>$class,'sch_id'=>$last_inserted_id);
                    $this->db->insert('lunar_schedule_class',$ar);
                }
                
                foreach($_POST['schools'] as $school){
                    $ar=array('school_id'=>$school,'sch_id'=>$last_inserted_id);
                    $this->db->insert('lunar_schedule_school',$ar);
                }
                
                
                
                redirect('manage/lunar/schedule_list', 'refresh');
            
            $data['message']='Products assigned to school successfully ...';
            
        }
        
        $data['productload'] = $this->db->get_where('products',array('product_name'=>'Lunar Skill Test'))->result_array();
        
        $data['periodload'] = $this->db->get_where('period',array('period_id >='=>'14'))->result();
        
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
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['associates'] = $query->result_array();
            
        $this->load->view("schedule_lunar",$data);
    }
    
    public function upload_rank()
    {
        
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')

    	{  
    
    	     $data['period_id']            =  $search_period_id = $this->input->post('period_id');
    
    	     $data['competition_level_id'] =  $search_level_id = $this->input->post('competition_level_id');
    
    	     $data['service_id']           =  $search_service_id = $this->input->post('service_id');
    
    	  
    
    		 $csvResult_upolad_logArray = array();
    
    		 
    
    				$start_cell_row=3;/*skip first 2 heading rows */
    
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

				  { //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];

				     if($resultRow_from_csv[0]) 

					 { 

						$cin               =  addslashes($resultRow_from_csv[0]);

						$status            =  addslashes($resultRow_from_csv[1]);

						

						$grade1            =  addslashes($resultRow_from_csv[2]);

						$grade2            =  addslashes($resultRow_from_csv[3]);

						$grade3            =  addslashes($resultRow_from_csv[4]);
						
						$grade4            =  addslashes($resultRow_from_csv[5]);

						

						$csv_result_array  =  array('cin'              => $cin , 

						                               'status'           => $status ,

													   'grade1'           =>$grade1,

													   'grade2'           =>$grade2,

													   'grade3'           =>$grade3,
													   
													   'grade4'           =>$grade4,

													   'search_period_id' => $search_period_id,

													   'search_level_id'  => $search_level_id,

													   'search_service_id'=> $search_service_id);



							/*echo "<pre>";print_r($csv_result_array);exit;	*/					   

						 $csv_upload_status = $this->resultmodel->save_csv_result($csv_result_array);

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
        $today = date('Y-m-d');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->where('lunar_schedule_cin.start_date <=', $today);
        $this->db->order_by('lunar_schedule_id','DESC');
        $this->db->limit(10);
        $data['competition'] = $this->db->get('lunar_schedule_cin')->result();
        
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
        $comp_id = $this->uri->segment(4);
        $this->db->join('products','products.product_name=lunar_schedule_cin.product_name');
        $this->db->join('period','period.period_id=lunar_schedule_cin.period_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=lunar_schedule_cin.level_id');
        $this->db->join('associates','associates.associate_id=lunar_schedule_cin.associate_id');
        $data['competition'] = $competition = $this->db->get_where('lunar_schedule_cin',array('lunar_schedule_id'=>$comp_id))->row();
        // print_r($data['competition']);die;
        
        
        
        if(isset($_POST['submit']))
        {
            // print_r($data['competition']);
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
            
            
            
            $crm_fix = $data['competition']->crm_fix;
            // $close_date = $this->input->post('close_date');
            
            $arr = array(
                'product_name' => $data['competition']->product_name,
                'product_price' => $data['competition']->amount,
                'mock_test' => $mock_test,
                'clevel'    => $competition_level_id,
                'status'    => 'Live',
                'state_id'  => $data['competition']->state_id,
                // 'period_id'=>$period_id
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
                
                
            // echo '<pre>';    
            // print_r($_POST);
            // echo '<br>'.$_POST['study_material_b_maker_price'];
            
            
            $revenue_setting=[
                'period_id'=>$period_id,
                'product_name'=>$product_name,
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
                'study_material_free_royalty'=>$_POST['study_material_free_royalty']
            ];
            
            $this->db->insert('revenue_setting',$revenue_setting);
            $revenue_setting_id = $this->db->insert_id();
            
            // echo '<pre>';
            // print_R($arr);
            // print_r($revenue_setting);
            // die;
            
            
            $arr['revenue_setting_id']=$revenue_setting_id;
            
            $this->db->insert('competition_product_state',$arr);
            $comp_id = $this->db->insert_id();
            
            
            redirect('manage/lunar/lunarcompetition_activate', 'refresh');
        }
        
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'A','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_A']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'B','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_B']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'C','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_C']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'D','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_D']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'E','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_E']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Paid','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'F','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_F']=$query->row();
        
        
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'A','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Afree']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'B','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Bfree']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'C','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Cfree']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'D','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Dfree']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'E','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Efree']=$query->row();
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->join('assigned_materials','assigned_materials.mat_id=study_material.id');
        $this->db->where(array('status'=>'Free','assigned_materials.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'type'=>'F','series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['material_Ffree']=$query->row();
        
        
        
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'A','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_A']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'B','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_B']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'C','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_C']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'D','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_D']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'E','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_E']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'F','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_F']=$query->row();
        
       
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'A','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Afree']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'B','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Bfree']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'C','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Cfree']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'D','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Dfree']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'E','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Efree']=$query->row();
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->join('assigned_mock','assigned_mock.mat_id=mock_papers.paper_id');
        $this->db->where(array('pay_status'=>'Paid','type'=>'F','status'=>'Active','assigned_mock.period_id'=>$competition->period_id,'clevel'=>$competition->level_id,'product_name'=>$competition->product_name,'series'=>$competition->series,'subject'=>$competition->subject,'sub_type'=>$competition->type));
        $query=$this->db->get();
        $data['mock_Ffree']=$query->row();
        
        
        
        // echo $this->db->last_query();
        
        
        $data['lunar_schedule_class'] = $this->db->get_where('lunar_schedule_class',array('sch_id'=>$comp_id))->result();
        
        
        $this->load->view("competition_assign.php", $data);
    }

    public function schedule_list()
    {
        // echo 'ok';die;
            if(isset($_POST['submit'])){
                // print_r($_POST);die;
                $this->db->select('*');
                $this->db->from('zoomzoom_schedule_cin');
                $this->db->join('associates','associates.associate_id=zoomzoom_schedule_cin.associate_id', 'left');
                $this->db->join('franchise','franchise.franchise_id=zoomzoom_schedule_cin.franchise_id', 'left');
                $this->db->join('period','period.period_id=zoomzoom_schedule_cin.period_id', 'left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=zoomzoom_schedule_cin.level_id', 'left');
                $this->db->where('zoomzoom_schedule_cin.period_id',$_POST['period']);
                $this->db->where('zoomzoom_schedule_cin.level_id',$_POST['level']);
                $this->db->where('zoomzoom_schedule_cin.level_id',$_POST['level']);
                $this->db->order_by('zoomzoom_schedule_id','DESC');
                $query=$this->db->get();
                $data['list']=$query->result_array();
                $data['result']=$_POST;
            }else{
                $this->db->select('*');
                $this->db->from('zoomzoom_schedule_cin');
                $this->db->join('associates','associates.associate_id=zoomzoom_schedule_cin.associate_id', 'left');
                $this->db->join('franchise','franchise.franchise_id=zoomzoom_schedule_cin.franchise_id', 'left');
                $this->db->join('period','period.period_id=zoomzoom_schedule_cin.period_id', 'left');
                $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=zoomzoom_schedule_cin.level_id', 'left');
                $this->db->order_by('zoomzoom_schedule_id','DESC');
                $query=$this->db->get();
                // echo $this->db->last_query();die;
                $data['list']=$query->result_array();
            }
        
        
            $data['productload'] = $this->db->get_where('products',array('product_name'=>'MaRRS Math Zoom Zoom Challenge'))->result_array();
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
            
            $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>'MaRRS Math Zoom Zoom Challenge'))->result_array();
        
        $this->load->view("schedule_list_zoomzoom",$data);
    }
    
    public function class_update()
    {
        $comp_id = $this->uri->segment(4);
    
        // If form submitted (POST)
        if(isset($_POST['submit'])){
            
            $selected_classes = $this->input->post('selected_classes');
    
            // Remove all old classes for this comp_id
            $this->db->where('sch_id', $comp_id);
            $this->db->delete('zoomzoom_schedule_class');
            
            // $assigned = $this->db->query("SELECT class FROM `lunar_schedule_class` WHERE sch_id='" . $comp_id . "'")->result_array();
        
            // print_R($selected_classes);die;
            
            // Insert newly selected classes
            if (!empty($selected_classes)) {
                foreach ($selected_classes as $class_name) {
                    $this->db->insert('zoomzoom_schedule_class', [
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
        $assigned = $this->db->query("SELECT class FROM `zoomzoom_schedule_class` WHERE sch_id='" . $comp_id . "'")->result_array();
        $data['assigned_classes'] = array_column($assigned, 'class');
    
        $data['comp_id'] = $comp_id;
        $this->load->view('class_update_lunar.php', $data);
    }

    public function zoomzoom_schedule_delete($lunar_schedule_id)
    {
        // First, check if record exists
        $schedule = $this->db->get_where('zoomzoom_schedule_cin', ['zoomzoom_schedule_id' => $lunar_schedule_id])->row_array();
    
        if (!$schedule) {
            $this->session->set_flashdata('error', 'Record not found or already deleted.');
            // redirect('lunar/schedule_list');
            redirect('manage/zoomzoom/schedule_list', 'refresh');
            return;
        }
    
        // Delete linked classes first
        $this->db->where('sch_id', $lunar_schedule_id);
        $this->db->delete('zoomzoom_schedule_class');
    
        // Then delete main schedule entry
        $this->db->where('zoomzoom_schedule_id', $lunar_schedule_id);
        $this->db->delete('zoomzoom_schedule_cin');
    
        $this->session->set_flashdata('success', 'Schedule deleted successfully.');
        // redirect('lunar/schedule_list');
         redirect('manage/zoomzoom/schedule_list', 'refresh');
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
        $this->db->where('competition_product_state.id', $comp_id);
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
    
    
    public function zoomzoom_schedule_update()
    {
        $lunar_schedule_id = $this->uri->segment('4');
        // Fetch existing schedule data
        $schedule = $this->db->get_where('zoomzoom_schedule_cin', ['zoomzoom_schedule_id' => $lunar_schedule_id])->row_array();
        $data['result'] = $schedule;
    
        // On form submit
        if (isset($_POST['submit'])) {
    
            $updateData = [
                'state_id' => $_POST['state_id'],
                'franchise_id' => $_POST['franchise_id'],
                'area' => $_POST['area'],
                'period_id' => $_POST['period_id'],
                // 'subject' => $_POST['subject'],
                // 'series' => $_POST['series'],
                'level_id' => $_POST['level'],
                'associate_id' => $_POST['associate_id'],
                'associate_cut' => $_POST['franchise_cut'],
                'school_amount' => $_POST['school_amount'] ?? 0,
                'crm_fix' => $_POST['crm_fix'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'amount' => $_POST['amount'],
                'management_percentage' => $_POST['management_percentage'],
                'aviansys_percentage' => $_POST['aviansys_percentage'],
                'franchise_percentage' => $_POST['franchise_percentage'],
                // 'type' => $_POST['varient'],
                // 'season'=>$_POST['season']
            ];
    
            // print_r($updateData);die;
            
            // Update main record
            $this->db->where('zoomzoom_schedule_id', $lunar_schedule_id);
            $this->db->update('zoomzoom_schedule_cin', $updateData);
    
            
    
            $data['message'] = "Zoomzoom Schedule updated successfully.";
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
    
        // Fetch already linked classes
        $linked_classes = $this->db->get_where('zoomzoom_schedule_class', ['sch_id' => $lunar_schedule_id])->result_array();
        $data['active_classes'] = array_column($linked_classes, 'class');
    
        $this->load->view('zoomzoom_schedule_update', $data);
    }
    
    
    
    
    
    
    
    
public function admin_revenue_and_competition() 
{
    $data = array();
    
    // Handle combined form submission
    if(isset($_POST['submit'])) {
        
        // echo '<pre>';
        // foreach($_POST['schools'] as $data){
        //     print_r($data);die;
        // }
        
        // Start transaction for data integrity
        $this->db->trans_start();
        
        // Get product details
        $product = $this->db->get_where('products', array(
            'product_id' => $_POST['product_name']
        ))->row();
        
        // Check if revenue setting already exists
        $existing_revenue = $this->db->get_where('revenue_setting', array(
            'period_id' => $_POST['period_id'],
            'clevel' => $_POST['competition_level_id'],
            'product_id' => $_POST['product_name']
        ))->row();
        
        // Prepare revenue data
        $revenue_data = array(
            'period_id' => $_POST['period_id'],
            'product_name' => $product->product_name,
            'product_id' => $_POST['product_name'],
            'clevel' => $_POST['competition_level_id'],
            'com_per' => $_POST['com_per'],
            'manageper' => $_POST['manageper'],
            'com_peravian' => $_POST['com_peravian'],
            'associate_per' => $_POST['associate_per'],
            'crm_fix' => $_POST['crm_fix'],
            
            'study_material_a_price' => $_POST['study_material_a_price'],
            'study_material_b_price' => $_POST['study_material_b_price'],
            'study_material_c_price' => $_POST['study_material_c_price'],
            'study_material_d_price' => $_POST['study_material_d_price'],
            'study_material_e_price' => $_POST['study_material_e_price'],
            'study_material_f_price' => $_POST['study_material_f_price'],
            
            'study_material_a_price_royalty' => $_POST['study_material_a_price_royalty'],
            'study_material_b_price_royalty' => $_POST['study_material_b_price_royalty'],
            'study_material_c_price_royalty' => $_POST['study_material_c_price_royalty'],
            'study_material_d_price_royalty' => $_POST['study_material_d_price_royalty'],
            'study_material_e_price_royalty' => $_POST['study_material_e_price_royalty'],
            'study_material_f_price_royalty' => $_POST['study_material_f_price_royalty'],
            
            'mock_test_a_price' => $_POST['mock_test_a_price'],
            'mock_test_b_price' => $_POST['mock_test_b_price'],
            'mock_test_c_price' => $_POST['mock_test_c_price'],
            'mock_test_d_price' => $_POST['mock_test_d_price'],
            'mock_test_e_price' => $_POST['mock_test_e_price'],
            'mock_test_f_price' => $_POST['mock_test_f_price'],
            
            'mock_test_a_price_royalty' => $_POST['mock_test_a_price_royalty'],
            'mock_test_b_price_royalty' => $_POST['mock_test_b_price_royalty'],
            'mock_test_c_price_royalty' => $_POST['mock_test_c_price_royalty'],
            'mock_test_d_price_royalty' => $_POST['mock_test_d_price_royalty'],
            'mock_test_e_price_royalty' => $_POST['mock_test_e_price_royalty'],
            'mock_test_f_price_royalty' => $_POST['mock_test_f_price_royalty'],
            
            'orientation_a_price' => $_POST['orientation_a_price'],
            'orientation_b_price' => $_POST['orientation_b_price'],
            'orientation_c_price' => $_POST['orientation_c_price'],
            'orientation_d_price' => $_POST['orientation_d_price'],
            'orientation_e_price' => $_POST['orientation_e_price'],
            'orientation_f_price' => $_POST['orientation_f_price'],
            
            'product_price' => $_POST['product_price'],
            
            'study_material_free_royalty' => $_POST['study_material_free_royalty'],
            
            // 'registration_start_date' => $_POST['registration_start_date'],
            // 'registration_end_date' => $_POST['registration_end_date']
        );
        
     
        $this->db->insert('revenue_setting', $revenue_data);
        $revenue_setting_id = $this->db->insert_id();
        
        
        // Process competition dates
        $dates = explode(", ", $_POST['close_date']);
        sort($dates);
        $maxDate = end($dates);
        
        // Prepare competition data
        $competition_data = array(
            'product_name' => $product->product_name,
            'clevel' => $_POST['competition_level_id'],
            'status' => 'Live',
            'product_price' => $_POST['product_price'],
            'state_id' => $_POST['state_id'],
            'period_id' => $_POST['period_id'],
            'associate_id' => $_POST['associate_id'],
            // 'associate_gst' => isset($_POST['associate_gst']) ? $_POST['associate_gst'] : 'Yes',
            'associate_split' => $_POST['associate_split'],
            'close_date' => $maxDate,
            'aviansys_split' => 'yes',
            // 'franchise_gst' => isset($_POST['gst_fran']) ? $_POST['gst_fran'] : 'Yes',
            'aviansys_gst' => 'Yes',
            'revenue_setting_id' => $revenue_setting_id,
            'com_per' => $_POST['com_per'],
            'manageper' => $_POST['manageper'],
            'com_peravian' => $_POST['com_peravian'],
            'associate_per' => $_POST['associate_per'],
            'school_amount' => $_POST['school_amount'],
        );
        
        $competition_data['franchise_split'] = $_POST['choice'];
        $competition_data['franchise_id'] = $_POST['franchise_id'];
        
        // Add material options based on prices
        $materials = ['a', 'b', 'c', 'd', 'e', 'f'];
        foreach($materials as $material) {
            // Study materials
            if(isset($_POST["study_material_{$material}_price"]) && !empty($_POST["study_material_{$material}_price"]) && $_POST["study_material_{$material}_price"] != 0) {
                $competition_data["study_material_{$material}"] = "study_material_{$material}";
            }
            // Orientation
            if(isset($_POST["orientation_{$material}_price"]) && !empty($_POST["orientation_{$material}_price"]) && $_POST["orientation_{$material}_price"] != 0) {
                $competition_data["orientation_{$material}"] = "orientation_{$material}";
            }
            // Mock tests
            if(isset($_POST["mock_test_{$material}_price"]) && !empty($_POST["mock_test_{$material}_price"]) && $_POST["mock_test_{$material}_price"] != 0 ) {
                $competition_data["mock_test_{$material}"] = "mock_test_{$material}";
                if($material == 'a') {
                    $competition_data['mock_test'] = 'mock_test';
                }
            }
        }
        
        // echo '<pre>';
        // print_r($competition_data);die;
        
        // Insert competition
        $this->db->insert('competition_product_state', $competition_data);
        $competition_id = $this->db->insert_id();
        
        
        // Insert all competition dates
        foreach ($dates as $date) {
            $this->db->insert('competition_dates', array(
                'close_date' => $date,
                'comp_id' => $competition_id
            ));
        }
        
        
    $this->db->order_by('zoomzoom_schedule_id ','DESC');  // or date desc or whatever column you want
    $res = $this->db->get_where('zoomzoom_schedule_cin')->row();

    $period = $this->db->get_where('period',array('period_id'=>$_POST['period_id']))->row();
    
    $zoomzoom_schedule_cin = array(
            'registration_code'	 =>$period->initials.'ZZREG0000'.$res->zoomzoom_schedule_id,
            'school'	 => '',
            'product_name'	 => $product->product_name,
            'period_id'	 => $_POST['period_id'],
            'school_amount'	 => $_POST['school_amount'],
            'crm_fix'	 => $_POST['crm_fix'],
            'amount'	 => $_POST['product_price'],
            'associate_cut'	 => $_POST['associate_per'],
            'associate_id'	 => $_POST['associate_id'],
            'start_date'	 => $_POST['registration_start_date'],
            'end_date'	 => $_POST['registration_end_date'],
            'subject'	 => '',
            'series'	 => '',
            'level_id'	 => $_POST['competition_level_id'],
            'revenue_setting_id'	 => '',
            'comp_id'	 => $competition_id,
            'mock'	 => $revenue_setting_id,
            'area'	 => $_POST['area_id'] ?? '',
            'state_id'	=> $_POST['state_id'] ?? '',
            'type'	 => '',
            'aviansys_percentage'	 => $_POST['com_peravian'],
            'management_percentage'	 => $_POST['manageper'],
            'franchise_percentage'	 => $_POST['com_per'],
            'franchise_id'	 => $_POST['franchise_id'],
            'syllabus' => '',
        );
        $this->db->insert('zoomzoom_schedule_cin', $zoomzoom_schedule_cin);
        $sch_id = $this->db->insert_id();
        
        if(!empty($_POST['schools'])){
            foreach($_POST['schools'] as $data){
                $this->db->insert('lunar_schedule_school', array(
                    'school_id' => $data,
                    'sch_id' => $sch_id
                ));
            }
        }
        
        if (!empty($_POST['classes'])) {
            foreach($_POST['classes'] as $class){
                $this->db->insert('zoomzoom_schedule_class', [
                    'class' => $class,
                    'sch_id' => $sch_id
                ]);
            }
        }

        
        
        // Complete transaction
        $this->db->trans_complete();
        
        // Set message based on transaction status
        if ($this->db->trans_status() === FALSE) {
            $data['message'] = 'Error: Transaction failed. Please try again.';
        } else {
            $data['message'] = 'Revenue setting and competition activated successfully';
        }
        
        $data['result'] = $_POST;
        $data['active_tab'] = 'competition';
    }
    
    // Handle delete operation
    if(isset($_POST['delete'])) {
        $res = $this->db->get_where('revenue_setting', array(
            'id' => $_POST['delete']
        ))->row();
        
        if($res) {
            $this->db->where('id', $_POST['delete']);
            $this->db->delete('revenue_setting');
            $data['message1'] = 'Entry deleted successfully';
        } else {
            $data['message1'] = 'Internal server error';
        }
        
        $data['active_tab'] = 'revenue';
    }
    
    // Handle search operation
    if(isset($_POST['search'])) {
        $product_id = $_POST['product_id'];
        $exists = $this->db->get_where('products', array(
            'product_id' => $product_id
        ))->row();
        
        $product_name = 'MaRRS Math Zoom Zoom Challenge';
        $data['ress'] = $_POST;
        
        $data['list_materials'] = $this->db
            ->limit(10)
            ->order_by('id', 'DESC')
            ->get_where('revenue_setting', array(
                'period_id' => $_POST['period'],
                'clevel' => $_POST['clevel'],
                'product_name' => 'MaRRS Math Zoom Zoom Challenge'
            ))
            ->result_array();
            
        if(!empty($product_name)) {
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name', 'MaRRS Math Zoom Zoom Challenge');
            $res = $this->db->get();
            $data['level_load'] = $res->result();
        }
        
        $data['active_tab'] = 'revenue';
    }
    
    // Load required data for the view
    if(!isset($data['list_materials'])) {
        $data['list_materials'] = $this->db
            ->limit(10)
            ->order_by('id', 'DESC')
            ->get('revenue_setting')
            ->result_array();
    }
    
    // Load basic data
    $data['period'] = $this->db->get_where('period', array('period_id >=' => '15'))->result_array();
    $data['state'] = $this->db->get_where('states', array('country_id' => '105'))->result_array();
    
    if(isset($data['result']['state_id'])) {
        $data['franchise'] = $this->db->get_where('franchise', array(
            'state_id' => $data['result']['state_id']
        ))->result_array();
    }
    
    $data['associate'] = $this->db->get('associates')->result_array();
    $data['level'] = $this->db->get('competition_level_byproduct')->result_array();
    
    if(isset($data['result']['product_name'])) {
        $data['level'] = $this->db->get_where('competition_level_byproduct', array(
            'product_name' => 'MaRRS Math Zoom Zoom Challenge'
        ))->result_array();
    }
    
    $data['product'] = $this->db->get_where('products', array('status' => 'Active','product_name'=>'MaRRS Math Zoom Zoom Challenge'))->result_array();
    $data['area'] = $this->db->get('areas')->result_array();
    
    // Set default active tab
    if(!isset($data['active_tab'])) {
        $data['active_tab'] = 'revenue';
    }
    
    // Load view
    $this->load->view("admin_revenue_and_competition_view.php", $data);
}   
    
    
    
    
    public function admin_revenue_and_competition_() 
    {
        $data = array();
        
        // Handle revenue setting submission
        if(isset($_POST['submit_revenue'])) {
            
            $this->_handle_revenue_submission($data);
        }
        
        // Handle competition launch submission
        if(isset($_POST['submit_competition'])) {
            $this->_handle_competition_submission($data);
        }
        
        // Handle delete operation
        if(isset($_POST['delete'])) {
            $this->_handle_delete_operation($data);
        }
        
        // Handle search operation
        if(isset($_POST['search'])) {
            $this->_handle_search_operation($data);
        }
        
        // Load necessary data
        $this->_load_required_data($data);
        
        // Load view
        $this->load->view("admin_revenue_and_competition_view.php", $data);
    }
    
    private function _handle_revenue_submission(&$data) 
    {
        $res = $this->db->get_where('revenue_setting', array(
            'period_id' => $_POST['period'],
            'clevel' => $_POST['clevel'],
            'product_id' => $_POST['product_id']
        ))->row();
        
        $product = $this->db->get_where('products', array(
            'product_id' => $_POST['product_id']
        ))->row();
        
        // if(empty($res)) {
            $ar = $this->_prepare_revenue_data($product);
            
        print_r($ar);die;    
            
            $this->db->insert('revenue_setting', $ar);
            $data['message'] = 'Revenue setting added successfully';
        // } else {
        //     $data['message'] = 'Revenue setting already exists for this product, level, and period';
        // }
        
        $data['result'] = $_POST;
        $data['active_tab'] = 'revenue';
    }
    
    private function _prepare_revenue_data($product) 
    {
        return array(
            'period_id' => $_POST['period'],
            'product_name' => $product->product_name,
            'product_id' => $_POST['product_id'],
            'clevel' => $_POST['clevel'],
            'manageper' => $_POST['manageper'],
            'com_peravian' => $_POST['com_peravian'],
            'associate_per' => $_POST['associate_per'],
            'crm_fix' => $_POST['crm_fix'],
            'study_material_a_price_royalty' => $_POST['study_material_a_price_royalty'],
            'study_material_b_price_royalty' => $_POST['study_material_b_price_royalty'],
            'study_material_c_price_royalty' => $_POST['study_material_c_price_royalty'],
            'study_material_d_price_royalty' => $_POST['study_material_d_price_royalty'],
            'study_material_e_price_royalty' => $_POST['study_material_e_price_royalty'],
            'study_material_f_price_royalty' => $_POST['study_material_f_price_royalty'],
            'study_material_a_price' => $_POST['study_material_a_price'],
            'study_material_b_price' => $_POST['study_material_b_price'],
            'study_material_c_price' => $_POST['study_material_c_price'],
            'study_material_d_price' => $_POST['study_material_d_price'],
            'study_material_e_price' => $_POST['study_material_e_price'],
            'study_material_f_price' => $_POST['study_material_f_price'],
            'mock_test_a_price_royalty' => $_POST['mock_test_a_price_royalty'],
            'mock_test_b_price_royalty' => $_POST['mock_test_b_price_royalty'],
            'mock_test_c_price_royalty' => $_POST['mock_test_c_price_royalty'],
            'mock_test_d_price_royalty' => $_POST['mock_test_d_price_royalty'],
            'mock_test_e_price_royalty' => $_POST['mock_test_e_price_royalty'],
            'mock_test_f_price_royalty' => $_POST['mock_test_f_price_royalty'],
            'mock_test_a_price' => $_POST['mock_test_a_price'],
            'mock_test_b_price' => $_POST['mock_test_b_price'],
            'mock_test_c_price' => $_POST['mock_test_c_price'],
            'mock_test_d_price' => $_POST['mock_test_d_price'],
            'mock_test_e_price' => $_POST['mock_test_e_price'],
            'mock_test_f_price' => $_POST['mock_test_f_price'],
            'orientation_a_price' => $_POST['orientation_a_price'],
            'orientation_b_price' => $_POST['orientation_b_price'],
            'orientation_c_price' => $_POST['orientation_c_price'],
            'orientation_d_price' => $_POST['orientation_d_price'],
            'orientation_e_price' => $_POST['orientation_e_price'],
            'orientation_f_price' => $_POST['orientation_f_price'],
            'product_price' => $_POST['product_price'],
            'com_per' => $_POST['com_per'],
            'study_material_free_royalty' => $_POST['study_material_free_royalty']
        );
    }
    
    private function _handle_competition_submission(&$data) 
    {
        $res = $this->db->get_where('revenue_setting', array(
            'period_id' => $_POST['period_id'],
            'clevel' => $_POST['competition_level_id'],
            'product_id' => $_POST['product_name']
        ))->row();
        
        if(!empty($res)) {
            $dates = explode(", ", $_POST['close_date']);
            sort($dates);
            $maxDate = end($dates);
            $close_date = $maxDate;
            
            $arr = $this->_prepare_competition_data($res, $close_date);
            $this->db->insert('competition_product_state', $arr);
            $insert_id = $this->db->insert_id();
            
            foreach ($dates as $date) {
                $ar = array(
                    'close_date' => $date,
                    'comp_id' => $insert_id
                );
                $this->db->insert('competition_dates', $ar);
            }
            
            $data['message'] = 'Competition added successfully';
        } else {
            $data['message'] = 'No revenue setting found';
        }
        
        $data['result'] = $_POST;
        $data['active_tab'] = 'competition';
    }
    
    private function _prepare_competition_data($res, $close_date) 
    {
        $product = $this->db->get_where('products', array(
            'product_id' => $_POST['product_name']
        ))->row();
        
        $arr = array(
            'product_name' => $product->product_name,
            'clevel' => $_POST['competition_level_id'],
            'status' => 'Live',
            'state_id' => $_POST['state_id'],
            'period_id' => $_POST['period_id'],
            'associate_id' => $_POST['associate_id'],
            'associate_gst' => $_POST['associate_gst'],
            'associate_split' => $_POST['associate_split'],
            'close_date' => $close_date,
            'aviansys_split' => 'yes',
            'franchise_gst' => $_POST['gst_fran'],
            'aviansys_gst' => 'Yes',
            'revenue_setting_id' => $res->id
        );
        
        if(isset($_POST['choice'])) {
            $arr['franchise_split'] = $_POST['choice'];
            $arr['franchise_id'] = $_POST['franchise_id'];
        }
        
        // Add material options
        $materials = ['a', 'b', 'c', 'd', 'e', 'f'];
        foreach($materials as $material) {
            if(isset($_POST["study_material_{$material}"])) {
                $arr["study_material_{$material}"] = "study_material_{$material}";
            }
            if(isset($_POST["orientation_{$material}"])) {
                $arr["orientation_{$material}"] = "orientation_{$material}";
            }
            if(isset($_POST["mock_test_{$material}"])) {
                $arr["mock_test_{$material}"] = "mock_test_{$material}";
                if($material == 'a') {
                    $arr['mock_test'] = 'mock_test';
                }
            }
        }
        
        return $arr;
    }
    
    private function _handle_delete_operation(&$data) 
    {
        $res = $this->db->get_where('revenue_setting', array(
            'id' => $_POST['delete']
        ))->row();
        
        if($res) {
            $this->db->where('id', $_POST['delete']);
            $this->db->delete('revenue_setting');
            $data['message1'] = 'Entry deleted successfully';
        } else {
            $data['message1'] = 'Internal server error';
        }
        
        $data['active_tab'] = 'revenue';
    }
    
    private function _handle_search_operation(&$data) 
    {
        $product_id = $_POST['product_id'];
        $exists = $this->db->get_where('products', array(
            'product_id' => $product_id
        ))->row();
        
        $product_name = 'MaRRS Math Zoom Zoom Challenge';
        $data['ress'] = $_POST;
        
        $data['list_materials'] = $this->db
            ->limit(10)
            ->order_by('id', 'DESC')
            ->get_where('revenue_setting', array(
                'period_id' => $_POST['period'],
                'clevel' => $_POST['clevel'],
                'product_name' => 'MaRRS Math Zoom Zoom Challenge'
            ))
            ->result_array();
            
        if(!empty($product_name)) {
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name', 'MaRRS Math Zoom Zoom Challenge');
            $res = $this->db->get();
            $data['level_load'] = $res->result();
        }
        
        $data['active_tab'] = 'revenue';
    }
    
    private function _load_required_data(&$data) 
    {
        // Load revenue settings list
        if(!isset($data['list_materials'])) {
            $data['list_materials'] = $this->db
                ->limit(10)
                ->order_by('id', 'DESC')
                ->get('revenue_setting')
                ->result_array();
        }
        
        // Load basic data
        $data['period'] = $this->db->get_where('period', array('period_id >=' => '15'))->result_array();
        $data['state'] = $this->db->get_where('states', array('country_id' => '105'))->result_array();
        
        if(isset($data['result']['state_id'])) {
            $data['franchise'] = $this->db->get_where('franchise', array(
                'state_id' => $data['result']['state_id']
            ))->result_array();
        }
        
        $data['associate'] = $this->db->get('associates')->result_array();
        $data['level'] = $this->db->get('competition_level_byproduct')->result_array();
        
        // if(isset($data['result']['product_name'])) {
            $data['level'] = $this->db->get_where('competition_level_byproduct', array(
                'product_name' => 'MaRRS Math Zoom Zoom Challenge'
            ))->result_array();
        // }
        
        $data['product'] = $this->db->get_where('products', array('status' => 'Active','product_name'=>'MaRRS Math Zoom Zoom Challenge'))->result_array();
        $data['area'] = $this->db->get('areas')->result_array();
        
        // Set default active tab
        if(!isset($data['active_tab'])) {
            $data['active_tab'] = 'revenue';
        }
    }
    
    
    
    
}