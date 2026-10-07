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
.qr-code-img{
    width:70px;
    height:70px;
}

.link-meta{
    margin-top:8px;
}

.lunar-panel{
    background:#fff;
    border:1px solid var(--lunar-border);
    border-radius:14px;
    padding:18px 20px;
    margin-bottom:20px;
    box-shadow:0 1px 2px rgba(20,20,43,0.04);
}




.lunar-filter-actions{
    display:flex;
    gap:8px;
}





</style>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h3><small>Create Regsitration Link </small></h3>
        </div>
       <div class="box-content-form">
    <form method="POST" action="">
        <div class="row">
           <div class="col-lg-6">
            <label>Generation Link</label>
            <select name="type" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="franchise" <?php echo ($type == 'franchise') ? 'selected' : ''; ?>>Franchises</option>
                <option value="associate" <?php echo ($type == 'associate') ? 'selected' : ''; ?>>Affiliate</option>
            </select>
        </div>
        
       

            <div class="col-lg-6">
                <div class="btn mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
        <div class="box-content">
           
           
           <?php if ($type == 'franchise') : ?>

   
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
                       
                        <th>By Code</th>
                       
                         <th>Active Links</th>
                          <th>QR CODE</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($associates)) : ?>
                        <?php foreach ($associates as $index => $associate) : ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $associate['franchise_first_name']; ?></td>
                                <td><?php echo $associate['franchise_last_name']; ?></td>
                                <td><?php echo $associate['company_email_id']; ?></td>
                                <td><?php echo $associate['company_phno']; ?></td>
                                <td><?php echo $associate['Bank Name'] ?: 'N/A'; ?></td>
                                <td><?php echo $associate['account_number'] ?: 'N/A'; ?></td>
                                <td> </td>
                               
                                <td>

                                <?php 
                               $links = $this->db->get_where(
                                        'associate_link',
                                        ['franchise_id' => $associate['franchise_id'], 'associate_id' => NULL]
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
                                    <?php if (!empty($links)) : ?>
                                        <?php
                                        $qrLink = $links[0]->link . $links[0]->associate_link_id;
                                        $qrUrl  = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" . urlencode($qrLink);
                                        ?>
                                        <img src="<?= $qrUrl ?>" alt="QR Code" class="qr-code-img">
                                    <?php else : ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                   $links = $this->db->get_where(
                                        'associate_link',
                                        ['franchise_id' => $associate['franchise_id']]
                                    )->row();
                                    
                                    if(empty($links)){ ?>
                                        <a href='<?php echo base_url() . "manage/lunar/createlinkfranchise/" . $associate['franchise_id']; ?>' class="btn btn-warning btn-sm edit-profile">Create Link</a>
                                    <?php }else{ ?>
                                        <div class="mt-2">
                                            <a href="<?php echo base_url('manage/lunar/deletelink/'.$links->associate_link_id); ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this link?');">
                                               Delete Link
                                            </a>
                                        </div>    
                                        <div class="mt-2">
                                
                                            <a href="<?= base_url('manage/lunar/editlinkfranchise/'.$link->associate_link_id); ?>"
                                               class="btn btn-info btn-sm">
                                               Edit Link
                                            </a>
                                
                                        </div>
                                    <?php } ?>
                                 <div class="mt-2">
                                    <a href="javascript:void(0);"
                                       class="btn btn-warning btn-sm deactivate-link"
                                       data-id="<?= $associate['franchise_id']; ?>"
                                       onclick="return confirm('Are you sure you want to deactivate this link?');">
                                       Deactivate
                                    </a>
                                </div>
                                         
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
            

    <?php elseif ($type == 'associate') : ?>

    <!-- Existing Associates Table Here -->


            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                       
                        <th>By Code</th>
                       
                         <th>Active Links</th>
                         <th>QR CODE</th>
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
                                <td> </td>
                               
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
                                    <?php if (!empty($links)) : ?>
                                        <?php
                                        $qrLink = $links[0]->link . $links[0]->associate_link_id;
                                        $qrUrl  = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" . urlencode($qrLink);
                                        ?>
                                        <img src="<?= $qrUrl ?>" alt="QR Code" class="qr-code-img">
                                    <?php else : ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                    $links = $this->db->get_where(
                                        'associate_link',
                                        ['associate_id' => $associate['associate_id']]
                                    )->row();
                                    
                                    if(empty($links)){ ?>
                                        <a href='<?php echo base_url() . "manage/lunar/createlink/" . $associate['associate_id']; ?>' class="btn btn-warning btn-sm edit-profile">Create Link</a>
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
                                               
                                               class="btn btn-info btn-sm">
                                               Edit Link
                                            </a>
                                
                                        </div>
                                    <?php } ?>
                                
                                
                                <div class="mt-2">
                                    <a href="javascript:void(0);"
                                       class="btn btn-warning btn-sm deactivate-link-asso"
                                       data-id="<?= $associate['associate_id']; ?>"
                                       onclick="return confirm('Are you sure you want to deactivate this link?');">
                                       Deactivate
                                    </a>
                                </div>
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
            
            <?php endif; ?>
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
$(document).on("click", ".deactivate-link", function () {

    let id = $(this).data("id");
    let btn = $(this);

    $.ajax({
        url: "<?php echo base_url('manage/lunar/DeactivateFr'); ?>",
        type: "POST",
        data: { id: id },

        success: function(response) {
            location.reload(); // or update the badge in place instead of a full reload
        },

        error: function() {
            alert('Something went wrong while deactivating the link.');
        }
    });
});
$(document).on("click", ".deactivate-link-asso", function () {

    let id = $(this).data("id");

    $.ajax({
        url: "<?php echo base_url('manage/lunar/DeactivateAsso'); ?>",
        type: "POST",
        data: { id: id },

        success: function(response) {
            alert(response.message || 'Link deactivated successfully.');
            location.reload();
        },

        error: function(xhr) {
            alert('Failed to deactivate link.');
            console.log(xhr.responseText);
        }
    });
});
</script>