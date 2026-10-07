<?php include('header.php');  /*"<pre>"; print_r($cin_list); */?>
<div><?php echo $this->notifications->display_html();?> </div>
<form method="POST">
	<div>		
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-user"></i>View And Export CIN</h2>
					<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
                <div class="controls">
                     <table width="80%">
                          <td valign="top">Service</td> 
                          <td valign="top">
                              <select name="service_id"  style="width:200px;">
                                 <option value="">select</option>
                                      <?php foreach($services as $val): ?>
                                 <option value="<?php echo $val['service_id']; ?>" <?php if( isset( $service_id ) )
											             { if($service_id == $val['service_id']) {  ?> selected="selected" <?php }} ?>>
											        <?php echo $val['service_name']; ?>
											</option>
                                      <?php  endforeach;  ?>
                              </select>
                          </td>
                          <td valign="top">period</td> 
                          <td valign="top"> 
                              <select name="period_id" style="width:200px;">
                                 <option value="">select period</option>
                                            <?php 	foreach($periods as $val): ?>
                                 <option value="<?php echo $val['period_id']; ?>"<?php if( isset( $period_id ) )
											              { if($period_id == $val['period_id']) {  ?> selected="selected" <?php }} ?>>
											        <?php echo $val['period_name']; ?>
											</option>
                                         <?php  endforeach;  ?>
                              </select>
                        </td>	  
						      <td valign="top">School</td> 
                        <td valign="top"> 
                            <select name="school_id" style="width:200px;">
                               <option value="">select</option>
                                            <?php 	foreach($school as $val): ?>
                               <option value="<?php echo $val['school_id']; ?>"<?php if( isset( $school_id ) )
											            { if($school_id == $val['school_id']) {  ?> selected="selected" <?php }} ?>>
                                       <?php echo $val['school_name']; ?>
                               </option>
                                        <?php  endforeach;  ?>
                            </select>
                        </td>				 
						     <td valign="top">
                        	<button type="submit" class="btn btn-primary" id="Search" name="Search">Search</button>
							      <button class="btn" type="reset" onclick="franchise/pid/view_cin'">Reset</button>
                      </td>
				  </table>
				 <?php if(isset($aim) && ($aim =='export') && !empty($cin_list)){?>	
               <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
				 <?php }?>
				</div>
		<div class="control-group">  </div>
		<?php if(empty($cin_list))
		{?>
	             <div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					 </div>
<?php }
      else{ ?>
					 <table class="table table-bordered">
						  <thead>
							  <tr>
								   <th>SI.NO</th>
								   <th>Tac Number</th>
                           <th>Student Name</th>
                           <th>CIN</th>
								   <th>Category</th>
								   <th>School</th>
								   <th>School Address</th>
                           <th>State</th>
                           <th>CIN Alloted Date</th>
								   <th>Student Register Date</th>                                    
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						         $i=0;
						  	      foreach($cin_list as $value){ 
								   $i++;
						  ?>
							<tr>
								<td ><?php echo $i; ?></td>
								<td class="center">   <?php echo $value['tac_number']; ?></td>
						      <td class="center">   <?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
						      <td class="center">   <?php echo $value['cin']; ?></td>
						      <td class="center">   <?php echo $value['categoryKey']; ?></td>
						      <td class="center">   <?php echo $value['school_name']; ?>    </td> 
						      <td class="center">   <?php echo $value['school_address']; ?>    </td> 
						      <td class="center">   <?php echo $value['state_subdivision_name']; ?>    </td>
						      <td class="center">   <?php echo $value['cin_assign_date']; ?>    </td>
						      <td class="center">   <?php echo $value['created_date']; ?>    </td>
						      
						      
						      
						      
					  </tr>
			<?php } ?>	
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
		 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>