<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class competitioncenter extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('locationmodel');
        $this->load->model('competitioncentermodel');
        $this->load->model('servicemodel');
        $this->load->model('competitionlevelmodel');
        $this->load->model('periodmodel');
		$this->load->model('franchisemodel');
    }
    public function index() 
    {
			 $fr_id     = $this->session->userdata('franchise_id');
			 if (isset($_POST['Search']))
			  {
					 $link = SITE_URL . "competitioncenter/index/";
					 if ($this->input->post('service_id')) { $link .= 'service_id/' . $this->input->post('service_id') . "/"; }
					 if ($this->input->post('competition_level_id')) { $link .= "competition_level_id/" . $this->input->post('competition_level_id') . "/";}
					 redirect($link, 'refresh');
			  } /* End of  if (isset($_POST['Search']))*/ 
			 else 
			 {
					$uri = $this->uri->uri_to_assoc(4);
					if (isset($uri['service_id'])) {$service_id = $uri['service_id'];} 
					else { $service_id = ''; }
					if (isset($uri['competition_level_id'])) { $competition_level_id = $uri['competition_level_id']; } 
					else {  $competition_level_id = ''; }
					$params = array(
										'service_id' => $service_id,
										'competition_level_id' => $competition_level_id,
										'frachise_id' => $fr_id,
										'role' => 'franchise'
								  );
					$data['list'] = $this->competitioncentermodel->listcompetition_center($params);
			}/* End of else (isset($_POST['Search']))*/ 
			
			$data['services'] = $this->servicemodel->listservice();
			$data['fr_id']       = $fr_id;
			$this->load->view("competitioncenterList.php", $data);
    }/* End of  index()  */
	
/* ------------------------------------------------------------------------------------*/	
	
 public function add()
 {
		$data['competition_centre_id'] = '';
		if (isset($_POST['submit'])) 
		{
				  $data = array(
								  'center_name' => $this->input->post('center_name'),
								  'center_address' => $this->input->post('center_address'),
								  'state_id' => $this->input->post('state_id'),
								  'country_id' => $this->input->post('country_id'),
								  'franchise_id' => $this->session->userdata('franchise_id'),
								  'center_latitude' => $this->input->post('center_latitude'),
								  'center_longitude' => $this->input->post('center_longitude'),
							  );
						//	  print_r($data);die;
				  $datas = array(
								  'center_name' => $this->input->post('center_name'),
								  'center_address' => $this->input->post('center_address'),
								  'center_latitude' => $this->input->post('center_latitude'),
								  'center_longitude' => $this->input->post('center_longitude'),
							   );
							   //print_r($datas);die;
				  $this->validation->set_data($datas);
				  $this->validation->set_rules('center_name', 'center name', 'required');
				  $this->validation->set_rules('center_address', 'center_address', 'required');
				  $this->validation->set_rules('center_latitude', 'latitude', 'required');
				  $this->validation->set_rules('center_longitude', 'longitude', 'required');
				  if ($this->validation->run() === FALSE) {  $this->notifications->notify('Please make all entries', 'error');  } 
				  else 
				  {//echo 'okkk';die;
					  $res = $this->competitioncentermodel->insert($data);
					  if($res) {  $this->notifications->notify('competition center added successfully', 'success');  }
					  else     {  $this->notifications->notify('competition center added Failed', 'error');  }
					  redirect('franchise/competitioncenter/index/', 'refresh');
				   } /*End of else of validation */
		   } /*End of if (isset($_POST['submit']))*/
		   
		   $data['mode']        = 'Add';
		   $data['franchiseState']   = $this->franchisemodel->Get_FranchiseState($this->session->userdata('franchise_id'));
		   $data['result']      = $_POST;
		   $this->load->view("competitioncenterAdd.php", $data);
   } /* End of function add() */
	
/* ------------------------------------------------------------------------------------*/	

 public function edit()
 {
     $uri                   = $this->uri->uri_to_assoc(4);
     $competition_centre_id = $uri['id'];
     if (isset($_POST['submit']))
	  {
            $data = array(
							'center_name' => $this->input->post('center_name'),
							'center_address' => $this->input->post('center_address'),
							'state_id' => $this->input->post('state_id'),
							'country_id' => $this->input->post('country_id'),
							'center_latitude' => $this->input->post('center_latitude'),
							'center_longitude' => $this->input->post('center_longitude')
                        );
            $this->validation->set_data($data);
            $this->validation->set_rules('center_name', 'center name', 'required');
			$this->validation->set_rules('center_address', 'center_address', 'required');
            $this->validation->set_rules('state_id', 'state', 'required');
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('center_latitude', 'latitude', 'required');
            $this->validation->set_rules('center_longitude', 'longitude', 'required');
            if ($this->validation->run() === FALSE) { $this->notifications->notify('Please make all entries', 'error'); } 
			else 
			{
            	
                $res = $this->competitioncentermodel->insert($data, $competition_centre_id);                
					if($res)
					{
						$this->notifications->notify('competition center updated successfully', 'success');
						
					}
					else
					{
							$this->notifications->notify('competition center updation Failed', 'error');
					}

                redirect('franchise/competitioncenter/index/', 'refresh');
            }
            $data['result'] = $_POST;
        }
        $data['mode']        = 'Edit';
        $data['franchiseState']   = $this->franchisemodel->Get_FranchiseState($this->session->userdata('franchise_id'));
        $data['result']      = $this->competitioncentermodel->getcompetitioncenter($competition_centre_id);
        $this->load->view("competitioncenterAdd.php", $data);
    }
    /*public function view() {
    $instituteID     = $this->session->userdata('instituteID');
    $uri             = $this->uri->uri_to_assoc(4);
    $data['eventID'] = $uri['id'];
    $data['mode']    = 'View';
    $data['list']    = $this->eventmodel->geteventPosts($instituteID, $uri['id']);
    $this->load->view("eventAdd", $data);
    }*/
    public function changeStatus() {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $competition_centre_id = $uri['id'];
            $this->notifications->notify('competition center Deleted successfully', 'success');
            $this->competitioncentermodel->changeStatus($competition_centre_id);
            redirect('franchise/competitioncenter/index/', 'refresh');
        }
    }
	
	
/* public function show_levels() {
	 
	 $service_id = $this->input->post('service_id');
	 $data['levels']   =  $this->competitionlevelmodel->listcompetitionlevel($service_id);
	 $this->load->view("showLevels.php", $data);
 }/*end function show_levels()*/

}