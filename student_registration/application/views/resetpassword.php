
<style>
.page-container{
    min-height:100vh;
    display:flex;
    flex-direction:column;
    /*background:#f5f7fb;*/
}

.page-content{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.form-card{
    width:100%;
    max-width:500px;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
    background:#fff;
}

h4{
    font-weight:700;
    color:#006699;
}

label{
    font-weight:500;
}

/* Buttons */
.btn-custom{
    background:#ff6600;
    color:#fff;
    font-size:16px;
    transition:0.3s;
}

.btn-custom:hover{
    background:#e65c00;
    transform:translateY(-2px);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.btn-back{
    background:#6c757d;
    color:#fff;
}

.btn-back:hover{
    background:#5a6268;
}

/* Success Message */
.success-msg{
    background:green;
    color:#fff;
    padding:10px;
    border-radius:8px;
    text-align:center;
}
</style>

<div class="page-container">
<?php include('cin_login/header.php'); ?>

    <div class="page-content">

        <div class="form-card p-4">

            <?php if(!empty($this->session->flashdata('success'))) { ?>
                <div class="success-msg mb-3">
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php }?>

            <h4 class="text-center mb-4">Reset Password</h4>

            <form method="POST">

                <div class="mb-3">
                    <label>Old Password</label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>

                <div class="mb-4">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>

                <!-- Buttons -->
                <div class="text-center mt-4">

                    <!-- SAVE BUTTON -->
                    <button type="submit" name="submit"
                        class="btn btn-outline-success btn-custom px-4 me-2">
                        <i class="fa-solid fa-circle-check"></i> Save
                    </button>

                    <!-- BACK BUTTON -->
                    <a href="<?php echo base_url();?>Cin_login"
                        class="btn btn-outline-secondary btn-back px-4">
                        <i class="fa-solid fa-arrow-left"></i> To Profile
                    </a>

                </div>

            </form>

        </div>

    </div>

    <?php include("cin_login/footer.php"); ?>

</div>