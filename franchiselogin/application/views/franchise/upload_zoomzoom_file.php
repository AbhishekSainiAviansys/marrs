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
				    	<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style='display:none;'>Select period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `period`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					</td>
				    
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 220px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    <!--<option style='display:none;'>Select product</option>-->
                                    
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM products;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                                    // }
                                    
                                    ?>
                                </select>
					 </td>

				
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="level" id="level" style="width: 220px;"  required>
                                    <option style='display:none;'>Select level</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_levels`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					</td>
						<td>Category:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="categ" id="categ" style="width: 220px;"  required>
                                     <option >select category</option>
                                    <option value='1'>Nursery LKG UKG</option>
                                    <option value='2'>Grade 1 to 8</option>
                                    
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM products;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                                    // }
                                    
                                    ?>
                                </select>
					 </td>
				<td>
			   			 Choose your PRID result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
				<tr>
				    <td>Template Format</td>
				</tr>
				<tr>
				    <td>1. prid</td>
				    <td>2. status</td>
				    <td>3. grade</td>
				    <td>4. Marks</td>
				    <td>5. Rank </td>
				    
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
								<th>SI no</th> <th>PRID</th> <th>Roduct Name</th> 
								<!--<th>LEVEL</th> -->
								<th>Status</th> <th>Current level in Student to CIN</th>
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

<script type="text/javascript">
$("#categ").change(function(){
		   
		//alert(this.value);
        var categ=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/get_product_list/",
            data:{categ:categ},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#product").html(result);
        }});
    });

 </script>


