<?php include('student_header.php');?>

<style>
.page-title {
  text-align: center;
  padding: 20px;
  font-weight: 600;
}

/* Profile Card */
.profile-card {
  border: none;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.profile-icon {
  font-size: 60px;
  color: #005580;
}

/* Table */
.table-container {
  background: #fff;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  overflow-x: auto;
}

/* Buttons */
.btn-custom {
  border-radius: 20px;
  padding: 4px 12px;
  font-size: 13px;
}

/* Success */
.success-msg {
  background: green;
  color: #fff;
  padding: 10px;
  text-align: center;
  border-radius: 5px;
}

/* Mobile */
@media (max-width: 768px) {
  .profile-card {
    margin-bottom: 15px;
  }
}
</style>

<section>
<div class="container-fluid">

<!-- SUCCESS -->
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row mb-3">
  <div class="col-12">
    <div class="success-msg">
      <?php echo $this->session->flashdata('success');?>
    </div>
  </div>
</div>
<?php }?>

<h4 class="page-title">Profile & Product Registration</h4>

<div class="row p-3">

<!-- LEFT SIDE -->
<div class="col-sm-12 col-md-3 col-lg-3">

<div class="card profile-card p-3 text-center">
  <h5>My Profile</h5>
  <i class="fa-solid fa-circle-user profile-icon my-2"></i>

  <ul class="list-group list-group-flush text-start">
    <li class="list-group-item">
      <i class="fa-solid fa-envelope me-1"></i>
      <?php echo $students['email'];?>
    </li>
    <li class="list-group-item">
  <i class="fa-solid fa-signature me-1"></i>
  Name: <?php echo $students['first_name'].' '.$students['last_name']; ?>
</li>
    <li class="list-group-item">
      <i class="fa-solid fa-mobile me-1"></i>
      <?php echo $students['mobile'];?>
    </li>
  </ul>
</div>

<div class="card profile-card mt-3 text-center p-3">
  <h6>Register Another Student</h6>
  <a href="<?php echo base_url();?>welcome/registration_detail"
     class="btn btn-outline-primary btn-custom mt-2">
     Register
  </a>
</div>

</div>

<!-- RIGHT SIDE -->
<div class="col-sm-12 col-md-9 col-lg-9">

<div class="table-container">

<table class="table table-hover align-middle">
<thead class="table-dark">
<tr>
<th>Sr.No.</th>
<th>Class</th>
<th>Student Name</th>
<th>Product</th>
<th>CIN</th>
<th>Actions</th>
<th>Register</th>
</tr>
</thead>

<tbody>

<!-- LOOP 1 -->
<?php $i=1; foreach($student as $value){ ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $value['class'];?></td>
<td><?php echo $value['first_name'].' '.$value['last_name'];?></td>
<td><?php echo $value['product_name'];?></td>
<td><?php echo $value['cin'];?></td>

<td>
<a href="<?php echo base_url();?>welcome/student_profile/<?php echo $value['id'];?>"
   class="btn btn-sm btn-outline-primary btn-custom">Edit</a>

<?php if(!empty($value['cin'])) { ?>
<a href="<?php echo base_url();?>welcome/profile_cin/<?php echo $value['cin']; ?>"
   class="btn btn-sm btn-outline-success btn-custom">Download</a>
<?php } ?>
</td>

<td>
<a href="<?php echo base_url();?>welcome/new_product/<?php echo $value['id'];?>"
   class="btn btn-sm btn-outline-danger btn-custom">
   Register
</a>
</td>

</tr>
<?php $i++;} ?>

<!-- LOOP 2 -->
<?php $i=1; foreach($student_cin as $value){ ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $value['class'];?></td>
<td><?php echo $value['student_name'];?></td>
<td><?php echo $value['product_name'];?></td>
<td><?php echo $value['cin'];?></td>

<td>
<a href="<?php echo base_url();?>welcome/student_profile_cin/<?php echo $value['id'];?>"
   class="btn btn-sm btn-outline-primary btn-custom">Edit</a>

<a href="<?php echo base_url();?>welcome/profile_cin/<?php echo $value['cin'];?>"
   class="btn btn-sm btn-outline-success btn-custom">Download</a>
</td>

<td>
<a href="<?php echo base_url();?>welcome/new_product/<?php echo $value['id'];?>"
   class="btn btn-sm btn-outline-danger btn-custom">
   Register
</a>
</td>

</tr>
<?php $i++;} ?>

</tbody>
</table>

</div>
</div>

</div>
</div>
</section>

<?php include('student_footer.php'); ?>