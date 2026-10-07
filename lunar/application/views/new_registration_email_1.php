<?php 
// Assuming $schedule object has data.



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lunar Student Registration - OTP Verification</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --brand-blue: #2f6fe0;
      --brand-blue-dark: #123869;
      --brand-navy: #1a2540;
      --brand-navy-btn: #1f3864;
      --brand-navy-btn-hover: #274a82;
      --brand-muted: #8790a3;
      --brand-border: #e5e9f2;
      --input-bg: #f1f3f7;
      --brand-green: #16a34a;
      --brand-green-light: #22c55e;
      --brand-red: #eb3349;
      --brand-red-light: #f45c43;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
    }

    body {
      background: linear-gradient(135deg, #4d84e8 0%, #2f6fe0 45%, #1a3d78 100%);
      font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      color: var(--brand-navy);
      position: relative;
      overflow: hidden;
    }

    /* Decorative page-level blob, sits behind the card */
    .page-blob {
      position: fixed;
      width: 380px;
      height: 380px;
      border-radius: 50%;
      bottom: -140px;
      left: -80px;
      background: radial-gradient(circle at 30% 30%, #3f78e6 0%, #16305e 80%);
      opacity: 0.9;
      z-index: 0;
      filter: blur(1px);
    }

    /* ===================== AUTH CARD (split layout) ===================== */
    .auth-card {
      position: relative;
      z-index: 1;
      display: flex;
      width: 100%;
      max-width: 960px;
      min-height: 620px;
      background: #ffffff;
      border-radius: 28px;
      box-shadow: 0 25px 60px -10px rgba(10, 25, 60, 0.45), 0 10px 25px rgba(10, 25, 60, 0.2);
      overflow: hidden;
      transition: box-shadow 0.35s ease, transform 0.35s ease;
    }

    .auth-card:hover {
      box-shadow: 0 30px 70px -8px rgba(10, 25, 60, 0.5), 0 14px 30px rgba(10, 25, 60, 0.25);
      transform: translateY(-2px);
    }

    /* ---------- Left panel ---------- */
    .auth-left {
      position: relative;
      flex: 0 0 45%;
      background: linear-gradient(160deg, #3f78e6 0%, #1c3f7d 65%, #12305f 100%);
      color: #fff;
      padding: 56px 46px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow: hidden;
    }

    .auth-left-content {
      position: relative;
      z-index: 3;
    }

    .brand-logo-left {
      height: 60px;
      width: auto;
      max-width: 180px;
      object-fit: contain;
      margin-bottom: 36px;
      background: rgba(255, 255, 255, 0.92);
      padding:0px;
      border-radius: 10px;
    }

    .welcome-title {
      font-size: 2.4rem;
      font-weight: 800;
      letter-spacing: 1px;
      margin-bottom: 6px;
    }

    .welcome-sub {
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #cfe0ff;
      margin-bottom: 20px;
    }

    .welcome-desc {
      font-size: 0.88rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.8);
      max-width: 300px;
      margin-bottom: 22px;
    }

    .welcome-badges {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .welcome-badges .info-badge {
      background: rgba(255, 255, 255, 0.16);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.25);
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 0.78rem;
      font-weight: 600;
      backdrop-filter: blur(2px);
      transition: all 0.2s ease;
    }

    .welcome-badges .info-badge:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-1px);
    }

    /* Decorative circles that create the curved boundary, like the reference design */
    .blob-curve {
      position: absolute;
      z-index: 2;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      top: -60px;
      right: -150px;
      background: linear-gradient(160deg, #3f78e6 0%, #1c3f7d 100%);
    }

    .blob-mid {
      position: absolute;
      z-index: 2;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      bottom: -60px;
      right: -110px;
      background: radial-gradient(circle at 35% 30%, #4d84e8 0%, #163665 85%);
      box-shadow: 0 15px 30px rgba(10, 25, 60, 0.35);
    }

    /* ---------- Right panel ---------- */
    .auth-right {
      flex: 1;
      padding: 56px 52px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      z-index: 3;
      background: #fff;
    }

    .form-title {
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--brand-navy);
      margin-bottom: 6px;
    }

    .form-subtitle {
      font-size: 0.85rem;
      color: var(--brand-muted);
      margin-bottom: 26px;
    }

    /* Pill-style inputs with icon, matching reference */
    .input-pill {
      display: flex;
      align-items: center;
      background: var(--input-bg);
      border: 2px solid transparent;
      border-radius: 12px;
      padding: 4px 6px 4px 4px;
      transition: all 0.25s ease;
    }

    .input-pill:hover {
      border-color: #d6ddef;
    }

    .input-pill:focus-within {
      background: #fff;
      border-color: var(--brand-blue);
      box-shadow: 0 0 0 0.2rem rgba(47, 111, 224, 0.15);
    }

    .input-pill .input-icon {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--brand-navy);
      font-size: 1rem;
      flex-shrink: 0;
    }

    .input-pill input {
      border: none;
      background: transparent;
      outline: none;
      padding: 10px 10px 10px 0;
      width: 100%;
      font-size: 0.95rem;
      color: var(--brand-navy);
    }

    .input-pill input::placeholder {
      color: var(--brand-muted);
    }

    .input-pill input:disabled {
      color: var(--brand-muted);
      cursor: not-allowed;
    }

    .form-check-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .form-check-row .form-check-input:checked {
      background-color: var(--brand-blue);
      border-color: var(--brand-blue);
    }

    .form-check-row .form-check-label {
      color: var(--brand-muted);
      font-size: 0.85rem;
      margin-left: 4px;
    }

    .form-check-row .form-check-label a {
      color: var(--brand-blue);
      text-decoration: none;
      font-weight: 600;
    }

    .form-check-row .form-check-label a:hover {
      text-decoration: underline;
    }

    /* Primary pill button, like "Sign in" */
    .btn-primary-pill {
      border: none;
      border-radius: 14px;
      background: var(--brand-navy-btn);
      color: #fff;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 0.3px;
      padding: 14px 20px;
      transition: all 0.25s ease;
      box-shadow: 0 8px 18px rgba(31, 56, 100, 0.35);
    }

    .btn-primary-pill:hover:not(:disabled) {
      background: var(--brand-navy-btn-hover);
      transform: translateY(-2px);
      box-shadow: 0 12px 26px rgba(31, 56, 100, 0.45);
    }

    .btn-primary-pill:active:not(:disabled) {
      transform: translateY(0);
      box-shadow: 0 6px 14px rgba(31, 56, 100, 0.3);
    }

    .btn-primary-pill:disabled {
      background: #d7dbe6;
      color: #99a1b3;
      cursor: not-allowed;
      box-shadow: none;
    }

    /* Divider "Or" row */
    .divider-row {
      display: flex;
      align-items: center;
      gap: 14px;
      color: var(--brand-muted);
      font-size: 0.82rem;
      margin: 18px 0;
      text-transform: lowercase;
    }

    .divider-row span {
      flex: 1;
      height: 1px;
      background: var(--brand-border);
    }

    /* Outline pill button, like "Sign in with other" */
    .btn-outline-pill {
      border: 2px solid var(--brand-navy-btn);
      background: #fff;
      color: var(--brand-navy-btn);
      border-radius: 14px;
      padding: 12px 20px;
      font-weight: 700;
      font-size: 0.95rem;
      transition: all 0.25s ease;
    }

    .btn-outline-pill:hover {
      background: var(--brand-navy-btn);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(31, 56, 100, 0.25);
    }

    .btn-outline-pill:active {
      transform: translateY(0);
      box-shadow: none;
    }

    .countdown-timer {
      text-align: left;
      color: var(--brand-muted);
      font-size: 0.82rem;
      margin: 8px 2px 4px;
      font-weight: 500;
    }

    .countdown-timer.active {
      color: var(--brand-blue);
      font-weight: 700;
    }

    /* ===================== Toasts ===================== */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .toast {
      background: linear-gradient(135deg, var(--brand-green) 0%, var(--brand-green-light) 100%);
      border: none;
      box-shadow: 0 5px 20px rgba(26, 37, 64, 0.25);
      border-radius: 12px;
      overflow: hidden;
    }

    .toast-header {
      background: rgba(255, 255, 255, 0.95);
      border-bottom: none;
      font-weight: 700;
      color: var(--brand-green);
    }

    .toast-body {
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .bg-danger {
      background: linear-gradient(135deg, var(--brand-red) 0%, var(--brand-red-light) 100%) !important;
    }

    /* ===================== Responsive ===================== */
    @media (max-width: 860px) {
      .auth-card {
        flex-direction: column;
        max-width: 460px;
        min-height: unset;
      }

      .auth-left {
        flex: none;
        padding: 40px 34px;
        min-height: 260px;
      }

      .welcome-title {
        font-size: 1.9rem;
      }

      .auth-right {
        padding: 40px 30px;
      }

      .blob-mid {
        display: none;
      }
    }

    @media (max-width: 480px) {
      .form-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="page-blob"></div>

  <div class="auth-card">

    <!-- LEFT: brand / welcome panel -->
    <div class="auth-left">
      <div class="auth-left-content">
        <img src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" alt="Lunar Assessments" class="brand-logo-left" />
        <div class="welcome-title">WELCOME</div>
        <div class="welcome-sub"><?php echo htmlspecialchars($schedule->product_name); ?></div>
        <p class="welcome-desc">
          Verify your email to unlock your learning material, tests and certificate for this program.
        </p>
        <div class="welcome-badges">
          <?php if (!empty($schedule->subject)) { ?>
            <span class="info-badge"> <?php echo htmlspecialchars($schedule->subject); ?></span>
          <?php } ?>
          <?php if (!empty($schedule->series)) { ?>
            <span class="info-badge"> <?php echo htmlspecialchars($schedule->series); ?></span>
          <?php } ?>
          <?php if (!empty($schedule->type)) { ?>
            <span class="info-badge"> <?php echo htmlspecialchars($schedule->type); ?></span>
          <?php } ?>
        </div>
      </div>
      <div class="blob-curve"></div>
      <div class="blob-mid"></div>
    </div>

    <!-- RIGHT: form panel -->
    <div class="auth-right">
      <div class="form-title"><?php echo !empty($email) ? 'Verify OTP' : 'Verify Your Email'; ?></div>
      <div class="form-subtitle">
        <?php echo !empty($email)
          ? 'Enter the 6-digit code sent to your email'
          : 'Enter your email address to receive a one-time password'; ?>
      </div>

      <form method="post" id="registrationForm">

        <div class="input-pill mb-3">
          <span class="input-icon"><i class="bi bi-envelope-fill"></i></span>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Email Address"
            value="<?php echo htmlspecialchars($email ?? ''); ?>"
            required
            <?php echo !empty($email) ? 'disabled' : ''; ?>
          >
        </div>

        <!-- OTP (only shown if email is set) -->
        <?php if (!empty($email)) { ?>
          <div class="input-pill mb-1">
            <span class="input-icon"><i class="bi bi-shield-lock-fill"></i></span>
            <input
              type="text"
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

        <!-- Terms & Conditions (only on the first step) -->


        <!-- Register Button -->
<button
  type="submit"
  name="submit"
  value="submit"
  class="btn-primary-pill w-100"
  id="registerBtn"
>
  <?php echo !empty($email) ? 'Verify & Register' : 'Send OTP'; ?>
</button>

        <!-- Resend OTP -->
        <?php if (!empty($email)) { ?>
          <div class="divider-row"><span></span><span></span></div>
          <div id="resend-section" class="d-none">
            <button type="submit" name="otp" value="resend" class="btn-outline-pill w-100">
              Resend OTP
            </button>
          </div>
        <?php } ?>

      </form>
    </div>

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