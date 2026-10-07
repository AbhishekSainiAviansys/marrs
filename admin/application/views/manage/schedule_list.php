<?php include('header.php'); 

// print_r($level);
?>
<style>
    /*select{*/
    /*    padding-left:50px;*/
    /*}*/
    table .btn + .btn {
     margin-left: 0px !important; 
}
    
</style>
<!--Competition Mode-->
<div class="modal fade" id="dateModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
         
      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">Select Competition Date</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Form -->
      <form id="competitionDateForm">
        
        <div class="modal-body">
           <input type="hidden" name="competition_schedule_id" id="competition_schedule_id" value="">
          <div class="mb-3">
            <label class="form-label">Competition Date</label>
            <input type="date" name="competition_date" class="form-control" required>
          </div>

        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="save_date" class="btn btn-primary">Save</button>
        </div>

      </form>

    </div>
  </div>
</div>

<?php echo $this->notifications->display_html();?> 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
						<a href="<?php echo SITE_URL?>competitionshedule/schedule_list">List</a>
					</li>
				</ul>
			</div>
			
			<div  class="mb-5">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Competition Schedule</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					
				<form method="POST" class="my-2 ">
					<div class="box-content ">
					    <div class="control-group">
					        <div class="control-group" >
								<div class="d-flex align-items-center gap-3 border rounded p-3">
    							    <div class="control-group" >
    							        <label class="control-label" for="focusedInput">Period<span style='color:red;'>*</span></label>
    								
            								 <select class="span2 form-control" name="period_id" id="period_id" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($period as $periodval) { ?>
            									<option value="<?php echo $periodval['period_id'] ?>" <?php if( isset( $result['period_id'] ) ) if($result['period_id'] == $periodval['period_id']) {  ?> selected="selected" <?php } ?> ><?php echo $periodval['period_name'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>
    								
    								</div>
    							  
    							  
    							    <div class="control-group">
    								<label class="control-label" for="focusedInput">Country<span style='color:red;'>*</span></label>
    							        <div class="controls">
    								        <select class="span2 form-control" name="country" id="country" style='width:150px;' required>
    									        <option value="">Select</option>
    								            <option value="105">India</option> 
    								            <?php foreach($country as $val) { //print_r($val);?>
            									<option value="<?php echo $val['country_id'] ?>" <?php if( isset( $result['country'] ) ) if($result['country'] == $val['country_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['country_name'] ?></option>
            									<?php } ?>
    								        </select>
    								 
    								    </div>
    							  </div>
    							  
    							   
                                    <div class="control-group" >
    							
    								<label class="control-label" for="focusedInput">State<span style='color:red;'>*</span></label>
    							        <div class="controls">
    								        <select class="span2 form-control" name="state_id" id="state_id" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($state as $val) { //print_r($val);?>
            									<option value="<?php echo $val['state_subdivision_id'] ?>" <?php if( isset( $result['state_id'] ) ) if($result['state_id'] == $val['state_subdivision_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['state_subdivision_name'] ?></option>
            									<?php } ?>
    								        </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_center_id',"Please enter the competition center.") ?></span>
    								
    								    </div>
    							  </div> 
    							  
    							  
    							    <div class="control-group">
    								<label class="control-label" for="focusedInput">Franchise</label>
    								    <div class="controls">
            								 <select class="span2 form-control" name="franchise_id" id="franchise_id" style='width:150px;' >
            									<?php foreach($franchise as $val) { ?>
            									<option value="<?php echo $val['franchise_id'] ?>" <?php if( isset( $result['franchise_id'] ) ) if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['franchise_code'] ?></option>
            									<?php } ?>
            								 </select>
    								 		 <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
    								
    								    </div>
    							    </div>
    							  
    							  
    							    <div class="control-group">
    								<label class="control-label" for="focusedInput">Product<span style='color:red;'>*</span></label>
        								<div class="controls">
            								 <select class="span2 form-control" name="product_name" id="product_name" style='width:150px;' required>
            									<option value="">Select</option>
            									<?php foreach($product as $val) { ?>
            									<option value="<?php echo $val['product_name'] ?>" data-id="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_name']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
            									<?php } ?>    
            								 </select> 
        								 	
        								</div>
    							    </div>
    							  
    							 
    							  
    							   <!--<div class="control-group">-->
    								  <!--  <label class="control-label" for="focusedInput">Level</label>-->
    								  <!--  <div class="controls">-->
            		<!--						 <select class="span2 form-control" name="competition_level_id" id="competition_level_id" style='width:150px;'required>-->
            		<!--							<option value="">Select</option>-->
            									<?php //foreach($level as $val) { ?>
            									<!--<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>-->
            									<?php //} ?>
            			<!--					 </select>-->
    								 		<!-- <span class="help-inline"><?php  $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>-->
    								
    								   <!-- </div>-->
    							    <!--</div>-->
    							    
    							    
    							  <div class="control-group">
    								<label class="control-label" for="focusedInput">Search</label>
        								<div class="controls">
        								    <input type='text' name='search' placeholder='Center Name' <?php if(isset($result['search'])){ ?> value='<?php echo $result['search']; ?>' <?php } ?> >
        								    
        								</div>
        						  </div>
    							    
    							    
							<div class="control-group" style='padding-top:20px;'>
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Search</button>
								<!--<button class="btn">Cancel</button>-->
							  </div>
								</div>
							</div>
							  </div>
                				
					<?php
					if(!empty($list)){
					?>
						<table class="table table-bordered mt-2 mb-5" id="example">
						  <thead>
							  <tr>
							      <th>Sr. no</th>
							      <th>Schedule ID</th>
							      
								  <th>Period</th>
								  
								  <th>Competition Level</th>
								  <th>Product Name</th>
								  <th>Class</th>
								  <th>Franchise</th>
                                  <th>competition Date</th>
                                  <th>Center Address</th>
                         
                                  <th>Competitionfee</th>
                                  <!--<th>Asign School</th>-->
                          
								  <th>Actions</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>		  							
							
						<?php 
						$i=1;
						foreach($list as $value){
						
    				     	$competition = $this->db->get_where('competition_product_state', array(
                            'product_name' => $value['product_name'],
                            'clevel'       => $value['competition_level_id'],
                            'period_id'    => $value['period_id']
                                ))->row();


						?>	
							<tr>
							    <td><?php echo $i; ?></td>
							    <td><?php echo $value['competition_schedule_id']; ?><br><br>
							    <?php echo $value['title']; ?>
							    </td>
                                <td><?php echo $value['period_name']; ?></td>
								
                                <td><?php echo $value['level_name'] ?></td>
								 <td><?php echo $value['product_name'] ?></td>
                                 <td><?php echo $value['class'] ?></td>
                                 <td><?php echo $value['franchise_code'] ?></td>
                                 <td><?php echo $value['competition_date'] ?></td> 
                                    <td><?php echo $value['center_address'] ?></td>
                                     <td><?php echo $value['competition_fee'] ?></td>
                                     
         <!--                           <td><a class="btn btn-info" href="<?php //echo SITE_URL?>competitionshedule/assignschools/id/<?php //echo $value['competition_schedule_id']; ?>" title="Assign School"> -->
									<!--	<i class="icon-edit icon-white"></i>  -->
									<!--Assign Other School	                                           -->
									<!--</a></td> -->
                                
							
								<td class="center">
								   
								   
								
									<!--<a class="btn btn-info" href="<?php //echo SITE_URL?>competitionshedule/edit/id/<?php //echo $value['competition_schedule_id']; ?>" title="Edit">Edit-->
									<!--	<i class="icon-edit icon-white"></i>  -->
										                                           
									<!--</a>-->
									<a class="delete btn btn-danger" 
                                       href="<?php echo site_url('manage/competitionshedule/delete/' . $value['competition_schedule_id']); ?>" 
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete?')">
                                        <i class="icon-trash icon-white"></i> Delete
                                    </a>
									</td><td class="center">
								
									 <div class="control-group">
                                            <div class="controls d-flex ">
                                                
                                               <div class="d-flex gap-2 flex-wrap">
                                                <a href="<?php echo base_url(); ?>manage/competitionshedule/offline_cin_genration/<?php echo $value['competition_schedule_id'] ?>"  class="btn btn-primary">Generate CIN Offline</a>
                                                <!--<a href="#" class="btn btn-success ">Generate CIN Online</a>-->

                                               
                                                <a href="<?php echo base_url(); ?>manage/franchise/cin_list/<?=$value['competition_schedule_id'];?>"  class="btn btn-info">CIN List</a>


                                                <a href="<?php echo base_url(); ?>manage/franchise/student_result_upload/<?=$value['competition_schedule_id'];?>" target="_blank" class="btn btn-warning">Result Upload</a>
                                                
                                                <a href="<?php echo base_url(); ?>manage/franchise/student_result_export/<?=$value['competition_schedule_id'];?>" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Export Result</a>
                                                
                                                
                                                </div>
                                                <div class="d-flex gap-2 flex-wrap">
                                            <button name='add_center' class='btn btn-warning' value='<?php echo $value['id']; ?>'>Add Exam Center</button>
                                    						                 
                                    						                   <button name='center' class='btn btn-info' value='<?php echo $value['id']; ?>'>Edit Center details</button><br>
                                    <?php if(empty($row['pemplate'])){ ?>
                                    
                                        <!-- Upload Circular -->
                                        <a href="https://marrs.in/admin/manage/competitionshedule/pemplate/<?php echo $competition->id; ?>"
                                           target="_blank"
                                           class="btn btn-primary">
                                           Upload Circular
                                        </a>
                                    
                                    <?php } else { ?>
                                    
                                        <!-- Edit Circular -->
                                        <a href="https://marrs.in/admin/manage/competitionshedule/edit_pemplate/<?php echo $competition->id; ?>"
                                           target="_blank"
                                           class="btn btn-primary">
                                           Edit Circular
                                        </a>

                                                <!-- View Circular -->
                                                    <a href="https://marrs.in/manage/uploads/<?php echo $value['pemplate']; ?>"
                                                       target="_blank"
                                                       class="btn btn-warning ms-2">
                                                       View Circular
                                                    </a>
                                                
                                                <?php } ?>
                                                <button class="btn btn-warning offlineDateBtn" data-id="<?=$value['competition_schedule_id'];?>" data-bs-toggle="modal" data-bs-target="#dateModal">
                                                                                                    Offline Competition Date
                                                </button>
        
                                            </div>
                                            </div>
                                            
                                        </div>
								</td>
							</tr>
						<?php $i=$i+1;} ?>	
						  </tbody>
					  </table> 
					<?php }else{ ?> <h4 style='color:crimson'>'Error: No Schedule Found. Add schedule'</h4><?php }?>  
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
			
			
<script>
$(document).on('click', '.offlineDateBtn', function(){

    var competition_schedule_id  = $(this).data('id');

    $('#competition_schedule_id ').val(competition_schedule_id );

});

$("#competitionDateForm").submit(function(e){

    e.preventDefault();

    $.ajax({
        url: "<?php echo SITE_URL; ?>competitionshedule/updateCompetitionSchdule",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success:function(response){

            alert(response.message);

            if(response.status){
                $("#dateModal").modal('hide');
            }

        }
    });

});


</script>
<?php include('footer.php'); ?>
<!-- SweetAlert2 -->


<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script>
    $("#product_name").change(function(){
    var product_id = this.value;
    var BASE_URL = "<?php echo base_url();?>";

    $.ajax({
        url: BASE_URL + "manage/ajax/class_category/",
        data: {product_id: product_id},
        type: 'post',
        success: function(result){
            $("#category_id_").html(result);
        }
    });
});
</script>

<script type="text/javascript">

    $("#country").change(function(){
        var country_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getstateAjax/",
            data:{country_id:country_id},
            type: 'post',
            success:function(result){
                 $("#state_id").html(result);
        }});
    }); 

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
        var product_id=$(this).find(':selected').data('id');;
		//alert(product_id);
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
// 	$("#product_name").change(function(){
//         var product_id=this.value;
// 		//alert(state_id);
// 		var BASE_URL = "<?php echo base_url();?>";
//         $.ajax({
//             url:BASE_URL+"manage/ajax/productwiselevel/",
//             data:{product_id:product_id},
//             type: 'post',
//             success:function(result){
//                  $("#competition_level_id").html(result);
//         }});
//     }); 
	
 </script>