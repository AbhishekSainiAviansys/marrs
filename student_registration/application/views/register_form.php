<?php
// print_r($state);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MaRRS Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/css/intlTelInput.css">

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/intlTelInput.min.js"></script>
  <style>
    :root{
      --ink:#14213D;
      --ink-soft:#5B6785;
      --deep:#1D4ED8;
      --sky:#3B82F6;
      --amber:#F5A524;
      --mist:#F3F6FC;
      --line:#E3E8F4;
      --card:#FFFFFF;
      --ok:#16A34A;
      --danger:#E1493C;
      --radius:16px;
    }
    *{box-sizing:border-box;}
    body{
      margin:0;
      font-family:'Inter',sans-serif;
      background:var(--mist);
      color:var(--ink);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px 16px;
    }
    h1,h2,h3,.brand,.step-badge,.right-title{font-family:'Baloo 2',sans-serif;}

    .shell{
      width:100%;
      max-width:1080px;
      background:var(--card);
      border-radius:24px;
      box-shadow:0 30px 60px -25px rgba(20,33,61,.25);
      display:grid;
      grid-template-columns:1.15fr .85fr;
      overflow:hidden;
    }
    @media (max-width:860px){
      .shell{grid-template-columns:1fr;}
      .right{display:none;}
    }

    /* ---------- LEFT: form ---------- */
    .left{padding:44px 48px 36px;}
    .eyebrow{
      display:inline-flex;align-items:center;gap:8px;
      font-size:12.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;
      color:var(--deep);background:#E8EEFE;padding:6px 12px;border-radius:100px;
    }
    h1.title{font-size:30px;margin:16px 0 4px;line-height:1.15;color:var(--ink);}
    .school-line{
      color:var(--amber);font-weight:700;font-size:16px;margin:0 0 26px;
    }

    /* progress rail */
    .rail{display:flex;align-items:center;gap:6px;margin-bottom:32px;}
    .rail .seg{flex:1;height:6px;border-radius:6px;background:var(--line);overflow:hidden;}
    .rail .seg i{display:block;height:100%;width:0;background:linear-gradient(90deg,var(--deep),var(--sky));transition:width .35s ease;}

    .step-panel{display:none;animation:fade .35s ease;}
    .step-panel.active{display:block;}
    @keyframes fade{from{opacity:0;transform:translateY(6px);}to{opacity:1;transform:translateY(0);}}

    .step-head{margin-bottom:22px;}
    .step-head .num{color:var(--sky);font-weight:700;font-size:13px;letter-spacing:.05em;text-transform:uppercase;}
    .step-head h2{font-size:22px;margin:4px 0 0;color:var(--ink);}

    .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
    .grid.two{grid-template-columns:repeat(2,1fr);}
    @media (max-width:560px){.grid,.grid.two{grid-template-columns:1fr;}}

    .field label{
      display:block;font-size:13.5px;font-weight:600;color:var(--ink);margin-bottom:7px;
    }
    .field label .req{color:var(--danger);margin-left:2px;}
    .field input,.field select{
      width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:10px;
      font-size:14.5px;font-family:'Inter',sans-serif;color:var(--ink);background:#fff;
      transition:border-color .15s ease, box-shadow .15s ease;
    }
    .field input::placeholder{color:#9AA5C3;}
    .field input:focus,.field select:focus{
      outline:none;border-color:var(--sky);box-shadow:0 0 0 4px rgba(59,130,246,.14);
    }
    .field input[readonly]{background:#F5F7FB;color:var(--ink-soft);cursor:not-allowed;}
    .field.full{grid-column:1 / -1;}

    .nav-row{display:flex;justify-content:space-between;align-items:center;margin-top:32px;}
    .btn{
      font-family:'Baloo 2',sans-serif;font-weight:600;font-size:15px;
      padding:13px 26px;border-radius:11px;border:1.5px solid transparent;cursor:pointer;
      display:inline-flex;align-items:center;gap:8px;transition:transform .12s ease, box-shadow .12s ease, background .15s ease;
    }
    .btn:active{transform:translateY(1px);}
    .btn-ghost{background:#fff;border-color:var(--line);color:var(--ink);}
    .btn-ghost:hover{border-color:#C7D1EA;}
    .btn-primary{
      background:linear-gradient(120deg,var(--deep),var(--sky));color:#fff;
      box-shadow:0 10px 22px -8px rgba(29,78,216,.55);
    }
    .btn-primary:hover{box-shadow:0 14px 26px -8px rgba(29,78,216,.65);}
    .btn[disabled]{opacity:.45;cursor:not-allowed;box-shadow:none;}
    .spacer{visibility:hidden;}

    /* ---------- RIGHT: identity panel ---------- */
    .right{
      position:relative;
      background:linear-gradient(165deg,#16234F 0%, #1D4ED8 58%, #3B82F6 100%);
      color:#fff;padding:44px 40px;display:flex;flex-direction:column;
      overflow:hidden;
    }
    .right::before{
      content:"";position:absolute;inset:0;
      background-image:radial-gradient(circle at 85% 12%, rgba(245,165,36,.28), transparent 45%),
                        radial-gradient(circle at 10% 90%, rgba(255,255,255,.10), transparent 40%);
      pointer-events:none;
    }
    .brand{display:flex;align-items:center;gap:10px;font-weight:700;font-size:18px;position:relative;z-index:1;    justify-content: center;padding: 10px;
    background: #ffff;
    border-radius: 30px;}
    .brand .logo-img{height:36px;width:auto;display:block;}
    .brand .mark{
      width:34px;height:34px;border-radius:9px;background:var(--amber);
      display:flex;align-items:center;justify-content:center;color:#16234F;font-weight:800;font-family:'Baloo 2',sans-serif;
    }
    .right-title{font-size:24px;margin:30px 0 6px;position:relative;z-index:1;text-align:center;}
    .right p.lede{color:#CFDBFF;font-size:14.5px;line-height:1.55;margin:0 0 30px;position:relative;z-index:1; text-align:center;}

    .checklist{display:flex;flex-direction:column;gap:4px;position:relative;z-index:1;}
    .cl-item{
      display:flex;align-items:flex-start;gap:14px;padding:13px 4px;border-bottom:1px solid rgba(255,255,255,.12);
    }
    .cl-item:last-child{border-bottom:none;}
    .cl-dot{
      width:26px;height:26px;border-radius:50%;border:2px solid rgba(255,255,255,.4);
      display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;
      color:#fff;flex-shrink:0;margin-top:1px;transition:all .25s ease;
    }
    .cl-item.done .cl-dot{background:var(--amber);border-color:var(--amber);color:#16234F;}
    .cl-item.current .cl-dot{background:#fff;border-color:#fff;color:var(--deep);}
    .cl-item .cl-text b{display:block;font-size:14.5px;font-weight:700;}
    .cl-item .cl-text span{font-size:12.5px;color:#CFDBFF;}
    .cl-item.done .cl-text b, .cl-item.current .cl-text b{color:#fff;}
    .cl-item:not(.done):not(.current) .cl-dot{opacity:.5;}
    .cl-item:not(.done):not(.current) .cl-text b{color:#AEBEEA;}

    .right-foot{margin-top:auto;position:relative;z-index:1;padding-top:26px;font-size:12.5px;color:#AEBEEA;text-align: center;}
  </style>
</head>
<body>

<div class="shell">

  <!-- ===================== LEFT: WIZARD FORM ===================== -->
  <div class="left">
    <span class="eyebrow" id="stepBadge">Step 1 of 4</span>
    <h1 class="title"> Registration Form<br>
      <?php echo $reg->academic_year . ' &middot; ' . $reg->level_name; ?>
    </h1>
    <p class="school-line"><?php echo $school->school_name; ?></p>

    <div class="rail">
      <div class="seg"><i id="seg1"></i></div>
      <div class="seg"><i id="seg2"></i></div>
      <div class="seg"><i id="seg3"></i></div>
      <div class="seg"><i id="seg4"></i></div>
    </div>

    <form method="POST" id="marrsForm" novalidate>

      <!-- STEP 1 : Personal details -->
      <div class="step-panel active" data-step="1">
        <div class="step-head">
          <div class="num">Step 1 of 4</div>
          <h2>Personal details</h2>
        </div>
        <div class="grid">
          <div class="field">
            <label for="first_name">First Name<span class="req">*</span></label>
            <input type="text" id="first_name" placeholder="Enter first name" name="first_name" required>
          </div>
          <div class="field">
            <label for="middle_name">Middle Name</label>
            <input type="text" id="middle_name" placeholder="Enter middle name" name="middle_name">
          </div>
          <div class="field">
            <label for="last_name">Last Name<span class="req">*</span></label>
            <input type="text" id="last_name" placeholder="Enter last name" name="last_name" required>
          </div>
          <div class="field full">
            <label for="gender">Gender<span class="req">*</span></label>
            <select id="gender" name="gender" required>
              <option value="">-- Select Gender --</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
          </div>
        </div>
      </div>

      <!-- STEP 2 : Family details -->
      <div class="step-panel" data-step="2">
        <div class="step-head">
          <div class="num">Step 2 of 4</div>
          <h2>Family details</h2>
        </div>
        <div class="grid two">
          <div class="field">
            <label for="father_name">Father Name<span class="req">*</span></label>
            <input type="text" id="father_name" placeholder="Enter father name" name="father_name" required>
          </div>
          <div class="field">
            <label for="mother_name">Mother Name<span class="req">*</span></label>
            <input type="text" id="mother_name" placeholder="Enter mother name" name="mother_name" required>
          </div>
        </div>
      </div>

      <!-- STEP 3 : Class & address -->
      <div class="step-panel" data-step="3">
        <div class="step-head">
          <div class="num">Step 3 of 4</div>
          <h2>Class &amp; address</h2>
        </div>
        <div class="grid">
          <div class="field">
            <label for="class">Class<span class="req">*</span></label>
            <?php
              if (isset($reg->product_name)) {
                $classes = $this->db->get_where('product_class_applicable', array('product_name' => $reg->product_name))->result();
            ?>
              <select id="class" name="class" required>
                <option value="">-- select class --</option>
                <?php foreach ($classes as $class) { ?>
                  <option value="<?php echo $class->class; ?>"><?php echo $class->class; ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select id="class" name="class" required>
                <option value="">-- select class --</option>
                <option value="Nursery">Nursery</option>
                <option value="LKG">LKG</option>
                <option value="UKG">UKG</option>
                <option value="Class-1">Class-1</option>
                <option value="Class-2">Class-2</option>
                <option value="Class-3">Class-3</option>
                <option value="Class-4">Class-4</option>
                <option value="Class-5">Class-5</option>
                <option value="Class-6">Class-6</option>
                <option value="Class-7">Class-7</option>
                <option value="Class-8">Class-8</option>
                <option value="Class-9">Class-9</option>
                <option value="Class-10">Class-10</option>
                <option value="Class-11">Class-11</option>
                <option value="Class-12">Class-12</option>
              </select>
            <?php } ?>
          </div>
          <div class="field">
            <label for="state">State</label>
            <input type="text" id="state" placeholder="Enter State" name="state" value="<?php echo $state->state_subdivision_name; ?>" readonly>
          </div>
          <div class="field">
            <label for="address">Address<span class="req">*</span></label>
            <input type="text" id="address" placeholder="Enter address" name="address" required>
          </div>
        </div>
      </div>

      <!-- STEP 4 : Contact -->
      <div class="step-panel" data-step="4">
        <div class="step-head">
          <div class="num">Step 4 of 4</div>
          <h2>Contact information</h2>
        </div>
        <div class="grid two">
          <div class="field">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" readonly>
          </div>
          <!--<div class="field">-->
          <!--  <label for="mobile">Mobile<span class="req">*</span></label>-->
          <!--  <input type="text" id="mobile" placeholder="9999999999" name="mobile" required>-->
          <!--</div>-->
            <div class="field">
                <label for="mobile">
                    Mobile<span class="req">*</span>
                </label>
            
                <input
                    type="tel"
                    id="mobile"
                    name="mobile"
                    placeholder="9999999999"
                    required
                >
            
                <!-- Country ISO code -->
                <input type="hidden" id="country" name="country">
            
                <!-- Country dial code -->
                <input type="hidden" id="country_code" name="country_code">
            </div>
            
        </div>
      </div>

      <div class="nav-row">
        <button type="button" class="btn btn-ghost" id="backBtn">&larr; Back</button>
        <button type="button" class="btn btn-primary" id="nextBtn">Continue &rarr;</button>
        <button type="submit" class="btn btn-primary" id="submitBtn" name="submit" style="display:none;">Submit Registration &rarr;</button>
      </div>
    </form>
    
  </div>

  <!-- ===================== RIGHT: IDENTITY PANEL ===================== -->
  <div class="right">
    <div class="brand">
     <!-- Replace the src below with your orange logo's path -->
      <img class="logo-img" src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS logo"
           onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"></div>
    <h3 class="right-title">Welcome to MaRRS</h3>
    <p class="lede">Complete your registration in 4 quick steps to enroll for<br>
      <?php echo $reg->level_name; ?>, <?php echo $reg->academic_year; ?>.</p>

    <div class="checklist" id="checklist">
      <div class="cl-item current" data-item="1">
        <div class="cl-dot">1</div>
        <div class="cl-text"><b>Personal details</b><span>Name &amp; gender</span></div>
      </div>
      <div class="cl-item" data-item="2">
        <div class="cl-dot">2</div>
        <div class="cl-text"><b>Family details</b><span>Parent / guardian names</span></div>
      </div>
      <div class="cl-item" data-item="3">
        <div class="cl-dot">3</div>
        <div class="cl-text"><b>Class &amp; address</b><span>Where you study &amp; live</span></div>
      </div>
      <div class="cl-item" data-item="4">
        <div class="cl-dot">4</div>
        <div class="cl-text"><b>Contact information</b><span>Email &amp; mobile</span></div>
      </div>
    </div>

    <div class="right-foot"><?php echo $school->school_name; ?> &middot; Registered securely with MaRRS</div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/intlTelInput.min.js"></script>

<!-- YOUR JS HERE -->


<script>

$(document).ready(function(){

    var mobileInput = document.querySelector("#mobile");

    var iti = window.intlTelInput(mobileInput, {

        initialCountry: "in",

        separateDialCode: true,

        preferredCountries: [
            "in",
            "us",
            "gb",
            "ae"
        ]

    });


    /*
    |--------------------------------------------------------------------------
    | Country changed
    |--------------------------------------------------------------------------
    */
    mobileInput.addEventListener("countrychange", function(){

        var countryData = iti.getSelectedCountryData();

        $("#country").val(countryData.iso2);

        $("#country_code").val("+" + countryData.dialCode);

        console.log("Country:", countryData.iso2);
        console.log("Country Code:", "+" + countryData.dialCode);

    });


    /*
    |--------------------------------------------------------------------------
    | Set initial country
    |--------------------------------------------------------------------------
    */
    var countryData = iti.getSelectedCountryData();

    $("#country").val(countryData.iso2);

    $("#country_code").val("+" + countryData.dialCode);

});

</script>

<script>


(function(){
  var total = 4;
  var current = 1;

  var panels   = document.querySelectorAll('.step-panel');
  var segs     = [null, document.getElementById('seg1'), document.getElementById('seg2'), document.getElementById('seg3'), document.getElementById('seg4')];
  var items    = document.querySelectorAll('.cl-item');
  var badge    = document.getElementById('stepBadge');
  var backBtn  = document.getElementById('backBtn');
  var nextBtn  = document.getElementById('nextBtn');
  var submitBtn= document.getElementById('submitBtn');

  function render(){
    panels.forEach(function(p){
      p.classList.toggle('active', parseInt(p.dataset.step,10) === current);
    });

    for (var i = 1; i <= total; i++){
      segs[i].style.width = (i <= current) ? '100%' : '0%';
    }

    items.forEach(function(it){
      var n = parseInt(it.dataset.item,10);
      it.classList.remove('done','current');
      if (n < current) it.classList.add('done');
      else if (n === current) it.classList.add('current');
    });

    badge.textContent = 'Step ' + current + ' of ' + total;
    backBtn.style.visibility = (current === 1) ? 'hidden' : 'visible';
    nextBtn.style.display   = (current === total) ? 'none' : 'inline-flex';
    submitBtn.style.display = (current === total) ? 'inline-flex' : 'none';
  }

  function currentPanel(){
    return document.querySelector('.step-panel[data-step="' + current + '"]');
  }

  function validateCurrent(){
    var fields = currentPanel().querySelectorAll('[required]');
    var ok = true;
    fields.forEach(function(f){
      if (!f.value.trim()){
        ok = false;
        f.style.borderColor = 'var(--danger)';
      } else {
        f.style.borderColor = '';
      }
    });
    return ok;
  }

  nextBtn.addEventListener('click', function(){
    if (!validateCurrent()) return;
    if (current < total){ current++; render(); }
  });

  backBtn.addEventListener('click', function(){
    if (current > 1){ current--; render(); }
  });

  document.getElementById('marrsForm').addEventListener('submit', function(e){
    if (!validateCurrent()) e.preventDefault();
  });

  render();
})();
</script>

<script>

var mobileInput = document.querySelector("#mobile");

var iti = window.intlTelInput(mobileInput, {
    initialCountry: "in",
    separateDialCode: true,
    nationalMode: true,
    preferredCountries: ["in", "us", "gb", "ae"],
    utilsScript:
        "https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/utils.js"
});

</script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/intlTelInput.min.js"></script>
</body>
</html>