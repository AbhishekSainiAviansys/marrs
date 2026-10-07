<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Marrs CIN Login </title>
  <!-- MDB icon -->
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
   <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://marrs.in/student_registration/custom.css" />
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700);

body {
  /*background: #999;*/
  /*background:linear-gradient(to top right, #0066ff 0%, #ff99cc 100%);*/
  background-color: #A9C9FF;
background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);

  /*background: url(https://marrs.in/student_registration/images/int_logo.png) no-repeat center center fixed;*/
  /*background: url(https://marrs.in/student_registration/images/int_logo.png) no-repeat center center fixed;*/
  /*padding-top: 20px;*/
  font-family: "Open Sans Condensed", sans-serif;
  overflow:hidden;
}

#bg {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  /*background: url(https://marrs.in/student_registration/images/int_logo.png) no-repeat center center fixed;*/
  background-size: cover;
  -webkit-filter: blur(4px); 
  background-size: cover;
  background-repeat: no-repeat;
  background-size: cover;
  z-index:-111111;
}

#head{
    text-align:center;
    color:#fff;
    
    
}
#form{
    padding-top:20px;
    border: 2px solid #fff;
    border-radius: 25px;
     box-shadow: 5px 10px 18px #fff;
}
#pad{
    padding-top:30px;
}
label{
    font-size:15px;
}
#student_login img{
    width:80px;
    height:auto;
        background: whitesmoke;
    border-radius: 50px;
    display: block;
    margin: auto;
}

#cin{
    border-radius:25px;
    width:70%;
    margin-left:15%;
    /*margin-right:50%;*/
}
.previous {
  background-color: #f1f1f1;
  color: black;
}
a {
  text-decoration: none;
  display: inline-block;
  padding: 8px 16px;
}

a:hover {
  background-color: #ddd;
  color: black;
}
.notification {
            display: none; /* Initially hide the notification */
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
</style>
           
            
            
                <!-- ==========================  souravv  =========================== -->
    <section>
        <!--<a href='https://marrs.in/student_registration/zoomzoom/zoomzoom_register'>Z</a>-->
        <!--<a href='https://marrs.in/student_registration/zoomzoom/'>R</a>-->
        <?php 
            // if(!empty($this->session->flashdata('otpdelay'))){
            ?> 
            
            <!--<div id='otp-notification' class="mb-4 notification text-center text-success">-->
            <?php 
            //   echo $this->session->flashdata('otpdelay');
                ?>
                <!--</div>-->
                <?php
             //   }
                               
                  ?> 
        
        <div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh; overflow:hidden;">
           
            <div class="row" id="student_login">
                <div class="col-sm-12">
                <div class="card mx-3 p-2" style="width: 27rem;">
                <a href="https://www.marrs.in/" class="btn w-25 btn-sm text-secondary"><i class="fa-solid fa-circle-chevron-left me-2 text-secondary" style="font-size: 16px;"></i>HOME</a>  
                <img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-user-essential-collection-bearicons-gradient-bearicons.png"/>                        
                <h3 class="card-title text-center my-1" style="font-size: 1.5rem;">STUDENT REGISTRATION</h3>
                <h4 class="card-title text-center my-2" style="font-size: 1.2rem;">CURRENT YEAR REGISTRATION 2024-25 </h4>       
                        <form class=" text-left p-2" method='post' >
                            <div class="mb-3" style='text-align:center;'>
                                <label for="cin" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="cin" placeholder="Enter email" value="<?php echo $email;?>">
                            </div>
                            <?php if(!empty($email)){  ?>
                            <div class="mb-4" style='text-align:center;'>
                                <label for="password" class="form-label">OTP</label>
                                <input type="password" name="otp" class="form-control" id="cin" placeholder="Enter OTP sent on your email">
                            </div>
                                                        
                              <?php }?>  
                              
                               <?php 
                                              if(!empty($this->session->flashdata('otperror'))){
                                                ?> <div class="mb-4 text-center text-danger"><?php 
                                                  echo $this->session->flashdata('otperror');
                                                    ?></div><?php
                                                    }
                                                                   
                                                      ?>
                            <div class="mb-3">
                                <button type="submit" name="submit" value="submit" class="btn btn-danger w-80 btn-lg" id='cin'>Register</button>
                            </div>
                            <!--<div style='width:1px;border:none;'>-->
                            <!--<button type="submit" name="z" id='cin'>z</button></div>-->
                            
                        </form>
                            
                      </div>
                </div>
               </div>
            </div>
      </div>
    </section>
  
  
  
  
  
  
  
  
  
  
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if the notification exists and has content
            var notification = $('#otp-notification');
            if (notification.length > 0 && notification.text().trim() !== '') {
                // Show the notification with a slide down animation
                notification.slideDown('slow').delay(7000).slideUp('slow');
            }
        });
    </script>
</body>

</html>