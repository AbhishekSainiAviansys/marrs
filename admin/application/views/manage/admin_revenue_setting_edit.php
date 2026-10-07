<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
// 	 print_r($result);
	     
	 
 if(!empty($this->session->flashdata('updated'))){?>
<div style="background: green;
    padding: 10px;">
    <h3 style='color:#fff;'><?php echo $this->session->flashdata('updated'); ?></h3>
</div>
<?php
}
?>
<style>
    div#example_filter {
    float: right;
    position: relative;
    right: 0px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
    
</style>
  
 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Revenue-Price Setting</h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		    <form action="" method="post" > 
			    <table  cellpadding="5px" width='100%'>
				    <tr>
				    	<td>Period: <span style='color:red;'>*</span><br />
                            <select name="period" id="period" style="width: 220px;" required>
                                <option value="" >-- select period --</option>
                                
                                <?php
                                $query = $this->db->query("SELECT * FROM `period`;");
                                foreach ($query->result() as $row) {
                                    $selected = (isset($result) && $result['period_id'] == $row->period_id) ? 'selected' : '';
                                    echo "<option value='{$row->period_id}' $selected>{$row->academic_year}</option>";
                                }
                                ?>
                            </select>
                        </td>

					
					<td>Product:<span style='color:red;'>*</span><br />
                        <select name="product_id" id="product" style="width: 220px;" required>
                            <option value="" >-- select product --</option>
                            <?php
                            $query = $this->db->query("SELECT * FROM products WHERE status='Active' ORDER BY product_name");
                            foreach ($query->result() as $row) {
                                $selected = (isset($result) && $result['product_id'] == $row->product_id) ? 'selected' : '';
                                echo "<option value='{$row->product_id}' $selected>{$row->product_name}</option>";
                            }
                            ?>
                        </select>
                    </td>


				
					<td>Competition Level:<span style='color:red;'>*</span><br />
					
						
                                <select name="clevel" id="level" style="width: 220px;" required>
                                    <option value="">-- select level --</option>
                                    
                                    <?php
                                    $query = $this->db->query("SELECT * FROM `competition_level_byproduct`;");
                                    foreach ($query->result() as $row) {
                                        $selected = (isset($result) && $result['clevel'] == $row->level_id) ? 'selected' : '';
                                        echo "<option value='{$row->level_id}' $selected>{$row->level_name}</option>";
                                    }
                                    ?>
                                </select>

                        </td>          
				
					    <td>Management Percentage <span style='color:red;'>*</span><br>
                            <select name="manageper" style="width: 220px;" required>
                                <option value="">-- select management % --</option>
                                <?php
                                $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22];
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['manageper'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
                        </td>
                        
                        <td>Aviansys Percentage <span style='color:red;'>*</span><br>
                            <select name="com_peravian" style="width: 220px;" required>
                                <option value="">-- select aviansys % --</option>
                                <?php
                                $percentages = [2,3,4,5, 8, 10, 12, 15, 16, 18, 20, 22, 25, 30];
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['com_peravian'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
                        </td>


                        <td>
                            Rank Count<span style='color:red;'>*</span><br>
                            <select name="rank_count" style="width: 220px;" required>
                                <option value="">-- select Rank Count --</option>
                                <?php
                                    $percentages = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                                    foreach ($percentages as $p) {
                                        $selected = (isset($result) && $result['rank_count'] == $p) ? 'selected' : '';
                                        echo "<option value='$p' $selected>$p</option>";
                                    }
                                ?>
                            </select>
                        </td>
			
    				</tr> 
    				<tr>
				    
				        <td>Associate Percentage<br>
                            <select name="associate_per" style="width: 220px;">
                                <option value="">-- select associate % --</option>
                                <?php
                                $percentages = range(5, 60, 5); // 5, 10, ..., 60
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['associate_per'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
                        </td>
                        
                        <td>Franchise Percentage<br>
                            <select name="com_per" style="width: 220px;">
                                <option value="">-- select franchise % --</option>
                                <?php
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['com_per'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
                        </td>

				   
				        <td> CRM Fix <span style='color:red;'>*</span><br>
    				        <input type='text' name='crm_fix' style="width: 220px;" value="<?php if($result['crm_fix']){ echo $result['crm_fix']; } ?>" required>
    				    </td>
				        
				        <td>CRM Percentage<br>
                            <select name="crm_per" style="width: 220px;">
                                <option value="">-- select CRM % --</option>
                                <?php
                                $percentages = [0,1,2,3,4,5,6,7, 8,9, 10];
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['crm_per'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
                        </td>
                        
                        <hr>
    				    <td> IT%<span style='color:red;'>*</span><br>
    				        <select name="it_fix" style="width: 220px;" required>
                                <option value="">-- select IT % --</option>
                                <?php
                                $percentages = [0,1,2,3,4,5,6,7, 8,9, 10];
                                foreach ($percentages as $percent) {
                                    $selected = (isset($result) && $result['it_fix'] == $percent) ? 'selected' : '';
                                    echo "<option value='$percent' $selected>$percent%</option>";
                                }
                                ?>
                            </select>
    				    </td>
				        
				    
    				    <hr>
    				    <td> Competition Registration Price <span style='color:red;'>*</span><br>
    				        <input type='text' name='product_price' style="width: 210px;" value="<?php if($result['product_price']){ echo $result['product_price']; } ?>" required>
    				    </td>
    				    <td>
    				        Free Material Royalty <span style='color:red;'>*</span><br>
    				        <input type='text' name='study_material_free_royalty' style="width: 100px;" value="<?php if($result['study_material_free_royalty']){ echo $result['study_material_free_royalty']; } ?>" required>
    				    
    				    </td>
				</tr>

				<tr>
				    <td colspan='11'></td>
				</tr>
				<tr>
				    <td> Bundle-A Price <br>
				        <input type='text' name='bundle_price_a' style="width: 100px;" value="<?php if($result['bundle_price_a']){ echo $result['bundle_price_a']; } ?>">
				        <br>
				        Bundle-A Royalty <br>
				        <input type='text' name='bundle_price_a_royality' style="width: 100px;" value="<?php if($result['bundle_price_a_royality']){ echo $result['bundle_price_a_royality']; } ?>">
				    </td>
				    <td> Bundle-B Price <br>
				        <input type='text' name='bundle_price_b' style="width: 100px;" value="<?php if($result['bundle_price_b']){ echo $result['bundle_price_b']; } ?>">
				        <br>
				        Bundle-B Royalty <br>
				        <input type='text' name='bundle_price_b_royality' style="width: 100px;" value="<?php if($result['bundle_price_b_royality']){ echo $result['bundle_price_b_royality']; } ?>">
				    </td>
				    <td> Bundle-C Price <br>
				        <input type='text' name='bundle_price_c' style="width: 100px;" value="<?php if($result['bundle_price_c']){ echo $result['bundle_price_c']; } ?>">
				        <br>
				        Bundle-C Royalty <br>
				        <input type='text' name='bundle_price_c_royality' style="width: 100px;" value="<?php if($result['bundle_price_c_royality']){ echo $result['bundle_price_c_royality']; } ?>">
				    </td>
				    <td> Bundle-D Price <br>
				        <input type='text' name='bundle_price_d' style="width: 100px;" value="<?php if($result['bundle_price_d']){ echo $result['bundle_price_d']; } ?>">
				        <br>
				        Bundle-D Royalty <br>
				        <input type='text' name='bundle_price_d_royality' style="width: 100px;" value="<?php if($result['bundle_price_d_royality']){ echo $result['bundle_price_d_royality']; } ?>">
				    </td>
				    <td> Bundle-E Price <br>
				        <input type='text' name='bundle_price_e' style="width: 100px;" value="<?php if($result['bundle_price_e']){ echo $result['bundle_price_e']; } ?>">
				        <br>
				        Bundle-E Royalty <br>
				        <input type='text' name='bundle_price_e_royality' style="width: 100px;" value="<?php if($result['bundle_price_e_royality']){ echo $result['bundle_price_e_royality']; } ?>">
				    </td>
				    <td> Bundle-F Price <br>
				        <input type='text' name='bundle_price_f' style="width: 100px;" value="<?php if($result['bundle_price_f']){ echo $result['bundle_price_f']; } ?>">
				        <br>
				        Bundle-F Royalty <br>
				        <input type='text' name='bundle_price_f_royality' style="width: 100px;" value="<?php if($result['bundle_price_f_royality']){ echo $result['bundle_price_f_royality']; } ?>">
				    </td>
				</tr>
				
				<tr>
				    
				    
				    <td > Material-A Price <br>
				        <input type='text' name='study_material_a_price' style="width: 100px;" value="<?php if($result['study_material_a_price']){ echo $result['study_material_a_price']; } ?>">
				        <br>
				        Material-A Royalty <br>
				        <input type='text' name='study_material_a_price_royalty' style="width: 100px;" value="<?php if($result['study_material_a_price_royalty']){ echo $result['study_material_a_price_royalty']; } ?>" >
				    </td>
				    <td> Material-B Price <br>
				        <input type='text' name='study_material_b_price' style="width: 100px;" value="<?php if($result['study_material_b_price']){ echo $result['study_material_b_price']; } ?>">
				        <br>
				        Material-B Royalty <br>
				        <input type='text' name='study_material_b_price_royalty' style="width: 100px;" value="<?php if($result['study_material_b_price_royalty']){ echo $result['study_material_b_price_royalty']; } ?>">
				    
				    </td>
				    <td> Material-C Price <br>
				        <input type='text' name='study_material_c_price' style="width: 100px;" value="<?php if($result['study_material_c_price']){ echo $result['study_material_c_price']; } ?>">
				        <br>Material-C Royalty <br>
				        <input type='text' name='study_material_c_price_royalty' style="width: 100px;" value="<?php if($result['study_material_c_price_royalty']){ echo $result['study_material_c_price_royalty']; } ?>">
				    
				    </td>
				    <td> Material-D Price <br>
				        <input type='text' name='study_material_d_price' style="width: 100px;" value="<?php if($result['study_material_d_price']){ echo $result['study_material_d_price']; } ?>">
				        <br>Material-D Royalty <br>
				        <input type='text' name='study_material_d_price_royalty' style="width: 100px;" value="<?php if($result['study_material_d_price_royalty']){ echo $result['study_material_d_price_royalty']; } ?>">
				    
				    </td>
				    <td> Material-E Price <br>
				        <input type='text' name='study_material_e_price' style="width: 100px;" value="<?php if($result['study_material_e_price']){ echo $result['study_material_e_price']; } ?>">
				        <br>Material-F Royalty <br>
				        <input type='text' name='study_material_e_price_royalty' style="width: 100px;" value="<?php if($result['study_material_e_price_royalty']){ echo $result['study_material_e_price_royalty']; } ?>">
				    
				    </td>
				    <td> Material-F Price<br>
				        <input type='text' name='study_material_f_price' style="width: 100px;" value="<?php if($result['study_material_f_price']){ echo $result['study_material_f_price']; } ?>">
				        <br>Material-F Royalty<br>
				        <input type='text' name='study_material_f_price_royalty' style="width: 100px;" value="<?php if($result['study_material_f_price_royalty']){ echo $result['study_material_f_price_royalty']; } ?>">
				    
				    </td>
				    
				    
				</tr>
				
				<tr>
				    <td colspan='11'></td>
				</tr>
				<tr>
				    
				    
				        <td> Orientation-A Price <br>
    				        <input type='text' name='orientation_a_price' style="width: 210px;" value="<?php if($result['orientation_a_price']){ echo $result['orientation_a_price']; } ?>">
    				    </td>
    				    <td> Orientation-B Price <br>
    				        <input type='text' name='orientation_b_price' style="width: 210px;" value="<?php if($result['orientation_b_price']){ echo $result['orientation_b_price']; } ?>">
    				    </td>
    				    <td> Orientation-C Price <br>
    				        <input type='text' name='orientation_c_price' style="width: 210px;" value="<?php if($result['orientation_c_price']){ echo $result['orientation_c_price']; } ?>">
    				    </td>
				    
				        <td> Orientation-D Price <br>
    				        <input type='text' name='orientation_d_price' style="width: 210px;" value="<?php if($result['orientation_d_price']){ echo $result['orientation_d_price']; } ?>">
    				    </td>
    				    <td> Orientation-E Price <br>
    				        <input type='text' name='orientation_e_price' style="width: 210px;" value="<?php if($result['orientation_e_price']){ echo $result['orientation_e_price']; } ?>">
    				    </td>
    				    <td> Orientation-F Price <br>
    				        <input type='text' name='orientation_f_price' style="width: 210px;" value="<?php if($result['orientation_f_price']){ echo $result['orientation_f_price']; } ?>">
    				    </td>
				    
				    
				</tr>
				
				<tr>
				    <td> MockTest-A Price <br>
				        <input type='text' name='mock_test_a_price' style="width: 100px;" value="<?php if($result['mock_test_a_price']){ echo $result['mock_test_a_price']; } ?>">
				        <br>MockTest-A Royalty<br>
				        <input type='text' name='mock_test_a_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_a_price_royalty']){ echo $result['mock_test_a_price_royalty']; } ?>">
				    
				    </td>
				    <td> MockTest-B Price <br>
				        <input type='text' name='mock_test_b_price' style="width: 100px;" value="<?php if($result['mock_test_b_price']){ echo $result['mock_test_b_price']; } ?>">
				        <br>MockTest-B Royalty<br>
				        <input type='text' name='mock_test_b_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_b_price_royalty']){ echo $result['mock_test_b_price_royalty']; } ?>">
				    
				    </td>
				    <td> MockTest-C Price <br>
				        <input type='text' name='mock_test_c_price' style="width: 100px;" value="<?php if($result['mock_test_c_price']){ echo $result['mock_test_c_price']; } ?>">
				        <br>MockTest-C Royalty<br>
				        <input type='text' name='mock_test_c_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_c_price_royalty']){ echo $result['mock_test_c_price_royalty']; } ?>">
				    
				    </td>
				    <td> MockTest-D Price <br>
				        <input type='text' name='mock_test_d_price' style="width: 100px;" value="<?php if($result['mock_test_d_price']){ echo $result['mock_test_d_price']; } ?>">
				        <br>MockTest-D Royalty<br>
				        <input type='text' name='mock_test_d_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_d_price_royalty']){ echo $result['mock_test_d_price_royalty']; } ?>">
				    
				    </td>
				    <td> MockTest-E Price <br>
				        <input type='text' name='mock_test_e_price' style="width: 100px;" value="<?php if($result['mock_test_e_price']){ echo $result['mock_test_e_price']; } ?>">
				        <br>MockTest-E Royalty<br>
				        <input type='text' name='mock_test_e_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_e_price_royalty']){ echo $result['mock_test_e_price_royalty']; } ?>">
				    
				    </td>
				    <td> MockTest-F Price <br>
				        <input type='text' name='mock_test_f_price' style="width: 100px;" value="<?php if($result['mock_test_f_price']){ echo $result['mock_test_f_price']; } ?>">
				        <br>MockTest-F Royalty<br>
				        <input type='text' name='mock_test_f_price_royalty' style="width: 100px;" value="<?php if($result['mock_test_f_price_royalty']){ echo $result['mock_test_f_price_royalty']; } ?>">
				    
				    </td>
				    
				    
			            
				     
				    
				</tr>
				<tr>
				    <td> <br /><input type="submit" name="submit" value="Update" class='btn btn-info btn-lg' /> </td>
			        <td> <br /><input type="submit" name="back" value="Back To List" class='btn btn-warning btn-lg' /> </td>
				</tr>
		   </table>		 
		 
		    <br />
		</form>
		
	 
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php if(isset($message)){ ?>
        <h2><?php echo $message; ?></h2>
   <?php } ?>
   
   <?php if(isset($message1)){ ?>
        <h2><?php echo $message1; ?></h2>
   <?php } ?>
<div class="row-fluid sortable">
   
   
   



    
</div>

<script>
$(document).ready(function() {
    // Hide these divs initially
    $('#subjectdiv').hide();
    $('#varientdiv').hide();
    $('#seriesdiv').hide();

    $("#product").change(function() {
        var product_id = this.value;

        if (product_id === '8') {  // Compare as string
            $('#subjectdiv').show();
            $('#varientdiv').show();
            $('#seriesdiv').show();
        } else {
            $('#subjectdiv').hide();
            $('#varientdiv').hide();
            $('#seriesdiv').hide();
        }

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
            data: { product_id: product_id },
            type: 'POST',
            success: function(result) {
                $("#level").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#subject").change(function() {
        var subject_key = this.value;

        

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_subject_key",
            data: { subject_key: subject_key },
            type: 'POST',
            success: function(result) {
                $("#varient").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#varient").change(function() {
        var varient = this.value;
        var subject_key = $('#subject').val();
        var period = $('#period').val();


        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_series",
            data: { subject_key: subject_key,varient:varient,period:period },
            type: 'POST',
            success: function(result) {
                $("#series").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    
    
    
});
</script>


<?php include('footer.php'); ?>