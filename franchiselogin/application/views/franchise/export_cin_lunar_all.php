<?php include('header.php');

// print_r($result);

?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">Lunar</a> <span class="divider">/</span></li>
		   <li>CIN Export</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> CIN List</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
    <h3 style='color:crimson;'>
        <?php
            if(!empty($message)){
                echo $message;
            }
        ?>
    </h3>
    <form method='post' class='table-responsive'>
                        <!----------------- Franchise ------------------->       
        <table  cellpadding="5px" >
				<tr>
				    <td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="period" id="period" style="width: 200px;"  required>
                            <!--<option style='display:none;'>Select period</option>-->
                            
                             <?php
                             
                             $query = $this->db->query("SELECT * FROM `period` where period_id >13;");
                            
                             foreach ($periodload as $row)
                            {
                                //echo "<option value='{$row['period_id']}'>{$row['academic_year']}</option>";

                            ?>
                            <option value="<?php echo $row['period_id'] ?>" <?php if(isset($result['period']) && $result['period'] == $row['period_id']) { echo "selected"; } ?>><?php echo $row['academic_year'] ?></option>
                            
                            <?php
                            }
                            
                            ?>
                        </select>
					</td>
			    
    			 <!--   <td>Status:<br>-->
    				<!--	<select name='status' style='width:220px;'>-->
    				<!--	    <option value='All' <?php if(isset($result['status']) && $result['status']=='All') { echo "selected"; } ?>>All</option>-->
    
    				<!--	    <option value='Q' <?php if(isset($result['status']) && $result['status']=='Q') { echo "selected"; } ?>>Q</option>-->
    				<!--	    <option value='NQ' <?php if(isset($result['status']) && $result['status']=='NQ') { echo "selected"; } ?>>NQ</option>-->
    				<!--	</select>-->
    				<!--</td>-->
    
                    <td>
				        <label>Subject</label>
					    <select name='subject' style='width:200px;' required>
					        <option value=''>select Subject</option>
				        <?php foreach($subject as $res){ ?>
				                <option value='<?php echo $res->Subject_key; ?>' <?php  if($res->Subject_key==$result['subject']) { echo 'selected="selected"'; } ?>><?php echo $res->Subject_key; ?></option>
				            <?php } ?>
				        </select>
				    </td>
				    
				    <td>
					    <label>Lunar Series</label>
					        <select name='series' style='width:200px;' required>
					            <option value=''>select Series</option>
					            <?php foreach($series as $res){ ?>
					                <option value='<?php echo $res->series; ?>' <?php  if($res->series==$result['series']) { echo 'selected="selected"'; } ?>><?php echo $res->series; ?></option>
					            <?php } ?>
					        </select>
					    
				    </td>
				    
					<td>
					    <label>Type</label>
					        <select name='type' style='width:200px;' required>
					            <option value=''>select type</option>
					            <?php foreach($type as $res){ ?>
					                <option value='<?php echo $res->type; ?>' <?php  if($res->type==$result['type']) { echo 'selected="selected"'; } ?>><?php echo $res->type; ?></option>
					            <?php } ?>
					        </select>
					    
				    </td> 
				<!--</tr> -->
				<!--<tr> -->
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="level" id="level" style="width: 200px;"  required>
                           <option value=''>select level</option>
                           <?php foreach($level_load as $periodval) : ?>
                            <option value="<?php echo $periodval['level_id'] ?>" <?php if(isset($result['level']) && $result['level'] == $periodval['level_id']) { echo "selected"; } ?>><?php echo $periodval['level_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
					</td>
					
					<td>Class:<br/>
						<!--<h3><b>School : </b></h3>-->
                        <select name='class' id="" style="width: 200px;"  required>
                            <option value='All'  <?php if(isset($result['class']) && $result['class'] == 'All') { echo "selected"; } ?>>All Class</option>
                           <?php foreach($classload as $periodval) : ?>
                            <option value="<?php echo $periodval['class_name'] ?>" <?php if(isset($result['class']) && $result['class'] == $periodval['class_name']) { echo "selected"; } ?>><?php echo $periodval['class_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
					</td>
					
			        <td> 
			            <br /><input type="submit" class='btn btn-info' name="submit" value="Submit" />
			        </td>
			        
				</tr> 
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->

 <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($message)){
        			    echo $message;
        			}?>
			</h4></div>
				 <?php  if(!empty($pay_list)){ ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<input type="submit" name="Export" value="Export" class='btn btn-warning btn-lg' /> 
							 <!--<tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Last 10 Papers Uploaded.</td></tr>-->
							 <tr>
								<th>SI No</th> 
								<th>PRID</th>
								<th>CIN</th>
								<th>Student Name</th>
								<th>Subject</th>
								<th>Series</th>
								<th>Class</th>
								<th>School</th> 
								<!--<th>Associate</th> -->
								<!--<th>State</th>-->
								<th>Mobile</th>	
								<th>Email</th>
								
								
								<th>Associate</th> 
								<th>Address</th>
								
							 </tr>
							<?php    
							  $i=0;  
							  
							 // print_r($pay_list);die;
							  foreach($pay_list as $details){ 
							     //print_r($details);
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php   
								echo $details->prid;
									?> </td>
									
									<td align="CENTER"> <?php   
								echo $details->cin;
									?> </td>
									<td align="CENTER"> <?php   
								echo $details->student_name;
									?> </td>
									
									<td align="CENTER"> <?php   
								echo $details->subject;
									?> </td>
									<td align="CENTER"> <?php   
								echo 'Series-'.$details->series;
									?> </td>
									
									
									<td align="CENTER"> <?php   
								echo $details->class;
									?> </td>
									
									<td align="CENTER"> <?php  
								        
								        
								        if(empty($details->school_name)){
                                            $school_name = $this->db->get_where('school_new',array('id'=>$details->school_id))->row()->school_name;
                                        }else{
                                            $school_name = $details->school_name;
                                        } 
								        
								        echo $school_name;
								        
									?> </td>
									
									<td align="CENTER"> <?php  echo $details->stud_phone;
									
									?> </td>
									<td align="CENTER"> <?php  echo $details->stud_email;  
									
									?> </td>
									<td align="CENTER"> <?php  echo $details->first_name.' '.$details->last_name;  
								    ?>
									</td>
									<td align="CENTER"> <?php  echo $details->address1;  
								
									?> </td>
									
							 </tr>
							<?php  } ?>
							
				</TABLE>
				<?php }else{ ?>
				<h4>
				<?php echo 'No Data Found..';?>
				</h4>
				<?php  } ?>
			</div>
	<!-------------->
	</form> 

 

 
					</div>
				</div>
			</div>
	



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Migrate (Fix old plugins) -->
<script src="https://code.jquery.com/jquery-migrate-3.4.1.min.js"></script>

<!-- Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- html2pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
<?php include('footer.php'); ?>


<script type="text/javascript">
$("#country").change(function(){
var country_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/getstateAjax",
data:{country_id:country_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#state_id").html(result);
	 

}});
});


$("#area").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_list",
data:{area_code:area_code},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

}});
});

$("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/franchiseList__",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});

$("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/statewisearea",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>