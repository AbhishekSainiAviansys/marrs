<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

<style>
  .container1 {
  /*width: 100%;*/
  /*max-width: 960px; */
  margin: 0 auto;
  background-color:#348ccd;
}

.row {
  display: flex;
    justify-content: space-between;
    background-color:#348ccd;
    margin-top:10px;
}

.content-left,
.content-right {
  width: 45%; /* Adjust the width as needed */
}

/* Additional styling if needed */
.content-left {
  /*background-color: lightblue;*/
  padding: 20px;
}

.content-right {
  /*background-color: lightgreen;*/
  padding: 20px;
}

</style>

		<script>
			var VIEW_STYLE='<?php echo VIEW_STYLE;?>';
			var COMMON_VIEW_SCRIPT='<?php echo COMMON_VIEW_SCRIPT;?>';
			var BASE_URL='<?php echo BASE_URL;?>';
			
			var COMMON_VIEW_STYLE='<?php echo COMMON_VIEW_STYLE;?>';
			var COMMON_COMMON_VIEW_SCRIPT='<?php echo COMMON_COMMON_VIEW_SCRIPT;?>';
			var COMMON_BASE_URL='<?php echo COMMON_BASE_URL;?>';
			
		</script>





<script src="<?php //echo COMMON_VIEW_SCRIPT;?>jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo COMMON_VIEW_SCRIPT;?>fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo COMMON_VIEW_SCRIPT;?>jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>excanvas.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.flot.min.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.flot.pie.min.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.flot.stack.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>charisma.js"></script>
	
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>table.plugin.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.alerts.js"></script>
	<script src="<?php echo COMMON_VIEW_SCRIPT;?>jquery.timepicker.js"></script>
	
	
	
</body>
</html>
