<?php 

include('student_header.php');
$prid = $_SESSION['prid'];

$student = $this->db->get_where('students',array('PRID'=>$_SESSION['prid']))->row(); 
 
$class2 =$student->class;
 	if($class2=='Nursery'){
	$clas = array('Nursery_class' =>'Nursery');
	$class = array('Nursery_class' =>'Nursery','product_to_school.school_code'=>$school);
	
	}if($class2=='LKG'){
	    $clas = array('LKG_class'=>'LKG');
		$class = array('LKG_class'=>'LKG','product_to_school.school_code'=>$school);
	}elseif($class2=='UKG'){
		$clas =array('UKG_class'=>"UKG");
		$class =array('UKG_class'=>"UKG",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-1'){	
	    $clas =array('1_8_class'=>"1_8"); 
	    $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school); 
	}elseif($class2=='Class-2'){
		 $clas =array('1_8_class'=>"1_8");
		  $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-3'){
		 $clas =array('1_8_class'=>"1_8"); 
		 $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school); 
	}elseif($class2=='Class-4'){
		 $clas =array('1_8_class'=>"1_8"); 
		 $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-5'){
		 $clas =array('1_8_class'=>"1_8"); 
		 $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school); 
	}elseif($class2=='Class-6'){
		 $clas =array('1_8_class'=>"1_8"); 
		  $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school); 
	}elseif($class2=='Class-7'){
		 $clas =array('1_8_class'=>"1_8"); 
		  $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school); 
	}elseif($class2=='Class-8'){
		 $clas =array('1_8_class'=>"1_8"); 
		 $class =array('1_8_class'=>"1_8",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-9'){
		 $clas =array('9_12_class'=>"9_12");
		 $class =array('9_12_class'=>"9_12",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-10'){
		 $clas =array('9_12_class'=>"9_12"); 
		 $class =array('9_12_class'=>"9_12",'product_to_school.school_code'=>$school);  
	}elseif($class2=='Class-11'){
		 $clas =array('9_12_class'=>"9_12");
		 $class =array('9_12_class'=>"9_12",'product_to_school.school_code'=>$school);
	}elseif($class2=='Class-12'){
		 $clas =array('9_12_class'=>"9_12"); 
		 $class =array('9_12_class'=>"9_12",'product_to_school.school_code'=>$school);
	}





$ress = $this->db->get_where('cart',array('prid'=>$prid))->result_array();


 $query1 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Paid' ;");
 
 $query2 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid' ;");
 
 $query23 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid'");
 
  $query111 = $this->db->query("select * FROM study_material_byprid WHERE prid='$prid' and payment_status ='success' ;");
 
 //print_r($query2->result());exit;
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

    
<?php if(!empty($prid)){ ?>
<div class="container">           
    
        
<a onclick="history.back()" class="btn btn-outline-secondary btn-sm text-start" style="font-size: 16px;position: relative;
    left: 0px;
    top: 10px;"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px"></i>BACK</a>
<div class="row" >
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top:2%;"  >
        
     
        <form  method='post' >
              <input type='hidden' id='class_name' class="" name='class' value='<?php echo $class2;?>'>
            <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th colspan="6" style="font-weight:600;font-size: 2rem;background: #0e9c98;"> Yet To Register Programs</th>
                      </tr>
                    <tr  style="background:#333; color:#FFF;">
                      <th scope="col">Select</th>
                      <th>Product Name</th>
                       <th>Price Code</th>
                      <th>Fee</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                    $query = $this->db->get_where('products',$clas)->result();
                   
                     foreach ($query as $key=>$row)
                      //echo $key[$product_purchase->product_name];die;
                    {  
                        if($row->product_name!=$product_purchase[0]['product_name']){
                        if($row->product_name!=$product_purchase[1]['product_name']){
                        if($row->product_name!=$product_purchase[2]['product_name']){
                        if($row->product_name!=$product_purchase[3]['product_name']){
                        if($row->product_name!=$product_purchase[4]['product_name']){ 
                        if($row->product_name!=$product_purchase[5]['product_name']){    
                    ?>
                     
                    <tr>
                         
                   <!--<level> -->
                       <td> <input type='checkbox' id='product_id' class="" name='product' value='<?php echo $row->product_name;?>' 
                       <?php   foreach ($ress as $key=>$value){ if($row->product_name==$value['product_name']){ echo 'checked="checked"';} } ?> 
                       
                       > Add to cart </td>
                      <td><?php echo $row->product_name;?></td>
                       <td><?php if($row->product_name==$value['product_name']='MaRRS Math Zoom Zoom Challenge'){ echo 'PC23-299'; } else{ echo 'PC23-275';}?></td> 
                      <td>₹ <?php if($row->product_name==$value['product_name']='MaRRS Math Zoom Zoom Challenge'){ echo '299'; } else{ echo '275';}?><input type='hidden' id='amount' class="" name='amount' value='<?php if($row->product_name=='MaRRS Math Zoom Zoom Challenge'){ echo '299'; } else{ echo '275';}?>'> </td> 
                       
                      
                      
                      
                    </tr>
                   
                      <?php } } } } } } } 
                        
                          
                    ?>
                   
                    
                  </tbody>
            </table>
                
                   
            
        </form>
         <div style='color:crimson;padding-left:10px;'>
                            <h2><?php echo $this->session->flashdata('message'); ?></h2>
                            </div>
    </div>
</div>
</div>

<?php }?>
    <!-- ============= cart =============== -->
    

    
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
                   <td style=" padding-top:10px; padding-bottom:10px;"><a name="delete" id="deleteid" class="btn btn-primary deleteid" onclick="return confirm('Are you sure you want to Remove?');" data-id="<?php echo $row->id;?>" value='<?php echo $row->id;?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
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
  $('input[type="checkbox"]').on('click', function() {
     $("input:checkbox[name=product]:checked").each(function(){
   
             var product_name = $(this).val();
             var amount = $('#amount').val();
             var classs = $('#class_name').val();
            
             $.ajax({
             url:"<?php echo base_url();?>"+"/welcome/addtocart/",
            type: 'post',
            data:{product_name:product_name,amount:amount,class:classs}, 
           
            success:function(result)
			{
			 
			 location.reload();
			
        }});
});

$('input[type=checkbox]:not(:checked)').each(function(){
    
     var product_name = $(this).val();
     
   $.ajax({
          url:"<?php echo base_url();?>"+"/welcome/removeItem/",
            type: 'post',
            data:{product_name:product_name}, 
           
            success:function(result)
			{
		        location.reload();
			    // $("#category").html(result);
        }});

});
}); 
     $('.deleteid').click(function(){
     
    var id = $(this).data("id");
     $.ajax({
          url:"<?php echo base_url();?>"+"/welcome/deletecartitem/",
            type: 'post',
            data:{id:id}, 
           
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