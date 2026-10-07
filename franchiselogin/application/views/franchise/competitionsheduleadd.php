<?php include('header.php'); /* print_r($result);*/ $result['competition_date']=''; ?>

<style>
.help-inline{
	color:#F00;
	
	}
</style>
			<div>
				<ul class="breadcrumb">
					<li>
						<a>Competition Schedule </a> <span class="divider">/</span>
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
						<h2><i class="icon-edit"></i> Competition Schedule  <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
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
							  <h1><small> Competition Schedule</small></h1>
							</div>
							  
                            <div class="control-group">
        						<label class="control-label" for="focusedInput">Competition Caption</label>
        						<div class="controls">
        					        <input class="input-large focused" id="competition_caption" name="competition_caption" type="text" value="<?php if( isset( $result['competition_caption'] ) ) { echo $result['competition_caption']; } ?>" >
        							<span class="help-inline"><?php  $this->validation->show_error('competition_caption',"Please enter the competition Cation .") ?></span>							
                                </div>
        					</div>       
                                   
                            <div class="control-group">
        						<label class="control-label" for="focusedInput">Center Address</label>
        						<div class="controls">
        					        <input class="input-large focused" id="center_address" name="center_address" type="text" value="<?php if( isset( $result['center_address'] ) ) { echo $result['center_address']; } ?>" >
        							<span class="help-inline"><?php  $this->validation->show_error('center_address',"Please enter the center address .") ?></span>							
                                </div>
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
							
								<label class="control-label" for="focusedInput">Product</label>
    							<div class="controls">
    								 <select class="span2" name="product" id="product">
    									<option value="">Select</option>
    									<?php foreach($product as $centerval) { ?>
    									<option value="<?php echo $centerval['product_id'] ?>" <?php if( isset( $result['product'] ) ) if($result['product'] == $centerval['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $centerval['product_name'] ?></option>
    									<?php } ?>
    								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
    								
    								</div>
							</div>   
							
							
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Level</label>
								<div class="controls">
								 <select class="span2" name="competition_level_id" id="competition_level_id">
									<option value="">Select</option>
									<?php foreach($level as $val) { ?>
									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
								
								</div>
							  </div>
							  
							 <!--<div class="control-group">-->
								<!--<label class="control-label" for="focusedInput">category</label>-->
								<!--<div class="controls">-->
								<!-- <select class="span2" name="category_id" id="category_id" value="">-->
								<!-- 	<option value="">Select</option>-->
								<?php //foreach($category as $res)
                                //{ ?>
                              <!--<option value="<?php echo $res['category_id'] ?>" <?php if(isset($result['category_id'])) { if($result['category_id']==$res['category_id']) { ?> selected="selected" <?php } } ?> ><?php echo $res['categoryKey']; ?></option>-->
							<?php // }
								   ?>
								<!--  </select>-->
								<!--   <span class="help-inline"><?php  $this->validation->show_error('category_id',"Please enter the Category.") ?></span>-->
								<!--</div>-->
							 <!-- </div>-->
							  
							
							<div class="control-group">
							  <label class="control-label" for="date01">Competition Date</label>
							  <div class="controls">
								<input type="text" class="input-large datepicker" id="competition_date" name="competition_date" value="<?php echo !empty($result['competition_date']) 
? date('d-m-Y', strtotime($result['competition_date'])) : ''; ?>"
 >
                                <br />
                                <span class="help-inline"><?php  $this->validation->show_error('competition_date',"Please enter the competition date.") ?></span>							
												  
							  </div>
							</div>   
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Reporting Time</label>
            								<div class="controls">
            								  <input class="input-large focused" id="reporting_time" name="reporting_time" type="text" value="<?php if( isset( $result['reporting_time'] ) ) { echo $result['reporting_time']; } ?>" >
            							<span class="help-inline"><?php  $this->validation->show_error('reporting_time',"Please enter the Reporting time.") ?></span>							
                                 </div>
							</div> 
                              
                    <div class="control-group">
						<label class="control-label" for="focusedInput">Competition Fee</label>
						<div class="controls">
					        <input class="input-large focused" id="competition_fee" name="competition_fee" type="text" value="<?php if( isset( $result['competition_fee'] ) ) { echo $result['competition_fee']; } ?>" >
							<span class="help-inline"><?php  $this->validation->show_error('competition_fee',"Please enter the competition fee .") ?></span>							
                        </div>
					</div> 
   
                              
                              
                              <!-- EDITED ON 18-10-2014  --> 
                    <div class="control-group">
						<label class="control-label" for="focusedInput">
                        Confirmation Status</label>
						<div class="controls"><?php //print_r($schedule_confirm_status);?>
						 <select class="span2" name="schedule_confirm_status" id="schedule_confirm_status" value="" required>
						 	<option value="">Select</option>
					
                            <option value="<?php echo 'Pending';?>"<?php if(isset($result['schedule_confirm_status'])) { if($result['schedule_confirm_status']== 'Pending') { ?> selected="selected" <?php } } ?> ><?php echo 'Pending'; ?></option>
							<option value="<?php echo 'Confirm';?>"<?php if(isset($result['schedule_confirm_status'])) { if($result['schedule_confirm_status']== 'Confirm') { ?> selected="selected" <?php } } ?> ><?php echo 'Confirm'; ?></option>
							<option value="<?php echo 'Postpond';?>"<?php if(isset($result['schedule_confirm_status'])) { if($result['schedule_confirm_status']== 'Postpond') { ?> selected="selected" <?php } } ?> ><?php echo 'Postpond'; ?></option>
							<option value="<?php echo 'Prepond';?>"<?php if(isset($result['schedule_confirm_status'])) { if($result['schedule_confirm_status']== 'Prepond') { ?> selected="selected" <?php } } ?> ><?php echo 'Prepond'; ?></option>
							
							
						</select><br />
						<span class="help-inline"><?php  $this->validation->show_error('schedule_confirm_status',"Please enter the Confirmation Status.") ?></span>							
                    </div>
							  </div>
                              <!-- EDITED ON 18-10-2014  --> 
                              
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
<script type="text/javascript">
    
    $("#country_id").change(function(){
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:"<?php echo base_url();?>franchise/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#state_id").html(result);
        }});
    }); 
    
    $("#product").change(function() {
        var product_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url:"<?php echo base_url();?>franchise/ajax/productwiselevel_schoollevel/",
            data: {product_id: product_id},
            type: 'post',
            success: function(result) {
                $("#competition_level_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    
    
    $("#product").change(function() {
        var product_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url:"<?php echo base_url();?>franchise/ajax/productwisecategory/",
            data: {product_id: product_id},
            type: 'post',
            success: function(result) {
                $("#category_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
	
	
	$(document).ready(function () {
	$('#reporting_time').timepicker({ 'timeFormat': 'H:i:s' });
});
 </script>
