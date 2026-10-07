<?php include('header.php');
/*echo "<pre>";
print_r($school);
echo "<pre>";
exit;*/
?>
		<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>school/">Profile</a> <span class="divider">/</span>
					</li>
				</ul>
			</div>
			
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> School Profile Details</h2>
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
							  <h1><small>School  Information</small></h1>
							</div>
                            <div class="control-group">
								<label class="control-label" for="focusedInput">School Name :</label>
								<div class="controls">
								  <?php echo $school['school_name']; ?>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Affiliation Number :</label>
								<div class="controls">
								  <?php echo $school['affiliation_number']; ?>
								</div>
							  </div>
                               <div class="control-group">
								<label class="control-label" for="focusedInput">SchoolCode :</label>
								<div class="controls">
								  <?php echo $school['school_code']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">AccessCode :</label>
								<div class="controls">
								  <?php echo $school['access_code']; ?>
								</div>
							  </div>
                             
                            
							<div class="page-header">
							  <h1><small>Basic School  Information</small></h1>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Principal Name :</label>
								<div class="controls">
								  <?php echo $school['principal_titile'].$school['school_principal_name']; ?>
								</div>
                                </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Coordinator Name :</label>
								<div class="controls">
								  <?php echo $school['coordinator_titile'].$school['school_coordinator_name']; ?>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">School Board :</label>
								<div class="controls">
                                <?php echo $school['coordinator_titile'].$school['school_board']; ?>
	
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">School Medium :</label>
								<div class="controls">
								  <?php  echo $school['school_medium']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Concern Status :</label>
								<div class="controls">
								  <?php  echo $school['school_concern_status']; ?>
								</div>
							  </div>
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Created Date :</label>
								<div class="controls">
								  <?php  echo $school['school_created_date']; ?>
								</div>
							  </div>
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Status :</label>
								<div class="controls">
								  <?php  echo $school['school_status']; ?>
								</div>
							  </div>  	
                              
                              
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">SchoolAddress :</label>
								<div class="controls">
								<?php  echo $school['school_address'].$school['school_address1']; ?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">City :</label>
								<div class="controls">
								 <?php echo $school['school_city'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">State :</label>
								<div class="controls">
								 <?php echo $school['state_subdivision_name'];?>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country :</label>
								<div class="controls">
								<?php echo $school['country_code_char3'];?>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Pincode :</label>
								<div class="controls">
								<?php echo $school['school_pincode'];?>
								  
								</div>
							  </div>
							  
							
							   <div class="page-header">
								<h1><small>Geographic Information</small></h1>
							   </div>
						    <div class="control-group">
								<label class="control-label" for="focusedInput">Geo Location : </label>
								<div class="controls">
								 <?php echo $school['school_latitude'];?> ,<?php echo $school['school_longitude'];?>
								</div>
							  </div>
							
							 <div class="page-header">
									<h1><small>Contacts Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">School Email Id :</label>
								<div class="controls">
								 <?php echo $school['school_email'];?>
								</div>
							  </div>
							
                             <div class="control-group">
								<label class="control-label" for="focusedInput">STDcode :</label>
								<div class="controls">
								 <?php echo $school['school_stdcode'];?>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Phone Number :</label>
								<div class="controls">
								 <?php echo $school['school_phone'];?>
								</div>
							  </div>
                               <div class="control-group">
								<label class="control-label" for="focusedInput">CountryCode :</label>
								<div class="controls">
								 <?php echo $school['school_countrycode'];?>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Mobile Number :</label>
								<div class="controls">
								 <?php echo $school['school_mobile'];?>
								</div>
							  </div>
                            
                            
							<div class="control-group">
								<label class="control-label" for="focusedInput">Coordinator Email :</label>
								<div class="controls">
								 <?php  echo $school['school_coordinator_email'];?>
								</div>
							  </div>
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Coordinator Phone :</label>
								<div class="controls">
								 <?php echo $school['sh_coordinator_phone'];?>
								</div>
							  </div>
							  
                          <div class="form-actions">
								<button class="btn"><a href="<?php echo SITE_URL?>school/">Back</a></button>
				        </div>

							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
