<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Login extends CI_Controller 
    {
        public function __construct() {
            parent::__construct();
             $this->load->library('encrypt');
            $this->load->library('session');
        }
        public function index() { 
        
            if (isset($_POST['submit'])) {
                 
                $this->load->model("loginModel");
                $result = $this->loginModel->loginCheck($_POST['username'],$_POST['password']);
                //print_r($result);die;
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('username', $result['username']);
                    
                    redirect('manage/index', 'refresh');
                   
                
            }
            $this->load->view("login.php");
        }
    
    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');
        $siteUrl = getenv('APP_BASE_URL');
        if ($siteUrl === FALSE || $siteUrl === '')
        {
            $siteUrl = 'https://marrs.in';
        }
        redirect(rtrim($siteUrl, '/') . '/', 'refresh');
    }
    
    public function resetpassword()
    {
       
       if(isset($_POST['submit'])){
         $email = $this->input->post('email');
         $this->db->select('*');
         $this->db->from('admin_user');
         $this->db->where('email',$email);
         $res = $this->db->get();
         $result = $res->row();
         $resultemail =  $result->user_id;
         if($resultemail){
            $this->session->set_flashdata('message', 'This Email is valid.');
            redirect('manage/login/updateResetPassword/'.$resultemail);
            }else{
            $this->session->set_flashdata('error', 'This Email is Not valid.'); 
            redirect('manage/login/resetpassword/');
           }
         
       }
     $this->load->view("resetpassword");
    }
    
     public function updateResetPassword()
    {
         $uri= $this->uri->segment(4);
         //print_r($uri);exit;
         if(isset($_POST['submit'])){
         $data = array('password'=>$this->input->post('password'));
         $this->db->where('user_id',$uri);
         $resultstatus = $this->db->update('admin_user',$data);
          if($resultstatus){
            $this->session->set_flashdata('success', 'Password Reset Successfully.');
            redirect('manage/login/');
            }else{
            $this->session->set_flashdata('error', 'Password Reset Failed.'); 
            redirect('manage/login/resetpassword/');
           }
         }
         
      $this->load->view("updateresetpassword");   
    }
    

    
    
}

