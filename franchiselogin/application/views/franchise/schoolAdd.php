<?php include('header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>student/">School</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="row-fluid sortable">
	<div class="box span12">
    
		<div class="box-header well" data-original-title>
			 <h2><i class="icon-edit"></i> School <?php echo ($studentID>0)?'Edit':'Add';?></h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
		</div>
	    <div class="box-content">
			<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
				  <fieldset>
                     <legend><span style="color:#F00; font-size:14px;">The fields maked '<b>*</b>' are  mandatory fiedls.</span></legend>
						<div class="page-header">  <h1><small>Basic Information</small></h1></div>
                      <!-----------------School Name------------------->       
                             <div class="control-group">
								  <label class="control-label" for="focusedInput">School Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								     <input class="input-xlarge focused" id="school_name" name="school_name" type="text" value="<?php if( isset( $result['school_name'] ) )echo $result['school_name']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('school_name',"Please enter the school name.") ?></span>							 					
								   </div>
							 </div>
                      <!-----------------Affiliation Number------------------->       
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Affiliation Number</label>
								 <div class="controls">
								      <input class="input-xlarge focused" id="affiliation_number" name="affiliation_number" type="text" value="<?php if( isset( $result['affiliation_number'] ) )echo $result['affiliation_number']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('affiliation_number',"Please enter the school affiliation number.") ?></span>							 				
								</div>
							</div>
                      <!------------------Address1------------------>       
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Address1
                                 <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                 </label>
								 <div class="controls">
								      <input class="input-xlarge focused" id="school_address" name="school_address" type="text" value="<?php if( isset( $result['school_address'] ) )echo $result['school_address']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address',"Please enter the school address1.") ?></span>						
								 </div>
							</div>
                      <!-----------------Address2------------------->       
                            
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Address2</label>
								 <div class="controls">
								      <input class="input-xlarge focused" id="school_address1" name="school_address1" type="text" value="<?php if( isset( $result['school_address1'] ) )echo $result['school_address1']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address1',"Please enter the school address2.") ?></span>						
								 </div>
							</div>
                      <!-----------------Country------------------->       
                           <div class="control-group">
								<label class="control-label" for="focusedInput">Country
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								     <select class="span2" name="country_id" id="country_id" >
									      <option value="">Select</option>
                                                                                  
									      <option value="<?php echo $franchiseState['country_id'] ?>" selected="selected" ><?php echo $franchiseState['country_name'] ?></option>
								     </select>
								 	<span class="help-inline"><?php  $this->validation->show_error('country_id',"Please enter the country.") ?></span>
								</div>
						   </div>
                    <!-----------------State/Province------------------->       
						   <div class="control-group">
								   <label class="control-label" for="focusedInput">State/Province
                                   <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                   </label>
								    <div class="controls">
								         <select class="span2" name="stateID" id="stateID" value="" >
								 		        <option value="">Select</option>
                                                <option value="<?php echo $franchiseState['state_subdivision_id'] ?>"  selected>
												<?php echo $franchiseState['state_subdivision_name'] ?></option>;
								         </select>
								     <span class="help-inline"><?php  $this->validation->show_error('state_subdivision_id',"Please enter the state.") ?></span>
								   </div>
							 </div>
                    <!-----------------Shool City ------------------->       
                              
                             <div class="control-group">
								  <label class="control-label" for="focusedInput">City
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								         <div class="controls">
								              <input class="input-xlarge focused" id="school_city" name="school_city" type="text" 
                                                     value="<?php if( isset( $result['school_city'] ) )echo $result['school_city']; ?>" >
                                               <span class="help-inline"><?php  $this->validation->show_error('school_city',"Please enter the school city.") ?></span>							 					
								        </div>
							 </div>
                    <!-----------------Pin Code ------------------->       
                     
                           <div class="control-group">
							    <label class="control-label" for="focusedInput">Pin Code
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								       <div class="controls">
								            <input class="input-xlarge focused" id="school_pincode" name="school_pincode" type="text" value="<?php if( isset( $result['school_pincode'] ) )echo $result['school_pincode']; ?>" >
                                            <span class="help-inline"><?php  $this->validation->show_error('school_pincode',"Please enter the school pincode.") ?></span>							 					
								       </div>
						   </div>
                    <!-----------------Principal Title------------------->       
							<div class="control-group">
								   <label class="control-label" for="focusedInput">Title</label>
							       <div class="controls">
								         <select class="span2" name="principal_titile" id="principal_titile">
									              <option value="">Select</option>
                                                  <option value="Mr" <?php if( isset( $result['principal_titile'] ) ) if($result['principal_titile']=='Mr') {  ?> selected="selected" <?php } ?>>Mr</option>
                                                  <option value="Ms" <?php if( isset( $result['principal_titile'] ) ) if($result['principal_titile']=='Ms') {  ?> selected="selected" <?php } ?>>Ms</option>
									     </select>
								         <span class="help-inline"><?php  $this->validation->show_error('principal_titile',"Please select") ?></span>
								  </div>
							</div>
                    <!-----------------Principal Name------------------->       
                            
						 <div class="control-group">
								  <label class="control-label" for="focusedInput">Principal Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								       <input class="input-xlarge focused" id="school_principal_name" name="school_principal_name" type="text" value="<?php if( isset( $result['school_principal_name'] ) )echo $result['school_principal_name']; ?>" >
                                       <span class="help-inline"><?php  $this->validation->show_error('school_principal_name',"Please enter the School Principal Name.") ?></span>							 					
								  </div>
						  </div>
                    <!-----------------Co-ordinator Title------------------->       
                          
                         <div class="control-group">
							   <label class="control-label" for="focusedInput">Title</label>
							   <div class="controls">
								     <select class="span2" name="coordinator_titile" id="coordinator_titile">
									        <option value="">Select</option>
                                            <option value="Mr" <?php if( isset( $result['coordinator_titile'] ) ) if($result['coordinator_titile']=='Mr') {  ?> selected="selected" <?php } ?>>Mr</option>
                                            <option value="Ms" <?php if( isset( $result['coordinator_titile'] ) ) if($result['coordinator_titile']=='Ms') {  ?> selected="selected" <?php } ?>>Ms</option>
									</select>
								 	<span class="help-inline"><?php  $this->validation->show_error('coordinator_titile',"Please select") ?></span>
							</div>
						 </div>
                         
                    <!-----------------Co-ordinator Name------------------->       
						 <div class="control-group">
							  <label class="control-label" for="focusedInput">Coordinator Name</label>
							<div class="controls">
								 <input class="input-xlarge focused" id="school_coordinator_name" name="school_coordinator_name" type="text" value="<?php if( isset( $result['school_coordinator_name'] ) )echo $result['school_coordinator_name']; ?>" >
                                 <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_name',"Please enter the school coordinator name.") ?></span>							 					
							</div>
						</div>
                    <!-----------------Co-ordinator Email------------------->       
                        
                        <div class="control-group">
							 <label class="control-label" for="focusedInput">Coordinator Email</label>
							 <div class="controls">
								  <input class="input-xlarge focused" id="school_coordinator_email" name="school_coordinator_email" type="text" value="<?php if( isset( $result['school_coordinator_email'] ) )echo $result['school_coordinator_email']; ?>" >
                                  <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_email',"Please enter the school coordinator email.") ?></span>							 				
							  </div>
					   </div>
                    <!-----------------Confirmation of EmailID------------------->       
                       
			           <?php  $mode;  if($mode=='Add') {  ?>
                       <div class="control-group">
							<label class="control-label" for="focusedInput">Confirm  Email</label>
								   <div class="controls">
								   		<input class="input-xlarge focused" id="school_coordinator_email1" name="school_coordinator_email1" type="text" value="<?php if( isset( $result['school_coordinator_email1'] ) )echo $result['school_coordinator_email1']; ?>" >
                                        <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_email1',"coordinator email does not match.") ?></span>							 				
							      </div>
					  </div>
		              <?php } ?>
                    <!-----------------Country Code------------------->       
                      
                      <div class="control-group">
						   <label class="control-label" for="focusedInput">Country Code</label>
							      <div class="controls">
								        <input class="input-xlarge focused" readonly="readonly" id="school_c_countrycode" name="school_c_countrycode" type="text" value="+91" >
								  </div>
					 </div>
                    
                    <!-----------------coordinator Phone------------------->       
                     <div class="control-group">
						  <label class="control-label" for="focusedInput">Co-ordinator Phone</label>
								 <div class="controls">
                                     <input class="input-xlarge focused" id="sh_coordinator_phone" name="sh_coordinator_phone" type="text" value="<?php if( isset( $result['sh_coordinator_phone'] ) )echo $result['sh_coordinator_phone']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('sh_coordinator_phone',"Please enter the oordinator Phone.") ?></span>							 				
						        </div>
					 </div>
                    <!-----------------STD Code------------------->       
                     <div class="control-group">
						  <label class="control-label" for="focusedInput">School STD Code
                             <span style="color:#F00; font-size:15px;"><b>*</b></span>
                          </label>
								  <div class="controls">
                                       <input class="input-xlarge focused" id="school_stdcode" name="school_stdcode" type="text" value="<?php if( isset( $result['school_stdcode'] ) ) echo $result['school_stdcode']; ?>" >
                                       <span class="help-inline"><?php  $this->validation->show_error('school_stdcode',"Please enter the school_stdcode.") ?></span>							  					
								  </div>
					 </div>
                    <!-----------------Phone------------------->       
					  <div class="control-group">
							<label class="control-label" for="focusedInput">School Phone
                             <span style="color:#F00; font-size:15px;"><b>*</b></span>
                            </label>
								   <div class="controls">
								         <input class="input-xlarge focused" id="school_phone" name="school_phone" type="text" value="<?php if( isset( $result['school_phone'] ) ) echo $result['school_phone']; ?>" >
                                         <span class="help-inline"><?php  $this->validation->show_error('school_phone',"Please enter the phone Number.") ?></span>									
								  </div>
					  </div>
                      
                    <!-----------------Country Code------------------->       
                      
					  <div class="control-group">
						    <label class="control-label" for="focusedInput">School Country Code
                             <span style="color:#F00; font-size:15px;"><b>*</b></span>
                            </label>
                            
							       <div class="controls">
								         <input class="input-xlarge focused" id="school_countrycode" name="school_countrycode" type="text" value="<?php if( isset( $result['school_countrycode'] ) )echo $result['school_countrycode']; ?>" >
                                         <span class="help-inline"><?php  $this->validation->show_error('school_countrycode',"Please enter the country code.") ?></span>							 
                                   </div>
					  </div>
                    <!-----------------Mobile------------------->       
                      
					  <div class="control-group">
							 <label class="control-label" for="focusedInput">School Mobile
                             <span style="color:#F00; font-size:15px;"><b>*</b></span>
                             </label>
								    <div class="controls">
								         <input class="input-xlarge focused" id="school_mobile" name="school_mobile" type="text" value="<?php if( isset( $result['school_mobile'] ) ) echo $result['school_mobile']; ?>" >
                                         <span class="help-inline"><?php  $this->validation->show_error('school_mobile',"Please enter the mobile.") ?></span>							 				
								    </div>
					  </div>
                    <!-----------------School Email------------------->       
                      <div class="control-group">
						   <label class="control-label" for="focusedInput">School Email 
                           <span style="color:#F00; font-size:15px;"><b>*</b></span>
                           </label>
								  <div class="controls">
								     <input class="input-xlarge focused" id="school_email" name="school_email" type="text" value="<?php if( isset( $result['school_email'] ) )echo $result['school_email']; ?>">
                                     <span class="help-inline"><?php  $this->validation->show_error('school_email',"Please enter the email.") ?></span>							 					
								  </div>
					   </div>
                    <!-----------------School Confirm Email ------------------->       
                       
				   <?php  $mode;if($mode=='Add') {  ?>
                     <div class="control-group">
                            <label class="control-label" for="focusedInput">Confirm Email </label>
                                     <div class="controls">
                                          <input class="input-xlarge focused" id="school_email1" name="school_email1" type="text" value="<?php if( isset( $result['school_email1'] ) )echo $result['school_email1']; ?>">
                                          <span class="help-inline"><?php  $this->validation->show_error('school_email1',"school email does not match") ?></span>							 				
                                     </div>
                     </div>
                     <?php } ?>
                     
                    <!-----------------School Board ------------------->       
                    <div class="control-group">
                          <label class="control-label" for="focusedInput">School Board 
                          <span style="color:#F00; font-size:15px;"><b>*</b></span>
                          </label>
                                  <div class="controls">
                                       <select class="span2" name="school_board" id="school_board">
                                               <option value="">Select</option>
                                               <option value="CBSE" <?php if( isset( $result['school_board'] ) ) if($result['school_board']=='CBSE') {  ?> selected="selected" <?php } ?>>CBSE</option>
                                               <option value="ICSE" <?php if( isset( $result['school_board'] ) ) if($result['school_board']=='ICSE') {  ?> selected="selected" <?php } ?>>ICSE</option>
                                               <option value="IGCSE" <?php if( isset( $result['school_board'] ) ) if($result['school_board']=='IGCSE') {  ?> selected="selected" <?php } ?>>IGCSE</option>
                                               <option value="State Board" <?php if( isset( $result['school_board'] ) ) if($result['school_board']=='State Board') {  ?> selected="selected" <?php } ?>>State Board</option>
                                      </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_board',"Please enter the school board.") ?></span>							 
                                  </div>
                   </div>
                    <!-----------------School Medium ------------------->       
                   
                   <div class="control-group">
                        <label class="control-label" for="focusedInput">School Medium 
                        <span style="color:#F00; font-size:15px;"><b>*</b></span>
                        </label>
                               <div class="controls">
                                    <input class="input-xlarge focused" id="school_medium" name="school_medium" type="text" value="<?php if( isset( $result['school_medium'] ) )echo $result['school_medium']; ?>">
                                    <span class="help-inline"><?php  $this->validation->show_error('school_medium',"Please enter the school medium.") ?></span>							 
                               </div>
                   </div>
                    <!-----------------school Concern ------------------->       
                   <div class="control-group">
                         <label class="control-label" for="focusedInput">School Concern Status
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <select class="span2" name="school_concern_status" id="school_concern_status">
                                            <option >Select</option>
                                            <option value="CONSENT GIVEN" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='CONSENT GIVEN') {  ?> selected="selected" <?php } ?> >CONSENT GIVEN</option>
                                            <option value="NOT GIVEN" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='NOT GIVEN') {  ?> selected="selected" <?php } ?> >NOT GIVEN</option>
                                            <option value="NOT APPROACHED" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='NOT APPROACHED') {  ?> selected="selected" <?php } ?> >NOT APPROACHED</option>
                                      </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                    <!-----------------School Latitude ------------------->       
                   <div class="control-group">
                        <label class="control-label" for="focusedInput">School Latitude</label>
                               <div class="controls">
                                     <input class="input-xlarge focused" id="school_latitude" name="school_latitude" type="text" value="<?php if( isset( $result['school_latitude'] ) )echo $result['school_latitude']; ?>" >
                                    <span class="help-inline"><?php  $this->validation->show_error('school_latitude',"Please enter the school latitude.") ?></span>							 
                              </div>
                   </div>
                    <!-----------------School Longitude ------------------->       
                   
                   <div class="control-group">
                         <label class="control-label" for="focusedInput">School Longitude</label>
                                <div class="controls">
                                     <input class="input-xlarge focused" id="school_longitude" name="school_longitude" type="text" value="<?php if( isset( $result['school_longitude'] ) )echo $result['school_longitude']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('school_longitude',"Please enter the school longitude.") ?></span>							
                                </div>
                   </div>
                    <!-----------------School Created Date ------------------->       
                   <div class="control-group">
                         <label class="control-label" for="date01">School Created Date</label>
                                  <div class="controls">
                                       <input type="text"  id="school_created_date" name="school_created_date" value="<?php if( isset( $result['school_created_date'] ) ) echo $result['school_created_date']; ?>" >
                                       <span class="help-inline"><?php  $this->validation->show_error('school_created_date',"Please enter the school created date.") ?></span>							
                                  </div>
                   </div>
                    <!-----------------Competition center ------------------->       
				   <div class="control-group">
						<label class="control-label" for="focusedInput">Competition center
                        <span style="color:#F00; font-size:15px;"><b>*</b></span>
                        </label>
							   <div class="controls">
								    <select class="span2" name="is_competition_center" id="is_competition_center">
                                            <option value="">Select</option>
                                            <option value="Y" <?php if( isset( $result['is_competition_center'] ) ) if($result['is_competition_center']=='Y') {  ?> selected="selected" <?php } ?>>Yes</option>
                                            <option value="N" <?php if( isset( $result['is_competition_center'] ) ) if($result['is_competition_center']=='N') {  ?> selected="selected" <?php } ?>>NO</option>
								    </select>
								     <span class="help-inline"><?php  $this->validation->show_error('is_competition_center',"Please select") ?></span>
                              </div>
					</div>
                    <!-----------------Submit /Cancel button ------------------->       
                    
				   <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit" >
								<button class="btn">Cancel</button>
				  </div>
               </fieldset>
	         </form>
	     </div><!-- END OF  class- box-content -->  
	 </div><!--END of class- box span12 DIV--> 
  </div><!--END OF class- row-fluid sortable" DIV-->


 <style>
 .help-inline{color:#F00;}
 </style>
 
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
$(document).ready(function(e) {
	
$("#school_created_date").datepicker();	
$('#school_created_date').datepicker('setDate',new Date());
});
        $("#country_id").change(function(){
			var data=new Object();
			data.id=this.value;
			$.ajax({
						url:"<?php echo base_url(); ?>franchise/students/getstate/",
						data:data,
						type: 'post',
						success:function(result)
						        {			 $("#stateID").html(result);	 }/*End of success*/
			      });/*END of ajax */
        });/* End of country_id change function*/
 </script>
<?php include('footer.php'); ?>
