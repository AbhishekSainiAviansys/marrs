<?php include('header.php');
//print_r($list);
 ?>
 <script type="text/javascript">
 $(document).ready(function(e) {
  $("#list_state").show(); 
});
 
function get_States_value(country_id)
 {
	/* alert(country_id);*/
	 var data=new Object();
	 data.country_id=country_id;
	 $.ajax({
		        url:"<?php echo base_url();?>franchise/ajax/getstate/",
				 data:data,
				 type:'post',
				 success: function(message)
				 {
					 /* alert(message);*/
					 $("#state_id").html(message);
				 },
				 
				 error: function(message)
				 {
					 alert(message);
				 }
		    });
 }/* End  function get_States_value(country_id)*/

</script>
 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>franchise/">Frnachise</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>franchise/<?php echo ($list['franchise_id']>0)?'edit':'add';?>/"><?php echo ($list['franchise_id']>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Frnachise <?php echo ($list['franchise_id']>0)?'Edit':'Add';?></h2>
						
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
							  <h1><small>Franchise Information</small></h1>
							</div>
                            
                            <!-- START  DIV CONTENT FOR FRANCHISSE DETAILS-->
                            <div id="franchise_details">
                            
 <!-- ==============================================================================================================================-->      
         <div class="control-group">
              <label class="control-label" for="focusedInput">Employee Name</label>
                   <div class="controls">
										<?php 
											$data = array(
                                                      'name'        => 'emp_first_name',
                                                      'id'          => 'emp_first_name',
                                                      'value'       => isset($list['emp_first_name'])?$list['emp_first_name']: '',
													  'readonly'    =>'readonly'
                                                    );
            
                                                echo form_input($data);	
                                        ?>
                                		<span class="help-inline" style="color:#F00;"><?php  echo form_error('emp_first_name'); ?></span>
					</div><!-- DIV FOR class="controls" -->
		  </div><!-- DIV FOR class="control-group" -->
<!-- ======================================================================-->      
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
												 $js='id="country_id"  disabled="disabled" ';
												/* $js='id="country_id"  onChange="get_States_value(this.value);"';*/
												echo form_dropdown('country_id',$options,isset( $list['country_id'] )?$list['country_id']: '',$js);
                                            ?>
                                		<span class="help-inline" style="color:#F00;">
										<?php  echo form_error('country_id'); //$this->validation->show_error('service_id',"Please select service.") ?>
                                        </span>
                                            </div>
                                          </div>
                                          
<!-- ==============================================================-->      
                             <div class="control-group">
                                            <label class="control-label" for="focusedInput">State/Province </label>
                                            <div class="controls">
                                                <?php 
												$options=array();
												 //print_r($countries);
												$options['']='Select State';
												foreach($stateatload as $res):
												$options[$res['state_subdivision_id']]=$res['state_subdivision_name'];
												endforeach;
												echo form_dropdown('state_id',$options,isset( $list['state_id'] )?$list['state_id']: '','id="state_id" disabled="disabled" ');
                                            ?>
                                		<span class="help-inline" style="color:#F00;">
										<?php  echo form_error('state_id'); //$this->validation->show_error('service_id',"Please select service.") ?>
                                        </span>
                                            </div>
                                          </div>   
<!-- ======================================================================================================================================================================================================================================================================================-->      
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
													?>
                                                    
                                                      <span class="help-inline" style="color:#F00;"><?php  echo form_error('latitude');?> </span>
                                                <?php echo form_input($data);
                                                echo ' ';
                                                $data = array(
                                                      'name'        => 'latitude',
                                                      'id'          => 'latitude',
                                                      'value'       => isset( $list['latitude'] )?$list['latitude']: ''
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                            <span class="help-inline" style="color:#F00;"><?php  echo form_error('latitude');?> </span>
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
                     <!-- START  DIV CONTENT FOR FRANCHISSE DETAILS-->
							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
<?php include('footer.php'); ?>
