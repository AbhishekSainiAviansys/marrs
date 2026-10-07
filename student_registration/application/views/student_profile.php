<?php include "student_header.php"?>
  <style>
body {
  background: #f7f9fc;
}

/* Section spacing */
section {
  padding: 20px 10px;
}

/* Card */
.card {
  border-radius: 12px;
  border: none;
  box-shadow: 0 3px 12px rgba(0,0,0,0.06);
}

/* Title */
h4 {
  font-size: 20px;
  font-weight: 600;
}

/* Labels */
.form-label {
  font-size: 13px;
  font-weight: 500;
  margin-bottom: 4px;
}

/* Inputs */
.form-control,
.form-select {
  font-size: 14px;
  padding: 8px 10px;
  border-radius: 6px;
}

/* Fix spacing between fields */
.row > div {
  margin-bottom: 12px;
}

/* Buttons container */
.form-buttons {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

/* Buttons */
.btn {
  border-radius: 6px;
  font-size: 14px;
  padding: 8px 16px;
}

/* Mobile fixes */
@media (max-width: 768px) {
  .form-buttons {
    flex-direction: column;
  }

  .btn {
    width: 100%;
  }

  h4 {
    font-size: 18px;
  }
}
</style>
    <section style="background-color:#ffff;">
        <div class="container">
            <div class="row" id="namecard">
               
     
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card my-2 mb-5 p-2">
                        <div class="card-body">
                            <form class="row was-validated"  method='POST'>
                                <div class="col-sm-12 col-md-12 col-lg-12 mb-2 mb-lg-0">
                                    <div style='justify-content: space-between;'>
                                        
                                      
                                        <h4 class="text-center text-danger">Update Your Profile </h4>
                                    </div>
                                </div>
                               
                                
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputMobileNo" class="form-label">Mobile Number </label>
                                    <input type="tel" pattern="[789][0-9]{9}" class="form-control" id="inputMobileNo" value="<?php echo $studentdata['mobile'];?>" name="mobile" placeholder='Mobile Number' >
                                    
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Whatsapp Number </label>
                                    <input type="text" pattern="[789][0-9]{9}" class="form-control" value="<?php echo $studentdata['whatsapp'];?>" id="inputWhatsappNo" name="whatsapp" placeholder='Whatapp Number' >
                                   
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputEmail" class="form-label">Email ID </label>
                                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $studentdata['email'];?>" name="email" placeholder='Email' >
                                    
                                </div>  
                               
                                <div class="col-lg-12 mb-2 ">
                                    <label for="inputMobileNo" class="form-label">Address </label>
                                    <input type="tel" class="form-control" id="inputMobileNo" name='address_line' value="<?php echo $studentdata['address1'];?>" placeholder='Address' >
                                </div>
                                
                                
                                <div class="col-lg-12 mb-2 ">
                                    <label for="inputMobileNo" class="form-label">School Name </label>
                                    <input type="tel" class="form-control" id="inputMobileNo" name='school_name' value="<?php echo $this->db->get_where('school_new', array('school_code'=>$studentdata['school_code']))->row()->school_name;?>" placeholder='School Name' disabled>
                                </div>
                                
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                        <label for="inputState" class="form-label">Class </label>
                                        <select id="inputState" class="form-select" name='class' >
                                            <?php foreach($class as $val){ ?>
                                       <option value="<?php echo $val['class_name'];?>" <?php if($val['class_name']==$studentdata['class']) { echo 'selected="selected"';}?>><?php echo $val['class_name'];?></option>
                                       <?php }?>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                    <label for="inputWhatsappNo" class="form-label">Pincode </label>
                                    <input type="text" class="form-control" id="inputWhatsappNo" name='pin' value="<?php echo $studentdata['pin'];?>" placeholder='Pincode' > 
                                </div>
                                 
                                <div class="col-lg-4 mb-2 mb-lg-0">
                                        <label for="inputState" class="form-label">State </label>
                                        <select id="inputState" class="form-select" name='state' >
                                            <?php foreach($state as $val){ ?>
                                       <option value="<?php echo $val['state_subdivision_id'];?>"><?php echo $val['state_subdivision_name'];?></option>
                                       <?php }?>
                                    </select>
                                </div>  
                                <div class="col-12 form-buttons mt-3">                                    
                                   
                                    <button type="submit" class="btn btn-danger" name='submit'>Submit</button>
                                   <button name='back' class='btn btn-warning'>← To Profile</button>
                                    
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                  
    <?php include "student_footer.php"?>