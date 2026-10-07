<?php include('header.php');
	//echo"====================". "<pre>";print_r($stud_list);
?>


			<div>
				<ul class="breadcrumb">
					<li>
						Session:2023-24 and above<span class="divider">/</span>
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
                                <td>Period ID<br>
        				        <select name='period_id' style="width: 220px;" required>
        						<?php //$period = $this->db->get_where('period')->result(); 
        						foreach($loadperiod as $val){ ;?>
        				           <option value='<?php echo $val['period_id'];?>' <?php  if($val['period_id']==$result['period_id']) { echo 'selected="selected"'; } ?>><?php echo $val['period_name'];?></option>
        						<?php }?>
        				        </select>
        				    </td>
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
        				           <option value='<?php echo $val['id'];?>' <?php  if($val['id']==$result['school']) { echo 'selected="selected"'; } ?>><?php echo $val['school_name'];?> </option>
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
								  <th>Center Name</th>
								  <th>Exam Date</th>
                                  <th>Contact Info</th>
								  <th>School</th>
								  <th>Product Name</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($student as $value){
						  
						  $this->db->select('*');
                            $this->db->from('cin_result');
                            $this->db->where('product_name',$value['product_name']);
                            $this->db->where('clevel',$value['clevel']);
                            $this->db->where('cin',$value['cin']);
                            $query = $this->db->get();
                            $dd=$query->row();
                            
						  
						    if(!$dd->venue){
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->where('comp_id',$dd->competition_schedule_id);
                                $query = $this->db->get();
                                $ddd=$query->row();
                                if($ddd->center_name){
                                    $center= $ddd->center_name;
                                }
                                else{
                                    $this->db->select('*');
                                    $this->db->from('competition_schedule');
                                    $this->db->where('competition_schedule_id',$dd->competition_schedule_id);
                                    $query = $this->db->get();
                                    $dddd=$query->row();
                                    
                                    $center=  $dddd->center_address;
                                }
                                
						    }
						    if($dd->venue){
						        $center=  $dd->venue;
						        $close_date='';
						    }
						 
						    if(empty($center)){
						        
						                    $this->db->select('*');
                                            $this->db->from('new_cart');
                                            $this->db->where('product_name',$value['product_name']);
                                            $this->db->where('clevel',$value['clevel']);
                                            $this->db->where('cin',$value['cin']);
                                            $query = $this->db->get();
                                            $cd=$query->row();
                            //   print_r($cd->comp_date);          
						        
						                    $this->db->select('*');
                                            $this->db->from('cin_uploade');
                                            $this->db->where('cin',$value['cin']);
                                            $this->db->order_by('cin_uploade.id','DESC');
                                            $query = $this->db->get();
                                            $cp=$query->row();
						        
						        
						        $this->db->select('*');
                                $this->db->from('exam_centers');
                                $this->db->join('competition_product_state','competition_product_state.id=exam_centers.comp_id');
                                $this->db->where('exam_centers.comp_id',$cp->comp_id);
                                $this->db->where('exam_centers.exam_date',$cd->comp_date);
                                $query = $this->db->get();
                                $cds=$query->row();
                                $center=$cds->center_name;
                                
                                $close_date=$cds->exam_date;
						    }
						    
						    
						  
						  ?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td style="width:10%"><?php echo $value['cin']; ?></td>
								<td><?php echo $value['student_name']; ?></td>
								<td><?php echo $value['level_name']; ?></td>
								<td><?php echo $value['class']; ?></td>
								
								<td>
								    <?php 
								        
								            echo $center; 
								        
								    ?>
								
								</td>
								<td>
								    <?php 
								    
								    
                                            echo $close_date;
								      
								    ?>
								</td>
								
                                <td style="width:15%">
                                  Email Id : <?php echo $value['stud_email']."<br>".$value['father_email']."<br>".$value['mother_email']; ?>
                                  <br />
                                  Mobile Phone : <?php   echo $value['stud_phone'].",".$value['father_phone'].",".$value['mother_phone']; ?>
                                  <!--<br />-->
                                  <!--Land Phone :   <?php   //echo $value['std_code']."-".$value['phone']; ?>-->
                                </td>
                                <td style="width:15%">

                                    School Name :
                                
                                    <?php
                                    $school_name = !empty($value['school_name'])
                                        ? $value['school_name']
                                        : '';
                                
                                    $city = !empty($value['city'])
                                        ? $value['city']
                                        : '';
                                
                                    if (empty($school_name) || empty($city)) {
                                
                                        if (!empty($value['school_id'])) {
                                
                                            $this->db->select('school_name, city');
                                            $this->db->from('school_new');
                                            $this->db->where('id', $value['school_id']);
                                
                                            $query = $this->db->get();
                                
                                            if ($query->num_rows() > 0) {
                                
                                                $school = $query->row();
                                
                                                if (empty($school_name)) {
                                                    $school_name = $school->school_name;
                                                }
                                
                                                if (empty($city)) {
                                                    $city = $school->city;
                                                }
                                            }
                                        }
                                    }
                                
                                    echo !empty($school_name) ? $school_name : '-';
                                    ?>
                                
                                    <br />
                                
                                    School Address :
                                    <?php echo !empty($city) ? $city : '-'; ?>
                                
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