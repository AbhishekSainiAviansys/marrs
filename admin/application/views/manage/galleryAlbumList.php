<?php include('header.php'); ?>
<?php echo $this->notifications->display_html();?> 


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL;?>gallery">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL;?>gallery">Albums</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="javascript:void(0)">Photos</a> 
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
					<div class="box-content">
						<p class="center">
							<a id="uploadImage"  href="<?php echo SITE_URL;?>/gallery/multipleUpload/album_id/<?php echo $albumID;?>" class="btn btn-large btn-primary">Upload New Image</a>
						</p>
						<table class="table table-bordered">
						  <thead>
							  <tr>
								  <th>Image Icon</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php 
						  $fileTypes	=	array('jpg','png','gif');
						  foreach($images as $key=>$image){ 
							if(in_array(end(explode('.',$image)),$fileTypes)){
						  ?>
							<tr>
								<td><a class="thumbnails" href="<?php echo $sitepath.$image;?>"><img src="<?php echo $sitepath.$image;?>" height="50" width="50">	</a></td>
								<td>
									<a class="delete btn btn-danger" href="<?php echo SITE_URL?>gallery/removeImage/key/<?php echo $image; ?>/<?php echo $albumID; ?>/" title="Delete">
										<i class="icon-trash icon-white"></i> 
										
									</a></td>
							</tr>
							<?php 
								}
							}
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
	
		<script>
			$(document).ready(function(){
				$("#uploadImage,.thumbnails").colorbox({
					iframe:true, 
					width:"80%", 
					height:"90%",
					onClosed:function(){
						parent.location.reload();
					}
					});
			});
			
		</script>	