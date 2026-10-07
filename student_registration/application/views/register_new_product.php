<?php include "student_header.php"?>

<style>
body {
  background: #f4f6f9;
}

/* Back button */
.back-btn {
  margin: 15px 0 0 20px;
}

/* Card */
.form-card {
  max-width: 500px;
  margin: 30px auto;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  border: none;
}

/* Title */
.form-title {
  font-size: 22px;
  font-weight: 600;
}

/* Labels */
.form-label {
  font-size: 14px;
  font-weight: 500;
}

/* Inputs */
.form-control {
  height: 42px;
  border-radius: 6px;
  font-size: 14px;
}

/* Button */
.submit-btn {
  background: #ff6600;
  border: none;
  font-size: 16px;
  padding: 10px;
  border-radius: 6px;
  width: 100%;
}

.submit-btn:hover {
  background: #e65c00;
}

/* Message */
.success-msg {
  background: green;
  color: #fff;
  font-weight: bold;
  text-align: center;
  padding: 10px;
}

/* Mobile */
@media (max-width: 576px) {
  .form-card {
    margin: 20px;
  }
}
</style>

<!-- BACK BUTTON -->
<a onclick="history.back()" class="btn btn-outline-secondary btn-sm back-btn">
  <i class="fa-solid fa-circle-chevron-left me-2"></i> BACK
</a>

<!-- SUCCESS MESSAGE -->
<?php if(!empty($this->session->flashdata('msg'))){ ?>
<div class="success-msg">
  <?php echo $this->session->flashdata('msg');?>
</div>
<?php } ?>

<!-- CARD -->
<div class="card form-card p-4">

<form id="myform" action="<?php echo base_url();?>welcome/Purchase_ByClass" method="POST">

  <h4 class="text-center form-title mb-4">
    Registration for New Products
  </h4>

  <!-- CLASS -->
  <div class="mb-3">
    <label class="form-label">
      <i class="fa fa-graduation-cap me-1"></i> Student Class
    </label>
    <select class="form-control" name="class" required>
      <option value="">Select Class</option>
      <option value="1" <?php if($class=='Nursery'){ echo 'selected';} ?>>Nursery</option>
      <option value="2" <?php if($class=='LKG'){ echo 'selected';} ?>>LKG</option>
      <option value="3" <?php if($class=='UKG'){ echo 'selected';} ?>>UKG</option>
      <option value="4" <?php if($class=='Class-1'){ echo 'selected';} ?>>Class-1</option>
      <option value="5" <?php if($class=='Class-2'){ echo 'selected';} ?>>Class-2</option>
      <option value="6" <?php if($class=='Class-3'){ echo 'selected';} ?>>Class-3</option>
      <option value="7" <?php if($class=='Class-4'){ echo 'selected';} ?>>Class-4</option>
      <option value="8" <?php if($class=='Class-5'){ echo 'selected';} ?>>Class-5</option>
      <option value="9" <?php if($class=='Class-6'){ echo 'selected';} ?>>Class-6</option>
      <option value="10" <?php if($class=='Class-7'){ echo 'selected';} ?>>Class-7</option>
      <option value="11" <?php if($class=='Class-8'){ echo 'selected';} ?>>Class-8</option>
      <option value="12" <?php if($class=='Class-9'){ echo 'selected';} ?>>Class-9</option>
      <option value="13" <?php if($class=='Class-10'){ echo 'selected';} ?>>Class-10</option>
      <option value="14" <?php if($class=='Class-11'){ echo 'selected';} ?>>Class-11</option>
      <option value="15" <?php if($class=='Class-12'){ echo 'selected';} ?>>Class-12</option>
    </select>
  </div>

  <!-- ACCESS CODE -->
  <div class="mb-3">
    <label class="form-label">
      <i class="fa fa-key me-1"></i> Access Code *
    </label>
    <input type="text" name="access_code" class="form-control"
      value="<?php echo $school_code;?>" placeholder="Enter Access Code" required>

    <small class="text-muted">
      * Contact your School Coordinator or MaRRS Franchise
    </small>
  </div>

  <!-- BUTTON -->
  <button type="submit" name="submit" id="submit" class="submit-btn">
    Submit
  </button>

</form>
</div>

<!-- VALIDATION -->
<script>
$('#myform').validate({
  rules: {
    class: { required: true },
    access_code: { required: true }
  }
});
</script>

<?php include "student_footer.php"?>