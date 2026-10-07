<?php include('header.php'); ?>

<div class="container-fluid mx-3">
  <ul class="breadcrumb">
    <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
    <li>School List</li>
  </ul>
</div>

<div>
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-user"></i> School List</h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
      </div>
    </div>

    <div class="box-content">

      <?php if ($this->session->flashdata('success')) { ?>
        <div style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:10px;">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php } ?>

      <!-- ===== FILTER FORM ===== -->
      <form method="POST" id="filterForm">
        <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:flex-end; margin-bottom:16px;">

            <div>
                <label class="control-label">Country <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
                <div class="controls">
                    <select class="span2 form-control" name="country" id="country" style='width:150px;' required>
				        <option value="">Select</option>
			            <option value="105">India</option> 
			            <?php foreach($country as $val) { //print_r($val);?>
						<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country'] ) ) if($result['country'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
						<?php } ?>
			        </select>
                </div>
            </div>

            <div>
                <label class="control-label">State <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
                <div class="controls">
                  <select name="state_id" id="state_id" style="width:200px;">
                    <option value=''>Select State</option>
                    <?php
                      $query = $this->db->order_by('state_subdivision_name','ASC')
                                        ->get_where('states', array('country_id'=>'105'))->result();
                      foreach ($query as $row) { ?>
                      <option value="<?php echo $row->state_subdivision_id; ?>"
                        <?php if($row->state_subdivision_id == $result['state_id']) echo 'selected="selected"'; ?>>
                        <?php echo $row->state_subdivision_name; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
            </div>
          
          

          <div>
            <label class="control-label">Franchise <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="franchise" id="franchise" style="width:200px;">
                <option value=''>Select Franchise</option>
                <?php if(isset($result['franchise']) && $result['franchise']=='All') { ?>
                  <option value="All" selected="selected">All Franchise</option>
                <?php } ?>
                <?php foreach($franchise_load as $value) { ?>
                  <option value="<?php echo $value['franchise_id']; ?>"
                    <?php if($result['franchise'] == $value['franchise_id']) echo 'selected="selected"'; ?>>
                    <?php echo $value['username']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div>
            <label class="control-label">Area Code <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="area_code" id="area" style="width:200px;">
                <?php if(isset($result['area_code']) && $result['area_code']=='All') { ?>
                  <option value="All" selected="selected">All Area</option>
                <?php } ?>
                <option value=''>-- Select Area --</option>
                <?php foreach($area_load as $servicelistval) { ?>
                  <option value="<?php echo $servicelistval['area_code']; ?>"
                    <?php if($result['area_code'] == $servicelistval['area_code']) echo 'selected="selected"'; ?>>
                    <?php echo $servicelistval['city_name']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div>
            <label class="control-label">Status <span style="color:#F00;font-size:15px;"><b>*</b></span></label>
            <div class="controls">
              <select name="status" id="status" style="width:200px;">
                <option value="All"      <?php if($result['status']=='All')      echo 'selected'; ?>>All</option>
                <option value="Active"   <?php if($result['status']=='Active')   echo 'selected'; ?>>Active</option>
                <option value="Pending"  <?php if($result['status']=='Pending')  echo 'selected'; ?>>Pending</option>
                <option value="Inactive" <?php if($result['status']=='Inactive') echo 'selected'; ?>>Inactive</option>
                <option value="Deleted"  <?php if($result['status']=='Deleted')  echo 'selected'; ?>>Deleted</option>
                <option value="Deactive" <?php if($result['status']=='Deactive') echo 'selected'; ?>>Deactive</option>
              </select>
            </div>
          </div>

          <div class="form-actions" style="margin:0;">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
          </div>

        </div>
      </form>
      <!-- ===== END FILTER FORM ===== -->

      <?php if(!empty($schoolList)) { ?>

        <div style="display:flex; justify-content:end; align-items:center; margin-bottom:10px;">
         
          <form method="POST">
            <input type="hidden" name="state_id" value="<?php echo $result['state_id']; ?>">
            <input type="hidden" name="franchise" value="<?php echo $result['franchise']; ?>">
            <input type="hidden" name="area_code" value="<?php echo $result['area_code']; ?>">
            <input type="hidden" name="status"    value="<?php echo $result['status']; ?>">
            <input type="submit" class="btn btn-warning" value="Export CSV" name="export">
          </form>
        </div>

        <div class="mb-4" style="overflow-x:auto;">
<table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                <th>Sl No</th>
                <th>School Code</th>
                <th>School Name</th>
                <th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>Franchise</th>
                <th>School Status</th>
                <th>School Details</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach($schoolList as $value) { ?>
             
              <tr>
                <td><?php echo $i; ?></td>
                <td style="font-family:monospace; font-size:11px;"><?php echo $value['school_code']; ?></td>
                <td style="font-weight:500;"><?php echo $value['school_name']; ?></td>
                <td><?php echo $value['school_address'] . ' ' . $value['city']; ?></td>
                <td><?php echo $value['state_subdivision_name']; ?></td>
                <td><?php echo $value['city']; ?></td>
                <td style="font-size:11px;"><?php echo $value['franchise_code'] . ' ' . $value['franchise_first_name']; ?></td>
                <td><?php echo $value['school_status']; ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>manage/franchise/schoolaccees/<?php echo $value['id']; ?>"
                     class="btn btn-primary" style="font-size:11px;">View &amp; Edit</a>
                </td>
                <td>
                  <a class="btn btn-danger" style="font-size:11px;"
                     onclick="return confirm('Are you sure you want to delete this school?');"
                     href="<?php echo SITE_URL; ?>school/adminSchooldelete/<?php echo $value['id']; ?>">
                    Delete
                  </a>
                </td>
              </tr>
              <?php $i++;  } ?>
            </tbody>
          </table>
        </div>

      <?php } else { ?>
        <div style="text-align:center;"><h3>No School Found ...</h3></div>
      <?php } ?>

    </div><!-- /.box-content -->
  </div><!-- /.box -->
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/* ===== CASCADE DROPDOWNS ===== */
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
    $.ajax({
        url:  "<?php echo base_url(); ?>manage/ajax/franchiseList",
        data: { state_id: this.value },
        type: 'post',
        success: function(result){ $("#franchise").html(result); }
    });
});

$("#franchise").change(function(){
    $.ajax({
        url:  "<?php echo base_url(); ?>manage/ajax/AreaCode/",
        data: { franchise_id: this.value },
        type: 'post',
        success: function(result){ $("#area").html(result); }
    });
});
</script>
 <script>
        $(document).ready(function(){
            
            $('#Btnsubmit').click(function(){
               // alert('sasasas');
        $('#loader').show(); 
         setTimeout(function() {
            $('#loader').hide(); // Hide loader after specified duration
        }, 60000);
    });
            
            var state_id =$('#state_id').val();
           
            $.ajax({
            url:"<?php echo base_url();?>manage/ajax/franchiseList",
            data:{state_id:state_id},
            type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#franchise_id").html(result);
            	 
            
            }});
            
           
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
        <?php include('footer.php'); ?>
