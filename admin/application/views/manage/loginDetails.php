<?php include('header.php');
?>
			<?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			<?php if(!empty($this->session->flashdata('success'))) { ?>
			<div style="text-align:center;background:green;padding:12px">
			<h3 style="color:#fff"><?php echo $this->session->flashdata('success'); ?></h3>
			</div>
			<?php }?>
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> PRODUCT ASSIGN TO FRANCHISE</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                  <form method='post'>
                        <!----------------- Franchise ------------------->       
                        <div >   
                           <div class="control-group d-flex gap-3">
                           <div>
                           	<label class="control-label" for="focusedInput">Franchise
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								      <select name="franchise" id="franchise" required>
								   <option value=""> Select Franchise</option>
								        <?php 
								        $this->db->select('*');
								        $this->db->from('franchise');
								        $resc = $this->db->get();
								       $coun = $resc->result_array();
								        foreach($coun as $val){ ?>
								      <option value="<?php echo $val['franchise_id'];?>"><?php echo $val['username'];?></option>
								       
								        <?php }?>
								    </select>
								   
								</div>
                            </div>
                            <div>
								<label class="control-label"  for="focusedInput">Product 
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								     <select class="span2" name="product_name" id="product_name" style='width:100%;'>
								          <option value="1"> All Product</option>
									   <?php 
								        $this->db->select('*');
								        $this->db->from('products');
								        $this->db->where('status','Active');
								        $this->db->order_by('product_name','ASC');
								        $resc = $this->db->get();
								       $coun = $resc->result_array();
								        foreach($coun as $val){ ?>
								      <option value="<?php echo $val['product_id'];?>"><?php echo $val['product_name'];?></option>
								       
								        <?php }?>
								        </select>
								</div>
								</div>
								<div>
								<label class="control-label" for="focusedInput" >Status
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								     <select class="span4" name="status" id="status" style='width:180px;'>
									      <option value="Active"  >Active</option>
                                          <option value="Pending" >Pending</option>
                                          <option value="Inactive" >Inactive</option>
                                          <option value="Deleted" >Deleted</option>
                                          <option value="Deactive" >Deactive</option>
                                          <option value="All" >All</option>
                                     </select>
								</div>
								</div>
								<div class="form-actions">
        								<input type="submit" class="btn btn-primary my-4" id="submit" value="submit" name="submit" >
        								<!--<button class="btn">Cancel</button>-->
        				   </div>
						   </div>
						</div>
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   
				    
 </form>
 
 

				
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
		
<?php include('footer.php'); ?>
