<?php include('header.php'); 
//echo "-----".SITE_URL;
/*echo "<pre>";*/
//print_r($list);
//print_r($data);/*echo "<pre>";*/

?>
     <form method="POST">
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Download List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
                    
<!-- ................................ Search Options Starts...................................  -->
					<div class="control-group">
						<div class="controls">
						Service:
											<?php
                                            $options = array();
                                            $options['']='--select--';
                                               foreach($departments as $val):
                                                 $options[$val['department_id']]=$val['department_name'];
                                               endforeach;
                                                 if(isset($emp_dept_id))
												 { 
                                                 	echo form_dropdown('emp_dept_id', $options,$emp_dept_id ,'id="emp_dept_id"');
												 }
												 else
												 {
                                                 	echo form_dropdown('emp_dept_id', $options,'' ,'id="emp_dept_id" style="size:5px"');
												 }
                                            ?>
						 
			     		Period:
											<?php
											
											     if(isset($emp_first_name))
												 { 
                                                 	$value=$emp_first_name;
												 }
												 else
												 {
                                                 	$value="";
												 }

                                                $emp_name_data = array(
																		'name' => 'emp_first_name',
																		'id' => 'emp_first_name',
																		'value' => $value);
                                                echo form_input($emp_name_data);
                                            ?>
                                            
                        Competition Level :
                                            <?php
                                              $emp_status_options = array();
                                              $emp_status_options['']='--select--';
                                              foreach($emp_status as $key  => $val):
                                                 $emp_status_options[$val]=$val;
                                              endforeach;
                                                 if(isset($status))
												 { 
                                                 	echo form_dropdown('status', $emp_status_options,$status ,'id="status"');
												 }
												 else
												 {
                                                 	echo form_dropdown('status', $emp_status_options,'' ,'id="status"');
												 }
											  
                                            ?>
							    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
								<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>employee/'">Reset</button>
							
						</div>
					</div>
<!-- ................................ Search Options Ends...................................  -->						
						
					<?php if(empty($list)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else{
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
								  <th>Name</th>
								  <th>Department</th>
								  <th>Employee Type</th>
								  <th>Employee Code</th>
                                  <th>Email Id</th>
                                  <th>Contact No</th>
                                  <th></th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php foreach($list as $value){ ?>	
							<tr>
                                <td><?php echo $value['emp_first_name'] ." ".$value['emp_middle_name']." ".$value['emp_last_name'];?></td>
								<td><?php echo $value['department_name']; ?></td>
								<td><?php echo $value['employee_type']; ?></td>
                                <td><?php echo $value['emp_code']; ?></td>
                                <td><?php echo $value['emp_personal_email']." , ".$value['emp_official_email'];?></td>
                                <td><?php echo $value['emp_mobile']." , ".$value['emp_phone'];?></td>
								
								<td class="center">
									<a class="btn btn-info" href="<?php echo SITE_URL?>employee/edit/id/<?php echo $value['emp_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
                                     
										                                           
									</a>
									<a class="btn btn-danger" href="<?php echo SITE_URL?>employee/changeStatus/id/<?php echo $value['emp_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
						<?php }//end foreach ?>	
						  </tbody>
					  </table> 
					  <?php } ?>
					<div class="pagination pagination-left">
						 <ul>
                        	<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
					</div>
				
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
	</form>		
		
<?php  include('footer.php'); ?>
