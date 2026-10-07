<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class user extends CI_Controller {
	/*$output = str_split($string,4);*/
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        }
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('userModel');
    }


 public function index() 
 
 { 
    
       $user=$this->session->userdata('user_id');
       if (isset($_POST['submit']))
        {
           $data      = array(
                               'opassword' => $this->input->post('opassword'),
                               'npassword' => $this->input->post('npassword'),
                               'cpassword' => $this->input->post('cpassword')
                             );

           $this->validation->set_data($data);
		
           $this->validation->set_rules('opassword', 'old password','required|trim|xss_clean|callback_change');
           $this->validation->set_rules('npassword', 'New password','required|trim|min_length[5]|max_length[12]');
           $this->validation->set_rules('cpassword', 'conform password','required|trim|matches[npassword]|min_length[5]|max_length[12]');
           $data['list'] = $_POST;
            if ($this->validation->run() === FALSE)
             {
         
                 $this->notifications->notify('Please make all entries', 'error');
             } 
            else 
            {
                 $data['status'] = $this->userModel->adminpassword($data,$user,$status);
                
                    if($data['status']==1)
                    {
                     	/* echo ('Password Changed Successfully');exit;*/
                          $this->notifications->notify('Password Changed Successfully', 'success'); 
                         
                    }
                    if($data['status']==2)
                    {
                         /*echo ('OOps Something Went wrongWrongr');exit;  */                        
                          $this->notifications->notify('OOps Something Went wrongWrong', 'error');  
                          
                    }
                    if($data['status']==3)
                    {
                     	/*echo ('Wrong Old Password');exit; */
                          $this->notifications->notify('Wrong Old Password', 'error'); 
                          
                    } 
                    
                  redirect('manage/user/', 'refresh');              
            } 

       }
        $this->load->view("password.php", $data);
}
}
