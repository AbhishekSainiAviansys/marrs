<style>.p-2 {
    padding: 0.5rem!important; 
}
.text-white {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb),var(--bs-text-opacity))!important;
}

  
  /*#footerContent {*/
  /*  bottom: 0;*/
  /*  width: 100%;*/
  /*  position: absolute;*/
  /*  height: $height-footer;*/
    
  /*}*/

</style>
<footer id="footerContent" >
    <div class="container-fluid p-3" style="padding: 1% 0%;
    background-color: #005580;
    color: #ffff">
    <duv class="row" >
          <div class="col-sm-12 col-md-12 col-lg-12  text-center">
               <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in">Home</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/about.php">About Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/contact.php">Contact Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/refund_cancellation.php">Refund Policy</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/terms_conditions.php">Terms &amp; Conditions</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/privacy.php">Privacy</a>
          </div>
          
        </div>
      </div>
    <div class="container-fluid p-3" style="background: linear-gradient( to bottom, rgba(1, 44, 85, 1) 0%, rgba(0, 28, 57, 1) 100% );">
        <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 text-center"> <a class="p-2 " style="text-decoration:none;color: #fff;" href="#">© Aviansys Technology Pvt. Ltd. <?php 
$current_year = date('Y'); 
$previous_year = $current_year - 1; 
echo  $previous_year .'-'. $current_year; 
?>
 </a></div>
        </div>
    </div>
    </footer>
