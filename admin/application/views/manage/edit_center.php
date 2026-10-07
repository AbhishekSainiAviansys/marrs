<?php include('header.php');
// echo 'ok';die;
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
						                      <th>Center Name</th>
						                      <th>Center Address</th>
						                      <th>Date</th>
						                      <th>Class - Time Ex( Class-1 - 8:00 PM / Class-2 - 9:00 AM )</th>
						                      <th>Action</th>
						                      
						                  </tr>
						              </thead>
						          
						          <?php 
						          
						          $row = $this->db->get_where('exam_centers',array('center_id'=>$id))->row_array();
						               
						          
						          ?>
						          <tr>
						            
						            <td>
						                <input type='text' name='center_name' placeholder='<?php echo $row['center_name']; ?>'>
						                
						            </td>
						            <td>
						               <input type='text' name='center_address' placeholder='<?php echo $row['center_address']; ?>' >
						            </td>
						            <td> 
						                <input type='date' name='exam_date' value='<?php echo $row['exam_date'];?>' >
						            </td>
						            <td>
						                <input type='text' name='exam_time' placeholder='<?php echo $row['exam_time']; ?>' >
						            </td>
						            <td>
						                <button class='btn btn-danger' name='submit' >Update</button>
						            </td>      
						            
						           
						          </tr>
						          
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