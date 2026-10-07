<?php include('header.php');
//print_r($stat);
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
							  
						                  <tr><th>Competition Price</th>
						                      <th>Study Materials</th>
						                      <th>Orientations</th>
						                      <th>Mock Test</th>
						                      </tr>
						              </thead>
						          
						          <?php 
						             
						          
						          ?>
						          <tr>
						            <td>
						                Rs.<br>
						               <input type='text' name='product_price' placeholder='<?php echo $stat['product_price'];?>'>
						                 
						            </td>
						            <td>
						                Material-A Rs. <input type='text' name='study_material_a_price' placeholder='<?php echo $stat['study_material_a_price']; ?>'><br>
						                Material-B Rs. <input type='text' name='study_material_b_price' placeholder='<?php echo $stat['study_material_b_price']; ?>'><br>
						                Material-C Rs. <input type='text' name='study_material_c_price' placeholder='<?php echo $stat['study_material_c_price']; ?>'>
						                
						            </td>
						            <td>
						               Orientation-A Rs. <input type='text' name='orientation_a_price' placeholder='<?php echo $stat['orientation_a_price']; ?>'><br>
						               Orientation-B Rs. <input type='text' name='orientation_b_price' placeholder='<?php echo $stat['orientation_b_price']; ?>'><br>
						               Orientation-C Rs. <input type='text' name='orientation_c_price' placeholder='<?php echo $stat['orientation_c_price']; ?>'>
						                
						            </td>
						            
						            <td> 
						                Mock Test Rs. <input type='text' name='mock_test_price' placeholder='<?php echo $stat['mock_test_price']; ?>'>
						                
						            </td>
						            </tr>
						            <tr>
						            <td>
						                <button class='btn btn-danger' name='submit' >Update</button>
						                 <button class='btn btn-warning' name='back' >Back</button>
						            </td>      
						            
						           
						          </tr>
						          
						          </table>
						      </div>  
						
						
							</fieldset>
							<!--<button name='back' class='btn btn-success' value='' >Back To List</button>-->
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