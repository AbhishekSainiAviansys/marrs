<?php include "header_profile.php"?>
  
    <section style="background-color:#ffff;">
        <div class="container">
            <div class="row" id="namecard">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="card my-2 p-2" style="background-color:#40bbe7;border: none;">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic"/>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                        <h2 class="text-white">Student Profile Update </h2>
                                        <!--<h2 class="text-white"><?php echo $id;?></h2>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     
                <div class="col-sm-12 col-md-12 col-lg-9">
                    <div class="card my-2 mb-5 p-2">
                        <div class="card-body">
                            <form class="row was-validated"  method='POST'>
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-2 mb-lg-0">
                                    <div style='display:flex;justify-content: space-between;'>
                                        
                                        <h2 class="text-start" style='color:green;'>ZoomZoom PRID: <?php echo $prid;?></h2>
                                        <h2 class="text-start text-danger">Update Your Profile </h2>
                                    </div>
                                </div>
                                <!--<div class="col-lg-4 mb-2 mb-lg-0">-->
                                <!--    <label for="inputFirstName" class="form-label">First Name *</label>-->
                                <!--    <input type="text" class="form-control" id="inputFirstName" name="first_name" required>-->
                                <!--    <div class="invalid-feedback">-->
                                <!--        Please enter first name.-->
                                <!--      </div>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4 mb-2 mb-lg-0">-->
                                <!--    <label for="inputMiddleName" class="form-label">Middle Name</label>-->
                                <!--    <input type="text" class="form-control" id="inputMiddleName" name="middle_name" >-->
                                <!--</div>-->
                                <!--<div class="col-lg-4 mb-2 mb-lg-0">-->
                                <!--    <label for="inputLastName" class="form-label">Last Name *</label>-->
                                <!--    <input type="text" class="form-control" id="inputLastName"  name="last_name" required>-->
                                <!--    <div class="invalid-feedback">-->
                                <!--        Please enter last name.-->
                                <!--      </div>-->
                                <!--</div>     -->
                                <!--<div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">-->
                                <!--    <h2 class="text-start">Personal Details</h2>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4 mb-2 mb-lg-0">-->
                                <!--    <label for="inputState" class="form-label">Student Class *</label>-->
                               
                                <!--<select class="form-select" name="class"  required>-->
                                <!--      <option selected disabled value="">Select Class</option>-->
                                       <?php
                                 
                                //  $query = $this->db->query("SELECT * FROM class;");
                                
                                //  foreach ($query->result() as $row)
                                // {
                                // echo "<option value='{$row->class_id}'>{$row->class_name}</option>";
                                // }
                                
                                ?>
                                <!--</select>-->
                                <!--<div class="invalid-feedback">-->
                                <!--        Please choose class.-->
                                <!--</div>-->
                                <!--</div>-->
                               <!-- <div class="col-lg-4 mb-2 mb-lg-0">-->
                               <!--     <label for="inputGender" class="form-label">Gender </label>-->
                                    
                               <!--     <select name="gender" id="inputGender" class="form-select" >-->
                               <!--     <option value="none" selected>Select Gender</option>-->
                               <!--     <option value="Male">Male</option>-->
                               <!--     <option value="Female">Female</option>-->
                               <!--     <option value="Other">Other</option>-->
                               <!--     </select>-->
                               <!-- </div>-->
                               <!-- <div class="col-lg-4 mb-2 mb-lg-0">-->
                               <!--     <label for="inputFatherName" class="form-label">DOB</label>-->
                               <!--     <input type="text" class="form-control" id="inputFatherName" name="dob" >-->
                               <!-- </div>-->
                               <!-- <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">-->
                               <!--     <h2 class="text-start">Guardian Details</h2>-->
                               <!-- </div>-->
                               <!-- <div class="col-lg-4 mb-2 mb-lg-0">-->
                               <!--     <label for="inputFatherName" class="form-label">Father's Name </label>-->
                               <!--     <input type="tel" class="form-control" id="inputFatherName" name="father_name" >-->
                               <!-- </div>-->
                               <!-- <div class="col-lg-4 mb-2 mb-lg-0">-->
                               <!--     <label for="inputMotherName" class="form-label">Mother's Name </label>-->
                               <!--     <input type="text" class="form-control" id="inputMotherName" name="mother_name" >-->
                               <!-- </div>-->
                               <!-- <div class="col-lg-4 mb-2 mb-lg-0">-->
                               <!--</div>  -->
                               
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Contact Details</h2>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputMobileNo" class="form-label">Mobile Number </label>
                                    <input type="tel" pattern="[789][0-9]{9}" class="form-control" id="inputMobileNo" value="<?php echo $student[0]['mobile'];?>" name="mobile" placeholder='Mobile Number' >
                                    
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Whatsapp Number </label>
                                    <input type="text" pattern="[789][0-9]{9}" class="form-control" value="<?php echo $student[0]['whatsapp'];?>" id="inputWhatsappNo" name="whatsapp" placeholder='Whatapp Number' >
                                   
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputEmail" class="form-label">Email ID </label>
                                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $student[0]['email'];?>" name="email" placeholder='Email' >
                                    
                                </div>  
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Address Details</h2>
                                </div>
                                <div class="col-lg-12 mb-2 ">
                                    <label for="inputMobileNo" class="form-label">Address </label>
                                    <input type="tel" class="form-control" id="inputMobileNo" name='address_line' value="<?php echo $student[0]['address_line'];?>" placeholder='Address' >
                                </div>
                                
                                
                                <div class="col-lg-12 mb-2 ">
                                    <label for="inputMobileNo" class="form-label">School Name </label>
                                    <input type="tel" class="form-control" id="inputMobileNo" name='school_name' value="<?php echo $student[0]['school_name'];?>" placeholder='School Name' required>
                                </div>
                                
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Pincode </label>
                                    <input type="text" class="form-control" id="inputWhatsappNo" name='pin' value="<?php echo $student[0]['pin'];?>" placeholder='Pincode' > 
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputEmail" class="form-label">City </label>
                                    <input type="text" class="form-control" id="inputEmail" name='city' value="<?php echo $student[0]['city'];?>" placeholder='city' >
                                </div>  
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                        <label for="inputState" class="form-label">State </label>
                                        <select id="inputState" class="form-select" name='state' >
                                       <option  <?php if(!empty($student[0]['state'])) echo"selected"; ?>><?php echo $student[0]['state'];?></option>
                                        <option value="Andhra Pradesh">
                                          Andhra Pradesh
                                        </option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">
                                          Himachal Pradesh
                                        </option>
                                        <option value="Jammu and Kashmir">
                                          Jammu and Kashmir
                                        </option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">
                                          Madhya Pradesh
                                        </option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </div>  
                                <div class="col-sm-12 col-md-12 col-lg-4 mb-5 my-3 mb-lg-0" style='display:flex;'>
                                    
                                   
                                    <button type="submit" class="btn btn-danger btn-lg w-50" name='submit'>Submit</button>
                                   <button name='back' class='btn btn-warning'>← To Profile</button>
                                    
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                  
    <?php include "footer.php"?>