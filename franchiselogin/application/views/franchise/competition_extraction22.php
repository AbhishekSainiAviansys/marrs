<?php include('header.php');
	//echo"====================". "<pre>";print_r($stud_list);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						Session: 2022-23 <span class="divider">/</span>
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
                                 <select name="product" id="product" style="width: 220px;"  required>
                                <option >Select Product</option>
                                
                                 <?php
                                 
                                // $query = $this->db->query("SELECT * FROM products;");
                                 foreach ($productload as $row)
                                { ?>
                                 <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                             <?php  } ?>
                            </select>
                             </td>
                                        
        				    
        				    <td>Level <br>
        				        <select name='level' id='competition_level_id' style="width: 220px;" required>
        				             <option >Select level</option>
                                            
        						<?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($levelload as $val){ ;?>
        				           <option value='<?php echo $val['level_id'];?>' <?php  if($val['level_id']==$result['level']) { echo 'selected="selected"'; } ?>><?php echo $val['level_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        						
        					<td>Class <br>
        				        <select name="class" id="class" style="width: 220px;"  required>
        				            <option >All Class</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($classload as $val){ ;?>
        				           <option value='<?php echo $val['class_name'];?>' <?php  if($val['class_name']==$result['class']) { echo 'selected="selected"'; } ?>><?php echo $val['class_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        				         
        				        <td>School <br>
        				        <select name="school" id="school" style="width: 220px;"  >
        				            <option value=''>All school</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($schoolload as $val){ ;?>
        				           <option value='<?php echo $val['school_name'];?>' <?php  if($val['school_name']==$result['school']) { echo 'selected="selected"'; } ?>><?php echo $val['school_name'];?> </option>
        						<?php } ?>
        				        </select></td> 
        				    
        				        
        				             <td>
        				                <center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
        							<!--<button class="btn" type="reset" onclick="">Reset</button></center>-->
        				             </td> 
                            </tr> 
                        </table>
                        
                        
                        
                        
                       <!--    -----------  PERIOD ---------------    --> 
                        
                        <!--    -----------  FRANCHISE ---------------    -->            
							
						</div>
						</div>
					<?php if(!empty($student)){  
				
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
								  <th>Level </th>
								  <th>Class</th>
                                  <th>Contact Info</th>
								  <th>School</th>
								  <th>Product Name</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($student as $value){ ?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td style="width:10%"><?php echo $value['cin']; ?></td>
								<td><?php echo $value['student_name']; ?></td>
								<td><?php echo $value['level_name']; ?></td>
								<td><?php echo $value['class']; ?></td>
                                <td style="width:15%">
                                  Email Id : <?php echo $value['stud_email']."<br>".$value['father_email']."<br>".$value['mother_email']; ?>
                                  <br />
                                  Mobile Phone : <?php   echo $value['stud_phone'].",".$value['father_phone'].",".$value['mother_phone']; ?>
                                 
                                </td>
                                <td  style="width:15%">
                                    School Name : <?php echo $value['school_name']; ?>
                                  <br />
                                    School Address : <?php   echo $value['school_address']; ?>
                                  </td>
								<td  style="width:15%"><?php echo $result['product'];
								
								?></td>
								
        
							</tr>
						<?php $i=$i+1;} ?>	
					  </tbody>
					  </table> 
					
			<?php }?>
            <div id="error_div">
                <h4 style='color:crimson;'>
                <?php
                if(!empty($message)){
                    echo $message;
                }
                ?>
                </h4>
            </div>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/library/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#product").change(function() {
        var product_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url:"<?php echo base_url();?>franchise/ajax/productwiselevel_/",
            data: {product_id: product_id},
            type: 'post',
            success: function(result) {
                $("#competition_level_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
	
		
		
		
<?php include('footer.php'); ?>