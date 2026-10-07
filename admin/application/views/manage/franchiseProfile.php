<?php include('header.php'); //print_r($franchise); die;?>
		<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>profile/">Profile</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/show/">Show</a>
					</li>
				</ul>
			</div>
			
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Franchise Profile Details</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal">
							<fieldset>
                            
                            <div class="page-header">
							  <h1><small>Personal Information</small></h1>
							</div>
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Product Name :</label>
								<div class="controls">
								  <?php echo $franchise[0]['productname']; ?>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Request Type :</label>
								<div class="controls">
								  <?php echo $franchise[0]['requesttype']; ?>
								</div>
							  </div>
                               <div class="control-group">
								<label class="control-label" for="focusedInput">Frcode :</label>
								<div class="controls">
								  <?php echo $franchise[0]['frcode']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">File :</label>
								<div class="controls">
								  <?php echo $franchise[0]['file']; ?>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">File Name :</label>
								<div class="controls">
								  <?php echo $franchise[0]['file_name']; ?>
								</div>
							  </div>
                          
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Status :</label>
								<div class="controls">
								  <?php echo $franchise[0]['status']; ?>
								</div>
                                </div>
                            
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>