<?php include('header.php'); ?>
<?php echo $this->notifications->display_html();?> 
		<script>
	$(document).ready(function(){
		$("#create_album,.editAlbum").colorbox({iframe:true, width:"80%", height:"90%"});
	});		
		</script>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL;?>gallery">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL;?>gallery">Albums</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i> Gallery</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<br/><br/>
					<p class="center">
						<a id="create_album"  href="<?php echo SITE_URL;?>gallery/addAlbum" class="btn btn-large btn-primary">Add New Album</a>
					</p>
					<div class="box-content">
					
						<table class="table table-bordered">
						  <thead>
							  <tr>
								 
								  <th>Sl</th>
								  <th>Album Name</th>
								  <th>Album Desc</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($result as $key=>$album){ ?>
							<tr>
								<td><?php echo  $key+1;?></td>
								<td>	<a href=" <?php echo SITE_URL;?>gallery/albumList/album_id/<?php echo $album['albumID'];?> " ><?php echo  $album['albumName'];?></a></td>
								<td><?php echo  $album['albumDesc'];?></td>
								<td><a class="btn btn-info editAlbum" href="<?php echo SITE_URL?>gallery/editAlbum/id/<?php echo $album['albumID']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
										                                            
									</a>
									<a class="delete btn btn-danger" href="<?php echo SITE_URL?>gallery/removeAlbum/id/<?php echo $album['albumID']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a></td>
							</tr>
							<?php }
							?>
						</tbody>
						</table>
					</div>		
					
				</div><!--/span-->
			
			</div><!--/row-->
			
	
<?php include('footer.php'); ?>		
<?php 
	$this->confirmation->confirm('delete');
?>