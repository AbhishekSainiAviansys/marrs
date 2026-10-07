<?php include('header.php');

 //print_r($activate[0]);
//print_r($material_free);
//print_r($material_paid);
//print_r($price);
 //echo 'ok';die;

//   echo $combo1.'ko';
//   echo $combo2.'pkk';
//   echo $combo3.'jj';
//   echo $combo4.'hi';
   
   $res = $this->db->get_where('competition_level_byproduct',array('medal_no' =>$result['medal_no']+1,'product_name' =>$result['product_name']))->row();
		$nlev=$res->level_name;$level_id=$res->level_id;
//print_r($res);

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

   <section>
<!--<marquee><h3 style='color:crimson;'>Due to some server issue. Study Materials will be downloadable by tommarow morning... </h3></marquee>-->
        <div id="productWrapper" class="container">
            <div class="row text-center my-2 mx-2" id="result">
                <div class="text-start">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
				<!--<div class="text-end" style=" margin-top: -25px;">                -->
    <!--            <a href="<?php echo base_url();?>Cin_login/certificateform" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-right me-2" style="font-size: 16px;"></i>Provisional Certificate</a>  -->
    <!--            </div>-->
              <div class="col-12 my-2 mx-2">
                <h2><?php echo $result['level_name']; ?> RESULT</h2>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">CIN</h3>
                  <h4><?php echo $result['cin']; ?></h4>
                </div>
              </div>
                <h3></h3>
               
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Grade</h3>
                  <h4><?php echo $result['grade']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Rank</h3>
                  <h4><?php if($result['rank']==''){echo 'No Rank';}else{echo $result['rank'];} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Star Speller</h3>
                  <h4><?php echo $result['speller']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Best Performer</h3>
                  <h4><?php echo $result['performer']; ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Status</h3>
                  <h4><?php echo $result['status']; ?></h4>
                </div>
              </div>
              </div>
            </div>
        </div>
    </section>
    
    
    
    <section style='padding-bottom:110px;'>
        <div class="container col">
            
            
            
            <div class="row" id="reg_download">
                
                
                <?php 
               
                    
                    if($result['status']=='Q'){ ?>
                    
                    
                        <div class="col-12 mx-2 text-center">   
                            <h3 style="padding:10px"><span style="color:#006699;">Congratulations!! You are qualified to register for</span><span style="color:crimson;font-family: 'FontAwesome';font-size: 16px;letter-spacing:2px;"> <?php echo $nlev; ?></span><span style="color:#006699;"> Championship..</span></h3> 
                        </div>
                        
                    <div class='col-sm-8'>  
                    <div class='text-center'><h4 style='color:green;'>Please choose your option and pay</h4></div>
                        <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Competition</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Paid Study Material</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Orientation</button>
                            <button class="nav-link" id="nav-mock-tab" data-bs-toggle="tab" data-bs-target="#nav-mock" type="button" role="tab" aria-controls="nav-mock" aria-selected="false">Mock Test</button>
                            
                            
                            <button class="nav-link" id="nav-combo-tab" data-bs-toggle="tab" data-bs-target="#nav-combo" type="button" role="tab" aria-controls="nav-combo" aria-selected="false">COMBOs</button>
                            
                          <?php 
                          $res = $this->db->get_where('new_cart',array('cin' =>$result['cin'],'clevel'=>$level_id))->result_array(); 
                          //echo $this->db->last_query();
                          if(!empty($res)){
                          ?>
                          
                          <a href='<?php echo base_url(); ?>cin_login/api_callinvoice/<?php echo $level_id; ?>' class='btn btn-primary btn-mg '>Invoice </a>
          <!--                  <form method='POST'>-->
          <!--                      <button type="submit" name="invoice"  class="btn btn-primary btn-mg " id='pay-button' style='font-size:12px;font-weight:700;' value='<?php echo $level_id; ?>'>Invoice</button> -->
    						<!--</form>-->
						<?php } ?>
						
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class=" tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div style="">
                            
                                <?php if($activate[0]['status']=='Live'){  ?>
                                <div class="tab-content row" id="myTabContent">
                                    
                                    <div    class="d-flex tab-pane fade show active" id="competition-tab" role="competition-tab" aria-labelledby="competition-tab" >
                                        <?php
                                        if($competition=='Yes'){ 
                                       
                                        ?> 
                                    
                                            <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                <div class="card my-2 mx-2 p-1 w-100">
                                                    <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                                    <div class="card-body" style='padding-bottom:0px;'>
                                                        <h5 class="card-title"><?php  echo $result['product_name']; 
                                                        ?></h5>
                                                        
                                                    </div>
                                                    <div class="card-body" style='padding-top:0px;'>
                                                        <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['product_price']; ?></a>
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="card-footer">
                                                        <?php    
                                               // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                                $this->db->select('*');
                                                $this->db->from('amount_cart');
                                                $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                                $query = $this->db->get();
                                               // echo $this->db->last_query();
                                                $res= $query->result_array();
                                                //print_r($res);
                                                if( $activate[0]['product_price']!='0'){
                                                ?>
                                                        
                                                        <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['product_price'].'+'.'Competition';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                        <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['product_price'].'+'.'Competition';?>"><i class="fa-solid fa-trash-can"></i></a>
                                                    <?php } ?>
                                                    
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                    
                                         <?php }else{ //echo 'ok';?>
                                         
                                         
                                                <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                    <div class="card my-2 mx-2 p-1 w-100">
                                                        <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                                        <div class="card-body" style='padding-bottom:0px;'>
                                                            <h5 class="card-title"><?php echo $result['product_name']; ?></h5>
                                                        </div>
                                                        <div class="card-body" style='padding-top:0px;'>
                                                            <a href="#" class="card-link">Admit Card: </a>
                                                         <?php if($admit_card_av=='yes'){echo 'Available';}?>
                                                        </div>
                                                        <div class="card-footer">
                                                            
                                                            <!--<a href="#" class="btn btn-warning btn-sm my-1"> Admit Card will be Avilable Soon</a>-->
                                                             <!--<a href="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1"> Admit Card</a> -->
                                                           <?php if($admit_card_av=='yes'){?>
                                                           Download
                                                           <form method='post' action="<?php echo base_url()?>cin_login/admitcard_download" >
                                                           <button name="<?php echo base_url();?>cin_login/admitcard_download" class="btn btn-warning btn-sm my-1" value='<?php echo $admit_id;?>'> <i class="fa-solid fa-download"></i></button>
                                                            </form>           
                                                           <?php }else{?>
                                                             Available 3 days before exam
                                                            <?php } ?>
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
                                if($activate[0]['study_material_a']=='study_material_a') { 
                                if($study_material_a=='Yes'){
                                ?>
                            
                                    <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                        <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo 'Study Material A - Paid'; ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_a_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_a_price']!='0' ){
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_a_price'].'+'.'Material A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                        
                                            <?php } ?>
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
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo 'Study Material A- Paid'; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <a href="#" class="card-link"><?php 
                                                    if(!empty($material_paid_a)){
                                                    echo 'Available';}else{
                                                        echo 'Available Soon.';
                                                    }
                                                    
                                                    ?></a>
                                                    
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
                                if($activate[0]['study_material_c']=='study_material_c') { 
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
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_c_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_c_price']!='0'){
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_c_price'].'+'.'Material C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php } ?>
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
                                            <a href="#" class="card-link">Price: <?php echo '₹ '.$activate[0]['study_material_b_price']; ?></a>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <?php    
                                           // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                            $this->db->select('*');
                                            $this->db->from('amount_cart');
                                            $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                            $query = $this->db->get();
                                            //echo $this->db->last_query();
                                            $res= $query->result_array();
                                            //print_r($res);
                                            if( $activate[0]['study_material_b_price']!='0'){
                                            ?>
                                            <a href="#" class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['study_material_b_price'].'+'.'Material B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                            <?php } ?>
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
                    if($activate[0]['orientation_a']=='orientation_a'){ //echo 'ok'; 
                    if($orientation_a=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation A - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_a_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                    $this->db->select('orientation_a_date');
                                    $this->db->from('closing_competition_details');
                                    $this->db->where("competition_id",$activate[0]['id']);
                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->row_array();
                                    $orientation_a_date = $res['orientation_a_date'];
                                    if($orientation_a_date!='0000-00-00'){
                                        $oa='check';
                                    }    
                                        if($oa=='check'){
                                        $current_date = date("Y-m-d");
                                        
                                        $orientation_a_date = new DateTime($orientation_a_date);
                                        $current_date_obj = new DateTime($current_date);
                                        
                                            if ($orientation_a_date > $current_date_obj) {
                                                $stoa='open';
                                            } else {
                                                $stoa='close';
                                            }
                                        }else{
                                            $stoa='open';
                                        }
                                    if( $activate[0]['orientation_a_price']!='0'){
                                        if($stoa=='open'){
                                            
                                        $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material A','amount'=>$activate[0]['study_material_a_price']))->row();
                
                                        if(!empty($resort) or $study_material_a!='Yes'){    
                                    ?>  
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_a_price'].'+Orientation A';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php 
                                        }else{  
                                            echo 'Purchase Material A.';
                                        }
                                        }else{
                                            echo 'Orientation is over.';
                                    }} ?>
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
                    if($activate[0]['orientation_b']=='orientation_b'){ 
                    if($orientation_b=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation B - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_b_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                   $this->db->select('orientation_b_date');
                                    $this->db->from('closing_competition_details');
                                    $this->db->where("competition_id",$activate[0]['id']);
                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->row_array();
                                    $orientation_b_date = $res['orientation_b_date'];
                                    if($orientation_b_date!='0000-00-00'){
                                        $ob='check';
                                    }    
                                        if($ob=='check'){
                                        $current_date = date("Y-m-d");
                                        
                                        $orientation_b_date = new DateTime($orientation_b_date);
                                        $current_date_obj = new DateTime($current_date);
                                        
                                            if ($orientation_b_date > $current_date_obj) {
                                                $stob='open';
                                            } else {
                                                $stob='close';
                                            }
                                        }else{
                                            $stob='open';
                                        }
                                    if( $activate[0]['orientation_b_price']!='0'){
                                        if($stob=='open'){
                                     $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material B','amount'=>$activate[0]['study_material_b_price']))->row();
                
                                        if(!empty($resort) or $study_material_b!='Yes'){ 
                                    ?> 
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_b_price'].'+Orientation B';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php }else{  
                                            echo 'Purchase Material B.';
                                        }   } else{
                                            echo 'Orientation is over.';
                                    } }?>
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
                    if($activate[0]['orientation_c']=='orientation_c'){ //echo 'ok'; 
                    if($orientation_c=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Orienatation C - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['orientation_c_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                   $this->db->select('orientation_c_date');
                                    $this->db->from('closing_competition_details');
                                    $this->db->where("competition_id",$activate[0]['id']);
                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->row_array();
                                    $orientation_c_date = $res['orientation_c_date'];
                                    if($orientation_c_date!='0000-00-00'){
                                        $oc='check';
                                    }    
                                        if($oc=='check'){
                                        $current_date = date("Y-m-d");
                                        
                                        $orientation_c_date = new DateTime($orientation_c_date);
                                        $current_date_obj = new DateTime($current_date);
                                        
                                            if ($orientation_c_date > $current_date_obj) {
                                                $stoc='open';
                                            } else {
                                                $stoc='close';
                                            }
                                        }else{
                                            $stoc='open';
                                        }
                                    if( $activate[0]['orientation_c_price']!='0'){
                                        if($stoc=='open'){
                                    $resort = $this->db->get_where('amount_cart', array('cin' => $result['cin'], 'title' => 'Material C','amount'=>$activate[0]['study_material_c_price']))->row();
                
                                        if(!empty($resort) or $study_material_c!='Yes'){ 
                                    ?>  
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['orientation_c_price'].'+Orientation C';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php }else{  
                                            echo 'Purchase Material C.';
                                        }   }else{
                                            echo 'Orientation is over.';
                                    } } ?>
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
                    if($activate[0]['mock_test']=='mock_test'){ //echo 'ok'; 
                    if($mock_test=='Yes'){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Mock Test - Paid'; ?></h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['mock_test_price']; ?></a>
                                    
                                </div>
                                
                                
                                
                               
                                <div class="card-footer p-1">
                                    <?php    
                                    
                                    $this->db->select('mocktest_a_date');
                                    $this->db->from('closing_competition_details');
                                    $this->db->where("competition_id",$activate[0]['id']);
                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->row_array();
                                    $mocktest_a_date = $res['mocktest_a_date'];
                                    if($mocktest_a_date!='0000-00-00'){
                                        $oa='check';
                                    }    
                                        if($oa=='check'){
                                        $current_date = date("Y-m-d");
                                        
                                        $mocktest_a_date = new DateTime($mocktest_a_date);
                                        $current_date_obj = new DateTime($current_date);
                                        
                                            if ($mocktest_a_date > $current_date_obj) {
                                                $stoa='open';
                                            } else {
                                                $stoa='close';
                                            }
                                        }else{
                                            $stoa='open';
                                        }
                                    
                                   // echo $stoa;
                                   // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                    $this->db->select('*');
                                    $this->db->from('amount_cart');
                                   $this->db->where("(title = 'Combo-4' AND cin = '".$result['cin']."')OR (cin = '".$result['cin']."' AND title = 'Combo-2') OR (cin = '".$result['cin']."' AND title = 'Combo-1') OR (cin = '".$result['cin']."' AND title = 'Combo-3')");

                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->result_array();
                                    //print_r($res);
                                    if( $activate[0]['mock_test_price']!='0'){
                                        if($stoa=='open'){
                                    ?>  
                                        <a href="#" class="btn btn-warning btn-sm my-1" onClick="misb(this.id);" id="<?php echo $activate[0]['mock_test_price'].'+MockTest';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1" onClick="remove_misb(this.id);" id="<?php echo $activate[0]['mock_test_price'].'+MockTest';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php }
                                        else{
                                        echo 'Mock Closed.';
                                    }
                                    }
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
                                    if(!empty($mock_av)){echo 'Available';}else{
                                    echo 'The Mock Test can be downloaded one week before the competition.'; } ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <a href="#" class="btn btn-warning btn-sm my-1">Mock Test</a>
                                    <!--<a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-download"></i></a>-->
                                    <?php 
                                    if(!empty($mock_av)){?>
                                   <button type="submit" name="mock_paper"class="btn btn-secondary btn-sm my-1 "><i class="fa-solid fa-download"></i></button>
                                   <?php } else { ?>
                                   <button type="submit" class="btn btn-secondary btn-sm my-1 " style="pointer-events: none"><i class="fa-solid fa-download"></i></button>
                               
                                   <?php } ?>
                                </div>
                                 </form>
                            </div>
                             
                        </div>
                   
                   <?php } } ?>
                   
                   
                </div>
                              
          </div>
                          
                          
                          
                          
                          <div class="tab-pane fade" id="nav-combo" role="tabpanel" aria-labelledby="nav-combo-tab">
                              <div class='row'>
                                 <!-- =============== Combo-1 =============== -->
                   <?php
                   
                    if($activate[0]['combo_1']!=''){ 
                        if($combo1=='Yes'){
                        //print_r($activate[0]['combo_1']);
                        $c1=explode("+",$activate[0]['combo_1']);
                        foreach($c1 as $r){
                            
                            $cin = $this->session->userdata('cin');
                            $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                            
                            
                        }
                        
                        
                    //if($mock_test!=''){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Combo-1'; ?></h5>
                                    
                                    <h5 class="card-title">
                                    <?php 
                                        foreach($c1 as $r){
                                            print_r($r);
                                            echo '<br>';
                                        }
                                    ?>
                                    
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_1_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    
                                    
                                    <?php    
                                   // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                   
                                    ?>
                                  
                                        <a href="#" class="btn btn-warning btn-sm my-1 add1"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_1_price'].'+Combo-1';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1 rev1"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_1_price'].'+Combo-1';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php ?>
                                
                                </div>
                            </div>
                        </div>
                   
                   
                   
                   
                   <?php } } ?>
                   
                   <!-- =============== Combo-2 =============== -->
                   <?php
                   
                   
                    if($activate[0]['combo_2']!=''){ 
                        if($combo2=='Yes'){
                        //print_r($activate[0]['combo_1']);
                        $c1=explode("+",$activate[0]['combo_2']);
                        foreach($c1 as $r){
                            
                            // if($r['mat_A']){
                            //     echo $material_a;
                            // }
                        }
                        
                        
                    //if($mock_test!=''){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                                <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid" alt="...">
                               <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Combo-2'; ?></h5>
                                    
                                    <h5 class="card-title">
                                    <?php 
                                        foreach($c1 as $r){
                                            print_r($r);
                                            echo '<br>';
                                        }
                                    ?>
                                    
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_2_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    
                                    <?php    
                                   // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                    
                                    ?> 
                                    <a href="#" class="btn btn-warning btn-sm my-1 add2"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_2_price'].'+Combo-2';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1 rev2"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_2_price'].'+Combo-2';?>"><i class="fa-solid fa-trash-can"></i></a>
                                
                                    <?php ?>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } } ?>
                   
                   
                   <!-- =============== Combo-3 =============== -->
                   <?php
                    if($activate[0]['combo_3']!=''){ 
                        if($combo3=='Yes'){
                        //print_r($activate[0]['combo_1']);
                        $c1=explode("+",$activate[0]['combo_3']);
                        foreach($c1 as $r){
                            
                            // if($r['mat_A']){
                            //     echo $material_a;
                            // }
                        }
                        
                        
                   // if($mock_test!=''){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                               <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid" alt="...">
                               <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Combo-3'; ?></h5>
                                    
                                    <h5 class="card-title">
                                    <?php 
                                        foreach($c1 as $r){
                                            print_r($r);
                                            echo '<br>';
                                        }
                                    ?>
                                    
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_3_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                   <?php    
                                   // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                    
                                    ?> 
                                    <a href="#" class="btn btn-warning btn-sm my-1 add3"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_3_price'].'+Combo-3';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1 rev3"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_3_price'].'+Combo-3';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php  ?>
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php }} ?>
                   
                         
                   <!-- =============== Combo-4 =============== -->
                   <?php
                    if($activate[0]['combo_4']!=''){ 
                        if($combo4=='Yes'){
                        //print_r($activate[0]['combo_1']);
                        $c1=explode("+",$activate[0]['combo_4']);
                        foreach($c1 as $r){
                            //print_r($r);
                        }
                        
                        
                   // if($mock_test!=''){
                    ?>
                        <div class="col-sm-12 col-md-6 col-lg-3 d-flex">
                            <div class="card my-2 mx-2 w-100">
                               <img src="https://img.icons8.com/external-dygo-kerismaker/48/000000/external-Discount-payment-dygo-kerismaker.png" width="48" height="48" class="img-fluid" alt="...">
                               <div class="card-body">
                                    <h5 class="card-title"><?php echo 'Combo-4'; ?></h5>
                                    
                                    <h5 class="card-title">
                                    <?php 
                                        foreach($c1 as $r){
                                            print_r($r);
                                            echo '<br>';
                                        }
                                    ?>
                                    
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="card-link">Price: <?php  echo '₹ '.$activate[0]['combo_4_price']; ?></a>
                                    
                                </div>
                                <div class="card-footer p-1">
                                    <?php    
                                   // $res = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                                    
                                    ?> 
                                    <a href="#" class="btn btn-warning btn-sm my-1 add4"  onClick="misb(this.id);" id="<?php echo $activate[0]['combo_4_price'].'+Combo-4';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm my-1 rev4"  onClick="remove_misb(this.id);" id="<?php echo $activate[0]['combo_4_price'].'+Combo-4';?>"><i class="fa-solid fa-trash-can"></i></a>
                                    <?php  ?>    
                                
                                </div>
                            </div>
                        </div>
                   
                   
                   <?php } }?>
                   
                            </div>
                              
                          </div>
                          
                        </div>
                       
                    </div>    
                        
                <div class='col-sm-4'>
                    
                    
     <!--    ========== cart section ==========   -->
                 <?php  if($all_paid_new==''){?>
    
    
                        
						
						
                    <div class="">
                    
                       <?php $cin = $this->session->userdata('cin');
                       $re = $this->db->get_where('amount_cart',array('cin' =>$cin))->result_array();
                        //print_r($re);
                        $res = $this->db->get_where('amount_cart',array('cin' =>$cin,'ini'=>''))->result_array();
                        
                        
                        $amount_total1=0;$amount_total2=0;$amount_total=0;
                       foreach($res as $value){
                           //print_r($value['amount']);die;
                           $amount_total1  = $value['amount']+$amount_total1;
                       }
                        
                        
                        $this->db->distinct();
                        $this->db->select('ini,amount');
                        $this->db->from('amount_cart');
                        $this->db->where('cin', $cin);
                        $this->db->where('ini !=', '');
                        $result = $this->db->get()->result_array();
                        //echo $this->db->last_query();die;
                       foreach($result as $row){
                           $amount_total2=$row['amount']+$amount_total2;
                       }
                       $amount_total=$amount_total1+$amount_total2;
                       //echo $amount_total;
                       
                       
                       
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
                                }else{ foreach($re as $row){ ?>
                                
                                   <h5><?php echo $row['title'].' - Rs.'.$row['amount'];if(!empty($row['ini'])){echo ' '.$row['ini'];?><i class="fa fa-briefcase fa-spin fa-2x fa-fw primary" aria-hidden="true"></i><?php  } ?> </h5>
                                    
                                        
                                        <?php }
                                }
                                ?>
    
                         <?php 
                         
                         $out = $this->db->get_where('cin_result',array('cin' =>$cin))->row();
                         
                                    ?>
                            <div class="card-footer text-end">
                                    <a href="#" class="card-link my-2" style="text-decoration:none;">Total Amount <span class="card-link ms-2" id='amount'> ₹ <?php echo $amount_total; ?></span></a>
                                    
                                <div id="myDIV"></div>
                                <?php  
                                $ar_state=array('14694');
                                if(in_array($student['state_id'],$ar_state) && $student['period_id'] >='13'){
                                ?>
                                <form method='post' action="<?php echo base_url()?>razorpay/pay2">
                                <?php
                                }else{  ?>
                                <form method='post' action="<?php echo base_url()?>razorpay/pay">
                                    <?php
                                }
                                    $idd = $this->session->userdata('cin');
                                    
                                    $paid_idd = $this->db->get_where('cin_list',array('cin' =>$idd))->row();
                                    //print_r($paid_idd);?>
                                    
                                <input type="hidden" name="cin" value="<?php echo $paid_idd->cin;?>">
                                <input type="hidden" name="name" value="<?php echo $paid_idd->student_name;?>">
                                <input type="hidden" name="contact" value="<?php echo $paid_idd->stud_phone;?>">
                                <input type="hidden" name="email" value="<?php echo $paid_idd->stud_email;?>">
                                <input type="hidden" name="clevel" value="<?php echo $clevel;?>">
                                <input type='text' name='product_name' value='<?php echo $out->product_name;?>' style='display:none;' >
                                
                                <input type='text' name='amount' value='<?php print_r($amount_total); ?>' style='display:none;' >
                                <input type='text' name='price_code' value='<?php echo $product['price_code']; ?>' style='display:none;' >
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
                    
                   
                </div>   
                    
                   
                   
                   
                    <?php  
                }else{?>
                    <div class="col-12 mx-2 text-center">
                        <h3><span style="color:#006699;"> "Sorry, you are not qualified to the next level. Better Luck Next Time!"</span><span style="color:crimson;"></span><span style="color:#006699;">...</span></h3> 
                    </div>
                
                <?php }?>
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
function misb(id) {
    
  var amount = id;
   //alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>net_abc__",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
            showAlert(response);
            location.reload();
       
        }
});
 }
 
 function remove_misb(id) {
    
  var amount = id;
  // alert(amount);
   
 $.ajax({
        url: "<?php base_url();?>cart_remove_",
        type: 'POST',
        data: {id: amount},
        success: function (response) {
        showAlert(response);
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