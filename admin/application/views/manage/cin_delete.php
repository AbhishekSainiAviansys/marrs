<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html(); 
	 $fr_id = $this->session->userdata('franchise_id');
	 $frd = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
		$state_id= $frd->state_id;
		$country_id = $frd->country_id;
?> 
<style>
    /* ===== CIN CSV UPLOAD UI ===== */

    .cin-upload-wrapper {
        background: #f8f9fa;
        border: 1px solid #e1e5e9;
        border-radius: 10px;
        padding: 24px;
        margin-top: 10px;
    }

    .cin-upload-form-row {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        background: #fff;
        border: 1px solid #e3e7eb;
        border-radius: 8px;
        padding: 20px;
    }

    .cin-upload-field {
        min-width: 300px;
        flex: 1;
    }

    .cin-upload-field label {
        display: block;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .cin-required {
        color: #dc3545;
    }

    .cin-file-input {
        width: 100%;
        height: 42px;
        padding: 7px 10px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        background: #fff;
        font-size: 14px;
        box-sizing: border-box;
    }

    .cin-file-input:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .12);
    }

    .cin-submit-wrapper {
        flex-shrink: 0;
    }

    .cin-submit-btn {
        height: 42px;
        padding: 0 25px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
        transition: all .2s ease;
    }

    .cin-submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,.12);
    }

    .cin-help-text {
        margin-top: 10px;
        color: #6c757d;
        font-size: 13px;
    }

    .cin-help-text i {
        margin-right: 5px;
    }

    /* ===== RESULT SECTION ===== */

    .cin-result-wrapper {
        margin-top: 25px;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }

    .cin-result-header {
        background: #f1f3f5;
        border-bottom: 1px solid #dee2e6;
        padding: 12px 16px;
        font-weight: 600;
        color: #343a40;
    }

    .cin-result-table {
        margin-bottom: 0 !important;
    }

    .cin-result-table thead th {
        background: #f8f9fa;
        color: #495057;
        font-size: 13px;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding: 12px;
    }

    .cin-result-table tbody td {
        padding: 11px 12px;
        vertical-align: middle;
        font-size: 14px;
    }

    .cin-result-table tbody tr:hover {
        background: #f8f9fa;
    }

    .cin-status {
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .cin-upload-wrapper {
            padding: 15px;
        }

        .cin-upload-form-row {
            padding: 15px;
            display: block;
        }

        .cin-upload-field {
            min-width: 100%;
            margin-bottom: 15px;
        }

        .cin-submit-wrapper {
            width: 100%;
        }

        .cin-submit-btn {
            width: 100%;
        }

        .cin-result-wrapper {
            overflow-x: auto;
        }
    }
</style>			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	



<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

    <div class="cin-upload-wrapper">

        <!-- Upload Section -->
        <div class="cin-upload-form-row">

            <div class="cin-upload-field">

                <label for="csv">
                    Choose your CIN CSV file
                    <span class="cin-required">*</span>
                </label>

                <input
                    name="csv"
                    type="file"
                    id="csv"
                    required
                    class="cin-file-input"
                    accept=".csv"
                >

                <div class="cin-help-text">
                    <i class="icon-info-sign"></i>
                    Enter only CINs in a single column. File should be in CSV format.
                </div>

            </div>


            <div class="cin-submit-wrapper">

                <input
                    type="submit"
                    name="submit"
                    value="Submit"
                    class="btn btn-primary cin-submit-btn"
                >

            </div>

        </div>


        <!-- Result Section -->
        <?php if (!empty($csvResult_upload_logArray)) { ?>

            <div id="csvResult_uploadLog_div" class="cin-result-wrapper">

                <div class="cin-result-header">
                    <i class="icon-list"></i>
                    Upload Result
                </div>

                <div class="table-responsive">

                    <table class="table table-striped table-bordered cin-result-table">

                        <thead>
                            <tr>
                                <th style="width: 35%;">CIN</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($csvResult_upload_logArray as $log) { ?>

                                <tr>

                                    <td>
                                        <strong>
                                            <?php echo $log[0]; ?>
                                        </strong>
                                    </td>

                                    <td class="cin-status">
                                        <?php echo $log[1]; ?>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        <?php } else { ?>

            <div id="csvResult_uploadLog_div">
                <!-- No results to display -->
            </div>

        <?php } ?>

    </div>

</form>  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>

<script type="text/javascript">
$("#area_code").change(function(){
    var area_code =this.value;
     //alert(franchise_id);
     var BASE_URL="https://marrs.in/franchiselogin/";
    $.ajax({
        url:"https://marrs.in/franchiselogin/manage/ajax/school_list",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
        
        }
        
    });
});
</script>