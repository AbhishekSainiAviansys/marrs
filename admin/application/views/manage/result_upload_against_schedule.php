<?php include('header.php'); 

// print_r($level);
?>
<style>
    /*select{*/
    /*    padding-left:50px;*/
    /*}*/
    
    
</style>
        <?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
						<a href="<?php echo SITE_URL?>competitionshedule/">List</a>
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Competition shedule</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					
				<form method="POST">
					<div class="box-content">
					    <div class="control-group">
					        <div class="control-group" >
								<div style='display:flex;'>
    							    <div class="control-group"  style='padding-left:0px;'>
    							        <label class="control-label" for="focusedInput">Period</label>
    								
            								 <select class="span2" name="period_id" id="period_id" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($period as $periodval) { ?>
            									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>
    								
    								</div>
    							  
    							  
    							    <div class="control-group" style='padding-left:40px;'>
    								<label class="control-label" for="focusedInput">Country</label>
    							        <div class="controls">
    								        <select class="span2" name="country" id="country" style='width:150px;' required>
    									
    								            <option value="105">India</option> 
    								        </select>
    								 
    								    </div>
    							  </div>
    							  
    							   
                                    <div class="control-group" style='padding-left:40px;'>
    							
    								<label class="control-label" for="focusedInput">State</label>
    							        <div class="controls">
    								        <select class="span2" name="state_id" id="state_id" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($state as $val) { print_r($val);?>
            									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['state_subdivision_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
            									<?php } ?>
    								        </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
    								
    								    </div>
    							  </div> 
    							  
    							  
    							    <div class="control-group" style='padding-left:40px;'>
    								<label class="control-label" for="focusedInput">Franchise Id</label>
    								    <div class="controls">
            								 <select class="span2" name="franchise_id" id="franchise_id" style='width:150px;' required>
            									<?php foreach($franchise as $val) { ?>
            									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
    								
    								    </div>
    							    </div>
    							  
    							  
    							    <div class="control-group" style='padding-left:40px;'>
    								<label class="control-label" for="focusedInput">Product</label>
        								<div class="controls">
            								 <select class="span2" name="product_name" id="product_name" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($product as $val) { ?>
            									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
            									<?php } ?>    
            								 </select> 
        								 	
        								</div>
    							    </div>
    							  
    							 
    							  
    							   <div class="control-group" style='padding-left:40px;'>
    								    <label class="control-label" for="focusedInput">Level</label>
    								    <div class="controls">
            								 <select class="span2" name="competition_level_id" id="competition_level_id" style='width:150px;'required>
            									<option value="">Select</option>
            									<?php foreach($level as $val) { ?>
            									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
    								
    								    </div>
    							    </div>
							<div class="control-group" style='padding-left:40px;padding-top:20px;'>
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Search</button>
								<!--<button class="btn">Cancel</button>-->
							  </div>
								</div>
							</div>
							  </div>
                				
					<?php
					if(!empty($list)){
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
							      <th>Sr. no</th>
							      <th>Schedule ID</th>
								  <th>Period</th>
								  
								  <th>Competition Level</th>
								  <th>Product Name</th>
								  <th>Category</th>
								  <th>Franchise</th>
                                    <th>competition Date</th>
                                    <th>Center Address</th>
                          <!--<th>reporting Time</th>-->
                          <!--<th>Asign School</th>-->
								  <th>Upload Result</th>
							  </tr>
						  </thead>   
						  <tbody>		  							
							
						<?php 
						$i=1;
						foreach($list as $value){ ?>	
							<tr>
							    <td><?php echo $i; ?></td>
							    <td><?php echo $value['competition_schedule_id']; ?></td>
                                <td><?php echo $value['period_name']; ?></td>
								
                                 <td><?php echo $value['level_name'] ?></td>
								 <td><?php echo $value['product_name'] ?></td>
                                 <td><?php echo $value['class'] ?></td>
                                 <td><?php echo $value['franchise_code'] ?></td>
                                 <td><?php echo $value['competition_date'] ?></td> 
                                 <td><?php echo $value['center_address'] ?></td>
                                    
                                    
                                    
         <!--                           <td><a class="btn btn-info" href="<?php echo SITE_URL?>competitionshedule/assignschools/id/<?php echo $value['competition_schedule_id']; ?>" title="Assign School"> -->
									<!--	<i class="icon-edit icon-white"></i>  -->
										                                           
									<!--</a></td> -->
                                
							
								<td class="center">
								   
								   
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>result/upload/id/<?php echo $value['competition_schedule_id']; ?>" target='blank' title="Edit"> Upload Result 
										<i class="icon-edit icon-white"></i>  
										                                           
									</a>
									</td>
									
									<!--<td class="center">-->
									<!--<a class="delete btn btn-danger" href="<?php echo SITE_URL?>competitionshedule/delete/id/<?php echo $value['competition_schedule_id']; ?>" title="Delete">-->
									<!--	<i class="icon-trash icon-white"></i> -->
										
									<!--</a>-->
									
								 <!--   </td>-->
								
								
								
								
							</tr>
						<?php $i=$i+1;} ?>	
						  </tbody>
					  </table> 
					<?php } ?>  
					<!--<div class="pagination pagination-left">-->
					<!--	 <ul>-->
					<!--		<li><a href="#">Prev</a></li>-->
					<!--		<li><a href="#">1</a></li>-->
					<!--		<li><a href="#">2</a></li>-->
					<!--		<li><a href="#">3</a></li>-->
					<!--		<li><a href="#">4</a></li>-->
					<!--		<li><a href="#">5</a></li>-->
					<!--		<li><a href="#">Next</a></li>-->
					<!--	  </ul>-->
					<!--</div>-->
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
       $("#state_id").change(function(){
        var state_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getStateFranchise/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
                 $("#franchise_id").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
	
 </script>


			<script type="text/javascript">
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	$("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
	
 </script>