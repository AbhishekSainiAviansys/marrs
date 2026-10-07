<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 
// print_r($matap);
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
				<h2><i class="icon-edit"></i> Competition <?php echo ' Activate';?></h2>
				
				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			
			<div class="box-content">
				<form class="" method="POST">
					<fieldset>
					    
				
                
                        <div>
                            <table border="1"  width='100%'>
				                <tr>
						            <th>
						                Period
						            </th>
						            <th>
						                Level
						            </th>
						            <th>
						                Subject
						            </th>
						            <th>
						                Series
						            </th>
						            <th>
						                Type
						            </th>
						            <th>
						                Start Date
						            </th>
						            <th>
						                End Date
						            </th>
						            <th>
						                Associate
						            </th>
						            <th>
						                Percentages
						            </th>
						            <th>
						                CRM
						            </th>
						            <th>
						                Prices
						            </th>
						        </tr>
						        <tbody>
                                    <tr style="text-align:center;">
						                <td><?php echo $competition->academic_year; ?></td>
						                <td><?php echo $competition->level_name; ?></td>
						                <td><?php echo $competition->subject; ?></td>
						                <td><?php echo $competition->series; ?></td>
						                <td><?php echo $competition->type; ?></td>
						                <td><?php echo $competition->start_date; ?></td>
						                <td><?php echo $competition->end_date; ?></td>
						                <td><?php echo $competition->first_name.' '.$competition->last_name; ?></td>
						                <td>
						                    Franchise : <?php echo $competition->franchise_percentage; ?> %<br>
						                    Associate : <?php echo $competition->associate_cut; ?> %<br>
						                    Management : <?php echo $competition->management_percentage; ?> %<br>
						                    Aviansys : <?php echo $competition->aviansys_percentage; ?> % <br>
						                </td>
						                <td>
						                    CRM Fix Amount : Rs <?php echo $competition->crm_fix; ?>/-
						                </td>
						                <td>
						                    Product Amount : Rs <?php echo $competition->amount; ?>/-
						                </td>
						            </tr>
						        </tbody>
						    </table>
						    
						    <div style='display:flex;'>
						        
						        <h3>Class:- </h3>&nbsp &nbsp
						        <?php 
						      //  print_r($lunar_schedule_class);
						        foreach($lunar_schedule_class as $row){ ?>
						        
						        <h3 style='color:black;'><?php echo $row->class; ?>,</h3> &nbsp &nbsp 
						        
						        <?php } ?>
						    </div>
                        </div>
                        
                        <div>
                            <br/>
                            Exam Date : <span style='color:red;'>*</span><br/>
                            <input type='date' name='exam_date' style='width:200px;' requied>
                        </div>
                        
                
                        <div class="page-header">
						  <h1><small>Check Individual Item and Enter Money for individual</small></h1>
						</div>
					
					
					
        				<table border="1"  width='100%'>		
        					<tbody>
        						  <tr>
        						      <td>Product Price<span style='color:red;'>*</span><br>
                    				        <?php ?>
                    				        <input type='text' name='product_price' style="width: 100px;" value="<?=$revenuesettingedit->product_price;?>" placeholder='Rs' required> 
                    				        
                    				        <?php ?>
                				   
        						      </td>
        						      <td>
                                            Material Free Royality<span style='color:red;'>*</span><br>
                                        
                                            <?php 
                                            $makers = $this->db->get('material_maker')->result();
                                        
                                            $maker = null;
                                        
                                            if (!empty($freemat)) {
                                                $maker = $this->db
                                                    ->get_where('material_maker', [
                                                        'material_maker_id' => $freemat->maker_id
                                                    ])
                                                    ->row();
                                            }
                                            ?>
                                        
                                            <input type="text" 
                                                   name="study_material_free_royalty" 
                                                   style="width: 100px;" 
                                                   placeholder="Rs" 
                                                   required>
                                        
                                            <select name="maker_id" required>
                                                <option value="">-- Select Maker --</option>
                                        
                                                <?php foreach($makers as $make) { ?>
                                                    <option value="<?php echo $make->material_maker_id; ?>"
                                                        <?php if (!empty($maker) && $maker->material_maker_id == $make->material_maker_id) echo 'selected'; ?>>
                                                        <?php echo $make->name; ?>
                                                    </option>
                                                <?php } ?>
                                        
                                            </select>
                                        </td>

        						      <!--<td> Mock Free Royalty<br>-->
                    				        <?php ?>
                    				        <!--<input type='text' name='mock_Test_free_royalty' style="width: 100px;" placeholder='Rs'>-->
                    				        
                    				        <?php ?>
                				   
        						      <!--</td>-->
        						  </tr>
                				    
                                <tr>
                				    
                				    
                				    <td> Material-A<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_a' value="<?=$revenuesettingedit->study_material_a;?>" <?= !empty($revenuesettingedit->study_material_a) ? 'checked' : ''; ?>  style="width: 100px;" ><br>
                				        <input type='text' name='study_material_a_price' style="width: 100px;" value="<?=$revenuesettingedit->study_material_a_price;?>" placeholder='Rs'>
                				        <br>
                				        Royalty<br>
                				        <input type='text' name='study_material_a_price_royalty' style="width: 100px;"  value="<?=$royality->study_material_a_price_royalty;?>" placeholder='Rs'>
                				        
                				        <?php ?>
                				    </td>
                				    <td> Material-B<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_b' style="width: 100px;" value="<?=$revenuesettingedit->study_material_b;?>" <?= !empty($revenuesettingedit->study_material_b) ? 'checked' : ''; ?> ><br>
                				        <input type='text' name='study_material_b_price' style="width: 100px;" value="<?=$revenuesettingedit->study_material_b_price;?>" placeholder='Rs'><br>
                				        Royalty<br>
                				        <input type='text' name='study_material_b_price_royalty' style="width: 100px;" placeholder='Rs' value="<?=$royality->study_material_b_price_royalty;?>">
                				        <?php ?>
                				    </td>
                				    <td> Material-C<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_c' style="width: 100px;" value="<?=$revenuesettingedit->study_material_c;?>" <?= !empty($revenuesettingedit->study_material_c) ? 'checked' : ''; ?>><br>
                				        <input type='text' name='study_material_c_price' style="width: 100px;" placeholder='Rs' value="<?=$revenuesettingedit->study_material_c_price;?>"><br>
                				        Royalty<br>
                				        <input type='text' name='study_material_c_price_royalty' style="width: 100px;" placeholder='Rs' value="<?=$royality->study_material_c_price_royalty;?>" >
                				        <?php ?>
                				    </td>
                				    <td> Material-D<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_d' style="width: 100px;" ><br>
                				        <input type='text' name='study_material_d_price' style="width: 100px;" placeholder='Rs'><br>
                				        Royalty<br>
                				        <input type='text' name='study_material_d_price_royalty' style="width: 100px;" placeholder='Rs'>
                				        <?php ?>
                				    </td>
                				    <td> Material-E<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_e' style="width: 100px;" ><br>
                				        <input type='text' name='study_material_e_price' style="width: 100px;" placeholder='Rs'><br>
                				        Royalty<br>
                				        <input type='text' name='study_material_e_price_royalty' style="width: 100px;" placeholder='Rs'>
                				        <?php ?>
                				    </td>
                				    <td> Material-F<br>
                				        <?php ?>
                				        <input type='checkbox' name='study_material_f' style="width: 100px;" ><br>
                				        <input type='text' name='study_material_f_price' style="width: 100px;" placeholder='Rs'><br>
                				        Royalty<br>
                				        <input type='text' name='study_material_f_price_royalty' style="width: 100px;" placeholder='Rs'>
                				        <?php ?>
                				    </td>
                				    
                				    
                				    
                				</tr>
                				
                			
                                
                                <hr>
                                
                     <!--        ======================== Orientations ==========================          -->
                            <tr>
                                <td> Orientation-A<br>
                                    <input type='checkbox' name='orientation_a' style="width: 100px;" <?= !empty($revenuesettingedit->orientation_a) ? 'checked' : ''; ?> ><br>
                                    <input type='text' name='orientation_a_price' style="width: 100px;" placeholder='Rs' value="<?=$revenuesettingedit->orientation_a_price;?>">
                				    
                                </td>
                                <td> Orientation-B <br>
                                    <input type='checkbox' name='orientation_b' style="width: 100px;" <?= !empty($revenuesettingedit->orientation_b) ? 'checked' : ''; ?>><br>
                                    <input type='text' name='orientation_b_price' style="width: 100px;" placeholder='Rs' value="<?=$revenuesettingedit->orientation_a_price;?>">
                                    
                                </td>
                                <td> Orientation-C <br>
                                    <input type='checkbox' name='orientation_c' style="width: 100px;" ><br>
                                    <input type='text' name='orientation_c_price' style="width: 100px;" placeholder='Rs'>
                                    
                                </td>
                                <td> Orientation-D <br>
                                    <input type='checkbox' name='orientation_d' style="width: 100px;" ><br>
                                    <input type='text' name='orientation_d_price' style="width: 100px;" placeholder='Rs'>
                                    
                                </td>
                                <td> Orientation-E <br>
                                    <input type='checkbox' name='orientation_e' style="width: 100px;" ><br>
                                    <input type='text' name='orientation_e_price' style="width: 100px;" placeholder='Rs'>
                                    
                                </td>
                                <td> Orientation-F <br>
                                    <input type='checkbox' name='orientation_f' style="width: 100px;" ><br>
                                    <input type='text' name='orientation_f_price' style="width: 100px;" placeholder='Rs'>
                                    
                                    
                                    
                                </td>
                            </tr>
                                
                        
                    <!--        ======================== Mock Papers ==========================          -->
                    
                            <tr>
            				    <td> MockTest-A <br>
                				    <?php ?>
                				        <input type='checkbox' name='mock_test_a' style="width: 100px;" <?= !empty($revenuesettingedit->mock_test_a) ? 'checked' : ''; ?>><br>
                				        <input type='text' name='mock_test_a_price' style="width: 100px;" value="<?=$revenuesettingedit->mock_test_a_price;?>" placeholder='Rs'><br>Royalty<br>
                				        <input type='text' name='mock_test_a_price_royalty' style="width: 100px;" value="<?=$royality->mock_test_a_price_royalty;?>" placeholder='Rs'>
            				        <?php ?>
            				    </td>
            				    <td> MockTest-B  <br>
            				    <?php ?>
            				        <input type='checkbox' name='mock_test_b' style="width: 100px;" <?= !empty($revenuesettingedit->mock_test_b) ? 'checked' : ''; ?> ><br>
            				        <input type='text' name='mock_test_b_price' style="width: 100px;" placeholder='Rs' value="<?=$revenuesettingedit->mock_test_b_price;?>"><br>Royalty<br>
            				        <input type='text' name='mock_test_b_price_royalty' style="width: 100px;" placeholder='Rs' value="<?=$royality->mock_test_b_price_royalty;?>">
            				        <?php ?>
            				    </td>
            				    <td> MockTest-C  <br>
            				    <?php ?>
            				        <input type='checkbox' name='mock_test_c' style="width: 100px;" ><br>
            				        <input type='text' name='mock_test_c_price' style="width: 100px;" placeholder='Rs'><br>Royalty<br>
            				        <input type='text' name='mock_test_c_price_royalty' style="width: 100px;" placeholder='Rs'>
            				        <?php ?>
            				    </td>
            				    <td> MockTest-D  <br>
            				    <?php ?>
            				        <input type='checkbox' name='mock_test_d' style="width: 100px;" ><br>
            				        <input type='text' name='mock_test_d_price' style="width: 100px;" placeholder='Rs'><br>Royalty<br>
            				        <input type='text' name='mock_test_d_price_royalty' style="width: 100px;" placeholder='Rs'>
            				        <?php ?>
            				    </td>
            				    <td> MockTest-E  <br>
            				    <?php ?>
            				        <input type='checkbox' name='mock_test_e' style="width: 100px;" ><br>
            				        <input type='text' name='mock_test_e_price' style="width: 100px;" placeholder='Rs'><br>Royalty<br>
            				        <input type='text' name='mock_test_e_price_royalty' style="width: 100px;" placeholder='Rs'>
            				        <?php ?>
            				    </td>
            				    <td> MockTest-F  <br>
            				        <?php ?>
            				        <input type='checkbox' name='mock_test_f' style="width: 100px;" ><br>
            				        <input type='text' name='mock_test_f_price' style="width: 100px;" placeholder='Rs'><br>Royalty<br>
            				        <input type='text' name='mock_test_f_price_royalty' style="width: 100px;" placeholder='Rs'>
            				        <?php ?>
            				    </td>
            				    
            				    
            			            
            				     
            				    
            				</tr>
                        
                               
                                
                                
                        </tbody>    
                        </table>        
                   

                  
                   
					    <div class="form-actions">
						    <button type="submit" class="btn btn-primary" id="submit" name="submit" >Update</button>
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
// 		alert(product_id);
		if (product_id == '8') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
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
                    jQuery("#com_per_gst").show();       
                }       
                if (cash_id == 'no') {
                    jQuery("#com_per").hide();
                    jQuery("#com_per_gst").hide();
                    
            }
                if (cash_id == '') {
                    jQuery("#com_per").hide();
                    jQuery("#com_per_gst").hide();
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
            
            jQuery("#series").hide();
            jQuery("#peravian").hide();
            jQuery("#cashavian").hide();    
            jQuery("#cash").hide();    
            jQuery("#com_per").hide();
            jQuery("#com_per_gst").hide();
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