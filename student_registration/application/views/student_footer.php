<style>
.main-footer {
  background: #ffffff;
  padding: 20px 30px;
  border-top: 3px solid #005580;
  box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
}

/* Layout */
.footer-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
}

/* Logo */
.footer-logo img {
  height: 40px;
}

/* Links */
.footer-links {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}

/* Link style */
.footer-links a {
  color: #005580;
  font-size: 14px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

/* Hover */
.footer-links a:hover {
  color: #003d5c;
  text-decoration: underline;
}
</style>

<footer class="main-footer">

  <div class="container">
    <div class="footer-row">

      <!-- Logo -->
      <div class="footer-logo">
        <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
      </div>

      <!-- Links -->
      <div class="footer-links">
        <a href="https://marrs.in">Home</a>
        <a href="https://marrs.in/about.php">About Us</a>
        <a href="https://marrs.in/contact.php">Contact Us</a>
      </div>

    </div>
  </div>

</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>