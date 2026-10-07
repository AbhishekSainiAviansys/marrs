
<script type="text/javascript">
 function get_FranchiseType(franchise_type)
 {
	 var data=new Object();
	  data.franchise_type=franchise_type;
     switch(franchise_type)
	 {
		 case "M":
		 break;
		 case "N":
					 alert(franchise_type);
					 $.ajax({
						 
								 type:"POST",
								 url:BASE_URL+"manage/employee/get_FranchiseType",
								 data:data,
								 success:function(message)
								 {
									 $("#franchise_ref").append(message);
								 }
						   });
			 		 
		 break;
		 case "S":
		 			 alert(franchise_type);
					 $.ajax({
						 
								 type:"POST",
								 url:BASE_URL+"manage/employee/get_FranchiseType",
								 data:data,
								 success:function(message)
								 {
									 $("#franchise_ref").append(message);
								 }
						   });
		 break;
	 }
	 
	 
 }
 
 /////////////////////  END OF  GET FRANHISE REF  ///////////////////////////////////////////////////////
 
 
 function get_States(country_id)
 {
	 var data=new Object();
	  data.country_id=country_id;
	  //alert(country_id);
	  
	  $.ajax({
		         
				 type:"POST",
				 url:BASE_URL+"manage/employee/get_States",
				 data:data,
				 success: function(message)
				 {
					 //alert(message);
					 $("#list_state").html(message);
				 }
		    });
	  
 }


</script>
<div id="franchise_details" style="background:#C0DDE2">
<h3 align="center"> Enter Franchise details</h3>
                            
                                            <div class="control-group">
                                            <label class="control-label" for="focusedInput">Service</label>
                                            <div class="controls">
											<?php 
												$options=array();
												//print_r($services);
												$options['']='Select Services';
												foreach($services as $key=> $val):
												$options[$val['service_id']]=$val['service_name'];
												endforeach;
												//echo form_dropdown('serviceId',$options, if( isset( $services['service_id']))
												echo form_dropdown('serviceId',$options,isset( $services['service_id'] )?$services['service_id']: '');
                                            ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('serviceId'); //$this->validation->show_error('service_id',"Please select service.") ?></span>

								</div>
							  </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Franchise Type </label>
                                            <div class="controls">
                                                <?php
												$options=array();
												$options['']='Select franchise type';
												//print_r($franchise_data);
												foreach ( $franchise_data as $key => $val ) :
												//foreach($franchise_data as $val ):
												switch($key):
												case 'M':$val="Main";break;
												case 'N':$val="Sub";break;
												case 'S':$val="Other";break;
												endswitch;
												$options[$key]=$val;
												endforeach;
                                                $js='id="franchise_type" onChange="get_FranchiseType(this.value);"';
                                                echo form_dropdown('franchise_type', $options,isset( $list['franchise_type'] )?$list['franchise_type']: '',$js);
                                              //  echo form_dropdown('franchise_type', $franchise_data); 
												?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('franchise_type'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          <div class="control-group" id="franchise_ref">
							              </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Country </label>
                                            <div class="controls">
                                                <?php 
												$options=array();
												//print_r($countries);
												$options['']='Select Country';
												foreach($countries as $key=> $val):
												$options[$val['country_id']]=$val['country_name'];
												endforeach;
												//echo form_dropdown('serviceId',$options, if( isset( $services['service_id']))
												$js='id="state_id" onChange="get_States(this.value);"';
												echo form_dropdown('country_id',$options,isset( $services['country_id'] )?$services['country_id']: '',$js);
                                            ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('country_id'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                           <label class="control-label" for="focusedInput">State </label>
                                            <div class="controls" id="list_state">
                                            </div>
							              </div>
                                   
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Company Name </label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'company_name',
                                                      'id'          => 'company_name',
                                                      'value'       => isset( $list['company_name'] )?$list['company_name']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('company_name'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Proprietary Name</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'proprietary',
                                                      'id'          => 'proprietary',
                                                      'value'       => isset( $list['proprietary'] )?$list['proprietary']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('proprietary'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                                                                    
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Company Address</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'company_address',
                                                      'id'          => 'company_address',
													  'cols'        =>'5',
                                                      'value'       => isset( $list['company_address'] )?$list['company_address']: ''
                                                    );
            
                                                echo form_textarea($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('company_address'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">LandMark</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'landmark',
                                                      'id'          => 'landmark',
                                                      'value'       => isset( $list['landmark'] )?$list['landmark']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('landmark'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Place</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'place',
                                                      'id'          => 'place',
                                                      'value'       => isset( $list['place'] )?$list['place']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('place'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                           <div class="control-group">
                                            <label class="control-label" for="focusedInput">Pincode</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'pincode',
                                                      'id'          => 'pincode',
                                                      'value'       => isset( $list['pincode'] )?$list['pincode']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('pincode'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Province</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'province',
                                                      'id'          => 'province',
                                                      'value'       => isset( $list['province'] )?$list['province']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('province'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Longitude/Latitude</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'longitude',
                                                      'id'          => 'longitude',
                                                      'value'       => isset( $list['longitude'] )?$list['longitude']: ''
                                                    );
            
                                                echo form_input($data);
                                                echo ' ';
                                                $data = array(
                                                      'name'        => 'latitude',
                                                      'id'          => 'latitude',
                                                      'value'       => isset( $list['latitude'] )?$list['latitude']: ''
                                                    );
            
                                                echo form_input($data);
                                                
                                                ?>
                                            
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Company PhoneNumber</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'company_phno',
                                                      'id'          => 'company_phno',
                                                      'value'       => isset( $list['company_phno'] )?$list['company_phno']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('company_phno'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Company MobileNumber</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'company_mobno',
                                                      'id'          => 'company_mobno',
                                                      'value'       => isset( $list['company_mobno'] )?$list['company_mobno']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('company_mobno'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                                          <div class="control-group">
                                            <label class="control-label" for="focusedInput">Company EmailId</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'company_email_id',
                                                      'id'          => 'company_email_id',
                                                      'value'       => isset( $list['company_email_id'] )?$list['company_email_id']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('company_email_id'); //$this->validation->show_error('service_id',"Please select service.") ?></span>
                                            </div>
                                          </div>
                                          
                              
                              </div>