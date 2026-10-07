
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
    a{
        text-decoration:none;
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
     

   

       <body>          
                <!-- ==========================  souravv  =========================== -->
    <section>
       
      
        
        <div class="container-fluid " style=" overflow:hidden;">
            
             <?php if(!empty($this->session->flashdata('success'))){ ?>
       
       <div class="row" style="padding:10px;background:green;text-align: center;
    color: #fff;">
          <h4><?php echo $this->session->flashdata('success');?></h4>
        </div> <?php }?> 
            
              <div class="row">
                     <h4 style="text-align:center;padding:20px"> 
                     Profile & Product Registration </h4>
                     </div>
            <div class="row p-3" id="student_login" style="">  
             <div class="col-sm-12 col-md-3 col-lg-3">
                 
                 <div class="card rounded-0">
                   
                    <!--<img src="..." class="card-img-top" alt="...">-->
                    
                  <div class="card-body">
                       <div class="text-center">My Profile</div>
                      <div class="text-center" style="font-size:3rem;">
                    <i class="fa-solid fa-circle-user my-2" ></i>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"><i class="fa-solid fa-envelope me-1"></i> Email: <?php echo $students['email'];?></li>
                      <!--<li class="list-group-item"><i class="fa-solid fa-signature me-1"></i>Name:</li>-->
                      <li class="list-group-item"><i class="fa-solid fa-mobile me-1"></i>Mobile No.: <?php echo $students['mobile'];?></li>
                    </ul>
                  </div>
                 </div>
                             <div class="card rounded-0 my-2">
  <div class="card-body">
    <h5 class="card-title">Register Another Student</h5>
    <a href="<?php echo base_url();?>welcome/registration_detail" class="btn btn-outline-danger reg_button">Click Here</a>
  </div>
</div>
       <!--          <table class="table table-bordered">-->
						 <!-- <thead>-->
						 <!--     <tr>-->
						 <!--         <td> -->
       <!--              STUDENT PROFILE  </td>-->
       <!--              <td><a class="" href=""> Profile</a></td>-->
                    <!-- <?php //echo base_url();?>welcome/student_profile/<?php //echo $students['id'];?>-->
						 <!--     </tr>-->
						 
						 <!--<tr>-->
						 <!--<td> Email</td>-->
						 <!--<td> </td>-->
						 <!-- </tr>-->
						 
						 <!--  <tr>-->
						 <!--<td> Mobile No.</td>-->
						 <!--<td> </td>-->
						 <!-- </tr>-->
						  
						 <!-- </thead>-->
						   
						 <!-- </table>-->
                 
             </div>
             <div class="col-sm-12 col-md-9 col-lg-9">
                 <table class="table table-striped table-hover">
						  <thead class="bg-dark text-light">
						  <tr>
						  <th>Sr.No. </th>
						  <th>Class </th>
						  <th>Student Name</th>
						  <th>Product Name</th>
						  <th>CIN</th>
						 
						   <th>Edit Profile</th>
						   <th> Material And  Download</th>
						  <!--<td>Register for a new product</td>-->
						  </tr>
						  </thead>
						  <tbody>
						
						  
						  <?php 
						  
						 //  print_r($student);
						  $i=1; foreach($student as $value){ ?>
						  <tr>
						  <td><?php echo $i; ?></td>
					
						  <td><?php echo $value['class'];?></td>
						   <td><?php echo $value['first_name'].' '.$value['last_name'];?></td>
						  <td><?php echo $value['product_name'];?></td>
						  <td><?php //echo $value['cin'];?></td>
						 
                           <td><a href="<?php echo base_url();?>welcome/student_profile/<?php echo $value['id'];?>"> Edit Profile</a></td>
						  <td><?php if(!empty($value['cin'])) { ?> <a href="<?php echo base_url();?>welcome/profile_cin/<?php echo $value['cin']; ?>"> Download Material And Competition</a>
						   <?php }else{ ?>
						    <a> Click On Register for a new product</a>
						    <?php }?>
						  </td>
						   
						  </tr>
						  <tr>
						      <td colspan="7">
						  <div class="reg_button"> <a class=" btn btn-sm btn-outline-danger" href="<?php echo base_url();?>welcome/new_product/<?php echo $value['id'];?>">Register for a new product</a>
                          </div></td>
						  </tr>
						  <?php $i++;} ?>
						  
						  <?php 
						  
						   
						  $i=1; foreach($student_cin as $value){ ?>
						  <tr>
						  <td><?php echo $i; ?></td>
					
						  <td><?php echo $value['class'];?></td>
						   <td><?php echo $value['student_name'];?></td>
						  <td><?php echo $value['product_name'];?></td>
						  <td><?php echo $value['cin'];?></td>
						 
                           <td><a href="<?php echo base_url();?>welcome/student_profile_cin/<?php echo $value['id'];?>"> Edit Profile</a></td>
						  <td><a href="<?php echo base_url();?>welcome/profile_cin/<?php echo $value['cin'];?>"> Download Material And Competition</a></td>
						  
						  </tr>
						  <tr>
						        <td colspan="7">
						  <div class="reg_button "> <a class=" btn btn-sm btn-outline-danger" href="<?php echo base_url();?>welcome/new_product/<?php echo $value['id'];?>">Register for a new product</a>
                          </div></td>
						  </tr>
						  <?php $i++;} ?>
						   
						   </tbody>
						  
						  </table>
             </div>
             
              <!--<div class="col-sm-12 col-md-3 col-lg-3">-->
      
                  
                   <!--<div class="reg_button " style="text-align:center;"> <a class=" btn btn-lg btn-outline-danger" ></a>-->
                   <!--       </div> -->
                  
              <!--</div>-->
               <!--<div class="col-12 m-2">-->
                 <!--<div class="card my-2">-->
                 <!--    <div class="card-body p-0">-->
               

                    <!--<div class="row">-->
                         
						 
						 
						
						  
                <!--</div>-->
                <!--   </div>-->
                <!--</div>-->
               <!--</div>-->
               </div>
               </div>
        
      
    </section>
           
  
  
  <script type="text/javascript" src="<?php echo base_url();?>public/common/mdb.min.js"></script>
 <footer style="padding: 1%;
    background-color: #005580;
    color: #ffff">
      <div class="container">
        <div class="row" id="footerContent">
          <div class="col-sm-12 col-md-12 col-lg-12  text-center">
               <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in" >Home</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/about.php" >About Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/contact.php" >Contact Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/refund_cancellation.php" >Refund Policy</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/terms_conditions.php" >Terms & Conditions</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/privacy.php" >Privacy</a>
          </div>
          
        </div>
      </div>
    </footer>
    <section class="p-3" style="background: linear-gradient( to bottom, rgba(1, 44, 85, 1) 0%, rgba(0, 28, 57, 1) 100% );">
    <div class="container">
        <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 text-center"> <a class="p-2 text-white" style="text-decoration:none;" href='#' >© Aviansys Technology Pvt. Ltd. 2022-2023 </a></div>
        </div>
    </div>
    </section>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
        
    </body>
    </html>