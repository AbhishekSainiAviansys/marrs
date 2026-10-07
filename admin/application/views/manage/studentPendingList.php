<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span>
					</li>
					<li>
						<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>student/requests/">Requests List</a>
						<?php }else{?>
							<a href="<?php echo SITE_URL?>student/">List</a>
						<?php }?>

					</li>
				</ul>
			</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Students <?php if($type=='request'){?> Requests<?php }?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					
					<?php if(empty($plist)){?>
					
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
								  <th>
									<label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1" class="listCheckBoxAll"> 
									</label>
									</th>
								  <th>Name</th>
								 
								  <th>Gender</th>
								  <th>Date of birth</th>
								   <th>Father Name</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($plist as $value){ ?>
							<tr>
								<td>
									<label class="checkbox inline">
                                    <input name="studentID[]"  type="checkbox" class="listCheckBoxEach commonLeftCheck" value="<?php echo $value['studentID'] ?>"/>
									</label>
								</td>
								<td><?php echo $value['first_name']." " .$value['middle_name']." ".$value['last_name']; ?></td>
							
								<td class="center"><?php echo $value['gender']; ?></td>
								<td class="center"><?php echo date("F d, Y",strtotime($value['dob'])); ?></td>
									<td class="center"><?php echo $value['father_name']; ?></td>
								<td class="center">
									<a  href="<?php echo SITE_URL?>students/approve/id/<?php echo $value['student_id']; ?>" <?php if($value['status']=='Pending') { ?> class="label label-info" <?php } ?>  >Approve Now</a>
								</td>
								<td class="center">
									<a class="btn btn-danger" href="<?php echo SITE_URL?>students/delete/id/<?php echo $value['student_id']; ?>"  title="Delete">
										<i class="icon-trash icon-white"></i> 
										
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
			
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>
