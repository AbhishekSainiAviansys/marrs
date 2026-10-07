<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Cin_login extends CI_Controller {
    public function __construct() {
        parent::__construct();
       // echo $this->session->userdata('cin').'ok';die;
        if (!$this->session->userdata('cin')) {
            redirect('Log/index/', 'refresh');
        } 
		
		$this->load->library('encrypt');
		$this->load->library('session');
        $this->load->library('cart');
// 		$this->load->library("csv");
// 		$this->load->helper('form');
// 		$this->load->library('form_validation');
        $this->load->model('index');
        $this->load->model('newmodel');
	   
    }
	
    public function index() 
	{	
        
	    $cin=$this->session->userdata('cin');
	   // echo $cin;die;
	    $data['student']=$this->newmodel->get_student_data($cin);
	   
	   // print_r($data['student']);
	    $status='';
	    if(isset($_POST['register'])){
	        redirect('cin_login/net', 'refresh');
	    }
	    if(isset($_POST['submit'])){
	        //print_r($_POST);die;
	        if(array_key_exists("mother_name",$_POST)){
	            //print_r($_POST);die;
	            $status=$this->newmodel->update_student_data($cin,$_POST);
	        }
	        
	    }
	    
	    if($status=='yes'){
	       $this->session->set_flashdata('error',"Details update successful ...");
	    }else{
	       $this->session->set_flashdata('error',"OOPS, Details not updated ...");
    	}
	    
	    $this->load->view('cin_login/profile.php',$data);
    }
	
	public function profile_edit(){
	   // echo 'ok';die;
	   $status='';
	   $cin=$this->session->userdata('cin');
	   if(isset($_POST['submit'])){
	       //print_r($_POST);die;
	       $status=$this->newmodel->update_student_data($cin,$_POST);
	       //print_r($status);die;
	   }
	   if($status=='yes'){
	       $this->session->set_flashdata('error',"Details update successful ...");
	       redirect('Cin_login');
	   }else{
	       $this->session->set_flashdata('error',"OOPS, Details not updated ...");
	   }
	     
	     $data['student']=$this->newmodel->get_student_data($cin);
	     $this->load->view('cin_login/profile_edit.php',$data);
	}
	
	
	public function edit_cin_login(){
	    $cin=$this->session->userdata('cin'); 
	   // echo $cin;die;
	    if(isset($_POST['submit'])){
	        //print_r($_POST);die;
			$exitemail  = $this->db->get_where('cin_list',array('cin' =>cin))->row();
			if($_POST['stud_email']==$exitemail->stud_email){
				
				 $q=array(
	            'stud_email'=>$_POST['stud_email'],
	            'stud_phone'=>$_POST['stud_phone'],
				'father_email'=>$_POST['father_email'],
				'mother_name'=>$_POST['mother_name'],
				'father_name'=>$_POST['father_name']
	            );
				$this->db->where('cin', $cin);
				$query = $this->db->update('cin_list',$q);
				$this->session->set_flashdata('message', 'Profile Update Successfully.');
				
			}else{	
			//echo '---11';
			 $url = base_url().'Cin_login/emailverify/';
			 $otp= mt_rand(100000, 999999);
			 $this->session->set_userdata('otp',$otp);
			 $this->session->set_userdata('email',$_POST['stud_email']);
			 $message='<a href="'. $url.$otp .'">Click To Verify </a>';   
             $this->load->library('email'); 
            //$from_email; 	 		
            $this->email->from('enquiry@marrs.in', 'MaRRS');   
            $to_email = $_POST['stud_email'];	 
            $this->email->to($to_email);   
            $this->email->subject('Participent Registration Number');  
            $this->email->message($message);
            if($this->email->send()){
			 $this->session->set_flashdata('verify', 'Email Verification link sent on email Successfully.');
				} 
				else
				   {
				 $this->session->set_flashdata('error', 'Email Not Valid .');	  		 
				 }
			}
			
			
	       
            //redirect('cin_login/index', 'refresh');
            
	    }
	     $data['student']=$this->newmodel->get_student_data($cin);
	    $this->load->view('cin_login/profile_edit_contact.php',$data);
	}
	
	
	public function emailverify(){
		
		 $otp = $this->uri->segment(3);
		 $email = $this->session->userdata('email');
		  $vfotp = $this->session->userdata('otp');
		 $cin = $this->session->userdata('cin');
		 if(vfotp==$otp){
		        $q=array(
	            'stud_email'=>$_POST['stud_email']);     
				
				$this->db->where('cin', $cin);
				$query = $this->db->update('cin_list',$q);
				$this->session->set_flashdata('success', 'Email Update Successfully.'); 
				redirect('cin_login/edit_cin_login', 'refresh');	 
			
		}
		
	}
	
	
	public function product(){
	    
	    $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	   // print_r($school_id[0]['class']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    if(empty($data['cart'])){
	   // $data['product']=$this->newmodel->get_student_product($school);
	   
	        $data['product']=array('price_code'=>'21NT5500',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'5500',
                    );
	    }
	    $class=$school_id[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period);
	    $check=$this->newmodel->get_student_material_paid($cin,$product,$clevel,$class);
	    if(!empty($check)){
	    $data['material']=$this->newmodel->get_student_material($class,$subject,$product,$clevel);}
	    
	    
	    $this->load->view('cin_login/product.php',$data);
	}
	
	public function logout(){
	    $cin=$this->session->userdata('cin');
	    $this->db->where('cin', $cin);
        $this->db->delete('statewise_addtocart');
	    $this->session->unset_userdata('cin');
	    redirect('cin_login/index', 'refresh');
	}

	public function free_material(){
	    
	    $class=$this->input->post('class');
	    $subject=$this->input->post('subject');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	   // echo $class;
	   // echo $subject.'ok';
	   // echo $product;
	   // echo 
	   $clevel=$clevel-1;
	   // echo $clevel;
	   // die;
	    $data['material']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    //print_r($data['material']);
       // echo 'ok';die;
        
        if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_free/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
    }
    
    
    
    
    public function paid_material(){
	    $class=$this->input->post('class');
	    $subject=$this->input->post('subject');
	    $product=$this->input->post('product');
	    $clevel=$this->input->post('clevel');
	    $period=$this->input->post('period');
	   // echo $class.'<br>';
///echo $subject.'<br>';
	   // echo $product.'<br>';
	   // echo $period.'<br>';
	   // echo $clevel.'<br>';
	   
	   $clevel=$clevel-1;
	   // echo $clevel;
	   // die;
	    $data['material']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period); 
	   // print_r($data['material']);
        //echo 'ok';die;
        
        if(isset($_POST['download'])){
               $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../study_material_paid/".$file_name;
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
        if(isset($_POST['back'])){
            redirect('cin_login/play_learn', 'refresh');
        }
        $this->load->view('cin_login/material_files', $data);
    
    }
// ------------------------------------------------- //

 public function checkout() {
      
            $cin=$this->session->userdata('cin');
            $student=$this->newmodel->get_student_data($cin);
            $amount=$_POST['amount'];
            //print_r($student[0]);die;
            $name=$student[0]['student_name'];
            $email=$student[0]['stud_email'];
            $mobile=$student[0]['stud_phone'];
      // print_r($mobile);die;
            $data['name']=$name;
            $data['email']=$email;
            $data['mobile']=$mobile;
            $data['amount']=$amount;
    	    $data['title'] = 'Checkout payment ';  
            $data['product_name'] = $_POST['product_name'];
            $data['return_url'] = base_url().'neww/callback';
            $data['surl'] = base_url().'neww/success';
            $data['furl'] = base_url().'neww/failed';
            $data['currency_code'] = 'INR';
            $this->session->set_userdata('amount', $amount);
            $this->session->set_userdata('products', $_POST['product_name']);
            $this->load->view('cin_login/checkout', $data);
    }

    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $arr=$this->session->userdata('products');
        $this->session->set_userdata('amount', $amount);
        $this->session->set_userdata('products', $arr);
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = 'rzp_live_UMziCF38129HCi';
        $key_secret = 'nMj5U0daHbD6KxINizRDg8m6';
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function callback() {   
       // print_r($_POST);exit;
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $this->session->set_userdata('amount_data',$_POST);
            redirect('cin_login/success');
            
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    public function success() {
        $cin=$this->session->userdata('cin');
        
        $amount_data=$this->session->userdata('amount_data');
        $amount=0;
        $arr=$this->session->set_userdata('products');
        $this->session->set_userdata('amount', $amount);
        $this->session->set_userdata('products', $arr);
        $product_name=$this->session->userdata('products');    
        $data['title'] = 'Razorpay Success ';  
        // echo 'success'.'<br>';
        $prid=$_SESSION['cin'];
        $data['session']=$_SESSION;
        $this->newmodel->cart_new($cin,$amount_data);
        $this->db->where('cin', $cin);
        $this->db->delete('amount_cart');
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/success', $data);
    }  
    public function failed() {
        $cin=$this->session->userdata('cin');
        $data['arr']=$this->session->userdata('products');
        $data['amount']=$this->session->userdata('amount');
        
        $data['title'] = 'Razorpay Failed';   
        $data['session']=$_SESSION;
        $data['student']=$this->newmodel->get_student_data($cin);
        $this->load->view('cin_login/tranctionfailed', $data);
    } 
	

    public function study_material(){
        $cin=$this->session->userdata('cin');
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel);
	    //$check=$this->newmodel->get_student_material_paid($cin,$product,$clevel,$class);
	    $data['material']=$this->newmodel->get_student_material($class,$subject,$product,$clevel);
        $this->load->view('cin_login/material', $data);
    }
    
       public function net_abc($id=''){
        
        $amount = $this->input->post('id');
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin);
        $res = $this->db->get_where('amount_cart',array('amount' =>$amount,'cin' =>$cin))->row();
        if($amount != $res->amount){
         $query = $this->db->insert('amount_cart',$data);
        }
        
       return $data;
        
       }
	   
	   public function new_statewise($id=''){
        
        $amount = $this->input->post('id'); 
		$material = $this->input->post('material'); 
		$level = $this->input->post('level'); 
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin,'material_name' =>$material,'clevel' =>$level);
        $res = $this->db->get_where('statewise_addtocart',array('amount' =>$amount,'cin' =>$cin))->row();
        if($amount != $res->amount){
         $query = $this->db->insert('statewise_addtocart',$data);  
        }
        
       return $data;
        
       }
       
       
        public function remove_misb($id=''){
        
        $amount = $this->input->post('id');
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin);
        $res = $this->db->get_where('amount_cart',array('amount' =>$amount,'cin' =>$cin))->row();
        if($amount == $res->amount){
         $query = $this->db->delete('amount_cart',$data);
        }
        
       return $data;
        
       }
	   
	   
	   
	   public function remove_misb_state($id=''){
        
        $amount = $this->input->post('id');
		
        $cin  = $this->session->userdata('cin');
        $data = array('amount' => $amount,'cin' =>$cin);
        $res = $this->db->get_where('statewise_addtocart',array('amount' =>$amount,'cin' =>$cin))->row();
		//print_r($res);exit;  
        if(!empty($res->amount)){
          
         $query = $this->db->delete('statewise_addtocart',$data);
        }
        
       return $data;
        
       }
       
    public function close(){
        $this->load->view('cin_login/registration_close');
        
    }   
    public function play_learn(){
        //echo 'ok';die;
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	    //print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);
	    // print_r( $data['result']);exit;
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'22IN350',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'350'
                    );
        
            $data['study_material_new']=array('price_code'=>'22INT250',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'250'
                    );
            $data['orientation_new']=array('price_code'=>'22IN950',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'959'
                    );
            $data['mock_test_new']= array('price_code'=>'22IN200',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'200'
	    );
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	    if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'22INT350',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'350'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2='';
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'22IN250',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'250'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'22NT950',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'950'
                                );
                                $d3='d3';
                	        }
                	       // ==== mock test ==== //
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT200',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'200'
                                );
                	            $d4='d4';
                	        }
                	        
                	        
                	        // =====  end  ===== //
                	        
                	        
                	       // echo 'okk'.'-'.$d4;die;
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       //   echo 'okk';die;
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         // echo 'ok';die;
                        	     }
                        	     
	    }	
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $clevel;die;
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    //print_r($data['material_free']);exit;
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);
	     //print_r($data['material_paid']);exit;  
	    
	    
	    
	   // ------------------------------------ //
	   
	    $data['orientation1']=$student=$this->newmodel->check($cin,$period,'orientation',$clevel);
	    $data['rivision']=$student=$this->newmodel->check($cin,$period,'revision',$clevel);
	    $data['mock_test']=$student=$this->newmodel->check($cin,$period,'mock_test',$clevel);
	    $data['study_material']=$student=$this->newmodel->check($cin,$period,'study_material',$clevel);
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    $data['activate']=$this->newmodel->activate($product);
	    
	    
	    
	    // ------------------------------------- //
         $this->load->view('cin_login/play_learn',$data);
    }  
       
       
      
 public function nationallevel(){
        //echo 'ok';die;
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	    //print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);
	    // print_r( $data['result']);exit; 
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'21IN6850',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'6850'
                    ); 
        
            $data['study_material_new']=array('price_code'=>'21INT550',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'550'
                    );
            $data['orientation_new']=array('price_code'=>'21IN999',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'999'
                    );
            $data['mock_test_new']= array('price_code'=>'21IN350',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'350'
	    );   
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	    if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'21INT6800',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'6800'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2=''; 
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'21IN550',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'550'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'21NT999',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'999'
                                );
                                $d3='d3';
                	        }
                	       // ==== mock test ==== //
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT350',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'350'
                                );
                	            $d4='d4';  
                	        }
                	        
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         
                        	     }
                        	     
	    }	
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $clevel;die;
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period); 
	    
	    
	    
	    
	   // ------------------------------------ //
	   
	    $data['orientation1']=$student=$this->newmodel->check($cin,$period,'orientation',$clevel);
	    $data['rivision']=$student=$this->newmodel->check($cin,$period,'revision',$clevel);
	    $data['mock_test']=$student=$this->newmodel->check($cin,$period,'mock_test',$clevel);
	    $data['study_material']=$student=$this->newmodel->check($cin,$period,'study_material',$clevel);
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    $data['activate']=$this->newmodel->activate123($product,$clevel);
	    //print_r($data['activate']);exit;   
	    
	    
	    // ------------------------------------- //
         $this->load->view('cin_login/national_level',$data);
    }  
      	  
    

public function competition_statewise(){  
        //echo 'ok';die;
        error_reporting(E_ALL);  
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
		$state_id = $school_id[0]['state_id'];
	    //print_r($school_id[0]['state_id']);die;
	    $data['result']=$this->newmodel->get_student_result($cin);
	    //print_r($data['result'][0]['clevel']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin,$data['result'][0]['clevel']);
	    
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    
	    
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	   
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    //echo $clevel;die;
	    
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    //print($data['material_free']);exit;  
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);  
	   
		//print_r($result);exit;
		
	    $data['orientation1']=$student=$this->newmodel->checkorientation($cin,$period,'orientation',$clevel);
	    
	    $data['mock_test']=$student=$this->newmodel->checkmock($cin,$period,'mock_test',$clevel);
	    
		
		$data['study_material']=$student=$this->newmodel->checkstudy($cin,$period,'study_material',$clevel); 
		
		
	    $data['cometition']=$student=$this->newmodel->check_cometition($cin,$period,$clevel);
	//print_r($data['cometition']);exit; 
	    $data['price']=$this->newmodel->price($product,$period,$clevel);
	    $data['activate']=$this->newmodel->activate_state($product,$clevel,$state_id,$product);
		
	    $this->load->view('cin_login/competition_statewise.php',$data);     
    }  
  

	
    public function products(){
        //echo 'ok';die;
            error_reporting(E_ALL);
        ini_set('display_errors', 0);
        $cin=$this->session->userdata('cin');
	    $school_id=$this->newmodel->get_student_data($cin);
	    $school=$school_id[0]['school_id'];
	    //print_r($school_id[0]['class']);die;
	    $data['cart']=$this->newmodel->get_student_cart($cin);
	    $data['result']=$this->newmodel->get_student_result($cin);
	    $data['student']=$this->newmodel->get_student_data($cin);
	    $student=$this->newmodel->get_student_data($cin);
	    //print_r($data['cart']);die;
	    //$data['cart']='';
	    
	    if(empty($data['cart'])){
	       // echo 'ok';die;
	        $data['product_new']=array('price_code'=>'21NT5500',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'5500'
                    );
        
            $data['study_material_new']=array('price_code'=>'21NT450',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'450'
                    );
            $data['orientation_new']=array('price_code'=>'21NT900',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'900'
                    );
            $data['mock_test_new']= array('price_code'=>'21NT900',
                    'school_name'=>$school_id[0]['school_name'],
                    'amount'=>'250'
	    );
	    }
	    else{
	        
	       // ================ ok ===================== //
	       
	       $copp=$data['cart'];
	       //print_r($copp[0]);die;
	       $copp1=$copp[0];
	       $copp2=$copp[1];
	       $copp3=$copp[2];
	       $copp4=$copp[3];
	       //print_r($copp2);die;
	            	   // print_r($row['status']);
            	            if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
            	               $data['product_new']='';
            	               $d1='';
            	               // echo 'ok';die;
            	            }else{
            	            $data['product_new']=array('price_code'=>'21NT5500',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'5500'
                                );
                                $d1='d1';
                                // echo 'ok';die;
            	            }
            	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
            	                $data['study_material_new']='';
            	                $d2='';
            	            }else{
            	            
            	            $data['study_material_new']=array('price_code'=>'21NT450',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'450'
                                );
                                $d2='d2';
            	            }
            	            
            	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
            	                $data['orientation_new']=''; 
            	                 $d3='';
                	        }
                	        else{
                	            
                	            $data['orientation_new']=array('price_code'=>'21NT900',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'900'
                                );
                                $d3='d3';
                	        }
                	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
            	                 $data['mock_test_new']='';
            	                 
            	                  $d4='';
                	        }else{
                	           
                	            $data['mock_test_new']= array('price_code'=>'21NT240',
                                'school_name'=>$school_id[0]['school_name'],
                                'amount'=>'250'
                                );
                	            $d4='d4';
                	        }
                	       // echo 'okk'.'-'.$d4;die;
                	        
            	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
            	                    $data['all_paid_new']='yes';
            	       //   echo 'okk';die;
                    	         }
                        	     else{
                        	         $data['all_paid_new']='';
                        	         // echo 'ok';die;
                        	     }
                        	     
	    }	
	     //     // ================ ok ===================== //
	   //    $data['orientation_status']=$this->newmodel->orientation_status();
	   
	    
	   //  $data['amount']=$this->newmodel->c_data($cin);
	   
	   //  if(isset($_POST['add'])){
	   //            // $amt=$this->input->post('amount');
	   //             $amt= $_POST['add'];
	   //            // echo $amt;die;
	   //             $this->newmodel->add($amt,$cin);
	   //  }
	   //  if(isset($_POST['remove'])){
	   //             $amt= $_POST['remove'];
	   //             $this->newmodel->remove($amt,$cin);
	   //  }
	     
	     
	    $class=$student[0]['class'];
	    $subject='';
	    $product=$data['result'][0]['product_name'];
	    $clevel=$data['result'][0]['clevel'];
	    $period=$data['result'][0]['period_id'];
	    $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	    $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);
	    
        $this->load->view('cin_login/product',$data);
        
        
    //     error_reporting(E_ALL);
    //     ini_set('display_errors', 0);
    //     $cin=$this->session->userdata('cin');
	   // $school_id=$this->newmodel->get_student_data($cin);
	   // $school=$school_id[0]['school_id'];
	   // //print_r($school_id[0]['class']);die;
	   // $data['cart']=$this->newmodel->get_student_cart($cin);
	   // $data['result']=$this->newmodel->get_student_result($cin);
	   // $data['student']=$this->newmodel->get_student_data($cin);
	   // $student=$this->newmodel->get_student_data($cin);
	   // //print_r($data['cart']);die;
	   // //$data['cart']='';
	    
	   // if(empty($data['cart'])){
	   //    // echo 'ok';die;
	   //     $data['product_new']=array('price_code'=>'21NT5500',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'5500'
    //                 );
        
    //         $data['study_material_new']=array('price_code'=>'21NT450',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'450'
    //                 );
    //         $data['orientation_new']=array('price_code'=>'21NT900',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'900'
    //                 );
    //         $data['mock_test_new']= array('price_code'=>'21NT900',
    //                 'school_name'=>$school_id[0]['school_name'],
    //                 'amount'=>'250'
    //                 );
	   // }
	   // else{
	        
	   //    // ================ ok ===================== //
	       
	   //    $copp=$data['cart'];
	   //    //print_r($copp[0]);die;
	   //    $copp1=$copp[0];
	   //    $copp2=$copp[1];
	   //    $copp3=$copp[2];
	   //    $copp4=$copp[3];
	   //    //print_r($copp2);die;
            	        
    //         	   // print_r($row['status']);
    //         	            if($copp1['status']=='Paid' or $copp2['status']=='Paid' or $copp3['status']=='Paid' or $copp4['status']=='Paid'){
    //         	               $data['product_new']='';
    //         	               $d1='';
    //         	               // echo 'ok';die;
    //         	            }else{
    //         	            $data['product_new']=array('price_code'=>'21NT5500',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'5500'
    //                             );
    //                             $d1='d1';
    //                             // echo 'ok';die;
    //         	            }
    //         	            if($copp1['study_material']=='Yes' or $copp2['study_material']=='Yes' or $copp3['study_material']=='Yes' or $copp4['study_material']=='Yes'){
    //         	                $data['study_material_new']='';
    //         	                $d2='';
    //         	            }else{
            	            
    //         	            $data['study_material_new']=array('price_code'=>'21NT450',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'450'
    //                             );
    //                             $d2='d2';
    //         	            }
            	            
    //         	            if($copp1['orientation']=='Yes' or $copp2['orientation']=='Yes' or $copp3['orientation']=='Yes' or $copp4['orientation']=='Yes'){
    //         	                $data['orientation_new']=''; 
    //         	                 $d3='';
    //             	        }
    //             	        else{
                	            
    //             	            $data['orientation_new']=array('price_code'=>'21NT900',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'900'
    //                             );
    //                             $d3='d3';
    //             	        }
    //             	        if($copp1['mock_test']=='Yes' or $copp2['mock_test']=='Yes' or $copp3['mock_test']=='Yes' or $copp4['mock_test']=='Yes'){
    //         	                 $data['mock_test_new']='';
            	                 
    //         	                  $d4='';
    //             	        }else{
                	           
    //             	            $data['mock_test_new']= array('price_code'=>'21NT240',
    //                             'school_name'=>$school_id[0]['school_name'],
    //                             'amount'=>'250'
    //                             );
    //             	            $d4='d4';
    //             	        }
    //             	       // echo 'okk'.'-'.$d4;die;
                	        
    //         	                 if($d1=='' and $d2=='' and $d3=='' and $d4==''){
    //         	                    $data['all_paid_new']='yes';
    //         	       //   echo 'okk';die;
    //                 	         }
    //                     	     else{
    //                     	         $data['all_paid_new']='';
    //                     	         // echo 'ok';die;
    //                     	     }
                        	     
	   // }	        
            	        
	   //     // ================ ok ===================== //
	   //    $data['orientation_status']=$this->newmodel->orientation_status();
	   
	    
	   //  $data['amount']=$this->newmodel->c_data($cin);
	   
	   //  if(isset($_POST['add'])){
	   //            // $amt=$this->input->post('amount');
	   //             $amt= $_POST['add'];
	   //            // echo $amt;die;
	   //             $this->newmodel->add($amt,$cin);
	   //  }
	   //  if(isset($_POST['remove'])){
	   //             $amt= $_POST['remove'];
	   //             $this->newmodel->remove($amt,$cin);
	   //  }
	     
	     
	   // $class=$student[0]['class'];
	   // $subject='';
	   // $product=$data['result'][0]['product_name'];
	   // $clevel=$data['result'][0]['clevel'];
	   // $period=$data['result'][0]['period_id'];
	   // $data['material_free']=$this->newmodel->get_student_material_free($class,$subject,$product,$clevel,$period); 
	    
	   // $data['material_paid']=$this->newmodel->get_student_material($class,$subject,$product,$clevel,$period);
	   // $this->load->view('cin_login/product',$data);
    }



	public function orientationslip(){
	   
	       $cin = $_SESSION['cin'];
	    
	    $this->db->select('product_name');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $datalogo = $this->db->get()->row()->product_name;
             //echo $datalogo;die;
             
             
             if($datalogo=='MaRRS International Spelling Bee'){
             $image  = base_url().'images/misb_logo.jpg';
             
            
             }
             if($datalogo=='MaRRS Preschool Bee Math'){
              $image  = base_url().'images/math_logo.png';
            
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                  $image  = base_url().'images/english_logo.png';
             
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                  $image  = base_url().'images/science_logo.png';
              
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 $image  = base_url().'images/humanities_logo.png';
               
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                  $image  = base_url().'images/jun.png';
               
             }
             
	    
	         $this->db->select('cin,class,student_name');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
	    
	    
	    
	    
$fname =  $data->student_name;;
$cin =  $data->cin;

$product = $datalogo;

$categoery = $data->class;

include APPPATH . 'third_party/fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","",16);

$pdf->Cell( 190, 30, $pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 1, 'C' );
$pdf->Cell(190,10,"Participation Slip - Orientation Class ",0,1,'C');
$pdf->Cell(0,10,"",0,1);


$pdf->Cell(70,10,"CIN Number :",1,0);
$pdf->Cell(120,10,$cin,1,1); 

$pdf->Cell(70,10,"Name of the participant :",1,0);
$pdf->Cell(120,10,$fname,1,1);

$pdf->Cell(70,10,"Category:",1,0);
$pdf->Cell(120,10,$categoery,1,1);

$pdf->Cell(70,10,"Product Name:",1,0);
$pdf->Cell(120,10,$product,1,1);

$pdf->Cell(70,10," Orientation Slip Number:",1,0);
$pdf->Cell(120,10,"OR ".$cin,1,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Thank you for registering for the orientation program for 
",0,1);
$pdf->Cell(100,10, $product ." National Level Championship 2021/22",0,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Your participation is confirmed.
",0,1);

$pdf->Cell(100,10,"The schedule of your session will be communicated to you shortly.
",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
//$pdf->Cell(0,10,"",0,1);
$pdf->Cell(190,4," Powered By Aviansys Technologies Private Limited "
,0,1,'C');

$pdf->output();


	   
	}
	 public function mocktest(){
         $cin = $_SESSION['cin'];
         
           $pname = "MPCI";
           $this->db->select('*');
           $this->db->from('new_cart');
           $this->db->where('cin',$cin);
           $this->db->where('clevel','4');
           $result = $this->db->get()->row();
           $register_paid = $result->status;
           $chest = $result->mocktest_slip;
           $this->db->select('max(mocktest_slip) as mocktest_slip');
            $this->db->from('new_cart');
        		     $this->db->like('mocktest_slip',$pname);
        		     $Step2Query = $this->db->get();  
        		     $Step2QueryResult=$Step2Query->row_array();
        			 
        			 $max_access_code =$Step2QueryResult['mocktest_slip'];
        			 
        			 if(empty($max_access_code) || $max_access_code ==" ")
        			 {
        				
        			    $chestnumber=$pname."1000";
        				   //echo "empty";exit;
        			 }
        			 else
        			 {
        				  $firsthalf_test_school_code = substr($max_access_code,'0','4');
        			     $test_school_code = substr($max_access_code,'4','8') +1;
        				 $chestnumber = $firsthalf_test_school_code.$test_school_code;
        			
        			 }
           // echo $chestnumber;exit;
           
           
         if($register_paid=='Paid' && empty($chest)){
          $chest_number = $chestnumber;
          $data = array('mocktest_slip' =>$chest_number
              );
          $this->db->where('cin',$cin);
          $this->db->where('status','Paid');
          $this->db->update('new_cart',$data); 
         }
        $data['mocktest_slip'] = $chest;
             
          $this->load->view('cin_login/mocktest_slip',$data);
             
       // }
        
    }
     public function orientation(){
        $cin = $_SESSION['cin'];
         
           $pname = "OPCI";
           $this->db->select('*');
           $this->db->from('new_cart');
           $this->db->where('cin',$cin);
           $this->db->where('clevel','4');
           $result = $this->db->get()->row();
           $register_paid = $result->status;
           $chest = $result->orientation_slip;
           $this->db->select('max(orientation_slip) as orientation_slip');
            $this->db->from('new_cart');
        		     $this->db->like('orientation_slip',$pname);
        		     $Step2Query = $this->db->get();  
        		     $Step2QueryResult=$Step2Query->row_array();
        			 
        			 $max_access_code =$Step2QueryResult['orientation_slip'];
        			 
        			 if(empty($max_access_code) || $max_access_code ==" ")
        			 {
        				
        			    $chestnumber=$pname."1000";
        				   //echo "empty";exit;
        			 }
        			 else
        			 {
        				 $firsthalf_test_school_code = substr($max_access_code,'0','4');
        			     $test_school_code = substr($max_access_code,'4','8') +1;
        				 $chestnumber = $firsthalf_test_school_code.$test_school_code;
        			
        			 }
            //echo $test_school_code;exit;
           
           
         if($register_paid=='Paid' && empty($chest)){
          $chest_number = $chestnumber;
          $data = array('orientation_slip' =>$chest_number
              );
          $this->db->where('cin',$cin);
          $this->db->where('status','Paid');
          $this->db->update('new_cart',$data); 
         }
        $data['orientation_slip'] = $chest;
        $this->load->view('cin_login/orientation_slip',$data);
        
    }
	
	public function mocktest_ss(){
	   
	       $cin = $_SESSION['cin'];
	    
	    $this->db->select('product_name');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $datalogo = $this->db->get()->row()->product_name;
             //echo $datalogo;die;
             
             
             if($datalogo=='MaRRS International Spelling Bee'){
             $image  = base_url().'images/misb_logo.jpg';
             
            
             }
             if($datalogo=='MaRRS Preschool Bee Math'){
              $image  = base_url().'images/math_logo.png';
            
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                  $image  = base_url().'images/english_logo.png';
             
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                  $image  = base_url().'images/science_logo.png';
              
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 $image  = base_url().'images/humanities_logo.png';
               
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                  $image  = base_url().'images/jun.png';
               
             }
             
	    
	         $this->db->select('cin,class,student_name');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
	    
	    
	    
	    
$fname =  $data->student_name;;
$cin =  $data->cin;

$product = $datalogo;

$categoery = $data->class;

include APPPATH . 'third_party/fpdf/fpdf.php';
$pdf= new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","",16);

$pdf->Cell( 190, 30, $pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 1, 'C' );
$pdf->Cell(190,10,"Participation Slip - Mock Test ",0,1,'C');
$pdf->Cell(0,10,"",0,1);


$pdf->Cell(70,10,"CIN Number :",1,0);
$pdf->Cell(120,10,$cin,1,1); 

$pdf->Cell(70,10,"Name of the participant :",1,0);
$pdf->Cell(120,10,$fname,1,1);

$pdf->Cell(70,10,"Category:",1,0);
$pdf->Cell(120,10,$categoery,1,1);

$pdf->Cell(70,10,"Product Name:",1,0);
$pdf->Cell(120,10,$product,1,1);

$pdf->Cell(70,10," Slip Number:",1,0);
$pdf->Cell(120,10,"MC ".$cin,1,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Thank you for registering for the Mock Test program for 
",0,1);
$pdf->Cell(100,10, $product ." National Level Championship 2021/22",0,1);

$pdf->Cell(0,10,"",0,1);

$pdf->Cell(100,10,"Your participation is confirmed.
",0,1);

//$pdf->Cell(100,10,"The schedule of your session will be communicated to you shortly.",0,1);
$pdf->Cell(100,10,"Note - Please note that the MOCK TEST will be conducted on 28th onwards.
",0,1);


$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);

$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
$pdf->Cell(0,10,"",0,1);
//$pdf->Cell(0,10,"",0,1);
$pdf->Cell(190,4," Powered  By Aviansys Technologies Private Limited "
,0,1,'C');

$pdf->output();

}
	
		public function admitcard(){
	    $data['cin']=$this->session->userdata('cin');
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	  $this->load->view('cin_login/admitcard',$data);
	}
	public function admitcardodisha(){
	    $data['cin']=$this->session->userdata('cin');
	    if(isset($_POST['back'])){
	       // print_r($_POST);die;
	       redirect('cin_login/net', 'refresh');
	    }
	  $this->load->view('cin_login/admitcard_orisha',$data);
	}
	
	
	
public function certificateform(){
    
        $this->load->view('cin_login/certificateform');
    
}		
	
	
public function certificate(){
    //print_r($_POST);exit;
	    $data['data']=$_POST;
        $this->load->view('cin_login/certificate',$data);
    
}	
	
	
	
	
	
	
}/* END OF CLASS*/