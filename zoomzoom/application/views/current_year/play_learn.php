<?php include('header.php');

 //print_r($activate[0]);
//print_r($material_free);
//print_r($material_paid);
//print_r($price);
 //echo 'ok';die;


   //print_r($result[0]);
   if($result[0]['clevel']=='1'){
    $lev='School Level';
    $nlev='Interschool Level';
}
if($result[0]['clevel']=='2'){
    $lev='Interschool Level';
    $nlev='State Level';
}
if($result[0]['clevel']=='3'){
    $lev='State Level';
    $nlev='National Level';
}
if($result[0]['clevel']=='4'){
    $lev='National Level';
    $nlev='MaRRS Primary Colors International ';
}
if($result[0]['clevel']=='5'){
    $lev='MaRRS Primary Colors International';
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
<!--<marquee><h3 style='color:crimson;'>Due to some server issue. Study Materials will be downloadable by tommarow morning... </h3></marquee>-->
        <div id="productWrapper" class="container">
            <div class="row text-center my-2 mx-2" id="result">
                <div class="text-start">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
				<div class="text-end" style=" margin-top: -25px;">                
                <a href="<?php echo base_url();?>Cin_login/certificateform" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-right me-2" style="font-size: 16px;"></i>Provisional Certificate</a>  
                </div>
              <div class="col-12 my-2 mx-2">
                <h2><?php echo $lev; ?> Result</h2>
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
                
                
                <?php 
               
                    
                    if($result[0]['status']=='Q'){ ?>
                        <div class="col-12 mx-2 text-center">   
                            <h3 style="padding:10px"><span style="color:#006699;">Congratulations!! You are qualified to register for</span><span style="color:crimson;font-family: 'FontAwesome';font-size: 16px;letter-spacing:4px;"> <?php echo $nlev; ?></span><span style="color:#006699;"> Championship..</span></h3> 
                        </div>
                        
                        
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="row">
                        <?php if($activate[0]['status']=='Active'){ 
                            if($cometition!='Yes'){ ?> 
                        
                                <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                        <div class="card-body" style='padding-bottom:0px;'>
                                            <h5 class="card-title"><?php  echo $result[0]['product_name']; 
                                            ?></h5>
                                            
                                        </div>
                                        <div class="card-body" style='padding-top:0px;'>
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$price[0]['product_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $price[0]['product_price'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $price[0]['product_price'];?>"><i class="fa-solid fa-trash-can"></i></a>
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
                                                <a href="#" class="card-link">Admit Card: Paid</a>
                                            
                                            </div>
                                            <div class="card-footer">
                                                
                                                <!--<a href="#" class="btn btn-warning btn-sm my-1"> Admit Card will be Avilable Soon</a>-->
                                                 <a href="<?php echo base_url();?>cin_login/admitcardodisha" class="btn btn-warning btn-sm my-1"> Admit Card</a>   
                                                <a href="<?php echo base_url();?>cin_login/admitcardodisha" name="download_admit" id="" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download" ></i></a>
                                            
                                            </div>
                                        </div>
                                    </div>
                        
                    
                                    <!-- ============ free material =============== -->
                                    <?php  if(!empty($material_free)){ //print_r($material_free);
                                            
                                            ?>
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex"> 
                                
                                            <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                            <form method='post' action="<?php echo base_url()?>cin_login/free_material" >
                                                <input type='text' name='product' value='<?php echo $material_free[0]['product_name']; ?>' style='display:none;' >
                                                <input type='text' name='class' value='<?php echo $material_free[0]['class']; ?>' style='display:none;' >
                                                <input type='text' name='clevel' value='<?php echo $material_free[0]['clevel']; ?>' style='display:none;' >
                                                <input type='text' name='period' value='<?php echo $material_free[0]['period']; ?>' style='display:none;' >
                                                <input type='text' name='subject' value='<?php echo $material_free[0]['subject']; ?>' style='display:none;' >
                                          
                                                <div class="card-body">
                                                    <h5 class="card-title">Study Material - Free</h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">Price: Free</a>
                                                    <a href="#" class="card-link">Available</a>
                                                </div>
                                                <div class="card-footer p-1">
                                                    <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                    
                                                    <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                           
                                                   
                                                    <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                </div>
                                            </form>
                                            </div>
                                    
                                        </div>
                            
                                    <?php } else{?>
                                    
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                
                                            <div class="card my-2 mx-2 p-1 w-100">
                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                            
                                                <div class="card-body">
                                                    <h5 class="card-title">Study Material - Free</h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">Price: Free</a>
                                                </div>
                                                <div class="card-footer p-1">
                                                    <a href="#" class="btn btn-warning btn-sm my-1"> Available Soon</a>
                                                    
                                                    <!--<button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm" ><i class="fa-solid fa-download"></i></button>-->
                                                           
                                                   
                                                    <a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></a>
                                                </div>
                                            
                                            </div>
                                    
                                        </div>
                                
                                
                                    <?php }?>
                        
                        <?php } } ?>
                        
                        <?php
                        if($activate[0]['study_material']=='Yes') { 
                        if($study_material!='Yes'){
                        ?>
                    
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Study Material - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php echo '₹ '.$price[0]['study_material']; ?></a>
                                    
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $price[0]['study_material'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $price[0]['study_material'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }else{
                        ?>
                            <?php  if(!empty($material_paid)){ //print_r($material_paid[0]['folder']);?>
                          
                                <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    
                                    <div class="card my-2 mx-2 p-1 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                         <form method='post' action="<?php echo base_url()?>cin_login/paid_material">
                                                <input type='text' name='product' value='<?php echo $material_paid[0]['product_name']; ?>' style='display:none;' >
                                                <input type='text' name='class' value='<?php echo $material_paid[0]['class']; ?>' style='display:none;' >
                                                <input type='text' name='clevel' value='<?php echo $material_paid[0]['clevel']; ?>' style='display:none;' >
                                                <input type='text' name='period' value='<?php echo $material_paid[0]['period']; ?>' style='display:none;' >
                                                <input type='text' name='subject' value='<?php echo $material_paid[0]['subject']; ?>' style='display:none;' >
                                
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                            
                                        </div>
                                        <div class="card-footer p-1">
                                                <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                               <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                        </div>
                                          </form>
                                    </div>
                                </div>
                              
                            <?php } else{?>
                             <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 p-1 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Study Material - Paid</h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Available Soon</a>
                                        </div>
                                        <div class="card-footer p-1">
                                            <a href="#" class="btn btn-warning btn-sm my-1"> Paid Material</a>
                                            <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                        
                            <?php }?>
                        
                     <?php }}?>
                        
                        <!--// =========== orientation ============== //-->
                    <?php
                    if($activate[0]['orientation']=='Yes'){ 
                    if($orientation1!='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$price[0]['orientation1']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    
                                    <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="">  Registration Close</a>-->
                                      
                                    <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $price[0]['orientation1'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $price[0]['orientation1'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } else { ?>
                   
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
    
                            <div class="card my-2 mx-2 p-1 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                    <form method='post' action="<?php echo base_url()?>Cin_login/orientation">
    
                                <div class="card-body">
                                    <h5 class="card-title">Orientation Slip</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                   <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                <?php
                        if($activate[0]['rivision']=='Yes'){
                   if($rivision!='Yes'){
                   ?>               
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>
                                    <div class="card-body">
                                        <h5 class="card-title">Revision Test</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="card-link">Price:<?php echo '₹ '.$price[0]['revision1']; ?></a>
                                        
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $price[0]['revision1'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $price[0]['revision1'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </div>
                                </div>
                            </div>
                     <?php } else { ?>
                            <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Revision Slip</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                    
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm">Revision</a>
                                    <a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                     <?php } }
                        
                        //  ========================== //
                      if($activate[0]['mock_test']=='Yes'){
                          if($mock_test!='Yes'){
                     ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>
                            <div class="card-body">
                                <h5 class="card-title">Mock Test</h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link">Price:<?php echo '₹ '.$price[0]['mock_test']; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                 <!--<a href="#" class="btn btn-warning btn-sm my-1" onClick="" id="">  Registration Close</a>-->
                                        <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $price[0]['mock_test'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $price[0]['mock_test'];?>"><i class="fa-solid fa-trash-can"></i></a>
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
                                    <a href="#" class="card-link"><?php echo 'Available ..'; ?></a>
                                    
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-warning btn-sm">Mock Test</a>
                                    <a href="<?php base_url();?>mocktest" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                   
                    <?php } }
                     ?>
                        
						<!--   vishu------>
					<?php	 if($activate[0]['mock_test']=='Yes'){
                          if($mock_test!='Yes'){
                     ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                        <div class="card my-2 mx-2 w-100">
                            <img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>
                            <div class="card-body">
                                <h5 class="card-title">Combo(Study Materials + Mock Test)</h5>
                            </div>
                            <div class="card-body">
                                <a href="#" class="card-link">Price:<?php echo '₹ '.$price[0]['revision1']; ?></a>
                                
                            </div>
                            <div class="card-footer">
                                
                                        <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $price[0]['revision1'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $price[0]['revision1'];?>"><i class="fa-solid fa-trash-can"></i></a>
                                    </div> 
                        </div>
                    </div>
                    
                    <?php } } ?>  
                        
						
						
                        <!---   vishu------->
                        
                        
                        
                        </div>
                    </div>
                    
    
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
            <!--</div>-->
                        <!--</div>-->
    
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
                        <div class="card w-100 my-2">
                            <div class="card-body">
                                <h4 class="card-title text-center">Items Added To Cart</h4>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0 my-2" id='amount'><?php if($amount_total==0){  ?>
                                    </li>
                                    </ul>
                                    <?php
                                }else{ ?>
                                
                                    <?php 
                                        if($amount_total=='1750'){
                                           echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">3. Orientation </span><span class="me-3 float-end">  Rs 950</span>'."<br>".'<span class="ms-2">4. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        if($amount_total=='1400'){
                                            echo '<span class="ms-2">1. Material </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Orientation </span><span class="me-3 float-end">  Rs 950</span>'."<br>".'<span class="ms-2">3. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                       }
                                        if($amount_total=='1550'){
                                            echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">3. Orientation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
                                        if($amount_total=='1500'){
                                            echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Orientation </span><span class="me-3 float-end">  Rs 950</span>'."<br>".'<span class="ms-2">3. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        if($amount_total=='800'){
                                            echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">3. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        
                                        // if($amount_total=='1750'){
                                        //     echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">3. Orientation </span><span class="me-3 float-end">  Rs 950</span> '."<br>".'<span class="ms-2">4. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        // }
                                        
                                        if($amount_total=='1200'){
                                            echo '<span class="ms-2 ">1. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">2. Orientation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
                                         if($amount_total=='600'){
                                            echo '<span class="ms-2 ">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Material </span><span class="me-3 float-end">  Rs 250</span>';
                                        }
                                         if($amount_total=='1300'){
                                            echo '<span class="ms-2 ">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Orientation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
                                         if($amount_total=='550'){
                                            echo '<span class="ms-2 ">1. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        
                                        if($amount_total=='1150'){
                                            echo '<span class="ms-2 ">1. Orientation </span><span class="me-3 float-end">  Rs 950</span>'."<br>".'<span class="ms-2">2. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        // if($amount_total=='900'){
                                        //     echo '<span class="ms-2 ">1. Material </span><span class="me-3 float-end">  Rs 550</span>'."<br>".'<span class="ms-2">2. Mock Test </span><span class="me-3 float-end">  Rs 350</span>';
                                        // }
                                        if($amount_total=='450'){
                                            echo '<span class="ms-2 ">1. Material </span><span class="me-3 float-end">  Rs 250</span>'."<br>".'<span class="ms-2">2. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
                                        
                                        
                                        if($amount_total=='350'){
                                            echo '<span class="ms-2">1. Competition </span><span class="me-3 float-end">  Rs 350</span>';
                                        }
                                        if($amount_total=='250'){
                                            echo '<span class="ms-2">1. Material </span><span class="me-3 float-end">  Rs 250</span>';
                                        }
                                        if($amount_total=='950'){
                                            echo '<span class="ms-2">1. Orientation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
                                        if($amount_total=='200'){
                                            echo '<span class="ms-2">1. Mock Test </span><span class="me-3 float-end">  Rs 200</span>';
                                        }
										if($amount_total=='400'){
                                            echo '<span class="ms-2">1.Combo(Material + Mock Test)</span><span class="me-3 float-end">  Rs 400</span>';
                                        } 
										if($amount_total=='750'){
                                            echo '<span class="ms-2">1.Combo(Material + Mock Test)</span><span class="me-3 float-end">  Rs 400</span>'."<br>".'<span class="ms-2">2. Competition </span><span class="me-3 float-end">  Rs 350</span>';
                                        } 
										if($amount_total=='1700'){
                                            echo '<span class="ms-2">1.Combo(Material + Mock Test)</span><span class="me-3 float-end">  Rs 400</span>'."<br>".'<span class="ms-2">2. Competition </span><span class="me-3 float-end">  Rs 350</span>'."<br>".'<span class="ms-2">2. Orienatation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
										if($amount_total=='1350'){
                                            echo '<span class="ms-2">1.Combo(Material + Mock Test)</span><span class="me-3 float-end">  Rs 400</span>'."<br>".'<span class="ms-2">2. Orienatation </span><span class="me-3 float-end">  Rs 950</span>';
                                        }
                                        
                                        ?>
                                    
                                        
                                        <?php
                                }
                                ?>
    
                         
                            <div class="card-footer text-end">
                                    <a href="#" class="card-link my-2" style="text-decoration:none;">Total Amount <span class="card-link ms-2" id='amount'> ₹ <?php echo $amount_total; ?></span></a>
                                    <script>
									var total = "<?php echo $amount_total;?>";
									$(document).ready(function() {
										if(total== '400') {
									   $('#250').css('display','none');
									   $('#200').css('display','none');
									}
									if(total== '750') {
									   $('#250').css('display','none');
									   $('#200').css('display','none');
									}
									if(total== '1700') {
									   $('#250').css('display','none');
									   $('#200').css('display','none');
									}
									if(total== '250') {
									   $('#400').css('display','none'); 
									   
									}
									if(total== '200') {
									   $('#400').css('display','none');   
									   
									}
									if(total== '1750') {
									   $('#400').css('display','none');   
									   
									}
									if(total== '1350') {
									   $('#250').css('display','none');
									   $('#200').css('display','none');   
									   
									}
									if(total== '1550') {
									  $('#400').css('display','none');   
									}
									if(total== '550') {
									  $('#400').css('display','none');   
									}
							   
							 });
									</script>
    
                                <div id="myDIV"></div>
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
								<?php if(empty($amount_total)){  ?>
                                     <p type=""  class="btn btn-warning btn-lg my-3" id='pay-button' style='font-size:15px;font-weight:700;' readonly>Proceed To Register</p> 
								<?php }else{?>
									 <button type="submit" name="pay" id="pay" class="btn btn-warning btn-lg my-3" id='pay-button' style='font-size:15px;font-weight:700;'>Proceed To Register</button> 
								<?php }?>
                                    <!--<a href="#" class="btn btn-warning">Proceed To Register </a>-->
                                </form>
                            </div>
                            </div>
                            
                        </div>
                    <?php } ?>
                    
                   
                    <?php  
                }else{?>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;"> "Sorry, you are not qualified to the next level. Better Luck Next Time!"</span><span style="color:crimson;"></span><span style="color:#006699;">...</span></h3> 
                    </div>
                
                <?php }?>
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