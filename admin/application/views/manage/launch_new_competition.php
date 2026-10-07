<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 

// print_R($result);
?>


			<div class="container-fluid mx-3 ">
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
					    
					<form method="POST">

    <!-- Page Header -->
    <div class="container-fluid px-0">

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <i class="bi bi-trophy fs-3"></i>
                    </div>

                    <div>
                        <h3 class="mb-1 fw-semibold">Competition Activate</h3>
                        <p class="text-muted mb-0">
                            Configure competition activation details
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Competition Information -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-sliders me-2 text-primary"></i>
                    Competition Information
                </h5>
            </div>

            <div class="card-body p-4">

                <div class="row g-4">

                    <!-- Period -->
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <label for="period_id" class="form-label fw-semibold">
                            Period <span class="text-danger">*</span>
                        </label>

                        <select name="period_id"
                                id="period_id"
                                class="form-select"
                                required>

                            <option value="">-- Select Period --</option>

                            <?php foreach($period as $periodval) { ?>

                                <option value="<?php echo $periodval['period_id'] ?>"
                                    <?php
                                    if(isset($result['period_id']))
                                        if($result['period_id'] == $periodval['period_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php echo $periodval['period_name'] ?>

                                </option>

                            <?php } ?>

                        </select>
                    </div>


                    <!-- Country -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="country" class="form-label fw-semibold">
                            Country <span class="text-danger">*</span>
                        </label>

                        <select name="country"
                                id="country"
                                class="form-select"
                                required>
                            <option value="">-- Select Country --</option>
                            <option value="105">India</option>
                            <?php foreach($country as $val) {//print_r($val);?>
            									<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country'] ) ) if($result['country'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
            									<?php } ?>

                        </select>

                    </div>


                    <!-- State -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="state_id" class="form-label fw-semibold">
                            State <span class="text-danger">*</span>
                        </label>

                        <select name="state_id"
                                id="state_id"
                                class="form-select"
                                required>

                            <option value="">-- Select State --</option>

                            <?php foreach($state as $val) { ?>

                                <option value="<?php echo $val['state_subdivision_id'] ?>"
                                    <?php
                                    if(isset($result['state_id']))
                                        if($result['state_id'] == $val['state_subdivision_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php echo $val['state_subdivision_name'] ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Franchise -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="franchise_id" class="form-label fw-semibold">
                            Franchise
                        </label>

                        <select name="franchise_id"
                                id="franchise_id"
                                class="form-select">

                            <option value="">-- Select franchise --</option>

                            <?php foreach($franchise as $val) { ?>

                                <option value="<?php echo $val['franchise_id'] ?>"
                                    <?php
                                    if(isset($result['franchise_id']))
                                        if($result['franchise_id'] == $val['franchise_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php
                                    echo $val['franchise_code'].' '.$val['franchise_name'];
                                    ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Associate -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="associate_id" class="form-label fw-semibold">
                            Associate
                        </label>

                        <select name="associate_id"
                                id="associate_id"
                                class="form-select">

                            <option value="">-- Select associate --</option>

                            <?php foreach($associate as $val) { ?>

                                <option value="<?php echo $val['associate_id'] ?>"
                                    <?php
                                    if(isset($result['associate_id']))
                                        if($result['associate_id'] == $val['associate_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php
                                    echo $val['first_name'].' '.$val['last_name'];
                                    ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Product -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="product_name" class="form-label fw-semibold">
                            Product <span class="text-danger">*</span>
                        </label>

                        <select name="product_name"
                                id="product_name"
                                class="form-select"
                                required>

                            <option value="">-- Select Product --</option>

                            <?php foreach($product as $val) { ?>

                                <option value="<?php echo $val['product_id'] ?>"
                                    <?php
                                    if(isset($result['product_name']))
                                        if($result['product_name'] == $val['product_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php echo $val['product_name'] ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>


                    <!-- Competition Level -->
                    <div class="col-md-6 col-lg-4 col-xl-3">

                        <label for="competition_level_id" class="form-label fw-semibold">
                            C-Level <span class="text-danger">*</span>
                        </label>

                        <select name="competition_level_id"
                                id="competition_level_id"
                                class="form-select"
                                required>

                            <option value="">-- Select Level --</option>

                            <?php foreach($level as $val) { ?>

                                <option value="<?php echo $val['level_id'] ?>"
                                    <?php
                                    if(isset($result['competition_level_id']))
                                        if($result['competition_level_id'] == $val['level_id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php echo $val['level_name'] ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                </div>

            </div>
        </div>


        <!-- Competition Settings -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom py-3">

                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                    Competition Settings
                </h5>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">


                    <!-- Competition Date -->
                    <div class="col-md-6 col-lg-4">

                        <label for="multiDatePicker"
                               class="form-label fw-semibold">

                            Competition Date
                            <span class="text-danger">*</span>

                        </label>

                        <input type="text"
                               id="multiDatePicker"
                               name="close_date"
                               class="form-control"
                               placeholder="Select competition date"
                               required>

                    </div>


                    <!-- Split Franchise -->
                    <div class="col-md-6 col-lg-4">

                        <label for="choice"
                               class="form-label fw-semibold">

                            Split To Franchise

                        </label>

                        <select name="choice"
                                id="choice"
                                class="form-select">

                            <option value="">
                                -- select split choice --
                            </option>

                            <option value="yes">
                                Payment Split To franchise
                            </option>

                            <option value="no">
                                No Split
                            </option>

                        </select>

                    </div>


                    <!-- Franchise GST -->
                    <div class="col-md-6 col-lg-4">

                        <label for="choiceavian"
                               class="form-label fw-semibold">

                            Franchise GST

                        </label>

                        <select name="gst_fran"
                                id="choiceavian"
                                class="form-select">

                            <option value="">
                                -- select gst franchise --
                            </option>

                            <option value="yes">Yes</option>

                            <option value="no">No</option>

                        </select>

                    </div>


                    <!-- Associate Split -->
                    <div class="col-md-6 col-lg-4">

                        <label for="associate_split"
                               class="form-label fw-semibold">

                            Split To Associate

                        </label>

                        <select name="associate_split"
                                id="associate_split"
                                class="form-select">

                            <option value="">
                                -- select split choice --
                            </option>

                            <option value="yes">
                                Payment Split To Associate
                            </option>

                            <option value="no">
                                No Split
                            </option>

                        </select>

                    </div>


                    <!-- Associate GST -->
                    <div class="col-md-6 col-lg-4">

                        <label for="associate_gst"
                               class="form-label fw-semibold">

                            Associate GST

                        </label>

                        <select name="associate_gst"
                                id="associate_gst"
                                class="form-select">

                            <option value="">
                                -- select gst associate --
                            </option>

                            <option value="yes">Yes</option>

                            <option value="no">No</option>

                        </select>

                    </div>


                    <!-- CRM Account -->
                    <div class="col-md-6 col-lg-4">

                        <label for="crm_account_id"
                               class="form-label fw-semibold">

                            CRM Account
                            <span class="text-danger">*</span>

                        </label>

                        <select name="crm_account_id"
                                id="crm_account_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Select CRM Account --
                            </option>

                            <?php foreach($crm_account as $val) { ?>

                                <option value="<?php echo $val['id'] ?>"
                                    <?php
                                    if(isset($result['crm_account_id']))
                                        if($result['crm_account_id'] == $val['id'])
                                        {
                                    ?>
                                    selected="selected"
                                    <?php } ?>>

                                    <?php echo $val['desc']; ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                </div>

            </div>
        </div>


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
                                   name="study_material_a"
                                   id="bundle_a"
                                   class="form-check-input">

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
                                   name="study_material_b"
                                   id="bundle_b"
                                   class="form-check-input">

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
                                   name="study_material_c"
                                   id="bundle_c"
                                   class="form-check-input">

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
                                   name="study_material_d"
                                   id="bundle_d"
                                   class="form-check-input">

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
                                   name="study_material_e"
                                   id="bundle_e"
                                   class="form-check-input">

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
                                   name="study_material_f"
                                   id="bundle_f"
                                   class="form-check-input">

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
                                   class="form-check-input">

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
                                   class="form-check-input">

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
                                   class="form-check-input">

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
                                   class="form-check-input">

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
                                   for="study_material_e">
                                Study Material-E Paid
                            </label>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-4">
                        <div class="form-check border rounded-3 p-3">
                            <input type="checkbox"
                                   name="study_material_f"
                                   id="study_material_f"
                                   class="form-check-input">

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
                                       class="form-check-input">

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
                                       class="form-check-input">

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


        <!-- Action Buttons -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">

                    <button type="button"
                            class="btn btn-light border px-4">

                        <i class="bi bi-x-circle me-1"></i>
                        Cancel

                    </button>


                    <button type="submit"
                            class="btn btn-primary px-4"
                            id="submit"
                            name="submit">

                        <i class="bi bi-check-circle me-1"></i>
                        Submit

                    </button>

                </div>

            </div>

        </div>

    </div>

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
    
 </script>

<style>

    .vl {
        border-left: 2px solid gray;
        height: 80px;
    }
    
</style>