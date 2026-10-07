<?php include('header1.php');

//include('student_nav.php');
//$pri=$this->session->userdata('cart');
$payid=$session['razorpay_order_id'];
$tid=$session['razorpay_order_id'];
// print_r($cins);
foreach ($student as $row){
    $prid=$row->PRID;
    $name=$row->first_name.' '.$row->middle_name.' '.$row->last_name;
    $school=$row->school_code;
}

                          
?>

<div id="loader">
    <div class="loader-box">
        <div class="loader-spinner">
            <svg viewBox="0 0 50 50">
                <circle class="loader-track" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle>
                <circle class="loader-fill" cx="25" cy="25" r="20" fill="none" stroke-width="4"></circle>
            </svg>
            <div class="loader-icon">₹</div>
        </div>
        <h3 class="loader-title">Processing Payment</h3>
        <p class="loader-subtitle">Please do not refresh or close this window</p>
        <div class="loader-dots">
            <span></span><span></span><span></span>
        </div>
    </div>
</div>

    <div id="content" style="display:none;">
        
    </div>

  
<style>
body{
    background-color:#f4f4f4;font-family: 'Lora', serif;
}

td{
    
    color:#000;  
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:250px;
    margin-right:250px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
.sidebar {
    z-index: 11;
}

#product h1{
       color:black; 
    }
@media (max-width:767px){
    #product h1{
       font-size:15x; 
    }
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    #product{
        width:100%;
    }
    
}

#outer{
    display: flex;
    justify-content: center;
    align-items: center;
    height:50px;
    padding-top:10px;
    color:#333333;
    margin-bottom:20px;
}
#submit{
    width:55%;height:40px;background-color:#ff6600;font-size:20px;
}
#inner{
 
    height:40px;
    border: solid 2px #3385ff;
    border-radius: 30px;
    width: 40%;
    text-align: center;
    position: relative;
    /*left: 27%;*/
}
#inner:hover{
    background:#ff9933;
}
#top{
    padding-top:10px;
    background-color:#fff;
    text-align:center;
    color:green;
}

/* ── Professional Loader ─────────────────────────────── */
#loader {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #f8f9fb;
    margin-top: -50px;
}

.loader-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 40px;
}

.loader-spinner {
    position: relative;
    width: 90px;
    height: 90px;
    margin-bottom: 24px;
}

.loader-spinner svg {
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
}

.loader-track {
    stroke: #e6ecf5;
}

.loader-fill {
    stroke: #3385ff;
    stroke-linecap: round;
    stroke-dasharray: 126;
    stroke-dashoffset: 126;
    animation: loader-spin 1.4s ease-in-out infinite;
}

@keyframes loader-spin {
    0%   { stroke-dashoffset: 126; transform: rotate(0deg); }
    50%  { stroke-dashoffset: 32;  transform: rotate(180deg); }
    100% { stroke-dashoffset: 126; transform: rotate(360deg); }
}

.loader-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 28px;
    font-weight: 700;
    color: #3385ff;
}

.loader-title {
    font-family: 'Lora', serif;
    font-size: 22px;
    color: #1a1a1a;
    margin: 0 0 8px;
}

.loader-subtitle {
    font-size: 14px;
    color: #777;
    margin: 0 0 18px;
}

.loader-dots {
    display: flex;
    gap: 6px;
}

.loader-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #ff6600;
    animation: loader-dot-bounce 1.2s infinite ease-in-out both;
}

.loader-dots span:nth-child(1) { animation-delay: -0.32s; }
.loader-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes loader-dot-bounce {
    0%, 80%, 100% { transform: scale(0.6); opacity: 0.5; }
    40%           { transform: scale(1);   opacity: 1; }
}

@media (max-width: 600px) {
    .loader-title { font-size: 18px; }
    .loader-subtitle { font-size: 13px; padding: 0 20px; }
}
</style>
<body>



<div style='font-size:18px;margin-top:40px;' id='corner'>
    <div class='container-fluid'>
        <div id='top'>
           
                <h2>Payment Successfull</h2>
           
        </div>
        <div class='row'>
            <div class='col-sm-12'>
          
                    <table class="table table-bordered" style=" width:100%;border-left: solid 1px #d9d1d1;">
                      <thead>
                        <tr style="">
                      
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Product Name </th>
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">CIN</th>
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Payment ID</th>                         
                                          
                        </tr>
                        <!--</th>-->
                          
                      </thead>
                      <tbody>
                        <?php foreach($cins as $cins){  ?>
                        <tr >
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php if($cins->product_name=='MaRRS Word Chase NW'){ echo 'MaRRS Word Chase';}else{ echo $cins->product_name;}?></td>
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cins->cin;?></td>
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cins->payment_id;?></td>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                     </table>
            </div>
            <div class='col-sm-12' id='second'>
                <!--<h3>BACK <br>TO PROFILE</h3>-->
                <div class='row'> 
                <div class='col-4'>
                    
                </div>
                <div class='col-4 mb-2'>
                   
                        
                        <a href="https://marrs.in/student_registration/Welcome/registration_log" style='text-decoration:none;' class='btn btn-outline-warning btn-lg'>Profile</a>
                   
                </div>
                <div class='col-4'>
                    
                </div>
                    
                </div>

            </div>
  
    
            </div>
            
        </div>
    </div>
</div>

<div id='pad'></div>
</body>
<style>
#pad{
    padding-top:50px;
    
}
#second{
    margin-top:2%;
    text-align:center;
    color:black;
}
@media only screen and (max-width: 600px) {
  #second{
    margin-bottom:35%;
    }
    #inner{
        width:100%;
    }
    #submit{
        width:80%;
        font-size:20px;
    }
}

</style>
  <script>
        $(document).ready(function() {
            // Show the loader for 3 seconds
            setTimeout(function() {
                $('#loader').fadeOut(500, function() {
                    $('#content').fadeIn(500);
                });
            }, 3000);
        });
    </script>

<?php include("footer.php");?>