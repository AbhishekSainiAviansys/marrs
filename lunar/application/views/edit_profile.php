<?php //include('header.php');  include("navbar.php"); 
foreach ($student as $row){
    $prid=$row->PRID;
    $fname=$row->first_name;
    $mname=$row->middle_name;
    $lname=$row->last_name;
    $moname=$row->mother_name;
    $faname=$row->father_name;
    $class=$row->class;
    $school=$row->school_code;
    $gender=$row->gender;
    $mobile=$row->mobile;
    $whatsapp=$row->whatsapp;
    $email=$row->email;
}

?>
<head>
    <style>
        body{
    background-color:#80bfff;
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:150px;
    margin-right:150px;
    padding-top:20px;
    padding-bottom:20px;
    font-size:20px;
    color:black;
}
#corner1{
    margin-left:100px;
    margin-right:100px;
    padding-top:20px;
    padding-bottom:20px;
    
}
#corner h3{
    color:#ff9933;
    /*padding-top:20px;*/
    /*font-size:18;*/
}

input[type=text], select, textarea, input[type=email] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  font-size:15px;
}

label {
  padding: 5px 5px 5px 0;
  display: inline-block;
  font-size:15;
  font-weight:300;
}
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
    </style>
</head>
<div style='padding-bottom:30px;'>
<div id='corner' style='text-align:center;'>
    <h1>Edit Details</h1>
    <form id="myForm" action="" method="POST">
        <div class='container-fluid' id='corner1'>
            <div class='row'>
                <div class="separator">
                    <div class="line"></div>
                         <h3>Student Details</h3>
                    <div class="line"></div>
                </div>
               
               
                <div class='col-sm-4'>
                    <label>First Name</label>*
                    <input type='text' value="<?php echo $fname; ?>" name="first_name" readonly>
                </div>
                <div class='col-sm-4'>
                    <label>Middle Name</label>
                    <input type='text' value="<?php echo $mname; ?>" name="middle_name" readonly>
                </div>
                <div class='col-sm-4'>
                    <label>Last Name</label>*
                    <input type='text' value="<?php echo $lname; ?>" name="last_name" readonly>
                </div>
            </div>
            
            <div class='row'>
                
                <div class="separator">
                    <div class="line"></div>
                         <h3>Personal Details</h3>
                    <div class="line"></div>
                </div>
                <div class='col-sm-4'>
                    <label>Student Class</label>*
                    <select name="class" id="class" style="width: 100%;font-size: 17px;font-family: Raleway;border:1px solid #aaaaaa;" disabled >
                               
                                 <?php
                                 
                                 $query = $this->db->query("SELECT * FROM class;");
                                
                                 foreach ($query->result() as $row)
                                {
                                echo "<option value='{$row->class_id}'>{$row->class_name}</option>";
                                }
                                
                                ?>
                        
                            </select>
                </div>
                   <br> 
                <div class='col-sm-4'>
                   
                    
                     <label>Gender</label>
                    <select name="gender">
                        <option value="<?php if($gender=='Male') { echo $gender;} ?>" selected="selected" >Male</option>
                        <option value="<?php if($gender=='Female') { echo $gender;} ?>"  selected="selected">Female</option>
                        <option value="<?php if($gender=='other') { echo $gender;} ?>"  selected="selected">Other</option>
                     
                        </select>
                  
                </div>
                <div class='col-sm-4'>
                    </div>
            </div>
             <div class='row'>
                <div class="separator">
                    <div class="line"></div>
                         <h3>Guardians Details</h3>
                    <div class="line"></div>
                </div>
                <div class='col-sm-6'>
                    <label>Father Name</label>*
                    <input type='text' value="<?php echo $faname; ?>" name="father_name" required>
                </div>
                <div class='col-sm-6'>
                    <label>Mother Name</label>*
                    <input type='text' value="<?php echo $moname; ?>" name="mother_name" required>
                </div>
                
            </div>
            <div class='row'>
                <!--<h3>Contact Details</h3>-->
                <div class="separator">
                    <div class="line"></div>
                         <h3>Contact Details</h3>
                    <div class="line"></div>
                </div>
                <div class='col-sm-4'>
                    <label>Mobile Number</label>*
                    <input type='text' value="<?php echo $mobile; ?>" name="mobile" pattern="[7-9]{1}[0-9]{9}" 
       title="Phone number with 7-9 and remaing 9 digit with 0-9" required>
                </div>
                <div class='col-sm-4'>
                    <label>Whatsapp Number</label>*
                    <input type='text' value="<?php echo $whatsapp; ?>" name="whatsapp" pattern="[7-9]{1}[0-9]{9}" 
       title="Phone number with 7-9 and remaing 9 digit with 0-9" required>
                </div>
                <div class='col-sm-4'>
                    <label>Email Id</label>*
                    <input type='email' value="<?php echo $email; ?>" name="email" required>
                </div>
            </div>
           
            <div class='row' style='padding-top:50px;'>
                <div class='col-sm-4'>
                    
                </div>
                <div class='col-sm-4'>
                    <div style='padding-top:50px;padding-bottom:10px;' >
                        <button type="submit" name="submit" id="submit" class="btn btn-primary" style='width:90%;height:40px;background-color:#ff6600;font-size:20px;'>Submit</button> 
                    </div>
                    <div id='pad'>
                            <h2><?php echo $this->session->flashdata('classerror'); ?></h2>
                            </div>
                </div>
                <div class='col-sm-4'>
                    
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<?php //include('footer.php'); ?>
