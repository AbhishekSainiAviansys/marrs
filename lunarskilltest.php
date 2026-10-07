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
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg-light);
      color: var(--text-dark);
      line-height: 1.6;
    }

    .hero-section {
      background: linear-gradient(135deg, #d4e4fa 0%, #f1e5f9 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><circle cx="200" cy="200" r="2" fill="white" opacity="0.3"/><circle cx="800" cy="300" r="1" fill="white" opacity="0.5"/><circle cx="400" cy="600" r="1.5" fill="white" opacity="0.4"/><circle cx="600" cy="100" r="1" fill="white" opacity="0.6"/><circle cx="100" cy="700" r="2" fill="white" opacity="0.3"/><circle cx="900" cy="800" r="1" fill="white" opacity="0.5"/></svg>');
      opacity: 0.2;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 800px;
      margin: auto;
      padding: 2rem;
    }

    .hero-content img {
      width: 35%;
      max-width: 200px;
      height: auto;
      margin-bottom: 1rem;
    }

    .hero-title {
      font-size: 2.5rem;
      font-weight: 700;
      background: linear-gradient(45deg, #fff, #a0aec0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 1rem;
    }

    .hero-subtitle {
      font-size: 1.3rem;
      margin-bottom: 1rem;
    }

    .hero-description {
      font-size: 1rem;
      opacity: 0.9;
      margin-bottom: 2rem;
    }

    .cta-button {
      background: linear-gradient(45deg, #4299e1, #667eea);
      padding: 0.75rem 2rem;
      border: none;
      border-radius: 50px;
      color: #fff;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .cta-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(66, 153, 225, 0.4);
    }

    section {
      padding: 4rem 0;
    }

    .section-title {
      text-align: center;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 2rem;
      color: var(--primary-color);
    }

    .feature-card, .level-card {
      background: #fefefe;
      border: 1px solid rgba(66, 153, 225, 0.08);
      border-radius: 15px;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .footer {
      background: #183659;
      color: white;
      padding: 2rem 0;
      text-align: center;
    }

    .stats-section {
      background: linear-gradient(135deg, #cbdcf5 0%, #e5dff8 100%);
      text-align: center;
      color: var(--primary-color);
    }

    .stats-section .stat-number {
      font-size: 2rem;
      font-weight: 700;
    }

    .stats-section .stat-label {
      font-size: 1rem;
      opacity: 0.8;
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }

      .hero-content img {
        width: 50%;
      }

      .section-title {
        font-size: 1.7rem;
      }
    }
  </style>
</head>
<body>
  <img src="https://marrs.in/images/header-011.jpg" alt="MaRRS Header" class="img-fluid">

  <section class="hero-section">
    <div class="hero-content">
      <img src="https://marrs.in/student_registration/certificate_logo/flunar.jpg" alt="Logo">
      <h1 class="hero-title">Lunar Skill Tests</h1>
      <p class="hero-subtitle">Launch Your Child's Learning Journey Today!</p>
      <p class="hero-description">Master Skills. Soar to Success. Affordably.
      <br> A comprehensive online assessment program for students from Grade 1 to 10.</p>
      <a href="#features" class="cta-button">Start Your Journey</a>
    </div>
  </section>

  <section id="features">
    <div class="container">
      <h2 class="section-title">Why Choose Lunar Skill Tests?</h2>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <h3>Progress Tracking</h3>
            <p>Monitor your child's progress with daily, weekly, or monthly tests.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <h3>National Ranking</h3>
            <p>See how your child performs among peers nationwide.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-card">
            <h3>Affordable Excellence</h3>
            <p>High-quality, budget-friendly assessments for every student.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="stats-section">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="stat-number">1-10</div>
          <div class="stat-label">Grades Covered</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number">100%</div>
          <div class="stat-label">Online Access</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number">24/7</div>
          <div class="stat-label">Availability</div>
        </div>
        <div class="col-md-3">
          <div class="stat-number">∞</div>
          <div class="stat-label">Growth Potential</div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <p>MaRRS Lunar Skill Tests</p>
      <p>A Product of MaRRS Intellectual Services Pvt. Ltd.</p>
      <p>&copy; Aviansys Technologies Pvt. Ltd. 2024-25</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
