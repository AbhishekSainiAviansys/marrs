<?php include('header1.php'); 

// print_r($_SESSION);


// print_r($schedule);
// $name=$student->first_name.' '.$student->middle_name.' '.$student->last_name;
?>
<head>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-IJ0osnS6/1RMf8AslmVuDJalD4T4P9PO9OK5P7pYwHtTBz5O1D8c4/vWzv90YbMw" crossorigin="anonymous">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" -->
    <!--      rel="stylesheet" -->
    <!--      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" -->
    <!--  crossorigin="anonymous">-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>


<style>
#cart-products h5.text-center {
    padding: 10px;
    background: green;
    color: #fff;}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    a{
        text-decoration:none;
        /*color:#ffffff;*/
    }
    .card {
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
      /*border-radius: 10px;*/
      widh:100%;
    }
    .toaster {
        position: absolute;
        /*right: 20.5%;*/
        left: 70.5%;
        top:20%;
        background-color: #008000;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        display: none;
        font-size:14px;
        font-weight:500;
    }
    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .card-body {
      padding: 20px;
    }
    .card-title {
      font-size: 1.5rem;
      margin-bottom: 10px;
    }
    .card-text {
      font-size: 1rem;
      color: #555;
    }
    .alert {
      display: none;
    }
    .basket {
      position: fixed;
      bottom: 80px;
      right: 80px;
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      cursor: pointer;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    .basket span {
      position: absolute;
      top: 5px;
      right: 5px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 0.8rem;
    }
    /* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 600px;
  position: relative;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Basket Icon Styles */
.basket {
  position: relative;
  cursor: pointer;
}

.basket i {
  font-size: 24px;
}


    .button {
      background-color: #004A7F;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      border: none;
      color: #FFFFFF;
      cursor: pointer;
      display: inline-block;
      font-family: Arial;
      font-size: 20px;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      -webkit-animation: glowing 1500ms infinite;
      -moz-animation: glowing 1500ms infinite;
      -o-animation: glowing 1500ms infinite;
      animation: glowing 1500ms infinite;
    }
    
    @-webkit-keyframes glowing {
      0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
    }
    
    @-moz-keyframes glowing {
      0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
    }
    
    @-o-keyframes glowing {
      0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
    }
    
    @keyframes glowing {
      0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
      50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
      100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
    }

    #cart-count {
       position: absolute;
        top: -10px;
        right: -10px;
        background-color: #fff;
        color: white;
        border-radius: 50%;
        padding: 4px 8px;
        font-size: 16px;
        color: red !important;
    }
    
    #myBtn {
        position: absolute;
        bottom: 160px;
        float: right;
        right: 12.5%;
        left: 100.5%;
        max-width: 100px;
        width: 80%;
        font-size: 16px;
        border-color: #ffc107;
        background-color: rgb(241 233 233 / 54%);
        padding: 12px;
        border-radius: 15%;
        background: red;
    }

    .card-body {
        padding: 20px;
        text-align: left;
    }

    @media screen and (max-width: 480px) {
         button.btn.btn-outline-primary.btn-sm.product-button {
            width:100% !important;}
            button.btn.btn-outline-primary.btn-sm.product-button-child{
              width:100% !important;}   
            }
      
    }
    /*On Hover Color Change*/
    
    #myBtn:hover {
        background-color: #7dbbf1;
    }
     
    .sidee{
         /*align-items: center;*/
        justify-content: space-between;
         
    }
     
.profile-details {
    max-width: 100%;
    overflow-x: auto;
}

.responsive-table {
    width: 100%;
    border-collapse: collapse;
}

.responsive-table th,
.responsive-table td {
    padding: 12px;
    border: 1px solid #e0e0e0;
    text-align: left;
}

/* Desktop */
.responsive-table th {
    width: 30%;
    background: #f7f7f7;
    font-weight: 600;
}

/* Mobile */
@media (max-width: 768px) {
    .responsive-table,
    .responsive-table tbody,
    .responsive-table tr,
    .responsive-table th,
    .responsive-table td {
        display: block;
        width: 100%;
    }

    .responsive-table tr {
        margin-bottom: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
    }

    .responsive-table th {
        background: none;
        border: none;
        padding-bottom: 4px;
        color: #555;
        font-size: 14px;
    }

    .responsive-table td {
        border: none;
        padding-top: 0;
        font-size: 15px;
        font-weight: 500;
    }
}

</style>
 
<div class='container mb-5'>
    
           
            
    <div class='row'>
        <div class='col-lg-4 col-sm-6 col-md-6'>
            <div class="card text-center mt-5">
                <div class="card-header d-flex sidee">
                    <h5>Profile </h5>
                   
                </div>
                <div class="profile_edit" style="margin-top:6px">
                    <form method="POST">
                    <!--<button class="btn btn-outline-warning btn-sm " name='Edit' type='submit'>Profile Edit</button>-->
                    </form>
                </div>
                
                
                <div class="card-body" style="padding:0">
                 <div class="profile-container">
                    <div class="profile-header text-center ">
                        <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="Student Photo" class="profile-pic">
                        
                    </div>
                    
                    <div class="profile-details">
                        <table class="table-border responsive-table">
                            <tbody>
                                <tr>
                                    <th>Student Name</th>
                                    <td><?php echo htmlspecialchars($student->name); ?></td>
                                </tr>
                    
                                <tr>
                                    <th>Class</th>
                                    <td><?php echo htmlspecialchars($student->class); ?></td>
                                </tr>
                    
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo htmlspecialchars($student->email); ?></td>
                                </tr>
                    
                                <tr>
                                    <th>Registration Code</th>
                                    <td>
                                        <?php
                                        $school = $this->db->get_where(
                                            'lunar_schedule_cin',
                                            ['lunar_schedule_id' => $student->sch_id]
                                        )->row();
                                        echo htmlspecialchars($school->registration_code);
                                        ?>
                                    </td>
                                </tr>
                    
                                <tr>
                                    <th>Subject</th>
                                    <td><?php echo htmlspecialchars($schedule->subject); ?></td>
                                </tr>
                    
                                <tr>
                                    <th>Variant</th>
                                    <td><?php echo htmlspecialchars($schedule->type); ?></td>
                                </tr>
                    
                                <tr>
                                    <th>Series</th>
                                    <td><?php echo htmlspecialchars($schedule->series); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    
                  </div>
                   
                    
                    
                </div>
                
                
               
                
                
            </div>
        </div>
                
        <div class='col-lg-8 col-sm-4 col-md-4'>
               <div class="alert alert-success" id="success-alert">Successfully added!</div>
                <div class="alert alert-danger" id="error-alert">Product removed!</div>

            <div class='col-12 mt-5 '>
            <div class="card text-center">
                
                <?php 
                // print_r($school_dates);
                $current_date = date('Y-m-d');
                $start_date = $school->start_date;
                $end_date = $school->end_date;
                
                
                if ($current_date < $start_date) {
                    echo "Exam open soon. Exam Date : " . $start_date;
                } elseif ($current_date > $end_date) {
                    echo "Exam over. Exam ended : " . $end_date;
                } else {
                    ?>
                     <div class="card-header sidee d-flex">
                        <div>
                            <h4>
                                Registration Items
                            </h4>
                        </div>
                        <div>
                            <?php 
                            $price= $this->db->get_where('cin_list',array('stud_email'=>$student->email,'sch_id'=>$schedule->lunar_schedule_id,'prid'=>$this->session->userdata('prid')))->row();
                            // echo $this->db->last_query();
                            if(!empty($price)){       
                            ?>
                            
                            <!--<form action='<?php base_url(); ?>/student_registration/welcome/api_invoice'>-->
                            <!--<button name='invoive'  class='btn btn-warning' >Invoice</button>-->
                            <?php } ?>
                        </form>
                        </div>
                        
                        
                            
                    </div>
                    
                    <div class="card-body table-responsive">
                        <!--<h5 class="card-title" ><?php echo $student->name; ?></h5>-->
                    
                        <table class='table'>
                            <thead>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Cart (Add To Cart)</th>
                            </thead>
                            <tboady>
                               <?php
                            //   print_r($product_list);
                                // foreach($product_list as $row){ 
                                    // print_r($row);
                                    
                                    // $price= $this->db->get_where('cin_list',array('sch_id'=>$student->sch_id,'student_name'=>$student->name,'prid'=>))->row();
                                    // echo $this->db->last_query();
                                    //  print_r($proche);
                                            if($product_sho=='yes'){
                                                // echo 'ok';
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php  echo 'Lunar Skill Test';   ?>
                                                    
                                                    <a href="https://marrs.in/lunarskill.php" target="_blank" rel="noopener noreferrer">View Details</a>
                                                            
                                                </td>
                                                
                                                <td> 
                                                    <?php 
                                                        if($product_pur == 'yes'){
                                                            echo 'Paid';
                                                        }else{
                                                        echo 'Rs.'.$student->amount;
                                                        }
                                                    ?>
                                                </td>
                                                
                                                <td class='text-center'>
                                                    <?php
                                                    // echo $product_pur;
                                                    if($product_pur == 'yes'){?>
                                                    <p>Click ON CIN To Download Material</p>
                                                    <!--<form method='POST' >-->
                                                        <h5>CIN : </h5>
                                                        <!--<button name='cin' value='<?php echo $price->cin; ?>' class='btn btn-primary btn-sm'><?php echo $price->cin; ?></button>-->
                                                        <button onclick="copyToClipboard('<?php echo $price->cin; ?>')" class="btn btn-primary btn-sm">
                                                            <?php echo $price->cin; ?> <span style='color:white;'>(Click to Copy)</span>
                                                        </button>
                                                        
                                                    <!--</form>-->
                                                    <?php
                                                    }else{ 
                                                    
                                                    ?>
                                                    
                                                        <button class="btn btn-outline-primary btn-sm product-button" value='<?php echo $student->amount.'+'.'product'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Add Cart</button>
                                                    
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            
                                            
                                            <?php } ?>
                                            
                                            
                                            <?php //if($mat_sho=='yes'){ ?>
                                            
                                                <!--<tr>-->
                                                <!--    <td>-->
                                                <!--        Material-->
                                                <!--    </td>-->
                                                <!--    <td>Rs. -->
                                                        <?php 
                                                           // echo $schedule->material;
                                                        ?>
                                                <!--    </td>-->
                                                <!--    <td class='text-center'>-->
                                                       <?php
                                                    //    if($mat_pur=='yes'){?>
                                                        
                                                <!--            <button class="btn btn-outline-warning btn-sm product-button" value='<?php echo $schedule->material.'+'.'material'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Download</button>-->
                                                        
                                                       <?php //}else{ ?>
                                                        
                                                <!--            <button class="btn btn-outline-primary btn-sm product-button" value='<?php echo $schedule->material.'+'.'material'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Add Cart</button>-->
                                                        
                                                       <?php //} ?>
                                                        
                                                <!--    </td>-->
                                                <!--</tr>-->
                                            <?php //} ?>
                                            
                                        
                                            <?php //if($moc_sho=='yes'){ ?>
                                            
                                                <!--<tr>-->
                                                <!--    <td>-->
                                                <!--        Mock-->
                                                <!--    </td>-->
                                                <!--    <td>Rs. -->
                                                        <?php 
                                                //            echo $schedule->mock;
                                                        ?>
                                                <!--    </td>-->
                                                <!--    <td class='text-center'>-->
                                                       <?php
                                                //        if($moc_pur=='yes'){?>
                                                        
                                                <!--            <button class="btn btn-outline-warning btn-sm product-button" value='<?php echo $schedule->mock.'+'.'mock'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Download</button>-->
                                                        
                                                       <?php //}else{ ?>
                                                        
                                                <!--            <button class="btn btn-outline-primary btn-sm product-button" value='<?php echo $schedule->mock.'+'.'mock'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Add Cart</button>-->
                                                        
                                                       <?php //} ?>
                                                        
                                                <!--    </td>-->
                                                <!--</tr>-->
                                            <?php //} ?>
                                            
                                            <?php //if($ori_sho=='yes'){ ?>
                                            
                                                <!--<tr>-->
                                                <!--    <td>-->
                                                <!--        Orientation-->
                                                <!--    </td>-->
                                                <!--    <td>Rs. -->
                                                      <?php 
                                                          //  echo $schedule->orientation;
                                                        ?>
                                                <!--    </td>-->
                                                <!--    <td class='text-center'>-->
                                                        <?php
                                                //        if($ori_pur=='yes'){?>
                                                        
                                                <!--            <button class="btn btn-outline-warning btn-sm product-button" value='<?php echo $schedule->orientation.'+'.'orientation'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Download</button>-->
                                                        
                                                        <?php //}else{ ?>
                                                        
                                                <!--            <button class="btn btn-outline-primary btn-sm product-button" value='<?php echo $schedule->orientation.'+'.'orientation'.'+'.$student->name.'+'.$student->class.'+'.$schedule->lunar_schedule_id; ?>' style='width:50%;'>Add Cart</button>-->
                                                        
                                                        <?php //} ?>
                                                        
                                                <!--    </td>-->
                                                <!--</tr>-->
                                            <?php //} ?>
                                            
                                        
                                        <?php
                                        // }
                                    // }
                                ?>
                                
                                <!--<tr> -->
                                <!--    <td colspan='3' class="text-center"><button class="btn btn-danger btn-sm button" type='submit' id="myBtn2" onclick="document.getElementById('id02').style.display='block'" >Register Siblings</button></td>-->
                                <!--</tr>-->
                                <?php if($schedule->syllabus){ ?>
                                    <tr>
                                        <td colspan='3' class="text-center">
                                            <a href="https://marrs.in/lunar/product_logo/<?php echo $schedule->syllabus; ?>" target="_blank" rel="noopener noreferrer">View Syllabus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
    
                            </tboady>
                            
                        </table>
                        
                       <div class='text-center'>
                           <img src='https://marrs.in/student_registration/certificate_logo/flunar.jpg' style='width:50%;height:30%;'>
                       </div> 
                       
                    </div>
                  <button class="btn btn-danger btn-sm" type="submit" id="myBtn" onclick="document.getElementById('id01').style.display='block'"><a style="color: white"  style="width:auto;"><span id="cart-count" class="text-black">0</span>
                        </a>Buy Now</button>

                <?
                    
                }
            
                ?>
                
                   
               
            </div>
        </div>
            
            
        </div>
    </div>
</div>


<!--<button id="myBtn" onclick="document.getElementById('id01').style.display='block'"><a style="color: white"  style="width:auto;"><span id="cart-count" class="text-black">0</span><span class="text-black fw-bold">Buy Now</span>-->
<!--<br><i class="fa fa-shopping-cart" style="font-size:10px;color:yellow"></i>-->
<!--</a></button>-->


<div id="id01" class="modal">
    <div class="modal-content animate">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container" id="cart-products">
            
        </div>
        <div class="container mt-2" style="background-color:#ffffff;text-align:end">
            <p ><strong>Total Amount:</strong> Rs. <span id="total-amount">0</span></p>
            <!--<button type="button" id="checkout-button" style="display: none;" class='btn btn-primary '>Pay Now</button>-->
            <button type="button" id="checkout-button" style="display: none;" class='btn btn-primary'>Pay Now</button>

            <form id="payment-form" method="POST" action="<?php echo base_url('Razorpay/pay3'); ?>" style="display: none;">
                <input type="hidden" name="prid" value="<?php echo $student->prid; ?>">
                <input type="hidden" name="contact" value="<?php echo $student->mobile; ?>">
                <input type="hidden" name="email" value="<?php echo $student->email; ?>">
                <input type="hidden" name="sch_id" value="<?php echo $schedule->lunar_schedule_id;?>" >
                
            </form>
        </div>
    </div>
</div>


<!--<div id="child-products"></div>-->
<!--<div id="cart-count"></div>-->
<div id="id02" class="modal">
    
    <div class="modal-content animate">
        <!--<div class="imgcontainer">-->
        <!--    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>-->
        <!--</div>-->
        <div class="modal-header" style="border-bottom: solid 3px red;    padding-left: 120px;">
             <h4 class="text-danger text-center">Add Products for Siblings</h4>
        
        </div>
        <form method="POST">
            <div class="row mb-3">
                <div class="col-6 mt-3">
                    <label for="child_name" class="form-label">Name:<span class='text-danger'>*</span></label>
                    <input type="text" class="form-control" id="child_name" placeholder="Enter Name" name="name" required>
                </div>
                <div class="col-6 mt-3">
                    <label for="class" class="form-label">Class:<span class='text-danger'>*</span></label>
                    <select class="form-select" id="class" name="class" required>
                        <option>-- select class --</option>
                        <!--<option value="Nursery">Nursery</option>-->
                        <option value="LKG">LKG</option>
                        <option value="UKG">UKG</option>
                        <option value="Class-1">Class-1</option>
                        <option value="Class-2">Class-2</option>
                        <option value="Class-3">Class-3</option>
                        <option value="Class-4">Class-4</option>
                        <option value="Class-5">Class-5</option>
                        <option value="Class-6">Class-6</option>
                        <option value="Class-7">Class-7</option>
                        <option value="Class-8">Class-8</option>
                        <option value="Class-9">Class-9</option>
                        <option value="Class-10">Class-10</option>
                        <!--<option value="Class-11">Class-11</option>-->
                        <!--<option value="Class-12">Class-12</option>-->
                    </select>
                </div>
            </div>
            <div class="text-center" id="child-products"></div>
        </form>
         <div class="modal-footer" style="border-bottom: solid 3px red;">
          <div class="imgcontainer">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal"><button class="btn btn-outline-danger btn-sm">Exit to Checkout</button></span>
        </div>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // function copyToClipboard(text) {
    //     navigator.clipboard.writeText(text).then(function() {
    //         showToaster("CIN Copied successfully.");
            
    //     }, function(err) {
    //         alert('Failed to copy CIN');
    //     });
    // }

    // function showToaster(message) {
    //     var toaster = $('<div class="toaster">' + message + '</div>');
    //     $('body').append(toaster);
    //     toaster.fadeIn(400).delay(3000).fadeOut(400, function() {
    //         $(this).remove();
    //     });
    // }
    
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            showToaster("CIN Copied successfully.");
        }, function(err) {
            alert('Failed to copy CIN');
        });
    }

    function showToaster(message) {
        var toaster = $('<div class="toaster">' + message + '</div>');
        $('body').append(toaster);
        toaster.fadeIn(400).delay(2000).fadeOut(400, function() {
            $(this).remove();
            // Redirect after toaster disappears
            window.location.href = "https://marrs.in/";
        });
    }
    
</script>



<script>
$(document).ready(function() {
    
   
    
    
    $("#class").change(function(){
        var class_name = this.value;
        $.ajax({
            url: "<?php echo base_url('/welcome/class_product'); ?>",
            data: { class_name: class_name },
            type: 'post',
            success: function(response) {
                var cartData = JSON.parse(response);
                childCartData(cartData);
                // document.getElementById('id03').style.display = 'block';
            }
        });
    });

    function childCartData(cartData) {
    var cartProductsDiv = document.getElementById('child-products');
    cartProductsDiv.innerHTML = ''; // Clear any existing content

    if (cartData.length === 0) {
        cartProductsDiv.innerHTML = '<p>No Product Assigned to this class. Contact school.</p>';
        $('#checkout-button').hide(); // Hide the checkout button
    } else {
        var tableHtml = `
        <div class='table-responsive'>
            <table class="table">
            
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                
        `;

        cartData.forEach(function(product) {
            tableHtml += `
                <tr>
                    <td>${product.product_name}</td>
                    <td>Rs. ${product.amount}</td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm product-button-child" 
                                data-amount="${product.amount}" 
                                data-product-name="${product.product_name}" 
                                data-child-name="${$('#child_name').val()}" 
                                data-child-class="${$('#class').val()}"
                                style="width:50%;">Add Cart</button>
                    </td>
                </tr>
            `;
        });

        tableHtml += `
                </tbody>
            </table>
            </div>
        `;

        cartProductsDiv.innerHTML = tableHtml;

        // Rebind click event for dynamically created buttons
        $('.product-button-child').on('click', function() {
            event.preventDefault(); // Prevent the default action

            var amount = $(this).data('amount');
            var productName = $(this).data('product-name');
            var childName = $(this).data('child-name');
            var childClass = $(this).data('child-class');
            var value = `${amount}+${productName}+${childName}+${childClass}`;
            
            $.ajax({
                url: '<?php echo base_url('/welcome/add_rem'); ?>',
                type: 'POST',
                data: { value: value },
                success: function(response) {
                    if (response) {
                        $('#cart-count').text(response.trim());
                        // Display toaster notification
                        // $('#id02').modal('hide');
                        showToaster("Product added successfully, Click On - Buy Now.");
                        
                    } else {
                        alert('No response from server');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        });
    }
}

    $('.product-button').on('click', function() {
        var value = $(this).val();
        $.ajax({
            url: '<?php echo base_url('/welcome/add_rem'); ?>',
            type: 'POST',
            data: { value: value },
            success: function(response) {
                $('#cart-count').text(response.trim());
                showToaster("Product added successfully, Click On - Buy Now.");
            }
        });
    });

    $('#checkout-button').on('click', function() {
        $('#payment-form').submit();
    });

    var modal = document.getElementById('id01');

    $('#myBtn').on('click', function() {
        $.ajax({
            url: '<?php echo base_url('/welcome/get_cart'); ?>',
            type: 'GET',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayCartData(cartData);
                
                document.getElementById('id01').style.display = 'block';
            }
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });

    $('#myBtn2').on('click', function() {
        $.ajax({
            url: '<?php echo base_url('/welcome/get_cart'); ?>',
            type: 'GET',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayCartData(cartData);
                document.getElementById('id02').style.display = 'block';
            }
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });

    $('#myBtn3').on('click', function() {
        $.ajax({
            url: '<?php echo base_url('/welcome/get_cart'); ?>',
            type: 'GET',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayCartData(cartData);
                document.getElementById('id03').style.display = 'block';
            }
        });

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    });

    function displayCartData(cartData) {
        var cartProductsDiv = document.getElementById('cart-products');
        var totalAmount = 0;
        cartProductsDiv.innerHTML = ''; // Clear any existing content

        if (cartData.length === 0) {
            cartProductsDiv.innerHTML = '<p>Your cart is empty.</p>';
            $('#checkout-button').hide(); // Hide the checkout button
        } else {
            var tableHtml = `
                <table class="table">
                <h5 class=" text-center">Check Out And Pay</h5>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            cartData.forEach(function(product) {
                tableHtml += `
                    <tr>
                        
                        <td>${product.student_name}</td>
                        <td>${product.item}</td>
                        <td>Rs. ${product.amount}</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm product-button-remove" 
                            data-item-id="${product.lunar_purchase_id}" 
                            
                            style="width:100%;">Remove</button>
                        </td>
                    </tr>
                `;
                totalAmount += parseFloat(product.amount);
            });
            tableHtml += `
                    </tbody>
                </table>
            `;
            cartProductsDiv.innerHTML = tableHtml;
            $('#total-amount').text(totalAmount.toFixed(2));
            $('#checkout-button').show(); // Show the checkout button if there are items in the cart
        
             updateCheckoutButtonVisibility();
            
        }
    }
    
    $(document).on('click', '.product-button-remove', function(event) {
            event.preventDefault(); // Prevent the default action
            var itemId = $(this).data('item-id');
        
            $.ajax({
                url: '<?php echo base_url('/welcome/add_rem_pro'); ?>',
                type: 'POST',
                data: { value: itemId },
                success: function(response) {
                    $('#cart-count').text(response.trim());
                    showToaster("Product removed successfully.");
                    
                    refreshCart();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        });
    
    function refreshCart() {
        $.ajax({
            url: '<?php echo base_url('/welcome/get_cart'); ?>',
            type: 'GET',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayCartData(cartData);
                
                // Optionally, close the modal if the cart is empty
                if (cartData.length === 0) {
                    document.getElementById('id01').style.display = 'none';
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', status, error);
            }
        });
    }

    function showToaster(message) {
        var toaster = $('<div class="toaster">' + message + '</div>');
        $('body').append(toaster);
        toaster.fadeIn(400).delay(3000).fadeOut(400, function() {
            $(this).remove();
        });
    }
    
    function updateCheckoutButtonVisibility() {
        var totalAmount = parseFloat($('#total-amount').text());
        if (totalAmount === 0) {
            $('#checkout-button').hide();
        } else {
            $('#checkout-button').show();
        }
    }
    
    updateCheckoutButtonVisibility();
    
});
    
    


</script>





<?php include('footer.php'); ?>