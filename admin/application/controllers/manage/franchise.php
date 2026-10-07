<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Franchise extends CI_Controller 
{
    public function __construct() 
    {
			parent::__construct();
			if (!$this->session->userdata('user_id')) {
				redirect('manage/login/', 'refresh');
			}
			//$this->load->library('encrypt');
			$this->load->library('email');
			$this->load->library('csv');
			$this->load->library('session');
			$this->load->library('upload');
			$this->load->library('form_validation');
			$this->load->library('validation');
			$this->load->model('franchisemodel');
			$this->load->model('schoolmodel'); /*LIST ALL MARRS PRODUCTS*/
    }
	
/*@@@@@@@@@@@@@@@@@@@@@@@  START FUNCTION FOR LIST ALL FRANCHISE DETAILS@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
	
	public function ouuuut()
	{
	    
	    // $csvResult_upolad_logArray = array();

		if(isset($_POST['submit']) && $_POST['submit']=='Submit')

	    { 
        //echo 'ok';die;
				$start_cell_row=1;/*skip first 2 heading rows */

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

						$q               =  addslashes($resultRow_from_csv[0]);
						$w            =  addslashes($resultRow_from_csv[1]);
						$e           =  addslashes($resultRow_from_csv[2]);
						$r            =  addslashes($resultRow_from_csv[3]);
						$t            =  addslashes($resultRow_from_csv[4]);
                        $y           =  addslashes($resultRow_from_csv[5]);
                        $u            =  addslashes($resultRow_from_csv[6]);
                        $i            =  addslashes($resultRow_from_csv[7]);
                        $o            =  addslashes($resultRow_from_csv[8]);
                        $p            =  addslashes($resultRow_from_csv[9]);
						$a            =  addslashes($resultRow_from_csv[10]);
						$s               =  addslashes($resultRow_from_csv[11]);
						$d           =  addslashes($resultRow_from_csv[12]);
				
						$f            =  addslashes($resultRow_from_csv[13]);
						$g            =  addslashes($resultRow_from_csv[14]);
                        $h            =  addslashes($resultRow_from_csv[15]);
                        $j            =  addslashes($resultRow_from_csv[16]);
                        $k            =  addslashes($resultRow_from_csv[17]);
                        $l            =  addslashes($resultRow_from_csv[18]);
                        $z            =  addslashes($resultRow_from_csv[19]);
						$x            =  addslashes($resultRow_from_csv[20]);
						$c               =  addslashes($resultRow_from_csv[21]);
						$v            =  addslashes($resultRow_from_csv[22]);
				
						$b            =  addslashes($resultRow_from_csv[23]);
						$n            =  addslashes($resultRow_from_csv[24]);
                        $m            =  addslashes($resultRow_from_csv[25]);
                        $qw            =  addslashes($resultRow_from_csv[26]);
                        $wr            =  addslashes($resultRow_from_csv[27]);
                        $et            =  addslashes($resultRow_from_csv[28]);
                        $tt            =  addslashes($resultRow_from_csv[29]);
					//	$yye            =  addslashes($resultRow_from_csv[30]);

					$csv_result_array  =  array(

						                               'id'              =>  '',

													   'cin'            =>$q,

													   'password'               =>$w,

													   'student_name'             =>$e,

													   'franchise_id'          => $r,

													   'franchise_code'           => $t,

													   'address1'         => $y,
													   
													   'address2'=>$u,
													   'father_phone'=>$i,
													   'father_email'=>$o,
													   'mother_phone'=>$p,
													   'mother_email'=>$a,
													   'stud_email'=>$s,
													   'stud_phone'=>$d,
													   'class'=>$f,
													   'class_id'=>$g,
													   'category_id'=>$h,
													   'school_name'=>$j,
													   'school_address1'=>$k,
													   'school_address2'=>$l,
													   'father_name'=>$z,
													   'mother_name'=>$x,
													   'school_id'=>$c,
													   'insert_date'=>$v,
													   'Udate_time'=>$b,
													   'state_id'=>$n,
													   'status'=>$m,
													   'period_id'=>$qw,
													   'gender'=>$wr,
													   'profile_img'=>$et,
													   
													 );



						//	echo "<pre>";print_r($csv_result_array);exit;					   

						 $this->db->insert('cin_list',$csv_result_array);

					 }/*End if*/

					 

					}

				$i=$i+1;	

			   }while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));

			    

			   /*............ End Do while ................*/

			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;

			   /*unset($_FILES);*/

			   $this->notifications->notify('Result Uploaded Successfully','success');

		    }/* End if */
	    }
	    $this->load->view("upload_result_file.php",$data);
	}
	
	
	public function payments()
	{

        if(isset($_POST['submit'])){
    
            // ✅ DATE FIX (IMPORTANT)
            $startDate = $_POST['start_date'];
            $endDate   = !empty($_POST['end_date']) 
            ? date('Y-m-d', strtotime($_POST['end_date'].' +1 day')) 
            : '';

        $this->db->select('*');

        if($_POST['type']=='competition'){
            $this->db->from('payment_split');
            $this->db->join(
                'competition_product_state',
                'competition_product_state.id = payment_split.comp_id',
                'left'
            );
            $this->db->where('payment_split.status','1');
            $this->db->group_by('payment_split.payment_id');

            // ✅ DATE CONDITION FIX
            if(!empty($startDate)){
                $this->db->where('payment_split.date_of_payment >=', $startDate);
            }
            if(!empty($endDate)){
                $this->db->where('payment_split.date_of_payment <', $endDate);
            }

            $this->db->order_by('payment_split.pay_id', 'DESC');
        }

        elseif($_POST['type']=='school'){
            $this->db->from('payment_split_prid');
            $this->db->group_by('payment_split_prid.payment_id');

            // ✅ DATE CONDITION FIX
            if(!empty($startDate)){
                $this->db->where('payment_split_prid.date_of_payment >=', $startDate);
            }
            if(!empty($endDate)){
                $this->db->where('payment_split_prid.date_of_payment <', $endDate);
            }

            $this->db->order_by('payment_split_prid.pay_id', 'DESC');
        }

        $query = $this->db->get();

        $data['payments'] = $query->result_array();
        $data['message'] = 'Showing payments from ' . $_POST['start_date'] . ' to ' . $_POST['end_date'];
        $data['result'] = $_POST;

    } else {

        $this->db->select('*');
        $this->db->from('payment_split');
        $this->db->join(
            'competition_product_state',
            'competition_product_state.id = payment_split.comp_id',
            'left'
        );

        $this->db->order_by('pay_id', 'DESC');
        $this->db->where('payment_split.status','1');
        $this->db->group_by('payment_split.payment_id');
        $this->db->limit(100);

        $query = $this->db->get();

        $data['payments'] = $query->result_array();
        //print_r($data['payments']);die;
        $data['message'] = 'Showing Last 100 Payments';
    }


    // ================= CSV EXPORT =================
    if (isset($_POST['export_csv']) && $_POST['export_csv'] == '1') {

        if(empty($_POST['start_date'])){

            $this->db->select('*');
            $this->db->from('payment_split');
            $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');

            $this->db->order_by('pay_id', 'DESC');
            $this->db->where('payment_split.status','1');
            $this->db->group_by('payment_split.payment_id');
            $this->db->limit(100);

            $query = $this->db->get();
            $data['payments'] = $query->result_array();

        } else {

            // ✅ DATE FIX AGAIN FOR CSV
            $startDate = $_POST['start_date'];
            $endDate   = date('Y-m-d', strtotime($_POST['end_date'].' +1 day'));

            $this->db->select('*');

            if($_POST['type']=='competition'){
                $this->db->from('payment_split');
                $this->db->where('payment_split.status','1');
            }

            if($_POST['type']=='school'){
                $this->db->from('payment_split_prid');
            }

            $this->db->join('competition_product_state', 'competition_product_state.id = payment_split.comp_id','left');

            // ✅ DATE CONDITION FIX
            $this->db->where('date_of_payment >=', $startDate);
            $this->db->where('date_of_payment <', $endDate);

            $this->db->order_by('pay_id', 'DESC');
            $this->db->group_by('payment_split.payment_id');

            $query = $this->db->get();
            $data['payments'] = $query->result_array();
        }

        // ================= DOWNLOAD CSV =================
        $filename = "payments_" . date('YmdHis') . ".csv";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $file = fopen('php://output', 'w');

        $header = array(
            "Sr. No", "Date", "CIN/PRID", "Total Pay Amount",
            "Franchise Amount", "Franchise GST", "MaRRS GST",
            "CRM Fix Amount", "Razorpay Cut", "Management Cut",
            "MaRRS Left", "Aviansys Amount", "Aviansys GST","Maker Cut"
        );
        fputcsv($file, $header);

        $i = 1;

        foreach ($data['payments'] as $value) {

            // Maker calculation
            $price = 0;
            $mes = '';

            if(!empty($value['revenue_setting_id'])){
                $resMaker = $this->db->get_where('makers_splits',[
                    'comp_id'=>$value['comp_id'],
                    'revenue_setting_id'=>$value['revenue_setting_id'],
                    'order_id'=>$value['payment_id'],
                    'transaction_id !='=>null
                ])->result();

                foreach($resMaker as $row){
                    $price += $row->price;
                }
            } else {
                $mes = 'No split for Maker';
            }

            // Main row fetch
            $res = $this->db->get_where('payment_split',[
                'comp_id'=>$value['comp_id'],
                'cin'=>$value['cin'],
                'payment_id'=>$value['payment_id']
            ])->row();

            $row = array(
                $i,
                $res->date_of_payment ?? '',
                !empty($res->cin) ? $res->cin : ($value['prid'] ?? ''),
                $res->total_amount ?? 0,
                $res->franchise_amount ?? 0,
                $res->franchise_gst ?? 0,
                $res->gst_amount ?? 0,
                $res->crm_fix ?? 0,
                $res->razpay_service ?? 0,
                $res->management_amount ?? 0,
                $res->MaRRS_bal ?? 0,
                $res->aviansys_amount ?? 0,
                $res->aviansys_gst ?? 0,
                $price . ' ' . $mes
            );

            fputcsv($file, $row);
            $i++;
        }

        fclose($file);
        exit;
    }

    $this->load->view('payment_dashboard.php',$data);
}


	public function zoomzoom_franchise()
	{
	    $data['franchise']=$this->franchisemodel->all_franchise();
	    
    	    if(isset($_POST['allow'])){
    	      //  echo 'ok';die;
    	       // print_r($_POST);die;
    	       $op=$_POST;
    	       //print_r($op);die;
    	        $it=explode('.',$_POST['allow']);
    	        
    	        //print_r($it);die;
    	        
    	        if($it[1]=='Active'){
    	            $state='Deactive';
    	        }else{
    	            $state='Active';
    	        }
    	        
    	       // echo $state.'<br>';
    	       // echo $it[0];
    	        
    	       // die;
    	        
    	        $this->db->set('status', $state);
                $this->db->where('id', $it[0]);
                $this->db->update('franchise_to_zoomzoom');
                
    	        //$query = $this->db->query("UPDATE `franchise_to_zoomzoom` SET `status` = '$state' WHERE `franchise_to_zoomzoom`.`id` = '$it[0]';");
    	        //echo $state;die;
    	        
    	   //     $this->franchisemodel->actionzoomzoom($it[0],$state);
                
            }
        
        
	    $this->load->view("zoomfranchise_list.php",$data);
	} 
	
	
	public function bulk_school_template()
	{
	    $filepath="public/template/bulk_school_marrs.csv";
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
	
	
    public function index() 
    {
        
        $franchise_id         = $this->session->userdata('franchise_id');
        
        $data['franchise']       = $this->schoolmodel->getfranchisess();
		
		//print_r($data);die;
		
		
        $this->load->view("franchiseList.php", $data);
    }
    
    
    public function zoomzoom_extract_material()
    {
        if(isset($_POST['submit'])){
          // print_r($_POST);die;
            $franchise=$_POST['franchise'];
	        $level=$_POST['level'];
	        $class=$_POST['class'];
	        $period=$_POST['period'];
	        $product=$_POST['product'];
	        $data['le']=$_POST['level'];
	        $data['cla']=$_POST['class'];
	        $data['per']=$_POST['period'];
	        $data['pro']=$_POST['product'];
	         $data['fra']=$_POST['franchise'];
            $data['student']=$this->franchisemodel->zoomzoom_studymaterial_extract($franchise,$level,$period,$class,$product);
  
             
        }
        
        //echo $data['period'];die;
        
        
        if(isset($_POST['Export'])){
             // print_r($_POST['sta']);die;
             $level=$_POST['le'];
	        $class=$_POST['cla'];
	        $period=$_POST['per'];
	        $product=$_POST['pro'];
	        $franchise=$_POST['fra'];
	        
        // echo $level.$class.$period.$product.$franchise;die;
   
            $tudent=$this->franchisemodel->zoomzoom_studymaterial_extract($franchise,$level,$period,$class,$product);
    
            $n=1;
		    foreach($tudent as $item)
		    {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['zoomzoom_prid'] ,
        			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
        			   $period,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'] ,
        			   $item['email'] ,
        			   $item['address_line'], 
        			   $item['whatsapp'],
        			   $item['product_name'],
        			   $item['cin'],
        			  'Paid'
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"Study Material Extract Zoomzoom".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Period','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','CIN','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
   
        $data['status']=$status;
        $this->load->view('zoomzoom_extract_material.php',$data);
    }
    
    
    public function zoomzoom_extract_orientation()
    {
        if(isset($_POST['submit'])){
         //  print_r($_POST);die;
            $franchise=$_POST['franchise'];
	        $level=$_POST['level'];
	        $class=$_POST['class'];
	        $period=$_POST['period'];
	        $product=$_POST['product'];
	        $data['le']=$_POST['level'];
	        $data['cla']=$_POST['class'];
	        $data['per']=$_POST['period'];
	        $data['pro']=$_POST['product'];
	         $data['fra']=$_POST['franchise'];
	         
	        // echo $product;die;
            $data['student']=$this->franchisemodel->zoomzoom_orientation_extract($franchise,$level,$period,$class,$product);
  
             
        }
        
        //echo $data['period'];die;
        
        
            if(isset($_POST['Export']))
            {
                // print_r($_POST['sta']);die;
                $level=$_POST['le'];
	            $class=$_POST['cla'];
	            $period=$_POST['per'];
	            $product=$_POST['pro'];
	            $franchise=$_POST['fra'];
	        
                // echo $level.$class.$period.$product.$franchise;die;
   
                $tudent=$this->franchisemodel->zoomzoom_orientation_extract($franchise,$level,$period,$class,$product);
    
                $n=1;
    		    foreach($tudent as $item)
    		    {
    		        //print_r($item);die;
    		   	    $item['serial_no']=$n;
        			    $data []=array( 
            			  
            			   $item['serial_no'],
            			   $item['zoomzoom_prid'] ,
            			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
            			   $period,
            			   $item['class']  ,
            			   $item['father_name'],
            			   $item['mother_name'],
            			   $item['mobile'] ,
            			   $item['email'] ,
            			   $item['address_line'], 
            			   $item['whatsapp'],
            			   $item['product_name'],
            			   $item['cin'],
            			  'Paid'
        			        );
    			   //echo $item['serial_no'];exit;
    			    $n++;
    		    }
	            //	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"Study Material Extract Zoomzoom".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Period','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','CIN','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
   
        $data['status']=$status;
        $this->load->view('zoomzoom_extract_orientation.php',$data);
    }
    
    
    public function zoomzoom_mocktest_orientation()
    {
        if(isset($_POST['submit'])){
         //  print_r($_POST);die;
            $franchise=$_POST['franchise'];
	        $level=$_POST['level'];
	        $class=$_POST['class'];
	        $period=$_POST['period'];
	        $product=$_POST['product'];
	        $data['le']=$_POST['level'];
	        $data['cla']=$_POST['class'];
	        $data['per']=$_POST['period'];
	        $data['pro']=$_POST['product'];
	         $data['fra']=$_POST['franchise'];
	         
	        // echo $product;die;
            $data['student']=$this->franchisemodel->zoomzoom_mocktest_extract($franchise,$level,$period,$class,$product);
  
             
        }
        
        //echo $data['period'];die;
        
        
        if(isset($_POST['Export'])){
             // print_r($_POST['sta']);die;
             $level=$_POST['le'];
	        $class=$_POST['cla'];
	        $period=$_POST['per'];
	        $product=$_POST['pro'];
	        $franchise=$_POST['fra'];
	        
        //  echo $level.$class.$period.$product.$franchise;die;
   
            $tudent=$this->franchisemodel->zoomzoom_mocktest_extract($franchise,$level,$period,$class,$product);
    
            $n=1;
		foreach($tudent as $item)
		{
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['zoomzoom_prid'] ,
        			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
        			   $period,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'] ,
        			   $item['email'] ,
        			   $item['address_line'], 
        			   $item['whatsapp'],
        			   $item['product_name'],
        			   $item['cin'],
        			  'Paid'
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"Study Material Extract Zoomzoom".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Period','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','CIN','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
   
       $data['status']=$status;
        $this->load->view('zoomzoom_mocktest_orientation.php',$data);
    }
    
    
    public function search_school()
    {
        //echo 'search_school';die;
        	if (isset($_POST['submit']))
			{   
			    if($_POST['school'] != 'All'){
			    $data['schoolList']=$this->db->get_where('school_new', array('id' => $_POST['school']))->row_array();
			    }
			    else{
			       $data['message']='Select One School ...';
			    }
			    $data['result']=$_POST;
			    
			}
          
          
         if(isset($_POST['upload'])){
	       // print_r($_POST);
	       // print_r($_FILES);die;
	        $config['upload_path'] = '../images/school/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; 
            $config['encrypt_name'] = TRUE; 

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file1')) {
                
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                
                $data = $this->upload->data();
                $file_name = $data['file_name'];

                
                $this->db->set('profile', $file_name);
                $this->db->where('id', $_POST['upload']);
                $this->db->update('school_new');
            }
            $data['message']='School Logo added successfully ...';
	    }
	     
          
        if(isset($data['result']['state_id'])){
        $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
        }
        
        if(isset($data['result']['country'])){
        $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
        
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        if(isset($data['result']['area'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        
        
        $this->load->view('search_school.php',$data);
    }
    
    
    public function assign_product()
    {
        //echo 'search_school';die;
    	if (isset($_POST['submit']))
		{   
		    if(!empty($_POST['class_id'])){ 
			 //   print_r($_POST);die;
			 $this->db->select('*');
			 $this->db->from('open_school_assign');
			 $this->db->where('product',$_POST['product']);
			 $this->db->where('period',$_POST['period']);
			 $this->db->where('school_id',$_POST['school']);
			 $query=$this->db->get();
			 $res=$query->result();
			 if(empty($res)){
    			    $ar=array(
    			        'product'=>$_POST['product'],
    			        'period'=>$_POST['period'],
    			        'start_date'=>$_POST['start_date'],
    			        'end_date'=>$_POST['end_date'],
    			        'country_id'=>$_POST['country'],
    			        'state_id'=>$_POST['state_id'],
    			        'school_id'=>$_POST['school']
    			        );
    			        
    			    $this->db->insert('open_school_assign',$ar); 
    			    
    			    $open_school_assign_id=$this->db->insert_id();
    			    foreach($_POST['class_id'] as $class){
    			        $arr=array(
    			            'class'=>$class,
    			            'open_school_assign_id'=>$open_school_assign_id
    			        );
    			        $this->db->insert('open_school_assign_class',$arr);
    			    }
    			    
			    $data['message']='Product Assigned ...';
			 }else{
			 $data['message']='Product Already Assigned ...';
			 }
		   }else{
		        $data['message']='Select Class ...';
		   }
		    
		    $data['result']=$_POST;
		}
        
        if (isset($_POST['delete']) && !empty($_POST['school_id'])) 
        {
            $school_id = $_POST['school_id'];
            
            $this->db->where('open_school_assign_id', $school_id);
            $this->db->delete('open_school_assign');
            
            $this->db->where('open_school_assign_id', $school_id);
            $this->db->delete('open_school_assign_class');
            
            $data['message'] = 'Record Deleted ...';
        } 
        
        if(isset($_POST['edit'])){
            print_r($_POST);die;
        }
		
        $this->db->select('open_school_assign.*,states.state_subdivision_name,period.academic_year,school_new.*');
        $this->db->from('open_school_assign');
        $this->db->join('school_new','school_new.id=open_school_assign.school_id');
        $this->db->join('period','period.period_id=open_school_assign.period');
        $this->db->join('states','states.state_subdivision_id=open_school_assign.state_id');
        $this->db->order_by('open_school_assign_id','DESC');
        $this->db->limit(10);
        $query=$this->db->get();
        $data['schoolList']=$query->result_array();
        
        $this->load->view('assign_product.php',$data);
    }

    
    public function edit_search_school()
    {
        // echo 'search_school';die;
        if (isset($_POST['submit']))
		{   
			 //print_r($_POST);die;
	        $this->db->select('product_to_school.id as com_id,product_to_school.*,school_new.*,franchise.franchise_first_name,franchise.franchise_last_name,franchise.franchise_code');    
	        $this->db->from('product_to_school');
	        $this->db->join('franchise','franchise.franchise_id=product_to_school.franchise_id');
	        $this->db->join('school_new','school_new.id=product_to_school.school_id');
	        if($_POST['school_id'] != 'All' or $_POST['school_id'] != ''){
	            $this->db->where('school_id',$_POST['school_id']);
	        }
	       // $this->db->where('product_name',$_POST['product']);
	        $this->db->where('period_id',$_POST['period']);
	        $this->db->where('school_new.state',$_POST['state_id']);
	        $query=$this->db->get();
	       // echo $this->db->last_query();
	        $data['schoolList']=$query->result();

		    $data['result']=$_POST;
			    
		}
          
        if(isset($_POST['Update']))
        {
            // print_r($_POST);die;
            
            $this->db->where('school_id',$_POST['school_id']);
            $this->db->update('product_to_school',array('start_date'=>$_POST['start_date'],'end_date'=>$_POST['end_date']));
            $ar=array(
                'franchise_per'=>$_POST['franchise_per'],
                'amount'=>$_POST['amount'],
                'school_amount'=>$_POST['school_amount']
                );
            
            $this->db->where('id',$_POST['Update']);
            $this->db->update('product_to_school',$ar);
            
            $this->db->select('product_to_school.id as com_id,product_to_school.*,school_new.*');    
	        $this->db->from('product_to_school');
	     //   $this->db->join('franchise','franchise.franchise_id=product_to_school.franchise_id');
	        $this->db->join('school_new','school_new.id=product_to_school.school_id');
	        $this->db->where('product_to_school.id',$_POST['Update']);
	        $query=$this->db->get();
	     //   echo $this->db->last_query();
	        $data['schoolList']=$query->result();
        }
        
        if(isset($data['result']['state_id']))
        {
            $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
        }
        
        if(isset($data['result']['country']))
        {
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
        
        
            $data['periodload'] = $this->db->get_where('period',array('status'=>'Active'))->result_array();
        
        
        if(isset($data['result']['franchise_id']))
        {
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        if(isset($data['result']['area']))
        {
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
        // echo 'ok';die;
        $this->load->view('edit_search_school',$data);
    }
    
    
    public function delete_product()
    {
        
        $this->db->where('id',$this->uri->segment(4));
        $this->db->delete('product_to_school');
    }
    
    
    public function cmsch()
    {
        
        if(isset($_POST['submit'])){
           
            foreach($_POST['schools'] as $school){
                //   print_r($_POST);die;
                foreach($_POST['products'] as $product){
                    $ar=array(
                    'school_id'=>$school,
                    'product_name'=>$product,
                    'period_id'=>'14',
                    'school_amount'=>$_POST['school_amount'],
                    'amount'=>$_POST['amount'],
                    'franchise_id'=>$_POST['franchise_id'],
                    'franchise_per'=>$_POST['franchise_cut'],
                    'start_date'=>$_POST['start_date'],
                    'end_date'=>$_POST['end_date']
                    );
                    // print_R($ar);die;
                     $this->db->insert('product_to_school',$ar);
                }
            }
           
           $data['message']='Products assigned to school successfully ...';
            
        }
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
            }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        $this->load->view("cmsch",$data);
        
    }
    
    
    public function split_pay()
    {
        if(isset($_POST['submit'])){
            $data['result']=$_POST;
            // print_r($_POST);die;
            $this->db->select('*');
            $this->db->from('payment_split_prid');
            $this->db->join('school_new','school_new.id=payment_split_prid.school_id');
            $this->db->join('students','students.PRID=payment_split_prid.prid');
            if($_POST['school']!='All'){
            $this->db->where('school_new.id',$_POST['school']);
            }
            $this->db->where('payment_split_prid.franchise_id',$_POST['franchise_id']);
            // $this->db->where('payment_split_prid.school_id',$_POST['school']);
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            $data['pay_list']=$query->result();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
            }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        if(isset($data['result']['area'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        $this->load->view('split_pay',$data);
    }
    
    
    public function cin_prid_extract()
    {
        if(isset($_POST['submit'])){
            $data['result']=$_POST;
            // print_r($_POST);die;
            $this->db->select('cin_list.student_name,cin_list.class,product_purchase.cin,product_purchase.prid,school_new.school_name,students.email,students.mobile,cin_list.franchise_code,students.address1,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('product_purchase');
            $this->db->join('cin_list','cin_list.cin=product_purchase.cin');
            $this->db->join('students','students.PRID=product_purchase.prid','LEFT');
            $this->db->join('school_new','school_new.id=cin_list.school_id','LEFT');
            $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id','LEFT');
            if($_POST['school']!='All'){
            $this->db->where('school_new.id',$_POST['school']);
            }
            $this->db->where('product_purchase.product_name',$_POST['product']);
            $this->db->where('cin_list.franchise_code',$_POST['area']);
            $this->db->group_by('product_purchase.cin');
            $query=$this->db->get();
            // echo $this->db->last_query();die;
            $data['pay_list']=$query->result();
        }
        
        if (isset($_POST['Export'])) {
            $this->db->select('cin_list.student_name,cin_list.class,product_purchase.cin,product_purchase.prid,school_new.school_name,students.email,students.mobile,cin_list.franchise_code,students.address1,franchise.franchise_first_name,franchise.franchise_last_name');
            $this->db->from('product_purchase');
            $this->db->join('cin_list','cin_list.cin=product_purchase.cin');
            $this->db->join('students','students.PRID=product_purchase.prid','LEFT');
            $this->db->join('school_new','school_new.id=cin_list.school_id','LEFT');
            $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id','LEFT');
            if ($_POST['school'] != 'All') {
                $this->db->where('school_new.id', $_POST['school']);
            }
            $this->db->where('product_purchase.product_name', $_POST['product']);
            $this->db->where('cin_list.franchise_code', $_POST['area']);
            $this->db->group_by('product_purchase.cin');
            $query = $this->db->get();
        
            $students = $query->result();
            $data = [];
            $n = 0;

                foreach ($students as $item) {
                    $serial_no = $n + 1; // Increment the serial number
                    $data[] = [
                        'serial_no' => $serial_no,
                        'cin' => $item->cin,
                        'prid' => $item->prid,
                        'student_name' => $item->student_name,
                        'school_name' => $item->school_name,
                        'class' => $item->class,
                        'mobile' => $item->mobile,
                        'email' => $item->email,
                        'franchise_code' => $item->franchise_code,
                        'product_name' => $_POST['product'] // Assuming the product name is from the POST data
                    ];
            
                    $file_name = $item->franchise_code . '_' . $_POST['product'] . '_CIN_PRID';
                    $n++;
                }

    
                header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
            
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Serial No', 'CIN', 'PRID', 'Student Name', 'School', 'Class', 'Mobile', 'Email', 'Area Code', 'Product name']);
            
                foreach ($data as $key) {
                    fputcsv($handle, $key);
                }
                fclose($handle);
                exit;
            }

        
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
            }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        if(isset($data['result']['area'])){
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        $this->load->view('cin_prid_extract',$data);
    }
    
    
    public function school_assign_product()
    {
        
        $school_id=$this->uri->segment(4);
        
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            foreach($_POST['products'] as $product){
                $ar=array(
                    'product_name'=>$product,
                    'school_id'=>$school_id,
                    'period_id'=>'14',
                    'level_id'=>'1',
                    'amount'=>$_POST['price']
                    );
                $this->db->insert('product_to_school',$ar);
            }
            $data['message']='Product and Price asssigned, close tab ..';
            // redirect('manage/search_school');
        }
        
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['productlist'] = $query->result_array();
            
            $this->db->select('*');
            $this->db->from('price_code');
            $this->db->where('status','Active');
            $query=$this->db->get();
            $data['price_codes'] = $query->result_array();
            
        $this->load->view("school_assign_product",$data);
    }
    
    
    public function zoomzoom_extract()
    {
        //echo 'ok';die;
        if(isset($_POST['submit'])){
           //print_r($_POST);die;
            $franchise=$_POST['franchise'];
	        $level=$_POST['level'];
	        $class=$_POST['class'];
	        $period=$_POST['period'];
	        $status=$_POST['status'];
	        
	        $data['le']=$_POST['level'];
	        $data['cla']=$_POST['class'];
	        $data['per']=$_POST['period'];
	        $data['sta']=$_POST['status'];
	         $data['fra']=$_POST['franchise'];
            $student=$this->franchisemodel->zoomzoom_student_list($franchise,$level,$period,$class);
        //echo $status;die;
            if($status=='Paid'){
                $data['student']=$this->franchisemodel->zoomzoom_student_list_data($franchise,$level,$period,$class);
            }
            else{
              //  $data['student']=$this->franchisemodel->zoomzoom_student_list_data_unpaid($franchise,$level,$period,$class);

                $this->db->select('zoomzoom_prid');
    	        $this->db->from('student_to_zoomzoom');
    	        $res = $this->db->get();
    	  //  echo $this->db->last_query();
    	    $result =  $res->result();
    	    //print_r($result);die;
                $arr=array();
                foreach($result as $row){
                        $this->db->select('prid');
                        $this->db->from('zoomzoom_to_cin');
                        $this->db->where('prid',$row->zoomzoom_prid);
                        $query = $this->db->get();
                        $check=$query->result();
                    if(empty($check)){
                        array_push($arr,$row->zoomzoom_prid);
                    }
                }
                //print_r($arr);die;
                $data['student']=$this->franchisemodel->zoomzoom_student_list_data_unpaid($arr,$class,$franchise,$level,$period);
                
            }
             
        }
        
        //echo $data['period'];die;
        
        
            if(isset($_POST['Export'])){
                // print_r($_POST['sta']);die;
                $level=$_POST['le'];
    	        $class=$_POST['cla'];
    	        $period=$_POST['per'];
    	        $status=$_POST['sta'];
    	        $franchise=$_POST['fra'];
    	        
                // echo $level.$class.$period.$status.$franchise;
                 
                //  die;
             
            if($status=='Paid'){
                $tudent=$this->franchisemodel->zoomzoom_student_list_data($franchise,$level,$period,$class);
            }
            else{
              
                $this->db->select('zoomzoom_prid');
    	    $this->db->from('student_to_zoomzoom');
    	    $res = $this->db->get();
    	  //  echo $this->db->last_query();
    	    $result =  $res->result();
                $arr=array();
                foreach($result as $row){
                        $this->db->select('prid');
                        $this->db->from('zoomzoom_to_cin');
                        $this->db->where('prid',$row->zoomzoom_prid);
                        $query = $this->db->get();
                        $check=$query->result();
                    if(empty($check)){
                        array_push($arr,$row->zoomzoom_prid);
                    }
                }
                
                $tudent=$this->franchisemodel->zoomzoom_student_list_data_unpaid($arr,$class,$franchise,$level,$period);
                
            }
             
             
             
           
            $n=1;
		  foreach($tudent as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['zoomzoom_prid'] ,
        			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
        			   $period,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'] ,
        			   $item['email'] ,
        			   $item['address_line'], 
        			   $item['whatsapp'],
        			   'MaRRS ZoomZoom',
        			  $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"Competition Extract Zoomzoom".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Period','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
        
    
        $data['status']=$status;
        $this->load->view('zoomzoom_extract_franchise.php',$data);
    }
    
    
    public function franchise_schoollist()
    {
        if(isset($_POST['submit'])){
            //echo 'ok';die;
            $school = $this->franchisemodel->school_codes($_POST['franchise']);
	        $array=array();
	         foreach($school as $row){
	            array_push($array,$row['school_code']);
	         }
            $data['student'] = $this->franchisemodel->student_list($_POST,$array,$levels,$product,$class);
        }
        if(isset($_POST['Export'])){
            $school = $this->franchisemodel->school_codes($_POST['franchise']);
	        $array=array();
	         foreach($school as $row){
	            array_push($array,$row['school_code']);
	         }
            $student = $this->franchisemodel->student_list($_POST,$array,$levels,$product,$class);
            $n=1;
		  foreach($student as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['PRID'] ,
        			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
        			   $item['school_code']  ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'] ,
        			   $item['email'] ,
        			   $item['address1']. "  " .$item['address2'], 
        			   $item['whatsapp'],
        			   $item['product_name'],
        			   $item['payment_status']
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"test".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','School Code','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
        $this->load->view('franhcise_student_list.php',$data);
    }
    
    
    public function student_list()
    {
        //echo 'ok';die;
        if(isset($_POST['submit'])){
            //echo 'ok';die;
            $school = $this->input->post('school');
            $levels = $this->input->post('level');
            $product = $this->input->post('product');
            $class = $this->input->post('class');
            // print_r($class);die;
           // print_r($_POST['school']);die;
            // unset($_POST,'submit');
            $data['student'] = $this->franchisemodel->student_list($_POST,$school,$levels,$product,$class);
            // $student = $this->franchisemodel->student_list($_POST,$school,$levels,$product,$class);
        }
        
        //  print_r($student);
        if(isset($_POST['Export'])){
            
            // $student=$_POST['student'];
            // echo gettype($student);
            // print_r($_POST);die;
            
            $school = $this->input->post('school');
            $levels = $this->input->post('level');
            $product = $this->input->post('product');
            $class = $this->input->post('class');
            $student = $this->franchisemodel->student_list($_POST,$school,$levels,$product,$class);
            
		    $n=1;
		    foreach($student as $item)
		    {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['PRID'] ,
        			   $item['first_name']. "  " .$item['middle_name']. "  " .$item['last_name'],
        			   $item['school_code']  ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'] ,
        			   $item['email'] ,
        			   $item['address1']. "  " .$item['address2'], 
        			   $item['whatsapp'],
        			   $item['product_name'],
        			   $item['payment_status']
    			        );
			   //echo $item['serial_no'];exit;
    			$n++;
    		}
	        //	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"test".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','School Code','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
        // $this->export_student_data($data['student']);
        $this->load->view('student_list.php',$data);
    }
    
    
    public function export_student_data($student='')
    {
        echo 'ok';
    }
    
    
    public function ok($id='')
    {
    //   print_r($_POST['id']);die;
        $franchiseid = $_POST['id'];
        // echo $franchiseid;die;
         $this->db->select('*');
		 $this->db->from('schools');
		 $this->db->where('franchise_id',$franchiseid);
		 $this->db->where('school_code IS NOT NULL');
// 		 $this->db->order_by("state_subdivision_name", "asc");
		 $query = $this->db->get(); 
// 		 echo $this->db->last_query();
	     $que = $query->result_array();
	     foreach($que as $value){?>
	     <option value="<?php echo $value['school_code'];?>"><?php echo $value['school_name'];?></option>
	     <?php }
         
    
    }
    
    
    public function period()
    {
        $this->db->select('*');
        $this->db->from('period');
       // $this->db->where('franchise_id',$uri);
        $res = $this->db->get();
        
        $data['period']=$res->result_array();
        $this->load->view("period.php",$data);
    }
    
    
    public function level()
    {
        $this->db->select('*');
        $this->db->from('competition_levels');
       // $this->db->where('franchise_id',$uri);
        $res = $this->db->get();
        
        $data['level']=$res->result_array();
        $this->load->view("level.php",$data);
    }
    
    
    public function status_activate($id='')
    {
        $uri= $this->uri->segment(4);
        $this->db->select('status');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$uri);
        $result = $this->db->get()->row();
        $status = $result->status;
        
        if($status=="Active")
        {
        $data = array('status' =>'Deactive');
        }else{
        $data = array('status' =>'Active');
        }
        $this->db->where('franchise_id',$uri);
        $this->db->update('franchise',$data);
        redirect('manage/franchise/franchiseView/');
    
    }
    
    
    public function schoolaccees()
    {
        $uri = $this->uri->segment(4);
        //print_r($uri);
        $data['access_detail']=$this->db->get_where('school_new',array('id'=>$uri))->row_array();
        // print_r($data['access_detail']);die;
         $franchise = $data['access_detail']['franchise_id'];
         $school_code = $data['access_detail']['school_code'];
        if(isset($_POST['submit']))
        	{
			  //print_r($_POST);exit;
			    $product_id =$this->input->post('product_id');
			    $price = $this->input->post('product_price');
			    
			    $school_board=  $this->input->post('school_board');
			  
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$post_data      = array(
										'school_name' => $this->input->post('school_name'),
										'school_address' => $this->input->post('school_address'),
										'school_principal_name' => $this->input->post('principal_first_name'),
									//	'principal_last_name' => $this->input->post('principal_last_name'),
										'school_coordinator_name' => $this->input->post('school_coordinator_first_name'),
										//'school_coordinator_last_name' => $this->input->post('school_coordinator_last_name'),
										'school_coordinator_email' => $this->input->post('school_coordinator_email'),
										'coordinator_phone' => $this->input->post('school_coordinator_phone'),
										'country' => $this->input->post('country_id'),
										'state' => $this->input->post('stateID'),
										'city' => $this->input->post('city'),
										'location' => $this->input->post('school_locality'),
										'district' => $this->input->post('school_district'),
										'school_phone' => $this->input->post('school_phone'),
										'school_mobile' => $this->input->post('school_mobile'),
										'school_email' => $this->input->post('school_email'),
										'school_board' => $school_board,
										'school_medium' => $this->input->post('school_medium'),
									//	'school_concern_status' => $this->input->post('school_concern_status'),
										'pin' => $this->input->post('school_pincode')
										
				                );
				$this->validation->set_data($post_data);
				//print_r($post_data);exit;
			//	//$this->validation->set_rules('school_name', 'school name', 'required');
				$this->validation->set_rules('school_address', 'school address', 'required');
			//	$this->validation->set_rules('principal_first_name', 'principal name', 'required');
				//$this->validation->set_rules('school_coordinator_first_name', 'school coordinator name', 'required');
			//	$this->validation->set_rules('school_coordinator_email', 'school coordinator email', 'required');
				//$this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
			//	$this->validation->set_rules('country_id', 'country', 'required');
			//	$this->validation->set_rules('stateID', 'state', 'required');
			
				
				$this->validation->set_data($post_data);
				 
				if ($this->validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
				} 
				else
				{
				    //print_r($post_data);exit;
					$this->db->where('id',$uri); 
					$db_status=$this->db->update('school_new',$post_data);
					
				// 	$product_id = $this->input->post('product_id');
				// 	$price = $this->input->post('product_price');
					
			
					
			
					 foreach($product_id as $key=>$product){
					    $productId1 = $product;
			            $productprice1 = $price[$key];
			            $prod = $this->db->get_where('product_to_school',array('product_id'=>$productId1,'franchise_id'=>$franchise))->row_array();
			           // print_r($prod);die;
			       	    //if(!empty($prod)){
			       	 //   $csv_filter_code = 
			       	 //         array('pricecode_id'=>$productprice1,
			       	 //               'product_id'=>$productId1,
            //         			    'school_id'=>$uri,
            //         				'level_id'=>'1',
            //         				'period_id'=>'13',
            //         				'school_code'=>$school_code,
            //         			    'franchise_id'=>$franchise
            //         				);
            //         				$this->db->where('product_id',$productId1);
            //         				$this->db->where('franchise_id',$franchise);
            //         				$this->db->update('product_to_school',$csv_filter_code);
            //                           //$ins_status= $this->db->insert('product_to_school', $csv_filter_code);    
			       	 //   }else{
			       	        $csv_filter_code = 
			       	          array('pricecode_id'=>$productprice1,
			       	                'product_id'=>$productId1,
                    			    'school_id'=>$uri,
                    				'level_id'=>'1',
                    				'period_id'=>'13',
                    				'school_code'=>$school_code,
                    			    'franchise_id'=>$franchise
                    				);
                    				
			       	      $ins_status= $this->db->insert('product_to_school', $csv_filter_code);
			       	    
	              
				}
					if($db_status)
					{
					 
			        
				
						$this->notifications->notify('School Updated  succesfully', 'success');
						
					}/* end of if(db_status)*/
					else
					{
						$this->notifications->notify('Oops!!!!....Failed update school','error');
					}/* end else of if(db_status)*/
					redirect('manage/franchise/schooListView/', 'refresh');
				}
			}
        $this->load->view('school_access_detail.php',$data);
        
    }   
     
     
    public function getschoollist($id='')
    {
        $pincode = $this->input->post('pincode');
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('school_pincode',$pincode);
        $res = $this->db->get();
        $result = $res->result();
        //echo json_encode( $result );
       ?>
      
         <label for="second">
          <input type="checkbox" id="second" value="0" checked>&nbsp;
          Add New School
        </label>
        
       <?php foreach($result as $val){ ?>
         <label for="first">
         
        <input type="checkbox" name="school_names" id="school_check"  value="<?php echo $val->school_id;?>">&nbsp;<?php echo $val->school_name.' '. $val->school_address.' '.$val->school_locality;?></label>
       
        <?php } ?>
      
         
        <?php 
        
    }
    
    
    public function getschooldetails($id='')
    {
        $id = $this->input->post('school_id');
        $this->db->select('*');
        $this->db->from('schools');
        $this->db->where('school_id',$id);
        $res = $this->db->get();
        $result = $res->result();
        //echo json_encode( $result );
       ?>
        <table class="table table-bordered" width="75%">
           <tr>
                <th>School Name</th>
                <th>Address</th>
                <th>Schol Board</th>
                <th>School Access Code</th> 
                <th>School Medium</th>
           </tr>
       <?php foreach($result as $val){ ?>
      <tr>
          <td><?php echo $val->school_name;?></td>   
          <td><?php echo $val->school_address;?></td> 
          <td><?php echo $val->school_board;?></td>
          <td><?php echo $val->school_code;?></td>
          <td><?php echo $val->school_medium;?></td>
               
          
      </tr>
     
        
        <?php } ?>
      
         </table>
         <?php 
         
    }
    
    
    public function getstatecitylist($id='')
    {
        $pincode=$_POST['pincode'];
        $country= $_POST['country'];
         //print_r($_POST);exit;
         
        $data=file_get_contents('https://api.worldpostallocations.com/?postalcode='.$pincode.'&countrycode='.$country);
        $data=json_decode($data);
        // print_r($data->result[0]);exit;
        if(isset($data->result[0]))
        {
    	    $arr['city']=$data->result[0]->province;
    	    $arr['state']=$data->result[0]->state;
    	    $arr['district']=$data->result[0]->district;
    	    $arr['country']=$data->result[0]->country;
    	    //$arr['locality']=$data->PostOffice['0']->Name;
    	    echo json_encode($arr);
        }else{
        	echo 'no';
        }
         
    }
    
    
    public function acces_code_apporved()
    {
         $data['access_code'] = $this->schoolmodel->getaccescode();
         $this->load->view("pricecodelist.php", $data);
        
    }
    
    
    public function productdelete()
    {
        $uri= $this->uri->segment(4);
        
        $this->db->where('product_id',$uri);
        $this->db->delete('products');
        
        $this->db->where('product_id',$uri);
        $this->db->delete('product_class_applicable');
        
        $this->db->where('product_id',$uri);
        $this->db->delete('competition_level_byproduct');
        
        $this->db->where('product_id',$uri);
        $this->db->delete('categoryBYProduct');
        
        $this->db->where('product_id',$uri);
        $this->db->delete('certificate_image');
        
        
        redirect('manage/franchise/productList');
    }
    
    
    public function price_codedlt()
    {
        $uri= $this->uri->segment(4);
        $this->db->where('id',$uri);
        $this->db->delete('price_codegenration');
        redirect('manage/franchise/accesscode_apporvedList');
    }
    
    
    public function franchisedelete()
    {
        $uri= $this->uri->segment(4);
        $this->db->where('franchise_id',$uri);
        $this->db->delete('franchise');
        redirect('manage/franchise/franchiseView');
    }
    
    
    public function zoomfranchisedelete()
    {
        $uri= $this->uri->segment(4);
        
        
        $this->db->select('status');
        $this->db->from('franchise_to_zoomzoom');
        $this->db->where('id',$uri);
        $res = $this->db->get();
        $result = $res->result_array();
       
        //print_r($result[0]['status']);exit;
        if($result[0]['status']=='Active'){
            $state='Deactive';
        }else{
            $state='Active';
        }
        
            $this->db->set('status', $state);
            $this->db->where('id', $uri);
            $this->db->update('franchise_to_zoomzoom');    
        
        
        
        redirect('manage/franchise/zoomzoom_franchise');
    }
    
    
    public function accesscode_apporvedList()
    {
         $data['access_code'] = $this->schoolmodel->getaccescodeapporved();
         $this->load->view("price_code_apporvedList.php", $data);
        
    }
    
    
    public function assignPricecodeToSchool()
    {
         $pricecode_id = $this->uri->segment(4);
         $data['price_code'] = $this->uri->segment(4);
         if(isset($_POST['submit'])){
             
             $franchise_id = $this->input->post('franchise');
             $area_code = $this->input->post('area_code');
             $product_id =  $this->input->post('product_name');
             $array = array(
                 
                 'franchise_id' =>$franchise_id,
                 'pricecode_id' =>$pricecode_id,
                 'product_id' =>$product_id,
                 'status' =>'Active'
                 );
            //print_r($array);die;
            if($product_id > 1){
             $this->db->insert('directlink_franchise',$array);
             $this->session->set_flashdata('success','Price Code Assign to franchise Successfully');
              
            }
         }
         $this->db->select('products.product_name,franchise.username,price_codegenration.price_code,directlink_franchise.id,directlink_franchise.franchise_id,directlink_franchise.product_id,directlink_franchise.status');
         $this->db->from('directlink_franchise');
         $this->db->join('products', 'directlink_franchise.product_id=products.product_id');
         $this->db->join('franchise', 'directlink_franchise.franchise_id=franchise.franchise_id');
         $this->db->join('price_codegenration', 'directlink_franchise.pricecode_id=price_codegenration.id');
         $this->db->where('directlink_franchise.status','Active');
         $res =  $this->db->get();
         $data['link']=$res->result_array();
         
         $this->load->view("pricecodeAssignToSchool.php",$data);
    }
    
    
    public function deletelink()
    {
       $id= $this->uri->segment(4);
       
	      $this->db->where('id', $id);
	     $this->db->delete('directlink_franchise');
	     
	   redirect('manage/franchise/assignPricecodeToSchool');
        
    }
        
        
    public function submitAssignPricecodeToSchool()
    {
        // print_r($_POST);die;
         $product_id = $_POST['product_name'];
         $franchise = $_POST['franchise'];
         $price_code = $_POST['price_code'];
         $res = $this->db->get_where('franchise_to_pricecode',array('franchise_id' =>$franchise,'pricecode_id' =>$price_code,'product_id'=>$product_id))->result_array();
         if($product_id=='1'){
                    $product = $this->db->order_by('product_name')->get_where('products',array('status'=>'Active'))->result_array();
                    foreach($product as $value){
                     $res2 = $this->db->get_where('franchise_to_pricecode',array('franchise_id' =>$franchise,'pricecode_id' =>$price_code,'product_id'=>$value['product_id']))->row_array(); 
                     
                     if(empty($res2)){
                     $array = array(
                         'product_id' =>$value['product_id'],
                         'franchise_id' =>$franchise,
                         'level_id' =>$_POST['level'],
                         'pricecode_id' =>$price_code
                        
                         );
                         
                         $this->db->insert('franchise_to_pricecode',$array);
                    
                     }
                     }
                    
                    $this->session->set_flashdata('success','Price Code Assign to franchise Successfully');
                    redirect('manage/franchise/accesscode_apporvedList'); 
             
         }
         
        
        if(!empty($res)){
             $this->session->set_flashdata('error','Price Code Allready Assigned');
             redirect('manage/franchise/accesscode_apporvedList');
        }else{
         $array = array(
             'product_id' =>$product_id,
             'franchise_id' =>$franchise,
             'level_id' =>$_POST['level'],
             'pricecode_id' =>$price_code
            
             );
             $this->db->insert('franchise_to_pricecode',$array);
        
            $this->session->set_flashdata('success','Price Code Assign to franchise Successfully');
            redirect('manage/franchise/accesscode_apporvedList');
        }
    }
     
     
    public function pricecodestatus()
    {
        $uri = $this->uri->segment(4);
         $uri2 = $this->uri->segment(5);
        //print_r($uri);exit;
        $this->db->select('school_code');
        $this->db->from('schools');
        $this->db->where('school_id',$uri);
        $res = $this->db->get();
        $result = $res->row();
        $school_code =  $result->school_code;
        //print_r($uri);exit;
       
        $data = array(
            'status' =>'Active'
           
            );
		 
		 $this->db->where('franchise_id',$uri);
		 $this->db->where('product_price',$uri2);
	     $set_status= $this->db->update('price_codegenration',$data);
		 if($set_status)
			 {
						     
                $this->notifications->notify('Pricecode Activate Successfully ', 'success');
			 } 
			 else
			{
		    	$this->notifications->notify('Pricecode Generation Failed', 'error');
			}
           
			redirect('https://marrs.in/franchiselogin/manage/franchise/acces_code_apporved/');
    }
    
    
	public function generate_accesscode()
	{
				$franchise_id   = $this->session->userdata('franchise_id');
				$params  = array( 'role'=>'No_Accesscode','franchise_id' => $franchise_id );
				$data['list']      = $this->schoolmodel->no_accescode_schools($params);
			   	//print_r($data);exit;
				if(isset($_POST['submit']))
				{
				    //print_r($_POST['school_id']);exit;
						$data = $_POST['school_id'];
						$toemail = $this->input->post('school_email');
					    $no_stchool_id=count($data);
					    //print_r($data);exit;
						foreach($data as $value)
						{
						$schoolID=$value;
						//	$set_status = $this->schoolmodel->set_access_code($schoolID);
							
							
            		  $this->db->select('franchise_id');
            		  $this->db->from('schools');
            		  $this->db->where('school_id',$schoolID);
            		  $Step1Query = $this->db->get();  
            		  $Step1QueryResult=$Step1Query->row_array();
            		  $f_id = $Step1QueryResult['franchise_id'];
            		  
            		  
            		  $this->db->select('franchise_code');
            		  $this->db->from('franchise');
            		  $this->db->where('franchise_id',$f_id);
            		  $Step1Query = $this->db->get();  
            		  $Step1QueryResult=$Step1Query->row_array();
            		  $frcode = $Step1QueryResult['franchise_code'];
		 
			
        			 $accescode_half=$frcode;
        			 
        			 $this->db->select('max(school_code) as access_code');
        		     $this->db->from('schools');
        		     $this->db->like('school_code', $accescode_half,'after');
        		     $Step2Query = $this->db->get();   /*echo $this->db->last_query();exit;*/
        		     $Step2QueryResult=$Step2Query->row_array();
        			 
        			 $max_access_code =$Step2QueryResult['access_code'];
        			 
        			 if(empty($max_access_code) || $max_access_code ==" ")
        			 {
        				
        			   $new_accescode=$frcode."S1000";
        				   //echo "empty";exit;
        			 }
        			 else
        			 {
        				 $firsthalf_test_school_code = substr($max_access_code,'0','4');
        				 $test_school_code = substr($max_access_code,'4','10') +1;
        				 $new_accescode=$firsthalf_test_school_code.$test_school_code;
        				 //$new_accescode=$frcode. "/REG/S" .$inc_value_accescode;
        				 
        			 }
			 
			 
			     $data = array('school_code' =>$new_accescode,
			                'school_status' => 'Active'
			              );
			     $data2=array('school_code' =>$new_accescode);
			             // print_r($data);exit;
        			  $this->db->where('school_id',$schoolID);
        			  $set_status= $this->db->update('schools',$data);
        			  
        			  $this->db->where('school_id',$schoolID);
        			  $this->db->update('filter',$data2);
        	            
        	          $this->db->where('school_id',$schoolID);
        			  $this->db->update('price_code',$data2);     
				    //print_r($set_status);exit;			
			
						if($set_status)
						 {
						     
                		 
                		  $this->load->library('email');
                		  $this->email->from('marrs.in','MaRRS ');   
                		  $this->email->to($toemail);
                		  $this->email->bcc('webteam2@marrs.in');
                		
                		  $this->email->subject('MaRRS  :- School Aceess Code');
                		  $this->email->message(' 
                		  Dear Sir / Madam, <br> <b>
                		  Thank you for registering School<br/>
                							School Access Code  : '.$new_accescode.'<br/>
                									
                										<brl>
                								 Admin Connect will Soon.	   
                								   </b>');
                			
                			$sent_status= $this->email->send();
						     
							 $this->notifications->notify('Access Code Successfully Generated', 'success');
						 } 
						 else
						  {
							 $this->notifications->notify('Access Code Generation Failed', 'error');
						  }
						  
						}
						  redirect('https://marrs.in/franchiselogin/manage/franchise/generate_accesscode/', 'refresh');
				}
								
				$this->load->view("generate_accesscode.php", $data);
    }
	
    /*@@@@@@@@@@@@@@@@@@@@@@@ START FUNCTION FOR INSERT ALL FRANCHISE DETAILS@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
	
    
    public function add()
    {
         $this->notifications->clear();
		 $subFranchiseKeys = array(2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
             if (isset($_POST['submit']))
			  {
                 $data['mode']         = 'Add';
				 $ft=$this->input->post('franchise_type');
					if($ft=='M')
					{
						 $fcode=$this->input->post('franchise_code');
						 $newFranchiseCode = $fcode.'1';
						/*exit;*/
					}
					if($ft=='N')
					{	
							  $franchise_refID=$this->input->post('franchise_ref');
							  $getFranchise =  $this->franchisemodel->getFranchise($franchise_refID);
							  $pFranchiseCode =  $getFranchise['franchise_code'];
							  $string=$pFranchiseCode;
							  $output = str_split($string,2);
							  $parentFranchiseCode=$output[0];
							  $subFranchiseCount = $this->franchisemodel->getSubFranchise_count($franchise_refID);
							  $newFranchiseCode = $parentFranchiseCode.$subFranchiseKeys[$subFranchiseCount];    
				  }
             $data = array(
								'service_id' => $this->input->post('service_id'),
								'emp_id' => $this->input->post('emp_id'),
								'franchise_type' => $this->input->post('franchise_type'),
								'franchise_ref' => (int)$this->input->post('franchise_ref'),
								'franchise_code' => $newFranchiseCode,
								'country_id' => $this->input->post('country_id'),
								'state_id' => $this->input->post('state_id'),
								'company_name' => $this->input->post('company_name'),
								'ceo_title' => $this->input->post('ceo_title'),
								'proprietary' => $this->input->post('proprietary'),
								'company_address' => $this->input->post('company_address'),
								'company_address1' => $this->input->post('company_address1'),
								'landmark' => $this->input->post('landmark'),
								'place' => $this->input->post('place'),
								'pincode' => $this->input->post('pincode'),
								'province' => $this->input->post('province'),
								'longitude' => $this->input->post('longitude'),
								'latitude' => $this->input->post('latitude'),
								'franchise_std_code' => $this->input->post('franchise_std_code'),
								'franchise_country_code' => $this->input->post('franchise_country_code'),
								'company_phno' => $this->input->post('company_phno'),
								'company_mobno' => $this->input->post('company_mobno'),
								'company_email_id' => $this->input->post('company_email_id')
						   );
             $this->validation->set_data($data);
             $this->validation->set_rules('service_id', 'service', 'required');
             $this->validation->set_rules('emp_id', 'employee', 'required');
             $this->validation->set_rules('franchise_type', 'franchise type', 'required');
             if ($this->input->post('franchise_type') == "N") 
            {
                  $this->validation->set_rules('franchise_ref', 'franchise ref', 'required');
            }
            if ($this->input->post('franchise_type') == "M") 
            {
                  $this->validation->set_rules('franchise_code', 'franchise code', 'required');
           }
            $this->validation->set_rules('country_id', 'country', 'required');
            $this->validation->set_rules('state_id', 'state', 'required');
            $this->validation->set_rules('company_name', 'company name', 'trim|required|alpha_numeric|xss_clean');
            $this->validation->set_rules('ceo_title', 'ceo title', 'required|alpha');
            $this->validation->set_rules('proprietary', 'proprietary name', 'required|alpha');
            $this->validation->set_rules('company_address', 'company_address1', 'required');
            $this->validation->set_rules('company_address1', 'company_address2', 'required');
            $this->validation->set_rules('landmark', 'landmark', 'required');
            $this->validation->set_rules('place', 'place', 'required');
            $this->validation->set_rules('pincode', 'pincode', 'required|numeric');
            $this->validation->set_rules('province', 'province', 'required');
            $this->validation->set_rules('longitude', 'longitude', 'required');
            $this->validation->set_rules('latitude', 'latitude', 'required');
            $this->validation->set_rules('franchise_std_code', 'std code', 'required|numeric');
            $this->validation->set_rules('company_phno', 'company phno', 'required|numeric');
            $this->validation->set_rules('franchise_country_code', 'country code', 'required|numeric');
            $this->validation->set_rules('company_mobno', 'company mobno', 'required|numeric');
            $this->validation->set_rules('company_email_id', 'company emailid', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('company_email_id1', 'does not match company Email ','trim|matches[company_email_id]|required|valid_email|xss_clean');   
           
             if ($this->validation->run() === FALSE)
			 {
				   /* var_dump($this->validation->show_errors());*/
					$this->notifications->notify('Please make all entries', 'error');
             } 
             else
             {
					$res = $this->franchisemodel->insert($data);
						if($res)
						{  $this->notifications->notify('Franchise added Successfully', 'success');     }
						else
						{  $this->notifications->notify('Failed to add franchise ', 'error');           }
					redirect('manage/franchise/index/', 'refresh');
            } /* end of else*/
            
            $data['result'] = $_POST;
        } /*end of if isset of post*/ /*if(isset($_POST['submit']))*/
		
		
        $data['mode']         = 'Add';
        $data['countries']               = $this->locationModel->listCountries();
        $data['stateatload']             = $this->locationModel->get_indian_states();
        $data['services']                = $this->serviceModel->listservice();
        $data['employee_franchise_list'] = $this->employeemodel->employee_franchiseList();
        $data['franchise_data']          = $this->franchisemodel->enum_select('sb_franchise', 'franchise_type');
        $data['franchise_ref']           = $this->franchisemodel->get_franchiseref();
        $data['franchise_codes']           = $this->franchisemodel->getFranchisecode();
        $this->load->view("franchiseAdd", $data);
    } /*public function add() */
    /*  END  FUNCTION FOR INSERT ALL FRANCHISE DETAILS*/
	
	
    /*@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
        
    /*//////////////////// START FOLLOWING FUNCTIONS  FOR  EDIT  /////////////////////////////////////////*/
    
    
    public function franchiseEdit()
    {
        $uri = $this->uri->segment(4);
        if(isset($_POST['submit'])){
           
            $state_id = $this->input->post('stateID');
             $second_half=substr($state_id,1,1);
             $sec = strtoupper($second_half);
            $this->db->select('MAX(franchise_code) as franchise_code');
            $this->db->from('franchise');
            $this->db->where('state_id',$state_id);
            $ss= $this->db->get()->row();
            $state_name =  $ss->franchise_code;
         
            if($state_name){
                $last_half=substr($state_name,-1);
                $first_half=substr($state_name,0,2);
                $i =$last_half+1;
                
               $fcode = $first_half.$i;
             //print_r($fcode);exit;
            }else{
            $state_id = $this->input->post('stateID'); 
            $i=1;
            $second_half=substr($state_id,1,1);
            $sec = strtoupper($second_half);
              $fcode = 'A'.$sec.$i;
                
                
                
            }
           //print_r($state_name);exit;
            $product_id = $this->input->post('product_id');
            $price = $this->input->post('product_price');
             $username = $fcode.$this->input->post('frenchise_first_name');
              
         
            $datafren = array(
            
            'country_id' =>$this->input->post('country_id'),
            'franchise_first_name' =>$this->input->post('frenchise_first_name'),
            'franchise_last_name' =>$this->input->post('frenchise_last_name'),
            'state_id' =>$this->input->post('state_id'), 
            'district' =>$this->input->post('district'), 
            'pincode' =>$this->input->post('pincode'), 
            'locality' =>$this->input->post('locality'),
            'place' =>$this->input->post('city'), 
            'company_address' =>$this->input->post('address'), 
            'company_address1' =>$this->input->post('address1'), 
            'franchise_type' =>$this->input->post('franchise_type'), 
            'franchise_ref' =>$this->input->post('franchise_ref'), 
            //'username' =>$this->input->post('frenchise_first_name'), 
            'mobile_number' =>$this->input->post('mobile_number'), 
            'company_email_id' =>$this->input->post('company_email_id'), 
            'company_name' =>$this->input->post('company_name'), 
            'franchise_status' =>$this->input->post('franchise_status'), 
            'franchise_created_date' =>$this->input->post('created_date')
           // 'username' =>$username,
           // 'password' => $username
           // 'franchise_code' => $fcode
                            
                
                );
             //print_r($datafren);exit;  
                
               $this->db->where('franchise_id',$uri);
               $set_status=$this->db->update('franchise',$datafren);
             
            foreach($product_id as $index=>$product){
                $productId = $product;
                $productprice = $price[$index];
                $data = array(
                     'product_id' =>$productId,
                     'franchise_id' => $uri,
                     'status' =>'Active'
                    );
                $this->db->where('franchise_id',$uri);
                $set_status = $this->db->update('product_allotted_fr',$data);
            }
                 if($set_status)
			 {
						     
                $this->notifications->notify('Franchise Added Successfully ', 'success');
			 } 
			 else
			{
		    	$this->notifications->notify('Franchise Generation Failed', 'error');
			}
			redirect('https://marrs.in/franchiselogin/manage/franchise/franchiseView');
        }
        
		$data['result']=$this->schoolmodel->getfranchisedata($uri);
		//print_r($data);exit;
       $this->load->view("franchiseAdd", $data);
    }

    /*@@@@@@@@@@@@@@@@@@@@@@@ START FOLLOWING FUNCTIONS  FOR  DELETE @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	

    public function productActiveDeactive($id='')
    {
        $fid  =$this->input->post('fid');
        $id=  $this->input->post('id');
     
          $query = $this->db->get_where('product_allotted_fr',array('product_id' => $id,'franchise_id'=>$fid));
          $res = $query->row_array();
          $status = $res['status'];
        if($status=='Active')
        {
             $data = array('status' => 'Deactive');
             $this->db->where('product_id',$id); 
             $this->db->where('franchise_id',$fid); 
             $result = $this->db->update('product_allotted_fr',$data);
              //return $result;
        }else{
             $data = array('status' => 'Active');
             $this->db->where('product_id',$id); 
             $this->db->where('franchise_id',$fid); 
             $result = $this->db->update('product_allotted_fr',$data);
             return $result;
        }
    }
    

    public function changeStatus()
	{
			$uri                  = $this->uri->uri_to_assoc(4);
			$data['franchise_id'] = $uri['id'];
			$data['list']         = $this->franchisemodel->changeStatus($uri['id']);
			redirect('manage/franchise/index/', 'refresh');
    }

   
    /*@@@@@@@@@@@@@@@@@@@@@@@ START FOLLOWING FUNCTIONS  FOR   VIEW @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */	
   	public function view()
	{
		
        $uri = $this->uri->uri_to_assoc(4);
		$detail_id=$uri['id'];
		//echo $franchise_id;die;
		$franchise_data['franchise'] =$this->schoolmodel->getfranchisedetails($detail_id);
		//print_r($franchise_data);die;
		$this->load->view("franchiseProfile.php", $franchise_data);
	}
	
	
	public function franchisetoproduct() 
    {
        $alldata['service'] =$this->schoolmodel->getservices();
		
		
		$alldata['franchise'] =$this->schoolmodel->getfranchiselist();
		
		if (isset($_POST['submit'])) {
			
			$data   = array('service_id'   => $this->input->post('productname'),
                                      'franchise_id'   => $this->input->post('requesttype'),);
									  
			//print_r($data);die;
			 $this->validation->set_data($data);
			 $this->validation->set_rules('service_id', 'Product', 'required');
			 $this->validation->set_rules('franchise_id', 'Request Type', 'required');
			 
			 
			 if ($this->validation->run() === FALSE) { 
                    $this->notifications->notify('Please make all entries', 'error');
             } else {
					//echo 'okk11';                     die;
					$res = $this->schoolmodel->insertproduct_franchise($data);
					//echo $res;die;
					if($res)
							{
								$this->notifications->notify('Updated successfully', 'success');
							}/*END of if(res)*/
							else
							{
							  $this->notifications->notify('Updation Failed', 'error');	
							}/*END of else*/
                    
             }
		 
		 
		 
		}
		
        $this->load->view("addfranchisetoproduct.php",$alldata);
    }
    
    
    public function view_franchise_logindetails() 
    {
        $data['franchise'] = $this->schoolmodel->getfranchise_login();
       $this->load->view("loginDetails.php", $data);
    }
   
   
    public function assignToFranchise() 
    {
        if(isset($_POST['submit'])){
            //print_r($_POST);
         $product_id = $_POST['product_name'];
         $franchise = $_POST['franchise'];
         $status = $_POST['status'];
         $res = $this->db->get_where('product_allotted_fr',array('franchise_id' =>$franchise,'product_id'=>$product_id))->result_array();
         if($product_id=='1'){
                    $product = $this->db->order_by('product_name')->get_where('products',array('status'=>'Active'))->result_array();
                    foreach($product as $value){
                     $res2 = $this->db->get_where('product_allotted_fr',array('franchise_id' =>$franchise,'product_id'=>$value['product_id']))->row_array(); 
                     
                     if(empty($res2)){
                     $array = array(
                         'product_id' =>$value['product_id'],
                         'franchise_id' =>$franchise,
                         'status' =>$_POST['status']
                         );
                         
                         $this->db->insert('product_allotted_fr',$array);
                    
                     }
                     }
                    
                    $this->session->set_flashdata('success','Product Assign to franchise Successfully');
                    redirect('manage/franchise/assignToFranchise'); 
             
         }else{ 
         
            
            $array = array(
                         'product_id' =>$product_id,
                         'franchise_id' =>$franchise,
                         'status' =>$_POST['status']
                         );
                         
             $this->db->insert('product_allotted_fr',$array); 
             $this->session->set_flashdata('success','Product Assign to franchise Successfully');
            redirect('manage/franchise/assignToFranchise'); 
         } 
        }
      
       $this->load->view("loginDetails.php", $data);
    }
    
   
    public function AddPriceCode() 
    {
        $data = array();
    
        if(isset($_POST['submit'])){
            $prefix         = $this->input->post('prefix');
            $area_code      = $this->input->post('area_code');
            $period_id      = $this->input->post('period');
            $product_price  = $this->input->post('product_price');
    
            $period_row = $this->db->get_where('period', array('period_id' => $period_id))->row();
    
            if($period_row) {
                $period_initial = $period_row->initials;
                $pricecode = $prefix . $period_initial . $area_code . '-' . $product_price;
    
                // ✅ Check if price_code already exists
                $existing = $this->db->get_where('price_codegenration', array('price_code' => $pricecode))->row();
    
                if($existing) {
                    // ❌ Duplicate found — do not insert
                    $data['message'] = 'Price Code "' . $pricecode . '" already exists!';
                    $data['error']   = true;
    
                } else {
                    $array = array(
                        'product_price' => $product_price,
                        'price_code'    => $pricecode,
                        'period_id'     => $period_id,
                        'level'         => '1',
                        'status'        => 'Active'
                    );
    
                    if($this->db->insert('price_codegenration', $array)) {
                        $this->session->set_flashdata('success', 'Price Code Generated Successfully.');
                        redirect('manage/franchise/accesscode_apporvedList');
                    } else {
                        $data['message'] = 'Insert failed: ' . $this->db->error()['message'];
                        $data['error']   = true;
                    }
                }
    
            } else {
                $data['message'] = 'Invalid period selected.';
                $data['error']   = true;
            }
        }
    
        $this->load->view('addpricecode', $data);
    }
       
       
    public function productList() 
    {
       
        
		$data['product']= $this->schoolmodel->productList();
	    $this->load->view('productList',$data); 
		
    }
   
   
    public function addproduct()
    {
        if (isset($_POST['submit']))
        {
            $product_n    = $this->input->post('product_title');
            $new_logo     = '';
            
            
            // ── Insert product ─────────────────────────────────────────────
            $dataarray = [
                'product_name' => $product_n,
                'content'      => $this->input->post('product_content'),
                'status'       => $this->input->post('status'),
                'link'         => $this->input->post('link')?? '',
                'logo'         => 'Yes',
                'in13'         => strtoupper(substr($this->input->post('in13'), 0, 2)),
                'class_key'    => '',
                'nomen'        => $product_n,
            ];
            
        
            // print_r($dataarray);die;
            // echo '<pre>';print_r($_POST);die;
            
            $existing = $this->db
                ->where('LOWER(product_name)', strtolower($product_n))
                ->get('products')
                ->row();
            
            $exis = $this->db->get_where('products', [
                                'in13' => strtoupper(substr($this->input->post('in13'), 0, 2))
                            ])->row();
                            
            if ($existing or $exis){
                
                $this->notifications->notify('Product Name Already Exist or CIN identification already exist.', 'error');
                
            }else{
                
                // ── Handle file upload ─────────────────────────────────────────
                if (!empty($_FILES['product_logo']['name']))
                {
                    $target_path  = '../student_registration/certificate_logo/';
                    $file_name    = time() . '_' . basename($_FILES['product_logo']['name']);
                    $upload_path  = $target_path . $file_name;
                    
                    // echo $upload_path;die;
                    
                    if (move_uploaded_file($_FILES['product_logo']['tmp_name'], $upload_path))
                    {
                        $new_logo = $file_name;
                    }else{
                        echo 'image error';
                    }
                }
                
                // die;
                
                $ins = $this->db->insert('products', $dataarray);
                $product_id = $this->db->insert_id();
    
                if ($ins)
                {
                    
                    // ── Insert / link competition levels ────────────────────────
                    $level_names = $this->input->post('level_name');
        
                    if (!empty($level_names) && is_array($level_names))
                    {
                        $medal_no = 1;
        
                        foreach ($level_names as $level_name)
                        {
                            $level_name = trim($level_name);
                            if ($level_name === '') continue;
        
                            $formatted = strtoupper(str_replace(' ', '_', $level_name));
                            // Check if this level already exists (by name)
                            $existing = $this->db
                                ->where('UPPER(level_name)', $formatted)
                                ->get('competition_level_byproduct')
                                ->row();
                
                            if ($existing)
                            {
                                $level_id = $existing->level_id;
                                $this->db->insert('competition_level_byproduct', [
                                    'level_id'        => $level_id,
                                    'level_name'      => $level_name,
                                    'product_name'    => $product_n,
                                    'product_id'      => $product_id,
                                    'medal_no'        => $medal_no,
                                    'product_updated' => date('Y-m-d H:i:s'),
                                ]);
                               
                                $comlevl = $this->db
                                    ->where('LOWER(level_name)', $level_name)
                                    ->get('competition_levels')
                                    ->row();
                                if(!$comlevl){
                                    $this->db->insert('competition_levels', [
                                        'level_name' => $level_name,
                                        'level_key'  => $formatted,
                                        'status'     => 'Active',
                                    ]);
                                }
                                
                            }
                            else
                            {
                                $max_level_id = $this->db
                                    ->select_max('level_id')
                                    ->get('competition_level_byproduct')
                                    ->row()
                                    ->level_id;
                                    
                                $max = $max_level_id + 1;
                                
                                // Link level to this product
                                $this->db->insert('competition_level_byproduct', [
                                    'level_id'        => $max,    
                                    'level_name'      => $level_name,
                                    'product_name'    => $product_n,
                                    'product_id'      => $product_id,
                                    'medal_no'        => $medal_no,
                                    'product_updated' => date('Y-m-d H:i:s'),
                                ]);
                                $level_id = $this->db->insert_id();

                                $comlevl = $this->db
                                    ->where('LOWER(level_name)', $level_name)
                                    ->get('competition_levels')
                                    ->row();
                                if(!$comlevl){
                                    $this->db->insert('competition_levels', [
                                        'level_name' => $level_name,
                                        'level_key'  => $formatted,
                                        'status'     => 'Active',
                                    ]);
                                }
                            
                            }
                            
                            $medal_no++;
                        }
                    }
                    
                    
                    $this->db->insert('certificate_image', ['product_name'=> $product_n, 'product_id'=> $product_id, 'image_name'=> $new_logo, 'log'=> $new_logo]);
                    
                    // ── Insert categories (loop instead of repeating 10 times) ────
                    for ($i = 1; $i <= 10; $i++)
                    {
                        $options = $this->input->post('category' . $i . '_options');
                        if (!empty($options) && is_array($options))
                        {
                            foreach ($options as $option)
                            {
                                $this->db->insert('categoryBYProduct', [
                                    'category_id'   => $i,
                                    'category_name' => 'Category-' . $i,
                                    'class'         => $option,
                                    'product_name'  => $product_n,
                                    'product_id'    => $product_id,
                                ]);
                                
                                $this->db->insert('product_class_applicable', [
                                    'category_id'   => $i,
                                    'period_id'     => 0,
                                    'class'         => $option,
                                    'product_name'  => $product_n,
                                    'product_id'    => $product_id,
                                ]);
                                
                            }
                        }
                    }
                    
        
                    $this->notifications->notify('Product Added Successfully', 'success');
                }
                else
                {
                    $this->notifications->notify('Product Generation Failed', 'error');
                }
        
        
            }
            redirect('https://marrs.in/admin/manage/franchise/productList');
        }
    
        $this->load->view('add_materials');
    }
    
        
    public function franchiseView()
    {
        $data['franchise'] = $this->db->get_where('franchise')->result_array();
        $this->load->view('franchiseList',$data);  
    } 
    
    
    public function Addfrachise()
    {
        if(isset($_POST['submit']))
        {
           
            $state_id = $this->input->post('state_id');
			$area_id = $this->input->post('area');
			//$area = $this->db->get_where('areas',array('id'=>$area_id))->row();
           // $area_code = $area->area_code;
			
			$states = $this->db->get_where('states',array('state_subdivision_id'=>$state_id))->row();
            $state_name = $states->state_subdivision_code;
			 $number = '100';
			$contry_initial = substr($state_name,0,2);
			$state_initial = substr($state_name,3,6);
			$cin = $contry_initial.$state_initial.'MR'.date('Y'); 
			
             
            $this->db->select('*');
            $this->db->from('franchise');
            //$this->db->like('franchise_code',$cin,'after');
            $this->db->order_by('franchise_id','DESC');
            $ss= $this->db->get()->row();
            $franchise_code =  $ss->franchise_code;
            //print_r(substr($franchise_code,10,14));exit;  
			 
            if(!empty(substr($franchise_code,10,14))){
                $last_half=substr($franchise_code,10,14);
                $i =$last_half+1;
                $fcode = $cin.$i;
             
            }else{ 
                
               $i=1000;
               $fcode = $cin.$i; 
              
            }
          //print_r($fcode);exit;   
            $product_id = $this->input->post('product_id');
            $price = $this->input->post('product_price');
            $username = $fcode.$this->input->post('frenchise_first_name');
              
         
            $datafren = array(
            
                    'country_id' =>$this->input->post('country_id'),
                    'franchise_first_name' =>$this->input->post('frenchise_first_name'),
                    'franchise_last_name' =>$this->input->post('frenchise_last_name'),
                    'state_id' =>$this->input->post('state_id'), 
                    //'district' =>$this->input->post('district'), 
                    //'pincode' =>$this->input->post('pincode'), 
                    //'locality' =>$this->input->post('locality'),
                    //'place' =>$this->input->post('city'), 
                    'company_address' =>$this->input->post('address'), 
                    'company_address1' =>$this->input->post('address1'), 
                    'franchise_type' =>$this->input->post('franchise_type'), 
                    'franchise_ref' =>$this->input->post('franchise_ref'), 
                    'username' =>$this->input->post('frenchise_first_name'), 
                    'mobile_number' =>$this->input->post('mobile_number'), 
                    'company_email_id' =>$this->input->post('company_email_id'), 
                    'company_name' =>$this->input->post('company_name'), 
                    'franchise_status' =>$this->input->post('franchise_status'), 
                    'franchise_created_date' =>$this->input->post('created_date'),
                    'username' =>$username,
                    'password' => $username,
                    'franchise_code' => $fcode
                    
                );
                
               // print_r($datafren);exit;  
               
               $this->db->insert('franchise',$datafren);
               $inserted_id =  $this->db->insert_id();   
               
               	if($inserted_id)
				{
						     
                		 
                		  $this->load->library('email');
                		  $this->email->from('marrs.in','MaRRS ');   
                		  $this->email->to($this->input->post('company_email_id'));
                		  $this->email->bcc('webteam2@marrs.in');
                		
                		  $this->email->subject('MaRRS  :- Franchise Code');
                		  $this->email->message(' 
                		  Dear Sir / Madam, <br> <b>
                		  
                		  Welcome to the MaRRS team. Your login credentials as under<br/>
                							Franchise username  : '.$username.'<br/>
                							Franchise password  : '.$username.'<br/>
                									
                										<br>
                								   
                								   </b>');
                			
                			$sent_status= $this->email->send();
						     
							 
						 } 
						
					
               
            foreach($area_id as $value){
               
                $area_code = $value;
                $dataarea = array(
                     'area_id' =>$area_code,
                     'franchise_id' => $inserted_id,
                     'status' =>'Active'
                    );
                 //print_r($data);exit;
                $set_status = $this->db->insert('area_to_franchise',$dataarea);
            }
            // foreach($product_id as $index=>$product){
            //     $productId = $product;
            //     $productprice = $price[$index];
            //     $data = array(
            //          'product_id' =>$productId,
            //          'franchise_id' => $inserted_id,
            //          'status' =>'Active'
            //         );
            //      //print_r($data);exit;
            //     $set_status = $this->db->insert('product_allotted_fr',$data);
            // }
                 if($set_status)
    			 {
    						     
                    $this->notifications->notify('Franchise Added Successfully ', 'success');
    			 } 
    			 else
    			{
    		    	$this->notifications->notify('Franchise Generation Failed', 'error');
    			}
               
			redirect('https://marrs.in/admin/manage/franchise/Addfrachise');
        
        }
        $data['result'] = $_POST;
        $data['country']=$this->schoolmodel->getcountries();
        $this->load->view('franchiseAdd',$data);  
    } 
    
    
//     public function schooListView()
//     {
//         if (isset($_POST['submit']))
// 		{   
// 		    unset($_POST['submit']);
// 			 //   print_r($_POST);die;
// 			     $data['schoolList']=$this->schoolmodel->getschoolList_all($_POST);
// 			     $data['result']=$_POST;
// 		}
//         // print_r($data['schoolList']);die;
//         if(isset($_POST['export']))
//         {
//               //print_R($_POST);die;
//               unset($_POST['submit']);
// 			 //   print_r($_POST);die;
// 			     $data['schoolList']=$schoollist=$this->schoolmodel->getschoolList_all($_POST);
// 			     $data['result']=$_POST;
// 			     $data=[];
			     
// 			     $n=0;
//                 foreach($schoollist as $item)
// 		        {
		      
// 		   	        $item['serial_no']=$n;
//     			    $data[]=array( 
        			  
//         			   $item['serial_no']+1,
//         			   $item['id'],
//         			   $item['school_name'],
//         			   $item['school_address'],
//         			   $item['school_code']  ,
//         			   $item['area_code']  ,
//         			   $item['city']  ,
//         			   $item['district'],
//         			   $item['state_subdivision_name'],
//         			   $item['school_email'] ,
//         			   $item['school_phone'] ,
//         			   $item['school_mobile'],
//         			   $item['school_principal_name'],
//         			   $item['principal_email']  ,
//         			   $item['principal_phone']  ,
//         			   $item['school_coordinator_name'] ,
//         			   $item['school_coordinator_email'],
//         			   $item['coordinator_phone'],
//         			   $item['school_status'],
//         			   $item['franchise_code'] ,
//         			   $item['franchise_first_name'].' '.$item['franchise_last_name'],
        			   
//     			        );
//         			   $level_name= $item['level_name'];
//         			$n++;
//         		}
	
// 	            $file_name=$item['state_subdivision_name'].'_SchoolList';
// 	            //echo $file_name;die;
//         		header("Content-type: application/csv");
//                 header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
//                 header("Pragma: no-cache");
//                 header("Expires: 0");
        
//                 $handle = fopen('php://output', 'w');
//                 fputcsv($handle, array('Serial No','School ID','School Name','Address','School Code','Area Code','city','District','State','school email','school phone','school_mobile','school_principal_name','principal_email','principal_phone','school_coordinator_name','school_coordinator_email','coordinator_phone','school_status','Franchise Code','Franchise Name'));
//                 $cnt=1;
//                 foreach ($data as $key) {
                    
//                     fputcsv($handle, $key);
//                 }
//                     fclose($handle);
//                 exit;
//           }
           
//         if(isset($data['result']['state_id']) && $data['result']['franchise']!='All'){
//             $this->db->select('*');
//     		$this->db->from('areas');
//     		$this->db->where('state_id',$data['result']['state_id']);
//     		if(isset($data['result']['franchise']) && $data['result']['franchise']!='All'){
//     		    $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
//     		    $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise']);
//     		}    
//     		$res = $this->db->get();
//     		$data['area_load']= $res->result_array();
//         }
        
//         if(isset($data['result']['state_id'])){
//             $this->db->select('*');
//     		$this->db->from('franchise');
//     		$this->db->where('state_id',$data['result']['state_id']);
//     		$res = $this->db->get();
//     		$data['franchise_load']= $res->result_array();
//         }
//          $data['crm_account'] = $this->db->get_where('gst_account_marrs',['title'=>'CRM'])->result_array();
        
//         $this->load->view('adminSchoolview',$data); 
//     }
    
    
    public function schooListView()
    {
        $data = [];
        $post = $this->input->post();
    
        //DEFAULT VALUES (important to avoid undefined issues)
        $data['result'] = [
            'state_id'  => $post['state_id']  ?? '',
            'franchise' => $post['franchise'] ?? '',
            'area_code' => $post['area_code'] ?? '',
            'status'    => $post['status']    ?? 'All',
            'search'    => $post['search']
        ];
        
    
        // =========================
        // SUBMIT FILTER
        // =========================
        if (isset($post['submit'])) {
            $data['schoolList'] = $this->schoolmodel->getschoolList_all($post);
        }
    
        // =========================
        // EXPORT CSV
        // =========================
        if (isset($post['export'])) {
    
            $schoollist = $this->schoolmodel->getschoolList_all($post);
    
            $csvData = [];
            $n = 1;
    
            foreach ($schoollist as $item) {
                $csvData[] = [
                    $n++,
                    $item['id'],
                    $item['school_name'],
                    $item['school_address'],
                    $item['school_code'],
                    $item['area_code'],
                    $item['city'],
                    $item['district'],
                    $item['state_subdivision_name'],
                    $item['school_email'],
                    $item['school_phone'],
                    $item['school_mobile'],
                    $item['school_principal_name'],
                    $item['principal_email'],
                    $item['principal_phone'],
                    $item['school_coordinator_name'],
                    $item['school_coordinator_email'],
                    $item['coordinator_phone'],
                    $item['school_status'],
                    $item['franchise_code'],
                    $item['franchise_first_name'].' '.$item['franchise_last_name'],
                ];
            }
    
            $file_name = (!empty($schoollist[0]['state_subdivision_name']) 
                        ? $schoollist[0]['state_subdivision_name'] 
                        : 'All') . '_SchoolList';
    
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");
    
            $handle = fopen('php://output', 'w');
    
            fputcsv($handle, [
                'Serial No','School ID','School Name','Address','School Code',
                'Area Code','City','District','State','School Email','School Phone',
                'School Mobile','Principal Name','Principal Email','Principal Phone',
                'Coordinator Name','Coordinator Email','Coordinator Phone',
                'Status','Franchise Code','Franchise Name'
            ]);
    
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
    
            fclose($handle);
            exit;
        }
    
        // =========================
        // LOAD AREA LIST
        // =========================
        
        
        // =========================
        // RESET DEPENDENT DROPDOWNS
        // =========================
        if ($data['result']['state_id'] == 'All') {
            $data['result']['franchise'] = 'All';
            $data['result']['area_code'] = 'All';
        }
        
        // If franchise = All → area should be All
        if ($data['result']['franchise'] == 'All') {
            $data['result']['area_code'] = 'All';
        }
        if (!empty($data['result']['state_id']) && $data['result']['state_id'] != 'All') {
    
            $this->db->from('areas');
            $this->db->where('state_id', $data['result']['state_id']);
    
            if (!empty($data['result']['franchise']) && $data['result']['franchise'] != 'All') {
                $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
                $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise']);
            }
    
            $data['area_load'] = $this->db->get()->result_array();
    
        } else {
            // FIX: when State = All
            $data['area_load'] = $this->db->get('areas')->result_array();
        }
    
        // =========================
        // LOAD FRANCHISE LIST
        // =========================
        if (!empty($data['result']['state_id']) && $data['result']['state_id'] != 'All') {
    
            $this->db->from('franchise');
            $this->db->where('state_id', $data['result']['state_id']);
            $data['franchise_load'] = $this->db->get()->result_array();
    
        } else {
            // FIX: when State = All
            $data['franchise_load'] = $this->db->get('franchise')->result_array();
        }
    
        // =========================
        $data['crm_account'] = $this->db
            ->get_where('gst_account_marrs',['title'=>'CRM'])
            ->result_array();
            
        $this->db->select('country_id,country_name');
		$this->db->from('countries');
		$res = $this->db->get();
		$data['country_load'] = $res->result_array();
		
        if(isset($data['result']['country_id'])){
            $this->db->select('*');
    		$this->db->from('states');
    		$this->db->where('country_id',$data['result']['country_id']);
    		$res = $this->db->get();
    		$data['state_load'] = $res->result_array();
        }
    
        $this->load->view('adminSchoolview',$data);
    }


    public function schoollevelactive()
    {
        $uri = $this->uri->segment(4);
        
        $school = $this->db->get_where('school_new',array('id'=>$uri))->row();
            
        if($school->status_new == 'Active'){
            $data = array(
                'status_new' =>'Inactive'
            );
        }else{
            $data = array(
            'status_new' =>'Active'
            );
        }
        
        $this->db->where('school_id', $uri);
        $this->db->where('period_id', 16);
        $this->db->delete('product_to_school');
        
		 
		 $this->db->where('id',$uri);
	     $set_status= $this->db->update('school_new',$data);
	     
		 if($set_status)
		 {
					     
            $this->notifications->notify('School Level Status Updated Successfully ', 'success');
		 } 
		 else
		{
	    	$this->notifications->notify('School Level Status Updation Failed', 'error');
		}
		redirect('https://marrs.in/franchiselogin/manage/franchise/schooListView');
          
    }
    
    
    public function newschoollevelactive()
    {
        $school_id        = $this->input->post('school_id');
        $product_ids      = $this->input->post('product_id');
        $product_prices   = $this->input->post('product_price');
        $product_levels   = $this->input->post('product_level');
        $school_amount    = $this->input->post('schoolper');
        $manageper        = $this->input->post('manageper');
        $com_peravian     = $this->input->post('com_peravian');
        $associate_per    = $this->input->post('associate_per');
        $com_per          = $this->input->post('com_per');
        $crm_per          = $this->input->post('crm_per');
        $it_fix           = $this->input->post('it_fix');
        $free_mat_royalty = $this->input->post('free_mat_royalty');
        $competition_type = $this->input->post('competition_type');
        $crm = $this->input->post('crm');
         // New A/B fields
        $material_training_a         = $this->input->post('material_training_a');
        $material_training_a_royalty = $this->input->post('material_training_a_royalty');
        $material_training_b         = $this->input->post('material_training_b');
        $material_training_b_royalty = $this->input->post('material_training_b_royalty');
        
        $material_a_price   = $this->input->post('material_a_price');
        $material_a_royalty = $this->input->post('material_a_royalty');
        $material_b_price   = $this->input->post('material_b_price');
        $material_b_royalty = $this->input->post('material_b_royalty');
        
        $orientation_a_price = $this->input->post('orientation_a_price');
        $orientation_b_price = $this->input->post('orientation_b_price');
        
        $mocktest_a_price   = $this->input->post('mocktest_a_price');
        $mocktest_a_royalty = $this->input->post('mocktest_a_royalty');
        $mocktest_b_price   = $this->input->post('mocktest_b_price');
        $mocktest_b_royalty = $this->input->post('mocktest_b_royalty');  
                
                
                
    
        if (empty($product_ids) || !is_array($product_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'Select at least one product.']);
            return;
        }
    
        $school = $this->db->get_where('school_new', ['id' => $school_id])->row();
        if (!$school) {
            echo json_encode(['status' => 'error', 'message' => 'School not found.']);
            return;
        }
    
        // Pre-load all levels
        $all_levels_raw = $this->db
            ->select('level_id, level_name, product_id')
            ->order_by('medal_no', 'ASC')
            ->get('competition_level_byproduct')
            ->result_array();
    
        $levelsByProduct = [];
        foreach ($all_levels_raw as $lv) {
            $levelsByProduct[$lv['product_id']][] = $lv;
        }
    
        // ── DELETE removed products from product_to_school ────────────────────
        // Any product_id NOT in the submitted list should be removed
        // $this->db->where('school_id', $school_id);
        // $this->db->where('period_id', 16);
        // $this->db->where_not_in('product_id', $product_ids);
        // $this->db->delete('product_to_school');
    
        // ── Track all level_ids processed for this school/product ────────────
        $processed = []; // [ product_id => [level_id, level_id, ...] ]
    
        foreach ($product_ids as $product_id) {
    
            $price_code = isset($product_prices[$product_id]) ? trim($product_prices[$product_id]) : '';
            if (empty($price_code)) continue;
    
            $amount = null;
            if (strpos($price_code, '-') !== false) {
                $parts  = explode('-', $price_code);
                $amount = end($parts);
            }
            if ($amount === null || $amount === '') continue;
    
            $product = $this->db->get_where('products', ['product_id' => $product_id])->row_array();
            if (empty($product)) continue;
    
            $selected_level     = isset($product_levels[$product_id]) ? trim($product_levels[$product_id]) : '';
            $product_level_rows = isset($levelsByProduct[$product_id]) ? $levelsByProduct[$product_id] : [];
    
            if ($selected_level === 'All' || $selected_level === '') {
                $levels_to_process = $product_level_rows;
                if (empty($levels_to_process)) {
                    $levels_to_process = [['level_id' => 1, 'level_name' => 'Level 1']];
                }
            } else {
                $matched_name = 'Level ' . $selected_level;
                foreach ($product_level_rows as $lr) {
                    if ((string)$lr['level_id'] === (string)$selected_level) {
                        $matched_name = $lr['level_name'];
                        break;
                    }
                }
                $levels_to_process = [['level_id' => $selected_level, 'level_name' => $matched_name]];
            }
    
            $processed[$product_id] = [];
    
            foreach ($levels_to_process as $level_row) {
    
                $level_id = $level_row['level_id'];
                $processed[$product_id][] = $level_id;
    
                // ── revenue_setting ───────────────────────────────────────────
                $revenue_setting = [
                    'product_id'                  => $product_id,
                    'product_name'                => $product['product_name'],
                    'clevel'                      => $level_id,
                    'period_id'                   => 16,
                    'com_per'                     => 0,
                    'it_fix'                      => $it_fix ?? 0,
                    'manageper'                   => $manageper,
                    'com_peravian'                => $com_peravian,
                    'associate_per'               => $associate_per,
                    'crm_per'                     => $crm_per,
                    'study_material_free_royalty' => $free_mat_royalty,
                    'bundle_price_a'              => $material_training_a,
                    'bundle_price_a_royality'     => $material_training_a_royalty,
                    'bundle_price_b'              => $material_training_b,
                    'bundle_price_b_royality'     => $material_training_b_royalty,
        
                    'study_material_a_price'         => $material_a_price,
                    'study_material_a_price_royalty' => $material_a_royalty,
                    'study_material_b_price'         => $material_b_price,
                    'study_material_b_price_royalty' => $material_b_royalty,
        
                    'orientation_a_price'         => $orientation_a_price,
                    'orientation_b_price'         => $orientation_b_price,
        
                    'mock_test_a_price'           => $mocktest_a_price,
                    'mock_test_a_price_royalty'   => $mocktest_a_royalty,
                    'mock_test_b_price'           => $mocktest_b_price,
                    'mock_test_b_price_royalty'   => $mocktest_b_royalty,
                ];
    
                $existing_revenue = $this->db->get_where('revenue_setting', [
                    'product_id' => $product_id,
                    'period_id'  => 16,
                    'clevel'     => $level_id,
                ])->row();
    
                if ($existing_revenue) {
                    $this->db->where('product_id', $product_id);
                    $this->db->where('period_id',  16);
                    $this->db->where('clevel',     $level_id);
                    $this->db->update('revenue_setting', $revenue_setting);
                    $revenue_setting_id = $existing_revenue->id;
                } else {
                    $this->db->insert('revenue_setting', $revenue_setting);
                    $revenue_setting_id = $this->db->insert_id();
                }
    
                // ── product_to_school ─────────────────────────────────────────
                $data = [
                    'school_code'        => $school->school_code,
                    'amount'             => $amount,
                    'school_id'          => $school_id,
                    'product_id'         => $product_id,
                    'product_name'       => $product['product_name'],
                    'pricecode_id'       => $price_code,
                    'period_id'          => 16,
                    'level_id'           => $level_id,
                    'franchise_id'       => $school->franchise_id,
                    'school_amount'      => $school_amount,
                    'manageper'          => $manageper,
                    'com_peravian'       => $com_peravian,
                    'associate_per'      => $associate_per,
                    'franchise_per'      => $com_per,
                    'crm_per'            => $crm_per,
                    'free_mat_royalty'   => $free_mat_royalty,
                    'revenue_setting_id' => $revenue_setting_id,
                    'competition_type'   => $competition_type,
                    'crm_id'             => $crm,
                    'it_fix'             => $it_fix ?? 0,
                ];
    
                $existing_pts = $this->db->get_where('product_to_school', [
                    'school_id'  => $school_id,
                    'period_id'  => 16,
                    'product_id' => $product_id,
                    'level_id'   => $level_id,
                ])->row();
               
    
                if ($existing_pts) {
                    $this->db->where('school_id',  $school_id);
                    $this->db->where('period_id',  16);
                    $this->db->where('product_id', $product_id);
                    $this->db->where('level_id',   $level_id);
                    $this->db->update('product_to_school', array_merge($data, [
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]));
                } else {
                      $exitP = $this->db->get_where('product_to_school', [
                      'school_id'  => $school_id,
                      'period_id'  => 16,
                      'level_id'   => $level_id,
                ])->row();
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['competition_mode_start_date'] = $exitP->competition_mode_start_date;
                    $data['competition_mode_end_date']= $exitP->competition_mode_end_date;
                    // Preserve existing competition_mode and registration_mode
                    $data['competition_mode']  = 'offline';
                    $data['registration_mode'] = 'offline';
                    $this->db->insert('product_to_school', $data);
                   
                }
    
                // ── Delete old level rows for this product not in new selection ──
                if (!empty($processed[$product_id])) {
                    $this->db->where('school_id',  $school_id);
                    $this->db->where('period_id',  16);
                    $this->db->where('product_id', $product_id);
                    $this->db->where_not_in('level_id', $processed[$product_id]);
                    $this->db->delete('product_to_school');
                }
    
                // ── competition_schedule ──────────────────────────────────────
                $dataSchedule = [
                    'country_id'           => '105',
                    'period_id'            => '16',
                    'state_id'             => $school->state,
                    'school_id'            => $school_id,
                    'product_id'           => $product_id,
                    'competition_level_id' => $level_id,
                    'franchise_id'         => $school->franchise_id,
                    'product_name'         => $product['product_name'],
                    'competition_fee'      => $amount,
                    'center_address'       => $school->school_name,
                    'status'               => 'Active',
                ];
    
                $existing_schedule = $this->db->get_where('competition_schedule', [
                    'period_id'            => '16',
                    'state_id'             => $school->state,
                    'school_id'            => $school_id, 
                    'product_id'           => $product_id,
                    'competition_level_id' => $level_id,
                    'franchise_id'         => $school->franchise_id,
                ])->row();
    
                if ($existing_schedule) {
                    $this->db->where('competition_schedule_id', $existing_schedule->competition_schedule_id);
                    $this->db->update('competition_schedule', $dataSchedule);
                } else {
                    $this->db->insert('competition_schedule', $dataSchedule);
                }
    
                // ── competition_product_state ─────────────────────────────────
                $product_state_comp = [
                    'revenue_setting_id' => $revenue_setting_id,
                    'product_name'       => $product['product_name'],
                    'clevel'             => $level_id,
                    'period_id'          => 16,
                    'com_per'            => 0,
                    'manageper'          => $manageper,
                    'com_peravian'       => $com_peravian,
                    'associate_per'      => $associate_per,
                    'crm_per'            => $crm_per,
                    'school_amount'      => $school_amount,
                ];
    
                $existing_comp_state = $this->db->get_where('competition_product_state', [
                    'revenue_setting_id' => $revenue_setting_id,
                ])->row();
    
                if ($existing_comp_state) {
                    $this->db->where('id', $existing_comp_state->id);
                    $this->db->update('competition_product_state', $product_state_comp);
                } else {
                    $this->db->insert('competition_product_state', $product_state_comp);
                }
    
            } // end foreach levels
        } // end foreach products
    
        // Keep school Active
        $this->db->where('id', $school_id);
        $this->db->update('school_new', ['status_new' => 'Active']);
    
        echo json_encode([
            'status'  => 'success',
            'message' => 'School saved successfully.',
        ]);
    }
    
    
    public function getSchoolActivationData()
    {
        $school_id = $this->input->post('school_id');
    
        $rows = $this->db->get_where('product_to_school', [
            'school_id' => $school_id,
            'period_id' => 16
        ])->result_array();
    
        if (empty($rows)) {
            echo json_encode([
                'status'        => 'success',
                'product_ids'   => [],
                'pricecode_ids' => [],
                'level_ids'     => [],
                'common'        => []
            ]);
            return;
        }
    
        $product_ids   = [];
        $pricecode_ids = [];
        $level_ids     = [];
        $seen          = [];
        $common        = [];
    
        foreach ($rows as $row) {
    
            $pid = (string)$row['product_id'];
    
            // Skip invalid product_id
            if ($pid == "0" || $pid == "") {
                continue;
            }
    
            // Store product details
            if (!isset($seen[$pid])) {
                $seen[$pid] = true;
    
                $product_ids[]       = $pid;
                $pricecode_ids[$pid] = (string)($row['pricecode_id'] ?? '');
                $level_ids[$pid]     = (string)($row['level_id'] ?? '');
            }
    
            // Take first row having common values
            if (empty($common) && (
                    !empty($row['school_amount']) ||
                    !empty($row['manageper']) ||
                    !empty($row['com_peravian']) ||
                    !empty($row['associate_per']) ||
                    !empty($row['franchise_per']) ||
                    !empty($row['crm_per']) ||
                    !empty($row['free_mat_royalty']) ||
                    !empty($row['competition_type']) ||
                    !empty($row['crm_id'])
                )) {
    
                $common = [
                    'school_amount'    => $row['school_amount'] ?? '',
                    'manageper'        => $row['manageper'] ?? '',
                    'com_peravian'     => $row['com_peravian'] ?? '',
                    'associate_per'    => $row['associate_per'] ?? '',
                    'franchise_per'    => $row['franchise_per'] ?? '',
                    'crm_per'          => $row['crm_per'] ?? '',
                    'it_fix'          => $row['it_fix'] ?? 0,
                    'free_mat_royalty' => $row['free_mat_royalty'] ?? '',
                    'competition_type' => $row['competition_type'] ?? '',
                    'crm_id' => $row['crm_id'] ?? '',
    
                    'material_training_a'          => $row['material_training_a'] ?? '',
                    'material_training_a_royalty'  => $row['material_training_a_royalty'] ?? '',
                    'material_training_b'          => $row['material_training_b'] ?? '',
                    'material_training_b_royalty'  => $row['material_training_b_royalty'] ?? '',
    
                    'material_a_price'             => $row['material_a_price'] ?? '',
                    'material_a_royalty'           => $row['material_a_royalty'] ?? '',
                    'material_b_price'             => $row['material_b_price'] ?? '',
                    'material_b_royalty'           => $row['material_b_royalty'] ?? '',
    
                    'orientation_a_price'          => $row['orientation_a_price'] ?? '',
                    'orientation_b_price'          => $row['orientation_b_price'] ?? '',
    
                    'mocktest_a_price'             => $row['mocktest_a_price'] ?? '',
                    'mocktest_a_royalty'           => $row['mocktest_a_royalty'] ?? '',
                    'mocktest_b_price'             => $row['mocktest_b_price'] ?? '',
                    'mocktest_b_royalty'           => $row['mocktest_b_royalty'] ?? '',
                ];
            }
        }
    
        echo json_encode([
            'status'        => 'success',
            'product_ids'   => $product_ids,
            'pricecode_ids' => $pricecode_ids,
            'level_ids'     => $level_ids,
            'common'        => $common
        ]);
    }
    
    
    public function zoomzoomactive()
    {
        $uri = $this->uri->segment(4);
        
        $school = $this->db->get_where('school_new',array('id'=>$uri))->row();
            
        if($school->zoomstatus == 'Active'){
            $data = array(
                'zoomstatus' =>'Inactive'
            );
        }else{
            $data = array(
            'zoomstatus' =>'Active'
            );
        }
        
        
        
		 
		 $this->db->where('id',$uri);
	     $set_status= $this->db->update('school_new',$data);
	     
		 if($set_status)
		 {
					     
            $this->notifications->notify('Zoomzoom Status Updated Successfully ', 'success');
		 } 
		 else
		{
	    	$this->notifications->notify('Zoomzoom Status Updation Failed', 'error');
		}
		redirect('https://marrs.in/franchiselogin/manage/franchise/schooListView');
          
    }
    
    
    public function adminSchooldelete()
    {
        $id = $this->input->post('id');
    
        if (!$id) {
            echo json_encode([
                'status'  => false,
                'message' => 'Invalid School ID'
            ]);
            return;
        }
    
        $this->db->where('id', $id);
    
        if ($this->db->delete('school_new')) {
            echo json_encode([
                'status'  => true,
                'message' => 'School deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Failed to delete school.'
            ]);
        }
    }
        
        
    public function productstatus()
    {
         
         $uri = $this->uri->segment(4);
         $data = array(
            'status' =>'Deactive'
            );
		 
		 $this->db->where('product_id',$uri);
	     $set_status= $this->db->update('products',$data);
		 if($set_status)
			 {
						     
                $this->notifications->notify('Product Deactive Successfully ', 'success');
			 } 
			 else
			{
		    	$this->notifications->notify('Product Generation Failed', 'error');
			}
			redirect('https://marrs.in/franchiselogin/manage/franchise/productList/');
    }
      
      
    public function Addschool()
    {
		if (isset($_POST['submit']))
		{
			 //print_r($_POST['area_code']);
			    $product_id =$this->input->post('product_id');
			    $price = $this->input->post('product_price');
			    $area = $this->db->get_where('areas',array('area_code'=>$this->input->post('area_code')))->row();
			 //   $last_row=$this->db->select('school_code')->order_by('id',"desc")->limit(1)->get('school_new')->row();
			  //  print_R($area); 
			  
			 // $area = $this->db->get_where('school_new',array('area_code'=>$this->input->post('area_code')) )->order_by('id',"desc")->row();
			  $query = $this->db->query("SELECT school_code FROM school_new ORDER BY `school_new`.`id` DESC ");
			  $school_co=$query->result()[0]->school_code;
			// print_r($school_co); die;
			 $nex= explode('S',$school_co);
			 $num=$nex[1];
			 //  echo $this->db->last_query();die;
			    
			    
			     $school_board=  $this->input->post('school_board');
			     
			     
			     
			     //$newcode = substr($last_row->school_code,4,7)+1;
			     
			     $newcode=$num+1;
			     //echo $newcode;die;
			     $school_code = $_POST['area_code'].'S'.$newcode;
			     //echo 'ok';
		//	     print_r($school_code);die;
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$post_data      = array(
										'school_name' => $this->input->post('school_name'),
										'school_code' =>$school_code,
										'school_address' => $this->input->post('school_address'),
										'school_principal_name' => $this->input->post('principal_first_name'),
										'principal_email' => $this->input->post('principal_email'),
										'principal_phone' => $this->input->post('principal_phone'),
										'school_coordinator_name' => $this->input->post('school_coordinator_first_name'),
										//'school_coordinator_last_name' => $this->input->post('school_coordinator_last_name'),
										'school_coordinator_email' => $this->input->post('school_coordinator_email'),
										'coordinator_phone' => $this->input->post('school_coordinator_phone'),
										'country' => $this->input->post('country_id'),
										'state' => $this->input->post('stateID'),
										'city' => $this->input->post('school_city'),
										'district' => $this->input->post('school_district'),
										'location' => $this->input->post('school_locality'),
										'school_phone' => $this->input->post('school_phone'),
										'school_mobile' => $this->input->post('school_mobile'),
										'school_email' => $this->input->post('school_email'),
										'school_board' => $school_board,
										'school_medium' => $this->input->post('school_medium'),
										//'school_concern_status' => $this->input->post('school_concern_status'),
										'pin' => $this->input->post('school_pincode'),
										//'username' => 'MRS'.$this->input->post('principal_first_name'),
										//'password' => 'MRS'.$this->input->post('principal_first_name'),
										//'school_created_date' => $cdate,
										'franchise_id' => $this->input->post('franchise'),
										'area_code' => $this->input->post('area_code')
										//'marrs_coordinator_first_name' =>$this->input->post('marrs_coordinator_first_name'),
										//'marrs_coordinator_last_name' =>$this->input->post('marrs_coordinator_last_name'),
										//'marrs_coordinator_email' =>$this->input->post('marrs_coordinator_email'),
										//'marrs_coordinator_phone' =>$this->input->post('marrs_coordinator_phone')
				                );
				$this->validation->set_data($post_data);
			//print_r( $_POST );exit;
				//$this->validation->set_rules('school_name', 'school name', 'required');
				$this->validation->set_rules('school_address', 'school address', 'required');
			
				
				$this->validation->set_data($post_data);
				 
				if ($this->validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
					
					redirect('manage/franchise/Addschool/','refresh');
					 
				
				} 
				else
				{
				//	print_r($post_data);die;
					$db_status=$this->schoolmodel->insertschooldata($post_data);
					if($db_status && $product_id)
					{
					  // print_r($db_status);exit;
					    
			         foreach($product_id as $key=>$product){
			             //print_r($product[$key]);exit;
			         $productId = $product;
			         $productprice = $price[$key];
			         $school_code = $this->db->get_where('school_new',array('id'=>$db_status))->row()->school_code;
			         $period_id='13';
			       	    $array = array(
					        
					        'product_id' =>$productId,
					        'period_id' =>$period_id,
					        'school_id' =>$db_status,
					        'pricecode_id' =>$productprice,
					        'school_code' =>$school_code,
					        
					        ); 
					        $this->db->insert('product_to_school',$array);
					        
			               }
				
						$this->notifications->notify('School created  succesfully', 'success');
						
					}/* end of if(db_status)*/
					else
					{
						$this->notifications->notify('Oops!!!!....Failed  school','error');
					}/* end else of if(db_status)*/
					redirect('manage/franchise/Addschool/', 'refresh');
				}
			}
			
		
			$data['result']      = $_POST;
	        $this->load->view('add_new_school',$data);
	}
	
     
    public function Add_school()
    {
		if (isset($_POST['submit']))
		{
			 //   print_r($_POST);die;
			 //print_r($_POST['area_code']);
			    $product_id =$this->input->post('product_id');
			    $price = $this->input->post('product_price');
			    $area = $this->db->get_where('areas',array('area_code'=>$this->input->post('area_code')))->row();
			 //   $last_row=$this->db->select('school_code')->order_by('id',"desc")->limit(1)->get('school_new')->row();
			  //  print_R($area); 
			  
			 // $area = $this->db->get_where('school_new',array('area_code'=>$this->input->post('area_code')) )->order_by('id',"desc")->row();
			 // ✅ GET LAST SCHOOL CODE
                $query = $this->db->select('school_code')
                    ->order_by('id', 'DESC')
                    ->limit(1)
                    ->get('school_new')
                    ->row();
                
                // Handle empty table case
                if ($query) {
                    $school_co = $query->school_code;
                
                    // Split using 'S'
                    $nex = explode('S', $school_co);
                    $num = (int)$nex[1];
                
                    // 🔥 Fix for small values
                    if ($num < 10000) {
                        $num = 9999;
                    }
                
                    $newcode = $num + 1;
                } else {
                    // First record case
                    $newcode = 10000;
                }
                
                // ✅ ALWAYS USE AREA CODE FROM FORM
                $area_code = $this->input->post('area_code');
                
                // ✅ FINAL SCHOOL CODE
                $school_code = $area_code . 'S' . $newcode;
			     //echo 'ok';
		//	     print_r($school_code);die;
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$school_board = $this->input->post('school_board');
				$post_data  =   array(
							'school_name' => $this->input->post('school_name'),
							'school_code' =>$school_code,
							'school_address' => $this->input->post('school_address'),
							'school_principal_name' => $this->input->post('principal_first_name'),
							'principal_email' => $this->input->post('principal_email'),
							'principal_phone' => $this->input->post('principal_phone'),
							'school_coordinator_name' => $this->input->post('school_coordinator_first_name'),
							//'school_coordinator_last_name' => $this->input->post('school_coordinator_last_name'),
							'school_coordinator_email' => $this->input->post('school_coordinator_email'),
							'coordinator_phone' => $this->input->post('school_coordinator_phone'),
							'country' => $this->input->post('country_id'),
							'state' => $this->input->post('stateID'),
							'city' => $this->input->post('school_city'),
							'district' => $this->input->post('school_district'),
							'location' => $this->input->post('school_locality'),
							'school_phone' => $this->input->post('school_phone'),
							'school_mobile' => $this->input->post('school_mobile'),
							'school_email' => $this->input->post('school_email'),
							'school_board' => $school_board,
							'school_medium' => $this->input->post('school_medium'),
							//'school_concern_status' => $this->input->post('school_concern_status'),
							'pin' => $this->input->post('school_pincode'),
							//'username' => 'MRS'.$this->input->post('principal_first_name'),
							'password' => $school_code,
							//'school_created_date' => $cdate,
							'franchise_id' => $this->input->post('franchise'),
							'area_code' => $this->input->post('area_code')
							//'marrs_coordinator_first_name' =>$this->input->post('marrs_coordinator_first_name'),
							//'marrs_coordinator_last_name' =>$this->input->post('marrs_coordinator_last_name'),
							//'marrs_coordinator_email' =>$this->input->post('marrs_coordinator_email'),
							//'marrs_coordinator_phone' =>$this->input->post('marrs_coordinator_phone')
	                );
			 $this->load->library('form_validation');

        $this->form_validation->set_rules('school_name', 'School Name', 'required');
        $this->form_validation->set_rules('school_mobile', 'School Mobile', 'required');
        $this->form_validation->set_rules('school_email', 'School Email', 'required|valid_email');
        $this->form_validation->set_rules('principal_first_name', 'Principal Name', 'required');
        $this->form_validation->set_rules('school_coordinator_first_name', 'Coordinator Name', 'required');
        $this->form_validation->set_rules('franchise', 'Franchise', 'required');
        $this->form_validation->set_rules('area_code', 'Area Code', 'required');

        // ❌ REMOVE OLD VALIDATION COMPLETELY
        // $this->validation->set_data($post_data);
        // $this->validation->run();

        if ($this->form_validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
					
					redirect('manage/franchise/Addschool/','refresh');
					 
				
				} 
				else
				{
				// 	print_r($post_data);die;
					$db_status=$this->schoolmodel->insertschooldata($post_data);
					if($db_status )
					{
					  
				
						$this->notifications->notify('School created  succesfully', 'success');
						
					}/* end of if(db_status)*/
					else
					{
						$this->notifications->notify('Oops!!!!....Failed  school','error');
					}/* end else of if(db_status)*/
					redirect('manage/franchise/Addschool/', 'refresh');
				}
			}
		
		$data['result']      = $_POST;
		$data['country']= $this->db->get_where('countries')->result_array();
		$data['state']= $this->db->get_where('states')->result_array();
		$data['franchise']= $this->db->get_where('franchise')->result_array();
		//print_r($data['coun']);die;
        $this->load->view('add_new_school',$data);
	}    
    
      
    public function schoolEdit()
    {
        $uri = $this->uri->segment(4);
         
        $this->db->select('*');
		$this->db->from('schools');
		$this->db->where('school_id',$uri);
		$res = $this->db->get()->row();
         
        $status = $res->school_status;
        if($status=='Active')
        {
            $data = array(
                'school_status' =>'Deactive'
            );
        }else{
            $data = array(
                'school_status' =>'Active'
            );   
        }
		
		$this->db->where('id',$uri);
	    $set_status= $this->db->update('schools',$data);
		if($set_status)
		{
            $this->notifications->notify('School Deactive Successfully ', 'success');
		} 
		else
		{
		   	$this->notifications->notify('Product Generation Failed', 'error');
		}
		redirect('manage/franchise/schooListView/');
    }
      
      
    public function Activeproduct()
    {
         
        $uri = $this->uri->segment(4);
        $data = array(
            'status' =>'Active'
            );
		 
		$this->db->where('product_id',$uri);
	    $set_status= $this->db->update('products',$data);
		
		if($set_status)
		{
            $this->notifications->notify('Product Active Successfully ', 'success');
		} 
		else
		{
		   	$this->notifications->notify('Product Active Failed', 'error');
		}
			
		redirect('https://marrs.in/franchiselogin/manage/franchise/productList/');
    }
      
      
    public function getstate($id='')
    {
        $countryid = $_POST['country_id'];
        
         $this->db->select('*');
		 $this->db->from('states');
		 $this->db->where('country_id',$countryid);
		 $this->db->order_by("state_subdivision_name", "asc");
		 $query = $this->db->get(); //echo $this->db->last_query();
	     $que = $query->result_array();
	     foreach($que as $value){?>
	     <option value="<?php echo $value['state_subdivision_id'];?>"><?php echo $value['state_subdivision_name'];?></option>
	     <?php }
         
    }
    
    
    public function getcity($id='')
    {
        $stateid = $_POST['state_id'];
      
         $this->db->select('*');
		 $this->db->from('city');
		 $this->db->where('state_id',$stateid);
		 $query = $this->db->get(); //echo $this->db->last_query();
	     $quer = $query->result_array();
	     foreach($quer as $value){?>
	     <option value="<?php echo $value['id'];?>"><?php echo $value['city_name'];?></option>
	     <?php }
         
    }
    
    
    public function student_result_upload()
    {
       
        $id = $this->uri->segment(4);
        
        $data['competition_schedule'] = $competition_schedule      = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$id))->row();
    	    
       
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {  

    	     $data['period_id']            =  $search_period_id = $competition_schedule->period_id;
    
    	     $data['level_id']             =  $search_level_id = $competition_schedule->competition_level_id;
    
    	     $data['product_id']           =  $search_service_id = $competition_schedule->product_name;
    	     
    	     
             $period_id            =  $search_period_id = $competition_schedule->period_id;
    
    	     $level_id             =  $search_level_id = $competition_schedule->competition_level_id;
    
    	     $product_name           =  $search_service_id = $competition_schedule->product_name;
    	  
    	  
    	     $product_id      = $this->db->get_where('products',array('product_name'=>$competition_schedule->product_name))->row()->product_id;
    	    
            // 	  echo $product_name;die; 
    
    		 $csvResult_upolad_logArray = array();

		 

				$start_cell_row=1;/*skip first 2 heading rows */

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

    						$cin               =  addslashes($resultRow_from_csv[0]);
    						$status            =  addslashes($resultRow_from_csv[1]);
    						$grade            =  addslashes($resultRow_from_csv[2]);
                            $rank            =  addslashes($resultRow_from_csv[3]);
                            $marks            =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller            =  addslashes($resultRow_from_csv[6]);
                            
    
    					    $csv_result_array  =  
    					            array(
    					                'student_id'=>null,
                                        'clevel'=>$level_id,
                                        'product_name'=>$product_name ?? null,
                                        'period_id'=>$period_id ?? null,
                                        'grade'=>$grade ?? null,
                                        'rank'=>$rank ?? null,
                                        'performer'=>$performer ?? 'No',
                                        'speller'=>$speller ?? 'No',
                                        'status'=>$status ?? null,
                                        'cin'=>$cin,
                                        'chest_number'=>null,
                                        'marks'=>$marks ?? null,
                                        'product_id'=>$product_id ?? null,
                                        'competition_schedule_id'=>$competition_schedule->competition_schedule_id ?? null,
                                        'competition_date'=>$competition_schedule->competition_date ?? null,
                                        'venue'=>$competition_schedule->center_address ?? null,
                                        'show'=>null,
                                        'subject'=>null,
                                        'series'=>null,
                                        'type'=>null
									);



                                if($cin != 'CIN'){
        				// 			echo "<pre>";print_r($csv_result_array);exit;					   
        
        						    $csv_upload_status = $this->franchisemodel->save_csv_result($csv_result_array);
                                }
    
    						    array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    					    }/*End if*/

					 
					    }
    
    				    $i=$i+1;	
    
    			   }
    			   while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));
    
    			    
    
        			   /*............ End Do while ................*/
        
        			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
        
        			   /*unset($_FILES);*/
        
        			   $this->notifications->notify('Result Uploaded Successfully','success');
        
        		   }/* End if */
    
    
    
                }
                
                
                /* End of if */
    
            // 		 $service_id=1;		 
            
            	 
            
            // 	$params = array("service_id"=>$service_id);	
            
            // 	$data['services'] = $this->servicemodel->listservice($params);
            
            // 	$data['level']    = $this->competitionlevelmodel->listcompetitionlevel($params);	
            
            // 	$data['period']   = $this->periodmodel->listperiod();
    
    	$this->load->view("upload_result_file.php",$data);

    }/*END of function import()*/


    public function student_result_export()
    {
        $id = $this->uri->segment(4);
    
        $competition_schedule = $this->db
            ->get_where('competition_schedule', [
                'competition_schedule_id' => $id
            ])
            ->row();
    
        if (!$competition_schedule) {
            show_404();
        }
    
        // Fetch data...
    
        $filename = "Result_" . date('Ymd_His') . ".csv";
    
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        $output = fopen('php://output', 'w');
    
        fputcsv($output, [
            'Serial No',
            'CIN',
            'Student Name',
            'School',
            'Class',
            'Category',
            'Mobile',
            'Email',
            'Status',
            'Rank',
            'Grade',
            'Level',
            'Product Name',
            'Marks',
            'Performer',
            'Speller',
            'Date',
            'Venue',
            'Show'
        ]);
    
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    
        fclose($output);
        exit;
    }


    public function student_result_upload_()
    {
       
        $id = $this->uri->segment(4);
        
        $data['competition_schedule'] = $competition_schedule = $this->db->get_where('competition_product_state',array('id'=>$id))->row();
    	    
       
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {  
            // echo '<pre>';
            // print_r($_REQUEST);
            // print_r($_POST);
            // die;
            
            
    	     $data['period_id']            =  $search_period_id = $competition_schedule->period_id;
    
    	     $data['level_id']             =  $search_level_id = $competition_schedule->clevel;
    
    	     $data['product_id']           =  $search_service_id = $competition_schedule->product_name;
    	     
    	     
             $period_id            =  $search_period_id = $competition_schedule->period_id;
    
    	     $level_id             =  $search_level_id = $competition_schedule->clevel;
    
    	     $product_name           =  $search_service_id = $competition_schedule->product_name;
    	  
    	  
    	     $product_id      = $this->db->get_where('products',array('product_name'=>$competition_schedule->product_name))->row()->product_id;
    	    
            // 	  echo $product_name;die; 
    
    		 $csvResult_upolad_logArray = array();

		 

				$start_cell_row=1;/*skip first 2 heading rows */

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

				    { 
				        if($resultRow_from_csv[0]) 
					    { 

                        
    						$cin               =  addslashes($resultRow_from_csv[0]);
    						$status            =  addslashes($resultRow_from_csv[1]);
    						$grade            =  addslashes($resultRow_from_csv[2]);
                            $rank            =  addslashes($resultRow_from_csv[3]);
                            $marks            =  addslashes($resultRow_from_csv[4]);
                            $performer            =  addslashes($resultRow_from_csv[5]);
                            $speller            =  addslashes($resultRow_from_csv[6]);
                            $venue            =  addslashes($resultRow_from_csv[7]);
                            $competition_date            =  addslashes($resultRow_from_csv[8]);
                            
                            
                            if($cin != 'CIN'){
                                
                                $venue = trim($venue);
                                $competition_date = trim($competition_date);
                                $cin = trim($cin);
                                $status = trim($status);
                                $rank = trim($rank);
                                // echo $status;die;
                                
                                if(empty($competition_date)){
                                    $csv_upload_status  = array($cin,$period_id,$status,"Validation Error : Competition Date is required.");
                                }
                                if(empty($cin)){
                                    $csv_upload_status  = array($cin,$period_id,$status,"Validation Error : CIN is required.");
                                }
                                if(!in_array($status,['Q','NQ','AB'])){
                                    $csv_upload_status  = array($cin,$period_id,$status,"Validation Error : Status must be in ['Q','NQ','AB'].");
                                }
                                if(!in_array($rank,['RANK-1','RANK-2','RANK-3','RANK-4','RANK-5','RANK-6','RANK-7','RANK-8','RANK-9','RANK-10','RANK-11','RANK-12','RANK-13','RANK-14','RANK-15','RANK-16','RANK-17','RANK-18','RANK-19','RANK-20','Rank-1','Rank-2','Rank-3','Rank-4','Rank-5','Rank-6','Rank-7','Rank-8','Rank-9','Rank-10','Rank-11','Rank-12','Rank-13','Rank-14','Rank-15','Rank-16','Rank-17','Rank-18','Rank-19','Rank-20','',null])){
                                    $csv_upload_status  = array($cin,$period_id,$status,"Validation Error : Status is not correct in format.");
                                }
        
                                if(empty($venue)){
                                    $exist = $this->db->get_where('cin_list',array('cin'=>$cin))->row();
                                    $school = $this->db->get_where('school_new',array('id'=>$exist->school_id))->row();
                                }
                                
        					    $csv_result_array  =  
    					            array(
    					                'student_id'=>null,
                                        'clevel'=>$level_id,
                                        'product_name'=>$product_name,
                                        'period_id'=>$period_id,
                                        'grade'=>$grade ?? null,
                                        'rank'=>$rank ?? null,
                                        'performer'=>$performer ?? 'No',
                                        'speller'=>$speller ?? 'No',
                                        'status'=> $status ?? null,
                                        'cin'=>$cin,
                                        'chest_number'=>null,
                                        'marks'=>$marks ?? null,
                                        'product_id'=>$product_id ?? null,
                                        'competition_schedule_id'=>$competition_schedule->id,
                                        'competition_date'=>$competition_date,
                                        'venue'=>$venue ?? $school->school_name,
                                        'show'=>null,
                                        'subject'=>null,
                                        'series'=>null,
                                        'type'=>null
									);



                                
                                    
        				            $applicable = $this->db->get_where('cin_uploade',array('comp_id'=>$competition_schedule->id,'cin'=>$cin))->row();
    	                            
        				            // $exist = $this->db->get_where('cin_result',array('product_name'=>$product_name,'period_id' => $period_id, 'clevel'=>$level_id,'cin'=>$cin))->row();
    	                            $exist = $this->db
                                        ->order_by('id', 'DESC')
                                        ->get_where(
                                            'cin_result',
                                            array(
                                                'product_name' => $product_name,
                                                'period_id'    => $period_id,
                                                'clevel'       => $level_id,
                                                'cin'          => $cin
                                            )
                                        )
                                        ->row();
    	                            
    	                            if(!empty($exist)){
    	                                
    	                                $this->db->where('id', $exist->id);
                                        $updated = $this->db->update('cin_result', $csv_result_array);
                                    
                                        if ($updated) {
                                            $csv_upload_status = array(
                                                $cin,
                                                $period_id,
                                                $status,
                                                " Success : Result Updated Successfully."
                                            );
                                        } else {
                                            $csv_upload_status = array(
                                                $cin,
                                                $period_id,
                                                $status,
                                                "Error : Result Update Failed."
                                            );
                                        }
    	                               // $csv_upload_status  = array($cin,$period_id,$status," Error : Result Already Exist.");
    	                            }elseif(!empty($applicable)){
    	                                $csv_upload_status  = array($cin,$period_id,$status," Error : Student Not Uploaded under this schedule");
    	                            }else{
        						        $this->db->insert('cin_result',$csv_result_array);
        						        $csv_upload_status  = array($cin,$period_id,$status," Success : Result Inserted.");
    	                            }
    	                            
        						       
                                
    
        						    array_push($csvResult_upolad_logArray,$csv_upload_status);
                                }
    
    					    }/*End if*/

					 
					    }
    
    				    $i=$i+1;	
    
    			   }
			    while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));

			    

    			   /*............ End Do while ................*/
    
    			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    
    			   /*unset($_FILES);*/
    
    			   $this->notifications->notify('Result Uploaded Successfully','success');
    
    		    }/* End if */



        }
                
            
        /* End of if */

        // 		 $service_id=1;		 
        
        	 
        
        // 	$params = array("service_id"=>$service_id);	
        
        // 	$data['services'] = $this->servicemodel->listservice($params);
        
        // 	$data['level']    = $this->competitionlevelmodel->listcompetitionlevel($params);	
        
        // 	$data['period']   = $this->periodmodel->listperiod();
    
    	$this->load->view("upload_result_file_.php",$data);

    }/*END of function import()*/


    public function calculate_result_($competition_schedule_id)
    {
        $competition_schedule = $this->db
            ->get_where(
                'competition_product_state',
                array('id' => $competition_schedule_id)
            )
            ->row();
            
        // print_r($competition_schedule);die;
    
        if (empty($competition_schedule)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Competition schedule not found.'
            ]);
    
            return;
        }
    
    
        $period_id    = $competition_schedule->period_id;
        $level_id     = $competition_schedule->clevel;
        $product_name = $competition_schedule->product_name;
    
    
        /*
         * Product ID
         */
        $product = $this->db
            ->get_where(
                'products',
                array(
                    'product_name' => $product_name
                )
            )
            ->row();
    
        if (empty($product)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Product not found.'
            ]);
    
            return;
        }
    
        $product_id = $product->product_id;
    
    
        /*
         * Form values
         */
        $exam_center = trim($this->input->post('exam_center'));
    
        if (empty($exam_center)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Please select Competition Date and Venue.'
            ]);
    
            return;
        }
    
        $center = explode(',', $exam_center, 2);
    
        $competition_date = trim($center[0] ?? '');
        $venue             = trim($center[1] ?? '');
    
        $total_marks = (float) $this->input->post('total_marks');
    
    
        if ($total_marks <= 0) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Invalid Max Marks.'
            ]);
    
            return;
        }
    
    
        /*
         * CSV validation
         */
        if (
            !isset($_FILES['csv']) ||
            $_FILES['csv']['error'] != UPLOAD_ERR_OK
        ) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Please upload a valid CSV file.'
            ]);
    
            return;
        }
    
    
        $file = $_FILES['csv']['tmp_name'];
    
        $handle = fopen($file, 'r');
    
        if (!$handle) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Unable to read CSV file.'
            ]);
    
            return;
        }
    
    
        /*
         * Read CSV
         */
        $csvRows = [];
    
        $rowNumber = 0;
    
        while (($csvRow = fgetcsv($handle, 1000, ",", "'")) !== false) {
    
            $rowNumber++;
    
            // Skip header
            if ($rowNumber == 1) {
                continue;
            }
    
            if (empty($csvRow) || empty(trim($csvRow[0] ?? ''))) {
                continue;
            }
    
            $cin   = trim($csvRow[0] ?? '');
            $rank   = trim($csvRow[1] ?? '');
            $marks = trim($csvRow[2] ?? '');
    
            if ($cin === '') {
                continue;
            }
    
            if ($marks === '' || !is_numeric($marks)) {
    
                $csvRows[] = [
                    'cin'     => $cin,
                    'marks'   => $marks,
                    'rank'   => $rank,
                    'error'   => true,
                    'message' => 'Invalid marks.'
                ];
    
                continue;
            }
    
            $marks = (float) $marks;
    
            $csvRows[] = [
                'cin'   => $cin,
                'marks' => $marks,
                'rank'  => $rank
            ];
        }
    
        fclose($handle);
    
    
        if (empty($csvRows)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'No result records found in CSV.'
            ]);
    
            return;
        }
    
    
        /*
         * First calculate ranks.
         *
         * Rank is based on Marks.
         */
        $validRows = [];
    
        foreach ($csvRows as $key => $row) {
    
            if (!empty($row['error'])) {
                continue;
            }
    
            $validRows[$key] = $row;
        }
    
    
        usort($validRows, function ($a, $b) {
    
            return $b['marks'] <=> $a['marks'];
        });
    
    
        /*
         * Competition ranking:
         *
         * 100
         * 100
         * 90
         * 80
         *
         * becomes
         *
         * Rank-1
         * Rank-1
         * Rank-3
         * Rank-4
         */
        // $rank = 0;
        $position = 0;
        $previous_marks = null;
    
        // foreach ($validRows as &$row) {
    
        //     $position++;
    
        //     if (
        //         $previous_marks === null ||
        //         $row['marks'] != $previous_marks
        //     ) {
        //         $rank = $position;
        //     }
    
        //     $row['rank'] = $rank;
    
        //     $previous_marks = $row['marks'];
        // }
    
        unset($row);
    
    
        /*
         * Re-index by CIN so we can
         * combine with validation results.
         */
        // $rankByCin = [];
    
        // foreach ($validRows as $row) {
    
        //     $rankByCin[$row['cin']] = $row['rank'];
        // }
    
    
        /*
         * Level name
         */
        $levelData = $this->db
            ->where('product_name', $product_name)
            ->where('level_id', $level_id)
            ->get('competition_level_byproduct')
            ->row();
    
        $level_name = !empty($levelData)
            ? $levelData->level_name
            : '';
    
    
        /*
         * Prepare final rows
         */
        $resultRows = [];
    
        foreach ($csvRows as $row) {
    
            $cin = $row['cin'];
    
            /*
             * Invalid CSV row
             */
            if (!empty($row['error'])) {
    
                $resultRows[] = $row;
    
                continue;
            }
    
    
            $marks = (float) $row['marks'];
    
    
            /*
             * Find CIN
             */
            $cinexist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_list',
                    [
                        'cin' => $cin
                    ]
                )
                ->row();
    
    
            /*
             * Check result already exists
             */
            $exist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_result',
                    [
                        'product_name' => $product_name,
                        'period_id'    => $period_id,
                        'clevel'       => $level_id,
                        'cin'          => $cin
                    ]
                )
                ->row();
    
    
            /*
             * Check student is applicable
             * for this schedule
             */
            $applicable = $this->db
                ->get_where(
                    'cin_uploade',
                    [
                        'comp_id' => $competition_schedule->id,
                        'cin'     => $cin
                    ]
                )
                ->row();
    
    
            /*
             * Default row
             */
            $calculated = [
                'student_id' => !empty($cinexist)
                    ? $cinexist->id
                    : null,
    
                'clevel' => $level_id,
    
                'product_name' => $product_name,
    
                'period_id' => $period_id,
    
                'cin' => $cin,
    
                'marks' => $marks,
    
                'high_marks' => $total_marks,
    
                // 'rank' => $rankByCin[$cin] ?? null,
    
                'product_id' => $product_id,
    
                'competition_schedule_id' =>
                    $competition_schedule->id,
    
                'competition_date' =>
                    $competition_date,
    
                'venue' => $venue,
                
                'rank'   => $rank ?? null,
            ];
    
    
            /*
             * Student doesn't exist
             */
            if (empty($cinexist)) {
    
                $calculated['error'] = true;
    
                $calculated['message'] =
                    'Error : Student Not Found';
    
                $resultRows[] = $calculated;
    
                continue;
            }
    
    
            /*
             * Result already exists
             */
            if (!empty($exist)) {
    
                $calculated['error'] = true;
    
                $calculated['message'] =
                    'Result Already Exist';
    
                $calculated['existing_result_id'] =
                    $exist->id;
    
                $resultRows[] = $calculated;
    
                continue;
            }
    
    
            /*
             * Student is NOT uploaded
             * under this schedule
             *
             * IMPORTANT:
             * Your previous code had this condition reversed.
             */
            if (empty($applicable)) {
    
                $calculated['error'] = true;
    
                $calculated['message'] =
                    'Error : Student Not Uploaded under this schedule';
    
                $resultRows[] = $calculated;
    
                continue;
            }
    
    
            /*
             * ==============================
             * Calculate Percentile
             * ==============================
             */
    
            if ($total_marks > 0) {
    
                $percentile = round(
                    ($marks / $total_marks) * 100
                );
    
            } else {
    
                $percentile = 0;
            }
    
    
            /*
             * ==============================
             * Calculate Grade
             * ==============================
             */
    
            if ($marks >= 80) {
    
                $grade = 'A+++';
    
            } elseif ($marks > 59) {
    
                $grade = 'A++';
    
            } elseif ($marks > 39) {
    
                $grade = 'A+';
    
            } elseif ($marks > 14) {
    
                $grade = 'A';
    
            } elseif ($marks > 4) {
    
                $grade = 'B+++';
    
            } elseif ($marks > 0) {
    
                $grade = 'B++';
    
            } else {
    
                $grade = '';
            }
    
    
            /*
             * ==============================
             * Calculate Status
             * ==============================
             */
    
            if (
                in_array(
                    $grade,
                    ['A+++', 'A++', 'A+']
                )
            ) {
    
                $status = 'Q';
    
            } else {
    
                $status = 'NQ';
            }
    
    
            /*
             * ==============================
             * Awards
             * ==============================
             */
    
            $performer = 'No';
            $speller   = 'No';
    
    
            /*
             * Best Performer
             *
             * All products:
             * School Level
             * National Finals
             * International Finals
             */
            $bestPerformerLevels = [
                'school level',
                'national finals',
                'international finals'
            ];
    
            if (
                in_array(
                    strtolower(trim($level_name)),
                    $bestPerformerLevels
                ) &&
                ($rankByCin[$cin] ?? 0) == 1
            ) {
    
                $performer = 'Yes';
            }
    
    
            /*
             * Star Speller
             *
             * Spelling Bee only:
             * National Finals
             * International Finals
             */
            $starSpellerLevels = [
                'national finals',
                'international finals'
            ];
    
    
            /*
             * CHANGE 2 TO YOUR ACTUAL SPELLING
             * BEE PRODUCT ID.
             */
            $isSpellingBee = ($product_id == 2);
    
    
            if (
                $isSpellingBee &&
                in_array(
                    strtolower(trim($level_name)),
                    $starSpellerLevels
                ) &&
                ($rankByCin[$cin] ?? 0) == 1
            ) {
    
                $speller = 'Yes';
            }
    
    
            /*
             * Final calculated data
             */
            $calculated['student_name'] =
                $cinexist->student_name ?? '';
    
            $calculated['grade'] =
                $grade;
    
            $calculated['status'] =
                $status;
    
            $calculated['percentile'] =
                $percentile;
    
            $calculated['performer'] =
                $performer;
    
            $calculated['speller'] =
                $speller;
    
            $calculated['error'] =
                false;
    
            $calculated['message'] =
                'Success : Result Applicable.';
    
    
            $resultRows[] = $calculated;
        }
    
    
        echo json_encode([
            'success' => true,
            'period_id' => $period_id,
            'product_id' => $product_id,
            'product_name' => $product_name,
            'clevel' => $level_id,
            'rows' => $resultRows
        ]);
    }


    public function calculate_result($competition_schedule_id)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Competition Schedule
        |--------------------------------------------------------------------------
        */
        $competition_schedule = $this->db
            ->get_where(
                'competition_product_state',
                [
                    'id' => $competition_schedule_id
                ]
            )
            ->row();
    
        if (empty($competition_schedule)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Competition schedule not found.'
            ]);
    
            return;
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */
        $period_id    = $competition_schedule->period_id;
        $level_id     = $competition_schedule->clevel;
        $product_name = $competition_schedule->product_name;
    
    
    
        /*
        |--------------------------------------------------------------------------
        | 2. Product
        |--------------------------------------------------------------------------
        */
        $product = $this->db
            ->get_where(
                'products',
                [
                    'product_name' => $product_name
                ]
            )
            ->row();
    
        if (empty($product)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Product not found.'
            ]);
    
            return;
        }
    
        $product_id = $product->product_id;
    
    
        /*
        |--------------------------------------------------------------------------
        | 3. Revenue Setting
        |--------------------------------------------------------------------------
        */
        $revenue_setting = $this->db
            ->get_where(
                'revenue_setting',
                [
                    'id' => $competition_schedule->revenue_setting_id
                ]
            )
            ->row();
    
        if (empty($revenue_setting)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Revenue setting not found.'
            ]);
    
            return;
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Rank Count
        |--------------------------------------------------------------------------
        */
        $rank_count = (int) ($revenue_setting->rank_count ?? 3);
    
    
        /*
        |--------------------------------------------------------------------------
        | 4. Exam Center
        |--------------------------------------------------------------------------
        */
        $exam_center = trim(
            $this->input->post('exam_center')
        );
    
        if (empty($exam_center)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Please select Competition Date and Venue.'
            ]);
    
            return;
        }
    
    
        $center            = explode(',', $exam_center, 2);
        $competition_date  = trim($center[0] ?? '');
        $venue             = trim($center[1] ?? '');
    
    
        /*
        |--------------------------------------------------------------------------
        | 5. CSV Validation
        |--------------------------------------------------------------------------
        */
        if (
            !isset($_FILES['csv']) ||
            $_FILES['csv']['error'] != UPLOAD_ERR_OK
        ) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Please upload a valid CSV file.'
            ]);
    
            return;
        }
    
    
        $handle = fopen(
            $_FILES['csv']['tmp_name'],
            'r'
        );
    
        if (!$handle) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Unable to read CSV file.'
            ]);
    
            return;
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | 6. Level
        |--------------------------------------------------------------------------
        */
        $levelData = $this->db
            ->where('product_name', $product_name)
            ->where('level_id', $level_id)
            ->get('competition_level_byproduct')
            ->row();
    
        $level_name = !empty($levelData)
            ? $levelData->level_name
            : '';
    
    
        /*
        |--------------------------------------------------------------------------
        | 7. Read CSV
        |--------------------------------------------------------------------------
        |
        | CSV:
        |
        | CIN | Marks | High Marks
        |
        | Rank is NOT read.
        |--------------------------------------------------------------------------
        */
    
        $validRows = [];
    
        $errorRows = [];
    
        $rowNumber = 0;
    
    
        while (
            ($csvRow = fgetcsv(
                $handle,
                1000,
                ",",
                "'"
            )) !== false
        ) {
    
            $rowNumber++;
    
    
            /*
            | Skip header
            */
            if ($rowNumber == 1) {
                continue;
            }
    
    
            /*
            | Skip empty row
            */
            if (
                empty($csvRow) ||
                empty(trim($csvRow[0] ?? ''))
            ) {
                continue;
            }
    
    
            $cin   = trim($csvRow[0] ?? '');
            $marks = trim($csvRow[1] ?? '');
            $marks2 = trim($csvRow[2] ?? '');
            
    
            /*
            |--------------------------------------------------------------------------
            | Marks validation
            |--------------------------------------------------------------------------
            */
            if ($marks === '' || !is_numeric($marks)) {
    
                $errorRows[] = [
    
                    'cin' => $cin,
    
                    'marks' => $marks,
    
                    'error' => true,
    
                    'message' => 'Invalid marks.'
    
                ];
    
                continue;
            }
            
            $array = [5, 7, 10];

            if (in_array((int)$level_id, $array)) {
            
                if (trim($marks2) === '' || !is_numeric($marks2)) {
            
                    $errorRows[] = [
            
                        'cin'   => $cin,
                        'marks' => $marks,
                        'marks2' => $marks2,
            
                        'error' => true,
            
                        'message' => 'Error : Student Prelims marks required or invalid.'
            
                    ];
            
                    continue;
                }
            }
    
    
            $finals_score  = $marks = (float) $marks;
            $prelims_score = $marks2 = (float) $marks2;
    
    
            /*
            |--------------------------------------------------------------------------
            | 8. Check CIN
            |--------------------------------------------------------------------------
            */
            $cinexist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_list',
                    [
                        'cin' => $cin
                    ]
                )
                ->row();
    
    
            /*
            |--------------------------------------------------------------------------
            | CIN does not exist
            |--------------------------------------------------------------------------
            */
            if (empty($cinexist)) {
    
                $errorRows[] = [
    
                    'cin' => $cin,
    
                    'marks' => $marks,
    
                    'error' => true,
    
                    'message' =>
                        'Error : Student Not Found'
    
                ];
    
                continue;
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | 9. Check Student Applicable
            |--------------------------------------------------------------------------
            */
            $applicable = $this->db
                ->get_where(
                    'cin_uploade',
                    [
                        'comp_id' => $competition_schedule_id,
                        'cin'     => $cin
                    ]
                )
                ->row();
    
    
            if (empty($applicable)) {
    
                $errorRows[] = [
    
                    'student_id' =>
                        $cinexist->id,
    
                    'cin' =>
                        $cin,
    
                    'marks' =>
                        $marks,
    
                    'error' =>
                        true,
    
                    'message' =>
                        'Error : Student Not Uploaded under this schedule'
    
                ];
    
                continue;
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | 10. Check Existing Result
            |--------------------------------------------------------------------------
            */
            $exist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_result',
                    [
                        'product_name' => $product_name,
                        'period_id'    => $period_id,
                        'clevel'       => $level_id,
                        'cin'          => $cin
                    ]
                )
                ->row();
    
    
            if (!empty($exist)) {
    
                $errorRows[] = [
    
                    'student_id' =>
                        $cinexist->id,
    
                    'cin' =>
                        $cin,
    
                    'marks' =>
                        $marks,
    
                    'error' =>
                        true,
    
                    'existing_result_id' =>
                        $exist->id,
    
                    'message' =>
                        'Result Already Exist'
    
                ];
    
                continue;
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | 11. Get Student Class
            |--------------------------------------------------------------------------
            */
            $student_class = trim(
                $cinexist->class ?? ''
            );
    
    
            /*
            |--------------------------------------------------------------------------
            | 12. Get Category
            |--------------------------------------------------------------------------
            */
            $category = '-';
    
    
            if ($student_class !== '') {
    
                $categoryRow = $this->db
                    ->where(
                        'product_name',
                        $product_name
                    )
                    ->where(
                        'class',
                        $student_class
                    )
                    ->get('class_category_product')
                    ->row();
    
    
                if (!empty($categoryRow)) {
    
                    $category =
                        $categoryRow->category;
    
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | 13. Put ONLY VALID student into clean array
            |--------------------------------------------------------------------------
            */
            $validRows[] = [
    
                'student_id' =>
                    $cinexist->id,
    
                'student_name' =>
                    $cinexist->student_name ?? '',
    
                'cin' =>
                    $cin,
    
                'class' =>
                    $student_class,
    
                'category' =>
                    $category,
    
                'marks' =>
                    $marks
    
            ];
        }
    
    
        fclose($handle);
    
    
        /*
        |--------------------------------------------------------------------------
        | No valid rows
        |--------------------------------------------------------------------------
        */
        if (empty($validRows)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'No valid result records found.',
                'rows' => $errorRows
            ]);
    
            return;
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | 14. ARRANGE CATEGORY WISE
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | [
        |     "Category A" => [
        |         student1,
        |         student2
        |     ],
        |
        |     "Category B" => [
        |         student3,
        |         student4
        |     ]
        | ]
        |--------------------------------------------------------------------------
        */
    
        $categoryWiseRows = [];
    
    
        foreach ($validRows as $row) {
    
            $category =
                $row['category'] ?? '-';
    
    
            if (!isset(
                $categoryWiseRows[$category]
            )) {
    
                $categoryWiseRows[$category] = [];
    
            }
    
    
            $categoryWiseRows[$category][] =
                $row;
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | 15. SORT EACH CATEGORY BY MARKS DESC
        |--------------------------------------------------------------------------
        */
        foreach (
            $categoryWiseRows
            as $category => &$rows
        ) {
    
            usort(
                $rows,
                function ($a, $b) {
    
                    return
                        $b['marks']
                        <=>
                        $a['marks'];
                }
            );
        }
    
        unset($rows);
    
    
        /*
        |--------------------------------------------------------------------------
        | 16. NOW CALCULATE RESULT
        |--------------------------------------------------------------------------
        */
        $resultRows = [];
    
    
        foreach (
            $categoryWiseRows
            as $category => $rows
        ) {
    
    
            /*
            |--------------------------------------------------------------------------
            | Highest mark in THIS category
            |--------------------------------------------------------------------------
            |
            | Because rows are already DESC sorted,
            | first row has highest mark.
            |--------------------------------------------------------------------------
            */
            $categoryHighMarks =
                (float) $rows[0]['marks'];
    
    
            /*
            |--------------------------------------------------------------------------
            | Rank tracking
            |--------------------------------------------------------------------------
            */
            $currentRank = 0;
    
            $previousMarks = $marks2;
    
    
            /*
            |--------------------------------------------------------------------------
            | Calculate every student
            |--------------------------------------------------------------------------
            */
            foreach (
                $rows as $index => $row
            ) {
    
                $marks =
                    (float) $row['marks'];
    
    
                /*
                |--------------------------------------------------------------------------
                | Rank
                |--------------------------------------------------------------------------
                |
                | Same marks = same rank
                |--------------------------------------------------------------------------
                */
                if (
                    $previousMarks === null ||
                    $marks != $previousMarks
                ) {
    
                    $currentRank++;
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Rank Count
                |--------------------------------------------------------------------------
                */
                $rank = null;
    
    
                if (
                    $rank_count > 0 &&
                    $currentRank <= $rank_count
                ) {
    
                    $rank =
                        'Rank-' . $currentRank;
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Percentile
                |--------------------------------------------------------------------------
                */
                
                
                // prelims highest score and
                
                
                if ($categoryHighMarks > 0) {
    
                    $percentile = round(
                        (
                            $marks /
                            $categoryHighMarks
                        ) * 100
                    );
    
                } else {
    
                    $percentile = 0;
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Grade
                |--------------------------------------------------------------------------
                */
                if ($percentile >= 80) {
    
                    $grade = 'A+++';
    
                } elseif ($percentile > 59) {
    
                    $grade = 'A++';
    
                } elseif ($percentile > 39) {
    
                    $grade = 'A+';
    
                } elseif ($percentile > 14) {
    
                    $grade = 'A';
    
                } elseif ($percentile > 4) {
    
                    $grade = 'B+++';
    
                } elseif ($percentile > 0) {
    
                    $grade = 'B++';
    
                } else {
    
                    $grade = '';
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */
                $status =
                    in_array(
                        $grade,
                        [
                            'A+++',
                            'A++',
                            'A+'
                        ]
                    )
                    ? 'Q'
                    : 'NQ';
    
    
                /*
                |--------------------------------------------------------------------------
                | Awards
                |--------------------------------------------------------------------------
                */
                $performer = 'No';
                $speller   = 'No';
    
    
                /*
                |--------------------------------------------------------------------------
                | Best Performer
                |--------------------------------------------------------------------------
                */
                $bestPerformerLevels = [
    
                    'school_level',
                    'national_finals',
                    'international_finals'
    
                ];
    
    
                if (
                    in_array(
                        strtolower(
                            trim($level_name)
                        ),
                        $bestPerformerLevels
                    ) &&
                    $currentRank == 1
                ) {
    
                    $performer = 'Yes';
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Star Speller
                |--------------------------------------------------------------------------
                */
                $starSpellerLevels = [
    
                    'national_finals',
                    'international_finals'
    
                ];
    
    
                /*
                | MISB / Spelling Bee
                */
                $isSpellingBee =
                    ($product_id == 2);
    
    
                if (
                    $isSpellingBee &&
                    in_array(
                        strtolower(
                            trim($level_name)
                        ),
                        $starSpellerLevels
                    ) &&
                    $currentRank == 1
                ) {
    
                    $speller = 'Yes';
    
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Final row
                |--------------------------------------------------------------------------
                */
                $calculated = [
    
                    'student_id' =>
                        $row['student_id'],
    
                    'student_name' =>
                        $row['student_name'],
    
                    'clevel' =>
                        $level_id,
    
                    'product_name' =>
                        $product_name,
    
                    'period_id' =>
                        $period_id,
    
                    'cin' =>
                        $row['cin'],
    
                    'class' =>
                        $row['class'],
    
                    'category' =>
                        $category,
                        
                    'finals_score' => 
                        $finals_score,
                    
                    'prelims_score' => 
                        $prelims_score,
    
                    'marks' =>
                        $percentile,
    
                    /*
                    | Category highest mark
                    */
                    'high_marks' =>
                        $categoryHighMarks,
    
                    'product_id' =>
                        $product_id,
    
                    'competition_schedule_id' =>
                        $competition_schedule_id,
    
                    'competition_date' =>
                        $competition_date,
    
                    'venue' =>
                        $venue,
    
                    'rank' =>
                        $rank,
    
                    'grade' =>
                        $grade,
    
                    'status' =>
                        $status,
    
                    'percentile' =>
                        $percentile,
    
                    'performer' =>
                        $performer,
    
                    'speller' =>
                        $speller,
    
                    'error' =>
                        false,
    
                    'message' =>
                        'Success : Result Applicable.'
    
                ];
    
    
                $resultRows[] =
                    $calculated;
    
    
                $previousMarks =
                    $marks;
            }
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | 17. Add validation/error rows
        |--------------------------------------------------------------------------
        |
        | Keep successful rows first and errors afterwards.
        | If you want CSV original order, we can change this later.
        |--------------------------------------------------------------------------
        */
        $resultRows =
            array_merge(
                $resultRows,
                $errorRows
            );
    
    
        /*
        |--------------------------------------------------------------------------
        | 18. Response
        |--------------------------------------------------------------------------
        */
        echo json_encode([
    
            'success' =>
                true,
    
            'period_id' =>
                $period_id,
    
            'product_id' =>
                $product_id,
    
            'product_name' =>
                $product_name,
    
            'clevel' =>
                $level_id,
    
            'rows' =>
                $resultRows
    
        ]);
    }


    public function save_calculated_result()
    {
        /*
         * Get rows from AJAX POST
         */
        $rows_json = $this->input->post('rows');
    
        // Debug if required
        // echo '<pre>';
        // print_r($rows_json);
        // die;
    
        if (empty($rows_json)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'No result rows received.'
            ]);
    
            return;
        }
    
    
        /*
         * Decode JSON
         */
        $rows = json_decode($rows_json, true);
    
    
        /*
         * Check JSON
         */
        if (json_last_error() !== JSON_ERROR_NONE) {
    
            echo json_encode([
                'success' => false,
                'message' => 'Invalid JSON: ' . json_last_error_msg()
            ]);
    
            return;
        }
    
    
        if (!is_array($rows) || empty($rows)) {
    
            echo json_encode([
                'success' => false,
                'message' => 'No result rows available.'
            ]);
    
            return;
        }
    
    
        /*
         * Debug
         */
        // echo '<pre>';
        // print_r($rows);
        // die;
    
    
        $inserted = 0;
        $skipped  = 0;
        $errors   = [];
    
    
        /*
         * Process every row
         */
        foreach ($rows as $row) {
    
            $cin = trim($row['cin'] ?? '');
    
            if (empty($cin)) {
    
                $skipped++;
    
                continue;
            }
    
    
            /*
             * Values received from AJAX
             */
            $student_id              = $row['student_id'] ?? null;
            $clevel                  = $row['clevel'] ?? null;
            $product_name            = $row['product_name'] ?? null;
            $period_id               = $row['period_id'] ?? null;
            
            $finals_score            = $row['finals_score'] ?? null;
            $prelims_score           = $row['prelims_score'] ?? null;
                        
            $marks                   = $row['marks'] ?? null;
            $marks2                  = $row['marks2'] ?? null;
            $high_marks              = $row['high_marks'] ?? null;
            $product_id              = $row['product_id'] ?? null;
            $competition_schedule_id = $row['competition_schedule_id'] ?? null;
            $competition_date        = $row['competition_date'] ?? null;
            $venue                   = $row['venue'] ?? null;
            $rank                    = $row['rank'] ?? null;
            $grade                   = $row['grade'] ?? null;
            $status                  = $row['status'] ?? null;
            $percentile              = $row['percentile'] ?? null;
            $performer               = $row['performer'] ?? 'No';
            $speller                 = $row['speller'] ?? 'No';
    
    
            /*
             * ----------------------------------------------------
             * Check CIN exists
             * ----------------------------------------------------
             */
            $cinexist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_list',
                    [
                        'cin' => $cin
                    ]
                )
                ->row();
    
    
            if (empty($cinexist)) {
    
                $skipped++;
    
                $errors[] = [
                    'cin' => $cin,
                    'message' => 'Student Not Found'
                ];
    
                continue;
            }
    
    
            /*
             * ----------------------------------------------------
             * Check student applicable to schedule
             * ----------------------------------------------------
             */
            $applicable = $this->db
                ->get_where(
                    'cin_uploade',
                    [
                        'comp_id' => $competition_schedule_id,
                        'cin'     => $cin
                    ]
                )
                ->row();
    
    
            if (empty($applicable)) {
    
                $skipped++;
    
                $errors[] = [
                    'cin' => $cin,
                    'message' =>
                        'Student Not Uploaded under this schedule'
                ];
    
                continue;
            }
    
    
            /*
             * ----------------------------------------------------
             * Check result already exists
             * ----------------------------------------------------
             */
            $exist = $this->db
                ->order_by('id', 'DESC')
                ->get_where(
                    'cin_result',
                    [
                        'product_name' => $product_name,
                        'period_id'    => $period_id,
                        'clevel'       => $clevel,
                        'cin'          => $cin
                    ]
                )
                ->row();
    
    
            if (!empty($exist)) {
    
                $skipped++;
    
                $errors[] = [
                    'cin' => $cin,
                    'message' => 'Result Already Exist',
                    'result_id' => $exist->id
                ];
    
                continue;
            }
    
    
            /*
             * ----------------------------------------------------
             * Insert result
             * ----------------------------------------------------
             */
            $insertData = [
    
                'student_id' =>
                    $student_id,
    
                'clevel' =>
                    $clevel,
    
                'product_name' =>
                    $product_name,
    
                'period_id' =>
                    $period_id,
    
                'grade' =>
                    $grade,
    
                'rank' =>
                    $rank,
    
                'performer' =>
                    $performer,
    
                'speller' =>
                    $speller,
    
                'status' =>
                    $status,
    
                'cin' =>
                    $cin,
    
                'chest_number' =>
                    null,
    
                'marks' =>
                    $percentile,
    
                'finals_score' => $finals_score,
                
                'prelims_score' => $prelims_score,
    
                'percentile' =>
                    $percentile,
    
                'product_id' =>
                    $product_id,
    
                'competition_schedule_id' =>
                    $competition_schedule_id,
    
                'competition_date' =>
                    $competition_date,
    
                'venue' =>
                    $venue,
    
                'show' =>
                    null,
    
                'subject' =>
                    null,
    
                'series' =>
                    null,
    
                'type' =>
                    null
            ];
    
    // print_r($insertData);die;
    
    
            /*
             * Insert
             */
            $this->db->insert(
                'cin_result',
                $insertData
            );
    
    
            if ($this->db->affected_rows() > 0) {
    
                $inserted++;
    
            } else {
    
                $errors[] = [
                    'cin' => $cin,
                    'message' => 'Database Insert Failed',
                    'db_error' => $this->db->error()
                ];
    
            }
    
        }
    
    
        /*
         * Final response
         */
        echo json_encode([
    
            'success' => true,
    
            'message' =>
                'Result processing completed.',
    
            'inserted' =>
                $inserted,
    
            'skipped' =>
                $skipped,
    
            'errors' =>
                $errors
    
        ]);
    }


    public function student_result_export_()
    {
        $id = $this->uri->segment(4);
    
        $competition_schedule = $this->db
            ->get_where('competition_product_state', [
                'id' => $id
            ])
            ->row();
    
        if (!$competition_schedule) {
            show_404();
        }
    
        // Fetch data...
    
        $filename = "Result_" . date('Ymd_His') . ".csv";
    
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        $output = fopen('php://output', 'w');
    
        fputcsv($output, [
            'Serial No',
            'CIN',
            'Student Name',
            'School',
            'Class',
            'Category',
            'Mobile',
            'Email',
            'Status',
            'Rank',
            'Grade',
            'Level',
            'Product Name',
            'Marks',
            'Performer',
            'Speller',
            'Date',
            'Venue',
            'Show'
        ]);
    
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    
        fclose($output);
        exit;
    }
    

    public function student_result_upload1()
    {
        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
    
            $period_id   = $this->input->post('period');
            $level_id    = $this->input->post('level');
            $product_id  = $this->input->post('product');
    
            $data['period_id']  = $period_id;
            $data['level_id']   = $level_id;
            $data['product_id'] = $product_id;
    
            $product_name = $this->db->get_where('products', array('product_id' => $product_id))
                                     ->row()->product_name;
    
            $csvResult_upolad_logArray = [];
    
            if ($_FILES['csv']['size'] > 0) {
                $file   = $_FILES['csv']['tmp_name'];
                $handle = fopen($file, "r");
    
                $i = 1;
                while (($resultRow_from_csv = fgetcsv($handle, 1000, ",", "'")) !== false) {
                    if ($i === 1) { $i++; continue; } // ✅ skip header row
    
                    if (!empty($resultRow_from_csv[0])) {
                        $cin       = addslashes($resultRow_from_csv[0]);
                        $status    = addslashes($resultRow_from_csv[1]);
                        $grade     = addslashes($resultRow_from_csv[2]);
                        $rank      = addslashes($resultRow_from_csv[3]);
                        $marks     = addslashes($resultRow_from_csv[4]);
                        $performer = addslashes($resultRow_from_csv[5]);
                        $speller   = addslashes($resultRow_from_csv[6]);
    
                        $csv_result_array = array(
                            'period_id'    => $period_id,   // ✅ was $period (undefined)
                            'clevel'       => $level_id,
                            'product_id'   => $product_id,
                            'cin'          => $cin,
                            'status'       => $status,
                            'grade'        => $grade,
                            'rank'         => $rank,
                            'performer'    => $performer,
                            'speller'      => $speller,
                            'marks'        => $marks,
                            'product_name' => $product_name
                        );
    
                       //print_r($csv_result_array);die;
    
                        $csv_upload_status = $this->franchisemodel->save_csv_result1($csv_result_array);
                        array_push($csvResult_upolad_logArray, $csv_upload_status);
                    }
                    $i++;
                }
    
                fclose($handle); // ✅ good practice
    
                $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
                $this->notifications->notify('Result Uploaded Successfully', 'success');
            }
        }
    
        $this->load->view("upload_result_file.php", $data);
    }


    public function student_result_edit()
    {
       
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {  
    	     $data['level_id']             =  $search_level_id = $this->input->post('level');
    
    	     $data['product_id']           =  $search_service_id = $this->input->post('product_name');
    	     
    	     $level_id             =  $search_level_id = $this->input->post('level');
    
    	     $product_id           =  $search_service_id = $this->input->post('product_name');
    	  
    	     $data['product'] = $product_name         =  $this->db->get_where('products',array('product_id'=>$this->input->post('product_name')))->row()->product_name;
    	    
    	   // print_R($_POST);die;
    	    
            // 	  echo $product_name;die; 
    
    		$csvResult_upolad_logArray = array();

			$start_cell_row=1;/*skip first 2 heading rows */

			$i=0;

		    $data['result'] = $_POST;

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

    						$cin               =  addslashes($resultRow_from_csv[0]);
    						$status            =  addslashes($resultRow_from_csv[1]);
    						$grade             =  addslashes($resultRow_from_csv[2]);
    						$rank              =  addslashes($resultRow_from_csv[3]);
    						$marks             =  addslashes($resultRow_from_csv[4]);
                            $performer         =  addslashes($resultRow_from_csv[5]);
                            $speller           =  addslashes($resultRow_from_csv[6]);
                            
    					    $csv_result_array  =  
    					            array(  
			                               'clevel'               => $level_id ,
										   'product_id'           => $product_id,
										   'cin'                  => $cin,
										   'status'               => $status,
										   'grade'                => $grade,
										   'rank'                 => $rank,
										   'performer'            => $performer,
										   'speller'              => $speller,
										   'marks'                => $marks,
										   'product_name'         => $product_name,
										  
									    );



    				// 			echo "<pre>";print_r($csv_result_array);exit;					   
    
    						    $csv_upload_status = $this->franchisemodel->edit_csv_result($csv_result_array);
    
    						    array_push($csvResult_upolad_logArray,$csv_upload_status);
    
    				    }
					 
				    }
    
    				    $i=$i+1;	
    
			    }
			    while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));

    			    
    
        			   /*............ End Do while ................*/
        
        			   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
        
        			   /*unset($_FILES);*/
        
        			   $this->notifications->notify('Result Uploaded Successfully','success');
        
        	    }/* End if */
    
    
    
        }/* End of if */
    
        
        $this->db->select('*');
		$this->db->from('products');
		$res = $this->db->get();
		$data['product_load'] = $res->result();    
    
        if(isset($data['result']['product_name']) && !empty($data['result']['product_name'])){
            $this->db->select('*');
    		$this->db->from('competition_level_byproduct');
    		$this->db->where('product_name',$data['product']);
    		$res = $this->db->get();
    		$data['level_load'] = $res->result();
		}
		
    	$this->load->view("upload_result_edit.php",$data);

    }/*END of function import()*/


    // ===============================================================================  //
    public function okkk()
    {

        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
        //echo 'ok';die;
        $start_cell_row = 1; /*skip first 2 heading rows */
        $i=500;
            if ($_FILES['csv']['size'] > 0) {

                //get the csv file 
                $file = $_FILES['csv']['tmp_name'];
                $handle = fopen($file, "r");
    
                // Read the first row before the loop
                $resultRow_from_csv = fgetcsv($handle, 1000, ",", "'");
    
                // loop through the csv file and insert into database 
                do {
                    if ($i >= $start_cell_row) {
                        if ($resultRow_from_csv[0]) 
                        {

                            $name = addslashes($resultRow_from_csv[0]);
                            $address = addslashes($resultRow_from_csv[1]);
                           // $code = addslashes($resultRow_from_csv[3]);
                            //echo $name.$address.$code;die;
                            // Use CodeIgniter's query builder to update
                            $this->db->set('school_code', $address);
                            $this->db->set('password', $address);
                            //$this->db->where('school_name', $name);
                            //$this->db->where('school_address', $address);
                            $this->db->where('id',$name);
                           // $this->db->where('id<', '221');
                            $this->db->update('school_new');
    
                            // Display the executed query (for testing)
                            //echo $this->db->last_query();
                            //die;
                        }
                    }
                } while ($resultRow_from_csv = fgetcsv($handle, 1000, ",", "'"));
            }
        }
        $this->load->view("upload_result_file.php", $data);
    }


    //  =======================================================================  //
    public function zoomzoom_result_upload()
    {
        if(isset($_POST['submit']) && $_POST['submit']=='Submit')

	    {  

        //print_r($_POST);die;
	   //  $data['period_id']            =  $search_period_id = $this->input->post('period');

	   //  $data['level_id'] =  $search_level_id = $this->input->post('level');

	   //  $data['product_id']           =  $search_service_id = $this->input->post('product');
	     
	     
         $period            =  $search_period_id = $this->input->post('period');
	     $level            =  $search_level_id = $this->input->post('level');
	     $product_name           =  $search_service_id = $this->input->post('product');
	     $category            =  $search_period_id = $this->input->post('categ');

		 $csvResult_upolad_logArray = array();

		 

				$start_cell_row=1;/*skip first 2 heading rows */

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

						$prid         =  addslashes($resultRow_from_csv[0]);
						$status         =  addslashes($resultRow_from_csv[1]);

						$grade           =  addslashes($resultRow_from_csv[2]);

						$marks            =  addslashes($resultRow_from_csv[3]);
						
						$rank            =  addslashes($resultRow_from_csv[4]);
                                    

						$csv_result_array  =  array('period'                => $period , 

						                               'level'              => $level ,

													   'product'            =>$product_name,

													   'prid'               =>$prid,

													   'status'             =>$status,

													   'grade'          => $grade,

													   'marks'           => $marks,

													   'rank'         => $rank,
													  
													 );



						//	echo "<pre>";print_r($csv_result_array);exit;					   

						 $csv_upload_status = $this->franchisemodel->save_csv_result_zoomzoom($csv_result_array);

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

        } 
     
     	$this->load->view("upload_zoomzoom_file.php",$data);
    }
 
 
    public function resultexport()
    {
     
        if(isset($_POST['submit'])){
        
            $data['result']=$_POST;
            $data['per']= $period            = $this->input->post('period');
    	    $data['lev']= $level             = $this->input->post('level');
    	    $data['pro']= $product_name      = $this->input->post('product');
    	    //print_r($product_name);die;
    	    $data['are']= $area            = $this->input->post('area_list');
    	    $data['sta']= $status            = $this->input->post('status');
    	    $data['stat']= $state            = $this->input->post('state');
    	    $data['cla']= $class            = $this->input->post('class');
    	    $data['sch']= $school            = $this->input->post('school_list');
    	    
    	    $data['sre']= $series            = $this->input->post('series');
    	    $data['sub']= $subject            = $this->input->post('subject');
    	    
    	    $data['ran']= $rank            = $this->input->post('rank');
    	    $data['per']= $performer            = $this->input->post('performer');
    	    $data['spe']= $speller           = $this->input->post('speller');
    	    
    	   // echo $rank.$performer.$speller.'ok';die;
    	   // print_r($_POST);die;
    	   
             $data['students']=$this->franchisemodel->export_result_all($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
             //print_r( $data['students']);die;
             
            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$this->input->post('state')))->row()->state_subdivision_name;
            if(empty($data['students'])){
            $data['message']='No student result found with selected parameters ...';}
             
             
        }
     
        if(isset($_POST['Export'])){
            $data['result']    = $_POST;
            $period            = $this->input->post('per');
    	    $level             = $this->input->post('lev');
    	    $product_name      = $this->input->post('pro');
    	    $state             = $this->input->post('stat');
    	    $status            = $this->input->post('sta');
    	    $class             = $this->input->post('cla'); 
    	    $school            = $this->input->post('sch'); 
    	    $area              = $this->input->post('are');
    	    $series            = $this->input->post('ser');
    	    $subject           = $this->input->post('sub');
    	    $rank              = $this->input->post('ran');
    	    $performer         = $this->input->post('per');
    	    $speller           = $this->input->post('spe');
    	    
    	    $data['per'] = $period            = $this->input->post('period');
    	    $data['lev'] = $level             = $this->input->post('level');
    	    $data['pro'] = $product_name      = $this->input->post('product');
    	    $data['are'] = $area              = $this->input->post('area_list');
    	    $data['sta'] = $status            = $this->input->post('status');
    	    $data['stat']= $state             = $this->input->post('state');
    	    $data['cla'] = $class             = $this->input->post('class');
    	    $data['sch'] = $school            = $this->input->post('school_list');
    	    $data['sre'] = $series            = $this->input->post('series');
    	    $data['sub'] = $subject           = $this->input->post('subject');
    	    $data['ran'] = $rank              = $this->input->post('rank');
    	    $data['per'] = $performer         = $this->input->post('performer');
    	    $data['spe'] = $speller           = $this->input->post('speller');
    	    
    	    
    	   // echo $rank.$performer.$speller;
    	   //print_r($_POST);
    	   // die;
            $students = $this->franchisemodel->export_result_all($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
            $n=1;
            //  print_r($students);die;
            
    		    $data=array(); 	   
                foreach ($students as $item) {
                    
                    
                    $level_by = $this->db->get_where('competition_level_byproduct',array('level_id'=>$item['clevel']))->row()->level_name;
            
                    if (!empty($item['competition_schedule_id'])) {
                        $competition_schedule = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $item['competition_schedule_id']))->row();
                        $item['competition_date'] = $competition_schedule->competition_date;
                        $item['venue'] = $competition_schedule->center_address;
                    } else {
                        $item['competition_date'] = $item['competition_date'];
                        $item['venue'] = empty($item['venue']) ? '' : $item['venue'];
                    }
                    
                    $school = $this->db->get_where('cin_list', array('cin' => $item['cin']))->row();
                        
                    if(!empty($school->school_name)){
                        $school_name = $school->school_name;
                    }else{
                        $school_name = $item['school_name'];
                    }
                    
                    
                    $category = $this->db->get_where('class_category_product', array('class' => $item['class'],'product_name' => $item['product_name']))->row();
                    $category=$category->category;
                    
                    $data[] = array(
                        $n,
                        $item['cin'],
                        $item['student_name'],
                        $school_name,
                        $item['class'],
                        $category,
                        $item['stud_phone'],
                        $item['stud_email'],
                        $item['status'],
                        $item['rank'],
                        $item['grade'],
                        $level_by,
                        $item['product_name'],
                        $item['marks'],
                        $item['performer'],
                        $item['speller'],
                        $item['competition_date'],
                        $item['venue'],
                        $item['show']
                    );
                    $n++;
                }
		
	            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$state))->row()->state_subdivision_name;
     
	            $file_name=$data['state_name'].'_'.$level_by.'_Result';
	            //echo $file_name;die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Category','Mobile','Email','Status','Rank','Grade','Level','Product name','Marks','Performer','Speller','Date','Venue','Show'));
                $cnt=1;
                
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                
        }
        
        $this->db->select('*');
		$this->db->from('countries');
		$res = $this->db->get();
		$data['country'] = $res->result_array();
        
    //  print_r($data['result']);
        if(isset($data['result']['state'])){
    		$this->db->select('*');
    		$this->db->from('areas');
    		$this->db->where('state_id',$data['result']['state']);
    		$res = $this->db->get();
    		$data['area_load'] = $res->result_array();
		}
        
       
        $this->db->select('*');
		$this->db->from('period');
		$this->db->where('period_id >','11');
		$res = $this->db->get();
		$data['period_load'] = $res->result_array();
		
        if(isset($data['result']['state'])){
        $this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id',$data['result']['state']);
		$res = $this->db->get();
		$data['state_load'] = $res->result_array();
        }
        
        if(isset($data['result']['state_id'])){
        $this->db->select('*');
		$this->db->from('franchise');
		$this->db->where('state_id',$data['result']['state_id']);
		$res = $this->db->get();
		$data['franchise_load'] = $res->result_array();
        }
        
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('status','Active');
		$res = $this->db->get();
		$data['product_load'] = $res->result_array();
		
		if(isset($data['result']['state'])){
            $this->db->select('*');
    		$this->db->from('school_new');
    		$this->db->where('school_status','Active');
    		$this->db->where('school_new.state',$data['result']['state']);
    		$this->db->where('school_new.area_code',$data['result']['area_list']);
    		$res = $this->db->get();
    		$data['school_load'] = $res->result_array();
		}
		
		if(isset($data['result']['product'])){
        $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		$this->db->where('product_name',$data['result']['product']);
		$res = $this->db->get();
		$data['level_load'] = $res->result_array();
		}
		
		$this->db->select('*');
		$this->db->from('class');
		$res = $this->db->get();
		$data['classload'] = $res->result_array();
     
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series'] = $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject'] = $res->result();
     
     
     
        $this->load->view("resultexport_all.php",$data);
    }


    public function resultcalculate()
    {
     
        if(isset($_POST['submit'])){
        
            $data['result']=$_POST;
            $data['per']= $period            = $this->input->post('period');
    	    $data['lev']= $level             = $this->input->post('level');
    	    $data['pro']= $product_name      = $this->input->post('product');
    	    //print_r($product_name);die;
    	    $data['are']= $area            = $this->input->post('area_list');
    	    $data['sta']= $status            = $this->input->post('status');
    	    $data['stat']= $state            = $this->input->post('state');
    	    $data['cla']= $class            = $this->input->post('class');
    	    $data['sch']= $school            = $this->input->post('school_list');
    	    
    	    $data['sre']= $series            = $this->input->post('series');
    	    $data['sub']= $subject            = $this->input->post('subject');
    	    
    	    $data['ran']= $rank            = $this->input->post('rank');
    	    $data['per']= $performer            = $this->input->post('performer');
    	    $data['spe']= $speller           = $this->input->post('speller');
    	    
    	   // echo $rank.$performer.$speller.'ok';die;
    	   // print_r($_POST);die;
    	   
             $data['students']=$this->franchisemodel->export_result_all($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
             //print_r( $data['students']);die;
             
            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$this->input->post('state')))->row()->state_subdivision_name;
            if(empty($data['students'])){
            $data['message']='No student result found with selected parameters ...';}
             
             
        }
     
        if(isset($_POST['Export'])){
            $data['result']    = $_POST;
            $period            = $this->input->post('per');
    	    $level             = $this->input->post('lev');
    	    $product_name      = $this->input->post('pro');
    	    $state             = $this->input->post('stat');
    	    $status            = $this->input->post('sta');
    	    $class             = $this->input->post('cla'); 
    	    $school            = $this->input->post('sch'); 
    	    $area              = $this->input->post('are');
    	    $series            = $this->input->post('ser');
    	    $subject           = $this->input->post('sub');
    	    $rank              = $this->input->post('ran');
    	    $performer         = $this->input->post('per');
    	    $speller           = $this->input->post('spe');
    	    
    	    $data['per'] = $period            = $this->input->post('period');
    	    $data['lev'] = $level             = $this->input->post('level');
    	    $data['pro'] = $product_name      = $this->input->post('product');
    	    $data['are'] = $area              = $this->input->post('area_list');
    	    $data['sta'] = $status            = $this->input->post('status');
    	    $data['stat']= $state             = $this->input->post('state');
    	    $data['cla'] = $class             = $this->input->post('class');
    	    $data['sch'] = $school            = $this->input->post('school_list');
    	    $data['sre'] = $series            = $this->input->post('series');
    	    $data['sub'] = $subject           = $this->input->post('subject');
    	    $data['ran'] = $rank              = $this->input->post('rank');
    	    $data['per'] = $performer         = $this->input->post('performer');
    	    $data['spe'] = $speller           = $this->input->post('speller');
    	    
    	    
    	   // echo $rank.$performer.$speller;
    	   //print_r($_POST);
    	   // die;
            $students = $this->franchisemodel->export_result_all($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
            $n=1;
            //  print_r($students);die;
            
    		    $data=array(); 	   
                foreach ($students as $item) {
                    
                    
                    $level_by = $this->db->get_where('competition_level_byproduct',array('level_id'=>$item['clevel']))->row()->level_name;
            
                    if (!empty($item['competition_schedule_id'])) {
                        $competition_schedule = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $item['competition_schedule_id']))->row();
                        $item['competition_date'] = $competition_schedule->competition_date;
                        $item['venue'] = $competition_schedule->center_address;
                    } else {
                        $item['competition_date'] = $item['competition_date'];
                        $item['venue'] = empty($item['venue']) ? '' : $item['venue'];
                    }
                    
                    $school = $this->db->get_where('cin_list', array('cin' => $item['cin']))->row();
                        
                    if(!empty($school->school_name)){
                        $school_name = $school->school_name;
                    }else{
                        $school_name = $item['school_name'];
                    }
                    
                    
                    $category = $this->db->get_where('class_category_product', array('class' => $item['class'],'product_name' => $item['product_name']))->row();
                    $category=$category->category;
                    
                    $data[] = array(
                        $n,
                        $item['cin'],
                        $item['student_name'],
                        $school_name,
                        $item['class'],
                        $category,
                        $item['stud_phone'],
                        $item['stud_email'],
                        $item['status'],
                        $item['rank'],
                        $item['grade'],
                        $level_by,
                        $item['product_name'],
                        $item['marks'],
                        $item['performer'],
                        $item['speller'],
                        $item['competition_date'],
                        $item['venue'],
                        $item['show']
                    );
                    $n++;
                }
		
	            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$state))->row()->state_subdivision_name;
     
	            $file_name=$data['state_name'].'_'.$level_by.'_Result';
	            //echo $file_name;die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Category','Mobile','Email','Status','Rank','Grade','Level','Product name','Marks','Performer','Speller','Date','Venue','Show'));
                $cnt=1;
                
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                
        }
        
        
    //  print_r($data['result']);
        if(isset($data['result']['state'])){
    		$this->db->select('*');
    		$this->db->from('areas');
    		$this->db->where('state_id',$data['result']['state']);
    		$res = $this->db->get();
    		$data['area_load'] = $res->result_array();
		}
        
       
        $this->db->select('*');
		$this->db->from('period');
		$this->db->where('period_id >','11');
		$res = $this->db->get();
		$data['period_load'] = $res->result_array();
       
        $this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id','105');
		$res = $this->db->get();
		$data['state_load'] = $res->result_array();
       
        $this->db->select('*');
		$this->db->from('franchise');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$res = $this->db->get();
		$data['franchise_load'] = $res->result_array();
		
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('status','Active');
		$res = $this->db->get();
		$data['product_load'] = $res->result_array();
		if(isset($data['result']['state'])){
            $this->db->select('*');
    		$this->db->from('school_new');
    		$this->db->where('school_status','Active');
    		$this->db->where('school_new.state',$data['result']['state']);
    		$this->db->where('school_new.area_code',$data['result']['area_list']);
    		$res = $this->db->get();
    		$data['school_load'] = $res->result_array();
		}
		
		if(isset($data['result']['product'])){
        $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		$this->db->where('product_name',$data['result']['product']);
		$res = $this->db->get();
		$data['level_load'] = $res->result_array();
		}
		
		$this->db->select('*');
		$this->db->from('class');
		$res = $this->db->get();
		$data['classload'] = $res->result_array();
     
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series'] = $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject'] = $res->result();
     
     
     
        $this->load->view("resultcalculate.php",$data);
    }


    public function resultexport_primary()
    {
     
        if(isset($_POST['submit'])){
        
            $data['result']=$_POST;
            $data['per']= $period            = $this->input->post('period');
    	    $data['lev']= $level             = $this->input->post('level');
    	    $data['pro']= $product_name      = $this->input->post('product');
    	    //print_r($product_name);die;
    	    $data['are']= $area            = $this->input->post('area_list');
    	    $data['sta']= $status            = $this->input->post('status');
    	    $data['stat']= $state            = $this->input->post('state');
    	    $data['cla']= $class            = $this->input->post('class');
    	    $data['sch']= $school            = $this->input->post('school_list');
    	    
    	    $data['sre']= $series            = $this->input->post('series');
    	    $data['sub']= $subject            = $this->input->post('subject');
    	    
    	    $data['ran']= $rank            = $this->input->post('rank');
    	    $data['per']= $performer            = $this->input->post('performer');
    	    $data['spe']= $speller           = $this->input->post('speller');
    	    
    	   // echo $rank.$performer.$speller.'ok';die;
    	   // print_r($_POST);die;
    	   
             $data['students']=$this->franchisemodel->export_result_primary($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
             //print_r( $data['students']);die;
             
            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$this->input->post('state')))->row()->state_subdivision_name;
            if(empty($data['students'])){
            $data['message']='No student result found with selected parameters ...';}
             
             
        }
     
        if(isset($_POST['Export'])){
            $data['result']    = $_POST;
            $period            = $this->input->post('per');
    	    $level             = $this->input->post('lev');
    	    $product_name      = $this->input->post('pro');
    	    $state             = $this->input->post('stat');
    	    $status            = $this->input->post('sta');
    	    $class             = $this->input->post('cla'); 
    	    $school            = $this->input->post('sch'); 
    	    $area              = $this->input->post('are');
    	    $series            = $this->input->post('ser');
    	    $subject           = $this->input->post('sub');
    	    $rank              = $this->input->post('ran');
    	    $performer         = $this->input->post('per');
    	    $speller           = $this->input->post('spe');
    	    
    	    $data['per'] = $period            = $this->input->post('period');
    	    $data['lev'] = $level             = $this->input->post('level');
    	    $data['pro'] = $product_name      = $this->input->post('product');
    	    $data['are'] = $area              = $this->input->post('area_list');
    	    $data['sta'] = $status            = $this->input->post('status');
    	    $data['stat']= $state             = $this->input->post('state');
    	    $data['cla'] = $class             = $this->input->post('class');
    	    $data['sch'] = $school            = $this->input->post('school_list');
    	    $data['sre'] = $series            = $this->input->post('series');
    	    $data['sub'] = $subject           = $this->input->post('subject');
    	    $data['ran'] = $rank              = $this->input->post('rank');
    	    $data['per'] = $performer         = $this->input->post('performer');
    	    $data['spe'] = $speller           = $this->input->post('speller');
    	    
    	    
    	   // echo $rank.$performer.$speller;
    	   //print_r($_POST); 
    	   // die;
            $students = $this->franchisemodel->export_result_primary($period,$level,$product_name,$status,$class,$state,$school,$area,$series,$subject,$rank,$performer,$speller);
            $n=1;
            //  print_r($students);die;
            
    		    $data=array(); 	   
                foreach ($students as $item) {
                    
                    
                    $level_by = $this->db->get_where('competition_level_byproduct',array('level_id'=>$item['clevel']))->row()->level_name;
            
                    if (!empty($item['competition_schedule_id'])) {
                        $competition_schedule = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $item['competition_schedule_id']))->row();
                        $item['competition_date'] = $competition_schedule->competition_date;
                        $item['venue'] = $competition_schedule->center_address;
                    } else {
                        $item['competition_date'] = $item['competition_date'];
                        $item['venue'] = empty($item['venue']) ? '' : $item['venue'];
                    }
                    
                    $school = $this->db->get_where('cin_list', array('cin' => $item['cin']))->row();
                        
                    if(!empty($school->school_name)){
                        $school_name = $school->school_name;
                    }else{
                        $school_name = $item['school_name'];
                    }
                    
                    
                    $category = $this->db->get_where('class_category_product', array('class' => $item['class'],'product_name' => $item['product_name']))->row();
                    $category=$category->category;
                    
                    $data[] = array(
                        $n,
                        $item['cin'],
                        $item['student_name'],
                        $school_name,
                        $item['class'],
                        $category,
                        $item['stud_phone'],
                        $item['stud_email'],
                        $item['status'],
                        $item['rank'],
                        $item['grade'],
                        $level_by,
                        $item['product_name'],
                        $item['marks'],
                        $item['performer'],
                        $item['speller'],
                        $item['competition_date'],
                        $item['venue'],
                        $item['show']
                    );
                    $n++;
                }
		
	            $data['state_name']=$state_name=$this->db->get_where('states',array('state_subdivision_id'=>$state))->row()->state_subdivision_name;
     
	            $file_name=$data['state_name'].'_'.$level_by.'_Result';
	            //echo $file_name;die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Category','Mobile','Email','Status','Rank','Grade','Level','Product name','Marks','Performer','Speller','Date','Venue','Show'));
                $cnt=1;
                
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                
        }
        
        
    //  print_r($data['result']);
        if(isset($data['result']['state'])){
    		$this->db->select('*');
    		$this->db->from('areas');
    		$this->db->where('state_id',$data['result']['state']);
    		$res = $this->db->get();
    		$data['area_load'] = $res->result_array();
		}
        
       
        $this->db->select('*');
		$this->db->from('period');
		$this->db->where('period_id >','11');
		$res = $this->db->get();
		$data['period_load'] = $res->result_array();
       
        $this->db->select('*');
		$this->db->from('states');
		$this->db->where('country_id','105');
		$res = $this->db->get();
		$data['state_load'] = $res->result_array();
       
        $this->db->select('*');
		$this->db->from('franchise');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$res = $this->db->get();
		$data['franchise_load'] = $res->result_array();
		
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('status','Active');
		$res = $this->db->get();
		$data['product_load'] = $res->result_array();
		if(isset($data['result']['state'])){
            $this->db->select('*');
    		$this->db->from('school_new');
    		$this->db->where('school_status','Active');
    		$this->db->where('school_new.state',$data['result']['state']);
    		$this->db->where('school_new.area_code',$data['result']['area_list']);
    		$res = $this->db->get();
    		$data['school_load'] = $res->result_array();
		}
		
		if(isset($data['result']['product'])){
        $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		$this->db->where('product_name',$data['result']['product']);
		$res = $this->db->get();
		$data['level_load'] = $res->result_array();
		}
		
		$this->db->select('*');
		$this->db->from('class');
		$res = $this->db->get();
		$data['classload'] = $res->result_array();
     
        $this->db->select('series');
		$this->db->from('cin_list');
		$this->db->where('series !=','');
		$this->db->group_by('series');
		$res = $this->db->get();
		$data['series'] = $res->result();
		
		
		$this->db->select('subject');
		$this->db->from('cin_list');
		$this->db->where('subject !=','');
		$this->db->group_by('subject');
		$res = $this->db->get();
		$data['subject'] = $res->result();
     
     
     
        $this->load->view("resultexport_all.php",$data);
    }
    
    
    public function zoomzoomresult_export()
    {
     
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            $data['per']= $period            = $this->input->post('period');
	        $data['lev']= $level             = $this->input->post('level');
	        $data['pro']= $product_name      = $this->input->post('product');
	        $data['cat']= $category          = $this->input->post('categ');
	        $data['sta']= $status            = $this->input->post('status');
	        $data['cla']= $class            = $this->input->post('class');
	     
            $data['students']=$this->franchisemodel->export_result_zoomzoom($period,$level,$product_name,$category,$status,$class);
        }
     
        if(isset($_POST['Export'])){
         
            $period            = $this->input->post('per');
	        $level             = $this->input->post('lev');
	        $product_name      = $this->input->post('pro');
	        $category          = $this->input->post('cat');
	        $status            = $this->input->post('sta');
	        $class             = $this->input->post('cla'); 
	     
            $students=$this->franchisemodel->export_result_zoomzoom($period,$level,$product_name,$category,$status,$class);
            
            foreach($students as $item)
		    {
		      //print_r($item);die;
		     
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no']+1,
        			   $item['prid'] ,
        			   $item['cin'] ,
        			   $item['first_name'].' '.$item['middle_name'].' '.$item['last_name'],
        			   $item['school_name'],
        			   $item['class']  ,
        			   $item['status'],
        			   $item['rank'],
        			   $item['grade'] ,
        			   $item['level_key'],
        			   $item['product_name']
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"zoomzoom_result".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','CIN','Student Name','School','Class','Status','Rank','Grade','Level','Product name'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
     }
     
    	$this->load->view("export_zoomzoom_file.php",$data);
 }

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
    }
    
   
    public function studymat_edit()
    {
		 $id = $this->uri->segment(4);
		 $data['list_materials'] = $this->franchisemodel->list_materialsedit($id);
         //print_r($data['list_materials']);exit;
        if(isset($_POST['submit'])){
			 
			 $update_data=array(
            								'title'      => $this->input->post('title'),
            								'period'     => $this->input->post('period'),
            								'clevel'  => $this->input->post('clevel'),
            								'class'   => $this->input->post('class'),
            								'status'   => $this->input->post('status'),
            								'price'   => $this->input->post('price'),
            								'type'   => $this->input->post('type'),
            								'product_name' => $this->input->post('product_id')
            							   );
										   
				$this->db->where('id',$id);
                $this->db->update('study_material',$update_data);
                $this->session->set_flashdata('updated','Record Successfully Updated');
                redirect('manage/franchise/search_material');				
				//print_r($update_data);exit;     
		}			
         $this->load ->view('studymat_edit',$data); 
	}
	
	
	public function admin_revenue_setting()
	{
	    
	    if(isset($_POST['submit'])){
	        //print_r($_POST);die;
	        $res=$this->db->get_where('revenue_setting',array('period_id'=>$_POST['period'],'clevel'=>$_POST['clevel'],'product_id'=>$_POST['product_id']))->row();
	         //print_r($res);die;
	        $product=$this->db->get_where('products',array('product_id'=>$_POST['product_id']))->row();
	        
	        
	        if(empty($res)){
	            $ar=array(
	                'period_id'              =>  $_POST['period'],
	                'product_name'           =>  $product->product_name,
	                'product_id'             =>  $_POST['product_id'],
	                'clevel'                 =>  $_POST['clevel'],
	                'manageper'              =>  $_POST['manageper'],
	                'com_peravian'           =>  $_POST['com_peravian'],
	                'associate_per'          =>  $_POST['associate_per'],
	                'crm_fix'                =>  $_POST['crm_fix'] ?? '',
	                'it_fix'                 =>  $_POST['it_fix'] ?? 0,
	                'crm_per'                =>  $_POST['crm_per'] ?? 6,
	                
	                'study_material_a_price_royalty' =>  $_POST['study_material_a_price_royalty'],
	                'study_material_b_price_royalty' =>  $_POST['study_material_b_price_royalty'],
	                'study_material_c_price_royalty' =>  $_POST['study_material_c_price_royalty'],
	                'study_material_d_price_royalty' =>  $_POST['study_material_d_price_royalty'],
	                'study_material_e_price_royalty' =>  $_POST['study_material_e_price_royalty'],
	                'study_material_f_price_royalty' =>  $_POST['study_material_f_price_royalty'],
	                
	                'study_material_a_price' =>  $_POST['study_material_a_price'],
	                'study_material_b_price' =>  $_POST['study_material_b_price'],
	                'study_material_c_price' =>  $_POST['study_material_c_price'],
	                'study_material_d_price' =>  $_POST['study_material_d_price'],
	                'study_material_e_price' =>  $_POST['study_material_e_price'],
	                'study_material_f_price' =>  $_POST['study_material_f_price'],
	                
	                'mock_test_a_price_royalty'      =>  $_POST['mock_test_a_price_royalty'],
	                'mock_test_b_price_royalty'      =>  $_POST['mock_test_b_price_royalty'],
	                'mock_test_c_price_royalty'      =>  $_POST['mock_test_c_price_royalty'],
	                'mock_test_d_price_royalty'      =>  $_POST['mock_test_d_price_royalty'],
	                'mock_test_e_price_royalty'      =>  $_POST['mock_test_e_price_royalty'],
	                'mock_test_f_price_royalty'      =>  $_POST['mock_test_f_price_royalty'],
	                
	                'mock_test_a_price'      =>  $_POST['mock_test_a_price'],
	                'mock_test_b_price'      =>  $_POST['mock_test_b_price'],
	                'mock_test_c_price'      =>  $_POST['mock_test_c_price'],
	                'mock_test_d_price'      =>  $_POST['mock_test_d_price'],
	                'mock_test_e_price'      =>  $_POST['mock_test_e_price'],
	                'mock_test_f_price'      =>  $_POST['mock_test_f_price'],
	                
	                'orientation_a_price'    =>  $_POST['orientation_a_price'],
	                'orientation_b_price'    =>  $_POST['orientation_b_price'],
	                'orientation_c_price'    =>  $_POST['orientation_c_price'],
	                'orientation_d_price'    =>  $_POST['orientation_d_price'],
	                'orientation_e_price'    =>  $_POST['orientation_e_price'],
	                'orientation_f_price'    =>  $_POST['orientation_f_price'],
	                
	                'bundle_price_a'    =>  $_POST['bundle_price_a'],
	                'bundle_price_b'    =>  $_POST['bundle_price_b'],
	                'bundle_price_c'    =>  $_POST['bundle_price_c'],
	                'bundle_price_d'    =>  $_POST['bundle_price_d'],
	                'bundle_price_e'    =>  $_POST['bundle_price_e'],
	                'bundle_price_f'    =>  $_POST['bundle_price_f'],
	                
	                'bundle_price_a_royality'    =>  $_POST['bundle_price_a_royality'],
	                'bundle_price_b_royality'    =>  $_POST['bundle_price_b_royality'],
	                'bundle_price_c_royality'    =>  $_POST['bundle_price_c_royality'],
	                'bundle_price_d_royality'    =>  $_POST['bundle_price_d_royality'],
	                'bundle_price_e_royality'    =>  $_POST['bundle_price_e_royality'],
	                'bundle_price_f_royality'    =>  $_POST['bundle_price_f_royality'],
	                
	                'product_price'          =>  $_POST['product_price'],
	                'com_per'                =>  $_POST['com_per'],
	                'rank_count'             => $_POST['rank_count'],
	                'study_material_free_royalty'=>$_POST['study_material_free_royalty']
	            );
	            
	            $this->db->insert('revenue_setting',$ar);
	            $data['message'] ='Assignment Added Successfully.';
	            
	        }else{
	            $data['message'] ='Assignment Already Done For Product Level Period.';
	        }
	        
	        $data['list_materials'] = $this->db
                    ->limit(10)
                    ->order_by('id', 'DESC')
                    ->get_where('revenue_setting', [])
                    ->result_array();
                    
	        $data['result']=$_POST;
	    }
	    
	    
	    if(isset($_POST['delete'])){
	            $res=$this->db
                    ->get_where('revenue_setting', ['id'=> $_POST['delete']] )
                    ->row();
            if($res){
                $this->db->where('id',$_POST['delete']);
                $this->db->delete('revenue_setting');
                $data['message1'] ='Entry Deleted Successfully.';
            }        
	        else{
	            $data['message1'] ='Internal Server Error.';
	        }
	    }
	    
	    $data['list_materials'] = $this->db
                    ->limit(10)
                    ->order_by('id', 'DESC')
                    ->get_where('revenue_setting', [])
                    ->result_array();
	    $product_name='';
	    if(isset($_POST['search'])){
	        $product_id=$_POST['product_id'];
	        $exists = $this->db->get_where('products', [
                        'product_id' => $product_id
                    ])->row();
            $product_name = $exists->product_name;
            
            $this->db->select('*');
    		$this->db->from('competition_level_byproduct');
    		$this->db->where('product_name',$product_name);
    		$this->db->where('level_id',$_POST['clevel']);
    		$res = $this->db->get();
    		$complevel = $res->row();
            
            $period = $this->db
                    ->get_where('period', ['period_id'=> $_POST['period']] )
                    ->row();
                    
            $data['ress'] = $_POST;
            // echo $product_name;
	       // print_r($_POST);die;
	        $data['list_materials'] = $this->db
                    ->limit(10)
                    ->order_by('id', 'DESC')
                    ->get_where('revenue_setting', [
                        'period_id'=>$_POST['period'],
                        'clevel'=>$_POST['clevel'],
                        'product_name'=>$product_name
                        ])
                    ->result_array();
                    
            if(empty($data['list_materials'])){
                $data['mess'] = 'Revenue Setting not found for Product : '.$product_name.' Completition Level : '.$complevel->level_name.' Period : '.$period->academic_year;
            }elseif(!empty($data['list_materials'])){
                $data['mess'] = 'Revenue Setting for Product : '.$product_name.' Completition Level : '.$complevel->level_name.' Period : '.$period->academic_year;
            }
	    }
	    
	    
	    
	    
	    
        if(isset($product_name) && !empty($product_name)){
            $this->db->select('*');
    		$this->db->from('competition_level_byproduct');
    		$this->db->where('product_name',$product_name);
    		$res = $this->db->get();
    		$data['level_load'] = $res->result();
		}
       
        $this->load->view("admin_revenue_setting.php",$data); 
   }
   

	public function admin_revenue_setting_edit()
	{
	    $id= $this->uri->segment(4);
	   
	    if(isset($_POST['submit'])){
	       // print_r($_POST);die;
	        $res=$this->db->get_where('revenue_setting',array('period_id'=>$_POST['period'],'clevel'=>$_POST['clevel'],'product_id'=>$_POST['product_id']))->row();
	        
	        $product=$this->db->get_where('products',array('product_id'=>$_POST['product_id']))->row();
	        
	        
	            $ar=array(
	                'period_id'              =>  $_POST['period'],
	                'product_name'           =>  $product->product_name,
	                'product_id'             =>  $_POST['product_id'],
	                'clevel'                 =>  $_POST['clevel'],
	                'manageper'              =>  $_POST['manageper'],
	                'com_peravian'           =>  $_POST['com_peravian'],
	                'associate_per'          =>  $_POST['associate_per'],
	                'crm_fix'                =>  $_POST['crm_fix'] ?? '',
	                'crm_per'                =>  $_POST['crm_per'] ?? 6,
	                'it_fix'                 =>  $_POST['it_fix'] ?? 0,
	                'study_material_a_price_royalty' =>  $_POST['study_material_a_price_royalty'],
	                'study_material_b_price_royalty' =>  $_POST['study_material_b_price_royalty'],
	                'study_material_c_price_royalty' =>  $_POST['study_material_c_price_royalty'],
	                'study_material_d_price_royalty' =>  $_POST['study_material_d_price_royalty'],
	                'study_material_e_price_royalty' =>  $_POST['study_material_e_price_royalty'],
	                'study_material_f_price_royalty' =>  $_POST['study_material_f_price_royalty'],
	                
	                'study_material_a_price' =>  $_POST['study_material_a_price'],
	                'study_material_b_price' =>  $_POST['study_material_b_price'],
	                'study_material_c_price' =>  $_POST['study_material_c_price'],
	                'study_material_d_price' =>  $_POST['study_material_d_price'],
	                'study_material_e_price' =>  $_POST['study_material_e_price'],
	                'study_material_f_price' =>  $_POST['study_material_f_price'],
	                
	                'mock_test_a_price_royalty'      =>  $_POST['mock_test_a_price_royalty'],
	                'mock_test_b_price_royalty'      =>  $_POST['mock_test_b_price_royalty'],
	                'mock_test_c_price_royalty'      =>  $_POST['mock_test_c_price_royalty'],
	                'mock_test_d_price_royalty'      =>  $_POST['mock_test_d_price_royalty'],
	                'mock_test_e_price_royalty'      =>  $_POST['mock_test_e_price_royalty'],
	                'mock_test_f_price_royalty'      =>  $_POST['mock_test_f_price_royalty'],
	                
	                'mock_test_a_price'      =>  $_POST['mock_test_a_price'],
	                'mock_test_b_price'      =>  $_POST['mock_test_b_price'],
	                'mock_test_c_price'      =>  $_POST['mock_test_c_price'],
	                'mock_test_d_price'      =>  $_POST['mock_test_d_price'],
	                'mock_test_e_price'      =>  $_POST['mock_test_e_price'],
	                'mock_test_f_price'      =>  $_POST['mock_test_f_price'],
	                
	                'orientation_a_price'    =>  $_POST['orientation_a_price'],
	                'orientation_b_price'    =>  $_POST['orientation_b_price'],
	                'orientation_c_price'    =>  $_POST['orientation_c_price'],
	                'orientation_d_price'    =>  $_POST['orientation_d_price'],
	                'orientation_e_price'    =>  $_POST['orientation_e_price'],
	                'orientation_f_price'    =>  $_POST['orientation_f_price'],
	                
	                // --- ADDED: these were present on the add page/controller but missing here ---
	                'bundle_price_a'    =>  $_POST['bundle_price_a'],
	                'bundle_price_b'    =>  $_POST['bundle_price_b'],
	                'bundle_price_c'    =>  $_POST['bundle_price_c'],
	                'bundle_price_d'    =>  $_POST['bundle_price_d'],
	                'bundle_price_e'    =>  $_POST['bundle_price_e'],
	                'bundle_price_f'    =>  $_POST['bundle_price_f'],
	                
	                'bundle_price_a_royality'    =>  $_POST['bundle_price_a_royality'],
	                'bundle_price_b_royality'    =>  $_POST['bundle_price_b_royality'],
	                'bundle_price_c_royality'    =>  $_POST['bundle_price_c_royality'],
	                'bundle_price_d_royality'    =>  $_POST['bundle_price_d_royality'],
	                'bundle_price_e_royality'    =>  $_POST['bundle_price_e_royality'],
	                'bundle_price_f_royality'    =>  $_POST['bundle_price_f_royality'],
	                // --- END ADDED ---
	                
	                'product_price'          =>  $_POST['product_price'],
	                'com_per'                =>  $_POST['com_per'],
	                'study_material_free_royalty'=>$_POST['study_material_free_royalty'],
	                'rank_count'             => $_POST['rank_count'],
	            );
	            
	            $this->db->where('id',$id);
	            $this->db->update('revenue_setting',$ar);
	            $data['message'] ='Assignment Updated Successfully.';
	            
	         
	        
	    }
	    
	    
	    if(isset($_POST['back'])){
	        redirect('manage/franchise/admin_revenue_setting');
	    }
	    
	    $data['result'] = $this->db
                    ->get_where('revenue_setting', ['id'=>$id])
                    ->row_array();
	    
	    $this->load->view("admin_revenue_setting_edit.php",$data); 
	}
	
	
	public function admin_revenue_setting_filter()
	{
	    
	    if(isset($_POST['submit'])){
	       // print_r($_POST);die;
	        $res=$this->db->get_where('revenue_setting',array('period_id'=>$_POST['period'],'clevel'=>$_POST['clevel'],'product_id'=>$_POST['product_id']))->row();
	        
	        $product=$this->db->get_where('products',array('product_id'=>$_POST['product_id']))->row();
	        
	        
	        if(empty($res)){
	            $ar=array(
	                'period_id'              =>  $_POST['period'],
	                'product_name'           =>  $product->product_name,
	                'product_id'             =>  $_POST['product_id'],
	                'clevel'                 =>  $_POST['clevel'],
	                'manageper'              =>  $_POST['manageper'],
	                'com_peravian'           =>  $_POST['com_peravian'],
	                'associate_per'          =>  $_POST['associate_per'],
	                'crm_fix'                =>  $_POST['crm_fix'],
	                
	                'study_material_a_price_royalty' =>  $_POST['study_material_a_price_royalty'],
	                'study_material_b_price_royalty' =>  $_POST['study_material_b_price_royalty'],
	                'study_material_c_price_royalty' =>  $_POST['study_material_c_price_royalty'],
	                'study_material_d_price_royalty' =>  $_POST['study_material_d_price_royalty'],
	                'study_material_e_price_royalty' =>  $_POST['study_material_e_price_royalty'],
	                'study_material_f_price_royalty' =>  $_POST['study_material_f_price_royalty'],
	                
	                'study_material_a_price' =>  $_POST['study_material_a_price'],
	                'study_material_b_price' =>  $_POST['study_material_b_price'],
	                'study_material_c_price' =>  $_POST['study_material_c_price'],
	                'study_material_d_price' =>  $_POST['study_material_d_price'],
	                'study_material_e_price' =>  $_POST['study_material_e_price'],
	                'study_material_f_price' =>  $_POST['study_material_f_price'],
	                
	                'mock_test_a_price_royalty'      =>  $_POST['mock_test_a_price_royalty'],
	                'mock_test_b_price_royalty'      =>  $_POST['mock_test_b_price_royalty'],
	                'mock_test_c_price_royalty'      =>  $_POST['mock_test_c_price_royalty'],
	                'mock_test_d_price_royalty'      =>  $_POST['mock_test_d_price_royalty'],
	                'mock_test_e_price_royalty'      =>  $_POST['mock_test_e_price_royalty'],
	                'mock_test_f_price_royalty'      =>  $_POST['mock_test_f_price_royalty'],
	                
	                'mock_test_a_price'      =>  $_POST['mock_test_a_price'],
	                'mock_test_b_price'      =>  $_POST['mock_test_b_price'],
	                'mock_test_c_price'      =>  $_POST['mock_test_c_price'],
	                'mock_test_d_price'      =>  $_POST['mock_test_d_price'],
	                'mock_test_e_price'      =>  $_POST['mock_test_e_price'],
	                'mock_test_f_price'      =>  $_POST['mock_test_f_price'],
	                
	                'orientation_a_price'    =>  $_POST['orientation_a_price'],
	                'orientation_b_price'    =>  $_POST['orientation_b_price'],
	                'orientation_c_price'    =>  $_POST['orientation_c_price'],
	                'orientation_d_price'    =>  $_POST['orientation_d_price'],
	                'orientation_e_price'    =>  $_POST['orientation_e_price'],
	                'orientation_f_price'    =>  $_POST['orientation_f_price'],
	                
	                'product_price'          =>  $_POST['product_price'],
	                'com_per'                =>  $_POST['com_per'],
	                'rank_count'             => $_POST['rank_count'],
	                'study_material_free_royalty'=>$_POST['study_material_free_royalty']
	            );
	            
	            $this->db->insert('revenue_setting',$ar);
	            $data['message'] ='Assignment Added Successfully.';
	            
	        }else{
	            $data['message'] ='Assignment Already Done For Product Level Period.';
	        }
	        
	        $data['list_materials'] = $this->db
                    ->limit(10)
                    ->order_by('id', 'DESC')
                    ->get_where('revenue_setting', [])
                    ->result_array();
                    
	        $data['result']=$_POST;
	    }
	    
	    
	    if(isset($_POST['delete'])){
	            $res=$this->db
                    ->get_where('revenue_setting', ['id'=> $_POST['delete']] )
                    ->row();
            if($res){
                $this->db->where('id',$_POST['delete']);
                $this->db->delete('revenue_setting');
                $data['message1'] ='Entry Deleted Successfully.';
            }        
	        else{
	            $data['message1'] ='Internal Server Error.';
	        }
	    }
	    
	    
	    
	    $data['list_materials'] = $this->db
                    ->limit(10)
                    ->order_by('id', 'DESC')
                    ->get_where('revenue_setting', [])
                    ->result_array();
	   
	    
	    $this->load->view("admin_revenue_setting_filter.php",$data); 
	}
	
	
    public function study_material_2021()
    {
        
        if(isset($_POST['ok'])){
                 $file = $_FILES['folder']['name'];
                 $product_id   = $this->input->post('product_id');
            	 $this->db->select('*');
        		 $this->db->from('products');
        		 $this->db->where('product_id',$product_id);
        		 $query = $this->db->get(); 
        		 //echo $this->db->last_query();
        	     $quer = $query->result_array();	
        	     $product_name=$quer[0]['product_name'];
        	     
        	     
        	     
        	    $target_path ="../study_material_free/";
				   
               if ($_FILES['folder']['name'])
            	{
    		
    			$file_name2     = $_FILES["folder"]["name"];
    			$file_size2     = $_FILES["folder"]["size"];
    			$file_type2     = $_FILES["folder"]["type"];
    			$file_tmp_name2 = $_FILES["folder"]["tmp_name"];
    		
    			$new_file_name2 = $file_name2;
    		
                $upload_path_file2   = $target_path . $new_file_name2;
    
                //print_r($_FILES);
    			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
    			{ 
    				$question_file_path = addslashes($target_path . $new_file_name2);
    			}
    			
    			else 
    			{ 
    			   $this->notifications->notify('files cannot upload', 'error');  }/*end else var_dump($this->validation->show_errors());*/
    			
    	     	}
        	     
        	    
        	     
           	     $insert_data=array(
							'title'      => $this->input->post('title'),
							'period'     => $this->input->post('period'),
							'clevel'  => $this->input->post('clevel'),
							'class'   => $this->input->post('class'),
							'folder' => $question_file_path,
							'status'   => $this->input->post('status'),
							'price'   => $this->input->post('price'),
							'product_id'   => $this->input->post('product_id'),
							'product_name'   => $product_name
            			 );
            							   
            	
                
              //  print_r( $insert_data);exit;
                
        }
       
       
        if(isset($_POST['submit'])){
           
            // print_r($_POST);die;
             
             	
               // $target_dir ="../study_material/";
                //$uploadpath = $_SERVER[DOCUMENT_ROOT'].'/folderame';
                if($this->input->post('status')=='Free-A' or $this->input->post('status')=='Free-B' or $this->input->post('status')=='Free-C')
                {
                    $target_path ="../study_material_free/";
                }else{
                    $target_path ="../study_material_paid/";
                    
                }
                
                   	    
				   
               if ($_FILES['folder']['name'])
            	{
    		
    			$file_name2     = $_FILES["folder"]["name"];
    			$file_size2     = $_FILES["folder"]["size"];
    			$file_type2     = $_FILES["folder"]["type"];
    			$file_tmp_name2 = $_FILES["folder"]["tmp_name"];
    		
    			$new_file_name2 = $file_name2;
    		
                $upload_path_file2   = $target_path . $new_file_name2;
    
               // print_r($target_path);die;
    			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
    			{ 
    				$question_file_path = addslashes($target_path . $new_file_name2);
    			}
    			
    			else 
    			{ 
    			   $this->notifications->notify('files cannot upload', 'error');  }/*end else var_dump($this->validation->show_errors());*/
    			
    	     	}
            		
            		
            	 $type=	substr($this->input->post('status'), -1);
            	 $product_id   = $this->input->post('product_id');
            	 $this->db->select('*');
        		 $this->db->from('products');
        		 $this->db->where('product_id',$product_id);
        		 $query = $this->db->get(); 
        		 //echo $this->db->last_query();
        	     $quer = $query->result_array();	
        	     $product_name=$quer[0]['product_name'];
            	 //echo $type;die;
            	
            	$class=$_POST['class'];  
            	    foreach($class as $row){
            			$insert_data=array(
            								'title'      => $this->input->post('title'),
            								'period'     => $this->input->post('period'),
            								'clevel'  => $this->input->post('clevel'),
            								'class'   => $row,
            								'folder' => $new_file_name2,
            								'status'   => $this->input->post('status'),
            								// 'price'   => $this->input->post('price'),
            								'product_id'   => $this->input->post('product_id'),
            								'product_name'   => $product_name,
            								'type'=>$type,
            								'material_maker_id'=>$_POST['material_maker_id'],
            								// 'maker_price'=>$_POST['maker_price'],
            								'subject'=>$_POST['subject'],
            								'varient'=>$_POST['varient'],
            								'series'=>$_POST['series'] ?? '',
            								
            							   );
            							   
            	           // echo "<pre>";print_r($insert_data);exit;
            	            
            			$insert_status = $this->franchisemodel->insert_materials($insert_data);
                    }	
            				if($insert_status=="yes")
            				{
            					 $this->session->set_flashdata('success','Save Study materials successfully ...');
            					 $data['message']='Save Study materials successfully ...';
            				}
            				
            				if($insert_status=="no")
            				{
            					$this->session->set_flashdata('success','Duplicate or error in upload try again ...');
            					$data['message']='Duplicate or error in upload try again ...';
            				}
            			
            					
            
            	//	   echo $this->session->flashdata('success');die;
            
            	
                    
            
        }
        
         $data['list_materials'] = $this->franchisemodel->list_materials($insert_data);
       
       
       
        $data['subjects']=$this->db->get_where('lunar_subjects',array('status'=>'Active'))->result();
       
        $this->load->view("study_material_2021.php",$data); 
   }
   
   
    public function search_material()
    {
       if(isset($_POST['search'])){
        //   print_r($_POST);die;
            $product=$_POST['product_id'];
            $period=$_POST['period'];
            $clevel=$_POST['clevel'];
            $class=$_POST['class'];
            $type=$_POST['type'];
           
           
            $this->db->select('*');  
            $this->db->from('products');
            $this->db->where('product_id',$product);  
            $query = $this->db->get();   
            $products=$query->row();
            // print_r($products);die;
           
            $data['list_materials'] = $this->franchisemodel->list_search_materialadmin($product,$period,$clevel,$class,$type,$_POST['subject'],$_POST['varient'],$_POST['series'],$products->product_name);
            // print_r($data['list_materials']);die;  
           
            $data['result']=$_POST;
           
       }
       
        if(isset($_POST['Delete'])){
           $arr=$_POST['ids'];
        //   print_R($_POST);die;
        foreach($arr as $row){
            $this->db->where('id',$row);
            $this->db->delete('study_material');    
            
        }
       }
            
            
        // echo $data['result']['product_id'];    
            if(isset($data['result']['product_id'])){ 
                $this->db->select('*');  
                $this->db->from('competition_level_byproduct');
                
                $this->db->where('product_id',$data['result']['product_id']);
               
                $query = $this->db->get();   
                $data['load_level']=$query->result_array();
            }
    
            $this->db->select('*');  
            $this->db->from('products');
            $this->db->where('status','Active');  
            $query = $this->db->get();   
            $data['load_product']=$query->result_array();
    
            $this->db->select('*');  
            $this->db->from('lunar_subjects');
            $this->db->where('status','Active');  
            $query = $this->db->get();  
        $data['subjects']=$query->result();
    
        $this->load->view("study_material_search.php",$data);
    }
    
    
    public function assign_content()
    {
        if(isset($_POST['search'])){
            // print_r($_POST);die;
            
                $this->db->select('*');  
                $this->db->from('products');
                $this->db->where('product_id',$_POST['product_id']);  
                $query = $this->db->get();   
                $product=$query->row();
            
            
                $this->db->select('*');  
                $this->db->from('study_material');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) or $_POST['type'] != ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) or $_POST['status'] != ''){
                    $this->db->where('status',$_POST['status']); 
                }
                
                
                if(!empty($_POST['subject']) or $_POST['subject'] != ''){
                    $this->db->where('subject',$_POST['subject']); 
                }
                // if(!empty($_POST['series']) or $_POST['series'] != ''){
                //     $this->db->where('series',$_POST['series']); 
                // }
                if(!empty($_POST['varient']) or $_POST['varient'] != ''){
                    $this->db->where('sub_type',$_POST['varient']); 
                }
                
                
                
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_materials'] = $query->result_array();
                
            // echo $this->db->last_query();die;    
                
                
                $this->db->select('*');  
                $this->db->from('mock_papers');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) || $_POST['type'] != ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) || $_POST['status'] != ''){
                    $this->db->where('pay_status',$_POST['status']); 
                }
                
                if(!empty($_POST['subject']) or $_POST['subject'] != ''){
                    $this->db->where('subject',$_POST['subject']); 
                }
                // if(!empty($_POST['series']) or $_POST['series'] != ''){
                //     $this->db->where('series',$_POST['series']); 
                // }
                if(!empty($_POST['varient']) or $_POST['varient'] != ''){
                    $this->db->where('sub_type',$_POST['varient']); 
                }
                
                
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_mock'] = $query->result_array();
        
           
            $data['result']=$_POST;
           
        }
        
       
        // if(isset($_POST['Delete'])){
        //   $arr=$_POST['ids'];
        // //   print_R($_POST);die;
        //     foreach($arr as $row){
        //         $this->db->where('id',$row);
        //         $this->db->delete('study_material');    
                
        //     }
        // }
            
        
            if (isset($_POST['submit_assign'])) {
                
                $period_id  = $this->input->post('period_id');
                $assign_ids = $this->input->post('assign_mat') ?? [];
                // $prices     = $this->input->post('price');
                $maker_ids  = $this->input->post('maker_id');
                
                // echo $period_id;
                
        
                foreach ($assign_ids as $mat_id) {
                    $data = [
                        'period_id'          => $period_id,
                        'mat_id'             => $mat_id,
                        // 'price'              => $prices[$mat_id] ?? 0,
                        'maker_id'           => $maker_ids[$mat_id] ?? null
                    ];
        
                    // Insert only if not already assigned
                    $exists = $this->db->get_where('assigned_materials', [
                        'period_id' => $period_id,
                        'mat_id'    => $mat_id
                    ])->row();
        
                    // print_r($data);die;
                    if (!$exists) {
                        $this->db->insert('assigned_materials', $data);
                    }
                }
        
                $this->db->select('*');  
                $this->db->from('products');
                $this->db->where('product_id',$_POST['product_id']);  
                $query = $this->db->get();   
                $product=$query->row();
                
                // print_r($product);die;
                
                $this->db->select('*');  
                $this->db->from('study_material');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) || $_POST['type'] == ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) || $_POST['status'] == ''){
                    $this->db->where('status',$_POST['status']); 
                }
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_materials'] = $query->result_array();
                
                
                
                
                $this->db->select('*');  
                $this->db->from('mock_papers');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) || $_POST['type'] == ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) || $_POST['status'] == ''){
                    $this->db->where('pay_status',$_POST['status']); 
                }
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_mock'] = $query->result_array();
        
        
                $data['result']=$_POST;
                
            }
            
            if (isset($_POST['assign_mocktest'])) {
                $period_id  = $this->input->post('period_id');
                $assign_ids = $this->input->post('assign_mock') ?? [];
                // $prices     = $this->input->post('price');
                $maker_ids  = $this->input->post('maker_id');
            
                foreach ($assign_ids as $paper_id) {
                    $data = [
                        'period_id' => $period_id,
                        'mat_id'    => $paper_id,
                        // 'price'     => $prices[$paper_id] ?? 0,
                        'maker_id'  => $maker_ids[$paper_id] ?? null
                    ];
            
                    // Insert only if not already assigned
                    $exists = $this->db->get_where('assigned_mock', [
                        'period_id' => $period_id,
                        'mat_id'    => $paper_id
                    ])->row();
            
                    if (!$exists) {
                        $this->db->insert('assigned_mock', $data);
                    }
                }
            
                // Reload context
                $product = $this->db->get_where('products', ['product_id' => $_POST['product_id']])->row();
            
            
            
                $this->db->select('*');  
                $this->db->from('study_material');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) || $_POST['type'] == ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) || $_POST['status'] == ''){
                    $this->db->where('status',$_POST['status']); 
                }
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_materials'] = $query->result_array();
                
                
                
                
                $this->db->select('*');  
                $this->db->from('mock_papers');
                $this->db->where('product_name',$product->product_name);
                if(!empty($_POST['type']) || $_POST['type'] == ''){
                    $this->db->where('type',$_POST['type']); 
                }
                if(!empty($_POST['status']) || $_POST['status'] == ''){
                    $this->db->where('pay_status',$_POST['status']); 
                }
                $this->db->where('clevel',$_POST['clevel']);  
                $query = $this->db->get();   
                $data['list_mock'] = $query->result_array();
        
                
                
            
                $data['result'] = $_POST;
            }

            
            
        // echo $data['result']['product_id'];    
            if(isset($data['result']['product_id'])){ 
                $this->db->select('*');  
                $this->db->from('competition_level_byproduct');
                
                $this->db->where('product_id',$data['result']['product_id']);
               
                $query = $this->db->get();   
                $data['load_level']=$query->result_array();
            }
    
            $this->db->select('*');  
            $this->db->from('products');
            $this->db->where('status','Active');  
            $query = $this->db->get();   
            $data['load_product']=$query->result_array();
    
            $this->db->select('*');  
            $this->db->from('lunar_subjects');
            $this->db->where('status','Active');  
            $query = $this->db->get();  
            $data['subjects']=$query->result();
            
            $this->db->select('*');  
            $this->db->from('period');
            $this->db->where('period_id >','12');  
            $query = $this->db->get();   
            $data['load_period']=$query->result_array();
    
        $this->load->view("assign_content.php",$data);
    }
    
    
    public function delete_assign_mat()
    {
        $id = $this->input->post('id');
    
        if ($id) {
            // Attempt delete
            $this->db->where('id', $id);
            $this->db->delete('assigned_materials');
    
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Material unassigned successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Record not found or already deleted.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    }

    
    public function delete_assign_mock()
    {
        $id = $this->input->post('id');
    
        if ($id) {
            // Attempt delete
            $this->db->where('id', $id);
            $this->db->delete('assigned_mock');
    
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'MockTest unassigned successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Record not found or already deleted.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    }

   
    public function studymat_delete($id='')
    {
      $id = $this->uri->segment(4);
     $delete= $this->db->delete('study_material',array('id'=>$id));
      
      if($delete){
         $this->session->set_flashdata('success','Study Material Delete Successfully.'); 
         redirect('manage/franchise/study_material_2021');
      }
       
    }
    
   
    public function zoomstudymat_delete($id='')
    {
      $id = $this->uri->segment(4);
     $delete= $this->db->delete('zoomzoom_studymaterial',array('id'=>$id));
      
      if($delete){
         $this->session->set_flashdata('success','Study Material Delete Successfully.'); 
         redirect('manage/franchise/study_material_zoomzoom');
      }
       
    }
   
   
    public function orientatition_extract()
    {
       if(isset($_POST['Search'])){
          // print_r($_POST);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
           
           $data['orientation']=$this->franchisemodel->orientatition_list_2021($_POST['product'],$_POST['class'],$_POST['status']);
       }
       
       if(isset($_POST['Export'])){
        //   print_r($_POST);die;
           $orientation=$this->franchisemodel->orientatition_list_2021($_POST['new_product'],$_POST['new_class'],$_POST['new_status']);
        //   print_r($orientation);die;
           if($_POST['new_status']=='Yes'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
           
        //   echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $product_name,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
       //print_r($data['orientation']);die;
       $this->load->view("orientatition_extract.php",$data); 
   }
   
   
    public function competition_extraction()
    {
        if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
		   $data['period_id']=$_POST['period_id'];
		   $data['level']=$_POST['level'];
		   $data['state_id']=$_POST['state_id'];
           $data['orientation']=$this->franchisemodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
          // print_r($_POST);die;
           $orientation=$this->franchisemodel->competition_list_2021($_POST['new_product'],$_POST['new_class'],$_POST['new_status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
           //print_r($_POST['new_status']);die;
           if($_POST['new_status']=='Paid'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['product_name'],
					   'Yes',
        			   $item['period_id'],
        			   $item['clevel'],
					   $item['time'],
        			   $item['school_name'],
					   $item['school_address1'],
        			   $item['class'],
        			   
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Product Name','Competition','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
        
        
        
       $this->load->view("competition_extraction.php",$data); 
    }
    
   
    public function competition_extraction_all()
    {
        if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
		   $data['period_id']=$_POST['period_id'];
		   $data['new_level']=$_POST['level'];
           $data['orientation']=$this->franchisemodel->competition_list_2022($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level']);
        }
        
        if(isset($_POST['Export'])){
           //print_r($_POST);die;
           $orientation=$this->franchisemodel->competition_list_2022($_POST['new_product'],$_POST['new_class'],$_POST['new_status'],$_POST['new_period_id'],$_POST['new_level']);
          print_r($orientation);die;    
           
           $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      print_r($item);die;  
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $item['product_name'],
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
        
        
        
       $this->load->view("competition_extraction_all.php",$data); 
   }
   
   
    public function mock_test()
    {
       
       if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
           $data['orientation']=$this->franchisemodel->mock_test_list_2021($_POST['product'],$_POST['class'],$_POST['status']);
       }
       if(isset($_POST['Export'])){
          // print_r($_POST);die;
           $orientation=$this->franchisemodel->mock_test_list_2021($_POST['new_product'],$_POST['new_class'],$_POST['new_status']);
           if($_POST['new_status']=='Yes'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $product_name,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
       $this->load->view("mocktest_extraction.php",$data); 
   }
   
   
   	public function activate_orientation()
   	{
	   
	    if(isset($_POST['submit'])){
	        $product= $this->db->get_where('period',array('status'=>'Active'))->row();
	       // print_r($_POST);die;
	        $ar=array( 
	            'state_id'=>$_POST['state_id'],
	            'franchise_id'=>$_POST['franchise_id'],
	            'area'=>$_POST['area'],
	            'school'=>$_POST['school'],
	            'price'=>$_POST['price'],
	            'mock_price'=>$_POST['mock_price'],
	            'franchise_cut'=>$_POST['franchise_cut'],
	            'school_amount'=>$_POST['school_amount'], 
	            'product'=>$_POST['product'],
	            'end_date'=>$_POST['end_date'],
	            'period_id'=>$product->period_id
	            );
	       $this->db->insert('orientation_school',$ar); 
	       $data['message']='Orientation added successfully.';
	    }
	    
	        $this->db->select('*');
            $this->db->from('orientation_school');
            $this->db->join('areas','areas.area_code=orientation_school.area');
            $this->db->join('states','states.state_subdivision_id=orientation_school.state_id');
            $this->db->join('school_new','school_new.id=orientation_school.school_id');
            $this->db->join('franchise','franchise.franchise_id=orientation_school.franchise_id');
            $this->db->join('period','period.period_id=orientation_school.period_id');
            $this->db->order_by('con_id','DESC');
            $this->db->limit('20');
            $query=$this->db->get();
            $data['dataload'] = $query->result_array();
	        
	    
	    if(isset($data['result']['state_id']))
        {
            $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
        }
        
        if(isset($data['result']['country']))
        {
            $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
        
        
            $data['periodload'] = $this->db->get_where('period',array('status'=>'Active'))->result_array();
        
        
        if(isset($data['result']['franchise_id']))
        {
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        if(isset($data['result']['area']))
        {
            $this->db->select('*');
            $this->db->from('school_new');
            // $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_code',$data['result']['area']);
            $query=$this->db->get();
            $data['schoolload'] = $query->result_array();
        }
        
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        
	    $this->load->view("activate_orientation",$data);
	}
   
   
    public function study_material()
    {
       
       if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
           $data['orientation']=$this->franchisemodel->study_material_list_2021($_POST['product'],$_POST['class'],$_POST['status']);
       }
       if(isset($_POST['Export'])){
          // print_r($_POST);die;
           $orientation=$this->franchisemodel->study_material_list_2021($_POST['new_product'],$_POST['new_class'],$_POST['new_status']);
           if($_POST['new_status']=='Yes'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $product_name,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
       $this->load->view("study_material_extraction.php",$data); 
   }
   
   
    public function not_applied()
    {
       if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
        //   $data['new_status']=$_POST['status'];
           $data['orientation']=$this->franchisemodel->not_applied($_POST['product'],$_POST['class']);
       }
       if(isset($_POST['Export'])){
          // print_r($_POST);die;
           $orientation=$this->franchisemodel->not_applied($_POST['new_product'],$_POST['new_class']);
           if($_POST['new_status']=='Yes'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $product_name,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
       
       $this->load->view("not_applied.php",$data);
   }
   
   
    public function rivision()
    {
       if(isset($_POST['Search'])){
           //print_r($_POST['product']);die;
           $data['new_class']=$_POST['class'];
           $data['new_product']=$_POST['product'];
           $data['new_status']=$_POST['status'];
           $data['orientation']=$this->franchisemodel->rivision($_POST['product'],$_POST['class'],$_POST['status']);
       }
       if(isset($_POST['Export'])){
          // print_r($_POST);die;
           $orientation=$this->franchisemodel->rivision($_POST['new_product'],$_POST['new_class'],$_POST['new_status']);
           if($_POST['new_status']=='Yes'){
               $status='Registered';
           }else{
               $status='Not Registered';
           }
           $product_name=$_POST['new_product'];
           $n=1;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $item['class']  ,
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   
        			   $product_name,
        			   $status
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"national_level_2021_22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','School','Class','Father Name','Mother Name','Mobile','Email','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
	    $this->load->view("revision_extraction.php",$data);
	}
	
	
	public function cin_login_activate()
	{
	    $data['active']=$this->franchisemodel->cin_login_activate();
	    if(isset($_POST['Search'])){
           //print_r($_POST);die;
           $product_name   = $this->input->post('product_name');
           $period_id   = $this->input->post('period_id');
           $clevel   = $this->input->post('clevel');
           $study_material   = $this->input->post('study_material');
           $orientation   = $this->input->post('orientation');
           $rivision   = $this->input->post('rivision');
           $mock_test  = $this->input->post('mock_test');
           
           if(!empty($study_material)){$study_material_price='Yes';}else{$study_material_price='No';}
           if(!empty($orientation)){$orientation_price='Yes';}else{$orientation_price='No';}
           if(!empty($rivision)){$rivision_price='Yes';}else{$rivision_price='No';}
           if(!empty($mock_test)){$mock_test_price='Yes';}else{$mock_test_price='No';}
           $array1=array(
               'product_name'      => $this->input->post('product_name'),
               'study_material'      => $study_material_price,
               'orientation'      => $orientation_price,
               'rivision'      => $rivision_price,
               'mock_test'      => $mock_test_price,
               'status'=>'Active'
               );
           
            $array2=array(
               'product'      => $this->input->post('product_name'),
               'product_price'      =>  $this->input->post('product_price'),
               'orientation1'      => $this->input->post('orientation'),
               'study_material'      => $this->input->post('study_material'),
               'revision1'=>$this->input->post('rivision'),
               'mock_test'      => $this->input->post('mock_test'),
               'period_id'      => $period_id,
               'clevel'=>$clevel
               );
            $this->franchisemodel->insert_products_cin_parts($array1);
            $this->franchisemodel->insert_pricing_cin($array2);
       }
       
       if(isset($_POST['deactiate'])){
           //print_r($_POST['deactiate']);die;
           $this->franchisemodel->deactiate($_POST['deactiate']);
           
           
       }
       
       
	    $this->load->view("cin_login_activate.php",$data);
	}
   
   
    public function competition_statewise()
    {
	   //echo 'sasas';
	    $data['active']=$this->franchisemodel->competition_statewise();
	    if(isset($_POST['Search'])){
           //print_r($_POST);die;
           $product_name   = $this->input->post('product_name');
		   $product_price   = $this->input->post('product_price');
           $period_id   = $this->input->post('period_id');
           $clevel   = $this->input->post('clevel');
           $study_material_price  = $this->input->post('study_material');
           $orientation_price   = $this->input->post('orientation');
           $mock_test_price  = $this->input->post('mock_test');  
		   $state_id  = $this->input->post('state_id');
           
           //if(!empty($study_material)){$study_material_price='Yes';}else{$study_material_price='No';}
           //if(!empty($orientation)){$orientation_price='Yes';}else{$orientation_price='No';}
           //if(!empty($rivision)){$rivision_price='Yes';}else{$rivision_price='No';}
           //if(!empty($mock_test)){$mock_test_price='Yes';}else{$mock_test_price='No';}
           $array1=array(
               'product_name'           => $product_name,
               'product_price'          => $product_price,
			   'orientation'            =>'Yes',
               'orientation_price'      => $orientation_price,
               'study_material'         => 'Yes',
               'study_material_price'   => $study_material_price,
			   'mock_test'              =>'Yes',
               'mock_test_price'        =>$mock_test_price,
			   'state_id'               =>$state_id,
			   'clevel'                 =>$clevel,
			   'period_id'              =>$period_id,
               'status'                 =>'Active'
               );
           //print_r($array1);exit; 
            
           $Comp = $this->db->insert('competition_product_state',$array1);
           
       }
       
       if(isset($_POST['deactiate'])){
           //print_r($_POST['deactiate']);die;
           $this->franchisemodel->deactiate($_POST['deactiate']);
           
           
       }
       
       
	    $this->load->view("competition_statewise",$data);  
	}

    // zooom zoom study material //
    public function study_material_zoomzoom()
    {
      
        if(isset($_POST['submit'])){
           
           // print_r($_POST['status']);
        //   echo $this->input->post('level_id1').'<br>';
        //   echo $this->input->post('level_id2');
        //   die;
            //  if($this->input->post('level_id1')=='Select level'){
            //      $level=$this->input->post('level_id2');
            //  }
            //  if($this->input->post('level_id2')=='Select level'){
            //      $level=$this->input->post('level_id1');
            //  }
                
               
            	
               // $target_dir ="../study_material/";
                //$uploadpath = $_SERVER[DOCUMENT_ROOT'].'/folderame';
                if($this->input->post('status')=='Free')
                {
                    $target_path ="../zoomzoom_free_material/";
                }else{
                    $target_path ="../zoomzoom_paid_material/";
                    
                }
                
                   	    
				   
               if ($_FILES['folder']['name'])
            	{
    		
    			$file_name2     = $_FILES["folder"]["name"];
    			$file_size2     = $_FILES["folder"]["size"];
    			$file_type2     = $_FILES["folder"]["type"];
    			$file_tmp_name2 = $_FILES["folder"]["tmp_name"];
    		
    			$new_file_name2 = $file_name2;
    		
                $upload_path_file2   = $target_path . $new_file_name2;
    
                // print_r($file_size2);
                // print_r($file_type2);
                // die;
    			if (move_uploaded_file($file_tmp_name2, $upload_path_file2)) 
    			{ 
    				$question_file_path = addslashes($target_path . $new_file_name2);
    			}
    			
    			else 
    			{ 
    			   $this->notifications->notify('files cannot upload', 'error');  }/*end else var_dump($this->validation->show_errors());*/
    			
    	     	}
            		
            		
            	
            	   	
            			$insert_data=array(
            								'title'      => $this->input->post('title'),
            								'period'     => $this->input->post('period'),
            								'level_id'  => $this->input->post('level'),
            								'class'   => $this->input->post('class'),
            								'folder' => $new_file_name2,
            								'status'   => $this->input->post('status'),
            								'price'   => $this->input->post('price'),
            								'product_name'   => $this->input->post('product_name'),
            								
            							   );
            							   
            	
            	     //   echo "<pre>";print_r($insert_data);exit;
            			
            							
                        $insert_status = $this->franchisemodel->insert_zoomzoommaterials($insert_data);
            				
            				if($insert_status=="Yes")
            				{
            					 $this->session->set_flashdata('success','Save Study materials successfully ...');
            					 $data['message']='Save Study materials successfully ...';
            				}
            				
            				if($insert_status=="No")
            				{
            					$this->session->set_flashdata('success','Duplicate or error in upload try again ...');
            					$data['message']='Duplicate or error in upload try again ...';
            				}
            			
            					
            
            	//	   echo $this->session->flashdata('success');die;
            
            	
                    
            
        }
         $data['list_materials'] = $this->franchisemodel->zoomzoom_studymaterial();
       
        $this->load->view("zoomzoom_material.php",$data); 
   }
   
   
    public function primary_color_extraction()
    {
        if(isset($_POST['submit'])){
           //print_r($_POST);die;
           $data['cla']=$_POST['class'];
           $data['fra']=$_POST['franchise'];
           $data['per']=$_POST['period'];
           $data['status']=$_POST['status'];
           $data['study_material']=$_POST['study_material'];
           $data['orientation']=$_POST['orientation'];
           $data['mock_test']=$_POST['mock_test'];
           //$data['student']=$this->franchisemodel->primary_color_export($_POST['class'],$_POST['franchise'],$_POST['period'],$_POST['status'],$_POST['study_material'],$_POST['orientation'],$_POST['mock_test']);
        }
        
        if(isset($_POST['competition'])){
            $data['cla']=$_POST['class'];
            $data['fra']=$_POST['franchise'];
            $data['per']=$_POST['period'];
            $data['status']=$_POST['status'];
           
         //print_r($_POST['franchise']);die;
           
           
                $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.status', 'Paid');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $data['student']=    $query->result_array();
           // print_r($data['student']);die;
         }
         
          
        if(isset($_POST['study_material'])){
             $data['cla']=$_POST['class'];
           $data['fra']=$_POST['franchise'];
           $data['per']=$_POST['period'];
           $data['study_material']=$_POST['study_material'];
               $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.study_material', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $data['student']=    $query->result_array();         
            //$data['student']=    $query->result_array();
         }
         if(isset($_POST['orientation'])){
             $data['cla']=$_POST['class'];
           $data['fra']=$_POST['franchise'];
           $data['per']=$_POST['period'];
          $data['orientation']=$_POST['orientation'];
             $data['cla']=$_POST['class'];
           $data['fra']=$_POST['franchise'];
           $data['per']=$_POST['period'];
           $data['study_material']=$_POST['study_material'];
               $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.orientation', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $data['student']=    $query->result_array(); 
         }
         if(isset($_POST['mock_test'])){
             $data['cla']=$_POST['class'];
           $data['fra']=$_POST['franchise'];
           $data['per']=$_POST['period'];
            $data['mock_test']=$_POST['mock_test'];
             $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.mock_test', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $data['student']=    $query->result_array();
         }
        
        
        if(isset($_POST['Export'])){
          // print_r($_POST);die;
           if($_POST['Export']=='CompetitionExport'){
              // print_r($_POST);die;
                $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.status', 'Paid');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $orientation=    $query->result_array();
           }
           
           if($_POST['Export']=='StudyMAterialExport'){
                $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.study_material', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $orientation=    $query->result_array();
           }
           
           
        if($_POST['Export']=='OrientationExport'){
                $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.orientation', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $orientation=    $query->result_array();
           }
           
           
           
           
           if($_POST['Export']=='MockExport'){
                $this->db->select('*');
        	    $this->db->from('new_cart');
        	    if($_POST['class']!='All'){
        		    $this->db->where('cin_list.class',$_POST['class']);
        		}
        		if($_POST['franchise']!='All'){
        		    $this->db->where('cin_list.franchise_code',$_POST['franchise']);
        		}
        	    $this->db->join('cin_list','cin_list.cin=new_cart.cin');
        	    
        	    $this->db->where('new_cart.mock_test', 'Yes');
	    
        	    $this->db->where('new_cart.clevel', '4');
        	    $this->db->where('new_cart.period_id', $_POST['period']);
        	    $this->db->group_by('new_cart.cin');
                $query = $this->db->get();
         // echo $this->db->last_query();die;    
            $orientation=    $query->result_array();
           }
           
           
           $product_name=$_POST['new_product'];
           $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"Primary Color 2021/22".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
        
        
   
       
        $this->load->view("primary_color_extraction.php",$data); 
   }
   
   
    public function bulk_schooladd()
    {
       	if(isset($_POST['submit'])){
    	    $country_id=$_POST['country_id'];
    		$state_id=$_POST['state_id'];
    		$area_code=$_POST['area'];
    		$franchise_id=$_POST['franchise'];
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
    					{ 
    					    
    					    
    					     $this->db->select('school_code');
                             $this->db->from('school_new');
                             $this->db->like('school_code',$area_code,'after');
                             $this->db->order_by('id','DESC');
                             
                    		 $get   =  $this->db->get();
                             $get_u=$get->result_array(); 
                    		 $school_code  = $get_u[0]['school_code'];
                   
                     		$num=explode("S",$school_code);
                     
                     		$num=$num[1];
                     		
                     		 $num=$num+1;
                     		$school_code=$area_code.'S'.$num;
                     		//print_r($school_code);die;
                     		
    					    if($resultRow_from_csv[0]) 
    					    { 
    						    //echo  addslashes($resultRow_from_csv[2]);die;
    						    $school_name      =  addslashes($resultRow_from_csv[0]);
            					$affiliation_number            =  addslashes($resultRow_from_csv[1]);
            					$school_address           =  addslashes($resultRow_from_csv[2]);
            					$location            =  addslashes($resultRow_from_csv[3]);
            				    $school_city                     =  addslashes($resultRow_from_csv[4]);
            					$school_district           = addslashes($resultRow_from_csv[5]);
            					$school_phone             =  addslashes($resultRow_from_csv[6]);
            					$school_mobile                =  addslashes($resultRow_from_csv[7]);
            					$school_email                =  addslashes($resultRow_from_csv[8]);
            				    $school_board=    addslashes($resultRow_from_csv[9]);
            				   	$school_medium=    addslashes($resultRow_from_csv[10]);
            					$school_pincode                =  addslashes($resultRow_from_csv[11]);
            					$principal_titile             =  addslashes($resultRow_from_csv[12]);
            					$school_principal_name             =  addslashes($resultRow_from_csv[13]);
            					$principal_email         = addslashes($resultRow_from_csv[14]);
            				    $principal_phone       =  addslashes($resultRow_from_csv[15]);
            					$coordinator_titile          =  addslashes($resultRow_from_csv[16]);
            					$school_coordinator_name            =  addslashes($resultRow_from_csv[17]);
            					$school_coordinator_email            =  addslashes($resultRow_from_csv[18]);
            					$sh_coordinator_phone            =  addslashes($resultRow_from_csv[19]);
    					
    				       
    						    $insert_data      = array(
    	  
    						  'country'                => $country_id,
    						  'state'      => $state_id,
    						  'school_code'=>$school_code,
    						  'school_name'               => $school_name,
    						  'affiliation_number'        => $affiliation_number,
    						  'school_address'            => $school_address,
    						  'location'                  => $location,
    						  'city'                      => $school_city,
    						  'pin'                   => $school_pincode,
    						  
    						  'principal_titile'          => $principal_titile,
    						  'school_principal_name'     => $school_principal_name,
    						  'principal_email'          => $principal_email,
    						  'principal_phone'          => $principal_phone,
    						  'coordinator_titile'        => $coordinator_titile,
    						  'school_coordinator_name'   => $school_coordinator_name,
    						  'school_coordinator_email'  => $school_coordinator_email,
    						  'coordinator_phone'      => $sh_coordinator_phone,
    						  
    						  'district'            => $school_district,
    						  'school_phone'              => $school_phone,
    						  'school_mobile'             => $school_mobile,
    						  'school_email'              => $school_email,
    						  'school_board'              => $school_board,
    						  'school_medium'             => $school_medium,
    						  'area_code'=> $area_code,
    						  'franchise_id' =>$franchise_id
    		 
    						); 
    						  
    						  
    						 
    						    //print_r($insert_data);die; 
    						    $db_status=$this->schoolmodel->insertschooldata($insert_data); 
    						    
    						    if($db_status){
                				    $this->db->select('*');
                				    $this->db->from('school_new');
                				    $this->db->where('id',$db_status);
                	                $query = $this->db->get();		/*echo $this->db->last_query();exit;*/
                	                $file= $query->row_array();
                				    //print_r($file);die;
                				    $csv_upload_status=array(
                				        'school_code'=>$file['school_code'],
                				        'school_name'=>$file['school_name'],
                				        'status'=>'Success'
                				        );
                				}else{
                				    $csv_upload_status=array(
                				        'school_code'=>$file['school_code'],
                				        'school_name'=>$file['school_name'],
                				        'status'=>'Error'
                				        
                				        );
                				}
                				
    						    array_push($csvResult_upolad_logArray,$csv_upload_status);
    						    //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
    						   
    						   //array_push($csvResult_upolad_logArray,$csv_upload_status);
    					    }/*End if*/
    					   
    				    }
				      $i=$i+1;	
				    }while($resultRow_from_csv = fgetcsv($handle,1000));
				 
				 
					 $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
					  
					$this->notifications->notify('School Generated Successfully','success');	
					 
			      }    /*END OF TYPE CHECKING*/
    			else
    			{
    					$this->notifications->notify('Not a csv file ','error');
    			}/*END OF ELSE TYPE CHECKING*/
					   
					  
		    }/* End if */
	    
       	}
	    
	    $this->db->where('school_name','school_name');
		$this->db->delete('school_new');
		
		
		$data['country']    = $this->db->get_where('countries')->result_array();
        if(isset($data['result']['country'])){
	    $data['state']    = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
        }
		if(isset($data['result']['state_id'])){
        $data['franchise']  = $this->db->get_where('franchise',['state_id'=>$data['result']['state_id']])->result_array();
        }
        if(isset($data['result']['state_id'])){
        $data['area']  = $this->db->get_where('areas',['state_id'=>$data['result']['state_id']])->result_array();
        }
        
	    $this->load->view("school_genration.php",$data); 
    }
   
   
    public function assign_pricecode_school()
    {
       	if(isset($_POST['submit']) && $_POST['submit']=='Submit')
	    {
 		 //print_r($_POST);die;
 		    $check=$_POST['area'];
 		    $this->db->select('*');
            $this->db->from('school_new');
            $this->db->like('school_code',$check,'after');
            $res = $this->db->get();
            $data['result'] = $res->result_array();
            // print_r($result);die;
	    }
        $this->load->view("assign_pricecode_school.php",$data);
    }
   
   
    public function cin_genration()
    {
		
		if(isset($_POST['submit'])) {
	        $data['result']=$_POST;
    	    $product = $this->input->post('product');
    		$franchise_id = $this->input->post('franchise_id');
    		$school = $this->input->post('school');
    		//print_r($_POST);exit; 
    		$level = $this->input->post('1');
    		$period = $this->input->post('period');
    		$stat = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
    		$state_id = $this->input->post('state_id');
    		$country_id = $this->input->post('country');
    		$area_code = $this->input->post('area');
    		
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
					{ 
					    //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];echo 'okk';die;
					   if($resultRow_from_csv[0]) 
					   { 
						  //$period_id               =  addslashes($resultRow_from_csv[0]);
						  ////$school_id            =  addslashes($resultRow_from_csv[1]);
						  //$country_id            =  addslashes($resultRow_from_csv[1]);
						  //$state_id            =  addslashes($resultRow_from_csv[2]);
						  $class_id            =  addslashes($resultRow_from_csv[0]);
						  //$category_id            =  addslashes($resultRow_from_csv[1]);
						  $stud_name            =  addslashes($resultRow_from_csv[1]);
						  $gender            =  addslashes($resultRow_from_csv[2]);
						  $father_name            =  addslashes($resultRow_from_csv[3]);
						  $mother_name            =  addslashes($resultRow_from_csv[4]);
						  $communication_address  =  addslashes($resultRow_from_csv[5]);
						  $communication_address1  =  addslashes($resultRow_from_csv[6]);
						  $pincode  =  addslashes($resultRow_from_csv[7]);
						  $email  =  addslashes($resultRow_from_csv[8]);
						  $mobile_number  =  addslashes($resultRow_from_csv[9]);  
						  
						  
						   if($class_id==1){  $class = 'Nursery';}
						   if($class_id==2){  $class = 'LKG';}
						   if($class_id==3){  $class = 'UKG';}
						   if($class_id==4){  $class = 'Class-1';}
						   if($class_id==5){  $class = 'Class-2';}
						   if($class_id==6){  $class = 'Class-3';}
						   if($class_id==7){  $class = 'Class-4';}
						   if($class_id==8){  $class = 'class-5';}
						   if($class_id==9){  $class = 'Class-6';}
						   if($class_id==10){  $class = 'Class-7';}
						   if($class_id==11){  $class = 'Class-8';}
						   if($class_id==12){  $class = 'Class-9';}
						   if($class_id==13){  $class = 'Class-10';}
						   if($class_id==14){  $class = 'Class-11';}
						   if($class_id==15){  $class = 'Class-12';}
					
						  if($product == 'Lunar Skill Test'){
						      $subject = $this->input->post('subject');
						      $series = $this->input->post('serie');
						      $type = $this->input->post('type');
						  }else{
						      $subject = '';
						      $series = '';
						      $type = '';
						  }
						  
						  $csv_result_array  =  array(   'period_id'  => $period, 
														  'school_id'  => $school,
														  'country_id' =>  $country_id,
														  'state_id'   => $state_id,
														  'class_id'   =>  $class_id,
														  'class'      =>$class,
														  'category_id' =>  $class_id,
														  'stud_name'  =>  $stud_name,
														  'gender'        => $gender  ,
														  'father_name'   => $father_name,
														  'mother_name'   =>  $mother_name,
														  'communication_address'   =>  $communication_address ,
														  'communication_address1'  =>  	$communication_address1,
														  'pincode' => $pincode,
														  'email'      => $email,
														  'mobile_number'  => $mobile_number,
														  'clevel'        =>$level,
														  'area_code'     =>$area_code,
														  'franchise_id' => $franchise_id,
														  'subject'=>$subject,
														  'series'=>$series,
														  'type' => $type
													    );
														 
						   //print_r($csv_result_array);echo $product.'ok';die; 
						   $csv_upload_status = $this->franchisemodel->generate_cin($csv_result_array,$product); 
						   array_push($csvResult_upolad_logArray,$csv_upload_status);
						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
						   //array_push($csvResult_upolad_logArray,$csv_upload_status);
					   }/*End if*/
					   
					  }
				  $i=$i+1;	
				 }while($resultRow_from_csv = fgetcsv($handle,1000));
				 
				 /*while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));*/
				  
					   /*............ End Do while ................*/
					   $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
					   /*unset($_FILES);*/
						$this->notifications->notify('CIN Generated Successfully','success');redirect('manage/franchise/cin_list');	
					 
				  }    /*END OF TYPE CHECKING*/
				  else
					{
							$this->notifications->notify('Not a csv file ','error');
					}/*END OF ELSE TYPE CHECKING*/
					   
				  
				  
					  
			   }/* End if */
				}


        
          
		$this->load->view("cin_genration.php",$data);  
		
	}

    // Enable to fix
    // 	public function cin_genration()
    // {
    //     // 🔥 Prevent timeout (important for large CSV)
    //     ini_set('max_execution_time', 300);
    //     ini_set('memory_limit', '512M');
    
    //     if (isset($_POST['submit'])) {
    
    //         $data['result'] = $_POST;
    
    //         $product       = $this->input->post('product');
    //         $franchise_id  = $this->input->post('franchise_id');
    //         $school        = $this->input->post('school');
    //         $level         = $this->input->post('1');
    //         $period        = $this->input->post('period');
    //         $state_id      = $this->input->post('state_id');
    //         $country_id    = $this->input->post('country');
    //         $area_code     = $this->input->post('area');
    
    //         $stat = $this->db->get_where('franchise', array('franchise_id' => $franchise_id))->row();
    
    //         $csvResult_upolad_logArray = array();
    //         $start_cell_row = 2;
    //         $i = 0;
    
    //         if (!empty($_FILES['csv']['size'])) {
    
    //             $file   = $_FILES['csv']['tmp_name'];
    //             $handle = fopen($file, "r");
    
    //             $ext = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
    
    //             if ($ext === 'csv') {
    
    //                 // ✅ Class mapping (clean)
    //                 $classArray = [
    //                     1=>'Nursery',2=>'LKG',3=>'UKG',4=>'Class-1',5=>'Class-2',
    //                     6=>'Class-3',7=>'Class-4',8=>'Class-5',9=>'Class-6',
    //                     10=>'Class-7',11=>'Class-8',12=>'Class-9',
    //                     13=>'Class-10',14=>'Class-11',15=>'Class-12'
    //                 ];
    
    //                 // 🔥 FIXED LOOP
    //                 while (($resultRow_from_csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
    
    //                     if ($i >= $start_cell_row && !empty($resultRow_from_csv[0])) {
    
    //                         // ✅ Safe assignment
    //                         $class_id = addslashes($resultRow_from_csv[0] ?? '');
    //                         $stud_name = addslashes($resultRow_from_csv[1] ?? '');
    //                         $gender = addslashes($resultRow_from_csv[2] ?? '');
    //                         $father_name = addslashes($resultRow_from_csv[3] ?? '');
    //                         $mother_name = addslashes($resultRow_from_csv[4] ?? '');
    //                         $communication_address = addslashes($resultRow_from_csv[5] ?? '');
    //                         $communication_address1 = addslashes($resultRow_from_csv[6] ?? '');
    //                         $pincode = addslashes($resultRow_from_csv[7] ?? '');
    //                         $email = addslashes($resultRow_from_csv[8] ?? '');
    //                         $mobile_number = addslashes($resultRow_from_csv[9] ?? '');
    
    //                         $class = isset($classArray[$class_id]) ? $classArray[$class_id] : '';
    
    //                         if ($product == 'Lunar Skill Test') {
    //                             $subject = $this->input->post('subject');
    //                             $series  = $this->input->post('serie');
    //                             $type    = $this->input->post('type');
    //                         } else {
    //                             $subject = '';
    //                             $series  = '';
    //                             $type    = '';
    //                         }
    
    //                         $csv_result_array = array(
    //                             'period_id'  => $period,
    //                             'school_id'  => $school,
    //                             'country_id' => $country_id,
    //                             'state_id'   => $state_id,
    //                             'class_id'   => $class_id,
    //                             'class'      => $class,
    //                             'category_id'=> $class_id,
    //                             'stud_name'  => $stud_name,
    //                             'gender'     => $gender,
    //                             'father_name'=> $father_name,
    //                             'mother_name'=> $mother_name,
    //                             'communication_address'  => $communication_address,
    //                             'communication_address1' => $communication_address1,
    //                             'pincode'    => $pincode,
    //                             'email'      => $email,
    //                             'mobile_number' => $mobile_number,
    //                             'clevel'     => $level,
    //                             'area_code'  => $area_code,
    //                             'franchise_id'=> $franchise_id,
    //                             'subject'    => $subject,
    //                             'series'     => $series,
    //                             'type'       => $type
    //                         );
    
    //                         // 🔥 Call your existing function (NO CHANGE)
    //                         $csv_upload_status = $this->franchisemodel->generate_cin($csv_result_array, $product);
    
    //                         $csvResult_upolad_logArray[] = $csv_upload_status;
    
    //                         // 🔥 Optional: log failures
    //                         if (!$csv_upload_status) {
    //                             log_message('error', 'CIN failed: ' . json_encode($csv_result_array));
    //                         }
    //                     }
    
    //                     $i++;
    //                 }
    
    //                 fclose($handle);
    
    //                 $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
    
    //                 $this->notifications->notify('CIN Generated Successfully', 'success');
    //                 redirect('manage/franchise/cin_list');
    
    //             } else {
    //                 $this->notifications->notify('Not a csv file', 'error');
    //             }
    //         }
    //     }
    
    //     $this->load->view("cin_genration.php", $data);
    // }
	
    public function delete_all()
    {
        
        
        $compid = $this->input->post('comp_id');
       
       
       
        if(isset($_POST['Delete']))
        {
            $arr=$_POST['cins'];
            
            foreach($arr as $row){
            // echo $row;die;
            $this->db->where('cin', $row);
            $this->db->delete('cin_list');
            
            }
            foreach($arr as $row){
            $this->db->where('cin', $row);
            $this->db->delete('cin_result');
            }
        }   
        redirect('manage/franchise/cin_list/'.$compid);
   }
   
   
    public function cin_list()
    {
	    $compid = $this->uri->segment(4);
	    $data['comp_id']=$compid;
	    
	    $data['schedule'] = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $compid))->row();
               
	    
	    $this->db->select('*');
	    $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin=cin_result.cin');
	    $this->db->where('cin_result.competition_schedule_id',$compid);
	//	$this->db->order_by("id", "DESC");
		//$this->db->limit(50);
		$data['cin_list'] = $this->db->get()->result_array(); 

		$this->load->view('cin_list',$data);    
    }
    
    
    public function cin_list_recent()
    {
        $compid = $this->uri->segment(4); // will be empty from this menu link, that's fine now
        $data['comp_id'] = $compid;
        $data['schedule'] = null; // no single schedule when reached this way
    
        $this->db->select('cin_list.*, cin_result.competition_schedule_id');
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin');
    
        if (!empty($compid)) {
            // still works if ever reached WITH an id (e.g. from another page)
            $data['schedule'] = $this->db->get_where('competition_schedule', array('competition_schedule_id' => $compid))->row();
            $this->db->where('cin_result.competition_schedule_id', $compid);
        }
    
        $this->db->order_by('cin_list.id', 'DESC'); // most recent first
        $this->db->limit(200); // avoid pulling the entire table unfiltered
    
        $data['cin_list'] = $this->db->get()->result_array();
    
        $this->load->view('cin_list_recent', $data);
    } 
        
        
    public function export_cin($compid)
    {
        $this->db->select("cin_list.*, 
            cin_result.competition_schedule_id, 
            cin_result.product_name AS result_product_name, 
            competition_schedule.competition_caption, 
            competition_level_byproduct.level_name,franchise.franchise_first_name,
            school_new.school_name AS resolved_school_name", FALSE);
        $this->db->from('cin_list');
        $this->db->join('cin_result', 'cin_list.cin = cin_result.cin', 'left');
        $this->db->join('competition_schedule', 'competition_schedule.competition_schedule_id = cin_result.competition_schedule_id');
        $this->db->join('competition_level_byproduct', 'competition_schedule.competition_level_id = competition_level_byproduct.level_id', 'left');
        $this->db->join('school_new', 'cin_list.school_id = school_new.id', 'left');
        $this->db->join('franchise', 'cin_list.franchise_id = franchise.franchise_id', 'left');
        $this->db->join('period', 'competition_schedule.period_id = period.period_id', 'left');
        $this->db->where('cin_result.competition_schedule_id', $compid);
        $this->db->group_by('cin_list.cin');
        $result = $this->db->get()->result_array();
    
        // Filename from first row
        $filename_school   = !empty($result) ? $result[0]['resolved_school_name'] : 'School';
        $competition_name  = !empty($result) ? $result[0]['competition_caption'] : 'Competition';
        $safe_school = preg_replace('/[^A-Za-z0-9_-]/', '_', $filename_school);
        $safe_comp   = preg_replace('/[^A-Za-z0-9_-]/', '_', $competition_name);
    
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=CIN_List_{$safe_school}_{$safe_comp}_" . date('YmdHis') . ".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
    
        $fp = fopen('php://output', 'w');
        fputcsv($fp, array(
            'SL No', 'Student Name', 'CIN', 'Product Name', 'Level', 'Franchise ID', 'Area Code',
            'Class', 'Category', 'School Name', 'Father Name', 'Mother Name',
            'Gender', 'Phone', 'Email','Competition Name'
        ));
    
        $i = 1;
        foreach ($result as $row) {
            fputcsv($fp, array(
                $i++,
                $row['student_name'],
                $row['cin'],
                $row['result_product_name'],
                $row['level_name'],
                $row['franchise_first_name']   ?? '',
                $row['franchise_code'] ?? '',
                $row['class'],
                $row['category_id']    ?? '',
                $row['resolved_school_name'],
                $row['father_name'],
                $row['mother_name'],
                $row['gender'],
                $row['stud_phone'],
                $row['stud_email'],
                $row['level_name'].' Competition',
            ));
        }
        fclose($fp);
        exit;
    }
   
   
    public function editcin()
    {
        $cin   = $this->uri->segment(4);
        $schid = $this->uri->segment(5);
        
        $data['id'] = $cin;
        
        $data['student'] = $this->db->get_where('cin_list', array(
            'cin' => $cin
        ))->row_array();     
        
		if(isset($_POST['submit'])){
		    
		    $ar = array(
                    'student_name' => $_POST['student_name'] !== '' ? $_POST['student_name'] : $stat['student_name'],
                    'class' => $_POST['class'] !== '' ? $_POST['class'] : $stat['class'],
                    'father_name' => $_POST['father_name'] !== '' ? $_POST['father_name'] : $stat['father_name'],
                    'mother_name' => $_POST['mother_name'] !== '' ? $_POST['mother_name'] : $stat['mother_name'],
                    'gender' => $_POST['gender'] !== '' ? $_POST['gender'] : $stat['gender'],
                    'stud_phone' => $_POST['stud_phone'] !== '' ? $_POST['stud_phone'] : $stat['stud_phone'],
                    'stud_email' => $_POST['stud_email'] !== '' ? $_POST['stud_email'] : $stat['stud_email'],
                );
        
                $this->db->where('cin', $cin);
                $this->db->update('cin_list', $ar);
                redirect('manage/franchise/cin_list/'.$schid);
		    
		}
		if(isset($_POST['back'])){
		    redirect('manage/franchise/cin_list/'.$schid);
		}
		
       $this->load->view('edit_list',$data);
   }
   
   
    public function cin_list_export()
    {
        if(isset($_POST['submit'])){
    
            $product = $this->input->post('product');
    
            if($product != 'Select Product'){
                if($this->input->post('franchise') != '-- select franchise --'){
    
                    $period_id = $this->input->post('period_id');
    
                    $data['school_id'] = $this->input->post('school_id');
                    $data['state']     = $this->input->post('state_id');
                    $data['franchise'] = $this->input->post('franchise');
                    $data['area']      = $this->input->post('area');
    
                    $p   = $this->db->get_where('period', array('period_id' => $period_id))->row_array();
                    $ini = $p['initials'];
    
                    if($product == 'All'){
                        if($period_id == '12'){
                            $like = '';
                        }else{
                            $like = $ini;
                        }
                    }else{
                        $d = $this->db->get_where('products', array('product_name' => $product))->row_array();
                        if($period_id == '12'){
                            $like = $d['in12'];
                        }else{
                            $like = $ini.$d['in13'];
                        }
                    }
    
                    $s = $this->db->get_where('states', array('state_subdivision_id' => $this->input->post('state_id')))->row_array();
                    $data['state_name'] = $s['state_subdivision_name'];
    
                    $pe = $this->db->get_where('period', array('period_id' => $period_id))->row_array();
                    $data['academic_year'] = $pe['academic_year'];
    
                    $data['student'] = $this->franchisemodel->get_students_details($_POST, $like, $period_id);
    
                    $data['result'] = $_POST;
    
                    if(empty($data['student'])){
                        $data['message'] = 'Students not found with selected parameters...';
                    }
                }else{
                    $data['message'] = 'Select franchise ...';
                    $data['result']  = $_POST;
                }
            }else{
                $data['message'] = 'Select product...';
                $data['result']  = $_POST;
            }
        }
    
        if(isset($_POST['export'])){
    
            $period_id = $this->input->post('period_id');
            $product   = $this->input->post('product');
    
            $data['school_id'] = $this->input->post('school_id');
            $data['state']     = $this->input->post('state_id');
            $data['franchise'] = $this->input->post('franchise');
            $data['area']      = $this->input->post('area');
    
            $p   = $this->db->get_where('period', array('period_id' => $period_id))->row_array();
            $ini = $p['initials'];
    
            if($product == 'All'){
                if($period_id == '12'){
                    $like = '';
                }else{
                    $like = $ini;
                }
            }else{
                $d = $this->db->get_where('products', array('product_name' => $product))->row_array();
                if($period_id == '12'){
                    $like = $d['in12'];
                }else{
                    $like = $ini.$d['in13'];
                }
            }
    
            $s = $this->db->get_where('states', array('state_subdivision_id' => $this->input->post('state_id')))->row_array();
            $state_name = $s['state_subdivision_name'];
    
            $pe = $this->db->get_where('period', array('period_id' => $period_id))->row_array();
            $academic_year = $pe['academic_year'];
    
            $f = $this->db->get_where('franchise', array('franchise_id' => $this->input->post('franchise')))->row_array();
            $franchise_name = !empty($f['franchise_name']) ? $f['franchise_name'] : '';
    
            $student = $this->franchisemodel->get_students_details($_POST, $like, $period_id);
    
            $n = 1;
            $rows = array();
            foreach($student as $item){
                if(empty($item['school_name'])){
                    $school_row  = $this->db->get_where('school_new', array('id' => $item['school_id']))->row();
                    $school_name = $school_row ? $school_row->school_name : '';
                }else{
                    $school_name = $item['school_name'];
                }
    
                $item['serial_no'] = $n;
                $rows[] = array(
                    $item['serial_no'],
                    $item['cin'],
                    $item['student_name'],
                    $item['address1'],
                    $item['class'],
                    $item['father_name'],
                    $item['mother_name'],
                    $item['stud_phone'],
                    $item['stud_email'],
                    $item['franchise_name'],
                    $item['product_name'],
                    $school_name,
                    $item['state_subdivision_name'],
                    $item['franchise_code']
                );
                $n++;
            }
    
            $file_name = $state_name.'_'.$product.'_'.$academic_year;
    
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");
    
            $handle = fopen('php://output', 'w');
            fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Franchise Name','Product name','School','State','Area'));
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
            exit;
        }
    
        if(isset($data['result']['franchise']) && $data['result']['franchise'] != 'All'){
            
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise', 'area_to_franchise.area_id=areas.id');
            // $this->db->where('state_id', $data['result']['state_id']);
            $this->db->where('area_to_franchise.franchise_id', $data['result']['franchise']);
            $res = $this->db->get();
            $data['area_load'] = $res->result_array();
        }
        
        if(isset($data['result']['state_id'])){
            // echo 'okkkkk-----';
            
            $this->db->select('*');
            $this->db->from('areas');
            // $this->db->join('area_to_franchise', 'area_to_franchise.area_id=areas.id');
            $this->db->where('state_id', $data['result']['state_id']);
            // $this->db->where('area_to_franchise.franchise_id', $data['result']['franchise']);
            $res = $this->db->get();
            $data['area_load'] = $res->result_array();
        }
    
    
        $this->db->select('*');
        $this->db->from('countries');
        // $this->db->where('period_id >', '12');
        $res = $this->db->get();
        $data['country'] = $res->result_array();
        
        
        $this->db->select('*');
        $this->db->from('period');
        $this->db->where('period_id >', '12');
        $res = $this->db->get();
        $data['period_load'] = $res->result_array();
        
        if(isset($data['result']['country_id'])){
            $this->db->select('*');
            $this->db->from('states');
            $this->db->where('country_id', $data['result']['country_id']);
            $res = $this->db->get();
            $data['state_load'] = $res->result_array();
        }
        
        if(isset($data['result']['state_id'])){
            $this->db->select('*');
            $this->db->from('franchise');
            $this->db->where('state_id', $data['result']['state_id']);
            $res = $this->db->get();
            $data['franchise_load'] = $res->result_array();
        }
    
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status', 'Active');
        $res = $this->db->get();
        $data['product_load'] = $res->result_array();
    
        if(isset($data['result']['state_id']) && isset($data['result']['franchise'])){
            $this->db->select('*');
            $this->db->from('school_new');
            $this->db->where('school_status', 'Active');
            $this->db->where('state', $data['result']['state_id']);
            $this->db->where('school_new.franchise_id', $data['result']['franchise']);
            $res = $this->db->get();
            $data['school_load'] = $res->result_array();
        }
    
        $this->db->select('series');
        $this->db->from('cin_list');
        $this->db->where('series !=', '');
        $this->db->group_by('series');
        $res = $this->db->get();
        $data['series'] = $res->result();
    
        $this->db->select('subject');
        $this->db->from('cin_list');
        $this->db->where('subject !=', '');
        $this->db->group_by('subject');
        $res = $this->db->get();
        $data['subject'] = $res->result();
    
        $this->load->view('cin_list_export_loading', $data);
    }
    
       
    public function cin_list_export_loading()
    {
       if(isset($_POST['submit'])){
            //print_r($_POST);die;
           $state_id = $this->input->post('state_id');
	        $product = $this->input->post('product');
	        $district_id = $this->input->post('district_id');
	        $franchise_code = $this->input->post('area');
	        $franchise_id = $this->input->post('franchise_id');
            $period_id = $this->input->post('period');
            $school_id = $this->input->post('school');
            $class = $this->input->post('class');
            $from=$this->input->post('from_date');
            $to=$this->input->post('to_date');
            $status_extract = $this->input->post('status_extract');
            $level = $this->input->post('level');
            
                //$toofrom  = date("Y-m-d", strtotime($from . " -1 day"));
                $to = date("Y-m-d", strtotime($to . " +1 day"));
                $toofrom  = date("Y-m-d", strtotime($to . " -1 day"));
            
            $data['sta_id']=$state_id;
            $data['pro']=$product;
            $data['ar']=$franchise_code;
            $data['fra_id']=$franchise_id;
            $data['per']=$period_id;
            $data['sch']=$school_id;
            $data['cla']=$class;
            $data['fro']=$from;
            $data['too']=$to;
            $data['tofrom']=$toofrom;
            $data['extract']=$this->input->post('status_extract');
            $data['level'] = $level;
            
            $data['student']=$this->franchisemodel->cin_list_export_new($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to,$status_extract,$level); 
             
            
       }
       if(isset($_POST['export'])){
            $state_id = $this->input->post('sta_id');
	        $product = $this->input->post('pro');
	        //$district_id = $this->input->post('district_id');
	        $franchise_code = $this->input->post('ar');
	        $franchise_id = $this->input->post('fra_id');
            $period_id = $this->input->post('per');
            $school_id = $this->input->post('sch');
            $class = $this->input->post('cla');
            $from=$this->input->post('fro');
            $too=$this->input->post('too');
            $to = date("Y-m-d", strtotime($too . " +1 day"));
            $status_extract = $this->input->post('extract');   
            $level =  $this->input->post('level');
            $student=$this->franchisemodel->cin_list_export_new($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to,$status_extract,$level); 
             //print_r($data['student']);die;
               $n=1;
           //echo $status;die;
		  foreach($student as $item)
		  {
		      $state_subdivision_name = $this->db->get_where('states',array('state_subdivision_id'=>$item['state_id']))->row()->state_subdivision_name;
                 $franchise_name = $this->db->get_where('franchise',array('franchise_id'=>$item['franchise_id']))->row()->username;            
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'],
        			   $item['stud_email'],
        			   $franchise_name,
        			   $item['product_name'],
        			   $item['amount'],
        			   $item['time'],
        			   $item['school_name'].' - '.$item['school_address'] ,
        			   
        			   $state_subdivision_name
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"cin_file".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Franchise Name','Product name','Amount','Time','School','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
       }
       $this->load->view('cin_list_export',$data);
   }
   
   
    //     public function cin_list_latest()
    //     {
    //       if(isset($_POST['submit'])){
    //           //print_r($_POST);die;
    //           $from=$_POST['from_date'];
               
    //           $to = date("Y-m-d", strtotime(date('Y-m-d') . " +1 day"));
    //             $this->db->select('*');
    // 		    $this->db->from('study_material_byprid');
    // 		    $this->db->join('students','students.PRID=study_material_byprid.prid');
    // 		    $this->db->join('school_new','school_new.school_code=students.school_code');
    // 		    $this->db->where('study_material_byprid.time BETWEEN "'.$from.'" AND "'.$to.'"');
    		    
    // 		    $res = $this->db->get()->result_array();
    		   
    // 		    //echo $this->db->last_query();die;
    //             $data['student']=$res;
    //              $data['dateto']=$_POST['from_date'];
    //     //         $this->db->select('new_cart.cin,new_cart.product_name,new_cart.amount,new_cart.clevel,new_cart.period_id,new_cart.study_material,new_cart.orientation,new_cart.mock_test,new_cart.time,cin_list.student_name,cin_list.stud_email,cin_list.class,cin_list.stud_phone,cin_list.school_name,cin_list.school_address1,school_new.area_code,school_new.school_name as school_name2,');
    // 		  //  $this->db->from('new_cart');
    // 		  //  $this->db->join('cin_list','new_cart.cin=cin_list.cin');
    // 		  //  $this->db->join('school_new','school_new.id=cin_list.school_id','left');
    // 		  //   $this->db->where('new_cart.time BETWEEN "'.$from.'" AND "'.$to.'"');
    //     //         $data['Registrationdata']= $this->db->get()->result_array();
    //             //print_r($result4);die;
               
    //       }else{
    //             $this->db->select('*');
    // 		    $this->db->from('study_material_byprid');
    // 		    $this->db->join('students','students.PRID=study_material_byprid.prid');
    // 		    $this->db->join('school_new','school_new.school_code=students.school_code');
    // 		    $this->db->where('study_material_byprid.time',date('Y-m-d'));
    // 		    $res = $this->db->get()->result_array();
    //             $data['student']=$res;
                
                
    //       }
           
           
           
    //       $this->load->view('cin_list_export_latest',$data);
    //   }
   
    public function cin_list_latest()
    {
        if (isset($_POST['submit'])) {
    
            $from = $_POST['from_date'];
    
            // Selected date till today
            $to = date('Y-m-d H:i:s');
    
        } else {
    
            // Default: today only
            $from = date('Y-m-d');
            $to   = date('Y-m-d H:i:s');
        }
    
        $this->db->select('
            new_cart.id,
            new_cart.cin,
            new_cart.product_name,
            new_cart.amount,
            new_cart.Time,
    
            cin_list.student_name AS student_name,
            cin_list.stud_phone AS mobile,
            cin_list.stud_email AS email,
            cin_list.class AS student_class,
    
            school_new.school_name AS school_name,
            school_new.area_code AS area_code
        ');
    
        $this->db->from('new_cart');
    
        $this->db->join(
            'cin_list',
            'cin_list.cin = new_cart.cin',
            'left'
        );
    
        $this->db->join(
            'school_new',
            'school_new.id = cin_list.school_id',
            'left'
        );
    
        // Selected date 00:00:00 onwards
        $this->db->where(
            'new_cart.Time >=',
            $from . ' 00:00:00'
        );
    
        // Till current time
        $this->db->where(
            'new_cart.Time <=',
            $to
        );
    
        $this->db->order_by('new_cart.Time', 'DESC');
    
        $res = $this->db->get()->result_array();
    
        $data['student'] = $res;
        $data['dateto']  = $from;
    
        $this->load->view('cin_list_export_latest', $data);
    }


    public function cin_list_export_offline()
    {
        if(isset($_POST['submit'])){
            //print_r($_POST);die;
            $state_id = $this->input->post('state_id');
	        $product = $this->input->post('product');
	        $district_id = $this->input->post('district_id');
	        $franchise_code = $this->input->post('area');
	        $franchise_id = $this->input->post('franchise_id');
            $period_id = $this->input->post('period');
            $school_id = $this->input->post('school');
            $class = $this->input->post('class');
            $from=$this->input->post('fro');
            $to=$this->input->post('too');
             $to = date("Y-m-d", strtotime($to . " +1 day"));
            $data['sta_id']=$state_id;
            $data['pro']=$product;
            $data['ar']=$franchise_code;
            $data['fra_id']=$franchise_id;
            $data['per']=$period_id;
            $data['sch']=$school_id;
            $data['cla']=$class;
            $data['fro']=$from;
            $data['too']=$to;
           
            
            $data['student']=$this->franchisemodel->cin_list_export_new_offline($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to); 
           
       }
       
       if(isset($_POST['export'])){
            $state_id = $this->input->post('sta_id');
	        $product = $this->input->post('pro');
	        //$district_id = $this->input->post('district_id');
	        $franchise_code = $this->input->post('ar');
	        $franchise_id = $this->input->post('fra_id');
            $period_id = $this->input->post('per');
            $school_id = $this->input->post('sch');
            $class = $this->input->post('cla');
            $from=$this->input->post('fro');
            $to=$this->input->post('too');
           $student=$this->franchisemodel->cin_list_export_new_offline($state_id,$franchise_code,$franchise_id,$period_id,$school_id,$class,$product,$from,$to); 
               $n=1;
          // echo $status;die;
		  foreach($student as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['amount'],
        			   $item['time'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   
        			   $item['state_subdivision_name']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"cin_file".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','Amount','Time','School','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
       }
       
       
        $this->load->view('cin_list_export_all',$data);
    }
    
    
    public function zoomzoom_export()
    {
       if(isset($_POST['submit'])){
            //print_r($_POST);die;
            $level = $this->input->post('level');
            $school = $this->input->post('school');
            $class = $this->input->post('class');
            
            $data['lev']=$level;
            $data['sch']=$school;
            $data['cla']=$class;
            $data['student']=$this->franchisemodel->zoomzoom_export_new($school,$class,$level); 
            
            
       }
       if(isset($_POST['export'])){
            $level = $this->input->post('lev');
            $school = $this->input->post('sch');
            $class = $this->input->post('cla');
           $student=$this->franchisemodel->zoomzoom_export_new($school,$class,$level); 
               $n=1;
          // echo $status;die;
         // print_r($student);die;
		  foreach($student as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['zoomzoom_prid'] ,
        			   $item['frist_name'].' '.$item['middle_name'].' '.$item['last_name'],
        			   $item['address_line'].' - '.$item['city'].' - '.$item['state'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['mobile'],
        			   $item['email'],
        			   //$item['product_name'],
        			   $item['amount'],
        			   $item['Time'],
        			   $item['school_name'].' - '.$item['school_address'] ,
        			   $item['state']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"cin_file".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Amount','Time','School','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
       }
       $this->load->view('zoomzoom_cin',$data);
   }
   
   
    public function Addarea()
    {
	  
     $this->load->view('Addarea',$data);      
    }
   
   
    public function genrateAreaCode()
    { 
	  
       
    	$state_id = $this->input->post('state_id');
    	$country_id = $this->input->post('country_id');
    	$district_id = $this->input->post('district_id');
    	$area = $this->input->post('area');
    	
    	
    	$this->db->get_where('areas',array('state_id' =>$state_id))->row();
    	$this->db->select_max('area_code');
        $this->db->where('state_id', $state_id);   
        $max_areaid = $this->db->get('areas')->row(); 
    	
    	$state_inital = $this->db->get_where('states',array('state_subdivision_id' =>$state_id))->row();
    
    	//print_r($state_inital);exit; 
        if($max_areaid->area_code){
            $first_half = substr($max_areaid->area_code,0,2);
            $last_half = substr($max_areaid->area_code,2,5)+1;
    		$code = $first_half.$last_half;
    	}else{
    		
    		$contant = 1; 
    		$initial = $state_inital->initials;
    		$code = $initial.$contant;
    	}
		
		$array = array(
		
			'state_id' => $state_id,
			'country_id' => $country_id,
			'district_id' => $district_id,
			'city_name' =>  $area,
			'area_code' =>$code
			);
	 $this->db->insert('areas',$array);
    redirect('manage/franchise/listAreacode');	 
		
   }	
   
   
	public function listAreacode()
	{
		$this->db->select('*');
		$this->db->from('areas');
		$this->db->join('states','states.state_subdivision_id=areas.state_id');
		$this->db->join('countries','countries.country_id=areas.country_id');
		$res = $this->db->get();
		$data['result']= $res->result_array();
		$this->load->view('listareacode.php',$data);
	}


	public function AreaEdit()
	{
	 	 if(isset($_POST['submit']))
	 	 {
	 	     
	 	     	$state_id = $this->input->post('state_id');
            	$country_id = $this->input->post('country_id');
            	$district_id = $this->input->post('district_id');
            	$area = $this->input->post('area');
	 	     
	 	    	$array = array(
		
			//'state_id' => $state_id,
		   //'country_id' => $country_id,
		  //'district_id' => $district_id,
			'city_name' =>  $area
			//'area_code' =>$code
			);
	    $this->db->where('id',$id);
	    $this->db->update('areas',$array);
	    redirect('manage/franchise/listAreacode');
	 	 }
	 	$id= $this->uri->segment(4);
	 	$data['areadata'] = $this->db->get_where('areas',array('id'=>$id))->row();
		$this->load->view('areaEdit',$data);
	}
	 
	 
	public function AreaDelete()
	{
		
		$id= $this->uri->segment(4);
		$this->db->where('id',$id);
		$this->db->delete('areas');
		redirect('manage/franchise/listAreacode');
		
	}
	 
	 
	public function Cin_extract()
	{
	   //  echo 'ok';die;
	   if(isset($_POST['submit'])){
	       extract($_POST);
	       //print_r($_POST);die;
	       $data['student'] = $this->franchisemodel->extract_cin_student($_POST); 
	       //print_r($data['student']);die;
	       $data['result']=$_POST;
	       	if(empty($data['student'])){
    	        $data['message']='No student is found with selected parameters.';
    	    }else
    	    {
    	        $data['message']='';
    	    }
    	    
	   }
	   
	   if(isset($_POST['Export'])){
	       //print_r($_POST);die;
	       $orientation = $this->franchisemodel->extract_cin_student($_POST);
	       //echo count($orientation);
	       //print_r($orientation);die;
	       
	       $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $status='Competition Registered',
        			   $item['state_subdivision_name']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name='Competition_'.$item['state_subdivision_name'].'_'.$item['product_name'].'_'.$item['level_name'];
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School','Registration','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	   }
	   
	   
	    $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		if(isset($data['result']['product'])){
		    $this->db->where('product_name',$data['result']['product']);
		}
		$resss = $this->db->get();
	    $data['levelload']= $resss->result_array();
	  // $data['levelload'] = $this->db->get_where('competition_level_byproduct')->result_array();
	    $data['productload'] = $this->db->get_where('products')->result_array();
	    $data['classload'] = $this->db->get_where('class')->result_array();
	   //$data['classload'] = $this->db->get_where('class')->result_array();
	   
	    $this->db->select('school_name,school_address1');
		$this->db->from('cin_list');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$this->db->where('period_id','12');
		$this->db->group_by('school_name');
		$res = $this->db->get();
	    $data['schoolload']= $res->result_array();
	   
	    $this->db->select('*');
		$this->db->from('areas');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$ress = $this->db->get();
	    $data['areaload'] = $ress->result_array();
	   
	    $this->load->view('cin_student_list.php',$data);
	 }
	 
	 
	public function Cin_extract_orientation()
	{
	   //  echo 'ok';die;
	   if(isset($_POST['submit'])){
	       //extract($_POST);
	       //print_r($_POST);die;
	       $data['student'] = $this->franchisemodel->extract_orientation_student($_POST); 
	       $data['result']=$_POST;
    	    if(empty($data['student'])){
    	        $data['message']='No student is found with selected parameters.';
    	    }
	   }
	   
	   if(isset($_POST['Export'])){
	       //print_r($_POST);die;
	       $orientation = $this->franchisemodel->extract_orientation_student($_POST); 
	       
	       //print_r($_POST['sta']);die;
	       if($_POST['status']=='A'){$status='Orientation-A Registered';}if($_POST['status']=='B'){$status='Orientation-B Registered';}
	       
	       $n=1;
        //   echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $status,
        			   $item['state_subdivision_name']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;
			$file_name=$item['product_name'].'_'.$item['state_subdivision_name'].'_'.$status.'_'.$item['level_name'];
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School','Orientation','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
	       
	   }
	   
	   $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		if(isset($data['result']['product'])){
		    $this->db->where('product_name',$data['result']['product']);
		}
		$resss = $this->db->get();
	    $data['levelload']= $resss->result_array();
	  // $data['levelload'] = $this->db->get_where('competition_level_byproduct')->result_array();
	    $data['productload'] = $this->db->get_where('products')->result_array();
	    $data['classload'] = $this->db->get_where('class')->result_array();
	   //$data['classload'] = $this->db->get_where('class')->result_array();
	   
	    $this->db->select('school_name,school_address1');
		$this->db->from('cin_list');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$this->db->where('period_id','12');
		$this->db->group_by('school_name');
		$res = $this->db->get();
	    $data['schoolload']= $res->result_array();
	   
	    $this->db->select('*');
		$this->db->from('areas');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$ress = $this->db->get();
	    $data['areaload'] = $ress->result_array();
	   
	     $this->load->view('cin_student_list_.php',$data);
	 }
	 
	 
	public function Cin_extract_mock()
	{
	     
	       if(isset($_POST['submit'])){
	       //extract($_POST);
	      // print_r($_POST);die;
	       $data['student'] = $this->franchisemodel->extract_mock_student($_POST); 
	       $data['result']=$_POST;
	       if(empty($data['student'])){
    	        $data['message']='No student is found with selected parameters.';
    	    }
	   }
	   
	   if(isset($_POST['Export'])){
	       //print_r($_POST);die;
	       $orientation = $this->franchisemodel->extract_mock_student($_POST); 
	     //  print_r($_POST['sta']=='A');die;
	      if($_POST['status']=='A' or $_POST['status']=='1'){$status='Mock-test A Registered';}if($_POST['status']=='B' or $_POST['status']=='2'){$status='Mock-test B Registered';}
	       $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $status,
        			   $item['state_subdivision_name']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name=$item['product_name'].'_'.$item['state_subdivision_name'].'_'.$status.'_'.$item['level_name'];
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School','Mock Test','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
	       
	   }
	   
	    $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		if(isset($data['result']['product'])){
		    $this->db->where('product_name',$data['result']['product']);
		}
		$resss = $this->db->get();
	    $data['levelload']= $resss->result_array();
	  // $data['levelload'] = $this->db->get_where('competition_level_byproduct')->result_array();
	    $data['productload'] = $this->db->get_where('products')->result_array();
	    $data['classload'] = $this->db->get_where('class')->result_array();
	   //$data['classload'] = $this->db->get_where('class')->result_array();
	   
	    $this->db->select('school_name,school_address1');
		$this->db->from('cin_list');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$this->db->where('period_id','12');
		$this->db->group_by('school_name');
		$res = $this->db->get();
	    $data['schoolload']= $res->result_array();
	   
	    $this->db->select('*');
		$this->db->from('areas');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$ress = $this->db->get();
	    $data['areaload'] = $ress->result_array();
	   
	     $this->load->view('cin_student_list___.php',$data);
	     
	 }
	 
	 
	public function Cin_extract_material()
	{
	     
	   if(isset($_POST['submit'])){
	       extract($_POST);
	       //print_r($_POST);die;
	       $data['student'] = $this->franchisemodel->extract_material_student($_POST); 
	       $data['result']=$_POST;
	       if(empty($data['student'])){
    	        $data['message']='No student is found with selected parameters.';
    	    }else{
    	        $data['message']='';
    	    }
	   }
	   
	   if(isset($_POST['Export'])){
	       //print_r($_POST);die;
	       $orientation = $this->franchisemodel->extract_material_student($_POST); 
	      // print_r($orientation);die;
	      if($_POST['status']=='A'){$status='Material A Registered';}if($_POST['status']=='B'){$status='Material B Registered';}if($_POST['status']=='C'){$status='Material C Registered';}
	       $n=1;
          // echo $status;die;
		  foreach($orientation as $item)
		  {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['address1'].' - '.$item['address2'],
        			   $item['class'],
        			   $item['father_name'],
        			   $item['mother_name'],
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['product_name'],
        			   $item['school_name'].' - '.$item['school_address1'] ,
        			   $status,
        			   $item['state_subdivision_name']
        			   
        			   
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name=$item['state_subdivision_name'].'_'.$status.'_'.$item['l_name'];
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','CIN','Student Name','Student Address','Class','Father Name','Mother Name','Mobile','Email','Product name','School','Material','State'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       
	       
	       
	   }
	    $data['stateload'] = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
	    $this->db->select('*');
		$this->db->from('competition_level_byproduct');
		if(isset($data['result']['product'])){
		    $this->db->where('product_name',$data['result']['product']);
		}
		$resss = $this->db->get();
	    $data['levelload']= $resss->result_array();
	  // $data['levelload'] = $this->db->get_where('competition_level_byproduct')->result_array();
	    $data['productload'] = $this->db->get_where('products')->result_array();
	    $data['classload'] = $this->db->get_where('class')->result_array();
	   //$data['classload'] = $this->db->get_where('class')->result_array();
	   
	    $this->db->select('school_name,school_address1');
		$this->db->from('cin_list');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$this->db->where('period_id','12');
		$this->db->group_by('school_name');
		$res = $this->db->get();
	    $data['schoolload']= $res->result_array();
	   
	    $this->db->select('*');
		$this->db->from('areas');
		if(isset($data['result']['state_id'])){
		    $this->db->where('state_id',$data['result']['state_id']);
		}
		$ress = $this->db->get();
	    $data['areaload'] = $ress->result_array();
	   $this->load->view('cin_student_list__.php',$data);
	     
	 }
	 
	 
	public function area_assign_franchise()
	{
	     
	      $area_id = $this->uri->segment('4');
	      $state_id= $this->db->get_where('areas',array('id'=>$area_id))->row()->state_id;
	     
	    if(isset($_POST['submit'])){
	         $franchise_id = $_POST['frachise'];
	         
           foreach($franchise_id as $value){
               //print_r($value);exit;
               $array = array(
                   'franchise_id'=>$value,
                   'area_id'     =>$area_id,
                   'status'      =>'Active'
                   );
                   $this->db->insert('area_to_franchise',$array);
               
           }
          $this->session->set_flashdata('success', 'Area assign successfully');
         	redirect('manage/franchise/listAreacode');
	    }
	        
	        
	    $data['franchise']= $this->db->get_where('franchise',array('state_id'=>$state_id))->result_array();
	    $this->load->view('area_assign_franchise.php',$data);
	}
	 
	 
    public function deletecin()
	{
	    
	     $id = $this->uri->segment(4);
	     
	     $schid = $this->uri->segment(5);
	     
	     $cin = $this->db->get_where('cin_list',array('cin'=>$id))->row()->cin;
	      
	     $this->db->where('cin', $cin);
	     $this->db->delete('cin_result');
	     
	     $this->db->where('id', $id);
	     $this->db->delete('cin_list');
	     
	   redirect('manage/franchise/cin_list/' . $schid);
	 }
	 
	
	public function schoolAssignToProduct() 
    {
          
     //echo 'saasa';die;
                    $product = $this->db->order_by('product_name')->get_where('products',array('status'=>'Active'))->result_array();
                    
                        
                        
                            
                           $school=  $this->db->query("select * from school_new where state='14683' and id > 854;")->result_array();
                            foreach($school as $val){
                                
                               $array = array(
                         'product_id' =>'28',
                         'school_id' =>$val['id'],
                         'school_code' =>$val['school_code'],
                         'pricecode_id' =>'109'
                         );
                         
                         $this->db->insert('product_to_school',$array);   
                            
                          
                        }
                        
        
      
       $this->load->view("schoolAssignToProduct.php", $data);
    }
    
    
    public function cin_delete()
    {
		
		if(isset($_POST['submit'])) {
	      
    
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row=2;/*skip first 2 heading rows */
    		$i=0;
		
    		if($_FILES['csv']['size'] > 0) 
    		{   
				  
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
    					{ 
    					    //echo "<br>"; echo $i ."-". $resultRow_from_csv[0];die;
    					    
    					   if($resultRow_from_csv[0]) 
    					   { 
    					       
    						
    						  $cin            =  addslashes($resultRow_from_csv[0]);
    						  //echo $cin;die;
    						  $this->db->where('cin',$cin);
    						  $this->db->delete('cin_list');
    						 
    						  $this->db->where('cin',$cin);
    						  $this->db->delete('cin_result');
    						  //echo 'ok';die;
    						  $csv_upload_status=[$cin,'CIN Deleted Successfully'];
    						  
    						  array_push($csvResult_upolad_logArray,$csv_upload_status);
    						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
    						   
    						   array_push($csvResult_upolad_logArray,$csv_upload_status);
    					   }/*End if*/
    					   
    					  }
    					  
    				    $i=$i+1;	
				  
				    }while($resultRow_from_csv = fgetcsv($handle,1000));
				 
				        /*while($resultRow_from_csv = fgetcsv($handle,1000,",","'"));*/
				  
					    /*............ End Do while ................*/
					    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
					    /*unset($_FILES);*/
						$this->notifications->notify('CIN Deleated Successfully','success');
						redirect('/manage/franchise/cin_delete');	
					 
				    }    /*END OF TYPE CHECKING*/
			    else
				{
						$this->notifications->notify('Not a csv file ','error');
				}/*END OF ELSE TYPE CHECKING*/
					   
				  
				  
					  
			}/* End if */
			   
		}

		$this->load->view("cin_delete.php",$data);  
	}
   
   
	public function RegsByLevel()
	{
        
        if(isset($_POST['submit'])){
            // print_r($_POST);die;
            foreach($_POST['schools'] as $school){
                
                foreach($_POST['products'] as $product){
                    $ar=array(
                    'school_id'=>$school,
                    'product_name'=>$product,
                    'period_id'=>'14',
                    'school_amount'=>$_POST['school_amount'],
                    'amount'=>$_POST['amount'],
                    'franchise_per'=>$_POST['franchise_id'],
                    'franchise_id'=>$_POST['franchise_cut']
                    );
                    
                     $this->db->insert('product_to_school',$ar);
                }
            }
           
           $data['message']='Products assigned to school successfully ...';
            
        }
        $data['productload'] = $this->db->get_where('products',array('status'=>'Active'))->result_array();
        $data['pricecodes'] = $this->db->get_where('price_code',array('status'=>'Active'))->result_array();
        
            if(isset($data['result']['state_id'])){
                $data['franchise2'] = $this->db->get_where('franchise',array('state_id'=>$data['result']['state_id']))->result_array();
            }
        
            if(isset($data['result']['country'])){
                $data['stateload'] = $this->db->get_where('states',array('country_id'=>$data['result']['country']))->result_array();
            }
            
        if(isset($data['result']['franchise_id'])){
            $this->db->select('*');
            $this->db->from('areas');
            $this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
            $this->db->where('area_to_franchise.franchise_id',$data['result']['franchise_id']);
            $query=$this->db->get();
            $data['areaload'] = $query->result_array();
        }
        
        $this->load->view("RegsByLevel",$data);
    }
    
    
    public function cin_profile_update_()
    {
		
		if(isset($_POST['submit'])) {
	        $data['result']=$_POST;
    	    $product = $this->input->post('product');
    		$franchise_id = $this->input->post('franchise_id');
    		$school = $this->input->post('school');
    		//print_r($_POST);exit; 
    		$level = $this->input->post('1');
    		$period = $this->input->post('period');
    		$stat = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
    		$state_id = $this->input->post('state_id');
    		$country_id = $this->input->post('country');
    		$area_code = $this->input->post('area');
    		
    		
    		$csvResult_upolad_logArray = array();
    		$start_cell_row = 2;
    		
    		
    		$i = 1;
		    $count = 0;
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
					if($i <= $start_cell_row)
					{ 
					   // echo "<br>"; echo $i ."-". $resultRow_from_csv[0];echo 'okk';die;
					   if($resultRow_from_csv[0]) 
					   { 
						        $cin            = addslashes($resultRow_from_csv[0]);
                                $stud_name      = addslashes($resultRow_from_csv[1]);
                                $class          = addslashes($resultRow_from_csv[2]);
                                $mobile_number  = addslashes($resultRow_from_csv[3]);  
                                $email          = addslashes($resultRow_from_csv[4]);
                                
                                // Map the class to the class ID
                                $class_id = null;
                                if ($class == 'Nursery') { $class_id = 1; }
                                if ($class == 'LKG') { $class_id = 2; }
                                if ($class == 'UKG') { $class_id = 3; }
                                if ($class == 'Class-1') { $class_id = 4; }
                                if ($class == 'Class-2') { $class_id = 5; }
                                if ($class == 'Class-3') { $class_id = 6; }
                                if ($class == 'Class-4') { $class_id = 7; }
                                if ($class == 'Class-5') { $class_id = 8; }
                                if ($class == 'Class-6') { $class_id = 9; }
                                if ($class == 'Class-7') { $class_id = 10; }
                                if ($class == 'Class-8') { $class_id = 11; }
                                if ($class == 'Class-9') { $class_id = 12; }
                                if ($class == 'Class-10') { $class_id = 13; }
                                if ($class == 'Class-11') { $class_id = 14; }
                                if ($class == 'Class-12') { $class_id = 15; }
                                
                                // Create the array conditionally, only including non-null values
                                $csv = array();
                                
                                if (!empty($stud_name)) {
                                    $csv['student_name'] = $stud_name;
                                }
                                
                                if (!empty($email)) {
                                    $csv['stud_email'] = $email;
                                }
                                
                                if (!empty($mobile_number)) {
                                    $csv['stud_phone'] = $mobile_number;
                                }
                                
                                if (!empty($class)) {
                                    $csv['class'] = $class;
                                }
                                
                                if (!is_null($class_id)) {
                                    $csv['class_id'] = $class_id;
                                    $csv['category_id'] = $class_id;  // Assuming category_id is the same as class_id
                                }
                                
                                // print_r($csv);die;
                                
                                if (!empty($csv)) {
                                    $this->db->where('cin', $cin);                    
                                    $this->db->update('cin_list', $csv);  
                                    $csv_upload_status ='Profile Updated for CIN '.$cin;
                                    $data['count']=$count+1;
                                }else{
                                    $csv_upload_status ='Profile Not Updated for CIN '.$cin;
                                }
                                				 
						  //print_r($csv_result_array);echo $product.'ok';die; 
						  
						  
						  // $csv_upload_status = $this->franchisemodel->generate_cin($csv_result_array,$product); 
						   array_push($csvResult_upolad_logArray,$csv_upload_status);
						   //echo "<pre>";print_r($csvResult_upolad_logArray);exit;
						   
						   //array_push($csvResult_upolad_logArray,$csv_upload_status);
					   }/*End if*/
					   
					  }
				    $i=$i+1;	
			        }while($resultRow_from_csv = fgetcsv($handle,1000));
			 
			 
				    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
				   /*unset($_FILES);*/
					$this->notifications->notify('CIN Generated Successfully','success');
				// 	redirect('manage/franchise/cin_list');	
				 
			    }    /*END OF TYPE CHECKING*/
				else
				{
						$this->notifications->notify('Not a csv file ','error');
				}/*END OF ELSE TYPE CHECKING*/
					   
				  
				  
					  
			}/* End if */
		}


        
          
		$this->load->view("cin_profile_update.php",$data);  
		
	}
	 
	 
	public function cin_profile_update()
    {
		


        if (isset($_POST['submit'])) {

            $csvResult_upolad_logArray = [];
        
            if (!empty($_FILES['csv']['tmp_name'])) {
        
                $file   = $_FILES['csv']['tmp_name'];
                $handle = fopen($file, "r");
                $ext    = strtolower(pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION));
        
                if ($ext === 'csv') {
        
                    $i = 1;
        
                    while (($resultRow_from_csv = fgetcsv($handle, 1000)) !== false) {
        
                        // Skip header
                        if ($i == 1) {
                            $i++;
                            continue;
                        }
        
                        // CIN mandatory
                        if (empty($resultRow_from_csv[0])) {
                            $i++;
                            continue;
                        }
        
                        $logRow = $resultRow_from_csv;
        
                        $cin           = trim($resultRow_from_csv[0]);
                        $class         = trim($resultRow_from_csv[2]);
                        $stud_name     = trim($resultRow_from_csv[1]);
                        $mobile_number = trim($resultRow_from_csv[3]);
                        $email         = trim($resultRow_from_csv[4]);
                        $school_code   = trim($resultRow_from_csv[5]);
        
                        // Class mapping
                        $classMap = [
                            'Nursery'  => 1, 'LKG' => 2, 'UKG' => 3,
                            'Class-1'  => 4, 'Class-2' => 5, 'Class-3' => 6,
                            'Class-4'  => 7, 'Class-5' => 8, 'Class-6' => 9,
                            'Class-7'  => 10,'Class-8' => 11,'Class-9' => 12,
                            'Class-10' => 13,'Class-11'=> 14,'Class-12'=> 15
                        ];
        
                        $class_id = isset($classMap[$class]) ? $classMap[$class] : null;
        
                        // Build CSV data (only filled)
                        $csv = [];
        
                        if ($stud_name !== '')     $csv['student_name'] = $stud_name;
                        if ($email !== '')         $csv['stud_email']   = $email;
                        if ($mobile_number !== '') $csv['stud_phone']   = $mobile_number;
                        if ($class !== '')         $csv['class']        = $class;
        
                        if ($class_id !== null) {
                            $csv['class_id']    = $class_id;
                            $csv['category_id'] = $class_id;
                        }
        
                        if ($school_code !== '') {
                            $school = $this->db
                                ->get_where('school_new', ['school_code' => $school_code])
                                ->row();
                            if (!empty($school)) {
                                $csv['school_id'] = $school->id ?? '';
                            }
                        }
        
                        $status = 'Not Updated on MaRRS';
                        $logRow[8] = 'red';
        
                        
                
                        if (!empty($csv)) {
        
                            // ✅ Build PAY only from allowed + filled keys
                            $pay = array_intersect_key($csv, array_flip([
                                'student_name',
                                'stud_email',
                                'stud_phone',
                                'class',
                                'school_id',
                                'class_id',
                                'category_id'
                            ]));
        
                            $pay = array_filter($pay, function ($v) {
                                return $v !== '' && $v !== null;
                            });
                            
                            if (!empty($pay)) {
                                
                                $this->db->where('cin', $cin);
                                $this->db->update('cin_list', $pay);
        
                                if ($this->db->affected_rows() > 0) {
                                    $status = 'Updated on MaRRS';
                                    $logRow[8] = 'green';
                                    $logRow[9] = $pay;
                                } else {
                                    $logRow[8] = 'fuchsia';
                                    $status = 'MaRRS update failed / no changes';
                                }
                            }
        
                            // Fetch updated data
                            $student = $this->db
                                ->get_where('cin_list', ['cin' => $cin])
                                ->row();
        
                            $student_result = $this->db
                                ->get_where('cin_result', ['cin' => $cin])
                                ->row();
        
                            $period = $this->db
                                ->get_where('period', ['period_id' => $student->period_id])
                                ->row();
        
                            if (!empty($student->school_name)) {
                                $school_name = $student->school_name;
                            } else {
                                $studentSchool = $this->db
                                    ->get_where('school_new', ['id' => $student->school_id])
                                    ->row();
                                $school_name = $studentSchool->school_name;
                            }
        
                            // Payload (safe access)
                            $payload = [
                                'profile' => [
                                    'student_name' => isset($csv['student_name']) ? $csv['student_name'] : '',
                                    'email'        => isset($csv['stud_email']) ? $csv['stud_email'] : '',
                                    'phone_no'     => isset($csv['stud_phone']) ? $csv['stud_phone'] : '',
                                    'cin'          => $cin,
                                    'school'       => $school_name,
                                    'class'        => isset($csv['class']) ? $csv['class'] : ''
                                ],
                                'registration' => [
                                    'product_name' => $student_result->product_name,
                                    'com_level'    => 'school_level',
                                    'period_id'    => $period->period_name,
                                    'test_status'  => 'Registered',
                                    'status'       => 'Active',
                                    'test_startDate'=> '2026-01-07',
                                    'test_endDate'  => '2026-01-07'
                                ]
                            ];
        
                            $syncResult = $this->sync_to_grademarker($payload);
        
                            if (!empty($syncResult) && isset($syncResult['status'])) {
                                $logRow[7] = ($syncResult['status'] == 1) ? 'green' : 'red';
                                $logRow[5] = $syncResult['message'];
                            }
                        }
        
                        $logRow[6] = $status;
                        $csvResult_upolad_logArray[] = $logRow;
                        $i++;
                    }
        
                    fclose($handle);
                    $data['csvResult_upoload_logArray'] = $csvResult_upolad_logArray;
                }
            }
            
        }






	    $this->load->view("cin_profile_update.php",$data);  
	}
	
	
	private function sync_to_grademarker($payload)
    {
        $ch = curl_init();
    
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://grademarker.online/api/profile_update',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 10,
        ]);
    
        $response = curl_exec($ch);
    
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'status' => 0,
                'error'  => $error
            ];
        }
    
        curl_close($ch);
        return json_decode($response, true);
    }

	
	private function sync_to_grademarker_($payload)
    {
        $ch = curl_init();
    
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://grademarker.online/api/profile_update',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 10,
        ]);
    
        $response = curl_exec($ch);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                return [
                    'status' => 0,
                    'error'  => $error
                ];
            }
        
            curl_close($ch);
        
            return json_decode($response, true);
        }
        
        
    public function adminSchoolBulkDelete()
    {
        $ids = $this->input->post('ids'); // array
    
        if (empty($ids) || !is_array($ids)) {
            echo json_encode(['status' => false, 'message' => 'No schools selected.']);
            return;
        }
    
        // sanitize to integers only
        $ids = array_filter(array_map('intval', $ids));
    
        if (empty($ids)) {
            echo json_encode(['status' => false, 'message' => 'Invalid school IDs.']);
            return;
        }
    
        $this->db->trans_start();
    
        // mirror whatever your single adminSchooldelete does —
        // soft delete shown here as example; swap for your real logic
        $this->db->where_in('id', $ids)
                 ->update('school_new', ['school_status' => 'Deleted']);
    
        // if you also need to clean up dependent rows (e.g. product_to_school), do it here
        // $this->db->where_in('school_id', $ids)->delete('product_to_school');
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === false) {
            echo json_encode(['status' => false, 'message' => 'Bulk delete failed.']);
            return;
        }
    
        echo json_encode([
            'status'      => true,
            'message'     => count($ids) . ' school(s) deleted successfully.',
            'deleted_ids' => $ids
        ]);
    }
    	
    	
    public function clear_cart()
	{
	
    	if (isset($_POST['submit'])) {


            $cin = $_POST['cin'];
            
            $exist = $this->db
                ->get_where('amount_cart', array(
                    'cin' => $cin
                ))
                ->row();
        
            if (!empty($exist)) {
        
                $this->db->where('cin', $cin);
                $deleted = $this->db->delete('amount_cart');
        
                if ($deleted) {
                    $this->notifications->notify(
                        'CIN Cart Cleared Successfully',
                        'success'
                    );
                } else {
                    $this->notifications->notify(
                        'Unable to clear CIN Cart',
                        'error'
                    );
                }
        
            } else {
        
                $this->notifications->notify(
                    'No Cart Found for this CIN',
                    'error'
                );
            }
        }
            
          
    	$this->load->view("clear_cart.php",$data);  
    	
    }
   
}