<?php include('header.php');
// print_R($result);
// echo '<br>';
// print_r($area_load);
?>
<style>
    .total{
        display: flex;
        justify-content: space-between;
        /*flex-wrap: wrap;*/
    /*align-content: center;*/
        /*align-items: flex-end;*/
    }
</style>
<style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  margin-left:42%;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    div#example_filter {
    float: right;
    position: relative;
    right: 20px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
div#example_paginate {
    margin-left: 15px;
}
    
    div#example_info {
    padding-left: 15px;
}
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
 <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
        <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Extract CIN List </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="border rounded">

    <!-- ================= FILTER SECTION ================= -->
    <div class="container-fluid p-4 rounded border">

        <!-- Row 1 -->
        <div class="row g-3 align-items-end">

            <!-- Period -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="period_id" class="form-label fw-semibold">
                    Period:<span style='color:red'>*</span>
                </label>

                <select
                    name="period_id"
                    id="period_id"
                    class="form-select"
                    required
                >
                    <option value="">-- Select Period --</option>

                    <?php
                    foreach ($period_load as $row)
                    {
                    ?>
                        <option
                            value="<?php echo $row['period_id'];?>"
                            <?php if($row['period_id']==$result['period_id']){ echo 'selected="selected"';} ?>
                        >
                            <?php echo $row['academic_year'];?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>


            <!-- Country -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="country_id" class="form-label fw-semibold">
                    Country:<span style='color:red'>*</span>
                </label>

                <select
                    name="country_id"
                    id="country_id"
                    class="form-select"
                    required
                >
                    <option value="">-- Select Country --</option>
		            <option value="105">India</option> 
		            <?php foreach($country as $val) { //print_r($val);?>
					<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country_id'] ) ) if($result['country_id'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
					<?php } ?>
                </select>
            </div>


            <!-- State -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="state_id" class="form-label fw-semibold">
                    State:<span style='color:red'>*</span>
                </label>

                <select
                    name="state_id"
                    id="state_id"
                    class="form-select"
                    required
                >
                    <option value="All">All State</option>

                    <?php
                    foreach ($state_load as $row)
                    {
                    ?>
                        <option
                            value="<?php echo $row['state_subdivision_id'];?>"
                            <?php if($row['state_subdivision_id'] == $result['state_id']){ ?> selected="selected" <?php } ?>
                        >
                            <?php echo $row['state_subdivision_name'];?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>


            <!-- Franchise -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="franchise" class="form-label fw-semibold">
                    Franchise:
                </label>

                <select
                    name="franchise"
                    id="franchise"
                    class="form-select"
                >
                    <option value="All">-- Select Franchise --</option>

                    <?php
                    foreach ($franchise_load as $row)
                    {
                    ?>
                        <option
                            value="<?php echo $row['franchise_id'];?>"
                            <?php if($row['franchise_id']==$result['franchise']){ echo 'selected="selected"';} ?>
                        >
                            <?php echo $row['username'];?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>


            <!-- Product -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="product" class="form-label fw-semibold">
                    Product:
                </label>

                <select
                    name="product"
                    id="product"
                    class="form-select"
                >
                    <option value="">-- Select Product --</option>

                    <option
                        value="All"
                        <?php if(isset($result['product']) && $result['product']=='All'){ echo 'selected'; } ?>
                    >
                        All
                    </option>

                    <?php foreach ($product_load as $row) { ?>
                        <option
                            value="<?php echo $row['product_name'];?>"
                            <?php if($row['product_name']==$result['product']){ echo 'selected';} ?>
                        >
                            <?php echo $row['product_name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>


            <!-- Lunar Series + Subject -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <div id="series">

                    <label class="form-label fw-semibold">
                        Lunar Series
                    </label>

                    <select
                        name="series"
                        class="form-select mb-2"
                    >
                        <?php foreach($series as $res){ ?>

                            <option
                                value="<?php echo $res->series; ?>"
                                <?php if($res->series==$result['series']) { echo 'selected="selected"'; } ?>
                            >
                                <?php echo $res->series; ?>
                            </option>

                        <?php } ?>
                    </select>


                    <label class="form-label fw-semibold">
                        Subject
                    </label>

                    <select
                        name="subject"
                        class="form-select"
                    >
                        <?php foreach($subject as $res){ ?>

                            <option
                                value="<?php echo $res->subject; ?>"
                                <?php if($res->subject==$result['subject']) { echo 'selected="selected"'; } ?>
                            >
                                <?php echo $res->subject; ?>
                            </option>

                        <?php } ?>
                    </select>

                </div>

            </div>



            <!-- Area -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <label for="area" class="form-label fw-semibold">
                    Area:
                </label>

                <select
                    name="area"
                    id="area"
                    class="form-select"
                >
                    <option value="">-- Select Area --</option>
                    <option value="All">All Area</option>

                    <option
                        value="All"
                        <?php if(isset($result['area']) && $result['area']=='All'){ echo 'selected'; } ?>
                    >
                        All Area
                    </option>

                    <?php foreach ($area_load as $row) { ?>

                        <option
                            value="<?php echo $row['area_code']; ?>"
                            <?php if(isset($result['area']) && $row['area_code'] == $area) { echo 'selected'; } ?>
                        >
                            <?php echo $row['city_name']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <!-- School -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <label for="school" class="form-label fw-semibold">
                    School:
                </label>

                <select
                    name="school_id"
                    id="school"
                    class="form-select"
                >
                    <option value="">-- Select School --</option>

                    <option
                        value="All"
                        <?php if(isset($result['school_id']) && $result['school_id']=='All'){ echo 'selected'; } ?>
                    >
                        All School
                    </option>

                    <?php foreach ($school_load as $row) { ?>

                        <option
                            value="<?php echo $row['id']; ?>"
                            <?php if(isset($result['school_id']) && $row['id'] == $result['school_id']) { echo 'selected'; } ?>
                        >
                            <?php echo $row['school_name']; ?>
                        </option>

                    <?php } ?>

                </select>

            </div>


            <!-- Competition Date Range -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <label for="date_range" class="form-label fw-semibold">
                    Competition Date Range
                </label>

                <input
                    type="text"
                    id="date_range"
                    class="form-control"
                    placeholder="Select start date - end date"
                    autocomplete="off"
                >

                <!-- Values that will actually be submitted -->
                <input
                    type="hidden"
                    name="start_date"
                    id="start_date"
                >

                <input
                    type="hidden"
                    name="end_date"
                    id="end_date"
                >

            </div>


            <!-- Submit -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                <button
                    type="submit"
                    name="submit"
                    value="Submit"
                    class="btn btn-warning text-lg w-100"
                >
                    Submit
                </button>

            </div>

        </div>

    </div>


    <br>


    <!-------------->
    <div id="csvResult_uploadLog_div">

        <?php if(!empty($student)){ ?>

            <!-- ================= RESULT HEADER ================= -->

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">

                <h4 class="mb-0">
                    <?php echo 'Total Students: '.count($student); ?>
                </h4>

                <button
                    type="submit"
                    name="export"
                    class="btn btn-primary"
                >
                    Export Excel
                </button>

            </div>


            <!-- ================= STUDENT TABLE ================= -->

            <div class="table-responsive border">

                <table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">


                    <thead class="table-light">

                        <tr>
                            <th>SI no</th>
                            <th>CIN</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Period</th>
                            <th>Product Name</th>
                            <th>State</th>
                            <th>School</th>
                            <th>Area Code</th>
                        </tr>

                    </thead>


                    <tbody>

                        <?php
                        $i=1;

                        foreach($student as $value) {

                            $franchise_name = $this->db
                                ->get_where(
                                    'franchise',
                                    array(
                                        'franchise_id'=>$value['franchise_id']
                                    )
                                )
                                ->row()
                                ->username;

                            if($value['school_name']==''){

                                $school_name = $this->db
                                    ->get_where(
                                        'school_new',
                                        array(
                                            'id'=>$value['school_id']
                                        )
                                    )
                                    ->row()
                                    ->school_name;

                            }else{

                                $school_name = $value['school_name'];

                            }
                        ?>

                            <tr>

                                <td>
                                    <?php echo $i; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['cin']; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['student_name']; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['class'];?>
                                </td>

                                <td class="text-center">
                                    <?php echo $academic_year;?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['product_name']; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['state_subdivision_name']; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $school_name; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $value['franchise_code']; ?>
                                </td>

                            </tr>

                        <?php
                            $i++;
                        }
                        ?>

                    </tbody>

                </table>

            </div>


        <?php }

        if(!empty($message)){
        ?>

            <div class="text-center py-4">

                <h3 class="text-danger">
                    <?php echo $message;?>
                </h3>

            </div>

        <?php } ?>

    </div>
    <!-------------->

</form>  </div>	
 </div><!--/span-->
</div>



	<style>
    footer p {
    text-align: center;
    
}
 footer {
    padding: 10px;
    background-color: DarkSalmon;
 }
</style>
<script>new DataTable('#example');</script>
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
        
<script>
document.addEventListener('DOMContentLoaded', function () {

    flatpickr("#date_range", {

        mode: "range",

        dateFormat: "Y-m-d",

        maxDate: "today",

        defaultDate: [
            "<?= $start_date ?>",
            "<?= $end_date ?>"
        ],

        allowInput: false,

        onChange: function(selectedDates) {

            if (selectedDates.length === 2) {

                document.getElementById("start_date").value =
                    flatpickr.formatDate(selectedDates[0], "Y-m-d");

                document.getElementById("end_date").value =
                    flatpickr.formatDate(selectedDates[1], "Y-m-d");
            }
        }
    });

});
</script>
<script>
        $(document).ready(function(){
            
            
           
           $("#product").change(function(){
        
        var product=this.value;
// 		alert(product_id);
		if (product == 'MaRRS Lunar Olympiads') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
    }); 
         jQuery("#series").hide();    
           
        });
        </script>


<script>





    $("#school").select2();
        var username = $('#school option:selected').text();
        var userid = $('#school').val();

    var BASE_URL="<?php echo base_url();?>";

    // Helper: reset a <select> back to its placeholder/default option
    function resetSelect(selector, placeholderHtml){
        $(selector).html(placeholderHtml);
    }
    
    $("#country_id").change(function(){
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

    // ---- STATE changed: everything downstream (franchise, area, school) is now stale ----
    $("#state_id").change(function(){
        var state_id = this.value;

        // Clear downstream fields immediately so a stale selection can never be submitted
        resetSelect('#franchise', '<option value="">-- select franchise --</option>');
        resetSelect('#area', '<option value="">-- select area --</option>');
        resetSelect('#school', '<option value="">-- select school --</option>');

        $.ajax({
            url: BASE_URL + "manage/ajax/franchiseList_",
            data: {state_id: state_id},
            type: 'post',
            success: function(result){
                $("#franchise").html(result);
            }
        });
    });

    $("#state_id").change(function(){
    
        var state_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
    
        $.ajax({
            url: BASE_URL + "manage/ajax/getAreaAjax_/",
            data:{state_id:state_id},
            type:'post',
            success:function(result){
                $("#area").html(result);
            }
        });
    
    });


    // ---- FRANCHISE changed: area and school are now stale ----
    $("#franchise").change(function(){
        var franchise_id = this.value;

        resetSelect('#area', '<option value="">-- select area --</option>');
        resetSelect('#school', '<option value="">-- select school --</option>');

        // Reload area list for the new franchise
        $.ajax({
            url: BASE_URL + "manage/ajax/AreaCode",
            data: {franchise_id: franchise_id},
            type: 'post',
            success: function(result){
                $("#area").html(result);
            }
        });

        // Reload school list for the new franchise (area not yet chosen, so franchise-wide list)
        $.ajax({
            url: BASE_URL + "manage/ajax/school_list_franchisewise",
            data: {franchise_id: franchise_id},
            type: 'post',
            success: function(result){
                $("#school").html(result);
            }
        });
    });

    // ---- AREA changed: school is now stale ----
    $("#area").change(function(){
        var area_code = this.value;
        var period_id = $('#period_id').val();

        resetSelect('#school', '<option value="">-- select school --</option>');

        $.ajax({
            url: BASE_URL + "manage/ajax/school_list_period",
            data: {area_code: area_code, period_id: period_id},
            type: 'post',
            success: function(result){
                $("#school").html(result);
            }
        });
    });

    // ---- PERIOD changed: area/school lists can depend on period too, so clear them ----
    $("#period_id").change(function(){
        var area_code = $('#area').val();

        resetSelect('#school', '<option value="">-- select school --</option>');

        if(area_code){
            $.ajax({
                url: BASE_URL + "manage/ajax/school_list_period",
                data: {area_code: area_code, period_id: this.value},
                type: 'post',
                success: function(result){
                    $("#school").html(result);
                }
            });
        }
    });


$(document).ready(function(){
    var value = $('select#period_id option:selected').val();
     if(value === '12'){
                // Show competition price dropdown
                $('[id="hide"]').hide();
            } 
    $("#period_id").change(function(){
        
         var selectedValue = $(this).val();
            if(selectedValue === '12'){
                // Show competition price dropdown
                $('[id="hide"]').hide();
            } 
            if(selectedValue === '13' || selectedValue === '14'){
                $('[id="hide"]').show();
            }else{
             $('[id="hide"]').hide();   
            }
    });
    
});
</script>
<script>
$(document).ready(function () {

    $('#cinTable').DataTable({
        pageLength: 25,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        ordering: true,
        searching: true,
        paging: true,
        info: true
    });

});
</script>
 <?php include('footer.php');?>