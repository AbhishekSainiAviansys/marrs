<?php include('header.php');

// print_r($pemplate->pemplate);
?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo SITE_URL?>category_new/">Upload Pemplate</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
        </li>
    </ul>
</div>

<?php if(!empty($message)){?><h3 style='color:green;'><?php echo $message; ?> </h3><?php } ?>
<div class="row-fluid sortable">
    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Pemplate <?php echo ($blogID>0)?'Edit':'Upload';?></h2>
            
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            
            <fieldset>
                <br><b>Upload Details</b><br>
                <?php if (isset($message)) { ?>
                    <p style="color: red;"><?php echo $message; ?></p>
                <?php } ?>
                
                <form method="post" enctype="multipart/form-data" >
                    Choose your PDF file:<br>  
                    <input name="pdf" type="file" id="pdf" accept=".pdf" /> 
                    <button type="submit" class="btn btn-primary" id="submit" name="submit">Upload</button>
                </form>
            </fieldset>
            
            <?php if(!empty($pemplate->pemplate)){ ?>
            
                <div>
                    <a href='https://marrs.in/franchiselogin/uploads/<?php echo $pemplate->pemplate; ?>' target="_BLANK" class='btn btn-warning' >View Previous Circular</a><br>
                </div>  
                
            <?php } ?>
            
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