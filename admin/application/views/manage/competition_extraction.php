<?php include('header.php');
	//echo"====================". "<pre>";print_r($stud_list);
?>


			<div>
				<ul class="breadcrumb">
					<li>
Session:2023-above
					</li>
					<li>
						<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>student/requests/">orientation List</a>
						<?php }else{?>
							<a href="<?php echo SITE_URL?>student/">List</a>
						<?php }?>

					</li>
				</ul>
			</div>
<?php echo $this->notifications->display_html();?> 
		<form id="search_form" method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Students Registered for Competition<?php if($type=='request'){?> Requests<?php }?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
						<div class="controls">
                         <table  cellpadding="5px" >
                            <tr>
                                 <td>Product:<br />
                                     <select name="product" id="product" style="width: 300px;"  required>
                                    <option >select Product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products;");
                                    
                                     foreach ($productload as $row)
                                    { ?>
                                     <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                                 <?php  }
                                    
                                    ?>
                                </select>
                                 </td>
                                 <td>Period  <br>
				        <select name="period_id" id="period_id" style="width: 160px;"  required>
				            <option value='' <?php  if($result['class']=='') { echo 'selected="selected"'; } ?>>All Class</option>
				            <?php $period = $this->db->get_where('period')->result(); 
    						foreach($loadperiod as $val){ ;?>
    				           <option value='<?php echo $val['period_id'];?>' <?php  if($val['period_id']==$result['period_id']) { echo 'selected="selected"'; } ?>><?php echo $val['period_name'];?></option>
    						<?php }?>
                        </select>
                    </td>
				    <td>Class<br>
				        <select name='class' style="width: 160px;" require>
						<?php $period = $this->db->get_where('period')->result(); 
						foreach($classload as $val){ ;?>
				           <option value='<?php echo $val['class'];?>' <?php  if($val['class']==$result['class']) { echo 'selected="selected"'; } ?>><?php echo $val['class'];?></option>
						<?php }?>
				        </select></td>
				  <td>Level <br>
				        <select name='level' style="width: 160px;" require>
						<?php $level = $this->db->get_where('competition_levels')->result(); 
						foreach($level as $val){ ;?>
				           <option value='<?php echo $val->id;?>' <?php  if($val->id==$level) { echo 'selected="selected"'; } ?>><?php echo $val->level_name;?> </option>
						<?php } ?>
				        </select></td>
						
						 <td>State <br>
				        <select name='state_id' style="width: 160px;" require>
						<?php $state = $this->db->get_where('states',array('country_id'=>'105'))->result(); 
						foreach($state as $val){ ;?>
				           <option value='<?php echo $val->state_subdivision_id;?>' <?php  if($val->state_subdivision_id==$state_id) { echo 'selected="selected"'; } ?>><?php echo $val->state_subdivision_name;?> </option>
						<?php } ?>
				        </select></td>
						
				    <td>Competiton Status<br>
				        <select name='status' require>
				           <option value='Paid'  <?php  if($new_status=='Paid') { echo 'selected="selected"'; } ?>> Registered</option>
				            <option value='Unpaid'  <?php  if($new_status=='Unpaid') { echo 'selected="selected"'; } ?>>Not Registered</option>
				        </select>
				    </td>
                                 
                                     
                </tr>
                             
            </table>
                        
                        
                        
                        
                       <!--    -----------  PERIOD ---------------    --> 
                        
                        <!--    -----------  FRANCHISE ---------------    -->            
							<br><br><center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
							<button class="btn" type="reset" onclick="">Reset</button></center>
						</div>
						</div>
					<?php if(empty($orientation)){  ?>
					
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else{
					$i=1;
					?>
                      <div align="right"> 
                      <input type="text" name="new_class" value="<?php echo $new_class; ?>" style='display:none;'/>
                      <input type="text" name="new_product" value="<?php echo $new_product; ?>" style='display:none;'/>
                      <input type="text" name="new_status" value="<?php echo $new_status; ?>" style='display:none;' />
                     
                      <button type="submit" class="btn btn-primary" id="Export" name="Export"> Export Excel</button></div>
                      <!--onclick="get_csv();--->
						<table class="table table-bordered">
						  <thead>
							  <tr>
                                  <th>SNo</th>
								  <th>CIN</th>
								  <th>Name</th>
								  <th>Class</th>
                                  <th>Contact Info</th>
								  <th>School</th>
								  <th>Product Name</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($orientation as $value){ ?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td style="width:10%"><?php echo $value['cin']; ?></td>
								<td><?php echo $value['student_name']; ?></td>
								<td><?php echo $value['class']; ?></td>
                                <td style="width:15%">
                                  Email Id : <?php echo $value['stud_email']."<br>".$value['father_email']."<br>".$value['mother_email']; ?>
                                  <br />
                                  Mobile Phone : <?php   echo $value['stud_phone'].",".$value['father_phone'].",".$value['mother_phone']; ?>
                                  <!--<br />-->
                                  <!--Land Phone :   <?php   //echo $value['std_code']."-".$value['phone']; ?>-->
                                </td>
                                <td  style="width:15%">
                                    School Name : <?php echo $value['school_name']; ?>
                                  <br />
                                    School Address : <?php   echo $value['school_address1']; ?>
                                  </td>
								<td  style="width:15%"><?php  print_r($value['product_name']); ?></td>
								
        <!--                        <td class="center">-->
        <!--                         <a class="btn btn-success" href="<?php echo SITE_URL?>students/view/id/<?php echo $value['student_id']; ?>" title="View" target="_blank">-->
								<!--		<i class="icon-zoom-in icon-white"></i> -->
								<!-- </a>-->
									
								<!-- <a class="btn btn-info" href="<?php echo SITE_URL?>students/edit/id/<?php echo $value['student_id']; ?>" title="Edit">-->
								<!--		<i class="icon-edit icon-white"></i>  -->
								<!-- </a>-->
								
        <!--                        <a class="delete btn btn-danger" href="<?php echo SITE_URL?>students/delete/id/<?php echo $value['student_id']; ?>" title="Delete">-->
								<!--		<i class="icon-trash icon-white"></i> -->
								<!--</a>-->
								<!--</td>-->
							</tr>
						<?php $i=$i+1;} ?>	
					  </tbody>
					  </table> 
					
			<?php }?>
            <div id="error_div"></div>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>