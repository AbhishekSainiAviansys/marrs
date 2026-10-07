
<style>
.footer {
    background: linear-gradient(90deg, #4775d1, #2f5bb7);
    color: #fff;
    padding: 12px 20px;
    font-size: 14px;
    position: fixed;
    width: 100%;
    bottom: 0px;
    overflow-x:hidden;
    z-index: 1000;
}

/* Flex layout */
.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

/* Text */
.footer p {
    margin: 0;
}

/* Links */
.footer a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
}

.footer a:hover {
    text-decoration: underline;
}

/* Mobile */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
        gap: 5px;
    }
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



    <footer class="footer">
    <div class="footer-container">
        
        <p>
            © 
            <a href="#">
                MaRRS Rediscover. 
                <?php echo date("Y",strtotime("-1 year")).' - '.date('Y');?>
            </a>
        </p>

        <p>
            Powered By: 
            <a href="https://www.aviansys-tech.com/" target="_blank">
                Aviansys Technologies Pvt. Ltd.
            </a>
        </p>

    </div>
</footer>


	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>jquery-ui-1.8.21.custom.min.js"></script>-->
	<!-- transition / effect library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-transition.js"></script>-->
	<!-- alert enhancer library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-alert.js"></script>-->
	<!-- modal / dialog library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-modal.js"></script>-->
	<!-- custom dropdown library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-dropdown.js"></script>-->
	<!-- scrolspy library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-scrollspy.js"></script>-->
	<!-- library for creating tabs -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-tab.js"></script>-->
	<!-- library for advanced tooltip -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-tooltip.js"></script>-->
	<!-- popover effect library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-popover.js"></script>-->
	<!-- button enhancer library -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-button.js"></script>-->
	<!-- accordion library (optional, not used in demo) -->
	<!--<script src="<?php //echo COMMON_VIEW_SCRIPT;?>bootstrap-collapse.js"></script>-->
	<!-- carousel slideshow library (optional, not used in demo) -->


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>new DataTable('#example');</script>

<script>
setTimeout(function() {
    var el = document.getElementById("notification-bar");
    if (el) {
        el.style.opacity = "0";
        setTimeout(() => el.remove(), 500);
    }
}, 3000);
</script>
</body>
</html>
