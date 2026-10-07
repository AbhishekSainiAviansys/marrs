<?php include('header.php');
//print_r($area);
?>
<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">CIN</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">Enquiry</a>
					</li>
				</ul>
			</div>
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> CIN-Enquiry</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
                  <?php if(isset($message) && !empty($message)){ ?>
                    <h4><?php echo $message; ?></h4>
                  <?php } ?>
						<table class="table table-bordered" width="100%">
						    <form method="POST" class="row g-3">
						       
                <div class="col-md-3">
                    <label class="form-label">Enquiry Start Date <span style="color:red;">*</span></label>
                    <input type="date" name="start_date" class="form-control" value='<?php if(isset($result['start_date'])){ echo $result['start_date'];} ?>' required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Enquiry End Date <span style="color:red;">*</span></label>
                    <input type="date" name="end_date" class="form-control" value='<?php if(isset($result['end_date'])){ echo $result['end_date'];} ?>' required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type <span style="color:red;">*</span></label>
                    <select name="enquiry_type" class="form-control" required>
                        <option value='All'>-- All Type --</option>
                        <option value='1' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==1){?> selected='selected' <?php } ?>>General Enquiry</option>
                        <option value='2' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==2){?> selected='selected' <?php } ?>>Registration/Admit Card Not Active</option>
                        <option value='3' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==3){?> selected='selected' <?php } ?>>Material Not Active</option>
                        <option value='4' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==4){?> selected='selected' <?php } ?>>Orientation Not Active</option>
                        <option value='5' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==5){?> selected='selected' <?php } ?>>Mock Paper Not Active</option>
                        <option value='6' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==6){?> selected='selected' <?php } ?>>Tech Team Support</option>
                        <option value='7' <?php if(isset($result['enquiry_type']) && $result['enquiry_type']==7){?> selected='selected' <?php } ?>>Combo Purchase Issue</option>
                    </select>    
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status <span style="color:red;">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value='All'>-- All Type --</option>
                        <option value='open' <?php if(isset($result['status']) && $result['status']=='Open'){?> selected='selected' <?php } ?>>Open</option>
                        <option value='Closed' <?php if(isset($result['status']) && $result['status']=='Closed'){?> selected='selected' <?php } ?>>Closed</option>
                    </select>    
                </div>
                <div class="col-md-3">
                    <input type="submit" name="submit" value="Search" class="btn btn-primary mt-4">
                </div>
            </form>
						   
						</table>
							 
					</div>
					<div class="box-content">
                  
						<table class="table table-bordered" width="100%">
						  <thead>
						      
							  <tr>
								  <th>SL No.</th>
								  <th>Student Name</th>
								  <th>Enquiry Type</th>
								  <th>Enquiry</th>
                                  <th>Evidence</th>
                                 
                                  <th>Status</th>
                                   <!--<th>Class</th>-->
                                  <th>Actions</th>
                                  <!--<th>Delete</th>-->
							  </tr>
						  </thead>   
						  <tbody>
						    <?php  if(!empty($cin_list)){
						    
						    ?>
						    <form method='POST'> 
							    <tr>
							        <input type='hidden' name='sch' value='<?php print_r($sch); ?>'>
							        <input type='hidden' name='cla' value='<?php print_r($cla) ?>'>
							        <input type="submit" name="export" value="export" class='btn btn-primary' />
							    </tr>
							</form>
							<?php } ?>
							<?php $i=1;foreach($registration_details as $value ) { 
				// 			print_r($value);
							?>
							
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['student_name']; ?></td>
                                  <td><?php echo $value['enquiry_name']; ?></td>
								    <td><?php echo $value['enquiry']; ?></td>
                                    <td>
                                        <?php if(!empty($value['evidence'])){ ?>
                                        <img src="https://marrs.in/student_registration/images/evidence/<?php echo $value['evidence']; ?>" style='height:200px;width:150px;'>
                                        <?php } ?>
                                    </td>
                                    <td >
								<?php echo $value['status']; ?>
								</td>
                                  <!--<td><?php echo $value['class']; ?></td>-->
                                 
								<!--<td class="center">-->
								
								<!--	<a class="btn btn-info" href="" title="Edit">-->
								<!--		Edit                              -->
								<!--	</a>-->
								<!--</td>-->
								
								<td class="center">
								    <?php if($value['status']=='Open'){?>
                                        <form method="POST">
                                            <input type='hidden' name='enquiry_id' value='<?php echo $value['enquiry_id']; ?>' >
                                            <input type='text' name='reply' placeholder='Enter Reply' class="form-control" required>
                                            <input type='submit' name='status' class='btn btn-warning mt-2' value="Close" >
                                        </form>
                                        <?php }else{ ?>
                                            Closed
                                        <?php } ?>	
								</td>
								
							</tr>
						<?php $i++; } ?>	
						
						   
						  </tbody>
					  </table> 
					
					<div class="pagination pagination-left">
						 <ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
					</div>
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
    $("#area_code").change(function(){
    var area_code =this.value;
    //  alert('area_code');
        // var BASE_URL="https://marrs.in/franchiselogin/";
        $.ajax({
        url:"<?php echo base_url();?>franchise/ajax/school_list",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
        
        }});
    });
</script>


<?php include('footer.php');?>