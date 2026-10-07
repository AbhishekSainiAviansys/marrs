<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* ---- Normalize $profile so nothing below can fatal-error ---- */
$profile = $profile ?? [];
if (is_object($profile)) $profile = (array) $profile;

$stud_id      = $profile['id'] ?? '';
$stud_name    = trim(($profile['first_name'] ?? '') . ' ' . ($profile['middle_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''));
$stud_cin     = $profile['PRID']   ?? '';
$stud_class   = $profile['class']  ?? '';
$stud_email   = $profile['email']  ?? '';
$stud_phone   = $profile['mobile'] ?? '';
$father_name  = $profile['father_name'] ?? '';
$mother_name  = $profile['mother_name'] ?? '';
$address1     = $profile['address1']    ?? '';
$gender       = $profile['gender']      ?? '';
$state        = $profile['state']       ?? '';
$schoolId     = $profile['school_id']   ?? '';

/* School name/address — supplied by the controller (via get_school_by_id) */
$schoolName    = $profile['school_name']    ?? '';
$schoolAddress = $profile['school_address'] ?? '';

/* Class dropdown options — adjust to match your actual class list */
$classOptions = ['Class-1','Class-2','Class-3','Class-4','Class-5','Class-6','Class-7','Class-8','Class-9','Class-10'];

/* ---- Schools list for the searchable picker (controller passes $schools_list) ---- */
$schoolsForJs = [];
foreach (($schools_list ?? []) as $sc) {
    $sc = (array) $sc;
    $schoolsForJs[] = [
        'id'   => $sc['id'],
        'name' => $sc['school_name'] ?? '',
        'addr' => trim(($sc['school_address'] ?? '') . ' ' . ($sc['location'] ?? '') . ' ' . ($sc['city'] ?? '')),
    ];
}

/* Fallback: if name/address were not supplied by the controller, find them
   in the schools list using the saved school_id */
if ($schoolId !== '' && ($schoolName === '' || $schoolAddress === '')) {
    foreach ($schoolsForJs as $sj) {
        if ((string)$sj['id'] === (string)$schoolId) {
            if ($schoolName === '')    $schoolName    = $sj['name'];
            if ($schoolAddress === '') $schoolAddress = $sj['addr'];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - Lunar Assessments</title>
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
    --border:#eaedf3;
    --fs-scale:1;
  }
  *{font-family:'Inter',sans-serif;}
  body{background:var(--bg); color:var(--text-dark);}

  .sidebar{
    width:230px; min-height:100vh; background:#fff; border-right:1px solid var(--border);
    position:fixed; top:0; left:0; padding:24px 16px; display:flex; flex-direction:column;
  }
  .brand{display:flex; align-items:center; gap:10px; padding:0 8px 22px 8px; border-bottom:1px solid var(--border); margin-bottom:16px;}
  .brand-text{line-height:1.1;}
  .brand-text .name{font-weight:800; font-size:15px; letter-spacing:1.5px; color:var(--navy);}
  .brand-text .tag{font-size:9px; letter-spacing:1.5px; color:var(--text-muted); font-weight:600;}
  .logo-mark{width:34px; height:34px; position:relative; flex-shrink:0;}

  .nav-link-custom{
    display:flex; align-items:center; gap:12px; padding:11px 14px; border-radius:10px;
    color:#5b657a; font-size:14.5px; font-weight:500; margin-bottom:4px; text-decoration:none;
  }
  .nav-link-custom i{width:18px; text-align:center; font-size:15px;}
  .nav-link-custom:hover{background:#f2f4fa; color:var(--text-dark);}
  .nav-link-custom.active{background:var(--blue); color:#fff; box-shadow:0 6px 14px rgba(47,95,224,.35);}

  .help-card{margin-top:auto; background:#f7f8fc; border-radius:14px; padding:18px; text-align:left;}
  .help-card .title{font-weight:700; font-size:14px; margin-bottom:2px;}
  .help-card .sub{font-size:12.5px; color:var(--text-muted); margin-bottom:12px;}
  .btn-contact{background:#fff; border:1px solid #dde2ee; color:var(--blue); font-weight:600; font-size:13px; width:100%; padding:8px; border-radius:8px;}

  .main{margin-left:230px; padding:26px 32px 50px 32px;}

  .topbar{display:flex; align-items:center; justify-content:space-between; margin-bottom:22px;}
  .topbar-link{display:flex; align-items:center; gap:7px; font-size:14px; font-weight:600; background: #e92849;
    color: #fff;
    box-shadow: 0 6px 14px rgba(47, 95, 224, .35);
 text-decoration:none; padding:10px 20px; border-radius:5px;}

  .page-head{margin-bottom:20px;}
  .page-head h1{font-size:24px;font-weight:800;color:var(--navy);margin:0 0 5px;}
  .page-head p{font-size:13px;color:var(--text-muted);margin:0;}

  .card{background:#fff;border:1px solid var(--border);border-radius:16px;padding:20px;}
  .form-row{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-bottom:16px;}
  .field{display:flex;flex-direction:column;gap:6px;}
  .field label{font-size:12px;color:#5b657a;font-weight:700;}
  .field input,.field textarea,.field select{
    width:100%;border:1px solid #dfe4ef;border-radius:9px;padding:10px 12px;
    font-size:13px;color:var(--text-dark);background:#fff;outline:none;
  }
  .field input:focus,.field textarea:focus,.field select:focus{
    border-color:var(--blue);box-shadow:0 0 0 3px rgba(47,95,224,.10);
  }
  .field input:disabled,.field input[readonly]{background:#f4f6fb; color:var(--text-muted); cursor:not-allowed;}
  .section-title{font-weight:700; font-size:16px;}
  .section-sub{font-size:12.5px;color:var(--text-muted);margin:-8px 0 16px;}

  .btn-outline-custom{border:1px solid #cdd4e6; color:var(--text-dark); font-weight:600; font-size:13px; padding:7px 16px; border-radius:8px; background:#fff;}
  .btn-solid-custom{background:var(--blue); color:#fff; font-weight:600; font-size:13px; padding:7px 16px; border-radius:8px; border:none;}
  .btn-solid-custom:disabled{opacity:.6; cursor:not-allowed;}

  .alert-success-custom{
    background:linear-gradient(135deg, #2ECC71, #27AE60); color:#fff; border:none; border-radius:10px;
    padding:14px 20px; margin-bottom:18px;
  }
  .alert-danger-custom{
    background:#fdecea; color:#b02a37; border:1px solid #f5c2c7; border-radius:10px;
    padding:14px 20px; margin-bottom:18px; font-size:13.5px; font-weight:600;
  }

  /* ---- Searchable school picker ---- */
  .school-combo{position:relative;}
  .school-combo-list{
    display:none;position:absolute;left:0;right:0;top:calc(100% + 4px);z-index:50;
    background:#fff;border:1px solid #dfe4ef;border-radius:10px;
    max-height:260px;overflow-y:auto;box-shadow:0 10px 26px rgba(27,42,75,.12);
  }
  .school-combo-list.open{display:block;}
  .school-opt{padding:9px 12px;cursor:pointer;border-bottom:1px solid var(--border);}
  .school-opt:last-child{border-bottom:0;}
  .school-opt:hover,.school-opt.hl{background:#f2f6ff;}
  .school-opt .n{font-size:13px;font-weight:700;color:var(--text-dark);}
  .school-opt .a{font-size:11.5px;color:#5b657a;margin-top:1px;}
  .school-opt-empty{padding:12px;font-size:12.5px;color:#5b657a;}

  /* Program filter bar (moved out of <script> where it was breaking the JS) */
  .program-filter-bar{
      display:grid;
      grid-template-columns:repeat(6,minmax(0,1fr));
      gap:14px;
      margin-bottom:20px;
  }
  @media (max-width:900px){
      .program-filter-bar{grid-template-columns:repeat(3,minmax(0,1fr));}
  }
  @media (max-width:576px){
      .program-filter-bar{grid-template-columns:repeat(2,minmax(0,1fr));}
  }
  .program-filter-item label{
      display:block;
      font-size:calc(11px * var(--fs-scale));
      font-weight:800;
      text-transform:uppercase;
      letter-spacing:.5px;
      color:var(--text-muted);
      margin-bottom:6px;
  }
  .program-filter-item select{
      width:100%;
      border:1px solid var(--border);
      border-radius:10px;
      padding:10px 12px;
      font-size:calc(13.5px * var(--fs-scale));
      font-weight:600;
      color:var(--text-dark);
      background:#fff;
      cursor:pointer;
  }
  .program-filter-item select:focus{
      outline:none;
      border-color:var(--blue);
      box-shadow:0 0 0 3px rgba(49,85,231,.12);
  }

  @media(max-width:992px){
    .sidebar{display:none;}
    .main{margin-left:0;}
  }
  @media(max-width:767px){
    .form-row{grid-template-columns:1fr;}
  }
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

  <a href="#" class="nav-link-custom active"><i class="fa-solid fa-user"></i> Profile</a>

  <a href="<?php echo base_url();?>cin_login/logout" class="nav-link-custom"><i class="fa-solid fa-book"></i> Logout</a>
  <a href="<?php echo base_url(); ?>Cin_login/lunarindex#support" class="nav-link-custom"><i class="fa-solid fa-headset"></i> Support</a>

  <div class="help-card">
    <div class="title">Need Help?</div>
    <div class="sub">We are here for you</div>
    <button class="btn-contact"><i class="fa-solid fa-headset me-1"></i> Contact Support</button>
  </div>
</div>

<!-- MAIN -->
<div class="main">

  <div id="alert-box"></div>

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="page-head" style="margin-bottom:0;">
      <h1>Profile</h1>
      <p>Manage student, guardian and school information.</p>
    </div>
    <a href="<?php echo base_url(); ?>student_registration/select_plan/<?php echo $stud_cin;?>" class="topbar-link"> Proceed to Register <i class="fa-solid fa-arrow-right"></i></a>
  </div>

  <form id="profileForm">
    <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($stud_id); ?>">

    <!-- Student Information -->
    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">Student Information</p>
      <p class="section-sub">Basic details used across your registrations.</p>
      <div class="form-row">
        <div class="field">
          <label>Full Name</label>
          <input type="text" name="first_name" value="<?php echo htmlspecialchars($stud_name); ?>">
        </div>
        <div class="field">
          <label>PRID</label>
          <input type="text" value="<?php echo htmlspecialchars($stud_cin); ?>" disabled>
        </div>
      </div>
      <div class="form-row">
        <div class="field">
          <label>Class</label>
          <select name="class">
            <?php foreach ($classOptions as $opt) { ?>
              <option value="<?php echo htmlspecialchars($opt); ?>" <?php echo ($opt === $stud_class ? 'selected' : ''); ?>>
                <?php echo htmlspecialchars($opt); ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="field">
          <label>Gender</label>
          <select name="gender">
            <option value="Male"   <?php echo ($gender === 'Male' ? 'selected' : ''); ?>>Male</option>
            <option value="Female" <?php echo ($gender === 'Female' ? 'selected' : ''); ?>>Female</option>
            <option value="Other"  <?php echo ($gender === 'Other' ? 'selected' : ''); ?>>Other</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($stud_email); ?>">
        </div>
        <div class="field">
          <label>Mobile Number</label>
          <input type="text" name="mobile" value="<?php echo htmlspecialchars($stud_phone); ?>">
        </div>
      </div>
    </div>

    <!-- Guardian Details -->
    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">Guardian Details</p>
      <p class="section-sub">We'll use these details for important notifications.</p>
      <div class="form-row">
        <div class="field">
          <label>Father Name</label>
          <input type="text" name="father_name" value="<?php echo htmlspecialchars($father_name); ?>">
        </div>
        <div class="field">
          <label>Mother Name</label>
          <input type="text" name="mother_name" value="<?php echo htmlspecialchars($mother_name); ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="field" style="grid-column:1/-1;">
          <label>Address</label>
          <input type="text" name="address1" value="<?php echo htmlspecialchars($address1); ?>">
        </div>
      </div>
    </div>

    <!-- School Details (searchable) -->
    <div class="card" style="margin-bottom:18px;">
      <p class="section-title">School Details</p>
      <p class="section-sub">Search and select the school you are currently enrolled in.</p>
      <div class="form-row">
        <div class="field">
          <label>School Name *</label>
          <div class="school-combo" id="schoolCombo">
            <input type="text" id="schoolSearch" autocomplete="off"
                   placeholder="Type to search your school..."
                   value="<?php echo htmlspecialchars($schoolName); ?>">
            <input type="hidden" name="school_id" id="schoolIdInput" value="<?php echo htmlspecialchars($schoolId); ?>">
            <div class="school-combo-list" id="schoolList"></div>
          </div>
        </div>
        <div class="field">
          <label>School Code</label>
          <input type="text" id="schoolCodeView" value="<?php echo htmlspecialchars($schoolId); ?>" disabled>
        </div>
      </div>
      <div class="form-row">
        <div class="field" style="grid-column:1/-1;">
          <label>School Address</label>
          <input type="text" id="schoolAddrView" value="<?php echo htmlspecialchars($schoolAddress); ?>" disabled>
        </div>
      </div>
    </div>

    <div style="display:flex;gap:12px;">
      <button type="submit" class="btn-solid-custom" id="saveBtn">Save Changes</button>
      <button type="reset" class="btn-outline-custom">Cancel</button>
    </div>
  </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    $("#profileForm").on("submit", function (e) {
        e.preventDefault();

        // School must be picked from the list
        if (!$("#schoolIdInput").val()) {
            $("#alert-box").html('<div class="alert-danger-custom">Please select your school from the list.</div>');
            window.scrollTo({ top: 0, behavior: "smooth" });
            return;
        }

        let formData = $(this).serialize();

        $.ajax({
            url: "<?php echo base_url(); ?>student_registration/save_profile_details",
            type: "POST",
            data: formData,
            dataType: "json",
            beforeSend: function () {
                $("#saveBtn").prop("disabled", true).text("Saving...");
                $("#alert-box").html("");
            },
            success: function (response) {
                if (response.status === "success") {
                    $("#alert-box").html('<div class="alert-success-custom"><i class="fas fa-check-circle me-2"></i>Profile updated successfully!</div>');
                    window.scrollTo({ top: 0, behavior: "smooth" });
                } else {
                    $("#alert-box").text("").append(
                        $('<div class="alert-danger-custom"></div>').text("Error: " + response.message)
                    );
                }
            },
            error: function () {
                $("#alert-box").html('<div class="alert-danger-custom">Something went wrong. Please try again.</div>');
            },
            complete: function () {
                $("#saveBtn").prop("disabled", false).text("Save Changes");
            }
        });
    });
});

/* ================= SEARCHABLE SCHOOL PICKER ================= */
(function () {
    var schools = <?php echo json_encode($schoolsForJs); ?>;
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

        list.innerHTML = '';
        hl = -1;
        if (!matches.length) {
            var e = document.createElement('div');
            e.className = 'school-opt-empty';
            e.textContent = 'No school found';
            list.appendChild(e);
            return;
        }
        matches.forEach(function (s) {
            var d = document.createElement('div');
            d.className = 'school-opt';
            var n = document.createElement('div'); n.className = 'n'; n.textContent = s.name;
            var a = document.createElement('div'); a.className = 'a'; a.textContent = s.addr;
            d.appendChild(n); d.appendChild(a);
            d.addEventListener('mousedown', function (ev) { ev.preventDefault(); choose(s); });
            list.appendChild(d);
        });
    }

    function choose(s) {
        input.value  = s.name;
        hidden.value = s.id;
        if (codeEl) codeEl.value = s.id;
        if (addrEl) addrEl.value = s.addr;
        list.classList.remove('open');
    }

    input.addEventListener('focus', function () { render(''); list.classList.add('open'); });
    input.addEventListener('input', function () {
        hidden.value = '';              // typing invalidates the previous selection
        render(input.value);
        list.classList.add('open');
    });
    input.addEventListener('blur', function () {
        list.classList.remove('open');
        if (!hidden.value) input.value = '';   // must pick from the list
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

    // Cancel (reset) -> restore the original school values
    var origId   = hidden.value;
    var origName = input.value;
    var origCode = codeEl ? codeEl.value : '';
    var origAddr = addrEl ? addrEl.value : '';
    if (form) form.addEventListener('reset', function () {
        setTimeout(function () {
            hidden.value = origId;
            input.value  = origName;
            if (codeEl) codeEl.value = origCode;
            if (addrEl) addrEl.value = origAddr;
        }, 0);
    });
})();
</script>
</body>
</html>