<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 //print_r($list_materials);exit;     
	     
	 
 if(!empty($message)){?> 
<div >
    <h3 style='color:green;'><?php echo $message; ?></h3>
</div>
<?php
}
?>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload study material </h2>
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
                                <select name="product_id" id="product" style="width: 180px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products;");
                                    
                                     foreach ($query->result() as $row)
                                    { ?>
                                   <option value="<?php echo $row->product_name;?>" <?php if($row->product_name==$list_materials->product_name){ echo  'selected="selected"' ;} ?> ><?php echo $row->product_name;?></option>
                                   <?php  }  
                                    
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
                                    { ?>
                                    <option value='<?php echo $row->period_id;?>' <?php if($row->period_id==$list_materials->period){ echo  'selected="selected"' ;} ?> ><?php echo $row->period_name;?></option>";
                                  <?php   }
                                    
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
                                    {  ?>
                                    <option value='<?php echo $row->id;?>' <?php if($row->id==$list_materials->clevel){ echo  'selected="selected"' ;} ?>><?php echo $row->level_name;?></option>";
                                   <?php  }
                                    
                                    ?>
                                </select>
					</td>
					
			
				</tr> 
				<tr>
				    <td>Subject <br>
				        <select name="subject" id="subject" style="width: 180px;"  >
                                    <option value='<?php echo $list_materials->subject ?>'>Select subject</option>
                                    
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
				            <option value='PlaySchool' <?php if('PlaySchool'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Play School</option>
				            <option value='Nursery' <?php if('Nursery'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Nursery</option>
				            <option value='LKG' <?php if('LKG'==$list_materials->class){ echo  'selected="selected"' ;} ?>>LKG</option>
                            <option value='UKG' <?php if('UKG'==$list_materials->class){ echo  'selected="selected"' ;} ?>>UKG</option>
                            <option value='Class-1' <?php if('Class-1'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-1</option>
                            <option value='Class-2' <?php if('Class-2'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-2</option>      
                            <option value='Class-3' <?php if('Class-3'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-3</option>
                            <option value='Class-4' <?php if('Class-4'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-4</option>
                            <option value='Class-5' <?php if('Class-5'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-5</option>
                            <option value='Class-6' <?php if('Class-6'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-6</option>
                            <option value='Class-7' <?php if('Class-7'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-7</option>
                            <option value='Class-8' <?php if('Class-8'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-8</option>
                            <option value='Class-9' <?php if('Class-9'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-9</option>
                            <option value='Class-10' <?php if('Class-10'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-10</option>
                            <option value='Class-11' <?php if('Class-11'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-11</option>
                            <option value='Class-12' <?php if('Class-12'==$list_materials->class){ echo  'selected="selected"' ;} ?>>Class-12</option>
                        </select> 
                    </td>
				    <td> Title <br>
				        <input type='text' name='title' value="<?php echo $list_materials->title;?>" style="width: 180px;" required>
				    </td>
				</tr>
				<tr>
				    <td>Status <br>
				        <select name='status' require>
				            <option>Select-status</option>
				            <option value='Free' <?php if('Free'==$list_materials->status){ echo  'selected="selected"' ;} ?>>Free</option>
				            <option value='Paid' <?php if('Paid'==$list_materials->status){ echo  'selected="selected"' ;} ?>>Paid</option>
				        </select>
				    </td>
				    <td>Type <br>
				        <select name='type' require>
				            <option>Select-type</option>
				            <option value='A'>A</option>
				            <option value='B'>B</option>
				        </select>
				    </td>
				    <td>Pice =</td>
				    <td> 
				        <input type='number' name='price'  value="<?php echo $list_materials->price;?>" style="width: 180px;" required>
				    </td>
				</tr>
				<tr>
				    	<!--<td>
			   			 Choose your file<br />  <input name="folder" type="file" id="csv" /> 
			            </td>-->
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

<!--<div class="row-fluid sortable">
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
	            <th>
	                Subject
	            </th>
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
	                <td><?php echo $row['academic_year']; ?></td>
	                <td><?php echo $row['clevel']; ?></td>
	                <td><?php echo $row['class']; ?></td>
	                <td><?php echo $row['subject']; ?></td>
	                <td><?php echo $row['title']; ?></td>
	                <td><?php echo $row['status']; ?></td>
	                <td><?php echo $row['price']; ?></td>
	                 <td><a href="<?php echo base_url().'manage/franchise/studymat_delete/';?><?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" >Delete</a></td>
					  <td><a href="<?php echo base_url().'manage/franchise/studymat_edit/';?><?php echo $row['id']; ?>"  >Edit </a></td>
	            </tr>
	        <?php 
	           $i=$i+1; }
	       }?>
	    </table>
    </div>
    
</div>-->



<?php include('footer.php'); ?>