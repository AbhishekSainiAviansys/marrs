<?php 
include('header.php');
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Edit Registration Link Associate</small></h1>
        </div>
        <?php if (isset($message) && !empty($message)) { ?>
            <div class="alert alert-<?php echo isset($status) ? $status : 'info'; ?>">
                <h3><?php echo $message; ?></h3>
            </div>
        <?php } ?>
        
        <div class="box-content">
            <h2>Associate Details</h2>
            <form method="POST">
                <fieldset style='display:flex; flex-wrap:wrap;'>
                    
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" name="first_name" class="form-control" 
                               placeholder="Enter First Name" 
                               value="<?php echo isset($associate->first_name) ? $associate->first_name : ''; ?>" 
                               required disabled>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" 
                               placeholder="Enter Last Name" 
                               value="<?php echo isset($associate->last_name) ? $associate->last_name : ''; ?>" 
                               required disabled>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" 
                               placeholder="Enter Email" 
                               value="<?php echo isset($associate->email) ? $associate->email : ''; ?>" 
                               required disabled>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control" 
                               placeholder="Enter Phone Number" 
                               value="<?php echo isset($associate->phone) ? $associate->phone : ''; ?>" 
                               required disabled>
                    </div>

                    <div class="form-group">
                        <label for="expire_date">Date of Link Expire:</label>
                        <input type="date" name="expire_date" class="form-control" 
                               value="<?php echo isset($associate_link_data->expire_date) ? date('Y-m-d', strtotime($associate_link_data->expire_date)) : date('Y-m-d'); ?>" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="expire_date">Status:</label>
                        <select name="status" class="form-control" >
                            <option value='Active' <?php if($associate_link_data->status == 'Active'){?> selected <?php } ?>>Active</option>
                            <option value='Inactive' <?php if($associate_link_data->status == 'Inactive'){?> selected <?php } ?>>Inactive</option>
                        </select>
                               
                    </div>
                    
                    <div class="form-group">
                        <label for="franchise">Franchise:</label>
                        <select name="franchise" class="form-control" required>
                            <option vlaue=''>-- Select Franchise --</option>
                        <?php foreach($franchise as $fran){ ?>
                            <option value='<?php echo $fran->franchise_id; ?>' <?php if($associate_link_data->franchise_id == $fran->franchise_id){?> selected <?php } ?>><?php echo $fran->franchise_first_name.' - '.$fran->franchise_last_name; ?></option>
                        <?php } ?>    
                        </select>
                               
                    </div>
                    
                </fieldset>
                
                

                <fieldset style='display:flex; flex-wrap:wrap;'>
                    
                    <div class="form-group">
                        <label for="lunar_registrations">Lunar Registrations:</label>
                        
                        <?php
                        // Get all available schedules
                        $schedules = $this->db->get_where('lunar_schedule_cin', ['period_id' => '15'])->result();
                        
                        // Get already selected schedules for this link
                        $selected_schedules = [];
                        if (isset($associate_link_data->associate_link_id)) {
                            $selected = $this->db->get_where('associatelink_to_lunar', ['associate_link_id' => $associate_link_data->associate_link_id])->result();
                            foreach($selected as $sel) {
                                $selected_schedules[] = $sel->lunar_schedule_id;
                            }
                        }
                        
                        // foreach($schedules as $sch){
                        //     $checked = in_array($sch->lunar_schedule_id, $selected_schedules) ? 'checked' : '';
                        ?>
                        <!--<div class="checkbox" style="margin-bottom: 10px;">-->
                        <!--    <label>-->
                        <!--        <input type='checkbox' value="<?php //echo $sch->lunar_schedule_id; ?>" name='ids[]' <?php //echo $checked; ?>>-->
                             <?php // echo $sch->subject.' - '.$sch->type.' - '.$sch->series; ?>
                        <!--    </label>-->
                        <!--</div>-->
                        <?php
                         // }
                        ?>
                       
                            <?php foreach($schedules as $sch){ 
                                $checked = in_array($sch->lunar_schedule_id, $selected_schedules) ? 'checked' : '';
                            
                                // If editing existing, fetch saved amount
                                $saved_amount = $schedule_amounts[$sch->lunar_schedule_id] ?? '';
                            ?>
                            
                            <div class="checkbox" style="margin-bottom: 10px;">
                                
                                <label>
                                    <input type="checkbox"
                                           value="<?php echo $sch->lunar_schedule_id; ?>"
                                           name="ids[]"
                                           <?php echo $checked; ?>>
                            
                                    <?php echo $sch->subject.' - '.$sch->type.' - '.$sch->series; ?>
                                </label>
                            
                                <!-- Amount Input -->
                                <input type="number"
                                       step="0.01"
                                       name="amount[<?php echo $sch->lunar_schedule_id; ?>]"
                                       value="<?php echo $saved_amount; ?>"
                                       placeholder="Enter Amount"
                                       style="margin-left:10px; width:120px;">
                                       
                            </div>
                            
                            <?php } ?>

                       
                       
                       
                    </div>

                </fieldset>

                <!-- Submit Buttons -->
                <button type="submit" name="submit" class="btn btn-info">Update Link</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo base_url(); ?>manage/lunar/competitionlist_associate';">Back To List</button>
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 $(document).ready(function(){
    $('input[name="ids[]"]').change(function() {
        let id = $(this).val();
    
        $('input[name="amount['+id+']"]').prop('disabled', !this.checked);
    });

    // Validate form before submission
    $("form").submit(function(e) {
        // Check if at least one schedule is selected
        if($('input[name="ids[]"]:checked').length === 0) {
            alert('Please select at least one lunar registration');
            e.preventDefault();
            return false;
        }
        
        // Check if expire date is in the future
        var expireDate = new Date($('input[name="expire_date"]').val());
        var today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if(expireDate < today) {
            alert('Expire date must be today or in the future');
            e.preventDefault();
            return false;
        }
        
        return true;
    });
});
</script>

<?php include('footer.php'); ?>