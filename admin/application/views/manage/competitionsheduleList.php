<?php include('header.php'); 

// print_r($result);
?>

<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
						<a href="<?php echo SITE_URL?>competitionshedule/schedule_school_check">List</a>
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
						<div class="controls">
				   Franchise
				   
				   <select name="franchise_id" id="franchise_id">
									<?php foreach($franchise as $val) { ?>
            									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'] ?></option>
            									<?php } ?>
								 </select>
				   
							<?php
// 								$options=array(""=>"Select");
// 							foreach($franchise as $franchiseval) {
//                         $name=$franchiseval['franchise_code'];
//                           $id=$franchiseval['franchise_id'];
							
								
// 								$options[$id] = $name;
// 	}
							
// 								echo form_dropdown('fr_id', $options, isset( $fr_id )?$fr_id: '');
						
								?>
								
						 
			     	Period
			     	
			     	<select  name="period_id" id="period_id">
									<option value="">Select</option>
									<?php foreach($period as $periodval) { ?>
									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
									<?php } ?>
								 </select>
							<?php
// 							$js = 'id="period_id"';
// 								$options=array(""=>"Select");
// 							foreach($period as $periodsval) {
//                         $name=$periodsval['period_name'];
//                           $id=$periodsval['period_id'];
							
								
// 								$options[$id] = $name;
// 	}
							
// 								echo form_dropdown('period_id', $options, isset( $period_id )?$period_id: '',$js);
						
								?>
								
Product
								 <select name="product_name" id="product_name" required>
									<option value="">Select</option>
									<?php foreach($product as $val) { ?>
									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
									<?php } ?>    
								 </select> 
								 	
														
									Level
						
								 <select  name="competition_level_id" id="competition_level_id" required>
									<option value="">Select</option>
									<?php foreach($level as $val) { ?>
            									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
            									<?php } ?>
								 </select>
	
							
							
							<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
								<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>competitionshedule/'">Reset</button>
						</div>
						
							
								
							  </div>
					<?php if(empty($list)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else{
					
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
								  <th>Period</th>
								  
								  <th>Competition Level</th>
								  <th>Product Name</th>
								  <th>Class</th>
								  <th>Franchise</th>
<th>Centre Name</th>
                          <!--<th>reporting Time</th>-->
                          <th>Asign School</th>
								  <th>All Scheduled School</th>
							  </tr>
						  </thead>   
						  <tbody>		  							
							
						<?php foreach($list as $value){ ?>	
							<tr>
                                <td><?php echo $value['period_name']; ?></td>
								
                                <td><?php 
                               // print_r($result);
                                $sql="SELECT level_name FROM  `competition_level_byproduct` where level_id={$result['competition_level_id']} ;";
                                    $query = $this->db->query($sql);
                                    $level =$query->result_array();
								print_r($level[0]['level_name']);
                                
                                ?></td>
								 <td><?php echo $value['product_name'] ?></td>
                                 <td><?php echo $value['class'] ?></td>
                                 <td><?php echo $value['franchise_code'] ?></td>
   <td><?php echo $value['center_address'] ?></td> 
  <!-- <td><?php echo $value['reporting_time'] ?></td>-->
    <td><a class="btn btn-info" href="<?php echo SITE_URL?>competitionshedule/assignschools/id/<?php echo $value['competition_schedule_id']; ?>" title="change Shedule"> 
										<i class="icon-edit icon-white"></i>  
										                                           
									</a></td> 
                                
							
								<td class="center">
								   
								   
								<?php //echo $value['competition_schedule_id']; 
								
								$sql="SELECT * FROM schedule_to_school JOIN `competition_schedule` ON `competition_schedule`.`competition_schedule_id`=`schedule_to_school`.`competition_schedule_id` JOIN `school_new` ON `school_new`.`id`=`schedule_to_school`.`school_id` where  schedule_to_school.competition_schedule_id={$value['competition_schedule_id']} ;";
                                    $query = $this->db->query($sql);
                                    $school =$query->result_array();
								// print_r($school);
								$i=1;
								foreach($school as $row){
								    echo $i.'- ';
								    echo '('.$row['school_code'].') '.$row['school_name'].' '.$row['school_address'].'.';
								    echo '<br>';
								    $i=$i+1;
								}
								?>
									<!--<a class="btn btn-info" href="<?php echo SITE_URL?>competitionshedule/edit/id/<?php echo $value['competition_schedule_id']; ?>" title="Edit">-->
									<!--	<i class="icon-edit icon-white"></i>  -->
										                                           
									<!--</a>-->
									<!--<a class="delete btn btn-danger" href="<?php echo SITE_URL?>competitionshedule/delete/id/<?php echo $value['competition_schedule_id']; ?>" title="Delete">-->
									<!--	<i class="icon-trash icon-white"></i> -->
										
									<!--</a>-->
									
								</td>
							</tr>
						<?php } ?>	
						  </tbody>
					  </table> 
					<?php } ?>  
					<div class="pagination pagination-left">
						 <ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						  </ul>
					</div>
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
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
	
	
 </script>
 
 
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