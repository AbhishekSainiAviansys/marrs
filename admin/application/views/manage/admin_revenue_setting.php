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
  
 
<!--<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>


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
    	
    		<form action="" method="post" class="border rounded">

                <div class="container-fluid">

                    <!-- TOP SECTION -->
                    <div class="row g-3">
                    
                        <!-- Period -->
                        <div class="col-md-2">
                            <label class="form-label">Period *</label>
                            <select name="period" class="form-select" required>
                                <option value="">-- select period --</option>
                                <?php
                                    $query = $this->db->query("SELECT * FROM period");
                                    foreach ($query->result() as $row) {
                                        $selected = (isset($result) && $result['period'] == $row->period_id) ? 'selected' : '';
                                        echo "<option value='{$row->period_id}' $selected>{$row->academic_year}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    
                        <!-- Product -->
                        <div class="col-md-2">
                            <label class="form-label">Product *</label>
                        
                            <select name="product_id" id="product" class="form-select" required>
                                <option value="">-- select product --</option>
                        
                                <?php
                                $query = $this->db->query("
                                    SELECT * 
                                    FROM products 
                                    WHERE status='Active' 
                                    ORDER BY product_name
                                ");
                        
                                foreach ($query->result() as $row) {
                                    $selected = (isset($result) && $result['product_id'] == $row->product_id)
                                        ? 'selected'
                                        : '';
                        
                                    echo "<option value='{$row->product_id}' $selected>
                                            {$row->product_name}
                                          </option>";
                                }
                                ?>
                            </select>
                        </div>
                    
                        <!-- Level -->
                        <div class="col-md-2">
                            <label class="form-label">Competition Level *</label>
                        
                            <select name="clevel" id="level" class="form-select" required>
                                <option value="">-- select level --</option>
                            </select>
                        </div>
                    
                        <!-- Management % -->
                        <div class="col-md-2">
                            <label class="form-label">Management % *</label>
                            <select name="manageper" class="form-select" required>
                                <option value="">-- select --</option>
                                <?php
                                    $percentages = [2,3,4,5,8,10,12,15,16,18,20,22];
                                    foreach ($percentages as $p) {
                                        $selected = (isset($result) && $result['manageper'] == $p) ? 'selected' : '';
                                        echo "<option value='$p' $selected>$p%</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    
                        <!-- Aviansys % -->
                        <div class="col-md-2">
                            <label class="form-label">Aviansys % *</label>
                            <select name="com_peravian" class="form-select" required>
                                <option value="">-- select --</option>
                                <?php
                                    $percentages = [2,3,4,5,8,10,12,15,16,18,20,22,25,30];
                                    foreach ($percentages as $p) {
                                        $selected = (isset($result) && $result['com_peravian'] == $p) ? 'selected' : '';
                                        echo "<option value='$p' $selected>$p%</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Rank count -->
                        <div class="col-md-2">
                            <label class="form-label">Rank Count*</label>
                            <select name="rank_count" class="form-select" required>
                                <option value="">-- select Rank Count --</option>
                                <?php
                                    $percentages = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                                    foreach ($percentages as $p) {
                                        $selected = (isset($result) && $result['rank_count'] == $p) ? 'selected' : '';
                                        echo "<option value='$p' $selected>$p</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    
                    </div>

                    <!-- SECOND ROW -->
                    <div class="row g-3 mt-1">
                    
                        <div class="col-md-2">
                            <label class="form-label">Associate %</label>
                            <select name="associate_per" class="form-select">
                                <option value="">-- select --</option>
                                <?php
                                for ($i=5;$i<=60;$i+=5){
                                    $selected = (isset($result) && $result['associate_per'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="col-md-2">
                            <label class="form-label">Franchise %</label>
                            <select name="com_per" class="form-select">
                                <option value="">-- select --</option>
                                <?php
                                for ($i=5;$i<=60;$i+=5){
                                    $selected = (isset($result) && $result['com_per'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="col-md-2">
                            <label class="form-label">CRM %</label>
                            <select name="crm_per" class="form-select">
                                <option value="">-- select --</option>
                                <?php
                                for ($i=0;$i<=10;$i++){
                                    $selected = (isset($result) && $result['crm_per'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="col-md-2">
                            <label class="form-label">IT%</label>
                            <select name="it_fix" class="form-select" required>
                                <option value="">-- select IT% --</option>
                                <?php
                                for ($i=0;$i<=10;$i++){
                                    $selected = (isset($result) && $result['it_fix'] == $i) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i%</option>";
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="col-md-2">
                            <label class="form-label">Competition Price *</label>
                            <input type="text" name="product_price" class="form-control"
                                value="<?php if(!empty($result['product_price'])) echo $result['product_price']; ?>">
                        </div>
                    
                        <div class="col-md-2">
                            <label class="form-label">Free Material Royalty *</label>
                            <input type="text" name="study_material_free_royalty" class="form-control" required
                                value="<?php if(!empty($result['study_material_free_royalty'])) echo $result['study_material_free_royalty']; ?>">
                        </div>
                    
                    </div>

                    <!-- BUNDLE PRICE -->
                    <h5 class="mt-4">Bundle Prices</h5>
                    <div class="row g-3">
                        <?php foreach(['a','b','c','d','e','f'] as $l){ ?>
                            <div class="col-md-2">
                                <label class="form-label">Material <?= strtoupper($l) ?></label>
                                <input type="text" name="bundle_price_<?= $l ?>" class="form-control"
                                    value="<?php if(!empty($result['bundle_price_'.$l])) echo $result['bundle_price_'.$l]; ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <!-- BUNDLE ROYALTY -->
                    <h5 class="mt-4">Bundle Royalty</h5>
                    <div class="row g-3">
                        <?php foreach(['a','b','c','d','e','f'] as $l){ ?>
                            <div class="col-md-2">
                                <label class="form-label">Royalty <?= strtoupper($l) ?></label>
                                <input type="text" name="bundle_price_<?= $l ?>_royality" class="form-control"
                                    value="<?php if(!empty($result['bundle_price_'.$l.'_royality'])) echo $result['bundle_price_'.$l.'_royality']; ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <!-- MATERIAL PRICE + ROYALTY -->
                    <h5 class="mt-4">Study Material</h5>
                    <div class="row g-3">
                        <?php foreach(['a','b','c','d','e','f'] as $l){ ?>
                            <div class="col-md-2">
                                <label>Material <?= strtoupper($l) ?></label>
                                <input type="text" name="study_material_<?= $l ?>_price" class="form-control mb-1"
                                    value="<?php if(!empty($result['study_material_'.$l.'_price'])) echo $result['study_material_'.$l.'_price']; ?>">
                                
                                <input type="text" name="study_material_<?= $l ?>_price_royalty" class="form-control"
                                    placeholder="Royalty"
                                    value="<?php if(!empty($result['study_material_'.$l.'_price_royalty'])) echo $result['study_material_'.$l.'_price_royalty']; ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <!-- ORIENTATION -->
                    <h5 class="mt-4">Orientation</h5>
                    <div class="row g-3">
                        <?php foreach(['a','b','c','d','e','f'] as $l){ ?>
                            <div class="col-md-2">
                                <label>Orientation <?= strtoupper($l) ?></label>
                                <input type="text" name="orientation_<?= $l ?>_price" class="form-control"
                                value="<?php if(!empty($result['orientation_'.$l.'_price'])) echo $result['orientation_'.$l.'_price']; ?>">
                            </div>
                        <?php } ?>
                    </div>

                    <!-- MOCK TEST -->
                    <h5 class="mt-4">Mock Test</h5>
                    <div class="row g-3">
                        <?php foreach(['a','b','c','d','e','f'] as $l){ ?>
                            <div class="col-md-2">
                                <label>Mock <?= strtoupper($l) ?></label>
                                    <input type="text" name="mock_test_<?= $l ?>_price" class="form-control mb-1"
                                    value="<?php if(!empty($result['mock_test_'.$l.'_price'])) echo $result['mock_test_'.$l.'_price']; ?>">
                                    
                                <input type="text" name="mock_test_<?= $l ?>_price_royalty" class="form-control"
                                    placeholder="Royalty"
                                    value="<?php if(!empty($result['mock_test_'.$l.'_price_royalty'])) echo $result['mock_test_'.$l.'_price_royalty']; ?>">
                            </div>
                        <?php } ?>
                    </div>
                    
                    <!-- SUBMIT -->
                    <div class="mt-4">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg">
                        Submit
                        </button>
                    </div>
            
                </div>
                
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
    
    
            <form  method="POST" class="border">
            
                <div class="box span12">
                
    			        <div class="box-header well" data-original-title>
    						<h2><i class="icon-user"></i>Search Revenue Setting</h2>
    
    					</div>
    					
    		        <table  cellpadding="5px" width='100%' class="border">
        			    <tr>
        			    	<td>Period: <span style='color:red;'>*</span><br />
                                <select name="period" id="period" class="form-control" required>
                                    <option value="" >-- Select period --</option>
                                    
                                    <?php
                                    $query = $this->db->query("SELECT * FROM `period` where period_id > 13;");
                                    foreach ($query->result() as $row) {
                                        $selected = (isset($ress) && $ress['period'] == $row->period_id) ? 'selected' : '';
                                        echo "<option value='{$row->period_id}' $selected>{$row->academic_year}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
        
        				
        				    <td>Product:<span style='color:red;'>*</span><br />
                                <select name="product_id" id="product1" class="form-control" required>
                                    <option value="" >-- Select product --</option>
                                    
                                        <?php
                                        $query = $this->db->query("SELECT * FROM products WHERE status='Active' ORDER BY product_name");
                                        foreach ($query->result() as $row) {
                                            $selected = (isset($ress) && $ress['product_id'] == $row->product_id) ? 'selected' : '';
                                            echo "<option value='{$row->product_id}' $selected>{$row->product_name}</option>";
                                        }
                                        ?>
                                </select>
                            </td>
        
        
        			
        				    <td>Competition Level:<span style='color:red;'>*</span><br />
                                <select name="clevel" id="level1" class="form-control" required>
                                    <option value="">-- Select level --</option>
                                    
                                    <?php
                                        if(isset($ress)){
                                            foreach ($level_load as $row) {
                                                $selected = (isset($ress) && $ress['clevel'] == $row->level_id) ? 'selected' : '';
                                                echo "<option value='{$row->level_id}' $selected>{$row->level_name}</option>";
                                            }
                                        }
                                    ?>
                                </select>
        
                            </td>          
        			
        				   
        			
        			        <td> <br /><input type="submit" name="search" value="search" class='btn btn-warning btn-lg text-capitalize' /> </td>
        		           
        			    </tr>
    			    
    	            </table>		 
    		 
    		    </div>  
    		
    	    </form>
  
        
			<div style="margin:20px;">		
				<div class="box span12">
				    
					<div class="box-header well" data-original-title>
					    <?php if(isset($mess)){ ?>
						<h2><i class="icon-user"></i><?php echo $mess; ?></h2>
						<?php }else{ ?>
						<h2><i class="icon-user"></i>Revenue Setting Last 10 Added List or filtered setting list</h2>
						<?php } ?>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin:20px;">
    					 <?php 
                	                
                	    if(!empty($list_materials)){ ?>
    					
                      
        					<table  id="example" class="table table-striped table-bordered" style="width:100%;">
        					    
                    	        <thead>
                            			<tr>
                            	            <th>Sr. No.</th>
                            	            <th> Product </th>
                            	            <th> Period </th>
                            	            <th> Level </th>
                            	            <th> Rank Count </th>
                            	            <th> CRM / IT</th>
                            	            <th> Franchise </th>
                            	            <th> Management </th>
                            	            <th> Associate </th>
                            	            <th> Registration Price </th>
                            	            <th> Bundle Price </th>
                            	            <th> Material Price </th>
                            	            <th> MockTest Price</th>
                            	            <th> Orientation Price</th>
                            	            <th> Option</th>
                            	        </tr>
                    	          </thead> 
                    	          
                    	        <form method="POST">
                    	            
        				            <tbody>
                	                <?php 
                	                
                	                   // if(!empty($list_materials)){
                            	            //print_r($list_materials);
                            	           
                            	            $i=1;
                            	            foreach($list_materials as $row){ //print_r($row);die;
                            	            ?>
                    	           
                            	            <tr>
                            	                <td><?php echo $i;?></td>
                            	                <td><?php 
                        	                    if($row['product_name'] == 'Lunar Skill Test'){
                        	                        echo $row['product_name'].'<br>';
                        	                        echo $row['subject'].'<br>';
                        	                        echo $row['sub_type'].'<br>';
                        	                        echo $row['series'];
                        	                    }else{
                        	                        echo $row['product_name']; 
                        	                    }
                        	                ?></td>
                        	                <td><?php 
                        	                    
                        	                            $query = $this->db->query("SELECT academic_year FROM period where period_id='{$row['period_id']}' ");
                        									    $result=$query->row();
                        	                            echo $result->academic_year; 
                        	                    ?>
                        	                </td>
                        	                <td><?php 
                    	                
                    	                    $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where level_id='{$row['clevel']}' and product_name='{$row['product_name']}' ");
        									    
        									    $result=$query->row();
        									   // print_r($result);
        									    echo $result->level_name;
        									    
                                	                   // echo $row['clevel'].$row['product_name']; 
                                	                
                                	                ?></td>
                                	                <td><?php echo $row['rank_count']; ?></td>
                                	                <td><?php echo $row['crm_fix'].' Rs'.'<br>'.'IT :'. $row['crm_fix'].'%'; ?>
                                	                
                                	                </td>
                                	                <td>
                                	                    <?php 
                                	                    
                                	                    //echo $row['com_per'];
                                	                    
                                	                    
                                									if(!empty($row['com_per'])){
                                									    
                                									    echo $row['com_per'].' %';
                                									    
                                									}
                                									else{
                                									    echo 'Not Assigned to franchise.';  
                                									}
                                									
                                									?>
                                	                </td>
                                	                
                                	                <td>
                                	                            <?php if(!empty($row['manageper'])){
                                									    
                                									    echo $row['manageper'].' %';
                                									    
                                									}
                                									else{
                                									    echo 'Not Assigned to Management.';  
                                									}
                                									
                                									?>
                                					</td>
                                					
                                	                <td><?php 
                                	                                if(!empty($row['associate_per'])){
                                									    
                                									    echo $row['associate_per'].' %';
                                									    
                                									}
                                									else{
                                									    echo 'Not Assigned to associate.';  
                                									}
                                									
                                									?>
                                					</td>
                                	                <td>
                                	                    <?php 
                                	                        echo $row['product_price'].' Rs'; 
                                	                        echo '<br> Free Material Royalty:'.$row['study_material_free_royalty'].' Rs';
                                	                    ?>
                                	                </td>
                                	                    	                <td><?php echo 'A : '.$row['bundle_price_a'].'<br> B : '.$row['bundle_price_b'].'<br> C : '.$row['bundle_price_c']; ?></td>
                            
                                	                <td><?php echo 'A : '.$row['study_material_a_price'].' Royalty '.$row['study_material_a_price_royalty'].'<br> B : '.$row['study_material_b_price'].' Royalty '.$row['study_material_b_price_royalty'].'<br> C : '.$row['study_material_c_price'].' Royalty '.$row['study_material_c_price_royalty'].'<br> D : '.$row['study_material_d_price'].' Royalty '.$row['study_material_d_price_royalty'].'<br> E : '.$row['study_material_e_price'].' Royalty '.$row['study_material_e_price_royalty'].'<br> F : '.$row['study_material_f_price'].' Royalty '.$row['study_material_f_price_royalty']; ?></td>
                                	                
                                	                <td><?php echo 'A : '.$row['mock_test_a_price'].' Royalty '.$row['mock_test_a_price_royalty'].'<br> B : '.$row['mock_test_b_price'].' Royalty '.$row['mock_test_b_price_royalty'].'<br> C : '.$row['mock_test_c_price'].' Royalty '.$row['mock_test_c_price_royalty'].'<br> D : '.$row['mock_test_d_price'].' Royalty '.$row['mock_test_d_price_royalty'].'<br> E : '.$row['mock_test_e_price'].' Royalty '.$row['mock_test_e_price_royalty'].'<br> E : '.$row['mock_test_f_price'].' Royalty '.$row['mock_test_f_price_royalty']; ?></td>
                                	                
                                	                <td><?php echo 'A : '.$row['orientation_a_price'].'<br> B : '.$row['orientation_b_price'].'<br> C : '.$row['orientation_c_price']; ?></td>
                            
                                	                
                                	                 <td align="CENTER">
                                                        <button 
                                                            name="delete" 
                                                            value="<?php echo $row['id']; ?>" 
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this entry ?');"
                                                        >
                                                            Delete
                                                        </button>
                                                        
                                                        <a 
                                                            href="https://marrs.in/admin/manage/franchise/admin_revenue_setting_edit/<?php echo $row['id']; ?>" 
                                                            class="btn btn-primary"
                                                            
                                                        >
                                                            Edit
                                                        </a>
                                                        
                                                    </td>
                                
                                					  
                                	            </tr>
                                	        <?php 
                                	           $i++; 
                            	               
                            	            }
                                	       //}
                                	       //else{echo 'No Revenue Setting Found';}?>
        	       	                </tbody>
        	       	            
        	       	            </form>
        	       	            
        	                </table>
        	                
    				    
			            <?php } ?>
			        </div>
			        <!--/span-->
			        
			    </div>
			    
			</div>
    

    
    </div>



<script>

    

$(document).ready(function() {

    $("#product").change(function() {

        var product_id = this.value;

        $.ajax({
            url: "<?php echo base_url();?>manage/ajax/productwiselevel",
            data: {
                product_id: product_id
            },
            type: "POST",

            success: function(result) {
                $("#level").html(result);
            },

            error: function(xhr, status, error) {
                console.log(error);
                alert("An error occurred while fetching competition levels.");
            }
        });

    });

    // Load levels automatically if product is already selected
    if ($("#product").val() != "") {
        $("#product").trigger("change");
    }

});
</script>



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
            url: "<?php echo base_url();?>manage/ajax/productwiselevel",
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
            url: "<?php echo base_url();?>manage/ajax/getlunar_subject_key",
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
            url: "<?php echo base_url();?>manage/ajax/getlunar_series",
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
    
    $("#product1").change(function() {
        var product_id = this.value;
      $.ajax({
            url: "<?php echo base_url();?>manage/ajax/productwiselevel",
            data: { product_id: product_id },
            type: 'POST',
            success: function(result) {
                $("#level1").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $("#level").change(function() {
        if (this.value === "1") { // compare with string
            $('#product_price').hide();
        } else {
            $('#product_price').show();
        }
    });

    // Optional: Trigger change on load to reflect initial state
    $("#level").trigger('change');
});
</script>



<?php include('footer.php'); ?>