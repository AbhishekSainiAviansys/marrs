<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">

  <title>Marrs CIN Login</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800;900&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <!--<link rel="stylesheet" href="<?php echo base_url()?>custom.css" />-->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
  *, *::before, *::after { box-sizing: border-box; }

  body {
    font-family: 'Nunito Sans', sans-serif;
    background: #f0eefc;
    margin: 0;
  }

  /* ══ HEADER ══ */
  .header {
    background: linear-gradient(135deg, #2d0e7a 0%, #4a1fa8 50%, #6c3fc5 100%);
    box-shadow: 0 4px 24px rgba(74, 31, 168, 0.30);
    position: sticky;
    top: 0;
    z-index: 1000;
  }

  .header .container-fluid { padding: 0 1.5rem; }
  .header .navbar { padding: 0.55rem 0; }

  /* Logo */
  .header .navbar-brand { padding: 0; display: flex; align-items: center; }
  .header .navbar-brand img {
    height: 44px;
    filter: brightness(1.05) drop-shadow(0 2px 8px rgba(0,0,0,0.18));
    transition: transform 0.2s;
  }
  .header .navbar-brand:hover img { transform: scale(1.03); }

  /* Toggler */
  .header .navbar-toggler {
    border: 1.5px solid rgba(255,255,255,0.35);
    border-radius: 10px;
    padding: 5px 9px;
    background: rgba(255,255,255,0.10);
  }
  .header .navbar-toggler:focus { box-shadow: none; }
  .header .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255%2c255%2c255%2c0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  /* Profile pill trigger */
  .header .nav-link.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 9px;
    background: rgba(255,255,255,0.12);
    border: 1.5px solid rgba(255,255,255,0.22);
    border-radius: 40px;
    padding: 6px 14px 6px 8px !important;
    color: #fff !important;
    font-family: 'Nunito', sans-serif;
    font-weight: 700;
    font-size: 14px;
    transition: background 0.18s, border-color 0.18s;
    text-decoration: none;
  }
  .header .nav-link.dropdown-toggle:hover,
  .header .nav-link.dropdown-toggle.show {
    background: rgba(255,255,255,0.22);
    border-color: rgba(255,255,255,0.45);
  }
  .header .nav-link.dropdown-toggle::after { display: none; }

  .profile-avatar-wrap {
    width: 34px; height: 34px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.5);
    overflow: hidden;
    flex-shrink: 0;
    background: rgba(255,255,255,0.15);
  }
  .profile-avatar-wrap img { width: 100%; height: 100%; object-fit: cover; }

  .profile-text { color: #fff; font-size: 14px; font-weight: 700; }

  .header .nav-link .fa-chevron-down {
    font-size: 10px;
    color: rgba(255,255,255,0.75);
    transition: transform 0.2s;
  }
  .header .nav-link.show .fa-chevron-down { transform: rotate(180deg); }

  /* Dropdown */
  .header .dropdown-menu {
    border: none;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(74,31,168,0.18), 0 2px 8px rgba(0,0,0,0.08);
    padding: 8px;
    min-width: 215px;
    margin-top: 10px !important;
    animation: dropIn 0.18s ease;
  }
  @keyframes dropIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Dropdown profile header block */
  .dropdown-profile-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px 12px;
    border-bottom: 1px solid #f0eefc;
    margin-bottom: 4px;
  }
  .dropdown-profile-header img {
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 2px solid #e8e4ff;
  }
  .dropdown-profile-header .dph-name {
    font-family: 'Nunito', sans-serif;
    font-weight: 800; font-size: 13px; color: #1e1b4b; line-height: 1.2;
  }
  .dropdown-profile-header .dph-sub {
    font-size: 11px; color: #7c7aab; margin-top: 2px;
  }

  .header .dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Nunito Sans', sans-serif;
    font-weight: 600;
    font-size: 13px;
    color: #1e1b4b;
    padding: 9px 12px;
    border-radius: 10px;
    transition: background 0.14s, color 0.14s;
  }
  .header .dropdown-item .item-icon {
    width: 28px; height: 28px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
    background: #f3f0ff;
    transition: background 0.14s;
  }
  .header .dropdown-item:hover { background: #f3f0ff; color: #4a1fa8; }
  .header .dropdown-item:hover .item-icon { background: #ede9fe; }

  .header .dropdown-item.logout-item { color: #dc2626 !important; }
  .header .dropdown-item.logout-item .item-icon { background: #fff0f0; }
  .header .dropdown-item.logout-item:hover { background: #fff0f0; }
  .header .dropdown-item.logout-item:hover .item-icon { background: #fee2e2; }

  .header .dropdown-divider { border-color: #f0eefc; margin: 4px 8px; }

  /* Mobile */
  @media (max-width: 991px) {
    .header .navbar-collapse {
      background: linear-gradient(160deg, #2d0e7a, #5a28b8);
      border-radius: 16px;
      margin-top: 10px;
      padding: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .header .nav-link.dropdown-toggle {
      border-radius: 12px;
      justify-content: flex-start;
      width: 100%;
    }
    .header .dropdown-menu {
      position: static !important;
      transform: none !important;
      box-shadow: 0 4px 16px rgba(74,31,168,0.15);
      margin-top: 6px !important;
    }
  }
</style>

<header class="header">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg">

      <!-- Logo -->
      <a class="navbar-brand" href="/">
        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS">
      </a>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler" type="button"
              data-bs-toggle="collapse" data-bs-target="#mainNav"
              aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Nav Menu -->
      <div class="collapse navbar-collapse justify-content-end" id="mainNav">
        <ul class="navbar-nav align-items-lg-center gap-lg-3">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="profile-avatar-wrap">
                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="Profile">
              </div>
              <span class="profile-text">Profile</span>
              <i class="fa-solid fa-chevron-down"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">

              <!-- Profile preview -->
              <li>
                <div class="dropdown-profile-header">
                  <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="">
                  <div>
                    <div class="dph-name">My Account</div>
                    <div class="dph-sub">Student Portal</div>
                  </div>
                </div>
              </li>

              <li>
                <a class="dropdown-item" href="https://marrs.in/student_registration/Cin_login/index">
                  <span class="item-icon">👤</span> Profile View
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="https://marrs.in/student_registration/Cin_login/edit_cin_login">
                  <span class="item-icon">✏️</span> Profile Edit
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="https://marrs.in/student_registration/Cin_login/invoice">
                  <span class="item-icon">📄</span> Invoice
                </a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <a class="dropdown-item" href="https://marrs.in/student_registration/Cin_login/resetpassword">
                  <span class="item-icon">🔒</span> Reset Password
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="https://marrs.in/student_registration/Cin_login/enquiry">
                  <span class="item-icon">🎫</span> Support Ticket
                </a>
              </li>

              <li><hr class="dropdown-divider"></li>

              <li>
                <a class="dropdown-item logout-item" href="/signin">
                  <span class="item-icon">🚪</span> Logout
                </a>
              </li>

            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </div>
</header>