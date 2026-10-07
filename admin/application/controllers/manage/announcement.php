<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Announcement extends CI_Controller {
       public function __construct() 
       {
            parent::__construct();
            $this->load->library('session');
			$this->load->helper('form');
            $this->load->library('validation');
			$this->load->model('announcementmodel');
		    
			 if(!$this->session->userdata('user_id')) 
		     { redirect('manage/login/', 'refresh'); } 
				
    }/* end of class Announcement*/
	
	
	public function index(){
		
		$data['announcements']       = $this->announcementmodel->listAnnouncements();
		$this->load->view("announcementList.php",$data);
	
	}/*End of public function*/
	
	
	public function add_announcement()
	{
		
				
        if (isset($_POST['submit']))		
		{		

			$ins_data = array( 
								'content'  =>   $this->input->post(trim('content')),
								'status'   =>   $this->input->post('status'),
							 );
							 
				/*echo "<pre>";print_r($ins_data);exit;*/		 
			
			 $this->validation->set_data($ins_data);
	     	 $this->validation->set_rules('content', 'Content', 'trim|required');
	     	 $this->validation->set_rules('status', 'Status', 'required');
             if ($this->validation->run() === FALSE)
             {
                $this->notifications->notify('Please make all entries', 'error');
             } 
             else
             {
			
				$res = $this->announcementmodel->insert($ins_data);
				if($res)
				{  $this->notifications->notify('Announcement added Successfully', 'success');  }/*end of if */ 
				else
				{  $this->notifications->notify('Failed to add Announcement ', 'error');        }/*end of else*/
				
				 redirect('manage/announcement/index/', 'refresh');
				 
			 }
			  $data['result']=$_POST;
				 
	    }/*End of if*/

	     	$this->load->view("announcementAdd.php",$data);
    }/* End of function*/
	
	
	public function edit_announcement()
	{
		
		 $uri             = $this->uri->uri_to_assoc(2);
         $announcement_id     =  $uri['id'];
		
        if (isset($_POST['submit']))		
		{		

			$ins_data = array( 
								'content'  =>   $this->input->post(trim('content')),
								'status'   =>   $this->input->post('status'),
							 );
							 
			 $this->validation->set_data($ins_data);
	     	 $this->validation->set_rules('content', 'Content', 'trim|required');
	     	 $this->validation->set_rules('status', 'Status', 'required');
             if ($this->validation->run() === FALSE)
             {
                $this->notifications->notify('Please make all entries', 'error');
             } 
             else
             {
				$res = $this->announcementmodel->insert($ins_data,$announcement_id);
				if($res)
				{  $this->notifications->notify('Announcement Updated Successfully', 'success');  }/*end of if */ 
				else
				{  $this->notifications->notify('Failed to Update Announcement ', 'error');       }/*end of else*/
				
				redirect('manage/announcement/index/', 'refresh');
			 }
			$data['result']=$_POST; 
	    }/*End of if*/
            $data['result']      = $this->announcementmodel->getAnnouncement($announcement_id);
	     	$this->load->view("announcementAdd.php",$data);
    }/* End of function*/
	
	
	
	
	
 public function changeStatus()
	 {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['announcement_id'] = $uri['id'];
        $delete_status   = $this->announcementmodel->changeStatus( $data['announcement_id']);
		if($delete_status)
		{
			$this->notifications->notify('Announcement Deleted', 'success');
		}
		else
		{
			$this->notifications->notify('Failed to delete Announcement', 'error');
		}
        redirect('manage/announcement/index/', 'refresh');
    }
	
	
}/*End of class*/
?>