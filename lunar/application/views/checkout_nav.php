
<style>
  :root {
    --lunar-primary: #3155E7;
    --lunar-primary-dark: #2b4cd6;
  }

  /* ==============================
     TOP BAR
  ============================== */

  .lunar-topbar {
    background: linear-gradient(
      90deg,
      var(--lunar-primary),
      var(--lunar-primary-dark)
    );
    padding: 12px 65px;
    flex: none;
  }

  .lunar-topbar-inner {
    max-width: 100%;
    margin: 0 auto;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 12px;
  }


  /* ==============================
     LOGO
  ============================== */

  .lunar-brand {
    display: flex;
    align-items: center;
    flex-shrink: 0;
  }

  .lunar-logo {
    width: 150px;
    height: 58px;

    object-fit: contain;
    object-position: center;

    display: block;
  }


  /* ==============================
     ACTION AREA
  ============================== */

  .lunar-topbar-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 10px;
  }


  /* ==============================
     DASHBOARD / PROFILE BUTTON
  ============================== */

  .lunar-pill-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 38px;

    padding: 9px 18px;

    border-radius: 50px;
    border: none;

    background: #fff;
    color: var(--lunar-primary);

    font-family:
      'Inter',
      system-ui,
      -apple-system,
      sans-serif;

    font-size: .9rem;
    font-weight: 700;

    line-height: 1;

    text-decoration: none;

    box-shadow: 0 4px 10px rgba(0, 0, 0, .08);

    transition:
      transform .15s ease,
      box-shadow .15s ease,
      color .15s ease;
  }

  .lunar-pill-btn:hover {
    color: #2442B8;

    transform: translateY(-1px);

    box-shadow: 0 6px 14px rgba(0, 0, 0, .12);
  }

  .lunar-pill-btn svg {
    width: 16px;
    height: 16px;

    flex-shrink: 0;
  }


  /* ==============================
     LOGOUT BUTTON
  ============================== */

  .lunar-icon-btn {
    min-height: 38px;

    padding: 9px 16px;

    border-radius: 50px;

    border: 1.5px solid rgba(255, 255, 255, .55);

    background: red;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    color: #fff;

    flex-shrink: 0;

    text-decoration: none;

    font-family:
      'Inter',
      system-ui,
      -apple-system,
      sans-serif;

    font-size: .9rem;
    font-weight: 700;

    line-height: 1;

    transition:
      background .15s ease,
      border-color .15s ease,
      transform .15s ease;
  }

  .lunar-icon-btn:hover {
    background: rgba(255, 255, 255, .18);

    border-color: #fff;

    color: #fff;

    transform: translateY(-1px);
  }

  .lunar-icon-btn svg {
    width: 16px;
    height: 16px;

    flex-shrink: 0;
  }


  /* ==============================
     TABLET
  ============================== */

  @media (max-width: 991px) {

    .lunar-topbar {
      padding: 11px 18px;
    }

    .lunar-logo {
      width: 140px;
      height: 55px;
    }

  }


  /* ==============================
     MOBILE
  ============================== */

  @media (max-width: 575px) {

    .lunar-topbar {
      padding: 9px 12px;
    }

    .lunar-logo {
      width: 115px;
      height: 48px;
    }

    .lunar-topbar-actions {
      gap: 7px;
    }


    /* Dashboard / Profile */

    .lunar-pill-btn {
      min-height: 36px;

      padding: 8px 13px;

      font-size: .82rem;
    }

    .lunar-pill-btn svg {
      width: 15px;
      height: 15px;
    }


    /* Logout */

    .lunar-icon-btn {
      min-height: 36px;

      padding: 8px 13px;

      font-size: .82rem;

      gap: 6px;
    }

    .lunar-icon-btn svg {
      width: 15px;
      height: 15px;
    }

  }
</style>


<!-- ==========================================
     LUNAR TOP BAR
========================================== -->

<div class="lunar-topbar">

  <div class="lunar-topbar-inner">


    <!-- ======================================
         MARRS LOGO
    ======================================= -->

    <div class="lunar-brand">

      <img
        src="https://marrs.in/student_registration/certificate_logo/flunar.jpg"
        alt="MARRS Logo"
        class="lunar-logo"
      >

    </div>


    <!-- ======================================
         ACTION BUTTONS
    ======================================= -->

    <div class="lunar-topbar-actions">

      <?php
        $has_program_param =
          isset($_GET['program']) &&
          $_GET['program'] !== '';
      ?>


      <?php if ($has_program_param): ?>

        <!-- ==================================
             BACK TO DASHBOARD
        =================================== -->

        <a
          id="coBackBtn"
          class="lunar-pill-btn"
          href="<?php
            echo htmlspecialchars(
              $dashboard_url,
              ENT_QUOTES,
              'UTF-8'
            );
          ?>"
        >

          <!-- Back Icon -->
          <svg
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >

            <line
              x1="12"
              y1="8"
              x2="4"
              y2="8"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
            />

            <polyline
              points="8 4 4 8 8 12"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              fill="none"
            />

          </svg>


          <span class="pill-text-full">

            <?php
              echo !empty($from_dashboard)
                ? 'Back to Dashboard'
                : 'Go to Dashboard';
            ?>

          </span>

        </a>


      <?php else: ?>


        <?php

          $prid = $this->uri->segment(3);

          $profile_url = base_url(
            'student_registration/profile_ByPRID/' .
            urlencode($prid)
          );

        ?>


        <!-- ==================================
             PROFILE
        =================================== -->

        <a
          id="coProfileBtn"
          class="lunar-pill-btn"
          href="<?php
            echo htmlspecialchars(
              $profile_url,
              ENT_QUOTES,
              'UTF-8'
            );
          ?>"
        >

          <!-- Profile Icon -->

          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
          >

            <path
              d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
            />

            <circle
              cx="12"
              cy="7"
              r="4"
            />

          </svg>


          <span class="pill-text-full">
            Profile
          </span>

        </a>


      <?php endif; ?>


      <!-- ======================================
           LOGOUT
      ======================================= -->

      <a
        class="lunar-icon-btn"
        href="<?php
          echo htmlspecialchars(
            $logout_url,
            ENT_QUOTES,
            'UTF-8'
          );
        ?>"
        onclick="return confirm('Log out and end your session?');"
        title="Logout"
        aria-label="Logout"
      >

        <!-- Logout Icon -->

        <svg
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          aria-hidden="true"
        >

          <path
            d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
          />

          <polyline
            points="16 17 21 12 16 7"
          />

          <line
            x1="21"
            y1="12"
            x2="9"
            y2="12"
          />

        </svg>


        <span class="pill-text-full">
          Logout
        </span>

      </a>

    </div>

  </div>

</div>


<!-- ==========================================
     DASHBOARD RETURN SCRIPT
========================================== -->

<script>

(function () {

  var btn = document.getElementById('coBackBtn');

  if (!btn) {
    return;
  }

  try {

    var r = sessionStorage.getItem('dash_return');

    if (
      r &&
      r.indexOf(window.location.origin) === 0
    ) {

      btn.href = r;

    }

  } catch (e) {}

})();

</script>
