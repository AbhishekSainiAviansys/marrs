<?php include('header.php');
///echo'<pre>';
//print_r($registration_details);

//echo "cin".$list['cin'];
//echo'<pre>';

?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>registration/">View</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> View Registration Deatails</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
                    
<!--******************************START DIV FOR SHOW DATA*********************************************-->     
               
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
                                        <div class="page-header"><h1><small>Registration View </small></h1></div>
                                        <div class="control-group">
                                                 <label class="control-label" for="focusedInput">CIN </label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['cin']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->    
                                              
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Name </label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['first_name'].
												           $registration_details['middle_name'].$registration_details['last_name']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Competition Level </label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['competition_level_key']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        <?php
										if(isset($registration_details['permenent_registration_number']) ||($registration_details['temperory_registration_number'] ))
										{
										?>
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Permanent Registration Number </label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['permenent_registration_number']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Temporary Registration Number </label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['temperory_registration_number']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        <?php } ?>
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Competition Center</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['center_name']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Competition Date</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['competition_date']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Reporting Time</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['reporting_time']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        <?php
                             if(isset($registration_details['receipt_number']) && ($registration_details['branch_name'])&& ($registration_details['receipt_date'] ))
										{
										?>
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Reciept Number</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['receipt_number']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Branch Name</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['branch_name']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                        
                                        
                                        <div class="control-group">
                                                  <label class="control-label" for="focusedInput">Reciept Date</label>
                                                  <div class="controls">
                                                  <strong><?php echo $registration_details['receipt_date']; ?></strong>     
                                                  </div> <!--<!--END OF div class="controls" -->
                                        </div><!--<!--END OF DIV class="control-group"" -->
                                      <?php } ?>  
                                        
							</fieldset>
						  </form>
					</div> <!--<!--END OF DIv class="box-content" -->
                    
                    
                    
                    
<!--********************************END  DIV FOR SHOW DATA****************************************************-->
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
