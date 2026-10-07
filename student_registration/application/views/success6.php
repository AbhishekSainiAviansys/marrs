<?php include('header1.php');

?>

<!--   <div id="loader" style="display: flex; justify-content: center; align-items: center; height: 100vh;background: #fff;margin-top: -50px;">-->
<!--        <p style="position: absolute;bottom: 380px;font-size: 32px;">Do not refresh payment processing</p>-->
<!--    <img src="<?php echo base_url('images/Loading_2.gif'); ?>" style="position: relative;-->
<!--    top: 0;-->
<!--    width: 200px;" alt="Loading...">-->
   
<!--</div>-->

<!--    <div id="content" style="display:none;">-->
        
<!--    </div>-->

  
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
    padding-top:10px;
    color:#333333;
    margin-bottom:20px;
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
           
                <h2>Payment Successfull</h2>
           
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
                      <!--<tbody>-->
                        <?php  //foreach($cins as $cins){  ?>
                      <!--  <tr >-->
                      <!--    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php //echo $cins['product_name']; ?></td>-->
                      <!--      <td style=" padding-top:10px; padding-bottom:10px;">-->
                      <!--        <a href='' target='_BLANK'> <?php //echo $cins['cin'];?></a>-->
                                
                              
                      <!--      </td>-->
                          
                          
                      <!--    <td style=" padding-top:10px; padding-bottom:10px;"><?php //echo $cins['payment_id'];?></td>-->
                      <!--  </tr>-->
                        <?php //} ?>
                        
                      <!--</tbody>-->
                      
                      
                      <tbody>
                        <?php foreach($cins as $cins){ ?>
                        <tr>
                            <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">
                                <?php echo $cins['product_name']; ?>
                            </td>
                        
                            <td style="padding-top:10px; padding-bottom:10px;">
                                <a href="javascript:void(0);" onclick="openCin('<?php echo $cins['cin']; ?>')">
                                    <?php echo $cins['cin']; ?>
                                </a>
                            </td>
                        
                            <td style="padding-top:10px; padding-bottom:10px;">
                                <?php echo $cins['payment_id']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                      
                      
                     </table>
                     <form id="cinForm"
                          method="post"
                          action="<?php echo base_url('welcome/setCinSession'); ?>"
                          target="_blank">
                        <input type="hidden" name="cin" id="cin">
                    </form>
                    
                    <div style='text-align:center;'>
                        <h4>
                            <!--<span style='color:red;'>Note: </span>-->
                        Click on any of the CINs listed above to access the respective student profile.<br>Please also check your registered email inbox for details on how to access the learning materials.<br>If you do not find the email in your inbox, kindly check your Spam/Junk folder as well.
                    </h4>
                    </div>
                    
            </div>
            
            <div class='col-sm-12' id='second'>
                <!--<h3>BACK <br>TO PROFILE</h3>-->
                <div class='row'> 
                <div class='col-4'>
                    
                </div>
                <div class='col-4 mb-2'>
                   
                        
                        <a href="<?php echo base_url();?>welcome/registration_log" style='text-decoration:none;' class='btn btn-outline-warning btn-lg'>Profile</a>
                   
                </div>
                <div class='col-4'>
                    
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
  <script>
        $(document).ready(function() {
            // Show the loader for 20 seconds
            setTimeout(function() {
                $('#loader').fadeOut(500, function() {
                    $('#content').fadeIn(500);
                });
            }, 30000); // 20000 ms = 20 seconds
        });
    </script>
    
    <script>
function openCin(cin)
{
    document.getElementById('cin').value = cin;
    document.getElementById('cinForm').submit();
}
</script>

<?php include("footer.php");?>