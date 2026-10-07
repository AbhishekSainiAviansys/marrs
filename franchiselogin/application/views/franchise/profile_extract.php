<?php include('header.php'); ?>

<style>
    .search-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        padding: 25px;
        margin-bottom: 20px;
    }

    .page-title {
        font-size: 22px;
        font-weight: 600;
        color: #ff6b00;
        margin-bottom: 20px;
    }

    .search-label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #444;
    }

    .search-input {
        width: 300px;
        height: 42px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        transition: 0.3s;
    }

    .search-input:focus {
        border-color: #ff6b00;
        outline: none;
        box-shadow: 0 0 5px rgba(255,107,0,0.3);
    }

    .btn-search {
        background: #007bff;
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        font-size: 14px;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-search:hover {
        background: #0056b3;
    }

    .stats-box {
        margin-top: 20px;
        padding: 12px 18px;
        background: #f4fff4;
        border-left: 5px solid green;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        color: green;
    }

    .table-wrapper {
        overflow-x: auto;
        margin-top: 20px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    .custom-table th {
        background: #ff6b00;
        color: white;
        padding: 12px;
        text-align: center;
        font-size: 14px;
    }

    .custom-table td {
        padding: 10px;
        border: 1px solid #eee;
        text-align: center;
        font-size: 13px;
    }

    .custom-table tr:nth-child(even) {
        background: #fafafa;
    }

    .custom-table tr:hover {
        background: #fff4ec;
    }

    .export-btn {
        background: #f0ad4e;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .export-btn:hover {
        background: #ec971f;
    }

    .empty-msg {
        color: #999;
        font-size: 15px;
        margin-top: 15px;
    }
</style>

<div class="container-fluid">

    <div class="search-card">

        <div class="page-title">
            <i class="icon-search"></i> Extract CIN Profile + School Level Result
        </div>

        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

            <label class="search-label">Search CIN</label>

            <input 
                type="text"
                id="schoolSearch"
                name="search_cin"
                class="search-input"
                placeholder="Enter CIN / School Name..."
                value="<?php echo !empty($_POST['search_cin']) ? $_POST['search_cin'] : ''; ?>"
            >

            <br>

            <input 
                type="submit"
                name="submit"
                value="Search"
                class="btn-search"
            >

        </form>

        <div class="stats-box">
            Total Students : <?php echo count($list); ?>
        </div>

    </div>

    <?php if($message!=''){ ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if(!empty($list)){ ?>

        <form method="post">

            <input 
                class="export-btn"
                type="submit"
                name="Export"
                value="Export As Template"
            >

            <div class="table-wrapper">

                <table class="custom-table">

                    <thead>
                        <tr>
                            <th>SI No</th>
                            <th>CIN</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Mother Name</th>
                            <th>Class</th>
                            <th>Status</th>
                            <th>Rank</th>
                            <th>Marks</th>
                            <th>School Code</th>
                            <th>Competition Date</th>
                            <th>School Name</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $i = 0;
                    foreach($list as $details):
                    ?>

                        <tr>

                            <td><?php echo ++$i; ?></td>
                            <td><a href="https://marrs.in/student_registration/welcome/commonLogin/<?php echo $details['cin']; ?>"><?php echo $details['cin']; ?></a></td>
                            <td><?php echo $details['student_name']; ?></td>
                            <td><?php echo $details['father_name']; ?></td>
                            <td><?php echo $details['mother_name']; ?></td>
                            <td><?php echo $details['class']; ?></td>
                            <td><?php echo $details['status']; ?></td>
                            <td><?php echo $details['rank']; ?></td>
                            <td><?php echo $details['marks']; ?></td>

                            <td>As per product</td>

                            <td>
                                <?php
                                if(empty($details['competition_date'])){
                                    echo "<span style='color:red;'>Need to add</span>";
                                } else {
                                    echo $details['competition_date'];
                                }
                                ?>
                            </td>

                            <td><?php echo $details['school_name']; ?></td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </form>

    <?php } else { ?>

        <div class="search-card empty-msg">
            No student records found.
        </div>

    <?php } ?>

</div>

<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>

<script type="text/javascript">

$("#country_id").change(function(){

    var data = new Object();
    data.id = this.value;

    $.ajax({
        url: BASE_URL + "manage/ajax/getstate/",
        data: data,
        type: 'post',
        success:function(result){
            $("#stateID").html(result);
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
            $("#area_id").html(result);
        }
    });

});

$("#country_id").change(function(){

    var country_id = this.value;
    var BASE_URL = "<?php echo base_url();?>";

    $.ajax({
        url: BASE_URL + "manage/ajax/getstateAjax_/",
        data:{country_id:country_id},
        type:'post',
        success:function(result){
            $("#state_id").html(result);
        }
    });

});

$("#area_id").change(function(){

    var area_id = this.value;
    var BASE_URL = "<?php echo base_url();?>";

    $.ajax({
        url: BASE_URL + "manage/ajax/school_list_areawise/",
        data:{area_id:area_id},
        type:'post',
        success:function(result){
            $("#school_id").html(result);
        }
    });

});

</script>