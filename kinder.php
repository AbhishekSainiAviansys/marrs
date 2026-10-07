
<?php 
include('headertest.php');
include('db.php');

/* ---------- INIT FLAGS ---------- */
$misb=$misbj=$pricolor=$mimb=$msex=$mxpm=$mwch=$p2l=$psbe=$psbm=$psbsci=$psbhu=$mmwd='no';

/* ---------- FETCH PRODUCTS ---------- */
$sql = "SELECT * FROM products where logo='yes' and status='Active' and class_key='1'; ";
$result = $conn->query($sql);

foreach($result as $row){
    $name = trim($row['product_name']);

    if(in_array($name,['MaRRS International Spelling Bee','MaRRS Spelling Bee'])) $misb='yes';
    if($name=='MaRRS International Spelling Bee Junior') $misbj='yes';
    if(in_array($name,[
        'MaRRS Primary Colors - Science',
        'MaRRS Primary Colors - Math',
        'MaRRS Primary Colors - English',
        'MaRRS Primary Colors - Humanities',
        'MaRRS Primary Colors'
    ])) $pricolor='yes';

    if(in_array($name,['MaRRS Maths Bee','MaRRS International Math Bee'])) $mimb='yes';
    if($name=='MaRRS Scientia Exertus') $msex='yes';
    if($name=='MaRRS Xpress Math') $mxpm='yes';
    if($name=='MaRRS Word Chase') $mwch='yes';
    if($name=='MaRRS Play 2 Learn') $p2l='yes';
    if($name=='MaRRS Preschool Bee English') $psbe='yes';
    if($name=='MaRRS Preschool Bee Math') $psbm='yes';
    if($name=='MaRRS Preschool Bee Science') $psbsci='yes';
    if($name=='MaRRS Preschool Bee Humanities') $psbhu='yes';
    if($name=='MaRRS Maze of Words') $mmwd='yes';
}

/* ---------- CARD FUNCTION ---------- */
function programCard($show,$img,$title,$desc,$brochure='#',$know_more='#'){
    if($show!='yes') return;
?>
<div class="col-lg-3 col-md-6">
  <div class="card h-100 shadow-sm border-0 text-center">
    <div class="card-body">
      <img src="<?= $img ?>" class="img-fluid mb-3" style="max-height:120px;">
      <h5 class="fw-bold"><?= $title ?></h5>
      <p class="text-muted small"><?= $desc ?></p>
    </div>
    <div class="card-footer bg-white border-0">
  <a href="<?= $brochure ?>" class="btn btn-download" download>
    Download Brochure
  </a>

  <a href="<?= $know_more ?>" class="btn btn-know">
    Know More
  </a>
</div>
  </div>
</div>
<?php } ?>

<!-- ---------- HEADER ---------- -->

<section class="program-hero py-5 text-center text-white">
  <div class="container">
    <h1 class="fw-bold display-6">Learning Programs for 
Kindergarten</h1>
  </div>
</section>
<!-- ---------- CARDS ---------- -->
<div class="container py-5">
  <div class="row g-4">

<?php
programCard($misb,'images/misb_logo.png','MaRRS International Spelling Bee',
'MaRRS spelling bee initiates students into the world of competitive learning, acting as an invaluable tool for language improvement.',
'brochure/brochure_misb_mimb_mise.pdf');

programCard($mimb,'images/mimbin.png','MaRRS International Math Bee',
'The MaRRS International Math Bee is a motivated learning program intended to create an interest in Mathematics.',
'brochure/brochure_misb_mimb_mise.pdf');

programCard($msex,'images/sciextr.png','MaRRS Scientia Exertus',
'An innovative and thought-provoking national level science competition for students.',
'brochure/brochure_misb_mimb_mise.pdf');

programCard($mwch,'images/wdchase.png','MaRRS Word Chase',
'Emphasis is placed on learning the nuances of the English language.','');

programCard($mmwd,'images/mzofwds.png','MaRRS Maze of Words',
'Designed to improve communication skills and language awareness.');

programCard($mxpm,'images/xpmath.png','MaRRS Xpress Math',
'A fast-paced program to build strong mathematical thinking.');


programCard($misbj,'images/junior.png','MaRRS Spelling Bee Junior',
'Creative spelling activities for Kindergarten students.');

programCard($p2l,'images/p2l.png','MaRRS Play 2 Learn',
'Encourages imagination and creativity for young learners.','brochure/MaRRS -Preschool-Programs.pdf','https://marrs.in/play2learn');


programCard($pricolor,'images/primary_color.png','MaRRS Primary Colors',
'Research-based learning to enhance early achievement.','brochure/Primary Colors.pdf','https://marrs.in/primarycolors');

programCard($psbsci,'images/psbsci.png','MaRRS Preschool Bee – Science',
'Science learning opportunities for early learners.','brochure/MaRRS -Preschool-Programs.pdf','https://marrs.in/psb');

programCard($psbhu,'images/psbhum.png','MaRRS Preschool Bee – Humanities',
'Promotes critical thinking and cultural awareness.','brochure/MaRRS -Preschool-Programs.pdf','https://marrs.in/psb');

programCard($psbm,'images/psbmath.png','MaRRS Preschool Bee – Math',
'Builds foundational mathematical competence.','brochure/MaRRS -Preschool-Programs.pdf','https://marrs.in/psb');

programCard($psbe,'images/psbeng.png','MaRRS Preschool Bee – English',
'Supports communication and language development.','brochure/MaRRS -Preschool-Programs.pdf','https://marrs.in/psb');
?>
<style>/* ===== PAGE HEADER ===== */
.program-hero {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #012c55, #001c39);
  z-index: 1;
}

/* Dotted pattern (CSS only) */
.program-hero::before {
  content: "";
  position: absolute;
  inset: 0;

  background-image: radial-gradient(rgba(255,255,255,0.15) 1px, transparent 1px);
  background-size: 18px 18px;

  opacity: 0.6;
  z-index: 0;
}

/* Light glow overlay */
.program-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.15), transparent 40%),
              radial-gradient(circle at 80% 70%, rgba(245,124,53,0.25), transparent 50%);
  z-index: 0;
}

/* Content above layers */
.program-hero .container {
  position: relative;
  z-index: 1;
}

/* Heading polish */
.program-hero h1 {
  letter-spacing: 1px;
  text-shadow: 0 4px 15px rgba(0,0,0,0.4);
}

/* ===== CARD GRID ===== */
/*.row.g-4 {*/
/*  align-items: stretch;*/
/*}*/

/* ===== CARD ===== */
.card {
  border-radius: 18px;
  overflow: hidden;
  transition: all 0.35s ease;
  box-shadow: 0 10px 25px rgba(0,0,0,0.05);
  position: relative;
  background: #fff;
}

/* Hover effect */
.card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 45px rgba(245,124,53,0.25);
}

/* Orange border glow */
.card::after {
  content: "";
  position: absolute;
  inset: 0;
  border-radius: 18px;
  border: 2px solid transparent;
  transition: 0.3s;
  pointer-events: none;   /* ✅ add this line */
}

.card:hover::after {
  border-color: rgba(245,124,53,0.4);
}

/* IMAGE ZOOM */
.card img {
  max-height: 110px;
  object-fit: contain;
  margin-top: 10px;
  transition: transform 0.4s ease;
}

.card:hover img {
  transform: scale(1.1);
}

/* TITLE */
.card h5 {
  font-size: 17px;
  margin-top: 10px;
  color: #0f172a;
}

/* DESCRIPTION */
.card p {
  font-size: 13px;
  min-height: 60px;
}

/* ===== ORANGE BUTTON ===== */
.btn-primary {
  background: linear-gradient(135deg, #ff8a00, #f83600);
  border: none;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
  padding: 10px;
  color: #fff;
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(248,54,0,0.35);
}

.btn-primary:hover {
  background: linear-gradient(135deg, #f97316, #ea580c);
  transform: translateY(-2px);
  box-shadow: 0 12px 28px rgba(248,54,0,0.5);
}

/* Ripple effect */
.btn-primary::after {
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  background: rgba(255,255,255,0.4);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
}

.btn-primary:active::after {
  width: 200px;
  height: 200px;
  opacity: 1;
  transition: 0.4s;
}

/* REGISTER BUTTON (match theme) */
.btn-success {
  background: linear-gradient(135deg, #0d5992, #1e40af);
  border: none;
  border-radius: 14px;
  font-weight: 600;
  color: #fff;
  box-shadow: 0 10px 25px rgba(37,99,235,0.4);
  transition: all 0.3s ease;
}

.btn-success:hover {
  background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(37,99,235,0.5);
}

/* ===== SCROLL ANIMATION ===== */
.card {
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.6s ease;
}

.card.show {
  opacity: 1;
  transform: translateY(0);
}
/* BUTTON CONTAINER */
.card-footer {
  display: flex;
  gap: 10px;
  align-items: center;
}

/* DOWNLOAD BUTTON */
.btn-download {
  flex: 1;
  background: linear-gradient(135deg, #ff8a00, #f83600);
  border: none;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  padding: 10px;
  color: #fff;
  transition: all 0.25s ease;
  box-shadow: 0 6px 16px rgba(248,54,0,0.35);
}

.btn-download:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 22px rgba(248,54,0,0.45);
}

/* KNOW MORE BUTTON */
.btn-know {
  flex: 1;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  padding: 10px;
  border: 1.5px solid #f97316;
  color: #f97316;
  background: transparent;
  transition: all 0.25s ease;
}

.btn-know:hover {
  background: linear-gradient(135deg, #ff8a00, #f83600);
  color: #fff;
  border-color: transparent;
  box-shadow: 0 6px 18px rgba(248,54,0,0.35);
}


/* MOBILE */
@media (max-width: 768px) {
  .card p {
    min-height: auto;
  }
  .card-footer {
    flex-direction: column;
  }
}</style>
  </div>
</div>

<!-- ---------- REGISTER BUTTON ---------- -->
<section class="py-5 text-center">
  <div class="container">
    <a href="https://marrs.in/parents" class="btn btn-success btn-lg px-5">
      Register Now
    </a>
  </div>
</section>
<script id="interactive-js">
/* Scroll reveal */
const cards = document.querySelectorAll('.card');

function revealCards() {
  const trigger = window.innerHeight * 0.85;

  cards.forEach(card => {
    const top = card.getBoundingClientRect().top;

    if (top < trigger) {
      card.classList.add('show');
    }
  });
}

window.addEventListener('scroll', revealCards);
window.addEventListener('load', revealCards);

/* Tilt effect (premium) */
cards.forEach(card => {
  card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const rotateX = -(y / rect.height - 0.5) * 6;
    const rotateY = (x / rect.width - 0.5) * 6;

    card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
  });

  card.addEventListener('mouseleave', () => {
    card.style.transform = '';
  });
});
</script>
<?php include("footertest.php"); ?>