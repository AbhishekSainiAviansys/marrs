<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('checkout_nav');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Choose a Plan — Lunar Assessments</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
*{font-family:'Inter',system-ui,-apple-system,sans-serif;box-sizing:border-box;}
html{font-size:16px;}
:root{
    --navy:#1b2a4b;
    --blue:#3155E7; --blue-dark:#2442B8; --blue-soft:#EAF0FF;
    --bg:#F6F8FC; --card:#FFFFFF;
    --text-dark:#172033; --text-muted:#667085; --border:#DDE2EA;
    --green:#16A34A; --green-bg:#E3F8EA;
    --red:#DC3545; --danger-soft:#FDECEE; --danger-high:#f2533a;
    --font:'Inter',system-ui,-apple-system,sans-serif;

    /* Make Bootstrap's own primary/danger match the brand palette */
    --bs-primary:#3155E7;
    --bs-primary-rgb:49,85,231;
    --bs-danger:#DC3545;
    --bs-body-font-family:var(--font);

    --fs-scale:1;
}
body{margin:0;font-family:var(--font);background:var(--bg);color:var(--text-dark);font-size:14px;line-height:1.5;-webkit-text-size-adjust:100%;text-rendering:optimizeLegibility;}

/* =========================================================
   RESPONSIVE MAIN WRAPPER
   Keeps content visually balanced on every screen size
========================================================= */

.wrap {
    width: 100%;
    max-width: auto;
    margin: 0 auto;

    padding: 2rem 4rem;
}

/* Medium screens */
/*@media (min-width: 768px) {*/
/*    .wrap {*/
/*        max-width: 1800px;*/

/*        padding-left: clamp(28px, 3vw, 50px);*/
/*        padding-right: clamp(28px, 3vw, 50px);*/

/*        padding-top: 24px;*/
/*        padding-bottom: 60px;*/
/*    }*/
/*}*/

/* Large desktop */
/*@media (min-width: 1200px) {*/
/*    .wrap {*/
/*        max-width: 1900px;*/

/*        padding-left: clamp(40px, 3vw, 70px);*/
/*        padding-right: clamp(40px, 3vw, 70px);*/

/*        padding-top: 26px;*/
/*        padding-bottom: 70px;*/
/*    }*/
/*}*/

/* Extra large desktop */
/*@media (min-width: 1600px) {*/
/*    .wrap {*/
/*        max-width: 2100px;*/

/*        padding-left: clamp(50px, 3.5vw, 90px);*/
/*        padding-right: clamp(50px, 3.5vw, 90px);*/

/*        padding-top: 30px;*/
/*        padding-bottom: 80px;*/
/*    }*/
/*}*/

/* 1920px+ */
/*@media (min-width: 1920px) {*/
/*    .wrap {*/
/*        max-width: 2250px;*/

/*        padding-left: clamp(60px, 4vw, 110px);*/
/*        padding-right: clamp(60px, 4vw, 110px);*/

/*        padding-top: 32px;*/
/*        padding-bottom: 90px;*/
/*    }*/
/*}*/

/* 2400px+ */
/*@media (min-width: 2400px) {*/
/*    .wrap {*/
/*        max-width: 2500px;*/

/*        padding-left: clamp(80px, 4vw, 130px);*/
/*        padding-right: clamp(80px, 4vw, 130px);*/

/*        padding-top: 36px;*/
/*        padding-bottom: 100px;*/
/*    }*/
/*}*/


/* =========================================================
   HERO HEADING
========================================================= */

.hero-heading-row {
    width: 100%;

    display: flex;
    align-items: flex-start;

    gap: clamp(10px, 1vw, 18px);
}

.hero-icon-badge {
    width: clamp(44px, 3vw, 60px);
    height: clamp(44px, 3vw, 60px);

    border-radius: 50%;

    flex: 0 0 auto;

    background: linear-gradient(
        135deg,
        #7c5cff,
        #3155E7
    );

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow:
        0 8px 18px rgba(76,58,255,.28);
}

.hero-icon-badge svg {
    width: clamp(19px, 1.4vw, 26px);
    height: clamp(19px, 1.4vw, 26px);
}
/* ---- Progress card (Bootstrap flex based stepper) ---- */
.progress-card{
    background:var(--card);border:1px solid var(--border);border-radius:16px;
    padding:14px 18px;margin:16px 0 22px;
}
.progress-title{font-size:calc(15px * var(--fs-scale));font-weight:700;color:var(--text-dark);white-space:nowrap;}
.phase-icon{
    width:34px;height:34px;border-radius:50%;border:2px solid var(--border);background:#fff;
    font-size:calc(14px * var(--fs-scale));font-weight:700;color:var(--text-muted);flex-shrink:0;
}
.phase-step.done .phase-icon{background:var(--green);border-color:var(--green);color:#fff;}
.phase-step.active .phase-icon{background:var(--card);border-color:var(--blue);color:var(--blue);}
.phase-step.locked .phase-icon{color:#b7bccb;border-color:var(--border);}
.phase-name{font-size:calc(13.5px * var(--fs-scale));font-weight:700;color:var(--text-dark);white-space:nowrap;}
.phase-status{font-size:calc(11.5px * var(--fs-scale));font-weight:600;color:var(--text-muted);white-space:nowrap;}
.phase-step.active .phase-status{color:var(--blue);font-weight:600;}
.phase-step.done .phase-status{color:var(--green);}
.phase-step.locked .phase-name{color:#A7AEBD;}
.phase-connector{flex:1 1 24px;min-width:16px;height:2px;background:#d8dce6;}
.phase-connector.filled{background:var(--green);}
@media (max-width:576px){.phase-status{display:none;}.phase-connector{min-width:10px;}}

/* ---- Program list ---- */
.section-title{    font-size: calc(27px * var(--fs-scale))!important;
    color: #e95324;font-weight:800;margin:2rem 0;display:flex;align-items:center;gap:9px;line-height: 1.3;}
.section-title-icon{
    width:30px;height:30px;flex-shrink:0;display:grid;grid-template-columns:1fr 1fr;gap:3px;
}
.section-title-icon i{background:linear-gradient(135deg,#ff7a45,#e95324);border-radius:3px;display:block;}

.program-card{
    background:var(--card);border:1px solid #e4e9f2;border-radius:16px;padding:20px;
    transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;
    height:100%;display:flex;flex-direction:column;
}
.program-card:hover{border-color:var(--blue);box-shadow:0 10px 26px rgba(27,42,75,.09);transform:translateY(-2px);}

.program-subject{
    display:inline-block;font-size:calc(16px * var(--fs-scale));text-transform:uppercase;letter-spacing:.6px;
    color:var(--blue);font-weight:800;margin-bottom:10px;background:var(--blue-soft);
    padding:5px 12px;border-radius:20px;
}
.program-name{font-size:calc(25px * var(--fs-scale));font-weight:800;margin-bottom:4px;color:var(--navy);line-height:1.3;}
.program-tagline{font-size:calc(15px * var(--fs-scale));font-weight:700;color:var(--blue);margin-bottom:8px;}
.program-desc{font-size:calc(18px * var(--fs-scale));color:#4B5468;line-height:1.6;margin:0 0 14px;font-weight:500;
    display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.program-header .program-desc{-webkit-line-clamp:unset;margin:8px 0 0;max-width:640px;}
.program-meta{font-size:calc(12px * var(--fs-scale));color:var(--text-muted);line-height:1.6;font-weight:500;}
.program-meta b{color:var(--text-dark);font-weight:700;}
.program-cta{margin-top:14px;font-size:calc(12.5px * var(--fs-scale));font-weight:700;color:var(--blue);}

/* ---- Meta info boxes: Grade / Academic Year / Duration ---- */
.program-meta-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px;margin-bottom:14px;}
@media (max-width:420px){.program-meta-grid{grid-template-columns:1fr;}}
.program-meta-box{
    border:1px solid var(--border);border-radius:12px;padding:9px 11px;display:flex;align-items:center;gap:8px;
    background:#fafbff;min-width:0;
}
.program-meta-box .icon{
    width:35px;height:35px;border-radius:9px;background:var(--blue-soft);color:var(--blue);
    display:flex;align-items:center;justify-content:center;flex-shrink:0;
}
.program-meta-box .txt{min-width:0;}
.program-meta-box .label{font-size:calc(14px * var(--fs-scale));text-transform:uppercase;letter-spacing:.5px;font-weight:800;color:var(--text-muted);}
.program-meta-box .value{font-size:calc(13px * var(--fs-scale));font-weight:800;color:var(--text-dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

/* ---- What's Included pills ---- */
.included-label{font-size:calc(14px * var(--fs-scale));font-weight:800;color:var(--text-dark);margin-bottom:8px;}
.included-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;}
.included-pill{
    display:inline-flex;align-items:center;gap:6px;background:var(--green-bg);color:var(--green);
    font-size:calc(12px * var(--fs-scale));font-weight:700;padding:6px 12px;border-radius:20px;
}
.included-pill svg{flex-shrink:0;}

/* ---- Action row: View Syllabus / Explore Program ---- */
.program-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:auto;}
.btn-outline-program{
    flex:1 1 auto;display:inline-flex;align-items:center;justify-content:center;gap:7px;
    color:#fff;background:var(--red);font-weight:700;
    font-size:calc(17px * var(--fs-scale));padding:11px 14px;border-radius:10px;text-decoration:none;white-space:nowrap;
    transition:.18s ease;
}
.btn-outline-program:hover{background:#2459ca;
    color:#fff !important;
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(47,107,234,.25);}
.btn-solid-program{
    flex:1.4 1 auto;display:inline-flex;align-items:center;justify-content:center;gap:8px;
    border:0;color:#fff;background:var(--blue);font-weight:700;
    font-size:calc(17px * var(--fs-scale));padding:11px 16px;border-radius:8px;
    box-shadow:0 6px 14px rgba(47,95,224,.25);transition:.18s ease;cursor:pointer;
}
.btn-solid-program:hover{background:var(--blue-dark);transform:translateY(-1px);color:#fff;}
.program-doc-links{display:flex;flex-wrap:wrap;gap:14px;margin:-2px 0 14px;}
.program-doc-links a{font-size:calc(12px * var(--fs-scale));font-weight:700;color:var(--red);text-decoration:none;display:inline-flex;align-items:center;gap:5px;}
.program-doc-links a:hover{text-decoration:underline;}

/* ---- Uploaded docs: syllabus / circular / test schedule (dashboard-style buttons) ---- */
.doc-link.btn{
    background:var(--red);color:#fff;border:1px solid var(--danger-soft);
    font-weight:700;font-size:calc(17px * var(--fs-scale));border-radius:8px;
    padding:11px 14px;white-space:nowrap;
}
.doc-link.btn:hover{background:#2459ca;
    color:#fff !important;
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(47,107,234,.25);}
#programResources .doc-link.btn{border-width:2px;}

.resource-block{background:#F8FAFF;border:1px solid #E5E9F5;border-radius:12px;padding:14px 16px;margin-bottom:14px;}
.resource-block .block-heading{font-size:calc(14px * var(--fs-scale));margin:0 0 8px;}
.empty-note{color:var(--text-muted);font-size:calc(14px * var(--fs-scale));}

/* ---- Back link (dashboard outline-danger button) ---- */
.back-link.btn{
    background:#fff;border:1px solid var(--danger-soft);color:var(--red);
    font-weight:700;font-size:calc(17px * var(--fs-scale));border-radius:10px;padding:9px 16px;
}
.back-link.btn::hover{
    background:#2459ca;
    color:#fff !important;
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(47,107,234,.25);
}

/* ---- Program header ---- */
.program-header{margin-bottom:20px;}
.program-header h1{font-size:calc(20px * var(--fs-scale));font-weight:800;margin:0 0 6px;color:var(--navy);}
.program-header .program-meta{font-size:calc(13px * var(--fs-scale));font-weight:500;}
.program-header-desc-wrap{margin-top:10px;max-width:850px;}
.program-header-desc{font-size:calc(13.5px * var(--fs-scale));line-height:1.6;color:#161921;font-weight:500;
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

.block-heading{font-size:calc(15px * var(--fs-scale));font-weight:700;margin:0 0 12px;display:flex;align-items:center;gap:8px;color:var(--text-dark);}

/* ---- Purchase layout (tabs / custom plan block + cart) ---- */
.purchase-block{background:#fff;border:1px solid var(--border);border-radius:16px;padding:18px;}

/* Bootstrap nav-tabs, styled to match dashboard's .program-tab pill-tab look */
.plan-tabs.nav-tabs{border-bottom:0;gap:8px;flex-wrap:wrap;}
.plan-tab.nav-link{
    font-family:var(--font);font-size:calc(12.5px * var(--fs-scale));font-weight:800;color:#66728a;
    border:1px solid #dfe5f1;border-radius:10px;padding:9px 14px;margin-bottom:0;transition:.2s;
}
.plan-tab.nav-link:hover{color:#fff;background:var(--blue);border-color:var(--blue);}
.plan-tab.nav-link.active{background:var(--blue);border-color:var(--blue);color:#fff;box-shadow:0 5px 12px rgba(47,95,224,.18);}

.tab-pane{padding-top:18px;}

/* Filter chips — matches dashboard .filter-chip pill style */
.filter-chip.btn{
    border:2px solid #3F51B5;background:#fff;color:#3F51B5;border-radius:20px;
    padding:6px 13px;font-size:calc(14px * var(--fs-scale));font-weight:700;transition:.18s;
}
.filter-chip.btn:hover{border-color:var(--blue);color:var(--blue);}
.filter-chip.btn.active{background:var(--blue);border-color:var(--blue);color:#fff;}
.filter-chip .chip-count{margin-left:5px;font-size:calc(14px * var(--fs-scale));opacity:.75;}

/* Plan cards */
.plan-card{
    border:1px solid #e4e9f2;border-radius:14px;padding:18px;background:var(--card);
    display:flex;flex-direction:column;transition:transform .18s ease,box-shadow .18s ease;height:100%;
}
.plan-card:hover{border-color:var(--blue);box-shadow:0 8px 22px rgba(27,42,75,.08);transform:translateY(-2px);}
.plan-name{font-size:calc(15px * var(--fs-scale));font-weight:800;margin-bottom:4px;color:var(--navy);}
.plan-duration{font-size:calc(11.5px * var(--fs-scale));color:var(--text-muted);margin-bottom:10px;font-weight:600;}
.plan-price-row{display:flex;align-items:baseline;flex-wrap:wrap;gap:8px;margin-bottom:14px;}
.plan-price{font-size:calc(20px * var(--fs-scale));font-weight:800;color:var(--text-dark);}
.plan-strike{font-size:calc(13px * var(--fs-scale));color:var(--text-muted);text-decoration:line-through;}
.plan-discount{font-size:calc(11px * var(--fs-scale));font-weight:700;color:var(--green);background:var(--green-bg);padding:3px 9px;border-radius:20px;}

.plan-includes{margin:2px 0 14px;padding-top:10px;border-top:1px dashed var(--border);}
.plan-includes-label{font-size:calc(11px * var(--fs-scale));font-weight:800;text-transform:uppercase;letter-spacing:.05em;color:#3F51B5;margin-bottom:6px;}
.plan-includes-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:5px;}
.plan-includes-list li{display:flex;justify-content:space-between;gap:8px;font-size:calc(13px * var(--fs-scale));color:#4B5468;font-weight:500;}
.plan-includes-list .pi-qty{font-weight:700;color:var(--text-dark);white-space:nowrap;}

/* ================= BUTTONS — dashboard btn-solid-custom / btn-outline-custom look, BIG & bold ================= */
.cart-btn.btn,
.add-component-btn.btn{
        min-width: 105px;
    background: #2f69e8;
    color: #fff;
    border: 0 !important;
    border-radius: 6px;
    font-size: 11px !important;
    font-weight: 800;
    padding: 9px 12px !important;
    box-shadow: 0 5px 10px rgba(49, 85, 231, .16);
    transition: .18s ease;
    margin-top: 0;
}
.cart-btn.btn:hover:not([disabled]),
.add-component-btn.btn:hover{background:var(--blue);border-color:var(--blue);color:#fff;}
.cart-btn.btn.btn-success{background:var(--green);border-color:var(--green);color:#fff;}
.cart-btn.btn.purchased{background:var(--green-bg);color:var(--green);border-color:var(--green-bg);cursor:default;}

.cart-checkout-btn.btn{
    background: #2166e2 !important;
    color: #e9ecf4 !important;border:0;font-weight:700;
    font-size:calc(17px * var(--fs-scale))!important;padding:11px 16px;border-radius:8px;
    box-shadow:0 6px 14px rgba(47,95,224,.25);transition:background .18s ease,transform .18s ease;
}
.cart-checkout-btn.btn:hover{background:var(--blue-dark)!important;color:#fff;transform:translateY(-1px);}
/*.cart-checkout-btn.btn.disabled{opacity:.5;box-shadow:none;transform:none;}*/

.read-more-btn.btn{
    color:var(--blue);font-weight:700;font-size:calc(14px * var(--fs-scale))!important; border:1px solid blue; border-radius:5px;
    padding:5px!important;margin-top:5px;margin-bottom:5px;
}
.read-more-btn.btn:hover{text-decoration:underline;}

.add-component-btn.btn, .cart-btn.btn{margin-top:auto;}

/* Component rows (custom plan) */
.component-row{
    border:1px solid var(--border);border-radius:12px;padding:14px 16px;background:var(--card);
    transition:.18s ease;
}
.component-row:hover{border-color:#cbd5ff;background:#fbfcff;}
.component-info .c-name{font-weight:700;font-size:calc(18px * var(--fs-scale));color:var(--text-dark);}
.component-info .c-meta{font-size:calc(16px * var(--fs-scale));color:var(--text-muted);margin-top:2px;font-weight:500;}
.component-price{font-size:calc(14.5px * var(--fs-scale));font-weight:800;color:var(--text-dark);white-space:nowrap;}
.component-week-select.form-select{font-size:calc(13px * var(--fs-scale));font-weight:600;width:auto;min-width:130px;border-radius:9px;}
.component-week-note{font-size:calc(15px * var(--fs-scale));color:var(--green);font-weight:700;}

/* Cart sidebar */
.cart-card{background:var(--card);border:1px solid var(--border);border-radius:16px;padding:20px;}
.cart-card h2{font-size:calc(15px * var(--fs-scale));font-weight:800;margin:14px 0 14px;padding-bottom:12px;border-bottom:1px solid var(--border);color:var(--navy);}
.cart-line{display:flex;justify-content:space-between;gap:10px;font-size:calc(13px * var(--fs-scale));padding:10px 0;border-bottom:1px solid var(--border);}
.cart-line:last-of-type{border-bottom:none;}
.cart-line .cl-name{font-weight:700;color:var(--text-dark);}
.cart-line .cl-meta{font-size:calc(11.5px * var(--fs-scale));color:var(--text-muted);font-weight:500;}
.cart-line .cl-price{font-weight:800;color:var(--text-dark);white-space:nowrap;}
.cart-line .cl-remove{font-size:calc(12px * var(--fs-scale))!important;font-weight:700;}
.cart-empty{color:var(--text-muted);font-size:calc(14px * var(--fs-scale));padding:8px 0;}
.cart-total-row{display:flex;justify-content:space-between;align-items:center;font-size:calc(15px * var(--fs-scale));font-weight:800;
    padding-top:12px;margin-top:6px;border-top:1px solid var(--border);}
.cart-total-row span.amount{color:var(--blue);font-size:calc(19px * var(--fs-scale));}

.program-desc-wrap{margin-top:8px;}

/* =========================================
   DESCRIPTION MODAL (Bootstrap modal, rich text body)
========================================= */
.description-popup-body{font-size:calc(15px * var(--fs-scale));font-weight:500;line-height:1.7;color:#1E2246;word-wrap:break-word;}
.description-popup-body h1,.description-popup-body h2,.description-popup-body h3,
.description-popup-body h4,.description-popup-body h5,.description-popup-body h6{
    color:var(--text-dark);font-weight:800;line-height:1.35;margin:20px 0 8px;
}
.description-popup-body h1{font-size:calc(21px * var(--fs-scale));}
.description-popup-body h2{font-size:calc(19px * var(--fs-scale));}
.description-popup-body h3{font-size:calc(17px * var(--fs-scale));}
.description-popup-body h4{font-size:calc(15.5px * var(--fs-scale));}
.description-popup-body h5,.description-popup-body h6{font-size:calc(14.5px * var(--fs-scale));}
.description-popup-body > :first-child{margin-top:0;}
.description-popup-body > :last-child{margin-bottom:0;}
.description-popup-body p{margin:0 0 12px;}
.description-popup-body strong,.description-popup-body b{color:var(--text-dark);font-weight:700;}
.description-popup-body ul,.description-popup-body ol{margin:0 0 14px;padding-left:24px;}
.description-popup-body ul{list-style:disc;}
.description-popup-body ol{list-style:decimal;}
.description-popup-body li{margin-bottom:7px;padding-left:2px;}
.description-popup-body a{color:var(--blue);text-decoration:underline;}
.description-popup-body blockquote{margin:0 0 14px;padding:8px 14px;border-left:3px solid var(--blue);background:var(--blue-soft);}
.description-popup-body table{border-collapse:collapse;width:100%;margin-bottom:14px;}
.description-popup-body th,.description-popup-body td{border:1px solid var(--border);padding:7px 10px;text-align:left;}
.description-popup-body th{background:#F8FAFF;color:var(--text-dark);}

@media (max-width:576px){
    .wrap{padding-left:16px;padding-right:16px;}
}

/* ================= Large-screen scale-up, matching the dashboard's --fs-scale pattern ================= */
/*@media (min-width:1537px){*/
/*  :root{ --fs-scale: clamp(1, calc(0.9 + 0.1 * (100vw / 1537px)), 1.15); }*/
/*  .hero-title{font-size:calc(28px * var(--fs-scale));}*/
/*  .hero-sub{font-size:calc(16px * var(--fs-scale));}*/
/*  .section-title{font-size:calc(18px * var(--fs-scale));}*/
/*  .program-name{font-size:calc(17px * var(--fs-scale));}*/
/*  .program-desc{font-size:calc(15px * var(--fs-scale));}*/
/*  .program-header h1{font-size:calc(26px * var(--fs-scale));}*/
/*  .plan-price{font-size:calc(23px * var(--fs-scale));}*/
/*  .cart-btn.btn,.add-component-btn.btn{font-size:calc(15px * var(--fs-scale))!important;padding:11px 20px;}*/
/*  .cart-checkout-btn.btn{font-size:calc(17px * var(--fs-scale))!important;padding:14px 22px;}*/
/*  .back-link.btn{font-size:calc(15px * var(--fs-scale));padding:10px 18px;}*/
/*}*/
/* =========================================================
   RESPONSIVE DESKTOP SCALING
   Keeps the same UI but increases proportions on larger
   screens. Mobile is intentionally excluded.
   ========================================================= */

:root{
    --ui-scale: 1;
}

/* 1440px → base */
@media (min-width:1200px){
    :root{
        --ui-scale: clamp(
            1,
            calc(1 + (100vw - 1200px) / 6000),
            1.12
        );
    }
}

/* 1600px+ */
@media (min-width:1600px){
    :root{
        --ui-scale: clamp(
            1.04,
            calc(1.04 + (100vw - 1600px) / 5000),
            1.18
        );
    }
}

/* 1920px+ */
@media (min-width:1920px){
    :root{
        --ui-scale: clamp(
            1.10,
            calc(1.10 + (100vw - 1920px) / 4500),
            1.25
        );
    }
}

/* 2400px+ */
@media (min-width:2400px){
    :root{
        --ui-scale: clamp(
            1.17,
            calc(1.17 + (100vw - 2400px) / 3500),
            1.32
        );
    }
}
/* =========================================================
   RESPONSIVE DESKTOP SCALING
   Keeps the same UI but increases proportions on larger
   screens. Mobile is intentionally excluded.
   ========================================================= */

:root{
    --ui-scale: 1;
}

/* 1440px → base */
@media (min-width:1200px){
    :root{
        --ui-scale: clamp(
            1,
            calc(1 + (100vw - 1200px) / 6000),
            1.12
        );
    }
}

/* 1600px+ */
@media (min-width:1600px){
    :root{
        --ui-scale: clamp(
            1.04,
            calc(1.04 + (100vw - 1600px) / 5000),
            1.18
        );
    }
}

/* 1920px+ */
@media (min-width:1920px){
    :root{
        --ui-scale: clamp(
            1.10,
            calc(1.10 + (100vw - 1920px) / 4500),
            1.25
        );
    }
}

/* 2400px+ */
@media (min-width:2400px){
    :root{
        --ui-scale: clamp(
            1.17,
            calc(1.17 + (100vw - 2400px) / 3500),
            1.32
        );
    }
}
/* =========================================================
   SCALE TYPOGRAPHY
   ========================================================= */

@media (min-width:1200px){

    body{
        font-size:calc(14px * var(--ui-scale));
    }

    /*.wrap{*/
    /*    padding-left:calc(50px * var(--ui-scale));*/
    /*    padding-right:calc(50px * var(--ui-scale));*/
    /*    padding-bottom:calc(60px * var(--ui-scale));*/
    /*}*/

    /* Main heading */
    .hero-title{
        font-size:1.5rem ;
        font-weight:800;
    }

    .hero-sub{
        font-size:calc(14px * var(--ui-scale));
    }

    /* Section headings */
    .section-title{
        font-size:calc(18px * var(--ui-scale));
    }

    /* Program cards */
    /*.program-name{*/
    /*    font-size:calc(1.5rem * var(--ui-scale));*/
    /*}*/

    /*.program-desc{*/
    /*    font-size:calc(15px * var(--ui-scale));*/
    /*}*/

    .program-header h1{
        font-size:calc(26px * var(--ui-scale));
    }

    /* Plan */
    .plan-name{
        font-size:calc(17px * var(--ui-scale));
    }

    .plan-price{
        font-size:calc(23px * var(--ui-scale));
    }

    /* Cart */
    .cart-card h2{
        font-size:calc(18px * var(--ui-scale));
    }

    .cart-checkout-btn{
        font-size:calc(17px * var(--ui-scale)) !important;
    }

    /* Back / syllabus */
    .back-link{
        font-size:calc(17px * var(--ui-scale)) !important;
    }

    .top-syllabus-btn{
        font-size:calc(14px * var(--ui-scale));
    }

    /* General buttons */
    .cart-btn,
    .add-component-btn{
        font-size:calc(14px * var(--ui-scale)) !important;
    }

    /* Small text */
    .phase-name{
        font-size:calc(13px * var(--ui-scale));
    }

    .phase-status{
        font-size:calc(11px * var(--ui-scale));
    }
}
@media (min-width:1200px){

    .progress-card{
        padding:calc(14px * var(--ui-scale))
                calc(18px * var(--ui-scale));
        border-radius:calc(16px * var(--ui-scale));
    }

    .program-header{
        padding:calc(24px * var(--ui-scale));
        border-radius:calc(16px * var(--ui-scale));
    }

    .purchase-block{
        border-radius:calc(14px * var(--ui-scale));
    }

    .plan-card{
        padding:calc(14px * var(--ui-scale))
                calc(16px * var(--ui-scale));
        border-radius:calc(12px * var(--ui-scale));
    }

    .cart-card{
        padding:calc(18px * var(--ui-scale));
        border-radius:calc(14px * var(--ui-scale));
    }

    .program-card{
        border-radius:calc(14px * var(--ui-scale));
    }

    .cart-btn,
    .add-component-btn{
        padding-top:calc(10px * var(--ui-scale));
        padding-bottom:calc(10px * var(--ui-scale));
        padding-left:calc(18px * var(--ui-scale));
        padding-right:calc(18px * var(--ui-scale));
        border-radius:calc(8px * var(--ui-scale));
    }

    .cart-checkout-btn{
        padding-top:calc(13px * var(--ui-scale)) !important;
        padding-bottom:calc(13px * var(--ui-scale)) !important;
        border-radius:calc(8px * var(--ui-scale));
    }

    .top-syllabus-btn{
        padding-top:calc(10px * var(--ui-scale));
        padding-bottom:calc(10px * var(--ui-scale));
        padding-left:calc(18px * var(--ui-scale));
        padding-right:calc(18px * var(--ui-scale));
    }
}
@media (min-width:1200px){

    /*.hero-icon-badge{*/
    /*    width:calc(52px * var(--ui-scale));*/
    /*    height:calc(52px * var(--ui-scale));*/
    /*}*/

    /*.hero-icon-badge svg{*/
    /*    width:calc(22px * var(--ui-scale));*/
    /*    height:calc(22px * var(--ui-scale));*/
    /*}*/

    /*.section-title-icon{*/
    /*    width:calc(30px * var(--ui-scale));*/
    /*    height:calc(30px * var(--ui-scale));*/
    /*}*/

    /*.phase-icon{*/
    /*    width:calc(32px * var(--ui-scale));*/
    /*    height:calc(32px * var(--ui-scale));*/
    /*}*/
}
/* =========================================================
   SCREENSHOT-STYLE PROGRAM DETAIL UI
   Keeps existing PHP/data/JS behaviour; visual/layout only.
   ========================================================= */
.detail-page{margin-top:0.25rem;}
.detail-page .back-link{
        background: #e8425a;
    border: 0;
    color: #f6f7fb !important;
    padding: 11px 20px;
    font-size: 17px;
    font-weight: 700;
    border-radius: 5px;
    box-shadow: none;
}
.detail-page .back-link::hover{
    background:#2459ca !important;
    color:#fff !important;
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(47,107,234,.25);
}

.program-hero-card{
    position:relative;display:grid;grid-template-columns:minmax(0,1fr) 330px;
    gap:18px;background:linear-gradient(115deg,#fff 0%,#fbfdff 65%,#f5f8ff 100%);
    border:1px solid #dce6f7;border-radius:10px;padding:22px 24px 14px;
    box-shadow:0 1px 2px rgba(24,44,84,.02);overflow:hidden;margin-bottom:14px;
}
.program-hero-content{display:contents;}
.hero-left{min-width:0;}
.hero-subject-badge{
    display:inline-flex;align-items:center;background:#e8f0ff;color:#2457cf;
    border-radius:6px;padding:4px 10px;font-size:14px;font-weight:800;
    text-transform:uppercase;margin-bottom:6px;
}
.hero-left h1{
    margin:0;color:#182d62;font-size:34px;line-height:1.12;font-weight:800;
    letter-spacing:-.7px;
}
.hero-tagline{
    margin-top:5px;color:#2864df;font-size:20px;font-weight:800;line-height:1.25;
}
.hero-description-wrap{max-width:auto;margin-top:7px;}
.hero-description{
    color:#2c4b8e;font-size:14px;line-height:1.45;font-weight:500;
    display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;
}
.hero-read-more{font-size:12px!important;color:#3155E7!important;text-decoration:none;font-weight:800!important;}
.hero-read-more:hover{text-decoration:underline!important;}

.program-hero-card .program-meta-grid{
    grid-template-columns:repeat(3,minmax(0,1fr));gap:10px;margin:12px 0 12px;
    max-width:650px;
}
.program-hero-card .program-meta-box{
    min-height:58px;background:#fff;border-color:#d8e2f4;border-radius:9px;
    padding:9px 11px;gap:9px;
}
.program-hero-card .program-meta-box .icon{
    width:35px;height:35px;border-radius:9px;background:#eaf1ff;
}
.program-hero-card .program-meta-box .label{font-size:14px;color:#56709f;}
.program-hero-card .program-meta-box .value{font-size:13px;color:#172d63;}

.program-hero-card .included-label{font-size:15px;margin-bottom:7px;}
.program-hero-card .included-pills{gap:9px;margin-bottom:0;}
.program-hero-card .included-pill{
    color:#4d7180;background:#e6f7ef;border-radius:6px;padding:6px 12px;font-size:12px;
}
.program-hero-card .program-doc-links{margin:9px 0 0;gap:12px;}
.program-hero-card .program-doc-links a{font-size:11px;color:#3155E7;}

.hero-right{
    min-width:0;display:flex;flex-direction:column;justify-content:space-between;
    align-items:stretch;
}
.program-art{
    min-height:190px;display:flex;align-items:center;justify-content:center;
}
.program-art-svg{width:100%;max-width:300px;height:auto;display:block;}
.hero-syllabus-btn{
    width:100%;display:flex;align-items:center;justify-content:center;gap:9px;
    text-decoration:none;color:#fff;background:#2f69e8;border-radius:7px;
    font-size:13px;font-weight:800;padding:11px 14px;margin-top:2px;
    box-shadow:0 6px 14px rgba(49,85,231,.18);transition:.18s ease;
}
.hero-syllabus-btn:hover{color:#fff;background:#244fc9;transform:translateY(-1px);}

.purchase-area{
    display:grid;grid-template-columns:minmax(0,1fr) 350px;gap:10px;align-items:start;
}
.purchase-main{min-width:0;}
.purchase-tabs-wrap{
    background:transparent;border-bottom:1px solid #dbe3f1;padding:0 0 0;
}
.plan-tabs.nav-tabs{
    border:0;gap:6px;flex-wrap:nowrap;
}
.plan-tab.nav-link{
    position:relative;border:0!important;border-radius:0!important;background:transparent!important;
    color:#5f6d88;font-size:20px;font-weight:800;padding:9px 22px 10px;
    box-shadow:none!important;transition:.18s ease;
}
.plan-tab.nav-link:hover{color:#3155E7;}
.plan-tab.nav-link.active{color:#3155E7;}
.plan-tab.nav-link.active:after{
    content:"";position:absolute;left:0;right:0;bottom:-1px;height:3px;border-radius:4px 4px 0 0;
    background:#3155E7;
}

.tab-pane{padding-top:0;}
#plansBlock .plans-panel{
    background:#fff;
}
#componentsBlock .plans-panel{
    background:#f3ee95;
}
.plans-panel{
    border:1px solid #dfe6f2;border-radius:0 10px 10px 10px;
    padding:14px 16px 10px;min-height:120px;
}
.plans-panel-heading h2{
    margin:0;color:#1c3268;font-size:21px;font-weight:800;line-height:1.25;
}
.plans-panel-heading p{
    margin:3px 0 10px;color:#64708a;font-size:1rem;line-height:1.4;
}
#planFilterBar{margin-bottom:10px!important;}
#planFilterBar:empty{display:none!important;}
.filter-chip.btn{padding:5px 11px;font-size:16px;}

#plansGrid{display:flex;flex-direction:column;gap:9px;}
#plansGrid > .empty-note{padding:18px 4px;}

.plan-card{
    display:grid!important;grid-template-columns:185px minmax(230px,1fr) 125px 125px;
    gap:0;align-items:stretch;width:100%;min-height:104px;
    border:1px solid #dbe5f5!important;border-radius:9px!important;padding:12px 8px!important;
    background:#fff!important;box-shadow:none!important;transform:none!important;
    transition:border-color .18s ease,box-shadow .18s ease,transform .18s ease!important;
}
.plan-card:hover{
    border-color:#9bb9ff!important;box-shadow:0 5px 18px rgba(38,83,171,.08)!important;
    transform:translateY(-1px)!important;
}
.plan-card-col{
    min-width:0;padding:0 13px;display:flex;flex-direction:column;justify-content:center;
}
.plan-card-col + .plan-card-col{border-left:1px solid #dce4f0;}
.plan-number{
    display:inline-flex;align-self:flex-start;background:#eaf2ff;color:#3264d5;
    font-size:16px;font-weight:800;padding:3px 6px;border-radius:4px;margin-bottom:5px;
}
.plan-card .plan-name{font-size:18px!important;font-weight:800;color:#1b2f62;margin:0 0 3px;}
.plan-card .plan-duration{font-size:15px;color:#63718b;margin:0 0 5px;}
.best-value-badge{
    display:inline-flex;align-self:flex-start;background:#e9f4ff;color:#2c6adf;
    font-size:15px;font-weight:800;border-radius:4px;padding:4px 7px;
}
.plan-card .plan-includes{border-top:0!important;padding:0 13px!important;margin:0!important;}
.plan-card .plan-includes-label{
    color:#245fd8;font-size:16px;font-weight:800;text-transform:uppercase;
    margin:0 0 5px;letter-spacing:.02em;
}
.plan-card .plan-includes-list{gap:3px;}
.plan-card .plan-includes-list li{
    display:flex;align-items:flex-start;justify-content:flex-start;gap:6px;
    color:#53617a;font-size:1.2rem;line-height:1.25;
}
.include-check{
    flex:0 0 13px;width:13px;height:13px;border-radius:50%;background:#23a85b;color:#fff;
    display:inline-flex;align-items:center;justify-content:center;font-size:8px;font-weight:900;
}
.plan-card .pi-name{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.more-components{font-size:16px;color:#63708a;margin-top:3px;font-weight:700;}
.plan-no-includes{font-size:10px;color:#8a94a8;}
.plan-card .plan-pricing{align-items:flex-start;}
.plan-card .plan-price{
    font-size:21px!important;font-weight:800;color:#1760dc;line-height:1.15;margin:0;
}
.plan-price-old{
    font-size:14px;color:#7b8495;text-decoration:line-through;margin-top:2px;
}
.plan-card .plan-discount{
    font-size:12px!important;padding:3px 8px;margin-top:4px;background:#e4f6e9;color:#25934c;
}
.plan-action{align-items:center;}
.plan-card .cart-btn{
    width:100%;min-width:105px;background:#2f69e8;color:#fff;border:0!important;
    border-radius:6px;font-size:11px!important;font-weight:800;padding:9px 8px!important;
    box-shadow:0 5px 10px rgba(49,85,231,.16);transition:.18s ease;
}
.plan-card .cart-btn:hover:not([disabled]){background:#244fc9;color:#fff;transform:translateY(-1px);}
.plan-card .cart-btn.btn-success{background:#16a34a;}
.plan-card .cart-btn.purchased{background:#e7f7ed;color:#188847;border:1px solid #bde9cb!important;box-shadow:none;}
.cart-icon{font-size:14px;margin-right:3px;}
/* Test component Add to Cart — same look as plan-card button */
#componentsBlock .add-component-plain-btn.cart-btn{
    min-width:105px;background:#2f69e8;color:#fff;border:0!important;
    border-radius:6px;font-size:11px!important;font-weight:800;padding:9px 12px!important;
    box-shadow:0 5px 10px rgba(49,85,231,.16);transition:.18s ease;margin-top:0;
}
#componentsBlock .add-component-plain-btn.cart-btn:hover:not([disabled]){background:#244fc9;color:#fff;transform:translateY(-1px);}
#componentsBlock .add-component-plain-btn.cart-btn.btn-success{background:#16a34a;color:#fff;}

.cart-card{
    background:#fff;border:1px solid #dfe6f2;border-radius:10px;padding:0 13px 14px;
    box-shadow:none;
}
.cart-heading{
    min-height:50px;display:flex;align-items:center;gap:8px;
    border-bottom:1px solid #e1e7f1;margin:0;padding:0 1px;
    color:#1d3268!important;font-size:16px!important;font-weight:800!important;
}
.cart-heading-icon{
    color:#2e6ae8;display:inline-flex;align-items:center;justify-content:center;
}
.cart-count-badge{
    margin-left:auto;min-width:19px;height:19px;padding:0 5px;border-radius:50%;
    display:inline-flex;align-items:center;justify-content:center;
    background:#2f69e8;color:#fff;font-size:9px;font-weight:800;
}
.cart-empty-state{text-align:center;padding:19px 4px 9px;}
.cart-empty-illustration{display:flex;justify-content:center;margin-bottom:3px;}
.cart-empty-title{font-size:18px;font-weight:800;color:#1760dc;margin-top:2px;}
.cart-empty-text{font-size:15px;color:#6a7690;line-height:1.5;margin-top:3px;}
.cart-total-row{font-size:15px!important;padding-top:11px!important;margin-top:4px!important;}
.cart-total-row span.amount{font-size:17px!important;}
.cart-checkout-btn{
    background:#cfe0ff!important;color:#2f69e8!important;border:0!important;
    box-shadow:none!important;font-size:12px!important;padding:10px 12px!important;
}
/*.cart-checkout-btn:not(.disabled):hover{background:#b9d1ff!important;color:#245fd8!important;}*/
.cart-checkout-btn.disabled{opacity:1!important;cursor:not-allowed;}
.help-card{
    margin-top:10px;background:#fff;border:1px solid #dfe6f2;border-radius:10px;
    padding:13px;display:flex;gap:10px;
}
.help-icon{
    width:30px;height:30px;border-radius:50%;background:#eaf1ff;color:#2f69e8;
    display:flex;align-items:center;justify-content:center;font-weight:900;flex:0 0 auto;
}
.help-card h3{font-size:13px;color:#203565;margin:1px 0 4px;font-weight:800;}
.help-card p{font-size:10.5px;line-height:1.45;color:#68758d;margin:0 0 9px;}
.help-btn{
    border:1px solid #6b8ef0;background:#fff;color:#3155E7;border-radius:6px;
    padding:6px 10px;font-size:10px;font-weight:800;
}
.help-btn:hover{background:#eef3ff;}

#componentsBlock .plans-panel{border-radius:0 10px 10px 10px;}
#componentsBlock .component-row{background:#fff;border-color:#dfe6f2;border-radius:9px;padding:12px 14px;}
#componentsBlock .component-row:hover{border-color:#9bb9ff;background:#fbfdff;box-shadow:0 4px 14px rgba(38,83,171,.06);}

@media (max-width:1100px){
    .program-hero-card{grid-template-columns:minmax(0,1fr) 260px;}
    .purchase-area{grid-template-columns:minmax(0,1fr) 270px;}
    .plan-card{grid-template-columns:155px minmax(180px,1fr) 105px 110px;}
}
@media (max-width:900px){
    .program-hero-card{grid-template-columns:1fr;}
    .hero-right{max-width:420px;margin:0 auto;width:100%;}
    .program-art{min-height:145px;}
    .purchase-area{grid-template-columns:1fr;}
    .cart-section{order:2;}
    .cart-card{position:static!important;}
}
@media (max-width:700px){
    .program-hero-card{padding:16px;}
    .hero-left h1{font-size:27px;}
    .hero-tagline{font-size:17px;}
    .program-hero-card .program-meta-grid{grid-template-columns:1fr;}
    .program-art{min-height:125px;}
    .plan-card{
        grid-template-columns:1fr 1fr;gap:0;padding:11px 4px!important;
    }
    .plan-card-col{padding:9px 10px;}
    .plan-card-col:nth-child(3){border-left:0;border-top:1px solid #dce4f0;}
    .plan-card-col:nth-child(4){border-top:1px solid #dce4f0;}
    .plan-card .plan-includes{border-left:1px solid #dce4f0!important;}
    .plan-card .plan-price{font-size:17px!important;}
    .plan-action{align-items:flex-start;}
}
@media (max-width:480px){
    .hero-left h1{font-size:24px;}
    .hero-description{font-size:12.5px;}
    .plan-tabs .plan-tab{padding-left:14px;padding-right:14px;font-size:12px;}
    .plan-card{grid-template-columns:1fr;}
    .plan-card-col + .plan-card-col,
    .plan-card .plan-includes{border-left:0!important;border-top:1px solid #dce4f0!important;}
    .plan-card .plan-action{border-top:1px solid #dce4f0!important;align-items:stretch;}
    .plan-card .cart-btn{width:100%;}
}
.detail-top-bar{
    display:flex;
    align-items: center;
    justify-content: end;
    gap:15px;
    margin-bottom:14px;
    width:100%;
}

.detail-top-bar .back-link{
    margin:0 !important;
}

#topSyllabusButton{
    display:flex;
    align-items:center;
    justify-content:flex-end;
}

/* View Syllabus button */
.top-syllabus-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;

    min-height:42px;
    padding:10px 18px;

    background:#e8425a;
    color:#fff !important;
    border:0;
    border-radius:8px;

    font-size:17px;
    font-weight:700;
    text-decoration:none;

    box-shadow:0 4px 10px rgba(47,107,234,.20);
    transition:all .2s ease;
}

.top-syllabus-btn:hover{
    background:#2459ca;
    color:#fff !important;
    transform:translateY(-1px);
    box-shadow:0 6px 14px rgba(47,107,234,.25);
}

.top-syllabus-btn svg{
    flex-shrink:0;
}

@media (max-width:576px){
    .detail-top-bar{
        align-items:stretch;
        flex-direction:column;
    }

    #topSyllabusButton{
        justify-content:flex-start;
    }

    .top-syllabus-btn,
    .detail-top-bar .back-link{
        width:100%;
        justify-content:center;
    }
}
.proceed-register-block{
    border-top:1px dashed var(--border);
    margin-top:14px;
    padding-top:14px;
}
.proceed-register-heading{
    font-size:calc(27px * var(--fs-scale));
    font-weight:800;
    color:#e95324;
    margin-bottom:12px;
    line-height:1.3;
}
/*.program-filter-bar{*/
/*    display:grid;*/
/*    grid-template-columns:repeat(7,minmax(0,1fr));*/
/*    gap:14px;*/
/*    margin-bottom:20px;*/
/*}*/
/*@media (max-width:1100px){*/
/*    .program-filter-bar{grid-template-columns:repeat(4,minmax(0,1fr));}*/
/*}*/
/*@media (max-width:900px){*/
/*    .program-filter-bar{grid-template-columns:repeat(3,minmax(0,1fr));}*/
/*}*/
/*@media (max-width:576px){*/
/*    .program-filter-bar{grid-template-columns:repeat(2,minmax(0,1fr));}*/
/*}*/
/*.program-filter-item label{*/
/*    display:block;*/
/*    font-size:calc(15px * var(--fs-scale));*/
/*    font-weight:800;*/
/*    text-transform:uppercase;*/
/*    letter-spacing:.5px;*/
/*    color:var(--text-muted);*/
/*    margin-bottom:6px;*/
/*}*/
/*.program-filter-item select{*/
/*    width:100%;*/
/*    border:1px solid var(--border);*/
/*    border-radius:10px;*/
/*    padding:10px 12px;*/
/*    font-size:calc(15px * var(--fs-scale));*/
/*    font-weight:600;*/
/*    color:var(--text-dark);*/
/*    background:#fff;*/
/*    cursor:pointer;*/
/*}*/
/*.program-filter-item select:focus{*/
/*    outline:none;*/
/*    border-color:var(--blue);*/
/*    box-shadow:0 0 0 3px rgba(49,85,231,.12);*/
/*}*/
/*.program-filter-submit-btn{*/
/*    width:100%;*/
/*    border:none;*/
/*    border-radius:10px;*/
/*    padding:10px 12px;*/
/*    font-size:calc(15px * var(--fs-scale));*/
/*    font-weight:700;*/
/*    background:var(--blue);*/
/*    color:#fff;*/
/*}*/
/*.program-filter-submit-btn:hover{background:var(--blue-dark);}*/

/* ── Program search / filter bar ── */
.program-filter-bar{
    display:grid;
    grid-template-columns:repeat(4,minmax(0,1fr));
    gap:16px 18px;
    margin-bottom:24px;
    padding:22px;
    background:
        radial-gradient(500px 200px at 100% 0%, rgba(124,92,255,.08), transparent 60%),
        #fff;
    border:1px solid #e1e8f5;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(27,42,75,.07);
}
@media (max-width:1100px){
    .program-filter-bar{grid-template-columns:repeat(3,minmax(0,1fr));}
}
@media (max-width:768px){
    .program-filter-bar{grid-template-columns:repeat(2,minmax(0,1fr));padding:16px;}
}
@media (max-width:480px){
    .program-filter-bar{grid-template-columns:1fr;}
}

.program-filter-item label{
    display:block;
    margin-bottom:7px;
    font-size:12px;
    font-weight:800;
    letter-spacing:.08em;
    text-transform:uppercase;
    color:#6b7a99;
}

.program-filter-item select{
    width:100%;
    height:46px;
    padding:0 40px 0 14px;
    font-size:15px;
    font-weight:600;
    color:var(--text-dark);
    background-color:#f8faff;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16' fill='none' stroke='%233155E7' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    border:1.5px solid #dbe4f3;
    border-radius:12px;
    cursor:pointer;
    appearance:none;
    -webkit-appearance:none;
    transition:border-color .18s ease, box-shadow .18s ease, background-color .18s ease, transform .18s ease;
}
.program-filter-item select:hover{
    border-color:#9bb9ff;
    background-color:#fff;
}
.program-filter-item select:focus{
    outline:none;
    border-color:var(--blue);
    background-color:#fff;
    box-shadow:0 0 0 4px rgba(49,85,231,.14);
}

/* Submit button */
.program-filter-submit-btn{
    width:100%;
    height:46px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    border:0;
    border-radius:12px;
    font-size:15px;
    font-weight:800;
    letter-spacing:.02em;
    color:#fff;
    background:linear-gradient(135deg,#4f6bff,#3155E7 55%,#2442B8);
    box-shadow:0 8px 18px rgba(49,85,231,.30);
    transition:transform .18s ease, box-shadow .18s ease, filter .18s ease;
}
.program-filter-submit-btn::before{
    content:"\F52A";               /* bi-search */
    font-family:"bootstrap-icons";
    font-size:1rem;
}
.program-filter-submit-btn:hover{
    color:#fff;
    background:linear-gradient(135deg,#4f6bff,#3155E7 55%,#2442B8);
    transform:translateY(-1px);
    box-shadow:0 12px 24px rgba(49,85,231,.38);
    filter:brightness(1.05);
}
.program-filter-submit-btn:active{transform:translateY(0);}
.proceed-register-icon{
    position:relative;
    width:35px;height:35px;flex:0 0 auto;
    display:inline-flex;align-items:center;justify-content:center;
    border-radius:16px;
    background:linear-gradient(135deg,#ff7a45,#e95324);
    color:#fff;font-size:1.5rem;
    box-shadow:
        0 0 0 4px rgba(233,83,36,.12),
        0 10px 20px rgba(233,83,36,.30);
}
.proceed-register-icon .pr-badge{
    position:absolute;right:-6px;bottom:-6px;
    width:16px;height:16px;
    display:inline-flex;align-items:center;justify-content:center;
    border-radius:50%;
    background:#16A34A;color:#fff;font-size:.8rem;
    border:2px solid #fff;
    box-shadow:0 3px 8px rgba(22,163,74,.4);
}

</style>
</head>
<body>

<div class="wrap">

    <header>
        <div class="hero-heading-row">
            <span class="hero-icon-badge">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/></svg>
            </span>
            <div>
                <h1 class="hero-title">Choose Your Study Pack(s)</h1>
                <p class="hero-sub">Registration is complete for <strong><?php echo htmlspecialchars($student['first_name']); ?></strong>. Select a program below to explore available plans and components, add what you need to your cart, then check out.</p>
            </div>
        </div>

        <!-- ---- Progress stepper (Bootstrap flex) ---- -->
        <div class="progress-card">
            <div class="d-flex align-items-center flex-wrap gap-3 p-4">
                <span class="progress-title flex-shrink-0">Your Progress</span>

                <div class="d-flex align-items-center flex-grow-1 flex-wrap" style="min-width:0;">
                    <div class="phase-step done d-flex align-items-center gap-2">
                        <span class="phase-icon d-flex align-items-center justify-content-center">1</span>
                        <span class="phase-text lh-sm"><span class="phase-name d-block">Register</span><span class="phase-status">Completed</span></span>
                    </div>
                    <div class="phase-connector filled mx-2"></div>

                    <div class="phase-step active d-flex align-items-center gap-2">
                        <span class="phase-icon d-flex align-items-center justify-content-center">2</span>
                        <span class="phase-text lh-sm"><span class="phase-name d-block">Choose Plan</span><span class="phase-status">In Progress</span></span>
                    </div>
                    <div class="phase-connector mx-2"></div>

                    <div class="phase-step locked d-flex align-items-center gap-2">
                        <span class="phase-icon d-flex align-items-center justify-content-center">3</span>
                        <span class="phase-text lh-sm"><span class="phase-name d-block">Cart</span><span class="phase-status">Upcoming</span></span>
                    </div>
                    <div class="phase-connector mx-2"></div>

                    <div class="phase-step locked d-flex align-items-center gap-2">
                        <span class="phase-icon d-flex align-items-center justify-content-center">4</span>
                        <span class="phase-text lh-sm"><span class="phase-name d-block">Checkout</span><span class="phase-status">Upcoming</span></span>
                    </div>
                    <div class="phase-connector mx-2"></div>

                    <div class="phase-step locked d-flex align-items-center gap-2">
                        <span class="phase-icon d-flex align-items-center justify-content-center">5</span>
                        <span class="phase-text lh-sm"><span class="phase-name d-block">Pay</span><span class="phase-status">Upcoming</span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger fs-6" role="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (!empty($locked_program)): ?>
        <div class="alert alert-primary fs-6" role="alert" style="background:#eef4ff;border-color:#c9dcff;color:#1d4ed8;font-weight:800;">
            You're already enrolled in <strong><?php echo htmlspecialchars($locked_program['program_name']); ?></strong> — you can add more plans or components from this program, but a new program can't be started until next year.
        </div>
    <?php endif; ?>
<div id="listView">
    <h2 class="section-title"><span class="section-title-icon"><i></i><i></i><i></i><i></i></span>Programs</h2>
    <div class="program-filter-bar" id="programFilterBar"></div>
    <?php if (empty($programs)): ?>
        <p class="empty-note">No active programs are available right now. Please check back later.</p>
    <?php else: ?>
        <div class="row g-3" id="programGrid"></div>
    <?php endif; ?>
</div>
    <!-- ==================== LIST VIEW: Programs ==================== -->
    <!--<div id="listView">-->
    <!--    <h2 class="section-title"><span class="section-title-icon"><i></i><i></i><i></i><i></i></span>Programs</h2>-->
    <!--    <?php //if (empty($programs)): ?>-->
    <!--        <p class="empty-note">No active programs are available right now. Please check back later.</p>-->
    <!--    <?php //else: ?>-->
    <!--        <div class="row g-3" id="programGrid"></div>-->
    <!--    <?php //endif; ?>-->
    <!--</div>-->

    <!-- ==================== DETAIL VIEW: Plans + Components ==================== -->
    <div id="detailView" class="detail-page" style="display:none;">
          <div class="detail-top-bar">
    <button type="button" class="back-link btn" id="backToListBtn">
        <svg width="17" height="17" viewBox="0 0 16 16" fill="none">
            <path d="M12 8H4M7 4L3 8l4 4"
                  stroke="currentColor"
                  stroke-width="1.8"
                  stroke-linecap="round"
                  stroke-linejoin="round"/>
        </svg>
        Back to Programs
    </button>

    <div id="topTestScheduleButton"></div>
    <div id="topWhatYouGetButton"></div>
    <div id="topSyllabusButton"></div> 
</div>

        <!-- Program hero -->
        <!--<div class="program-hero-card">-->
        <!--    <div class="program-hero-content" id="programHeader"></div>-->
        <!--</div>-->

        <!-- Kept for existing JS/document logic; the visible document buttons are rendered in the hero -->
        <!--<div class="resource-block" id="programResources" style="display:none;">-->
        <!--    <h4 class="block-heading">Program Documents</h4>-->
        <!--    <div id="programResourceLinks" class="d-flex flex-wrap gap-2"></div>-->
        <!--</div>-->

        <!-- Plans + Cart -->
     <div class="proceed-register-heading my-3 d-flex align-items-center gap-3">
    <span class="proceed-register-icon">
        <i class="bi bi-arrow-right"></i>
    </span>
    <span>Proceed to Register</span>
</div>
        <div class="purchase-area">
            <div class="purchase-main">
                <div class="purchase-tabs-wrap">
                    <ul class="nav nav-tabs plan-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link plan-tab active" id="tabPlans" data-tab="plans" role="tab">
                                Use Existing Plans
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link plan-tab" id="tabCustom" data-tab="custom" role="tab">
                                Create Your Custom Plan
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Existing plans -->
                <div id="plansBlock" class="tab-pane active" role="tabpanel">
                    <div class="plans-panel">
                        <div class="plans-panel-heading">
                            <div>
                                <h2>Available Plans</h2>
                                <p>Choose a plan that suits your learning needs. Each plan includes study material, mock tests and skill tests.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-3" id="planFilterBar"></div>
                        <div id="plansGrid"></div>
                    </div>
                </div>

                <!-- Custom plan / components -->
                <div id="componentsBlock" class="tab-pane" role="tabpanel" style="display:none;">
                    <div class="plans-panel">
                        <div class="plans-panel-heading">
                            <div>
                                <h2>Choose Components</h2>
                                <p>Create your own plan by selecting the components you need.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2" id="componentList"></div>
                    </div>
                </div>
            </div>

            <!-- Cart -->
            <aside class="cart-section">
                <div class="cart-card sticky-lg-top" style="top:1.25rem;">
                    <h2 class="cart-heading">
                        <span class="cart-heading-icon">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                                <path d="M3 4h2l2.2 11.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 1.9-1.4L21 8H7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="10" cy="20" r="1.5" fill="currentColor"/>
                                <circle cx="18" cy="20" r="1.5" fill="currentColor"/>
                            </svg>
                        </span>
                        Your Cart
                        <span class="cart-count-badge" id="cartCountBadge"><?php echo count($cart); ?></span>
                    </h2>

                    <div id="cartLines"></div>

                    <div class="cart-total-row">
                        <span>Total</span>
                        <span class="amount">₹<span id="cartTotal"><?php echo number_format($cart_total, 2); ?></span></span>
                    </div>

                    <a href="<?php echo site_url('student_registration/cart/' . $student['PRID']); ?>"
                       class="cart-checkout-btn btn btn-primary btn-lg fw-bold w-100 d-flex align-items-center justify-content-center gap-2 mt-3 <?php echo empty($cart) ? 'disabled' : ''; ?>"
                       id="viewCartBtn">
                        View Cart &amp; Checkout
                        <svg width="18" height="18" viewBox="0 0 16 16" fill="none">
                            <path d="M4 8h8M9 4l4 4-4 4" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <!--<div class="help-card">-->
                <!--    <div class="help-icon">?</div>-->
                <!--    <div>-->
                <!--        <h3>Need Help?</h3>-->
                <!--        <p>If you have any questions about plans or components, our support team is here to help.</p>-->
                <!--        <button type="button" class="help-btn">-->
                <!--            <span>♧</span> Contact Support-->
                <!--        </button>-->
                <!--    </div>-->
                <!--</div>-->
            </aside>
        </div>
    </div>
</div>

<!-- ==================== DESCRIPTION MODAL (Bootstrap) ==================== -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5 fw-bold" id="descriptionModalLabel">Description</h3>
                <button type="button" class="btn-close" id="descriptionModalClose" aria-label="Close"></button>
            </div>
            <div class="modal-body description-popup-body" id="fullDescription"></div>
        </div>
    </div>
</div>

<!-- ==================== PLAN CONFIRM MODAL (unit range) ==================== -->
<div class="modal fade" id="planConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Confirm Plan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="planConfirmBody"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="planConfirmOk">Confirm &amp; Add to Cart</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var CIN = <?php echo json_encode($student['PRID']); ?>;
    var addPlanUrl      = "<?php echo site_url('student_registration/ajax_add_plan_to_cart'); ?>";
    var planUnitPreviewUrl = "<?php echo site_url('student_registration/ajax_plan_unit_preview'); ?>";
    var addComponentUrl = "<?php echo site_url('student_registration/ajax_add_component_to_cart'); ?>";
    var removeUrl        = "<?php echo site_url('student_registration/ajax_remove_from_cart'); ?>";
    var cartPageUrl       = "<?php echo site_url('student_registration/cart/' . $student['PRID']); ?>";
    var addComponentRangeUrl = "<?php echo site_url('student_registration/ajax_add_component_range_to_cart'); ?>";
    // Server-supplied catalog + starting cart state.
    var PROGRAMS   = <?php echo json_encode($programs); ?>;
    
    var programFilters = { subject: 'all', domain: 'all', applicable_for: 'all', season: 'all', status: 'all', academic_year: 'all', program: 'all' };
    var programSearchSubmitted = false; // grid stays empty until Submit is clicked

var PROGRAM_FILTER_FIELDS = [
    { key: 'subject',        label: 'Subject',        allLabel: 'All Subjects' },
    { key: 'domain',         label: 'Domain',         allLabel: 'All Domains' },
    // { key: 'grade',          label: 'Grade',          allLabel: 'All Grades' },
    { key: 'applicable_for', label: 'Applicable For', allLabel: 'All' },
    { key: 'season',         label: 'Season',         allLabel: 'All Seasons' },
    { key: 'status',         label: 'Status',         allLabel: 'All Status' },
    { key: 'academic_year',  label: 'Academic Year',  allLabel: 'All Academic Years' }
];

function uniqueProgramValues(key) {
    var seen = {};
    var values = [];
    PROGRAMS.forEach(function (p) {
        var v = p[key];
        if (v === undefined || v === null || v === '') return;
        v = String(v);
        if (seen[v]) return;
        seen[v] = true;
        values.push(v);
    });
    values.sort();
    return values;
}

function programMatchesFilters(p) {
    if (programFilters.program && programFilters.program !== 'all') {
        if (String(p.id) !== String(programFilters.program)) return false;
    }
    return PROGRAM_FILTER_FIELDS.every(function (f) {
        var chosen = programFilters[f.key];
        if (chosen === 'all') return true;
        return String(p[f.key] || '') === chosen;
    });
}

function renderProgramFilterBar() {
    var bar = document.getElementById('programFilterBar');
    if (!bar) return;

    var html = PROGRAM_FILTER_FIELDS.map(function (f) {
        var values = uniqueProgramValues(f.key);
        if (!values.length) return '';
        var options = '<option value="all">' + esc(f.allLabel) + '</option>' +
            values.map(function (v) {
                var sel = programFilters[f.key] === v ? ' selected' : '';
                return '<option value="' + esc(v) + '"' + sel + '>' + esc(v) + '</option>';
            }).join('');
        return '<div class="program-filter-item">' +
            '<label>' + esc(f.label) + '</label>' +
            '<select data-filter-key="' + f.key + '">' + options + '</select>' +
        '</div>';
    }).join('');

    // ---- Select Program dropdown ----
    // Built straight from PROGRAMS (id -> program_name) rather than
    // uniqueProgramValues(), since the option value (id) and its visible
    // label (program_name) are different fields here.
    var seenProgramIds = {};
    var programOptionsHtml = PROGRAMS.filter(function (p) {
        if (seenProgramIds[p.id]) return false;
        seenProgramIds[p.id] = true;
        return true;
    }).sort(function (a, b) {
        return String(a.program_name).localeCompare(String(b.program_name));
    }).map(function (p) {
        var sel = String(programFilters.program) === String(p.id) ? ' selected' : '';
        return '<option value="' + esc(p.id) + '"' + sel + '>' + esc(p.program_name) + '</option>';
    }).join('');

    html += '<div class="program-filter-item">' +
        '<label>Select Program</label>' +
        '<select data-filter-key="program">' +
            '<option value="all">All Programs</option>' +
            programOptionsHtml +
        '</select>' +
    '</div>';

    // ---- Submit button ----
    // Filters (including Select Program) are staged as the person changes
    // them, and only take effect when Submit is clicked. If a specific
    // program is chosen, Submit takes them straight to that program's
    // detail page instead of just filtering the list.
    html += '<div class="program-filter-item program-filter-submit-item">' +
        '<label>&nbsp;</label>' +
        '<button type="button" class="btn btn-primary program-filter-submit-btn" id="programFilterSubmitBtn">Search</button>' +
    '</div>';

    bar.innerHTML = html;

    bar.querySelectorAll('select[data-filter-key]').forEach(function (sel) {
        sel.addEventListener('change', function () {
            programFilters[sel.getAttribute('data-filter-key')] = sel.value;
        });
    });

    var submitBtn = document.getElementById('programFilterSubmitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', function () {
            programSearchSubmitted = true;
            renderProgramGrid();
        });
    }
}
    var PLANS      = <?php echo json_encode($plans); ?>;
    var COMPONENTS = <?php echo json_encode($components); ?>;
    // lm_content rows used to build the week dropdown on each component row in
    // "Create your Custom Plan". IMPORTANT (per confirmed behaviour):
    //   - $lm_content must already be filtered server-side to ONLY the rows for
    //     this student's own class_number (e.g. WHERE class_number = <student's class>
    //     AND status = 'Active'), same as: SELECT * FROM lm_content WHERE
    //     class_number = 1 AND content_type = 'study_pack' — for component_id 38
    //     that returns week_number 1..8, and that exact list is what should show
    //     in the dropdown.
    //   - Each row must carry a `bought` flag (1/0): whichever week_number the
    //     student has already purchased for that component must NOT appear in
    //     the dropdown.
    var LM_CONTENT = <?php echo json_encode($lm_content ?? []); ?>;
    var cart       = <?php echo json_encode($cart); ?>;
    var cartTotal  = <?php echo json_encode((float) $cart_total); ?>;

    var componentQty = {}; // component_id -> chosen quantity (before adding)
    var componentWeekSelection = {}; // component_id -> currently selected "week-class" key in its dropdown


    


    function esc(s) {
        return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
        });
    }
    function money(n) { return Number(n || 0).toFixed(2); }

    // ---- Uploaded docs: syllabus / circular ----
    // Syllabus: `syllabus_path` column on lunar_programs (already in PROGRAMS).
    // Circular: `circular_path` column lives on lp_components instead —
    // we pull the first non-empty circular_path among that program's
    // components (SELECT * FROM lp_components).
    // Both are filenames stored under admin/public/lunar_programs/ on the
    // admin app; docUrl() below falls back to using the value as-is if
    // it's already a full URL.
    var DOC_BASE_URL = 'https://marrs.in/admin/';

    function docUrl(path) {
        if (!path) return '';
        // Already a full URL (e.g. stored as an absolute link) — use as-is.
        if (/^https?:\/\//i.test(path)) return path;
        return DOC_BASE_URL + path.replace(/^\/+/, '');
    }

    function docIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' +
            '<path d="M4 2h5l3 3v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>' +
            '<path d="M9 2v3h3" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>' +
            '</svg>';
    }

    function gradeIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 10-10-5L2 10l10 5 10-5Z"/><path d="M6 12v5c0 1 2.5 2.5 6 2.5s6-1.5 6-2.5v-5"/></svg>';
    }
    function calendarIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>';
    }
    function clockIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>';
    }
    function checkCircleIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m8 12 3 3 5-6"/></svg>';
    }
    function arrowRightIconSvg() {
        return '<svg width="20" height="20" viewBox="0 0 16 16" fill="none"><path d="M4 8h8M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    }

    // Grade / Academic Year / Duration info boxes shown on each program card.
    // Duration only renders when the program row itself carries a duration-ish
    // field (duration / duration_label / duration_weeks) — plans have their own
    // separate duration, so we never borrow one from a plan here.
    function programMetaBoxesHtml(p) {
        var boxes = [];
        if (p.grade) {
            boxes.push({ icon: gradeIconSvg(), label: 'Grade', value: p.grade });
        }
        if (p.academic_year) {
            boxes.push({ icon: calendarIconSvg(), label: 'Academic Year', value: p.academic_year });
        }
        var duration = p.duration || p.duration_label || (p.duration_weeks ? p.duration_weeks + ' Weeks' : null);
        if (duration) {
            boxes.push({ icon: clockIconSvg(), label: 'Duration', value: duration });
        }
        if (!boxes.length) return '';
        return '<div class="program-meta-grid">' +
            boxes.map(function (b) {
                return '<div class="program-meta-box">' +
                    '<span class="icon">' + b.icon + '</span>' +
                    '<span class="txt"><span class="label d-block">' + esc(b.label) + '</span><span class="value">' + esc(b.value) + '</span></span>' +
                '</div>';
            }).join('') +
        '</div>';
    }

    // "What's Included" pills — the distinct component types offered under
    // this program (e.g. Study Material, Mock Tests, Skill Tests), read
    // straight from the COMPONENTS catalog so it always reflects real data.
    function includedPillsHtml(programId) {
        var seen = {};
        var labels = [];
        componentsForProgram(programId).forEach(function (c) {
            var label = (c.component_type || c.type || '').toString().trim();
            if (!label) return;
            // Normalize "study_pack" / "study-pack" -> "Study Pack" etc.
            label = label.replace(/[_-]+/g, ' ').replace(/\b\w/g, function (ch) { return ch.toUpperCase(); });
            if (seen[label]) return;
            seen[label] = true;
            labels.push(label);
        });
        if (!labels.length) return '';
        return '<div class="included-label">What\'s Included</div>' +
            '<div class="included-pills">' +
                labels.map(function (label) {
                    return '<span class="included-pill">' + checkCircleIconSvg() + esc(label) + '</span>';
                }).join('') +
            '</div>';
    }

    function circularPathForProgram(programId) {
        var match = COMPONENTS.find(function (c) {
            return String(c.program_id) === String(programId) && c.circular_path;
        });
        return match ? match.circular_path : null;
    }

    function programDocsHtml(p) {
        var links = '';
        var circularPath = circularPathForProgram(p.id);
        if (p.syllabus_path) {
            links += '<a class="doc-link btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" href="' + esc(docUrl(p.syllabus_path)) + '" target="_blank" rel="noopener">' + docIconSvg() + ' Syllabus</a>';
        }
        if (circularPath) {
            links += '<a class="doc-link btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" href="' + esc(docUrl(circularPath)) + '" target="_blank" rel="noopener">' + docIconSvg() + ' Circular</a>';
        }
        if (p.test_schedule_path) {
            links += '<a class="doc-link btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" href="' + esc(docUrl(p.test_schedule_path)) + '" target="_blank" rel="noopener">' + docIconSvg() + ' View Test Schedule</a>';
        }
        return links ? '<div class="program-docs d-flex flex-wrap gap-2 mt-2">' + links + '</div>' : '';
    }

    // Secondary document links (Circular / Test Schedule) shown as small text
    // links on the card — Syllabus gets its own dedicated button instead.
    function programSecondaryDocLinksHtml(p) {
        var links = '';
        var circularPath = circularPathForProgram(p.id);
        if (circularPath) {
            links += '<a href="' + esc(docUrl(circularPath)) + '" target="_blank" rel="noopener">' + docIconSvg() + ' Circular</a>';
        }
        // if (p.test_schedule_path) {
        //     links += '<a class="test-schedule-link" href="' + esc(docUrl(p.test_schedule_path)) + '" target="_blank" rel="noopener">' + docIconSvg() + ' Test Schedule</a>';
        // }
        return links ? '<div class="program-doc-links">' + links + '</div>' : '';
    }

    function plansForProgram(programId) {
        return PLANS.filter(function (p) { return String(p.program_id) === String(programId); });
    }
    function componentsForProgram(programId) {
        return COMPONENTS.filter(function (c) { return String(c.program_id) === String(programId); });
    }
    function cartHasPlan(planId) {
        return cart.some(function (i) { return i.item_type === 'plan' && String(i.id) === String(planId); });
    }

    // ---- lm_content / week-class dropdown helpers (for "Create your Custom Plan") ----

    // Every distinct week_number + class_number combo available for this one
    // component, taken straight from LM_CONTENT rows where component_id matches.
    function lmOptionsForComponent(componentId) {
        var seen = {};
        var options = [];
        LM_CONTENT.forEach(function (row) {
            if (String(row.component_id) !== String(componentId)) return;
            var key = row.week_number + '-' + row.class_number;
            if (seen[key]) return;
            seen[key] = true;
            options.push({ key: key, week_number: row.week_number, class_number: row.class_number });
        });
        options.sort(function (a, b) {
            return (a.week_number - b.week_number) || (a.class_number - b.class_number);
        });
        return options;
    }

    // Units (week numbers) that a given cart item occupies for a given component.
    // Handles: custom range adds (unit_list / unit_from-unit_to / week_class_key)
    // AND whole plans (plan cart items carry unit_list or unit_from-unit_to, but
    // item.id is the PLAN id, so we match through the plan's components).
    function cartItemUnitsForComponent(item, componentId) {
        var matches = false;

        if (item.item_type === 'component') {
            matches = String(item.id) === String(componentId);
        } else if (item.item_type === 'plan') {
            if (item.component_id != null && item.component_id !== '') {
                matches = String(item.component_id) === String(componentId);
            } else {
                var plan = PLANS.find(function (p) { return String(p.id) === String(item.id); });
                matches = !!plan && (plan.components || []).some(function (pc) {
                    var cid = pc.component_id || pc.id || pc.comp_id;
                    return String(cid) === String(componentId);
                });
            }
        }
        if (!matches) return [];

        var units = [];
        if (item.unit_list) {
            String(item.unit_list).split(',').forEach(function (u) {
                u = Number(u); if (u) units.push(u);
            });
        } else if (item.unit_from) {
            for (var u = Number(item.unit_from); u <= Number(item.unit_to || item.unit_from); u++) units.push(u);
        } else if (item.week_class_key) {
            units.push(Number(String(item.week_class_key).split('-')[0]));
        }
        return units;
    }

    // True if this week/class key for this component is already purchased
    // (server-side `bought` flag on the lm_content row) OR already sitting in the
    // current cart (single unit, custom range, or inside a plan).
    function lmKeyBoughtOrInCart(componentId, key) {
        var boughtOnServer = LM_CONTENT.some(function (row) {
            return String(row.component_id) === String(componentId) &&
                   (row.week_number + '-' + row.class_number) === key &&
                   row.bought;
        });
        if (boughtOnServer) return true;

        var weekNo = Number(String(key).split('-')[0]);
        return cart.some(function (item) {
            return cartItemUnitsForComponent(item, componentId).indexOf(weekNo) !== -1;
        });
    }

    // Options still purchasable for a component (bought/in-cart weeks hidden).
    function availableLmOptionsForComponent(componentId) {
        return lmOptionsForComponent(componentId).filter(function (opt) {
            return !lmKeyBoughtOrInCart(componentId, opt.key);
        });
    }

    // ---- Cart sidebar ----
    function renderCart() {
        var linesEl = document.getElementById('cartLines');
        var badgeEl = document.getElementById('cartCountBadge');

        if (!cart.length) {
            linesEl.innerHTML =
                '<div class="cart-empty-state">' +
                    '<div class="cart-empty-illustration">' +
                        '<svg width="94" height="94" viewBox="0 0 94 94" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                            '<circle cx="47" cy="47" r="43" fill="#F1F5FF"/>' +
                            '<path d="M25 30h7l5 32h28l7-23H35" stroke="#3155E7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>' +
                            '<circle cx="43" cy="72" r="4" fill="#3155E7"/><circle cx="65" cy="72" r="4" fill="#3155E7"/>' +
                            '<path d="M39 43h28M48 35v16" stroke="#8CAAFB" stroke-width="3" stroke-linecap="round"/>' +
                        '</svg>' +
                    '</div>' +
                    '<div class="cart-empty-title">No items in cart</div>' +
                    '<div class="cart-empty-text">Add plans or components<br>to get started.</div>' +
                '</div>';
        } else {
            linesEl.innerHTML = cart.map(function (item) {
                var weekMeta = item.week_class_key
                    ? ' · Unit ' + item.week_class_key.split('-')[0] + ' — Class ' + item.week_class_key.split('-')[1]
                    : '';
                if (item.unit_list) {
                    var ul = item.unit_list.split(',').map(Number);
                    var contiguous = (ul[ul.length - 1] - ul[0] + 1) === ul.length;
                    weekMeta = contiguous && ul.length > 1
                        ? ' · Unit ' + ul[0] + ' to Unit ' + ul[ul.length - 1]
                        : ' · Units ' + ul.join(', ');
                } else if (item.unit_from) {
                    weekMeta = ' · Unit ' + item.unit_from + ' to Unit ' + item.unit_to;
                }
                return '' +
                    '<div class="cart-line">' +
                        '<div>' +
                            '<div class="cl-name">' + esc(item.name) + (item.quantity > 1 ? ' × ' + item.quantity : '') + '</div>' +
                            '<div class="cl-meta">' + esc(item.category_name) + weekMeta + '</div>' +
                            '<button type="button" class="cl-remove btn btn-link btn-sm text-danger p-0 mt-1" data-cart-item-id="' + item.cart_item_id + '">Remove</button>' +
                        '</div>' +
                        '<div class="cl-price">₹' + money(item.price * item.quantity) + '</div>' +
                    '</div>';
            }).join('');
        }

        document.getElementById('cartTotal').textContent = money(cartTotal);
        if (badgeEl) badgeEl.textContent = cart.length;

        var viewCartBtn = document.getElementById('viewCartBtn');
        if (cart.length) { viewCartBtn.classList.remove('disabled'); }
        else { viewCartBtn.classList.add('disabled'); }

        linesEl.querySelectorAll('[data-cart-item-id]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                removeFromCart(btn.getAttribute('data-cart-item-id'), btn);
            });
        });
    }


    function applyCartResponse(res) {
        cart = res.cart;
        cartTotal = res.total;
        renderCart();
        renderPlansGrid(currentProgramId);
        renderComponentsList(currentProgramId); // refresh component buttons (In Cart -> Add to Cart after remove)
    }

    var planConfirmModal = null;

    function confirmPlanUnits(planId, btn) {
        var plan = PLANS.find(function (p) { return String(p.id) === String(planId); });
        btn.disabled = true;

        fetch(planUnitPreviewUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'cin=' + encodeURIComponent(CIN) + '&plan_id=' + encodeURIComponent(planId)
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            btn.disabled = false;
            if (!res.success) { alert(res.message || 'Could not check units.'); return; }

            var okBtn = document.getElementById('planConfirmOk');
            var fresh = okBtn.cloneNode(true);          // drop old click handlers
            okBtn.parentNode.replaceChild(fresh, okBtn);
            okBtn = fresh;

            var html = '<div class="fw-bold mb-2">' + esc(plan ? plan.plan_name : 'Plan') + '</div>';
            var main = res.items.length ? res.items[0] : null;   // selectable study-pack item

            // free = units not bought / not in cart (bought ones are skipped automatically)
            var free = [], need = 0;
            if (main) {
                need = Number(main.units);
                // only available units are shown; already purchased / in-cart units are hidden
                free = main.weeks.filter(function (w) { return main.used.indexOf(w) === -1; });
            }

            if (main && free.length >= need) {
                function opts(list, selectedVal) {
                    return list.map(function (w) {
                        return '<option value="' + w + '"' + (w === selectedVal ? ' selected' : '') + '>Unit ' + w + '</option>';
                    }).join('');
                }
                html += '<div class="p-2 mb-2 border rounded" style="background:#f6f8fc;">' +
                    '<div class="fw-semibold mb-2">' + esc(main.component_name) +
                    ' <span class="text-muted fw-normal">\u2013 ' + need + ' units</span></div>' +
                    '<div class="d-flex gap-2">' +
                        '<div class="flex-fill"><label class="small text-muted d-block mb-1">From Unit</label>' +
                        '<select class="form-select" id="planFromUnit">' + opts(free, free[0]) + '</select></div>' +
                        '<div class="flex-fill"><label class="small text-muted d-block mb-1">To Unit</label>' +
                        '<select class="form-select" id="planToUnit">' + opts(free, free[need - 1]) + '</select></div>' +
                    '</div>' +
                    '<div class="small mt-2" id="planUnitSummary" style="color:#3155E7;font-weight:800;"></div>' +
                    '<div class="small mt-1 text-danger" id="planUnitError"></div>' +
                    '</div>';

                // extra study-pack items (if any) are auto-assigned, shown read-only
                for (var k = 1; k < res.items.length; k++) {
                    var it = res.items[k];
                    html += '<div class="p-2 mb-2 border rounded" style="background:#f6f8fc;">' +
                        '<div class="fw-semibold">' + esc(it.component_name) + ' (' + it.units + ' units)</div>' +
                        '<div style="color:#3155E7;font-weight:800;">Unit ' + it.from + ' to Unit ' + it.to + '</div></div>';
                }
            } else if (main) {
                html += '<div class="text-danger">Only ' + free.length + ' unit(s) are free, this plan needs ' + need + '.</div>';
            } else {
                html += '<div class="text-muted">This plan has no unit-based study pack.</div>';
            }
            html += '<div class="mt-2">Price: <strong>\u20b9' + money(plan ? plan.final_price : 0) + '</strong></div>';
            document.getElementById('planConfirmBody').innerHTML = html;

            var selectedUnits = [];
            if (main && free.length >= need) {
                var fromSel = document.getElementById('planFromUnit');
                var toSel   = document.getElementById('planToUnit');
                var sumEl   = document.getElementById('planUnitSummary');
                var errEl   = document.getElementById('planUnitError');

                function invalid(msg) {
                    selectedUnits = [];
                    sumEl.textContent = '';
                    errEl.textContent = msg;
                    okBtn.disabled = true;
                }
                function setFrom(from) {
                    var idx = free.indexOf(from);
                    var picked = free.slice(idx, idx + need);       // `need` available units starting at From
                    fromSel.value = String(from);
                    if (picked.length < need) {
                        toSel.value = String(free[free.length - 1]);
                        invalid('Only ' + picked.length + ' unit(s) available from Unit ' + from +
                                ', plan needs ' + need + '. Choose an earlier From unit.');
                        return;
                    }
                    selectedUnits = picked;
                    toSel.value = String(picked[picked.length - 1]);
                    errEl.textContent = '';
                    sumEl.textContent = 'Units: ' + picked.join(', ');
                    okBtn.disabled = false;
                }
                fromSel.addEventListener('change', function () { setFrom(Number(fromSel.value)); });
                toSel.addEventListener('change', function () {
                    var to  = Number(toSel.value);
                    var idx = free.indexOf(to) - need + 1;
                    if (idx < 0) {
                        fromSel.value = String(free[0]);
                        invalid('Only ' + (idx + need) + ' unit(s) available up to Unit ' + to +
                                ', plan needs ' + need + '. Choose a later To unit.');
                        return;
                    }
                    setFrom(free[idx]);
                });
                setFrom(free[0]);
            } else {
                okBtn.disabled = !!main;   // not enough free units -> cannot confirm
            }

            if (!planConfirmModal) {
                planConfirmModal = new bootstrap.Modal(document.getElementById('planConfirmModal'));
            }
            okBtn.addEventListener('click', function () {
                planConfirmModal.hide();
                addPlanToCart(planId, btn, selectedUnits);
            });
            planConfirmModal.show();
        })
        .catch(function () {
            btn.disabled = false;
            alert('Network error \u2014 please try again.');
        });
    }

    function addPlanToCart(planId, btn, units) {
        btn.disabled = true;
        btn.textContent = 'Adding\u2026';
        fetch(addPlanUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'cin=' + encodeURIComponent(CIN) +
                  '&plan_id=' + encodeURIComponent(planId) +
                  (units && units.length ? '&units=' + encodeURIComponent(units.join(',')) : '')
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                applyCartResponse(res);
            } else {
                btn.disabled = false;
                btn.textContent = 'Add to Cart';
                alert(res.message || 'Could not add plan to cart.');
                renderPlansGrid(currentProgramId);
            }
        })
        .catch(function () {
            btn.disabled = false;
            btn.textContent = 'Add to Cart';
            alert('Network error \u2014 please try again.');
        });
    }

   function addComponentToCart(componentId, btn, weekClassKey, qtyOverride) {
    var qty = weekClassKey ? 1 : (qtyOverride || componentQty[componentId] || 1);
    btn.disabled = true;
    var original = btn.textContent;
    btn.textContent = 'Adding…';

    var body = 'cin=' + encodeURIComponent(CIN) + '&component_id=' + encodeURIComponent(componentId) + '&quantity=' + encodeURIComponent(qty);
    if (weekClassKey) {
        var parts = weekClassKey.split('-');
        body += '&week_number=' + encodeURIComponent(parts[0]) + '&class_number=' + encodeURIComponent(parts[1]);
    }

    fetch(addComponentUrl, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: body
    })
    .then(function (r) { return r.json(); })
    .then(function (res) {
        btn.disabled = false;
        btn.textContent = original;
        if (res.success) {
            applyCartResponse(res);
            renderComponentsList(currentProgramId);
        } else {
            alert(res.message || 'Could not add component to cart.');
        }
    })
    .catch(function () {
        btn.disabled = false;
        btn.textContent = original;
        alert('Network error — please try again.');
    });
}
    function removeFromCart(cartItemId, btn) {
        btn.disabled = true;
        btn.textContent = 'Removing…';
        fetch(removeUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'cin=' + encodeURIComponent(CIN) + '&cart_item_id=' + encodeURIComponent(cartItemId)
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                applyCartResponse(res);
            } else {
                btn.disabled = false;
                btn.textContent = 'Remove';
                alert(res.message || 'Could not remove item.');
            }
        })
        .catch(function () {
            btn.disabled = false;
            btn.textContent = 'Remove';
            alert('Network error — please try again.');
        });
    }

    // ---- Description helpers ----

    // Some databases store the editor output entity-encoded (&lt;h2&gt;...).
    // Decode it back into real HTML so headings / bold / bullets work.
    function decodeIfEscaped(s) {
        s = s || '';
        if (/&lt;\/?[a-z]/i.test(s) && !/<[a-z][\s\S]*>/i.test(s)) {
            var t = document.createElement('textarea');
            t.innerHTML = s;
            return t.value;
        }
        return s;
    }

    // Plain-text preview (used for the 2-line clamp on cards / header)
    function stripHtml(html) {
        if (!html) return '';
        html = decodeIfEscaped(html)
            .replace(/<\/(p|div|h[1-6]|li|ul|ol|tr|blockquote)>/gi, '$& ')
            .replace(/<br\s*\/?>/gi, ' ');
        var tmp = document.createElement('div');
        tmp.innerHTML = html;
        return (tmp.textContent || '').replace(/\s+/g, ' ').trim();
    }

    // Rich HTML for the popup — whitelisted so scripts / event handlers can't get through
    function sanitizeHtml(html) {
        var allowed = ['P','BR','STRONG','B','EM','I','U','H1','H2','H3','H4','H5','H6',
                       'UL','OL','LI','A','BLOCKQUOTE','TABLE','THEAD','TBODY','TR','TH','TD','SPAN','DIV'];
        var drop = ['SCRIPT','STYLE','IFRAME','OBJECT','EMBED','LINK','META'];
        var doc = new DOMParser().parseFromString(decodeIfEscaped(html || ''), 'text/html');

        (function clean(node) {
            Array.from(node.children).forEach(function (el) {
                if (drop.indexOf(el.tagName) !== -1) { el.remove(); return; }
                if (allowed.indexOf(el.tagName) === -1) {   // unwrap unknown tags, keep their content
                    clean(el);
                    while (el.firstChild) el.parentNode.insertBefore(el.firstChild, el);
                    el.remove();
                    return;
                }
                Array.from(el.attributes).forEach(function (a) {
                    var keep = el.tagName === 'A' && a.name.toLowerCase() === 'href' &&
                               /^(https?:|mailto:)/i.test(a.value.trim());
                    if (!keep) el.removeAttribute(a.name);
                });
                if (el.tagName === 'A') {
                    el.setAttribute('target', '_blank');
                    el.setAttribute('rel', 'noopener noreferrer');
                }
                clean(el);
            });
        })(doc.body);

        return doc.body.innerHTML;
    }

    // ---- List view: programs ----
//     function renderProgramGrid() {
//         var grid = document.getElementById('programGrid');
//         if (!grid) return;
//         grid.innerHTML = PROGRAMS.map(function (p) {
//             var desc = stripHtml(p.description);
//             var syllabusUrl = p.syllabus_path ? docUrl(p.syllabus_path) : null;

//             return '' +
//                 '<div class="col-12 col-md-6 col-lg-6">' +
//                 '<div class="program-card" data-program-id="' + p.id + '">' +

//                     '<div class="program-subject">' + esc(p.subject) + '</div>' +
//                     '<div class="program-name">' + esc(p.program_name) + '</div>' +
//                     (p.domain ? '<div class="program-tagline">' + esc(p.domain) + '</div>' : '') +

//                     (desc ?
//                         '<div class="program-desc-wrap">' +
//                             '<div class="program-desc">' + esc(desc) + '</div>' +
//                             '<button type="button" class="read-more-btn btn btn-link p-0 fw-bold" data-program-id="' + p.id + '">Read More</button>' +
//                         '</div>'
//                     : '') +

//                     programMetaBoxesHtml(p) +
//                     includedPillsHtml(p.id) +
//                     programSecondaryDocLinksHtml(p) +

//                     // '<div class="program-actions">' +
//                     //     (syllabusUrl ?
//                     //         '<a class="doc-link btn-outline-program" href="' + esc(syllabusUrl) + '" target="_blank" rel="noopener">' + docIconSvg() + ' View Syllabus</a>'
//                     //     : '') +
//                     //     '<button type="button" class="btn-solid-program explore-program-btn" data-program-id="' + p.id + '">Enroll Now ' + arrowRightIconSvg() + '</button>' +
//                     // '</div>' 
//                     '<div class="program-actions">' +
//     (syllabusUrl ?
//         '<a class="doc-link btn-outline-program" href="' + esc(syllabusUrl) + '" target="_blank" rel="noopener">' +
//             docIconSvg() + ' View Syllabus' +
//         '</a>'
//     : '') +

//     (p.test_schedule_path ?
//         '<a class="doc-link btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" href="' +
//             esc(docUrl(p.test_schedule_path)) +
//             '" target="_blank" rel="noopener">' +
//             docIconSvg() + ' View Test Schedule' +
//         '</a>'
//     : '') +

//     '<button type="button" class="btn-solid-program explore-program-btn" data-program-id="' + p.id + '">' +
//         'Enroll Now ' + arrowRightIconSvg() +
//     '</button>' +
// '</div>'+

//                 '</div>' +
//                 '</div>';
//         }).join('');

//         grid.querySelectorAll('.explore-program-btn').forEach(function (btn) {
//             btn.addEventListener('click', function () {
//                 openProgram(btn.getAttribute('data-program-id'));
//             });
//         });
//     }
function renderProgramGrid() {
    var grid = document.getElementById('programGrid');
    if (!grid) return;

    if (!programSearchSubmitted) {
        grid.innerHTML = '<div class="empty-note">Choose your filters above (or pick a program) and click <strong>Submit</strong> to view programs.</div>';
        return;
    }

    var filtered = PROGRAMS.filter(programMatchesFilters);

    if (!filtered.length) {
        grid.innerHTML = '<div class="empty-note">No programs match the selected filters.</div>';
        return;
    }

    grid.innerHTML = filtered.map(function (p) {
        var desc = stripHtml(p.description);
        var syllabusUrl = p.syllabus_path ? docUrl(p.syllabus_path) : null;

        return '' +
            '<div class="col-12 col-md-6 col-lg-6">' +
            '<div class="program-card" data-program-id="' + p.id + '">' +

                '<div class="program-subject">' + esc(p.subject) + '</div>' +
                '<div class="program-name">' + esc(p.program_name) + '</div>' +
                (p.domain ? '<div class="program-tagline">' + esc(p.domain) + '</div>' : '') +

                (desc ?
                    '<div class="program-desc-wrap">' +
                        '<div class="program-desc">' + esc(desc) + '</div>' +
                        '<button type="button" class="read-more-btn btn btn-link p-0 fw-bold" data-program-id="' + p.id + '">Read More</button>' +
                    '</div>'
                : '') +

                programMetaBoxesHtml(p) +
                includedPillsHtml(p.id) +
                programSecondaryDocLinksHtml(p) +

                '<div class="program-actions">' +
                    (syllabusUrl ?
                        '<a class="doc-link btn-outline-program" href="' + esc(syllabusUrl) + '" target="_blank" rel="noopener">' +
                            docIconSvg() + ' View Syllabus' +
                        '</a>'
                    : '') +
                    (p.what_you_get_path ?
                        '<a class="doc-link btn-outline-program" href="' + esc(docUrl(p.what_you_get_path)) + '" target="_blank" rel="noopener">' +
                            checkCircleIconSvg() + ' What You Get' +
                        '</a>'
                    : '') +
                    (p.test_schedule_path ?
                        '<a class="doc-link btn btn-outline-danger btn-sm d-inline-flex align-items-center gap-1" href="' +
                            esc(docUrl(p.test_schedule_path)) +
                            '" target="_blank" rel="noopener">' +
                            docIconSvg() + ' View Test Schedule' +
                        '</a>'
                    : '') +

                    '<button type="button" class="btn-solid-program explore-program-btn" data-program-id="' + p.id + '">' +
                        'Enroll Now ' + arrowRightIconSvg() +
                    '</button>' +
                '</div>' +

            '</div>' +
            '</div>';
    }).join('');

    grid.querySelectorAll('.explore-program-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openProgram(btn.getAttribute('data-program-id'));
        });
    });
}
    // ---- Detail view: plans ----
    var currentProgramId = null;
    var planTypeFilter = 'all';

    // Classify a plan as 'material', 'test', or 'both' based on the
    // component types (and, as a fallback, names) it includes.
    // Normalise a component type: "Study Pack" / "study-pack" -> "study_pack"
    function normType(v) {
        return String(v || '').toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
    }

    // Plan type rules (by component_type):
    //   study_pack -> Learning Material
    //   test       -> Test
    function planFlags(plan) {
        var hasMaterial = false, hasTest = false;

        (plan.components || []).forEach(function (c) {
            var type = normType(c.component_type || c.type);

            // Fall back to the COMPONENTS catalog if the plan row has no type
            if (!type) {
                var compId = c.component_id || c.id || c.comp_id;
                var full = COMPONENTS.find(function (x) {
                    return String(x.id) === String(compId) ||
                           String(x.component_id) === String(compId);
                });
                if (full) type = normType(full.component_type || full.type);
            }

            if (type === 'study_pack') { hasMaterial = true; }
            else if (type === 'test')  { hasTest = true; }
        });

        return { hasMaterial: hasMaterial, hasTest: hasTest };
    }

    // Mutually-exclusive bucket — kept for anything that still wants a
    // single-category label (e.g. a badge on the plan card itself).
    function planCategory(plan) {
        var f = planFlags(plan);
        if (f.hasMaterial && f.hasTest) return 'both';
        if (f.hasMaterial) return 'material';
        if (f.hasTest) return 'test';
        return 'other';
    }

    // Plan type comes from lunar_plans.plan_type:
    //   learning_material       -> Learning Material
    //   test                    -> Test
    //   learning_material_test  -> Learning Material + Test
    function planTypeKey(plan) {
        var t = normType(plan.plan_type);
        if (t === 'learning_material')      return 'material';
        if (t === 'test')                   return 'test';
        if (t === 'learning_material_test') return 'both';
        return '';
    }

    function planMatchesFilter(plan, key) {
        if (key === 'all') return true;

        var typed = planTypeKey(plan);
        if (typed) return typed === key;

        // plan_type empty (NULL) -> fall back to the plan's components
        var f = planFlags(plan);
        if (key === 'material') return f.hasMaterial && !f.hasTest;
        if (key === 'test')     return f.hasTest && !f.hasMaterial;
        if (key === 'both')     return f.hasMaterial && f.hasTest;
        return false;
    }

    var PLAN_FILTER_LABELS = {
        material: 'Learning Material',
        test: 'Test',
        both: 'Learning Material + Test',
        other: 'Other'
    };

    function renderPlanFilterBar(programId) {
        var bar = document.getElementById('planFilterBar');
        var all = plansForProgram(programId);

        if (!all.length) { bar.innerHTML = ''; return; }

        var counts = { material: 0, test: 0, both: 0, other: 0 };
        Object.keys(counts).forEach(function (k) {
            counts[k] = all.filter(function (p) { return planMatchesFilter(p, k); }).length;
        });

        // Fixed chips, always shown in this order: All, Learning Material, Test, Learning Material + Test
        var chipKeys = ['material', 'test', 'both'];

        var chips = [{ key: 'all', label: 'All', count: all.length }].concat(
            chipKeys.map(function (k) { return { key: k, label: PLAN_FILTER_LABELS[k], count: counts[k] }; })
        );

        bar.innerHTML = chips.map(function (chip) {
            var activeClass = chip.key === planTypeFilter ? ' active btn-primary text-white' : ' btn-outline-primary';
            return '<button type="button" class="filter-chip btn' + activeClass + '" data-plan-filter-key="' + esc(chip.key) + '">' +
                        esc(chip.label) + '<span class="chip-count">(' + chip.count + ')</span>' +
                    '</button>';
        }).join('');

        bar.querySelectorAll('.filter-chip').forEach(function (btn) {
            btn.addEventListener('click', function () {
                planTypeFilter = btn.getAttribute('data-plan-filter-key');
                renderPlanFilterBar(programId);
                renderPlansGrid(programId);
            });
        });
    }

    function planComponentsHtml(plan) {
        var comps = plan.components || [];
        if (!comps.length) return '';
        return '' +
            '<div class="plan-includes">' +
                '<div class="plan-includes-label">Includes</div>' +
                '<ul class="plan-includes-list">' +
                    comps.map(function (c) {
                        return '<li>' +
                            '<span class="pi-name">' + esc(c.component_name) + '</span>' +
                            (c.quantity ? '<span class="pi-qty">× ' + Number(c.quantity) + '</span>' : '') +
                            '</li>';
                    }).join('') +
                '</ul>' +
            '</div>';
    }

    function renderPlansGrid(programId) {
        var grid = document.getElementById('plansGrid');
        var plans = plansForProgram(programId);

        if (planTypeFilter !== 'all') {
            plans = plans.filter(function (p) { return planMatchesFilter(p, planTypeFilter); });
        }

        if (!plans.length) {
            grid.innerHTML = plansForProgram(programId).length
                ? '<div class="empty-note">No plans match this filter.</div>'
                : '<div class="empty-note">No plans are available for this program.</div>';
            return;
        }

        grid.innerHTML = plans.map(function (plan, index) {
            var inCart = cartHasPlan(plan.id);
            var hasDiscount = Number(plan.discount_amount) > 0;

            var actionHtml = plan.bought
                ? '<span class="cart-btn btn purchased">✓ Purchased</span>'
                : '<button type="button" class="cart-btn btn ' + (inCart ? 'btn-success' : 'btn-outline-primary') + '" data-plan-id="' + plan.id + '" ' + (inCart ? 'disabled' : '') + '>' +
                    (inCart ? 'In Cart ✓' : '<span class="cart-icon"><i class="bi bi-cart3"></i></span> Add to Cart') +
                  '</button>';

            return '' +
                '<div class="plan-card">' +
                    '<div class="plan-card-col plan-basic">' +
                        '<span class="plan-number">PLAN ' + (index + 1) + '</span>' +
                        '<div class="plan-name">' + esc(plan.plan_name) + '</div>' +
                        (plan.duration ? '<div class="plan-duration">' + esc(plan.duration) + '</div>' : '') +
                        (index === 0 ? '<span class="best-value-badge">Best Value</span>' : '') +
                    '</div>' +
                    '<div class="plan-card-col plan-includes">' +
    '<div class="plan-includes-label">Includes</div>' +
    (plan.components && plan.components.length
        ? '<ul class="plan-includes-list">' +
            plan.components.map(function (c, i) {
                return '<li class="' + (i >= 4 ? 'extra-component d-none' : '') + '">' +
                    '<span class="include-check">✓</span><span class="pi-name">' +
                    esc(c.component_name) +
                    (c.quantity ? ' – ' + Number(c.quantity) + ' Units' : '') +
                    '</span></li>';
            }).join('') +
          '</ul>'
        : '<div class="plan-no-includes">Plan details available</div>') +
    ((plan.components || []).length > 4
        ? '<button type="button" class="more-components toggle-components btn btn-link p-0 text-start" ' +
              'data-extra="' + ((plan.components || []).length - 4) + '" data-expanded="0">+ ' +
              ((plan.components || []).length - 4) + ' more component' +
              (((plan.components || []).length - 4) > 1 ? 's' : '') +
          '</button>'
        : '') +
'</div>'  +
                    '<div class="plan-card-col plan-pricing">' +
                        '<div class="plan-price">₹' + money(plan.final_price) + '</div>' +
                        (hasDiscount
                            ? '<div class="plan-price-old">₹' + money(plan.total_value) + '</div>'
                            : '') +
                        (hasDiscount
                            ? '<span class="plan-discount">' + Number(plan.discount_percent) + '% off</span>'
                            : '') +
                    '</div>' +
                    '<div class="plan-card-col plan-action">' +
                        actionHtml +
                    '</div>' +
                '</div>';
        }).join('');

        grid.querySelectorAll('[data-plan-id]:not([disabled])').forEach(function (btn) {
            btn.addEventListener('click', function () {
                confirmPlanUnits(btn.getAttribute('data-plan-id'), btn);
            });
        });
    }

    // ---- Detail view: components ----
function renderComponentsList(programId) {
    var list = document.getElementById('componentList');
    var components = componentsForProgram(programId);
    if (!components.length) { list.innerHTML = ''; return; }

    list.innerHTML = components.map(function (c) {
        var units = Number(c.purchased_units || 0);

        var allWeekOptions = lmOptionsForComponent(c.id);
        var weekOptions     = availableLmOptionsForComponent(c.id);
        var hasData         = allWeekOptions.length > 0;
        var allBought       = hasData && weekOptions.length === 0;

        // No lm_content rows for this component (e.g. Test components) —
        // NO From/To unit dropdowns. Sold as a single item with a plain Add button.
        if (!hasData) {
            var inCartPlain = cart.some(function (it) {
                return it.item_type === 'component' && String(it.id) === String(c.id);
            });
            var plainAction = (c.bought || units > 0)
                ? '<span class="purchased-note" style="font-size:1rem;color:#1e8e5a;font-weight:700;">\u2713 Purchased</span>'
                : (inCartPlain
                    ? '<button type="button" class="add-component-plain-btn cart-btn btn btn-success" disabled>In Cart \u2713</button>'
                    : '<button type="button" class="add-component-plain-btn cart-btn btn" data-component-id="' + c.id + '"><span class="cart-icon"><i class="bi bi-cart3"></i></span> Add to Cart</button>');
            return '' +
                '<div class="component-row d-flex align-items-center justify-content-between flex-wrap gap-3" data-component-id="' + c.id + '">' +
                    '<div class="component-info">' +
                        '<div class="c-name">' + esc(c.component_name) + '</div>' +
                        '<div class="c-meta">' + esc(c.component_type) + (c.component_mode ? ' \u00b7 ' + esc(c.component_mode) : '') + (c.venue ? ' \u00b7 ' + esc(c.venue) : '') + '</div>' +
                    '</div>' +
                    '<div class="component-actions d-flex align-items-center flex-wrap gap-2">' +
                        '<div class="component-price">\u20b9' + money(c.unit_price) + '</div>' +
                        plainAction +
                    '</div>' +
                '</div>';
        }

        if (allBought) {
            return '' +
                '<div class="component-row d-flex align-items-center justify-content-between flex-wrap gap-3" data-component-id="' + c.id + '">' +
                    '<div class="component-info">' +
                        '<div class="c-name">' + esc(c.component_name) + '</div>' +
                        '<div class="c-meta">' + esc(c.component_type) + (c.component_mode ? ' · ' + esc(c.component_mode) : '') + (c.venue ? ' · ' + esc(c.venue) : '') + '</div>' +
                    '</div>' +
                    '<div class="component-actions">' +
                        '<div class="component-week-note">✓ All units purchased</div>' +
                    '</div>' +
                '</div>';
        }

        // ---- Data-driven dropdowns (same logic for every component) ----
        var classNumber = weekOptions[0].class_number;

        var sortedWeeks = weekOptions
            .map(function (o) { return Number(o.week_number); })
            .sort(function (a, b) { return a - b; });

        var fromKey = Number(componentWeekSelection[c.id + '_from']);
        if (!fromKey || sortedWeeks.indexOf(fromKey) === -1) {
            fromKey = sortedWeeks[0];
        }
        componentWeekSelection[c.id + '_from'] = fromKey;

        var startIdx = sortedWeeks.indexOf(fromKey);
        var maxUnits = 1;
        for (var i = startIdx + 1; i < sortedWeeks.length; i++) {
            if (sortedWeeks[i] === sortedWeeks[i - 1] + 1) { maxUnits++; } else { break; }
        }

        // "From Unit" is now ENABLED — student can pick any available
        // starting unit from the table, not a fixed/disabled value.
        var fromOptionsHtml = sortedWeeks.map(function (w) {
            var sel = w === fromKey ? ' selected' : '';
            return '<option value="' + w + '"' + sel + '>Unit ' + w + '</option>';
        }).join('');
        var fromSelectHtml = '<select class="component-week-select form-select" data-role="from" data-component-id="' + c.id + '">' + fromOptionsHtml + '</select>';

        var unitsKey = Number(componentWeekSelection[c.id + '_units']);
        if (!unitsKey || unitsKey > maxUnits) { unitsKey = 1; }
        componentWeekSelection[c.id + '_units'] = unitsKey;

        var unitsOptionsHtml = '';
        for (var u = 1; u <= maxUnits; u++) {
            var toUnitLabel = fromKey + u - 1;
            unitsOptionsHtml += '<option value="' + u + '"' +
    (u === unitsKey ? ' selected' : '') +
    '>Unit ' + toUnitLabel +
    '</option>';
        }
        var unitsSelectHtml = '<select class="component-week-select form-select" data-role="units" data-component-id="' + c.id + '">' + unitsOptionsHtml + '</select>';

        var purchasedNote = units > 0
            ? '<div class="purchased-note" style="font-size:1rem;color:#1e8e5a;font-weight:700;">✓ ' + units + ' unit' + (units === 1 ? '' : 's') + ' purchased</div>'
            : (c.bought ? '<div class="purchased-note" style="font-size:0.8rem;color:#1e8e5a;font-weight:700;">✓ Purchased</div>' : '');

        return '' +
            '<div class="component-row d-flex align-items-center justify-content-between flex-wrap gap-3" data-component-id="' + c.id + '" data-class-number="' + classNumber + '">' +
                '<div class="component-info">' +
                    '<div class="c-name">' + esc(c.component_name) + '</div>' +
                    '<div class="c-meta">' + esc(c.component_type) + (c.component_mode ? ' · ' + esc(c.component_mode) : '') + (c.venue ? ' · ' + esc(c.venue) : '') + '</div>' +
                    purchasedNote +
                '</div>' +
                '<div class="component-actions d-flex align-items-center flex-wrap gap-2">' +
                    fromSelectHtml + unitsSelectHtml +
                    '<div class="component-price">₹' + money(c.unit_price) + '</div>' +
                    '<button type="button" class="add-component-btn add-component-week-btn btn btn-outline-primary btn-lg">' + ((units > 0 || c.bought) ? '<span class="cart-icon"><i class="bi bi-cart3"></i></span>Add More' : 'Add') + '</button>' +
                '</div>' +
            '</div>';
    }).join('');

    // ---- Plain Add (components without weekly data, e.g. Tests) ----
    list.querySelectorAll('.add-component-plain-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            addComponentToCart(btn.getAttribute('data-component-id'), btn, null, 1);
        });
    });

    // ---- Wire up every row — all data-driven now, one path for all ----
    list.querySelectorAll('.add-component-week-btn').forEach(function (btn) {
        var row         = btn.closest('.component-row');
        var componentId = row.getAttribute('data-component-id');
        var classNumber = row.getAttribute('data-class-number');
        var fromSelect  = row.querySelector('[data-role="from"]');
        var unitsSelect = row.querySelector('[data-role="units"]');

        fromSelect.addEventListener('change', function (e) {
            componentWeekSelection[componentId + '_from']  = Number(e.target.value);
            componentWeekSelection[componentId + '_units'] = 1;
            renderComponentsList(currentProgramId);
        });
        unitsSelect.addEventListener('change', function (e) {
            componentWeekSelection[componentId + '_units'] = Number(e.target.value);
        });

        btn.addEventListener('click', function (e) {
            var fromWeek = Number(fromSelect.value);
            var units    = Number(unitsSelect.value);
            var toWeek   = fromWeek + units - 1;
            addComponentRangeToCart(componentId, classNumber, fromWeek, toWeek, e.target);
        });
    });
}
    function renderProgramHeader(program) {
        var description = stripHtml(program.description || '');
        var syllabusUrl = program.syllabus_path ? docUrl(program.syllabus_path) : '';
        var circularPath = circularPathForProgram(program.id);
        var tagline = program.tagline ||
                      program.subtitle ||
                      program.duration_label ||
                      (program.duration_weeks ? program.duration_weeks + '-Week Masterclass' : '') ||
                      program.domain ||
                      '';

        var metaHtml = programMetaBoxesHtml(program);
        var includedHtml = includedPillsHtml(program.id);

        var secondaryDocs = '';
        if (circularPath) {
            secondaryDocs += '<a href="' + esc(docUrl(circularPath)) + '" target="_blank" rel="noopener">' +
                docIconSvg() + ' Circular</a>';
        }
        // if (program.test_schedule_path) {
        //     secondaryDocs += '<a class="test-schedule-link" href="' + esc(docUrl(program.test_schedule_path)) + '" target="_blank" rel="noopener">' +
        //         docIconSvg() + ' Test Schedule</a>';
        // }

        // var whatYouGet = syllabusUrl
        //     ? '<a class="hero-syllabus-btn" href="' + esc(syllabusUrl) + '" target="_blank" rel="noopener">' +
        //         docIconSvg() + '<span>View Syllabus</span>' + arrowRightIconSvg() + '</a>'
        //     : '';
        var syllabusButton = syllabusUrl
            ? '<a class="top-syllabus-btn" href="' + esc(syllabusUrl) + '" target="_blank" rel="noopener">' +
                docIconSvg() +
                '<span>View Syllabus</span>' +
                arrowRightIconSvg() +
              '</a>'
            : '';

       var whatYouGetUrl = program.what_you_get_path ? docUrl(program.what_you_get_path) : '';
        var whatYouGetButton = whatYouGetUrl
            ? '<a class="top-syllabus-btn" href="' + esc(whatYouGetUrl) + '" target="_blank" rel="noopener">' +
                checkCircleIconSvg() +
                '<span>What You Get</span>' +
                arrowRightIconSvg() +
              '</a>'
            : '';

        var testScheduleUrl = program.test_schedule_path ? docUrl(program.test_schedule_path) : '';
        var testScheduleButton = testScheduleUrl
            ? '<a class="top-syllabus-btn" href="' + esc(testScheduleUrl) + '" target="_blank" rel="noopener">' +
                docIconSvg() +
                '<span>View Test Schedule</span>' +
                arrowRightIconSvg() +
              '</a>'
            : '';

        var topSyllabusEl     = document.getElementById('topSyllabusButton');
        var topTestScheduleEl = document.getElementById('topTestScheduleButton');
        var topWhatYouGetEl   = document.getElementById('topWhatYouGetButton');

        if (topSyllabusEl)     topSyllabusEl.innerHTML     = syllabusButton;
        if (topTestScheduleEl) topTestScheduleEl.innerHTML = testScheduleButton;
        if (topWhatYouGetEl)   topWhatYouGetEl.innerHTML   = whatYouGetButton;
// remove the duplicate line that repeats topSyllabusButton assignment
        // var artSvg =
        //     '<svg class="program-art-svg" viewBox="0 0 300 210" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">' +
        //         '<circle cx="151" cy="103" r="88" fill="#EEF4FF"/>' +
        //         '<circle cx="219" cy="45" r="5" fill="#4D7CFE"/>' +
        //         '<circle cx="77" cy="72" r="4" fill="#4D7CFE"/>' +
        //         '<rect x="100" y="75" width="120" height="78" rx="10" fill="#2F66E8"/>' +
        //         '<rect x="108" y="83" width="104" height="61" rx="7" fill="#8DB0FF"/>' +
        //         '<rect x="129" y="96" width="62" height="27" rx="5" fill="#fff"/>' +
        //         '<path d="M144 109h32M160 100v18" stroke="#2F66E8" stroke-width="3" stroke-linecap="round"/>' +
        //         '<rect x="86" y="133" width="100" height="15" rx="7" fill="#3B73EE"/>' +
        //         '<rect x="79" y="151" width="118" height="14" rx="7" fill="#FFB23E"/>' +
        //         '<rect x="93" y="168" width="105" height="14" rx="7" fill="#6C8FEF"/>' +
        //         '<rect x="204" y="130" width="48" height="55" rx="8" fill="#263A74"/>' +
        //         '<rect x="212" y="138" width="32" height="13" rx="3" fill="#DDE7FF"/>' +
        //         '<circle cx="220" cy="163" r="4" fill="#DDE7FF"/><circle cx="236" cy="163" r="4" fill="#DDE7FF"/>' +
        //         '<circle cx="220" cy="176" r="4" fill="#DDE7FF"/><circle cx="236" cy="176" r="4" fill="#DDE7FF"/>' +
        //         '<path d="M67 157l16-30 11 6-16 30z" fill="#3155E7"/>' +
        //         '<path d="M66 158l-5 9 10-4z" fill="#F5C6A5"/>' +
        //         '<rect x="45" y="157" width="27" height="27" rx="7" fill="#6B4CCB"/>' +
        //     '</svg>';

//         document.getElementById('programHeader').innerHTML =
//             '<div class="hero-left">' +
//                 '<span class="hero-subject-badge">' + esc(program.subject || 'PROGRAM') + '</span>' +
//                 '<h1>' + esc(program.program_name) + '</h1>' +
//                 (tagline ? '<div class="hero-tagline">' + esc(tagline) + '</div>' : '') +
//                 (description ?
//                     '<div class="hero-description-wrap">' +
//                         '<div class="hero-description">' + esc(description) + '</div>' +
//                         '<button type="button" class="read-more-btn hero-read-more btn btn-link p-0" data-program-id="' + program.id + '">Read More</button>' +
//                     '</div>'
//                 : '') +
//                 metaHtml +
//                 includedHtml +
//                 secondaryDocs +
//             '</div>' +
//             '<div class="hero-right">' +
//     '<div class="program-art">' + artSvg + '</div>' +
// '</div>';

        renderProgramResources(program);
    }

    // function renderProgramResources(program) {
    //     var block = document.getElementById('programResources');
    //     var linksEl = document.getElementById('programResourceLinks');
    //     var html = programDocsHtml(program);
    //     if (!html) {
    //         block.style.display = 'none';
    //         linksEl.innerHTML = '';
    //         return;
    //     }
    //     block.style.display = 'block';
    //     linksEl.innerHTML = html;
    // }
    function renderProgramResources(program) {
    var block = document.getElementById('programResources');
    var linksEl = document.getElementById('programResourceLinks');

    // Resource block is disabled/removed from HTML
    if (!block || !linksEl) {
        return;
    }

    var html = programDocsHtml(program);

    if (!html) {
        block.style.display = 'none';
        linksEl.innerHTML = '';
        return;
    }

    block.style.display = 'block';
    linksEl.innerHTML = html;
}
// ---- Tabs: Existing Plan / Custom Plan ----
function setActiveTab(name) {
    document.querySelectorAll('.plan-tab').forEach(function (t) {
        t.classList.toggle('active', t.getAttribute('data-tab') === name);
    });
    document.getElementById('plansBlock').classList.toggle('active', name === 'plans');
    document.getElementById('plansBlock').style.display = (name === 'plans') ? 'block' : 'none';
    document.getElementById('componentsBlock').classList.toggle('active', name === 'custom');
    document.getElementById('componentsBlock').style.display = (name === 'custom') ? 'block' : 'none';
}

function syncTabs(programId) {
    var hasPlans = plansForProgram(programId).length > 0;
    var hasComps = componentsForProgram(programId).length > 0;

    document.getElementById('tabPlans').closest('.nav-item').style.display  = hasPlans ? '' : 'none';
    document.getElementById('tabCustom').closest('.nav-item').style.display = hasComps ? '' : 'none';

    setActiveTab(hasPlans ? 'plans' : 'custom');
}

document.querySelectorAll('.plan-tab').forEach(function (tab) {
    tab.addEventListener('click', function () {
        setActiveTab(tab.getAttribute('data-tab'));
    });
});
    function openProgram(programId) {
        var program = PROGRAMS.find(function (p) { return String(p.id) === String(programId); });
        if (!program) return;
        currentProgramId = programId;

        renderProgramHeader(program);
        planTypeFilter = 'all';
        renderPlanFilterBar(programId);
        renderPlansGrid(programId);
        renderComponentsList(programId);
syncTabs(programId);
        document.getElementById('listView').style.display = 'none';
        document.getElementById('detailView').style.display = 'block';
        window.scrollTo({top: 0, behavior: 'smooth'});
    }

    document.getElementById('backToListBtn').addEventListener('click', function () {
        document.getElementById('detailView').style.display = 'none';
        document.getElementById('listView').style.display = 'block';
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
renderProgramFilterBar();
    renderProgramGrid();
    renderCart();

    var openProgramId = <?php echo json_encode($open_program_id ?? null); ?>;
    if (openProgramId) { openProgram(openProgramId); }


    // ---- Description popup (Bootstrap modal, full rich-text description) ----
    var descriptionModalEl = document.getElementById('descriptionModal');
    var descriptionModalInstance = new bootstrap.Modal(descriptionModalEl);

    function openDescriptionPopup(programId) {
        var program = PROGRAMS.find(function (p) { return String(p.id) === String(programId); });
        if (!program) return;
        document.getElementById('fullDescription').innerHTML = sanitizeHtml(program.description);
        descriptionModalInstance.show();
    }
    document.addEventListener('click', function (e) {
    var btn = e.target.closest('.toggle-components');
    if (!btn) return;
    e.preventDefault();

    var col      = btn.closest('.plan-includes');
    var extra    = Number(btn.getAttribute('data-extra'));
    var expanded = btn.getAttribute('data-expanded') === '1';

    col.querySelectorAll('.extra-component').forEach(function (li) {
        li.classList.toggle('d-none', expanded);   // expanded now -> hide again
    });

    btn.setAttribute('data-expanded', expanded ? '0' : '1');
    btn.textContent = expanded
        ? '+ ' + extra + ' more component' + (extra > 1 ? 's' : '')
        : 'Show less';
});
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.read-more-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        openDescriptionPopup(btn.getAttribute('data-program-id'));
    });

    document.getElementById('descriptionModalClose').addEventListener('click', function () {
        descriptionModalInstance.hide();
    });


    function addComponentRangeToCart(componentId, classNumber, fromWeek, toWeek, btn) {
    btn.disabled = true;
    var original = btn.textContent;
    btn.textContent = 'Adding…';

    fetch(addComponentRangeUrl, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'cin=' + encodeURIComponent(CIN) +
              '&component_id=' + encodeURIComponent(componentId) +
              '&class_number=' + encodeURIComponent(classNumber) +
              '&from_week=' + encodeURIComponent(fromWeek) +
              '&to_week=' + encodeURIComponent(toWeek)
    })
    .then(function (r) { return r.json(); })
    .then(function (res) {
        btn.disabled = false;
        btn.textContent = original;
        if (res.success) {
            applyCartResponse(res);
            renderComponentsList(currentProgramId);
        } else {
            alert(res.message || 'Could not add to cart.');
        }
    })
    .catch(function () {
        btn.disabled = false;
        btn.textContent = original;
        alert('Network error — please try again.');
    });
}
</script>
</body>
</html>