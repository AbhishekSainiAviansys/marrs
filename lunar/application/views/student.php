<?php //include('header.php');
?>
<head>
<style>
   
    
      
@media  (max-width:992px){        
.pad{
    border-left:0px !important;
}
}



    </style>
    </head>

    <?php include('stud_headernew.php'); ?>
<body>
     <div class='container-fluid'>
        <div class='row'>
           <div class="col-12">
    <div class="text-start my-2">                
                <a href="https://marrs.in/" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
            </div>
        </div>
    </div>    
    <div class="card w-75 mb-4 mx-auto">
        <div class="card-body">
    <div class='container-fluid'>
        <div class='row'>
           <div class="col-12">
                <div id='heading'>
                    <h1 class="text-center">WELCOME</h1>

                </div>
           </div>
            <div class='col-sm-12 col-md-12 col-lg-4'>

                <div> <img src='<?php echo base_url(); ?>images/loginn.jpg' class="img-fluid w-100" ></div>
            </div>
            <div class='col-sm-12 col-md-12 col-lg-4 p-4 pad' style="border-left: 1px solid #eeee;">
         
                             <form method="POST" class="row g-3">
                        <div class="col-12">
                        <h3> Login</h3>
                        <!--<h4 style='color:black;'>Enter PRID </h4>-->
                        
                       
                            <label class="form-label">Enter PRID <span style='color:#ff9933;'>(Participant Registration ID)</span></label>
                            <input type="text" placeholder="Enter PRID..." class="form-control"  id="user" name="user" value="" />
                          </div>
                          <div class="col-12">
                            <label class="form-label">Enter Password</label>
                            <input type="password" placeholder="Enter Password..." class="form-control"  id="password" name="password"value="" /> 
                          </div>
       
                            <div class="col-sm-12 col-md-12 col-lg-6" >
                                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary w-100">Login</button> 
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6" ></div>
                            <div class="col-sm-12 col-md-12 col-lg-12"></div>
                            <div class="col-12">
                            <h2><?php echo $this->session->flashdata('message'); ?></h2>
                            </div>

        
                </form>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 p-4 pad" style="border-left: 1px solid #eeee;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3 class=" mb-2"> Register</h3>
                                 <p class=" mb-1" style="color:#ff9933;">New <b>School Level</b> Registrations- 2022-23</p>
                                 <p class=" mb-1">New Student? Yes<br> Click Register Button and enter access code.</p>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6">
                                    <a href="https://marrs.in/student_registration/" class="btn btn-outline-danger w-100 my-2 text-center">Register</a> 
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6"></div>
                            </div>
        </div>
    </div>
</div>
</div>
</body>

<?php include("student_footer.php");?>