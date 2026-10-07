<?php include('header.php');
//   print_r($revision_new);echo 'pl';
if($result[0]['clevel']=='3'){
    $lev='State Level';
}
if($result[0]['clevel']=='4'){
    $lev='National Level';
}
?>
<style>
body{
    /*padding-bottom:50px;*/
}
h3{
    font-weight:700;
    color:#006699;
}
table.d {
  table-layout: fixed;
  width: 100%;  
}
    #corner{
        background-color:white;
        border-radius:20px;
        
        margin-left:180px;
        margin-right:180px;
        padding-top:0px;
        /*padding-bottom:20px;*/
        font-size:18px;
        color:#3385ff;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
      text-align: center;
      padding: 4px;
      border:solid 1px #006699;
      font-size:15px;
      /*width:90px;*/
    }

    /*tr:nth-child(even){background-color: #f2f2f2}*/

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
#heading{
    color:black;
    font-size:17px;
}
#download_free:hover {
  background-color: yellow;
}
#d{
    border: 1px solid #ddd;
    color:#ffff;
    text-align:center;
}
</style>
<body>
    <div id='corner'>
        <div style='text-align:center;color:#006699;'>
             <h2 style='font-weight:700;'><?php echo $lev;?> Result</h2>
        </div>
        
        <div class='conatiner-fluid' style='background-color: #ffffb3;text-align:center;'>
            <div class='row'  style='margin:0%;background-color: darkslateblue;text-align:center;'>
                <div class='col-sm-1' id='d'>
                    <h5>CIN</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php echo $result[0]['cin']; ?></h5>
                </div>
                <div class='col-sm-1' id='d'>
                    
                    <h5>Grade</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php echo $result[0]['grade']; ?></h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5>Rank</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php if($result[0]['rank']==''){echo 'No Rank';}else{echo $result[0]['rank'];} ?></h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5>Speller</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php echo $result[0]['speller']; ?></h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5>Performer</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php echo $result[0]['performer']; ?></h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5>Status</h5>
                </div>
                <div class='col-sm-1' id='d'>
                    <h5><?php echo $result[0]['status']; ?></h5>
                </div>
            </div>
        </div>
        
        
        
        <!--<div style="overflow-x:auto;">-->
            <!--<table class="d" style='background-color: #ffffb3'>-->
            <!--    <tr >-->
                    <!--<th id='heading'>Student</th>-->
                    <!--<th id='heading'>Result Details</th>-->
            <!--        <td id='heading'>CIN</td>-->
            <!--        <td><?php echo $result[0]['cin']; ?></td>-->
                    <!--<td id='heading'>Product Name</td>-->
                    <!--<td><?php echo $result[0]['product_name']; ?></td>-->
            <!--        <td id='heading'>Grade</td>-->
            <!--        <td><?php echo $result[0]['grade']; ?></td>-->
            <!--        <td id='heading'>Rank</td>-->
            <!--        <td><?php echo $result[0]['rank']; ?></td>-->
            <!--        <td id='heading'>Best Performer</td>-->
            <!--        <td><?php echo $result[0]['performer']; ?></td>-->
            <!--        <td id='heading'>Star Speller</td>-->
            <!--        <td><?php echo $result[0]['speller']; ?></td>-->
            <!--        <td id='heading'>Status</td>-->
            <!--        <td><?php echo $result[0]['status']; ?></td>-->
            <!--    </tr>-->
               
                
            <!--</table>-->
        <!--</div>-->
        <div>
            <?php 
            if($result[0]['status']=='Q'){
                ?>
                <div style='text-align:center;font-weight:700;padding-bottom:25px;padding-top:25px;'>
                    <!--<h3>Congratulations!! You are qualified in <?php echo $lev;?>. Register for National Level..</h3>-->
                     <h3>Congratulations!! You are qualified to register for <span style='color:#009900;font-weight:bold;'>"National Level"</span>  Competition..</h3>
                </div>
                <div>
                    <h4 style='color:crimson;'>Register Now.</h4>
                </div>
                <?php
                if(!empty($product_new)){ 
                // print_r($product_new);
                ?>
                    <div style="overflow-x:auto;">
                        <table class="d" >
                            <tr style='text-align:center;background-color:#ffc34d;'>
                                <th id='heading'>Competition & Study Material</th>
                                <th id='heading'>Price (₹)</th>
                                <th id='heading'><span style='color:red;'>Double Click</span> "Add To Cart" Cart Items</th>
                            </tr>
                            <tr style=''>
                                <form method='post'>
                                    <td><?php echo $result[0]['product_name']; ?><br>
                                    <?php echo ' -National Championship.';?>
                                    </td>
                                    <td><?php echo '₹ '.$product_new['amount']; ?></td>
                                    <td>
                                        <div style='display:flex;' >
                                            <div style='padding-left:10px;'><button type="submit" name="add" id="add" value='<?php echo $product_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>
                                            <div style='padding-left:10px;'><button type="submit" name="remove" id="remove" value='<?php echo $product_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div> 
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                <?php }else{ //echo 'ok';?>
                <div style="overflow-x:auto;">
                        <table class="d">
                            <tr>
                                <th id='heading'>Product</th>
                                <th id='heading'>Price</th>
                                <th id='heading'><span style='color:red;'>Double Click</span> "Add & Romove" Cart Items</th> 
                            </tr>
                            <tr>
                                    <td><?php echo $result[0]['product_name']; ?><br>
                                    <?php echo ' -National Championship.';?></td>
                                    <td><?php echo 'Registered'; ?></td>
                                    <td>
                                        <?php //echo $cart[0]['status']; ?>
                                        
                                         <?php //if($cart[0]['status']=='Paid'){ ?>
                                        <div style='' >
                        <a href="<?php echo base_url();?>neww/admitcard" name="download_admit" id="" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Admit Card</a>
                                            <!--<button type="submit" name="download_admit" id="download_admit" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Admit Card</button> -->
                                            
                                        
                                        </div><?php //} ?>
                                        
                                       
                                    </td>
                               
                            </tr>
                            <tr>
                                
                                    <td>Study Material - Free</td>
                                    <td><?php echo 'Available'; ?></td>
                                    <td>
                                        <?php  if(!empty($material_free)){ //print_r($material_free);
                                        
                                        ?>
                                        <form method='post' action="<?php echo base_url()?>neww/free_material">
                                            <input type='text' name='product' value='<?php echo $material_free[0]['product_name']; ?>' style='display:none;' >
                                            <input type='text' name='class' value='<?php echo $material_free[0]['class']; ?>' style='display:none;' >
                                            <input type='text' name='clevel' value='<?php echo $material_free[0]['clevel']; ?>' style='display:none;' >
                                            <input type='text' name='period' value='<?php echo $material_free[0]['period']; ?>' style='display:none;' >
                                            <input type='text' name='subject' value='<?php echo $material_free[0]['subject']; ?>' style='display:none;' >
                                            <div style=''>
                                                <button type="submit" name="download_free" id="download_free" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Free Material</button> 
                                            </div>
                                        </form>
                                        <?php } else{?>
                                            <div style='' >
                                                <h3>Free Material will available soon.</h3> 
                                            </div>
                                        <?php }?>
                                    </td>
                               
                            </tr>
                        </table>
                    </div>
                <?php
                    
                }
                if(!empty($study_material_new)){
                    ?>
                    <div style="overflow-x:auto;">
                        <table class="d">
                            <tr style=''>
                                <form method='post'>
                                    <td><?php echo 'Study Material - Paid'; ?></td>
                                    <td><?php echo '₹ '.$study_material_new['amount']; ?></td>
                                    <td>
                                        <div style='display:flex;'>
                                            <div style='padding-left:10px;'><button type="submit" name="add" id="add" value='<?php echo $study_material_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>
                                            <div style='padding-left:10px;'><button type="submit" name="remove" id="remove" value='<?php echo $study_material_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                <?php
                }else{
                    ?>
                <div style="overflow-x:auto;">
                        <table class="d">
                            <tr>
                                
                                    <td><?php echo 'Study Material - Paid'; ?></td>
                                    <td><?php echo 'Registered'; ?></td>
                                    <td>
                                        <?php  if(!empty($material_paid)){ //print_r($material_free[0]['folder']);?>
                                        <form method='post' action="<?php echo base_url()?>neww/paid_material">
                                            <input type='text' name='product' value='<?php echo $material_free[0]['product_name']; ?>' style='display:none;' >
                                            <input type='text' name='class' value='<?php echo $material_free[0]['class']; ?>' style='display:none;' >
                                            <input type='text' name='clevel' value='<?php echo $material_free[0]['clevel']; ?>' style='display:none;' >
                                            <input type='text' name='period' value='<?php echo $material_free[0]['period']; ?>' style='display:none;' >
                                            <input type='text' name='subject' value='<?php echo $material_free[0]['subject']; ?>' style='display:none;' >
                                            <div style=''>
                                                <button type="submit" name="download_paid" id="download_paid" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Paid Material</button> 
                                            </div>
                                        </form>
                                        <?php } else{?>
                                            <div style='' >
                                                <h3>Paid Material will available soon.</h3> 
                                            </div>
                                        <?php }?>
                                    </td>
                               
                            </tr>
                        </table>
                    </div>
                <?php
                    
                }
                // =========== orientation ============== //
                
                if(!empty($orientation_new)){
                    ?>
                    <div style="overflow-x:auto;">
                        <table class="d">
                            <tr style=''>
                                <!--<form method='post'>-->
                                
                                    <td><?php echo 'Orientation'; ?></td>
                                    <td><?php echo '₹ '.$orientation_new['amount']; ?></td>
                                    
                                    <td>
                                        <div style='display:flex;' >
                                           <div style='padding-left:10px;'><button type="submit"  id="close" onclick="show_alert()" class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>
                                            <div style='padding-left:10px;'><button type="submit" id="close" onclick="show_alert()" class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>
                                            <!--<div style='padding-left:10px;'><button type="submit" name="add" id="add" value='<?php echo $orientation_new['amount'];?>' class="btn btn-primary" style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>-->
                                            <!--<div style='padding-left:10px;'><button type="submit" name="remove" id="remove" value='<?php echo $orientation_new['amount'];?>' class="btn btn-primary" style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>-->
                                            
                                        </div>
                                    </td>
                                
                                <!--</form>-->
                            </tr>
                          
                        </table>
                    </div>
                <?php
                }else{
                    ?>
                <div style="overflow-x:auto;">
                        <table class="d">
                            <tr>
                                <form method='post' action="<?php echo base_url()?>neww/orientationslip">
                                    <td><?php echo 'Orientation'; ?></td>
                                    <td><?php echo 'Registered'; ?></td>
                                    <td>
                                        <?php //echo $cart[0]['status']; ?>
                                        <div style='' >
                                            <button type="submit" name="download_slip" id="download_slip" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Registration Slip</button> 
                                        </div>
                                    </td>
                               </form>
                            </tr>
                        </table>
                    </div>
                <?php
                    
                }
                // ============== Revision ============== //
                
                if(!empty($revision_new)){
                    ?>
                    <div style="overflow-x:auto;">
                        <table class="d">
                            <tr style=''>
                                <!--<form method='post'>-->
                                
                                    <td><?php echo 'Revision Session'; ?></td>
                                    <td><?php echo '₹ '.$revision_new['amount']; ?></td>
                                    
                                    <td>
                                        <div style='display:flex;' >
                                           <!--<div style='padding-left:10px;'><button type="submit"  id="close" onclick="show_alert()" class="btn btn-primary" style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>-->
                                            <!--<div style='padding-left:10px;'><button type="submit" id="close" onclick="show_alert()" class="btn btn-primary" style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>-->
                                            <div style='padding-left:10px;'><button type="submit" name="add" id="add" value='<?php echo $revision_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>
                                            <div style='padding-left:10px;'><button type="submit" name="remove" id="remove" value='<?php echo $revision_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>
                                           
                                        </div>
                                    </td>
                                
                                <!--</form>-->
                            </tr>
                          
                        </table>
                    </div>
                <?php
                }else{
                    ?>
                <div style="overflow-x:auto;">
                        <table class="d">
                            <tr>
                                <form method='post' action="<?php echo base_url()?>neww/revisionslip">
                                    <td><?php echo 'Revision Session'; ?></td>
                                    <td><?php echo 'Registered'; ?></td>
                                    <td>
                                        <?php //echo $cart[0]['status']; ?>
                                        <div style='' >
                                            <button type="submit" name="revision_slip" id="revision_slip" class="btn btn-primary"  style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Registration Slip</button> 
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>
                <?php
                    
                }
                // ================ mock Test =========== //
                 if(!empty($mock_test_new)){
                     ?>
                     <div style="overflow-x:auto;">
                        <table class="d">
                             <tr style=''>
                                 <form method='post'>
                                
                                     <td><?php echo 'Mock Test'; ?></td>
                                     <td><?php echo '₹ '.$mock_test_new['amount']; ?></td>
                                    
                                     <td>
                                         <div style='display:flex;' >
                                           
                                            <div style='padding-left:10px;'><button type="submit" name="add" id="add" value='<?php echo $mock_test_new['amount'];?>' class="btn btn-primary" disabled style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Add To Cart</button></div>
                                             <div style='padding-left:10px;'><button type="submit" name="remove" id="remove" value='<?php echo $mock_test_new['amount'];?>' class="btn btn-primary" disabled   style='width:100%;height:35px;background-color:#ff6600;font-size:15px;'>Remove</button></div>
                                            
                                         </div>
                                     </td>
                                
                            </form>
                             </tr>
                          
                         </table>
                     </div>
                 <?php
                 }else{
                     ?>
                 <div style="overflow-x:auto;">
                         <table class="d">
                             <tr>
                                
                                     <td><?php echo 'Mock Test'; ?></td>
                                     <td><?php echo 'Paid'; ?></td>
                                     <td>
                                      <?php //echo $cart[0]['status']; ?>
                                         <div style='' >
                                             <a href="<?php base_url();?>mocktest" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Mock Test Slip</a>
                                             <!--<button type="submit" name="download_mock_test" id="download_mock_test" class="btn btn-primary" style='width:60%;height:40px;background-color:#ff6600;font-size:15px;'>Download Mock Test Slip</button> -->
                                         </div>
                                     </td>
                               
                             </tr>
                         </table>
                     </div>
                 <?php
                    
                 }
                
                
                
                
            }
                
            ?>
            
        </div>
    </div>
    <!--    ========== cart section ==========   -->
        <?php  if($all_paid_new==''){?>
            <div id='corner'>
                <table class="d">
                    <tr>
                      
                        <form method='post' action="<?php echo base_url()?>razorpay/pay">
                              <?php 
                       $idd = $this->session->userdata('cin');
                        $paid_idd = $this->db->get_where('cin_list',array('cin' =>$idd))->row();?>
                            <input type="hidden" name="cin" value="<?php echo $paid_idd->cin;?>">
                            <input type="hidden" name="name" value="<?php echo $paid_idd->student_name;?>">
                            <input type="hidden" name="contact" value="<?php echo $paid_idd->stud_phone;?>">
                            <input type="hidden" name="email" value="<?php echo $paid_idd->stud_email;?>">
                            <input type='text' name='product_name' value='<?php echo $result[0]['product_name']; ?>' style='display:none;' >
                            <input type='text' name='amount' value='<?php print_r($amount); ?>' style='display:none;' >
                            <input type='text' name='price_code' value='<?php echo $product[0]['price_code']; ?>' style='display:none;' >
                            <td style='font-weight:700;font-size:18px;color:black;'>Total Amount (INR)</td>
                            <td style='font-weight:700;font-size:18px;color:black;'><?php
                            echo '₹ '; 
                            print_r($amount);
                            
                            ?>
                            </td>
                            <td>
                                <?php 
                                    if($amount=='5500'){
                                    echo 'competition';
                                    }
                                    if($amount=='5950'){
                                        echo 'competition+material';
                                    }
                                    if($amount=='6850'){
                                        echo 'competition+material+revision';
                                    }
                                    if($amount=='1350'){
                                        echo 'material+revision';
                                    }
                                    if($amount=='900'){
                                        echo 'revision';
                                    }
                                    if($amount=='450'){
                                        echo 'material';
                                    }
                                    if($amount=='6450'){
                                        echo 'competition+revision';
                                    }
                                    if($amount=='250'){
                                        echo 'mock_test';
                                    }
                                    if($amount=='5750'){
                                        echo 'mock_test+competition';
                                    }
                                    if($amount=='6400'){
                                        echo 'revision+competition';
                                    }
                                    if($amount=='1150'){
                                        echo 'mock_test+orientation';
                                    }
                                    if($amount=='700'){
                                        echo 'mock_test+material';
                                    }
                                    if($amount=='6650'){
                                        echo 'revision+mock_test+competition';
                                    }
                                    if($amount=='6200'){
                                        echo 'material+mock_test+competition';
                                    }
                                    if($amount=='1600'){
                                        echo 'material+mock_test+revision';
                                    }
                                    if($amount=='7100'){
                                        echo 'material+mock_test+revision+competition';
                                    }
                                ?>
                                <!--<div style='' >-->
                                <!--    <button type="submit" name="pay" id="pay" class="btn btn-primary" id='pay-button' style='width:60%;height:40px;background-color:#ffa41c;font-size:15px;font-weight:700;'>Proceed To Buy</button> -->
                                <!--</div>-->
                                <img src='<?php echo base_url();?>images/cart.png' style='padding-top:0px;height:30px;width:30px;'>
                            </td>
                        
                    </tr>
                    <tr >
                        <td><b><small style="color:green; font-size:85%;">The fee once paid shall not be refunded</small></b></td>
                        <td style='border:none;'>
                            <div style='' >
                                <button type="submit" name="pay" id="pay" class="btn btn-primary" id='pay-button'disabled style='width:60%;height:40px;background-color:#ffa41c;font-size:15px;font-weight:700;'>Proceed To Register</button> 
                            </div>    
                        </td>
                        <td></td>
                    </tr>
                    </form>
                </table>
                
            </div>
        <?php }?>
</body>


<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/xxjapp/xdialog@3/xdialog.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/xxjapp/xdialog@3/xdialog.min.js"></script>
    
    <style>
        .xd-content .xd-body .xd-body-inner {
            max-height: unset;
        }
        .xd-content .xd-body p {
            color: #f0f;
            text-shadow: 0 0 1px rgba(0, 0, 0, 0.75);
        }
        .xd-content .xd-button.xd-ok {
            background: #734caf;
        }
    </style>
</head>

<script>
  function show_alert() {
    xdialog.alert("Registration Closed. You can now register for the Revision Session.");
}  
 function show_alert2() {
    xdialog.alert("Registration Over. You can't register for the Revision Session.");
}  
    
$('#download_admit').click(function(){
  alert('Thank You For The Registration. Admit Card can be downloaded on 1st Nov 2022.')
});

// $('#download_mock_test').click(function(){
//   alert('Thank You For The Registration. Mock Test Slip can be downloaded in few days.')
// });
// $('#close').click(function(){
//   alert('Registration Closed. You can now register for the Orientation-Schedule -II, Available Soon.')
// });

</script>


<?php include("footer.php");?>