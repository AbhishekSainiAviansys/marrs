<?php include('header.php');
?>
			<?php //echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="">List</a>
					</li>
				</ul>
			</div>
			
				<?php if($this->session->flashdata('success')){ ?>
         <div><h3 style="padding: 13px;color: #3c763d; background-color: #dff0d8;border-color: #d6e9c6;"><?php echo $this->session->flashdata('success'); ?></h3></div>
         <?php } ?>
		
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> AreaCode</h2>
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
								  <th>Area Name</th>
								 
                                  <th>Area Code</th>
                                 
                                  <th>State</th>
                                  <th>country</th>
                                  <th>Actions</th>
                                  <th>Delete</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php  
							    
							$i=1;foreach($result as $value) { ?>   
							<tr>
                                <td><?php echo $i; ?></td>
								 <td width="30%"><?php echo $value['city_name'];?></td>
                                 <td><?php echo $value['area_code']; ?></td>
                                 <td><?php echo $value['state_subdivision_name']; ?></td>
                                 <td><?php echo $value['country_name']; ?></td>
                                 
                                 	<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/area_assign_franchise/<?php echo $value['id']; ?>" title="Edit">
										Assign                              
									</a>
								</td>
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/AreaEdit/<?php echo $value['id']; ?>" title="Edit">
										Edit                              
									</a>
								</td>
									<td class="center">
								
									<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo SITE_URL?>franchise/AreaDelete/<?php echo $value['id']; ?>" title="Delete">
										Delete                              
									</a>
								</td>
								
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
