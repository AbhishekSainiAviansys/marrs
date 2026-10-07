<?php include('header.php'); ?>
<form method="POST">
<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Title</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> TItle</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>

			</div>
			<br/>
			<div class="controls">
				   Service
							<?php
                              $options=array();
										$options['']='Select Services';
										foreach($services as $key=> $val):
										$options[$val['service_id']]=$val['service_name'];
										endforeach;
										echo form_dropdown('service_id',$options,isset( $service_id )?$service_id: '');      
                     ?>
			    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
             <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>title/index/'">Reset</button>
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
								  <th>SI.NO</th>
								  <th>Service Name</th>
								  <th>Title</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php  $i=0; foreach($list as $value) {   $i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td class="center"><?php echo $value['service_name'];  ?></td>
								<td class="center"><?php echo $value['title']; ?></td>
								<td class="center">
									
									<a class="btn btn-info" href="<?php echo SITE_URL?>title/edit/id/<?php echo trim($value['title_id']); ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="delete btn btn-danger" href="<?php echo SITE_URL?>title/changeStatus/id/<?php echo trim($value['title_id']); ?>">
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
			
			</form>
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
