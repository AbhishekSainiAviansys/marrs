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
						<h2><i class="icon-edit"></i> Price Code <?php echo ($blogID>0)?'Edit':'Add';?></h2>
						
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
								<label class="control-label" for="focusedInput">Prefix </label>
								<div class="span4">
								  <input class="" id="postTitle" name="prefix" type="text" value="PC" readonly>
								 
								  
								</div>
							  </div>
							   <div class="control-group span4">
								<label class="control-label" for="focusedInput">Franchise code  </label>
								<div class="span4">
								    <?php $fid= $this->session->userdata('franchise_id');
								     $this->db->select('franchise_code');
								     $this->db->from('franchise');
								     $this->db->where('franchise_id',$fid);
								     $res =  $this->db->get();
								     $franchise= $res->row()->franchise_code;
								    
								    ?>
								  <input class="" id="postTitle" name="franchise_code" type="text" value="<?php echo $franchise;?>" readonly>
								 
								  
								</div>
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
							 
							 
							 	<div class="control-group span4">
								<label class="control-label" for="focusedInput">Price </label>
								<div class="controls" >
								 <input type="text" name="product_price" placeholder="Price" value=""> 
							
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
