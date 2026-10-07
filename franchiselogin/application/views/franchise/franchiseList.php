<?php include('header.php');
/*echo "<pre>";
print_r($list);
echo "<pre>";

*/


?>
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
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> FRANCHISE</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    
<!--..............................................................SEARCH CODE............................................................................-->                    
                    
    <div class="control-group">
					<div class="controls">
                    
                            Service
                                <?php
                                       $options=array();
												/*print_r($services);*/
										$options['']='Select Services';
										foreach($services as $key=> $val):
										$options[$val['service_id']]=$val['service_name'];
										endforeach;
										echo form_dropdown('service_id',$options,isset( $service_id )?$service_id: '');
                                
                               ?>
                                 
                                Franchise Type  
                                     <?php
														$options=array();
														$options['']='Select franchise type';
														 //print_r($franchise_data);
														foreach ( $franchise_data as $key => $val ) :
														switch($key):
														case 'M':$val="Main";break;
														case 'N':$val="Sub";break;
														case 'S':$val="Other";break;
														endswitch;
														$options[$key]=$val;
														endforeach;
														
														echo form_dropdown('franchise_type', $options,isset($franchise_type )?$franchise_type: '');
                                              
										?>
                                    
                               Franchise Code  
                                    <input class="input-large focused" id="franchise_code" name="franchise_code" type="text"  value="<?php if( isset( $franchise_code ) )echo $franchise_code; ?>"  >


                                    
                                    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                                    <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>franchise/'">Reset</button>
							
					</div>
						
             </div>
                              
<!--..............................................................SEARCH CODE END............................................................................-->                    
                              
                              
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
								  
								  <th>Service</th>
								  <th>Franchise Type</th>
								  <th>Franchise Name</th>
                                  <th>Proprietary</th>
								  <th>Company Name</th>
                                  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php foreach( $list as $value ) { ?>
							<tr>
								<td><?php echo $value['service_name']; ?></td>
                                <td>
								<?php 
										switch($value['franchise_type']):
										case "M": echo "MAIN";
										break;
										case "N": echo "SUB";
										break;
										case "S": echo "SUB";
										break;
										endswitch;
								 ?>
                                  </td>
                                  <td><?php echo $value['emp_first_name']. " " . $value['emp_middle_name']. " " .$value['emp_last_name']; ?></td>
                                  <!--<td><?php //echo $value['country_name']; ?></td>
                                  <td><?php // echo $value['state_subdivision_name']; ?></td>-->
                                  <td><?php echo $value['proprietary']; ?></td>
                                  <td><?php echo $value['company_name']; ?></td>
                                  


                                  
                                  
								<td class="center">
									<!--<a class="btn btn-success" href="<?php //echo SITE_URL?>franchise/view/id/<?php //echo $value['franchise_id']; ?>" title="View">
										<i class="icon-zoom-in icon-white"></i>  
										                                            
									</a>-->
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/edit/id/<?php echo $value['franchise_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
										                                            
									</a>
									<a class="btn btn-danger" href="<?php echo SITE_URL?>franchise/changeStatus/id/<?php echo $value['franchise_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
						<?php } ?>	
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
		
<?php include('footer.php'); ?>
