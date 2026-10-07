<?php include('header.php');

// print_r($result);


?>


			<div>
				<ul class="breadcrumb">
					<li>
						Session:2023-above <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
<?php echo $this->notifications->display_html();?> 
		<form id="search_form" method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Students Registered for Mock Test<?php if($type=='request'){?> Requests<?php }?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
						<div class="controls">
                         <table  cellpadding="5px" >
                            <tr>
                                <td>Period ID<span style='color:red;'>*</span><br>
        				        <select name='period_id' style="width: 220px;" required>
        						<?php //$period = $this->db->get_where('period')->result(); 
        						foreach($loadperiod as $val){ ;?>
        				           <option value='<?php echo $val['period_id'];?>' <?php  if($val['period_id']==$result['period_id']) { echo 'selected="selected"'; } ?>><?php echo $val['period_name'];?></option>
        						<?php }?>
        				        </select>
        				    </td>
                             <td>Product:<span style='color:red;'>*</span><br />
                                 <select name="product" id="product" style="width: 220px;"  required>
                                <option >Select Product</option>
                                
                                 <?php
                                 
                                // $query = $this->db->query("SELECT * FROM products;");
                                 foreach ($productload as $row)
                                { ?>
                                 <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                             <?php  } ?>
                            </select>
                             </td>
                                        
        			<!--	    <td>-->
    					  <!--      <div id='series'>-->
    							<!--    <label>Lunar Series</label>-->
    							<!--        <select name='series' style='width:150px;' >-->
    							<!--            <?php foreach($series as $res){ ?>-->
    							<!--                <option value='<?php echo $res->series; ?>' <?php  if($res->series==$result['series']) { echo 'selected="selected"'; } ?>><?php echo $res->series; ?></option>-->
    							<!--            <?php } ?>-->
    							<!--        </select>-->
    							<!--    <label>Subject</label>-->
    							<!--    <select name='subject' style='width:150px;' >-->
    						 <!--       <?php foreach($subject as $res){ ?>-->
    						 <!--               <option value='<?php echo $res->subject; ?>' <?php  if($res->subject==$result['subject']) { echo 'selected="selected"'; } ?>><?php echo $res->subject; ?></option>-->
    						 <!--           <?php } ?>-->
    						 <!--       </select>-->
    							<!--</div> -->
    					  <!--  </td>	-->
        				    <td>Level<span style='color:red;'>*</span><br>
        				        <select name='level' id='competition_level_id' style="width: 220px;" required>
        				             <option >Select level</option>
                                            
        						<?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($levelload as $val){ ;?>
        				           <option value='<?php echo $val['level_id'];?>' <?php  if($val['level_id']==$result['level']) { echo 'selected="selected"'; } ?>><?php echo $val['level_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        						
        					<td>Class<span style='color:red;'>*</span><br>
        				        <select name="class" id="class" style="width: 220px;"  required>
        				            <option >All Class</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($classload as $val){ ;?>
        				           <option value='<?php echo $val['class_name'];?>' <?php  if($val['class_name']==$result['class']) { echo 'selected="selected"'; } ?>><?php echo $val['class_name'];?> </option>
        						<?php } ?>
        				        </select></td>
        				    
        				    <td>Country<span style='color:red;'>*</span><br>
        				        <select name="country" id="country" style="width: 220px;"  required>
        				            <option >-- select country --</option>
        				            <option value='105' <?php if(isset($result['country']) && $result['country']=='105') { echo 'selected="selected"'; } ?>>INDIA</option>
        				           
        				            <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						    foreach($countryload as $val){ ;?>
            				           <option value='<?php echo $val['country_id'];?>' <?php  if($val['country_id']==$result['country']) { echo 'selected="selected"'; } ?>><?php echo $val['country_name'];?> </option>
            						<?php } ?>
            						
        				            </td>
        				  </tr>  <tr>  
        				  
        				        <td>State<span style='color:red;'>*</span><br>
            				        <select name="state_id" id="state_id" style="width: 220px;"  required>
            				            <option value=''>select state</option>
            				             
            				            <?php 
            				            if(!empty($stateload)){ ?>
            				            <option value='All' <?php  if($result['state_id']=='All') { echo 'selected="selected"'; } ?>>All state</option>
            				            <?php
            				            }
            				            ?>
            				            <?php
            						    foreach($stateload as $val){ ;?>
                				           <option value='<?php echo $val['state_subdivision_id'];?>' <?php  if($val['state_subdivision_id']==$result['state_id']) { echo 'selected="selected"'; } ?>><?php echo $val['state_subdivision_name'];?> </option>
                						<?php } ?>
                						
            				        </select>
        				        </td>
        				        
        				        <td>Franchise<br>
        				        <select name="franchise_id" id="franchise" style="width: 220px;"  >
        				            <option value=''>select franchise</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($franchiseload as $val){ ;?>
        				           <option value='<?php echo $val['franchise_id'];?>' <?php  if($val['franchise_id']==$result['franchise_id']) { echo 'selected="selected"'; } ?>><?php echo $val['franchise_code'];?> </option>
        						<?php } ?>
        				        </select></td>
        				  
        				        <td>Area <br>
        				        <select name="area" id="area" style="width: 220px;"  >
        				            
        				            <?php if(isset($result['area']) && empty($result['area'])){ ?>
        				            
        				                <option value=''>All Area</option>
        				                
        				            <?php } ?>
        				            
        				            <option value=''>select area</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($areaload as $val){ ;?>
        				           <option value='<?php echo $val['area_code'];?>' <?php  if($val['area_code']==$result['area']) { echo 'selected="selected"'; } ?>><?php echo $val['area_code'];?> </option>
        						<?php } ?>
        				        </select></td>
        				  
        				        <td>School<span style='color:red;'>*</span><br>
        				        <select name="school" id="school" style="width: 220px;"  >
        				                <?php if(isset($result['school']) && empty($result['school'])){ ?>
        				            
        				                    <option value=''>All School</option>
        				                
        				                <?php } ?>
        				            
        				            <option value=''>All school</option>
        				           <?php //$level = $this->db->get_where('competition_levels')->result(); 
        						foreach($schoolload as $val){ ;?>
        				           <option value='<?php echo $val['id'];?>' <?php  if($val['id']==$result['school']) { echo 'selected="selected"'; } ?>><?php echo $val['school_name'];?> </option>
        						<?php } ?>
        				        </select></td> 
        				        
        				        <td>
        				            Mock Type<span style='color:red;'>*</span><br>
        				            <select name='mock' style="width: 220px;"  >
        				            <option value='A' <?php if($result['mock']=='A') { echo 'selected="selected"'; }  ?>>Type A</option>
        				            <option value='B' <?php if($result['mock']=='B') { echo 'selected="selected"'; }  ?>>Type B</option>
        				            <option value='C' <?php if($result['mock']=='C') { echo 'selected="selected"'; }  ?>>Type C</option>
        				        </td>
        				        
        				             <td>
        				                <center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
        							<!--<button class="btn" type="reset" onclick="">Reset</button></center>-->
        				             </td> 
                            </tr>
                             
                        </table>
                        
                        
                        
                        
                       <!--    -----------  PERIOD ---------------    --> 
                        
                        <!--    -----------  FRANCHISE ---------------    -->            
							
						</div>
						</div>
					<?php if(!empty($student)){  
				
					$i=1;
					?>
                      <div align="right"> 
                      <input type="text" name="new_class" value="<?php echo $new_class; ?>" style='display:none;'/>
                      <input type="text" name="new_product" value="<?php echo $new_product; ?>" style='display:none;'/>
                      <input type="text" name="new_status" value="<?php echo $new_status; ?>" style='display:none;' />
                     
                      <button type="submit" class="btn btn-primary" id="Export" name="Export"> Export Excel</button></div>
                      <!--onclick="get_csv();--->
						<table class="table table-bordered">
						  <thead>
							  <tr>
                                  <th>SNo</th>
								  <th>CIN</th>
								  <th>Name</th>
								  <th>Level </th>
								  <th>Class</th>
                                  <th>Contact Info</th>
								  <th>School</th>
								  <th>Product Name</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($student as $value){ 
						  
						  if($result['state_id'] == $value['state_id']){
						  ?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td style="width:10%"><?php echo $value['cin']; ?></td>
								<td><?php echo $value['student_name']; ?></td>
								<td><?php echo $value['level_name']; ?></td>
								<td><?php echo $value['class']; ?></td>
                                <td style="width:15%">
                                  Email Id : <?php echo $value['stud_email']."<br>".$value['father_email']."<br>".$value['mother_email']; ?>
                                  <br />
                                  Mobile Phone : <?php   echo $value['stud_phone'].",".$value['father_phone'].",".$value['mother_phone']; ?>
                                  <!--<br />-->
                                  <!--Land Phone :   <?php   //echo $value['std_code']."-".$value['phone']; ?>-->
                                </td>
                                <td  style="width:15%">
                                    School Name : <?php echo $value['school_name']; ?>
                                  <br />
                                    School Address : <?php   echo $value['city']; ?>
                                  </td>
								<td  style="width:15%"><?php  print_r($value['product_name']); ?></td>
								
        <!--                        <td class="center">-->
        <!--                         <a class="btn btn-success" href="<?php echo SITE_URL?>students/view/id/<?php echo $value['student_id']; ?>" title="View" target="_blank">-->
								<!--		<i class="icon-zoom-in icon-white"></i> -->
								<!-- </a>-->
									
								<!-- <a class="btn btn-info" href="<?php echo SITE_URL?>students/edit/id/<?php echo $value['student_id']; ?>" title="Edit">-->
								<!--		<i class="icon-edit icon-white"></i>  -->
								<!-- </a>-->
								
        <!--                        <a class="delete btn btn-danger" href="<?php echo SITE_URL?>students/delete/id/<?php echo $value['student_id']; ?>" title="Delete">-->
								<!--		<i class="icon-trash icon-white"></i> -->
								<!--</a>-->
								<!--</td>-->
							</tr>
						<?php $i=$i+1;} } ?>	
					  </tbody>
					  </table> 
					
			<?php }?>
            <div id="error_div">
                <h4 style='color:crimson;'>
                <?php
                if(!empty($message)){
                    echo $message;
                }
                ?>
                </h4>
            </div>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/library/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        $(document).ready(function(){
            
            
           
           $("#product").change(function(){
        
        var product=this.value;
// 		alert(product_id);
		if (product == 'MaRRS Lunar Olympiads') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
    }); 
         jQuery("#series").hide();    
           
        });
        </script>
<script type="text/javascript">
$(document).ready(function() {
    $("#product").change(function() {
        var product_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: BASE_URL + "manage/ajax/productwiselevel_/",
            data: {product_id: product_id},
            type: 'post',
            success: function(result) {
                $("#competition_level_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $("#state_id").change(function() {
        var state_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: BASE_URL + "manage/ajax/franchiseList_/",
            data: {state_id: state_id},
            type: 'post',
            success: function(result) {
                $("#franchise").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $("#state_id").change(function() {
        var state_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: BASE_URL + "manage/ajax/getAreaAjax_/",
            data: {state_id: state_id},
            type: 'post',
            success: function(result) {
                $("#area").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

$(document).ready(function() {
    $("#area").change(function() {
        var area_code = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: BASE_URL + "manage/ajax/school_list/",
            data: {area_code: area_code},
            type: 'post',
            success: function(result) {
                $("#school").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
$(document).ready(function() {
    $("#country").change(function() {
        var country = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: BASE_URL + "manage/ajax/getstateAjax/",
            data: {country_id: country},
            type: 'post',
            success: function(result) {
                $("#state_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
	
		
		
		
<?php include('footer.php'); ?>