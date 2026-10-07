<?php include('header.php');
?>
			<?php echo $this->notifications->display_html();?> 
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
                  
						<table class="table table-bordered" width="100%">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Franchise Name</th>
								 
                                  <th>Frcode</th>
                                 <th>Franchise Access Code Zoomzoom</th>
                                  <th>Status</th>
                                   
                                  <th>Action</th>
                                  <!--<th>Delete</th>-->
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $franchise as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td width="30%"><?php echo $value['franchise_name']; ?></td>
                              
                                  <td><?php echo $value['franchise_code']; ?></td>
                                   <td><?php echo $value['zoomzoom_access_code']; ?></td>
                                  <td><?php echo $value['status']; ?></td>
                                  <td class="" width="15%">
                                      
                                     	<a class="btn btn-danger" onclick="return confirm('Are you sure you want to change status of this item?');" href="<?php echo SITE_URL?>franchise/zoomfranchisedelete/<?php echo $value['id']; ?>" title="Delete"><?php if($value['status']=='Active'){echo 'Deactivate';}else{echo 'Activate';} ?> 
								 
                                      
								    <!--<button type='submit' name='allow' class='btn btn-info' value='<?php echo $value['id'].'.'.$value['status']; ?>'> <?php if($value['status']=='Active'){echo 'Deactive';}else{echo 'Active';} ?>  </button>-->
									<!--<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/status_activate/<?php echo $value['franchise_id']; ?>" title="Active/Deactive">-->
									<!--	Activate/Deactivate                              -->
									<!--</a>-->
								</td>
								
								<!--<td class="center">-->
								
									<!--<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/franchiseEdit/<?php echo $value['franchise_id']; ?>" title="Edit">-->
									<!--	Edit                              -->
									<!--</a>-->
								<!--</td>-->
									<!--<td class="center">-->
								
									<!--<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo SITE_URL?>franchise/franchisedelete/<?php echo $value['franchise_id']; ?>" title="Delete">-->
									<!--	Delete                              -->
									<!--</a>-->
								<!--</td>-->
								
							</tr>
						<?php $i++; } ?>	
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
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
		
<?php include('footer.php'); ?>