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
    <link rel="stylesheet" href="<?php echo base_url()?>custom.css" />
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700);

body {
  /*background: #999;*/
  /*background:linear-gradient(to top right, #0066ff 0%, #ff99cc 100%);*/
  background-color: #A9C9FF;
background-image: linear-gradient(180deg, #A9C9FF 0%, #FFBBEC 100%);

  /*background: url(<?php echo base_url()?>images/int_logo.png) no-repeat center center fixed;*/
  /*background: url(<?php echo base_url();?>images/int_logo.png) no-repeat center center fixed;*/
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
  /*background: url(<?php echo base_url()?>images/int_logo.png) no-repeat center center fixed;*/
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
</style>
                <!--  <div id="bg">-->
                <!--      <img src="<?php echo base_url()?>images/desk2.jpg" width="100%" height="100%">-->
                <!--  </div>-->
                <!--  <div id='head'>-->
                <!--      <h2>Student Login</h2><br>-->
                <!--      <h1 style='padding-top:10px;'>National Championship (2021-22)ok</h1>-->
                <!--  </div>-->
                <!--<div class="container-fluid">-->
                <!--    <div class='row'>  -->
                <!--        <div class='col-sm-4'>-->
                           
                <!--        </div>-->
                <!--        <div class='col-sm-4' id='form'>-->
                <!--            <div class='row'>-->
                <!--                <div class='col-sm-2'></div>-->
                <!--                <div class='col-sm-8'>-->
                <!--                    <form method='post' >   -->
                <!--                        <div id="pad">-->
                <!--                            <label class="form-label" for="typeEmailX-2">CIN</label>-->
                <!--                            <input type="text" id="typeEmailX-2"  name="cin"  class="form-control form-control-lg" placeholder='Enter CIN' required />-->
                                            
                <!--                        </div>-->
                <!--                        <div id="pad">-->
                <!--                            <label class="form-label" for="typePasswordX-2">Password</label>-->
                <!--                            <input type="password" id="typePasswordX-2" name="password"  class="form-control form-control-lg" placeholder='Enter Password' required />-->
                                            
                <!--                        </div>-->
                <!--                        <div>-->
                <!--                            <lable style='color:#fff;'>-->
                                                <?php 
                                              // if(!empty($this->session->flashdata('error'))){
                                               //    echo $this->session->flashdata('error');
                                              // }
                                                   
                                               ?>
                <!--                            </lable>-->
                <!--                        </div>-->
                                        
                <!--                        <div id='pad' style='padding-bottom:60px;'>-->
                <!--                            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>-->
                <!--                        </div>-->
                <!--                    </form>-->
                <!--                </div>-->
                <!--                <div class='col-sm-2'></div>-->
                <!--            </div>-->
                                    
                <!--        </div>-->
                <!--        <div class='col-sm-4'>-->
                           
                <!--        </div>-->
                                
                <!--</div>-->
                
                <!-- ==========================  souravv  =========================== -->
    <section>
        <!--<a href='https://marrs.in/student_registration/zoomzoom/zoomzoom_register'>Z</a>-->
        <!--<a href='https://marrs.in/student_registration/zoomzoom/'>R</a>-->
        
        <div class="container-fluid d-flex justify-content-center align-items-center" style="height:100vh; overflow:hidden;">
            <div class="row" id="student_login">
                <div class="col-sm-12">
                <div class="card mx-3 p-2" style="width: 27rem;">
                <a href="https://www.marrs.in/" class="btn w-25 btn-sm text-secondary"><i class="fa-solid fa-circle-chevron-left me-2 text-secondary" style="font-size: 16px;"></i>HOME</a>  
                <img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-user-essential-collection-bearicons-gradient-bearicons.png"/>                        
                <h3 class="card-title text-center my-1" style="font-size: 1.5rem;">STUDENT LOGIN</h3>
                <h4 class="card-title text-center my-2" style="font-size: 1.2rem;">MaRRS Primary Colors <br/> International Championship 2021-22</h4>
                        <form class=" text-left p-2" method='post' >
                            <div class="mb-3" style='text-align:center;'>
                                <label for="cin" class="form-label">CIN</label>
                                <input type="text" name="cin" class="form-control" id="cin" placeholder="Enter CIN">
                            </div>
                            <div class="mb-4" style='text-align:center;'>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="cin" placeholder="Enter Password">
                            </div>
                            <?php 
                                                   if(!empty($this->session->flashdata('error'))){
                                                        ?> <div class="mb-4 text-center text-danger"><?php 
                                                       echo $this->session->flashdata('error');
                                                       ?></div><?php
                                                   }
                                                       
                                                   ?>
                            
                                
                            <div class="mb-3">
                                <button type="submit" name="submit" class="btn btn-danger w-80 btn-lg" id='cin'>Login</button>
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
                <!--<label class="form-check-label" for="form1Example3"> <a href="https://marrs.in/student_registration/zoomzoom/zoomzoom_register" target='blank'>z</a></label>-->
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
  
  
  
  
  
  
  
  
  
  
  
  <script type="text/javascript" src="<?php echo base_url();?>public/common/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>