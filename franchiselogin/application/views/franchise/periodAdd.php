<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Period</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
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
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Period Name</label>
								<div class="controls">
								  <input class="input-large focused" id="period_name" name="period_name" type="text" value="<?php if( isset( $result['period_name'] ) )echo $result['period_name']; ?>" >
	                <span class="help-inline"><?php  $this->validation->show_error('period_name',"Please enter the Name.") ?></span>							
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Period Year</label>
								<div class="controls">
								  <input class="input-large focused" id="period_year" name="period_year" type="text" value="<?php if( isset( $result['period_year'] ) )echo $result['period_year']; ?>" >
	                <span class="help-inline"><?php  $this->validation->show_error('period_year',"Please enter the Year.") ?></span>							
								</div>
							  </div>
							<div class="form-actions">
								<input type="submit" class="btn btn-primary" value="submit" id="submit" name="submit"/>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
<?php include('footer.php'); ?>