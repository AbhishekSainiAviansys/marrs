<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Category extends CI_Controller
 {
       public function __construct() 
       {
            parent::__construct();
            $this->load->library('session');
		     if (!$this->session->userdata('user_id')) 
		     {
                redirect('manage/login/', 'refresh');
           } 
		          $this->load->helper('form');
                 $this->load->library('validation');
                 $this->load->model('categorymodel');
                 $this->load->model('servicemodel');
       }
/* -------------------------------------------------------------------- */


   public function index()
   {
	    if (isset($_POST['Search']))
			 {
					$link = SITE_URL . "category/index/";
					if ($this->input->post('service_id')) {
						$link .= 'service_id/' . $this->input->post('service_id') . '/';
					}
					redirect($link, 'refresh');
			} /*END OF  if(isset($_POST['Search']))*/
            else 
			{ 
			   $uri = $this->uri->uri_to_assoc(4);
				if (isset($uri['service_id'])) { $service_id = $uri['service_id']; }
				else { $service_id = '';}
		   }
		    $params       = array( 'service_id' => $service_id);
			
			
        $data['services']       = $this->servicemodel->listservice();
		$data['list']    = $this->categorymodel->listCategory($params);
		 $data['service_id']     = $service_id;
        $this->load->view("categoryList.php", $data);
   } /*END OF FUNCTION INDEX()*/
   
/* -------------------------------------------------------------------- */

   /* public function view() NOT NEEDE BECUASE IN CATEGORY LISTIG IT SHOW FULL DATA
	 {
        $category_id     = $this->session->userdata('category_id');
        $uri             = $this->uri->uri_to_assoc(4);
        $category_id = $uri['id'];
        $data['mode']    = 'View';
        $data['category_view']    = $this->categorymodel->getCategory($category_id);
        $this->load->view("categoryView", $data);
    } /* END OF FUNCTION VIEW() */



/* -------------------------------------------------------------------- */
  
 public function add()
  {
       if (isset($_POST['submit']))
       {
		   $service_id = $this->input->post('service_id');
            $data     = array(
			                      'service_id' => $this->input->post('service_id'),
                                  'categoryKey' => $this->input->post('categoryKey'),
                                  'categoryDesc' => $this->input->post('categoryDesc'),
                            );
            
            $this->validation->set_data($data);
            $this->validation->set_rules('service_id','Service','required')	;		  
            $this->validation->set_rules('categoryKey', 'Category Key', 'required');
            $this->validation->set_rules('categoryDesc', 'Category Description', 'required');
            if ($this->validation->run() === FALSE)
             {
             	 echo  var_dump($this->validation->show_errors());
                 $this->notifications->notify('Please make all entries', 'error');
             } 
            else 
            {          
                
                 $insert_status= $this->categorymodel->insert($data);
				 if($insert_status)
				 {
					 $this->notifications->notify('Category added successfully', 'success'); 
				 }
				 else
				 {
					 $this->notifications->notify('Failed to add new category', 'error');
				 }
				              
                 redirect('manage/category/index/service_id/'.$service_id, 'refresh');            
           }
                     $data['result'] = $_POST;
        } /*END OF if (isset($_POST['submit'])) */
		   $data['mode']    = 'Add';
          $data['services']   = $this->servicemodel->listservice();
          $this->load->view("category_newAdd", $data);

    } /*END OF ADD FUNCTION/*/

/* -------------------------------------------------------------------- */

  
   public function edit() 
   {
        $uri             = $this->uri->uri_to_assoc(2);
        $category_id     =  $uri['id'];
		$service_id = $this->input->post('service_id');
        if (isset($_POST['submit']))
		 {
			 			 
             $data     = array(
                                   'service_id' => $this->input->post('service_id'),
                                   'categoryKey' => $this->input->post('categoryKey'),
                                   'categoryDesc' => $this->input->post('categoryDesc'),
                               );
		    $this->validation->set_data($data);		   
            /*$this->validation->set_rules('service_id','Service','required')	;*/		  
            $this->validation->set_rules('categoryKey', 'Category Key', 'required');
            $this->validation->set_rules('categoryDesc', 'Category Description', 'required');
            
            if ($this->validation->run() === FALSE)
             {
             	 echo  var_dump($this->validation->show_errors());
                 $this->notifications->notify('Please make all entries', 'error');
             } 
			else
			{
                $insert_status = $this->categorymodel->insert($data,$category_id);
				/*echo $insert_status;exit;*/
				if ($insert_status)
				{
					$this->notifications->notify('Category updated Successfully', 'success');

				}
				else
				{
					$this->notifications->notify('Updation failed', 'error');

				}
                redirect('manage/category/index/service_id/'.$service_id, 'refresh');
				
            }
		 }
		 
          $data['result']      = $this->categorymodel->getCategory($category_id);
		  $data['services']       = $this->servicemodel->listservice();

		  $data['mode']='Edit';
          $this->load->view("category_newAdd.php", $data);
		   
    } /*END OF EDIT FUNCTION*/
/* -------------------------------------------------------------------- */
    public function changeStatus()
	 {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['category_id'] = $uri['id'];
        $delete_status   = $this->categorymodel->changeStatus($uri['id']);
		if($delete_status)
		{
			$this->notifications->notify('Category Deleted', 'success');
		}
		else
		{
			$this->notifications->notify('Failed to delete category', 'error');
		}
        redirect('manage/category/index/', 'refresh');
    }



/* -------------------------------------------------------------------- */


   /* public function edit() {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
        $instituteID     = $this->session->userdata('instituteID');
       
        if (isset($_POST['submit'])) {
          $date     = $this->input->post('eventDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('eventDate')))):'';
            $fromdate = $this->input->post('displayFromDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayFromDate')))):'';
            $todate   = $this->input->post('displayToDate')!=''?date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('displayToDate')))):'';
            $data     = array(
                'eventTitle' => $this->input->post('eventTitle'),
                'eventDate' => $date,
                'eventStatus' => $this->input->post('eventStatus'),
                'event' => $this->input->post('event'),
                'instituteID' => $instituteID,
                'displayFromDate' => $fromdate,
                'displayToDate' => $todate
            );
            $this->validation->set_data($data);
            $this->validation->set_rules('eventTitle', 'Title of event', 'required');
            $this->validation->set_rules('eventDate', 'Event Date', 'required');
            $this->validation->set_rules('event', 'Event Specification', 'required');
            $this->validation->set_rules('eventStatus', 'Event Status', 'required');
            $this->validation->set_rules('displayFromDate', 'From date', 'required');
            $this->validation->set_rules('displayToDate', 'To date', 'required');
            if ($this->validation->run() === FALSE) {
                $this->notifications->notify('Please make all entries', 'error');
            } 
            else 
            {
                $res = $this->categorymodel->insert($data);
                redirect('manage/franchise/index/', 'refresh');
            }
        }
		  $data['mode']    = 'Edit';
        $data['list'] = $this->eventmodel->geteventPosts($instituteID, $uri['id']);
        $this->load->view("eventAdd.php", $data);
    }
    public function view() {
        $instituteID     = $this->session->userdata('instituteID');
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
        $data['mode']    = 'View';
        $data['list']    = $this->eventmodel->geteventPosts($instituteID, $uri['id']);
        $this->load->view("eventAdd", $data);
    }
    public function changeStatus() {
        $uri             = $this->uri->uri_to_assoc(4);
        $data['eventID'] = $uri['id'];
        $data['list']    = $this->eventmodel->changeStatus($uri['id']);
        redirect('manage/events/index/', 'refresh');
    }*/
}