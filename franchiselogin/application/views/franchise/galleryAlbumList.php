<?php include('header.php'); ?>


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
						<input type="hidden" name="album_id" id="album_id" value="<?php echo $albumID; ?>" />
						<br/>
						
						<ul class="thumbnails gallery">
							<?php 
							$fileTypes	=	array('jpg','png','gif');
							foreach($images as $key=>$image){ 
							if(in_array(end(explode('.',$image)),$fileTypes)){?>
							<li id="image-<?php echo $key ?>" class="thumbnail" name="<?php echo $image; ?>">
								<a id="<?php echo $image; ?>" style="background:url(<?php echo $sitepath.$image;?>)" title=" Image <?php echo $key ?>" href="<?php echo $sitepath.$image;?>"><img class="grayscale" src="<?php echo $sitepath.$image;?>" alt=" Image <?php echo $key ?>"></a>
							</li>
							
							<?php 
							}
							} ?>
						</ul>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    <script>
	$(document).ready(function(){
		$(".gallery-controls .icon-remove").live('click',function(){
			//console.log($(this).closest('li').attr('name'));
			var imageName	=	$(this).closest('li').attr('name'); 
			var album_id	=	$("#album_id").val();
			
			
			$.ajax({
                    type: "POST",
                    url: "<?php echo SITE_URL?>gallery/removeImage",
                    data: 'album_id='+album_id+'&image_name='+imageName+'&ajax=remove_image',
                    cache: true,
					beforeSend: function(){
							//$("#div_hid"+exam_id).html('<img src="<?php echo VIEW_IMAGE;?>loading.gif" width="24" height="24" border="0">');	 
						},
                    success: function(html)
                    {   
                        if(html == true)
						{
						}
					}
            });
			
		})
	
	})
	</script>
<?php include('footer.php'); ?>
	
		<script>
			$(document).ready(function(){
				$("#uploadImage").colorbox({
					iframe:true, 
					width:"80%", 
					height:"90%",
					onClosed:function(){
						parent.location.reload();
					}
					});
			});
			
		</script>	