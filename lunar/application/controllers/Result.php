<?php



class Result extends CI_Controller {
    
    
    public function __construct() {
        
        parent::__construct();
        
       // $cin = $this->session->userdata('cin');
        
		$this->load->library('session');
      
// 		$this->load->helper('form');
		
        
    }
    
    public function getsubjectvarient($id='')
    {
        $sub_id = $this->input->post('sub_id');
        $subject = $this->db->get_where('lunar_subjects',array('subject_key'=>$subject_key))->row();
        
        
        $data['lunar_varient'] = $this->db->get_where('lunar_varient',array('sub_id'=>$sub_id))->result_array();
        
		$this->load->view("lunar_varientselect.php",$data);  
    }
   
    
    public function result_view()
    {
        // print_r($_SESSION);die; 
         
        $cin = $this->session->userdata('cin');
        
        $data['cin'] = $cin;
            //  echo $cin;
        $data['student'] = $student =  $this->db->get_where('cin_list', array('cin' => $cin))->row_array();
             
        $data['result'] = [];

        // if(isset($_POST['search'])){ 
            
        if ($this->input->post('search')){
    
            echo 'kjjj';die;
            $this->session->set_userdata('cin',$data['cin']);

            echo 'ok';die;
            print_r($_POST);die;
              
            // $this->db->select('*');
            //     $this->db->from('cin_result');
            //     $this->db->join('competition_level_byproduct', 'competition_level_byproduct.level_id = cin_result.clevel');
            //     $this->db->where('cin_result.cin', $cin);
            //     $this->db->where('cin_result.status !=', '');
            //     $this->db->where('cin_result.clevel', $_POST['level']);
            //     $this->db->where('competition_level_byproduct.product_name=cin_result.product_name');
                
                
            //     $this->db->where('cin_result.subject', $_POST['subject']);
            //     $this->db->where('cin_result.type', $_POST['varient_name']);
            //     $this->db->where('cin_result.show != ', 'skip');
                
            //     $query = $this->db->get();
            //     // echo $this->db->last_query();exit;
            //     $d= $query->row_array();
            // $data['result_array']=$d;
            // $data['result'] = $_POST;
            
        }
            
        
            
            
            
	   // print_r($student);die;   
	    
            $this->db->select('level_id');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name','Lunar Skill Test');
            $this->db->order_by('level_id','ASC');
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $d= $query->result();  
           
         
                
                
                
            $this->db->select('*');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name','Lunar Skill Test');
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['levels']=$result_array= $query->result_array();
     
    
            $this->db->select('*');
            $this->db->from('lunar_subjects');
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['subjects']=$result_array= $query->result_array();
     
     
            if(isset($data['result']['subject'])){
                $this->db->select('*');
                $this->db->from('lunar_varient');
                $this->db->where('sub_id',$data['result']['subject']);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $data['varients']=$result_array= $query->result_array();
            }
    
            
    
            $this->db->select('series,subject,type');
            $this->db->from('cin_result');
            $this->db->where('product_name','Lunar Skill Test');
            $this->db->where('subject !=  ',null);
            $this->db->group_by('series');
            $query = $this->db->get();
            // echo $this->db->last_query();
            $data['series'] = $result_array = $query->result_array();
        
        
        
        $this->load->view('current_year/lunar_result_view.php',$data);
    }  
    
    
    public function result_view1()
    {
        

            $cin = $this->session->userdata('cin');
        
            $level   = $this->input->post('level', TRUE);
            $subject = $this->input->post('subject', TRUE);
            $type    = $this->input->post('varient_name', TRUE);
        
            $this->db->from('cin_result');
            $this->db->join(
                'competition_level_byproduct',
                'competition_level_byproduct.level_id = cin_result.clevel'
            );
        
            $this->db->where('cin_result.cin', $cin);
            $this->db->where('cin_result.status !=', '');
            $this->db->where('cin_result.clevel', $level);
            $this->db->where('competition_level_byproduct.product_name = cin_result.product_name');
            $this->db->where('cin_result.subject', $subject);
            $this->db->where('cin_result.type', $type);
            $this->db->where('cin_result.show !=', 'skip');
        
            $query = $this->db->get();
            
            echo $this->db->last_query();die;
    
            $data['result_array'] = $query->row_array();
            return $data['result'] = $this->input->post();
        
    }
    
    
}