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
  background-color: #f5f7fb;
  background-image: radial-gradient(#e0e3e8 1px, transparent 1px);
  background-size: 20px 20px;
  height: 100vh;
}

/* Main Card */
.main-card {
  width: 900px;
  height: 600px;
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  background: rgba(255,255,255,0.95);
  box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

/* LEFT SIDE */
.left-box {
  width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-wrapper {
  width: 80%;
}

/* RIGHT SIDE */
.right-box {
  width: 50%;
}

.right-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.form-wrapper h4 {
  font-size: 26px;
  font-weight: 700;
  letter-spacing: 1px;
  text-align: center;
  margin-bottom: 8px;
  /* Gradient Text 🔥 */
  background: linear-gradient(135deg, #fc6b25, #cbaf11);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

  /* Smooth appearance */
  transition: all 0.3s ease;
}

/* Subheading (year text) */
.form-wrapper h6 {
  font-size: 15px;
  font-weight:600;
  letter-spacing: 0.5px;
  color: #777;
  text-align: center;
  margin-bottom: 20px;
}
/* Input group styling */
.input-group-text {
  background: #fff;
  border-radius: 12px 0 0 12px;
  border: 1px solid #ddd;
  border-right: none;
  color:#e28748;
}

.input-group .form-control {
  border-radius: 0 12px 12px 0;
}

/* Focus effect */
.input-group:focus-within {
  box-shadow: 0 0 10px rgba(37,117,252,0.2);
  border-radius: 12px;
}

/* INPUT FIELD */
.form-control {
  border-radius: 12px;
  padding: 12px;
  border: 1px solid #ddd;
  transition: all 0.3s ease;
}

/* INPUT FOCUS EFFECT */
.form-control:focus {
  border-color: #2575fc;
  box-shadow: 0 0 10px rgba(37,117,252,0.2);
  transform: scale(1.02);
}

/* BUTTON */
.btn-main {
  border-radius: 30px;
  padding: 12px;
  font-weight: 600;
  background: linear-gradient(135deg, #e7ae51, #d73333);
  color: white;
  border: none;
  transition: all 0.3s ease;
}

/* BUTTON HOVER ðŸ”¥ */
.btn-main:hover {
  background: linear-gradient(135deg, #2595fc, #2d87e9);
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(37,117,252,0.3);
  color:white;
}

/* BUTTON CLICK EFFECT */
.btn-main:active {
  transform: scale(0.97);
}

/* RESEND BUTTON */
#resend button {
  transition: all 0.3s ease;
}

/* RESEND HOVER */
/*#resend button:hover {*/
/*  background-color: orange;*/
/*  color: #fff;*/
/*  border-color: #2575fc;*/
/*}*/

/* small text */
.small-text {
  font-size: 13px;
  color: #777;
}
/* Academic Year Badge */
.year-badge {
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: #888;
}

.year-badge strong {
  display: inline-block;
  margin-top: 5px;
  font-size: 20px;
  font-weight: 600;
  padding: 5px 10px;
  border-radius: 20px;

  /* Gradient Badge 🔥 */
  background: linear-gradient(135deg, #ff7e5f, #feb47b);
  color: white;

  /* Soft shadow */
  box-shadow: 0 5px 15px rgba(255, 126, 95, 0.4);

  transition: all 0.3s ease;
}

/* Hover effect */
.year-badge strong:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 10px 25px rgba(255, 126, 95, 0.6);
}
.shadow-pulse {
  padding: 12px 24px;
  font-size: 16px;
  background-color: #6200ee;
  color: white;
  border: none; /* No border, just the shadow pulse */
  border-radius: 8px;
  cursor: pointer;
  outline: none;
  
  /* Applying the animation */
  animation: pulse-shadow 2s infinite;
}

@keyframes pulse-shadow {
  0% {
    box-shadow: 0 0 0 0px rgba(98, 0, 238, 0.7);
  }
  70% {
    /* The shadow "grows" and fades out */
    box-shadow: 0 0 0 15px rgba(98, 0, 238, 0);
  }
  100% {
    box-shadow: 0 0 0 0px rgba(98, 0, 238, 0);
  }
}

/* Optional: Pause animation on hover for better UX */
.shadow-pulse:hover {
  animation-play-state: paused;
  background-color: #5600d1;
}
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="main-card">

  
  <!-- RIGHT SIDE -->
  <div class="right-box">
    <img src="<?php echo base_url();?>images/student.jpg" alt="">
  </div>
  <!-- LEFT SIDE -->
  <div class="left-box">
    <div class="form-wrapper">
        <div class="text-center mb-3"><img src="<?php echo base_url();?>images/marrs_discover_logo.png" alt="" width="200px"></div>

      <h4 class="fw-bold mb-2 text-center my-2">STUDENT REGISTRATION</h4>
      <h5 class="fw-bold mb-2 text-center text-danger">School Level</h5>
        <h6 class="year-badge text-center mb-4 my-2">
          <span class="text-lg">Current Session</span><br><br>
          <strong class="shadow-pulse">
            <?php 
              $year = date('Y');
              echo $year . "-" . date('y', strtotime('+1 year'));            ?>
          </strong>
        </h6>
      <!-- STATUS MESSAGE (UNCHANGED PHP) -->
      <?php if(isset($status)): ?>
        <div class="text-center mb-2">
          <?php if($status === 'success'): ?>
            <p class="text-success"><?php echo $message; ?></p>
          <?php else: ?>
            <p class="text-danger"><?php echo $message; ?></p>
          <?php endif; ?>
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
            placeholder="Enter e-mail for registration"
            value="<?php echo $email; ?>">
        </div>

        <!-- OTP FIELD (ONLY WHEN EMAIL EXISTS) -->
        <?php if(!empty($email)){ ?>
          <input type="password" name="otp" 
            class="form-control mb-3" 
            placeholder="Enter OTP">
        <?php } ?>

        <!-- OTP ERROR -->
        <?php if(!empty($this->session->flashdata('otperror'))){ ?>
          <div class="text-danger text-center mb-2">
            <?php echo $this->session->flashdata('otperror'); ?>
          </div>
        <?php } ?>

        <!-- RESEND BUTTON -->
        <div id="resend" class="mb-3 text-center">
          <button type="submit" name="otp" class="btn btn-outline-success btn-sm">
            Resend OTP
          </button>
        </div>

        <!-- SUBMIT -->
        <button type="submit" name="submit" value="submit" class="btn btn-main w-100 my-2">
          Register Now
        </button>

      </form>

    </div>
  </div>


</div>

</div>

<!-- RESEND TIMER (UNCHANGED LOGIC) -->
<script>
document.getElementById('resend').style.display = 'none';
setTimeout(function() {
  document.getElementById('resend').style.display = 'block';
}, 60000);
</script>

</body>
</html>