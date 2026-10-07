<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>content/<?php echo ($contentID>0)?'edit':'add';?>/"><?php echo ($contentID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Content <?php echo ($contentID>0)?'Edit':'Add';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
							
				
					<div class="box-content">
						<form class="form-horizontal" method="POST">
							<fieldset>
							<div class="page-header">
							  <h1><small>Content Information</small></h1>
							  
							</div>
							
							 
							   <?php //if(!empty($status)){?>
						<div class="page-header">
					
				
				 <h2 align="center"> <?php //echo $status; ?></h2>
					
					
							</div>
						<?php 	//}
					 ?>
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Old Password</label>
								<div class="controls">
								  <input class="input-large focused" id="opassword" name="opassword" type="password" value="<?php if( isset( $list['opassword'] ) ) { echo $list['opassword']; } ?>" >
								    <span class="help-inline"><?php  $this->validation->show_error('opassword',"Please enter the oldpassword.") ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Password</label>
								<div class="controls">
								  <input class="input-large focused" id="npassword" name="npassword" type="password" value="<?php if( isset( $list['npassword'] ) ) { echo $list['npassword']; } ?>" >
								    <span class="help-inline"><?php  $this->validation->show_error('npassword',"Please enter the new password more than 5 charecter is required.") ?></span>
								</div>
							  </div>
                     <div class="control-group">
								<label class="control-label" for="focusedInput">Conform Password</label>
								<div class="controls">
								  <input class="input-large focused" id="cpassword" name="cpassword" type="password" value="<?php if( isset( $list['cpassword'] ) ) { echo $list['cpassword']; } ?>" >
								    <span class="help-inline"><?php  $this->validation->show_error('cpassword',"Please enter conform password || password does not match.") ?></span>
								</div>
							  </div>
						 
							  		
							<hr>
														  <div class="form-actions">
								<button type="submit" id="submit" name="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
					
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
<?php include('footer.php'); ?>
