<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - Lunar Skill Tests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f0f5ff, #e9f0ff);
      font-family: "Poppins", sans-serif;
      color: #023b70;
    }
    header {
    padding: 20px 0;
    background: #ffff;
    color: #005891;
    border-bottom: 4px solid var(--brand-red);
}
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
    .logo {
    font-size: 1.5rem;
    font-weight: 700;
    text-decoration: none;
    color: var(--brand-red);
}
nav ul {
    display: flex;
    list-style: none;
}
nav ul li {
    margin-left: 30px;
}
nav ul li a {
    text-decoration: none;
    color: var(--brand-blue);
    font-weight: 500;
    transition: color 0.3s;
    font-family: 'Roboto Slab', serif;
    font-size: 16px;
    font-weight: 400;
    text-transform: uppercase;
    
}
p{
  font-family: "Poppins", sans-serif;
}
h1,h2,h3,h4{
  font-family: "Poppins", sans-serif;
}
nav ul li a:hover {
    color: var(--brand-red);
}
.nav-toggle {
    display: none;
    flex-direction: column;
    cursor: pointer;
}
.bar {
    width: 25px;
    height: 3px;
    background: var(--brand-red);
    margin: 4px 0;
}
    .faq-section {
      
      padding: 30px;
      
    }

    .faq-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .faq-header h2 {
      font-weight: 700;
      color: #023b70;
    }

    .faq-header p {
      color: #5a6b8b;
      font-size: 16px;
    }

    .accordion-item {
      border: none;
      background: #f8faff;
      margin-bottom: 15px;
      border-radius: 15px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .accordion-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.07);
    }

    .accordion-button {
      background: transparent;
      font-weight: 600;
      color: #023b70;
      box-shadow: none !important;
    }

    .accordion-button::after {
      background-image: url('https://cdn-icons-png.flaticon.com/512/748/748113.png');
      background-size: 16px;
      transform: rotate(0deg);
      transition: transform 0.3s ease;
    }

    .accordion-button:not(.collapsed)::after {
      transform: rotate(180deg);
    }

    .accordion-body {
      background: #fff;
      border-top: 1px solid #e2e6f0;
      color: #4a5876;
      line-height: 1.7;
      padding: 20px 25px;
    }

    .faq-category {
      font-weight: 600;
      font-size: 1.1rem;
      color: #1e4fa1;
      margin-top: 40px;
      margin-bottom: 15px;
      align-items: center;
      gap: 10px;
    }

    .faq-category i {
      color: #1e4fa1;
    }
     .footer-banner{
   color:#000; padding:18px; display:flex; justify-content:center; align-items:center;border-top: 4px solid #eb1736;
  }
  .footer-links a{ color:#000; margin:0 8px; text-decoration:none; font-size:.95rem; }
.slide.full-bg {
    background-size: cover;
    background-position: center;
    color: var(--text);
  }
  .slide .overlay {
    position:absolute;inset:0;background:var(--dark-overlay);z-index:1;
  }
  .slide .slide-content { z-index:2; max-width:1100px; width:100%; }
  </style>
</head>
<body>
<header>
         <div class="container header-container">
            <a class="navbar-brand" href="#">
            <img src="https://marrs.in/images/MaRRS_Rediscover_Logo.png" alt="Logo" width="240px">
            </a>
            <div class="nav-toggle" aria-label="Open Navigation">
               <div class="bar"></div>
               <div class="bar"></div>
               <div class="bar"></div>
            </div>
            <nav>
               <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="/about_marrs">About us</a></li>
                  <li><a href="#">Products</a></li>
                  <li><a href="#">Gallery</a></li>
                  <li><a href="#">Contact us</a></li>
                  <li><a href="#">Login</a></li>
               </ul>
            </nav>
         </div>
      </header>
  <section class="faq-section">
<div class="container">
    <div class="faq-header">
      
      <h2>Frequently Asked Questions (FAQ)</h2>
     
    </div>

    <!-- About Lunar Skill Tests -->
    <div class="faq-category text-center"><h4 class="fw-bold mb-4"> About Early Language Development </h4></div>
    <div class="accordion" id="faqAccordion1">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
           Q: Why is language development so important for my young child (Junior KG/Senior KG)?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
           A: Strong language development is crucial for overall child development. It directly supports their ability to communicate, express and understand feelings, think and learn, solve problems, and build healthy relationships. Starting early sets a strong foundation for lifelong learning.</p>
            </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
             Q: Can young children really start learning spelling and complex words this early?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
            A: Yes! Very young children in Kindergarten absorb information quickly. We focus on teaching words and spelling through engaging and creative assignments and activities that make learning fun and effective, rather than just rote memorization.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
          Q: I want my child to learn a foreign language. How does this help?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion1">
          <div class="accordion-body">
            A: Research shows that starting early makes future language acquisition much easier. Building a strong vocabulary and love for language early on, such as through the Spelling Bee, directly enhances their capacity to master other foreign languages later.
          </div>
        </div>
      </div>
    </div>

    <!-- Testing Structure -->
    <div class="faq-category text-center"><h4 class="fw-bold ">About MaRRS Spelling Bee-Junior</h4></div>
    <div class="accordion" id="faqAccordion2">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
           Q: Which age groups/classes are eligible for the MaRRS Spelling Bee-Junior?
          </button>
        </h2>
        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
           A: This specific competition is tailored for students in Junior KG and Senior KG.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
            Q: What skills will my child gain from participating beyond just spelling?
          </button>
        </h2>
        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
            A: The benefits extend far beyond spelling ability! Your child will develop essential literacy skills, boost their cognitive skills (memory, focus), and gain valuable life skills such as confidence, resilience, and a competitive spirit. Plus, it's designed to be a lot of fun!
          </div>
        </div>
      </div>
       <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq12">
             Q: How many stages are there in the competition, and what is the final goal?
          </button>
        </h2>
        <div id="faq12" class="accordion-collapse collapse" data-bs-parent="#faqAccordion2">
          <div class="accordion-body">
           <p>A: The competition has four exciting levels:</p>
              <ul>
                <li>School Level</li>
                <li>National Prelims</li>
                <li>National Championship</li>
                <li>Primary Colors - The International Championship (The final, global stage!)</li>
              </ul>     </div>
        </div>
      </div>
    </div>

    <!-- Enrollment -->
    <div class="faq-category text-center"><h4 class="fw-bold"> Registration and Logistics</h4></div>
    <div class="accordion" id="faqAccordion3">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq6">
            Q: How do I register my child for the MaRRS Spelling Bee-Junior?
          </button>
        </h2>
        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
          <div class="accordion-body">
           A: You can register your child by clicking the large <strong>"Register for MaRRS Spelling Bee-Junior Today!"</strong> button on this landing page. (You would link this to your registration portal.)
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq7">
            Q: Where can I find the specific study material or syllabus for Junior KG and Senior KG?
          </button>
        </h2>
        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion3">
          <div class="accordion-body">
            A: A detailed syllabus and preparation material are available through the <strong>"View Syllabus for Junior KG & Senior KG"</strong> link provided on the main page. (You would link this to the syllabus document.)
          </div>
        </div>
      </div>
    </div>

    <!-- Rewards -->
    <!--<div class="faq-category text-center"><h4 class="fw-bold"> Rewards and Recognition</h4></div>-->
    <!--<div class="accordion" id="faqAccordion4">-->
    <!--  <div class="accordion-item">-->
    <!--    <h2 class="accordion-header">-->
    <!--      <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq8">-->
    <!--        Q: How are achievements recognised?-->
    <!--      </button>-->
    <!--    </h2>-->
    <!--    <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion4">-->
    <!--      <div class="accordion-body">-->
    <!--        We celebrate every step of progress! Students receive <strong>Digital Certificates</strong> after every test and <strong>Medals</strong> for top performance.-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
 </div>
  </section>
<div class="footer-banner">
         <div class="container d-flex justify-content-between align-items-center footer-links" style="max-width:1100px;">
            <div>
               <span><i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-square-instagram"></i><i class="fa-brands fa-linkedin"></i><i class="fa-brands fa-youtube"></i></span>
               <strong style="color:#000;padding-left: 20px;">MaRRS Rediscover</strong> : © 2025 MaRRS Rediscover. All rights reserved.
            </div>
            <div>
               <a href="#">Terms &amp; Conditions</a> |
               <a href="#">Privacy Policy</a> |
               <a href="#">Contact</a>
            </div>
         </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>

