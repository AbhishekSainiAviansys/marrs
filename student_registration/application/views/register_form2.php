
<!DOCTYPE html>
<html>
<head>
    <title>Marrslms</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="<?php echo base_url();?>css/custom.css?update1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <body>
    <header>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <img src="/images/header-011.jpg" alt="" class="img-fluid w-100">       
            <!--<h6 class="text-white my-2 ms-2">Committed to Empower the Child</h6>-->
          </div>
         
      </header>
  
<div class="container">
    <div class="row text-center mb-3">
            <div class="col-6">
            <h3 class="pt-3">MaRRS Registration Form 2024-25</h3>
            </div>
            <div class="col-6">
            <h3 class="pt-3" style='color:#ffa64d;'>School : <?php echo $school->school_name; ?></h3>
            </div>
    </div>
  
    <form method="POST">
        <div class="row mb-3">
            <div class="col-4">
                <label for="first_name" class="form-label">First Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required>
            </div>
            <div class="col-4">
                <label for="middle_name" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" id="middle_name" placeholder="Enter Middle Name" name="middle_name">
            </div>
            <div class="col-4">
                <label for="last_name" class="form-label">Last Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
            </div>
        </div>
        <div class='row mb-3'>
            <div class="col-4">
                <label for="state" class="form-label">Gender:<span class='text-danger'>*</span></label>
                <select class="form-control" name="gender"  required>
                    <option value=''>-- Select Gender --</option>
                    <option value='M'>Male</option>
                    <option value='F'>Female</option>
                </select>    
            </div>
            <div class="col-4">
                <label for="state" class="form-label">Father Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="" placeholder="Enter Father Name" name="father_name"  required>
            </div>
            <div class="col-4">
                <label for="address" class="form-label">Mother Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="" placeholder="Enter Mother Name" name="mother_name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <label for="class" class="form-label">Class:<span class='text-danger'>*</span></label>
                <select class="form-select" id="class" name="class" required>
                    <option value="Nursery">Nursery</option>
                    <option value="LKG">LKG</option>
                    <option value="UKG">UKG</option>
                    <option value="Class-1">Class-1</option>
                    <option value="Class-2">Class-2</option>
                    <option value="Class-3">Class-3</option>
                    <option value="Class-4">Class-4</option>
                    <option value="Class-5">Class-5</option>
                    <option value="Class-6">Class-6</option>
                    <option value="Class-7">Class-7</option>
                    <option value="Class-8">Class-8</option>
                    <option value="Class-9">Class-9</option>
                    <option value="Class-10">Class-10</option>
                    <option value="Class-11">Class-11</option>
                    <option value="Class-12">Class-12</option>
                </select>
            </div>
            <div class="col-4">
                <label for="state" class="form-label">State:</label>
                <input type="text" class="form-control" id="state" placeholder="Enter State" name="state" value="<?php echo $state->state_subdivision_name; ?>" readonly>
            </div>
            <div class="col-4">
                <label for="address" class="form-label">Address:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
            </div>
        </div>
        <div class='row mb-3'>
            <div class="col-4">
                <label for="state" class="form-label">Email:</label>
                <input type="text" class="form-control" id="" placeholder="Enter State" name="email" value="<?php echo $email; ?>" readonly>
            </div>
            <div class="col-4">
                <label for="address" class="form-label">Mobile:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="" placeholder="9999999999" name="mobile" required>
            </div>
            <div class="col-4 text-center pt-5">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
        </div>
        
    </form>
</div>

<footer style="background-color: #14223b;">
      <div class="container">
        <div class="row" id="footerContent" style="background-color: #14223b;padding:6px">
          <div class="col-sm-12 col-md-12 col-lg-6  text-center">
               <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in" >Home</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/about.php" >About Us</a>
                <a class="p-2 text-white" style="text-decoration: none;" href="https://marrs.in/contact.php" >Contact Us</a>
          </div>
          
          <div class="col-sm-12 col-md-12 col-lg-6 text-center">
                          <small class="text-white">© <a href='#' style="text-decoration: none;color:orange;" >Aviansys Technology Pvt. Ltd. </a>
                          <?php 
                                $year = date("Y");
                                $previousyear = $year -1;
                               echo $previousyear.'-'.$year;
                                
                          ?></small>

          </div>
        </div>
      </div>
    </footer>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
       
    </body>
    </html>
