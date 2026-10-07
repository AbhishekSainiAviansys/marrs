<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class title extends CI_Controller {
    public function __construct() 
	{
        parent::__construct();
        $this->load->library('session');
		if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        }
    $this->load->library('form_validation'); 
        $this->load->library('validation');
        $this->load->library('form_validation');
        $this->load->model('serviceModel'); /*LIST ALL MARRS PRODUCTS*/
        $this->load->model('periodmodel');
        $this->load->model('titleModel');
		
   }/*end function __construct()*/
   
 /* ====================   =============================          =====================================  ==================== */
   
    public function index() 
	{    
	   
	 if (isset($_POST['Search'])) 
	    {
	    	 
	    	    $service_id=$this->input->post('service_id');
	    	 
             $params       = array( 'service_id' => $service_id,'status'=>'search');
             $data['list'] = $this->titleModel->listtitle($params);
             
        }
    else {
     /* $params       = array( );*/
      $data['list'] = $this->titleModel->listtitle($params);
    }
  
	      $data['services']       = $this->serviceModel->listservice(); 
         $data['service_id']     = $service_id;
         $this->load->view("titleList.php", $data);
    }
	
    
/* ====================   =============================          =====================================  ==================== */	
	
    public function add() 
	{
         
		 if (isset($_POST['submit']))
		 {
		 	
				$data   = array(
									    'service_id'   => $this->input->post('service_id'),
									    'title'        => $this->input->post('title')
								   );
			   
	     	   $this->form_validation->set_rules('service_id', 'service_id', 'required');
	     	   $this->form_validation->set_rules('title', 'title', 'required');
            if ($this->form_validation->run() === FALSE)
            {
                $this->notifications->notify('Please make all entries', 'error');
            } 			   
			  else
            {			   
						$params   = array(
									             'service_id'   => $this->input->post('service_id'),
									             'title'        => $this->input->post('title')
								           );
						
								$insert_status = $this->titleModel->insert($params);
								
								switch($insert_status)
								{
									case 1:
										  $this->notifications->notify('Title Saved successfully', 'success'); 
									break;
									
									case 0:
										  $this->notifications->notify('Sorry...Title Save Failed', 'error'); 
									break;
									
									case 3:
										  $this->notifications->notify('Sorry...Title Already exist', 'error'); 
									break; 
        	
								}
								 redirect('manage/title/add', 'refresh');
		}/*end if */
		}					
	       $data['services']       = $this->serviceModel->listservice();
	       $data['list']      = $_POST;
	       $data['mode']        = 'Add'; 
		   $this->load->view("titleAdd.php",$data);	
	}

/* ====================   =============================          =====================================  ==================== */



public function edit()
{
         $uri                   = $this->uri->uri_to_assoc(4);
         $title_id = $uri['id']; 
         if (isset($_POST['submit'])) 
         {
            $data = array
            (
                'service_id'   => $this->input->post('service_id'),
                'title'        => $this->input->post('title')  
            );
            
            $this->form_validation->set_rules('service_id', 'Service', 'required');
            $this->form_validation->set_rules('title','Title','required');
            
            if ($this->form_validation->run() === FALSE)
            {
                $this->notifications->notify('Please make all entries', 'error');
            } 			   
			  else
            {	
            	
            	$params=array('title_id'  =>$title_id,
            	              'service_id'   => $this->input->post('service_id'),
                             'title'        => $this->input->post('title'),          	
            	              );
                $insert_status = $this->titleModel->insert($params);
                switch($insert_status)
								{
									case 1:
										  $this->notifications->notify('Title Edited successfully', 'success'); 
									break;
									
									case 0:
										  $this->notifications->notify('Sorry...Title Save Failed', 'error'); 
									break;
									
									case 3:
										  $this->notifications->notify('Sorry...Title Already exist', 'error'); 
									break;
								  
        	
								}
								 redirect('manage/title/index', 'refresh');;
            }
            $data['list'] = $_POST;
        }
      
          $data['mode']        = 'Edit';        
          $data['services']       = $this->serviceModel->listservice();
          $params=array('mode'=>'Edit','title_id' =>$title_id);
          
          $data['list'] = $this->titleModel->listtitle($params);
		   $this->load->view("titleAdd.php",$data);

}
		
/* ====================   =============================          =====================================  ==================== */

public function changeStatus()
{
     $uri              = $this->uri->uri_to_assoc(4);
     $data['title_id'] = $uri['id'];
     $data['list']     = $this->titleModel->changeStatus($uri['id']);
     redirect('manage/title/index/', 'refresh');

}


/* ====================   =============================          =====================================  ==================== */


}//end class