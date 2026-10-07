<?php include('header.php'); 
//echo $status.".................................";
//echo "-----".SITE_URL;
/*echo "<pre>";*/
//print_r($list);
//print_r($data);/*echo "<pre>";*/

?>
     <form method="POST">
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
						<?php echo $this->notifications->display_html();?> 
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Competition Results</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
                    

<!-- ................................ Search Options Starts...................................  -->

					<div class="control-group">
							
						 
					</div>
<!-- ................................ Search Options Ends...................................  -->
					
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
								  <th></th>
								  <th></th>
								  <th></th>
								  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php foreach($list as $value){ ?>	
							<tr>
                                <td><?php ?></td>
								<td><?php ?></td>
								<td><?php ?></td>
                                <td><?php  ?></td>
                                <td><?php ?></td>
                                <td><?php ?></td>
								
								<td class="center">
									<a class="btn btn-info" href="<?php  ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
                                     
										                                           
									</a>
									<a class="btn btn-danger" href="<?php  ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
						<?php }//end foreach ?>	
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
		
<?php  include('footer.php'); ?>
