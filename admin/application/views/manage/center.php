<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 

//print_r($arr);
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
						                      <th>Center Addree</th>
						                      <th>Date</th>
						                      <th>Class - Time Ex( Class-1 - 8:00 PM / Class-2 - 9:00 AM )</th>
						                      <th>Delete</th>
						                      <th>Edit</th>
						                      
						                  </tr>
						              </thead>
						          
						          <?php 
						          
						          $stat = $this->db->get_where('exam_centers',array('comp_id'=>$id))->result_array();
						               
						          $i=1;
						          foreach($stat as $row){?>
						          <tr>
						            <td><?php echo $i; ?></td>
						            <td><?php echo $row['center_name']; ?></td>
						            <td>
						                <?php
						            echo $row['center_address'];
						            ?>
						            </td>
						            <td><?php
						            echo $row['exam_date'];
						            ?></td>
						            <td>
						                <?php
						            echo $row['exam_time'];
						            ?>
						            </td>
						            <td>
						                <button class='btn btn-danger' name='delete' value='<?php echo $row['center_id'];?>' >Delete</button>
						            </td>      
						            <td>
						               <button name='edit' class='btn btn-primary' value='<?php echo $row['center_id'];?>' >Edit</button>
						            </td>
						           
						          </tr>
						          <?php 
						          $i=$i+1;
						          } ?>
						          </table>
						      </div>  
						
						
							</fieldset>
							<button name='back' class='btn btn-success' value='' >Back To List</button>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->

 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>