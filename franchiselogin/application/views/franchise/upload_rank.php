<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2>
			       <i class="icon-edit"></i>Upload CSV Result file </h2>
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
					

					<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style='display:none;'>Select period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `period` where period_id > '11';");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					</td>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product_name" style="width: 220px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <input name="level" type="text"  placeholder="Enter Level Name" />
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
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RANK UPLOAD LIST</td></tr>
							 <tr>
								<th>SI no</th> <th>CIN</th> <th>RANK</th> 
								  <th>Speller</th> <th>Performer</th><th>Level Name</th><th>STATUS</th>
							 </tr>
							<?php    
							  $i=0;  
							  foreach($csvResult_upoload_logArray as $details): 
						    ?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
									<td align="CENTER"> <?php  echo $details[3];  ?> </td>
									<td align="CENTER"> <?php  echo $details[4];  ?> </td>
									<td align="CENTER"> <?php  echo $details[6];  ?> </td>
									<td align="CENTER"  style="background-color: <?php echo $details[5]; ?>; color:#fff; font-weight:bold;" > <?php  echo $details[2];  ?> </td>
									
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

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<script type="text/javascript">
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
	
</script>



<?php include('footer.php'); ?>