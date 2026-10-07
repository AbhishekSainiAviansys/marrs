
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>MaRRS INTELLECTUAL SERVICES</title>

	<meta name="generator" content="MaRRS Coming Soon" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:url" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Coming Soon Page" />
	<meta property="og:description" content="" />
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />

    <style>
      #toptitle {
        background: linear-gradient(
          to bottom,
          rgba(1, 44, 85, 1) 0%,
          rgba(0, 28, 57, 1) 100%
        );
      }
        body {
  background-color: #f5f7fb;
  background-image: radial-gradient(#e0e3e8 1px, transparent 1px);
  background-size: 20px 20px;
}
.header {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: rgba(255,255,255,0.75);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

.header-container {
  max-width: 1200px;
  margin: auto;
  padding: 14px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* LOGO */
.logo img {
  height: 45px;
}

/* NAV */
.navbar-nav .nav-link {
  position: relative;
  font-weight: 600;
  color: #2c2c2c !important;
  padding-bottom: 6px;
}

/* Orange underline (hidden by default) */
.navbar-nav .nav-link::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  width: 0%;
  height: 2px;
  background-color: #F57C35;
  transition: width 0.3s ease;
}

/* Hover effect */
.navbar-nav .nav-link:hover::after {
  width: 100%;
}

/* Optional: keep color change */
.navbar-nav .nav-link:hover {
  color: #F57C35 !important;
}
.navbar-toggler {
  border: none;
}

.navbar-toggler:focus {
  box-shadow: none;
}

.nav-link {
  font-weight: 600;
  color: #2c2c2c !important;
}

.nav-link:hover {
  color: #F57C35 !important;
}
.nav a {
  text-decoration: none;
  font-family: "Nunito", sans-serif;
  font-weight: 700;
  font-size: 14px;
  color: #2c2c2c;
  transition: all 0.2s ease;
  position: relative;
}

/* HOVER EFFECT */
.nav a::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -6px;
  width: 0%;
  height: 2px;
  background: #F57C35;
  transition: 0.3s;
}

.nav a:hover {
  color: #F57C35;
}

.nav a:hover::after {
  width: 100%;
}

/* BUTTON */
.nav .cta {
  background: #F57C35;
  color: #fff;
  padding: 8px 16px;
  border-radius: 999px;
}

.nav .cta:hover {
  background: #d9621a;
  color: #fff;
}
/* Dropdown container */
.nav-item {
  position: relative;
}
/* Remove underline for dropdown toggle */
.navbar-nav .dropdown-toggle::after {
  border: none !important; /* remove bootstrap arrow */
}

.navbar-nav .dropdown-toggle:hover::after {
  width: 0;
}
/* Hide dropdown */
.dropdown-menu {
  position: absolute;
  top: 35px;
  left: 0;
  background: #fff;
  border-radius: 14px;
  padding: 10px 0;
  min-width: 200px;
  display: none;
  box-shadow: 0 15px 40px rgba(0,0,0,0.08);
  animation: fadeIn 0.25s ease;
}

/* Dropdown links */
.dropdown-menu a {
  display: block;
  padding: 10px 18px;
  font-size: 14px;
  color: #333;
  text-decoration: none;
  transition: 0.3s;
}

/* Hover effect */
.dropdown-menu a:hover {
  background: rgba(245,124,53,0.1);
  color: #F57C35;
  padding-left: 24px;
}

/* Divider */
.dropdown-menu .divider {
  height: 1px;
  background: #eee;
  margin: 6px 0;
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(8px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.cta-pill {
  padding: 8px 18px;
  border-radius: 999px;
  font-weight: 600;
  font-size: 13px;
  text-decoration: none;

  color: #f57c35;
  background: #fff;

  border: 2px solid #f57c35;

  transition: all 0.25s ease;
  white-space: nowrap;
}

/* Hover */
.cta-pill:hover {
  background: #f57c35;
  color: #fff !important;
  box-shadow: 0 6px 18px rgba(245,124,53,0.35);
}
    </style>
 
  </head>
  <body>
    <!--<section>-->
    <!--  <div class="container-fluid" id="toptitle">-->
    <!--    <div class="row p-3">-->
    <!--      <div class="col-sm-12 col-md-12 col-lg-12">-->
    <!--        <img src="<?php echo base_url();?>images/header-011.jpg" alt=""  class="img-fluid w-100">   -->
            <!--<h6 class="text-white my-2 ms-2">Committed to Empower the Child</h6>-->
    <!--      </div>-->
          
    <!--    </div>-->
    <!--  </div>-->
    <!--</section>-->

<header class="header">
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg">

      <!-- Logo -->
      <a class="navbar-brand" href="/">
        <img src="https://marrs.in/newassets/MaRRS.png" style="height:45px;">
      </a>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse justify-content-end" id="mainNav">

        <ul class="navbar-nav align-items-lg-center gap-lg-4">

          <!-- Profile -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>welcome/studentdata">
              Profile
            </a>
          </li>

          <!-- Register Product -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>welcome/studentdata">
              Register Product
            </a>
          </li>

          <!-- Study Material -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              Study Material
            </a>
          </li>

          <!-- Logout -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>welcome/logout">
              Logout
            </a>
          </li>

        </ul>

      </div>
    </nav>

  </div>
</header>
