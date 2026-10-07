
 
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

  <?php $this->load->view('navbar'); ?>
  
  
  
 
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
   
  <form id="myForm" action="" method="POST">
        <div class='container' id='corner1'>
            <div class='row'>
			     <div>
                   <h2 class="text-center">School Form</h2>  
                    
                </div>
                  
               </div>
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
                 <select class="form-control" name="state" id="state_id" Required>
				
				<?php 
				foreach($state as $val) { ?>
				<option value="<?php echo $val['state_subdivision_id'];?>"><?php echo $val['state_subdivision_name'];?><option>
				<?php } ?>
				</select>
                </div>
                	<div class='col-sm-12 col-md-3 col-lg-4 mb-3'>
                    <label class="my-1">Area Code</label>
                   <select class="form-control" name="area_code" id="area_code" Required>
                       </select>
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
                    <label class="my-1">school Medium</label>
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
           
        </div>
    </form>

</body>
<script type="text/javascript">
$("#state_id").change(function(){
var state_id =this.value;

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

