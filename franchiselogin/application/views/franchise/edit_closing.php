<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 

// print_r($stat);
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

<?php if(!empty($message)){?><h3 style='color:green;'><?php echo $message; ?> Click Back to redirect list page.</h3><?php } ?>
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
                    <h1><small>Closing Edit Details</small></h1>
                </div>
                    
                   <br><b>Orientation Details</b><br>
Orientation A Time<input type='text' name='orientation_a_time' value='<?php echo isset($stat['orientation_a_time']) ? $stat['orientation_a_time'] : ''; ?>' style='margin-left:20px;width:40px;'>
Orientation A Date<input type='date' name='orientation_a_date'  value='<?php echo isset($stat['orientation_a_date']) ? $stat['orientation_a_date'] : ''; ?>' style='margin-left:20px;'>
<br>
Orientation B Time<input type='text' name='orientation_b_time'  value='<?php echo isset($stat['orientation_b_time']) ? $stat['orientation_b_time'] : ''; ?>' style='margin-left:20px;width:40px;'>
Orientation B Date<input type='date' name='orientation_b_date'  value='<?php echo isset($stat['orientation_b_date']) ? $stat['orientation_b_date'] : ''; ?>' style='margin-left:20px;'>
<br>
Orientation C Time<input type='text' name='orientation_c_time' value='<?php echo isset($stat['orientation_c_time']) ? $stat['orientation_c_time'] : ''; ?>' style='margin-left:20px;width:40px;'>
Orientation C Date<input type='date' name='orientation_c_date' value='<?php echo isset($stat['orientation_c_date']) ? $stat['orientation_c_date'] : ''; ?>' style='margin-left:20px;'>
<br><b>Mock Test Details</b><br>
Mock Test Time<input type='text' name='mocktest_a_time' value='<?php echo isset($stat['mocktest_a_time']) ? $stat['mocktest_a_time'] : ''; ?>' style='margin-left:20px;width:40px;'>
Mock Test Date<input type='date' name='mocktest_a_date' value='<?php echo isset($stat['mocktest_a_date']) ? $stat['mocktest_a_date'] : ''; ?>' style='margin-left:20px;'>

                <hr>
                
               
              
               
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="submit" name="submit" >Update</button>
                    <button class="btn btn-warning" name='back'>Back to list</button>
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
