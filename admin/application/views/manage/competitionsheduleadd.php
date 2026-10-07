<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>


			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="">Schedule</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="">ADD</a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 

			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal border rounded" method="POST">
						    <div class="container">
						        <div class="row">
							<div class="col-12 page-header">
							  <h1><small>Add Competition Schudle (only for school level)</small></h1>
							</div>
							  </div>
							  <div class="row">
                            <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Period</label>
							<div class="controls">
								 <select class="span2" name="period_id" id="period_id" required>
									<option value="">Select</option>
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>-->
								
								</div>
							  </div>
							  
							  
							  <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Country</label>
							<div class="controls">
								 <select class="span2" name="country" id="country" required>
									
								    <option value="105">India</option> 
								 </select>
								 
								</div>
							  </div>
							  
							   
                             <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
							
								<label class="control-label" for="focusedInput">State</label>
							<div class="controls">
								 <select class="span2" name="state_id" id="state_id" required>
									<option value="">Select</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['competition_centre_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
								
								</div>
							  </div> 
							  
							  
							   <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Franchise Id</label>
								<div class="controls">
								 <select class="span2" name="franchise_id" id="franchise_id" required>
									<?php foreach($franchise as $val) { ?>
            									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'] ?></option>
            									<?php } ?>
								 </select>
								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
								
								</div>
							  </div>
							  
							 <!-- <div class="control-group">-->
								<!--<label class="control-label" for="focusedInput">Area </label>-->
								<!--<div class="controls">-->
								<!-- <select class="span2" name="area_id" id="area_id">-->
								<!--	<?php foreach($area as $val) { ?>-->
								<!--	<option value="<?php echo $val['area_id'] ?>" <?php if( isset( $result['area_id'] ) ) if($result['area_id'] == $val['area_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['area_code'] ?></option>-->
								<!--	<?php } ?>-->
								<!-- </select>-->
								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
								
								<!--</div>-->
							 <!-- </div>-->
							  
							  
							  
							   <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Product</label>
								<div class="controls">
								 <select class="span2" name="product_name" id="product_name" required>
									<option value="">Select</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								 </select> 
								 	
								</div>
							  </div>
							  
							  
							  
							  
							  
							  
							   <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Level</label>
								<div class="controls">
								 <select class="span2" name="competition_level_id" id="competition_level_id" required>
									<option value="">Select</option>
									
								 </select>
								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
								
								</div>
							  </div>
							  
							 <!--<div class="control-group">-->
								<!--<label class="control-label" for="focusedInput">category</label>-->
								<!--<div class="controls">-->
								<?php 
								//foreach($category as $res){ 
                                ?>
                              <!--<input type="checkbox" id="all" name="category_id[]" value="<?php echo $res['class_name'];?>"> <?php echo $res['class_name'];?>-->
								<?php 
								//} 
								?> 
								 
								 
								<!--</div>  -->
							  <!--</div>-->
							  
							  <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Category</label>
								<div class="controls">
								    
								    <select id='category_id_' name='category_id' required>
								        
								    </select>
				
								 
								 
								</div>  
							  </div>
							  
        <!--                   <div class="control-group">-->
								<!--<label class="control-label" for="focusedInput">Area List</label>-->
        <!--        <div class="controls" id='area_id'>-->
                   
                  <!--<input type="checkbox" name="area[]" value="<?php //echo $result['area_id'] ?>" id='area_id'>   <?php //echo $result['area_code'].' => '.$result['area_name']; ?>-->
                   
                    
         <!--       </div>  -->
							  <!--</div>-->
                           
                           
                           
						    <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
							  <label class="control-label" for="date01">Competition Caption</label>
							  <div class="controls">
								<input type="text" class="input-large " id="competition_caption" name="competition_caption" value="<?php if( isset( $result['competition_caption'] ) ) echo $result['competition_caption']; ?>" >
							
												  
							  </div>
							</div> 
						   
						   
							    <div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
							  <label class="control-label" for="date01">Competition Date</label>
							  <div class="controls">
								<input type="date" id="competition_date" name="competition_date" value="<?php echo $date; ?>" required>				  
							  </div>
							</div>   
							<div class="control-group col-lg-3 col-md-6 col-sm-12 my-2">
								<label class="control-label" for="focusedInput">Center Address*
</label>
								<div class="controls">
								  <input class="input-large focused" id="reporting_time" name="center_address" type="text" value="<?php if( isset( $result['center_address'] ) ) { echo $result['center_address']; } ?>" placeholder='Type center exact as school' required>
													
                                </div>
							  </div> 
							  </div>
							  <div class="row">
							  <div class="form-actions my-2">
								<button type="submit" class="btn btn-success" id="submit" name="submit" >Submit</button>
								<button class="btn btn-danger">Cancel</button>
							  </div>
							  </div>
						</div>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
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
		$("#franchise_id").change(function(){
        var franchise_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
                 $("#area_id").html(result);
        }});
    }); 
    
    $("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/class_category/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#category_id_").html(result);
        }});
    }); 
    
 </script>