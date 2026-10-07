<?php //include('header.php'); ?>
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo VIEW_SCRIPT;?>/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">

</script>	
			
			<div class="clear"></div>
			<!-- start content-outer -->
			<div id="content-outer">
			<!-- start content -->
			<div id="content">


				<!--  start page-heading -->
				
				<div id="page-heading">
					<h1>Add Album</h1>
				</div>
				<!-- end page-heading -->
			 <?php echo $this->notifications->display_html();?> 
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
				<tr>
					<th rowspan="3" class="sized"><img src="<?php echo VIEW_IMAGE;?>shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
					<th class="topleft"></th>
					<td id="tbl-border-top">&nbsp;</td>
					<th class="topright"></th>
					<th rowspan="3" class="sized"><img src="<?php echo VIEW_IMAGE;?>shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
				</tr>
				<tr>
					<td id="tbl-border-left"></td>
					<td>
					<!--  start content-table-inner ...................................................................... START -->
					<div id="content-table-inner">
					
					<div class="search">
					</div>
					<br/>
					<br/>
					
						<form id="patternList" name="patternList" action="" method="POST">
						<!--  start table-content  -->
						<div id="table-content">
							<!--  start product-table ..................................................................................... -->
							<?php 
							
							$tble	=	"<table align='center' id='product-table' bgcolor='gray'>
											<tr>
												<th>Album Name</th>
												<td>
													<input type='text' name='album_name' id='album_name' value='' maxlength='100' size='50'  />			
												</td>
											</tr>	
											<tr>
												<th>Album Desc</th>
												<td>
													<input type='text' name='album_desc' id='album_desc' value='' maxlength='100' size='50'  />			
												</td>
											</tr>
											<tr>
												<td colspan='2'>
													<input id='submit' class='btn btn-primary' onclick='return createAlbum();' type='submit' name='submit' value='Create Album'></input>
													<button class='btn'>Cancel</button>
												</td>	
											</tr>	
										</table>";
							echo $tble;exit;
							?>
							<!--  end product-table................................... --> 
							
						</div>
						</form>					
												
						<div class="clear"></div>
					 
					</div>
					<!--  end content-table-inner ............................................END  -->
					</td>
					<td id="tbl-border-right"></td>
				</tr>
				<tr>
					<th class="sized bottomleft"></th>
					<td id="tbl-border-bottom">&nbsp;</td>
					<th class="sized bottomright"></th>
				</tr>
				</table>
				<div class="clear">&nbsp;</div>

			</div>
			<!--  end content -->
			<div class="clear">&nbsp;</div>
			</diV>
		


		

		
<?php //include('footer.php'); ?>			