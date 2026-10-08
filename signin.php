<?php include('headertest.php');

// echo 'sadsasa';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
?>
<?php
$year = date('Y');
$next = $year + 1;
?>

<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--  <meta charset="UTF-8"/>-->
<!--  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Nunito:wght@400;600;700;800&display=swap");
    *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
    /*body { font-family:"Nunito",sans-serif; min-height:100vh;  }*/
    .main {
  display:flex;
  justify-content:center;
  align-items:center;
  min-height: calc(100vh - 150px); /* header + footer space */
  padding:10px;
}
    .card { display:flex; flex-direction:row; width:1024px; max-width:100%; min-height:560px; border-radius:24px; overflow:hidden; 
    /*box-shadow:0 30px 80px rgba(0,0,0,.35); */
        
    }

    /* LEFT #F57C35*/
    .left { flex:1; display:flex; flex-direction:column; justify-content:center; padding:28px 32px; position:relative; overflow:hidden; min-width:0; }
    .left::before { content:""; position:absolute; inset:0; background:#355bf5; z-index:0; }
    .left::after  { content:""; position:absolute; inset:0;
      background: radial-gradient(ellipse 70% 80% at 15% 50%,rgba(255,255,255,.13) 0%,transparent 65%),
                  radial-gradient(ellipse 50% 60% at 90% 15%,rgba(255,255,255,.08) 0%,transparent 55%),
                  radial-gradient(ellipse 40% 50% at 80% 90%,rgba(180,60,0,.28) 0%,transparent 60%);
      pointer-events:none; z-index:0; }
    .ldg  { position:absolute; inset:0; pointer-events:none; z-index:1; background-image:radial-gradient(circle,rgba(255,255,255,.18) 1px,transparent 1px); background-size:26px 26px; }
    .lstr { position:absolute; inset:0; pointer-events:none; z-index:1; background-image:repeating-linear-gradient(-55deg,rgba(255,255,255,.04) 0,rgba(255,255,255,.04) 1px,transparent 0,transparent 30px); }
    .orb  { position:absolute; border-radius:50%; pointer-events:none; z-index:2; animation:orbFloat linear infinite; }
    .orb-1 { width:360px; height:360px; top:-140px; left:-80px; animation-duration:18s; background:radial-gradient(circle,rgba(255,255,255,.13) 0%,transparent 70%); }
    .orb-2 { width:260px; height:260px; bottom:-70px; right:-50px; animation-duration:22s; animation-direction:reverse; background:radial-gradient(circle,rgba(180,55,0,.32) 0%,transparent 70%); }
    .orb-3 { width:190px; height:190px; top:42%; left:30%; animation-duration:14s; background:radial-gradient(circle,rgba(255,255,255,.09) 0%,transparent 70%); }
    @keyframes orbFloat { 0%{transform:translate(0,0) scale(1);} 33%{transform:translate(14px,-10px) scale(1.03);} 66%{transform:translate(-10px,14px) scale(.97);} 100%{transform:translate(0,0) scale(1);} }
    .lgrain { position:absolute; inset:0; pointer-events:none; z-index:3; opacity:.03;
      background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); }
    .left > *:not(.ldg):not(.lstr):not(.orb):not(.lgrain) { position:relative; z-index:4; }

    /*.left-tagline { font-size:11px; color:#000; text-align:center; letter-spacing:.04em; }*/
    .left-tagline {
    font-size: 18px;
    font-weight: 600;
    color: #ffffff;
    text-align: center;
    letter-spacing: 0.08em;
    text-transform: none;

    /* Smooth glow shadow */
    text-shadow: 0 0 6px rgba(255,255,255,0.6),
                 0 0 12px rgba(255, 122, 24, 0.6),
                 0 0 18px rgba(255, 122, 24, 0.4);

    /* Animation */
    animation: glowPulse 2s ease-in-out infinite alternate;
}

/* Glow animation */
@keyframes glowPulse {
    0% {
        text-shadow: 0 0 4px rgba(255,255,255,0.5),
                     0 0 8px rgba(255, 122, 24, 0.4),
                     0 0 12px rgba(255, 122, 24, 0.3);
    }
    100% {
        text-shadow: 0 0 8px rgba(255,255,255,0.9),
                     0 0 18px rgba(255, 122, 24, 0.8),
                     0 0 26px rgba(255, 122, 24, 0.6);
    }
}
    .left-center  { text-align:center; }
    .badge { display:inline-flex; align-items:center; gap:7px; background:rgba(255,255,255,.18); border:1px solid rgba(255,255,255,.35); border-radius:999px; padding:15px 20px; margin-bottom:22px; }
    .badge-dot { width:8px; height:8px; background:#fff; border-radius:50%; animation:pulse 1.8s infinite; }
    @keyframes pulse { 0%,100%{opacity:1}50%{opacity:.4} }
    .badge span { font-size:13px; font-weight:700; color:#fff; letter-spacing:.08em; text-transform:uppercase; }
    .hero-title { font-family:"Playfair Display",serif; font-size:38px; font-weight:800; color:#fff; line-height:1.15; margin-bottom:16px; text-shadow:0 2px 16px rgba(140,40,0,.3); }
    .hero-title .accent { color:#111827; }
    .hero-sub { font-size:16px; color:rgba(255,255,255,.85); font-weight:600; line-height:1.6; max-width:300px; margin:0 auto; }
.hero-image{
    margin: 20px 0;
    text-align: center;
}

.hero-image img{
    width: 200px;
    height: 200px;
    border-radius: 10%;
    object-fit: cover;
    border: 0px solid #fff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}
  
/* KEEP THIS */
.photos-carousel {
  width: 100%;
  overflow: visible;
  position: relative;
}

.photos-track {
  display: flex;
  gap: 12px;
  width: max-content;
  animation: scrollPhotos 12s linear infinite;
  align-items: center;
}

/* ðŸ”¥ MAIN CARD */
.photo-box {
  width: 140px;
  height: 88px;
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-template-rows: 1fr 1fr;
  gap: 2px;
  border: 2px solid rgba(255,255,255,.2);
  flex-shrink: 0;

  position: relative;
  transition: transform 0.35s ease, box-shadow 0.35s ease;
}

/* ðŸ”¥ POP OUT EFFECT */
.photo-box:hover {
  transform: translateY(-18px) scale(1.35);
  z-index: 20;
  box-shadow: 
    0 20px 40px rgba(0,0,0,0.45),
    0 0 0 2px rgba(255,255,255,0.15);
}

/* ðŸ”¥ PREVENT NEIGHBOR CUT */
.photos-track:hover .photo-box {
  transform: scale(0.95);
  opacity: 0.6;
}

.photos-track .photo-box:hover {
  transform: translateY(-18px) scale(1.35);
  opacity: 1;
}
/* ðŸ”¥ STOP SLIDING WHEN HOVER */
.photos-carousel:hover .photos-track {
  animation-play-state: paused;
}
.photo-cell {
  position: relative;
  overflow: hidden;
}

/* ðŸ”¥ FIX IMAGE FIT */
.photo-cell img {
  width: 100%;
  height: 100%;
  object-fit: cover;   /* fills nicely without distortion */
  display: block;
}
/* AUTO SCROLL ANIMATION */
@keyframes scrollPhotos {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}
    /* RIGHT */
    .right { width:480px; flex-shrink:0; background:#fff; display:flex; flex-direction:column; justify-content:center; padding:36px 44px; }
    /* MOBILE FIX */
@media (max-width: 768px) {

  .main {
    padding: 15px;
    align-items: flex-start; /* prevent vertical overflow */
  }

  .card {
    flex-direction: column;
    width: 100%;
    min-height: auto;   /* 🔥 REMOVE fixed height */
    border-radius: 16px;
  }

  /* LEFT SECTION */
  .left {
    padding: 22px 16px;
  }

  .hero-title {
    font-size: 26px; /* smaller heading */
  }

  .hero-sub {
    font-size: 14px;
    max-width: 100%;
  }

  .hero-image img {
    width: 140px;
    height: 140px;
  }

 

  /* PHOTO CAROUSEL FIX */
  .photo-box {
    width: 110px;
    height: 70px;
  }

  /* 🔥 VERY IMPORTANT (prevents overflow cut) */
  .photos-carousel {
    overflow: hidden;
  }

  /* RIGHT SECTION */
  .right {
    width: 100%;
    padding: 24px 18px;
  }

  .welcome-title {
    font-size: 24px;
  }

  .input-field {
    padding: 12px 14px 12px 40px;
    font-size: 13px;
  }

  .primary-btn {
    padding: 13px;
    font-size: 14px;
  }

  .search-cin-btn {
    font-size: 13px;
  }
}
    /*.welcome-title { font-family:"Playfair Display",serif; font-size:32px; font-weight:800; color:#18202e; margin-bottom:6px; }*/
    /*.welcome-sub   { font-size:13px; color:#8a95a3; margin-bottom:24px; }*/
 .welcome-title {
  font-family: 'Poppins', sans-serif;
  font-size: 34px;
  font-weight: 800;
  background: linear-gradient(90deg, #f57c35, #ff9a3c);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 8px;
}

.welcome-sub {
  font-size: 14px;
  color: #64748b;
  margin-bottom: 26px;
  font-weight: 500;
}
    .tab-row  { display:flex; background:#f1f3f6; border-radius:12px; padding:4px; margin-bottom:24px; }
    .tab-btn  { flex:1; padding:10px; border-radius:9px; border:none; background:transparent; font-family:"Nunito",sans-serif; font-size:14px; font-weight:700; color:#8a95a3; cursor:pointer; transition:all .2s; }
    .tab-btn.active { background:#fff; color:#18202e; box-shadow:0 2px 8px rgba(0,0,0,.1); }
    .panel { display:none; }
    .panel.active { display:block; }
    .login-using-label {
  font-size: 13px;
  color: #334155;
  margin-bottom: 12px;
  font-weight: 600;
}
    .method-row { display:flex; gap:8px; margin-bottom:20px; }
    .method-btn { padding: 8px 18px; border-radius: 999px; border: 1.5px solid #cbd5e1; background: #fff; font-size: 13px; font-weight: 700; color: #334155; transition: all 0.2s ease; } 
    .method-btn.active { border-color: #f57c35; color: #f57c35; background: rgba(245,124,53,0.08); }
    .input-group { position:relative; margin-bottom:14px; }
    .input-icon  { position:absolute; left:14px; top:50%; transform:translateY(-50%); width:17px; height:17px; color:#b0bac6; pointer-events:none; }
    .input-field { width:100%; padding:13px 16px 13px 42px; border-radius:0px; border:1.5px solid #e2e8f0; background:#f7f8fa; font-family:"Nunito",sans-serif; font-size:14px; color:#18202e; outline:none; transition:border-color .15s,box-shadow .15s; }
    .input-field::placeholder { color:#b0bac6; }
    .input-field:focus { border-color:#F57C35; background:#fff; box-shadow:0 0 0 3px rgba(245,124,53,.1); }
    .eye-icon { position:absolute; right:14px; top:50%; transform:translateY(-50%); width:18px; height:18px; color:#b0bac6; cursor:pointer; }
    .forgot-row  { text-align:right; margin-bottom:18px; margin-top:-6px; }
    .forgot-link { font-size:13px; font-weight:700; color:#f57c35; text-decoration:none; cursor:pointer; }
    .primary-btn { width:100%; padding:14px; background:#F57C35; border:none; border-radius:12px; color:#fff; font-family:"Nunito",sans-serif; font-size:15px; font-weight:800; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:12px; transition:background .15s,transform .1s; letter-spacing:.01em; }
    .primary-btn:hover  { background:#d9621a; transform:translateY(-1px); }
    .primary-btn:active { transform:translateY(0); }
    .search-cin-btn { width:100%; padding:13px; background:#fff; border:1.5px solid #e2e8f0; border-radius:12px; color:#3a4a5a; font-family:"Nunito",sans-serif; font-size:14px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:18px; transition:border-color .15s,background .15s; text-decoration:none; }
    .search-cin-btn:hover { border-color:#b0bac6; background:#f7f8fa; }
    .safe-row { display:flex; align-items:center; gap:8px; }
    .safe-icon { width:18px; height:18px; color:#2563eb; flex-shrink:0; }
    .safe-text { font-size:13px; color:#475569; font-weight:600; }
    
  </style>
<!--</head>-->
<!--<body>-->
<div class="main">
<div class="card">

  <!-- LEFT -->
  <div class="left">
    <div class="ldg"></div><div class="lstr"></div>
    <div class="orb orb-1"></div><div class="orb orb-2"></div><div class="orb orb-3"></div>
    <div class="lgrain"></div>

    <div class="left-tagline my-3">Home to tomorrow's Brilliance!</div>

    <div class="left-center my-3">
      <div class="badge"><div class="badge-dot"></div><span>Now Enrolling for <?= $year ?>&ndash;<?= $next ?></span></div>
      <!-- ROUND IMAGE HERE -->
      <div class="hero-image">
      <img src="https://marrs.in/newassets/slide/winner.jpg" alt="Learning">
      </div>
      
      <div class="hero-title">Because <span class="accent">First Steps</span><br/>Last!</div>
      <div class="hero-sub">"Inspiring independent learning through a spirit of healthy competition"</div>
    </div>

   
  </div>

  <!-- RIGHT -->
  <div class="right">
    <div class="welcome-title" id="panelTitle">Welcome back</div>
    <div class="welcome-sub"  id="panelSub">Sign in or create your account below</div>

    <div class="tab-row">
      <button class="tab-btn active" id="tabSignIn"   onclick="switchTab('signin')">Sign In</button>
      <button class="tab-btn"        id="tabRegister" onclick="switchTab('register')">Register</button>
    </div>

    <!-- SIGN IN -->
    <div class="panel active" id="panelSignin">
      <div class="login-using-label">Login using:</div>
      <div class="method-row">
        <button class="method-btn"        onclick="setMethod(this,'Enter your PRID','text')">PRID</button>
        <button class="method-btn active"        onclick="setMethod(this,'Enter your CIN','text')">CIN</button>
        <!--<button class="method-btn " onclick="setMethod(this,'Enter your Email ID','email')">Email ID</button>-->
      </div>
      <form method="post" action="<?php echo 'https://marrsdev.marrs.in/student_registration/loginDashboard';?>">
        <div class="input-group">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          <input class="input-field" id="signinCodeInput" type="text" name="code" placeholder="Enter your CIN" autocomplete="off"/>
        </div>
        <div class="input-group">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
          <input class="input-field" type="password" name="password" placeholder="Password" id="signinPwd" autocomplete="off"/>
          <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" onclick="togglePwd('signinPwd')"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        <div class="forgot-row"><a href="#" class="forgot-link">Forgot Access Details?</a></div>
        <button type="submit" name="submit" class="primary-btn">
          Sign In <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </form>
      <a href="<?php echo 'https://marrs.in/student_registration/search_cin';?>" class="search-cin-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.35-4.35"/></svg>
        Search Your CIN
      </a>
      <div class="safe-row">
        <svg class="safe-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L4 5v6.5C4 16.31 7.47 20.88 12 22c4.53-1.12 8-5.69 8-10.5V5l-8-3z"/></svg>
        <span class="safe-text">Your data is safe and secure with us</span>
      </div>
    </div>

    <!-- REGISTER -->
    <div class="panel" id="panelRegister">
  <div class="login-using-label">Register using:</div>

  <div class="method-row">
    <button class="method-btn active" id="regMethodAccessCode" onclick="setRegMethod('accesscode')">Access Code</button>
    <button class="method-btn" id="regMethodEmail" onclick="setRegMethod('email')">Email ID</button>
  </div>

  <!-- ACCESS CODE -->
  <div id="regAccessCode">
    <form method="post" action="<?php echo 'https://marrsdev.marrs.in/student_registration/welcome/current_registration';?>">

      <div class="input-group">
        <!-- LOCK ICON -->
        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="11" width="18" height="10" rx="2"/>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>

        <input class="input-field" type="text" name="access_code" placeholder="Enter Access Code" autocomplete="off"/>
      </div>


      <button type="submit" class="primary-btn">
        Register
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M5 12h14M13 6l6 6-6 6"/>
        </svg>
      </button>

    </form>
  </div>

  <!-- EMAIL REGISTRATION -->
  <div id="regEmail" style="display:none;">
    <form method="post" action="<?php echo 'https://marrsdev.marrs.in/student_registration/welcome/current_registration';?>">

      <div class="input-group">
        <!-- EMAIL ICON -->
        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="5" width="18" height="14" rx="2"/>
          <path d="M3 7l9 6 9-6"/>
        </svg>

        <input class="input-field" type="email" name="email" placeholder="Enter Email ID" autocomplete="off"/>
      </div>

      <button type="submit" class="primary-btn">
        Continue
      </button>

    </form>
  </div>

</div>
</div>
</div>
</div>
<script>
function switchTab(tab) {
  document.getElementById("panelSignin").classList.toggle("active", tab === "signin");
  document.getElementById("panelRegister").classList.toggle("active", tab === "register");

  document.getElementById("tabSignIn").classList.toggle("active", tab === "signin");
  document.getElementById("tabRegister").classList.toggle("active", tab === "register");
}

function setMethod(btn, placeholder, type) {
  document.querySelectorAll(".method-btn").forEach(b => b.classList.remove("active"));
  btn.classList.add("active");

  const input = document.getElementById("signinCodeInput");
  input.placeholder = placeholder;
  input.type = type;
}

function setRegMethod(type) {
  document.getElementById("regAccessCode").style.display = (type === "accesscode") ? "block" : "none";
  document.getElementById("regEmail").style.display = (type === "email") ? "block" : "none";

  document.getElementById("regMethodAccessCode").classList.toggle("active", type === "accesscode");
  document.getElementById("regMethodEmail").classList.toggle("active", type === "email");
}

function togglePwd(id) {
  const input = document.getElementById(id);
  input.type = input.type === "password" ? "text" : "password";
}
</script>
<script>
  function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  window.onload = function () {
    const tab = getQueryParam('tab');

    if (tab === 'register') {
      switchTab('register');
    } else {
      switchTab('signin'); // default
    }
  };
</script>
<?php include('footertest.php');?>

