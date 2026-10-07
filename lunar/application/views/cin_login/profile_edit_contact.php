<?php include('header.php');
 //print_r($class);
?>
<style>
h3{
    font-weight:700;
    color:#006699;
}
    #corner{
        background-color:#ffffb3;
        border-radius:20px;
        margin-left:250px;
        margin-right:250px;
        padding-top:0px;
        /*padding-bottom:20px;*/
        font-size:18px;
        color:#3385ff;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border:solid 1px #006699;
      font-size:15px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
label{
    font-weight:500;
    
}
</style>
<body>
    <!--<h1  style='text-align:center;'>Edit Profile Details</h1>--> 
        <div style='text-align:center;color:#006699;'>
            <h1 style='font-weight:700;'></h1>
        </div>
    <div id='' class="card w-75 mx-auto p-4 my-3">
    
    <form id="studentForm" action="<?php echo base_url();?>cin_login/update_cin_login" method="POST" onsubmit="return handleSubmit(event)">
        <div class='container-fluid' id='corner1'>
            <div class='row'>
			 <?php if(!empty($this->session->flashdata('message'))) { ?>
			<div class="alert alert-success text-center">
			 
						 <h4><?php echo $this->session->flashdata('message');?></h4>
						  
						
			</div>
			 <?php }?>

			
                <div class="col-12 separator">
                    <div class="line"></div>
                         <h4 class="text-center my-4">Student Contact Details</h4>  
                    <!--<div class="line"></div>-->
                </div>
               
               
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Student Name</label>
              <input type='text' class="form-control" value="<?php echo $student[0]['student_name']; ?>" disabled>
               </div>
              <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
               <label class="my-1">Mother Name</label>
                <input type='text' class="form-control" value="<?php echo $student[0]['mother_name']; ?>" name="mother_name" >
              </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Father Name</label>
                
                <input type='text' class="form-control" value="<?php echo $student[0]['father_name']; ?>" name="father_name" >
               </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Student Email</label>
                <input type='email' class="form-control" id="email" value="<?php echo $student[0]['stud_email']; ?>" name="stud_email" >
                <input type="hidden" id="email_verified" name="email_verified" value="0">
               </div>
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                <label class="my-1">Father Email</label>
                 <input type='email' class="form-control" value="<?php echo $student[0]['father_email']; ?>" name="father_email">
                </div>
                
                <div class='col-sm-12 col-md-6 col-lg-6 mb-3'>
                    <label class="my-1">Student Phone</label>
                    <input type='text' class="form-control" value="<?php echo $student[0]['stud_phone']; ?>" name="stud_phone" >
                </div>
             
            </div>
            
           
             
            <div class='row' style='padding-top:50px;padding-bottom:50px;'>
            
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="button" class="btn btn-primary w-25" onclick="handleSubmit()" style='background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                     <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="button" name="back" id="back" class="btn btn-warning w-25" style='background-color:#ff6600;font-size:20px;'> ðŸ‘‰To Profile</button> 
                    </div>
                    <div id='pad' style='color:green;'>
                            <h3><?php 
                            
                            // if(!empty($this->session->flashdata('error'))){
                            // echo $this->session->flashdata('error'); 
                            // }
                            ?></h3>
                    </div>
                </div>
                <div class='col-sm-12 col-md-6 col-lg-4'>
                   
                </div>
            </div>
        </div>
    </form>
</div>


</body>

<div class="modal fade" id="otpModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5>OTP Verification</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
      <div class="modal-body text-center">
           <h6 class="text-center"> Email Verification → OTP sent to Your email ID</h6>
        <input type="text" id="otp" class="form-control mb-2" placeholder="Enter OTP">
        <button onclick="verifyOTP()" class="btn btn-success w-100">Verify</button>
        <div id="msg" class="mt-2"></div>
      </div>

    </div>
  </div>
</div>
<script>
// =======================
// HANDLE SUBMIT
// =======================
function handleSubmit(e) {

    if (e) e.preventDefault();

    const form = document.getElementById("studentForm"); // ✅ correct form
    const email = document.getElementById("email").value.trim();
    const verified = document.getElementById("email_verified").value;

    if (!email) {
        alert("Enter email");
        return false;
    }

    // ✅ already verified → submit
    if (verified === "1") {
        form.submit();
        return true;
    }

    // ❌ not verified → send OTP
    sendOTP();
    return false;
}


// =======================
// SEND OTP
// =======================
function sendOTP() {

    const email = document.getElementById("email").value.trim();

    fetch("https://marrs.in/lunar/Register/sendOtp", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "email=" + encodeURIComponent(email)
    })
    .then(res => res.text())
    .then(res => {

        console.log("SEND OTP:", res);

        if (res.trim() === "sent") {

            let modalEl = document.getElementById("otpModal");
            let modal = new bootstrap.Modal(modalEl);
            modal.show();

        } else {
            alert("OTP not sent: " + res);
        }

    })
    .catch(err => {
        console.log(err);
        alert("Server error while sending OTP");
    });
}


// =======================
// VERIFY OTP
// =======================
function verifyOTP() {

    const otp = document.getElementById("otp").value.trim();
    const msg = document.getElementById("msg");

    if (!otp) {
        msg.innerHTML = "❌ Enter OTP";
        return;
    }

    fetch("https://marrs.in/lunar/Register/verifyOtp", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "otp=" + encodeURIComponent(otp)
    })
    .then(res => res.text())
    .then(res => {

        console.log("VERIFY OTP:", res);

        if (res.trim() === "verified") {

            // ✅ mark verified
            document.getElementById("email_verified").value = "1";

            msg.innerHTML = "✅ Verified";

            // disable email field (optional)
            document.getElementById("email").readOnly = true;

            // close modal
            let modalEl = document.getElementById("otpModal");
            let modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // ✅ submit form safely
            setTimeout(() => {
                document.getElementById("studentForm").submit();
            }, 300);

        } else {
            msg.innerHTML = "❌ Invalid OTP";
        }

    })
    .catch(err => {
        console.log(err);
        msg.innerHTML = "❌ Verification failed";
    });
}

</script>
<?php include("footer.php");?>