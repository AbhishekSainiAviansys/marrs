<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class downloads extends CI_Controller 
{
    public function __construct() 
	{
        parent::__construct();
        $this->load->library('session');
		if (!$this->session->userdata('user_id')) {redirect('manage/login/', 'refresh');} 
        $this->load->library('validation');
		$this->load->library('form_validation');
        $this->load->model('servicemodel'); /*LIST ALL MARRS PRODUCTS*/
        $this->load->model('periodmodel');
		$this->load->model('franchisemodel');
        $this->load->model('titlemodel');
        $this->load->model('downloadsmodel');
        $this->load->model('categorymodel');
        $this->load->model('competitionlevelmodel');
    }/*end function __construct()*/
   
    public function index() 
	{    
         $data['list'] = $this->downloadsmodel->listdownloads();
         $this->load->view("downloadsList.php", $data);
    }

/* ---------------------- ----------------------------------------------------------------------- */	
    public function listDetails() 
	{   
	      $service_id=$this->input->post('service_id');
	      $params= array('service_id'  =>  $service_id ,'status' => 'download');
          $data['title'] = $this->titlemodel->listtitle($params);
          $data['category'] = $this->categorymodel->listCategory($params);
          $data['levels']=$this->competitionlevelmodel->listcompetitionlevel($params);
		 /* echo "<pre>"; print_r(  $data['levels']);exit;*/
		  $this->load->view("show_details.php", $data);
	  
	}/*end function listDetails*/
	
/* ---------------------- ----------------------------------------------------------------------- */	

 public function upload() 
{    
   if(isset($_POST['submit_upload']))
	{
		   $target_path = getcwd() . "/public/uploads/study_materials/";
		   $target_path1 ="public/uploads/study_materials/";
		   echo $_FILES['file_path']['name'];exit;
		   if ($_FILES['file_path']['name'] != '')
		   {
					$file_name     = $_FILES["file_path"]["name"];
					$file_size     = $_FILES["file_path"]["size"] / 1024;
					$file_type     = $_FILES["file_path"]["type"];
					$file_tmp_name = $_FILES["file_path"]["tmp_name"];
					$new_file_name = $file_name;
					$upload_path   = $target_path . $new_file_name;
					if (move_uploaded_file($file_tmp_name, $upload_path))
					{
							$file_path = addslashes($target_path1 . $new_file_name);
							
							$data   = array(
											'period_id' => $this->input->post('period_id'),
											'service_id' => $this->input->post('service_id'),
											'title_id' => $this->input->post('title_id'),
											'category_id' => $this->input->post('category_id'),
											'competition_level_id' => $this->input->post('competition_level_id'),
											'file_path' =>  $file_path
									   );
							$this->form_validation->set_rules('period_id', 'Period', 'required');
							$this->form_validation->set_rules('service_id', 'Service', 'required');
							$this->form_validation->set_rules('title_id','Title','required');
							$this->form_validation->set_rules('category_id', 'Category', 'required');
							$this->form_validation->set_rules('competition_level_id', 'Competition Level_id', 'required');
							if($this->form_validation->run() === FALSE) 
							{
									$this->notifications->notify('Please make all entries', 'error');		   
							} /*  end if  */
							else
							{
								$insert_status = $this->downloadsmodel->insert($data);
								switch($insert_status)
								{
									case 1:
											 $this->notifications->notify('Study materials Added successfully', 'success'); 
									break;
									case 0:
											 $this->notifications->notify('Sorry...Cannot save Study materials ', 'error'); 
									break;
									case 3:
											 $this->notifications->notify('This Study materials already exist', 'error'); 
									break;
								}/* end switch*/
						    }
					} 
					else { $this->notifications->notify('study materials  cannot upload..allowed  max size photo 1MB  ', 'error'); }
		    }/* end if ($_FILES['file_path']['name'] != '') */
		   else
		   { $this->notifications->notify("already exist", 'error');  }
		  /*redirect('manage/downloads/', 'refresh');*/
   }//end if post[submit]
   
    $data['period']=$this->periodmodel->listperiod();       
    $data['services'] = $this->servicemodel->listservice();
    $this->load->view("upload_files.php", $data);
	
}/*end function upload*/
/* ---------------------- ----------------------------------------------------------------------- */	

public function routemap()
{
	
	if(isset($_POST['submit_routemap']))
	{
		   $target_routemap_path = getcwd() . "/public/uploads/routemap/";
		   $target_routemap_path1 ="public/uploads/routemap/";
		   if ( $_FILES['file_path']['name'] != '')
		   {
					
					$file_name     = $_FILES["file_path"]["name"];
					$file_size     = $_FILES["file_path"]["size"] / 1024;
					$file_type     = $_FILES["file_path"]["type"];
					$file_tmp_name = $_FILES["file_path"]["tmp_name"];
					$new_file_name = $file_name;
					$upload_path   = $target_routemap_path . $new_file_name;
					if (move_uploaded_file($file_tmp_name, $upload_path))
					{
							$file_path = addslashes($target_routemap_path1 . $new_file_name);
							
							$data   = array(
											'period_id' => $this->input->post('period_id'),
											'competition_level_id' => $this->input->post('competition_level_id'),
											'franchise_id' => $this->input->post('franchise_id'),
											'description' => $this->input->post('description'),
											'file_path' =>  $file_path
									   );
									  
							$this->form_validation->set_rules('period_id', 'Period', 'required');
							$this->form_validation->set_rules('franchise_id', 'Franchise', 'required');
							$this->form_validation->set_rules('description','Description','required');
							$this->form_validation->set_rules('competition_level_id', 'Competition Level_id', 'required');
							if($this->form_validation->run() === FALSE) 
							{
									$this->notifications->notify('Please make all entries', 'error');		   
							} /*  end if  */
							else
							{
								
								$insert_status = $this->downloadsmodel->insert_routemap($data);
								switch($insert_status)
								{
									case 1:
											 $this->notifications->notify('Routemap  Added successfully', 'success'); 
									break;
									case 0:
											 $this->notifications->notify('Sorry...Cannot save Routemap', 'error'); 
									break;
									case 3:
											 $this->notifications->notify('This Routemap already exist', 'error'); 
									break;
								}/* end switch*/
						    }
					} 
					else { $this->notifications->notify('Routemap  cannot upload..allowed  max size photo 1MB  ', 'error'); }
		    }/* end if ($_FILES['file_path']['name'] != '') */
		   else
		   { echo  $this->notifications->notify("already exist", 'error');  }
		  redirect('manage/downloads/routemap_view', 'refresh');
   }//end if post[submit]
	
	$params=array('service_id' =>'1');
    $data['period']=$this->periodmodel->listperiod();  
	$data['level']=$this->competitionlevelmodel->listcompetitionlevel($params); 
	$data['franchise']   = $this->franchisemodel->listFranchise();
    $data['mode']='Add';
	$this->load->view("routemap.php",$data);
	
	
}/*end function routemap*/
/* ---------------------- ----------------------------------------------------------------------- */	

public function routemap_view()
{
	if (isset($_POST['Search'])) 
	  {
		  $link=SITE_URL."downloads/routemap_view/";
		  if($this->input->post('period_id')){  $link.='period_id/'.$this->input->post('period_id')."/"; }
		  if($this->input->post('competition_level_id')) { $link.="competition_level_id/".$this->input->post('competition_level_id')."/"; }
		  if($this->input->post('franchise_id')){ $link.="franchise_id/".trim($this->input->post('franchise_id'))."/"; }
		  $link = rawurldecode($link);
		  redirect($link, 'refresh');
	  } /* End of if (isset($_POST['Search'])) */  
	  else
	  {
		 $uri=$this->uri->uri_to_assoc(4);  
		 if(isset($uri['period_id'])) {  $period_id=$uri['period_id'];  }
		 else{  $period_id='';  }
		 if(isset($uri['competition_level_id'])) { $competition_level_id=$uri['competition_level_id']; }
		 else{  $competition_level_id='';  }
		 if(isset($uri['franchise_id'])) {  $franchise_id=$uri['franchise_id'];  }
		 else{  $franchise_id='';  }
		 $params = array(
						  'period_id'       =>  $period_id,
						  'competition_level_id'     => $competition_level_id,
						  'franchise_id' => $franchise_id
                        );
        $data['list']= $this->downloadsmodel->list_routemap($params);   
		} /* Else of  if (isset($_POST['Search']))*/
	
	$data['period']=$this->periodmodel->listperiod();  
	$data['level']=$this->competitionlevelmodel->listcompetitionlevel($params); 
	$data['franchise']   = $this->franchisemodel->listFranchise();
	$data['period_id']=$period_id;
	$data['competition_level_id']=$competition_level_id;
	$data['franchise_id']=$franchise_id;

	$this->load->view("list_routemap.php",$data);
	
} /* end of routemap_edit*/

/* ---------------------- ----------------------------------------------------------------------- */	

public function routemap_edit()
{
	$uri=$this->uri->uri_to_assoc(4);
	$routemap_id=$uri['id'];
	$params=array('routemap_id' =>$routemap_id,'aim'  => 'Edit');
	if(isset($_POST['submit_routemap']))
	{
		 
							 
         $this->form_validation->set_rules('period_id', 'Period', 'required');
         $this->form_validation->set_rules('competition_level_id', 'Level', 'required');
         $this->form_validation->set_rules('franchise_id', 'Franchise', 'required');
         $this->form_validation->set_rules('description', 'Description', 'required');
         if ($this->form_validation->run() === FALSE)
		 {
               $this->notifications->notify('Please make all entries', 'error');   echo 	var_dump($this->validation->show_errors());
         } 
		 else 
		 {	
		    $target_routemap_path = getcwd() . "/public/uploads/routemap/";
		    $target_routemap_path1 ="public/uploads/routemap/";
		    if ( $_FILES['file_path']['name'] != '')
		    {
					
					$file_name     = $_FILES["file_path"]["name"];
					$file_size     = $_FILES["file_path"]["size"] / 1024;
					$file_type     = $_FILES["file_path"]["type"];
					$file_tmp_name = $_FILES["file_path"]["tmp_name"];
					$new_file_name = $file_name;
					$upload_path   = $target_routemap_path . $new_file_name;
					if (move_uploaded_file($file_tmp_name, $upload_path))
					{
							$file_path = addslashes($target_routemap_path1 . $new_file_name);
							$data= array(
							                      'routemap_id'              =>$routemap_id,
												  'period_id'                =>  $this->input->post('period_id'),
												  'competition_level_id'     =>  $this->input->post('competition_level_id'),
												  'franchise_id'             =>  $this->input->post('franchise_id'),
												  'description'              =>  $this->input->post('description'),
												  'file_path'                =>  $file_path,
												  
		                                     );
                            $update_status = $this->downloadsmodel->insert_routemap($data,$routemap_id);
							switch($update_status)
							{
							  case 1:
									 $this->notifications->notify('Routemap  Added successfully', 'success'); 
							  break;
							  case 0:
									 $this->notifications->notify('Sorry...Cannot save Routemap', 'error'); 
							  break;
							  case 3:
									 $this->notifications->notify('This Routemap already exist', 'error'); 
							  break;
							}/* end switch*/
					}
					} 
					else { $this->notifications->notify('Routemap  cannot upload..allowed  max size photo 1MB  ', 'error'); }		 
		            redirect('manage/downloads/routemap_view', 'refresh');
		 
		 }	
		
	}/* End of if isset($_post)*/
	$data['result'] = $_POST;
	$data['result']=$this->downloadsmodel->list_routemap($params);

	
    $data['period']=$this->periodmodel->listperiod();  
	$data['level']=$this->competitionlevelmodel->listcompetitionlevel($params); 
	$data['franchise']   = $this->franchisemodel->listFranchise();
	$data['mode']='Edit';
	/*echo "<pre>";print_r($data['result']);exit;*/
	$this->load->view("routemap.php",$data);
	
}

/* ---------------------- ----------------------------------------------------------------------- */	

/* ---------------------- BELOW CODE FOR CHANGE THE STATUS OF ROUTE MAP TO INACTIVE DONE BY HIMA ON 1-6-2015 ---------------------- */	


public function routemap_status_change()
{
	$uri=$this->uri->uri_to_assoc(4);
	$routemap_id=$uri['id'];
	//$params=array('routemap_id' =>$routemap_id,'aim'  => 'Status_change');
	$updated_status=$this->downloadsmodel->status_change_routemap($routemap_id);
	if($updated_status){  $this->notifications->notify('Routemap  Status changed to Inactive', 'success');}
	else{$this->notifications->notify('Routemap  Status changed  failed', 'error');}
	redirect('manage/downloads/routemap_view', 'refresh');
	
	
	
}



}//end class