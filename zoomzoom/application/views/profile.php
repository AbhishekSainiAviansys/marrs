<?php include('student_left_menu.php');
//$pri=$this->session->userdata('cart');
//print_r($pri);
foreach ($student as $row){
    $prid=$row->PRID;
    $name=$row->first_name.' '.$row->middle_name.' '.$row->last_name;
    $mname=$row->mother_name;
    $fname=$row->father_name;
    $address=$row->address1.' '.$row->address2;
    $school=$row->school_code;
    $prid=$row->PRID;
}


                             
                            $query = $this->db->query("select * FROM period WHERE status='Active' ;");
                            
                             foreach ($query->result() as $row)
                            {
                            $period=$row->period_id;
                            }
                            
    $query1 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid';");
    $query2 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Paid' ;");
                            //  foreach ($query1->result() as $row)
                            // {
                            // print_r($row);
                            // }

?>

<head>	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" >
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>MaRRS INTELLECTUAL SERVICES</title>

	<meta name="generator" content="MaRRS Coming Soon" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta property="og:url" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Coming Soon Page" />
	<meta property="og:description" content="" />
	
	 <!--Font Awesome CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
	 <!--Bootstrap and default Style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	 <!--Google Fonts -->
	<link class="gf-headline" href='https://fonts.googleapis.com/css?family=Pacifico:400&subset=' rel='stylesheet' type='text/css'>
			
	 <!--Animate CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<script>
</script>
<style>
body{
    background-color:#fff0b3;
}

td{
    background-color:#6600ff;
    color:#fff;
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:250px;
    margin-right:250px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
</style>


<div style='padding-top:20px;display:flex;'>
    <div id='product' id='h' >
        <h1>Student Details View</h1>
    </div>
    <form method='POST' action=''>
    <div  style='padding-right:30px;'>
        <button type="submit" name="logout" id="logout" class="btn btn-primary" style='width:100%;height:40px;background-color:#6600ff;font-size:18px;'>Logout</button> 
    </div>
    </form>
</div>
    <!-- =================== Form Start ===================== -->
    <div style='text-align:center;color:#ff9900;'><h2><?php $this->session->flashdata('message');?></h2>
   <marquee><h3>Please, note down your PRID "Participent Registration Number".<br>PRID is also send on your email.</h3></marquee> </div>
<div style='font-size:18px;' id='corner'>
            <!--<marquee>Note: Only MISB school access code is accepted. Student not having school code may contact to school.</marquee>-->
            <div class="table-responsive">
    <table class="table table-bordered" style="border:none; font-family:Verdana, Geneva, sans-serif; width:100%;">
      <thead>
        <tr style=" background:#333; color:#FFF;">
      
          <th colspan="3" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Student Details</th>
        </tr>
      </thead>
      <tbody>
        
        <tr style="background:#f6e2ff;">
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">PRID</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:</td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $prid; ?></td>
        </tr>
        <tr style="background:#fee5b9;">
       
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Name</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:</td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $name; ?></td>
        </tr>
        <tr style="background:#effeb9;">
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Address</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:</td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $address; ?></td>
        </tr>
      <tr style="background: #C7D1FA;">
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">School Code</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:</td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $school; ?></td>
       </tr>

 <tr style="background: #8FDAAA;">
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Father Name</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:  </td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $fname; ?></td>
       </tr>
<tr style="background:#e2f4ff; border-left:none;">
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Mother Name</td>
          <td style=" padding-top:10px; padding-bottom:10px;">:</td>
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $mname; ?></td>
        </tr>

      </tbody>
     </table>
</div>
</div>


<div style='padding-top:20px;'>
    <div id='product' id='h' >
        <h3>Products Subscribed</h3>
    </div>
</div>
<div id='corner' class="table-responsive">
    <table  class="table table-bordered" style="border:none; font-family:Verdana, Geneva, sans-serif; width:100%;">
        <thead>
        <tr style=" background:#333; color:#FFF;">
            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Category</th>
          <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
        </tr>
      </thead>
      <body>
         
          <?php $i=0; foreach($query2->result() as $row){ $i=$i+1?>
            <tr>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?>:</td>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?>:</td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->category_name);?>:</td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
            </tr>
            <?php } ?>
           
           
            <!--<tr>-->
            <!--    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>-->
            <!--    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>-->
            <!--    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>-->
            <!--</tr>-->
           
      </body>
    </table>
    
</div>




<div style='padding-top:20px;'>

<div style='padding-top:20px;'>
    <div id='product' id='h' >
        <h3>Products Cart</h3>
    </div>
</div>
<div id='corner' class="table-responsive">
    <table  class="table table-bordered" style="border:none; font-family:Verdana, Geneva, sans-serif; width:100%;">
        <thead>
        <tr style=" background:#333; color:#FFF;">
            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Category</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Price</th>
          <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
          <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Action</th>
        </tr>
      </thead>
      <body>
          <form method='post' action=''>
          <?php $i=0; $amount=0;foreach($query1->result() as $row){ $i=$i+1?>
            <tr>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?>:</td>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?>:</td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->category_name);?>:</td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->amount);$amount=$amount+$row->amount;?></td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
                <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="delete" id="delete" class="btn btn-primary" value='<?php print_r($row->category_name.'ok'.$row->product_name.'ok'.$period);?>' style='width:100%;height:40px;background-color:#fff;font-size:18px;color:#333;'>Remove</button></td>
            </tr>
            <?php } ?>
            </form>
            <form method='post' action="<?php echo base_url()?>Welcome/checkout">
            <tr>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"></td>
                <td style=" padding-top:10px; padding-bottom:10px;">Total Amount</td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $amount; ?></td>
                <td style=" padding-top:10px; padding-bottom:10px;"><button type="submit" name="pay" id="pay" class="btn btn-primary" value='<?php echo $prid;?>' style='width:100%;height:40px;background-color:#fff;font-size:18px;color:#333;'>Pay</button></td>
            </tr>
            </form>
      </body>
    </table>
    
</div>




<div style='padding-top:20px;'>
    <div id='product' id='h' >
        <h3>Select Product and Apply for the competition</h3>
    </div>
</div>
<div id='corner' style='background-color:#333;'>
    <form method='POST' id='form-out' action="<?php echo base_url()?>Welcome/cart">
        <input type="text" name="prid" value="<?php echo $prid;?>" style='display:none;'> 
        <input type="text" name="school" value="<?php echo $school;?>" style='display:none;'> 
        <input type="text" name="period" value="<?php echo $period;?>" style='display:none;'>
        
        
        <div class="container-fluid">
  
          <div class="row" style='padding-top:20px;'>
              
                              
                         
                <div class="col-sm-6" >
                    <div>
                      <label id='label'>Products</label>
                    </div>
                    <div>
                        <select name="product_id" id="product_id" class="form-control"  >
                            <option>select product</option>
                          <?php
                             
                            $query = $this->db->query("select price_code.amount,products.product_name,products.product_id FROM filter INNER JOIN products ON filter.product_id=products.product_id
INNER JOIN price_code ON filter.price_code=price_code.price_code
WHERE filter.school_code='$school' ;");
                            
                             foreach ($query->result() as $row)
                            {
                            echo "<option value='{$row->product_id}'>{$row->product_name}.' Price Fee ' = '.'{$row->amount}'</option>";
                            }
                            
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div>
                      <label id='label'>Category</label>
                  </div>
                  <div>
                      <select name="category" id="category" class="form-control" >
                          <option value="">select category</option>
                          
                        </select>
                  </div>
                </div>
            
            </div>
            <div class='row' style='padding-top:20px;padding-bottom:20px;'>
                <div class="col-sm-12" style='text-align:center;'>
                    <button type="submit" name="add" id="add" class="btn btn-primary" style='width:30%;height:40px;background-color:#fff;font-size:18px;color:#333;'>Add Product</button> 
                </div>
                
            </div>
        </div>
        
    </form>
    
</div>
<div style='padding-top:40px;'>
    
</div>

<script type="text/javascript">
      $("#product_id").change(function(){
         var BASE_URL='https://marrs.in/student_registration';
        var catg=this.value;
        
        $.ajax({
           url:BASE_URL+"/welcome/ajax/",
            data:{id:catg},
            type: 'post',
            success:function(result)
			{
			    console.log(result);
				//alert(result);
                 $("#category").html(result);
        }});
    }); 
 </script>

<?php //include("footer.php");?>