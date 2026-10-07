<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        } 
		   $this->load->model('blogModel');
           $this->load->model('eventModel');
           $this->load->model('studentsModel');
           $this->load->model('schoolModel');
   }
   public function index() {
        $franchise_id=$this->session->userdata('franchise_id');
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$franchise_id);
        $query = $this->db->get(); 
        //echo $this->db->last_query();exit;
        $data['franchise']   = $query->row_array();
        
		/*$franchiseID=$this->session->userdata('franchise_id');
		
		$params  = array('franchiseID' => $franchiseID        );
        $totalstudent =	$this->studentsModel->listStudents($params);
        $data['tot_students']   = count($totalstudent);
		
		$params  = array('franchiseID' => $franchiseID        );
        $rstudent =	$this->studentsModel->list_new_registeration($params);
        $data['req_students']   = count($rstudent);
        /*$params  = array('status' => 'Pending', 'franchiseID' => $franchiseID  );
	    $rstudent =	$this->studentsModel->listStudents($params);
        $data['req_students']      =count($rstudent);*/
		
       /* $params        = array(        'fr_id' => $franchiseID      );
        $totalschool =	$this->schoolModel->listschool($params);
        $data['totalschool']        = count($totalschool);
		
        $params        = array(    'status' => 'Pending',     'fr_id' => $franchiseID     );
        $rschool =	$this->schoolModel->listschool($params);
        $data['rschool']        =count($rschool);
		
        $blog_post_val               = $this->blogModel->listblogPosts('yes', $instituteID);
        $data['blog_post']           = count($blog_post_val);
        $data['list_blog_post']      = $blog_post_val;
		
		
        $data['list_events']         = $this->eventModel->listeventPosts($instituteID);
        $data['tot_events']          = count($this->eventModel->listeventPosts($instituteID));*/
		
        $this->load->view("index.php", $data);
    }
}


