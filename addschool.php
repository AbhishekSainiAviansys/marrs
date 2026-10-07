<?php include('db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ─────────────────────────────────────────
// AJAX: Get Countries
// ─────────────────────────────────────────
if (isset($_GET['action']) && $_GET['action'] === 'get_countries') {
    header('Content-Type: application/json');
    $sql    = "SELECT country_id, country_name FROM countries ORDER BY country_name ASC";
    $result = $conn->query($sql);
    $list   = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $list[] = $row;
        }
    }
    echo json_encode($list);
    exit;
}

// ─────────────────────────────────────────
// AJAX: Get States by country_id
// ─────────────────────────────────────────
if (isset($_GET['action']) && $_GET['action'] === 'get_states') {
    header('Content-Type: application/json');
    $country_id = intval($_GET['country_id'] ?? 0);

    if ($country_id === 0) {
        echo json_encode([]);
        exit;
    }

    // First try: match by country_id directly
    $stmt = $conn->prepare(
        "SELECT state_subdivision_id, state_subdivision_name
         FROM states
         WHERE country_id = ?
         ORDER BY state_subdivision_name ASC"
    );
    if (!$stmt) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }
    $stmt->bind_param("i", $country_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $list   = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }

    // Fallback: try matching via country_code join
    if (empty($list)) {
        $stmt2 = $conn->prepare(
            "SELECT ss.state_subdivision_id, ss.state_subdivision_name
             FROM state_subdivision ss
             JOIN countries c ON c.country_code = ss.country_code
             WHERE c.country_id = ?
             ORDER BY ss.state_subdivision_name ASC"
        );
        if ($stmt2) {
            $stmt2->bind_param("i", $country_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            while ($row = $result2->fetch_assoc()) {
                $list[] = $row;
            }
        }
    }

    echo json_encode($list);
    exit;
}

// ─────────────────────────────────────────
// AJAX: Get Cities by state_subdivision_id
// ─────────────────────────────────────────
if (isset($_GET['action']) && $_GET['action'] === 'get_cities') {
    header('Content-Type: application/json');
    $state_id = trim($_GET['state_id'] ?? '');

    if ($state_id === '') {
        echo json_encode([]);
        exit;
    }

    // Try matching districts.state_id as varchar (e.g. "IN-KL")
    $stmt = $conn->prepare(
        "SELECT id, district_name
         FROM districts
         WHERE state_id = ?
         ORDER BY district_name ASC"
    );
    if (!$stmt) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }
    $stmt->bind_param("s", $state_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $list   = [];
    while ($row = $result->fetch_assoc()) {
        $list[] = $row;
    }

    // Fallback: districts.state_id might store numeric ID from state_subdivision table
    if (empty($list)) {
        $stmt2 = $conn->prepare(
            "SELECT d.id, d.district_name
             FROM districts d
             JOIN state_subdivision ss ON ss.id = d.state_id
             WHERE ss.state_subdivision_id = ?
             ORDER BY d.district_name ASC"
        );
        if ($stmt2) {
            $stmt2->bind_param("s", $state_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            while ($row = $result2->fetch_assoc()) {
                $list[] = $row;
            }
        }
    }

    echo json_encode($list);
    exit;
}

// ─────────────────────────────────────────
// FORM SUBMIT
// ─────────────────────────────────────────
$product_error = '';

if (isset($_POST['submit'])) {

    $selected_products = '';
    if (!empty($_POST['products']) && is_array($_POST['products'])) {
        $selected_products = implode(',', $_POST['products']);
    }
    // Strip stray commas/whitespace so an "empty" selection (e.g. a single
    // blank string posted from the hidden field) is correctly detected.
    $selected_products = trim($selected_products, ", ");

    // ✅ Hard requirement: at least one product/activity must be selected
    if ($selected_products === '') {

        $product_error = 'Please select at least one product/activity before submitting.';

    } else {

        $area_code_input  = trim($_POST['area_code'] ?? '');
        $school_phone_raw = trim($_POST['school_phone'] ?? '');

        $landline_full = '';
        if (!empty($area_code_input) && !empty($school_phone_raw)) {
            $landline_full = $area_code_input . '-' . $school_phone_raw;
        }

        $country = intval($_POST['country']);
        $state   = $_POST['state'];

        // ✅ Step 1: Get area_code from areas table
        $area_code_for_code = 'XX';
        $area_stmt = $conn->prepare(
            "SELECT area_code FROM areas 
             WHERE country_id = ? AND state_id = ? 
             AND status = 'Active' LIMIT 1"
        );
        if ($area_stmt) {
            $area_stmt->bind_param("is", $country, $state);
            $area_stmt->execute();
            $area_result        = $area_stmt->get_result();
            $area_row           = $area_result->fetch_assoc();
            $area_code_for_code = $area_row['area_code'] ?? 'XX';
            $area_stmt->close();
        }

        // ✅ Step 2: Generate incremental school code
        $prefix      = $area_code_for_code . 'S';
        $school_code = $prefix . '00001'; // default

        $last_stmt = $conn->prepare(
            "SELECT school_code FROM school_new 
             WHERE school_code LIKE ? 
             ORDER BY school_code DESC LIMIT 1"
        );
        if ($last_stmt) {
            $like_pattern = $prefix . '%';
            $last_stmt->bind_param("s", $like_pattern);
            $last_stmt->execute();
            $last_result = $last_stmt->get_result();
            $last_row    = $last_result->fetch_assoc();
            $last_stmt->close();

            if ($last_row && !empty($last_row['school_code'])) {
                $numeric_part = substr($last_row['school_code'], strlen($prefix));
                $next_number  = intval($numeric_part) + 1;
                $school_code  = $prefix . str_pad($next_number, 5, '0', STR_PAD_LEFT);
            }
        }

        // ✅ Step 3: All other fields (school_code NOT overwritten here)
        $school_name   = $_POST['school_name'];
        $affiliation   = $_POST['affiliation_number'] ?? '';
        $location      = $_POST['address1'];
        $area_code     = $_POST['address2'] ?? '';  // address line 2
        $city          = $_POST['city'];
        $district      = $_POST['city'];
        $pin           = $_POST['pincode'];

        $school_email  = $_POST['school_email'];
        $school_phone  = $landline_full;
        $school_mobile = trim($_POST['school_mobile']);
        $school_addr   = $_POST['address1'] . ' ' . ($_POST['address2'] ?? '');

        $principal_title = 'Mr';
        $principal_name  = $_POST['principal_name'];
        $principal_email = $_POST['principal_email'] ?? '';
        $principal_phone = $_POST['principal_phone'] ?? '';

        $coord_title  = 'Coordinator';
        $coord_name   = $_POST['coordinator_name'] ?? '';
        $coord_email  = $_POST['coordinator_email'];
        $coord_phone  = $_POST['coordinator_mobile'];

        // Mobile validation
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

        $school_board  = $_POST['school_board'] ?? '';
        $school_medium = $_POST['school_medium'];
        $school_status = 'Active';
        $zoomstatus    = '';
        $status_new    = '';
        $franchise_id  = '0';
        $password      = password_hash('marrs123', PASSWORD_DEFAULT);

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

        // 30 variables → type string must have exactly 30 chars
        $stmt->bind_param(
            "sssssssiss" . "ssssssssss" . "ssssssssss",  // = 30 chars ✅
            $school_name, $school_code, $affiliation,
            $location, $area_code, $city, $district, $country, $state, $pin,
            $school_email, $school_phone, $school_mobile, $school_addr,
            $principal_title, $principal_name, $principal_email, $principal_phone,
            $coord_title, $coord_name, $coord_email, $coord_phone,
            $school_board, $school_medium, $school_status, $zoomstatus, $status_new,
            $franchise_id, $password, $selected_products
        );

        if ($stmt->execute()) {

            $schoolName   = trim($_POST['school_name']);
            $school_email = trim($_POST['school_email']);

            if (!empty($school_email) && !empty($schoolName)) {

                $apiKey     = "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"; // Brevo API key
                $templateId = 906;              // Your template ID

                $data = [
                    "to" => [
                        [ "email" => $school_email, "name" => "School" ],
                        [ "email" => $coord_email,  "name" => "Coordinator" ],
                        [ "email" => $principal_email, "name" => "Principal" ]
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

                // cURL request — school/coordinator/principal notification
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
                curl_exec($ch);
                curl_close($ch);

                // Internal notification
                $data2 = [
                    "to" => [
                        [ "email" => "customerrelations@marrs.in", "name" => "Customer" ],
                        [ "email" => "skumar@marrs.in", "name" => "Management" ]
                    ],
                    "templateId" => 913,
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
                        "school_address"     => $school_addr,
                        "company_name"       => "MaRRS Rediscover",
                        "product_name"       => $selected_products
                    ],
                    "sender" => [
                        "email" => "noreply@marrs.in",
                        "name"  => "MaRRS Rediscover"
                    ]
                ];

                $ch = curl_init("https://api.brevo.com/v3/smtp/email");
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST           => true,
                    CURLOPT_HTTPHEADER     => [
                        "accept: application/json",
                        "content-type: application/json",
                        "api-key: " . $apiKey
                    ],
                    CURLOPT_POSTFIELDS     => json_encode($data2),
                ]);
                curl_exec($ch);
                curl_close($ch);
            }

            header("Location: https://marrs.in");
            exit;

        } else {
            echo "DB Error: " . $stmt->error;
        }
    }
}
?>

<?php include('headertest.php'); ?>

<style>
* { box-sizing: border-box; }

.main-card {
  max-width: 1100px;
  margin: 30px auto;
  background: #fff;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(0,0,0,.12);
  padding: 25px;
}

.main-card .btn-cta {
  position: relative; top: 0; left: 0; margin-bottom: 10px;
}

h2.title { color: #ff6f00; text-align: center; font-weight: 700; }
p.subtitle { text-align: center; color: #0d47a1; font-weight: 600; }

.section-header-title,
.section-header-title1-12 {
  color: #fff; text-align: center; padding: 10px;
  border-radius: 8px; margin: 20px 0;
}
.section-header-title { background: #2d73c5; }
.section-header-title1-12 { background: #4b9a45; }
.section-header-title h2,
.section-header-title1-12 h2 { font-size: 18px; margin: 0; }

.competition-options {
  display: flex; flex-wrap: wrap; justify-content: center; gap: 12px;
}
.competition-card {
  width: 160px; height: 150px; border: 2px solid #eee; border-radius: 10px;
  display: flex; flex-direction: column; justify-content: center;
  align-items: center; text-align: center; cursor: pointer;
  transition: 0.25s; background: #fff;
}
.competition-card img { height: 60px; object-fit: contain; margin-bottom: 8px; }
.competition-card.active {
  border-color: #ff6f00; box-shadow: 0 0 10px rgba(255,111,0,0.4);
}

.stepper {
  display: flex; align-items: flex-start;
  justify-content: space-between; gap: 10px; margin: 30px 0;
}
.step { flex: 1; text-align: center; min-width: 0; }
.circle {
  width: 40px; height: 40px; border-radius: 50%; background: #e5e5e5;
  color: #fff; display: flex; align-items: center; justify-content: center;
  font-weight: 700; margin: 0 auto 8px; transition: 0.3s;
}
.step.active .circle { background: #b89b2f; }
.step.completed .circle { background: #cfcfcf; }
.step-title { font-size: 14px; font-weight: 600; }
.step-line { flex: 1; height: 2px; background: #e5e5e5; margin-top: 20px; }

.section-title {
  background: #f4511e; color: #fff; padding: 8px 12px;
  border-radius: 5px; margin-bottom: 15px;
}
.form-control, .form-select { border-radius: 8px; border: 1.5px solid #ddd; }
.btn-next { background: #2d73c5; color: #fff; padding: 10px 24px; border-radius: 8px; }
.btn-next:hover { background: #1c5aa3; }
.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #198754; }

/* Loading indicator for dropdowns */
.select-loading { position: relative; }
.select-loading::after {
  content: "Loading...";
  position: absolute; right: 30px; top: 50%;
  transform: translateY(-50%);
  font-size: 12px; color: #888; pointer-events: none;
}

@media (max-width: 768px) {
  .main-card { padding: 18px; }
  .competition-card { width: 45%; height: 120px; }
  .competition-card img { height: 50px; }
  .circle { width: 30px; height: 30px; font-size: 13px; }
  .step-title { font-size: 11px; }
  .step-line { margin-top: 15px; }
  h2.title { font-size: 22px; }
  p.subtitle { font-size: 14px; }
}

@media (max-width: 480px) {
  .competition-card { width: 100%; height: auto; padding: 10px; }
  .stepper { flex-direction: column; align-items: flex-start; gap: 15px; }
  .step { display: flex; align-items: center; gap: 10px; }
  .step-line { display: none; }
  .step-title { font-size: 13px; }
  .circle { width: 26px; height: 26px; font-size: 12px; }
}
</style>

<div class="main-card">
  <button class="btn btn-cta btn-primary text-white me-3" style="position:relative;" onclick="history.back()">← Go Back</button>

  <h2 class="title">ENLIST YOUR SCHOOL</h2>
  <p class="subtitle">Complete the steps below to enlist your school</p>

  <?php if (!empty($product_error)): ?>
    <div class="alert alert-danger text-center" role="alert">
      <?php echo htmlspecialchars($product_error); ?>
    </div>
  <?php endif; ?>

  <!-- STEPPER -->
  <div class="stepper">
    <div class="step active" data-step="1">
      <div class="circle">1</div>
      <div class="step-title">School Profile</div>
    </div>
    <div class="step-line"></div>
    <div class="step" data-step="2">
      <div class="circle">2</div>
      <div class="step-title">Select Products</div>
    </div>
    <div class="step-line"></div>
    <div class="step" data-step="3">
      <div class="circle">3</div>
      <div class="step-title">Coordinator Details</div>
    </div>
    <div class="step-line"></div>
    <div class="step" data-step="4">
      <div class="circle">4</div>
      <div class="step-title">Principal Details</div>
    </div>
  </div>

  <form id="schoolForm" method="POST" action="addschool.php">

    <input type="hidden" name="products[]" id="products">
    <input type="hidden" id="principal_email_verified" name="email_verified" value="0">
    <input type="hidden" id="school_email_verified" value="0">
    <input type="hidden" id="coordinator_email_verified" value="0">

    <!-- ================= STEP 1: SCHOOL PROFILE ================= -->
    <div id="step-1" class="step-content" data-step="1">

      <div class="section-title text-white">School Profile</div>

      <div class="row g-3">

        <!-- ✅ COUNTRY -->
        <div class="col-md-4">
          <label>Country *</label>
          <select id="country" class="form-select" name="country" required>
            <option value="">Loading countries...</option>
          </select>
        </div>

        <!-- ✅ STATE -->
        <div class="col-md-4">
          <label>State *</label>
          <select id="state" class="form-select" name="state" required disabled>
            <option value="">Select state</option>
          </select>
        </div>

        <!-- ✅ CITY -->
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
          <input type="text" class="form-control" name="affiliation_number">
        </div>

        <div class="col-md-4">
          <label>School Mobile *</label>
          <input type="tel" class="form-control" name="school_mobile" maxlength="10" required>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>School Landline</label>
            <div style="display:flex;gap:10px;">
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
              </select>
              <input type="text" name="school_phone" class="form-control"
                     placeholder="Landline Number" pattern="[0-9]{6,10}" maxlength="10">
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
            <option value="cbse">Central Board of Secondary Education</option>
            <option value="ciscec">Council for the Indian School Certificate Examinations</option>
            <option value="caie">Cambridge Assessment International Education</option>
            <option value="ib">International Baccalaureate</option>
            <option value="ap">Advanced Placement</option>
            <option value="fb">French Baccalaureate</option>
            <option value="pe">Pearson Edexcel</option>
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
            <option value="Konkani">Konkani</option>
            <option value="Tamil">Tamil</option>
            <option value="Urdu">Urdu</option>
            <option value="Punjabi">Punjabi</option>
            <option value="Kashmiri">Kashmiri</option>
            <option value="Dogri">Dogri</option>
            <option value="Bengali">Bengali</option>
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

    <!-- ================= STEP 2: SELECT PRODUCTS ================= -->
    <div id="step-2" class="step-content d-none" data-step="2">

      <div class="section-title text-white">Select Activities / Products</div>

      <div class="section-header-title">
        <h2>PRE-SCHOOL Challenges</h2>
      </div>

      <div class="competition-options competition-option-preschool">
        <div class="competition-card" data-product="MaRRS Preschool Bee Math">
          <img src="https://marrs.in/images/psbmath.png" alt="Math Bee">
          <p>MaRRS Preschool Bee Math</p>
        </div>
        <div class="competition-card" data-product="MaRRS Preschool Bee Science">
          <img src="https://marrs.in/images/psbsci.png" alt="Science Bee">
          <p>MaRRS Preschool Bee Science</p>
        </div>
        <div class="competition-card" data-product="MaRRS Preschool Bee English">
          <img src="https://marrs.in/images/psbeng.png" alt="English Bee">
          <p>MaRRS Preschool Bee English</p>
        </div>
        <div class="competition-card" data-product="MaRRS Preschool Bee Humanities">
          <img src="https://marrs.in/images/psbhum.png" alt="Humanities">
          <p>MaRRS Preschool Bee Humanities</p>
        </div>
        <div class="competition-card" data-product="MaRRS International Spelling Bee">
          <img src="https://marrs.in/images/junior.png" alt="Spelling Bee">
          <p>MaRRS International Spelling Bee Junior</p>
        </div>
        <div class="competition-card" data-product="Marrs Play2learn">
          <img src="https://marrs.in/images/p2l.png" alt="Play2learn">
          <p>Marrs Play2learn</p>
        </div>
      </div>

      <div class="section-header-title1-12">
        <h2>Grade 1 to 12 Students Challenges</h2>
      </div>

      <div class="competition-options competition-options-onetotwelve">
        <div class="competition-card" data-product="MaRRS International Spelling Bee">
          <img src="https://marrs.in/images/misb_logo.png" alt="Spelling Bee">
          <p>MaRRS International Spelling Bee</p>
        </div>
        <div class="competition-card" data-product="MaRRS International Math Bee">
          <img src="https://marrs.in/images/mimbin.png" alt="Math Bee">
          <p>MaRRS International Math Bee</p>
        </div>
        <div class="competition-card" data-product="Scientia Exertus">
          <img src="https://marrs.in/images/sciextr.png" alt="Scientia">
          <p>Scientia Exertus</p>
        </div>
      </div>

      <hr>
      <p id="selectedCompetition" class="text-center fw-bold text-primary">Selected: None</p>
      <div id="productError" class="alert alert-danger text-center d-none" role="alert">
        Please select at least one product/activity before continuing.
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">← Back</button>
        <button type="button" class="btn btn-next" onclick="nextStep(2)">Next →</button>
      </div>
    </div>

    <!-- ================= STEP 3: COORDINATOR DETAILS ================= -->
    <div id="step-3" class="step-content d-none" data-step="3">

      <div class="section-title text-white">School Coordinator Details</div>

      <div class="row g-3">
        <div class="col-md-4">
          <label>Coordinator Name *</label>
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
        <button type="button" class="btn btn-secondary" onclick="prevStep(3)">← Back</button>
        <button type="button" class="btn btn-next" onclick="nextStep(3)">Next →</button>
      </div>
    </div>

    <!-- ================= STEP 4: PRINCIPAL DETAILS ================= -->
    <div id="step-4" class="step-content d-none" data-step="4">

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
        <button type="button" class="btn btn-secondary" onclick="prevStep(4)">← Back</button>
        <button type="button" class="btn btn-next" onclick="nextStep(4)" id="nextbuttondis">Next →</button>
        <button type="submit" name="submit" class="btn btn-success d-none" id="finalSubmitBtn">Submit</button>
      </div>

    </div>

  </form>
</div>

<!-- ============================================================ -->
<!-- SCRIPTS -->
<!-- ============================================================ -->
<script>
// ─────────────────────────────────────────
// COMPETITION CARDS / PRODUCT SELECTION
// (declared at top level so nextStep() in the
//  navigation script below can call validateProductStep)
// ─────────────────────────────────────────
let selectedProducts = [];

function validateProductStep() {
  const productError = document.getElementById('productError');
  if (selectedProducts.length === 0) {
    if (productError) productError.classList.remove('d-none');
    return false;
  }
  if (productError) productError.classList.add('d-none');
  return true;
}

document.addEventListener('DOMContentLoaded', function () {
  const cards        = document.querySelectorAll('.competition-card');
  const hiddenInput  = document.getElementById('products');
  const selectedText = document.getElementById('selectedCompetition');
  const productError = document.getElementById('productError');

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

      hiddenInput.value = selectedProducts.join(',');

      if (selectedText) {
        selectedText.innerText = selectedProducts.length
          ? 'Selected: ' + selectedProducts.join(', ')
          : 'Selected: None';
      }

      if (selectedProducts.length > 0 && productError) {
        productError.classList.add('d-none');
      }
    });
  });
});
</script>

<script>
// ─────────────────────────────────────────
// ✅ COUNTRY / STATE / CITY  — DB via AJAX
// ─────────────────────────────────────────
const countrySelect = document.getElementById("country");
const stateSelect   = document.getElementById("state");
const citySelect    = document.getElementById("city");

// Helper: reset a select
function resetSelect(el, label) {
  el.innerHTML = `<option value="">${label}</option>`;
  el.disabled  = true;
}

// ── Load Countries on page load ──────────
fetch("addschool.php?action=get_countries")
  .then(res => res.json())
  .then(data => {
    countrySelect.innerHTML = '<option value="">Select Country</option>';
    data.forEach(c => {
      const opt       = document.createElement("option");
      opt.value       = c.country_id;    // ✅ numeric DB country_id
      opt.textContent = c.country_name;
      countrySelect.appendChild(opt);
    });
    countrySelect.disabled = false;
  })
  .catch(() => {
    countrySelect.innerHTML = '<option value="">Error loading countries</option>';
  });

// ── Country → States ─────────────────────
countrySelect.addEventListener("change", () => {
  resetSelect(stateSelect, "Select State");
  resetSelect(citySelect,  "Select City");

  if (!countrySelect.value) return;

  stateSelect.innerHTML = '<option value="">Loading states...</option>';

  fetch(`addschool.php?action=get_states&country_id=${countrySelect.value}`)
    .then(res => res.json())
    .then(data => {
      stateSelect.innerHTML = '<option value="">Select State</option>';
      if (data.length) {
        data.forEach(s => {
          const opt       = document.createElement("option");
          opt.value       = s.state_subdivision_id;   // ✅ varchar e.g. "IN-KL"
          opt.textContent = s.state_subdivision_name;
          stateSelect.appendChild(opt);
        });
        stateSelect.disabled = false;
      } else {
        stateSelect.innerHTML = '<option value="">No states found</option>';
      }
    })
    .catch(() => {
      stateSelect.innerHTML = '<option value="">Error loading states</option>';
    });
});

// ── State → Cities ───────────────────────
stateSelect.addEventListener("change", () => {
  resetSelect(citySelect, "Select City");

  if (!stateSelect.value) return;

  citySelect.innerHTML = '<option value="">Loading cities...</option>';

  fetch(`addschool.php?action=get_cities&state_id=${encodeURIComponent(stateSelect.value)}`)
    .then(res => res.json())
    .then(data => {
      citySelect.innerHTML = '<option value="">Select City</option>';
      if (data.length) {
        data.forEach(c => {
          const opt       = document.createElement("option");
          opt.value       = c.id;             // ✅ numeric DB district id
          opt.textContent = c.district_name;
          citySelect.appendChild(opt);
        });
        citySelect.disabled = false;
      } else {
        citySelect.innerHTML = '<option value="">No cities found</option>';
      }
    })
    .catch(() => {
      citySelect.innerHTML = '<option value="">Error loading cities</option>';
    });
});
</script>

<script>
// ─────────────────────────────────────────
// STEP VALIDATION & NAVIGATION
// ─────────────────────────────────────────
document.addEventListener("DOMContentLoaded", function () {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  window.validateStep = function (step) {
    let valid = true;
    const fields = document.querySelectorAll(`#step-${step} input, #step-${step} select`);

    fields.forEach(el => {
      el.classList.remove("is-valid", "is-invalid");

      if (el.hasAttribute("required") && el.value.trim() === "") {
        el.classList.add("is-invalid"); valid = false; return;
      }
      if (el.type === "email" && el.value.trim() !== "") {
        if (!emailRegex.test(el.value.trim())) {
          el.classList.add("is-invalid"); valid = false; return;
        }
      }
      if (el.name && (el.name.includes("mobile") || el.name.includes("principal_phone")) && el.value.trim() !== "") {
        if (!/^[6-9]\d{9}$/.test(el.value.trim())) {
          el.classList.add("is-invalid"); valid = false; return;
        }
      }
      el.classList.add("is-valid");
    });
    return valid;
  };

  const finalSubmitBtn = document.getElementById("finalSubmitBtn");
  if (finalSubmitBtn) { finalSubmitBtn.classList.add("d-none"); finalSubmitBtn.disabled = true; }

  window.nextStep = function (step) {
    // Step 2 is the product-selection step — validate selection, not form fields
    if (step === 2) {
      if (!validateProductStep()) return;
    } else {
      if (!validateStep(step)) return;
    }

    if (step === 1) {
      const verifiedEl = document.getElementById("school_email_verified");
      if (verifiedEl && verifiedEl.value !== "1") {
        sendOTP("school_email", "otpModalSchool"); return;
      }
    }
    if (step === 3) {
      const verifiedEl = document.getElementById("coordinator_email_verified");
      if (verifiedEl && verifiedEl.value !== "1") {
        sendOTP("coordinator_email", "otpModalCoordinator"); return;
      }
    }
    if (step === 4) {
      const verifiedEl = document.getElementById("principal_email_verified");
      if (verifiedEl && verifiedEl.value !== "1") {
        sendOTP("principal_email", "otpModalPrincipal"); return;
      }
      if (finalSubmitBtn) {
        finalSubmitBtn.classList.remove("d-none");
        finalSubmitBtn.disabled = false;
        document.getElementById("nextbuttondis")?.classList.add("d-none");
      }
      return;
    }

    document.getElementById(`step-${step}`)?.classList.add("d-none");
    document.getElementById(`step-${step + 1}`)?.classList.remove("d-none");
    updateStepper(step + 1);
  };

  window.prevStep = function (step) {
    document.getElementById(`step-${step}`)?.classList.add("d-none");
    document.getElementById(`step-${step - 1}`)?.classList.remove("d-none");
    updateStepper(step - 1);
  };

  function updateStepper(step) {
    document.querySelectorAll(".step").forEach(el => el.classList.remove("active"));
    document.querySelector(`.step[data-step="${step}"]`)?.classList.add("active");
  }
  updateStepper(1);

  // Live email validation
  document.addEventListener("input", function (e) {
    const el = e.target;
    if (el.type !== "email") return;
    const value = el.value.trim();
    el.classList.remove("is-valid", "is-invalid");
    if (value === "") return;
    el.classList.add(emailRegex.test(value) ? "is-valid" : "is-invalid");
  });

  // Live mobile validation
  let timeout;
  document.addEventListener("input", function (e) {
    const el = e.target;
    if (!el.name || (!el.name.includes("mobile") && !el.name.includes("principal_phone"))) return;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      el.value = el.value.replace(/\D/g, "");
      el.classList.remove("is-valid", "is-invalid");
      if (el.value.length < 10) return;
      el.classList.add(/^[6-9]\d{9}$/.test(el.value) ? "is-valid" : "is-invalid");
    }, 300);
  });
});

// ─────────────────────────────────────────
// OTP
// ─────────────────────────────────────────
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
    if (modalEl) bootstrap.Modal.getOrCreateInstance(modalEl).show();
  });
}

function verifyOTP(otpInputId, verifiedFieldId, modalId, nextStepNumber, msgId) {
  const otpInput = document.getElementById(otpInputId);
  if (!otpInput) return;
  const otp   = otpInput.value.trim();
  const msgEl = document.getElementById(msgId);

  if (!otp) { if (msgEl) msgEl.innerText = "❌ Enter OTP"; return; }

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
      const modal   = bootstrap.Modal.getInstance(modalEl);
      if (modal) modal.hide();

      if (verifiedFieldId === "principal_email_verified") {
        const submitBtn = document.getElementById("finalSubmitBtn");
        if (submitBtn) { submitBtn.classList.remove("d-none"); submitBtn.disabled = false; }
        document.getElementById("nextbuttondis")?.classList.add("d-none");
      } else {
        nextStep(nextStepNumber);
      }
    } else if (resp === "expired") {
      if (msgEl) msgEl.innerText = "⚠️ OTP expired";
    } else {
      if (msgEl) msgEl.innerText = "❌ Invalid OTP";
    }
  })
  .catch(() => { if (msgEl) msgEl.innerText = "⚠️ Server error"; });
}
</script>

<!-- OTP Modals -->
<div class="modal fade" id="otpModalCoordinator" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <h6 class="text-center">Email Verification → OTP sent to Coordinator email</h6>
      <input type="text" id="email_otp_coordinator" class="form-control mb-2" placeholder="Enter OTP">
      <div id="otpMsg_coordinator" class="text-danger mt-2"></div>
      <button type="button" class="btn btn-primary"
        onclick="verifyOTP('email_otp_coordinator','coordinator_email_verified','otpModalCoordinator',3,'otpMsg_coordinator')">
        Verify OTP
      </button>
    </div>
  </div>
</div>

<div class="modal fade" id="otpModalSchool" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <h6 class="text-center">Email Verification → OTP sent to School email</h6>
      <input type="text" id="email_otp_school" class="form-control mb-2" placeholder="Enter OTP">
      <div id="otpMsg_school" class="text-danger mb-2"></div>
      <button type="button" class="btn btn-primary"
        onclick="verifyOTP('email_otp_school','school_email_verified','otpModalSchool',1,'otpMsg_school')">
        Verify OTP
      </button>
    </div>
  </div>
</div>

<div class="modal fade" id="otpModalPrincipal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <h6 class="text-center">Email Verification → OTP sent to Principal email</h6>
      <input type="text" id="email_otp_principal" class="form-control mb-2" placeholder="Enter OTP">
      <div id="otpMsg_principall" class="text-danger mb-2"></div>
      <button type="button" class="btn btn-primary"
        onclick="verifyOTP('email_otp_principal','principal_email_verified','otpModalPrincipal',4,'otpMsg_principal')">
        Verify OTP
      </button>
    </div>
  </div>
</div>

<?php include('footertest.php'); ?>