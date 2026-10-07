<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class downloads_materials extends CI_Controller 
{
    public function __construct() 
	{
        parent::__construct();
        $this->load->library('session');
		if (!$this->session->userdata('user_id')) {redirect('manage/login/', 'refresh');} 
        $this->load->library('validation');
		$this->load->library('form_validation');
		$this->load->library('pagination');
        //$this->load->model('materialsmodel'); /*LIST ALL MARRS PRODUCTS*/
    	//$this->load->model('periodmodel'); /*LIST ALL MARRS PRODUCTS*/
		//$this->load->model('competitionlevelmodel'); /*LIST ALL MARRS PRODUCTS*/
		
    }/*end function __construct()*/
   
   
   
   
   
/* ====================   =============================     ==================== */	

     // FUNCTION 1 :- ADD TITILE STUDY MATERIALS
/* ====================   =============================     ==================== */	

public function add_title() 
{

if (isset($_POST['submit']))
{

$validation_data   = array( 'title_desc'        => $this->input->post('title_desc') );

$this->validation->set_data($validation_data);
$this->validation->set_rules('title_desc', 'titile', 'required');
if ($this->validation->run() === FALSE) 
{
		/*var_dump($this->validation->show_errors());*/
 $this->notifications->notify('Please make all entries', 'error');
} 
else
{	
$params   = array(
					 'title_desc'        => $this->input->post('title_desc'),

			   );

	$insert_status = $this->materialsmodel->insert_titile($params);
	
	switch($insert_status)
	{
		case 1:
			  $this->notifications->notify('Title Saved successfully', 'success'); 
		break;
		
		case 0:
			  $this->notifications->notify('Sorry...Title Save Failed', 'error'); 
		break;
		

	}
	 redirect('manage/downloads_materials/add_title', 'refresh');
}/*end if */

$data['result']      = $_POST;
}					
$this->load->view("titleAdd.php",$data);	
}




/*  -------------------------------------------------------------------------------------   */

//  FN.NO:-2  VIEW STUDY MATERIALS TITLE

/*  -------------------------------------------------------------------------------------   */

public function title_view() 
{
  
  $config = array();
  $config["base_url"] = base_url(). "manage/downloads_materials/title_view/";
  $total_row = $this->materialsmodel->title_record_count();
  $config["total_rows"] = $total_row;
  $config["per_page"] = 5;
  $config['use_page_numbers'] = TRUE;
  $config['num_links'] = $total_row;
  $config['cur_tag_open'] = '&nbsp;<a class="current">';
  $config['cur_tag_close'] = '</a>';
  $config['next_link'] = 'Next';
  $config['prev_link'] = 'Previous';
  $this->pagination->initialize($config);
  $uri_seg = $this->uri->segment(4);
  /*echo "<pre>".print_r($uri_seg);*/
  if($uri_seg)
  {
	  $page = $uri_seg ; 
  } 
  else  {  $page = 1; }
  
  $start_row=($config["per_page"]*$page)-$config["per_page"];
  $count=$config["per_page"];
  $data['title_list'] = $this->materialsmodel->fetch_titile($start_row,$count);
  
  $str_links = $this->pagination->create_links();
  $data["links"] = explode('&nbsp;',$str_links );
  /*echo "<pre>";print_r($str_links);exit;*/
   $this->load->view("titleList.php", $data);

  
}/* End:-  Function 2 -title_view */




/*  -------------------------------------------------------------------------------------   */

//  FN.NO:-3   EDIT STUDY MATERIALS TITLE

/*  -------------------------------------------------------------------------------------   */


public function title_edit() 
{
	  
 $uri             = $this->uri->uri_to_assoc(2);
 $title_id     =  $uri['id'];
 //echo $title_id;exit;

if (isset($_POST['submit']))
{
	$updated_data   = array(
					  'title_desc'      => $this->input->post('title_desc'),
				  );
	$this->validation->set_data($updated_data);
	$this->validation->set_rules('title_desc','Ttile','required')	;		  
	if ($this->validation->run() === FALSE)
   {
	   /*echo  var_dump($this->validation->show_errors());*/
	   $this->notifications->notify('Please make all entries', 'error');
   } 
   else 
   { 
	   $update_title__status= $this->materialsmodel->update_title($updated_data,$title_id);
	   if($update_title__status)
		 {
			 $this->notifications->notify('Title added successfully', 'success'); 
		 }
		 else
		 {
			 $this->notifications->notify('Failed to add new Title', 'error');
		 }
   }
  
  $data['result']      = $_POST;
} /* End:- IF SUBMIT*/

  $data['result']      = $this->materialsmodel->getTitle($title_id);
  $this->load->view("titleAdd.php",$data);
	  
} /* End:-  Function 3 - title_edit */




/*  -------------------------------------------------------------------------------------   */

//  FN.NO:-4   ADD STUDY MATERIALS FILS

/*  -------------------------------------------------------------------------------------   */

public function Add_materials() 
{
if (isset($_POST['submit']))
{
/*echo "in";exit;
  echo "<pre>";print_r($_FILES);exit;*/
   $target_path = getcwd() . "/public/uploads/study_materials_new/";
   $target_path1 ="public/uploads/study_materials_new/";
				   
   if ($_FILES['question_file_path']['name'] != '' || $_FILES['answer_file_path']['name'] != '')
	{
		
            $file_name1     = $_FILES["question_file_path"]["name"];
			$file_name2     = $_FILES["answer_file_path"]["name"];

             /*echo $file_name1."<br>".$file_name2;exit;*/
			//echo $file_size     = $_FILES["file_path"]["size"];

			$file_size1     = $_FILES["question_file_path"]["size"] / 1024;
			$file_size2     = $_FILES["answer_file_path"]["size"] / 1024;
			
			
			//echo $file_size1."<br>".$file_size2;exit;
			$file_type1     = $_FILES["question_file_path"]["type"];
			$file_type2     = $_FILES["answer_file_path"]["type"];
			
			
			$file_tmp_name1 = $_FILES["question_file_path"]["tmp_name"];
			$file_tmp_name2 = $_FILES["answer_file_path"]["tmp_name"];
			//echo $file_tmp_name1."<br>".$file_tmp_name2;exit;
			
			$new_file_name1 = $file_name1;
			$new_file_name2 = $file_name2;
			$upload_path_file1   = $target_path . $new_file_name1;
            $upload_path_file2   = $target_path . $new_file_name2;

			if (move_uploaded_file($file_tmp_name1, $upload_path_file1)) 
			{ 
				$question_file_path = addslashes($target_path1 . $new_file_name1);
			}
			
			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
			{
				$answer_file_path = addslashes($target_path1 . $new_file_name2);
			}
			else { $this->notifications->notify('files cannot upload', 'error');  }/*end else var_dump($this->validation->show_errors());*/
			
		}/* end if ($_FILES['file_path']['name'] != '') */
		
		
		
		//echo "ote";exit;
	$validation_data   = array(
								'title_id'      => $this->input->post('title_id'),
								'period_id'     => $this->input->post('period_id'),
								'competition_level_id'  => $this->input->post('competition_level_id'),
								'category_id'   => $this->input->post('category_id'),
								'question_file_path' =>$question_file_path
								
							   );
							   
		/*echo "<pre>";print_r($validation_data);exit;	*/			   

   	$this->validation->set_data($validation_data) ; 
	$this->validation->set_rules('title_id', 'Title', 'required');
	$this->validation->set_rules('period_id', 'Period', 'required');
	$this->validation->set_rules('competition_level_id','Competition level','required');
	$this->validation->set_rules('category_id', 'Category', 'required');
	$this->validation->set_rules('question_file_path', 'File', 'required');
	if($this->validation->run() === FALSE) 
	{
			$this->notifications->notify('Please make all entries', 'error');		   
	} /*  end if  */
	
    else
    {	
	
	
	    if(empty($answer_file_path))
		{
			
			$insert_data=array(
								'title_id'      => $this->input->post('title_id'),
								'period_id'     => $this->input->post('period_id'),
								'competition_level_id'  => $this->input->post('competition_level_id'),
								'category_id'   => $this->input->post('category_id'),
								'question_file_path' => $question_file_path
								
							   );
							   
		}
		else
		{
			$insert_data=array(
								'title_id'      => $this->input->post('title_id'),
								'period_id'     => $this->input->post('period_id'),
								'competition_level_id'  => $this->input->post('competition_level_id'),
								'category_id'   => $this->input->post('category_id'),
								'question_file_path' => $question_file_path,
								'answer_file_path' => $answer_file_path,
							   );
		}
			/*echo "<pre>";print_r($insert_data);exit;*/
			
							
             $insert_status = $this->materialsmodel->insert_materials($insert_data);
				
				if($insert_status=="1")
				{
					 $this->notifications->notify('Study materials Added successfully', 'success'); 
				}
				else
				{
					$this->notifications->notify('Sorry...Cannot save Study materials ', 'error');
				}
			
					

		   

	}
  $data['result']      = $_POST;
  
  
}/* End:- IF SUBMIT*/


$data['mode']      = "Add";

$data['title']                 = $this->materialsmodel->list_Alltitle();
$data['period']                = $this->periodmodel->list_Allperiod();
$data['competitionlevel']      = $this->competitionlevelmodel->Get_Allcompetitionlevel();



$this->load->view("add_materials.php",$data);

}/* End:-  Function 4 - Add_materials */




public function seach_studymaterial()
{
    if(isset($_POST['submit'])){
        
        $product_name= $this->input->post('product_id');
        $level = $this->input->post('clevel');
        $period_id = $this->input->post('period');
        
        $this->db->select('*');
        $this->db->from('study_material');
        $this->db->where('product_id',$product_name);
        $this->db->where('clevel',$level);
        $this->db->where('period',$period_id);
        $data['list_materials'] = $this->db->get()->result_array();
       // print_r($data);die;
        
        
        
        
        
    }
    $this->load->view("seach_studymaterial.php",$data);
    
}


	


}//end class