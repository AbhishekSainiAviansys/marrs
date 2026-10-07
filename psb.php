<?php include('headertest.php');?>

    <style>
        /* --- Base Setup & Variables --- */
        :root {
            --bg-ivory: #FDFDFB;
            --navy-dark: #0A192F;
            --navy-light: #172A45;
            --cobalt-blue: #0F2B5C;
            --accent-crimson: #C33C54;
            --accent-amber: #E29578;
            --accent-blue: #4EA8DE;
            --text-dark: #2B2D42;
            --text-muted: #6C757D;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'Inter', system-ui, sans-serif;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --blue:#0B4F8A;
        }
       

        /* --- Typography Basics --- */
        h1, h2, h3, h4 {
            font-family: var(--font-serif);
            color: var(--navy-dark);
            font-weight: 600;
        }

        p {
            font-size: 1.05rem;
            color: var(--text-dark);
        }

        /* --- Layout Containers --- */
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0 24px;
        }

        section {
            padding: 40px 0;
        }

        /* --- Buttons --- */
        .btnAll {
            display: inline-block;
            font-family: var(--font-sans);
            font-weight: 500;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            padding: 18px 36px;
            border-radius: 4px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }
        

        .btn-primary {
            background-color: #ef4221;
            color: white;
            box-shadow: 0 4px 14px rgba(10, 25, 47, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--accent-crimson);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(195, 60, 84, 0.3);
        }

        .btn-secondary {
            background-color: #FFF;
            color: var(--navy-dark);
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            background-color: #FFF;
        }

       

        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: var(--font-serif);
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--navy-dark);
            letter-spacing: -0.5px;
        }
        .back-btn{
                        background: linear-gradient(135deg, #F9F9F6 0%, #F3F3ED 100%);
        }
        .back-btn button{
            margin: 2rem;
        }
        /* --- Hero Section --- */
   .hero{
background:linear-gradient(135deg,#0b2f52,#0d5ea8);
color:white;
padding:90px 20px;
}

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 60px;
            align-items: center;
        }

        .hero-tagline {
            font-family: var(--font-sans);
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 3px;
            color: #62f1e4;
            margin-bottom: 16px;
            display: block;
        }

        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.15;
            margin-bottom: 24px;
            color: #ffffff;
        }

        .hero-sub {
            font-size: 1.25rem;
            font-family: var(--font-serif);
            font-style: italic;
            color: #ffff04;
            margin-bottom: 40px;
        }

        .hero-image-container {
            position: relative;
        }

        .hero-placeholder-img {
            width: 100%;
            height: 480px;
            background-color: #E5E5DB;
            border-radius: 8px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-style: italic;
            /* In production, replace background below with actual URL */
            background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        /* --- Philosophy Section --- */
        .philosophy {
            text-align: center;
        }

        .philosophy .section-header-center {
            max-width: 700px;
            margin: 0 auto 60px auto;
        }

        .philosophy .section-header-center h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color:#ef4221;
        }

        .philosophy-content {
            max-width: 850px;
            margin: 0 auto;
            font-size: 1.15rem;
            color: var(--text-dark);
        }

        .philosophy-content p {
            margin-bottom: 24px;
        }

        .premium-quote {
            margin-top: 48px;
            font-family: var(--font-serif);
            font-style: italic;
            font-size: 1.4rem;
            color: var(--navy-dark);
            padding: 32px;
            border-top: 1px solid #E5E5DB;
            border-bottom: 1px solid #E5E5DB;
        }

        /* --- Pathways Grid --- */
        .pathways {
            background: #38389df0;
        }
        .pathways .section-header-center h2{
            color:#ffffff;
            text-align:center;
        }
        .pathways .section-header-center p{
                color: #CDDC39 !important;
            text-align: center;
        }
        .pathways-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
        }

        .pathway-card {
            background: white;
            padding: 40px 30px;
            border-radius: 6px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            border-top: 4px solid var(--navy-dark);
            transition: var(--transition);
        }

        .pathway-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
        }

        .pathway-card.english { border-top-color: var(--accent-crimson); }
        .pathway-card.math { border-top-color: var(--accent-amber); }
        .pathway-card.science { border-top-color: var(--accent-blue); }
        .pathway-card.humanities { border-top-color: #2A9D8F; }

        .pathway-tag {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            margin-bottom: 12px;
            display: block;
        }

        .english .pathway-tag { color: var(--accent-crimson); }
        .math .pathway-tag { color: var(--accent-amber); }
        .science .pathway-tag { color: var(--accent-blue); }
        .humanities .pathway-tag { color: #2A9D8F; }

        .pathway-card h3 {
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .pathway-card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* --- Timeline Progression --- */
        .progression {
            background-color: var(--bg-ivory);
        }
.progression .section-header-center{
    text-align:center;
}
        .timeline {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 60px;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 30px;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #E5E5DB;
            z-index: 1;
        }

        .timeline-node {
            position: relative;
            z-index: 2;
        }

        .node-circle {
            width: 60px;
            height: 60px;
            background-color: white;
            border: 2px solid #2196F3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-serif);
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 24px;
            transition: var(--transition);
        }

        .timeline-node:hover .node-circle {
            background-color: orange;
            color: white;
        }

        .timeline-node h3 {
            font-size: 1.25rem;
            margin-bottom: 12px;
        }

        .timeline-node p {
            font-size: 0.9rem;
            color: var(--text-muted);
            padding-right: 10px;
        }

        /* --- Global Destination Section --- */
        .global-destination {
            background-color: var(--cobalt-blue);
            color: white;
            text-align: center;
        }

        .global-destination h2, .global-destination h3, .global-destination p {
            color: white;
        }

        .global-destination h2 {
            font-size: 2.8rem;
        }

        .global-sub {
            font-style: italic;
            font-family: var(--font-serif);
            opacity: 0.8;
            margin-bottom: 60px;
            font-size: 1.2rem;
        }

        /* Funnel Graphic Architecture */
        .funnel-architecture {
            max-width: 800px;
            margin: 0 auto 60px auto;
        }

        .funnel-block {
            padding: 30px;
            border-radius: 4px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .funnel-block.top {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 1.2rem;
        }

        .funnel-arrow {
            font-size: 1.5rem;
            margin: 15px 0;
            color: var(--accent-amber);
            display: block;
        }

        .funnel-block.bottom {
            background-color: white;
            color: var(--cobalt-blue);
            font-size: 1.4rem;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .funnel-block.bottom h4 {
            color: var(--cobalt-blue);
            font-size: 1.5rem;
            margin-bottom: 4px;
        }

        .funnel-block span {
            display: block;
            font-size: 0.8rem;
            opacity: 0.8;
            font-family: var(--font-sans);
            margin-top: 4px;
        }

        .global-description {
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.8;
            opacity: 0.9;
        }

        /* --- Competencies Grid --- */
        .competencies {
            background-color: #F9F9F6;
        }

 .competencies .section-header-center h2{
            color:#0f2a5c;
            text-align:center;
        }
        .competencies .section-header-center p{
                color: #1e0409 !important;
            text-align: center;
        }
        .competencies-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 50px;
        }

        .comp-item {
            display: flex;
            gap: 20px;
            background: white;
            padding: 30px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.01);
        }

        .comp-icon {
            font-size: 1.5rem;
            line-height: 1;
        }
        

        .comp-item h3 {
            font-size: 1.25rem;
            margin-bottom: 8px;
            font-family: var(--font-sans);
            font-weight: 600;
        }

        .comp-item p {
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        /* --- Closing CTA --- */
        .cta-close {
            background: linear-gradient(135deg, #F3F3ED 0%, #EAEAE0 100%);
            text-align: center;
        }

        .cta-close h2 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .cta-close p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 40px auto;
            color: var(--text-dark);
        }

        /* --- Footer --- */
        footer {
            background-color: var(--navy-dark);
            padding: 40px 0;
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        /* --- Responsive Matrix (Media Queries) --- */
        @media (max-width: 992px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 40px;
                text-align: center;
            }
            .hero h1 { font-size: 2.8rem; }
            .hero-placeholder-img { height: 350px; }
            .timeline {
                grid-template-columns: repeat(2, 1fr);
                gap: 40px 24px;
            }
            .timeline::before { display: none; }
            .competencies-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 576px) {
            section { padding: 70px 0; }
            .hero h1 { font-size: 2.2rem; }
            .section-header-center h2, .global-destination h2, .cta-close h2 { font-size: 1.9rem; }
            .timeline { grid-template-columns: 1fr; }
            .node-circle { margin-bottom: 12px; }
            .funnel-block.bottom h4 { font-size: 1.2rem; }
        }
        /* FontAwesome Enhancements */
.pathway-tag i {
    margin-right: 8px;
    font-size: 0.9rem;
}

.comp-icon i {
    font-size: 1.6rem;
            color:#03A9F4;
}

.node-circle i {
    font-size: 1.2rem;
}

.timeline-node:hover .node-circle i {
    color: white;
}

.pathway-card i {
    transition: var(--transition);
}

.pathway-card:hover i {
    transform: scale(1.2);
}
.header-top{
    background: linear-gradient(135deg, var(--blue), #071a33);
    padding:1rem 2rem;
}
</style>
  <div class="header-top">
    <button class="btn btn-danger btn-sm text-white"  onclick="history.back()">
      ← Go Back
    </button>
</div>
    <!-- Section 1: Hero Frame -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-text-block">
               
                <span class="hero-tagline">Rediscover Learning. Rediscover Childhood.</span>
                <h1>Because learning begins not with answers, but with curiosity.</h1>
                <p class="hero-sub">Welcome to the MaRRS Preschool Bee framework.</p>
                <a href="#register" class="btn btn-primary btnAll">Begin the Journey of Discovery</a>
            </div>
            <div class="hero-image-container">
                <img src="https://marrs.in/images/PSB-logo.png" alt="PSB" class="img-fluid rounded"/>
            </div>
        </div>
    </section>

    <!-- Section 2: Core Philosophy -->
    <section class="philosophy">
        <div class="container">
            <div class="section-header-center">
                <h2>The Genesis of Genius: Every Child is Born Curious</h2>
            </div>
            <div class="philosophy-content">
                <p>The early years of life are an exquisite canvas of wonder, exploration, and endless interrogation. Every sound heard, shape identified, color perceived, and story shared forms the bedrock of a child’s lifelong intellectual architecture.</p>
                <p>The MaRRS Preschool Bee (PSB) is a premier, expert-curated developmental framework designed exclusively for Nursery, Junior Kindergarten (LKG), and Senior Kindergarten (UKG) learners. By transforming foundational learning into immersive, age-appropriate milestones, PSB gracefully nurtures the vital faculties of vocabulary, spatial logic, scientific inquiry, and social empathy.</p>
                <div class="premium-quote">
                    "An Elite Learning Experience: Far beyond a traditional assessment, the Preschool Bee is a celebratory, low-stress journey that empowers young minds to unlock their innate potential and step onto a global stage with poise and self-assurance."
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: The Four Intellectual Pathways -->
    <section class="pathways">
        <div class="container">
            <div class="section-header-center">
                <h2>The Four Intellectual Pathways</h2>
                <p style="color: var(--text-muted);">Our methodology organizes cognitive development into four sophisticated domains, creating an intuitive, holistic approach to early childhood genius.</p>
            </div>
       <div class="pathways-grid">

    <div class="pathway-card english">
        <span class="pathway-tag">
            <i class="fas fa-book-open"></i> Language
        </span>
        <h3>PSB English</h3>
        <p><strong>The Gift of Expression:</strong> Language dictates how we comprehend our world. This pathway refines vocabulary, active listening, articulation, and cognitive recall—equipping children with the verbal confidence that underpins all future academic success.</p>
    </div>

    <div class="pathway-card math">
        <span class="pathway-tag">
            <i class="fas fa-calculator"></i> Logic
        </span>
        <h3>PSB Mathematics</h3>
        <p><strong>The Logic of Patterns:</strong> Long before numbers hit a page, mathematical fluency exists in structures, symmetry, and sequencing. Through playful, elegant exploration, children master logical thinking and effortless problem-solving.</p>
    </div>

    <div class="pathway-card science">
        <span class="pathway-tag">
            <i class="fas fa-flask"></i> Discovery
        </span>
        <h3>PSB Science</h3>
        <p><strong>The Spirit of Inquiry:</strong> Children do not merely look; they observe like natural-born scientists. This track channels their endless "whys" into structured cognitive reasoning, encouraging observation, systematic inquiry, and critical analysis.</p>
    </div>

    <div class="pathway-card humanities">
        <span class="pathway-tag">
            <i class="fas fa-globe"></i> Empathy
        </span>
        <h3>PSB Humanities</h3>
        <p><strong>The Foundation of Empathy:</strong> True intelligence balances intellect with emotional awareness. This pathway introduces early learners to cultures, communities, core values, and environmental mindfulness—shaping them into conscious global citizens.</p>
    </div>

</div>
    </section>

    <!-- Section 4: The Prestigious Progression -->
    <section class="progression">
        <div class="container">
            <div class="section-header-center">
                <h2>The Prestigious Progression</h2>
                <p style="color: var(--text-muted);">From Classroom to National Finals, built around a structured, four-tier hierarchy designed to celebrate effort at every milestone.</p>
            </div>
            <div class="timeline">
                <div class="timeline-node">
    <div class="node-circle">
        <i class="fas fa-school"></i>
    </div>
    <h3>School Championship</h3>
    <p>A gentle, low-stakes introduction conducted right within the child's familiar school environment.</p>
</div>

<div class="timeline-node">
    <div class="node-circle">
        <i class="fas fa-users"></i>
    </div>
    <h3>Inter-School</h3>
    <p>A sophisticated next step where young learners step beyond their immediate boundaries, interacting with ambitious peers.</p>
</div>

<div class="timeline-node">
    <div class="node-circle">
        <i class="fas fa-trophy"></i>
    </div>
    <h3>State Championship</h3>
    <p>A prestigious regional gathering that honours exceptional capability, instilling a deep sense of academic pride.</p>
</div>

<div class="timeline-node">
    <div class="node-circle">
        <i class="fas fa-crown"></i>
    </div>
    <h3>National Finals</h3>
    <p>A grand, high-visibility summit uniting the nation’s brightest early minds to showcase early childhood excellence.</p>
</div>
            </div>
        </div>
    </section>

    <!-- Section 5: The Pinnacle Destination -->
  <section class="global-destination"> 
  <div class="container">
       <h2>The Pinnacle Destination: MaRRS Primary Colors</h2>
       <p class="global-sub">The International Championship for Preschoolers</p> 
       <div class="funnel-architecture"> 
       <div class="funnel-block top"> MaRRS Preschool Bee <span>The Essential Foundation (School, Interschool, State & National)</span> </div> 
       <span class="funnel-arrow">║<br>▼<br>TOP PERFORMERS QUALIFY<br>▼<br>║</span> <div class="funnel-block bottom">
            <h4>MaRRS Primary Colors</h4> <span>The Prestigious International Arena for Global Minds</span> </div> </div>
            <div class="global-description"> <p>The journey does not end at the national border. The ultimate crowning achievement for every young explorer is qualification for MaRRS Primary Colors—the definitive international arena for preschool talent. By maintaining a steady, triumphant trajectory through the levels of the MaRRS Preschool Bee, top-performing children earn the rare distinction of representing their country at the International Championship.</p> <br> <p>Named after the fundamental colours that blend to create all the beauty in the universe, MaRRS Primary Colours tests advanced conceptual application, multilingual agility, and international analytical benchmarks. It offers your child an unmatched global platform, opening doors to an elite international community of educators, thinkers, and peers before they even step into primary school.</p> </div> </div> 
            </section> <!-- Section 6: Key Competencies Value Grid --> 
            <section class="competencies"> <div class="container"> 
            <div class="section-header-center"> <h2>Cultivating Life-Readiness Skills</h2> 
            <p style="color: var(--text-muted);">The competencies honed throughout this competitive journey extend far beyond school preparation; they cultivate the attributes of tomorrow's leaders.</p> </div> 
            <div class="competencies-grid"> <div class="comp-item"> 
            <div class="comp-icon"> <i class="fas fa-lightbulb"></i> </div> <div> <h3>Creative Imagination &amp; Spatial Intuition</h3> <p>Nurturing visual-spatial processing and fluid baseline innovative tracking mechanics.</p> </div> </div>
            <div class="comp-item"> <div class="comp-icon"> <i class="fas fa-brain"></i> </div> 
            <div> <h3>Active Concentration &amp; Advanced Memory Retention</h3> <p>Sharpening cognitive stamina, focal pathways, and retrieval accuracy thresholds.</p> </div>
            </div> <div class="comp-item"> <div class="comp-icon"> <i class="fas fa-microphone"></i> </div> <div> <h3>Syllabic Precision &amp; Confident Articulation</h3> <p>Developing flawless phonetic structural security and high-comfort poise metrics.</p> </div> </div> <div class="comp-item"> <div class="comp-icon"> <i class="fas fa-shield-halved"></i> </div> <div> <h3>Resilience, Emotional Poise, &amp; Independent Thinking</h3> <p>Instilling calculated critical analytics and independent self-assurance ecosystems.</p> </div> </div> </div> </div> </section> <!-- Section 7: Final Conversion Call to Action --> <section class="cta-close" id="register"> <div class="container"> <h2>Give Your Child the Ultimate Global Headstart</h2> <p>The MaRRS Preschool Bee provides schools and discerning parents with an unparalleled opportunity to enrich their children's formative years. Secure your child’s place on the path toward global recognition today.</p> 
            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">

    <a href="/addschool"
       class="btn btn-warning">
        Spark a Revolution - Enroll Your School Now →
    </a>

    <a href="/signin?tab=register" class="btn btn-primary" onclick="alert('Registration flow activated.')">Register for the MaRRS Preschool Bee Now</a>


</div>
            </div> </section> <?php include('footertest.php');?>