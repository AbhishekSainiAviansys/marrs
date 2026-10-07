<?php include('header.php'); ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Update Affiliate and Bank Details</small></h1>
        </div>
        <div class="box-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($associates)) : ?>
                        <?php foreach ($associates as $index => $associate) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $associate['first_name']; ?></td>
                                <td><?php echo $associate['last_name']; ?></td>
                                <td><?php echo $associate['email']; ?></td>
                                <td><?php echo $associate['phone']; ?></td>
                                <td><?php echo $associate['bank_name'] ?: 'N/A'; ?></td>
                                <td><?php echo $associate['account_number'] ?: 'N/A'; ?></td>
                                <td><?php echo $associate['ifsc_code'] ?: 'N/A'; ?></td>
                                <td>
                <a href='<?php echo base_url() . "manage/lunar/edit_profile/" . $associate['associate_id']; ?>' 
                   class="btn btn-warning btn-sm edit-profile" >Edit Profile</a>

                <a href='<?php echo base_url() . "manage/lunar/edit_bank/" . $associate['associate_id']; ?>' 
                   class="btn btn-info btn-sm edit-bank" >Edit Bank Details</a>
            </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">No Affiliate found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






<script>
$(document).ready(function () {
    // Open Profile Modal
    $('.edit-profile').on('click', function () {
        var associateId = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url("manage/lunar/get_profile/"); ?>' + associateId,
            type: 'GET',
            success: function (response) {
                $('#profile_associate_id').val(response.associate_id);
                $('#profile_first_name').val(response.first_name);
                $('#profile_last_name').val(response.last_name);
                $('#profile_email').val(response.email);
                $('#profile_phone').val(response.phone);
                $('#profileModal').modal('show');
            }
        });
    });

    // Submit Profile Form
    $('#profileForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url("manage/lunar/update_profile"); ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                location.reload();
            }
        });
    });

    // Open Bank Modal
    $('.edit-bank').on('click', function () {
        var associateId = $(this).data('id');
        $.ajax({
            url: '<?php echo base_url("manage/lunar/get_bank/"); ?>' + associateId,
            type: 'GET',
            success: function (response) {
                $('#bank_associate_id').val(response.associate_id);
                $('#bank_name').val(response.bank_name);
                $('#account_number').val(response.account_number);
                $('#ifsc_code').val(response.ifsc_code);
                $('#bankModal').modal('show');
            }
        });
    });

    // Submit Bank Form
    $('#bankForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url("manage/lunar/update_bank"); ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                location.reload();
            }
        });
    });
});
</script>
<?php include('footer.php'); ?>
