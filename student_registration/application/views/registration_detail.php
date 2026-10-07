<?php include("headernew.php"); ?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--  <meta charset="utf-8">-->
<!--  <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--  <title>MaRRS Intellectual Services – Student Registration</title>-->
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
  <style>
    /**, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }*/
    /*html { font-size: 62.5%; }*/
    /*body { font-family: 'Lora', 'Georgia', serif; font-size: 1.5rem; background: #f0f4f8; color: #1a1a2e; }*/

    /* ── Top header banner ── */
    /*.site-header { background: #1a3a6e; padding: 0; }*/
    /*.site-header img { width: 100%; display: block; max-height: 180px; object-fit: cover; }*/

    /* ── Nav bar ── */
    /*.main-nav {*/
    /*  background: linear-gradient(to bottom, #0a3e6e, #033359);*/
    /*  padding: 0 2rem;*/
    /*}*/
    /*.main-nav .navbar { margin-bottom: 0; border: none; background: transparent; min-height: 54px; }*/
    /*.main-nav .navbar-brand { color: #fff; font-size: 1.6rem; font-weight: 700; padding: 15px 0; }*/
    /*.main-nav .navbar-nav > li > a {*/
    /*  color: #fff; font-size: 1.4rem; font-weight: 600; padding: 18px 20px;*/
    /*}*/
    /*.main-nav .navbar-nav > li > a:hover { background: rgba(255,255,255,0.1); color: #ffcc00; }*/
    /*.main-nav .dropdown-menu { background: #fff; border-top: 3px solid #ffcc00; border-radius: 0 0 6px 6px; }*/
    /*.main-nav .dropdown-menu > li > a { color: #1a3a6e; font-size: 1.3rem; padding: 8px 20px; }*/
    /*.main-nav .dropdown-menu > li > a:hover { background: #f0f4f8; color: #ff6600; }*/
    /*.main-nav .navbar-toggle { border-color: rgba(255,255,255,0.4); margin-top: 10px; }*/
    /*.main-nav .navbar-toggle .icon-bar { background: #fff; }*/

    /* ── Flash message ── */
    .flash-msg {
      background: #2e7d32; color: #fff; text-align: center;
      padding: 12px 20px; font-size: 1.5rem; font-weight: 600;
    }

    /* ── Page wrapper ── */
    .page-wrapper { max-width: 1024px; margin: 3rem auto; padding: 0 1.5rem 4rem; }

    /* ── Form card ── */
    .form-card {
      background: #fff; border-radius: 12px;
      box-shadow: 0 2px 16px rgba(26,58,110,0.08);
      overflow: hidden;
    }
    .form-card-header {
      background: linear-gradient(135deg, #1a3a6e 0%, #033359 100%);
      padding: 2.4rem 3rem;
      display: flex; align-items: center; gap: 1.6rem;
    }
    .form-card-icon {
      width: 52px; height: 52px; border-radius: 50%;
      background: rgba(255,204,0,0.2); border: 2px solid rgba(255,204,0,0.5);
      display: flex; align-items: center; justify-content: center;
      font-size: 2.2rem; color: #ffcc00;
    }
    .form-card-title { color: #fff; font-size: 2.2rem; font-weight: 700; margin: 0; }
    .form-card-sub { color: rgba(255,255,255,0.65); font-size: 1.3rem; margin-top: 3px; }
    .form-card-body { padding: 2.8rem 3rem; }

    /* ── Section headings ── */
    .section-divider {
      display: flex; align-items: center; gap: 1rem;
      margin: 2.4rem 0 1.6rem;
    }
    .section-divider:first-child { margin-top: 0; }
    .section-divider .line { flex: 1; height: 1px; background: #e2e8f0; }
    .section-divider h4 {
      font-size: 1.2rem; font-weight: 700; letter-spacing: 1px;
      text-transform: uppercase; color: #1a3a6e;
      white-space: nowrap; display: flex; align-items: center; gap: 6px;
    }
    .section-divider h4 .fa { color: #ff6600; font-size: 1.3rem; }

    /* ── Form fields ── */
    .form-group { margin-bottom: 1.8rem; }
    .form-group label {
      display: block; font-size: 1rem; font-weight: 600;
      color: #4a5568; margin-bottom: 6px;
    }
    .form-group label .req { color: #e53e3e; margin-left: 3px; }
    .form-group .form-control {
      height: 42px; border: 1.5px solid #cbd5e0; border-radius: 8px;
      font-size: 1rem; color: #1a1a2e; background: #f7fafc;
      padding: 0 14px; transition: border-color 0.2s, box-shadow 0.2s;
      width: 100%;
    }
    .form-group .form-control:focus {
      border-color: #1a3a6e; background: #fff;
      box-shadow: 0 0 0 3px rgba(26,58,110,0.12); outline: none;
    }

    /* ── Submit button ── */
    .btn-submit {
      background: #ff6600; color: #fff; border: none;
      border-radius: 8px; padding: 1rem;
      font-size: 1rem; font-weight: 600; letter-spacing: 0.5px;
      cursor: pointer; display: inline-flex; align-items: center;
      gap: 8px; transition: background 0.2s, transform 0.1s;text-transform: uppercase;
    }
    .btn-submit:hover { background: #e05500; color: #fff; }
    .btn-submit:active { transform: scale(0.98); }
    .btn-submit .fa { font-size: 1.5rem; }
    .submit-row { text-align: center; margin-top: 2.8rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; }

    /* ── Footer ── */
    .site-footer {
      background: #1a3a6e; color: rgba(255,255,255,0.75);
      text-align: center; padding: 1.8rem 1rem; font-size: 1.2rem; margin-top: 0;
    }
    .site-footer a { color: #ffcc00; text-decoration: none; }
    .site-footer a:hover { text-decoration: underline; }

    /* ── Responsive ── */
    @media (max-width: 767px) {
      .page-wrapper { margin: 1.5rem auto; padding: 0 1rem 3rem; }
      .form-card-body { padding: 2rem 1.8rem; }
      .form-card-header { padding: 1.8rem 2rem; }
    }
 .otp-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.otp-wrapper .form-control {
  padding-right: 110px;
}

/* Verify button */
.verify-btn {
  position: absolute;
  right: 5px;
  height: 32px;
  padding: 0 10px;
  font-size: 12px;
  border-radius: 6px;
  border: none;
  background: #1a3a6e;
  color: #fff;
  cursor: pointer;
}

.verify-btn:hover {
  background: #0f2c55;
}

/* Verified badge */
.verified-badge {
  position: absolute;
  right: 8px;
  background: #e6f9ec;
  color: #1b8a3e;
  font-size: 12px;
  padding: 3px 8px;
  border-radius: 12px;
  display: none;
}

.verified-badge.active {
  display: inline-block;
}

/* MOBILE FIX */
@media (max-width: 576px) {
  .otp-wrapper .form-control {
    padding-right: 90px;
  }

  .verify-btn {
    font-size: 11px;
    padding: 0 8px;
  }

  .verified-badge {
    font-size: 11px;
    padding: 2px 6px;
  }
}
  </style>
<!--</head>-->
<!--<body>-->



<!-- ══ Navigation ══ -->
<!--<div class="main-nav">-->
<!--  <nav class="navbar navbar-default">-->
<!--    <div class="container-fluid">-->
<!--      <div class="navbar-header">-->
<!--        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav-collapse">-->
<!--          <span class="sr-only">Toggle navigation</span>-->
<!--          <span class="icon-bar"></span>-->
<!--          <span class="icon-bar"></span>-->
<!--          <span class="icon-bar"></span>-->
<!--        </button>-->
<!--        <a class="navbar-brand" href="https://marrs.in/">MaRRS</a>-->
<!--      </div>-->
<!--      <div class="collapse navbar-collapse" id="main-nav-collapse">-->
<!--        <ul class="nav navbar-nav navbar-right">-->
<!--          <li><a href="https://marrs.in/">Home</a></li>-->
<!--          <li class="dropdown">-->
<!--            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">-->
<!--              Learning programs <span class="caret"></span>-->
<!--            </a>-->
<!--            <ul class="dropdown-menu">-->
<!--              <li><a href="https://marrs.in/all_programs.php">All programs</a></li>-->
<!--              <li class="divider"></li>-->
<!--              <li><a href="https://marrs.in/kinder.php">Kindergarten programs</a></li>-->
<!--              <li class="divider"></li>-->
<!--              <li><a href="https://marrs.in/1_8.php">Class 1–8 programs</a></li>-->
<!--              <li class="divider"></li>-->
<!--              <li><a href="https://marrs.in/8_12.php">Class 8–12 programs</a></li>-->
<!--            </ul>-->
<!--          </li>-->
<!--          <li><a href="<?php echo base_url();?>welcome/logout2">Logout</a></li>-->
<!--        </ul>-->
<!--      </div>-->
<!--    </div>-->
<!--  </nav>-->
<!--</div>-->

<!-- ══ Flash message ══ -->
<?php if(!empty($this->session->flashdata('msg'))): ?>
<div class="flash-msg"><?php echo $this->session->flashdata('msg'); ?></div>
<?php endif; ?>

<!-- ══ Page body ══ -->
<div class="page-wrapper">
  <div class="form-card">

    <!-- Card header -->
    <div class="form-card-header">
      <div class="form-card-icon"><i class="fa fa-user-plus"></i></div>
      <div>
        <div class="form-card-title">Student Registration</div>
        <div class="form-card-sub">Academic Year 2023/24 — fill in all required fields</div>
      </div>
    </div>

    <!-- Card body -->
    <div class="form-card-body">
      <form id="registrationForm" action="<?php echo base_url();?>welcome/offer" method="POST">

        <!-- Hidden fields -->
        <input type="hidden" name="state"   value="<?php echo $_SESSION['post']['state']; ?>">
        <input type="hidden" name="country" value="105">
        <?php if(!empty($_SESSION['product_id'])): ?>
          <input type="hidden" name="product_id"   value="<?php echo $_SESSION['product_id']; ?>">
          <input type="hidden" name="franchise_id" value="<?php echo $_SESSION['franchise_id']; ?>">
        <?php endif; ?>

        <!-- ── Student details ── -->
        <div class="section-divider">
          <div class="line"></div>
          <h4><i class="fa fa-user"></i> Student details</h4>
          <div class="line"></div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>First name <span class="req">*</span></label>
              <input type="text" class="form-control" name="first_name"
                     value="<?php echo htmlspecialchars($_SESSION['post']['first_name']); ?>"
                     placeholder="First name" required>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Middle name</label>
              <input type="text" class="form-control" name="middle_name"
                     value="<?php echo htmlspecialchars($_SESSION['post']['middle_name']); ?>"
                     placeholder="Middle name (optional)">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Last name <span class="req">*</span></label>
              <input type="text" class="form-control" name="last_name"
                     value="<?php echo htmlspecialchars($_SESSION['post']['last_name']); ?>"
                     placeholder="Last name" required>
            </div>
          </div>
        </div>

        <!-- ── Personal details ── -->
        <div class="section-divider">
          <div class="line"></div>
          <h4><i class="fa fa-id-card"></i> Personal details</h4>
          <div class="line"></div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Grade <span class="req">*</span></label>
              <select class="form-control" name="class" required>
                <option value="">Select grade</option>
                <?php
                  $class = $this->db->get_where('class')->result_array();
                  foreach($class as $value): ?>
                  <option value="<?php echo $value['class_id']; ?>"
                    <?php if($value['class_id'] == $_SESSION['post']['class']) echo 'selected'; ?>>
                    <?php echo $value['class_name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Gender <span class="req">*</span></label>
              <select class="form-control" name="gender" required>
                <option value="">Select gender</option>
                <option value="male"   <?php if($_SESSION['post']['gender']=='male')   echo 'selected'; ?>>Male</option>
                <option value="female" <?php if($_SESSION['post']['gender']=='female') echo 'selected'; ?>>Female</option>
              </select>
            </div>
          </div>
        </div>

        <!-- ── Guardian details ── -->
        <div class="section-divider">
          <div class="line"></div>
          <h4><i class="fa fa-users"></i> Guardian details</h4>
          <div class="line"></div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Father's name <span class="req">*</span></label>
              <input type="text" class="form-control" name="father_name"
                     value="<?php echo htmlspecialchars($_SESSION['post']['father_name']); ?>"
                     placeholder="Father's full name" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Mother's name <span class="req">*</span></label>
              <input type="text" class="form-control" name="mother_name"
                     value="<?php echo htmlspecialchars($_SESSION['post']['mother_name']); ?>"
                     placeholder="Mother's full name" required>
            </div>
          </div>
        </div>

        <!-- ── Contact details ── -->
        <div class="section-divider">
          <div class="line"></div>
          <h4><i class="fa fa-phone"></i> Contact details</h4>
          <div class="line"></div>
        </div>

        <div class="row">
          <!--<div class="col-sm-4">-->
          <!--  <div class="form-group">-->
          <!--    <label>Mobile number <span class="req">*</span></label>-->
          <!--    <input type="number" class="form-control" name="mobile"-->
          <!--           value="<?php echo htmlspecialchars($_SESSION['post']['mobile']); ?>"-->
          <!--           placeholder="10-digit mobile" required>-->
          <!--  </div>-->
          <!--</div>-->
          <!--<div class="col-sm-4">-->
          <!--  <div class="form-group">-->
          <!--    <label>WhatsApp number</label>-->
          <!--    <input type="number" class="form-control" name="whatsapp"-->
          <!--           value="<?php echo htmlspecialchars($_SESSION['post']['whatsapp']); ?>"-->
          <!--           placeholder="If different from mobile">-->
          <!--  </div>-->
          <!--</div>-->
          <!--<div class="col-sm-4">-->
          <!--  <div class="form-group">-->
          <!--    <label>Email address <span class="req">*</span></label>-->
          <!--    <input type="email" class="form-control" name="email"-->
          <!--           value="<?php echo htmlspecialchars($_SESSION['email']); ?>"-->
          <!--           placeholder="email@example.com" required>-->
          <!--  </div>-->
          <!--</div>-->
  <!-- Mobile -->
<div class="col-sm-4 col-12">
  <div class="form-group">
    <label>Mobile Number *</label>

    <div class="otp-wrapper">
      <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required>

      <button type="button" class="verify-btn" onclick="sendOtp('mobile')">
        Verify
      </button>

      <span id="mobileTick" class="verified-badge">✔ Verified</span>
    </div>
  </div>
</div>

<!-- WhatsApp -->
<div class="col-sm-4 col-12">
  <div class="form-group">
    <label>WhatsApp Number</label>

    <div class="otp-wrapper">
      <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Optional">

      <button type="button" class="verify-btn" onclick="sendOtp('whatsapp')">
        Verify
      </button>

      <span id="whatsappTick" class="verified-badge">✔ Verified</span>
    </div>
  </div>
</div>

<!-- Email -->
<div class="col-sm-4 col-12">
  <div class="form-group">
    <label>Email *</label>

    <div class="otp-wrapper">
     <input type="email" class="form-control"
       name="email"
       value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly>
      <span class="verified-badge active">✔ Verified</span>
    </div>
  </div>
</div>
        </div>

        <!-- ── Submit ── -->
        <div class="submit-row">
          <button type="submit" name="submit" class="btn-submit" disabled>
            <i class="fa fa-paper-plane"></i> Submit registration
          </button>
        </div>

      </form>
    </div><!-- /form-card-body -->
  </div><!-- /form-card -->
</div><!-- /page-wrapper -->
<div id="otpModal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4 text-center">
      <h5>Enter OTP</h5>
      <input type="text" id="otpInput" class="form-control mb-3" placeholder="Enter OTP">
      <button class="btn btn-success" onclick="verifyOtp()">Verify OTP</button>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let currentField = "";
let verified = {
  mobile: false,
  whatsapp: false,
  email: true
};

function sendOtp(type) {
  currentField = type;

  let value = document.getElementById(type).value;

  if (value.trim() === "") {
    alert("Enter " + type + " first");
    return;
  }

  fetch("<?= base_url('welcome/generateOtp') ?>", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      type: type,
      value: value
    })
  })
  .then(res => res.json())
  .then(data => {

    if (data.status === "success") {
      document.getElementById("otpInput").value = "";
      $("#otpModal").modal("show");
    } else {
      alert(data.message || "OTP send failed");
    }

  })
  .catch(err => {
    console.error(err);
    alert("Server error while sending OTP");
  });
}


function verifyOtp() {
  let otp = document.getElementById("otpInput").value;

  if (otp.trim() === "") {
    alert("Enter OTP");
    return;
  }

  fetch("<?= base_url('welcome/checkOtp') ?>", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      type: currentField,
      otp: otp
    })
  })
  .then(res => res.json())
  .then(data => {

    if (data.status === "success") {

      verified[currentField] = true;

      document.getElementById(currentField).readOnly = true;
      document.getElementById(currentField + "Tick").classList.add("active");

      $("#otpModal").modal("hide");

      checkAllVerified();

    } else if (data.status === "expired") {
      alert("OTP expired. Please resend.");
    } else {
      alert("Invalid OTP");
    }

  })
  .catch(err => {
    console.error(err);
    alert("Server error while verifying OTP");
  });
}


function checkAllVerified(){
  // Only mobile required now
  if(verified.mobile){
    document.querySelector(".btn-submit").disabled = false;
  }
}


// Reset OTP input when modal opens
$("#otpModal").on('show.bs.modal', function () {
  document.getElementById("otpInput").value = "";
});
</script>
<?php include("footernew.php"); ?>