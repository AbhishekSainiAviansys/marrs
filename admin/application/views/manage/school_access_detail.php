<?php include('header.php'); ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>
input.chk {
    margin-left: 20px;
    margin-top:10px;
}  
.form-horizontal .controls {
   
    margin-left: 150px;
  
}
input[type="text"] {
    width: 96%;
}
.section-divider {
    border-top: 2px solid #ddd;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-right: 20px;
}
span.info {
    display: inline-block;
    position: relative;
    padding: 1px 30px 2px 30px;
    top: -11px;
    font-size: 18px;
    color: #4B4B4B;
    background-color: #fff;
}
    
</style>
   

<div class="row-fluid sortable">
	<div class="box span12">
    
	
	    <div class="box-content">
	        
	         <?php echo $this->notifications->display_html();?>  
			<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
				  <fieldset>
                     <legend><span style="color:#F00; font-size:14px;">The fields marked '<b>*</b>' are  mandatory fiedls</span></legend>
					
                      <!-----------------School Name------------------->       
                             
                       
                          
                             
                    <div class="section-divider"> <span class="info">School Address</span></div>
							 <!-----------------Country-------------------> 
							 <div class="col-lg-12" style="display:flex">
							    
							      <div class="span4">
							    <label class="control-label" for="focusedInput">Pin Code
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								       <div class="controls">
								            <input class="" id="school_pincode" name="school_pincode" type="text" value="<?php echo $access_detail['pin'];?>" >
                                            						 					
								       </div>
						   </div>
                           <div class="span4">
								<label class="control-label" for="focusedInput">Country
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								  	    
								    <select  class="span12" name="country_id" id="country_id">
								         <option value="" <?php if($access_detail['country']==''){ echo 'selected="selected"';}?>>Select Country</option>
								        <option value="<?php echo '105';?>" <?php if($access_detail['country']=='105'){ echo 'selected="selected"';}?>><?php echo 'India';?></option>
								      
								         </select>
								 
								</div>
						   </div>
                    <!-----------------State/Province------------------->       
						   <div class="span4">
								   <label class="control-label" for="focusedInput">State/Province
                                   <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                   </label>
								    <div class="controls">
								        <select  class="span12" name="stateID" id="stateID">
								            <?php $states = $this->db->get_where('states',array('country_id'=>'105'))->result_array();
								            foreach($states as $value){
								            ?>
								        <option value="<?php echo $value['state_subdivision_id'];?>" <?php if($value['state_subdivision_id']==$access_detail['state']){ echo 'selected="selected"';}?>><?php echo $value['state_subdivision_name'];?></option>
								        <?php } ?>  
								         </select>
								    
								   </div>
							 </div>
                    <!-----------------Shool City ------------------->       
                             
                            
							 </div>
							  <!-----------------Shool City ------------------->       
                              <div class="col-lg-12" style="display:flex">
                                   <div class="span4">
								  <label class="control-label" for="focusedInput">District
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								         <div class="controls">
								              <input class="" id="school_district" name="school_district" type="text" 
                                                     value="<?php echo $access_detail['district']; ?>" >
                                                      <span class="help-inline"><?php  $this->validation->show_error('school_district',"Please enter the school district.") ?></span>
                                              						 					
								        </div>
							 </div>
                                   <div class="span4">  
								  <label class="control-label" for="focusedInput">City
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								         <div class="controls">
								              <input class="" id="school_city" name="city" type="text" 
                                                     value="<?php echo $access_detail['city']; ?>" >
                                                      <span class="help-inline"><?php  $this->validation->show_error('school_city',"Please enter the school city.") ?></span>
                                              							 					
								        </div>
							 </div>
                                  
                             
                  <div class="span4">
								 <label class="control-label" for="focusedInput">Locality
                               
                                 </label>
								 <div class="controls">
								      <input class="" id="school_locality" name="school_locality" type="text" value="<?php echo $access_detail['location']; ?>" >
                                      					
								 </div>
							</div>      
                            </div>
                           
                          
						<div class="section-divider"> <span class="info">School Profile</span></div>
							 <div class="col-lg-12" style="display:flex">
						   <div class="span4">
								  <label class="control-label" for="focusedInput">School Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								  
								         <input type="text" name="school_name" value="<?php echo $access_detail['school_name'];?>" id="school_n" placeholder="School Name">
                                     <span class="school-error" style="color:red;"><?php  echo $this->session->flashdata('message'); ?></span>							 					
								   </div>
								   
							 </div>
						  
                      <!-----------------Affiliation Number------------------->       
							<div class="span4">
								 <label class="control-label" for="focusedInput">Affiliation Number</label>
								 <div class="controls">
								      <input class="" id="affiliation_number" name="affiliation_number" type="text" value="<?php echo $access_detail['affiliation_number']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('affiliation_number',"Please enter the school affiliation number.") ?></span>							 				
								</div>
							</div>
							
						 <div class="span4">
							<label class="control-label" for="focusedInput">School Phone
                             <span style="color:#F00; font-size:15px;"><b></b></span>
                            </label>
								   <div class="controls">
								         <input class="" id="school_phone" name="school_phone" type="text" value="<?php  echo $access_detail['school_phone']; ?>" >
                                         <span class="help-inline"><?php  $this->validation->show_error('school_phone',"Please enter the phone Number.") ?></span>									
								  </div>
					  </div>
							</div>
						
							  <div class="col-lg-12" style="display:flex">
                                 <div class="span4">
							 <label class="control-label" for="focusedInput">School Mobile
                             <span style="color:#F00; font-size:15px;"><b>*</b></span>
                             </label>
								    <div class="controls">
								         <input class="" id="school_mobile" name="school_mobile" type="text" value="<?php echo $access_detail['school_mobile']; ?>" >
                                         <span class="help-inline"><?php  $this->validation->show_error('school_mobile',"Please enter the mobile.") ?></span>							 				
								    </div>
					  </div> 
                                <div class="span4">
								 <label class="control-label" for="focusedInput">Address Line1
                                 <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                 </label>
								 <div class="controls">
								      <input class="" id="school_address" name="school_address" type="text" value="<?php echo  $access_detail['school_address']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address',"Please enter the school address1.") ?></span>						
								 </div>
							</div>
							
							<div class="span4">
								 <label class="control-label" for="focusedInput">Address Line2</label>
								 <div class="controls">
								      <input class="" id="school_address1" name="school_address1" type="text" value="<?php echo $access_detail['school_address1']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address1',"Please enter the school address2.") ?></span>						
								 </div>
							</div>
					
						</div>
							 
							
                     
                  
                    <!-----------------Co-ordinator Name-------------------> 
                   
                    <!-----------------Country Code------------------->       
                       <div class="col-lg-12" style="display:flex">
                          
                          	<div class="span4">
								  <label class="control-label" for="focusedInput">Principal  Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								       <input class="" id="principal_first_name" name="principal_first_name" type="text" value="<?php echo $access_detail['school_principal_name']; ?>" >
                                       <span class="help-inline"></span>							 					
								  </div>
						  </div>
						 
                         
                     
					 </div>
					 
					  
                    <!-----------------School Email------------------->  
                     <div class="col-lg-12" style="display:flex">
                      <div class="span12">
						   <label class="control-label" for="focusedInput">School Email 
                           <span style="color:#F00; font-size:15px;"><b>*</b></span>
                           </label>
								  <div class="controls">
								     <input class="" id="school_email" name="school_email" type="text" value="<?php echo $access_detail['school_email']; ?>">
                                     <span class="help-inline"><?php  $this->validation->show_error('school_email',"Please enter the email.") ?></span>							 					
								  </div>
					   </div>
                    <!-----------------School Confirm Email ------------------->       
                       
				  
                     
                    <!-----------------School Board ------------------->       
                    <div class="span12">
                          <label class="control-label" for="focusedInput">School Board 
                          <span style="color:#F00; font-size:15px;"><b>*</b></span>
                          </label>
                                  <div class="controls">
                                       <input type="text" class="span12" name="school_board" id="school_board" value="<?php echo $access_detail['school_board']; ?>">
                                             
                                      <span class="help-inline"><?php  $this->validation->show_error('school_board',"Please enter the school board.") ?></span>							 
                                  </div>
                   </div>
                   <div class="span12">
                        <label class="control-label" for="focusedInput">School Medium 
                        <span style="color:#F00; font-size:15px;"><b>*</b></span>
                        </label>
                               <div class="controls">
                                    <input class="" id="school_medium" name="school_medium" type="text" value="<?php echo $access_detail['school_medium']; ?>">
                                    <span class="help-inline"><?php  $this->validation->show_error('school_medium',"Please enter the school medium.") ?></span>							 
                               </div>
                   </div>
                   </div>
                    <!-----------------School Medium ------------------->       
                   
                   
                    <!-----------------school Concern ------------------->  
                     <div class="col-lg-12" style="display:flex">
                   <div class="span4">
                         <label class="control-label" for="focusedInput">School Consent
                        
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_concern_status" id="school_concern_status" value="<?php echo $access_detail['school_concern_status']; ?>">
                                         
                                      <span class="help-inline"></span>							
                                </div>
                   </div>
                    <!-----------------School Latitude ------------------->       
                   <!--<div class="span12">
                        <label class="control-label" for="focusedInput">School Latitude</label>
                               <div class="controls">
                                     <input class="" id="school_latitude" name="school_latitude" type="text" value="<?php if( isset( $result['school_latitude'] ) )echo $result['school_latitude']; ?>" >
                                    <span class="help-inline"><?php  $this->validation->show_error('school_latitude',"Please enter the school latitude.") ?></span>							 
                              </div>
                   </div>
                        
                   
                   <div class="span12">
                         <label class="control-label" for="focusedInput">School Longitude</label>
                                <div class="controls">
                                     <input class="" id="school_longitude" name="school_longitude" type="text" value="<?php if( isset( $result['school_longitude'] ) )echo $result['school_longitude']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('school_longitude',"Please enter the school longitude.") ?></span>							
                                </div>
                   </div>-->
                    <!-----------------School Created Date ------------------->       
                   <div class="span4">
                         <label class="control-label" for="date01">School Created Date</label>
                                  <div class="controls">
                                       <input type="text"  id="school_created_date" name="school_created_date" value="<?php  echo $access_detail['school_created_date']; ?>" >
                                       <span class="help-inline"><?php  $this->validation->show_error('school_created_date',"Please enter the school created date.") ?></span>							
                                  </div>
                   </div>
                    <!-----------------Competition center ------------------->       
				   
					</div>
					  <div class="col-lg-12" style="display:flex">
                   <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator  Name
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_coordinator_first_name" id="school_coordinator_first_name" value="<?php  echo $access_detail['school_coordinator_name']; ?>">
                                            </select>
                                     							
                                </div>
                   </div>
                   
                    <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Email
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="email" class="span12" name="school_coordinator_email" id="school_coordinator_email" value="<?php  echo $access_detail['school_coordinator_email']; ?>">
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_email',"Please enter the school email.") ?></span>							
                                </div>
                   </div>
                   
                    <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Phone
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="number" class="span12" name="school_coordinator_phone" id="school_coordinator_phone" value="<?php  echo $access_detail['coordinator_phone']; ?>">
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_phone',"Please enter the school phone.") ?></span>							
                                </div>
                   </div>
                   
				</div>
				
				
				  
				
				
					
					<div class="section-divider"> <span class="info">MaRRS Co-ordinator Details</span></div>
					  <div class="col-lg-12" style="display:flex">
						 <div class="span12">
							  <label class="control-label" for="focusedInput"> First Name</label>
							<div class="controls">
								 <input class="" id="marrs_coordinator_name" name="marrs_coordinator_first_name" type="text" value="<?php echo $access_detail['marrs_coordinator_first_name']; ?>" >
                                 <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_name',"Please enter the school coordinator name.") ?></span>							 					
							</div>
						</div>
						 <div class="span12">
							  <label class="control-label" for="focusedInput"> Last Name</label>
							<div class="controls">
								 <input class="" id="marrs_coordinator_last_name" name="marrs_coordinator_last_name" type="text" value="<?php echo $access_detail['marrs_coordinator_last_name']; ?>" >
                                 <span class="help-inline"></span>							 					
							</div>
						</div>
                    <!-----------------Co-ordinator Email------------------->       
                        
                        <div class="span12">
							 <label class="control-label" for="focusedInput"> Email</label>
							 <div class="controls">
								  <input class="" id="school_coordinator_email" name="marrs_coordinator_email" type="text" value="<?php echo $access_detail['marrs_coordinator_email']; ?>" >
                                  <span class="help-inline"></span>							 				
							  </div>
					   </div>
                    <!-----------------Confirmation of EmailID------------------->       
                      
		               </div>
		               
		               
		                <div class="col-lg-12" style="display:flex">
						  <div class="span4">
						  <label class="control-label" for="focusedInput"> Phone</label>
								 <div class="controls">
                                     <input class="" id="sh_coordinator_phone" name="marrs_coordinator_phone" type="text" value="<?php echo $result['marrs_coordinator_email']; ?>" >
                                     <span class="help-inline"></span>							 				
						        </div>
					 </div>
			           
		               </div>
					
				
					
                    <!-----------------Submit /Cancel button ------------------->       
                    
				   <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit">
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

<?php include('footer.php'); ?>
