<?php include('header.php');
error_reporting(E_ALL ^ E_NOTICE);  
?>



<section>
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
            <div class="card text-center my-5" id="content" >
            <div class="card-body">
                <i class="fa-regular fa-circle-check text-success mb-3" style="font-size:70px;"></i>
                <h5 class="card-title mb-3">Registration Successful</h5>
                <table class="table table-borderless mx-auto mb-5 text-center">
                <thead>
                    <tr>
                        <th scope="col">Hello, congratulations <?php echo $name; ?> for successfully registering on the  marrs.in portal.
                        <br>Your Participant Registration ID (PRID) is  <?php echo $id; ?>
                    </th>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PRID is not a proof for payment or having registered for any activity.</td>
                    </tr>
                    <tr>
                        <td>You can now pay and enroll for any competition or training after <strong>logging on to the marrs.in portal using the PRID as username and password.</strong><br> You can also buy learning material for any MaRRS activity.</td>
                    </tr>
                    <tr>
                        <td>Once you pay and register for MaRRS competition you will be issued a Candidate Identification Number (CIN). You will be able to download any learning material immediately on its purchase. Please ensure that you download Registration Slips when you enlist for Orientation or Mock Tests.</td>
                    </tr>
                    
                </tbody>
                </table>
                <div>
                    
                    <form method='POST'>
                    <button type='submit' name='submit' class="btn btn-outline-danger">Log In</button>
                    </form>
                </div>
                
            </div>
            </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php");?>