<?php include('student_header.php');
//include('student_nav.php');
//$pri=$this->session->userdata('cart');
$payid=$session['razorpay_order_id'];
$tid=$session['razorpay_order_id'];

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
    
    color:#000;  
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
    color:green;
}
</style>
<body>



<div style='font-size:18px;margin-top:40px;' id='corner'>
    <div class='container-fluid'>
        <div id='top'>
           
                <h1>Payment Successfull</h1>
           
        </div>
        <div class='row'>
            <div class='col-sm-12'>
          
                    <table class="table table-bordered" style=" width:100%;border-left: solid 1px #d9d1d1;">
                      <thead>
                        <tr style="">
                      
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Product Name </th>
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">CIN</th>
                          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Payment ID</th>                         
                                          
                        </tr>
                        <!--</th>-->
                          
                      </thead>
                      <tbody>
                        <?php foreach($cin as $cins){  ?>
                        <tr >
                          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $cins->product_name;?></td>
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cins->cin;?></td>
                          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $cins->rozarpay_payment_id;?></td>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                     </table>
            </div>
            <div class='col-sm-12' id='second'>
                <h3>BACK <br>TO PROFILE</h3>
                <div id='outer'>    
                    <div id='inner'>
                        
                        <a href="<?php echo base_url();?>welcome/studentdata" style='text-decoration:none;font-size:25px;'>Click Here</a>
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