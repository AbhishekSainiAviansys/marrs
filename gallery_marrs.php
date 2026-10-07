<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gallery | MaRRS Rediscover Home</title>

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="/newassets/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Navbar (same as your header code) */
    .navbar-custom {
      background: url("https://marrs.in/newassets/header.jpg") center / cover no-repeat;
      height: 80px;
      position: relative;
    }

    .navbar-custom::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.6);
    }

    .navbar-custom .container {
      position: relative;
      z-index: 2;
    }

    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #ffd700 !important;
    }

    /* Page Header */
    .page-header {
      background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
      url("https://marrs.in/newassets/header.jpg") center/cover no-repeat;
      padding: 80px 0;
      color: #fff;
      text-align: center;
    }

    /* Gallery */
    .gallery-img {
      position: relative;
      overflow: hidden;
      border-radius: 12px;
    }

    .gallery-img img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      transition: transform .4s ease;
    }

    .gallery-img:hover img {
      transform: scale(1.1);
    }

    .gallery-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: .3s;
    }

    .gallery-img:hover .gallery-overlay {
      opacity: 1;
    }

    .gallery-overlay i {
      color: #fff;
      font-size: 30px;
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container">
    <a class="navbar-brand d-lg-none" href="/">
      <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" height="40">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about_marrs">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
        <li class="nav-item"><a class="nav-link active" href="/gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Header -->
<section class="page-header">
  <div class="container">
    <h1>Our Gallery</h1>
    <p>Moments from MaRRS Rediscover Home</p>
  </div>
</section>

<!-- Gallery Section -->
<section class="pt-5">
  <div class="container">

    <!-- Tabs -->
    <ul class="nav nav-pills justify-content-center mb-4" id="galleryTabs">
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#all">All</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#events">Events</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#classes">Classes</button>
      </li>
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#students">Students</button>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mb-5">

      <!-- ALL -->
      <div class="tab-pane fade show active" id="all">
        <div class="row g-4">
          <!-- repeat image blocks -->
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
                <a href="">
              <img src="https://marrs.in/images/school_gallery/SRI02612.JPG" loading="lazy">
              </a>
              
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/IMG_7061-misb.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/IMG_1089_primary_color.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/OW2A0122-mimb.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
           <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/SAM_4135-misb.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
           <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/IMG_9680_se.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
          
          
          
        </div>
      </div>

      <!-- EVENTS -->
      <div class="tab-pane fade" id="events">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/DSC_0288-misb.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/IMG_8300_misbj.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
        </div>
      </div>

      <!-- CLASSES -->
      <div class="tab-pane fade" id="classes">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/9D0A0571-misb.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
        </div>
      </div>

      <!-- STUDENTS -->
      <div class="tab-pane fade" id="students">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="gallery-img">
              <img src="https://marrs.in/images/school_gallery/IMG_1089_primary_color.JPG" loading="lazy">
              <div class="gallery-overlay"><i class="fa fa-search-plus"></i></div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>


   <div class="footer-banner">
         <div class="container d-flex justify-content-between align-items-center footer-links" style="max-width:1100px;">
            <div>
               <span><i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-square-instagram"></i><i class="fa-brands fa-linkedin"></i><i class="fa-brands fa-youtube"></i></span>
               <strong style="color:#000;padding-left: 20px;">MaRRS Rediscover</strong> : Empowering Students in Math & English
            </div>
            <div>
               <a href="#">Terms & Conditions</a> |
               <a href="#">Privacy Policy</a> |
               <a href="#">Contact</a>
            </div>
         </div>
      </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
