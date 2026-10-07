<?php include "header.php"; // echo $id;die;?>
 
    <style>
        .img{
            text-align:center;
        }
    </style>
    
  
    <section>
        <div class="container-fluid d-flex justify-content-center align-items-center" style="margin-top:5%;">
            <div class="row" id="student_login">
                <div class="col-sm-12">
                <div class="card p-3" style="width: 25rem;">
                    <div class='img'>
                        <img src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-user-essential-collection-bearicons-gradient-bearicons.png" width='100px' height='' />                        
              
                    </div>
                  <h3 class="card-title text-center my-3">WELCOME <br>To ZoomZoom Registration</h3>
                        <form class=" text-left p-2" method='POST'>
                            <div class="mb-3">
                            <label for="PRID" class="form-label">Enter Franchise Access Code</label>
                            <input type="text" class="form-control"  placeholder="Enter Access Code" name='access_code'>
                            </div>
                            <?php 
                                                   if(!empty($this->session->flashdata('error'))){
                                                        ?> <div class="mb-4 text-center text-danger"><?php 
                                                       echo $this->session->flashdata('error');
                                                       ?></div><?php
                                                   }
                                                       
                                                   ?>
                            <div class="mb-5">
                                
                                <button type="submit" name="submit" class="btn btn-danger w-100 btn-lg">Verify</button>
                            </div>
                        </form>
                      </div>
                </div>
               </div>
            </div>
      </div>
    </section>
    <?php include "footer.php"?>