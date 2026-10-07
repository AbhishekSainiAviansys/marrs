 <style> 
	 
	 
	 a#studMatFree-tab {
    background: #0dcaf0;
    border: solid 1px #0d6efd;
	}
a#mockTest-tab {
    background: bisque;
    border: solid 1px;
}
a#competition-tab {
    background: #ffc107;
    border: solid 1px;
}
a#orientation-tab {
    background: #dc3545;
    border: solid 1px;
    color: #fff;
}
a#certificate-tab {
    background: #777d73;
    border: solid 1px;
    color: #fff;
}
a#studMatPaid-tab {
    background: darkseagreen;
    border: solid 1px;
    color: #fff;
}
	 
	 </style>
<?php include "header_profile.php";
//print_r($zoomzoom);
if($student[0]['class_key']==1){
    $state='Kinder Garten Products';
}else{
    $state='Class-1 to Class-12 Products';
}


// echo '<br>';
 //print_r($all_product);



$array_material=array();
foreach($paid_material as $end){
    
    array_push($array_material,$end['product_name']);                            
}
//print_r($array_material);
$array_orientation=array();
foreach($paid_orientation as $end){
    
    array_push($array_orientation,$end['product_name']);                            
}

$array_mocktest=array();
foreach($paid_mocktest as $end){
    
    array_push($array_mocktest,$end['product_name']);                            
}


$array=array();
foreach($free_material as $end){
    
    array_push($array,$end['product_name']);                            
}
//print_r($array);
?>
    <!--<section>-->
    <!--    <div class="container">-->
    <!--        <div class="row text-center my-2 mx-2" id="result">-->
    <!--          <div class="col-12 my-2 mx-2">-->
    <!--            <h2>Student Details</h2>-->
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">CIN</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--            <h3></h3>-->
               
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">Grade</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">Rank</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">Star Speller</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">Best Performer</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          </div>-->
    <!--          <div class="col-sm-12 col-md-6 col-lg-2">-->
    <!--          <div class="card text-center">-->
    <!--            <div class="card-body">-->
    <!--              <h3 class="card-title">Status</h3>-->
    <!--              <h4></h4>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <section>
        <div class="container">
          <div class="row mb-5 my-2" id="reg_download">
            <!--<div class="col-12 mx-2 text-center">-->
            <!--<h3><span style="color:#006699;">Congratulations!! You are qualified to register for</span><span style="color:crimson;"> "National Level"</span><span style="color:#006699;"> Competition..</span></h3>-->
            <!--</div>-->
            
           <h3 style="color:#006699;"><?php echo $state; ?></h3>
             
            <div class="col-sm-12 col-md-8 col-lg-8 my-2">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a href="#studMatPaid-tab" class="nav-link active" id="studMatPaid-tab" data-bs-toggle="tab" data-bs-target="#studMatPaid" type="button" role="tab" aria-controls="studMatPaid" aria-selected="true">Competitions</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a href="#studMatFree-tab" class="nav-link" id="studMatFree-tab" data-bs-toggle="tab" data-bs-target="#studMatFree" type="button" role="tab" aria-controls="studMatFree" aria-selected="false">Study Materials</a>
                      </li>
                      
                      <li class="nav-item" role="presentation">
                        <a href="#mockTest-tab" class="nav-link" id="mockTest-tab" data-bs-toggle="tab" data-bs-target="#mockTest" type="button" role="tab" aria-controls="mockTest" aria-selected="false">Orientations</a>
                      </li>
                      
                      <li class="nav-item" role="presentation">
                        <a href="#competition-tab" class="nav-link" id="competition-tab" data-bs-toggle="tab" data-bs-target="#competition" type="button" role="tab" aria-controls="competition" aria-selected="false">Mock Test</a>
                      </li>
                      
                      
                     
                      <li class="nav-item" role="presentation">
                        <a href="#orientation-tab" class="nav-link" id="orientation-tab" data-bs-toggle="tab" data-bs-target="#orientation" type="button" role="tab" aria-controls="orientation" aria-selected="false">Free Study Material</a>
                      </li>
                      
                     
                      <li class="nav-item" role="presentation">
                        <a href="#certificate-tab" class="nav-link" id="certificate-tab" data-bs-toggle="tab" data-bs-target="#certificate" type="button" role="tab" aria-controls="certificate" aria-selected="false">Certificate</a>
                      </li>
                    
                      
                      
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        
                      <div class="tab-pane fade show active" id="studMatPaid" role="tabpanel" aria-labelledby="studMatPaid-tab">
                          <div class="row">
                              <?php 
                              if(empty($zoomzoom)){
                                  //echo 'ok';
                                  //echo 'c.'.$row['initial'];
                              ?>
                              <?php   foreach($all_product as $row){ ?>
                                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                   <!--<img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">-->
                                   <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name'];?></h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ <?php echo $row['price'];?></a>
                                            
                                          </div>
                                          <div class="card-footer">
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'z.ZZZ';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'z.ZZZ';?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            <!--<input type="text"  class="btn btn-warning btn-sm" id="token_com"  value="<?php //echo 'c.'.$row['initial'];?> " style='display:none;'> -->
                                          </div>
                                    </div>
                                </div>
                                <?php  } ?>
                              <?php 
                                  
                              } 
                              else{
                                  foreach($zoomzoom as $row){
                                  ?>
                                  <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                   <!--<img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">-->
                                   <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name'];?></h5>
                                          </div>
                                          <div class="card-body">
                                              <a href="#" class="card-link">CIN <?php echo $row['cin'];?></a>
                                            <a href="#" class="card-link">Registration Slip</a>
                                             
                                          </div>
                                          
                                          <div class="card-footer">
                                            Download   <a href="<?php echo base_url();?>zoomzoom/zoom_reg_slip/<?php echo $row['cin'];?>" class="btn btn-warning btn-sm" disabled> <i class="fa-solid fa-download" ></i></a>
                                            <!--<a href="#" class="btn btn-danger btn-sm" "><i class="fa-solid fa-trash-can"></i></a>-->
                                          </div>
                                    </div>
                                </div>
                                  
                                  <?php
                                  }
                              
                              } ?> 
                                
                                
                                
                            </div>
                      </div>
                      
                      
                      
                      <div class="tab-pane fade" id="studMatFree" role="tabpanel" aria-labelledby="studMatFree-tab">
                          
                          
                          
                            <div class="row">
                                <?php foreach($all_product as $row){
                              //print_r($row);
                              
                              if(!in_array($row['product_name'], $array_material)){
                                  //echo 'ok';
                                  //echo 's.'.$row['initial'];
                              ?>
                                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                    <div class="card my-2 mx-2 w-100">
                                    <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name'];?> Study Material </h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ <?php echo $row['material'];?></a>
                                          </div>
                                          <div class="card-footer">
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 's.'.$row['initial'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 's.'.$row['initial'];?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
                                          </div>
                                    </div>
                                </div>
                               <?php
                                } 
                              else{
                                  ?>  
                                
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                  <!--<img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                      </div>
                                      <div class="card-body">
                                        <a href="#" class="card-link">Price:  Paid</a>
                                        <a href="#" class="card-link">Available</a>
                                      </div>
                                      <form method='POST' action="<?php echo base_url()?>zoomzoom/paid_material">
                                      <div class="card-footer">
                                        Download <button name='paid' class="btn btn-secondary btn-sm" value='<?php echo $row['product_name']; ?>'><i class="fa-solid fa-download"></i></button>
                                      </div>
                                      </form>
                                </div>
                              </div>
                                  
                                  <?php
                              }
                              
                              } ?> 
                             
                                
                                
                            </div>
                      </div>
                      
                      
                      
                      <div class="tab-pane fade" id="mockTest" role="tabpanel" aria-labelledby="mockTest-tab">
                          <div class="row">
                              <?php foreach($all_product as $row){
                              //print_r($row);
                              
                              if(!in_array($row['product_name'], $array_orientation)){
                                  //echo 'ok';
                                  //echo 's.'.$row['initial'];
                              ?>
                              
                              
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                          <!--<img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>-->
                                          <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name']; ?> Orientation </h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ <?php echo $row['orientation']; ?></a>
                                            
                                          </div>
                                          <div class="card-footer">
                                              
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'o.'.$row['initial'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'o.'.$row['initial'];?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
                                          </div>
                                    </div>
                                </div>
                                <?php
                                } 
                              else{
                                  //print_r($row);
                                  ?>  
                                  <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                  <!--<img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                      </div>
                                      <div class="card-body">
                                        <a href="#" class="card-link">Price:  Paid</a>
                                        <a href="#" class="card-link">Orientation Slip</a>
                                      </div>
                                      <div class="card-footer">
                                        Download <a href="<?php echo base_url();?>zoomzoom/zoom_ori_slip/<?php echo $row['product_name']; ?>" class="btn btn-secondary btn-sm" ><i class="fa-solid fa-download"></i></a>
                                      </div>
                                </div>
                              </div>
                                  
                                  <?php
                              }
                              
                              } ?> 
                                
                              
                                
                          </div>
                      </div>
                      
                      <div class="tab-pane fade" id="competition" role="tabpanel" aria-labelledby="competition-tab">
                          
                          <div class="row">
                              <?php
                              foreach($all_product as $row){
                              //print_r($row);
                              
                             if(!in_array($row['product_name'], $array_mocktest)){
                                  //echo 'ok';
                                  //echo 's.'.$row['initial'];
                              ?>
                              
                              
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                          <!--<img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>-->
                                          <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name']; ?> Mock Test </h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ <?php echo $row['mock_test']; ?></a>
                                            
                                          </div>
                                          <div class="card-footer">
                                              
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'm.'.$row['initial'];?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'm.'.$row['initial'];?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
                                          </div>
                                    </div>
                                </div>
                                <?php
                                } 
                             else{
                                  ?>  
                                  <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                  <!--<img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                      </div>
                                      <div class="card-body">
                                        <a href="#" class="card-link">Price:  Paid</a>
                                        <a href="#" class="card-link">Mock Test Slip</a>
                                      </div>
                                      <div class="card-footer">
                                        Download <button class="btn btn-secondary btn-sm" disabled><i class="fa-solid fa-download"></i></button>
                                      </div>
                                </div>
                              </div>
                                  
                                  <?php
                              }
                              
                              } ?> 
                                
                              
                                
                          </div>
                      </div>
                      
                      
                      <div class="tab-pane fade" id="orientation" role="tabpanel" aria-labelledby="orientation-tab">
                          <div class="row">
                            
                            
                              
  <?php foreach($all_product as $row){
                              //print_r($array_material);
                              
                             // if(!in_array($row['product_name'], $array_material)){
                                  //echo 'ok';
                                  //echo 's.'.$row['initial'];
                              ?>
                              
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                  <!--<img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?> Study Material</h5>
                                      </div>
                                      <div class="card-body">
                                        <a href="#" class="card-link">Price:  Free</a>
                                        
                                      </div>
                                      <form method='POST' action="<?php echo base_url()?>zoomzoom/free_material">
                                      <div class="card-footer">
                                        Download <button name='free' class="btn btn-secondary btn-sm" value='<?php echo $row['product_name']; ?>'><i class="fa-solid fa-download"></i></button>
                                      </div>
                                      </form>
                                </div>
                              </div>
                              
                              <?php 
                              }?>
                              
                              
                          </div>
                      </div>
                      
                      
                      
                      <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                          <div class="row">
                             
                              <?php 
                              
                              foreach($zoomzoom as $row){
                           
                              ?>
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                 
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['product_name']; ?> Provisional Certificate</h5>
                                      </div>
                                      <div class="card-body">
                                      
                                        
                                      </div>
                                      
                                      
                                      <form method='POST' action="<?php echo base_url()?>zoomzoom/zoomcertificate">
                                      <div class="card-footer">
                                            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                          <input type="hidden" name="cin" value="<?php echo $row['cin']; ?>">
                                        Download <button name='submit' class="btn btn-secondary btn-sm" ><i class="fa-solid fa-download"></i></button>
                                      </div>
                                      </form>
                                      
                                   
                                </div>
                              </div>
                              
                              <?php //}
                              }?>
                              
                              
                          </div>
                      </div>
                      
                      
                      
                      
                    </div>
                    
                    
                </div>
              
              
              
              
            </div>
          </div>
          <div class="col-sm-12 col-md-4 col-lg-4 my-2">

          <div class="card w-100 p-0 mt-2" id="itemCart">
              <?php $prid = $this->session->userdata('id');
               $res_class = $this->db->get_where('student_to_zoomzoom',array('zoomzoom_prid' =>$prid))->row();
                   $res = $this->db->get_where('zoomzoom_amount_cart',array('prid' =>$prid))->result_array();
				   //print_r($res);exit;
                   $amount_total=0;
                   $count=0;
                   foreach($res as $value){
                       //print_r($value['amount']);
                       $amount_total  = $value['amount']+$amount_total;
                       $count=$count+1;
                       
                       $productname =$value['token'];
                       if($productname=='z.ZZZ'){
                           $marrproduct = 'MaRRS Play2Learn <br/> MaRRS Preschool Bee Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-1' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-2' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       
                       if($productname=='z.ZZZ' && $res_class->class=='Class-3' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-4' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-5' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-6' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-7' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }if($productname=='z.ZZZ' && $res_class->class=='Class-8' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                       if($productname=='z.ZZZ' && $res_class->class=='Class-9' ){
                           $marrproduct = 'MaRRS International Math Bee <br/> MaRRS Xpress Math <br/> MaRRS ZoomZoom';
                       }
                        
                       // Study Materials
                       
                       if($productname=='s.P2L'){
                           $study_mat_p2l = 'MaRRS Play2Learn Study Material';
                       }if($productname=='s.PBM'){
                           $study_mat_pbm = 'MaRRS Preschool Bee Math Study Material';
                       }if($productname=='s.ZZZ'){
                           $study_mat_zz = 'MaRRS ZoomZoom Study Material';
                       }if($productname=='s.IMB'){
                           $study_mat_imb = 'MaRRS International Math Bee';
                       }
                       if($productname=='s.XPM'){
                           $study_mat_xpm = 'MaRRS Xpress Math';
                       }
                       
                       // Orientation 
                       
                        if($productname=='o.P2L'){
                           $orientation_p2l = 'MaRRS Play2Learn Orientation';
                       }if($productname=='o.PBM'){
                           $orientation_pbm = 'MaRRS Preschool Bee Math Orientation';
                       }if($productname=='o.ZZZ'){
                           $orientation_zz = 'MaRRS ZoomZoom Orientation';
                       }if($productname=='o.IMB'){
                           $orientation_imb = 'MaRRS International Math Bee Orientation';
                       }
                       if($productname=='o.XPM'){
                           $orientation_xpm = 'MaRRS Xpress Math Orientation';
                       }
                       
                        // Mock Test 
                       
                        if($productname=='m.P2L'){
                           $mocktest_p2l = 'MaRRS Play2Learn Mock Test';
                       }if($productname=='m.PBM'){
                           $mocktest_pbm = 'MaRRS Preschool Bee Math Mock Test';
                       }if($productname=='m.ZZZ'){
                           $mocktest_zz = 'MaRRS ZoomZoom Mock Test';
                       }if($productname=='m.IMB'){
                           $mocktest_imb = 'MaRRS International Math Bee Mock Test';
                       }
                       if($productname=='m.XPM'){
                           $mocktest_xpm = 'MaRRS Xpress Math Mock Test';
                       }
                       
                       
                       
                       
                       
                       
                       
                   }
                   //echo $amount_total;
                   ?>
            <div class="card-header bg-danger p-3 text-white text-center text-secondary">
              <b>Items Added To Cart</b>
            </div>
            <ul class="list-group list-group-flush">
              <li style="border:none" class="list-group-item"> <?php if(!empty($marrproduct)){ echo $marrproduct.'<hr>'; }else{ echo ''; }
              ?></li>
            <li style="border:none" class="list-group-item">
                 <?php if(!empty($study_mat_p2l)){ echo $study_mat_p2l.'<br/>';}else{ echo  '';}?>
                 <?php if(!empty( $study_mat_pbm)){echo $study_mat_pbm.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($study_mat_zz)){echo $study_mat_zz.'<br/>';  }else{ echo ''; }?>
                 <?php if(!empty( $study_mat_imb)){echo $study_mat_imb.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($study_mat_xpm)){echo $study_mat_xpm.'<hr>';  }else{ echo ''; }?>
                 
            </li>
            <li style="border:none" class="list-group-item">
                 <?php if(!empty($orientation_p2l)){ echo $orientation_p2l.'<br/>';}else{ echo  '';}?>
                 <?php if(!empty( $orientation_pbm)){echo $orientation_pbm.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($orientation_zz)){echo $orientation_zz.'<br/>';  }else{ echo ''; }?>
                  <?php if(!empty( $orientation_imb)){echo $orientation_imb.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($orientation_xpm)){echo $orientation_xpm.'<hr>';  }else{ echo ''; }?>
            </li>
             <li style="border:none" class="list-group-item">
                 <?php if(!empty($mocktest_p2l)){ echo $mocktest_p2l.'<br/>';}else{ echo  '';}?>
                 <?php if(!empty( $mocktest_pbm)){echo $mocktest_pbm.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($mocktest_zz)){echo $mocktest_zz.'<br/>';  }else{ echo ''; }?>
                  <?php if(!empty( $mocktest_imb)){echo $mocktest_imb.'<br/>';}else{ echo '';}?>
                 <?php if(!empty($mocktest_xpm)){echo $mocktest_xpm;  }else{ echo ''; }?>
            </li>

            </ul>
         
             <form method='post' action="<?php echo base_url()?>razorpay/zoompay">
            <div class="card-body text-end">
              <a href="#" class="card-link">Total Amount (INR)</a>
              <br/>
              <a href="#" class="card-link"> ₹ <?php echo $amount_total;?></a>
              <input type="hidden" name="amount" value="<?php echo $amount_total;?>">
               <input type="hidden" name="prid" value="<?php echo $prid;?>">

               <input type="hidden" name="name" value="<?php echo $student[0]['first_name'].$student[0]['last_name'];?>">
                <input type="hidden" name="email" value="<?php echo $student[0]['email'];?>">
                <input type="hidden" name="contact" value="<?php echo $student[0]['mobile'];?>">
            </div>
               <?php  if($amount_total>0){ ?>
            <div class="card-footer text-end">
              <button type='submit' class="btn btn-outline-danger" name=''>Proceed To Pay </button>
            </div>
             <?php }?>
            </form>
           
          </div>
         
         
         
         
         
          </div>
        <div class="col-sm-12 col-md-12 col-lg-12 text-center my-2">
            <div class="card my-2 p-2">
                <div class="card-body">
                    <div class="row text-center">
                    <form method='POST'>
                        <img src="https://img.icons8.com/bubbles/100/null/confetti.png"/>
                        <h4 style="font-size:1.2rem;"><b>Hurrah!!!!! .. </b></h4>
                        <p class="card-text text-center"> Once you purchase zoom zoom.<br/>
You are qualified to participate in following products:<br> 
<?php 
$i=1;
foreach($all_product as $row)
{
    echo '<b>'.$i.'-</b>'.$row['product_name'].'<b>,</b> ';
    $i=$i+1;
} ?>
</p>
<p>Your PRID is the username and password for logging in.</p>
                
                    </form>
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
<script>
function misb(id) {
    var token = id;
 // var amount = id;
 // var token = $('#token_com').val();
 //  alert(token);
   
 $.ajax({
        url: "<?php base_url();?>net_abc",
        type: 'POST',
        data: {id: token},
        success: function (response) {
         //lert(response);
        location.reload();
        }
});
 }
 
 function remove_misb(id) {
    
  var token = id;
   //alert(token);
   //var token = $('#token_com').val();
 $.ajax({
        url: "<?php base_url();?>remove_misb",
        type: 'POST',
        data: {id:token},
        success: function (response) {
        //alert(response);
        location.reload();
        }
});
 }
 

</script>

    
    
    
<?php include "footer.php"?>
