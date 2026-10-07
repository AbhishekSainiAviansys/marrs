<?php 

include('header.php');

?>

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
                        
					    <?php 
					    if(!empty($registration_details)){ 
					    //print_R($registration_details);die;
					    
					    ?>
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
							            Caption
							        </th>
							        <th>
							            Product Name
							        </th>
							        <th>
							            Level
							        </th>
							        <th>
							            Centers
							        </th>
							        <th>
							            Session
							        </th>
							        <th>
							            Schedule Status
							        </th>
							        <th>
							            Category
							        </th>
							        <th>
							            Date
							        </th>
							        <th>
							            Time
							        </th>
							        <th>
							            Exam Fee
							        </th>
							        <th>
							            Action
							        </th>
					            </tr>
						  </thead>   
						  <tbody>
        					    <?php $i=1;
        					    foreach($registration_details as $registration_details){ 
        					    //print_r($registration_details);die; ?>
        						<!--<form class="form-horizontal" method="POST" enctype= "multipart/form-data">-->
        						<!--	<fieldset>-->
							    
                                <tr>
                                    <td>
                                        <div class="page-header"><h1><small> <?php echo $i; ?></small></h1></div>
                                    </td>
                                    <td>
                                        <div class="page-header"><h1><small> <?php echo $registration_details['competition_schedule_id']; ?></small></h1></div>
                                    </td>
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['competition_caption']; ?></strong><br>  
                                                  
                                            </div>
                                        </div>
                                    </td> 
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['product_name']; ?></strong>    
                                                
                                            </div>
                                            
                                            
                                            
                                        </div>
                                    </td>
                                    <td>              
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['level_name']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="control-group">
                                                 
                                            <div class="controls">
                                                <?php 
                                                     echo $registration_details['center_address']; 
                                                
                                                ?> 
                                                     
                                            </div>
                                        </div>
                                    </td>
                                    
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
                                                <strong><?php echo $registration_details['schedule_confirm_status']; ?></strong><br>  
                                                  
                                            </div>
                                        </div>
                                    </td>
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                <strong><?php echo $registration_details['category_name'];?></strong><br>  
                                            </div>
                                        </div>
                                    </td>
                                    <td>      
                                        
                                        
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['competition_date']; ?></strong><br>  
                                            </div>
                                        </div>
                                    </td>
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['reporting_time']; ?></strong><br>  
                                                  
                                                  
                                            </div>
                                        </div>
                                    </td> 
                                    
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['competition_fee']; ?></strong><br>  
                                                  
                                            </div>
                                        </div>
                                    </td> 
                                    
                                    
                                    
                                    <td>       
                                        <div class="control-group">
                                            <div class="controls">
                                                
                                               
                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/cin_genration/<?php echo $registration_details['competition_schedule_id'] ?>" target="_blank" class="btn btn-primary">Generate CIN</a>

                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/cin_list/<?php echo $registration_details['competition_schedule_id'] ?>" target="_blank" class="btn btn-info">CIN List</a>


                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/upload1/id/<?php echo $registration_details['competition_schedule_id'] ?>" target="_blank" class="btn btn-warning">Result Upload</a>
                                                
                                                <a href="<?php echo base_url(); ?>franchise/competitionshedule/edit/id/<?php echo $registration_details['competition_schedule_id'] ?>" target="_blank" class="btn btn-success">Edit Schedule</a>


                                            </div>
                                            
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
            url: "<?php echo base_url();?>franchise/ajax/productwiselevel_/",
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