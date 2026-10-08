<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  .lunar-navbar {
    background: linear-gradient(to bottom, rgba(10, 62, 110, 1) 0%, rgba(10, 61, 108, 1) 50%, rgba(3, 51, 91, 1) 51%, rgba(3, 50, 89, 1) 100%);
  }

  .lunar-navbar .nav-link {
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    padding: 18px;
  }

  .lunar-navbar .nav-link:hover,
  .lunar-navbar .nav-link:focus {
    background-color: rgba(255, 255, 255, 0.18);
    color: #fff;
  }

  .lunar-navbar .dropdown-item {
    color: #ff9933;
  }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark lunar-navbar">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lunarNavbar" aria-controls="lunarNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="lunarNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Learning programs</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/all_programs.php">All Programs</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/kinder.php">Kinder Garten Programs</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/1_8.php">Class 1-8 Programs</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/8_12.php">Class 8-12 Programs</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="/">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>