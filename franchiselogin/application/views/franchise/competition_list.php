<?php include('header.php');?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>registration/">View Competition</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<!--<h2><i class="icon-edit"></i> View Registration Deatails</h2>-->
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
                    
                    
                    <div >
                        <form method='POST'>
                         <table  cellpadding="5px" >
                            <tr>
                                
                                <td>Period<br>
        				        <select name='period_id' style="width: 220px;" required>
        				            <option value=''>-- Select Period --</option>
        						<?php //$period = $this->db->get_where('period')->result(); 
        						
        						foreach($loadperiod as $val){ ;?>
        				           <option value='<?php echo $val['period_id'];?>' <?php  if($val['period_id']==$result['period_id']) { echo 'selected="selected"'; } ?>><?php echo $val['period_name'];?></option>
        						<?php }?>
        				        </select>
        				    </td>
                             <td>Product:<br />
                                 <select name="product" id="product" style="width: 220px;"  >
                                <option value=''>-- Select Product --</option>
                                
                                 <?php
                                 
                                // $query = $this->db->query("SELECT * FROM products;");
                                foreach ($load_product as $row)
                                { ?>
                                 <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                                <?php  } ?>
                            </select>
                             </td>
                                        
        				    
        				    <td>Level<br>
        				        <select name='level' id='competition_level_id' style="width: 220px;" >
        				             <option value=''>-- Select level --</option>
                                            
        						<?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($load_level as $val){ ;?>
        				           <option value='<?php echo $val['level_id'];?>' <?php  if($val['level_id']==$result['level']) { echo 'selected="selected"'; } ?>><?php echo $val['level_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        						
        					<!--<td>Class <br>-->
        				 <!--       <select name="class" id="class" style="width: 220px;"  required>-->
        				 <!--           <option >All Class</option>-->
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						    foreach($classload as $val){ ;?>
        				           <!--<option value='<?php echo $val['class_name'];?>' <?php  if($val['class_name']==$result['class']) { echo 'selected="selected"'; } ?>><?php echo $val['class_name'];?> </option>-->
        						<?php } ?>
        				        <!--</select></td>-->
        				         
        				  <!--      <td>School <br>-->
        				  <!--      <select name="school" id="school" style="width: 220px;"  >-->
        				  <!--          <option value=''>All school</option>-->
        				            <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						        foreach($schoolload as $val){ ;?>
        				  <!--         <option value='<?php echo $val['id'];?>' <?php  if($val['id']==$result['school']) { echo 'selected="selected"'; } ?>><?php echo $val['school_name'];?> </option>-->
        						    <?php } ?>
        				  <!--      </select></td>      -->
        				             <td>
        				                <center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
        							<!--<button class="btn" type="reset" onclick="">Reset</button></center>-->
        				             </td> 
                            </tr>
                             
                        </table>
                        </form>
                    </div>    
                    
<!--******************************START DIV FOR SHOW DATA*********************************************-->     
               
					<div class="box-content">
					    
					    <?php if(isset($message) && !empty($message)){ ?>
                            <h3>
                                <?php echo $message; ?>
                            </h3>
                        
                        <?php } ?>
                        
					    <?php if(!empty($registration_details)){ ?>
					    <table class="table table-bordered">
						  <thead>
							    <tr>
							        <th>
							            Sr. No
							        </th>
							        <th>
							            Schedule ID
							        </th>
							        <th>
							            Product Name
							        </th>
							        <th>
							            Level
							        </th>
							        <!--<th>-->
							        <!--    Exam Centers-->
							        <!--</th>-->
							        <th>
							            Session
							        </th>
							        <th>
							            Study Material Details
							        </th>
							        <th>
							            Orientation Details
							        </th>
							        <th>
							            Mock Test Details
							        </th>
							        <th>
							            Combo Details
							        </th>
							        <th>
							            Exam Centers
							        </th>
					            </tr>
						  </thead>   
						  <tbody>
        					    <?php $i=1;
        					    foreach($registration_details as $registration_details){ // print_r($registration_details);die; ?>
        						<!--<form class="form-horizontal" method="POST" enctype= "multipart/form-data">-->
        						<!--	<fieldset>-->
							    
                                <tr>
                                    <td>
                                        <div class="page-header"><h1><small> <?php echo $i; ?></small></h1></div>
                                    </td>
                                    <td>
                                        <div class="page-header"><h1><small> <?php echo $registration_details['sch_id']; ?></small></h1></div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['product_name']; ?></strong>    
                                                
                                            </div>
                                            
                                            <form method='POST'>
                                                <button name='export' value='<?php echo $registration_details['sch_id']; ?>' class='btn btn-warning'>Export Un-Registered List</button>
                                            </form>
                                            
                                            <form method='POST'>
                                                <button name='add' value='<?php echo $registration_details['sch_id']; ?>' class='btn btn-success'>Download Activated List</button>
                                            </form>
                                            <br>
                                            <?php if(!empty($registration_details['pemplate'])){ ?>
                                             <a href='https://marrs.in/franchiselogin/uploads/<?php echo $registration_details['pemplate']; ?>' target="_BLANK" class='btn btn-primary' >View Circular</a><br>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>              
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['level_name']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!--<td>-->
                                        <!--<div class="control-group">-->
                                            <?php 
                                                // echo $registration_details['level_name']; 
                                            
                                            ?>      
                                            <!--<div class="controls">-->
                                                
                                            <!--      <strong><?php //echo $registration_details['level_name']; ?>-->
                                                  
                                            <!--      </strong>     -->
                                            <!--</div>-->
                                    <!--    </div>-->
                                    <!--</td>-->
                                    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['academic_year']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>
                                    <td>        
                                        <div class="control-group">
                                            <div class="controls">
                                                <strong><?php if($registration_details['study_material_a']=='study_material_a'){echo 'Study Material-A : Rs. '.$registration_details['study_material_a_price'];}else{echo 'Study Material-A : NA';} ?></strong><br>  
                                                <strong><?php if($registration_details['study_material_b']=='study_material_b'){echo 'Study Material-B : Rs. '.$registration_details['study_material_b_price'];}else{echo 'Study Material-B : NA';} ?></strong><br>  
                                                <strong><?php if($registration_details['study_material_c']=='study_material_c'){echo 'Study Material-C : Rs. '.$registration_details['study_material_c_price'];}else{echo 'Study Material-C : NA';} ?></strong><br>  
                                                  
                                            </div>
                                        </div>
                                    </td>
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                <strong><?php if($registration_details['orientation_a']=='orientation_a'){echo 'Orientation-A : Rs. '.$registration_details['orientation_a_price'];}else{echo 'Orientation-A : NA';} ?></strong><br>  
                                                <strong><?php if($registration_details['orientation_b']=='orientation_b'){echo 'Orientation-B : Rs. '.$registration_details['orientation_b_price'];}else{echo 'Orientation-B : NA';} ?></strong><br>  
                                                <strong><?php if($registration_details['orientation_c']=='orientation_c'){echo 'Orientation-C : Rs. '.$registration_details['orientation_c_price'];}else{echo 'Orientation-C : NA';} ?></strong><br>  
                                            </div>
                                        </div>
                                    </td>
                                    <td>      
                                        
                                        
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php if($registration_details['mock_test_a']=='mock_test_a'){echo 'Mock Test-A : Rs. '.$registration_details['mock_test_a_price'];}else{echo 'Mock Test-A : NA';} ?></strong><br>  
                                                  <strong><?php if($registration_details['mock_test_b']=='mock_test_b'){echo 'Mock Test-B : Rs. '.$registration_details['mock_test_b_price'];}else{echo 'Mock Test-B : NA';} ?></strong><br>  
                                                  <strong><?php if($registration_details['mock_test_c']=='mock_test_c'){echo 'Mock Test-C : Rs. '.$registration_details['mock_test_c_price'];}else{echo 'Mock Test-C : NA';} ?></strong><br>  
                                            </div>
                                        </div>
                                    </td>
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php if($registration_details['combo_1']==''){echo 'COMBO-1 : Rs. '.$registration_details['combo_1_price'];}else{echo 'COMBO-1  : NA';} ?></strong><br>  
                                                  <strong><?php if($registration_details['combo_2']==''){echo 'COMBO-2 : Rs. '.$registration_details['combo_2_price'];}else{echo 'COMBO-2  : NA';} ?></strong><br>  
                                                  <strong><?php if($registration_details['combo_3']==''){echo 'COMBO-3 : Rs. '.$registration_details['combo_3_price'];}else{echo 'COMBO-3  : NA';} ?></strong><br>  
                                                  <strong><?php if($registration_details['combo_4']==''){echo 'COMBO-4 : Rs. '.$registration_details['combo_4_price'];}else{echo 'COMBO-4  : NA';} ?></strong><br>  
                                                  
                                                  
                                            </div>
                                        </div>
                                    </td>   
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                <?php   
                                                    $this->db->select('*');  
                                                    $this->db->from('exam_centers');
                                                    $this->db->where('comp_id',$registration_details['sch_id']);
                                                    $query = $this->db->get();   
                                                    $centers=$query->result_array();
                                                    foreach($centers as $center){
                                                ?>
                                                
                                                
                                                  Enter: <strong><?php echo $center['center_name']; ?></strong><br>
                                                  Address: <strong><?php echo $center['center_address']; ?></strong><br>
                                                  Time: <strong><?php echo $center['exam_time']; ?></strong><br>
                                                  Date: <strong><?php echo $center['exam_date']; ?></strong>
                                                 
                                                 
                                                    
                                                 <br><br>
                                                <?php } ?>
                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/close_exam/<?php echo $registration_details['sch_id'] ?>" target="_blank" class="btn btn-primary">Manually Close Cart Item</a>

                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/activate_cin/<?php echo $registration_details['sch_id'] ?>" target="_blank" class="btn btn-warning">Activate CIN To Register</a>


                                            </div>
                                            <a href='<?php echo base_url(); ?>franchise/competitionshedule/upload/id/<?php echo $registration_details['sch_id']; ?>' target="_BLANK" class='btn btn-info' >Upload Result</a><br>
						            
                                        </div>
                                    </td>      
						        </tr>
						<?php $i=$i+1;} ?>  
					</tbody>
				    </table>
				    <?php }else{echo 'No Competition Found.';} ?>
				</div> 
                    
                    
                    
                    
<!--********************************END  DIV FOR SHOW DATA****************************************************-->
			</div><!--/span-->
		
		</div><!--/row-->
		
<?php include('footer.php'); ?>

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