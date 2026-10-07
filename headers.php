<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>MaRRS Rediscover Home </title>
      <link rel="stylesheet" type="text/css" href="/newassets/style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">-->
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

   </head>
   
   
   <body>
      <!-- Header -->
      <div class="notice-banner">
         <div class="container text-center">
            <small><strong>Announcement:</strong> Registrations for MaRRS Xpress Math Challenge are open. <a href="#" style="text-decoration:underline;color:#fff">Learn more</a></small>
         </div>
      </div>
    
      <style>
      .navbar {
  position: relative;
  z-index: 9999;
}
     /* Navbar base */
.navbar-custom {
  background: url("https://marrs.in/newassets/header.jpg") center / cover no-repeat;
  min-height: 70px;
  padding: 10px 0;
  position: relative;
}

/* Overlay (optional subtle dark layer) */
.navbar-custom::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: 0;
}

/* Ensure content stays above overlay */
.navbar-custom .container-fluid {
  position: relative;
  z-index: 2;
}

/* Logo */
.navbar-brand img {
  height: 40px;
}

/* Nav links */
.navbar-nav .nav-link {
  font-size: 15px;
  color: #000 !important;
  font-weight: 600;
  padding: 8px 12px;
}

.navbar-nav .nav-link:hover {
  color: #fc4005 !important;
}

/* Toggler */
.navbar-toggler {
  border: 1px solid #fc4005;
  background: #fc4005;
}

/* White hamburger icon */
.navbar-toggler-icon {
  filter: invert(1);
}

/* Dropdown */
.dropdown-menu {
  border-radius: 10px;
  border: none;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* Mobile Fix */
@media (max-width: 991px) {
  .navbar-custom {
    background: #fff;
  }

  #mainNavbar {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
  }

  .navbar-nav {
    text-align: left;
  }
}

  </style>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">

    <!-- Logo -->
    <!--<a class="navbar-brand" href="/">-->
    <!--  <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo">-->
    <!--</a>-->

    <!-- Toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/about_marrs">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/gallery">Gallery</a>
        </li>

        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            Learning Programs
          </a>

          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/all_programs">All Programs</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kinder">Kinder Garden</a></li>
            <li><a class="dropdown-item" href="/1_8">Class 1-8</a></li>
            <li><a class="dropdown-item" href="/8_12">Class 8-12</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/contact_marrs">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link btn btn-sm btn-danger text-white px-3 ms-lg-2" href="/signin.php">
            Login
          </a>
        </li>

      </ul>
    </div>

  </div>
</nav>
<!--<nav class="navbar navbar-expand-lg navbar-custom">-->
<!--  <div class="container-fluid">-->
    
    <!-- Logo -->
<!--    <a class="navbar-brand d-lg-none" href="/">-->
<!--      <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo">-->
<!--    </a>-->

    <!-- Mobile Toggle -->
<!--    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">-->
<!--      <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->

    <!-- Menu -->
<!--    <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">-->
<!--      <ul class="navbar-nav mb-2 mb-lg-0">-->
<!--        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>-->
<!--        <li class="nav-item"><a class="nav-link" href="/about_marrs">About</a></li>-->
<!--         <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>-->
<!--        <li class="nav-item dropdown">-->
<!--          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--            Learning programs -->
<!--          </a>-->
<!--          <ul class="dropdown-menu">-->
           
<!--            <li><a class="dropdown-item" href="/all_programs">All programs </a></li>-->
<!--            <li><hr class="dropdown-divider"></li>-->
<!--            <li><a class="dropdown-item" href="/kinder">Kinder Garten Programs</a></li> -->
<!--            <li><hr class="dropdown-divider"></li>-->
<!--            <li><a class="dropdown-item" href="/1_8">Class 1-8 Programs </a></li>-->
<!--             <li><hr class="dropdown-divider"></li>-->
<!--            <li><a class="dropdown-item" href="/8_12">Class 8-12 Programs </a></li>-->
<!--          </ul>-->
<!--        </li>-->
       
<!--        <li class="nav-item"><a class="nav-link" href="/contact_marrs">Contact</a></li>-->
<!--        <li class="nav-item"><a class="nav-link" href="/signin.php">Login</a></li>-->
<!--      </ul>-->
<!--    </div>-->

<!--  </div>-->
<!--</nav>-->