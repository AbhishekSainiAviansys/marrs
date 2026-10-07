<?php include('header.php');
echo'<pre>';
print_r($list);
echo'<pre>';
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>blog/">Events</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> View Post</h2>
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
							  <h1><small>Post </small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Title </label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="postTitle" name="postTitle" type="text" value="<?php if( isset( $list[0]['postTitle'] ) ) { echo $list[0]['postTitle']; } ?>" >
								</div>
							  </div>
							 
							 
							 <div class="control-group">
							  <label class="control-label" for="post">Post</label>
							  <div class="controls">
								<textarea class="cleditor" id="post" rows="6" ><?php if( isset( $list[0]['post'] ) ) { echo $list[0]['post']; } ?></textarea>
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="content">Status</label>
							  <div class="controls">
							<select class="span2" name="postStatus">
									<option value="Publish" <?php if( isset( $list[0]['postStatus'] ) ) { if($list[0]['postStatus'] == 'Publish') { ?>selected="selected" <?php } }?> >Publish</option>
									<option value="Draft" <?php if( isset( $list[0]['postStatus'] ) ) { if($list[0]['postStatus'] == 'Draft') { ?>selected="selected" <?php } }?> >Draft</option>
								  </select>
							  </div>
							</div>							

							  <div class="form-actions">
								<?php  ?><button type="submit" class="btn btn-primary">Save changes</button><?php  ?>
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
