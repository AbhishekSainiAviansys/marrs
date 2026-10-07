<?php include('headertest.php');?>
  <style>
   
    /* Page Header */
    .page-header {
      /*background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),*/
      /*url("https://marrs.in/newassets/contact_banner.jpg") center/cover no-repeat;*/
      background:linear-gradient(rgb(241 91 91 / 60%), rgb(24 92 150 / 60%)), url(https://marrs.in/newassets/contact_banner.jpg) center / cover no-repeat;
      padding: 80px 0;
      color: #fff;
      text-align: center;
    }

    /* Contact Cards */
    .contact-card {
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      height: 100%;
    }

    .contact-card i {
      font-size: 28px;
      color: #eb1736;
      margin-bottom: 15px;
    }

    /* Form */
    .form-control {
      height: 48px;
    }

    textarea.form-control {
      height: auto;
    }

    .btn-brand {
      background: #eb1736;
      color: #fff;
      padding: 12px 30px;
      border-radius: 30px;
    }

    .btn-brand:hover {
      background: #c9142e;
      color: #fff;
    }
    
    
  </style>
</head>

<body>



<!-- Page Header -->
<section class="page-header">
  <div class="container">
    <h1>Contact Us</h1>
    <p>We’d love to hear from you</p>
  </div>
</section>

<!-- Contact Info -->
<section class="pt-5">
  <div class="container">
    <div class="row g-4 mb-5">

      <div class="col-md-4">
        <div class="contact-card text-center">
          <i class="fa-solid fa-location-dot"></i>
          <h5>Our Location</h5>
          <p>Building No. 32/336, Honest Lane,
Unichira, Kochi - 682033</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="contact-card text-center">
          <i class="fa-solid fa-phone"></i>
          <h5>Call Us</h5>
          <p>+91 7012706817</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="contact-card text-center">
          <i class="fa-solid fa-envelope"></i>
          <h5>Email Us</h5>
          <p>enquiry@marrs.in</p>
        </div>
      </div>

    </div>

    <!-- Contact Form -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <div class="contact-card">
          <h4 class="mb-4 text-center">Send Us a Message</h4>

          <form>
            <div class="row g-3">
              <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Your Name" required>
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" placeholder="Your Email" required>
              </div>
              <div class="col-12">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="col-12">
                <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-brand">Send Message</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>
  <?php include('footertest.php');?>