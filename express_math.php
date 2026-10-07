<?php include('headertest.php');?>
<style>


:root{
--blue:#0B4F8A;
--orange:#FF5A1F;
--light:#F4F8FC;
--dark:#102033;
}
.register-btn{
background:#e53935;
color:white;
text-decoration:none;
padding:12px 28px;
border-radius:50px;
font-weight:600;
transition:0.3s;
}

.register-btn:hover{
background:#c62828;
}

.hero{
background:linear-gradient(135deg,#0b2f52,#0d5ea8);
color:white;
padding:90px 20px;
}

.hero-container{
max-width:1200px;
margin:auto;
display:grid;
grid-template-columns:1.5fr 1fr;
gap:50px;
align-items:center;
}

.hero h1{
font-size:3rem;
font-weight:800;
line-height:1.1;
margin-bottom:15px;
}

.hero h2{
color:#ffd54f;
font-size:1.6rem;
margin-bottom:20px;
}

.hero p{
margin-bottom:20px;
font-size:1.05rem;
}

.hero img{
width:100%;
max-width:520px;
}

.hero-buttons{
margin-top:25px;
}

.hero-buttons a{
display:inline-block;
margin-right:15px;
padding:14px 30px;
border-radius:40px;
text-decoration:none;
font-weight:600;
margin: 1rem;
}

.primary-btn{
background:#e53935;
color:white;
}

.secondary-btn{
border:2px solid white;
color:white;
}

.section{
max-width:1200px;
margin:auto;
padding:80px 20px;
}

.section-title{
text-align:center;
margin-bottom:50px;
}

.section-title h2{
font-size:2.5rem;
color:#0d5ea8;
margin-bottom:10px;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
}

.card{
background:white;
padding:30px;
border-radius:18px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
transition:0.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card h3{
color:#e53935;
margin-bottom:10px;
}

.timeline{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:25px;
}

.level{
background:white;
padding:35px;
border-radius:18px;
text-align:center;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.number{
width:70px;
height:70px;
margin:auto;
background:#0d5ea8;
color:white;
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
font-size:1.5rem;
font-weight:bold;
margin-bottom:20px;
}

.table-wrapper{
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
background:white;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

th,td{
padding:14px;
border:1px solid #ddd;
text-align:center;
}

th{
background:#0d5ea8;
color:white;
}

.highlight{
background:#fff4e5;
border-left:6px solid #ff9800;
padding:25px;
border-radius:10px;
margin-top:30px;
}

.cta{
background:linear-gradient(135deg,#e53935,#b71c1c);
color:white;
text-align:center;
padding:80px 20px;
}

.cta h2{
font-size:2.8rem;
margin-bottom:15px;
}

.cta p{
max-width:800px;
margin:auto;
margin-bottom:25px;
}

.cta a{
display:inline-block;
background:white;
color:#e53935;
padding:15px 35px;
border-radius:50px;
text-decoration:none;
font-weight:700;
}



@media(max-width:900px){

.hero-container{
grid-template-columns:1fr;
text-align:center;
}

.hero h1{
font-size:2.7rem;
}

.timeline{
grid-template-columns:1fr;
}



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

<div class="hero-container">

<div>

<h1>MaRRS Xpress Math Challenge</h1>

<h2>Unleash Your Math Potential!</h2>

<p>
Discover the excitement of mathematics through a national-level challenge designed to build confidence, sharpen problem-solving skills, and inspire a lifelong love for numbers.
</p>

<p>
More than a competition, the MaRRS Xpress Math Challenge is a progressive learning journey that encourages students to think critically, apply mathematical concepts creatively, and unlock their true potential.
</p>

<div class="hero-buttons">

<a href="#startnow" class="primary-btn">Start Your Math Journey</a>

<a href="#competition" class="secondary-btn">Learn More</a>

</div>

</div>

<div align="center">

<img src="https://marrs.in/images/xpmath.png" alt="Xpress Math Challenge">

</div>

</div>

</section>

<section class="section">

<div class="section-title">

<h2>Why Join the Challenge?</h2>

<p>Build mathematical excellence through challenge, discovery and achievement.</p>

</div>

<div class="cards">

<div class="card">
<h3>Sharpen Your Skills</h3>
<p>Strengthen problem-solving abilities and master mathematical concepts from arithmetic fundamentals to advanced applications.</p>
</div>

<div class="card">
<h3>Boost Your Confidence</h3>
<p>Experience the thrill of achievement through meaningful challenges and competition.</p>
</div>

<div class="card">
<h3>Develop Critical Thinking</h3>
<p>Learn to analyse problems logically and approach solutions creatively.</p>
</div>

<div class="card">
<h3>Progressive Learning Journey</h3>
<p>Every level introduces new insights and deeper mathematical understanding.</p>
</div>

<div class="card">
<h3>Uncover Hidden Talent</h3>
<p>Explore abilities that extend beyond classroom learning.</p>
</div>

<div class="card">
<h3>Stimulate Interest</h3>
<p>Transform mathematics into an exciting journey of discovery and excellence.</p>
</div>

</div>

</section>

<section class="section" id="competition">

<div class="section-title">

<h2>How the Challenge Works</h2>

<p>Structured progression designed to nurture talent at every stage.</p>

</div>

<div class="timeline">

<div class="level">
<div class="number">1</div>
<h3>School Championship</h3>
<p>The foundation level that assesses mathematical understanding through engaging objective questions.</p>
</div>

<div class="level">
<div class="number">2</div>
<h3>National Prelims</h3>
<p>Qualifiers face more challenging problems that test deeper mathematical concepts and applications.</p>
</div>

<div class="level">
<div class="number">3</div>
<h3>National Finals</h3>
<p>The ultimate offline championship where the best young mathematicians compete for national honours.</p>
</div>

</div>

</section>

<section class="section">

<div class="section-title">

<h2>Eligibility & Categories</h2>

<p>Open to students of Grades I to VIII</p>

</div>

<div class="table-wrapper">

<table>

<tr>
<th>Grade</th>
<th>I</th>
<th>II</th>
<th>III</th>
<th>IV</th>
<th>V</th>
<th>VI</th>
<th>VII</th>
<th>VIII</th>
</tr>

<tr>
<th>Category</th>
<td>I</td>
<td>II</td>
<td>III</td>
<td>IV</td>
<td>V</td>
<td>VI</td>
<td>VII</td>
<td>VIII</td>
</tr>

</table>

</div>

</section>

<section class="section">

<div class="section-title">
<h2>What Participants Get</h2>
</div>

<div class="cards">

<div class="card">
<h3>FREE Learning Materials</h3>
<p>Download comprehensive learning resources to prepare effectively and strengthen mathematical concepts.</p>
</div>

<div class="card">
<h3>Digital Certificates</h3>
<p>Receive downloadable certificates recognising participation and achievement.</p>
</div>

<div class="card">
<h3>National Platform</h3>
<p>Compete with talented students and showcase your mathematical abilities on a national stage.</p>
</div>

</div>

<div class="highlight">

<h3>Mode of Conduct: Offline Examination</h3>

<p>
The competition is conducted in a structured offline format, ensuring a focused, engaging, and distraction-free experience for participants.
</p>

</div>

</section>

<section class="cta" id="startnow">

<h2>Ready to Multiply Your Knowledge?</h2>

<p>
Take the first step towards a brighter mathematical future. Unlock your full mathematical potential with the MaRRS Xpress Math Challenge.
</p>

<div class="d-flex flex-column justify-content-center  flex-md-row gap-3">

    <a href="/addschool"
       class="btn btn-light">
        Spark a Revolution - Enroll Your School Now →
    </a>

    <a href="/signin?tab=register" class="btn btn-light">Register Today</a>


</div>

</section>
<?php include('footertest.php');?>
  
