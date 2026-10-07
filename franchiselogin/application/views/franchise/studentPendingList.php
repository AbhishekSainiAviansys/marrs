<?php include('header.php');  /*echo "<pre>"; print_r($plist);exit;*/ ?>
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
					$i=1;
					?>
					<br />
                      	<div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export">Export as Excel</button></div>
                        <br />
						<table class="table table-bordered">
						  <thead>
							  <tr>
								  <th style="background-color: #B9B9B9" >Sl No.</th>
                                  <th style="background-color: #B9B9B9">First Time <br/>Registration Code</th>
								  <th style="background-color: #B9B9B9">Name</th>
								  <th style="background-color: #B9B9B9">Address</th>
                                  <th style="background-color: #B9B9B9">Class</th>
                                  <th style="background-color:#B9B9B9">Category</th>
								  <th style="background-color:#B9B9B9">School Name <br /> & Addtress</th>
                                  <!--<th style="background-color:#B9B9B9">Student Emailid</th>
                                  <th style="background-color:#B9B9B9">Student Contact No</th>-->
								  <th style="background-color:#B9B9B9">Register Date</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($plist as $value){ ?>
							<tr>
                            <td class="center"><?php echo $i; ?></td>
                            <td class="center"><?php echo $value['tac_number']; ?></td>
								<td><?php echo $value['first_name']." " .$value['middle_name']." ".$value['last_name']; ?></td>
								<td class="center"><?php echo $value['communication_address'];?></td>
                                 <td class="center"><?php echo $value['class_key']; ?></td>      
                                 <td class="center"><?php echo $value['categoryKey']; ?></td>
								 <td class="center"><?php echo $value['school_name']."\n".$value['school_address']."\n".$value['school_address1']; ?></td>
								<!--<td class="center"><?php /*echo $value['father_email']; ?></td>
                                <td class="center"><?php echo $value['std_code']." ". $value['phone'];*/ ?></td>-->
								<td class="center"><?php echo $value['created_date']; ?></td>		
							</tr>
						<?php $i++;} ?>	
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
