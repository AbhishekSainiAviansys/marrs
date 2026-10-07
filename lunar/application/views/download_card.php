<?php 
include('student_header.php');
include('student_nav.php'); 

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
                <table  class="table table-bordered" style=" ">
            <thead>
            <tr style=" background:#333; color:#FFF;">
                <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Material Name</th>
              
             
               <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
            
          </thead>
          <tbody>
             <?php $materialdata = '';
             if($materialdata){
             
             ?>
             <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">  </td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> </td>
                   
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php // $clavel = $cart->clevel; echo $this->db->get_where('comp_level',array('id' =>$clavel))->row()->level_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> <?php// echo $cart->amount;?> </td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php// echo $cart->payment_status;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Download</a></td>
                </tr>
                 <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">  </td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> </td>
                   
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php // $clavel = $cart->clevel; echo $this->db->get_where('comp_level',array('id' =>$clavel))->row()->level_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> <?php// echo $cart->amount;?> </td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php// echo $cart->payment_status;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Download</a></td>
                </tr>
                 <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">  </td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> </td>
                   
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php // $clavel = $cart->clevel; echo $this->db->get_where('comp_level',array('id' =>$clavel))->row()->level_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> <?php// echo $cart->amount;?> </td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php// echo $cart->payment_status;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Download</a></td>
                </tr>
           <?php } ?>
           
          </tbody>
        </table>              
        </div>
    </div>
</div>


<div  style='padding-top:30px;'>
    <div id='corner' style='padding-left:30px;padding-top:5px;padding-bottom:5px;'>
        
        
        
        <form  method='post' >
                
                
                            
                    
                          <h3 style="color:#000">Purchchse Learning Materials</h3>
                       
                   
                
               <?php
          
                    $query = $this->db->query("SELECT * from study_material where product_id='29' AND clevel='2'")->result();
                       //print_r($query5);exit;
                   
                      foreach ($query as $row)
                     { ?>
                   <level> 
                        <input type="hidden" name="prid" value="<?php echo $_SESSION['prid'];?>">
                        <input type="hidden" name="price" value="<?php echo $row->price;?>">
                        <input type="hidden" name="product_id" value="<?php echo $row->product_id;?>">
                        <input type="hidden" name="clevel" value="<?php echo $row->clevel;?>">
                         <input type="hidden" name="status" value="<?php echo $row->status;?>">
                        <input type="hidden" name="material_title" value="<?php echo $row->title;?>">
                    <input type='checkbox' id='product_id' class="" name='product[]' value='<?php echo $row->id;?>'> <?php echo $row->title;?>  Price Fee: ₹ <?php echo $row->price;?>  </level><br>
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
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Material Name</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
               <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>
              
              <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
              <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
            </tr>
          </thead>
          <body>
              <form method='post' action=''>
                  
              <?php   $query2 = $this->db->query("select * FROM study_material_byprid WHERE prid='$prid' and payment_status ='Unpaid' ;");
             $i=0; $amount=0;foreach($query2->result() as $cart){ $i=$i+1;
            $amoun+=$cart->amount;
            
             ?>
             <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> <?php echo $i;?> </td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"> <?php echo $cart->product_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cart->product_name;?></td>
                     <td style=" padding-top:10px; padding-bottom:10px;"><?php  $clavel = $cart->clevel; echo $this->db->get_where('comp_level',array('id' =>$clavel))->row()->level_name;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"> ₹<?php echo $cart->amount;?> </td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cart->payment_status;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php echo $cart->id;?>' style='width:100%;height:40px;background-color:#ffe6cc;font-size:18px;color:#333;'>Remove</button></td>
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

<?php include('student_footer.php'); ?>