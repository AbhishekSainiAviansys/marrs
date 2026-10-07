<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 

			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Competition <?php echo ($blogID>0)?'Edit':'Activate';?></h2>
						
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="" method="POST">
							<fieldset>
							<div class="page-header">
							  <h1><small>Competition End Details</small></h1>
							</div>
						
                          
                                Exam Center 1
                                <input type='text' name='exam_center1' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address1' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date1' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time1' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 2
                                <input type='text' name='exam_center2' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address2' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date2' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time2' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 3
                                <input type='text' name='exam_center3' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address3' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date3' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time3' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 4
                                <input type='text' name='exam_center4' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address4' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date4' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time4' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 5
                                <input type='text' name='exam_center5' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address5' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date5' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time5' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 6
                                <input type='text' name='exam_center6' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address6' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date6' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time6' style='margin-left:20px;width:240px;'>
                                <br>
                                Exam Center 7
                                <input type='text' name='exam_center7' style='width:200px;'>
                                Center Address <input type='text' name='exam_center_address7' style='width:200px;'>
                                Exam Date<input type='date' name='exam_date7' style='margin-left:20px;'>
                                Exam Time<input type='text' name='exam_time7' style='margin-left:20px;width:240px;'>
                                
                                
                                <br><b>Orientation Details</b><br>
                                Orientation A Time<input type='text' name='orientation_a_time' style='margin-left:20px;width:40px;'>
                                Orientation A Date<input type='date' name='orientation_a_date' style='margin-left:20px;'>
                                <br>
                                Orientation B Time<input type='text' name='orientation_b_time' style='margin-left:20px;width:40px;'>
                                Orientation B Date<input type='date' name='orientation_b_date' style='margin-left:20px;'>
                                <br>
                                Orientation C Time<input type='text' name='orientation_c_time' style='margin-left:20px;width:40px;'>
                                Orientation C Date<input type='date' name='orientation_c_date' style='margin-left:20px;'>
                                <br><b>Mock Test Details</b><br>
                                Mock Test Time<input type='text' name='mocktest_a_time' style='margin-left:20px;width:40px;'>
                                Mock Test Date<input type='date' name='mocktest_a_date' style='margin-left:20px;'>
                                
                            <hr>
                            
                           
                          
                           
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
								<button class="btn">Cancel</button>
							  </div>
						
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
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
		$("#franchise_id").change(function(){
        var franchise_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
                 $("#area_id").html(result);
        }});
    }); 
    
    $("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/class_category/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#category_id_").html(result);
        }});
    }); 
    
 </script>
 
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>