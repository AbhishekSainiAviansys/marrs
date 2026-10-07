
 
<!DOCTYPE html>
<html class="cspio">
<head>
	<meta charset="utf-8">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>MaRRS INTELLECTUAL SERVICES</title>

	<meta name="generator" content="MaRRS Coming Soon" />
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta property="og:url" content="" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Coming Soon Page" />
	<meta property="og:description" content="" />
	
	 <!--Font Awesome CSS -->
	<link rel="stylesheet" href="https://marrs.in/student_registration/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
	 <!--Bootstrap and default Style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	 <!--Google Fonts -->
	<link class="gf-headline" href='https://fonts.googleapis.com/css?family=Pacifico:400&subset=' rel='stylesheet' type='text/css'>
			
	 <!--Animate CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
	 <!--Calculated Styles -->
	<style type="text/css">
	
@media (min-width: 768px)
{
.navbar-right {
     margin: 0px -2px !important; 
}
}
/* --------------------------------------------------     */
/* CSS reset */
*,
*::after,
*::before {
  box-sizing: inherit;
  margin: 0;
  padding: 0;
}

html { font-size: 62.5%; }

body {
  box-sizing: border-box;
  font-family: 'lora', sans-serif;
  position: relative;
  /*background-color:#f4f4f4;*/
  /*background-image:linear-gradient(0deg, #e6f0ff, #80b3ff);*/
  overflow-x:hidden;
}
.sidebar {
    z-index: 11;
}

/* Typography =======================*/

/* Headings */

/* Main heading for card's front cover */
.card-front__heading {
  font-size: 1.5rem;
  margin-top: .25rem;
}

/* Main heading for inside page */
.inside-page__heading { 
  padding-bottom: 1rem; 
  width: 100%;
}



/* For both inside page's main heading and 'view me' text on card front cover */
.inside-page__heading,
.card-front__text-view {
  font-size: 1.3rem;
  font-weight: 800;
  margin-top: .2rem;
  font-family: 'lora', sans-serif;
  text-align:justify;
}

.inside-page__heading--city,
.card-front__text-view--city { color: #ff62b2; }

/* Front cover */

.card-front__tp { color: #fafbfa; }

/* For pricing text on card front cover */
.card-front__text-price {
  font-size: 1.2rem;
  margin-top: -.2rem;
}

/* Back cover */

/* For inside page's body text */
.inside-page__text {
  color: #333;
}

/* Icons ===========================================*/

.card-front__icon {
  fill: #fafbfa;
  font-size: 3vw;
  height: 3.25rem;
  margin-top: -.5rem;
  width: 3.25rem;
}

/* Buttons =================================================*/

.inside-page__btn {
  background-color: transparent;
  border: 3px solid;
  border-radius: .5rem;
  font-size: 1.2rem;
  font-weight: 600;
  margin-top: 2rem;
  overflow: hidden;
  padding: .7rem .75rem;
  position: relative;
  text-decoration: none;
  transition: all .3s ease;
  width: 90%;
  z-index: 10;
}

.inside-page__btn::before { 
  content: "";
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  transform: scaleY(0);
  transition: all .3s ease;
  width: 100%;
  z-index: -1;
}

.inside-page__btn--city { 
  border-color: #3385ff;
  color: #fff;
}

.inside-page__btn--city::before { 
  background-color: #ff40a1;
}


.inside-page__btn:hover { 
  color: #fafbfa;
  background-color:#eee8dd;
}

.inside-page__btn:hover::before { 
  transform: scaleY(1);
}

/* Layout Structure=========================================*/

.main {
  background: linear-gradient(
    to bottom right,
    #eee8dd,
    #e3d9c6
  );
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100vh;
  width: 100%;
}


/* Footer ====================================*/
#aa a{
    text-decoration:none;
    color:#fff;
}
#aa:hover{
    color:3385ff;
}
.footer {
  background-color: #3385ff;
   margin-top: 3rem;
  padding: 1rem 0;
  width: 100%;
}

.footer-text {
  color: #fff;
  font-size: 1.2rem;
  text-align: center;
}
#grad1 {
  height: 190px;
  width: 100%;
  /*background-color: red; */
  background-image: linear-gradient(180deg, #80b3ff, #e6f0ff);
  text-align:left;
  
}
.h{
   font-family: "lora", sans-serif;font-weight:700;letter-spacing:2px;word-spacing:4px; 
}
#product{
    background-color:#ffcc00;
    text-align:center; 
    border-radius:40px;margin: auto;
  width: 30%;
  border: 2px solid  #6600ff;
  color:#fff;
}
/* ---------------- navbar -------------*/
.topnav {
  overflow: hidden;
  background-color: white;
}

.topnav a {
  float: left;
  display: block;
  color: #3385ff;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  font-weight:700;
  padding-left:140px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
#li{
    display:none;
}
@media only screen and (max-width: 600px) {
    .h{
        display:none;
    }
    #product{
        font-size:12px;
        width:100%;
    }
    #media{
        width:100%;
        text-align:center;
    }
    #grad1 img{
        height:30px;
    }
    #corner{
        width:100%;
        padding-left:0px;
        margin:0px;
        padding-bottom:30px;
        text-align:center;
    }
    body{
        overflow-x:hidden;
    }
}
#row1{
    background-color:#ffcc00;
    text-align:center;
}
#col{
    text-align:center;
    /*background-color:#751aff;*/
    padding-top:30px;
}
	</style>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	 <!--jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	 <!--Modernizr -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	
	 <!--Google Analytics Code Goes Here-->
</head>

<script>
$(document).ready(function(){
	$('#log').mouseover(function() {
   		$('#li').show();
	});
});

function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

<body>
    <!--  =========  header  ========     -->
    <div class='container-fluid'>
        <div class='row' id='row1' style='background: linear-gradient(to bottom, rgba(1,44,85,1) 0%, rgba(0,28,57,1) 100%);'>
            
            <div class='col-md-12 col-lg-12' >
                
               <div> <img src='https://marrs.in/student_registration/images/header-011.jpg' style='padding-top:30px;width:100%' class="img-fluid w-100"></div>

            </div>
           
        </div>
    </div>

  <style>
 #contian{
     background: linear-gradient(to bottom, rgba(10,62,110,1) 0%, rgba(10,61,108,1) 50%, rgba(3,51,91,1) 51%, rgba(3,50,89,1) 100%);
     color:#fff;
 }
 #navvvv{
    padding-top:10px;
    padding-bottom:10px;
 }
    #navvvv a{
        font-size:18px;
        font-weight:600;
        text-align:center;
        color:#fff;
    }
    #coll:hover{
        /*background-color:#FFCC00;*/
        text-decoration:none;
    }
    .navbar-nav>li>a {
  
        padding-left: 180px;
    font-size: 20px;
    padding-right: 160px;
        padding-top: 18px;
    padding-bottom: 18px;
        /*color: #fff;*/
        color: white;
}

.dropdown-menu>li>a {
    
    padding: 6px 60px;
  
}


.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: #ccc6c6;
    color: white;
}
.navbar-toggle .icon-bar {
  color: white;
    background: #fff;
}

.navbar-toggle {
    position: relative;
    float: right;
    padding: 9px 10px;
    margin-top: 8px;
    margin-right: 15px;
    margin-bottom: 8px;
    background-color: #2c4e48e6;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    color: white;
}
.dropdown a{
    color:white;
}
/*@media (min-width: 768px){*/
/*.container-fluid>.navbar-collapse, .container-fluid>.navbar-header, .container>.navbar-collapse, .container>.navbar-header {*/
/*    margin-right: -10px !important;*/
/*    margin-left: -30px !important;*/
/*}*/
   
    
    
/*}*/
/*@media (min-width: 400px){*/
/*   .nav>li {*/
/*    position: relative;*/
/*    display: block;*/
    /*background: #337ab7;*/
/*}  */
    
/*}  */


</style>

<nav class="">
  <div class="container-fluid" style=" background: linear-gradient(to bottom, rgba(10,62,110,1) 0%, rgba(10,61,108,1) 50%, rgba(3,51,91,1) 51%, rgba(3,50,89,1) 100%);color:white;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" id='told'>
     
     
      <ul class="nav navbar-nav navbar-right" >
           <li><a href="https://marrs.in/">Home</a></li>
        <!--<li><a href="https://marrs.in/student_registration/welcome">Student Enroll</a></li>-->
        <!--<li><a href="https://marrs.in/student_registration/welcome/student">Learning programs</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Learning programs<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu" style='color:#ff9933;'>
            <li><a href="https://marrs.in/all_programs.php" style='color:#ff9933;'>All Programs</a></li>
            <li class="divider"></li>
            <li><a href="https://marrs.in/kinder.php" style='color:#ff9933;'>Kinder Garten Programs</a></li>
            <li class="divider"></li>
            <li><a href="https://marrs.in/1_8.php" style='color:#ff9933;'>Class 1-8 Programs</a></li>
            <li class="divider"></li>
            <li><a href="https://marrs.in/8_12.php" style='color:#ff9933;'>Class 8-12 Programs</a></li>
            
          </ul>
        </li>
       
            <li><a href="<?php echo base_url();?>welcome/logout2">Logout</a></li>
          
      </ul>
    </div>
  </div>
</nav>

  
  
 
</div>
<style>


.separator{
  display: flex;
  align-items: center;
}

.separator h3{
  padding: 0 1rem; /* creates the space */
}

.separator .line{
  flex: 1;
  height: 1px;
  background-color: #000;
}
.school_code {
    margin: 10px;
    padding: 10px;
}
h3{
    font-weight:700;
    color:#006699;
}
    #corner{
        background-color:#ffffb3;
        border-radius:20px;
        margin-left:250px;
        margin-right:250px;
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
      text-align: left;
      padding: 8px;
      border:solid 1px #006699;
      font-size:15px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

   @media (max-width:767px){
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    
}
label{
    font-weight:500;
    
}
</style>
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
    
    <form id="myForm" action="<?php echo base_url();?>welcome/offer" method="POST">
        <div class='container' id='corner1'>
            <div class='row'>
			     <div>
                   <h2 class="text-center">Registration Form</h2>  
                    
                </div>
                  
               </div>
               
             
				 <!--<div class="separator text-center">
                    <div class="line"></div>
                          <h4>Other Details</h4>
                    <div class="line"></div>  
                </div><br>-->
				 <div class="row">
                <!--<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Country </label>
                  <select class="form-control" name="country" Required>
				 	<option value="male">India<option>
			      </select>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">State</label>
                 <select class="form-control" name="state" id="state_id" Required>
				
				<?php 
				foreach($state as $val) { ?>
				<option value="<?php echo $val['state_subdivision_id'];?>" <?php if($val['state_subdivision_id']==$state_id){ echo 'selected="selected"';} ?>><?php echo $val['state_subdivision_name'];?></option>
				<?php } ?>
				</select>
				  </div>
               	<div class='col-sm-12 col-md-3 col-lg-3 mb-3'>
                    <label class="my-1">Area Code</label>
                   <select class="form-control" name="area_code" id="area_code" Required>
                       	<?php 
                       	$area = $this->db->get_where('areas',array('state_id'=>$school->state))->result_array();
                       	foreach($area as $val) { ?>
                       <option value="<?php echo $val['area_code'];?>" <?php if($val['area_code']==$area_code){ echo 'selected="selected"';} ?>> <?php echo $val['city_name'];?></option>
                     <?php }?>
                     </select>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-3 mb-3'>
                    <label class="my-1">School</label>
                   <select class="form-control" name="school" id="school_id" Required>
                    	<?php 
                       	$school_new = $this->db->get_where('school_new',array('state'=>$school->state))->result_array();
                       	foreach($school_new as $val) { ?>
                       <option value="<?php echo $val['school_code'];?>" <?php if($val['school_code']==$school->school_code){ echo 'selected="selected"';} ?>> <?php echo $val['school_name'];?></option>
                     <?php }?>  
                       </select>
                </div>-->
                <input type="hidden" name="area_code" value="<?php echo $area_code;?>">
                <input type="hidden" name="school" value="<?php echo $school->school_code;?>">
                <input type="hidden" name="state" value="<?php echo $state_id;?>">
                <input type="hidden" name="country" value="<?php echo '105';?>">
                
            </div>
               <br>
			    <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Student Details</h4>
                    <div class="line"></div>  
                </div><br>
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">First Name</label>
              <input type='text' class="form-control" name="first_name" value="" Required>
               </div>
              <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
               <label class="my-1">Middle Name</label>
                 <input type='text' class="form-control" value="" name="middle_name" >
              </div>
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Last Name</label>
                <input type='text' class="form-control" value="" name="last_name" Required>
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Personal Details</h4>
                    <div class="line"></div>  
                </div><br>
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Student Class</label>
				<select class="form-control" name="class" Required>
								<option value="1">Nursery</option>
								<option value="2">LKG</option>
								<option value="3">UKG</option>
								<option value="4">Class-1</option>
								<option value="5">Class-2</option>
								<option value="6">Class-3</option>
								<option value="7">Class-4</option>
								<option value="8">Class-5</option>
								<option value="9">Class-6</option>
								<option value="10">Class-7</option>
								<option value="11">Class-8</option>
								<option value="12">Class-9</option>
								<option value="13">Class-10</option>
								<option value="14">Class-11</option>
								<option value="15">Class-12</option>
								</select>
               
               </div>
			   
			    <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Gender</label>
				<select class="form-control" name="gender" Required>
				
				<option value="male">Male<option>
				<option value="female">FeMale<option>
				</select>
               
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Guardian Details</h4> 
                    <div class="line"></div>  
                </div><br>
			  <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Father Name</label>
                 <input type='text' class="form-control"  name="father_name" Required>
                </div>
                
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Mother Name</label>
                 <input type='text' class="form-control" name="mother_name" Required>
                </div>
				 </div>
				 
				<br>
				 <div class="separator text-center">
                    <div class="line"></div>
                          <h4>Contact Details</h4>
                    <div class="line"></div>  
                </div><br>
				 <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Mobile Number</label>
                    <input type='number' class="form-control" name="mobile" Required>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Whatsapp Number</label>
                    <input type='number' class="form-control" name="whatsapp" >
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Email ID</label>
                    <input type='email' class="form-control"  name="email" value="<?php echo $_SESSION['email'];?>" Required>
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


</body>
<script type="text/javascript">
$("#state_id").change(function(){
var state_id =this.value;
var statetext = $(this).find("option:selected").text();
 $('#state_ids').val(state_id);
  $('#stateid').val(statetext);
$.ajax({
url:"<?php echo base_url();?>welcome/arescodeList/",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area_code").html(result);
}});
});
 $("#area_code").change(function(){
    
 var area_code =this.value;
 
        $.ajax({
        url:"<?php echo base_url();?>welcome/schoolListByArea/",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school_id").html(result);
        	  var value = $('select#school_id option:selected').val();
        	  if(value=='0'){
                    $('#myModalpopup').modal('toggle');
                    $('#areacode').val(area_code);
        	      } else if(value=='1'){
        	      $('#myModalpopup').modal('toggle');
                  $('#areacode').val(area_code);
                  }else{
                  $.ajax({
                    url:"<?php echo base_url();?>welcome/schoolListByArea/",
                    data:{area_code:area_code},
                    type: 'post',
                    success:function(result)
                    {  
                         $("#school_id").html(result);
                    }});
                 }
        }});
       
 //alert(value);

 });
 
 
  $("#school_id").change(function(){
     
      var area = $('select#area_code option:selected').val();
      //alert(area);
       
       var value = this.value;
          if(value=='1'){
                    $('#myModalpopup').modal('toggle');
                    $('#areacode').val(area);
        	      } 
});
</script>






<Style>
#footer{
    margin:0;
    padding:0;
}
    #mad a{
        color:#ff9933;
    }
</Style>
<?php $this->load->view('footer');?>
 
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- Modal -->
  <div class="modal fade" id="myModalpopup" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Add Your School Details</h4>
        </div>
        <div class="modal-body">
         <div id='' class="card w-75 mx-auto p-4 my-3">
    
    <form id="myForm" action="<?php echo base_url();?>welcome/add_school" method="POST">
       
           
			    <div class="separator text-center">
                    <div class="line"></div>
                         <h4> Country  Details</h4>
                    <div class="line"></div>  
                </div><br>
                
                <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Country </label>
                  <select class="form-control" name="country" Required>
				 	<option value="105">India<option>
			      </select>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">State</label>
                
				  <input type='text' class="form-control" name="stateid" id="stateid" value="" Required>
				   <input type='hidden' class="form-control" name="state_id" id="state_ids" value="" >
                </div>
                	<div class='col-sm-12 col-md-3 col-lg-4 mb-3'>
                    <label class="my-1">Area Code</label>
                 
                        <input type='text' class="form-control" name="areacode" id="areacode" value="" Required>
                </div>
			
                
            </div>
                
                <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>School Details</h4>
                    <div class="line"></div>  
                </div><br>
                
                
                
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">School Name</label>
              <input type='text' class="form-control" name="school_name" value="" Required>
               </div>
              <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
               <label class="my-1">School Email</label>
                 <input type='text' class="form-control" value="" name="school_email" >
              </div>
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">School Phone</label>
                <input type='text' class="form-control" value="" name="school_phone" Required>
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>Coordinator Details</h4>
                    <div class="line"></div>  
                </div><br>
			   <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Coordinator Name</label>
				  <input type='text' class="form-control"  name="coordinator_name" Required>
               
               </div>
			   
			    <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Coordinator Email</label>
				  <input type='text' class="form-control"  name="coordinator_email" Required>
               
               </div>
               <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Coordinator Phone</label>
				  <input type='text' class="form-control"  name="coordinator_phone" Required>
               
               </div>
			  </div>
			  <br>
			   <div class="separator text-center">
                    <div class="line"></div>
                         <h4>School Address</h4> 
                    <div class="line"></div>  
                </div><br>
			  <div class="row">
			      <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">Pin Code  </label>
                 <input type='text' class="form-control"  name="pincode" Required>
                </div>
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">School Address1 </label>
                 <input type='text' class="form-control"  name="school_address1" Required>
                </div>
                
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                <label class="my-1">School Address2</label>
                 <input type='text' class="form-control" name="school_address2" Required>
                </div>
				 </div>
				 
				<br>
				 <div class="separator text-center">
                    <div class="line"></div>
                          <h4>Principal Details</h4>
                    <div class="line"></div>  
                </div><br>
				 <div class="row">
                <div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Principal Name</label>
                    <input type='text' class="form-control" name="school_principal_name" Required>
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Principal Email</label>
                    <input type='text' class="form-control" name="principal_email" >
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">Principal Phone</label>
                    <input type='text' class="form-control"  name="principal_phone" Required>
                </div>
            </div>
            
            	<br>
				 <div class="separator text-center">
                    <div class="line"></div>
                          <h4>Other Details</h4>
                    <div class="line"></div>  
                </div><br>
				 <div class="row">
               
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">School Medium</label>
                    <input type='text' class="form-control" name="school_medium" >
                </div>
				<div class='col-sm-12 col-md-4 col-lg-4 mb-3'>
                    <label class="my-1">school Board</label>
                    <input type='text' class="form-control"  name="school_board" Required>
                </div>
            </div>
            <br>
				<br>
				 
            <br>
            <div class='row'>
            
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <div style='padding-top:0px;padding-bottom:10px;text-align:center;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary w-25" style='background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                   
                </div>
                
            </div>
           
        
    </form>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



