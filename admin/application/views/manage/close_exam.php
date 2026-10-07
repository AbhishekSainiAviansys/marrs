<?php include('header.php');
// echo 'ok';die;
?>


			
			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h1><small> Competition Cart Details</small></h1>
					</div>
					<div class="box-content">
						<!--<form class="" method="POST">-->
							<fieldset>
							
						
						      <div>
						          
						          
						            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Date</th>
                                                <th>Center Name</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                        <?php 
                                        $result = $this->db->get_where('exam_centers', array('comp_id' => $id))->result();
                                        $i = 1;
                                        foreach ($result as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><input type='date' name='exam_date' value='<?= $row->exam_date; ?>' readonly></td>
                                                <td><input type='text' name='center_name' value='<?= $row->center_name; ?>' readonly></td>
                                                <td><input type='text' name='center_address' value='<?= $row->center_address; ?>' readonly></td>
                                                <td>
                                                    <?php
                                                    $comp = $this->db->get_where('competition_product_state', array('id' => $id))->row();
                                    
                                                    // Exam Registration
                                                    if ($comp->status == 'Live' && $row->exam_close == 1) {
                                                        echo "<button class='btn btn-success action-btn' data-action='open_registration' data-centerid='{$row->center_id}'>Open Registration</button><br><br>";
                                                        
                                                        
                                                    } else {
                                                        echo "<button class='btn btn-danger action-btn' data-action='close_registration' data-centerid='{$row->center_id}'>Close Registration</button><br><br>";
                                                    }
                                                    
                                                    
                                                    if (!empty($comp->study_material_a)) {
                                                        if ($row->close_material_a == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='close_material_a_open' data-centerid='{$row->center_id}'>Open Material A</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_material_a_close' data-centerid='{$row->center_id}'>Close Material A</button><br><br>";
                                                        }
                                                    }
                                    
                                                    // Study Material A
                                                    // if (!empty($comp->study_material_a)) {
                                                    //     if ($row->close_material_a == 1) {
                                                    //         echo "<button class='btn btn-success action-btn' data-action='open_material_a' data-centerid='{$row->center_id}'>Open Material A</button><br><br>";
                                                    //     } else {
                                                    //         echo "<button class='btn btn-danger action-btn' data-action='close_material_a' data-centerid='{$row->center_id}'>Close Material A</button><br><br>";
                                                    //     }
                                                    // }
                                                    
                                                    if (!empty($comp->study_material_b)) {
                                                        if ($row->close_material_b == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='close_material_b_open' data-centerid='{$row->center_id}'>Open Material B</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_material_b_close' data-centerid='{$row->center_id}'>Close Material B</button><br><br>";
                                                        }
                                                    }
                                    
                                                    // Study Material B
                                                    // if (!empty($comp->study_material_b)) {
                                                    //     if ($row->close_material_b == 1) {
                                                    //         echo "<button class='btn btn-success action-btn' data-action='open_material_b' data-centerid='{$row->center_id}'>Open Material B</button><br><br>";
                                                    //     } else {
                                                    //         echo "<button class='btn btn-danger action-btn' data-action='close_material_b' data-centerid='{$row->center_id}'>Close Material B</button><br><br>";
                                                    //     }
                                                    // }
                                                    
                                                    if (!empty($comp->study_material_c)) {
                                                        if ($row->close_material_c == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='close_material_c_open' data-centerid='{$row->center_id}'>Open Material C</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_material_c_close' data-centerid='{$row->center_id}'>Close Material C</button><br><br>";
                                                        }
                                                    }
                                                    
                                    
                                                    // Study Material C
                                                    // if (!empty($comp->study_material_c)) {
                                                    //     if ($row->close_material_c == 1) {
                                                    //         echo "<button class='btn btn-success action-btn' data-action='open_material_c' data-centerid='{$row->center_id}'>Open Material C</button><br><br>";
                                                    //     } else {
                                                    //         echo "<button class='btn btn-danger action-btn' data-action='close_material_c' data-centerid='{$row->center_id}'>Close Material C</button><br><br>";
                                                    //     }
                                                    // }
                                    
                                                    // Orientation A
                                                    if (!empty($comp->orientation_a)) {
                                                        if ($row->close_orientation_a == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='open_orientation_a' data-centerid='{$row->center_id}'>Open Orientation A</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_orientation_a' data-centerid='{$row->center_id}'>Close Orientation A</button><br><br>";
                                                        }
                                                    }
                                    
                                                    // Orientation B
                                                    if (!empty($comp->orientation_b)) {
                                                        if ($row->close_orientation_b == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='open_orientation_b' data-centerid='{$row->center_id}'>Open Orientation B</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_orientation_b' data-centerid='{$row->center_id}'>Close Orientation B</button><br><br>";
                                                        }
                                                    }
                                    
                                                    // Orientation C
                                                    if (!empty($comp->orientation_c)) {
                                                        if ($row->close_orientation_c == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='open_orientation_c' data-centerid='{$row->center_id}'>Open Orientation C</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_orientation_c' data-centerid='{$row->center_id}'>Close Orientation C</button><br><br>";
                                                        }
                                                    }
                                    
                                                    // Mock Test A
                                                    if (!empty($comp->mock_test_a)) {
                                                        if ($row->close_mock_a == 1) {
                                                            echo "<button class='btn btn-success action-btn' data-action='open_mock_a' data-centerid='{$row->center_id}'>Open Mock Paper</button><br><br>";
                                                        } else {
                                                            echo "<button class='btn btn-danger action-btn' data-action='close_mock_a' data-centerid='{$row->center_id}'>Close Mock Paper</button><br><br>";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php 
                                        $i++;
                                        } 
                                        ?>
                                        </tbody>
                                    </table>

						          
						      </div>  
						
						
							</fieldset>
							<button name='back' class='btn btn-success' value='' >Back To List</button>
						  <!--</form>-->
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
			
			
			
<?php include('footer.php'); ?>



<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

<!--<script>-->
<!--$(document).ready(function() {-->
<!--    $('.action-btn').click(function(e) {-->
<!--        e.preventDefault();-->
        
<!--        var action = $(this).data('action');-->
<!--        var centerId = $(this).data('centerid');-->

<!--        if (confirm('Are you sure you want to ' + action.replace('_', ' ') + '?')) {-->
<!--            $.ajax({-->
<!--                url: "https://marrs.in/franchiselogin/manage/competitionshedule/updateCenterStatus",-->
<!--                type: "POST",-->
<!--                data: {-->
<!--                    action: action,-->
<!--                    center_id: centerId-->
<!--                },-->
<!--                success: function(response) {-->
<!--                    alert('Action completed successfully.');-->
                    <!--location.reload(); // Reload page to update status-->
<!--                },-->
<!--                error: function() {-->
<!--                    alert('Something went wrong.');-->
<!--                }-->
<!--            });-->
<!--        }-->
<!--    });-->
<!--});-->
<!--</script>-->


<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>-->
<!--<script src="<?php echo VIEW_SCRIPT; ?>charisma.js"></script>-->

<!--<script>-->
<!--var csrfName = '<?= $this->security->get_csrf_token_name(); ?>';-->
<!--var csrfHash = '<?= $this->security->get_csrf_hash(); ?>';-->
<!--</script>-->

<script type="text/javascript">
    $(document).ready(function(){
        $('.action-btn').click(function() {
            var centerId = $(this).data('centerid');
            var action = $(this).data('action');
            
            $.ajax({
            url:"<?php echo base_url();?>manage/ajax/updateCenterStatus",
            data: {center_id: centerId,
                    action: action},
            type: 'post',
            
                success: function(response) {
                    console.log('Parsed response:', response);  
                
                    if (response.status === "success") {
                        alert('Updated successfully!');
                        location.reload();
                    } else {
                        alert('Failed: ' + response.message);
                    }
                },

                                
            });
        });
    });
</script>
