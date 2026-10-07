<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 
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
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Competition Centers</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					
					<form method="POST">
					<div class="box-content">
			  </div>
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
                                 <th>SI.No.</th>
								  <th>center Name</th>
                                  <th>center Address</th>
								  <th>country</th>
								  <th>State</th>
								  <th>center_latitude</th>
								  <th>center_longitude</th>
								  <th>Created date</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php $i=1;foreach($list as $value){ ?>	
							<tr>
                            <td><?php echo $i; ?></td>
                                <td><?php echo $value['center_name'] ?></td>
                                <td><?php echo $value['center_address'] ?></td>
								<td><?php echo $value['country_name'] ?></td>
                                <td><?php echo $value['state_subdivision_name'] ?></td>
                               
                                <td><?php echo $value['center_latitude'] ?></td>
                                <td><?php echo $value['center_longitude'] ?></td>
								<td class="center"><?php echo date("F d, Y",strtotime($value['created_date'])); ?></td>
								
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>competitioncenter/edit/id/<?php echo $value['competition_centre_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
									</a>
                                    
							         <!--<a class="delete btn btn-danger" href="<?php //echo SITE_URL?>competitioncenter/changeStatus/id/<?php //echo $value['competition_centre_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
									</a>-->
                                    
								</td>
							</tr>
						<?php $i= $i+1; } ?>	
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
				
				
			
					
					
					
			
		
	<?php 
        include('footer.php'); 
        $this->confirmation->confirm('delete');
    ?>
		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
		<script type="text/javascript">
			function list_levels(id)
			{	
					var service_id=id;
					var data=new Object();
					data.service_id=service_id;
					$.ajax({
							  url:"<?php echo base_url();?>franchise/competitioncenter/show_levels/",
							  data:data,
							  type: 'POST',
							  success:function(result)
									  {
										$("#competition_level_id").html(result);
									   },/*end success*/
							  error:function()
										{
											alert("Failed to load ajax show_levels");	
										}/*end error*/
										
						  });/*end ajax*/
			}/*end function*/
        </script>	

