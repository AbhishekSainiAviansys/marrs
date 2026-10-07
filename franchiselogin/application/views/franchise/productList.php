<?php include('header.php'); //print_r($franchise);die;?>
			<div>
				 <ul class="breadcrumb">
            <li><a>Product</a><span class="divider">/</span></li>
            <li><a>View Files</a></li>
        </ul>
			</div>
			
		<form method="POST">
			<div>					<?php echo $this->notifications->display_html();?>
	
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Product List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
                        </div>
							  </div>
					<?php
					
					?>
					
						<table class="table table-bordered">
						  <thead>
							  <tr>
								 
                                  <th>SL No.</th>
								 
                                  <th>Product Name</th>
								  
								  <th>Status</th>
                                  <th>School Name</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php $i=0;foreach($productList as $value){ //print_r($value);die; ?>
							<tr>
                                <td><?php echo $i+1; ?></td>
							
                                <td class="center"><?php echo $value['product_name']; ?></td>
							     
                                <td class="center"><?php echo $value['status']; ?></td>
                                <td class="center"><?php echo $value['school_id']; ?></td>
							</tr>
						<?php $i++;} ?>	
					  </tbody>
					  </table> 
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>