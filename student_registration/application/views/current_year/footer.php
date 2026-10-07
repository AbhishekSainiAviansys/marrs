
<style>
.main-footer {
  background: #ffffff;
  padding: 20px 30px;
  border-top: 2px solid #f57c35;
  box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
}

/* Keep content above background */
.footer-row,
.footer-logo,
.footer-links {
  position: relative;
  z-index: 1;
}

.footer-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
}

/* Logo */
.footer-logo img {
  height: 35px;
}

/* Links */
.footer-links {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
}

.footer-links a {
  color: #f57c35; /* ORANGE TEXT */
  font-size: 13px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

/* Hover effect */
.footer-links a:hover {
  color: #d65a1f;
  text-decoration: underline;
}

/* Divider */
.divider {
  color: #f57c35;
  opacity: 0.4;
}
</style>
<footer class="main-footer">
  <div class="footer-row">

    <!-- Logo -->
    <div class="footer-logo">
      <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
    </div>

    <!-- Links -->
    <div class="footer-links">
      <!--<a href="#">How it Works</a>-->
      <!--<a href="/faq">FAQ</a>-->
      <!--<a href="/testimonials">News & Testimonials</a>-->
      <!--<a href="/gallery">Gallery</a>-->
      <a href="https://marrs.in/about.php">About</a>
      <a href="https://marrs.in/contact_marrs.php">Contact</a>
      <!--<span class="divider">|</span>-->
      <!--<a href="/terms_conditions">Terms & Conditions</a>-->
      <!--<a href="/privacy">Privacy Policy</a>-->
      <!--<a href="//refund_cancellation">Refund Policy</a>-->
      
    </div>

  </div>
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
         <script>
        $("#edit_guard").click(function() {
        $("input.guardetail,textarea.guardetail").attr('disabled', !$("input.guardetail,textarea.guardetail").attr('disabled'));
        });
        </script>
        <script>
        $("#edit_school").click(function() {
        $("input.schooldetail,textarea.schooldetail").attr('disabled', !$("input.schooldetail,textarea.schooldetail").attr('disabled'));
        });
    </script>
    
    </body>
    </html>
