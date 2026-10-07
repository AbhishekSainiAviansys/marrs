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
					
                    <?php //print_r($competition_schedule); ?>

					<td>Period:<br />
						<select name="period" id="period" style="width:250px;" disabled>
                            <option value="">Select Period</option>
                        
                            <?php
                            $query = $this->db->get('period');
                        
                            foreach ($query->result() as $row) {
                                $selected = ($competition_schedule->period_id == $row->period_id) ? 'selected' : '';
                        
                                echo "<option value='{$row->period_id}' {$selected}>
                                        {$row->period_id} - {$row->period_name}
                                      </option>";
                            }
                            ?>
                        </select>
					</td>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width:250px;" disabled>
                                    <option value="">Select Product</option>
                                
                                    <?php
                                    $query = $this->db->get('products');
                                
                                    foreach ($query->result() as $row) {
                                        $selected = ($competition_schedule->product_id == $row->product_id) ? 'selected' : '';
                                
                                        echo "<option value='{$row->product_id}' {$selected}>
                                                {$row->product_id} - {$row->product_name}
                                              </option>";
                                    }
                                    ?>
                                </select>
					 </td>
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <?php
                                $levels = $this->db
                                    ->where('product_name', $competition_schedule->product_name)
                                    ->where('level_id', $competition_schedule->competition_level_id)
                                    ->get('competition_level_byproduct')
                                    ->result();
                                ?>
                                
                                <input type="hidden" name="level" value="<?= $competition_schedule->competition_level_id; ?>">
                                
                                <select id="level" style="width:250px;" disabled>
                                
                                    <?php foreach ($levels as $row) { ?>
                                
                                        <option value="<?= $row->level_id; ?>" selected>
                                            <?= $row->level_id; ?> - <?= $row->level_name; ?>
                                        </option>
                                
                                    <?php } ?>
                                
                                </select>
					</td>
					
				<td>
			   			 Choose your CIN result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
				<!--<tr>-->
				<!--    <td> Help!! result upload template format help consists of following column attributes for your information.</td>-->
				<!--</tr>-->
				<!--<tr>-->
				    
				<!--    <td>1. period_id</td>-->
				<!--    <td>2. clevel</td>-->
				<!--    <td>3. CIN</td>-->
				<!--    <td>4. status 'Q/NQ'</td>-->
				<!--    <td>5. Grade </td>-->
				<!--    <td>6. Rank </td>-->
				<!--    <td>7. Performer </td>-->
				<!--    <td>8. Speller </td>-->
				<!--    <td>9. Marks </td>-->
				<!--    <td>10. Center Name</td>-->
				<!--    <td>11. Competition Date</td>-->
				
				<!--</tr>-->
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

<script>
// 			$(document).ready(function(){
			
//         var product_id = $("#product").find(":selected").text();
// 		//alert(state_id);
// 		var BASE_URL = "https://marrs.in/franchiselogin/";
//         $.ajax({
//             url:BASE_URL+"manage/ajax/productwiselevel/",
//             data:{product_id:product_id},
//             type: 'post',
//             success:function(result){
//                  $("#level").html(result);
//         }});
//     });
			</script>
<script>
    
//     $("#product").change(function(){
//         var product_id=this.value;
// 		//alert(state_id);
// 		var BASE_URL = "https://marrs.in/franchiselogin/";
//         $.ajax({
//             url:BASE_URL+"manage/ajax/productwiselevel/",
//             data:{product_id:product_id},
//             type: 'post',
//             success:function(result){
//                  $("#level").html(result);
//         }});
//     }); 
	
</script>