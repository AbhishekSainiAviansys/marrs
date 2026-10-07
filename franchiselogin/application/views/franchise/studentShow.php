<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
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
							  <h1><small>Basic Information</small></h1>
							</div>
							  <div style="display:inline;float:right;padding-right:20px;"><img src="<?php echo BASE_URL.$list['photo']; ?>" width="50" height="60"/></div>	
							  <div class="control-group">
								<label class="control-label" for="focusedInput">First Name</label>
								<div class="controls">
								  <label><?php echo $list['firstName'] ?></label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Last Name</label>
								<div class="controls">
								  <label><?php echo $list['lastName'] ?></label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Gender</label>
								<div class="controls">
								  <label><?php echo $list['gender'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="date01">Date of Birth</label>
							  <div class="controls">
								<label><?php echo date("F d, Y",strtotime($list['dateOfBirth'])); ?></label>
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								  <label><?php echo $list['phone'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Mobile</label>
								<div class="controls">
								  <label><?php echo $list['mobile'] ?></label>
								</div>
							  </div>
							    <div class="control-group">
								<label class="control-label" for="focusedInput">Email </label>
								<div class="controls">
								  <label><?php echo $list['emailID'] ?></label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Blood Group</label>
								<div class="controls">
								<label><?php echo $list['bloodGroup'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Zip Code</label>
								<div class="controls">
								  <label><?php echo $list['zipCode'] ?></label>
								</div>
							  </div>
							  
								<div class="page-header">
									<h1><small>Academic Information</small></h1>
								</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Admission Year</label>
								<div class="controls">
								<label><?php echo $list['admissionYear'] ?></label>
								</div>
							  </div>
							
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Course</label>
								<div class="controls">
								<label><?php echo $list['courseID'] ?></label>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Class</label>
								<div class="controls">
								<label><?php echo $list['classID'] ?></label>
								</div>
							  </div>
							  
							  
							   <div class="page-header">
									<h1><small>Address Information</small></h1>
							</div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address 1</label>
								<div class="controls">
								  <label><?php echo $list['address1'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Address 2</label>
								<div class="controls">
								 <label><?php echo $list['address2'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">City</label>
								<div class="controls">
								 <label><?php echo $list['city'] ?></label>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Country</label>
								<div class="controls">
								<label><?php echo $country[0]['country_name'] ?></label>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">State/Province</label>
								<div class="controls">
								 <label><?php echo $state['state_subdivision_name'] ?></label>
								</div>
							  </div>
							  
							    <div class="page-header">
							  <h1><small>Guardian Information</small></h1>
							</div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Guardian Type</label>
								<div class="controls">
								 <label><?php echo $list['guardianTypeID'] ?></label>
								</div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Guardian Name</label>
								<div class="controls">
								  <label><?php echo $list['guardianName'] ?></label>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Occupation</label>
								<div class="controls">
								 <label><?php echo $list['guardianOccupation'] ?></label>
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Qualification</label>
								<div class="controls">
								  <label><?php echo $list['guardianQualification'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">EmailID</label>
								<div class="controls">
								  <label><?php echo $list['guardianEmailID'] ?></label>
								</div>
							  </div>
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Phone</label>
								<div class="controls">
								  <label><?php echo $list['guardianPhone'] ?></label>
								</div>
							  </div>
							
							
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Annual Income</label>
								<div class="controls">
								  <label><?php echo $list['annualIncome'] ?></label>
								</div>
							  </div>
							 
							 <div class="page-header">
							  <h1><small>More Information</small></h1>
							</div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Area of Interest</label>
								<div class="controls">
								  <label><?php echo $list['areaOfInterest'] ?></label>
								</div>
							  </div>
							 
							<hr>
							<div class="control-group">
								<label class="control-label" for="focusedInput"> Send daily clafified mails</label>
								<div class="controls">
								  <label class="checkbox inline">
								  <label><?php echo $list['subscribed'] ?></label>
								</label>
								
								</div>
							  </div>		
						<div class="control-group">
								<label class="control-label" for="focusedInput"> I wish to link with Career Entrance Premium Policy</label>
								<div class="controls">
								  <label class="checkbox inline">
								  <label><?php echo $list['linkWithAds'] ?></label> 
								</label>
								
								</div>
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
            url:BASE_URL+"wb-institute/student/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
 </script>
<?php include('footer.php'); ?>
