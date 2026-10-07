<?php include('header.php');

// print_r($franchise2);
?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">Schedule</a> <span class="divider">/</span></li>
		   <li>Lunar</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Activate Registration</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
    <h3 style='color:green;'>
        <?php
            if(!empty($message)){
                echo $message;
            }
        ?>
    </h3>
    <form method='post' class='table-responsive'>
                        <!----------------- Franchise ------------------->       
        <table  cellpadding="15px" >
				<tr>
				    
                 
				   <!-- <td>Country:<br />-->
						 <!--<h3><b>School : </b></h3>-->
       <!--                         <select name="country" id="country" style="width: 220px;"  required>-->
       <!--                             <option value=''>-- Select Country --</option>-->
       <!--                             <option value='105'>INDIA</option>-->
                                     <?php
                                     
                                   //  $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                    // foreach ($query->result() as $row)
                                    //{
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <!--<option value="<?php //echo $row->country_id;?>" <?php  //if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php //echo $row->country_name;?></option>-->
                                  <?php
                                   // }
                                    
                                    ?>
      <!--                          </select>-->
					 <!--</td>-->
					 
					 <!--<td>State<span style='color:red;'>*</span>:<br />-->
      <!--                          <select name="state_id" id="state_id" style="width: 220px;"  required>-->
      <!--                              <option value=''>-- Select State --</option>-->
                                    
                                     <?php
                                       
                                    // foreach ($stateload as $row)
                                    // { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <!--<option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>-->
                                  
                                  <?php  
                                   // }
                                    
                                    ?>
                                <!--</select>-->
					 <!--</td>-->
					 
					 <!--<td>Franchise:<span style='color:red;'>*</span><br />-->
                                <!--<select name="franchise_id" id="franchise_id" style="width: 220px;"  required>-->
                                    <!--<option value=''>-- Select franchise --</option>-->
                                    
                                     <?php
                                       
                                   // foreach ($franchiseload as $row)
                                //    { ?>
                                <!--<option value="<?php //echo $row->state_subdivision_id;?>"> <?php //echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <!--<option value="<?php //echo $row['franchise_id'];?>" <?php  //if($result['franchise_id']==$row['franchise_id']) { echo 'selected="selected"'; } ?> > <?php // echo $row['franchise_name'];?></option>-->
                                  
                                  <?php  
                                  // }
                                    
                                    ?>
                                <!--</select>-->
					 <!--</td>-->
					
					 
					 
				
			            <!--<td>Area Code:<br />-->
						 <!--<h3><b>School : </b></h3>-->
                                <!--<select name="area" id="area" style="width: 220px;"  >-->
                                    <!--<option value=''>-- Select Area --</option>-->
                                    <?php
                                     
                                    // foreach ($areaload as $row)
                                    // {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <!--<option value='<?php echo $row['area_code'];?>'<?php  if($result['area']==$row['area_code']) { echo 'selected="selected"'; } ?>><?php echo $row['area_code'];?></option>-->
                                 
                                  <?php 
                                    // }
                                    
                                    ?>
                                    
                                <!--</select>  -->
    					<!--</td>-->
    					
    					 <td>Period:<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period_id" id="period" style="width: 200px;"  required>
                                    <option value=''>-- Select Period --</option>
                                    <?php
                                     
                                    foreach ($periodload as $row)
                                    {
                                    
                                     ?>
                                    <option value='<?php echo $row->period_id;?>'<?php  if($result['period_id']==$row->period_id) { echo 'selected="selected"'; } ?>><?php echo $row->academic_year;?></option>
                                 
                                  <?php 
                                    }
                                    
                                    ?>
                                    
                                </select>  
    					</td>
    					
    					<td>
    				        Season<span style='color:red;'>*</span><br>
    				        <select name='season' style="width: 200px;"  required>
    				            <option value=''>-- select Season --</option>
    				            <option value='Season-1'>Season-1</option> 
    				            <option value='Season-2'>Season-2</option>
    				            <option value='Season-3'>Season-3</option> 
    				            <option value='Season-4'>Season-4</option> 
    				            <option value='Season-5'>Season-5</option> 
    				            <option value='Season-6'>Season-6</option> 
    				            <option value='Season-7'>Season-7</option>
    				            <option value='Season-8'>Season-8</option> 
    				            <option value='Season-9'>Season-9</option> 
    				            <option value='Season-10'>Season-10</option> 
    				            <option value='Season-11'>Season-11</option> 
    				            <option value='Season-12'>Season-12</option> 
    				            
    				        </select>
    				    </td>
    					
    					<td>
                            Subject:<span style='color:red;'>*</span><br>
                            <!--<input type='text' name='subject' class='form-control' >-->
                            <select name="subject" id="subject" style="width: 200px;"  required>
                                    <option value=''>-- Select Subject --</option>
                                   
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `lunar_subjects`;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->subject_key;?>" <?php  if($result['subject']==$row->subject_key) { echo 'selected="selected"'; } ?> > <?php echo $row->subject_key;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                                <br>
                            
                        </td>
                        <td>       
                                Varient:<span style='color:red;'>*</span><br>
                            <!--<input type='text' name='type' class='form-control' style="width: 200px;" >-->
                            
                            <!--Difficulty Level:-->
                                <select name="varient" id="varient" style="width: 200px;"  required>
                                    <!--<option value=''>-- Select Varient --</option>-->
                                   
                                    
                                </select>
                       
                        </td> 
                        <td>
                            Difficulty Level:<span style='color:red;'>*</span><br>
                            <select name="level" id="level" style="width: 200px;"  required>
                                    <option value=''>-- Select Level --</option>
                                   
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_level_byproduct` WHERE product_name='Lunar Skill Test';"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                    <option value="<?php echo $row->level_id;?>" <?php  if($result['level']==$row->level_id) { echo 'selected="selected"'; } ?> > <?php echo $row->level_name;?></option>
                                    <?php
                                        }
                                    
                                    ?>
                                </select>
                            
                        </td>
                        
                    </tr>
                
				    <tr> 
                        <!--<td>-->
                        <!--    Series:<span style='color:red;'>*</span><br>-->
                        <!--        <select name="series" id="series" style="width: 200px;"  required>-->
                                  
                                    
                        <!--        </select>-->
                            
                            
                        <!--</td>-->
                        
                
                        
                  
                  
                
                        
                       
					 <!--</tr> -->
					 
					 
				<!--<tr>-->
				<!--    <td>School:<br />-->
				<!--    <div id='school'>-->
					     
				<!--	 </div>-->
				<!--	</td>-->
				<!--</tr>-->
				
				<!--<tr>-->
				
				      <!--<td>Associates:<span style='color:red;'>*</span><br />-->
						 <!--<h3><b>School : </b></h3>-->
                                <!--<select name="associate_id" id="associate_id" style="width: 200px;"  required>-->
                                <!--    <option value=''>-- Select Associate --</option>-->
                                     <?php
                                     
                                    
                                    // foreach ($associates as $row)
                                    // { ?>
                                
                                <!--<option value="<?php //echo $row['associate_id'];?>" <?php  //if($result['associate_id']==$row['associate_id']) { echo 'selected="selected"'; } ?> > <?php //echo $row['first_name'].' '.$row['last_name'];?></option>-->
                                  
                                  <?php //  }
                                    
                                    ?>
                                        
                                <!--</select>-->
					 <!--</td>-->
				    <td>
				        Franchise %<span style='color:red;'></span><br>
				        <select name='franchise_percentage' style="width: 200px;"  >
				            <option value=''>-- select franchise cut --</option>
				            <option value='5'>5%</option> 
				            <option value='10'>10%</option>
				            <option value='15'>15%</option> 
				            <option value='20'>20%</option> 
				            <option value='25'>25%</option> 
				            <option value='35'>35%</option> 
				            <option value='40'>40%</option> 
				            <option value='45'>45%</option> 
				            <option value='50'>50%</option> 
				            <option value='55'>55%</option> 
				            <option value='60'>60%</option> 
				            <option value='65'>65%</option> 
				            <option value='70'>70%</option> 
				            <option value='75'>75%</option> 
				            <option value='80'>80%</option> 
				        </select>
				    </td>
				    
				    <td>
				        Associate %<span style='color:red;'>*</span><br>
				        <select name='franchise_cut' style="width: 200px;"  required>
				            <option value=''>-- select associate cut --</option>
				            <option value='5'>5%</option> 
				            <option value='10'>10%</option>
				            <option value='15'>15%</option> 
				            <option value='20'>20%</option> 
				            <option value='25'>25%</option> 
				            
				            <option value='30'>30%</option> 
				            <option value='35'>35%</option>
				            <option value='40'>40%</option> 
				            <option value='45'>45%</option> 
				            <option value='50'>50%</option> 
				            <option value='55'>55%</option> 
				            <option value='60'>60%</option> 
				            <option value='65'>65%</option> 
				            <option value='70'>70%</option> 
				        </select>
				    </td>
				    
			        <td>
				        Management %<span style='color:red;'>*</span><br>
				        <select name='management_percentage' style="width: 200px;"  required>
				            <option value=''>-- select management cut --</option>
				            <option value='5'>5%</option> 
				            <option value='6'>6%</option> 
				            <option value='7'>7%</option> 
				            <option value='8'>8%</option> 
				            <option value='9'>9%</option> 
				            <option value='10'>10%</option> 
				            <option value='12'>12%</option> 
				            <option value='14'>14%</option> 
				            <option value='15'>15%</option> 
				            <option value='16'>16%</option> 
				            <option value='18'>18%</option> 
				            <option value='20'>20%</option> 
				            <option value='22'>22%</option>
				        </select>
				    </td>
				    
				    <td>
				        Aviansys %<span style='color:red;'>*</span><br>
				        <select name='aviansys_percentage' style="width: 200px;"  required>
				            <option value=''>-- select aviansys cut --</option>
				            <option value='5'>5%</option> 
				            <option value='6'>6%</option> 
				            <option value='7'>7%</option> 
				            <option value='8'>8%</option> 
				            <option value='9'>9%</option> 
				            <option value='10'>10%</option> 
				            <option value='12'>12%</option> 
				            <option value='14'>14%</option> 
				            <option value='15'>15%</option> 
				            <option value='16'>16%</option> 
				            <option value='18'>18%</option> 
				            <option value='20'>20%</option> 
				            <option value='22'>22%</option>
				        </select>
				    </td>
				    
				    
			
				    <!--<td>School Fix Amount<br>-->
				    <!--    <input name='school_amount' type='text' class='form-control' >-->
				    <!--</td>-->
				    
				    <td>Registration Start Date:<span style='color:red;'>*</span><br />
					     <input type='date' name='start_date' class='form-control' style="width: 190px;"  required>
                    </td>
                </tr>
				<tr>
					 </td>
					 <td>Registration End Date:<span style='color:red;'>*</span><br />
					     <input type='date' name='end_date' class='form-control' style="width: 190px;"  required>

					 </td>
					 
					  <td>
					      CRM %<span style='color:red;'>*</span><br>
                                <select name="crm_per" style="width: 220px;" >
                                    <option value="">-- select CRM % --</option>
                                    <?php
                                    $percentages = [0,1,2,3,4,5,6,7,8,9,10];
                                    foreach ($percentages as $percent) {
                                        $selected = (isset($result) && $result['crm_per'] == $percent) ? 'selected' : '';
                                        echo "<option value='$percent' $selected>$percent%</option>";
                                    }
                                    ?>
                                </select>
				          <!--     CRM Fix Amount:<span style='color:red;'>*</span><br />-->
    					     <!--<input type='text' name='crm_fix' class='form-control' style="width: 190px;"  required>-->
				    </td>
				    
					    
					    
					  
					    
					    <td>
				               Title:<br />
    					     <input type='text' name='title' class='form-control' style="width: 190px;"  >
				        </td>
				        <td>
				               Description:<br />
    					    <textarea name='description' class='form-control' style="width: 190px;"  ></textarea>

				        </td>
					 
					 
					 <!--<td>Price Code<span style='color:red;'>*</span><br>-->
    		<!--		        <select name='amount' class='form-control' style="width: 200px;"  required >-->
    		<!--		            <option value=''>-- select pricecode --</option>-->
    				            <?php // foreach($pricecodes as $code){ ?>
    				                <!--<option value='<?php // echo $code['amount'];?>' > <?php // echo $code['price_code']; ?> </option>-->
    				            <?php //} ?>
    				            
    				    <!--    </select>-->
				        
				        <!--</td>-->
					 
			    
					    <!--<td >-->
    				 <!--       School:<br />-->
    					<!--     <input type='text' name='school' class='form-control' >-->
    					<!--</td>-->
					 
					    
    				 <!--    <td >-->
    				 <!--       Material Amount:<br />-->
    					<!--     <input type='text' name='material' class='form-control' required>-->
    					<!--</td>-->
    					<!--<td >-->
    				 <!--       Orientation Amount:<br />-->
    					<!--     <input type='text' name='orientation' class='form-control' required>-->
    					<!--</td>-->
    					<!--<td >-->
    				 <!--       Mock Amount:<br />-->
    					<!--     <input type='text' name='mock' class='form-control' required>-->
    					<!--</td>-->
    				<!--</tr>-->
    				<!--<tr>-->
    				
				    
				</tr>
				<tr>
				    
				   
				        
				    </tr>
				    
				    <tr>
				    
				    <td colspan='5'>    
					    <?php 
					    
					    $query = $this->db->get('class');
                        $classes = $query->result_array();
					    foreach ($classes as $class): ?>
            
                        <input 
                            type="checkbox" 
                            name="classes[]" 
                            value="<?= htmlspecialchars($class['class_name']); ?>"   > 
                            <?= htmlspecialchars($class['class_name']); ?> 
                            &nbsp
                            &nbsp    
                            
                        <?php endforeach; ?>
				    </td>	
				    
				        <td> <input type="submit" class='btn btn-primary btn-lg' name="submit" value="Launch" /> </td>
			
				</tr>
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
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




$("#subject").change(function(){
    var subject_key =this.value;
     //alert(franchise_id);
     var BASE_URL="<?php echo base_url();?>";
    $.ajax({
    url:"<?php echo base_url();?>manage/ajax/getlunar_subject_key",
    data:{subject_key:subject_key},
    type: 'post',
    success:function(result)
    {
    	//alert(result);
    	 $("#varient").html(result);
    	 
    
    }});
});

$("#varient").change(function(){
    var subject_key = $('#subject').val();
    var period = $('#period').val();
    var varient= this.value;
    
     //alert(franchise_id);
     var BASE_URL="<?php echo base_url();?>";
    $.ajax({
    url:"<?php echo base_url();?>manage/ajax/getlunar_subject_varient_series",
    data:{subject_key:subject_key,period:period,varient:varient},
    type: 'post',
    success:function(result)
    {
    	//alert(result);
    	 $("#series").html(result);
    	 
    
    }});
});



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
    url:"<?php echo base_url();?>manage/ajax/school_list_checkbox",
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