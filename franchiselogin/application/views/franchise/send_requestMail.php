<?php include('header.php'); 
?>
<div>
	<?php echo $this->notifications->display_html();?> 
</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>CIN Request</h2>
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
						<td valign="top">Send CIN Request Status<br>
                        <select name="cin_request_status"  id="cin_request_status" style="width:200px;">
                            <option value="">-- select --</option>
                            <option value="yes" <?php if($cin_request_status=="yes") {?> selected="selected" <?php }/*end if*/ ?> >Yes</option>
                            <option value="no"  <?php if($cin_request_status=="no") {?> selected="selected" <?php }/*end if*/ ?>>NO</option>
                        </select></td>						 
						<td valign="top">
                        <br>
                        	<button type="submit" class="btn btn-primary" id="pid_studSearch" name="pid_studSearch">Search</button>
							<button class="btn" type="reset" onclick="franchise/pid/list_cinRequest'">Reset</button>
                        </td>
					</table>		
					</div>
					<div class="control-group">  </div>
					
					<?php if(empty($cinRequest_students)){?>
					
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else
					{
					   if($cin_request_status == yes)
					   {
					?>
                           <div align="left"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
				    <?php }?>
					   <table class="table table-bordered">
						 <thead>
                        <?php
						 if($cin_request_status=="no")
							{
						?>
                                    <tr>
                                        <td></td>
                                        <td><input type="checkbox" id="send_request_check_all"></td>
                                        <td colspan="7"><input type="submit" name="btn_send_request" id="btn_send_request" value="Send CIN Request Email" 
                                                   style="color:#C30; font-size:14px; font-weight:bold;" ></td>
                                    </tr>
                         <?php }  ?>           
							  <tr>
								   <th>SI NO</th>
                                   <th></th>
                                   <th>First Time <br> Registration Code</th>
								   <th>Student Name</th>
								   <th>Address</th>
                                  
                                   <th>Category</th>
                                   <th>School</th>
                                  <th>Payment Status</th>
                                   <th>Assigned CIN</th>
								   <th>CIN Request Status</th>
							  </tr>
						 </thead>   
						 <tbody>
						  <?php 
						    $i=0;
							if($cin_request_status=="no")
							{
							    foreach($cinRequest_students as $value)
							     { 
								    $i++;
                              	    $cin_request_status = $value['cin_request_status'];
								 ?>
                                    <tr>
                                    <td><?php echo $i; ?></td>
                                    <!--<td></td>-->
                                      <td><input type="checkbox"  class="send_request_check" name="send_request_check_array[]"  
                                                 value="<?php echo $value['student_to_cin_id']; ?>"
                                                 id="<?php echo $value['student_to_cin_id']; ?>"> </td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php echo $value['pay_status']; ?></td>
                                      <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $cin_request_status;  ?></td>
                                     </tr>
    
                                <?php 
								    }//end for   
							     }/*End if*/
								 if($cin_request_status=="yes")
							     {
								     $i=0;
									foreach($cinRequest_students as $value)
							        { 
								    $i++;
									$cin_request_status = $value['cin_request_status'];
						         ?>
                                    <tr>
                                      <td> <?php echo $i; ?></td>
                                      <td></td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php echo $value['pay_status']; ?></td>
                                      
                                     <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $cin_request_status;  ?></td>
                                  </tr>
								   <?php 
                                       }//end if 
                                      }/*end for*/
                                   
								   
								 if($cin_request_status=="")
							     {
								     $i=0;
									foreach($cinRequest_students as $value)
							        { 
								    $i++;
									
						         ?>
                                    <tr>
                                      <td> <?php echo $i; ?></td>
                                      <td></td>
                                      <td><?php echo $value['tac_number']; ?></td>
                                      <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                      <td class="center"><?php echo $value['communication_address'].", ".$value['communication_address1']; ?></td>
                                      
                                      <td class="center"><?php echo $value['categoryKey']; ?></td>
                                      <td class="center"><?php echo $value['school_name']."<br> ".$value['school_address']; ?></td>
                                      <td class="center"><?php echo $value['pay_status']; ?></td>
                                      
                                      <td class="center"><?php if($value['cin']=="") { echo "Not Assign"; } else { echo $value['cin']; } ?></td>
                                      <td class="center"><?php  echo $value['cin_request_status']; ?></td>
                                  </tr>
								   <?php 
                                       }//end if 
                                      }/*end for*/
                                   ?>								   
					 </tbody>
				</table> 
<!--					<div class="pagination pagination-left">
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
-->			<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
         <script type="text/javascript">
         $(document).ready(function(e) {
           $("#send_request_check_all") .click(function(e) {
                if($(this).is(':checked'))
				{
				  $('.send_request_check').attr("checked",true)
				}/*end if is checked*/
				else
				{
				 $('.send_request_check').attr("checked",false)	
				}/*end else is checked*/
            });/* End click function*/
          });/*End ready function*/
         </script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>