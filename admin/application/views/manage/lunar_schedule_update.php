<?php include('header.php'); ?>

<div class="row-fluid sortable">

    <div class="box span12">
    <!-------------->
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Revenue-Price Setting</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
    <!-------------->

        <!-- Success / Error Message -->
        <h3 style='color:green;'><?php echo !empty($message) ? $message : ''; ?></h3>

        <div class="box-content">

            <form action="" method="post">
                <table cellpadding="5px" width='100%'>

                    <!-- ROW 1: Period, Product, Level, Management %, Aviansys % -->
                    <tr>
                        <td>Period: <span style='color:red;'>*</span><br />
                            <select name="period" id="period" style="width: 160px;" required>
                                <option value="">-- select period --</option>
                                <?php foreach ($periodload as $p): ?>
                                    <option value="<?= $p->period_id ?>"
                                        <?= (isset($result) && $result['period_id'] == $p->period_id) ? 'selected' : '' ?>>
                                        <?= $p->academic_year ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td>Product: <span style='color:red;'>*</span><br />
                            <select name="product_id" id="product" style="width: 180px;" required>
                              
                                    <option value="<?= $result['product_name'] ?>">
                                        <?= $result['product_name'] ?>
                                    </option>
                              
                            </select>
                        </td>
                        
                       
                            <td>
                                Franchise:<br>
                                <select name="franchise_id" required style="width:180px;">
                                    <option value="">-- Select Franchise --</option>
                                    <?php foreach ($franchiseload as $row): ?>
                                        <option value="<?= $row['franchise_id'] ?>"
                                            <?= (isset($result) && $result['franchise_id'] == $row['franchise_id']) ? 'selected' : '' ?>>
                                            <?= $row['franchise_first_name'] . ' ' . $row['franchise_last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                Subject:<br>
                                <input type="text"
                                       name="subject"
                                       id="subject"
                                       value="<?= isset($result['subject']) ? $result['subject'] : '' ?>"
                                       style="width:180px;">
                            </td>
                        
                            <td>
                                Series:<br>
                                <input type="text"
                                       name="series"
                                       id="series"
                                       value="<?= isset($result['series']) ? $result['series'] : '' ?>"
                                       style="width:160px;">
                            </td>
                      
                        
                        <td>Competition Level: <span style='color:red;'>*</span><br />
                            <select name="clevel" id="level" style="width: 160px;" required>
                                <option value="">-- select level --</option>
                                <?php foreach ($levelload as $a): ?>
                                    <option value="<?= $a['level_id'] ?>"
                                        <?= (isset($result) && $result['level_id'] == $a['level_id']) ? 'selected' : '' ?>>
                                        <?= $a['level_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                       
                    </tr>
                    <tr>
                         <hr>
                        <td id='product_price'>Competition Registration Price <span style='color:red;'>*</span><br>
                            <input type='text' name='amount' style="width: 200px;"
                                value="<?= isset($result['amount']) ? $result['amount'] : '' ?>">
                        </td>

                        <td>Season: <span style='color:red;'>*</span><br />
                            <select name="season" id="season" style="width: 180px;" required>
                                <option value="">-- select season --</option>
                               
                                    <option value="<?= $result['season'] ?>" selected>
                                        <?= $result['season'] ?>
                                    </option>
                              
                            </select>
                        </td>
                          <td>SartDate: <span style='color:red;'>*</span><br />
                            <input type='text' name='start_date' style="width: 180px;"
                                value="<?= isset($result['start_date']) ? $result['start_date'] : '' ?>">
                        </td>
                          <td>EndDate: <span style='color:red;'>*</span><br />
                             <input type='text' name='end_date' style="width: 180px;"
                                value="<?= isset($result['end_date']) ? $result['end_date'] : '' ?>">
                        </td>
                         <td>Type <span style='color:red;'>*</span><br>
                             <input type='text' name='type' style="width: 180px;"
                                value="<?= isset($result['type']) ? $result['type'] : '' ?>">
                        </td>
                        
                        
                    </tr>

                    <!-- ROW 2: Associate %, Franchise %, CRM %, Competition Price, Free Material Royalty -->
                    <tr>
                        <td>Management Percentage <span style='color:red;'>*</span><br>
                            <select name="management_percentage" style="width: 200px;" required>
                                <option value="">-- select management % --</option>
                                <?php
                                $mgmt_percentages = [2, 3, 4, 5, 8, 10, 12, 15, 16, 18, 20, 22];
                                foreach ($mgmt_percentages as $percent):
                                    $selected = (isset($result) && $result['management_percentage'] == $percent) ? 'selected' : '';
                                ?>
                                    <option value="<?= $percent ?>" <?= $selected ?>><?= $percent ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td>Aviansys Percentage <span style='color:red;'>*</span><br>
                            <select name="aviansys_percentage" style="width: 200px;" required>
                                <option value="">-- select aviansys % --</option>
                                <?php
                                $avian_percentages = [2, 3, 4, 5, 8, 10, 12, 15, 16, 18, 20, 22, 25, 30];
                                foreach ($avian_percentages as $percent):
                                    $selected = (isset($result) && $result['aviansys_percentage'] == $percent) ? 'selected' : '';
                                ?>
                                    <option value="<?= $percent ?>" <?= $selected ?>><?= $percent ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>Associate Percentage<br>
                            <select name="associate_per" style="width: 200px;">
                                <option value="">-- select associate % --</option>
                                <?php
                                $assoc_percentages = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60];
                                foreach ($assoc_percentages as $percent):
                                    $selected = (isset($result) && $result['associate_cut'] == $percent) ? 'selected' : '';
                                ?>
                                    <option value="<?= $percent ?>" <?= $selected ?>><?= $percent ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td>Franchise Percentage<br>
                            <select name="franchise_percentage" style="width: 200px;">
                                <option value="">-- select franchise % --</option>
                                <?php
                                $franchise_percentages = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60];
                                foreach ($franchise_percentages as $percent):
                                    $selected = (isset($result) && $result['franchise_percentage'] == $percent) ? 'selected' : '';
                                ?>
                                    <option value="<?= $percent ?>" <?= $selected ?>><?= $percent ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <td>CRM % <span style='color:red;'>*</span><br>
                            <select name="crm_per" style="width: 200px;">
                                <option value="">-- select CRM % --</option>
                                <?php
                                $crm_percentages = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
                                foreach ($crm_percentages as $percent):
                                    $selected = (isset($result) && $result['crm_per'] == $percent) ? 'selected' : '';
                                ?>
                                    <option value="<?= $percent ?>" <?= $selected ?>><?= $percent ?>%</option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                       
                        
                    </tr>

                    <!-- ROW 3: Material A-F Price & Royalty -->
                    <tr>
                    <?php   $materials = ['a', 'b', 'c', 'd', 'e', 'f'];

                    foreach ($materials as $mat):
                        $price   = isset($result['study_material_' . $mat . '_price'])         ? $result['study_material_' . $mat . '_price']         : '';
                        $royalty = isset($result['study_material_' . $mat . '_price_royalty']) ? $result['study_material_' . $mat . '_price_royalty'] : '';
                    ?>
                        <td>
                            Material-<?= strtoupper($mat) ?> Price<br>
                            <input type="text"
                                   name="study_material_<?= $mat ?>_price"
                                   style="width:100px;"
                                   value="<?= $price ?>">
                    
                            <br>Material-<?= strtoupper($mat) ?> Royalty<br>
                            <input type="text"
                                   name="study_material_<?= $mat ?>_price_royalty"
                                   style="width:100px;"
                                   value="<?= $royalty ?>">
                        </td>
                    <?php endforeach; ?>
                    </tr>

                    <tr>
                        <td colspan='11'></td>
                    </tr>

                    <!-- ROW 4: Orientation A-F Price -->
                    <tr>
                        <?php
                        $orientations = ['a', 'b', 'c', 'd', 'e', 'f'];
                        foreach ($orientations as $ori):
                        ?>
                        <td>Orientation-<?= strtoupper($ori) ?> Price<br>
                            <input type='text' name='orientation_<?= $ori ?>_price' style="width: 210px;"
                                value="<?= isset($result['orientation_' . $ori . '_price']) ? $result['orientation_' . $ori . '_price'] : '' ?>">
                        </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- ROW 5: MockTest A-F Price & Royalty -->
                    <tr>
                        <?php
                        $mocktests = ['a', 'b', 'c', 'd', 'e', 'f'];
                        foreach ($mocktests as $mt):
                        ?>
                        <td>MockTest-<?= strtoupper($mt) ?> Price<br>
                            <input type='text' name='mock_test_<?= $mt ?>_price' style="width: 100px;"
                                value="<?= isset($result['mock_test_' . $mt . '_price']) ? $result['mock_test_' . $mt . '_price'] : '' ?>">
                            <br>MockTest-<?= strtoupper($mt) ?> Royalty<br>
                            <input type='text' name='mock_test_<?= $mt ?>_price_royalty' style="width: 100px;"
                                value="<?= isset($result['mock_test_' . $mt . '_price_royalty']) ? $result['mock_test_' . $mt . '_price_royalty'] : '' ?>">
                        </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Submit -->
                    <tr>
                        <td><br />
                            <input type="submit" name="submit" value="Submit" class='btn btn-info btn-lg' />
                        </td>
                    </tr>

                </table>

                <br />
            </form>

        </div>

    </div><!--/span-->

</div><!--/row-->


<script>
$(document).ready(function() {

    // Hide optional divs initially
    $('#subjectdiv').hide();
    $('#varientdiv').hide();
    $('#seriesdiv').hide();

    // When product changes — show/hide subject/variant/series and load levels
    $("#product").change(function() {
        var product_id = this.value;

        if (product_id === '8') {
            $('#subjectdiv').show();
            $('#varientdiv').show();
            $('#seriesdiv').show();
        } else {
            $('#subjectdiv').hide();
            $('#varientdiv').hide();
            $('#seriesdiv').hide();
        }

        $.ajax({
            url:"<?php echo base_url();?>ajax/productwiselevel",
            data: { product_id: product_id },
            type: 'POST',
            success: function(result) {
                $("#level").html(result);
            },
            error: function() {
                alert("An error occurred while fetching level data.");
            }
        });
    });

    // Show/hide competition price based on level selection
    $("#level").change(function() {
        if (this.value === "1") {
            $('#product_price').hide();
        } else {
            $('#product_price').show();
        }
    });

    // Trigger on load to set initial state
    $("#level").trigger('change');

    // Subject change — load variants
    $("#subject").change(function() {
        var subject_key = this.value;
        $.ajax({
            url:"<?php echo base_url();?>manage/ajax/getlunar_subject_key",
            data: { subject_key: subject_key },
            type: 'POST',
            success: function(result) {
                $("#varient").html(result);
            },
            error: function() {
                alert("An error occurred while fetching variant data.");
            }
        });
    });

    // Variant change — load series
    $("#varient").change(function() {
        var varient     = this.value;
        var subject_key = $('#subject').val();
        var period      = $('#period').val();
        $.ajax({
            url:"<?php echo base_url();?>ajax/getlunar_series",
            data: { subject_key: subject_key, varient: varient, period: period },
            type: 'POST',
            success: function(result) {
                $("#series").html(result);
            },
            error: function() {
                alert("An error occurred while fetching series data.");
            }
        });
    });

    // Secondary product change (product1 / level1 if used elsewhere on page)
    $("#product1").change(function() {
        var product_id = this.value;
        $.ajax({
            url:"<?php echo base_url();?>manage/ajax/productwiselevel",
            data: { product_id: product_id },
            type: 'POST',
            success: function(result) {
                $("#level1").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });

    $("#level1").change(function() {
        if (this.value === "1") {
            $('#product_price').hide();
        } else {
            $('#product_price').show();
        }
    });

    $("#level1").trigger('change');

});
</script>

<?php include('footer.php'); ?>