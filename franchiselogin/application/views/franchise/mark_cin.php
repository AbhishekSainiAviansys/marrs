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
    						        <label>CIN <span style='color:red;'>*</span></label>
    						        <input type='text' name='cin'  style='width:180px;' required>
    						    </div>
    						        
                            
                            
    							<div style='padding-left:20px;'>
    							    <label>Product<span style='color:red;'>*</span></label>
    							    <select name="product_name" id="product_name" style='width:180px;' required>
    									<option value="">Select</option>
    									<?php foreach($product as $val) { ?>
    									<option value="<?php echo $val['product_id'] ?>" <?php if( isset( $result['product_name'] ) ) if($result['product_name'] == $val['product_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['product_name'] ?></option>
    									<?php } ?>    
    								</select> 
    							</div> 
    							
    							<div id='series'>
					            
					            <label>Subject</label>
							    <select name="subject" id="subject" style="width: 220px;"  >
                                    <option value=''>-- select subject --</option>
                                    <?php
                                     
                                     $query = $this->db->query("SELECT * FROM lunar_subjects;");
                                    //$query = $this->db->get_where('areas', isset($result['state_id']) ? array('state_id' => $result['state_id']) : null)->result();

                                     foreach ($query->result() as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row->subject_key;?>'<?php  if($result['subject_key']==$row->subject_key) { echo 'selected="selected"'; } ?>><?php echo $row->subject_key;?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select> 
					            
					            
							    <label>Lunar Series</label>
							    
							    <select name="serie" id="serie" style="width: 220px;"  >
                                    
                                    
                                
                                    
                                </select>  
							    
							     
							    <label>Lunar Type</label>
							    
							    <select name="type" id="type" style="width: 220px;"  >
                                    
                                    
                                
                                    
                                </select>      
							    
							</div> 
    							
    							
    							  
    							<div style='padding-left:20px;'>
    							    <label>C-Level<span style='color:red;'>*</span></label>
    							    <select name="competition_level_id" id="competition_level_id" style='width:180px;' required>
    									<option value="">Select</option>
    									<?php foreach($level as $val) { ?>
    									<option value="<?php echo $val['level_id'] ?>" <?php if( isset( $result['level_name'] ) ) if($result['level_name'] == $val['level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['level_name'] ?></option>
    									<?php } ?>    
    								</select> 
    							</div> 
    							
                                
    							<div style='padding-left:20px;'>
    							    <label>Amount</label>
    							    <input type='text' name='product_price' placeholder='Rs.' style='width:180px;' >
    							</div> 
							
							    <div style='padding-left:20px;'>
        						    <label>Paid Date</label>
        						    <input type='date' name='close_date' style='width:180px;' >
        						</div>
							   
                            </div>   
                           
                            
                        <hr>
                          
                        <div style='display:flex;'>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_a'>
                                <label>Study Material-A Paid</label>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_b'>
                                <label>Study Material-B Paid</label>
                                
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_c'>
                                <label>Study Material-C Paid</label>
                                
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_d'>
                                <label>Study Material-D Paid</label>
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_e'>
                                <label>Study Material-E Paid</label>
                                
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='study_material_f'>
                                <label>Study Material-F Paid</label>
                                
                            </div>
                            
                        </div>   
                           
                            
                        <hr>
                          
                        <div style='display:flex;'>    
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_a'>
                                <label>Orientation A</label>
                                
                            </div>
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_b'>
                                <label>Orientation B</label>
                                
                            </div>
                            
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_c'>
                                <label>Orientation C</label>
                                
                            </div>
                            
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_d'>
                                <label>Orientation D</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_e'>
                                <label>Orientation E</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='orientation_f'>
                                <label>Orientation F</label>
                                
                            </div>
                            
                    </div>   
                           
                            
                        <hr>
                          
                        <div style='display:flex;'>        
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test'>
                                <label>Mock Test A</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test_b'>
                                <label>Mock Test B</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test_c'>
                                <label>Mock Test C</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test_d'>
                                <label>Mock Test D</label>
                                
                            </div>
                            
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test_e'>
                                <label>Mock Test E</label>
                                
                            </div>
                            
                            <div class="vl" style='margin-left:20px;'></div>
                            <div style='margin-left:20px;'>
                                <input type='checkbox' name='mock_test_f'>
                                <label>Mock Test F</label>
                                
                            </div>
                            
                        </div>   
                          
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

<!--<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">

$(document).ready(function(){
  // Hide initially
    $("#series").hide();

    // On dropdown change
    $("#product_name").on("change", function () {
        var product = $(this).val();

        if (product == '8') {
            $("#series").show();
        } else {
            $("#series").hide();
        }
    });

   

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
    
    
    $("#subject").change(function(){
        var subject_key =this.value;
         //alert(franchise_id);
         var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/getlunar_series_per_subject",
        data:{subject_key:subject_key},
        type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#serie").html(result);
            	 
            
            }});
        });
    
    $("#serie").change(function(){
        var serie = this.value;
         //alert(franchise_id);
         var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/getlunar_type_per_serie",
        data:{serie:serie},
        type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#type").html(result);
            	 
            
            }});
        });
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