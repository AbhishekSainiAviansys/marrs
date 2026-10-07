<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MaRRS Scientia Exertus Science Competition</title>
<!-- Bootstrap 5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Optional Google Font -->
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
background: radial-gradient(circle at top left, #ecfdf5 0%, #ffffff 40%, #e0f2fe 100%);
padding: 5rem 0 4rem;
}
.hero-badge {
display: inline-flex;
align-items: center;
gap: 0.5rem;
font-size: 0.85rem;
padding: 0.35rem 0.9rem;
border-radius: 999px;
background: rgba(16, 185, 129, 0.12);
color: #065f46;
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
color: #059669;
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
background-color: #f0fdf4;
color: #166534;
margin-right: 0.4rem;
margin-bottom: 0.4rem;
}
/* CTA buttons */
.btn-cta {
border-radius: 999px;
padding: 0.8rem 1.7rem;
font-weight: 600;
box-shadow: 0 14px 30px rgba(16, 185, 129, 0.35);
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
background-color: #f0fdf4;
border-color: #bbf7d0;
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
border-color: rgba(16, 185, 129, 0.55);
}
.feature-icon {
width: 40px;
height: 40px;
border-radius: 999px;
display: inline-flex;
align-items: center;
justify-content: center;
font-size: 1.2rem;
background: linear-gradient(135deg, #dcfce7, #fef3c7);
color: #15803d;
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
background-color: #ecfdf5;
color: #166534;
display: inline-flex;
align-items: center;
justify-content: center;
font-size: 0.9rem;
font-weight: 600;
margin-right: 0.6rem;
}
/* Benefits table */
.benefits-table {
background: white;
border-radius: var(--radius-lg);
overflow: hidden;
box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.benefits-table th {
background: linear-gradient(135deg, #10b981, #059669);
color: white;
font-weight: 600;
}
/* Eligibility band */
.eligibility {
background: radial-gradient(circle at top right, #f0fdf4 0%, #f8fafc 40%, #fef2f2 100%);
}
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
<img src="/newassets/selogo.jpg" style="width: 200px;height: 70px;" alt="MaRRS Logo">
</span>
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse justify-content-end" id="navMain">
<ul class="navbar-nav align-items-lg-center gap-lg-1">
<li class="nav-item"><a class="nav-link active" href="#top">Overview</a></li>
<li class="nav-item"><a class="nav-link" href="#why-join">Why Join</a></li>
<li class="nav-item"><a class="nav-link" href="#support">How to Support</a></li>
<li class="nav-item"><a class="nav-link" href="#benefits">Benefits</a></li>
<li class="nav-item ms-lg-3 mt-2 mt-lg-0">
<a class="btn btn-success btn-sm rounded-pill px-3" href="#">Register Now</a>
</li>
</ul>
</div>
</div>
</nav>

<!-- Hero -->
<main id="top" class="hero">
<div class="container">
<button class="btn btn-cta btn-success text-white me-3 mb-3" style="position: relative;top: -32px;" onclick="history.back()">
← Go Back
</button>
<div class="row align-items-center gy-5">
<div class="col-lg-7">
<div class="hero-badge mb-3">
<span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill">Science</span>
<span>National Science Competition</span>
</div>
<h1 class="hero-title mb-3">
Parents & teachers as <span class="hero-highlight">catalysts</span> for curiosity
</h1>
<p class="hero-subtitle mb-4">
At MaRRS Scientia Exertus, we view parents and teachers as the primary catalysts for a child's curiosity. We designed this competition not to be an "extra" burden, but to be a force multiplier for the education students are already receiving in the classroom.
</p>
<div class="d-flex flex-wrap align-items-center gap-3 mb-4">
<a href="#" class="btn btn-cta btn-success text-white"> Weekly learning plan</a>
<button class="btn btn-ghost" type="button">Invest in Their Curiosity</button>
</div>
<div class="hero-pill-list text-muted">
<span>Grades 1-8 Science</span>
<span>Curriculum aligned</span>
<span>National recognition</span>
</div>
</div>
<div class="col-lg-5">
<div class="hero-card">
<h5 class="fw-semibold mb-2">Competition delivers:</h5>
<ul class="list-group list-group-flush list-group-clean mb-3">
<li class="list-group-item d-flex align-items-start">
<span class="feature-icon me-3">🔬</span>
<div>
<strong>Curriculum Alignment</strong>
<div class="small text-muted">Grade 1–8 categories mirror school science standards.</div>
</div>
</li>
<li class="list-group-item d-flex align-items-start">
<span class="feature-icon me-3">🧠</span>
<div>
<strong>Application Learning</strong>
<div class="small text-muted">"How does this work?" not just "What is this?"</div>
</div>
</li>
<li class="list-group-item d-flex align-items-start">
<span class="feature-icon me-3">💬</span>
<div>
<strong>Viva Voce Skills</strong>
<div class="small text-muted">Public speaking & academic defense confidence.</div>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</main>

<!-- Why Join / Bridging the Gap -->
<section id="why-join" class="py-5 py-lg-6 bg-light">
<div class="container">
<div class="row align-items-end mb-4">
<div class="col-md-6">
<p class="section-eyebrow mb-1">Bridging the Gap</p>
<h2 class="section-title mb-2">Classroom to Competition</h2>
<p class="text-muted mb-0">
The Scientia Exertus framework is meticulously mapped to reinforce the core Science Curriculum.
</p>
</div>
<div class="col-md-6 text-md-end">
<a href="#" class="btn btn-cta btn-success text-white">Join Now</a>
</div>
</div>
<div class="row g-4">
<div class="col-md-6 col-lg-4">
<div class="feature-card h-100 text-center">
<div class="feature-icon mb-3">🌍</div>
<h5 class="fw-semibold mb-2">The Earth</h5>
<p class="text-muted small mb-0">Deeper mastery of topics already studied in school.</p>
</div>
</div>
<div class="col-md-6 col-lg-4">
<div class="feature-card h-100 text-center">
<div class="feature-icon mb-3">⚡</div>
<h5 class="fw-semibold mb-2">Energy</h5>
<p class="text-muted small mb-0">From rote memorization to high-order thinking.</p>
</div>
</div>
<div class="col-md-6 col-lg-4">
<div class="feature-card h-100 text-center">
<div class="feature-icon mb-3">🍎</div>
<h5 class="fw-semibold mb-2">Food & Nutrition</h5>
<p class="text-muted small mb-0">Real-world application through competition rounds.</p>
</div>
</div>
</div>
</div>
</section>

<!-- Benefits Table -->
<section id="benefits" class="py-5 py-lg-6">
<div class="container">
<p class="section-eyebrow mb-3 text-center">What Your Child Gains</p>
<h2 class="section-title mb-5 text-center">Benefits Table</h2>
<div class="row justify-content-center">
<div class="col-lg-10">
<div class="benefits-table">
<table class="table table-hover mb-0">
<thead>
<tr>
<th>Benefit</th>
<th>How Scientia Exertus Delivers It</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Academic Edge</strong></td>
<td>Detailed study materials and quizzes that solidify school-taught concepts.</td>
</tr>
<tr>
<td><strong>Critical Thinking</strong></td>
<td>The Observational Science Quiz trains the brain to spot patterns and scientific anomalies in everyday life.</td>
</tr>
<tr>
<td><strong>National Recognition</strong></td>
<td>Certificates and accolades at State and National levels for academic portfolio.</td>
</tr>
<tr>
<td><strong>Invention Mindset</strong></td>
<td>Encouragement to propose "Inventive Concepts," fostering entrepreneurship in science.</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</section>

<!-- How to Support -->
<section id="support" class="py-5 py-lg-6 bg-light">
<div class="container">
<p class="section-eyebrow mb-3 text-center">How You Can Help</p>
<h2 class="section-title mb-5 text-center">Support Your Students</h2>
<div class="row g-5">
<div class="col-lg-6">
<div class="feature-card h-100 p-4">
<div class="feature-icon mb-3"></div>
<h4 class="fw-semibold mb-3 text-success">For Teachers</h4>
<p class="text-muted mb-0">Use "Deep Study" topics as classroom project themes. Encourage students to present their ideas to the class as "mock Viva" to build confidence.</p>
</div>
</div>
<div class="col-lg-6">
<div class="feature-card h-100 p-4">
<div class="feature-icon mb-3"></div>
<h4 class="fw-semibold mb-3 text-success">For Parents</h4>
<p class="text-muted mb-0">Turn daily routines into "Observational Science" moments. Discuss science of cooking (Nutrition) or bicycle mechanics (Energy) at home.</p>
</div>
</div>
</div>
</div>
</section>

<!-- Closing CTA -->
<section class="py-5 py-lg-6 eligibility text-center">
<div class="container">
<h2 class="section-title mb-4">Science is not just a subject; it is a <span class="hero-highlight">superpower</span>.</h2>
<p class="hero-subtitle mb-5">Help your students and children unlock it.</p>
<div class="d-block d-md-inline-block">
<a href="#" class="btn btn-success btn-lg rounded-pill px-5">Invest in Their Curiosity Today</a>
</div>
</div>
</section>

<!-- Footer -->
<footer class="py-4">
<div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
<span>&copy; 2026 MaRRS Scientia Exertus. Igniting scientific curiosity nationwide.</span>
<span class="text-secondary">Science competitions for Grades 1-8.</span>
</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
