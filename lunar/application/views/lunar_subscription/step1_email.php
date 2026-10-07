<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lunar – Register</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --ink: #0d1117;
    --paper: #f7f3ed;
    --accent: #e8531a;
    --accent2: #1a3e8a;
    --muted: #8a8278;
    --card: #ffffff;
    --border: #e2ddd7;
    --success: #1a7a4a;
    --error: #c0392b;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--paper);
    min-height: 100vh;
    display: grid;
    place-items: center;
    padding: 2rem;
  }

  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 40% at 10% 10%, rgba(232,83,26,0.08) 0%, transparent 60%),
      radial-gradient(ellipse 50% 50% at 90% 90%, rgba(26,62,138,0.08) 0%, transparent 60%);
    pointer-events: none;
  }

  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 3rem;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 4px 40px rgba(13,17,23,0.07);
    position: relative;
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #5084c4;
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 100px;
    margin-bottom: 1.5rem;
  }

  h1 {
    font-family: 'Syne', sans-serif;
    font-size: 2rem;
    font-weight: 800;
    color: var(--ink);
    line-height: 1.15;
    margin-bottom: 0.5rem;
  }

  h1 span { color: #5084c4; }

  .subtitle {
    color: var(--muted);
    font-size: 0.9rem;
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .steps {
    display: flex;
    gap: 6px;
    margin-bottom: 2rem;
  }

  .step {
    height: 4px;
    flex: 1;
    border-radius: 10px;
    background: var(--border);
    transition: background 0.3s;
  }

  .step.active { background: var(--accent); }

  label {
    display: block;
    font-size: 0.78rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 6px;
  }

  input[type="text"], input[type="email"], input[type="number"] {
    width: 100%;
    padding: 13px 16px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 1rem;
    color: var(--ink);
    background: var(--paper);
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    margin-bottom: 1.2rem;
  }

  input:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(232,83,26,0.12);
    background: #fff;
  }

  .btn {
    width: 100%;
    padding: 14px;
    background: var(--ink);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'Syne', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    cursor: pointer;
    transition: background 0.2s, transform 0.15s;
  }

  .btn:hover { background: var(--accent); transform: translateY(-1px); }
  .btn:active { transform: translateY(0); }
  .btn:disabled { background: var(--muted); cursor: not-allowed; transform: none; }

  .btn-secondary {
    background: transparent;
    color: var(--ink);
    border: 1.5px solid var(--border);
    margin-top: 10px;
  }
  .btn-secondary:hover { background: var(--paper); border-color: var(--ink); }

  .alert {
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 0.88rem;
    margin-bottom: 1rem;
    display: none;
  }
  .alert.error   { background: #fdf0ef; color: var(--error); border: 1px solid #f5c6c3; }
  .alert.success { background: #edf7f2; color: var(--success); border: 1px solid #b8e6cc; }
  .alert.show    { display: block; }

  .otp-wrap { display: none; }
  .otp-wrap.show { display: block; }

  .otp-hint {
    font-size: 0.82rem;
    color: var(--muted);
    margin-bottom: 1.2rem;
  }

  .otp-hint strong { color: var(--accent2); }

  .resend-link {
    color: var(--accent);
    font-size: 0.82rem;
    cursor: pointer;
    text-decoration: underline;
    display: inline-block;
    margin-top: -0.5rem;
    margin-bottom: 1rem;
  }

  .spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    vertical-align: middle;
    margin-right: 6px;
  }

  @keyframes spin { to { transform: rotate(360deg); } }

  .otp-grid {
    display: flex;
    gap: 10px;
    margin-bottom: 1.5rem;
  }

  .otp-grid input {
    flex: 1;
    text-align: center;
    font-size: 1.4rem;
    font-weight: 700;
    font-family: 'Syne', sans-serif;
    padding: 14px 8px;
    margin-bottom: 0;
  }
</style>
</head>
<body>

<div class="card">
  <div class="badge">🌙 Lunar Registration</div>
  <h1>Start Your<br><span>Journey</span></h1>
  <p class="subtitle">Enter your details to register for Lunar examinations. We'll verify your email before proceeding.</p>

  <div class="steps">
    <div class="step active"></div>
    <div class="step"></div>
    <div class="step"></div>
    <div class="step"></div>
  </div>

  <div id="alert" class="alert"></div>

  <!-- Email Form -->
  <div id="email-form">
    <label>Full Name</label>
    <input type="text" id="name" placeholder="e.g. Arjun Mehta" autocomplete="name">

    <label>Email Address</label>
    <input type="email" id="email" placeholder="you@example.com" autocomplete="email">

    <button class="btn" id="send-otp-btn" onclick="sendOTP()">
      Send OTP
    </button>
  </div>

  <!-- OTP Section -->
  <div id="otp-section" class="otp-wrap">
    <p class="otp-hint">OTP sent to <strong id="otp-email-display"></strong></p>

    <label>Enter 6-digit OTP</label>
    <div class="otp-grid">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
      <input type="number" class="otp-digit" maxlength="1" min="0" max="9">
    </div>

    <span class="resend-link" onclick="sendOTP()">Resend OTP</span>

    <button class="btn" id="verify-btn" onclick="verifyOTP()">
      Verify & Continue
    </button>
    <button class="btn btn-secondary" onclick="resetForm()">← Change Email</button>
  </div>
</div>

<script>
const BASE = '<?= base_url() ?>';

function showAlert(msg, type) {
  const el = document.getElementById('alert');
  el.textContent = msg;
  el.className = 'alert ' + type + ' show';
}
function hideAlert() {
  document.getElementById('alert').className = 'alert';
}

async function sendOTP() {
  const name  = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();

  if (!name)  { showAlert('Please enter your name.', 'error');  return; }
  if (!email) { showAlert('Please enter your email.', 'error'); return; }

  const btn = document.getElementById('send-otp-btn');
  btn.innerHTML = '<span class="spinner"></span> Sending...';
  btn.disabled = true;
  hideAlert();

  const fd = new FormData();
  fd.append('name', name);
  fd.append('email', email);

  const res  = await fetch(BASE + 'Lunar/send_otp', { method:'POST', body: fd });
  const data = await res.json();

  btn.innerHTML = 'Send OTP';
  btn.disabled = false;

  if (data.status === 'success') {
    document.getElementById('email-form').style.display = 'none';
    document.getElementById('otp-email-display').textContent = email;
    document.getElementById('otp-section').classList.add('show');
    document.querySelector('.otp-digit').focus();
    showAlert(data.message, 'success');
  } else {
    showAlert(data.message, 'error');
  }
}

async function verifyOTP() {
  const digits = [...document.querySelectorAll('.otp-digit')].map(i => i.value).join('');

  if (digits.length < 6) { showAlert('Please enter all 6 digits.', 'error'); return; }

  const btn = document.getElementById('verify-btn');
  btn.innerHTML = '<span class="spinner"></span> Verifying...';
  btn.disabled = true;
  hideAlert();

  const fd = new FormData();
  fd.append('otp', digits);

  const res  = await fetch(BASE + 'Lunar/verify_otp', { method:'POST', body: fd });
  const data = await res.json();

  btn.innerHTML = 'Verify & Continue';
  btn.disabled = false;

  if (data.status === 'success') {
    showAlert('Verified! Redirecting...', 'success');
    setTimeout(() => window.location.href = BASE + 'Lunar/products', 800);
  } else if (data.status === 'registered') {
    showAlert('Already registered. Redirecting to login...', 'success');
    setTimeout(() => window.location.href = data.redirect, 1000);
  } else {
    showAlert(data.message, 'error');
  }
}

function resetForm() {
  document.getElementById('email-form').style.display = 'block';
  document.getElementById('otp-section').classList.remove('show');
  document.querySelectorAll('.otp-digit').forEach(i => i.value = '');
  hideAlert();
}

// OTP digit auto-advance
document.addEventListener('DOMContentLoaded', () => {
  const digits = document.querySelectorAll('.otp-digit');
  digits.forEach((inp, idx) => {
    inp.addEventListener('input', () => {
      if (inp.value.length > 1) inp.value = inp.value.slice(-1);
      if (inp.value && idx < digits.length - 1) digits[idx + 1].focus();
    });
    inp.addEventListener('keydown', e => {
      if (e.key === 'Backspace' && !inp.value && idx > 0) digits[idx - 1].focus();
    });
  });
});
</script>
</body>
</html>
