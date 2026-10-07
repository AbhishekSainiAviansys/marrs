<?php include('headertest.php'); ?>
<style>
  :root {
    --primary-color: #7c3aed;
    --dark-color: #111827;
    --muted-color: #6b7280;
    --light-bg: #f9fafb;
    --radius-lg: 1.25rem;

    /* pastel additions */
    --pastel-lilac: #f5f3ff;
    --pastel-blue: #e0f2fe;
    --pastel-mint: #dcfce7;
    --pastel-peach: #ffe4e6;
    --pastel-yellow: #fef9c3;
  }

 

  .hero {
    padding: 2rem 0 6rem;
    background: radial-gradient(circle at top left, #e0f2fe 0%, #f5f3ff 40%, #ffffff 100%);
    color: #111827;
    overflow: hidden;
    position: relative;
  }

  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(circle at 10% 20%, rgba(129, 140, 248, 0.18) 0, transparent 55%),
      radial-gradient(circle at 80% 70%, rgba(244, 114, 182, 0.18) 0, transparent 55%);
    pointer-events: none;
  }

  .hero-title {
    font-weight: 700;
    font-size: clamp(2.5rem, 5vw + 1rem, 4.2rem);
    line-height: 1.1;
    letter-spacing: -0.03em;
    text-shadow: none;
    color: #111827;
  }

  .hero-subtitle {
    font-size: 1.2rem;
    max-width: 36rem;
    opacity: 0.95;
    color: var(--muted-color);
  }

  .hero-highlight {
    background: linear-gradient(135deg, #f97316, #facc15);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .science-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    padding: 0.5rem 1.2rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid #e5e7eb;
    backdrop-filter: blur(8px);
    font-weight: 600;
    color: #4b5563;
  }

  .feature-card {
    border-radius: var(--radius-lg);
    border: 1px solid #e5e7eb;
    padding: 2rem;
    background: #ffffff;
    transition: all 0.25s ease;
    height: 100%;
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.03);
  }

  .feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 24px 50px rgba(148, 163, 184, 0.18);
    border-color: rgba(129, 140, 248, 0.5);
    background: #f9fafb;
  }

  .feature-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    background: radial-gradient(circle at 30% 30%, #e0f2fe, #ddd6fe);
    color: #4c1d95;
    margin-bottom: 1rem;
  }

  .grade-table {
    background: #ffffff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: 0 16px 40px rgba(148, 163, 184, 0.18);
    border: 1px solid #e5e7eb;
  }

  .grade-table th {
    background: linear-gradient(90deg, #e0f2fe, #f5f3ff);
    color: #111827;
    font-weight: 600;
    border: none;
  }

  .grade-table tbody tr:nth-child(odd) {
    background-color: #f9fafb;
  }

  .round-card {
    background: radial-gradient(circle at top left, #fdf2ff 0%, #e0f2fe 45%, #ffffff 100%);
    color: #111827;
    border-radius: var(--radius-lg);
    padding: 2.5rem;
    text-align: center;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(148, 163, 184, 0.18);
  }

  .round-card i {
    color: #4c1d95;
    opacity: 0.6;
  }

  .cta-section {
    background: linear-gradient(135deg, #dcfce7, #e0f2fe);
    color: #111827;
    padding: 4rem 0;
  }

  .cta-section .hero-highlight {
    background: linear-gradient(135deg, #f97316, #facc15);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .btn-science {
    background: linear-gradient(135deg, #facc15, #f97316);
    border: none;
    border-radius: 999px;
    padding: 1rem 2.5rem;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 12px 30px rgba(248, 181, 0, 0.4);
    transition: all 0.25s ease;
    color: #1f2933;
  }

  .btn-science:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(248, 181, 0, 0.5);
    color: #111827;
  }

  .btn-outline-light {
    border-color: #cbd5f5;
    color: #4b5563;
    background-color: rgba(255, 255, 255, 0.8);
  }

  .btn-outline-light:hover {
    background-color: #e0f2fe;
    color: #111827;
  }

  .bg-light {
    background-color: #f9fafb !important;
  }

  .py-6 {
    padding-top: 4.5rem;
    padding-bottom: 4.5rem;
  }
  
  @media (min-width: 1200px) {
    .display-6 {
        font-size: 1.6rem;
    }
    .display-4 {
        font-size: 2.2rem;
    }
        .display-5 {
        font-size: 2rem;
    }
}
</style>


<!-- Hero Section -->
<section class="hero position-relative">
  <div class="container">
    <button class="btn btn-cta btn-primary text-white my-3"  onclick="history.back()">
      ← Go Back
    </button>
    <div class="row align-items-center gy-4">
      <div class="col-lg-7">
        <div class="science-badge mb-4">
        
          Where Young Ideas Become Future Breakthroughs
        </div>
        <h1 class="hero-title mb-4 display-3 fw-bold">
          Welcome to <span class="hero-highlight">MaRRS Scientia Exertus</span><br>
          <span class="fs-4">The National Science Challenge</span>
        </h1>
        <p class="hero-subtitle lead mb-5">
          Are you a student who sees the world differently? Do you have an idea that could change everything?
          <strong>Scientia Exertus</strong> is the ultimate stage for the bold, the curious, and the inventive.
        </p>
        <p class="fs-5 mb-4 text-muted">
          We don't just teach science—we <strong>celebrate it</strong>. This is a high-octane, national-level competition
          designed to pull science out of the textbook and into the real world. From the secrets of the human body to the
          mysteries of deep space, your journey toward scientific mastery starts here.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="/se_parent_guide.php" class="btn btn-science btn-lg text-white">
             Guide to the parents.
          </a>
          
          <a href="#challenge" class="btn btn-science btn-lg text-white">
           Weekly learning plan
          </a>
        </div>
      </div>
      <div class="col-lg-5">
          <div class="hero-image-container my-2">
                <img src="https://marrs.in/newassets/logos/SE.jpg" alt="SE" class="img-fluid rounded"/>
            </div>
        <div class="feature-card">
          <h5 class="fw-bold mb-4">Science That Powers Your Grades (and Beyond!)</h5>
          <p class="text-muted mb-4">
            We believe that innovation should go hand-in-hand with academic success.
          </p>
          <div class="d-flex align-items-start mb-3">
            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
            <div>
              <strong>Master the Curriculum:</strong> Our syllabus directly addresses and reinforces school science curriculums
            </div>
          </div>
          <div class="d-flex align-items-start mb-3">
            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
            <div>
              <strong>Expand Your Awareness:</strong> Beyond textbooks, we challenge your general scientific knowledge
            </div>
          </div>
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle text-success me-3 mt-1 fs-5"></i>
            <div>
              <strong>Deep-Dive Specialisation:</strong> Every grade focuses on a specific, fascinating domain
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Competition Levels -->
<section id="challenge" class="py-6 bg-light">
  <div class="container">
    <div class="row mb-6">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-title display-5 fw-bold mb-4">The Road to National Glory</h2>
        <p class="lead text-muted mb-5">
          Compete through four thrilling levels, proving your brilliance at every step. Can you make it to the grand stage?
        </p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center h-100">
          <div class="feature-icon mb-3">
            <i class="fas fa-school"></i>
          </div>
          <h5>Level 1: School Level</h5>
          <p class="text-muted">Become the champion of your campus.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center h-100">
          <div class="feature-icon mb-3">
            <i class="fas fa-users"></i>
          </div>
          <h5>Level 2: Interschool Level</h5>
          <p class="text-muted">Go head-to-head with the best in your city.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center h-100">
          <div class="feature-icon mb-3">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <h5>Level 3: State Level</h5>
          <p class="text-muted">Represent your region with pride.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center h-100">
          <div class="feature-icon mb-3">
            <i class="fas fa-crown"></i>
          </div>
          <h5>Level 4: National Finals</h5>
          <p class="text-muted">Face the finest young minds in the country.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Grade Specialization -->
<section id="grades" class="py-6">
  <div class="container">
    <div class="row mb-6">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-title display-5 fw-bold mb-4">Focused Expertise by Grade</h2>
        <p class="lead text-muted mb-5">
          Every category (Grade 1–8) has its own mission. Master your topic and become a subject matter expert:
        </p>
      </div>
    </div>

    <div class="grade-table mx-auto" style="max-width: 800px;">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th class="text-start">Grade</th>
              <th class="text-start">Deep Study Topic</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Grade 1</strong></td>
              <td>My Body</td>
            </tr>
            <tr>
              <td><strong>Grade 2</strong></td>
              <td>Energy</td>
            </tr>
            <tr>
              <td><strong>Grade 3</strong></td>
              <td>Waste Management</td>
            </tr>
            <tr>
              <td><strong>Grade 4</strong></td>
              <td>Conservation of Nature</td>
            </tr>
            <tr>
              <td><strong>Grade 5</strong></td>
              <td>Food & Nutrition</td>
            </tr>
            <tr>
              <td><strong>Grade 6</strong></td>
              <td>The Earth</td>
            </tr>
            <tr>
              <td><strong>Grade 7</strong></td>
              <td>Cosmology</td>
            </tr>
            <tr>
              <td><strong>Grade 8</strong></td>
              <td>Science in Medicine</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Competition Rounds -->
<section id="rounds" class="py-6" style="background: radial-gradient(circle at top, #fdf2ff 0%, #f9fafb 45%, #ffffff 100%);">
  <div class="container">
    <div class="row mb-6">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-title display-5 fw-bold mb-4">Experience "Existential Science"</h2>
        <p class="lead text-muted mb-5">
          Forget boring multiple-choice tests. Scientia Exertus uses <strong>Innovative Rounds</strong> to bring science to life:
        </p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="round-card h-100">
          
          <h3 class="display-6 fw-bold mb-3">Observational Science Quiz</h3>
          <p class="lead mb-0 text-muted">
            Use your eyes and your mind to solve real-world puzzles.
          </p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="round-card h-100">
         
          <h3 class="display-6 fw-bold mb-3">The Viva Challenge</h3>
          <p class="lead mb-0 text-muted">
            Engage in thought-provoking discussions that test your deep understanding and verbal prowess.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section id="register" class="cta-section">
  <div class="container text-center">
    <h2 class="display-4 fw-bold mb-4">
      Are You Ready to <span class="hero-highlight">Invent the Future?</span>
    </h2>
    <p class="lead fs-4 mb-3 opacity-90 text-muted">
      The world is waiting for your ideas. Don't just learn science—live it.
    </p>
    <div class="text-dark fs-5 pb-4">
      Join thousands of young innovators across the nation. Secure your spot in the next MaRRS Scientia Exertus and take the first step toward scientific greatness.
    </div>
    <div class="d-flex flex-column gap-4 justify-content-center align-items-center">
         <a href="/addschool"
                   class="btn btn-science btn-lg px-6">
                    Spark a Revolution - Enroll Your School Now →
                </a>
      <a href="/signin?tab=register" class="btn btn-science btn-lg px-6">
        <i class="fas fa-user-plus me-2"></i>
        Registration is Now Open!
      </a>
    </div>
  </div>
</section>

<?php include('footertest.php'); ?>
