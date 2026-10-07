<?php include('student_header.php');
//include('student_nav.php');
//$pri=$this->session->userdata('cart');
$payid=$session['amount_data']['razorpay_payment_id'];
$tid=$session['amount_data']['merchant_trans_id'];

foreach ($student as $row){
    $prid=$row->PRID;
    $name=$row->first_name.' '.$row->middle_name.' '.$row->last_name;
    $school=$row->school_code;
}

                          
?>

<style>
body{
    background-color:#f4f4f4;font-family: 'Lora', serif;
}

td{
    background-color:#6600ff;
    color:#fff;
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:250px;
    margin-right:250px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
.sidebar {
    z-index: 11;
}

#product h1{
       color:black; 
    }
@media (max-width:767px){
    #product h1{
       font-size:15x; 
    }
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    #product{
        width:100%;
    }
    
}

#outer{
    display: flex;
    justify-content: center;
    align-items: center;
    height:50px;
    padding-top:20px;
    color:#333333;
}
#submit{
    width:55%;height:40px;background-color:#ff6600;font-size:20px;
}
#inner{
 
    height:40px;
    border: solid 2px #3385ff;
    border-radius: 30px;
    width: 40%;
    text-align: center;
    position: relative;
    /*left: 27%;*/
}
#inner:hover{
    background:#ff9933;
}
#top{
    padding-top:10px;
    background-color:#fff;
    text-align:center;
    color:red;
}
</style>
<body>



<div style='font-size:18px;margin-top:40px;' id='corner'>
    <div class='container-fluid'>
        <div id='top'>
           
                <h1>Payment Unsuccessful</h1>
           
        </div>
        <div class='row'>
            <div class='col-sm-6'>
          
                    <table class="table table-bordered" style=" width:100%;">
                      <thead>
                        <tr style=" background:#333; color:#FFF;text-align-center;">
                      
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Payment </th>
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Details</th>
                                                   
                                          
                        </tr>
                        <!--</th>-->
                          
                      </thead>
                      <tbody>
                        
                        <tr style="background:#f6e2ff;">
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">PRID</td>
                          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $prid; ?></td>
                        </tr>
                        <tr style="background:#fee5b9;">
                       
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Name</td>
                          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $name; ?></td>
                        </tr>
                        <tr style="background:#effeb9;">
                         
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Payment ID</td>
                          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $payid; ?></td>
                        </tr>
                        
                        
                        <tr style="background: #C7D1FA;">
                         
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Transaction ID</td>
                          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $tid; ?></td>
                        </tr>
                        
                        
                      </tbody>
                     </table>
            </div>
            <div class='col-sm-6' id='second'>
                <h3>BACK <br>TO PROFILE</h3>
                <div id='outer'>    
                    <div id='inner'>
                        
                        <a href="<?php echo base_url();?>welcome/out2/id/<?php echo $prid; ?>" style='text-decoration:none;font-size:25px;'>Click Here</a>
                    </div>
                </div>

            </div>
  
    
            </div>
            
        </div>
    </div>
</div>

<div id='pad'></div>
</body>
<style>
#pad{
    padding-top:50px;
    
}
#second{
    margin-top:2%;
    text-align:center;
    color:black;
}
@media only screen and (max-width: 600px) {
  #second{
    margin-bottom:35%;
    }
    #inner{
        width:100%;
    }
    #submit{
        width:80%;
        font-size:20px;
    }
}

</style>


<?php include("student_footer.php");?>