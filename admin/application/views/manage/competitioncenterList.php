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
						<h2><i class="icon-user"></i> Category</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					
					<form method="POST">
					<div class="box-content">
					<div class="control-group">
						<div class="controls">
				   Franchise
							<?php
								$options=array(""=>"Select");
							foreach($franchise as $franchiseval) {
                        $name=$franchiseval['franchise_code'];
                          $id=$franchiseval['franchise_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('fr_id', $options, isset( $fr_id )?$fr_id: '');
						
								?>
						 
			     	Country
							<?php
							$js = 'id="country_id"';
								$options=array(""=>"Select");
							foreach($countries as $countriesval) {
                        $name=$countriesval['country_name'];
                          $id=$countriesval['country_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('country_id', $options, isset( $country_id )?$country_id: '',$js);
						
								?>
										State
							<?php
							$js = 'id="stateID"';
							
								$options=array(""=>"Select");
							foreach($stateatload as $stateval) {
                        $name=$stateval['state_subdivision_name'];
                          $id=$stateval['state_subdivision_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('stateID', $options, isset( $stateID )?$stateID: '',$js);
						
								?>
								
							<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
								<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>competitioncenter/'">Reset</button>
						</div>
						
							
								
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
								  <th>center Name</th>
								  <th>country</th>
								  <th>State</th>
								  <th>franchise</th>
								  <th>center_latitude</th>
								  <th>center_longitude</th>
								  <th>Created date</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php foreach($list as $value){ ?>	
							<tr>
                                <td><?php echo $value['center_name'] ?></td>
								        <td><?php echo $value['country_name'] ?></td>
                                <td><?php echo $value['state_subdivision_name'] ?></td>
                                <td><?php echo $value['franchise_code'] ?></td>
                                <td><?php echo $value['center_latitude'] ?></td>
                                <td><?php echo $value['center_longitude'] ?></td>
								<td class="center"><?php echo date("F d, Y",strtotime($value['created_date'])); ?></td>
								
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>competitioncenter/edit/id/<?php echo $value['competition_centre_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
										                                           
									</a>
							<a class="delete btn btn-danger" href="<?php echo SITE_URL?>competitioncenter/changeStatus/id/<?php echo $value['competition_centre_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>
						<?php } ?>	
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
			
			
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
	<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			<script type="text/javascript">
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
             url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	
	
 </script>
