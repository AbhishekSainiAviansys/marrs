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
                  <h3 class="card-title text-center my-3">WELCOME</h3>
                        <form class=" text-left p-2" method='POST'>
                            <div class="mb-3">
                            <label for="PRID" class="form-label">Enter PRID</label>
                            <input type="text" class="form-control" name="prid" placeholder="PRID"  >
                            </div>
                            <div class="mb-4">
                            <label for="password" class="form-label">Enter Password</label>
                            <input type="password" class="form-control" id="password" placeholder="PRID" name='access_code'>
                            </div>
                            
                            
                        <div ><?php if(!empty($this->session->flashdata('login_error'))){ ?>
                    
                    
                            <h6 style='color:red;'> <?php echo $this->session->flashdata('login_error');?></h6>
                                <?php  } ?>
                        
                        </div>
                            <div class="mb-5">
                                
                                <button type="submit" name="login" class="btn btn-danger w-100 btn-lg">Login</button>
                            </div>
                        </form>
                      </div>
                </div>
               </div>
            </div>
      </div>
    </section>
    <?php include "footer.php"?>

