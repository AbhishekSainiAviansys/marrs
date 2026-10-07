<?php include('header.php');?>
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
							  <h1><small>Personal Information</small></h1>
							</div>
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Name</label>
								<div class="controls">
								  <?php echo $franchise['emp_first_name']. $franchise['emp_middle_name'].$franchise['emp_last_name']; ?>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Deapartment</label>
								<div class="controls">
								  <?php echo $franchise['department_name']; ?>
								</div>
							  </div>
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Personal Address</label>
								<div class="controls">
								  <?php echo $franchise['emp_ca']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Personal Conatact Number</label>
								<div class="controls">
								  <?php echo $franchise['emp_phone']; ?>
								</div>
							  </div>
                              
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Personal Mobile Number</label>
								<div class="controls">
								  <?php echo $franchise['emp_mobile']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Personal Emailid</label>
								<div class="controls">
								  <?php echo $franchise['emp_personal_email']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Official Emailid</label>
								<div class="controls">
								  <?php echo $franchise['emp_official_email']; ?>
								</div>
							  </div>
                              
                            
							<div class="page-header">
							  <h1><small>Basic Franchise  Information</small></h1>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Service Name</label>
								<div class="controls">
								  <?php echo $franchise['service_name']; ?>
								</div>
                                </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Franchise Name</label>
								<div class="controls">
								  <?php echo $franchise['emp_first_name']. $franchise['emp_middle_name'].$franchise['emp_last_name']; ?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Franchise code</label>
								<div class="controls">
								  <?php echo $franchise['franchise_code']; ?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Franchise Type</label>
								<div class="controls">
                                
									<?php 
									           $fr_type='';
									                    switch($franchise['franchise_type']):
														case 'M': $fr_type="Main";break;
														case 'N':$fr_type="Sub";break;
														case 'S':$fr_type="Other";break;
														endswitch;
														echo  $fr_type;
									 ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Company Name</label>
								<div class="controls">
								  <?php  echo $franchise['company_name']; ?>
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Landmark</label>
								<div class="controls">
								<?php  echo $franchise['landmark']; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Company Address</label>
								<div class="controls">
								 <?php echo $franchise['company_address'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Place</label>
								<div class="controls">
								 <?php echo $franchise['place'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								<?php  echo $franchise['country_name']; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">State</label>
								<div class="controls">
								<?php echo $franchise['state_subdivision_name'];?>
								  
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Pincode</label>
								<div class="controls">
								 <?php echo $franchise['pincode'];?>
								</div>
							  </div>
							   <div class="page-header">
								<h1><small>Geographic Information</small></h1>
							</div>
								
								<!-- <div class="control-group">
								<label class="control-label" for="focusedInput">Map </label>
								<div class="controls">
								<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $result['latitude'];?>,<?php echo $result['longitude'];?>&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?php echo $result['latitude'];?>,<?php echo $result['longitude'];?>&sensor=false"/>
								</div>
							  </div>-->
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Province </label>
								<div class="controls">
								 <?php echo $franchise['province'];?>
								</div>
							  </div>
							  
						    <div class="control-group">
								<label class="control-label" for="focusedInput">Geo Location </label>
								<div class="controls">
								 <?php echo $franchise['latitude'];?> ,<?php echo $franchise['longitude'];?>
								</div>
							  </div>
							
							 <div class="page-header">
									<h1><small>Contacts Information</small></h1>
							</div>
							  
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Company PhoneNumber</label>
								<div class="controls">
								 <?php  echo $franchise['company_phno'];?>
								</div>
							  </div>
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Company MobileNumber</label>
								<div class="controls">
								 <?php echo $franchise['company_mobno'];?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Company EmailID</label>
								<div class="controls">
								 <?php echo $franchise['company_email_id'];?>
								</div>
							  </div>
							   <!--<div class="page-header">
									<h1><small>Login Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">User Name</label>
								<div class="controls">
								  <?php echo $result['userName'];?>
								</div>
							  </div>-->
							
							

							  <div class="form-actions">
								<a href="<?php echo SITE_URL?>profile/edit/id/<?php echo $franchise['franchise_id'];?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Edit Profile</a>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
