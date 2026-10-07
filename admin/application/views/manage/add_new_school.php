<?php include('header.php');

?>
 

<style>
/*select.span4 {*/
/*    position: relative;*/
/*    top: -16px;*/
/*    left: 303px;*/
/*}*/
/*input.chk {*/
/*    margin-left: 20px;*/
/*    margin-top:10px;*/
/*}  */
/*.form-horizontal .controls {*/
   
/*    margin-left: 150px;*/
  
/*}*/
/*input[type="text"] {*/
/*    width: 96%;*/
/*}*/
/*.section-divider {*/
/*    border-top: 2px solid #ddd;*/
/*    text-align: center;*/
/*    margin-top: 20px;*/
/*    margin-bottom: 30px;*/
/*    margin-left: 20px;*/
/*    margin-right: 20px;*/
/*}*/
/*span.info {*/
/*    display: inline-block;*/
/*    position: relative;*/
/*    padding: 1px 30px 2px 30px;*/
/*    top: -11px;*/
/*    font-size: 18px;*/
/*    color: #4B4B4B;*/
/*    background-color: #fff;*/
/*}*/
    
/*  .multipleSelection {*/
/*      width: 240px;*/
/*      background-color: #eaeaea;*/
/*    }*/

/*    .selectBox {*/
/*      position: relative;*/
/*    }*/

/*    .selectBox select {*/
/*      width: 100%;*/
/*      font-weight: bold;*/
/*    }*/

/*    .overSelect {*/
/*      position: absolute;*/
/*      left: 0;*/
/*      right: 0;*/
/*      top: 0;*/
/*      bottom: 0;*/
/*    }*/

/*    #checkBoxes {*/
/*      display: none;*/
/*      border: 1px #8DF5E4 solid;*/
/*    }*/

/*    #checkBoxes label {*/
/*      display: block;*/
/*    }*/

/*    #checkBoxes label:hover {*/
/*      background-color: #4F615E;*/
/*    }*/
</style>
    <div class="container-fluid mx-3">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>student/">School</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="container-fluid">
  <div class="row">
    <div class="col-12">

      <div class=" shadow box span12">
        <div class=" box-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
           <?php echo ($studentID>0)?'Edit':'Add';?> School 
          </h5>
          <div>
            <button class="btn btn-sm btn-secondary"><i class="icon-cog"></i></button>
            <button class="btn btn-sm btn-warning"><i class="icon-chevron-up"></i></button>
            <button class="btn btn-sm btn-danger"><i class="icon-remove"></i></button>
          </div>
        </div>
<div class="card">
        <div class="card-body my-4">

          <form method="POST" enctype="multipart/form-data" id="myForm">

            <p class="text-danger small">
              The fields marked '<b>*</b>' are mandatory fields.
            </p>

            <!-- ================= SCHOOL ADDRESS ================= -->
            <h6 class="border-bottom pb-2 mb-3">School Address</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Country *</label>
                <select name="country_id" id="country_id" class="form-select" required>
                  <?php foreach($country as $val){ ?>
                    <option value="<?php echo $val['country_id'];?>" <?php if ($val['country_id'] == '105') echo 'selected'; ?>>
                      
                      <?php echo $val['country_name'];?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label">State/Province *</label>
                <select name="stateID" id="state_id" class="form-select" required>
                  <?php foreach($state as $val){ ?>
                    <option value="<?php echo $val['state_subdivision_id'];?>" >
                      
                     <?php echo $val['state_subdivision_name'];?>
                    </option>
                  <?php } ?>
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
                   <?php foreach($franchise as $val){ ?>
                    <option value="<?php echo $val['franchise_id'];?>" >
                      
                     <?php echo $val['username'];?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label">Area Code *</label>
                <select name="area_code" id="area_code" class="form-select" required></select>
              </div>
            </div>

            <!-- ================= SCHOOL PROFILE ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">School Profile</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">School Name *</label>
                <input type="text" name="school_name" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Affiliation Number</label>
                <input type="text" name="affiliation_number" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">School Phone</label>
                <input type="text" name="school_phone" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">School Mobile *</label>
                <input type="text" name="school_mobile" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Address Line1 *</label>
                <input type="text" name="school_address" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Address Line2</label>
                <input type="text" name="school_address1" class="form-control">
              </div>
            </div>

            <div class="row g-3 mt-2">
              <div class="col-md-6">
                <label class="form-label">School Email *</label>
                <input type="text" name="school_email" class="form-control" required>
              </div>

              <div class="col-md-3">
                <label class="form-label">School Board *</label>
                <select name="school_board" class="form-select" required>
                  <option>CBSE</option>
                  <option>ICSE</option>
                  <option>IGCSE</option>
                  <option>State Board</option>
                  <option>Other</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">School Medium *</label>
                <input type="text" name="school_medium" class="form-control" value="English">
              </div>
            </div>

            <!-- ================= PRINCIPAL ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">Principal Details</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Principal Name *</label>
                <input type="text" name="principal_first_name" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Principal Email</label>
                <input type="text" name="principal_email" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Principal Phone</label>
                <input type="text" name="principal_phone" class="form-control">
              </div>
            </div>

            <!-- ================= COORDINATOR ================= -->
            <h6 class="border-bottom pb-2 mt-4 mb-3">Coordinator Details</h6>

            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Coordinator Name *</label>
                <input type="text" name="school_coordinator_first_name" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Coordinator Email *</label>
                <input type="email" name="school_coordinator_email" class="form-control">
              </div>

              <div class="col-md-4">
                <label class="form-label">Coordinator Mobile *</label>
                <input type="number" name="school_coordinator_phone" class="form-control">
              </div>
            </div>

            <!-- ================= BUTTONS ================= -->
            <div class="mt-4 d-flex gap-2">
                <div>
              <input type="submit" name="submit" class="btn btn-success" value="Submit">
              </div>
              <div>
              <button type="button" class="btn btn-danger">Cancel</button>
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

 <style>
 .help-inline{color:#F00;}
 </style>
 
 <script>
$(document).ready(function () {

    var country_id = $("#country_id").val(); // Selected country ID on page load

    $.ajax({
        url: "<?php echo base_url(); ?>manage/ajax/getstateAjax",
        type: "POST",
        data: { country_id: country_id },
        success: function(result) {
            $("#state_id").html(result);
        }
    });

});

$("#country_id").change(function(){
var country_id =this.value;
// alert(state_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/getstateAjax",
data:{country_id:country_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#state_id").html(result);
	 

}});
}); 

 $("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/franchiseList",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});  


$("#franchise_id").change(function(){
		   
		   
		
		//var id = $("#productt_id").val();
		//alert(id);
        var franchise_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#area_code").html(result);
        }});
        
          $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/pricecode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#product_section").html(result);
        }});
    }); 
	
  

	$("#district").change(function(){
		   
		//alert(this.value);
        var district=this.value;
        $.ajax({
            url: "https://marrs.in/franchiselogin/"+"manage/ajax/getAreaAjax/",
            data:{district:district},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#district").html(result);
        }});
    });
</script>
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<?php include('footer.php'); ?>
  <!-- Modal -->
 