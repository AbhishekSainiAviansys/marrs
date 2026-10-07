<?php include('header.php');
//   print_r($orientation_status);
if($result[0]['clevel']=='3'){
    $lev='State Level';
}
if($result[0]['clevel']=='4'){
    $lev='National Level';
}

?>
 <style>
 #productWrapper h4{
     font-size:18px;
 }
      #certificateWrapper h1 {
        font-size: 70px;
        font-family: Snell Roundhand, cursive;
        font-weight: 500;
        color: #ffffff;
      }
      .sign {
        position: absolute;
        bottom: 0;
        padding: 5% 5% 0% 5%;
        right: 0;
        font-weight: 700;
        color: #676b6d;
      }
      #certificateWrapper th {
        white-space: nowrap;
        font-size: 12px;
        font-weight: 700;
        color: #707475;
      }
      #certificateWrapper td {
        font-size: 15px;
        font-weight: 700;
        color: #676b6d;
        white-space: nowrap;

      }
      .partcip-detail b {
        color: #5c5d60;
      }
      #certificateWrapper {
        align-items: center;
        min-height: 100vh;
      }
      #certificateWrapper .card {
        background-image: url("../images/bg.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: none;
      }
      #certificateWrapper .card .card-body {
        border: 4px solid #f8c913;
      }
    </style>

   <section>
        <div id="productWrapper" class="container">
            <div class="row text-center my-2 mx-2" id="result">
              <div class="col-12 my-2 mx-2">
                <h2>State Level Result</h2>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">CIN</h3>
                  <h4><?php echo $result[0]['cin']; ?></h4>
                </div>
              </div>
                <h3></h3>
               
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Grade</h3>
                  <h4><?php echo $result[0]['grade']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Rank</h3>
                  <h4><?php if($result[0]['rank']==''){echo 'No Rank';}else{echo $result[0]['rank'];} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Star Speller</h3>
                  <h4><?php echo $result[0]['speller']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Best Performer</h3>
                  <h4><?php echo $result[0]['performer']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Status</h3>
                  <h4><?php echo $result[0]['status']; ?></h4>
                </div>
              </div>
              </div>
            </div>
        </div>
    </section>
    
    
    
    <section style='padding-bottom:110px;'>
        <div class="container">

            <div class="row" id="reg_download">
                <?php if($result[0]['status']=='Q'){ ?>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;">Congratulations!! You are qualified to register for</span><span style="color:crimson;font-size:22px;letter-spacing:2px;font-family:'FontAwesome';"> "National Level"</span><span style="color:#006699;"> Competition..</span></h3>
                    </div>
                
                <?php if(!empty($product_new)){ ?>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                <div class="card-body" style='padding-bottom:0px;'>
                                    <h5 class="card-title"><?php echo $result[0]['product_name']; ?></h5>
                                    
                                </div>
                                <div class="card-body" style='padding-top:0px;'>
                                    <a href="#" class="card-link">Price: <?php echo '₹ '.$product_new['amount']; ?></a>
                                    
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $product_new['amount'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $product_new['amount'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                        </div>
                    </div>
            
                    
                <?php }else{ //echo 'ok';?>
                        
                   
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                <div class="card-body" style='padding-bottom:0px;'>
                                    <h5 class="card-title"><?php echo $result[0]['product_name']; ?></h5>
                                </div>
                                <div class="card-body" style='padding-top:0px;'>
                                    <a href="#" class="card-link">Price: Paid</a>
                                
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm my-1"> Admit Card</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                    <a href="<?php echo base_url();?>cin_login/admitcard" name="download_admit" id="" class="btn btn-secondary btn-sm my-1 " ><i class="fa-solid fa-download"></i></a>
                                </div>
                        </div>
                    </div>
            
                
                                     
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                             <!-- ============ free material =============== -->
                    <?php  if(!empty($material_free)){ //print_r($material_free);
                                        
                                        ?>
                                        
                    <form method='post' action="<?php echo base_url()?>neww/free_material" style='display:none;'>
                        <input type='text' name='product' value='<?php echo $material_free[0]['product_name']; ?>' style='display:none;' >
                        <input type='text' name='class' value='<?php echo $material_free[0]['class']; ?>' style='display:none;' >
                        <input type='text' name='clevel' value='<?php echo $material_free[0]['clevel']; ?>' style='display:none;' >
                        <input type='text' name='period' value='<?php echo $material_free[0]['period']; ?>' style='display:none;' >
                        <input type='text' name='subject' value='<?php echo $material_free[0]['subject']; ?>' style='display:none;' >
                    </form>  
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                <div class="card-body">
                                    <h5 class="card-title">Study Material - Free</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: Free</a>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                    <a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                  
                    <?php } else{?>
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                    <div class="card-body">
                                        <h5 class="card-title">Study Material - Free</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link">Available Soon</a>
                                    </div>
                                    <!--<div class="card-footer">-->
                                    <!--    <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>-->
                                    <!--    <button type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>-->
                                    <!--</div>-->
                                </div>
                            </div>
                    <?php }?>
                <?php }  
                // ========= study material ============ //
                if(!empty($study_material_new)) { ?>
                                    
                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo 'Study Material - Paid'; ?></h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link">Price: <?php echo '₹ '.$study_material_new['amount']; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $study_material_new['amount'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $study_material_new['amount'];?>"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } else{?>
                    
                         <?php  if(!empty($material_paid)){ //print_r($material_free[0]['folder']);?>
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo 'Study Material - Paid'; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                        
                                    </div>
                                    <div class="card-footer">
                                            <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                           <a href="#"> <button name="download_paid"class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button></a>
                                    </div>
                                </div>
                            </div>
                        <?php } else{?>
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                    <div class="card-body">
                                        <h5 class="card-title">Study Material - Paid</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link">Available Soon</a>
                                    </div>
                                    <!--<div class="card-footer">-->
                                    <!--    <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>-->
                                    <!--    <button type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        <?php }?>
                        
                 <?php }
                // =========== orientation ============== //
                if(!empty($orientation_new)){ ?>
                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo 'Orienatation - Paid'; ?></h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link">Price: <?php echo '₹ '.$orientation_new['amount']; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $orientation_new['amount'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $orientation_new['amount'];?>"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
               
               
               <?php } else { ?>
                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                       <form method='post' action="<?php echo base_url()?>neww/orientationslip">

                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Orientation Slip</h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                               <a href="#"> <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></button></a>
                            </div>
                        </div>
                          </form>
                    </div>
             
               <?php } 
               //if(!empty($revision_new)){?>               
               <!--         <div class="col-sm-12 col-md-6 col-lg-3 d-flex">-->
               <!--             <div class="card my-2 mx-2 w-100">-->
               <!--                 <img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>-->
               <!--                 <div class="card-body">-->
               <!--                     <h5 class="card-title">Revision Test</h5>-->
               <!--                 </div>-->
               <!--                 <div class="card-body">-->
               <!--                     <a href="#" class="card-link">Price:<?php echo '₹ '.$revision_new['amount']; ?></a>-->
                                    
               <!--                 </div>-->
               <!--                 <div class="card-footer">-->
               <!--                     <a href="#" class="btn btn-warning btn-sm"> <i class="fa-solid fa-cart-plus"></i></a>-->
               <!--                     <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>-->
               <!--                 </div>-->
               <!--             </div>-->
               <!--         </div>-->
                 <?php ///} else { ?>
               <!--         <div class="col-sm-12 col-md-6 col-lg-3 d-flex">-->
               <!--         <div class="card my-2 mx-2 w-100">-->
               <!--             <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
               <!--             <div class="card-body">-->
               <!--                 <h5 class="card-title">Revision Slip</h5>-->
               <!--             </div>-->
               <!--             <div class="card-body">-->
               <!--                 <a href="#" class="card-link"><?php echo 'Available'; ?></a>-->
                                
               <!--             </div>-->
               <!--             <div class="card-footer">-->
               <!--                 <a href="#" class="btn btn-warning btn-sm">Revision</a>-->
               <!--                 <a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
               <!--             </div>-->
               <!--         </div>-->
               <!--     </div>-->
                 <?php //} 
                  if(!empty($mock_test_new)){
                 ?>
                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                    <div class="card my-2 mx-2 w-100"> 
                        <img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>
                        <div class="card-body">
                            <h5 class="card-title">Mock Test</h5>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link">Price:<?php echo '₹ '.$mock_test_new['amount']; ?></a>
                            
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $mock_test_new['amount'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $mock_test_new['amount'];?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>
                
                <?php } else { ?>
                
                
                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Mock Slip</h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                <a href="#" class="btn btn-warning btn-sm my-1">Moct Test</a>
                                <a href="<?php base_url();?>mocktest" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>
                            </div>
                        </div>
                    </div>
               
               
               
                <?php } 
                 ?>
                 
                 <!-- ================== Certificate ===================== -->
                <!-- <form method='post' action='<?php echo base_url()?>Neww/certificate'>-->
                <!--    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">-->
                <!--        <div class="card my-2 mx-2 w-100">-->
                <!--            <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                <!--            <div class="card-body">-->
                <!--                <h5 class="card-title">Certificate</h5>-->
                <!--            </div>-->
                <!--            <div class="card-body">-->
                <!--                <a href="#" class="card-link"><?php echo 'Available Download'; ?></a>-->
                <!--            </div>-->
                <!--            <div class="card-footer">-->
                <!--                <a href="#" class="btn btn-warning btn-sm">Certificate</a>-->
                <!--                <button type='submit' id="printCertificate" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i> </button>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</form>-->
            <!-- ====================== end ========================= -->
        </div>
</div>

 <!--    ========== cart section ==========   -->
        <?php  if($all_paid_new==''){?>

                <div class="col-sm-12 col-md-4 col-lg-4">
                   <?php $cin = $this->session->userdata('cin');
                   $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                   $amount_total=0;
                   foreach($res as $value){
                       //print_r($value['amount']);die;
                       $amount_total  = $value['amount']+$amount_total;
                   }
                   //echo $amount_total;
                   ?>
                    <div class="card w-100 mt-2">
                        <div class="card-body">
                            <?php if($amount_total==0){  ?>
                                <h4 class="card-title text-center">Items Added To Cart</h4><?php
                            }else{ ?>
                            <h3 class="card-title text-center">
                                <?php 
                                    if($amount_total=='2750'){
                                    echo 'Competition';
                                    }
                                    if($amount_total=='3210'){
                                        echo 'Competition+Material';
                                    }
                                    if($amount_total=='4070'){
                                        echo 'Competition+Material+Orientation';
                                    }
                                    if($amount_total=='3610'){
                                        echo 'Orientation+Competition';
                                    }
                                    if($amount_total=='860'){
                                        echo 'Orienattion';
                                    }
                                    if($amount_total=='460'){
                                        echo 'Material';
                                    }
                                    if($amount_total=='1320'){
                                        echo 'Orienattion+Material';
                                    }
                                    // if($amount_total=='250'){
                                    //     echo 'Mock_Test';
                                    // }
                                    // if($amount=='5750'){
                                    //     echo 'Mock_Test+Competition';
                                    // }
                                    // if($amount_total=='6400'){
                                    //     echo 'Revision+Competition';
                                    // }
                                    // if($amount=='1150'){
                                    //     echo 'Mock_Test+Orientation';
                                    // }
                                    // if($amount_total=='700'){
                                    //     echo 'Mock_Test+Material';
                                    // }
                                    // if($amount_total=='6650'){
                                    //     echo 'Revision+Mock_Test+Competition';
                                    // }
                                    // if($amount_total=='6200'){
                                    //     echo 'Material+Mock_Test+Competition';
                                    // }
                                    // if($amount_total=='1600'){
                                    //     echo 'Material+Mock_Test+Revision';
                                    // }
                                    // if($amount_total=='7100'){
                                    //     echo 'Material+Mock_Test+Revision+Competition';
                                    // }
                                    
                                    ?>
                                    </h3>
                                    
                                    <?php
                            }
                            ?>
                        </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" id='amount'></li>
                            </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Total Amount (INR)</a>
                            <p class="card-link" id='amount'> ₹ ,<?php echo $amount_total; ?></p>
                            <div id="myDIV"></div>
                        </div>
                        <div class="card-footer text-end">
                            <form method='post' action="<?php echo base_url()?>razorpay/pay">
                                <?php
                                $idd = $this->session->userdata('cin');
                                $paid_idd = $this->db->get_where('cin_list',array('cin' =>$idd))->row();?>
                                
                            <input type="hidden" name="cin" value="<?php echo $paid_idd->cin;?>">
                            <input type="hidden" name="name" value="<?php echo $paid_idd->student_name;?>">
                            <input type="hidden" name="contact" value="<?php echo $paid_idd->stud_phone;?>">
                            <input type="hidden" name="email" value="<?php echo $paid_idd->stud_email;?>">
                            <input type='text' name='product_name' value='<?php echo $result[0]['product_name']; ?>' style='display:none;' >
                            <input type='text' name='amount' value='<?php print_r($amount_total); ?>' style='display:none;' >
                            <input type='text' name='price_code' value='<?php echo $product[0]['price_code']; ?>' style='display:none;' >
                                <button type="submit" name="pay" id="pay" class="btn btn-warning btn-lg " id='pay-button' style='font-size:15px;font-weight:700;'>Proceed To Register</button> 
                                <!--<a href="#" class="btn btn-warning">Proceed To Register </a>-->
                            </form>
                        </div>
                        </div>
                        
                    </div>
                <?php } ?>
                
                <?php } else { ?>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;">Sorry!! You are not qualified to register for</span><span style="color:crimson;"> "National Level"</span><span style="color:#006699;"> Competition..</span></h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<section style="display:none;">
      <div class="container" id="content">
        <div class="row" id="certificateWrapper">
          <div class="col-12">
            <div class="card w-100">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8 col-md-8 col-lg-8">
                    <h1>Certificate</h1>
                    <h4 class="mb-5 ms-2 text-white">OF APPRECIATION</h4>
                    <h4
                      class="my-4 ms-2"
                      style="color: #7a7d81; font-weight: 700"
                    >
                      PROUDLY PRESENTED TO
                    </h4>
                    <h3
                      class="my-4 ms-2"
                      style="color: #4b4479; font-weight: 700"
                    >
                      Ishana Shinde
                    </h3>
                    <p
                      class="partcip-detail"
                      style="padding: 2% 1%"
                      colspan="5"
                    >
                      of <b>Witty International School - Malad</b> , for being
                      the <b>BUDDING STAR</b> at the
                      <b>MaRRS PRESCHOOL BEE - ENGLISH</b>.
                    </p>
                    <table class="table table-borderless my-5">
                      <thead>
                        <tr>
                          <th scope="col">RANK</th>
                          <th scope="col">COMPETITION DATE</th>
                          <th scope="col">COMPETITION LEVEL</th>
                          <th scope="col">COMPETITION GRADE</th>
                          <th scope="col">COMPETITION CATEGORY</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>BUDDING STAR</td>
                          <td>Sat, 05 November 2022</td>
                          <td>School Level</td>
                          <td>A+++</td>
                          <td>UKG</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table my-5 table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">CIN</th>
                          <th scope="col">ACADEMIC YEAR</th>
                          <th scope="col">VENUE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>21PBB21053</td>
                          <td>2021-22</td>
                          <td colspan="3">
                            GCC International School, Mira Road, Thane
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 3% 1%" scope="row" colspan="5">
                            DATE ISSUED: 20-November-2022
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-4">
                    <h6 class="float-right sign">
                      P.Suresh Kumar<br />
                      Director, MaRRS Intellectual<br />
                      Services (P) Ltd.
                    </h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
<script>
function misb(id) {
    
  var amount = id;
   //alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>net_abc",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
         //lert(response);
         location.reload();
        }
});
 }
 
 function remove_misb(id) {
    
  var amount = id;
  // alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>remove_misb",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
        // alert(response);
        location.reload();
        }
});
 }
 
// <!--
// $(document).ready(function() {
//     var testArray = ["test1","test2","test3","test4"];
//     var vPool="";
//     function showDiv(testArray)
//     {
//       testArray.push("Competition");
//       return testArray;
//     }
//     jQuery.each(testArray, function(i, val) {
//         vPool += val + "<br /> is the best <br />";
//     });

//     //We add vPool HTML content to #myDIV
//     $('#myDIV').html(vPool);
// });-->


</script>

  <script>   
      window.onload = function () {
       document.getElementById("printBtn").addEventListener("click", () => {
      let element = this.document.getElementById("content");
      let opt = {
        margin:       0,
        filename:     'Certificate.pdf',
        image:        { type: 'jpeg', quality: 100 },
        html2canvas:  { scale: 1 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
      };

      html2pdf().set(opt).from(element).save();
      });
      }
    </script>





<?php include("footer.php");?>