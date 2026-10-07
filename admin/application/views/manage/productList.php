<?php include('header.php');
?>

			<?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Product</a> <span class="divider">/</span>
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
						<h2><i class="icon-user"></i>Product List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content mb-4">
                  
						<table class="table table-bordered" id="example"  width="100%">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Product ID</th>
								  <th>Product Name</th>
								 <th>Logo</th>
                                 <th>Status</th>
                                  
                                  <th>Activate/Deactivate</th>
                                  <th>Delete</th>
                                  
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $product as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
							
                                <td><?php echo $value['product_name']; ?></td>
                                <td><?php echo $value['product_id']; ?></td>
                                
                                
                                <td>
                                    <?php $certificate_image = $this->db->get_where('certificate_image', array('product_id' => $value['product_id']))->row(); $image = $certificate_image->image_name; ?>
                                    <?php echo $image;?>
                                    <br>
                                    
                                    <img src='https://marrs.in/student_registration/certificate_logo/<?php echo $image;?>' alt='logo' style='width:30%'> 
                                
                                </td>
                                
                               <?php  if($value['status']=='Active'){?>
                               <td><a  style="color:green"><?php echo $value['status'];?></a</td>
                               <?php }else{ ?>
                               <td><a  style="color:#b40039"><?php echo $value['status'];?></a></td>
                               <?php }?>
								<td class="center">
								    <?php  if($value['status']=='Deactive'){?>
								    <a class="btn btn-primary" href="<?php echo SITE_URL?>franchise/Activeproduct/<?php echo $value['product_id']; ?>" title="Edit">
										Activate                             
									</a>
									<?php }?>
									<?php  if($value['status']=='Active'){?>
									<a class="btn btn-primary" href="<?php echo SITE_URL?>franchise/productstatus/<?php echo $value['product_id']; ?>" title="Edit">
										Deactivate                             
									</a>
									<?php }?>
									
								</td>
								<td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');" href="<?php echo SITE_URL?>franchise/productdelete/<?php echo $value['product_id']; ?>" title="Delete">
										Delete                           
									</a></td>
							</tr>
						<?php $i++; } ?> 	
						  </tbody>
					  </table> 
					
				
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
<?php include('footer.php'); ?>
