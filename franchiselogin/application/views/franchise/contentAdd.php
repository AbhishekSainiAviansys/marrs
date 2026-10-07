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
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Title</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="contentTitle" name="contentTitle" type="text" value="<?php if( isset( $list['contentTitle'] ) ) { echo $list['contentTitle']; } ?>" >
								    <span class="help-inline"><?php  $this->validation->show_error('contentTitle',"Please enter the Title.") ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Content Key</label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="contentKey" name="contentKey" type="text" value="<?php if( isset( $list['contentKey'] ) ) { echo $list['contentKey']; } ?>" >
								    <span class="help-inline"><?php  $this->validation->show_error('contentKey',"Please enter the Key/Already Existed.") ?></span>
								</div>
							  </div>
							 <div class="control-group">
							  <label class="control-label" for="content">Content</label>
							  <div class="controls">
								<textarea class="cleditor" id="content" name="content" rows="6"><?php if( isset( $list['content'] ) ) { echo $list['content']; } ?>"</textarea>
								 <span class="help-inline"><?php  $this->validation->show_error('content',"Please enter the Content.") ?></span>
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="content">Status</label>
							  <div class="controls">
						
                    <?php if( $list['contentStatus'] != 'Default' ) { ?>						
							<select class="span2" name="contentStatus" id="contentStatus">
									<option value="Publish" <?php if( isset( $list['contentStatus'] ) ) { if($list['contentStatus'] == 'Publish') { ?>selected="selected" <?php } }?> >Publish</option>
									<option value="Draft" <?php if( isset( $list['contentStatus'] ) ) { if($list['contentStatus'] == 'Draft') { ?>selected="selected" <?php } }?> >Draft</option>
									<option value="Deleted" <?php if( isset( $list['contentStatus'] ) ) { if($list['contentStatus'] == 'Deleted') { ?>selected="selected" <?php } }?> >Deleted</option>
							</select>
							 <span class="help-inline"><?php  $this->validation->show_error('contentStatus',"Please select the Status.") ?></span>
					<?php } else
                            {?>
							   <select class="span2" name="contentStatus" id="contentStatus">
							     <option value="Default" >Default</option>
							   </select>
							<?php } ?>					
							  </div>
							</div>
							 
							<hr>
											 
                        <?php if( isset( $mode ) ) {
                              if( $mode == 'Edit' or $mode == 'Add') { ?>
							  <div class="form-actions">
								<button type="submit" id="submit" name="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
						<?php }} ?>	  
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js" type="text/javascript"></script>
			<script>
			  $(document).ready(function(){
				$("#contentTitle").blur(function(){
					if($("#contentTitle").val() != '')
					 {
					   $("#contentKey").val( $("#contentTitle").val().replace(/[^a-zA-Z0-9]+/,'_') );
					 }
				 });
					       });
			</script>
			
<?php include('footer.php'); ?>
