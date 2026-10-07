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
				    
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option value=''>-- Select Country --</option>
                                    <option value='105'>INDIA</option>
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->country_id;?>" <?php  if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 220px;"  required>
                                    <option value=''>-- Select State --</option>
                                    
                                     <?php
                                       
                                     foreach ($stateload as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					  <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 220px;"  required>
                                    <option value=''>-- Select Franchise --</option>
                                     <?php
                                     
                                    
                                     foreach ($franchise2 as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['franchise_id'];?>" <?php  if($result['franchise_id']==$row['franchise_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['franchise_code'].' '.$row['franchise_first_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                        
                                </select>
					 </td>
					 
					 
				
			                <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 220px;"  required>
                                    <option value=''>-- Select Area --</option>
                                    <?php
                                     
                                     foreach ($areaload as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row['area_code'];?>'<?php  if($result['area']==$row['area_code']) { echo 'selected="selected"'; } ?>><?php echo $row['area_code'];?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select>  
					 </td>
					
						<td >
						 School : <br>
						 
                                 <select name="school"  id='school' style='width: 220px;'  required>
                                 
                                      <option value="">-- Select School --</option>
                                      <?php
                                      if($result['school']=='All'){?>
                                          <option value="All" selected='selected'>-- All School --</option>
                                     <?php }
                                     
                                      foreach($schoolload as $row){
                                     ?>
                                    <option value='<?php echo $row['id'];?>'<?php  if($result['school']==$row['id']) { echo 'selected="selected"'; } ?>><?php echo $row['school_name'];?></option>
                                
                                  <?php  }
                                    
                                    ?>
                                </select>
                              
                               
					    </td>
					 <!--</tr> -->
			   <!-- <tr>      -->
					   
				
				    <td> <input type="submit" class='btn btn-primary' name="submit" value="Search" /> </td>
			
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
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
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
								<th>Franchise</th> 
								<!--<th>State</th>-->
								<th>Mobile</th>	
								<th>Email</th>
								
								
								<th>Area Code</th> 
								<th>Address</th>
								
							 </tr>
							<?php    
							  $i=0;  
							  
							  //print_r($list_materials);die;
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
								echo $details->school_name;
									?> </td>
									<td align="CENTER">
									    <?php 
									    
									    echo $details->franchise_first_name.' '.$details->franchise_last_name; 
									    
									    ?>
									</td>
									<td align="CENTER"> <?php  echo $details->mobile;
									
									?> </td>
									<td align="CENTER"> <?php  echo $details->email;  
									
									?> </td>
									<td align="CENTER"> <?php  echo $details->franchise_code;  
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