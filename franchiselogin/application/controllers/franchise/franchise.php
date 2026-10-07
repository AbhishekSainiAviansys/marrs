<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Franchise extends CI_Controller 
{
    public function __construct() 
    {
	    parent::__construct();
        if (!$this->session->userdata('franchise_id')) 
        {
            redirect('franchise/login/', 'refresh');
        }
		$this->load->library('encrypt');
		$this->load->library('email');
		$this->load->library('csv');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->model('franchisemodel');
		$this->load->model('schoolmodel'); /*LIST ALL MARRS PRODUCTS*/
    }
    
    public function index()
    {
         echo 'franchise';die;
         	$this->load->view("cin_genration.php");
     }
    
    public function cin_genration()
    {
		
		if(isset($_POST['submit'])) {
	      
    	    $product = $this->input->post('product');
    		$franchise_id = $this->session->userdata('franchise_id');
    		$school = $this->input->post('school');
    		$period_id = $this->input->post('period_id');
    		$clevel = $this->input->post('1');
    		$state_id= $this->input->post('state_id');
    		$country_id = $this->input->post('country');
    		$area_code= $this->input->post('area_code');
    		//print_r($state_id);exit; 
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row=2;/*skip first 2 heading rows */
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
						  
						  $csv_result_array  =  array(   'period_id'  => $period_id , 
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
														  'status'      =>'Active'
														  );
														 
						  // print_r($csv_result_array);die; 
						   $csv_upload_status = $this->franchisemodel->generate_cin_franchise($csv_result_array,$product); 
						   array_push($csvResult_upolad_logArray,$csv_upload_status);
						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
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

          
		$this->load->view("cin_genration.php");  
		
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
 
    $area_code = $this->db->get_where('school_new', array('id' => $product_to_school->school_id))->row()->area_code ?? null;
    $school_id = $product_to_school->school_id ?? null; // ASSUMPTION: school = product_to_school.school_id
    $state_id  = $product_to_school->state_id ?? null;
 
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
 
            // FIX: CSV has ONE header row, not two.
            if ($rowNum <= 1) continue;
 
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
 
            // FIX: catch a completely invalid class_id (not in the map at all)
            // BEFORE calling the model, so it shows up clearly in the same row.
            if ($class === '') {
                $failCount++;
                $csvResult_upolad_logArray[] = [
                    'row'       => $rowNum,
                    'cin'       => '',
                    'stud_name' => $stud_name,
                    'class'     => $class_id, // show the raw bad value they entered
                    'status'    => "Invalid Class ID Error: '$class_id' is not a recognized class.",
                    'result'    => null,
                ];
                continue;
            }
 
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
 
            // FIX: $result is ALWAYS a non-empty array from the model (even on
            // failure), so we can no longer use `if ($result)` to detect success.
            // Instead check the actual status message the model returns at index 6.
            $statusMsg = is_array($result) ? ($result[6] ?? '') : '';
            $isSuccess = (stripos($statusMsg, 'Success') === 0);
 
            if ($isSuccess) {
                $successCount++;
            } else {
                $failCount++;
            }
 
            $csvResult_upolad_logArray[] = [
                'row'       => $rowNum,
                'cin'       => is_array($result) ? ($result[0] ?? '') : '',
                'stud_name' => $stud_name,
                'class'     => $class,
                'status'    => $statusMsg,
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
	
	
	public function cin_lists()
    {
        $franchise_id = $this->session->userdata('franchise_id');

	    $compid = $this->uri->segment(4);
	    $data['comp_id'] = $compid;
	    $this->db->select('cin_list.*, cin_list.id as cin_id, cin_result.*');
	    $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin=cin_result.cin');
	    $this->db->where('cin_result.competition_schedule_id',$compid);
	    $this->db->where('cin_list.franchise_id',$franchise_id);
	//	$this->db->order_by("id", "DESC");
		//$this->db->limit(50);
		$data['cin_list'] = $this->db->get()->result_array(); 

		$this->load->view('cin_lists',$data);    
    }
    public function export_cin($compid)
    
{    $franchise_id = $this->session->userdata('franchise_id');
     $this->db->select("cin_list.*, 
        cin_result.competition_schedule_id, 
        cin_result.product_name AS result_product_name, 
        competition_schedule.competition_caption, 
        competition_level_byproduct.level_name,franchise.franchise_first_name,
        school_new.school_name AS resolved_school_name", FALSE);
    $this->db->from('cin_list');
    $this->db->join('cin_result', 'cin_list.cin = cin_result.cin', 'left');
    $this->db->join('competition_schedule', 'competition_schedule.competition_schedule_id = cin_result.competition_schedule_id');
    $this->db->join('competition_level_byproduct', 'competition_schedule.competition_level_id = competition_level_byproduct.level_id', 'left');
    $this->db->join('school_new', 'cin_list.school_id = school_new.id', 'left');
    $this->db->join('franchise', 'cin_list.franchise_code = franchise.franchise_id', 'left');
     $this->db->join('period', 'competition_schedule.period_id = period.period_id', 'left');
    $this->db->where('cin_result.competition_schedule_id', $compid);
    $this->db->where('cin_list.franchise_id',$franchise_id);
    $this->db->group_by('cin_list.cin');
    $result = $this->db->get()->result_array();

    // Filename from first row
    $filename_school   = !empty($result) ? $result[0]['resolved_school_name'] : 'School';
    $competition_name  = !empty($result) ? $result[0]['competition_caption'] : 'Competition';
    $safe_school = preg_replace('/[^A-Za-z0-9_-]/', '_', $filename_school);
    $safe_comp   = preg_replace('/[^A-Za-z0-9_-]/', '_', $competition_name);

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=CIN_List_{$safe_school}_{$safe_comp}_" . date('YmdHis') . ".csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $fp = fopen('php://output', 'w');
    fputcsv($fp, array(
        'SL No', 'Student Name', 'CIN', 'Product Name', 'Level', 'Franchise ID', 'Area Code',
        'Class', 'Category', 'School Name', 'Father Name', 'Mother Name',
        'Gender', 'Phone', 'Email','Competition Name'
    ));

    $i = 1;
    foreach ($result as $row) {
        fputcsv($fp, array(
            $i++,
            $row['student_name'],
            $row['cin'],
            $row['result_product_name'],
            $row['level_name'],
            $row['franchise_first_name']   ?? '',
            $row['franchise_code'] ?? '',
            $row['class'],
            $row['category_id']    ?? '',
            $row['resolved_school_name'],
            $row['father_name'],
            $row['mother_name'],
            $row['gender'],
            $row['stud_phone'],
            $row['stud_email'],
            $row['level_name'].' Competition',
        ));
    }
    fclose($fp);
    exit;
}
     public function schoollevelactive()
    {
        $uri = $this->uri->segment(4);
        
        $school = $this->db->get_where('school_new',array('id'=>$uri))->row();
            
        if($school->status_new == 'Active'){
            $data = array(
                'status_new' =>'Inactive'
            );
        }else{
            $data = array(
            'status_new' =>'Active'
            );
        }
        
        $this->db->where('school_id', $uri);
        $this->db->where('period_id', 16);
        $this->db->delete('product_to_school');
        
		 
		 $this->db->where('id',$uri);
	     $set_status= $this->db->update('school_new',$data);
	     
		 if($set_status)
		 {
					     
            $this->notifications->notify('School Level Status Updated Successfully ', 'success');
		 } 
		 else
		{
	    	$this->notifications->notify('School Level Status Updation Failed', 'error');
		}
		redirect('https://marrs.in/franchiselogin/franchise/franchise/schooList');
          
    }
    
	
   public function newschoollevelactive()
{
    $school_id        = $this->input->post('school_id');
    $product_ids      = $this->input->post('product_id');
    $product_prices   = $this->input->post('product_price');
    $product_levels   = $this->input->post('product_level');
    $school_amount    = $this->input->post('schoolper');
    $manageper        = $this->input->post('manageper');
    $com_peravian     = $this->input->post('com_peravian');
    $associate_per    = $this->input->post('associate_per');
    $com_per          = $this->input->post('com_per');
    $crm_per          = $this->input->post('crm_per');
    $free_mat_royalty = $this->input->post('free_mat_royalty');
    $competition_type = $this->input->post('competition_type');
    $crm = $this->input->post('crm');
     // New A/B fields
    $material_training_a         = $this->input->post('material_training_a');
    $material_training_a_royalty = $this->input->post('material_training_a_royalty');
    $material_training_b         = $this->input->post('material_training_b');
    $material_training_b_royalty = $this->input->post('material_training_b_royalty');
    
    $material_a_price   = $this->input->post('material_a_price');
    $material_a_royalty = $this->input->post('material_a_royalty');
    $material_b_price   = $this->input->post('material_b_price');
    $material_b_royalty = $this->input->post('material_b_royalty');
    
    $orientation_a_price = $this->input->post('orientation_a_price');
    $orientation_b_price = $this->input->post('orientation_b_price');
    
    $mocktest_a_price   = $this->input->post('mocktest_a_price');
    $mocktest_a_royalty = $this->input->post('mocktest_a_royalty');
    $mocktest_b_price   = $this->input->post('mocktest_b_price');
    $mocktest_b_royalty = $this->input->post('mocktest_b_royalty');  
            
            
            

    if (empty($product_ids) || !is_array($product_ids)) {
        echo json_encode(['status' => 'error', 'message' => 'Select at least one product.']);
        return;
    }

    $school = $this->db->get_where('school_new', ['id' => $school_id])->row();
    if (!$school) {
        echo json_encode(['status' => 'error', 'message' => 'School not found.']);
        return;
    }

    // Pre-load all levels
    $all_levels_raw = $this->db
        ->select('level_id, level_name, product_id')
        ->order_by('medal_no', 'ASC')
        ->get('competition_level_byproduct')
        ->result_array();

    $levelsByProduct = [];
    foreach ($all_levels_raw as $lv) {
        $levelsByProduct[$lv['product_id']][] = $lv;
    }

    // ── DELETE removed products from product_to_school ────────────────────
    // Any product_id NOT in the submitted list should be removed
    // $this->db->where('school_id', $school_id);
    // $this->db->where('period_id', 16);
    // $this->db->where_not_in('product_id', $product_ids);
    // $this->db->delete('product_to_school');

    // ── Track all level_ids processed for this school/product ────────────
    $processed = []; // [ product_id => [level_id, level_id, ...] ]

    foreach ($product_ids as $product_id) {

        $price_code = isset($product_prices[$product_id]) ? trim($product_prices[$product_id]) : '';
        if (empty($price_code)) continue;

        $amount = null;
        if (strpos($price_code, '-') !== false) {
            $parts  = explode('-', $price_code);
            $amount = end($parts);
        }
        if ($amount === null || $amount === '') continue;

        $product = $this->db->get_where('products', ['product_id' => $product_id])->row_array();
        if (empty($product)) continue;

        $selected_level     = isset($product_levels[$product_id]) ? trim($product_levels[$product_id]) : '';
        $product_level_rows = isset($levelsByProduct[$product_id]) ? $levelsByProduct[$product_id] : [];

        if ($selected_level === 'All' || $selected_level === '') {
            $levels_to_process = $product_level_rows;
            if (empty($levels_to_process)) {
                $levels_to_process = [['level_id' => 1, 'level_name' => 'Level 1']];
            }
        } else {
            $matched_name = 'Level ' . $selected_level;
            foreach ($product_level_rows as $lr) {
                if ((string)$lr['level_id'] === (string)$selected_level) {
                    $matched_name = $lr['level_name'];
                    break;
                }
            }
            $levels_to_process = [['level_id' => $selected_level, 'level_name' => $matched_name]];
        }

        $processed[$product_id] = [];

        foreach ($levels_to_process as $level_row) {

            $level_id = $level_row['level_id'];
            $processed[$product_id][] = $level_id;

            // ── revenue_setting ───────────────────────────────────────────
            $revenue_setting = [
                'product_id'                  => $product_id,
                'product_name'                => $product['product_name'],
                'clevel'                      => $level_id,
                'period_id'                   => 16,
                'com_per'                     => 0,
                'manageper'                   => $manageper,
                'com_peravian'                => $com_peravian,
                'associate_per'               => $associate_per,
                'crm_per'                     => $crm_per,
                'study_material_free_royalty' => $free_mat_royalty,
                'bundle_price_a'         => $material_training_a,
                'bundle_price_a_royality'      => $material_training_a_royalty,
                'bundle_price_b'              => $material_training_b,
                'bundle_price_b_royality'      => $material_training_b_royalty,
    
                'study_material_a_price'         => $material_a_price,
                'study_material_a_price_royalty' => $material_a_royalty,
                'study_material_b_price'         => $material_b_price,
                'study_material_b_price_royalty' => $material_b_royalty,
    
                'orientation_a_price'         => $orientation_a_price,
                'orientation_b_price'         => $orientation_b_price,
    
                'mock_test_a_price'           => $mocktest_a_price,
                'mock_test_a_price_royalty'   => $mocktest_a_royalty,
                'mock_test_b_price'           => $mocktest_b_price,
                'mock_test_b_price_royalty'   => $mocktest_b_royalty,
            ];

            $existing_revenue = $this->db->get_where('revenue_setting', [
                'product_id' => $product_id,
                'period_id'  => 16,
                'clevel'     => $level_id,
            ])->row();

            if ($existing_revenue) {
                $this->db->where('product_id', $product_id);
                $this->db->where('period_id',  16);
                $this->db->where('clevel',     $level_id);
                $this->db->update('revenue_setting', $revenue_setting);
                $revenue_setting_id = $existing_revenue->id;
            } else {
                $this->db->insert('revenue_setting', $revenue_setting);
                $revenue_setting_id = $this->db->insert_id();
            }

            // ── product_to_school ─────────────────────────────────────────
            $data = [
                'school_code'        => $school->school_code,
                'amount'             => $amount,
                'school_id'          => $school_id,
                'product_id'         => $product_id,
                'product_name'       => $product['product_name'],
                'pricecode_id'       => $price_code,
                'period_id'          => 16,
                'level_id'           => $level_id,
                'franchise_id'       => $this->session->userdata('franchise_id'),
                'school_amount'      => $school_amount,
                'manageper'          => $manageper,
                'com_peravian'       => $com_peravian,
                'associate_per'      => $associate_per,
                'franchise_per'      => $com_per,
                'crm_per'            => $crm_per,
                'free_mat_royalty'   => $free_mat_royalty,
                'revenue_setting_id' => $revenue_setting_id,
                'competition_type'   => $competition_type,
                'crm_id'   => $crm,
            ];

            $existing_pts = $this->db->get_where('product_to_school', [
                'school_id'  => $school_id,
                'period_id'  => 16,
                'product_id' => $product_id,
                'level_id'   => $level_id,
            ])->row();
           

            if ($existing_pts) {
                $this->db->where('school_id',  $school_id);
                $this->db->where('period_id',  16);
                $this->db->where('product_id', $product_id);
                $this->db->where('level_id',   $level_id);
                $this->db->update('product_to_school', array_merge($data, [
                    'updated_at' => date('Y-m-d H:i:s'),
                ]));
            } else {
                  $exitP = $this->db->get_where('product_to_school', [
                  'school_id'  => $school_id,
                  'period_id'  => 16,
                  'level_id'   => $level_id,
            ])->row();
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['competition_mode_start_date'] = $exitP->competition_mode_start_date;
                $data['competition_mode_end_date']= $exitP->competition_mode_end_date;
                // Preserve existing competition_mode and registration_mode
                $data['competition_mode']  = 'offline';
                $data['registration_mode'] = 'offline';
                $this->db->insert('product_to_school', $data);
               
            }

            // ── Delete old level rows for this product not in new selection ──
            // if (!empty($processed[$product_id])) {
            //     $this->db->where('school_id',  $school_id);
            //     $this->db->where('period_id',  16);
            //     $this->db->where('product_id', $product_id);
            //     $this->db->where_not_in('level_id', $processed[$product_id]);
            //     $this->db->delete('product_to_school');
            // }

            // ── competition_schedule ──────────────────────────────────────
            $dataSchedule = [
                'country_id'           => '105',
                'period_id'            => '16',
                'state_id'             => $school->state,
                'school_id'            => $school_id,
                'product_id'           => $product_id,
                'competition_level_id' => $level_id,
                'franchise_id'         => $this->session->userdata('franchise_id'),
                'product_name'         => $product['product_name'],
                'competition_fee'      => $amount,
                'center_address'       => $school->school_name,
                'status'               => 'Active',
            ];

            $existing_schedule = $this->db->get_where('competition_schedule', [
                'period_id'            => '16',
                'state_id'             => $school->state,
                'school_id'            => $school_id, 
                'product_id'           => $product_id,
                'competition_level_id' => $level_id,
                'franchise_id'         => $this->session->userdata('franchise_id'),
            ])->row();

            if ($existing_schedule) {
                $this->db->where('competition_schedule_id', $existing_schedule->competition_schedule_id);
                $this->db->update('competition_schedule', $dataSchedule);
            } else {
                $this->db->insert('competition_schedule', $dataSchedule);
            }

            // ── competition_product_state ─────────────────────────────────
            $product_state_comp = [
                'revenue_setting_id' => $revenue_setting_id,
                'product_name'       => $product['product_name'],
                'clevel'             => $level_id,
                'period_id'          => 16,
                'com_per'            => 0,
                'manageper'          => $manageper,
                'com_peravian'       => $com_peravian,
                'associate_per'      => $associate_per,
                'crm_per'            => $crm_per,
                'school_amount'      => $school_amount,
            ];

            $existing_comp_state = $this->db->get_where('competition_product_state', [
                'revenue_setting_id' => $revenue_setting_id,
            ])->row();

            if ($existing_comp_state) {
                $this->db->where('id', $existing_comp_state->id);
                $this->db->update('competition_product_state', $product_state_comp);
            } else {
                $this->db->insert('competition_product_state', $product_state_comp);
            }

        } // end foreach levels
    } // end foreach products

    // Keep school Active
    $this->db->where('id', $school_id);
    $this->db->update('school_new', ['status_new' => 'Active']);

    echo json_encode([
        'status'  => 'success',
        'message' => 'School saved successfully.',
    ]);
}

public function getSchoolActivationData()
{
    $school_id = $this->input->post('school_id');

    $rows = $this->db->get_where('product_to_school', [
        'school_id' => $school_id,
        'period_id' => 16
    ])->result_array();

    if (empty($rows)) {
        echo json_encode([
            'status'        => 'success',
            'product_ids'   => [],
            'pricecode_ids' => [],
            'level_ids'     => [],
            'common'        => []
        ]);
        return;
    }

    $product_ids   = [];
    $pricecode_ids = [];
    $level_ids     = [];
    $seen          = [];
    $common        = [];

    foreach ($rows as $row) {

        $pid = (string)$row['product_id'];

        // Skip invalid product_id
        if ($pid == "0" || $pid == "") {
            continue;
        }

        // Store product details
        if (!isset($seen[$pid])) {
            $seen[$pid] = true;

            $product_ids[]       = $pid;
            $pricecode_ids[$pid] = (string)($row['pricecode_id'] ?? '');
            $level_ids[$pid]     = (string)($row['level_id'] ?? '');
        }

        // Take first row having common values
        if (empty($common) && (
                !empty($row['school_amount']) ||
                !empty($row['manageper']) ||
                !empty($row['com_peravian']) ||
                !empty($row['associate_per']) ||
                !empty($row['franchise_per']) ||
                !empty($row['crm_per']) ||
                !empty($row['free_mat_royalty'])
            )) {

            $common = [
                'school_amount'    => $row['school_amount'] ?? '',
                'manageper'        => $row['manageper'] ?? '',
                'com_peravian'     => $row['com_peravian'] ?? '',
                'associate_per'    => $row['associate_per'] ?? '',
                'franchise_per'    => $row['franchise_per'] ?? '',
                'crm_per'          => $row['crm_per'] ?? '',
                'free_mat_royalty' => $row['free_mat_royalty'] ?? '',
                'competition_type' => $row['competition_type'] ?? '',
                'crm_id' => $row['crm_id'] ?? '',

                'material_training_a'          => $row['material_training_a'] ?? '',
                'material_training_a_royalty'  => $row['material_training_a_royalty'] ?? '',
                'material_training_b'          => $row['material_training_b'] ?? '',
                'material_training_b_royalty'  => $row['material_training_b_royalty'] ?? '',

                'material_a_price'             => $row['material_a_price'] ?? '',
                'material_a_royalty'           => $row['material_a_royalty'] ?? '',
                'material_b_price'             => $row['material_b_price'] ?? '',
                'material_b_royalty'           => $row['material_b_royalty'] ?? '',

                'orientation_a_price'          => $row['orientation_a_price'] ?? '',
                'orientation_b_price'          => $row['orientation_b_price'] ?? '',

                'mocktest_a_price'             => $row['mocktest_a_price'] ?? '',
                'mocktest_a_royalty'           => $row['mocktest_a_royalty'] ?? '',
                'mocktest_b_price'             => $row['mocktest_b_price'] ?? '',
                'mocktest_b_royalty'           => $row['mocktest_b_royalty'] ?? '',
            ];
        }
    } 

    echo json_encode([
        'status'        => 'success',
        'product_ids'   => $product_ids,
        'pricecode_ids' => $pricecode_ids,
        'level_ids'     => $level_ids,
        'common'        => $common
    ]);
}
public function cin_list()
{
    $fr_id = $this->session->userdata('franchise_id');
    $franchise = $this->db->get_where('franchise', array('franchise_id' => $fr_id))->row();

    $this->db->select('*');
    $this->db->from('areas');
    $this->db->where('areas.state_id', $franchise->state_id);
    $query = $this->db->get();
    $data['area'] = $query->result_array();
// echo "<pre>";
// print_r($_POST);
// exit;
    if ($this->input->post('submit')) {
    $per = $this->db->get_where('period', array('period_id' => $this->input->post('period_id')))->row();
    $data['school']    = $school    = $this->input->post('school');
    $data['area_code'] = $area_code = $this->input->post('area_code');
    $data['school_list'] = $this->db
    ->order_by('school_name', 'ASC')
    ->get_where('school_new', array(
        'area_code' => $area_code
    ))
    ->result_array();
    $data['class']     = $class     = $this->input->post('class');
    $data['period']    = $period    = $this->input->post('period_id');

    $this->db->select('*, cin_list.id as cin_id');
    $this->db->from('cin_list');
    $this->db->join('school_new', 'school_new.id = cin_list.school_id');

    if ($school != '' && $school != 'All') {
        $this->db->where('cin_list.school_id', $school);
    }
    if ($this->input->post('product') != '') {
        $this->db->like('cin_list.cin', $per->initials . $this->input->post('product'));
    }
    if ($franchise->state_id != '') {
        $this->db->where('cin_list.state_id', $franchise->state_id );
    }
    if ($area_code != '' && $area_code != 'All') {
        $this->db->where('cin_list.franchise_code', $area_code);
    }
    $this->db->where('cin_list.period_id', $period);
    if ($class != '') {
        $this->db->where('cin_list.class', $class);
    }

    $query = $this->db->get();
//     echo $this->db->last_query();
// exit;
    $cin_list = $query->result_array();

    // ---- Attach product_name without a join ----
    $cin_parts = array();
    foreach ($cin_list as $item) {
        $cin_parts[] = substr($item['cin'], 2, 2);
    }
    $cin_parts = array_unique($cin_parts);

    $product_map = array();
    if (!empty($cin_parts)) {
        $this->db->select('in13, product_name');
        $this->db->from('products');
        $this->db->where_in('in13', $cin_parts);
        $product_rows = $this->db->get()->result_array();

        foreach ($product_rows as $p) {
            $product_map[$p['in13']] = $p['product_name'];
        }
    }

    foreach ($cin_list as &$item) {
        $cin_part = substr($item['cin'], 2, 2);
        $item['product_name'] = isset($product_map[$cin_part]) ? $product_map[$cin_part] : '';
    }
    unset($item);

    $data['cin_list'] = $cin_list;
}

    if ($this->input->post('export')) {

        $per = $this->db->get_where('period', array('period_id' => $this->input->post('period_id')))->row();

        $school    = $this->input->post('school');
        $area_code = $this->input->post('area_code');
        $class     = $this->input->post('class');
        $period    = $this->input->post('period_id');

        $this->db->select('*');
        $this->db->from('cin_list');
        $this->db->join('areas', 'areas.area_code = cin_list.franchise_code');
        $this->db->join('school_new', 'school_new.id = cin_list.school_id');

        if ($school != '' && $school != 'All') {
            $this->db->where('cin_list.school_id', $school);
        }
        if ($this->input->post('product') != '') {
            $this->db->like('cin_list.cin', $per->initials . $this->input->post('product'));
        }
        $this->db->where('cin_list.franchise_code', $area_code);
        $this->db->where('cin_list.period_id', $period);
        if ($class != '') {
            $this->db->where('cin_list.class', $class);
        }

        $query = $this->db->get();
        $cin_list = $query->result_array();

        // ---- Fix: fetch ALL product names in ONE query instead of one query per row ----
        $cin_parts = array();
        foreach ($cin_list as $item) {
            $cin_parts[] = substr($item['cin'], 2, 2);
        }
        $cin_parts = array_unique($cin_parts);

        $product_map = array();
        if (!empty($cin_parts)) {
            $this->db->select('in13, product_name');
            $this->db->from('products');
            $this->db->where_in('in13', $cin_parts);
            $product_rows = $this->db->get()->result_array();

            foreach ($product_rows as $p) {
                $product_map[$p['in13']] = $p['product_name'];
            }
        }

        // Fallback product name (used when a cin_part has no match in products)
        $fallback_product_name = '';
        if ($this->input->post('product') != '') {
            $fallback = $this->db->get_where('products', array('in13' => $this->input->post('product')))->row();
            if ($fallback) {
                $fallback_product_name = $fallback->product_name;
            }
        }

        $n = 1;
        $student = array();

        foreach ($cin_list as $item) {
            $cin_part = substr($item['cin'], 2, 2);
            $product_name = isset($product_map[$cin_part]) ? $product_map[$cin_part] : $fallback_product_name;

            $student[] = array(
                $n,
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

        $this->csv->export(
            $student,
            array('Slno', 'Cin', 'Name', 'Mobile', 'Email', 'Class', 'Father Name', 'Mother Name', 'School', 'School Address', 'Area Code', 'City', 'Product Name'),
            'studentlist.csv'
        );
        exit;
    }

    // if (isset($data['result']['school'])) {
    //     $this->db->select('*');
    //     $this->db->from('school_new');
    //     $this->db->where('school_new.area_code', $data['result']['area_code']);
    //     $this->db->where('school_new.state', $franchise->state_id);
    //     $query = $this->db->get();
    //     $data['school'] = $query->result_array();
    // }

    $data['productload'] = $this->db->get_where('products', array('status' => 'Active'))->result_array();

    $this->load->view("cin_list.php", $data);
}
    public function delete_cin($id)
    {   //echo $id;die;
        $this->db->where('id', $id);
        $this->db->delete('cin_list');
        redirect($_SERVER['HTTP_REFERER']);
    }

    
    
    public function cin_delete()
    {
		
		if(isset($_POST['submit'])) {
	      
    
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row=2;/*skip first 2 heading rows */
    		$i=0;
		
    		if($_FILES['csv']['size'] > 0) 
    			{   
				  
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
					{ 
					    //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];die;
					    
					   if($resultRow_from_csv[0]) 
					   { 
					       
						
						  $cin            =  addslashes($resultRow_from_csv[0]);
						  //echo $cin;die;
						  $this->db->where('cin',$cin);
						  $this->db->delete('cin_list');
						 
						  $this->db->where('cin',$cin);
						  $this->db->delete('cin_result');
						  //echo 'ok';die;
						  $csv_upload_status=[$cin,'CIN Deleted Successfully'];
						  
						  array_push($csvResult_upolad_logArray,$csv_upload_status);
						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
						   array_push($csvResult_upolad_logArray,$csv_upload_status);
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

          
		$this->load->view("cin_delete.php",$data);  
		
	}
    
    
    public function cin_profile_update_()
    {
		
		if(isset($_POST['submit'])) {
	        $data['result']=$_POST;
    	    $product = $this->input->post('product');
    		$franchise_id = $this->input->post('franchise_id');
    		$school = $this->input->post('school');
    // 		print_r($_POST);exit; 
    		$level = $this->input->post('1');
    		$period = $this->input->post('period');
    		$stat = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
    		$state_id = $this->input->post('state_id');
    		$country_id = $this->input->post('country');
    		$area_code = $this->input->post('area');
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row=2;/*skip first 2 heading rows */
    		$i=0;
		    $count=0;
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
					{ 
					   // echo "<br>"; echo $i ."-". $resultRow_from_csv[0];echo 'okk';die;
					   if($resultRow_from_csv[0]) 
					   { 
						        $cin            = addslashes($resultRow_from_csv[0]);
                                $stud_name      = addslashes($resultRow_from_csv[1]);
                                $class          = addslashes($resultRow_from_csv[2]);
                                $mobile_number  = addslashes($resultRow_from_csv[3]);  
                                $email          = addslashes($resultRow_from_csv[4]);
                                $father_name          = addslashes($resultRow_from_csv[5]);
                                $mother_name          = addslashes($resultRow_from_csv[6]);
                                
                                // Map the class to the class ID
                                $class_id = null;
                                if ($class == 'Nursery') { $class_id = 1; }
                                if ($class == 'LKG') { $class_id = 2; }
                                if ($class == 'UKG') { $class_id = 3; }
                                if ($class == 'Class-1') { $class_id = 4; }
                                if ($class == 'Class-2') { $class_id = 5; }
                                if ($class == 'Class-3') { $class_id = 6; }
                                if ($class == 'Class-4') { $class_id = 7; }
                                if ($class == 'Class-5') { $class_id = 8; }
                                if ($class == 'Class-6') { $class_id = 9; }
                                if ($class == 'Class-7') { $class_id = 10; }
                                if ($class == 'Class-8') { $class_id = 11; }
                                if ($class == 'Class-9') { $class_id = 12; }
                                if ($class == 'Class-10') { $class_id = 13; }
                                if ($class == 'Class-11') { $class_id = 14; }
                                if ($class == 'Class-12') { $class_id = 15; }
                                
                                // Create the array conditionally, only including non-null values
                                $csv = array();
                                
                                if (!empty($stud_name)) {
                                    $csv['student_name'] = $stud_name;
                                }
                                
                                if (!empty($email)) {
                                    $csv['stud_email'] = $email;
                                }
                                
                                if (!empty($mobile_number)) {
                                    $csv['stud_phone'] = $mobile_number;
                                }
                                
                                if (!empty($class)) {
                                    $csv['class'] = $class;
                                }
                                
                                if (!is_null($class_id)) {
                                    $csv['class_id'] = $class_id;
                                    $csv['category_id'] = $class_id;  // Assuming category_id is the same as class_id
                                }
                                
                                if (!empty($father_name)) {
                                    $csv['father_name'] = $father_name;
                                }
                                
                                if (!empty($mother_name)) {
                                    $csv['mother_name'] = $mother_name;
                                }
                                
                                // print_r($csv);die;
                                if (!empty($csv)) {
                                    $this->db->where('cin', $cin);                    
                                    $this->db->update('cin_list', $csv);  
                                    $csv_upload_status ='Profile Updated for CIN '.$cin;
                                    $data['count']=$count+1;
                                }else{
                                    $csv_upload_status ='Profile Not Updated for CIN '.$cin;
                                }
                                				 
						  //print_r($csv_result_array);echo $product.'ok';die; 
						  
						  
						  // $csv_upload_status = $this->franchisemodel->generate_cin($csv_result_array,$product); 
						   array_push($csvResult_upolad_logArray,$csv_upload_status);
						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
						   //array_push($csvResult_upolad_logArray,$csv_upload_status);
					   }/*End if*/
					   
					  }
				    $i=$i+1;	
			        }while($resultRow_from_csv = fgetcsv($handle,1000));
			 
			 
				    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
				   /*unset($_FILES);*/
				// 	$this->notifications->notify('CIN Generated Successfully','success');redirect('fran/franchise/cin_list');	
				 
			    }    /*END OF TYPE CHECKING*/
				else
				{
						$this->notifications->notify('Not a csv file ','error');
				}/*END OF ELSE TYPE CHECKING*/
					   
				  
				  
					  
			}/* End if */
		}


        
          
		$this->load->view("cin_profile_update.php",$data);  
		
	}
    	 
    	 
    public function search_profile()
    {
        $fr_id = $this->session->userdata('franchise_id');
        $franchise = $this->db->get_where('franchise',array('franchise_id'=>$fr_id))->row();
        
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
            
            if($_POST['type']=='mobile'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.stud_phone',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // print_r($data['cin_list']);die;
                $data['result']=$_POST;
            }
            if($_POST['type']=='cin'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.cin',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // print_r($data['cin_list']);die;
                $data['result']=$_POST;
            }
            if($_POST['type']=='email'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.stud_email',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // echo $this->db->last_query();die;
                $data['result']=$_POST;
            }
            
            
            
        }
        
        
        if (isset($_POST['export'])) {
            if($_POST['type']=='mobile'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.stud_phone',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // print_r($data['cin_list']);die;
                $data['result']=$_POST;
            }
            if($_POST['type']=='cin'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.cin',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // print_r($data['cin_list']);die;
                $data['result']=$_POST;
            }
            if($_POST['type']=='email'){
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->join('areas','areas.area_code=cin_list.franchise_code');
                $this->db->join('school_new','school_new.id=cin_list.school_id','left');
                
                $this->db->where('cin_list.stud_email',$_POST['value']);
                $query=$this->db->get();
                $data['cin_list']=$query->result_array();
                // echo $this->db->last_query();die;
                $data['result']=$_POST;
            }
            
            $cin_list = $query->result_array();
        
            $n = 1;
            $student = array();
        
            foreach ($cin_list as $item) {
                $item['serial_no'] = $n;
        
        
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
                    // $product_name  
                );
        
                $n++;
            }
        
            // Define the CSV headers (including Product Name)
            $this->csv->export($student, array('Slno', 'Cin', 'Name', 'Mobile', 'Email', 'Class', 'Father Name', 'Mother Name', 'School', 'School Address', 'Area Code', 'City'), 'studentlist.csv');
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
        
        
       $this->load->view("search_profile.php",$data); 
    
        
    }
    
    
    public function cin_profile_update()
    {
		

        if (isset($_POST['submit'])) {

            $csvResult_upolad_logArray = [];
        
            if (!empty($_FILES['csv']['tmp_name'])) {
        
                $file   = $_FILES['csv']['tmp_name'];
                $handle = fopen($file, "r");
                $ext    = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
        
                if ($ext === 'csv') {
        
                    $i = 1;
        
                    while (($resultRow_from_csv = fgetcsv($handle, 1000)) !== false) {
        
                        // Skip header
                        if ($i == 1) {
                            $i++;
                            continue;
                        }
        
                        // CIN mandatory
                        if (empty($resultRow_from_csv[0])) {
                            $i++;
                            continue;
                        }
        
                        $logRow = $resultRow_from_csv;
        
                        $cin           = trim($resultRow_from_csv[0]);
                        $class         = trim($resultRow_from_csv[1]);
                        $stud_name     = trim($resultRow_from_csv[2]);
                        $mobile_number = trim($resultRow_from_csv[3]);
                        $email         = trim($resultRow_from_csv[4]);
                        $school_code   = trim($resultRow_from_csv[5]);
        
                        // Class mapping
                        $classMap = [
                            'Nursery'  => 1, 'LKG' => 2, 'UKG' => 3,
                            'Class-1'  => 4, 'Class-2' => 5, 'Class-3' => 6,
                            'Class-4'  => 7, 'Class-5' => 8, 'Class-6' => 9,
                            'Class-7'  => 10,'Class-8' => 11,'Class-9' => 12,
                            'Class-10' => 13,'Class-11'=> 14,'Class-12'=> 15
                        ];
        
                        $class_id = isset($classMap[$class]) ? $classMap[$class] : null;
        
                        // Build CSV data (only filled)
                        $csv = [];
        
                        if ($stud_name !== '')     $csv['student_name'] = $stud_name;
                        if ($email !== '')         $csv['stud_email']   = $email;
                        if ($mobile_number !== '') $csv['stud_phone']   = $mobile_number;
                        if ($class !== '')         $csv['class']        = $class;
        
                        if ($class_id !== null) {
                            $csv['class_id']    = $class_id;
                            $csv['category_id'] = $class_id;
                        }
        
                        if ($school_code !== '') {
                            $school = $this->db
                                ->get_where('school_new', ['school_code' => $school_code])
                                ->row();
                            if (!empty($school)) {
                                $csv['school_id'] = $school->id ?? '';
                            }
                        }
        
                        $status = 'Not Updated on MaRRS';
                        $logRow[8] = 'red';
        
                        
                
                        if (!empty($csv)) {
        
                            // ✅ Build PAY only from allowed + filled keys
                            $pay = array_intersect_key($csv, array_flip([
                                'student_name',
                                'stud_email',
                                'stud_phone',
                                'class',
                                'school_id',
                                'class_id',
                                'category_id'
                            ]));
        
                            $pay = array_filter($pay, function ($v) {
                                return $v !== '' && $v !== null;
                            });
                            
                            if (!empty($pay)) {
                                
                                $this->db->where('cin', $cin);
                                $this->db->update('cin_list', $pay);
        
                                if ($this->db->affected_rows() > 0) {
                                    $status = 'Updated on MaRRS';
                                    $logRow[8] = 'green';
                                    $logRow[9] = $pay;
                                } else {
                                    $logRow[8] = 'fuchsia';
                                    $status = 'MaRRS update failed / no changes';
                                }
                            }
        
                            
                        }
        
                        $logRow[6] = $status;
                        $csvResult_upolad_logArray[] = $logRow;
                        $i++;
                    }
        
                    fclose($handle);
                    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
                }
            }
            
        }






	    $this->load->view("cin_profile_update.php",$data);  
	}
    public function student_result_upload()
    {
       
        $id = $this->uri->segment(4);
        
        $data['competition_schedule'] = $competition_schedule      = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$id))->row();
    	    
       
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {  

    	     $data['period_id']            =  $search_period_id = $competition_schedule->period_id;
    
    	     $data['level_id']             =  $search_level_id = $competition_schedule->competition_level_id;
    
    	     $data['product_id']           =  $search_service_id = $competition_schedule->product_name;
    	     
    	     
             $period_id            =  $search_period_id = $competition_schedule->period_id;
    
    	     $level_id             =  $search_level_id = $competition_schedule->competition_level_id;
    
    	     $product_name           =  $search_service_id = $competition_schedule->product_name;
    	  
    	  
    	     $product_id      = $this->db->get_where('products',array('product_name'=>$competition_schedule->product_name))->row()->product_id;
    	    
            // 	  echo $product_name;die; 
    
    		 $csvResult_upolad_logArray = array();

		 

				$start_cell_row=1;/*skip first 2 heading rows */

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

    						$cin               =  addslashes($resultRow_from_csv[0]);
    						$status            =  addslashes($resultRow_from_csv[1]);
    						$grade            =  addslashes($resultRow_from_csv[2]);
                            $rank            =  addslashes($resultRow_from_csv[3]);
                            $marks            =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller            =  addslashes($resultRow_from_csv[6]);
                            
    
    					    $csv_result_array  =  
    					            array(
    					                'student_id'=>null,
                                        'clevel'=>$level_id,
                                        'product_name'=>$product_name ?? null,
                                        'period_id'=>$period_id ?? null,
                                        'grade'=>$grade ?? null,
                                        'rank'=>$rank ?? null,
                                        'performer'=>$performer ?? 'No',
                                        'speller'=>$speller ?? 'No',
                                        'status'=>$status ?? null,
                                        'cin'=>$cin,
                                        'chest_number'=>null,
                                        'marks'=>$marks ?? null,
                                        'product_id'=>$product_id ?? null,
                                        'competition_schedule_id'=>$competition_schedule->competition_schedule_id ?? null,
                                        'competition_date'=>$competition_schedule->competition_date ?? null,
                                        'venue'=>$competition_schedule->center_address ?? null,
                                        'show'=>null,
                                        'subject'=>null,
                                        'series'=>null,
                                        'type'=>null
									);



                                if($cin != 'CIN'){
        				// 			echo "<pre>";print_r($csv_result_array);exit;					   
        
        						    $csv_upload_status = $this->franchisemodel->save_csv_result($csv_result_array);
                                }
    
    						    array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    					    }/*End if*/

					 
					    }
    
    				    $i=$i+1;	
    
    			   }
    			   while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
    
    			    
    
        			   /*............ End Do while ................*/
        
        			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
        
        			   /*unset($_FILES);*/
        
        			   $this->notifications->notify('Result Uploaded Successfully','success');
        
        		   }/* End if */
    
    
    
                }
                
                
                /* End of if */
    
            // 		 $service_id=1;		 
            
            	 
            
            // 	$params = array("service_id"=>$service_id);	
            
            // 	$data['services'] = $this->servicemodel->listservice($params);
            
            // 	$data['level']    = $this->competitionlevelmodel->listcompetitionlevel($params);	
            
            // 	$data['period']   = $this->periodmodel->listperiod();
    
    	$this->load->view("upload_result_file.php",$data);

    }/*END of function import()*/

    
    
    
}