<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>events/">Posts</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>events/<?php echo ($eventID>0)?'edit':'add';?>/"><?php echo ($eventID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
	
			<div class="row-fluid sortable">
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Events <?php echo ($eventID>0)?'Edit':'Add';?></h2>
						
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
							  <h1><small>Events Information</small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Title </label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="eventTitle" name="eventTitle" type="text" value="<?php if( isset( $list['eventTitle'] ) ) { echo $list['eventTitle']; } ?>" >
								   <span class="help-inline"><?php  $this->validation->show_error('eventTitle',"Please enter the Title.") ?></span>
								</div>
							  </div>
							   <div class="control-group">
							  <label class="control-label" for="eventDate">Event Date</label>
							  <div class="controls">
								<input type="text" class="input-medium datepicker" id="eventDate" name="eventDate" value="<?php if( isset( $list['eventDate'] ) ) { echo $list['eventDate']; } ?>"  >
								<span class="help-inline"><?php  $this->validation->show_error('eventDate',"Please enter the Date.") ?></span>
							  </div>
							</div>
							 
							 <div class="control-group">
							  <label class="control-label" for="event">event</label>
							  <div class="controls">
								<textarea class="cleditor" id="event" name="event" rows="6"><?php if( isset( $list['event'] ) ) { echo $list['event']; } ?> </textarea>
								<span class="help-inline"><?php  $this->validation->show_error('event',"Please enter the Events.") ?></span>
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="content">Status</label>
							  <div class="controls">
							      <select class="span2" name="eventStatus" id="eventStatus">
									<option value="Publish" <?php if( isset( $list['eventStatus'] ) ) { if($list['eventStatus'] == 'Publish') { ?>selected="selected" <?php } }?> >Publish</option>
									<option value="Draft" <?php if( isset( $list['eventStatus'] ) ) { if($list['eventStatus'] == 'Draft') { ?>selected="selected" <?php } }?> >Draft</option>
									<option value="Deleted" <?php if( isset( $list['eventStatus'] ) ) { if($list['eventStatus'] == 'Deleted') { ?>selected="selected" <?php } }?> >Deleted</option>
								  </select>
								  <span class="help-inline"><?php  $this->validation->show_error('eventStatus',"Please select the status.") ?></span>
							  </div>
							</div>
							  <div class="control-group">
							  <label class="control-label" for="date02">Display Within</label>
							  <div class="controls">
								<input type="text" class="input-medium datepicker" id="displayFromDate" name="displayFromDate" value="<?php if( isset( $list['displayFromDate'] ) ) { echo $list['displayFromDate']; } ?>"  >
							    <input type="text" class="input-medium datepicker" id="displayToDate" name="displayToDate" value="<?php if( isset( $list['displayToDate'] ) ) { echo $list['displayToDate']; } ?>"  >
								 <span class="help-inline"><?php  $this->validation->show_error('displayFromDate',"Please select the From Date.") ?></span>
								 <span class="help-inline"><?php  $this->validation->show_error('displayToDate',"Please select the To Date.") ?></span>
							  </div>
							</div>
							
							 <div class="control-group">
							  <label class="control-label">Inform parents through mail</label>
							  <div class="controls">
								<input type="checkbox" name="informParents" id="informParents" value="Yes">Yes<br>
							  </div>
							</div>

							 <?php if($mode=='View') { ?>
							<div class="form-actions">
							<a class="btn" href="<?php echo SITE_URL?>events/edit/id/<?php echo $list['eventID']?>"/>Edit</a>
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
