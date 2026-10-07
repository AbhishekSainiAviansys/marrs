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
			
     <form method="POST" class="mb-5">
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
                  
						<table class="table table-bordered" id="example" width="100%">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Product List</th>
								 <th>Franchise Name</th>
                                  <th>Frcode</th>
                                 
                                  <th>Status</th>
                                   <th>Activate/Deactivate</th>
                                  <th>Actions</th>
                                  <th>Delete</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $franchise as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td width="30%"><?php //$pid = $value['product_id'];
								         $fid = $value['franchise_id'];
									$this->db->select('*');
								$this->db->from('product_allotted_fr');
								$this->db->where('franchise_id',$fid);
								$res2 = $this->db->get();
								$result2 = $res2->result_array();
							    foreach($result2 as $val){
								$this->db->select('product_name');
								$this->db->from('products');
								$this->db->where('product_id',$val['product_id']);
								$res = $this->db->get();
								$result = $res->row();
								echo $result->product_name.' , ';
							}	?></td>
                              
                                  <td><?php echo $value['franchise_code']; ?></td>
                                   <td><?php echo $value['username']; ?></td>
                                  <td><?php echo $value['status']; ?></td>
                                  <td class="" width="15%">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/status_activate/<?php echo $value['franchise_id']; ?>" title="Active/Deactive">
										Activate/Deactivate                              
									</a>
								</td>
								
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>franchise/franchiseEdit/<?php echo $value['franchise_id']; ?>" title="Edit">
										Edit                              
									</a>
								</td>
									<td class="center">
								
									<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo SITE_URL?>franchise/franchisedelete/<?php echo $value['franchise_id']; ?>" title="Delete">
										Delete                              
									</a>
								</td>
								
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					
				
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
<?php include('footer.php'); ?>
