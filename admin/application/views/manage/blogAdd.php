<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>blog/">Events</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'add';?>/"><?php echo ($blogID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Posts <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
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
							  <h1><small>Post</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Title </label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="postTitle" name="postTitle" type="text" value="<?php if( isset( $list['postTitle'] ) ) { echo $list['postTitle']; } ?>" >
								  <span class="help-inline"><?php  $this->validation->show_error('postTitle',"Please enter the Title.") ?></span>
								  
								</div>
							  </div>
							 
							 
							 <div class="control-group">
							  <label class="control-label" for="post">Post</label>
							  <div class="controls">
								<textarea class="cleditor" id="post" name="post" rows="6"><?php if( isset( $list['post'] ) ) { echo $list['post']; } ?></textarea>
								  <span class="help-inline"><?php  $this->validation->show_error('post',"Please enter the Post.") ?></span>
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="content">Status</label>
							  <div class="controls">
							      <select class="span2" name="postStatus">
									<option value="Publish" <?php if( isset( $list['postStatus'] ) ) { if($list['postStatus'] == 'Publish') { ?>selected="selected" <?php } }?> >Publish</option>
									<option value="Draft" <?php if( isset( $list['postStatus'] ) ) { if($list['postStatus'] == 'Draft') { ?>selected="selected" <?php } }?> >Draft</option>
								  </select>
								  <span class="help-inline"><?php  $this->validation->show_error('postStatus',"Please select the Status.") ?></span>
							  </div>
							</div>
							<?php if($mode=='View') { ?>
							<div class="form-actions">
							<a class="btn" href="<?php echo SITE_URL?>blog/edit/id/<?php echo $list['postID']?>"/>Edit</a>
							 </div>
							<?php } else { ?>
							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							  <?php } ?>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
