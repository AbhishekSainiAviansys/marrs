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
				    <td>
				        Title <br/>
				        <input type='text' name="paper_name"  style="width: 200px;" >
				        
				    </td>
				    
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product_id" id="product" style="width: 220px;"  required>
                                    <option style=''>-- Select Product --</option>
                                    
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
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style=''>-- Select Period --</option>
                                    
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
                                <select name="clevel" id="level" style="width: 220px;"  required>
                                    <option style=''> - Select level --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_levels`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
                                
                        </td>       
				
					    <td>Class :<br>
                            <?php
                            $query = $this->db->query("SELECT * FROM `class`;");
                            foreach ($query->result() as $row) {
                            ?>
                                <?php echo $row->class_name; ?> -> <input type="checkbox" id="<?php echo $row->class_name; ?>" name="class[]" value="<?php echo $row->class_name; ?>"> &nbsp &nbsp
                                
                            <?php
                            }
                            ?>
                        </td>

			
				</tr> 
				<tr>
				    <td>Mock Paper Maker:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="mock_paper_maker_id" id="mock_paper_maker_id" style="width: 220px;"  >
                                    <option value=''>-- Select Maker --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `material_maker` where status='Active'");
                                    
                                     foreach ($query->result_array() as $row)
                                    {
                                    ?>
                                   <option value="<?php echo $row['material_maker_id'];?>" <?php if($row['material_maker_id']==$result['mock_paper_maker']){ echo  'selected="selected"' ;} ?> ><?php echo $row['name'];?></option>
                                     <?php  
                                    }
                                    
                                    ?>
                                </select> 
					</td>
				    
				   
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
			            
			            
				</tr>
				
				<tr>
				    
				    
				    <!--<td >-->
				    <!--    Status :<br>-->
				    <!--    <select name='payment' id='payment' style="width: 200px;" >-->
				            
			     <!--           <option value=''>-- select status --</option>-->
			     <!--           <option value="Free"><?php echo 'Free'; ?></option>-->
			     <!--           <option value="Paid"><?php echo 'Paid'; ?></option>-->
			                
				    <!--    </select>-->
				    <!--</td>-->
				    
				    
				    
				    <!--<td>-->
			   		<!--	Mock Paper Maker Price<br />  <input  name="maker_price" type="text"  style="width: 200px;" >-->
			     <!--   </td>-->
			     
			     
			     <td>Module <br>
				        <select name='status' style="width: 220px;" required>
				            <option value=''>Select-status</option>
				            <option value='Free-A'>Free Module A</option>
				            <option value='Free-B'>Free Module B</option>
				            <option value='Free-C'>Free Module C</option>
				            <option value='Free-D'>Free Module D</option>
				            <option value='Free-E'>Free Module E</option>
				            <option value='Free-F'>Free Module F</option>
				            
				            <option value='Paid-A'>Paid Module A</option>
				            <option value='Paid-B'>Paid Module B</option>
				            <option value='Paid-C'>Paid Module C</option>
				            <option value='Paid-D'>Paid Module D</option>
				            <option value='Paid-E'>Paid Module E</option>
				            <option value='Paid-F'>Paid Module F</option>
				             <!--<option value='module_b_free'> Module B Free</option>-->
				             <!--<option value='module_a_paid'> Module A Paid</option>-->
				             <!--<option value='module_b_paid'>Module B Paid</option>-->
				             <!--<option value='module_c_paid'>Module C Paid</option>-->
				        </select>
				    </td>

			            
			    	<td id='subjectdiv'>
				        Subject :<br>
				        <select name='subject' id='subject' style="width: 200px;" >
				            <option value=''>-- select subject --</option>
				            <?php foreach($subjects as $subject){ ?>
				            
				            <option value="<?php echo $subject->subject_key; ?>"><?php echo $subject->subject_key; ?></option>
				            <?php } ?>
				        </select>
				    </td>
				    
				    <td id='varientdiv'>
				        Varient :<br>
				        <select name='varient' id='varient' style="width: 200px;" >
				            
				        </select>
				    </td>
				    
				    <td id='seriesdiv'>
				        Series :<br>
				        <select name='series' id='series' style="width: 200px;" >
				            
				        </select>
				    </td>
				
				</tr>
				
				<tr>
				    <td> <br /><input type="submit" class='btn btn-info' name="submit" value="Submit" /> </td>
				    
				</tr>
				<tr>
				    
			            <!--<input type="submit" name="ok" value="" />-->
				</tr>
		   </table>		 
		 </form> 
		    <br />
			<!--------------> 	
			
	<form  method="post" >		
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
								<th>LEVEL</th> 	<th>Class / Type / Module</th><th>Maker Name / Price</th>
								<th>Upload File 1</th>	<th>Upload File 2</th>	<th>Upload File 3</th>	<th>Upload File 4</th> 
								<th>Status</th><th>Action</th>
							 </tr>
							<?php    
							  $i=0;  
							  //print_r($list_materials);die;
							  foreach($list_materials as $details){ 
							     //print_r($details);die;
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
									    echo $result['level_name'].'<br><b>'; 
    									    if($details['product_name'] ==  'Lunar Skill Test'){
        									    echo 'Subject: '.$details['subject'].'<br>';
        									    echo 'Series: '.$details['series'].'<br>';
        									    echo 'Variant: '.$details['sub_type'].'</b>';
    									    }
									    ?>
									</td>
									<td align="CENTER"> 
									
									    <?php  echo $details['class']; 
									            echo '<br>Module: <b>'.$details['type'].'</b>'; 
									            echo '<br>Status: <b>'.$details['pay_status'].'</b>'; 
									    ?> 
									    
									</td>
									<td align="CENTER"> <?php 
									if(!empty($details['mock_paper_maker_id'])){
									$query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$details['mock_paper_maker_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['name'].' / '.$details['maker_price']; 
									}else{
									echo 'Not Assigned to any maker.';  
									}
									
									?> </td>
									
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

$(document).ready(function() {

    $('#subjectdiv').hide();
    $('#varientdiv').hide();
    $('#seriesdiv').hide();
    
    

    $("#product").change(function(){
        
        var product_id =this.value;
         //alert(franchise_id);
         var BASE_URL="https://marrs.in/franchiselogin/";
        $.ajax({
        url:"https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
        data:{product_id:product_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#level").html(result);
        	 
        
        }});
    
    
    
    

        if (product_id === '8') {  // Compare as string
            $('#subjectdiv').show();
            $('#varientdiv').show();
            $('#seriesdiv').show();
        } else {
            $('#subjectdiv').hide();
            $('#varientdiv').hide();
            $('#seriesdiv').hide();
        }

       
    });
    
    
    
    $("#subject").change(function() {
        var subject_key = this.value;

        

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_subject_key",
            data: { subject_key: subject_key },
            type: 'POST',
            success: function(result) {
                $("#varient").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#varient").change(function() {
        var varient = this.value;
        var subject_key = $('#subject').val();
        // var period = $('#period').val();
        
        var period = 15;
        
        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_series",
            data: { subject_key: subject_key,varient:varient,period:period },
            type: 'POST',
            success: function(result) {
                $("#series").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    
    
});

</script>


<?php include('footer.php'); ?>