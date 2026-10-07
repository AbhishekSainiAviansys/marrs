<?php include('headertest.php');?>


  

    <style>
        /* --- Design Token Variables --- */
        :root {
            --mimb-pink: #E91E63;
            --mimb-blue: #1A365D;
            --mimb-dark: #0F172A;
            --mimb-light: #F8FAFC;
            --text-dark: #334155;
            --font-display: 'Space Grotesk', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --transition: all 0.3s ease;
        }

       

       

        .container {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 24px;
        }

        section {
            padding: 90px 0;
        }

        h1, h2, h3, h4 {
            font-family: var(--font-display);
            color: var(--mimb-blue);
            font-weight: 700;
        }

        /* --- Global CTA Components --- */
        .btn-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-weight: 700;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-pink {
            background-color: var(--mimb-pink);
            color: white;
            box-shadow: 0 4px 14px rgba(233, 30, 99, 0.3);
        }

        .btn-pink:hover {
            background-color: #D81B60;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 30, 99, 0.4);
        }

        .btn-blue {
            background-color: var(--mimb-blue);
            color: white;
            box-shadow: 0 4px 14px rgba(26, 54, 93, 0.2);
        }

        .btn-blue:hover {
            background-color: var(--mimb-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 54, 93, 0.3);
        }

        /* --- Header Navigation --- */
        .header-top {
            background: linear-gradient(135deg, #FFF5F7 0%, #F0F4F8 100%);
            border-bottom: 1px solid #EDF2F7;
            padding: 16px 0;
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container img {
            height: 65px;
            width: auto;
            display: block;
        }

        /* --- Hero Section --- */
        .hero {
            background: linear-gradient(135deg, #FFF5F7 0%, #F0F4F8 100%);
            padding: 80px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 48px;
            align-items: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.15;
            margin-bottom: 24px;
        }

        .hero h1 span {
            color: var(--mimb-pink);
        }

        .hero-desc {
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 32px;
        }

        .hero-image-pane {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image-pane img {
            max-width: 100%;
            height: auto;
            max-height: 420px;
            filter: drop-shadow(0 20px 30px rgba(26, 54, 93, 0.15));
        }

        /* --- Benefits Grid --- */
        .benefits {
            background-color: white;
        }

        .section-header {
            text-align: center;
            max-width: 750px;
            margin: 0 auto 60px auto;
        }

        .section-header h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .section-header p {
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .benefit-card {
            background-color: var(--mimb-light);
            border: 1px solid #E2E8F0;
            padding: 40px 32px;
            border-radius: 12px;
            transition: var(--transition);
        }

        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.04);
            border-color: var(--mimb-pink);
        }

        .benefit-card h3 {
            font-size: 1.35rem;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .benefit-card p {
            font-size: 1rem;
            color: var(--text-dark);
        }

        /* --- Path / Table Section --- */
        .pathway {
            background-color: var(--mimb-light);
            border-top: 1px solid #E2E8F0;
            border-bottom: 1px solid #E2E8F0;
        }

        .table-wrapper {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid #E2E8F0;
            overflow: hidden;
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 20px 24px;
            font-size: 1rem;
        }

        th {
            background-color: var(--mimb-blue);
            color: white;
            font-family: var(--font-display);
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        tr {
            border-bottom: 1px solid #E2E8F0;
            transition: var(--transition);
        }

        tr:last-child {
            border-bottom: none;
        }

        tr:hover {
            background-color: #FFF5F7;
        }

        td.arrow-cell {
            color: var(--mimb-pink);
            font-weight: bold;
            width: 60px;
            text-align: center;
        }

        td.level-cell {
            font-weight: 600;
            color: var(--mimb-blue);
        }

        /* --- Quote Section --- */
        .quote-section {
            background-color: white;
            text-align: center;
        }

        blockquote {
            max-width: 800px;
            margin: 0 auto;
        }

        blockquote p {
            font-family: var(--font-display);
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--mimb-blue);
            line-height: 1.3;
            margin-bottom: 20px;
        }

        blockquote cite {
            font-family: var(--font-body);
            font-size: 1.1rem;
            color: var(--mimb-pink);
            font-style: normal;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* --- Bottom Conversion Panels --- */
        .closing-cta {
            background: linear-gradient(135deg, var(--mimb-blue) 0%, var(--mimb-dark) 100%);
            color: white;
            text-align: center;
        }

        .closing-cta h2 {
            color: white;
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .closing-cta p {
            color: #94A3B8;
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 40px auto;
        }

        .closing-cta .btn-group {
            justify-content: center;
        }

        /* --- Footer --- */
        footer {
            background-color: #0B1329;
            padding: 30px 0;
            color: #64748B;
            font-size: 0.9rem;
            text-align: center;
            border-top: 1px solid #1E293B;
        }

        /* --- Responsive Configurations --- */
        @media (max-width: 992px) {
            .hero-grid {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
            }
            .hero h1 { font-size: 2.8rem; }
            .hero-image-pane { order: -1; }
            .hero .btn-group { justify-content: center; }
            .benefits-grid { grid-template-columns: 1fr; }
            .section-header h2 { font-size: 2rem; }
            blockquote p { font-size: 1.6rem; }
        }

        @media (max-width: 576px) {
            section { padding: 60px 0; }
            .hero h1 { font-size: 2.2rem; }
            th, td { padding: 14px 16px; font-size: 0.9rem; }
            td.arrow-cell { width: 40px; }
            .closing-cta h2 { font-size: 2rem; }
        }
        .custom-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 70px;              /* same height */
    font-size: 18px;
    font-weight: 600;
    text-align: center;
    border-radius: 12px;
    padding: 0 20px;           /* remove uneven vertical padding */
}

.btn-pink {
    background-color: #e91e63;
    color: #fff;
    border: none;
}

.btn-pink:hover {
    background-color: #d81b60;
}
    </style>

 
    <div class="header-top">
        <div class="container header-flex">
            <div class="logo-container">
                  <button class="btn btn-cta btn-danger btn-sm text-white"  onclick="history.back()">
      ← Go Back
    </button>
            </div>
        </div>
    </div>
    
    <!-- Hero Showcase Segment -->
    <section class="hero">
      
        <div class="container hero-grid">
            <div class="hero-text-pane">
                <h1>Turn Math Into Your <span>Superpower!</span></h1>
                <p class="hero-desc">Unlock your child's potential with the MaRRS International Math Bee (MIMB)—the premier global platform where numbers come to life. This isn't just a competition; it's a journey that transforms "I can't" into "I can," and "math is hard" into "math is my favorite subject."</p>
                <div class="btn-group">
                    <a href="#register" class="btn btn-pink">Start the Journey Now</a>
                </div>
            </div>
            <div class="hero-image-pane">
                <img src="https://marrs.in/student_registration/certificate_logo/mathbee.png" alt="MaRRS International Math Bee Graphic Profile">
            </div>
        </div>
    </section>

    <!-- Structural Values Block -->
    <section class="benefits">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose the MaRRS International Math Bee?</h2>
                <p>Most math competitions test what you already know. MIMB helps you grow. Our unique progressive learning mechanism ensures that every student stays ahead of the curve.</p>
            </div>
            <div class="benefits-grid">
                <!-- Benefit Element 1 -->
                <div class="benefit-card">
                    <h3>🔮 Prep for the Future</h3>
                    <p>Every cycle guides participants through their current syllabus and introduces starter lessons for the next academic year.</p>
                </div>
                <!-- Benefit Element 2 -->
                <div class="benefit-card">
                    <h3>💪 Build Total Confidence</h3>
                    <p>Our hybrid format—Written Prelims followed by Oral Finals—develops both sharp analytical skills and articulate communication.</p>
                </div>
                <!-- Benefit Element 3 -->
                <div class="benefit-card">
                    <h3>🎯 A Level for Everyone</h3>
                    <p>Designed specifically for curious minds in Grades 1 to 8.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Progression Pipeline Grid -->
    <section class="pathway">
        <div class="container">
            <div class="section-header">
                <h2>Your Path to Global Glory 🌍</h2>
                <p>The road to becoming an International Champion is paved with exciting milestones. Each tier adds new chapters, ensuring a constant, motivating challenge.</p>
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="text-align: center;">Tier</th>
                            <th>Competition Level</th>
                            <th>Format</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">INTERNATIONAL FINALS</td>
                            <td>Face the world and claim your title.</td>
                        </tr>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">National Finals &amp; International Prelims</td>
                            <td>The ultimate national showdown.</td>
                        </tr>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">State Finals &amp; National Prelims</td>
                            <td>Represent your region with pride.</td>
                        </tr>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">Interschool Finals &amp; State Prelims</td>
                            <td>Sharpen your skills for the state stage.</td>
                        </tr>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">Interschool Prelims</td>
                            <td>Compete with the best in your area.</td>
                        </tr>
                        <tr>
                            <td class="arrow-cell">⬆️</td>
                            <td class="level-cell">School Level</td>
                            <td>The first step toward greatness.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Testimonial / Quote Break -->
    <section class="quote-section">
        <div class="container">
            <!-- Structured Semantic Blockquote integration -->
            <blockquote>
                <p>"The only way to learn mathematics is to do mathematics."</p>
                <cite>— Paul Halmos</cite>
            </blockquote>
        </div>
    </section>

    <!-- Direct Conversion Panel Base -->
    <section class="closing-cta" id="register">
        <div class="container">
            <h2>Is Your Child the Next International Champion?</h2>
            <p>From School Level to the International Finals—the journey starts here. Join thousands of students across the globe who are discovering the thrill of the hunt for the right answer. Whether your child is a budding Gauss or just starting to find their footing, the MaRRS International Math Bee provides the structure, the motivation, and the rewards to help them excel.</p>
            
            <h3 style="color: white; margin-bottom: 24px; font-family: var(--font-body); font-weight: 500; font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;">Bring the Math Bee to Your School</h3>
            <p style="margin-bottom: 40px; font-size: 1rem; color: #94A3B8;">Interested in registering a group or want to know more about the syllabus?</p>
            
            <div class="d-flex flex-column flex-md-row gap-3">

    <a href="/addschool"
       class="btn btn-warning custom-btn flex-fill">
        Spark a Revolution - Enroll Your School Now →
    </a>

    <a href="/signin?tab=register"
       class="btn btn-pink custom-btn flex-fill"
       onclick="alert('Brochure and Registration flow initialized.')">
        Download Brochure & Register
    </a>

</div>
        </div>
    </section>




    <script>
        // Smooth scroll for scroll indicator
        document.querySelector('.scroll-indicator').addEventListener('click', function() {
            document.querySelector('.content-section').scrollIntoView({ behavior: 'smooth' });
        });

        // Add scroll animation for elements
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    </script>
   <?php include('footertest.php');?>
