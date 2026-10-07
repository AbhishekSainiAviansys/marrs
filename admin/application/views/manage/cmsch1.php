<?php include('header.php'); 

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

?>

<div>
    <ul class="breadcrumb">
       <li><a href="<?php echo SITE_URL ?>school/">School</a> <span class="divider">/</span></li>
       <li>School Level Schedule</li>
    </ul>
</div>

<form method="POST">
    
    <div class="box span12">
        
        <div class="box-header well" data-original-title>
           <h2><i class="icon-user"></i> School Level Schedule</h2>
           
           <div class="box-icon">
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
              <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
           </div>
           
        </div>
        
        
        <div class="box-content">
    
            <h3 style='color:green;'>
                <?php if (!empty($message)) echo $message; ?>
            </h3>
    
            <div class='table-responsive'>
                
                <table cellpadding="5px">
                    
                    
                    <tr>
                        <td>Period: <span style='color:red;'>*</span><br />
                            <select name="period" id="period" style="width: 200px;" required>
                                <option value=''>-- Select Period --</option>
                                <?php
                                $query = $this->db->query("SELECT * FROM period WHERE status='Active';");
                                foreach ($query->result() as $row) {
                                ?>
                                <option value="<?php echo $row->period_id; ?>" <?php if(isset($result['period']) && $result['period'] == $row->period_id){ echo 'selected="selected"'; } ?>>
                                    <?php echo $row->academic_year; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>Country:<span style='color:red;'>*</span><br />
                            <select name="country" id="country" style="width: 200px;" required>
                                <option value=''>-- Select Country --</option>
                                <option value='105'>INDIA</option>
                                <?php
                                $query = $this->db->query("SELECT * FROM countries;");
                                foreach ($query->result() as $row) {
                                ?>
                                <option value="<?php echo $row->country_id; ?>" <?php if(isset($result['country']) && $result['country'] == $row->country_id) echo 'selected="selected"'; ?>>
                                    <?php echo $row->country_name; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>State:<span style='color:red;'>*</span><br />
                            <select name="state_id" id="state_id" style="width: 200px;" required>
                                <option value=''>-- Select State --</option>
                                <?php
                                foreach ($stateload as $row) {
                                ?>
                                <option value="<?php echo $row['state_subdivision_id']; ?>" <?php if(isset($result['state_id']) && $result['state_id'] == $row['state_subdivision_id']) echo 'selected="selected"'; ?>>
                                    <?php echo $row['state_subdivision_name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>Franchise:<span style='color:red;'>*</span><br />
                            <select name="franchise_id" id="franchise_id" style="width: 200px;" required>
                                <option value=''>-- Select Franchise --</option>
                                <?php foreach ($franchise2 as $row) { ?>
                                <option value="<?php echo $row['franchise_id']; ?>" <?php if(isset($result['franchise_id']) && $result['franchise_id'] == $row['franchise_id']) echo 'selected="selected"'; ?>>
                                    <?php echo $row['franchise_code'] . ' ' . $row['franchise_first_name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>Area Code:<span style='color:red;'>*</span><br />
                            <select name="area" id="area" style="width: 200px;" required>
                                <option value=''>-- Select Area --</option>
                                <?php foreach ($areaload as $row) { ?>
                                <option value='<?php echo $row['area_code']; ?>' <?php if(isset($result['area']) && $result['area'] == $row['area_code']) echo 'selected="selected"'; ?>>
                                    <?php echo $row['area_code']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>Product:<span style='color:red;'>*</span><br>
                            <!--<div id='product'></div>-->
                            <?php foreach ($productload as $row) { ?>
                                <input type="checkbox" value='<?php echo $row['product_name']; ?>' name="products[]" >
                                    <?php echo $row['product_name']; ?><br>
                                <?php } ?>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>School:<span style='color:red;'>*</span><br />
                            <div id='school'></div>
                        </td>
    
                        <td>Price Code:<span style='color:red;'>*</span><br>
                            <select name='amount' class='form-control' style='width: 200px;' required>
                                <option value=''>-- select pricecode --</option>
                                <?php foreach ($pricecodes as $code) { ?>
                                <option value='<?php echo $code['amount']; ?>'><?php echo $code['price_code']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
    
                        <td>School Fix Amount:<span style='color:red;'>*</span><br>
                            <input name='school_amount' type='text' class='form-control' style='width: 180px;' required>
                        </td>
    
                        <td>Registration Start Date:<span style='color:red;'>*</span><br />
                            <input type='date' name='start_date' class='form-control' value="<?php if(isset($result['start_date'])){ echo $row['start_date'];} ?>" style='width: 180px;' required>
                        </td>
    
                        <td>Registration End Date:<span style='color:red;'>*</span><br />
                            <input type='date' name='end_date' class='form-control' value="<?php if(isset($result['end_date'])){ echo $row['end_date']; } ?>" style='width: 180px;' required>
                        </td>
                        <td>Competition Date:<span style='color:red;'>*</span><br />
                            <input type='date' name='comp_date' class='form-control' value="<?php if(isset($result['comp_date'])){ echo $row['comp_date']; } ?>" style='width: 180px;' required>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        
                        </td>          
        				
        					    <td>Management Percentage <span style='color:red;'>*</span><br>
                                    <select name="manageper" style="width: 200px;" required>
                                        <option value="">-- select management % --</option>
                                        <?php
                                        $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22];
                                        foreach ($percentages as $percent) {
                                            $selected = (isset($result) && $result['manageper'] == $percent) ? 'selected' : '';
                                            echo "<option value='$percent' $selected>$percent%</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                
                                <td>Aviansys Percentage <span style='color:red;'>*</span><br>
                                    <select name="com_peravian" style="width: 200px;" required>
                                        <option value="">-- select aviansys % --</option>
                                        <?php
                                        $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22, 25, 30];
                                        foreach ($percentages as $percent) {
                                            $selected = (isset($result) && $result['com_peravian'] == $percent) ? 'selected' : '';
                                            echo "<option value='$percent' $selected>$percent%</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                        
                                <td>Associate Percentage<br>
                                    <select name="associate_per" style="width: 200px;">
                                        <option value="">-- select associate % --</option>
                                        <?php
                                        $percentages = range(5, 60, 5); // 5, 10, ..., 60
                                        foreach ($percentages as $percent) {
                                            $selected = (isset($result) && $result['associate_per'] == $percent) ? 'selected' : '';
                                            echo "<option value='$percent' $selected>$percent%</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                
                                <td>Franchise Percentage<br>
                                    <select name="com_per" style="width: 200px;">
                                        <option value="">-- select franchise % --</option>
                                        <?php
                                        foreach ($percentages as $percent) {
                                            $selected = (isset($result) && $result['com_per'] == $percent) ? 'selected' : '';
                                            echo "<option value='$percent' $selected>$percent%</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
        
        				   
        				        <td>
        				                  CRM %<span style='color:red;'>*</span><br>
                                <select name="crm_per" style="width: 220px;" >
                                    <option value="">-- select CRM % --</option>
                                    <?php
                                    $percentages = [0,1,2,3,4,5,6,7,8,9,10];
                                    foreach ($percentages as $percent) {
                                        $selected = (isset($result) && $result['crm_per'] == $percent) ? 'selected' : '';
                                        echo "<option value='$percent' $selected>$percent%</option>";
                                    }
                                    ?>
                                </select>
        				            <!-- CRM Fix <span style='color:red;'>*</span><br>-->
            				        <!--<input type='text' name='crm_fix' style="width: 180px;" value="<?php if($result['crm_fix']){ echo $result['crm_fix']; } ?>" required>-->
            				    </td>
                                
                                <td>Free Material Roiyalty <span style='color:red;'>*</span><br>
            				        <input type='text' name='free_mat_royalty' style="width: 180px;" value="<?php if($result['free_mat_royalty']){ echo $result['free_mat_royalty']; } ?>" required>
            				    </td>
                            
                            </tr>
                            
                        <tr>        
                                <td>Generate Associate Link<span style='color:red;'>*</span><br>
            				        <input type='checkbox' name='associate_link' style="width: 180px;" value="<?php if($result['associate_link']){ echo $result['associate_link']; } ?>" >
            				    </td>
                                <td>
                                    <br /><input type="submit" class='btn btn-primary' name="submit" value="Launch" />
                                </td>
                        </tr>
                        
                        
                </table>
            </div>
        </div>
        
    </div>
</form>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $("#area").change(function () {
        var area_code = this.value;
        var period = $("#period").val();
        var franchise_id = $("#franchise_id").val();

        $.post("<?php echo base_url(); ?>manage/ajax/getProductCompetition", {
            area_code: area_code,
            period: period,
            franchise_id: franchise_id
        }, function (result) {
            $("#product").html(result);
        });

        $.post("<?php echo base_url(); ?>manage/ajax/school_list_checkboxnew", {
            area_code: area_code
        }, function (result) {
            $("#school").html(result);
        });
    });
    
    

    $("#country").change(function () {
        var country_id = this.value;
        $.post("<?php echo base_url(); ?>manage/ajax/getstateAjax", {
            country_id: country_id
        }, function (result) {
            $("#state_id").html(result);
        });
    });

    $("#state_id").change(function () {
        var state_id = this.value;
        $.post("<?php echo base_url(); ?>manage/ajax/franchiseList__", {
            state_id: state_id
        }, function (result) {
            $("#franchise_id").html(result);
        });

        $.post("<?php echo base_url(); ?>manage/ajax/statewisearea_newallarea", {
            state_id: state_id
        }, function (result) {
            $("#area").html(result);
        });
    });
});
</script>
