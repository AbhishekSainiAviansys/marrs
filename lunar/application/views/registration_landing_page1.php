<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MaRRS Rediscover Home</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  
<style>

.section-title {
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 3rem;
      color: var(--primary-color);
      position: relative;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: var(--accent-color);
      border-radius: 2px;
    }

    .feature-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: 1px solid rgba(66, 153, 225, 0.1);
      height: 100%;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
      width: 60px;
      height: 60px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1rem;
      background: linear-gradient(45deg, var(--accent-color), var(--secondary-color));
      color: white;
    }

    .feature-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }

    .feature-description {
      color: var(--text-light);
      line-height: 1.7;
    }

    .level-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 20px;
      padding: 2rem;
      text-align: center;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .level-card::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
      transition: all 0.3s ease;
      transform: scale(0);
    }

    .level-card:hover::before {
      transform: scale(1);
    }

    .level-card:hover {
      transform: translateY(-5px);
    }

    .level-number {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      opacity: 0.8;
    }

    .level-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1rem;
    }

    .level-description {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .stats-section {
      background: var(--bg-gradient);
      color: white;
      padding: 5rem 0;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      display: block;
    }

    .stat-label {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .testimonial-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .testimonial-text {
      font-style: italic;
      margin-bottom: 1rem;
      font-size: 1.1rem;
      line-height: 1.7;
    }

    .testimonial-author {
      font-weight: 600;
      color: var(--primary-color);
    }


/* ------------------ GLOBAL ------------------ */
.certificate-logo{
    /*max-width: 200px;*/
    width: 50%;
    height: auto;
}

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
    
    body{
        font-family:'Poppins',sans-serif;
        background:linear-gradient(135deg,#ffecd2 0%,#fcb69f 100%);
        min-height:100vh;
        overflow-x:hidden;
        
        display:flex;
        flex-direction:column;
    }
    
    /* Wrapper keeps modal centered */
    .page-wrapper{
        /*flex:1;*/
        display:flex;
        align-items:center;
        justify-content:center;
        padding:2rem 1rem;
    }
    
    /* ---------------- NAVBAR ---------------- */
    
    .navbar-custom{
        background:url("https://marrs.in/newassets/header.jpg") center/cover no-repeat;
        height:80px;
    }
    
    .navbar-nav .nav-link{
        font-weight:600;
        color:#000 !important;
    }
    
    .navbar-nav .nav-link:hover{
        color:#ffd700 !important;
    }
    
    /* ---------------- MODAL ---------------- */
    
    .modal-overlay{
        position:fixed;
        inset:0;
        padding:1rem;
        
        background:rgba(0,0,0,0.6);
        backdrop-filter:blur(5px);
        
        display:flex;
        align-items:center;
        justify-content:center;
        
        overflow-y:auto;
        z-index:9999;
    }
    
    .class-modal{
        background:white;
        border-radius:30px;
        max-width:520px;
        width:95%;
        max-height:90vh;
        overflow-y:auto;
        box-shadow:0 30px 80px rgba(0,0,0,0.2);
    }
    
    /* Header */
    .modal-header-custom{
        background:linear-gradient(135deg,#ffecd2 0%,#fcb69f 100%);
        padding:2rem;
        text-align:center;
    }
    
    .modal-title-custom{
        font-weight:800;
    }
    
    /* Grid */
    .class-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(90px,1fr));
        gap:1rem;
        margin-bottom:2rem;
    }
    
    .class-option input{
        display:none;
    }
    
    .class-label{
        display:block;
        padding:1rem;
        background:#fff5f0;
        border:2px solid #ffd4c4;
        border-radius:15px;
        font-weight:700;
        text-align:center;
        cursor:pointer;
        transition:0.3s;
    }
    
    .class-option input:checked + .class-label{
        background:linear-gradient(135deg,#fcb69f 0%,#ff9a9e 100%);
        color:#fff;
    }
    
    /* Button */
    .submit-btn{
        width:100%;
        padding:1rem;
        border:none;
        border-radius:50px;
        background:linear-gradient(135deg,#fcb69f 0%,#ff9a9e 100%);
        color:white;
        font-weight:700;
        cursor:pointer;
    }
    
    /* Success */
    .success-message{
        display:none;
        text-align:center;
        padding:2rem;
    }
    
    /* Footer */
    .footer-banner{
        margin-top:auto;
        background:#fff;
        /*padding:10px;*/
        text-align:center;
    }
    
    /* Loading spinner */
    .spinner-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }
    
    .spinner-border {
        width: 3rem;
        height: 3rem;
    }
    
    /* Info message */
    .info-message {
        background: #e3f2fd;
        border-left: 4px solid #2196f3;
        padding: 10px 15px;
        margin-bottom: 15px;
        border-radius: 4px;
        font-size: 14px;
        color: #0d47a1;
    }
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ---------------- BENEFITS SECTION ---------------- */
.benefits-section {
    background: white;
    padding: 3rem 0;
}

.benefit-card {
    background: linear-gradient(135deg, #fff5f0 0%, #ffe9e0 100%);
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    height: 100%;
    border: 2px solid #ffd4c4;
    transition: all 0.3s ease;
}

.benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(252, 182, 159, 0.3);
}

.benefit-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fcb69f 0%, #ff9a9e 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.benefit-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #5a3e36;
    margin-bottom: 0.5rem;
}

.benefit-text {
    font-size: 0.9rem;
    color: #8b6f63;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom">
<div class="container-fluid">
<!--<a class="navbar-brand text-white" href="#">MaRRS</a>-->
</div>
</nav>

<div class="page-wrapper">
  <!-- MODAL -->
  <img 
    src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" 
    class="certificate-logo"
>

    <div class="modal-overlay" id="classModal">
    
        <div class="class-modal">
        
            <div class="modal-header-custom">
                <h2 class="modal-title-custom">select Your Class</h2>
            </div>
        
            <div class="p-4">
            
                <form id="classSelectionForm">
                
                    <div class="info-message" id="infoMessage" style="display: none;">
                        Your previously selected class is pre-selected. Click "Continue" to proceed.
                    </div>
                
                    <div class="class-grid">
                    
                    <!-- Repeat Options -->
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="lkg" value="LKG" required>
                            <label class="class-label" for="lkg">LKG</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="ukg" value="UKG">
                            <label class="class-label" for="ukg">UKG</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c1" value="Class-1">
                            <label class="class-label" for="c1">Class-1</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c2" value="Class-2">
                            <label class="class-label" for="c2">Class-2</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c3" value="Class-3">
                            <label class="class-label" for="c3">Class-3</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c4" value="Class-4">
                            <label class="class-label" for="c4">Class-4</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c5" value="Class-5">
                            <label class="class-label" for="c5">Class-5</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c6" value="Class-6">
                            <label class="class-label" for="c6">Class-6</label>
                        </div>
                    
                        <div class="class-option">
                            <input type="radio" name="class" id="c7" value="Class-7">
                            <label class="class-label" for="c7">Class-7</label>
                        </div>
                        
                        <div class="class-option">
                            <input type="radio" name="class" id="c8" value="Class-8">
                            <label class="class-label" for="c8">Class-8</label>
                        </div>
                    
                    </div>
                    
                        <button type="submit" class="submit-btn" id="submitBtn">
                        Continue
                        </button>
                    
                </form>
            
                <div class="success-message" id="successMessage">
                    <h4>✔ Class Selected</h4>
                    <p>Loading dashboard...</p>
                </div>
                
                <!-- Loading spinner -->
                <div class="spinner-container" id="loadingSpinner" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    
    
</div>

<!-- BENEFITS SECTION -->
<div class="benefits-section">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="benefit-title">Track Progress</div>
                    <p class="benefit-text">Monitor growth in real time</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <div class="benefit-title">National Ranking</div>
                    <p class="benefit-text">Compare with peers nationwide</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="benefit-title">Digital Certificates</div>
                    <p class="benefit-text">Recognize every achievement</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div class="benefit-title">100% Online</div>
                    <p class="benefit-text">Learn anytime, anywhere</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section-spacer " style="">
    <div class="container mt-4">
      <h2 class="section-title animate-on-scroll">Progressive Learning Levels</h2>
      <p class="text-center mb-5 animate-on-scroll" style="font-size: 1.2rem; color: var(--text-light);">
        Our assessments are structured across three levels to build and evaluate skills step-by-step
      </p>
      
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="level-card animate-on-scroll">
            <div class="level-number">01</div>
            <h3 class="level-title">Starter - "What is it?"</h3>
            <p class="level-description">Focus on basic knowledge and understanding. Build strong foundations with fundamental concepts.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="level-card animate-on-scroll">
            <div class="level-number">02</div>
            <h3 class="level-title">Mover - "How do I do it?"</h3>
            <p class="level-description">Apply concepts in practical scenarios. Develop problem-solving skills and practical application.</p>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="level-card animate-on-scroll">
            <div class="level-number">03</div>
            <h3 class="level-title">Flyer - "Expert Application"</h3>
            <p class="level-description">Solve problems collaboratively and reflectively. Master advanced concepts and critical thinking.</p>
          </div>
        </div>
      </div>
    </div>
  </section>



<!-- MAIN CONTENT -->
<div class="container text-center " id="mainContent" style="display:none;">
    
    <!--<h2 class="mt-4 section-title animate-on-scroll">Welcome</h2>-->
    <h4 id="displayClassName"></h4>

    <div class="container mt-4" id="scheduleContainer" style="display:none;">
        <h3 style="font-size: 1.2rem; color: var(--text-light);">You are ELIGIBLE to participate in "Lunar Skill Test"</h3>
        
        <form id="scheduleForm">
            <table class="table table-bordered mt-3" id="scheduleTable">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Subject</th>
                        <th>Series</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Schedule options will be loaded here via AJAX -->
                </tbody>
            </table>
            
            <button type="submit" class="btn btn-success" id="continueBtn">
                Continue
            </button>
        </form>
    </div>
    
    <div class="container mt-5" id="noScheduleContainer" style="display:none;">
        <h3>Nothing scheduled for this grade yet! We are constantly updating our listings, so please check back in a few days or try changing your current standard/class. Thanks for stopping by!</h3>
    </div>
    
</div>

 
  
<!-- FOOTER -->
<div class="footer-banner mt-4">
   
      <img src="https://marrs.in/images/image.png" alt="MaRRS Header" class="img-fluid " >
</div>
 
<footer class="footer">
    <div class="container">
      <div class="footer-content text-center">
          <p class="animate-on-scroll" style="color: #010eb1; font-size: 1.2rem; margin-bottom: 3rem;">
        Assessments aren't just tests — they're tools for growth.<br> Lunar Skill Tests provide deep insights into your child's strengths and areas for improvement, helping them stay on track and excel.
      </p>
        <div class="footer-logo">MaRRS Lunar Skill Tests</div>
        <!--<p>A Product Of MaRRS Intellectual Services Pvt. Ltd.</p>-->
        
        <p>A Product Of</p>
        
        <img src='https://marrs.in/images/MaRRS%20Rediscover%20Logo-02.png' class='image-fluid w-50' >
        
      </div>
      <div class="border-top pt-3 text-center">
        <p class="mb-0">© Aviansys Technologies Pvt. Ltd. 2018-<?php echo date('Y'); ?></p>
      </div>
    </div>
  </footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

 $(document).ready(function() {
    // Check if class is already selected
    checkClassSelection();
});

function checkClassSelection() {
    // Show loading spinner while checking
    $("#classSelectionForm").hide();
    $("#loadingSpinner").show();
    
    // Check if we have a class in session
    $.ajax({
        url: "<?= base_url('Welcome/check_class_session') ?>",
        type: "GET",
        dataType: "json",
        success: function(res) {
            if(res.success && res.class) {
                // Class is already selected, pre-select the radio button but don't auto-submit
                preSelectClass(res.class);
            } else {
                // No class in session, show the form
                $("#loadingSpinner").hide();
                $("#classSelectionForm").show();
            }
        },
        error: function() {
            // If there's an error, just show the form
            $("#loadingSpinner").hide();
            $("#classSelectionForm").show();
        }
    });
}

function preSelectClass(selectedClass) {
    // Convert class value to match radio button IDs
    let classId = selectedClass.toLowerCase().replace(/\s+/g, '');
    
    // Special case for LKG and UKG
    if (selectedClass.toLowerCase() === 'lkg') {
        classId = 'lkg';
    } else if (selectedClass.toLowerCase() === 'ukg') {
        classId = 'ukg';
    } else {
        // For classes like "Class-1", convert to "c1"
        classId = 'c' + selectedClass.replace(/[^0-9]/g, '');
    }
    
    // Check if the radio button exists and select it
    const radioButton = $(`#${classId}`);
    if (radioButton.length > 0) {
        radioButton.prop('checked', true);
        
        // Show info message and form
        $("#loadingSpinner").hide();
        $("#infoMessage").show();
        $("#classSelectionForm").show();
    } else {
        // If we can't find the radio button, just show the form
        $("#loadingSpinner").hide();
        $("#classSelectionForm").show();
    }
}

/* ---------------- CLASS SELECTION ---------------- */

 $("#classSelectionForm").on("submit", function(e){
    e.preventDefault();

    let selected = $("input[name='class']:checked").val();

    if(!selected){
        alert("Please select class");
        return;
    }

    // Only show confirmation if it's not a pre-selected class
    let isPreSelected = $("#infoMessage").is(":visible");
    if (!isPreSelected && !confirm("Confirm selecting "+selected+" ?")){
        return;
    }

    $("#submitBtn").prop("disabled", true);
    $("#classSelectionForm").hide();
    $("#successMessage").show();

    $.ajax({
        url:"<?= base_url('Welcome/set_class_session') ?>",
        type:"POST",
        data:{class:selected},
        dataType:"json",
        success:function(res){
            if(res.success){
                // Continue with the selected class
                proceedWithClassSelection(selected);
            }
            else{
                alert("Session error");
                $("#submitBtn").prop("disabled", false);
                $("#classSelectionForm").show();
                $("#successMessage").hide();
            }
        },
        error: function() {
            alert("Network error. Please try again.");
            $("#submitBtn").prop("disabled", false);
            $("#classSelectionForm").show();
            $("#successMessage").hide();
        }
    });
});

function proceedWithClassSelection(selectedClass) {
    // Show main content
    $("#classModal").fadeOut(500, function() {
        $("#mainContent").fadeIn(500);
        $("#displayClassName").text(selectedClass);
        
        // Load schedules for this class
        loadSchedulesForClass(selectedClass);
    });
}

function loadSchedulesForClass(selectedClass) {
    // Show loading state
    $("#scheduleContainer").hide();
    $("#noScheduleContainer").hide();
    
    // Get the associate link ID from URL if available
    var associateId = getURLParameter('code');
    
    $.ajax({
        url: "<?= base_url('Welcome/get_schedules_for_class') ?>",
        type: "POST",
        data: {
            class: selectedClass,
            associate_id: associateId
        },
        dataType: "json",
        success: function(res) {
            if(res.success && res.schedules && res.schedules.length > 0) {
                // Populate the schedule table
                var tbody = $("#scheduleTable tbody");
                tbody.empty(); // Clear existing rows
                
                res.schedules.forEach(function(schedule) {
                    var row = `
                        <tr>
                            <td>
                                <input type="radio" name="schedule_id" value="${schedule.lunar_schedule_id}" required>
                            </td>
                            <td>${schedule.subject}</td>
                            <td>${schedule.series}</td>
                            <td>${schedule.type}</td>
                        </tr>
                    `;
                    tbody.append(row);
                });
                
                // Show the schedule container
                $("#scheduleContainer").show();
            } else {
                // No schedules available
                $("#noScheduleContainer").show();
            }
        },
        error: function() {
            alert("Error loading schedules. Please try again.");
        }
    });
}

// Helper function to get URL parameters
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
}

/* ---------------- SCHEDULE SELECT ---------------- */

 $("#scheduleForm").on("submit", function(e){
    e.preventDefault();
    
    let scheduleId = $("input[name='schedule_id']:checked").val();
    
    if(!scheduleId){
        alert("Please select one schedule");
        return false;
    }
    
    $("#continueBtn").prop("disabled", true);
    $("#continueBtn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
    
    $.ajax({
        url: "<?= base_url('Welcome/set_schedule_session') ?>",
        type: "POST",
        data: {
            schedule_id: scheduleId
        },
        dataType: "json",
        success: function(res) {
            if(res.success) {
                // Redirect to registration page
                window.location.href = res.redirect || "<?= base_url('Welcome/reg') ?>";
            } else {
                alert("Failed to set schedule. Please try again.");
                $("#continueBtn").prop("disabled", false);
                $("#continueBtn").html('Continue');
            }
        },
        error: function() {
            alert("Network error. Please try again.");
            $("#continueBtn").prop("disabled", false);
            $("#continueBtn").html('Continue');
        }
    });
});

</script>

</body>
</html>