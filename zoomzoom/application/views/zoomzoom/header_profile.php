<!DOCTYPE html>
<html>
<head>
    <title>Marrs.in</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/zoomzoom.css">
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="<?php echo base_url();?>images/Log.png" alt="Logo" width="80" height="auto" class="img-fluid d-inline-block align-text-top" style="border-radius: 10px;
                background-color: inherit;">
                </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                 
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                            <a class="navbar-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true" href="#">
                            <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic" style="width:50px;">
                            </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end" aria-labelledby="navbarDropdown" data-bs-popper="static">
                        <li><a class="dropdown-item" href="<?php echo base_url();?>zoomzoom/profile_zoom" aria-current="page">Pofile</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url();?>zoomzoom/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                
                
              </div>
            </div>
          </nav>
    </header>