<?php
// echo $result->academic_year;
// print_R($result); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MaRRS Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      padding: 30px 15px;
    }
    
    .registration-container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      padding: 40px;
      animation: slideIn 0.5s ease-out;
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .header-section {
      text-align: center;
      margin-bottom: 35px;
    }
    
    .header-section h2 {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
      font-size: 2rem;
      margin-bottom: 20px;
    }
    
    .header-section img {
      width: 200px;
      height: 160px;
      object-fit: contain;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .form-label {
      color: #333;
      font-weight: 600;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }
    
    .form-label .text-danger {
      color: #dc3545;
      margin-left: 2px;
    }
    
    .form-control,
    .form-select {
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background-color: #fff;
    }
    
    .form-control:focus,
    .form-select:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
      outline: none;
    }
    
    .form-control:disabled,
    .form-control:read-only {
      background-color: #f8f9fa;
      cursor: not-allowed;
      color: #6c757d;
    }
    
    .form-control::placeholder {
      color: #adb5bd;
    }
    
    .btn-submit {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 14px 50px;
      color: white;
      font-weight: 700;
      font-size: 1.1rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    .btn-submit:active {
      transform: translateY(0);
    }
    
    .section-divider {
      margin: 30px 0;
      border-bottom: 2px solid #f0f0f0;
    }
    
    /* Toast Styling */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }
    
    .toast {
      background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
      border: none;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }
    
    .toast-header {
      background: rgba(255, 255, 255, 0.95);
      border-bottom: none;
      font-weight: 600;
      color: #11998e;
    }
    
    .toast-body {
      color: white;
      font-weight: 600;
      font-size: 0.95rem;
    }
    
    .bg-danger-custom {
      background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%) !important;
    }
    
    /* FAQ Modal Styling */
    .faq-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      z-index: 10000;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      backdrop-filter: blur(5px);
    }
    
    .faq-modal {
      background: white;
      border-radius: 20px;
      max-width: 800px;
      width: 100%;
      max-height: 85vh;
      display: flex;
      flex-direction: column;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
      animation: modalSlideIn 0.4s ease-out;
    }
    
    @keyframes modalSlideIn {
      from {
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }
    
    .faq-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 25px 30px;
      border-radius: 20px 20px 0 0;
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .faq-header i {
      font-size: 2rem;
    }
    
    .faq-header h3 {
      margin: 0;
      font-size: 1.5rem;
      font-weight: 700;
    }
    
    .faq-content {
      padding: 30px;
      overflow-y: auto;
      flex: 1;
    }
    
    .faq-item {
      margin-bottom: 20px;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 10px;
      border-left: 4px solid #667eea;
    }
    
    .faq-question {
      font-weight: 600;
      color: #333;
      font-size: 1.05rem;
      margin-bottom: 8px;
      display: flex;
      align-items: start;
      gap: 10px;
    }
    
    .faq-question i {
      color: #667eea;
      margin-top: 3px;
    }
    
    .faq-answer {
      color: #666;
      line-height: 1.6;
      margin-left: 30px;
    }
    
    .faq-footer {
      padding: 20px 30px;
      border-top: 2px solid #f0f0f0;
      background: #fafafa;
      border-radius: 0 0 20px 20px;
    }
    
    .faq-checkbox {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 15px;
    }
    
    .faq-checkbox input[type="checkbox"] {
      width: 20px;
      height: 20px;
      cursor: pointer;
      accent-color: #667eea;
    }
    
    .faq-checkbox label {
      font-weight: 600;
      color: #333;
      cursor: pointer;
      margin: 0;
    }
    
    .btn-continue {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 10px;
      padding: 14px 40px;
      color: white;
      font-weight: 700;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
      width: 100%;
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-continue:hover:not(:disabled) {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }
    
    .btn-continue:disabled {
      background: #cccccc;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }
    
    .hidden {
      display: none;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
      .registration-container {
        padding: 30px 20px;
      }
      
      .header-section h2 {
        font-size: 1.5rem;
      }
      
      .header-section img {
        width: 150px;
        height: 120px;
      }
      
      .btn-submit {
        padding: 12px 40px;
        font-size: 1rem;
      }
    }
    
    @media (max-width: 576px) {
      body {
        padding: 15px 10px;
      }
      
      .registration-container {
        padding: 25px 15px;
      }
      
      .form-control,
      .form-select {
        font-size: 0.95rem;
        padding: 10px 14px;
      }
      
      .btn-submit {
        width: 100%;
        padding: 12px 20px;
      }
    }
  </style>
</head>
<body>

<!-- FAQ Modal Overlay -->
<div class="faq-overlay" id="faqOverlay">
  <div class="faq-modal">
    <div class="faq-header">
      <i class="bi bi-question-circle-fill"></i>
      <h3>Frequently Asked Questions</h3>
    </div>
    
    <div class="faq-content">
      <?php 
      if (!empty($faq)) {
        foreach ($faq as $index => $item) { 
      ?>
        <div class="faq-item">
          <div class="faq-question">
            <i class="bi bi-patch-question-fill"></i>
            <span><?php echo $index + 1; ?>: <?php echo htmlspecialchars($item->question); ?></span>
          </div>
          <div class="faq-answer">
            <?php echo htmlspecialchars($item->answer); ?>
          </div>
        </div>
      <?php 
        }
      } else {
        // Default FAQ if no data from database
      ?>
        <div class="faq-item">
          <div class="faq-question">
            <i class="bi bi-patch-question-fill"></i>
            <span>Q1: What is the registration process?</span>
          </div>
          <div class="faq-answer">
            Please fill all the required fields marked with (*) and submit the form. You will receive a confirmation email after successful registration.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <i class="bi bi-patch-question-fill"></i>
            <span>Q2: Can I edit my details after submission?</span>
          </div>
          <div class="faq-answer">
            Once submitted, you cannot edit your details. Please ensure all information is correct before submitting.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <i class="bi bi-patch-question-fill"></i>
            <span>Q3: What should I do if I face technical issues?</span>
          </div>
          <div class="faq-answer">
            Please contact our support team or try again after some time. Make sure you have a stable internet connection.
          </div>
        </div>
      <?php } ?>
    </div>
    
    <div class="faq-footer">
      <div class="faq-checkbox">
        <input type="checkbox" id="faqAccept" onchange="toggleContinueButton()">
        <label for="faqAccept">I have read and understood all the FAQs</label>
      </div>
      <button class="btn-continue" id="continueBtn" disabled onclick="closeFAQ()">
        <i class="bi bi-check-circle-fill me-2"></i> Continue to Registration
      </button>
    </div>
  </div>
</div>

<div class="registration-container hidden" id="registrationContainer">
  <!-- Header Section -->
  <div class="header-section">
    <h2>Registration Form <?php echo $result->academic_year; ?></h2>
    <img src='<?php echo base_url("certificate_logo/zoom.png"); ?>' alt="MaRRS Logo">
  </div>

  <!-- Registration Form -->
  <form method="POST" id="registrationForm">
    
    <!-- Student Basic Info -->
    <div class="row mb-3">
      <div class="col-md-6 mb-3 mb-md-0">
        <label for="student_name" class="form-label">
          <i class="bi bi-person-fill text-primary"></i> Student Name<span class='text-danger'>*</span>
        </label>
        <input type="text" class="form-control" id="student_name" placeholder="Enter Student Name" name="student_name" required>
      </div>
      <div class="col-md-6">
        <label for="school_address" class="form-label">
          <i class="bi bi-key-fill text-primary"></i> Registration Code<span class='text-danger'>*</span>
        </label>
        <input type="text" class="form-control" id="school_address" placeholder="<?php echo htmlspecialchars($result->registration_code); ?>" value='<?php echo $result->registration_code; ?>' name="sch_id" readonly>
      </div>
    </div>

    <!-- Gender and Parents Info -->
    <div class='row mb-3'>
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="gender" class="form-label">
          <i class="bi bi-gender-ambiguous text-primary"></i> Gender<span class='text-danger'>*</span>
        </label>
        <select class="form-select" name="gender" id="gender" required>
          <option value=''>-- Select Gender --</option>
          <option value='M'>Male</option>
          <option value='F'>Female</option>
        </select>    
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="father_name" class="form-label">
          <i class="bi bi-person text-primary"></i> Father Name<span class='text-danger'>*</span>
        </label>
        <input type="text" class="form-control" id="father_name" placeholder="Enter Father Name" name="father_name" required>
      </div>
      <div class="col-md-4">
        <label for="mother_name" class="form-label">
          <i class="bi bi-person text-primary"></i> Mother Name<span class='text-danger'>*</span>
        </label>
        <input type="text" class="form-control" id="mother_name" placeholder="Enter Mother Name" name="mother_name" required>
      </div>
    </div>

    <!-- Class, State, District -->
    <div class="row mb-3">
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="class" class="form-label">
          <i class="bi bi-mortarboard-fill text-primary"></i> Class<span class='text-danger'>*</span>
        </label>
        <select class="form-select" id="class" name="class" required>
          <option value="">-- Select Class --</option>
          <?php
          $query = $this->db->query("SELECT * FROM zoomzoom_schedule_class WHERE sch_id = ?", [$result->zoomzoom_schedule_id]);
          foreach ($query->result() as $row) { 
          ?>
            <option value="<?php echo htmlspecialchars($row->class); ?>"><?php echo htmlspecialchars($row->class); ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="state" class="form-label">
          <i class="bi bi-geo-alt-fill text-primary"></i> State<span class='text-danger'>*</span>
        </label>
        <select class="form-select" id="state" name="state" required onchange="getDistricts(this.value)">
          <option value=''>-- Select State --</option>
          <?php
          $query = $this->db->query("SELECT * FROM states WHERE country_id = 105 and state_subdivision_id !='001'");
          foreach ($query->result() as $district) { ?>
            <option value="<?php echo htmlspecialchars($district->state_subdivision_id); ?>">
              <?php echo htmlspecialchars($district->state_subdivision_name); ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="district" class="form-label">
          <i class="bi bi-pin-map-fill text-primary"></i> District<span class='text-danger'>*</span>
        </label>
        <select class="form-select" id="district" name="district" required>
          <option value="">-- Select District --</option>
        </select>
      </div>
    </div>

    <!-- Address, Email, Mobile -->
    <div class='row mb-4'>
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="address" class="form-label">
          <i class="bi bi-house-fill text-primary"></i> Address<span class='text-danger'>*</span>
        </label>
        <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
      </div>
      <div class="col-md-4 mb-3 mb-md-0">
        <label for="email" class="form-label">
          <i class="bi bi-envelope-fill text-primary"></i> Email<span class='text-danger'>*</span>
        </label>
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value='<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>' required readonly>
      </div>
      <div class="col-md-4">
        <label for="mobile" class="form-label">
          <i class="bi bi-phone-fill text-primary"></i> Mobile<span class='text-danger'>*</span>
        </label>
        <input type="tel" class="form-control" id="mobile" placeholder="9999999999" name="mobile" pattern="[0-9]{10}" maxlength="10" required>
      </div>
    </div>

        <?php
            $query = $this->db->query("SELECT lunar_schedule_school.school_id,school_new.school_name FROM lunar_schedule_school JOIN school_new on school_new.id=lunar_schedule_school.school_id WHERE sch_id = ?", [$result->zoomzoom_schedule_id]);
            if(!empty($query->result())){ 
        ?>
        <div class='row mb-4'>
            <div class="col-md-4 mb-3 mb-md-0">
            <label for="school" class="form-label">
                <i class="bi bi-mortarboard-fill text-primary"></i>School
            </label>
            <select class="form-select" id="school_id" name="school_id" required>
                <option value="">-- Select School --</option>
                <?php
                    
                foreach ($query->result() as $row) { 
                ?>

                <option value="<?php echo htmlspecialchars($row->school_id); ?>"><?php echo htmlspecialchars($row->school_name); ?></option>
              <?php } ?>
            </select>
            </div>
        </div>
        <?php } ?>
        
    <!-- Submit Button -->
    <div class="text-center mt-4">
      <button type="submit" class="btn btn-submit" name="submit">
        <i class="bi bi-check-circle-fill me-2"></i> Submit Registration
      </button>
    </div>
  </form>
</div>

<!-- Bootstrap Toast Notifications -->
<div class="toast-container">
  <!-- Success Toast -->
  <?php if (!empty($this->session->flashdata('success'))) { ?>
  <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <i class="bi bi-check-circle-fill text-success me-2"></i>
      <strong class="me-auto">Success</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <?php echo htmlspecialchars($this->session->flashdata('success')); ?>
    </div>
  </div>
  <?php } ?>
  
  <!-- Error Toast -->
  <?php if (!empty($this->session->flashdata('error'))) { ?>
  <div id="errorToast" class="toast bg-danger-custom" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header bg-danger text-white">
      <i class="bi bi-exclamation-circle-fill me-2"></i>
      <strong class="me-auto">Error</strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-white">
      <?php echo htmlspecialchars($this->session->flashdata('error')); ?>
    </div>
  </div>
  <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Show Bootstrap Toasts
  <?php if (!empty($this->session->flashdata('success'))) { ?>
    document.addEventListener('DOMContentLoaded', function() {
      const toastElement = document.getElementById('successToast');
      const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 4000
      });
      toast.show();
    });
  <?php } ?>
  
  <?php if (!empty($this->session->flashdata('error'))) { ?>
    document.addEventListener('DOMContentLoaded', function() {
      const toastElement = document.getElementById('errorToast');
      const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 4000
      });
      toast.show();
    });
  <?php } ?>

  // Get Districts based on State selection
  function getDistricts(stateId) {
    if (stateId === '') {
      document.getElementById('district').innerHTML = '<option value="">-- Select District --</option>';
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '<?php echo base_url("welcome/get_districts"); ?>', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById('district').innerHTML = xhr.responseText;
      }
    };
    xhr.send('state_id=' + stateId);
  }

  // Mobile number validation (only numbers)
  document.getElementById('mobile').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^0-9]/g, '');
  });

  // FAQ Modal Functions
  function toggleContinueButton() {
    const checkbox = document.getElementById('faqAccept');
    const continueBtn = document.getElementById('continueBtn');
    continueBtn.disabled = !checkbox.checked;
  }

  function closeFAQ() {
    const overlay = document.getElementById('faqOverlay');
    const container = document.getElementById('registrationContainer');
    
    overlay.style.transition = 'opacity 0.3s ease';
    overlay.style.opacity = '0';
    
    setTimeout(() => {
      overlay.classList.add('hidden');
      container.classList.remove('hidden');
      document.body.style.overflow = 'auto';
    }, 300);
  }

  // Prevent body scroll when modal is open
  document.addEventListener('DOMContentLoaded', function() {
    document.body.style.overflow = 'hidden';
  });

  // Form validation feedback
  (function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>

</body>
</html>