<?php
// print_r($state);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>MaRRS Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    .container {
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
      padding: 30px;
      margin-top: 50px;
    }
    h2 {
      font-family: 'Arial Black', sans-serif;
      color: #007bff;
    }
    label {
      font-weight: bold;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
    <div class="text-center mb-4">
        <h2>MaRRS Registration Form 2024-25</h2>
        <h3 style='color:#ffa64d;'><?php echo $school->school_name; ?></h3>
    </div>
  
  <form method="POST">
      <button type="submit" class="btn btn-warning btn-sm" name="back">Back</button>
  </form>
    <form method="POST">
        
        <div class="row mb-3">
            <div class="col-6">
                <label for="first_name" class="form-label">First Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" required>
            </div>
            
            <div class="col-6">
                <label for="last_name" class="form-label">Last Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
            </div>
        </div>
        <div class='row mb-3'>
            <div class="col-6">
                <label for="state" class="form-label">Gender:<span class='text-danger'>*</span></label>
                <select class="form-control" name="gender"  required>
                    <option value=''>-- Select Gender --</option>
                    <option value='M'>Male</option>
                    <option value='F'>Female</option>
                </select>    
            </div>
            
        
            <div class="col-6">
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
            
        
        </div>
        <div class="text-center ">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>