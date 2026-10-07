<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* =========================================================================
   DATA PREP
   Everything below now comes from the controller (Cin_login::lunarindex())
   via $data — this view no longer queries the database or calls the
   grademarker API itself. The local variable names are kept identical
   to before so the rest of this template (unchanged below) doesn't need
   to be touched.
   ========================================================================= */
// Component category for the filter: Study Material / Test / other
$compCategory = function ($c) {
    $hay = strtolower(($c['component_type'] ?? '') . ' ' . ($c['component_name'] ?? ''));
    if (strpos($hay, 'study') !== false) return 'study';
    if (preg_match('/test|assess|mock|exam/', $hay)) return 'test';
    return 'other';
};
// Check if student data exists
if (empty($student)) {
    redirect('login');
}

// Controller passes a single student row (from newmodel->get_student_data($cin)).
// Normalize to an array whether it comes back as an object or an
// associative array, and fall back across a couple of plausible field
// names in case get_student_data() doesn't use the exact cin_list names.
$stud = is_object($student) ? (array) $student : $student;

$stud_name    = $stud['student_name'] ?? $stud['first_name'] ?? '';
$stud_class   = $stud['class']        ?? '';
$stud_cin     = $stud['cin']          ?? $stud['prid'] ?? $stud['PRID'] ?? '';

// Every "Buy" link on this page routes through
// student_registration/start_from_cin/$cin rather than select_plan
// directly, since the catalog/checkout system is keyed by
// students.PRID — a separate identity system from $cin, bridged via
// cin_list.prid. start_from_cin() auto-creates that bridge on the
// fly for students who don't have one yet, so no cin_list-only
// student is ever stuck with a dead/disabled Buy button.
$cin = $cin ?? $stud_cin;

/* ---- FIX: Syllabus & Test Schedule links — computed HERE, early,
   because the "main-buy-more" bar (which uses both variables)
   renders BEFORE the old "Your Program" hero section further down
   the page. Previously these were only built inside that later
   block, so by the time main-buy-more rendered, $syllabusUrl and
   $testScheduleUrl were still undefined -> both buttons rendered
   with an empty href="". Moving the computation up here fixes that
   for both buttons. Do NOT duplicate this block further down. ---- */
$syllabusUrl = '';
$syllabusPath = trim((string)($student_program['syllabus_path'] ?? ''));
if ($syllabusPath !== '') {
    $syllabusUrl = preg_match('#^https?://#i', $syllabusPath)
        ? $syllabusPath
        : 'https://marrs.in/admin/' . ltrim($syllabusPath, '/');
}
$whatYouGetUrl = '';
$whatYouGetPath = trim((string)($student_program['what_you_get_path'] ?? ''));
if ($whatYouGetPath !== '') {
    $whatYouGetUrl = preg_match('#^https?://#i', $whatYouGetPath)
        ? $whatYouGetPath
        : 'https://marrs.in/admin/' . ltrim($whatYouGetPath, '/');
}
$testScheduleUrl = '';
$testSchedulePath = trim((string)($student_program['test_schedule_path'] ?? ''));
if ($testSchedulePath !== '') {
    $testScheduleUrl = preg_match('#^https?://#i', $testSchedulePath)
        ? $testSchedulePath
        : 'https://marrs.in/admin/' . ltrim($testSchedulePath, '/');
}

$stud_email   = $stud['stud_email']   ?? $stud['email']  ?? '';
$stud_phone   = $stud['stud_phone']   ?? $stud['mobile'] ?? '';
$profile_img  = $stud['profile_img']  ?? '';
$father_name  = $stud['father_name']  ?? '';
$mother_name  = $stud['mother_name']  ?? '';
$address1     = $stud['address1']     ?? '';

$subject  = $stud['subject']  ?? ($product ?? '');
$series   = $stud['series']   ?? '';
$type     = $stud['type']     ?? '';
$state_id = $stud['state_id'] ?? '';

/* ---- School details — supplied directly by the controller now ---- */
$schoolName    = $school_name    ?? '';
$schoolId      = $school_id      ?? '';
$schoolAddress = $school_address ?? '';

/* ---- All active subjects — supplied directly by the controller now ---- */
$activeSubjects = $active_subjects ?? [];

/* =========================================================================
   EXAM / SERIES STATUS
   Also supplied directly by the controller now — $seriesData,
   $registeredSubjects, $totalAttempted, $totalPending, $totalExams,
   $overallPercent, $currentSeriesName, $currentSeries and $nextExam
   arrive pre-computed via $data; no API call happens in this view.
   ========================================================================= */
$seriesData         = $seriesData         ?? [];
$registeredSubjects = $registeredSubjects ?? [];
$totalAttempted     = $totalAttempted     ?? 0;
$totalPending       = $totalPending       ?? 0;
$totalExams         = $totalExams         ?? 0;
$overallPercent     = $overallPercent     ?? 0;
$currentSeriesName  = $currentSeriesName  ?? null;
$currentSeries      = $currentSeries      ?? null;
$nextExam           = $nextExam           ?? null;

/* ---- Support form mail ---- */
$support_success = '';
$support_error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['support_form'])) {

    $support_subject = trim($_POST['support_subject'] ?? '');
    $support_message = trim($_POST['support_message'] ?? '');

    if ($support_subject === '' || $support_message === '') {
        $support_error = 'Please enter both subject and message.';
    } else {

        $support_to = 'support@marrs.in';

        $mail_subject = 'Student Support Request - ' . $support_subject;

        $student_email = filter_var(
            $stud_email,
            FILTER_VALIDATE_EMAIL
        );

        $mail_body = "Student Support Request\n\n"
                   . "Student: " . $stud_name . "\n"
                   . "CIN: " . $stud_cin . "\n"
                   . "Email: " . ($student_email ?: 'Not available') . "\n"
                   . "Phone: " . $stud_phone . "\n\n"
                   . "Subject: " . $support_subject . "\n\n"
                   . "Message:\n" . $support_message;

        $headers = "MIME-Version: 1.0\r\n"
                 . "Content-Type: text/plain; charset=UTF-8\r\n"
                 . "From: Lunar Assessments <support@marrs.in>\r\n";

        if ($student_email) {
            $headers .= "Reply-To: " . $student_email . "\r\n";
        }

        if (@mail(
            $support_to,
            $mail_subject,
            $mail_body,
            $headers
        )) {
            $support_success =
                'Your message has been sent to support. Our team will get back to you.';
        } else {
            $support_error =
                'Unable to send your message right now. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard - Lunar Assessments</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --navy:#1b2a4b;
    --blue:#2f5fe0;
    --blue-dark:#1e4bd1;
    --bg:#f4f6fb;
    --text-dark:#1c2540;
    --text-muted:#8891a5;
    --green:#1fa15a;
    --green-bg:#e6f7ee;
    --orange:#f5a524;
    --orange-bg:#fdf1de;
    --purple:#7c5cff;
    --purple-bg:#efeaff;
    --pink-bg:#fbe9f0;
    --red:#e8425a;
    --border:#eaedf3;
  }
  *{font-family:'Inter',sans-serif;}
  body{background:var(--bg); color:var(--text-dark);}

  /* Sidebar */
  .sidebar{
    width:230px; min-height:100vh; background:#fff; border-right:1px solid var(--border);
    position:fixed; top:0; left:0; padding:24px 16px; display:flex; flex-direction:column;
  }
  .brand{display:flex; align-items:center; gap:10px; padding:0 8px 22px 8px; border-bottom:1px solid var(--border); margin-bottom:16px;}
  .brand-text{line-height:1.1;}
  .brand-text .name{font-weight:800; font-size:15px; letter-spacing:1.5px; color:var(--navy);}
  .brand-text .tag{font-size:9px; letter-spacing:1.5px; color:#071637; font-weight:600;}

  .nav-link-custom{
    display:flex; align-items:center; gap:12px; padding:11px 14px; border-radius:10px;
    color:#5b657a; font-size:16px; font-weight:500; margin-bottom:4px; text-decoration:none;
  }
  .nav-link-custom i{width:18px; text-align:center; font-size:15px;}
  .nav-link-custom:hover{background:#f2f4fa; color:var(--text-dark);}
  .nav-link-custom.active{background:var(--blue); color:#fff; box-shadow:0 6px 14px rgba(47,95,224,.35);}

  .help-card{
    margin-top:auto; background:#f7f8fc; border-radius:14px; padding:18px; text-align:left;
  }
  .help-card .title{font-weight:700; font-size:14px; margin-bottom:2px;}
  .help-card .sub{font-size:12.5px; color:#071637; margin-bottom:12px;}
  .btn-contact{
    background:#fff; border:1px solid #dde2ee; color:var(--blue); font-weight:600; font-size:13px;
    width:100%; padding:8px; border-radius:8px;
  }

  /* Main content */
  .main{margin-left:230px; padding:26px 32px 50px 32px;}

  /* Topbar */
  .topbar{display:flex; align-items:center; justify-content:space-between; margin-bottom:22px;}
  .welcome-block{display:flex; align-items:center; gap:14px;}
  .avatar-circle{width:52px; height:52px; border-radius:50%; background:#eaf0ff; display:flex; align-items:center; justify-content:center; font-size:22px; color:var(--blue); overflow:hidden;}
  .avatar-circle img{width:100%; height:100%; object-fit:cover; border-radius:50%;}
  .welcome-text{font-size:13px; color:#071637; font-weight:500;}
  .welcome-name{font-size:18px; font-weight:800; color:var(--text-dark); display:flex; align-items:center; gap:10px;}
  .class-badge{background:#eaf0ff; color:var(--blue); font-size:12px; font-weight:700; padding:3px 12px; border-radius:20px;}

  .topbar-right{display:flex; align-items:center; gap:30px;}
  .icon-btn{position:relative; font-size:19px; color:#3a4256; cursor:pointer;}
  .icon-btn .badge-dot{
    position:absolute; top:-6px; right:-8px; background:var(--red); color:#fff; font-size:10px;
    width:17px; height:17px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700;
  }
  .topbar-link{display:flex; align-items:center; gap:7px; font-size:14px; font-weight:600; color:var(--text-dark); text-decoration:none;}

  /* Progress bar card */
  .progress-card{background:#fff; border-radius:16px; padding:22px 28px; margin-bottom:22px; border:1px solid var(--border);}
  .progress-title{font-weight:700; font-size:15px; margin-right:26px; white-space:nowrap;}
  .progress-track{display:flex; align-items:center; flex:1; flex-wrap:wrap; row-gap:14px;}
  .step{display:flex; align-items:center; gap:10px; white-space:nowrap;}
  .step-circle{
    width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    font-weight:700; font-size:14px; flex-shrink:0;
  }
  .step-circle.done{background:var(--green); color:#fff;}
  .step-circle.current{border:2px solid var(--blue); color:var(--blue); background:#fff;}
  .step-circle.locked{border:2px solid #e2e5ee; color:#b7bccb; background:#fff;}
  .step-label .t{font-size:13.5px; font-weight:700; color:var(--text-dark); line-height:1.15;}
  .step-label .s{font-size:11.5px; color:#071637; font-weight:500;}
  .step-label .s.in-progress{color:var(--blue); font-weight:600;}
  .dash-line{flex:1; border-top:2px dashed #d8dce6; margin:0 14px; min-width:24px;}

  /* Stat cards */
  .stat-card{
    background:#fff; border:1px solid var(--border); border-radius:16px; padding:18px 20px;
    height:100%; display:flex; flex-direction:column; justify-content:space-between;
  }
  .stat-icon{
    width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; margin-bottom:14px;
  }
  .stat-label{font-size:13px; color:#071637; font-weight:600; margin-bottom:2px;}
  .stat-value{font-size:24px; font-weight:800; color:var(--text-dark);}
  .stat-link{font-size:12.5px; font-weight:700; color:var(--blue); text-decoration:none; display:flex; align-items:center; gap:4px; margin-top:12px; padding-top:12px; border-top:1px solid var(--border);}

  /* Section card */
  .section-card{background:#fff; border:1px solid var(--border); border-radius:16px; padding:22px 24px;}
  .section-header{display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;}
  .section-title{font-weight:700; font-size:16px;}
  .view-all-link{font-size:13px; font-weight:700; color:var(--blue); text-decoration:none;}

  /* Current activity banner */
  .activity-banner{
    background:linear-gradient(90deg,#eef1ff,#f5f0ff); border-radius:14px; padding:16px 20px;
    display:flex; align-items:center; justify-content:space-between; margin-bottom:6px;
  }
  .subj-icon{width:48px; height:48px; border-radius:12px; background:var(--blue); color:#fff; display:flex; align-items:center; justify-content:center; font-size:19px; font-weight:700; flex-shrink:0;}
  .activity-title{font-weight:800; font-size:15px; letter-spacing:.3px;}
  .activity-sub{font-size:12.5px; color:#071637; font-weight:500;}
  .status-pill{
    background:var(--green-bg); color:var(--green); font-size:11.5px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block; margin-top:4px;
  }

  .activity-row{display:flex; align-items:center; justify-content:space-between; padding:14px 0; border-top:1px solid var(--border); gap:10px;}
  .activity-row .row-icon{width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0;}
  .activity-row .row-title{font-weight:700; font-size:14px;}
  .activity-row .row-sub{font-size:12px; color:#071637; font-weight:500;}
  .row-tag{font-size:11px; color:var(--green); font-weight:700;}

  .btn-outline-custom{border:1px solid #cdd4e6; color:var(--text-dark); font-weight:600; font-size:13px; padding:7px 16px; border-radius:8px; background:#fff;}
  .btn-solid-custom{background:var(--blue); color:#fff; font-weight:600; font-size:13px; padding:7px 16px; border-radius:8px; border:none;}
  .btn-disabled-custom{background:#f0f1f5; color:#aab0c1; font-weight:600; font-size:13px; padding:7px 16px; border-radius:8px; border:none;}

  /* Test cards */
  .test-card{border:1px solid var(--border); border-radius:12px; padding:12px 10px; height:100%;}
  .test-card.highlight{border:2px solid var(--blue); background:#f7f9ff;}
  .test-card .test-name{font-weight:800; font-size:13.5px;}
  .test-card .test-sub{font-size:11px; color:#071637; margin-bottom:10px;}
  .test-meta-label{font-size:10.5px; color:#071637; font-weight:600;}
  .test-meta-value{font-size:12px; font-weight:700;}
  .pill-completed{background:var(--green-bg); color:var(--green); font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px;}
  .pill-available{background:#eaf0ff; color:var(--blue); font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px;}
  .pill-locked{background:#f0f1f5; color:#9298a8; font-size:10px; font-weight:700; padding:2px 8px; border-radius:20px;}
  .test-card .btn-outline-custom, .test-card .btn-solid-custom{font-size:11.5px; padding:6px 8px;}
  .test-card form{margin:0;}

  /* Upcoming/Pending Tests slider */
  .tests-slider-wrapper{display:flex; align-items:center; gap:8px;}
  .tests-slider{
    display:flex; gap:12px; overflow-x:auto; scroll-behavior:smooth; scroll-snap-type:x mandatory;
    padding:2px 2px 10px 2px; flex:1; scrollbar-width:thin;
  }
  .tests-slider::-webkit-scrollbar{height:6px;}
  .tests-slider::-webkit-scrollbar-track{background:transparent;}
  .tests-slider::-webkit-scrollbar-thumb{background:#d8dce6; border-radius:10px;}
  .test-slide{flex:0 0 150px; scroll-snap-align:start;}
  .slider-arrow{
    width:32px; height:32px; border-radius:50%; border:1px solid var(--border); background:#fff;
    display:flex; align-items:center; justify-content:center; color:#5b657a; flex-shrink:0; cursor:pointer;
    font-size:12px; transition:all .2s ease;
  }
  .slider-arrow:hover{background:var(--blue); color:#fff; border-color:var(--blue);}
  .slider-arrow:disabled{opacity:.35; cursor:default; background:#fff; color:#5b657a; border-color:var(--border);}
  .slider-dots{display:flex; justify-content:center; gap:6px; margin-top:6px;}
  .slider-dot{width:6px; height:6px; border-radius:50%; background:#dde2ee; border:none; padding:0; cursor:pointer;}
  .slider-dot.active{background:var(--blue); width:16px; border-radius:4px;}

  /* Notifications */
  .notif-row{display:flex; align-items:center; gap:14px; padding:12px 0; border-top:1px solid var(--border);}
  .notif-row:first-child{border-top:none;}
  .notif-icon{width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0;}
  .notif-text{font-size:13.5px; font-weight:600; flex:1;}
  .notif-date{font-size:11.5px; color:#071637; font-weight:500;}
  .dot-red{width:7px; height:7px; border-radius:50%; background:var(--red); display:inline-block; margin-left:8px;}

  /* Subject cards */
  .subject-card{border:1px solid var(--border); border-radius:14px; padding:16px; display:flex; align-items:center; gap:14px; background:#fff;}
  .subject-icon{width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:17px; flex-shrink:0; font-weight:800;}
  .subject-name{font-weight:700; font-size:14px;}
  .subject-type{font-size:12px; color:#071637;}
  .pill-registered{background:var(--green-bg); color:var(--green); font-size:10.5px; font-weight:700; padding:2px 9px; border-radius:20px; margin-left:auto;}
  .pill-not-registered{background:#f0f1f5; color:#8891a5; font-size:10.5px; font-weight:700; padding:2px 9px; border-radius:20px; margin-left:auto;}

  .arrow-circle{width:34px; height:34px; border-radius:50%; border:1px solid var(--border); display:flex; align-items:center; justify-content:center; color:#5b657a; flex-shrink:0; background:#fff;}
  .section-header .section-title small{display:block; font-weight:500; font-size:12px; color:#071637; margin-top:1px;}
  .logo-mark{width:34px; height:34px; position:relative; flex-shrink:0;}

  /* Info rows (profile / guardian / school) reused from previous design */
  .info-row-flex{display:flex; justify-content:space-between; padding:12px 0; border-top:1px solid var(--border);}
  .info-row-flex:first-child{border-top:none;}
  .info-row-flex .lbl{font-weight:600; color:#5b657a; font-size:13.5px; display:flex; align-items:center; gap:8px;}
  .info-row-flex .val{font-weight:600; color:var(--text-dark); font-size:13.5px; text-align:right;}

  /* Slim inline progress bar (used under overall completion stat) */
  .mini-bar{width:100%; height:8px; background:#eef1f8; border-radius:20px; overflow:hidden; margin-top:8px;}
  .mini-bar-fill{height:100%; background:linear-gradient(90deg, var(--blue), var(--purple)); border-radius:20px;}

  /* Success alert (flashdata) */
  .alert-success-custom{
    background:linear-gradient(135deg, #2ECC71, #27AE60); color:#fff; border:none; border-radius:10px;
    padding:14px 20px; margin-bottom:18px;
  }

  @media (max-width: 992px){
    .sidebar{display:none;}
    .main{margin-left:0;}
  }

  /* Test Status tabs (accordion) */
  .custom-accordion-item{border:1px solid var(--border); border-radius:12px; margin-bottom:12px; overflow:hidden;}
  .custom-accordion-btn{
    background:#fff; border:none; width:100%; text-align:left; padding:16px 18px; font-size:14.5px;
    font-weight:700; display:flex; justify-content:space-between; align-items:center; color:var(--text-dark);
  }
  .custom-accordion-btn:hover{background:#f8f9fc;}
  .custom-accordion-btn:not(.collapsed){background:#f7f9ff;}
  .custom-accordion-btn::after{display:none;}
  .plus-icon{font-size:20px; font-weight:700; color:#071637; transition:transform .2s ease;}
  .custom-accordion-btn:not(.collapsed) .plus-icon{transform:rotate(45deg);}
  .accordion-body-inner{padding:18px;}
  .demo-badge{background:#fff3cd; color:#8a6d1a; font-size:10.5px; font-weight:700; padding:2px 9px; border-radius:20px; margin-left:8px;}

  /* Your Program — bought / pending list */
  .program-item-row{display:flex; align-items:center; justify-content:space-between; gap:14px; padding:13px 0; border-bottom:1px solid var(--border);}
  .program-item-row:last-child{border-bottom:none;}
  .pir-name{font-weight:700; font-size:14px; color:var(--text-dark);}
  .pir-meta{font-size:12px; color:#071637; margin-top:1px;}
  .pir-price{font-size:13.5px; font-weight:700; color:var(--text-dark); white-space:nowrap; margin-right:14px;}
  .pir-status{white-space:nowrap;}
  .status-bought{background:var(--green-bg); color:var(--green); font-size:12px; font-weight:700; padding:5px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:5px;}
  .status-buy-btn{background:var(--blue); color:#fff; font-size:12.5px; font-weight:700; padding:7px 16px; border-radius:8px; text-decoration:none; display:inline-block;}
  .status-buy-btn:hover{background:var(--blue-dark); color:#fff;}
  .program-subtabs{display:flex; gap:22px; margin:2px 0 8px; border-bottom:1px solid var(--border);}
  .program-subtab{font-size:13px; font-weight:700; color:#071637; padding:0 0 10px; cursor:default;}
  .program-subtab .cnt{color:var(--blue);}
  .program-item-block{border-bottom:1px solid var(--border);}
  .program-item-block:last-child{border-bottom:none;}
  .program-item-block .program-item-row{border-bottom:none; padding-bottom:8px;}
  .pir-materials{background:#f8fafc; border-radius:10px; padding:8px 12px; margin:0 0 12px;}
  .pir-material-row{display:flex; align-items:center; justify-content:space-between; gap:10px; padding:6px 0; font-size:12.5px;}
  .pir-material-name{color:var(--text-dark); font-weight:600;}
  .pir-material-meta{color:#071637; font-weight:500; margin-left:8px; font-size:11.5px;}
  .pir-download-link{color:var(--blue); font-weight:700; font-size:12px; text-decoration:none; margin-left:12px; white-space:nowrap;}
  .pir-download-link:hover{text-decoration:underline;}

  .demo-table{width:100%; border-collapse:collapse; font-size:13px;}
  .demo-table th, .demo-table td{border:1px solid var(--border); padding:9px 10px; text-align:left;}
  .demo-table th{background:#f7f8fc; font-weight:700; color:#071637; font-size:11px; text-transform:uppercase; letter-spacing:.3px;}
  .badge-not-attempted{background:var(--red); color:#fff; padding:3px 10px; border-radius:12px; font-weight:700; font-size:11px;}
  .badge-completed-sm{background:var(--green); color:#fff; padding:3px 10px; border-radius:12px; font-weight:700; font-size:11px;}

  .demo-material-card{border:1px solid var(--border); border-radius:12px; padding:14px; height:100%; background:#fafbff;}
  .demo-material-card .m-title{font-weight:700; font-size:13.5px; margin-bottom:4px;}
  .demo-material-card .m-sub{font-size:11.5px; color:#071637; margin-bottom:10px;}

  /* Premium program overview + per-plan/component tabs */
  .program-hero{background:linear-gradient(135deg,#f4f7ff 0%,#ffffff 58%,#f7f4ff 100%);border:1px solid #e3e9f7;border-radius:18px;padding:24px;margin-bottom:18px;position:relative;overflow:hidden;}
  .program-hero:after{content:"";position:absolute;width:220px;height:220px;border-radius:50%;background:rgba(47,95,224,.07);right:-90px;top:-100px;}
  .program-kicker{font-size:16px;text-transform:uppercase;letter-spacing:1.4px;font-weight:800;color:var(--blue);margin-bottom:7px;}
  .program-hero-title{font-size:24px;font-weight:800;margin:0 0 8px;color:var(--navy);}
  .program-description{font-size:16px;line-height:1.75;color:#161921;max-width:850px;margin:0;}
  .program-meta-line{display:flex;flex-wrap:wrap;gap:8px;margin-top:15px;}
  .program-meta-chip{background:#fff;border:1px solid #e0e6f2;border-radius:30px;padding:10px;font-size:1rem;font-weight:700;color:#52617c;}
  .program-tabs{display:flex;gap:8px;flex-wrap:wrap;border-bottom:1px solid var(--border);padding-bottom:12px;margin-bottom:16px;}
  .program-tab{border:1px solid #dfe5f1;background:#fff;color:#66728a;border-radius:10px;padding:9px 14px;font-size:12.5px;font-weight:800;cursor:pointer;transition:.2s;}
  .program-tab.active,.program-tab:hover{background:var(--blue);border-color:var(--blue);color:#fff;box-shadow:0 5px 12px rgba(47,95,224,.18);}
  .program-panel{display:none;animation:programFade .2s ease;}
  .program-panel.active{display:block;}
  .program-panel-head{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:12px;}
  .program-panel-title{font-size:16px;font-weight:800;color:var(--navy);}
  .program-panel-sub{font-size:12px;color:#071637;margin-top:3px;}
  .program-detail-card{border:1px solid #e4e9f2;border-radius:14px;background:#fff;padding:18px;}
  .program-detail-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:16px;}
  .program-detail-stat{background:#f8faff;border:1px solid #e8edf7;border-radius:11px;padding:12px;}
  .program-detail-stat .label{font-size:11px;color:#071637;font-weight:700;margin-bottom:4px;}
  .program-detail-stat .value{font-size:15px;color:var(--navy);font-weight:800;}
  .program-item-row.tab-row{padding:14px 0;}
  .program-item-row.tab-row:last-child{border-bottom:0;}
  .program-tab-count{background:rgba(255,255,255,.22);border-radius:20px;padding:2px 7px;margin-left:4px;font-size:10px;}
  @keyframes programFade{from{opacity:.2;transform:translateY(3px)}to{opacity:1;transform:translateY(0)}}
  @media(max-width:767px){.program-hero{padding:18px}.program-hero-title{font-size:20px}.program-detail-grid{grid-template-columns:1fr}.program-tab{flex:1 1 auto;text-align:center}}

  /* ================= ADDED INNER PAGES ================= */
  .page{display:none;animation:pageFade .22s ease;}
  .page.active{display:block;}
  .page-head{margin-bottom:20px;}
  .page-head h1{font-size:24px;font-weight:800;color:var(--navy);margin:0 0 5px;}
  .page-head p{font-size:1rem;color:#071637;margin:0;}
  .grid{display:grid;gap:16px;}
  .grid-2{grid-template-columns:repeat(2,minmax(0,1fr));}
  .grid-3{grid-template-columns:repeat(3,minmax(0,1fr));}
  .grid-4{grid-template-columns:repeat(4,minmax(0,1fr));}
  .page .card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:20px;}
  .page table{width:100%;border-collapse:collapse;font-size:13px;}
  .page th,.page td{padding:13px 12px;border-bottom:1px solid var(--border);text-align:left;vertical-align:middle;}
  .page th{font-size:11px;text-transform:uppercase;letter-spacing:.35px;color:#071637;font-weight:700;background:#f8f9fc;}
  .page tr:last-child td{border-bottom:0;}
  .page .subject-card{height:100%;transition:transform .18s ease,box-shadow .18s ease;}
  .page .subject-card:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(27,42,75,.08);}
  .page .form-row{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-bottom:16px;}
  .page .field{display:flex;flex-direction:column;gap:6px;}
  .page .field label{font-size:12px;color:#5b657a;font-weight:700;}
  .page .field input,.page .field textarea,.page .field select{
    width:100%;border:1px solid #dfe4ef;border-radius:9px;padding:10px 12px;
    font-size:13px;color:var(--text-dark);background:#fff;outline:none;
  }
  .page .field input:focus,.page .field textarea:focus,.page .field select:focus{
    border-color:var(--blue);box-shadow:0 0 0 3px rgba(47,95,224,.10);
  }
  .page .section-sub{font-size:12.5px;color:#071637;margin:-8px 0 16px;}
  .page .status-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:700;}
  .page .status-badge.success{background:var(--green-bg);color:var(--green);}
  .page .status-badge.info{background:#eaf0ff;color:var(--blue);}
  .page .status-badge.warning{background:var(--orange-bg);color:#a66b00;}
  .page .status-badge.locked{background:#f0f1f5;color:#8891a5;}
  .page .empty-state{text-align:center;padding:34px 20px;color:#071637;font-size:1rem;}
  .page .info-row{display:flex;justify-content:space-between;gap:20px;padding:12px 0;border-top:1px solid var(--border);}
  .page .info-row:first-child{border-top:0;}
  .page .info-row .k{font-size:12.5px;color:#071637;font-weight:600;}
  .page .info-row .v{font-size:13px;color:var(--text-dark);font-weight:700;text-align:right;}
  .page .download-card,.page .test-page-card,.page .certificate-card{
    background:#fff;border:1px solid var(--border);border-radius:14px;padding:18px;height:100%;
    transition:transform .18s ease,box-shadow .18s ease;
  }
  .page .download-card:hover,.page .test-page-card:hover,.page .certificate-card:hover{
    transform:translateY(-2px);box-shadow:0 8px 22px rgba(27,42,75,.08);
  }
  .page .page-icon{
    width:42px;height:42px;border-radius:11px;background:#eaf0ff;color:var(--blue);
    display:flex;align-items:center;justify-content:center;font-size:17px;margin-bottom:12px;
  }
  .page .item-title{font-size:14px;font-weight:800;color:var(--navy);margin-bottom:4px;}
  .page .item-sub{font-size:12px;color:#071637;line-height:1.5;}
  .page .btn-page{
    display:inline-flex;align-items:center;gap:6px;background:var(--blue);color:#fff;border:0;
    border-radius:8px;padding:8px 13px;font-size:12px;font-weight:700;text-decoration:none;
  }
  .page .btn-page:hover{background:var(--blue-dark);color:#fff;}
  .page .btn-page-outline{
    display:inline-flex;align-items:center;gap:6px;background:#fff;color:var(--text-dark);
    border:1px solid #cdd4e6;border-radius:8px;padding:8px 13px;font-size:12px;font-weight:700;text-decoration:none;
  }
  .page .score-box{background:#f7f9ff;border:1px solid #e5eafb;border-radius:12px;padding:14px;text-align:center;}
  @keyframes pageFade{from{opacity:.2;transform:translateY(4px)}to{opacity:1;transform:translateY(0)}}
  @media(max-width:992px){.grid-4{grid-template-columns:repeat(2,minmax(0,1fr));}.grid-3{grid-template-columns:repeat(2,minmax(0,1fr));}}
  @media(max-width:767px){
    .grid-2,.grid-3,.grid-4{grid-template-columns:1fr;}
    .page .form-row{grid-template-columns:1fr;}
    .page table{min-width:760px;}
    .page .card{overflow-x:auto;}
    .page .page-head h1{font-size:21px;}
  }

  /* ================= DOWNLOAD LISTS (Downloads / Learning / Tests) ================= */
  .page .dl-list{max-height:340px;overflow-y:auto;}
  .page .dl-row{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:9px 0;border-top:1px solid var(--border);}
  .page .dl-row:first-child{border-top:0;}
  .page .dl-name{font-size:12.5px;font-weight:600;color:var(--text-dark);min-width:0;word-break:break-word;}
  .page .dl-name small{display:block;font-size:11px;color:#071637;font-weight:500;margin-top:1px;}
  .page .dl-row .btn-page{flex-shrink:0;}


/* Program description: clamp to 3 lines + Read more */
.program-description{
  display:-webkit-box;
  -webkit-box-orient:vertical;
  -webkit-line-clamp:3;
  line-clamp:3;
  overflow:hidden;
}
.program-readmore{
  display:none;
  align-items:center;
  gap:5px;
  margin-top:8px;
  padding:0;
  background:none;
  border:0;
  color:var(--blue);
  font-size:14px;
  font-weight:700;
  cursor:pointer;
  position:relative;
  z-index:2;
}
.program-readmore.show{display:inline-flex;}
.program-readmore:hover{text-decoration:underline;}
.program-full-description{white-space:pre-line;font-size:14px;line-height:1.8;color:#4a5570;text-align:justify;}
/* the decorative circle must never block clicks */
.program-hero:after{pointer-events:none;}


/*SUBJECT CSS*/

/* Subjects page: plans & components card grid (4 per row) */
.subj-section-title{font-size:16px;font-weight:800;color:var(--navy);margin:28px 0 12px;display:flex;align-items:center;gap:8px;}
.subj-section-title .cnt{background:#eaf0ff;color:var(--blue);font-size:11px;font-weight:700;padding:2px 9px;border-radius:20px;}
.program-card-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;}
@media(max-width:1199px){.program-card-grid{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:767px){.program-card-grid{grid-template-columns:1fr;}}

.pcard{
  display:flex;flex-direction:column;height:100%;
  background:#fff;border:1px solid #e4e9f2;border-radius:14px;padding:16px;
  transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;
}
.pcard:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(27,42,75,.08);}
.pcard.owned{border-color:#bfe8d1;background:linear-gradient(180deg,#f6fdf9 0%,#fff 60%);}
.pcard-top{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:12px;}
.pcard-icon{width:40px;height:40px;border-radius:11px;background:#eaf0ff;color:var(--blue);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.pcard-icon.component{background:var(--purple-bg);color:var(--purple);}
.pcard-kind{font-size:10.5px;text-transform:uppercase;letter-spacing:1px;font-weight:800;color:#071637;margin-bottom:3px;}
.pcard-name{font-size:14.5px;font-weight:800;color:var(--navy);line-height:1.3;margin-bottom:10px;word-break:break-word;}
.pcard-price{font-size:20px;font-weight:800;color:var(--text-dark);margin-bottom:10px;}
.pcard-meta{border-top:1px solid var(--border);padding-top:8px;margin-bottom:12px;}
.pcard-meta-row{display:flex;justify-content:space-between;gap:10px;padding:4px 0;font-size:12px;}
.pcard-meta-row .k{color:#071637;font-weight:600;}
.pcard-meta-row .v{color:var(--text-dark);font-weight:700;text-align:right;word-break:break-word;}
.pcard-materials{background:#f8fafc;border-radius:10px;padding:6px 10px;margin-bottom:12px;max-height:120px;overflow-y:auto;}
.pcard-materials .pir-material-row{padding:5px 0;font-size:12px;}
.pcard-actions{margin-top:auto;display:flex;flex-wrap:wrap;gap:8px;}
.pcard-actions .btn-solid-custom,
.pcard-actions .btn-outline-custom{flex:1 1 auto;text-align:center;text-decoration:none;font-size:12.5px;padding:8px 10px;}

.program-syllabus-btn{
  background:var(--blue);color:#fff;border:0;border-radius:10px;
  padding:10px;font-size:13px;font-weight:700;text-decoration:none;
  box-shadow:0 6px 14px rgba(47,95,224,.25);transition:background .18s ease,transform .18s ease;
}
.buy-btn{
      background:var(--blue);color:#fff;border:0;border-radius:10px;
  padding:9px 16px;font-size:12px;font-weight:700;text-decoration:none;
  box-shadow:0 6px 14px rgba(47,95,224,.25);transition:background .18s ease,transform .18s ease;

}
.main-buy-more {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: -10px;
    margin-bottom: 10px;
    gap: 13px;
}
.main-buy-more .buy-btn{
            font-size: calc(20px * var(--fs-scale));
        background: var(--red);
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 13px;
}
.main-buy-more .program-syllabus-btn{
        font-size:calc(20px * var(--fs-scale)); background: var(--red); display: flex;
    justify-content: center;         align-items: center;
        gap: 13px;
    }
.program-syllabus-btn:hover{background:var(--blue-dark);color:#fff;transform:translateY(-1px);}

/* Plan and Component Filter */
/* Purchase tab filters */
.filter-bar{display:flex;flex-wrap:wrap;gap:10px 24px;margin:0 0 14px;}
.filter-group{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.filter-label{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:#071637;}
.filter-chip{border:1px solid #dfe5f1;background:#fff;color:#66728a;border-radius:20px;padding:6px 13px;font-size:12px;font-weight:700;cursor:pointer;transition:.18s;}
.filter-chip:hover{border-color:var(--blue);color:var(--blue);}
.filter-chip.active{background:var(--blue);border-color:var(--blue);color:#fff;}
.filter-chip .chip-count{margin-left:5px;font-size:10.5px;opacity:.75;}
.pcard.is-filtered-out{display:none !important;}
.purchase-block.is-hidden{display:none;}
.purchase-block.is-hidden{display:none;}

/* Purchase heading row: title on the left, dropdown on the right */
.page-head-split{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.purchase-view-select{display:flex;align-items:center;gap:10px;}
.purchase-view-select label{
  font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.8px;
  color:#071637;margin:0;
}
.purchase-view-select select{
  min-width:170px;
  border:1px solid #dfe5f1;border-radius:10px;background-color:#fff;
  padding:9px 38px 9px 14px;
  font-size:13px;font-weight:700;color:var(--text-dark);
  cursor:pointer;outline:none;
  appearance:none;-webkit-appearance:none;-moz-appearance:none;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2366728a' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:right 14px center;
  transition:border-color .18s ease,box-shadow .18s ease;
}
.purchase-view-select select:hover{border-color:var(--blue);}
.purchase-view-select select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(47,95,224,.10);}

@media(max-width:575px){
  .page-head-split{flex-direction:column;}
  .purchase-view-select{width:100%;}
  .purchase-view-select select{flex:1;}
}


@media (min-width: 1537px){
  :root{
    --text-muted:#5b657a;
    --fs-scale: clamp(1, calc(0.82 + 0.18 * (100vw / 1537px)), 1.15);
  }
  .brand-text .tag{ font-size:calc(10px * var(--fs-scale)); }
  .nav-link-custom{ font-size:calc(15px * var(--fs-scale)); font-weight:600; }
  .help-card .title{ font-size:calc(14.5px * var(--fs-scale)); }
  .help-card .sub{ font-size:calc(13.5px * var(--fs-scale)); font-weight:500; }
  .btn-contact{ font-size:calc(13.5px * var(--fs-scale)); }
  .welcome-text{ font-size:calc(14px * var(--fs-scale)); font-weight:600; }
  .class-badge{ font-size:calc(13px * var(--fs-scale)); }
  .icon-btn .badge-dot{ font-size:calc(11px * var(--fs-scale)); }
  .topbar-link{ font-size:calc(14.5px * var(--fs-scale)); }
  .step-circle{ font-size:calc(14.5px * var(--fs-scale)); }
  .step-label .t{ font-size:calc(14px * var(--fs-scale)); }
  .step-label .s{ font-size:calc(12.5px * var(--fs-scale)); font-weight:600; }
  .stat-label{ font-size:calc(13.5px * var(--fs-scale)); }
  .stat-link{ font-size:calc(13.5px * var(--fs-scale)); }
  .view-all-link{ font-size:calc(13.5px * var(--fs-scale)); }
  .activity-sub{ font-size:calc(13.5px * var(--fs-scale)); font-weight:600; }
  .status-pill{ font-size:calc(12.5px * var(--fs-scale)); }
  .activity-row .row-title{ font-size:calc(14.5px * var(--fs-scale)); }
  .activity-row .row-sub{ font-size:calc(13px * var(--fs-scale)); font-weight:600; }
  .row-tag{ font-size:calc(12px * var(--fs-scale)); }
  .btn-outline-custom{ font-size:calc(13.5px * var(--fs-scale)); }
  .btn-solid-custom{ font-size:calc(13.5px * var(--fs-scale)); }
  .btn-disabled-custom{ font-size:calc(13.5px * var(--fs-scale)); }
  .test-card .test-name{ font-size:calc(14px * var(--fs-scale)); }
  .test-card .test-sub{ font-size:calc(12px * var(--fs-scale)); font-weight:500; }
  .test-meta-label{ font-size:calc(11.5px * var(--fs-scale)); }
  .test-meta-value{ font-size:calc(13px * var(--fs-scale)); }
  .pill-completed{ font-size:calc(11px * var(--fs-scale)); }
  .pill-available{ font-size:calc(11px * var(--fs-scale)); }
  .pill-locked{ font-size:calc(11px * var(--fs-scale)); }
  .test-card .btn-outline-custom, .test-card .btn-solid-custom{ font-size:calc(12.5px * var(--fs-scale)); }
  .slider-arrow{ font-size:calc(13px * var(--fs-scale)); }
  .notif-text{ font-size:calc(14px * var(--fs-scale)); }
  .notif-date{ font-size:calc(12.5px * var(--fs-scale)); font-weight:600; }
  .subject-name{ font-size:calc(14.5px * var(--fs-scale)); }
  .subject-type{ font-size:calc(13px * var(--fs-scale)); font-weight:500; }
  .pill-registered{ font-size:calc(11.5px * var(--fs-scale)); }
  .pill-not-registered{ font-size:calc(11.5px * var(--fs-scale)); }
  .section-header .section-title small{ font-weight:600; font-size:calc(13px * var(--fs-scale)); }
  .info-row-flex .lbl{ font-size:calc(14px * var(--fs-scale)); }
  .info-row-flex .val{ font-size:calc(14px * var(--fs-scale)); }
  .custom-accordion-btn{ font-size:calc(15px * var(--fs-scale)); }
  .demo-badge{ font-size:calc(11.5px * var(--fs-scale)); }
  .pir-name{ font-size:calc(14.5px * var(--fs-scale)); }
  .pir-meta{ font-size:calc(13px * var(--fs-scale)); font-weight:500; }
  .pir-price{ font-size:calc(14px * var(--fs-scale)); }
  .status-bought{ font-size:calc(13px * var(--fs-scale)); }
  .status-buy-btn{ font-size:calc(13.5px * var(--fs-scale)); }
  .program-subtab{ font-size:calc(13.5px * var(--fs-scale)); }
  .pir-material-row{ font-size:calc(13.5px * var(--fs-scale)); }
  .pir-material-meta{ font-weight:600; font-size:calc(12.5px * var(--fs-scale)); }
  .pir-download-link{ font-size:calc(13px * var(--fs-scale)); }
  .demo-table{ font-size:calc(13.5px * var(--fs-scale)); }
  .demo-table th{ font-size:calc(12px * var(--fs-scale)); }
  .badge-not-attempted{ font-size:calc(12px * var(--fs-scale)); }
  .badge-completed-sm{ font-size:calc(12px * var(--fs-scale)); }
  .demo-material-card .m-title{ font-size:calc(14px * var(--fs-scale)); }
  .demo-material-card .m-sub{ font-size:calc(12.5px * var(--fs-scale)); font-weight:500; }
  .program-kicker{ font-size:calc(16px * var(--fs-scale)); }
  .program-hero-title {
    font-size: 28px;}
  .program-description{ font-size:calc(20px * var(--fs-scale)); color:#4a5570; font-weight:500; }
  .program-meta-chip{ font-size:calc(18px * var(--fs-scale)); }
  .program-tab{ font-size:calc(13.5px * var(--fs-scale)); }
  .program-panel-sub{ font-size:calc(13px * var(--fs-scale)); font-weight:500; }
  .program-detail-stat .label{ font-size:calc(12px * var(--fs-scale)); }
  .program-tab-count{ font-size:calc(11px * var(--fs-scale)); }
  .page-head h1 {
    font-size: 28px;}
  .page-head p{ font-size:calc(20px * var(--fs-scale)); font-weight:500; }
  .page table{ font-size:calc(13.5px * var(--fs-scale)); }
  .page th{ font-size:calc(12px * var(--fs-scale)); }
  .page .field label{ font-size:calc(13px * var(--fs-scale)); }
  .page .field input,.page .field textarea,.page .field select{ font-size:calc(13.5px * var(--fs-scale)); }
  .page .section-sub{ font-size:calc(13.5px * var(--fs-scale)); font-weight:500; }
  .page .status-badge{ font-size:calc(12px * var(--fs-scale)); }
  .page .empty-state{ font-size:calc(18px * var(--fs-scale)); }
  .page .info-row .k{ font-size:calc(13.5px * var(--fs-scale)); }
  .page .info-row .v{ font-size:calc(13.5px * var(--fs-scale)); }
  .page .item-title{ font-size:calc(14.5px * var(--fs-scale)); }
  .page .item-sub{ font-size:calc(13px * var(--fs-scale)); line-height:1.6; font-weight:500; }
  .page .btn-page{ font-size:calc(13px * var(--fs-scale)); }
  .page .btn-page-outline{ font-size:calc(13px * var(--fs-scale)); }
  .page .dl-name{ font-size:calc(13.5px * var(--fs-scale)); }
  .page .dl-name small{ font-size:calc(12px * var(--fs-scale)); font-weight:600; }
  .program-readmore{ font-size:calc(16px * var(--fs-scale)); }
  .program-full-description{ font-size:calc(18px * var(--fs-scale)); color:#3a4358; font-weight:500; }
  .subj-section-title .cnt{ font-size:calc(12px * var(--fs-scale)); }
  .pcard-kind{ font-size:calc(11.5px * var(--fs-scale)); }
  .pcard-name{ font-size:calc(15px * var(--fs-scale)); }
  .pcard-meta-row{ font-size:calc(13px * var(--fs-scale)); }
  .pcard-materials .pir-material-row{ font-size:calc(13px * var(--fs-scale)); }
  .pcard-actions .btn-solid-custom,
.pcard-actions .btn-outline-custom{ font-size:calc(13.5px * var(--fs-scale)); }
  .program-syllabus-btn{ font-size:calc(18px * var(--fs-scale)); }
  .main-buy-more .buy-btn{ font-size:calc(20px * var(--fs-scale)); background: var(--red); display: flex;
    justify-content: center;         align-items: center;
        gap: 13px; }
    .main-buy-more .program-syllabus-btn{
        font-size:calc(20px * var(--fs-scale)); background: var(--red); display: flex;
    justify-content: center;         align-items: center;
        gap: 13px;
    }
  .filter-label{ font-size:calc(12px * var(--fs-scale)); }
  .filter-chip{ font-size:calc(13px * var(--fs-scale)); }
  .filter-chip .chip-count{ font-size:calc(11.5px * var(--fs-scale)); }
  .purchase-view-select label{ font-size:calc(12px * var(--fs-scale)); }
  .purchase-view-select select{ font-size:calc(13.5px * var(--fs-scale)); }}
  .subj-section-title {
    font-size: calc(22px * var(--fs-scale));}
    
    
    .description-popup-body{font-size:15px;font-weight:500;line-height:1.7;color:#1E2246;word-wrap:break-word;}
.description-popup-body h1,.description-popup-body h2,.description-popup-body h3,
.description-popup-body h4,.description-popup-body h5,.description-popup-body h6{
    color:var(--text-dark);font-weight:800;line-height:1.35;margin:20px 0 8px;
}
.description-popup-body h1{font-size:21px;}
.description-popup-body h2{font-size:19px;}
.description-popup-body h3{font-size:17px;}
.description-popup-body h4{font-size:15.5px;}
.description-popup-body h5,.description-popup-body h6{font-size:14.5px;}
.description-popup-body > :first-child{margin-top:0;}
.description-popup-body > :last-child{margin-bottom:0;}
.description-popup-body p{margin:0 0 12px;}
.description-popup-body strong,.description-popup-body b{color:var(--text-dark);font-weight:700;}
.description-popup-body ul,.description-popup-body ol{margin:0 0 14px;padding-left:24px;}
.description-popup-body ul{list-style:disc;}
.description-popup-body ol{list-style:decimal;}
.description-popup-body li{margin-bottom:7px;padding-left:2px;}
.description-popup-body a{color:var(--blue);text-decoration:underline;}
.description-popup-body blockquote{margin:0 0 14px;padding:8px 14px;border-left:3px solid var(--blue);background:var(--blue-soft, #eaf0ff);}
.description-popup-body table{border-collapse:collapse;width:100%;margin-bottom:14px;}
.description-popup-body th,.description-popup-body td{border:1px solid var(--border);padding:7px 10px;text-align:left;}
.description-popup-body th{background:#F8FAFF;color:var(--text-dark);}

/* School searchable picker */
.school-combo{position:relative;}
.school-combo-list{display:none;position:absolute;left:0;right:0;top:calc(100% + 4px);z-index:50;background:#fff;border:1px solid #dfe4ef;border-radius:10px;max-height:260px;overflow-y:auto;box-shadow:0 10px 26px rgba(27,42,75,.12);}
.school-combo-list.open{display:block;}
.school-opt{padding:9px 12px;cursor:pointer;border-bottom:1px solid var(--border);}
.school-opt:last-child{border-bottom:0;}
.school-opt:hover,.school-opt.hl{background:#f2f6ff;}
.school-opt .n{font-size:13px;font-weight:700;color:var(--text-dark);}
.school-opt .a{font-size:11.5px;color:#5b657a;margin-top:1px;}
.school-opt-empty{padding:12px;font-size:12.5px;color:#5b657a;}

/* Add School popup */
#addSchoolModal .modal-content{border-radius:16px;border:0;}
#addSchoolModal .modal-title{font-weight:800;color:var(--navy);font-size:18px;}
#addSchoolModal .ns-sub{font-size:13px;color:#5b657a;margin:-4px 0 14px;}
#addSchoolModal .ns-sec{font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:var(--blue);margin:6px 0 10px;display:flex;align-items:center;gap:8px;}
#addSchoolModal .ns-sec::after{content:'';flex:1;height:1px;background:var(--border);}
#addSchoolModal .form-label{font-size:12px;font-weight:700;color:#5b657a;margin-bottom:4px;text-transform:uppercase;letter-spacing:.02em;}
#addSchoolModal .form-control,#addSchoolModal .form-select{border:1px solid #dfe4ef;border-radius:9px;padding:9px 12px;font-size:13.5px;}
#addSchoolModal .form-control:focus,#addSchoolModal .form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(47,95,224,.10);}
#addSchoolModal .ns-msg{font-size:13px;font-weight:600;min-height:18px;}
#addSchoolModal .ns-msg.err{color:var(--red);} #addSchoolModal .ns-msg.ok{color:var(--green);}
.school-add-link{display:inline-flex;align-items:center;gap:6px;margin-top:8px;font-size:12.5px;font-weight:700;color:var(--blue);text-decoration:none;cursor:pointer;}
.school-add-link:hover{text-decoration:underline;}
.school-opt-empty .school-add-link{margin-top:6px;display:flex;}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="brand">
    <svg class="logo-mark" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
      <path d="M6 20 L16 30 L20 24 L12 16 Z" fill="#1b2a4b"/>
      <path d="M14 22 L24 32 L34 8 L27 8 L23 20 L18 14 Z" fill="#2f5fe0"/>
    </svg>
    <div class="brand-text">
      <div class="name">LUNAR<br>ASSESSMENTS</div>
      <div class="tag">STEP TO SUCCESS</div>
    </div>
  </div>

  <a href="#dashboard" data-page="dashboard" class="nav-link-custom active"><i class="fa-solid fa-house"></i> Dashboard</a>
  <a href="#subjects" data-page="subjects" class="nav-link-custom"><i class="fa-solid fa-book"></i> My Purchases</a>
  <!--<a href="#registrations" data-page="registrations" class="nav-link-custom"><i class="fa-solid fa-clipboard-check"></i> My Registrations</a>-->
  <a href="#learning" data-page="learning" class="nav-link-custom"><i class="fa-solid fa-file-lines"></i> Learning Material</a>
  <a href="#tests" data-page="tests" class="nav-link-custom"><i class="fa-solid fa-pen-to-square"></i> Tests</a>
  <!--<a href="#results" data-page="results" class="nav-link-custom"><i class="fa-solid fa-chart-column"></i> Results</a>-->
  <!--<a href="#downloads" data-page="downloads" class="nav-link-custom"><i class="fa-solid fa-download"></i> Downloads</a>-->
  <!--<a href="#certificates" data-page="certificates" class="nav-link-custom"><i class="fa-solid fa-award"></i> Certificates</a>-->
  <a href="#profile" data-page="profile" class="nav-link-custom"><i class="fa-solid fa-user"></i> Profile</a>
  <!--<a href="#faq" data-page="faq" class="nav-link-custom"><i class="fa-solid fa-question"></i> FAQ</a>-->
  <a href="#support" data-page="support" class="nav-link-custom"><i class="fa-solid fa-headset"></i> Support</a>

  <div class="help-card">
    <div class="title">Need Help?</div>
    <div class="sub">We are here for you</div>
    <button class="btn-contact"><i class="fa-solid fa-headset me-1"></i> Contact Support</button>
  </div>
</div>

<!-- MAIN -->
<div class="main">

  <?php if (!empty($this->session->flashdata('message'))) { ?>
    <div class="alert-success-custom" id="success-alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo $this->session->flashdata('message'); ?>
    </div>
  <?php } ?>

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="welcome-block">
      <div class="avatar-circle">
        <?php if (!empty($profile_img)) { ?>
          <img src="<?php echo base_url() . 'images/student/' . $profile_img; ?>" alt="Profile">
        <?php } else { ?>
          <i class="fa-solid fa-user-graduate"></i>
        <?php } ?>
      </div>
      <div>
        <div class="welcome-text">Welcome,</div>
        <div class="welcome-name">
          <?php echo htmlspecialchars($stud_name); ?>
          <?php if (!empty($stud_class)) { ?><span class="class-badge"><?php echo htmlspecialchars($stud_class); ?></span><?php } ?>
        </div>
      </div>
    </div>
    <div class="topbar-right">
      <div class="icon-btn">
        <i class="fa-solid fa-bell"></i>
        <?php if ($totalPending > 0) { ?><span class="badge-dot"><?php echo $totalPending; ?></span><?php } ?>
      </div>
      <!--<a href="<?php //echo base_url(); ?>Cin_login/edit_cin_login" class="topbar-link"><i class="fa-solid fa-circle-user"></i> Profile</a>-->
      <a href="<?php echo base_url(); ?>Cin_login/logout" class="topbar-link"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </div>
  </div>

  <!-- PROGRESS: one step per registered series -->
  <div class="progress-card d-flex align-items-center">
    <div class="progress-title">Your Progress</div>
    <div class="progress-track">
      <?php if (empty($seriesData)) {
        // Demo data — shown only when no real series data is available
        $demoSteps = [
            ['t' => 'Register',          's' => 'Completed',   'class' => 'done',    'content' => '<i class="fa-solid fa-check"></i>'],
            ['t' => 'Learning Material', 's' => 'Completed',   'class' => 'done',    'content' => '<i class="fa-solid fa-check"></i>'],
            ['t' => 'Test 1',            's' => 'Completed',   'class' => 'done',    'content' => '<i class="fa-solid fa-check"></i>'],
            ['t' => 'Test 2',            's' => 'In Progress', 'class' => 'current', 'content' => '4'],
            ['t' => 'Test 3',            's' => 'Upcoming',    'class' => 'locked',  'content' => '5'],
            ['t' => 'Certificate',       's' => 'Locked',      'class' => 'locked',  'content' => '6'],
        ];
        $dCount = count($demoSteps);
        foreach ($demoSteps as $di => $ds) { ?>
          <div class="step">
            <div class="step-circle <?php echo $ds['class']; ?>"><?php echo $ds['content']; ?></div>
            <div class="step-label">
              <div class="t"><?php echo $ds['t']; ?></div>
              <div class="s <?php echo $ds['class'] === 'current' ? 'in-progress' : ''; ?>"><?php echo $ds['s']; ?></div>
            </div>
          </div>
          <?php if ($di < $dCount - 1) { ?><div class="dash-line"></div><?php } ?>
        <?php } ?>
      <?php } else {
        $i = 0;
        $count = count($seriesData);
        foreach ($seriesData as $sName => $sData) {
            $i++;
            if ($sData['percent'] >= 100) {
                $circleClass = 'done';
                $circleContent = '<i class="fa-solid fa-check"></i>';
                $statusText = 'Completed';
                $statusClass = '';
            } elseif ($sData['percent'] > 0) {
                $circleClass = 'current';
                $circleContent = $i;
                $statusText = 'In Progress';
                $statusClass = 'in-progress';
            } else {
                $circleClass = 'locked';
                $circleContent = $i;
                $statusText = 'Not Started';
                $statusClass = '';
            }
        ?>
        <div class="step">
          <div class="step-circle <?php echo $circleClass; ?>"><?php echo $circleContent; ?></div>
          <div class="step-label">
            <div class="t"><?php echo htmlspecialchars($sName); ?></div>
            <div class="s <?php echo $statusClass; ?>"><?php echo $statusText; ?> (<?php echo $sData['percent']; ?>%)</div>
          </div>
        </div>
        <?php if ($i < $count) { ?><div class="dash-line"></div><?php } ?>
      <?php } } ?>
    </div>
  </div>
<!-- BUY MORE - SHOWN ON EVERY PAGE -->
<div class="main-buy-more">
    <?php if (!empty($student_program) && $syllabusUrl !== ''): ?>
    <a class="program-syllabus-btn" href="<?php echo htmlspecialchars($syllabusUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
      <i class="fa-solid fa-eye"></i> View Syllabus
    </a>
    <?php endif; ?>
<?php if (!empty($student_program) && $whatYouGetUrl !== ''): ?>
<a class="program-syllabus-btn" href="<?php echo htmlspecialchars($whatYouGetUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
  <i class="fa-solid fa-circle-check"></i> What You Get
</a>
<?php endif; ?>
    <?php if (!empty($student_program) && $testScheduleUrl !== ''): ?>
    <a class="program-syllabus-btn" href="<?php echo htmlspecialchars($testScheduleUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
      <i class="fa-solid fa-eye"></i> View Test Schedule
    </a>
    <?php endif; ?>

    <?php if (!empty($student_program)) { ?>
        <a class="buy-btn"
           href="<?php echo site_url('student_registration/start_from_cin/' . $cin . '?program=' . $student_program['id']); ?>">
            <i class="fa-solid fa-cart-shopping"></i>
            Buy more
        </a>
    <?php } ?>
</div>
  <!-- YOUR PROGRAM — premium overview + separate tab for every plan/component -->
  <?php if ($student_program): ?>
  <?php
    // $programDescription = $student_program['description'] ?? $student_program['program_description'] ?? $student_program['short_description'] ?? '';
    // $programDescription = trim(strip_tags((string)$programDescription));
    // if ($programDescription === '') {
    //     $programDescription = 'Explore your enrolled program, review each plan and component, and access available learning resources from one place.';
    // }
    $programDescriptionRaw = $student_program['description'] ?? $student_program['program_description'] ?? $student_program['short_description'] ?? '';
    $programDescriptionRaw = trim((string)$programDescriptionRaw);

    // Plain-text preview only (used for the clamped card text)
    $programDescription = trim(strip_tags($programDescriptionRaw));
    if ($programDescription === '') {
        $programDescription = 'Explore your enrolled program, review each plan and component, and access available learning resources from one place.';
        $programDescriptionRaw = $programDescription;
    }

    // NOTE: $syllabusUrl and $testScheduleUrl are now built once, near
    // the top of this file (right after $cin is set) — NOT here. They
    // are reused below as-is. Do not recompute them in this block.
    $programTabs = [];
    if ($program_catalog && !empty($program_catalog['plans'])) {
        foreach ($program_catalog['plans'] as $pi => $plan) {
            $programTabs[] = ['id'=>'plan-'.$pi, 'label'=>$plan['plan_name'] ?? ('Plan '.($pi+1)), 'type'=>'Plan', 'index'=>$pi];
        }
    }
    if ($program_catalog && !empty($program_catalog['components'])) {
        foreach ($program_catalog['components'] as $ci => $component) {
            $programTabs[] = ['id'=>'component-'.$ci, 'label'=>$component['component_name'] ?? ('Component '.($ci+1)), 'type'=>'Component', 'index'=>$ci];
        }
    }
    // NOTE: $syllabusUrl and $testScheduleUrl are now built once, near
    // the top of this file (right after $cin is set) — NOT here. They
    // are reused below as-is. Do not recompute them in this block.
    $programTabs = [];
    if ($program_catalog && !empty($program_catalog['plans'])) {
        foreach ($program_catalog['plans'] as $pi => $plan) {
            $programTabs[] = ['id'=>'plan-'.$pi, 'label'=>$plan['plan_name'] ?? ('Plan '.($pi+1)), 'type'=>'Plan', 'index'=>$pi];
        }
    }
    if ($program_catalog && !empty($program_catalog['components'])) {
        foreach ($program_catalog['components'] as $ci => $component) {
            $programTabs[] = ['id'=>'component-'.$ci, 'label'=>$component['component_name'] ?? ('Component '.($ci+1)), 'type'=>'Component', 'index'=>$ci];
        }
    }
  ?>
  <div class="section-card mb-4" id="your-program">
    <div class="program-hero">
      <div class="program-kicker"><i class="fa-solid fa-graduation-cap me-1"></i> Your learning journey</div>
      <h2 class="program-hero-title"><?php echo htmlspecialchars($student_program['program_name']); ?></h2>
      <!--<p class="program-description"><?php //echo htmlspecialchars($programDescription); ?></p>-->
   
       <p class="program-description" id="programDescText">
            <?php echo htmlspecialchars($programDescription); ?>
        </p>
<button type="button" class="program-readmore" id="programReadMoreBtn" data-bs-toggle="modal" data-bs-target="#programDescModal">
  Read more <i class="fa-solid fa-arrow-right" style="font-size:11px;"></i>
</button>
      <div class="program-meta-line">
        <?php if (!empty($student_program['subject'])): ?><span class="program-meta-chip"><i class="fa-solid fa-book me-1"></i><?php echo htmlspecialchars($student_program['subject']); ?></span><?php endif; ?>
        <?php if (!empty($student_program['domain'])): ?><span class="program-meta-chip"><i class="fa-solid fa-layer-group me-1"></i><?php echo htmlspecialchars($student_program['domain']); ?></span><?php endif; ?>
        <?php if (!empty($student_program['academic_year'])): ?><span class="program-meta-chip"><i class="fa-solid fa-calendar-days me-1"></i><?php echo htmlspecialchars($student_program['academic_year']); ?></span><?php endif; ?>
        <span class="program-meta-chip"><i class="fa-solid fa-list-check me-1"></i><?php echo count($programTabs); ?> learning items</span>
        <?php if ($syllabusUrl !== ''): ?>
 
  <div class="program-meta-chip" style="border:0;padding:10px 0px;">
    <a class="program-syllabus-btn" href="#subjects">
      <i class="fa-solid fa-book"></i> View Purchase
    </a>
  </div>
 
    
<?php endif; ?>
      </div>
    </div>

    
  </div>
  <?php endif; ?>

  <!-- STUDY MATERIAL + RESULTS + UPCOMING TESTS -->
  <?php
  // Build the list of study material cards to show in the slider.
  // Real data: comes straight from the controller's $study_materials.
  // Each entry is one of two shapes:
  //   - bought = true  → one lm_content row, downloadable/watchable
  //   - bought = false → one summarized card per not-yet-bought
  //     component that has material uploaded for it, with a Buy button
  $studyMaterials = [];
  if (!empty($study_materials)) {
      foreach ($study_materials as $lm) {
          if (!empty($lm['bought'])) {
              $studyMaterials[] = [
                  'bought'     => true,
                  'title'      => !empty($lm['file_title']) ? $lm['file_title'] : (!empty($lm['content_type']) ? $lm['content_type'] : 'Learning Material'),
                  'sub'        => htmlspecialchars($lm['component_name'] ?? '') . ' &middot; Week ' . htmlspecialchars($lm['week_number'] ?? '-')
                                  . ' &middot; Day ' . htmlspecialchars($lm['day_number'] ?? '-'),
                  'meta_label' => 'LM No.',
                  'meta_value' => htmlspecialchars($lm['lm_number'] ?? ''),
                  'file_url'   => !empty($lm['file_path']) ? base_url(ltrim($lm['file_path'], '/')) : null,
                  'video_url'  => !empty($lm['video_url']) ? $lm['video_url'] : null,
              ];
          } else {
              $studyMaterials[] = [
                  'bought'         => false,
                  'title'          => $lm['component_name'],
                  'sub'            => $lm['locked_count'] . ' item' . ($lm['locked_count'] == 1 ? '' : 's') . ' available in this component',
                  'component_id'   => $lm['component_id'],
              ];
          }
      }
  }
  ?>

  <?php
  /* =========================================================================
     DATA for My Registrations / Learning Material / Take Tests / Downloads
     (prints nothing — only prepares variables used by the sections below)
     ========================================================================= */
  $file_base = 'https://marrs.in/admin/';   // files uploaded from the admin app live here

  $esc = function ($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); };
  $fileUrl = function ($path) use ($file_base) {
      $path = trim((string)$path);
      if ($path === '') return '';
      if (preg_match('#^https?://#i', $path)) return $path;
      return rtrim($file_base, '/') . '/' . ltrim($path, '/');
  };

  $catalogPlans      = !empty($program_catalog['plans'])      ? $program_catalog['plans']      : [];
  $catalogComponents = !empty($program_catalog['components']) ? $program_catalog['components'] : [];

  $boughtPlans = [];
  foreach ($catalogPlans as $p) { if (!empty($p['bought'])) $boughtPlans[] = $p; }
  $boughtComponents = [];
  foreach ($catalogComponents as $c) { if (!empty($c['bought'])) $boughtComponents[] = $c; }

  /* ---- Materials of every bought component (de-duplicated) ---- */
  $allMaterials = [];
  $seenFiles    = [];
  $addMaterial = function ($m, $compName) use (&$allMaterials, &$seenFiles, $fileUrl) {
      $path  = trim((string)($m['file_path'] ?? ''));
      $video = trim((string)($m['video_url'] ?? ''));
      $key   = $path !== '' ? $path : $video;
      if ($key === '' || isset($seenFiles[$key])) return;
      $seenFiles[$key] = true;

      $title = '';
      foreach (['file_title', 'original_filename', 'file_name'] as $f) {
          if (!empty($m[$f])) { $title = trim((string)$m[$f]); break; }
      }
      if ($title === '') $title = $path !== '' ? basename($path) : 'Material';

      $allMaterials[] = [
          'component' => !empty($m['component_name']) ? $m['component_name'] : ($compName !== '' ? $compName : 'General'),
          'title'     => $title,
          'type'      => strtolower(trim((string)($m['content_type'] ?? ''))),
          'unit'      => (int)($m['week_number'] ?? 0),
          'file'      => basename($path),
          'url'       => $path !== '' ? $fileUrl($path) : $video,
          'action'    => $path !== '' ? 'Download' : 'Watch',
      ];
  };
  foreach (($study_materials ?? []) as $lm) {
      if (!empty($lm['bought'])) $addMaterial($lm, (string)($lm['component_name'] ?? ''));
  }
  foreach ($boughtComponents as $c) {
      foreach (($c['materials'] ?? []) as $m) $addMaterial($m, (string)($c['component_name'] ?? ''));
  }

  usort($allMaterials, function ($a, $b) {
      $c = strnatcasecmp($a['component'], $b['component']);
      if ($c !== 0) return $c;
      if ($a['unit'] !== $b['unit']) return $a['unit'] - $b['unit'];
      return strnatcasecmp($a['title'], $b['title']);
  });

  /* ---- Sort each file into study / skill test / mock test / answer key ---- */
  $classify = function ($m) {
      $hay = strtolower($m['title'] . ' ' . $m['file']);
      if (strpos($hay, 'solution') !== false || strpos($hay, 'answer') !== false) return 'answer';
      if (in_array($m['type'], ['starter_test', 'skill_test'], true)) return 'skill';
      if ($m['type'] === 'mock_test')  return 'mock';
      if ($m['type'] === 'study_pack') return 'study';
      if (strpos($hay, 'skill') !== false) return 'skill';
      if (strpos($hay, 'mock')  !== false) return 'mock';
      return 'study';
  };
  $matStudy = $matSkill = $matMock = $matAnswer = [];
  $studyByComp = [];
  foreach ($allMaterials as $m) {
      switch ($classify($m)) {
          case 'answer': $matAnswer[] = $m; break;
          case 'skill':  $matSkill[]  = $m; break;
          case 'mock':   $matMock[]   = $m; break;
          default:       $matStudy[]  = $m; $studyByComp[$m['component']][] = $m;
      }
  }

  /* ---- Admit cards, circulars, syllabus ---- */
  $admitCards = $circulars = $syllabi = [];
  $seenCirc = [];
  foreach ($boughtComponents as $c) {
      $cname = (string)($c['component_name'] ?? 'Component');
      if (!empty($c['admit_path'])) {
          $admitCards[] = ['title' => $cname . ' – Admit Card', 'component' => '', 'unit' => 0,
                           'url' => $fileUrl($c['admit_path']), 'action' => 'Download'];
      }
      if (!empty($c['circular_path'])) {
          $cu = $fileUrl($c['circular_path']);
          if (!isset($seenCirc[$cu])) {          // same circular shared by several components → once
              $seenCirc[$cu] = true;
              $circulars[] = ['title' => $cname . ' – Circular', 'component' => '', 'unit' => 0,
                              'url' => $cu, 'action' => 'Download'];
          }
      }
  }
  if (!empty($student_program['syllabus_path'])) {
      $syllabi[] = ['title' => ($student_program['program_name'] ?? 'Program') . ' – Syllabus', 'component' => '', 'unit' => 0,
                    'url' => $fileUrl($student_program['syllabus_path']), 'action' => 'Download'];
  }

  /* ---- Renders a list of download rows ---- */
  $dlRows = function (array $items, $showComponent = true) use ($esc) {
      if (!$items) return '<span class="status-badge locked">Not available</span>';
      $out = '';
      foreach ($items as $it) {
          $meta = !empty($it['unit']) ? 'Unit ' . $it['unit'] : '';
          if ($showComponent && $it['component'] !== '') {
              $meta = trim($it['component'] . ($meta !== '' ? ' · ' . $meta : ''));
          }
          $icon = $it['action'] === 'Watch' ? 'fa-circle-play' : 'fa-download';
          $out .= '<div class="dl-row"><span class="dl-name">' . $esc($it['title'])
                . ($meta !== '' ? '<small>' . $esc($meta) . '</small>' : '') . '</span>'
                . '<a class="btn-page" href="' . $esc($it['url']) . '" target="_blank" rel="noopener">'
                . '<i class="fa-solid ' . $icon . '"></i> ' . $it['action'] . '</a></div>';
      }
      return '<div class="dl-list">' . $out . '</div>';
  };
  ?>


  <!-- ================= PURCHASE ================= -->
<?php
$programId  = $student_program['id'] ?? '';
$buyUrl     = site_url('student_registration/start_from_cin/' . $cin . ($programId !== '' ? '?program=' . $programId : ''));
$progName   = $student_program['program_name'] ?? '';

// Purchased items first, original order kept within each group
$boughtFirst = function (array $items) {
    $bought = $rest = [];
    foreach ($items as $it) {
        if (!empty($it['bought'])) $bought[] = $it; else $rest[] = $it;
    }
    return array_merge($bought, $rest);
};
$plansSorted      = $boughtFirst($catalogPlans);
$componentsSorted = $boughtFirst($catalogComponents);
?>

<section class="page" id="page-subjects">
    <div class="page-head page-head-split" >
    <div>
    <h1>My Purchases</h1>
    <!--<p>Purchase additional plans and components for your Test Program<?php echo !empty($stud_class) ? ' for ' . $esc($stud_class) : ''; ?>.</p>-->
    <p>All of your current purchases are displayed here. We recommend reviewing them before completing any further purchases.</p>
    </div>
    
  </div>
    <div class="purchase-view-select">
      <label for="purchase-view-select">Show</label>
      <select id="purchase-view-select">
        <option value="all">All</option>
        <option value="plans">Plans</option>
        <option value="components">Components</option>
      </select>
    </div>

  <!-- ---------- Subjects ---------- -->
  <?php if (!empty($activeSubjects)) { ?>
    <div class="grid grid-3" id="subjects-grid">
      <?php foreach ($activeSubjects as $subj) {
          if (is_object($subj)) $subj = (array) $subj;
          $subjName = is_array($subj)
              ? ($subj['sub_name'] ?? $subj['subject_name'] ?? $subj['name'] ?? $subj['subject'] ?? 'Subject')
              : $subj;
      ?>
        <div class="subject-card">
          <div class="subject-icon" style="background:#eaf0ff;color:var(--blue);"><i class="fa-solid fa-book-open"></i></div>
          <div>
            <div class="subject-name"><?php echo $esc($subjName); ?></div>
            <div class="subject-type">Test Program<?php echo !empty($stud_class) ? ' · ' . $esc($stud_class) : ''; ?></div>
          </div>
          <span class="pill-registered">Included</span>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>
    <div class="card"><div class="empty-state">No subjects are available yet.</div></div>
  <?php } ?>

    <!-- ---------- Plans ---------- -->
  <div class="purchase-block" data-block="plans">
  <div class="subj-section-title"><i class="fa-solid fa-box-open" style="color:var(--blue);"></i> Plans <span class="cnt" id="plans-grid-count"><?php echo count($boughtPlans); ?></span></div>
  <?php if (!empty($boughtPlans)) { ?>
    <div class="filter-bar" data-filter-scope="plans-grid">
      <div class="filter-group">
        <span class="filter-label">Status</span>
        <button type="button" class="filter-chip active" data-filter-type="status" data-value="all">All</button>
        <!--<button type="button" class="filter-chip" data-filter-type="status" data-value="purchased">Purchased</button>-->
        <!--<button type="button" class="filter-chip" data-filter-type="status" data-value="not-purchased">Not Purchased</button>-->
        <button type="button" class="filter-chip" data-filter-type="status" data-value="study-material">Study Material</button>
        <button type="button" class="filter-chip" data-filter-type="status" data-value="test">Test</button>
        <button type="button" class="filter-chip" data-filter-type="status" data-value="study-material-test">Study material + Test</button>
      </div>
    </div>

<div class="program-card-grid" id="plans-grid">
    <?php foreach ($boughtPlans as $plan) { ?>
      <div class="pcard owned" data-status="purchased">
        <div class="pcard-top">
          <div class="pcard-icon"><i class="fa-solid fa-box-open"></i></div>
          <span class="status-bought" style="font-size:11px;padding:4px 10px;"><i class="fa-solid fa-check"></i> Purchased</span>
        </div>
        <div class="pcard-kind">Plan</div>
        <div class="pcard-name"><?php echo $esc($plan['plan_name'] ?? ''); ?></div>
        <div class="pcard-price">₹<?php echo number_format((float)($plan['final_price'] ?? 0), 2); ?></div>
        <div class="pcard-meta">
          <div class="pcard-meta-row"><span class="k">Duration</span><span class="v"><?php echo $esc($plan['duration'] ?? '—'); ?></span></div>
          <div class="pcard-meta-row"><span class="k">Program</span><span class="v"><?php echo $esc($progName); ?></span></div>
        </div>
        <div class="pcard-actions">
          <button type="button" class="btn-outline-custom" disabled><i class="fa-solid fa-check me-1"></i> You own this plan</button>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="card" id="plans-grid-empty" style="display:none;"><div class="empty-state">No plans match this filter.</div></div>
<?php } else { ?>
  <div class="card"><div class="empty-state">You haven't purchased any plans yet.</div></div>
<?php } ?> 
</div>
  <!-- ---------- Components ---------- -->
  <div class="purchase-block" data-block="components"> 
  <div class="subj-section-title"><i class="fa-solid fa-puzzle-piece" style="color:var(--purple);"></i> Components <span class="cnt" id="components-grid-count"><?php echo count($catalogComponents); ?></span></div>
<?php if (!empty($boughtComponents)) { ?>

    <div class="filter-bar" data-filter-scope="components-grid">
      <div class="filter-group">
        <!--<span class="filter-label">Status</span>-->
        <!--<button type="button" class="filter-chip active" data-filter-type="status" data-value="all">All</button>-->
        <!--<button type="button" class="filter-chip" data-filter-type="status" data-value="purchased">Purchased</button>-->
        <!--<button type="button" class="filter-chip" data-filter-type="status" data-value="not-purchased">Not Purchased</button>-->
      </div>
      <div class="filter-group">
        <span class="filter-label">Type</span>
        <button type="button" class="filter-chip active" data-filter-type="category" data-value="all">All</button>
        <button type="button" class="filter-chip" data-filter-type="category" data-value="study">Study Material</button>
        <button type="button" class="filter-chip" data-filter-type="category" data-value="test">Test</button>
      </div>
    </div>

    <div class="program-card-grid" id="components-grid">
    <?php foreach ($boughtComponents as $component) { ?>
      <div class="pcard owned" data-status="purchased" data-category="<?php echo $compCategory($component); ?>">
        <div class="pcard-top">
          <div class="pcard-icon component"><i class="fa-solid fa-puzzle-piece"></i></div>
          <span class="status-bought" style="font-size:11px;padding:4px 10px;"><i class="fa-solid fa-check"></i> Purchased</span>
        </div>
        <div class="pcard-kind"><?php echo $esc($component['component_type'] ?? 'Component'); ?></div>
        <div class="pcard-name"><?php echo $esc($component['component_name'] ?? ''); ?></div>
        <div class="pcard-price">₹<?php echo number_format((float)($component['unit_price'] ?? 0), 2); ?></div>
       <div class="pcard-meta">
          <div class="pcard-meta-row"><span class="k">Mode</span><span class="v"><?php echo $esc($component['component_mode'] ?? '—'); ?></span></div>
          <?php if (strtolower(trim((string)($component['component_mode'] ?? ''))) === 'offline') { ?>
            <div class="pcard-meta-row"><span class="k">Venue</span><span class="v"><?php echo $esc($component['venue'] ?? '—'); ?></span></div>
          <?php } ?>
        </div>

        <?php if (!empty($component['materials'])) { ?>
          <div class="pcard-materials">
            <?php foreach ($component['materials'] as $mat) { ?>
              <div class="pir-material-row">
                <span class="pir-material-name">
                  <i class="fa-solid fa-file-lines me-1"></i><?php echo $esc(!empty($mat['file_title']) ? $mat['file_title'] : (!empty($mat['content_type']) ? $mat['content_type'] : 'Material')); ?>
                  <?php if (!empty($mat['week_number'])) { ?>
                    <span class="pir-material-meta">Unit <?php echo $esc($mat['week_number']); ?></span>
                  <?php } ?>
                </span>
                <span>
                  <?php if (!empty($mat['file_path'])) { ?><a href="<?php echo $esc($fileUrl($mat['file_path'])); ?>" target="_blank" rel="noopener" class="pir-download-link"><i class="fa-solid fa-download me-1"></i>View</a><?php } ?>
                  <?php if (!empty($mat['video_url'])) { ?><a href="<?php echo $esc($mat['video_url']); ?>" target="_blank" rel="noopener" class="pir-download-link"><i class="fa-solid fa-circle-play me-1"></i>Watch</a><?php } ?>
                </span>
              </div>
            <?php } ?>
          </div>
        <?php } ?>

        <div class="pcard-actions">
          <?php if (!empty($component['admit_path'])) { ?>
            <a href="<?php echo $esc($fileUrl($component['admit_path'])); ?>" target="_blank" rel="noopener" class="btn-solid-custom"><i class="fa-solid fa-file-pdf me-1"></i> Admit Card</a>
          <?php } ?>
          <?php if (!empty($component['circular_path'])) { ?>
            <a href="<?php echo $esc($fileUrl($component['circular_path'])); ?>" target="_blank" rel="noopener" class="btn-outline-custom"><i class="fa-solid fa-file-lines me-1"></i> Circular</a>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="card" id="components-grid-empty" style="display:none;"><div class="empty-state">No components match this filter.</div></div>
<?php } else { ?>
  <div class="card"><div class="empty-state">You haven't purchased any components yet.</div></div>
<?php } ?>
  </div>
</section>

<!-- ================= MY REGISTRATIONS ================= -->
<section class="page" id="page-registrations">
  <div class="page-head"><h1>My Registrations</h1><p>Programs, plans and components you've registered or purchased.</p></div>

  <div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;margin-bottom:12px;">
      <p class="section-title" style="margin:0;">Registered Program</p>
      <?php if (!empty($student_program)) { ?>
        <a class="btn-page" href="<?php echo site_url('student_registration/start_from_cin/' . $cin . '?program=' . $student_program['id']); ?>"><i class="fa-solid fa-cart-shopping"></i> Buy more</a>
      <?php } ?>
    </div>

    <table>
      <thead>
        <tr>
          <th>Program</th>
          <th>Subject</th>
          <th>Domain</th>
          <th>Academic Year</th>
          <th>Purchased</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($student_program)) { ?>
        <tr>
          <td><strong><?php echo $esc($student_program['program_name']); ?></strong></td>
          <td><?php echo $esc(!empty($student_program['subject']) ? $student_program['subject'] : '—'); ?></td>
          <td><?php echo $esc(!empty($student_program['domain']) ? $student_program['domain'] : '—'); ?></td>
          <td><?php echo $esc(!empty($student_program['academic_year']) ? $student_program['academic_year'] : '—'); ?></td>
          <td>
            <span class="status-badge info"><?php echo count($boughtPlans); ?> plan<?php echo count($boughtPlans) === 1 ? '' : 's'; ?></span>
            <span class="status-badge info"><?php echo count($boughtComponents); ?> component<?php echo count($boughtComponents) === 1 ? '' : 's'; ?></span>
          </td>
          <td style="white-space:nowrap;">
            <button type="button" class="btn-page" data-bs-toggle="modal" data-bs-target="#regPlansModal"><i class="fa-solid fa-box-open"></i> View Plans</button>
            <button type="button" class="btn-page-outline" data-bs-toggle="modal" data-bs-target="#regComponentsModal"><i class="fa-solid fa-puzzle-piece"></i> View Components</button>
          </td>
        </tr>
      <?php } else { ?>
        <tr><td colspan="6"><div class="empty-state">No program registered yet.</div></td></tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</section>

  <!-- ================= LEARNING MATERIAL ================= -->
  <section class="page" id="page-learning">
    <div class="page-head"><h1>Learning Material</h1><p>Study material for the components you have purchased.</p></div>

    <?php if (!empty($studyByComp)) { foreach ($studyByComp as $compName => $items) { ?>
      <div class="card" style="margin-bottom:16px;">
        <div class="item-title" style="display:flex;align-items:center;gap:8px;">
          <i class="fa-solid fa-book-open text-primary"></i>
          <?php echo $esc($compName); ?>
          <span class="status-badge info"><?php echo count($items); ?> file<?php echo count($items) === 1 ? '' : 's'; ?></span>
        </div>
        <div style="margin-top:8px;"><?php echo $dlRows($items, false); ?></div>
      </div>
    <?php } } else { ?>
      <div class="card"><div class="empty-state"><i class="fa-solid fa-file-lines" style="font-size:24px;margin-bottom:10px;display:block;color:#b6bfd2;"></i>No learning material is available yet. Purchase a component to unlock its study material.</div></div>
    <?php } ?>
  </section>

  <!-- ================= TAKE TESTS ================= -->
  <section class="page" id="page-tests">
    <div class="page-head"><h1>Take Tests</h1><p>Download your Skill Test papers. Solutions are under Downloads → Answer Key.</p></div>
    <div class="grid grid-2">
      <div class="test-page-card">
        <div class="page-icon"><i class="fa-solid fa-pen-to-square"></i></div>
        <div class="item-title">Skill Tests</div>
        <div class="item-sub">Weekly skill test papers for your purchased components.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($matSkill); ?></div>
      </div>
      <div class="test-page-card">
        <div class="page-icon"><i class="fa-solid fa-vial"></i></div>
        <div class="item-title">Mock Assessments</div>
        <div class="item-sub">Practice and mock test papers.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($matMock); ?></div>
      </div>
    </div>
  </section>

  <!-- ================= RESULTS ================= -->
  <section class="page" id="page-results">
    <div class="page-head"><h1>Results</h1><p>Scores and performance across completed tests.</p></div>
    <div class="grid grid-4" style="margin-bottom:20px;">
      <div class="card" style="text-align:center;">
        <div style="font-size:26px;font-weight:800;color:var(--navy);">0%</div>
        <div style="font-size:12.5px;color:var(--muted);margin-top:4px;">Test 1 score</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:26px;font-weight:800;color:var(--navy);">0 / 0</div>
        <div style="font-size:12.5px;color:var(--muted);margin-top:4px;">Tests completed</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:26px;font-weight:800;color:var(--navy);"></div>
        <div style="font-size:12.5px;color:var(--muted);margin-top:4px;">Class rank</div>
      </div>
      <div class="card" style="text-align:center;">
        <div style="font-size:26px;font-weight:800;color:var(--navy);">0%</div>
        <div style="font-size:12.5px;color:var(--muted);margin-top:4px;">Average score</div>
      </div>
    </div>
    <div class="card">
      <table>
        <thead><tr><th>Test</th><th>Subject</th><th>Date</th><th>Score</th><th>Result</th><th></th></tr></thead>
        <tbody id="results-body"></tbody>
      </table>
    </div>
  </section>

  <!-- ================= DOWNLOADS ================= -->
  <section class="page" id="page-downloads">
    <div class="page-head"><h1>Downloads</h1><p>Admit cards, answer keys, circulars and syllabus ready to download.</p></div>
    <div class="grid grid-2">
      <div class="download-card">
        <div class="page-icon"><i class="fa-solid fa-id-card"></i></div>
        <div class="item-title">Admit Card</div>
        <div class="item-sub">Admit cards for your registered tests.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($admitCards); ?></div>
      </div>
      <div class="download-card">
        <div class="page-icon"><i class="fa-solid fa-key"></i></div>
        <div class="item-title">Answer Key</div>
        <div class="item-sub">Solutions and answer keys for your tests.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($matAnswer); ?></div>
      </div>
      <div class="download-card">
        <div class="page-icon"><i class="fa-solid fa-file"></i></div>
        <div class="item-title">Circular</div>
        <div class="item-sub">Important circulars and official notices.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($circulars); ?></div>
      </div>
      <div class="download-card">
        <div class="page-icon"><i class="fa-solid fa-book-open"></i></div>
        <div class="item-title">Syllabus</div>
        <div class="item-sub">Syllabus for your enrolled program.</div>
        <div style="margin-top:14px;"><?php echo $dlRows($syllabi); ?></div>
      </div>
    </div>
  </section>

  <!-- ================= CERTIFICATES ================= -->
  <section class="page" id="page-certificates">
    <div class="page-head"><h1>Certificates</h1><p>Certificates you've unlocked by completing the Test Program.</p></div>
    <div class="grid grid-2" id="certificates-grid"></div>
  </section>

 <!-- ================= PROFILE ================= -->
<section class="page" id="page-profile">
  <div class="page-head"><h1>Profile</h1><p>Manage student, guardian and school information.</p></div>

  <?php if (!empty($this->session->flashdata('message'))) { ?>
    <div class="alert-success-custom" style="margin-bottom:16px;">
      <i class="fas fa-check-circle me-2"></i><?php echo $esc($this->session->flashdata('message')); ?>
    </div>
  <?php } ?>
  <?php if (!empty($this->session->flashdata('classerror'))) { ?>
    <div class="alert alert-danger" style="margin-bottom:16px;">
      <?php echo $esc($this->session->flashdata('classerror')); ?>
    </div>
  <?php } ?>

  <?php
    $fullName = trim(($stud['first_name'] ?? $stud_name) . ' ' . ($stud['middle_name'] ?? '') . ' ' . ($stud['last_name'] ?? ''));
    $stateName    = $stud['state_name'] ?? $stud['state'] ?? ($school_state ?? '');
    $districtName = $stud['district_name'] ?? $stud['district'] ?? ($school_district ?? '');
  ?>

  <form id="profileForm" method="POST" action="<?php echo base_url(); ?>Cin_login/edit_cin_login_lunar">

    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">Student Information</p>
      <p class="section-sub">Basic details used across your registrations.</p>
      <div class="form-row">
        <div class="field"><label>Full Name</label>
          <input type="text" value="<?php echo $esc($fullName); ?>" readonly></div>
        <div class="field"><label>CIN</label>
          <input type="text" value="<?php echo $esc($stud_cin); ?>" disabled></div>
      </div>
      <div class="form-row">
        <div class="field"><label>Class</label>
          <input type="text" value="<?php echo $esc($stud_class); ?>" readonly></div>
         <div class="field">
          <?php $g = strtoupper(trim($stud['gender'] ?? '')); ?>
            <select name="gender">
              <option value="">Select</option>
              <option value="M" <?php echo ($g === 'M' || $g === 'MALE')   ? 'selected' : ''; ?>>Male</option>
              <option value="F" <?php echo ($g === 'F' || $g === 'FEMALE') ? 'selected' : ''; ?>>Female</option>
            </select>
         
      </div>
      </div>
      <div class="form-row">
        <div class="field"><label>Student Email *</label>
          <input type="email" name="stud_email" value="<?php echo $esc($stud_email); ?>" required></div>
        <div class="field"><label>Mobile Number *</label>
          <input type="text" name="stud_phone" value="<?php echo $esc($stud_phone); ?>"
                 pattern="[6-9][0-9]{9}" maxlength="10" title="10-digit mobile number" required></div>
      </div>
    </div>

    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">Guardian Details</p>
      <p class="section-sub">We'll use these details for important notifications.</p>
      <div class="form-row">
        <div class="field"><label>Father Name *</label>
          <input type="text" name="father_name" value="<?php echo $esc($father_name); ?>" required></div>
        <div class="field"><label>Mother Name *</label>
          <input type="text" name="mother_name" value="<?php echo $esc($mother_name); ?>" required></div>
      </div>
      <div class="form-row">
        <div class="field"><label>Guardian Email</label>
          <input type="email" name="father_email" value="<?php echo $esc($stud['father_email'] ?? ''); ?>"></div>
        <div class="field"></div>
      </div>
    </div>

    <?php
      $schoolsForJs = [];
      foreach (($schools_list ?? []) as $sc) {
          $sc = (array) $sc;
          $schoolsForJs[] = [
              'id'   => $sc['id'],
              'name' => $sc['school_name'] ?? '',
              'addr' => trim(($sc['school_address'] ?? '') . ' ' . ($sc['location'] ?? '') . ' ' . ($sc['city'] ?? '')),
          ];
      }
    ?>
    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">School Details</p>
      <p class="section-sub">Search and select the school you are currently enrolled in.</p>
      <div class="form-row">
        <div class="field"><label>School Name *</label>
          <div class="school-combo" id="schoolCombo">
            <input type="text" id="schoolSearch" autocomplete="off" placeholder="Type to search your school..."
                   value="<?php echo $esc($schoolName); ?>">
            <input type="hidden" name="school_id" id="schoolIdInput" value="<?php echo $esc($schoolId); ?>">
            <div class="school-combo-list" id="schoolList"></div>
          </div>
          <a class="school-add-link" id="schoolAddLink" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
            <i class="fa-solid fa-circle-plus"></i> My school is not listed — add it
          </a>
        </div>
        <div class="field"><label>School Code</label>
          <input type="text" id="schoolCodeView" value="<?php echo $esc($schoolId); ?>" readonly></div>
      </div>
      <div class="form-row">
        <div class="field"><label>State</label>
          <input type="text" value="<?php echo $esc($stateName); ?>" readonly></div>
        <div class="field"><label>District</label>
          <input type="text" value="<?php echo $esc($districtName); ?>" readonly></div>
      </div>
      <div class="form-row">
        <div class="field" style="grid-column:1 / -1;"><label>School Address</label>
          <input type="text" id="schoolAddrView" value="<?php echo $esc($schoolAddress); ?>" readonly></div>
      </div>
    </div>

    <div style="display:flex;gap:12px;">
      <button type="submit" name="submit" value="1" class="btn-solid-custom">Save Changes</button>
      <button type="button" class="btn-outline-custom"
              onclick="document.getElementById('profileForm').reset();">Cancel</button>
    </div>
  </form>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(function () {
        document.querySelectorAll('.alert-success-custom, .alert.alert-danger').forEach(function (el) {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';

            setTimeout(function () {
                el.remove();
            }, 300);
        });
    }, 3000);
});
</script>

</section>

  <!-- ================= FAQ ================= -->
  <section class="page" id="page-faq">
    <div class="page-head"><h1>FAQ</h1><p>Answers to common questions about registrations, tests and certificates.</p></div>
    <div class="card" id="faq-list"></div>
  </section>

  <!-- ================= SUPPORT ================= -->
  <section class="page" id="page-support">
    <div class="page-head"><h1>Support</h1><p>Reach out to us — we usually respond within a day.</p></div>
    <div class="grid grid-2">
     <div class="card">
        <p class="section-title">Contact Support</p>
        <p class="section-sub">Fill this in and our team will get back to you.</p>
        <?php if ($support_success): ?>
          <div class="alert-success-custom mb-3"><i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($support_success); ?></div>
        <?php elseif ($support_error): ?>
          <div class="alert alert-danger mb-3"><?php echo htmlspecialchars($support_error); ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars(current_url()); ?>#support">
          <input type="hidden" name="support_form" value="1">
          <div class="field" style="margin-bottom:14px;"><label>Subject</label><input type="text" name="support_subject" placeholder="What do you need help with?" required></div>
          <div class="field" style="margin-bottom:14px;"><label>Message</label><textarea name="support_message" rows="4" placeholder="Describe your issue" required></textarea></div>
          <button type="submit" class="btn-solid-custom"><i class="fa-solid fa-paper-plane me-1"></i> Send Message</button>
        </form>
      </div>
      <div class="card my-2">
        <p class="section-title">Other ways to reach us</p>
        <div class="info-row"><span class="k">Helpline</span><span class="v"></span></div>
        <div class="info-row"><span class="k">Email</span><span class="v">support@marrs.in</span></div>
        <div class="info-row"><span class="k">Hours</span><span class="v">Mon–Sat, 9 AM – 7 PM</span></div>
      </div>
    </div>
  </section>

</div>

<!-- Add School Modal (full details, same fields as Open School form) -->
<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSchoolModalLabel">Add your school</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="ns-sub">Can't find your school in the list? Add it here and it will be selected for you.</p>

        <div class="ns-sec">School identity</div>
        <div class="row g-3 mb-2">
          <div class="col-md-8">
            <label class="form-label" for="ns_school_name">School name *</label>
            <input type="text" class="form-control" id="ns_school_name" maxlength="150">
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_syllabus">Syllabus *</label>
            <select class="form-select" id="ns_syllabus">
              <option value="">Select</option>
              <option>CBSE</option><option>ICSE</option><option>State Board</option>
              <option>IB</option><option>IGCSE</option><option>Other</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="ns_address">Address *</label>
            <input type="text" class="form-control" id="ns_address" maxlength="255">
          </div>
        </div>

        <div class="ns-sec">Location</div>
        <div class="row g-3 mb-2">
          <div class="col-md-4">
            <label class="form-label" for="ns_country">Country *</label>
            <select class="form-select" id="ns_country">
              <?php if (!empty($countries)) { foreach ($countries as $c) { $c = (array) $c; ?>
                <option value="<?php echo (int) $c['country_id']; ?>" <?php echo ((int) $c['country_id'] === 105) ? 'selected' : ''; ?>><?php echo $esc($c['country_name']); ?></option>
              <?php } } else { ?>
                <option value="105" selected>India</option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_state">State *</label>
            <select class="form-select" id="ns_state"><option value="">Select state</option></select>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_city">District *</label>
            <select class="form-select" id="ns_city" disabled><option value="">Select state first</option></select>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_area">Area *</label>
            <select class="form-select" id="ns_area" disabled><option value="">Select district first</option></select>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_pin">Pin code</label>
            <input type="text" class="form-control" id="ns_pin" maxlength="10">
          </div>
          <div class="col-md-4">
            <label class="form-label" for="ns_mobile">School mobile *</label>
            <input type="text" class="form-control" id="ns_mobile" maxlength="15">
          </div>
        </div>

        <div class="ns-sec">Administration</div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label" for="ns_principal">Principal name *</label>
            <input type="text" class="form-control" id="ns_principal" maxlength="100">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="ns_principal_email">Principal email</label>
            <input type="email" class="form-control" id="ns_principal_email" maxlength="100">
          </div>
        </div>

        <div class="ns-msg mt-3" id="ns_msg"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary btn-sm" id="ns_submit">Add &amp; select school</button>
      </div>
    </div>
  </div>
</div>
<?php if (!empty($student_program)): ?>
<!-- Program Description Modal -->
<div class="modal fade" id="programDescModal" tabindex="-1" aria-labelledby="programDescModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <h3 class="modal-title fs-5 fw-bold" id="programDescModalLabel">Description</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body description-popup-body" id="programFullDescription"></div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php if (!empty($student_program)): ?>
<!-- Registered Plans Modal -->
<div class="modal fade" id="regPlansModal" tabindex="-1" aria-labelledby="regPlansModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <h5 class="modal-title" id="regPlansModalLabel" style="font-weight:800;color:var(--navy);">
          Plans &middot; <?php echo $esc($student_program['program_name']); ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (!empty($boughtPlans)) { ?>
          <div class="table-responsive">
            <table class="table table-sm align-middle mb-0" style="font-size:13px;">
              <thead><tr><th>Plan</th><th>Duration</th><th>Amount</th><th>Status</th></tr></thead>
              <tbody>
              <?php foreach ($boughtPlans as $pl) { ?>
                <tr>
                  <td><?php echo $esc($pl['plan_name'] ?? ''); ?></td>
                  <td><?php echo $esc($pl['duration'] ?? '—'); ?></td>
                  <td>₹<?php echo number_format((float)($pl['final_price'] ?? 0), 2); ?></td>
                  <td><span class="status-bought" style="font-size:11px;padding:4px 10px;"><i class="fa-solid fa-check"></i> Purchased</span></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <div class="text-center text-muted py-4" style="font-size:13px;">No plans purchased yet.</div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary btn-sm" href="<?php echo site_url('student_registration/start_from_cin/' . $cin . '?program=' . $student_program['id']); ?>"><i class="fa-solid fa-cart-shopping me-1"></i> Buy more</a>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Registered Components Modal -->
<div class="modal fade" id="regComponentsModal" tabindex="-1" aria-labelledby="regComponentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <h5 class="modal-title" id="regComponentsModalLabel" style="font-weight:800;color:var(--navy);">
          Components &middot; <?php echo $esc($student_program['program_name']); ?>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (!empty($boughtComponents)) { ?>
          <div class="table-responsive">
            <table class="table table-sm align-middle mb-0" style="font-size:13px;">
              <thead><tr><th>Component</th><th>Type</th><th>Mode</th><th>Amount</th><th>Status</th></tr></thead>
              <tbody>
              <?php foreach ($boughtComponents as $cp) { ?>
                <tr>
                  <td><?php echo $esc($cp['component_name'] ?? ''); ?></td>
                  <td><?php echo $esc($cp['component_type'] ?? '—'); ?></td>
                  <td><?php echo $esc($cp['component_mode'] ?? '—'); ?></td>
                  <td>₹<?php echo number_format((float)($cp['unit_price'] ?? 0), 2); ?></td>
                  <td><span class="status-bought" style="font-size:11px;padding:4px 10px;"><i class="fa-solid fa-check"></i> Purchased</span></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <div class="text-center text-muted py-4" style="font-size:13px;">No components purchased yet.</div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary btn-sm" href="<?php echo site_url('student_registration/start_from_cin/' . $cin . '?program=' . $student_program['id']); ?>"><i class="fa-solid fa-cart-shopping me-1"></i> Buy more</a>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    setTimeout(function () { $("#success-alert").fadeOut(500); }, 3000);
});

/* =========================================================================
   HORIZONTAL CARD SLIDERS (Upcoming/Pending Tests, Study Material, ...)
   Generic controller — pass the slider element id + its slide selector.
   Exposes a single global scrollSlider(sliderId, direction) used by every
   pair of arrow buttons' inline onclick handlers.
   ========================================================================= */
var __sliderControllers = {};

function initCardSlider(sliderId, prevBtnId, nextBtnId, dotsId) {
    var slider = document.getElementById(sliderId);
    if (!slider) return;

    var prevBtn  = prevBtnId ? document.getElementById(prevBtnId) : null;
    var nextBtn  = nextBtnId ? document.getElementById(nextBtnId) : null;
    var dotsWrap = dotsId ? document.getElementById(dotsId) : null;

    var slides = Array.prototype.slice.call(slider.querySelectorAll('.test-slide'));

    // Build dots (one per slide)
    if (dotsWrap && slides.length > 1) {
        slides.forEach(function (_, idx) {
            var dot = document.createElement('button');
            dot.type = 'button';
            dot.className = 'slider-dot' + (idx === 0 ? ' active' : '');
            dot.setAttribute('aria-label', 'Go to item ' + (idx + 1));
            dot.addEventListener('click', function () {
                slides[idx].scrollIntoView({ behavior: 'smooth', inline: 'start', block: 'nearest' });
            });
            dotsWrap.appendChild(dot);
        });
    }
    var dots = dotsWrap ? Array.prototype.slice.call(dotsWrap.children) : [];

    function slideStep() {
        if (!slides.length) return 170;
        var rect = slides[0].getBoundingClientRect();
        var style = window.getComputedStyle(slider);
        var gap = parseFloat(style.columnGap || style.gap || 12);
        return rect.width + gap;
    }

    function updateArrows() {
        var maxScroll = slider.scrollWidth - slider.clientWidth - 1;
        if (prevBtn) prevBtn.disabled = slider.scrollLeft <= 0;
        if (nextBtn) nextBtn.disabled = slider.scrollLeft >= maxScroll;
    }

    function updateDots() {
        if (!dots.length) return;
        var step = slideStep();
        var activeIndex = Math.round(slider.scrollLeft / step);
        activeIndex = Math.max(0, Math.min(activeIndex, dots.length - 1));
        dots.forEach(function (d, idx) {
            d.classList.toggle('active', idx === activeIndex);
        });
    }

    var scrollTimeout;
    slider.addEventListener('scroll', function () {
        updateArrows();
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(updateDots, 60);
    });

    window.addEventListener('resize', function () {
        updateArrows();
        updateDots();
    });

    updateArrows();
    updateDots();

    __sliderControllers[sliderId] = {
        slider: slider,
        scrollBy: function (direction) {
            slider.scrollBy({ left: direction * slideStep() * 2, behavior: 'smooth' });
        }
    };
}

// Global function used by every slider's arrow buttons' inline onclick handlers
window.scrollSlider = function (sliderId, direction) {
    var controller = __sliderControllers[sliderId];
    if (controller) controller.scrollBy(direction);
};

initCardSlider('testsSlider', 'testsPrevBtn', 'testsNextBtn', 'testsDots');
initCardSlider('materialsSlider', 'materialsPrevBtn', 'materialsNextBtn', 'materialsDots');
initCardSlider('resultsSlider', 'resultsPrevBtn', 'resultsNextBtn', 'resultsDots');
initCardSlider('plansSlider', 'plansPrevBtn', 'plansNextBtn', 'plansDots');


  /* ================= INNER PAGE NAVIGATION ================= */
  (function () {
      var pageLinks = document.querySelectorAll('.nav-link-custom[data-page]');
      var pages = document.querySelectorAll('.main .page');
      // Keep the existing topbar visible on every page.
    //   var mainChildren = document.querySelectorAll('.main > :not(.page):not(.topbar)');
var mainChildren = document.querySelectorAll(
    '.main > :not(.page):not(.topbar):not(.progress-card):not(.main-buy-more)'
);
      function showPage(pageName, updateHash) {
          var isDashboard = !pageName || pageName === 'dashboard';

          pages.forEach(function (page) {
              page.classList.toggle('active', page.id === 'page-' + pageName);
          });

          mainChildren.forEach(function (el) {
              el.style.display = isDashboard ? '' : 'none';
          });

          pageLinks.forEach(function (link) {
              link.classList.toggle('active', link.getAttribute('data-page') === (isDashboard ? 'dashboard' : pageName));
          });

          if (!isDashboard) {
              window.scrollTo({ top: 0, behavior: 'smooth' });
          }

          if (updateHash) {
              history.replaceState(null, '', isDashboard ? window.location.pathname : '#' + pageName);
          }
      }

      pageLinks.forEach(function (link) {
          link.addEventListener('click', function (e) {
              e.preventDefault();
              showPage(link.getAttribute('data-page'), true);
          });
      });

      window.addEventListener('hashchange', function () {
          var pageName = window.location.hash.replace('#', '') || 'dashboard';
          showPage(pageName, false);
      });

      var initialPage = window.location.hash.replace('#', '') || 'dashboard';
      if (!document.getElementById('page-' + initialPage) && initialPage !== 'dashboard') {
          initialPage = 'dashboard';
      }
      showPage(initialPage, false);
  })();

  /* ================= ADDED PAGE CONTENT =================
     Registrations, Learning Material, Take Tests and Downloads are now
     rendered server-side (PHP) above, so they are no longer built here. */
  (function () {
      function emptyState(icon, text) {
          return '<div class="empty-state"><i class="' + icon + '" style="font-size:24px;margin-bottom:10px;display:block;color:#b6bfd2;"></i>' + text + '</div>';
      }

      var subjects = <?php echo json_encode(array_values($activeSubjects)); ?>;
      var subjectGrid = document.getElementById('subjects-grid');
      if (subjectGrid) {
          if (subjects.length) {
              subjectGrid.innerHTML = subjects.map(function (subject) {
                  var name = typeof subject === 'string' ? subject : (subject.subject_name || subject.name || subject.subject || 'Subject');
                  return '';
              }).join('');
          } else {
              subjectGrid.innerHTML = emptyState('fa-solid fa-book-open', 'No subjects are available yet.');
          }
      }

      var results = document.getElementById('results-body');
      if (results && !results.children.length) {
          results.innerHTML = '<tr><td colspan="6">' + emptyState('fa-solid fa-chart-column', 'No completed test results found.') + '</td></tr>';
      }

      var certificates = document.getElementById('certificates-grid');
      if (certificates) {
          certificates.innerHTML =
              '<div class="certificate-card"><div class="page-icon"><i class="fa-solid fa-award"></i></div><div class="item-title">Test Program Certificate</div><div class="item-sub">Complete the required tests to unlock your certificate.</div><div style="margin-top:14px;"><span class="status-badge locked">Locked</span></div></div>' +
              '<div class="certificate-card"><div class="page-icon"><i class="fa-solid fa-medal"></i></div><div class="item-title">Achievement Certificate</div><div class="item-sub">Eligible achievement certificates will appear here.</div><div style="margin-top:14px;"><span class="status-badge locked">Locked</span></div></div>';
      }

      var faq = document.getElementById('faq-list');
      if (faq) {
          var faqs = [
              ['How do I register for a plan?', 'Open My Registrations or your available program and select the plan you want to purchase.'],
              ['Where can I find learning material?', 'Open Learning Material from the sidebar to view material available for your registered program.'],
              ['Where can I see my test results?', 'Open Results from the sidebar to view scores and completed assessments.'],
              ['When will my certificate be available?', 'Certificates are shown here once the required Test Program completion conditions are met.']
          ];
          faq.innerHTML = faqs.map(function (item, index) {
              return '<div class="custom-accordion-item">' +
                  '<button type="button" class="custom-accordion-btn ' + (index === 0 ? '' : 'collapsed') + '" data-faq-toggle="' + index + '">' +
                  '<span>' + escapeHtml(item[0]) + '</span><span class="plus-icon">+</span></button>' +
                  '<div class="accordion-body-inner" id="faq-answer-' + index + '" style="' + (index === 0 ? '' : 'display:none;') + '">' + escapeHtml(item[1]) + '</div>' +
                  '</div>';
          }).join('');

          faq.querySelectorAll('[data-faq-toggle]').forEach(function (btn) {
              btn.addEventListener('click', function () {
                  var idx = btn.getAttribute('data-faq-toggle');
                  var answer = document.getElementById('faq-answer-' + idx);
                  var open = answer.style.display !== 'none';
                  answer.style.display = open ? 'none' : 'block';
                  btn.classList.toggle('collapsed', open);
              });
          });
      }

      function escapeHtml(value) {
          return String(value == null ? '' : value)
              .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
              .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
      }
  })();

  // Program tabs: one dedicated tab for every plan and component.
  document.querySelectorAll('[data-program-tab]').forEach(function (tab) {
      tab.addEventListener('click', function () {
          var target = tab.getAttribute('data-program-tab');
          document.querySelectorAll('[data-program-tab]').forEach(function (btn) {
              var active = btn === tab;
              btn.classList.toggle('active', active);
              btn.setAttribute('aria-selected', active ? 'true' : 'false');
          });
          document.querySelectorAll('.program-panel').forEach(function (panel) {
              panel.classList.toggle('active', panel.id === 'program-panel-' + target);
          });
      });
  });
// Program description: show "Read more" only when the text is clamped
(function () {
    var desc = document.getElementById('programDescText');
    var btn  = document.getElementById('programReadMoreBtn');
    if (!desc || !btn) return;

    function checkClamp() {
        // when the dashboard is hidden (other inner page) clientHeight is 0, so skip
        if (desc.clientHeight === 0) return;
        btn.classList.toggle('show', desc.scrollHeight > desc.clientHeight + 1);
    }

    checkClamp();
    window.addEventListener('load', checkClamp);
    window.addEventListener('resize', checkClamp);

    // re-check when the dashboard becomes visible again after switching pages
    if (window.ResizeObserver) {
        new ResizeObserver(checkClamp).observe(desc);
    }
})();
// Remember the current tab so the checkout page can bring the student back to it
document.querySelectorAll('a[href*="student_registration/start_from_cin"]').forEach(function (a) {
    a.addEventListener('click', function () {
        try { sessionStorage.setItem('dash_return', window.location.href); } catch (e) {}
    });
});

// Purchase tab: filter chips for plans and components
document.querySelectorAll('[data-filter-scope]').forEach(function (bar) {
    var gridId  = bar.getAttribute('data-filter-scope');
    var grid    = document.getElementById(gridId);
    var emptyEl = document.getElementById(gridId + '-empty');
    var countEl = document.getElementById(gridId + '-count');
    if (!grid) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('.pcard'));
    var state = { status: 'all', category: 'all' };

    // Show how many items each chip would match
    bar.querySelectorAll('.filter-chip').forEach(function (chip) {
        var type = chip.getAttribute('data-filter-type');
        var val  = chip.getAttribute('data-value');
        var n = cards.filter(function (c) { return val === 'all' || c.getAttribute('data-' + type) === val; }).length;
        var span = document.createElement('span');
        span.className = 'chip-count';
        span.textContent = n;
        chip.appendChild(span);
    });

    function apply() {
        var visible = 0;
        cards.forEach(function (c) {
            var okStatus = state.status   === 'all' || c.getAttribute('data-status')   === state.status;
            var okCat    = state.category === 'all' || c.getAttribute('data-category') === state.category;
            var show = okStatus && okCat;
            c.classList.toggle('is-filtered-out', !show);
            if (show) visible++;
        });
        if (emptyEl) emptyEl.style.display = visible === 0 ? 'block' : 'none';
        if (countEl) countEl.textContent = (visible === cards.length) ? cards.length : (visible + ' / ' + cards.length);
    }

    bar.querySelectorAll('.filter-chip').forEach(function (chip) {
        chip.addEventListener('click', function () {
            var type = chip.getAttribute('data-filter-type');
            state[type] = chip.getAttribute('data-value');
            bar.querySelectorAll('.filter-chip[data-filter-type="' + type + '"]').forEach(function (b) {
                b.classList.toggle('active', b === chip);
            });
            apply();
        });
    });
});
// Purchase tab: All / Plans / Components dropdown
(function () {
    var select = document.getElementById('purchase-view-select');
    if (!select) return;

    var blocks = document.querySelectorAll('#page-subjects .purchase-block');

    function applyView(view) {
        blocks.forEach(function (b) {
            var show = (view === 'all') || (b.getAttribute('data-block') === view);
            b.classList.toggle('is-hidden', !show);
        });
    }

    select.addEventListener('change', function () {
        applyView(select.value);
    });

    applyView(select.value);
})();
</script>
<script>
var PROGRAM_DESCRIPTION_RAW = <?php echo json_encode($programDescriptionRaw); ?>;

function decodeIfEscaped(s) {
    s = s || '';
    if (/&lt;\/?[a-z]/i.test(s) && !/<[a-z][\s\S]*>/i.test(s)) {
        var t = document.createElement('textarea');
        t.innerHTML = s;
        return t.value;
    }
    return s;
}

function sanitizeHtml(html) {
    var allowed = ['P','BR','STRONG','B','EM','I','U','H1','H2','H3','H4','H5','H6',
                   'UL','OL','LI','A','BLOCKQUOTE','TABLE','THEAD','TBODY','TR','TH','TD','SPAN','DIV'];
    var drop = ['SCRIPT','STYLE','IFRAME','OBJECT','EMBED','LINK','META'];
    var doc = new DOMParser().parseFromString(decodeIfEscaped(html || ''), 'text/html');

    (function clean(node) {
        Array.from(node.children).forEach(function (el) {
            if (drop.indexOf(el.tagName) !== -1) { el.remove(); return; }
            if (allowed.indexOf(el.tagName) === -1) {
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

document.getElementById('programDescModal').addEventListener('show.bs.modal', function () {
    document.getElementById('programFullDescription').innerHTML = sanitizeHtml(PROGRAM_DESCRIPTION_RAW);
});
</script>
<script>
(function () {
    var schools = <?php echo json_encode($schoolsForJs ?? []); ?>;
    var input   = document.getElementById('schoolSearch');
    var hidden  = document.getElementById('schoolIdInput');
    var list    = document.getElementById('schoolList');
    var codeEl  = document.getElementById('schoolCodeView');
    var addrEl  = document.getElementById('schoolAddrView');
    var form    = document.getElementById('profileForm');
    if (!input || !list) return;
    var hl = -1;

    function render(q) {
        q = (q || '').toLowerCase().trim();
        var matches = schools.filter(function (s) {
            return !q || (s.name + ' ' + s.addr).toLowerCase().indexOf(q) !== -1;
        }).slice(0, 50);
        list.innerHTML = ''; hl = -1;
        if (!matches.length) {
            var e = document.createElement('div');
            e.className = 'school-opt-empty';
            e.innerHTML = 'No school found<a class="school-add-link" id="schoolEmptyAdd"><i class="fa-solid fa-circle-plus"></i> Add &ldquo;' +
                          (input.value || '').replace(/[&<>"']/g, function (c) { return '&#' + c.charCodeAt(0) + ';'; }) + '&rdquo; as a new school</a>';
            var addBtn = e.querySelector('#schoolEmptyAdd');
            addBtn.addEventListener('mousedown', function (ev) {
                ev.preventDefault();                       // keep input focused so blur doesn't wipe the typed name
                window.__schoolQuery = input.value;
                list.classList.remove('open');
                bootstrap.Modal.getOrCreateInstance(document.getElementById('addSchoolModal')).show();
            });
            list.appendChild(e); return;
        }
        matches.forEach(function (s) {
            var d = document.createElement('div'); d.className = 'school-opt';
            var n = document.createElement('div'); n.className = 'n'; n.textContent = s.name;
            var a = document.createElement('div'); a.className = 'a'; a.textContent = s.addr;
            d.appendChild(n); d.appendChild(a);
            d.addEventListener('mousedown', function (ev) { ev.preventDefault(); choose(s); });
            list.appendChild(d);
        });
    }
    function choose(s) {
        input.value = s.name; hidden.value = s.id;
        if (codeEl) codeEl.value = s.id;
        if (addrEl) addrEl.value = s.addr;
        list.classList.remove('open');
    }
    input.addEventListener('focus', function () { render(''); list.classList.add('open'); });
    input.addEventListener('input', function () { hidden.value = ''; render(input.value); list.classList.add('open'); });
    input.addEventListener('blur', function () {
        list.classList.remove('open');
        if (!hidden.value) input.value = '';
    });
    input.addEventListener('keydown', function (e) {
        var opts = list.querySelectorAll('.school-opt');
        if (!opts.length) return;
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            hl = e.key === 'ArrowDown' ? Math.min(hl + 1, opts.length - 1) : Math.max(hl - 1, 0);
            opts.forEach(function (o, i) { o.classList.toggle('hl', i === hl); });
            opts[hl].scrollIntoView({block: 'nearest'});
        } else if (e.key === 'Enter' && hl >= 0) {
            e.preventDefault();
            opts[hl].dispatchEvent(new MouseEvent('mousedown'));
        }
    });
    // Called by the Add School popup after a successful save
    window.addSchoolToPicker = function (s) {
        schools.push(s);
        choose(s);
    };
    var addLink = document.getElementById('schoolAddLink');
    if (addLink) addLink.addEventListener('mousedown', function () { window.__schoolQuery = input.value; });

    var origId = hidden.value, origName = input.value;
    if (form) form.addEventListener('reset', function () {
        setTimeout(function () { hidden.value = origId; input.value = origName; }, 0);
    });
})();
</script>
<script>
/* ================= ADD SCHOOL POPUP ================= */
(function () {
    var BASE = '<?php echo base_url(); ?>';
    var modalEl = document.getElementById('addSchoolModal');
    if (!modalEl) return;

    function $id(i) { return document.getElementById(i); }
    function say(text, ok) { var m = $id('ns_msg'); m.textContent = text || ''; m.className = 'ns-msg mt-3 ' + (text ? (ok ? 'ok' : 'err') : ''); }
    function reset(sel, label, disable) { sel.innerHTML = '<option value="">' + label + '</option>'; sel.disabled = !!disable; }
    function fill(sel, rows, valFn, labelFn, ph) {
        reset(sel, ph, false);
        rows.forEach(function (r) { var o = document.createElement('option'); o.value = valFn(r); o.textContent = labelFn(r); sel.appendChild(o); });
    }

    function loadStates() {
        var c = $id('ns_country').value;
        reset($id('ns_state'), 'Select state'); reset($id('ns_city'), 'Select state first', true); reset($id('ns_area'), 'Select district first', true);
        if (!c) return;
        fetch(BASE + 'welcome/get_states?country_id=' + encodeURIComponent(c))
            .then(function (r) { return r.json(); })
            .then(function (rows) { fill($id('ns_state'), rows, function (s) { return s.state_subdivision_id; }, function (s) { return s.state_subdivision_name; }, 'Select state'); });
    }

    $id('ns_country').addEventListener('change', loadStates);

    $id('ns_state').addEventListener('change', function () {
        reset($id('ns_city'), 'Select district', true); reset($id('ns_area'), 'Select district first', true);
        if (!this.value) return;
        fetch(BASE + 'welcome/get_cities?state_id=' + encodeURIComponent(this.value))
            .then(function (r) { return r.json(); })
            .then(function (rows) { fill($id('ns_city'), rows, function (c) { return c.district_name; }, function (c) { return c.district_name; }, 'Select district'); });
    });

    $id('ns_city').addEventListener('change', function () {
        reset($id('ns_area'), 'Select area', true);
        if (!this.value) return;
        fetch(BASE + 'welcome/get_areas', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'state_id=' + encodeURIComponent($id('ns_state').value) + '&district_id=' + encodeURIComponent(this.value)
        })
        .then(function (r) { return r.json(); })
        .then(function (rows) { fill($id('ns_area'), rows, function (a) { return a.area_code; }, function (a) { return a.city_name + ' (' + a.area_code + ')'; }, 'Select area'); });
    });

    var statesLoaded = false;
    modalEl.addEventListener('show.bs.modal', function () {
        say('');
        if (window.__schoolQuery && !$id('ns_school_name').value.trim()) {
            $id('ns_school_name').value = window.__schoolQuery.trim();
        }
        if (!statesLoaded) { statesLoaded = true; loadStates(); }
    });

    $id('ns_submit').addEventListener('click', function () {
        var btn = this;
        var v = {
            school_name: $id('ns_school_name').value.trim(),
            syllabus: $id('ns_syllabus').value,
            school_address: $id('ns_address').value.trim(),
            country: $id('ns_country').value,
            state: $id('ns_state').value,
            city: $id('ns_city').value,
            area_code: $id('ns_area').value,
            pin: $id('ns_pin').value.trim(),
            school_mobile: $id('ns_mobile').value.trim(),
            school_principal_name: $id('ns_principal').value.trim(),
            principal_email: $id('ns_principal_email').value.trim()
        };

        var required = ['school_name','syllabus','school_address','country','state','city','area_code','school_mobile','school_principal_name'];
        for (var i = 0; i < required.length; i++) { if (!v[required[i]]) { say('Please fill all required (*) fields.'); return; } }
        if (v.school_name.length < 3) { say('School name is too short.'); return; }
        if (!/^\d{10,15}$/.test(v.school_mobile)) { say('Enter a valid school mobile number (digits only).'); return; }
        if (v.principal_email && !/^\S+@\S+\.\S+$/.test(v.principal_email)) { say('Enter a valid principal email.'); return; }

        btn.disabled = true; say('Saving…', true);

        var body = new URLSearchParams(v);
        // If CSRF protection is enabled, uncomment:
        // body.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

        fetch(BASE + 'welcome/ajax_add_school', {
            method: 'POST',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            body: body
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            btn.disabled = false;
            if (res.status !== 'success') { say(res.message || 'Could not add school.'); return; }

            if (window.addSchoolToPicker) {
                window.addSchoolToPicker({
                    id: res.school_id,
                    name: res.school_name,
                    addr: (v.school_address + ' ' + v.city).trim()
                });
            }
            say(res.existing ? 'This school already exists — selected it for you.' : 'School added and selected.', true);
            setTimeout(function () {
                bootstrap.Modal.getOrCreateInstance(modalEl).hide();
                ['ns_school_name','ns_address','ns_pin','ns_mobile','ns_principal','ns_principal_email'].forEach(function (id) { $id(id).value = ''; });
                $id('ns_syllabus').value = '';
                window.__schoolQuery = '';
            }, 900);
        })
        .catch(function () { btn.disabled = false; say('Network error. Please try again.'); });
    });
})();
</script>
</body>
</html>