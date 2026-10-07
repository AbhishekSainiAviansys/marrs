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
                                <td>Period ID<br>
        				        <select name='period_id' style="width: 220px;" required>
        						<?php //$period = $this->db->get_where('period')->result(); 
        						foreach($periodload as $val){ ;?>
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
        						foreach($load_level as $val){ ;?>
        				           <option value='<?php echo $val['level_id'];?>' <?php  if($val['level_id']==$result['level']) { echo 'selected="selected"'; } ?>><?php echo $val['level_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        						
        				        <td>CIN <br>
        				            <input type="text" id="" value="<?php if(isset($result['cin'])){echo $result['cin'];} ?>" name="cin" style="width: 220px;"  required>
        				        </td>    
        				        <td>
                                    <input type="submit" id="submit" value="Search" name="submit" class="btn btn-danger btn-sm" >
                                </td>
                            </tr>
                             
                        </table>
                        </form>
                    </div>    
                    
<!--******************************START DIV FOR SHOW DATA*********************************************-->     
               
					<div class="box-content">
					    <?php if(!empty($cin_list)){ ?>
					    <table class="table table-bordered">
						  <thead>
							    <tr>
							        <th>
							            Sr. No
							        </th>
							        <th>
							            Status
							        </th>
							        <th>
							            Grade
							        </th>
							        <th>
							            Rank
							        </th>
							        <th>
							            Marks
							        </th>
							        
							        <th>
							            Product Name
							        </th>
							        <th>
							            Level
							        </th>
							        <th>
							            Session
							        </th>
							        <th>
							            CIN
							        </th>
							        <th>
							            Name
							        </th>
							        <th>
							            Class
							        </th>
							        <th>
							            Father Name
							        </th>
							        <th>
							            Mother Name
							        </th>
							        <th>
							            Email
							        </th>
							        <th>
							            Mobile
							        </th>
							        <th>
							            Certificate
							        </th>
					            </tr>
						  </thead>   
						  <tbody>
    					    <?php $i=1;
    					    foreach($cin_list as $registration_details){ ?>
        						<!--<form class="form-horizontal" method="POST" enctype= "multipart/form-data">-->
        						<!--	<fieldset>-->
							    
                                <tr>
                                    <td>
                                        <div class="page-header"><h1><small> <?php echo $i; ?></small></h1></div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['result_status']; ?></strong>    
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['grade']; ?></strong>    
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['rank']; ?></strong>    
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <strong><?php echo $registration_details['marks']; ?></strong>    
                                                
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
                                                  <strong><?php echo $registration_details['academic_year']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>
                                         
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['cin']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>     
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['student_name']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['class']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['father_name']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['mother_name']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['stud_phone']; ?></strong>     
                                            </div>
                                        </div>
                                    </td>    
                                    <td>       
                                        
                                        <div class="control-group">
                                                  
                                            <div class="controls">
                                                  <strong><?php echo $registration_details['stud_email']; ?></strong>     
                                            </div>
                                        </div>
                                    </td> 
                                    <td>       
                                        
                                        <form  method="POST">
                                            <input type="hidden" name="clevel" value="<?php echo $registration_details['clevel']; ?>">
                                            <input type="hidden" name="schedule_id" value="<?php echo $registration_details['competition_schedule_id']; ?>">
                                            <input type="hidden" name="cin" value="<?php echo $registration_details['cin']; ?>">
                                            <button type="submit" name='download' class="btn btn-warning">Download</button>
                                        </form>
                                        
                                        <!--<a href='<?php echo base_url().'result/'.$registration_details['clevel'].'/'.$registration_details['competition_schedule_id'].'/'.$registration_details['cin']; ?>' class='btn btn-warning' >Download</a>     -->
                                       
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
            url: "<?php echo base_url(); ?>franchise/ajax/productwiselevel_/",
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