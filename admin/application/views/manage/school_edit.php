<?php include('header.php'); ?>

<style>
.help-inline{color:#F00;}
</style>

    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>manage/school/">School</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>manage/school/<?php echo ($school_id>0)?'edit/'.$school_id:'add';?>/"><?php echo ($school_id>0)?'Edit':'Add';?></a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>

<?php
// Helper so every field survives a failed-validation reload or edit load,
// whether $result is an object (DB row) or array (re-posted values).
if (!function_exists('val')) {
    function val($result, $key, $default = '') {
        if (is_object($result) && isset($result->$key)) {
            return htmlspecialchars($result->$key, ENT_QUOTES);
        }
        if (is_array($result) && isset($result[$key])) {
            return htmlspecialchars($result[$key], ENT_QUOTES);
        }
        return $default;
    }
}
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <div class=" shadow box span12">
        <div class=" box-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
           <?php echo ($school_id>0)?'Edit':'Add';?> School
          </h5>
          <div>
            <button class="btn btn-sm btn-secondary"><i class="icon-cog"></i></button>
            <button class="btn btn-sm btn-warning"><i class="icon-chevron-up"></i></button>
            <button class="btn btn-sm btn-danger"><i class="icon-remove"></i></button>
          </div>
        </div>
<div class="card">
        <div class="card-body my-4">

          <form method="POST" enctype="multipart/form-data" id=""
                action="<?php echo SITE_URL?>school/update">

            <input type="hidden" name="school_id" value="<?php echo (int)$school_id;?>">

            <p class="text-danger small">
              The fields marked '<b>*</b>' are mandatory fields.
            </p>

            <!-- ================= SCHOOL ADDRESS ================= -->
            <h6 class="border-bottom pb-2 mb-3">School Address</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Country *</label>
                <select name="country_id" id="country_id" class="form-select" required>
                  <option value="">Select Country</option>
                  <?php foreach($country as $val){ ?>
                    <option value="<?php echo $val['country_id'];?>"
                      <?php echo (val($result,'country') == $val['country_id']) ? 'selected' : '';?>>
                      <?php echo $val['country_name'];?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label">State/Province *</label>
                <select name="stateID" id="state_id" class="form-select" required>
                  <?php if (!empty($stateatload)) { foreach($stateatload as $st){ ?>
                    <option value="<?php echo $st['state_subdivision_id'];?>"
                      <?php echo (val($result,'state') == $st['state_subdivision_id']) ? 'selected' : '';?>>
                      <?php echo html_escape($st['state_subdivision_name']);?>
                    </option>
                  <?php } } ?>
                </select>
              </div>
            </div>

            <!-- ================= FRANCHISE ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">Franchise Details</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Franchise *</label>
                <select name="franchise" id="franchise_id" class="form-select" required>
                  <option value="">Select Franchise</option>
                  <?php if (!empty($franchise)) { foreach($franchise as $fr){ ?>
                    <option value="<?php echo $fr['franchise_id'];?>"
                      <?php echo (val($result,'franchise_id') == $fr['franchise_id']) ? 'selected' : '';?>>
                      <?php echo $fr['username'];?>
                    </option>
                  <?php } } ?>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label">Area Code *</label>
                <select name="area_code" id="area_code" class="form-select" required>
                  <?php if (val($result,'area_code') !== '') { ?>
                    <option value="<?php echo val($result,'area_code');?>" selected><?php echo val($result,'area_code');?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <!-- ================= SCHOOL PROFILE ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">School Profile</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">School Name *</label>
                <input type="text" name="school_name" class="form-control" value="<?php echo val($result,'school_name');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">Affiliation Number</label>
                <input type="text" name="affiliation_number" class="form-control" value="<?php echo val($result,'affiliation_number');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">School Phone</label>
                <input type="text" name="school_phone" class="form-control" value="<?php echo val($result,'school_phone');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">School Mobile *</label>
                <input type="text" name="school_mobile" class="form-control" value="<?php echo val($result,'school_mobile');?>" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Address Line1 *</label>
                <input type="text" name="school_address" class="form-control" value="<?php echo val($result,'school_address');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">Address Line2</label>
                <input type="text" name="school_address1" class="form-control" value="<?php echo val($result,'school_address1');?>">
              </div>
            </div>

            <div class="row g-3 mt-2">
              <div class="col-md-6">
                <label class="form-label">School Email *</label>
                <input type="text" name="school_email" class="form-control" value="<?php echo val($result,'school_email');?>" required>
              </div>

              <div class="col-md-3">
                <label class="form-label">School Board *</label>
                <?php $board = val($result,'school_board'); ?>
                <select name="school_board" class="form-select" required>
                  <option <?php echo ($board=='CBSE')?'selected':'';?>>CBSE</option>
                  <option <?php echo ($board=='ICSE')?'selected':'';?>>ICSE</option>
                  <option <?php echo ($board=='IGCSE')?'selected':'';?>>IGCSE</option>
                  <option <?php echo ($board=='State Board')?'selected':'';?>>State Board</option>
                  <option <?php echo ($board=='Other')?'selected':'';?>>Other</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">School Medium *</label>
                <input type="text" name="school_medium" class="form-control" value="<?php echo val($result,'school_medium','English');?>">
              </div>
            </div>

            <!-- ================= PRINCIPAL ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">Principal Details</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Principal Name *</label>
                <input type="text" name="principal_first_name" class="form-control" value="<?php echo val($result,'school_principal_name');?>" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Principal Email</label>
                <input type="text" name="principal_email" class="form-control" value="<?php echo val($result,'principal_email');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">Principal Phone</label>
                <input type="text" name="principal_phone" class="form-control" value="<?php echo val($result,'principal_phone');?>">
              </div>
            </div>

            <!-- ================= COORDINATOR ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">Coordinator Details</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Coordinator Name *</label>
                <input type="text" name="school_coordinator_first_name" class="form-control" value="<?php echo val($result,'school_coordinator_name');?>" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Coordinator Email *</label>
                <input type="email" name="school_coordinator_email" class="form-control" value="<?php echo val($result,'school_coordinator_email');?>">
              </div>

              <div class="col-md-4">
                <label class="form-label">Coordinator Mobile *</label>
                <input type="number" name="school_coordinator_phone" class="form-control" value="<?php echo val($result,'coordinator_phone');?>">
              </div>
            </div>

            <!-- ================= BUTTONS ================= -->
            <div class="mt-4 d-flex gap-2">
                <div>
              <input type="submit" name="submit" class="btn btn-success" value="Submit">
              </div>
              <div>
              <button type="button" class="btn btn-danger" onclick="window.location.href='<?php echo SITE_URL?>franchise/schooListView'">Cancel</button>
              </div>
            </div>

          </form>

        </div>
        </div>
      </div>

    </div>
  </div>
</div>
  <!--END OF class- row-fluid sortable" DIV-->

<script>
// Previously saved values (from DB on edit, or re-posted values on failed validation).
// These are passed to each AJAX call so the server can re-select the right option
// after the dropdown's HTML gets replaced.
var savedStateID     = "<?php echo (int) val($result,'stateID');?>";
var savedFranchiseID = "<?php echo (int) val($result,'franchise_id');?>";
var savedAreaCode    = "<?php echo val($result,'area_code');?>";

$("#country_id").change(function(){
    var country_id = this.value;
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
        url: "<?php echo base_url();?>manage/ajax/getstateAjax",
        data: {country_id: country_id, selected_id: savedStateID},
        type: 'post',
        success: function(result){
            $("#state_id").html(result);
            // cascade: state options now exist, load franchise list for the selected state
            $("#state_id").trigger('change');
        }
    });
});

$("#state_id").change(function(){
    var state_id = this.value;
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
        url: "<?php echo base_url();?>manage/ajax/franchiseList",
        data: {state_id: state_id, selected_id: savedFranchiseID},
        type: 'post',
        success: function(result){
            $("#franchise_id").html(result);
            // cascade: franchise options now exist, load area code / price code for the selected franchise
            $("#franchise_id").trigger('change');
        }
    });
});

$("#franchise_id").change(function(){
    var franchise_id = this.value;
    $.ajax({
        url: "<?php echo base_url();?>" + "manage/ajax/AreaCode/",
        data: {franchise_id: franchise_id, selected_id: savedAreaCode},
        type: 'post',
        success: function(result){
            $("#area_code").html(result);
        }
    });

    $.ajax({
        url: "<?php echo base_url();?>" + "manage/ajax/pricecode/",
        data: {franchise_id: franchise_id},
        type: 'post',
        success: function(result){
            $("#product_section").html(result);
        }
    });
});

<?php if ($school_id > 0) { ?>
// On edit load, fire the cascading dropdowns once so state/franchise/area_code
// options actually get populated (their <select> starts empty otherwise since
// these lists are built via AJAX, not on initial page render). The saved*
// values above let each AJAX endpoint re-select the correct saved option.
$(function(){
    if ($("#country_id").val()) {
        $("#country_id").trigger('change');
    }
});
<?php } ?>
</script>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<?php include('footer.php'); ?>