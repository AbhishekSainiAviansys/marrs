<?php 
include('student_header.php');
include('student_nav.php'); 
 foreach ($student as $row){
    $school=$row->school_code;
    $prid=$row->PRID;
    $class_key=$row->class_key;
}
// echo $school;die;
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

 $query3 = $this->db->query("select * FROM student_result WHERE prid='$prid'");

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
td{
    background-color:#6600ff;
    color:#fff;
}
</style>
<body>
    <!--<div style='padding-top:20px;'>-->
    <!--    <div id='product' id='h' >-->
    <!--        <h3>-->
    <!--        Subscribe Learning programmes</h3>-->
    <!--    </div>-->
    <!--</div>-->

    

           
    
<div  style='padding-top:30px;'>
    <div id='corner' style='padding-left:30px;padding-top:5px;padding-bottom:5px;'>
        <form  method='post' >
                
                
                            <!--<h3 style='color:black;'>Select Class For purchchse learning programmes</h3>-->
                            <!--<div>-->
                            <!--  <h3>Class</h3>-->
                            <!--</div>-->
                            <!--<div>-->
                            <!--    <select name="class_id" id="class_id" class="form-control"  style='width:30%;'>-->
                            <!--        <option>select your class</option>-->
                                  <?php
                                     
                           //       $query = $this->db->query("select * from class;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->class_id}'>{$row->class_name}</option>";
                                    // }
                                    
                                    ?>
                            <!--    </select>-->
                            <!--</div>-->
                    
                          <h3 style="color:#000">Yet To Register Programs</h3>
                       
                   
                
                
                <?php
                     
                    $query = $this->db->query("SELECT  products.product_name,price_codegenration.product_price,products.product_id,price_codegenration.price_code,price_codegenration.level FROM filter INNER JOIN products ON products.product_id=filter.product_id INNER JOIN price_codegenration ON price_codegenration.price_code=filter.price_code WHERE school_code='$school' AND products.class_key='$class_key' AND price_codegenration.status='Active' AND products.status='Active' AND price_codegenration.level='2' ORDER BY product_id DESC")->result();
 //print_r($query);exit;
                   
                     foreach ($query as $row)
                    { ?>
                   <level>    
                    <input type='checkbox' id='product_id' class="" name='product[]' value='<?php echo $row->product_id;?>'> <?php echo $row->product_name;?>  Price Fee: ₹ <?php echo $row->product_price;?>  </level><br>
                  <?php  }
                    
                    ?>
                
                        
                
                
                <button type="submit" class="btn btn-primary add_to_cart" name="add">Add to Cart</button>
               
                        
            
        </form>
         <div style='color:crimson;padding-left:10px;'>
                            <h2><?php echo $this->session->flashdata('message'); ?></h2>
                            </div>
    </div>
</div>
</div>


    <!-- ============= cart =============== -->
<div  style='padding-top:30px;'>
    <div id='corner'  class='table-responsive'>
        <div style='color:black;padding-left:10px;'><h3>Your Cart</h3></div>
        <table  class="table table-bordered" style=" ">
            <thead>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
               <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <body>
              <form method='post' action=''>
              <?php 
              
              //$query1 = $this->db->query("");
              $i=0; $amount=0;foreach($query2->result() as $row){ $i=$i+1;
              
             
              ?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->class_name);?></td>
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php $lid = $row->level;
                  $this->db->select('*');$this->db->from('comp_level');
                  $this->db->where('id', $lid);$query = $this->db->get();
                   $lav=$query->row();echo $lav->level_name;     
                     ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php print_r($row->amount);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php print_r($row->product_name.'ok'.$period);?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
                </tr>
                <?php } ?>
                </form>
                <form method='post' action="<?php echo base_url()?>Welcome/checkout">
                
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                      <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style=" padding-top:10px; padding-bottom:10px;">Total Amount</td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php echo $amoun; ?></td>
                    <!--<input type='text' value="<?php //echo $amount; ?>" name="amount" style='display:none;'>-->
                    <input type='text' style='display:none;' name='amount' value='<?php echo $amoun; ?>'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="pay" id="pay" class="btn btn-primary" value='<?php echo $prid;?>' style='width:100%;height:40px;background-color:#ff9933;font-size:18px;color:#333;'><b>Pay</b></button></td>
                </tr>
                </form>
          </body>
        </table>
        
</div>
</div>

<!-- =================== subscribed products ====================== -->
<div style='padding-top:20px;'></div>
<div id='corner' class='table-responsive'>
        <div style='color:black;padding-left:10px;'><h3>Subscribed - Programs</h3></div>
        
        
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Category</th>-->
                  <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
                </tr>
            </thead>
            <body>
     
              <?php $i=0; foreach($query1->result() as $row){ $i=$i+1?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?></td>
                    <!--<td style=" padding-top:10px; padding-bottom:10px;"><?php //print_r($row->class_name);?>:</td>-->
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
                </tr>
                <?php } ?>
               
            </body>
        </table>
    </div>
</div >        
<div id='pad'>
    
</div>
</body>
<script type="text/javascript">

//   $(".product").on('change', function () {
       
//         var BASE_URL='https://marrs.in/student_registration';
//         var catg=this.value;
//          var prid="<?php echo $prid; ?>";
//         //  alert(prid);
//          $.ajax({
//           url:BASE_URL+"/welcome/ajax/",
//             type: 'post',
//             data:{id:catg,prid:prid}, 
           
//             success:function(result)
// 			{
// 			 //   console.log(result);
// 			    location.reload();
// 				// alert(result);
//                 // $("#category").html(result);
//         }});
//     }); 
 </script>
<?php include('student_footer.php'); ?>