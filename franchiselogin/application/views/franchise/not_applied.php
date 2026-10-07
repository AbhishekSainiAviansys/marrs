<?php include('header.php');
	//echo"====================". "<pre>";print_r($stud_list);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Session:2021-22</a> <span class="divider">/</span>
					</li>
					<li>
						<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>student/requests/">Not Applied List</a>
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
						<h2><i class="icon-user"></i> Students <?php if($type=='request'){?> Requests<?php }?></h2>
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
                                     <option value='all' >All products</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   ?>
                                    
                                  <option value='<?php echo$row->product_name;?>'<?php  if($new_product==$row->product_name) { echo 'selected="selected"'; } ?>><?php echo $row->product_id.'-'.$row->product_name;?></option>
                                  
                                   <?php }
                                    
                                    ?>
                                    </select>
                                </td>
                                 <td>Class <br>
				        <select name="class" id="class" style="width: 180px;"  required>
				            <option value='all' <?php  if($new_class=='all') { echo 'selected="selected"'; } ?>>All Class</option>
				            <option value='Nursery' <?php  if($new_class=='Nursery') { echo 'selected="selected"'; } ?>>Nursery</option>
				            <option value='LKG' <?php  if($new_class=='LKG') { echo 'selected="selected"'; } ?>>LKG</option>
                            <option value='UKG' <?php  if($new_class=='UKG') { echo 'selected="selected"'; } ?>>UKG</option>
                            <option value='1' <?php  if($new_class=='1') { echo 'selected="selected"'; } ?>>Class-1</option>
                            <option value='2' <?php  if($new_class=='2') { echo 'selected="selected"'; } ?>>Class-2</option>      
                            <option value='3' <?php  if($new_class=='3') { echo 'selected="selected"'; } ?>>Class-3</option>
                            <option value='4' <?php  if($new_class=='4') { echo 'selected="selected"'; } ?>>Class-4</option>
                            <option value='5' <?php  if($new_class=='5') { echo 'selected="selected"'; } ?>>Class-5</option>
                            <option value='6' <?php  if($new_class=='6') { echo 'selected="selected"'; } ?>>Class-6</option>
                            <option value='7' <?php  if($new_class=='7') { echo 'selected="selected"'; } ?>>Class-7</option>
                            <option value='8' <?php  if($new_class=='8') { echo 'selected="selected"'; } ?>>Class-8</option>
                            <option value='9' <?php  if($new_class=='9') { echo 'selected="selected"'; } ?>>Class-9</option>
                            <option value='10' <?php  if($new_class=='10') { echo 'selected="selected"'; } ?>>Class-10</option>
                            <option value='11' <?php  if($new_class=='11') { echo 'selected="selected"'; } ?>>Class-11</option>
                            <option value='12' <?php  if($new_class=='12') { echo 'selected="selected"'; } ?>>Class-12</option>
                        </select>
                    </td>
				    
				
				    <!--<td>Status <br>-->
				    <!--    <select name='status' require>-->
				    <!--        <option value='No'>Unpaid</option>-->
				    <!--        <option value='Yes'>Paid</option>-->
				    <!--    </select>-->
				    <!--</td>-->
                                 
                                     
                </tr>
                             
            </table>
                        
                        
                        
                        
                       <!--    -----------  PERIOD ---------------    --> 
                        
                        <!--    -----------  FRANCHISE ---------------    -->            
							<br><br><center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
							<button class="btn" type="reset" onclick="">Reset</button></center>
						</div>
						</div>
					<?php if(empty($orientation)){?>
					
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
                                  Email Id : <?php echo $value['stud_email'].",".$value['father_email'].",".$value['mother_email']; ?>
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
								<td  style="width:15%"><?php echo $value['product_name']; ?></td>
								
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