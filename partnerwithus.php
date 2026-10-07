<?php include('headertest.php'); ?>

<style>

/* ---------- GENERAL ---------- */

h2 {
    font-weight: 700;
    color: #f57c35;
}

/* ---------- HERO ---------- */
.hero-banner img {
    border-radius: 16px;
}

/* ---------- SLIDER ---------- */
.slider {
    position: relative;
    overflow-x: hidden;
    width: 100%;
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

/* Each slide (row of 3 cards) */
.slide {
    min-width: 100%;
    display: flex;
    justify-content: center;
    gap: 25px;
}

/* ---------- CARD DESIGN ---------- */
.product-card {
    flex: 1;
    max-width: 30%;
    background: #fff;
    border-radius: 18px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* IMAGE FIX */
.product-card img {
    width: 100%;
    height: 140px;
    object-fit: contain;
    margin-bottom: 15px;
}

/* TITLE */
.product-card h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 12px;
    color: #fa2a08;
}

/* BUTTON */
.explore-btn {
    display: inline-block;
    padding: 10px 22px;
    border-radius: 30px;
    background: linear-gradient(135deg, #ff7a18, #ffb347);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    letter-spacing: 0.5px;
    box-shadow: 0 6px 18px rgba(255, 122, 24, 0.4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

/* Hover effect */
.explore-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 122, 24, 0.6);
    color: #fff;
}

/* Click effect */
.explore-btn:active {
    transform: scale(0.96);
}

/* Shine animation */
.explore-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: 0.5s;
}

.explore-btn:hover::before {
    left: 100%;
}

/* ---------- SLIDER BUTTONS ---------- */
.prev, .next {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    width: 45px;
    height: 45px;
    background: #fff;
    color: #333;
    border-radius: 50%;
    border: none;
    font-size: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: 0.3s;
}

.prev:hover, .next:hover {
    background: #eb1736;
    color: #fff;
}

.prev { left: 10px; }
.next { right: 10px; }

/* ---------- MOBILE ---------- */
@media only screen and (max-width: 768px) {

    .slide {
        flex-direction: column;
        align-items: center;
    }

    .product-card {
        max-width: 90%;
    }
}

</style>

<!-- HERO -->
<section class="my-5 hero-banner text-center">
    <div class="container">
        <img src="/newassets/slide1293x593_3.jpg" class="img-fluid w-100">
    </div>
</section>



<!-- LEARNING PROGRAMS -->
<!--<section class="section-padding mt-5">-->
<!--    <div class="container text-center">-->
<!--        <h2 class="mb-5">MaRRS Learning Programs</h2>-->

<!--        <div class="slider my-5">-->
<!--            <div class="slides">-->

                <!-- Slide 1 -->
<!--                <div class="slide">-->
<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/Youngwriterslibrary.jpg">-->
<!--                        <h4>Young Writers</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/SIP-logo.jpg">-->
<!--                        <h4>Science in Practice</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/ILPS-logo.jpg">-->
<!--                        <h4>ILPS Program</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->
<!--                </div>-->

                <!-- Slide 2 -->
<!--                <div class="slide">-->
<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/adoreme.jpg">-->
<!--                        <h4>Adore Me</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/bye.jpg">-->
<!--                        <h4>Bye Program</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/kinder.jpg">-->
<!--                        <h4>Kinder Program</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->
<!--                </div>-->

                <!-- Slide 3 -->
<!--                <div class="slide">-->
<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/infantasy.jpg">-->
<!--                        <h4>Infantasy</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/englisg-club.jpg">-->
<!--                        <h4>English Club</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->

<!--                    <div class="product-card">-->
<!--                        <img src="https://marrs.in/newassets/infantasy-preschools.jpg">-->
<!--                        <h4>Infantasy Preschool</h4>-->
<!--                        <a href="#" class="explore-btn">Explore</a>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->

<!--            <button class="prev">&#10094;</button>-->
<!--            <button class="next">&#10095;</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

 <script>
// document.querySelectorAll('.slider').forEach(slider => {

//     const slides = slider.querySelector('.slides');
//     const slideItems = slider.querySelectorAll('.slide');
//     const prev = slider.querySelector('.prev');
//     const next = slider.querySelector('.next');

//     let index = 0;

//     function showSlide(i) {
//         index = (i + slideItems.length) % slideItems.length;
//         slides.style.transform = `translateX(-${index * 100}%)`;
//     }

//     prev.addEventListener('click', () => showSlide(index - 1));
//     next.addEventListener('click', () => showSlide(index + 1));

//     /* AUTO SLIDE */
//     setInterval(() => {
//         showSlide(index + 1);
//     }, 4000);
// });
 </script>

<?php include('footertest.php'); ?>