<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MaRRS Student Portal — CIN Login & Registration</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --navy: #0a1628;
    --navy-mid: #112240;
    --navy-light: #1d3461;
    --gold: #e8a923;
    --gold-light: #f5c842;
    --gold-pale: #fdf3d9;
    --cream: #f9f4ec;
    --white: #ffffff;
    --red: #d94f3d;
    --green: #2d9e6b;
    --text: #1a2540;
    --muted: #6b7a99;
    --border: #dde3f0;
    --shadow: 0 8px 40px rgba(10,22,40,0.12);
    --shadow-gold: 0 4px 24px rgba(232,169,35,0.25);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    color: var(--text);
    min-height: 100vh;
  }

  /* ── HEADER ── */
  .site-header {
    background: var(--navy);
    padding: 0 2rem;
    position: sticky;
    top: 0;
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    border-bottom: 3px solid var(--gold);
    box-shadow: 0 4px 24px rgba(0,0,0,0.3);
  }
  .logo {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .logo-badge {
    width: 38px; height: 38px;
    background: var(--gold);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif;
    font-weight: 900;
    font-size: 1.1rem;
    color: var(--navy);
    letter-spacing: -1px;
  }
  .logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--white);
    letter-spacing: 0.5px;
  }
  .logo-text span { color: var(--gold); }
  .header-nav {
    display: flex;
    gap: 8px;
  }
  .nav-btn {
    padding: 6px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    font-family: 'DM Sans', sans-serif;
  }
  .nav-btn.ghost {
    background: transparent;
    color: rgba(255,255,255,0.75);
    border: 1px solid rgba(255,255,255,0.2);
  }
  .nav-btn.ghost:hover { color: var(--white); border-color: rgba(255,255,255,0.5); }
  .nav-btn.primary {
    background: var(--gold);
    color: var(--navy);
    font-weight: 600;
  }
  .nav-btn.primary:hover { background: var(--gold-light); box-shadow: var(--shadow-gold); }

  /* ── HERO STRIP ── */
  .hero-strip {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 50%, var(--navy-light) 100%);
    color: var(--white);
    padding: 4rem 2rem 3.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .hero-strip::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 80% at 50% 120%, rgba(232,169,35,0.15) 0%, transparent 70%);
  }
  .hero-strip::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
  }
  .hero-kicker {
    display: inline-block;
    background: rgba(232,169,35,0.15);
    border: 1px solid rgba(232,169,35,0.4);
    color: var(--gold);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 20px;
    margin-bottom: 1rem;
  }
  .hero-strip h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 900;
    line-height: 1.15;
    margin-bottom: 0.75rem;
    position: relative;
  }
  .hero-strip h1 em { font-style: normal; color: var(--gold); }
  .hero-strip p {
    color: rgba(255,255,255,0.65);
    font-size: 0.95rem;
    max-width: 560px;
    margin: 0 auto;
    line-height: 1.6;
    position: relative;
  }

  /* ── MAIN LAYOUT ── */
  .main-wrap {
    max-width: 1160px;
    margin: 0 auto;
    padding: 2.5rem 1.5rem 4rem;
    display: grid;
   
    gap: 1.5rem;
  }
  @media (max-width: 768px) {
    .main-wrap { grid-template-columns: 1fr; }
  }

  /* ── CARD ── */
  .card {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    border: 1px solid var(--border);
    animation: slideUp 0.5s ease both;
  }
  .card:nth-child(2) { animation-delay: 0.1s; }
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .card-header {
    padding: 1.5rem 1.75rem 1.25rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .card-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
  }
  .card-icon.gold { background: var(--gold-pale); }
  .card-icon.navy { background: rgba(17,34,64,0.08); }
  .card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--navy);
  }
  .card-subtitle {
    font-size: 0.78rem;
    color: var(--muted);
    margin-top: 2px;
  }
  .card-body { padding: 1.75rem; flex: 1; }

  /* ── TAB SWITCHER ── */
  .tab-bar {
    display: flex;
    background: var(--cream);
    border-radius: 10px;
    padding: 4px;
    margin-bottom: 1.5rem;
    gap: 4px;
  }
  .tab-btn {
    flex: 1;
    padding: 8px;
    border: none;
    background: transparent;
    border-radius: 7px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--muted);
    cursor: pointer;
    transition: all 0.2s;
  }
  .tab-btn.active {
    background: var(--white);
    color: var(--navy);
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    font-weight: 600;
  }

  /* ── FORM ELEMENTS ── */
  .form-group { margin-bottom: 1.1rem; }
  .form-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 5px;
    letter-spacing: 0.3px;
  }
  .form-label .req { color: var(--red); margin-left: 2px; }
  .form-input, .form-select {
    width: 100%;
    padding: 10px 13px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    color: var(--text);
    background: var(--white);
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
  }
  .form-input:focus, .form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(232,169,35,0.15);
  }
  .form-input::placeholder { color: #b0b8cc; }

  .cin-input-wrap {
    position: relative;
  }
  .cin-input-wrap .cin-prefix {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-family: 'DM Mono', monospace;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--gold);
    background: var(--gold-pale);
    padding: 2px 6px;
    border-radius: 4px;
    pointer-events: none;
  }
  .cin-input-wrap .form-input {
    padding-left: 72px;
    font-family: 'DM Mono', monospace;
    letter-spacing: 1px;
    font-size: 0.95rem;
  }

  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
  @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }

  .input-hint {
    font-size: 0.74rem;
    color: var(--muted);
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* ── ACCESS CODE TOGGLE ── */
  .toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--cream);
    border-radius: 8px;
    padding: 10px 13px;
    margin-bottom: 1.1rem;
    cursor: pointer;
    border: 1.5px solid transparent;
    transition: border-color 0.2s;
  }
  .toggle-row:hover { border-color: var(--border); }
  .toggle-row label { font-size: 0.83rem; font-weight: 500; color: var(--text); cursor: pointer; }
  .toggle-switch {
    width: 36px; height: 20px;
    background: var(--border);
    border-radius: 10px;
    position: relative;
    transition: background 0.2s;
    flex-shrink: 0;
  }
  .toggle-switch.on { background: var(--gold); }
  .toggle-switch::after {
    content: '';
    position: absolute;
    width: 16px; height: 16px;
    background: white;
    border-radius: 50%;
    top: 2px; left: 2px;
    transition: left 0.2s;
    box-shadow: 0 1px 4px rgba(0,0,0,0.2);
  }
  .toggle-switch.on::after { left: 18px; }

  /* ── SUBMIT BUTTON ── */
  .btn-submit {
    width: 100%;
    padding: 13px;
    background: var(--navy);
    color: var(--white);
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.92rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    letter-spacing: 0.3px;
    margin-top: 0.5rem;
  }
  .btn-submit:hover {
    background: var(--navy-light);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(10,22,40,0.25);
  }
  .btn-submit:active { transform: none; }
  .btn-submit.gold-btn {
    background: var(--gold);
    color: var(--navy);
  }
  .btn-submit.gold-btn:hover {
    background: var(--gold-light);
    box-shadow: var(--shadow-gold);
  }
  .btn-submit .spinner {
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    display: none;
  }
  .btn-submit.loading .spinner { display: block; }
  .btn-submit.loading .btn-text { opacity: 0.6; }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ── DIVIDER ── */
  .divider {
    display: flex; align-items: center; gap: 10px;
    margin: 1.2rem 0;
    color: var(--muted);
    font-size: 0.75rem;
  }
  .divider::before, .divider::after {
    content: ''; flex: 1; height: 1px; background: var(--border);
  }

  /* ── CIN DISPLAY BOX ── */
  .cin-display {
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
    border-radius: 12px;
    padding: 1.5rem;
    color: white;
    margin-bottom: 1.25rem;
    position: relative;
    overflow: hidden;
  }
  .cin-display::after {
    content: '';
    position: absolute;
    top: -20px; right: -20px;
    width: 100px; height: 100px;
    background: rgba(232,169,35,0.12);
    border-radius: 50%;
  }
  .cin-display-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.55);
    margin-bottom: 6px;
  }
  .cin-number {
    font-family: 'DM Mono', monospace;
    font-size: 1.6rem;
    font-weight: 500;
    color: var(--gold);
    letter-spacing: 3px;
  }
  .cin-name {
    font-size: 0.82rem;
    color: rgba(255,255,255,0.7);
    margin-top: 4px;
  }

  /* ── WELCOME MAIL BOX ── */
  .mail-preview {
    border: 1.5px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    margin-top: 1.25rem;
  }
  .mail-header {
    background: var(--cream);
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    border-bottom: 1px solid var(--border);
  }
  .mail-dot {
    width: 10px; height: 10px; border-radius: 50%;
  }
  .mail-title {
    font-size: 0.75rem;
    color: var(--muted);
    font-family: 'DM Mono', monospace;
  }
  .mail-body {
    padding: 1rem 1.25rem;
    font-size: 0.8rem;
    line-height: 1.7;
    color: var(--text);
  }
  .mail-body strong { color: var(--navy); }
  .mail-cin-tag {
    display: inline-block;
    background: var(--gold-pale);
    border: 1px solid rgba(232,169,35,0.4);
    color: var(--navy);
    font-family: 'DM Mono', monospace;
    font-size: 0.85rem;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 6px;
    letter-spacing: 1px;
  }

  /* ── INFO PILLS ── */
  .info-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 1.25rem;
  }
  .pill {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.73rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .pill.green { background: #e8f7f0; color: var(--green); }
  .pill.gold { background: var(--gold-pale); color: #8a6200; }
  .pill.navy { background: rgba(17,34,64,0.08); color: var(--navy); }

  /* ── STEP FLOW ── */
  .step-list { margin-bottom: 1.25rem; }
  .step-item {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
  }
  .step-item:last-child { border-bottom: none; }
  .step-num {
    width: 26px; height: 26px;
    background: var(--navy);
    color: white;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.72rem;
    font-weight: 700;
    flex-shrink: 0;
    margin-top: 1px;
  }
  .step-content p {
    font-size: 0.82rem;
    color: var(--text);
    font-weight: 500;
    margin-bottom: 2px;
  }
  .step-content span {
    font-size: 0.74rem;
    color: var(--muted);
  }

  /* ── SCORE RESULT ── */
  .score-card {
    background: var(--cream);
    border-radius: 10px;
    padding: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    border: 1.5px solid var(--border);
  }
  .score-meta p { font-size: 0.82rem; font-weight: 600; color: var(--navy); }
  .score-meta span { font-size: 0.73rem; color: var(--muted); }
  .score-badge {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--green);
  }
  .score-badge.avg { color: var(--gold); }
  .progress-bar {
    height: 5px;
    background: var(--border);
    border-radius: 3px;
    margin-top: 8px;
    overflow: hidden;
  }
  .progress-fill {
    height: 100%;
    border-radius: 3px;
    background: linear-gradient(90deg, var(--gold), var(--green));
  }

  /* ── NOTICE BANNER ── */
  .notice {
    background: var(--gold-pale);
    border: 1px solid rgba(232,169,35,0.35);
    border-radius: 8px;
    padding: 10px 13px;
    font-size: 0.78rem;
    color: #6b4c00;
    display: flex;
    gap: 8px;
    align-items: flex-start;
    margin-bottom: 1.1rem;
    line-height: 1.5;
  }

  /* ── PANE VISIBILITY ── */
  .pane { display: none; }
  .pane.active { display: block; }

  /* ── FOOTER LINK ── */
  .card-footer {
    padding: 1rem 1.75rem;
    border-top: 1px solid var(--border);
    font-size: 0.78rem;
    color: var(--muted);
    text-align: center;
  }
  .card-footer a { color: var(--navy); font-weight: 600; text-decoration: none; }
  .card-footer a:hover { color: var(--gold); }

  /* ── TOOLTIP ── */
  .tooltip {
    position: relative;
    display: inline-block;
  }
  .tooltip .tip {
    display: none;
    position: absolute;
    bottom: calc(100% + 6px);
    left: 50%;
    transform: translateX(-50%);
    background: var(--navy);
    color: white;
    font-size: 0.72rem;
    padding: 5px 10px;
    border-radius: 6px;
    white-space: nowrap;
    z-index: 10;
  }
  .tooltip:hover .tip { display: block; }

  /* ── PAYMENT SECTION ── */
  .payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    margin-bottom: 1.1rem;
  }
  .pay-option {
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 10px 6px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--muted);
  }
  .pay-option:hover, .pay-option.selected {
    border-color: var(--gold);
    background: var(--gold-pale);
    color: var(--navy);
  }
  .pay-option .pay-icon { font-size: 1.2rem; margin-bottom: 4px; }

  /* ── FULL WIDTH SPAN ── */
  .span-2 {
    grid-column: 1 / -1;
  }

  /* ── ALERT ── */
  .alert {
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    display: flex;
    gap: 8px;
    align-items: center;
    margin-bottom: 1rem;
    display: none;
  }
  .alert.success { background: #e8f7f0; color: var(--green); border: 1px solid #a8dfc4; }
  .alert.error { background: #fdf0ef; color: var(--red); border: 1px solid #f5b8b3; }
  .alert.show { display: flex; }
</style>
</head>
<body>

<!-- HEADER -->
<header class="site-header">
  <div class="logo">
    <div class="logo-badge">M</div>
    <div class="logo-text">Ma<span>RRS</span> Portal</div>
  </div>
  <nav class="header-nav">
    <button class="nav-btn ghost">Help</button>
    <button class="nav-btn ghost">Results Archive</button>
    <button class="nav-btn primary" onclick="showSection('login')">Login with CIN</button>
  </nav>
</header>

<!-- HERO -->
<div class="hero-strip">
  <div class="hero-kicker">🎓 Student Access Portal</div>
  <h1>MaRRS <em>CIN</em> Login &<br>School Demo Link</h1>
  <p>Register for any active MaRRS program, attempt tests, and view your results — all in one place. Use your CIN to log in anytime.</p>
</div>

<!-- MAIN CONTENT -->
<div class="main-wrap">

  <!-- LEFT CARD: REGISTER & PAY -->
  <div class="card">
    <div class="card-header">
      <div class="card-icon gold">📝</div>
      <div>
        <div class="card-title">Register & Pay</div>
        <div class="card-subtitle">Sign up for any active MaRRS program</div>
      </div>
    </div>
    <div class="card-body">

      <div class="info-pills">
        <span class="pill green">✔ Open Enrollment</span>
        <span class="pill gold">⚡ Instant CIN Generated</span>
        <span class="pill navy">✉ Welcome Mail Sent</span>
      </div>

      <!-- TABS -->
      <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('new', this)">New Registration</button>
        <button class="tab-btn" onclick="switchTab('existing', this)">Existing CIN → New Program</button>
      </div>

      <!-- NEW REGISTRATION PANE -->
      <div id="pane-new" class="pane active">
        <div id="alert-reg" class="alert"></div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">First Name <span class="req">*</span></label>
            <input class="form-input" type="text" placeholder="e.g. Arjun" id="fn">
          </div>
          <div class="form-group">
            <label class="form-label">Last Name <span class="req">*</span></label>
            <input class="form-input" type="text" placeholder="e.g. Sharma" id="ln">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Email Address <span class="req">*</span></label>
          <input class="form-input" type="email" placeholder="student@email.com" id="email">
        </div>

        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Date of Birth <span class="req">*</span></label>
            <input class="form-input" type="date" id="dob">
          </div>
          <div class="form-group">
            <label class="form-label">Grade / Class <span class="req">*</span></label>
            <select class="form-select" id="grade">
              <option value="">Select grade</option>
              <option>Grade 3</option><option>Grade 4</option>
              <option>Grade 5</option><option>Grade 6</option>
              <option>Grade 7</option><option>Grade 8</option>
              <option>Grade 9</option><option>Grade 10</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Select Program <span class="req">*</span></label>
          <select class="form-select" id="program">
            <option value="">Choose active program</option>
            <option>MaRRS Spelling Bee 2025–26</option>
            <option>MaRRS Science Olympiad 2025–26</option>
            <option>MaRRS Mathematics Challenge 2025–26</option>
            <option>MaRRS General Knowledge Quiz 2025–26</option>
          </select>
        </div>

        <!-- School Access Code Toggle -->
        <div class="toggle-row" onclick="toggleCode()">
          <label>I have a School Access Code</label>
          <div class="toggle-switch" id="codeToggle"></div>
        </div>
        <div id="accessCodeField" style="display:none; margin-bottom:1.1rem;">
          <label class="form-label">School Access Code</label>
          <input class="form-input" type="text" placeholder="e.g. SCH-2025-DELHI-001" id="accessCode" style="font-family:'DM Mono',monospace;letter-spacing:1px;">
          <div class="input-hint">ℹ Provided by your school coordinator</div>
        </div>

        <!-- Payment -->
        <div class="form-group">
          <label class="form-label">Payment Method <span class="req">*</span></label>
          <div class="payment-methods">
            <div class="pay-option selected" onclick="selectPay(this)">
              <div class="pay-icon">💳</div>Card/UPI
            </div>
            <div class="pay-option" onclick="selectPay(this)">
              <div class="pay-icon">🏦</div>Net Banking
            </div>
            <div class="pay-option" onclick="selectPay(this)">
              <div class="pay-icon">🏫</div>School Pay
            </div>
          </div>
        </div>

        <div class="notice">
          <span>⚠</span>
          <span>After payment, your <strong>CIN (Candidate Identification Number)</strong> will be auto-generated and emailed immediately with login instructions.</span>
        </div>

        <button class="btn-submit gold-btn" id="regBtn" onclick="handleRegister()">
          <div class="spinner"></div>
          <span class="btn-text">Complete Registration & Pay →</span>
        </button>
      </div>

      <!-- EXISTING CIN PANE -->
      <div id="pane-existing" class="pane">
        <div class="notice">
          <span>🔄</span>
          <span>Registering for a new year or program with an existing CIN will auto-generate a <strong>new CIN</strong> for this enrollment, and a Welcome Mail will be dispatched.</span>
        </div>

        <div class="form-group">
          <label class="form-label">Your Existing CIN <span class="req">*</span></label>
          <div class="cin-input-wrap">
            <span class="cin-prefix">CIN</span>
            <input class="form-input" type="text" placeholder="2024-XXXXXX" id="existCin" maxlength="11">
          </div>
          <div class="input-hint">ℹ Your CIN from a previous year's registration</div>
        </div>

        <div class="form-group">
          <label class="form-label">Select New Program <span class="req">*</span></label>
          <select class="form-select" id="newProgram">
            <option value="">Choose active program</option>
            <option>MaRRS Spelling Bee 2025–26</option>
            <option>MaRRS Science Olympiad 2025–26</option>
            <option>MaRRS Mathematics Challenge 2025–26</option>
            <option>MaRRS General Knowledge Quiz 2025–26</option>
          </select>
        </div>

        <div class="toggle-row" onclick="toggleCode2()">
          <label>I have a School Access Code</label>
          <div class="toggle-switch" id="codeToggle2"></div>
        </div>
        <div id="accessCodeField2" style="display:none; margin-bottom:1.1rem;">
          <label class="form-label">School Access Code</label>
          <input class="form-input" type="text" placeholder="e.g. SCH-2025-DELHI-001" style="font-family:'DM Mono',monospace;letter-spacing:1px;">
        </div>

        <div id="alert-exist" class="alert"></div>

        <button class="btn-submit gold-btn" id="existBtn" onclick="handleExisting()">
          <div class="spinner"></div>
          <span class="btn-text">Generate New CIN & Proceed →</span>
        </button>
      </div>

      <!-- SUCCESS STATE (hidden initially) -->
      <div id="pane-success" class="pane">
        <div class="cin-display">
          <div class="cin-display-label">🎉 Your CIN (Candidate ID)</div>
          <div class="cin-number" id="generatedCin">CIN-2025-839472</div>
          <div class="cin-name" id="studentName">Arjun Sharma · MaRRS Spelling Bee 2025–26</div>
        </div>

        <div class="mail-preview">
          <div class="mail-header">
            <div class="mail-dot" style="background:#ff5f57;"></div>
            <div class="mail-dot" style="background:#ffbd2e;"></div>
            <div class="mail-dot" style="background:#28ca41;"></div>
            <div class="mail-title">✉ Welcome Mail Dispatched</div>
          </div>
          <div class="mail-body">
            <strong>Subject: Your MaRRS CIN & Login Details</strong><br><br>
            Dear <strong id="mailName">Arjun</strong>,<br><br>
            Welcome to MaRRS! Your Candidate Identification Number is:<br><br>
            <span class="mail-cin-tag" id="mailCin">CIN-2025-839472</span><br><br>
            Use this CIN to log in at the student portal and attempt your tests. 
            Keep it safe — you'll need it every time you log in.<br><br>
            <strong>Program:</strong> <span id="mailProgram">MaRRS Spelling Bee 2025–26</span><br>
            <strong>Status:</strong> ✅ Registration Confirmed
          </div>
        </div>

        <button class="btn-submit" onclick="goToLogin()">Login with CIN to Take Test →</button>
      </div>

    </div>
    <div class="card-footer" id="reg-footer">
      Already registered? <a href="#" onclick="showSection('login')">Login with your CIN</a>
    </div>
  </div>

  <!-- RIGHT CARD: CIN LOGIN & TEST/RESULTS -->
  <!--<div class="card">-->
  <!--  <div class="card-header">-->
  <!--    <div class="card-icon navy">🔑</div>-->
  <!--    <div>-->
  <!--      <div class="card-title">Login with CIN</div>-->
  <!--      <div class="card-subtitle">Attempt tests and view your scores</div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--  <div class="card-body" id="login-body">-->

  <!--    <div class="tab-bar">-->
  <!--      <button class="tab-btn active" onclick="switchLoginTab('login', this)">Login</button>-->
  <!--      <button class="tab-btn" onclick="switchLoginTab('results', this)">My Results</button>-->
  <!--    </div>-->

      <!-- LOGIN PANE -->
  <!--    <div id="lpane-login" class="pane active">-->

  <!--      <div id="alert-login" class="alert"></div>-->

  <!--      <div class="form-group">-->
  <!--        <label class="form-label">Your CIN <span class="req">*</span></label>-->
  <!--        <div class="cin-input-wrap">-->
  <!--          <span class="cin-prefix">CIN</span>-->
  <!--          <input class="form-input" type="text" placeholder="2025-XXXXXX" id="loginCin" maxlength="11">-->
  <!--        </div>-->
  <!--      </div>-->

  <!--      <div class="form-group">-->
  <!--        <label class="form-label">Date of Birth <span class="req">*</span></label>-->
  <!--        <input class="form-input" type="date" id="loginDob">-->
  <!--        <div class="input-hint">ℹ Used to verify your identity</div>-->
  <!--      </div>-->

  <!--      <div class="divider">OR</div>-->

  <!--      <div class="form-group">-->
  <!--        <label class="form-label">Registered Email</label>-->
  <!--        <input class="form-input" type="email" placeholder="student@email.com" id="loginEmail">-->
  <!--      </div>-->

  <!--      <button class="btn-submit" id="loginBtn" onclick="handleLogin()">-->
  <!--        <div class="spinner"></div>-->
  <!--        <span class="btn-text">🔐 Login to Portal</span>-->
  <!--      </button>-->

  <!--      <div class="divider">First time?</div>-->

  <!--      <div class="step-list">-->
  <!--        <div class="step-item">-->
  <!--          <div class="step-num">1</div>-->
  <!--          <div class="step-content">-->
  <!--            <p>Register & Pay</p>-->
  <!--            <span>Complete the form on the left to enroll</span>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--        <div class="step-item">-->
  <!--          <div class="step-num">2</div>-->
  <!--          <div class="step-content">-->
  <!--            <p>Receive CIN via Email</p>-->
  <!--            <span>Auto-generated instantly after payment</span>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--        <div class="step-item">-->
  <!--          <div class="step-num">3</div>-->
  <!--          <div class="step-content">-->
  <!--            <p>Login & Attempt Test</p>-->
  <!--            <span>Use CIN + DOB to access your test</span>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--        <div class="step-item">-->
  <!--          <div class="step-num">4</div>-->
  <!--          <div class="step-content">-->
  <!--            <p>View Results</p>-->
  <!--            <span>Check scores and download report card</span>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->

      <!-- RESULTS PANE (shown after login) -->
  <!--    <div id="lpane-results" class="pane">-->
  <!--      <div class="cin-display" style="margin-bottom:1.25rem;">-->
  <!--        <div class="cin-display-label">Logged in as</div>-->
  <!--        <div class="cin-number" style="font-size:1.1rem;" id="loggedCin">CIN-2025-839472</div>-->
  <!--        <div class="cin-name" id="loggedName">Arjun Sharma</div>-->
  <!--      </div>-->

  <!--      <div style="font-size:0.8rem;font-weight:600;color:var(--muted);letter-spacing:1px;text-transform:uppercase;margin-bottom:0.75rem;">📊 Your Test Results</div>-->

  <!--      <div class="score-card">-->
  <!--        <div class="score-meta">-->
  <!--          <p>MaRRS Spelling Bee 2025</p>-->
  <!--          <span>Round 1 · 12 Jan 2025</span>-->
  <!--          <div class="progress-bar"><div class="progress-fill" style="width:88%"></div></div>-->
  <!--        </div>-->
  <!--        <div class="score-badge">88%</div>-->
  <!--      </div>-->

  <!--      <div class="score-card">-->
  <!--        <div class="score-meta">-->
  <!--          <p>MaRRS Science Olympiad 2024</p>-->
  <!--          <span>Final Round · 3 Mar 2024</span>-->
  <!--          <div class="progress-bar"><div class="progress-fill" style="width:72%"></div></div>-->
  <!--        </div>-->
  <!--        <div class="score-badge avg">72%</div>-->
  <!--      </div>-->

  <!--      <div class="score-card">-->
  <!--        <div class="score-meta">-->
  <!--          <p>MaRRS Mathematics 2024</p>-->
  <!--          <span>Qualifier · 20 Oct 2023</span>-->
  <!--          <div class="progress-bar"><div class="progress-fill" style="width:95%"></div></div>-->
  <!--        </div>-->
  <!--        <div class="score-badge">95%</div>-->
  <!--      </div>-->

  <!--      <div style="display:flex;gap:8px;margin-top:0.25rem;">-->
  <!--        <button class="btn-submit" style="background:var(--navy);">📥 Download Report Card</button>-->
  <!--        <button class="btn-submit gold-btn" style="flex:0.5;" onclick="attemptTest()">🖊 Take Test</button>-->
  <!--      </div>-->

  <!--      <div style="text-align:center;margin-top:1rem;">-->
  <!--        <a href="#" onclick="logout()" style="font-size:0.78rem;color:var(--muted);text-decoration:none;">← Logout</a>-->
  <!--      </div>-->
  <!--    </div>-->

  <!--  </div>-->
  <!--  <div class="card-footer">-->
  <!--    Need help? <a href="#">Contact Support</a> or email <a href="#">admin@marrs.in</a>-->
  <!--  </div>-->
  <!--</div>-->

</div>

<script>
  // ── UTILS ──
  function genCin() {
    const y = new Date().getFullYear();
    const n = Math.floor(100000 + Math.random() * 900000);
    return `CIN-${y}-${n}`;
  }

  function showAlert(id, type, msg) {
    const el = document.getElementById(id);
    el.className = `alert ${type} show`;
    el.innerHTML = (type === 'success' ? '✅ ' : '❌ ') + msg;
    setTimeout(() => el.className = `alert ${type}`, 4000);
  }

  function setLoading(btnId, on) {
    const btn = document.getElementById(btnId);
    btn.classList.toggle('loading', on);
    btn.disabled = on;
  }

  // ── TAB SWITCHING ──
  function switchTab(tab, el) {
    ['new','existing','success'].forEach(t => {
      document.getElementById('pane-' + t).classList.remove('active');
    });
    document.getElementById('pane-' + tab).classList.add('active');
    document.querySelectorAll('.tab-bar')[0].querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
  }

  function switchLoginTab(tab, el) {
    ['login','results'].forEach(t => {
      document.getElementById('lpane-' + t).classList.remove('active');
    });
    document.getElementById('lpane-' + tab).classList.add('active');
    document.querySelectorAll('.tab-bar')[1].querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
  }

  // ── TOGGLES ──
  let codeOn = false, code2On = false;
  function toggleCode() {
    codeOn = !codeOn;
    document.getElementById('codeToggle').classList.toggle('on', codeOn);
    document.getElementById('accessCodeField').style.display = codeOn ? 'block' : 'none';
  }
  function toggleCode2() {
    code2On = !code2On;
    document.getElementById('codeToggle2').classList.toggle('on', code2On);
    document.getElementById('accessCodeField2').style.display = code2On ? 'block' : 'none';
  }

  // ── PAYMENT SELECT ──
  function selectPay(el) {
    document.querySelectorAll('.pay-option').forEach(p => p.classList.remove('selected'));
    el.classList.add('selected');
  }

  // ── REGISTER ──
  function handleRegister() {
    const fn = document.getElementById('fn').value.trim();
    const ln = document.getElementById('ln').value.trim();
    const email = document.getElementById('email').value.trim();
    const grade = document.getElementById('grade').value;
    const program = document.getElementById('program').value;

    if (!fn || !ln || !email || !grade || !program) {
      showAlert('alert-reg', 'error', 'Please fill in all required fields.');
      return;
    }

    setLoading('regBtn', true);
    setTimeout(() => {
      setLoading('regBtn', false);
      const cin = genCin();
      document.getElementById('generatedCin').textContent = cin;
      document.getElementById('studentName').textContent = `${fn} ${ln} · ${program}`;
      document.getElementById('mailName').textContent = fn;
      document.getElementById('mailCin').textContent = cin;
      document.getElementById('mailProgram').textContent = program;

      // Switch to success pane
      document.getElementById('pane-new').classList.remove('active');
      document.getElementById('pane-success').classList.add('active');
      document.querySelectorAll('.tab-bar')[0].querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    }, 1800);
  }

  // ── EXISTING CIN ──
  function handleExisting() {
    const cin = document.getElementById('existCin').value.trim();
    const prog = document.getElementById('newProgram').value;

    if (!cin || !prog) {
      showAlert('alert-exist', 'error', 'Please enter your CIN and select a program.');
      return;
    }

    setLoading('existBtn', true);
    setTimeout(() => {
      setLoading('existBtn', false);
      const newCin = genCin();
      document.getElementById('generatedCin').textContent = newCin;
      document.getElementById('studentName').textContent = `Existing Student · ${prog}`;
      document.getElementById('mailName').textContent = 'Student';
      document.getElementById('mailCin').textContent = newCin;
      document.getElementById('mailProgram').textContent = prog;

      document.getElementById('pane-existing').classList.remove('active');
      document.getElementById('pane-success').classList.add('active');
      document.querySelectorAll('.tab-bar')[0].querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    }, 1800);
  }

  // ── LOGIN ──
  function handleLogin() {
    const cin = document.getElementById('loginCin').value.trim();
    const dob = document.getElementById('loginDob').value;
    const email = document.getElementById('loginEmail').value.trim();

    if (!cin || (!dob && !email)) {
      showAlert('alert-login', 'error', 'Enter your CIN and Date of Birth (or email).');
      return;
    }

    setLoading('loginBtn', true);
    setTimeout(() => {
      setLoading('loginBtn', false);
      const fullCin = 'CIN-' + cin;
      document.getElementById('loggedCin').textContent = fullCin;
      document.getElementById('loggedName').textContent = 'Welcome back, Student';

      document.getElementById('lpane-login').classList.remove('active');
      document.getElementById('lpane-results').classList.add('active');
      document.querySelectorAll('.tab-bar')[1].querySelectorAll('.tab-btn')[0].classList.remove('active');
      document.querySelectorAll('.tab-bar')[1].querySelectorAll('.tab-btn')[1].classList.add('active');
    }, 1600);
  }

  function goToLogin() {
    const cin = document.getElementById('generatedCin').textContent.replace('CIN-','').split('-').slice(1).join('-');
    document.getElementById('loginCin').value = cin;
    document.getElementById('lpane-login').classList.add('active');
    document.getElementById('lpane-results').classList.remove('active');
    document.querySelectorAll('.tab-bar')[1].querySelectorAll('.tab-btn').forEach((b,i) => b.classList.toggle('active', i===0));
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  function logout() {
    document.getElementById('loginCin').value = '';
    document.getElementById('loginDob').value = '';
    document.getElementById('loginEmail').value = '';
    document.getElementById('lpane-results').classList.remove('active');
    document.getElementById('lpane-login').classList.add('active');
    document.querySelectorAll('.tab-bar')[1].querySelectorAll('.tab-btn').forEach((b,i) => b.classList.toggle('active', i===0));
  }

  function attemptTest() {
    alert('Redirecting to test environment… (in production this would open the timed test interface)');
  }

  function showSection(s) {
    if (s === 'login') {
      document.querySelector('.card:last-child').scrollIntoView({ behavior: 'smooth' });
    }
  }
</script>

</body>
</html>