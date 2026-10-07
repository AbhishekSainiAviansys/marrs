<?php
class Zoommodel extends CI_Model {
    function __construct()
	 {
        parent::__construct();
        $this->load->database();
        //$this->load->library('encrypt');
		$this->load->library('email');
	 }
	 
	 public function prid_create($arr){
	     
	     $cl=$arr['class_id'];
	     $this->db->select('period_id,initials');
         $this->db->from('period');
         $this->db->where('status','Active');
         $query = $this->db->get();
         $result= $query->result_array();
         $period=$result[0]['period_id'];
         $arr["period_id"] = $period;
         $pr=$result[0]['initials'];
         
         
         $this->db->select_max('id');
         $this->db->from('student_to_zoomzoom');
         $query = $this->db->get();
         $result= $query->result_array();
         $id=$result[0]['id'];
         
         $this->db->select('*');
         $this->db->from('class');
         $this->db->where('class_id',$cl);
         $query = $this->db->get();
         $result= $query->result_array();
         $class=$result[0]['class_name'];
         //echo $class;die;
         
         $check=$pr.'ZREG';
         //echo $check;die;
         
         $this->db->select('student_to_zoomzoom.zoomzoom_prid');
         $this->db->from('student_to_zoomzoom');
         $this->db->like('zoomzoom_prid',$check,'after');
         $this->db->order_by('id','DESC');
         $query = $this->db->get();
        // echo $this->db->last_query();exit;
         $result= $query->row_array();
        // print_r($result);die;
        
         $prid=$result[0]['zoomzoom_prid'];
         //echo $prid;die;
         
         if(empty($prid)){
             $last='100000';
             $prid=$check.$last;
         }else{
             $last=substr($prid, 6);
             $last=$last+1; 
             $prid=$check.$last;
         }
       // echo $prid;die;
    
         if($cl<=3){
            $class_key='1'; 
         }else{
             $class_key='2'; 
         }
         $arr["zoomzoom_prid"] = $prid;
         $arr["password"] = $prid;
         $arr["class_key"] = $class_key;
         $arr["class"] = $class;
         
       //  print_r($arr);die;
    
	     $this->db->insert('student_to_zoomzoom', $arr);
	     
	     return $prid;
	 }
	 
	 public function ok(){
	     echo 'ok';die;
	 }
	 
	 public function access_code($code){
	     $this->db->select('zoomzoom_access_code,franchise_id');
         $this->db->from('franchise_to_zoomzoom');
         $this->db->where('zoomzoom_access_code',$code);
         $this->db->where('status','Active');
        // $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 
	 public function update_student_data($cin,$data){
	     //print_r($data);die;
	     $this->db->select('*');
         $this->db->from('cin_result');
         $this->db->where('cin',$cin);
         $this->db->order_by("clevel", "desc");
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 public function prid_login($school_code,$access_code,$prid){
	//echo $school_code;die;
	     $this->db->select('*');
         $this->db->from('students');
         $this->db->join('schools','students.school_code=schools.school_code');
         $this->db->join('franchise','franchise.franchise_id=schools.franchise_id');
         $this->db->join('franchise_to_zoomzoom','franchise_to_zoomzoom.franchise_id=franchise.franchise_id');
         $this->db->where('students.PRID',$prid);
         $this->db->where('franchise_to_zoomzoom.zoomzoom_access_code',$access_code);
         $this->db->where('franchise_to_zoomzoom.status','Active');
         $this->db->where('schools.school_code',$school_code);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
         //return $query->result_array();
         if(!empty($query->result_array())){
             
             return 'Yes';
         }else{
             return 'No';
         }
	 }
	 
	 public function get_student($prid){
	     $this->db->select('*');
         $this->db->from('student_to_zoomzoom');
         $this->db->where('zoomzoom_prid',$prid);
        //  $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result_array();
	 }
	 public function get_student_cin($cin){
	     $this->db->select('*');
         $this->db->from('cin_list');
         $this->db->where('cin',$cin);
        //  $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result_array();
	 }
	 public function get_student_zoomzoom($cin){
	     $this->db->select('*');
         $this->db->from('student_to_zoomzoom');
         $this->db->where('zoomzoom_prid',$cin);
        // $this->db->join('class','student_to_zoomzoom.class_id=student_to_zoomzoom.class_id');
        //  $this->db->order_by("class_key","desc");
         $query = $this->db->get();
         return $query->result_array();
	 }
	 public function cin_login($access_code,$cin){
	     $this->db->select('*');
         $this->db->from('cin_list');
         $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id');
         $this->db->join('franchise_to_zoomzoom','franchise_to_zoomzoom.fr=franchise.franchise_id');
          $this->db->where('franchise_to_zoomzoom.status','Active');
          $this->db->where('franchise_to_zoomzoom.zoomzoom_access_code',$access_code);
         $this->db->where('cin_list.cin',$cin);
         $query = $this->db->get();
         //echo $this->db->last_query();exit;
        // print_r($query->result_array());
         if(!empty($query->result_array())){
             
             return 'Yes';
         }else{
             return 'No';
         }
	 }
	 
	 
	 public function zoomcin_login($access_code,$cin){
	     
	        $this->db->select('*');
            $this->db->from('student_to_zoomzoom');
            $this->db->where('zoomzoom_prid',$cin);
            $this->db->where('password',$access_code);
            $result  = $this->db->get();
           return  $result->row();
       
	   //  $this->db->select('*');
    //      $this->db->from('student_to_zoomzoom');
    //     // $this->db->join('franchise','franchise.franchise_id=cin_list.franchise_id');
    //      $this->db->join('franchise_to_zoomzoom','franchise_to_zoomzoom.franchise_id=student_to_zoomzoom.franchise_id');
    //       $this->db->where('franchise_to_zoomzoom.status','Active');
    //       $this->db->where('franchise_to_zoomzoom.zoomzoom_access_code',$access_code);
    //      $this->db->where('student_to_zoomzoom.zoomzoom_prid',$cin);
    //      $query = $this->db->get();
    //      //echo $this->db->last_query();exit;
    //     // print_r($query->result_array());
    //      if(!empty($query->result_array())){
             
    //          return 'Yes';
    //      }else{
    //          return 'No';
    //      }
	 }
	 
	 public function get_student_free_material($prid,$key,$period,$level){
	     $this->db->select('*');
         $this->db->from('zoomzoom_product_activate');
         
    
         //$this->db->join('class','student_to_zoomzoom.class_id=student_to_zoomzoom.class_id');
        //  $this->db->order_by("class_key","desc");
        
        $this->db->join('zoomzoom_to_cin','zoomzoom_to_cin.product_name=zoomzoom_product_activate.product_name');
        
        //$this->db->where('zoomzoom_student_cin.prid',$prid);
        $this->db->where('zoomzoom_product_activate.period',$period);
        $this->db->where('zoomzoom_product_activate.class_key',$key);
        $this->db->where('zoomzoom_product_activate.level_id',$level);
        $this->db->where('zoomzoom_product_activate.status','Active');
        
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 public function get_student_product($prid,$key,$period,$level){
	     $this->db->select('*');
         $this->db->from('zoomzoom_product_activate');
         
    
        //  $this->db->join('class','student_to_zoomzoom.class_id=student_to_zoomzoom.class_id');
        //  $this->db->order_by("class_key","desc");
        
        $this->db->join('zoomzoom_to_cin','zoomzoom_to_cin.product_name=zoomzoom_product_activate.product_name','left');
        
        $this->db->where('zoomzoom_to_cin.prid',$prid);
        $this->db->where('zoomzoom_product_activate.period',$period);
        $this->db->where('zoomzoom_product_activate.class_key',$key);
        $this->db->where('zoomzoom_product_activate.level_id',$level);
        $this->db->where('zoomzoom_product_activate.status','Active');
        
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 } 
	 
	 public function get_all_product($key){
	     $this->db->select('*');
         $this->db->from('zoomzoom_product_activate');
         $this->db->where('status','Active');
         $this->db->where('class_key',$key);
         $this->db->or_where('class_key','0');
         $query = $this->db->get();
         
         // echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	  public function get_all_product_name($key){
	     $this->db->select('product_name,initial');
         $this->db->from('zoomzoom_product_activate');
         $this->db->where('status','Active');
         $this->db->where('class_key',$key);
         $this->db->or_where('class_key','0');
         $query = $this->db->get();
         
         // echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 public function get_student_paid_material($prid,$key,$period,$level){
	     $this->db->select('*');
         $this->db->from('zoomzoom_studymaterial_purchase');
         
        $this->db->where('zoomzoom_studymaterial_purchase.prid',$prid);
        $this->db->where('zoomzoom_studymaterial_purchase.period',$period);
       // $this->db->where('zoomzoom_studymaterial_purchase.class_key',$key);
        $this->db->where('zoomzoom_studymaterial_purchase.level_id',$level);
        //$this->db->where('zoomzoom_to_cin.status','Active');
        
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 
	 public function get_student_paid_orientation($prid,$key,$period,$level){
	     $this->db->select('*');
         $this->db->from('zoomzoom_orientatition_purchase');
        
        $this->db->where('zoomzoom_orientatition_purchase.prid',$prid);
        $this->db->where('zoomzoom_orientatition_purchase.period',$period);
       // $this->db->where('zoomzoom_orientatition_purchase.class_key',$key);
        $this->db->where('zoomzoom_orientatition_purchase.level_id',$level);
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 
	 public function get_student_paid_mocktest($prid,$key,$period,$level){
	     $this->db->select('*');
         $this->db->from('zoomzoom_mocktest_purchase');
        
        $this->db->where('zoomzoom_mocktest_purchase.prid',$prid);
        $this->db->where('zoomzoom_mocktest_purchase.period',$period);
       // $this->db->where('zoomzoom_orientatition_purchase.class_key',$key);
        $this->db->where('zoomzoom_mocktest_purchase.level_id',$level);
      // $this->db->where('zoomzoom_to_cin.status','Active');
        
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 public function get_student_cart_data($prid){
	      $this->db->select('*');
         $this->db->from('zoomzoom_amount_cart');
         
         $this->db->where('prid',$prid);
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 
	 public function get_student_key($prid){
	      $this->db->select('class_key');
         $this->db->from('student_to_zoomzoom');
         
         $this->db->where('zoomzoom_prid',$prid);
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
	 
	 
    public function get_student_paid_zoomzoom($prid,$period,$level){
        
        $it=explode("ZREG",$prid);
        $cin=$it[0].'ZZZZ'.$it[1];
        //echo $cin;die;
         $this->db->select('*');
         $this->db->from('zoomzoom_to_cin');
        $this->db->where('zoomzoom_to_cin.prid',$prid);
        $this->db->where('zoomzoom_to_cin.period',$period);
        // $this->db->where('zoomzoom_orientatition_purchase.class_key',$key);
        $this->db->where('zoomzoom_to_cin.level_id',$level);
        //$this->db->where('zoomzoom_to_cin.cin',$cin);
        
         $query = $this->db->get();
         
         // echo $this->db->last_query();exit;
         return $query->result_array();
    }
	 public function get_freematerial_zoomzoom($product,$level,$period,$class,$status){
	     $this->db->select('*');
         $this->db->from('zoomzoom_studymaterial');
         $this->db->where('product_name',$product);
         $this->db->where('status',$status);
         $this->db->where('level_id',$level);
         $this->db->where('period',$period);
         $this->db->where('class',$class);
         $query = $this->db->get();
         
        //  echo $this->db->last_query();exit;
         return $query->result_array();
	 }
// 	 public function get_freematerial_zoomzoom($product,$level,$period,$class){
// 	     $this->db->select('*');
//          $this->db->from('zoomzoom_studymaterial');
//          $this->db->where('product_name',$product);
//          $this->db->where('status','Free');
//          $this->db->where('level_id',$level);
//          $this->db->where('period',$period);
//          $this->db->where('class',$class);
//          $query = $this->db->get();
         
//         //  echo $this->db->last_query();exit;
//          return $query->result_array();
// 	 }
}
?>