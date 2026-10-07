<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration — Lunar Assessments</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root{
        --blue:#3B5BFE; --blue-deep:#2B46D6; --blue-soft:#EAF0FF;
        --bg:#F4F6FB; --card:#FFFFFF;
        --ink:#16213E; --muted:#8A93A6; --line:#E9ECF3;
        --green:#16A34A; --green-soft:#E3F8EA;
        --danger:#DC3545; --danger-soft:#FDECEE;
        --input-bg:#F8F9FC;
        --font:'Inter',system-ui,-apple-system,sans-serif;
    }
    *{box-sizing:border-box;}
    html,body{height:100%;}
    body{
        margin:0;font-family:var(--font);background:var(--bg);color:var(--ink);
        display:flex;flex-direction:column;overflow:hidden; /* no page scroll */
    }
    a{color:inherit;}

    /* ---- Top bar / brand ---- */
    .topbar{background:var(--card);border-bottom:1px solid var(--line);padding:8px 24px;flex:none;}
    .topbar-inner{max-width:1180px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;}
    .brand{display:flex;align-items:center;gap:8px;}
    .brand-mark {
    width: 150px;
    height: 60px;
    object-fit: contain;
    border-radius: 50%;
}
    .brand-text{line-height:1.1;}
    .brand-name{font-weight:800;font-size:12.5px;letter-spacing:.01em;color:var(--ink);}
    .brand-tag{font-size:8.5px;letter-spacing:.14em;color:var(--muted);font-weight:600;}
    .login-link{font-size:14px;color:var(--muted);}
    .login-link a{color:var(--blue);font-weight:700;text-decoration:none;}

    .wrap{max-width:1180px;margin:0 auto;padding:10px 20px;flex:1 1 auto;min-height:0;display:flex;flex-direction:column;width:100%;}

    .head-row{display:flex;align-items:baseline;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:10px;flex:none;}
    .hero-title{font-size:17px;font-weight:800;margin:0;color:var(--ink);}
    .hero-sub{font-size:12px;color:var(--muted);margin:0;max-width:520px;line-height:2.5;}

    /* ---- Progress card (dashboard-style stepper) ---- */
    .progress-card{
        background:var(--card);border:1px solid var(--line);border-radius:12px;
        padding:10px 18px;box-shadow:0 1px 2px rgba(16,24,40,.04);
        display:flex;align-items:center;gap:18px;flex-wrap:wrap;margin-bottom:8px;flex:none;
    }
    .progress-title{font-size:12.5px;font-weight:800;color:var(--ink);white-space:nowrap;flex:none;}
    .phase-stepper{display:flex;align-items:center;flex:1 1 auto;flex-wrap:wrap;gap:0;}
    .phase-step{display:flex;align-items:center;gap:8px;flex:none;}
    .phase-icon{
        width:26px;height:26px;border-radius:50%;border:2px solid var(--line);background:#fff;
        display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--muted);
        flex:none;
    }
    .phase-step.done .phase-icon{background:var(--green);border-color:var(--green);color:#fff;}
    .phase-step.active .phase-icon{background:var(--card);border:2px solid var(--blue);color:var(--blue);}
    .phase-step.locked .phase-icon{color:#C3C9D6;border-color:var(--line);}
    .phase-text{line-height:1.2;}
    .phase-name{font-size:11.5px;font-weight:700;color:var(--ink);white-space:nowrap;}
    .phase-status{font-size:9.5px;font-weight:600;color:var(--muted);white-space:nowrap;}
    .phase-step.active .phase-status{color:var(--blue);}
    .phase-step.done .phase-status{color:var(--green);}
    .phase-step.locked .phase-name{color:#A7AEBD;}
    .phase-connector{width:110px;height:0;border-top:2px dashed var(--line);margin:0 10px;flex:none;}
    .phase-connector.filled{border-top-color:var(--green);}
    @media (max-width:520px){.phase-status{display:none;}}

    .alert{padding:8px 14px;border-radius:8px;margin-bottom:8px;font-size:12.5px;flex:none;}
    .alert-success{background:var(--green-soft);color:#0F7A38;border:1px solid #BCEAC9;}
    .alert-danger{background:var(--danger-soft);color:var(--danger);border:1px solid #F4C2C9;}

    /* ---- The single-screen form card ---- */
    #regForm{flex:1 1 auto;min-height:0;display:flex;flex-direction:column;}
    .card{
        background:var(--card);border:1px solid var(--line);border-radius:14px;
        padding:14px 20px;box-shadow:0 1px 2px rgba(16,24,40,.04);
        flex:1 1 auto;min-height:0;display:flex;flex-direction:column;
    }
    .section{margin-bottom:10px;}
    .section:last-of-type{margin-bottom:0;}
    .section-title{
        font-size:11px;font-weight:800;letter-spacing:.04em;text-transform:uppercase;
        color:var(--blue);margin:0 0 8px;padding-bottom:6px;border-bottom:1px solid var(--line);
        display:flex;align-items:center;gap:6px;
    }
    .section-title .step-badge{
        width:16px;height:16px;border-radius:5px;background:var(--blue-soft);color:var(--blue);
        font-size:9.5px;font-weight:800;display:flex;align-items:center;justify-content:center;
        text-transform:none;letter-spacing:0;
    }

    .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:10px 14px;}
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:10px 14px;}
    @media (max-width:900px){.grid-3{grid-template-columns:repeat(2,1fr);}}
    @media (max-width:600px){
        .grid-3, .grid-2{grid-template-columns:1fr;}
        body{overflow:auto;} /* allow scroll only on very small screens */
    }

    .field{margin-bottom:0;}
    .field label{display:block;font-size:11px;font-weight:600;margin-bottom:3px;color:var(--ink);}
    .field input, .field select{
        width:100%;padding:7px 10px;border:1px solid var(--line);
        border-radius:8px;font-size:12.5px;background:var(--input-bg);font-family:var(--font);color:var(--ink);
        height:34px;
    }
    .field input:focus, .field select:focus{outline:none;border-color:var(--blue);background:#fff;box-shadow:0 0 0 3px var(--blue-soft);}
    .field input[readonly]{background:var(--blue-soft);color:var(--blue-deep);font-weight:700;cursor:not-allowed;}
    .field-error{color:var(--danger);font-size:10.5px;margin-top:3px;}
    .field-hint{color:var(--muted);font-size:10px;margin-top:3px;}

    .submit-row{margin-top:10px;padding-top:10px;border-top:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;flex:none;}
    button.submit-btn{
        background:var(--blue);color:#fff;border:none;padding:10px 24px;
        border-radius:9px;font-size:13px;font-weight:700;cursor:pointer;font-family:var(--font);
        transition:background .15s;display:inline-flex;align-items:center;gap:8px;
    }
    button.submit-btn:hover{background:var(--blue-deep);}
    .login-link-bottom{font-size:14px;color:var(--muted);}
    .login-link-bottom a{color:var(--blue);font-weight:700;text-decoration:none;}

    /* =========================================================
   NEW REGISTRATION TEMPLATE - IMAGE STYLE
   ========================================================= */

.registration-card {
    background: #fff;
    border: 0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 18px 45px rgba(31, 52, 100, 0.12);
    display: grid;
    grid-template-columns: 1.45fr .95fr;
    min-height: 620px;
    flex: 1 1 auto;
    min-height: 0;
}

/* Left form area */
.registration-form-area {
    padding: 34px 50px;
    background: #fff;
    overflow-y: auto;
}

.step-label {
    display: inline-flex;
    align-items: center;
    padding: 7px 14px;
    border-radius: 20px;
    background: #eaf0ff;
    color: #2860e8;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .02em;
    margin-bottom: 14px;
}

.registration-form-area h1 {
    margin: 0;
    font-size: 27px;
    font-weight: 800;
    color: #17233f;
}

.school-name-display {
    margin-top: 10px;
    color: #f39a0b;
    font-size: 17px;
    font-weight: 800;
    text-transform: uppercase;
}

.form-progress {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 6px;
    margin: 25px 0 30px;
}

.form-progress span {
    height: 6px;
    border-radius: 10px;
    background: #e3e8f4;
}

.form-progress span.active {
    background: #3676ed;
}

/* ==========================================
   SCHOOL SEARCH
========================================== */

.school-search-wrap {
    display: flex !important;
    align-items: center !important;
    width: 100% !important;
    max-width: 1100px !important;
    min-height: 64px !important;

    margin: 25px auto !important;
    padding: 0 !important;

    background: #fff !important;
    border: 1px solid #dfe3eb !important;
    border-radius: 14px !important;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08) !important;

    overflow: hidden !important;
    position: relative !important;
    z-index: 999 !important;

    visibility: visible !important;
    opacity: 1 !important;
}

/* Country / State */
.school-search-field {
    display: flex !important;
    align-items: center !important;

    width: 200px !important;
    height: 64px !important;

    padding: 0 5px !important;

    flex: 0 0 130px !important;
    box-sizing: border-box !important;
}

.school-search-field select {
    display: block !important;

    width: 100% !important;
    height: 40px !important;

    border: none !important;
    outline: none !important;

    background: transparent !important;

    color: #333 !important;
    font-size: 15px !important;

    cursor: pointer !important;
}

/* Divider */
.school-search-divider {
    display: block !important;

    width: 1px !important;
    height: 32px !important;

    background: #e1e5ec !important;

    flex: 0 0 1px !important;
}

/* School name input */
.school-search-input {
    display: flex !important;
    align-items: center !important;

    gap: 10px !important;

    height: 64px !important;

    padding: 0 20px !important;

    flex: 1 1 auto !important;
    min-width: 0 !important;

    box-sizing: border-box !important;
}

.school-search-input svg {
    display: block !important;
    flex-shrink: 0 !important;
}

.school-search-input input {
    display: block !important;

    width: 100% !important;
    height: 40px !important;

    padding: 0 !important;
    margin: 0 !important;

    border: none !important;
    outline: none !important;

    background: transparent !important;

    color: #333 !important;
    font-size: 15px !important;
}

.school-search-input input::placeholder {
    color: #8a93a6 !important;
}

/* Search button */
#schoolSearchBtn {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;

    width: 130px !important;
    min-width: 130px !important;
    height: 64px !important;

    margin: 0 !important;
    padding: 0 20px !important;

    border: none !important;
    border-radius: 0 !important;

    background: #3540d4 !important;
    color: #fff !important;

    font-size: 15px !important;
    font-weight: 600 !important;

    cursor: pointer !important;
}

/* Hover */
#schoolSearchBtn:hover {
    background: #2933b8 !important;
}


/* ==========================================
   TABLET
========================================== */

@media (max-width: 991px) {

    .school-search-wrap {
        width: calc(100% - 30px) !important;
        max-width: 1100px !important;
    }

    .school-search-field {
        width: 160px !important;
        flex: 0 0 160px !important;
        padding: 0 14px !important;
    }

    .school-search-input {
        padding: 0 15px !important;
    }

    #schoolSearchBtn {
        width: 110px !important;
        min-width: 110px !important;
    }
}


/* ==========================================
   MOBILE
========================================== */

@media (max-width: 767px) {

    .school-search-wrap {
        display: flex !important;
        flex-direction: column !important;
        align-items: stretch !important;

        width: calc(100% - 30px) !important;
        max-width: 500px !important;

        margin: 20px auto !important;

        min-height: auto !important;
    }

    .school-search-field {
        width: 100% !important;
        flex: none !important;

        height: 54px !important;

        padding: 0 16px !important;
    }

    .school-search-divider {
        width: calc(100% - 32px) !important;
        height: 1px !important;

        margin: 0 16px !important;
    }

    .school-search-input {
        width: 100% !important;
        height: 54px !important;

        padding: 0 16px !important;
    }

    #schoolSearchBtn {
        width: 100% !important;
        min-width: 100% !important;
        height: 52px !important;
    }
}


/* ==========================================
   SMALL MOBILE
========================================== */

@media (max-width: 480px) {

    .school-search-wrap {
        width: calc(100% - 20px) !important;
        margin: 15px auto !important;
    }

    .school-search-field {
        height: 50px !important;
        padding: 0 14px !important;
    }

    .school-search-input {
        height: 50px !important;
        padding: 0 14px !important;
    }

    .school-search-divider {
        width: calc(100% - 28px) !important;
        margin: 0 14px !important;
    }

    #schoolSearchBtn {
        height: 50px !important;
    }
}
.school-search-results {
    display: none;
    max-width: 1100px;
    margin: -15px auto 0;
    max-height: 280px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #dfe3eb;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
}
.school-result {
    padding: 11px 16px;
    border-bottom: 1px solid #f0f2f7;
    cursor: pointer;
}
.school-result:last-child { border-bottom: 0; }
.school-result:hover, .school-result:focus { background: #f5f8ff; }
.school-result-name { font-size: 13.5px; font-weight: 700; color: #17233f; }
.school-result-address { font-size: 11.5px; color: #8a93a6; margin-top: 2px; }
.no-result { padding: 14px 16px; font-size: 12.5px; color: #8a93a6; }
/* ==========================================
   MANUAL ENTRY TOGGLE
   ========================================== */

.manual-toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;

    padding: 12px 15px;
    margin-bottom: 22px;

    background: #f8f9fc;
    border: 1px solid #e8ebf2;
    border-radius: 10px;
}

.manual-toggle-label {
    color: #596273;
    font-size: 12px;
    font-weight: 600;
}


/* Toggle */
.toggle-switch {
    position: relative;
    width: 42px;
    height: 23px;
    flex: 0 0 auto;
}

.toggle-switch input {
    display: none;
}

.toggle-slider {
    position: absolute;
    inset: 0;

    background: #d9deea;
    border-radius: 30px;
    cursor: pointer;

    transition: .2s ease;
}

.toggle-slider::before {
    content: "";

    position: absolute;
    width: 17px;
    height: 17px;
    left: 3px;
    top: 3px;

    background: #fff;
    border-radius: 50%;

    box-shadow: 0 1px 3px rgba(0,0,0,.18);

    transition: .2s ease;
}

.toggle-switch input:checked + .toggle-slider {
    background: #3676ed;
}

.toggle-switch input:checked + .toggle-slider::before {
    transform: translateX(19px);
}


/* ==========================================
   SCHOOL SUB-SECTIONS
   ========================================== */

.sub-section-label {
    margin: 20px 0 12px;

    color: #2860e8;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .05em;

    display: flex;
    align-items: center;
    gap: 8px;
}

.sub-section-label::after {
    content: "";
    height: 1px;
    flex: 1;

    background: #e9ecf3;
}


/* Disabled fields */
.registration-form-area .field input:disabled,
.registration-form-area .field select:disabled {
    background: #f1f3f7;
    color: #9aa3b5;
    border-color: #e5e8ef;
    cursor: not-allowed;
}


/* ==========================================
   MOBILE
   ========================================== */

@media (max-width: 600px) {

    .school-search-wrap input {
        height: 44px;
        font-size: 12px;
    }

    .manual-toggle-row {
        padding: 11px 12px;
    }

    .manual-toggle-label {
        font-size: 11px;
    }

    .school-search-results {
        max-height: 200px;
    }
}
.current-step {
    color: #2860e8;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.current-step-title {
    font-size: 22px;
    font-weight: 800;
    color: #17233f;
    margin-bottom: 22px;
}

/* Section */
.registration-section {
    margin-bottom: 25px;
}

.registration-section-title {
    font-size: 14px;
    font-weight: 800;
    color: #17233f;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.registration-section-title .number {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #eaf0ff;
    color: #2860e8;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 800;
}

/* Right welcome panel */
.registration-side {
    position: relative;
    padding: 48px 42px;
    color: #fff;
    background:
        linear-gradient(145deg, #18275e 0%, #2449b9 52%, #397eea 100%);
    overflow: hidden;
}

.registration-side:before {
    content: "";
    position: absolute;
    width: 280px;
    height: 280px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    right: -100px;
    top: -80px;
}

.registration-side:after {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
    left: -100px;
    bottom: -90px;
}

.side-logo {
    position: relative;
    z-index: 2;
    height: 60px;
    background: #fff;
    border-radius: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
    color: #f05a28;
    font-size: 23px;
    font-weight: 900;
    letter-spacing: -1px;
}

.side-logo span {
    color: #1755bb;
}

.side-content {
    position: relative;
    z-index: 2;
}

.side-content h2 {
    font-size: 25px;
    font-weight: 800;
    margin: 0 0 12px;
}

.side-content p {
    color: rgba(255,255,255,.88);
    font-size: 14px;
    line-height: 1.55;
    margin-bottom: 28px;
}

.side-step {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 17px 0;
    border-bottom: 1px solid rgba(255,255,255,.16);
}

.side-step:last-child {
    border-bottom: 0;
}

.side-step-number {
    width: 29px;
    height: 29px;
    min-width: 29px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 800;
}

.side-step.active .side-step-number {
    background: #fff;
    color: #285fe0;
    border-color: #fff;
}

.side-step-title {
    font-size: 14px;
    font-weight: 800;
}

.side-step-text {
    font-size: 12px;
    color: rgba(255,255,255,.75);
    margin-top: 3px;
}

.side-footer {
    position: absolute;
    z-index: 2;
    left: 42px;
    right: 42px;
    bottom: 35px;
    text-align: center;
    font-size: 11px;
    color: rgba(255,255,255,.7);
}

/* Form spacing inside new template */
.registration-form-area .section-title {
    display: none;
}

.registration-form-area .grid-3,
.registration-form-area .grid-2 {
    gap: 14px 18px;
}

.registration-form-area .field label {
    font-size: 11.5px;
    margin-bottom: 5px;
}

.registration-form-area .field input,
.registration-form-area .field select {
    height: 42px;
    padding: 9px 12px;
    border-radius: 9px;
    background: #f8f9fc;
}

.registration-form-area .submit-row {
    margin-top: 5px;
    padding-top: 20px;
}

/* Mobile */
@media (max-width: 900px) {
    .registration-card {
        grid-template-columns: 1fr;
    }

    .registration-side {
        display: none;
    }

    .registration-form-area {
        padding: 28px 25px;
    }
}

@media (max-width: 600px) {
    .registration-form-area {
        padding: 24px 18px;
    }

    .registration-form-area h1 {
        font-size: 23px;
    }

    .school-name-display {
        font-size: 14px;
    }

    .form-progress {
        margin: 20px 0 24px;
    }
}
/* ==========================================
   MULTI STEP FORM
   ========================================== */

.form-step {
    display: none;
}

.form-step.active-step {
    display: block;
    animation: stepFade .25s ease;
}

@keyframes stepFade {
    from {
        opacity: 0;
        transform: translateX(10px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.step-description {
    color: #8a93a6;
    font-size: 12px;
    margin-top: -15px;
    margin-bottom: 25px;
}

.step-navigation {
    margin-top: 35px;
    padding-top: 20px;
    border-top: 1px solid #e9ecf3;

    display: flex;
    align-items: center;
    gap: 12px;
}

.step-navigation-spacer {
    flex: 1;
}

.back-btn,
.next-btn,
.submit-btn {
    height: 44px;
    padding: 0 24px;
    border-radius: 9px;
    font-family: var(--font);
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    border: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
}

.back-btn {
    background: #f1f3f8;
    color: #596273;
}

.back-btn:hover {
    background: #e6e9f0;
}

.next-btn,
.submit-btn {
    background: #326bea;
    color: #fff;
    box-shadow: 0 8px 18px rgba(50, 107, 234, .22);
}

.next-btn:hover,
.submit-btn:hover {
    background: #2859d1;
}

.login-link-bottom {
    text-align: center;
    margin-top: 15px;
}

/* Right side active/completed states */

.side-step {
    transition: .2s ease;
}

.side-step.active .side-step-number {
    background: #fff;
    color: #285fe0;
    border-color: #fff;
}

.side-step.completed .side-step-number {
    background: #16a34a;
    border-color: #16a34a;
    color: #fff;
}

.side-step.completed .side-step-number::after {
    content: "✓";
}

.side-step.completed .side-step-number {
    font-size: 0;
}

.side-step.completed .side-step-number::after {
    font-size: 12px;
}

.side-step.active .side-step-title {
    color: #fff;
}

/* Progress bar */

.form-progress {
    grid-template-columns: repeat(5, 1fr);
}

.form-progress span {
    transition: .3s ease;
}

.form-progress span.completed,
.form-progress span.active {
    background: #3676ed;
}
.page-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    height: 36px;
    padding: 0 16px;
    margin-bottom: 10px;

    background: #f1f3f8;
    color: #596273;
    border: 1px solid #2053d2;
    border-radius: 8px;

    font-family: var(--font);
    font-size: 12.5px;
    font-weight: 700;
    cursor: pointer;

    transition: background .15s ease, color .15s ease;
}

.page-back-btn:hover {
    background: #e6e9f0;
    color: #17233f;
}

.page-back-btn:active {
    background: #dde1ea;
}
.grid-20-80 {
    display: grid;
    grid-template-columns: 8% 92%;
    gap: 14px;
    align-items: center;
}

.back-col {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
/* ---- Validation states ---- */
.registration-form-area .field input.is-invalid,
.registration-form-area .field select.is-invalid{
    border-color:var(--danger);
    background:#fff8f8;
}
.registration-form-area .field input.is-invalid:focus,
.registration-form-area .field select.is-invalid:focus{
    box-shadow:0 0 0 3px var(--danger-soft);
}
.registration-form-area .field-error{font-size:11.5px;margin-top:5px;}
</style>
</head>
<body>

<div class="topbar">
    <div class="topbar-inner">
        <div class="brand">
            <img 
    class="brand-mark" 
    src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" 
    alt="MARRS Logo"
>
        </div>
        <div class="login-link">Already registered? <a href="<?php echo site_url('cin_login'); ?>">Log in here</a></div>
    </div>
</div>

<div class="wrap">

    <div class="wrap">

    <div>
        <h1 class="hero-title">Student Registration</h1>
        <p class="hero-sub">Select your class and an open test series, then complete your details to receive your CIN.</p>
    </div>

    <div class="progress-card">
        <span class="progress-title">Your Progress</span>
        <div class="phase-stepper">
            <div class="phase-step active">
                <span class="phase-icon">1</span>
                <span class="phase-text"><span class="phase-name">Register</span><br><span class="phase-status">In Progress</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step locked">
                <span class="phase-icon">2</span>
                <span class="phase-text"><span class="phase-name">Choose Plan</span><br><span class="phase-status">Upcoming</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step locked">
                <span class="phase-icon">3</span>
                <span class="phase-text"><span class="phase-name">Cart</span><br><span class="phase-status">Upcoming</span></span>
            </div>
            <div class="phase-connector"></div>
             <div class="phase-step locked">
                <span class="phase-icon">3</span>
                <span class="phase-text"><span class="phase-name">Checkout</span><br><span class="phase-status">Upcoming</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step locked">
                <span class="phase-icon">4</span>
                <span class="phase-text"><span class="phase-name">Pay</span><br><span class="phase-status">Upcoming</span></span>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-danger"><?php echo $errors['general']; ?></div>
    <?php endif; ?>

    <?php echo form_open('student_registration/index', ['id' => 'regForm']); ?>

<div class="registration-card">

    <!-- LEFT SIDE -->
    <div class="registration-form-area">

        <div class="step-label" id="stepLabel">
            STEP 1 OF 5
        </div>

        <h1>Registration Form</h1>

        <div class="school-name-display">
        </div>

        <!-- Progress bars -->
        <div class="form-progress">
            <span class="active"></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>


        <!-- ==============================================
             STEP 1 - CLASS & PROGRAM
             ============================================== -->
        <div class="form-step active-step" data-step="1">

            <div class="current-step">
                STEP 1 OF 5
            </div>

            <div class="current-step-title">
                Class &amp; Program Name
            </div>

            <div class="step-description">
                Select your class and program to continue.
            </div>

            <div class="grid-3">

                <div class="field">
                    <label>Class</label>

                    <select name="class" id="classSelect">
                        <option value="">Select class</option>

                        <?php foreach ($classes as $c): ?>

                            <option
                                value="<?php echo htmlspecialchars($c['class']); ?>"
                                <?php echo (
                                    isset($old['class']) &&
                                    $old['class'] == $c['class']
                                ) ? 'selected' : ''; ?>
                            >
                                <?php echo htmlspecialchars($c['class']); ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (!empty($errors['class'])): ?>
                        <div class="field-error">
                            <?php echo $errors['class']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <div class="field">
                    <label>Program Name</label>

                    <select name="schedule_id" id="scheduleSelect">

                        <option value="">
                            Select class first
                        </option>

                        <?php foreach ($schedules as $s): ?>

                            <option
                                value="<?php echo $s['lunar_schedule_id']; ?>"
                                <?php echo (
                                    isset($old['schedule_id']) &&
                                    $old['schedule_id'] ==
                                    $s['lunar_schedule_id']
                                ) ? 'selected' : ''; ?>
                            >

                                <?php echo htmlspecialchars(
                                    $s['subject'] .
                                    ' — ' .
                                    $s['title'] .
                                    ')'
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (!empty($errors['schedule_id'])): ?>
                        <div class="field-error">
                            <?php echo $errors['schedule_id']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <div class="field">
                    <label>Registration Code</label>

                    <input
                        type="text"
                        name="registration_code"
                        id="registrationCodeInput"
                        readonly
                        value="<?php echo isset($old['registration_code']) ? htmlspecialchars($old['registration_code']) : ''; ?>"
                        placeholder="Select test series"
                    >

                    <?php if (!empty($errors['registration_code'])): ?>
                        <div class="field-error">
                            <?php echo $errors['registration_code']; ?>
                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>


        <!-- ==============================================
             STEP 2 - STUDENT DETAILS
             ============================================== -->
        <div class="form-step" data-step="2">

            <div class="current-step">
                STEP 2 OF 5
            </div>

            <div class="current-step-title">
                Student Details
            </div>

            <div class="step-description">
                Enter the student's personal information.
            </div>

            <div class="grid-3">

                <div class="field">
                    <label>Student Name <span style="color: red;">*</span></label>

                    <input
                        type="text"
                        name="student_name"
                        value="<?php echo isset($old['student_name']) ? htmlspecialchars($old['student_name']) : ''; ?>"
                    >

                    <?php if (!empty($errors['student_name'])): ?>
                        <div class="field-error">
                            <?php echo $errors['student_name']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <div class="field">
                    <label>Gender <span style="color: red;">*</span></label>

                    <select name="gender">

                        <option value="">Select</option>

                        <?php foreach (['Male', 'Female', 'Other'] as $g): ?>

                            <option
                                value="<?php echo $g; ?>"
                                <?php echo (
                                    isset($old['gender']) &&
                                    $old['gender'] == $g
                                ) ? 'selected' : ''; ?>
                            >
                                <?php echo $g; ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (!empty($errors['gender'])): ?>
                        <div class="field-error">
                            <?php echo $errors['gender']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <div class="field">
                    <label>Student Email </label>

                    <input
                        type="email"
                        name="stud_email"
                        value="<?php echo $this->session->userdata('email'); ?>"
                    >


                </div>


                <div class="field">
                    <label>Student Phone</label>

                    <input
                        type="text"
                        name="stud_phone"
                        value="<?php echo isset($old['stud_phone']) ? htmlspecialchars($old['stud_phone']) : ''; ?>"
                    >

                   

                </div>
                 <div class="field">
                    <label>Address</label>

                    <input
                        type="text"
                        name="address1"
                        value="<?php echo isset($old['address1']) ? htmlspecialchars($old['address1']) : ''; ?>"
                    >

                   

                </div>

            </div>

        </div>


        
        <!-- ==============================================
             STEP 3 - SCHOOL DETAILS
             ============================================== -->

<div class="form-step" data-step="3">

    <div class="current-step">
        STEP 3 OF 5
    </div>

    <div class="current-step-title">
        School Details
    </div>

    <div class="step-description">
        Search for your school, or add it manually if it isn't listed yet.
    </div>

    <!-- Search school -->
    <!--<div class="school-search-wrap">-->
    <!--    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8a93a6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
    <!--        <circle cx="11" cy="11" r="8"></circle>-->
    <!--        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>-->
    <!--    </svg>-->
    <!--    <input-->
    <!--        type="text"-->
    <!--        id="schoolSearchInput"-->
    <!--        autocomplete="off"-->
    <!--        placeholder="Type school name..."-->
    <!--    >-->
    <!--    <div class="school-search-results" id="schoolSearchResults"></div>-->
    <!--</div>-->
<!-- Search school -->
<!-- SCHOOL SEARCH -->
<div class="school-search-wrap">

    <div class="school-search-field">
        <select id="schoolSearchCountry">
            <option value="">Country</option>

            <?php if (!empty($countries)): ?>
                <?php foreach ($countries as $country): ?>
                    <option value="<?php echo $country['country_id']; ?>">
                        <?php echo htmlspecialchars($country['country_name']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="school-search-divider"></div>

    <div class="school-search-field">
       
        <select id="schoolSearchState">
    <option value="">State</option>
</select>
    </div>

    <div class="school-search-divider"></div>

    <div class="school-search-input">

        <input
            type="text"
            id="schoolSearchInput"
            autocomplete="off"
            placeholder="Enter school name..."
        >
    </div>

    <button type="button" id="schoolSearchBtn">
        Search
    </button>

</div>
<div class="school-search-results" id="schoolSearchResults"></div>
    <!-- Manual entry toggle -->
    <div class="manual-toggle-row">
        <span class="manual-toggle-label">School not in the list — enter details manually</span>
        <label class="toggle-switch">
            <input type="checkbox" id="manualEntryToggle">
            <span class="toggle-slider"></span>
        </label>
    </div>

    <input type="hidden" name="school_id" id="schoolIdInput" value="<?php echo isset($old['school_id']) ? htmlspecialchars($old['school_id']) : ''; ?>">

    <!-- School Identity -->
    <div class="sub-section-label">School Identity</div>

    <div class="grid-2" id="schoolIdentityGrid">

        <div class="field">
            <label>School Name</label>

            <input
                type="text"
                name="school_name"
                id="schoolNameInput"
                value="<?php echo isset($old['school_name']) ? htmlspecialchars($old['school_name']) : ''; ?>"
                placeholder="Enter school name"
                disabled
            >

            <?php if (!empty($errors['school_name'])): ?>
                <div class="field-error">
                    <?php echo $errors['school_name']; ?>
                </div>
            <?php endif; ?>

        </div>


        <div class="field" id="schoolCodeField">
            <label>School Code</label>

            <input
                type="text"
                name="school_code"
                id="schoolCodeInput"
                readonly
                value="<?php echo isset($old['school_code']) ? htmlspecialchars($old['school_code']) : ''; ?>"
                placeholder="Auto-filled"
            >
        </div>

    </div>

    <div class="field" style="margin-top:14px;">
        <label>Address</label>

        <input
            type="text"
            name="school_address"
            id="schoolAddressInput"
            value="<?php echo isset($old['school_address']) ? htmlspecialchars($old['school_address']) : ''; ?>"
            placeholder="Enter school address"
            disabled
        >

        <?php if (!empty($errors['school_address'])): ?>
            <div class="field-error">
                <?php echo $errors['school_address']; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- School Location -->
    <div class="sub-section-label">School Location</div>

    <div class="grid-3">
        <div class="field">
            <label for="schoolCountrySelect">Country</label>
            <select name="school_country_id" id="schoolCountrySelect" disabled>
                <option value="">Select country</option>
                <?php if (!empty($countries)): ?>
                    <?php foreach ($countries as $country): ?>
                        <option
                            value="<?php echo $country['country_id']; ?>"
                            <?php echo (
                                isset($old['school_country_id']) &&
                                $old['school_country_id'] == $country['country_id']
                            ) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($country['country_name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="field">
            <label for="schoolStateSelect">State</label>
            <select name="school_state_id" id="schoolStateSelect" disabled>
                <option value="">Select country first</option>
                <?php if (!empty($school_states)): ?>
                    <?php foreach ($school_states as $state): ?>
                        <option
                            value="<?php echo $state['state_subdivision_id']; ?>"
                            <?php echo (
                                isset($old['school_state_id']) &&
                                $old['school_state_id'] == $state['state_subdivision_id']
                            ) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($state['state_subdivision_name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="field">
            <label for="schoolPincodeInput">Pin Code</label>
            <input
                type="text"
                name="school_pincode"
                id="schoolPincodeInput"
                value="<?php echo isset($old['school_pincode']) ? htmlspecialchars($old['school_pincode']) : ''; ?>"
                placeholder="Auto-filled pin code"
                disabled
            >
        </div>
    </div>

    <div class="grid-3" style="margin-top:14px;">
        <div class="field">
            <label for="schoolDistrictSelect">District</label>
            <select name="school_district_id" id="schoolDistrictSelect" disabled>
                <option value="">Select state first</option>
                <?php if (!empty($school_districts)): ?>
                    <?php foreach ($school_districts as $district): ?>
                        <option
                            value="<?php echo isset($district['id']) ? $district['id'] : htmlspecialchars($district['district_name']); ?>"
                            data-name="<?php echo htmlspecialchars($district['district_name']); ?>"
                            <?php echo (
                                isset($old['school_district_id']) &&
                                $old['school_district_id'] == ($district['id'] ?? $district['district_name'])
                            ) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($district['district_name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="field">
            <label for="schoolCitySelect">City</label>
            <select name="school_city_id" id="schoolCitySelect" disabled>
                <option value="">Select state first</option>
                <?php if (!empty($school_areas)): ?>
                    <?php foreach ($school_areas as $area): ?>
                        <option
                            value="<?php echo $area['id']; ?>"
                            data-name="<?php echo htmlspecialchars($area['city_name']); ?>"
                            <?php echo (
                                isset($old['school_city_id']) &&
                                $old['school_city_id'] == $area['id']
                            ) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($area['city_name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div class="field">
            <label for="schoolMobileInput">Mobile</label>
            <input
                type="text"
                name="school_mobile"
                id="schoolMobileInput"
                value="<?php echo isset($old['school_mobile']) ? htmlspecialchars($old['school_mobile']) : ''; ?>"
                placeholder="Auto-filled mobile"
                disabled
            >
        </div>
    </div>

    <!-- Administration -->
    <div class="sub-section-label">Administration</div>

    <div class="grid-3">

        <div class="field">
            <label>Principal Name</label>

            <input
                type="text"
                name="principal_name"
                id="principalNameInput"
                value="<?php echo isset($old['principal_name']) ? htmlspecialchars($old['principal_name']) : ''; ?>"
                placeholder="Enter principal name"
                disabled
            >
        </div>


        <div class="field">
            <label>Principal Email</label>

            <input
                type="email"
                name="principal_email"
                id="principalEmailInput"
                value="<?php echo isset($old['principal_email']) ? htmlspecialchars($old['principal_email']) : ''; ?>"
                placeholder="Enter Principal Email"
                disabled
            >
        </div>


        <div class="field">
            <label>Principal Phone Number</label>

            <input
                type="text"
                name="principal_phone"
                id="principalPhoneInput"
                value="<?php echo isset($old['principal_phone']) ? htmlspecialchars($old['principal_phone']) : ''; ?>"
                placeholder="Enter principal phone number"
                disabled
            >
        </div>

    </div>

    <div class="step-navigation" style="margin-top:24px;padding-top:0;border-top:0;">
        <button type="button" class="back-btn" id="resetSchoolFormBtn">Reset form</button>
    </div>

</div>

<!-- ==============================================
             STEP 4 - PARENT / GUARDIAN
             ============================================== -->
        <div class="form-step" data-step="4">

            <div class="current-step">
                STEP 4 OF 5
            </div>

            <div class="current-step-title">
                Parent / Guardian Details
            </div>

            <div class="step-description">
                Enter the parent or guardian contact details.
            </div>

            <div class="grid-3">

                <div class="field">
                    <label>Father's Name</label>

                    <input
                        type="text"
                        name="father_name"
                        value="<?php echo isset($old['father_name']) ? htmlspecialchars($old['father_name']) : ''; ?>"
                    >
                </div>


                <div class="field">
                    <label>Mother's Name</label>

                    <input
                        type="text"
                        name="mother_name"
                        value="<?php echo isset($old['mother_name']) ? htmlspecialchars($old['mother_name']) : ''; ?>"
                    >
                </div>


                <div class="field">
                    <label>Email</label>

                    <input
                        type="email"
                        name="mother_email"
                        value="<?php echo isset($old['mother_email']) ? htmlspecialchars($old['mother_email']) : ''; ?>"
                    >
                </div>


                <div class="field">
                    <label>Father's Phone</label>

                    <input
                        type="text"
                        name="father_phone"
                        value="<?php echo isset($old['father_phone']) ? htmlspecialchars($old['father_phone']) : ''; ?>"
                    >
                </div>


               

            </div>

        </div>



        <!-- ==============================================
             STEP 5 - REGION
             ============================================== -->
        <div class="form-step" data-step="5">

            <div class="current-step">
                STEP 5 OF 5
            </div>

            <div class="current-step-title">
                Region
            </div>

            <div class="step-description">
                Select your country, state and district.
            </div>

            <div class="grid-3">

                <!-- Country -->
                <div class="field">

                    <label>Country</label>

                    <select name="country_id" id="countrySelect">

                        <option value="">
                            Select country
                        </option>

                        <?php if (!empty($countries)): ?>

                            <?php foreach ($countries as $country): ?>

                                <option
                                    value="<?php echo $country['country_id']; ?>"
                                    <?php echo (
                                        (isset($old['country_id']) &&
                                        $old['country_id'] ==
                                        $country['country_id']) ||

                                        (!isset($old['country_id']) &&
                                        $country['country_id'] == 105)

                                    ) ? 'selected' : ''; ?>
                                >

                                    <?php echo htmlspecialchars(
                                        $country['country_name']
                                    ); ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                    <?php if (!empty($errors['country_id'])): ?>
                        <div class="field-error">
                            <?php echo $errors['country_id']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <!-- State -->
                <div class="field">

                    <label>State</label>

                    <select name="state_id" id="stateSelect">

                        <option value="">
                            Select
                        </option>

                        <?php foreach ($states as $state): ?>

                            <option
                                value="<?php echo $state['state_subdivision_id']; ?>"
                                <?php echo (
                                    isset($old['state_id']) &&
                                    $old['state_id'] ==
                                    $state['state_subdivision_id']
                                ) ? 'selected' : ''; ?>
                            >

                                <?php echo htmlspecialchars(
                                    $state['state_subdivision_name']
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (!empty($errors['state_id'])): ?>
                        <div class="field-error">
                            <?php echo $errors['state_id']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                <!-- District -->
                <div class="field">

                    <label for="districtSelect">District</label>

                    <select name="district_id" id="districtSelect">
                        <option value="">Select state first</option>
                        <?php if (!empty($districts)): ?>
                            <?php foreach ($districts as $district): ?>
                                <option
                                    value="<?php echo isset($district['id']) ? $district['id'] : htmlspecialchars($district['district_name']); ?>"
                                    <?php echo (
                                        isset($old['district_id']) &&
                                        $old['district_id'] == ($district['id'] ?? $district['district_name'])
                                    ) ? 'selected' : ''; ?>
                                >
                                    <?php echo htmlspecialchars($district['district_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <?php if (!empty($errors['district'])): ?>
                        <div class="field-error">
                            <?php echo $errors['district']; ?>
                        </div>
                    <?php endif; ?>

                </div>


                

                <div class="field">
                    <label for="pin">Pin Code</label>
                    <input type="text" name="pin"  value="<?php echo isset($old['pin']) ? htmlspecialchars($old['pin']) : ''; ?>" placeholder="Enter pin code">
                </div>
                <!-- City -->
                <div class="field">
                    <label for="city">City</label>
                    <select name="city_id" id="city">
                        <option value="">Select state first</option>
                        <?php if (!empty($areas)): ?>
                            <?php foreach ($areas as $area): ?>
                                <option
                                    value="<?php echo $area['id']; ?>"
                                    <?php echo (
                                        isset($old['city_id']) &&
                                        $old['city_id'] == $area['id']
                                    ) ? 'selected' : ''; ?>
                                >
                                    <?php echo htmlspecialchars($area['city_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="field">
                    <label for="school_mobile">Mobile</label>
                    <input type="text" name="school_mobile" id="school_mobile" value="<?php echo isset($old['school_mobile']) ? htmlspecialchars($old['school_mobile']) : ''; ?>" placeholder="Enter mobile number">
                </div>

                <!-- KEEP THESE HIDDEN -->
                <div class="field" style="display:none;">

                    <label>Franchise</label>

                    <select name="franchise_id" id="franchiseSelect">

                        <option value="">
                            Select state first
                        </option>

                        <?php foreach ($franchises as $f): ?>

                            <option
                                value="<?php echo $f['franchise_id']; ?>"
                                <?php echo (
                                    isset($old['franchise_id']) &&
                                    $old['franchise_id'] ==
                                    $f['franchise_id']
                                ) ? 'selected' : ''; ?>
                            >
                                <?php echo htmlspecialchars(
                                    $f['username'] ??
                                    ('Franchise #' . $f['franchise_id'])
                                ); ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="field" style="display:none;">

                    <label>Associate (if referred)</label>

                    <select name="associate_id" id="associateSelect">

                        <option value="">
                            None
                        </option>

                        <?php foreach ($associates as $a): ?>

                            <option
                                value="<?php echo $a['associate_id']; ?>"
                                <?php echo (
                                    isset($old['associate_id']) &&
                                    $old['associate_id'] ==
                                    $a['associate_id']
                                ) ? 'selected' : ''; ?>
                            >

                                <?php echo htmlspecialchars(
                                    $a['first_name'] .
                                    ' ' .
                                    $a['last_name']
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>


        <!-- ==============================================
             STEP NAVIGATION
             ============================================== -->
        <div class="step-navigation">

            <button
                type="button"
                class="back-btn"
                id="backBtn"
                style="display:none;"
            >
                ← Back
            </button>


            <div class="step-navigation-spacer"></div>


            <button
                type="button"
                class="next-btn"
                id="nextBtn"
            >
                Continue →
            </button>


            <button
                type="submit"
                name="register_submit"
                value="1"
                class="submit-btn"
                id="registerBtn"
                style="display:none;"
            >
                Register &amp; Continue →
            </button>

        </div>


        <div class="login-link-bottom">
            Already registered?
            <a href="<?php echo site_url('cin_login'); ?>">
                Log in here
            </a>
        </div>

    </div>


    <!-- ==============================================
         RIGHT SIDE
         ============================================== -->
    <div class="registration-side">

        <div class="side-logo">
            <span>LUNAR</span>&nbsp; ASSESSMENTS
        </div>

        <div class="side-content">

            <h2>Welcome to Lunar</h2>

            <p>
                Complete your registration in 5 quick steps
                to enroll for your program.
            </p>


            <div class="side-step active" data-side-step="1">

                <div class="side-step-number">1</div>

                <div>
                    <div class="side-step-title">
                        Class &amp; Program
                    </div>

                    <div class="side-step-text">
                        Select your program
                    </div>
                </div>

            </div>


            <div class="side-step" data-side-step="2">

                <div class="side-step-number">2</div>

                <div>
                    <div class="side-step-title">
                        Student details
                    </div>

                    <div class="side-step-text">
                        Name &amp; contact
                    </div>
                </div>

            </div>


            <div class="side-step" data-side-step="3">

                <div class="side-step-number">3</div>

                <div>
                    <div class="side-step-title">
                        Family details
                    </div>

                    <div class="side-step-text">
                        Parent / guardian
                    </div>
                </div>

            </div>


            <div class="side-step" data-side-step="4">

                <div class="side-step-number">4</div>

                <div>
                    <div class="side-step-title">
                        School details
                    </div>

                    <div class="side-step-text">
                        School &amp; principal
                    </div>
                </div>

            </div>


            <div class="side-step" data-side-step="5">

                <div class="side-step-number">5</div>

                <div>
                    <div class="side-step-title">
                        Region
                    </div>

                    <div class="side-step-text">
                        Country, state &amp; district
                    </div>
                </div>

            </div>

        </div>


        <div class="side-footer">
        </div>

    </div>

</div>    <?php echo form_close(); ?>
</div>
<script>
// document.addEventListener('DOMContentLoaded', function () {

//     let currentStep = 1;
//     const totalSteps = 5;

//     const steps = document.querySelectorAll('.form-step');
//     const progressBars = document.querySelectorAll('.form-progress span');
//     const sideSteps = document.querySelectorAll('.side-step');

//     const nextBtn = document.getElementById('nextBtn');
//     const backBtn = document.getElementById('backBtn');
//     const registerBtn = document.getElementById('registerBtn');
//     const stepLabel = document.getElementById('stepLabel');


//     function showStep(step) {

//         currentStep = step;


//         /* -----------------------------
//           LEFT FORM
//           ----------------------------- */

//         steps.forEach(function (item) {

//             const itemStep = parseInt(
//                 item.getAttribute('data-step')
//             );

//             item.classList.toggle(
//                 'active-step',
//                 itemStep === step
//             );

//         });


//         /* -----------------------------
//           TOP PROGRESS
//           ----------------------------- */

//         progressBars.forEach(function (bar, index) {

//             const barStep = index + 1;

//             bar.classList.remove(
//                 'active',
//                 'completed'
//             );

//             if (barStep <= step) {

//                 bar.classList.add(
//                     barStep === step
//                         ? 'active'
//                         : 'completed'
//                 );

//             }

//         });


//         /* -----------------------------
//           STEP LABEL
//           ----------------------------- */

//         stepLabel.textContent =
//             'STEP ' + step + ' OF ' + totalSteps;


//         /* -----------------------------
//           RIGHT SIDE STEPS
//           ----------------------------- */

//         sideSteps.forEach(function (item) {

//             const sideStep = parseInt(
//                 item.getAttribute('data-side-step')
//             );

//             item.classList.remove(
//                 'active',
//                 'completed'
//             );

//             if (sideStep === step) {

//                 item.classList.add('active');

//             } else if (sideStep < step) {

//                 item.classList.add('completed');

//             }

//         });


//         /* -----------------------------
//           BACK BUTTON
//           ----------------------------- */

//         if (step === 1) {

//             backBtn.style.display = 'none';

//         } else {

//             backBtn.style.display = 'inline-flex';

//         }


//         /* -----------------------------
//           NEXT / REGISTER
//           ----------------------------- */

//         if (step === totalSteps) {

//             nextBtn.style.display = 'none';
//             registerBtn.style.display = 'inline-flex';

//         } else {

//             nextBtn.style.display = 'inline-flex';
//             registerBtn.style.display = 'none';

//         }

//     }


//     /* ==========================================
//       NEXT
//       ========================================== */

//     nextBtn.addEventListener('click', function () {

//         if (currentStep < totalSteps) {

//             showStep(currentStep + 1);

//         }

//     });


//     /* ==========================================
//       BACK
//       ========================================== */

//     backBtn.addEventListener('click', function () {

//         if (currentStep > 1) {

//             showStep(currentStep - 1);

//         }

//     });


//     /* Initial step */

//     showStep(1);

// });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('regForm');
    form.setAttribute('novalidate', 'novalidate'); // we show our own messages

    let currentStep = 1;
    const totalSteps = 5;

    const steps = document.querySelectorAll('.form-step');
    const progressBars = document.querySelectorAll('.form-progress span');
    const sideSteps = document.querySelectorAll('.side-step');

    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');
    const registerBtn = document.getElementById('registerBtn');
    const stepLabel = document.getElementById('stepLabel');

    /* ==========================================
       VALIDATION RULES  (edit these to taste)
       required: true  -> must be filled
       type: email | phone | pin -> format checked whenever filled
       ========================================== */
    const RULES = {
    1: [
        { sel: '#classSelect',           label: 'Class',             required: true },
        { sel: '#scheduleSelect',        label: 'Program name',      required: true },
        { sel: '#registrationCodeInput', label: 'Registration code', required: true,
          msg: 'Registration code is missing. Please re-select the program.' }
    ],
    2: [
        { sel: '[name="student_name"]',  label: 'Student name',  required: true },
        { sel: '[name="gender"]',        label: 'Gender',        required: true },
        { sel: '[name="stud_email"]',    label: 'Student email', required: true, type: 'email' },
        { sel: '[name="stud_phone"]',    label: 'Student phone', required: true, type: 'phone' },
        { sel: '[name="address1"]',      label: 'Address',       required: true }
    ],
    3: [
       
    ],
    4: [
       
    ],
    5: [
       
    ]
};

    const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    // Indian mobile: 10 digits starting 6-9, optional +91 / 91 / 0 prefix
    const PHONE_RE = /^(?:\+?91|0)?[6-9]\d{9}$/;
    const PIN_RE   = /^\d{6}$/;

    function setError(el, msg) {
        const field = el.closest('.field');
        if (field) {
            field.querySelectorAll('.field-error').forEach(function (n) { n.remove(); });
        }
        el.classList.toggle('is-invalid', !!msg);
        if (msg && field) {
            const d = document.createElement('div');
            d.className = 'field-error js-error';
            d.textContent = msg;
            field.appendChild(d);
        }
    }

    function checkRule(rule) {
        const el = rule.el;
        const value = (el.value || '').trim();
        let msg = '';

        if (rule.required && !value) {
            msg = rule.msg || ((el.tagName === 'SELECT' ? 'Please select ' : 'Please enter ') + rule.label.toLowerCase() + '.');
        } else if (value) {
            if (rule.type === 'email' && !EMAIL_RE.test(value)) {
                msg = 'Enter a valid email address (e.g. name@example.com).';
            } else if (rule.type === 'phone' && !PHONE_RE.test(value.replace(/[\s\-()]/g, ''))) {
                msg = 'Enter a valid 10-digit mobile number.';
            } else if (rule.type === 'pin' && !PIN_RE.test(value)) {
                msg = 'Enter a valid 6-digit pin code.';
            }
        }

        setError(el, msg);
        return !msg;
    }

    // Returns the first invalid element of a step (or null if all OK)
    function validateStep(step) {
        let first = null;
        (RULES[step] || []).forEach(function (rule) {
            if (!rule.el) return;
            if (!checkRule(rule) && !first) first = rule.el;
        });
        return first;
    }

    // Wire up rules: find elements, add * to required labels, live feedback
    Object.keys(RULES).forEach(function (step) {
        RULES[step].forEach(function (rule) {
            const el = form.querySelector(rule.sel);
            if (!el) return;
            rule.el = el;

            if (rule.required) {
                const label = el.closest('.field') && el.closest('.field').querySelector('label');
                if (label && label.textContent.indexOf('*') === -1) {
                    label.insertAdjacentHTML('beforeend', ' <span style="color:red;">*</span>');
                }
            }

            ['input', 'change'].forEach(function (evt) {
                el.addEventListener(evt, function () { setError(el, ''); });
            });

            if (rule.type) {
                el.addEventListener('blur', function () {
                    if (el.value.trim()) checkRule(rule);
                });
            }
        });
    });

    /* ==========================================
       SHOW STEP
       ========================================== */
    function showStep(step) {
        currentStep = step;

        steps.forEach(function (item) {
            item.classList.toggle('active-step', parseInt(item.getAttribute('data-step')) === step);
        });

        progressBars.forEach(function (bar, index) {
            const barStep = index + 1;
            bar.classList.remove('active', 'completed');
            if (barStep <= step) {
                bar.classList.add(barStep === step ? 'active' : 'completed');
            }
        });

        stepLabel.textContent = 'STEP ' + step + ' OF ' + totalSteps;

        sideSteps.forEach(function (item) {
            const sideStep = parseInt(item.getAttribute('data-side-step'));
            item.classList.remove('active', 'completed');
            if (sideStep === step) item.classList.add('active');
            else if (sideStep < step) item.classList.add('completed');
        });

        backBtn.style.display = (step === 1) ? 'none' : 'inline-flex';

        if (step === totalSteps) {
            nextBtn.style.display = 'none';
            registerBtn.style.display = 'inline-flex';
        } else {
            nextBtn.style.display = 'inline-flex';
            registerBtn.style.display = 'none';
        }
    }

    /* NEXT — blocked until this step is valid */
    nextBtn.addEventListener('click', function () {
        const bad = validateStep(currentStep);
        if (bad) { bad.focus(); return; }
        if (currentStep < totalSteps) showStep(currentStep + 1);
    });

    /* BACK — never blocked */
    backBtn.addEventListener('click', function () {
        if (currentStep > 1) showStep(currentStep - 1);
    });

    /* SUBMIT — re-check every step, jump to the first broken one */
    form.addEventListener('submit', function (e) {
        for (let s = 1; s <= totalSteps; s++) {
            const bad = validateStep(s);
            if (bad) {
                e.preventDefault();
                showStep(s);
                bad.focus();
                return;
            }
        }
    });

    /* ENTER key: don't submit early, behave like Continue */
    form.addEventListener('keydown', function (e) {
        if (e.key !== 'Enter') return;
        const t = e.target;
        if (t.tagName !== 'INPUT' || t.type === 'checkbox') return;
        e.preventDefault();
        if (t.id === 'schoolSearchInput') {
            document.getElementById('schoolSearchBtn').click();
        } else if (currentStep < totalSteps) {
            nextBtn.click();
        } else {
            registerBtn.click();
        }
    });

    showStep(1);
});
</script>
<script>
    var ajaxSchedulesUrl  = "<?php echo site_url('student_registration/ajax_schedules'); ?>";
    var ajaxFranchisesUrl = "<?php echo site_url('student_registration/ajax_franchises'); ?>";
    var ajaxFranchiseByIdUrl = "<?php echo site_url('student_registration/ajax_franchise_by_id'); ?>";
    var schedulesData = []; // holds the last-loaded series list, including each one's registration_code

    document.getElementById('classSelect').addEventListener('change', function () {
        var cls = this.value;
        var scheduleSelect = document.getElementById('scheduleSelect');
        var regCodeInput = document.getElementById('registrationCodeInput');
        scheduleSelect.innerHTML = '<option value="">Loading...</option>';
        regCodeInput.value = '';
        regCodeInput.placeholder = 'Select test series';
        schedulesData = [];

        if (!cls) {
            scheduleSelect.innerHTML = '<option value="">Select class first</option>';
            return;
        }

        fetch(ajaxSchedulesUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'class=' + encodeURIComponent(cls)
        })
        .then(function (r) { return r.json(); })
        .then(function (schedules) {
            schedulesData = schedules || [];
            scheduleSelect.innerHTML = '';
            if (!schedules.length) {
                scheduleSelect.innerHTML = '<option value="">No open series for this class</option>';
                return;
            }
            scheduleSelect.innerHTML = '<option value="">Select test series</option>';
            schedules.forEach(function (s) {
                var opt = document.createElement('option');
                opt.value = s.lunar_schedule_id;
                opt.textContent = s.subject + ' — ' + s.title;
                scheduleSelect.appendChild(opt);
            });
        })
        .catch(function () {
            scheduleSelect.innerHTML = '<option value="">Could not load series — try again</option>';
        });
    });

    // Registration code AND state/franchise/associate are already included in schedulesData
    // for each series (lunar_schedule_cin.*) — just look them up locally, no extra AJAX needed.
    // Real column names (from DESCRIBE lunar_schedule_cin): state_id, franchise_id, associate_id.
    var pendingFranchiseId = null;

    document.getElementById('scheduleSelect').addEventListener('change', function () {
        var scheduleId = this.value;
        var regCodeInput = document.getElementById('registrationCodeInput');
        var stateSelect = document.getElementById('stateSelect');
        var associateSelect = document.getElementById('associateSelect');
        var franchiseSelect = document.getElementById('franchiseSelect');

        if (!scheduleId) {
            regCodeInput.value = '';
            regCodeInput.placeholder = 'Select test series';
            return;
        }

        var match = schedulesData.find(function (s) {
            return String(s.lunar_schedule_id) === String(scheduleId);
        });

        regCodeInput.value = match && match.registration_code ? match.registration_code : '';
        regCodeInput.placeholder = (match && match.registration_code) ? '' : 'Not available';

        if (!match) return;

        var stateId = match.state_id || null;
        var franchiseId = match.franchise_id || null;
        var associateId = match.associate_id || null;

        // Auto-select Associate (static list, no AJAX dependency)
        if (associateId && associateSelect.querySelector('option[value="' + associateId + '"]')) {
            associateSelect.value = associateId;
        } else if (associateId) {
            console.warn('Associate id "' + associateId + '" has no matching <option> in #associateSelect.');
        }

        // Auto-select State, then let its change event load the matching Franchise list
        if (stateId && stateSelect.querySelector('option[value="' + stateId + '"]')) {
            pendingFranchiseId = franchiseId;
            stateSelect.value = stateId;
            stateSelect.dispatchEvent(new Event('change'));
        } else {
            if (stateId) {
                console.warn('State id "' + stateId + '" has no matching <option> in #stateSelect.');
            }
            pendingFranchiseId = null;
        }
    });

    document.getElementById('stateSelect').addEventListener('change', function () {
        var stateId = this.value;
        var franchiseSelect = document.getElementById('franchiseSelect');
        franchiseSelect.innerHTML = '<option value="">Loading...</option>';

        if (!stateId) {
            franchiseSelect.innerHTML = '<option value="">Select state first</option>';
            pendingFranchiseId = null;
            return;
        }

        fetch(ajaxFranchisesUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'state_id=' + encodeURIComponent(stateId)
        })
        .then(function (r) { return r.json(); })
        .then(function (franchises) {
            console.log('Franchises for state ' + stateId + ':', franchises);
            console.log('Franchise id we are trying to auto-select:', pendingFranchiseId);

            franchiseSelect.innerHTML = '';
            if (!franchises.length) {
                franchiseSelect.innerHTML = '<option value="">No franchises for this state</option>';
            } else {
                franchiseSelect.innerHTML = '<option value="">Select franchise</option>';
                franchises.forEach(function (f) {
                    var fId = (f.franchise_id !== undefined ? f.franchise_id : f.id);
                    var opt = document.createElement('option');
                    opt.value = fId;
                    opt.textContent = f.name || f.username || f.company_name || ('Franchise #' + fId);
                    franchiseSelect.appendChild(opt);
                });
            }

            if (pendingFranchiseId === null || pendingFranchiseId === undefined || pendingFranchiseId === '') {
                return;
            }

            var target = String(pendingFranchiseId).trim();
            var options = Array.prototype.slice.call(franchiseSelect.options);
            var matchOpt = options.find(function (o) { return String(o.value).trim() === target; });
            var wantedId = pendingFranchiseId;
            pendingFranchiseId = null;

            if (matchOpt) {
                franchiseSelect.value = matchOpt.value;
                return;
            }

            // The series' franchise doesn't belong to this state per the franchise table
            // (a data mismatch we confirmed via DB check) — fetch it directly by id and
            // inject it as an extra option so the correct franchise still gets selected.
            console.warn('Franchise id "' + target + '" is not among this state\'s franchises — ' +
                'fetching it directly instead (its own record likely lists a different state).');

            if (!franchiseSelect.querySelector('option[value=""]')) {
                var blank = document.createElement('option');
                blank.value = '';
                blank.textContent = 'Select franchise';
                franchiseSelect.insertBefore(blank, franchiseSelect.firstChild);
            }

            fetch(ajaxFranchiseByIdUrl, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'franchise_id=' + encodeURIComponent(wantedId)
            })
            .then(function (r) { return r.json(); })
            .then(function (f) {
                if (!f || !f.franchise_id) {
                    console.warn('Franchise id "' + wantedId + '" was not found in the franchise table at all.');
                    return;
                }
                var opt = document.createElement('option');
                opt.value = f.franchise_id;
                opt.textContent = f.company_name || ('Franchise #' + f.franchise_id);
                franchiseSelect.appendChild(opt);
                franchiseSelect.value = f.franchise_id;
            })
            .catch(function () {
                console.warn('Could not fetch franchise "' + wantedId + '" directly.');
            });
        })
        .catch(function () {
            franchiseSelect.innerHTML = '<option value="">Could not load franchises — try again</option>';
            pendingFranchiseId = null;
        });
    });
</script>

<script>
/* Global compatibility helper: older school-selection code calls value(). */
window.value = window.value || function (obj, keys) {
    if (!obj || !Array.isArray(keys)) return '';
    for (var i = 0; i < keys.length; i++) {
        var key = keys[i];
        if (Object.prototype.hasOwnProperty.call(obj, key) && obj[key] !== null && obj[key] !== undefined) {
            return String(obj[key]);
        }
    }
    return '';
};

(function () {
    var schools = <?php echo json_encode(!empty($schools) ? $schools : [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?> || [];
    var searchInput = document.getElementById('schoolSearchInput');
    var resultsBox = document.getElementById('schoolSearchResults');
    var manualToggle = document.getElementById('manualEntryToggle');
    var schoolId = document.getElementById('schoolIdInput');
    var searchCountry = document.getElementById('schoolSearchCountry');
    var searchState = document.getElementById('schoolSearchState');
    var searchButton = document.getElementById('schoolSearchBtn');

    var ajaxSearchStatesUrl = "<?php echo site_url('student_registration/ajax_states'); ?>";

    var fields = {
        name: document.getElementById('schoolNameInput'),
        code: document.getElementById('schoolCodeInput'),
        address: document.getElementById('schoolAddressInput'),
        schoolCountry: document.getElementById('schoolCountrySelect'),
        schoolState: document.getElementById('schoolStateSelect'),
        schoolPincode: document.getElementById('schoolPincodeInput'),
        schoolDistrict: document.getElementById('schoolDistrictSelect'),
        schoolCity: document.getElementById('schoolCitySelect'),
        schoolMobile: document.getElementById('schoolMobileInput'),
        principal: document.getElementById('principalNameInput'),
        email: document.getElementById('principalEmailInput'),
        phone: document.getElementById('principalPhoneInput'),
        country: document.getElementById('countrySelect') || document.getElementById('country'),
        state: document.getElementById('stateSelect') || document.getElementById('state'),
        district: document.getElementById('districtSelect') || document.getElementById('district'),
        city: document.getElementById('city'),
        pin: document.getElementById('pin') || document.getElementById('pinCodeInput')
    };

    if (!searchInput || !resultsBox || !manualToggle || !schoolId) return;

    function val(obj, keys) {
        if (!obj || !Array.isArray(keys)) return '';

        for (var i = 0; i < keys.length; i++) {
            var raw = obj[keys[i]];

            // Ignore missing and empty aliases, then try the next possible name.
            if (raw !== undefined && raw !== null && String(raw).trim() !== '') {
                return String(raw).trim();
            }
        }

        return '';
    }

    function esc(value) {
        return String(value || '').replace(/[&<>"']/g, function (c) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
        });
    }

    function setEditable(manual) {
        var codeField    = document.getElementById('schoolCodeField');
    var identityGrid = document.getElementById('schoolIdentityGrid');
    if (codeField)    codeField.style.display = manual ? 'none' : '';
    if (identityGrid) identityGrid.style.gridTemplateColumns = manual ? '1fr' : '';

    Object.keys(fields).forEach(function (key) {
            var input = fields[key];
            if (!input) return;

            // Never disable these fields: disabled inputs/selects are NOT
            // submitted with the form.
            input.disabled = false;

            if (input.tagName === 'SELECT') {
                // Selects have no readOnly attribute — leave them enabled
                // so their value is always posted; locking against
                // accidental edits after a school is chosen is handled
                // by the manual-entry toggle's own disabled state instead.
            } else {
                input.readOnly = !manual;
            }

            if (key === 'code') input.readOnly = !manual;
        });
    }

    function setLocationField(element, wanted) {
        if (!element || !wanted) return;
        wanted = String(wanted);
        if (element.tagName === 'SELECT') {
            var matched = false;
            Array.prototype.forEach.call(element.options, function (option) {
                if (String(option.value) === wanted || String(option.text).trim().toLowerCase() === wanted.trim().toLowerCase()) {
                    option.selected = true;
                    matched = true;
                }
            });
            if (!matched) element.value = wanted;
            // NOTE: intentionally not dispatching a 'change' event here.
            // The country/state/district/city cascade for a selected
            // school is driven explicitly by applySchoolLocationCascade()
            // below, which awaits each AJAX call before selecting the
            // next level. Dispatching 'change' would additionally fire
            // the cascade script's own listeners and race against it,
            // which is what caused the state (and sometimes district)
            // to come back unselected after picking a school.
        } else {
            element.value = wanted;
        }
    }

    // Loads district + city options for a resolved state id and selects
    // the values recorded on the school. Shared by both the
    // country-driven cascade and the no-country fallback below, so
    // district/city aren't silently skipped when a school record has
    // no country_id.
    function applySchoolDistrictCity(stateId, wantedDistrict, wantedCity) {
        if (!stateId || (!wantedDistrict && !wantedCity) || !window.locationCascade) return;

        if (fields.schoolDistrict && wantedDistrict) {
            fields.schoolDistrict.innerHTML = '<option value="">Loading...</option>';
            window.locationCascade.loadDistricts(stateId).then(function (districts) {
                window.locationCascade.populateDistricts(fields.schoolDistrict, districts);
                setLocationField(fields.schoolDistrict, wantedDistrict);
            }).catch(function () {
                fields.schoolDistrict.innerHTML = '<option value="">Could not load districts</option>';
            });
        }

        if (fields.schoolCity && wantedCity) {
            fields.schoolCity.innerHTML = '<option value="">Loading...</option>';
            window.locationCascade.loadAreas(stateId).then(function (areas) {
                window.locationCascade.populateAreas(fields.schoolCity, areas);
                setLocationField(fields.schoolCity, wantedCity);
            }).catch(function () {
                fields.schoolCity.innerHTML = '<option value="">Could not load cities</option>';
            });
        }
    }

    // Loads state -> district/city options for a chosen school and
    // selects the values recorded on the school, waiting for each AJAX
    // call to actually resolve instead of guessing with a timeout.
    function applySchoolLocationCascade(countryId, wantedState, wantedDistrict, wantedCity) {
        if (!fields.schoolState || !wantedState || !window.locationCascade) return;

        fields.schoolState.innerHTML = '<option value="">Loading...</option>';
        if (fields.schoolDistrict) fields.schoolDistrict.innerHTML = '<option value="">Select state first</option>';
        if (fields.schoolCity) fields.schoolCity.innerHTML = '<option value="">Select state first</option>';

        window.locationCascade.loadStates(countryId).then(function (states) {
            window.locationCascade.populateStates(fields.schoolState, states);
            setLocationField(fields.schoolState, wantedState);
            applySchoolDistrictCity(fields.schoolState.value, wantedDistrict, wantedCity);
        }).catch(function () {
            fields.schoolState.innerHTML = '<option value="">Could not load states</option>';
        });
    }

    function selectSchool(school) {
        schoolId.value = val(school, ['school_id', 'id', 'school_new_id']);

        fields.name.value = val(school, ['school_name', 'name', 'school']);
        fields.code.value = val(school, ['school_code', 'code', 'udise_code', 'school_udise_code', 'school_code_no', 'udise']);
        fields.address.value = val(school, ['school_address', 'address', 'full_address', 'school_full_address', 'location', 'school_location']);
        if (fields.schoolPincode) fields.schoolPincode.value = val(school, ['school_pincode', 'pincode', 'pin_code', 'pin', 'postal_code', 'zip_code', 'school_pin', 'school_postal_code']);
        fields.principal.value = val(school, ['principal_name', 'principal', 'principal_full_name', 'school_principal_name', 'head_name', 'headmaster_name', 'principal_fullname', 'principal_person_name', 'contact_person_name', 'principalName', 'school_head_name']);
        fields.email.value = val(school, ['principal_email', 'email', 'principal_mail', 'school_principal_email', 'head_email', 'principal_email_address', 'contact_person_email', 'principalEmail']);
        fields.phone.value = val(school, ['principal_phone', 'principal_mobile', 'principal_mobile_number', 'school_principal_phone', 'head_phone', 'principal_contact', 'principal_contact_number', 'contact_person_phone', 'principalPhone', 'principal_contact_phone']);

        // Country -> State -> (District/City fetched via AJAX by the
        // cascade script) -- selecting country triggers its own
        // 'change' handler, which loads states, and selecting state
        // triggers district/city loads. We set the target ids so that,
        // once each ajax call resolves and rebuilds the <option> list,
        // matching values below are re-applied.
        var wantedCountry  = val(school, ['country_id', 'school_country_id', 'country', 'country_name']);
        var wantedState    = val(school, ['state_id', 'school_state_id', 'state_subdivision_id', 'state', 'state_name']);
        var wantedDistrict = val(school, ['district_id', 'school_district_id', 'district', 'district_name']);
        var wantedCity     = val(school, ['city_id', 'school_city_id', 'city', 'city_name']);

        if (fields.schoolCountry && wantedCountry) {
            setLocationField(fields.schoolCountry, wantedCountry);

            if (fields.schoolState && wantedState) {
                applySchoolLocationCascade(wantedCountry, wantedState, wantedDistrict, wantedCity);
            }
        } else if (fields.schoolState && wantedState) {
            // No country recorded against this school, but the state
            // select already has its options (rendered on page load, or
            // left over from a previous selection) — select the state
            // directly, then still load & select district/city for it.
            setLocationField(fields.schoolState, wantedState);
            applySchoolDistrictCity(fields.schoolState.value, wantedDistrict, wantedCity);
        }

        if (fields.schoolMobile) {
            fields.schoolMobile.value = val(school, ['school_mobile', 'school_phone', 'mobile', 'phone', 'contact_number', 'school_contact_number', 'mobile_number']);
        }

        manualToggle.checked = false;
        setEditable(false);
        searchInput.value = fields.name.value;
        resultsBox.innerHTML = '';
        resultsBox.style.display = 'none';
    }

    function render(list) {
        if (!list.length) {
            resultsBox.innerHTML = '<div class="no-result">No school found. Try manual entry.</div>';
        } else {
            resultsBox.innerHTML = list.slice(0, 30).map(function (school, index) {
                var name = val(school, ['school_name', 'name', 'school']);
                var address = val(school, ['school_address', 'address', 'full_address', 'school_full_address', 'location', 'school_location']);
                var code = val(school, ['school_code', 'code', 'udise_code']);

                return '<div class="school-result" tabindex="0" data-index="' + index + '">' +
                    '<div class="school-result-name">' + esc(name) + '</div>' +
                    '<div class="school-result-address">' + esc(address || code) + '</div>' +
                    '</div>';
            }).join('');

            Array.prototype.forEach.call(resultsBox.querySelectorAll('.school-result'),
                function (item, index) {
                    item.addEventListener('click', function () {
                        selectSchool(list[index]);
                    });
                    item.addEventListener('keydown', function (event) {
                        if (event.key === 'Enter' || event.key === ' ') {
                            event.preventDefault();
                            selectSchool(list[index]);
                        }
                    });
                });
        }
        resultsBox.style.display = 'block';
    }

    // searchInput.addEventListener('input', function () {
    //     var query = this.value.trim().toLowerCase();

    //     // Typing a new search clears the previously selected school id.
    //     schoolId.value = '';

    //     if (!query) {
    //         resultsBox.innerHTML = '';
    //         resultsBox.style.display = 'none';
    //         return;
    //     }

    //     var matches = schools.filter(function (school) {
    //         var text = [
    //             val(school, ['school_name', 'name', 'school']),
    //             val(school, ['school_code', 'code', 'udise_code']),
    //             val(school, ['school_address', 'address', 'full_address', 'school_full_address', 'location', 'school_location'])
    //         ].join(' ').toLowerCase();

    //         return text.indexOf(query) !== -1;
    //     });

    //     render(matches);
    // });
/* ==========================================
   SCHOOL SEARCH BY COUNTRY + STATE + NAME
   ========================================== */

function loadSearchStates(countryId) {

    searchState.innerHTML = '<option value="">Loading...</option>';

    if (!countryId) {
        searchState.innerHTML = '<option value="">Select State</option>';
        return;
    }

    fetch(ajaxSearchStatesUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'country_id=' + encodeURIComponent(countryId)
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (states) {

        searchState.innerHTML =
            '<option value="">Select State</option>';

        if (!states || !states.length) {
            return;
        }

        states.forEach(function (state) {

            var option = document.createElement('option');

            option.value = state.state_subdivision_id;
            option.textContent =
                state.state_subdivision_name;

            searchState.appendChild(option);

        });

    })
    .catch(function () {

        searchState.innerHTML =
            '<option value="">Could not load states</option>';

    });
}


/* Country changed */

searchCountry.addEventListener('change', function () {

    var countryId = this.value;

    searchState.value = '';

    loadSearchStates(countryId);

    resultsBox.innerHTML = '';
    resultsBox.style.display = 'none';

});


/* Search button */

searchButton.addEventListener('click', function () {

    var query = searchInput.value.trim().toLowerCase();
    var countryId = searchCountry.value;
    var stateId = searchState.value;

    /* Country required */

    if (!countryId) {

        resultsBox.innerHTML =
            '<div class="no-result">Please select country.</div>';

        resultsBox.style.display = 'block';

        return;
    }

    /* State required */

    if (!stateId) {

        resultsBox.innerHTML =
            '<div class="no-result">Please select state.</div>';

        resultsBox.style.display = 'block';

        return;
    }

    /* School name required */

    if (!query) {

        resultsBox.innerHTML =
            '<div class="no-result">Please enter school name.</div>';

        resultsBox.style.display = 'block';

        return;
    }


    var matches = schools.filter(function (school) {

        var schoolCountry = val(school, [
            'country_id',
            'school_country_id',
            'country'
        ]);

        var schoolState = val(school, [
            'state_id',
            'school_state_id',
            'state_subdivision_id',
            'state'
        ]);

        var schoolName = val(school, [
            'school_name',
            'name',
            'school'
        ]);

        var schoolCode = val(school, [
            'school_code',
            'code',
            'udise_code'
        ]);

        var schoolAddress = val(school, [
            'school_address',
            'address',
            'full_address',
            'school_full_address',
            'location',
            'school_location'
        ]);


        /*
         * Country + State must match.
         */

        var countryMatch =
            String(schoolCountry) === String(countryId);

        var stateMatch =
            String(schoolState) === String(stateId);


        /*
         * School name / code / address search.
         */

        var text = [
            schoolName,
            schoolCode,
            schoolAddress
        ].join(' ').toLowerCase();

        var nameMatch =
            text.indexOf(query) !== -1;


        return countryMatch &&
               stateMatch &&
               nameMatch;

    });

if (!matches.length) {
        var typedName = searchInput.value.trim();

        // Turn the toggle on and fire its change event so BOTH change
        // handlers run (field unlocking + the location selects handler).
        manualToggle.checked = true;
        manualToggle.dispatchEvent(new Event('change'));

        // The toggle handler clears the search box and results, so restore them.
        searchInput.value = typedName;
        if (fields.name) fields.name.value = typedName;   // pre-fill what they typed

        resultsBox.innerHTML =
            '<div class="no-result">No school found. Manual entry has been turned on. Please fill in the school details below.</div>';
        resultsBox.style.display = 'block';
        return;
    }
    render(matches);

});
    searchInput.addEventListener('focus', function () {
        if (this.value.trim()) this.dispatchEvent(new Event('input'));
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.school-search-wrap')) {
            resultsBox.style.display = 'none';
        }
    });

    manualToggle.addEventListener('change', function () {
        var manual = this.checked;

        if (manual) {
            schoolId.value = '';
            searchInput.value = '';
            resultsBox.innerHTML = '';
            resultsBox.style.display = 'none';
        }

        setEditable(manual);

        if (manual && fields.name) fields.name.focus();
    });

    var resetButton = document.getElementById('resetSchoolFormBtn');
    if (resetButton) {
        resetButton.addEventListener('click', function (event) {
            event.preventDefault();

            schoolId.value = '';
            searchInput.value = '';
            manualToggle.checked = false;

            Object.keys(fields).forEach(function (key) {
                var input = fields[key];
                if (!input) return;

                if (input.tagName === 'SELECT') {
                    input.selectedIndex = 0;
                } else {
                    input.value = '';
                }
                input.disabled = false;
            });

            setEditable(false);
            resultsBox.innerHTML = '';
            resultsBox.style.display = 'none';
        });
    }

    setEditable(false);
})();
</script>

<script>
/* ==========================================
   COUNTRY -> STATE -> DISTRICT / CITY CASCADE
   Used by:
     - Step 4 School Location (schoolCountrySelect etc.), gated by
       the manual-entry toggle
     - Step 5 Region (countrySelect etc.), always live
   ========================================== */
(function () {
    var ajaxStatesUrl    = "<?php echo site_url('student_registration/ajax_states'); ?>";
    var ajaxDistrictsUrl = "<?php echo site_url('student_registration/ajax_districts'); ?>";
    var ajaxAreasUrl     = "<?php echo site_url('student_registration/ajax_areas'); ?>";

    function fetchStates(countryId) {
        return fetch(ajaxStatesUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'country_id=' + encodeURIComponent(countryId)
        }).then(function (r) { return r.json(); });
    }

    function fetchDistricts(stateId) {
        return fetch(ajaxDistrictsUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'state_id=' + encodeURIComponent(stateId)
        }).then(function (r) { return r.json(); });
    }

    function fetchAreas(stateId) {
        return fetch(ajaxAreasUrl, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'state_id=' + encodeURIComponent(stateId)
        }).then(function (r) { return r.json(); });
    }

    function populateStates(stateEl, states) {
        stateEl.innerHTML = '<option value="">Select state</option>';
        states.forEach(function (s) {
            var opt = document.createElement('option');
            opt.value = s.state_subdivision_id;
            opt.textContent = s.state_subdivision_name;
            stateEl.appendChild(opt);
        });
    }

    function populateDistricts(districtEl, districts) {
        districtEl.innerHTML = '<option value="">Select district</option>';
        districts.forEach(function (d) {
            var opt = document.createElement('option');
            opt.value = d.id !== undefined ? d.id : d.district_name;
            opt.textContent = d.district_name;
            districtEl.appendChild(opt);
        });
    }

    function populateAreas(cityEl, areas) {
        cityEl.innerHTML = '<option value="">Select city</option>';
        areas.forEach(function (a) {
            var opt = document.createElement('option');
            opt.value = a.id;
            opt.textContent = a.city_name;
            cityEl.appendChild(opt);
        });
    }

    // Exposed so other scripts (the school-search auto-fill in
    // particular) can load + select cascade values themselves, waiting
    // on the real AJAX response instead of a guessed setTimeout.
    window.locationCascade = {
        loadStates: fetchStates,
        loadDistricts: fetchDistricts,
        loadAreas: fetchAreas,
        populateStates: populateStates,
        populateDistricts: populateDistricts,
        populateAreas: populateAreas
    };

    function wireCascade(countryEl, stateEl, districtEl, cityEl) {
        if (!stateEl) return;

        if (countryEl && countryEl.tagName === 'SELECT') {
            countryEl.addEventListener('change', function () {
                var countryId = this.value;
                stateEl.innerHTML = '<option value="">Loading...</option>';
                if (districtEl) districtEl.innerHTML = '<option value="">Select state first</option>';
                if (cityEl) cityEl.innerHTML = '<option value="">Select state first</option>';

                if (!countryId) {
                    stateEl.innerHTML = '<option value="">Select country first</option>';
                    return;
                }

                fetchStates(countryId)
                    .then(function (states) { populateStates(stateEl, states); })
                    .catch(function () {
                        stateEl.innerHTML = '<option value="">Could not load states</option>';
                    });
            });
        }

        stateEl.addEventListener('change', function () {
            var stateId = this.value;

            if (districtEl) {
                districtEl.innerHTML = '<option value="">Loading...</option>';

                if (!stateId) {
                    districtEl.innerHTML = '<option value="">Select state first</option>';
                } else {
                    fetchDistricts(stateId)
                        .then(function (districts) { populateDistricts(districtEl, districts); })
                        .catch(function () {
                            districtEl.innerHTML = '<option value="">Could not load districts</option>';
                        });
                }
            }

            if (cityEl) {
                cityEl.innerHTML = '<option value="">Loading...</option>';

                if (!stateId) {
                    cityEl.innerHTML = '<option value="">Select state first</option>';
                    return;
                }

                fetchAreas(stateId)
                    .then(function (areas) { populateAreas(cityEl, areas); })
                    .catch(function () {
                        cityEl.innerHTML = '<option value="">Could not load cities</option>';
                    });
            }
        });
    }

    // Step 4 — School Location
    wireCascade(
        document.getElementById('schoolCountrySelect'),
        document.getElementById('schoolStateSelect'),
        document.getElementById('schoolDistrictSelect'),
        document.getElementById('schoolCitySelect')
    );

    // Step 5 — Region
    wireCascade(
        document.getElementById('countrySelect'),
        document.getElementById('stateSelect'),
        document.getElementById('districtSelect'),
        document.getElementById('city')
    );

    // Lock/unlock Step 4's location selects together with the rest of
    // the manual-entry fields.
    var manualToggle = document.getElementById('manualEntryToggle');
    if (manualToggle) {
        manualToggle.addEventListener('change', function () {
            ['schoolCountrySelect', 'schoolStateSelect', 'schoolDistrictSelect', 'schoolCitySelect'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.disabled = !manualToggle.checked;
            });
        });
    }
})();
</script>

</body>
</html>