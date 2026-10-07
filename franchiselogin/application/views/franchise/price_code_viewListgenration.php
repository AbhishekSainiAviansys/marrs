<?php include('header.php');
?>
			<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="">List</a>
					</li>
				</ul>
			</div>
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> PricecodeView</h2>
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
								  
								  <th>Price code</th>
								  <th>Period</th>
                                 <th>Level</th>
                                 <th>Status</th>
                                 <th>Price</th>
                                 <th>Option</th>
                                
                                  
                                  
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $code as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                                <td><?php echo $value['price_code']; ?></td>
                                <td><?php 
                                
                                $sid = $value['school_id'];
								
								 $this->db->select('*');
                        		 $this->db->from('period');
                        		 $this->db->where('status','Active');
                        		 $query = $this->db->get(); 
                        	     $que = $query->row(); 
								echo $que->academic_year;
                                
                                
                                
                                
                                
                                ?></td>
                                <td><?php echo 'Level'.'-'.$value['level']; ?></td>
                                <td><?php echo 'Apporved'; ?></td>
                                <td> Rs <?php echo $value['product_price']; ?></td>
                                <td>
                                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo SITE_URL?>school/pricecodedelete/<?php echo $value['id']; ?>" title="Delete">
										Delete                              
								</a></td>
							
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
