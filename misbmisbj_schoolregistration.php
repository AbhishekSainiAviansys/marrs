 <?php include('db.php');

$states = [];

$sql = "SELECT state_subdivision_id, state_subdivision_name
FROM states
WHERE country_id = 105
ORDER BY state_subdivision_name ASC;";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $states[] = $row;
    }
}


  if (isset($_POST['submit'])) {

    // Products (comma separated from hidden input)
    $selected_products = '';

        if (!empty($_POST['products']) && is_array($_POST['products'])) {
            $selected_products = implode(',', $_POST['products']);
        }
      
      $area_code    = trim($_POST['area_code'] ?? '');
      $school_phone = trim($_POST['school_phone'] ?? '');

    $landline_full = '';

    if (!empty($area_code) && !empty($school_phone)) {
        $landline_full = $area_code . '-' . $school_phone;
    }


    // School info
    $school_name   = $_POST['school_name'];
    $school_code   = uniqid('SCH'); // auto-generate
    $affiliation   = $_POST['affiliation_number'] ?? '';
    $location      = $_POST['address1'];
    $area_code     = $_POST['address2'] ?? '';
    $city          = $_POST['city'];     // city text
    $district      = $_POST['city'];     // reuse if no district field
    $country       = 105;                      // India
    $state         = $_POST['state'];    // state text
    $pin           = $_POST['pincode'];

    $school_email  = $_POST['school_email'];
    $school_phone  = $landline_full;
    
    $school_mobile = trim($_POST['school_mobile']);
    $school_addr   = $_POST['address1'] . ' ' . ($_POST['address2'] ?? '');

    // Principal
    $principal_title = 'Mr';
    $principal_name  = $_POST['principal_name'];
    $principal_email = $_POST['principal_email'] ?? '';
    $principal_phone = $_POST['principal_phone'] ?? '';

    // Coordinator
    $coord_title  = 'Coordinator';
    $coord_name   = $_POST['coordinator_name'] ?? '';
    $coord_email  = $_POST['coordinator_email'];
    $coord_phone  = $_POST['coordinator_mobile'];
    $numbers = [
    'School Mobile'     => $school_mobile,
    'Coordinator Phone' => $coord_phone
    
    ];
    
    foreach ($numbers as $label => $number) {
        if (!preg_match('/^[6-9]\d{9}$/', $number)) {
            echo "Enter a valid 10-digit mobile number for $label";
            exit;
        }
    }

    // Other
    $school_board  = $_POST['school_board'] ?? '';
    $school_medium = $_POST['school_medium'];
    $school_status = 'Active';
    $franchise_id  = '0';
    $password      = password_hash('marrs123', PASSWORD_DEFAULT); // temp password

$stmt = $conn->prepare("
INSERT INTO school_new (
    school_name, school_code, affiliation_number,
    location, area_code, city, district, country, state, pin,
    school_email, school_phone, school_mobile, school_address,
    principal_titile, school_principal_name, principal_email, principal_phone,
    coordinator_titile, school_coordinator_name, school_coordinator_email, coordinator_phone,
    school_board, school_medium, school_status, zoomstatus, status_new, franchise_id, password, profile
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "ssssssssisssssssssssssssssssss", // 31 letters: s=string, i=integer for country
    $school_name,
    $school_code,
    $affiliation,
    $location,
    $area_code,
    $city,
    $district,
    $country,
    $state,
    $pin,
    $school_email,
    $school_phone,
    $school_mobile,
    $school_addr,
    $principal_title,
    $principal_name,
    $principal_email,
    $principal_phone,
    $coord_title,
    $coord_name,
    $coord_email,
    $coord_phone,
    $school_board,
    $school_medium,
    $school_status,
    $zoomstatus,
    $status_new,
    $franchise_id,
    $password,
    $selected_products
);

 if ($stmt->execute()) {
        echo "<script>alert('Thank you for registering! Your school is now officially signed up for the MaRRS Rediscover Challenges. Please expect a call or email from our team within 48 hours to walk you through the upcoming phases of the competition.');</script>";
          // ----------------- SEND EMAIL -----------------
          
    
    $schoolName      = trim($_POST['school_name']);
    $school_email    = trim($_POST['school_email']);
    
    if (empty($school_email)) {
        return; // safety check
    }
    


 $apiKey = "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";; // Brevo API key
 $templateId = 906;              // Your template ID

 $schoolName      = trim($_POST['school_name']);
 $school_email    = trim($_POST['school_email']);

if (empty($school_email) || empty($schoolName)) {
    exit;
}

$data = [
    "to" => [
        [
            "email" => $school_email,
            "name"  => "School"
        ],
        [
            "email" => $coord_email,
            "name"  => "Coordinator"
        ],
        [
            "email" => $principal_email,
            "name"  => "Principal"
        ]
    ],
    "templateId" => $templateId,
    "params" => [
            "school_name"        => $schoolName,
            "school_email"       => $school_email,
            "school_mobile"      => $school_mobile,
            "coordinator_name"   => $coord_name,
            "coordinator_email"  => $coord_email,
            "coordinator_mobile" => $coord_phone,
            "principal_name"     => $principal_name,
            "principal_email"    => $principal_email,
            "principal_mobile"   => $principal_phone,
            "crm_number"         => "+91 7012706817",
            "product_name"       => $selected_products
        ],
    "sender" => [
        "email" => "noreply@marrs.in",
        "name"  => "MaRRS Rediscover"
    ]
];

// cURL request
$ch = curl_init("https://api.brevo.com/v3/smtp/email");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        "accept: application/json",
        "content-type: application/json",
        "api-key: $apiKey"
    ],
    CURLOPT_POSTFIELDS     => json_encode($data)
]);

$response = curl_exec($ch);
$error    = curl_error($ch);

curl_close($ch);


$ch = curl_init();

$url = "https://api.brevo.com/v3/smtp/email";

$data2 = [
    "to" => [
        [
            "email" => "customerrelations@marrs.in",
            "name"  => "Customer"
        ],
        [
            "email" => "skumar@marrs.in",
            "name"  => "Management"
        ]
    ],
    "templateId" => 913, // must be INTEGER not string
    "params" => [
        "school_name"        => $schoolName,
        "school_email"       => $school_email,
        "school_mobile"      => $school_mobile,
        "coordinator_name"   => $coord_name,
        "coordinator_email"  => $coord_email,
        "coordinator_mobile" => $coord_phone,
        "principal_name"     => $principal_name,
        "principal_email"    => $principal_email,
        "principal_mobile"   => $principal_phone,
        "crm_number"         => "+91 7012706817",
        "school_address"     =>$school_addr,
        "company_name"       =>"MaRRS Rediscover",
        "product_name"       => $selected_products
    ],
    "sender" => [
        "email" => "noreply@marrs.in",
        "name"  => "MaRRS Rediscover"
    ]
];

curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        "accept: application/json",
        "content-type: application/json",
        "api-key: " . $apiKey
    ],
    CURLOPT_POSTFIELDS     => json_encode($data2),
]);

$response = curl_exec($ch);
$error    = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);


if ($error) {
    echo "Error sending email: $error";
} else {
   header("Location: https://marrs.in");
}
        
 } else {
 echo "DB Error: " . $stmt->error;
 }
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>School Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap JS BUNDLE (must be bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
  background:#f4f6f8;
  font-family:'Poppins',sans-serif;
}
.is-invalid{
  border-color:#dc3545;
}
.invalid-feedback{
  display:block;
}

/* ===== MAIN CARD ===== */
.main-card{
  max-width:1100px;
  margin:40px auto;
  background:#fff;
  border-radius:14px;
  box-shadow:0 10px 30px rgba(0,0,0,.12);
  padding:30px 35px 40px;
}

/* ===== STEPPER ===== */
.stepper{
  display:flex;
  align-items:flex-start;
  justify-content:space-between;
  margin-bottom:40px;
}

.step{
  text-align:center;
  position:relative;
  min-width:180px;
}

.circle{
  width:40px;
  height:40px;
  border-radius:50%;
  background:#e5e5e5;
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:700;
  margin:0 auto 8px;
}

.step.active .circle{
  background:#b89b2f;
}

.step.completed .circle{
  background:#cfcfcf;
}

.step-title{
  font-size:14px;
  font-weight:600;
  color:#1f2d3d;
}

.step-line{
  flex:1;
  height:2px;
  background:#e5e5e5;
  margin-top:20px;
}

/* ===== CONTENT ===== */
.step-content{
  animation:fade .25s ease;
}

@keyframes fade{
  from{opacity:0;transform:translateY(10px)}
  to{opacity:1;transform:none}
}

.section-title{
  font-weight:700;
  margin-bottom:20px;
  color:#2d3a4a;
}

/* ===== BUTTONS ===== */
.btn-next{
  background:#2d73c5;
  color:#fff;
  font-weight:600;
  padding:10px 28px;
  border-radius:8px;
}
.btn-next:hover{background:#2d73c5;color:#fff;}

/* ===== GREEN SUCCESS HIGHLIGHT ===== */
.form-control.is-valid,
.form-select.is-valid {
  border-color: #198754 !important;
  background-image: none;
  box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

.form-control.is-invalid,
.form-select.is-invalid {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}
</style>
</head>

<body>
 <style>
  .competition-card {
  border: 2px solid #dee2e6;
  border-radius: 12px;
  padding: 16px;
  cursor: pointer;
  transition: all 0.25s ease;
}

.competition-card:hover {
  border-color: #0d6efd;
}

.competition-card.active {
  border-color: #198754;       /* green border */
  box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.2);
  background: #f8fff9;
}

    body {
      background-color: #fff7ef;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      max-width: 1120px;
      background: #fff;
      padding: 35px;
      margin: 40px auto;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .header-img {
     display: block;
    margin: 0 auto 20px;
    width: 860px;
    height: 270px;
    }
    .verified {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-weight: 800;
  color: #198754; /* green */
  font-size: 18px;
    position: relative;
    top: -32px;
    float: right;
    left: -6px;
}


    h2.title {
      color: #ff6f00;
      text-align: center;
      font-weight: 700;
    }

    p.subtitle {
      text-align: center;
      color: #0d47a1;
      font-weight: 600;
    }

    .competition-options {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin: 20px 0;
    }

    .competition-card {
      width: 160px;
      height: 160px;
      border: 2px solid #eee;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      cursor: pointer;
      transition: 0.3s;
      background-color: #fff;
    }

    .competition-card img {
     
      height: 66px;
      object-fit: contain;
    }

    .competition-card.active {
      border-color: #ff6f00;
      box-shadow: 0 0 10px rgba(255,111,0,0.5);
    }

    .section-title {
      background-color: #f4511e;
      color: white;
      font-weight: 600;
      padding: 8px 15px;
      border-radius: 5px;
      margin-top: 35px;
      margin-bottom: 15px;
    }

    label {
      font-weight: 500;
    }

    .form-control {
      border-radius: 8px;
      border: 1.5px solid #ddd;
    }

    .btn-submit {
      background-color: #f4511e;
      color: white;
      font-weight: 600;
      border-radius: 8px;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      margin-top: 20px;
    }

    .btn-submit:hover {
      background-color: #d84315;
    }

    .footer-note {
      text-align: center;
      margin-top: 25px;
      font-weight: 500;
    }

    .footer-note a {
      color: #ff6f00;
      text-decoration: none;
      font-weight: 600;
    }
    .section-header-title {
  background-color: #2d73c5; /* Blue background */
  color: white;
  text-align: center;
  padding: 12px 0;
  border-radius: 8px;
  margin-bottom: 25px;
}

.section-header-title h2 {
  font-size: 20px;
  font-weight: 700;
  margin: 0;
  letter-spacing: 1px;
}
.section-header-title1-12{
  background-color: #4b9a45; /* Blue background */
  color: white;
  text-align: center;
  padding: 12px 0;
  border-radius: 8px;
  margin-bottom: 25px;
}
.section-header-title1-12 h2 {
  font-size: 20px;
  font-weight: 700;
  margin: 0;
  letter-spacing: 1px;
}
    @media (max-width: 768px) {
      .competition-card {
        width: 45%;
        height: 110px;
      }
    }
  </style>

 <body>
      <!-- Header -->
      <div class="notice-banner">
         <div class="container-fluid text-center">
            <small><strong>Announcement:</strong> Registrations for MaRRS Xpress Math Challenge are open. <a href="#" style="text-decoration:underline;color:#fff">Learn more</a></small>
         </div>
      </div>
    
   <style>
      .notice-banner {
    background: #1c8e77;
    color: #fff;
    padding: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}
     /* Navbar background image */
    .navbar-custom {
      background: url("https://marrs.in/newassets/header.jpg") center / cover no-repeat;
     height:80px;
    }

    /* Dark overlay */
       /* Dark overlay */
   .navbar-custom {
    position: relative;
    z-index: 10;
}

.navbar-custom::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;        /* 👈 MUST be negative */
    pointer-events: none;
}
    
    .navbar-custom .container,
    .navbar-custom .navbar-nav .nav-link,
    .navbar-brand {
      position: relative;
      z-index: 2; /* higher than overlay */
    }
    

    .navbar-custom .container {
      position: relative;
      z-index: 2;
    }

    .navbar-nav .nav-link {
     font-size: 16px;
    color: #000 !important;
    font-weight: 600;
    }

    .navbar-nav .nav-link:hover {
      color: #ffd700 !important;
    }

    .navbar-brand img {
      height: 40px;
    }

    .navbar-toggler {
      border-color: rgba(255,255,255,0.6);
    }

    .navbar-toggler-icon {
      filter: invert(1);
    } 
    @media only screen and (max-width: 480px) {
    .navbar-custom {
        background: url(https://marrs.in/newassets/header.jpg) center / cover no-repeat;
        height: 100% !important;
    }
    
}
  </style> 


<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    
    <!-- Logo -->
    <a class="navbar-brand d-lg-none" href="/">
      <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo">
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about_marrs">About</a></li>
         <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Learning programs 
          </a>
          <ul class="dropdown-menu">
           
            <li><a class="dropdown-item" href="/all_programs">All programs </a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kinder">Kinder Garten Programs</a></li> 
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/1_8">Class 1-8 Programs </a></li>
             <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/8_12">Class 8-12 Programs </a></li>
          </ul>
        </li>
       
        <li class="nav-item"><a class="nav-link" href="/contact_marrs">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
      </ul>
    </div>

  </div>
</nav> 
<div class="main-card">
   <button class="btn btn-cta btn-primary text-white me-3" style="position: relative;
        top: -20px;
    left: 8px;" onclick="history.back()">
  ← Go Back
</button>
    <!--<img src="/newassets/MaRRS-Competitions-hd.jpg" alt="MaRRS Competitions" class="header-img">-->
  

     <h2 class="title">ENLIST YOUR SCHOOL</h2>
   
     <div class="section-header-title1-12">
      <h2>Turn Your Classrooms</h2>
    </div>
     <div class="competition-options competition-options-onetotwelve" id="">
       <div class="competition-card" data-product="MaRRS International Spelling Bee">
          <img src="https://marrs.in/images/misb_logo.png" alt="Spelling Bee">
          <p>MaRRS International Spelling Bee</p>
      </div>
       <div class="competition-card" data-product="MaRRS International Spelling Bee Junior">
      <img src="https://marrs.in/images/junior.png" alt="Spelling Bee">
      <p>MaRRS International Spelling Bee Junior</p>
    </div>
     

     </div>

    <hr>
    <p id="selectedCompetition" class="text-center fw-bold text-primary">Selected: None</p>
  <!-- ===== STEPPER ===== -->
  <div class="stepper">

    <div class="step active" data-step="1">
      <div class="circle">1</div>
      <div class="step-title">School Profile</div>
    </div>

    <div class="step-line"></div>

    <div class="step" data-step="2">
      <div class="circle">2</div>
      <div class="step-title">Coordinator Details</div>
    </div>

    <div class="step-line"></div>

    <div class="step" data-step="3">
      <div class="circle">3</div>
      <div class="step-title">Principal Details</div>
    </div>
       
  </div>
<form id="schoolForm" method="POST" action="addschool.php">

  <input type="hidden" name="products[]" id="products">
  <input type="hidden" id="principal_email_verified" name="email_verified" value="0">
  <input type="hidden" id="school_email_verified" value="0">
<input type="hidden" id="coordinator_email_verified" value="0">

  <!-- ================= STEP 1 ================= -->
  <div id="step-1" class="step-content" data-step="1">

    <div class="section-title text-white">School Profile</div>

    <div class="row g-3">
        
		<div class="col-md-4">
		<label>Country *</label>
		<select id="country" class="form-select" name="country" required>
		<option value="">Select country</option>
		</select>
		
		</div>

		<div class="col-md-4">
		<label>State *</label>
		<select id="state" class="form-select" name="state" required disabled>
		<option value="">Select state</option>
		</select>
		
		</div>

		<div class="col-md-4">
		<label>City *</label>
		<select id="city" class="form-select" name="city" required disabled>
		<option value="">Select city</option>
		</select>
		
		</div>
		  <div class="col-md-4">
        <label>Pincode</label>
        <input type="text" class="form-control" name="pincode">
      </div>

      <div class="col-md-4">
        <label>Address Line 1 *</label>
        <input type="text" class="form-control" name="address1" required>
      </div>

      <div class="col-md-4">
        <label>Address Line 2</label>
        <input type="text" class="form-control" name="address2">
      </div>
      <div class="col-md-4">
        <label>School Name *</label>
        <input type="text" class="form-control" name="school_name" required>
      </div>

      <div class="col-md-4">
        <label>Affiliation Number</label>
        <input type="text" class="form-control" name="school_affiliation">
      </div>

      <div class="col-md-4">
        <label>School Mobile *</label>
        <input type="tel" class="form-control" name="school_mobile" maxlength="10" required>
      </div>

      <div class="col-md-4">
       <div class="form-group">
      <label>School Landline</label>
    
      <div style="display:flex;gap:10px;">
    
        <!-- STD Code Dropdown -->
        <select name="area_code" class="form-control" style="max-width:140px;">
          <option value="">STD Code</option>
          <option value="011">011 - Delhi</option>
          <option value="022">022 - Mumbai</option>
          <option value="033">033 - Kolkata</option>
          <option value="044">044 - Chennai</option>
          <option value="040">040 - Hyderabad</option>
          <option value="080">080 - Bangalore</option>
          <option value="079">079 - Ahmedabad</option>
          <option value="020">020 - Pune</option>
          <option value="0484">0484 - Kochi</option>
          <option value="0495">0495 - Calicut</option>
          <option value="0471">0471 - Trivandrum</option>
          <!-- add more as needed -->
        </select>
    
        <!-- Landline Number -->
        <input type="text"
               name="school_phone"
               class="form-control"
               placeholder="Landline Number"
               pattern="[0-9]{6,10}"
               maxlength="10">
      </div>
    </div>
       
       
       
       
      </div>

      <div class="col-md-4">
        <label>School Email *</label>
        <input type="email" class="form-control" name="school_email" id="school_email" required>
        
        <small id="schoolOtpMsg" class="text-danger d-none">Invalid email</small>
      </div>

      <div class="col-md-4">
        <label>School Board</label>
        <select class="form-select" name="school_board">
          <option value="">Select</option>
          <option value="cbse">Central Board of Secondary Education </option>
          <option value="ciscec">Council for the Indian School Certificate Examinations</option>
          <option value="caie">Cambridge Assessment International Education</option>
          <option value="ib">International Baccalaureate</option>
          <option value="ap">Advanced Placement</option>
          <option value="fb">French Baccalaureate</option>
          <option value="Pe">Pearson Edexel</option>
            <option value="national_board">National Board</option>
          <option value="state_board">State Board</option>
            
        </select>
      </div>

      <div class="col-md-4">
        <label>School Medium *</label>
        <select class="form-select" name="school_medium" required>
          <option value="">Select</option>
          <option value="English">English</option>
          <option value="Hindi">Hindi</option>
          <option value="Malayalam">Malayalam</option>
          <option value="Marathi">Marathi</option>
          <option value="hindi">Konkani</option>
          <option value="Konkani">Tamil</option>
          <option value="Urdu">Urdu</option>
          <option value="Punjabi">Punjabi</option>
          <option value="Kashmiri">Kashmiri</option>
          <option value="Dogri">Dogri</option>
          <option value="Bengali">Bengali</option>
          <option value="hindi">Hindi</option>
            
        </select>
      </div>

   <div class="col-md-4">
        <label>Preferred Mode of Registration</label>
        <select class="form-select" name="registration_mode">
          <option value="">Select</option>
          <option value="online">Online</option>
          <option value="offline">Offline</option>
        </select>
      </div>

      

    
    </div>

    <div class="text-end mt-4">
      <button type="button" class="btn btn-next" onclick="nextStep(1)">Next →</button>
    </div>
  </div>

  <!-- ================= STEP 2 ================= -->
  <div id="step-2" class="step-content d-none" data-step="2">

    <div class="section-title text-white">School Coordinator Details</div>

    <div class="row g-3">
      <div class="col-md-4">
        <label>Coordinator Name * </label>
        <input type="text" class="form-control" name="coordinator_name" required>
      </div>

      <div class="col-md-4">
        <label>Coordinator Email *</label>
        <input type="email" class="form-control" name="coordinator_email" id="coordinator_email" required>
        <span id="coordinatorOtpMsg" class="text-success d-none">✓ Verified</span>
      </div>

      <div class="col-md-4">
        <label>Coordinator Mobile *</label>
        <input type="tel" class="form-control" name="coordinator_mobile" maxlength="10" required>
      </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
      <button type="button" class="btn btn-secondary" onclick="prevStep(2)">← Back</button>
      <button type="button" class="btn btn-next" onclick="nextStep(2)">Next →</button>
    </div>
  </div>

  <!-- ================= STEP 3 ================= -->
  <div id="step-3" class="step-content d-none" data-step="3">

    <div class="section-title text-white">Principal Details</div>

    <div class="row g-3">
      <div class="col-md-4">
        <label>Principal Name *</label>
        <input type="text" class="form-control" name="principal_name" required>
      </div>

      <div class="col-md-4">
        <label>Principal Email *</label>
        <input type="email" class="form-control" name="principal_email" id="principal_email" required>
         <span id="principalOtpMsg" class="text-success d-none">✓ Verified</span>
      </div>

      <div class="col-md-4">
        <label>Principal Mobile *</label>
        <input type="tel" class="form-control" name="principal_phone" id="principal_phone" maxlength="10" required>
      </div>
    </div>

   <div class="d-flex justify-content-between mt-4">
      <button type="button" class="btn btn-secondary" onclick="prevStep(3)">← Back</button>
      <button type="button" class="btn btn-next" onclick="nextStep(3)" id="nextbutton">Next →</button>
       <button type="submit" name="submit" class="btn btn-success d-none"  id="finalSubmitBtn"> Submit</button>
    </div>
    
    
  </div>
 
 
</form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

  const cards = document.querySelectorAll('.competition-card');
  const hiddenInput = document.getElementById('products');
  const selectedText = document.getElementById('selectedCompetition');

  if (!cards.length || !hiddenInput) return;

  let selectedProducts = [];

  cards.forEach(card => {
    card.addEventListener('click', function () {

      const product = this.dataset.product;
      if (!product) return;

      this.classList.toggle('active');

      if (selectedProducts.includes(product)) {
        selectedProducts = selectedProducts.filter(p => p !== product);
      } else {
        selectedProducts.push(product);
      }

      // Store as CSV (backend-friendly)
      hiddenInput.value = selectedProducts.join(',');

      // Display selection
      if (selectedText) {
        selectedText.innerText = selectedProducts.length
          ? `Selected: ${selectedProducts.join(', ')}`
          : 'Selected: None';
      }

      console.log(hiddenInput.value);
    });
  });

});
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {

  /* ================= EMAIL REGEX ================= */
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  /* ================= STEP VALIDATION ================= */
  window.validateStep = function (step) {
    let valid = true;

    const fields = document.querySelectorAll(`#step-${step} input, #step-${step} select`);

    fields.forEach(el => {
      el.classList.remove("is-valid", "is-invalid");

      if (el.hasAttribute("required") && el.value.trim() === "") {
        el.classList.add("is-invalid");
        valid = false;
        return;
      }

      if (el.type === "email" && el.value.trim() !== "") {
        if (!emailRegex.test(el.value.trim())) {
          el.classList.add("is-invalid");
          valid = false;
          return;
        }
      }

      if (el.name && (el.name.includes("mobile") || el.name.includes("principal_phone")) && el.value.trim() !== "") {
        const mobileRegex = /^[6-9]\d{9}$/;
        if (!mobileRegex.test(el.value.trim())) {
          el.classList.add("is-invalid");
          valid = false;
          return;
        }
      }

      el.classList.add("is-valid");
    });

    return valid;
  };

  /* ================= STEP-3: SUBMIT BUTTON ================= */
  
  const nextbutton = document.getElementById("nextbutton");
  const finalSubmitBtn = document.getElementById("finalSubmitBtn");
  if (finalSubmitBtn) {
    finalSubmitBtn.classList.add("d-none"); // hide initially
    finalSubmitBtn.disabled = true;
    
  }

  /* ================= NEXT STEP ================= */
  window.nextStep = function(step) {
    if (!validateStep(step)) return;
     /* ===== STEP 1 → SCHOOL EMAIL OTP ===== */ 
      if (step === 1) {
      const emailEl = document.getElementById("school_email"); 
      const verifiedEl = document.getElementById("school_email_verified"); 
      if (emailEl && verifiedEl && verifiedEl.value !== "1") {
      sendOTP("school_email", "otpModalSchool"); 
      return;
      } 
      } 
      /* ===== STEP 2 → COORDINATOR EMAIL OTP ===== */
      if (step === 2) { 
      const emailEl = document.getElementById("coordinator_email"); 
      const verifiedEl = document.getElementById("coordinator_email_verified");
      if (emailEl && verifiedEl && verifiedEl.value !== "1") {
      sendOTP("coordinator_email", "otpModalCoordinator");
     
      return; 
      }
      }
    /* ===== STEP 3 → PRINCIPAL EMAIL OTP ===== */
    if (step === 3) {
      const emailEl = document.getElementById("principal_email");
      const verifiedEl = document.getElementById("principal_email_verified");

      // OTP not verified → show modal
      if (emailEl && verifiedEl && verifiedEl.value !== "1") {
        sendOTP("principal_email", "otpModalPrincipal");
        return;
      }

      // OTP verified → show submit button
      if (finalSubmitBtn) {
          
        finalSubmitBtn.classList.remove("d-none");
        finalSubmitBtn.disabled = false;
        const nextBtn = document.getElementById("nextbutton"); // make sure your button has this ID
        if (nextBtn) {
            nextBtn.style.display = "none";  // ✅ hide it completely
            nextBtn.disabled = true;
        }
      }

      // Do NOT move to another step
      return;
    }

    /* ===== NORMAL MOVE ===== */
    const current = document.getElementById(`step-${step}`);
    const next = document.getElementById(`step-${step + 1}`);

    if (current) current.classList.add("d-none");
    if (next) next.classList.remove("d-none");

    updateStepper(step + 1);
  };

  /* ================= PREVIOUS STEP ================= */
  window.prevStep = function(step) {
    const current = document.getElementById(`step-${step}`);
    const prev = document.getElementById(`step-${step - 1}`);

    if (current) current.classList.add("d-none");
    if (prev) prev.classList.remove("d-none");

    updateStepper(step - 1);
  };

  /* ================= STEP INDICATOR ================= */
  function updateStepper(step) {
    document.querySelectorAll(".step").forEach(el => el.classList.remove("active"));
    const activeStep = document.querySelector(`.step[data-step="${step}"]`);
    if (activeStep) activeStep.classList.add("active");
  }
  updateStepper(1);

  /* ================= LIVE EMAIL VALIDATION ================= */
  document.addEventListener("input", function(e) {
    const el = e.target;
    if (el.type !== "email") return;
    const value = el.value.trim();

    el.classList.remove("is-valid", "is-invalid");
    if (value === "") return;

    if (emailRegex.test(value)) el.classList.add("is-valid");
    else el.classList.add("is-invalid");
  });

  /* ================= LIVE MOBILE VALIDATION ================= */
  let timeout;
  document.addEventListener("input", function(e) {
    const el = e.target;
    if (!el.name || (!el.name.includes("mobile") && !el.name.includes("principal_phone"))) return;

    clearTimeout(timeout);
    timeout = setTimeout(() => {
      el.value = el.value.replace(/\D/g, "");
      el.classList.remove("is-valid", "is-invalid");

      if (el.value.length < 10) return;

      const mobileRegex = /^[6-9]\d{9}$/;
      el.classList.add(mobileRegex.test(el.value) ? "is-valid" : "is-invalid");
    }, 300);
  });

});

/* ================= SEND OTP ================= */
function sendOTP(emailFieldId, modalId) {
  const emailEl = document.getElementById(emailFieldId);
  if (!emailEl) return;

  const email = emailEl.value.trim();
  if (!email) return;

  fetch("send_otp.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "email=" + encodeURIComponent(email)
  }).then(() => {
    const modalEl = document.getElementById(modalId);
    if (!modalEl) return;
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
  });
}

/* ================= VERIFY OTP ================= */
function verifyOTP(otpInputId, verifiedFieldId, modalId, nextStepNumber, msgId) {
  const otpInput = document.getElementById(otpInputId);
  if (!otpInput) return;
  const otp = otpInput.value.trim();
  const msgEl = document.getElementById(msgId);

  if (!otp) {
    if (msgEl) msgEl.innerText = "❌ Enter OTP";
    return;
  }

  fetch("verify_otp.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "otp=" + encodeURIComponent(otp)
  })
    .then(res => res.text())
    .then(resp => {
      resp = resp.trim();

      if (resp === "verified") {
        const verifiedEl = document.getElementById(verifiedFieldId);
        if (verifiedEl) verifiedEl.value = "1";

        const modalEl = document.getElementById(modalId);
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        // Step-3 special → show submit button
        if (verifiedFieldId === "principal_email_verified") {
          const submitBtn = document.getElementById("finalSubmitBtn");
          if (submitBtn) {
            submitBtn.classList.remove("d-none");
            submitBtn.disabled = false;
          }
        } else {
          nextStep(nextStepNumber);
        }

      } else if (resp === "expired") {
        if (msgEl) msgEl.innerText = "⚠️ OTP expired";
      } else {
        if (msgEl) msgEl.innerText = "❌ Invalid OTP";
      }
    })
    .catch(() => {
      if (msgEl) msgEl.innerText = "⚠️ Server error";
    });
}

</script>

<script>

// Country/State/City
let countriesData = [];
fetch("https://cdn.jsdelivr.net/gh/Yerikmiller/Countries-States-Cities-JSON@latest/all.json")
.then(res=>res.json()).then(data=>{ countriesData = data; populateCountries(); });

const countrySelect = document.getElementById("country");
const stateSelect = document.getElementById("state");
const citySelect = document.getElementById("city");

function populateCountries() {
    countrySelect.innerHTML = '<option value="">Select country</option>';
    countriesData.sort((a,b)=>a.name.localeCompare(b.name)).forEach(c=>{
        const opt = document.createElement("option");
        opt.value = c.iso2;
        opt.textContent = c.name;
        countrySelect.appendChild(opt);
    });
}

function getCountryByIso2(iso2) { return countriesData.find(c=>c.iso2===iso2) || null; }

countrySelect.addEventListener("change",()=>{
    stateSelect.innerHTML='<option value="">Select state</option>';
    stateSelect.disabled=true;
    citySelect.innerHTML='<option value="">Select city</option>';
    citySelect.disabled=true;
    if(!countrySelect.value) return;

    const country = getCountryByIso2(countrySelect.value);
    if(!country) return;

    if(country.states.length){
        country.states.sort((a,b)=>a.name.localeCompare(b.name)).forEach(s=>{
            stateSelect.innerHTML += `<option value="${s.name}">${s.name}</option>`;
        });
        stateSelect.disabled=false;
    } else if(country.cities && country.cities.length){
        country.cities.sort().forEach(c=>{
            citySelect.innerHTML += `<option value="${c}">${c}</option>`;
        });
        citySelect.disabled=false;
    }
});

stateSelect.addEventListener("change",()=>{
    citySelect.innerHTML='<option value="">Select city</option>';
    citySelect.disabled=true;
    const country = getCountryByIso2(countrySelect.value);
    if(!country || !country.states) return;

    const state = country.states.find(s=>s.name.toLowerCase()===stateSelect.value.toLowerCase());
    if(!state || !state.cities) return;

    state.cities.sort().forEach(c=>{
        citySelect.innerHTML += `<option value="${c}">${c}</option>`;
    });
    citySelect.disabled=false;
});


</script>
<!-- Coordinator Email OTP -->



<div class="modal fade" id="otpModalCoordinator" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">

     <h6 class="text-center"> Email Verification → OTP sent to Coordinator email</h6>
      <input type="text" id="email_otp_coordinator"
             class="form-control mb-2"
             placeholder="Enter OTP">

       <div id="otpMsg_coordinator" class="text-danger mt-2"></div>

      <button type="button" class="btn btn-primary"
         onclick="verifyOTP('email_otp_coordinator','coordinator_email_verified','otpModalCoordinator',2,'otpMsg_coordinator')">
        Verify OTP
      </button>

    </div>
  </div>
</div>


<!-- School Email OTP -->
<div class="modal fade" id="otpModalSchool" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">

      <h6 class="text-center"> Email Verification → OTP sent to school email</h6>

      <input type="text" id="email_otp_school"
             class="form-control mb-2"
             placeholder="Enter OTP">

      <div id="otpMsg_school" class="text-danger mb-2"></div>

      <button type="button" class="btn btn-primary"
        onclick="verifyOTP('email_otp_school','school_email_verified','otpModalSchool',1,'otpMsg_school')">
        Verify OTP
      </button>

    </div>
  </div>
</div>


<!-- Principal Email OTP -->
<div class="modal fade" id="otpModalPrincipal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">

      <h6 class="text-center"> Email Verification → OTP sent to Principal email</h6>
      <input type="text" id="email_otp_principal"
             class="form-control mb-2"
             placeholder="Enter OTP">

      <div id="otpMsg_principall" class="text-danger mb-2"></div>

      <button type="button" class="btn btn-primary"
        onclick="verifyOTP('email_otp_principal','principal_email_verified','otpModalPrincipal',1,'otpMsg_principal')">
        Verify OTP
      </button>

    </div>
  </div>
</div>

</body>
</html>


