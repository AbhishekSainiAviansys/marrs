<?php 
include('header.php');

// Define the number of rows dynamically or use a constant value
$num_rows = 7;

// Initialize an empty array to store input field names
$input_fields = [];

// Populate the input field names array
//for ($i = 1; $i <= $num_rows; $i++) {
    $input_fields[] = [
        'center_name' => "center_name",
        'center_address' => "center_address",
        'exam_date' => "exam_date",
        'exam_time' => "exam_time"
    ];
//}
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small> Competition Center Details</small></h1>
        </div>
        <div class="box-content">
            <form class="" method="POST">
                <fieldset>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Action</th>
                                    <th>Maker Fix Amount</th>
                                    <th>Title</th>
                                    <th>Class</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                            // Prepare a lookup array of assigned materials by mat_id
                                            $assigned_lookup = [];
                                            foreach ($assigned_materials as $a) {
                                                $assigned_lookup[$a->mat_id] = $a; // active_materials.mat_id = study_material.id
                                            }
                                            
                                            $i = 1;
                                            foreach ($all_materials as $row) {
                                                $isChecked = isset($assigned_lookup[$row->id]) ? 'checked' : '';
                                                $makerPrice = isset($assigned_lookup[$row->id]) ? $assigned_lookup[$row->id]->maker_price : '';
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td>
                                                    <input type="checkbox" name="center_name[]" value="<?= $row->id; ?>" <?= $isChecked; ?>>
                                                </td>
                                                <td>
                                                    <input type="text" name="maker_price[]" value="<?= $makerPrice; ?>">
                                                </td>
                                                <td><p><?= $row->title; ?></p></td>
                                                <td><p><?= $row->class; ?></p></td>
                                                <td>
                                                    <p>
                                                        <?= $row->status; ?><br>
                                                        Type: <?= $row->type; ?><br>
                                                        Series: <?= $row->series; ?><br>
                                                        Variant: <?= $row->sub_type; ?><br>
                                                        Subject: <?= $row->subject; ?>
                                                    </p>
                                                </td>
                                            </tr>
                                            <?php $i++; } ?>


                            </tbody>
                        </table>
                    </div>
                </fieldset>
                <button name='submit' class='btn btn-info' value=''>Submit</button>
                <button name='back' class='btn btn-success' value=''>Back To List</button>
            </form>
        </div>
    </div><!--/span-->
</div><!--/row-->

<?php include('footer.php'); ?>