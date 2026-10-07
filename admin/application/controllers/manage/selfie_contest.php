<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Selfie_contest extends CI_Controller
 {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('manage/login/', 'refresh');
        } 
         $this->load->model("selfiesmodel");
		 $this->load->model("galleryModel");
         $this->load->library('validation');
		 $this->load->library('form_validation');
 }
    
 public function index() 
{
     
	$data['selfie_list'] = $this->selfiesmodel->get_full_selfies();
    $this->load->view("selfieList",$data);
	
}
 
public function add_selfie()
{
	if(isset($_POST['submit_selfie']))
	{
		  $target_path = getcwd() . "/public/uploads/selfie/";
		  $target_path1 ="public/uploads/selfie/"; 
		  $validate_data   = array(
						'cin' => $this->input->post('cin'),
						'name' => $this->input->post('name'),
						'school' => $this->input->post('school'),
						'category' => $this->input->post('category'),
						'contact_no' => $this->input->post('contact_no'),
						'email_id' => $this->input->post('email_id'),
						'contact_address' => $this->input->post('contact_address'),
						'state' => $this->input->post('state'),

				   );
		$this->validation->set_data($validate_data);
		$this->validation->set_rules('name', 'name', 'required');
		$this->validation->set_rules('school', 'school', 'required');
		$this->validation->set_rules('category','category','required');
		$this->validation->set_rules('contact_no', 'contact_no', 'required');
		$this->validation->set_rules('email_id', 'email_id', 'required');
		$this->validation->set_rules('contact_address', 'contact_address', 'required');
		$this->validation->set_rules('state', 'state', 'required');
       
		if($this->validation->run() === FALSE) 
		{
				$this->notifications->notify('Please make all entries', 'error');		   
		} /*  end if  */
		   
       else
	   {		   
		   if ($_FILES['file_path']['name'] != '')
		   {
					$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");

					$file_name     = $_FILES["file_path"]["name"];
					//echo $file_size     = $_FILES["file_path"]["size"];
					echo $file_size     = getimagesize($file_name);
					
					echo $file_type     = $_FILES["file_path"]["type"];
					$file_ext_array=explode('/',$file_type);
					echo $file_ext=$file_ext_array[1];
					
					$file_tmp_name = $_FILES["file_path"]["tmp_name"];
					//$new_file_name = $file_name;
					//$upload_path   = $target_path . $new_file_name;
					
							if(in_array($file_ext,$valid_formats))
							{
								if($file_size<(1024*1024))
								{
									//echo $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$file_ext;
									 $actual_image_name = $file_name;
									 $uploadedfile = $_FILES['file_path']['tmp_name'];
									//include 'includes/compressImage.php';	
																 
									$newwidth = 350;
									$compress_filename=$this->compressImage($file_ext,$uploadedfile,$target_path1,$actual_image_name,$newwidth);
									
							           $insert_data   = array(
											'cin' => $this->input->post('cin'),
											'name' => $this->input->post('name'),
											'school' => $this->input->post('school'),
											'category' => $this->input->post('category'),
											'contact_no' => $this->input->post('contact_no'),
											'email_id' => $this->input->post('email_id'),
											'contact_address' => $this->input->post('contact_address'),
											'state' => $this->input->post('state'),
											'image_path' =>  $compress_filename
											
									   );
									  $insert_status = $this->selfiesmodel->insert($insert_data);
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
									/*}
									else
									echo "Fail upload folder with read access.";*/
								}
								else
								echo "Image file size max 1 MB";					
							}
							else
							echo "Invalid file format..";	

					//redirect('selfie_contest/','refresh');
					
					
					
		   }/* end if ($_FILES['file_path']['name'] != '') */
		   else
		   { $this->notifications->notify("Please select the file", 'error');  }
		 }
		 
        $data['result'] = $_POST;
	}
	$data['mode']='Add';
     $this->load->view("add_selfie",$data);
	 
}  /*  End function of add_selfie()  */
 
 
/* --------------------------------------------------------------------------------------------------- */ 
function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
{
	//echo "ext - ".$ext."uploadedfile- ".$uploadedfile."path- ".$path."actual_image_name-".$actual_image_name."newwidth-".$newwidth;exit;
	if($ext=="jpg" || $ext=="jpeg" || $ext=="JPG" || $ext=="JPEG")
	{
	$src = imagecreatefromjpeg($uploadedfile);
	}
	else if($ext=="png"|| $ext=="PNG")
	{
	$src = imagecreatefrompng($uploadedfile);
	}
	else if($ext=="gif" || $ext=="GIF")
	{
	$src = imagecreatefromgif($uploadedfile);
	}
	else
	{
	$src = imagecreatefrombmp($uploadedfile);
	}
																	
	list($width,$height)=getimagesize($uploadedfile);
	echo $newheight=($height/$width)*$newwidth;
	//$tmp=imagecreatetruecolor($newwidth,$newheight);
$tmp=imagecreatetruecolor(500,300);

	////imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	imagecopyresampled($tmp,$src,0,0,0,0,500,300,$width,$height);

	$filename = $path.$newwidth.'_'.$actual_image_name;
	imagejpeg($tmp,$filename,100);
	imagedestroy($tmp);
	return $filename;
} 
 
 /**------------------------------------------------*/
 
 
 public function edit()
{
	$uri=$this->uri->uri_to_assoc(4);
	$selfie_contest_id=$uri['id'];
     if(isset($_POST['submit_selfie']))
	{
		 
		  $validate_data   = array(
						'cin' => $this->input->post('cin'),
						'name' => $this->input->post('name'),
						'school' => $this->input->post('school'),
						'category' => $this->input->post('category'),
						'contact_no' => $this->input->post('contact_no'),
						'email_id' => $this->input->post('email_id'),
						'contact_address' => $this->input->post('contact_address'),
						'state' => $this->input->post('state'),
						
						
				   );
		$this->validation->set_data($validate_data);
		$this->validation->set_rules('name', 'name', 'required');
		$this->validation->set_rules('school', 'school', 'required');
		$this->validation->set_rules('category','category','required');
		$this->validation->set_rules('contact_no', 'contact_no', 'required');
		$this->validation->set_rules('email_id', 'email_id', 'required');
		$this->validation->set_rules('contact_address', 'contact_address', 'required');
		$this->validation->set_rules('state', 'state', 'required');
       
		if($this->validation->run() === FALSE) 
		{
				$this->notifications->notify('Please make all entries', 'error');		   
		} /*  end if  */
		   
       else
	   {		   
		  $insert_data   = array(
									'cin' => $this->input->post('cin'),
									'name' => $this->input->post('name'),
									'school' => $this->input->post('school'),
									'category' => $this->input->post('category'),
									'contact_no' => $this->input->post('contact_no'),
									'email_id' => $this->input->post('email_id'),
									'contact_address' => $this->input->post('contact_address'),
									'state' => $this->input->post('state'),
											
									   );
								$update_status = $this->selfiesmodel->insert($insert_data,$selfie_contest_id);
								switch($update_status)
								{
									case 1:
											 $this->notifications->notify('Selfie Updated  successfully', 'success'); 
									break;
									case 0:
											 $this->notifications->notify('Sorry...Cannot Updated Selfie ', 'error'); 
									break;
									case 3:
											 $this->notifications->notify('This Selfie already exist', 'error'); 
									break;
								}/* end switch*/
					
		   }/* end if ($_FILES['file_path']['name'] != '') */

		 }
	
      $data['result'] = $_POST;
		
	 $data['mode']='Edit'; 
	 $data['result'] = $this->selfiesmodel->get_current_selfie($selfie_contest_id);
     $this->load->view("add_selfie",$data);
	
}

}