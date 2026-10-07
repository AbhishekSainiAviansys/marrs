<?php include('header.php');

$state_id=$activate[0];
//print_r($material_free);
//print_r($material_paid);
// print_r($result);
//  echo 'ok';

//   echo $combo1.'ko';
//   echo $combo2.'pkk';
//   echo $combo3.'jj';
//   echo $combo4.'hi';
   
   $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$result['medal_no']+1,'product_name' =>$result['product_name']))->row();
		$nlev=$res->level_name;$level_id=$res->level_id;
//print_r($res);

?>
 <style>
 #productWrapper h4{
     font-size:18px;
 }
      #certificateWrapper h1 {
        font-size: 70px;
        font-family: Snell Roundhand, cursive;
        font-weight: 500;
        color: #ffffff;
      }
      .sign {
        position: absolute;
        bottom: 0;
        padding: 5% 5% 0% 5%;
        right: 0;
        font-weight: 700;
        color: #676b6d;
      }
      #certificateWrapper th {
        white-space: nowrap;
        font-size: 12px;
        font-weight: 700;
        color: #707475;
      }
      #certificateWrapper td {
        font-size: 15px;
        font-weight: 700;
        color: #676b6d;
        white-space: nowrap;

      }
      .partcip-detail b {
        color: #5c5d60;
      }
      #certificateWrapper {
        align-items: center;
        min-height: 100vh;
      }
      #certificateWrapper .card {
        background-image: url("../images/bg.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: none;
      }
      #certificateWrapper .card .card-body {
        border: 4px solid #f8c913;
      }
	 
	 
	.custom-alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            z-index: 1000;
            font-family: Arial, sans-serif;
        }

        .custom-alert p {
            margin: 0;
        }

        /* Style for overlay (to make it look like a modal) */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        } 
	 
    </style>

    
    <section style='padding-bottom:0px;'>
        <a href="https://marrs.in/lunar/Cin_login/index" class="btn btn-outline-warning mt-2 mb-2 mx-2"> << Back</a>
        
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <form method="POST" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-3">
                    <label class="form-label">Upload Documentation</label><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="text" name="email" id="fileToUpload" class="form-control bg-light" value='<?php echo $student->stud_email; ?>' required readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Mobile<span class="text-danger">*</span></label>
                    <input type="text" name="mobile" id="fileToUpload" class="form-control bg-light" value='<?php echo $student->stud_phone; ?>' required readonly>
                </div>
                
                <div class="col-md-3">
                    <label class="form-label">Type <span class="text-danger">*</span></label>
                    <select name="enquiry_type" class="form-control" required>
                        <option value=''>-- select type -- 👇</option>
                        <option value='1' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==1){?> selected='selected' <?php } ?>>General Enquiry</option>
                        <option value='2' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==2){?> selected='selected' <?php } ?>>Registration/Admit Card Not Active</option>
                        <option value='3' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==3){?> selected='selected' <?php } ?>>Material Not Active</option>
                        <option value='4' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==4){?> selected='selected' <?php } ?>>Orientation Not Active</option>
                        <option value='5' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==5){?> selected='selected' <?php } ?>>Mock Paper Not Active</option>
                        <option value='6' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==6){?> selected='selected' <?php } ?>>Tech Team Support</option>
                        <option value='7' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==7){?> selected='selected' <?php } ?>>Combo Purchase Issue</option>
                    </select>    
                </div>
                
                </div>
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <label class="form-label">Type Query <span class="text-danger">*</span></label>
                        <input type='text' name='enquiry' class='form-control' required> 
                    </div>
                    <div class="col-md-4">
                        <input type="submit" name="submit" value="Raise Ticket" class="btn btn-primary mt-4">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                
    </section>
    
    <div class="overlay" id="overlay"></div>
    <div class="custom-alert" id="custom-alert">
        <h5 id="alert-message" style='color:#4d79ff;'></h5>
    </div>
                        
    
    
    <div class="container mb-5 border bg-white">

						<?php if(empty($payments)){?>
					<div class="alert ">
						  <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
						  <strong>Information!</strong> No Enquirys(s) Found.
					</div>
					<?php
					}
					else{
					
					?>
					
					<table id="paymentTable" class="table table-bordered table-striped mt-2">
                        <thead>
                            <tr>
                               <th colspan="9" class='text-success'><?php echo $message; ?></th> 
                            </tr>
                            <tr>
                                <th>Sr. No</th>
                                <th>Student Name</th>
                                <th>Token Id</th>
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
                                    <td><?php echo $value['ticket_number']; ?></td>
                                    <td><?php echo $value['cin']; ?></td>
                                    <td><?php echo $value['enquiry_name']; ?></td>
                                    <td><?php echo $value['enquiry']; ?></td>
                                    <td>
                                        <?php if(!empty($value['evidence'])){?>
                                        <img src="https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence'];?>" style='height:200px;width:150px;'>
                                        <?php }else{ ?>
                                        No Documentation
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $value['status']; ?><br><?php echo $value['date']; ?></td>
                                    <td>
                                        <?php if($value['status']=='Open'){?>
                                            <form method='POST'>
                                                <button type='submit' class='btn btn-danger btn-sm' name='delete' value='<?php echo $value['enquiry_id']; ?>' >Delete</button>
                                            </form>
                                        <?php }else{ ?>
                                            Resolved
                                        <?php } ?>
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

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
<script>
function misb(id) {
    
  var amount = id;
   //alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>net_abc___",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
            showAlert(response);
            location.reload();
       
        }
});
 }
 
 function remove_misb(id) {
    
  var amount = id;
  // alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>cart_remove___",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
        showAlert(response);
        location.reload();
        }
});
 }
 

</script>

    <script>
            function showAlert(message) {
                // Display overlay
                document.getElementById('overlay').style.display = 'block';
                var alertDiv = document.getElementById('custom-alert');
                alertDiv.style.display = 'block';
                alertDiv.style.transition = '0.5s';
            
                // Display message
                var alertMessage = document.getElementById('alert-message');
                alertMessage.textContent = message;
                setTimeout(function () {
                    closeAlert();
                }, 9000);
            }

        function closeAlert() {
            // Hide overlay
            document.getElementById('overlay').style.display = 'none';
        
            // Hide alert
            var alertDiv = document.getElementById('custom-alert');
            alertDiv.style.display = 'none';
        }

      
    </script>
  
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $(".add1").click(function() {
            $(".add2").css("display", "none");
        });
    });
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script>
$(document).ready(function(){
	$('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});


</script>
<?php include("footer.php");?>