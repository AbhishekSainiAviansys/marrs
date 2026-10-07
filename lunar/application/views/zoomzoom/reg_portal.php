<!DOCTYPE html>
<html>
  <head>
    <title>Marrs.in</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="custom.css?update" />
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img
              src="https://marrs.in/student_registration/images/marrs_logo.png"
              alt="Logo"
              width="110"
              height="auto"
              class="img-fluid d-inline-block align-text-top"
              style="border-radius: 0px; background-color: inherit"
            />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Learning Programs
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="https://marrs.in/all_programs.php">All Programs</a></li>
                  <li>
                    <a class="dropdown-item" href="https://marrs.in/kinder.php">Kinder Garden Programs</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="https://marrs.in/1_6.php">Class 1 - 8 Programs</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="https://marrs.in/6_12.php">Class 8 - 12 Programs</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
              <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Login
                </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="student_login.php">Student Login</a></li>
            <li><a class="dropdown-item" href="https://marrs.in/school_login">School Login</a></li>
            <li><a class="dropdown-item" href="https://marrs.in/franchiselogin/franchise/login">Franchise Login</a></li>
            <li><a class="dropdown-item" href="https://marrs.in/franchiselogin/manage/login">Admin Login</a></li>
          </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <section id="contentWrapper">
        <div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh; overflow:hidden;">
            <div class="row" id="reglogin">
                <div class="col-sm-12">
                <div class="card mb-3 p-0" style="width:70rem">
                <div class="row g-0">
                <div class="col-md-6">
                  <img src="Reg_pg_img.jpeg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                  <div class="card-body text-center">
                    <h2 class="card-title my-4">REGISTER NOW</h2>
                    <a href="national_level_login.php" class="btn btn-outline-primary w-100" type="submit">Register For National Level 2021-22</a>
                    <a href="new_registration.php" class="btn btn-outline-primary my-4 w-100" type="submit">New Registration 2022-23</a>
                    <p class="card-text my-2">The healthy competitive spirit motivates the students to learn on their own without any compulsion.</p>
                  </div>
                </div>
                
                </div>
               </div>
            </div>
      </div>
    </section>
   <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
