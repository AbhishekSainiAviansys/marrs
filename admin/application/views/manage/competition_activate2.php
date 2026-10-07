<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
// print_r($sub);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>-->
					</li>
					<li>
						<!--<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>-->
					</li>
				</ul>
			</div>
			

			<div class="row-fluid sortable">
			 
				<div class="box span12">
				    <?php //echo $this->notifications->display_html();
			if(!empty($message)){
			    ?>
			    <div class='row-fluid' style='background-color:#109b10;height:40px;display:grid;' >
			        <h4 style='color:#ffffff;'><?php echo $message; ?></h4>
			    </div>
			        
			    <?php
			}
			?>
			
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo ' Activate';?></h2>
						
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
							    <select name='com_per' id='com_per' style='width:130px;'>
							        <option value=''>- farnchise % -</option>
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
							<!--</div>-->
							<!--<div>-->
							    <label>Franchise GST</label>
							    <select name='com_per_gst' id='com_per_gst' style='width:180px'>
							        <option value='no'>No</option>
							        <option value='Yes'>Yes</option>
							    </select>
							</div>
							
							<div id='cash1'>
							    <label>Split To Aviansys</label>
							    <select name='avianchoice' id='choiceavian' >
							        <!--<option value=''>-- select split choice --</option>-->
							        <option value='yes'>Payment Split To Aviansys </option>
							        <!--<option value='no'>No Split</option>-->
							    </select>
							
							     
							    <select name='com_peravian' id='' style='width:130px;' required>
							        <option value=''>- aviansys % -</option>
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
							        <option value='75'>75%</option>
							        <option value='80'>80%</option>
							     </select>
							</div>
							
							<div>
							    <label>Management %</label>
							    
							     
							    <select name='manageper' id='' style='width:140px;' required>
							        <option value=''>- management % -</option>
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
							        <option value='75'>75%</option>
							        <option value='80'>80%</option>
							     </select>
							</div>
							
							<div>
							    <label>CRM Fix Amount</label>
							    <input type='text' name='crm_fix' placeholder='Rs.' style='width:80px;' >
							</div>
							
						<div style='display:flex;'>	  
						    <div>
						        <label>Period</label>
						        <select name="period_id" id="period_id" style='width:180px;' required>
									<!--<option value="">Select</option>-->
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
						    </div>
						        
                            <div>
                                <label>Country</label>
                                <select  name="country" id="country" style='width:180px;' required>
									
								    <option value="105">India</option> 
								 </select>
                            </div>
                            
                            <div>
                                <label>State</label>
                                <select name="state_id" id="state_id" style='width:180px;' required>
									<option value="">Select</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['competition_centre_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
                            </div>
                            
							<div>
							    <label>Product</label>
							    <select name="product_name" id="product_name" style='width:180px;' required>
									<option value="">Select</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								</select> 
							</div> 
							<div id='series'>
							    <label>Lunar Series</label>
							    <input type='text' name='series' placeholder='<?php if($sub->series !=''){echo $sub->series;}else{echo '1';} ?>' style='width:150px;' >
							    <label>Subject</label>
							    <input type='text' name='subject' placeholder='<?php if($sub->subject !=''){echo $sub->subject;}else{echo 'English';} ?>' style='width:150px;' >
							</div>
							<div>
							    <label>C-Level</label>
							    <select name="competition_level_id" id="competition_level_id" style='width:180px;' required>
									<option value="">Select</option>
									<?php //foreach($level as $val) { ?>
									<!--<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['level_name'] ) ) if($result['level_name'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>-->
									<?php// } ?>    
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
							<div>
							    <label>Competition Price</label>
							    <input type='text' name='product_price' placeholder='Rs.' style='width:80px;' required>
							</div> 
							
							   
                        </div>   
                            
                        
                           <div>
							    <label>Competition Date</label>
							    <!--<input type='date' name='close_date'  required>-->
							    
							    <input type="text" id="multiDatePicker" name="close_date" required>
							    
							</div>
                        
                            <div class="page-header">
							  <h1><small>Check Individual Item and Enter Money for individual</small></h1>
							</div>
                        
                        
                        <div style='display:flex;'>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_a'>
                                <label>Study Material-A Paid</label>
                                
                                <input type='text' name='study_material_a_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_b'>
                                <label>Study Material-B Paid</label>
                                
                                <input type='text' name='study_material_b_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_c'>
                                <label>Study Material-C Paid</label>
                                
                                <input type='text' name='study_material_c_price' style='width:40px;' placeholder='Rs.'>
                                
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_a'>
                                <label>Orientation A</label>
                                
                                <input type='text' name='orientation_a_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_b'>
                                <label>Orientation B</label>
                                
                                <input type='text' name='orientation_b_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_c'>
                                <label>Orientation C</label>
                                
                                <input type='text' name='orientation_c_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test'>
                                <label>Mock Test</label>
                                
                                <input type='text' name='mock_test_price' style='width:40px;' placeholder='Rs.'>
                            </div>
                            
                        </div>   
                           
                           <div class="page-header">
							  <h1><small>Check Items and enter money for combo</small></h1>
							</div> 
                           
                        
                            <div style='margin-left:20px;'>
                                <h5>Combo-1</h5>
                                <input type='checkbox' name='combo1_material_a'>Material-A
                                <input type='checkbox' name='combo1_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo1_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo1_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo1_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo1_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo1_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_1_price' placeholder='Combo-1 Price Rs.' style='margin-left:20px;'>
                            </div>    
                        
                            <hr>
                            
                            <div style='margin-left:20px;'>
                                <h5>Combo-2</h5>
                                <input type='checkbox' name='combo2_material_a'>Material-A
                                <input type='checkbox' name='combo2_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo2_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo2_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo2_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo2_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo2_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_2_price' placeholder='Combo-2 Price Rs.' style='margin-left:20px;'>
                            </div> 
                            
                            <hr>
                            
                            <div style='margin-left:20px;'>
                                <h5>Combo-3</h5>
                                <input type='checkbox' name='combo3_material_a'>Material-A
                                <input type='checkbox' name='combo3_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo3_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo3_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo3_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo3_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo3_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_3_price' placeholder='Combo-3 Price Rs.' style='margin-left:20px;'>
                            </div> 
                            
                            <hr>
                            
                            <div style='margin-left:20px;'>
                                <h5>Combo-4</h5>
                                <input type='checkbox' name='combo4_material_a'>Material-A
                                <input type='checkbox' name='combo4_material_b' style='margin-left:20px;'>Material-B
                                <input type='checkbox' name='combo4_material_c' style='margin-left:20px;'>Material-C
                                <input type='checkbox' name='combo4_orientation_a' style='margin-left:20px;'>Orientation-A
                                <input type='checkbox' name='combo4_orientation_b' style='margin-left:20px;'>Orientation-B
                                <input type='checkbox' name='combo4_orientation_c' style='margin-left:20px;'>Orientation-C
                                <input type='checkbox' name='combo4_mocktest' style='margin-left:20px;'>Mock Test
                                <input type='text' name='combo_4_price' placeholder='Combo-4 Price Rs.' style='margin-left:20px;'>
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
            url:BASE_URL+"manage/ajax/getStateFranchiseaccount/",
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
            url:BASE_URL+"manage/ajax/product_wiselevel/",
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
// 		alert(product_id);
		if (product_id == '8') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
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
        
        
        
        jQuery("#product_name").change(function(){
        
            var product_name = jQuery(this).val();
            
            if (product_name == 'Lunar Skill Test') {
                jQuery("#subject").show();
                jQuery("#series").show();
                jQuery("#type").show();
                // jQuery("#type").show();
            } else {
                jQuery("#subject").hide();
                jQuery("#series").hide();
                jQuery("#type").hide();
                // jQuery("#series").hide();
            }
        });
        
        
        
        jQuery("#period_id").change(function(){
        
            var period_id = jQuery(this).val();
            if (period_id >= 9) {
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
                    
                       
                    jQuery("#com_per").show();
                    jQuery("#com_per_gst").show();       
                }       
                if (cash_id == 'no') {
                    jQuery("#com_per").hide();
                    jQuery("#com_per_gst").hide();
                    
            }
                if (cash_id == '') {
                    jQuery("#com_per").hide();
                    jQuery("#com_per_gst").hide();
                }
            });
               
            jQuery("#choiceavian").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    jQuery("#com_peravian").show();
                        
                } 
                if (cash_id == 'no') {
                    jQuery("#aviansysper").hide();
                    jQuery("#com_peravian").hide();
                }
                if (cash_id == '') {
                    jQuery("#com_peravian").hide();
                    
                }
            });
            
            jQuery("#series").hide();
            jQuery("#peravian").hide();
            jQuery("#cashavian").hide();    
            jQuery("#cash").hide();    
            jQuery("#com_per").hide();
            jQuery("#com_per_gst").hide();
            jQuery("#com_peravian").hide();
            jQuery("#cash1").hide();
            jQuery("#aviansysperavian").hide();    
    });
    
    
</script>     
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#multiDatePicker", {
            mode: "multiple", // Enables multiple date selection
            dateFormat: "Y-m-d", // Format of the selected dates
            allowInput: true
        });
    </script>
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>