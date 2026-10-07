<?php include('headertest.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
?>

<style>
  /* ── Carousel controls ── */
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: #eb1736;
    border-radius: 50%;
    background-size: 60%;
    width: 2.2em !important;
    height: 3em !important;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
  }

  .carousel-indicators [data-bs-target] {
    background-color: #023b70;
  }

  
  /* ── Hero section ── */
  :root {
    --blue: #3540d4;
    --orange: #f05a28;
  }

  .hero {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 420px 1fr;
    grid-template-rows: auto 1fr; /* 🔥 important */
  align-items: start;
    /*gap: 40px;*/
    gap:40px;
    padding:20px 7%;
    position: relative;
    background: var(--blue);
  }

  .hero::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    top: -200px;
    left: -180px;
  }

  .hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
  }
  .hero-tagline-box {
  border: 1px solid rgba(255,255,255,0.25);
  padding: 18px 24px; /* slightly increased */
  margin-bottom: 10px;
  display: inline-flex;
  flex-direction: column;
  gap: 10px;
  border-radius: 14px;

  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(8px);

  font-size: 1rem; /* 🔥 increased from 14px */
  font-weight: 700; /* slightly bolder */
  letter-spacing: 0.8px;
  color: #fff;


  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  width: 100%;
}

/* center bullets + text */
.hero-tagline-box span {
  display: flex;
  align-items: center;
  gap: 10px;
}

/* icon style */
.hero-tagline-box i {
  color: #FFEB3B;
  font-size: 16px;
  min-width: 20px;

  /* 🔥 subtle glow */
  text-shadow: 0 0 8px rgba(240, 90, 40, 0.6);
}
.hero-right-text {
  color: rgba(255,255,255,0.9);
  font-size: 20px;
  line-height: 1.6;
  margin-bottom: 10px;
  text-align: center;
}
/* --- Top ---*/
.top{
    grid-column: 1 / -1;   /* 🔥 FULL WIDTH inside grid */
    width:100%;
    z-index:3;
    margin-bottom: 20px;
  

}
.journey-section{
    padding:20px;
    border-radius:12px;
    text-align:center;
      background: rgb(255 87 34);
  backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.journey-title{
    font-weight:700;
    color:#ffffff;
    margin-bottom:20px;
}

.journey-flow{
    display:flex;
    justify-content:center;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

.step{
    background:#fff;
    padding:10px 18px;
    border-radius:25px;
    font-weight:500;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.step:hover{
    background:#3540d4;
    color:#fff;
    transform:translateY(-3px);
}

.arrow{
    font-size:20px;
    color:#fdf8f8;
}
  /* ── Hero left ── */
  .left {
    color: white;
    position: relative;
    z-index: 2;
  }

  .left h1 {
    font-size: clamp(1.8rem, 1.5vw, 3rem);
    line-height: 1.1;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .left p {
    color: rgba(255, 255, 255, 0.85);
    font-size: 17px;
    line-height: 1.7;
    margin-bottom: 18px;
    max-width: 480px;
  }

  .cta-group {
    display: flex;
    flex-direction: column;
    gap: 16px;
    width: fit-content;
    margin-top: 18px;
  }

  /* ── Buttons ── */
  .btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    text-decoration: none;
    padding: 15px 24px;
    border-radius: 16px;
    font-weight: 600;
    transition: 0.3s ease;
    min-width: 270px;
  }

  .btn-primary {
    background: var(--orange);
    color: white;
    box-shadow: 0 12px 30px rgba(240, 90, 40, 0.35);
  }

  .btn-primary:hover {
    transform: translateY(-3px);
  }

  .btn-outline {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: white;
  }

  .btn-outline:hover {
    background: rgba(255, 255, 255, 0.14);
    color:#ffffff;
  }

  .arrow {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.18);
    flex-shrink: 0;
  }

  /* ── Hero center ── */
  /*.center {*/
  /*  position: relative;*/
  /*  z-index: 2;*/
  /*  display: flex;*/
  /*  flex-direction: column;*/
  /*  gap: 16px;*/
  /*}*/

  /*.image-card {*/
  /*  background: white;*/
  /*  border-radius: 28px;*/
  /*  overflow: hidden;*/
  /*  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);*/
  /*}*/

  /*.image-card img {*/
  /*  width: 100%;*/
  /*  height: 465px;*/
  /*  object-fit: cover;*/
  /*  display: block;*/
  /*}*/
.center {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.image-card {
  background: white;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
}

/* ───────────────────────── */
/* CAROUSEL */
/* ───────────────────────── */

.carousel {
  width: 100%;
  height: 465px;
  overflow: hidden;
}

.carousel-track {
  display: flex;
  /*width: 300%;*/
  animation: slideStep 90s steps(21) infinite; /* 🔥 MAGIC */
}

.carousel-track img {
  width: 100%;
  height: 465px;
  object-fit: fill;
  flex: 0 0 100%;
}

@keyframes slideStep {
  from { transform: translateX(0); }
  to   { transform: translateX(-2100%); }
}
/* ───────────────────────── */
/* RESPONSIVE */
/* ───────────────────────── */

/* TABLET */
@media (max-width: 992px) {
  .carousel {
    height: auto;
  }

  .carousel-track img {
    width: 100%;   /* ✅ FIX */
    height: 380px;
  }
}

/* MOBILE */
@media (max-width: 768px) {
  .carousel {
    height: auto;
  }

  .carousel-track img {
    width: 100%;
    height: 300px;
  }
}

/* SMALL MOBILE */
@media (max-width: 480px) {
  .carousel {
    height: auto;
  }

  .carousel-track img {
    width: 100%;
    height: 240px;
  }
}



/* BUTTON */
.btn-below-image {
  width: 100%;
  border-radius: 16px;
}
  .btn-below-image {
    width: 100%;
    min-width: unset;
    border-radius: 16px;
  }

  /* ── Hero right ── */
  .right {
    display: flex;
    flex-direction: column;
    gap: 18px;
    position: relative;
    z-index: 2;
  }

  .auth-btn {
    text-decoration: none;
    text-align: center;
    padding: 20px 24px;
    border-radius: 16px;
    font-weight: 700;
    transition: 0.3s ease;
    
  }

  .login {
     background: var(--orange);
    color: white;
    font-size: x-large;
  }

  .login:hover {
    transform: translateY(-3px);
  }

  .register-box {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 22px;
    padding: 24px;
    backdrop-filter: blur(8px);
  }

  .register-box small {
    color: rgba(255, 255, 255, 0.7);
    display: block;
    margin-bottom: 10px;
    letter-spacing: 1px;
  }

  .register-box h3 {
    color: white;
    font-size: 1.6rem;
    margin-bottom: 20px;
  }

  .register {
    display: block;
    text-decoration: none;
    background: #fff;
    color: #f05a28;
    text-align: center;
    padding: 15px;
    border-radius: 14px;
    font-weight: 700;
    transition: 0.3s ease;
  }

  .register:hover {
    transform: translateY(-3px);
  }

  /* ── About slide ── */
  .about-slide-section {
    background: #3c3a9c !important;
  }

  /* ── Section headers ── */
  .section-header h2 {
    font-size: 1.4rem;
  }

  h2.regular-program {
    font-size: 22px;
  }

  h2.learning-program {
    font-size: 22px;
    margin-top: 44px;
    margin-bottom: 20px;
  }

  /* ── Responsive ── */
@media (max-width: 992px) {
  .hero {
    grid-template-columns: 1fr;
    text-align: center;
    padding: 40px 22px 60px;
    gap: 35px;
  }

  .center { 
    order: -1; 
  }

  
    .left {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .cta-group {
      width: 100%;
      max-width: 360px;
    }

    .btn { width: 100%; }

    .right {
      max-width: 360px;
      width: 100%;
      margin: auto;
    }
  }

  @media (max-width: 480px) {
    header { height: auto; }

    .mt-5 { margin-top: 1rem !important; }

    .products { padding: 30px 0; }

    section.about-slide-section.pb-5 { padding-bottom: 1rem !important; }

    section#slide8 {
      padding-top: 0 !important;
      padding-bottom: 20px !important;
    }

    .navbar-custom {
      background: url("https://marrs.in/newassets/header.jpg") center / cover no-repeat;
      height: 100% !important;
    }

    .section-header h2 { font-size: 1.1rem !important; }

    h2.regular-program { font-size: 18px; }

    h2.learning-program {
      font-size: 18px;
      margin-top: 44px;
      margin-bottom: 20px;
    }

    .navbar-brand img { height: 42px !important; }

    .image-card img { height: 320px; }

    .left h1 { font-size: 2rem; }

    .btn {
      min-width: auto;
      padding: 14px 18px;
      font-size: 14px;
    }
  

  }

  @media (max-width: 767px) {
    .navbar-custom { background-image: none; }
  }
/* SECTION */
.stats-gallery-section {
  width: 100%;
  padding: 30px 20px;
  box-sizing: border-box;
}

/* ===== STATS (UPGRADED) ===== */
/* ===== STATS FINAL (MATCH SCREENSHOT) ===== */
.left-stats {
  display: flex;
  justify-content: space-between; /* 🔥 spread across full width */
  align-items: center;
  width: 100%;
  padding: 40px 80px; /* spacing like screenshot */
  box-sizing: border-box;
  text-align: center;
}

/* each block */
.stat-item {
  flex: 1; /* 🔥 equal width */
  position: relative;
}

/* vertical divider */
.stat-item:not(:last-child)::after {
  content: "";
  position: absolute;
  right: 0;
  top: 25%;
  height: 50%;
  width: 1px;
  background: rgba(0,0,0,0.15);
}

/* number */
.ls-num {
  font-family: 'Poppins', sans-serif;
  font-size: 40px;
  font-weight: 700;
  color: #2563eb; /* blue */
}

/* symbol */
.ls-num em {
  font-style: normal;
  margin-left: 3px;
}

/* label */
.ls-lbl {
  font-size: 14px;
  color: #6b7280;
  letter-spacing: 1px;
  margin-top: 8px;
}

/* ===== CAROUSEL ===== */
.photos-carousel {
  width: 100%;
  overflow: hidden;          /* 🔥 IMPORTANT (allow expansion) */
  padding: 30px 0;            /* space for hover grow */
  position: relative;
}

/* ===== TRACK ===== */
/*.photos-track {*/
/*  display: flex;*/
/*  gap: 20px;*/
  /*align-items: center;       */
  /* 🔥 prevents jump */
/*  width: max-content;*/
/*  animation: scrollLoop 25s linear infinite;*/
/*}*/
.photos-track {
  display: flex;
  gap: 20px;
  align-items: center;
  width: fit-content;   /* ✅ FIX */
  min-width: 100%;      /* ✅ IMPORTANT */
  animation: scrollLoop 25s linear infinite;
}
/* ===== CARD ===== */
.photo-box {
  width: 220px;
  height: 140px;
  border-radius: 16px;
  overflow: hidden;
  background: #fff;
  flex-shrink: 0;
  position: relative;

  box-shadow: 0 6px 18px rgba(0,0,0,0.12);

  transition: 
    transform 0.35s ease,
    box-shadow 0.35s ease;
}

/* IMAGE */
.photo-cell img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* ===== 🔥 MAIN HOVER (CARD EXPANDS) ===== */
.photo-box:hover {
  transform: scale(1.25);     /* 🔥 bigger expansion */
  z-index: 100;               /* stay above all */
  box-shadow: 0 18px 45px rgba(0,0,0,0.35);
}

/* OPTIONAL: slight image zoom */
.photo-box:hover img {
  transform: scale(1.05);
  transition: transform 0.35s ease;
}

/* ===== PAUSE ANIMATION ===== */
.photos-carousel:hover .photos-track {
  animation-play-state: paused;
}

/* ===== ANIMATION ===== */
@keyframes scrollLoop {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {

  .left-stats {
    flex-direction: column;
    gap: 25px;
    padding: 30px 20px;
  }

  .stat-item::after {
    display: none;
  }

  .ls-num {
    font-size: 28px;
  }

  .photo-box {
    width: 150px;
    height: 100px;
  }

  .photo-box:hover {
    transform: scale(1.1);
  }

  .photos-track {
    animation-duration: 30s;
  }
}
/* ===== SECTION SPACING ===== */
section{
  padding: 60px 20px;
  background: #f8fafc;
}

/* ===== GLOBAL SECTION ===== */
section{
  padding: 60px 20px;
  background: #f8fafc;
  font-family: 'Poppins', sans-serif;
}

/* ===== MAIN GRID ===== */
.marrs-3col-section{
  display:grid;
  grid-template-columns: repeat(3, 1fr);
  gap:28px;
  max-width:1200px;
  margin:auto;
  align-items:stretch; /* equal height */
}

/* ===== MAIN CARD ===== */
.marrs-col-card{
  display:flex;
  flex-direction:column;
  height:100%;
  border-radius:20px;
  padding:26px;
  transition: all 0.35s ease;
  position:relative;
  overflow:hidden;
}

/* INNER WRAPPER FULL HEIGHT */
.marrs-col-card > div{
  flex:1;
  display:flex;
  flex-direction:column;
}

/* HOVER */
.marrs-col-card:hover{
  transform: translateY(-8px);
  box-shadow:0 20px 50px rgba(0,0,0,0.12);
}

/* ===== CARD 1 (WHY) ===== */
.why-marrs{
  background:#ffffff;
  border-radius:18px;
  padding:20px;
  display:flex;
  flex-direction:column;
  height:100%;
}

.why-marrs h4{
  font-size:20px;
  font-weight:600;
  margin-bottom:18px;
  color:#1e293b;
  text-align:center;
  min-height:50px;
  display:flex;
  align-items:center;
  justify-content:center;
}

/* WHY GRID */
.why-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:12px;
  flex:1;
}

.why-item{
  font-size: 14px;
    color: #475569;
    background: #f1f5f9;
    padding: 10px 12px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    min-height: 44px;
    transition: 0.3s;
    flex-direction: column;
    text-align: center;
}

.why-item i{
  font-size:20px;
  color:#fff;
  min-width:16px;
  text-align:center;
}
.why-item span{
    width: 48px;
    height: 48px;
    min-width: 48px;
    min-height: 48px;
    border-radius: 50%;
    background: #FF9800;
    display: flex;
    justify-content: center;
    align-items: center;
}

.why-item:hover{
  background:#e0e7ff;
  transform:scale(1.03);
}

/* ===== CARD 2 (BLUE) ===== */
.marrs-blue{
  background: linear-gradient(135deg, #4f46e5, #4338ca);
  color:#fff;
}

/* ===== CARD 3 (WHITE) ===== */
.marrs-white{
  background:#ffffff;
  border:1px solid #e5e7eb;
}

/* ===== TITLES ===== */
.marrs-section-title{
  font-size:22px;
  font-weight:600;
  text-align:center;
  margin-bottom:20px;
  min-height:50px;
  display:flex;
  align-items:center;
  justify-content:center;
}

/* ===== ROW FIX ===== */
.marrs-col-card .row{
  flex:1;
  margin:0;
}

.marrs-col-card .col-6{
  display:flex;
}

/* ===== INNER CARDS (EQUAL HEIGHT) ===== */
.marrs-stat-card,
.marrs-gain-card{
  flex:1;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  border-radius:14px !important;
  padding:18px !important;
  min-height:110px;
  transition: all 0.3s ease;
  font-size:14px;
  font-weight:500;
}

/* BLUE CARD STYLE */
.marrs-stat-card{
  background: rgba(255,255,255,0.12);
  backdrop-filter: blur(6px);
  color:#fff;
}

/* WHITE CARD STYLE */
.marrs-white .marrs-gain-card{
  background:#f8fafc;
  color:#334155;
}

/* HOVER INNER */
.marrs-stat-card:hover,
.marrs-gain-card:hover{
  transform: translateY(-4px);
  box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* ===== ICON (SAME SIZE EVERYWHERE) ===== */
.marrs-icon-circle{
  width:48px;
  height:48px;
  min-width:48px;
  min-height:48px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  margin-bottom:10px;
  background: rgba(255,255,255,0.2);
}

/* ICON SIZE FIX */
.marrs-icon-circle i{
  font-size:18px;
  line-height:1;
  color:#fff;
}

/* WHITE CARD ICON */
.marrs-white .marrs-icon-circle{
  background:#eef2ff;
}

.marrs-white .marrs-icon-circle i{
  color:#4f46e5;
}

/* ICON HOVER */
.marrs-stat-card:hover .marrs-icon-circle,
.marrs-gain-card:hover .marrs-icon-circle{
  transform:scale(1.1);
}

/* ===== TEXT ===== */
.marrs-stat-card span,
.marrs-gain-card span{
  line-height:1.4;
  font-size:13.5px;
}


/* ===== RESPONSIVE ===== */
@media (max-width: 992px){
  .marrs-3col-section{
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px){
  .marrs-3col-section{
    grid-template-columns: 1fr;
  }

  .why-grid{
    grid-template-columns:1fr;
  }
}
</style>
<style>

  .detail-section {
    background: linear-gradient(160deg, #1746c9 0%, #1957e6 35%, #2e8ff0 75%, #6cc3f7 100%);
    padding: 64px 32px 0;
    position: relative;
    overflow: hidden;
  }

  .detail-content {
    max-width: 1100px;
    margin: 0 auto;
    text-align: center;
    position: relative;
    z-index: 2;
  }

  .detail-content h1 {
    color: #fff;
    font-size: 46px;
    font-weight: 800;
    line-height: 1.15;
    margin-bottom: 18px;
  }

  .detail-content p {
    color: #eaf1ff;
    font-size: 18px;
    font-weight: 400;
  }

  .detail-content p strong {
    color: #ffd54f;
    font-weight: 700;
  }

  /* Decorative background shapes */
  .deco { position:absolute; z-index:1; opacity:0.5; }
  .deco-dots {
    top: 90px; left: 40px; width: 130px; height: 130px;
    background-image: radial-gradient(rgba(255,255,255,0.35) 1.5px, transparent 1.5px);
    background-size: 14px 14px;
  }
  .deco-x1 { top: 120px; left: 340px; color:#fff; font-size:22px; opacity:.4; }
  .deco-x2 { top: 335px; left: 10px; color:#fff; font-size:20px; opacity:.35; }
  .deco-ring1 { top: 150px; right: 220px; width:26px; height:26px; border:2px solid rgba(255,255,255,.5); border-radius:50%; }
  .deco-ring2 { top: 40px; right: 340px; width:16px; height:16px; border:2px solid rgba(255,255,255,.45); border-radius:50%; }
  .deco-ring3 { bottom: 240px; left: 22px; width:16px; height:16px; border:2px solid rgba(255,255,255,.4); border-radius:50%; }
  .deco-circle1 { top: 90px; right: 60px; width:44px; height:44px; background:rgba(255,255,255,.12); border-radius:50%; }
  .deco-sparkle { top: 445px; right: 25px; color:#fff; font-size:22px; opacity:.55; }

  /* Cards row */
  .cards-row {
    margin: 48px auto 0;
    display: flex;
    align-items: stretch;
    gap: 22px;
    position: relative;
    z-index: 2;
  }

  .card {
    flex: 1;
    border-radius: 20px;
    padding: 40px 26px 30px;
    position: relative;
    text-align: center;
  }

  .card-light {
    background: #fef9f7;
    box-shadow: 0 18px 40px rgba(0,0,0,0.10);
  }

  .card-purple {
    background: linear-gradient(160deg, #4a3fd6 0%, #6c5ce7 60%, #7d6ff2 100%);
    box-shadow: 0 18px 40px rgba(60,40,180,0.28);
    transform: translateY(-14px);
    padding-top: 46px;
    padding-bottom: 40px;
    border: 1px solid #fff;
  }

  .card-icon {
    width: 62px;
    height: 62px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin: -70px auto 18px;
    box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    border: 4px solid #fff;
  }

  .icon-orange { background:#ff8a3d; }
  .icon-purple { background:#7c6bf5; }
  .icon-green  { background:#22b573; }

  .card h3 {
    font-size: 21px;
    font-weight: 700;
    color: #1c2340;
    line-height: 1.3;
    margin-bottom: 10px;
  }

  .card-purple h3 { color: #fff; }

  .title-underline {
    width: 46px;
    height: 3px;
    margin: 0 auto 22px;
    border-radius: 2px;
  }
  .underline-orange { background:#ff8a3d; }
  .underline-blue { background:#8ec9ff; }
  .underline-green { background:#22b573; }

  .feature-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .feature-item {
    background: #ffffff;
    border-radius: 14px;
    padding: 14px 10px;
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    text-align: left;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.10);
  }

  .card-purple .feature-item {
    background: rgba(255,255,255,0.12);
  }

  .feature-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size: 18px;
    flex-shrink: 0;
  }

  .feature-icon-orange { background:#ffe3c2; color:#ff8a3d; }
  .feature-icon-purple { background:rgba(255,255,255,0.22); color:#fff; }
  .feature-icon-green  { background:#d6f5e6; color:#22b573; }

  .feature-item span.label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #1c2340;
    line-height: 1.3;
  }

  .card-purple .feature-item span.label,
  .card-purple .feature-item strong {
    color: #fff;
  }

  .card-purple .feature-item {
    /*align-items: flex-start;*/
    text-align: left;
  }
  .card-purple .feature-item .stat-text {
    font-size: 0.8rem;
    font-weight: 600;
    line-height: 1.35;
    color:#fff;
  }

  /* Bottom benefits strip */
  .benefits-strip {
    margin: 44px auto 0;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(20,60,150,0.18);
    padding: 30px 36px;
    display: flex;
    justify-content: space-between;
    gap: 18px;
    position: relative;
    z-index: 2;
    flex-wrap: wrap;
  }

  .benefit {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    flex: 1;
    min-width: 190px;
  }

  .benefit-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    flex-shrink: 0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size: 19px;
    border: 2px solid rgba(0,0,0,0.04);
  }

  .benefit h4 {
    font-size: 14.5px;
    font-weight: 700;
    margin-bottom: 4px;
  }

  .benefit p {
    font-size: 12.5px;
    color: #6b7280;
    line-height: 1.4;
  }

  .bi-purple { background:#ece9ff; color:#5b4bd6; }
  .bi-blue   { background:#e4f0ff; color:#2f7ee0; }
  .bi-orange { background:#fff1de; color:#f5a338; }
  .bi-teal   { background:#e2faf1; color:#1fae7a; }
  .bi-pink   { background:#ffe6f0; color:#e0468a; }

  .h-orange { color:#f5a338; }
  .h-pink   { color:#e0468a; }

  .spacer { height: 60px; }
@media (max-width: 1300px){
    .feature-item {flex-direction:column;text-align: center;}
    .detail-content h1 {font-size:40px;}
}
  @media (max-width: 900px) {
    .cards-row { flex-direction: column; }
    .card-purple { transform: none; }
    .detail-content h1 { font-size: 32px; }
    .benefits-strip { flex-direction: column; }
    .feature-grid {
  
    grid-template-columns: 1fr;}
  }
</style>
<!-- ── Hero ── -->
<section class="hero">
  <div class="top">
      <div class="journey-section">
    <h3 class="journey-title">The MaRRS Learning Journey</h3>

    <div class="journey-flow">
        <div class="step">Preschool</div>
        <div class="arrow">→</div>

        <div class="step">Language</div>
        <div class="arrow">→</div>

        <div class="step">Mathematics</div>
        <div class="arrow">→</div>

        <div class="step">Science</div>
        <div class="arrow">→</div>

        <div class="step">Innovation</div>
        <div class="arrow">→</div>

        <div class="step">Leadership</div>
    </div>
</div>
  </div>
  <div class="left">
 
  <!-- NEW bordered text -->
 <div class="hero-tagline-box mb-4">
  <span><i class="fa-solid fa-graduation-cap"></i> Beyond Curriculum</span>
  <span><i class="fa-solid fa-brain"></i> Beyond Memorisation</span>
  <span><i class="fa-solid fa-rocket"></i> Beyond Limits</span>
</div>
  <h1>Helping Children Discover Their Potential since 2003</h1>
    <p>Since 2003, MaRRS has empowered learners across the world through transformative programs that go beyond curriculum and beyond memorisation.</p>
  
    <div class="cta-group">
      <a href="/addschool" class="btn btn-primary">
        Spark a Revolution - Enroll Your School Now
        <span class="arrow">→</span>
      </a>
    </div>
  </div>

  <!--<div class="center">-->
  <!--  <div class="image-card">-->
  <!--    <img src="https://marrs.in/newassets/winner_slide1056×1358_01.jpg" alt="Learning">-->
  <!--  </div>-->
  <!--  <a href="/all_programs" class="btn btn-outline btn-below-image">-->
  <!--    Unlock Your Child's Potential - Explore MaRRS Programs-->
  <!--    <span class="arrow">→</span>-->
  <!--  </a>-->
  <!--</div>-->

<div class="center">
  <div class="image-card">
    
    <div class="carousel">
      <div class="carousel-track">
          <img src="https://marrs.in/newassets/slide/slide02.jpg" />
          <img src="https://marrs.in/images/misb_logo.png" />
          <img src="https://marrs.in/newassets/slide/slide03.jpg" />
          <img src="https://marrs.in/images/mimbin.png" />
          <img src="https://marrs.in/newassets/slide/slide04.jpg" />
          <img src="https://marrs.in/images/junior.png" />
          <img src="https://marrs.in/newassets/slide/slide01.jpg" />
          <img src="https://marrs.in/images/p2l.png" />
          <img src="https://marrs.in/newassets/slide/slide05.jpg" />
          <img src="https://marrs.in/images/mzofwds.png" />
          <img src="https://marrs.in/newassets/slide/slide06.jpg" />
          <img src="https://marrs.in/images/PSB-logo.png" />
          <img src="https://marrs.in/newassets/slide/slide07.jpg" />
          <img src="https://marrs.in/newassets/logos/Primary-colors-logo.jpg" />
          <img src="https://marrs.in/newassets/slide/slide08.jpg" />
          <img src="https://marrs.in/newassets/logos/xpressmath-logo.png" />
          <img src="https://marrs.in/newassets/slide/slide09.jpg" />
          <img src="https://marrs.in/newassets/logos/Wod-chase-logo.png" />
          <img src="https://marrs.in/newassets/slide/slide08.jpg" />
          <img src="https://marrs.in/newassets/logos/zoomlandinglogo.png" />
          <img src="https://marrs.in/newassets/logos/SE.jpg" />

        </div>
    </div>

  </div>

  <a href="/all_programs" class="btn btn-outline btn-below-image">
    Explore MaRRS Programs
    <span class="arrow">→</span>
  </a>
</div>

  <div class="right">
 
    <!-- NEW text above login -->
    <div class="register-box mb-2">
      <small>REGISTRATION OPEN</small>
      <h3>Academic Year 2026–27</h3>
      <a href="/signin?tab=register" class="register">Register Now</a>
    </div>
  <p class="hero-right-text mb-2">
    Developing critical thinking, creativity, scientific inquiry, communication, and problem-solving skills in over 1 million students every year.
  </p>

  <a href="/signin?tab=signin" class="auth-btn login mt-4">Login</a>
    
  </div>
</section>
<section class="stats-gallery-section">

  <!-- STATS -->
  <div class="left-stats">
    <div class="stat-item">
      <div class="ls-num">93.5<em>K+</em></div>
      <div class="ls-lbl">Students</div>
    </div>

    <div class="stat-item">
      <div class="ls-num">12<em>+</em></div>
      <div class="ls-lbl">Programs</div>
    </div>

    <div class="stat-item">
      <div class="ls-num">98<em>%</em></div>
      <div class="ls-lbl">Satisfaction</div>
    </div>
  </div>

  <!-- CAROUSEL -->
  <div class="photos-carousel">
    <div class="photos-track">

      <!-- REPEAT THESE BOXES -->
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/SRI03870.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_7061-misb.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_8300_misbj.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_9680_se.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/OW2A0122-mimb.JPG"></div>
      </div>

      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/9D0A0571-misb.JPG"></div>
      </div>

      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/SRI03878.JPG"></div>
      </div>
      
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/SRI03863.JPG"></div>
      </div>

      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/SRI03763.JPG"></div>
      </div>
      
      
      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SAM_4135-misb.JPG"></div>
      </div>
      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SAM_4135-misb.JPG"></div>
      </div>
      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SAM_4135-misb.JPG"></div>
      </div>
      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SRI03560.JPG"></div>
      </div>
      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SRI03748.JPG"></div>
      </div>
      

      <!--  DUPLICATE SAME AGAIN -->
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_7061-misb.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_8300_misbj.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/IMG_9680_se.JPG"></div>
      </div>
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/OW2A0122-mimb.JPG"></div>
      </div>

      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/9D0A0571-misb.JPG"></div>
      </div>

      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/SRI02612.JPG"></div>
      </div>
      
      <div class="photo-box">
        <div class="photo-cell"><img src="/images/school_gallery/DSC_0288-misb.JPG"></div>
      </div>

      <div class="photo-box">
            <div class="photo-cell"><img src="/images/school_gallery/SAM_4135-misb.JPG"></div>
     </div>
    </div>

  </div>

</section>
<!-- ===== 3 CARD SECTION ===== -->
<!--<section style="    background: #03A9F4;">-->
<!--<div class="marrs-3col-section">-->

  <!-- ===== CARD 1: WHY MARRS ===== -->
<!--  <div class="marrs-col-card border border-white">-->
<!--    <div class="why-marrs">-->
<!--      <h4>Why 1000+ Schools Partner with MaRRS</h4>-->

<!--      <div class="why-grid">-->
<!--        <div class="why-item"><span><i class="fa-solid fa-award"></i></span> Enhances school reputation</div>-->
<!--        <div class="why-item"><span><i class="fa-solid fa-brain"></i></span> Develops future-ready skills</div>-->
<!--        <div class="why-item"><span><i class="fa-solid fa-book-open"></i></span> Complements classroom learning</div>-->
<!--        <div class="why-item"><span><i class="fa-solid fa-globe"></i></span> International benchmarking</div>-->
<!--        <div class="why-item"><span><i class="fa-solid fa-users"></i></span> Student engagement</div>-->
<!--        <div class="why-item"><span><i class="fa-solid fa-chalkboard-user"></i></span> Teacher support</div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

  <!-- ===== CARD 2: TRUSTED ===== -->
<!--  <div class="marrs-col-card marrs-blue border border-white">-->
<!--    <div class="container p-0">-->

<!--      <h2 class="fw-bold marrs-section-title mb-4 text-white text-center">-->
<!--        Trusted by Learners Worldwide-->
<!--      </h2>-->

<!--      <div class="row g-3">-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-stat-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-calendar-alt"></i></span>-->
<!--            <span>20+ Years of Impact</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-stat-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-user-graduate"></i></span>-->
<!--            <span>1 Million+ Students Annually</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-stat-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-child"></i></span>-->
<!--            <span>Preschool to Grade 12</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-stat-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-trophy"></i></span>-->
<!--            <span>National & International Championships</span>-->
<!--          </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

  <!-- ===== CARD 3: GAINS ===== -->
<!--  <div class="marrs-col-card marrs-white border border-white">-->
<!--    <div class="container p-0">-->

<!--      <h2 class="fw-bold marrs-section-title mb-4 text-center">-->
<!--        What Every Participant Gains-->
<!--      </h2>-->

<!--      <div class="row g-3">-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-fist-raised"></i></span>-->
<!--            <span>Confidence</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-comments"></i></span>-->
<!--            <span>Communication Skills</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-brain"></i></span>-->
<!--            <span>Critical Thinking</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-lightbulb"></i></span>-->
<!--            <span>Creativity</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-puzzle-piece"></i></span>-->
<!--            <span>Problem Solving</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="col-6">-->
<!--          <div class="marrs-gain-card text-center p-3 rounded-4">-->
<!--            <span class="marrs-icon-circle"><i class="fas fa-flask"></i></span>-->
<!--            <span>Scientific Inquiry</span>-->
<!--          </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->
<!--  </div>-->

<!--</div>-->
<!--</section>-->



<section class="detail-section">
  <div class="deco deco-dots"></div>
  <div class="deco deco-x1">✕</div>
  <div class="deco deco-x2">✕</div>
  <div class="deco deco-ring1"></div>
  <div class="deco deco-ring2"></div>
  <div class="deco deco-ring3"></div>
  <div class="deco deco-circle1"></div>
  <div class="deco deco-sparkle">✦</div>
 
  <div class="detail-content">
    <h1>Empowering Learners. Strengthening Schools.</h1>
    <p>MaRRS partners with <strong>1000+</strong> schools to build confident, future-ready learners.</p>
  </div>
 
  <div class="cards-row">
 
    <!-- Card 1 -->
    <div class="card card-light my-2">
      <div class="card-icon icon-orange"><i class="fa-solid fa-school"></i></div>
      <h3>Why 1000+ Schools<br>Partner with MaRRS</h3>
      <div class="title-underline underline-orange"></div>
      <div class="feature-grid">
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-shield-halved"></i></div>
          <span class="label">Enhances school reputation</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-rocket"></i></div>
          <span class="label">Develops future-ready skills</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-book-open"></i></div>
          <span class="label">Complements classroom learning</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-globe"></i></div>
          <span class="label">International benchmarking</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-user-group"></i></div>
          <span class="label">Student engagement</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-orange"><i class="fa-solid fa-comment-dots"></i></div>
          <span class="label">Teacher support</span>
        </div>
      </div>
    </div>
 
    <!-- Card 2 -->
    <div class="card card-purple my-2">
      <div class="card-icon icon-purple"><i class="fa-solid fa-people-group"></i></div>
      <h3>Trusted by Learners<br>Worldwide</h3>
      <div class="title-underline underline-blue"></div>
      <div class="feature-grid">
        <div class="feature-item">
          <div class="feature-icon feature-icon-purple"><i class="fa-solid fa-calendar-days"></i></div>
          <span class="stat-text">20+ Years of Impact</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-purple"><i class="fa-solid fa-graduation-cap"></i></div>
          <span class="stat-text">1 Million+ Students Annually</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-purple"><i class="fa-solid fa-person"></i></div>
          <span class="stat-text">Preschool to Grade 12</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-purple"><i class="fa-solid fa-trophy"></i></div>
          <span class="stat-text">National & International Championships</span>
        </div>
      </div>
    </div>
 
    <!-- Card 3 -->
    <div class="card card-light my-2">
      <div class="card-icon icon-green"><i class="fa-solid fa-chart-line"></i></div>
      <h3>What Every<br>Participant Gains</h3>
      <div class="title-underline underline-green"></div>
      <div class="feature-grid">
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-medal"></i></div>
          <span class="label">Confidence</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-comments"></i></div>
          <span class="label">Communication Skills</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-brain"></i></div>
          <span class="label">Critical Thinking</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-lightbulb"></i></div>
          <span class="label">Creativity</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-puzzle-piece"></i></div>
          <span class="label">Problem Solving</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon feature-icon-green"><i class="fa-solid fa-flask"></i></div>
          <span class="label">Scientific Inquiry</span>
        </div>
      </div>
    </div>
 
  </div>
 
  <div class="benefits-strip">
    <div class="benefit">
      <div class="benefit-icon bi-purple"><i class="fa-solid fa-shield-halved"></i></div>
      <div>
        <h4>Curriculum Aligned</h4>
        <p>Designed by experts to complement school learning.</p>
      </div>
    </div>
    <div class="benefit">
      <div class="benefit-icon bi-blue"><i class="fa-solid fa-globe"></i></div>
      <div>
        <h4>Global Exposure</h4>
        <p>Benchmark with the best across countries.</p>
      </div>
    </div>
    <div class="benefit">
      <div class="benefit-icon bi-orange"><i class="fa-solid fa-trophy"></i></div>
      <div>
        <h4 class="h-orange">Recognition &amp; Rewards</h4>
        <p>Celebrate achievements at every level.</p>
      </div>
    </div>
    <div class="benefit">
      <div class="benefit-icon bi-teal"><i class="fa-solid fa-chart-line"></i></div>
      <div>
        <h4>Data-Driven Insights</h4>
        <p>Detailed reports to track progress &amp; growth.</p>
      </div>
    </div>
    <div class="benefit">
      <div class="benefit-icon bi-pink"><i class="fa-solid fa-users"></i></div>
      <div>
        <h4 class="h-pink">End-to-End Support</h4>
        <p>We support schools &amp; teachers at every step.</p>
      </div>
    </div>
  </div>
 
  <div class="spacer"></div>
</section>

<!-- ===== SECTION 1: Trusted by Learners Worldwide (Indigo/Blue gradient) ===== -->
<!--<section class="py-5" style="background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%); overflow:hidden;">-->
<!--  <div class="container">-->

<!--    <div class="text-center mb-5">-->
<!--      <h2 class="fw-bold marrs-section-title mb-4" style="color:#fff; font-size:32px;">Trusted by Learners Worldwide</h2>-->
<!--    </div>-->
<!--    <div class="row g-4">-->
<!--      <div class="col-6 col-md-3 marrs-fade-up" style="animation-delay:0.05s;">-->
<!--        <div class="marrs-stat-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.15);">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:56px; height:56px; background:#fff; border-radius:50%;">-->
<!--            <i class="fas fa-calendar-alt" style="color:#f97316; font-size:22px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#fff; font-weight:600;">20+ Years of Impact</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-3 marrs-fade-up" style="animation-delay:0.15s;">-->
<!--        <div class="marrs-stat-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.15);">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:56px; height:56px; background:#fff; border-radius:50%;">-->
<!--            <i class="fas fa-user-graduate" style="color:#f97316; font-size:22px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#fff; font-weight:600;">1 Million+ Students Annually</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-3 marrs-fade-up" style="animation-delay:0.25s;">-->
<!--        <div class="marrs-stat-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.15);">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:56px; height:56px; background:#fff; border-radius:50%;">-->
<!--            <i class="fas fa-child" style="color:#f97316; font-size:22px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#fff; font-weight:600;">Preschool to Grade 12</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-3 marrs-fade-up" style="animation-delay:0.35s;">-->
<!--        <div class="marrs-stat-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:rgba(255,255,255,0.08); backdrop-filter:blur(4px); border:1px solid rgba(255,255,255,0.15);">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:56px; height:56px; background:#fff; border-radius:50%;">-->
<!--            <i class="fas fa-trophy" style="color:#f97316; font-size:22px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#fff; font-weight:600;">National &amp; International Championships</span>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--  </div>-->
<!--</section>-->

<!-- ===== SECTION 2: What Every Participant Gains (White bg, colored content) ===== -->
<!--<section class="py-5" style="background: #ffffff;">-->
<!--  <div class="container">-->

<!--    <div class="text-center mb-5">-->
<!--      <h2 class="fw-bold marrs-section-title mb-4" style="color:#1e1b4b; font-size:32px;">What Every Participant Gains</h2>-->
<!--    </div>-->
<!--    <div class="row g-4 justify-content-center">-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.05s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#f5f4fd; border:1px solid #e0defa;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(67,56,202,0.15);">-->
<!--            <i class="fas fa-fist-raised" style="color:#4f46e5; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Confidence</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.12s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#fff4ec; border:1px solid #fbd9bc;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(249,115,22,0.15);">-->
<!--            <i class="fas fa-comments" style="color:#f97316; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Communication Skills</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.19s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#eefcf3; border:1px solid #bdf0d2;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(16,185,129,0.15);">-->
<!--            <i class="fas fa-brain" style="color:#10b981; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Critical Thinking</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.26s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#fffbea; border:1px solid #fbedb0;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(217,164,6,0.15);">-->
<!--            <i class="fas fa-lightbulb" style="color:#d97706; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Creativity</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.33s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#eef6ff; border:1px solid #bfe0fb;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(2,132,199,0.15);">-->
<!--            <i class="fas fa-puzzle-piece" style="color:#0284c7; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Problem Solving</span>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-6 col-md-4 marrs-fade-up" style="animation-delay:0.40s;">-->
<!--        <div class="marrs-gain-card d-flex flex-column align-items-center text-center p-4 rounded-4 h-100" style="background:#fdeef3; border:1px solid #f7c5d8;">-->
<!--          <span class="marrs-icon-circle d-flex align-items-center justify-content-center mb-3" style="width:50px; height:50px; background:#fff; border-radius:50%; box-shadow:0 2px 6px rgba(219,39,119,0.15);">-->
<!--            <i class="fas fa-flask" style="color:#db2777; font-size:19px; transition:color .3s ease;"></i>-->
<!--          </span>-->
<!--          <span style="font-size:15px; color:#1e1b4b; font-weight:600;">Scientific Inquiry</span>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--  </div>-->
<!--</section>-->
<!-- ── Carousel ── -->
<!--<div class="container mt-3">-->
<!--  <div id="demo" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true" data-bs-interval="3000">-->
<!--    <div class="carousel-inner">-->
<!--      <div class="carousel-item active">-->
<!--        <img class="img-fluid w-100" src="https://marrs.in/newassets/slide900X600__2026_01.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="img-fluid w-100" src="https://marrs.in/newassets/slide900X600__2026_02.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="img-fluid w-100" src="https://marrs.in/newassets/slide900X600__2026_03.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="img-fluid w-100" src="https://marrs.in/newassets/slide900X600__2026_04.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="img-fluid w-100" src="https://marrs.in/newassets/slide900X600_02.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_13.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_01.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_03.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_04.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_05.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_06.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_07.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_08.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_09.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_10.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_11.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide900X600_12.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_01.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_02.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_03.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_04.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_05.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_06.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_07.jpg" alt="carousel">-->
<!--      </div>-->
<!--      <div class="carousel-item">-->
<!--        <img class="d-block w-100 img-fluid" src="https://marrs.in/newassets/slide/slide900X600_08.jpg" alt="carousel">-->
<!--      </div>-->
<!--    </div>-->
<!--    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">-->
<!--      <span class="carousel-control-prev-icon"></span>-->
<!--    </button>-->
<!--    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">-->
<!--      <span class="carousel-control-next-icon"></span>-->
<!--    </button>-->
<!--  </div>-->
<!--</div>-->

<!-- ── MaRRS Challenges ── -->
<!--<section class="products">-->
<!--  <div class="container">-->
<!--    <div class="section-header">-->
<!--      <h2 class="product-title">MaRRS Challenges: Igniting Potential</h2>-->
<!--    </div>-->
<!--    <div class="slider">-->
<!--      <div class="slides">-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="/spellingbee" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/misb-slide-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="/mathbee.php" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/mimb-slide-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="/scientia_exertus.php" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/SE-logo.jpg"></a></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/wordchase-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/mazeofword-slide-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/mystery-slide-logo.jpg"></a></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="/spellingbeej" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/misbj-slide-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/p2l-slide-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/PSB-Math-logo.jpg"></a></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/PSB-English-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/PSB-Science-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/PSB-Humanities-logo.jpg"></a></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/Primary-Colors-English.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/Primary-Colors-Math.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/Primary-Color-Science.jpg"></a></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/Spellfor-logo.jpg"></a></div>-->
<!--          <div class="product-card"><a href="#" class="btn"><img class="img-fluid w-100" src="https://marrs.in/newassets/spell_o_war.jpg"></a></div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <button class="prev">&#10094;</button>-->
<!--      <button class="next">&#10095;</button>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->

<!-- ── Regular Assessment Programs ── -->
<!--<section class="logo-content-section pt-5">-->
<!--  <div class="container">-->
<!--    <h2 class="text-center mb-5 regular-program">MaRRS Regular Assessment Programs</h2>-->
<!--    <div class="container row">-->
<!--      <div class="col-6">-->
<!--        <a href="/lunarskil.php"><img class="img-fluid w-100" src="https://marrs.in/newassets/lunarslide_1.jpg" alt="Lunar"></a>-->
<!--      </div>-->
<!--      <div class="col-6">-->
<!--        <a href="/zoomzoom.php"><img class="img-fluid w-100" src="https://marrs.in/newassets/zoomslide_2.jpg" alt="Zoom"></a>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->

<!-- ── MaRRS Programs ── -->
<!--<section class="slide" id="slide8" style="padding-bottom: 100px; padding-top: 60px;">-->
<!--  <div class="container text-center">-->
<!--    <h2 class="learning-program">MaRRS Programs</h2>-->
<!--    <div class="slider">-->
<!--      <div class="slides">-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/Youngwriterslibrary.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/SIP-logo.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/ILPS-logo.jpg"></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/adoreme.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/bye.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/kinder.jpg"></div>-->
<!--        </div>-->
<!--        <div class="slide">-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/infantasy.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/englisg-club.jpg"></div>-->
<!--          <div class="product-card"><img class="img-fluid w-100" src="https://marrs.in/newassets/infantasy-preschools.jpg"></div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <button class="prev">&#10094;</button>-->
<!--      <button class="next">&#10095;</button>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->

<!--<a href="<?//= base_url('mathtab/sso') ?>" class="btn btn-primary">-->
<!--  Open MathTab-->
<!--  <span class="arrow">→</span>-->
<!--</a>-->

<script>
  document.querySelectorAll('.slider').forEach(slider => {
    const slides = slider.querySelector('.slides');
    const slideItems = slider.querySelectorAll('.slide');
    const prev = slider.querySelector('.prev');
    const next = slider.querySelector('.next');
    let index = 0;

    function showSlide(i) {
      index = (i + slideItems.length) % slideItems.length;
      slides.style.transform = `translateX(-${index * 100}%)`;
    }

    prev.addEventListener('click', () => showSlide(index - 1));
    next.addEventListener('click', () => showSlide(index + 1));
  });
</script>

<?php include('footertest.php'); ?>