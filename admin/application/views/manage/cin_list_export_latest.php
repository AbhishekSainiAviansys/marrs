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
</style>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>
<link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
 
<div class="container py-3">
 
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php //echo SITE_URL?>content/">CIN</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php //echo SITE_URL?>content/">Latest List</a>
            </li>
        </ol>
    </nav>
 
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="row g-3 align-items-end">
                <div class="col-auto">
                    <label for="from_date" class="form-label">From Date:</label>
                    <input type="date" id="from_date" name="from_date" class="form-control" required value="<?php if(isset($dateto)){echo date('Y-m-d', strtotime($dateto));}else{ echo date('Y-m-d');} ?>">
                </div>
                <div class="col-auto">
                    <label for="to_date" class="form-label d-block">&nbsp;</label>
                    <span class="form-text mb-0">Till Today</span>
                </div>
                <div class="col-auto">
                    <label class="form-label d-block">&nbsp;</label>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
 
    <?php if(!empty($student)){ ?>
    <form method="POST">
 
<input type='hidden' name='sta_id' value='<?php echo isset($sta_id) ? $sta_id : ''; ?>'>
<input type='hidden' name='pro' value='<?php echo isset($pro) ? $pro : ''; ?>'>
<input type='hidden' name='ar' value='<?php echo isset($ar) ? $ar : ''; ?>'>
<input type='hidden' name='fra_id' value='<?php echo isset($fra_id) ? $fra_id : ''; ?>'>
<input type='hidden' name='per' value='<?php echo isset($per) ? $per : ''; ?>'>
<input type='hidden' name='sch' value='<?php echo isset($sch) ? $sch : ''; ?>'>
<input type='hidden' name='cla' value='<?php echo isset($cla) ? $cla : ''; ?>'>
<input type='hidden' name='fro' value='<?php echo isset($dateto) ? $dateto : ''; ?>'>
<input type='hidden' name='too' value='<?php echo isset($too) ? $too : ''; ?>'>
 
        <!--<button name='export'  class='btn btn-primary'>Export Excel</button>-->
 
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-person-fill me-1"></i> CIN</span>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-up"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-x"></i></a>
                </div>
            </div>
 
            <div class="card-body">
                <h5 class="mb-3">Today Registered -</h5>
 
                <div class="table-responsive">
<table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Student Name</th>
                    <th>CIN</th>
                    <th>Class</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Area Code</th>
                    <th>School Name</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($student)) { ?>

                    <?php $i = 1; ?>

                    <?php foreach ($student as $value) { ?>

                        <tr>

                            <!-- S.No -->
                            <td>
                                <?php echo $i; ?>
                            </td>

                            <!-- Student Name -->
                            <td>
                                <?php echo !empty($value['student_name'])
                                    ? $value['student_name']
                                    : '-'; ?>
                            </td>

                            <!-- CIN -->
                            <td>
                                <?php echo !empty($value['cin'])
                                    ? $value['cin']
                                    : '-'; ?>
                            </td>

                            <!-- Class -->
                            <td>
                                <?php echo !empty($value['class'])
                                    ? $value['class']
                                    : '-'; ?>
                            </td>

                            <!-- Mobile -->
                            <td>
                                <?php echo !empty($value['stud_phone'])
                                    ? $value['stud_phone']
                                    : '-'; ?>
                            </td>

                            <!-- Email -->
                            <td>
                                <?php echo !empty($value['stud_email'])
                                    ? $value['stud_email']
                                    : '-'; ?>
                            </td>

                            <!-- Area Code -->
                            <td>
                                <?php echo !empty($value['area_code'])
                                    ? $value['area_code']
                                    : '-'; ?>
                            </td>

                            <!-- School Name -->
                            <td>
                                <?php echo !empty($value['school_name'])
                                    ? $value['school_name']
                                    : '-'; ?>
                            </td>

                            <!-- Product Name -->
                            <td>
                                <?php echo !empty($value['product_name'])
                                    ? $value['product_name']
                                    : '-'; ?>
                            </td>

                            <!-- Amount -->
                            <td>
                                ₹ <?php echo isset($value['amount'])
                                    ? $value['amount']
                                    : '0'; ?>
                            </td>

                            <!-- Date & Time -->
                            <td>
                                <?php echo !empty($value['Time'])
                                    ? $value['Time']
                                    : '-'; ?>
                            </td>

                            <!-- Status -->
                            <td>
                                <?php echo 'OPEN Registration'; ?>
                            </td>

                            <!-- Action -->
                            <td>

                                <?php

                                $query = $this->db->get_where(
                                    'cin_list',
                                    array(
                                        'cin' => $value['cin']
                                    )
                                );

                                $res = $query->row_array();

                                ?>

                                <?php if (!empty($res)) { ?>

                                    <a href="<?php echo base_url(); ?>manage/franchise/editcin/<?php echo $res['id']; ?>"
                                       class="btn btn-primary btn-sm">
                                        Edit
                                    </a>

                                <?php } ?>

                            </td>

                        </tr>

                        <?php $i++; ?>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="13" style="text-align:center;">
                            No records found
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>                </div>
 
                <!--<div class="pagination pagination-left">-->
                <!--	 <ul>-->
                <!--		<li><a href="#">Prev</a></li>-->
                <!--		<li><a href="#">1</a></li>-->
                <!--		<li><a href="#">2</a></li>-->
                <!--		<li><a href="#">3</a></li>-->
                <!--		<li><a href="#">4</a></li>-->
                <!--		<li><a href="#">5</a></li>-->
                <!--		<li><a href="#">Next</a></li>-->
                <!--	  </ul>-->
                <!--</div>-->
 
            </div>
        </div>
 
    </form>
 
    <?php }else{?>
    <div class="text-center">
        <h3 class="text-danger"><?php  echo 'No student is found registered on searched date !';?></h3>
    </div>
    <?php  }
    ?>
 
</div><!--/row-->

<script>new DataTable('#example');</script>
 <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
        
<?php include('footer.php'); ?>


<script type="text/javascript">
$("#area").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_list",
data:{area_code:area_code},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

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