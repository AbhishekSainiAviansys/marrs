<?php
include('header.php');

?>

<?php
// print_r($name);die;
$productinfo = "MaRRS Registration";
$txnid = time();
$surl = $surl;
$furl = $furl;        
$key_id = 'rzp_live_UMziCF38129HCi';
$currency_code = $currency_code;  
// $amount =1000; 
 $total = ($amount* 100); 
$total1=$amount;

$merchant_order_id =' '.uniqid('order_');
 
$card_holder_name = ' ';
// $email ='abhisheksaini.iimt@gmail.com';
// $phone = '8630172681';
// $name ='Abhishek';
$return_url = base_url().'welcome/callback';
?>
<div class="row">
    <div class="col-lg-12">
        <?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>
 <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total1;?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
</form>
    <div class="row" style="margin: 40px;">   
     <div class="col-lg-3">   </div>
      <div class="col-lg-6" style="margin:40px;    border: 3px solid red;">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" style="padding:10px">  
         <level style="color:#000">Name</level>
           <input type="text" class="form-control" value="<?php echo $name;?>">
             
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"  style="padding:10px">  
        <level style="color:#000">Email</level>
           <input type="text" class="form-control" value="<?php echo $email;?>">
             
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"  style="padding:10px">
            <level style="color:#000">Mobile</level>                         
           <input type="text" class="form-control" value="<?php echo $mobile;?>">
             
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12"  style="padding:10px">
            <level style="color:#000">Amount</level>                        
           <input type="text" class="form-control" value=" ₹
 <?php echo $total1;?>">
             
        </div>
       
        <div class="col-lg-6" style="padding:10px">
           <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" style="margin-top: 30px;
    width: 100%;
    margin-bottom: 30px;">
        </div>
         </div>
    </div>

   


<?php
//include('footer.php');
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order_id  <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $mobile; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>

