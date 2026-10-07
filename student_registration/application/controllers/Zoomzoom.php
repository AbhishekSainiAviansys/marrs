<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Zoomzoom extends CI_Controller {
    public function __construct() {
        parent::__construct();
       // echo $this->session->userdata('cin').'ok';die;
        
		
		//$this->load->library('encrypt');
		$this->load->library('session');
        //$this->load->library('cart');
// 		$this->load->library("csv");
// 		$this->load->helper('form');
// 		$this->load->library('form_validation');
        //$this->load->model('Index');
        $this->load->model('Newmodel');
	   $this->load->model('zoommodel');
    }
	
    public function index() 
	{	
    
	    if(isset($_POST['submit'])){
	        //print_r($_POST['access_code']);die;
          $result = $this->zoommodel->access_code($_POST['access_code']);
	       //print_r($result[0]);die;
	       if(!empty($result)){
	            $this->session->set_userdata('frid', $result[0]['franchise_id']);
	            
	            
	            //echo $result[0]['franchise_id'];die;
	            $this->session->set_userdata('frid', $result[0]['franchise_id']);
	            
	            $this->session->set_userdata('zid', $result[0]['zoomzoom_access_code']);
	            
	           // echo $this->session->userdata('frid');die;
	            
	            
                redirect('zoomzoom/registration', 'refresh');
	       }
	       else{
	           $this->session->set_flashdata('error','Wrong Access Code ...');
	       }
        }
	    $this->load->view('zoomzoom/franchise_verify.php');
    }
    
    
    public function studentdata(){
    
       $email = $this->session->userdata('email');
     // $data['studentzoom']= $this->db->get_where('cin_zoomzoom', array('email' => $email))->result_array();
      $data['students']= $this->db->get_where('students', array('email' => $email))->row_array();
       $data['student']= $this->db->join('study_material_byprid','students.PRID=study_material_byprid.prid')->get_where('students', array('students.email' => $email))->result_array();
      //print_r($data['student']);die;
     $this->load->view('list_cinproductdata',$data);
}
public function zoom_cin_login(){
        $url = $this->uri->segment(3);
        $this->session->set_userdata('id',$url);
        $this->db->select('*');
        $this->db->from('cin_zoomzoom');
        $this->db->where('id',$url);
        $query = $this->db->get();
         
        $data['zoomzoom']= $query->result_array();
        $student=$query->row_array();
        
        
        //print_r($student);die;
        $school_code=$student['school_code'];
        $period=$student['period_id'];
        $this->db->select('*');
        $this->db->from('product_to_school');
        $this->db->join('price_codegenration','price_codegenration.id=product_to_school.pricecode_id');
        $this->db->where('product_to_school.product_id','39');
        $this->db->where('product_to_school.level_id','14');
        $this->db->where('product_to_school.school_code',$school_code);
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        $data['cart']=$query->row_array();
    $this->load->view('zoomzoom/new_cart.php',$data);
}

    public function remove_misb1($id=''){
            
         $token = $this->input->post('id');
        echo $id  = $this->session->userdata('id');
        print_r($_POST);exit;
        $data = array('prid' =>$prid,'token'=>$token);
        //print_r($data);exit;
        //$res = $this->db->get_where('zoomzoom_amount_cart',array('prid' =>$prid,'token'=>$token))->row();
        //if($token == $res->token){
         $query = $this->db->delete('zoomzoom_amount_cart',$data);
        //}
        
       return $data;
        
       }

     public function net_abc1($id=''){
           
         $token = $this->input->post('id');
        echo $id  = $this->session->userdata('id');
        print_r($_POST);exit;
        $token = $this->input->post('id');
       // echo $token;
        $amount=0;
        $hint = $token[0];
        if($hint=='s'){
            $amount=495;
        }
        if($hint=='z'){
            $amount=299;
        }
        if($hint=='o'){
            $amount=750;
        }
        if($hint=='m'){
            $amount=260;
        }
        
        $prid  = $this->session->userdata('id');
        // $token = $this->input->post('token');
        
        $data = array('amount' => $amount,'prid' =>$prid,'token'=>$token);
        //print_r($data);die;  
        $res = $this->db->get_where('zoomzoom_amount_cart',array('prid' =>$prid,'token'=>$token))->row();
        if($token != $res->token){
         $query = $this->db->insert('zoomzoom_amount_cart',$data);
        }
        
       return $data;
        
       }
       
       
    public function registration() 
	{	
	  //  echo $this->session->userdata('id');
	   // echo $this->session->userdata('frid');die;
	    
        $data['id']= $this->session->userdata('zid');
        $frid= $this->session->userdata('frid');
        
       // echo $frid; $data['id'];die;
        
        
    	    if(isset($_POST['submit'])){
    	        //print_r($_POST);die;
    	       
    		    $arr = array(
        			'first_name' => $this->input->post('first_name'),
        			'middle_name' => $this->input->post('middle_name'),
        			'last_name' => $this->input->post('last_name'),
        			'class_id' => $this->input->post('class'),
        			'gender' => $this->input->post('gender'),
        			'father_name' => $this->input->post('father_name'),
        			'mother_name' => $this->input->post('mother_name'),
        			'mobile' => $this->input->post('mobile'),
        			'whatsapp' => $this->input->post('whatsapp'),
        			'email' => $this->input->post('email'),
        			'address_line' => $this->input->post('address_line'),
        			'pin' => $this->input->post('pin'),
        			'city' => $this->input->post('city'),
        			'state' => $this->input->post('state'),
        			'dob' => $this->input->post('dob'),
        			'status' => 'Active',
        			'franchise_id' => $frid,
        			'level_id'=>'1'
        			
    		    );
    		    //print_r($arr);die;
    		    
    		    $cin = $this->zoommodel->prid_create($arr);
    		    
    		    $email=$this->input->post('email');
    		    //$email='abhisheksaini.iimt@gmail.com';
    		    
    		    $name=$this->input->post('first_name').' '.$this->input->post('middle_name').' '.$this->input->post('last_name');
    		    $from_email = "customerrelations@marrs.in";
    		    
    		    $message="Hello, congratulations ".$name.' for registering successfully! <br> Your ZoomZoom Participant Registration Number  (PRN) is '.$cin.' . <br> You can  pay and enroll for any competition or training after logging on to the marrs.in portal using the PRID as username and password. <br> You can also buy learning material for any MaRRS activity. <br> <br> Once you pay and register for MaRRS competition you will be issued a Candidate Identification Number (CIN). <br> <br> You will be able to download any learning material immediately on its purchase. Please ensure that you download  Registration Slips when you enlist for Orientation or Mock Tests.';
                $this->load->library('email'); 
                $this->email->from($from_email, 'MaRRS'); 
                $this->email->to($email);
                $this->email->subject('ZoomZoom Participent Registration Number'); 
                $this->email->message($message);
                if($this->email->send()) {
                 $em= "email sent Email sent successfully.";} 
                 else {
                 $em= "email sent error in sending Email.";
                 }
    		    
    		    
    		    
    		    
    		    $this->session->set_userdata('name', $name);
    		    $this->session->set_userdata('id', $cin);
                redirect('zoomzoom/success_reg', 'refresh');
                
            }
	    $this->load->view('zoomzoom/registration_form.php',$data);
    }
    
// ======================================================================= //    
    
    public function success_reg(){
        $data['id']= $this->session->userdata('id');
        $data['name']= $this->session->userdata('name');
         if(isset($_POST['submit'])){
             $this->session->unset_userdata('id');
             $this->session->unset_userdata('name');
             redirect('zoomzoom/zoomzoom_cin_login', 'refresh');
         }
         $this->session->sess_destroy();
        $this->load->view("zoomzoom/success_reg",$data);
    }
    
    
    
// ============================================================================= //    
    
    public function zoomzoom_register(){
        
        if(isset($_POST['check'])){
            $code = $this->input->post('schoolaccesscode');
           // print_r($code);exit;
            if($code)
                $acess_code = $this->db->get_where('franchise_to_zoomzoom', array('zoomzoom_access_code' => $code))->row_array();
            
                $result_prid     = $this->db->get_where('students', array('prid' => $code))->row_array();
             
                $result_cin    = $this->db->get_where('cin_list', array('cin' => $code))->row_array();
                 
               $zoomzoom_prid = $this->db->get_where('student_to_zoomzoom', array('zoomzoom_prid' => $code))->row_array();
            
            if($acess_code){
                //print_r($zoomzoom_prid);exit;
                $this->session->set_userdata('id', $zoomzoom_prid['zoomzoom_access_code']);
                redirect('zoomzoom', 'refresh');
                
            }elseif($result_cin){
                
                $this->session->set_userdata('id', $result_cin['cin']);
                //$this->session->set_userdata('school_code', $result_prid['school_code']);
                redirect('zoomzoom/cin_login', 'refresh');
                
            }elseif($result_prid){
               
                $this->session->set_userdata('id', $result_prid['PRID']);
                $this->session->set_userdata('school_code', $result_prid['school_code']);
                redirect('zoomzoom/prid_login', 'refresh');
            }elseif($zoomzoom_prid){
               
                
                redirect('zoomzoom/zoomzoom_cin_login', 'refresh');
            } else{
                $this->session->set_flashdata('schoolerror', 'Enter Wrong Id.');
                 redirect('zoomzoom/zoomzoom_register', 'refresh');
            }
          
        }
	    
	    $this->load->view('zoomzoom');
	}
	
	
// ===================================================================== //	
	
	public function prid_login(){
	    $data['id']= $this->session->userdata('id');
	    $school_code= $this->session->userdata('school_code');
	   
	   if(isset($_POST['login'])){
	       
	       //print_r($_POST['access_code']);
	       //echo $id;die;
	       $result = $this->zoommodel->prid_login($school_code,$_POST['access_code'],$data['id']);
	      // print_r($result);die;
	       if($result=='Yes'){
	        //$this->session->unset_userdata('id');
	        $this->session->unset_userdata('school_code');
	        $this->session->set_userdata('id', $data['id']);
              
                redirect('zoomzoom/profile', 'refresh');
	       }
	   }
	   
	    $this->load->view('zoomzoom/login',$data);
	}
	
	
	public function cin_login(){
	    $data['id']= $this->session->userdata('id');
        if(isset($_POST['login'])){
	  
	       $result = $this->zoommodel->cin_login($_POST['access_code'],$data['id']);
	       if(!empty($result)){
	        $this->session->set_userdata('id', $data['id']);
              
                redirect('zoomzoom/profile_cin', 'refresh');
	       }
	   }
        $this->load->view('zoomzoom/login',$data);
	}
	
	public function zoomzoom_cin_login(){
	    $data['id']= $this->session->userdata('id');
        if(isset($_POST['login'])){
	       
	       $result = $this->zoommodel->zoomcin_login($_POST['access_code'],$_POST['prid']);
	       //print_r($result->zoomzoom_prid);die;
	       
	       if($result){
	      
	        $this->session->set_userdata('id', $result->zoomzoom_prid);
                 redirect('zoomzoom/profile_zoom', 'refresh');
	       }
	       //if($result=='Yes'){
	       // //$this->session->unset_userdata('id');
	       // $this->session->set_userdata('id', $data['id']);
        //         redirect('zoomzoom/profile_zoom', 'refresh');
	       //}
	       $this->session->set_flashdata('login_error', 'This is not valid ID and Password.');
	   }
        $this->load->view('zoomzoom/login',$data);
	}
	
	
// 	===================================================================== //
    public function profile(){
        $prid= $this->session->userdata('id');
        $data['student'] = $this->zoommodel->get_student($prid);
        // print_r($data);die;
        $this->load->view('zoomzoom/profile',$data);
    }
    public function profile_cin(){
        $cin= $this->session->userdata('id');
        $data['student'] = $this->zoommodel->get_student_cin($cin);
        $this->load->view('zoomzoom/profile_cin',$data);
    }
    public function profile_zoom(){
        $prid= $this->session->userdata('id');
        //echo '---'.$prid;die;
        
        if(isset($_POST['submit1'])){
	        $this->session->set_userdata('id',$prid);
            redirect('zoomzoom/products_cart', 'refresh');
	       
	    }
        if(isset($_POST['submit'])){
	        $this->session->set_userdata('id',$prid);
            redirect('zoomzoom/products', 'refresh');
	       
	    }
	    if(isset($_POST['edit'])){
	        $this->session->set_userdata('id',$prid);
            redirect('zoomzoom/profile_edit', 'refresh');
	       
	    }
	    
	    if(isset($_POST['result'])){
	        $this->session->set_userdata('id',$prid);
            redirect('zoomzoom/result_view', 'refresh');
	       
	    }
	    
	     $this->db->select('*');
         $this->db->from('student_to_zoomzoom');
         $this->db->where('zoomzoom_prid',$prid);
         $query = $this->db->get();
         
         $data['student'] = $query->result_array();
         
         $it=explode("ZREG",$prid);
        $cin=$it[0].'ZZZZ'.$it[1];
        
         $this->db->select('*');
         $this->db->from('zoomzoom_to_cin');
        $this->db->where('zoomzoom_to_cin.prid',$prid);
        $this->db->where('zoomzoom_to_cin.period',$data['student'][0]['period_id']);
        // $this->db->where('zoomzoom_orientatition_purchase.class_key',$key);
        $this->db->where('zoomzoom_to_cin.level_id',$data['student'][0]['level_id']);
        //$this->db->where('zoomzoom_to_cin.cin',$cin);
        
         $query = $this->db->get();
         
         $data['zoomzoom']= $query->result_array();
        
        $data['period']=$data['student'][0]['period_id'];        
        //print_r($data['period']);die;
        $this->load->view('zoomzoom/profile_zoomzoom',$data);
        
    }
    
    // ===================================================================== //    
    public function products_cart(){
        $prid = $this->session->userdata('id');
        
        $data['student'] = $this->zoommodel->get_student_zoomzoom($prid);
        //print_r($data['student']);exit;
        
        $period=$data['student'][0]['period_id'];
        $data['period']=$data['student'][0]['period_id'];
        if($data['student']=='13'){
        $this->db->select('*');
        $this->db->from('zoomzoom_to_cin');
        $this->db->where('zoomzoom_to_cin.prid',$prid);
        $this->db->where('zoomzoom_to_cin.level_name','NATIONAL_PRELIMS_Q1');
        $this->db->where('zoomzoom_to_cin.product_name','MaRRS ZoomZoom');
        $query = $this->db->get();
        $data['zoomzoom']= $query->result_array();
        // print_r($data);die;
         
        $this->db->select('*');
        $this->db->from('zoomzoom_mocktest_purchase');
        $this->db->where('zoomzoom_mocktest_purchase.prid',$prid);
        $this->db->where('zoomzoom_mocktest_purchase.level_name','NATIONAL_PRELIMS_Q1');
        $this->db->where('zoomzoom_mocktest_purchase.product_name','MaRRS ZoomZoom');
        $query = $this->db->get();
        $data['mocktest']= $query->result_array();
       
       
        $this->db->select('*');
        $this->db->from('zoomzoom_orientatition_purchase');
        $this->db->where('zoomzoom_orientatition_purchase.prid',$prid);
        $this->db->where('zoomzoom_orientatition_purchase.level_name','NATIONAL_PRELIMS_Q1');
        $this->db->where('zoomzoom_orientatition_purchase.product_name','MaRRS ZoomZoom');
        $query = $this->db->get();
        $data['orientatition']= $query->result_array();
        
        
        $this->db->select('*');
        $this->db->from('zoomzoom_studymaterial_purchase');
        $this->db->where('zoomzoom_studymaterial_purchase.prid',$prid);
        $this->db->where('zoomzoom_studymaterial_purchase.level_name','NATIONAL_PRELIMS_Q1');
        $this->db->where('zoomzoom_studymaterial_purchase.product_name','MaRRS ZoomZoom');
        $query = $this->db->get();
        $data['studymaterial']= $query->result_array();
        }
        if($period==12){
             redirect('zoomzoom/new_levelzoomzoom', 'refresh');
            
            
            
        }
       
        $this->load->view('zoomzoom/reg_download1.php',$data);
    }
    
    
    public function new_levelzoomzoom(){
            $prid = $this->session->userdata('id');
            $this->session->set_userdata('prid',$prid);
            //echo $prid;die;
            
            $data['prid']=$prid;
            
            $this->db->select('zoomzoom_result.status');
            $this->db->from('zoomzoom_result');
            $this->db->join('student_to_zoomzoom','student_to_zoomzoom.zoomzoom_prid=zoomzoom_result.prid');
            $this->db->where('zoomzoom_result.prid',$prid);
            $this->db->where('zoomzoom_result.clevel','1');
            $this->db->where('zoomzoom_result.product_name','MaRRS ZoomZoom');
            $query = $this->db->get();
            
            //echo $this->db->last_query();die;
            $status=$query->row_array()['status'];
            
            //print_r($query->row_array());die;
            //echo $status;die;
            $data['status']=$status;
            if($status=='Q'){
                
                // $this->session->set_flashdata('message','Congratulations!!! you are qualified to participate in MaRRS Zoom Zoom National Championship.');
                    $this->db->select('*');
                    $this->db->from('zoomzoom_to_purchase');
                    $this->db->where('zoomzoom_to_purchase.prid',$prid);
                    $this->db->where('zoomzoom_to_purchase.clevel','2');
                    $query = $this->db->get();
                    $data['zoomzoom']= $query->result_array();
                    
                    $this->db->select('*');
                    $this->db->from('zoomzoom_mocktest_purchase');
                    $this->db->where('zoomzoom_mocktest_purchase.prid',$prid);
                    $this->db->where('zoomzoom_mocktest_purchase.level_id','2');
                    $query = $this->db->get();
                    $data['mocktest']= $query->result_array();
                    
                    $this->db->select('*');
                    $this->db->from('zoomzoom_orientatition_purchase');
                    $this->db->where('zoomzoom_orientatition_purchase.prid',$prid);
                    $this->db->where('zoomzoom_orientatition_purchase.level_id','2');
                    $query = $this->db->get();
                    $data['orientatition']= $query->result_array();
                    
                    
            }
            if($status=='NQ'){
               // echo 'ok';die;
                $this->session->set_flashdata('message','Sorry!!! you are not qualified to participate in MaRRS Zoom Zoom National Championship.');
                
            }
            if($status==''){
                //echo 'ok';die;
                $this->session->set_flashdata('message','Sorry!!! result are not available on MaRRS Zoom Zoom National Championship School Level.');
                
            }
        $this->load->view('zoomzoom/reg_download2.php',$data);
    }
    
    public function payment_invoice(){
        $prid=  $this->session->userdata('id');
            $this->db->select('*');
            $this->db->from('student_to_zoomzoom');
            $this->db->where('student_to_zoomzoom.zoomzoom_prid',$prid);
            $query = $this->db->get();
            
            //echo $this->db->last_query();die;
            $data['student']=$query->row_array();
        
        
                    $this->db->select('*');
                    $this->db->from('zoomzoom_to_purchase');
                    $this->db->where('zoomzoom_to_purchase.prid',$prid);
                    $this->db->where('zoomzoom_to_purchase.clevel','2');
                    $query = $this->db->get();
                    $data['zoomzoom']= $query->row_array();
                    
                    $this->db->select('*');
                    $this->db->from('zoomzoom_mocktest_purchase');
                    $this->db->where('zoomzoom_mocktest_purchase.prid',$prid);
                    $this->db->where('zoomzoom_mocktest_purchase.level_id','2');
                    $query = $this->db->get();
                    $data['mocktest']= $query->row_array();
                    
                    $this->db->select('*');
                    $this->db->from('zoomzoom_orientatition_purchase');
                    $this->db->where('zoomzoom_orientatition_purchase.prid',$prid);
                    $this->db->where('zoomzoom_orientatition_purchase.level_id','2');
                    $query = $this->db->get();
                    $data['orientatition']= $query->row_array();
                    
        $this->load->view('zoomzoom/payment_invoice.php',$data);            
    }
    
    
    public function net_abccc($id=''){
            //print_r($_POST);exit;
           
           $prid=  $this->session->userdata('id');
            $token = $this->input->post('id');
            
            
         if($token=='c'){
             $token='Competition';
             $ar=array('amount'=>'1990',
             'token'=>$token,
             'pid'=>$prid);
         }
         if($token=='m'){
             $token='MockTest';
             $ar=array('amount'=>'400',
             'token'=>$token,
             'pid'=>$prid);
         }
         if($token=='o'){
             $token='Orientation';
             $ar=array('amount'=>'1250',
             'token'=>$token,
             'pid'=>$prid);
         }
         
        //print_r($ar);die;
         $res = $this->db->get_where('zoom_add',array('pid' =>$prid,'token'=>$token))->row();
         //print_r($res);die;
         if(empty($res)){
           $this->db->insert('zoom_add',$ar);   
         }
         
    }
    
    
    public function remove_misbcc($id=''){
            $prid=  $this->session->userdata('id');
            $token = $this->input->post('id');
             $token=trim($token);
            if($token=='c'){
             $token='Competition';}
            elseif($token=='m'){
             $token='MockTest';
             
            }
            elseif($token=='o'){
             $token='Orientation';
            }
            
            $this->db->where('pid',$prid);
            $this->db->where('token',$token);
            $this->db->delete('zoom_add');  
            //echo $this->db->last_query();die;
    }
    
    public function profile_edit()
    {
        $data['prid']= $this->session->userdata('id');
        $data['student'] = $this->zoommodel->get_student_zoomzoom($data['prid']);
        
        if(isset($_POST['submit'])){
            //echo $data['prid'];die;
	      
	       $arr=array(
	           "mobile"=>$_POST['mobile'],
	           "whatsapp"=>$_POST['whatsapp'],
	           "email"=>$_POST['email'],
	           "address_line"=>$_POST['address_line'],
	           "pin"=>$_POST['pin'],
	           "city"=>$_POST['city'],
	           "state"=>$_POST['state'],
	           'school_name' => $_POST['school_name']
	           );
	       //print_r($arr);die;
	       $this->db->where('zoomzoom_prid',$data['prid']);
	       $this->db->update('student_to_zoomzoom',$arr);
	       $this->session->set_flashdata('item','Details Update Successfull ...');
	       $this->session->set_userdata('id',$data['prid']);
            redirect('zoomzoom/profile_zoom', 'refresh');
	    }
	    if(isset($_POST['back'])){
	        redirect('zoomzoom/profile_zoom', 'refresh');
	    }
        $this->load->view('zoomzoom/profile_zoomzoom_edit',$data);
    }
// ===================================================================== //
    public function logout(){
        $prid  = $this->session->userdata('id');
        $data = array('prid' =>$prid);
        $query = $this->db->delete('zoomzoom_amount_cart',$data);
        $this->session->unset_userdata('id');
	    redirect('https://marrs.in/', 'refresh');
    }
    
// ===================================================================== //    
    public function products(){
        $prid = $this->session->userdata('id');
        
        $data['student'] = $this->zoommodel->get_student_zoomzoom($prid);
        //print_r($data['student']);exit;
        
        
        
        //$data['student'][0]['franchise_id'];

        
        //$data['product_not_purchase'] = $this->zoommodel->get_student_product($prid,$data['student'][0]['class_key'],$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        // print_r($data['student'][0]['class_key']);die;
        //print_r($data['student'][0]['level_id']);die;
        
        $data['all_product'] = $this->zoommodel->get_all_product($data['student'][0]['class_key']);
        // print_r($data['all_product']);die;
       
        
        $data['paid_material'] = $this->zoommodel->get_student_paid_material($prid,$data['student'][0]['class_key'],$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        
        $data['paid_orientation'] = $this->zoommodel->get_student_paid_orientation($prid,$data['student'][0]['class_key'],$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        
        $data['free_material'] = $this->zoommodel->get_student_free_material($prid,$data['student'][0]['class_key'],$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        
        $data['paid_mocktest'] = $this->zoommodel->get_student_paid_mocktest($prid,$data['student'][0]['class_key'],$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        
        $data['zoomzoom']=$this->zoommodel->get_student_paid_zoomzoom($prid,$data['student'][0]['period_id'],$data['student'][0]['level_id']);
        
        
       // print_r($data['zoomzoom']);die;
        
        $this->load->view('zoomzoom/reg_download.php',$data);
    }
    
    public function net_abc($id=''){
        //echo 'ok';die;
        //print_r($_POST);exit;
        $token = $this->input->post('id');
       // echo $token;
        $amount=0;
        $hint = $token[0];
        if($hint=='s'){
            $amount=495;
        }
        if($hint=='z'){
            $amount=299;
        }
        if($hint=='o'){
            $amount=750;
        }
        if($hint=='m'){
            $amount=260;
        }
        
        $prid  = $this->session->userdata('id');
        // $token = $this->input->post('token');
        
        $data = array('amount' => $amount,'prid' =>$prid,'token'=>$token);
        //print_r($data);die;  
        $res = $this->db->get_where('zoomzoom_amount_cart',array('prid' =>$prid,'token'=>$token))->row();
        if($token != $res->token){
         $query = $this->db->insert('zoomzoom_amount_cart',$data);
        }
        
       return $data;
        
       }
       public function free_material(){
           $prid  = $this->session->userdata('id');
           //print_r($_POST['free']);
           $student = $this->zoommodel->get_student_zoomzoom($prid);
           //print_r($student[0]['level_id']);exit;
           $data['material']=$this->zoommodel->get_freematerial_zoomzoom($_POST['free'],$student[0]['level_id'],$student[0]['period_id'],$student[0]['class'],'Free');
           
           if(isset($_POST['back'])){
            redirect('zoomzoom/products', 'refresh');
            }
            if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../zoomzoom_free_material/".$file_name;
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
            
            $this->load->view('zoomzoom/material_files',$data);
            
       }
       
       public function paid_material(){
           $prid  = $this->session->userdata('id');
           //print_r($_POST['free']);
           $student = $this->zoommodel->get_student_zoomzoom($prid);
           //print_r($student[0]['level_id']);exit;
           $data['material']=$this->zoommodel->get_freematerial_zoomzoom($_POST['paid'],$student[0]['level_id'],$student[0]['period_id'],$student[0]['class'],'Paid');
           
           if(isset($_POST['back'])){
            redirect('zoomzoom/products', 'refresh');
            }
            if(isset($_POST['download'])){
                $file_name=$_POST['download'];
                //echo $file_name;die;
                $filepath="../zoomzoom_paid_material/".$file_name;
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
            
            $this->load->view('zoomzoom/material_files',$data);
            
       }
       
       
        public function remove_misb($id=''){
            //print_r($_POST);exit;
         $token = $this->input->post('id');
        // $amount = $this->input->post('id');
        // $token = $this->input->post('token');
        $prid  = $this->session->userdata('id');
        $data = array('prid' =>$prid,'token'=>$token);
        //print_r($data);exit;
        //$res = $this->db->get_where('zoomzoom_amount_cart',array('prid' =>$prid,'token'=>$token))->row();
        //if($token == $res->token){
         $query = $this->db->delete('zoomzoom_amount_cart',$data);
        //}
        
       return $data;
        
       }
       
    public function zoom_admitcard(){
        
        $this->load->view('zoomzoom/admitcard');
        
    }
     public function zoom_mocktest(){
        
        $this->load->view('zoomzoom/mocktest_slip');
        
    }
     public function zoom_orientation(){
        
        $this->load->view('zoomzoom/orientation_slip');
        
    }
    
     public function zoom_reg_slip(){
        $prid = $this->session->userdata('id');
        $cin = $this->uri->segment(3);
        $data['student_data'] = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid' =>$prid))->row_array();
        $data['cin'] = $this->uri->segment(3);
        $data['product'] = $this->db->get_where('zoomzoom_to_cin',array('prid' =>$prid,'cin'=>$cin))->row();
      
        $data['all_product'] = $this->zoommodel->get_all_product($data['student_data']['class_key']);
          //print_r( $data['all_product'] );exit;
        $this->load->view('zoomzoom/reg_slip',$data);
        
    }
    
    public function zoom_ori_slip(){
        $prid = $this->session->userdata('id');
        $product = $this->uri->segment(3);
        //print_r($product);die;
         $numbers = ['%','2','0'];

                
                    $data['result'] = str_replace($numbers, " ", $product);
                    
             //       echo $result;die;
        
        
        $data['student_data'] = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid' =>$prid))->row_array();
        //$data['cin'] = $this->uri->segment(3);
        $data['product'] = $this->db->get_where('zoomzoom_orientatition_purchase',array('prid' =>$prid,'product_name'=>$data['result']))->row();
        
        $this->load->view('zoomzoom/orientation_slip',$data);
        
    }
    
    
    public function zoomcertificate(){
         $cin = $this->uri->segment(3);
         
         $mess ='Update Your School Name in profile';
        
         
        //echo  $this->session->userdata('id');exit;
         $data['prid'] = $this->session->userdata('id');
         $data['product_name'] = $_POST['product_name'];
         $data['cin'] = $this->uri->segment(3);
         
          $school = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid'=>$data['prid']))->row()->school_name;
          
          if(isset($_POST['back'])){
               redirect('zoomzoom/result_view', 'refresh');
          }
          
          
         if(empty($school)){ ?>
            <script>
              alert("Update Your School Name in profile page before certificate download");
               
             window.location.assign("https://marrs.in/student_registration/zoomzoom/profile_edit")

            </script>
             
       <?php  
        
         }else{
        
         $this->load->view('zoomzoom/certificate',$data);
       }
    }
    public function result_view(){
        $prid = $this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('student_to_zoomzoom');
        $this->db->join('period','student_to_zoomzoom.period_id=period.period_id');
        $this->db->where('zoomzoom_prid',$prid);
        $query=$this->db->get();
        //echo $this->db->last_query();die;
        $data['student']=$query->row_array();
        $data['cin']=$prid;
        $data['student_data'] = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid' =>$prid))->row_array();
        $data['purchase'] = $this->db->get_where('zoomzoom_to_cin',array('prid' =>$prid))->result_array();
        if(isset($_POST['back'])){
            redirect('zoomzoom/profile_zoom', 'refresh');
        }
        
        $this->load->view('zoomzoom/result_view',$data);
    }
    
    //// ------------- Added by abhishek 5/10/2023 ------------ //
public function download_certificate(){
            $this->load->model('newmodel');
            $id = $this->uri->segment(3);
            $cin=$this->session->userdata('id');
          
           // $data['student']=$this->newmodel->get_student_data_cin($cin);
         //   print_r($data['student']);die;
         
         
         
         
            
            $this->db->select('*');
            $this->db->from('cin_result');
            $this->db->where('cin',$cin);
            // $this->db->where('status !=', null);
            $this->db->where('clevel',$id);
            $query = $this->db->get();
            // echo $this->db->last_query();exit;
            $data['result']=$result_array= $query->row_array();
            // echo 'ok';
           // print_r($result_array);die;
            
            
            if($result_array['period_id']=='12'){
            $limit=$result_array['clevel']+1;
            $this->db->select('level_name');
            $this->db->from('competition_level_byproduct');
            // $this->db->order_by('level_id','DESC');
            $this->db->where('product_name', $result_array['product_name']);
             $this->db->where('medal_no',$limit); 
            // $this->db->limit($limit);
            $query = $this->db->get();
          //  echo $this->db->last_query();exit;
            $resul=$query->row_array();
            
            // print_r($resul);die;
            $nl= $resul['level_name'];
            $data['nex_level']=$nl;
            // echo $nl;die;
            }
            
                $this->db->select('medal_no,level_name');
                $this->db->from('competition_level_byproduct');
                $this->db->where('level_id',$id);
                $this->db->where('product_name', $data['result']['product_name']);
                $query = $this->db->get();
                // echo $this->db->last_query();exit;
                $res=$query->row_array();
                $data['level_name']=$res['level_name']; 
            
           
            if($id=='15'){
                $data['level_name']='NATIONAL CHAMPIONSHIP';
            }
            if($id=='21'){
                $data['level_name']='NATIONAL Finals';
            }      
            
            
            $data['medal']= $res['medal_no'];
            
            $this->db->select('level_id');
            $this->db->from('competition_level_byproduct');
            $this->db->where('product_name',$data['result']['product_name']);
            $this->db->order_by("level_id", "DESC");
            $query = $this->db->get();
            //echo $this->db->last_query();exit;
            $result= $query->row_array();
            // echo $result['level_id'];die;
            
            
           // echo $result_array['period_id'];die;
            
            if($result_array['period_id']=='12')
            {
                    if($result['level_id']!=$id){
            
            
                        $this->db->select('level_name');
                        $this->db->from('competition_level_byproduct');
                        $this->db->where('product_name',$data['result']['product_name']);
                        $this->db->where('level_id', $id+1);
                        // $this->db->where('level_id >=', '1');
                        // $this->db->order_by("level_id", "ASC");
                        $query = $this->db->get();
                        //echo $this->db->last_query();exit;
                        $result= $query->row_array();
 	                    //echo $result['level_name'];die;
 	                   if($id!='15'){
                        $data['nex_level']= $result['level_name'];
                       
 	                   }
 	                   
 	                   elseif($id=='15'){
 	                       $data['qt']=' -Quarter-1';
 	                   }
                    }   else{
                         $data['nex_level']='';
                    }
                    
           // $data['student']=$this->newmodel->get_student_data_cin($cin);
            $data['student'] = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid' =>$cin))->row_array();
        //print_r($data['student']);die;
            }
            
            if(isset($_POST['back'])){
                redirect('zoomzoom/result_view', 'refresh');
            }
            if(isset($_POST['profile'])){
                redirect('zoomzoom/profile_zoom', 'refresh');
            }
            
        $this->load->view('current_year/down_certi', $data);    
    }

    public function open_registrationzoom(){
        $school_code= $this->session->userdata('school_code');
        $data['school_code']=$school_code;
        $this->db->select('*');
        $this->db->from('open_schools');
        $this->db->join('areas','open_schools.stateID=areas.state_id');
        $this->db->join('districts','districts.id=areas.district_id');
        $this->db->join('states','states.state_subdivision_id=areas.state_id');
        $this->db->where('open_schools.school_code',$school_code);
        $query=$this->db->get();
       // echo $this->db->last_query();die;
        $data['result']=$query->result_array();
        
        if(isset($_POST['submit'])){
            //print_r($_POST);die;
            $this->input->post('email');
            $res=$this->db->get_where('cin_zoomzoom',array('email' =>$this->input->post('email'),'period_id' =>'13' ))->row();
            if(empty($res)){
            
             $arr = array(
        			'first_name' => $this->input->post('first_name'),
        			'middle_name' => $this->input->post('middle_name'),
        			'last_name' => $this->input->post('last_name'),
        			'class_id' => $this->input->post('class'),
        			'gender' => $this->input->post('gender'),
        			'father_name' => $this->input->post('father_name'),
        			'mother_name' => $this->input->post('mother_name'),
        			'mobile' => $this->input->post('mobile'),
        			'whatsapp' => $this->input->post('whatsapp'),
        			'email' => $this->input->post('email'),
        			'address_line' => $this->input->post('address_line'),
        			'pin' => $this->input->post('pin'),
        			'city' => $this->input->post('city'),
        			'stateID' => $data['result'][0]['state_subdivision_id'],
        			'state' => $data['result'][0]['state_subdivision_name'],
        			'dob' => $this->input->post('dob'),
        			'status' => 'Active',
        			'area_code' => $this->input->post('area'),
        			'level_id'=>'1',
        			'school_name' => $this->input->post('school_name'),
        			'school_address' => $this->input->post('school_address'),
        			'period_id'=>'13'
    		    );
                $this->db->insert('cin_zoomzoom',$arr);
    		    $email=$this->input->post('email');
    		    $name=$this->input->post('first_name').' '.$this->input->post('middle_name').' '.$this->input->post('last_name');
    		    $sender = 'customerrelations@marrs.in';
                               
                                $subject = "Registration Successful!!!";
                                $message = "Registration Successful!!! <br> Hello, congratulations ".$name." for successfully registering on the https://marrs.in/ portal.<br>You have not paid to participate in any of the MaRRS Challenges.<br>You can at any time log on to your account using your email id and OTP sent to the email id. <br>You can then register for any of the MaRRS Competitions. Once you pay and register for any of the MaRRS Competitions you will receive the Candidate Identification Number (CIN) for the same. <br>You can then access the Learning Material for the product by logging in using the CIN. <br>You will be able to download any learning material immediately on its purchase.<br>Please ensure that you download Registration Slips when you enlist for Orientation or Mock Tests.";
                                // $headers = 'From:' . $sender;
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
                                $headers .= "From: ".$sender. "\r\n";

                                if (mail($email, $subject, $message, $headers))
                                {
                                    echo " ";
                                }
    		  
    		    
               header('Location: https://marrs.in/'); exit();
                
            }else{
             
             $this->session->set_flashdata('message','This Email is already taken...');
            }
         
         
        }
        
        
        $this->load->view('zoomzoom/openregistration_form.php',$data);
    }
    
}

?>