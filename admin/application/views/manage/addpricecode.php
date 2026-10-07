<?php include('header.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Check if the message element exists
    if ($('#message').length) {
        // Set a timeout to remove the message after 3 seconds
        setTimeout(function() {
            $('#message').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
    }
});
</script>
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>blog/">prize Code</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'add';?>/"><?php echo ($blogID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Price Code <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					    <?php if(!empty($message)){?>
					    <h3 id="message" style="background-color:green;color:white;">
					    <?php echo $message; ?>
					    </h3>
					    <?php } ?>
						<form class="form-horizontal border  rounded" method="POST">
							<div class="row">
							
							  <div class="control-group span4">
								<label class="control-label" for="focusedInput">Prefix </label>
								<div class="span4">
								  <input class="" id="postTitle" name="prefix" type="text" value="PC" readonly>
							  </div>
							  </div>
							  
							 <!--   <div class="control-group span4">-->
								<!--<label class="control-label" for="focusedInput">Lavel </label>-->
								<!--<div class="span4">-->
								  
								<!--  <select class="" id="level" name="level">-->
								    <?php 
								     
								     $this->db->select('*');
								     $this->db->from('competition_levels');
								     $this->db->where('status','Active');
								     $res =  $this->db->get();
								     $franchise= $res->result_array();
								    foreach($franchise as $value){
								    ?>   
								  <!--<option value="<?php echo $value['id'];?>"><?php echo $value['level_name'];?> </option>-->
								 	<?php } ?>
								 	 	 	 
								<!--  </select>-->
								<!--</div>-->
							 <!-- </div>-->
							   <div class="control-group span4">
								<label class="control-label" for="focusedInput">Period </label>
								<div class="span4">
								     <?php 
								     
								     $this->db->select('period_name,period_id');
								     $this->db->from('period');
								     $this->db->where('status','Active');
								     $res =  $this->db->get();
								     $franchise= $res->row()->period_name;
								    
								    ?>
								  <select class="" id="period" name="period">
								      
								 <option value="<?php echo $res->row()->period_id;?>"><?php echo $franchise;?> </option>
								  </select>
								</div>
							  </div>
							  
							  </div><div class="row">
							 
							  <div class="control-group span4">
								<label class="control-label" for="focusedInput">Price </label>
								<div class="controls" >
								 <input type="text" name="product_price" placeholder="Price" value=""> 
							
								</div>
							  </div>
							</div>
						
						
							  <div class="multibtn my-2">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
								<button class="btn btn-danger btn-sm rounded">Cancel</button>
							  </div>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
