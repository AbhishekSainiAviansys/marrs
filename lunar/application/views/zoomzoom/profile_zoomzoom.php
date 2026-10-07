<?php include "header_profile.php"?>
<?php //print_r($zoomzoom);?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 text-start text-dark my-2 ">
                
                    <h2 style="font-family: system-ui;">MaRRS ZoomZoom</h2>
                     
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 text-end text-dark my-2">
                   <form method='post'>
                        
                        <button type="submit" class="btn btn-danger reg-down" style="box-shadow: 1px 1px 5px #1a4485;" name='edit'>Profile Edit</button>
                       
                    </form>
                    
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
                                        <h2 class="text-white"><?php echo $student[0]['first_name'].' '.$student[0]['middle_name'].' '.$student[0]['last_name']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="card my-2 p-2">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-lg-3 mb-2 mb-lg-0">
                                    <div class="mb-2"><i class="fa-solid fa-hashtag" style="color: #000;"></i></div>
                                    <h3>ZoomZoom PRID</h3>
                                    <h4><?php echo $student[0]['zoomzoom_prid']; ?></h4>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <div class="mb-2"><i class="fa-solid fa-envelope-circle-check"></i></div>
                                    <h3>Email</h3>
                                    <h4><?php echo $student[0]['email']; ?></h4>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-2"><i class="fa-solid fa-square-phone"></i></div>
                                    <h3>Mobile Number</h3>
                                    <h4><?php echo $student[0]['mobile']; ?></h4>
                                </div> 
                                <div class="col-lg-2">
                                    <div class="mb-2"><i class="fa-solid fa-address-card"></i></div>
                                    <h3>Class</h3>
                                    <h4><?php echo $student[0]['class']; ?></h4>
                                </div>
                                
                                
                                
                            </div>
                            
                            <div class="row text-center">
                                <?php 
                                    if(!empty($this->session->flashdata('item'))){?>
                                    <h2 style='color:green;'>
                                        <?php echo $this->session->flashdata('item'); ?>
                                        </h2>
                                        <?php
                                        }
                                    ?>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
                    <div class="col-sm-12 col-md-12 col-lg-12 text-center my-2">
                         <div class="card my-2 p-2">
                        <div class="card-body">
                            <?php 
                              if(!empty($zoomzoom)){
                                  foreach($zoomzoom as $row){
                                  echo ' '.$row['product_name'];
                                  echo '=> CIN : '.$row['cin'].' <br>';
                                  }
                                  
                              } ?>
                            <div class="row text-center">
                                
                        <?php if($period){ ?>   
                                 <form method='POST'>
                                <p class="card-text text-center" style="color: steelblue;"><b>"Congratulations, you are qualified to participate in the MaRRS Zoom Zoom - Quarter-I-Preliminary Test"</b></p>
                                <h4 style="font-size:1.2rem;"><b>Click Below To </b></h4>
                                <button type="submit" class="btn btn-danger reg-down" style="box-shadow: 1px 1px 5px #1a4485;" name='result' > Result View & Download Certificate</button>
                               
                                <button type="submit" class="btn btn-danger reg-down" style="box-shadow: 1px 1px 5px #1a4485;" name='submit1' > Register & Download</button>
                               
                        
                            </form>
                        <?php }else{      ?>  
                            <form method='POST'>
                                <p class="card-text text-center" style="color: steelblue;"><b>"Congratulations, you are qualified to participate in the MaRRS Zoom Zoom National Championship"</b></p>
                                <h4 style="font-size:1.2rem;"><b>Click Below To </b></h4>
                                <button type="submit" class="btn btn-danger reg-down" style="box-shadow: 1px 1px 5px #1a4485;" name='result' > Result View & Download Certificate</button>
                               
                                <button type="submit" class="btn btn-danger reg-down" style="box-shadow: 1px 1px 5px #1a4485;" name='submit' > Register & Download</button>
                               
                        
                            </form>
                    <?php } ?>        
                </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </section>
                  
    <?php include "footer.php"?>
