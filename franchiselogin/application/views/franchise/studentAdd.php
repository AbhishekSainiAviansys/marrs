<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Student <?php echo ($studentID>0)?'Edit':'Add';?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
							<div class="page-header">
							  <h1><small>Basic Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="firstName" name="firstName" type="text" value="<?php if( isset( $result['firstName'] ) )echo $result['firstName']; ?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="lastName" name="lastName" type="text" value="<?php if( isset( $result['lastName'] ) )echo $result['lastName']; ?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Student Photo</label>
								<div class="controls">
								  <div class="uploader" id="uniform-undefined"><input type="file" name="photo" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose Image</span></div>
									<div><?php if(isset($studentID) && $studentID != "a"){ ?><img src="<?php echo BASE_URL.$result['photo']; ?>" width="50" height="60"/><?php } ?></div
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Gender</label>
								<div class="controls">
								<label class="checkbox inline">
								  <input type="radio" id="gender" name="gender"  checked="checked" value="Male" <?php if( isset( $result['gender'] ) ) if($result['gender']=='Male') {  ?> checked="checked" <?php } ?> > Male
								</label>
								<label class="checkbox inline">
								  <input type="radio" id="gender" name="gender" value="Female" <?php if( isset( $result['gender'] ) ) if($result['gender']=='Female') {  ?> checked="checked" <?php } ?> > Female
								</label>
								</div>
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="date01">Date of Birth</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" name="dateOfBirth" value="<?php if( isset( $result['dateOfBirth'] ) ) echo $result['dateOfBirth']; ?>" >
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								  <input class="input-large focused" id="phone" name="phone" type="text" value="<?php if( isset( $result['phone'] ) ) echo $result['phone']; ?>" >
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Mobile</label>
								<div class="controls">
								  <input class="input-large focused" id="mobile" name="mobile" type="text" value="<?php if( isset( $result['mobile'] ) ) echo $result['mobile']; ?>" >
								</div>
							  </div>
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Email </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="emailID" name="emailID" type="text" value="<?php if( isset( $result['emailID'] ) )echo $result['emailID']; ?>">
								</div>
							  </div>
							  <?php if(!$studentID>0) {?>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Password </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="password" name="password" type="password" >
								</div>
							  </div>
							  <?php } ?>
							  <?php if(!$studentID>0) {?>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Re-type Password </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="repassword" name="repassword" type="password" >
								</div>
							  </div>
							  <?php } ?>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Blood Group</label>
								<div class="controls">
								 <select class="span2" name="bloodGroup">
									<option value="">Select</option>
									<option value="A+" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='A+') {  ?> selected="selected" <?php } ?> >A +</option>
									<option value="B+" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='B+') {  ?> selected="selected" <?php } ?> >B +</option>
									<option value="O+" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='O+') {  ?> selected="selected" <?php } ?> >O +</option>
									<option value="AB+" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='AB+') {  ?> selected="selected" <?php } ?> >AB +</option>
									<option value="AB-" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='AB-') {  ?> selected="selected" <?php } ?> >AB -</option>
									<option value="O-" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='O-') {  ?> selected="selected" <?php } ?> >O -</option>
									<option value="B-" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='B-') {  ?> selected="selected" <?php } ?> >B -</option>
									<option value="A-" <?php if( isset( $result['bloodGroup'] ) ) if($result['bloodGroup']=='A-') {  ?> selected="selected" <?php } ?> >A -</option>
									
								  </select>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Zip Code</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="zipCode" name="zipCode" type="text" value="<?php if( isset( $result['zipCode'] ) )echo $result['zipCode']; ?>" >
								</div>
							  </div>
							  
								<div class="page-header">
									<h1><small>Academic Information</small></h1>
								</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Admission Year</label>
								<div class="controls">
								 <select class="span2" name="admissionYear">
									<option value="">Select</option>
									<?php for($i=1970;$i<2013;$i++) { ?>
									<option value="<?php echo $i; ?>" <?php if( isset( $result['admissionYear'] ) ) if( $result['admissionYear'] == $i ) {  ?> selected="selected" <?php } ?> ><?php echo $i; ?></option>
									<?php } ?>
								  </select>
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Course</label>
								<div class="controls">
								<select class="span2" name="courseID" id="courseID">
									<option value="">Select</option>
								   <?php foreach($course as $courseval) { ?>	
									<option value="<?php echo $courseval['courseID'] ?>" <?php if( isset( $result['courseID'] ) ) if($result['courseID'] == $courseval['courseID']) {  ?> selected="selected" <?php } ?> ><?php echo $courseval['courseName'] ?></option>
								   <?php } ?>
			     				</select>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Class</label>
								<div class="controls">
								 <select class="span2" name="classID" id="classID">
									<option value="">Select</option>
								   <?php foreach($class as $classval) { ?>	
									<option value="<?php echo $classval['classID'] ?>" <?php if( isset( $result['classID'] ) ) if($result['classID'] == $classval['classID']) {  ?> selected="selected" <?php } ?> ><?php echo $classval['class'] ?></option>
								   <?php } ?>	 
								 </select>
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							   </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address 1</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="address1" name="address1" type="text" value="<?php if( isset( $result['address1'] ) )echo $result['address1']; ?>" >
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address 2</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="address2" name="address2" type="text" value="<?php if( isset( $result['address2'] ) )echo $result['address2']; ?>" >
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								  <input class="input-large focused" id="city" name="city" type="text" value="<?php if( isset( $result['city'] ) )echo $result['city']; ?>" >
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								 <select class="span2" name="countryID" id="countryID">
									<option value="">Select</option>
									<?php foreach($countries as $val) { ?>
									<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['countryID'] ) ) if($result['countryID'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
									<?php } ?>
								 </select>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">State/Province</label>
								<div class="controls">
								 <select class="span2" name="stateID" id="stateID" value="">
								<?php foreach($stateatload as $res)
                                { ?>
                              <option value="<?php echo $res['state_subdivision_id'] ?>" <?php if(isset($result['stateID'])) { if($result['stateID']==$res['state_subdivision_id']) { ?> selected="selected" <?php } } ?> ><?php echo $res['state_subdivision_name'] ?></option>;
							<?php  }
								   ?>
								  </select>
								</div>
							  </div>
							  
							    <div class="page-header">
							  <h1><small>Guardian Information</small></h1>
							</div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Guardian Type</label>
								<div class="controls">
								  <select class="span2" name="guardianTypeID" id="guardianTypeID">
								      <option value="">Select</option>
								     <?php foreach( $guardian as $val ) { ?> 
										<option value="<?php echo $val['guardianTypeID'] ?>" <?php if(isset($result['guardianTypeID'])) { if($result['guardianTypeID']==$val['guardianTypeID']) { ?> selected="selected" <?php } } ?> ><?php echo $val['guardianType'] ?></option>
									<?php } ?>
								  </select>
								</div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Guardian Name</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="guardianName" name="guardianName" type="text" value="<?php if( isset( $result['guardianName'] ) )echo $result['guardianName']; ?>" >
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Occupation</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="guardianOccupation" name="guardianOccupation" type="text" value="<?php if( isset( $result['guardianOccupation'] ) )echo $result['guardianOccupation']; ?>" >
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Qualification</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="guardianQualification" name="guardianQualification" type="text" value="<?php if( isset( $result['guardianQualification'] ) )echo $result['guardianQualification']; ?>" >
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">EmailID</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="guardianEmailID" name="guardianEmailID" type="text" value="<?php if( isset( $result['guardianEmailID'] ) )echo $result['guardianEmailID']; ?>" >
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="guardianPhone" name="guardianPhone" type="text" value="<?php if( isset( $result['guardianPhone'] ) )echo $result['guardianPhone']; ?>" >
								</div>
							  </div>
							
							
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Annual Income</label>
								<div class="controls">
								  <input class="input-large focused" id="annualIncome" name="annualIncome" type="text" value="<?php if( isset( $result['annualIncome'] ) )echo $result['annualIncome']; ?>" >
								</div>
							  </div>
							 
							 <div class="page-header">
							  <h1><small>More Information</small></h1>
							</div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Area of Interest</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="areaOfInterest" name="areaOfInterest" type="text" value="<?php if( isset( $result['areaOfInterest'] ) )echo $result['areaOfInterest']; ?>" >
								</div>
							  </div>
							 
							<hr>
							<div class="control-group">
								<label class="control-label" for="focusedInput"></label>
								<div class="controls">
								  <label class="checkbox inline">
								  <input type="checkbox" id="subscribed" name="subscribed"  checked="checked" value="Yes"> Send daily clafified mails
								  </label>
								
								</div>
							  </div>		
						<div class="control-group">
								<label class="control-label" for="focusedInput"></label>
								<div class="controls">
								  <label class="checkbox inline">
								  <input type="checkbox" id="linkWithAds" name="linkWithAds"  checked="checked" value="Yes"> I wish to link with Career Entrance Premium Policy 
								</label>
								
								</div>
							  </div>			

							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" name="submit"/>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">
 $("#countryID").change(function(){
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:BASE_URL+"wb-institute/students/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	
	$("#repassword").change(function(){
	    if( $(this).val() != $("#password").val() )
		{
		  alert("Password does not match");
		} 
    }); 
 </script>
<?php include('footer.php'); ?>
