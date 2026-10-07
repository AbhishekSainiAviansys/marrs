<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
						<?php echo $this->notifications->display_html();?> 
						<?php //print_r($result); ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Student <?php echo ($studentID>0)?'Edit':'Add';?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
							<div class="page-header">
							  <h1><small>Basic Information</small></h1>
							</div>
							
							   
							 <div class="control-group">
								<label class="control-label">Student Photo</label>
								<div class="controls">
								  <div class="uploader" id="uniform-undefined"><input type="file" name="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose Image</span></div>
									<!--<div><?php if(isset($studentID) && $studentID != "a"){ ?><img src="<?php echo BASE_URL.$result['photo']; ?>" width="50" height="60"/><?php } ?></div>-->
		 <span class="help-inline"><?php  $this->validation->show_error('photo',"Choose  photo.") ?></span>								
								</div>
							  </div>							  					  
                    		  <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit" >
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
			

<?php include('footer.php'); ?>
