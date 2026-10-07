<?php include('header.php');?>
    
        <style>
        /* Reset and Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6; color: #333; background-color: #f8f9fa;
        }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        h1, h2, h3 { font-weight: 700; color: #222; margin-bottom: 20px; }
        p { margin-bottom: 20px; }
        .btn {
            display: inline-block; padding: 12px 24px; background-color: #1a73e8;
            color: #fff; text-decoration: none; border-radius: 4px;
            font-weight: 600; transition: 0.3s; border: none; cursor: pointer;
        }
        .btn:hover { background-color: #1557b0; transform: translateY(-2px); }
        header {
            background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky; top: 0; z-index: 1000;
                border-bottom: 4px solid #eb1736;
        }
        .header-container {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 0;
        }
        .logo {
            font-size: 1.8rem; font-weight: 700; color: #1a73e8; text-decoration: none;
        }
        nav ul { display: flex; list-style: none; }
        nav ul li { margin-left: 30px; }
        nav ul li a { text-decoration: none; color: #333; font-weight: 500; transition: 0.3s; }
        nav ul li a:hover { color: #1a73e8; }
        .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; }
        /* Hero Section */
    

  .hero-section {
      position: relative;
      height: 90vh;
      background-color: #000;
      overflow: hidden;
    }
    .hero-section video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(2, 59, 112, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      text-align: center;
    }
    .hero-overlay h1 {
      font-size: 2.4rem;
      font-weight: 700;
    }

    /* Cards */
    .info-card {
      background-color: #fff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .info-card:hover {
      transform: translateY(-5px);
    }
    .info-card .icon {
      background-color: #023b70;
      color: #ffcc00;
      font-size: 2rem;
      padding: 15px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .info-card h5 {
      color: #023b70;
      font-weight: 600;
      margin-top: 15px;
    }

    /* Table */
    .table thead {
      background-color: #023b70;
      color: #fff;
    }

    /* CTA */
    .cta-section {
      background-color: #023b70;
      color: #fff;
      padding: 60px 0;
      text-align: center;
    }
    .btn-custom {
      background-color: #ffcc00;
      color: #023b70;
      font-weight: 600;
      border-radius: 30px;
      padding: 10px 25px;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background-color: #fff;
      color: #023b70;
    }
    header {
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 4px solid #eb1736;
    }
    .header-container {
      display: flex; justify-content: space-between; align-items: center;
      padding: 20px 0;
    }
    .mobile-menu-btn { display: none; background: none; border: none; font-size: 1.5rem; cursor: pointer; }
    
    
    .video-thumbnail {
      width: 100%;
      display: block;
      border-radius: 20px;
    }
    .play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #ff6600;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 80px;
      height: 80px;
      font-size: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .play-button:hover {
      background-color: #e65c00;
      transform: translate(-50%, -50%) scale(1.1);
    } 
    iframe, video {
      border: none;
      width: 100%;
      height: 400px;
      display: none;
      border-radius: 20px;
    }
.feature-card:hover .icon-circle {
  transform: rotate(10deg) scale(1.1);
  background-color: #012b52;
}

.feature-card {
  transition: all 0.3s ease;
}

.feature-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
        /* Two Column Section */
        .two-column {
  background: #f4f8ff;
  padding: 80px 0;
}

.level-card-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.level-card {
  background: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-left: 6px solid #023b70;
}
h2.breadcrumb-title {
    font-family: 'Montserrat', sans-serif;
    font-size: 44px;
    font-weight: bold;
}

.level-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.level-card h3 {
  color: #023b70;
  font-size: 1.2rem;
  margin-bottom: 10px;
}

.achievement-image {
  position: relative;
  text-align: center;
}

.achievement-image img {
  width: 100%;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.floating-card {
  position: absolute;
  bottom: -30px;
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  padding: 20px 25px;
  border-radius: 12px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
  width: 80%;
  text-align: center;
}

.floating-card h4 {
  color: #023b70;
  margin-bottom: 6px;
}
        .column { flex: 1; }
        .image-grid {
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;
        }
        .grid-image {
            border-radius: 8px; overflow: hidden; height: 200px; background-color: #e8f0fe;
        }
        footer {
            background-color: #222; color: #fff; padding: 0px 0 10px;
        }
        .footer-container {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
        }
        .footer-bottom {
            text-align: center; border-top: 1px solid #444;
            padding-top: 30px; color: #bbb; font-size: 0.9rem;
        }
        table{
    width:100%;
    border-collapse:collapse;
    min-width:900px; /* match screenshot layout */
  }

  thead th{
    background:var(--accent);
    color:#fff;
    text-align:left;
    padding:18px;
    font-weight:700;
    vertical-align:middle;
    font-size:15px;
  }

  tbody tr{
    border-bottom:1px solid #e9ecef;
  }

  tbody tr:nth-child(even){
    background:var(--muted);
  }

  td{
    padding:18px;
    vertical-align:middle;
    font-size:14px;
  }
  thead{
    background: #116aa0;;
  }

  .program-title{
    font-weight:700;
    margin-bottom:6px;
  }
  .program-sub{
    color:#6b6f71;
    font-size:13px;
  }

  .lang, .date, .time{
    color:#2f2f2f;
  }

  .time small{
    display:block;
    color:#2f6f91;
    margin-top:6px;
    font-size:13px;
  }

  .enroll-cell{
    text-align:center;
    width:130px;
  }

  .btn-enroll{
    display:inline-block;
    padding:10px 18px;
    background:#116aa0;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-weight:600;
    border:0;
    cursor:pointer;
  }

        @media (max-width: 768px) {
            .hero-container, .two-column-container { flex-direction: column; }
            .features-grid { grid-template-columns: 1fr; }
            nav ul { display: none; }
            .mobile-menu-btn { display: block; }

            #hero {
    height: 80vh;
  }
  #hero h1 {
    font-size: 1.8rem;
  }
  #hero p {
    font-size: 1rem;
  }
        }

    </style>

<section class="breadcrumb-section text-white py-3" style="width:100%;margin-top:20px;margin-bottom:60px">
  <div class="container" style="background: #023b70;
    padding: 10px;
    width: 48%;
    height: 108px;">
            <button class="btn btn-cta btn-primary text-white me-3" style="position: relative;    top: -12px;
    left: -400px;" onclick="history.back()">
  ← Go Back
</button>
    <div class="row align-items-center justify-content-between">
      <!-- Left: Page Title -->
      <div class="col-md-9 col-12">
        <h4 class="mb-0 " style="font-family: 'Montserrat', sans-serif;font-size: 20px;font-weight: bold;padding: 10px; text-align:center;margin-top: -57px;">12 STEPS TO PROGRESSIVE LEARNING - LUNAR</h4> 
      </div>

      <!-- Right: Logo -->
      <div class="col-md-3 col-12 text-md-end text-center mt-2 mt-md-0">
        <img src="https://marrs.in/images/Lunar_logo.png" 
             alt="Lunar Assessment Logo" 
             style="    width: 268px;
    margin-top: -68px;
    margin-left: 142px;">
      </div>
    </div>
  </div>
</section>
<!-- Hero -->
<!-- Hero Section (Bootstrap Video Promotion) -->

<section class="hero-section position-relative">
  <div class="video-wrapper">
    <!-- Thumbnail -->
    <img src="https://marrs.in/newassets/lthumb.png" 
         alt="Video Thumbnail" 
         class="video-thumbnail" 
         id="thumbnail">

    <!-- Play Button -->
    <button class="play-button" id="playBtn">
      ▶
    </button>

    <!-- Video -->
    <video id="videoPlayer" controls>
      <source src="https://marrs.in/newassets/MaRRS_LUNAR_ASSESSMENTS_Promo_Video_2025.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>

  
</section>

<script>
    const playBtn = document.getElementById('playBtn');
    const video = document.getElementById('videoPlayer');
    const thumb = document.getElementById('thumbnail');

    playBtn.addEventListener('click', () => {
      thumb.style.display = 'none';
      playBtn.style.display = 'none';
      video.style.display = 'block';
      video.play();
    });
  </script>
<section class="py-5 bg-light mt-2">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">

        <!-- Light Content Box -->
        <div class="bg-white text-center p-5 rounded-4 shadow-sm">

          <h1 class="fw-bold display-6 mb-3 text-dark">
            Launch Your Child’s Learning Journey
          </h1>

          <p class="lead mb-4 mx-auto text-muted" style="max-width: 650px;">
            Join thousands of learners exploring fun, skill-based tests designed to build confidence and creativity.
          </p>

          <!-- CTA Buttons -->
          <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mt-4">

            <a href="/lunar_weekly_study_schedule.php"
               class="btn btn-lg px-4 py-3 rounded-pill"
               style="background-color:#e0f2fe;color:#023b70;">Weekly Study Schedule
            </a>

            <a href="/lunar_guide_parent.php"
               class="btn btn-lg px-4 py-3 rounded-pill"
               style="background-color:#fef3c7;color:#92400e;">
              Guide to Parents
            </a>

            <a href="https://marrs.in/lunar/Register/associatelink/3"
               class="btn btn-lg px-4 py-3 rounded-pill text-white"
               style="background-color:#023b70;">
              Register Now
            </a>

          </div>

        </div>
        <!-- /Light Content Box -->

      </div>
    </div>
  </div>
</section>




<!-- Features -->
<!-- Features Section (Bootstrap 5 Redesigned) -->
<section id="features" class="py-5" style="background-color: #f4f8ff;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="color: #023b70;">Why Choose Lunar Skill Tests?</h2>
      <p class="text-muted mt-3">
        Empowering young learners through interactive, engaging, and measurable learning experiences.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-mortarboard-fill"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Curriculum-Aligned Tests</h5>
          <p class="text-muted mb-0">
            All our tests follow grade-wise learning objectives designed by expert educators.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-bar-chart-fill"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Smart Performance Reports</h5>
          <p class="text-muted mb-0">
            Get instant, detailed insights into your child’s strengths and improvement areas.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-emoji-smile-fill"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Fun & Engaging Experience</h5>
          <p class="text-muted mb-0">
            Gamified challenges and badges make learning exciting and stress-free for every child.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-globe2"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Accessible Anytime</h5>
          <p class="text-muted mb-0">
            Take tests anywhere, anytime — from your laptop, tablet, or mobile.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-award-fill"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Achievements & Rewards</h5>
          <p class="text-muted mb-0">
            Earn digital certificates and rank badges that celebrate every success.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm feature-card text-center p-4">
          <div class="icon-circle mx-auto mb-3">
            <i class="bi bi-lightbulb-fill"></i>
          </div>
          <h5 class="fw-semibold" style="color:#023b70;">Skill-Based Learning</h5>
          <p class="text-muted mb-0">
            Focused on conceptual understanding, creativity, and problem-solving skills.
          </p>
        </div>
      </div>
    </div>
    
  </div>
</section>

<!-- Two Column Section (Redesigned) -->
<section class="two-column" style="background: #f4f8ff; position: relative; overflow: hidden;">
  <div class="container two-column-container bg-white text-center p-5 rounded-4 shadow-sm">
    <div class="column">
      <h2 style="color: #023b70;">Celebrate Every Achievement</h2>
      <p style="margin-bottom: 20px; color: #444;">
        At Lunar Skill Tests, every milestone matters. We believe in recognising every step forward
        and nurturing a love for learning through rewards and positive encouragement.
      </p>

      <div style="display: flex; flex-direction: column; gap: 12px; font-size: 1rem;">
        <div> <strong>Digital Certificates</strong> for every completed test.</div>
        <div><strong>Medals & Recognition</strong> for top performers in each series.</div>
        <div> <strong>Personalised feedback</strong> to help students improve consistently.</div>
      </div>

       </div>
<div class="column">
      <h2 style="color: #023b70;"> Empowering Learning Through Progressive Levels</h2>
      <p style="margin-bottom: 15px; color: #444;">Our learning model grows with your child — from basic understanding to expert application.</p>

      <div class="level-card-container">
        <div class="level-card">
          <h3>Starter</h3>
          <p><em>“What is it?”</em><br>Focus on basic knowledge and comprehension.</p>
        </div>
        <div class="level-card">
          <h3>Mover</h3>
          <p><em>“How do I do it?”</em><br>Apply learned concepts in practical scenarios.</p>
        </div>
        <div class="level-card">
          <h3>Flyer</h3>
          <p><em>“How can I master it?”</em><br>Collaborate, innovate, and solve advanced challenges.</p>
        </div>
      </div>
    </div>

   
  </div>
  <div class="row text-center">
   <a href="https://marrs.in/lunar/Register/associatelink/3" class="btn btn-primary w-100">Enroll</a> 
    
</div>
</section>





<?php include('footer.php');?>

</body>
</html>
