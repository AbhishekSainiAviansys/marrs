<link id="bs-css" href="<?php echo COMMON_VIEW_STYLE;?>bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo COMMON_VIEW_STYLE;?>bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo COMMON_VIEW_STYLE;?>charisma-app.css" rel="stylesheet">



			
				<?php echo $this->notifications->display_html();?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Album <?php echo ($albumID>0)?'Edit':'Add';?></h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
							<div class="page-header">
							  <h1><small>Basic Information</small></h1>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Album Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="albumName" name="albumName" type="text" value="<?php if( isset( $result['albumName'] ) )echo $result['albumName']; ?>" >
                       <span class="help-inline"><?php  $this->validation->show_error('albumName',"Please enter album name.") ?></span>							 
													
								</div>
							  </div>
							  
							  
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Album Desc</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="albumDesc" name="albumDesc" type="text" value="<?php if( isset( $result['albumDesc'] ) )echo $result['albumDesc']; ?>" >
                       <span class="help-inline"><?php  $this->validation->show_error('albumDesc',"Please enter album desc.") ?></span>							 
													
								</div>
							  </div>
							  
							  
							  
							  <div class="form-actions">
								 <input id='submit' class='btn btn-primary' onclick='return createAlbum();' type='submit' name='submit' <?php if($albumID>0) {?>value='Edit Album' <?php }else{ ?>value='Create Album'<?php } ?>></input>
													<button class='btn'>Cancel</button>			
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
      
	


<!-- The styles -->
	
