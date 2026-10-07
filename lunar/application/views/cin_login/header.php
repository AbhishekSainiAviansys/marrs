
<!DOCTYPE html>
<html>
<head>
    <title>Marrslms</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css?update1">
    <style>
        a{
            text-decoration:none !important;
        }
        
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
              <img src='https://marrs.in/student_registration/certificate_logo/flunar.jpg' class="img-fluid d-inline-block align-text-top" alt='image' width="200">
                </a>
                
                 
            
       
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                   <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              
                        
                        <li class="nav-item dropdown">
                             <a class="navbar-link  dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic" style="width:50px;"/><br/>
                                <span class="text-white">Profile</span>
                             </a>
							
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/index" aria-current="page">Pofile View</a></li>
							
							<li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/edit_cin_login" aria-current="page">Pofile Edit</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/invoice" aria-current="page">Invoice </a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/resetpassword">Reset Password</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/enquiry">Support Ticket</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url();?>Cin_login/logout">Logout</a></li>
                          </ul>
                        </li>
                      </ul>
              </div>
            </div>
          </nav>
    </header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
     <script>
 $("a.close").click(function(){
  alert("Registration Closed.");
});
 </script>
