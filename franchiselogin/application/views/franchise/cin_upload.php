<?php include('header.php');


// print_r($competition);

?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo SITE_URL?>category_new/">Upload CIN</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
        </li>
    </ul>
</div>


<div class="row-fluid sortable">
    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> CIN <?php echo ($blogID>0)?'Edit':'Upload';?></h2>
            
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="page-header" style='display:flex;'>
                    <h1><small>CIN uploade for Competition Registration</small></h1> &nbsp &nbsp <h2>Competition Details</h2>
                </div>
            <fieldset>
                
                <div style="display:flex;">
                    
                    <h4>Product Name  </h4>&nbsp &nbsp<span style='color:green;'><?php echo $competition->product_name; ?></span> &nbsp &nbsp
                    <h4>Level Name </h4>&nbsp &nbsp<span style='color:green;'><?php echo $competition->level_name; ?></span> &nbsp &nbsp
                    <h4>State Name </h4>&nbsp &nbsp<span style='color:green;'><?php echo $competition->state_subdivision_name; ?></span>
                    
                </div>
                    
                
                <hr>
                
                <form method="post" enctype="multipart/form-data" name="form1" id="form1">
                    
                    <!--<input type="checkbox" name='competition' > <lable style="font-weight:bold;">Use CoFee</lable><br>-->
                    <br><b>Uplode Details</b><br>
                    Choose your CSV file  <br />  <input name="csv" type="file" id="csv" /> 
                    <button type="submit" class="btn btn-primary" id="submit" name="submit" >Upload</button>
                </form>
            </fieldset>
              
            <div>
                    <?php if(!empty($message)){?><h3 style='color:green;'><?php echo $message; ?> </h3><?php } ?>    
                <?php if(!empty($ar)){ ?>
                    <table class="table table-bordered">
						<thead>
							  <tr>
							      <th>Sr.No.</th>
								  <th>CIN</th>
								  <th>Message</th>
								
							  </tr>
						  </thead>   
						  <tbody>		  							
							
    						<?php 
    						
    						$i=1;
    						foreach($ar as $value){ ?>	
							<tr>
							    <td><?php echo $i; ?></td>
                                <td><?php echo $value['cin']; ?></td>
                                <!--<td>-->
                                    <?php 
                                    
                                    //    echo $value['message'];
                                    
                                    ?>
                                <!--</td>-->
                                
                                <td style="background-color: <?= (stripos($value['message'], 'error') !== false) ? '#f8d7da' : '#d4edda'; ?>;">
                                    <?= htmlspecialchars($value['message']) ?>
                                </td>

                                
							</tr>
							
						    <?php $i=$i+1;} ?>	
						</tbody>
					</table> 
                <?php }else{ 
                    echo 'No file selected or cin already uploaded.';
                 } ?>
            </div>
            
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
        url:"<?php echo base_url();?>franchise/ajax/class_category/",
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