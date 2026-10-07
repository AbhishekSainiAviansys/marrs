<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Student Product List</title>

	<meta name="generator" content="MaRRS Coming Soon" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta property="og:url" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Coming Soon Page" />
	<meta property="og:description" content="" />
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    /> 
    <style>
      #toptitle {
        background: linear-gradient(
          to bottom,
          rgba(1, 44, 85, 1) 0%,
          rgba(0, 28, 57, 1) 100%
        );
      }
      .navbar {
        background: #005580 !important;
      }
      .nav-link {
        color: #ffff !important;
        font-size: 1.2rem !important;
      }
      .nav-link:hover {
        color: #ffff !important;
      }
      .portalname {
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
      }
      .portalname h2 {
        font-size: 3rem;
        font-family: fantasy;
      }
      .dropdown-menu{
          box-shadow: 0 2px 4px 0 rgb(0 0 0 / 16%), 0 2px 8px 0 rgb(0 0 0 / 12%);
    border-radius: 0px !important;
      }
    </style>
 
  </head>
  <body>
    <section>
      <div class="container-fluid" id="toptitle">
        <div class="row p-3">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <img src="<?php echo base_url();?>images/header-011.jpg" alt=""  class="img-fluid w-100">   
            <!--<h6 class="text-white my-2 ms-2">Committed to Empower the Child</h6>-->
          </div>
          
        </div>
      </div>
    </section>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
             
            <a  class="nav-link active"
                aria-current="page" href="<?php echo base_url();?>welcome/studentdata">PROFILE</a>

            </li>
           
           
          </ul>
          <ul class="navbar-nav mx-auto">
               <li class="nav-item"> <a class="nav-link active" href="#">REGISTER NOW</a></li>
          </ul>
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#">Study Material</a>
            </li>
               
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav mx-auto">
             <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url();?>welcome/logout">LOGOUT</a>

            </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700);

body {
  /*background: #999;*/
  
 
  font-family: "Open Sans Condensed", sans-serif;
  
}
h1{
    font-weight:600;
    font-family: sans-serif;
}
h3{
        font-weight:600;
}
h6{
        font-family: fantasy;
}
#bg {
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  /*background: url(<?php echo base_url()?>images/DSC_0232.JPG) no-repeat center center fixed;*/
  background-size: cover;
  -webkit-filter: blur(4px); 
  background-size: cover;
  background-repeat: no-repeat;
  background-size: cover;
  z-index:-111111;
}

#head{
    text-align:center;
    color:#fff;
    
    
}
#form{
    padding-top:20px;
    border: 2px solid #fff;
    border-radius: 25px;
     box-shadow: 5px 10px 18px #fff;
}
#pad{
    padding-top:30px;
}
label{
    font-size:15px;
}
#student_login img{
    width:80px;
    height:auto;
        background: whitesmoke;
    border-radius: 50px;
    display: block;
    margin: auto;
}
#student_login p{
    color:#ffff;
    text-align:center;
    width:60%;
    margin:0 auto;
    font-family: sans-serif;
}

#cin{
    border-radius:25px;
    width:70%;
    margin-left:15%;
    /*margin-right:50%;*/
}
 #toptitle {
        background: linear-gradient(
          to bottom,
          rgba(1, 44, 85, 1) 0%,
          rgba(0, 28, 57, 1) 100%
        );
      }
      .navbar {
        background: #005580 !important;
      }
      .nav-link {
        color: #ffff !important;
        font-size: 1.2rem !important;
      }
      .nav-link:hover {
        color: #ffff !important;
      }
      .portalname {
        display: flex;
        justify-content: center;
        text-align: center;
        align-items: center;
      }
      .portalname h2 {
        font-size: 3rem;
        font-family: fantasy;
      }
      .dropdown-menu{
          box-shadow: 0 2px 4px 0 rgb(0 0 0 / 16%), 0 2px 8px 0 rgb(0 0 0 / 12%);
    border-radius: 0px !important;
      }
</style>
     
  <a  onclick="history.back()" class="btn btn-outline-secondary btn-sm text-start" style="font-size: 16px;position: relative;
    left: 100px;
    top: 10px;"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px"></i>BACK</a>
    

<body>
   
        <?php if(!empty($this->session->flashdata('msg'))){ ?><div class='row' style="background:green">
			  
                   <h4 class="text-center" style="color: white;
    font-weight: bold;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
    padding: 10px;"><?php echo $this->session->flashdata('msg');?></h4>  
                    
                </div>
                <?php } ?>
       
       
    <div id='' class="card w-75 mx-auto p-4 my-3">
    
    <form id="myform" action="<?php echo base_url();?>welcome/Purchase_ByClass" method="POST">
        <div class='container' id='corner1'>
            <div class='row'>
			    
                   <h2 class="text-center">Registration for a New Products </h2>  
                   
                </div>
                <br>
               
			   <div class="row">
			       <div class='col-sm-12 col-md-4 col-lg-3 mb-3'></div>
                <div class='col-sm-12 col-md-4 col-lg-6 mb-3'>
                <label class="my-1">Student Class</label>
				<select class="form-control" name="class" required="required">
				              
								<option value="1" <?php if($class=='Nursery'){ echo 'selected="selected"';} ?>>Nursery</option>
								<option value="2" <?php if($class=='LKG'){ echo 'selected="selected"';} ?>>LKG</option>
								<option value="3" <?php if($class=='UKG'){ echo 'selected="selected"';} ?>>UKG</option>
								<option value="4" <?php if($class=='Class-1'){ echo 'selected="selected"';} ?>>Class-1</option>
								<option value="5" <?php if($class=='Class-2'){ echo 'selected="selected"';} ?>>Class-2</option>
								<option value="6" <?php if($class=='Class-3'){ echo 'selected="selected"';} ?>>Class-3</option>
								<option value="7" <?php if($class=='Class-4'){ echo 'selected="selected"';} ?>>Class-4</option>
								<option value="8" <?php if($class=='Class-5'){ echo 'selected="selected"';} ?>>Class-5</option>
								<option value="9" <?php if($class=='Class-6'){ echo 'selected="selected"';} ?>>Class-6</option>
								<option value="10" <?php if($class=='Class-7'){ echo 'selected="selected"';} ?>>Class-7</option>
								<option value="11" <?php if($class=='Class-8'){ echo 'selected="selected"';} ?>>Class-8</option>
								<option value="12" <?php if($class=='Class-9'){ echo 'selected="selected"';} ?>>Class-9</option>
								<option value="13" <?php if($class=='Class-10'){ echo 'selected="selected"';} ?>>Class-10</option>
								<option value="14" <?php if($class=='Class-11'){ echo 'selected="selected"';} ?>>Class-11</option>
								<option value="15" <?php if($class=='Class-12'){ echo 'selected="selected"';} ?>>Class-12</option>
								</select>
               
               </div>
			   
			  </div>
			  
			   <br>
			  <div class="row">
			    <div class='col-sm-12 col-md-4 col-lg-3 mb-3'></div>
                <div class='col-sm-12 col-md-4 col-lg-6 mb-3'>
                <label class="my-1">Access Code *</label>
				<input type="text" name="access_code" class="form-control" value="<?php echo $school_code;?>" Placeholder="Enter Access Code">
                <span style="font-size: 12px;">* For ACCESS CODE, Connect your School Coordinator or MaRRS Franchise</span>
               </div>
			  </div>
				
				<br>
            <div class='row'>
            
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary w-25" style='background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                   
                </div>
                
            </div>
           
        </div>
    </form>
</div>
<script><script>
  $('#myform').validate({ // initialize the plugin
            rules: {
          user_type:{ required: true},
         }
      });
</script></script>
<?php $this->load->view('footer');?>


