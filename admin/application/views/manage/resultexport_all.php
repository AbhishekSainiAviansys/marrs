
<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	//print_r($result);
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
				    <td>Period:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="period" id="period" style="width: 220px;"  required>
                            <!--<option style='display:none;'>Select period</option>-->
                            
                            <?php
                             
                             
                            foreach ($period_load as $row)
                            {
                            //echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                            ?>
                            <option value="<?php echo $row['period_id'] ?>" <?php if(isset($result['period']) && $result['period'] == $row['period_id']) { echo "selected"; } ?>><?php echo $row['period_name'] ?></option>
                            
                            <?php
                            }
                            
                            ?>
                        </select>
					</td>
					
					<td>Country:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="country" id="country" style="width: 220px;"  required>
                            <option value=''>-- select country --</option>
                            <option value="105">India</option> 
				            <?php foreach($country as $val) { //print_r($val);?>
							<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country'] ) ) if($result['country'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
							<?php } ?>
                        </select>
					</td>
					
    				<td>State:<span style='color:red;'>*</span><br>
    					<select name="state" id="state" style="width: 220px;" required>
    					    
                            <option value='All' <?php if(isset($result['state']) && $result['state'] == $row['state_subdivision_id']) { echo "selected"; } ?>>-- All State --</option>
                             
                            
                             
                            <?php
                             
                            // $query = $this->db->query("SELECT * FROM `states` where country_id='105';");
                            
                            foreach ($state_load as $row)
                            {
                          //  echo "<option value='{$row->state_subdivision_id}'>{$row->state_subdivision_name}</option>";
                            ?>
                                <option value="<?php echo $row['state_subdivision_id'] ?>" <?php if(isset($result['state']) && $result['state'] == $row['state_subdivision_id']) { echo "selected"; } ?>><?php echo $row['state_subdivision_name'] ?></option>
                                            
                            <?php
                            }
                            
                            ?>
                        </select>
    				</td>
				
				
			    	
			        <td id='area'>Area List:<br>
				        <select id='area_list' name='area_list' style='width:220px;'>
				            <?php if(!empty($result['area_list'])&& $result['area_list']=='All'){?>
				            <option value="All">-- All Area --</option>
				            <?php } ?>
				            <?php foreach($area_load as $periodval) : ?>
                                <option value="<?php echo $periodval['area_code'] ?>" <?php if(isset($result['area_list']) && $result['area_list'] == $periodval['area_code']) { echo "selected"; } ?>><?php echo $periodval['city_name'] ?></option>
                            <?php endforeach; ?>
				        </select>
				        
				    </td>
				    
				    <td id='school'>School List:<br>
				        <select id='school_list' name='school_list' style='width:220px;'>
				            <?php if(isset($result['school_list']) && $result['school_list']=='All'){
				                ?>
				                <option value='All'>All School</option>
				                <?php
				            }else{?>
				                <option value=''>-- select school --</option>
				        <?php  }
				            ?>
				            
				            <?php foreach($school_load as $periodval) : ?>
                                    <option value="<?php echo $periodval['id'] ?>" <?php if(isset($result['school_list']) && $result['school_list'] == $periodval['id']) { echo "selected"; } ?>><?php echo $periodval['school_name'] ?></option>
                                    <?php endforeach; ?>
				        </select>
				        
				    </td>
				    
				</tr>
				    
					
					
			<tr>
			    
			        
			    <td>Status:<span style='color:red;'>*</span><br>
					<select name='status' style='width:220px;'>
					    <option value='All' <?php if(isset($result['status']) && $result['status']=='All') { echo "selected"; } ?>>All</option>

					    <option value='Q' <?php if(isset($result['status']) && $result['status']=='Q') { echo "selected"; } ?>>Q</option>
					    <option value='NQ' <?php if(isset($result['status']) && $result['status']=='NQ') { echo "selected"; } ?>>NQ</option>
					</select>
				</td>
			    
			    <td>Product:<span style='color:red;'>*</span><br />
			        <!--<h3><b>School : </b></h3>-->
                    <select name="product" id="product" style="width: 220px;"  required>
                        <option >select Product</option>
                        
                         <?php
                        //  echo "<option value=''>Select Product</option>";
                        //  $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name ");
                        
                        //  foreach ($query->result() as $row)
                        // {
                        // echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                        // }
                        
                        ?>
                        
                        <?php foreach($product_load as $periodval) : ?>
                        <option value="<?php echo $periodval['product_name'] ?>" <?php if(isset($result['product']) && $result['product'] == $periodval['product_name']) { echo "selected"; } ?>><?php echo $periodval['product_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
				</td>
    
           <!--         <td>-->
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
    					  <!--  </td>                -->
					
					<td>Competition Level:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="level" id="level" style="width: 220px;"  >
                                   <option>select level</option>
                                   <option value='All'  <?php if(isset($result['level']) && $result['level'] == 'All') { echo "selected"; } ?>>All Level </option>
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
					
				    <td>Rank:<br>
    					<select name='rank' style='width:220px;'>
    					    <option value='All' <?php if(isset($result['rank']) && $result['rank']=='All') { echo "selected"; } ?>>All</option>
    
    					    <option value='1' <?php if(isset($result['rank']) && $result['rank']=='1') { echo "selected"; } ?>>Rank-1 To Rank-5</option>
    					    <option value='2' <?php if(isset($result['rank']) && $result['rank']=='2') { echo "selected"; } ?>>Rank-5 To Rank-10</option>
    					    <option value='3' <?php if(isset($result['rank']) && $result['rank']=='3') { echo "selected"; } ?>>Rank-10 To Rank-20</option>
    					    
    					</select>
    				</td>
				
				</tr>
				
				<tr>
    				 <td>Performer:<br>
        					<select name='performer' style='width:220px;'>
        					    <option value='All' <?php if(isset($result['performer']) && $result['performer']=='All') { echo "selected"; } ?>>All</option>
        
        					    <option value='yes' <?php if(isset($result['performer']) && $result['performer']=='yes') { echo "selected"; } ?>>Yes</option>
        					    <option value='no' <?php if(isset($result['performer']) && $result['performer']=='no') { echo "selected"; } ?>>No</option>
        					    
        					</select>
        			</td>
        				
        				
    				 <td>Speller:<br>
        					<select name='speller' style='width:220px;'>
        					    <option value='All' <?php if(isset($result['speller']) && $result['speller']=='All') { echo "selected"; } ?>>All</option>
        
        					    <option value='yes' <?php if(isset($result['speller']) && $result['speller']=='yes') { echo "selected"; } ?>>Yes</option>
        					    <option value='no' <?php if(isset($result['speller']) && $result['speller']=='no') { echo "selected"; } ?>>No</option>
        					    
        					</select>
        			</td>
    				
    			   <td> <br /><input type="submit" class='btn btn-info' name="submit" value="Submit" /> </td>
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
								    <input type="hidden" name="cat" value="<?php echo $cat; ?>" >
								    <input type="hidden" name="pro" value="<?php echo $pro; ?>" >
								    <input type="hidden" name="lev" value="<?php echo $lev; ?>" >
								    <input type="hidden" name="sta" value="<?php echo $sta; ?>" >
								    <input type="hidden" name="per" value="<?php echo $per; ?>" >
								    <input type="hidden" name="stat" value="<?php echo $stat; ?>" >
								    <input type="hidden" name="sch" value="<?php echo $sch; ?>" >
								    <input type="hidden" name="are" value="<?php echo $are; ?>" >
								    
								    <input type="hidden" name="ran" value="<?php echo $ran; ?>" >
								    <input type="hidden" name="per" value="<?php echo $per; ?>" >
								    <input type="hidden" name="spe" value="<?php echo $spe; ?>" >
								    
								    
								    <input type="submit" name="Export" value=" Export Excel" class='btn btn-primary' > </tr>
							 <!--<tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>-->
							<h3 style='color:green;'><?php echo 'Showing '.$state_name.' '.$are.' Result'; ?></h3>
							 <tr>
								<th>Sr No</th> <th>Product Name</th> <th>CIN</th>
								<th>Name</th><th>school</th>								<th>Class</th>
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
								    Show
								</th>
							 </tr>
							<?php    
							  $i=1;  
							  foreach($students as $details){ 
							  if($details['show'] != 'skip'){
							  ?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i;      ?> </td> 
								
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['cin'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['student_name'];  ?> </td>
									
									<td align="CENTER"> 
									
									    <?php  
									    
									        $school_name    =  $this->db->get_where('cin_list',array('cin'=>$details['cin']))->row()->school_name;
									        if(!empty($school_name)){
									            echo $school_name;
									        }else{
									            $school_name    =  $this->db->get_where('school_new',array('id'=>$details['sch_id']))->row()->school_name;
									            echo $school_name;  
									            
									        }
									    ?> 
									    
									</td>
									
									<td align="CENTER"> <?php  echo $details['class'];  ?> </td>
									<td align="CENTER"> <?php if(!empty($details['clevel'])) { echo $this->db->get_where('competition_level_byproduct',array('level_id'=>$details['clevel']))->row()->level_name; }else{ echo '';} 
									
									//echo $details['level_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['status'];  ?> </td>
									<td align="CENTER"> 
									    <?php 
									        if($details['grade'] == 'AB'){ ?>
									          <p style="colour:green;"><?php  echo $details['grade']; ?></p> 
									       
									        <?php }
									        else{ ?>
									            <p><?php echo $details['grade'];?></p>
									      <?php  }
									    ?> 
									</td>
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
									    <?php echo $details['show']; ?>
									</td>
									
							 </tr>
							<?php $i=$i+1; }  } ?>
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
$("#country").change(function(){
        var country_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getstateAjax/",
            data:{country_id:country_id},
            type: 'post',
            success:function(result){
                 $("#state").html(result);
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

