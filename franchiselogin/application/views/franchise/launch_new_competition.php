<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 

// print_R($result);
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
					
					<h3>
					    <?php 
					        if(isset($message) && !empty($message)){
    					        echo $message;
    					    }
					    ?>
					</h3>
					
					
					<div class="box-content">
					    
						<form class="" method="POST">
							<fieldset>
							    
							    <div class="page-header">
							  <h1><small>Competition Activate</small></h1>
							</div>
							
							
							
						        <div style='display:flex;'>	  
						    <div >
						        <label>Period <span style='color:red;'>*</span></label>
						        <select name="period_id" id="period_id" style='width:180px;' required>
									<option value="">-- Select Period --</option>
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
						    </div>
						        
                            <div style='margin-left:5px;'>
                                <label>Country<span style='color:red;'>*</span></label>
                                <select  name="country" id="country" style='width:180px;' required>
									
								    <option value="105" <?php if($result['country']=='105'){echo 'selected="selected"';} ?> >India</option> 
								 </select>
                            </div>
                            
                            <div style='margin-left:5px;'>
                                <label>State<span style='color:red;'>*</span></label>
                                <select name="state_id" id="state_id" style='width:180px;' required>
									<option value="">-- Select State --</option>
									<?php foreach($state as $val) { ?>
									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['state_subdivision_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
									<?php } ?>
								 </select>
                            </div>
                            
                            <div style='margin-left:5px;'>
                                <label>Franchise</label>
                                <select name="franchise_id" id="franchise_id" style='width:180px;' >
									<option value="">-- Select franchise --</option>
									<?php foreach($franchise as $val) { ?>
									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'].' '.$val['franchise_name']; ?></option>
									<?php } ?>
								 </select>
                            </div>
                            
                            <div style='margin-left:5px;'>
                                <label>Associate </label>
                                <select name="associate_id" id="associate_id" style='width:180px;' >
									<option value="">-- Select associate --</option>
									<?php foreach($associate as $val) { ?>
									<option value="<?php echo $val['associate_id'] ?>" <?php if( isset( $result['associate_id'] ) ) if($result['associate_id'] == $val['associate_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['first_name'].' '.$val['last_name']; ?></option>
									<?php } ?>
								 </select>
                            </div>
                            
                            
							<div style='margin-left:5px;'>
							    <label>Product <span style='color:red;'>*</span></label>
							    <select name="product_name" id="product_name"  style='width:180px;' required>
									<option value="">-- Select Product --</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								</select> 
							</div> 
							  
							  <div style='margin-left:5px;'>
							    <label>C-Level <span style='color:red;'>*</span></label>
							    <select name="competition_level_id" id="competition_level_id" style='width:180px;' required>
									<option value="">-- Select Level --</option>
									<?php foreach($level as $val) { ?>
									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
									<?php } ?>    
								</select> 
							</div> 
							  
							 
							
							
							   
							  
                        </div>
                        
                                <hr>
                                
                                <div style='display:flex;'>
                                    
               <!--                     <div>-->
        							<!--    <label>Competition Price</label>-->
        							<!--    <input type='text' name='product_price' placeholder='Rs.' style='width:140px;' required>-->
        							    
        							<!--</div>-->
        							
                                    <div>
                                          <label>Competition Date <span style='color:red;'>*</span></label>
                                          <input type="text" id="multiDatePicker" name="close_date"  required>

                                    </div>

                                    &nbsp  &nbsp 
        							    
                                    <div>
        							    <label>Split To Franchise</label>
        							    <select name='choice' id='choice' style='width:180px;' >
        							        <option value=''>-- select split choice --</option>
        							        <option value='yes'>Payment Split To franchise</option>
        							        <option value='no'>No Split</option>
        							    </select>
        							</div>
        							&nbsp  &nbsp 
        							<div>
        							    <label>Franchise GST</label>
        							    <select name='gst_fran' id='choiceavian' style='width:180px;'>
        							        <option value=''>-- select gst franchise --</option>
        							        <option value='yes'>Yes</option>
        							        <option value='no'>No</option>
        							    </select>
        							</div>
        							
        							&nbsp  &nbsp 
        							<div>
        							    <label>Split To Associate</label>
        							    <select name='associate_split' id='choice' style='width:180px;'>
        							        <option value=''>-- select split choice --</option>
        							        <option value='yes'>Payment Split To Associate</option>
        							        <option value='no'>No Split</option>
        							    </select>
        							</div>
        							
        							&nbsp  &nbsp 
        							<div>
        							    <label>Associate GST</label>
        							    <select name='associate_gst' id='choice' style='width:180px;'>
        							        <option value=''>-- select gst associate --</option>
        							        <option value='yes'>Yes</option>
        							        <option value='no'>No</option>
        							    </select>
        							</div>
        							
        							<div style='margin-left:5px;'>
                                        <label>CRM Account<span style='color:red;'>*</span></label>
                                        <select name="crm_account_id" id="crm_account_id" style='width:180px;' required>
        									<option value="">-- Select CRM Account --</option>
        									<?php foreach($crm_account as $val) { ?>
        									<option value="<?php echo $val['id'] ?>" <?php if( isset( $result['crm_account_id'] ) ) if($result['crm_account_id'] == $val['id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['desc']; ?></option>
        									<?php } ?>
        								 </select>
                                    </div>
                                
                                </div>
                                
                                <hr>
                                
                                <div style='display:flex;'>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_a' id='study_material_a'>
                                        <label>Study Material-A Paid</label>
                                        
                  
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_b' id='study_material_b'>
                                        <label>Study Material-B Paid</label>
                                        
                   
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_c' id='study_material_c'>
                                        <label>Study Material-C Paid</label>
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_d' id='study_material_d'>
                                        <label>Study Material-D Paid</label>
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_e' id='study_material_e'>
                                        <label>Study Material-E Paid</label>
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='study_material_f' id='study_material_f'>
                                        <label>Study Material-F Paid</label>
                                        
                                    </div>
                                    
                                    
                                 </div>
                                 
                                <hr>
                                
                                <div style='display:flex;'>   
                                    
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_a' id='orientation_a'>
                                        <label>Orientation A</label>
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_b' id='orientation_b'>
                                        <label>Orientation B</label>
                                        
                                    </div>
                                    
                                    
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_c' id='orientation_c'>
                                        <label>Orientation C</label>
                                        
                                        
                                    </div>
                                    
                                   
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_d' id='orientation_d'>
                                        <label>Orientation D</label>
                                        
                                        
                                    </div>
                                    
                                     <div class="vl" style='margin-left:20px;'></div>
                                     
                                     <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_e' id='orientation_e'>
                                        <label>Orientation E</label>
                                        
                                        
                                    </div>
                                     <div class="vl" style='margin-left:20px;'></div>
                                     
                                     <div style='margin-left:20px;'>
                                        <input type='checkbox' name='orientation_f' id='orientation_f'>
                                        <label>Orientation F</label>
                                        
                                        
                                    </div>
                                    
                                    
                                </div>
                                
                                <hr>
                                
                                <div style='display:flex;'>    
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_a' id='mock_test_a'>
                                        <label>Mock Test - A</label>
                                        
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_b' id='mock_test_b'>
                                        <label>Mock Test - B</label>
                                        
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_c' id='mock_test_c'>
                                        <label>Mock Test - C</label>
                                        
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_d' id='mock_test_d'>
                                        <label>Mock Test - D</label>
                                        
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_e' id='mock_test_e'>
                                        <label>Mock Test - E</label>
                                        
                                        
                                    </div>
                                    <div class="vl" style='margin-left:20px;'></div>
                                    <div style='margin-left:20px;'>
                                        <input type='checkbox' name='mock_test_f' id='mock_test_f'>
                                        <label>Mock Test - F</label>
                                        
                                        
                                    </div>
                                    
                                    
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


<!-- Include Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#multiDatePicker", {
      mode: "multiple",
      dateFormat: "Y-m-d", // For server submission
      altInput: true,
      altFormat: "F j, Y", // User-friendly display
      allowInput: true
    });
  });
</script>


    
    
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