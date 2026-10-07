<?php include('header.php'); ?>


			


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>school/">CSV Upload</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>result/import ?>/"><?php echo ($studentID>0)?'Edit':'';?></a>
					</li>
				</ul>
			</div>
				<?php echo $this->notifications->display_html();?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> CSV Upload <?php echo ($studentID>0)?'Edit':'Add';?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<form  method="post" enctype="multipart/form-data">
			<label for="file">Upload Csv File:</label>
			<input type="file" name="file" id="file"><br>
			<input type="submit" name="Filesubmit" value="Submit">
			</form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
      
			

<?php include('footer.php'); ?>