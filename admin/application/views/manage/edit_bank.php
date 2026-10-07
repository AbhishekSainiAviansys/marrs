<?php include('header.php'); ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Update Bank Details</small></h1>
        </div>
        
        <?php if (isset($message) && !empty($message)) { ?>
            <h3><?php echo $message; ?></h3>
        <?php } ?>
        
        <div class="box-content">
            <form method="POST">
                <!-- Bank Details Section -->
                <fieldset style='display:flex; flex-wrap:wrap;'>
                    <legend>Bank Details</legend>

                    <div class="form-group">
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" name="bank_name" class="form-control" 
                               placeholder="Enter Bank Name" 
                               value="<?php echo isset($bank_details->bank_name) ? $bank_details->bank_name : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="account_number">Account Number:</label>
                        <input type="text" name="account_number" class="form-control" 
                               placeholder="Enter Account Number" 
                               value="<?php echo isset($bank_details->account_number) ? $bank_details->account_number : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="ifsc_code">IFSC Code:</label>
                        <input type="text" name="ifsc_code" class="form-control" 
                               placeholder="Enter IFSC Code" 
                               value="<?php echo isset($bank_details->ifsc_code) ? $bank_details->ifsc_code : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="branch_name">Branch Name:</label>
                        <input type="text" name="branch_name" class="form-control" 
                               placeholder="Enter Branch Name" 
                               value="<?php echo isset($bank_details->branch_name) ? $bank_details->branch_name : ''; ?>">
                    </div>
                </fieldset>

                <!-- Submit Buttons -->
                <button type="submit" name="submit" class="btn btn-info">Update Bank Details</button>
                <!--<button type="button" class="btn btn-success" onclick="window.location.href='your_list_url.php';">Back To List</button>-->
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>
