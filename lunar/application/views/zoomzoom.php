<?php include("header.php");include('navbar.php'); ?>


<head>	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" >


</head>

    <!-- =================== Form Start ===================== -->

<style>
    body{
        background-color:#f4f4f4;
    }
        #cornerr{
            margin-top:30px;
            margin-left:300px;
            margin-right:300px;
            margin-bottom:50px; 
            text-align:center;
            background-color:white;
            border-radius:20px;
        }
        @media screen and (max-width: 992px) {
        #cornerr{
        
            margin-top:30px;
            margin-left:0px;
            margin-right:0px;
            margin-bottom:50px;
        }
       
            #conform{
                text-align:center;
                width:40%;
            }
        }
#pad{
    padding-top:30px;
}
footer{
    padding: 1%;
    background: linear-gradient(180deg, #266cb7 0%, #182066 100%);
    color: #ffff;
}

@media screen and (min-width: 769px) {
   .navbar-nav>li>a {
    padding-left: 200px;
    font-size: 20px;
    padding-right: 180px;
    padding-top: 18px;
    padding-bottom: 18px;
    color: #fff;
}

}
#imggg{
    text-align:center;
    
}
#imggg img{
    height:240px;
    width:290px;
    padding-top:20px;
}
#conform{
    display:none;
}
#ok{
    padding-left:135px;
}
</style>    

<script>
 $(function() {
 var a = '<?php print_r($this->session->flashdata("schoolname")); ?>';
        //alert(a);
        if(a){
            $('#welcome').css('display','none');
            $('#conform').css('display','block');
        }
});
        
 
    
</script>    
<body>
    <div id='cornerr'>
        <div class='container-fluid'> 
            <div class='row'>
                <div class='col-sm-6'>
                    <div id='heading'><h3>Register for the<br>MaRRS ZoomZoom Programs</h3></div>
                    <div id='imggg' > <img src='<?php echo base_url(); ?>images/schoool.png' ></div>
                </div>
                <div class='col-sm-6'>
                    <form method="post" action="" style='padding-bottom:30px;padding-left:50px;text-align:center;' id='pad'>
                        <div style='padding-bottom:0px;text-align:center; color:black;'>
                            <h3>Enter Access Code For ZOOMZOOM New Registration</h3><h5 style='color:#ff9933;'>Enter PRID For ZoomZoom Student Login</h5>
                        </div>
                        <div style="padding-top:20px;">
                            <input type='text' name="schoolaccesscode" id="schoolaccesscode" value="" placeholder='PRID Zoom Zoom ...' style='height:40px;widh:100%;'>
                        </div>
                        <div >
                        
                        </div>
                        <div id='pad'>
                            <button type="submit" id="welcome" class="btn btn-primary" style='width:50%;height:40px;background-color:#ff9933;font-size:18px;' name='check'>Verify</button>
                            <div id='ok'>
                            <button type="submit" id="conform" class="btn btn-primary" name="submit" style='width:50%;height:40px;background-color:#ff9933;font-size:18px;' name='conform'>Confirm</button>
                            </div>
                        </div>
                        
                        
                        <div ><?php if(!empty($this->session->flashdata('schoolerror'))){ ?>
                    
                    
                            <h6 style='color:red;'> <?php echo $this->session->flashdata('schoolerror');?></h6>
                                <?php  } ?>
                        
                        </div>
                        <!--<div id='ok'>-->
                            
                        <!--</div >-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id='pad' ></div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <small>Copyright © Aviansys Technologies Pvt. Ltd. 
                    <!--<img src="<?php echo base_url();?>images/Logo.png" width="125px" height="32px" alt="Logo"/>--></small>
                </div>
                <div class="col-md-6 text-center">
                    <small>@All Rights Reserved (2022-2023)</small>
                </div>
            </div>
        </div>
    </footer>
      <script type="text/javascript">
//       $("#schoolaccesscode").change(function(){
//          var BASE_URL='https://marrs.in/student_registration';
//         var schoolaccesscode=this.value;
        
//         $.ajax({
//           url:BASE_URL+"/welcome/ajax/",
//             data:{id:schoolaccesscode},
//             type: 'post',
//             success:function(result)
// 			{
// 			    console.log(result);
// 				//alert(result);
//                  $("#category").html(result);
//         }});
//     }); 
 </script>

</body>
</html>