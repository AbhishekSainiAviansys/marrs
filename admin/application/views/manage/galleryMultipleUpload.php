<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image upload</title>
<link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
<script type="text/javascript">
var imagePath='<?php echo VIEW_IMAGE?>';
</script>
<!-- jQuery -->
<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery-1.7.2.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery-ui-1.8.21.custom.min.js"></script>
<script src="<?php echo VIEW_SCRIPT;?>multiupload.js"></script>
<script type="text/javascript">
var config = {
	support : "image/jpg,image/png,image/bmp,image/jpeg,image/gif",		// Valid file formats
	form: "demoFiler",					// Form ID
	dragArea: "dragAndDropFiles",		// Upload Area ID
	//uploadUrl: "upload.php?album_name=<?php echo $albumName; ?>"				// Server side upload url
	uploadUrl: "<?php echo SITE_URL?>gallery/multipleUpload/albumID/<?php echo $albumID; ?>",				// Server side upload url
}
$(document).ready(function(){
	initMultiUploader(config);
});
</script>
<link href="<?php echo VIEW_STYLE;?>style.css" type="text/css" rel="stylesheet" />
</head>
<body lang="en">
<center><h1 class="title">Multiple Drag and Drop Image Upload For <?php echo $albumName; ?></h1></center>
<div id="dragAndDropFiles" class="uploadArea">
	<h1>Drop Images Here</h1>
</div>
<form name="demoFiler" id="demoFiler" enctype="multipart/form-data">
<input type="file" name="multiUpload" id="multiUpload" multiple />
<input type="hidden" name="album_name" id="album_name" value="<?php echo $albumName; ?>" />
<input type="submit" name="submitHandler" id="submitHandler" value="Upload" class="buttonUpload" />
</form>
<div class="progressBar">
	<div class="status"></div>
</div>
</body>
</html>