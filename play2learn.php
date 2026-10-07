<?php include('headertest.php')?>

<style>
:root {
            
            --blue:#0B4F8A;
        }


/* ===== SECTION ===== */
.section{
  padding:45px;
  border-radius:18px;
  margin-bottom:30px;
  box-shadow:0 8px 25px rgba(0,0,0,0.05);
  transition:0.3s;
}
.section:hover{
  transform:translateY(-5px);
}
.section.bg-4 {
    background: linear-gradient(135deg, #fff7ec, #ffeede);
    padding: 60px 30px;
    border-radius: 20px;
    text-align: center;
    max-width: 900px;
    margin: 40px auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.section.bg-4 h3 {
    font-size: 32px;
    color: #ff7a00;
    margin-bottom: 10px;
    font-weight: 700;
}

.section.bg-4 h5 {
    font-size: 20px;
    color: #444;
    margin-bottom: 30px;
    font-weight: 500;
}

.custom-list {
    list-style: none;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 15px;
}

.custom-list li {
    background: #ffffff;
    padding: 15px 20px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 500;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.custom-list li::before {
    content: "✓";
    color: #ff7a00;
    font-weight: bold;
    font-size: 18px;
}

.custom-list li:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

/* ===== BACKGROUNDS ===== */
.bg-1{background:linear-gradient(135deg, #0b447a, #0831ab);}
.bg-2{background:linear-gradient(135deg,#ffffff,#fff7ef);}
.bg-3{background:linear-gradient(135deg,#fffaf5,#ffffff);}
.bg-4{background:linear-gradient(135deg,#fff4e8,#ffffff);}

/* ===== HERO ===== */
.hero-img{
  max-height:360px;
  transition:0.4s;
}
.hero-img:hover{
  transform:scale(1.08);
}

/* ===== BUTTON ===== */
.btn-warning{
  background:linear-gradient(135deg,#f7941d,#e8790a);
  border:none;
  padding:12px 30px;
  border-radius:10px;
  color:#fff;
  font-weight:600;
}
.btn-warning:hover{
  transform:translateY(-3px);
}

/* ===== HEADINGS ===== */
h3{
  position:relative;
  margin-bottom:25px;
}
h3::after{
  content:"";
  width:60px;
  height:4px;
  background:#f7941d;
  position:absolute;
  bottom:-10px;
  left:0;
}

/* ===== ICONS ===== */
.icon-box{
  width:50px;
  height:50px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#fff2e6;
  color:#f7941d;
  border-radius:12px;
  font-size:20px;
}

/* ===== BENEFIT CARDS ===== */
.benefit-card{
  display:flex;
  gap:15px;
  padding:20px;
  border-radius:12px;
  background:#fff;
  transition:0.3s;
}
.benefit-card:hover{
  transform:translateY(-6px);
}

/* ===== LEVEL CARDS ===== */
.level-card{
  padding:20px;
  border-left:4px solid #f7941d;
  border-radius:12px;
  margin-bottom:15px;
  background:#fff;
  position:relative;
}
.level-card i{
  position:absolute;
  right:15px;
  top:20px;
  color:#f7941d;
}

/* ===== LIST ICON ===== */
.custom-list li{
  list-style:none;
  padding-left:28px;
  position:relative;
}
.custom-list li::before{
  content:"\f058";
  font-family:"Font Awesome 6 Free";
  font-weight:900;
  
  color:#f7941d;
}
.lead{
    color: #cdd33c;
}
/* ===== RESPONSIVE ===== */
@media(max-width:768px){
  .section{text-align:center;padding:25px;}
  h3::after{left:50%;transform:translateX(-50%);}
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
<div class="container py-5">

<!-- HERO -->
<div class="section bg-1">
<div class="row align-items-center">
<div class="col-md-6">
<h1 class="text-white">MaRRS Play2Learn Carnival</h1>
<h4 class="text-white">Where Learning Begins Through Play</h4>
<p class="lead">Discover • Explore • Learn • Shine</p>

<a href="/signin?tab=register" class="btn btn-warning">
REGISTER NOW <i class="fa-solid fa-arrow-right"></i>
</a>
</div>

<div class="col-md-6 text-center">
<img src="https://marrs.in/newassets/logos/p2l.png" class="hero-img">
</div>
</div>
</div>

<!-- INTRO -->
<style>
.section.bg-2 {
    background: linear-gradient(135deg, #eef7ff, #f9fcff);
    padding: 60px 30px;
    border-radius: 20px;
    max-width: 900px;
    margin: 40px auto;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    text-align: center;
}

.section.bg-2 p {
    font-size: 17px;
    color: #444;
    line-height: 1.7;
    margin-bottom: 18px;
}

.section.bg-2 p:first-child {
    font-size: 19px;
    font-weight: 600;
    color: #1a73e8;
}

.section.bg-2 h5 {
    font-size: 20px;
    margin-top: 30px;
    color: #222;
}

.section.bg-2 .fw-semibold {
    display: inline-block;
    margin-top: 10px;
    font-size: 18px;
    font-weight: 600;
    color: #ff7a00;
    background: #fff;
    padding: 10px 20px;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

/* Optional subtle animation */
.section.bg-2:hover {
    transform: translateY(-3px);
    transition: 0.3s ease;
}
</style>

<div class="section bg-2">
    <p>
        The MaRRS Play2Learn Carnival is a national-level developmental championship 
        for children in Playschool, LKG, and UKG.
    </p>

    <p>
        Built around the natural way young minds absorb the world, the Carnival blends 
        joyful, age-appropriate activities with structured skill-building. We nurture 
        creativity, curiosity, and cognitive growth, transforming education into an 
        unforgettable adventure.
    </p>

    <p>
        More than a competition, it’s a celebration. Play2Learn is a warm, encouraging 
        experience that inspires every child to discover their boundless potential.
    </p>

    <h5 class="fw-bold mt-4">Open to Young Explorers in:</h5>
    <p class="fw-semibold">Playschool | LKG | UKG</p>
</div>

<!-- WHY -->
<div class="section bg-3">
<h3>Why Choose MaRRS Play2Learn Carnival?</h3>

<p>Early childhood lays the foundation for lifelong success. The Play2Learn Carnival gives your child a joyful, positive platform to build essential milestones and shine.</p>

<div class="row g-3 mt-3">

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-lightbulb"></i></div>
<div>
<h6>Creativity & Imagination</h6>
<p>Encourages independent thinking and confident self-expression.</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-brain"></i></div>
<div>
<h6>Cognitive Development</h6>
<p>Sharpens observation, memory, reasoning, and problem-solving.</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-hand"></i></div>
<div>
<h6>Fine Motor Skills</h6>
<p>Enhances hand-eye coordination through tailored interactive challenges.</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-comments"></i></div>
<div>
<h6>Communication Skills</h6>
<p>Promotes active listening, vocabulary, and expressive speech.</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-users"></i></div>
<div>
<h6>Social & Emotional Growth</h6>
<p>Builds resilience, healthy peer interaction, and social confidence.</p>
</div>
</div>
</div>

<div class="col-md-6">
<div class="benefit-card">
<div class="icon-box"><i class="fa-solid fa-gamepad"></i></div>
<div>
<h6>Learning Through Play</h6>
<p>Keeps young minds deeply engaged without the pressure of traditional testing.</p>
</div>
</div>
</div>

</div>
</div>

<div class="section bg-4">
    <h3>A Celebration of Early Learning</h3>
    <h5>Every Child is a Winner</h5>

    <ul class="custom-list">
        <li>Spontaneity & Curiosity</li>
        <li>Advanced Observation Skills</li>
        <li>Social Confidence</li>
        <li>Holistic Cognitive Growth</li>
    </ul>
</div>

<div class="container py-5">

    <!-- Heading -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Competition Structure</h2>
        <h5 class="text-muted">A Progressive Journey of Achievement</h5>
        <p class="mt-3">
            Watch your child grow from local participation to national recognition through four exciting stages.
        </p>
    </div>

    <!-- Levels -->
    <div class="row g-4">

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-warning fw-bold">Level 1</h6>
                    <h5 class="fw-bold">School Carnival</h5>
                    <p class="small text-muted">
                        Children participate within their own schools in a familiar and safe environment.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-warning fw-bold">Level 2</h6>
                    <h5 class="fw-bold">Interschool Carnival</h5>
                    <p class="small text-muted">
                        Qualified students advance to district-level centres for broader exposure.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-warning fw-bold">Level 3</h6>
                    <h5 class="fw-bold">National Prelims</h5>
                    <p class="small text-muted">
                        Top performers compete at premier state-level centres.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-warning fw-bold">Level 4</h6>
                    <h5 class="fw-bold">National Finals</h5>
                    <p class="small text-muted">
                        Finalists compete nationally and showcase their talents on a grand stage.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <p class="text-center text-muted mt-4 small">
        * Qualification to each level is based on performance at the previous stage.
    </p>

    <!-- International Section -->
    <div class="text-center mt-5">
        <h4 class="fw-bold">The Road Beyond National Success</h4>
        <h6 class="text-muted">The Gateway to International Recognition</h6>
        <p class="mt-3">
            The journey doesn’t end at the National Finals. Your child can step onto the global stage!
        </p>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body text-center">
            <h5 class="fw-bold text-warning">Exclusive International Opportunity</h5>
            <p class="mb-0">
                National finalists gain eligibility for the prestigious 
                <strong>MaRRS Primary Colors International Championship</strong>, 
                offering global exposure and interaction with young talents worldwide.
            </p>
        </div>
    </div>

    <!-- Gains Section -->
    <div class="row mt-5 g-4">

        <!-- Children -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">What Children Gain</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Confidence to participate</li>
                        <li class="list-group-item">A lifelong love for learning</li>
                        <li class="list-group-item">Healthy competitive exposure</li>
                        <li class="list-group-item">Holistic development</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Parents -->
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">What Parents Gain</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">National benchmarking insights</li>
                        <li class="list-group-item">Understanding of child’s strengths</li>
                        <li class="list-group-item">Visible developmental improvements</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Rewards -->
    <div class="text-center mt-5">
        <h4 class="fw-bold">Recognition & Rewards</h4>
        <p class="text-muted">
            Every child leaves feeling valued and inspired.
        </p>
    </div>

    <div class="row g-4 mt-3">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-warning">Every Participant Receives</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Participation Certificate</li>
                        <li class="list-group-item">Benchmarking Report</li>
                        <li class="list-group-item">Confidence-building experience</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-warning">Outstanding Performers</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Merit Certificates & Honours</li>
                        <li class="list-group-item">Championship Trophies</li>
                        <li class="list-group-item">International Qualification</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- CTA -->
<div class="section bg-1 text-center py-5">
    <div class="container">
        
        <h3 class="fw-bold text-white mb-3">
            Ready to Begin Your Child's Learning Adventure?
        </h3>
        
        <p class="lead mb-4">
            Join one of India's most loved early learning championships today!
        </p>
        <div class="d-flex flex-column justify-content-center  flex-md-row gap-3">

            <a href="/addschool"
               class="btn btn-light px-3 py-3">
                Spark a Revolution - Enroll Your School Now →
            </a>
        
            <a href="/signin?tab=register" 
           class="btn btn-warning btn-lg px-4 fw-semibold shadow-sm">
            REGISTER TODAY
        </a>
        
        </div>
        

        <p class="mt-4 text-warning">
            Discover. Learn. Grow. Shine. From First Steps to International Stages.
        </p>

    </div>
</div>

</div>

<?php include('footertest.php')?>