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
    <link rel="stylesheet" href="custom.css?update2" />
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
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <section>
        <div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh; overflow:hidden;">
            <div class="row" id="student_login">
                <div class="col-sm-12">
                <div class="card mx-3" style="width: 27rem;">
                <img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-user-essential-collection-bearicons-gradient-bearicons.png"/>                        
                <h3 class="card-title text-center my-3">REGISTER FOR THE MaRRS PROGRAMS</h3>
                <h4 class="card-title text-center my-2">For Student Registration</h4>
                        <form class=" text-left p-2">
                            <div class="mb-4">
                            <label for="ESAC" class="form-label">School Access Code</label>
                            <input type="text" class="form-control" id="ESAC" placeholder="Enter School Access Code">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="login" class="btn btn-danger w-100 btn-lg">Verify</button>
                            </div>
                        </form>
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
