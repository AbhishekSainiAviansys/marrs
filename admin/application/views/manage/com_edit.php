<?php include('header.php');
//print_r($result);
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>
select {
    width: 300px;
    border: 1px solid #bbb;
    /* padding: 10px; */
}

select, input[type="file"] {
    height: 40px;
    *: ;
    margin-top: 4px; 
}
select.span4 {
    position: relative;
    top: -16px;
    left: 303px;
}
input.chk {
    margin-left: 20px;
    margin-top:10px;
}  
.form-horizontal .controls {
   
    margin-left: 150px;
  
}
input[type="text"] {
    width: 100%;
	    height: 30px;
}
.section-divider {
    border-top: 2px solid #ddd;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-right: 20px;
}
span.info {
    display: inline-block;
    position: relative;
    padding: 1px 30px 2px 30px;
    top: -11px;
    font-size: 18px;
    color: #4B4B4B;
    background-color: #fff;
}
    
  .multipleSelection {
      width: 240px;
      background-color: #eaeaea;
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      font-weight: bold;
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    #checkBoxes {
      display: none;
      border: 1px #8DF5E4 solid;
    }

    #checkBoxes label {
      display: block;
    }

    #checkBoxes label:hover {
      background-color: #4F615E;
    }
</style>
    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>franchise/">Area</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>franchise/Addarea">Addarea</a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="row-fluid sortable">
    
	<div class="box span12">
    
		<div class="box-header well" data-original-title>
			 <!--<h2><i class="icon-edit"></i> Area Code <?php echo ($studentID>0)?'Edit':'Add';?></h2>-->
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
		</div>
	    <div class="box-content">
	       <form method='POST'>
					<div class="section-divider"> <span class="info">Edit Competition Details</span></div>
				<h3 style='color:green;'><?php if(!empty($message)){echo $message.' Click on back to see list.';}?></h3>	
							 <!-----------------Country-------------------> 
							 <div class="col-lg-12" style="
    margin: 10px;">
							     
							      <div class="control-group"  style='padding-left:40px;width:120px;'>
    							        <label class="control-label" for="focusedInput">Period</label>
    							        <div class="controls">
            								 <select class="span2" name="period_id" id="period_id" required style='width:200px;'>
            									<option value="">Select</option>
            									<?php foreach($period as $periodval) { ?>
            									<option value="<?php echo $periodval['period_id'] ?>" <?php if(isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['academic_year'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>
    								    </div>
    								</div>
    							  
    							  
    							    <div class="control-group" style='padding-left:40px;'>
    								<label class="control-label" for="focusedInput">Country</label>
    							        <div class="controls">
    								        <select class="span2" name="country" id="country" style='width:200px;' required>
    									        <option value="">-- Select Country -- </option> 
    								            <!--<option value="105">India</option> -->
    								            <?php foreach($country as $val) {//print_r($val);?>
            									<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country'] ) ) if($result['country'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
            									<?php } ?>
    								        </select>
    								 
    								    </div>
						</div>    							 
							 
				    
					
				<div class="control-group" style='padding-left:40px;'>
    							
    								<label class="control-label" for="focusedInput">State</label>
    							        <div class="controls">
    								        <select class="span2" name="state_id" id="state_id" required style='width:200px;'>
            									<option value="">Select</option>
            									<?php foreach($state as $val) {//print_r($val);?>
            									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['state_subdivision_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
            									<?php } ?>
    								        </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
    								
    								    </div>
    							  </div> 
							    
							 
				             <div class="control-group" style='padding-left:40px;'>
    								<label class="control-label" for="focusedInput">Product</label>
        								<div class="controls">
            								 <select class="span2" name="product_name" id="product_name"  required style='width:200px;'>
            									<option value="">Select</option>
            									<?php foreach($product as $val) { ?>
            									<option value="<?php echo $val['product_name'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_name']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
            									<?php } ?>    
            								 </select> 
        								 	
        								</div>
    							    </div>
    							  
    							 
    							  
    							   <div class="control-group" style='padding-left:40px;'>
    								    <label class="control-label" for="focusedInput">Level</label>
    								    <div class="controls">
            								 <select class="span2" name="clevel" id="competition_level_id" required style='width:200px;'>
            									<option value="">Select</option>
            									<?php foreach($level as $val) { ?>
            									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['clevel'] ) ) if($result['clevel'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
    								
    								    </div>
    							    </div>
                         
						         <!--   <div class="control-group" style='padding-left:40px;width:30%;'>-->
    								   <!-- <label class="control-label" for="focusedInput">Registration Close Date</label>-->
    								   <!-- <div class="controls">-->
            			<!--					 <input type='date' name='close_date' value='<?php if( isset( $result['close_date'] ) ){ echo $result['close_date'];} ?>' style='width:200px;' required>-->
    								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
    								
    								   <!-- </div>-->
    							    <!--</div>-->
    							    
    							    <!--<div class="control-group" style='padding-left:40px;'>-->
    								   <!-- <label class="control-label" for="focusedInput">CRM Amount</label>-->
    								   <!-- <div class="controls">-->
            			<!--					 <input type='crm_fix' name='crm_fix' value='<?php if( !empty( $result['crm_fix'] ) ){ echo $result['crm_fix'];} ?>' placeholder='Rs.' >-->
    								 		 <!--<span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
    								
    								   <!-- </div>-->
    							    <!--</div>-->
    							    
    							    <!--<div class="control-group" style='padding-left:40px;'>-->
    								   <!-- <label class="control-label" for="focusedInput">CRM %</label>-->
    								   <!-- <div class="controls">-->
            			<!--					 <select class="span2" name="crm_per" id="crm_per" >-->
            			<!--						<option value="">-- Select CRM % --</option>-->
            									<?php
                                                    // $percentages = [1,2,3,4,5,6,7,8,9,10];
                                                    // foreach ($percentages as $percent) {
                                                    //     $selected = (isset($result) && $result['crm_per'] == $percent) ? 'selected' : '';
                                                    //     echo "<option value='$percent' $selected>$percent%</option>";
                                                    // }
                                                ?>
            			<!--					 </select>-->
    								 		<!-- <span class="help-inline"><?php  $this->validation->show_error('crm_per',"Please enter the CRM %.") ?></span>-->
    								
    								   <!-- </div>-->
    							    <!--</div>-->
    							    
    							    <!-- Study Material + Training Bundles -->
                                    <div class="card border-0 shadow-sm mb-4">
                            
                                        <div class="card-header bg-white border-bottom py-3">
                            
                                            <h5 class="mb-1 fw-semibold">
                                                <i class="bi bi-box-seam me-2 text-primary"></i>
                                                Study Material & Training Bundles
                                            </h5>
                            
                                            <small class="text-muted">
                                                Select the study material and training bundles to activate.
                                            </small>
                            
                                        </div>
                            
                            
                                        <div class="card-body p-4">
                            
                                            <div class="row g-3">
                            
                                                <!-- A -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_a"
                                                               id="bundle_a"
                                                               class="form-check-input"
                                                              
                                                              value="1"
                                                            <?php
                                                            if (!empty($result['bundle_a'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>
                                                        >
                            
                                                        <label for="bundle_a"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material A + Training A
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                            
                                                <!-- B -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_b"
                                                               id="bundle_b"
                                                               class="form-check-input" value="1"
                                                            <?php
                                                            if (!empty($result['bundle_b'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label for="bundle_b"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material B + Training B
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                            
                                                <!-- C -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_c"
                                                               id="bundle_c"
                                                               class="form-check-input"
                                                               
                                                               <?php
                                                            if (!empty($result['bundle_c'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label for="bundle_c"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material C + Training C
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                            
                                                <!-- D -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_d"
                                                               id="bundle_d"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['bundle_d'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label for="bundle_d"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material D + Training D
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                            
                                                <!-- E -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_e"
                                                               id="bundle_e"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['bundle_e'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label for="bundle_e"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material E + Training E
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                            
                                                <!-- F -->
                                                <div class="col-md-6 col-lg-4">
                            
                                                    <div class="form-check border rounded-3 p-3 h-100">
                            
                                                        <input type="checkbox"
                                                               name="bundle_f"
                                                               id="bundle_f"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['bundle_f'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label for="bundle_f"
                                                               class="form-check-label fw-medium">
                            
                                                            Study Material F + Training F
                            
                                                        </label>
                            
                                                    </div>
                            
                                                </div>
                            
                                            </div>
                            
                                        </div>
                                    </div>
                            
                            
                                    <!-- Paid Study Material -->
                                    <div class="card border-0 shadow-sm mb-4">
                            
                                        <div class="card-header bg-white border-bottom py-3">
                            
                                            <h5 class="mb-1 fw-semibold">
                                                <i class="bi bi-book me-2 text-primary"></i>
                                                Paid Study Material
                                            </h5>
                            
                                            <small class="text-muted">
                                                Select paid study materials that should be activated.
                                            </small>
                            
                                        </div>
                            
                            
                                        <div class="card-body p-4">
                            
                                            <div class="row g-3">
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_a"
                                                               id="study_material_a"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['study_material_a'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_a">
                                                            Study Material-A Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_b"
                                                               id="study_material_b"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['study_material_b'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_b">
                                                            Study Material-B Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_c"
                                                               id="study_material_c"
                                                               class="form-check-input"
                                                              <?php
                                                            if (!empty($result['study_material_c'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_c">
                                                            Study Material-C Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_d"
                                                               id="study_material_d"
                                                               class="form-check-input"
                                                               <?php
                                                            if (!empty($result['study_material_d'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_d">
                                                            Study Material-D Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_e"
                                                               id="study_material_e"
                                                               class="form-check-input">
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_e"
                                                               <?php
                                                            if (!empty($result['study_material_e'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                                                            Study Material-E Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                            
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-check border rounded-3 p-3">
                                                        <input type="checkbox"
                                                               name="study_material_f"
                                                               id="study_material_f"
                                                               class="form-check-input"
                                                               <?php
                                                            if (!empty($result['study_material_f'])) {
                                                                echo 'checked';
                                                            }
                                                            ?>>
                            
                                                        <label class="form-check-label fw-medium"
                                                               for="study_material_f">
                                                            Study Material-F Paid
                                                        </label>
                                                    </div>
                                                </div>
                            
                                            </div>
                            
                                        </div>
                                    </div>
                            
                            
                                    <!-- Training -->
                                    <div class="card border-0 shadow-sm mb-4">
                            
                                        <div class="card-header bg-white border-bottom py-3">
                            
                                            <h5 class="mb-1 fw-semibold">
                                                <i class="bi bi-person-workspace me-2 text-primary"></i>
                                                Training
                                            </h5>
                            
                                            <small class="text-muted">
                                                Select the training modules to activate.
                                            </small>
                            
                                        </div>
                            
                            
                                        <div class="card-body p-4">

                                            <div class="row g-3">
                                        
                                                <?php
                                                $training = [
                                                    'a' => 'Training A',
                                                    'b' => 'Training B',
                                                    'c' => 'Training C',
                                                    'd' => 'Training D',
                                                    'e' => 'Training E',
                                                    'f' => 'Training F'
                                                ];
                                        
                                                foreach($training as $key => $label) {
                                                ?>
                                        
                                                    <div class="col-md-6 col-lg-4">
                                        
                                                        <div class="form-check border rounded-3 p-3">
                                        
                                                            <input type="checkbox"
                                                                   name="orientation_<?php echo $key; ?>"
                                                                   id="orientation_<?php echo $key; ?>"
                                                                   class="form-check-input"
                                                                   value="1"
                                                                   <?php
                                                                   if (!empty($result['orientation_'.$key])) {
                                                                       echo 'checked';
                                                                   }
                                                                   ?>>
                                        
                                                            <label class="form-check-label fw-medium"
                                                                   for="orientation_<?php echo $key; ?>">
                                        
                                                                <?php echo $label; ?>
                                        
                                                            </label>
                                        
                                                        </div>
                                        
                                                    </div>
                                        
                                                <?php } ?>
                                        
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                            
                            
                                    <!-- Mock Tests -->
                                    <div class="card border-0 shadow-sm mb-4">
                            
                                        <div class="card-header bg-white border-bottom py-3">
                            
                                            <h5 class="mb-1 fw-semibold">
                                                <i class="bi bi-clipboard-check me-2 text-primary"></i>
                                                Mock Tests
                                            </h5>
                            
                                            <small class="text-muted">
                                                Select the mock tests to activate.
                                            </small>
                            
                                        </div>
                            
                            
                                        <div class="card-body p-4">
                            
                                            <div class="row g-3">
                            
                                                <?php
                                                $mock_tests = [
                                                    'a' => 'Mock Test - A',
                                                    'b' => 'Mock Test - B',
                                                    'c' => 'Mock Test - C',
                                                    'd' => 'Mock Test - D',
                                                    'e' => 'Mock Test - E',
                                                    'f' => 'Mock Test - F'
                                                ];
                            
                                                foreach($mock_tests as $key => $label) {
                                                ?>
                            
                                                    <div class="col-md-6 col-lg-4">
                            
                                                        <div class="form-check border rounded-3 p-3">
                            
                                                            <input type="checkbox"
                                                                   name="mock_test_<?php echo $key; ?>"
                                                                   id="mock_test_<?php echo $key; ?>"
                                                                   class="form-check-input" value="1"
                                                               <?php
                                                               if (!empty($result['mock_test_'.$key])) {
                                                                   echo 'checked';
                                                               }
                                                               ?>>
                            
                                                            <label class="form-check-label fw-medium"
                                                                   for="mock_test_<?php echo $key; ?>">
                            
                                                                <?php echo $label; ?>
                            
                                                            </label>
                            
                                                        </div>
                            
                                                    </div>
                            
                                                <?php } ?>
                            
                                            </div>
                            
                                        </div>
                                    </div>
                            
                            
                                    
                            
    							    
    							    
    							    
						    </div> 
				   
                    <!-----------------Submit /Cancel button ------------------->       
                    <div class="span12" style="margin-left: 120px;padding: 24px;margin-top: 0px;"> 
				   
								<input type="submit" class="btn btn-primary" id="submit" value="Update" name="submit" >
								<!--<button class="btn" name='back'>Back</button>-->
				  
				  
				  </div>  
          </form>
			 
			 
			 
	     </div><!-- END OF  class- box-content -->  
	 </div><!--END of class- box span12 DIV--> 
  </div><!--END OF class- row-fluid sortable" DIV-->

 <script type="text/javascript">
    $("#country").change(function(){
        var country_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getstateAjax/",
            data:{country_id:country_id},
            type: 'post',
            success:function(result){
                 $("#state_id").html(result);
        }});
    }); 
 
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
            url:BASE_URL+"manage/ajax/productwiselevel_/",
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<?php include('footer.php'); ?>