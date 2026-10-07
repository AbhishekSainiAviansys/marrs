<?php include('header.php');

   print_r($_SESSION);
   
        if(empty($competition)){

            $this->db->select('*');
            $this->db->from('competition_product_state');   
            $this->db->where('id',$_SESSION['exam_id']);
            $query = $this->db->get();
            $competition= $query->row();
            
        }   
        
print_r($competition);

                            $close_date = $competition->close_date;
                            // echo "Close Date: " . $close_date . "<br>";
                            
                            // Calculate three days before close date
                            $date = new DateTime($close_date);
                            $date->modify('-3 days');
                            $three_days_before = $date->format('Y-m-d');
                            // echo "Three Days Before: " . $three_days_before . "<br>";
                            
                            // Calculate five days before close date
                            $date_five_days = new DateTime($close_date);
                            $date_five_days->modify('-5 days');
                            $date_five_days_formatted = $date_five_days->format('Y-m-d');
                            // echo "Five Days Before: " . $date_five_days_formatted . "<br>";
                            
                            // Calculate seven days before close date
                            $date_seven_days = new DateTime($close_date); // Create DateTime object
                            $date_seven_days->modify('-7 days'); // Subtract 7 days
                            $date_seven_days_formatted = $date_seven_days->format('Y-m-d'); // Format as YYYY-MM-DD
                            
                            // Get today's date
                            $today = date('Y-m-d');

// Output the results
// echo "Seven Days Before: " . $date_seven_days_formatted . "<br>";
// echo "Today's Date: " . $today . "<br>";
                                                                    
// if ($today < $date_seven_days_formatted) {
//     echo "The date has not passed.";
// } else {
//     echo "The date has passed.";
// }
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
	 
	 
	.custom-alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            z-index: 1000;
            font-family: Arial, sans-serif;
        }

        .custom-alert p {
            margin: 0;
        }

        /* Style for overlay (to make it look like a modal) */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        } 
	 
    </style>

    
    <section style='padding-bottom:110px;'>
        <div class="container col">
            <div class="text-start">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
    
            
            
            <div class="row" id="reg_download">
                
                
                
            <?php 
                    
                if (strtotime($competition->close_date) < strtotime($today)) { ?>
                
                    <div class='col-sm-12'>  
                        <div class='text-center'><h4 style='color:green;'>OOPS !!! Competition is Over.</h4></br><p>Come Back Again.</p></div>
                            <!--<nav>-->
                                
                            <!--</nav>-->
                        </div>
                    </div>
    
                    <?php 
                } else { ?>
                    <div class="row" >
                        <div class='col-sm-12'>  
                            <div class='text-center'>
                                <h5 style='color:crimson;'>
                                    <?php  echo $competition->product_name.'-'.$competition->subject.'-'.$competition->series.'-'.$competition->type;  ?>
                                </h5>
                            </div>
                               
                        </div>
                    </div>
                        
                    
                        
                    </div>    
                    <div class="row" >
                        <div class='col-sm-8'>  
                            <div class='text-center'><h4 style='color:green;'>Please choose your option and pay</h4></div>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Competition</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Paid Study Material</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Orientation</button>
                                        <button class="nav-link" id="nav-mock-tab" data-bs-toggle="tab" data-bs-target="#nav-mock" type="button" role="tab" aria-controls="nav-mock" aria-selected="false">Mock Test</button>
                                    
                                
                                        <!--<button class="nav-link" id="nav-combo-tab" data-bs-toggle="tab" data-bs-target="#nav-combo" type="button" role="tab" aria-controls="nav-combo" aria-selected="false">COMBOs</button>-->
                                        
                                      <?php 
                                      $cart = $this->db->get_where('new_cart',array('cin' =>$cin,'clevel'=>$competition->clevel,'subject'=>$competition->subject,'series'=>$competition->series,'type'=>$competition->type))->row(); 
                                      //echo $this->db->last_query();
                                        if(!empty($cart)){ ?>
                                      
                                            <a href='<?php echo base_url(); ?>cin_login/api_callinvoice/<?php echo $competition->clevel; ?>' class='btn btn-primary btn-mg '>Invoice </a>
                                       
            						    <?php } ?>
            						    
                                      </div>
                                    </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class=" tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div style="">
                            
                                    <?php
                                    
                                    if($competition->status=='Live'){  ?>
                                    <div class="tab-content row" id="myTabContent">
                                        
                                        <div    class="d-flex tab-pane fade show active" id="competition-tab" role="competition-tab" aria-labelledby="competition-tab" >
                                            <?php
                                            // $close_date = $activate[0]['close_date']; 
                                            //             $date = new DateTime($close_date);
                                            //             $date->modify('-3 days');
                                                        
                                            //             $three_days_before = $date;
                                            //             $today = new DateTime();
                                                    
                                                    
                                            // print_r($cart);            
                                            if($cart->status!='Paid' or empty($cart)){ ?> 
                                        
                                                <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                    <div class="card my-2 mx-2 p-1 w-70">
                                                    <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                                    <div class="card-body" style='padding-bottom:0px;'>
                                                        <h5 class="card-title"><?php  echo $competition->product_name; 
                                                        ?></h5>
                                                        
                                                    </div>
                                                    <div class="card-body" style='padding-top:0px;'>
                                                        <a href="#" class="card-link">Price: <?php echo '₹ '.$competition->product_price; ?></a>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="card-footer">
                                                        <?php    
                                               
                                                if( $competition->product_price!='0'){
                                                    
                                                    $today = date("Y-m-d");
                                                //   echo $three_days_before;
                                                    if ($three_days_before >= $today ) 
                                                    
                                                    {?>
                                                        <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $competition->product_price.'+'.'Competition'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $competition->product_price.'+'.'Competition'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                                     <?php
                                                    
                                                        
                                                        
                                                    }else{
                                                         
                                                        echo 'Registration Closed.';
                                                    }
            						               
                                                         } ?>
                                                    
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                    
                                         <?php }else{  ?>
                                         
                                         
                                            <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                                        <div class="card-body" style='padding-bottom:0px;'>
                                                            <h5 class="card-title"><?php
                                                            // print_r($result['clevel']);
                                                            echo $result['product_name']; ?></h5>
                                                        </div>
                                                        <div class="card-body" style='padding-top:0px;'>
                                                            <a href="#" class="card-link">Admit Card: </a>
                                                         <?php 
                                                         if($admit_card_av=='yes'){
                                                         echo 'Exam Date';
                                                         }else{
                                                             echo 'Exam Date';
                                                         }
                                                         echo '<br>'.$competition->close_date;
                                                         ?>
                                                        </div>
                                                        <div class="card-footer">
                                                            
                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1"> Admit Card will be Avilable Soon</a>-->
                                                             <!--<a href="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1"> Admit Card</a> -->
                                                           <?php 
                                                        //   echo $av_ad;
                                                          
                                                           if($admit_card_av=='yes' or $av_ad=='yes'){ 
                                                            if ($today >= $three_days_before) {
                                                        //   if ($today==  $today) {
                                                        
                                                           ?>
                                                           Download 
                                                           <a href="<?php echo base_url();?>cin_login/api_calladmit_card/<?php echo $clevel; ?>" class="btn btn-warning btn-sm my-1" > <i class="fa-solid fa-download"></i></a>
                                                            
                                                           <!--<form method='post' action="<?php echo base_url()?>cin_login/admitcard_download" >-->
                                                           <!--<button name="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1" value='<?php echo $admit_id;?>'> <i class="fa-solid fa-download"></i></button>-->
                                                           <!-- </form>           -->
                                                           <?php }else{
                                                               echo 'Available On '.$three_days_before;
                                                           }
                                                           }else{ 
                                                           echo 'Available On '.$three_days_before;
                                                           
                                                           } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                
                                                <!-- ============ free material =============== -->
                                                <?php  if(!empty($material_free_a)){ //print_r($material_free);?>
                                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                                <div class="card my-2 mx-2 p-1 w-100">
                                                                <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                                    <input type='text' name='product' value='<?php echo $material_free_a->product_name; ?>' style='display:none;' >
                                                                    <input type='text' name='class' value='<?php echo $material_free_a->class; ?>' style='display:none;' >
                                                                    <input type='text' name='clevel' value='<?php echo $material_free_a->clevel; ?>' style='display:none;' >
                                                                    <input type='text' name='period' value='<?php echo $material_free_a->period; ?>' style='display:none;' >
                                                                    <input type='text' name='series' value='<?php echo $material_free_a->series; ?>' style='display:none;' >
                                                                    <input type='text' name='subject' value='<?php echo $material_free_a->subject; ?>' style='display:none;' >
                                                                    <input type='text' name='sub_type' value='<?php echo $material_free_a->sub_type; ?>' style='display:none;' >
                                                                    
                                                                    <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                                    <input type='text' name='type' value="<?php echo 'A'; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material A- Free</h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free</a>
                                                                        <?php if(!empty($material_free_a)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Available Soon.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_a)){?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                <?php }
                                                
                                                if(!empty($material_free_b)){?>
                                                
                                               <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                        <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                                        <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                            <input type='text' name='product' value='<?php echo $material_free_b->product_name; ?>' style='display:none;' >
                                                            <input type='text' name='class' value='<?php echo $material_free_b->class; ?>' style='display:none;' >
                                                            <input type='text' name='clevel' value='<?php echo $material_free_b->clevel; ?>' style='display:none;' >
                                                            <input type='text' name='period' value='<?php echo $material_free_b->period; ?>' style='display:none;' >
                                                            <input type='text' name='series' value='<?php echo $material_free_a->series; ?>' style='display:none;' >
                                                            <input type='text' name='subject' value='<?php echo $material_free_a->subject; ?>' style='display:none;' >
                                                            <input type='text' name='sub_type' value='<?php echo $material_free_a->sub_type; ?>' style='display:none;' >
                                                                    
                                                            <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                            <input type='text' name='type' value="<?php echo 'B'; ?>" style='display:none;' >
                                                            <div class="card-body">
                                                                <h5 class="card-title">Study Material B- Free</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <a href="#" class="card-link">Price: Free </a>
                                                                <?php if(!empty($material_free_b)){?>
                                                                <a href="#" class="card-link">Available</a>
                                                                <?php }else{ echo 'Available Soon.'; }?>
                                                            </div>
                                                            <div class="card-footer p-1">
                                                                <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                <?php if(!empty($material_free_b)){?>
                                                                <!--<a href="#" class="card-link">Available</a>-->
            
                                                                <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                          <?php } ?> 
                                                               
                                                                <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                            </div>
                                                        </form>
                                                        </div>
                                                
                                                    </div>
                                        
                                            
                                            
                                                <?php }?>
                                    
                                                <?php } 
                                    
                                        } ?>
                            
                                    </div>
                            
                            
                            
                                </div>
                            </div> 
                          
                          
                          
                          </div>
                          
                          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                              <div class='row'>
                                <?php
                                if($competition->study_material_a =='study_material_a') { 
                                if($study_material_a=='Yes'){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material A - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$competition->study_material_a_price; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           
                                            if( $competition->study_material_a_price !='0' ){
                                                $center = $this->db->get_where('exam_centers',array('comp_id'=>$competition->id))->result_array();
						                
            						                
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id == '14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                                                        <!--<a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                        <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                        
                                                                        <?php
                                                                    // } else {
                                                                        // echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        
                                                    // }    else{
                                                            
                                                                 
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $competition->study_material_a_price.'+'.'Material A'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $competition->study_material_a_price.'+'.'Material A'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                        
                                            <?php  //  }  
                                            }else{
                                                         
                                                        echo 'Material-A Purchase Close.';
                                                    } } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{
                                ?>
                                    <?php  //if(!empty($material_paid_a)){ //echo $material_paid_a->folder;?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new">
                                                        <input type='text' name='product' value='<?php echo $material_paid_a->product_name; ?>' style='display:none;' >
                                                        <input type='text' name='class' value='<?php echo $material_paid_a->class; ?>' style='display:none;' >
                                                        <input type='text' name='clevel' value='<?php echo $material_paid_a->clevel; ?>' style='display:none;' >
                                                        <input type='text' name='period' value='<?php echo $material_paid_a->period; ?>' style='display:none;' >
                                                        <input type='text' name='status' value='<?php echo "Paid"; ?>' style='display:none;' >
                                                        <input type='text' name='type' value='<?php echo "A"; ?>' style='display:none;' >
                                                        <input type='text' name='series' value='<?php echo $material_free_a->series; ?>' style='display:none;' >
                                                        <input type='text' name='subject' value='<?php echo $material_free_a->subject; ?>' style='display:none;' >
                                                        <input type='text' name='sub_type' value='<?php echo $material_free_a->sub_type; ?>' style='display:none;' >
                                                            
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material A- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">
                                                        <?php 
                                                            if(!empty($material_paid_a)){
                                                                echo 'Available';
                                                            }else{
                                                                echo 'Available Soon.';
                                                            }
                                                        ?>
                                                    </a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_a)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>    
                                                </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                
                              }}?>
                                
                                <!-- ======================== Material C ==================     -->
                                 <?php
                                 //echo 'ok';
                                if($competition->study_material_c =='study_material_c') { 
                                    //echo $study_material;
                                if($study_material_c=='Yes'){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material C - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$competition->study_material_c_price; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                          
                                            if( $competition->study_material_c_price !='0'){
                                                
            						                
            						              //  if(!empty($date_close)){
            						              //      echo 'Competition Close Date: '.$date_close.'<br>';
            						              //  }
            						              //  $sevenDaysBefore = date("Y-m-d", strtotime($date_close . " -7 days"));
                                                   
                                                    // if ($date_close >= $today) {
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                                    // if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                            <!--                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                            <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                                    // } else {
                                                                    //     echo 'Purchase Closed';
                                                                    // }
                                                        // }           
                                                        // else{
                                                        
                                                        
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $competition->study_material_c_price.'+'.'Material C'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $competition->study_material_c_price.'+'.'Material C'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //} 
                                                
                                            }else{
                                                         
                                                        echo 'Material-C Purchase Close.';
                                                    } } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new">
                                                        <input type='text' name='product' value='<?php echo $material_paid_c->product_name; ?>' style='display:none;' >
                                                        <input type='text' name='class' value='<?php echo $material_paid_c->class; ?>' style='display:none;' >
                                                        <input type='text' name='clevel' value='<?php echo $material_paid_c->clevel; ?>' style='display:none;' >
                                                        <input type='text' name='period' value='<?php echo $material_paid_c->period; ?>' style='display:none;' >
                                                        <input type='text' name='status' value='<?php echo "Paid"; ?>' style='display:none;' >
                                                        <input type='text' name='type' value='<?php echo "C"; ?>' style='display:none;' >
                                                        <input type='text' name='series' value='<?php echo $material_free_a->series; ?>' style='display:none;' >
                                                        <input type='text' name='subject' value='<?php echo $material_free_a->subject; ?>' style='display:none;' >
                                                        <input type='text' name='sub_type' value='<?php echo $material_free_a->sub_type; ?>' style='display:none;' >
                                                          
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material C- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_c)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_c)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                                    }
                                    ?>
                                    
                                <!-- ======================== Material B ==================     -->
                                 <?php
                                 //echo 'ok';
                                if($activate[0]['study_material_b']=='study_material_b') { 
                                    //echo $study_material;
                                if($study_material_b=='Yes'){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material B - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$competition->study_material_b_price; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           
                                            if( $competition->study_material_b_price !='0'){
                                                
                                                    
                                                    if ($close_date >= $today) {
                                                        
                                                        // if($state_id =='14686'){
                                                            
                                                        //             if (strpos($result['cin'], 'AB3') == true  ) {
                                                                        ?>
                                                                                                                    <!--<a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"> <i class="fa-solid fa-cart-plus"></i></a>-->
                                                                                    <!--<a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"><i class="fa-solid fa-trash-can"></i></a>-->
                                            
                                                                        <?php
                                                        //             } else {
                                                        //                 echo 'Purchase Closed';
                                                        //             }
                                                        // }           
                                                        // else{
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $competition->study_material_b_price.'+'.'Material B'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $competition->study_material_b_price.'+'.'Material B'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php //}
                                                
                                            }else{
                                                         
                                                        echo 'Material-B Purchase Close.';
                                                    } } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }else{ //echo 'pk';
                                
                                
                                // if(!empty($material_paid_b)){ //print_r($material_paid_b);?>
                                  
                                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                            
                                            <div class="card my-2 mx-2 p-1 w-100">
                                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                                 <form method='post' action="<?php echo base_url()?>cin_login/paid_mat_new">
                                                        <input type='text' name='product' value='<?php echo $material_paid_b->product_name; ?>' style='display:none;' >
                                                        <input type='text' name='class' value='<?php echo $material_paid_b->class; ?>' style='display:none;' >
                                                        <input type='text' name='clevel' value='<?php echo $material_paid_b->clevel; ?>' style='display:none;' >
                                                        <input type='text' name='period' value='<?php echo $material_paid_b->period; ?>' style='display:none;' >
                                                        <input type='text' name='status' value='<?php echo "Paid"; ?>' style='display:none;' >
                                                        <input type='text' name='type' value='<?php echo "B"; ?>' style='display:none;' >
                                                        <input type='text' name='series' value='<?php echo $material_free_a->series; ?>' style='display:none;' >
                                                        <input type='text' name='subject' value='<?php echo $material_free_a->subject; ?>' style='display:none;' >
                                                        <input type='text' name='sub_type' value='<?php echo $material_free_a->sub_type; ?>' style='display:none;' >
                                                          
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material B- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_b)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
                                                </div>
                                                <div class="card-footer p-1">
                                                        <a href="#" class="btn btn-warning btn-sm my-1">Paid Material</a>
                                                     <?php   if(!empty($material_paid_b)){
                                                    ?>
                                                       <button type="submit" name="download_paid" id="download_paid" class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                                    <?php } ?>  
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                      
                                    <?php //} 
                                    
                                    }
                                    }
                                    ?>    
                                    
                            </div>
                              
                          </div>
                          
                          
                          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                               <div class='row'>
                                   <!--// =========== orientation A ============== //-->
                    <?php
                    if($competition->orientation_a =='orientation_a'){ //echo 'ok'; 
                    if($orientation_a=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation A - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$competition->orientation_a_price; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                        
                                        
                                    if( $competition->orientation_a_price !='0'){
                                        
                                            $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material A','amount'=>$competition->study_material_a_price))->row();
                    
                                            if(!empty($resort) or $study_material_a!='Yes' or $study_material_a!=='yes'){    
                                    
                                                    if($today < $date_seven_days_formatted){
                                                        
                                                        ?>  
                                                            <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $competition->orientation_a_price.'+Orientation A'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $competition->orientation_a_price.'+Orientation A'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                                        <?php 
                                                         //   }
                                                    }else{
                                                        echo 'Orientation is over.';   
                                                    }
                                        
                                            }else{  
                                                ?>
                                               <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-A for Orientation-A.'
                                                <?php
                                            }
                                            
                                        }else{
                                            echo 'Orientation is over.';
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } else { ?>
                   
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
    
                            <div class="card my-2 mx-2 p-1 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                    <form method='post' action="<?php echo base_url()?>Cin_login/orientation_">
                                    <input type='text' name='type' value='<?php echo "A"; ?>' style='display:none;' >
                                <div class="card-body">
                                    <h5 class="card-title">Orientation A Slip</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                   <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " ><i class="fa-solid fa-download"></i></button>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                   
                   <!-- ================ orientation B ==================== -->
                   <?php
                    if($competition->orientation_b =='orientation_b'){ 
                    if($orientation_b=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation B - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$competition->orientation_b_price; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                   
                                    
                                        
                                    if( $competition->orientation_b_price !='0'){
                                        // if($stob=='open'){
                                        $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material B','amount'=>$competition->study_material_b_price))->row();
                
                                        if(!empty($resort) or $study_material_b!='Yes'){ 
                    
                                            if($today < $date_seven_days_formatted){
                                                    
                                                       
                                            ?> 
                                                <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $competition->orientation_b_price.'+Orientation B'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $competition->orientation_b_price.'+Orientation B'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                            
                                            <?php 
                                           //   }
                                              } else{
                                            echo 'Orientation is over.';}
                                            
                                                    }else{  
                                            ?>
                                           <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-B for Orientation-B.'
                                            <?php
                                        }   } else{
                                            echo 'Orientation is over.';
                                     }?>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } else { ?>
                   
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
    
                            <div class="card my-2 mx-2 p-1 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                    <form method='post' action="<?php echo base_url()?>Cin_login/orientation_">
                                    <input type='text' name='type' value='<?php echo "B"; ?>' style='display:none;' >
                                <div class="card-body">
                                    <h5 class="card-title">Orientation B Slip</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                   <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " ><i class="fa-solid fa-download"></i></button>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                   
                   
                   <!-- =================== orientation C ======================== -->
                   <?php
                    if($competition->orientation_c =='orientation_c'){ //echo 'ok'; 
                    if($orientation_c=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation C - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$competition->orientation_c_price; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                   
                                        
                                    if( $activate[0]['orientation_c_price']!='0'){
                                        // if($stoc=='open'){
                                    $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material C','amount'=>$competition->study_material_c_price))->row();
                
                                        if(!empty($resort) or $study_material_c!='Yes'){ 
                               
                                            if($today < $date_seven_days_formatted){
                                                    
                                    ?>  
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $competition->orientation_c_price.'+Orientation C'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $competition->orientation_c_price.'+Orientation C'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                    
                                    <?php //}
                                            }else{
                                            echo 'Orientation is over.';
                                            }         
                                                        
                                                        
                                                    }else{  
                                            ?>
                                           <span style="color:red;font-weight:bold;">Mandatory</span> To Buy Material-C for Orientation-C.'
                                            <?php
                                        }   }else{
                                            echo 'Orientation is over.';
                                    //} 
                                    } ?>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } else { ?>
                   
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
    
                            <div class="card my-2 mx-2 p-1 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                    <form method='post' action="<?php echo base_url()?>Cin_login/orientation_">
                                    <input type='text' name='type' value='<?php echo "C"; ?>' style='display:none;' >
                                <div class="card-body">
                                    <h5 class="card-title">Orientation C Slip</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php echo 'Available'; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Orienatation</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                   <button type="submit" name="download_slip"class="btn btn-secondary btn-sm my-1 " <i class="fa-solid fa-download"></i></button>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                   
                   <!-- ======================= Mock Test ======================== -->
                   
                   </div></div>
                   
                   
                   <div class="tab-pane fade" id="nav-mock" role="tabpanel" aria-labelledby="nav-mock-tab">
                               <div class='row'>
                   <?php
                    if($competition->mock_test =='mock_test'){ //echo 'ok'; 
                    if($mock_test=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Mock Test - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$competition->mock_test_price; ?></a>
                                    
                                </div>
                                
                                
                                
                               
                                <div class="card-footer p-1">
                                    <?php    
                                  
                                    if( $competition->mock_test_price !='0'){
                                        
                                     
                                        if ($close_date >= $today) {
                                    ?>  
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $competition->mock_test_price.'+MockTest'.'+'.$competition->id;?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $competition->mock_test_price.'+MockTest'.'+'.$competition->id;?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php 
                                                        }    
                                                    
                                        else{
                                        echo 'Mock Closed.';
                                    }
                                                    }
                                        else{
                                        echo 'Mock Closed.';
                                    }
                                    //}
                                    ?>
                                </div>
                                
                            </div>
                        </div>
                   
                   
                   <?php } else { //print_r($mock_av);?>
                   
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
    
                            <div class="card my-2 mx-2 p-1 w-100">
                                <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                    <form method='post' action="<?php echo base_url()?>cin_login/mock_paper">
                                        
                                                        <input type='text' name='product' value='<?php echo $mock_av->product_name; ?>' style='display:none;' >
                                                        <input type='text' name='class' value='<?php echo $mock_av->class; ?>' style='display:none;' >
                                                        <input type='text' name='clevel' value='<?php echo $mock_av->clevel; ?>' style='display:none;' >
                                                        <input type='text' name='period' value='<?php echo $mock_av->period; ?>' style='display:none;' >
                                <div class="card-body">
                                    <h5 class="card-title">Mock Test Paper</h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link"><?php 
                                    if(!empty($mock_av)){
                                        echo 'Available';
                                        
                                    }else{
                                    echo 'The Mock Test can be downloaded by evening today.'; } 
                                    ?>
                                    </a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Mock Test</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                    <?php 
                                    if(!empty($mock_av)){ 
                                    ?>
                                   <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                   
                                   <?php } else { ?>
                                   
                                   <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                               
                                   <?php }
                                   ?>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                   
                   
                </div>
                              
          </div>
                          
                          
                          
                         
                        </div>
                       
                    </div>    
                      
                <div class='col-sm-4'>
                    
                    
     <!--    ========== cart section ==========   -->
                 <?php  if($all_paid_new==''){?>
    
    
                        
						
						
                    <div class="">
                    
                       <?php 
                        $res = $this->db->get_where('amount_cart',array('cin' =>$cin,'ini'=>'','sch_id'=>$competition->id))->result_array();
                        
                        
                        $amount_total1=0;$amount_total2=0;$amount_total=0;
                       foreach($res as $value){
                           //print_r($value['amount']);die;
                           $amount_total1  = $value['amount']+$amount_total1;
                       }
                       
                       $amount_total=$amount_total1;
                       
                       
                       ?>
                        <div class="card w-100 my-2">
                            <div class="card-body">
                                <h4 class="card-title text-center">Items Added To Cart</h4><br>
                                <!--<h5>If you purchase combo, other item in cart will remove automatic. Purchase them next time.</h5>-->
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0 my-2" id='amount'><?php if($amount_total==0){  ?>
                                    </li>
                                    </ul>
                                    <?php
                                }else{ foreach($res as $row){ ?>
                                
                                   <h5><?php echo $row['title'].' - Rs.'.$row['amount'];if(!empty($row['ini'])){echo ' '.$row['ini'];?><i class="fa fa-briefcase fa-spin fa-2x fa-fw primary" aria-hidden="true"></i><?php  } ?> </h5>
                                    
                                        
                                        <?php }
                                }
                                ?>
    
                            <div class="card-footer text-end">
                                    <a href="#" class="card-link my-2" style="text-decoration:none;">Total Amount <span class="card-link ms-2" id='amount'> ₹ <?php echo $amount_total; ?></span></a>
                                    
                                <div id="myDIV"></div>
                                
                                <form method='post' action="<?php echo base_url()?>razorpay/pay">
                                   
                                
                                    
                                <input type="hidden" name="cin" value="<?php echo $student->cin;?>">
                                <input type="hidden" name="name" value="<?php echo $student->student_name;?>">
                                <input type="hidden" name="contact" value="<?php echo $student->stud_phone;?>">
                                <input type="hidden" name="email" value="<?php echo $student->stud_email;?>">
                                <input type="hidden" name="clevel" value="<?php echo $competition->clevel;?>">
                                <input type='text' name='product_name' value='<?php echo $competition->product_name;?>' style='display:none;' >
                                
                                <input type='text' name='amount' value='<?php print_r($amount_total); ?>' style='display:none;' >
                                <input type='text' name='sch_id' value='<?php echo $competition->id; ?>' style='display:none;' >
								<?php if(empty($amount_total)){  ?>
                                     <p type=""  class="btn btn-warning btn-lg my-3" id='pay-button' style='font-size:15px;font-weight:700;' readonly>Proceed To Register</p> 
								<?php }else{?>
								    <!--<p>Payments will be back shortly</p>-->
									 <button type="submit" name="pay" id="pay" class="btn btn-warning btn-lg my-3" id='pay-button' style='font-size:15px;font-weight:700;' >Proceed To Register</button> 
								<?php }?>
                                    <!--<a href="#" class="btn btn-warning">Proceed To Register </a>-->
                                </form>
                            </div>
                            </div>
                            
                        </div>
                    <?php } ?>
                    
                   
                </div>   
                    
                   
                   <?php //} ?>  
                   
                    
                
                </div>
                
               
           </div>     
                
    </section>
    
    <div class="overlay" id="overlay"></div>
    <div class="custom-alert" id="custom-alert">
        <h5 id="alert-message" style='color:#4d79ff;'></h5>
    </div>
                        
    
    
    
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
<script>
// function misb(id) {
    
//     var amount = id;
//   //alert(amount);
   
//      $.ajax({
//             url: "<?php base_url();?>net_abc___",
//             type: 'POST',
//             data: {id: amount},
//             success: function (response) {
//                 showAlert(response);
//                 // location.reload();
           
//             }
//     });
//  }
 
 
 
function misb(id) {
    var amount = id;

    $.ajax({
        url: "<?= base_url('cin_login/net_abc___'); ?>", // Correct URL
        type: 'POST',
        data: {id: amount},
        success: function (response) {
            try {
                let data = JSON.parse(response); // Parse JSON response
                if (data.status === 'success') {
                    showAlert(data.message); // Success message
                    location.reload();
                } else {
                    showAlert(data.message); // Error message
                    location.reload();
                }
            } catch (error) {
                console.error('Invalid JSON response:', response);
                showAlert('An unexpected error occurred.');
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            showAlert('Failed to process the request. Please try again.');
            location.reload();
        }
    });
}
 
 
// function remove_misb(id) {
    
//   var amount = id;
//   // alert(amount);
   
//  $.ajax({
//         url: "<?php base_url();?>cart_remove___",
//         type: 'POST',
//         data: {id: amount},
//         success: function (response) {
//         showAlert(response);
//         location.reload();
//         }
// });
//  }
 

function remove_misb(id) {
    var amount = id;

    $.ajax({
        url: "<?= base_url('cin_login/cart_remove___'); ?>", // Corrected the URL
        type: 'POST',
        data: {id: amount},
        success: function (response) {
            try {
                let data = JSON.parse(response); // Parse JSON response
                if (data.status === 'success') {
                    showAlert(data.message); // Success message
                    location.reload(); // Reload the page if needed
                } else {
                    showAlert(data.message); // Error message
                    location.reload();
                }
            } catch (error) {
                console.error('Invalid JSON response:', response);
                showAlert('An unexpected error occurred.');
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            showAlert('Failed to process the request. Please try again.');
            location.reload();
        }
    });
}



</script>

    <script>
            function showAlert(message) {
                // Display overlay
                document.getElementById('overlay').style.display = 'block';
                var alertDiv = document.getElementById('custom-alert');
                alertDiv.style.display = 'block';
                alertDiv.style.transition = '0.5s';
            
                // Display message
                var alertMessage = document.getElementById('alert-message');
                alertMessage.textContent = message;
                setTimeout(function () {
                    closeAlert();
                }, 9000);
            }

        function closeAlert() {
            // Hide overlay
            document.getElementById('overlay').style.display = 'none';
        
            // Hide alert
            var alertDiv = document.getElementById('custom-alert');
            alertDiv.style.display = 'none';
        }

      
    </script>
  
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $(".add1").click(function() {
            $(".add2").css("display", "none");
        });
    });
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script>
$(document).ready(function(){
	$('a[data-bs-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});


</script>
<?php include("footer.php");?>