<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class competitionshedule extends CI_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        }
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('competitionsheduleModel');
        $this->load->model('schoolModel');
        //$this->load->model('competitioncenterModel');
        $this->load->model('franchiseModel');
        //$this->load->model('competitionlevelModel');
        //$this->load->model('Categorymodel');
    }
    
    
    // public function updateCenterStatus___()
    // {
       
    //     $all_post_data = $this->input->post();
        
    //     $center_id=$all_post_data['center_id'];
    //     $action =$all_post_data['action'];
        
    //     $response = [
    //         'status' => 'success',
    //         'message' => 'Post data received successfully!',
    //         'post_data' => $all_post_data,
    //         'center_id'=>$center_id,
    //         'action'=>$action
    //     ];
    
    //     $this->output
    //         ->set_content_type('application/json')
    //         ->set_output(json_encode($response));
    // }


    public function cmsch()
    {
        $data['result']=[];
        
        if(isset($_POST['submit']))
        {
            
            // print_r($_POST);die;
            foreach($_POST['schools'] as $school){
                
                // print_r($school);die;
                
                 
                
                foreach($_POST['products'] as $product){
                    
                    $res = $this->db->select('revenue_setting.*,competition_product_state.franchise_id')
                        ->from('competition_product_state')
                        ->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id')
                        ->where([
                            'revenue_setting.period_id' => $_POST['period'],
                            'competition_product_state.franchise_id' => $_POST['franchise_id'],
                            'revenue_setting.clevel' => 1,
                            'revenue_setting.product_name'=>$product
                        ])
                        ->where("competition_product_state.revenue_setting_id !=", "")
                        ->get()
                        ->row();
                    
                    // echo '<pre>'; 
                     print_r($res);
                    
                    $rpres = $this->db->get_where('products',array('product_name'=>$product))->row();
                     
                        $ar =   array(
                            'school_id' => $school,
                            'product_name' => $product,
                            'period_id' => $_POST['period'],
                            'school_amount' => $_POST['school_amount'],
                            'amount' => $_POST['amount'],
                            'franchise_id' => $_POST['franchise_id'],
                            'franchise_per' => $_POST['com_per'],
                            'start_date' => $_POST['start_date'],
                            'end_date' => $_POST['end_date'],
                            'revenue_setting_id' => $res->id,
                            'comp_date' => $_POST['comp_date'],
                            'level_id' => 1,
                            'product_id'=> $rpres->product_id,
                            'manageper' => $_POST['manageper'],
                            'com_peravian' => $_POST['com_peravian'],
                            'associate_per' => $_POST['associate_per'],
                            'crm_per' => $_POST['crm_per'],
                            'free_mat_royalty'=>$_POST['free_mat_royalty']
                        );
                    // echo '<pre>';    
                    // print_R($ar);die;
                    
                    
                        $check = array(
                            'school_id' => $school,
                            'product_name' => $product,
                            'period_id' => $_POST['period'],
                            'product_id' => $rpres->product_id,
                        );
                            
                    $res = $this->db->get_where('product_to_school', $check)->row();
                    if(empty($res)){
                        $this->db->insert('product_to_school', $ar);
                        $data['message'] = 'Products assigned to school successfully ...'; 
                    }else{
                        $data['message'] = 'Products already assigned to school !!! '; 
                    }
                    
                }
            }
           
           
            
            
        }
        
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
        
        if(isset($data['result']['state_id']))
        {
            $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
        }
        
    
        if(isset($data['result']['country']))
        {
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
            
            
        if(isset($data['result']['franchise_id']))
        {
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        
        $this->load->view("cmsch1",$data);
    }
    
    public function cmsch2()
    {
        $data['result']=[];
        
        if(isset($_POST['submit']))
        {
            
            if($_POST['clevel'] != 1 ){
            
                    
                $res = $this->db->select('revenue_setting.*,competition_product_state.franchise_id,competition_product_state.id as comp_id,competition_product_state.close_date')
                    ->from('competition_product_state')
                    ->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id')
                    ->where([
                        'revenue_setting.period_id' => $_POST['period'],
                        'competition_product_state.franchise_id' => $_POST['franchise_id'],
                        'revenue_setting.clevel' =>  $_POST['clevel'],
                        'revenue_setting.product_name'=>$_POST['product_name']
                    ])
                    ->where('competition_product_state.revenue_setting_id',$_POST['revenue_setting_id'])
                    ->get()
                    ->row();
                
                // echo '<pre>'; 
                // print_r($res);die;
                
                $rpr=$this->db->get_where('period',array('period_id'=>$_POST['period']))->row();
                
                
                $rpre=$this->db->get_where('products',array('product_name'=>$_POST['product_name']))->row();
                        
                $rpres=$this->db->get_where('school_new',array('id'=>$_POST['school']))->row();
                 
                 
                 
                $ar=array(
                        'school_id'         => $_POST['school'],
                        'product_name'      => $_POST['product_name'],
                        'period_id'         => $_POST['period'],
                        'school_amount'     => $_POST['school_amount'],
                        'amount'            => $res->product_price,
                        'franchise_id'      => $res->franchise_id,
                        'franchise_per'     => $res->com_per ?? NULL,
                        'start_date'        => $_POST['start_date'],
                        'end_date'          => $_POST['end_date'],
                        'revenue_setting_id'=> $_POST['revenue_setting_id'],
                        'comp_date'         => $res->close_date,
                        'level_id'          => $_POST['clevel'],
                        'product_id'        => $rpre->product_id ,
                        'school_code'	    => $rpres->school_code.'-'.$rpr->initials.'-'.$rpre->in13.'-'.$_POST['clevel'],
                        'pricecode_id'	    => NULL,
                        'subject'	        => NULL,
                        'series'	        => NULL,
                        'varient'	        => NULL,
                        'associate_per'	    => $res->associate_per ?? NULL,
                        'free_mat_royalty'	=> $res->study_material_free_royalty ?? NULL,
                        'crm_fix'	        => $res->crm_fix ?? NULL,
                        'manage_per'	    => $res->manageper ?? NULL,
                        'com_peravian'	    => $res->com_peravian ?? NULL,
                        'comp_id'           => $res->comp_id
                    );
                    
                // echo '<pre>';    
                // print_R($ar);die;
                
                
                $check=array(
                        'school_id'    => $_POST['school'],
                        'product_name' => $_POST['product_name'],
                        'period_id'    => $_POST['period'],
                        'product_id'   => $rpre->product_id,
                        'franchise_id' => $res->franchise_id,
                        'level_id'          => $_POST['clevel']
                    );
                        
                $res=$this->db->get_where('product_to_school_mid',$check)->row();
                if(empty($res)){
                
                    $this->db->insert('product_to_school_mid',$ar);
                    $data['message']='Products assigned to school successfully ...';
                    
                }else{
                    $data['message']='Products already assigned to school !!! '; 
                }
            }else{
                $data['message']='Competition level should not be school level. !!! '; 
            }            
            
        }
        
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        // $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
        if($_POST['product_name']){
	        $this->db->where('product_name', $_POST['product_name']);
	    }
	    $results = $this->db->get('competition_level_byproduct')->result_array();
	   // $this->db->get_where('competition_level_byproduct')->result_array();
        $data['levelload']   = $results;
        
        if(isset($data['result']['state_id']))
        {
            $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
        }
        
    
        if(isset($data['result']['country']))
        {
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
            
        if(isset($data['result']['country']))
        {
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }    
            
        if(isset($data['result']['franchise_id']))
        {
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        
        $this->load->view("cmsch2",$data);
    }
    
    public function search_school()
    {
        //echo 'search_school';die;
        	if (isset($_POST['submit']))
			{   
			 //   print_r($_POST);die;
			    
			    if($_POST['school'] != 'All' or !empty($_POST['school'])){
			        
			        $this->db->select('*');
                    $this->db->from('product_to_school');
                    $this->db->join('school_new','school_new.id=product_to_school.school_id');
                    $this->db->where('school_id',$_POST['school']);
                    $this->db->where('product_to_school.period_id !=','');
                    $this->db->where('product_to_school.school_amount !=','');
                    // $this->db->group_by('product_to_school.product_name');
                    $this->db->group_by('school_new.id');
                    $this->db->order_by('product_to_school.id','DESC');
                    $query=$this->db->get();
			     //   echo $this->db->last_query();
			        $data['schoolList']=$query->result();
			        
			     //   $data['schoolList']=$this->db->get_where('school_new', array('id' => $_POST['school']))->row_array();
			        $data['result']=$_POST;
			        
			    }
			    else{
			       $data['message']='Select One School ...';
			    }
			    $data['result']=$_POST;
			    
		    }
          
          
        if(isset($_POST['upload'])){
             
	       // print_r($_POST);
	       // print_r($_FILES);die;
	        
	        $config['upload_path'] = '../images/school/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; 
            $config['encrypt_name'] = TRUE; 

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file1')) {
                
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                
                $data = $this->upload->data();
                $file_name = $data['file_name'];

                
                $this->db->set('profile', $file_name);
                $this->db->where('id', $_POST['upload']);
                $this->db->update('school_new');
            }
            $data['message']='School Logo added successfully ...';
            $data['result']=$_POST;
	    }
	     
          
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
        
        
        $this->load->view('search_school.php',$data);
    }
    
    
    public function search_school1()
    {
        //echo 'search_school';die;
        	if (isset($_POST['submit']))
			{   
			 //   print_r($_POST);die;
			    
			    if($_POST['school'] != 'All' or !empty($_POST['school'])){
			        
			        $this->db->select('product_to_school_mid.*,product_to_school_mid.school_code as access_code,school_new.*');
                    $this->db->from('product_to_school_mid');
                    $this->db->join('school_new','school_new.id=product_to_school_mid.school_id');
                    $this->db->where('school_id',$_POST['school']);
                    $this->db->where('product_to_school_mid.period_id !=','');
                    $this->db->where('product_to_school_mid.school_amount !=','');
                    // $this->db->group_by('product_to_school.product_name');
                    $this->db->group_by('school_new.id');
                    $this->db->order_by('product_to_school_mid.id','DESC');
                    $query=$this->db->get();
			     //   echo $this->db->last_query();
			        $data['schoolList']=$query->result();
			        
			     //   $data['schoolList']=$this->db->get_where('school_new', array('id' => $_POST['school']))->row_array();
			        $data['result']=$_POST;
			        
			    }
			    else{
			       $data['message']='Select One School ...';
			    }
			    $data['result']=$_POST;
			    
		    }
          
          
        if(isset($_POST['upload'])){
             
	       // print_r($_POST);
	       // print_r($_FILES);die;
	        
	        $config['upload_path'] = '../images/school/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; 
            $config['encrypt_name'] = TRUE; 

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file1')) {
                
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                
                $data = $this->upload->data();
                $file_name = $data['file_name'];

                
                $this->db->set('profile', $file_name);
                $this->db->where('id', $_POST['upload']);
                $this->db->update('school_new');
            }
            $data['message']='School Logo added successfully ...';
            $data['result']=$_POST;
	    }
	     
          
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
        
        
        $this->load->view('search_school1.php',$data);
    }
    
    
    
    public function updateCenterStatus()
    {
        // print_r($_POST);die;
        $all_post_data = $this->input->post();
        
        $center_id=$all_post_data['center_id'];
        $action =$all_post_data['action'];
        
        
        if (empty($center_id) || empty($action)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Request','post'=>$all_post_data]);
            return;
        }
        
        // Define which column to update
        $updateData = [];
    
        if (strpos($action, 'close_') === 0) {
            $column = str_replace('close_', 'close_', $action);
            $updateData[$column] = 1;
        } elseif (strpos($action, 'open_') === 0) {
            $column = str_replace('open_', 'close_', $action);
            $updateData[$column] = '';
        }
        
    // print_r($updateData);die;
    
        if (!empty($updateData)) {
            $this->db->where('center_id', $center_id);
            $this->db->update('exam_schedule', $updateData);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Action']);
        }
    }
    
    
    public function index() 
    { 
        if (isset($_POST['Search'])) {
            $link = SITE_URL . "competitionshedule/index/";
            if ($this->input->post('fr_id')) {
                $link .= 'fr_id/' . $this->input->post('fr_id') . "/";
            }
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
            if (isset($uri['fr_id'])) {
                $fr_id = $uri['fr_id'];
            } else {
                $fr_id = '';
            }
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
           $data['list'] =$this->competitionsheduleModel->schedule_lists();
        }
        $data['franchise']  = $this->db->get_where('franchise')->result_array();
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_levels')->result_array();
       // $data['fr_id']                = $fr_id;
        //$data['period_id']            = $period_id;
        //$data['competition_level_id'] = $competition_level_id;
        $this->load->view("competitionsheduleList.php", $data); 
    }
    
    public function cin_enquiries()
    {
        
        if(isset($_POST['submit'])){
            $this->db->select('*');
            $this->db->from('enquiry');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type');
            $this->db->where('enquiry.state_id', $_POST['state_id']);
            $this->db->where('enquiry.status', $_POST['status']);
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
            $this->db->select('*');
            $this->db->from('enquiry');
            $this->db->join('enquiry_type', 'enquiry_type.enquiry_id = enquiry.enquiry_type');
            $this->db->join('cin_list', 'cin_list.cin = enquiry.cin');
            // $this->db->where('enquiry.state_id', $state_id);
            $this->db->where('enquiry.status', 'Open');
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
            $this->db->update('enquiry',array('status'=>$_POST['status']));
            $data['message']='Status Updated ...';
        }
        $this->db->select('*');
        $this->db->from('states');
        $this->db->where('country_id','105');
        $query=$this->db->get();
        $data['stateload']=$query->result_array();
        
        
        $this->db->select('product_name');
        $this->db->from('products');
        $this->db->where('status','Active');
        $query=$this->db->get();
        $data['productload']=$query->result_array();
        $this->load->view("cin_enquiries.php", $data);
        
    }
    
    public function get_cindata()
    {
            $cin = $this->input->post('cin');
            if (empty($cin)) {
                echo json_encode(['error' => 'Invalid CIN provided']);
                return;
            }
        
            // Fetch Profile Data
            $profileQuery = $this->db->select('
                cin_list.student_name,
                cin_list.class,
                school_new.school_name
            ')
            ->from('cin_list')
            ->join('school_new', 'school_new.id = cin_list.school_id', 'left')
            ->where('cin_list.cin', $cin)
            ->get();
        
            $profileData = $profileQuery->row_array();
        
            if (!$profileData) {
                echo json_encode(['error' => 'No profile data found for the provided CIN']);
                return;
            }
        
            // Fetch Result Data
            $resultsQuery = $this->db->select('
                cin_result.status,
                cin_result.marks,
                competition_level_byproduct.level_name,
                competition_level_byproduct.product_name
            ')
            ->from('cin_result')
            ->join('competition_level_byproduct', 'competition_level_byproduct.clevel = cin_result.clevel', 'left')
            ->where('cin', $cin)
            ->group_by('cin_result.clevel')
            ->order_by('cin_result.id', 'DESC')
            ->get();
        
            $resultsData = $resultsQuery->result_array();
        
            // Prepare Response
            $response = [
                'profile' => $profileData,
                'results' => $resultsData
            ];
        
            echo json_encode($response);
        }
            
    
    public function schedule_school_check()
    {
    
        if(isset($_POST['Search'])){
           // print_r($_POST);die;
            
             $data['list']=$this->competitionsheduleModel->list_schedule_product($_POST);
            $data['result']=$_POST;
            // print_r($data['list']);die;
        }
    
         $data['franchise']  = $this->db->get_where('franchise')->result_array();
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
       // $data['fr_id']                = $fr_id;
        //$data['period_id']            = $period_id;
        //$data['competition_level_id'] = $competition_level_id;
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        // echo 'ok';die;
        
        
        $this->load->view("competitionsheduleList.php", $data);
        
    }
    
    // public function payments()
    // {
    //     $comp_id = $this->uri->segment(4);
    //     $this->db->select('*');
    //     $this->db->from('payment_split');
    //     $this->db->where('comp_id', $comp_id);
    //     $query = $this->db->get();
    
    //     $data['payments'] = $query->result_array();
    //     $data['comp_id'] = $comp_id; // Pass comp_id to the view
    //     $this->load->view("payments.php", $data);
    // }
    
    
    public function delete_cin()
    {
        
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            
            $this->db->select('*');
            $this->db->from('cin_list');
            $this->db->where('cin',$_POST['cin']);
            $query=$this->db->get();
            $data['student']=$query->result();
            $data['result']=$_POST;
        }
        
        if(isset($_POST['delete'])){
            // print_r($_POST);die;
            $this->db->where('id',$_POST['delete']);
            $this->db->delete('cin_list');
            
        }
        
        $this->load->view("delete_cin.php", $data);
    }
    
    public function payments_()
    {
        if (isset($_POST['Export'])) {
            print_r($_POST); // Debug: Check if POST data is received
            die(); // Exit to verify form submission
        }
    
        // Normal view loading logic
        $comp_id = $this->uri->segment(4);
        $this->db->select('*');
        $this->db->from('payment_split');
        $this->db->where('comp_id', $comp_id);
        $this->db->where('status','1');
        $query = $this->db->get();
    
        $data['payments'] = $query->result_array();
        $data['comp_id'] = $comp_id;
        $this->load->view("payments.php", $data);
    }
    
    
    public function payments()
    {
        $comp_id = $this->uri->segment(4);
    
        if(isset($_POST['Export'])){
            
            // print_r($_POST);die;
            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->where('comp_id', $comp_id);
            $this->db->where('status','1');
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                // Prepare data for CSV
                $headers = [
                    'Sr. No','Payment ID' ,'Date', 'CIN', 'Total Pay Amount', 'Franchise Amount',
                    'Franchise GST', 'GST Amount', 'Management Amount', 'Razorpay Cut',
                    'MaRRs Left', 'Aviansys Amount', 'Aviansys GST'
                ];
    
                $payments = $query->result_array();
                $data = [];
                $sr_no = 1;
    
                foreach ($payments as $payment) {
                    $data[] = [
                        $sr_no++, // Sr. No
                        $payment['payment_id'],
                        $payment['date_of_payment'], // Date
                        $payment['cin'], // CIN
                        $payment['total_amount'], // Total Pay Amount
                        $payment['franchise_amount'], // Franchise Amount
                        $payment['franchise_gst'], // Franchise GST
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
        $this->db->from('payment_split');
        $this->db->where('comp_id', $comp_id);
        $this->db->where('status','1');
        $query = $this->db->get();
    
        $data['payments'] = $query->result_array();
        $data['comp_id'] = $comp_id; // Pass comp_id to the view
        $this->load->view("payments.php", $data);
    }

    
    public function percentage()
    {
        $comp_id= $this->uri->segment(4);
        
        if(isset($_POST['submit'])){
            $ar=array(
                'franchise_split'=>$_POST['choice'],
                'com_per'=>$_POST['com_per'],
                'com_peravian'=>$_POST['com_peravian'],
                'manageper'=>$_POST['manageper']
            );
            // print_r($ar);die;
            $this->db->where('id',$comp_id);
            $this->db->update('competition_product_state',$ar);
            $data['message']='Competition Updated Successfully ...';
        }
        
        
        $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->where('id',$comp_id);
        $query=$this->db->get();
        $data['payments']=$query->row();
        
        $this->load->view("percentage.php", $data);
    }
    
    
    // public function profile_extract()
    // {
        
    //     if(isset($_POST['submit'])){
    //     $cin = $this->input->post('search_cin');
    //         $data['list']=$this->competitionsheduleModel->search_student_profile($_POST);
            
    //     }
    
    
        
    //     // $data['franchise']  = $this->db->get_where('franchise')->result_array();
    //     $data['period']     = $this->db->get_where('period')->result_array();
    //     //$data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
    //     $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
    //     $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
    //     $data['school']    = $this->db->get_where('school_new')->result_array();
    //     $data['area'] = $this->db->get_where('areas')->result_array();
    //     $this->load->view("profile_extract.php", $data);
    // }
    
    
    public function profile_extract()
    {
        $data['list'] = array();
    
        if(isset($_POST['submit']))
        {
            // print_r($_POST);die;
            
            $data['list'] = $this->competitionsheduleModel->search_student_profile($_POST);
            $data['result'] = $_POST;
        }
        
        if ($this->input->post('deletecin')) {

            $cin = $this->input->post('deletecin');
    
            // Debug if required
            // echo '<pre>';
            // print_r($this->input->post());
            // die;
    
            $this->db->where('cin', $cin);
            $this->db->delete('cin_list');
    
            $this->db->where('cin', $cin);
            $this->db->delete('cin_result');
    
            $this->db->where('cin', $cin);
            $this->db->delete('cin_uploade');
    
            $data['result'] = $this->input->post();
            $data['message'] = 'CIN Deleted Successfully.';
            $data['list'] = $this->competitionsheduleModel->search_student_profile($_POST);
        }
        
        
        
        if ($this->input->post('export_profile')) {
    
            $search    = $this->input->post('search_cin');
            $period_id = $this->input->post('period_id');
            $product   = $this->input->post('product');
    
            $list = $this->competitionsheduleModel->search_student_profile([
                'search_cin' => $search,
                'period_id'  => $period_id,
                'product'    => $product
            ]);
    
            $filename = "cin_export_" . date('Y-m-d_H-i-s') . ".csv";
    
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename={$filename}");
            header("Pragma: no-cache");
            header("Expires: 0");
    
            $output = fopen("php://output", "w");
    
            fputcsv($output, [
                'CIN',
                'Student Name',
                'Father Name',
                'Mother Name',
                'Class',
                'Status',
                'Rank',
                'Marks',
                'Competition Date',
                'School Name'
            ]);
    
            foreach ($list as $row) {
                fputcsv($output, [
                    $row['cin'],
                    $row['student_name'],
                    $row['father_name'],
                    $row['mother_name'],
                    $row['class'],
                    $row['status'],
                    $row['rank'],
                    $row['marks'],
                    $row['competition_date'],
                    $row['school_name']
                ]);
            }
    
            fclose($output);
            exit;
        }
    
        $data['period']  = $this->db->get_where('period')->result_array();
        $data['product'] = $this->db->get_where('products', array('status'=>'Active'))->result_array();
        $data['state']   = $this->db->get_where('states', array('country_id'=>'105'))->result_array();
        $data['school']  = $this->db->get_where('school_new')->result_array();
        $data['area']    = $this->db->get_where('areas')->result_array();
    
        $this->load->view("profile_extract.php", $data);
    }

    
    public function add() 
    {
        $data['competion_schedule_id'] = '';
        if (isset($_POST['submit'])) {
			
			//print_r($_POST['product_name');die;
			$pro= $this->input->post('product_name');
			
			$sql="select product_name FROM products where product_id = {$pro};";
			//print_r($sql);die;
            $query = $this->db->query($sql);
            $list =$query->row_array();
			//print_r($list['product_name']);die;
			
			
		
             $category_id = $this->input->post('category_id');
			 $sql="select class_name FROM class where class_id = {$category_id};";
			//print_r($sql);die;
            $query = $this->db->query($sql);
            $lis =$query->row_array();
			//print_r($list['product_name']);die;
			 
			 
                    $data         = array(
                        'country_id'=>$this->input->post('country'),
                        'period_id' => $this->input->post('period_id'),
                        'state_id' => $this->input->post('state_id'),
                        'product_id' => $this->input->post('product_name'),
                        //'competition_center_id' => $this->input->post('competition_center_id'),
                        'competition_level_id' => $this->input->post('competition_level_id'),
                        'competition_caption' => $this->input->post('competition_caption'),
                        'center_address' => $this->input->post('center_address'),
                        'franchise_id' => $this->input->post('franchise_id'),
                        'competition_date'=>$this->input->post('competition_date'),
                        'product_name'=>$list['product_name'],
                        'category_id'=>$this->input->post('category_id'),
                        'class'=>$lis['class_name']
                    );
            
            
            //print_r($data);die;
            $this->validation->set_data($data);
            $this->validation->set_rules('period_id', 'period', 'required');
            $this->validation->set_rules('competition_level_id', 'level', 'required');
            //$this->validation->set_rules('category_id', 'category', 'required');
            //$this->validation->set_rules('competition_date', 'competition date', 'required');
            
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else { 
                
              //  echo 'ok';
           // print_r($data);die;
                
                
            	$this->notifications->notify('competition Shedule added successfully', 'success');
                $competion_schedule_id = $this->competitionsheduleModel->inset_sch($data);  
              
                redirect('manage/competitionshedule/add/');
            }
            $data['result'] = $_POST;   
        }
        
        $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        
        $this->load->view("competitionsheduleadd.php", $data); 
    }
    
	public function delete() 
	{
        $uri                   = $this->uri->segment(4);
        $competion_schedule_id = $uri;
        // echo $competion_schedule_id;die;
		$this->db->where('competition_schedule_id',$competion_schedule_id);
		$this->db->delete('competition_schedule');
		redirect('manage/competitionshedule/schedule_list');
	}
	
    public function edit() 
    {
        $uri                   = $this->uri->uri_to_assoc(4);
        $competion_schedule_id = $uri['id'];
       // echo $competion_schedule_id;die;
        
        
        if (isset($_POST['submit'])) {
            $scd          = $this->input->post('competition_date');
            $timestamp    = strtotime($scd);
            $cdate        = date('Y-m-d', $timestamp);
            $franchise_id = 0;
            
                    $data         = array(
                        'country_id'=>$this->input->post('country'),
                        'period_id' => $this->input->post('period_id'),
                        'state_id' => $this->input->post('state_id'),
                        'product_id' => $this->input->post('product_name'),
                        //'competition_center_id' => $this->input->post('competition_center_id'),
                        'competition_level_id' => $this->input->post('competition_level_id'),
                        'competition_caption' => $this->input->post('competition_caption'),
                        'center_address' => $this->input->post('center_address'),
                        'franchise_id' => $this->input->post('franchise_id'),
                        'competition_date'=>$this->input->post('competition_date'),
                        
                    );
            
            $this->validation->set_data($data);
            $this->validation->set_rules('period_id', 'period', 'required');
            $this->validation->set_rules('competition_level_id', 'level', 'required');
            //$this->validation->set_rules('category_id', 'category', 'required');
            //$this->validation->set_rules('competition_date', 'competition date', 'required');
            
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } else {
                
                 // print_r($data);die;
                
            	            	$this->notifications->notify('competition Shedule updated successfully', 'success');
            	            	$this->db->where('competition_schedule_id', $competion_schedule_id);
            	            	$insert_query  = $this->db->update('competition_schedule', $data);
            	            	
            	            	 
                // $this->db->update('title', $data['title']);
                // $this->competitionsheduleModel->insert($data, $franchise_id, $competion_schedule_id);
                redirect('manage/competitionshedule/schedule_list', 'refresh'); 
            }
            $data['result'] = $_POST;
        }
        
        $data['result']=$this->db->get_where('competition_schedule',array('competition_schedule_id'=>$competion_schedule_id))->row_array(); 
        
        
       $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['franchise']  = $this->db->get_where('franchise')->result_array();
        $this->load->view("schedule_edit.php", $data);
    }
    
    public function assignschools() 
    {
        $uri                   = $this->uri->segment(5); 
        $competion_schedule_id = $uri;
		$res = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$uri))->row();
	//	print_R($res);die;
		$fr_id = $res->franchise_id;
 	//	echo $fr_id;die;
		
		if(isset($_POST['submit'])){
		 //print_r($_POST['schoolID']);exit;
		 foreach($_POST['schoolID'] as $value){
			 
			 $array = array(
                'competition_schedule_id' =>  $competion_schedule_id,
                'school_id'     => $value,
                'status' =>  'Active'
                 );
                // print_r($array);die;
				 $this->db->insert('schedule_to_school',$array );
				
		     }
		  redirect('manage/competitionshedule/schedule_list');    
		}
		
		
		$data['list']= $this->competitionsheduleModel->schools_not_assign($fr_id,$competion_schedule_id);
	//	print_r($data['list']);die;
		
// 		if(isset($_POST['Search'])){
// 			$params = array(
//                 'franchise_id' =>  $this->input->post('fr_id'),
//                 'state_id'     =>  $this->input->post('stateID'),
//                 'country_id' =>  $this->input->post('country_id')
//                  );
// 		$data['franchise_id']=$this->input->post('fr_id');
// 		$data['state_id']=$this->input->post('stateID');
//         $data['list']= $this->schoolModel->listschool($params); 
// 		//print_r($data['list']);exit;	
// 		}
        // $params = array(
                // 'franchise_id' =>  $fr_id
               // 'stateID' => $stateID,
                //'school_name' => $school_name
            // );
			//print_r($data['list']);exit;
			
        //$data['list']= $this->schoolModel->listschool($params);   
		   
		
	      $data['countries']   = $this->db->get_where('countries')->result_array();
          $data['stateatload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
          $data['franchise'] = $this->db->get_where('franchise')->result_array();
          
          
          
          $this->load->view("competitionsheduleschool.php", $data);    
    }
    
    public function schedule_list()
    {
        
        if(isset($_POST['submit'])){
            //print_R($_POST);die;
            
            $data=array(
                    'period_id'=>$this->input->post('period_id'),
                    'product_name'=>$this->input->post('product_name'),
                    'country'=>$this->input->post('country'),
                    'state_id'=>$this->input->post('state_id'),
                    'franchise_id'=>$this->input->post('franchise_id') ?? NULL,
                    // 'competition_level_id'=> $this->input->post('competition_level_id')
                    'competition_level_id' => 1,
                    'search' => $_POST['search']
                );
                
                $data['list'] = $this->competitionsheduleModel->search_schedule($data);  
                $data['result']=$_POST;
                
        }else{
            
            $period = $this->db->get_where('period',['status'=>'Active'])->row();
       
            
            $query = $this->db
                ->select('period.period_name, competition_schedule.*, school_new.school_name, competition_level_byproduct.level_name, franchise.franchise_code')
                ->from('competition_schedule')
                ->join('period', 'period.period_id = competition_schedule.period_id')
                ->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_schedule.competition_level_id AND competition_level_byproduct.product_id = competition_schedule.product_id')
                ->join('franchise', 'competition_schedule.franchise_id = franchise.franchise_id')
                ->join('school_new', 'school_new.id = competition_schedule.school_id', 'left')
                ->where('competition_schedule.period_id', $period->period_id)
                ->where('competition_schedule.competition_level_id',1)
                ->group_by('competition_schedule.competition_schedule_id')
                ->order_by('competition_schedule.competition_schedule_id', 'DESC')
                ->get();
                
            $data['list'] =$query->result_array();
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
        //print_R($data);die;
            
            
        $this->load->view("schedule_list.php", $data);    
    }
    
    public function updateCompetitionSchdule()
    {
        $competition_schedule_id = $this->input->post('competition_schedule_id');
        $competition_date = $this->input->post('competition_date');
    
        if(empty($competition_schedule_id) || empty($competition_date))
        {
            echo json_encode([
                'status' => false,
                'message' => 'School ID and Date required'
            ]);
            return;
        }
    
        $data = [
            'competition_date' => $competition_date,
            'updated_at'       => date('Y-m-d H:i:s')
        ];
    
        $this->db->where('competition_schedule_id', $competition_schedule_id);
        $this->db->update('competition_schedule', $data);
    
        if($this->db->affected_rows() > 0)
        {
            echo json_encode([
                'status' => true,
                'message' => 'Competition date updated successfully'
            ]);
        }
        else
        {
            echo json_encode([
                'status' => false,
                'message' => 'No changes found'
            ]);
        }
    }
        
    public function cin_genration()
    {
        if(isset($_POST['submit'])) {
	      
	    $product = $this->input->post('product');
		$franchise_id = $this->input->post('franchise_id');
		$school = $this->input->post('school');
		//print_r($_POST);exit; 
		$level = $this->input->post('1');
		$period = $this->input->post('period');
		$stat = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
		$state_id = $this->input->post('state_id');
		$country_id = $this->input->post('country');
		$area_code = $this->input->post('area');
		
		$csvResult_upolad_logArray = array();
		$start_cell_row=2;/*skip first 2 heading rows */
		$i=0;
		if(isset($_POST['submit'])) {
		    
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
					{ /*echo "<br>"; echo $i ."-". $resultRow_from_csv[0];*/
					   if($resultRow_from_csv[0]) 
					   { 
						  //$period_id               =  addslashes($resultRow_from_csv[0]);
						  ////$school_id            =  addslashes($resultRow_from_csv[1]);
						  //$country_id            =  addslashes($resultRow_from_csv[1]);
						  //$state_id            =  addslashes($resultRow_from_csv[2]);
						  $class_id            =  addslashes($resultRow_from_csv[0]);
						  //$category_id            =  addslashes($resultRow_from_csv[1]);
						  $stud_name            =  addslashes($resultRow_from_csv[1]);
						  $gender            =  addslashes($resultRow_from_csv[2]);
						  $father_name            =  addslashes($resultRow_from_csv[3]);
						  $mother_name            =  addslashes($resultRow_from_csv[4]);
						  //$communication_address  =  addslashes($resultRow_from_csv[6]);
						  //$communication_address1  =  addslashes($resultRow_from_csv[7]);
						  $pincode  =  addslashes($resultRow_from_csv[5]);
						  $email  =  addslashes($resultRow_from_csv[6]);
						  $mobile_number  =  addslashes($resultRow_from_csv[7]);  
						  
						  
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
					
						  
						  
						  $csv_result_array  =  array(   'period_id'  => $period, 
														  'school_id'  => $school,
														  'country_id' =>  $country_id,
														  'state_id'   => $state_id,
														  'class_id'   =>  $class_id,
														  'class'      =>$class,
														  'category_id' =>  $class_id,
														  'stud_name'  =>  $stud_name,
														  'gender'        => $gender  ,
														  'father_name'   => $father_name,
														  'mother_name'   =>  $mother_name,
														  //'communication_address'   =>  $communication_address ,
														  //'communication_address1'  =>  	$communication_address1,
														  'pincode' => $pincode,
														  'email'      => $email,
														  'mobile_number'  => $mobile_number,
														  //'clevel'        =>$level,
														  'area_code'     =>$area_code,
														  'franchise_id' => $franchise_id);
														 
						  //print_r($csv_result_array);die; 
						   $csv_upload_status = $this->franchisemodel->generate_cin($csv_result_array,$product); 
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
				// 		$this->notifications->notify('CIN Generated Successfully','success');redirect('manage/franchise/cin_list');	
					 
				  }    /*END OF TYPE CHECKING*/
				  else
					{
							$this->notifications->notify('Not a csv file ','error');
					}/*END OF ELSE TYPE CHECKING*/
					   
				  
				  
					  
			   }/* End if */
				}
        }  
		$this->load->view("cin_genration.php",$data);  
    }
    
    
  public function offline_cin_genration()
{
    $this->load->model('franchisemodel');
    $competition_schedule_id = $this->uri->segment(4);

    $competition = $this->db->get_where('competition_schedule', ['competition_schedule_id' => $competition_schedule_id])->row();

    if (!$competition) {
        $this->session->set_flashdata('alert_error', 'Invalid competition schedule');
        redirect('manage/competitionshedule/cin_list'); // must be a route WITHOUT segment(4)
        return;
    }

    $product      = $competition->product_name;
    $franchise_id = $competition->franchise_id;
    $period       = $competition->period_id;

    $product_to_school = $this->db->select('*')
        ->from('product_to_school')
        ->join('school_new', 'school_new.id = product_to_school.school_id', 'left')
        ->where([
            'product_to_school.period_id'  => $competition->period_id,
            'product_to_school.level_id'   => $competition->competition_level_id,
            'product_to_school.product_id' => $competition->product_id,
        ])
        ->get()->row();

    $area_code = $product_to_school->area_code ?? null;
    $school_id = $product_to_school->school_id ?? null;

    $data = [
        'comschid'  => $competition_schedule_id,
        'school_id' => $school_id,
    ];

    if ($this->input->post('submit')) {

        $school = $this->input->post('school');

        if (empty($school)) {
            $this->session->set_flashdata('alert_error', 'School could not be determined for this upload');
            redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        if (empty($_FILES['csv']['name'])) {
            $this->session->set_flashdata('alert_error', 'Please choose a CSV file');
            redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        if ($_FILES['csv']['size'] <= 0) {
            $this->session->set_flashdata('alert_error', 'Uploaded file is empty');
            redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
        if ($ext !== 'csv') {
            $this->session->set_flashdata('alert_error', 'Not a csv file');
            redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
            return;
        }

        $handle = fopen($_FILES['csv']['tmp_name'], 'r');
        if ($handle === false) {
            $this->session->set_flashdata('alert_error', 'Unable to read uploaded file');
            redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
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
        $invalidClassCount = 0;
        $csvResult_upolad_logArray = [];

        while (($row = fgetcsv($handle, 1000)) !== false) {
            $rowNum++;
            if ($rowNum <= 1) continue; // skip header row
            if (empty($row[0])) continue;

            // Strip control chars / BOM / NBSP before trimming, to avoid silent
            // mismatches against the $classes array from Excel-exported CSVs.
            $class_id_raw = preg_replace('/[\x00-\x1F\xC2\xA0]/u', '', trim($row[0]));

            $class_id      = addslashes($class_id_raw);
            $stud_name     = addslashes(trim($row[1] ?? ''));
            $gender        = addslashes(trim($row[2] ?? ''));
            $father_name   = addslashes(trim($row[3] ?? ''));
            $mother_name   = addslashes(trim($row[4] ?? ''));
            $address_1     = addslashes(trim($row[5] ?? ''));
            $address_2     = addslashes(trim($row[6] ?? ''));
            $pincode       = addslashes(trim($row[7] ?? ''));
            $email         = addslashes(trim($row[8] ?? ''));
            $mobile_number = addslashes(trim($row[9] ?? ''));

            $class = $classes[(int) $class_id] ?? '';

            $csv_result_array = [
                'period_id'               => $period,
                'school_id'               => $school,
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
                'mobile_number'           => $mobile_number,
                'area_code'               => $area_code,
                'franchise_id'            => $franchise_id,
                'competition_schedule_id' => $competition_schedule_id,
            ];

            $result = $this->franchisemodel->offline_generate_cin($csv_result_array, $product);

            // offline_generate_cin() always returns a non-empty array (even on
            // failure), so we must check the status message at index 6 rather
            // than treat the array itself as truthy/falsy.
            $isSuccess = isset($result[6]) && stripos($result[6], 'Success') === 0;

            if ($isSuccess) {
                $successCount++;
            } else {
                $failCount++;
                if (isset($result[6]) && stripos($result[6], 'Class ID Error') !== false) {
                    $invalidClassCount++;
                }
            }

            $csvResult_upolad_logArray[] = [
                'row'       => $rowNum - 1,
                'cin'       => $result[0] ?? '',
                'stud_name' => $stud_name,
                'result'    => $isSuccess,
                'error'     => $isSuccess ? '' : ($result[6] ?? 'Unknown error'),
            ];
        }
        fclose($handle);

        $this->session->set_flashdata('csvResult_upoload_logArray', $csvResult_upolad_logArray);

        if ($successCount > 0) {
            $this->session->set_flashdata('alert_success', "CIN generated for $successCount record(s)");
        }

        if ($invalidClassCount > 0) {
            $this->session->set_flashdata('alert_error', "$invalidClassCount row(s) had an invalid class id for this product and were skipped.");
        } elseif ($successCount == 0) {
            $this->session->set_flashdata('alert_error', 'No CIN records were generated. Please check your CSV file.');
        }

        redirect('manage/competitionshedule/offline_cin_genration/' . $competition_schedule_id);
        return;
    }

    $data['csvResult_upoload_logArray'] = $this->session->flashdata('csvResult_upoload_logArray');

    $this->load->view("offline_cin_genration.php", $data);
}
    
    public function competition_activate()
    {
        //echo '9k';die;
        
        if(isset($_POST['submit'])){
        //print_r($_POST);die;
            $period_id = $this->input->post('period_id');
            $state_id = $this->input->post('state_id');
            $product_name = $this->input->post('product_name');
            $competition_level_id = $this->input->post('competition_level_id');
            $product_price = $this->input->post('product_price');
            $study_material_a = $this->input->post('study_material_a');
            $study_material_a_price = $this->input->post('study_material_a_price');
            $study_material_b = $this->input->post('study_material_b');
            $study_material_b_price = $this->input->post('study_material_b_price');
            $study_material_c = $this->input->post('study_material_c');
            $study_material_c_price = $this->input->post('study_material_c_price');
            $orientation_a = $this->input->post('orientation_a');
            $orientation_a_price = $this->input->post('orientation_a_price');
            $orientation_b = $this->input->post('orientation_b');
            $orientation_b_price = $this->input->post('orientation_b_price');
            $orientation_c = $this->input->post('orientation_c');
            $orientation_c_price = $this->input->post('orientation_c_price');
            $mock_test = $this->input->post('mock_test');
            $mock_test_price = $this->input->post('mock_test_price');
            $close_date = $this->input->post('close_date');
            
            $this->db->select('product_name');
            $this->db->from('products');
            $this->db->where('product_id',$product_name);
            $query = $this->db->get();
            $product= $query->row_array();

            $arr = array(
                'product_name' => $product['product_name'],
                'product_price' => $product_price,
                'mock_test' => $mock_test,
                'clevel' => $competition_level_id,
                'status' => 'Live',
                'state_id'=>$state_id,
                'period_id'=>$period_id
            );
            
            if ($study_material_a == 'on') {
                $arr['study_material_a'] = 'study_material_a';
            }
            if ($study_material_b == 'on') {
                $arr['study_material_b'] = 'study_material_b';
            }
            if ($study_material_c == 'on') {
                $arr['study_material_c'] = 'study_material_c';
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
            if ($mock_test == 'on') {
                $arr['mock_test'] = 'mock_test';
            }
            
            $arr['study_material_a_price'] = $study_material_a_price;
            $arr['study_material_b_price'] = $study_material_b_price;
            $arr['study_material_c_price'] = $study_material_c_price;
            $arr['orientation_a_price'] = $orientation_a_price;
            $arr['orientation_b_price'] = $orientation_b_price;
            $arr['orientation_c_price'] = $orientation_c_price;
            $arr['mock_test_price'] = $mock_test_price;
            

            $combo1_material_a = $this->input->post('combo1_material_a');
            $combo1_material_b = $this->input->post('combo1_material_b');
            $combo1_material_c = $this->input->post('combo1_material_c');
            $combo1_orientation_a = $this->input->post('combo1_orientation_a');
            $combo1_orientation_b = $this->input->post('combo1_orientation_b');
            $combo1_orientation_c = $this->input->post('combo1_orientation_c');
            $combo1_mocktest = $this->input->post('combo1_mocktest');
            $combo_1_price = $this->input->post('combo_1_price');
            
            
            $combo2_material_a = $this->input->post('combo2_material_a');
            $combo2_material_b = $this->input->post('combo2_material_b');
            $combo2_material_c = $this->input->post('combo2_material_c');
            $combo2_orientation_a = $this->input->post('combo2_orientation_a');
            $combo2_orientation_b = $this->input->post('combo2_orientation_b');
            $combo2_orientation_c = $this->input->post('combo2_orientation_c');
            $combo2_mocktest = $this->input->post('combo2_mocktest');
            $combo_2_price = $this->input->post('combo_2_price');
            
            $combo3_material_a = $this->input->post('combo3_material_a');
            $combo3_material_b = $this->input->post('combo3_material_b');
            $combo3_material_c = $this->input->post('combo3_material_c');
            $combo3_orientation_a = $this->input->post('combo3_orientation_a');
            $combo3_orientation_b = $this->input->post('combo3_orientation_b');
            $combo3_orientation_c = $this->input->post('combo3_orientation_c');
            $combo3_mocktest = $this->input->post('combo3_mocktest');
            $combo_3_price = $this->input->post('combo_3_price');
            
            $combo4_material_a = $this->input->post('combo4_material_a');
            $combo4_material_b = $this->input->post('combo4_material_b');
            $combo4_material_c = $this->input->post('combo4_material_c');
            $combo4_orientation_a = $this->input->post('combo4_orientation_a');
            $combo4_orientation_b = $this->input->post('combo4_orientation_b');
            $combo4_orientation_c = $this->input->post('combo4_orientation_c');
            $combo4_mocktest = $this->input->post('combo4_mocktest');
            $combo_4_price = $this->input->post('combo_4_price');
            
            //echo $combo1_material_a.$combo1_orientation_a.$combo1_material_b.$combo1_orientation_b.$combo1_material_c.$combo1_orientation_c.$combo1_mocktest.$combo_1_price;die;
            if($combo1_material_a=='on'){
                $combo1=$combo1.'+Material-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Material-B';
            }
            if($combo1_material_c=='on'){
                $combo1=$combo1.'+Material-C';
            }
            if($combo1_orientation_a=='on'){
                $combo1=$combo1.'+Orientation-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Orientation-B';
            }
            if($combo1_orientation_c=='on'){
                $combo1=$combo1.'+Orientation-C';
            }
            if($combo1_mocktest=='on'){
                $combo1=$combo1.'+MockTest';
            }
            
            if ($combo1[0] === '+') {
                $combo1 = substr($combo1, 1);
            }
    
    
            if($combo2_material_a=='on'){
                $combo2=$combo2.'+Material-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Material-B';
            }
            if($combo2_material_c=='on'){
                $combo2=$combo2.'+Material-C';
            }
            if($combo2_orientation_a=='on'){
                $combo2=$combo2.'+Orientation-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Orientation-B';
            }
            if($combo2_orientation_c=='on'){
                $combo2=$combo2.'+Orientation-C';
            }
            if($combo2_mocktest=='on'){
                $combo2=$combo2.'+MockTest';
            }
            
            if ($combo2[0] === '+') {
                $combo2 = substr($combo2, 1);
            }
            
            if($combo3_material_a=='on'){
                $combo3=$combo3.'+Material-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Material-B';
            }
            if($combo3_material_c=='on'){
                $combo3=$combo3.'+Material-C';
            }
            if($combo3_orientation_a=='on'){
                $combo3=$combo3.'+Orientation-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Orientation-B';
            }
            if($combo3_orientation_c=='on'){
                $combo3=$combo3.'+Orientation-C';
            }
            if($combo3_mocktest=='on'){
                $combo3=$combo3.'+MockTest';
            }
            
            if ($combo3[0] === '+') {
                $combo3 = substr($combo3, 1);
            }
            
            
            if($combo4_material_a=='on'){
                $combo4=$combo4.'+Material-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Material-B';
            }
            if($combo4_material_c=='on'){
                $combo4=$combo4.'+Material-C';
            }
            if($combo4_orientation_a=='on'){
                $combo4=$combo4.'+Orientation-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Orientation-B';
            }
            if($combo4_orientation_c=='on'){
                $combo4=$combo4.'+Orientation-C';
            }
            if($combo4_mocktest=='on'){
                $combo4=$combo4.'+MockTest';
            }
            
            if ($combo4[0] === '+') {
                $combo4 = substr($combo4, 1);
            }
            
            if(empty($combo1)){
                 $combo1='';
            }
            if(empty($combo2)){
                 $combo2='';
            }
            if(empty($combo3)){
                 $combo3='';
            }
            if(empty($combo4)){
                 $combo4='';
            }
            
            
            
            $arr['combo_1'] = $combo1;
            $arr['combo_2'] = $combo2;
            $arr['combo_3'] = $combo3;
            $arr['combo_4'] = $combo4;
            $arr['combo_1_price'] = $combo_1_price;
            $arr['combo_2_price'] = $combo_2_price;
            $arr['combo_3_price'] = $combo_3_price;
            $arr['combo_4_price'] = $combo_4_price;
            $arr['close_date']=$close_date;
            //print_r($arr);die;
            
            $this->db->insert('competition_product_state',$arr);
            $data['message']='Competition added successfully ...';
        }
        
        // $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        $this->load->view("competition_activate.php", $data); 
    }
    
    public function competition_activate1()
    {
        //echo '9k';die;
        
        if(isset($_POST['submit'])){
        //print_r($_POST);die;
            $period_id = $this->input->post('period_id');
            $state_id = $this->input->post('state_id');
            $product_name = $this->input->post('product_name');
            $competition_level_id = $this->input->post('competition_level_id');
            $product_price = $this->input->post('product_price');
            $study_material_a = $this->input->post('study_material_a');
            $study_material_a_price = $this->input->post('study_material_a_price');
            $study_material_b = $this->input->post('study_material_b');
            $study_material_b_price = $this->input->post('study_material_b_price');
            $study_material_c = $this->input->post('study_material_c');
            $study_material_c_price = $this->input->post('study_material_c_price');
            $orientation_a = $this->input->post('orientation_a');
            $orientation_a_price = $this->input->post('orientation_a_price');
            $orientation_b = $this->input->post('orientation_b');
            $orientation_b_price = $this->input->post('orientation_b_price');
            $orientation_c = $this->input->post('orientation_c');
            $orientation_c_price = $this->input->post('orientation_c_price');
            $mock_test = $this->input->post('mock_test');
            $mock_test_price = $this->input->post('mock_test_price');
            $close_date = $this->input->post('close_date');
            
            $this->db->select('product_name');
            $this->db->from('products');
            $this->db->where('product_id',$product_name);
            $query = $this->db->get();
            $product= $query->row_array();

            $arr = array(
                'product_name' => $product['product_name'],
                'product_price' => $product_price,
                'mock_test' => $mock_test,
                'clevel' => $competition_level_id,
                'status' => 'Live',
                'state_id'=>$state_id,
                'period_id'=>$period_id
            );
            
            if ($study_material_a == 'on') {
                $arr['study_material_a'] = 'study_material_a';
            }
            if ($study_material_b == 'on') {
                $arr['study_material_b'] = 'study_material_b';
            }
            if ($study_material_c == 'on') {
                $arr['study_material_c'] = 'study_material_c';
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
            if ($mock_test == 'on') {
                $arr['mock_test'] = 'mock_test';
            }
            
            $arr['study_material_a_price'] = $study_material_a_price;
            $arr['study_material_b_price'] = $study_material_b_price;
            $arr['study_material_c_price'] = $study_material_c_price;
            $arr['orientation_a_price'] = $orientation_a_price;
            $arr['orientation_b_price'] = $orientation_b_price;
            $arr['orientation_c_price'] = $orientation_c_price;
            $arr['mock_test_price'] = $mock_test_price;


            $combo1_material_a = $this->input->post('combo1_material_a');
            $combo1_material_b = $this->input->post('combo1_material_b');
            $combo1_material_c = $this->input->post('combo1_material_c');
            $combo1_orientation_a = $this->input->post('combo1_orientation_a');
            $combo1_orientation_b = $this->input->post('combo1_orientation_b');
            $combo1_orientation_c = $this->input->post('combo1_orientation_c');
            $combo1_mocktest = $this->input->post('combo1_mocktest');
            $combo_1_price = $this->input->post('combo_1_price');
            
            
            $combo2_material_a = $this->input->post('combo2_material_a');
            $combo2_material_b = $this->input->post('combo2_material_b');
            $combo2_material_c = $this->input->post('combo2_material_c');
            $combo2_orientation_a = $this->input->post('combo2_orientation_a');
            $combo2_orientation_b = $this->input->post('combo2_orientation_b');
            $combo2_orientation_c = $this->input->post('combo2_orientation_c');
            $combo2_mocktest = $this->input->post('combo2_mocktest');
            $combo_2_price = $this->input->post('combo_2_price');
            
            $combo3_material_a = $this->input->post('combo3_material_a');
            $combo3_material_b = $this->input->post('combo3_material_b');
            $combo3_material_c = $this->input->post('combo3_material_c');
            $combo3_orientation_a = $this->input->post('combo3_orientation_a');
            $combo3_orientation_b = $this->input->post('combo3_orientation_b');
            $combo3_orientation_c = $this->input->post('combo3_orientation_c');
            $combo3_mocktest = $this->input->post('combo3_mocktest');
            $combo_3_price = $this->input->post('combo_3_price');
            
            $combo4_material_a = $this->input->post('combo4_material_a');
            $combo4_material_b = $this->input->post('combo4_material_b');
            $combo4_material_c = $this->input->post('combo4_material_c');
            $combo4_orientation_a = $this->input->post('combo4_orientation_a');
            $combo4_orientation_b = $this->input->post('combo4_orientation_b');
            $combo4_orientation_c = $this->input->post('combo4_orientation_c');
            $combo4_mocktest = $this->input->post('combo4_mocktest');
            $combo_4_price = $this->input->post('combo_4_price');
            
            //echo $combo1_material_a.$combo1_orientation_a.$combo1_material_b.$combo1_orientation_b.$combo1_material_c.$combo1_orientation_c.$combo1_mocktest.$combo_1_price;die;
            if($combo1_material_a=='on'){
                $combo1=$combo1.'+Material-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Material-B';
            }
            if($combo1_material_c=='on'){
                $combo1=$combo1.'+Material-C';
            }
            if($combo1_orientation_a=='on'){
                $combo1=$combo1.'+Orientation-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Orientation-B';
            }
            if($combo1_orientation_c=='on'){
                $combo1=$combo1.'+Orientation-C';
            }
            if($combo1_mocktest=='on'){
                $combo1=$combo1.'+MockTest';
            }
            
            if ($combo1[0] === '+') {
                $combo1 = substr($combo1, 1);
            }
    
    
            if($combo2_material_a=='on'){
                $combo2=$combo2.'+Material-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Material-B';
            }
            if($combo2_material_c=='on'){
                $combo2=$combo2.'+Material-C';
            }
            if($combo2_orientation_a=='on'){
                $combo2=$combo2.'+Orientation-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Orientation-B';
            }
            if($combo2_orientation_c=='on'){
                $combo2=$combo2.'+Orientation-C';
            }
            if($combo2_mocktest=='on'){
                $combo2=$combo2.'+MockTest';
            }
            
            if ($combo2[0] === '+') {
                $combo2 = substr($combo2, 1);
            }
            
            if($combo3_material_a=='on'){
                $combo3=$combo3.'+Material-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Material-B';
            }
            if($combo3_material_c=='on'){
                $combo3=$combo3.'+Material-C';
            }
            if($combo3_orientation_a=='on'){
                $combo3=$combo3.'+Orientation-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Orientation-B';
            }
            if($combo3_orientation_c=='on'){
                $combo3=$combo3.'+Orientation-C';
            }
            if($combo3_mocktest=='on'){
                $combo3=$combo3.'+MockTest';
            }
            
            if ($combo3[0] === '+') {
                $combo3 = substr($combo3, 1);
            }
            
            
            if($combo4_material_a=='on'){
                $combo4=$combo4.'+Material-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Material-B';
            }
            if($combo4_material_c=='on'){
                $combo4=$combo4.'+Material-C';
            }
            if($combo4_orientation_a=='on'){
                $combo4=$combo4.'+Orientation-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Orientation-B';
            }
            if($combo4_orientation_c=='on'){
                $combo4=$combo4.'+Orientation-C';
            }
            if($combo4_mocktest=='on'){
                $combo4=$combo4.'+MockTest';
            }
            
            if ($combo4[0] === '+') {
                $combo4 = substr($combo4, 1);
            }
            
            if(empty($combo1)){
                 $combo1='';
            }
            if(empty($combo2)){
                 $combo2='';
            }
            if(empty($combo3)){
                 $combo3='';
            }
            if(empty($combo4)){
                 $combo4='';
            }
            
            
            
            $arr['combo_1'] = $combo1;
            $arr['combo_2'] = $combo2;
            $arr['combo_3'] = $combo3;
            $arr['combo_4'] = $combo4;
            $arr['combo_1_price'] = $combo_1_price;
            $arr['combo_2_price'] = $combo_2_price;
            $arr['combo_3_price'] = $combo_3_price;
            $arr['combo_4_price'] = $combo_4_price;
            $arr['close_date'] = $close_date;
            
            // print_r($arr);die;
            
            if($_POST['choice']=='yes' or $_POST['avianchoice']=='yes'){  
                $franchise_id=$_POST['franchise_id'];
                $ar=array();
                $ar['franchise_id']  = $this->input->post('franchise_id');
                $ar['comp_price']    = $product_price;
                $ar['mat_a_price']   = $study_material_a_price;
                $ar['mat_b_price']   = $study_material_b_price;
                $ar['mat_c_price']   = $study_material_c_price;
                $ar['ori_a_price']   = $orientation_a_price;
                $ar['ori_b_price']   = $orientation_b_price;
                $ar['ori_c_price']   = $orientation_c_price;
                $ar['moc_a_price']   = $mock_test_price;
                $ar['combo_1_price'] = $combo_1_price;
                $ar['combo_2_price'] = $combo_2_price;
                $ar['combo_3_price'] = $combo_3_price;
                $ar['combo_4_price'] = $combo_4_price;
                    
                    if($_POST['choice']=='yes')
                    {
                        $arr['franchise_split']= 'yes';
                        $ar['comp_franchise']     = $this->input->post('com_per');
                        
                        $ar['moc_a_franchise']     = $this->input->post('moc_a_per');
                        
                        $ar['mat_a_franchise'] = $this->input->post('mat_a_per');
                        $ar['mat_b_franchise'] = $this->input->post('mat_b_per');
                        $ar['mat_c_franchise'] = $this->input->post('mat_c_per');
                        
                        $ar['ori_a_franchise'] = $this->input->post('ori_a_per');
                        $ar['ori_b_franchise'] = $this->input->post('ori_b_per');
                        $ar['ori_c_franchise'] = $this->input->post('ori_c_per');
                        
                        $ar['com_a_per'] = $this->input->post('com_a_per');
                        $ar['com_b_per'] = $this->input->post('com_b_per');
                        $ar['com_c_per'] = $this->input->post('com_c_per');
                        $ar['com_d_per'] = $this->input->post('com_d_per');
                    }
                    if($_POST['avianchoice']=='yes')
                    {
                        $arr['aviansys_split'] = 'yes';
                        $ar['comp_per']     = $this->input->post('com_peravian');
                        
                        $ar['moc_a_per']     = $this->input->post('moc_a_peravian');
                        
                        $ar['mat_a_per'] = $this->input->post('mat_a_peravian');
                        $ar['mat_b_per'] = $this->input->post('mat_b_peravian');
                        $ar['mat_c_per'] = $this->input->post('mat_c_peravian');
                        
                        $ar['ori_a_per'] = $this->input->post('ori_a_peravian');
                        $ar['ori_b_per'] = $this->input->post('ori_b_peravian');
                        $ar['ori_c_per'] = $this->input->post('ori_c_peravian');
                        
                        $ar['com_a_peravian'] = $this->input->post('com_a_peravian');
                        $ar['com_b_peravian'] = $this->input->post('com_b_peravian');
                        $ar['com_c_peravian'] = $this->input->post('com_c_peravian');
                        $ar['com_d_peravian'] = $this->input->post('com_d_peravian');
                    
                    }
            }    
            
            $this->db->insert('competition_product_state',$arr);
            $last_id = $this->db->insert_id('id');
            //echo $last_id;die;
            $ar['comp_id'] = $last_id;
            $this->db->insert('split_parts_to_franchise',$ar);
            $data['result']=$_POST;
            $this->session->set_userdata('comp_id',$last_id);
            redirect('manage/competitionshedule/comp_details');
        }
        
        // $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period',array('period_id >'=>'11'))->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    if($data['result']['state_id']){
	    $data['franchise']    = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
	    }
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        $this->load->view("competition_activate1.php", $data); 
    }
    
    public function launch_new_competition()
    {
        
        if(isset($_POST['submit'])){
            $data['result']=$_POST;
            
            $res=$this->db->get_where('revenue_setting',array('period_id'=>$_POST['period_id'],'clevel'=>$_POST['competition_level_id'],'product_id'=>$_POST['product_name']))->row();
	       // echo $this->db->last_query();die;
	        
	        $product=$this->db->get_where('products',array('product_id'=>$_POST['product_name']))->row();
	        
	        if(!empty($res)){
                    // echo '<pre>';
                    // print_r($res);
            
                    $dates = explode(", ", $_POST['close_date']);
                    sort($dates);
                        $maxDate = end($dates);
                        
                    $close_date = $maxDate;
                        
            
            
            
                    $period_id = $this->input->post('period_id');
                    $state_id = $this->input->post('state_id');
                    $product_name = $this->input->post('product_name');
                    $competition_level_id = $this->input->post('competition_level_id');
                    
                    
                    // $product_price = $this->input->post('product_price');
                    
                    
                    $study_material_a = $this->input->post('study_material_a');
                    $study_material_b = $this->input->post('study_material_b');
                    $study_material_c = $this->input->post('study_material_c');
                    $study_material_d = $this->input->post('study_material_d');
                    $study_material_e = $this->input->post('study_material_e');
                    $study_material_f = $this->input->post('study_material_f');
                    
                    $mock_test_a = $this->input->post('mock_test_a');
                    $mock_test_b = $this->input->post('mock_test_b');
                    $mock_test_c = $this->input->post('mock_test_c');
                    $mock_test_d = $this->input->post('mock_test_d');
                    $mock_test_e = $this->input->post('mock_test_e');
                    $mock_test_f = $this->input->post('mock_test_f');
                    
                    
                    
                    
                    $orientation_a = $this->input->post('orientation_a');
                    $orientation_b = $this->input->post('orientation_b');
                    $orientation_c = $this->input->post('orientation_c');
                    $orientation_d = $this->input->post('orientation_d');
                    $orientation_e = $this->input->post('orientation_e');
                    $orientation_f = $this->input->post('orientation_f');
                    
                    
                    
                    
                    $this->db->select('product_name');
                    $this->db->from('products');
                    $this->db->where('product_id',$product_name);
                    $query = $this->db->get();
                    $product= $query->row_array();
        
                    $arr = array(
                        'product_name' => $product['product_name'],
                        // 'product_price' => $product_price,
                        // 'mock_test' => $mock_test,
                        'clevel' => $competition_level_id,
                        'status' => 'Live',
                        'state_id'=>$state_id,
                        'period_id'=>$period_id
                    );
                    
                    // if ($product['product_name'] == 'Lunar Skill Test') {
                    //     $arr['series'] = $this->input->post('series');
                    //     $arr['subject'] = $this->input->post('subject');
                    // }else{
                    //     $arr['series'] = '';
                    //     $arr['subject'] = '';
                    // }
                    
                    
    
                    
                    
                    // if ($study_material_a == 'on') {
                    //     $arr['study_material_a'] = 'study_material_a';
                    // }
                    // if ($study_material_b == 'on') {
                    //     $arr['study_material_b'] = 'study_material_b';
                    // }
                    // if ($study_material_c == 'on') {
                    //     $arr['study_material_c'] = 'study_material_c';
                    // }
                    // if ($study_material_d == 'on') {
                    //     $arr['study_material_d'] = 'study_material_d';
                    // }
                    // if ($study_material_e == 'on') {
                    //     $arr['study_material_e'] = 'study_material_e';
                    // }
                    // if ($study_material_f == 'on') {
                    //     $arr['study_material_f'] = 'study_material_f';
                    // }
                    
                   
    
                    
                    // if ($orientation_a == 'on') {
                    //     $arr['orientation_a'] = 'orientation_a';
                    // }
                    // if ($orientation_b == 'on') {
                    //     $arr['orientation_b'] = 'orientation_b';
                    // }
                    // if ($orientation_c == 'on') {
                    //     $arr['orientation_c'] = 'orientation_c';
                    // }
                    // if ($orientation_d == 'on') {
                    //     $arr['orientation_d'] = 'orientation_d';
                    // }
                    // if ($orientation_e == 'on') {
                    //     $arr['orientation_e'] = 'orientation_e';
                    // }
                    // if ($orientation_f == 'on') {
                    //     $arr['orientation_f'] = 'orientation_f';
                    // }
                    
                    // $letters = ['a','b','c','d','e','f'];
                    
                    // foreach ($letters as $l) {
                    
                    //     $bundle = $this->input->post('study_material_' . $l);
                    //     $orientation = $this->input->post('orientation_' . $l);
                    
                    //     if (!empty($bundle)) {
                    
                    //         // ✅ store study material
                    //         $arr['study_material_' . $l] = 'study_material_' . $l;
                    //         // ✅ store orientation
                    //         $arr['orientation_' . $l] = 'orientation_' . $l;
                    //     }
                    // }
                    
                    $letters = ['a','b','c','d','e','f'];
                    $bundleValues = []; // store selected bundle strings
                    
                    foreach ($letters as $l) {
                    
                        $bundle = $this->input->post('study_material_' . $l);
                    
                        if (!empty($bundle)) {
                    
                            // existing logic
                            $arr['study_material_' . $l] = 'study_material_' . $l;
                            $arr['orientation_' . $l] = 'orientation_' . $l;
                    
                            // ✅ build bundle string
                            $arr['bundle_' . $l] = 'study_material_' . $l . ' + orientation_' . $l;
                        }
                    }

    
                    if ($mock_test_a == 'on') {
                        $arr['mock_test_a'] = 'mock_test_a';
                        $arr['mock_test'] = 'mock_test';
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
                    if ($study_material_f == 'on') {
                        $arr['mock_test_f'] = 'mock_test_f';
                    }
    
                    
                    $arr['associate_id']=$_POST['associate_id'];
                    $arr['associate_gst']=$_POST['associate_gst'];
                    $arr['associate_split']=$_POST['associate_split'];
                   
                    $arr['close_date']=$close_date;
                    //print_r($arr);die;
                    if(isset($_POST['choice'])){
                        $arr['franchise_split']=$_POST['choice'];
                        // $arr['com_per']=$_POST['com_per'];
                        $arr['franchise_id']=$_POST['franchise_id'];
                        
                    }
                    
                    // if(isset($_POST['avianchoice'])){
                    //     $arr['aviansys_split']=$_POST['avianchoice'];
                    //     $arr['com_peravian']=$_POST['com_peravian'];
                    // }
                    
                    
                        $arr['aviansys_split']='yes';
                        // $arr['manageper']=$res->manageper;
                        // $arr['com_peravian']=$res->com_peravian;
                        $arr['franchise_gst']=$_POST['gst_fran'];
                        // $arr['crm_fix']=$_POST['crm_fix'];
                        $arr['aviansys_gst']='Yes';
                        $arr['revenue_setting_id'] = $res->id;
                        $arr['crm_account_id'] = $_POST['crm_account_id'];    
                        
                    // echo "<pre>";   
                    // print_r($arr);
                    // echo "<pre>";
                    // print_r($_POST);
                    // die; 
                        
                    $this->db->insert('competition_product_state',$arr);
                    $insert_id = $this->db->insert_id();
                    
                        foreach ($dates as $date) {
                            $ar=array(
                                'close_date'=>$date,
                                'comp_id'=>$insert_id
                            );
                            
                            $this->db->insert('competition_dates',$ar);
                        }
                    
                    $data['message']='Competition added successfully ...';
            }else{
                $data['message']='No Revenue Setting Found ...';
            }
        
        }
        
        $data['period']   = $this->db->get_where('period',array('period_id >'=>'11'))->result_array();
	    $data['country']   = $this->db->get_where('countries')->result_array();
	    if(isset($data['result']['country'])){
	        $data['state']    = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
	    }
	    if($data['result']['state_id']){
	        $data['franchise']    = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
	    }
	   
	        $data['associate']    = $this->db->get_where('associates')->result_array();
	        
	       $data['crm_account'] = $this->db->get_where('gst_account_marrs',['title'=>'CRM'])->result_array();
	        
	   // }
	    
	    
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        if($data['result']['product_name']){
            $data['level']   = $this->db->get_where('competition_level_byproduct',['product_id'=>$data['result']['product_name']])->result_array();
        }
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        
        
        $this->load->view("launch_new_competition.php", $data); 
    }
    
    
    public function competition_activate2()
    {
        
        if(isset($_POST['submit'])){
            
            $dates = explode(", ", $_POST['close_date']);
            sort($dates);
                $maxDate = end($dates);
                
                $close_date = $maxDate;
                
                
            // die;
            
            $period_id = $this->input->post('period_id');
            $state_id = $this->input->post('state_id');
            $product_name = $this->input->post('product_name');
            $competition_level_id = $this->input->post('competition_level_id');
            $product_price = $this->input->post('product_price');
            $study_material_a = $this->input->post('study_material_a');
            $study_material_a_price = $this->input->post('study_material_a_price');
            $study_material_b = $this->input->post('study_material_b');
            $study_material_b_price = $this->input->post('study_material_b_price');
            $study_material_c = $this->input->post('study_material_c');
            $study_material_c_price = $this->input->post('study_material_c_price');
            $orientation_a = $this->input->post('orientation_a');
            $orientation_a_price = $this->input->post('orientation_a_price');
            $orientation_b = $this->input->post('orientation_b');
            $orientation_b_price = $this->input->post('orientation_b_price');
            $orientation_c = $this->input->post('orientation_c');
            $orientation_c_price = $this->input->post('orientation_c_price');
            $mock_test = $this->input->post('mock_test');
            $mock_test_price = $this->input->post('mock_test_price');
            // $close_date = $this->input->post('close_date');
            $crm_fix = $this->input->post('crm_fix');
            
            $this->db->select('product_name');
            $this->db->from('products');
            $this->db->where('product_id',$product_name);
            $query = $this->db->get();
            $product= $query->row_array();

            $arr = array(
                'product_name' => $product['product_name'],
                'product_price' => $product_price,
                'mock_test' => $mock_test,
                'clevel' => $competition_level_id,
                'status' => 'Live',
                'state_id'=>$state_id,
                'period_id'=>$period_id
            );
            
            if ($product['product_name'] == 'Lunar Skill Test') {
                $arr['series'] = $this->input->post('series');
                $arr['subject'] = $this->input->post('subject');
            }else{
                $arr['series'] = '';
                $arr['subject'] = '';
            }
            
            
            if ($study_material_a == 'on') {
                $arr['study_material_a'] = 'study_material_a';
            }
            if ($study_material_b == 'on') {
                $arr['study_material_b'] = 'study_material_b';
            }
            if ($study_material_c == 'on') {
                $arr['study_material_c'] = 'study_material_c';
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
            if ($mock_test == 'on') {
                $arr['mock_test'] = 'mock_test';
            }
            
            $arr['study_material_a_price'] = $study_material_a_price;
            $arr['study_material_b_price'] = $study_material_b_price;
            $arr['study_material_c_price'] = $study_material_c_price;
            $arr['orientation_a_price'] = $orientation_a_price;
            $arr['orientation_b_price'] = $orientation_b_price;
            $arr['orientation_c_price'] = $orientation_c_price;
            $arr['mock_test_price'] = $mock_test_price;
            

            $combo1_material_a = $this->input->post('combo1_material_a');
            $combo1_material_b = $this->input->post('combo1_material_b');
            $combo1_material_c = $this->input->post('combo1_material_c');
            $combo1_orientation_a = $this->input->post('combo1_orientation_a');
            $combo1_orientation_b = $this->input->post('combo1_orientation_b');
            $combo1_orientation_c = $this->input->post('combo1_orientation_c');
            $combo1_mocktest = $this->input->post('combo1_mocktest');
            $combo_1_price = $this->input->post('combo_1_price');
            
            
            $combo2_material_a = $this->input->post('combo2_material_a');
            $combo2_material_b = $this->input->post('combo2_material_b');
            $combo2_material_c = $this->input->post('combo2_material_c');
            $combo2_orientation_a = $this->input->post('combo2_orientation_a');
            $combo2_orientation_b = $this->input->post('combo2_orientation_b');
            $combo2_orientation_c = $this->input->post('combo2_orientation_c');
            $combo2_mocktest = $this->input->post('combo2_mocktest');
            $combo_2_price = $this->input->post('combo_2_price');
            
            $combo3_material_a = $this->input->post('combo3_material_a');
            $combo3_material_b = $this->input->post('combo3_material_b');
            $combo3_material_c = $this->input->post('combo3_material_c');
            $combo3_orientation_a = $this->input->post('combo3_orientation_a');
            $combo3_orientation_b = $this->input->post('combo3_orientation_b');
            $combo3_orientation_c = $this->input->post('combo3_orientation_c');
            $combo3_mocktest = $this->input->post('combo3_mocktest');
            $combo_3_price = $this->input->post('combo_3_price');
            
            $combo4_material_a = $this->input->post('combo4_material_a');
            $combo4_material_b = $this->input->post('combo4_material_b');
            $combo4_material_c = $this->input->post('combo4_material_c');
            $combo4_orientation_a = $this->input->post('combo4_orientation_a');
            $combo4_orientation_b = $this->input->post('combo4_orientation_b');
            $combo4_orientation_c = $this->input->post('combo4_orientation_c');
            $combo4_mocktest = $this->input->post('combo4_mocktest');
            $combo_4_price = $this->input->post('combo_4_price');
            
            //echo $combo1_material_a.$combo1_orientation_a.$combo1_material_b.$combo1_orientation_b.$combo1_material_c.$combo1_orientation_c.$combo1_mocktest.$combo_1_price;die;
            if($combo1_material_a=='on'){
                $combo1=$combo1.'+Material-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Material-B';
            }
            if($combo1_material_c=='on'){
                $combo1=$combo1.'+Material-C';
            }
            if($combo1_orientation_a=='on'){
                $combo1=$combo1.'+Orientation-A';
            }
            if($combo1_orientation_b=='on'){
                $combo1=$combo1.'+Orientation-B';
            }
            if($combo1_orientation_c=='on'){
                $combo1=$combo1.'+Orientation-C';
            }
            if($combo1_mocktest=='on'){
                $combo1=$combo1.'+MockTest';
            }
            
            if ($combo1[0] === '+') {
                $combo1 = substr($combo1, 1);
            }
    
    
            if($combo2_material_a=='on'){
                $combo2=$combo2.'+Material-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Material-B';
            }
            if($combo2_material_c=='on'){
                $combo2=$combo2.'+Material-C';
            }
            if($combo2_orientation_a=='on'){
                $combo2=$combo2.'+Orientation-A';
            }
            if($combo2_orientation_b=='on'){
                $combo2=$combo2.'+Orientation-B';
            }
            if($combo2_orientation_c=='on'){
                $combo2=$combo2.'+Orientation-C';
            }
            if($combo2_mocktest=='on'){
                $combo2=$combo2.'+MockTest';
            }
            
            if ($combo2[0] === '+') {
                $combo2 = substr($combo2, 1);
            }
            
            if($combo3_material_a=='on'){
                $combo3=$combo3.'+Material-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Material-B';
            }
            if($combo3_material_c=='on'){
                $combo3=$combo3.'+Material-C';
            }
            if($combo3_orientation_a=='on'){
                $combo3=$combo3.'+Orientation-A';
            }
            if($combo3_orientation_b=='on'){
                $combo3=$combo3.'+Orientation-B';
            }
            if($combo3_orientation_c=='on'){
                $combo3=$combo3.'+Orientation-C';
            }
            if($combo3_mocktest=='on'){
                $combo3=$combo3.'+MockTest';
            }
            
            if ($combo3[0] === '+') {
                $combo3 = substr($combo3, 1);
            }
            
            
            if($combo4_material_a=='on'){
                $combo4=$combo4.'+Material-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Material-B';
            }
            if($combo4_material_c=='on'){
                $combo4=$combo4.'+Material-C';
            }
            if($combo4_orientation_a=='on'){
                $combo4=$combo4.'+Orientation-A';
            }
            if($combo4_orientation_b=='on'){
                $combo4=$combo4.'+Orientation-B';
            }
            if($combo4_orientation_c=='on'){
                $combo4=$combo4.'+Orientation-C';
            }
            if($combo4_mocktest=='on'){
                $combo4=$combo4.'+MockTest';
            }
            
            if ($combo4[0] === '+') {
                $combo4 = substr($combo4, 1);
            }
            
            if(empty($combo1)){
                 $combo1='';
            }
            if(empty($combo2)){
                 $combo2='';
            }
            if(empty($combo3)){
                 $combo3='';
            }
            if(empty($combo4)){
                 $combo4='';
            }
            
            
            
            $arr['combo_1'] = $combo1;
            $arr['combo_2'] = $combo2;
            $arr['combo_3'] = $combo3;
            $arr['combo_4'] = $combo4;
            $arr['combo_1_price'] = $combo_1_price;
            $arr['combo_2_price'] = $combo_2_price;
            $arr['combo_3_price'] = $combo_3_price;
            $arr['combo_4_price'] = $combo_4_price;
            $arr['close_date']=$close_date;
            //print_r($arr);die;
            if(isset($_POST['choice'])){
                $arr['franchise_split']=$_POST['choice'];
                $arr['com_per']=$_POST['com_per'];
                $arr['franchise_id']=$_POST['franchise_id'];
                
            }
            // if(isset($_POST['avianchoice'])){
                // $arr['aviansys_split']=$_POST['avianchoice'];
                // $arr['com_peravian']=$_POST['com_peravian'];
            // }
                $arr['aviansys_split']='yes';
                $arr['manageper']=$this->input->post('manageper');
                $arr['com_peravian']=$this->input->post('com_peravian');
                $arr['franchise_gst']=$_POST['com_per_gst'];
                $arr['crm_fix']=$_POST['crm_fix'];
                $arr['aviansys_gst']='Yes';
                // print_R($arr);die;
                
            $this->db->insert('competition_product_state',$arr);
            $insert_id = $this->db->insert_id();
            
                foreach ($dates as $date) {
                    $ar=array(
                        'close_date'=>$date,
                        'comp_id'=>$insert_id
                    );
                    
                    $this->db->insert('competition_dates',$ar);
                }
            
            $data['message']='Competition added successfully ...';
        }
        
            $this->db->select('subject,series');
            $this->db->from('competition_product_state');
            $this->db->where('subject !=','');
            $this->db->where('series !=','');
            $this->db->where('product_name','Lunar Skill Test');
            $this->db->order_by('id','DESC');
            $query = $this->db->get();
            $data['sub']= $query->row();
        
        
        // $data['category'] = $this->db->get_where('class')->result_array();  
        
        
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        
        
        $this->load->view("competition_activate2.php", $data); 
    }
    
    public function mark_cin()
    {
        //echo '9k';die;
        
        if(isset($_POST['submit'])){
            // print_r($_POST['bundle_a']);die;
            
            $cin = isset($_POST['cin']) ? trim($_POST['cin']) : '';
            $prefix = substr($cin, 0, 2);
            
            $map = [
                '25' => '15',
                '26' => '16',
                '27' => '17',
                '28' => '18',
                '29' => '19',
                '30' => '20'
            ];
            
            // Uses map lookup; falls back to subtracting 10 if numeric, or the original prefix
            $mapped_value = $map[$prefix] ?? (is_numeric($prefix) ? ((int)$prefix - 10) : $prefix);
            $period=$this->db->get_where('cin_list',array('cin'=>$_POST['cin']))->row();
            $per=$this->db->get_where('period',array('period_id'=>$period->period_id))->row();
            $product=$this->db->get_where('products',array('product_id'=>$_POST['product_name']))->row();
            
        
            $ar = array(
                'cin' => $_POST['cin'],
                'status' => isset($_POST['competition']) && $_POST['competition'] === 'on' ? 'Paid' : '',
                'period_id'=> $period->period_id ?? $per->period_id ?? $mapped_value,
                'product_name' => $product->product_name,
                'clevel' => $_POST['competition_level_id'],
                'amount' => $_POST['product_price'] ?? 0,
                'merchant_amount' => $_POST['product_price'] * 100 ?? 0,
                'Time' => $_POST['close_date'] ?? '',
                
                
                'study_material_a' => isset($_POST['study_material_a']) && $_POST['study_material_a'] === 'on' ? 'Yes' : '',
                'study_material' => isset($_POST['study_material_a']) && $_POST['study_material_a'] === 'on' ? 'Yes' : '',
                'study_material_b' => isset($_POST['study_material_b']) && $_POST['study_material_b'] === 'on' ? 'Yes' : '',
                'study_material_c' => isset($_POST['study_material_c']) && $_POST['study_material_c'] === 'on' ? 'Yes' : '',
                'study_material_d' => isset($_POST['study_material_d']) && $_POST['study_material_d'] === 'on' ? 'Yes' : '',
                'study_material_e' => isset($_POST['study_material_e']) && $_POST['study_material_e'] === 'on' ? 'Yes' : '',
                'study_material_f' => isset($_POST['study_material_f']) && $_POST['study_material_f'] === 'on' ? 'Yes' : '',
            
            
                // 'orientation' => isset($_POST['orientation_a']) && $_POST['orientation_a'] === 'on' ? 'Yes' : '',
                
                'orientation' => isset($_POST['orientation']) && $_POST['orientation'] === 'on' ? 'Yes' : '',
                'orientation_a' => (
                    (isset($_POST['orientation_a']) && $_POST['orientation_a'] === 'on') 
                    || (isset($_POST['orientation']) && $_POST['orientation'] === 'on')
                ) ? 'Yes' : '',

                
                'orientation_b' => isset($_POST['orientation_b']) && $_POST['orientation_b'] === 'on' ? 'Yes' : '',
                'orientation_c' => isset($_POST['orientation_c']) && $_POST['orientation_c'] === 'on' ? 'Yes' : '',
                'orientation_a' => isset($_POST['orientation_a']) && $_POST['orientation_a'] === 'on' ? 'Yes' : '',
                'orientation_d' => isset($_POST['orientation_d']) && $_POST['orientation_d'] === 'on' ? 'Yes' : '',
                'orientation_e' => isset($_POST['orientation_e']) && $_POST['orientation_e'] === 'on' ? 'Yes' : '',
                'orientation_f' => isset($_POST['orientation_f']) && $_POST['orientation_f'] === 'on' ? 'Yes' : '',
                
                
                'mock_test' => isset($_POST['mock_test']) && $_POST['mock_test'] === 'on' ? 'Yes' : '',
                'mock_test_a' => (
                    (isset($_POST['mock_test_a']) && $_POST['mock_test_a'] === 'on') 
                    || (isset($_POST['mock_test']) && $_POST['mock_test'] === 'on')
                ) ? 'Yes' : '',

                'mock_test_b' => isset($_POST['mock_test_b']) && $_POST['mock_test_b'] === 'on' ? 'Yes' : '',
                'mock_test_c' => isset($_POST['mock_test_c']) && $_POST['mock_test_c'] === 'on' ? 'Yes' : '',
                'mock_test_d' => isset($_POST['mock_test_d']) && $_POST['mock_test_d'] === 'on' ? 'Yes' : '',
                'mock_test_e' => isset($_POST['mock_test_e']) && $_POST['mock_test_e'] === 'on' ? 'Yes' : '',
                'mock_test_f' => isset($_POST['mock_test_f']) && $_POST['mock_test_f'] === 'on' ? 'Yes' : '',
                
                
                
            );
            
            $bundles = ['a', 'b', 'c', 'd', 'e', 'f'];

            foreach ($bundles as $bundle) {
            
                if (isset($_POST['bundle_' . $bundle])) {
            
                    $ar['study_material_' . $bundle] = 'Yes';
                    $ar['orientation_' . $bundle]    = 'Yes';
            
                }
            
            }
            // echo '<pre>';
            // print_r($_POST);
            // print_r($ar);die;
            
            if($product->product_name == 'Lunar Skill Test'){
                $ar = array_merge($ar, [
                    'type'    => $_POST['type'] ?? '',
                    'series'  => $_POST['serie'] ?? '',
                    'subject' => $_POST['subject'] ?? ''
                ]);
            }
            
            
            // $this->db->insert('new_cart',$ar);
            
            $inserted = $this->db->insert('new_cart', $ar);

            if ($inserted) {
            
                $data['message'] = 'CIN marked as registered successfully ...';
            
            } else {
            
                $db_error = $this->db->error();
            
                $data['message'] = 'Error : CIN registration failed. '.log_message(
                    'error',
                    'new_cart insert failed. Data: ' .
                    print_r($ar, true) .
                    ' DB Error: ' .
                    print_r($db_error, true)
                );
            
                
            }
            // $data['message']='CIN marked as registered successfully ...';
        }
        
        // $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        $this->load->view("mark_cin.php", $data); 
    }
    
    public function unmark_cin()
    {
        //echo '9k';die;
        
            if(isset($_POST['submit'])){
                
                $this->db->select('*');
                $this->db->from('products');
                $this->db->where('product_id',$_POST['product_name']);
                $query = $this->db->get();
                $prod= $query->row();
                
                // echo $this->db->last_query();die;
                
                $this->db->select('*');
                $this->db->from('new_cart');
                $this->db->where('product_name',$prod->product_name);
                $this->db->where('cin',$_POST['cin']);
                $this->db->where('clevel',$_POST['competition_level_id']);
                $query = $this->db->get();
                // echo $this->db->last_query();die;
                
                $data['arr']= $query->result_array();
                $data['result']=$_POST;
                if($data['arr']){
                    $data['message']='CIN data found successfully ...';
                }else{
                    $data['message']='No CIN data for selected parameters...';
                }
            }
        
            if (isset($_POST['update'])) {
                // print_r($_POST);die;
                $cin = $_POST['cin'] ?? null;
                $clevel = $_POST['competition_level_id'] ?? null;
            
                if (!$cin || !$clevel) {
                    $data['message'] = 'Error: CIN or Competition Level ID is missing.';
                    return;
                }
            
                unset($_POST['cin'], $_POST['competition_level_id'], $_POST['update']);
            
                $update_data = [];
                foreach ($_POST as $key => $value) {
                    $update_data[$key] = !empty($value) ? $value : ''; 
                }
                
                if (!empty($update_data)) {
                    $this->db->where('cin', $cin);
                    $this->db->where('clevel', $clevel);
                    $this->db->update('new_cart', $update_data);
                    $data['message'] = 'CIN registration updated successfully!';
                } else {
                    $data['message'] = 'No fields to update.';
                }
            }


        
        // $data['category'] = $this->db->get_where('class')->result_array();  
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['area'] = $this->db->get_where('areas')->result_array(); 
        $this->load->view("unmark_cin.php", $data); 
    }
    
    public function comp_details()
    {
        $comp_id=$this->session->userdata('comp_id');
        //echo $comp_id;die;
        if(!$comp_id){
            $comp_id= $this->uri->segment(4); 
        }
        
        
        $data['competition_details']   = $this->db->get_where('competition_product_state',array('id'=>$comp_id))->row_array();
        $data['split_details'] = $this->db->get_where('split_parts_to_franchise',array('comp_id'=>$comp_id))->row_array();
        
        $this->load->view("comp_details.php", $data); 
    }
    
    public function competition_list()
    {
        
        $this->db->select('*');
        $this->db->from('competition_product_state');
        // $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_product_state.clevel');
        // $this->db->join('products','products.product_name=competition_product_state.product_name');
        // $this->db->join('period','period.period_id=competition_product_state.period_id');
        // $this->db->group_by('competition_product_state.id');
        // $this->db->where_not_in('product_name', ['Lunar Skill Test']);
        // $this->db->where_not_in('product_name', ['MaRRS Lunar Olympiads']);
        $this->db->order_by('competition_product_state.id','DESC');
        $this->db->limit('15');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        
        $data['arr']= $query->result_array();
        
        
        
        if(isset($_POST['status'])){
            // print_r($_POST);die;
            $id=$_POST['status'];
            //echo $id;die;
            
            $this->db->select('status');
            $this->db->from('competition_product_state');
            $this->db->where('id',$id);
            $query = $this->db->get();
            $st=$query->row_array();
            $stat=$st['status'];
            if($stat=='Live'){
                    $this->db->set('status', 'Closed');
                    $this->db->where('id', $id);
                    $this->db->update('competition_product_state');
            }if($stat=='Closed'){
                    $this->db->set('status', 'Live');
                    $this->db->where('id', $id);
                    $this->db->update('competition_product_state');
            }
           // echo $this->db->last_query();die;
        }
        
        if(isset($_POST['delete'])){
           // print_r($_POST);die;
            $id=$_POST['delete'];
            //echo $id;die;
            $this->db->delete('competition_product_state', array('id' => $id));
        }
        
        if(isset($_POST['close'])){
           // print_r($_POST);die;
            $id=$_POST['close'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/comp');
            
        }
        
        if(isset($_POST['center'])){
           // print_r($_POST);die;
            $id=$_POST['center'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/center');
            
        }
        
        if(isset($_POST['add_center'])){
           // print_r($_POST);die;
            $id=$_POST['add_center'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/add_center');
            
        }
        
        if(isset($_POST['edit_price'])){
           // print_r($_POST);die;
            $id=$_POST['edit_price'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/edit_price');
            
        }
        
        if(isset($_POST['edit_closing'])){
           // print_r($_POST);die;
            $id=$_POST['edit_closing'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/edit_closing');
            
        }
        
        if(isset($_POST['com_edit'])){
            // print_r($_POST);die;
            $id=$_POST['com_edit'];
            $this->session->set_userdata('id',$id);
           redirect('manage/competitionshedule/com_edit');
            
        }
        
        if(isset($_POST['search'])){
            //print_r($_POST);echo 'ok';die;
            $this->db->select('*');
            $this->db->from('competition_product_state');
            // $this->db->join('revenue_setting','revenue_setting.id=competition_product_state.revenue_setting_id','left');
            if(!empty($_POST['product_id'])){
                $this->db->where('product_name',$_POST['product_id']);
            }
            $this->db->where('period_id',$_POST['period']);
            if(!empty($_POST['clevel'])){
                $this->db->where('clevel',$_POST['clevel']);
            }
            $this->db->where('state_id',$_POST['state']);
            $this->db->order_by('competition_product_state.id','DESC');
            
            if(!empty($_POST['search'])){
                
                $this->db->join('exam_centers', 'exam_centers.comp_id = competition_product_state.id', 'left');
                $search = $this->db->escape_like_str($search);

                $this->db->where("
                    (
                        exam_centers.center_name LIKE '%{$search}%'
                        OR exam_centers.center_address LIKE '%{$search}%'
                    )
                ", null, false);
                
            }
            
            $query = $this->db->get();
            // echo $this->db->last_query();
            
            $data['arr']= $query->result_array();
            $data['result']=$_POST;
        }
        
        
        
        if (isset($_POST['export'])) {
            $id = $_POST['export'];
        
            if ($id > 145) {
                
                $this->db->select('*');
                $this->db->from('competition_product_state');
                $this->db->where('id', $id);
                $query = $this->db->get();
                $level = $query->row();
                $level_id = $level->clevel;
                
                
                $this->db->select('cin');
                $this->db->from('new_cart');
                $this->db->where('new_cart.clevel', $level_id);
                $this->db->where('new_cart.status', 'Paid');
                $this->db->group_by('cin');
                $query = $this->db->get();
                $registered_cins = $query->result(); 
                $all_cins = array_column($registered_cins, 'cin'); 
                
                $this->db->select('*');
                $this->db->from('cin_uploade');
                $this->db->join('cin_list', 'cin_list.cin = cin_uploade.cin');
                $this->db->join('school_new', 'school_new.id = cin_list.school_id');
                $this->db->where('comp_id', $id);
                $this->db->group_by('cin_uploade.cin');
                if (!empty($all_cins)) {
                    $this->db->where_not_in('cin_uploade.cin', $all_cins);
                }
                $query = $this->db->get();
                $unregistered_cins = $query->result();
                
                // print_r($unregistered_cins); die();
               
                
            } else {
                $this->db->select('*');
                $this->db->from('competition_product_state');
                $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
                $this->db->where('competition_product_state.id', $id);
                $query = $this->db->get();
                $competition = $query->row();
        
                if (!$competition) {
                    die("Error: No competition data found.");
                }
        
                $medal = $competition->medal_no - 1;
        
                $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                $this->db->where('medal_no', $medal);
                $this->db->where('product_name', $competition->product_name);
                $query = $this->db->get();
                $level = $query->row();
        
                if (!$level) {
                    die("Error: No level data found.");
                }
        
                $clevel = $level->level_id;
        
                $this->db->select('cr.cin, cin_list.*');
                $this->db->from('cin_result as cr');
                $this->db->where('cr.clevel', $clevel);
                $this->db->where('cr.status', 'Q');
                
                if (!empty($competition->clevel)) {
                    $this->db->join('new_cart as nc', 'cr.cin = nc.cin AND nc.clevel = ' . (int) $competition->clevel . ' AND nc.product_name = "' . $competition->product_name . '"', 'left');
                }
        
                $this->db->join('cin_list', 'cin_list.cin = cr.cin');
                $this->db->where('nc.cin IS NULL');
                $this->db->where('nc.product_name', $competition->product_name);
                $this->db->where('nc.period_id', $competition->period_id);
                $query = $this->db->get();
                $unregistered_cins = $query->result();
            }
            
            if (!empty($unregistered_cins)) {
        
                $headers = [
                    'Sr. No', 'Student Name', 'CIN', 'Product', 'School',
                    'Email', 'Phone', 'Class'
                ];

                $data = [];
                $sr_no = 1;
        
                foreach ($unregistered_cins as $payment) {
                    // print_R($payment->student_name);die;
                    $data[] = [
                        $sr_no++,
                        $payment->student_name, 
                        $payment->cin,
                        $payment->product_name,
                        $payment->school_name,
                        $payment->stud_email,
                        $payment->stud_phone,
                        $payment->class,
                    ];
                }
        
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="student_list.csv"');
                header('Pragma: no-cache');
                header('Expires: 0');
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, $headers);
        
                foreach ($data as $row) {
                    fputcsv($handle, $row);
                }
        
                fclose($handle);
                exit();
            } 
            
        }

        
        
        $data['periodload']   = $this->db->get_where('period')->result_array();
        
        if(isset($data['result']['country'])){
	    $data['stateload']    = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
        
	    if($_POST['product_id']){
	        $this->db->where('product_name', $_POST['product_id']);
	        $data['levelload']   = $results = $this->db->get('competition_level_byproduct')->result_array();
	    }
	    
        
        $this->db->where('status', 'Active');
        // $this->db->where_not_in('product_name', ['Lunar Skill Test']);
        $data['productload'] = $this->db->get('products')->result_array();
                
        $this->load->view("competition_list.php", $data); 
    }
    
    public function reminderEmail()
    {
         $comp_id = $this->uri->segment(4);
         
        if (empty($comp_id) || !is_numeric($comp_id)) {
            show_error('Invalid Competition ID.', 400);
            return;
        }

        $comp_id = $this->db->escape_str($comp_id);

        // ── Fetch students ───────────────────────────────────────────────────
        $this->db->select('cin_uploade.*, cin_list.cin');
        $this->db->from('cin_uploade');
        $this->db->join('cin_list', 'cin_list.cin = cin_uploade.cin', 'left'); // join condition
        $this->db->like('cin_uploade.comp_id', $comp_id); // WHERE comp_id LIKE '%521%'
        $students=$this->db->get()->result();
        if (empty($students)) {
            $this->session->set_flashdata('warning', "No active students found for Competition ID: {$comp_id}");
            redirect($_SERVER['HTTP_REFERER'] ?? base_url());
            return;
        }

        // ── Send emails ──────────────────────────────────────────────────────
        $total   = count($students);
        $success = 0;
        $failed  = 0;
        $skipped = 0;
        $batches = array_chunk($students, $this->batch_size);

        foreach ($batches as $batch_no => $batch) {
            foreach ($batch as $student) {

                $email = trim($student->stud_email);

                // Skip empty / invalid emails
                if (empty($email) || !$this->_is_valid_email($email)) {
                    $skipped++;
                    continue;
                }

                $params = [
                    'student_name' => trim($student->student_name),
                    'cin'          => trim($student->cin),
                    'class'        => trim($student->class),
                    'father_name'  => trim($student->father_name),
                ];

                $result = $this->_send_brevo_email($email, $params, $student->student_name);

                $result['success'] ? $success++ : $failed++;
            }

            // Throttle between batches
            if (($batch_no + 1) < count($batches)) {
                sleep($this->sleep_between);
            }
        }

        // ── Flash result & redirect back ─────────────────────────────────────
        $msg = "Reminder sent! Total: {$total} | ✅ Sent: {$success} | ❌ Failed: {$failed} | ⏭ Skipped: {$skipped}";
        $this->session->set_flashdata('success', $msg);

        log_message('info', "reminderEmail comp_id={$comp_id} | {$msg}");

        redirect($_SERVER['HTTP_REFERER'] ?? base_url());
    }

    // =========================================================================
    // PRIVATE HELPERS
    // =========================================================================

    private function _send_brevo_email($to_email, $params, $to_name = '')
    {
        $payload = json_encode([
            'sender' => [
                'name'  => $this->sender_name,
                'email' => $this->sender_email,
            ],
            'to' => [[
                'email' => $to_email,
                'name'  => $to_name,
            ]],
            'templateId' => (int) $this->brevo_template,
            'params'     => $params,
        ]);

        $ch = curl_init('https://api.brevo.com/v3/smtp/email');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'accept: application/json',
                'api-key: ' . $this->brevo_api_key,
                'content-type: application/json',
            ],
            CURLOPT_TIMEOUT => 15,
        ]);

        $response    = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error  = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return ['success' => false, 'error' => $curl_error];
        }

        $decoded = json_decode($response, true);

        if ($http_status === 201) {
            return ['success' => true, 'error' => null];
        }

        $msg = isset($decoded['message']) ? $decoded['message'] : $response;
        return ['success' => false, 'error' => "HTTP {$http_status}: {$msg}"];
    }

    private function _is_valid_email($email)
    {
        return (strpos($email, ' ') === false) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    
    public function comp_mock_assign() 
    {
        $id = $this->uri->segment(4);
        $data['id'] = $id;
    
        $data['result'] = $competition = $this->db->get_where('competition_product_state', array('id' => $id))->row();
    
        $data['assigned_mockpapers'] = $this->db->get_where('active_mockpapers', array('comp_id' => $id))->result();
    
        $this->db->select('*');
        $this->db->from('mock_papers');
        $this->db->where('period_id', $competition->period_id);
        $this->db->where('product_name', $competition->product_name);
        $this->db->where('clevel', $competition->clevel);
    
        if ($competition->product_name == 'Lunar Skill Test') {
            $this->db->where('sub_type', $competition->type);
            $this->db->where('series', $competition->series);
            $this->db->where('subject', $competition->subject);
        }
    
        $query = $this->db->get();
        $data['all_mockpapers'] = $query->result();
    
        if (isset($_POST['back'])) {
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
    
        if (isset($_POST['submit'])) {
            $this->db->where('comp_id', $id);
            $this->db->delete('active_mockpapers');
    
            if (!empty($_POST['mock_ids'])) {
                for ($i = 0; $i < count($_POST['mock_ids']); $i++) {
                    $mock_id = $_POST['mock_ids'][$i];
                    $maker_price = $_POST['mock_maker_price'][$i];
    
                    $mock = $this->db->get_where('mock_papers', array('paper_id' => $mock_id))->row();
    
                    if (!empty($mock)) {
                        $insert_data = array(
                            'comp_id' => $id,
                            'mock_id' => $mock->paper_id,
                            'maker_price' => $maker_price,
                            'status' => $mock->pay_status,
                            'type' => $mock->type
                        );
                        
                        // print_r($insert_data);die;
                        $this->db->insert('active_mockpapers', $insert_data);
                    }
                }
            }
        }
    
        $this->load->view("comp_mock_assign.php", $data);
    }

    
    public function comp_mat_assign() 
    {
        $id = $this->uri->segment(4);
        $data['id'] = $id;
    
        $data['result'] = $competition = $this->db->get_where('competition_product_state', array('id' => $id))->row();
    
        $data['assigned_materials'] = $this->db->get_where('active_materials', array('comp_id' => $id))->result();
    
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->where('period', $competition->period_id);
        $this->db->where('product_name', $competition->product_name);
        $this->db->where('clevel', $competition->clevel);
    
        if ($competition->product_name == 'Lunar Skill Test') {
            $this->db->where('sub_type', $competition->type);
            $this->db->where('series', $competition->series);
            $this->db->where('subject', $competition->subject);
        }
    
        $query = $this->db->get();
        $data['all_materials'] = $query->result();
    
        if (isset($_POST['back'])) {
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
    
        if (isset($_POST['submit'])) {
            $this->db->where('comp_id', $id);
            $this->db->delete('active_materials');
    
            for ($i = 0; $i < count($_POST['center_name']); $i++) {
                $material_id = $_POST['center_name'][$i];
                $maker_price = $_POST['maker_price'][$i];
    
                // Find matching study material to get details like type
                $material = $this->db->get_where('study_material', array('id' => $material_id))->row();
    
                if (!empty($material)) {
                    $insert_data = array(
                        'comp_id' => $id,
                        'mat_id' => $material_id,
                        'maker_price' => $maker_price,
                        'type' => $material->type,
                        'status' => $material->status
                    );
                    
                    // print_r($insert_data);die;
                    
                    $this->db->insert('active_materials', $insert_data);
                }
            }
        }
    
        $this->load->view("comp_mat_assign.php", $data);
    }    
    
    public function com_edit()
    {
        $id=$this->session->userdata('id');
        $data['id']= $id;
        // echo $id;
        $data['result']   = $this->db->get_where('competition_product_state',array('id'=>$id))->row_array();
        $competition   = $this->db->get_where('competition_product_state',array('id'=>$id))->row();
       // print_r($data['result']);die;
        if(isset($_POST['back'])){
            
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
        if(isset($_POST['submit'])){
            // echo '<pre>';
            // print_r($_POST);die;
            
            $ar = array(
                'period_id' => $this->input->post('period_id'),
                // 'crm_fix' => $this->input->post('crm_fix') ?? '',
                // 'crm_per'=> $this->input->post('crm_per'), 
                'product_name' => $this->input->post('product_name'),
                'clevel' => $this->input->post('clevel'),
                'revenue_setting_id' => $competition->revenue_setting_id,
                'country' => $this->input->post('country'),
                'state_id' => $this->input->post('state_id'),
                
                
                'bundle_a' => ($this->input->post('bundle_a') == 1)
                    ? 'study_material_a + orientation_a' : NULL,
                'bundle_b' => ($this->input->post('bundle_b') == 1)
                    ? 'study_material_b + orientation_b' : NULL,
                'bundle_c' => ($this->input->post('bundle_c') == 1)
                    ? 'study_material_c + orientation_c' : NULL,
                'bundle_d' => ($this->input->post('bundle_d') == 1)
                    ? 'study_material_d + orientation_d' : NULL,
                'bundle_e' => ($this->input->post('bundle_e') == 1)
                    ? 'study_material_e + orientation_e' : NULL,
                'bundle_f' => ($this->input->post('bundle_f') == 1)
                    ? 'study_material_f + orientation_f' : NULL,
                
                
                'study_material_a' =>
                    ($this->input->post('study_material_a') == 'on' )
                    ? 'study_material_a' : NULL,
            
                'study_material_b' =>
                    ($this->input->post('study_material_b') == 'on' )
                    ? 'study_material_b' : NULL,
            
                'study_material_c' =>
                    ($this->input->post('study_material_c') == 'on')
                    ? 'study_material_c' : NULL,
            
                'study_material_d' =>
                    ($this->input->post('study_material_d') == 'on' )
                    ? 'study_material_d' : NULL,
            
                'study_material_e' =>
                    ($this->input->post('study_material_e') == 'on' )
                    ? 'study_material_e' : NULL,
            
                'study_material_f' =>
                    ($this->input->post('study_material_f') == 'on')
                    ? 'study_material_f' : NULL,
            
            
                // Orientation
                'orientation_a' =>
                    ($this->input->post('orientation_a') == 1)
                    ? 'orientation_a' : NULL,
            
                'orientation_b' =>
                    ($this->input->post('orientation_b') == 1)
                    ? 'orientation_b' : NULL,
            
                'orientation_c' =>
                    ($this->input->post('orientation_c') == 1)
                    ? 'orientation_c' : NULL,
            
                'orientation_d' =>
                    ($this->input->post('orientation_d') == 1)
                    ? 'orientation_d' : NULL,
            
                'orientation_e' =>
                    ($this->input->post('orientation_e') == 1)
                    ? 'orientation_e' : NULL,
            
                'orientation_f' =>
                    ($this->input->post('orientation_f') == 1)
                    ? 'orientation_f' : NULL,
            
            
                // Mock Test
                'mock_test_a' =>
                    ($this->input->post('mock_test_a') == 1)
                    ? 'mock_test_a' : NULL,
            
                'mock_test_b' =>
                    ($this->input->post('mock_test_b') == 1)
                    ? 'mock_test_b' : NULL,
            
                'mock_test_c' =>
                    ($this->input->post('mock_test_c') == 1)
                    ? 'mock_test_c' : NULL,
            
                'mock_test_d' =>
                    ($this->input->post('mock_test_d') == 1)
                    ? 'mock_test_d' : NULL,
            
                'mock_test_e' =>
                    ($this->input->post('mock_test_e') == 1)
                    ? 'mock_test_e' : NULL,
            
                'mock_test_f' =>
                    ($this->input->post('mock_test_f') == 1)
                    ? 'mock_test_f' : NULL,
            );
        // print_r($ar); die;
            $this->db->where('id', $id);
            $this->db->update('competition_product_state', $ar);
            $data['message']='Details updated successfully..';
            $data['result'] = $_POST;
        }   
        
        $data['period']   = $this->db->get_where('period')->result_array();
	    $data['country']   = $this->db->get_where('countries')->result_array();
	    if(isset($data['result']['country'])){
	        $data['state']    = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
	    }
        $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        $this->load->view("com_edit.php", $data);
    }
    
    public function add_center()
    {
        $id=$this->session->userdata('id');
        $data['id']= $id;
        if(isset($_POST['back'])){
            
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
        
        if(isset($_POST['submit'])){
            $center_names = $_POST['center_name'];
            $center_addresses = $_POST['center_address'];
            $exam_dates = $_POST['exam_date'];
            $exam_times = $_POST['exam_time'];
        
            $valid_centers = array();
        
            // Loop through each center
            for($i = 0; $i < count($center_names); $i++) {
                // Check if center_name is not empty and other fields are not empty too
                if(!empty($center_names[$i])) {
                    // Add the center to the valid_centers array
                    $valid_centers[] = array(
                        'center_name' => $center_names[$i],
                        'center_address' => $center_addresses[$i],
                        'exam_date' => $exam_dates[$i],
                        'exam_time' => $exam_times[$i]
                    );
                }
            }

            foreach($valid_centers as $row){
                $row['comp_id'] = $id;
               // print_r($row);echo '<br>';
                $this->db->insert('exam_centers',$row);
            }
             redirect('manage/competitionshedule/competition_list');
        }

        
        $this->load->view("add_center.php", $data);
    }
    
    public function edit_closing() 
    {
        
        
        $id = $this->session->userdata('id');
        $data['stat'] = $stat = $this->db->get_where('closing_competition_details', array('competition_id' => $id))->row_array();
        
        if (isset($_POST['submit'])) {
            $ar = array(
                'orientation_a_time' => $this->input->post('orientation_a_time'),
                'orientation_a_date' => $this->input->post('orientation_a_date'),
                'orientation_b_time' => $this->input->post('orientation_b_time'),
                'orientation_b_date' => $this->input->post('orientation_b_date'),
                'orientation_c_time' => $this->input->post('orientation_c_time'),
                'orientation_c_date' => $this->input->post('orientation_c_date'),
                'mocktest_a_time' => $this->input->post('mocktest_a_time'),
                'mocktest_a_date' => $this->input->post('mocktest_a_date'),
            );
            // print_r($ar); die;
                    $this->db->where('competition_id', $id);
                    $this->db->update('closing_competition_details', $ar);
                    
                    //echo $this->db->last_query();die;
                    $data['message']='Details updated successfully..';
        }
        
        if (isset($_POST['back'])) {
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
    
        $this->load->view("edit_closing.php", $data);
    }
   
   
    public function pemplate()
    {
        $id = $this->uri->segment(4);
        $data = [];
    
        if (isset($_POST['submit']) && isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
            $originalName = pathinfo($_FILES['pdf']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
    
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
    
            $finalFileName = $safeName . '_' . time() . '.' . $extension;
    
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 512000;
            $config['file_name']     = $finalFileName;
    
            $this->load->library('upload', $config);
            
            // print_r($finalFileName);die;
            
            if ($this->upload->do_upload('pdf')) {
                $uploadData = $this->upload->data();
                $data['message'] = 'File uploaded successfully: ' . $uploadData['file_name'];
    
                $this->db->where('id', $id);
                $this->db->update('competition_product_state', ['pemplate' => $uploadData['file_name']]);
    
            } else {
                $data['message'] = 'Error: ' . $this->upload->display_errors();
            }
        } else {
            $data['message'] = 'Error: Select a valid PDF file to upload!';
        }
    
        $this->load->view("pemplate.php", $data);
    }
       
    public function edit_pemplate()
    {
        $id = $this->uri->segment(4);
        $data = [];
        
        
	    
        if (isset($_POST['submit'])){
            
            // print_r($_FILES);die;
            
            if (!empty($_FILES['pdf']['name']) && $_FILES['pdf']['error'] === 0) {
    
                $originalName = pathinfo($_FILES['pdf']['name'], PATHINFO_FILENAME);
                $extension = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
    
                $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
                $finalFileName = $safeName . '_' . time() . '.' . $extension;
    
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']      = 51200; // In KB => 50MB
                $config['file_name']     = $finalFileName;
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('pdf')) {
                    $uploadData = $this->upload->data();
    
                    $this->db->where('id', $id);
                    $this->db->update('competition_product_state', [
                        'pemplate' => $uploadData['file_name']
                    ]);
    
                    $data['message'] = 'File uploaded successfully: ' . $uploadData['file_name'];
                } else {
                    $data['message'] = 'Upload error: ' . $this->upload->display_errors('', '');
                }
            } else {
                $data['message'] = 'Please select a valid PDF file to upload.';
            }
            
            
        }
        
        
        $data['pemplate']    = $this->db->get_where('competition_product_state',array('id'=>$id))->row();
    
        $this->load->view('pemplate', $data);
    }

   
    public function pemplate_()
    {
        $id=$this->uri->segment(4);
        // echo $id;die;
        
        $data = [];

        if (isset($_POST['submit']) && isset($_FILES['pdf'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 512000;
            $config['file_name']     = time() . '_' . $_FILES['pdf']['name'];

            $this->load->library('upload', $config);
            
            print_r($config);die;

            if ($this->upload->do_upload('pdf')) {
                $uploadData = $this->upload->data();
                $data['message'] = 'File uploaded successfully: ' . $uploadData['file_name'];
                
                $this->db->where('id', $id);
                $this->db->update('competition_product_state', array('pemplate'=>$config['file_name']));
                
            } else {
                $data['message'] = 'Error: ' . $this->upload->display_errors();
            }
        } else {
            $data['message'] = 'Error: Select a PDF file to upload!';
        }

        $this->load->view("pemplate.php", $data);
    }


    
    public function add_cart($cin, $comp_id,$settlement_details,$insert_array,$message)
    {
        
        
        $total_amount=$insert_array['total_amount'];
        
        $insert_array['cin']=  $cin;
        // echo $message;die;
        // print_r($insert_array);die;
        
        $url="https://marrs.in/student_registration/welcome/payment_success/".$cin;
        
        $this->db->select('*');
        $this->db->from('cin_list');
        $this->db->where('cin', $cin);
        $query = $this->db->get();
        $student = $query->row();
        
        
        // Clean and normalize phone number
        $raw_phone = $student->stud_phone;
        $number = preg_replace('/\D/', '', $raw_phone); // Remove non-digits
        
        // Take only the last 10 digits assuming they're the local number
        $number = substr($number, -10);
        
        // Final format: +91XXXXXXXXXX
        $formatted_phone = '+91' . $number;

        
        // Prepare dynamic Cofee API payload
        $merchant_order_id = 'order_' . time().$cin; // unique ID
        $cofee_payload = [
            "branch_id" => "brch_g9oPkRKfBa1282",
            "amount" => $total_amount , // in rupee
            "currency" => "INR",
            "merchant_order_id" => $merchant_order_id,
            "order_purpose" => $message,
            "notify_customer" => true,
            "customer_details" => [
                "name" => $student->student_name, // Replace with dynamic name
                "email" => $student->stud_email, // Replace dynamically
                "mobile" => $formatted_phone, // Replace dynamically
                "customer_reference_id" => $cin
            ],
            
            
            "settlement_details" => $settlement_details,
            
            "order_items" => [
                [
                    "item_name" => $message,
                    "amount" => $total_amount
                ]
            ],
            "order_tags" => [
                "cin" => $cin,
                "competition_id" => $comp_id
            ],
            
            "redirect_url" => $url,
            "send_receipt_to_customer" => true
        ];
        
        // Cofee API call
        $ch = curl_init('https://partner-api.cofee.life/v1/payment-order');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($cofee_payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: CPNiTbPTwabiJ5ePapMQ3Pmqsk930UAH7OXQmJszimcSbx9M',
            'Authorization: Bearer CPNiTbPTwabiJ5ePapMQ3Pmqsk930UAH7OXQmJszimcSbx9M',
            'Content-Type: application/json',
            'Accept: application/json',
        ]);
        
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $cofee_response = json_decode($response, true);
        
        // print_r($cofee_response);die;
        
        if ($httpcode == 200 && isset($cofee_response['data']['payment_link'])) {
            // Save insert_array with payment_id for tracking
            $insert_array['payment_id'] = $merchant_order_id;
            $this->db->insert('payment_split', $insert_array);
            return ['status'=>1,'error'=>''];
        } else {
            // log_message('error', 'Cofee API failed: ' . json_encode($cofee_response));
            
            $log_array=['cin'=>$cin,'error'=>json_encode($cofee_response),"competition_id" => $comp_id,'date'=>date("Y-m-d"),'time'=>date("h:i:sa")];
            $this->db->insert('cofee_log', $log_array);
            
            return ['status'=>0,'error'=>$cofee_response['status']];
        }
        
    }

//     public function cin_upload()
// {
//     $id = $this->uri->segment(4);
//     $text = 'MaRRS SE Interschool';

//     // Fetch competition data
//     $this->db->select('*');
//     $this->db->from('competition_product_state');
//     $this->db->join('states', 'states.state_subdivision_id = competition_product_state.state_id');
//     $this->db->where('competition_product_state.id', $id);
//     $query = $this->db->get();
//     $data['competition'] = $competition = $query->row();

//     $this->db->select('*');
//     $this->db->from('competition_level_byproduct');
//     $this->db->where('product_name', $competition->product_name);
//     $this->db->where('level_id', $competition->clevel);
//     $query = $this->db->get();
//     $level = $query->row();

//     $message = $competition->product_name . ' Registration for ' . $level->level_name;

//     $state_id     = $competition->state_id;
//     $period_id    = $competition->period_id;
//     $clevel       = $competition->clevel;
//     $product_name = $competition->product_name;
//     $franchise_id = $competition->franchise_id;
//     $comp_id      = $competition->id;

//     $franchise_per  = $competition->com_per;
//     $aviansys_per   = $competition->com_peravian;
//     $manage_per     = $competition->manageper;
//     $franchise_gst  = $competition->franchise_gst;
//     $aviansys_gst   = $competition->aviansys_gst;
//     $crm_fix        = $competition->crm_fix;

//     $total_amount    = $competition->product_price;
//     $razpay_service  = 0;
//     $gross_settlement = $total_amount - $razpay_service;

//     // Base without GST
//     $base_cost = round($gross_settlement / 1.18, 6);
//     $GST       = $gross_settlement - $base_cost;

//     // Shares on base cost
//     $Franchise_pay  = round($base_cost * $franchise_per / 100, 6);
//     $Aviasys_pay    = round($base_cost * $aviansys_per / 100, 6);
//     $management_pay = round($base_cost * $manage_per / 100, 6);

//     // GST distribution
//     $GST_fr  = ($franchise_gst == 'yes') ? round($GST * $franchise_per / 100, 6) : 0;
//     $GST_av  = ($aviansys_gst == 'yes')  ? round($GST * $aviansys_per / 100, 6)  : 16.616;
//     $GST_rest = $GST - $GST_fr - $GST_av;

//     // Total to be credited
//     $total_AvianSys = $Aviasys_pay + $GST_av;
//     $total_Franchise = $Franchise_pay + $GST_fr;
//     $totalcut = $total_AvianSys + $total_Franchise + $management_pay;

//     // Remaining after all above
//     $MaRRS_bal = $base_cost - ($Franchise_pay + $Aviasys_pay + $management_pay);

//     // Round all values
//     $management_pay = round($management_pay);
//     $Franchise_pay  = round($Franchise_pay);
//     $Aviasys_pay    = round($Aviasys_pay);
//     $GST_Av         = round($GST_av);
//     $MaRRS_bal      = round($MaRRS_bal);
//     $rest_GST       = round($GST_rest);
//     $GST_fr         = round($GST_fr);

//     $totalFranchise_pay = $Franchise_pay + $GST_fr;
//     $totalAviasys_pay   = $Aviasys_pay + $GST_Av;

//     // Insert array build
//     $insert_array = [
//         'franchise_id'        => $franchise_id,
//         'clevel'              => $clevel,
//         'payment_id'          => '',
//         'total_amount'        => $total_amount,
//         'comp_id'             => $comp_id,
//         'razpay_service'      => $razpay_service,
//         'franchise_gst'       => $GST_fr,
//         'aviansys_gst'        => $GST_Av,
//         'crm_fix'             => $crm_fix,
//         'crm_fix_tranfer_id'  => '',
//         'gst_amount'          => $rest_GST,
//         'gst_tranfer_id'      => '',
//         'management_amount'   => $management_pay,
//         'management_tranfer_id' => '',
//         'franchise_amount'    => $Franchise_pay,
//         'franchise_tranfer_id' => '',
//         'aviansys_amount'     => $Aviasys_pay,
//         'aviansys_tranfer_id' => '',
//         'MaRRS_bal'           => $MaRRS_bal,
//         'date_of_payment'     => date("Y-m-d"),
//         'status'              => 0
//     ];

//     $settlement_details = [];
//     $settlement         = [];
//     $aviansys           = null; // FIX: initialize to avoid undefined variable

//     // Management pay
//     if ($management_pay > 0) {
//         $manage           = $this->db->get_where('gst_account_marrs', array('id' => '7'))->row();
//         $manage_account_id = $manage->cofee_account_id;
//         $settlement_details[] = [
//             "account_reference_id" => $manage_account_id,
//             "amount"               => $management_pay
//         ];
//         $settlement[] = [
//             "account_number" => $manage->account_number,
//             "amount"         => $management_pay,
//             'for'            => ' Management '
//         ];
//     }

//     // MaRRS GST
//     if ($rest_GST > 0) {
//         $gst            = $this->db->get_where('gst_account_marrs', array('id' => '1'))->row();
//         $gst_account_id = $gst->cofee_account_id;
//         $settlement_details[] = [
//             "account_reference_id" => $gst_account_id,
//             "amount"               => $rest_GST
//         ];
//         $settlement[] = [
//             "account_number" => $gst->account_number,
//             "amount"         => $rest_GST,
//             'for'            => ' MaRRS GST '
//         ];
//     }

//     // CRM Split
//     if ($crm_fix > 0) {
//         $gsts            = $this->db->get_where('gst_account_marrs', array('id' => '5'))->row();
//         $crm_account_id  = $gsts->cofee_account_id;
//         $settlement_details[] = [
//             "account_reference_id" => $crm_account_id,
//             "amount"               => $crm_fix
//         ];
//         $settlement[] = [
//             "account_number" => $gsts->account_number,
//             "amount"         => $crm_fix,
//             'for'            => ' CRM '
//         ];
//     }

//     // Franchise Split
//     if ($Franchise_pay > 0) {
//         $franchise          = $this->db->get_where('franchise', array('franchise_id' => $franchise_id))->row();
//         $franchiseaccount_id = $franchise->cofee_account_id;
//         $settlement_details[] = [
//             "account_reference_id" => $franchiseaccount_id,
//             "amount"               => $totalFranchise_pay
//         ];
//         $settlement[] = [
//             "account_number" => $franchise->account_number,
//             "amount"         => $totalFranchise_pay,
//             'for'            => ' Franchise '
//         ];
//     }

//     // AvianSys Split
//     if ($Aviasys_pay > 0) {
//         $aviansys          = $this->db->get_where('gst_account_marrs', array('id' => '2'))->row();
//         $aviansys_cofee_id = $aviansys->cofee_account_id;
//         $settlement_details[] = [
//             "account_reference_id" => $aviansys_cofee_id,
//             "amount"               => $totalAviasys_pay
//         ];
//         $settlement[] = [
//             "account_number" => $aviansys->account_number,
//             "amount"         => $totalAviasys_pay,
//             'for'            => ' AvianSys '
//         ];
//     }

//     // Calculate settlement total BEFORE diff check (FIX: moved rounding here)
//     $settlement_total = 0;
//     foreach ($settlement_details as $item) {
//         $settlement_total += $item['amount'];
//     }
//     $settlement_total = round($settlement_total); // FIX: round before comparison

//     // Diff — remaining goes to default MaRRS account
//     if ($settlement_total != $total_amount) {
//         $diff = $total_amount - $settlement_total;

//         if ($diff != 0) {
//             $default                  = $this->db->get_where('gst_account_marrs', array('id' => '6'))->row();
//             $default_cofee_account_id = $default->cofee_account_id;

//             $settlement_details[] = [
//                 "account_reference_id" => $default_cofee_account_id,
//                 "amount"               => $diff
//             ];
//             $settlement[] = [
//                 "account_number" => $default->account_number, // FIX: was $aviansys->account_number
//                 "amount"         => $diff,
//                 'for'            => ' Rest MaRRS '
//             ];
//         }
//     }

//     $data['message'] = '';

//     // ====================== CSV Upload ========================= //
//     if (isset($_POST['submit']) && isset($_FILES['csv']) && $_FILES['csv']['size'] > 0) {

//         $file = $_FILES['csv']['tmp_name'];
//         $ext  = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
//         $arr  = [];

//         if ($ext === 'csv') {

//             $handle = fopen($file, "r");
//             $i = 0;

//             while (($row = fgetcsv($handle, 1000)) !== false) {

//                 // FIX: Skip header row
//                 if ($i === 0) {
//                     $i++;
//                     continue;
//                 }
//                 $i++;

//                 // FIX: CIN is in column index 1, not 0. Also trim whitespace.
//                 $cin = trim(addslashes($row[1]));

//                 // Skip empty CIN values
//                 if (empty($cin)) {
//                     continue;
//                 }

//                 $paid = $this->db->get_where('new_cart', [
//                     'clevel' => $competition->clevel,
//                     'cin'    => $cin,
//                     'status' => 'Paid'
//                 ])->row();

//                 $unpaid = $this->db->get_where('payment_split', [
//                     'clevel' => $competition->clevel,
//                     'cin'    => $cin,
//                     'status' => 0
//                 ])->row();

//                 $ar = [
//                     'comp_id' => $id,
//                     'cin'     => $cin
//                 ];

//                 // Remove if CIN already uploaded
//                 $existing = $this->db->get_where('cin_uploade', [
//                     'comp_id' => $id,
//                     'cin'     => $cin
//                 ])->row();

//                 if ($existing) {
//                     $this->db->delete('cin_uploade', ['id' => $existing->id]);
//                 }

//                 if (isset($_POST['competition']) && $_POST['competition'] === 'on' && empty($unpaid)) {

//                     $re = $this->add_cart($cin, $id, $settlement_details, $insert_array, $text);

//                     if ($re['status'] == 1) {
//                         $this->db->insert('cin_uploade', $ar);
//                         $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . $re['error'] . ' Cofee Notification Sent Successfully.';
//                     } else {
//                         $ar['message'] = $re['error'] . ' No Cofee Notification Sent.';
//                     }

//                 } else {

//                     $this->db->insert('cin_uploade', $ar);
//                     $ar['message'] = ($existing ? 'Replaced CIN. ' : '') . 'CIN activated successfully for razorpay.';
//                 }

//                 $arr[] = $ar;
//             }

//             fclose($handle);

//             $data['ar']      = $arr;
//             $data['message'] = 'File uploaded successfully. Total CINs processed: ' . count($arr);

//         } else {
//             $data['message'] = 'Error: Not a CSV file.';
//         }
//     }

//     $this->load->view("cin_upload.php", $data);
// }

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


    
    
    public function cin_upload__()
    {
        $id = $this->uri->segment(4);
    
        // Fetch competition data
        $this->db->select('*');
        $this->db->from('competition_product_state');
        $this->db->join('states', 'states.state_subdivision_id = competition_product_state.state_id');
        $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
        $this->db->where('competition_product_state.id', $id);
        $query = $this->db->get();
        $data['competition'] = $competition = $query->row();
        
        
        
        // =====================================================================  //// 
        
        
        
       
        
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
        
        //  ===================================================================== //
        
    
        // Handle CSV upload
        if (isset($_POST['submit']) && isset($_FILES['csv'])) {
            if ($_FILES['csv']['size'] > 0) {
    
                $file = $_FILES['csv']['tmp_name'];
                $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
                $arr = [];
    
                if ($ext === 'csv') {
                    $handle = fopen($file, "r");
    
                    $i = 0;
                    $start_cell_row = 1; // To skip header row
    
                        $arr = [];
                        
                        while (($resultRow_from_csv = fgetcsv($handle, 1000)) !== false) {
                            if ($i >= $start_cell_row && !empty($resultRow_from_csv[0])) {
                                $cin = addslashes($resultRow_from_csv[0]);
                        
                                $ar = [
                                    'comp_id' => $id,
                                    'cin' => $cin
                                ];
                        
                                $res = $this->db->get_where('cin_uploade', ['comp_id' => $id, 'cin' => $cin])->row();
                                $competition=$this->db->get_where('competition_product_state', array('id' => $id))->row();
                                $pay = $this->db->get_where('payment_split', ['clevel' => $competition->clevel, 'cin' => $cin, 'status' => 0])->row();
                                
                                $paid = $this->db->get_where('new_cart', ['clevel' => $competition->clevel, 'cin' => $cin, 'status' => 'Paid'])->row();
                                
                                if (!$res or empty($paid)) {
                                    // echo 'ok';die;
                                    
                                    if (isset($_POST['competition']) && $_POST['competition'] == 'on') {
                                        
                                        if(empty($pay) ){
                                            
                                            
                                            $re = $this->add_cart($cin, $id,$settlement_details,$insert_array);
                                            
                                            // print_r($re['status']);die;
                            
                                            if ($re['status'] == 1) {
                                       
                                                $this->db->insert('cin_uploade', $ar);
                                                
                                        
                                                $ar['message'] = $re['error'].' Cofee Notification Sent Successfully.';
                                            } else {
                                                $ar['message'] = $re['error'].' No Cofee Notification Sent.';
                                            }
                                            
                                            
                                            
                                            
                                        }
                                        
                                        
                                        // else{
                                        //     $re = $this->add_cart($cin, $id);
                            
                                        //     if ($re == 1) {
                                        //         $this->db->insert('cin_uploade', $ar);
                                        //         $ar['message'] = 'Notification sent and CIN activated.';
                                        //     } else {
                                        //         $ar['message'] = 'CoFee notification could not be sent.';
                                        //     }
                                        // }
                                        
                                    } else {
                                        $this->db->insert('cin_uploade', $ar);
                                        $ar['message'] = 'CIN activated successfully.';
                                    }
                        
                                    
                                }
                                else{
                                    $ar['message'] = 'ERROR Already activated for this competition.';
                                }
                                
                                
                                $arr[] = $ar;
                                
                            }
                            
                            
                            
                            $i++;
                        }

                    fclose($handle);
    
                    $data['ar'] = $arr;
                    $data['message'] = 'File Uploaded successfully.';
                } else {
                    $data['message'] = 'Error: Not a CSV file.';
                }
            } else {
                $data['message'] = 'Error: CSV file is empty or not uploaded.';
            }
        } else {
            $data['message'] = 'Error: Form not submitted or file missing.';
        }
    
        // Load view
        $this->load->view("cin_upload.php", $data);
    }

    
    
    
    
    
    
    public function cin_upload_list()
    {
        $id=$this->uri->segment(4);
        // echo $id;die;
        if(isset($_POST['delete']))
        {
            // print_r($_POST);die;
            $this->db->where('comp_id',$id);
            $this->db->where('cin',$_POST['delete']);
            $this->db->delete('cin_uploade');
            $data['message']='Entry Deleted Successfully ...';
        }
        
        if (isset($_POST['delete_selected']) && !empty($_POST['delete_ids'])) 
        {
            $delete_ids = $_POST['delete_ids'];
            $this->db->where('comp_id', $id);
            $this->db->where_in('cin', $delete_ids);
            $this->db->delete('cin_uploade');
            $data['message'] = 'Selected entries deleted successfully.';
        }
        
//         if (isset($_POST['submit']) && isset($_FILES['csv'])) {
//                     // print_r($_FILES);die;
//                     if($_FILES['csv']['size'] > 0) 
//         			{   
//         				  //get the csv file 
//                 		$file = $_FILES['csv']['tmp_name']; 
//                 		$handle = fopen($file,"r"); 
//                 		$ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
//                 		$type = $_FILES['csv']['type'];
                		  
//                 		if($ext === 'csv')
//                 		{
                			  
        					  
//         					do
//         					{	
//         					if($i >= $start_cell_row)
//         					{ /*echo "<br>"; echo $i ."-". $resultRow_from_csv[0];*/
//         					    if($resultRow_from_csv[0]) 
//         					    { 
        						  
//         						    $cin  =  addslashes($resultRow_from_csv[0]);
        						  
        						   
//         						    $ar  =  array(   
//         						        'comp_id'  => $id, 
//         								'cin'  => $cin,
//         							);
//         				// 			print_r($ar);die;							 
//         						 $this->db->insert('cin_uploade',$ar);
//         					   }/*End if*/
        					   
//         					}
//         				    $i=$i+1;	
//         				}while($resultRow_from_csv = fgetcsv($handle,1000));
        				 
//         				$data['message']='CIN Uploaded successfully ....';
//         			}   
//         		    else{
//         				$data['message']='Not a csv file Error !!!';
//         			}
        					  
//         	}
//                 else{
// 				$data['message']='Error: Select File !!!';
// 			}
//         }
        
        
            if (isset($_POST['submit']) && isset($_FILES['csv'])) {
                if ($_FILES['csv']['size'] > 0) {
        
                    $file = $_FILES['csv']['tmp_name'];
                    $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
                    $arr = [];
        
                    if ($ext === 'csv') {
                        $handle = fopen($file, "r");
        
                        $i = 0;
                        $start_cell_row = 1; // To skip header row
        
                        while (($resultRow_from_csv = fgetcsv($handle, 1000)) !== false) {
                            if ($i >= $start_cell_row && !empty($resultRow_from_csv[0])) {
                                $cin = addslashes(trim($resultRow_from_csv[0]));
        
                                $ar = [
                                    'comp_id' => $id,
                                    'cin' => $cin
                                ];
        
                                $res=$this->db->get_where('cin_uploade',array('comp_id'=>$id,'cin'=>$cin))->row();
                                if(!$res){
                                    $this->db->insert('cin_uploade', $ar);
                                    $arr[] = $ar;
                                }
                            }
                            $i++;
                        }
        
                        fclose($handle);
        
                        // Feedback message after successful upload
                        $data['message'] = 'CIN Uploaded successfully.';
                    } else {
                        $data['message'] = 'Error: Not a CSV file.';
                    }
                } else {
                    $data['message'] = 'Error: CSV file is empty or not uploaded.';
                }
            }
        
        
        $this->db->select('*');
        $this->db->from('cin_uploade');
        $this->db->join('competition_product_state','competition_product_state.id=cin_uploade.comp_id');
        $this->db->join('states','states.state_subdivision_id=competition_product_state.state_id');
        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=competition_product_state.clevel');
        $this->db->where('competition_product_state.id',$id);
        $this->db->group_by('cin_uploade.cin');
        $query=$this->db->get();
        $data['cin_list']=$query->result();
            
        
        $this->load->view("cin_upload_list.php", $data);
    }
    
    
    public function unregistered_cin()
    {
        $id=$this->uri->segment(4);
        // echo $id;die;
        
        if($id > 145){
            $this->db->select('*');
            $this->db->from('cin_uploade');
            $this->db->join('cin_list','cin_list.cin=cin_uploade.cin');
            $this->db->where('comp_id',$id);
            // $this->db->where_not_in('product_name', ['MaRRS Skill Test']);
            $this->db->group_by('cin_uploade.cin');
            $query=$this->db->get();
            $cins=$query->result();
            // print_r($cins);die;
            
            echo $this->db->last_query();die;
        }else{
            $this->db->select('*');
            $this->db->from('competition_product_state');
            $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = competition_product_state.clevel');
            $this->db->where('competition_product_state.id', $id);
            $query = $this->db->get();
            $competition = $query->row();
            
            $medal = $competition->medal_no - 1;

            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('medal_no', $medal);
            $this->db->where('product_name', $competition->product_name);
            $query = $this->db->get();
            $level = $query->row();
            
            $clevel = $level->level_id;

            $this->db->select('cr.cin, cin_list.*');
            $this->db->from('cin_result as cr');
            $this->db->where('cr.clevel', $clevel);
            $this->db->where('cr.status', 'Q');
            
            $this->db->join('new_cart as nc', 'cr.cin = nc.cin AND nc.clevel = ' . $competition->clevel . ' AND nc.product_name = "' . $competition->product_name . '"', 'left');
            $this->db->join('cin_list', 'cin_list.cin = cr.cin'); // Fixed reference here
            $this->db->where('nc.cin IS NULL'); // Ensures only unregistered CINs are selected
            $this->db->where('nc.product_name', $competition->product_name);
            $this->db->where('nc.period_id', $competition->period_id);
            $query = $this->db->get();
            $unregistered_cins = $query->result();

            
        }
        
       if ($unregistered_cins > 0) {
                // Prepare data for CSV
                $headers = [
                    'Sr. No', 'Student Name', 'CIN', 'Total Pay Amount', 'Franchise Amount',
                    'Franchise GST', 'GST Amount', 'Management Amount', 'Razorpay Cut',
                    'MaRRs Left', 'Aviansys Amount', 'Aviansys GST'
                ];
    
                
                $data = [];
                $sr_no = 1;
    
                foreach ($unregistered_cins as $payment) {
                    $data[] = [
                        $sr_no++,
                        $payment['student_name'],
                        $payment['cin'],
                        $payment['product_name'],
                        $payment['school_name'],
                        $payment['stud_email'],
                        $payment['stud_phone'],
                        $payment['class'],
                        // $payment['razpay_service'],
                        // $payment['MaRRS_bal'],
                        // $payment['aviansys_amount'],
                        // $payment['aviansys_gst'],
                    ];
                    print_r($payment);die;
                }
    
                // Set headers for CSV download
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="student_list.csv"');
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
        
        // $this->load->view("cin_upload.php", $data);
    }
    
    
    public function edit_price()
    {
        $id=$this->session->userdata('id');
        //echo $id;die;
        $data['stat'] = $stat=$this->db->get_where('competition_product_state', array('id' => $id))->row_array();
            if(isset($_POST['submit'])){
                //print_r($_POST);die;
                
                $ar = array(
                    'product_price' => $_POST['product_price'] !== '' ? $_POST['product_price'] : $stat['product_price'],
                    'study_material_a_price' => $_POST['study_material_a_price'] !== '' ? $_POST['study_material_a_price'] : $stat['study_material_a_price'],
                    'study_material_b_price' => $_POST['study_material_b_price'] !== '' ? $_POST['study_material_b_price'] : $stat['study_material_b_price'],
                    'study_material_c_price' => $_POST['study_material_c_price'] !== '' ? $_POST['study_material_c_price'] : $stat['study_material_c_price'],
                    'orientation_a_price' => $_POST['orientation_a_price'] !== '' ? $_POST['orientation_a_price'] : $stat['orientation_a_price'],
                    'orientation_b_price' => $_POST['orientation_b_price'] !== '' ? $_POST['orientation_b_price'] : $stat['orientation_b_price'],
                    'orientation_c_price' => $_POST['orientation_c_price'] !== '' ? $_POST['orientation_c_price'] : $stat['orientation_c_price'],
                    'mock_test_price' => $_POST['mock_test_price'] !== '' ? $_POST['mock_test_price'] : $stat['mock_test_price'],
                );
                
                if($_POST['study_material_a_price']!=''){$ar['study_material_a'] = 'study_material_a';}
                if($_POST['study_material_b_price']!=''){$ar['study_material_b'] = 'study_material_b';}
                if($_POST['study_material_b_price']!=''){$ar['study_material_c'] = 'study_material_c';}
                if($_POST['orientation_a_price']!=''){$ar['orientation_a'] = 'orientation_a';}
                if($_POST['orientation_b_price']!=''){$ar['orientation_b'] = 'orientation_b';}
                if($_POST['orientation_c_price']!=''){$ar['orientation_c'] = 'orientation_c';}
                if($_POST['mock_test_price']!=''){$ar['mock_test'] = 'mock_test';}
                
                // print_r($ar);die;
                $this->db->where('id', $id);
                $this->db->update('competition_product_state', $ar);
                redirect('manage/competitionshedule/competition_list');
                
            }
            if(isset($_POST['back'])){
            
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
            
        $this->load->view("edit_price.php", $data); 
    }
    
    public function comp()
    {
        $id=$this->session->userdata('id');
        
        $data['comp_exam']=$comp_exam = $this->db->get_where('competition_dates', array('comp_id' => $id))->result();
        
        // print_r($comp_exam);die;
        
        if(empty($comp_exam)){
            
            if(isset($_POST['submit'])){
                
                $ar=array(
                    
                    'orientation_a_time'=>$this->input->post('orientation_a_time'),
                    'orientation_a_date'=>$this->input->post('orientation_a_date'),
                    'orientation_b_time'=>$this->input->post('orientation_b_time'),
                    'orientation_b_date'=>$this->input->post('orientation_b_date'),
                    'orientation_c_time'=>$this->input->post('orientation_c_time'),
                    'orientation_c_date'=>$this->input->post('orientation_a_date'),
                    'mocktest_a_time'=>$this->input->post('mocktest_a_time'),
                    'mocktest_a_date'=>$this->input->post('mocktest_a_date'),
                    'competition_id'=>$id
                    );
                // print_r($ar);die;
                $this->db->insert('closing_competition_details',$ar);
                
                for ($i = 1; $i <= 7; $i++) {
                        $arr = array(
                            'center_name' => $this->input->post('exam_center' . $i),
                            'exam_date' => $this->input->post('exam_date' . $i),
                            'exam_time' => $this->input->post('exam_time' . $i),
                            'center_address' => $this->input->post('exam_center_address' . $i),
                            'comp_id' => $id
                        );
    
                    if (!empty($arr['center_name'])) {
                        $this->db->insert('exam_centers', $arr);
                    }
                }
    
                $this->session->unset_userdata('id');
                redirect('manage/competitionshedule/competition_list');
            }
            
            $this->load->view("competition.php", $data);
            
        }else{
            if(isset($_POST['submit'])){
                $total = count($_POST['exam_date']);
    
                    for ($i = 0; $i < $total; $i++) {
                        $arr = array(
                            'center_name'     => $_POST['center_name'][$i],
                            'exam_date'       => $_POST['exam_date'][$i],
                            'exam_time'       => $_POST['exam_time'][$i],
                            'center_address'  => $_POST['center_address'][$i],
                            'comp_id'         => $id
                        );
                        
                    // print_r($arr);die;
                    
                    if (!empty($arr['center_name'])) {
                        $this->db->insert('exam_centers', $arr);
                    }
                }
                $this->session->unset_userdata('id');
                redirect('manage/competitionshedule/competition_list');
            }
            $this->load->view("competition1.php", $data);
        }
        
    }
    
    public function center()
    {
        $id=$this->session->userdata('id');
        $data['id']= $id;
        if(isset($_POST['back'])){
            
            $this->session->unset_userdata('id');
            redirect('manage/competitionshedule/competition_list');
        }
        
        if(isset($_POST['delete'])){
            $del=$_POST['delete'];
            $this->db->where('center_id',$del);
            $this->db->delete('exam_centers');
            
        }
        
        if(isset($_POST['edit'])){
            $del=$_POST['edit'];
            $this->session->set_userdata('center_id',$del);
            redirect('manage/competitionshedule/edit_center');
        }
        
        $this->load->view("center.php", $data);
    }
    
    public function edit_center()
    {
            $id = $this->session->userdata('center_id');
            $data['id'] = $id;
            
            if (isset($_POST['back'])) {
                redirect('manage/competitionshedule/center');
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
                redirect('manage/competitionshedule/center');
            }
        
            $this->load->view("edit_center.php", $data);
        }
        
        
    public function close_exam()    
    {
           
            $id=$this->uri->segment(4);
            $data['id'] = $id;
            
            if (isset($_POST['back'])) {
                redirect('manage/competitionshedule/center');
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
                redirect('manage/competitionshedule/center');
            }
        
            $this->load->view("close_exam.php", $data);
        }


    // public function updateCenterStatus_()
    // {
    //     $center_id = $this->input->post('center_id');
    //     $action = $this->input->post('action');
    
    //     print_r($_POST);die;
        
    //     if (empty($center_id) || empty($action)) {
    //         echo json_encode(['status' => 'error', 'message' => 'Missing center_id or action']);
    //         return;
    //     }
    
    //     // Expected actions format: close_material_a_close, close_material_a_open, etc
    //     $parts = explode('_', $action);
    
    //     if (count($parts) < 3) {
    //         echo json_encode(['status' => 'error', 'message' => 'Invalid action format']);
    //         return;
    //     }
    
    //     // Extract column name
    //     $column_name = $parts[0] . '_' . $parts[1] . '_' . $parts[2];
    
    //     // Handle revision special case
    //     if ($parts[0] == 'revision') {
    //         $column_name = 'revision';
    //         $status = ($parts[1] == 'close') ? 1 : 0;
    //     } else {
    //         $status = ($parts[3] == 'close') ? 1 : 0;
    //     }
    
    //     // Validate if column_name is allowed
    //     $allowed_columns = [
    //         'close_material_a', 'close_material_b', 'close_material_c',
    //         'close_orientation_a', 'close_orientation_b', 'close_orientation_c',
    //         'close_mock_a', 'close_mock_b', 'revision'
    //     ];
    
    //     if (!in_array($column_name, $allowed_columns)) {
    //         echo json_encode(['status' => 'error', 'message' => 'Invalid column']);
    //         return;
    //     }
    
    //     // Perform the update
    //     $update_data = [
    //         $column_name => $status
    //     ];
    
    //     $this->db->where('center_id', $center_id);
    //     $this->db->update('exam_close', $update_data);
    
    //     echo json_encode(['status' => 'success', 'message' => 'Center status updated']);
    // }





    public function mock_paper_upload()
    {
        //echo 'ok';die;
        
        
         if(isset($_POST['submit'])){
           
            // print_r($_POST);die;
             
            if($this->input->post('product_id')!='Select product'){    
               
            $target_path ="../mock_papers/";
                    
                    
               
                $file_name1     = $_FILES["folder1"]["name"];
    			$file_tmp_name1 = $_FILES["folder1"]["tmp_name"];
    		
                $upload_path_file1   = $target_path . $file_name1;

    			if (move_uploaded_file($file_tmp_name1, $upload_path_file1)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name1);
    			}
    			
    			else 
    			{ 
    			 //  $this->notifications->notify('file 1 cannot upload', 'error');  
    			
    	     	}
    	   //  	====================== file 2 ========================== //
    	     	$file_name2     = $_FILES["folder2"]["name"];
    			$file_tmp_name2 = $_FILES["folder2"]["tmp_name"];
    		    $upload_path_file2   = $target_path . $file_name2;
    			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name2);
    			}
    			
    			else 
    			{ 
    			 //  $this->notifications->notify('file 2 cannot upload', 'error');  
    			
    	     	}
    	   // =================================== file 3 ============================ //
    	   
    	     	$file_name3     = $_FILES["folder3"]["name"];
    			$file_tmp_name3 = $_FILES["folder3"]["tmp_name"];
    		    $upload_path_file3   = $target_path . $file_name3;
    			if (move_uploaded_file($file_tmp_name3, $upload_path_file3)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name3);
    			}
    			
    			else 
    			{ 
    			 //  $this->notifications->notify('file 3 cannot upload', 'error');  
    			
    	     	}
    	     	
    	     // =================================== file 4 ============================= //	
    	     	$file_name4     = $_FILES["folder4"]["name"];
    			$file_tmp_name4 = $_FILES["folder4"]["tmp_name"];
    		    $upload_path_file4   = $target_path . $file_name1;
                $upload_path_file4   = $target_path . $file_name4;

    			if (move_uploaded_file($file_tmp_name4, $upload_path_file4)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name4);
    			}
    			
    			else 
    			{ 
    			 //  $this->notifications->notify('file 4 cannot upload', 'error');  
    			
    	     	}
                   	    
				   
    		
            	 $product_id   = $this->input->post('product_id');
            	 
            	 $this->db->select('*');
        		 $this->db->from('products');
        		 $this->db->where('product_id',$product_id);
        		 $query = $this->db->get(); 
        		 //echo $this->db->last_query();
        	     $quer = $query->result_array();	
        	     $product_name=$quer[0]['product_name'];
            	 //echo $product_name;die;
            	
            	   	
            			$insert_data=array(
            								// 'title'      => $this->input->post('title'),
            								'period_id'     => $this->input->post('period'),
            								'clevel'  => $this->input->post('clevel'),
            								'class'   => $this->input->post('class'),
            								'folder1' => $file_name1,
            									'folder2' => $file_name2,
            										'folder3' => $file_name3,
            											'folder4' => $file_name4,
            								'status'   => 'Active',
            								'maker_price'   => $this->input->post('maker_price'),
            								'product_id'   => $this->input->post('product_id'),
            								'product_name'   => $product_name,
            								'paper_name'=>$_POST['paper_name'],
            								'subject'=>$_POST['subject'],
            								'sub_type'=>$_POST['varient'],
            								'series'=>$_POST['series']
            							   );
            							   
            	
            	       // echo "<pre>";print_r($insert_data);exit;
            			
            							
                        $insert_status = $this->db->insert('mock_papers',$insert_data);
            				
            				if(!empty($insert_status))
            				{
            					 $this->session->set_flashdata('success','Mock Paper saved successfully ...');
            					 $data['message']='Mock Paper saved successfully ...';
            				}
            				
            				if($insert_status=="no")
            				{
            					$this->session->set_flashdata('success','Duplicate or error in upload try again ...');
            					$data['message']='Duplicate or error in upload try again ...';
            				}
            			
            					
            
            	//	   echo $this->session->flashdata('success');die;
            
            	
            }else{
               // echo 'ok';die;
                $this->session->set_flashdata('success','Error: Select product.');
            //   echo $this->session->flashdata('success');
            //   die;
            }    
            
        }
        
        if(isset($_POST['delete'])){
            // echo $_POST['delete'];die;
            $this->db->where('paper_id',$_POST['delete']);
            $this->db->delete('mock_papers');
        }
        
        $this->db->select('*');
        $this->db->from('mock_papers');
        
        $this->db->order_by('paper_id','DESC');
        $this->db->limit('10');
        $query=$this->db->get();
        
        
         $data['list_materials'] = $query->result_array();
         
       $this->load->view("mock_paper.php",$data); 
    }

    public function mock_paper_upload_()
    {
        //echo 'ok';die;
        
        
         if(isset($_POST['submit'])){
           
           
             
            if($this->input->post('product_id')!='-- Select Product --'){    
                
                
                $target_path ="../mock_papers/";
                    
                    
               
                $file_name1     = $_FILES["folder1"]["name"];
    			$file_tmp_name1 = $_FILES["folder1"]["tmp_name"];
    		
                $upload_path_file1   = $target_path . $file_name1;

    			if (move_uploaded_file($file_tmp_name1, $upload_path_file1)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name1);
    			}
    			
    	   //  	====================== file 2 ========================== //
    	     	$file_name2     = $_FILES["folder2"]["name"];
    			$file_tmp_name2 = $_FILES["folder2"]["tmp_name"];
    		    $upload_path_file2   = $target_path . $file_name2;
    			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name2);
    			}
    			
    	   // =================================== file 3 ============================ //
    	   
    	     	$file_name3     = $_FILES["folder3"]["name"];
    			$file_tmp_name3 = $_FILES["folder3"]["tmp_name"];
    		    $upload_path_file3   = $target_path . $file_name3;
    			if (move_uploaded_file($file_tmp_name3, $upload_path_file3)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name3);
    			}
    			
    	     // =================================== file 4 ============================= //	
    	     	$file_name4     = $_FILES["folder4"]["name"];
    			$file_tmp_name4 = $_FILES["folder4"]["tmp_name"];
    		    $upload_path_file4   = $target_path . $file_name1;
                $upload_path_file4   = $target_path . $file_name4;

    			if (move_uploaded_file($file_tmp_name4, $upload_path_file4)) 
    			{ 
    				$question_file_path = addslashes($target_path . $file_name4);
    			}
    			
    		
            	 $product_id   = $this->input->post('product_id');
            	 
            	 $this->db->select('*');
        		 $this->db->from('products');
        		 $this->db->where('product_id',$product_id);
        		 $query = $this->db->get(); 
        		 //echo $this->db->last_query();
        	     $quer = $query->result_array();	
        	     $product_name=$quer[0]['product_name'];
            	 //echo $product_name;die;
                $class=$_POST['class'];
            	
            	
            	   //	print_r($_POST);die;
            	   	
            	   	foreach($class as $row){
            	   	    
            	   	        $a=explode('-',$_POST['status']); 
            	   	        $status=$a[0];
            	   	        $type=$a[1];
            	   	       // echo 'okddd'.$type;
            	           // print_r($_POST);die;
            	   	        
            	   	        
            			        $insert_data=array(
								// 'title'      => $this->input->post('title'),
								'period_id'     => $this->input->post('period'),
								'clevel'  => $this->input->post('clevel'),
								'class'   => $row,
								'folder1' => $file_name1,
								'folder2' => $file_name2,
								'folder3' => $file_name3,
								'folder4' => $file_name4,
								'status'   => 'Active',
								// 'maker_price'   => $this->input->post('maker_price'),
								'paper_name'   => $this->input->post('paper_name'),
								'product_name'   => $product_name,
								'mock_paper_maker_id'=>$_POST['mock_paper_maker_id'],
								'maker_price'=>$_POST['maker_price'],
								'subject'=>$_POST['subject'],
								'sub_type'=>$_POST['varient'],
								'series'=>$_POST['series'],
								'type'=>$type,
								'pay_status'=>$status,
            				);
            							   
            	
            	       // echo "<pre>";print_r($insert_data);exit;
            			
            							
                                    $insert_status = $this->db->insert('mock_papers',$insert_data);
                        	}
                        	   	
            				if(!empty($insert_status))
            				{
            					 $this->session->set_flashdata('success','Mock Paper saved successfully ...');
            					 $data['message']='Mock Paper saved successfully ...';
            				}
            				
            				if($insert_status=="no")
            				{
            					$this->session->set_flashdata('success','Duplicate or error in upload try again ...');
            					$data['message']='Duplicate or error in upload try again ...';
            				}
            			
            					
            
            	//	   echo $this->session->flashdata('success');die;
            
            	
            }else{
               // echo 'ok';die;
                $this->session->set_flashdata('success','Error: Select product.');
            //   echo $this->session->flashdata('success');
            //   die;
            }    
            
        }
        
        if(isset($_POST['delete'])){
            // echo $_POST['delete'];die;
            $this->db->where('paper_id',$_POST['delete']);
            $this->db->delete('mock_papers');
        }
        
        $this->db->select('*');
        $this->db->from('mock_papers');
        
        $this->db->order_by('paper_id','DESC');
        $this->db->limit('10');
        $query=$this->db->get();
        
        
         $data['list_materials'] = $query->result_array();
         
        $data['subjects']=$this->db->get_where('lunar_subjects',array('status'=>'Active'))->result(); 
         
       $this->load->view("mock_paper_.php",$data); 
    }
    
    
    

    public function mock_paper_search()
    {
        
        
        if(isset($_POST['submit']))
        {
                $this->db->select('product_name');
        		$this->db->from('products');
        		$this->db->where('product_id',$_POST['product_id']);
        		$query = $this->db->get();
        		$quer = $query->row();
                
            
            
                 $this->db->select('*');
        		 $this->db->from('mock_papers');
        		 $this->db->where('product_name',$quer->product_name);
        // 		 $this->db->where('period_id',$_POST['period']);
        		 if($_POST['clevel']!='All'){
        		     $this->db->where('clevel',$_POST['clevel']);
        		 }
        		 if($_POST['class']!=''){
        		     $this->db->where('class',$_POST['class']);
        		 }
        		 
        		 
        		 if($quer->product_name == 'Lunar Skill Test'){
        		 
            		if($_POST['subject']!='All' || !empty($_POST['subject'])){
            		    $this->db->where('mock_papers.subject',$_POST['subject']);
            		}
            		
            		if($_POST['varient'] !='All' || !empty($_POST['varient'])){
            		    $this->db->where('mock_papers.sub_type',$_POST['varient']);
            		}
            		if($_POST['series'] !='All' || !empty($_POST['series'])){
            		    $this->db->where('mock_papers.series',$_POST['series']);
            		}
        		 
        		 }
        		 
        		 $query = $this->db->get(); 
        		 
        // 		 echo $this->db->last_query();
        		 
        	     $quer = $query->result_array();	
        	     $data['list_materials']=$quer;
        	     $data['result']=$_POST;
        }
        
        
        
            if (isset($_POST['delete'])) {
                $id = $_POST['delete'];
            
                // Fetch details of the mock paper
                $this->db->select('*');
                $this->db->from('mock_papers');
                $this->db->where('paper_id', $id);
                $query = $this->db->get();
                $details = $query->row(); // Use row() instead of result() to get a single object
            
                if ($details) {
                    // Define the folder path
                    $folder_path = FCPATH . 'mock_papers/'; // FCPATH gives the root path like /var/www/html/
            
                    // List of folders to delete
                    $files = ['folder1', 'folder2', 'folder3', 'folder4'];
            
                    foreach ($files as $folder_field) {
                        if (!empty($details->$folder_field)) {
                            $file_path = $folder_path . $details->$folder_field;
            
                            if (file_exists($file_path)) {
                                unlink($file_path); // delete file
                            }
                        }
                    }
            
                    // Delete DB record
                    $this->db->where('paper_id', $id);
                    $this->db->delete('mock_papers');
            
                    $this->session->set_flashdata('success', 'Mock paper and associated files deleted successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Mock paper not found!');
                }
            
                //redirect('manage/competitionshedule/mock_paper_search');
            }

       
                $this->db->select('*');
        		$this->db->from('products');
        		$this->db->where('status','Active');
        		$query = $this->db->get();
        		$quer = $query->result_array();
                $data['productload']=$quer;
                
               
                
                if(isset($data['result']['product_id'])){
                    $this->db->select('*');
            		$this->db->from('competition_level_byproduct');
            		$this->db->where('product_id',$data['result']['product_id']);
            		$query = $this->db->get();
            		$quer = $query->result_array();
                    $data['levelload']=$quer;
                }
                
            $this->db->select('*');
    		$this->db->from('lunar_subjects');
    		$this->db->where('status','Active');
    		$query = $this->db->get();
    		$quer = $query->result();
            $data['subjects']=$quer;
            
            
        $this->load->view("mock_paper_search.php",$data);
    }
    
    public function mock_paper_maker()
    {
        
        
        if(isset($_POST['submit']))
        {
            // print_r($_POST);die;
            $ar=array(
                'name'=>$_POST['name'],
                'ifsc'=>$_POST['ifsc'],
                'account_number'=>$_POST['account_number'],
                'mobile'=>$_POST['mobile'],
                'email'=>$_POST['email'],
                'status'=>'Inactive'
                );
            $this->db->insert('mock_paper_maker',$ar);
        }
       
        if(isset($_POST['delete']))
        {
            // print_r($_POST);die;   
            $this->db->where('mock_paper_maker_id',$_POST['delete']);
            $this->db->delete('mock_paper_maker');
        }    
       
        $this->db->select('*');
		$this->db->from('mock_paper_maker');
// 		$this->db->where('status','Active');
        $this->db->order_by('mock_paper_maker_id','DESC');
		$query = $this->db->get();
		$quer = $query->result_array();
        $data['list_materials']=$quer;
                
                
        $this->load->view("mock_paper_maker.php",$data);
    }
    
    
    public function material_maker()
    {
        
        
        if(isset($_POST['submit']))
        {
            $ar=array(
                'name'=>$_POST['name'],
                'ifsc'=>$_POST['ifsc'],
                'account_number'=>$_POST['account_number'],
                'mobile'=>$_POST['mobile'],
                'email'=>$_POST['email'],
                'status'=>'Inactive',
                'gst'=>$_POST['gst']
                );
            $this->db->insert('material_maker',$ar);
            
          
        }
        
        if(isset($_POST['delete']))
        {
            // print_r($_POST);die;   
            $this->db->where('material_maker_id',$_POST['delete']);
            $this->db->delete('material_maker');
        } 
        
       
        $this->db->select('*');
		$this->db->from('material_maker');
// 		$this->db->where('status','Active');
        $this->db->order_by('material_maker_id','DESC');
		$query = $this->db->get();
		$quer = $query->result_array();
        $data['list_materials']=$quer;
                
                
        $this->load->view("mock_paper_maker.php",$data);
    }
    
}


