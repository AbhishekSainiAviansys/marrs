<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>subscription/">Subscriber</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>subscription/<?php echo ($subscriptionID>0)?'edit':'add';?>/"><?php echo ($subscriptionID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Subscription <?php echo ($subscriptionID>0)?'Edit':'Add';?></h2>
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
							  <h1><small>Subscription Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="subscriptionTitle" name="subscriptionTitle" type="text" >
								</div>
							  </div>
							
							 <div class="control-group">
							  <label class="control-label" for="subscriptionContent">Content</label>
							  <div class="controls">
								<textarea class="cleditor" id="subscriptionContent" rows="6"></textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="content">Category</label>
							  <div class="controls">
							<select class="span2" name="categoryID">
									<option value="cat1">Cat1</option>
									<option value="cat2">Cat2</option>
								  </select>
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="content">Status</label>
							  <div class="controls">
							<select class="span2" name="subscriptionStatus">
									<option value="">Active</option>
									<option value="">Draft</option>
								  </select>
							  </div>
							</div>
							 
							<hr>
											 

							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
