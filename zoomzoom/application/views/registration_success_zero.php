<?php include('header.php');
error_reporting(E_ALL ^ E_NOTICE);  
?>



<section>
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
            <div class="card text-center my-5" id="content" >
            <div class="card-body" style="padding:80px"> 
                <i class="fa fa-check-circle" aria-hidden="true" mb-3" style="color:green;font-size:70px;"></i>
                <h2 class="card-title mb-3" style="color:green;">Registration Successful</h2>
               
                        <p style="font-size:16px">Hello, congratulations  for successfully registering on the  marrs.in portal.</p>
                        
                  
                        <p style="font-size:16px"> Your Participant Registration ID (PRID) is  <?php echo $prid; ?></p>
                    
                  <div>
                    
                    
                    <a style="font-size:18px" href="<?php echo base_url();?>welcome/product_purchase/id/<?php  echo $this->session->userdata('prid');?>" class="btn btn-danger">Back to Products</a>
                   
                </div>
                
            </div>
            </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php");?>