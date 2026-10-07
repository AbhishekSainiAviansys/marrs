<?php 
// Assuming $schedule object has data.
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Zoomzoom Student Registration - OTP Verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }
    
    .registration-card {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 480px;
      width: 100%;
      animation: slideIn 0.5s ease-out;
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .product-info {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .product-info h4 {
      color: #667eea;
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 20px;
    }
    
    .student-gif {
      width: 140px;
      height: auto;
      border-radius: 15px;
      margin: 20px auto;
      display: block;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .info-badge {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 8px 16px;
      border-radius: 20px;
      display: inline-block;
      margin: 5px;
      font-size: 0.9rem;
      font-weight: 500;
    }
    
    .form-label {
      color: #333;
      font-weight: 600;
      margin-bottom: 8px;
    }
    
    .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 1rem;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .form-control:disabled {
      background-color: #f8f9fa;
      cursor: not-allowed;
    }
    
    .btn-register {
      border-radius: 10px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 14px 25px;
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .btn-register:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-register:disabled {
      background: #cccccc;
      cursor: not-allowed;
      transform: none;
    }
    
    .btn-resend {
      background: transparent;
      border: 2px solid #667eea;
      color: #667eea;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-resend:hover {
      background: #667eea;
      color: white;
    }
    
    .form-check-input:checked {
      background-color: #667eea;
      border-color: #667eea;
    }
    
    .form-check-label {
      color: #666;
      font-size: 0.9rem;
    }
    
    .form-check-label a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }
    
    .form-check-label a:hover {
      text-decoration: underline;
    }
    
    .alert {
      border-radius: 10px;
      border: none;
      padding: 15px;
      animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    
    .alert-success {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
      color: white;
      font-weight: 600;
    }
    
    /* Bootstrap Toast Styling */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }
    
    .toast {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
      border: none;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }
    
    .toast-header {
      background: rgba(255, 255, 255, 0.95);
      border-bottom: none;
      font-weight: 600;
      color: #11998e;
    }
    
    .toast-body {
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
    }
    
    .bg-danger {
      background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%) !important;
    }
    
    .countdown-timer {
      text-align: center;
      color: #666;
      font-size: 0.9rem;
      margin-top: 10px;
      font-weight: 500;
    }
    
    .countdown-timer.active {
      color: #667eea;
      font-weight: 600;
    }
    
    @media (max-width: 576px) {
      .registration-card {
        padding: 30px 20px;
      }
      
      .product-info h4 {
        font-size: 1.3rem;
      }
      
      .info-badge {
        font-size: 0.8rem;
        padding: 6px 12px;
      }
    }
  </style>
</head>
<body>

  <div class="registration-card">
    <!-- Product Info -->
    <div class="product-info">
      <h4><?php echo htmlspecialchars($schedule->product_name); ?></h4>
      <img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExN25kamp4Ym02YWMyanJqNDR3Njc0cTd5Yzl3ZGRwNXQxYnc1bGtpdSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/L0ZhO0YWanyEYF7RTE/giphy.gif" alt="Welcome Students" class="student-gif" />
      
      <div>
        <?php 
        
        print_r($_SESSION['session_otp']);
        
        $period = $this->db->get_where('period', ['period_id' => $schedule->period_id])->row();
         //  print_r($period->academic_year); 
        ?>
        
          <span class="info-badge">📚 <?php echo htmlspecialchars(print_r($period->academic_year)); ?></span>
        
      </div>
    </div>

    <!-- Email & OTP Form -->
    <form method="post" id="registrationForm">
      
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input 
          type="email" 
          class="form-control" 
          name="email" 
          id="email" 
          placeholder="Enter your email" 
          value="<?php echo htmlspecialchars($email ?? ''); ?>" 
          required 
          <?php echo !empty($email) ? 'disabled' : ''; ?>
        >
      </div>

      <!-- OTP (only shown if email is set) -->
      <?php if (!empty($email)) { ?>
        <div class="mb-3">
          <label for="otp" class="form-label">One-Time Password (OTP)</label>
          <input 
            type="text" 
            class="form-control" 
            name="otp" 
            id="otp" 
            placeholder="Enter 6-digit OTP" 
            maxlength="6"
            pattern="[0-9]{6}"
            required
            autocomplete="off"
          >
        </div>
        
        <!-- Countdown Timer -->
        <div class="countdown-timer" id="countdownTimer"></div>
      <?php } ?>

      <!-- Terms & Conditions -->
      <div class="form-check mb-4 mt-4">
        <input type="checkbox" class="form-check-input" id="termsCheck" required>
        <label class="form-check-label" for="termsCheck">
          I accept the 
          <a href="https://marrs.in/lunar/product_logo/Terms and Conditions .pdf" target="_blank">
            Terms and Conditions
          </a>
        </label>
      </div>

      <!-- Register Button -->
      <button 
        type="submit" 
        name="submit" 
        value="submit" 
        class="btn btn-register w-100 mb-3" 
        id="registerBtn" 
        disabled
      >
        <?php echo !empty($email) ? 'Verify & Register' : 'Send OTP'; ?>
      </button>

      <!-- Resend OTP -->
      <?php if (!empty($email)) { ?>
        <div id="resend-section" class="d-none text-center">
          <button type="submit" name="otp" value="resend" class="btn btn-resend w-100">
            🔄 Resend OTP
          </button>
        </div>
      <?php } ?>
      
    </form>

  </div>

  <!-- Bootstrap Toast Notification -->
  <div class="toast-container">
    <!-- Success Toast -->
    <?php if (!empty($this->session->flashdata('otpsuccess'))) { ?>
    <div id="otpSuccessToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-check-circle-fill text-success me-2"></i>
        <strong class="me-auto">Success</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <?php echo htmlspecialchars($this->session->flashdata('otpsuccess')); ?>
      </div>
    </div>
    <?php } ?>
    
    <!-- Error Toast -->
    <?php if (!empty($this->session->flashdata('otperror'))) { ?>
    <div id="otpErrorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-danger text-white">
        <i class="bi bi-exclamation-circle-fill me-2"></i>
        <strong class="me-auto">Error</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-danger text-white">
        <?php echo htmlspecialchars($this->session->flashdata('otperror')); ?>
      </div>
    </div>
    <?php } ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Show Bootstrap Toast for success message
    <?php if (!empty($this->session->flashdata('otpsuccess'))) { ?>
      document.addEventListener('DOMContentLoaded', function() {
        const toastElement = document.getElementById('otpSuccessToast');
        const toast = new bootstrap.Toast(toastElement, {
          autohide: true,
          delay: 4000
        });
        toast.show();
      });
    <?php } ?>
    
    // Show Bootstrap Toast for error message
    <?php if (!empty($this->session->flashdata('otperror'))) { ?>
      document.addEventListener('DOMContentLoaded', function() {
        const toastElement = document.getElementById('otpErrorToast');
        const toast = new bootstrap.Toast(toastElement, {
          autohide: true,
          delay: 4000
        });
        toast.show();
      });
    <?php } ?>

    // Terms checkbox enables submit button
    const termsCheck = document.getElementById("termsCheck");
    const registerBtn = document.getElementById("registerBtn");
    const emailInput = document.getElementById("email");

    termsCheck.addEventListener("change", () => {
      registerBtn.disabled = !termsCheck.checked;
    });

    // Show resend button after 60 seconds with countdown
    <?php if (!empty($email)) { ?>
      let timeLeft = 60;
      const countdownTimer = document.getElementById('countdownTimer');
      const resendSection = document.getElementById('resend-section');
      
      countdownTimer.classList.add('active');
      
      const countdown = setInterval(() => {
        timeLeft--;
        countdownTimer.textContent = `Resend OTP available in ${timeLeft}s`;
        
        if (timeLeft <= 0) {
          clearInterval(countdown);
          countdownTimer.textContent = '';
          countdownTimer.classList.remove('active');
          resendSection.classList.remove('d-none');
        }
      }, 1000);
    <?php } ?>

    // Auto-focus OTP input
    const otpInput = document.getElementById('otp');
    if (otpInput) {
      otpInput.focus();
      
      // Auto-format OTP input (numbers only)
      otpInput.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
      });
    }
  </script>

</body>
</html>