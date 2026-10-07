<?php include('header.php');

?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>

</style>
    <div class="container-fluid mx-3">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>franchise/">Area</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>franchise/Addarea">Addarea</a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="container-fluid py-4 px-4">

  <div class="card shadow-sm border-0">

    <!-- HEADER -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">
        <?php echo ($studentID>0)?'Edit':'Add';?> Area Code 
      </h5>

      <div>
        <i class="bi bi-gear"></i>
        <i class="bi bi-chevron-up"></i>
        <i class="bi bi-x"></i>
      </div>
    </div>

    <div class="card-body">

      <?php echo form_open_multipart('manage/franchise/genrateAreaCode');?>

      <!-- ROW 1 -->
      <div class="row g-3">

        <!-- COUNTRY -->
        <div class="col-md-4">
          <label class="form-label fw-semibold">
            Country <span class="text-danger">*</span>
          </label>

          <select name="country_id" id="country_id" class="form-select" required>
            <?php 
            $this->db->select('*');
            $this->db->from('countries');
            $resc = $this->db->get();
            $coun = $resc->result_array();
            foreach($coun as $val){ ?>
              <option value="<?php echo $val['country_id'];?>"
                <?php if(isset($val['country_code_char2']) && $val['country_code_char2']=='IN') echo 'selected'; ?>>
                <?php echo $val['country_name'];?>
              </option>
            <?php } ?>
          </select>
        </div>

        <!-- STATE -->
        <div class="col-md-4">
          <label class="form-label fw-semibold">
            State <span class="text-danger">*</span>
          </label>

          <select name="state_id" id="state_id" class="form-select" required>
            <?php 
            $this->db->select('*');
            $this->db->from('states');
            $this->db->where('country_id','105');
            $resc = $this->db->get();
            $coun = $resc->result_array();
            foreach($coun as $val){ ?>
              <option value="<?php echo $val['state_subdivision_id'];?>"
                <?php if(isset($state_id) && $val['state_subdivision_id']==$state_id) echo 'selected'; ?>>
                <?php echo $val['state_subdivision_name'];?>
              </option>
            <?php } ?>
          </select>
        </div>

        <!-- DISTRICT -->
        <div class="col-md-4">
          <label class="form-label fw-semibold">
            District <span class="text-danger">*</span>
          </label>

          <select name="district_id" id="district_id" class="form-select" required>
            <option value="">Select District</option>
          </select>
        </div>

      </div>

      <!-- AREA -->
      <div class="row mt-4">
        <div class="col-md-4">
          <label class="form-label fw-semibold">
            Add Area <span class="text-danger">*</span>
          </label>

          <input type="text" name="area" class="form-control" placeholder="Enter Area" required>
        </div>
      </div>

      <!-- BUTTONS -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">
          Submit
        </button>

        <button type="button" class="btn btn-secondary">
          Cancel
        </button>
      </div>

      <?php echo form_close(); ?>

    </div>
  </div>

</div>
 <script type="text/javascript">
$("#state_id").change(function(){
var state_id =this.value;
 //alert(state_id);
 var BASE_URL="https://marrs.in/franchiselogin/"; 
$.ajax({
url:"<?php echo base_url();?>manage/ajax/districtlist",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#district_id").html(result);
}});
});
</script>
 
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<?php include('footer.php'); ?>
  <!-- Modal -->
 