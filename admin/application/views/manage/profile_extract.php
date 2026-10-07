<?php include('header.php'); ?>
<style>
    .search-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 6px 24px rgba(20,20,43,0.06), 0 1px 3px rgba(20,20,43,0.04);
        padding: 32px 36px;
        margin-bottom: 24px;
        border: 1px solid #f0f0f0;
    }
    .page-title-row {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 6px;
    }
    .title-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, #ffcb9a, #ff6b00);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(255,107,0,0.25);
    }
    .page-title {
        font-size: 21px;
        font-weight: 700;
        color: #1f1f1f;
        line-height: 1.3;
    }
    .page-subtitle {
        color: #999;
        font-size: 13.5px;
        margin-bottom: 26px;
        margin-left: 56px;
    }
    hr.divider {
        border: none;
        border-top: 1px solid #f0f0f0;
        margin: 0 0 26px;
    }
    .search-form-row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 16px;
    }
    .search-field {
        display: flex;
        flex-direction: column;
        flex: 1 1 340px;
    }
    .search-label {
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 12.5px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #666;
    }
    .search-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-input-wrap .icon-search {
        position: absolute;
        left: 16px;
        color: #c2c2c2;
        font-size: 15px;
        pointer-events: none;
        transition: color 0.25s ease;
    }
    .search-input {
        width: 100%;
        height: 48px;
        border: 1.5px solid #eaeaea;
        border-radius: 10px;
        padding: 10px 16px 10px 42px;
        font-size: 14.5px;
        background: #fafafa;
        color: #222;
        transition: all 0.25s ease;
    }
    .search-input::placeholder {
        color: #b8b8b8;
    }
    .search-input:hover {
        border-color: #ddd;
        background: #f6f6f6;
    }
    .search-input:focus {
        border-color: #ff6b00;
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 4px rgba(255,107,0,0.1);
    }
    .search-input:focus ~ .icon-search,
    .search-input-wrap:focus-within .icon-search {
        color: #ff6b00;
    }
    .btn-search {
        background: linear-gradient(135deg, #ff8a3d, #ff6b00);
        border: none;
        color: white;
        padding: 0 32px;
        height: 48px;
        border-radius: 10px;
        font-size: 14.5px;
        font-weight: 600;
        letter-spacing: 0.3px;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(255,107,0,0.3);
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-search:hover {
        background: linear-gradient(135deg, #ff7a1a, #e65f00);
        box-shadow: 0 6px 18px rgba(255,107,0,0.4);
        transform: translateY(-2px);
    }
    .btn-search:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(255,107,0,0.3);
    }
    .stats-box {
        margin-top: 22px;
        padding: 14px 20px;
        background: #f2fbf2;
        border-left: 4px solid #28a745;
        border-radius: 8px;
        font-size: 15.5px;
        font-weight: 600;
        color: #1e7e34;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-wrapper {
        overflow-x: auto;
        margin-top: 22px;
        border-radius: 10px;
        border: 1px solid #f0f0f0;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }
    .custom-table th {
        background: #ff6b00;
        color: white;
        padding: 13px 12px;
        text-align: center;
        font-size: 13.5px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    .custom-table td {
        padding: 11px 10px;
        border: 1px solid #f2f2f2;
        text-align: center;
        font-size: 13px;
        color: #333;
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
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13.5px;
        cursor: pointer;
        transition: 0.25s ease;
        white-space: nowrap;
        box-shadow: 0 3px 10px rgba(240,173,78,0.3);
        flex-shrink: 0;
        width:auto !important;
        height:auto !important;
    }
    .export-btn:hover {
        background: #ec971f;
        box-shadow: 0 5px 14px rgba(240,173,78,0.4);
        transform: translateY(-1px);
    }
    .empty-msg {
        color: #aaa;
        font-size: 14.5px;
        margin-top: 18px;
        text-align: center;
        padding: 20px;
    }
</style>
<div class="container">
    <div class="search-card">
        <div class="page-title-row">
            <div class="title-icon"><i class="icon-search"></i></div>
            <div class="page-title">Extract CIN Profile + School Level Result</div>
        </div>
        <div class="page-subtitle">Search by CIN, mobile number, email, school name, or student name</div>
        <hr class="divider">

        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="search-form-row">
                <div class="search-field">
                    <label class="search-label" for="schoolSearch">Search Profile<span style='color:red'>*</span></label>
                    <div class="search-input-wrap">
                        <i class="icon-search"></i>
                        <input 
                            type="text"
                            id="schoolSearch"
                            name="search_cin"
                            class="search-input"
                            placeholder="Enter CIN / Mobile / Email / School Name / Student Name..."
                            value="<?php echo !empty($_POST['search_cin']) ? $_POST['search_cin'] : ''; ?>" required
                        >
                    </div>
                </div>
                
                <div class="search-field">
                    <label class="search-label" for="schoolSearch">Search Period</label>
                    <div class="search-input-wrap">
                        <i class="icon-search"></i>
                        <select 
                            name="period_id"
                            class="search-input"
                            
                            value="<?php echo !empty($_POST['period_id']) ? $_POST['period_id'] : ''; ?>"
                        >
                            
                            <option value="">-- Select Period --</option>

                            <?php
                            foreach ($period as $row)
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
                </div>
                
                
                <!-- Product -->
            <div class="search-field">
                    <label class="search-label" for="schoolSearch">Search Product</label>
                    <div class="search-input-wrap">
                        <i class="icon-search"></i>

                <select
                    name="product"
                    id="product"
                    class="form-select"
                >
                    <option value="">-- All Product --</option>

                    <?php foreach ($product as $row) { ?>
                        <option
                            value="<?php echo $row['product_name'];?>"
                            <?php if($row['product_name']==$result['product']){ echo 'selected';} ?>
                        >
                            <?php echo $row['product_name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>
                </div>

                <input 
                    type="submit"
                    name="submit"
                    value="Search"
                    class="btn-search"
                >
            </div>
        </form>

        <div class="stats-box">
            Total Students : <?php echo count($list); ?>
        </div>

    </div>

    <!--<?php //if($message!=''){ ?>-->
    <?php if(!empty($message)){ ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if(!empty($list)){ ?>

        <form method="post" class="mb-5">
            <input type="hidden" name="period_id" value="<?php echo !empty($result['period_id']) ? htmlspecialchars($result['period_id']) : ''; ?>">
            <input type="hidden" name="product" value="<?php echo !empty($result['product']) ? htmlspecialchars($result['product']) : ''; ?>">
            <input type="hidden" name="search_cin" value="<?php echo !empty($result['search_cin']) ? htmlspecialchars($result['search_cin']) : ''; ?>">
        
            <input 
                class="export-btn"
                type="submit"
                name="export_profile"
                value="Export As Template"
            >
        </form>
        
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
                            <!--<th>School Code</th>-->
                            <th>Competition Date</th>
                            <th>School Name</th>
                            <th>Action</th>
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
                            <td><?php echo !empty($details['student_name']) ? $details['student_name'] : ''; ?></td>

                            <td><?php echo !empty($details['father_name']) ? $details['father_name'] : ''; ?></td>
                            
                            <td><?php echo !empty($details['mother_name']) ? $details['mother_name'] : ''; ?></td>
                            
                            <td><?php echo !empty($details['class']) ? $details['class'] : ''; ?></td>
                            
                            <td><?php echo !empty($details['status']) ? $details['status'] : ''; ?></td>
                            
                            <td><?php echo !empty($details['rank']) ? $details['rank'] : ''; ?></td>
                            
                            <td><?php echo !empty($details['marks']) ? $details['marks'] : ''; ?></td>
                            <!--<td><?php //echo !empty($details['school_code']) ? $details['school_code'] : ''; ?></td>-->
                            
                            
                                                       <td>
                            <?php
                            echo !empty($details['competition_date'])
                                ? $details['competition_date']
                                : "<span style='color:red;'>Need to add</span>";
                            ?>
                            </td>
                            
                            <td><?php echo !empty($details['school_name']) ? $details['school_name'] : ''; ?></td>
                            
                            <td>
                                
                                <form method="post" class="mb-5 delete-cin-form">

                                    <input type="hidden"
                                           name="period_id"
                                           value="<?php echo !empty($result['period_id']) ? htmlspecialchars($result['period_id']) : ''; ?>">
                                
                                    <input type="hidden"
                                           name="product"
                                           value="<?php echo !empty($result['product']) ? htmlspecialchars($result['product']) : ''; ?>">
                                
                                    <input type="hidden"
                                           name="search_cin"
                                           value="<?php echo !empty($result['search_cin']) ? htmlspecialchars($result['search_cin']) : ''; ?>">
                                
                                    <button type="submit"
                                            class="btn btn-sm btn-danger delete-cin-btn"
                                            name="deletecin"
                                            value="<?php echo htmlspecialchars($details['cin']); ?>">
                                        Delete CIN
                                    </button>
                                
                                </form>
                                
                            </td>
                            
                            
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        

    <?php } else { ?>

        <div class="search-card empty-msg">
            No student records found.
        </div>

    <?php } ?>

</div>

<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>

<script type="text/javascript">

$(document).on('click', '.delete-cin-btn', function (e) {

    e.preventDefault();

    var button = this;
    var cin = $(button).val();

    if (confirm('Are you sure you want to delete CIN: ' + cin + '?')) {

        // Native submit preserves the clicked button's name/value
        button.form.requestSubmit(button);

    }

});

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