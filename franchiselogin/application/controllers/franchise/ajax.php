<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller {
	
    public function __construct() 
	{
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
		$this->load->library('csv');
		$this->load->library('email');
	//	$this->load->model('locationmodel');
		$this->load->model('franchisemodel'); // FOR GETTING Main franchise list
		//$this->load->model('resultmodel');
		$this->load->model('schoolmodel');
    }
    
    
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
    public function updateCenterStatus()
    {
        header('Content-Type: application/json');  // Ensure JSON response
    
        $center_id = $_POST['center_id'] ?? null;
        $action = $_POST['action'] ?? null;
    
        if (empty($center_id) || empty($action)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Request', 'post' => $_POST]);
            exit;
        }
    
        $arr = [];
    
        // Action handling
        if ($action == 'close_registration') {
            $arr = ['exam_close' => 1];
        } elseif ($action == 'open_registration') {
            $arr = ['exam_close' => ''];
        } elseif ($action == 'close_material_a_close') {
            $arr = ['close_material_a' => 1];
        } elseif ($action == 'open_material_a_close') {
            $arr = ['close_material_a' => ''];
        } elseif ($action == 'close_material_b_close') {
            $arr = ['close_material_b' => 1];
        } elseif ($action == 'open_material_b_close') {
            $arr = ['close_material_b' => ''];
        } elseif ($action == 'close_material_c_close') {
            $arr = ['close_material_c' => 1];
        } elseif ($action == 'open_material_c_close') {
            $arr = ['close_material_c' => ''];
        } elseif ($action == 'close_orientation_a') {
            $arr = ['close_orientation_a' => 1];
        } elseif ($action == 'open_orientation_a') {
            $arr = ['close_orientation_a' => ''];
        } elseif ($action == 'close_orientation_b') {
            $arr = ['close_orientation_b' => 1];
        } elseif ($action == 'open_orientation_b') {
            $arr = ['close_orientation_b' => ''];
        } elseif ($action == 'close_orientation_c') {
            $arr = ['close_orientation_c' => 1];
        } elseif ($action == 'open_orientation_c') {
            $arr = ['close_orientation_c' => ''];
        } elseif ($action == 'close_mock_test_a') {
            $arr = ['mock_test_a' => 1];
        } elseif ($action == 'open_mock_test_a') {
            $arr = ['mock_test_a' => ''];
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Action']);
            exit;
        }
    
        // Update in DB
        $this->db->where('center_id', $center_id);
        $success = $this->db->update('exam_centers', $arr);
    
        if ($success) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
        }
    
        exit;  // Stop further output
    }


    public function changestatusschoolandsavebank()
    {
        print_R($_POST);die;
    }

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

    public function getstate() {
        $data['res'] = $this->locationmodel->listStates();
		$this->load->view("getStateAjax.php",$data);
    }

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

	public function get_FranchiseType()
	{
		//$franchise_type=$this->input->post('franchise_type');
		$data['franchise_ref']=$this->franchisemodel->get_franchiseref();
		$this->load->view("franchise_RefView.php",$data);
	}

/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

	public function getfilter_cin()
	{
		$service_id=$this->session->userdata('fr_service_id');
		$filter_data= array(
							'period_id' =>  $this->input->post('period_id'),
							'service_id' => $service_id,
							'competition_level_id' =>  $this->input->post('competition_level_id'),
							'competition_center_id' =>  $this->input->post('competition_center_id'),
							'school_id' =>  $this->input->post('school_id'),
							'category_id' =>  $this->input->post('category_id'),
							'cin' =>  $this->input->post('cin')
							);
		$data['returned_list'] = $this->resultmodel->studentlist_result_view($filter_data);
		$this->load->view("getCinAjax.php",$data);
	}
	
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

    public function listSchools_to_assignSchedule() 
	   {
		 $cmpId = $this->input->post('compId');
		 $aim = $this->input->post('aim');
         $assign_schedule_frId = $this->session->userdata('franchise_id');
         $assign_params = array('assign_schedule_frId' =>  $assign_schedule_frId, 
		                        'aim' => $aim, 
						        'competition_schedule_id' => $cmpId);
          $data['school_list']= $this->schoolmodel->listschool($assign_params);	
		  $data['aim']= $aim;	
          $this->load->view("assign_school_view.php",$data);
     } /* End of listSchools_to_assignSchedule() */
	 
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

    public function insertSchedule_to_schools() 
	   {
		  $cmpId = $this->input->post('compId');
		  $aim = $this->input->post('aim');
          $insert_schedule_frId = $this->session->userdata('franchise_id');
		  $schools=$this->input->post('schoolID');
          $insert_params = array('assign_schedule_frId' =>  $insert_schedule_frId, 
		                        'aim' => $aim, 
						        'competition_schedule_id' => $cmpId,
								'schoolIds' =>$schools
								);
          $schoolSchedule_insertedStatus= $this->schoolmodel->insertSchool_schedule($insert_params);
		  echo $schoolSchedule_insertedStatus;	
     } /* End of functioninsert_school_schedule*/
	 
/******************************BELOW FN CREATED ON 6TH NOV14***********************************************************************/
  public function export_sent_result_file()
  {
	/* echo $base_url."    -----   ".BASE_URL;*/
	 $mark_entry_status = $this->input->post('YesData');
	 $level_name=$mark_entry_status['level_name'];
	/*  $rounds_allCategory = $this->input->post('rounds_allCategory');
	  $export_data =  $this->input->post('export_data');
	  $level_name =  $this->input->post('level_name');*/
	  
     $excel_fields =array(
					 'SerialNo',
					 'Period_id',
					 'Period',
					 'competition_schedule_id',
					 'Competion Level',
					 'CIN',
					 'Student Id',
					 'Student Name',
					 'Category Id',
					 'Category',
					 'School Id',
					 'School Name',
					 'School Address',
					 'Franchise Id',
					 'Franchise Code',
					 'State Id',
					 'State',
					 'Email',
					 'Contact No'
					 );
				/*print_r($excel_fields);*/
				
				/*...START.. Get Round names seperately  based on round type(Written / oral)*/
				$allRounds= $mark_entry_status['rounds_allCategory']; /*print_r($allRounds);*/
				
				$excel_round_names=array();
				foreach($allRounds as $key => $value):
					foreach($value['compRoundIds'] as $key1 => $roundData):
					    array_push($excel_round_names,$roundData['round_name']);
				   endforeach;	
				endforeach;
				/*...END*/
			
				$excel_round_names   = array_count_values($excel_round_names);
				
				/*print_r($excel_round_names);*/
				/* ...START..:  Get Round names  and thier count respectively to identyfy which rounds are common for each category and which rounds are not */
				/* ...END..:  */

				/*....START : The following code formulate the Heading/Tilte for the Excel file which is going to export*/
				 $round_fields=array();
				 $i=1;
				 $rounCheck_count=0;
				 foreach($excel_round_names as $round => $count ):
							 
							/*if($count ==6)
							{*/
							  array_push( $excel_fields ,"Round-".$i);
							  array_push( $excel_fields ,"Round-".$i."  Mark");
							  $i=$i+1;	
							/*}
							else
							{*/
							  //$rounCheck_count=	$rounCheck_count+1;
							/*}
						  */
				 endforeach;
				 /* End foreach */
				 
				 if($rounCheck_count!=0)
				 {          
				 			 array_push( $excel_fields ,"Round-".$i);
							 array_push( $excel_fields ,"Round-".$i."  Mark");
				 }/* End if */

				/*....END : The code to formulate the Heading/Tilte for the Excel file which is going to export*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
 /*echo "<pre>";print_r($excel_fields);*/

            $list_student_marks = $mark_entry_status['export_data'];
			/*echo '<pre>'; print_r($list_student_marks );*/
			$data_excel = array();
            $n    = 1;
			
			foreach($list_student_marks as  $cat_id =>  $item) 
			{
				$period_name=$item['period_name'];
				$state_name=$item['state_subdivision_name'];
				$franchise_code=$item['franchise_code'];
                $item['serial_no'] = $n;
                $d  = array(
                    $item['serial_no'],
					$item['period_id'],
 				    $item['period_name'],
					$item['competition_schedule_id'],
					$level_name,
					$item['cin'],
					$item['student_id'],
                    $item['first_name'] . " " . $item['middle_name'] . " " . $item['last_name'],
					$item['category_id'],
                    $item['categoryKey'],
					$item['school_id'],
					$item['school_name'],
                    $item['school_address'],
					$item['franchise_id'],
                    $item['franchise_code'],
					$item['state_subdivision_id'],
                    $item['state_subdivision_name'],
					$item['father_email']." , ".$item['mother_email'],
					$item['father_phone'] . " , " . $item['mother_phone'] . " , " . $item['std_code']."-".$item['phone'],
                );
				foreach ($item['marks'] as  $m):
							  array_push($d,$m['round_name']);
						      array_push($d,$m['mark']);
				endforeach;
				
				$data_excel[]=$d;
				
                /*echo $item['serial_no'];exit;*/
                $n++;
            }
			
	      $heading= array("Testing ..... MaRRS Spelling Bee ".$state_name."  ".$level_name." Result - ".$period_name." (Sent by Franchise)");
          $linebreak = array("-----------------------------------------------------------------------------------------------");
		    $file_path="public/uploads/result_files/SB ".$state_name." ".$level_name." Result sent-on ".date("d-M-Y [H.i.s]").".csv";
			   
			   $output = fopen($file_path, "w") or die("Unable to open file!");
			   fputcsv($output, $heading);
			   fputcsv($output, $linebreak);
			   fputcsv($output, $excel_fields);
			   foreach($data_excel as $item){
					fputcsv($output, $item);
			   }
			   fclose($output);
				 
/*-----------------------------BELOW CODE FOR  SENT RESULT FILE TO HO-------------------*/
	 
				$email_id='webteam3@marrs.in';
				$email_cc='webteam2@marrs.in';
				$this->email->from('marrsspellingbee@marrs.in','Marrs Spelling Bee');  
				$this->email->to($email_id); 
				$this->email->cc($email_cc); 
				$this->email->subject("MaRRS Spelling Bee ".$state_name." ".$level_name." Result - ".$period_name." (Sent by Franchise)");  
				$this->email->attach($file_path);
				$result_email_content='<table>
										<tr><td>State</td><td>:</td><td>'.$state_name.'</td> </tr>
									    <tr><td>Compeition Level Name</td><td>:</td><td>'.$level_name.'</td> </tr>
									    <tr><td>Franchise code</td><td>:</td><td>'.$franchise_code.'</td> </tr>
									    <tr><td>Franchise User-Name</td><td>:</td><td>'.$this->session->userdata('username').'</td> </tr>
									   
							  </table>'; 
				$this->email->message($result_email_content);  
				$status = $this->email->send(); 
			    if($status=='1')
			     { 
			     $this->notifications->notify('<font color="#FF0000" ><b>Result file sent to HO Successfully<b></font>', 'success');
                 $period_id    = $this->input->post('period_id');
				 $service_id  = $this->input->post('service_id');
				 $competition_level_id = $this->input->post('competition_level_id');
				 $competition_center_id = $this->input->post('competition_center_id');
				 $school_id = $this->input->post('school_id');
				 $category_id = $this->input->post('category_id');
	             $params  = array(
									'period_id' => $period_id,
									'service_id' => $service_id,
									'competition_level_id' => $competition_level_id,
									'competition_center_id' => $competition_center_id,
									'school_id' => $school_id,
									'category_id' => $category_id
								 );		 		 
			     $data['email_sent_status'] = $this->resultmodel->set_result_sent_status($params);
				  
			     return $data['email_sent_status'];
				} /*End if */
			   else 
			    {  $this->notifications->notify('<font color="#FF0000"><b>Sorry ! Email Sent Failed<b></font>', 'error');	} /*End else*/
			  
		/*$total_result= $this->resultmodel->get_total_result_for_HO($params);*/
  } /* End of export_sent_result_file*/
  
  
  public function updateCompetitionMode() {
    
   // print_r($_POST);die;
    header('Content-Type: application/json');

    $school_id  = $this->input->post('school_id');
    $mode       = $this->input->post('mode');
    $start_date = $this->input->post('start_date');
    $end_date   = $this->input->post('end_date');

    // ── Basic validation ──────────────────────────────────────────
    if (empty($school_id) || !in_array($mode, ['online', 'offline'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
        return;
    }

    // ── Mode-specific validation ──────────────────────────────────
    if ($mode === 'online') {
        // Online requires: start date + end date only
        if (empty($start_date) || empty($end_date)) {
            echo json_encode(['status' => 'error', 'message' => 'Start date and end date are required for online mode.']);
            return;
        }
        $comp_date = null; // clear competition date for online

    } elseif ($mode === 'offline') {
        // Offline requires: competition date only
        
        $comp_date = null;
        $start_date = null; // clear start date for offline
        $end_date   = null; // clear end date for offline
    }

    // ── Step 1: Update competition_mode in school_new ─────────────
    $this->db->where('id', $school_id);
    $this->db->update('school_new', ['competition_mode' => $mode]);

    // ── Step 2: Insert or update product_to_school ────────────────
    $school = $this->db->get_where('school_new', ['id' => $school_id])->row_array();

    $existing = $this->db->get_where('product_to_school', [
        'school_id' => $school_id,
        'period_id' => '16'
    ])->row();

    $data = [
        'start_date'       => $start_date,  // set for online,  null for offline
        'end_date'         => $end_date,    // set for online,  null for offline
        'competition_mode' => $mode
    ];

    if ($existing) {
        $this->db->where('school_id', $school_id);
        $this->db->where('period_id', '16');
        $this->db->update('product_to_school', $data);
    } else {
        $data['school_id']    = $school_id;
        $data['period_id']    = '16';
        $data['school_code']  = isset($school['school_code'])  ? $school['school_code']  : '';
        $data['franchise_id'] = isset($school['franchise_id']) ? $school['franchise_id'] : '0';
        $data['product_id']   = isset($school['product_id'])   ? $school['product_id']   : '1';
        $data['pricecode_id'] = '1';
        $data['level_id']     = '1';
        $data['product_name'] = 'Competition';
        $data['franchise_per']= '0';
        $data['amount']       = '0';
        $data['school_amount']= '0';
        $this->db->insert('product_to_school', $data);
    }

    echo json_encode(['status' => 'success']);
} 
public function updateCinMode() {
    $school_id  = $this->input->post('school_id');
    $mode       = $this->input->post('mode');
    $start_date = !empty($this->input->post('start_date')) ? $this->input->post('start_date') : NULL;
    $end_date   = !empty($this->input->post('end_date'))   ? $this->input->post('end_date')   : NULL;
    $comp_date  = !empty($this->input->post('comp_date'))  ? $this->input->post('comp_date')  : NULL;

    if ($mode === 'online') {
        $data = array(
            'registration_mode'            => 'online',
            'competition_mode_start_date' => $start_date,
            'competition_mode_end_date'   => $end_date,
            'competition_mode_comp_date'  => NULL
        );
    } else {
        $data = array(
            'registration_mode'            => 'offline',
            'competition_mode_comp_date'  => $comp_date,
            'competition_mode_start_date' => NULL,
            'competition_mode_end_date'   => NULL
        );
    }

    // Check if row already exists
    $exists = $this->db->get_where('product_to_school', array(
        'school_id' => $school_id,
        'period_id' => '16'
    ))->row();

    if ($exists) {
        // Row exists → UPDATE
        $this->db->where('school_id', $school_id);
        $this->db->where('period_id', '16');
        $this->db->update('product_to_school', $data);
    } else {
        // Row missing → INSERT
        $data['school_id'] = $school_id;
        $data['period_id'] = '16';
        $this->db->insert('product_to_school', $data);
    }

    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Mode updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save. Please try again.']);
    }
}
 public function school_list($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id))->result_array();
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
public function lunar_schedules($id='')
    {
        if(!empty($_POST['lunar_schedule_id']))
        {
            $schedule = $this->db->get_where('lunar_schedule_cin', ['lunar_schedule_id' => $_POST['lunar_schedule_id']])->row();
                 
            // echo $this->db->last_query();die;
                            
            $data['res'] = $this->db->select('revenue_setting.*,competition_product_state.id as sch_id, competition_product_state.revenue_setting_id')
                ->from('competition_product_state')
                ->join('revenue_setting','revenue_setting.id = competition_product_state.revenue_setting_id')
            
                ->where('competition_product_state.subject', $schedule->subject)
                ->where('competition_product_state.series', $schedule->series)
                ->where('competition_product_state.type', $schedule->type)
                ->where('competition_product_state.product_name',$schedule->product_name)
                ->where('competition_product_state.revenue_setting_id IS NOT NULL', null, false)
                ->group_by('competition_product_state.id')
                ->get()
                ->result_array();

            
            // echo $this->db->last_query();die;
            
        }else{
            $data['res'] =[];
        }
        
		$this->load->view("lunar_schedulescheckbox.php",$data);
    }
	
	
	public function getProductCompetition($id='')
    {
        // print_r($_POST);die;
        
        if(!empty($_POST['period']) && !empty($_POST['franchise_id'])){
            $data['res'] = $this->db->select('*')
                ->from('competition_product_state')
                ->where([
                    'period_id' => $_POST['period'],
                    'franchise_id' => $_POST['franchise_id'],
                    'clevel' => 1
                ])
                ->where('revenue_setting_id != ','')
                ->group_by('competition_product_state.product_name')
                ->get()
            ->result();
            
            // echo $this->db->last_query();die;
        }else{
            $data['res'] =[];
        }
        
		$this->load->view("getProductCompetition.php",$data);
    }
	
	
	
	public function getstateAjax($id='') 
	{
			
		$country_id = $this->input->post('country_id');
        $data['res'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
		$this->load->view("getStateAjax.php",$data);  
    } 
    
    
    public function getsubjectvarient($id='')
    {
        $sub_id = $this->input->post('sub_id');
        $subject = $this->db->get_where('lunar_subjects',array('subject_key'=>$subject_key))->row();
        
        
        $data['lunar_varient'] = $this->db->get_where('lunar_varient',array('sub_id'=>$sub_id))->result_array();
        
		$this->load->view("lunar_varientselect.php",$data);  
    }
    
    
    public function getlunar_subject_key($id='')
    {
        $subject_key = $this->input->post('subject_key');
        $subject = $this->db->get_where('lunar_subjects',array('subject_key'=>$subject_key))->row();
        
        
        $data['lunar_varient'] = $this->db->get_where('lunar_varient',array('sub_id'=>$subject->sub_id))->result_array();
        
		$this->load->view("lunar_varientselect.php",$data);  
    }


    public function getlunar_series_per_subject($id='')
    {
        
        $subject_key = $this->input->post('subject_key');
        
        
        $this->db->where('subject' ,$subject_key);
        $this->db->group_by('series');
        $query = $this->db->get('lunar_schedule_cin');
        
        // echo $this->db->last_query();die;
        
        $data['lunar_series'] = $query->result_array();
        
		$this->load->view("lunar_seriesselect.php",$data);  
    }



    public function getlunar_type_per_serie($id='')
    {
        
        $serie = $this->input->post('serie');
        $subject_key = $this->input->post('subject_key');
        
        $this->db->where('series' ,$serie);
        $this->db->where('subject' ,$subject_key);
        $this->db->group_by('series');
        $query = $this->db->get('lunar_schedule_cin');
        
        // echo $this->db->last_query();die;
        
        $data['lunar_series'] = $query->result_array();
        
		$this->load->view("lunar_rypeselect.php",$data);  
    }


    public function getlunar_series($id='')
    {
        
        $subject_key = $this->input->post('subject_key');
        $varient = $this->input->post('varient');
        $period = $this->input->post('period');
        
        
        $this->db->where('subject' ,$subject_key);
        $this->db->where('type',$varient);
        // $this->db->where('period_id',$period);
        $this->db->group_by('series');
        $query = $this->db->get('lunar_schedule_cin');
        
        // echo $this->db->last_query();die;
        
        $data['lunar_series'] = $query->result_array();
        
		$this->load->view("lunar_seriesselect.php",$data);  
    }
    
    

    public function getlunar_subject_varient_series($id=''){
        
        $subject_key = $this->input->post('subject_key');
        $varient = $this->input->post('varient');
        $period = $this->input->post('period');
        
        
        $this->db->where('subject' ,$subject_key);
        $this->db->where('type',$varient);
        $this->db->where('period_id',$period);
        $this->db->group_by('series');
        $query = $this->db->get('lunar_schedule_cin');
        
        // echo $this->db->last_query();die;
        
        $data['lunar_series'] = $query->result_array();
        if (empty($data['lunar_series'])) {
            $data['lunar_series'][] = ['series' => '10001'];
        }

		$this->load->view("lunar_seriesselect.php",$data);  
    }
    

    public function statewisearea($id='')
    {
			
	//	$product_id = $this->input->post('product_name');
        $state_id = $this->input->post('state_id');
        $data['level'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getstatearea.php",$data);  
    } 
    
    public function statewisearea_newww($id='')
    {
			
	//	$product_id = $this->input->post('product_name');
        $state_id = $this->input->post('state_id');
        if($state_id == 002){
            $data['level'] = $this->db->get_where('areas')->result_array();
        }else{
            $data['level'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
        }
		$this->load->view("getstatearea.php",$data);  
    }
    
    public function statewisearea_newallarea($id='')
    {
			
	//	$product_id = $this->input->post('product_name');
        $state_id = $this->input->post('state_id');
        if($state_id == 002){
            $data['level'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
        }else{
            $data['level'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
        }
		$this->load->view("allgetstatearea.php",$data);  
    }
    
    
    public function statewisearea_($id='') 
    {
			
	//	$product_id = $this->input->post('product_name');
        $state_id = $this->input->post('state_id');
        $data['level'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getstatearea_.php",$data);  
    }

    public function getstateAjax_($id='') 
    {
			
		$country_id = $this->input->post('country_id');
        $data['res'] = $this->db->get_where('states',array('country_id'=>$country_id))->result_array();
		$this->load->view("getStateAjax.php",$data);  
    } 
    
	public function productwiselevel($id='') 
	{
			
		$product_id = $this->input->post('product_id');
		
        $product_name = $this->db->get_where('products',array('product_id'=>$product_id))->row()->product_name;
        $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>$product_name))->result_array();
        
		$this->load->view("getLevelAjax.php",$data);  
    } 
    
    public function productwiselevelname($id='') 
	{
			
		$product_name = $this->input->post('product_name');
		
        // $product_name = $this->db->get_where('products',array('product_id'=>$product_id))->row()->product_name;
        $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>$product_name))->result_array();
        
		$this->load->view("getLevelAjax.php",$data);  
    }
    
    public function getrevenuesettingcompetition($id=''){
        
        $data['result'] = $_POST;
        
        $this->db->select('revenue_setting.*');
		$this->db->from('competition_product_state');
		$this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id');
		$this->db->where('competition_product_state.product_name',$_POST['product_name']);
		$this->db->where('competition_product_state.clevel',$_POST['clevel']);
		$this->db->where('competition_product_state.period_id',$_POST['period']);
		$this->db->where('competition_product_state.franchise_id',$_POST['franchise_id']);
		$this->db->where('revenue_setting_id !=','');
		$query=$this->db->get();
 		
//  		echo $this->db->last_query();die;
 		
        $data['level'] = $query->result_array();
        
        
		$this->load->view("revenue_list_checkbox.php",$data);
    }
    
    public function product_wiselevel($id='') 
    {
			
		$product_id = $this->input->post('product_id');
		
        // $product_name = $this->db->get_where('products',array('product_id'=>$product_id))->row()->product_name;
        $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_id'=>$product_id))->result_array();
        
		$this->load->view("getLevelAjax.php",$data);  
    } 
    
    public function productwiselevel_($id='') 
    {
			
		$product_name = $this->input->post('product_id');
         //= $this->db->get_where('products',array('product_name'=>$product_id))->row()->product_name;
        $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_name'=>$product_name))->result_array();
		$this->load->view("getLevelAjax_.php",$data);  
    } 
    
    
    public function productwiselevel_schoollevel($id='') 
    {
			
		$product_id = $this->input->post('product_id');
        $product = $this->db->get_where('products',array('product_id'=>$product_id))->row();
        
        $data['level'] = $this->db
            ->from('competition_level_byproduct')
            ->where('product_name',$product->product_name)
            // ->like('level_name', 'SCH', 'after')
            ->get()
            ->result_array();
        // echo $this->db->last_query();    
        // print_r($data['level']);die;
		$this->load->view("getLevelAjax_schoollevel.php",$data);  
    }
    
    
    public function productwisecategory($id='') 
    {
			
		$product_id = $this->input->post('product_id');
        $product = $this->db->get_where('products',array('product_id'=>$product_id))->row();
        
        $data['level'] = $this->db
            ->from('categoryBYProduct')
            ->where('product_name',$product->product_name)
            ->group_by('category_id')
            ->get()
            ->result_array();
        // echo $this->db->last_query();    
        // print_r($data['level']);die;
		$this->load->view("productwisecategory.php",$data);  
    }
    
    
    public function productwiselevelwithName($id='')
    {
			
	//	$product_id = $this->input->post('product_name');
        $product_name = $this->input->post('product_id');
        $data['level'] = $this->db->get_where('competition_level_byproduct',array('product_updated'=>$product_name))->result_array();
        // echo $this->db->last_query();die;
		$this->load->view("getLevelAjax.php",$data);  
    } 


    public function franchiseListAssign($id='') 
    {
			
		$state_id = $this->input->post('franchise_id');
        $data['franchise'] = $this->db->join('products','products.product_id=product_allotted_fr.product_id')->group_by('products.product_name')->get_where('product_allotted_fr',array('franchise_id'=>$state_id))->result_array();
		$this->load->view("franchiseListAssign.php",$data);  
    } 

	public function franchiseList($id='')
	{
		//echo 'ok';die;	
		$state_id = $this->input->post('state_id');
        $data['franchise'] = $this->db->get_where('franchise',array('state_id'=>$state_id))->result_array();
		$this->load->view("getFranchiseList.php",$data);  
    } 
    
    public function franchiseList_($id='')
    {
			
		$state_id = $this->input->post('state_id');
        $data['franchise'] = $this->db->get_where('franchise',array('state_id'=>$state_id))->result_array();
		$this->load->view("getFranchiseList_.php",$data);  
    } 
    
    public function franchiseList__($id='') 
    {
			
		$state_id = $this->input->post('state_id');
		
		if($state_id == 002){
            $this->db->select('*');
    		$this->db->from('franchise');
    // 		$this->db->where('state_id',$state_id);
    		$this->db->where("account_id !=", '');
    		$query=$this->db->get();
        }else{
            $this->db->select('*');
    		$this->db->from('franchise');
    		$this->db->where('state_id',$state_id);
    		$this->db->where("account_id !=", '');
    		$query=$this->db->get();
        }
		
		
		
 //		echo $this->db->last_query();die;
 
 
 
        $data['franchise'] = $query->result_array();
		$this->load->view("getFranchiseList_.php",$data);  
    } 
    
    
    
    
    
    
    public function getDistrictAjax($id='')
    {
			
		$state_id = $this->input->post('state_id');
        $data['res'] = $this->db->get_where('districts',array('state_id'=>$state_id))->result_array();
		$this->load->view("getDistrictList.php",$data);  
    }  
    
    public function getAreaAjax($id='') 
    {
			
		$state_id = $this->input->post('state_id');
        $data['res'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getAreaAjaxList.php",$data);  
    } 	
	
	public function getAreaAjax_($id='') 
	{
			
		$state_id = $this->input->post('state_id');
        $data['res'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getAreaAjaxList_.php",$data);  
    }
	
	public function getAreaAjax__($id='') 
	{
			
		$state_id = $this->input->post('state_id');
        $data['res'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getAreaAjaxList__.php",$data);  
    } 
    	function get_departmentHead()
	{
		$department_id=$this->input->post('department_id');
		$data['department_head']=$this->departmentmodel->getDepartmentHead($department_id);
		$this->load->view("departmentHeadAjaxView.php",$data);
	}//end function get_departmentHead()
		
	public function getService_franchise()
	{
		$data['franchise_ref']=$this->franchisemodel->get_franchiseref();
		$this->load->view("franchise_RefView.php",$data); 
	}//end function  getService_franchise()

    public function franchise_schoolDetails()
    {
    	$fr_id=$this->input->post('franchise_id');
    	$params = array("fr_id" => $fr_id);
    	$data_school['school']=$this->schoolmodel->listSchool($params);
    	$this->load->view("getSchoolAjax.php",$data_school); 
    	
    	/*$sch_option='<option value=""> --select school--</option>';
    	foreach($data_school as $sh):
    		  $sch_option=  $sch_option.'<option value="'.$sh["school_id"].'">'.$sh["school_name"].'</option>';
        endforeach;
    	echo $sch_option;*/
    
    	//$this->load->view("pid_school_list.php",$data); 
    }/* end of function list_schoolDetails()*/ 

    public function getStateFranchise()
    {
	    $state_id = $this->input->post('state_id');
        $data['res'] = $this->franchisemodel->Get_Statewise_Franchise($state_id);
		
		$this->load->view("getStateFranchiseAjax.php",$data);
    }/*End of getStateFranchise function*/

    public function getStateFranchiseaccount()
    {
	    $state_id = $this->input->post('state_id');
	    
	    $this->db->select('*');
        $this->db->from('franchise');
	    $this->db->where('state_id', $state_id);
	    $this->db->where('account_id !=','');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();
        
		$this->load->view("getStateFranchiseAjax1.php",$data);
    }

    public function school_list_($id='')
    {
	  	    $franchise_id = $this->input->post('area_code');
	    //echo $franchise_id;die;
	    $this->db->distinct();
	    $this->db->select('school_name');
        $this->db->from('cin_list');
	    $this->db->where('franchise_code', $franchise_id);
	    $this->db->where('period_id','12');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();
		
		
		$this->load->view("getSchoolList_c.php",$data);
    }
    
    
    public function school_list_allresult($id='')
    {
	  	    $franchise_id = $this->input->post('area_code');
	    //echo $franchise_id;die;
	    $this->db->distinct();
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('area_code', $franchise_id);
	   // $this->db->where('period_id','12');
	    $this->db->order_by('school_name','ASC');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();
		
		
		$this->load->view("getSchoolList_c.php",$data);
    }
    

    public function school_list_c($id='')
    {
	  	    $franchise_id = $this->input->post('area_code');
	    //echo $franchise_id;die;
	    $this->db->distinct();
	    $this->db->select('school_name');
        $this->db->from('cin_list');
	    $this->db->where('franchise_code', $franchise_id);
	    $this->db->where('period_id','12');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		
		$this->load->view("getSchoolList_c.php",$data);
    }
       public function school_list_period($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    $period_id = $this->input->post('period_id');
	    if($period_id >= 15){
	        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id,'status_new'=>'Active'))->result_array();
	    }else{
            $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id))->result_array();
	    }
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
    
    
    public function school_list_active($id='')
    {
        $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id,'status_new'=>'Active'))->result_array();
		
		$this->load->view("getSchoolList.php",$data);
    }
    
    public function school_list_active1($id='')
    {
        $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id))->result_array();
		
		$this->load->view("getSchoolList.php",$data);
    }
 
    public function school_list_checkbox($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id))->result_array();
		
		$this->load->view("school_list_checkbox.php",$data);
    }/*End of getschoollist function*/
 
    
    public function school_list_checkboxnewactive($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id,'status_new'=>'Active'))->result_array();
		
		$this->load->view("school_list_checkbox.php",$data);
    }/*End of getschoollist function*/
 
 
    public function school_list_checkboxzoom($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id,'zoomstatus'=>'Active'))->result_array();
		
		$this->load->view("school_list_checkbox.php",$data);
    }/*End of getschoollist function*/
     
 
    public function school_list_checkboxnew($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id,'status_new'=>'Active'))->result_array();
		
		$this->load->view("school_list_checkbox.php",$data);
    }
 
 
    public function school_list_checkboxnotactive($id='')
    {
	    $franchise_id = $this->input->post('area_code');
	    
	    
        $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('area_code'=>$franchise_id))->result_array();
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
 
 
 
 
 
    public function school_listassign($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    $data['res'] = $this->db->order_by('school_name','ASC')->get_where('school_new',array('franchise_id'=>$franchise_id))->result_array();
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
 
    public function school_list_areawise($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    //echo $franchise_id;die;
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('area_code', $franchise_id);
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
 
    public function school_list_franchisewise($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    //echo $franchise_id;die;
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('franchise_id', $franchise_id);
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/
 
    public function school_list_areawis($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    //echo $franchise_id;die;
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('area_code', $franchise_id);
	   // $this->db->where('school_status','Active');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("get_schoollist.php",$data);
 }/*End of getschoollist function*/

    public function school_list_statewise($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    //echo $franchise_id;die;
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('state', $franchise_id);
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("getSchoolList.php",$data);
    }/*End of getschoollist function*/

    public function school_list_statewise_($id='')
    {
	    $franchise_id = $this->input->post('franchise_id');
	    //echo $franchise_id;die;
	    $this->db->distinct();
	    $this->db->select('school_name');
        $this->db->from('cin_list');
	    $this->db->where('state_id', $franchise_id);
	    $this->db->where('period_id','12');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("getSchoolList_.php",$data);
    }/*End of getschoollist function*/

    public function districtlist($id='')
    {
	    $state_id = $this->input->post('state_id');
        $data['res'] = $this->db->get_where('districts',array('state_id'=>$state_id))->result_array();
		
		$this->load->view("getDistrictList.php",$data); 
    }
    
    public function AreaCode($id='')
    {
	    $state_id = $this->input->post('franchise_id');
        $data['area'] = $this->db->join('areas','areas.id = area_to_franchise.area_id','right')->get_where('area_to_franchise',array('franchise_id'=>$state_id))->result_array();
		$this->load->view("getAreaList.php",$data); 
    }
 
 public function AreaCodeState($id='')
    {
	    $state_id = $this->input->post('state_id');
        $data['area'] = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
		$this->load->view("getAreaState.php",$data); 
    }
    public function ActiveSchool($id='')
    {
	    $state_id = $this->input->post('state_id');
        $data['area'] = $this->db->get_where('school_new',array('state'=>$state_id,'school_status'=>'Active'))->result_array();
		$this->load->view("getSchoolActive.php",$data); 
    }
    
    public function AreaCode_($id='')
    {
	    $state_id = $this->input->post('franchise_id');
        $data['area'] = $this->db->join('areas','areas.id = area_to_franchise.area_id','right')->get_where('area_to_franchise',array('franchise_id'=>$state_id))->result_array();
		$this->load->view("getAreaList_.php",$data); 
    }
 
    public function ProductList($id='')
    {
	    $state_id = $this->input->post('franchise_id');
        
         $data['product'] = $this->db->join('products','products.product_id = product_allotted_fr.product_id','right')->get_where('product_allotted_fr',array('franchise_id'=>$state_id))->result_array();
		//print_r($data['product']);exit;
		$this->load->view("getProductList.php",$data); 
    }

    public function get_product_list($id='')
    {
        $categ = $this->input->post('categ');
        $data['product'] = $this->db->get_where('zoomzoom_products_category',array('categ'=>$categ))->result_array();
		
		$this->load->view("product_list_zoom.php",$data);
    }
    
    public function pricecode($id='')
    {
        $fr_id = $this->input->post('franchise_id');
                                    $this->db->select('*');
                                    $this->db->from('products');
                                    $this->db->join('product_allotted_fr','product_allotted_fr.product_id=products.product_id');
                                   
                                    $this->db->where('product_allotted_fr.franchise_id',$fr_id);
                                   
								    $res = $this->db->get();
								    $data['product'] = $res->result_array();
		$this->load->view("Ajaxlistpricecode.php",$data);
    }

    public function class_category($id='')
    {
        $product_id = $this->input->post('product_id');
        $data['catego'] = $this->db->get_where('product_class_applicable',array('product_id'=>$product_id))->result_array();
        $this->load->view("getClassAjax.php",$data);
    }

    public function level_list_productwise($id='')
    {
	    $period_id = $this->input->post('period_id');
	    //echo $franchise_id;die;
	    //$this->db->distinct();
	    $this->db->select('*');
        $this->db->from('competition_level_byproduct');
	    $this->db->where('product_id', $period_id);
	    
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("levellist_productwise.php",$data);
    }/*End of getschoollist function*/
 
    public function level_list_productwise_($id='')
    {
	    $product = $this->input->post('period_id');
	    //echo $franchise_id;die;
	    //$this->db->distinct();
	    $this->db->select('*');
        $this->db->from('competition_level_byproduct');
	    $this->db->where('product_name', $product);
	    
	    $query = $this->db->get();
        $data['res'] = $query->result_array();;
		
		$this->load->view("levellist_productwise.php",$data);
 }/*End of getschoollist function*/
 
    public function school_list_statewise13_($id='')
    {
	    $state_id = $this->input->post('state_id');
	    //echo $franchise_id;die;
	    $this->db->distinct();
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('state', $state_id);
	   // $this->db->where('school_status','Active');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();
		
		$this->load->view("getSchoolList__.php",$data);
    }/*End of getschoollist function*/

    public function open_schools($id=''){
        $state_id = $this->input->post('state_id');
        // $this->db->distinct();
	    $this->db->select('*');
        $this->db->from('school_new');
	    $this->db->where('state', $state_id);
	    $this->db->like('school_code', 'OP');
	    $query = $this->db->get();
        $data['res'] = $query->result_array();
// 		echo $this->db->last_query();die;
		$this->load->view("getSchoolListss.php",$data);
    }
    
}
