<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>profile/">Profile</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/edit/">Edit</a>
					</li>
				</ul>
			</div>
			
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Profile Edit</h2>
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
								  <input class="input-xxlarge focused" id="instituteName" name="instituteName" type="text"  value="<?php if(isset($result['instituteName'])) echo $result['instituteName']; ?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Institute Type</label>
								<div class="controls">
									<select multiple data-rel="chosen" name="instituteTypeID" id="instituteTypeID">
									<?php foreach($instituteytpe as $value) { ?>
				<option value="<?php echo $value['typeID'] ?>" <?php if(isset($institutetypes)) if(in_array($value['typeID'],$institutetypes)) { ?> selected="selected" <?php } ?> ><?php echo $value['typeName'] ?></option>
				<?php } ?>
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Board/University</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="instituteBoard" name="instituteBoard" type="text" value="<?php if(isset($result['instituteBoard'])) echo $result['instituteBoard']; ?>" >
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Location</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="location" name="location" type="text" value="<?php if(isset($result['location'])) echo $result['location']; ?>" >
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address1</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="address1" name="address1" type="text" value="<?php if(isset($result['address1'])) echo $result['address1']; ?>" >
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address2</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="address2" name="address2" type="text" value="<?php if(isset($result['address2'])) echo $result['address2']; ?>">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="city" name="city" type="text" value="<?php if(isset($result['city'])) echo $result['city']; ?>">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								<select class="span2" name="countryID" id="countryID">
									<option id=""></option> 
									<?php foreach($country as $value) { ?>
											<option <?php if(isset($result['country_id'])) { if($result['country_id']==$value['country_id']) { ?> selected="selected" <?php } } ?> value="<?php echo $value['country_id'] ?>"><?php echo $value['country_name'] ?></option>
									<?php } ?>	
								  </select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">State</label>
								<div class="controls">
								 <select class="span2" name="stateID" id="stateID">
									 <option id=""></option> 
									 <?php 
										
										foreach($stateatload as $res)
										{ ?>
											  <option value="<?php echo $res['state_subdivision_id'] ?>" <?php if(isset($result['state_subdivision_id'])) { if($result['state_subdivision_id']==$res['state_subdivision_id']) { ?> selected="selected" <?php } } ?> ><?php echo $res['state_subdivision_name'] ?></option>;
									<?php  
										}
									?>
								  </select>
								  
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Zip/Pin</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="zipCode" name="zipCode" type="text" value="<?php if(isset($result['zipCode'])) echo $result['zipCode']; ?>">
								</div>
							  </div>
							
							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Address For communication</label>
								<div class="controls">
								  <textarea rows="" cols=""  name="addressForCommunication" id="addressForCommunication"><?php if(isset($result['addressForCommunication'])) echo $result['addressForCommunication']; ?></textarea>
								</div>
							  </div>
							  
							   <div class="page-header">
								<h1><small>Geographic Information</small></h1>
							</div>
								
								 <div class="control-group">
								<label class="control-label" for="focusedInput">Map </label>
								<div class="controls">
								<?php if(isset($result['latitude']))  
								{?>
									<img src="http://maps.googleapis.com/maps/api/staticmap?zoom=13&size=600x300&maptype=roadmap
					&markers=color:blue%7Clabel:S%7C<?php echo $result['latitude'];?>,-<?php echo $result['longitude'];?>&sensor=false"/>
								<?php 
								}else{
								?>
									<img src="http://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
					&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&sensor=false"/>
								<?php 
								}
								?>
								</div>
							  </div>
							  
						    <div class="control-group">
								<label class="control-label" for="focusedInput">Geo Location </label>
								<div class="controls">
								  <input class="input-large focused" id="latitude" name="latitude" type="text"  value="<?php if(isset($result['latitude'])) echo $result['latitude']; ?>" >
								  <input class="input-large focused" id="longitude" name="longitude" type="text" value="<?php if(isset($result['longitude'])) echo $result['longitude']; ?>" >
								</div>
							  </div>
							
							 <div class="page-header">
									<h1><small>Contacts Information</small></h1>
							</div>
							  
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Contact Person</label>
								<div class="controls">
								   <input class="input-large focused" id="contactPerson" name="contactPerson" type="text" value="<?php if(isset($result['contactPerson'])) echo $result['contactPerson']; ?>" >
								</div>
							  </div>
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								   <input class="input-large focused" id="phone" name="phone" type="text" value="<?php if(isset($result['phone'])) echo $result['phone']; ?>">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">EmailID</label>
								<div class="controls">
								   <input class="input-large focused" id="emailID" name="emailID" type="text" value="<?php if(isset($result['emailID'])) echo $result['emailID']; ?>">
								</div>
							  </div>
							   <div class="page-header">
									<h1><small>Login Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">User Name</label>
								<div class="controls">
								   <input class="input-large focused" id="userName" name="userName" type="text" value="<?php if(isset($result['userName'])) echo $result['userName']; ?>">
								</div>
							  </div>
							
							<div class="control-group">
								<label class="control-label" for="focusedInput">Password</label>
								<div class="controls">
								   <input class="input-large focused" id="userName" name="userName" type="text" >
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Retype Password</label>
								<div class="controls">
								   <input class="input-large focused" id="confirmPassword" name="confirmPassword" type="text" >
								</div>
							  </div> 
							
							  
							 
							  
								

							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
