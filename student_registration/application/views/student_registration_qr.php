<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Marrs Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #11cb76a1, #25a7fc00);
  height: 100vh;
}

.main-card {
  width: 900px;
  height: 600px;
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  background: rgba(255,255,255,0.95);
  box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

.left-box, .right-box {
  width: 50%;
}

.left-box {
  display: flex;
  justify-content: center;
  align-items: center;
}

.right-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.form-wrapper {
  width: 80%;
}

.form-control {
  border-radius: 12px;
  padding: 12px;
}

.btn-main {
  border-radius: 30px;
  padding: 12px;
  background: linear-gradient(135deg, #e7ae51, #d73333);
  color: white;
  border: none;
}

.btn-main:hover {
  background: linear-gradient(135deg, #2595fc, #2d87e9);
}

.input-group-text {
  background: #fff;
  border-radius: 12px 0 0 12px;
}

.year-badge strong {
  background: linear-gradient(135deg, #ff7e5f, #feb47b);
  color: white;
  padding: 5px 10px;
  border-radius: 20px;
}

</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
<div class="main-card">

<!-- RIGHT -->
<div class="right-box">
  <img src="<?php echo base_url();?>images/student.jpg">
</div>

<!-- LEFT -->
<div class="left-box">
<div class="form-wrapper">

<div class="text-center mb-3">
  <img src="<?php echo base_url();?>images/marrs_discover_logo.png" width="200">
</div>

<h4 class="text-center fw-bold">STUDENT REGISTRATION</h4>
<h5 class="text-center text-danger">School Level</h5>

<h6 class="year-badge text-center mb-4 my-2">
  Current Session <br><br>
  <strong>
    <?php 
      $year = date('Y');
      echo $year . "-" . date('y', strtotime('+1 year'));
    ?>
  </strong>
</h6>

<!-- STATUS MESSAGE -->
<?php if(isset($status)): ?>
  <div class="text-center mb-2">
    <p class="<?php echo ($status=='success')?'text-success':'text-danger'; ?>">
      <?php echo $message; ?>
    </p>
  </div>
<?php endif; ?>

<form method="post">

<!-- EMAIL -->
<div class="input-group mb-3">
  <span class="input-group-text">
    <i class="fa-solid fa-envelope"></i>
  </span>
  <input 
    type="email" 
    name="email" 
    class="form-control"
    required
    placeholder="Enter e-mail"
    value="<?php echo isset($email)?$email:''; ?>">
</div>

<!-- OTP FIELD -->
<?php if(!empty($email)): ?>
  <input type="text" name="otp" class="form-control mb-3" placeholder="Enter OTP">
<?php endif; ?>

<!-- OTP ERROR -->
<?php if($this->session->flashdata('otperror')): ?>
  <div class="text-danger text-center mb-2">
    <?php echo $this->session->flashdata('otperror'); ?>
  </div>
<?php endif; ?>

<!-- RESEND BUTTON -->
<div id="resend" class="text-center mb-3" style="display:none;">
  <button type="submit" name="resend" class="btn btn-outline-success btn-sm">
    Resend OTP
  </button>
</div>

<!-- SUBMIT -->
<button type="submit" class="btn btn-main w-100">
  Register Now
</button>
<div class="mt-2 text-center">
    <small>
        <span class="text-primary">
            Didn't receive the OTP?
        </span>
        <span class="text-muted">
            Check your <strong>Spam/Junk</strong> folder.
        </span>
    </small>
</div>
</form>

</div>
</div>

</div>
</div>

<!-- RESEND TIMER -->
<script>
<?php if(!empty($email)): ?>
  setTimeout(function() {
    document.getElementById('resend').style.display = 'block';
  }, 60000);
<?php endif; ?>
</script>

</body>
</html>