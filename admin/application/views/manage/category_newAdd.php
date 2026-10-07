<?php include('header.php');
//echo "<pre>";print_r($result);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category/">Category</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#"><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?>
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Category <?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?></h2>
						
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
							  <h1><small><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add New";}?> Category</small></h1>
							</div>
                            
<!-- ==============================================================================================================================-->  
    
     
      <div class="control-group">
                <label class="control-label" for="focusedInput">Service</label>
                      <div class="controls">
                       <select class="span2" name="service_id" id="service_id">
									<option value="">Select</option>
									<?php foreach($services as $servicesval) { ?>
									<option value="<?php echo $servicesval['service_id'] ?>" <?php if( isset( $result['service_id'] ) ) if($result['service_id'] == $servicesval['service_id']) {  ?> selected="selected" <?php } ?> ><?php echo $servicesval['service_name'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('service_id',"Please select Service.") ?></span>
						</div> <!-- DIV FOR class="controls" -->
		</div><!-- DIV FOR class="control-group" -->
        
      
<!-- ==============================================================================================================================-->     
     
    <div class="control-group">
								<label class="control-label" for="focusedInput">CategoryKey</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="categoryKey" name="categoryKey" type="text" value="<?php if( isset( $result['categoryKey'] ) ) echo $result['categoryKey']; ?>" >
                          <span class="help-inline"><?php  $this->validation->show_error('categoryKey',"Please enter the categoryKey.") ?></span>									
								</div>
  </div> 
 <!-- ==============================================================================================================================-->      
 
 <div class="control-group">
								<label class="control-label" for="focusedInput">Category Description</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="categoryDesc" name="categoryDesc" type="text" value="<?php if( isset( $result['categoryDesc'] ) ) echo $result['categoryDesc']; ?>" >
                          <span class="help-inline"><?php  $this->validation->show_error('categoryDesc',"Please enter the categoryDesc.") ?></span>									
								</div>
  </div> 
 <!-- ==============================================================================================================================-->      
	
<?php if($mode=='View')
	  { ?>
			<div class="form-actions">
			     <a class="btn" href="<?php echo SITE_URL?>category_new/edit/id/<?php echo $result['category_id']?>"/>Edit</a>
			</div>
<?php } 
      else { ?>
					 <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
					</div>
	 <?php } ?>
</fieldset>
 </form>
</div>
</div><!--/span-->
</div><!--/row-->

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">

</script> 
<?php include('footer.php'); ?>