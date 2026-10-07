<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();   
	 
	 //print_r($result);
?> 

        <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
	
<div class="row-fluid sortable">
    <div class="box span12">

        <div class="box-header well" data-original-title>
            <h2>
                <i class="icon-upload"></i> Upload CSV File
            </h2>

            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round">
                    <i class="icon-cog"></i>
                </a>

                <a href="#" class="btn btn-minimize btn-round">
                    <i class="icon-chevron-up"></i>
                </a>

                <a href="#" class="btn btn-close btn-round">
                    <i class="icon-remove"></i>
                </a>
            </div>
        </div>


        <div class="box-content">

            <form
                action=""
                method="post"
                enctype="multipart/form-data"
                name="form1"
                id="form1"
            >

                <!-- ================= UPLOAD SECTION ================= -->

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="row g-4">

                            <!-- Template Structure -->
                            <div class="col-12">

                                <div class="border rounded-3 p-3 bg-light">

                                    <div class="d-flex align-items-center mb-3">

                                        <div
                                            class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width:38px;height:38px;"
                                        >
                                            <i class="icon-list"></i>
                                        </div>

                                        <div>
                                            <h5 class="mb-0 fw-semibold">
                                                Upload Template Structure
                                            </h5>

                                            <small class="text-muted">
                                                Your CSV file should follow this column structure
                                            </small>
                                        </div>

                                    </div>


                                    <div class="d-flex flex-wrap gap-2">

                                        <span class="badge bg-primary px-3 py-2">
                                            CIN
                                        </span>

                                        <span class="text-muted align-self-center">|</span>

                                        <span class="badge bg-secondary px-3 py-2">
                                            Student Name
                                        </span>

                                        <span class="text-muted align-self-center">|</span>

                                        <span class="badge bg-secondary px-3 py-2">
                                            Class
                                        </span>

                                        <span class="text-muted align-self-center">|</span>

                                        <span class="badge bg-secondary px-3 py-2">
                                            Mobile
                                        </span>

                                        <span class="text-muted align-self-center">|</span>

                                        <span class="badge bg-secondary px-3 py-2">
                                            Email
                                        </span>

                                        <span class="text-muted align-self-center">|</span>

                                        <span class="badge bg-secondary px-3 py-2">
                                            School Code
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <!-- File Upload -->
                            <div class="col-12 col-md-8">

                                <label
                                    for="csv"
                                    class="form-label fw-semibold"
                                >
                                    Choose your Profile Update CSV file
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="icon-file"></i>
                                    </span>

                                    <input
                                        name="csv"
                                        type="file"
                                        id="csv"
                                        class="form-control"
                                        accept=".csv"
                                    >

                                </div>

                                <div class="form-text">
                                    Only CSV files are supported.
                                </div>

                            </div>


                            <!-- Submit -->
                            <div class="col-12 col-md-4 d-flex align-items-center">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100 py-2"
                                    name="submit"
                                    value="Submit"
                                >
                                    <i class="icon-upload icon-white me-1"></i>
                                    Upload CSV
                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ================= RESULT SECTION ================= -->

                <div id="csvResult_uploadLog_div">

                    <?php if(!empty($csvResult_upoload_logArray)): ?>

                        <!-- Result Header -->
                        <div
                            class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2"
                        >

                            <div>
                                <h4 class="mb-1 fw-semibold">
                                    Profile Update Status
                                </h4>

                                <span class="text-muted">
                                    <?php echo $count; ?>
                                </span>
                            </div>

                            <span class="badge bg-info px-3 py-2">
                                <?php echo count($csvResult_upoload_logArray); ?>
                                Records
                            </span>

                        </div>


                        <!-- Status Table -->
                        <div class="card border-0 shadow-sm">

                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table
                                        class="table table-bordered table-hover align-middle mb-0"
                                        style="min-width:1000px;"
                                    >

                                        <thead class="table-light">

                                            <tr>

                                                <th
                                                    class="text-center"
                                                    style="width:60px;"
                                                >
                                                    SI No
                                                </th>

                                                <th>CIN</th>

                                                <th>
                                                    STUDENT NAME
                                                </th>

                                                <th>
                                                    CLASS
                                                </th>

                                                <th>
                                                    Mobile
                                                </th>

                                                <th>
                                                    Email
                                                </th>

                                                <th class="text-center">
                                                    Grademarker
                                                </th>

                                                <th class="text-center">
                                                    Upload Report
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            <?php

                                            $i=0;

                                            foreach($csvResult_upoload_logArray as $details):

                                            ?>

                                            <tr>

                                                <!-- SI No -->
                                                <td class="text-center fw-semibold">

                                                    <?php
                                                    echo $i=$i+1;
                                                    ?>

                                                </td>


                                                <!-- CIN -->
                                                <td class="fw-semibold">

                                                    <?php
                                                    echo $details[0];
                                                    ?>

                                                </td>


                                                <!-- Student Name -->
                                                <td>

                                                    <?php
                                                    echo $details[1];
                                                    ?>

                                                </td>


                                                <!-- Class -->
                                                <td>

                                                    <?php
                                                    echo $details[2];
                                                    ?>

                                                </td>


                                                <!-- Mobile -->
                                                <td>

                                                    <?php
                                                    echo $details[3];
                                                    ?>

                                                </td>


                                                <!-- Email -->
                                                <td>

                                                    <?php
                                                    echo $details[4];
                                                    ?>

                                                </td>


                                                <!-- Grademarker -->
                                                <td class="text-center">

                                                    <span
                                                        class="badge px-3 py-2"
                                                        style="
                                                            background-color: <?php echo $details[7]; ?>;
                                                            color:#fff;
                                                        "
                                                    >
                                                        <?php
                                                        echo $details[5];
                                                        ?>
                                                    </span>

                                                </td>


                                                <!-- Upload Report -->
                                                <td
                                                    class="text-center"
                                                    style="
                                                        background-color: <?php echo $details[8]; ?>;
                                                        color:#fff;
                                                        padding:12px;
                                                    "
                                                >

                                                    <!-- Status -->
                                                    <div
                                                        class="fw-semibold mb-2"
                                                        style="font-size:14px;"
                                                    >

                                                        <?php
                                                        echo $details[6];
                                                        ?>

                                                    </div>


                                                    <!-- Updated Fields -->
                                                    <div
                                                        style="
                                                            font-size:12px;
                                                            opacity:.9;
                                                            margin-bottom:7px;
                                                        "
                                                    >
                                                        Updated Fields
                                                    </div>


                                                    <!-- Updated fields list -->

                                                    <?php
                                                    if (
                                                        !empty($details[9])
                                                        &&
                                                        is_array($details[9])
                                                    ):
                                                    ?>

                                                        <div
                                                            class="rounded p-2"
                                                            style="
                                                                background:rgba(255,255,255,.15);
                                                                text-align:left;
                                                                max-height:120px;
                                                                overflow-y:auto;
                                                            "
                                                        >

                                                            <ul
                                                                class="mb-0 ps-3"
                                                                style="font-size:11px;"
                                                            >

                                                                <?php
                                                                foreach(
                                                                    $details[9]
                                                                    as $field => $value
                                                                ):
                                                                ?>

                                                                    <li class="mb-1">

                                                                        <strong>
                                                                            <?php
                                                                            echo ucfirst(
                                                                                str_replace(
                                                                                    '_',
                                                                                    ' ',
                                                                                    $field
                                                                                )
                                                                            );
                                                                            ?>:
                                                                        </strong>

                                                                        <?php
                                                                        echo htmlspecialchars($value);
                                                                        ?>

                                                                    </li>

                                                                <?php
                                                                endforeach;
                                                                ?>

                                                            </ul>

                                                        </div>

                                                    <?php else: ?>

                                                        <div
                                                            style="
                                                                font-size:11px;
                                                                opacity:.8;
                                                            "
                                                        >
                                                            No fields updated
                                                        </div>

                                                    <?php endif; ?>

                                                </td>

                                            </tr>

                                            <?php
                                            endforeach;
                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    <?php endif; ?>


                    <?php if(!empty($message)): ?>

                        <div
                            class="alert alert-danger text-center mt-4 shadow-sm"
                            role="alert"
                        >

                            <strong>
                                <?php echo $message;?>
                            </strong>

                        </div>

                    <?php endif; ?>

                </div>

            </form>

        </div>

    </div>
</div>

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