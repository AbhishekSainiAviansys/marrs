<?php include('headertest.php')?>
<style>
:root{
--blue:#0B4F8A;
--orange:#FF5A1F;
--light:#F4F8FC;
--dark:#102033;
}

.hero{
background:linear-gradient(135deg,var(--blue),#071a33);
color:#fff;padding:80px 8%;
}
.container{max-width:1300px;margin:auto}
.hero-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:50px;align-items:center}
h1{font-size:64px;line-height:1.1}
.hero p{font-size:20px;margin:20px 0}
.btnAll{display:inline-block;padding:15px 28px;border-radius:40px;text-decoration:none;font-weight:bold;margin-right:12px}
.primary{background:var(--orange);color:#fff}
.secondary{background:#fff;color:var(--blue)}
.section{padding:80px 8%}
.title{text-align:center;margin-bottom:50px}
.title h2{font-size:42px;color:var(--blue)}
.journey{display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap}
.step{flex:1;min-width:180px;background:#fff;padding:25px;border-radius:18px;box-shadow:0 5px 15px rgba(0,0,0,.08);text-align:center}
.skills{display:grid;grid-template-columns:repeat(3,1fr);gap:25px}
.card{background:#fff;padding:28px;border-radius:18px;box-shadow:0 5px 15px rgba(0,0,0,.08)}
.alt{background:var(--light)}
.split{display:grid;grid-template-columns:1fr 1fr;gap:50px;align-items:center}
.rounds{display:grid;grid-template-columns:1fr 1fr;gap:30px}
.timeline{text-align:center;font-size:24px;font-weight:bold}
.table{width:100%;border-collapse:collapse}
.table th,.table td{padding:12px;border:1px solid #ddd}
.table th{background:var(--blue);color:#fff}
.cta{background:var(--orange);color:#fff;text-align:center;padding:90px 8%}
.regbtn:hover
 {
    background:#03A9F4;
}
.brochurebtn:hover{
    background:#FFEB3B;
    color:#000;
}
img{max-width:100%}
@media(max-width:900px){
.hero-grid,.split,.rounds,.skills{grid-template-columns:1fr}
h1{font-size:42px}
}
.header-top{
    background: linear-gradient(135deg, var(--blue), #071a33);
    padding:1rem 2rem;
}
</style>
  <div class="header-top">
    <button class="btn btn-danger btn-sm text-white"  onclick="history.back()">
      ← Go Back
    </button>
</div>
<section class="hero">
<div class="container">
<div class="hero-grid">
<div>
<h1>Unlock the Power of Words</h1>
<h2>Build Vocabulary. Master English.</h2>
<p>The premier national-level English language competition designed to strengthen vocabulary, spelling, comprehension, pronunciation and communication skills.</p>
<p><strong>Open to Students from Grades 1–8</strong></p>
<a href="/signin?tab=register" class="btn primary regbtn my-2 btnAll">Register Online Now</a>
<a href="/brochure/MOW.pdf" class="btn secondary brochurebtn my-2 btnAll">Download Brochure</a>

</div>
<div align="center">
<img src="https://marrs.in/images/mzofwds.png" class="img-fluid mb-2" width="300px" alt="Maze of Words Championship">
<h2>MaRRS Maze of Words Championship</h2>
<!--<p>Chase Words. Build Confidence. Master English.</p>-->
</div>
</div>
</div>
</section>

<section class="section">
<div class="container">
<div class="title"><h2>Your Journey to Language Excellence</h2></div>
<div class="journey">
<div class="step">Discover Words</div>
<div class="step">Build Vocabulary</div>
<div class="step">Develop Communication</div>
<div class="step">Compete with Confidence</div>
<div class="step">Become a Champion</div>
</div>
</div>
</section>

<section class="section alt">
<div class="container">
<div class="title"><h2>The Skills That Set Champions Apart</h2></div>
<div class="skills">
<div class="card"><h3>Vocabulary Mastery</h3><p>Master new words and express ideas effortlessly.</p></div>
<div class="card"><h3>Spelling Precision</h3><p>Develop accuracy in written communication.</p></div>
<div class="card"><h3>Listening Excellence</h3><p>Enhance comprehension and active listening.</p></div>
<div class="card"><h3>Pronunciation & Fluency</h3><p>Build confidence in spoken English.</p></div>
<div class="card"><h3>Communication Skills</h3><p>Express ideas clearly and effectively.</p></div>
<div class="card"><h3>Lifelong Confidence</h3><p>Develop a lasting command of language.</p></div>
</div>
</div>
</section>

<section class="section">
<div class="container split">
<div>
<h2 style="color:#0B4F8A">A Journey Towards Language Mastery</h2>
<p>English proficiency is the foundation of academic achievement and future leadership. The MaRRS Maze of Words Championship helps students develop practical language skills through immersive challenges that encourage critical thinking, communication, and confidence.</p>
</div>
<div>
<div class="card">
<h3>More Than Learning</h3>
<p>Experience competition, growth, recognition and skill development in one championship platform.</p>
</div>
</div>
</div>
</section>

<section class="section alt">
<div class="container">
<div class="title"><h2>Inside the Championship</h2></div>
<div class="rounds">
<div class="card">
<h3>Written Challenges</h3>
<ul>
<li>Words in a Word</li>
<li>Jumbled Letters & Words</li>
<li>Bull's Eye</li>
<li>Word Matrix</li>
<li>Russian Doll</li>
</ul>
</div>
<div class="card">
<h3>Oral Challenges</h3>
<ul>
<li>Parts of Speech</li>
<li>Listening Comprehension</li>
<li>Mix & Match</li>
<li>Word Morph</li>
<li>Pick & Spell</li>
</ul>
</div>
</div>
</div>
</section>

<section class="section">
<div class="container">
<div class="title"><h2>Road to the National Championship</h2></div>
<div class="timeline">
 Regional Round ➜ State Qualification ➜ National Championship ➜ Recognition & Awards
</div>
</div>
</section>

<section class="section alt">
<div class="container">
<div class="title"><h2>Who Can Participate?</h2></div>
<table class="table">
<tr><th>Category</th><th>Grades</th></tr>
<tr><td>I</td><td>Grade 1</td></tr>
<tr><td>II</td><td>Grade 2</td></tr>
<tr><td>III</td><td>Grades 3–4</td></tr>
<tr><td>IV</td><td>Grades 5–6</td></tr>
<tr><td>V</td><td>Grades 7–8</td></tr>
</table>
</div>
</section>

<section class="section">
<div class="container">
<div class="title"><h2>Rewards & Recognition</h2></div>
<div class="skills">
<div class="card">Participation Certificate</div>
<div class="card">National Benchmarking</div>
<div class="card">Skill Development Experience</div>
<div class="card">Championship Recognition</div>
<div class="card">Merit Awards</div>
<div class="card">National Honours</div>
</div>
</div>
</section>

<section class="cta">
<h2>Ready to Become a Word Champion?</h2>
<p>Join thousands of students building elite language skills and lifelong confidence.</p>
<a href="/addschool"
       class="btn btn-light my-2 btnAll">
        Spark a Revolution - Enroll Your School Now →
    </a>
<!--<h3>Chase Words. Build Confidence. Master English.</h3>-->
</section>
<?php include('footertest.php')?>