<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');

class Result extends CI_Controller 

{

/*....................................................................................................................*/	

    public function __construct()

	 {

			parent::__construct();

			$this->load->library('encrypt');

			$this->load->library('session');

			$this->load->library('validation');

			$this->load->library("csv");

			$this->load->helper('form');

		

		   /*$this->CI =& get_instance();   */    

			$this->load->library('form_validation');

// 			$this->load->model('resultmodel');

			$this->load->model('franchisemodel');

            $this->load->model('competitionsheduleModel');			

// 			$this->load->model('servicemodel');

// 			$this->load->model('competitionlevelmodel');

// 			$this->load->model('Categorymodel');

// 			$this->load->model('periodmodel');

			$this->load->model('schoolmodel');

// 			$this->load->model('locationmodel');

            $this->load->model('loginModel');

		

    } /*end function __constructfranchisemodel*/

/*....................................................................................................................*/	

	public function index() {  echo 'ok';	die; } /*end function index*/

/*....................................................................................................................*/	

	public function check() { print_r($_POST);	die; } 	

/*------------------------------------------------------------------------------------------------------------------------------------------------*/

  /*...........csv Result........................*/

  public function upload_csv_result()

  {

	  if(isset($_POST['submit']) && $_POST['submit']=='Submit')

	  {  

	     $data['period_id']            =  $search_period_id = $this->input->post('period_id');

	     $data['competition_level_id'] =  $search_level_id = $this->input->post('competition_level_id');

	     $data['service_id']           =  $search_service_id = $this->input->post('service_id');

	  

		 $csvResult_upolad_logArray = array();

		 

				$start_cell_row=3;/*skip first 2 heading rows */

				$i=0;

		 

		 if($_FILES['csv']['size'] > 0) 

		 {   

			 	//get the csv file 

				$file = $_FILES['csv']['tmp_name']; 

				$handle = fopen($file,"r"); 

				//loop through the csv file and insert into database 

				do

				{	

				  if($i >= $start_cell_row)

				  { //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];

				     if($resultRow_from_csv[0]) 

					 { 

						$cin               =  addslashes($resultRow_from_csv[0]);

						$status            =  addslashes($resultRow_from_csv[1]);

						

						$grade1            =  addslashes($resultRow_from_csv[2]);

						$grade2            =  addslashes($resultRow_from_csv[3]);

						$grade3            =  addslashes($resultRow_from_csv[4]);
						
						$grade4            =  addslashes($resultRow_from_csv[5]);

						

						$csv_result_array  =  array('cin'              => $cin , 

						                               'status'           => $status ,

													   'grade1'           =>$grade1,

													   'grade2'           =>$grade2,

													   'grade3'           =>$grade3,
													   
													   'grade4'           =>$grade4,

													   'search_period_id' => $search_period_id,

													   'search_level_id'  => $search_level_id,

													   'search_service_id'=> $search_service_id);



							/*echo "<pre>";print_r($csv_result_array);exit;	*/					   

						 $csv_upload_status = $this->resultmodel->save_csv_result($csv_result_array);

						 array_push($csvResult_upolad_logArray,$csv_upload_status);

					 }/*End if*/

					 

					}

				$i=$i+1;	

			   }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));

			    

			   /*............ End Do while ................*/

			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;

			   /*unset($_FILES);*/

			   $this->notifications->notify('Result Uploaded Successfully','success');

		   }/* End if */

     }/* End of if */

		 $service_id=1;		 

	 

	$params = array("service_id"=>$service_id);	

	$data['services'] = $this->servicemodel->listservice($params);

	$data['level']    = $this->competitionlevelmodel->listcompetitionlevel($params);	

	$data['period']   = $this->periodmodel->listperiod();

	$this->load->view("upload_result_file.php",$data);

  }/*END of function import()*/

 

 /*------------------------------------------------------------------------------------------------------------------*/  

	public function listDetails()

	{

			   $service_id=$this->input->post('service_id');

			   $params = array("bulk_service_id" => $service_id);

			   $data['franchise'] = $this->franchisemodel->listFranchise($params);

			   $data['levels']    = $this->competitionlevelmodel->listcompetitionlevel($service_id);

			   $data['category']  = $this->Categorymodel->listCategory($params);

			   $data['periods']   = $this->periodmodel->listperiod();

			   $data['school']    = $this->schoolmodel->listSchool();

			   $this->load->view("detailView.php",$data); 

	   

	}/*end function  listDetails*/

	/*------------------------------------------------------------------------------------------------------------------*/  



 

	

	/*-----------------------BELOW FUNCTION DONE BY DEEPA ON 20-5-2015---------------------------*/ 

	

	

	 

	 public function view_result() 

	 {

        

		

		 if (isset($_POST['Search'])) 

		{

            $link = SITE_URL . "result/view_result/aim/export/";

			

            if ($this->input->post('period_id') != '') {

                $link .= "period_id/" . $this->input->post('period_id') . "/";

            }

			

            if ($this->input->post('competition_level_id') != '') {

                $link .= "level_id/" . $this->input->post('competition_level_id') . "/";

            }

			

            if ($this->input->post('result_status') != '') {

                $link .= "result_status/" . $this->input->post('result_status') . "/";

            }



            if ($this->input->post('country_id') != '') {

                $link .= "country_id/" . $this->input->post('country_id') . "/";

            }

			

			if ($this->input->post('state_subdivision_id') != '') {

                $link .= "state_id/" . $this->input->post('state_subdivision_id') . "/";

            }

			

            if ($this->input->post('franchise_id') != '') {

                $link .= "fr_id/" . $this->input->post('franchise_id') . "/";

            }

			

            redirect($link, 'refresh');

            $data['result_list'] = $_POST;

        }

        /*end if(isset($_POST['Search'])) */

        

		else 

		{

            $uri            = $this->uri->uri_to_assoc(4);

            /* print_r($uri);exit;*/

			

            if ($uri['period_id'] != '' ) 

			{

                $params = array(

                    'period_id'             => $uri['period_id'],

                    'competition_level_id'  => $uri['level_id'],

                    'result_status'         => $uri['result_status'],

                    'country_id'            => $uri['country_id'],

                    'state_subdivision_id'  => $uri['state_id'],

					'franchise_id'          => $uri['fr_id'],

                );

              $data['result_list'] = $this->resultmodel->franchiselist_result($params);

            } 

			else 

			{

                $data['info'] = "empty";

            }

        }/*End of else */

		

		if (isset($_POST['Export'])) 

		{

			

                $params = array(

                    'period_id'             => $uri['period_id'],

                    'competition_level_id'  => $uri['level_id'],

                    'result_status'         => $uri['result_status'],

                    'country_id'            => $uri['country_id'],

                    'state_subdivision_id'  => $uri['state_id'],

					'franchise_id'          => $uri['fr_id'],

					

					

                );

        

		  $listResult=  $this->resultmodel->franchiselist_result($params);

		  $list_data=$listResult[1];

		 //print_r($list_data);exit;

          $data = array();

          $n    = 1;

          foreach ($list_data as $item) {

                $item['serial_no'] = $n;

				$item['school']    =  $item['school_name']." , ".$item['school_address'];

				/*----------------------------------------------------------*/



				if($item['father_email'] !='')

				  {    $item['Email']     =  $item['father_email'];   }

				

				if($item['mother_email'] !='')

				  {    

				       if($item['Email']!='')

					      { $item['Email']     .=  " , ".$item['mother_email'];  }

					   else 

					      { $item['Email']     .= $item['mother_email'];  }  

				  }/* End if */

				/*----------------------------------------------------------*/

				

				if($item['father_phone'] !='')

				  {    $item['Mobile']     =  $item['father_phone'];   }

				if($item['mother_phone'] !='')

				  {    

				       if($item['Mobile']!='')

					      { $item['Mobile']     .=  " , ".$item['mother_phone'];  }

					   else 

					      { $item['Mobile']     .= $item['mother_phone'];  }  

				  }				  

				/*----------------------------------------------------------*/

				

				$item['Mobile']     ='';

				if($item['father_phone'] !='')

				  {    $item['Mobile']     =  $item['father_phone'];   }

				if($item['mother_phone'] !='')

				  {    

				       if($item['Mobile']!='')

					      { $item['Mobile']     .=  " , ".$item['mother_phone'];  }

					   else 

					      { $item['Mobile']     .= $item['mother_phone'];  }  

				  }				  

				/*----------------------------------------------------------*/

				$item['LandPone'] =  $item['std_code']." - ".$item['phone'];

				

                $data[]            =

				 array(

						$item['serial_no'],

						$item['competition_level_name'],

						$item['period_name'],

						$item['first_name'] . " " . $item['middle_name'] . " " . $item['last_name'],

						$item['cin'],
						$item['class_key'],

						$item['categoryKey'],

						$item['school'],

						$item['center_name']. " " . $item['center_address'],

						$item['status'],

						$item['grade1'],

						$item['grade2'],
						
						$item['grade3'],
						
						$item['grade4'],

						$item['franchise_code'],

						$item['Email'],

						$item['Mobile'],

						$item['LandPone']

                );

                /*echo $item['serial_no'];exit;*/

                $n++;

            }/*End foreach */

            $this->csv->export($data, array(

                'SiNo','Competition level','Period','Student Name','CIN','Class','Category','School','Competition Centre','Result Status',
                'Synonyms & Antonyms','Spell It','Word Origin','Aural Skill','franchise_code','Email','Mobile','LandPone'
               ), 'result_list.csv');

            exit;

        }

		

		

		

		

		$data['aim']                  = $uri['aim'];

        $data['competition_level_id'] = $uri['level_id'];

        $data['period_id']            = $uri['period_id'];

        $data['franchise_id']         = $uri['fr_id'];  

		$data['result_status']        = $uri['result_status'];

		$data['country_id']           = $uri['country_id'];

		$data['state_subdivision_id'] = $uri['state_id'];

		$params                       = array('service_id' => 1);

		$data['levels']               = $this->competitionlevelmodel->listcompetitionlevel($params);

		$data['periods']              = $this->periodmodel->listperiod();

		 $data['stateatload']          = $this->locationmodel->get_indian_states();       

		if($uri['state_id'] !='' )

		{ $data['franchise']            = $this->franchisemodel->Get_Statewise_Franchise($uri['state_id']);      }

	    $this->load->view("view_result.php", $data);

    }

	

	

	

	

	public function result_upload_against_schedule(){
    
        //echo 'oj';die;
        if(isset($_POST['submit'])){
                //print_R($_POST);die;
                
                $data=array(
                    'period_id'=>$this->input->post('period_id'),
                    'product_name'=>$this->input->post('product_name'),
                    'country'=>$this->input->post('country'),
                    'state_id'=>$this->input->post('state_id'),
                    'franchise_id'=>$this->input->post('franchise_id'),
                    'competition_level_id'=>$this->input->post('competition_level_id')
                    );
                $data['list'] = $this->competitionsheduleModel->search_schedule($data);  
                  $data['result']=$_POST;
            }else{
                
                $sql="SELECT period.*,competition_schedule.*,competition_level_byproduct.level_name,franchise.franchise_code FROM competition_schedule JOIN `period` ON `period`.`period_id`=`competition_schedule`.`period_id` JOIN `competition_level_byproduct` ON `competition_level_byproduct`.`level_id`=`competition_schedule`.`competition_level_id` JOIN `franchise` ON `competition_schedule`.`franchise_id`=`franchise`.`franchise_id` GROUP BY competition_schedule_id ORDER BY competition_schedule_id DESC LIMIT 10;";
                $query = $this->db->query($sql);
                $data['list'] =$query->result_array();
            }
        
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['franchise']  = $this->db->get_where('franchise')->result_array(); 
        $data['state']    = $this->db->get_where('states',array('country_id'=>'105'))->result_array(); 
         
        $this->load->view("result_upload_against_schedule.php",$data);
    
    }

	
    public function upload()
    {
        $uri                   = $this->uri->uri_to_assoc(4);
                $competion_schedule_id = $uri['id'];
        //echo $competion_schedule_id;die;
        $schedule      = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$competion_schedule_id))->row_array();
        //print_r($schedule);die;
         $data['level_id']=$schedule['competition_level_id'];
        $data['period_id']=$schedule['period_id'];
        $data['product_id']=$schedule['product_id'];
        
         if(isset($_POST['submit']) && $_POST['submit']=='Submit')
        
        	  {  
    	   //   print_r($_POST);die;
    
    	   //  $data['period_id']            =  $search_period_id = $this->input->post('period');
    
    	   //  $data['level_id'] =  $search_level_id = $this->input->post('level');
    
    	   //  $data['product_id']           =  $search_service_id = $this->input->post('product');
    	     
    	     
        //      $period_id            =  $search_period_id = $this->input->post('period');
    
    	     $subject           = $this->input->post('subject');
    
    	     $series          =  $this->input->post('series');
    // 	  print_r($product_id);die;
    
    		 $csvResult_upolad_logArray = array();
    
    		 
    
    				$start_cell_row=2;/*skip first 2 heading rows */
    
    				$i=0;
    
    		 
    
    		 if($_FILES['csv']['size'] > 0) 
    
    		 {   
    
    			 	//get the csv file 
    
    				$file = $_FILES['csv']['tmp_name']; 
    
    				$handle = fopen($file,"r"); 
    
    				//loop through the csv file and insert into database 
    
    				do
    
    				{	
    
    				  if($i >= $start_cell_row)
    
    				  { //echo 'okk';die;
    				      //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];die;
    
    				     if($resultRow_from_csv[0]) 
    
    					 { 
    
    						
    						$prid           =  addslashes($resultRow_from_csv[0]);
    						$result            =  addslashes($resultRow_from_csv[1]);
    						$grade            =  addslashes($resultRow_from_csv[2]);
                            $rank            =  addslashes($resultRow_from_csv[3]);
                            $marks            =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller            =  addslashes($resultRow_from_csv[6]);
                            
        //                     $venue            =  addslashes($resultRow_from_csv[9]);
    
    				// 		$comp_date            =  addslashes($resultRow_from_csv[10]);
    						
    						$csv_result_array  =  array('period_id'                => $data['period_id'] , 
    
    						                               'clevel'              => $data['level_id'] ,
    
    													   'product_id'            =>$data['product_id'],
    
    													   'cin'               =>$prid,
    
    													   'status'             =>$result,
    
    													   'search_period'          => $data['period_id'],
    
    													   'search_level'           => $data['level_id'],
    
    													   'search_product'         => $data['product_id'],
    													   
    													   'grade'=>$grade,
    													   'rank'=>$rank,
    													   'performer'=>$performer,
    													   'speller'=>$speller,
    													   'marks'=>$marks,
    													   
    													 );
    
    
    
    						//	echo "<pre>";print_r($csv_result_array);exit;					   
    
    						 $csv_upload_status = $this->loginModel->result_check($csv_result_array,$schedule,$subject,$series);
    
    						 array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    					 }/*End if*/
    
    					 
    
    					}
    
    				$i=$i+1;	
    
    			   }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
    
    			    
    
    			   /*............ End Do while ................*/
    
    			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    
    			   /*unset($_FILES);*/
    
    			   $this->notifications->notify('Result Uploaded Successfully','success');
    
    		   }/* End if */
    
         }/* End of if */
         
         
        if(isset($_POST['download'])){
            
            $filepath="public/template/MARRS_RESULT_UPLOAD.csv";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
            
            
        } 
         
        $data['period']     = $this->db->get_where('period')->result_array();
        $data['level']      = $this->db->get_where('competition_level_byproduct')->result_array();
        $data['product'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
           
    	$this->load->view("upload_result.php",$data);
    
    }
 //fixed code
// public function upload()
// {
//     // 🔥 Server safety
//     ini_set('max_execution_time', 300);
//     ini_set('memory_limit', '512M');

//     $uri = $this->uri->uri_to_assoc(4);
//     $competion_schedule_id = $uri['id'];

//     $schedule = $this->db->get_where(
//         'competition_schedule',
//         array('competition_schedule_id' => $competion_schedule_id)
//     )->row_array();

//     $data['level_id']  = $schedule['competition_level_id'];
//     $data['period_id'] = $schedule['period_id'];
//     $data['product_id']= $schedule['product_id'];

//     // 🔥 CHUNK SETTINGS
//     $limit  = 1000; // rows per request
//     $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

//     if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

//         $subject = $this->input->post('subject');
//         $series  = $this->input->post('series');

//         $csvResult_upolad_logArray = array();

//         if (!empty($_FILES['csv']['size'])) {

//             $file   = $_FILES['csv']['tmp_name'];
//             $handle = fopen($file, "r");

//             if ($handle !== FALSE) {

//                 $currentIndex = 0;
//                 $processed = 0;

//                 while (($row = fgetcsv($handle, 1000, ",", "'")) !== FALSE) {

//                     // 🔥 Skip already processed rows
//                     if ($currentIndex < $offset) {
//                         $currentIndex++;
//                         continue;
//                     }

//                     // 🔥 Stop after limit
//                     if ($processed >= $limit) {
//                         break;
//                     }

//                     // 🔥 Skip header rows (first 2)
//                     if ($currentIndex >= 2 && !empty($row[0])) {

//                         $csv_result_array = array(
//                             'period_id'      => $data['period_id'],
//                             'clevel'         => $data['level_id'],
//                             'product_id'     => $data['product_id'],
//                             'cin'            => addslashes($row[0] ?? ''),
//                             'status'         => addslashes($row[1] ?? ''),
//                             'search_period'  => $data['period_id'],
//                             'search_level'   => $data['level_id'],
//                             'search_product' => $data['product_id'],
//                             'grade'          => addslashes($row[2] ?? ''),
//                             'rank'           => addslashes($row[3] ?? ''),
//                             'marks'          => addslashes($row[4] ?? ''),
//                             'performer'      => addslashes($row[5] ?? ''),
//                             'speller'        => addslashes($row[6] ?? ''),
//                         );

//                         // ✅ SAME MODEL CALL
//                         $csv_upload_status = $this->loginModel->result_check(
//                             $csv_result_array,
//                             $schedule,
//                             $subject,
//                             $series
//                         );

//                         $csvResult_upolad_logArray[] = $csv_upload_status;

//                         $processed++;
//                     }

//                     $currentIndex++;
//                 }

//                 fclose($handle);

//                 // 🔥 AUTO NEXT CHUNK
//                 if ($processed == $limit) {

//                     $nextOffset = $offset + $limit;

//                     echo "<h3 style='text-align:center;'>Processing... Please wait</h3>";
//                     echo "<script>
//                         setTimeout(function(){
//                             window.location.href = '?offset=$nextOffset';
//                         }, 1000);
//                     </script>";
//                     exit;

//                 } else {
//                     // ✅ DONE
//                     $this->notifications->notify('All Results Uploaded Successfully', 'success');
//                 }
//             }
//         }
//     }

//     // ✅ Download template (UNCHANGED)
//     if (isset($_POST['download'])) {

//         $filepath = "public/template/MARRS_RESULT_UPLOAD.csv";
//         header('Content-Description: File Transfer');
//         header('Content-Type: application/octet-stream');
//         header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
//         header('Expires: 0');
//         header('Cache-Control: must-revalidate');
//         header('Pragma: public');
//         header('Content-Length: ' . filesize($filepath));
//         flush();
//         readfile($filepath);
//         die();
//     }

//     // ✅ SAME DATA
//     $data['period']  = $this->db->get_where('period')->result_array();
//     $data['level']   = $this->db->get_where('competition_level_byproduct')->result_array();
//     $data['product'] = $this->db->get_where('products', array('status' => 'Active'))->result_array();

//     // ✅ SAME VIEW
//     $this->load->view("upload_result.php", $data);
// }

}

