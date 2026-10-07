<?php include('header.php');
?>

			<?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
			<?php if(!empty($this->session->flashdata('success'))) { ?>
			<div style="text-align:center;background:green;padding:12px">
			<h3 style="color:#fff"><?php echo $this->session->flashdata('success'); ?></h3>
			</div>
			<?php }?>
			
			
				<?php if(!empty($this->session->flashdata('error'))) { ?>
			<div style="text-align:center;background:red;padding:12px">
			<h3 style="color:#fff"><?php echo $this->session->flashdata('error'); ?></h3>
			</div>
			<?php }?>
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Price Code Approve List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content my-4">
                  
						<table class="table table-bordered" id="example" width="100%">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Price Code</th>
								  <th>Price</th>
                                 <th>Status</th>
                                 <th>Assign</th>
                                  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $access_code as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                                <td><?php echo $value['price_code']; ?></td>
                               
                                <!--<td><?php //echo $value['school_code']; ?></td>-->
                                <td><?php echo $value['product_price']; ?></td>
                                <td><?php echo 'Approved'; ?></td>
                                 <td><a class="btn btn-primary" href="<?php echo SITE_URL?>franchise/assignPricecodeToSchool/<?php echo $value['id']; ?>" title="Assign">
										Assign To Franchise                           
									</a></td>
							
                                <td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');" href="<?php echo SITE_URL?>franchise/price_codedlt/<?php echo $value['id']; ?>" title="Delete">
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
