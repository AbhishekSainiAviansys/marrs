<?php 

include('student_header.php');
 foreach ($student as $row){
    $school=$row->school_code;
    $prid=$row->PRID;
    $class_key=$row->class_key;
    $class=$row->class;
	
	
}
	if($class=='Nursery'){
	$clas ='Nursery_class="Nursery"';
	}if($class=='LKG'){
	$clas ='LKG_class="LKG"';
	}elseif($class=='UKG'){
		$clas ='UKG_class="UKG"';
	}elseif($class=='Class-1'){	
	    $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-2'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-3'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-4'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-5'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-6'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-7'){
		 $clas ='1_8_class="1_8"'; 
	}elseif($class=='Class-8'){
		 $clas ='1_8_class="1_8"';    
	}elseif($class=='Class-9'){
		 $clas ='9_12_class="9_12"';    
	}elseif($class=='Class-10'){
		 $clas ='9_12_class="9_12"';    
	}elseif($class=='Class-11'){
		 $clas ='9_12_class="9_12"';    
	}elseif($class=='Class-12'){
		 $clas ='9_12_class="9_12"';     
	}






 //echo $class;exit;
$query3 = $this->db->query("select franchise_id FROM schools WHERE school_code='$school' ;");
foreach ($query3->result() as $row)
{
$franchise=$row->franchise_id;
}
// echo $franchise;
$query = $this->db->query("select * FROM period WHERE status='Active' ;");
foreach ($query->result() as $row)
{
$period=$row->period_id;
}


 $query1 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Paid' ;");
 
 $query2 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid' ;");
 
 $query23 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid' And amount='0'");
 
  $query111 = $this->db->query("select * FROM study_material_byprid WHERE prid='$prid' and payment_status ='success' ;");
 
 //print_r($query23->result());exit;
 $amoun=0;

foreach($query2->result() as $row){
    $amoun=$row->amount+$amoun;
}
//echo $amoun;
error_reporting(E_ALL ^ E_NOTICE);  

    ?>
<head>
     <!--Google Fonts -->
	<link class="gf-headline" href='https://fonts.googleapis.com/css?family=Pacifico:400&subset=' rel='stylesheet' type='text/css'>
			
	 <!--Animate CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
</head>    
<style>
body{
   background-color:#f4f4f4;
    margin:0;
    padding:0;
    font-family: 'Lora', serif;
}
#told{
    margin-top:20px;
    margin-bottom:20px;
    padding-top:20px;
    padding-bottom:20px;
    padding-left:20px;
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:100px;
    margin-right:100px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
#cornerr{
    background-color:white;
    border-radius:20px;
    margin-left:250px;
    margin-right:250px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
#pad{
    padding-top:30px;
    /*padding-left:30px;*/
    padding-bottom:30px;
}
@media (max-width:767px){
 #corner {
   width: 100%; 
   height: 200px; 
   margin-left:0;
   margin-top:20px;
   padding-bottom:20px;
 }
 
}

.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}

@media screen and (max-width: 767px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
}
input[type=checkbox], input[type=radio]{
    height: 20px;
    width: 20px;
}
th{
    background:#228BC6;
    color:#ffff;
}
td{
    background-color:#ffff;
    color:#000;
}
</style>
<body>
    <!--<div style='padding-top:20px;'>-->
    <!--    <div id='product' id='h' >-->
    <!--        <h3>-->
    <!--        Subscribe Learning programmes</h3>-->
    <!--    </div>-->
    <!--</div>-->

    

<div class="container">           
    
<div class="row" >
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;"  >
        <form  method='post' >
            <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th colspan="3" style="font-weight:600;font-size: 2rem;background: #0e9c98;"> Yet To Register Programs</th>
                      </tr>
                    <tr  style="background:#333; color:#FFF;">
                      <th scope="col">Select</th>
                      <th>Product Name</th>
                      <th>Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      //echo $class_key;
                 // $ar=array('Class-8','Class-9','Class-10','Class-11','Class-12');
                 // $arr=array('Class-1','Class-2','Class-3','Class-4','Class-5','Class-6','Class-7');
                 // if(in_array($class,$ar)){
                     
                     // $class_key='3';
                    
                      // $query = $this->db->query("SELECT  products.product_name,price_codegenration.product_price,products.product_id,price_codegenration.price_code FROM filter INNER JOIN products ON products.product_id=filter.product_id INNER JOIN price_codegenration ON price_codegenration.price_code=filter.price_code WHERE school_code='$school'  AND price_codegenration.status='Active' AND products.status='Active' AND price_codegenration.level='1' AND products.class_key='$class_key' group by product_name ORDER BY product_id DESC")->result();
                   
                 // }
                 // if(in_array($class,$arr)){
                     
                    
                      // $query = $this->db->query("SELECT  products.product_name,price_codegenration.product_price,products.product_id,price_codegenration.price_code FROM filter INNER JOIN products ON products.product_id=filter.product_id INNER JOIN price_codegenration ON price_codegenration.price_code=filter.price_code WHERE school_code='$school'  AND price_codegenration.status='Active' AND products.status='Active' AND price_codegenration.level='1' group by product_name ORDER BY product_id DESC")->result();
                   
                 // }
                 // else{
                     //echo $class_key;
                      // $query = $this->db->query("SELECT  products.product_name,price_codegenration.product_price,products.product_id,price_codegenration.price_code FROM filter INNER JOIN products ON products.product_id=filter.product_id INNER JOIN price_codegenration ON price_codegenration.price_code=filter.price_code WHERE school_code='$school'  AND price_codegenration.status='Active' AND products.status='Active' AND price_codegenration.level='1' AND products.class_key='$class_key' group by product_name ORDER BY product_id DESC")->result(); 
                   
                 // }
                      $SE = $this->db->get_where('study_material_byprid', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Success','product_name' =>'MaRRS Scientia Exertus'))->row();
                      $Mathbee = $this->db->get_where('study_material_byprid', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Success','product_name' => 'MaRRS International Math Bee'))->row();
                     
                      $Spellingbee = $this->db->get_where('study_material_byprid', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Success','product_name' => 'MaRRS International Spelling Bee'))->row();
                    
                      $Expressmath = $this->db->get_where('study_material_byprid', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Success','product_name' =>'MaRRS Xpress Math'))->row();
                     
                      $wordchase = $this->db->get_where('study_material_byprid', array('prid' =>$this->session->userdata('prid'),'payment_status'=>'Success','product_name' =>'MaRRS Word Chase'))->row();
                     
                     
                    //print_r($resutl_cart->product_name);die;
                     $query = $this->db->query("SELECT  products.product_name,price_codegenration.product_price,products.product_id,price_codegenration.price_code FROM filter INNER JOIN products ON products.product_id=filter.product_id INNER JOIN price_codegenration ON price_codegenration.price_code=filter.price_code WHERE price_codegenration.status='Active' AND products.status='Active' AND price_codegenration.level='1' AND $clas group by product_name ORDER BY product_id ASC")->result(); 
                    
                      
                   
                   
                   
                     foreach ($query as $key => $row)
                      
                    {  
                 
                     if($row->product_id != $Spellingbee->product_id) { 
                     
                     if($row->product_id != $Mathbee->product_id) { 
                         
                         if($row->product_id != $SE->product_id) { 
                          
                           if($row->product_id != $Expressmath->product_id) {    
                             
                           if($row->product_id != $wordchase->product_id) {    
                     ?>
                     
                    <tr>
                         
                   <!--<level> -->
                      <td><input type='checkbox' id='product_id' class="" name='product[]' value='<?php echo $row->product_id;?>'></td>
                      <td><?php echo $row->product_name;?></td>
                      <td>₹ <?php echo $row->product_price;?></td> 
                      
                    </tr>
                   
                      <?php } 
                               
                           }
                             
                         }
                      } 
                     }
                    }
                    ?>
                    <tr>
                    <td colspan="3"> <button type="submit" class="btn btn-primary btn add_to_cart" name="add"><i class="fa-solid fa-cart-plus"></i>&nbsp;Add to Cart</button>
                    </td>
                    </tr>
                    
                  </tbody>
            </table>
                
                   
            
        </form>
         <div style='color:crimson;padding-left:10px;'>
                            <h2><?php echo $this->session->flashdata('message'); ?></h2>
                            </div>
    </div>
</div>
</div>


    <!-- ============= cart =============== -->
    
   <?php if(!empty($query23->result())) { ?>
    <div class="container">
    <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;"  >

        <table  class="table table-bordered" style=" ">
            <thead>
                 <tr>
                          <th colspan="4" style="font-weight:600;font-size: 2rem;background: #0e9c98;"> Your Carts</th>
                      </tr>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
             <!-- <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>-->
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <body>
              <form method='post' action=''>
              <?php 
              
              //$query1 = $this->db->query("");
              $i=0; $amount=0;foreach($query23->result() as $row){ $i=$i+1;?> 
                <tr>
                    
               
                    <td style="border:none;text-indent:15px;"><?php echo $i;?></td>
                    <td style="border:none;text-indent:15px;"><?php print_r($row->product_name);?></td>
                    <td ><?php print_r($row->class_name);?></td>
                    <!--<td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php print_r($row->amount);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>-->
                    <td ><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php print_r($row->product_name.'ok'.$period);?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
                </tr>
                <?php } ?>
                </form>
                <form method='post' action="<?php echo base_url()?>welcome/pay">
                 <?php 
                    
                   $data_stu =  $this->db->get_where('students', array('prid' =>$prid))->row();
                   
                    ?>
                <tr>
                    <td style="border:none; text-indent:15px;"></td>
                    <td style="border:none;  text-indent:15px;"></td>
                    <td style="border:none; text-indent:15px;"></td>
                   <!-- <td style=" padding-top:10px; padding-bottom:10px;">Total Amount</td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php echo $amoun; ?></td>-->
                    <input type='hidden' value="<?php echo $data_stu->first_name; ?>" name="name" >
                     <input type='hidden' value="<?php echo $data_stu->email; ?>" name="email">
                      <input type='hidden' value="<?php echo $data_stu->mobile; ?>" name="contact">
                    <input type='text' style='display:none;' name='amount' value='<?php echo $amoun; ?>'>
                    <td><button type="submit" name="pay" id="pay" class="btn btn-primary" value='<?php echo $prid;?>' style='width:100%;height:40px;background-color:#ff9933;font-size:18px;color:#333;'><b>Register</b></button></td>
                </tr>
                </form>
          </body>
        </table>
        
</div>
</div>
</div>
<?php }else{ ?>
 <div class="container">
    <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;"  >
        <table  class="table table-bordered" style=" ">
            <thead>
                   <tr>
                          <th colspan="6" style="font-weight:600;font-size: 2rem;background: #0e9c98;"> Your Carts</th>
                      </tr>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <body>
              <form method='post' action=''>
              <?php 
              
              //$query1 = $this->db->query("");
              $i=0; $amount=0;foreach($query2->result() as $row){ $i=$i+1;?>
                <tr>
                    
               
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->class_name);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php print_r($row->amount);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php print_r($row->product_name.'ok'.$period);?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
                </tr>
                <?php } ?>
                </form>
                <form method='post' action="<?php echo base_url()?>welcome/pay">
                   
                 <?php 
                    
                   $data_stu =  $this->db->get_where('students', array('prid' =>$prid))->row();
                   
                    ?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style=" padding-top:10px; padding-bottom:10px;">Total Amount</td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php echo $amoun; ?></td>
                    <input type='hidden' value="<?php echo $data_stu->first_name; ?>" name="name" >
                     <input type='hidden' value="<?php echo $data_stu->email; ?>" name="email">
                      <input type='hidden' value="<?php echo $data_stu->mobile; ?>" name="contact">
                    <input type='text' style='display:none;' name='amount' value='<?php echo $amoun; ?>'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="pay" id="pay" class="btn btn-primary" value='<?php echo $prid;?>' style='width:100%;height:40px;background-color:#ff9933;font-size:18px;color:#333;'><b>Pay</b></button></td>
                </tr>
                </form>
          </body>
        </table>
        
</div>
</div>
</div>
<?php }?>
<!-- =================== subscribed products ====================== -->
<?php if(!empty($query111->result())) { ?>
 <div class="container">
    <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;"  >
        
        
        <table  class="table table-bordered" style="">
            <thead>
                   <tr>
                          <th colspan="6" style="font-weight:600;font-size: 2rem;background: #0e9c98;"> Subscribed - Programs
</th>
                      </tr>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">CIN</th>
                  <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
                </tr>
            </thead>
            <body>
     
              <?php $i=0; foreach($query111->result() as $row){ $i=$i+1?>
                <tr>
                    <td style=" padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->cin);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo 'Registered';?></td>
                </tr>
                <?php } ?>
               
            </body>
        </table>
</div > 
</div>
</div>
  
    <?php } ?>
<div id='pad'>
    
</div>
</body>
<script type="text/javascript">

  $(".product").on('change', function () {
       
        var BASE_URL='https://marrs.in/student_registration';
        var catg=this.value;
         var prid="<?php echo $prid; ?>";
        //  alert(prid);
         $.ajax({
          url:BASE_URL+"/welcome/ajax/",
            type: 'post',
            data:{id:catg,prid:prid}, 
           
            success:function(result)
			{
			 //   console.log(result);
			    location.reload();
				// alert(result);
                // $("#category").html(result);
        }});
    }); 
 </script>
<?php include('student_footer.php'); ?>