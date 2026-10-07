<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
    
class Cin extends CI_Controller
 {
	

 public function __construct() 
	{
	
        parent::__construct();
        if (!$this->session->userdata('user_id')) { redirect('manage/login/', 'refresh'); }
        $this->load->library('encrypt');
        $this->load->library('session');
	    $this->load->library('form_validation');
		$this->load->library('validation');
		$this->load->library('csv');
		$this->load->model('periodmodel');
        $this->load->model('locationmodel');
        $this->load->model('schoolmodel');
        $this->load->model('studentsmodel');
        $this->load->model('franchisemodel');
        $this->load->model('cinmodel');
    }

/*================================= ==========================*/

//  FUNCTION 1:-  GENERATE BULK CIN

/*================================= ==========================*/



 public function generate_cin() 
 {
    	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
    	{
    		$csvResult_upolad_logArray = array();
    		$start_cell_row=2;/*skip first 2 heading rows */
    		$i=0;
    		
            if($_FILES['csv']['size'] > 0) 
        	{   
        		  //get the csv file 
        		  $file = $_FILES['csv']['tmp_name']; 
        		  $handle = fopen($file,"r"); 
        		  $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
        		  $type = $_FILES['csv']['type'];
        		  
        		  if($ext === 'csv')
        		  {
        		  
        			 //loop through the csv file and insert into database 
        			do
        			{	
        			if($i >= $start_cell_row)
        			{ /*echo "<br>"; echo $i ."-". $resultRow_from_csv[0];*/
            			   if($resultRow_from_csv[0]) 
            			   { 
            				  $period_id               =  addslashes($resultRow_from_csv[0]);
            				  $school_id            =  addslashes($resultRow_from_csv[1]);
            				  $country_id            =  addslashes($resultRow_from_csv[2]);
            				  $state_id            =  addslashes($resultRow_from_csv[3]);
            				  $class_id            =  addslashes($resultRow_from_csv[4]);
            				  $category_id            =  addslashes($resultRow_from_csv[5]);
            				  $student_title            =  addslashes($resultRow_from_csv[6]);
            				  $first_name            =  addslashes($resultRow_from_csv[7]);
            				  $middle_name            =  addslashes($resultRow_from_csv[8]);
            				  $last_name            =  addslashes($resultRow_from_csv[9]);
            				  
            				  $gender            =  addslashes($resultRow_from_csv[10]);
            				  $father_name            =  addslashes($resultRow_from_csv[11]);
            				  $father_name1            =  addslashes($resultRow_from_csv[12]);
            				  $father_name2            =  addslashes($resultRow_from_csv[13]);
            				  $mother_name            =  addslashes($resultRow_from_csv[14]);
            				  $mother_name1            =  addslashes($resultRow_from_csv[15]);
            				  $mother_name2	            =  addslashes($resultRow_from_csv[16]);
            				  $communication_address  =  addslashes($resultRow_from_csv[17]);
            				  $communication_address1  =  addslashes($resultRow_from_csv[18]);
            				  $communication_address2  =  addslashes($resultRow_from_csv[19]);
            				  $ca_pincode  =  addslashes($resultRow_from_csv[20]);
            				  $email  =  addslashes($resultRow_from_csv[21]);
            				  $mobile_number  =  addslashes($resultRow_from_csv[22]);
            				  $land_phone  =  addslashes($resultRow_from_csv[23]);
            				  
            				  
            				  
            				  $csv_result_array  =  array(   'period_id'  => $period_id , 
            												  'school_id'  => $school_id,
            												  'country_id' =>  $country_id,
            												  'state_id'   => $state_id,
            												  'class_id'   =>  $class_id,
            												  'category_id' =>  $category_id,
            												  'student_title' =>  $student_title ,
            												  'first_name'    =>  $first_name,
            												  'middle_name'   =>  $middle_name ,
            												  'last_name'     =>  $last_name ,
            												  
            												  'gender'        =>  	$gender  ,
            												  'father_name'   => $father_name,
            												  'father_name1'  =>  $father_name1,
            												  'father_name2'  =>  $father_name2 ,
            												  'mother_name'   =>  $mother_name,
            												  'mother_name1'  =>  $mother_name1 ,
            												  'mother_name2'  =>  $mother_name2,
            												  'communication_address'   =>  $communication_address ,
            												  'communication_address1'  =>  	$communication_address1,
            												  'communication_address2'  => $communication_address2,
            												  'ca_pincode' => $ca_pincode,
            												  'email'      => $email,
            												  'mobile_number'  => $mobile_number,
            												  'land_phone'      =>  $land_phone);
            												 
            				   $csv_upload_status = $this->cinmodel->generate_cin($csv_result_array);
            				   array_push($csvResult_upolad_logArray,$csv_upload_status);
            				   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
            				   
            				   //array_push($csvResult_upolad_logArray,$csv_upload_status);
            			   }/*End if*/
        			   
        			  }
        		  $i=$i+1;	
        		 }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
        		  
        			   /*............ End Do while ................*/
        			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
        			   /*unset($_FILES);*/
        			    $this->notifications->notify('CIN Generated Successfully','success');	
        			 
        		  }    /*END OF TYPE CHECKING*/
        		  else
        			{
    					$this->notifications->notify('Not a csv file ','error');
    			}/*END OF ELSE TYPE CHECKING*/
    			   
    		  
    		  
    			  
    	   }/* End if */
    	}
    $this->load->view("upload_CIN_file", $data);
        
} // END OF FUNCTION 1 


/*================================= ==========================*/

//  FUNCTION 2:- VIEW & EXPORT CIN LIST

/*================================= ==========================*/

public function list_CIN()
{
	
if(isset($_POST['Search']))
{
	$state_id = $this->input->post('state_subdivision_id');
	$data['res'] = $this->franchisemodel->Get_Statewise_Franchise($state_id);
	
	$validation_data=array(
	                    'period_id'  =>$this->input->post('period_id'),
						'state_subdivision_id'  =>$this->input->post('state_subdivision_id'),
					   );
					   
   $this->validation->set_data($validation_data);
   $this->validation->set_rules('period_id', 'PERIOD', 'required');
   $this->validation->set_rules('state_subdivision_id', 'STATE', 'required');
   if ($this->validation->run() === FALSE) 
   {
                /*var_dump($this->validation->show_errors());*/
         $this->notifications->notify('Please make all entries', 'error');
   } 
   else
   {	
      $search_data=array(
	                    'period_id'  =>$this->input->post('period_id'),
						'state_subdivision_id'  =>$this->input->post('state_subdivision_id'),
						'franchise_id'  =>$this->input->post('franchise_id'),
					   );
   		   
		$data['cin_list'] =$this->cinmodel->export_all_CINs($search_data);
		/*echo "<pre>";print_r($data['result']);exit;*/	
		
   }
   
$data['result'] = $_POST;
	
}


if(isset($_POST['Export']))
{  

$search_data=array(
			  'period_id'  =>$this->input->post('period_id'),
			  'state_subdivision_id'  =>$this->input->post('state_subdivision_id'),
			  'franchise_id'  =>$this->input->post('franchise_id'),
			 );
 
$list_school =$this->cinmodel->export_all_CINs($search_data);


$list_cin=$list_school['cin'];
$listexport_Request=$list_cin;

$filename ="data.csv";
$contents1 = array(
'SerialNo','Period','CIN','Student name','Class','Category','School Name','Email Id','Mobile Number','STD Phone',
'Franchise Code','State'
);
$data = array();
$n    = 1;
foreach ($listexport_Request as $item) {
$item['serial_no'] = $n;
$data[]            = array(
  $item['serial_no'],
  $item['period_name'],$item['cin'],
  $item['first_name']." ".$item['middle_name']." ".$item['last_name'],
  $item['class_key'],$item['categoryKey'],
  $item['school_name'],$item['school_address'],
  $item['father_email']."/".$item['mother_email'], $item['father_phone']."/".$item['mother_phone'],
  $item['franchise_code'],$item['state_subdivision_name']
);

$n++;
}
$this->csv->export($data, array(
'SerialNo','Period','CIN','Student name','Class','Category','School Name','School Address','Email Id','Mobile Number','STD Phone',
'Franchise Code','State'
), 'CINlist.csv');
exit;

}
	
	
$data['period']=$this->periodmodel->list_Allperiod(); 
$data['stateatload']=$this->locationmodel->get_indian_states();

$this->load->view("list_CIN", $data);
}  
 








                                                        


} /*END OF CLASS*/
   
   
   
   
   