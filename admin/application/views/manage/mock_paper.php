<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	     
	 
 if(!empty($this->session->flashdata('updated'))){?>
<div style="background: green;
    padding: 10px;">
    <h3 style='color:#fff;'><?php echo $this->session->flashdata('updated'); ?></h3>
</div>
<?php
}
?>
<style>
    div#example_filter {
    float: right;
    position: relative;
    right: 0px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
    
</style>
  
 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload Mock Paper </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" width='100%'>
				<tr>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product_id" id="product" style="width: 180px;"  required>
                                    <!--<option style='display:none;'>Select product</option>-->
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                                    }
                                    
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
                                <select name="clevel" id="level" style="width: 180px;"  required>
                                    <option style='display:none;'>Select level</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_levels`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
                                
                                <td>Subject <br>
				        <select name="subject" id="subject" style="width: 180px;"  >
                                    <option value=''>Select subject</option>
                                    
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM `subject`;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->id}'>{$row->id} - {$row->subject_name}</option>";
                                    // }
                                    
                                    ?>
                                </select>
				    </td>
				
					 <td>Class <br>
				        <select name="class" id="class" style="width: 180px;"  required>
				            <!--<option value='PlaySchool'>Play School</option>-->
				            <option value='Nursery'>Nursery</option>
				            <option value='LKG'>LKG</option>
                            <option value='UKG'>UKG</option>
                            <option value='Class-1'>Class-1</option>
                            <option value='Class-2'>Class-2</option>      
                            <option value='Class-3'>Class-3</option>
                            <option value='Class-4'>Class-4</option>
                            <option value='Class-5'>Class-5</option>
                            <option value='Class-6'>Class-6</option>
                            <option value='Class-7'>Class-7</option>
                            <option value='Class-8'>Class-8</option>
                            <option value='Class-9'>Class-9</option>
                            <option value='Class-10'>Class-10</option>
                            <option value='Class-11'>Class-11</option>
                            <option value='Class-12'>Class-12</option>
                        </select>
                    </td>
			
				</tr> 
				<tr>
				    
				   
				    	<td>
			   			 File 1<br />  <input name="folder1" type="file" id="csv" /> 
			            </td>
			            	<td>
			   			 File 2<br />  <input name="folder2" type="file" id="csv" /> 
			            </td>
			            	<td>
			   			 File 3<br />  <input name="folder3" type="file" id="csv" /> 
			            </td>
			            	<td>
			   			File 4<br />  <input name="folder4" type="file" id="csv" /> 
			            </td>
			            
			            <td> <br /><input type="submit" class='btn btn-info' name="submit" value="Submit" /> </td>
				</tr>
				<tr>
				    
				    
				</tr>
				<tr>
				    
			            <!--<input type="submit" name="ok" value="" />-->
				</tr>
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
        			}?>
			</h4></div>
				 <?php  if(!empty($list_materials)): ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Last 10 Papers Uploaded.</td></tr>
							 <tr>
								<th>SI no</th> <th>Product Name</th> <th>PERIOD</th> 
								<th>LEVEL</th> 	<th>Class</th>
								<th>Upload File 1</th>	<th>Upload File 2</th>	<th>Upload File 3</th>	<th>Upload File 4</th> 
								<th>Status</th><th>Action</th>
							 </tr>
							<?php    
							  $i=0;  
							  //print_r($list_materials);die;
							  foreach($list_materials as $details){ 
							    //  print_r($details);die;
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									<td align="CENTER"> <?php   
									$query = $this->db->query("SELECT academic_year FROM period where period_id='{$details['period_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['academic_year'];
									?> </td>
									<td align="CENTER">
									    <?php 
									     $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where product_name='{$details['product_name']}' and  level_id='{$details['clevel']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['level_name']; 
									    ?>
									</td>
									<td align="CENTER"> <?php  echo $details['class'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['folder1'];  
									if(!empty($details['folder1'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder1'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder2'];  
									if(!empty($details['folder2'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder2'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['folder3'];
									if(!empty($details['folder3'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder3'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder4'];
									if(!empty($details['folder4'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder4'];?>'class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['status']; ?> </td>
									<td align="CENTER">
									    <button name='delete' value='<?php  echo $details['paper_id']; ?>'
									     class='btn btn-danger' >Delete</button>
									</td>
							 </tr>
							<?php  } ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->

<script>
    $("#product").change(function(){
    var product_id =this.value;
    //alert(franchise_id);
    var BASE_URL="https://marrs.in/franchiselogin/";
    $.ajax({
        url:"<?php echo base_url();?>manage/ajax/productwiselevel",
        data:{product_id:product_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#level").html(result);
        	 
        
        }});
    });
    
    
</script>


<?php include('footer.php'); ?>