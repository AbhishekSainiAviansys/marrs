<?php include('header.php');
//include('student_nav.php');
$pri=$this->db->get_where('new_cart',array('cin'=>$cin))->row();
//print_r($data);exit;
$payid=$session['razorpay_order_id'];
$tid=$session['razorpay_order_id'];

?>



<section>
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
            <div class="card text-center my-5" id="content" >
            <div class="card-body">
                <i class="fa-regular fa-circle-check text-success mb-3" style="font-size:70px;"></i>
                <h5 class="card-title mb-3">Payment Successful</h5>
                <table class="table table-borderless mx-auto w-50 mb-5 text-start">
                <thead>
                    <tr>
                    <th scope="col">Payment</th>
                    <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>CIN</td>
                    <td><?php echo $cin;?></td>
                    </tr>
                    <tr>
                    <td>Payment ID</td>
                    <td><?php echo $pri->razorpay_payment_id; ?></td>
                    </tr>
                    <tr>
                    <td>Transaction ID</td>
                    <td><?php echo $pri->razorpay_payment_id; ?></td>   
                    </tr>
                </tbody>
                </table>
                <a href="<?php echo base_url();?>Cin_login" class="btn btn-outline-danger"> BACK To DOWNLOAD </a>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php");?>




























<?php include('header.php');
//include('student_nav.php');
//$pri=$this->session->userdata('cart');
$payid=$session['razorpay_order_id'];
$tid=$session['razorpay_order_id'];
error_reporting(E_ALL ^ E_NOTICE);
?>



<section>
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
            <div class="card text-center my-5" id="content" >
            <div class="card-body">
                <i class="fa-regular fa-circle-check text-success mb-3" style="font-size:70px;"></i>
                <h5 class="card-title mb-3">Payment Successful</h5>
                <table class="table table-borderless mx-auto w-50 mb-5 text-start">
                <thead>
                    <tr>
                    <th scope="col">Payment</th>
                    <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>PRID</td>
                    <td><?php echo $session['prid'];?></td>
                    </tr>
                    <tr>
                    <td>Payment ID</td>
                    <td><?php echo $payid; ?></td>
                    </tr>
                    <tr>
                    <td>Transaction ID</td>
                    <td><?php echo $tid; ?></td>
                    </tr>
                </tbody>
                </table>
                <a href="<?php echo base_url();?>zoomzoom/products/" class="btn btn-outline-danger"> BACK To DOWNLOAD </a>
            </div>
            </div>
            </div>
        </div>
    </div>
</section>



<?php include("footer.php");?>




























