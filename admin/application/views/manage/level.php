<?php include('header.php'); ?>
		<?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3 ">
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
						<h2><i class="icon-user"></i> Competition Levels List</h2>
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
								  <th>Level Name</th>
								  <!--<th>Period Name</th>-->
                                  <th>Status</th>
                                  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $level as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                                <td><?php echo $value['level_name']; ?></td>
                               
                                <!--<td><?php //echo $value['period_year']; ?></td>-->
                                <td><?php echo $value['status']; ?></td>
                               
                               <td><button type="submit" id="submit" name="submit" class="btn btn-primary" value='<?php echo $value['id']; ?>'> <?php if($value['status']=='Active'){echo 'Deactivate';}else{echo'Activate';} ?></button></td> 
                                <!--<td><a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');" href="<?php echo SITE_URL?>franchise/price_codedlt/<?php echo $value['id']; ?>" title="Delete">-->
										<!--Delete                           -->
									<!--</a></td>-->
							
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					
					<!--<div class="pagination pagination-left">-->
					<!--	 <ul>-->
					<!--		<li><a href="#">Prev</a></li>-->
					<!--		<li><a href="#">1</a></li>-->
					<!--		<li><a href="#">2</a></li>-->
					<!--		<li><a href="#">3</a></li>-->
					<!--		<li><a href="#">4</a></li>-->
					<!--		<li><a href="#">5</a></li>-->
					<!--		<li><a href="#">Next</a></li>-->
					<!--	  </ul>-->
					<!--</div>-->
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
			
<?php include('footer.php'); ?>