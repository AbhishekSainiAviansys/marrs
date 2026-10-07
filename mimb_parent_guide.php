<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MaRRS International Math Bee – Parent & Teacher Guide</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #10b981;
      --dark-color: #111827;
      --muted-color: #6b7280;
      --light-bg: #f9fafb;
      --radius-lg: 1.25rem;
    }

    body {
      font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #ffffff;
      color: var(--dark-color);
    }

    .navbar {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
    }

    .hero {
      min-height: 70vh;
      display: flex;
      align-items: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 5rem 0 4rem;
      color: white;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      padding: 0.35rem 0.9rem;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      backdrop-filter: blur(10px);
    }

    .hero-title {
      font-weight: 700;
      font-size: clamp(2.1rem, 3vw + 1rem, 3.1rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
    }

    .hero-subtitle {
      font-size: 1.02rem;
      color: rgba(255, 255, 255, 0.9);
      max-width: 38rem;
    }

    .hero-highlight {
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-card {
      background: rgb(249 181 28);
      backdrop-filter: blur(20px);
      border-radius: var(--radius-lg);
      padding: 1.75rem 1.75rem 1.3rem;
      box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-cta {
      border-radius: 999px;
      padding: 0.8rem 1.7rem;
      font-weight: 600;
      border: none;
      box-shadow: 0 14px 30px rgba(16, 185, 129, 0.3);
    }

    .btn-ghost {
      border-radius: 999px;
      padding: 0.8rem 1.4rem;
      font-weight: 500;
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: white;
      background: rgba(255, 255, 255, 0.1);
    }

    .btn-ghost:hover {
      background-color: rgba(255, 255, 255, 0.2);
      border-color: rgba(255, 255, 255, 0.5);
    }

    .section-eyebrow {
      font-size: 0.85rem;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #6b7280;
      font-weight: 600;
    }

    .section-title {
      font-weight: 700;
      font-size: 1.7rem;
      letter-spacing: -0.02em;
    }

    .feature-card {
      border-radius: var(--radius-lg);
      border: 1px solid #e5e7eb;
      padding: 1.75rem;
      background-color: #ffffff;
      transition: transform 0.18s ease-out, box-shadow 0.18s ease-out, border-color 0.18s ease-out;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
      border-color: rgba(16, 185, 129, 0.5);
    }

    .feature-icon {
      width: 48px;
      height: 48px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      background: linear-gradient(135deg, #10b981, #059669);
      color: white;
      font-weight: bold;
    }

    .highlight-box {
      background: #ecfdf5;
      border-left: 4px solid #10b981;
      padding: 1rem;
      border-radius: 0.5rem;
      margin: 0.5rem 0;
    }

    .reminder-card {
      border-radius: var(--radius-lg);
      background: #fef3c7;
      border: 1px dashed #f59e0b;
      padding: 1.5rem;
    }

    @media (max-width: 991.98px) {
      .hero {
        padding-top: 5.5rem;
      }
      .hero-card {
        margin-top: 2.2rem;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top border-bottom">
    <div class="container py-2">
      <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="#">
        <span class="rounded-circle bg-success-subtle d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
          <i class="fas fa-calculator text-success fs-5"></i>
        </span>
        <span class="fw-bold">MathBee</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#curriculum">Curriculum</a></li>
          <li class="nav-item"><a class="nav-link" href="#oral">Oral Finals</a></li>
          <li class="nav-item"><a class="nav-link" href="#tips">Tips</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <main id="top" class="hero">
    <div class="container">
      <button class="btn btn-cta btn-success text-white me-3 mb-4" style="position: relative; top: -32px;" onclick="history.back()">
        ← Go Back
      </button>

      <div class="row align-items-center gy-5">
        <div class="col-lg-7">
          <div class="hero-badge mb-3">
            <span>Parent & Teacher Guide</span>
          </div>
          <h1 class="hero-title mb-3">
            The Parent & Teacher Guide: <span class="hero-highlight">Beyond the Competition</span>
          </h1>
          <p class="hero-subtitle mb-4 lead">
            The MaRRS International Math Bee is built on the philosophy of <strong>"Incremental Mastery."</strong> Here is how it bridges the gap between classroom theory and real-world application.
          </p>
          <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-cta btn-success text-white" onclick="document.getElementById('curriculum').scrollIntoView({behavior:'smooth'})">
              Explore Curriculum
            </button>
            <button class="btn btn-ghost" onclick="document.getElementById('tips').scrollIntoView({behavior:'smooth'})">
              Teacher & Parent Tips
            </button>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-3">Philosophy of Incremental Mastery</h5>
            <ul class="list-unstyled mb-0">
              <li class="mb-2 d-flex align-items-start">
                <span class="feature-icon me-3 mt-1"></span>
                <strong>Force Multiplier</strong> for schoolwork
              </li>
              <li class="mb-2 d-flex align-items-start">
                <span class="feature-icon me-3 mt-1"></span>
                <strong>Oral Finals</strong> develop soft skills
              </li>
              <li class="mb-2 d-flex align-items-start">
                <span class="feature-icon me-3 mt-1"></span>
                <strong>6-Tier Scaffolding</strong> matches Zone of Proximal Development
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Curriculum Alignment -->
  <section id="curriculum" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row g-4 mb-5">
        <!-- 1. Curriculum Alignment -->
        <div class="col-lg-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-3">📚</div>
            <h5 class="fw-bold mb-3">1. Curriculum Alignment & Acceleration</h5>
            <p class="text-muted mb-3">
              MIMB doesn't work in isolation; it acts as a <strong>"Force Multiplier"</strong> for schoolwork.
            </p>
            <div class="highlight-box">
              <strong>The Bridge Mechanism:</strong> While school exams focus on the current grade, MIMB introduces "Starter Lessons" for the following academic year in its later tiers.
            </div>
            <div class="highlight-box">
              <strong>Reinforcement:</strong> By practicing for the Written Prelims, students achieve a higher level of fluency in core operations (Arithmetic, Geometry, and Logic) than they would through standard homework alone.
            </div>
          </div>
        </div>

        <!-- 2. Oral Finals -->
        <div class="col-lg-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-3">🗣️</div>
            <h5 class="fw-bold mb-3">2. The "Oral Finals" Advantage</h5>
            <p class="text-muted mb-3">
              Unique to MIMB, the oral rounds push students beyond the paper-and-pencil limit.
            </p>
            <div class="highlight-box">
              <strong>For Teachers:</strong> It supports "Mathematical Communication" objectives—the ability to explain reasoning and think on one's feet.
            </div>
            <div class="highlight-box">
              <strong>For Parents:</strong> It builds public speaking confidence and reduces "test anxiety" by making math a conversational and interactive experience.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Progressive Difficulty -->
  <section class="py-5 py-lg-6">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-10 mx-auto">
          <div class="feature-card text-center">
            <div class="feature-icon mb-4 mx-auto" style="width: 60px; height: 60px; font-size: 1.5rem;">📈</div>
            <h5 class="fw-bold mb-4 display-6">3. Progressive Difficulty (The 6-Tier Scaffolding)</h5>
            <p class="text-muted lead mb-4">
              MIMB uses a "scaffolding" approach where the syllabus expands as the student progresses. This mirrors the <strong>Zone of Proximal Development</strong>, ensuring the child is always challenged but never overwhelmed.
            </p>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-success">
                  <tr>
                    <th>Learning Objective</th>
                    <th>How MIMB Supports It</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Conceptual Clarity</strong></td>
                    <td>Tiered syllabus introduces chapters in a logical, building-block sequence.</td>
                  </tr>
                  <tr>
                    <td><strong>Mental Math Agility</strong></td>
                    <td>Oral rounds require students to process and calculate without physical aids.</td>
                  </tr>
                  <tr>
                    <td><strong>Competitive Resilience</strong></td>
                    <td>The multi-stage format teaches students to handle both success and setbacks.</td>
                  </tr>
                  <tr>
                    <td><strong>Future Readiness</strong></td>
                    <td>Early exposure to advanced topics makes the transition to the next grade seamless.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tips Section -->
  <section id="tips" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row g-4">
        <!-- Teachers Tips -->
        <div class="col-lg-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-3">👩‍🏫</div>
            <h5 class="fw-bold mb-3">Tips for Teachers</h5>
            <div class="highlight-box">
              <strong>Classroom Integration:</strong> Use MIMB sample papers as "Problem of the Day" challenges to spark healthy competition in class.
            </div>
            <div class="highlight-box mt-3">
              <strong>Identifying Talent:</strong> Use the School Level results to identify students who may need more advanced enrichment or those who have "hidden" mental math strengths.
            </div>
          </div>
        </div>

        <!-- Parents Tips -->
        <div class="col-lg-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-3">👨‍👩‍👧‍👦</div>
            <h5 class="fw-bold mb-3">Tips for Parents</h5>
            <div class="highlight-box">
              <strong>Focus on the Journey:</strong> Remind your child that reaching Tier B (Interschool) or Tier C (State) is an achievement in itself, even if they don't reach the International Finals.
            </div>
            <div class="highlight-box mt-3">
              <strong>The "Prep Exercise" Mindset:</strong> Treat the MIMB syllabus as a supplemental study guide for their regular school finals.
            </div>
            <div class="highlight-box mt-2">
              <strong>The Result:</strong> Students who participate in MIMB consistently show higher engagement in STEM subjects and enter their next academic year with a "Head Start" advantage.
            </div>
          </div>
        </div>
      </div>

      <!-- Final CTA -->
      <div class="text-center mt-5">
        <div class="reminder-card mx-auto" style="max-width: 600px;">
          <h5 class="fw-bold mb-3 text-success">Ready to unlock your child's Math Potential?</h5>
          <p class="mb-4">Join thousands of students worldwide who are building mathematical confidence and STEM excellence through MIMB.</p>
          <a href="#register" class="btn btn-success btn-lg px-5">
            Start MathBee Journey
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-dark text-white">
    <div class="container text-center">
      <div class="mb-3">
        <h6 class="fw-bold mb-2">MaRRS International Math Bee</h6>
        <p class="mb-0 opacity-75">Incremental mastery through competitive excellence</p>
      </div>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 small opacity-75">
        <span>&copy; 2026 MaRRS International Math Bee</span>
        <span>Building tomorrow's mathematicians, one problem at a time</span>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
