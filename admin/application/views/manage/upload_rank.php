<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
<style>
/* ================================
   RESULT CSV UPLOAD - UI ONLY
================================ */

.result-upload-form {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 22px;
    margin-bottom: 20px;
}

/* Filter / Upload fields */
.result-upload-fields {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    align-items: flex-end;
}

.result-upload-field {
    flex: 1 1 200px;
    min-width: 190px;
}

.result-upload-field label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #343a40;
    margin-bottom: 7px;
}

.result-upload-field .form-control {
    width: 100%;
    height: 40px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    box-sizing: border-box;
    background: #fff;
}

.result-upload-field .form-control:focus {
    border-color: #80bdff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,123,255,.10);
}

/* File input */
.result-upload-field input[type="file"] {
    padding: 7px 10px;
    font-size: 13px;
}

/* Submit button */
.result-upload-submit {
    flex: 0 0 auto;
}

.result-upload-submit input {
    height: 40px;
    padding: 0 25px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: .2s ease;
}

.result-upload-submit input:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,.15);
}

/* ================================
   RESULT AREA
================================ */

#csvResult_uploadLog_div {
    margin-top: 25px;
}

.rank-upload-card {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 9px;
    overflow: hidden;
}

.rank-upload-title {
    background: #f1f3f5;
    padding: 13px 16px;
    border-bottom: 1px solid #dee2e6;
    color: #343a40;
    font-size: 15px;
    font-weight: 600;
}

.rank-upload-title i {
    margin-right: 6px;
}

/* Table */
.rank-upload-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.rank-upload-table {
    width: 100%;
    min-width: 700px;
    margin: 0;
    border-collapse: collapse;
}

.rank-upload-table th {
    background: #f8f9fa;
    color: #495057;
    font-size: 13px;
    font-weight: 600;
    padding: 12px 10px;
    border: 1px solid #dee2e6;
    white-space: nowrap;
}

.rank-upload-table td {
    padding: 11px 10px;
    border: 1px solid #dee2e6;
    font-size: 13px;
    color: #343a40;
    vertical-align: middle;
}

.rank-upload-table tbody tr:hover {
    background: #f8f9fa;
}

/* Status */
.rank-upload-table td.status-cell {
    font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {

    .result-upload-form {
        padding: 15px;
    }

    .result-upload-fields {
        display: block;
    }

    .result-upload-field {
        width: 100%;
        margin-bottom: 15px;
    }

    .result-upload-submit {
        width: 100%;
    }

    .result-upload-submit input {
        width: 100%;
    }
}
</style>			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2>
			       <i class="icon-edit"></i>Upload CSV Result file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

    <div class="result-upload-form">

        <div class="result-upload-fields">

            <!-- Period -->
            <div class="result-upload-field">

                <label for="period">
                    Period
                </label>

                <select
                    name="period"
                    id="period"
                    class="form-control"
                    required
                >
                    <option style="display:none;">Select period</option>

                    <?php 

                    $query = $this->db->query(
                        "SELECT * FROM `period` where period_id > '11';"
                    ); 

                    foreach ($query->result() as $row)
                    { 
                        echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                    }

                    ?>
                </select>

            </div>


            <!-- Product -->
            <div class="result-upload-field">

                <label for="product_name">
                    Product
                </label>

                <select
                    name="product"
                    id="product_name"
                    class="form-control"
                    required
                >
                    <option style="display:none;">Select product</option>

                    <?php 

                    $query = $this->db->query(
                        "SELECT * FROM products;"
                    ); 

                    foreach ($query->result() as $row)
                    { 
                        echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                    }

                    ?>
                </select>

            </div>


            <!-- Competition Level -->
            <div class="result-upload-field">

                <label for="level">
                    Competition Level
                </label>

                <input
                    name="level"
                    type="text"
                    class="form-control"
                    placeholder="Enter Level Name"
                >

            </div>


            <!-- CSV File -->
            <div class="result-upload-field">

                <label for="csv">
                    Choose CIN Result CSV File
                </label>

                <input
                    name="csv"
                    class="form-control"
                    type="file"
                    id="csv"
                >

            </div>


            <!-- Submit -->
            <div class="result-upload-submit">

                <input
                    type="submit"
                    name="submit"
                    value="Submit"
                    class="btn btn-danger"
                >

            </div>

        </div>

    </div>


    <!-- ================= RESULT ================= -->

    <div id="csvResult_uploadLog_div">

        <?php if(!empty($csvResult_upoload_logArray)): ?>

            <div class="rank-upload-card">

                <div class="rank-upload-title">
                    <i class="icon-list"></i>
                    RANK UPLOAD LIST
                </div>

                <div class="rank-upload-table-wrapper">

                    <table class="rank-upload-table">

                        <thead>

                            <tr>
                                <th style="width:70px;">SI No</th>
                                <th>CIN</th>
                                <th>Rank</th>
                                <th>Speller</th>
                                <th>Performer</th>
                                <th>Level Name</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            $i=0;

                            foreach($csvResult_upoload_logArray as $details):

                            ?>

                            <tr>

                                <td align="CENTER">
                                    <?php echo $i=$i+1; ?>
                                </td>

                                <td align="CENTER">
                                    <?php echo $details[0]; ?>
                                </td>

                                <td align="CENTER">
                                    <?php echo $details[1]; ?>
                                </td>

                                <td align="CENTER">
                                    <?php echo $details[3]; ?>
                                </td>

                                <td align="CENTER">
                                    <?php echo $details[4]; ?>
                                </td>

                                <td align="CENTER">
                                    <?php echo $details[6]; ?>
                                </td>

                                <td
                                    align="CENTER"
                                    class="status-cell"
                                    style="
                                        background-color: <?php echo $details[5]; ?>;
                                        color:#fff;
                                        font-weight:bold;
                                    "
                                >
                                    <?php echo $details[2]; ?>
                                </td>

                            </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        <?php endif; ?>

    </div>

</form>  </div>	
 </div><!--/span-->
</div><!--/row-->

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<script type="text/javascript">
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
	
</script>



<?php include('footer.php'); ?>