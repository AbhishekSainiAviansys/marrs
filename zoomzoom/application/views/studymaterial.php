<?php 
include('student_header.php');
//print_r($purchasematerialdata);
//print_r($paidmaterialdata);
$arra=array();

foreach($purchasematerialdata as $row){
    //print_r($row);
    if(!empty($row['product_name'])){
        array_push($arra,$row['product_name']);
    }
    
}

//print_r($arra);
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
    
    
<div  style='padding-top:30px;'>
    <div id='corner' style='padding-left:30px;padding-top:5px;padding-bottom:5px;'>
    
            <h3 style="color:#000">Free Learning Materials</h3>
                       
             
         <div style='color:crimson;padding-left:10px;'>
        <table  class="table table-bordered" style="background-color:#005580;color:black;">
            <thead>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              
             
               <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>-->
              
              <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>-->
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Material Title</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <tbody>

               
             <?php //$materialdata = '';
             //print_r($materialdata);
             $i=1;
            
             foreach($materialdata as $data){
             
             ?>
             <tr>
                    
                    <td style=""><?php echo $i; ?> </td>
                   
                     <td style=" "><?php print_r($data['product']);?></td>
                    
                    <td style=""> <?php if(empty($data['title'])){ echo 'Available Soon...';}else{  echo $data['title']; }?></td>
                    <td style=""><a href='<?php if(!empty($data['folder'])){ echo base_url();?>welcome/free_material/id/<?php echo $data['folder']; }?>' class="btn btn-primary" style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Download</a></td>
                </tr>
           <?php 
           $i=$i+1;
           } ?>
          
          </tbody>
        </table>              
        </div>
    </div>
</div>


<div  style='padding-top:30px;'>
    <div id='corner' style='padding-left:30px;padding-top:5px;padding-bottom:5px;'>
        
        
        
        <form  method='post' >
                
                
                            
                    
                          <h3 style="color:#000">Purchase Learning Materials</h3>
                       
                    <table  class="table table-bordered" style="background-color:#005580;color:black;">
            <thead>
            <tr style=" background:#333; color:#FFF;">
                <th style=" text-indent:15px;padding-top:10px; padding-bottom:10px;" ></th>
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Material Title</th>
                <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Price </th>
              <!--<th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>-->
            </tr>
          </thead>
          <tbody>
                
               <?php
           $i=1;
          // print_r( $paidmaterialdata);
            
                   
                      foreach ($paidmaterialdata as $row) 
                     { ?>
                     <tr>
                    
                    <td style="">
                        <?php
                    
                     if(in_array($row['product'],$arra)){
                         // echo 'purchased';
                         ?>
                          <?php
                     }else{
                          if(!empty($row['title'])){
                     ?>
                        <input type="checkbox" name="check[]" class='from-control' value='<?php echo $row['product'].' '.$row['price'];?>'> 
                        <?php } } ?>
                        </td>
                     <td><?php echo $i; ?></td>
                   
                     <td style=" "><?php 
                    
                     print_r($row['product']);
                    
                     ?></td>
                    
                     <td style=""> <?php if(empty($row['title'])){ echo 'Available Soon...';}else{  echo $row['title']; }?></td>
                     <td style=""> <?php
                    
                     if(in_array($row['product'],$arra)){
                          echo 'Purchased';
                            if(!empty($row['title'])){
                         ?>
                        <a href="<?php echo base_url();?>welcome/paid_material/<?php echo $row['folder']; ?>" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></a>
                                           
                         <?php
                     }}else{
                     
                     print_r($row['price']);
                     }
                     
                     ?></td>
                    <!--<td style=""><a href='' class="btn btn-primary" style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Buy Now</a></td>-->
                </tr>
           <?php 
           $i=$i+1;
           } ?>
                
                        
                
                
              
               
            </tbody>
        </table>                 
             <button type="submit" class="btn btn-primary add_to_cart" name="add"><i class="fa-solid fa-cart-plus"></i>&nbsp;Add to Cart</button> 
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
        <table  class="table table-bordered" style="background-color:#005580;color:black;">
            <thead>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Material Name</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
               <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
              <!--<th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>-->
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <body>
              <form method='post' action=''>
                  
              <?php   
              //echo $prid;
              $query2 = $this->db->query("select * FROM study_material_purchase WHERE prid='$prid';");
             $i=0; $amount=0;foreach($query2->result() as $cart){ $i=$i+1;
            $amoun+=$cart->amount;
            //print_r($cart);
             ?>
             <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> <?php echo $i;?> </td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> <?php echo $cart->product_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($student[0]->class);?></td>
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php echo 'School Level';?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹<?php echo $cart->amount;?> </td>
                    <!--<td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cart->payment_status;?></td>-->
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php echo $cart->id;?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
                </tr>
            <?php } ?>
                </form>
                <form method='post' action="<?php echo base_url()?>Welcome/pay">
                
                 <input type='hidden' value='<?php echo $student[0]->mobile; ?>' name='contact'>
                    <input type='hidden' value='<?php echo $student[0]->email; ?>' name='email'>
                
                
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                      <!--<td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>-->
                    <td style=" padding-top:10px; padding-bottom:10px;">Total Amount</td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹ <?php echo $amoun ?></td>
                    <input type='text' value="<?php echo $amoun; ?>" name="amount" style='display:none;'>
                    <input type='text' style='display:none;' name='amount' value='<?php echo $amoun; ?>'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="pay" id="pay" class="btn btn-primary" value='<?php echo $cart->prid?>' style='width:100%;height:40px;background-color:#ff9933;font-size:18px;color:#333;'><b>Pay</b></button></td>
                </tr>
              
                </form>
          </body>
        </table>
        
</div>
</div>

<!-- =================== subscribed products ====================== -->
<div style='padding-top:20px;'></div>

</div >        
<div id='pad'>
    
</div>
</body>
<script type="text/javascript">

//   $(".product").on('change', function () {
       
//         var BASE_URL='https://marrs.in/student_registration';
//         var catg=this.value;
//          var prid="<?php //echo $prid; ?>";
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