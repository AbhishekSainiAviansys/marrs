<?php include('header.php');

// print_r($franchise2);
?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">Competition</a> <span class="divider">/</span></li>
		   <li>Schedule Lunar</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Schedule List</h2>
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
        <table  cellpadding="5px" >
				<tr>
				    
                 
				    <!--<td>Country:<br />-->
						 <!--<h3><b>School : </b></h3>-->
                                <!--<select name="country" id="country" style="width: 220px;"  required>-->
                                <!--    <option value=''>-- Select Country --</option>-->
                                <!--    <option value='105'>INDIA</option>-->
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <!--<option value="<?php echo $row->country_id;?>" <?php  if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>-->
                                  <?php
                                    // }
                                    
                                    ?>
      <!--                          </select>-->
					 <!--</td>-->
					 
					 <!--<td>State:<br />-->
						 <!--<h3><b>School : </b></h3>-->
                                <!--<select name="state_id" id="state_id" style="width: 220px;"  required>-->
                                <!--    <option value=''>-- Select State --</option>-->
                                    
                                     <?php
                                       
                                    //  foreach ($stateload as $row)
                                    // { 
                                    ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <!--<option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>-->
                                  
                                  <?php   
                                        
                                    // }
                                    
                                    ?>
      <!--                          </select>-->
					 <!--</td>-->
					  
					  <td>Period:<br />
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option value=''>-- Select Period --</option>
                                    <!--<option value='13' <?php  if($result['period']==13) { echo 'selected="selected"'; } ?>>23/24</option>-->
                                    <!--<option value='14' <?php  if($result['period']=='14') { echo 'selected="selected"'; } ?>>24/25</option>-->
                                    <!--<option value='15' <?php  if($result['period']==15) { echo 'selected="selected"'; } ?>>25/26</option>-->
                                    <!--<option value='16' <?php  if($result['period']=='16') { echo 'selected="selected"'; } ?>>26/27</option>-->
                                    <!--<option value='17' <?php  if($result['period']==17) { echo 'selected="selected"'; } ?>>27/28</option>-->
                                    <!--<option value='18' <?php  if($result['period']=='18') { echo 'selected="selected"'; } ?>>28/29</option>-->
                                    
                                    
                                     <?php
                                     
                                    $query = $this->db->query("SELECT * FROM period where period_id > 12;");
                                    
                                    foreach ($query->result() as $row)
                                    {
                                        // echo "<option value='{$row->period_id}'   >{$row->period_name}</option>";
                                        ?>
                                    <option value="<?php echo $row->period_id;?>" <?php  if($result['period']==$row->period_id) { echo 'selected="selected"'; } ?> > <?php echo $row->period_name;?></option>
                                    <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					  
                        <td>
                            Difficulty Level:</br>
                            <select name="level" id="level" style="width: 220px;"  required>
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
					 
				       
				    <td>
                            Subject:</br>
                            <select name="subject" id="subject" style="width: 220px;"  required>
                                <option value=''>-- Select Subject --</option>
                                   
                                <?php
                                     
                                    $query = $this->db->query("SELECT * FROM `lunar_subjects` where status= 'Active';"); 
                                    
                                    foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                    ?>
                                    <option value="<?php echo $row->subject_key;?>" <?php  if($result['subject']==$row->subject_key) { echo 'selected="selected"'; } ?> > <?php echo $row->subject_key;?></option>
                                    
                                    <?php
                                        
                                    }
                                    
                                    ?>
                                </select>
                            
                        </td>
					  
					    
				    <td> <input type="submit" class='btn btn-primary btn-lg' name="submit" value="Search" /> </td>
			
				</tr>
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
    </form>
 
<?php
					if(!empty($list)){
					   // print_r($list);
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
							        <th>Sr. no</th>
							        <th>Registration ID</th>
							        <th>Registration Code</th>
								    <th>Period</th>
								  
								    <th>Competition Level / Class</th>
    								<th>Product Name</th>
    								  <!--<th>Class</th>-->
								    <th>Associate</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>School</th>
                                    <th>Assigned Parts</th>
                                    <th>Pricing</th>
								    <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>		  							
							
						<?php 
						$i=1;
						foreach($list as $value){ 
						
						//print_r($value); ?>	
							<tr>
							    <td><?php echo $i; ?></td>
							    
							    <td><?php echo $value['lunar_schedule_id']; ?></td>
							    
                                <td>
                                    <?php 
                                    
                                    $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE subject='" . $value['subject'] . "'  and clevel='" . $value['level_id'] . "' and product_name='" . $value['product_name'] . "' and series='" . $value['series'] . "' and type='" . $value['type'] . "' and period_id='" . $value['period_id'] . "' ;");
                                    // echo $this->db->last_query();
                                    $res = $query->row();
                                        
                                    if(empty($res)){
                                        echo 'Not Assigned, Please Assigned First.';
                                    }else{
                                        echo $value['registration_code'];
                                    }
                                    
                                    ?>
                                    
                                    
                                    
                                    <!--<div id="qrcode" value='<?php echo $value['registration_code']; ?>'></div>-->
                                                    
                                        <!--<div id="qrcodePreview" style='padding-top:10px;'></div>-->
                                        <!--<div  class="">-->
                                        <!--        <button id="downloadButton" value='<?php echo 'https://marrs.in/student_registration/welcome/scanner/'.$value['registration_code']; ?>' class="btn btn-primary">Download QR Code</button>-->
                                                
                                        <!--</div>-->
                                </td>




                                <td><?php echo $value['period_name']; ?></td>
								
                                <td>
                                    <?php echo $value['level_name']; ?>
                                    <br>
                                    <br>
                                    <?php
                                     
                                    $query = $this->db->query("SELECT * FROM `lunar_schedule_class` WHERE sch_id='" . $value['lunar_schedule_id'] . "' GROUP BY class");

                                    foreach ($query->result() as $row)
                                    {
                                     echo $row->class;
                                     echo '<br>';
                                    }
                                    
                                    ?>
                                    
                                    <a class="delete btn btn-success" href="<?php echo SITE_URL?>lunar/class_update/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" > Update Class </a>
                                    <a class="delete btn btn-warning" href="<?php echo SITE_URL?>lunar/class_update_syllabus/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" > Update Syllabus </a>
                                    
                                    
                                </td>
								 <td>
								     
								    <?php echo $value['product_name'];?>
								    <br/><b>Franchise :</b> <?php echo $value['company_name'];?>
								    <br/><b>Franchise% :</b> <?php echo $value['franchise_percentage'];?>%
								    <br/><b>Associate% :</b> <?php echo $value['associate_cut'];?>%
                                    <br/><b>Subject: </b><?php echo $value['subject'];?>
                                    <br/><b>Series: </b><?php echo $value['series']; ?>
								    <br/><b>Type: </b><?php echo $value['type']; ?>
								 </td>
                                 <td>
                                     <?php 
                                        echo $value['first_name'].' '.$value['last_name']; ?>
                                        
                                        <br/><b>Management:</b> <?php echo $value['management_percentage'];?> %
                                        <br/><b>Aviansys:</b> <?php echo $value['aviansys_percentage'];?> %
                                        <br/><b>CRM:</b> <?php echo $value['crm_per'];?>%
                                    </td>
                                    <!--<td><?php echo $value['franchise_code'] ?></td>-->
                                    <td><?php echo $value['start_date'] ?></td> 
                                    <td><?php echo $value['end_date'] ?></td>
                                    <!--<td><?php echo $value['school'] ?></td>-->
                                    <td>
                                        <b>School Fix: Rs.</b> <?php echo $value['school_amount'];?> 
                                        <br>
                                        <?php
                                         
                                         $i=1;
                                        $query = $this->db->query("SELECT * FROM `lunar_schedule_school`  join school_new on school_new.id=lunar_schedule_school.school_id   WHERE sch_id='" . $value['lunar_schedule_id'] . "';");
    
                                        foreach ($query->result() as $row)
                                        {
                                         echo $i.'. '.$row->school_name;
                                         echo '<br>';
                                         $i=$i+1;
                                        }
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php  
                                        
                                        $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE subject='" . $value['subject'] . "'  and clevel='" . $value['level_id'] . "' and product_name='" . $value['product_name'] . "' and series='" . $value['series'] . "' and type='" . $value['type'] . "' and period_id='" . $value['period_id'] . "' ;");
                                        // echo $this->db->last_query();
                                        $res=$query->row();
                                        
                                        if(empty($res)){
                                            echo 'Not Assigned, Go to assign to cart tab inside Lunar Menu.';
                                        }
                                        else
                                        {
                                            $this->db->select('*');
                                            $this->db->from('active_materials');
                                            $this->db->join('study_material','study_material.id=active_materials.mat_id');
                                            $this->db->where('active_materials.comp_id',$res->id);
                                            $query=$this->db->get();
                                            
                                            $i=1;
                                            foreach($query->result() as $row){
                                                echo $i.': Title : '.$row->title.' Type: '.$row->type.' Status: '.$row->status;
                                                echo '<br>';
                                                $i=$i+1;
                                            }
                                        }
                                    
                                        
                                        
                                        ?>
                                        
                                        
                                    </td>
                                    
                                    
                                    <td>
                                        <?php echo 'Product Price = Rs '.$value['amount'] ?><br/>
                                        
									</td> 
                                
                                        
                                    
							
								    <td class="center">
								    <?php 
    								    $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE subject='" . $value['subject'] . "'  and clevel='" . $value['level_id'] . "' and product_name='" . $value['product_name'] . "' and series='" . $value['series'] . "' and type='" . $value['type'] . "' and period_id='" . $value['period_id'] . "' ;");
                                            // echo $this->db->last_query();
                                        $res=$query->row();
                                            
                                        if(empty($res)){
                                            echo 'Not Assigned, Please Assigned First.';
                                        }else{ ?>
                                            <a class="delete btn btn-success" href="<?php echo SITE_URL?>lunar/payments/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" >Payment Split
									        </a>
                                            <?php    
                                        }
    								
    								?>
    								<br>
    								<br>
    									<a class="btn btn-info" href="<?php echo SITE_URL?>lunar/lunar_schedule_update/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" title="Edit">Edit
    										<i class="icon-edit icon-white"></i>  
    										                                           
    									</a>
									
									<!--<a class="btn btn-info" href="<?php echo SITE_URL?>lunar/lunar_schedule_update/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" title="Edit">-->
         <!--                               <i class="icon-edit icon-white"></i>  -->
         <!--                           </a>-->
                                    <br>
                                    <br>
                                    <a class="btn btn-danger" 
                                       href="<?php echo SITE_URL?>lunar/lunar_schedule_delete/<?php echo $value['lunar_schedule_id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this schedule?');" 
                                       title="Delete">
                                        <i class="icon-trash icon-white"></i>Delete
                                    </a>

									<!--</td><td class="center">-->
									<!--<a class="delete btn btn-success" href="<?php echo SITE_URL?>lunar/payments/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" >-->
										<!--<i class="icon-trash icon-white"></i> -->
									<!--	Payment Split-->
									<!--</a>-->
									
									<!--title="Delete"  onclick="return confirm('Are you sure you want to delete?')"-->
									
									<br>
    								<br>
    									<a class="btn btn-info" href="<?php echo SITE_URL?>lunar/lunar_schedule_faq/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" title="FAQ">
    									  Upload FAQ
    									</a>
									
										<br>
    								<br>
    									<a class="btn btn-info" href="<?php echo SITE_URL?>lunar/lunarcompetition_assignupdate/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" title="Material">
    									  Price Edit 
    									</a>
									
								</td>
								
								
								
								
							</tr>
						<?php $i=$i+1;} ?>	
						  </tbody>
					  </table> 
					<?php }else{ ?> <h4 style='color:crimson'>'Error: No Schedule Found. Add schedule'</h4><?php }?>  
					

 

 
					</div>
				</div>
			</div>
	

<?php include('footer.php'); ?>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="charisma.js"></script>


<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>


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

