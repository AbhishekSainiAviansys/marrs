
<?php include('header1.php'); 
// print_r($student);
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    a{
        text-decoration:none;
        color:#ffffff;
    }
    .card {
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
      /*border-radius: 10px;*/
      widh:100%;
    }
    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .card-body {
      padding: 20px;
    }
    .card-title {
      font-size: 1.5rem;
      margin-bottom: 10px;
    }
    .card-text {
      font-size: 1rem;
      color: #555;
    }
    .alert {
      display: none;
    }
    .basket {
      position: fixed;
      bottom: 80px;
      right: 80px;
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      cursor: pointer;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    .basket span {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 0.8rem;
    }
    /* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
  position: relative;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Basket Icon Styles */
.basket {
  position: relative;
  cursor: pointer;
}

.basket i {
  font-size: 24px;
}

#cart-count {
  position: absolute;
  top: -10px;
  right: -10px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 4px 8px;
  font-size: 12px;
}
#myBtn {
    position: fixed;
    bottom: 385px;
    float: right;
    right: 12.5%;
    left: 87.5%;
    max-width: 90px;
    width: 80%;
    font-size: 16px;
    border-color: #ffc107;
    background-color: rgb(241 233 233 / 54%);
    padding: 12px;
    border-radius: 50%;
}
.card-body {
    padding: 20px;
    text-align: left;
}

@media screen and (max-width: 480px) {
  #myBtn {
    position: fixed;
    bottom: 120px;
    float: right;
    right: 20.5%;
    left: 70.5%;
    max-width: 90px;
    width: 80%;
    font-size: 16px;
    border-color: #ffc107;
    background-color: rgb(241 233 233 / 54%);
    padding: 12px;
    border-radius: 50%;
}
}
/*On Hover Color Change*/
    #myBtn:hover {
        background-color: #7dbbf1;
    }
 
 .sidee{
     /*align-items: center;*/
    justify-content: space-between;
     
 }
 
  </style>
<div class='container mb-5'>
    
           
            
    <div class='row'>
        <div class='col-lg-4 col-sm-6 col-md-6'>
            <div class="card text-center mt-5">
                <div class="card-header d-flex sidee">
                    <h5>Profile</h5>
                    <button class='btn btn-warning '><a href='<?php echo base_url(); ?>welcome/chlid_form' target=''>Register Siblings</a></button>
                
                </div>
                <div class="card-body">
                    
                    <h5 class="card-title" ><b>Name: </b><?php echo $student->first_name.' '.$student->middle_name.' '.$student->last_name ?></h5>
                    <!--<p class='card-text'><b>Login ID: </b><?php echo $student->PRID; ?></p>-->
                    <p class="card-text"><b>Class: </b><?php echo $student->class; ?><br><b>School:</b> 
                    <?php
                        $school= $this->db->get_where('school_new',array('id'=>$student->school_id))->row();
                        echo $school->school_name;
                    ?>
                    </p>
                    
                </div>
                <form method="POST">
                    <button class="btn btn-outline-warning btn-sm product-button" name='Edit' type='submit'>Profile Edit</button>
                    </form>
                
            </div>
        </div>
                
        <div class='col-lg-8 col-sm-4 col-md-4'>
               <div class="alert alert-success" id="success-alert">Successfully added!</div>
                <div class="alert alert-danger" id="error-alert">Product removed!</div>

            <div class='col-12 mt-5 '>
            <div class="card text-center">
                <div class="card-header sidee d-flex">
                    <div>
                        <h4>
                        Product List
                    </h4>
                    </div>
                    <div>
                        <?php 
                        $price= $this->db->get_where('product_purchase',array('prid'=>$student->PRID))->row();
                        if(!empty($price)){       
                        ?>
                        
                        <form action='<?php base_url(); ?>/student_registration/welcome/api_invoice'>
                        <button name='invoive'  class='btn btn-warning' >Invoice</button>
                        <?php } ?>
                    </form>
                    </div>
                    
                    
                        
                </div>
                
                <div class="card-body table-responsive">
                    <!--<h5 class="card-title" ><?php echo $student->first_name.' '.$student->middle_name.' '.$student->last_name ?></h5>-->
                     <?php
                    if(!empty($product_list)){ 
                    ?>
                    <table class='table'>
                        <thead>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Cart (Add/Remove)</th>
                        </thead>
                        <tboady>
                           <?php
                        //   print_r($product_list);
                            foreach($product_list as $row){ 
                                // print_r($row);
                                $price= $this->db->get_where('product_purchase',array('product_name'=>$row,'prid'=>$student->PRID,'who'=>'0'))->row();
                                // echo $this->db->last_query();
                                //  print_r($price);die;
                                        if(empty($price)){
                                            // echo 'ok';
                                        ?>
                                        <tr>
                                            <td><?php  if($row=='MaRRS Word Chase NW'){ echo 'MaRRS Word Chase';}else{ echo $row;} ?></td>
                                            <td>Rs. 
                                                <?php 
                                                    $price= $this->db->get_where('product_to_school',array('product_name'=>$row,'school_id'=>$student->school_id,'period_id'=>$student->period_id))->row();
                                                    
                                                    // print_r($price);
                                                    echo $price->amount;
                                                ?>
                                            </td>
                                            <td class='text-center'>
                                                <button class="btn btn-outline-primary btn-sm product-button" value='<?php echo $price->amount.'+'.$row; ?>' style='width:50%;'>Add to Cart</button>
                                            </td>
                                        </tr>
                                        <?php
                            
                                    }else{  ?>
                                    
                                            <tr>
                                            <td><?php if($row=='MaRRS Word Chase NW'){ echo 'MaRRS Word Chase';}else{ echo $row;} ?></td>
                                            <td>Rs. 
                                                <?php 
                                                // print_R($price);
                                                    // $price= $this->db->get_where('product_to_school',array('product_name'=>$row,'school_id'=>$student->school_id,'period_id'=>'14'))->row();
                                                    echo $price->amount;
                                                ?>
                                            </td>
                                            <td class='text-center'>CIN <br>
                                                <p><?php echo $price->cin; ?></p> 
                                                <p style='font-size:10px;'>Register a sibling <a href="<?php echo base_url(); ?>welcome/chlid_form"><span class='text-danger'>Click Here</span></a></p>
                                            </td>
                                        </tr>
                                    
                                    <?php
                                    }
                                }
                            ?>
                            

                        </tboady>
                    </table>
                    <?php }else{ echo 'No Products assigned to school, contact school.'; }?>
                </div>
                
            </div>
        </div>
            
        </div>
    </div>
</div>

<?php if(!empty($product_list)) { ?>
<button id="myBtn" onclick="document.getElementById('id01').style.display='block'"><a style="color: white"  style="width:auto;"><span id="cart-count" class="text-black">0</span><span class="text-black fw-bold">Buy Now</span>
<!--<br><i class="fa fa-shopping-cart" style="font-size:10px;color:yellow"></i>-->
</a></button>

<?php }else{ echo '';} ?>


<div id="id01" class="modal">
    <div class="modal-content animate">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container" id="cart-products">
            
        </div>
        <div class="container mt-2" style="background-color:#ffffff">
            <p><strong>Total Amount:</strong> Rs. <span id="total-amount">0</span></p>
            <!--<button type="button" id="checkout-button" style="display: none;" class='btn btn-primary '>Pay Now</button>-->
            <button type="button" id="checkout-button" style="display: none;" class='btn btn-primary'>Pay Now</button>

            <form id="payment-form" method="POST" action="<?php echo base_url('Razorpay/pay3'); ?>" style="display: none;">
                <input type="hidden" name="prid" value="<?php echo $student->PRID; ?>">
                <input type="hidden" name="contact" value="<?php echo $student->mobile; ?>">
                <input type="hidden" name="email" value="<?php echo $student->email; ?>">
            </form>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.product-button').on('click', function() {
        var value = $(this).val();

        $.ajax({
            url: '<?php echo base_url("/welcome/add_rem"); ?>',
            type: 'POST',
            data: { value: value },
            success: function(response) {
                 $('#cart-count').text(response.trim());
            },
            
        });
    });

    $('#checkout-button').on('click', function() {
        $('#payment-form').submit();
    });

    var modal = document.getElementById('id01');

    $('#myBtn').on('click', function() {
        $.ajax({
            url: '<?php echo base_url("/welcome/get_cart"); ?>',
            type: 'GET',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayCartData(cartData);
                document.getElementById('id01').style.display = 'block';
            },
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });

    function displayCartData(cartData) {
        var cartProductsDiv = document.getElementById('cart-products');
        var totalAmount = 0;
        cartProductsDiv.innerHTML = ''; // Clear any existing content

        if (cartData.length === 0) {
            cartProductsDiv.innerHTML = '<p>Your cart is empty.</p>';
            $('#checkout-button').hide(); // Hide the checkout button
        } else {
            var tableHtml = `
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            cartData.forEach(function(product) {
                tableHtml += `
                    <tr>
                        <td>${product.product}</td>
                        <td>Rs. ${product.amount}</td>
                    </tr>
                `;
                totalAmount += parseFloat(product.amount);
            });
            tableHtml += `
                    </tbody>
                </table>
            `;
            cartProductsDiv.innerHTML = tableHtml;
            $('#total-amount').text(totalAmount.toFixed(2));
            $('#checkout-button').show(); // Show the checkout button if there are items in the cart
        }
    }
});

</script>



<?php include('footer.php'); ?>