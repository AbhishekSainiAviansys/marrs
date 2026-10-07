<?php include('header.php');
 $fr_id = $this->session->userdata('franchise_id');
	 $frd = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
		$state_id= $frd->state_id;
		$country_id = $frd->country_id;
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>
select.span4 {
    position: relative;
    top: -16px;
    left: 303px;
}
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
        
  .multipleSelection {
      width: 240px;
      background-color: #eaeaea;
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      font-weight: bold;
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    #checkBoxes {
      display: none;
      border: 1px #8DF5E4 solid;
    }

    #checkBoxes label {
      display: block;
    }

    #checkBoxes label:hover {
      background-color: #4F615E;
    }
</style>
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
	        <div id="school_details">
	           <h style='color:green;'> <?php if($message!=''){echo $message.' ask admin to make school active.';}?></h>
	        </div>
			<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
				  <fieldset>
                     <legend><span style="color:#F00; font-size:14px;">The fields marked '<b> * </b>' are mandatory fields.</span></legend>
					
                      <!-----------------School Name------------------->       
                             
                             
                             
                             <div class="section-divider"> <span class="info">franchise Detail</span></div>
                              <div class="col-lg-12" style="display:flex">
                                
                                 <div class="span4">
								<label class="control-label" for="focusedInput">Franchise - 
                                
                                </label>
								<div class="controls"><h4><?php echo $frd->username;?></h4>
						   </div>   </div>  
                                   <div class="span4">
								<label class="control-label" for="focusedInput">Area Code
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								    
								    <select name="area_code" id="country_id" required>
								        
								        <?php 
								       $result = $this->db->get_where('areas',array('state_id'=>$state_id))->result_array();
								        foreach($result as $val){ ?>
								        <option value="<?php echo $val['area_code'];?>"><?php echo $val['city_name'];?></option>
								       
								        
								        <?php }?>
								    </select>
								   
									     
								 	<span class="help-inline"><?php  $this->validation->show_error('country_id',"Please enter the country.") ?></span>
								</div>
						   </div>
                                  
                                  
                                  </div>
                             
                    <div class="section-divider"> <span class="info">School Address</span></div>
							 <!-----------------Country-------------------> 
							 <div class="col-lg-12" style="display:flex">
							    
							    
							      <div class="span4">
								<label class="control-label" for="focusedInput">Country
                                <span style="color:#F00; font-size:15px;" ><b>*</b></span>
                                </label>
								<div class="controls">
								    
								    <select name="country_id" id="country_id" required>
								        
								        <?php 
								        $this->db->select('*');
								        $this->db->from('countries');
								        $this->db->where('country_id',$country_id);
								        $resc = $this->db->get();
								       $coun = $resc->result_array();
								        foreach($coun as $val){ ?>
								        <option value="<?php echo $val['country_id'];?>" ><?php echo $val['country_name'];?></option>
								       
								        
								        <?php }?>
								    </select>
								   
									     
								 	<span class="help-inline"><?php  $this->validation->show_error('country_id',"Please enter the country.") ?></span>
								</div>
						   </div>
							    
							      <div class="span4">
							    <label class="control-label" for="focusedInput">Pin Code
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								       <div class="controls">
								            <input class="" id="school_pincode" name="school_pincode" type="text" value="<?php if( isset( $result['school_pincode'] ) )echo $result['school_pincode']; ?>" required>
                                            <span class="help-inline"><?php  $this->validation->show_error('school_pincode',"Please enter the school pincode.") ?></span>							 					
								       </div>
						   </div>
                          
                    <!-----------------State/Province------------------->       
						   <div class="span4">
								   <label class="control-label" for="focusedInput">State/Province
                                   <span style="color:#F00; font-size:15px;"><b>*</b></span>  
                                   </label>
                                    <div class="controls">
                                   <select  name="stateID" id="stateID" required>
                                    <?php 
								       $result = $this->db->get_where('states',array('state_subdivision_id'=>$state_id))->result();
								        foreach($result as $val){ ?>
								        <option value='<?php echo $val->state_subdivision_id;?>'><?php echo $val->state_subdivision_name;?></option>
								       
								        <?php }?>
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
								             
								             <select  name="school_district" id="school_district" required>
                                    <?php 
								       $result = $this->db->get_where('districts',array('state_id'=>$state_id))->result();
								        foreach($result as $val){ ?>
								        <option value='<?php echo $val->id;?>'><?php echo $val->district_name;?></option>
								       
								        <?php }?>
                                    </select> 
								             						 					
								        </div>
							 </div>
                                   <div class="span4">
								  <label class="control-label" for="focusedInput">City
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								         <div class="controls">
								              <input class="" id="school_city" name="school_city" type="text" 
                                                     value="<?php if( isset( $result['school_city'] ) )echo $result['school_city']; ?>" required>
                                               <span class="help-inline"><?php  $this->validation->show_error('school_city',"Please enter the school city.") ?></span>							 					
								        </div>
							 </div>
                                  
                             
                   <div class="span4">
								 <label class="control-label" for="focusedInput">Locality
                               
                                 </label>
								 <div class="controls">
								      <input class="" id="school_locality" name="school_locality" type="text" value="<?php if( isset( $result['school_locality'] ) )echo $result['school_locality']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_locality',"Please enter the school locality.") ?></span>						
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
								      <input type="text" name="school_name" value="" style="margin-top: 6px;margin-bottom: 6px;" id="school_n" placeholder="School Name" required>
                                    					 					
								   </div>
								   
							 </div>
							 
							 
                      <!-----------------Affiliation Number------------------->       
							<div class="span4">
								 <label class="control-label" for="focusedInput">Affiliation Number</label>
								 <div class="controls">
								      <input class="" id="affiliation_number" name="affiliation_number" type="text" value="<?php if( isset( $result['affiliation_number'] ) )echo $result['affiliation_number']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('affiliation_number',"Please enter the school affiliation number.") ?></span>							 				
								</div>
							</div>
							
						 <div class="span4">
							<label class="control-label" for="focusedInput">School Phone
                            
                            </label>
								   <div class="controls">
								         <input class="" id="school_phone" name="school_phone" type="text" value="<?php if( isset( $result['school_phone'] ) ) echo $result['school_phone']; ?>" >
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
								         <input class="" id="school_mobile" name="school_mobile" type="text" value="<?php if( isset( $result['school_mobile'] ) ) echo $result['school_mobile']; ?>" required>
                                         <span class="help-inline"><?php  $this->validation->show_error('school_mobile',"Please enter the mobile.") ?></span>							 				
								    </div>
					  </div> 
                                <div class="span4">
								 <label class="control-label" for="focusedInput">Address Line1
                                 <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                 </label>
								 <div class="controls">
								      <input class="" id="school_address" name="school_address" type="text" value="<?php if( isset( $result['school_address'] ) )echo $result['school_address']; ?>" required>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address',"Please enter the school address1.") ?></span>						
								 </div>
							</div>
							
							<div class="span4">
								 <label class="control-label" for="focusedInput">Address Line2</label>
								 <div class="controls">
								      <input class="" id="school_address1" name="school_address1" type="text" value="<?php if( isset( $result['school_address1'] ) )echo $result['school_address1']; ?>" >
                                      <span class="help-inline"><?php  $this->validation->show_error('school_address1',"Please enter the school address2.") ?></span>						
								 </div>
							</div>
					
						</div>
							 
							
                     
                  
                    <!-----------------Co-ordinator Name-------------------> 
                   
                    <!-----------------Country Code------------------->       
                       <div class="col-lg-12" style="display:flex">
                          
                          	<div class="span4">
								  <label class="control-label" for="focusedInput">Principal First Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								       <input class="" id="principal_first_name" name="principal_first_name" type="text" value="<?php if( isset( $result['principal_first_name'] ) )echo $result['principal_first_name']; ?>" required>
                                       <span class="help-inline"><?php  $this->validation->show_error('principal_first_name',"Please enter the School Principal Name.") ?></span>							 					
								  </div>
						  </div>
						  <div class="span4">
						  <label class="control-label" for="focusedInput">Principal Middle Name</label>
								 <div class="controls">
                                     <input class="" id="principal_middle_name" name="principal_middle_name" type="text" value="<?php if( isset( $result['principal_middle_name'] ) )echo $result['principal_last_name']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('principal_last_name',"Please enter the oordinator Phone.") ?></span>							 				
					   </div>
					 </div>
                     <div class="span4">
						  <label class="control-label" for="focusedInput">Principal Last Name</label>
						   
								 <div class="controls">
                                     <input class="" id="principal_last_name" name="principal_last_name" type="text" value="<?php if( isset( $result['principal_last_name'] ) )echo $result['principal_last_name']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('principal_last_name',"Please enter the oordinator Phone.") ?></span>							 				
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
								     <input class="" id="school_email" name="school_email" type="text" value="<?php if( isset( $result['school_email'] ) )echo $result['school_email']; ?>"  required>
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
                                       <select class="span12" name="school_board" id="school_board" required>
                                              
                                               
                                               <option value="CBSE">CBSE</option>
                                               <option value="ICSE">ICSE</option>
                                               <option value="IGCSE" >IGCSE</option>
                                               <option value="State Board">State Board</option>
                                                <option value="other">Other</option>
                                      </select>
                                      <input type="text" name="school_board2" id="s_board" placeholder="School Board" style="display:none; margin-top:4px;">
                                      <span class="help-inline"><?php  $this->validation->show_error('school_board',"Please enter the school board.") ?></span>							 
                                  </div>
                   </div>
                   
                   <script>
$("#school_board").change(function(){
  // alert('sas');
if (this.value == "other") 
    {
      $('#s_board').css('display','block');
    }else{
         $('#s_board').css('display','none');
    }
  });</script>
                   <div class="span12">
                        <label class="control-label" for="focusedInput">School Medium 
                        <span style="color:#F00; font-size:15px;"><b>*</b></span>
                        </label>
                               <div class="controls">
                                    <input class="" id="school_medium" name="school_medium" type="text" value="<?php if( isset( $result['school_medium'] ) )echo $result['school_medium']; ?>" placeholder="Hindi,English" required>
                                    <span class="help-inline"><?php  $this->validation->show_error('school_medium',"Please enter the school medium.") ?></span>							 
                               </div>
                   </div>
                   </div>
                    <!-----------------School Medium ------------------->       
                   
                   
                    <!-----------------school Concern ------------------->  
                     <div class="col-lg-12" style="display:flex">
                   <div class="span4">
                         <label class="control-label" for="focusedInput">School Consent
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <select class="span12" name="school_concern_status" id="school_concern_status" required>
                                            <option >Select</option>
                                            <option value="CONSENT GIVEN" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='CONSENT GIVEN') {  ?> selected="selected" <?php } ?> >CONSENT GIVEN</option>
                                            <option value="NOT GIVEN" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='NOT GIVEN') {  ?> selected="selected" <?php } ?> >NOT GIVEN</option>
                                            <option value="NOT APPROACHED" <?php if( isset( $result['school_concern_status'] ) ) if($result['school_concern_status']=='NOT APPROACHED') {  ?> selected="selected" <?php } ?> >NOT APPROACHED</option>
                                      </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
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
                   <!--<div class="span4">-->
                   <!--      <label class="control-label" for="date01">School Created Date</label>-->
                   <!--               <div class="controls">-->
                   <!--                    <input type="text"  id="school_created_date" name="school_created_date" value="<?php if( isset( $result['school_created_date'] ) ) echo $result['school_created_date']; ?>" >-->
                   <!--                    <span class="help-inline"><?php  //$this->validation->show_error('school_created_date',"Please enter the school created date.") ?></span>							-->
                   <!--               </div>-->
                   <!--</div>-->
                    <!-----------------Competition center ------------------->       
				   
					</div>
					  <div class="col-lg-12" style="display:flex">
                   <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator First Name
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_coordinator_first_name" id="school_coordinator_first_name" value="<?php if( isset( $result['school_coordinator_first_name'] ) )echo $result['school_coordinator_first_name']; ?>"  required>
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_first_name',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                   
                    <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Middle Name
                         <span style="color:#F00; font-size:15px;"><b></b></span>
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_coordinator_middle_name" id="school_coordinator_first_name" value="<?php if( isset( $result['school_coordinator_middle_name'] ) )echo $result['school_coordinator_middle_name']; ?>">
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                    <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Last Name
                        
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_coordinator_last_name" id="school_coordinator_first_name" value="<?php if( isset( $result['school_coordinator_flast_name'] ) )echo $result['school_coordinator_last_name']; ?>">
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                   
				</div>
				
				
				  <div class="col-lg-12" style="display:flex">
                   <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Email
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="email" class="span12" name="school_coordinator_email" id="school_coordinator_email" value="<?php if( isset( $result['school_coordinator_email'] ) )echo $result['school_coordinator_email']; ?>" required>
                                            </select>
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                   
                    <div class="span4">
                         <label class="control-label" for="focusedInput">School Coordinator Mobile
                         <span style="color:#F00; font-size:15px;"><b>*</b></span>
                         </label>
                                 <div class="controls">
                                      <input type="text" class="span12" name="school_coordinator_phone" id="school_coordinator_phone" value="<?php if( isset( $result['school_coordinator_phone'] ) )echo $result['school_coordinator_phone']; ?>" required>
                                            <!--</select>-->
                                      <span class="help-inline"><?php  $this->validation->show_error('school_concern_status',"Please enter the school concern status.") ?></span>							
                                </div>
                   </div>
                   
                   
				</div>
				
				
					
					<div class="section-divider"> <span class="info">MaRRS Co-ordinator Details</span></div>
					  <div class="col-lg-12" style="display:flex">
						 <div class="span12">
							  <label class="control-label" for="focusedInput"> First Name</label>
							<div class="controls">
								 <input class="" id="marrs_coordinator_name" name="marrs_coordinator_first_name" type="text" value="<?php if( isset( $result['marrs_coordinator_first_name'] ) )echo $result['marrs_coordinator_first_name']; ?>" >
                                 <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_name',"Please enter the school coordinator name.") ?></span>							 					
							</div>
						</div>
						 <div class="span12">
							  <label class="control-label" for="focusedInput"> Last Name</label>
							<div class="controls">
								 <input class="" id="marrs_coordinator_last_name" name="marrs_coordinator_last_name" type="text" value="<?php if( isset( $result['marrs_coordinator_last_name'] ) )echo $result['marrs_coordinator_last_name']; ?>" >
                                 <span class="help-inline"><?php  $this->validation->show_error('school_coordinator_name',"Please enter the school coordinator name.") ?></span>							 					
							</div>
						</div>
                    <!-----------------Co-ordinator Email------------------->       
                        
                        <div class="span12">
							 <label class="control-label" for="focusedInput"> Email</label>
							 <div class="controls">
								  <input class="" id="school_coordinator_email" name="marrs_coordinator_email" type="text" value="<?php if( isset( $result['marrs_coordinator_email'] ) )echo $result['marrs_coordinator_email']; ?>" >
                                  <span class="help-inline"><?php  $this->validation->show_error('marrs_coordinator_email',"Please enter the school coordinator email.") ?></span>							 				
							  </div>
					   </div>
                    <!-----------------Confirmation of EmailID------------------->       
                      
		               </div>
		               
		               
		                <div class="col-lg-12" style="display:flex">
						  <div class="span4">
						  <label class="control-label" for="focusedInput"> Phone</label>
								 <div class="controls">
                                     <input class="" id="sh_coordinator_phone" name="marrs_coordinator_phone" type="text" value="<?php if( isset( $result['marrs_coordinator_phone'] ) )echo $result['marrs_coordinator_phone']; ?>" >
                                     <span class="help-inline"><?php  $this->validation->show_error('marrs_coordinator_phone',"Please enter the oordinator Phone.") ?></span>							 				
						        </div>
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

<?php include('footer.php'); ?>
