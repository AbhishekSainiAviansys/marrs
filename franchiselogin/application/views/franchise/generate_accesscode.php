<?php include('header.php'); 
 ?>
			<div>
<?php echo $this->notifications->display_html();?> 
			</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>School List for Access Code Generation</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
		  </div>
					
				
					
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No New record(s) found.
					</div>
				
				
						<table class="table table-bordered">
						  <thead>
							  <tr>    
						      <th>
								     <label class="checkbox inline">
								       <input type="checkbox" id="inlineCheckbox1" value="option1" class="listCheckBoxAll"> 
								     </label>
						      </th>
                              <th>Serial No</th>
					  		  <th>School Name</th>
							  <th>School Phone</th>
							  <th>School Email</th>
							  <th>Status</th> 
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						    $i=0;
						  	foreach($list as $value){ 
							
						  ?>
							<tr>
                            <td> 
						 	    <label class="checkbox inline"> 
                                 <input name="school_id[]"  type="checkbox" 
                                       class="listCheckBoxEach commonLeftCheck" 
                                       value="<?php echo $value['school_id'] ?>">
								 </label>
								  </td>
								<td>
								<?php echo $i; ?>
								</td>
								<td><?php echo $value['school_name']; ?></td>
							
									<td class="center"><?php echo $value['school_phone']; ?></td>
									<td class="center"><?php echo $value['school_email']; ?></td>
								
						   <td class="center">
							   <span <?php if($value['school_status']=='Active') { ?> class="label label-success" <?php } ?> <?php if($value['school_status']=='Inactive') { ?> class="label label-info" <?php } ?>  ><?php echo $value['school_status'] ?></span>
						   </td>
			</tr>
						<?php 	$i++; } ?>	
					  </tbody>
					  </table> 
                       <center>
			    <button type="submit" class="btn btn-primary" id="Assign_accesscode" name="Assign_accesscode">Assign Accesscode</button>
                <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>assign_pid/'">Reset</button>
					 
		 </center>
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
		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
