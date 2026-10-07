<?php include('header.php');

/*
echo $this->encrypt->encode('anitta', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('deepa', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('hima', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('chinju', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('reshma', ENC_KEY) ;echo "<br>";echo "<br>";
echo $this->encrypt->encode('ashima', ENC_KEY) ;echo "<br>";
*/
 ?>
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
						<?php echo $this->notifications->display_html();?> 
						<?php //print_r($result); ?>
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
								<label class="control-label" for="focusedInput">Franchise</label>
							<div class="controls">
								 <select class="span2" name="franchise_id" id="franchise_id">
									<option value="">Select</option>
									<?php foreach($franchise as $franchiseval) { ?>
									<option value="<?php echo $franchiseval['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $franchiseval['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $franchiseval['franchise_code'] ?></option>
									<?php } ?>
								 </select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('franchise_id',"Please enter the franchise.") ?></span>
								
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">School</label>
								<div class="controls">
								<select class="span2" name="school_id" id="school_id">
									<option value="">Select</option>
								   <?php foreach($school as $schoolval) { ?>	
									<option value="<?php echo $schoolval['school_id'] ?>" <?php  if( isset( $result['school_id'] ) ) if($result['school_id'] == $schoolval['school_id']) {  ?> selected="selected" <?php } ?> ><?php echo $schoolval['school_name'] ?></option>
								   <?php } ?>
			     				</select>
			     						 <span class="help-inline"><?php  $this->validation->show_error('school_id',"Please enter the school.") ?></span>
								</div>
							  </div>
							
							  
							 	  <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
							<div class="controls">
								 <select class="span2" name="student_title" id="student_title">
									<option value="">Select</option>
                           <option value="Mr" <?php if( isset( $result['student_title'] ) ) if($result['student_title']=='Mr') {  ?> selected="selected" <?php } ?>>Mr</option>
                           <option value="Ms" <?php if( isset( $result['student_title'] ) ) if($result['student_title']=='Ms') {  ?> selected="selected" <?php } ?>>Ms</option>
									</select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('student_title',"Please select") ?></span>
								
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="first_name" name="first_name" type="text" value="<?php if( isset( $result['first_name'] ) )echo $result['first_name']; ?>" >
								 <span class="help-inline"><?php  $this->validation->show_error('first_name',"Please enter the First Name.") ?></span>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Middle Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="middle_name" name="middle_name" type="text" value="<?php if( isset( $result['middle_name'] ) )echo $result['middle_name']; ?>" >
										 <span class="help-inline"><?php  $this->validation->show_error('middle_name',"Please enter the middle name.") ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="last_name" name="last_name" type="text" value="<?php if( isset( $result['last_name'] ) )echo $result['last_name']; ?>" >
 <span class="help-inline"><?php  $this->validation->show_error('last_name',"Please enter the last name.") ?></span>								
								</div>
							  </div>
							  <div class="control-group">
							  <label class="control-label" for="date01">Date of Birth</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="dob" name="dob" value="<?php if( isset( $result['dob'] ) ) echo $result['dob']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('dob',"Please enter the Date of Birth.") ?></span>							 
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
										 <span class="help-inline"><?php  $this->validation->show_error('gender',"Please enter the gender.") ?></span>
								</div>
							  </div>
							   
							 <div class="control-group">
								<label class="control-label">Student Photo</label>
								<div class="controls">
								  <div class="uploader" id="uniform-undefined"><input type="file" name="photo" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose Image</span></div>
									<div><?php if(isset($studentID) && $studentID != "a"){ ?><img src="<?php echo BASE_URL.$result['photo']; ?>" width="50" height="60"/><?php } ?></div>
		 <span class="help-inline"><?php  $this->validation->show_error('photo',"Choose  photo.") ?></span>								
								</div>
							  </div>
							  	 <!-- <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
							<div class="controls">
								 <select class="span2" name="father_title" id="father_title">
									<option value="">Select</option>
                           <option value="Mr" <?php /*if( isset( $result['father_title'] ) ) if($result['father_title']=='Mr') {  ?> selected="selected" <?php } ?>>Mr</option>
                           <option value="Ms" <?php if( isset( $result['father_title'] ) ) if($result['father_title']=='Ms') {  ?> selected="selected" <?php } ?>>Ms</option>
									</select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('father_title',"Please select") */?></span>
								
								</div>
							  </div>-->
							  
                     <div class="control-group">
								<label class="control-label" for="focusedInput">Father First Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_name" name="father_name" type="text" value="<?php if( isset( $result['father_name'] ) )echo $result['father_name']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_name',"Please enter the father_name.") ?></span>								
								</div>
							  </div>
<div class="control-group">
								<label class="control-label" for="focusedInput">Second Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_name1" name="father_name1" type="text" value="<?php if( isset( $result['father_name1'] ) )echo $result['father_name1']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_name1',"Please enter the father_name.") ?></span>								
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_name2" name="father_name2" type="text" value="<?php if( isset( $result['father_name2'] ) )echo $result['father_name2']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_name2',"Please enter the father_name.") ?></span>								
								</div>
							  </div>

							  			  <div class="control-group">
								<label class="control-label" for="focusedInput">country code</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_p_code" name="father_p_code" type="text" value="91" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_p_code',"Please enter the phone code.") ?></span>								
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">father Mobile</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_phone" name="father_phone" type="text" value="<?php if( isset( $result['father_phone'] ) )echo $result['father_phone']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_phone',"Please enter the mobile.") ?></span>								
								</div>
							  </div>
							  			  <div class="control-group">
								<label class="control-label" for="focusedInput">father Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_email" name="father_email" type="text" value="<?php if( isset( $result['father_email'] ) )echo $result['father_email']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_email',"Please enter the Email.") ?></span>								
								</div>
							  </div>
							  		  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">father Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="father_email1" name="father_email1" type="text" value="<?php if( isset( $result['father_email1'] ) )echo $result['father_email1']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('father_email1'," father Email does not match.") ?></span>								
								</div>
							  </div>-->
							      <div class="control-group">
								<label class="control-label" for="focusedInput">Father IDProof</label>
								<div class="controls">
								 <select class="span2" name="parent_id_proof" name="parent_id_proof">
									<option value="">Select</option>
									<option value="Election id card"<?php if( isset( $result['parent_id_proof'] ) ) if($result['parent_id_proof']=='Election id card') {  ?> selected="selected" <?php } ?> >Election id card</option>
									<option value="Driving licence" <?php if( isset( $result['parent_id_proof'] ) ) if($result['parent_id_proof']=='Driving licence') {  ?> selected="selected" <?php } ?> >Driving licence</option>
									<option value="Pan card" <?php if( isset( $result['parent_id_proof'] ) ) if($result['parent_id_proof']=='Pan card') {  ?> selected="selected" <?php } ?> >Pan card</option>
									<option value="Passport" <?php if( isset( $result['parent_id_proof'] ) ) if($result['parent_id_proof']=='Passport') {  ?> selected="selected" <?php } ?> >Passport</option>

								  </select>
								  		 <span class="help-inline"><?php  $this->validation->show_error('parent_id_proof',"Please select the id proof.") ?></span>
								</div>
							   </div>
 <div class="control-group">
								<label class="control-label" for="focusedInput">ID Proof Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="parent_id_proof_no" name="parent_id_proof_no" type="text" value="<?php if( isset( $result['parent_id_proof_no'] ) )echo $result['parent_id_proof_no']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('parent_id_proof_no',"Please enter the id proof no.") ?></span>								</div>
								
							  </div>
							  <!-- <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
							<div class="controls">
								 <select class="span2" name="mother_title" id="mother_title">
									<option value="">Select</option>
                           <option value="Mr" <?php if( isset( $result['mother_title'] ) ) if($result['mother_title']=='Mr') {  ?> selected="selected" <?php } ?>>Mr</option>
                           <option value="Ms" <?php if( isset( $result['mother_title'] ) ) if($result['mother_title']=='Ms') {  ?> selected="selected" <?php } ?>>Ms</option>
									</select>
								 		 <span class="help-inline"><?php  $this->validation->show_error('mother_title',"Please select") ?></span>
								
								</div>
							  </div>-->
 <div class="control-group">
								<label class="control-label" for="focusedInput">Mother First Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_name" name="mother_name" type="text" value="<?php if( isset( $result['mother_name'] ) )echo $result['mother_name']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_name',"Please enter the mother name.") ?></span>								
								</div>
							  </div>
 <div class="control-group">
								<label class="control-label" for="focusedInput">Midile Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_name1" name="mother_name1" type="text" value="<?php if( isset( $result['mother_name1'] ) )echo $result['mother_name1']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_name1',"Please enter the mother name.") ?></span>								
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_name2" name="mother_name2" type="text" value="<?php if( isset( $result['mother_name2'] ) )echo $result['mother_name2']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_name2',"Please enter the mother name.") ?></span>								
								</div>
							  </div>
							  	 
							   <div class="control-group">
								<label class="control-label" for="focusedInput">country code</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_p_code" name="mother_p_code" type="text" value="91" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_p_code',"Please enter the phone code.") ?></span>								
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother Mobile</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_phone" name="mother_phone" type="text" value="<?php if( isset( $result['mother_phone'] ) )echo $result['mother_phone']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_phone',"Please enter the mobile.") ?></span>								
								</div>
							  </div>
							  			  <div class="control-group">
								<label class="control-label" for="focusedInput">Mother Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_email" name="mother_email" type="text" value="<?php if( isset( $result['mother_email'] ) )echo $result['mother_email']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_email',"Please enter the Email.") ?></span>								
								</div>
							  </div>
							 <!-- <div class="control-group">
								<label class="control-label" for="focusedInput">conform Email</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_email1" name="mother_email1" type="text" value="<?php if( isset( $result['mother_emaill1'] ) )echo $result['mother_email1']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_email1',"Email does not match.") ?></span>								
								</div>
							  </div>-->
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Mother IDProof</label>
								<div class="controls">
								 <select class="span2" name="mother_id_proof" name="mother_id_proof">
									<option value="">Select</option>
									<option value="Election id card"<?php  if( isset( $result['mother_id_proof'] ) ) if($result['mother_id_proof']=='Election id card') {  ?> selected="selected" <?php } ?> >Election id card</option>
									<option value="Driving licence" <?php if( isset( $result['mother_id_proof'] ) ) if($result['mother_id_proof']=='Driving licence') {  ?> selected="selected" <?php } ?> >Driving licence</option>
									<option value="Pan card" <?php if( isset( $result['mother_id_proof'] ) ) if($result['mother_id_proof']=='Pan card') {  ?> selected="selected" <?php } ?> >Pan card</option>
									<option value="Passport" <?php if( isset( $result['mother_id_proof'] ) ) if($result['mother_id_proof']=='Passport') {  ?> selected="selected" <?php } ?> >Passport</option>
								  </select>
								  		 <span class="help-inline"><?php  $this->validation->show_error('mother_id_proof',"Please select the id proof.") ?></span>
								</div>
							   </div>
 <div class="control-group">
								<label class="control-label" for="focusedInput">ID Proof Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="mother_id_proof_no" name="mother_id_proof_no" type="text" value="<?php if( isset( $result['mother_id_proof_no'] ) )echo $result['mother_id_proof_no']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('mother_id_proof_no',"Please enter the id proof no.") ?></span>								</div>
								
							  </div>
							  
                    <!--  <div class="control-group">
							  <label class="control-label" for="event"> communication Address</label>
							  <div class="controls">
								<textarea  id="communication_address" name="communication_address" rows="6"><?php if( isset( $result['communication_address'] ) ) { echo $result['communication_address']; } ?> </textarea>
								<span class="help-inline"><?php  $this->validation->show_error('communication_address',"Please enter the communication address.") ?></span>
		 <span class="help-inline"><?php  $this->validation->show_error('communication_address',"Please enter the communication address.") ?></span>							  </div>
							  
							</div>-->
							  
 <div class="control-group">
							  <label class="control-label" for="event"> communication Address1</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="communication_address" name="communication_address" type="text" value="<?php if( isset( $result['communication_address'] ) )echo $result['communication_address']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('communication_address',"Please enter the communication address.") ?></span>
						  
							</div>
								</div>
							 <div class="control-group">
							  <label class="control-label" for="event"> communication Address2</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="communication_address1" name="communication_address1" type="text" value="<?php if( isset( $result['communication_address1'] ) )echo $result['communication_address1']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('communication_address1',"Please enter the communication address.") ?></span>
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
								 <select class="span2" name="stateID" id="stateID" value="">
								 	<option value="">Select</option>
								<?php foreach($stateatload as $res)
                                { ?>
                              <option value="<?php echo $res['state_subdivision_id'] ?>"<?php  if(isset($result['stateID'])) { if($result['stateID']==$res['state_subdivision_id']) { ?> selected="selected" <?php } } ?> ><?php echo $res['state_subdivision_name'] ?></option>;
							<?php  }
								   ?>
								  </select>
								</div>
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="event"> City</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="communication_address2" name="communication_address2" type="text" value="<?php if( isset( $result['communication_address2'] ) )echo $result['communication_address2']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('communication_address2',"Please enter the city.") ?></span>
				  
							</div>
	</div>
                       <div class="control-group">
								<label class="control-label" for="focusedInput">communication Pin</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="ca_pincode" name="ca_pincode" type="text" value="<?php if( isset( $result['ca_pincode'] ) )echo $result['ca_pincode']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('ca_pincode',"Please enter the communication Pin.") ?></span>								</div>
								
							  </div>
							    <div class="control-group">
							  <label class="control-label" for="event"> Permenet address1</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="permenet_address" name="permenet_address" type="text" value="<?php if( isset( $result['permenet_address'] ) )echo $result['permenet_address']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('permenet_address',"Please enter the permenet address.") ?></span>
				  
							</div>
	</div>
	  <div class="control-group">
							  <label class="control-label" for="event"> permenet address2</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="permenet_address1" name="permenet_address1" type="text" value="<?php if( isset( $result['permenet_address1'] ) )echo $result['permenet_address1']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('permenet_address1',"Please enter the permenet address1.") ?></span>
				  
							</div>
	</div>
	 <div class="control-group">
							  <label class="control-label" for="event"> City</label>
							  <div class="controls">
			  <input class="input-xlarge focused" id="permenet_address2" name="permenet_address2" type="text" value="<?php if( isset( $result['permenet_address2'] ) )echo $result['permenet_address2']; ?>" >
			
								<span class="help-inline"><?php  $this->validation->show_error('permenet_address2',"Please enter the city.") ?></span>
				  
							</div>
	</div>
							  <!--<div class="control-group">
							  <label class="control-label" for="event">Permanent Address</label>
							  <div class="controls">
								<textarea  id="permenet_address" name="permenet_address" rows="6"><?php if( isset( $result['permenet_address'] ) ) { echo $result['permenet_address']; } ?> </textarea>
								<span class="help-inline"><?php  $this->validation->show_error('communication_address',"Please enter the permenet address.") ?></span>
		 <span class="help-inline"><?php  $this->validation->show_error('permenet_address',"Please enter the permenet address.") ?></span>							  </div>
							  
							</div>-->
							  

                       <div class="control-group">
								<label class="control-label" for="focusedInput">Permanent Pin</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="pa_pincode" name="pa_pincode" type="text" value="<?php if( isset( $result['pa_pincode'] ) )echo $result['pa_pincode']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('pa_pincode',"Please enter the Permanent Pin.") ?></span>								</div>
								
							  </div>
							     <div class="control-group">
								<label class="control-label" for="focusedInput">Std code</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="std_code" name="std_code" type="text" value="<?php if( isset( $result['std_code'] ) )echo $result['std_code']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('std_code',"Please enter the std code.") ?></span>								</div>
								
							  </div>
							     <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="phone" name="phone" type="text" value="<?php if( isset( $result['phone'] ) )echo $result['phone']; ?>" >
		 <span class="help-inline"><?php  $this->validation->show_error('phone',"Please enter the phone.") ?></span>								</div>
								
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit" >
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
			

<?php include('footer.php'); ?>

<script type="text/javascript">
       $("#country_id").change(function(){
       	
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	
	
 </script>