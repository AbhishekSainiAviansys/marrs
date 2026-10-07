<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Delete CIN</a> <span class="divider">/</span>
					</li>
					<li>
							<!--<a href="<?php echo SITE_URL?>content/">List</a>-->
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Delete</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<form method="POST">
							<fieldset>
    							<table  cellpadding="5px" >
    				                <tr>
    				    
                     
                				        <td>Enter CIN:
                						    <input type='input' name='cin' <?php if(isset($result)){?>placeholder='<?php echo $result['cin'];?>' <?php }else{?>placeholder='Enter CIN' <?php } ?>>
                					    
                					    </td>
                					    
                					    <td>
                					        <input type='submit' name='submit' class='btn btn-primary' >
                					    </td>
                					</tr>
                				</table>	
						    </fieldset>
						</form>
						<div class="box-content">
					
						<?php if(empty($student)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No CIN with <?php if(isset($result)){echo $result['cin'];} ?>.
					</div>
					<?php
					}
					else{
					
					?>
					
                           
                           
                        
					<!--<table id="paymentTable" class="table table-bordered">-->
					   
					    
                    <table  class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Student Name</th>
                            
                                <th>CIN</th>
                                <th>School Name</th>
                                <th>Class</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <form method="POST">
                            <?php
                           $i=1;
                            foreach ($student as $value) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value->student_name; ?></td>
                               
                                <td><?php echo $value->cin; ?></td>
                                <td><?php 
                                if(!empty($value->school_name)){
                                    echo $value->school_name; 
                                }else{
                                    $school = $this->db->get_where('school_new',array('is'=>$value->school_id))->row();
                                    echo $school->school_name;
                                }
                                
                                ?></td>
                                <td><?php echo $value->class; ?></td>
                                <td><?php echo $value->stud_email; ?></td>
                                <td><?php echo $value->stud_phone; ?></td>
                                
                                <td>
                                    <button type='submit' name='delete' class='btn btn-warning' value='<?php echo $value->id; ?>'>Delete</button>
                                    
                                </td>
                            </tr>
                            <?php
                                $i++;
                            }
                            ?>
                           </form>
                        </tbody>
                        
                    </table>

					  
					  
					  
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
    
    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">-->
    <script>
        function copyToClipboard(element) {
            // Create a temporary input element
            let tempInput = document.createElement("input");
            tempInput.value = element.getAttribute("data-copy");
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Change button text to indicate copying
            element.innerText = "Copied!";
            setTimeout(() => { element.innerText = "Copy"; }, 1500);
        }
    </script>
    
<?php 
	$this->confirmation->confirm('delete');
?>