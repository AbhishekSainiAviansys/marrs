<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
<style>
		    
    .result-success {
        background-color: #d4edda !important;
    }

    .result-validation {
        background-color: #fff3cd !important;
    }

    .result-error {
        background-color: #f8d7da !important;
    }

    .status-success {
        color: #155724;
        font-weight: bold;
    }

    .status-validation {
        color: #856404;
        font-weight: bold;
    }

    .status-error {
        color: #721c24;
        font-weight: bold;
    }
    
    .body{
      overflow-x:hidden;   
    }
</style>
	
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV Result file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <!--<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> -->
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
			<table  cellpadding="5px" >
				<tr>
					
                    <?php //print_r($competition_schedule); ?>

					<td>Period:<br />
						<select name="period" id="period" style="width:250px;" disabled>
                            <option value="">Select Period</option>
                        
                            <?php
                            $query = $this->db->get('period');
                        
                            foreach ($query->result() as $row) {
                                $selected = ($competition_schedule->period_id == $row->period_id) ? 'selected' : '';
                        
                                echo "<option value='{$row->period_id}' {$selected}>
                                        {$row->period_id} - {$row->period_name}
                                      </option>";
                            }
                            ?>
                        </select>
                        <input type="hidden"
                           name="search_period"
                           value="<?= $competition_schedule->period_id; ?>">
					</td>
					
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                        <select name="product" id="product" style="width:250px;" disabled>
                            <option value="">Select Product</option>
                        
                            <?php
                            $query = $this->db->get('products');
                        
                            foreach ($query->result() as $row) {
                                $selected = ($competition_schedule->product_name == $row->product_name) ? 'selected' : '';
                        
                                echo "<option value='{$row->product_id}' {$selected}>
                                        {$row->product_id} - {$row->product_name}
                                      </option>";
                            }
                            ?>
                        </select>
                        
                        <input type="hidden"
                           name="product_name"
                           value="<?= $competition_schedule->product_name; ?>">
					</td>
					 
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                        <?php
                        $levels = $this->db
                            ->where('product_name', $competition_schedule->product_name)
                            ->where('level_id', $competition_schedule->clevel)
                            ->get('competition_level_byproduct')
                            ->result();
                        ?>
                        
                        <input type="hidden" name="level" value="<?= $competition_schedule->clevel; ?>">
                        
                        <select name='level' id="level" style="width:250px;" disabled>
                        
                            <?php foreach ($levels as $row) { ?>
                        
                                <option value="<?= $row->level_id; ?>" selected>
                                    <?= $row->level_id; ?> - <?= $row->level_name; ?>
                                </option>
                        
                            <?php } ?>
                        
                        </select>
                        
                        
                        <input type="hidden" name="search_level" value="<?= $competition_schedule->clevel; ?>">
					</td>
					
					<td>Competition Date and Venue:<span style='color:red;'>*</span><br />
						<!--<h3><b>School : </b></h3>-->
                        <?php
                        $centers = $this->db
                            // ->where('exam_centers', $competition_schedule->product_name)
                            ->where('comp_id', $competition_schedule->id)
                            ->get('exam_centers')
                            ->result();
                        ?>
                       
                        <select name='exam_center' id="" style="width:250px;" required>
                        <option value=""> -- Select Center -- </option>
                            <?php foreach ($centers as $row) { ?>
                        
                                <option value="<?= $row->exam_date.','.$row->center_name; ?>" selected>
                                    <?= $row->exam_date; ?> - <?= $row->center_name; ?>
                                </option>
                        
                            <?php } ?>
                        
                        </select>
					    
					</td>
				</tr> 
				
				
				<tr>
    				
    			    <!--<td>Max Marks:<span style='color:red;'>*</span><br/>-->
    			    <!--    <input type="text" name="total_marks" class='' style="width:250px;" required> -->
    			    <!--</td>-->
    			   
    			    <td>Choose your CIN result CSV file <span style='color:red;'>*</span><br />  
    			        <input name="csv" type="file" id="csv" style="width:250px;" required /> 
    			    </td>
    			    
    			    <td> 
    			        <input type="submit"
                           name="submit"
                           id="btnCalculate"
                           value="Calculate Result"
                           class="btn btn-primary" />
    			    </td>
    			    
				</tr> 
				
				
				 
				
				
				<tr>
				    <td colspan=3> Help!! result upload template format help consists of following column attributes for your information.</td>
				</tr>
				<tr>
				    
				    <td>1. CIN</td>
				    <td>2. Finals Marks</td>
				    <td>3. Prelims Marks(If applicable)</td>
				</tr>
		   </table>		 
		 </form>
		   				
		<br />
		
		<div style="margin-bottom:40px;">
            <div id="resultPreview" style="margin-bottom:20px;"></div>
        
            <button type="button"
                    id="btnSaveResult"
                    class="btn btn-success"
                    style="display:none;">
                Confirm & Save Results
            </button>
        </div>
		
		
		
		
		
	
	
	
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>

<script>

/*
|--------------------------------------------------------------------------
| Calculated Rows
|--------------------------------------------------------------------------
*/
var calculatedRows = [];


/*
|--------------------------------------------------------------------------
| Calculate Result
|--------------------------------------------------------------------------
*/
$("#form1").submit(function(e){

    e.preventDefault();

    var BASE_URL = "https://marrs.in/admin/";
    var formData = new FormData(this);

    $.ajax({

        url: BASE_URL + "manage/franchise/calculate_result/<?= $competition_schedule->id ?>",

        type: "POST",

        data: formData,

        processData: false,

        contentType: false,

        dataType: "json",

        beforeSend: function(){

            $("#btnCalculate")
                .prop("disabled", true)
                .val("Calculating...");

            $("#btnSaveResult").hide();

            $("#resultPreview").html(
                '<div class="alert alert-info">Calculating result...</div>'
            );

        },

        success: function(result){

            console.log("Calculation Response:", result);
            console.log("Rows:", result.rows);
            console.log("Rows Length:", result.rows ? result.rows.length : 0);

            $("#btnCalculate")
                .prop("disabled", false)
                .val("Calculate Result");


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            | Render rows regardless of success true/false
            |--------------------------------------------------------------------------
            */
            if(result.rows && Array.isArray(result.rows)){

                console.log("Calling renderResult()");

                renderResult(result.rows);

            }else{

                console.log("No rows found");

                $("#resultPreview").html(
                    '<div class="alert alert-warning">' +
                    'No result rows returned.' +
                    '</div>'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Store ONLY valid rows for save
            |--------------------------------------------------------------------------
            */
            calculatedRows = [];

            if(result.rows && Array.isArray(result.rows)){

                $.each(result.rows, function(i, row){

                    if(row.error !== true){

                        calculatedRows.push(row);

                    }

                });

            }

            console.log("Valid rows for save:", calculatedRows);


            /*
            |--------------------------------------------------------------------------
            | Show Save button only when valid records exist
            |--------------------------------------------------------------------------
            */
            if(calculatedRows.length > 0){

                $("#btnSaveResult").show();

            }else{

                $("#btnSaveResult").hide();

            }

        },

        error: function(xhr, status, error){

            $("#btnCalculate")
                .prop("disabled", false)
                .val("Calculate Result");

            console.log("AJAX Error:", xhr.responseText);
            console.log("Status:", status);
            console.log("Error:", error);

            $("#resultPreview").html(
                '<div class="alert alert-danger">' +
                'Internal Server Error.' +
                '</div>'
            );

        }

    });

});



function showToast(type, message){

    var alertClass = "alert-info";

    if(type === "success"){
        alertClass = "alert-success";
    }

    if(type === "warning"){
        alertClass = "alert-warning";
    }

    if(type === "error"){
        alertClass = "alert-danger";
    }

    var toast = $(
        '<div class="alert ' + alertClass + '" ' +
        'style="position:fixed;top:20px;right:20px;z-index:99999;min-width:300px;">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        message +
        '</div>'
    );

    $("body").append(toast);

    setTimeout(function(){

        toast.fadeOut(500, function(){
            $(this).remove();
        });

    }, 4000);

}


/*
|--------------------------------------------------------------------------
| Display Result
|--------------------------------------------------------------------------
*/
function renderResult(rows){

    console.log("renderResult() called");
    console.log("Rows received:", rows);

    if(!rows || rows.length === 0){

        $("#resultPreview").html(
            '<div class="alert alert-warning">' +
            'No result records found.' +
            '</div>'
        );

        return;
    }


    var html = '';

    html += '<div class="table-responsive">';

    html += '<table class="table table-bordered table-striped">';

    html += '<thead>';

    html += '<tr>';

    html += '<th>Sr.</th>';
    html += '<th>CIN</th>';
    html += '<th>Student Name</th>';
    html += '<th>Class</th>';
    html += '<th>Category</th>';
    html += '<th>Marks</th>';
    html += '<th>High Marks</th>';
    html += '<th>Grade</th>';
    html += '<th>Status</th>';
    html += '<th>Percentile</th>';
    html += '<th>Rank</th>';
    html += '<th>Best Performer</th>';
    html += '<th>Star Speller</th>';
    html += '<th>Message</th>';

    html += '</tr>';

    html += '</thead>';

    html += '<tbody>';


    $.each(rows, function(i, row){

        console.log("Rendering row:", row);


        var rowClass = row.error ? 'table-danger' : 'table-success';


        html += '<tr class="' + rowClass + '">';

        html += '<td>' + (i + 1) + '</td>';

        html += '<td>' + escapeHtml(row.cin || '') + '</td>';

        html += '<td>' + escapeHtml(row.student_name || '') + '</td>';

        html += '<td>' + escapeHtml(row.class || '') + '</td>';

        html += '<td>' + escapeHtml(row.category || '') + '</td>';

        html += '<td>' + (row.marks ?? '') + '</td>';

        html += '<td>' + (row.high_marks ?? '') + '</td>';

        html += '<td>' + escapeHtml(row.grade || '') + '</td>';

        html += '<td>' + escapeHtml(row.status || '') + '</td>';

        html += '<td>' + (row.percentile ?? '') + '</td>';

        html += '<td>' + escapeHtml(row.rank || '') + '</td>';

        html += '<td>' + escapeHtml(row.performer || 'No') + '</td>';

        html += '<td>' + escapeHtml(row.speller || 'No') + '</td>';

        html += '<td>';

        if(row.error){

            html += '<span class="text-danger">';
            html += '<strong>Error:</strong> ';
            html += escapeHtml(row.message || 'Invalid result');
            html += '</span>';

        }else{

            html += '<span class="text-success">';
            html += escapeHtml(row.message || 'Success');
            html += '</span>';

        }

        html += '</td>';

        html += '</tr>';

    });


    html += '</tbody>';

    html += '</table>';

    html += '</div>';


    console.log("Generated HTML:", html);

    $("#resultPreview").html(html);

}


function escapeHtml(value){

    return $('<div>')
        .text(value)
        .html();

}


/*
|--------------------------------------------------------------------------
| Save Result
|--------------------------------------------------------------------------
*/
$("#btnSaveResult").click(function(){

    var BASE_URL = "https://marrs.in/admin/";

    /*
    |--------------------------------------------------------------------------
    | Final safety filter
    |--------------------------------------------------------------------------
    */
    var rowsToSave = [];

    $.each(calculatedRows, function(i, row){

        if(row && row.error !== true){

            rowsToSave.push(row);

        }

    });


    console.log("Rows Before Save:", rowsToSave);


    /*
    |--------------------------------------------------------------------------
    | Don't call API if no valid rows
    |--------------------------------------------------------------------------
    */
    if(rowsToSave.length === 0){

        showToast(
            "warning",
            "There are no valid results available for saving."
        );

        return;

    }


    $.ajax({

        url: BASE_URL + "manage/franchise/save_calculated_result/",

        type: "POST",

        data: {
            rows: JSON.stringify(rowsToSave)
        },

        dataType: "json",

        beforeSend: function(){

            $("#btnSaveResult")
                .prop("disabled", true)
                .text("Saving...");

        },

        success: function(result){

            console.log("Save Response:", result);

            $("#btnSaveResult")
                .prop("disabled", false)
                .text("Confirm & Save Results");

            if(result.success){

                showToast(
                    "success",
                    result.message || "Results saved successfully."
                );

                /*
                |--------------------------------------------------------------------------
                | Reload after short delay so user sees toast
                |--------------------------------------------------------------------------
                */
                setTimeout(function(){

                    location.reload();

                }, 1500);

            }else{

                showToast(
                    "warning",
                    result.message || "Results could not be saved."
                );

            }

        },

        error: function(xhr){

            $("#btnSaveResult")
                .prop("disabled", false)
                .text("Confirm & Save Results");

            console.log("Save Error:", xhr.responseText);

            showToast(
                "error",
                "Internal Server Error while saving results."
            );

        }

    });

});






</script>

