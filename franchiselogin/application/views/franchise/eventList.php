<?php include('header.php'); ?>


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
						<h2><i class="icon-user"></i> Contents</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					<div class="box-content">
					
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
								  <th>
									<label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> 
									</label>
								  </th>
								  <th>Title</th>
								  <th>Event Date</th>
								  <th>Description</th>
								 
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php foreach( $list as $value ) { ?>
							<tr>
								<td>
									<label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1">
									</label>
								</td>
								<td><?php echo $value['eventTitle']; ?></td>
								<td class="center"><?php echo $value['eventDate']; ?></td>
								<td class="center"><?php echo $value['event']; ?></td>
								<td class="center">
									<span <?php if($value['eventStatus']=='Publish') { ?> class="label label-success" <?php } ?> <?php if($value['eventStatus']=='Draft') { ?> class="label label-info" <?php } ?> <?php if($value['eventStatus']=='Deleted') { ?> class="label label-danger" <?php } ?> ><?php echo $value['eventStatus'] ?></span>
								</td>
								<td class="center">
									<a class="btn btn-success" href="<?php echo SITE_URL?>events/view/id/<?php echo $value['eventID']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
									<a class="btn btn-info" href="<?php echo SITE_URL?>events/edit/id/<?php echo $value['eventID']; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="<?php echo SITE_URL?>events/changeStatus/id/<?php echo $value['eventID']; ?>">
										<i class="icon-trash icon-white"></i> 
										Delete
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
			
			
		
<?php include('footer.php'); ?>
