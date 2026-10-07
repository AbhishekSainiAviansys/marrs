<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 

			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo ($blogID>0)?'Edit':'Activate';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="" method="POST">
							<fieldset>
							<div class="page-header">
							  <h1><small>Competition Activate</small></h1>
							</div>
							<div id='cash'>
							    <label>Split To Franchise</label>
							    <select name='choice' id='choice' >
							        <option value=''>-- select split choice --</option>
							        <option value='yes'>Payment Split To franchise</option>
							        <option value='no'>No Split</option>
							    </select>
							</div>
							
							<div id='cash1'>
							    <label>Split To Aviansys</label>
							    <select name='avianchoice' id='choiceavian' >
							        <option value=''>-- select split choice --</option>
							        <option value='yes'>Payment Split To Aviansys</option>
							        <option value='no'>No Split</option>
							    </select>
							</div>
							
							
							
						    <div style='display:flex;'>	  
						    <div >
						        <label>Period</label>
						        <select name="period_id" id="period_id" style='width:180px;' required>
									<option value="">-- Select Period --</option>
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
						    </div>
						        
                            <div style='margin-left:5px;'>
                                <label>Country</label>
                                <select  name="country" id="country" style='width:180px;' required>
									
								    <option value="105" <?php if($result['country']=='105'){echo 'selected="selected"';} ?> >India</option> 
								 </select>
                            </div>
                            
                            <div style='margin-left:5px;'>
                                <label>State</label>
                                <select name="state_id" id="state_id" style='width:180px;' required>
									<option value="">-- Select State --</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['competition_centre_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
                            </div>
                            <div style='margin-left:5px;'>
                                <label>Franchise</label>
                                <select name="franchise_id" id="franchise_id" style='width:180px;' required>
									<option value="">-- Select franchise --</option>
									<?php foreach($franchise as $val) { ?>
									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'].' '.$val['franchise_name']; ?></option>
									<?php } ?>
								 </select>
                            </div>
							<div style='margin-left:5px;'>
							    <label>Product</label>
							    <select name="product_name" id="product_name"  style='width:180px;' required>
									<option value="">-- Select Product --</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								</select> 
							</div> 
							  
							  <div style='margin-left:5px;'>
							    <label>C-Level</label>
							    <select name="competition_level_id" id="competition_level_id" style='width:180px;' required>
									<option value="">-- Select Level --</option>
									<?php //foreach($level as $val) { ?>
									<!--<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['level_name'] ) ) if($result['level_name'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>-->
									<?php// } ?>    
								</select> 
							</div> 
							  
							 
							
							   
							  
                        </div>   
                        <div style='display:flex;'>
                            <div>
							    <label>Competition Price</label>
							    <input type='text' name='product_price' placeholder='Rs.' style='width:80px;' required>
							    <select name='com_per' id='com_per' style='width:130px;'>
							        <option value=''>- farnchise % -</option>
							        <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select>       
							    <select name='com_peravian' id='com_peravian' style='width:130px;'>
							        <option value=''>- aviansys % -</option>
							        <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							       
							     </select> 
							</div>
                           <div>
							     <label>Competition Date</label>
							    <input type='date' name='close_date' required>
							 </div> 
                        
                            
                        </div>
                        <div class="page-header">
							  <h1><small>Check Individual Item and Enter Money for individual</small></h1>
							</div>
                        <div style='display:flex;'>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_a' id='study_material_a'>
                                <label>Study Material-A Paid</label>
                                
                                <input type='text' name='study_material_a_price' id='study_material_a_price' style='width:40px;' placeholder='Rs.'>
                                <select name='mat_a_per' id='mat_a_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select>  
                                <select name='mat_a_peravian' id='mat_a_peravian' style='width:130px;'>
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>  
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_b' id='study_material_b'>
                                <label>Study Material-B Paid</label>
                                
                                <input type='text' name='study_material_b_price' id='study_material_b_price' style='width:40px;' placeholder='Rs.'>
                                <select name='mat_b_per' id='mat_b_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='mat_b_peravian' id='mat_b_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select> 
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_c' id='study_material_c'>
                                <label>Study Material-C Paid</label>
                                
                                <input type='text' name='study_material_c_price' id='study_material_c_price' style='width:40px;' placeholder='Rs.'>
                                <select name='mat_c_per' id='mat_c_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select>
                                <select name='mat_c_peravian' id='mat_c_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_a' id='orientation_a'>
                                <label>Orientation A</label>
                                
                                <input type='text' name='orientation_a_price' id='orientation_a_price' style='width:40px;' placeholder='Rs.'>
                                <select name='ori_a_per' id='ori_a_per' style='width:130px;' >
                                <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='ori_a_peravian' id='ori_a_peravian' style='width:130px;'  >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_b' id='orientation_b'>
                                <label>Orientation B</label>
                                
                                <input type='text' name='orientation_b_price' id='orientation_b_price' style='width:40px;' placeholder='Rs.'>
                                <select name='ori_b_per' id='ori_b_per' style='width:130px;'  >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='ori_b_peravian' id='ori_b_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>
                            
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_c' id='orientation_c'>
                                <label>Orientation C</label>
                                
                                <input type='text' name='orientation_c_price' id='orientation_c_price' style='width:40px;' placeholder='Rs.'>
                                <select name='ori_c_per' id='ori_c_per' style='width:130px;'  >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select>
                                <select name='ori_c_peravian' id='ori_c_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test' id='mock_test_a'>
                                <label>Mock Test</label>
                                
                                <input type='text' name='mock_test_price' id='mock_test_price' style='width:40px;' placeholder='Rs.'>
                                <select name='moc_a_per' id='moc_a_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='moc_a_peravian' id='moc_a_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>
                            
                        </div>   
                           
                           <div class="page-header">
							  <h1><small>Check Items and enter money for combo</small></h1>
							</div> 
                           
                        
                            <div style='margin-left:10px;'>
                                <h5>Combo-1</h5>
                                <input type='checkbox' name='combo1_material_a'>Material-A
                                <input type='checkbox' name='combo1_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo1_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo1_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo1_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo1_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo1_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_1_price' placeholder='Combo-1 Price Rs.' style='margin-left:20px;width:130px;'>
                                <select name='com_a_per' id='com_a_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='com_a_peravian' id='com_a_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div>    
                        
                            <hr>
                            
                            <div style='margin-left:10px;'>
                                <h5>Combo-2</h5>
                                <input type='checkbox' name='combo2_material_a'>Material-A
                                <input type='checkbox' name='combo2_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo2_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo2_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo2_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo2_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo2_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_2_price' placeholder='Combo-2 Price Rs.' style='margin-left:20px;width:130px;'>
                                <select name='com_b_per' id='com_b_per' style='width:130px;' placeholder='Franchise Percetage' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='com_b_peravian' id='com_b_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div> 
                            
                            <hr>
                            
                            <div style='margin-left:10px;'>
                                <h5>Combo-3</h5>
                                <input type='checkbox' name='combo3_material_a'>Material-A
                                <input type='checkbox' name='combo3_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo3_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo3_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo3_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo3_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo3_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_3_price' placeholder='Combo-3 Price Rs.' style='margin-left:20px;width:130px;'>
                                <select name='com_c_per' id='com_c_per' style='width:130px;' placeholder='Franchise Percetage' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='com_c_peravian' id='com_c_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div> 
                            
                            <hr>
                            
                            <div style='margin-left:10px;'>
                                <h5>Combo-4</h5>
                                <input type='checkbox' name='combo4_material_a'>Material-A
                                <input type='checkbox' name='combo4_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo4_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo4_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo4_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo4_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo4_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_4_price' placeholder='Combo-4 Price Rs.' style='margin-left:20px;width:130px;'>
                                <select name='com_d_per' id='com_d_per' style='width:130px;' >
                                    <option value=''>- franchise % -</option>
                                    <option value='40'>40%</option>
							        <option value='45'>45%</option>
							        <option value='50'>50%</option>
							        <option value='55'>55%</option>
							        <option value='60'>60%</option>
							    </select> 
                                <select name='com_d_peravian' id='com_d_peravian' style='width:130px;' >
                                    <option value=''>- aviansys % -</option>
                                    <option value='10'>10%</option>
							        <option value='15'>15%</option>
							        <option value='20'>20%</option>
							        <option value='25'>25%</option>
							        <option value='30'>30%</option>
							    </select>
                            </div> 
                            
                          
                           
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
								<button class="btn">Cancel</button>
							  </div>
						
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
<script type="text/javascript">
    $("#state_id").change(function(){
        var state_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getStateFranchise/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
                 $("#franchise_id").html(result);
        }});
    }); 
    
    
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
		$("#franchise_id").change(function(){
        var franchise_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
                 $("#area_id").html(result);
        }});
    }); 
    
    $("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/class_category/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#category_id_").html(result);
        }});
    }); 
    
    
    
    
 </script>
 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("#period_id").change(function(){
                var period_id = jQuery(this).val();
                if (period_id >= 13) {
                    jQuery("#cash").show();
                    jQuery("#cash1").show();
                } else {
                    jQuery("#cash").hide();
                    jQuery("#cash1").hide();
                }
            });
            
            jQuery("#choice").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    
                        jQuery("#study_material_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_a_per").show();
                            } else {
                                jQuery("#mat_a_per").hide();
                            }
                        });
                        jQuery("#study_material_b").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_b_per").show();
                            } else {  
                                jQuery("#mat_b_per").hide();
                            }
                        });
                        jQuery("#study_material_c").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_c_per").show();
                            } else {  
                                jQuery("#mat_c_per").hide();
                            }
                        });
                        jQuery("#orientation_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_a_per").show();
                            } else {  
                                jQuery("#ori_a_per").hide();
                            }
                        });
                        jQuery("#orientation_b").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_b_per").show();
                            } else {  
                                jQuery("#ori_b_per").hide();
                            }
                        });
                        jQuery("#orientation_c").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_c_per").show();
                            } else {  
                                jQuery("#ori_c_per").hide();
                            }
                        });
                        jQuery("#mock_test_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#moc_a_per").show();
                            } else {  
                                jQuery("#moc_a_per").hide();
                            }
                        });

                        jQuery("#com_per").show();
                        jQuery("#com_a_per").show();
                        jQuery("#com_b_per").show();
                        jQuery("#com_c_per").show();
                        jQuery("#com_d_per").show();
                } 
                if (cash_id == 'no') {
                    jQuery("#aviansysper").hide();
                    jQuery("#mat_a_per").hide();
                    jQuery("#mat_b_per").hide();
                    jQuery("#mat_c_per").hide();
                    jQuery("#ori_a_per").hide();
                    jQuery("#ori_b_per").hide();
                    jQuery("#ori_c_per").hide();
                    jQuery("#moc_a_per").hide();
                        jQuery("#com_a_per").hide();
                        jQuery("#com_b_per").hide();
                        jQuery("#com_c_per").hide();
                        jQuery("#com_d_per").hide();
                        jQuery("#com_per").hide();
                }
                if (cash_id == '') {
                    jQuery("#mat_a_per").hide();
                    jQuery("#mat_b_per").hide();
                    jQuery("#mat_c_per").hide();
                    jQuery("#ori_a_per").hide();
                    jQuery("#ori_b_per").hide();
                    jQuery("#ori_c_per").hide();
                    jQuery("#moc_a_per").hide();
                            jQuery("#com_a_per").hide();
                            jQuery("#com_b_per").hide();
                            jQuery("#com_c_per").hide();
                            jQuery("#com_d_per").hide();
                            jQuery("#com_per").hide();
                            jQuery("#aviansysper").hide();
                }
            });
            
            
            jQuery("#per").hide();
            jQuery("#cash").hide();
            jQuery("#cash1").hide();
            jQuery("#mat_a_per").hide();
            jQuery("#mat_b_per").hide();
            jQuery("#mat_c_per").hide();
            jQuery("#ori_a_per").hide();
            jQuery("#ori_b_per").hide();
            jQuery("#ori_c_per").hide();
            jQuery("#moc_a_per").hide();
                        jQuery("#com_a_per").hide();
                        jQuery("#com_b_per").hide();
                        jQuery("#com_c_per").hide();
                        jQuery("#com_d_per").hide();
                        jQuery("#com_per").hide();
                        jQuery("#aviansysper").hide();
                        
                        
            jQuery("#choiceavian").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    
                        jQuery("#study_material_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_a_peravian").show();
                            } else {
                                jQuery("#mat_a_peravian").hide();
                            }
                        });
                        jQuery("#study_material_b").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_b_peravian").show();
                            } else {  
                                jQuery("#mat_b_peravian").hide();
                            }
                        });
                        jQuery("#study_material_c").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#mat_c_peravian").show();
                            } else {  
                                jQuery("#mat_c_peravian").hide();
                            }
                        });
                        jQuery("#orientation_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_a_peravian").show();
                            } else {  
                                jQuery("#ori_a_peravian").hide();
                            }
                        });
                        jQuery("#orientation_b").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_b_peravian").show();
                            } else {  
                                jQuery("#ori_b_peravian").hide();
                            }
                        });
                        jQuery("#orientation_c").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#ori_c_peravian").show();
                            } else {  
                                jQuery("#ori_c_peravian").hide();
                            }
                        });
                        jQuery("#mock_test_a").click(function(){
                            if (jQuery(this).is(":checked")) {
                                jQuery("#moc_a_peravian").show();
                            } else {  
                                jQuery("#moc_a_peravian").hide();
                            }
                        });

                        jQuery("#com_peravian").show();
                        jQuery("#com_a_peravian").show();
                        jQuery("#com_b_peravian").show();
                        jQuery("#com_c_peravian").show();
                        jQuery("#com_d_peravian").show();
                } 
                if (cash_id == 'no') {
                    jQuery("#aviansysper").hide();
                    jQuery("#mat_a_peravian").hide();
                    jQuery("#mat_b_peravian").hide();
                    jQuery("#mat_c_peravian").hide();
                    jQuery("#ori_a_peravian").hide();
                    jQuery("#ori_b_peravian").hide();
                    jQuery("#ori_c_peravian").hide();
                    jQuery("#moc_a_peravian").hide();
                        jQuery("#com_a_peravian").hide();
                        jQuery("#com_b_peravian").hide();
                        jQuery("#com_c_peravian").hide();
                        jQuery("#com_d_peravian").hide();
                        jQuery("#com_peravian").hide();
                }
                if (cash_id == '') {
                    jQuery("#mat_a_peravian").hide();
                    jQuery("#mat_b_peravian").hide();
                    jQuery("#mat_c_peravian").hide();
                    jQuery("#ori_a_peravian").hide();
                    jQuery("#ori_b_peravian").hide();
                    jQuery("#ori_c_peravian").hide();
                    jQuery("#moc_a_peravian").hide();
                            jQuery("#com_a_peravian").hide();
                            jQuery("#com_b_peravian").hide();
                            jQuery("#com_c_peravian").hide();
                            jQuery("#com_d_peravian").hide();
                            jQuery("#com_peravian").hide();
                            jQuery("#aviansysperavian").hide();
                }
            });
            
            
            jQuery("#peravian").hide();
            jQuery("#cashavian").hide();
            jQuery("#cash1").hide();
            jQuery("#mat_a_peravian").hide();
            jQuery("#mat_b_peravian").hide();
            jQuery("#mat_c_peravian").hide();
            jQuery("#ori_a_peravian").hide();
            jQuery("#ori_b_peravian").hide();
            jQuery("#ori_c_peravian").hide();
            jQuery("#moc_a_peravian").hide();
                        jQuery("#com_a_peravian").hide();
                        jQuery("#com_b_peravian").hide();
                        jQuery("#com_c_peravian").hide();
                        jQuery("#com_d_peravian").hide();
                        jQuery("#com_peravian").hide();
                        jQuery("#aviansysperavian").hide();             
                        
        });
    </script>
    
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>