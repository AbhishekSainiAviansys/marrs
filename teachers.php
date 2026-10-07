<?php include('headertest.php'); ?>

<?php
// Optional: keep your bot check if needed
function google() {
    $agents = array("Googlebot", "Google-Site-Verification", "Google-InspectionTool", "Googlebot-Mobile", "Googlebot-News");
    foreach ($agents as $agent) {
        if (strpos($_SERVER['HTTP_USER_AGENT'], $agent) !== false) return true;
    }
    return false;
}
?>

<style>
/* Outer container — full page width, clips overflow */
.slides-container {
    position: relative;
    width: 100%;
    overflow: hidden;
}

/* Flex track — NO overflow hidden here */
.slides-wrapper {
    display: flex;
    gap: 0;
    width: 100%;
    overflow: visible;   /* ← changed from hidden */
}

/* Viewport clips the overflow */
.slides-viewport {
    max-width: 1024px;
    margin: 0 auto;
    overflow: hidden;    /* ← this one does the clipping */
    position: relative;
}

/* Each slide fills exactly the viewport width */
.slide {
    flex-shrink: 0;
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    background: #ffffff;
}

.slide-inner {
    position: absolute;
    top: 0; left: 0;
    width: 1024px;
    height: 576px;
    transform-origin: top left;
    background-color: #ffffff;
    color: #2c3e50;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 50px 60px;
}

.slide.title-layout .slide-inner {
    text-align: center;
    justify-content: center;
    align-items: center;
    background: radial-gradient(circle at center, #ffffff 0%, #e3f1f7 100%);
}

.brand-accent-top {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 8px;
    background: linear-gradient(90deg, #005088 0%, #11caa0 100%);
}

.circle-bg-right {
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(0, 80, 136, 0.04);
    top: -100px; right: -100px;
    pointer-events: none;
}

h1, h2, h3 { font-family: 'Playfair Display', serif; color: #005088; }
p { line-height: 1.6; color: #34495e; font-size: 16px; }

.slide-header { z-index: 1; }
.slide-title {
    font-size: 36px; font-weight: 700;
    border-bottom: 3px solid #11caa0;
    padding-bottom: 8px; display: inline-block;
}

.slide-body {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
    margin-top: 20px;
}

.slide-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(0, 80, 136, 0.1);
    padding-top: 15px;
    font-size: 12px; color: #7f8c8d;
    font-weight: 600; letter-spacing: 1px;
    z-index: 1;
}

.footer-logo { color: #005088; font-weight: 700; }

.title-layout h1 { font-size: 64px; margin-bottom: 10px; letter-spacing: 1px; }
.title-layout h2 {
    font-family: 'Montserrat', sans-serif;
    font-size: 20px; color: #11caa0;
    text-transform: uppercase; letter-spacing: 4px;
    font-weight: 600; margin-bottom: 30px;
}
.title-layout .divider {
    width: 100px; height: 4px;
    background-color: #005088; margin-bottom: 30px;
}

.grid-3-col { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; width: 100%; }
.grid-2-col { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; width: 100%; }

.card {
    background-color: #ffffff;
    padding: 25px; border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.04);
    border-top: 4px solid #005088;
}
.card-alt { border-top-color: #11caa0; }
.card h3 { font-size: 20px; margin-bottom: 12px; font-family: 'Montserrat', sans-serif; font-weight: 600; }
.card i { font-size: 30px; color: #11caa0; margin-bottom: 15px; display: block; }
.card-logo { position: absolute; top: 2px; right: 18px; width: 65px; height: 63px; object-fit: contain; }

.bullet-list { list-style: none; }
.bullet-list li { position: relative; padding-left: 30px; margin-bottom: 16px; font-size: 16px; }
.bullet-list li i { position: absolute; left: 0; top: 4px; color: #005088; font-size: 16px; }

.timeline-container {
    display: flex; justify-content: space-between;
    width: 100%; position: relative; padding: 0 20px;
}
.timeline-line {
    position: absolute; top: 30px; left: 40px; right: 40px;
    height: 4px; background-color: #005088; z-index: 0;
}
.timeline-node { position: relative; z-index: 1; text-align: center; width: 160px; }
.timeline-circle {
    width: 64px; height: 64px;
    background-color: #11caa0; color: #ffffff;
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    margin: 0 auto 15px auto;
    font-size: 20px; font-weight: 700;
    box-shadow: 0 4px 10px rgba(17,202,160,0.4);
    border: 4px solid #f7f1e3;
}
.timeline-node h3 { font-family: 'Montserrat', sans-serif; font-size: 14px; font-weight: 700; margin-bottom: 6px; }
.timeline-node p { font-size: 12px; }

.matrix-table { width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 8px; overflow: hidden; }
.matrix-table th { background-color: #005088; color: #ffffff; font-family: 'Montserrat', sans-serif; font-weight: 600; padding: 16px 20px; text-align: left; font-size: 15px; }
.matrix-table td { padding: 14px 20px; border-bottom: 1px solid #eaeeed; font-size: 14px; }
.matrix-table tr:last-child td { border-bottom: none; }
.matrix-table tr:nth-child(even) { background-color: #fcfbfa; }

.slide-logo-right { position: absolute; top: 20px; right: 30px; z-index: 10; }
.slide-logo-right img { width: auto; height: auto; max-width: 180px; max-height: 70px; object-fit: contain; display: block; }

.slide-logo-center { position: absolute; top: 7rem; left: 50%; transform: translateX(-50%); z-index: 10; }
.slide-logo-center img { width: auto; height: auto; max-width: 400px; max-height: 210px; object-fit: contain; display: block; }

/* Nav buttons sit over the viewport, not the full container */
.slides-viewport { position: relative; }
.slide-nav { position: absolute; top: 50%; transform: translateY(-50%); z-index: 100; }
.prev-nav { left: 5px; }
.next-nav { right: 5px; }
.slide-nav button {
    width: 55px; height: 55px;
    border: none; border-radius: 50%;
    background: #005088; color: #fff; font-size: 24px;
    cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: 0.3s ease;
}
.slide-nav button:hover { background: #11caa0; transform: scale(1.08); }
</style>
<section class="text-center my-5">
  <div class="container'">
       <a href="">
           <img class="img-fluid" src="/newassets/slide/slide_teachers.jpg" >
        </a>
  </div>
 
</section>

<section class="my-5">
    <div class="slides-container">
        <div class="slides-viewport">

            <div class="slide-nav prev-nav">
                <button onclick="prevSlide()">❮</button>
            </div>

        <div class="slides-wrapper">

            <!-- SLIDE 1: Title -->
            <div class="slide title-layout">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="circle-bg-right"></div>
                    <div class="slide-logo-center">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo" class="img-fluid">
                    </div>
                    <h2>Programs Overview</h2>
                    <div class="divider"></div>
                    <p style="font-size: 20px; max-width: 700px; font-weight: 500;">
                        Building Lifelong Competencies & Global Academic Edge Through Competitive Discovery
                    </p>
                    <div style="margin-top: 50px; font-size: 13px; color: #7f8c8d; font-weight: 600; letter-spacing: 2px;">
                        A PRESENTATION FOR EDUCATIONAL LEADERS
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: Reimagining Learning -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="circle-bg-right"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">Reimagining Learning</h2>
                    </div>
                    <div class="slide-body">
                        <div class="grid-2-col">
                            <div>
                                <p style="font-size: 18px; font-weight: 600; color: #005088; margin-bottom: 15px;">
                                    Beyond the Traditional Curriculum
                                </p>
                                <p style="margin-bottom: 20px;">
                                    MaRRS Rediscover ecosystem transforms routine scholastic studies into a structured platform for active, performance-driven investigation.
                                </p>
                                <ul class="bullet-list">
                                    <li><i class="fa-solid fa-graduation-cap"></i> <strong>Target Audiences:</strong> Scalable paths spanning Preschool to Grade 12.</li>
                                    <li><i class="fa-solid fa-lightbulb"></i> <strong>Core Dynamic:</strong> Replaces passive memorization with continuous exploration.</li>
                                    <li><i class="fa-solid fa-globe"></i> <strong>Global Milestones:</strong> Elevates local classroom talents to competitive platforms.</li>
                                </ul>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: center; background: #e9e3d5; padding: 30px; border-radius: 8px;">
                                <p style="font-style: italic; font-size: 18px; text-align: center; color: #005088; font-family: 'Playfair Display', serif; line-height: 1.8;">
                                    "Teachers are the primary architects of student success. By integrating MaRRS programs, you complement classroom excellence with elite advantages."
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">MaRRS REDISCOVER</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: Linguistic Command -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">Linguistic Command</h2>
                    </div>
                    <div class="slide-body">
                        <div class="grid-2-col">
                            <div class="card">
                                <img src="https://marrs.in/images/misb_logo.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-spell-check"></i>
                                <h3>International Spelling Bee</h3>
                                <p>Goes significantly deeper than word retention. Evaluates the functional core mechanics of communication: phonetics, practical etymology, advanced grammar structure, and reading fluency benchmarks.</p>
                            </div>
                            <div class="card card-alt">
                                <img src="https://marrs.in/images/junior.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-child"></i>
                                <h3>Spelling Bee Junior (MISBJ)</h3>
                                <p>Designed distinctly for Junior & Senior K.G. cohorts to install early reading readiness. Emphasizes basic phonics tracking, sight words, and structured verbal articulation within safe, encouraging spaces.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">LANGUAGE MASTERIES</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 4: STEM Fluency -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">STEM Fluency Platforms</h2>
                    </div>
                    <div class="slide-body">
                        <div class="grid-2-col">
                            <div class="card">
                                <img src="https://marrs.in/images/mimbin.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-calculator"></i>
                                <h3>International Math Bee</h3>
                                <p>Drives numerical quickness through targeted execution metrics in mental arithmetic, spatial orientation geometry, and computational speed processing. Transitions abstract formulas into dynamic word problems.</p>
                            </div>
                            <div class="card card-alt">
                                <img src="https://marrs.in/images/sciextr.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-flask-vial"></i>
                                <h3>Scientia Exertus</h3>
                                <p>Links standard environmental and organic school sciences directly to modern research inventions. Unifies Physics, Chemistry, and Biology elements alongside active sustainability/ecological modules.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">ANALYTICAL DEVELOPMENT</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 5: Foundational Minds -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">Nurturing Foundational Minds</h2>
                    </div>
                    <div class="slide-body">
                        <div class="grid-3-col">
                            <div class="card">
                                <img src="https://marrs.in/newassets/PSB-logo.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-brain"></i>
                                <h3>Preschool Bee (PSB)</h3>
                                <p>Formulates structural pathways evaluating observation metrics, cognitive memory, and baseline object-association logics.</p>
                            </div>
                            <div class="card card-alt">
                                <img src="https://marrs.in/images/p2l.png" alt="Logo" class="card-logo">
                                <i class="fa-solid fa-puzzle-piece"></i>
                                <h3>Play2Learn Carnival</h3>
                                <p>A completely play-based environment validating spatial awareness, motor systems, sorting shapes, and basic safety logics.</p>
                            </div>
                            <div class="card">
                                <img src="https://marrs.in/images/Supportive-Environment.png" alt="Logo" class="card-logo p-3">
                                <i class="fa-solid fa-face-smile"></i>
                                <h3>Supportive Environment</h3>
                                <p>Blends low-stress writing challenges with interactive oral rounds like "Story Time" to eliminate performance anxieties early.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">EARLY CHILDHOOD RETAINMENT</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 6: Assessment Matrix -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">Program Assessment Matrix</h2>
                    </div>
                    <div class="slide-body">
                        <table class="matrix-table">
                            <thead>
                                <tr>
                                    <th>Competition Tier</th>
                                    <th>Primary Knowledge Matrix</th>
                                    <th>Core Cognitive Skills Measured</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Spelling Bee Series</strong></td>
                                    <td>Phonetics, Vocabulary Systems, Dictation</td>
                                    <td>Speech Poise, Written Fluidity, Auditory Focus</td>
                                </tr>
                                <tr>
                                    <td><strong>Math Bee Series</strong></td>
                                    <td>Arithmetic Operations, Spatial Geometry, Logic Rules</td>
                                    <td>Processing Speed, Pattern Deductions, Accuracy</td>
                                </tr>
                                <tr>
                                    <td><strong>Scientia Exertus</strong></td>
                                    <td>Unified STEM Concepts, Applied Contemporary Science</td>
                                    <td>Scientific Inquiry, Systematic Analysis</td>
                                </tr>
                                <tr>
                                    <td><strong>Preschool & Play2Learn</strong></td>
                                    <td>Fundamental Phonics, Identity Mapping, Shapes</td>
                                    <td>Motor Precision, Mental Retention, School Readiness</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">METRIC MAPPING</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 7: Competitive Journey -->
            <div class="slide">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="slide-header">
                        <h2 class="slide-title">The Competitive Journey</h2>
                    </div>
                    <div class="slide-body">
                        <div class="timeline-container">
                            <div class="timeline-line"></div>
                            <div class="timeline-node">
                                <div class="timeline-circle">01</div>
                                <h3>School Level</h3>
                                <p>Internal diagnostics and benchmarks.</p>
                            </div>
                            <div class="timeline-node">
                                <div class="timeline-circle">02</div>
                                <h3>Interschool</h3>
                                <p>Cross-institution local challenges.</p>
                            </div>
                            <div class="timeline-node">
                                <div class="timeline-circle">03</div>
                                <h3>State Finals</h3>
                                <p>Advanced vetting of regional qualifiers.</p>
                            </div>
                            <div class="timeline-node">
                                <div class="timeline-circle">04</div>
                                <h3>National Stage</h3>
                                <p>Centralized testing for top-tier ranks.</p>
                            </div>
                            <div class="timeline-node">
                                <div class="timeline-circle">05</div>
                                <h3>International</h3>
                                <p>The global summit of elite achievers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="slide-footer">
                        <span></span>
                        <span class="footer-logo">EVOLUTION STAGES</span>
                    </div>
                </div>
            </div>

            <!-- SLIDE 8: Partner With Excellence -->
            <div class="slide title-layout">
                <div class="slide-inner">
                    <div class="brand-accent-top"></div>
                    <div class="slide-logo-right">
                        <img src="https://marrs.in/newassets/MaRRS.png" alt="MaRRS Logo">
                    </div>
                    <div class="circle-bg-right" style="background: rgba(17, 202, 160, 0.05);"></div>
                    <h2 style="margin-bottom: 10px;">Partner With Excellence</h2>
                    <div class="divider" style="background-color: #11caa0;"></div>
                    <p style="font-size: 22px; max-width: 800px; font-weight: 500; color: #005088; margin-bottom: 40px; font-family: 'Playfair Display', serif; line-height: 1.6;">
                        "Provide your students with the definitive, life-long edge they deserve—powered by your institutional guidance and our portal ecosystem."
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; text-align: left; max-width: 600px; width: 100%; border-top: 2px solid #f7f1e3; padding-top: 30px;">
                        <div>
                            <p style="font-weight: bold; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #11caa0; margin-bottom: 5px;">Portal Infrastructure</p>
                            <p style="font-size: 14px;">Secured Student CIN Portals<br>Turnkey Study Materials & Mock Testing</p>
                        </div>
                        <div>
                            <p style="font-weight: bold; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; color: #005088; margin-bottom: 5px;">Institutional Inquiry</p>
                            <p style="font-size: 14px; font-weight: 600;">www.marrs.in<br>enquiry@marrs.in</p>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.slides-wrapper -->

       <div class="slide-nav next-nav">
                <button onclick="nextSlide()">❯</button>
            </div>

        </div><!-- /.slides-viewport -->
    </div><!-- /.slides-container -->
</section>
<script>
const viewport = document.querySelector('.slides-viewport');
const wrapper  = document.querySelector('.slides-wrapper');
const slides   = document.querySelectorAll('.slide');
let currentSlide = 0;

function scaleSlides() {
    slides.forEach(slide => {
        const scale = slide.offsetWidth / 1024;
        const inner = slide.querySelector('.slide-inner');
        if (inner) inner.style.transform = `scale(${scale})`;
    });
}

function goToSlide(index) {
    if (index < 0 || index >= slides.length) return;
    currentSlide = index;
    /* scroll the wrapper by translating it — most reliable cross-browser */
    wrapper.style.transition = 'transform 0.5s ease';
    wrapper.style.transform  = `translateX(-${currentSlide * slides[0].offsetWidth}px)`;
}

function nextSlide() { goToSlide(currentSlide + 1); }
function prevSlide()  { goToSlide(currentSlide - 1); }

document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') nextSlide();
    if (e.key === 'ArrowLeft')  prevSlide();
});

window.addEventListener('resize', () => {
    scaleSlides();
    /* re-snap without animation */
    wrapper.style.transition = 'none';
    wrapper.style.transform  = `translateX(-${currentSlide * slides[0].offsetWidth}px)`;
});

window.addEventListener('load', scaleSlides);
scaleSlides();
</script>
<?php include('footertest.php'); ?>

