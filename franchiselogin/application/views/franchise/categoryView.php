<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
							<!--<a href="<?php //echo SITE_URL?>blog/">List</a>-->
					</li>
				</ul>
			</div>
			
			<div >
            <form method="POST">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Category</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>					
					
					<div class="box-content">
                        <div class="control-group">
                           <label class="control-label" for="focusedInput"> CIN </label>
                           <div class="controls"><strong><?php echo $registration_details['cin']; ?></strong></div> <!--<!--END OF  class="controls" DIV -->
                        </div><!--END OF class="control-group" DIV --> 
				
				</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>
