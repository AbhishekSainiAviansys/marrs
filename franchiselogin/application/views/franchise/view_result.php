<?php include('header.php');
/*echo "<pre>"; print_r($result_list);exit;

$competition_level_name=$result_list[0];
$result_data=$result_list[1];

print_r($result_data);exit;*/

/*echo "-------------------"; exit;*/ /*echo "<pre>"; print_r($result_list);exit; */


?>
<div><?php echo $this->notifications->display_html();?> </div>
<form method="POST">
	<div>		
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-user"></i>View And Export Result</h2>
					<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
                <div class="controls">
                     <table width="80%">
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
                        <td valign="top">Competition level</td> 
                        <td valign="top">
                              <select name="competition_level_id"  style="width:200px;">
                                 <option value="">select</option>
                               <?php foreach($levels as $val): ?>
                                 <option value="<?php echo $val['competition_level_id']; ?>" <?php if( isset( $competition_level_id ) )
											             { if($competition_level_id == $val['competition_level_id']) {  ?> selected="selected" <?php }} ?>>
											   <?php echo $val['competition_level_name']; ?>
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
				 <?php if(isset($aim) && ($aim =='export') && !empty($result_list)){?>	
               <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
				 <?php }?>
				</div>
		<div class="control-group">  </div>
		<?php if(empty($result_list)){  ?>
	             <div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					 </div>
        <?php }  else   { ?>
               <table class="table table-bordered">
                    <thead>
                        <tr>
                             <th>SI.NO</th>
                             <th>Level</th>
                             <th>Period</th>
                             <th>Student Name</th>
                             <th>CIN</th>
                             <th>Category</th>
                             <th>School</th>
                             <th>TRN</th>
                             <th>PRN</th>
                             <th>Result Status</th>
                             <th>Franchise Code</th>                                    
                        </tr>
                    </thead>   
					<tbody>
						<?php 
						 $i=0;
						  foreach($result_list as $value)
						  { 
							/*print_r($value);
							echo "<br>---------------------". $value['period_name']; */
							 $i++;
						  ?>
							<tr>
                                  <td class="center">  <?php echo $i; ?>                                  </td>
                                  <td class="center">  <?php echo $value['competition_level_name']; ?>               </td>
                                  <td class="center">  <?php echo $value['period_name']; ?>               </td>
                                  <td class="center">  <?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
                                  <td class="center">  <?php echo $value['cin']; ?>                       </td>
                                  <td class="center">  <?php echo $value['categoryKey']; ?>                          </td>
                                  <td class="center">  <?php echo $value['school_name']."<br>".$value['school_address']; ?>               </td> 
                                  <td class="center">  <?php echo $value['temperory_registration_number']; ?>               </td> 
                                  <td class="center">  <?php echo $value['permenent_registration_number']; ?>    </td>
                                  <td class="center">  <?php echo $value['status']; ?>           </td>
                                  <td class="center">  <?php echo $value['franchise_code']; ?>              </td>
					      </tr>
			           <?php }/*End foreach */ ?>	
	            </tbody>
            </table> 
<!--					<div class="pagination pagination-left">
                         <ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a>   </li>
							<li><a href="#">2</a>   </li>
							<li><a href="#">3</a>   </li>
							<li><a href="#">4</a>   </li>
							<li><a href="#">5</a>   </li>
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
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>