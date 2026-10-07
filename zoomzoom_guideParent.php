<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parent’s Guide – MaRRS Zoom Zoom Math Challenge</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #0ea5e9;
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
      color: #7dd3fc !important;
    }

    .hero {
      min-height: 70vh;
      display: flex;
      align-items: center;
      background: radial-gradient(circle at top left, #e0f2fe 0, #ffffff 40%, #fef3c7 100%);
      padding: 5rem 0 4rem;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      padding: 0.35rem 0.9rem;
      border-radius: 999px;
      background: rgba(56, 189, 248, 0.14);
      color: #0369a1;
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
      background: linear-gradient(135deg, #0284c7, #0ea5e9);
      color: #ffffff;
      box-shadow: 0 14px 30px rgba(14, 165, 233, 0.35);
    }

    .btn-cta:hover {
      background: linear-gradient(135deg, #0369a1, #0284c7);
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
      background-color: #e0f2fe;
      border-color: #bae6fd;
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
      border-color: rgba(14, 165, 233, 0.6);
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
      color: #0369a1;
    }

    .table-roadmap {
      border-radius: var(--radius-lg);
      overflow: hidden;
      border: 1px solid #e5e7eb;
      background-color: #ffffff;
    }

    .table-roadmap thead {
      background: linear-gradient(135deg, #e0f2fe, #fef3c7);
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
              style="width: 32px; height: 32px; background: radial-gradient(circle at 30% 20%, #f97316, #0f172a);">
           <img src="https://marrs.in/images/zoomlandinglogo.png" style="width: 200px;
    height: 60px;">
        </span>
       
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#category">Category</a></li>
          <li class="nav-item"><a class="nav-link" href="#roadmap">Roadmap</a></li>
          <li class="nav-item"><a class="nav-link" href="#resources">Resources</a></li>
          <li class="nav-item"><a class="nav-link" href="#prep">Preparation</a></li>
          <li class="nav-item"><a class="nav-link" href="#why">Why it matters</a></li>
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
            <span>A Parent’s Guide to the MaRRS Zoom Zoom Math Challenge</span>
          </div>
          <h1 class="hero-title mb-3">
            Help your child turn math into a <span class="hero-highlight">superpower</span>
          </h1>
          <p class="hero-subtitle mb-4">
            This guide is designed to help you navigate the&nbsp;MaRRS Zoom Zoom Math Challenge&nbsp;with ease. Math doesn't have to be a "scary monster" under the bed—with the right approach, it’s a superpower!<br><br>
            Here’s everything you need to know to support your child’s journey from the first round to the Jumbo Nationals.
          </p>
          <button class="btn btn-cta me-3" type="button" onclick="document.getElementById('category').scrollIntoView({behavior:'smooth'})">
            Start with their category
          </button>
          <button class="btn btn-ghost" type="button" onclick="document.getElementById('roadmap').scrollIntoView({behavior:'smooth'})">
            See the competition roadmap
          </button>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">A Parent’s Guide to the MaRRS Zoom Zoom Math Challenge</h5>
            <p class="small mb-0">
              A Parent’s Guide to the MaRRS Zoom Zoom Math Challenge
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- 1. Identify Category -->
  <section id="category" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">1. Identify Your Child’s Category</p>
          <h2 class="section-title mb-2">Match the format to their grade</h2>
          <p class="text-muted mb-0">
            The competition is tailored to your child's developmental stage. Ensure you've noted the correct format for their grade:
          </p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🧒</div>
            <h6 class="fw-semibold mb-1">Early Learners (Jr. KG &amp; Sr. KG)</h6>
            <p class="mb-0 text-muted small">
              Early Learners (Jr. KG &amp; Sr. KG):&nbsp;These rounds are&nbsp;Oral Only. The focus is on verbalizing numbers and basic logic in a stress-free environment.
            </p>
          </div>
        </div>

        <div class="col-md-6">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">📱</div>
            <h6 class="fw-semibold mb-1">Primary &amp; Middle School (Grades 1 to 8)</h6>
            <p class="mb-0 text-muted small">
              Primary &amp; Middle School (Grades 1 to 8):&nbsp;These participants will take&nbsp;Online Tests, helping them get comfortable with digital assessment formats used in modern education.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. Competition Roadmap -->
  <section id="roadmap" class="py-5 py-lg-6">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">2. The Competition Roadmap</p>
          <h2 class="section-title mb-2">A season of growth, not just one test</h2>
          <p class="text-muted mb-0">
            The challenge isn't just a one-off test; it’s a season of growth. Here is how the path to the top looks:
          </p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🔁</div>
            <h6 class="fw-semibold mb-1">Preliminary Championships (4 Rounds)</h6>
            <p class="mb-0 text-muted small">
              Preliminary Championships (4 Rounds):&nbsp;Think of these as the building blocks. They build consistency and stamina.
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🏅</div>
            <h6 class="fw-semibold mb-1">National Championships (4 Rounds)</h6>
            <p class="mb-0 text-muted small">
              National Championships (4 Rounds):&nbsp;This is where the competition heats up! Remember,&nbsp;prizes are awarded at every single National round, so there are plenty of chances to celebrate.
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🎉</div>
            <h6 class="fw-semibold mb-1">The Jumbo Nationals (The Grand Finale)</h6>
            <p class="mb-0 text-muted small">
              The Jumbo Nationals (The Grand Finale):&nbsp;To qualify here, your child’s&nbsp;average percentile&nbsp;across the National rounds is calculated. It’s about steady performance, not just one lucky day.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. Free Resources -->
  <section id="resources" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">3. Leverage the Free Resources</p>
          <h2 class="section-title mb-3">Start with what’s already included</h2>
          <p class="text-muted mb-3">
            Don't start from scratch! One of the best perks of this challenge is the&nbsp;Free Learning Material.
          </p>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Action Step</h6>
            <p class="mb-0 text-muted small">
              Action Step:&nbsp;As soon as you complete the registration, log in and download the materials.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">Pro-Tip</h6>
            <p class="mb-0 text-muted small">
              Pro-Tip:&nbsp;Since the syllabus aligns with school work, use these materials as "fun practice" for their upcoming school assessments. It’s a win-win!
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Preparation Tips -->
  <section id="prep" class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">4. Preparation Tips for Parents</p>
          <h2 class="section-title mb-3">Keep it fun, focused, and low-stress</h2>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Keep it Light</h6>
            <p class="mb-0 text-muted small">
              Keep it Light:&nbsp;Especially for the KG oral rounds, treat it like a game. Ask math questions during car rides or breakfast.
            </p>
          </div>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Consistency over Intensity</h6>
            <p class="mb-0 text-muted small">
              Consistency over Intensity:&nbsp;15 minutes of "Zoom Zoom" practice a day is much more effective than a 3-hour marathon on the weekend.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">Check the Tech</h6>
            <p class="mb-0 text-muted small">
              Check the Tech:&nbsp;For Grades 1–8, ensure you have a stable internet connection and a quiet space for the online tests to avoid any "tech-stress" on the big day.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Why It Matters -->
  <section id="why" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-8">
          <p class="section-eyebrow mb-1">5. Why It Matters</p>
          <h2 class="section-title mb-3">Beyond trophies: building numerical fluency</h2>
          <div class="feature-card mb-3">
            <p class="mb-0 text-muted small">
              Beyond the trophies and certificates, this activity is designed to build&nbsp;numerical fluency. By participating, your child learns that math is a skill they can improve with practice, helping eliminate "math anxiety" before it even starts.
            </p>
          </div>
          <div class="feature-card">
            <p class="mb-0">
              "The goal isn't just to find the answer—it's to enjoy the journey of getting there!"
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4" style="background:#020617;color:#9ca3af;">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span class="small">&copy; 2026 Parent’s Guide – MaRRS Zoom Zoom Math Challenge.</span>
      <span class="text-secondary small">Helping children discover that math is a superpower, not a scary monster.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
