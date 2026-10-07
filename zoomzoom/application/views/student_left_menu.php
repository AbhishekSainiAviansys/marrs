<head>	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" >
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
	<link rel="stylesheet" href="<?php echo base_url();?>css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
	 <!--Bootstrap and default Style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	 <!--Google Fonts -->
	<link class="gf-headline" href='https://fonts.googleapis.com/css?family=Pacifico:400&subset=' rel='stylesheet' type='text/css'>
			
	 <!--Animate CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<style>
body {
  font-family: "Lato", sans-serif;
  font-size:16px;
  font-weight:500;
}
.dropdown-btn{
    border-radius:none;
    width:100%;
    background:#6600FF;
    border-radius:none;
    height:50px;
    padding: 1px 16px;
    color:#fff;
}
.sidebar {
  margin: 0;
  padding: 0;
  width: 240px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #6600FF;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
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
#dropdown-btn{
    width:100%;
    color:#FFF;
    
}
#productt{
    border-radius:none;
    width:100%;
    background:#6600FF;
    border-radius:none;
    height:50px;
    padding: 1px 16px;
    color:#fff;
}
#product:hover{
    background-color:black;
    color:#fff;
}
</style>

<div class="sidebar">
 <a class="active" href="<?php echo base_url();?>welcome/out2/id/<?php echo $prid; ?>">PROFILE</a>
  
  
  <button class="dropdown-btn" class="active" id='productt'>LEARNING PROGRAMMES 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container" class="active" >
   <a href="<?php echo base_url();?>welcome/subscribe_product/id/<?php echo $prid; ?>">SUBSCRIBED </a>
    <a href="<?php echo base_url();?>welcome/product_purchase/id/<?php echo $prid; ?>">YET TO PURCHASE</a>
    <!--<a href="#">Link 3</a>-->
  </div>
  <a href="<?php echo base_url();?>welcome/logout/id/<?php echo $prid; ?>">LOGOUT</a>
</div>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
