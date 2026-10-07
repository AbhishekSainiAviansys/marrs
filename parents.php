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
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .gallery-item img {
            width: 100%;
            height: auto;
        }
    </style>

<section class="text-center my-5">
  <div class="container'">
       <a href="/signin?tab=register">
           <img class="img-fluid" src="/newassets/slide1293x593_6.jpg" >
        </a>
  </div>
 
</section>
<?php include('footertest.php'); ?>

