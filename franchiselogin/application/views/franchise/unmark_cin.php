<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
?>


			<div>
				<ul class="breadcrumb">
					<li>
						<!--<a href="<?php echo SITE_URL?>category_new/">Competition</a> <span class="divider">/</span>-->
					</li>
					<li>
						<!--<a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>-->
					</li>
				</ul>
			</div>
			

			<div class="row-fluid sortable">
			 
				<div class="box span12">
				    <?php //echo $this->notifications->display_html();
			if(!empty($message)){
			    ?>
			    <div class='row-fluid' style='background-color:#109b10;height:40px;display:grid;' >
			        <h4 style='color:#ffffff;'><?php echo $message; ?></h4>
			    </div>
			        
			    <?php
			}
			?>
			
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Competition <?php echo ' Activate';?></h2>
						
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
    						    <h1><small>Mark CIN as Paid</small></h1>
    						</div>
    							
    						<div style='display:flex;'>	  
    						    <div style='padding-left:20px;'>
    						        <label>CIN</label>
    						        <input type='text' name='cin' <?php if($result['cin']){?> value='<?php echo $result['cin']; ?>' <?php } ?> style='width:180px;' required>
    						    </div>
    						        
                            
                            
    							<div style='padding-left:20px;'>
    							    <label>Product</label>
    							    <select name="product_name" id="product_name" style='width:180px;' required>
    									<option value="">Select</option>
    									<?php foreach($product as $val) { ?>
    									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
    									<?php } ?>    
    								</select> 
    							</div> 
    							  
    							<div style='padding-left:20px;'>
    							    <label>C-Level</label>
    							    <select name="competition_level_id" id="competition_level_id" style='width:180px;' required>
    									<option value="">Select</option>
    									<?php foreach($level as $val) { ?>
    									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['competition_level_id'] ) ) if($result['competition_level_id'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
    									<?php } ?>    
    								</select> 
    							</div> 
    							
                              
                            
                          
        						<div class="form-actions">
        								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Search</button>
        								<button class="btn">Cancel</button>
        							  </div>
						        </div>
						        
					</fieldset>
				    </form>
				    <?php if (!empty($arr)) {
				    
				    ?>
                        
                            <div>
                                <div style='display:flex;'>
                                    <?php
                                        // print_r($arr);
                                        $competition='';
                                        $study_material_a='';
                				        $study_material_b='';
                				        $study_material_c='';
                				        $orientation_a='';
                				        $orientation_b='';
                				        $orientation_c='';
                				        $mock_test='';
                    				    foreach($arr as $row){
                    				        if($row['status'] == 'Paid'){$competition='Paid';}
                    				        if($row['study_material_a']=='yes'){$study_material_a='yes';}
                    				        if($row['study_material_b']=='yes'){$study_material_b='yes';}
                    				        if($row['study_material_c']=='yes'){$study_material_c='yes';}
                    				        if($row['orientation_a']=='yes'){$orientation_a='yes';}
                    				        if($row['orientation_b']=='yes'){$orientation_b='yes';}
                    				        if($row['orientation_c']=='yes'){$orientation_c='yes';};
                    				        if($row['mock_test']=='yes'){$mock_test='yes';}
                    				    }
                    
                        //             echo    $competition;
                        //             echo    $study_material_a;
                				    // echo    $study_material_b;
                				    // echo    $study_material_c;
                				    // echo    $orientation_a;
                				    // echo    $orientation_b;
                				    // echo    $orientation_c;
                				    // echo    $mock_test;
                        //             die;
                                    
                                    ?>
                                    <form method="POST">
                                        <div style='display:flex; flex-wrap: wrap; gap: 20px;'>
                                            <div>
                                                <input type="hidden" name="status" value="">
                                                <input type="checkbox" name="status" value="Paid" <?php echo ($competition == 'Paid') ? 'checked' : ''; ?>>
                                                <label>Competition</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="study_material" value="">
                                                <input type="checkbox" name="study_material" value="yes" <?php echo ($study_material_a == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-A Paid</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="study_material_b" value="">
                                                <input type="checkbox" name="study_material_b" value="yes" <?php echo ($study_material_b == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-B Paid</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="study_material_c" value="">
                                                <input type="checkbox" name="study_material_c" value="yes" <?php echo ($study_material_c == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-C Paid</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="study_material_d" value="">
                                                <input type="checkbox" name="study_material_c" value="yes" <?php echo ($study_material_d == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-D Paid</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="study_material_e" value="">
                                                <input type="checkbox" name="study_material_e" value="yes" <?php echo ($study_material_e == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-E Paid</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="study_material_e" value="">
                                                <input type="checkbox" name="study_material_e" value="yes" <?php echo ($study_material_e == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-E Paid</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="study_material_f" value="">
                                                <input type="checkbox" name="study_material_f" value="yes" <?php echo ($study_material_f == 'yes') ? 'checked' : ''; ?>>
                                                <label>Study Material-F Paid</label>
                                            </div>
                                    <br>
                                    <hr>
                                    
                                            <div>
                                                <input type="hidden" name="orientation" value="">
                                                <input type="checkbox" name="orientation" value="yes" <?php echo ($orientation_a == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation A</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="orientation_b" value="">
                                                <input type="checkbox" name="orientation_b" value="yes" <?php echo ($orientation_b == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation B</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="orientation_c" value="">
                                                <input type="checkbox" name="orientation_c" value="yes" <?php echo ($orientation_c == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation C</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="orientation_d" value="">
                                                <input type="checkbox" name="orientation_d" value="yes" <?php echo ($orientation_d == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation D</label>
                                            </div>
                                    
                                            <div>
                                                <input type="hidden" name="orientation_e" value="">
                                                <input type="checkbox" name="orientation_e" value="yes" <?php echo ($orientation_e == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation E</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="orientation_f" value="">
                                                <input type="checkbox" name="orientation_f" value="yes" <?php echo ($orientation_f == 'yes') ? 'checked' : ''; ?>>
                                                <label>Orientation F</label>
                                            </div>
                                            
                                    <br>
                                    <hr>   
                                    
                                            <div>
                                                <input type="hidden" name="mock_test" value="">
                                                <input type="checkbox" name="mock_test" value="yes" <?php echo ($mock_test == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test A</label>
                                            </div>
                                                
                                            <div>
                                                <input type="hidden" name="mock_test_b" value="">
                                                <input type="checkbox" name="mock_test_b" value="yes" <?php echo ($mock_test_b == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test B</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="mock_test_c" value="">
                                                <input type="checkbox" name="mock_test_c" value="yes" <?php echo ($mock_test_c == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test C</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="mock_test_d" value="">
                                                <input type="checkbox" name="mock_test_d" value="yes" <?php echo ($mock_test_d == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test D</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="mock_test_e" value="">
                                                <input type="checkbox" name="mock_test_e" value="yes" <?php echo ($mock_test_e == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test E</label>
                                            </div>
                                            
                                            <div>
                                                <input type="hidden" name="mock_test_f" value="">
                                                <input type="checkbox" name="mock_test_f" value="yes" <?php echo ($mock_test_f == 'yes') ? 'checked' : ''; ?>>
                                                <label>Mock Test F</label>
                                            </div>
                                        
                                        
                                            
                                            
                                        </div>
                                    
                                        <!-- Hidden Fields for Identification -->
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <input type="hidden" name="cin" value="<?php echo $row['cin']; ?>">
                                        <input type="hidden" name="competition_level_id" value="<?php echo $row['clevel']; ?>">
                                    
                                        <!-- Submit Button -->
                                        <div class="mt-3">
                                            <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                                        </div>
                                    </form>



                                </div>  
                            </div>
                    
                            
                    
    
    
			        <?php } ?>
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
            url:BASE_URL+"manage/ajax/getStateFranchiseaccount/",
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
            url:BASE_URL+"manage/ajax/product_wiselevel/",
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
 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#period_id").change(function(){
            var period_id = jQuery(this).val();
            if (period_id >= 9) {
                jQuery("#cash").show();
                jQuery("#cash1").show();
            } else {
                jQuery("#cash").hide();
                jQuery("#cash1").hide();
            }
        });
            jQuery("#choice").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    
                       
                    jQuery("#com_per").show();
                           
                }       
                if (cash_id == 'no') {
                    jQuery("#com_per").hide();
                    
                    
            }
                if (cash_id == '') {
                 jQuery("#com_per").hide();
                }
            });
               
            jQuery("#choiceavian").change(function(){
                var cash_id = jQuery(this).val();
                //alert(cash_id);
                if (cash_id == 'yes') {
                    jQuery("#com_peravian").show();
                        
                } 
                if (cash_id == 'no') {
                    jQuery("#aviansysper").hide();
                    jQuery("#com_peravian").hide();
                }
                if (cash_id == '') {
                    jQuery("#com_peravian").hide();
                    
                }
            });
            
            
            jQuery("#peravian").hide();
            jQuery("#cashavian").hide();    
            jQuery("#cash").hide();    
            jQuery("#com_per").hide();
            jQuery("#com_peravian").hide();
            jQuery("#cash1").hide();
            jQuery("#aviansysperavian").hide();    
    });
</script>            
 <style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>