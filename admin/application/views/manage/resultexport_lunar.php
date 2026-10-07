<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
// 	print_r($result);
	 echo $this->notifications->display_html();      
?> 
 <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>
 <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
<style>
    #on_3{
        display:none;
    }
    #o1_8{
        display:none;
    }
</style>	
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV Result file </h2>
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
				    <td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="period" id="period" style="width: 220px;"  required>
                            <!--<option style='display:none;'>Select period</option>-->
                            
                             <?php
                             
                             $query = $this->db->query("SELECT * FROM `period` where period_id >13;");
                            
                             foreach ($query->result_array() as $row)
                            {
                                echo "<option value='{$row['period_id']}'>{$row['academic_year']}</option>";

                            ?>
                            <!--<option value="<?php echo $row['period_id'] ?>" <?php if(isset($result['period']) && $result['period'] == $row['period_id']) { echo "selected"; } ?>><?php echo $row['academic_year'] ?></option>-->
                            
                            <?php
                            }
                            
                            ?>
                        </select>
					</td>
			    
    			    <td>Status:<br>
    					<select name='status' style='width:220px;'>
    					    <option value='All' <?php if(isset($result['status']) && $result['status']=='All') { echo "selected"; } ?>>All</option>
    
    					    <option value='Q' <?php if(isset($result['status']) && $result['status']=='Q') { echo "selected"; } ?>>Q</option>
    					    <option value='NQ' <?php if(isset($result['status']) && $result['status']=='NQ') { echo "selected"; } ?>>NQ</option>
    					</select>
    				</td>
    
                    <td>
				        <label>Subject</label>
					    <select name='subject' style='width:220px;' required>
					        <option value=''>select level</option>
				        <?php foreach($subject as $res){ ?>
				                <option value='<?php echo $res->Subject_key; ?>' <?php  if($res->Subject_key==$result['subject']) { echo 'selected="selected"'; } ?>><?php echo $res->Subject_key; ?></option>
				            <?php } ?>
				        </select>
				    </td>
				    
				    <td>
					    <label>Lunar Series</label>
					        <select name='series' style='width:220px;' required>
					            <option value=''>select level</option>
					            <?php foreach($series as $res){ ?>
					                <option value='<?php echo $res->series; ?>' <?php  if($res->series==$result['series']) { echo 'selected="selected"'; } ?>><?php echo $res->series; ?></option>
					            <?php } ?>
					        </select>
					    
				    </td>
				    
					<td>
					    <label>Type</label>
					        <select name='type' style='width:220px;' required>
					            <option value=''>select type</option>
					            <?php foreach($type as $res){ ?>
					                <option value='<?php echo $res->type; ?>' <?php  if($res->type==$result['type']) { echo 'selected="selected"'; } ?>><?php echo $res->type; ?></option>
					            <?php } ?>
					        </select>
					    
				    </td> 
				</tr> 
				<tr> 
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="level" id="level" style="width: 220px;"  required>
                           <option value=''>select level</option>
                           <?php foreach($level_load as $periodval) : ?>
                            <option value="<?php echo $periodval['level_id'] ?>" <?php if(isset($result['level']) && $result['level'] == $periodval['level_id']) { echo "selected"; } ?>><?php echo $periodval['level_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
					</td>
					
					<td>Class:<br/>
						<!--<h3><b>School : </b></h3>-->
                        <select name='class' id="" style="width: 220px;"  required>
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
		 <!--</form>-->
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">		
			 <!--<form action="" method="post" enctype="multipart/form-data" > -->
				 <?php  if(!empty($students)){ 
				 
				 ?>
				 
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<tr align="left" valign="TOP">
								    <!--<input type="hidden" name="cat" value="<?php echo $cat; ?>" >-->
								    <!--<input type="hidden" name="pro" value="<?php echo $pro; ?>" >-->
								    <!--<input type="hidden" name="lev" value="<?php echo $lev; ?>" >-->
								    <!--<input type="hidden" name="sta" value="<?php echo $sta; ?>" >-->
								    <!--<input type="hidden" name="per" value="<?php echo $per; ?>" >-->
								    <!--<input type="hidden" name="stat" value="<?php echo $stat; ?>" >-->
								    <!--<input type="hidden" name="sch" value="<?php echo $sch; ?>" >-->
								    <!--<input type="hidden" name="are" value="<?php echo $are; ?>" >-->
								    <input type="submit" name="Export" value="Export Excel" class='btn btn-primary' > </tr>
							 <!--<tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>-->
							<h3 style='color:green;'><?php echo 'Showing '.$state_name.' '.$are.' Result'; ?></h3>
							 <tr>
								<th>Sr No</th> <th>Product Name</th> <th>CIN</th>
								<th>Name</th><th>Subject</th><th>Series</th><th>school</th>								<th>Class</th>
								<th>LEVEL</th> 
								<th>Status</th> <th>Grade</th>
								<th>Rank</th>
								<th>Performer</th>
								<th>Speller</th>
								<th>
								    Competition Date
								</th>
								<th>
								    Venue
								</th>
								<th>
								    Marks
								</th>
								<th>
								    Subject
								</th>
								<th>
								    Series
								</th>
								<th>
								    Type
								</th>
							 </tr>
							<?php    
							  $i=1;  
							  foreach($students as $details){ 
							 // print_r($details);die;
							  ?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i;      ?> </td> 
								
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['cin'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['student_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['subject'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['series'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['school_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['class'];  ?> </td>
									<td align="CENTER"> <?php if(!empty($details['clevel'])) { echo $this->db->get_where('competition_level_byproduct',array('level_id'=>$details['clevel']))->row()->level_name; }else{ echo '';} 
									
									//echo $details['level_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['status'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['grade'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['rank'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['performer'];?> </td>
									<td align="CENTER"> <?php  echo $details['speller'];?> </td>
									<td>
									    <?php 
									    if(!empty($details['competition_schedule_id'])){
									        echo $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$details['competition_schedule_id']))->row()->competition_date;
									        
									    }else{
									        echo $details['competition_date'];
									    }
									    ?>
									</td>
									<td><?php 
									    if(!empty($details['competition_schedule_id'])){
									        echo $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$details['competition_schedule_id']))->row()->center_address;
									        
									    }else{
									        echo $details['venue'];
									    }
									    ?>
									    
									</td>
									<td>
									    <?php echo $details['marks']; ?>
									</td>
									<td>
									    <?php echo $details['subject']; ?>
									</td>
									<td>
									    <?php echo $details['series']; ?>
									</td>
									<td>
									    <?php echo $details['type']; ?>
									</td>
							 </tr>
							<?php $i=$i+1;  } ?>
				</TABLE>
				<?php }if(!empty($message)){ ?>
				
				<h3 style="text-align:center"><?php echo $message; ?></h3>
				
				
				<?php }?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->

<script>
//     $("#product").change(function(){
// var product_id =this.value;
//  //alert(product_id);
// $.ajax({
// url:"<?php echo base_url();?>manage/ajax/productwiselevel",
// data:{product_id:product_id},
// type: 'post',
// success:function(result)
// {
// 	//alert(result);
// 	 $("#level").html(result);
	 

// }});
// });
    
    
</script>

<?php include('footer.php'); ?>
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
 $("#school_list").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
$("#categ").change(function(){
		   
		//alert(this.value);
        var categ=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/get_product_list/",
            data:{categ:categ},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#product").html(result);
        }});
    });

$("#product").change(function(){
		   
		//alert(this.value);
        var product_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/productwiselevel_/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#level").html(result);
        }});
    });


$(document).ready(function(){
    
    $("#period").change(function(){
        // Check if the selected value is '12'
        if (this.value > '12') {
            
            $("#school").show();
            $("#area").show();
            //var state_id=this.value;
            var state_id = $('#state').val();

            $.ajax({
                url: "<?php echo base_url();?>"+"manage/ajax/getAreaAjax_/",
                data:{state_id:state_id},
                type: 'post',
                success:function(result){
    				// alert(result);
                     $("#area_list").html(result);
            }});
        
            
        
        } else {
            // Hide the 'school' div
            $("#school").hide();
            $("#area").hide();
        }
    });
});     

$("#area_list").change(function(){
    var area_code = $('#area_list').val();

            $.ajax({
                url: "<?php echo base_url();?>"+"manage/ajax/school_list/",
                data:{area_code:area_code},
                type: 'post',
                success:function(result){
    				// alert(result);
                     $("#school_list").html(result);
            }});
}); 

$("#state").change(function(){
		   
		//alert(this.value);
        var state_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/statewisearea_/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#area_list").html(result);
        }});
    });
 </script>