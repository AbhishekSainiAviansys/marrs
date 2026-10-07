<?php //include('header.php'); 
// print_r($payments);
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Marrs Enquiry</title>
  <!-- MDB icon -->
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
   <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="<?php echo base_url()?>custom.css" />
	<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<style>
body {
    background-color: #ccebff;
    font-family: 'Roboto', sans-serif;
}
.container {
    margin-top: 20px;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
}
</style>
<?php //echo $this->notifications->display_html();?> 
		
			
			      	
				    <div class="container text-center mt-4">
    <h2><i class="fa fa-question-circle" aria-hidden="true"></i> Enquiries</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <?php //if(isset($message)){echo $message;}?>
        <div class="col-lg-12">
            <form method="POST" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Enquiry Start Date <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" class="form-control" value='<?php if(isset($result['start_date'])){ echo $result['start_date'];} ?>' required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Enquiry End Date <span class="text-danger">*</span></label>
                    <input type="date" name="end_date" class="form-control" value='<?php if(isset($result['end_date'])){ echo $result['end_date'];} ?>' required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="enquiry_type" class="form-control" required>
                        <option value='All'>-- All Type --</option>
                        <option value='1' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==1){?> selected='selected' <?php } ?>>General Enquiry</option>
                        <option value='2' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==2){?> selected='selected' <?php } ?>>Registration/Admit Card Not Active</option>
                        <option value='3' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==3){?> selected='selected' <?php } ?>>Material Not Active</option>
                        <option value='4' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==4){?> selected='selected' <?php } ?>>Orientation Not Active</option>
                        <option value='5' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==5){?> selected='selected' <?php } ?>>Mock Paper Not Active</option>
                        <option value='6' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==6){?> selected='selected' <?php } ?>>Tech Team Support</option>
                        <option value='7' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==7){?> selected='selected' <?php } ?>>Combo Purchase Issue</option>
                    </select>    
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value='All'>-- All Type --</option>
                        <option value='open' <?php if(isset($result['status']) && $result['status']=='Open'){?> selected='selected' <?php } ?>>Open</option>
                        <option value='Close' <?php if(isset($result['status']) && $result['status']=='Close'){?> selected='selected' <?php } ?>>Close</option>
                    </select>    
                </div>
                <div class="col-md-3">
                    <input type="submit" name="submit" value="Search" class="btn btn-primary mt-4">
                </div>
            </form>
        </div>
    </div>
</div>


        <div class="container mb-5 border bg-white">

						<?php if(empty($payments)){?>
					<div class="alert ">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No Enquirys(s) Received.
					</div>
					<?php
					}
					else{
					
					?>
					
					<table id="paymentTable" class="table table-bordered table-striped mt-5">
                        <thead>
                            <tr>
                               <th colspan="9" class='text-success'><?php echo $message; ?></th> 
                            </tr>
                            <tr>
                                <th>Sr. No</th>
                                <th>Student Name</th>
                                <th>CIN</th>
                                <th>Enquiry Type</th>
                                <th>Enquiry</th>
                                <th>Documentation</th>
                                <th>Status/Date</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        
                                $i = 1;
                                foreach ($payments as $value) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value['student_name']; ?></td>
                                    <td><?php echo $value['cin']; ?></td>
                                    <td><?php echo $value['enquiry_name']; ?></td>
                                    <td><?php echo $value['enquiry']; ?></td>
                                    <td>
                                        <?php if(!empty($value['evidence'])){?>
                                        <img src="https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence'];?>" style='height:200px;width:150px;'>
                                        <br>
                                        <a href='https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence'];?>' target="_BLANK" class='btn btn-primary'>View</a>
                                        <?php }else{ ?>
                                        No Documentation
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $value['status']; ?><br><?php echo $value['date']; ?></td>
                                    <td>
                                        
                                       
                                        <?php if($value['status']=='Open'){?>
                                            <button type="button" class="btn btn-warning mt-2 open-reply-modal" 
                                                data-enquiry-id="<?php echo $value['enquiry_id']; ?>" 
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Close
                                            </button>
                                        <?php } else { ?>
                                            Closed
                                        <?php } ?>


                                        <?php //if($value['status']=='Open'){?>
                                        <!--<form method="POST">-->
                                            <!--<input type='hidden' name='enquiry_id' value='<?php echo $value['enquiry_id']; ?>' >-->
                                            <!--<input type='text' name='reply' placeholder='Enter Reply' class="form-control" required>-->
                                            <!--<input type='submit' name='status' class='btn btn-warning mt-2' value="Close" >-->
                                            <!--<input type='submit' name='status' class='btn btn-warning mt-2' value="Close" data-bs-toggle="modal" data-bs-target="#exampleModal">-->
                                            <!--<input type='submit' name='status' class='btn btn-warning mt-2' value="Close" data-bs-toggle="modal" data-bs-target="#exampleModal">-->

                                        <!--</form>-->
                                        <?php //}else{ ?>
                                            <!--Closed-->
                                        <?php //} ?>
                                    </td>
                                   
                                </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                                
                            </tbody>
                        </table>

					  
					  
					  
					  <?php } ?>
				
					
					
					</div>
				
			
			
		
<?php //include('footer.php'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Your Reply</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="replyForm" enctype="multipart/form-data">
          <input type="hidden" name="enquiry_id" id="enquiry_id" />
          <div class="mb-3">
            <label for="replyText" class="form-label">Your Reply</label>
            <input type="text" class="form-control" id="replyText" name="replyText" required>
          </div>
          <div class="mb-3">
            <label for="replyFile" class="form-label">Upload File</label>
            <input type="file" class="form-control" id="replyFile" name="replyFile">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
       $(document).ready(function() {
    $('#paymentTable').DataTable({
        "pageLength": 10
    });

    // Initialize date pickers
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});



$(document).ready(function () {
    // Open modal and populate hidden field with enquiry ID
    $('.open-reply-modal').click(function () {
        var enquiryId = $(this).data('enquiry-id');
        $('#exampleModal').find('input[name="enquiry_id"]').val(enquiryId);
    });

    // AJAX form submission
    $('#replyForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'https://marrs.in/student_registration/Log/submit_reply',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === '1') {
                    toastr.success('Reply submitted successfully!');
                    $('#exampleModal').modal('hide');
                    location.reload(); 
                } else {
                    toastr.error('An error occurred while submitting the reply.');
                }
            },
            error: function () {
                toastr.error('An error occurred while submitting the reply.');
            }
        });
    });
});
    </script>
    <!-- Include Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Include FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php 
	$this->confirmation->confirm('delete');
?>