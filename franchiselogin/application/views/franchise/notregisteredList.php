<?php include('header.php');?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>registration/">Not Registered</a> <span class="divider">/</span>
					</li>
					<li>
						<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>registration/requests/">Requests List</a>
						<?php }else{?>
							<a href="<?php echo SITE_URL?>registration/">List</a>
						<?php }?>

					</li>
				</ul>
			</div>
			
			<?php echo $this->notifications->display_html();?> 
<form method="POST">
		<div>		
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                    <h2><i class="icon-user"></i> Not Registered List <?php if($type=='request'){?> Requests<?php }?></h2>
                    <div class="box-icon">
                                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
			        </div>
		       <div class="box-content">
<!--..............................................................SEARCH CODE............................................................................-->                    
                    
    <div class="control-group">
					<div class="controls">
                    
                            <table  cellpadding="5px" >
                            <tr>
                             <td>Service:<br />
                             <?php
								  $options=array(""=>"Select");
							     foreach($services as $servicesval)
								  {
                                      $names=$servicesval['service_name'];
                                      $id=$servicesval['service_id'];
								      $options[$id] = $names;
	                              }
								  $js = 'onChange="list_details(this.value)"';
								  echo form_dropdown('service_id', $options,isset( $service_id )?$service_id: '',$js);
								?>
                             </td>
                             </tr>
                             <tr id="tr_details" >
                                <?php include('non_list.php');?>
                             </tr> 

                                </table>
                                    
                                    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                                    <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>franchise/'">Reset</button>
							
					</div>
						
             </div>
                              
<!--..............................................................SEARCH CODE END............................................................................--> 
<?php // if(isset($info) && $info!='' )
if($info=="empty")

 { ?>
	
 <div class="notifications">
 <div class="alert alert-info " id="notification-bar">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<h4 class="alert-heading">Information!</h4>
		<p style="color:#F00">The fields Service , Period  & Competition Levels are mandatory</p>
</div>
</div>
<?php
 } ?>


<?php if(empty($list))
//if($info=="nodata")

{?>

<div class="notifications">
 <div class="alert alert-info" id="notification-bar">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4 class="alert-heading">Information!</h4>
		 <strong>No record(s) found.</strong> 
</div>
</div>
<?php
}
else
{
?>
					
						<table class="table table-bordered">
						  <thead>
							  <tr>
								  
								    <th>Serial No</th>
								    <th>CIN</th>
								    <th>Name</th>
                                    <th>Category</th>
								    <th>School</th>
                                    <th>Actions</th>
                                   
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						       $i=1;
						      foreach($list as $value){ 
						  ?>
                         
							<tr>
								    <td><?php echo $i++; ?></td>
								    <td class="center"><?php echo $value['cin']; ?></td>
									<td class="center"><?php echo $value['first_name'].$value['middle_name'].$value['last_name']; ?></td>
                                    <td class="center"><?php echo $value['categoryKey']; ?></td>
                                    <td class="center"><?php echo $value['school_name']; ?></td>
                                    <td class="center">
									<a class="btn btn-success" href="<?php echo SITE_URL?>registration/view/unreg_id/
									<?php echo $value['schedule_to_student_id']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
                                    </td>
						 </tr>
						<?php } ?>	
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
			<?php }?>
					</div>
				</div><!--/span-->
			
		</div>	
				
		</form>
		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			<script type="text/javascript">
			function list_details(id)
			{	
						//alert("88888888888");
						var service_id=$("#service_id").val();
						var service_id=id;
						alert("<?php echo base_url();?>franchise/registration/noregistered_listDetails/");
							var data=new Object();
							data.service_id=service_id;
							//alert(data.service_id);
							
							$.ajax({
								url:"<?php echo base_url();?>franchise/registration/noregistered_listDetails/",
								data:data,
								type: 'POST',
								success:function(result){
									
									//alert("xchjhfv"+result);
									
									$("#tr_details").html("");
									$("#tr_details").html(result);
									},//end success*/
									
								error:function()
									{
										alert("Failed to load ajax noregistered_listDetails");	
									}//end error
									
							});//end ajax*/
				}
					//});//end function
					
					
	
            </script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>