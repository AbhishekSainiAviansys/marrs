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
//print_r($cart);
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

$id= $this->session->userdata('id');
?>
  
    <section>
        <div class="container">
          <div class="row mb-5 my-2" id="reg_download">
            <!--<div class="col-12 mx-2 text-center">-->
            <!--<h3><span style="color:#006699;">Congratulations!! You are qualified to register for</span><span style="color:crimson;"> "National Level"</span><span style="color:#006699;"> Competition..</span></h3>-->
            <!--</div>-->
            
           <h3 style="color:#006699;"><?php //echo $state; ?>Welcome To MaRRS Zoomzoom Chellange - NATIONAL_PRELIMS_Q1.</h3><h4>Participate in Competition and start your math's voyage now.</h4>
             
            <div class="col-sm-12 col-md-8 col-lg-8 my-2">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a href="#studMatPaid-tab" class="nav-link active" id="studMatPaid-tab" data-bs-toggle="tab" data-bs-target="#studMatPaid" type="button" role="tab" aria-controls="studMatPaid" aria-selected="true">Competitions</a>
                      </li>
                      <!--<li class="nav-item" role="presentation">-->
                      <!--  <a href="#studMatFree-tab" class="nav-link" id="studMatFree-tab" data-bs-toggle="tab" data-bs-target="#studMatFree" type="button" role="tab" aria-controls="studMatFree" aria-selected="false">Study Materials</a>-->
                      <!--</li>-->
                      
                      <li class="nav-item" role="presentation">
                        <a href="#mockTest-tab" class="nav-link" id="mockTest-tab" data-bs-toggle="tab" data-bs-target="#mockTest" type="button" role="tab" aria-controls="mockTest" aria-selected="false">Orientations</a>
                      </li>
                      
                      <li class="nav-item" role="presentation">
                        <a href="#competition-tab" class="nav-link" id="competition-tab" data-bs-toggle="tab" data-bs-target="#competition" type="button" role="tab" aria-controls="competition" aria-selected="false">Mock Test</a>
                      </li>
                      
                      
                     
                      <!--<li class="nav-item" role="presentation">-->
                      <!--  <a href="#orientation-tab" class="nav-link" id="orientation-tab" data-bs-toggle="tab" data-bs-target="#orientation" type="button" role="tab" aria-controls="orientation" aria-selected="false">Free Study Material</a>-->
                      <!--</li>-->
                      
                     
                      <!--<li class="nav-item" role="presentation">-->
                      <!--  <a href="#certificate-tab" class="nav-link" id="certificate-tab" data-bs-toggle="tab" data-bs-target="#certificate" type="button" role="tab" aria-controls="certificate" aria-selected="false">Certificate</a>-->
                      <!--</li>-->
                    
                      
                      
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        
                      <div class="tab-pane fade show active" id="studMatPaid" role="tabpanel" aria-labelledby="studMatPaid-tab">
                          <div class="row">
                              <?php 
                              if(!empty($zoomzoom)){
                                  //echo 'ok';
                                  //echo 'c.'.$row['initial'];
                              ?>
                              <?php   if(!empty($cart)){ ?>
                                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                   <!--<img src="https://img.icons8.com/bubbles/100/000000/storytelling.png" class="img-fluid" alt="...">-->
                                   <img src="https://img.icons8.com/bubbles/100/000000/trophy.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $cart['product_name'];?></h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ <?php echo $cart['product_price'];?></a>
                                            
                                          </div>
                                          <div class="card-footer">
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'c';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'c';?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            <!--<input type="text"  class="btn btn-warning btn-sm" id="token_com"  value="<?php //echo 'c.'.$row['initial'];?> " style='display:none;'> -->
                                          </div>
                                    </div>
                                </div>
                                <?php  } else{?>
                                <H5 style='color:red'> Communicate to School, school will request for the pricecode approval. </H5>
                               
                              <?php 
                                }
                              } 
                              ?> 
                                
                                
                                
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
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'c';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'c';?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
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
                              <?php if(!empty($cart)){
                              
                              ?>
                              
                              
                               <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                   <div class="card my-2 mx-2 w-100">
                                          <!--<img src="https://img.icons8.com/bubbles/100/000000/test-passed.png" class="img-fluid" alt="..."/>-->
                                          <img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">
                                          <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['product_name']; ?> Orientation </h5>
                                          </div>
                                          <div class="card-body">
                                            <a href="#" class="card-link">Price: ₹ 826 </a>
                                            
                                          </div>
                                          <div class="card-footer">
                                              
                                            <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'o';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'o';?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
                                          </div>
                                    </div>
                                </div>
                                <?php
                                } 
                           
                              
                               ?> 
                                
                              
                                
                          </div>
                      </div>
                      
                      <div class="tab-pane fade" id="competition" role="tabpanel" aria-labelledby="competition-tab">
                          
                          <div class="row">
                              <?php
                              
                             if(!empty($cart)){
                                  ?>  
                                  <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                                  <div class="card my-2 mx-2 w-100">
                                  <!--<img src="https://img.icons8.com/clouds/100/000000/purchase-order.png" class="img-fluid" alt="...">-->
                                  <img src="https://img.icons8.com/bubbles/100/000000/books.png" class="img-fluid"/>
                                      <div class="card-body">
                                        <h5 class="card-title">Mock Test</h5>
                                      </div>
                                      <div class="card-body">
                                        <a href="#" class="card-link">Price:  118</a>
                                        <!--<a href="#" class="card-link">Mock Test Slip</a>-->
                                      </div>
                                      <div class="card-footer">
                                         <a  class="btn btn-warning btn-sm" onClick="misb(this.id);" id="<?php echo 'm';?>"> <i class="fa-solid fa-cart-plus"></i></a>
                                            <a  class="btn btn-danger btn-sm" onClick="remove_misb(this.id);" id="<?php echo 'm';?> " ><i class="fa-solid fa-trash-can"></i></a>
                                            
                                      </div>
                                </div>
                              </div>
                                  
                                  <?php
                              
                              
                              } ?> 
                                
                              
                                
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
              
            <div class="card-header bg-danger p-3 text-white text-center text-secondary">
              <b>Items Added To Cart</b>
            </div>
            <ul class="list-group list-group-flush">
              <li style="border:none" class="list-group-item"> 
              <?php 
                $res = $this->db->get_where('cin_zoomzoom',array('id' =>$id))->row();
                  $amount_total=0;
                  if($res->mocktest=='No'){
                      echo 'Mock Test - 118 <br>';
                      $amount_total=$amount_total+118;
                  }
                  if($res->orientation=='No'){
                      echo 'Orientation - 826 <br>';
                      $amount_total=$amount_total+826;
                  } 
                  if($res->competition=='No'){
                      echo 'Competition'.'-'.$cart['product_price'].'<br>' ;
                      $amount_total=$amount_total+$cart['product_price'];
                  }
                  // echo $amount_total;
                ?>
              
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
        url: "<?php base_url();?>net_abc1",
        type: 'POST',
        data: {id: token},
        success: function (response) {
         //lert(response);
       // location.reload();
        }
});
 }
 
 function remove_misb(id) {
    
  var token = id;
   //alert(token);
   //var token = $('#token_com').val();
 $.ajax({
        url: "<?php base_url();?>remove_misb1",
        type: 'POST',
        data: {id:token},
        success: function (response) {
        //alert(response);
       // location.reload();
        }
});
 }
 

</script>

    
    
    
<?php include "footer.php"?>