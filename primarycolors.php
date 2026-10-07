<?php include('headertest.php')?>
<style>
  :root{
    --mrr-orange:#f7941d;
    --mrr-orange-dark:#e8790a;
    --mrr-dark:#2b2b2b;
    --mrr-gray:#6b6b6b;
    --blue:#0B4F8A;
        
  }
  body{
    font-family:'Poppins', sans-serif;
    color:var(--mrr-dark);
    overflow-x:hidden;
  }
/* ===== ENHANCED HEADER ===== */
.page-title-wrapper{
  background:linear-gradient(135deg,#fff,#fff7ed);
  padding:50px 16px 30px;
  border-bottom:1px solid #eee;
}

.page-title-flex{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:20px;
}

.title-content h1{
  font-weight:800;
  font-size:42px;
  line-height:1.2;
}

.marrs{ color:#ec008c; }
.primary{ color:#edbf06; }
.colors{ color:#0095da; }

.title-divider{
  width:70px;
  height:4px;
  background:var(--mrr-orange);
  border-radius:2px;
  margin:10px 0;
}

.title-sub{
  color:var(--mrr-gray);
  font-size:14px;
}

.title-logo img{
  max-height:300px;
}

@media(max-width:767px){
  .page-title-flex{
    flex-direction:column;
    text-align:center;
  }
  .title-logo{ order:-1; }
  .title-content h1{ font-size:28px; }
}
  /* ===== Announcement Bar ===== */
  .announce-bar{
    background: var(--mrr-orange);
    color:#fff;
    text-align:center;
    padding:10px 16px;
    font-size:14px;
    font-weight:500;
    position:relative;
  }
  .announce-bar strong{ font-weight:700; }
  .announce-bar .close-btn{
    position:absolute;
    right:16px;
    top:50%;
    transform:translateY(-50%);
    background:none;
    border:none;
    color:#fff;
    font-size:18px;
    cursor:pointer;
    line-height:1;
  }

  /* ===== Hero Carousel ===== */
  #heroCarousel{
    width:100%;
  }
  #heroCarousel .carousel-item img{
    width:100%;
    height:400px;
    object-fit:contain;
    display:block;
  }
  #heroCarousel .carousel-indicators{
    bottom:14px;
  }
  #heroCarousel .carousel-indicators [data-bs-target]{
    width:10px;
    height:10px;
    border-radius:50%;
    background-color:#fff;
    opacity:.6;
  }
  #heroCarousel .carousel-indicators .active{
    opacity:1;
    background-color:var(--mrr-orange);
  }
  #heroCarousel .carousel-control-prev,
  #heroCarousel .carousel-control-next{
    width:48px;
  }

  @media (max-width:767px){
    #heroCarousel .carousel-item img{ height:280px;object-fit: fill; }
  }

  /* ===== Title Banner ===== */
  .page-title{
    text-align:center;
    padding:50px 16px 10px;
  }
  .page-title h1{
    font-weight:800;
    font-size:38px;
    letter-spacing:1px;
    color:var(--mrr-dark);
    margin-bottom:8px;
  }
  .page-title .title-divider{
    width:70px;
    height:4px;
    background:var(--mrr-orange);
    margin:0 auto 6px;
    border-radius:2px;
  }

  /* ===== International Challenge Section ===== */
  .challenge-section{
    padding:40px 16px 70px;
  }
  .challenge-section h2{
    font-weight:700;
    font-size:26px;
    color:var(--mrr-orange);
    margin-bottom:22px;
    letter-spacing:.5px;
  }
  .challenge-section p{
    color:var(--mrr-gray);
    font-size:15.5px;
    line-height:1.85;
    margin-bottom:18px;
  }
  .challenge-section img{
    width:100%;
    height:auto;
    border-radius:8px;
  }

  /* ===== International Championship — Full Content Section ===== */
  .champ-section{
    padding:10px 16px 30px;
    background:#fff;
  }
  .champ-section .section-kicker{
    text-align:center;
    color:var(--mrr-orange);
    font-weight:700;
    letter-spacing:2px;
    font-size:13px;
    text-transform:uppercase;
    margin-bottom:6px;
  }
  .champ-section .section-heading{
    text-align:center;
    font-weight:800;
    font-size:30px;
    color:var(--mrr-dark);
    margin-bottom:6px;
  }
  .champ-section .section-subheading{
    text-align:center;
    color:var(--mrr-gray);
    font-size:16px;
    font-style:italic;
    max-width:720px;
    margin:0 auto 40px;
  }
  .champ-block{
    margin:0 auto 50px;
  }
  .champ-block h3{
    font-weight:700;
    font-size:21px;
    color:var(--mrr-orange-dark);
    margin-bottom:14px;
    position:relative;
    padding-left:18px;
  }
  .champ-block h3::before{
    content:'';
    position:absolute;
    left:0;
    top:5px;
    width:6px;
    height:6px;
    border-radius:50%;
    background:var(--mrr-orange);
  }
  .champ-block p{
    color:var(--mrr-gray);
    font-size:15.5px;
    line-height:1.85;
    margin-bottom:14px;
  }
  .champ-block ul{
    list-style:none;
    padding:0;
    margin:0 0 8px;
  }
  .champ-block ul li{
    position:relative;
    padding-left:26px;
    margin-bottom:10px;
    color:var(--mrr-dark);
    font-size:15.5px;
    line-height:1.6;
  }
  .champ-block ul li::before{
    content:'\f00c';
    font-family:'Font Awesome 6 Free';
    font-weight:900;
    color:var(--mrr-orange);
    position:absolute;
    left:0;
    top:2px;
    font-size:13px;
  }

  /* Variant cards */
  .variant-grid{
    margin:0 auto 50px;
  }
  .variant-card{
    height:100%;
    background:#fff;
    border:1px solid #f0e7da;
    border-radius:14px;
    padding:26px 22px;
    text-align:center;
    transition:transform .3s ease, box-shadow .3s ease, border-color .3s ease;
  }
  .variant-card:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 28px rgba(247,148,29,0.16);
    border-color:var(--mrr-orange);
  }
  .variant-card .variant-num{
    width:46px;
    height:46px;
    border-radius:50%;
    background:#fff5e8;
    color:var(--mrr-orange);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:800;
    font-size:18px;
    margin:0 auto 16px;
  }
  .variant-card h5{
    font-weight:700;
    font-size:16.5px;
    color:var(--mrr-dark);
    margin-bottom:10px;
  }
  .variant-card p{
    color:var(--mrr-gray);
    font-size:13.5px;
    line-height:1.6;
    margin:0;
  }

  /* Why Unique table */
  .why-table-wrap{
    margin:0 auto 50px;
    overflow-x:auto;
  }
  .why-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 6px 24px rgba(0,0,0,0.06);
  }
  .why-table thead th{
    background:var(--mrr-orange);
    color:#fff;
    font-weight:700;
    font-size:14px;
    letter-spacing:.5px;
    text-transform:uppercase;
    padding:14px 20px;
    text-align:left;
  }
  .why-table tbody td{
    padding:16px 20px;
    font-size:14.5px;
    color:var(--mrr-dark);
    border-bottom:1px solid #f3f3f3;
    vertical-align:top;
  }
  .why-table tbody tr:last-child td{
    border-bottom:none;
  }
  .why-table tbody td:first-child{
    font-weight:700;
    color:var(--mrr-orange-dark);
    white-space:nowrap;
    width:180px;
  }
  .why-table tbody tr:hover{
    background:#fffaf2;
  }

  /* Participation details cards */
  .participation-grid{
    margin:0 auto 50px;
  }
  .participation-card{
    background:#faf9f7;
    border-radius:12px;
    padding:22px 22px;
    height:100%;
  }
  .participation-card .p-icon{
    width:42px;
    height:42px;
    border-radius:50%;
    background:#fff5e8;
    color:var(--mrr-orange);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    margin-bottom:14px;
  }
  .participation-card h6{
    font-weight:700;
    font-size:15px;
    color:var(--mrr-dark);
    margin-bottom:8px;
  }
  .participation-card p{
    color:var(--mrr-gray);
    font-size:14px;
    line-height:1.7;
    margin:0;
  }

  /* Closing CTA banner */
  .champ-cta{
    margin:0 auto 70px;
    background:linear-gradient(135deg, var(--mrr-orange) 0%, #ffb24d 100%);
    border-radius:16px;
    padding:46px 30px;
    text-align:center;
    color:#fff;
  }
  .champ-cta h3{
    font-weight:800;
    font-size:24px;
    margin-bottom:12px;
  }
  .champ-cta p{
    font-size:15.5px;
    opacity:.95;
    max-width:640px;
    margin:0 auto 6px;
    line-height:1.7;
  }
  .champ-cta .champ-tagline{
    font-style:italic;
    font-weight:600;
    font-size:16px;
    margin-top:16px;
  }
  @media (max-width:767px){
    .why-table thead th, .why-table tbody td{ padding:12px 14px; font-size:13px; }
    .why-table tbody td:first-child{ width:130px; }
  }
  .program-cards{
    padding:10px 16px 70px;
  }
  .program-card{
    text-align:center;
    padding:30px 20px 34px;
    border-radius:12px;
    background:#fff;
    box-shadow:0 6px 24px rgba(0,0,0,0.07);
    transition:transform .3s ease, box-shadow .3s ease;
    height:100%;
  }
  .program-card:hover{
    transform:translateY(-8px);
    box-shadow:0 14px 30px rgba(247,148,29,0.18);
  }
  .program-card .icon-wrap{
    width:110px;
    height:110px;
    margin:0 auto 22px;
    border-radius:50%;
    background:#fff5e8;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
  }
  .program-card .icon-wrap img{
    width:62px;
    height:62px;
    object-fit:contain;
  }
  .program-card h5{
    font-weight:700;
    letter-spacing:1px;
    font-size:18px;
    color:var(--mrr-dark);
    margin-bottom:14px;
  }
  .program-card a{
    display:inline-block;
    font-size:13px;
    font-weight:600;
    color:var(--mrr-orange);
    text-decoration:none;
    border:1.5px solid var(--mrr-orange);
    border-radius:20px;
    padding:6px 20px;
    transition:background .25s ease, color .25s ease;
  }
  .program-card a:hover{
    background:var(--mrr-orange);
    color:#fff;
  }

  /* ===== Photo Gallery Slider ===== */
  .gallery-section{
    padding:10px 16px 80px;
    background:#faf9f7;
  }
  .gallery-section .page-title{
    padding-top:60px;
  }
  #gallerySlider{
    padding:0 50px;
  }
  #gallerySlider .carousel-item{
    padding:0 6px;
  }
  #gallerySlider .gallery-row{
    display:flex;
    gap:14px;
  }
  #gallerySlider .gallery-item{
    flex:1;
    overflow:hidden;
    border-radius:8px;
    aspect-ratio:1/1;
    display:block;
  }
  #gallerySlider .gallery-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:transform .4s ease;
    display:block;
  }
  #gallerySlider .gallery-item:hover img{
    transform:scale(1.08);
  }
  #gallerySlider .carousel-control-prev,
  #gallerySlider .carousel-control-next{
    width:44px;
    height:44px;
    top:50%;
    transform:translateY(-50%);
    background:var(--mrr-orange);
    border-radius:50%;
    opacity:.9;
  }
  #gallerySlider .carousel-control-prev{ left:-50px; }
  #gallerySlider .carousel-control-next{ right:-50px; }
  #gallerySlider .carousel-control-prev:hover,
  #gallerySlider .carousel-control-next:hover{ opacity:1; }
  #gallerySlider .carousel-indicators{
    position:static;
    margin-top:24px;
  }
  #gallerySlider .carousel-indicators [data-bs-target]{
    width:9px;
    height:9px;
    border-radius:50%;
    background-color:#d8d8d8;
    opacity:1;
  }
  #gallerySlider .carousel-indicators .active{
    background-color:var(--mrr-orange);
  }
  @media (max-width:767px){
    #gallerySlider{ padding:0 36px; }
    #gallerySlider .carousel-control-prev{ left:-30px; }
    #gallerySlider .carousel-control-next{ right:-30px; }
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
<!-- ===== Hero Carousel ===== -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="5"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/Slides-01.jpg" alt="MaRRS Primary Colors">
    </div>
    <div class="carousel-item">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/Slides-02.png" alt="MaRRS Primary Colors">
    </div>
    <div class="carousel-item">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/3.jpg" alt="MaRRS Primary Colors">
    </div>
    <div class="carousel-item">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/2.jpg" alt="MaRRS Primary Colors">
    </div>
    <div class="carousel-item">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/4.jpg" alt="MaRRS Primary Colors">
    </div>
    <div class="carousel-item">
      <img src="https://www.marrsprimarycolors.in/public/default/site/images/5.jpg" alt="MaRRS Primary Colors">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>



<!-- ===== The International Championship — Full Content ===== -->
<section class="champ-section">
  <div class="container">
<h1 class="text-center">
          <span class="marrs">MaRRS</span>
          <span class="primary">PRIMARY</span>
          <span class="colors">COLORS</span>
        </h1>
    <h2 class="section-heading">The International Championship</h2>
    <p class="section-subheading">The World's Premier Global Stage for Preschool Excellence</p>

    <!-- Overview -->
    <div class="champ-block">
      <p>MaRRS Primary Colors stands as the crowning achievement in the MaRRS academic calendar. It is the culminating International Championship specifically designed for preschool qualifiers who have excelled at the National level.</p>
      <p>As the first of its kind in the world, MaRRS Primary Colors offers a unique global platform where young learners transition from national success to international recognition.</p>
    </div>
 <!-- ===== Program Cards ===== -->
<div class="program-cards">
  <div class="container">
    <div class="row g-4 justify-content-center">
        
      <div class="col-md-4 col-sm-6">
        <div class="program-card">
          <div class="icon-wrap">
            <img src="https://marrs.in//newassets/primarycolor-slide/facilities.png" alt="Nursery">
          </div>
          <h5>NURSERY</h5>
          <!--<a href="#">more info</a>-->
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="program-card">
          <div class="icon-wrap">
            <img src="https://marrs.in//newassets/primarycolor-slide/services.png" alt="KG1">
          </div>
          <h5>KG1</h5>
          <!--<a href="#">more info</a>-->
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="program-card">
          <div class="icon-wrap">
            <img src="https://marrs.in//newassets/primarycolor-slide/curriculam.png" alt="KG2">
          </div>
          <h5>KG2</h5>
          <!--<a href="#">more info</a>-->
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Pathway -->
    <div class="champ-block">
      <h3>The Pathway to the International Stage</h3>
      <p>Exclusivity is a hallmark of this program. Participation is reserved for students who have qualified through the National Championships of any of the following prestigious MaRRS Preschool Programs:</p>
      <ul>
        <li>MaRRS International Spelling Bee Junior</li>
        <li>MaRRS Play2Learn Carnival</li>
        <li>MaRRS Preschool Bee: English, Math, Science, or Humanities</li>
      </ul>
    </div>

    <!-- Four Variants -->
    <div class="champ-block">
      <h3>The Four Variants of Primary Colors</h3>
      <p>Qualifiers are not limited to their original qualifying subject. A student who qualifies at the National level in any of the programs listed above is eligible to participate in any or all of the four specialised variants of the International Championship:</p>
    </div>

    <div class="variant-grid">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="variant-card">
            <div class="variant-num">1</div>
            <h5>Primary Colors – English</h5>
            <p>Advanced linguistic and vocabulary challenges.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="variant-card">
            <div class="variant-num">2</div>
            <h5>Primary Colors – Math</h5>
            <p>Focus on logical reasoning and numerical aptitude.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="variant-card">
            <div class="variant-num">3</div>
            <h5>Primary Colors – Science</h5>
            <p>Exploration of the natural world and scientific inquiry.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="variant-card">
            <div class="variant-num">4</div>
            <h5>Primary Colors – Humanities</h5>
            <p>Understanding society, culture, and the world around us.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Why Unique table -->
    <div class="champ-block">
      <h3>Why Primary Colors is Unique</h3>
    </div>
    <div class="why-table-wrap">
      <table class="why-table">
        <thead>
          <tr>
            <th>Feature</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Global Recognition</td>
            <td>The only dedicated International Competition for preschoolers worldwide.</td>
          </tr>
          <tr>
            <td>Pioneering Format</td>
            <td>The first program in the world to benchmark preschool skills at a global standard.</td>
          </tr>
          <tr>
            <td>Flexibility</td>
            <td>National qualifiers can choose to compete across multiple subjects (English, Math, Science, Humanities).</td>
          </tr>
          <tr>
            <td>Developmental Focus</td>
            <td>Designed to celebrate cognitive milestones and cultural exchange among the world's youngest achievers.</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Participation Details -->
    <div class="champ-block">
      <h3>Participation Details</h3>
    </div>
    <div class="participation-grid">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="participation-card">
            <div class="p-icon"><i class="fas fa-graduation-cap"></i></div>
            <h6>Eligibility</h6>
            <p>Must be a National Championship qualifier from a MaRRS Preschool program.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="participation-card">
            <div class="p-icon"><i class="fas fa-edit"></i></div>
            <h6>Registration</h6>
            <p>Eligible candidates can register for one, two, three, or all four subject variants.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="participation-card">
            <div class="p-icon"><i class="fas fa-book-open"></i></div>
            <h6>Preparation</h6>
            <p>Specialised international-level modules are provided to bridge the gap between National and International standards.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Closing CTA -->
    <div class="champ-cta">
      <h3>Join the Global Elite</h3>
      <p>MaRRS Primary Colors is where potential meets opportunity on a global scale. Secure your student's place in the history of early childhood achievement.</p>
      <div class="champ-tagline">"A world-class beginning for a world-class future."</div>
      <div class="d-flex flex-column flex-md-row justify-content-center  gap-3">

    <a href="/addschool"
       class="btn btn-light my-2">
        Spark a Revolution - Enroll Your School Now →
    </a>

    <a href="/signin?tab=register" class="btn btn-danger my-2">REGISTER NOW</a>


</div>

    </div>

  </div>


<!-- ===== Photo Gallery Slider ===== -->
<div class="gallery-section">
  <div class="page-title">
    <h1 style="font-size:30px;">Photo Gallery</h1>
    <div class="title-divider"></div>
  </div>
  <div class="container">
    <div id="gallerySlider" class="carousel slide" data-bs-ride="false">
      <div class="carousel-inner" id="galleryInner">
        <!-- slides injected by JS -->
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#gallerySlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#gallerySlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
      <div class="carousel-indicators" id="galleryIndicators"></div>
    </div>
  </div>
</div>

</section>




<script>
document.addEventListener('DOMContentLoaded', function () {

  var closeBtn = document.querySelector('.announce-bar .close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function(){
      document.querySelector('.announce-bar').style.display = 'none';
    });
  }

  // ===== Build sliding gallery (N images per slide, responsive) =====
  var galleryImages = [
    'https://marrs.in/newassets/primarycolor-slide/1.jpg',
    'https://marrs.in/newassets/primarycolor-slide/2.jpg',
    'https://marrs.in/newassets/primarycolor-slide/3.jpg',
    'https://marrs.in/newassets/primarycolor-slide/4.jpg',
    'https://marrs.in/newassets/primarycolor-slide/5.jpg',
    'https://marrs.in/newassets/primarycolor-slide/6.jpg',
    'https://marrs.in/newassets/primarycolor-slide/7.jpg'
  ];

  function getPerSlide(){
    return window.innerWidth <= 767 ? 2 : 4;
  }

  var gallerySliderInstance = null;

  function buildGallerySlider(){
    var perSlide = getPerSlide();
    var inner = document.getElementById('galleryInner');
    var indicators = document.getElementById('galleryIndicators');
    if (!inner || !indicators) return;

    inner.innerHTML = '';
    indicators.innerHTML = '';

    var slideCount = Math.ceil(galleryImages.length / perSlide);

    for (var s = 0; s < slideCount; s++) {
      var chunk = galleryImages.slice(s * perSlide, s * perSlide + perSlide);

      var itemDiv = document.createElement('div');
      itemDiv.className = 'carousel-item' + (s === 0 ? ' active' : '');

      var rowDiv = document.createElement('div');
      rowDiv.className = 'gallery-row';

      chunk.forEach(function(src){
        var a = document.createElement('a');
        a.href = '#';
        a.className = 'gallery-item';
        var img = document.createElement('img');
        img.src = src;
        img.alt = 'Gallery';
        a.appendChild(img);
        rowDiv.appendChild(a);
      });

      itemDiv.appendChild(rowDiv);
      inner.appendChild(itemDiv);

      var btn = document.createElement('button');
      btn.type = 'button';
      btn.setAttribute('data-bs-target', '#gallerySlider');
      btn.setAttribute('data-bs-slide-to', s);
      if (s === 0) btn.className = 'active';
      indicators.appendChild(btn);
    }

    // Re-initialize the Bootstrap Carousel instance after rebuilding DOM,
    // since the slides were just regenerated and any previous instance
    // is now pointing at stale nodes.
    var sliderEl = document.getElementById('gallerySlider');
    if (sliderEl && window.bootstrap && window.bootstrap.Carousel) {
      if (gallerySliderInstance) {
        gallerySliderInstance.dispose();
      }
      gallerySliderInstance = new bootstrap.Carousel(sliderEl, {
        interval: false,
        ride: false
      });
    }
  }

  buildGallerySlider();

  var resizeTimer;
  window.addEventListener('resize', function(){
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(buildGallerySlider, 250);
  });

});
</script>

<?php include('footertest.php')?>