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
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> PriceCode List</h2>
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
								 
								  <th>Price Code</th>
								  <th>Franchise Code</th>
								  <th>Franchise Username</th>
                                 <th>Status</th>
                                  <th>Price</th>
                                  <th>Status</th>
                                  
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $access_code as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
							
                                <td><?php echo $value['price_code']; ?></td>
                                <td><?php 
                                
                                $sid = $value['franchise_id'];
								
								 $this->db->select('franchise_code');
                        		 $this->db->from('franchise');
                        		 $this->db->where('franchise_id',$sid);
                        		 $query = $this->db->get(); 
                        	     $que = $query->row(); 
								echo $que->franchise_code;
                                
                                
                                
                                
                                
                                ?></td>
                                <td> <?php
                                $sid = $value['franchise_id'];
								
								 $this->db->select('username');
                        		 $this->db->from('franchise');
                        		 $this->db->where('franchise_id',$sid);
                        		 $query = $this->db->get(); 
                        	     $que = $query->row(); 
								echo $que->username;?></td>
                                <td><?php echo 'Pending'; ?></td>
                                <td><?php echo $value['product_price']; ?></td>
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/pricecodestatus/<?php echo $value['franchise_id']; ?>/<?php echo $value['product_price']; ?>" title="Edit">
										Apporval                              
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
