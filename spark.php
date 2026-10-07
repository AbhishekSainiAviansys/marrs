<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MaRRS Spell Spark Spelling Bee</title>

  <!-- Bootstrap 5.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Optional Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #ffb100;
      --dark-color: #111827;
      --muted-color: #6b7280;
      --light-bg: #f9fafb;
      --radius-lg: 1.25rem;
    }

    body {
      font-family: 'Poppins', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: #ffffff;
      color: #111827;
    }

    /* Navbar */
    .navbar {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.9);
    }

    /* Hero */
    .hero {
      min-height: 80vh;
      display: flex;
      align-items: center;
      background: radial-gradient(circle at top left, #fff7e0 0, #ffffff 40%, #e5f2ff 100%);
      padding: 5rem 0 4rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      padding: 0.35rem 0.9rem;
      border-radius: 999px;
      background: rgba(255, 177, 0, 0.12);
      color: #92400e;
    }

    .hero-title {
      font-weight: 700;
      font-size: clamp(2.4rem, 3.2vw + 1rem, 3.4rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
    }

    .hero-subtitle {
      font-size: 1.05rem;
      color: var(--muted-color);
      max-width: 36rem;
    }

    .hero-highlight {
      color: #ea580c;
    }

    .hero-card {
      background: #ffffff;
      border-radius: var(--radius-lg);
      padding: 1.75rem 1.75rem 1.25rem;
      box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
      border: 1px solid #e5e7eb;
    }

    .hero-pill-list {
      font-size: 0.85rem;
    }

    .hero-pill-list span {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.35rem 0.8rem;
      border-radius: 999px;
      background-color: #f3f4ff;
      color: #4338ca;
      margin-right: 0.4rem;
      margin-bottom: 0.4rem;
    }

    /* CTA buttons */
    .btn-cta {
      border-radius: 999px;
      padding: 0.8rem 1.7rem;
      font-weight: 600;
      box-shadow: 0 14px 30px rgba(234, 88, 12, 0.35);
      border: none;
    }

    .btn-ghost {
      border-radius: 999px;
      padding: 0.8rem 1.4rem;
      font-weight: 500;
      border: 1px solid #e5e7eb;
      color: var(--dark-color);
    }

    .btn-ghost:hover {
      background-color: #f3f4ff;
      border-color: #c7d2fe;
    }

    /* Section titles */
    .section-title {
      font-weight: 700;
      font-size: 1.7rem;
      letter-spacing: -0.02em;
    }

    .section-eyebrow {
      font-size: 0.85rem;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #6b7280;
      font-weight: 600;
    }

    /* Feature / info cards */
    .feature-card {
      border-radius: var(--radius-lg);
      border: 1px solid #e5e7eb;
      padding: 1.5rem 1.4rem;
      background-color: #ffffff;
      transition: transform 0.18s ease-out, box-shadow 0.18s ease-out, border-color 0.18s ease-out;
    }

    .feature-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
      border-color: rgba(37, 99, 235, 0.55);
    }

    .feature-icon {
      width: 40px;
      height: 40px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      background: linear-gradient(135deg, #fee2e2, #fef9c3);
      color: #b91c1c;
    }

    /* List groups */
    .list-group-clean .list-group-item {
      border: none;
      padding-left: 0;
      padding-right: 0;
      padding-top: 0.45rem;
      padding-bottom: 0.45rem;
      background: transparent;
    }

    .list-group-clean .list-group-item strong {
      color: #111827;
    }

    /* Experience steps */
    .step-badge {
      width: 28px;
      height: 28px;
      border-radius: 999px;
      background-color: #eef2ff;
      color: #312e81;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: 600;
      margin-right: 0.6rem;
    }

    /* Eligibility band */
    .eligibility {
      background: radial-gradient(circle at top right, #fef3c7 0, #fffbeb 40%, #fef2f2 100%);
    }

    /* Footer */
    footer {
      background: #020617;
      color: #e5e7eb;
      font-size: 0.85rem;
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
        <span class="rounded-circle d-inline-flex align-items-center justify-content-center" style="height: 32px;">
         <img src="https://marrs.in/images/Spell-Spark-Spelling-Bee-Final-Logo.png" style="width: 200px;height: 70px;"> 
        </span>
        
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#why-join">Why Join</a></li>
          <li class="nav-item"><a class="nav-link" href="#materials">Learning</a></li>
          <li class="nav-item"><a class="nav-link" href="#structure">Structure</a></li>
          <li class="nav-item"><a class="nav-link" href="#who">Eligibility</a></li>
          <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
            <a class="btn btn-dark btn-sm rounded-pill px-3" href="">
              Register now
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <main id="top" class="hero">
    <div class="container">
              <button class="btn btn-cta btn-primary text-white me-3" style="position: relative;
    top: -32px;" onclick="history.back()">
  ← Go Back
</button>
      <div class="row align-items-center gy-5">
        <div class="col-lg-7">
          <div class="hero-badge mb-3">
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill">New</span>
            <span>National online + offline spelling bee</span>
          </div>
          <h1 class="hero-title mb-3">
            Unlock Your Child’s Love for <span class="hero-highlight">Words</span>
          </h1>
          <p class="hero-subtitle mb-4">
            MaRRS Spell Spark Spelling Bee helps your child improve spelling, strengthen vocabulary, and gain confidence in English while competing nationally in a joyful, supportive environment.
          </p>
          <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            <a href="" class="btn btn-cta btn-warning text-dark">
              Register free today
            </a>
            <button class="btn btn-ghost" type="button">
              View competition journey
            </button>
          </div>
          <div class="hero-pill-list text-muted">
            <span>100% free online rounds</span>
            <span>Digital certificates each stage</span>
            <span>Grades I–X across India</span>
          </div>
          
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">Your child will:</h5>
            <p class="small text-muted mb-3">
              Prepare, compete, and celebrate every word, every win, every step forward through a smooth, multi-stage spelling journey.
            </p>
            <ul class="list-group list-group-flush list-group-clean mb-3">
              <li class="list-group-item d-flex align-items-start">
                <span class="feature-icon me-3">A</span>
                <div>
                  <strong>Build strong spelling & vocabulary</strong>
                  <div class="small text-muted">Carefully designed rounds to deepen language skills over time.</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start">
                <span class="feature-icon me-3">🏅</span>
                <div>
                  <strong>Gain confidence on a national stage</strong>
                  <div class="small text-muted">Experience competition beyond the classroom in a positive setting.</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start">
                <span class="feature-icon me-3">🤝</span>
                <div>
                  <strong>Join a community of learners</strong>
                  <div class="small text-muted">Thousands of motivated students across India share the same journey.</div>
                </div>
              </li>
            </ul>
            <div class="border-top pt-3 mt-2 d-flex justify-content-between align-items-center">
              <span class="small text-muted">All online rounds are completely free.</span>
              <span class="badge text-bg-warning text-dark">Limited seats</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Why Join -->
  <section id="why-join" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row align-items-end mb-4">
        <div class="col-md-6">
          <p class="section-eyebrow mb-1">Why join</p>
          <h2 class="section-title mb-2">Reasons families love Spell Spark</h2>
          <p class="text-muted mb-0">
            Designed to be accessible, rewarding, and exciting at every stage of your child’s English learning journey.
          </p>
        </div>
        <div class="col-md-6">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="" class="btn btn-cta btn-warning text-dark">
              Guide to the parents.
            </a>
            <button class="btn btn-ghost" type="button">
              Weekly learning plan
            </button>
          </div>
          </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center">
            <div class="feature-icon mb-3">🎁</div>
            <h5 class="fw-semibold mb-2">100% free access</h5>
            <p class="text-muted small mb-0">
              Every participant receives free entry to all online rounds plus base learning material to prepare from home.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center">
            <div class="feature-icon mb-3">📜</div>
            <h5 class="fw-semibold mb-2">Digital recognition</h5>
            <p class="text-muted small mb-0">
              Downloadable digital certificates are awarded at each round so you can celebrate every achievement.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center">
            <div class="feature-icon mb-3">🌏</div>
            <h5 class="fw-semibold mb-2">National platform</h5>
            <p class="text-muted small mb-0">
              Give your child the chance to compete beyond the classroom on a vibrant national stage.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100 text-center">
            <div class="feature-icon mb-3">👨‍👩‍👧‍👦</div>
            <h5 class="fw-semibold mb-2">Community of learners</h5>
            <p class="text-muted small mb-0">
              Join thousands of motivated students across India, turning English into a fun shared adventure.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Learning Materials -->
  <section id="materials" class="py-5 py-lg-6">
    <div class="container">
      <div class="row align-items-center gy-4">
        <div class="col-lg-5">
          <p class="section-eyebrow mb-1">Learning materials</p>
          <h2 class="section-title mb-3">Support at every level of preparation</h2>
          <p class="text-muted mb-0">
            From free base content to optional advanced resources, your child always has the right tools to prepare with confidence.
          </p>
        </div>
        <div class="col-lg-7">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="feature-card h-100">
                <h6 class="fw-semibold text-warning mb-2">Base learning material</h6>
                <p class="text-muted small mb-2">
                  All registered students receive free access to specially curated learning material.
                </p>
                <p class="text-muted small mb-0">
                  Strong preparation is available to every participant, right from home.
                </p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="feature-card h-100">
                <h6 class="fw-semibold text-warning mb-2">Optional advanced resources</h6>
                <p class="text-muted small mb-2">
                  For children who want to practice more and aim higher, additional resources are available for purchase.
                </p>
                <p class="text-muted small mb-0">
                  Perfect for sharpening skills ahead of advanced rounds and Jumbo Nationals.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Competition Structure -->
  <section id="structure" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row align-items-start gy-4">
        <div class="col-lg-5">
          <p class="section-eyebrow mb-1">Competition structure</p>
          <h2 class="section-title mb-3">A smooth, multi-stage journey</h2>
          <p class="text-muted mb-3">
            Each round is thoughtfully designed to build skills and confidence, with recognition at every milestone.
          </p>
          <p class="text-muted mb-0">
            From free online rounds to the thrilling offline Jumbo Nationals, your child grows step by step.
          </p>
        </div>
        <div class="col-lg-7">
          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">School Championship</h6>
            <p class="text-muted small mb-1">
              The journey starts with online objective-type questions.
            </p>
            <p class="text-muted small mb-0">
              This round is completely free for all participants.
            </p>
          </div>
          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">National Prelims & National Finals</h6>
            <p class="text-muted small mb-1">
              Advanced rounds conducted fully online.
            </p>
            <p class="text-muted small mb-0">
              Both stages are free of charge, giving every student the opportunity to reach new heights.
            </p>
          </div>
          <div class="feature-card">
            <h6 class="fw-semibold mb-1">Jumbo Nationals</h6>
            <p class="text-muted small mb-1">
              The most exciting stage, held offline at a central venue.
            </p>
            <p class="text-muted small mb-0">
              Features written and oral spelling challenges; a participation fee applies to support the enhanced experience and logistics.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Experience -->
  <section class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">Experience</p>
          <h2 class="section-title mb-3">What will your child experience?</h2>
          <p class="text-muted mb-3">
            Every round is crafted to nurture a lifelong appreciation for the English language while keeping children motivated and encouraged.
          </p>
          <div class="mb-3">
            <p><span class="step-badge">1</span><strong>Smooth multi-stage progression</strong></p>
            <p class="text-muted small ms-4">
              Skills and confidence grow with each round, from school level to national level.
            </p>
          </div>
          <div class="mb-3">
            <p><span class="step-badge">2</span><strong>Recognition at every milestone</strong></p>
            <p class="text-muted small ms-4">
              Digital certificates and acknowledgment throughout the journey, not just for a select few.
            </p>
          </div>
          <div class="mb-0">
            <p><span class="step-badge">3</span><strong>Engaging, language-rich rounds</strong></p>
            <p class="text-muted small ms-4">
              Carefully structured activities that make English learning exciting and rewarding.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="feature-card h-100">
            <h6 class="fw-semibold mb-2">In short</h6>
            <p class="text-muted small mb-2">
              Your child will discover that spelling and vocabulary are not just school tasks, but powerful tools for self-expression.
            </p>
            <p class="text-muted small mb-2">
              With clear stages, fair competition, and constant encouragement, they stay motivated from registration to the final word.
            </p>
            <p class="text-muted small mb-0">
              Watch their language skills, self-confidence, and enthusiasm soar—word by word, round by round.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Eligibility + CTA -->
  <section id="who" class="eligibility py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4 align-items-center">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">Who can enter?</p>
          <h2 class="section-title mb-3">Open to school students from Grades I to X</h2>
          <p class="text-muted mb-3">
            Any school student in India from Grade I to X can participate. Your child competes only within the same grade-level group, keeping the experience fair, supportive, and encouraging.
          </p>
          <p class="text-muted mb-0">
            Open the door to achievement—register your child today and help them discover the joy of mastering English.
          </p>
        </div>
        <div class="col-lg-5 text-lg-end">
          <a href="" class="btn btn-dark btn-lg rounded-pill px-4 mb-2">
            Register your child now
          </a>
          <div class="text-muted small fst-italic">
            Prepare. Compete. Celebrate every word, every win, every step forward.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span>&copy; 2026 MaRRS Spell Spark Spelling Bee.</span>
      <span class="text-secondary">Inspiring a lifelong love for words.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
