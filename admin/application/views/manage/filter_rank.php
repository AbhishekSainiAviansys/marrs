<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
	 
	 
// 	 print_r($result);
?> 
			
<style>
/* =========================================
   SEARCH RANK LIST - UI ONLY
========================================= */

.rank-search-form {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 22px;
    margin-bottom: 20px;
}

.rank-search-fields {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    align-items: flex-end;
}

.rank-search-field {
    flex: 1 1 220px;
    min-width: 200px;
}

.rank-search-field label {
    display: block;
    margin-bottom: 7px;
    font-size: 13px;
    font-weight: 600;
    color: #343a40;
}

.rank-search-field select {
    width: 100% !important;
    height: 40px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    background: #fff;
    padding: 7px 10px;
    box-sizing: border-box;
}

.rank-search-field select:focus {
    border-color: #80bdff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,123,255,.10);
}

.rank-search-submit {
    flex: 0 0 auto;
}

.rank-search-submit input {
    height: 40px;
    padding: 0 26px;
    border: 0;
    border-radius: 6px;
    background: #0d6efd;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s ease;
}

.rank-search-submit input:hover {
    background: #0b5ed7;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,.15);
}


/* =========================================
   MESSAGE
========================================= */

.rank-message {
    margin-bottom: 18px;
    padding: 12px 16px;
    border-radius: 7px;
    background: #fff3cd;
    border: 1px solid #ffecb5;
    color: #664d03;
}


/* =========================================
   RESULT CARD
========================================= */

.rank-result-card {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 9px;
    overflow: hidden;
}

.rank-result-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 14px 18px;
    background: #f1f3f5;
    border-bottom: 1px solid #dee2e6;
}

.rank-result-title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #343a40;
}

.rank-result-title i {
    margin-right: 6px;
}

.rank-pdf-btn {
    white-space: nowrap;
    border-radius: 6px;
}


/* =========================================
   TABLE
========================================= */

.rank-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.rank-table {
    width: 100%;
    min-width: 1200px;
    margin: 0;
    border-collapse: collapse;
}

.rank-table th {
    background: #f8f9fa;
    color: #495057;
    font-size: 12px;
    font-weight: 600;
    padding: 12px 9px;
    border: 1px solid #dee2e6;
    white-space: nowrap;
}

.rank-table td {
    padding: 10px 9px;
    border: 1px solid #dee2e6;
    font-size: 13px;
    color: #343a40;
    vertical-align: middle;
}

.rank-table tbody tr:hover {
    background: #f8f9fa;
}

.rank-number {
    font-weight: 600;
}

.rank-cin {
    font-weight: 600;
    color: #0d6efd;
}

.rank-position {
    font-weight: 700;
    color: #198754;
}

.rank-delete-btn {
    border-radius: 5px;
    padding: 5px 12px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 768px) {

    .rank-search-form {
        padding: 15px;
    }

    .rank-search-fields {
        display: block;
    }

    .rank-search-field {
        width: 100%;
        margin-bottom: 15px;
    }

    .rank-search-submit {
        width: 100%;
    }

    .rank-search-submit input {
        width: 100%;
    }

    .rank-result-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .rank-pdf-btn {
        width: 100%;
    }
}
</style>


<div class="row-fluid sortable mb-5">

    <div class="box span12">

        <!-- HEADER -->
        <div class="box-header well" data-original-title>

            <h2>
                <i class="icon-search"></i>
                Search Rank List
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


        <!-- CONTENT -->
        <div class="box-content">

            <form
                action=""
                method="post"
                enctype="multipart/form-data"
                name="form1"
                id="form1"
            >

                <!-- ================= SEARCH FILTER ================= -->

                <div class="rank-search-form">

                    <div class="rank-search-fields">


                        <!-- Period -->
                        <div class="rank-search-field">

                            <label for="period">
                                Period
                            </label>

                            <select
                                name="period"
                                id="period"
                                required
                            >

                                <option value="" disabled>
                                    Select period
                                </option>

                                <?php foreach ($period as $row): ?>

                                    <option
                                        value="<?= $row->period_id ?>"
                                        <?= (!empty($result['period']) && $result['period'] == $row->period_id) ? 'selected' : '' ?>
                                    >
                                        <?= $row->period_id ?> -
                                        <?= $row->period_name ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- Product -->
                        <div class="rank-search-field">

                            <label for="product_name">
                                Product
                            </label>

                            <select
                                name="product"
                                id="product_name"
                                required
                            >

                                <option style="display:none;">
                                    Select product
                                </option>

                                <?php

                                $query = $this->db->query(
                                    "SELECT * FROM products;"
                                );

                                foreach ($query->result() as $row)
                                {
                                    $selected = ($result['product'] == $row->product_id)
                                        ? 'selected'
                                        : '';

                                    echo "<option value='{$row->product_id}' $selected>
                                            {$row->product_id} - {$row->product_name}
                                          </option>";
                                }

                                ?>

                            </select>

                        </div>


                        <!-- Class -->
                        <div class="rank-search-field">

                            <label for="class">
                                Class
                            </label>

                          <select
    name="class"
    id="class"
>
    <option value="">
        -- All Class --
    </option>

    <?php

    $query = $this->db->query(
        "SELECT * FROM `class`;"
    );

    foreach ($query->result() as $row)
    {
    ?>
        <option
            value="<?php echo $row->class_name; ?>"
            <?php echo (!empty($result['class']) && $result['class'] == $row->class_name) ? 'selected' : ''; ?>
        >
            <?php echo $row->class_name; ?>
        </option>
    <?php
    }

    ?>

</select>

                        </div>


                        <!-- Submit -->
                        <div class="rank-search-submit">

                            <input
                                type="submit"
                                name="submit"
                                value="Submit"
                            >

                        </div>

                    </div>

                </div>


                <!-- ================= RESULTS ================= -->

                <div id="csvResult_uploadLog_div">

                    <?php if(isset($message) && !empty($message)){ ?>

                        <div class="rank-message">

                            <?php echo $message; ?>

                        </div>

                    <?php } ?>


                    <?php if(!empty($ranklist)): ?>

                        <div class="rank-result-card">


                            <!-- Result Header -->
                            <div class="rank-result-header">

                                <h4 class="rank-result-title">
                                    <i class="icon-list"></i>
                                    Rank List
                                </h4>

                                <button
                                    onclick="downloadPDF()"
                                    class="btn btn-primary rank-pdf-btn"
                                >
                                    <i class="icon-download-alt"></i>
                                    Download PDF
                                </button>

                            </div>


                            <!-- Table -->
                            <div class="rank-table-wrapper">

                                <table class="rank-table">

                                    <thead>

                                        <tr>

                                            <th>SI No</th>
                                            <th>CIN</th>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>CLASS</th>
                                            <th>SCHOOL</th>
                                            <th>RANK</th>
                                            <th>Speller</th>
                                            <th>Performer</th>
                                            <th>Level Name</th>
                                            <th>Action</th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php

                                        $i=0;

                                        foreach($ranklist as $details){

                                        ?>

                                            <tr>

                                                <td class="rank-number text-center">
                                                    <?php echo $i=$i+1; ?>
                                                </td>

                                                <td class="rank-cin text-center">
                                                    <?php echo $details->cin; ?>
                                                </td>

                                                <td>
                                                    <?php echo $details->student_name; ?>
                                                </td>

                                                <td>
                                                    <?php echo $details->stud_email; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php echo $details->stud_phone; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php echo $details->class; ?>
                                                </td>

                                                <td>
                                                    <?php echo $details->school; ?>
                                                </td>

                                                <td class="rank-position text-center">
                                                    <?php echo $details->rank; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php echo $details->performer; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php echo $details->speller; ?>
                                                </td>

                                                <td>
                                                    <?php echo $details->level_name; ?>
                                                </td>

                                                <td class="text-center">

                                                    <button
                                                        class="btn btn-danger btn-sm deleteBtn rank-delete-btn"
                                                        data-id="<?= $details->id; ?>"
                                                    >
                                                        <i class="icon-trash"></i>
                                                        Delete
                                                    </button>

                                                </td>

                                            </tr>

                                        <?php

                                        }

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

            </form>

        </div>

    </div>

</div>




<script src="jquery-1.8.3.min.js"></script>

<script src="jquery.uniform.min.js"></script>
<script src="jquery.cleditor.min.js"></script>
<script src="jquery.elfinder.min.js"></script>
<script src="charisma.js"></script>

<script>

$(document).ready(function(){

    $('.deleteBtn').click(function(e){

        e.preventDefault(); // stop form submit

        var id  = $(this).data('id');
        var row = $(this).closest('tr');

        //alert(id); // tracking id

        if(confirm('Are you sure you want to delete this record?'))
        {
            $.ajax({
                url: "<?= base_url('manage/lunar/delete') ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(response){

                    console.log(response);

                    if(response.status == 'success'){
                        row.fadeOut();
                    }else{
                        alert('Delete failed');
                    }

                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }

    });


    $("#country_id").change(function(){
        $.post(BASE_URL+"manage/ajax/getstate/", {id:this.value}, function(result){
            $("#stateID").html(result);
        });
    });

    $("#product_name").change(function(){
        $.post(BASE_URL+"manage/ajax/productwiselevel/", 
            {product_id:this.value}, 
            function(result){
                $("#competition_level_id").html(result);
        });
    });

});
</script>


<?php //print_r($result); ?>

<script>
const pdfMeta = {
    product_name: "<?= addslashes($result['product_name'] ?? '') ?>",
    level_name: "<?= addslashes($result['level_name'] ?? '') ?>",
    logo_url: "<?= addslashes($result['logo_url'] ?? '') ?>",
    period: "<?= addslashes($result['period'] ?? '') ?>"
    
};
</script>



<script>
// function downloadPDF() {

//     const content = document.getElementById("csvResult_uploadLog_div").innerHTML;

//     const win = window.open('', '_blank');

//     win.document.open();
//     win.document.write(`
//         <!DOCTYPE html>
//         <html>
//         <head>
//             <title>Rank List</title>
//             <style>
//                 body { font-family: Arial, sans-serif; }
//                 table { width:100%; border-collapse: collapse; font-size:12px; }
//                 th, td { border:1px solid #000; padding:5px; text-align:center; }
//                 th { background:#f2f2f2; }
//                 @media print {
//                     button { display:none; }
//                 }
//             </style>
//         </head>
//         <body>


function downloadPDF() {

    const content = document.getElementById("csvResult_uploadLog_div").innerHTML;

    const header = `
        <div style="text-align:center; margin-bottom:20px;">
            ${pdfMeta.logo_url ? `<img src="${pdfMeta.logo_url}" style="max-height:150px;"><br>` : ''}
            <h2 style="margin:5px 0;">${pdfMeta.product_name}</h2>
            <h4 style="margin:5px 0;">${pdfMeta.level_name} - ${pdfMeta.period}</h4>
            <hr>
        </div>
    `;

    const win = window.open('', '_blank');

    win.document.open();
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            
            <style>
                body { font-family: Arial, sans-serif; }
                table { width:100%; border-collapse: collapse; font-size:12px; }
                th, td { border:1px solid #000; padding:5px; text-align:center; }
                th { background:#f2f2f2; }
                h2, h4 { margin: 0; }
                @media print {
                    button { display:none; }
                }
            </style>
        </head>
        <body>
        
        
            ${header}


            ${content}
            <script>
                window.onload = function () {
                    window.print();
                };
            <\/script>
        </body>
        </html>
    `);
    win.document.close();
}
</script>



<?php include('footer.php'); ?>