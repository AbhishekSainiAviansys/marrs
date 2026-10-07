<?php include('header.php'); /*echo '<pre>';print_r($fr_service_details);exit;*/
?>
<div>
	<?php echo $this->notifications->display_html();?> 
</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Registered Student List </h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <div class="controls">
                    <table width="100%">
                        <td valign="top">Service <br> <select name="service_id"  style="width:200px;">
                         <option value="">-- select --</option>
                                            <?php 	/*foreach($services as $val): */?>
                                                 <option value="<?php echo $fr_service_details['service_id']; ?>">
											<?php echo $fr_service_details['service_name']; ?></option>
                                            <?php  /*endforeach; */ ?>
                        </select></td>
						<td valign="top">School<br> 
                        <select name="school_id" style="width:200px;">
                        <option value="">-- select --</option>
                                            <?php 	foreach($school as $val): ?>
                                            <option value="<?php echo $val['school_id']; ?>"
                                            <?php if( isset( $school_id ) )
											         { if($school_id == $val['school_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
                                            <?php echo $val['school_name']; ?></option>
                                            <?php  endforeach;  ?>
                        
                        </select></td>	
						<td valign="top">Period <br>
                        <select name="period" style="width:200px;">
                        <option value="">-- select --</option>
                                            <?php 	foreach($periods as $val): ?>
                                            <option value="<?php echo $val['period_id']; ?>"
                                            <?php if( isset( $period_id ) )
											         { if($period_id == $val['period_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['period_name']; ?></option>
                                            <?php  endforeach;  ?>
                        </select></td>						 
						<td valign="top">Payment Status<br>
                        <select name="pay_status"  id="pay_status" style="width:200px;">
                            <option value="">-- select --</option>
                            <option value="yes" <?php if($search_pay_status=="yes") {?> selected="selected" <?php }/*end if*/ ?> >Paid</option>
                            <option value="no"  <?php if($search_pay_status=="no") {?> selected="selected" <?php }/*end if*/ ?>>Not Paid</option>
                        </select></td>						 
						<td valign="top">
                        <br>
                        	<button type="submit" class="btn btn-primary" id="pid_studSearch" name="pid_studSearch">Search</button>
							<button class="btn" type="reset" onclick="franchise/pid/list_regStudents'">Reset</button>
                        </td>
					</table>		
					</div>
					<div class="control-group">  </div>
					
					<?php if(empty($reg_students)){?>
					
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
                        <?php
						 if($search_pay_status=="no")
							{
						?>
                                    <tr>
                                    <td></td>
                                        <td><input type="checkbox" id="pay_check_all"></td>
                                        <td colspan="7"><input type="submit" name="btn_pay_update" id="btn_pay_update" value="Update Payment Status" 
                                                   style="color:#C30; font-size:14px; font-weight:bold;" ></td>
                                    </tr>
                         <?php }  ?>           
							  <tr>
								   <th>SI.NO</th>
                                   <th></th>
                                   <th>First Time <br> Registration Code</th>
								   <th>Student Name</th>
								   <th>Address</th>
                                  
                                   <th>Category</th>
                                   <th>School</th>
                                   <th>Assigned CIN</th>
								   <th>Payment Status</th>
							  </tr>
						 </thead>   
						 <tbody>
						  <?php 
						    $i=0;
							if($search_pay_status=="no")
							{
							    foreach($reg_students as $value)
							     { 
								    $i++;
                              	    $pay_status = $value['pay_status'];
								 ?>
                                    <tr>
                                <td><?php echo $i; ?></td>
                                <td><input type="checkbox"  class="pay_check" name="pay_check_array[]"  value="<?php echo $value['student_to_cin_id']; ?>"
                                                 id="<?php echo $value['student_to_cin_id']; ?>"> </td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $pay_status;  ?></td>
                                     </tr>
    
                                <?php 
								    }//end for   
							     }/*End if*/
								 if($search_pay_status=="yes")
							     { 
								     $i=0;
									foreach($reg_students as $value)
							        { 
								    $i++;
									$pay_status = $value['pay_status'];
						         ?>
                                    <tr>
                                      <td><?php echo $i; ?></td>
                                      <td> </td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $pay_status;  ?></td>
                                  </tr>
								   <?php 
                                       }//end if 
                                      }/*end for*/
                                   
								   
								 if($search_pay_status=="")
							     { $i=0;
								    
									foreach($reg_students as $value)
							        { 
								    $i++;
									
						         ?>
                                    <tr>
                                    <td><?php echo $i; ?></td>
                                      <td> </td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $value['pay_status']; ?></td>
                                  </tr>
								   <?php 
                                       }//end if 
                                      }/*end for*/
                                   ?>								   
					 </tbody>
				</table> 
					
			<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
         <script type="text/javascript">
         $(document).ready(function(e) {
           $("#pay_check_all") .click(function(e) {
                if($(this).is(':checked'))
				{
				  $('.pay_check').attr("checked",true)
				}/*end if is checked*/
				else
				{
				 $('.pay_check').attr("checked",false)	
				}/*end else is checked*/
            });/* End click function*/
          });/*End ready function*/
         </script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>