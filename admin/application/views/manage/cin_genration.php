<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();   
	 
	 //print_r($result);
?> 

        <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
	
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	    <br>
	 <select id="product-select">
    <option value="" selected disabled>Choose Franchise</option>
    <option value="state_franchise">State Franchise</option>
    <option value="national_franchise">National Franchise</option>
</select>
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" style="display:none"> 
			<table  cellpadding="5px" >
				<tr>
				    	<td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style='display:none;'>Select Period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    //echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                                    
                                    ?>
                                <option value="<?php echo $row->period_id;?>" <?php  if($result['period']==$row->period_id) { echo 'selected="selected"'; } ?> > <?php echo $row->period_name;?></option>
                                  <?php 
                                    
                                    }
                                    
                                    ?>
                                </select>
					 </td>
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option style='display:none;'>Select Country</option>
                                    
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
                                    <option style='display:none;'>Select State</option>
                                    
                                     <?php
                                       $query = $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result();
                                     
                                    
                                     foreach ($query as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row->state_subdivision_id;?>" <?php  if($result['state_id']==$row->state_subdivision_id) { echo 'selected="selected"'; } ?> > <?php echo $row->state_subdivision_name;?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					  <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 220px;"  required>
                                    
                                     <?php
                                     
                                     
                                     //  $query = $this->db->get_where('franchise' if(isset($result['state_id'])){, array('state_id'=>$result['state_id'])})->result();
                                     $query = $this->db->get_where('franchise', isset($result['state_id']) ? array('state_id' => $result['state_id']) : null)->result();

                                    
                                     foreach ($query as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row->franchise_id;?>" <?php  if($result['state_id']==$row->franchise_id) { echo 'selected="selected"'; } ?> > <?php echo $row->username;?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                        
                                </select>
					 </td>
					 <td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 220px;"  required>
                                    <option value=''>-- Select Product --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name ");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row->product_name;?>'<?php  if($result['product']==$row->product_name) { echo 'selected="selected"'; } ?>><?php echo $row->product_id.'-'.$row->product_name;?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 
					 <td>
					        <div id='series'>
					            
					            <label>Subject</label>
							    <select name="subject" id="subject" style="width: 220px;"  >
                                    <option value=''>-- select subject --</option>
                                    <?php
                                     
                                     $query = $this->db->query("SELECT * FROM lunar_subjects;");
                                    //$query = $this->db->get_where('areas', isset($result['state_id']) ? array('state_id' => $result['state_id']) : null)->result();

                                     foreach ($query->result() as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row->subject_key;?>'<?php  if($result['subject_key']==$row->subject_key) { echo 'selected="selected"'; } ?>><?php echo $row->subject_key;?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select> 
					            
					            
							    <label>Lunar Series</label>
							    
							    <select name="serie" id="serie" style="width: 220px;"  >
                                    
                                    
                                
                                    
                                </select>  
							    
							     
							    <label>Lunar Type</label>
							    
							    <select name="type" id="type" style="width: 220px;"  >
                                    
                                    
                                
                                    
                                </select>      
							    
							</div> 
					 </td>
					</tr>
					
					<tr>
			                <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 220px;"  >
                                    
                                    <?php
                                     
                                     $query = $this->db->query("SELECT * FROM areas;");
                                    //$query = $this->db->get_where('areas', isset($result['state_id']) ? array('state_id' => $result['state_id']) : null)->result();

                                     foreach ($query->result() as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row->area_code;?>'<?php  if($result['area']==$row->area_code) { echo 'selected="selected"'; } ?>><?php echo $row->area_code;?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select>  
					 </td>
					
						<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="school"  id='school' style='width: 220px;'  >
                                 
                                      <option value="">Select School</option>
                                     
                                </select>
                              
                               
					 </td>
					 	<td>
			   			 Choose your PRID result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
					 
					
			   <td> <br /><input type="submit" class='btn btn-primary' name="submit" value="Submit" /> </td>
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
								<th>SI no</th><th>CIN</th><th>STUDENT NAME</th> <th>CLASS </th> <th>PERIOD ID</th> 
								<th>PRODUCT NAME</th> 
								<th>SCHOOL </th>
								
								<th>Upload Report</th> 
								
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
									<td align="CENTER"> <?php  echo $details[4];  ?> </td>
									<td align="CENTER"> <?php  echo $details[5];  ?> </td>
									<td align="CENTER"> <?php  echo $details[6];  ?> </td>
									<!--<td align="CENTER"> <?php  //echo $details[5]."( ".$details[6]." )"; ?> </td>-->
							 </tr>
							<?php  endforeach; ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
	    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form2" style="display:none"> 
			<table  cellpadding="5px" >
				<tr>
				    	<td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style='display:none;'>Select Period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    //echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                                    
                                    ?>
                                <option value="<?php echo $row->period_id;?>" <?php  if($result['period']==$row->period_id) { echo 'selected="selected"'; } ?> > <?php echo $row->period_name;?></option>
                                  <?php 
                                    
                                    }
                                    
                                    ?>
                                </select>
					 </td>
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option style='display:none;'>Select Country</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->country_id;?>" <?php  if('105'==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="nationalfranchise_id" style="width: 220px;"  required>
                                    
                                     <?php
                                     
                                     
                                     //  $query = $this->db->get_where('franchise' if(isset($result['state_id'])){, array('state_id'=>$result['state_id'])})->result();
                                     $query = $this->db->get_where('franchise', array('franchise_type'=>'NF'))->result();

                                    
                                     foreach ($query as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row->franchise_id;?>" <?php  if($result['state_id']==$row->franchise_id) { echo 'selected="selected"'; } ?> > <?php echo $row->username;?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                        
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="nationalstate_id" style="width: 220px;"  required>
                                    <option style='display:none;'>Select State</option>
                                    
                                     <?php
                                       $query = $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result();
                                     
                                    
                                     foreach ($query as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row->state_subdivision_id;?>" <?php  if($result['state_id']==$row->state_subdivision_id) { echo 'selected="selected"'; } ?> > <?php echo $row->state_subdivision_name;?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					  
					 <td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 220px;"  required>
                                    <option value=''>-- Select Product --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name ");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row->product_name;?>'<?php  if($result['product']==$row->product_name) { echo 'selected="selected"'; } ?>><?php echo $row->product_id.'-'.$row->product_name;?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                </select>
					 </td>
					 
					</tr>
					
					<tr>
			                <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="statearea" style="width: 220px;"  >
                                    
                                  
                                    
                                </select>  
					 </td>
					
						<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="school"  id='nationalschool' style='width: 220px;'  >
                                 
                                     
                                     
                                </select>
                              
                               
					 </td>
					 	<td>
			   			 Choose your PRID result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
					 
					
			   <td> <br /><input type="submit" class='btn btn-primary' name="submit" value="Submit" /> </td>
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
								<th>SI no</th><th>CIN</th><th>STUDENT NAME</th> <th>CLASS </th> <th>PERIOD ID</th> 
								<th>PRODUCT NAME</th> 
								<th>SCHOOL </th>
								
								<th>Upload Report</th> 
								
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
									<td align="CENTER"> <?php  echo $details[4];  ?> </td>
									<td align="CENTER"> <?php  echo $details[5];  ?> </td>
									<td align="CENTER"> <?php  echo $details[6];  ?> </td>
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

 <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
           $("#product").change(function(){
        
        var product=this.value;
// 		alert(product_id);
		if (product == 'Lunar Skill Test') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
    }); 
         jQuery("#series").hide();    
           
        });
        </script>
<?php include('footer.php'); ?>


<script type="text/javascript">

$("#subject").change(function(){
    var subject_key =this.value;
     //alert(franchise_id);
     var BASE_URL="<?php echo base_url();?>";
    $.ajax({
    url:"<?php echo base_url();?>manage/ajax/getlunar_series_per_subject",
    data:{subject_key:subject_key},
    type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#serie").html(result);
        	 
        
        }});
    });

$("#serie").change(function(){
    var serie = this.value;
     //alert(franchise_id);
     var BASE_URL="<?php echo base_url();?>";
    $.ajax({
    url:"<?php echo base_url();?>manage/ajax/getlunar_type_per_serie",
    data:{serie:serie},
    type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#type").html(result);
        	 
        
        }});
    });


$("#area").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_list_active",
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
url:"<?php echo base_url();?>manage/ajax/franchiseList",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});

$("#franchise_id").change(function(){
var franchise_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/AreaCode",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


$("#nationalstate_id").change(function(){
var state_id =this.value;
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/AreaCodeState",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#statearea").html(result);
	 

}});
$.ajax({
url:"<?php echo base_url();?>manage/ajax/ActiveSchool",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#nationalschool").html(result);
	 

}});
});
 $(document).ready(function(){
  
$('#product-select').on('change', function () {
    let pid = $(this).val();

   if (pid === "state_franchise" || pid === "national_franchise") {
        $('#form1').show();
        $('#form2').hide();
    } else {
        $('#form1').hide();
        $('#form2').show();
    }
});
});

</script>