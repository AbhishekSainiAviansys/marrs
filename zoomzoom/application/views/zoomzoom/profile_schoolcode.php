<?php include "header_profile.php"?>
<?php //print_r($student);?>
    <section>
        <div class="container">
            <div class="row">
               
                <div class="col-sm-12 col-md-12 col-lg-12 text-end my-2">
                    <span class="my-1" style="font-size:1.2rem;"><b>Click Here To - </b></span>
                    <a href="#" class="btn btn-danger" style="box-shadow: 1px 1px 5px #66b;"> Register & Download</a>
                </div>
            </div>
        </div>
    </section>
    <section style="background-color:#ffff;">
        <div class="container">
            <div class="row" id="namecard">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="card my-2 p-2" style="background-color:#40bbe7;border: none;">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic"/>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                        <h2 class="text-white"><?php echo $student[0]['student_name']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="card my-2 p-2">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <div class="mb-2"><i class="fa-solid fa-hashtag" style="color: #000;"></i></div>
                                    <h3>CIN</h3>
                                    <h4><?php echo $student[0]['cin']; ?></h4>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <div class="mb-2"><i class="fa-solid fa-envelope-circle-check"></i></div>
                                    <h3>Email</h3>
                                    <h4><?php echo $student[0]['stud_email']; ?></h4>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-2"><i class="fa-solid fa-square-phone"></i></div>
                                    <h3>Mobile Number</h3>
                                    <h4><?php echo $student[0]['stud_phone']; ?></h4>
                                </div>                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                  
    <?php include "footer.php"?>
