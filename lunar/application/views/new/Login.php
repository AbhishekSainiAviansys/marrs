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
  <!-- MDB -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/common/bootstrap-login-form.min.css" />
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700);

body {
  background: #999;
  padding-top: 20px;
  font-family: "Open Sans Condensed", sans-serif;
}

#bg {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  /*background: url(<?php echo base_url()?>images/DSC_0232.JPG) no-repeat center center fixed;*/
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
footer{
        position: absolute;
    width: 100%;
    bottom: 0;
    padding:1% 0%;
    font-size:20px;
    color:white;
    text-align:center;
    background:linear-gradient(to bottom, rgba(1,44,85,1) 0%, rgba(0,28,57,1) 100%);
}
small{
    font-size:60%;
}
#ho{
    padding:1% 0%;
    border-bottom: 1px solid gray;
}
#ho a{
    padding:1% 3%;
    text-decoration:none;
}
</style>
                  
                <div class="container-fluid">
                    <div class='row'>  
                    <div class="col-12">
                        <div id="bg">
                      <img src="<?php echo base_url()?>images/desk2.jpg" width="100%" height="100%">
                  </div>
                  <div id='head'>
                      <h2>Student Login</h2><br>
                      <h1 style='padding-top:10px;'>National Championship (2021-22)</h1>
                  </div>
                    </div>
                        <div class='col-sm-4'>
                           
                        </div>
                        <div class='col-sm-4' id='form'>
                            <div class='row'>
                                <div class='col-sm-2'></div>
                                <div class='col-sm-8'>
                                    <form method='post' >   
                                        <div id="pad">
                                            <label class="form-label" for="typeEmailX-2">CIN</label>
                                            <input type="text" id="typeEmailX-2"  name="cin"  class="form-control form-control-lg" placeholder='Enter CIN' required />
                                            
                                        </div>
                                        <div id="pad">
                                            <label class="form-label" for="typePasswordX-2">Password</label>
                                            <input type="password" id="typePasswordX-2" name="password"  class="form-control form-control-lg" placeholder='Enter Password' required />
                                            
                                        </div>
                                        <div>
                                            <lable style='color:#fff;'>
                                                <?php 
                                                if(!empty($this->session->flashdata('error'))){
                                                    echo $this->session->flashdata('error'); 
                                                }
                                                   
                                                ?>
                                            </lable>
                                        </div>
                                        
                                        <div id='pad' style='padding-bottom:60px;'>
                                            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class='col-sm-2'></div>
                            </div>
                                    
                        </div>
                        <div class='col-sm-4'>
                           
                        </div>
                                
                </div>
                </div>
                <!-- =============== v ============= -->
          <!--</div>-->
  <!--        <div class='col-sm-4'>-->
  <!--            ok-->
  <!--        </div>-->
  <!--      </div>-->
  <!--</div>-->
  
  <!--<section class="vh-100" style="background-color: #508bfc;">-->
  <!--  <div class="container py-5 h-100">-->
  <!--    <div class="row d-flex justify-content-center align-items-center h-100">-->
  <!--      <div class="col-12 col-md-8 col-lg-6 col-xl-5">-->
  <!--        <div class="card shadow-2-strong" style="border-radius: 1rem;">-->
  <!--          <div class="card-body p-5 text-center">-->
  
  <!--            <h3 class="mb-5">Sign in</h3>-->
  <!--              <?php if($this->session->flashdata('succees')){?>-->
  <!--           <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('succees');?></div>-->
  <!--           <?php }?>-->
  <!--            <form class="form-horizontal" action="" method="post">-->
  <!--            <div class="form-outline mb-4">-->
  <!--              <input type="text" id="typeEmailX-2"  name="username"  class="form-control form-control-lg" />-->
  <!--              <label class="form-label" for="typeEmailX-2">Username</label>-->
  <!--            </div>-->
  
  <!--            <div class="form-outline mb-4">-->
  <!--              <input type="password" id="typePasswordX-2" name="password"  class="form-control form-control-lg" />-->
  <!--              <label class="form-label" for="typePasswordX-2">Password</label>-->
  <!--            </div>-->
  
              <!-- Checkbox -->
  <!--            <div class="form-check d-flex justify-content-start mb-4">-->
  <!--              <input-->
  <!--                class="form-check-input"-->
  <!--                type="checkbox"-->
  <!--                value=""-->
  <!--                id="form1Example3"-->
  <!--              />-->
  <!--              <label class="form-check-label" for="form1Example3"> Remember password </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
  <!--              <label class="form-check-label" for="form1Example3"> <a href="<?php echo base_url();?>manage/login/resetpassword/">Reset password </a></label>-->
  <!--            </div>-->
  
  <!--            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>-->
  
  <!--          </form>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  <!-- End your project here-->

  <!-- MDB -->
  
  
  
  
  
  
  <!--               <form class="form-horizontal" action="" method="post">-->
  <!--            <div class="form-outline mb-4">-->
  <!--              <input type="text" id="typeEmailX-2"  name="username"  class="form-control form-control-lg" />-->
  <!--              <label class="form-label" for="typeEmailX-2">Username</label>-->
  <!--            </div>-->
  
  <!--            <div class="form-outline mb-4">-->
  <!--              <input type="password" id="typePasswordX-2" name="password"  class="form-control form-control-lg" />-->
  <!--              <label class="form-label" for="typePasswordX-2">Password</label>-->
  <!--            </div>-->
  
              <!-- Checkbox -->
  <!--            <div class="form-check d-flex justify-content-start mb-4">-->
                <!--<input-->
                <!--  class="form-check-input"-->
                <!--  type="checkbox"-->
                <!--  value=""-->
                <!--  id="form1Example3"-->
                <!--/>-->
                <!--<label class="form-check-label" for="form1Example3"> Remember password </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                <!--<label class="form-check-label" for="form1Example3"> <a href="<?php echo base_url();?>manage/login/resetpassword/">Reset password </a></label>-->
  <!--            </div>-->
  
  <!--            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>-->
  
  <!--          </form>-->
  
  
  
  
  <footer >
    
    <div class="container-fluid" >
        <div class='row' id='aa'>
            <div class='col-md-12 ml-auto' id='ho'>
                    <a href="https://marrs.in" >Home</a>
                    <a href="https://marrs.in/refund_cancellation.php" >Refund Policy</a>
                                    <a href="https://marrs.in/terms_conditions.php" >Terms & Conditions</a>

                                    <a href="https://marrs.in/privacy.php" >Privacy</a>

            </div>
            </div>
            <div class="row">
                           <div class="col-md-6 text-center">
                    <small>© MaRRS Intellectual Services Pvt. Ltd. 2000-2022.</small>
                </div>
                <div class="col-md-6 text-center">
                    <small>Powered By: Aviansys Technology Pvt. Ltd.</small>
                </div>
            </div>
 
</div>
   
    
</footer>
  
  
  
  
  
  
  <script type="text/javascript" src="<?php echo base_url();?>public/common/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>