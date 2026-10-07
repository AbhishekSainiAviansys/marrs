<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MaRRS International Spelling Bee – Complete Guide</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
      background: rgba(59, 130, 246, 0.08);
      color: #1d4ed8;
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
      max-width: 38rem;
    }

    .hero-highlight {
      color: #ea580c;
    }

    .hero-card {
      background: #ffffff;
      border-radius: var(--radius-lg);
      padding: 1.75rem 1.75rem 1.3rem;
      box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
      border: 1px solid #e5e7eb;
    }

    .btn-cta {
      border-radius: 999px;
      padding: 0.8rem 1.7rem;
      font-weight: 600;
      border: none;
      box-shadow: 0 14px 30px rgba(37, 99, 235, 0.3);
    }

    .btn-ghost {
      border-radius: 999px;
      padding: 0.8rem 1.4rem;
      font-weight: 500;
      border: 1px solid #e5e7eb;
      color: var(--dark-color);
    }

    .btn-ghost:hover {
      background-color: #eff6ff;
      border-color: #bfdbfe;
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
      border-color: rgba(37, 99, 235, 0.5);
    }

    .feature-icon {
      width: 38px;
      height: 38px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      background: linear-gradient(135deg, #fee2e2, #fef9c3);
      color: #b91c1c;
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
        <span class="rounded-circle bg-warning-subtle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
          <img src="https://marrs.in/newassets/misblogo.png" alt="logo" width="72">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#parents">Parents</a></li>
          <li class="nav-item"><a class="nav-link" href="#teachers">Teachers</a></li>
          <li class="nav-item"><a class="nav-link" href="#framework">Framework</a></li>
          <li class="nav-item"><a class="nav-link" href="#tips">Get Started</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <main id="top" class="hero">
    <div class="container">
      <button class="btn btn-cta btn-primary text-white me-3" style="position: relative; top: -32px;" onclick="history.back()">
        ← Go Back
      </button>

      <div class="row align-items-center gy-5">
        <div class="col-lg-7">
          <div class="hero-badge mb-3">
            <span>Complete MISB Guide</span>
          </div>
          <h1 class="hero-title mb-3">
            Navigate the <span class="hero-highlight">MaRRS International Spelling Bee (MISB)</span> journey
          </h1>
          <p class="hero-subtitle mb-4">
            This guide is designed to help you navigate the MaRRS International Spelling Bee (MISB). Whether you are a parent supporting a child at home or a teacher integrating this into your school's culture, this guide highlights how to maximize the benefits of the world's largest language competition.
          </p>
          <button class="btn btn-cta btn-primary text-white me-3" type="button">
            For Parents & Teachers
          </button>
          <button class="btn btn-ghost" type="button" >
            Register Now
          </button>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">World's Largest Language Competition</h5>
            <p class="small text-muted mb-3">
              For over two decades, MaRRS has championed language acquisition on a global scale.
            </p>
            <ul class="list-group list-group-flush list-group-clean mb-3">
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">🌍</span>
                <div>
                  <strong>Global Reach</strong>
                  <div class="small text-muted">Open to Classes I-XII worldwide</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">🎯</span>
                <div>
                  <strong>Comprehensive Skills</strong>
                  <div class="small text-muted">11 rounds covering all aspects of language comprehension</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">🧠</span>
                <div>
                  <strong>Self-Paced Learning</strong>
                  <div class="small text-muted">Structured for retention and confidence building</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Parents Section -->
  <section id="parents" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">For Parents</p>
          <h2 class="section-title mb-2">Nurturing a Confident Communicator</h2>
          <p class="text-muted mb-0">
            The MaRRS Bee is more than a contest; it's a self-paced journey. Your role is to transform "study time" into "discovery time."
          </p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🏆</div>
            <h6 class="fw-semibold mb-1">Emphasize the Process</h6>
            <p class="text-muted small mb-0">
              Focus on the "lexical development"—how many new words they understand, not just how many they can spell.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">⏱️</div>
            <h6 class="fw-semibold mb-1">Self-Paced Learning</h6>
            <p class="text-muted small mb-0">
              Let your child lead. This builds the self-confidence necessary to reach their full potential.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🎮</div>
            <h6 class="fw-semibold mb-1">Gamify the Practice</h6>
            <p class="text-muted small mb-0">
              Use word games at home to maintain their rapt attention.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🌉</div>
            <h6 class="fw-semibold mb-1">The "Bridge" Mindset</h6>
            <p class="text-muted small mb-0">
              Every word learned is a "bridge to a better world."
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Teachers Section -->
  <section id="teachers" class="py-5 py-lg-6">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">For Teachers</p>
          <h2 class="section-title mb-3">Expanding the Horizon</h2>
          <p class="text-muted mb-3">
            MISB acts as a powerful supplemental tool that picks up where the school curriculum ends.
          </p>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Beyond the Textbook</h6>
            <p class="text-muted small mb-0">
              Use MISB to teach "supplementary language skills" that aren't usually covered in standard lesson plans.
            </p>
          </div>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Foster Healthy Competition</h6>
            <p class="text-muted small mb-0">
              Create a classroom environment where students "interact, experience, and learn" together.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">Focus on Comprehension</h6>
            <p class="text-muted small mb-0">
              Integrate spoken and written rounds into your verbal and written exercises.
            </p>
          </div>
        </div>

        <!-- MaRRS Learning Framework -->
        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">MaRRS Learning Framework</p>
          <h2 class="section-title mb-3">The Learning Framework</h2>
          <p class="text-muted mb-3">
            Understanding the "why" behind the competition helps in guiding students effectively.
          </p>

          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Feature</th>
                  <th>Impact on the Student</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Game-Based Nature</strong></td>
                  <td>High engagement and utilization of "winning aspirations."</td>
                </tr>
                <tr>
                  <td><strong>Multi-Round Format</strong></td>
                  <td>Develops capacities, skills, and dispositions for meaning-making.</td>
                </tr>
                <tr>
                  <td><strong>Global Scale</strong></td>
                  <td>Connects students with thousands of like-minded peers.</td>
                </tr>
                <tr>
                  <td><strong>Self-Structured Study</strong></td>
                  <td>Enhances long-term retention and structured thinking.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Get Started -->
  <section id="tips" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4 mb-5">
        <div class="col-lg-6">
          <p class="section-eyebrow mb-1">How to Get Started</p>
          <h2 class="section-title mb-3">Getting Started</h2>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Identify the Category</h6>
            <p class="text-muted small mb-0">
              MISB is open to students from Class I to XII. Ensure the student is registered in the correct level.
            </p>
          </div>

          <div class="feature-card mb-3">
            <h6 class="fw-semibold mb-1">Attend Orientation</h6>
            <p class="text-muted small mb-0">
              Don't skip the orientation classes! These are vital for students to "interact and experience" the environment.
            </p>
          </div>

          <div class="feature-card">
            <h6 class="fw-semibold mb-1">Use MaRRS Resources</h6>
            <p class="text-muted small mb-0">
              Utilize the provided materials designed to move beyond the school curriculum.
            </p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="reminder-card">
            <h5 class="fw-semibold mb-2">Pro-Tip</h5>
            <p class="mb-0">
              Remember that language acquisition is a marathon, not a sprint. The "two decades" of MaRRS history show that the most successful participants are those who treat it as a tool for continuous learning.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span class="small">&copy; 2026 MaRRS International Spelling Bee – Complete Guide.</span>
      <span class="text-secondary small">Language learning is the bridge to a better world.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
