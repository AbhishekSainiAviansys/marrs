<?php $this->load->view('header.php');
  $data2 = $this->session->userdata('cin'); 

?>

       <body>          
                <!-- ==========================  souravv  =========================== -->
    <section>
       
        
        <div class="container-fluid " style=" overflow:hidden;">
            <div class="row" style="margin:5% 10%;" id="student_login">  
               <div class="col-12">
                 <!--<div class="card my-2">-->
                 <!--    <div class="card-body p-0">-->
                    <div class="row">
                             <div class="col-sm-12 col-md-12 col-lg-7" style="background:#1365b5;padding:2%;">
                                 <h1 class="text-start text-white my-2">Because First Steps Last!</h1>   
                                 <p class="text-center my-4 mb-4" style="font-size:32px;    font-family: 'Source Serif Pro', serif;padding-top: 40px;">The healthy competitive spirit motivates the students to learn on their own without any compulsion.</p>
                                 <!--<p style="color: orange;font-size:20px">First time users enter the "Access Code" Or "Email ID".</p><p style="    color: orange;font-size:20px"> Registered users can login <br/> using either the "PRID" Or "CIN" Or "Email ID"</p>   -->

                             </div>
                            <div class="col-sm-12 col-md-12 col-lg-5" style="background:#FFFF;padding:2%;">
                            <img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-user-essential-collection-bearicons-gradient-bearicons.png" class="my-2" c/>                        
                             <div class="row">
                                     <div class="col-sm-12 col-md-12 col-lg-6" >
                                        <h5 class="text-end" style="padding-right:15px"><span style="color:blue">Login</span></h5>
                                        <h5 class="text-end"><span style="font-size:14px;padding-right:15px" >using any of the below:</span>	</h5>
                                        <ul style="margin-left:110px;padding-right:15px" class="text-end">
                                            <li>PRID</li>
                                            <li>CIN</li>
                                            <li>Email ID</li>
                                            </ul>
                                     </div>
                                    <div class="col-sm-12 col-md-12 col-lg-1" style="border-left: 4px solid #dc3545;"></div>
                                    <div class="col-sm-12 col-md-12 col-lg-5" style="margin-left: -24px;">
                                        
                                        <h5> <span style="color:#dc3545">Register</span> </h5><h5><span style="font-size:14px">for the first time using :</span></h5>
                                        <ul style="margin-left:-15px">
                                            <li>ACCESS CODE</li>
                                            <li>Email ID</li>
                                            </ul>
                                    </div>
                                </div>
                           
                                <form class=" text-left p-2" method='post' >
                                        <div class="mb-3" style='text-align:center;'>
                                              
                                           
											 <?php  if(!empty($email)) { ?>
											 <input type="text" name="code" value="<?php echo $email;?>" class="form-control" id="cin" placeholder="Enter CODE">
											 <?php }else{ ?>
											 
											  <input type="text" name="code" value="<?php if(!empty($data)){ echo $data;}else{ echo $data2; } ?>" class="form-control" id="cin" placeholder="Enter CODE">
											 <?php }?>
                                        </div>
                                        <?php  if(!empty($data)) { ?>
                                        <div class="mb-4" style='text-align:center;'>
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="cin" placeholder="Enter Password">
                                        </div>
                                        <?php }elseif(!empty($email)){ ?>
                                           
										   <div class="mb-4" style='text-align:center;'>
                                            <label for="password" class="form-label">OTP</label>
                                            <input type="password" name="otp" class="form-control" id="cin" placeholder="Enter OTP sent on your email">
                                        </div>
                                        <div style="padding-left: 60px;padding-bottom: 10px;margin-top: -10px;">
                                        <h6 ><span id="timer" style="color: blue;float: right;padding-right: 70px;position: relative;top: -44px;"></span> 
                                        <span class="resend" style="padding-left: 10px;color:blue;cursor:pointer;float:right;padding-right: 70px;padding-bottom: 10px;;">Resend Otp </span></h6></div>
                                        <script>
        $(document).ready(function() {
              $(".resend").css('display','none');
            // Set the target time to 1 minute from now
            var targetTime = new Date().getTime() + 60000; // 60 seconds * 1000 milliseconds

            // Update the timer every second
            var timerInterval = setInterval(function() {
                var currentTime = new Date().getTime();
                var remainingTime = targetTime - currentTime;

                if (remainingTime <= 0) {
                    clearInterval(timerInterval); 
                    $("#timer").text("0:00"); 
                } else {
                    
                    var minutes = Math.floor(remainingTime / 60000);
                    var seconds = Math.floor((remainingTime % 60000) / 1000);

                    if (seconds < 10) {
                        seconds = "0" + seconds;
                    }
                    $("#timer").text(minutes + ":" + seconds);
                }
            }, 1000); 
             setTimeout(function() {
                $(".resend").css("display",'block');
                $("#timer").css("display",'none');
            }, 60000);
            
            
               $(".resend").click(function() {
               var email = '<?php echo $this->session->userdata("email");?>';
    //alert(id);
              $.ajax({
              url:"<?php echo base_url();?>"+"/welcome/resendotp/",
              type: 'post',
              data:{email:email}, 
           
             success:function(result)
			 {
			
                // $("#category").html(result);
             }});
            });
            
            
            
        });
        
    </script>
										  <?php }elseif(!empty($data2)){ ?> 
<div class="mb-4" style='text-align:center;'>
                                              <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="cin" placeholder="Enter Password">
                                        </div>
										   
										   
										  <?php } ?> 
                                        <?php 
                                              if(!empty($this->session->flashdata('schoolerror'))){
                                                ?> <div class="mb-4 text-center text-danger"><?php 
                                                  echo $this->session->flashdata('schoolerror');
                                                    ?></div><?php
                                                    }
                                                                   
                                                      ?>
                                        
                                             <?php 
                                              if(!empty($this->session->flashdata('otperror'))){
                                                ?> <div class="mb-4 text-center text-danger"><?php 
                                                  echo $this->session->flashdata('otperror');
                                                    ?></div><?php
                                                    }
                                                                   
                                                      ?>
                                        <div class="mb-5">
                                            <button type="submit" name="submit" class="btn btn-danger w-80 btn-lg" id='cin'>Login</button>
                                        </div>
                                        <div style='width:1px;border:none;'>
                                        <!--<button type="submit" name="z" id='cin'>z</button></div>-->
                                </form>
                                        
                            </div>
                </div>
                </div>
                <!--   </div>-->
                <!--</div>-->
               </div>
               </div>
        
      
    </section>
 
  
  <script type="text/javascript" src="<?php echo base_url();?>public/common/mdb.min.js"></script>
 <footer style="padding: 1%;
    background-color: #005580;
    color: #ffff">
      <div class="container">
        <div class="row" id="footerContent">
          <div class="col-sm-12 col-md-12 col-lg-12  text-center">
               <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in" >Home</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/about.php" >About Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/contact.php" >Contact Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/refund_cancellation.php" >Refund Policy</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/terms_conditions.php" >Terms & Conditions</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/privacy.php" >Privacy</a>
          </div>
          
        </div>
      </div>
    </footer>
    <section class="p-3" style="background: linear-gradient( to bottom, rgba(1, 44, 85, 1) 0%, rgba(0, 28, 57, 1) 100% );">
    <div class="container">
        <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 text-center"> <a class="p-2 text-white" style="text-decoration:none;" href='#' >© Aviansys Technology Pvt. Ltd. 2022-2023 </a></div>
        </div>
    </div>
    </section>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
    </html>