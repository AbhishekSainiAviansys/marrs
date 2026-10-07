  <!-- Footer / Terms banner -->
      <div class="footer-banner">
         <div class="container d-flex justify-content-between align-items-center footer-links" style="max-width:1100px;">
            <div>
               <span><i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-square-instagram"></i><i class="fa-brands fa-linkedin"></i><i class="fa-brands fa-youtube"></i></span>
               <strong style="color:#000;padding-left: 20px;">MaRRS Rediscover</strong> :<a href="">© Aviansys Technology Pvt. Ltd. 2025-2026</a>
            </div>
            <div>
               <a href="#">Terms & Conditions</a> |
               <a href="#">Privacy Policy</a> |
               <a href="#">Contact</a>
            </div>
         </div>
      </div>
      <script>
         // ✅ Handle multiple sliders independently
          document.querySelectorAll('.slider').forEach(slider => {
            const slides = slider.querySelector('.slides');
            const slideItems = slider.querySelectorAll('.slide');
            const prev = slider.querySelector('.prev');
            const next = slider.querySelector('.next');
         
            let index = 0;
         
            function showSlide(i) {
              index = (i + slideItems.length) % slideItems.length;
              slides.style.transform = `translateX(-${index * 100}%)`;
            }
         
            prev.addEventListener('click', () => showSlide(index - 1));
            next.addEventListener('click', () => showSlide(index + 1));
          });
      </script>
      
   </body>
</html>
