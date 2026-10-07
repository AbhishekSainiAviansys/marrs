<?php include('headertest.php'); ?>


           <style>
           :root{
--blue:#0B4F8A;
--orange:#FF5A1F;
--light:#F4F8FC;
--dark:#102033;
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Poppins,sans-serif;background:#f6f8fb;color:#222;line-height:1.7}
header{background:#fff;position:sticky;top:0;z-index:999;box-shadow:0 2px 10px rgba(0,0,0,.08)}
.nav{max-width:1200px;margin:auto;padding:15px 20px;display:flex;justify-content:space-between;align-items:center}
.nav img{height:60px}
.btnAll{background:#c2183c;color:#fff;padding:12px 24px;border-radius:30px;text-decoration:none;font-weight:600}
.hero{background:linear-gradient(135deg,#0d5ea8,#0c2f55);color:#fff;padding:80px 20px}
.hero-wrap{max-width:1200px;margin:auto;display:grid;grid-template-columns:1.2fr 1fr;gap:40px;align-items:center}
.hero h1{font-size:3.5rem;line-height:1.1;margin-bottom:15px}
.hero h2{color:#ffd54f;margin-bottom:20px}
.hero p{margin-bottom:25px}
.wordlogo{max-width:500px;width:100%;border-radius: 15px;}
.section{max-width:1200px;margin:auto;padding:80px 20px}
.title{text-align:center;margin-bottom:40px}
.title h2{font-size:2.3rem;color:#0d5ea8}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:25px}
.card{background:#fff;padding:25px;border-radius:16px;box-shadow:0 6px 20px rgba(0,0,0,.08)}
.card h3{color:#c2183c;margin-bottom:10px}
.timeline{display:grid;grid-template-columns:repeat(3,1fr);gap:25px}
.level{background:#fff;padding:30px;border-radius:18px;text-align:center;box-shadow:0 6px 20px rgba(0,0,0,.08)}
.circle{width:60px;height:60px;border-radius:50%;background:#0d5ea8;color:#fff;margin:0 auto 15px;display:flex;align-items:center;justify-content:center;font-weight:700}
.tableview{width:100%;border-collapse:collapse;background:#fff;box-shadow:0 6px 20px rgba(0,0,0,.08)}
th,td{border:1px solid #ddd;padding:12px;text-align:center}
th{background:#0d5ea8 !important ;color:#fff !important;}
.cta{background:#c2183c;color:#fff;text-align:center;padding:70px 20px}
.cta h2{font-size:2.5rem;margin-bottom:15px}
footer{background:#10243f;color:#fff;text-align:center;padding:30px}
@media(max-width:900px){
.hero-wrap,.timeline{grid-template-columns:1fr}
.hero h1{font-size:2.4rem}
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
<div class="hero-wrap">
<div>
<h1>MaRRS Word Chase Championship</h1>
<h2>Chase Words. Build Confidence. Master English.</h2>
<p>The MaRRS Word Chase Championship is a prestigious national-level English challenge designed to help students develop a deeper understanding of the English language while enjoying the thrill of competition.</p>
<p>Created for learners who have already mastered the fundamentals of English, Word Chase encourages students to move beyond basic language skills and explore the richness, precision, and power of words.</p>
<a href="/signin?tab=register" class="btn btnAll">Register Today</a>
</div>
<div style="text-align:center">
<img class="wordlogo" src="https://marrs.in/images/Wod-chase-logo.jpg" alt="Word Chase">
</div>
</div>
</section>

<section class="section">
<div class="title"><h2>Why Participate?</h2></div>
<div class="cards">
<div class="card"><h3>Vocabulary Development</h3><p>Build a richer and stronger vocabulary.</p></div>
<div class="card"><h3>Language Accuracy</h3><p>Master punctuation and correct usage.</p></div>
<div class="card"><h3>Contextual Usage</h3><p>Understand and apply words effectively.</p></div>
<div class="card"><h3>Comprehension</h3><p>Enhance reading and language understanding.</p></div>
<div class="card"><h3>Word Recall</h3><p>Improve memory and retention skills.</p></div>
<div class="card"><h3>Critical Thinking</h3><p>Apply language intelligently and confidently.</p></div>
</div>
</section>

<section class="section">
<div class="title"><h2>Competition Structure</h2></div>
<div class="timeline">
<div class="level"><div class="circle">1</div><h3>Interschool Level</h3><p>Compete within your school and qualify for the next stage.</p></div>
<div class="level"><div class="circle">2</div><h3>National Prelims</h3><p>Top performers compete with students from across the State.</p></div>
<div class="level"><div class="circle">3</div><h3>National Finals</h3><p>The best participants compete for national honours and recognition.</p></div>
</div>
</section>

<section class="section">
<div class="title"><h2>Eligibility</h2><p>Open to students of Grades I to VIII</p></div>
<div class="table-responsive">
<table class="table tableview">
<tr><th>Grade</th><th>I</th><th>II</th><th>III</th><th>IV</th><th>V</th><th>VI</th><th>VII</th><th>VIII</th></tr>
<tr><th>Category</th><td>I</td><td>II</td><td>III</td><td>IV</td><td>V</td><td>VI</td><td>VII</td><td>VIII</td></tr>
</table>
</div>
</section>

<section class="section">
<div class="title"><h2>Competition Highlights</h2></div>
<div class="cards">
<div class="card"><h3>Offline Examination</h3><p>Structured and engaging offline assessment.</p></div>
<div class="card"><h3>Free Learning Material</h3><p>Download comprehensive learning resources after registration.</p></div>
<div class="card"><h3>Exciting Rewards</h3><p>Prizes, certificates and national-level recognition.</p></div>
</div>
</section>

<section class="section">
<div class="title"><h2>More Than A Competition</h2></div>
<p style="text-align:center;max-width:900px;margin:auto">The MaRRS Word Chase Championship is not merely a test of language skills—it is an opportunity for students to expand their vocabulary, improve communication, develop confidence, and discover the joy of mastering the English language.</p>
</section>

<section class="cta">
<h2>Register Today and Begin Your Journey Towards English Excellence!</h2>
<p>Participants qualify for the next level based on percentile performance at each stage.</p>
<a href="/addschool"
                   class="btn btnAll my-2" style="background:#fff;color:#c2183c">
                    Spark a Revolution - Enroll Your School Now →
                </a>
<a href="/signin?tab=register" class="btn btnAll my-2" style="background:#fff;color:#c2183c">Register Now</a>
</section>


       
   
 <?php include('footertest.php'); ?>
