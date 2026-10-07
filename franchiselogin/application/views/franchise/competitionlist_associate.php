<?php include('header.php'); ?>

<style>

.link-card{
    border:1px solid #e5e5e5;
    border-radius:10px;
    padding:12px;
    margin-bottom:12px;
    background:#fafafa;
    transition:0.3s;
}

.link-card:hover{
    box-shadow:0 3px 12px rgba(0,0,0,0.08);
    transform:translateY(-2px);
}

.link-header{
    font-size:15px;
    margin-bottom:8px;
    color:#333;
}

.link-url{
    display:flex;
    gap:8px;
}

.link-meta{
    margin-top:8px;
}

</style>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h1><small>Create Regsitration Link Associate</small></h1>
        </div>
        <div class="box-content">
            <h1>Registration Link Associates</h1>
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
                        <th>Active Links</th>
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
                                <td>

                                <?php 
                                $links = $this->db->get_where(
                                    'associate_link',
                                    ['associate_id' => $associate['associate_id']]
                                )->result();
                                
                                if(!empty($links)){
                                    $i = 1;
                                
                                    foreach($links as $link){
                                
                                        $fullLink = $link->link.$link->associate_link_id;
                                
                                        $statusColor = ($link->status == 'Active') ? 'success' : 'secondary';
                                ?>
                                
                                <div class="link-card">
                                
                                    <div class="link-header">
                                        <strong>Link <?= $i ?></strong>
                                    </div>
                                
                                    <div class="link-body">
                                
                                        <div class="link-url">
                                            <input 
                                                type="text" 
                                                class="form-control linkInput" 
                                                value="<?= $fullLink ?>" 
                                                readonly
                                            >
                                
                                            <button 
                                                type="button"
                                                class="btn btn-sm btn-primary copyBtn"
                                            >
                                                Copy
                                            </button>
                                        </div>
                                
                                        <div class="link-meta">
                                
                                            <span class="badge bg-warning text-dark">
                                                Expire: <?= $link->expire_date ?>
                                            </span>
                                
                                            <span class="badge bg-<?= $statusColor ?>">
                                                <?= $link->status ?>
                                            </span>
                                
                                        </div>
                                
                                        
                                
                                    </div>
                                
                                </div>
                                
                                <?php
                                        $i++;
                                    }
                                }
                                else{
                                    echo "<span class='text-muted'>No Links created yet.</span>";
                                }
                                ?>
                                
                                </td>

                                <td>
                                    <?php 
                                    $links = $this->db->get_where(
                                        'associate_link',
                                        ['associate_id' => $associate['associate_id']]
                                    )->row();
                                    
                                    if(empty($links)){ ?>
                                        <a href='<?php echo base_url() . "manage/lunar/createlink/" . $associate['associate_id']; ?>' class="btn btn-warning btn-sm edit-profile" target='_BLANK'>Create Link</a>
                                    <?php }else{ ?>
                                        <div class="mt-2">
                                            <a href="<?php echo base_url('manage/lunar/deletelink/'.$links->associate_link_id); ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this link?');">
                                               Delete Link
                                            </a>
                                        </div>    
                                        <div class="mt-2">
                                
                                            <a href="<?= base_url('manage/lunar/editlink/'.$link->associate_link_id); ?>"
                                               target="_blank"
                                               class="btn btn-info btn-sm">
                                               Edit Link
                                            </a>
                                
                                        </div>
                                    <?php } ?>
                                
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">No associates found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<?php include('footer.php'); ?>





<script>

$(document).on("click", ".delete-link", function () {

    let id = $(this).data("id");

    if(confirm("Are you sure you want to delete this link?")) {

        $.ajax({
            url: "<?php echo base_url('manage/lunar/deletelink'); ?>",
            type: "POST",
            data: { id: id },

            success: function(response) {

                location.reload(); // reload page

            }
        });

    }
});



$(document).on('click','.copyBtn',function(){

    let input = $(this).closest('.link-url').find('.linkInput');

    input.select();
    input[0].setSelectionRange(0,99999);

    navigator.clipboard.writeText(input.val());

    $(this).text('Copied ✓');

    let btn = $(this);

    setTimeout(function(){
        btn.text('Copy');
    },1500);

});



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