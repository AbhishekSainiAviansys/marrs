<?php 
include('header.php');
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Add Associate and Bank Details</small></h1>
        </div>
        <?php if(isset($message)&&!empty($message)){
          ?><h3><?php  echo $message;?></h1><?php
        } 
        ?>
        <div class="box-content">
            <form class="" method="POST">
                <fieldset style='display:flex;'>
                    <!-- Associate Details Section -->
                    <legend>Associate Details</legend>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    </fieldset>
                    <fieldset style='display:flex;'>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select name="country" class="form-control">
                            <option value='105'>India</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <select name="state" id="state" style="width: 220px;" required>
                            <?php foreach($stateload as $periodval) : ?>
                                <option value="<?php echo $periodval['state_subdivision_id'] ?>" <?php if(isset($result['state']) && $result['state'] == $periodval['state_subdivision_id']) { echo "selected"; } ?>><?php echo $periodval['state_subdivision_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" name="city" class="form-control" placeholder="Enter City">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code:</label>
                        <input type="text" name="postal_code" class="form-control" placeholder="Enter Postal Code">
                    </div>
                    
                </fieldset>
                <fieldset style='display:flex;'>
                    <!-- Bank Details Section -->
                    <legend>Bank Details</legend>
                    <div class="form-group">
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" required>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number:</label>
                        <input type="text" name="account_number" class="form-control" placeholder="Enter Account Number" required>
                    </div>
                    <div class="form-group">
                        <label for="ifsc_code">IFSC Code:</label>
                        <input type="text" name="ifsc_code" class="form-control" placeholder="Enter IFSC Code" required>
                    </div>
                    <div class="form-group">
                        <label for="branch_name">Branch Name:</label>
                        <input type="text" name="branch_name" class="form-control" placeholder="Enter Branch Name">
                    </div>
                </fieldset>

                <!-- Submit Buttons -->
                <button type="submit" name="submit" class="btn btn-info">Submit</button>
                <!--<button type="button" class="btn btn-success" onclick="window.location.href='your_list_url.php';">Back To List</button>-->
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>
