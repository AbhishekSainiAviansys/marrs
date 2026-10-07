<?php include('header.php');
//echo "eyerytrut";echo "<pre>";print_r($studentProfileDetailsPofileDetails);
?>
		<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>profile/">Profile</a>
                         <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>/show/">Show</a>
					</li>
				</ul>
			</div>


			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Student Profile Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
                            
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Period:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['period_name']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">CIN:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['cin']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Class:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['class_key']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->   
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Category:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['categoryKey']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->   
                           
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Name:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['first_name']." ".$studentProfileDetails['middle_name']." ".$studentProfileDetails['last_name']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Photo :</label>
                                <div class="controls">
								  <img src="<?php echo BASE_URL.$studentProfileDetails['photo']; ?>" alt="Student Photo"  height="70px" width="70px"/>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Date of Birth:</label>
                                
								<div class="controls">
									<?php  echo $studentProfileDetails['dob'];?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Gender:</label>
								<div class="controls">
								  <?php  echo $studentProfileDetails['gender']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">School:</label>
								<div class="controls">

								  <?php  echo $studentProfileDetails['school_address']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Father's Name:</label>
								<div class="controls">
								  <?php  echo $studentProfileDetails['father_name']." ".$studentProfileDetails['father_name1']." ".$studentProfileDetails['father_name2']; ?>
								</div>
							  </div>
 <!-- ........................................................................ --> 
 
 
 							  <div class="control-group">
								<label class="control-label" for="focusedInput">Father  Id Proof :</label>
								<div class="controls">
								  <?php  echo $studentProfileDetails['parent_id_proof']; ?>
								</div>
							  </div>
                              
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Father Id Proof Number:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['parent_id_proof_no']; ?>
								</div>
							  </div>
                              
  <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Father Mobile Number:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['father_phone']; ?>
								</div>
							  </div>
                                                         
  <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Father Email-Id:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['father_email']; ?>
								</div>
							  </div>
                                                   
                              
 <!-- ........................................................................ -->                             

							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother's Name:</label>
								<div class="controls">
								  <?php  echo $studentProfileDetails['mother_name']." ".$studentProfileDetails['mother_name1']." ".$studentProfileDetails['mother_name2']; ?>
								</div>
							  </div>
 
 
 <!-- ........................................................................ --> 
 
 
 							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother  Id Proof :</label>
								<div class="controls">
								  <?php  echo $studentProfileDetails['mother_id_proof']; ?>
								</div>
							  </div>
                              
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother Id Proof Number:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['mother_id_proof_no']; ?>
								</div>
							  </div>
                              
  <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother Mobile Number:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['mother_phone']; ?>
								</div>
							  </div>
                                                         
  <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother Email-Id:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['mother_email']; ?>
								</div>
							  </div>
                                                   
                              
 <!-- ........................................................................ -->   
 
                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Communication Address :</label>
								<div class="controls">
								 <?php echo $studentProfileDetails['communication_address'];?>
								</div>
							  </div>
                              
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Communication Address Pin Code:</label>
								<div class="controls">
								 <?php echo $studentProfileDetails['ca_pincode'];?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Permanent Address:</label>
								<div class="controls">
								 <?php echo $studentProfileDetails['permenet_address'];?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Permanent Address Pin Code:</label>
								<div class="controls">
								 <?php  echo $studentProfileDetails['pa_pincode'];?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Country:</label>
								<div class="controls">
								<?php  echo $studentProfileDetails['country_name']; ?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <div class="control-group">
								<label class="control-label" for="focusedInput">State:</label>
								<div class="controls">
									<?php echo $studentProfileDetails['state_subdivision_name'];?>
								</div>
							  </div>
<!-- ........................................................................ -->                             

                           <div class="control-group">
								<label class="control-label" for="focusedInput">STD Code:</label>
								<div class="controls">
								  <?php echo $studentProfileDetails['std_code'];?>
								</div>
							  </div>

 <!-- ........................................................................ -->                             
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone:</label>
								<div class="controls">
								 	<?php echo $studentProfileDetails['phone'];?>
								</div>
							  </div>
 <!-- ........................................................................ -->                             
							  <!--<div class="form-actions">
                              
								<a href="<?php //echo SITE_URL?>profile/edit/id/<?php //echo $studentProfileDetails_id ;?>" class="btn btn-large btn-primary">
                                	<i class="icon-chevron-left icon-white"></i> Edit Profile
                                </a>
						  </div>-->
 <!-- ........................................................................ -->                             
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
