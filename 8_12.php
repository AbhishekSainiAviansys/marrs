<?php include('headertest.php'); ?>
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
<!-- ===== HERO ===== -->
<section class="py-5 text-center text-white program-hero">
      <div class="container">
    <h1 class="fw-bold display-5 mb-2">Learning Programs Grades 9 to 12</h1>
   
  </div>
</section>

<!-- ===== CARD ===== -->
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6">

     <div class="card h-100 shadow-sm border-0 text-center">
    <div class="card-body">

          <div class="misb-logo-wrap mb-3">
            <img src="images/misb_logo.png" class="img-fluid" style="max-height:120px;">
          </div>

          <h4 class="fw-bold mb-3">
            MaRRS International Spelling Bee
          </h4>

          <p class="text-muted small">
            MaRRS spelling bee initiates students into the world of competitive learning,
            acting as an invaluable tool for language improvement.
          </p>

          

        </div>
        <div class="card-footer bg-white border-0">
            <a href="brochure/brochure_misb_mimb_mise.pdf"
             class="btn btn-download"
             download>
             Download Brochure
          </a>
          <a href="https://marrs.in/spellingbee"
            class="btn btn-know"
             >
             Know More
          </a>
</div>

      </div>

    </div>
  </div>
</div>

<!-- ===== CTA ===== -->
<section class="pb-5 text-center">
  <div class="container">
    <a href="https://marrs.in/parents"
       class="btn btn-success btn-lg px-5 rounded-pill shadow">
       Register Now
    </a>
  </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".card");

  cards.forEach((card, index) => {
    setTimeout(() => {
      card.classList.add("show");
    }, index * 150);
  });
});
</script>
<?php include('footertest.php'); ?>