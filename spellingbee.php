<?php include('headertest.php');?>

  <style>
 

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
  </style>

  

 <section class="hero-section position-relative">
     <button onclick="history.back()" class="btn btn-outline-light mb-4" style="    position: relative;
    top: 20px;left: 20px;">← Go Back</button>
  <div class="video-wrapper">
    <!-- Thumbnail -->
    <img src="https://marrs.in/newassets/video_bg.png" 
         alt="Video Thumbnail" 
         class="video-thumbnail" 
         id="thumbnail">

    <!-- Play Button -->
    <button class="play-button" id="playBtn">
      ▶
    </button>

    <!-- Video -->
    <video id="videoPlayer" controls>
      <source src="https://marrs.in/newassets/MISBandMISBJ.mp4" type="video/mp4">
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


  <!-- 📘 Content Section -->
  <section class="py-4">
    <div class="container text-center mb-5">
      <h2 class="fw-bold text-primary">MaRRS International Spelling Bee: Unlock Your Child's Full Potential</h2>
      <p class="text-muted mt-3">
       The World's Largest Stage for Language Learning
      </p>
            <p class="text-center">
        The MaRRS International Spelling Bee (MISB) is the flagship enterprise of MaRRS Rediscover and the world's largest language learning competition.<br>

For over two decades, we have championed language acquisition and lexical development on a global scale.<br>

Language learning is the bridge to a better world. Start the journey with MISB.<br>
      </p>
    </div>

    <div class="container mb-5">
 <!-- Two New Buttons -->
                            <div class="d-flex flex-wrap btn-group-custom gap-3">
                                <a href="/misb_guide_parents.php" class="btn btn-outline-primary btn-lg px-4 flex-fill">
                                    📖 Guide to Parents and Teachers
                                </a>
                                <a href="/misb_weekly_practice.php" class="btn btn-outline-warning btn-lg px-4 flex-fill">
                                    📅 Weekly Practice Schedule
                                </a>
                            </div>
     <!-- Core Value Section -->
<!-- Core Value: Three Cards Section -->



    </div>
 <section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center section-title mb-5">Core Value: Beyond the Classroom</h2>
    
    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm hover-card">
          <div class="card-body text-center p-4">
            <div class="card-icon mb-3">
              <i class="fas fa-graduation-cap display-4 text-primary mb-3"></i>
            </div>
            <h5 class="card-title fw-bold text-primary">Comprehensive Language Mastery</h5>
            <p class="card-text">
              We don't just teach spelling—we build comprehensive language mastery.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm hover-card">
          <div class="card-body text-center p-4">
            <div class="card-icon mb-3">
              <i class="fas fa-rocket display-4 text-primary mb-3"></i>
            </div>
            <h5 class="card-title fw-bold text-primary">Competitive Learning</h5>
            <p class="card-text">
              The MaRRS Spelling Bee is an invaluable tool for language improvement, initiating students into the world of competitive learning.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm hover-card">
          <div class="card-body text-center p-4">
            <div class="card-icon mb-3">
              <i class="fas fa-book-open display-4 text-primary mb-3"></i>
            </div>
            <h5 class="card-title fw-bold text-primary">Supplementary Skills</h5>
            <p class="card-text">
              Our curriculum moves far beyond the school curriculum, focusing on supplementary language skills that cultivate a desire for continuous learning.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bonus Card for Complete Content -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-5 text-center">
            <h5 class="fw-bold text-primary mb-3">Structured Language Comprehension</h5>
            <p class="lead">
              This results in a systematic and structured understanding of English, with the competition comprising various rounds covering all aspects of language comprehension.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <div class="container mt-2 text-center">
      <div class="text-center mb-3">
        <h3 class="fw-bold text-primary">Competition Structure: Levels & Categories</h3>
        <p class="text-muted">MISB is an international competition held globally for students from<strong> Grades I to XII.</strong><br>

Participants compete across six different categories based on their grade level.</p>
      </div>
      </div>
    
   <section id="structure" class="bg-light">
    <div class="container">
     
      <div class="row">
        <div class="col-lg-6">
          <h5 class="fw-bold mb-3">Categories</h5>
          <table class="table table-striped">
            <thead class="table-primary">
              <tr><th>Category</th><th>Class/Grade Level</th></tr>
            </thead>
            <tbody>
              <tr><td>I</td><td>Class 1</td></tr>
              <tr><td>II</td><td>Class 2</td></tr>
              <tr><td>III</td><td>Classes 3 & 4</td></tr>
              <tr><td>IV</td><td>Classes 5 & 6</td></tr>
              <tr><td>V</td><td>Classes 7, 8 & 9</td></tr>
              <tr><td>VI</td><td>Classes 10, 11 & 12</td></tr>
            </tbody>
          </table>
        </div>

        <div class="col-lg-6">
          <h5 class="fw-bold mb-3">Stages of Competition</h5>
          <table class="table table-striped">
            <thead class="table-primary">
              <tr><th>Stage</th><th>Eligibility</th></tr>
            </thead>
            <tbody>
              <tr><td>School Level</td><td>Open to all registered students</td></tr>
              <tr><td>Inter School Prelims</td><td>Qualifiers from the School Competition</td></tr>
              <tr><td>Inter School Finals & State Prelims</td><td>Qualifiers from the Inter School Prelims</td></tr>
              <tr><td>State Championship & National Prelims</td><td>Qualifiers from the State Prelims</td></tr>
              <tr><td>National Championship & International Prelims</td><td>Qualifiers from National Prelims</td></tr>
              <tr><td>International Level</td><td>Qualifiers from International Prelims</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

 <!-- Challenge & Advantage Section -->
    <section id="challenge" class="py-2">
      <div class="container">
        
        <!-- Challenge Header -->
        <div class="text-center mb-5">
          <h2 class="section-title">The Challenge: In-Depth Rounds</h2>
          <p class="lead">The eleven rounds of the competition are designed to go beyond simple spellings and test almost all elements of the English Language.</p>
        </div>
    
        <!-- Rounds Grid -->
        <div class="row g-4 mb-5">
          
          <!-- Written Rounds -->
          <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <h5 class="card-title fw-bold text-primary mb-4">
                  <i class="fas fa-pen-fancy me-2"></i>Key Written Rounds
                </h5>
                <p class="text-muted small mb-3">focus on core literacy and analytical skills:</p>
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dictation</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jumbled Letters</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Word Application</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Crossword</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Idioms and Phrasal Verbs</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Phonemic Awareness</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Suprasegmentals</li>
                </ul>
              </div>
            </div>
          </div>
    
          <!-- Oral Rounds -->
          <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <h5 class="card-title fw-bold text-primary mb-4">
                  <i class="fas fa-microphone me-2"></i>Key Oral Rounds
                </h5>
                <p class="text-muted small mb-3">focus on vocabulary and expressive skills:</p>
                <ul class="list-unstyled">
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Spell It: Students spell words until they make a mistake.</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Pronunciation</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Synonyms and Antonyms</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Word Origin (Etymology)</li>
                  <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Aural Skills</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    
        <!-- MaRRS Advantage Cards -->
        <div class="row g-4 mb-5">
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card text-center">
              <div class="card-body p-4">
                <i class="fas fa-clock display-4 text-primary mb-3"></i>
                <h5 class="card-title fw-bold">Self-Paced Learning</h5>
                <p class="card-text">This method significantly improves retention and fosters deep understanding.</p>
              </div>
            </div>
          </div>
    
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card text-center">
              <div class="card-body p-4">
                <i class="fas fa-star display-4 text-primary mb-3"></i>
                <h5 class="card-title fw-bold">Build Confidence</h5>
                <p class="card-text">We facilitate lexical development and build self-confidence in a healthy competitive environment, helping every student reach their full potential.</p>
              </div>
            </div>
          </div>
    
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card text-center">
              <div class="card-body p-4">
                <i class="fas fa-gamepad display-4 text-primary mb-3"></i>
                <h5 class="card-title fw-bold">Engaging Format</h5>
                <p class="card-text">The game and activity-based nature of the competition ensures the students' rapt attention and utilizes their aspirations for winning.</p>
              </div>
            </div>
          </div>
        </div>
    
        <!-- CTA Section -->
        <div class="text-center bg-primary text-white p-5 rounded-4">
          <h2 class="display-6 fw-bold mb-3">Ready to Elevate Your Child's Language Skills?</h2>
          <p class="lead mb-4">The MaRRS Advantage: Confidence & Retention</p>
          <div class="cta-group">
      <a href="/addschool" class="btn btn-warning text-sm btn-lg px-5 my-2">
        Spark a Revolution - Enroll Your School Now
        <span class="arrow">→</span>
      </a>
     <a href="/signin?tab=register" class="btn btn-light text-sm btn-lg px-5 my-2">Register Now for the Next MISB Season!</a>

    </div>
        </div>
    
      </div>
    </section>
<?php include('footertest.php');?>

