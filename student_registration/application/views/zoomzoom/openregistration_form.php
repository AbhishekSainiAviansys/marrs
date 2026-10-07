<?php include "header.php";
//print_r($result[0]);

?>
  
    <section style="background-color:#ffff;">
        <div class="container">
            <div class="row" id="namecard">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <a href="https://marrs.in/" class="btn btn-outline-secondary btn-sm text-start my-2"><i class="fa-solid fa-circle-chevron-left me-2" style="font-size: 16px;"></i>BACK</a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="card my-2 p-2" style="background-color:#40bbe7;border: none;">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="img-fluid" alt="Profile Pic"/>
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                        <h2 class="text-white">Student Registration<br>for<br> </h2>
                                        <h2 class="text-white"><?php echo $result[0]['school_name'];?></h2>
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
                                        <h2 class="text-start">Student Details</h2>
                                        <h2 class="text-start" style='color:green;'>School Access Code: <?php echo $school_code;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputFirstName" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="inputFirstName" name="first_name" required>
                                    <div class="invalid-feedback">
                                        Please enter first name.
                                      </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputMiddleName" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="inputMiddleName" name="middle_name" >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputLastName" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="inputLastName"  name="last_name" required>
                                    <div class="invalid-feedback">
                                        Please enter last name.
                                      </div>
                                </div>
                                
                                <!--   ===========================================================   -->
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Personal Details</h2>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputState" class="form-label">Student Class *</label>
                               
                                <select class="form-select" name="class"  required>
                                      <option selected disabled value="">Select Class</option>
                                       <?php
                                 
                                 $query = $this->db->query("SELECT * FROM class;");
                                
                                 foreach ($query->result() as $row)
                                {
                                echo "<option value='{$row->class_id}'>{$row->class_name}</option>";
                                }
                                
                                ?>
                                </select>
                                <div class="invalid-feedback">
                                        Please choose class.
                                </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputGender" class="form-label">Gender </label>
                                    
                                    <select name="gender" id="inputGender" class="form-select" >
                                    <option value="none" selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputFatherName" class="form-label">DOB</label>
                                    <input type="text" class="form-control" id="inputFatherName" name="dob" >
                                </div>
                                
                                <!--   ======================================    -->
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">School Details</h2>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputFirstName" class="form-label">School Name *</label>
                                    <input type="text" class="form-control" id="inputFirstName" name="school_name" required>
                                    <div class="invalid-feedback">
                                        Please enter School name.
                                      </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="school_address" class="form-label">School Address</label>
                                    <input type="text" class="form-control" id="school_address" name="school_address" >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value='<?php echo $result[0]['state_subdivision_name']; ?>' disabled>
                                </div>
                                
                                <!--   ===========================================    -->
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Guardian Details</h2>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputFatherName" class="form-label">Father's Name </label>
                                    <input type="tel" class="form-control" id="inputFatherName" name="father_name" >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputMotherName" class="form-label">Mother's Name </label>
                                    <input type="text" class="form-control" id="inputMotherName" name="mother_name" >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                               </div>  
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Contact Details</h2>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputMobileNo" class="form-label">Mobile Number *</label>
                                    <input type="tel" pattern="[789][0-9]{9}" class="form-control" id="inputMobileNo" name="mobile" required>
                                    <div class="invalid-feedback">
                                        Please enter mobile number.
                                      </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Whatsapp Number *</label>
                                    <input type="text" pattern="[789][0-9]{9}" class="form-control" id="inputWhatsappNo" name="whatsapp" required>
                                    <div class="invalid-feedback">
                                        Please enter whatsapp number.
                                      </div>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputEmail" class="form-label">Email ID *</label>
                                    <input type="email" class="form-control" id="inputEmail" name="email" required>
                                    <div class="invalid-feedback">
                                        Please enter email.
                                      </div>
                                </div>  
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-3 my-3 mb-lg-0">
                                    <h2 class="text-start">Address Details</h2>
                                </div>
                                <div class="col-lg-12 mb-2 ">
                                    <label for="inputMobileNo" class="form-label">Address </label>
                                    <input type="tel" class="form-control" id="inputMobileNo" name='address_line' >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Pincode </label>
                                    <input type="text" class="form-control" id="inputWhatsappNo" name='pin' >
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputEmail" class="form-label">City </label>
                                    <input type="text" class="form-control" id="inputEmail" name='city' >
                                </div>  
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                        <label for="inputState" class="form-label">District </label>
                                        <select name='area' class="form-select" required>
                                           
                                            <?php foreach($result as $row){ 
                                                
                                                echo "<option value='{$row['area_code']}'>{$row['district_name']}</option>";
                                
                                            } ?>
                                        </select> 
                                </div>  
                                <div class="col-sm-12 col-md-12 col-lg-4 mb-5 my-3 mb-lg-0">
                                    <?php if(!empty($this->session->flashdata('message'))){echo $this->session->flashdata('message');} ?>
                                    <button type="submit" class="btn btn-danger btn-lg w-100" name='submit'>Submit</button>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                  
    <?php include "footer.php"?>