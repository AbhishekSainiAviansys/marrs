
<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
//	 print_r($students);
	 echo $this->notifications->display_html();      
?> 
	
<style>
    #on_3{
        display:none;
    }
    #o1_8{
        display:none;
    }
</style>	
			
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
				    	<td>Category:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="categ" id="categ" style="width: 180px;"  required>
                                     <option >select category</option>
                                    <option value='1'>Nursery LKG UKG</option>
                                    <option value='2'>Grade 1 to 8</option>
                                    
                                </select>
					 </td>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 180px;"  required>
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

					<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 180px;"  required>
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
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="level" id="level" style="width: 180px;"  required>
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
					<td>Status:<br>
					<select name='status'>
					    <option value=''>All</option>
					    <option value='Q'>Q</option>
					    <option value='NQ'>NQ</option>
					</select>
					</td>
					<!--<td>Class:<br>-->
					<select name='class' id='on_3'>
					    <option value='All'>All Nursery_UKG</option>
					    <option value='Nursery'>Nursery</option>
					    <option value='LKG'>LKG</option>
					    <option value='UKG'>UKG</option>
					</select>
					</td>
					<select name='class' id='o1_8'>
					    <option value='All'>All class:1-8</option>
					    <option value='Class-1'>Class-1</option>
					    <option value='Class-2'>Class-2</option>
					    <option value='Class-3'>Class-3</option>
					     <option value='Class-4'>Class-4</option>
					     <option value='Class-5'>Class-5</option>
					      <option value='Class-6'>Class-6</option>
					       <option value='Class-7'>Class-7</option>
					       <option value='Class-8'>Class-8</option>
					</select>
					</td>
					
					
			
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
				
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($students)){ ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<tr align="left" valign="TOP">
								    <input type="hidden" name="cat" value="<?php echo $cat; ?>" >
								    <input type="hidden" name="pro" value="<?php echo $pro; ?>" >
								    <input type="hidden" name="lev" value="<?php echo $lev; ?>" >
								    <input type="hidden" name="sta" value="<?php echo $sta; ?>" >
								    <input type="hidden" name="per" value="<?php echo $per; ?>" >
								    <input type="submit" name="Export" value="Export Excel" class='btn btn-primary' > </tr>
							 <!--<tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>-->
							 <tr>
								<th>Sr No</th> <th>PRID</th> <th>Product Name</th> <th>CIN</th><th>Class</th>
								<th>LEVEL</th> 
								<th>Status</th> <th>Grade</th>
								<th>Rank</th>
							 </tr>
							<?php    
							  $i=1;  
							  foreach($students as $details){ ?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['prid'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['cin'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['class'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['level_key'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['status'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['grade'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['rank'];  ?> </td>
									<!--<td align="CENTER"> <?php  //echo $details[5]."( ".$details[6]." )"; ?> </td>-->
							 </tr>
							<?php $i=$i+1;  } ?>
				</TABLE>
				<?php };/* End of if*/ ?>
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
// $("#categ").change(function(){
		 
//         if($('#categ').val() == '1') {
//             $('#on_3').show(); 
//             $('#o1_8').hide(); 
//         } else {
//             $('#row_dim').show(); 
//             $('#on_3').hide();
//         }
        
    // });
 </script>

