<?php include('header.php');   //print_r($list); ?>
<script type="text/javascript">


//----------------------Get States -----------------------------------------------------------
function get_states(country_id){
		//alert(country_id);
        var data=new Object();
        data.id=country_id;
		
        $.ajax({
            url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
				//alert(result);
                 $("#state_subdivision_id").html(result);
				},//end success
			error:function()
				{
					alert("Failed to load ajax getstate");	
				}//end error
		});//end ajax
}//end get_states function

//---------------------------Get the Name of Depatment Head------------------------------------------------------
function get_depatmentHead(dept_id)
{
	var data=new Object();
	data.department_id=dept_id;
	$.ajax({
			   type:"POST",
			   url:BASE_URL+"manage/ajax/get_departmentHead/",
			   data:data,
			   success:function(result){
				  // alert(result);
					   $("#emp_reporting_officer_id").val(result);
			   },//end success
			   error:function(result){
				   alert("Failed to load ajax get_departmentHead");
					  
			   }//end error
	});//end ajax

}//end function get_depatmentHead
//---------------------------------------------------------------------------------
</script>

<div>
	<ul class="breadcrumb">
		<li> <a href="<?php echo SITE_URL?>manage/">Employee</a> <span class="divider">/</span> </li>
		<li> <a href="<?php echo SITE_URL?>manage/<?php echo ($list['emp_id']>0)?'edit':'add';?>/"><?php echo ($list['emp_id']>0)?'Edit':'Add';?></a></li>
	</ul>
</div>
<?php echo $this->notifications->display_html();?> 
			
<div class="row-fluid sortable">
	 <div class="box span12">
     
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i> Employee <?php echo ($list['emp_id']>0)?'Edit':'Add';?></h2>
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
							     <h1><small>Employee Information<?php echo "........."; print_r($states_1); ?>
</small></h1>
							</div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
						 <div class="controls">
											<?php
                                            $options = array(
                                                ''=>'Select',
                                                'Mr'  => 'Mr.',
                                                'Ms'  => 'Ms.'									);
        
                                            echo form_dropdown('emp_tiltle', $options, $list['emp_tiltle']);
                                            ?>
                                        <span class="help-inline"><?php  echo form_error('emp_tiltle');?></span>
                                      </div>
							  </div>
<!--    #####################################################################	First Name	###################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">First Name </label>
                                        <div class="controls">
                                             <?php
                                                $data = array(
                                                      'name'        => 'emp_first_name',
                                                      'id'          => 'emp_first_name',
                                                      'value'       => $list['emp_first_name']
                                                    );
                                                echo form_input($data);
                                             ?>
                                            <span class="help-inline"><?php  echo form_error('emp_first_name'); ?></span>
                                       </div>
							</div>
<!--    #####################################################################	Middle Name	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Middle Name </label>
								        <div class="controls">
											<?php
                                            $data = array(
                                                  'name'        => 'emp_middle_name',
                                                  'id'          => 'emp_middle_name',
                                                  'value'       => $list['emp_middle_name']
                                                );
        
                                            echo form_input($data);
                                            ?>
										</div>
							</div>
<!--    #####################################################################	Last Name	################ -->					  
							<div class="control-group">
                                   <label class="control-label" for="focusedInput">Last Name </label>
                                    <div class="controls">
                                         <?php
                                         $data = array(
                                              'name'        => 'emp_last_name',
                                              'id'          => 'emp_last_name',
                                              'value'       => $list['emp_last_name']
                                         );
                                        echo form_input($data);
                                        ?>
                                        <span class="help-inline"><?php  echo form_error('emp_last_name'); ?></span>
                                    </div>
							  </div>
<!--    #####################################################################	Department	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Department </label>
								        <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='select department';
                                               foreach($departments as $val):
                                                 $options[$val['department_id']]=$val['department_name'];
                                               endforeach;
                                                   $js = 'id="emp_dept_id" onChange="get_depatmentHead(this.value);"';
                                              echo form_dropdown('emp_dept_id', $options, $list['emp_dept_id'],$js);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('emp_dept_id'); ?></span>
								        </div>
							  </div>
<!--    #####################################################################	Department Head 	###################-->					  
							<div class="control-group">
                                 <label class="control-label" for="focusedInput">Department Head </label>
                                        <div class="controls">
											<?php
                                                $txt_data = array('name' => 'emp_reporting_officer_id',
                                                                  'id' => 'emp_reporting_officer_id',
                                                                  'value'=> $list['emp_reporting_officer_id'],
                                                                  'readonly' => 'readonly');
                                                echo form_input($txt_data);
                                            ?>
                                            <span class="help-inline"><?php  echo form_error('emp_reporting_officer_id');?></span>
                                        </div>							  
                             </div>
<!--    #####################################################################	Date of Birth	###################-->					  
							<div class="control-group">
							  	 <label class="control-label" for="eventDate">Date of Birth</label>
							  			<div class="controls">
										<?php
                                            $data = array(
                                                  'name'        => 'emp_dob',
                                                  'id'          => 'emp_dob',
                                                  'class'		=>'input-medium datepicker',
                                                  'value'       => $list['emp_dob'] 
                                                );
                                            echo form_input($data);
                                        ?>
                                        <span class="help-inline"><?php  echo form_error('emp_dob'); ?></span>
							            </div>
							</div> 
<!--    #####################################################################	Gender	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Gender </label>
								        <div class="controls">
											<?php
                                            $options = array(
                                                ''=>'Select',
                                                'Male'  => 'Male',
                                                'Female'  => 'Female'									);
        
                                            echo form_dropdown('emp_gender', $options, $list['emp_gender']);
                                            ?>
                                        <span class="help-inline"><?php  echo form_error('emp_gender');?></span>
                                      </div>
							</div>

<!--    #####################################################################	Communication Address	###################-->					  
					  
							<!--<div class="control-group">
								 <label class="control-label" for="focusedInput">Communication Address1</label>
                                        <div class="controls">
                                            <?php/*
                                            $data = array(
                                                  'name'        => 'emp_ca',
                                                  'id'          => 'emp_ca',
                                                  'cols'        => '10',
                                                  'value'       => $list['emp_ca']
                                                );
                                            echo form_textarea($data);*/
                                            ?>
                                        <span class="help-inline"><?php  //echo form_error('emp_ca'); ?></span>
                                        </div>
							</div>-->
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> Communication Address1</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_ca',
                                                  'id'          => 'emp_ca',
                                                  'value'       => $list['emp_ca']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_ca'); ?></span>
                                        </div>
							</div>
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> Communication Address2</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_ca1',
                                                  'id'          => 'emp_ca1',
                                                  'value'       => $list['emp_ca1']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_ca1'); ?></span>
                                        </div>
							</div>
							<!--    #####################################################################	Country	###################-->
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
												$js='id="country_id"  onchange="get_states(this.value);"';
												echo form_dropdown('country_id',$options,isset($list['country_id'] )?$list['country_id']: '',$js);
 ?>
                                        <span class="help-inline"><?php  echo form_error('country_code');?></span>
                                      </div>
							</div>
<!--    #####################################################################	States	###################-->
							<div class="control-group">
								 <label class="control-label" for="focusedInput">State </label>
								        <div class="controls">
											<?php
												$options=array();
												$options['']='Select State';
												foreach($stateatload as $key=> $val):
												$options[$val['state_subdivision_id']]=$val['state_subdivision_name'];
												endforeach;
												echo form_dropdown('state_subdivision_id',$options,isset( $list['state_subdivision_id'] )?$list['state_subdivision_id']: '','id="state_subdivision_id"');
											?>
                                        <span class="help-inline"><?php  echo form_error('state_subdivision_id');?></span>
                                      </div>
							</div>
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> City</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_pa_city',
                                                  'id'          => 'emp_pa_city',
                                                  'value'       => $list['emp_pa_city']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_pa_city'); ?></span>
                                        </div>
							</div>
<!--    #####################################################################	Pincode	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> Pincode</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_ca_pincode',
                                                  'id'          => 'emp_ca_pincode',
                                                  'value'       => $list['emp_ca_pincode']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_ca_pincode'); ?></span>
                                        </div>
							</div>
<!--    #####################################################################	Permanent Address	###################-->					  
						<!--	<div class="control-group">
								 <label class="control-label" for="focusedInput">Permanent Address</label>
										<div class="controls">
										<?php/*
                                        $data = array(
                                              'name'        => 'emp_pa',
                                              'id'          => 'emp_pa',
                                              'cols'        => '10',
                                              'value'       => $list['emp_pa']
                                            );
                                        echo form_textarea($data);*/
                                        ?>
                                        <span class="help-inline"><?php  //echo form_error('emp_pa'); ?></span>
                                        </div>
							</div>-->
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> Permanent Address1</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_pa',
                                                  'id'          => 'emp_pa',
                                                  'value'       => $list['emp_pa']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_pa'); ?></span>
                                        </div>
							</div>
							<div class="control-group">
								 <label class="control-label" for="focusedInput"> Permanent Address2</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_pa1',
                                                  'id'          => 'emp_pa1',
                                                  'value'       => $list['emp_pa1']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_pa1'); ?></span>
                                        </div>
							</div>
								<div class="control-group">
								 <label class="control-label" for="focusedInput"> City</label>
                                         <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_ca_city',
                                                  'id'          => 'emp_ca_city',
                                                  'value'       => $list['emp_ca_city']
                                                );
                                            echo form_input($data);
                                            ?>
                                         <span class="help-inline"><?php  echo form_error('emp_ca_city'); ?></span>
                                        </div>
							</div>
<!--    #####################################################################	Pincode	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Pincode</label>
								 <div class="controls">
									<?php
									$data = array(
										  'name'        => 'emp_pa_pincode',
										  'id'          => 'emp_pa_pincode',
										  'value'       => $list['emp_pa_pincode']
										);
									echo form_input($data);
									?>
								   <span class="help-inline"><?php  echo form_error('emp_pa_pincode');?></span>
								</div>
							</div>
<!--    #####################################################################	Contact No(Residence)	###################-->	
<div class="control-group">
								 <label class="control-label" for="focusedInput">StdCode/CityCode</label>
								 <div class="controls">
								 <?php
									$data = array(
										  'name'        => 'emp_stdcode',
										  'id'          => 'emp_stdcode',
										  'value'       => $list['emp_stdcode']
										);
									echo form_input($data);
								  ?>
								  <span class="help-inline"><?php  echo form_error('emp_stdcode'); ?></span>
								</div>
							</div>				  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Contact No(Residence)</label>
								 <div class="controls">
								 <?php
									$data = array(
										  'name'        => 'emp_phone',
										  'id'          => 'emp_phone',
										  'value'       => $list['emp_phone']
										);
									echo form_input($data);
								  ?>
								  <span class="help-inline"><?php  echo form_error('emp_phone'); ?></span>
								</div>
							</div>
<!--    #####################################################################		Mobile  ###################-->
<div class="control-group">
								 <label class="control-label" for="focusedInput">Country Code</label>
								 <div class="controls">
								 <?php
									$data = array(
										  'name'        => 'emp_country_code',
										  'id'          => 'emp_country_code',
										  'value'       => $list['emp_country_code']
										);
									echo form_input($data);
									?>
								<span class="help-inline"><?php  echo form_error('emp_country_code');?></span>
								</div>
							</div>					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Mobile</label>
								 <div class="controls">
								 <?php
									$data = array(
										  'name'        => 'emp_mobile',
										  'id'          => 'emp_mobile',
										  'value'       => $list['emp_mobile']
										);
									echo form_input($data);
									?>
								<span class="help-inline"><?php  echo form_error('emp_mobile');?></span>
								</div>
							</div>
<!--    #####################################################################	Personal Email Id	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Personal Email</label>
								 <div class="controls">
									<?php
									$data = array(
										  'name'        => 'emp_personal_email',
										  'id'          => 'emp_personal_email',
										  'value'       => $list['emp_personal_email']
										);
									echo form_input($data);
	    							?>
								<span class="help-inline"><?php  echo form_error('emp_personal_email'); ?></span>
							</div>
							  </div>
							  <?php 
							   $mode;
							if($mode=='Add') {
							 ?>
							  <div class="control-group">
								 <label class="control-label" for="focusedInput">Conform Personal Email</label>
								 <div class="controls">
									<?php
									$data = array(
										  'name'        => 'emp_personal_email1',
										  'id'          => 'emp_personal_email1',
										  'value'       => $list['emp_personal_email1']
										);
									echo form_input($data);
	    							?>
								<span class="help-inline"><?php  echo form_error('emp_personal_email1'); ?></span>
							</div>
							  </div>
							  <?php } ?>
<!--    #####################################################################	Official Email Id	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Official Email</label>
								 <div class="controls">
									<?php
									$data = array(
										  'name'        => 'emp_official_email',
										  'id'          => 'emp_official_email',
										  'value'       => $list['emp_official_email'] 
										);
									echo form_input($data);
									?>
								<span class="help-inline"><?php  echo form_error('emp_official_email'); ?></span>
								</div>
							</div>
							<?php 
							$mode;
							if($mode=='Add') {
							 ?>
							
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Conform Official Email</label>
								 <div class="controls">
									<?php
									$data = array(
										  'name'        => 'emp_official_email1',
										  'id'          => 'emp_official_email1',
										  'value'       => $list['emp_official_email1'] 
										);
									echo form_input($data);
									?>
								<span class="help-inline"><?php  echo form_error('emp_official_email1'); ?></span>
								</div>
							</div>
							 <?php } ?>
<!--    #####################################################################	Employee Code	################### -->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Employee Code</label>
								        <div class="controls">
											<?php
                                            $data = array(
                                                  'name'        => 'emp_code',
                                                  'id'          => 'emp_code',
                                                  'value'       => $list['emp_code']
                                                );
                                            echo form_input($data);
                                            ?>
                                       <span class="help-inline"><?php  echo form_error('emp_code'); ?></span>
                                       </div>
							</div>		
<!--    #####################################################################	Id-Proof Type	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Id-Proof Type</label>
								 <div class="controls">
									<?php
									$options = array(
										''=>'Select',
										'1'  => 'Voter Id',
										'2'  => 'Adhar Card',
										'3'  => 'PAN Card'
									);
									echo form_dropdown('emp_idproof', $options, $list['emp_idproof'] );
									?>
								    <span class="help-inline"><?php  echo form_error('emp_idproof'); ?></span>
								</div>
							</div>
<!--    #####################################################################	Id-Proof No	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Id-Proof No</label>
                                        <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_idproof_no',
                                                  'id'          => 'emp_idproof_no',
                                                  'value'       => $list['emp_idproof_no'] 
                                                );
                                            echo form_input($data);
                                            ?>
                                        <span class="help-inline"><?php  echo form_error('emp_idproof_no'); ?></span>
                                        </div>
							</div>
<!--    #####################################################################	Blood Group	###################-->					  
							<div class="control-group">
								 <label class="control-label" for="focusedInput">Blood Group</label>
										<div class="controls">
											<?php
                                            $options = array(
                                                ''=>'Select Blood group',
                                                'A+'  => 'A+',
                                                'O+'  => 'O+',
                                                 'B+'  => 'B+',
                                                'O-'  => 'O-',
                                                 'A-'  => 'A-',
                                                'O-'  => 'O-',
                                                'AB+'  => 'AB+',
                                                'AB-'  => 'AB-'
                                            );
                                            echo form_dropdown('emp_blood_group', $options, $list['emp_blood_group'] );
                                            ?>
                                          <span class="help-inline"><?php  echo form_error('emp_blood_group'); ?></span>
                                      </div>
							  </div>
<!--    #####################################################################	Date of Join	###################-->					  
							  <div class="control-group">
								   <label class="control-label" for="eventDate">Date of Join</label>
                                          <div class="controls">
                                            <?php
                                                $data = array(
                                                      'name'        => 'emp_hire_date',
                                                      'id'          => 'emp_hire_date',
                                                      'class'		=>'input-medium datepicker',
                                                      'value'       => $list['emp_hire_date'] 
                                                    );
            
                                                echo form_input($data);
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_hire_date'); ?></span>
                                          </div>
							    </div> 
<!--    #####################################################################	Work Experience ###################	-->					  
							  
							  <div class="control-group">
									<label class="control-label" for="focusedInput">Work Experience</label>
                                        <div class="controls">
                                            <?php
                                            $data = array(
                                                  'name'        => 'emp_experience',
                                                  'id'          => 'emp_experience',
                                                  'value'       => $list['emp_experience']
                                                );
                                            echo form_input($data);
                                            ?>
                                        <span class="help-inline"><?php  echo form_error('emp_experience'); ?></span>
                                     </div>
							  </div>
<!--    #####################################################################	Past Employment History	###################-->					  
							    
							  <div class="control-group">
									<label class="control-label" for="focusedInput">Past Employment History</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'emp_past_history',
                                                      'id'          => 'emp_past_history',
                                                      'cols'        => '10',
                                                      'value'       => $list['emp_past_history']
                                                    );
                                                echo form_textarea($data);
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_past_history'); ?></span>
                                            </div>
							  </div>
<!--    #####################################################################	Salary	###################-->					  
							     
							  <div class="control-group">
									<label class="control-label" for="focusedInput">Salary</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                      'name'        => 'emp_salary',
                                                      'id'          => 'emp_salary',
                                                      'value'       => $list['emp_salary'] 
                                                    );
                                                echo form_input($data);
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_salary'); ?></span>
                                            </div>
							  </div>
<!--    #####################################################################	Higher Qualification	###################-->					  
							  
							   <div class="control-group">
									<label class="control-label" for="focusedInput">Higher Qualification</label>
                                            <div class="controls">
                                                <?php
                                                $options = array(
                                                    ''=>'Select',
                                                    '1'  => 'Post Graduation',
                                                    '2'  => 'Graduation'
                                                );
                                                echo form_dropdown('emp_qualification', $options, $list['emp_qualification'] );
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_qualification'); ?></span>
                                            </div>
							  </div>
							  
<!--    #####################################################################	Specialization	###################-->					  

							  <div class="control-group">
									<label class="control-label" for="focusedInput">Specialization</label>
                                            <div class="controls">
                                                <?php
                                                $data = array(
                                                                  'name'        => 'emp_qualify_subject',
                                                                  'id'          => 'emp_qualify_subject',
                                                                  'value'       => $list['emp_qualify_subject']
                                                             );
                                                echo form_input($data);
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_qualify_subject'); ?></span>
                                            </div>
							  </div>
<!--    #####################################################################	Employee Type	###################-->					  
     						  <div class="control-group">
									<label class="control-label" for="focusedInput">Employee Type </label>
                                            <div class="controls">
                                                <?php
                                                $options = array();
                                                $options['']='select employee type';
                                                   foreach($employee_types as $val):
                                                     $options[$val['employee_type_id']]=$val['employee_type'];
                                                   endforeach;
                                                       $js = 'id="emp_type_id"';
                                                   echo form_dropdown('emp_type_id', $options, $list['emp_type_id'],$js);
                                                  
                                                ?>
                                            <span class="help-inline"><?php  echo form_error('emp_type_id'); ?></span>
                                            </div>
							  </div>                         
<!--    ##############################################################################################################################-->					  

					 <?php if($mode=='View') { ?>
							<div class="form-actions">
							<a class="btn" href="<?php echo SITE_URL?>events/edit/id/<?php echo $list['eventID']?>"/>Edit</a>
							 </div>
							<?php } else { ?>
							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
					<?php } ?>
			</fieldset>
		</form>
	 </div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
