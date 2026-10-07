<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parentâ€™s Guide to Lunar Skill Tests</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4f46e5;
      --dark-color: #0f172a;
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
      background: rgba(15, 23, 42, 0.96);
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #e5e7eb !important;
    }

    .navbar-nav .nav-link.active {
      color: #a5b4fc !important;
    }

    .hero {
      min-height: 70vh;
      display: flex;
      align-items: center;
      background: radial-gradient(circle at top left, #e0f2fe 0, #ffffff 40%, #ede9fe 100%);
      padding: 5rem 0 4rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      padding: 0.35rem 0.9rem;
      border-radius: 999px;
      background: rgba(129, 140, 248, 0.12);
      color: #3730a3;
    }

    .hero-title {
      font-weight: 700;
      font-size: clamp(2.1rem, 3vw + 1rem, 3.1rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
    }

    .hero-subtitle {
      font-size: 1.02rem;
      color: var(--muted-color);
      max-width: 40rem;
    }

    .hero-highlight {
      color: #ea580c;
    }

    .hero-card {
      background: #020617;
      color: #e5e7eb;
      border-radius: var(--radius-lg);
      padding: 1.75rem 1.75rem 1.3rem;
      box-shadow: 0 24px 55px rgba(15, 23, 42, 0.9);
      border: 1px solid #1f2937;
    }

    .btn-cta {
      border-radius: 999px;
      padding: 0.8rem 1.7rem;
      font-weight: 600;
      border: none;
      background: linear-gradient(135deg, #4f46e5, #6366f1);
      color: #ffffff;
      box-shadow: 0 14px 30px rgba(79, 70, 229, 0.35);
    }

    .btn-cta:hover {
      background: linear-gradient(135deg, #4338ca, #4f46e5);
      color: #ffffff;
    }

    .btn-ghost {
      border-radius: 999px;
      padding: 0.8rem 1.4rem;
      font-weight: 500;
      border: 1px solid #e5e7eb;
      color: var(--dark-color);
      background-color: #ffffff;
    }

    .btn-ghost:hover {
      background-color: #eef2ff;
      border-color: #c7d2fe;
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
      padding: 1.35rem 1.3rem;
      background-color: #ffffff;
      transition: transform 0.18s ease-out, box-shadow 0.18s ease-out, border-color 0.18s ease-out;
    }

    .feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
      border-color: rgba(79, 70, 229, 0.6);
    }

    .feature-icon {
      width: 38px;
      height: 38px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      background: radial-gradient(circle at 30% 20%, #fefce8, #e0f2fe);
      color: #1d4ed8;
    }

    .table-roadmap {
      border-radius: var(--radius-lg);
      overflow: hidden;
      border: 1px solid #e5e7eb;
      background-color: #ffffff;
    }

    .table-roadmap thead {
      background: linear-gradient(135deg, #eef2ff, #dbeafe);
    }

    .table-roadmap th,
    .table-roadmap td {
      vertical-align: top;
      padding-top: 0.8rem;
      padding-bottom: 0.8rem;
      font-size: 0.9rem;
    }

    .table-roadmap tbody tr:nth-child(even) {
      background-color: #f9fafb;
    }

    .reminder-card {
      border-radius: var(--radius-lg);
      background: #fef3c7;
      border: 1px dashed #f59e0b;
      padding: 1.25rem 1.4rem;
    }

    code {
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
      font-size: 0.9em;
      background-color: #f3f4f6;
      border-radius: 0.25rem;
      padding: 0.1rem 0.3rem;
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
  <nav class="navbar navbar-expand-lg sticky-top border-bottom border-slate-800">
    <div class="container py-2">
      <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="#">
        <span class="rounded-circle d-inline-flex align-items-center justify-content-center"
              style="width: 32px; height: 32px; background: radial-gradient(circle at 30% 20%, #facc15, #1e293b);">
           <img src="https://marrs.in/images/Lunar_logo.png" alt="Lunar Assessment Logo" style=" width:150px;">
        </span>
        
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#path">Learning path</a></li>
          <li class="nav-item"><a class="nav-link" href="#percentile">Percentile</a></li>
          <li class="nav-item"><a class="nav-link" href="#launchpad">Launchpad</a></li>
          <li class="nav-item"><a class="nav-link" href="#celebrate">Celebrate</a></li>
          <li class="nav-item"><a class="nav-link" href="#subscription">Subscription</a></li>
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
            <span>The Parent Guide to Lunar Skill Tests</span>
          </div>
          <h1 class="hero-title mb-3">
            Turn every Lunar Skill Test into a <span class="hero-highlight">growth milestone</span>
          </h1>
          <p class="hero-subtitle mb-4">
            Parenting doesn't exactly come with a manual, but helping your child navigate their education shouldn't feel like rocket science. This guide is designed to help you make the most of&nbsp;Lunar Skill Tests&nbsp;and turn every assessment into a milestone.
          </p>
          <button class="btn btn-cta me-3" type="button" onclick="document.getElementById('path').scrollIntoView({behavior:'smooth'})">
            Start with the learning path
          </button>
          <button class="btn btn-ghost" type="button" onclick="document.getElementById('launchpad').scrollIntoView({behavior:'smooth'})">
            Build your home launchpad
          </button>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">The Parent's Guide to Lunar Skill Tests</h5>
            <p class="small mb-3">
              Welcome to the mission! Our goal is to move away from "high-stakes testing" and toward "high-growth learning." Here is everything you need to know to support your children journey.
            </p>
            <p class="small mb-0 text-muted">
              Think of each test as a checkpoint in a longer journeyâ€”one where confidence, curiosity, and understanding matter more than a single score.
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- 1. Understanding the Learning Path -->
  <section id="path" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">1. Understanding the Learning Path</p>
          <h2 class="section-title mb-2">How Lunar Skill Tests measure growth</h2>
          <p class="text-muted mb-0">
            We don't just test what a child knows; we test how they&nbsp;use&nbsp;that knowledge. Our curriculum is built on a three-tier progression that mirrors how the brain actually learns.
          </p>
        </div>
      </div>

      <div class="table-roadmap mb-4">
        <table class="table mb-0 align-middle">
          <thead class="small text-muted">
            <tr>
              <th scope="col" style="width: 12%;">Phase</th>
              <th scope="col" style="width: 18%;">Level</th>
              <th scope="col" style="width: 20%;">The Goal</th>
              <th scope="col">What it looks like</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Stage 1</td>
              <td>Starter</td>
              <td>Foundations</td>
              <td>
                Identifying facts, vocabulary, and basic concepts. ("What is it?")
              </td>
            </tr>
            <tr>
              <td>Stage 2</td>
              <td>Mover</td>
              <td>Application</td>
              <td>
                Using those facts to solve practical, real-world problems. ("How do I do it?")
              </td>
            </tr>
            <tr>
              <td>Stage 3</td>
              <td>Flyer</td>
              <td>Mastery</td>
              <td>
                Analyzing complex scenarios and reflecting on solutions. (Expert-level application)
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- 2. Decoding the National Percentile -->
  <section id="percentile" class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">2. Decoding the National Percentile Grading</p>
          <h2 class="section-title mb-3">What your childrens percentile really means</h2>
          <p class="text-muted mb-3">
            Unlike a traditional school grade (like 80% or a B+), a&nbsp;National Percentile&nbsp;tells you where your child stands relative to other students in the same grade across the country.
          </p>

          <div class="feature-card mb-3">
            <p class="mb-0">
              If your child is in the 75th percentile:&nbsp;It means they performed better than 75% of students nationally.
            </p>
          </div>

          <div class="reminder-card">
            <p class="mb-0">
              The Focus:&nbsp;Use this data to track&nbsp;growth&nbsp;over time rather than just chasing a 99th percentile rank. If they move from the 50th to the 60th percentile, that is a massive win!
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. Creating a Launchpad at Home -->
  <section id="launchpad" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">3. Creating a "Launchpad" at Home</p>
          <h2 class="section-title mb-3">Set up a simple, powerful routine</h2>
          <p class="text-muted mb-3">
            To get the most out of our&nbsp;100% online platform, we recommend these simple steps:
          </p>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Consistency is Key</h6>
            <p class="mb-0 text-muted small">
              Consistency is Key:&nbsp;Your subscription includes&nbsp;4 tests per month. We suggest scheduling these on the same day each week (e.g., "Skill-Up Sundays") to build a routine.
            </p>
          </div>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">The Prep Phase</h6>
            <p class="mb-0 text-muted small">
              The Prep Phase:&nbsp;Before each test, dive into the&nbsp;Comprehensive Preparatory Materials&nbsp;included in your dashboard. These aren't just "study sheets"â€”they are designed to spark curiosity.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">The Environment</h6>
            <p class="mb-0 text-muted small">
              The Environment:&nbsp;Ensure a quiet, well-lit space. Since itâ€™s online, any device works, but a tablet or laptop usually provides the best focus for Grades 1â€“10.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Celebrating the Wins -->
  <section id="celebrate" class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">4. Celebrating the Wins (Big and Small)</p>
          <h2 class="section-title mb-3">Build confidence through visible progress</h2>
          <p class="text-muted mb-3">
            Confidence is the secret sauce of academic success. Use our rewards system to keep the momentum going:
          </p>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">The "Wall of Fame"</h6>
            <p class="mb-0 text-muted small">
              The "Wall of Fame":&nbsp;Print out the&nbsp;Digital Certificates&nbsp;your child earns after every test. Visualizing progress makes it real for them.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">The Medal Chase</h6>
            <p class="mb-0 text-muted small">
              The Medal Chase:&nbsp;Remind your child that&nbsp;Medals&nbsp;are awarded to toppers in each series. Itâ€™s a healthy way to encourage them to aim for the "Flyer" level.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Managing Your Subscription -->
  <section id="subscription" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">5. Managing Your Subscription</p>
          <h2 class="section-title mb-3">Keep things flexible and focused</h2>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Flexible Billing</h6>
            <p class="mb-0 text-muted small">
              Flexible Billing:&nbsp;Your simple monthly payment covers four tests. No hidden fees.
            </p>
          </div>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Add-ons</h6>
            <p class="mb-0 text-muted small">
              Add-ons:&nbsp;If your child finds a particular subject tricky, check out our additional study resources available for purchase in the store.
            </p>
          </div>

          <div class="reminder-card">
            <p class="mb-0">
              Pro-Tip:&nbsp;Don't view a "low" score as a failure. View it as a&nbsp;Diagnostic Map. It tells you exactly where the "gaps in the armor" are so you can fix them before the next school exam!
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4" style="background:#020617;color:#9ca3af;">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span class="small">&copy; 2026 Parentâ€™s Guide to Lunar Skill Tests.</span>
      <span class="text-secondary small">Turning high-stakes testing into high-growth learning.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
