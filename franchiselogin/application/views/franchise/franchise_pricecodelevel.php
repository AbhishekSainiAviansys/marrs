<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>school/franchise_pricecodelevel/">Events</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>Pricecode"></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Pricecode</h2>
						
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
							  <h1><small></small></h1>
							</div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Select Product </label>
							<select class="" name="product">
							    <?php foreach($product as $val){?>
							    <option value="<?php echo $val->product_id;?>"><?php echo $val->product_name;?></option>
							     <?php  }?>
							</select>
							  </div>
							 
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Select Pricecode </label>
	                     <select name="price_code">
	                         	 <?php foreach($pricecode as $val){?>
							    <option value="<?php echo $val->price_code;?>">Level<?php echo $val->level;?>-<?php echo $val->price_code;?></option>
							     <?php  }?>
							</select>
							  </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Select School </label>
	                     <select name="school_name">
	                         	 <?php foreach($school as $val){?>
							    <option value="<?php echo $val->school_id;?>"><?php echo $val->school_name;?></option>
							     <?php  }?>
							</select>
							  </div>
							 
							
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
								<button class="btn">Cancel</button>
							  </div>
							
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
