<?php include('header.php'); ?>
		<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>profile/">Profile</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/show/">Show</a>
					</li>
				</ul>
			</div>
			
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Profile Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
							<div class="page-header">
							  <h1><small>Basic Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Institute Name</label>
								<div class="controls">
								  <?php echo $result['instituteName']; ?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Institute Type</label>
								<div class="controls">
									<?php  echo $result['instituteTypeNames'];?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Board/University</label>
								<div class="controls">
								  <?php  echo $result['instituteBoard']; ?>
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Location</label>
								<div class="controls">
								<?php  echo $result['location']; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address1</label>
								<div class="controls">
								 <?php echo $result['address1'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address2</label>
								<div class="controls">
								 <?php echo $result['address2'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								 <?php  echo $result['city'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								<?php  echo $result['country_name']; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">State</label>
								<div class="controls">
								<?php echo $result['state_subdivision_name'];?>
								  
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Zip/Pin</label>
								<div class="controls">
								 <?php echo $result['zipCode'];?>
								</div>
							  </div>
							
							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address For communication</label>
								<div class="controls">
								 <?php echo $result['addressForCommunication'];?>
								</div>
							  </div>
							  
							   <div class="page-header">
								<h1><small>Geographic Information</small></h1>
							</div>
								
								 <div class="control-group">
								<label class="control-label" for="focusedInput">Map </label>
								<div class="controls">
								<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $result['latitude'];?>,<?php echo $result['longitude'];?>&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?php echo $result['latitude'];?>,<?php echo $result['longitude'];?>&sensor=false"/>
								</div>
							  </div>
							  
						    <div class="control-group">
								<label class="control-label" for="focusedInput">Geo Location </label>
								<div class="controls">
								 <?php echo $result['latitude'];?> ,<?php echo $result['longitude'];?>
								</div>
							  </div>
							
							 <div class="page-header">
									<h1><small>Contacts Information</small></h1>
							</div>
							  
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Contact Person</label>
								<div class="controls">
								 <?php  echo $result['contactPerson'];?>
								</div>
							  </div>
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								 <?php echo $result['phone'];?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">EmailID</label>
								<div class="controls">
								 <?php echo $result['emailID'];?>
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Login Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">User Name</label>
								<div class="controls">
								  <?php echo $result['userName'];?>
								</div>
							  </div>
							
							

							  <div class="form-actions">
								<a href="<?php echo SITE_URL?>profile/edit/id/<?php echo $result['instituteID'];?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Edit Profile</a>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
