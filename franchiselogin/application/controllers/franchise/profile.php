<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Profile extends CI_Controller {
	
    public function __construct() {
		
        parent::__construct();
		$this->load->library('encrypt');
        $this->load->library('session');
		
       if (!$this->session->userdata('franchise_id')) 
	   {
            redirect('franchise/login/', 'refresh');
			
       } /* end of ifif (!$this->session->userdata('franchise_id')) */
		
       $this->load->library('form_validation');
       $this->load->library('validation');
       $this->load->model('franchisemodel');
	   $this->load->model('servicemodel');  /* LIST ALL MARRS PRODUCTS*/
	   $this->load->model('employeemodel'); 
	   $this->load->model('locationmodel');  /* FOR GETTING COUNTRY & STATE*/
       $this->load->model('usermodel');
        
    } 
	
	
/*  START FUNCTION FOR LIST ALL FRANCHISE DETAILS*/
    public function index()
	 {
		  $franchise_data['franchise_id']=$this->session->userdata('franchise_id');
		  $data['franchise']=$this->franchisemodel->getFranchiseProfile($this->session->userdata('franchise_id'));
		  $this->load->view('profileDetails',$data);
		/*$this->show();*/
	 }
	
/*/////////////////// START FOLLOWING FUNCTIONS  FOR  EDIT  /////////////////////////////////////////*/

public function edit() 
{
	   
		$uri = $this->uri->uri_to_assoc(4);
		$data['franchise_id'] = $uri['id'];
				if(isset($_POST['submit'])) 
				{
						$data     = array(
						
										/*	'service_id'            => $this->input->post('service_id'),
											'employee_id'           => $this->input->post('employee_id'),*/
											/*'country_id'	        => $this->input->post('country_id'),
											'state_id'              => $this->input->post('state_id'),*/
											'company_name'		  => $this->input->post('company_name'),
											'proprietary'		   => $this->input->post('proprietary'),
											'company_address'       => $this->input->post('company_address'),
											'landmark'              => $this->input->post('landmark'),
											'place'                 => $this->input->post('place'),
											'pincode'               => $this->input->post('pincode'),
											'province'              => $this->input->post('province'),
											'longitude'             => $this->input->post('longitude'),
											'latitude'              => $this->input->post('latitude'),
											'company_phno'          => $this->input->post('company_phno'),
											'company_mobno'         => $this->input->post('company_mobno'),
											'company_email_id'      => $this->input->post('company_email_id')
										);
			
                        /*$this->form_validation->set_rules('service_id', 'service', 'required');
					 	$this->form_validation->set_rules('employee_id', 'employee', 'required');
						$this->form_validation->set_rules('country_id', 'country', 'required');
						$this->form_validation->set_rules('state_id', 'state', 'required');*/
						$this->form_validation->set_rules('company_name', 'company name', 'alpha_space|required');
						$this->form_validation->set_rules('proprietary', 'proprietary name', 'alpha_space|required');
						$this->form_validation->set_rules('company_address', 'company_address', 'required');
						$this->form_validation->set_rules('landmark', 'landmark', 'required');
						$this->form_validation->set_rules('place', 'place', 'alpha_space|required');
						$this->form_validation->set_rules('pincode', 'pincode', 'required');
						$this->form_validation->set_rules('province', 'province', 'alpha_space|required');
						$this->form_validation->set_rules('company_phno', 'company phno', 'required');
						$this->form_validation->set_rules('company_mobno', 'company mobno', 'required');
						$this->form_validation->set_rules('company_email_id', 'company emailid', 'required');
		
						if ($this->form_validation->run() === FALSE) 
						{
							 echo validation_errors();
							 $this->notifications->notify('Please make all entries', 'error');
						} 
						else
						{
							$res = $this->franchisemodel->insert($data,$uri['id']);
							if($res)
							{
								$this->notifications->notify('Updated successfuly', 'succes');
							}/*END of if(res)*/
							else
							{
							  $this->notifications->notify('Updation Failed', 'error');	
							}/*END of else*/
							
							
							redirect('franchise/profile/', 'refresh');
									 /* $this->load->view('profileDetails',$data);*/
						}
				      $data['list'] = $_POST;
				}/*if(isset($_POST['submit']))*/
				else
				{
                   $data['list'] = $this->franchisemodel->getFranchiseProfile($uri['id']);
				}
        
		$data['countries']   = $this->locationmodel->listCountries();
        $data['stateatload'] = $this->locationmodel->getstateatload();
		$data['employee_franchise_list']=$this->employeemodel->employee_franchiseList();
               $this->load->view("franchiseAdd.php", $data);
} /*END OF EDIT*/


/*---------------------------------------------------------------------------------------------------------*/			


public function change_password () 
{
		 
		    $user= $this->session->userdata('franchise_id');
		    
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
               
            
               if ($this->validation->run() === FALSE) 
               {
         
                    $this->notifications->notify('Please make all entries', 'error');
               } 
               else 
               {
               	 
                     $data['status'] = $this->usermodel->change_password($data,$user,$status); 
                      if($data['status']==1)
                      {
                     	/* echo ('Password Changed Successfully');exit;*/
                          $this->notifications->notify('Password Changed Successfully', 'success'); 
                          redirect('franchise/profile/change_password', 'refresh');  
                      }
                     if($data['status']==2)
                     {
                         /*echo ('OOps Something Went wrongWrongr');exit;  */                        
                          $this->notifications->notify('OOps Something Went wrongWrong', 'error');  
                          redirect('franchise/profile/change_password', 'refresh');
                     }
                 
                     if($data['status']==3)
                     {
                     	/*echo ('Wrong Old Password');exit; */
                          $this->notifications->notify('Wrong Old Password', 'error'); 
                          redirect('franchise/profile/change_password', 'refresh'); 
                     }               
                     
               }
              
         
         } /*end of isset of submit*/
 $data['list'] = $_POST;
 $this->load->view("password.php", $data);      
} /*end function edit()*/ 
 
} /*END OF CLASS*/
		
