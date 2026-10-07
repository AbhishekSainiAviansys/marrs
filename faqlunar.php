<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - Lunar Skill Tests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f0f5ff, #e9f0ff);
      font-family: "Poppins", sans-serif;
      color: #023b70;
    }
    header {
    padding: 20px 0;
    background: #ffff;
    color: #005891;
    border-bottom: 4px solid var(--brand-red);
}
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
    .logo {
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    color: var(--brand-red);
}
nav ul {
    display: flex;
    list-style: none;
}
nav ul li {
    margin-left: 30px;
}
nav ul li a {
    text-decoration: none;
    color: var(--brand-blue);
    font-weight: 500;
    transition: color 0.3s;
    font-family: 'Roboto Slab', serif;
    font-size: 16px;
    font-weight: 400;
    text-transform: uppercase;
    
}
p{
  font-family: "Poppins", sans-serif;
}
h1,h2,h3,h4{
  font-family: "Poppins", sans-serif;
}
nav ul li a:hover {
    color: var(--brand-red);
}
.nav-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
}
.bar {
    width: 25px;
    height: 3px;
    background: var(--brand-red);
    margin: 4px 0;
}
    .faq-section {
      
      padding: 30px;
      
    }

    .faq-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .faq-header h2 {
      font-weight: 700;
      color: #023b70;
    }

    .faq-header p {
      color: #5a6b8b;
      font-size: 16px;
    }

    .accordion-item {
      border: none;
      background: #f8faff;
      margin-bottom: 15px;
      border-radius: 15px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .accordion-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.07);
    }

    .accordion-button {
      background: transparent;
      font-weight: 600;
      color: #023b70;
      box-shadow: none !important;
    }

    .accordion-button::after {
      background-image: url('https://cdn-icons-png.flaticon.com/512/748/748113.png');
      background-size: 16px;
      transform: rotate(0deg);
      transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
      transform: rotate(180deg);
    }

    .accordion-body {
      background: #fff;
      border-top: 1px solid #e2e6f0;
      color: #4a5876;
      line-height: 1.7;
      padding: 20px 25px;
    }

    .faq-category {
      font-weight: 600;
      font-size: 1.1rem;
      color: #1e4fa1;
      margin-top: 40px;
      margin-bottom: 15px;
      align-items: center;
      gap: 10px;
    }

    .faq-category i {
      color: #1e4fa1;
    }
     .footer-banner{
   color:#000; padding:18px; display:flex; justify-content:center; align-items:center;border-top: 4px solid #eb1736;
  }
  .footer-links a{ color:#000; margin:0 8px; text-decoration:none; font-size:.95rem; }
.slide.full-bg {
    background-size: cover;
    background-position: center;
    color: var(--text);
  }
  .slide .overlay {
    position:absolute;inset:0;background:var(--dark-overlay);z-index:1;
  }
  .slide .slide-content { z-index:2; max-width:1100px; width:100%; }
  </style>
</head>
<body>
<header>
         <div class="container header-container">
            <a class="navbar-brand" href="#">
            <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo" width="240px">
            </a>
            <div class="nav-toggle" aria-label="Open Navigation">
               <div class="bar"></div>
               <div class="bar"></div>
               <div class="bar"></div>
            </div>
            <nav>
               <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="/about_marrs">About us</a></li>
                  <li><a href="#">Products</a></li>
                  <li><a href="#">Gallery</a></li>
                  <li><a href="#">Contact us</a></li>
                  <li><a href="#">Login</a></li>
               </ul>
            </nav>
         </div>
      </header>
  <section class="faq-section">
<div class="container">
    <div class="faq-header">
      <h2>Frequently Asked Questions (FAQ)</h2>
      <p>Find answers about the <strong>Lunar Skill Tests</strong> program, structure, enrollment, and rewards.</p>
    </div>

    <!-- About Lunar Skill Tests -->
    <div class="faq-category text-center"><h4 class="fw-bold "> About Lunar Skill Tests </h4></div>
    <div class="accordion" id="faqAccordion1">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
            Q: What are Lunar Skill Tests?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
            Lunar Skill Test is an affordable, comprehensive online assessment program designed to boost academic performance and confidence for students from Grade 1 to 12.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
            Q: Which grades are covered by the program?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
            We offer skill tests and preparatory materials for students in Grade 1 through 12.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
            Q: Are the tests available online?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
            Yes, all testing is 100% online — your child can learn and take tests from anywhere, anytime, offering maximum convenience and flexibility.
          </div>
        </div>
      </div>
    </div>

    <!-- Testing Structure -->
    <div class="faq-category text-center"><h4 class="fw-bold ">Testing Structure and Progress</h4></div>
    <div class="accordion" id="faqAccordion2">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
            Q: How often can my child take a test?
          </button>
        </h2>
        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
            You can choose a testing frequency that fits your child's schedule — daily, weekly, or monthly tests are available for continuous progress tracking.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
            Q: How are the assessments structured?
          </button>
        </h2>
        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
            Our assessments follow a progressive approach across three levels: <br>
            <strong>Starter:</strong> Basic knowledge (“What is it?”) <br>
            <strong>Mover:</strong> Applying concepts (“How do I do it?”) <br>
            <strong>Flyer:</strong> Advanced problem-solving.
          </div>
        </div>
      </div>
       <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq12">
            Q: How will I understand my child's performance?
          </button>
        </h2>
        <div id="faq12" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
            We use National Percentile Grading, which allows you to see exactly how your child's performance compares to their peers across the country. The assessments also provide deep insights into strengths and areas for improvement. <br>
                     </div>
        </div>
      </div>
    </div>

    <!-- Enrollment -->
    <div class="faq-category text-center"><h4 class="fw-bold"> Enrollment, Cost, and Resources</h4></div>
    <div class="accordion" id="faqAccordion3">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq6">
            Q: How much do Lunar Skill Tests cost?
          </button>
        </h2>
        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
          <div class="accordion-body">
            We offer high-quality assessments at an affordable monthly price, which includes access to four tests per month.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq7">
            Q: Are study materials included with the enrollment?
          </button>
        </h2>
        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
          <div class="accordion-body">
            Yes, access to comprehensive preparatory materials is included. Additional resources can be purchased for further support.
          </div>
        </div>
      </div>
    </div>

    <!-- Rewards -->
    <div class="faq-category text-center"><h4 class="fw-bold"> Rewards and Recognition</h4></div>
    <div class="accordion" id="faqAccordion4">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq8">
            Q: How are achievements recognised?
          </button>
        </h2>
        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion4">
          <div class="accordion-body">
            We celebrate every step of progress! Students receive <strong>Digital Certificates</strong> after every test and <strong>Medals</strong> for top performance.
          </div>
        </div>
      </div>
    </div>
 </div>
  </section>
<div class="footer-banner">
         <div class="container d-flex justify-content-between align-items-center footer-links" style="max-width:1100px;">
            <div>
               <span><i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-square-instagram"></i><i class="fa-brands fa-linkedin"></i><i class="fa-brands fa-youtube"></i></span>
               <strong style="color:#000;padding-left: 20px;">MaRRS Rediscover</strong> : © 2025 MaRRS Rediscover. All rights reserved.
            </div>
            <div>
               <a href="#">Terms &amp; Conditions</a> |
               <a href="#">Privacy Policy</a> |
               <a href="#">Contact</a>
            </div>
         </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
