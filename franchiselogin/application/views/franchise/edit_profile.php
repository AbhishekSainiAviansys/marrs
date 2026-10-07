<?php 
include('header.php');
// print_r($associate);
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Update Associate Details</small></h1>
        </div>
        <?php if (isset($message) && !empty($message)) { ?>
            <h3><?php echo $message; ?></h3>
        <?php } ?>
        
        <div class="box-content">
            <form method="POST">
                <fieldset style='display:flex; flex-wrap:wrap;'>
                    <!-- Associate Details Section -->
                    <legend>Associate Details</legend>
                    
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" class="form-control" 
                               placeholder="Enter First Name" 
                               value="<?php echo isset($associate->first_name) ? $associate->first_name : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" 
                               placeholder="Enter Last Name" 
                               value="<?php echo isset($associate->last_name) ? $associate->last_name : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" 
                               placeholder="Enter Email" 
                               value="<?php echo isset($associate->email) ? $associate->email : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control" 
                               placeholder="Enter Phone Number" 
                               value="<?php echo isset($associate->phone) ? $associate->phone : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" name="date_of_birth" class="form-control" 
                               value="<?php echo isset($associate->date_of_birth) ? $associate->date_of_birth : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male" <?php echo (isset($associate->gender) && $associate->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo (isset($associate->gender) && $associate->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset style='display:flex; flex-wrap:wrap;'>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <select name="country" class="form-control">
                            <option value="105" <?php echo (isset($associate->country) && $associate->country == '105') ? 'selected' : ''; ?>>India</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="state">State:</label>
                        <select name="state" id="state" class="form-control" style="width: 220px;" required>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?php echo $state['state_subdivision_id']; ?>" 
                                    <?php echo (isset($associate->state) && $associate->state == $state['state_subdivision_id']) ? 'selected' : ''; ?>>
                                    <?php echo $state['state_subdivision_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" name="city" class="form-control" 
                               placeholder="Enter City" 
                               value="<?php echo isset($associate->city) ? $associate->city : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" class="form-control" placeholder="Enter Address"><?php echo isset($associate->address) ? $associate->address : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code:</label>
                        <input type="text" name="postal_code" class="form-control" 
                               placeholder="Enter Postal Code" 
                               value="<?php echo isset($associate->postal_code) ? $associate->postal_code : ''; ?>">
                    </div>
                </fieldset>

                <!-- Submit Buttons -->
                <button type="submit" name="submit" class="btn btn-info">Update</button>
                <!--<button type="button" class="btn btn-success" onclick="window.location.href='your_list_url.php';">Back To List</button>-->
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>
