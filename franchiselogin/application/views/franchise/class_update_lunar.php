<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Payments</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Payments</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
				<div class="container mt-4">
                    <h3>Update Classes for Schedule ID: <?php echo $comp_id; ?></h3>
                    <hr>
                
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                
                    <?php if (empty($all_classes)) { ?>
                        <div class="alert alert-warning">
                            <strong>No classes found!</strong>
                        </div>
                    <?php } else { ?>
                        <form method="POST">
                            <div class="row">
                                <?php foreach ($all_classes as $class): ?>
                                    <?php 
                                        $isChecked = in_array($class['class_name'], $assigned_classes);
                                    ?>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="selected_classes[]" 
                                                   value="<?php echo $class['class_name']; ?>"
                                                   id="class_<?php echo $class['class_id']; ?>"
                                                   <?php echo $isChecked ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="class_<?php echo $class['class_id']; ?>">
                                                <?php echo $class['class_name']; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                
                            <hr>
                            <button type="submit" name="submit" class="btn btn-primary">Update Classes</button>
                        </form>
                    <?php } ?>
                </div>


					
					
			</div><!--/span-->
		
		</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentTable').DataTable({
                "pageLength": 10
            });
        });
    </script>
<?php 
	$this->confirmation->confirm('delete');
?>