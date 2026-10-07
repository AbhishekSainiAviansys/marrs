<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>15‑Minute Fun Spelling Schedule</title>

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
      font-size: clamp(2.2rem, 3vw + 1rem, 3.2rem);
      line-height: 1.1;
      letter-spacing: -0.03em;
    }

    .hero-subtitle {
      font-size: 1.02rem;
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

    .day-pill {
      font-size: 0.8rem;
      padding: 0.15rem 0.75rem;
      border-radius: 999px;
      background-color: #eff6ff;
      color: #1d4ed8;
      display: inline-block;
      margin-bottom: 0.4rem;
    }

    .schedule-table {
      border-radius: var(--radius-lg);
      overflow: hidden;
      border: 1px solid #e5e7eb;
      background-color: #ffffff;
    }

    .schedule-table thead {
      background: linear-gradient(135deg, #eff6ff, #fef3c7);
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

    .reminder-card {
      border-radius: var(--radius-lg);
      background: #fef3c7;
      border: 1px dashed #f59e0b;
      padding: 1.25rem 1.4rem;
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
        <span class="rounded-circle bg-primary-subtle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
          🧩
        </span>
        <span>15‑Minute Fun Spelling</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navMain">
        <ul class="navbar-nav align-items-lg-center gap-lg-1">
          <li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
          <li class="nav-item"><a class="nav-link" href="#schedule">Weekly plan</a></li>
          <li class="nav-item"><a class="nav-link" href="#levels">Level tips</a></li>
          <li class="nav-item"><a class="nav-link" href="#parents">For parents</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <main id="top" class="hero">
    <div class="container">
      <div class="row align-items-center gy-5">
        <div class="col-lg-7">
          <div class="hero-badge mb-3">
            <span>Designed for Junior KG & Senior KG</span>
          </div>
          <h1 class="hero-title mb-3">
            A <span class="hero-highlight">15‑Minute Fun</span> Spelling Game Plan
          </h1>
          <p class="hero-subtitle mb-4">
            This schedule is designed specifically for Junior KG and Senior KG attention spans. The goal is to keep it under 15 minutes a day so that spelling stays a fun game, not a boring chore.
          </p>
          <button class="btn btn-cta btn-primary text-white me-3" type="button" onclick="document.getElementById('schedule').scrollIntoView({behavior:'smooth'})">
            View weekly schedule
          </button>
          <button class="btn btn-ghost" type="button" onclick="document.getElementById('levels').scrollIntoView({behavior:'smooth'})">
            See level‑wise tips
          </button>
          <p class="text-muted small mt-3 mb-0">
            Target: <strong>3–5 new words per week</strong> + review of old favourites.
          </p>
        </div>

        <div class="col-lg-5">
          <div class="hero-card">
            <h5 class="fw-semibold mb-2">Why this routine works</h5>
            <p class="small text-muted mb-3">
              Short, playful daily tasks keep your child engaged while steadily building spelling, vocabulary, and confidence.
            </p>
            <ul class="list-group list-group-flush list-group-clean mb-3">
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">🎨</span>
                <div>
                  <strong>Creative themes each day</strong>
                  <div class="small text-muted">Artist, Musician, Builder, Detective, Storyteller, Show & Tell, and Rest.</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">⏱️</span>
                <div>
                  <strong>Under 15 minutes</strong>
                  <div class="small text-muted">Perfect for little attention spans, easy to repeat week after week.</div>
                </div>
              </li>
              <li class="list-group-item d-flex align-items-start px-0">
                <span class="feature-icon me-3">💛</span>
                <div>
                  <strong>Fun over pressure</strong>
                  <div class="small text-muted">Focus on joyful learning and participation, not perfection.</div>
                </div>
              </li>
            </ul>
            <div class="border-top pt-3 mt-2">
              <span class="small text-muted">You can reuse this same pattern with new words every week.</span>
            </div>
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
          <p class="section-eyebrow mb-1">Weekly plan</p>
          <h2 class="section-title mb-2">The "15‑Minute Fun" weekly schedule</h2>
          <p class="text-muted mb-0">
            Pick 3–5 new words from the syllabus for the week, keep a few old favourites for review, and follow this playful theme for each day.
          </p>
        </div>
      </div>

      <div class="schedule-table">
        <table class="table mb-0 align-middle">
          <thead class="small text-muted">
            <tr>
              <th scope="col" style="width: 13%;">Day</th>
              <th scope="col" style="width: 18%;">Theme</th>
              <th scope="col">Activity</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="day-pill">Monday</span></td>
              <td><strong>The Artist</strong></td>
              <td>
                <strong>Look & Draw:</strong>
                Write a word from the syllabus. Have your child draw the word (for example, if the word is “SUN,” they draw a big yellow sun around the letters).
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Tuesday</span></td>
              <td><strong>The Musician</strong></td>
              <td>
                <strong>Spelling Chant:</strong>
                Create a silly rhythm or song for the week’s words. Clap for every vowel! Example chant: <code>S‑U</code> (clap) <code>-N!</code>
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Wednesday</span></td>
              <td><strong>The Builder</strong></td>
              <td>
                <strong>Tactile Play:</strong>
                Use play‑dough, sand, or magnetic letters to “build” the words. Feeling the shapes of the letters helps with cognitive memory.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Thursday</span></td>
              <td><strong>The Detective</strong></td>
              <td>
                <strong>Word Hunt:</strong>
                Hide the written words around the room. When they find one, they have to say the letters out loud to “capture” it.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Friday</span></td>
              <td><strong>The Storyteller</strong></td>
              <td>
                <strong>Context Day:</strong>
                Ask your child to use the word in a sentence about their favourite toy or friend. This builds the communication skills mentioned in your goals.
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Saturday</span></td>
              <td><strong>Show & Tell</strong></td>
              <td>
                <strong>Mini‑Bee:</strong>
                Do a low‑pressure “mock” School Level round. Give them a high‑five or a sticker for every effort made, regardless of the result!
              </td>
            </tr>
            <tr>
              <td><span class="day-pill">Sunday</span></td>
              <td><strong>Rest Day</strong></td>
              <td>
                <strong>Read Aloud:</strong>
                No spelling today—just read a storybook together to spark that love for language.
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p class="small text-muted mt-2 mb-0">
        Tip: You can keep the same structure every week, only swapping in new words as your child progresses.
      </p>
    </div>
  </section>

  <!-- Level‑wise Tips -->
  <section id="levels" class="py-5 py-lg-6">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <p class="section-eyebrow mb-1">Pro‑tips by level</p>
          <h2 class="section-title mb-2">Adapting the routine as your child progresses</h2>
          <p class="text-muted mb-0">
            Use the same 15‑minute structure, but gently adjust Saturday’s “Mini‑Bee” to match the competition level.
          </p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🏫</div>
            <h6 class="fw-semibold mb-1">School Level</h6>
            <p class="text-muted small mb-0">
              Focus on simple 3–4 letter words and building confidence in front of a small “audience” (even stuffed animals count!).
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">📝</div>
            <h6 class="fw-semibold mb-1">National Prelims</h6>
            <p class="text-muted small mb-0">
              Introduce slightly longer words and practise “listening carefully” to the word before starting to spell.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🏆</div>
            <h6 class="fw-semibold mb-1">National Championship</h6>
            <p class="text-muted small mb-0">
              Practise clear pronunciation and calm spelling. Here, the reward is poise, focus, and unexpected confidence.
            </p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="feature-card h-100">
            <div class="feature-icon mb-2">🌍</div>
            <h6 class="fw-semibold mb-1">Primary Colours (International)</h6>
            <p class="text-muted small mb-0">
              Add words from different cultures or categories to prepare for the global flavour of the International Championship.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Parents Reminder -->
  <section id="parents" class="py-5 py-lg-6 bg-light">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <p class="section-eyebrow mb-1">Important reminder</p>
          <h2 class="section-title mb-3">For parents of Junior & Senior KG</h2>
          <div class="reminder-card">
            <p class="mb-2">
              At the Junior and Senior KG level, <strong>participation is the victory.</strong>
            </p>
            <p class="mb-2">
              If they get a word wrong, simply say:
            </p>
            <p class="mb-0">
              <code>“That was a great try! Let’s see if we can find the hidden letter we missed.”</code>
            </p>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="feature-card h-100">
            <p class="mb-2"><span class="tip-badge">1</span><strong>Keep it light</strong></p>
            <p class="text-muted small mb-3 ms-4">
              End every session with a smile, a hug, or a high‑five, not with marks or scores.
            </p>
            <p class="mb-2"><span class="tip-badge">2</span><strong>Celebrate effort</strong></p>
            <p class="text-muted small mb-3 ms-4">
              Stickers, stars, or a tiny “dance break” are enough to make the practice feel like a game.
            </p>
            <p class="mb-2"><span class="tip-badge">3</span><strong>Repeat weekly</strong></p>
            <p class="text-muted small mb-0 ms-4">
              The magic is in consistency—same simple structure, new words, and lots of encouragement.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
      <span class="small">&copy; 2026 15‑Minute Fun Spelling Routine.</span>
      <span class="text-secondary small">Making spelling a happy habit, one week at a time.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
