<?php include('header.php');?>
      <style>
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
    z-index: -1;        /* ðŸ‘ˆ MUST be negative */
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

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

  
    /* Animated Header */
    .top-header {
      background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
      padding: 1rem 0;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .top-header img {
      width: 100%;
      height: auto;
      display: block;
    }

    /* Hero Section */
    .hero-section {
     
      padding: 2rem 0;
      position: relative;
      overflow: hidden;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      width: 300%;
      height: 300%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: moveGrid 20s linear infinite;
      opacity: 0.3;
    }

    @keyframes moveGrid {
      0% { transform: translate(0, 0); }
      100% { transform: translate(50px, 50px); }
    }

    .logo-container {
      position: relative;
      z-index: 2;
      animation: fadeInUp 1s ease-out;
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

    .logo-image {
      max-width: 500px;
      width: 100%;
      height: auto;
      filter: drop-shadow(0 10px 30px rgba(0,0,0,0.3));
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    /* Section Styling */
    .content-section {
      background: white;
      border-radius: 30px;
      padding: 3rem 2rem;
      margin: 2rem 0;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      position: relative;
      overflow: hidden;
      animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .content-section::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(102,126,234,0.1) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
      pointer-events: none;
      z-index: 0;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .content-section > * {
      position: relative;
      z-index: 1;
    }

    h2 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 1.5rem;
      position: relative;
      display: inline-block;
    }

    h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      border-radius: 2px;
    }

    .lead {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #4a5568;
    }

    /* Modern Table */
    .modern-table {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      margin: 2rem 0;
    }

    .modern-table table {
      margin: 0;
      border: none;
    }

    .modern-table thead {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .modern-table thead th {
      padding: 1.2rem;
      font-weight: 600;
      border: none;
      text-transform: uppercase;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
    }

    .modern-table tbody tr {
      transition: all 0.3s ease;
    }

    .modern-table tbody tr:hover {
      background: linear-gradient(90deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1));
      transform: scale(1.01);
    }

    .modern-table tbody td,
    .modern-table tbody th {
      padding: 1.2rem;
      border-bottom: 1px solid #e2e8f0;
    }

    .modern-table tbody tr:last-child td {
      border-bottom: none;
    }

    /* CTA Buttons */
    .cta-button {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 1rem 3rem;
      border-radius: 50px;
      font-size: 1.2rem;
      font-weight: 600;
      border: none;
      box-shadow: 0 10px 30px rgba(102,126,234,0.4);
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      margin: 1rem 0;
    }

    .cta-button:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(102,126,234,0.6);
      color: white;
    }

    /* Syllabus Grid */
    .syllabus-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin: 2rem 0;
    }

    .syllabus-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 2rem 1.5rem;
      border-radius: 20px;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      position: relative;
      overflow: hidden;
    }

    .syllabus-card::before {
      content: '📚';
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 2rem;
      opacity: 0.3;
    }

    .syllabus-card:hover {
      transform: translateY(-10px) scale(1.05);
      box-shadow: 0 15px 40px rgba(102,126,234,0.4);
      color: white;
    }

    /* Pulse Animation */
    .pulse-text {
      animation: pulse 2s ease-in-out infinite;
      display: inline-block;
      font-weight: 700;
      color: #e53e3e;
      background: #fff5f5;
      padding: 0.5rem 1.5rem;
      border-radius: 25px;
      box-shadow: 0 0 20px rgba(229,62,62,0.3);
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 20px rgba(229,62,62,0.3);
      }
      50% {
        transform: scale(1.05);
        box-shadow: 0 0 30px rgba(229,62,62,0.5);
      }
    }

    /* Info Cards */
    .info-card {
      background: linear-gradient(135deg, #f6f9fc 0%, #e9ecef 100%);
      border-left: 5px solid #667eea;
      padding: 1.5rem;
      border-radius: 15px;
      margin: 1rem 0;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    /* Footer */
    .footer {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      color: white;
      padding: 3rem 0 2rem;
      margin-top: 4rem;
    }

    .footer p {
      margin: 0.5rem 0;
      opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .logo-image {
        max-width: 300px;
      }

      .content-section {
        padding: 2rem 1rem;
      }

      h2 {
        font-size: 1.5rem;
      }

      .syllabus-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
      }
    }
  </style>

  
  
  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
        <button class="btn btn-cta btn-primary text-white me-3" style="position: relative; float:left;left: -40px;" onclick="history.back()">
      ← Go Back
    </button>
      <div class="logo-container text-center">
        <img src="https://marrs.in/images/zoomlandinglogo.png" style="height:200px" class="logo-image" alt="Math Zoom Zoom Logo">
      </div>
    </div>
  </section>
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-lg-8">
        <h2 class="fw-bold mb-3">
          Zoom Your Child's Numerical Skills!
        </h2>
        <h4 class="text-primary fw-semibold mb-3">
          The MaRRS Zoom Zoom Math Challenge is Here!
        </h4>
        <p class="lead text-muted text-black">
          Is your child ready to build confidence and excel in mathematics?
          We’re thrilled to invite students from across the nation to participate
          in a delightful and engaging <strong>National Level Math Activity</strong> from MaRRS!
        </p>
      </div>
    </div>

    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="mb-3 fs-1 text-primary">
              📘
            </div>
            <h5 class="card-title fw-bold">
              Boost Academic Performance
            </h5>
            <p class="card-text text-muted">
              The challenge syllabus aligns with the regular academic curriculum,
              offering excellent practice that directly supports annual school assessments.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="mb-3 fs-1 text-success">
              🏆
            </div>
            <h5 class="card-title fw-bold">
              National Recognition
            </h5>
            <p class="card-text text-muted">
              A structured competition format provides multiple opportunities
              to shine and win exciting awards at a national level.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body text-center p-4">
            <div class="mb-3 fs-1 text-warning">
              📥
            </div>
            <h5 class="card-title fw-bold">
              Accessible Learning
            </h5>
            <p class="card-text text-muted">
              Free downloadable learning material is available immediately
              after registration to kickstart your child’s preparation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="row mt-5 justify-content-center">
  <div class="col-auto mb-3">
    <a href="/zoomzoom_roadmap.php" class="btn btn-primary btn-lg px-5">
     Weekly learning plan
    </a>
  </div>

  <div class="col-auto mb-3">
    <a href="/zoomzoom_guideParent.php" class="btn btn-outline-primary btn-lg px-5">
      Guide to Parents
    </a>
  </div>

  <div class="col-auto mb-3">
    <a href="" class="btn btn-success btn-lg px-5">
      Register Now
    </a>
  </div>
</div>

  </div>
</section>

<section class="py-5" style="    background: #fff;">
  <div class="container">

    <!-- Who Can Participate -->
    <div class="row mb-5">
      <div class="col text-center">
        <h2 class="fw-bold mb-3">Who Can Participate?</h2>
        <p class="text-muted mb-4">
          The MaRRS Zoom Zoom Math Challenge is open to students from:
        </p>

        <div class="row justify-content-center g-3">
          <div class="col-md-2 col-6">
            <div class="p-3 border rounded fw-semibold">Junior KG</div>
          </div>
          <div class="col-md-2 col-6">
            <div class="p-3 border rounded fw-semibold">Senior KG</div>
          </div>
          <div class="col-md-3 col-12">
            <div class="p-3 border rounded fw-semibold">Grades 1 to 8</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Competition Format -->
    <div class="row mb-5">
      <div class="col text-center mb-4">
        <h2 class="fw-bold">Competition Format & Prizes</h2>
        <p class="text-muted">
          The championship is structured to give students multiple chances
          to prove their numerical prowess.
        </p>
      </div>

      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>Championship Stage</th>
                <th>Number of Rounds</th>
                <th>Qualification</th>
                <th>Prizes</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="fw-semibold">Preliminary Championship</td>
                <td>Three</td>
                <td>N/A</td>
                <td>
                  Commendation Medals to all qualifiers to the Nationals
                </td>
              </tr>
              <tr>
                <td class="fw-semibold">National Championship</td>
                <td>Three</td>
                <td>Based on Preliminary Performance</td>
                <td>
                  Prizes awarded for every National Championship!
                </td>
              </tr>
              <tr>
                <td class="fw-semibold">Jumbo Nationals</td>
                <td>One</td>
                <td>
                  Based on the average percentile score of the National Championships
                </td>
                <td>
                  <strong>Major Prizes awarded!</strong>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Eligibility & Testing Format -->
    <div class="row mb-5">
      <div class="col text-center mb-4">
        <h2 class="fw-bold">Eligibility & Testing Format</h2>
      </div>

      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-light">
              <tr>
                <th>Class Level</th>
                <th>Format</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="fw-semibold">Jr. KG & Sr. KG</td>
                <td>Oral Rounds Only</td>
                <td>
                  Fun, engaging way to introduce early math concepts.
                </td>
              </tr>
              <tr>
                <td class="fw-semibold">Grade 1 to Grade 8</td>
                <td>Online Test</td>
                <td>
                  Standardized, convenient online testing format.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

 <div class="row">
      <div class="col text-center">
        <h3 class="fw-bold mb-3">
          Ready to empower your child’s math journey?
        </h3>
        <p class="text-muted mb-4">
          Register today and download your <strong>FREE learning material!</strong>
        </p>
        <a href="#" class="btn btn-primary btn-lg px-5">
          REGISTER NOW
        </a>
      </div>
    </div>
  </div>
</section>


  <!-- Main Content -->
  <div class="container my-5">
    
    <!-- Introduction -->
    <div class="content-section">
      <h2 class="text-center mb-4"> A National Level Math Activity Conducted Online</h2>
      <p class="lead text-center">
        The <strong>MaRRS Math Zoom Zoom Championship</strong> comprises:
      </p>
      <div class="row text-center mt-4">
        <div class="col-md-4">
          <h3 style="color: #667eea;">3</h3>
          <p><strong>Preliminary Championships</strong></p>
        </div>
        <div class="col-md-4">
          <h3 style="color: #764ba2;">3</h3>
          <p><strong>National Championships</strong></p>
        </div>
        <div class="col-md-4">
          <h3 style="color: #667eea;">1</h3>
          <p><strong>Jumbo National</strong></p>
        </div>
      </div>
      <p class="lead text-center mt-4">
        Participants of the National Championships will qualify for the Jumbo National based on an average percentile of their scores.
        Prizes awarded at every level! The syllabus is designed to complement academic curriculum and help with annual assessments.
      </p>
    </div>

    <!-- Competition Format -->
    <div class="content-section">
      <h2 class="text-center mb-4"> Competition Format & Prizes</h2>
      <p class="lead text-center mb-4">Where Your Child's Success is Rewarded!</p>
      
      <div class="modern-table">
        <table class="table text-center mb-0">
          <thead>
            <tr>
              <th>Championship Stage</th>
              <th>Number of Rounds</th>
              <th>Qualification</th>
              <th>Prize Impact & Recognition</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Preliminary Championship</th>
              <td>Three</td>
              <td>N/A</td>
              <td><strong>Commendation Medals</strong> awarded to all qualifiers who advance to the National stage!</td>
            </tr>
            <tr>
              <th>National Championship</th>
              <td>Three</td>
              <td>Based on Preliminary Performance</td>
              <td><strong>Significant Prizes</strong> awarded for excellence in every National Championship round!</td>
            </tr>
            <tr>
              <th>Jumbo Nationals</th>
              <td>One</td>
              <td>Based on average percentile score</td>
              <td><strong>Ultimate Glory! Major Prizes</strong> - Trophies, Cash Awards, Certificates of Distinction!</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Eligibility -->
    <div class="content-section">
      <h2 class="text-center mb-4"> Eligibility & Testing Format</h2>
      
      <div class="modern-table">
        <table class="table text-center mb-0">
          <thead>
            <tr>
              <th>Class Level</th>
              <th>Format</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Jr. KG & Sr. KG</th>
              <td>Oral Rounds Only</td>
              <td>Fun, engaging way to introduce early math concepts</td>
            </tr>
            <tr>
              <th>Grade 1 to Grade 8</th>
              <td>Online Test</td>
              <td>Standardized, convenient online testing format</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Registration -->
    <div class="content-section">
      <h2 class="text-center mb-4">Registration Information</h2>
      
      <div class="info-card">
        <p class="lead mb-2"><strong>💰 Registration Fee:</strong> Rs. 1900/- for participation in <strong>one complete Quarterly Cycle</strong> (e.g., Q1 Prelims + Q1 Finals)</p>
      </div>
      
      <div class="info-card">
        <p class="lead mb-2"><strong>✨ Zero Additional Fees:</strong> All students who qualify from any quarterly prelims are automatically eligible for finals of the same quarter <strong>without any extra charge!</strong></p>
      </div>

      <div class="text-center mt-5">
        <h3 class="mb-4">Ready to empower your child's math journey?</h3>
        <p class="lead mb-4">Register today and download your FREE learning material!</p>
        <a href="https://marrs.in/zoomzoom/welcome/registration_log" class="cta-button">🚀 Register Now</a>
      </div>
    </div>

    <!-- Syllabus Download -->
    <div class="content-section">
      <h2 class="text-center mb-4">📚 Download Syllabus</h2>
      <p class="text-center mb-4">
        <span class="pulse-text">Start Learning Today!</span>
      </p>
      
      <div class="syllabus-grid">
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_JrKG_Syllabus.pdf" target="_blank" class="syllabus-card">
          LKG (Jr. KG)
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_SrKG_Syllabus.pdf" target="_blank" class="syllabus-card">
          UKG (Sr. KG)
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_1__Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 1
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_2_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 2
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_3_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 3
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_4_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 4
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_5_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 5
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_6_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 6
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_7_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 7
        </a>
        <a href="https://marrs.in/zoomzoom_syllabus/update_syllabus/MaRRS Math Zoom Zoom Challenge_Grade_8_Syllabus.pdf" target="_blank" class="syllabus-card">
          Class 8
        </a>
      </div>
    </div>

  </div>

  <!-- Footer -->
 <?php include('footer.php');?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>