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
                                    <th>Center Name</th>
                                    <th>Center Address</th>
                                    <th>Date</th>
                                    <th>Class - Time Ex: (Nursery - 8:00 AM / LKG - 9:00 AM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=1 ;$i<=7; $i++){ ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><input type='text' name='center_name[]'></td>
                                        <td><input type='text' name='center_address[]'></td>
                                        <td><input type='date' name='exam_date[]'></td>
                                        <td><input type='text' name='exam_time[]'></td>
                                    </tr>
                                <?php } ?>
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
