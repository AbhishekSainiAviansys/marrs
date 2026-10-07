<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lunar Weekly Schedule</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #6366f1;
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
      background: rgba(15, 23, 42, 0.9);
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

    .schedule-table {
      border-radius: var(--radius-lg);
      overflow: hidden;
      border: 1px solid #e5e7eb;
      background-color: #ffffff;
    }

    .schedule-table thead {
      background: linear-gradient(135deg, #eef2ff, #dbeafe);
    }

    .schedule-table th,
    .schedule-table td {
      vertical-align: top;
      padding-top: 0.8rem;
      padding-bottom: 0.8rem;
      font-size: 0.9rem;
    }

    .schedule-table tbody tr:nth-child(even) {
      background-color: #f9fafb;
    }

    .day-pill {
      font-size: 0.8rem;
      padding: 0.15rem 0.75rem;
      border-radius: 999px;
      background-color: #eef2ff;
      color: #3730a3;
      display: inline-block;
      margin-bottom: 0.4rem;
    }

    .phase-pill {
      font-size: 0.78rem;
      padding: 0.12rem 0.6rem;
      border-radius: 999px;
      background-color: #ecfeff;
      color: #0f766e;
      display: inline-block;
      margin-bottom: 0.3rem;
    }

    .reminder-card {
      border-radius: var(--radius-lg);
      background: #fef3c7;
      border: 1px dashed #f59e0b;
      padding: 1.25rem 1.4rem;
    }

    .tip-badge {
      width: 26px;
      height: 26px;
      border-radius: 999px;
      background-color: #eef2ff;
      color: #312e81;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      font-weight: 600;
      margin-right: 0.5rem;
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
        <span class="rounded-circle bg-slate-900 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: radial-gradient(circle at 30% 20%, #facc15, #1e293b);">
        <img src="https://marrs.in/images/Lunar_logo.png" alt="Lunar Assessment Logo" style=" width:150px;">
        </span>
       
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#schedule">Weekly plan</a></li>
          <li class="nav-item"><a class="nav-link" href="#protips">Pro-tips</a></li>
          <li class="nav-item"><a class="nav-link" href="#reflection">Reflection</a></li>
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
            <span>From Starter to Flyer in a few days</span>
          </div>
          <h1 class="hero-title mb-3">
            Your weekly <span class="hero-highlight">"Mission Control"</span> learning schedule
          </h1>
          <p class="hero-subtitle mb-4">
            Since your subscription includes&nbsp;four tests per month, a "one-test-per-week" rhythm is the most effective way to build a habit without overwhelming your child.<br><br>
            Here is a sample&nbsp;"Mission Control" Weekly Schedule&nbsp;designed to help your child move from&nbsp;Starter&nbsp;to&nbsp;Flyer&nbsp;level in just a few days.
          </p>
          <button class="btn btn-cta me-3" type="button" onclick="document.getElementById('schedule').scrollIntoView({behavior:'smooth'})">
            See weekly schedule
          </button>
          <button class="btn btn-ghost" type="button" onclick="document.getElementById('protips').scrollIntoView({behavior:'smooth'})">
           Pro-Tips for Success
          </button>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">The Weekly "Mission Control" Schedule</h5>
            <p class="small mb-3">
              Designed for a balanced, stress-free learning week.
            </p>
            <p class="small mb-1">
              <code>Starter â†’ Mover â†’ Flyer</code>
            </p>
            <p class="small mb-2">
              Use this rhythm to keep learning steady:<br>
              <code>Prepare â†’ Practise â†’ Test â†’ Reflect â†’ Celebrate</code>
            </p>
            <p class="small mb-0 text-muted">
              A one-test-per-week habit gives enough time to prepare, process, and improvement ”without "test fatigue".
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Weekly Schedule -->
  <section id="schedule" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">Weekly mission plan</p>
          <h2 class="section-title mb-2">The Weekly "Mission Control" Schedule</h2>
          <p class="text-muted mb-0">
            Designed for a balanced, stress-free learning week.
          </p>
        </div>
      </div>

      <div class="schedule-table">
        <table class="table mb-0 align-middle">
          <thead class="small text-muted">
            <tr>
              <th scope="col" style="width: 12%;">Day</th>
              <th scope="col" style="width: 16%;">Phase</th>
              <th scope="col" style="width: 44%;">Activity</th>
              <th scope="col" style="width: 28%;">Goal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="day-pill"><b>Monday</b></span></td>
              <td><span class="phase-pill"><b>Launch Prep</b></span></td>
              <td>
                Spend 20 mins with the&nbsp;Preparatory Materials.
              </td>
              <td>
                Get familiar with the "Starter" facts ("What is it?").
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Tuesday</b></span></td>
              <td><span class="phase-pill"><b>Discovery</b></span></td>
              <td>
                Deep dive into a specific topic using a video or study guide.
              </td>
              <td>
                Build confidence in the core concepts.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Wednesday</b></span></td>
              <td><span class="phase-pill"><b>Mid-Week Boost</b></span></td>
              <td>
                Quick practice quiz or verbal Q&amp;A with a parent.
              </td>
              <td>
                Move into the "Mover" stage ("How do I do it?").
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Thursday</b></span></td>
              <td><span class="phase-pill"><b>The Flyer Challenge</b></span></td>
              <td>
                Review the most difficult concepts once more.
              </td>
              <td>
                Prepare for&nbsp;expert-level application.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Friday</b></span></td>
              <td><span class="phase-pill"><b>Rest &amp; Recharge</b></span></td>
              <td>
                No formal prep! Let the brain process the info.
              </td>
              <td>
                Avoid "test anxiety" and keep learning fun.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Saturday</b></span></td>
              <td><span class="phase-pill"><b>TEST DAY </b></span></td>
              <td>
                Log in and take the&nbsp;Lunar Skill Test&nbsp;(Online).
              </td>
              <td>
                Give it their best shot!
              </td>
            </tr>
            <tr>
              <td><span class="day-pill"><b>Sunday</b></span></td>
              <td><span class="phase-pill"><b>The Debrief</b></span></td>
              <td>
                Check the&nbsp;National Percentile&nbsp;&amp; download the&nbsp;Certificate.
              </td>
              <td>
                Celebrate effort and plan for next week.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Pro-Tips -->
  <section id="protips" class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">Pro-Tips for Success</p>
          <h2 class="section-title mb-3">Make every week count</h2>

          <div class="feature-card mb-3">
            <p class="mb-0">
              The "20-Minute Rule":&nbsp;For Grades 1-5, keep prep sessions to 20 minutes. For Grades 6-10, 40 minutes is the sweet spot. Anything longer leads to "brain fog."
            </p>
          </div>

          <div class="feature-card mb-3">
            <p class="mb-0">
              Active Recall:&nbsp;Instead of just reading the prep materials, ask your child to "teach" the concept back to you. If they can explain it, theyâ€™ve mastered the&nbsp;Starter&nbsp;level.
            </p>
          </div>

          <div class="feature-card mb-3">
            <p class="mb-0">
              Review the "Misses":&nbsp;On Sunday, look at the questions they got wrong. Don't see them as mistakesâ€”see them as&nbsp;"Discovery Points"&nbsp;to focus on for next week.
            </p>
          </div>

          <div class="feature-card">
            <p class="mb-0">
              The Reward Ritual:&nbsp;Make the post-test Sunday debrief something to look forward toâ€”maybe a favorite snack or an extra 30 minutes of screen time to celebrate their&nbsp;Digital Certificate.
            </p>
          </div>
        </div>

        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">Mission overview</p>
          <h2 class="section-title mb-3">Why this rhythm works</h2>
          <div class="reminder-card">
            <p class="mb-0">
              Since your subscription includes&nbsp;four tests per month, a "one-test-per-week" rhythm is the most effective way to build a habit without overwhelming your child.<br><br>
              Here is a sample&nbsp;"Mission Control" Weekly Schedule&nbsp;designed to help your child move from&nbsp;Starter&nbsp;to&nbsp;Flyer&nbsp;level in just a few days.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Reflection -->
  <section id="reflection" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">Sample "Sunday Reflection" Questions</p>
          <h2 class="section-title mb-3">Helping your child self-reflect</h2>
          <p class="text-muted mb-3">
            &nbsp;Sample "Sunday Reflection" Questions<br>
            To help your child develop the&nbsp;self-reflection&nbsp;mentioned in our progressive education model, try asking these after the test:
          </p>
          <div class="feature-card mb-2">
            <p class="mb-0">
              "Which question made you feel like a&nbsp;Flyer&nbsp;(an expert)?"
            </p>
          </div>
          <div class="feature-card mb-2">
            <p class="mb-0">
              "Was there a&nbsp;Mover&nbsp;question that was tricky at first but you figured out?"
            </p>
          </div>
          <div class="feature-card">
            <p class="mb-0">
              "What is one thing we should look at in the prep materials again next week?"
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4" style="background:#020617;color:#9ca3af;">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span class="small">&copy; 2026 Mission Control Weekly Schedule.</span>
      <span class="text-secondary small">From Starter to Flyer, one test and one reflection at a time.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
