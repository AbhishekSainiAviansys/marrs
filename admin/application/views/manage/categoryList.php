<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
							<!--<a href="<?php //echo SITE_URL?>blog/">List</a>-->
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?>

			<div >
            <form method="POST">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Category</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>					

					<div class="box-content">
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
                                <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                                <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>franchise/'">Reset</button>
                        </div>
                        </div>
                    <br/>
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
								  <th>Service Name</th>
								  <th>Category Key</th>
								  <th>Category Description</th>
								  <th>Created Date</th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php foreach($list as $value){ ?>	
							<tr>
                                <td><?php echo $value['service_name'] ?></td>
								<td><?php echo $value['categoryKey'] ?></td>
                                <td><?php echo $value['categoryDesc'] ?></td>
								<td class="center"><?php echo date("F d, Y",strtotime($value['createdDate'])); ?></td>
								
								<td class="center">
									<!--<a class="btn btn-success" href="<?php //echo SITE_URL?>category/view/id/<?php echo $value['category_id']; ?>" 
                                    title="View">
										<i class="icon-zoom-in icon-white"></i>  
										                                            
									</a>-->
									<a class="btn btn-info" href="<?php echo SITE_URL?>category/edit/id/<?php echo $value['category_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
										                                           
									</a>
									<a class="btn btn-danger" href="<?php echo SITE_URL?>category/changeStatus/id/<?php echo $value['category_id']; ?>" title="Delete">
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
			
			
		
<?php include('footer.php'); ?>
