<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Payment Split — Login</title>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

<style>
*{
    box-sizing:border-box;
}

:root{
    --primary:#2f6bf0;
    --primary-dark:#2456ca;
    --text:#172033;
    --muted:#7b8497;
    --border:#e4e8f0;
    --bg:#f5f7fc;
    --danger-bg:#fff0f1;
    --danger:#b42332;
}

html,
body{
    width:100%;
    min-height:100%;
}

body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;

    background:
        radial-gradient(
            circle at 10% 10%,
            rgba(47,107,240,.12),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 90%,
            rgba(91,76,255,.10),
            transparent 30%
        ),
        var(--bg);

    color:var(--text);

    font-family:
        Inter,
        system-ui,
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Arial,
        sans-serif;
}


/* =========================================================
   LOGIN CARD
========================================================= */

.login-card{
    width:100%;
    max-width:430px;

    background:#fff;

    border:1px solid rgba(228,232,240,.9);
    border-radius:20px;

    padding:38px 38px 34px;

    box-shadow:
        0 20px 60px rgba(31,41,55,.10),
        0 4px 15px rgba(31,41,55,.04);
}


/* =========================================================
   BRAND ICON
========================================================= */

.brand{
    display:flex;
    justify-content:center;
    margin-bottom:20px;
}

.brand-icon{
    width:58px;
    height:58px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:16px;

    background:
        linear-gradient(
            135deg,
            #2f6bf0,
            #5b7ff4
        );

    color:#fff;

    box-shadow:
        0 10px 25px rgba(47,107,240,.25);
}

.brand-icon i{
    font-size:28px;
    line-height:1;
}


/* =========================================================
   HEADING
========================================================= */

.heading{
    text-align:center;
}

.heading h1{
    margin:0;

    font-size:25px;
    line-height:1.25;

    font-weight:750;
    letter-spacing:-.4px;

    color:#182033;
}

.heading p{
    margin:8px 0 28px;

    color:var(--muted);
    font-size:14px;
}


/* =========================================================
   ERROR
========================================================= */

.err{
    display:flex;
    align-items:center;
    gap:9px;

    background:var(--danger-bg);
    color:var(--danger);

    border:1px solid #ffd5d9;
    border-radius:10px;

    padding:11px 12px;

    font-size:13px;
    line-height:1.45;

    margin-bottom:20px;
}

.err i{
    flex:0 0 auto;
    font-size:16px;
}


/* =========================================================
   FIELD
========================================================= */

.field{
    margin-bottom:18px;
}

label{
    display:block;

    margin:0 0 7px;

    color:#374151;

    font-size:13px;
    font-weight:600;
}


/* =========================================================
   INPUT
========================================================= */

.input-wrap{
    position:relative;
    width:100%;
}

.input-wrap input{
    width:100%;
    height:46px;

    padding:0 44px 0 43px;

    border:1px solid var(--border);
    border-radius:10px;

    background:#fff;

    color:#172033;

    font:inherit;
    font-size:14px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.input-wrap input::placeholder{
    color:#a4adbd;
}

.input-wrap input:hover{
    border-color:#cbd2df;
}

.input-wrap input:focus{
    outline:none;

    border-color:var(--primary);

    box-shadow:
        0 0 0 4px rgba(47,107,240,.10);
}


/* =========================================================
   INPUT ICON
========================================================= */

.input-icon{
    position:absolute;

    left:14px;
    top:50%;

    transform:translateY(-50%);

    display:flex;
    align-items:center;
    justify-content:center;

    color:#9aa4b5;

    pointer-events:none;

    z-index:2;
}

.input-icon i{
    font-size:17px;
    line-height:1;
}


/* =========================================================
   PASSWORD TOGGLE
========================================================= */

.password-toggle{
    position:absolute;

    right:7px;
    top:50%;

    transform:translateY(-50%);

    width:34px;
    height:34px;

    display:flex;
    align-items:center;
    justify-content:center;

    border:0;
    border-radius:7px;

    background:transparent;

    color:#8b95a7;

    cursor:pointer;

    padding:0;

    transition:
        background .2s ease,
        color .2s ease;
}

.password-toggle:hover{
    background:#f3f6fb;
    color:#536174;
}

.password-toggle:focus{
    outline:none;
    background:#f3f6fb;
    color:var(--primary);
}

.password-toggle i{
    font-size:17px;
    line-height:1;
}


/* =========================================================
   LOGIN BUTTON
========================================================= */

.login-btn{
    width:100%;
    height:47px;

    margin-top:5px;

    border:0;
    border-radius:10px;

    background:
        linear-gradient(
            135deg,
            var(--primary),
            #416ff0
        );

    color:#fff;

    font:inherit;
    font-size:14px;
    font-weight:650;

    cursor:pointer;

    box-shadow:
        0 8px 20px rgba(47,107,240,.20);

    transition:
        transform .15s ease,
        box-shadow .15s ease,
        background .15s ease;
}

.login-btn:hover{
    background:
        linear-gradient(
            135deg,
            var(--primary-dark),
            #315fd8
        );

    box-shadow:
        0 10px 24px rgba(47,107,240,.27);

    transform:translateY(-1px);
}

.login-btn:active{
    transform:translateY(0);

    box-shadow:
        0 5px 14px rgba(47,107,240,.20);
}


/* =========================================================
   FOOTER
========================================================= */

.login-footer{
    margin-top:24px;
    padding-top:18px;

    border-top:1px solid #edf0f5;

    text-align:center;

    color:#9aa3b3;
    font-size:12px;
}

.login-footer strong{
    color:#687386;
    font-weight:600;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width:520px){

    body{
        padding:16px;
    }

    .login-card{
        max-width:100%;

        padding:30px 22px 25px;

        border-radius:17px;
    }

    .brand-icon{
        width:54px;
        height:54px;

        border-radius:15px;
    }

    .brand-icon i{
        font-size:26px;
    }

    .heading h1{
        font-size:23px;
    }

    .heading p{
        margin-bottom:24px;
    }
}


@media (max-width:360px){

    .login-card{
        padding:26px 18px 22px;
    }

    .heading h1{
        font-size:21px;
    }

    .input-wrap input{
        height:44px;
    }

    .login-btn{
        height:45px;
    }
}
</style>
</head>

<body>

<form
    class="login-card"
    method="post"
    action="<?= site_url('/dash_login/auth') ?>"
    autocomplete="on"
>


    <!-- =====================================================
         BRAND
    ====================================================== -->

    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-credit-card-2-front"></i>
        </div>
    </div>


    <!-- =====================================================
         HEADING
    ====================================================== -->

    <div class="heading">
        <h1>Payment Split</h1>

        <p>
            Sign in to access your dashboard
        </p>
    </div>


    <!-- =====================================================
         ERROR
    ====================================================== -->

    <?php if (!empty($error)): ?>

        <div class="err">

            <i class="bi bi-exclamation-circle"></i>

            <span>
                <?= htmlspecialchars($error) ?>
            </span>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         CSRF
    ====================================================== -->

    <input
        type="hidden"
        name="<?= $this->security->get_csrf_token_name() ?>"
        value="<?= $this->security->get_csrf_hash() ?>"
    >


    <!-- =====================================================
         EMAIL
    ====================================================== -->

    <div class="field">

        <label for="email">
            Email Address
        </label>

        <div class="input-wrap">

            <span class="input-icon">
                <i class="bi bi-envelope"></i>
            </span>

            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter your email"
                autocomplete="email"
                required
                autofocus
            >

        </div>

    </div>


    <!-- =====================================================
         PASSWORD
    ====================================================== -->

    <div class="field">

        <label for="password">
            Password
        </label>

        <div class="input-wrap">

            <span class="input-icon">
                <i class="bi bi-lock"></i>
            </span>

            <input
                id="password"
                name="password"
                type="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >

            <button
                type="button"
                class="password-toggle"
                id="togglePassword"
                aria-label="Show password"
            >
                <i
                    class="bi bi-eye"
                    id="eyeIcon"
                ></i>
            </button>

        </div>

    </div>


    <!-- =====================================================
         LOGIN
    ====================================================== -->

    <button
        type="submit"
        class="login-btn"
    >
        Sign In
    </button>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="login-footer">

        <strong>
            Payment Split Dashboard
        </strong>

        <br>

        Secure access for authorized users

    </div>

</form>


<script>
const password = document.getElementById('password');
const togglePassword = document.getElementById('togglePassword');
const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {

    const isHidden = password.type === 'password';

    password.type = isHidden
        ? 'text'
        : 'password';

    eyeIcon.className = isHidden
        ? 'bi bi-eye-slash'
        : 'bi bi-eye';

    togglePassword.setAttribute(
        'aria-label',
        isHidden
            ? 'Hide password'
            : 'Show password'
    );

});
</script>

</body>
</html>