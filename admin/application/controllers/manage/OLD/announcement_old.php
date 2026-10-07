<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class announcement extends CI_Controller {
       public function __construct() 
       {
            parent::__construct();
            $this->load->library('session');
		     if(!$this->session->userdata('user_id')) 
		     { redirect('manage/login/', 'refresh'); } 
				          $this->load->helper('form');
                 $this->load->library('validation');

    }/* end of class Announcement*/
	
	public function add_announcement()
	{
		if(isset($_post['announce_submit']))
		{
			$ins_data = array( 
								'period'   =>   $this->input->post('period'),
								'heading'  =>   $this->input->post('heading'),
								'content'  =>   $this->input->post('content'),
								'status'   =>   $this->input->post('status'),
							 );
			$res = $this->franchisemodel->insert($ins_data);
			if($res)
			{  $this->notifications->notify('Franchise added Successfully', 'success');  }/*end of if */ 
			else
			{  $this->notifications->notify('Failed to add franchise ', 'error');        }/*end of else*/
			
			redirect('manage/franchise/index/', 'refresh');
	    }/*End of if*/
		$this->load->view("announcementAdd.php");
    }/* End of function*/
	
}/*End of class*/
?>