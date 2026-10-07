<?php include('header.php');

$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
echo $result['product_id'];
echo $result['competition_schedule_id'];
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">Category</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo 'edit';?>/"></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 

			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo 'Edit';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST">
							<fieldset>
							<div class="page-header">
							  <h1><small>Add Competition Schudle</small></h1>
							</div>
							  
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Period</label>
							<div class="controls">
								 <select class="span2" name="period_id" id="period_id">
									<option value="">Select</option>
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>
								
								</div>
							  </div>
							  
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
							<div class="controls">
								 <select class="span2" name="country" id="country">
									
								    <option value="105">India</option> 
								 </select>
								 
								</div>
							  </div>
							  
							   
                             <div class="control-group">
							
								<label class="control-label" for="focusedInput">State</label>
							<div class="controls">
								 <select class="span2" name="state_id" id="state_id">
									<option value="">Select</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['state_subdivision_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
								
								</div>
							  </div> 
							  
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Franchise Id</label>
								<div class="controls">
								 <select class="span2" name="franchise_id" id="franchise_id">
									<?php foreach($franchise as $val) { ?>
            									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'] ?></option>
            									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
								
								</div>
							  </div>
							  
							  
							  
							  
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Product</label>
								<div class="controls">
								 <select class="span2" name="product_name" id="product_name">
									<option value="">Select</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_id'] ) ) if($result['product_id'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								 </select> 
								 	
								</div>
							  </div>
							  
							  
							  
							  
							  
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Level</label>
								<div class="controls">
								 <select class="span2" name="competition_level_id" id="competition_level_id">
									<option value="">Select</option>
									<?php foreach($level as $val) { ?>
            									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
            									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
								
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">category</label>
								<div class="controls">
								    <select class="span2" name="category_id" id="category_id">
								<?php 
								
								foreach($category as $res)
                                { ?>
                              
									<option value="<?php echo $res['class_name']; ?>" <?php if( isset( $result['category_id'] ) ) if($result['category_id'] == $res['class_name']) {  ?> selected="selected" <?php } ?> ><?php echo $res['class_name'] ?></option>
								
								<?php } ?> 
								 </select>
								 
								</div>  
							  </div>
                           
						    <div class="control-group">
							  <label class="control-label" for="date01">Competition Caption</label>
							  <div class="controls">
								<input type="text" class="input-large datepicker" id="competition_caption" name="competition_caption" value="<?php if( isset( $result['competition_caption'] ) ) echo $result['competition_caption']; ?>" >
							
												  
							  </div>
							</div> 
						   
						   
							    <div class="control-group">
							  <label class="control-label" for="date01">Competition Date</label>
							  <div class="controls">
							      <input type="date" id="competition_date" name="competition_date" value='<?php echo $date; ?>'>
								<!--<input type="date" id="competition_date" name="competition_date" value="<?php echo $result['competition_date']; ?>">				  -->
							  </div>
							</div>   
							<div class="control-group">
								<label class="control-label" for="focusedInput">Center Address*
</label>
								<div class="controls">
								  <input class="input-large focused" id="reporting_time" name="center_address" type="text" value="<?php if( isset( $result['center_address'] ) ) { echo $result['center_address']; } ?>" placeholder='Type center exact as school'>
													
                                </div>
							  </div>                							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
								<button class="btn">Cancel</button>
							  </div>
						
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
       $("#state_id").change(function(){
        var state_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getStateFranchise/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
                 $("#franchise_id").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
	
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(product_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/class_category/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#category_id").html(result);
        }});
    }); 
	
	
	
 </script>