<?php include('header.php'); ?>
<!--<script src="<?php //echo VIEW_SCRIPT;?>jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php //echo VIEW_SCRIPT;?>/jquery-ui-1.8.21.custom.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#create_album").colorbox({iframe:true, width:"80%", height:"90%"});
	});
	
	$(document).ready(function(){
		$(".gallery-controls .icon-remove").live('click',function(){
			var albumID	=	$(this).closest('li').attr('id'); 
			$.ajax({
                    type: "POST",
                    url: "<?php echo SITE_URL?>gallery/removeAlbum",
                    data: 'album_id='+albumID+'&ajax=remove_album',
                    cache: true,
					beforeSend: function(){
							//$("#div_hid"+exam_id).html('<img src="<?php echo VIEW_IMAGE;?>loading.gif" width="24" height="24" border="0">');	 
						},
                    success: function(html)
                    {   	
                        if(html == true)
						{
							window.location.reload();
						}
					}
            });
			
		});
	
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
					<br/>
					<div class="box-content">
						<?php 
						$tble	=	"";
						/*$tble	=	'<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table11">';
						$tble	.=	'<tr>
										<td colspan="2">
											<input type="hidden" id="hid_val" name="hid_val" value=""/>*/
						$tble	.=		'<ul class="thumbnails gallery">';
												if(count($result) > 0)
												{
													for($i=0;$i<count($result);$i++)
													{
														$tble	.=	'<li class="albumthumbnails" id="'.$result[$i]['albumID'].'">
																		<a href="'.SITE_URL.'gallery/albumList/album_id/'.$result[$i]['albumID'].' " >
																			'.$result[$i]['albumName'].'<img src="'.VIEW_IMAGE.'logo20.png" width="20" height="30" alt="" />
																		</a>
																	</li>';
														/*if($i != 0)
														{
															if($i % 4 == 0)
																$tble	.= '<br/><br/>';
														}*/	
													}
												}
						$tble	.=			'</ul>';	
						/*				</td>
									</tr>';			
						$tble	.=	'</table>'; */
						echo $tble;
						?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
	<style>	
	.albumthumbnails > li {
margin-left: 15px;
}
	.albumthumbnails > li {
float: left;
margin-bottom: 18px;
margin-left: 20px;
}
.albumthumbnails {
background-color: white;
z-index: 2;
position: relative;
margin-bottom: 40px !important;	
}
.albumthumbnails {
display: block;
padding: 4px;
line-height: 1;
border: 1px solid #ddd;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
-moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075);
}
.albumthumbnails img, .albumthumbnails > a {
z-index: 2;
height: 100px;
width: 100px;
position: relative;
display: block;
}
.albumthumbnails .gallery-controls {
position: absolute;
z-index: 1;
margin-top: -30px;
height: 22px;
min-height: 22px;
width: 80px;
padding: 9px;
}
</style>		
<?php include('footer.php'); ?>		
