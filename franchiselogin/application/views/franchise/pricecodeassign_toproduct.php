<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>blog/">prize Code</a> <span class="divider">/</span>
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
						<h2><i class="icon-edit"></i> Price Code</h2>
						
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
							 
							</div>
							  
							  
							   <div class="control-group span4">
								<label class="control-label" for="focusedInput">Period </label>
								<div class="span4">
								     <?php 
								     
								     $this->db->select('period_name,period_id');
								     $this->db->from('period');
								     $this->db->where('status','Active');
								     $res =  $this->db->get();
								     $franchise= $res->row()->period_name;
								    
								    ?>
								  <select class="" id="period" name="period">
								      
								 <option value="<?php echo $res->row()->period_id;?>"><?php echo $franchise;?> </option>
								  </select>
								</div>
							  </div>
							  <div class="control-group span4 ">
								<label class="control-label" for="focusedInput"> Assign Product  </label>
								<div class="span4">
								  
								  <select class="" id="level" name="product_name[]" multiple>
								    <?php 
								     
								     $this->db->select('*');
								     $this->db->from('product_allotted_fr');
								     $this->db->join('products', 'products.product_id = product_allotted_fr.product_id');
								    
								     $this->db->where('product_allotted_fr.franchise_id',$f_id);
								     $res =  $this->db->get()->result_array();
								    
								    foreach($res as $value){
								    ?>   
								  <option value="<?php echo $value['product_id'];?>"><?php echo $value['product_name'];?> </option>
								 	<?php } ?>
								 	 	 	 
								  </select>
								</div>
							  </div>
							 
							   <div class="control-group span4 ">
								<label class="control-label" for="focusedInput">Lavel </label>
								<div class="span4">
								  
								  <select class="" id="level" name="level">
								    <?php 
								     
								     $this->db->select('*');
								     $this->db->from('competition_levels');
								     $this->db->where('status','Active');
								     $res =  $this->db->get();
								     $franchise= $res->result_array();
								    foreach($franchise as $value){
								    ?>   
								  <option value="<?php echo $value['id'];?>"><?php echo $value['level_name'];?> </option>
								 	<?php } ?>
								 	 	 	 
								  </select>
								</div>
							  </div>
							 
							   <div class="control-group span4 ">
								<label class="control-label" for="focusedInput">Pricecode </label>
								<div class="span4">
								  
								  <select class="" id="level" name="price_code">
								    <?php 
								     
								     $this->db->select('*');
								     $this->db->from('price_codegenration');
								     $this->db->where('status','Active');
								     $this->db->where('franchise_id',$f_id);
								     $res =  $this->db->get();
								     $pricecode= $res->result_array();
								    foreach($pricecode as $value){
								    ?>   
								  <option value="<?php echo $value['price_code'];?>"><?php echo $value['price_code'];?> </option>
								 	<?php } ?>
								 	 	 	 
								  </select>
								</div>
							  </div>
							   <div class="control-group span4 ">
								<label class="control-label" for="focusedInput"> School Name </label>
								<div class="span4">
								  
								  <select class="" id="level" name="school[]" multiple>
								    <?php 
								  
								       $school = $this->db->get_where('schools',array('franchise_id' =>$f_id))->result_array();
      
								    foreach($school as $value){
								    ?>   
								  <option value="<?php echo $value['school_id'];?>"><?php echo $value['school_name'];?> </option>
								 	<?php } ?> 
								 	 	 	 
								  </select>
								</div>
							  </div>
							 	
							</fieldset>
						
						
							  <div class="" style="    margin-left: 184px;">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
								<button class="btn">Cancel</button>
							  </div>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
<?php include('footer.php'); ?>
