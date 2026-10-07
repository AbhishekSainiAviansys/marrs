<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 

<style>
    #example_filter { float: right; }
    #example_length { }
    #example_paginate { margin-left: 15px; }
    #example_info { padding-left: 5px; }
    .card-header .icon-actions a { margin-left: 6px; }
</style>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>
<link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
 
<div class="container py-3">
 
    <!-- ==================== Filter Card ==================== -->
    <div class="card shadow-sm mb-3">
 
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold"><i class="bi bi-upload me-1"></i> Upload CSV file</span>
            <div class="icon-actions">
                <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-gear"></i></a>
                <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-up"></i></a>
                <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-x"></i></a>
            </div>
        </div>
 
        <div class="card-body">
 
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="border rounded p-3">
                <div class="row g-3 align-items-end">
 
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Level:</label>
                        <select name="level" id="level" class="form-select" required>
                            <option style='display:none;'>Select level</option>
                            <option value='1'>SCHOOL LEVEL</option>
                            <!--<option value='2'>NATIONAL PRELIMS Q1</option>-->
                            <option value='2'>NATIONAL FINALS </option>
                            <?php
 
                            //  $query = $this->db->query("SELECT * FROM countries;");
 
                            //  foreach ($query->result() as $row)
                            // {
                            // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                            // }
 
                            ?>
                        </select>
                    </div>
 
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">School:</label>
                        <select name="school" class="form-select">
                            <option value="">All School</option>
                            <?php
 
                            $query = $this->db->query("SELECT school_name FROM student_to_zoomzoom group by school_name;");
 
                            foreach ($query->result() as $row)
                            {
                            echo "<option value='{$row->school_name}'> {$row->school_name}{$row->school_address}</option>";
                            }
 
                            ?>
                        </select>
                    </div>
 
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Class:</label>
                        <select name="class" class="form-select">
                            <option value="All">All Class</option>
                            <option value="Nursery">Nursery</option>
                            <option value="LKG">LKG</option>
                            <option value="UKG">UKG</option>
                            <option value="Class-1">Class-1</option>
                            <option value="Class-2">Class-2</option>
                            <option value="Class-3">Class-3</option>
                            <option value="Class-4">Class-4</option>
                            <option value="Class-5">Class-5</option>
                            <option value="Class-6">Class-6</option>
                            <option value="Class-7">Class-7</option>
                            <option value="Class-8">Class-8</option>
                        </select>
                    </div>
 
                    <div class="col-md-2">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success w-100">
                    </div>
 
                </div>
 
                <div id="csvResult_uploadLog_div" class="mt-3"></div>
 
            </form>
 
        </div>
    </div>
 
    <?php if(!empty($student)){ ?>
 
    <!-- ==================== Results Card ==================== -->
    <form method="POST">
 
        <input type='hidden' name='lev' value='<?php echo $lev; ?>'>
        <input type='hidden' name='sch' value='<?php echo $sch; ?>'>
        <input type='hidden' name='cla' value='<?php echo $cla; ?>'>
 
        <div class="mb-3">
            <button name='export' class='btn btn-primary'>
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
            </button>
        </div>
 
        <div class="card shadow-sm">
 
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-person-fill me-1"></i> CIN</span>
                <div class="icon-actions">
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-up"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-x"></i></a>
                </div>
            </div>
 
            <div class="card-body">
 
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>SL No.</th>
                                <th>Student Name</th>
                                <th>PRID</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Class</th>
                                <th>State</th>
                                <!--<th>Product</th>-->
                                <th>School Name</th>
                                <th>Level</th>
                            </tr>
                        </thead>
                        <tbody>
 
                            <?php $i=1;foreach( $student as $value ) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
 
                                <td><?php echo $value['first_name'].' '.$value['middle_name'].' '.$value['last_name']; ?></td>
                                <td><?php echo $value['zoomzoom_prid']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['mobile']; ?></td>
                                <td><?php echo $value['class']; ?></td>
                                <td>
                                    <?php echo $value['state']; ?>
                                </td>
                                <td>
                                    <?php echo $value['school_name']; ?>
                                </td>
                                <td>
                                    <?php echo $value['clevel']; ?>
                                </td>
                                <!--<td class="center">-->
 
                                <!--	<a class="btn btn-info" href="" title="Edit">-->
                                <!--		Edit                              -->
                                <!--	</a>-->
                                <!--</td>-->
                                <!--	<td class="center">-->
 
                                <!--	<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletecin/<?php echo $value['id'];?>" title="Delete">-->
                                <!--		Delete                              -->
                                <!--	</a>-->
                                <!--</td>-->
 
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>
 
            </div>
        </div>
 
    </form>
 
    <?php } ?>
 
</div>

<script>new DataTable('#example');</script>
 <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
        

<script>
$(function () {
    $('#example').DataTable({
        responsive: true
    });
 
    // If you use select2 for the level/school/class dropdowns, uncomment:
    // $('#level, select[name="school"], select[name="class"]').select2({ width: '100%' });
});
</script>
<script type="text/javascript">
// $("#area").change(function(){
// var area_code =this.value;
//  //alert(franchise_id);
//  var BASE_URL="<?php echo base_url();?>";
// $.ajax({
// url:"<?php echo base_url();?>manage/ajax/school_list",
// data:{area_code:area_code},
// type: 'post',
// success:function(result)
// {
// 	//alert(result);
// 	 $("#school").html(result);
	 

// }});
// });

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
var franchise_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/AreaCode",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>
<?php include('footer.php'); ?>
