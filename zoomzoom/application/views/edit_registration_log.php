<?php
// print_r($student);
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
        <h2>Update Details</h2>
        <!--<h3 style='color:#ffa64d;'><?php echo $school->school_name; ?></h3>-->
    </div>
  
  <form method="POST">
      <button type="submit" class="btn btn-warning btn-sm" name="back">Back</button>
  </form>
    <form method="POST">
        
        <div class="row mb-3">
            <div class="col-4">
                <label for="first_name" class="form-label">First Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="first_name" value="<?php echo $student->first_name; ?>"  placeholder="Enter First Name" name="first_name" required>
            </div>
            
            <div class="col-4">
                <label for="middle_name" class="form-label">Middle Name:</label>
                <input type="text" class="form-control" id="middle_name" value="<?php echo $student->middle_name; ?>"  placeholder="Enter Middle Name" name="middle_name" >
            </div>
            
            <div class="col-4">
                <label for="last_name" class="form-label">Last Name:<span class='text-danger'>*</span></label>
                <input type="text" class="form-control" id="last_name" value="<?php echo $student->last_name; ?>" placeholder="Enter Last Name" name="last_name" required>
            </div>
        </div>
        <div class='row mb-3'>
            <div class="col-6">
                <label for="state" class="form-label">Gender:<span class='text-danger'>*</span></label>
                <select class="form-control" name="gender"  required>
                    <option value=''>-- Select Gender --</option>
                    <option value='M' <?php if(isset($student->gender) && $student->gender=='M'){echo "selected='selected'";}?>>Male</option>
                    <option value='F' <?php if(isset($student->gender) && $student->gender=='F'){echo "selected='selected'";}?>>Female</option>
                </select>    
            </div>
            
        
            <div class="col-6">
                <label for="class" class="form-label">Class:<span class='text-danger'>*</span></label>
                <select class="form-select" id="class" name="class" required>
                    <option value="Nursery" <?php if(isset($student->class) && $student->class=='Nursery'){echo "selected='selected'";}?>>Nursery</option>
                    <option value="LKG" <?php if(isset($student->class) && $student->class=='LKG'){echo "selected='selected'";}?>>LKG</option>
                    <option value="UKG" <?php if(isset($student->class) && $student->class=='UKG'){echo "selected='selected'";}?>>UKG</option>
                    <option value="Class-1" <?php if(isset($student->class) && $student->class=='Class-1'){echo "selected='selected'";}?>>Class-1</option>
                    <option value="Class-2" <?php if(isset($student->class) && $student->class=='Class-2'){echo "selected='selected'";}?>>Class-2</option>
                    <option value="Class-3" <?php if(isset($student->class) && $student->class=='Class-3'){echo "selected='selected'";}?>>Class-3</option>
                    <option value="Class-4" <?php if(isset($student->class) && $student->class=='Class-4'){echo "selected='selected'";}?>>Class-4</option>
                    <option value="Class-5" <?php if(isset($student->class) && $student->class=='Class-5'){echo "selected='selected'";}?>>Class-5</option>
                    <option value="Class-6" <?php if(isset($student->class) && $student->class=='Class-5'){echo "selected='selected'";}?>>Class-6</option>
                    <option value="Class-7" <?php if(isset($student->class) && $student->class=='Class-6'){echo "selected='selected'";}?>>Class-7</option>
                    <option value="Class-8" <?php if(isset($student->class) && $student->class=='Class-7'){echo "selected='selected'";}?>>Class-8</option>
                    <option value="Class-9" <?php if(isset($student->class) && $student->class=='Class-8'){echo "selected='selected'";}?>>Class-9</option>
                    <option value="Class-10" <?php if(isset($student->class) && $student->class=='Class-9'){echo "selected='selected'";}?>>Class-10</option>
                    <option value="Class-11" <?php if(isset($student->class) && $student->class=='Class-10'){echo "selected='selected'";}?>>Class-11</option>
                    <option value="Class-12" <?php if(isset($student->class) && $student->class=='Class-11'){echo "selected='selected'";}?>>Class-12</option>
                </select>
            </div>
            
        
        </div>
        <div class="text-center ">
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </div>
    </form>
</div>

</body>
</html>