<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MaRRS Lunar Skill Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom, #e6f0ff, #ffffff);
      font-family: Arial, sans-serif;
    }
    .hero-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    .section-title {
      font-weight: 700;
      color: #012548;
      margin-top: 2rem;
    }
    .lead {
      font-size: 1.1rem;
      line-height: 1.7;
    }
    .feature-img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 1.5rem;
    }
    footer {
      background-color: #012548;
      color: #fff;
      padding: 1.5rem 0;
      font-weight: 600;
    }
    @media (max-width: 768px) {
      .lead {
        font-size: 1rem;
      }
      .section-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <img src="https://marrs.in/images/header-011.jpg" alt="MaRRS Header" class="img-fluid">

  <!-- Logo Section -->
  <div class="container text-center my-4">
    <img src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" alt="Lunar Test Logo" class="hero-image">
  </div>

  <!-- Hero Section -->
  <section class="container my-5">
    <h2 class="section-title text-center">Lunar Skill Tests</h2>
    <p class="lead text-center">
      Launch Your Child’s Learning Journey Today! Master Skills. Soar to Success. Affordably.
    </p>
    <p class="lead text-center">
      A smart, affordable way to boost your child’s academic performance and confidence.<br>
      <strong>Lunar Skill Tests</strong> is a comprehensive online assessment program for students from Grade 1 to 10, designed to help them learn, master, and thrive.
    </p>
  </section>

  <!-- Key Benefits Section -->
  <section class="container my-5">
    <h2 class="section-title text-center">Why Choose Lunar Skill Tests?</h2>
    <p class="lead">
      ✅ <strong>Continuous Progress Tracking:</strong> Choose daily, weekly, or monthly tests to monitor your child’s growth in real-time.<br><br>
      ✅ <strong>National Percentile Grading:</strong> Understand your child’s performance compared to peers across the country.<br><br>
      ✅ <strong>Affordable Excellence:</strong> High-quality assessments at a fraction of the cost.<br><br>
      ✅ <strong>Celebrate Every Achievement:</strong> Earn digital certificates and medals for each test series.<br><br>
      ✅ <strong>Convenient & Flexible:</strong> 100% online, anytime access with easy monthly payments and additional study resources.
    </p>
  </section>

  <!-- Progressive Levels -->
  <section class="container my-5">
    <h2 class="section-title text-center">Empowering Learning Through Progressive Levels</h2>
    <div class="row text-center">
      <div class="col-md-4 mb-4">
        <h4 class="mb-2">Starter – “What is it?”</h4>
        <p class="lead">Focus on basic knowledge and understanding.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h4 class="mb-2">Mover – “How do I do it?”</h4>
        <p class="lead">Apply concepts in practical scenarios.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h4 class="mb-2">Flyer – “Expert-level application”</h4>
        <p class="lead">Solve problems collaboratively and reflectively.</p>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="container my-5 text-center">
    <h2 class="section-title">Unlock Your Child’s Potential</h2>
    <p class="lead">
      Assessments aren’t just tests — they’re tools for growth.<br>
      Lunar Skill Tests provide deep insights into your child’s strengths and areas for improvement.<br><br>
      ✅ Ready to Launch Their Success?<br>
      <strong>Enroll Now!</strong>
    </p>
  </section>

  <!-- Images Section -->
  <section class="container my-5 text-center">
    <img src="https://marrs.in/images/image%20(2).png" alt="Students 1" class="feature-img">
    <img src="https://marrs.in/images/image (1).png" alt="Students 2" class="feature-img">
    <img src="https://marrs.in/images/image.png" alt="Students 3" class="feature-img">
  </section>
<section><button id="startTestBtn" class="btn btn-warning w-100 py-3">
    <i class="fa fa-users"></i> Start Test
</button>
</section>
<script>
$("#startTestBtn").click(function () {

    let identity = localStorage.getItem("identity");
    let password = localStorage.getItem("user_id");

    if (!identity || !password) {
        alert("Session expired. Please login again.");
        return;
    }

    // Call Grademarker portal login API
    $.ajax({
        url: "https://grademarker.online/auth/cek_login",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            identity: identity,
            password: password
        }),
        success: function (res) {
            console.log(res);

            if (res.status === true) {
                // Redirect to external server after successful login
                window.location.href = "https://grademarker.online/student/start_test";
            } else {
                alert(res.message);
            }
        },
        error: function () {
            alert("Unable to connect to the test server.");
        }
    });

});
</script>

  <!-- Footer -->
  <footer class="text-center">
    <p>A Product of MaRRS Intellectual Services Pvt. Ltd.</p>
    <p>© Aviansys Technologies Pvt. Ltd. 
      <?php
        $currentYear = date("Y");
        $nextYear = $currentYear + 1;
        echo $currentYear . '-' . substr($nextYear, -2);
      ?>
    </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
