<?php include('header.php');

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
							  
						                  <tr><th>CIN</th>
						                      <th>Student Name</th>
						                      <th>Class </th>
						                      <th>Father Name</th>
						                      </tr>
						              </thead>
						          
						          <?php 
						             
						          
						          ?>
						          <tr>
						            <td>
						                <?php echo $student['cin'];?>
						            </td>
						            <td>
						                <input type='text' name='student_name' placeholder='<?php echo $student['student_name']; ?>'>
						                
						            </td>
						            <td>
						               <!--<input type='text' name='center_address' placeholder='<?php echo $student['center_address']; ?>' >-->
						               <select name='class' >
						                   <option value='Nursery'>Nursery</option>
						                    <option value='LKG'>LKG</option>
						                     <option value='UKG'>UKG</option>
						                      <option value='Class-1'>Class-1</option>
						                       <option value='Class-2'>Class-2</option>
						                        <option value='Class-3'>Class-3</option>
						                         <option value='Class-4'>Class-4</option>
						                          <option value='Class-5'>Class-5</option>
						                           <option value='Class-6'>Class-6</option>
						                            <option value='Class-7'>Class-7</option>
						                             <option value='Class-8'>Class-8</option>
						                              <option value='Class-9'>Class-9</option>
						                               <option value='Class-10'>Class-10</option>
						                                <option value='Class-11'>Class-11</option>
						                                 <option value='Class-12'>Class-12</option>
						               </select>
						            </td>
						            
						            <td> 
						                <input type='text' name='father_name' value='<?php echo $student['father_name'];?>' >
						            </td>
						            </tr>
						            <thead>
						                <tr>
						                      <th>Mother Name</th>
						                      <th>Gender</th>
						                      <th>Mobile</th>
						                      <th>Eamil</th>
						                  </tr>
						            </thead>
						            <tr>
						            <td>
						                <input type='text' name='mother_name' placeholder='<?php echo $student['mother_name']; ?>' >
						            </td>
						            <td>
						                <select name='gender'>
						                    <option value='Male'>Male</option>
						                    <option value='Female'>Female</option>
						                </select>
						            </td>
						            <td>
						                <input type='text' name='stud_phone' placeholder='<?php echo $student['stud_phone']; ?>' >
						            </td>
						            <td>
						                <input type='email' name='stud_email' placeholder='<?php echo $student['stud_email']; ?>' >
						            </td>
						            </tr><tr>
						            <td>
						                <button class='btn btn-danger' name='submit' >Update</button>
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