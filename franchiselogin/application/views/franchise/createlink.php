<?php 
include('header.php');
// print_r($associate);
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Create Regsitration Link Associate</small></h1>
        </div>
        <?php if (isset($message) && !empty($message)) { ?>
            <h3><?php echo $message; ?></h3>
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
                        <label for="date_of_birth">Date of Link Expire:</label>
                        <input type="date" name="expire_date" class="form-control" required >
                    </div>
                    
                    <div class="form-group">
                        <label for="franchise">Franchise:</label>
                        <select name="franchise" class="form-control" required>
                            <option vlaue=''>-- Select Franchise --</option>
                        <?php foreach($franchise as $fran){ ?>
                            <option value='<?php echo $fran->franchise_id; ?>' ><?php echo $fran->franchise_first_name.' - '.$fran->franchise_last_name; ?></option>
                        <?php } ?>    
                        </select>
                               
                    </div>
                    
                </fieldset>
                
                

                <fieldset style='display:flex; flex-wrap:wrap;'>
                    
                    <div class="form-group">
                        <label>Lunar Registrations:</label>
                    
                        <?php
                        $schedules = $this->db->get_where('lunar_schedule_cin', ['period_id' => '15'])->result();
                    
                        foreach($schedules as $sch){
                        ?>
                    
                        <div style="margin-bottom:10px;">
                    
                            <input type="checkbox"
                                   value="<?php echo $sch->lunar_schedule_id; ?>"
                                   name="ids[]"
                                   class="schedule-check"
                                   data-id="<?php echo $sch->lunar_schedule_id; ?>">
                    
                            <?php echo $sch->subject.' - '.$sch->type.' - '.$sch->series; ?>
                    
                            <!-- Amount Input -->
                            <input type="number"
                                   step="0.01"
                                   name="amount[<?php echo $sch->lunar_schedule_id; ?>]"
                                   class="amount-input"
                                   data-id="<?php echo $sch->lunar_schedule_id; ?>"
                                   placeholder="Amount"
                                   style="margin-left:10px; width:120px;"
                                   disabled>
                    
                        </div>
                    
                        <?php } ?>
                    </div>


                    
                    
                </fieldset>

                <!-- Submit Buttons -->
                <button type="submit" name="submit" class="btn btn-info">Create</button>
                <!--<button type="button" class="btn btn-success" onclick="window.location.href='your_list_url.php';">Back To List</button>-->
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function(){
    
    $(document).on("change", ".schedule-check", function(){
    
        let id = $(this).data("id");
    
        let amountInput = $('input[name="amount['+id+']"]');
    
        if($(this).is(":checked")){
            amountInput.prop("disabled", false);
        } else {
            amountInput.prop("disabled", true).val('');
        }
    
    });


    $("#lunar_schedule_cin").change(function(){
        var lunar_schedule_id =this.value;
        // alert(lunar_schedule_id);
        var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/lunar_schedules",
        data:{lunar_schedule_id:lunar_schedule_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#schedules").html(result);
        	 
        
        }});
    });
   
});
</script>


<?php include('footer.php'); ?>