<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">ADD COMPETITION CENTRE</a> <span class="divider">/</span>
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
						<h2><i class="icon-edit"></i> ADD COMPETITION CENTRE ></h2>
						
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
                                  <label class="control-label" for="event"> Center Address</label>
                                  <div class="controls">
                                    <textarea  id="center_address" name="center_address" rows="6"><?php if( isset( $result['center_address'] ) ) { echo $result['center_address']; } ?> </textarea>
                                    <span class="help-inline"><?php  $this->validation->show_error('center_address',"Please enter the communication address.") ?></span> 
                                   </div>
                               </div>    
                            
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
                                  <div class="controls">
                                   <input class="input-large focused" id="country" name="country" type="text" readonly="readonly" value="<?php echo $franchiseState['country_name'] ;?>" >
                                    <input class="input-large focused" id="country_id" name="country_id" type="hidden" value="<?php  echo $franchiseState['country_id'] ?>" >

							      </div>
							  </div>
							 <div class="control-group">
                                <label class="control-label" for="focusedInput">State/Province</label>
                                    <div class="controls">
                                     <input class="input-large focused" id="state" name="state" type="text" readonly="readonly" value="<?php echo $franchiseState['state_subdivision_name']; ?>" >
                                    <input class="input-large focused" id="state_id" name="state_id" type="hidden" value="<?php  echo $franchiseState['state_id'] ?>" >

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
            url:"<?php echo base_url();?>franchise/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#state_id").html(result);
        }});
    }); 
	
	
 </script>