<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV Result file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" >
				<tr>
					<td>Period:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="period" id="period" style="width: 220px;"  required>
                            <!--<option style='display:none;'>Select period</option>-->
                            
                             <?php
                             
                             $query = $this->db->query("SELECT * FROM `period` where period_id >13;");
                            
                             foreach ($query->result_array() as $row)
                            {
                                echo "<option value='{$row['period_id']}'>{$row['academic_year']}</option>";

                            ?>
                            <!--<option value="<?php echo $row['period_id'] ?>" <?php if(isset($result['period']) && $result['period'] == $row['period_id']) { echo "selected"; } ?>><?php echo $row['academic_year'] ?></option>-->
                            
                            <?php
                            }
                            
                            ?>
                        </select>
					</td>

					<td>Subject<span style='color:red;'>*</span></br>
					    <select name='subject' style='width:220px;' required>
					        <option value=''>select level</option>
				        <?php foreach($subject as $res){ ?>
				                <option value='<?php echo $res->Subject_key; ?>' <?php  if($res->Subject_key==$result['subject']) { echo 'selected="selected"'; } ?>><?php echo $res->Subject_key; ?></option>
				            <?php } ?>
				        </select>
					</td>
					<td>Lunar Series<span style='color:red;'>*</span></br>
					        <select name='series' style='width:220px;' required>
					            <option value=''>select level</option>
					            <?php foreach($series as $res){ ?>
					                <option value='<?php echo $res->series; ?>' <?php  if($res->series==$result['series']) { echo 'selected="selected"'; } ?>><?php echo $res->series; ?></option>
					            <?php } ?>
					        </select>
					 </td>
					 <td>
					    Type<span style='color:red;'>*</span></br>
					        <select name='type' style='width:220px;' required>
					            <option value=''>select type</option>
					            <?php foreach($type as $res){ ?>
					                <option value='<?php echo $res->type; ?>' <?php  if($res->type==$result['type']) { echo 'selected="selected"'; } ?>><?php echo $res->type; ?></option>
					            <?php } ?>
					        </select>
					    
				    </td> 
				 
					<td>Competition Level:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="level" id="level" style="width: 220px;"  required>
                           <option value=''>select level</option>
                           <?php foreach($level_load as $periodval) : ?>
                            <option value="<?php echo $periodval['level_id'] ?>" <?php if(isset($result['level']) && $result['level'] == $periodval['level_id']) { echo "selected"; } ?>><?php echo $periodval['level_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
					</td>
				</tr> 
				<tr>	
    				<!--<td>Competition Center Name:<span style='color:red;'>*</span><br />-->
    						<!--<h3><b>School : </b></h3>-->
        <!--                    <input type='text' name="exam_center" id="level" style="width: 220px;"  required >-->
    				<!--</td>-->
    				<!--<td>Competition Date:<span style='color:red;'>*</span><br />-->
    						<!--<h3><b>School : </b></h3>-->
        <!--                    <input type='date' name="exam_date" id="level" style="width: 220px;"  required >-->
    				<!--</td>-->
    				
    				<td>
    			   			 Choose your CIN result CSV file <span style='color:red;'>*</span> <br />  <input name="csv" type="file" id="csv" /> 
    			    </td>
			        <td> 
			            <br /><input type="submit" name="submit" value="Submit" class="btn btn-primary" /> 
			        </td>
				</tr> 
				<tr>
				    <td> Help!! result upload template format help consists </td> <td>of following column attributes for your information.</td>
				
				    
				    <td>CIN / status 'Q/NQ' / Grade / Rank / Performer /</td>
				    <td> Speller / Marks / Speller / Marks /</td>
				     <td> Center Name / Competition Date</td>
				
				</tr>
		   </table>		 
		 
		   				
		<br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>
							 <tr>
								<th>SI no</th> <th>CIN</th> <th>PERIOD</th> 
								<!--<th>LEVEL</th> -->
								<th>Upload Report</th> <th>Current level in Student to CIN</th>
							 </tr>
							<?php    
							  $i=0;  
							  foreach($csvResult_upoload_logArray as $details): 
array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);							?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
									<td align="CENTER"> <?php  echo $details[2];  ?> </td>
									<td align="CENTER"> <?php  echo $details[3];  ?> </td>
									<!--<td align="CENTER"> <?php  //echo $details[4];  ?> </td>-->
									<!--<td align="CENTER"> <?php  //echo $details[7];  ?> </td>-->
									<!--<td align="CENTER"> <?php  //echo $details[5]."( ".$details[6]." )"; ?> </td>-->
							 </tr>
							<?php  endforeach; ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>