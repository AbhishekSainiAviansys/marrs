<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>blog/">Events</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'add';?>/"><?php echo ($blogID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Category <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST">
							<fieldset>
							<div class="page-header">
							  <h1><small>Add New Category</small></h1>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="focusedInput">Service</label>
								<div class="controls">
                                <?php
								$options=array();
								$options['']='Select Services';
								
                                foreach($services as $val):
								$options[$val['service_id']]=$val['service_name'];
								endforeach;
								
                                echo form_dropdown('serviceId',$options, isset( $services['service_id'] )?$services['service_id']: '');
								?>
                                <span class="help-inline" style="color:#F00;"><?php  echo form_error('serviceId'); //$this->validation->show_error('service_id',"Please select service.") ?></span>

								</div>
							  </div>
                             <div class="control-group">
								<label class="control-label" for="focusedInput">Category Key </label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="categoryKey" name="categoryKey" type="text" value="<?php if( isset( $list['categoryKey'] ) ) { echo $list['categoryKey']; } ?>" >
								   <span class="help-inline" style="color:#F00;"><?php  echo form_error('categoryKey'); //$this->validation->show_error('categoryKey',"Please enter the Key.") ?></span>
								</div>
							  </div>
                              <div class="control-group">
								<label class="control-label" for="focusedInput">Category Description </label>
								<div class="controls">
								  <input class="input-xxlarge focused" id="categoryDesc" name="categoryDesc" type="text" value="<?php if( isset( $list['categoryDesc'] ) ) { echo $list['categoryDesc']; } ?>" >
								   <span class="help-inline" style="color:#F00;"><?php echo form_error('categoryDesc');// $this->validation->show_error('categoryDesc',"Please enter the Description.") ?></span>
								</div>
							  </div>
							<?php if($mode=='View') { ?>
							<div class="form-actions">
							<a class="btn" href="<?php echo SITE_URL?>category_new/edit/id/<?php echo $list['category_id']?>"/>Edit</a>
							 </div>
							<?php } else { ?>
							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
							  <?php } ?>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
