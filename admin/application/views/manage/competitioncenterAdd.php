<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">Category</a> <span class="divider">/</span>
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
						<h2><i class="icon-edit"></i> Category <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
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
							  <h1><small>Add Competitioncenter</small></h1>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Center name</label>
								<div class="controls">
								  <input class="input-large focused" id="center_name" name="center_name" type="text" value="<?php if( isset( $result['center_name'] ) ) { echo $result['center_name']; } ?>" >
							<span class="help-inline"><?php  $this->validation->show_error('center_name',"Please enter the center name.") ?></span>							
                     </div>
							  </div>      
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Franchise</label>
							<div class="controls">
								 <select class="span2" name="franchise_id" id="franchise_id">
									<option value="">Select</option>
									<?php foreach($franchise as $franchiseval) { ?>
									<option value="<?php echo $franchiseval['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $franchiseval['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $franchiseval['franchise_code'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('franchise_id',"Please enter the country.") ?></span>
								
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								 <select class="span2" name="country_id" id="country_id">
									<option value="">Select</option>
									<?php foreach($countries as $val) { ?>
									<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country_id'] ) ) if($result['country_id'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('country_id',"Please enter the country.") ?></span>
								
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">State/Province</label>
								<div class="controls">
								 <select class="span2" name="state_id" id="state_id" value="">
								 	<option value="">Select</option>
								<?php foreach($stateatload as $res)
                                { ?>
                              <option value="<?php echo $res['state_subdivision_id'] ?>" <?php if(isset($result['state_id'])) { if($result['state_id']==$res['state_subdivision_id']) { ?> selected="selected" <?php } } ?> ><?php echo $res['state_subdivision_name'] ?></option>;
							<?php  }
								   ?>
								  </select>
								   <span class="help-inline"><?php  $this->validation->show_error('state_id',"Please enter the state.") ?></span>
								</div>
							  </div>
                           <div class="control-group">
								<label class="control-label" for="focusedInput">Center Latitude</label>
								<div class="controls">
								  <input class="input-large focused" id="center_latitude" name="center_latitude" type="text" value="<?php if( isset( $result['center_latitude'] ) ) { echo $result['center_latitude']; } ?>" >
							<span class="help-inline"><?php  $this->validation->show_error('center_latitude',"Please enter the center Latitude.") ?></span>							
                     </div>
							  </div>  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Center Longitude</label>
								<div class="controls">
								  <input class="input-large focused" id="center_longitude" name="center_longitude" type="text" value="<?php if( isset( $result['center_longitude'] ) ) { echo $result['center_longitude']; } ?>" >
							<span class="help-inline"><?php  $this->validation->show_error('center_longitude',"Please enter the center Longitude.") ?></span>							
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
<script type="text/javascript">
       $("#country_id").change(function(){
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#state_id").html(result);
        }});
    }); 
	
	
 </script>