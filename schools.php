<?php include('headertest.php'); ?>

<?php
// Optional: keep your bot check if needed
function google() {
    $agents = array("Googlebot", "Google-Site-Verification", "Google-InspectionTool", "Googlebot-Mobile", "Googlebot-News");
    foreach ($agents as $agent) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) return true;
    }
    return false;
}
?>

<style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
        }
        /* ===== CTA SECTION ===== */
/*.cta-section {*/
/*    background: linear-gradient(135deg, #fff8e1, #ffffff);*/
/*}*/

.cta-box {
    background: #fff;
    padding: 40px 20px;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}


/* BUTTON GROUP */
.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

/* BUTTON STYLE */
.cta-btn {
    padding: 10px 22px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* COLORS */
.cta-btn.enroll,
.cta-buttons .btn-primary {
    background: linear-gradient(135deg, #ffb703, #fb8500);
    border: none;
    color: #fff;
}
.cta-btn.register,
.cta-buttons .btn-success {
    background: linear-gradient(135deg, #3a86ff, #2667ff);
    border: none;
    color: #fff;
}
.cta-btn.about,
.cta-buttons .btn-dark {
    background: linear-gradient(135deg,#FFEB3B,#FF5722);
    border: none;
    color: #fff;
}

/* HOVER EFFECT */

.cta-buttons .btn {
    font-size: 20px;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.cta-buttons a.btn {
    transition: all 0.25s ease;
}

.cta-buttons a.btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    filter: brightness(1.05);
}

/* TEXT STYLING */
.cta-title {
    font-size: 32px;
    font-weight: 700;
    color: #222;
    letter-spacing: 0.5px;
    position: relative;
    display: inline-block;
}

/* Underline accent */
.cta-title::after {
    content: "";
    width: 60px;
    height: 4px;
    background: #0d6efd;
    display: block;
    margin: 5px auto 0;
    border-radius: 2px;
}

.cta-subtitle {
    font-size: 20px;
    color: #666;
    max-width: 600px;
    margin: 5px auto 0;
    line-height: 1.6;
}
/* ICON STYLE */
.cta-btn i {
    font-size: 20px;
    transition: transform 0.3s ease;
}

/* ICON ANIMATION ON HOVER */
.cta-btn:hover i {
    transform: translateX(4px);
}
/* MOBILE OPTIMIZATION */
@media (max-width: 768px) {
    .cta-title {
        font-size: 24px;
    }

    .cta-subtitle {
        font-size: 14px;
        padding: 0 10px;
    }
}
    </style>
<style>
  /**, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }*/

  :root {
    --blue: #1a7fdb;
    --blue-dark: #0d5fa8;
    --blue-light: #e8f4fd;
    --blue-pale: #cce6f8;
    --orange: #e8650a;
    --red: #c0392b;
    --gray: #4a5568;
    --gray-light: #8898aa;
    --white: #ffffff;
    --slide-w: 960px;
    --slide-h: 540px;
  }

  /*body {*/
  /*  background: #0e1a2b;*/
  /*  font-family: 'Lato', sans-serif;*/
  /*  display: flex;*/
  /*  flex-direction: column;*/
  /*  align-items: center;*/
  /*  justify-content: flex-start;*/
  /*  min-height: 100vh;*/
  /*  padding: 24px 16px 60px;*/
  /*  gap: 20px;*/
  /*  overflow-x: hidden;*/
  /*}*/

  /* ── TOP BAR ── */
  .topbar {
    width: 100%;
    max-width: var(--slide-w);
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #ffffff88;
    font-size: 13px;
    letter-spacing: .06em;
    font-family: 'Montserrat', sans-serif;
  }
  .topbar .brand { color: #fff; font-weight: 700; font-size: 15px; letter-spacing: .1em; }

  /* ── STAGE ── */
  .stage {
    width: 100%;
    max-width: var(--slide-w);
    aspect-ratio: 16/9;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 30px 80px #00000080, 0 0 0 1px #ffffff10;
  }

  /* Fixed-size inner canvas that gets CSS-scaled to fit */
  .slide-canvas {
    position: absolute;
    top: 0; left: 0;
    width: 960px;
    height: 540px;
    transform-origin: top left;
  }

  /* ── SLIDES ── */
  .slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    pointer-events: none;
    transition: opacity .45s cubic-bezier(.4,0,.2,1);
    font-family: 'Lato', sans-serif;
  }
  .slide.active {
    opacity: 1;
    pointer-events: all;
  }

  /* shared slide canvas */
  .slide-inner {
    width: 100%;
    height: 100%;
    position: relative;
    overflow: hidden;
  }

  /* ── BACKGROUNDS ── */
  .bg-white { background: #ffffff; }
  .bg-gradient { background: linear-gradient(160deg, #e8f4fd 0%, #cce6f8 60%, #b0d8f5 100%); }
  .bg-hero { background: #f0f8ff; }

  /* ── LOGO COMPONENT ── */
  .logo-badge img{
    height: 55px;
  }
  
  .logo-tagline {
    font-size: 7px;
    letter-spacing: .06em;
    color: #555;
    text-transform: uppercase;
    display: block;
    margin-top: 1px;
  }
  .logo-sep { width: 1px; height: 30px; background: #aaa; margin: 0 4px; }

  /* ── HEADER BAR (content slides) ── */
  .slide-header {
    position: absolute;
    top: 0; left: 0; right: 0;
    padding: 14px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255,255,255,.9);
    backdrop-filter: blur(6px);
    border-bottom: 2px solid var(--blue-pale);
    z-index: 10;
  }
  .slide-title-chip {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .arrow-chip {
    width: 0; height: 0;
    border-top: 18px solid transparent;
    border-bottom: 18px solid transparent;
    border-left: 22px solid var(--blue);
    flex-shrink: 0;
  }
  .slide-title-chip h2 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 17px;
    color: var(--blue);
  }
  .logo-sm { transform: scale(.72); transform-origin: right center; }

  /* ── DECORATIVE CIRCLES ── */
  .deco-circle {
    position: absolute;
    border-radius: 50%;
    background: var(--blue-pale);
    opacity: .35;
    pointer-events: none;
  }

  /* ── TOP BLUE BAR ── */
  .top-accent { position: absolute; top: 0; left: 25%; right: 10%; height: 4px; background: var(--blue); }
  .bottom-accent { position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: var(--blue); }

  /* ── CONTENT AREA ── */
  .content-area {
    position: absolute;
    top: 64px; bottom: 0; left: 0; right: 0;
    padding: 28px 36px 24px;
  }

  /* ── TWO-COLUMN ── */
  .two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    height: 100%;
    align-items: center;
  }
  .two-col-left { display: flex; flex-direction: column; gap: 22px; }

  /* ── TEXT BLOCKS ── */
  .section-label {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 18px;
    color: var(--blue);
    text-transform: uppercase;
    letter-spacing: .1em;
    margin-bottom: 6px;
  }
  .body-text {
    font-size: 15px;
    line-height: 1.7;
    color: var(--gray);
  }

  /* ── IMAGE FRAME ── */
  .img-frame {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 30px #1a7fdb22;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .img-frame img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
  }

  /* ── HERO SLIDE 1 ── */
  .hero-photo {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 44%;
    overflow: hidden;
  }
  .hero-photo-bg {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, #5b9bd5 0%, #1a7fdb 50%, #0d5fa8 100%);
/*background-image: url("https://marrs.in/newassets/slide/SlideFrontImg.jpg");*/
/*background-size: cover;*/
/*background-position: center;*/
/*background-repeat: no-repeat;*/
display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
  }
  .hero-photo-bg::after {
    content: '';
    position: absolute;
    right: -30px; top: 50%;
    transform: translateY(-50%);
    width: 80px; height: 80px;
    background: #fff;
    border-radius: 50%;
    opacity: .08;
  }
  .hero-clip {
    position: absolute;
    top: 0; right: -1px; bottom: 0;
    width: 60px;
    background: #f0f8ff;
    clip-path: polygon(60% 0, 100% 0, 100% 100%, 60% 100%, 0% 50%);
  }
  .building-svg {
    width: 75%;
    opacity: .6;
  }
  .hero-right {
    position: absolute;
    right: 0; top: 0; bottom: 0;
    left: 44%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: center;
    padding: 30px 36px 30px 30px;
    gap: 30px;
  }
  .hero-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 30px;
    color: var(--blue);
    text-align: right;
    line-height: 1.2;
  }
  .hero-dots {
    position: absolute;
    top: 16px; right: 18px;
    display: flex; gap: 6px;
  }
  .hero-dot { width: 8px; height: 8px; border-radius: 50%; }
  .hero-dot.filled { background: var(--blue); }
  .hero-dot.empty { border: 2px solid var(--blue); background: transparent; }
  .hero-deco-circles {
    position: absolute;
    bottom: 0; right: 0;
  }

  /* ── CONTENTS SLIDE ── */
  .contents-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 40px;
    margin-top: 8px;
  }
  .contents-item {
    display: flex;
    align-items: center;
    gap: 14px;
  }
  .contents-num {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 38px;
    color: var(--blue-pale);
    line-height: 1;
    min-width: 52px;
  }
  .contents-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--blue);
    flex-shrink: 0;
    margin-right: 4px;
  }
  .contents-label {
    font-size: 15px;
    font-weight: 600;
    color: var(--gray);
  }
  

  /* ── CHAPTER / PART SLIDE ── */
  .chapter-slide {
    background: linear-gradient(150deg, #deeeff 0%, #c5dff5 100%);
    width: 100%;
    height: 100%;
    display: flex;
    position: relative;
  }
  .chapter-left {
    width: 45%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 28px;
    flex-direction: column;
    gap: 10px;
  }
  .chapter-logo-big img{ height: 165px; }
  
  .chapter-right {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 28px 36px;
  }
  .part-label {
    font-family: 'Montserrat', sans-serif;
    font-weight: 300;
    font-size: 20px;
    color: var(--blue);
    letter-spacing: .3em;
    text-transform: uppercase;
    margin-bottom: 16px;
  }
  .part-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 300;
    font-size: 32px;
    color: #3a4a5c;
    text-align: center;
    line-height: 1.3;
  }

  /* ── TESTIMONIAL ── */
  .testimonial-image-bar {
    position: relative;
    height: 140px;
    background: linear-gradient(135deg, #c5dff5 0%, #aaccee 100%);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
  }
  .testimonial-image-bar .num-bubble {
    width: 48px; height: 48px;
    border-radius: 50%;
    background: var(--blue);
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 18px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .testimonial-cols {
  display: grid;
  grid-template-columns: 1fr 1fr; /* exactly 2 equal halves */
  gap: 24px;
  align-items: stretch;
}
.testimonial-card:first-child {
  border-right: 1px solid var(--blue-pale);
  padding-right: 16px;
}

.testimonial-card:last-child {
  padding-left: 16px;
}
  .testimonial-card { display: flex; flex-direction: column; gap: 8px; }
  .testi-heading {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 18px;
    color: var(--blue);
  }
  .testi-quote {
    font-size: 15px;
    line-height: 1.7;
    color: var(--gray);
    font-style: italic;
  }
  .testi-divider {
    width: 1px;
    background: var(--blue-pale);
    align-self: stretch;
    margin: 4px 0;
  }

  /* ── STAT CARD ── */
  .stat-strip {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
  }
  .stat-card {
    background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dark) 100%);
    border-radius: 10px;
    padding: 14px 18px;
    color: #fff;
    flex: 1;
  }
  .stat-num {
    font-family: 'Montserrat', sans-serif;
    font-weight: 900;
    font-size: 28px;
    line-height: 1;
  }
  .stat-label { font-size: 11px; opacity: .85; margin-top: 4px; }

  /* ── IMAGE-ONLY SLIDE ── */
  .img-only-slide {
    width: 100%; height: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    padding: 14px 20px 0 0;
    background: #f0f8ff;
    position: relative;
  }
  .img-only-slide .full-img {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    top: 70px;
    object-fit: cover;
    object-position: center top;
    width: 100%;
  }

  /* ── NAVIGATION ── */
  .nav {
    width: 100%;
    max-width: var(--slide-w);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
  }
 .nav-btn {
  background: #2563EB; /* modern blue */
  border: 1px solid #2563EB;
  color: #ffffff;
  font-family: 'Montserrat', sans-serif;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: .08em;
  padding: 10px 22px;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.nav-btn:hover {
  background: #1D4ED8; /* darker blue */
  border-color: #1D4ED8;
  transform: translateY(-1px);
}

.nav-btn:disabled {
  opacity: .4;
  cursor: not-allowed;
  transform: none;
}
  .dots-row {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    justify-content: center;
    flex: 1;
  }
  .dot-btn {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #9E9E9E;
    border: none;
    cursor: pointer;
    transition: background .2s, transform .2s;
    padding: 0;
  }
  .dot-btn.active { background: var(--blue); transform: scale(1.35); }
  .dot-btn:hover:not(.active) { background: #ffffff60; }

  .slide-counter {
    color: #ffffff66;
    font-size: 12px;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: .1em;
    flex-shrink: 0;
  }

  /* ── BLUE SQUARE DECOR ── */
  .blue-sq {
    position: absolute;
    background: var(--blue);
  }

  /* Fullscreen */
  .fs-btn {
    position: fixed;
    top: 16px; right: 16px;
    background: #ffffff15;
    border: 1px solid #ffffff25;
    color: #fff;
    padding: 8px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 13px;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: .06em;
    transition: background .2s;
    z-index: 100;
  }
  .fs-btn:hover { background: #1a7fdb55; }

  /* keyboard hint */
  .kb-hint {
    color: #ffffff30;
    font-size: 11px;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: .08em;
  }
</style>

<!-- Products Section -->
<section class="text-center mt-5">
    <div class="container">
        <a href="/addschool.php">
            <img class="img-fluid w-100" src="https://marrs.in/newassets/slide1293x593_2.jpg" width="1300">
        </a>
    </div>
</section>
<!-- CTA Button Section -->
<section class="cta-buttons my-5">
    <div class="container cta-box">
        <div class="row">
            <div class="col-12 text-center">
                 <h2 class="mb-3 cta-title ">Get Started with MaRRS Rediscover</h2>

            </div>
        </div>
        <div class="row my-2">
  <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                <div class="stage" id="stage">
<div class="slide-canvas" id="slideCanvas">

  <!-- ═══════════════════════════════════════════
       SLIDE 1 — HERO
  ══════════════════════════════════════════════ -->
  <div class="slide active" id="s1">
    <div class="slide-inner bg-hero">
      <!-- left photo panel -->
      <div class="hero-photo">
        <div class="hero-photo-bg">
          <div class="hero-clip"></div>
        </div>
      </div>
      <!-- right content -->
      <div class="hero-right">
        <div class="logo-badge">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
        <h1 class="hero-title">Empowering<br>Students Through<br>Global Self-Learning<br>Programs</h1>
      </div>
      <!-- dots top right -->
      <div class="hero-dots">
        <div class="hero-dot filled"></div>
        <div class="hero-dot empty"></div>
        <div class="hero-dot filled"></div>
      </div>
      <!-- deco circles bottom right -->
      <svg style="position:absolute;bottom:0;right:0;opacity:.15" width="160" height="100" viewBox="0 0 160 100">
        <circle cx="130" cy="90" r="70" fill="#1a7fdb"/>
      </svg>
      <!-- deco dots bottom center-left -->
      <svg style="position:absolute;bottom:12px;left:38%;opacity:.4" width="80" height="30" viewBox="0 0 80 30">
        <circle cx="5" cy="5" r="3" fill="#1a7fdb"/><circle cx="20" cy="5" r="3" fill="#1a7fdb"/><circle cx="35" cy="5" r="3" fill="#1a7fdb"/><circle cx="50" cy="5" r="3" fill="#1a7fdb"/>
        <circle cx="5" cy="17" r="3" fill="#1a7fdb"/><circle cx="20" cy="17" r="3" fill="#1a7fdb"/><circle cx="35" cy="17" r="3" fill="#1a7fdb"/><circle cx="50" cy="17" r="3" fill="#1a7fdb"/>
        <circle cx="5" cy="27" r="3" fill="#1a7fdb"/><circle cx="20" cy="27" r="3" fill="#1a7fdb"/>
      </svg>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 2 — CONTENTS
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s2">
    <div class="slide-inner bg-gradient">
      <div class="top-accent"></div>
      <div class="bottom-accent"></div>
      <!-- blue squares deco -->
      <div class="blue-sq" style="width:44px;height:44px;top:72px;left:80px;opacity:.9"></div>
      <div class="blue-sq" style="width:22px;height:22px;top:130px;left:80px;opacity:.7"></div>
      <!-- logo top right -->
      <div style="position:absolute;top:55px;right:20px;" class="logo-badge logo-sm">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
      </div>
      <div style="position:absolute;top:62px;left:80px;display:flex;align-items:center;gap:12px;">
        <div style="width:44px;"></div>
        <h2 style="font-family:'Montserrat',sans-serif;font-weight:300;font-size:30px;color:#3a4a5c;">Contents</h2>
      </div>
      <div class="contents-grid" style="position:absolute;top:160px;left:140px;right:40px;bottom:40px;align-content:center;">
        <div class="contents-item"><span class="contents-num">01</span><span class="contents-dot"></span><span class="contents-label">Proven Impact and Global Reach</span></div>
        <div class="contents-item"><span class="contents-num">02</span><span class="contents-dot"></span><span class="contents-label">Comprehensive Program Portfolio</span></div>
        <div class="contents-item"><span class="contents-num">03</span><span class="contents-dot"></span><span class="contents-label">Tailored Categories for All Ages</span></div>
        <div class="contents-item"><span class="contents-num">04</span><span class="contents-dot"></span><span class="contents-label">Preschool Bee (PSB) Detailed Offerings</span></div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 3 — PART 01 DIVIDER
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s3">
    <div class="slide-inner">
      <div class="chapter-slide">
        <div class="top-accent"></div>
        <div class="bottom-accent"></div>
        <div class="chapter-left">
          <div class="chapter-logo-big">
            <img src="https://marrs.in/newassets/marrs_discover_logo.png" alt="logo">
          </div>
        </div>
        <div class="blue-sq" style="width:40px;height:40px;left:42%;top:47%;opacity:.9"></div>
        <div class="blue-sq" style="width:44px;height:44px;right:24px;bottom:60px;opacity:.9"></div>
        <div class="blue-sq" style="width:22px;height:22px;right:24px;bottom:30px;opacity:.9"></div>
        <div class="chapter-right">
          <p class="part-label">PART  01</p>
          <h2 class="part-title">Proven Impact and<br>Global Reach</h2>
        </div>
        <!-- deco circles -->
        <svg style="position:absolute;bottom:30px;right:90px;opacity:.12" width="120" height="120"><circle cx="60" cy="60" r="60" fill="#1a7fdb"/></svg>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 4 — 2 Million Students Transformed
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s4">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>2 Million Students Transformed</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left">
            <div>
              <p class="section-label">Global Self-Learning Leader</p>
              <p class="body-text">MaRRS International Spelling Bee (MISB) is a leading global self-learning program for students from Class 1 to 12, building essential English language skills through an engaging word marathon for over two decades.</p>
            </div>
            <div>
              <p class="section-label">Proven Track Record</p>
              <p class="body-text">With a legacy spanning 20+ years, MaRRS has consistently cultivated accuracy, vocabulary, and confidence in millions of students worldwide.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;height:100%;">
            <div style="width:240px;height:230px;border-radius:60% 40% 50% 50% / 50% 50% 60% 40%;background:linear-gradient(135deg,#c5dff5 0%,#a0c8e8 100%);display:flex;align-items:center;justify-content:center;position:relative;box-shadow:0 12px 40px #1a7fdb22;">
              <svg viewBox="0 0 200 180" width="180" fill="none">
                <!-- simple student group illustration -->
                <circle cx="60" cy="55" r="22" fill="#ffcc99"/>
                <rect x="38" y="80" width="44" height="55" rx="8" fill="#e8650a" opacity=".8"/>
                <circle cx="110" cy="45" r="22" fill="#ffa07a"/>
                <rect x="88" y="70" width="44" height="60" rx="8" fill="#1a7fdb" opacity=".8"/>
                <circle cx="160" cy="55" r="22" fill="#f4c584"/>
                <rect x="138" y="80" width="44" height="55" rx="8" fill="#5b9bd5" opacity=".8"/>
                <path d="M40 145 Q100 125 160 145" stroke="#1a7fdb" stroke-width="2" fill="none" opacity=".4"/>
              </svg>
              <div style="position:absolute;top:-14px;right:-14px;width:32px;height:32px;border-radius:50%;background:var(--blue);"></div>
              <div style="position:absolute;bottom:-14px;left:-14px;width:18px;height:18px;border-radius:50%;background:var(--blue-pale);"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 5 — Endorsements
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s5">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>Endorsements from Esteemed Educators</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);display:flex;flex-direction:column;gap:0;padding-top:20px;">
        <div class="testimonial-image-bar my-1">
          <div class="num-bubble">01</div>
          <div style="width:1px;height:60%;background:#fff;opacity:.3;"></div>
          <div class="num-bubble">02</div>
        </div>
        <div class="testimonial-cols" style="padding-top:12px;">
           <!-- LEFT HALF -->
          <div class="testimonial-card">
            <p class="testi-heading">Testimonial from The Brigade School</p>
            <p class="testi-quote">
              "We've valued the MaRRS International Spelling Bee for 15 years. It cultivates accuracy, expands vocabulary, and builds student confidence. We proudly continue our partnership." — Ms. Stella Parthasarathy, Principal
            </p>
          </div>
        
          <!-- RIGHT HALF -->
          <div class="testimonial-card">
            <p class="testi-heading">Testimonial from Delhi Public School</p>
            <p class="testi-quote">
              "Delhi Public School, Electronic City, hosted a successful MaRRS Championship, showcasing our students' exceptional language skills. Participants displayed remarkable poise." — Dr. Jayaraju Tati Nail
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 6 — PART 03 DIVIDER
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s6">
    <div class="slide-inner">
      <div class="chapter-slide">
        <div class="top-accent"></div>
        <div class="bottom-accent"></div>
        <div class="chapter-left">
          <div class="chapter-logo-big">
              <img src="https://marrs.in/newassets/marrs_discover_logo.png" alt="logo">
          </div>
        </div>
        <div class="blue-sq" style="width:40px;height:40px;left:42%;top:47%;opacity:.9"></div>
        <div class="blue-sq" style="width:44px;height:44px;right:24px;bottom:60px;opacity:.9"></div>
        <div class="blue-sq" style="width:22px;height:22px;right:24px;bottom:30px;opacity:.9"></div>
        <div class="chapter-right">
          <p class="part-label">PART  03</p>
          <h2 class="part-title">Tailored Categories for<br>All Ages</h2>
        </div>
        <svg style="position:absolute;bottom:30px;right:90px;opacity:.12" width="120" height="120"><circle cx="60" cy="60" r="60" fill="#1a7fdb"/></svg>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 7 — PART 02 DIVIDER
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s7">
    <div class="slide-inner">
      <div class="chapter-slide">
        <div class="top-accent"></div>
        <div class="bottom-accent"></div>
        <div class="chapter-left">
            <div class="chapter-logo-big">
                <img src="https://marrs.in/newassets/marrs_discover_logo.png" alt="logo">
            </div>
        </div>
        <div class="blue-sq" style="width:40px;height:40px;left:42%;top:47%;opacity:.9"></div>
        <div class="blue-sq" style="width:44px;height:44px;right:24px;bottom:60px;opacity:.9"></div>
        <div class="blue-sq" style="width:22px;height:22px;right:24px;bottom:30px;opacity:.9"></div>
        <div class="chapter-right">
          <p class="part-label">PART  02</p>
          <h2 class="part-title">Comprehensive<br>Program Portfolio</h2>
        </div>
        <svg style="position:absolute;bottom:30px;right:90px;opacity:.12" width="120" height="120"><circle cx="60" cy="60" r="60" fill="#1a7fdb"/></svg>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 8 — International Spelling Bee
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s8">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>MaRRS International Spelling Bee</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left">
            <div>
              <p class="section-label">Comprehensive Language Mastery</p>
              <p class="body-text">Develops vocabulary, pronunciation, comprehension, word usage, and recall through structured competition, fostering academic excellence.</p>
            </div>
            <div>
              <p class="section-label">Confidence Building</p>
              <p class="body-text">Enhanced communication skills lead to increased self-assurance, preparing students for future challenges.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;height:100%;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #1a7fdb22;text-align:center;">
                <img src="https://marrs.in/images/misb_logo.png" alt="logo" height="200px">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 9 — International Math Bee
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s9">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>MaRRS International Math Bee</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div style="display:flex;align-items:center;justify-content:center;height:100%;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #e91e6322;text-align:center;">
                <img src="https://marrs.in/images/mimbin.png" alt="logo" height="200px">
             </div>
          </div>
          <div class="two-col-left">
            <div>
              <p class="section-label">Applied Problem-Solving Focus</p>
              <p class="body-text">A comprehensive competition emphasizing applied mathematical thinking and problem-solving skills for student growth.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 10 — Scientia Exertus
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s10">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>Scientia Exertus</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:24px;box-shadow:0 8px 30px #1a7fdb22;text-align:center;">
                <img src="https://marrs.in/images/sciextr.png" alt="logo" height="200px">
            </div>
          </div>
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Fostering Innovation and Critical Thinking</p>
              <p class="body-text">A national science competition encouraging young minds to explore inventive ideas, fostering creativity and critical thinking beyond imagination.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 11 — Preschool Programs
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s11">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>Preschool Programs (Nursery to Sr. KG)</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #1a7fdb22;width:220px;height:180px;display:flex;align-items:center;justify-content:center;font-size:60px;">👨‍👩‍👧‍👦</div>
          </div>
          <div class="two-col-left" style="justify-content:center;">
            <div style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 4px 20px #1a7fdb15;">
              <p class="section-label">Early Foundations for Lifelong Learning</p>
              <p class="body-text">The MaRRS Preschool Bee (PSB) programs lay the groundwork for future academic success through engaging, age-appropriate activities.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 12 — Play2Learn Carnival
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s12">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>MaRRS Play2Learn Carnival</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Learning Through Active Engagement</p>
              <p class="body-text">A dynamic array of games designed for comprehensive development, making learning fun and effective.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #1a7fdb22;text-align:center;">
                <img src="https://marrs.in/images/p2l.png" alt="logo" height="200px">
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 13 — Spelling Bee Junior
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s13">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>MaRRS Spelling Bee Junior</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">MaRRS Spelling Bee Junior</p>
              <p class="body-text">Creative language play introduces young learners to the joy of reading, building literacy, cognitive, and life skills for lifelong learning.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #1a7fdb22;text-align:center;">
                <img src="https://marrs.in/images/junior.png" alt="logo" height="200px">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 14 — PART 04 DIVIDER
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s14">
    <div class="slide-inner">
      <div class="chapter-slide">
        <div class="top-accent"></div>
        <div class="bottom-accent"></div>
        <div class="chapter-left">
          <div style="background:#fff;border-radius:10px;padding:14px 20px;box-shadow:0 4px 20px #1a7fdb22;text-align:center;">
            <img src="https://marrs.in/newassets/PSB-logo.png" alt="logo" height="200px">
          </div>
        </div>
        <div class="blue-sq" style="width:40px;height:40px;left:42%;top:47%;opacity:.9"></div>
        <div class="blue-sq" style="width:44px;height:44px;right:24px;bottom:60px;opacity:.9"></div>
        <div class="blue-sq" style="width:22px;height:22px;right:24px;bottom:30px;opacity:.9"></div>
        <div class="chapter-right">
          <p class="part-label">PART  04</p>
          <h2 class="part-title">Preschool Bee (PSB)<br>Detailed Offerings</h2>
        </div>
        <svg style="position:absolute;bottom:30px;right:90px;opacity:.12" width="120" height="120"><circle cx="60" cy="60" r="60" fill="#1a7fdb"/></svg>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 15 — PreSchool Bee English
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s15">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>PreSchool Bee — English</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
            <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #1a7fdb22;text-align:center;">
                <img src="https://marrs.in/images/psbeng.png" alt="logo" height="200px">
            </div>
          </div>
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Cognitive Communication Skills</p>
              <p class="body-text">Enhances attention, memory, problem-solving, and organization through language-based activities, building a strong communication foundation.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 16 — PreSchool Bee Math
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s16">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>PreSchool Bee — Math</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
          <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
          </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Cultivating Mathematical Curiosity</p>
              <p class="body-text">Fosters foundational mathematical understanding through exploration of everyday concepts, making numbers fun and accessible.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #8b4b8e22;text-align:center;">
                <img src="https://marrs.in/images/psbmath.png" alt="logo" height="200px">
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 17 — PreSchool Bee Science
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s17">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>PreSchool Bee — Science</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
          <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #c0392b22;text-align:center;">
                <img src="https://marrs.in/images/psbsci.png" alt="logo" height="200px">
            </div>
          </div>
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Little Explorers, Big Discoveries!</p>
              <p class="body-text">We bring real, science-backed learning down to a kid-sized level! By turning everyday play into exciting science experiments, we help your little ones build the critical thinking, problem-solving, and tech-ready skills they need to invent tomorrow.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 18 — PreSchool Bee Humanities
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s18">
    <div class="slide-inner bg-white">
      <div class="slide-header">
        <div class="slide-title-chip">
          <div class="arrow-chip"></div>
          <h2>PreSchool Bee — Humanities</h2>
        </div>
        <div class="logo-badge" style="transform:scale(.65);transform-origin:right center;">
         <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
         </div>
      </div>
      <div class="content-area" style="background:linear-gradient(180deg,#f0f8ff 0%,#e0f0fc 100%);">
        <div class="two-col">
          <div class="two-col-left" style="justify-content:center;">
            <div>
              <p class="section-label">Cultural Understanding and Critical Thinking</p>
              <p class="body-text">Introduces diverse cultures and perspectives, fostering critical thinking and a broad worldview from an early age.</p>
            </div>
          </div>
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 8px 30px #c0392b22;text-align:center;">
               <img src="https://marrs.in/images/psbhum.png" alt="logo" height="200px">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 19 — THANK YOU
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s19">
    <div class="slide-inner bg-hero">
      <!-- left photo panel -->
      <div class="hero-photo">
        <div class="hero-photo-bg">
          <svg class="building-svg" viewBox="0 0 200 280" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="20" y="40" width="80" height="240" rx="4" fill="#fff" opacity=".15"/>
            <rect x="30" y="55" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="50" y="55" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="70" y="55" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="30" y="80" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="50" y="80" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="70" y="80" width="12" height="16" rx="2" fill="#fff" opacity=".4"/>
            <rect x="110" y="80" width="72" height="200" rx="4" fill="#fff" opacity=".12"/>
            <rect x="120" y="95" width="10" height="14" rx="2" fill="#fff" opacity=".5"/>
            <rect x="136" y="95" width="10" height="14" rx="2" fill="#fff" opacity=".5"/>
            <circle cx="160" cy="60" r="30" fill="#fff" opacity=".07"/>
          </svg>
          <div class="hero-clip"></div>
        </div>
      </div>
      <div class="hero-right">
        <div class="logo-badge">
          <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
        </div>
        <h1 class="hero-title" style="font-size:42px;">Thank you</h1>
      </div>
      <div class="hero-dots">
        <div class="hero-dot filled"></div>
        <div class="hero-dot empty"></div>
        <div class="hero-dot filled"></div>
      </div>
      <svg style="position:absolute;bottom:0;right:0;opacity:.15" width="160" height="100" viewBox="0 0 160 100">
        <circle cx="130" cy="90" r="70" fill="#1a7fdb"/>
      </svg>
    </div>
  </div>

  <!-- ═══════════════════════════════════════════
       SLIDE 20 — CHAMPIONSHIP PHOTO
  ══════════════════════════════════════════════ -->
  <div class="slide" id="s20">
    <div class="slide-inner" style="background:linear-gradient(180deg,#e8f4fd,#c5dff5);">
      <div style="position:absolute;top:14px;right:20px;" class="logo-badge">
        <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
      </div>
      <div style="position:absolute;top:62px;left:30px;right:30px;bottom:20px;border-radius:12px;overflow:hidden;background:#1a7fdb22;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px;">
        <div style="font-size:64px;">🏆</div>
        <div style="text-align:center;">
          <div style="font-family:'Montserrat',sans-serif;font-weight:900;font-size:24px;color:var(--blue-dark);letter-spacing:.06em;">INTERNATIONAL CHAMPIONSHIP</div>
          <div style="font-size:14px;color:var(--gray);margin-top:8px;">Celebrating Student Excellence & Achievement</div>
        </div>
        <div style="display:flex;gap:20px;margin-top:8px;">
          <div style="text-align:center;"><div style="font-size:32px;">🥇</div><div style="font-size:11px;color:var(--gray);">Winners</div></div>
          <div style="text-align:center;"><div style="font-size:32px;">🎓</div><div style="font-size:11px;color:var(--gray);">Excellence</div></div>
          <div style="text-align:center;"><div style="font-size:32px;">🌐</div><div style="font-size:11px;color:var(--gray);">Global</div></div>
          <div style="text-align:center;"><div style="font-size:32px;">📜</div><div style="font-size:11px;color:var(--gray);">Certified</div></div>
        </div>
      </div>
    </div>
  </div>

</div><!-- /slideCanvas -->
</div><!-- /stage -->

<!-- NAVIGATION -->
<div class="nav my-2">
  <button class="nav-btn" id="prevBtn" onclick="go(-1)" disabled>← Prev</button>
  <div class="dots-row" id="dotsRow"></div>
  <button class="nav-btn" id="nextBtn" onclick="go(1)">Next →</button>
</div>
<div class="slide-counter" id="counter">1 / 20</div>

            </div>
        </div>
        <div class="row my-2 g-3 text-center">
       


<div class="col-12 col-md-3"></div>
<div class="col-12 col-md-2">
    <a href="/about_marrs" class="btn btn-dark btn-lg w-100 py-3 about">
        <i class="fa-solid fa-circle-info me-2"></i> About Us
    </a>
</div>
<div class="col-12 col-md-2">
    <a href="/gallery" class="btn btn-success btn-lg w-100 py-3 register">
        <i class="fa-solid fa-user-plus me-2"></i> Gallery
    </a>
</div>
   <div class="col-12 col-md-2">
    <a href="/addschool" class="btn btn-primary btn-lg w-100 py-3 enroll">
        <i class="fa-solid fa-school me-2"></i> Enroll
    </a>
</div>
<div class="col-12 col-md-3"></div>

        </div>

    </div>
</section>
<!-- Two Column Section -->
<section class="two-column my-5">
    <div class="container">
        <div class="row d-flex">

            <!-- Left -->
            <div class="col-md-6">
                <a href="/misbmisbj_schoolregistration.php">
                    <img class="img-fluid w-100" src="/newassets/Slide822 x 632.jpg">
                </a>
            </div>

            <!-- Right -->
            <div class="col-md-6">
                <div class="rediscover-moments">
                    <h2 class="pt-3">Rediscover Moments</h2>
                    <p>MaRRS National Championship 2024-25</p>

                    <div class="gallery-grid">

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI03748.JPG">
                                <img src="/frontend_gallery/SRI03748.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI03766.JPG">
                                <img src="/frontend_gallery/SRI03766.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI03358.JPG">
                                <img src="/frontend_gallery/SRI03358.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI03753.JPG">
                                <img src="/frontend_gallery/SRI03753.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI03054.JPG">
                                <img src="/frontend_gallery/SRI03054.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI02764.JPG">
                                <img src="/frontend_gallery/SRI02764.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI02292.JPG">
                                <img src="/frontend_gallery/SRI02292.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI02880.JPG">
                                <img src="/frontend_gallery/SRI02880.JPG">
                            </a>
                        </div>

                        <div class="gallery-item">
                            <a href="/frontend_gallery/SRI02614.JPG">
                                <img src="/frontend_gallery/SRI02614.JPG">
                            </a>
                        </div>

                    </div>

                    <a href="https://photos.app.goo.gl/fU4a2PjrgdNZVmPp7" class="btn btn-outline-primary mt-3">
                        View Full Gallery
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>
<script>
  const TOTAL = 20;
  let cur = 1;

  const dotsRow = document.getElementById('dotsRow');
  for (let i = 1; i <= TOTAL; i++) {
    const b = document.createElement('button');
    b.className = 'dot-btn' + (i===1?' active':'');
    b.title = 'Slide ' + i;
    b.onclick = () => jumpTo(i);
    dotsRow.appendChild(b);
  }

  function show(n) {
    document.getElementById('s'+cur).classList.remove('active');
    document.querySelectorAll('.dot-btn')[cur-1].classList.remove('active');
    cur = n;
    document.getElementById('s'+cur).classList.add('active');
    document.querySelectorAll('.dot-btn')[cur-1].classList.add('active');
    document.getElementById('counter').textContent = cur + ' / ' + TOTAL;
    document.getElementById('prevBtn').disabled = cur===1;
    document.getElementById('nextBtn').disabled = cur===TOTAL;
  }

  function go(d) { if(cur+d>=1 && cur+d<=TOTAL) show(cur+d); }
  function jumpTo(n) { show(n); }

  document.addEventListener('keydown', e => {
    if(e.key==='ArrowRight'||e.key==='ArrowDown') go(1);
    if(e.key==='ArrowLeft'||e.key==='ArrowUp') go(-1);
  });

  // Touch swipe
  let ts=0, tx=0;
  document.getElementById('stage').addEventListener('touchstart', e=>{ts=Date.now();tx=e.touches[0].clientX;},{passive:true});
  document.getElementById('stage').addEventListener('touchend', e=>{
    const dt=Date.now()-ts, dx=e.changedTouches[0].clientX-tx;
    if(dt<400&&Math.abs(dx)>40){ go(dx<0?1:-1); }
  },{passive:true});

  function toggleFS() {
    if(!document.fullscreenElement) document.getElementById('stage').requestFullscreen?.();
    else document.exitFullscreen?.();
  }

  // ── RESPONSIVE SCALE ──
  // The slide canvas is always 960x540 internally.
  // We CSS-scale it so it fills the stage at any screen size — fonts, padding, everything scales perfectly.
  function scaleSlides() {
    const stage = document.getElementById('stage');
    const canvas = document.getElementById('slideCanvas');
    const scale = stage.offsetWidth / 960;
    canvas.style.transform = 'scale(' + scale + ')';
    stage.style.height = Math.round(stage.offsetWidth * 9 / 16) + 'px';
  }
  scaleSlides();
  window.addEventListener('resize', scaleSlides);
  document.fonts && document.fonts.ready.then(scaleSlides);
</script>

<style>
/* Mobile nav overrides */
@media (max-width: 600px) {
  body { padding: 10px 8px 40px; gap: 10px; }
  .topbar { font-size: 10px; }
  .topbar .brand { font-size: 12px; }
  .kb-hint { display: none; }
  .nav { gap: 8px; }
  .nav-btn { font-size: 11px; padding: 8px 14px; }
  .dots-row { gap: 4px; }
  .dot-btn { width: 6px; height: 6px; }
  .slide-counter { font-size: 10px; }
  .fs-btn { top: 8px; right: 8px; padding: 6px 10px; font-size: 11px; }
}
</style>
<?php include('footertest.php'); ?>

