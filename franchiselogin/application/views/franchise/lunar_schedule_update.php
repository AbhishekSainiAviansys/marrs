<?php include('header.php'); ?>

<div>
    <ul class="breadcrumb">
        <li><a href="<?php echo SITE_URL ?>school/">Schedule</a> <span class="divider">/</span></li>
        <li>Update Lunar Schedule</li>
    </ul>
</div>

<h3 style='color:green;'><?php echo !empty($message) ? $message : ''; ?></h3>
<div class="row" style="display:flex">
    <div class="col-lg-6">
        <form method="POST">

            <table cellpadding="5px">
                <tr>
                    <td>State:<br>
                        <select name="state_id" required style="width:200px;">
                            <option value="">-- Select State --</option>
                            <?php foreach ($stateload as $row): ?>
                                <option value="<?= $row['state_subdivision_id'] ?>"
                                    <?= ($result['state_id'] == $row['state_subdivision_id']) ? 'selected' : '' ?>>
                                    <?= $row['state_subdivision_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
            
                    <td>Franchise:<br>
                        <select name="franchise_id" required style="width:200px;">
                            <option value="">-- Select Franchise --</option>
                            <?php foreach ($franchiseload as $row): ?>
                                <option value="<?= $row['franchise_id'] ?>"
                                    <?= ($result['franchise_id'] == $row['franchise_id']) ? 'selected' : '' ?>>
                                    <?= $row['franchise_first_name'].' '.$row['franchise_last_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
            
                    <td>Area:<br>
                        <select name="area" style="width:200px;">
                            <option value="">-- Select Area --</option>
                            <?php foreach ($areaload as $row): ?>
                                <option value="<?= $row['area_code'] ?>"
                                    <?= ($result['area'] == $row['area_code']) ? 'selected' : '' ?>>
                                    <?= $row['area_code'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            
                <tr>
                    <td>Period:<br>
                        <select name="period_id" required style="width:200px;">
                            <?php foreach ($periodload as $p): ?>
                                <option value="<?= $p->period_id ?>"
                                    <?= ($result['period_id'] == $p->period_id) ? 'selected' : '' ?>>
                                    <?= $p->academic_year ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
            
                    <td>Subject:<br>
                        <input type="text" name="subject" value="<?= $result['subject'] ?>" required style="width:200px;">
                    </td>
            
                    <td>Series:<br>
                        <input type="text" name="series" value="<?= $result['series'] ?>" required style="width:200px;">
                    </td>
                </tr>
            
                <tr>
                    <td>Associate:<br>
                        <select name="associate_id" required style="width:200px;">
                            <?php foreach ($associates as $a): ?>
                                <option value="<?= $a['associate_id'] ?>"
                                    <?= ($result['associate_id'] == $a['associate_id']) ? 'selected' : '' ?>>
                                    <?= $a['first_name'] . ' ' . $a['last_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
            
                    <td>Associate %:<br>
                        <input type="text" name="franchise_cut" value="<?= $result['associate_cut'] ?>" required>
                    </td>
            
                    <td>School Fix:<br>
                        <input type="text" name="school_amount" value="<?= $result['school_amount'] ?>">
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <!--<input type="text" name="crm_fix" value="<?= $result['crm_fix'] ?>" required>-->
                        
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
                        
                    </td>
                    <td>Start Date:<br>
                        <input type="date" name="start_date" value="<?= $result['start_date'] ?>" required>
                    </td>
                    <td>End Date:<br>
                        <input type="date" name="end_date" value="<?= $result['end_date'] ?>" required>
                    </td>
                </tr>
            
                <tr>
                    <td>Amount:<br>
                        <input type="text" name="amount" value="<?= $result['amount'] ?>" required>
                    </td>
            
                    <td>Management %:<br>
                        <input type="text" name="management_percentage" value="<?= $result['management_percentage'] ?>" required>
                    </td>
            
                    <td>Aviansys %:<br>
                        <input type="text" name="aviansys_percentage" value="<?= $result['aviansys_percentage'] ?>" required>
                    </td>
                </tr>
            
                <tr>
                    <td>Franchise %:<br>
                        <input type="text" name="franchise_percentage" value="<?= $result['franchise_percentage'] ?>">
                    </td>
            
                    <td>Variant:<br>
                        <input type="text" name="varient" value="<?= $result['type'] ?>">
                    </td>
                    <td>Competition Level:<br>
                        <select name="level_id" required style="width:200px;">
                            <?php foreach ($levelload as $a): ?>
                                <option value="<?= $a['level_id'] ?>"
                                    <?= ($result['level_id'] == $a['level_id']) ? 'selected' : '' ?>>
                                    <?= $a['level_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    
                </tr>
            
                <tr>
                    <td>Season<br>
                        <input type="text" name="season" value="<?= $result['season'] ?>">
                    </td>
                    <td>
                           Title:<br />
            		     <input type='text' name='title' class='form-control' value="<?= $result['title'] ?>" style="width: 190px;"  >
                    </td>
                    <td>
                           Description:<br />
            		    <textarea name='description' class='form-control' style="width: 190px;" value="<?= $result['description'] ?>"  ></textarea>
            
                    </td>
                </tr>
            
                <tr>
                    <td colspan="3" align="center">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </td>
                </tr>
                
            </table>
            
            </form>
        
    </div>
    <div class="col-lg-6">
        <form method="POST">

<table cellpadding="5px">
    <?php foreach($material as $mat){ ?>
    <tr>
        <td>Class:<br>
            <input name="class"value="<?php echo $mat->class;?>" required style="width:200px;">
               
        </td>

       <td>Material Title:<br>
            <input name="class"value="<?php echo $mat->title;?>" required style="width:200px;">
               
        </td>
        <td>Price:<br>
            <input name="class"value="<?php echo $mat->price;?>" required style="width:200px;">
               
        </td>
          <td>
            <a href="<?php echo base_url();?>lunar/updateMaterialPrice<?php echo $mat->id;?> " class="btn btn-warning">Update</a>
               
        </td>
    </tr>

   <?php }?>
    
</table>

</form>
        
    </div>
</div>




<?php include('footer.php'); ?>
