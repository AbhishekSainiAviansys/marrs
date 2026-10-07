<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class school extends CI_Controller {
    public function __construct() 
    {
        parent::__construct();
        if (!$this->session->userdata('franchise_id')) {
            redirect('franchise/login/', 'refresh');
        }
        $this->load->helper('text');
		$this->load->library('upload');
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->library('validation');
        $this->load->model('schoolmodel');
         $this->load->model('franchisemodel');
    }
	
 /* ------------------------------------------------------------------------- */  
    public function index() 
    {
       
        //echo $this->session->userdata('franchise_id');die;
        $franchise_id         = $this->session->userdata('franchise_id');
        //echo $franchise_id;die;
	    $data['franchise']  = $this->schoolmodel->getfranchise($franchise_id);
		//print_r($data);die;
		
        $this->load->view("productList.php",$data);
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
    
    public function school_activate()
    { 
       $franchise_id = $this->session->userdata('franchise_id');
       $state = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row()->state_id;
       
    //   echo $state;
       
       
       $data['schoolList'] = $this->db->get_where('school_new',array('state' =>$state))->result_array();
       
    //   $data['schoolList'] = $this->db->get_where('school_new',array('state' =>$state,'franchise_id' =>$franchise_id))->result_array();
       
       $data['open']=1;
       
       $this->load->view('schoolList',$data);
    }
 
    public function PrizeCode_genration() 
    {
        if(isset($_POST['submit'])){
            
           
            $year = date('y');
            $franchise_id = $this->session->userdata('franchise_id');
            $product_id = $this->input->post('product_id');
            $price =  $this->input->post('product_price');
            $prefix =$this->input->post('prefix');
            $franchise_code  =$this->input->post('franchise_code');
            $period = $this->input->post('period');
            $level = $this->input->post('level');
       
        
			         $productprice = $this->input->post('product_price');
			         $pricecode = $prefix.$year.$franchise_code.'-'.$productprice;
			         
			         	$this->db->select('price_code');
								$this->db->from('price_codegenration');
								$this->db->where('franchise_id',$franchise_id);
								$this->db->where('product_price',$price);
								$res = $this->db->get();
								$result = $res->row();
							    $pricode= $result->price_code;
			         
			         if($pricecode==$pricode){
			             $insert='0';
			         }else{
			             
			       	    $array = array(
					        'product_price' => $productprice,
					        'period_id' =>$period,
					        'franchise_id' =>$this->session->userdata('franchise_id'),
					        'price_code' =>$pricecode,
					        'level' => $level,
					        'status' =>	'Deactive'
					        );
		               $insert = $this->db->insert('price_codegenration',$array); 
			         }
         
             if($insert==1)
			 {
						     
                $this->notifications->notify('Pricecode Added Successfully ', 'success');
			 } 
			 else
			{
		    	$this->notifications->notify('This Pricecode Already Exit', 'error');
			}
			redirect('https://marrs.in/franchiselogin/franchise/school/PrizeCode_genration');
         
        }
        $data['result'] = $_POST;
        $this->load->view("prizecode_genration.php",$data);
   }
   
    public function PrizeCode_view($id='')
    { 
         $fid= $this->session->userdata('franchise_id'); 
       // print_r($fid);exit;
        $data['code']= $this->schoolmodel->codeView($fid);
        $this->load->view('price_code_viewListgenration',$data);
        
    }
    
    public function pricecodedelete($id='')
    {
        $uri= $this->uri->segment(4);
        $this->db->where('id',$uri);
        $this->db->delete('price_codegenration');
        redirect('franchise/school/PrizeCode_view');
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
      
         
   <?php }
 
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
         
       $data=file_get_contents('https://api.worldpostallocations.com/?postalcode='.$pincode.'&countrycode='.$country);
       $data=json_decode($data);
      // print_r($data->result[0]);exit;
       if(isset($data->result[0])){
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
    
    public function schoolaccees()
    {
        $uri = $this->uri->segment(4);
       // print_r($uri);
        $data['access_detail']=$this->schoolmodel->schoolAccess($uri);
         //print_r($data['access_detail']);die;
        if(isset($_POST['submit']))
        {
			   //print_r($_POST);exit;
			  $product_id =$this->input->post('product_id');
			    $price = $this->input->post('product_price');
			    
			  $school_board=  $this->input->post('school_board');
			  if($school_board=='other'){
			     
			        $school_board=$this->input->post('school_board2');
			  }else{
			     $school_board=$this->input->post('school_board');
			  }
			   // print_r($_POST);exit;
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$post_data      = array(
										'school_name' => $this->input->post('school_name'),
										'school_address' => $this->input->post('school_address'),
										'principal_first_name' => $this->input->post('principal_first_name'),
										'principal_last_name' => $this->input->post('principal_last_name'),
										'school_coordinator_first_name' => $this->input->post('school_coordinator_first_name'),
										'school_coordinator_last_name' => $this->input->post('school_coordinator_last_name'),
										'school_coordinator_email' => $this->input->post('school_coordinator_email'),
										'sh_coordinator_phone' => $this->input->post('school_coordinator_phone'),
										'country_id' => $this->input->post('country_id'),
										'stateID' => $this->input->post('stateID'),
										'school_city' => $this->input->post('school_city'),
										'school_district' => $this->input->post('school_district'),
										'school_phone' => $this->input->post('school_phone'),
										'school_mobile' => $this->input->post('school_mobile'),
										'school_email' => $this->input->post('school_email'),
										'school_board' => $school_board,
										'school_medium' => $this->input->post('school_medium'),
										'school_concern_status' => $this->input->post('school_concern_status'),
										'school_pincode' => $this->input->post('school_pincode'),
										'username' => 'MRS'.$this->input->post('principal_first_name'),
										'password' => 'MRS'.$this->input->post('principal_first_name'),
										'school_created_date' => $cdate,
									//	'franchise_id' => $franchise_id,
										'marrs_coordinator_first_name' =>$this->input->post('marrs_coordinator_first_name'),
										'marrs_coordinator_last_name' =>$this->input->post('marrs_coordinator_last_name'),
										'marrs_coordinator_email' =>$this->input->post('marrs_coordinator_email'),
										'marrs_coordinator_phone' =>$this->input->post('marrs_coordinator_phone')
				                );
				$this->validation->set_data($post_data);
				//print_r($post_data);exit;
				//$this->validation->set_rules('school_name', 'school name', 'required');
				$this->validation->set_rules('school_address', 'school address', 'required');
			//	$this->validation->set_rules('principal_first_name', 'principal name', 'required');
				$this->validation->set_rules('school_coordinator_first_name', 'school coordinator name', 'required');
				$this->validation->set_rules('school_coordinator_email', 'school coordinator email', 'required');
				//$this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
				$this->validation->set_rules('country_id', 'country', 'required');
				$this->validation->set_rules('stateID', 'state', 'required');
				$this->validation->set_rules('school_city', 'school city', 'required');
				//$this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
		  	//$this->validation->set_rules('school_phone', 'school phone', 'required');
				$this->validation->set_rules('school_mobile', 'school mobile', 'required');
				$this->validation->set_rules('school_email', 'school email', 'required');
				//$this->validation->set_rules('school_board', 'school board', 'required');
				$this->validation->set_rules('school_medium', 'school medium', 'required');
				//$this->validation->set_rules('school_concern_status', 'school concern status', 'required');
				$this->validation->set_rules('school_pincode', 'school pincode', 'required');
				//$this->validation->set_rules('school_latitude', 'school latitude', 'required');
			//	$this->validation->set_rules('school_longitude', 'school longitude', 'required');
			//	$this->validation->set_rules('school_created_date', 'school created date', 'required');
				
				$this->validation->set_data($post_data);
				 
				if ($this->validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
				} 
				else
				{
					$this->db->where('school_id',$uri);
					$db_status=$this->db->update('schools',$post_data);
					
					
						$product_id=$this->input->post('product_id');
					$price=$this->input->post('product_price');
					
					 foreach($product_id as $key=>$product){
					     
					   
					     
			         $productId = $product;
			         $productprice = $price[$key];
			       	    $array = array(
					        
					        'price_code' =>$productprice
					        
					        ); 
					        $this->db->where('school_id',$uri);
					        $this->db->where('product_id',$uri);
					        $this->db->update('price_code',$array);
					        
					         $arrayf = array(
					        
					        'price_code' => $productprice
					        
					        );
					         $this->db->where('school_id',$uri);
					        $this->db->where('product_id',$uri);
					        $this->db->update('filter',$arrayf);
			         }
			     	
				
					$product_id1=$this->input->post('product_id1');
					$price1=$this->input->post('product_price1');
					
					$this->db->select('franchise_id');
					$this->db->from('schools');
					$this->db->where('school_id',$uri);
					$res= $this->db->get();
					$results_fr = $res->row_array();
					
					$this->db->select('period_id');
					$this->db->from('period');
					$this->db->where('status','Active');
					$res = $this->db->get();
					$results1 = $res->row_array();
					
					if($product_id1 && $price1){
					 foreach($product_id1 as $key=>$product){
					    $productId_edit = $product;
			            $productprice1 = $price1[$key];
			             
			       	    $csv_filter_code = array('price_code'=>$productprice1,
                    				'period_id'=>$results1['period_id'],
                    				'product_id'=>$productId_edit,
                    				'franchise_id'=>$results_fr['franchise_id'],
                    				'school_id'=>$uri
                    				);
                   $ins_status= $this->db->insert('filter', $csv_filter_code);    
         
	               $csv_price_code = array(
	                                'price_code'=>$productprice1,
                    				'period_id'=>$results1['period'],
                    				'product_id'=>$productId_edit,
                    			
                    				'school_id'=>$uri,
                    				'status'=>'Active'
                    				);
                    				
		 
	         	 $this->db->insert('price_code', $csv_price_code); 
				}}
					
					if($db_status)
					{
					 
						$this->notifications->notify('School created  succesfully', 'success');
						
					}
					else
					{
						$this->notifications->notify('Oops!!!!....Failed update school','error');
					}
					redirect('franchise/school/schoolListfranchise/', 'refresh');
				}
			}
        $this->load->view('school_access_detail',$data);
        
    }  
   
    public function schoolListfranchise()
    { 
       $data['crm_account'] = $this->db->get_where('gst_account_marrs',['title'=>'CRM'])->result_array();
       $franchise_id = $this->session->userdata('franchise_id');
       $state = $this->db->get_where('franchise',array('franchise_id' =>$franchise_id))->row()->state_id;
       
    //   echo $state;
       
       
       $data['schoolList'] = $this->db->get_where('school_new',array('state' =>$state))->result_array();
       
    //   $data['schoolList'] = $this->db->get_where('school_new',array('state' =>$state,'franchise_id' =>$franchise_id))->result_array();
       
       
       
       $this->load->view('schoolList',$data);
    }
    
    public function schoolDelete()
    { 
        $uri= $this->uri->segment(4);
        $this->db->where('school_id',$uri);
        $this->db->delete('schools');
        redirect('franchise/school/schoolListfranchise');
    }
    
    public function student_List()
    { 
       $franchise_id = $this->session->userdata('franchise_id');
       $data['studentList'] = $this->schoolmodel->schoolListr($franchise_id);
       $this->load->view('studentList',$data);
    }
    
    public function product_List()
    { 
       $franchise_id = $this->session->userdata('franchise_id');
       $data['productList'] = $this->schoolmodel->productListfran($franchise_id);
      // print_r( $data);exit;
       $this->load->view('productList',$data);
    }
 
    public function add_new_school($franchise_id='') 
	{
	    
	    $franchise_id = $this->session->userdata('franchise_id');
	   
	    $data['franchiseState']   = $this->franchisemodel->Get_FranchiseState($this->session->userdata('franchise_id'));

			
			if (isset($_POST['submit']))
			
			{
			   //print_r($_POST);
			   
			   $sch=$this->input->post('school_name');
			   $sch=substr($sch,0,3);
			    $user= 'MRS'.$sch;
			 //   echo $user;die;
			    $this->db->select('*');
                $this->db->from('schools');
                $this->db->like('username', $user);
                $query=$this->db->get();
                // print_r($query->result().'ok');
                if(!empty($query->result())){
                    $user= 'MRS'.$sch.rand(10,100);
                }
            //   echo $user; die;
			    $product_id =$this->input->post('product_id');
			    $price = $this->input->post('product_price');
			    
			  $school_board=  $this->input->post('school_board');
			  if($school_board=='other'){
			     
			        $school_board=$this->input->post('school_board2');
			  }else{
			     $school_board=$this->input->post('school_board');
			  }
			   // print_r($_POST);exit;
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$post_data      = array(
										'school_name' => $this->input->post('school_name'),
										'school_address' => $this->input->post('school_address'),
										'principal_first_name' => $this->input->post('principal_first_name'),
										'principal_last_name' => $this->input->post('principal_last_name'),
										'school_coordinator_first_name' => $this->input->post('school_coordinator_first_name'),
										'school_coordinator_last_name' => $this->input->post('school_coordinator_last_name'),
										'school_coordinator_email' => $this->input->post('school_coordinator_email'),
										'sh_coordinator_phone' => $this->input->post('school_coordinator_phone'),
										'country_id' => $this->input->post('country_id'),
										'stateID' => $this->input->post('stateID'),
										'school_city' => $this->input->post('school_city'),
										'school_district' => $this->input->post('school_district'),
										'school_phone' => $this->input->post('school_phone'),
										'school_mobile' => $this->input->post('school_mobile'),
										'school_email' => $this->input->post('school_email'),
										'school_board' => $school_board,
										'school_medium' => $this->input->post('school_medium'),
										'school_concern_status' => $this->input->post('school_concern_status'),
										'school_pincode' => $this->input->post('school_pincode'),
										'username' => $user,
										'password' => $user,
										'school_created_date' => $cdate,
										'franchise_id' => $franchise_id,
										'marrs_coordinator_first_name' =>$this->input->post('marrs_coordinator_first_name'),
										'marrs_coordinator_last_name' =>$this->input->post('marrs_coordinator_last_name'),
										'marrs_coordinator_email' =>$this->input->post('marrs_coordinator_email'),
										'marrs_coordinator_phone' =>$this->input->post('marrs_coordinator_phone')
				                );
				$this->validation->set_data($post_data);
				//print_r($post_data);exit;
				//$this->validation->set_rules('school_name', 'school name', 'required');
				$this->validation->set_rules('school_address', 'school address', 'required');
			//	$this->validation->set_rules('principal_first_name', 'principal name', 'required');
				$this->validation->set_rules('school_coordinator_first_name', 'school coordinator name', 'required');
				$this->validation->set_rules('school_coordinator_email', 'school coordinator email', 'required');
				//$this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
				$this->validation->set_rules('country_id', 'country', 'required');
				$this->validation->set_rules('stateID', 'state', 'required');
				$this->validation->set_rules('school_city', 'school city', 'required');
				//$this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
		  	//$this->validation->set_rules('school_phone', 'school phone', 'required');
				$this->validation->set_rules('school_mobile', 'school mobile', 'required');
				$this->validation->set_rules('school_email', 'school email', 'required');
				//$this->validation->set_rules('school_board', 'school board', 'required');
				$this->validation->set_rules('school_medium', 'school medium', 'required');
				$this->validation->set_rules('school_concern_status', 'school concern status', 'required');
				$this->validation->set_rules('school_pincode', 'school pincode', 'required');
				//$this->validation->set_rules('school_latitude', 'school latitude', 'required');
			//	$this->validation->set_rules('school_longitude', 'school longitude', 'required');
			//	$this->validation->set_rules('school_created_date', 'school created date', 'required');
				
				$this->validation->set_data($post_data);
				 
				if ($this->validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
				} 
				else
				{
					
					$db_status=$this->schoolmodel->insertschooldata($post_data);
					if($db_status)
					{
					   //print_r($product_id);exit;
					    
					                 $this->db->select('period_id');
								     $this->db->from('period');
								     $this->db->where('status','Active');
								     $res =  $this->db->get();
								     $period_id= $res->row()->period_id;
					    
					   
			         foreach($product_id as $key=>$product){
			         $productId = $product;
			         $productprice = $price[$key];
			       	    $array = array(
					        
					        'product_id' =>$productId,
					        'period_id' =>$period_id,
					        'school_id' =>$db_status,
					        'price_code' =>$productprice
					        
					        ); 
					        $this->db->insert('price_code',$array);
					         $arrayf = array(
					        
					        'product_id' =>$productId,
					        'franchise_id' => $this->session->userdata('franchise_id'),
					        'period_id' =>$period_id,
					        'school_id' =>$db_status,
					        'price_code' => $productprice
					        
					        );
					        $this->db->insert('filter',$arrayf);
			               }
				
						$this->notifications->notify('School created  succesfully', 'success');
						
					}/* end of if(db_status)*/
					else
					{
						$this->notifications->notify('Oops!!!!....Failed update school','error');
					}/* end else of if(db_status)*/
					redirect('franchise/school/add_new_school/', 'refresh');
				}
			}
		
			$data['result']      = $_POST;
	        $this->load->view('add_new_school',$data);
	    
	    
	}
 
    public function new_school($franchise_id='') 
	{
	    
	    $franchise_id = $this->session->userdata('franchise_id');
	   
	    $data['franchiseState']   = $this->franchisemodel->Get_FranchiseState($this->session->userdata('franchise_id'));

			
			if (isset($_POST['submit']))
			
			{
			     $this->db->select('*');
        	   	 $this->db->from('districts');
                 $this->db->where('id',$_POST['school_district']);
                 $query = $this->db->get(); 
                 $que = $query->row(); 
        	     $district=$que->district_name;
        	
			    $this->db->select('school_code');
        	   	$this->db->from('school_new');
                $this->db->where('area_code',$_POST['area_code']);
                $this->db->order_by('id','DESC');
                $query = $this->db->get(); 
                $que = $query->row(); 
                
                if(empty($que->school_code)){
                    $school_code=$_POST['area_code'].'S'.'1000';
                }else{
                    // echo 'yes';
                    $trimmed = str_replace($_POST['area_code'].'S', '', $que->school_code) ;
                    $num=$trimmed+1;
                    $school_code= $_POST['area_code'].'S'.$num;
                }
        	   // print_R($que);die;
			
			  // print_r($_POST);die;
					$ar=array(
					    'school_name'=>$this->input->post('school_name'),
					    'school_code'=>$school_code,
					    'affiliation_number'=>$this->input->post('affiliation_number'),
					    'location'=>$this->input->post('school_locality'),
					    'area_code'=>$this->input->post('area_code'),
					    'city'=>$this->input->post('school_city'),
					    'district'=>$district,
					    'country'=>$this->input->post('country_id'),
					    'state'=>$this->input->post('stateID'),
					    'pin'=>$this->input->post('school_pincode'),
					    'school_email'=>$this->input->post('school_email'),
					    'school_phone'=>$this->input->post('school_phone'),
					    'school_mobile'=>$this->input->post('school_mobile'),
					    'school_address'=>$this->input->post('school_address'),
					    'principal_titile'=>'Mr.',
					    'school_principal_name'=>$this->input->post('principal_first_name').' '.$this->input->post('principal_middle_name').' '.$this->input->post('principal_last_name'),
					    'principal_email'=>$this->input->post('marrs_coordinator_email'),
					    'principal_phone'=>$this->input->post('marrs_coordinator_phone'),
					    'coordinator_titile'=>'Ms',
					    'school_coordinator_name'=>$this->input->post('school_coordinator_first_name').' '.$this->input->post('school_coordinator_middle_name').' '.$this->input->post('school_coordinator_last_name'),
					    'school_coordinator_email'=>$this->input->post('school_coordinator_email'),
					    'coordinator_phone'=>$this->input->post('school_coordinator_phone'),
					    'school_board'=>$this->input->post('school_board'),
					    'school_medium'=>$this->input->post('school_medium'),
					    'school_status'=>'Inactive',
					    'franchise_id'=>$franchise_id,
					    'password'=>$school_code,
					    );
					
					//print_r($ar);die;
					$db_status=$this->db->insert('school_new',$ar);
					if($db_status)
					{
					   $data['message']='School created succesfully... with school code '.$school_code;
						
					}/* end of if(db_status)*/
					else
					{
					$data['message']='There is error in insertion, try again...';
					}
			}
		
			$data['result']      = $_POST;
	        $this->load->view('new_school',$data);
	}
	
    public function school_edit()
    {
        $uri = $this->uri->segment(4);
        //echo $uri;die;
        $franchise_id = $this->session->userdata('franchise_id');
        
     
        if(isset($_POST['submit'])){
           // print_r($_POST);die;
            
            $this->db->set('city', $this->input->post('school_city'));
            $this->db->set('location', $this->input->post('school_locality'));
            $this->db->set('school_name', $this->input->post('school_name'));
            $this->db->set('affiliation_number', $this->input->post('affiliation_number'));
            $this->db->set('school_phone', $this->input->post('school_phone'));
            $this->db->set('school_mobile', $this->input->post('school_mobile'));
            
            $this->db->set('school_address', $this->input->post('school_address'));
            $this->db->set('school_principal_name', $this->input->post('school_principal_name'));
            $this->db->set('school_email', $this->input->post('school_email'));
            $this->db->set('school_board', $this->input->post('school_board'));
            $this->db->set('school_medium', $this->input->post('school_medium'));
            $this->db->set('school_coordinator_name', $this->input->post('school_coordinator_name'));
            
            $this->db->set('school_coordinator_email', $this->input->post('school_coordinator_email'));
            $this->db->set('coordinator_phone', $this->input->post('coordinator_phone'));
            $this->db->set('principal_phone', $this->input->post('principal_phone'));
            $this->db->set('principal_email', $this->input->post('principal_email'));
            $this->db->where('id', $uri);
            $this->db->update('school_new');
            $data['message']='School details updated successfully...';
            
                $this->db->select('*');
        	   	$this->db->from('school_new');
                $this->db->where('id',$uri);
                $query = $this->db->get(); 
                $que = $query->row_array(); 
                $data['result']=$que;
        }
        
        $this->db->select('*');
	   	$this->db->from('school_new');
        $this->db->where('id',$uri);
        $query = $this->db->get(); 
        $que = $query->row_array(); 
        $data['result']=$que;
        
        $this->db->select('*');
	   	$this->db->from('areas');
	   	$this->db->join('area_to_franchise','area_to_franchise.area_id=areas.id');
        $this->db->where('area_to_franchise.franchise_id',$franchise_id);
        $query = $this->db->get(); 
        $data['areaload']=$query->result_array();
     
        $this->load->view('school_edit',$data);
    }
 
    public function schoollist() 
    {
       $franchise_id         = $this->session->userdata('franchise_id');
       //echo $franchise_id;die;
	  // $data['list']  = $this->schoolmodel->get_franchiseschool($franchise_id);
	   
	   $data['service']  = $this->schoolmodel->get_franchiseservice($franchise_id);
	   //print_r($data);die;
	   $data['flag'] = 'No_data_found';
	   
	   if (isset($_POST['Search'])) {
	       //echo 'okkkk';die;
	       $productid   = $this->input->post('service');
	       $franchise_id         = $this->session->userdata('franchise_id');
	       
	       //echo $productid.' '.$franchise_id;die;
	       $param = array('productid' => $productid,'franchiseid' => $franchise_id);
	       
	       //print_r($param);die;
	       
	       $data['schools']  = $this->schoolmodel->get_franchiseschools($param);
	       
	       if(!(empty($data['schools']))){
	           $data['flag'] = 'Data_found';
	       }
	       else{
	       $data['flag'] = 'No_data_found';
	       }
	       
	       
	   }
	   
        $this->load->view("schoolList.php",$data);
    } 
   
    public function schoolStatuschange() 
	{
	    $uri = $this->uri->segment(4);
	   // print_r($uri);exit;\
	   	$this->db->select('*');
	   	$this->db->from('schools');
        $this->db->where('school_id',$uri);
        $query = $this->db->get(); 
        $que = $query->row(); 
	    $que->school_status;
		 //print_r($uri);exit;
		if($que->school_status=='Active'){
		    
	    $data = array(
	        'school_status' =>'Deactive'
	        );
	 
	    }else{
	        
	         $data = array(
	        'school_status' =>'Active'
	        );
	   
	    }
	    $this->db->where('school_id',$uri);
	    $this->db->update('schools',$data);
	    redirect('https://marrs.in/franchiselogin/franchise/school/schoolListfranchise/');
	}
   
    public function add() 
	{
		$franchise_id         = $this->session->userdata('franchise_id');
		$data['franchisefrcode']  = $this->schoolmodel->get_frcode($franchise_id);
	
		if (isset($_POST['submit'])) {
		    
	    $franchise_id  = $this->session->userdata('franchise_id');
	    
	    
	    $productname  = $this->input->post('productname');
	    
	   // echo $productname;die;
	   
	   
	   
	    $sdata  = array('productname'   => $productname,
                        'franchise_id'  => $franchise_id
                    );
	    
	    
		$data['franchisefrcode']  = $this->schoolmodel->get_frcode($franchise_id);
		$count  = $this->schoolmodel->get_numfranchisefiles($sdata);
		
	//	echo $count;die;
		 if($count < 3){
		    //echo 'okk';die;
		    $photo_path = "";
            $flag       = "";
            $f_type_chk = $_FILES['photo']['type'];
			//echo $f_type_chk;die;
            if ($f_type_chk != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
                $flag = "Select allowed file type for File";
            }
           
            $target_path = getcwd() . "/public/uploads/documents/";
            $db_path     = "public/uploads/documents/";
			//echo $_FILES['photo']['name'];die;
            if ($_FILES['photo']['name'] != '') {
                $file_name     = $_FILES["photo"]["name"];
                $file_size     = $_FILES["photo"]["size"] / 1024;
                $file_type     = $_FILES["photo"]["type"];
                $file_tmp_name = $_FILES["photo"]["tmp_name"];
                $random        = rand(111, 999);
                $new_file_name = $random . $file_name;
                $upload_path   = $target_path . $new_file_name;
				//echo $upload_path;die;
                if (move_uploaded_file($file_tmp_name, $upload_path)) {
                    $photo_path = addslashes($db_path . $new_file_name);
                } else {
                    var_dump($this->validation->show_errors());
                    $this->notifications->notify('File canot upload', 'error');
                }
            }
		
		$remarks              = $this->input->post('remarks');
		$data                 = array('productname'   => $this->input->post('productname'),
                                      'requesttype'   => $this->input->post('requesttype'),
                                      'frcode'     => $this->input->post('frcode'),
                                      'file' => $photo_path,
                                      'file_old' => $photo_path,
                                      'file_name'  => $this->input->post('file_name'),);
									  
		
									   
		//print_r($data);die;
		 $this->validation->set_data($data);
         $this->validation->set_rules('productname', 'Product', 'required');
         $this->validation->set_rules('requesttype', 'Request Type', 'required');
         $this->validation->set_rules('frcode', 'FRCode', 'required');
         $this->validation->set_rules('file', 'File', 'required');     
         $this->validation->set_rules('file_name', 'File Name', 'required');
		 
		 $data['franchise_id']               = $franchise_id;
		 $data['remarks']  = $remarks;
		 
		 $data['status']  = 'Pending';
		 //print_r($data);die;
		  if ($this->validation->run() === FALSE) { 
		  //echo 'okk';                     die;
                    $this->notifications->notify('Please make all entries', 'error');
         } else {
					//echo 'okk11';                     die;
					$res = $this->schoolmodel->insertdata($data);
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
             $data['product'] = $_POST;
  
		//print_r($data);die;
		 }
		 else{
			  $this->notifications->notify('Please upload after completing processing of all files !!!', 'error');	
		 }
	}
	    //print_r($data);die;
	    $data['productlist']  = $this->schoolmodel->get_product($franchise_id);
        $this->load->view("productfile.php", $data);
    }

 /* ------------------------------------------------------------------------- */  
 
    public function edit()
	{
			$data['franchiseState']   = $this->franchisemodel->Get_FranchiseState($this->session->userdata('franchise_id'));

			$uri               = $this->uri->uri_to_assoc(4);
			$data['school_id'] = $uri['id'];
			$schoolID          = $uri['id'];
			if (isset($_POST['submit']))
			{
				$scd       = $this->input->post('school_created_date');
				$timestamp = strtotime($scd);
				$cdate     = date('Y-m-d', $timestamp);
				$franchise_id=$this->session->userdata('franchise_id');
				$post_data      = array(
										'school_name' => $this->input->post('school_name'),
										'school_address' => $this->input->post('school_address'),
										'school_principal_name' => $this->input->post('school_principal_name'),
										'school_coordinator_name' => $this->input->post('school_coordinator_name'),
										'school_coordinator_email' => $this->input->post('school_coordinator_email'),
										'sh_coordinator_phone' => $this->input->post('sh_coordinator_phone'),
										'country_id' => $this->input->post('country_id'),
										'stateID' => $this->input->post('stateID'),
										'school_city' => $this->input->post('school_city'),
										'school_stdcode' => $this->input->post('school_stdcode'),
										'school_phone' => $this->input->post('school_phone'),
										'school_mobile' => $this->input->post('school_mobile'),
										'school_email' => $this->input->post('school_email'),
										'school_board' => $this->input->post('school_board'),
										'school_medium' => $this->input->post('school_medium'),
										'school_concern_status' => $this->input->post('school_concern_status'),
										'school_pincode' => $this->input->post('school_pincode'),
										'school_latitude' => $this->input->post('school_latitude'),
										'school_longitude' => $this->input->post('school_longitude'),
										'school_created_date' => $cdate
				                );
				$this->validation->set_data($post_data);
				$this->validation->set_rules('school_name', 'school name', 'required');
				$this->validation->set_rules('school_address', 'school address', 'required');
				$this->validation->set_rules('school_principal_name', 'principal name', 'required');
				$this->validation->set_rules('school_coordinator_name', 'school coordinator name', 'required');
				$this->validation->set_rules('school_coordinator_email', 'school coordinator email', 'required');
				$this->validation->set_rules('sh_coordinator_phone', 'school coordinator phone', 'required');
				$this->validation->set_rules('country_id', 'country', 'required');
				$this->validation->set_rules('stateID', 'state', 'required');
				$this->validation->set_rules('school_city', 'school city', 'required');
				$this->validation->set_rules('school_stdcode', 'school stdcode', 'required');
				$this->validation->set_rules('school_phone', 'school phone', 'required');
				$this->validation->set_rules('school_mobile', 'school mobile', 'required');
				$this->validation->set_rules('school_email', 'school email', 'required');
				$this->validation->set_rules('school_board', 'school board', 'required');
				$this->validation->set_rules('school_medium', 'school medium', 'required');
				$this->validation->set_rules('school_concern_status', 'school concern status', 'required');
				$this->validation->set_rules('school_pincode', 'school pincode', 'required');
				$this->validation->set_rules('school_latitude', 'school latitude', 'required');
				$this->validation->set_rules('school_longitude', 'school longitude', 'required');
				$this->validation->set_rules('school_created_date', 'school created date', 'required');
				
				$this->validation->set_data($post_data);
				 
				if ($this->validation->run() === FALSE)
				{
					
					$this->notifications->notify('Please make all entries', 'error');
				} 
				else
				{
					
					$db_status=$this->schoolmodel->insert($post_data,$franchise_id,$schoolID);
					if($db_status)
					{
						$this->notifications->notify('School updated succesfully', 'success');
						
					}/* end of if(db_status)*/
					else
					{
						$this->notifications->notify('Oops!!!!....Failed update school','error');
					}/* end else of if(db_status)*/
					redirect('franchise/school/', 'refresh');
				}
			}
			$data['mode']        = 'Edit';
			$data['result']      = $this->schoolmodel->getschool($schoolID);
			$this->load->view("schoolAdd.php", $data);
    }
	
 /* ------------------------------------------------------------------------- */  
	
    public function getstate() 
    {
        $data['res'] = $this->locationmodel->listStates();
        $this->load->view("getStateAjax.php", $data);
    }
	
 /* ------------------------------------------------------------------------- */  
 
    public function delete() 
    {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $schoolID = $uri['id'];
            $this->schoolmodel->changeStatus($schoolID);
            redirect('franchise/school/', 'refresh');
        }
    }
    
 /* ------------------------------------------------------------------------- */  

    public function Pending() 
    {
        $params = array(
                'status' => 'Pending'
            );
        $data['plist'] = $this->schoolmodel->listschool($params);
        $this->load->view("schoolPendingList.php", $data);
    }
	
 /* ------------------------------------------------------------------------- */  
	
    public function approve() 
    {
        $uri = $this->uri->uri_to_assoc(4);
        if (isset($uri['id'])) {
            $schoolID = $uri['id'];
            $status   = 'Active';
            $this->schoolmodel->changeStatus($schoolID, $status);
            redirect('franchise/school/Pending', 'refresh');
        }
    }
	
 /* ------------------------------------------------------------------------- */  
    public function view_accesscode() 
	{       
	    $fr_id  = $this->session->userdata('franchise_id');
       // $school_name = rawurldecode($this->input->post('school_name'));
       // print_r($school_name);exit;
		if(isset($_POST['Search']))
		{
			 $link=SITE_URL."school/view_accesscode/";
			 if($school_name)
		     {
			       $link.="school_name/".$school_name ."/";
		     }
		     redirect($link, 'refresh');
		}  
		else
		{
			$uri=$this->uri->uri_to_assoc(4); 
			if(isset($uri['school_name']))
			{
				$school_name=rawurldecode($uri['school_name']);
			}
			else
			{
				$school_name='';
			}
			 $params            = array('fr_id' => $fr_id,'school_name'=> $school_name );
             $data['list_accesscode']      = $this->schoolmodel->list_accesscode_School($fr_id);
			 $data['list']=$_POST;
		}
		$data['school_name']=rawurldecode($school_name);	       
        $this->load->view("list_accesscode.php", $data);

		
	}/*END of public function view_accesscode() */
	
	public function generate_accesscode()
	{
				$franchise_id   = $this->session->userdata('franchise_id');
				$params  = array( 'role'=>'No_Accesscode','franchise_id' => $franchise_id );
				$data['list']      = $this->schoolmodel->no_accescode_schools($params);
				//print_r($data);exit;
				if(isset($_POST['Assign_accesscode']))
				{
						$data = $this->input->post('school_id');
						print_r($data);exit;
						$no_stchool_id=count($data);
						for($i=0;$i<$no_stchool_id;$i++)
						{
							$schoolID=$data[$i];
							$set_status = $this->schoolmodel->set_access_code($schoolID);
							
						}
						if ($set_status)
						 {
							 $this->notifications->notify('Access Code Successfully Generated', 'success');
						 } 
						 else
						  {
							 $this->notifications->notify('Access Code Generation Failed', 'error');
						  }
						  redirect('franchise/school/', 'refresh');
				}
								
				$this->load->view("generate_accesscode.php", $data);
    }
    
    /*end public function generate_accesscode()*/
/*@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@*/	
	
    public function student_extract()
    {
       // echo $this->session->userdata('franchise_id');
        $data['franchise_id'] =$franchise_id  = $this->session->userdata('franchise_id');
       // print_r($data);die;
       
                        $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $franchise=$query->result_array();
       
        if(isset($_POST['submit'])){
          if(!empty($_POST['product'])){
            // $data['student']=$this->schoolmodel->extract_student($_POST);
            $data['result']=$_POST;
           // print_r($_POST);die;
            
            
            if(!empty($_POST['period']>12)){
                $ini13=$this->db->get_where('products',array('product_name'=>$_POST['product']))->row_array();
                $periodini=$this->db->get_where('period',array('period_id'=>$_POST['period']))->row_array();
                $periodini=$periodini['initials'];
                $like=$periodini.$ini13['in13'];
                
                if($_POST['school13']!=''){
                    //echo 'ok';
                    $school_id=$this->db->get_where('school_new',array('school_name'=>$_POST['school13'],'state'=>$franchise[0]['state_id']))->row_array();
                    $school_id=$school_id['id'];
                }
            }else{
                $ini12=$this->db->get_where('products',array('product_name'=>$_POST['product']))->row_array();
                $like=$ini12['in12'];
            }
           
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->like('cin',$like,'after');
                if($_POST['period']=='12' && $_POST['school12']!=''){
                    $this->db->where('school_name',$_POST['school12']);
                    
                }
                
                if($school_id!=''){
                    $this->db->join('school_new','school_new.id=cin_list.school_id');
                    $this->db->where('school_id',$school_id);
                    
                }
                
                $this->db->where('state_id',$franchise[0]['state_id']);
                if($_POST['class']!=''){
                    $this->db->where('class',$_POST['class']);
                }
                $this->db->group_by('cin');
                $query = $this->db->get();
                //echo $this->db->last_query();die;
                $data['student']=$query->result_array();
            if(empty($data['student'])){
                $data['message']='No data found with selected parameters...';
            }
            // print_r($product);die;
            //$data['student'] = $this->franchisemodel->student_list($_POST,$school,$levels,$product,$class);
        }else{
            $data['message']='Please select a product...';
        }
        
        }
        if (isset($_POST['Export']))
	    {
	     //print_r($_POST);die;
    		    if(!empty($_POST['period']>12)){
                    $ini13=$this->db->get_where('products',array('product_name'=>$_POST['product']))->row_array();
                    $periodini=$this->db->get_where('period',array('period_id'=>$_POST['period']))->row_array();
                    $periodini=$periodini['initials'];
                    $like=$periodini.$ini13['in13'];
                    
                    if($_POST['13school']!=''){
                        //echo 'ok';
                        $school_id=$this->db->get_where('school_new',array('school_name'=>$_POST['13school'],'state'=>$franchise[0]['state_id']))->row_array();
                        $school_id=$school_id['id'];
                    }
                }else{
                    $ini12=$this->db->get_where('products',array('product_name'=>$_POST['product']))->row_array();
                    $like=$ini12['in12'];
                }
           
                $this->db->select('*');
                $this->db->from('cin_list');
                $this->db->like('cin',$like,'after');
                if($_POST['period']=='12' && $_POST['12school']!=''){
                    $this->db->where('school_name',$_POST['12school']);
                    
                }
                
                if($school_id!=''){
                    $this->db->join('school_new','school_new.id=cin_list.school_id');
                    $this->db->where('school_id',$school_id);
                    
                }
                
                $this->db->where('state_id',$franchise[0]['state_id']);
                if($_POST['class']!=''){
                    $this->db->where('class',$_POST['class']);
                }
                $this->db->group_by('cin');
                $query = $this->db->get();
                //echo $this->db->last_query();die;
                
            $student=$query->result_array();
		
		
                		 $data=array();	
                		 $n=1;
                		  foreach($student as $item) {
                    // Increment serial number
                    $item['serial_no'] = $n;
                
                    // Define variables for school name and address
                    $schoolName = '';
                    $schoolAddress = '';
                
                    // Check if school name is present
                    if (!empty($item['school_name'])) {
                        $schoolName = $item['school_name'];
                        $schoolAddress = $item['school_address1'];
                    } else {
                        // Retrieve school details from database based on school ID
                        $schoolDetails = $this->db->get_where('school_new', array('id' => $item['school_id']))->row_array();
                        $schoolName = $schoolDetails['school_name'];
                        $schoolAddress = $schoolDetails['city'];
                    }
                
                    // Add data to the array
                    $data[] = array(
                        $item['serial_no'],
                        $item['cin'],
                        $item['student_name'],
                        $schoolName,
                        $schoolAddress,
                        $item['class'],
                        $item['father_name'],
                        $item['mother_name'],
                        $item['stud_mobile'],
                        $item['stud_email'],
                        $item['stud_address'],
                        $_POST['product']
                    );
                
                    // Increment the serial number
                    $n++;
                }
                
                	//	print_r($data);die;
                        		header("Content-type: application/csv");
                                header("Content-Disposition: attachment; filename=\"student_cin_list".".csv\"");
                                header("Pragma: no-cache");
                                header("Expires: 0");
                        
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, array('Serialno','CIN','Student Name','School Name','School Address','Class','Father Name','Mother Name','Mobile','Email','Address','Product name'));
                                $cnt=1;
                                foreach ($data as $key) {
                                    
                                    fputcsv($handle, $key);
                                }
                                    fclose($handle);
                                exit;
                		
                // 		$this->csv->export($data,array('Serialno','PRID','Student Name','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp'),'pridlist.csv');
                // 		exit;
                		
                	 }
        
                        $this->db->select('*');
                        $this->db->from('school_new');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['schoolload13']=$query->result_array();
        
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','11');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('school_name');
                        $this->db->from('cin_list');
                        $this->db->where('state_id',$franchise[0]['state_id']);
                        $this->db->where('period_id','12');
                        $this->db->group_by('school_name');
                        $query = $this->db->get();
                        $data['schoolload12']=$query->result_array();
                        //echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
        
        $this->load->view("student_extract.php", $data);
    }
    
    /*end function get_access_code*/
	
/*@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@ @@@@@@@@@@@@@@@@@@@@@@*/
    public function school_extract()
    {
        $data['franchise']   = $this->session->userdata('franchise_id');
        $franchise  = $this->session->userdata('franchise_id');
        if(isset($_POST['submit'])){
            unset($_POST['submit']);
           // print_r($_POST);die;
            
            $data['school']=$this->schoolmodel->schoolList_all($_POST['status'],$franchise);
        }
        if (isset($_POST['Export']))
	    {
	        $status=$this->input->post('status');
	        $cin_list= $this->schoolmodel->schoolList_all($_POST['status'],$franchise);
	 
            $data=array();	
		    $n=1;
		    foreach($cin_list as $item)
		    {
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data []=array( 
        			  
        			   $item['serial_no'],
        			   $item['school_name'] ,
        			   $item['school_code'] ,
        			   $item['username']  ,
        			   $item['school_mobile'],
        			   $item['school_email'],
        			   $item['principal_first_name']. "  " .$item['principal_middle_name'],
        			   $item['school_address']. "  " .$item['school_address1'],
        			   $item['school_medium'],
        			   $item['school_board'],
        			   $item['school_status'] 
        			  
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
                fputcsv($handle, array('Serialno','School Name','School Code','Username / Password','Mobile Number','Email','Principal','School Address','Medium','Board','Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
	     
	        }
		 $this->load->view("school_extract.php", $data);
    }
    
    public function franchise_pricecodelevel()
    {
       $fid = $this->session->userdata('franchise_id');
       $data['product'] = $this->schoolmodel->assignschool($fid);
       $data['pricecode'] = $this->schoolmodel->pricecodelavel($fid);
       $data['school'] = $this->schoolmodel->school_level($fid);
        //echo "<pre>";print_r($data);exit;
          if (isset($_POST['submit']))
	 {
	     $product_id= $this->input->post('product');
	     $pricecode= $this->input->post('price_code');
	     $school_id= $this->input->post('school_id');
	     $period_id = $this->db->get_where('period',array('status' =>'Active'))->row()->period_id;
	     
	     $array = array(
	         'product_id' =>$product_id,
	         'franchise_id' =>$fid,
	         'price_code' =>$pricecode,
	         'period_id' =>$period_id,
	         'school_id' =>$school_id,
	         'status' =>'Active'
	         
	         );
	     
	    // $this->db->insert('price_codegenration',$array);
	 }
      $this->load->view('franchise_pricecodelevel',$data);
    }
    
    public function pricecodeassign_toproduct()
    {
       $data['f_id']=$fid= $this->session->userdata('franchise_id');
      
       if(isset($_POST['submit']))
       {
           
           
           $product_id= $_POST['product_name'];
           $school =  $_POST['school'];
           	 foreach($product_id as $key=>$product){
			 $productId = $product;
			  $school_id = $school[$key];
			  $array = array(
    	         'product_id' => $product,
    	         'franchise_id' => $fid,
    	         'price_code' =>$_POST['price_code'],
    	         'period_id' =>$_POST['period'],
    	         'school_id' =>$school_id,
    	         'level' =>$_POST['level']
	         
	         );
	         
	          $array2 = array(
    	         'product_id' => $product,
    	         //'franchise_id' => $fid,
    	         'price_code' =>$_POST['price_code'],
    	         'period_id' =>$_POST['period'],
    	         'school_id' =>$school_id,
    	         'level' =>$_POST['level']
	         
	         );
          // print_r($array);exit;
          // $this->db->where('',$fid)
           $this->db->insert('price_code',$array2);
           $this->db->insert('filter',$array);
           
           }
			     	
           
           
           
            
       }
       $this->load->view('pricecodeassign_toproduct',$data);
    }
    
    public function zoomzoom_student()
    {
        $data['f_id']=$fid= $this->session->userdata('franchise_id');
        $franchise=$fid= $this->session->userdata('franchise_id');
        if(isset($_POST['submit'])){
          // print_r($_POST);die;
         //   $franchise=$_POST['franchise'];
	        $level=$_POST['level'];
	        $class=$_POST['class'];
	        $period=$_POST['period'];
	        $status=$_POST['status'];
	        
	        $data['le']=$_POST['level'];
	        $data['cla']=$_POST['class'];
	        $data['per']=$_POST['period'];
	        $data['sta']=$_POST['status'];
	        // $data['fra']=$_POST['franchise'];
	      //   echo $franchise;die;
            $student=$this->franchisemodel->zoomzoom_student_list($franchise,$level,$period,$class);
        //echo $status;die;
            if($status=='Paid'){
                $data['student']=$this->franchisemodel->zoomzoom_student_list_data($franchise,$level,$period,$class);
                //print_r( $data['student']);exit;
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
	        //$franchise=$_POST['fra'];
	        
// echo $level.$class.$period.$status.$franchise;
             
//              die;
             
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
                header("Content-Disposition: attachment; filename=\"test".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','PRID','Student Name','Class','Father Name','Mother Name','Mobile','Email','Address','Whatsapp','Product name','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
        }
        
        
        
        
        
        
        
        
        
        
        
       $data['status']=$status;
        
        $this->load->view('zoomzoom_extract',$data);
    }
	
	public function cin_list_export()
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
		      //print_r($item);die;
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
        			   $item['username'],
        			   $item['product_name'],
        			   $item['amount'],
        			   $item['time'],
        			   $item['school_name'].' - '.$item['school_address'] ,
        			   
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
   
	public function competition_extraction()
	{
	    
        $franchise_id= $this->session->userdata('franchise_id');
        $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$franchise_id);
        $query = $this->db->get();
        $franchise=$query->result_array();
                        
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['product']!='Select Product'){
                $data['result']=$_POST;
                    $this->db->select('*');
                    if($_POST['level']== 1 && $_POST['period_id']>='14'){
                        $this->db->from('product_purchase');
                        $this->db->join('cin_list','product_purchase.cin=cin_list.cin');
                    }else{    
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                    }
                    
                    $this->db->join('school_new','school_new.id=cin_list.school_id');
                    $this->db->join('period','period.period_id=cin_list.period_id');
                        
                        
                        if($_POST['level']== 1 && $_POST['period_id']>='14'){
                            
                            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=product_purchase.clevel');
                            $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                            $this->db->where('product_purchase.product_name',$_POST['product']);
                            
                        }else{
                            
                            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                            $this->db->where('new_cart.clevel',$_POST['level']);
                            $this->db->where('new_cart.product_name',$_POST['product']);
                            $this->db->where('new_cart.status','Paid');
                            
                        }
                        
                        
                        if($_POST['school']!=''){
                                $this->db->where('cin_list.school_id',$_POST['school']);
                            }
                        
                        $this->db->where('cin_list.period_id',$_POST['period_id']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        
                        
                        
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
           }else{
               $data['message']='Error: Select product...';
           }        
                    
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
            
            
            
                        $data['result']=$_POST;
                        $this->db->select('*,CONCAT(school_new.school_name, ' - ', school_new.city) AS school');
                    if($_POST['level']== 1 && $_POST['period_id']>='14'){
                        $this->db->from('product_purchase');
                        $this->db->join('cin_list','product_purchase.cin=cin_list.cin');
                    }else{    
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                    }
                    
                    $this->db->join('school_new','school_new.id=cin_list.school_id');
                    $this->db->join('period','period.period_id=cin_list.period_id');
                        
                        
                        if($_POST['level']== 1 && $_POST['period_id']>='14'){
                            
                            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=product_purchase.clevel');
                            $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                            $this->db->where('product_purchase.product_name',$_POST['product']);
                            
                        }else{
                            
                            $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                            $this->db->where('new_cart.clevel',$_POST['level']);
                            $this->db->where('new_cart.product_name',$_POST['product']);
                            $this->db->where('new_cart.status','Paid');
                            
                        }
                        
                        
                        if($_POST['school']!=''){
                                $this->db->where('cin_list.school_id',$_POST['school']);
                            }
                        
                        $this->db->where('cin_list.period_id',$_POST['period_id']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        
                        
                        
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        
                $orientation=$query->result_array();
           
           
           
           
                $n=1;
          // echo $status;die;
		        $data = []; 
                foreach ($orientation as $index => $item) {
                    
                    $this->db->select('*');
                            $this->db->from('cin_result');
                            $this->db->where('product_name',$item['product_name']);
                            $this->db->where('clevel',$item['clevel']);
                            $this->db->where('cin',$item['cin']);
                            $query = $this->db->get();
                            $dd=$query->row();
                            
						  
						    if(!$dd->venue){
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->where('comp_id',$dd->competition_schedule_id);
                                $query = $this->db->get();
                                $ddd=$query->row();
                                if($ddd->center_name){
                                    $center= $ddd->center_name;
                                }
                                else{
                                    $this->db->select('*');
                                    $this->db->from('competition_schedule');
                                    $this->db->where('competition_schedule_id',$dd->competition_schedule_id);
                                    $query = $this->db->get();
                                    $dddd=$query->row();
                                    
                                    $center=  $dddd->center_address;
                                }
                                
						    }
						    if($dd->venue){
						        $center=  $dd->venue;
						        $close_date='';
						    }
						 
						 if(empty($center)){
						                    $this->db->select('*');
                                            $this->db->from('new_cart');
                                            $this->db->where('product_name',$item['product_name']);
                                            $this->db->where('clevel',$item['clevel']);
                                            $this->db->where('cin',$item['cin']);
                                            $query = $this->db->get();
                                            $cd=$query->row();
                            //   print_r($cd->comp_date);          
						        
						                    $this->db->select('*');
                                            $this->db->from('cin_uploade');
                                            $this->db->where('cin',$item['cin']);
                                            $this->db->order_by('cin_uploade.id','DESC');
                                            $query = $this->db->get();
                                            $cp=$query->row();
						        
						        
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->join('competition_product_state','competition_product_state.id=exam_centers.comp_id');
                                $this->db->where('exam_centers.comp_id',$cp->comp_id);
                                $this->db->where('exam_centers.exam_date',$cd->comp_date);
                                $query = $this->db->get();
                                $cds=$query->row();
                                $center=$cds->center_name;
                                
                                $close_date=$cds->exam_date;
						 }
            
                    
                    
            
                    $serial_no = $index + 1;
                
                    $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                    $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
                
                    $data[] = [
                        $serial_no,
                        $item['cin'],
                        $item['student_name'],
                        $item['product_name'],
                        'Yes', 
                        $item['academic_year'],
                        $item['level_name'],
                        $item['time'],
                        $item['school_name'] ?? $school,
                        $item['city'],
                        $item['class'],
                        $center,
                        $close_date,
                        $contact_numbers,
                        $contact_emails,
                        $status 
                    ];
                    
                    $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
                }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Competition','Period_id','Level','Time','School Name','School Address','Class','Center Name','Exam Date','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
            }
       
                       
        $this->db->select('*');
        $this->db->from('period');
        $this->db->where('period_id >','12');
        $query = $this->db->get();
        $data['loadperiod']=$query->result_array();
       // print_r($franchise);
        $this->db->select('*');
        $this->db->from('school_new');
        $this->db->where('state',$franchise[0]['state_id']);
        //$this->db->where('period_id','12');
        $this->db->order_by('school_name','ASC');
        $query = $this->db->get();
        $data['schoolload']=$query->result_array();
        //echo $this->db->last_query();
        
        $this->db->select('*');
        $this->db->from('class');
        // $this->db->where('franchise_id',$franchise_id);
        $query = $this->db->get();
        $data['classload']=$query->result_array();
        
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('status','Active');
        $query = $this->db->get();
        $data['productload']=$query->result_array();
        

        $this->db->select('*');
        $this->db->from('competition_level_byproduct');
        //$this->db->where('status','Active');
        $query = $this->db->get();
        $data['levelload']=$query->result_array();

        
        $this->load->view("competition_extraction.php",$data); 
    }

    public function mock_extraction()
    {
	     $franchise_id= $this->session->userdata('franchise_id');
	                   $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                    $data['franchise_date'] =    $franchise=$query->result_array();
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['mock']!='select mock'){ 
                if($_POST['product']!='Select Product'){
                    $data['result']=$_POST;
                    
                    $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;
                    
                    
                    
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.mock_test = 'Yes' OR new_cart.mock_test_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        //$this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                       //echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
           }else{
               $data['message']='Error: Select product...';
           }        
          }else{
               $data['message']='Error: Select Mock...';
           }         
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        
                    $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;    
                        
                        
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*,CONCAT(school_new.school_name, ' - ', school_new.city) AS school');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.mock_test = 'Yes' OR new_cart.mock_test_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        //$this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
            if($franchise[0]['state_id'] == $item['state_id']){
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'] ?? $item['school'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
            }
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Mock Model','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('*');
                        $this->db->from('school_new');
                        $this->db->where('state',$franchise[0]['state_id']);
                        //$this->db->where('period_id','12');
                        $this->db->order_by('school_name','ASC');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                        //echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
       $this->load->view("mock_extraction13.php",$data); 
    }
    
    public function material_extraction()
    {
	     $franchise_id = $this->session->userdata('franchise_id');
	                    $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                    $data['franchise_date'] =     $franchise=$query->result_array();
                        
        if(isset($_POST['Search'])){
        //   print_r($_POST);die;
            if($_POST['mock']!='select material'){ 
                if($_POST['product']!='Select Product'){
                    $data['result']=$_POST;
                        
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;
               
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('competition_level_byproduct.level_id',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.study_material = 'Yes' OR new_cart.study_material_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        // $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
           }else{
               $data['message']='Error: Select product...';
           }        
          }else{
               $data['message']='Error: Select Material...';
           }         
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;
                        
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*,CONCAT(school_new.school_name, ' - ', school_new.city) AS school');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.study_material = 'Yes' OR new_cart.study_material_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        // $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
                           $orientation=$query->result_array();
                           
                           $n=1;
                          // echo $status;die;
                		 $data = []; 
                        foreach ($orientation as $index => $item) {
                            if($franchise[0]['state_id'] == $item['state_id']){
                            $serial_no = $index + 1;
                        
                            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
                        
                            $data[] = [
                                $serial_no,
                                $item['cin'],
                                $item['student_name'],
                                $item['product_name'],
                                $_POST['mock'], 
                                $item['academic_year'],
                                $item['level_name'],
                                $item['time'],
                                $item['school_name'] ?? $item['school'],
                                $item['city'],
                                $item['class'],
                                $contact_numbers,
                                $contact_emails,
                                $status 
                            ];
                            $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                                        $item['level_name'];
                            }
                        }
                
                	//	print_r($data);die;
                        		header("Content-type: application/csv");
                                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                                header("Pragma: no-cache");
                                header("Expires: 0");
                        
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Material Model','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                                $cnt=1;
                                foreach ($data as $key) {
                                    
                                    fputcsv($handle, $key);
                                }
                                    fclose($handle);
                                exit;
                       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('*');
                        $this->db->from('school_new');
                        $this->db->where('state',$franchise[0]['state_id']);
                        //$this->db->where('period_id','12');
                        $this->db->order_by('school_name',"ASC");
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                        //echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
       $this->load->view("material_extraction13.php",$data); 
   }
   
    public function orientation_extraction()
    {
	    $franchise_id = $this->session->userdata('franchise_id');
	                    $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['franchise_date'] = $franchise = $query->result_array();
                        
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
            if($_POST['mock']!='select orientation'){ 
                if($_POST['product'] != 'Select Product'){
                    $data['result'] = $_POST;
                    
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;
                        
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.orientation = 'Yes' OR new_cart.orientation_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.orientation_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.orientation_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                        //$this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                       // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
           }else{
               $data['message']='Error: Select product...';
           }        
          }else{
               $data['message']='Error: Select Orientation...';
           }         
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
            
                        $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id',$_POST['period_id']);
                        $query = $this->db->get();
                        $period = $query->row();
               
                        $initials = $period->initials;
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('product_name',$_POST['product']);
                        $query = $this->db->get();
                        $product = $query->row();
               
                        $product_in = $product->in13;
                        
                        // print_r($_POST['state_id']);die;
                        
                        // if($_POST['area']!='')
                        // {
                        //     $this->db->select('*');
                        //     $this->db->from('areas');
                        //     $this->db->where('area_code',$_POST['area']);
                        //     $query = $this->db->get();
                        //     $area = $query->row();
                            
                        //     // print_r($area->area_code);die;
                        // }else{
                        //     $area = '';
                        // }
                        
                        
                        $like = $initials.$product_in;
                        
                        $this->db->select('new_cart.*,competition_level_byproduct.level_name,cin_list.*,CONCAT(school_new.school_name, ' - ', school_new.city) AS school');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        $this->db->join('school_new','school_new.id=cin_list.school_id');
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('new_cart.period_id',$_POST['period_id']);
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        $this->db->like('cin_list.cin',$like);
                        if($_POST['mock']=='A'){
                            $this->db->where(
                                "(new_cart.orientation = 'Yes' OR new_cart.orientation_a = 'Yes')",
                                NULL,
                                FALSE
                            );
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.orientation_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.orientation_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_id',$_POST['school']);
                        }
                       // $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        // echo $this->db->last_query();die;
                        
                       $orientation=$query->result_array();
                       
                       $n=1;
                      // echo $status;die;
            		 $data = []; 
                    foreach ($orientation as $index => $item) {
                        if($franchise[0]['state_id'] == $item['state_id']){
                        $serial_no = $index + 1;
                    
                        $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                        $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
                    
                        $data[] = [
                            $serial_no,
                            $item['cin'],
                            $item['student_name'],
                            $item['product_name'],
                            $_POST['mock'], 
                            $item['academic_year'],
                            $item['level_name'],
                            $item['time'],
                            $item['school_name'] ?? $item['school'],
                            $item['city'],
                            $item['class'],
                            $contact_numbers,
                            $contact_emails,
                            $status 
                        ];
                        $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                                    $item['level_name'];
                        }
                    }

	            //	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Orientation Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('*');
                        $this->db->from('school_new');
                        $this->db->where('state',$franchise[0]['state_id']);
                        //$this->db->where('period_id','12');
                        $this->db->order_by('school_name','ASC');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                        //echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
       $this->load->view("orientation_extraction13.php",$data); 
    }
    
    public function competition_extraction22() 
    {
        $franchise_id= $this->session->userdata('franchise_id');
	                   $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $franchise=$query->result_array();
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
         
           if($_POST['product']!='Select Product'){
               $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
                $data['result']=$_POST;    
           }else{
               $data['message']='Error: Select product...';
           }        
                 
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
    
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $level=$orientation['level_name'];
             $file_name = $item['product_name']. '_' . $item['level_name'].'_2022-23';
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Orientation Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('school_name');
                        $this->db->from('cin_list');
                        $this->db->where('state_id',$franchise[0]['state_id']);
                        $this->db->where('period_id','12');
                        $this->db->group_by('school_name');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                       // echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
                    if(isset($data['result']['product'])){
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        $this->db->where('product_name',$data['result']['product']);
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
                    }
                    
        
       $this->load->view("competition_extraction22.php",$data);
    }
    
    public function orientation_extraction22() 
    {
        $franchise_id= $this->session->userdata('franchise_id');
	                   $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $franchise=$query->result_array();
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
         
           if($_POST['product']!='Select Product'){
               
               if($_POST['mock']!='select material'){
               $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.study_material','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
                }else{
                $data['message']='Error: Select Meterial...';
                }    
            }else{
                $data['message']='Error: Select product...';
            }        
                 
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.study_material','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
    
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Orientation Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('school_name');
                        $this->db->from('cin_list');
                        $this->db->where('state_id',$franchise[0]['state_id']);
                        $this->db->where('period_id','12');
                        $this->db->group_by('school_name');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                       // echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
       $this->load->view("orientation_extraction22.php",$data);
    }
    
    public function mock_extraction22() 
    {
        $franchise_id= $this->session->userdata('franchise_id');
	                   $this->db->select('*');
                        $this->db->from('franchise');
                        $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $franchise=$query->result_array();
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
         
           if($_POST['product']!='Select Product'){
               
               if($_POST['mock']!='select mock'){
               $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.mock_test','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
                }else{
                $data['message']='Error: Select Meterial...';
                }    
            }else{
                $data['message']='Error: Select product...';
            }        
                 
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.mock_test','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.mock_test_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.mock_test_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
    
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Mock Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('school_name');
                        $this->db->from('cin_list');
                        $this->db->where('state_id',$franchise[0]['state_id']);
                        $this->db->where('period_id','12');
                        $this->db->group_by('school_name');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                       // echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
       $this->load->view("mock_extraction22.php",$data);
    }
    
    public function material_extraction22()
    {
        $franchise_id= $this->session->userdata('franchise_id');
	    $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$franchise_id);
        $query = $this->db->get();
        $franchise=$query->result_array();
        
        if(isset($_POST['Search'])){
           //print_r($_POST);die;
         
           if($_POST['product']!='Select Product'){
               
               if($_POST['mock']!='select material'){
               $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.study_material','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                    if(empty($data['student'])){
                        $data['message']='No data found with selected parameters...';
                    }
                }else{
                $data['message']='Error: Select Meterial...';
                }    
            }else{
                $data['message']='Error: Select product...';
            }        
                 
           //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
        }
        
        if(isset($_POST['Export'])){
                        $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.study_material','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        //echo $this->db->last_query();die;
                        
           $orientation=$query->result_array();
           
           $n=1;
          // echo $status;die;
		 $data = []; 
        foreach ($orientation as $index => $item) {
    
            $serial_no = $index + 1;
        
            $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
            $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
        
            $data[] = [
                $serial_no,
                $item['cin'],
                $item['student_name'],
                $item['product_name'],
                $_POST['mock'], 
                $item['academic_year'],
                $item['level_name'],
                $item['time'],
                $item['school_name'],
                $item['city'],
                $item['class'],
                $contact_numbers,
                $contact_emails,
                $status 
            ];
            $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
        }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Material Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
       }
       
                       
                        $this->db->select('*');
                        $this->db->from('period');
                        $this->db->where('period_id >','12');
                        $query = $this->db->get();
                        $data['loadperiod']=$query->result_array();
                       // print_r($franchise);
                        $this->db->select('school_name');
                        $this->db->from('cin_list');
                        $this->db->where('state_id',$franchise[0]['state_id']);
                        $this->db->where('period_id','12');
                        $this->db->group_by('school_name');
                        $query = $this->db->get();
                        $data['schoolload']=$query->result_array();
                       // echo $this->db->last_query();
                        
                        $this->db->select('*');
                        $this->db->from('class');
                        // $this->db->where('franchise_id',$franchise_id);
                        $query = $this->db->get();
                        $data['classload']=$query->result_array();
                        
                        $this->db->select('*');
                        $this->db->from('products');
                        $this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['productload']=$query->result_array();
                        
       
                        $this->db->select('*');
                        $this->db->from('competition_level_byproduct');
                        //$this->db->where('status','Active');
                        $query = $this->db->get();
                        $data['levelload']=$query->result_array();
        
        
        $this->load->view("material_extraction22.php",$data);
    }
    
    public function payment_export()
    {
        $franchise_id= $this->session->userdata('franchise_id');
	    $this->db->select('*');
        $this->db->from('franchise');
        $this->db->where('franchise_id',$franchise_id);
        $query = $this->db->get();
        $franchise=$query->result_array();
    
            if(isset($_POST['Search'])){
           //print_r($_POST);die;
         
               if($_POST['product']!='Select Product'){
                   
                   if($_POST['mock']!='select material'){
                   $data['result']=$_POST;
                        $this->db->select('*');
                        $this->db->from('new_cart');
                        $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                        
                        $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                        $this->db->join('period','period.period_id=new_cart.period_id');
                        $this->db->where('cin_list.period_id','12');
                        $this->db->where('new_cart.product_name',$_POST['product']);
                        $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                        $this->db->where('new_cart.clevel',$_POST['level']);
                        $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                        if($_POST['mock']=='A'){
                            $this->db->where('new_cart.study_material','Yes');
                            
                        }
                        if($_POST['mock']=='B'){
                            $this->db->where('new_cart.study_material_b','Yes');
                        }
                        if($_POST['mock']=='C'){
                            $this->db->where('new_cart.study_material_c','Yes');
                        }
                        if($_POST['school']!=''){
                            
                            $this->db->where('cin_list.school_name',$_POST['school']);
                        }
                        $this->db->where('new_cart.status','Paid');
                        $this->db->group_by('cin_list.cin');
                        $query = $this->db->get();
                        // echo $this->db->last_query();die;
                        $data['student']=$query->result_array();
                        if(empty($data['student'])){
                            $data['message']='No data found with selected parameters...';
                        }
                    }else{
                    $data['message']='Error: Select Meterial...';
                    }    
                }else{
                    $data['message']='Error: Select product...';
                }        
                     
               //$data['orientation']=$this->schoolmodel->competition_list_2021($_POST['product'],$_POST['class'],$_POST['status'],$_POST['period_id'],$_POST['level'],$_POST['state_id']);
            }
        
            if(isset($_POST['Export'])){
                    $data['result']=$_POST;
                    $this->db->select('*');
                    $this->db->from('new_cart');
                    $this->db->join('cin_list','new_cart.cin=cin_list.cin');
                    
                    $this->db->join('competition_level_byproduct','competition_level_byproduct.level_id=new_cart.clevel');
                    $this->db->join('period','period.period_id=new_cart.period_id');
                    $this->db->where('cin_list.period_id','12');
                    $this->db->where('new_cart.product_name',$_POST['product']);
                    $this->db->where('competition_level_byproduct.product_name',$_POST['product']);
                    $this->db->where('new_cart.clevel',$_POST['level']);
                    $this->db->where('cin_list.state_id',$franchise[0]['state_id']);
                    if($_POST['mock']=='A'){
                        $this->db->where('new_cart.study_material','Yes');
                        
                    }
                    if($_POST['mock']=='B'){
                        $this->db->where('new_cart.study_material_b','Yes');
                    }
                    if($_POST['mock']=='C'){
                        $this->db->where('new_cart.study_material_c','Yes');
                    }
                    if($_POST['school']!=''){
                        
                        $this->db->where('cin_list.school_name',$_POST['school']);
                    }
                    $this->db->where('new_cart.status','Paid');
                    $this->db->group_by('cin_list.cin');
                    $query = $this->db->get();
                    //echo $this->db->last_query();die;
                    
            $orientation=$query->result_array();
           
            $n=1;
          // echo $status;die;
    		$data = []; 
            foreach ($orientation as $index => $item) {
        
                $serial_no = $index + 1;
            
                $contact_numbers = $item['stud_phone'] . ' - ' . $item['father_phone'] . ' - ' . $item['mother_phone'];
                $contact_emails = $item['stud_email'] . ' - ' . $item['father_email'] . ' - ' . $item['mother_email'];
            
                $data[] = [
                    $serial_no,
                    $item['cin'],
                    $item['student_name'],
                    $item['product_name'],
                    $_POST['mock'], 
                    $item['academic_year'],
                    $item['level_name'],
                    $item['time'],
                    $item['school_name'],
                    $item['city'],
                    $item['class'],
                    $contact_numbers,
                    $contact_emails,
                    $status 
                ];
                $file_name=$item['product_name'].'_'.$item['academic_year'].'_'.
                        $item['level_name'];
                }

	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Material Type','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
            }
    
    
                $this->db->select('*');
                $this->db->from('period');
                $this->db->where('period_id >','13');
                $query = $this->db->get();
                $data['loadperiod']=$query->result_array();
               // print_r($franchise);
               
                $this->db->select('*');
                $this->db->from('school_new');
                $this->db->where('state',$franchise[0]['state_id']);
                // $this->db->where('period_id','12');
                $this->db->order_by('school_name','ASC');
                $query = $this->db->get();
                $data['schoolload']=$query->result_array();
                // echo $this->db->last_query();
                
                $this->db->select('*');
                $this->db->from('class');
                // $this->db->where('franchise_id',$franchise_id);
                $query = $this->db->get();
                $data['classload']=$query->result_array();
                
                $this->db->select('*');
                $this->db->from('products');
                $this->db->where('status','Active');
                $query = $this->db->get();
                $data['productload']=$query->result_array();
                

                $this->db->select('*');
                $this->db->from('competition_level_byproduct');
                //$this->db->where('status','Active');
                $query = $this->db->get();
                $data['levelload']=$query->result_array();

        
       $this->load->view("payment_export.php",$data);
    }
    
    public function student_extraction_competition_2022()
    {
        $franchise_id=$this->session->userdata('franchise_id');
        //echo $franchise_id;die;
        
        $this->db->select('franchise_code,state_id');
	   	 $this->db->from('franchise');
         $this->db->where('franchise_id',$franchise_id);
         $query = $this->db->get(); 
         $que = $query->row(); 
	     $state_id= $que->state_id;
		 $franchise_code=$que->franchise_code;
		 
       // echo $franchise_code.$state_id;
        $search= substr($franchise_code, -2);
        // echo $search;die;
        
        
         $data['schools']= $this->franchisemodel->school_list_fr22($state_id);
           $data['area']= $this->franchisemodel->area_list22($state_id);
           if(isset($_POST['submit'])){
              //print_r($_POST);die;
                $school=$_POST['school'];$class=$_POST['class'];$level=$_POST['level'];$product=$_POST['product'];$area=$_POST['area'];
                 $data['student']= $this->franchisemodel->studentreg_list_fr22($school,$class,$level,$product,$search,$state_id,$area);
                 //echo $area;
                 $data['result']=$_POST;
           }
           
           if(isset($_POST['Export'])){
            //   print_r($_POST);die;
               $school=$_POST['sch'];$class=$_POST['cla'];$level=$_POST['lev'];$product=$_POST['pro'];$area=$_POST['are'];
               //echo $area;die;
                 $student= $this->franchisemodel->studentreg_list_fr22($school,$class,$level,$product,$search,$state_id,$area);
                  $n=1;
         // print_r($student);die;
        $ln=$_POST['l'];
        $i=1;
		  foreach($student as $item)
		  {
		      //print_r($item);die;
    			   $data[] =array( 
        			  
        			   $i,
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['product_name'],
					   
        			   $item['period_id'],
        			   $ln,
					   $item['Time'],
        			   $item['school_name'],
					   $item['school_address1'],
        			   $item['class'],
        			   
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $item['status']
    			        );
			 //  print_r($data);die;
			$i++;$file_name=$item['product_name'].'_'.$ln.'_School_'.$school;
		}
		//$data=$data['schools'];
		//print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email','Payment Status'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                 
           }
           
        $this->load->view('student_extraction_competition_2022',$data);
    }

    public function student_extraction_orientation_2022()
    {
        $franchise_id=$this->session->userdata('franchise_id');
        //echo $franchise_id;die;
        
        $this->db->select('franchise_code,state_id');
	   	 $this->db->from('franchise');
         $this->db->where('franchise_id',$franchise_id);
         $query = $this->db->get(); 
         $que = $query->row(); 
	     $state_id= $que->state_id;
		 $franchise_code=$que->franchise_code;
		 
       // echo $franchise_code.$state_id;
        $search= substr($franchise_code, -2);
        // echo $search;die;
        
        
         $data['schools']= $this->franchisemodel->school_list_fr22($state_id);
           $data['area']= $this->franchisemodel->area_list22($state_id);
           if(isset($_POST['submit'])){
              //print_r($_POST);die;
                $school=$_POST['school'];$class=$_POST['class'];$level=$_POST['level'];$product=$_POST['product'];$type=$_POST['type'];$area=$_POST['area'];
                 $data['student']= $this->franchisemodel->studentori_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                 $data['result']=$_POST;
           }
           
           if(isset($_POST['Export'])){
            //   print_r($_POST);die;
               $school=$_POST['sch'];$class=$_POST['cla'];$level=$_POST['lev'];$product=$_POST['pro'];$type=$_POST['typ'];$area=$_POST['are'];
                 $student= $this->franchisemodel->studentori_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                  $n=1;
         // print_r($student);die;
        $ln=$_POST['l'];
        
		  foreach($student as $item)
		  {
		      
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data[] =array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['product_name'],
					   
        			   $item['period_id'],
        			   $ln,
					   $item['Time'],
        			   $item['school_name'],
					   $item['school_address1'],
        			   $item['class'],
        			   
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $type
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name='Orientation-'.$type.'_'.$item['product_name'].'_'.$ln.'_School'.$school;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email','Orientation Type'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                 
           }
           
        $this->load->view('student_extraction_orientation_2022',$data);
    }
    
    public function student_extraction_mock_2022()
    {
        $franchise_id=$this->session->userdata('franchise_id');
        //echo $franchise_id;die;
        
        $this->db->select('franchise_code,state_id');
	   	 $this->db->from('franchise');
         $this->db->where('franchise_id',$franchise_id);
         $query = $this->db->get(); 
         $que = $query->row(); 
	     $state_id= $que->state_id;
		 $franchise_code=$que->franchise_code;
		 
       // echo $franchise_code.$state_id;
        $search= substr($franchise_code, -2);
        // echo $search;die;
        
        
         $data['schools']= $this->franchisemodel->school_list_fr22($state_id);
           $data['area']= $this->franchisemodel->area_list22($state_id);
           if(isset($_POST['submit'])){
              //print_r($_POST);die;
                $school=$_POST['school'];$class=$_POST['class'];$level=$_POST['level'];$product=$_POST['product'];$type=$_POST['type'];$area=$_POST['area'];
                 $data['student']= $this->franchisemodel->studentmoc_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                 $data['result']=$_POST;
           }
           
           if(isset($_POST['Export'])){
            //   print_r($_POST);die;
               $school=$_POST['sch'];$class=$_POST['cla'];$level=$_POST['lev'];$product=$_POST['pro'];$type=$_POST['typ'];$area=$_POST['are'];
                 $student= $this->franchisemodel->studentmoc_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                  $n=1;
         // print_r($student);die;
        $ln=$_POST['l'];
        
		  foreach($student as $item)
		  {
		      
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data[] =array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['product_name'],
					   
        			   $item['period_id'],
        			   $ln,
					   $item['Time'],
        			   $item['school_name'],
					   $item['school_address1'],
        			   $item['class'],
        			   
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $type
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name='Mock-'.$type.'_'.$item['product_name'].'_'.$ln.'_School'.$school;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name".".csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email','Payment Mock Type'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                 
           }
           
        $this->load->view('student_extraction_mock_2022',$data);
    }
    
    public function student_extraction_material_2022()
    {
        $franchise_id=$this->session->userdata('franchise_id');
        //echo $franchise_id;die;
        
        $this->db->select('franchise_code,state_id');
	   	 $this->db->from('franchise');
         $this->db->where('franchise_id',$franchise_id);
         $query = $this->db->get(); 
         $que = $query->row(); 
	     $state_id= $que->state_id;
		 $franchise_code=$que->franchise_code;
		 
       // echo $franchise_code.$state_id;
        $search= substr($franchise_code, -2);
        // echo $search;die;
        
        
         $data['schools']= $this->franchisemodel->school_list_fr22($state_id);
           $data['area']= $this->franchisemodel->area_list22($state_id);
           if(isset($_POST['submit'])){
              //print_r($_POST);die;
                $school=$_POST['school'];$class=$_POST['class'];$level=$_POST['level'];$product=$_POST['product'];$type=$_POST['type'];$area=$_POST['area'];
                 $data['student']= $this->franchisemodel->studentmat_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                 $data['result']=$_POST;
           }
           
           if(isset($_POST['Export'])){
            //   print_r($_POST);die;
               $school=$_POST['sch'];$class=$_POST['cla'];$level=$_POST['lev'];$product=$_POST['pro'];$type=$_POST['typ'];$area=$_POST['are'];
                 $student= $this->franchisemodel->studentmat_list_fr22($school,$class,$level,$product,$search,$state_id,$type,$area);
                  $n=1;
         // print_r($student);die;
        $ln=$_POST['l'];
        
		  foreach($student as $item)
		  {
		      
		      //print_r($item);die;
		   	   $item['serial_no']=$n;
    			   $data[] =array( 
        			  
        			   $item['serial_no'],
        			   $item['cin'] ,
        			   $item['student_name'],
        			   $item['product_name'],
					   
        			   $item['period_id'],
        			   $ln,
					   $item['Time'],
        			   $item['school_name'],
					   $item['school_address1'],
        			   $item['class'],
        			   
        			   $item['stud_phone'].' - '.$item['father_phone'].' - '.$item['mother_phone'] ,
        			   $item['stud_email'].' - '.$item['father_email'].' - '.$item['mother_email'] ,
        			   $type
    			        );
			   //echo $item['serial_no'];exit;
			$n++;$file_name='Material-'.$type.'_'.$item['product_name'].'_'.$ln.'_School'.$school;
		}
	//	print_r($data);die;
        		header("Content-type: application/csv");
                header("Content-Disposition: attachment; filename=\"$file_name.csv\"");
                header("Pragma: no-cache");
                header("Expires: 0");
        
                $handle = fopen('php://output', 'w');
                fputcsv($handle, array('Serial No','Cin','Student Name','Product Name','Period_id','Level','Time','School Name','School Address','Class','Mobile','Email','Material Type'));
                $cnt=1;
                foreach ($data as $key) {
                    
                    fputcsv($handle, $key);
                }
                    fclose($handle);
                exit;
                 
           }
           
        $this->load->view('student_extraction_material_2022',$data);
    }
    
}

