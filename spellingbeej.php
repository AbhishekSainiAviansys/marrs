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
      margin: 1rem;
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
      padding: 10px 0;
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


  <!-- 🏫 Breadcrumb Section -->
  <section class="breadcrumb-section text-white">
    <div class="container-fluid" style="background: #023b70; padding: 10px;">
        
              <button class="btn btn-cta btn-primary text-white my-3" style="position: relative;
    top: -2px;" onclick="history.back()">
  ← Go Back
</button>
      <div class="row align-items-center justify-content-between">
        <div class="col-md-9 col-12">
          <h4 class="mb-0 text-center" style="font-size: 32px;font-weight: bold;">
            Unlock Your Child's Potential with Language & Spelling!
          </h4>
        </div>
        <div class="col-md-3 col-12 text-md-end text-center mt-2 mt-md-0">
          <img src="https://marrs.in/newassets/misbj-slide-logo.jpg" alt="misbj Logo" style="width:65px;">
        </div>
      </div>
    </div>
  </section>

 <section class="hero-section position-relative">
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
         
      <h2 class="fw-bold text-primary">Give Your Junior KG & Senior KG Child the Ultimate Head Start</h2>
      <p class="text-muted mt-3">
        Early language development is one of the most crucial parts of your child's growth. It lays the foundation for success in so many areas!
      </p>
            <p class="text-center">
        The very young children in Kindergarten (Junior KG & Senior KG) can learn words and spelling through engaging, creative assignments and spelling activities. 
        A strong linguistic base supports your child's ability to:
      </p>
    </div>

    <div class="container mb-5">
<div class="d-flex flex-wrap btn-group-custom gap-3">
                                <a href="misbj_parent_guide.php" class="btn btn-outline-primary btn-lg px-4 flex-fill">
                                    📖 Guide to Parents and Teachers
                                </a>
                                <a href="/misbj_weekly_schedule.php" class="btn btn-outline-warning btn-lg px-4 flex-fill">
                                    📅 Weekly Practice Schedule
                                </a>
                            </div>
      <div class="row g-4 text-center mt-4">
        <div class="col-md-4">
          <div class="card info-card p-4">
            <div class="icon mx-auto"><i class="bi bi-chat-dots-fill"></i></div>
            <h5>Communicate & Understand</h5>
            <p>Express ideas effectively and understand feelings.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card info-card p-4">
            <div class="icon mx-auto"><i class="bi bi-lightbulb-fill"></i></div>
            <h5>Think & Solve Problems</h5>
            <p>Boosts memory, reasoning, and problem-solving skills.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card info-card p-4">
            <div class="icon mx-auto"><i class="bi bi-people-fill"></i></div>
            <h5>Build Relationships</h5>
            <p>Encourages teamwork, empathy, and communication.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="https://marrs.in/newassets/img_3.jpg" alt="Language Learning" width="600" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
          <h3 class="fw-bold text-primary mb-3">Why Start Now? The Power of Early Learning</h3>
          <p>Starting your child's language journey as young as possible gives them an unparalleled advantage, especially with foreign languages. Once a foreign language is learned, it gets easier to learn others!</p>
          <blockquote class="blockquote border-start border-3 ps-3 text-secondary">
            “The ability to understand more words can spark a lifelong love for language, reading, and learning in children.”
          </blockquote>
          <p class="mt-3">
            The literacy, cognitive, and life skills they develop have benefits that reach far beyond mere spelling, impacting every aspect of life and communication.
          </p>
        </div>
      </div>
    </div>

    <div class="container mt-5 text-center">
      <div class="text-center mb-4">
        <h3 class="fw-bold text-primary">Supercharge Their Skills with MaRRS Spelling Bee-Junior</h3>
        <p class="text-muted">Participating in the MaRRS Spelling Bee-Junior makes foundational learning exciting and rewarding!</p>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
          <thead>
            <tr>
              <th>Level</th>
              <th>Focus</th>
              <th>Progression</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1. School Level</td>
              <td>Building foundation and local recognition.</td>
              <td>Qualify to move to the National Prelims.</td>
            </tr>
            <tr>
              <td>2. National Prelims</td>
              <td>Competing against peers at a wider level.</td>
              <td>Top performers proceed to the National Championship.</td>
            </tr>
            <tr>
              <td>3. National Championship</td>
              <td>Showcasing top talent in the country.</td>
              <td>Qualify for the ultimate International Championship.</td>
            </tr>
            <tr>
              <td>4. Primary Colors - The International Championship</td>
              <td>The grand finale! Compete on a global stage.</td>
              <td>Achieve international recognition and prestige.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <a href="#" class="btn btn-custom me-3" class="text-center">View Syllabus for Junior KG & Senior KG</a> 
    </div>
  </section>

  <!-- 🚀 CTA -->
  <section class="cta-section">
    <div class="container">
      <h3 class="fw-bold mb-3">Ready to Enrol Your Little Learner?</h3>
      <p class="mb-4">Give your child the lifelong gift of language mastery and communication skills. The journey begins today!</p>
      <a href="/signin?tab=register" class="btn btn-custom me-3">Register for MaRRS Spelling Bee-Junior Today!</a>
      <a href="/addschool" class="btn btn-custom me-3">Spark a Revolution — Enrol Your School Today</a>
    </div>
  </section>
<?php include('footertest.php');?>

