<?php include('header.php'); 
//echo "-----".SITE_URL;
/*echo "<pre>";
print_r($selfie_list);exit;*/
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
						<h2><i class="icon-user"></i> Slfie List</h2>
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
						
					<?php if(empty($selfie_list)){?>
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
                                  <th>Sno</th>
                                  <th>CIN</th>
								  <th>Name</th>
								  <th>School</th>
                                  <th>State</th>
                                  <th>Action</th>

							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php $i=1;foreach($selfie_list as $value){ ?>	
							<tr>
                                <td><?php echo $i ;?></td>
                                <td><?php echo $value['cin'] ;?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['school']; ?></td>
                                <td><?php echo $value['state']; ?></td>
								
								<td class="center">
									<a class="btn btn-info" href="<?php echo SITE_URL?>selfie_contest/edit/id/<?php echo $value['selfie_contest_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
                                     
										                                           
									</a>
									<a class="btn btn-danger" href="<?php echo SITE_URL?>selfie_contest/changeStatus/id/<?php echo $value['selfie_contest_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
						<?php  $i=$i+1;}//end foreach  ?>	
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
