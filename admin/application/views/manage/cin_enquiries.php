<?php include('header.php');
?>

<?php echo $this->notifications->display_html();?>
<div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo SITE_URL?>content/">CIN</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo SITE_URL?>content/">Enquiry</a>
            </li>
        </ul>
    </div>
    
			
<div class="container py-3">

    

    <div class="card shadow-sm mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold"><i class="bi bi-person-fill me-1"></i> CIN-Enquiry</span>
            <div>
                <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-up"></i></a>
                <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-x"></i></a>
            </div>
        </div>
    </div>

    <form method="POST">

        <div class="card shadow-sm mb-3">
            <div class="card-title px-3 py-3">
                 <?php if(isset($message) && !empty($message)){ ?>
                    <h4><?php echo $message; ?></h4>
                <?php } ?>
            </div>
            <div class="card-body">
               

                <form method="POST" class=" border rounded p-3">
<div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">State <span style="color:red;">*</span></label>
                        <select name="state_id" class="form-select" required>
                            <option value=''>-- select state --</option>
                            <?php foreach($stateload as $stateload){ ?>
                            <option value="<?php echo $stateload['state_subdivision_id'] ?>" <?php if(isset($result['state_id']) && $stateload['state_subdivision_id']==$result['state_id']){?> selected="selected" <?php } ?> ><?php echo $stateload['state_subdivision_name'] ?></option>;
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Product<span style="color:red;">*</span></label>
                        <select name="product" class="form-select" required>
                            <option value=''>-- select product --</option>
                            <?php foreach($productload as $stateload){ ?>
                            <option value="<?php echo $stateload['product_name'] ?>" <?php if(isset($result['product']) && $stateload['product_name']==$result['product']){?> selected="selected" <?php } ?> ><?php echo $stateload['product_name'] ?></option>;
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Enquiry Start Date <span style="color:red;">*</span></label>
                        <input type="date" name="start_date" class="form-control" value='<?php if(isset($result['start_date'])){ echo $result['start_date'];} ?>' required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Enquiry End Date <span style="color:red;">*</span></label>
                        <input type="date" name="end_date" class="form-control" value='<?php if(isset($result['end_date'])){ echo $result['end_date'];} ?>' required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Type <span style="color:red;">*</span></label>
                        <select name="enquiry_type" class="form-select" required>
                            <option value='1' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==1){?> selected='selected' <?php } ?>>General Enquiry</option>
                            <option value='2' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==2){?> selected='selected' <?php } ?>>Registration/Admit Card Not Active</option>
                            <option value='3' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==3){?> selected='selected' <?php } ?>>Material Not Active</option>
                            <option value='4' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==4){?> selected='selected' <?php } ?>>Orientation Not Active</option>
                            <option value='5' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==5){?> selected='selected' <?php } ?>>Mock Paper Not Active</option>
                            <option value='6' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==6){?> selected='selected' <?php } ?>>Tech Team Support</option>
                            <option value='7' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==7){?> selected='selected' <?php } ?>>Combo Purchase Issue</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status <span style="color:red;">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value='open' <?php if(isset($result['status']) && $result['status']=='Open'){?> selected='selected' <?php } ?>>Open</option>
                            <option value='Closed' <?php if(isset($result['status']) && $result['status']=='Closed'){?> selected='selected' <?php } ?>>Closed</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" name="submit" value="Search" class="btn btn-primary mt-4">
                    </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th>SL No.</th>
                                <th>CIN</th>
                                <th>Student Name</th>
                                <th>Enquiry Type</th>
                                <th>Enquiry</th>
                                <th>Evidence</th>
                                <th>Status</th>
                                <!--<th>Class</th>-->
                                <!--<th>Actions</th>-->
                                <!--<th>Delete</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php  if(!empty($cin_list)){

                            ?>
                            <form method='POST'>
                                <tr>
                                    <input type='hidden' name='sch' value='<?php print_r($sch); ?>'>
                                    <input type='hidden' name='cla' value='<?php print_r($cla) ?>'>
                                    <input type="submit" name="export" value="export" class='btn btn-primary' />
                                </tr>
                            </form>
                            <?php } ?>
                            <?php $i=1;foreach($registration_details as $value ) {
                    // 			print_r($value);
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <!--<td><a><?php echo $value['cin']; ?></a></td>-->
                                <td>
                                    <a href="javascript:void(0);" onclick="openCompetitionScheduleModal('<?php echo $value['cin']; ?>')">
                                        <?php echo $value['cin']; ?>
                                    </a>
                                </td>


                                <td><?php echo $value['student_name']; ?></td>
                                <td><?php echo $value['enquiry_name']; ?></td>
                                <td><?php echo $value['enquiry']; ?></td>
                                <td>
                                    <?php if(!empty($value['evidence'])){ ?>
                                    <img src="https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence']; ?>" style='height:200px;width:150px;'>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo $value['status']; ?>
                                </td>
                                <!--<td><?php echo $value['class']; ?></td>-->

                                <!--<td class="center">-->

                                <!--	<a class="btn btn-info" href="" title="Edit">-->
                                <!--		Edit                              -->
                                <!--	</a>-->
                                <!--</td>-->

                                <!--<td class="center">-->
                                <!--<form method='POST'>-->
                                <!--    <input type='hidded' name='enquiry_id' value='<?php echo $value['enquiry_id']; ?>'>-->
                                <!--	<input type='submit' name='status' class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" value="<?php if($value['status']=='Close'){ echo 'Open';}else{echo 'Close';} ?>" >-->
                                <!--</form>	-->
                                <!--</td>-->

                            </tr>
                            <?php $i++; } ?>


                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>

            </div>
        </div>

    </form>

    <!-- Competition details modal (native Bootstrap 5 modal) -->
    <div class="modal fade" id="competitionModal" tabindex="-1" aria-labelledby="competitionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="competitionModalLabel">Competition Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="modal-section profile-section">
                        <h3>Profile Details</h3>
                        <div id="profile-details">
                            <!-- Dynamic profile details will be loaded here -->
                        </div>
                    </div>

                    <div class="modal-section results-section">
                        <h3>Level-wise Results</h3>
                        <div id="results-details">
                            <!-- Dynamic results details will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    $("#area_code").change(function(){
    var area_code =this.value;
    //  alert('area_code');
        var BASE_URL="https://marrs.in/franchiselogin/";
        $.ajax({
        url:"https://marrs.in/franchiselogin/manage/ajax/school_list",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
        
        }});
    });


function openCompetitionScheduleModal(cin) {
    // Show the modal (Bootstrap 5 modal API)
    const modalEl = document.getElementById('competitionModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();

    // Fetch data from the controller
    const baseUrl = "<?php echo base_url(); ?>";
    const url = baseUrl + "competitionshedule/get_cindata";

    // Make an AJAX request
    $.ajax({
        url: url,
        type: 'POST',
        data: { cin: cin },
        success: function (response) {
            // Parse JSON response
            const data = JSON.parse(response);

            if (data.error) {
                document.getElementById('modal-body').innerHTML = `<p>${data.error}</p>`;
            } else {
                // Populate profile section
                const profileHtml = `
                    <h3>Profile Details</h3>
                    <p><strong>Name:</strong> ${data.profile.student_name}</p>
                    <p><strong>Class:</strong> ${data.profile.class}</p>
                    <p><strong>School:</strong> ${data.profile.school_name}</p>
                `;

                // Populate results section
                let resultsHtml = '<h3>Results</h3><table class="table table-bordered" width="100%"><tr><th>Level Name</th><th>Product Name</th><th>Status</th><th>Marks</th></tr>';
                data.results.forEach(result => {
                    resultsHtml += `
                        <tr>
                            <td>${result.level_name}</td>
                            <td>${result.product_name}</td>
                            <td>${result.status}</td>
                            <td>${result.marks}</td>
                        </tr>
                    `;
                });
                resultsHtml += '</table>';

                document.getElementById('modal-body').innerHTML = profileHtml + resultsHtml;
            }
        },
        error: function (xhr, status, error) {
            // Handle error
            document.getElementById('modal-body').innerHTML = "<p>Error loading data. Please try again.</p>";
            console.error('Error:', error);
        }
    });
}
</script>

<?php include('footer.php');?>