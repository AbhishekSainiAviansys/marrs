<?php include('header.php');
//print_r($material_free_c);
        
 //print_r($activate[0]);
//print_r($material_free);
//print_r($material_paid);
//print_r($price);
 //echo 'ok';die;

//   echo $combo1.'ko';
//   echo $combo2.'pkk';
//   echo $combo3.'jj';
//   echo $combo4.'hi';

if (strpos($this->session->userdata('cin'), '24MZ') === 0) {
    $product_name = 'MaRRS Math Zoom Zoom Challenge';
    // $clevel = 14;
    
}
  
if (strpos($this->session->userdata('cin'), '25MZ') === 0) {
    $product_name = 'MaRRS Math Zoom Zoom Challenge';
    // $clevel = 14;
    
}  
if (strpos($this->session->userdata('cin'), '23MZ') === 0) {
    $product_name = 'MaRRS Math Zoom Zoom Challenge';
    // $clevel = 14;
    
}
   
//   echo 'ok';die;
   
   $res = $this->db->get_where('competition_level_byproduct',array('level_id' =>$clevel,'product_name' =>$result['product_name']))->row();
//   echo $this->db->last_query();
		$nlev=$res->level_name;$level_id=$res->level_id;
//print_r($res);


$ressss = $this->db->get_where('competition_level_byproduct',array('level_id' =>$result['clevel'],'product_name' =>$result['product_name']))->row();
		$lev_name=$ressss->level_name;

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

    .cart-container {
            position: fixed;
            right: 10px;
            bottom: 70%;
            z-index: 1000;
            left: 77%;
        }

    #cartBtn {
            background-color: #17a2b8;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            text-decoration: none;
        }
    
    #cartBtn:hover {
            background-color: #138496;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

    #cartCount {
            font-weight: bold;
        }
        
    .row>* {
            flex-shrink: 0;
            width: 25%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x)* .5);
            padding-left: calc(var(--bs-gutter-x)* .5);
            margin-top: var(--bs-gutter-y);
        }
        
    .row {
            /* --bs-gutter-x: -5.5rem; */
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1* var(--bs-gutter-y));
            margin-right: calc(-.5* var(--bs-gutter-x));
            margin-left: calc(-.5* var(--bs-gutter-x));
        }
        
    .modal {
    display: none; 
    z-index: 999; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    background-color: rgba(0, 0, 0, 0.5);
}

    .modal-content {
    background-color: white;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Adjust this to control the modal width */
    max-width: 600px; /* Maximum width to keep it responsive */
    position: absolute;
    top: 50%; 
    left: 50%;
    transform: translate(-50%, -50%); /* Center horizontally and vertically */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

    .close {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #aaa;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

    .close:hover, .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

    .modal h4 {
    margin-top: 0;
}

    #checkoutButton {
    margin-top: 20px;
    width: 100%;
}

    @media screen and (max-width: 768px) {
    .modal-content {
        width: 90%;
    }
}
.card-title{
        font-size: larger;
}

</style>

   
    <section>
        <div id="productWrapper" class="container">
            
            <div class="text-start">                
                <a href="<?php echo base_url();?>Cin_login/index" class="btn btn-outline-secondary btn-sm text-start"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>  
                </div>
                
            <?php if(!empty($result)){?>
                <div class="row text-center my-2 mx-2" id="result">
                
              <div class="col-12 my-2 mx-2">
                <h2><?php echo $lev_name; ?> RESULT</h2>
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
                  <h4><?php if($result['speller']){echo $result['speller'];}else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Best Performer</h3>
                  <h4><?php if($result['performer']){echo $result['performer'];}else{echo '-';} ?></h4>
                </div>
              </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-2">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Status</h3>
                  <h4><?php
                  if($result['show']=='skip'){
                      echo 'Promoted';
                  }else{
                  echo $result['status']; 
                  }
                  
                  ?></h4>
                </div>
              </div>
              </div>
            </div>
            
            <?php }else{?>
            <div class='text-center'><h5> Results will be announced soon! </h5></div><?php } ?>
        </div>
    </section>

    <section style='padding-bottom:110px;'>
        <div class="container col">

            <div class="row" id="reg_download">
                
                
                <?php 
               
                if(empty($result)){ ?>
                            <?php 
                            // print_r($result);
                                if($product_name ==''){
                                    
                                    $substring = substr($this->session->userdata('cin'), 2, 2);
                                 
                                    $product= $this->db->get_where('products',array('in13' =>$substring))->row();
                                    
                                    
                                    $material_free_a= $this->db->get_where('study_material',array('clevel' =>'1','status'=>'Free','type'=>'A','product_name'=>$product->product_name,'class'=>$student['class']))->row();
                                    $material_free_b= $this->db->get_where('study_material',array('clevel' =>'1','status'=>'Free','type'=>'B','product_name'=>$product->product_name,'class'=>$student['class']))->row();
                                    $material_free_c= $this->db->get_where('study_material',array('clevel' =>'1','status'=>'Free','type'=>'C','product_name'=>$product->product_name,'class'=>$student['class']))->row();
                                
                                    
                                }else{
                                    
                                    
                                    if ($product_name == 'MaRRS Math Zoom Zoom Challenge') {
                                        $material_free_a = $this->db->get_where('study_material', array('clevel' => '14', 'status' => 'Free', 'type' => 'A', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_b = $this->db->get_where('study_material', array('clevel' => '14', 'status' => 'Free', 'type' => 'B', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_c = null; // no 'C' type defined for this product
                                    
                                    } elseif ($product_name == 'MaRRS Math, English & Science Attainment Test') {
                                        $material_free_a = $this->db->get_where('study_material', array('clevel' => '35', 'status' => 'Free', 'type' => 'A', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_b = $this->db->get_where('study_material', array('clevel' => '35', 'status' => 'Free', 'type' => 'B', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_c = $this->db->get_where('study_material', array('clevel' => '35', 'status' => 'Free', 'type' => 'C', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                    
                                    } else {
                                        $material_free_a = $this->db->get_where('study_material', array('clevel' => '1', 'status' => 'Free', 'type' => 'A', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_b = $this->db->get_where('study_material', array('clevel' => '1', 'status' => 'Free', 'type' => 'B', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                        $material_free_c = $this->db->get_where('study_material', array('clevel' => '1', 'status' => 'Free', 'type' => 'C', 'product_name' => $product_name, 'class' => $student['class']))->row();
                                    }
                                                                    
                                    
                                }
                             
                            ?>
                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                                    <input type='text' name='product' value='<?php echo $material_free_a->product_name; ?>' style='display:none;' >
                                                                    <input type='text' name='class' value='<?php echo $material_free_a->class; ?>' style='display:none;' >
                                                                    <input type='text' name='clevel' value='<?php echo $material_free_a->clevel; ?>' style='display:none;' >
                                                                    <input type='text' name='period' value='<?php echo $material_free_a->period; ?>' style='display:none;' >
                                                                    <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                                    <input type='text' name='type' value="<?php echo 'A'; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material A - <span class="text-success">Free</span></h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free</a>
                                                                        <?php if(!empty($material_free_a)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Not Applicable for this level.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_a)){ ?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                            <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                            <input type='text' name='product' value='<?php echo $material_free_b->product_name; ?>' style='display:none;' >
                                                            <input type='text' name='class' value='<?php echo $material_free_b->class; ?>' style='display:none;' >
                                                            <input type='text' name='clevel' value='<?php echo $material_free_b->clevel; ?>' style='display:none;' >
                                                            <input type='text' name='period' value='<?php echo $material_free_b->period; ?>' style='display:none;' >
                                                            <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                            <input type='text' name='type' value="<?php echo 'B'; ?>" style='display:none;' >
                                                            <div class="card-body">
                                                                <h5 class="card-title">Study Material B - <span class="text-success">Free</span></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <a href="#" class="card-link">Price: Free </a>
                                                                <?php if(!empty($material_free_b)){?>
                                                                <a href="#" class="card-link">Available</a>
                                                                <?php }else{ echo 'Not Applicable for this level.'; }?>
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
                                                    
                                                    
                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                            <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                            <input type='text' name='product' value='<?php echo $material_free_c->product_name; ?>' style='display:none;' >
                                                            <input type='text' name='class' value='<?php echo $material_free_c->class; ?>' style='display:none;' >
                                                            <input type='text' name='clevel' value='<?php echo $material_free_c->clevel; ?>' style='display:none;' >
                                                            <input type='text' name='period' value='<?php echo $material_free_c->period; ?>' style='display:none;' >
                                                            <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                            <input type='text' name='type' value="<?php echo 'C'; ?>" style='display:none;' >
                                                            <div class="card-body">
                                                                <h5 class="card-title">Study Material C - <span class="text-success">Free</span></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <a href="#" class="card-link">Price: Free </a>
                                                                <?php if(!empty($material_free_c)){?>
                                                                <a href="#" class="card-link">Available</a>
                                                                <?php }else{ echo 'Not Applicable for this level.'; }?>
                                                            </div>
                                                            <div class="card-footer p-1">
                                                                <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                <?php if(!empty($material_free_c)){?>
                                                                <!--<a href="#" class="card-link">Available</a>-->
            
                                                                <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                          <?php } ?> 
                                                               
                                                                <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                            </div>
                                                        </form>
                                                        </div>
                                                
                                                    </div>
                                                    
                                            <?php if($oron=='yes'){
                                            // print_r($ori_act);
                                            
                                            
                                            
                                            $orietation= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$ori_act->con_id,'orientation'=>'yes'))->row();
                                            $mock= $this->db->get_where('orientation_school_cart',array('cin' =>$this->session->userdata('cin'),'con_id'=>$ori_act->con_id,'mock'=>'yes'))->row();
                                                                     
                                            
                                            ?>    
                                            
                                            <div class="cart-container">
                                                <a href="#" class="btn btn-info btn-sm" onClick="loadCartCount();" id="cartBtn">
                                                    Cart (<span id="cartCount">0</span>)
                                                </a>
                                            </div>
                                            
                                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/?size=100&id=HOaunZsdV3cV&format=png&color=000000" class="img-fluid d-block mx-auto w-50"/>
                                                            <form method='post'>
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Purchase Orientation-Mock</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <!--<href class='btn btn-primary' onClick="hello();" >Hello</href>-->
                                                                    <?php if (!empty($ori_act->price)) { ?>
                                                                        <a href="#" class="card-link"><?php echo 'Orientation Price: ' . $ori_act->price; ?></a><br>
                                                                    <?php } ?>
                                                                    <?php if (!empty($ori_act->mock_price)) { ?>
                                                                        <a href="#" class="card-link"><?php echo 'Mock Price: ' . $ori_act->mock_price; ?></a>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="card-footer p-1">
                                                                    <div class="product-buttons">
                                                                        <?php if (empty($orietation)) { ?>
                                                                            <a href="#" class="btn btn-warning btn-sm" 
                                                                            onClick="addToCart('<?php echo $ori_act->con_id; ?>', 'orientation');" 
                                                                                
                                                                                
                                                                            >
                                                                                Orientation <i class="fa-solid fa-cart-plus"></i>
                                                                            </a>
                                                                        <?php } else { ?> 
                                                                            <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm">
                                                                                <i class="fa-solid fa-download"></i>
                                                                            </button>
                                                                        <?php } ?>
                                                    
                                                                        <?php if (empty($mock)) { ?>
                                                                            <a href="#" class="btn btn-warning btn-sm" onClick="addToCart('<?php echo $ori_act->con_id; ?>', 'mock');">
                                                                                Mock <i class="fa-solid fa-cart-plus"></i>
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1">
                                                                                <i class="fa-solid fa-download"></i>
                                                                            </a>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>          
                                            
                                            <?php }else{
                                                if($oron=='no'){
                                                    echo '';
                                                }
                                                
                                            } ?>
                                            
                
                <?php }else{ ?>
                
                                            <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                                    
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                                <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                                    <input type='text' name='product' value='<?php echo $material_free_a->product_name; ?>' style='display:none;' >
                                                                    <input type='text' name='class' value='<?php echo $material_free_a->class; ?>' style='display:none;' >
                                                                    <input type='text' name='clevel' value='<?php echo $material_free_a->clevel; ?>' style='display:none;' >
                                                                    <input type='text' name='period' value='<?php echo $material_free_a->period; ?>' style='display:none;' >
                                                                    <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                                    <input type='text' name='type' value="<?php echo 'A'; ?>" style='display:none;' >
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Study Material A - <span class="text-success">Free</span></h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <a href="#" class="card-link">Price: Free</a>
                                                                        <?php if(!empty($material_free_a)){?>
                                                                        <a href="#" class="card-link">Available</a>
                                                                        <?php }else{ echo 'Not Applicable for this level.'; }?>
                                                                    </div>
                                                                    <div class="card-footer p-1">
                                                                        <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                        <?php if(!empty($material_free_a)){ ?>
                                                                        <!--<a href="#" class="card-link">Available</a>-->
                    
                                                                        <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                                  <?php } ?> 
                                                                       
                                                                        <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                    </div>
                                                                </form>
                                                                </div>
                                                        
                                                            </div>
                                                
                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                            <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                            <input type='text' name='product' value='<?php echo $material_free_b->product_name; ?>' style='display:none;' >
                                                            <input type='text' name='class' value='<?php echo $material_free_b->class; ?>' style='display:none;' >
                                                            <input type='text' name='clevel' value='<?php echo $material_free_b->clevel; ?>' style='display:none;' >
                                                            <input type='text' name='period' value='<?php echo $material_free_b->period; ?>' style='display:none;' >
                                                            <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                            <input type='text' name='type' value="<?php echo 'B'; ?>" style='display:none;' >
                                                            <div class="card-body">
                                                                <h5 class="card-title">Study Material B - <span class="text-success">Free</span></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <a href="#" class="card-link">Price: Free </a>
                                                                <?php if(!empty($material_free_b)){?>
                                                                <a href="#" class="card-link">Available</a>
                                                                <?php }else{ echo 'Not Applicable for this level.'; }?>
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
                                                    
                                                    
                                                    <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                                        <div class="card my-2 mx-2 p-1 w-100">
                                                            <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid d-block mx-auto w-50"/>
                                                            <form method='post' action="<?php echo base_url()?>cin_login/free_material_" >
                                                                <input type='text' name='product' value='<?php echo $material_free_c->product_name; ?>' style='display:none;' >
                                                                <input type='text' name='class' value='<?php echo $material_free_c->class; ?>' style='display:none;' >
                                                                <input type='text' name='clevel' value='<?php echo $material_free_c->clevel; ?>' style='display:none;' >
                                                                <input type='text' name='period' value='<?php echo $material_free_c->period; ?>' style='display:none;' >
                                                                <input type='text' name='status' value="<?php echo 'Free'; ?>" style='display:none;' >
                                                                <input type='text' name='type' value="<?php echo 'C'; ?>" style='display:none;' >
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Study Material C - <span class="text-success">Free</span></h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <a href="#" class="card-link">Price: Free </a>
                                                                    <?php if(!empty($material_free_c)){?>
                                                                    <a href="#" class="card-link">Available</a>
                                                                    <?php }else{ echo 'Not Applicable for this level.'; }?>
                                                                </div>
                                                                <div class="card-footer p-1">
                                                                    <a href="#" class="btn btn-warning btn-sm my-1"> Free Material</a>
                                                                    <?php if(!empty($material_free_c)){?>
                                                                    <!--<a href="#" class="card-link">Available</a>-->
                
                                                                    <button type="submit" name="download_free" id="download_free" class="btn btn-secondary btn-sm " ><i class="fa-solid fa-download"></i></button>
                                                                                                                              <?php } ?> 
                                                                   
                                                                    <!--<a href="#" type="submit" name="download_free" class="btn btn-secondary btn-sm my-1"><i class="fa-solid fa-download"></i></a>-->
                                                                </div>
                                                            </form>
                                                        </div>
                                                
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                <?php 
                    
                } 
                
                
                $res = $this->db->get_where('cin_result',array('cin'=>$_SESSION['cin']))->row_array();
	   
                if($res['clevel'] == 1){
                
                    $mock_papers = $this->db->get_where('mock_papers',array('product_name' =>$res['product_name'], 'clevel'=>$res['clevel'],'pay_status'=>'Free','period_id'=>$res['period_id'],'class'=>$student['class']))->result();
                    
                    foreach($mock_papers as $ori_act){
                        // print_r($ori_act);
                        ?>
                                <div class="col-sm-12 col-md-6 col-lg-3 "> 
                                            
                                    <div class="card my-2 mx-2 p-1 w-100">
                                        <img src="https://img.icons8.com/?size=100&id=HOaunZsdV3cV&format=png&color=000000" class="img-fluid d-block mx-auto w-50"/>
                                      
                                            
                                            <div class="card-body">
                                                <h5 class="card-title">Mock Paper</h5>
                                            </div>
                                            <div class="card-body">
                                                    <h5 class="card-link"><?php echo 'Price: Free '. $ori_act->type; ?></h5>
                                                
                                                <!--<h5 class="card-title"><?php echo 'Type: ' . $ori_act->type; ?></h5>-->
                                                
                                                   
                                            </div>
                                            <div class="card-footer p-1">
                                                <div class="product-buttons">
                                                   
                                                       
                                                    <!--<a href="https://marrs.in/mock_papers<?php echo '/'.$ori_act->folder1; ?>" target='_BLANK' type="submit" name="download_free" class="btn btn-secondary btn-sm my-1">-->
                                                    <!--    <i class="fa-solid fa-download"></i> File-1-->
                                                    <!--</a>-->
                                                    
                                                    <!--<a href="https://marrs.in/mock_papers<?php echo '/'.$ori_act->folder2; ?>" target='_BLANK' type="submit" name="download_free" class="btn btn-secondary btn-sm my-1">-->
                                                    <!--    <i class="fa-solid fa-download"></i> File-2-->
                                                    <!--</a>-->
                                                    
                                                    <a href="https://marrs.in/mock_papers/<?= $ori_act->folder1; ?>"
                                                       download
                                                       class="btn btn-secondary btn-sm my-1">
                                                        <i class="fa-solid fa-download"></i> File-1
                                                    </a>
                                                    
                                                    <a href="https://marrs.in/mock_papers/<?= $ori_act->folder2; ?>"
                                                       download
                                                       class="btn btn-secondary btn-sm my-1">
                                                        <i class="fa-solid fa-download"></i> File-2
                                                    </a>
                                                    
                                                    
                                                </div>
                                            </div>
                                    
                                    </div>
                            
                                </div>
                        
                        <?php
                    }
                }
                
                ?>
                
                
                
                
                
                
                
                
            </div>

        </div>     
                
    </section>
    
    <div class="overlay" id="overlay"></div>
    
    <div class="custom-alert" id="custom-alert">
        <h5 id="alert-message" style='color:#4d79ff;'></h5>
    </div>

    <div id="cartModal" class="modal ">
    <div class="modal-content">
        <span class="close" onClick="closeCartModal()">&times;</span>
        <h4>Purchase Program Cart</h4>
        <div id="cartItems"></div>
        <div>Total: Rs. <span id="cartTotalAmount">0</span></div>
        <button id="checkoutButton" class="btn btn-success">Pay Now</button>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <div class="toast" id="myToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Notification</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        <!-- Toast message goes here -->
    </div>
</div>
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer" ></script>
    
    
<script>
    $(document).ready(function() {
        loadCartCount(); 

        $('#cartBtn').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?php echo base_url("/Cin_login/get_cart_items"); ?>',
                type: 'GET',
                success: function(response) {
                    var cartData = JSON.parse(response);
                    displayCartData(cartData);
                    openCartModal();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading cart data: ', status, error);
                }
            });
        });

        function displayCartData(response) {
            var cartData = response.cartData;
            var cartItemsDiv = $('#cartItems');
            var totalAmount = 0;
            cartItemsDiv.empty(); 
        
            if (!response.status || cartData.length === 0) {
                cartItemsDiv.html('<p>Your cart is empty.</p>');
                $('#checkoutButton').hide(); 
            } else {
                var tableHtml = `
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;

            cartData.forEach(function(item) {
                var itemType = item.details;
    
                var amount = parseFloat(item.price);
                if (isNaN(amount) || amount <= 0) {
                    amount = 0; 
                }

                tableHtml += `
                    <tr>
                        <td>${itemType}</td>
                        <td>Rs. ${amount.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-outline-danger btn-sm remove-from-cart" data-item-id="${item.id}">
                                Remove
                            </button>
                        </td>
                    </tr>
                `;
                totalAmount += amount;
            });

            tableHtml += `</tbody></table>`;
            cartItemsDiv.html(tableHtml);
            $('#cartTotalAmount').text(totalAmount.toFixed(2));
            $('#checkoutButton').show(); 
        }

        $('.remove-from-cart').on('click', function() {
            var itemId = $(this).data('item-id');
            $.ajax({
                url: '<?php echo base_url("/Cin_login/remove_ori_cart"); ?>',
                type: 'POST',
                data: { id: itemId },
                success: function(response) {
                    var updatedCartData = JSON.parse(response);
                    loadCartCount(); 
                    showToaster("Item removed from cart."); 
                    displayCartData(updatedCartData);
                    
                    $('#cartModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Error removing item: ', status, error);
                }
            });
        });
    }

        function showToaster(message) {
            var toaster = $('<div class="toaster">' + message + '</div>');
            $('body').append(toaster);
            toaster.fadeIn(400).delay(3000).fadeOut(400, function() {
                $(this).remove();
            });
        }
        
        $('#checkoutButton').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission or behavior
        
            // Redirect to the Razorpay payment page
            window.location.href = '<?php echo base_url("/Razorpay/pay6"); ?>';
        });
    });

    function addToCart(productId, productType) {
        $.ajax({
            url: '<?php echo base_url("/Cin_login/add_ca"); ?>',
            type: 'POST',
            data: { id: productId, type: productType },
            success: function(response) {
            console.log('Add to cart response:', response);  // Debug response
            loadCartCount();  
            showToaster("Item added to cart successfully.");
                },
                error: function(xhr, status, error) {
                    console.error('Error adding to cart: ', status, error);
                }
        });
    }

    function openCartModal() {
        document.getElementById("cartModal").style.display = "block";
    }

    function closeCartModal() {
        document.getElementById("cartModal").style.display = "none";
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        var modal = document.getElementById("cartModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    function loadCartCount() {
            $.ajax({
                url: '<?php echo base_url('/Cin_login/count_cart'); ?>',
                type: 'GET',
                success: function(response) {
                    $('#cartCount').text(response.trim());
                },
                error: function(xhr, status, error) {
                    console.error('Error loading cart count: ', status, error);
                }
            });
        }
</script>


<script>
    // Open modal
    function openCartModal() {
        document.getElementById("cartModal").style.display = "block";
    }

    // Close modal
    function closeCartModal() {
        document.getElementById("cartModal").style.display = "none";
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        var modal = document.getElementById("cartModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    
</script>


<?php include("footer.php");?>