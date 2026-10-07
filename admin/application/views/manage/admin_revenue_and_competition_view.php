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
                                    
                                    <div style='margin-left:5px;'>
        							    <label>Area </label>
        							    <select name="area_id" id="area_id" style='width:180px;' >
        									<option value="">-- Select Area --</option>
        									  
        								</select> 
        							</div> 
        							
                                    <label>School List</label>
                                    <div id='schools'>
                                        
                                    </div>
                                    <div class="span3">
                                        <div class="control-group">
                                            <label class="control-label">School Fix <span class="required" style='color:red;'>*</span></label>
                                            <div class="controls">
                                                <input type='text' name='school_amount' value="<?php if(isset($result['school_amount'])){ echo $result['school_amount']; } ?>" required>
                                            </div>
                                        </div>
                                    </div>
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
        							    <label>Split To Franchise<span style='color:red;'>*</span></label>
        							    <select name='choice' id='choice' style='width:180px;' required>
        							        <option value=''>-- select split choice --</option>
        							        <option value='yes'>Payment Split To franchise</option>
        							        <option value='no'>No Split</option>
        							    </select>
        							</div>
        							&nbsp  &nbsp 
        							<!--<div>-->
        							<!--    <label>Franchise GST</label>-->
        							<!--    <select name='gst_fran' id='choiceavian' style='width:180px;'>-->
        							<!--        <option value=''>-- select gst franchise --</option>-->
        							<!--        <option value='yes'>Yes</option>-->
        							<!--        <option value='no'>No</option>-->
        							<!--    </select>-->
        							<!--</div>-->
        							
        							&nbsp  &nbsp 
        							<div>
        							    <label>Split To Associate<span style='color:red;'>*</span></label>
        							    <select name='associate_split' id='choice' style='width:180px;' required>
        							        <option value=''>-- select split choice --</option>
        							        <option value='yes'>Payment Split To Associate</option>
        							        <option value='no'>No Split</option>
        							    </select>
        							</div>
        							
        							

        							
        							
                                
                                </div>
                                <div>
                                    &nbsp;&nbsp;
                                    <div>
                                        <label>Class</label><br>
                                    
                                        <?php 
                                        $this->db->select('class_name');
                                        $this->db->from('class');
                                        $query = $this->db->get();
                                        foreach($query->result() as $val) { ?>
                                            
                                            <label style="margin-right:10px;">
                                                <input type="checkbox" name="classes[]" value="<?php echo $val->class_name; ?>"> 
                                                <?php echo $val->class_name; ?>
                                            </label>
                                    
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr>
                                
                            
                        <div class="page-header">
                            <h1><small>Revenue & Competition Settings</small></h1>
                            <p class="muted">Note: Items with price 0 or empty will be considered inactive</p>
                        </div>
                        
                       
                        
                        <hr>
                        
                        <!-- Revenue Settings -->
                        <h3>Revenue Settings</h3>
                        
                        <div class="row-fluid">
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Management % <span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <select name="manageper" required>
                                            <option value="">-- Select % --</option>
                                            <?php
                                            $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22];
                                            foreach ($percentages as $percent) {
                                                $selected = (isset($result) && $result['manageper'] == $percent) ? 'selected' : '';
                                                echo "<option value='$percent' $selected>$percent%</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Aviansys % <span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <select name="com_peravian" required>
                                            <option value="">-- Select % --</option>
                                            <?php
                                            $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22, 25, 30];
                                            foreach ($percentages as $percent) {
                                                $selected = (isset($result) && $result['com_peravian'] == $percent) ? 'selected' : '';
                                                echo "<option value='$percent' $selected>$percent%</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Associate %</label>
                                    <div class="controls">
                                        <select name="associate_per">
                                            <option value="">-- Select % --</option>
                                            <?php
                                            $percentages = range(5, 60, 5); // 5, 10, ..., 60
                                            foreach ($percentages as $percent) {
                                                $selected = (isset($result) && $result['associate_per'] == $percent) ? 'selected' : '';
                                                echo "<option value='$percent' $selected>$percent%</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Franchise %</label>
                                    <div class="controls">
                                        <select name="com_per">
                                            <option value="">-- Select % --</option>
                                            <?php
                                            foreach ($percentages as $percent) {
                                                $selected = (isset($result) && $result['com_per'] == $percent) ? 'selected' : '';
                                                echo "<option value='$percent' $selected>$percent%</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row-fluid">
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">CRM Fix <span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <input type='text' name='crm_fix' value="<?php if(isset($result['crm_fix'])){ echo $result['crm_fix']; } ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Registration Price <span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <input type='text' name='product_price' id="product_price" value="<?php if(isset($result['product_price'])){ echo $result['product_price']; } ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Free Material Royalty <span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <input type='text' name='study_material_free_royalty' value="<?php if(isset($result['study_material_free_royalty'])){ echo $result['study_material_free_royalty']; } ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Registration Start Date<span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <input type='date' name='registration_start_date' value="<?php if(isset($result['registration_start_date'])){ echo $result['registration_start_date']; } ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Registration End Date<span class="required" style='color:red;'>*</span></label>
                                    <div class="controls">
                                        <input type='date' name='registration_end_date' value="<?php if(isset($result['registration_end_date'])){ echo $result['registration_end_date']; } ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        <hr>
                        
                        <!-- Material Prices -->
                        <h3>Material Prices & Royalties</h3>
                        <p class="muted">Enter 0 or leave empty to make items inactive</p>

                        <div class="row-fluid">
                            <?php foreach(['a', 'b', 'c', 'd', 'e', 'f'] as $material): ?>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Material-<?php echo strtoupper($material); ?></label>
                                    <div class="controls">
                                        <input type='text' 
                                               name='study_material_<?php echo $material; ?>_price' 
                                               value="<?php echo isset($result['study_material_'.$material.'_price']) ? $result['study_material_'.$material.'_price'] : ''; ?>"
                                               placeholder="Price"
                                               class="input-block-level">
                                        <input type='text' 
                                               name='study_material_<?php echo $material; ?>_price_royalty' 
                                               value="<?php echo isset($result['study_material_'.$material.'_price_royalty']) ? $result['study_material_'.$material.'_price_royalty'] : ''; ?>"
                                               placeholder="Royalty"
                                               class="input-block-level"
                                               style="margin-top: 5px;">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <hr>

                        <!-- Mock Test Prices -->
                        <h3>Mock Test Prices & Royalties</h3>

                        <div class="row-fluid">
                            <?php foreach(['a', 'b', 'c', 'd', 'e', 'f'] as $test): ?>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Mock Test-<?php echo strtoupper($test); ?></label>
                                    <div class="controls">
                                        <input type='text' 
                                               name='mock_test_<?php echo $test; ?>_price' 
                                               value="<?php echo isset($result['mock_test_'.$test.'_price']) ? $result['mock_test_'.$test.'_price'] : ''; ?>"
                                               placeholder="Price"
                                               class="input-block-level">
                                        <input type='text' 
                                               name='mock_test_<?php echo $test; ?>_price_royalty' 
                                               value="<?php echo isset($result['mock_test_'.$test.'_price_royalty']) ? $result['mock_test_'.$test.'_price_royalty'] : ''; ?>"
                                               placeholder="Royalty"
                                               class="input-block-level"
                                               style="margin-top: 5px;">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <hr>

                        <!-- Orientation Prices -->
                        <h3>Orientation Prices</h3>

                        <div class="row-fluid">
                            <?php foreach(['a', 'b', 'c', 'd', 'e', 'f'] as $orientation): ?>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Orientation-<?php echo strtoupper($orientation); ?></label>
                                    <div class="controls">
                                        <input type='text' 
                                               name='orientation_<?php echo $orientation; ?>_price' 
                                               value="<?php echo isset($result['orientation_'.$orientation.'_price']) ? $result['orientation_'.$orientation.'_price'] : ''; ?>"
                                               placeholder="Price"
                                               class="input-block-level">
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
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
	
	$("#state_id").change(function(){
        var state_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/statewisearea_newww/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
                 $("#area_id").html(result);
        }});
    }); 
    
    $("#area_id").change(function(){
        var area_code=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/school_list_checkboxzoom/",
            data:{area_code:area_code},
            type: 'post',
            success:function(result){
                 $("#schools").html(result);
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