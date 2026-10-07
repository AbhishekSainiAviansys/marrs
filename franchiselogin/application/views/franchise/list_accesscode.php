<?php include('header.php'); 
/*echo "<pre>";print_r($list_accesscode);exit;*/
 ?>
			<div>
<?php echo $this->notifications->display_html();?> 
			</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Access Code List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
                    
                    Enter The School Name:     <input class="input-large focused" id="school_name" name="school_name"
                           type="text" style="width: 170px; padding: 4px" value="<?php if( isset( $school_name ) )echo $school_name; ?>"  > 
                    
                    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
					<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>pid/'">Reset</button>
                      
		            </div>
					
					<?php if(empty($list_accesscode)){?>
					
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
								  <th></th>
								   <th>School Name</th>
                                   <th>School Address</th>
                                   <th>School City</th>
                                   <th>Access Code</th>
								   <th>School Phone</th>
								   <th>School Email</th>
								   <th>Status</th>
								   
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						    $i=0;
						  	foreach($list_accesscode as $value){ 
								$i++;
						  ?>
							<tr>
								<td>
								<?php echo $i; ?>
								</td>
								<td><?php echo $value['school_name']; ?></td>
                                <td><?php echo $value['school_address'].$value['school_address1']; ?></td>
                                <td><?php echo $value['school_city']; ?></td>
                                <td class="center">
                                <?php  echo $value['access_code'];   ?>	
								</td>
							
									<td class="center"><?php echo $value['school_phone']; ?></td>
									<td class="center"><?php echo $value['school_email']; ?></td>
								
						   <td class="center">
							   <span <?php if($value['school_status']=='Active') { ?> class="label label-success" <?php } ?> <?php if($value['school_status']=='Inactive') { ?> class="label label-info" <?php } ?>  ><?php echo $value['school_status'] ?></span>
						   </td>
								
							</tr>
						<?php } ?>	
					  </tbody>
					  </table> 
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
			<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
