<?php $cin= $this->session->userdata('cin');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Marrs CIN Login </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    li:hover{
        background-color:#0099e6;
    }
    .navbar{
        background-color:#b3e6ff;
    }
    .head{
        width:100%;
        font-weight: bold;
    }
    li{
        font-size:16px;
    }
</style>
<body>
    
    <div class='container-fluid' style='background-color:#005580;color:white;height:80px;text-align:center;'>
        <div class='row'>
            <div class='col-sm-4' class='head' >
               <img src='<?php echo base_url();?>images/marrs_logo.png' style='padding-top:5px;'>
            </div>
            <div class='col-sm-8' style='text-align:left;'>
                <h1>MaRRS Intellectual Services (P) Ltd.</h1>
            </div>
        </div>
        
    </div>
               
    
    
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <!--<a class="navbar-brand" href="#">National Level </a>-->
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="<?php echo base_url();?>neww/index"><img src='<?php echo base_url();?>images/prof.png' style='padding-top:0px;height:25px;width:25px;'>Profile</a></li>
      <li><a href="<?php echo base_url();?>neww/profile_edit"><img src='<?php echo base_url();?>images/edit.png' style='padding-top:0px;height:25px;width:25px;'>Edit Profile</a></li>
      <li><a href="<?php echo base_url();?>neww/net"><img src='<?php echo base_url();?>images/product.png' style='padding-top:0px;height:25px;width:25px;'>Register & Download</a></li>
      
      <li><a href="<?php echo base_url();?>neww/logout"><img src='<?php echo base_url();?>images/logout.png' style='padding-top:0px;height:25px;width:25px;'>Logout</a></li>
      <!--<li><a href="<?php echo base_url();?>neww/craft">*</a></li>-->
    </ul>
  </div>
  
</nav>

</body>