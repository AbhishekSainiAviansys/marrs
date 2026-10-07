<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>


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
						<div style='display:flex;'>	  
						    <div>
						        <label>Period</label>
						        <select name="period_id" id="period_id" required>
									<!--<option value="">Select</option>-->
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
						    </div>
						        
                            <div>
                                <label>Country</label>
                                <select  name="country" id="country" required>
									
								    <option value="105">India</option> 
								 </select>
                            </div>
                            
                            <div>
                                <label>State</label>
                                <select name="state_id" id="state_id" required>
									<option value="">Select</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['competition_centre_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
                            </div>
                            
							<div>
							    <label>Product</label>
							    <select name="product_name" id="product_name" required>
									<option value="">Select</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								</select> 
							</div> 
							  
							<div>
							    <label>C-Level</label>
							    <select name="competition_level_id" id="competition_level_id" required>
									<option value="">Select</option>
									<?php //foreach($level as $val) { ?>
									<!--<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['level_name'] ) ) if($result['level_name'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>-->
									<?php// } ?>    
								</select> 
							</div> 
							  
							<div>
							    <label>Competition Price</label>
							    <input type='text' name='product_price' placeholder='Rs.' style='width:80px;' required>
							</div> 
							
							   
                        </div>   
                           <div>
							    <label>Competition Date</label>
							    <input type='date' name='close_date'  required>
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
 
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>