<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	    // print_r($result);
	 
if(!empty($this->session->flashdata('updated'))){?>
    <div style="background: green;padding: 10px;">
        <h3 style='color:#fff;'><?php echo $this->session->flashdata('updated'); ?></h3>
    </div>
<?php } ?>

<style>
    div#example_filter {
    float: right;
    position: relative;
    right: 0px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
    
</style>
  
 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload Mock Paper </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="border rounded">

<div class="container">
    <div class="row g-3 align-items-end">

        <!-- Name -->
        <div class="col-md-2">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Account Number -->
        <div class="col-md-2">
            <label class="form-label">Account Number</label>
            <input type="text" name="account_number" id="account_number" class="form-control" required>
        </div>

        <!-- IFSC -->
        <div class="col-md-2">
            <label class="form-label">IFSC</label>
            <input type="text" name="ifsc" id="ifsc" class="form-control" required>
        </div>

        <!-- Mobile -->
        <div class="col-md-2">
            <label class="form-label">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" class="form-control" required>
        </div>

        <!-- Email -->
        <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" required>
        </div>

        <!-- GST -->
        <div class="col-md-1">
            <label class="form-label">GST %</label>
            <input type="text" name="gst" id="gst" class="form-control" required>
        </div>

        <!-- Button -->
        <div class="col-md-1">
            <button type="submit" name="submit" class="btn btn-info w-100">Add</button>
        </div>

    </div>
</div>

</form>		    
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
        			}?>
			</h4></div>
				 <?php  if(!empty($list_materials)): ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Mock Papers Makers.</td></tr>
							 <tr>
								<th>SI no</th> <th>Name</th> <th>Email</th> 
								<th>Mobile</th>
								<th>Account Number</th>	<th>IFSC</th><th>GST</th>	<th>Razorpay ID</th>	
								<th>Status</th><th>Action</th>
							 </tr>
							<?php    
							  $i=0;  
							  //print_r($list_materials);die;
							  foreach($list_materials as $details){ 
							    //  print_r($details);die;
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['name'];  ?> </td>
									<td align="CENTER"> <?php   
									
									    echo $details['email'];
									?> </td>
									<td align="CENTER">
									    <?php 
									     
									    echo $details['mobile']; 
									    ?>
									</td>
									<td align="CENTER"> <?php  echo $details['account_number'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['ifsc'];  
									
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['gst'];  
									
									?> </td>
									<td align="CENTER"> <?php  echo $details['razorpay_id'];  
									
									?> </td>
									
								
									<td align="CENTER"> <?php  echo $details['status']; ?> </td>
									<td align="CENTER">
									    <form method='POST'>
									    <button name='delete' value='<?php  echo $details['mock_paper_maker_id']; ?>'
									     class='btn btn-danger' type='submit'>Delete</button>
									    </form>
									</td>
							 </tr>
							<?php  } ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	
  </div>	
 </div><!--/span-->
</div><!--/row-->

<script>
    $("#product").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/admin/";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/productwiselevel",
data:{product_id:product_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#level").html(result);
	 

}});
});
    
    
</script>


<?php include('footer.php'); ?>