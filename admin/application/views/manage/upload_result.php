<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();
	 
	// echo $product_id;
	 
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
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product_id" style="width: 300px;" disabled required>
                                    <option style='display:none;'>Select product</option>
                                    
                                    <?php foreach($product as $val) { ?>
            									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $product_id) ) if($product_id == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
            									<?php } ?>  
                                </select>
					 </td>

					<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 180px;"  required disabled>
                                    <option style='display:none;'>Select period</option>
                                    
                                     <?php foreach($period as $periodval) { ?>
            									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $period_id) ) if($period_id == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_id'].' - '.$periodval['period_name'] ?></option>
            									<?php } ?>
                                </select>
					</td>
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="level" id="level" style="width: 180px;" disabled required>
                                    <option style='display:none;'>Select level</option>
                                    
                                     <?php foreach($level as $val) { ?>
            									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $level_id) ) if($level_id == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo  $val['level_id'].' - ' .$val['level_name']; ?></option>
            									<?php } ?>
                                </select>
					</td>
					<?php if($product_id=='8'){?>
					<td>
					    Subject: <br>
					    <input type='text' name='subject' >
					</td>
					<td>
					    Series: <br>
					    <input type='text' name='series' >
					</td>
					<?php } ?>
				<td>
			   			 Choose your CIN result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" class='btn btn-primary' /> </td>
				</tr> 
				<tr>
				    <td>Template Format Of CSV File To Upload Result.</td>
				</tr>
		   </table>		 
		 <p>Col-1. CIN &nbsp &nbsp  
				    Col-2. status 'Q/NQ' &nbsp &nbsp
				    Col-3. Grade &nbsp &nbsp
				    col-4. Rank &nbsp &nbsp
				    Col-5. Marks &nbsp &nbsp
				    Col-6. Performer 'Yes/No'&nbsp &nbsp
				    Col-7. Speller 'Yes/No'</p>
		    <br />
		    
		    <br>
				<tr><input type="submit" name="download" value="download template" class='btn btn-primary' /></tr>
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>
							 <tr>
								<th>SI no</th> <th>CIN</th> 
								<!--<th>PERIOD</th> -->
								
								<th>Upload Report</th> <th>Status</th>
								<th>Error Report</th> 
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

<script type="text/javascript">
$("#product_id").change(function(){
		   
		//alert(this.value);
        var product_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#level").html(result);
        }});
    });

 </script>




<?php include('footer.php'); ?>