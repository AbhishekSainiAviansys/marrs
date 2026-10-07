<?php include('header.php');
?>

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    #example_filter { float: right; position: relative; right: 0px; }
    #example_length { position: absolute; padding-left: 20px; }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?php echo $this->notifications->display_html();?>
<div>
	<div class="container">
				<ul class="breadcrumb">
					<li>
						<a href="<?php //echo SITE_URL?>content/">CIN</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php //echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
<div class="container py-3 mb-3">

    	

    <form method="POST" action='<?php echo base_url()?>manage/franchise/delete_all'>
        <input type="hidden" name="comp_id" value="<?php echo $comp_id;?>">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-person-fill me-1"></i> CIN</span>
                <div>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-up"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-x"></i></a>
                </div>
            </div>

            <div class="card-header bg-light">
                <h4 class="mb-1"><?php echo $schedule->center_address; ?></h4>
                <h4 class="mb-0 text-muted"><?php echo $schedule->product_name; ?></h4>
            </div>

            <div class="card-body">

                <div class="d-flex justify-content-end mb-2">
                    <a href="<?php echo base_url('manage/franchise/export_cin/'.$comp_id); ?>" class="btn btn-success btn-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>SL No.</th>
                                <th>Student Name</th>
                                <th>CIN</th>
                                <th>Product Name</th>
                                <th>Franchise ID</th>
                                <th>Area code</th>
                                <th>Class</th>
                                <th>Categoery</th>
                                <!--<th>School</th>-->
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i=1;foreach( $cin_list as $value ) { //print_r($value);die;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>

                                <td><?php echo $value['student_name']; ?></td>
                                <td><?php echo $value['cin']; ?></td>
                                <td><?php echo $value['product_name']; ?></td>
                                <td><?php echo $value['franchise_id']; ?></td>
                                <td><?php echo $value['franchise_code']; ?></td>
                                <td><?php echo $value['class']; ?></td>
                                <td>
                                    <?php echo $value['category_id']; ?>
                                </td>

                                <!--<td class="center">-->

                                    <!--<a class="btn btn-info" href="" title="Edit">-->
                                    <!--	Edit                              -->
                                    <!--</a>-->
                                <!--</td>-->

                                <td class="text-center text-nowrap">

                                    <a class="btn btn-info btn-sm" href="<?php echo base_url();?>manage/franchise/editcin/<?php echo $value['cin'].'/'.$schedule->competition_schedule_id;?>" title="Edit">
                                        Edit
                                    </a>

                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletecin/<?php echo $value['cin'].'/'.$schedule->competition_schedule_id;?>" title="Delete">
                                        Delete
                                    </a>

                                </td>

                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </form>
</div>
</div>
<script>
$(function () {
    // Guard against "Cannot reinitialise DataTable" if this view/script
    // gets loaded more than once (e.g. via AJAX) without a full page refresh.
    if ($.fn.DataTable.isDataTable('#example')) {
        $('#example').DataTable().destroy();
    }

    $('#example').DataTable({
        responsive: true,
        retrieve: true
    });
});
</script>

<?php
//echo 'footer';
include('footer.php');
?>