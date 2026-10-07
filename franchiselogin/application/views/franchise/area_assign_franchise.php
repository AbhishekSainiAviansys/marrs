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
         <div><?php echo $this->session->flashdata('success'); ?></div>
         <?php } ?>
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Assign AreaCode</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                  <form action="">
						<table class="table table-bordered" width="100%">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Franchise Name</th>
								 
                                  <th>State </th>
                                 
                                  <th>Franchise Code</th>
                                  <th>Price Code</th>
                                  
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php  
							    
							$i=1;foreach($franchise as $value) { ?>   
							<tr>
                                <td><?php echo $i; ?> <input type="checkbox" name="frachise[]" value="<?php echo $value['franchise_id'];?>"></td>
								 <td width="30%"><?php echo $value['username'];?></td>
                                 <td><?php  echo $this->db->get_where('states',array('state_subdivision_id'=>$value['state_id']))->row()->state_subdivision_name; ?></td>
                                 <td><?php echo $value['franchise_code']; ?></td>
                                 <td><?php echo $price_code ?></td>
                                 
                                 
								
							</tr>
						<?php $i++; } ?>
						
						  </tbody>
					  </table> 
					
				
				<input type="submit" name="submit" value="submit" class="btn-btn-priamry">
			
				</form>	
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
		
<?php include('footer.php'); ?>
