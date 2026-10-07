<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	     
	 
 if(!empty($message)){?>
<div >
    <h3 style='color:green;'><?php echo $message; ?></h3>
</div>
<?php
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("p").hide();
  });
  $("#show").click(function(){
    $("p").show();
  });
});

function getval(sel)
{
    //alert(sel.value);
    if (sel.value=='MaRRS ZoomZoom') {
        $("#level1").show();
        $("#level2").hide();
    }else{
        $("#level2").show();
        $("#level1").hide();
    }
}


</script>

<style>
    #level2{
        display:none;
        }
    #level1{
        display:none;
    }    
</style>


<!--<select onchange="getval(this);">-->
<!--    <option value="MaRRS ZoomZoom">One</option>-->
<!--    <option value="2">Two</option>-->
<!--</select>-->

<!--<p id='myp'>If you click on the "Hide" button, I will disappear.</p>-->

<!--<button id="hide">Hide</button>-->
<!--<button id="show">Show</button>-->

<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload study material for ZoomZoom Purchase</h2>
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
                                <select name="product_name" id="product" style="width: 180px;"   required>
                                    <option style='display:none;'>Select product</option>
                                    
                                <?php
                                     
                                    $query = $this->db->query("SELECT * FROM zoomzoom_product_activate;");
                                    
                                    foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_name}'>{$row->id} - {$row->product_name}</option>";
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
                                <select name="level" id="level" style="width: 180px;"  required>
                                    <option >Select level</option>
                                     <option value='1'>Level-1</option>
                                     <option value='2'>Level-2</option>
                                </select>
                                
                                <!--<select name="level_id2" id="level2" style="width: 180px;"  required>-->
                                <!--    <option >Select level</option>-->
                                <!--     <option value='1'>School Level</option>-->
                                     <!--<option value='2'>National Finals</option>-->
                                <!--</select>-->
					</td>
					
			
				</tr> 
				<tr>
				    <!--<td>Subject <br>-->
				    <!--    <select name="subject" id="subject" style="width: 180px;"  >-->
        <!--                            <option value=''>Select subject</option>-->
                                    
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM `subject`;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->id}'>{$row->id} - {$row->subject_name}</option>";
                                    // }
                                    
                                    ?>
                                <!--</select>-->
				    <!--</td>-->
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
				    <td> Title <br>
				        <input type='text' name='title' style="width: 180px;" required>
				    </td>
				</tr>
				<tr>
				    <td>Status <br>
				        <select name='status' require>
				            <option>Select-status</option>
				            <option value='Free'>Free</option>
				            <option value='Paid'>Paid</option>
				        </select>
				    </td>
				    <td>Pice =</td>
				    <td> 
				        <input type='number' name='price' style="width: 180px;" required>
				    </td>
				</tr>
				<tr>
				    	<td>
			   			 Choose your file<br />  <input name="folder" type="file" id="csv" /> 
			            </td>
			            <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
			            <!--<input type="submit" name="ok" value="" />-->
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
								<th>SI no</th> <th>PRID</th> <th>PERIOD</th> 
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

<div class="row-fluid sortable">
    <h2>Study Material List</h2>
	<div class="box span12">
	    <table cellpadding="8px">
	        <tr>
	            <th>Sr. No.</th>
	            <th>
	                Product
	            </th>
	            <th>
	                Period
	            </th>
	            <th>
	                Level
	            </th>
	            <th>
	                Class
	            </th>
	            <!--<th>-->
	            <!--    Subject-->
	            <!--</th>-->
	            <th>
	                Title
	            </th>
	            <th>
	                Status
	            </th>
	            <th>
	                Price
	            </th>
	             <th>
	                Option
	            </th>
	        </tr>
	        <?php if(!empty($list_materials)){
	            $i=1;
	            foreach($list_materials as $row){
	            ?>
	            <tr>
	                <td><?php echo $i;?></td>
	                <td><?php echo $row['product_name']; ?></td>
	                <td><?php echo $row['period']; ?></td>
	                <td><?php echo $row['level_id']; ?></td>
	                <td><?php echo $row['class']; ?></td>
	                <!--<td><?php //echo $row['subject']; ?></td>-->
	                <td><?php echo $row['title']; ?></td>
	                <td><?php echo $row['status']; ?></td>
	                <td><?php echo $row['price']; ?></td>
	               <td><a href="<?php echo base_url().'manage/franchise/zoomstudymat_delete/';?><?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" >Delete</a></td>
	            </tr>
	        <?php 
	           $i=$i+1; }
	       }?>
	    </table>
    </div>
    
</div>



<?php include('footer.php'); ?>