<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Razorpay Style Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Inter', Arial, sans-serif;
      background: #f7f8fa;
      overflow: hidden
    }
    .BaseBox {
        display: flex;
        flex-direction: column;
        margin-bottom: 24px;
        gap: 16px;
        margin-left: 16px;
    }
    .header {
/*      width: 100%;*/
      padding: 16px 48px;
      background: rgba(21,32,52,0.94);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-sizing: border-box;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 100;
    }

    .header-left {
      display: flex;
      align-items: center;
    }

    .header img {
      height: 42px;
      margin-right: 18px;
    }

    .menu {
      display: flex;
      gap: 26px;
      font-weight: 600;
      font-size: 15px;
    }

    .menu a {
      text-decoration: none;
      color: #fff;
      transition: color 0.2s ease;
    }

    .menu a:hover {
      color: #20b37e;
    }

    .footer {
      width: 100%;
      background: rgba(21,32,52,0.94);
      color: #fff;
      text-align: center;
      padding: 14px 0;
      position: fixed;
      bottom: 0;
      left: 0;
      font-size: 14px;
    }

    .main-bg {
      background: url('https://marrs.in/newassets/images/login.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      height: 100vh;
      width: 100vw;
      display: flex;
      align-items: center;
      justify-content: flex-end; /* ✅ Push login box to right */
            
    }

    .login-box {
      background: #fff;
      box-shadow: 0 4px 32px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      width: 430px;              
      min-height: 520px;         
      padding: 45px 38px;
      display: flex;
      flex-direction: column;
     /* align-items: center;
      text-align: center;*/

    }

    .login-logo {
      width: 248px;
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
    margin-bottom: 24px;
    gap: 16px;
     margin-top: 20px;
    }

    .login-box h1 {
      font-size: 1.8rem;
      color: #222;
      margin-bottom: 10px;
      font-weight: 600;
      padding-bottom: 10px;
    }

    input[type="text"] {
      width: 100%;
      padding: 13px 10px;
      border: 1px solid #becbe2;
      border-radius: 6px;
      margin-bottom: 18px;
      font-size: 15px;
      color: #1a2836;
      box-sizing: border-box;
      outline: none;
      margin-left: 16px;
    }

    input[type="text"]:focus {
      border-color: #2b6deb;
      box-shadow: 0 0 0 2px rgba(43, 109, 235, 0.2);
    }

    .btn-primary {
      width: 100%;
      padding: 12px 0;
      background: #2b6deb;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-weight: 650;
      font-size: 16px;
      margin-bottom: 14px;
      cursor: pointer;
      transition: background 0.2s ease;
      margin-left: 16px;
    }

    .btn-primary:hover {
      background: #1d56c0;
    }

    .divider {
      width: 100%;
      text-align: center;
      position: relative;
      color: #babfc7;
      margin: 20px 0;
      font-size: 14px;
      margin-left: 16px;
    }

    .divider::before, .divider::after {
      content: "";
      display: inline-block;
      width: 44%;
      height: 1px;
      background: #eee;
      vertical-align: middle;
      margin: 0 7px;
    }

    .google-btn {
      width: 100%;
      padding: 11px 0;
      background: #fff;
      border: 1px solid #babfc7;
      color: #333;
      border-radius: 6px;
      font-size: 15px;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: background 0.2s ease;
      margin-left: 16px;
    }

    .google-btn:hover {
      background: #f8f8f8;
    }

    .login-box .privacy {
      font-size: 12px;
      color: #666;
      margin-top: 23px;
      margin-left: 16px;
    }
    }

    .login-box .privacy a {
      color: #2b6deb;
      text-decoration: none;
    }

    @media (max-width: 480px) {
      .main-bg {
        justify-content: center; /* ✅ Center on mobile */
        padding-right: 0;
      }

      .login-box {
        width: 90%;
        min-height: auto;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <div class="header-left">
      <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo" />
    </div>
   
  </div>
   <div class="container-fluid">
  <div class="main-bg">
      
    <div class="login-box">
      <img class="login-logo" src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo" />
      <div class="BaseBox"><span class="">Welcome to MaRRS Rediscover</span> </div>
      <div class="BaseBox"><h1>Get started with your CIN or Access Code</h1></div>
      <input type="text" placeholder="CIN or Access Code" />
      <button class="btn-primary">Continue</button>
      <div class="divider">or</div>
      <button class="google-btn">Search Your CIN</button>
      <div class="privacy">
        By continuing you agree to our <a href="#">privacy policy</a> and <a href="#">terms of use</a>
      </div>
    </div>
  </div>
 </div>
  

</body>
</html>
