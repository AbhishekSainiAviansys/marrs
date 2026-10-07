<?php include('header.php');
$dateParts = explode(' ', $result['competition_date']);
$date = $dateParts[0]; 

//print_r($arr);
?>

<style>/* ===== SLIM TOGGLE (Option C) ===== */
.slim-wrap  { display: flex; align-items: center; gap: 8px; }
.slim-toggle { position: relative; width: 36px; height: 20px; display: inline-block; }
.slim-toggle input { opacity: 0; width: 0; height: 0; position: absolute; }
.slim-slider { position: absolute; inset: 0; background: #D3D1C7; border-radius: 10px; cursor: pointer; transition: background .2s; }
.slim-slider:before { content: ''; position: absolute; width: 14px; height: 14px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: transform .2s; }
.slim-toggle input:checked + .slim-slider { background: #1D9E75; }
.slim-toggle input:checked + .slim-slider:before { transform: translateX(16px); }
.slim-lbl { font-size: 12px; min-width: 48px; }
.slim-lbl.on  { color: #0F6E56; font-weight: 500; }
.slim-lbl.off { color: #888; }
.dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; margin-right: 4px; vertical-align: middle; }
.dot-on  { background: #1D9E75; }
.dot-off { background: #D3D1C7; }

.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>
	
			<div class="row-fluid sortable">
			
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h1><small>Active Competition List</small></h1>
					</div>
					<div class="box-content">
						

                         
		                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
                                <div class="form-actions border p-3">
                                    <div class="row">
                                
                                        <!-- Country -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="country">
                                                Country<span style="color:red;">*</span>
                                            </label>
                                
                                            <select name="country" id="country" class="form-control" required>
                                                <option value="">Select Country</option>
                                
                                                <option value="105" <?php if($result['country']=='105'){echo 'selected';} ?>>
                                                    INDIA
                                                </option>
                                
                                                <?php 
                                                $query = $this->db->query("SELECT * FROM countries;");  
                                
                                                foreach ($query->result() as $row) 
                                                { 
                                                    echo "<option value='{$row->country_id}'>{$row->country_name}</option>"; 
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                
                                
                                        <!-- State -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="state">
                                                State<span style="color:red;">*</span>
                                            </label>
                                
                                            <select name="state" id="state" class="form-control" required>
                                                <option value="">-- Select State --</option>
                                
                                                <?php 
                                                foreach ($stateload as $row) 
                                                { 
                                                    echo "<option value='{$row["state_subdivision_id"]}'";
                                
                                                    if ($result['state'] == $row['state_subdivision_id'])  
                                                    { 
                                                        echo " selected='selected'"; 
                                                    }
                                
                                                    echo ">{$row["state_subdivision_name"]}</option>"; 
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                
                                
                                        <!-- Period -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="period">
                                                Period<span style="color:red;">*</span>
                                            </label>
                                
                                            <select name="period" id="period" class="form-control" required>
                                                <option value="">Select period</option>
                                
                                                <?php 
                                                $query = $this->db->query("SELECT * FROM `period`;"); 
                                
                                                foreach ($periodload as $row) 
                                                { 
                                                    echo "<option value='{$row["period_id"]}'";
                                
                                                    if ($result['period'] == $row['period_id']) 
                                                    { 
                                                        echo " selected='selected'"; 
                                                    }
                                
                                                    echo ">{$row["period_name"]}</option>"; 
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                
                                
                                        <!-- Product -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="product">
                                                Product
                                            </label>
                                
                                            <select name="product_id" id="product" class="form-control">
                                                <option value="">-- Select product --</option>
                                
                                                <?php
                                                $query = $this->db->query(
                                                    "SELECT * FROM products 
                                                     WHERE status='Active' 
                                                     ORDER BY product_name"
                                                );
                                
                                                foreach ($productload as $row) 
                                                {
                                                    echo "<option value='{$row["product_name"]}'";
                                
                                                    if ($result['product_id'] == $row['product_name']) 
                                                    {
                                                        echo " selected='selected'";
                                                    }
                                
                                                    echo ">{$row["product_name"]}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                
                                
                                        <!-- Level -->
                                        <?php 
                                        // $levelload = $this->db 
                                        //     ->where('level_name !=', 'school_level') 
                                        //     ->get('competition_levels') 
                                        //     ->result_array(); 
                                        ?>
                                
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="level">
                                                Level
                                            </label>
                                
                                            <select name="clevel" id="level" class="form-control">
                                                <option value="">Select Level</option>
                                
                                                <?php foreach ($levelload as $row) { ?>
                                                    <option value="<?= $row['level_id']; ?>" 
                                                        <?= (!empty($result['clevel']) && $result['clevel'] == $row['level_id']) ? 'selected' : ''; ?>>
                                                        <?= $row['level_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                
                                
                                        <!-- Center Name / Address -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3">
                                            <label for="search">
                                                Center Name / Address
                                            </label>
                                
                                            <input 
                                                type="text" 
                                                name="search" 
                                                id="search" 
                                                class="form-control"
                                                placeholder="Center Name / Address"
                                            >
                                        </div>
                                
                                
                                        <!-- Search Button -->
                                        <div class="col-lg-2 col-md-4 col-sm-6 col-12 mb-3 d-flex align-items-end">
                                            <button 
                                                type="submit" 
                                                class="btn btn-primary"
                                                id="submit" 
                                                name="search"
                                            >
                                                Search
                                            </button>
                                        </div>
                                
                                    </div>
                                </div>

    						        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
    						          <table class="table table-bordered">
    						            <thead>
							  
						                  <tr>
						                      <!--<th>Revenue</th>-->
						                      <th>Sr. No</th>
						                      <th>Schedule Id</th>
						                      <th>Product</th>
						                      <th>Competition Level</th>
						                      <th>Period</th>
						                      <th>State</th>
						                      <th>Active Parts</th>
						                      <!--<th>Status</th>-->
						                      <th>Status</th>
						                      <th>Mock Orientation Closing Details</th>
						                      <th>Exam Centers</th>
						                      <th>Competition Mode</th>
						                      
						                      
						                  </tr>
						              </thead>
						          
        						          <?php 
        						          $i=1;
        						          foreach($arr as $row){ 
        						              
        						          $revenue_setting=array();
        						          
        						          if(!empty($row['revenue_setting_id'])){    
        						            $revenue_setting = $this->db->get_where('revenue_setting',array('id'=>$row['revenue_setting_id']))->row_array();
        						          }
        						          
        						          
        						          
        						          ?>
        						          <tr>
        						              <!--<td><?php //print_r($revenue_setting);?></td>-->
        						            <td><?php echo $i; ?></td>
        						            <td><?php echo $row['id']; ?></td>
        						            <td><?php echo $row['product_name']; ?></td>
        						            <td>
        						                <?php
                						                $stat = $this->db->get_where('competition_level_byproduct',array('level_id'=>$row['clevel'],'product_name'=>$row['product_name']))->row();
                						                echo $stat->level_name;
            						                 
        						                        $center = $this->db->get_where('exam_centers',array('comp_id'=>$row['id']))->result();
        						                        
        						                      //  echo $this->db->last_query();
        						                      
        						                      
        						                        if(!empty($center)){  
            						                        foreach($center as $cen){ 
            						                        ?>
            						                            <h5 style='padding-top:10px;'><?php echo $cen->center_name;  ?></h5> <br>
            						                        <?php }    
            						                    }
            						                ?> 
        						            
        						            </td>
        						            <td><?php
        						            $stat = $this->db->get_where('period',array('period_id'=>$row['period_id']))->row();
        						                echo $stat->academic_year;
        						            //echo $row['academic_year'];
        						            
        						            ?>
        						            
        						            
        						            </td>
        						            <td>
        						                <?php 
            						                $stat = $this->db->get_where('states',array('state_subdivision_id'=>$row['state_id']))->row();
            						                echo $stat->state_subdivision_name;
            						                echo '<br><br>Currently is active in all areas.<br><br>'; 
            						                if($row['franchise_split']=='yes')
            						                {    
            						                    echo  'Franchise Split : '.$row['com_per'].$revenue_setting['com_per'].'%';echo '<br>'; 
            						                   
            						                }
                                                    if($row['aviansys_split']=='yes')
                                                    {    
                                                        if(!empty($revenue_setting['com_peravian'])){
                                                            echo  'Aviansys Split : '.$revenue_setting['com_peravian'].'%';echo '<br>';
                                                        }else{
                                                            echo  'Aviansys Split : '.$row['com_peravian'].'%';echo '<br>';
                                                        }
                                                    }
                                                    if(!empty($revenue_setting['manageper'])){
                                                        echo  'Management : '.$revenue_setting['manageper'].'%';echo '<br>';
                                                    }else{
                                                        echo  'Management : '.$row['manageper'].'%';echo '<br>'; 
                                                    }   
                                                       
                                                    if($row['franchise_split']=='no'){$rr=0;}else{$rr=$row['com_per'].$revenue_setting['com_per'];}
                                                    echo  'Franchise Split : '.$row['franchise_split'].$revenue_setting['franchise_split'].' = '.$rr.'%';echo '<br>'; 
                                                    
                                                    
                                                    if($row['associate_split']=='no'){$rr=0;}else{$rr=$row['associate_per'].$revenue_setting['associate_per'];}
                                                    
                                                    
                                                    echo  'Associate Split : '.$row['associate_split'].$revenue_setting['associate_split'].' = '.$rr.'%';echo '<br>'; 
                                                    
                                                ?>
                                                <?php
                                                    if ($row['status'] == 'Live') { 
                                                        
                                                    ?>
                                                    <a href='<?php echo base_url(); ?>manage/competitionshedule/percentage/<?php echo $row['id']; ?>' target='_BLANK' class='btn btn-warning'>Edit Percentage</a>
              
                                                <?php } ?>
                                                <?php
                                                    if ($row['aviansys_split'] == 'yes') { 
                                                    ?><a href='<?php echo base_url(); ?>manage/competitionshedule/payments/<?php echo $row['id']; ?>' target='_BLANK' class='btn btn-success'>View Payments</a>
              
                                                <?php } ?>  
                                                
                                                
        						            </td>
						            
        						            <td>
        						                <?php 
        						                if(empty($revenue_setting)){
        						                
            						                echo  'Competition : Rs '.$row['product_price'];echo '<br>';
            						                if(!empty($row['study_material_a']) or !empty($row['study_material_a_price']) ){    echo  $row['study_material_a'].' : Rs '.$row['study_material_a_price'];echo '<br>'; }
                                                    if(!empty($row['study_material_b']) or !empty($row['study_material_b_price'])){   echo  $row['study_material_b'].' : Rs '.$row['study_material_b_price'];echo '<br>';}
                                                    if(!empty($row['study_material_c']) or !empty($row['study_material_c_price'])){   echo  $row['study_material_c'].' : Rs '.$row['study_material_c_price'];echo '<br>';}
                                                    
                                                    if(!empty($row['study_material_d']) or !empty($row['study_material_d_price']) ){    echo  $row['study_material_d'].' : Rs '.$row['study_material_d_price'];echo '<br>'; }
                                                    if(!empty($row['study_material_e']) or !empty($row['study_material_e_price'])){   echo  $row['study_material_e'].' : Rs '.$row['study_material_e_price'];echo '<br>';}
                                                    if(!empty($row['study_material_f']) or !empty($row['study_material_f_price'])){   echo  $row['study_material_f'].' : Rs '.$row['study_material_f_price'];echo '<br>';}
                                                    
                                                    
                                                    
                                                    if(!empty($row['orientation_a']) or !empty($row['orientation_a_price'])){     echo  $row['orientation_a'].' : Rs '.$row['orientation_a_price'];echo '<br>';}
                                                    if(!empty($row['orientation_b']) or !empty($row['orientation_b_price'])){     echo  $row['orientation_b'].' : Rs '.$row['orientation_b_price'];echo '<br>';}
                                                    if(!empty($row['orientation_c']) or !empty($row['orientation_c_price'])){    echo  $row['orientation_c'].' : Rs '.$row['orientation_c_price'];echo '<br>';}
                                                    if(!empty($row['orientation_d']) or !empty($row['orientation_d_price'])){     echo  $row['orientation_d'].' : Rs '.$row['orientation_d_price'];echo '<br>';}
                                                    if(!empty($row['orientation_e']) or !empty($row['orientation_e_price'])){     echo  $row['orientation_e'].' : Rs '.$row['orientation_e_price'];echo '<br>';}
                                                    if(!empty($row['orientation_f']) or !empty($row['orientation_f_price'])){    echo  $row['orientation_f'].' : Rs '.$row['orientation_f_price'];echo '<br>';}
                                                    
                                                    
                                                    
                                                    if(!empty($row['mock_test']) or !empty($row['mock_test_price'])){    echo  $row['mock_test'].' : Rs '.$row['mock_test_price'];  }
                                                    
                                                    
        						                }else{
        						                    echo  'Competition : Rs '.$revenue_setting['product_price'];echo '<br>';
        						                    
            						                if(!empty($revenue_setting['study_material_a_price'])){ echo 'Study Material<br> A : Rs '.$revenue_setting['study_material_a_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['study_material_b_price'])){ echo 'B : Rs '.$revenue_setting['study_material_b_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['study_material_c_price'])){ echo 'C : Rs '.$revenue_setting['study_material_c_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['study_material_d_price'])){ echo 'D : Rs '.$revenue_setting['study_material_d_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['study_material_e_price'])){ echo 'E : Rs '.$revenue_setting['study_material_e_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['study_material_f_price'])){ echo 'F : Rs '.$revenue_setting['study_material_f_price'];echo '<br>'; }
                                                    
                                                    echo 'Orientation<br>';
                                                    if(!empty($revenue_setting['orientation_a_price'])){     echo  'A : Rs '.$revenue_setting['orientation_a_price'];echo '<br>';}
                                                    if(!empty($revenue_setting['orientation_b_price'])){     echo  'B : Rs '.$revenue_setting['orientation_b_price'];echo '<br>';}
                                                    if(!empty($revenue_setting['orientation_c_price'])){     echo  'C : Rs '.$revenue_setting['orientation_c_price'];echo '<br>';}
                                                    
                                                    if(!empty($revenue_setting['mock_test_a_price'])){ echo 'Mock Test<br> A : Rs '.$revenue_setting['mock_test_a_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['mock_test_b_price'])){ echo 'B : Rs '.$revenue_setting['mock_test_b_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['mock_test_c_price'])){ echo 'C : Rs '.$revenue_setting['mock_test_c_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['mock_test_d_price'])){ echo 'D : Rs '.$revenue_setting['mock_test_d_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['mock_test_e_price'])){ echo 'E : Rs '.$revenue_setting['mock_test_e_price'];echo '<br>'; }
                                                    if(!empty($revenue_setting['mock_test_f_price'])){ echo 'F : Rs '.$revenue_setting['mock_test_f_price'];echo '<br>'; }
                                                    
                                                    
                                                    if(!empty($revenue_setting['mock_test'])){    echo  $revenue_setting['mock_test'].' : Rs '.$revenue_setting['mock_test_price'];  }
        						                }    
                                                    
                                                if(empty($revenue_setting)){    
        						                ?>
        						                
        						                <button name='edit_price' value='<?php echo $row['id']; ?>' class='btn btn-primary'>Edit Price</button>
            						            </br>
        						                <a href='<?php echo base_url(); ?>manage/competitionshedule/comp_mat_assign/<?php echo $row['id']; ?>' target="_BLANK"  class='btn btn-warning' >Assign Materials</a>
        						                
        						                </br>
        						                <a href='<?php echo base_url(); ?>manage/competitionshedule/comp_mock_assign/<?php echo $row['id']; ?>' target="_BLANK"  class='btn btn-success' >Assign Mock Tests</a>
        						                <?php } ?>
        						                
        						               <?php
                                                $bundles = ['a' => 'Bundle A', 'b' => 'Bundle B', 'c' => 'Bundle C', 'd' => 'Bundle D', 'e' => 'Bundle E', 'f' => 'Bundle F'];
                                                
                                                foreach ($bundles as $key => $label) {
                                                    if (!empty($revenue_setting['bundle_price_' . $key])) {
                                                        echo $label. '<br>'. ' Rs ' . $revenue_setting['bundle_price_' . $key] . '<br>';
                                                    }
                                                }
                                                ?>
                                                
                                                <?php if(!empty($row['revenue_setting_id'])){ 
                                                
                                                $revenue = $this->db->get_where('revenue_setting',array('id'=>$row['revenue_setting_id']))->row();
        						              //  echo '<pre>';
        						              //  print_r($revenue);
                            //                     echo '<pre>';
                            //                     print_r($row);
                                                
                                                    $revenue = $this->db
                                                        ->get_where(
                                                            'revenue_setting',
                                                            array('id' => $row['revenue_setting_id'])
                                                        )
                                                        ->row();
                                            
                                                    /*
                                                    |--------------------------------------------------------------------------
                                                    | Cart Item Configuration
                                                    |--------------------------------------------------------------------------
                                                    | row_field      = field which tells whether item is selected
                                                    | price_field    = price field from revenue_setting
                                                    | royalty_field  = royalty field from revenue_setting
                                                    | label          = name displayed in popup
                                                    |--------------------------------------------------------------------------
                                                    */
                                            
                                                    $cartConfig = array(
                                            
                                                        array(
                                                            'row_field'     => 'product_price',
                                                            'price_field'   => 'product_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Competition'
                                                        ),
                                            
                                                        // Study Materials
                                                        array(
                                                            'row_field'     => 'study_material_a',
                                                            'price_field'   => 'study_material_a_price',
                                                            'royalty_field' => 'study_material_a_price_royalty',
                                                            'label'         => 'Study Material A'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_b',
                                                            'price_field'   => 'study_material_b_price',
                                                            'royalty_field' => 'study_material_b_price_royalty',
                                                            'label'         => 'Study Material B'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_c',
                                                            'price_field'   => 'study_material_c_price',
                                                            'royalty_field' => 'study_material_c_price_royalty',
                                                            'label'         => 'Study Material C'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_d',
                                                            'price_field'   => 'study_material_d_price',
                                                            'royalty_field' => 'study_material_d_price_royalty',
                                                            'label'         => 'Study Material D'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_e',
                                                            'price_field'   => 'study_material_e_price',
                                                            'royalty_field' => 'study_material_e_price_royalty',
                                                            'label'         => 'Study Material E'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_f',
                                                            'price_field'   => 'study_material_f_price',
                                                            'royalty_field' => 'study_material_f_price_royalty',
                                                            'label'         => 'Study Material F'
                                                        ),
                                            
                                                        // Mock Tests
                                                        
                                                        array(
                                                            'row_field'     => 'mock_test_a',
                                                            'price_field'   => 'mock_test_a_price',
                                                            'royalty_field' => 'mock_test_a_price_royalty',
                                                            'label'         => 'Mock Test A'
                                                        ),
                                                        array(
                                                            'row_field'     => 'mock_test_b',
                                                            'price_field'   => 'mock_test_b_price',
                                                            'royalty_field' => 'mock_test_b_price_royalty',
                                                            'label'         => 'Mock Test B'
                                                        ),
                                                        array(
                                                            'row_field'     => 'mock_test_c',
                                                            'price_field'   => 'mock_test_c_price',
                                                            'royalty_field' => 'mock_test_c_price_royalty',
                                                            'label'         => 'Mock Test C'
                                                        ),
                                                        array(
                                                            'row_field'     => 'mock_test_d',
                                                            'price_field'   => 'mock_test_d_price',
                                                            'royalty_field' => 'mock_test_d_price_royalty',
                                                            'label'         => 'Mock Test D'
                                                        ),
                                                        array(
                                                            'row_field'     => 'mock_test_e',
                                                            'price_field'   => 'mock_test_e_price',
                                                            'royalty_field' => 'mock_test_e_price_royalty',
                                                            'label'         => 'Mock Test E'
                                                        ),
                                                        array(
                                                            'row_field'     => 'mock_test_f',
                                                            'price_field'   => 'mock_test_f_price',
                                                            'royalty_field' => 'mock_test_f_price_royalty',
                                                            'label'         => 'Mock Test F'
                                                        ),
                                            
                                                        // Orientation
                                                        
                                                        array(
                                                            'row_field'     => 'orientation_a',
                                                            'price_field'   => 'orientation_a_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation A'
                                                        ),
                                                        array(
                                                            'row_field'     => 'orientation_b',
                                                            'price_field'   => 'orientation_b_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation B'
                                                        ),
                                                        array(
                                                            'row_field'     => 'orientation_c',
                                                            'price_field'   => 'orientation_c_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation C'
                                                        ),
                                                        array(
                                                            'row_field'     => 'orientation_d',
                                                            'price_field'   => 'orientation_d_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation D'
                                                        ),
                                                        array(
                                                            'row_field'     => 'orientation_e',
                                                            'price_field'   => 'orientation_e_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation E'
                                                        ),
                                                        array(
                                                            'row_field'     => 'orientation_f',
                                                            'price_field'   => 'orientation_f_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Orientation F'
                                                        ),
                                            
                                                        // Combos
                                                        array(
                                                            'row_field'     => 'combo_1',
                                                            'price_field'   => 'combo_1_price',
                                                            'royalty_field' => 'combo_1_price_royalty',
                                                            'label'         => 'Combo 1'
                                                        ),
                                                        array(
                                                            'row_field'     => 'combo_2',
                                                            'price_field'   => 'combo_2_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Combo 2'
                                                        ),
                                                        array(
                                                            'row_field'     => 'combo_3',
                                                            'price_field'   => 'combo_3_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Combo 3'
                                                        ),
                                                        array(
                                                            'row_field'     => 'combo_4',
                                                            'price_field'   => 'combo_4_price',
                                                            'royalty_field' => '',
                                                            'label'         => 'Combo 4'
                                                        ),
                                            
                                                        // Bundles
                                                        array(
                                                            'row_field'     => 'bundle_a',
                                                            'price_field'   => 'bundle_price_a',
                                                            'royalty_field' => 'bundle_price_a_royality',
                                                            'label'         => 'Bundle A'
                                                        ),
                                                        array(
                                                            'row_field'     => 'bundle_b',
                                                            'price_field'   => 'bundle_price_b',
                                                            'royalty_field' => 'bundle_price_b_royality',
                                                            'label'         => 'Bundle B'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_c + orientation_c',
                                                            'price_field'   => 'bundle_price_c',
                                                            'royalty_field' => 'bundle_price_c_royality',
                                                            'label'         => 'Bundle C'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_d + orientation_d',
                                                            'price_field'   => 'bundle_price_d',
                                                            'royalty_field' => 'bundle_price_d_royality',
                                                            'label'         => 'Bundle D'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_e + orientation_e',
                                                            'price_field'   => 'bundle_price_e',
                                                            'royalty_field' => 'bundle_price_e_royality',
                                                            'label'         => 'Bundle E'
                                                        ),
                                                        array(
                                                            'row_field'     => 'study_material_f + orientation_f',
                                                            'price_field'   => 'bundle_price_f',
                                                            'royalty_field' => 'bundle_price_f_royality',
                                                            'label'         => 'Bundle F'
                                                        )
                                                    );
                                            
                                            
                                                    /*
                                                    |--------------------------------------------------------------------------
                                                    | Build Selected Cart Items
                                                    |--------------------------------------------------------------------------
                                                    */
                                            
                                                    $cartItems = array();
                                            
                                                    foreach ($cartConfig as $config) {
                                            
                                                        $rowField = $config['row_field'];
                                            
                                                        if (
                                                            isset($row[$rowField]) &&
                                                            trim((string)$row[$rowField]) !== ''
                                                        ) {
                                            
                                                            $price = '';
                                            
                                                            if (
                                                                !empty($config['price_field']) &&
                                                                isset($revenue->{$config['price_field']})
                                                            ) {
                                                                $price = $revenue->{$config['price_field']};
                                                            }
                                            
                                                            $royalty = '';
                                            
                                                            if (
                                                                !empty($config['royalty_field']) &&
                                                                isset($revenue->{$config['royalty_field']})
                                                            ) {
                                                                $royalty = $revenue->{$config['royalty_field']};
                                                            }
                                            
                                                            $cartItems[] = array(
                                                                'item'    => $config['label'],
                                                                'price'   => ($price !== '' && $price !== null)
                                                                                ? $price
                                                                                : '-',
                                                                'royalty' => ($royalty !== '' && $royalty !== null)
                                                                                ? $royalty
                                                                                : '-'
                                                            );
                                                        }
                                                    }
                                            
                                                    /*
                                                    |--------------------------------------------------------------------------
                                                    | JSON for JavaScript
                                                    |--------------------------------------------------------------------------
                                                    */
                                            
                                                    $cartItemsJson = htmlspecialchars(
                                                        json_encode($cartItems),
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    );
                                                    ?>
                                            
                                                    <input type="checkbox"
                                                           name="popup"
                                                           value="1"
                                                           class="form-check-input popup-checkbox btn btn-primary btn-sm"
                                                           data-cart-items="<?php echo $cartItemsJson; ?>">
                                            
                                                    <label class="form-check-label text-primary popup-label"
                                                           style="cursor:pointer;">
                                                        View Cart Items
                                                    </label>


                                                
                                                <?php } ?>
                                                
        						            </td>
        						            
        						            <!--<td>-->
        						                <?php 
        						                  //  if(!empty($row['combo_1'])){    echo  $row['combo_1'].' : Rs '.$row['combo_1_price'];echo '<br>'; }
                                //                     if(!empty($row['combo_2'])){   echo  $row['combo_2'].' : Rs '.$row['combo_2_price'];echo '<br>';}
                                //                     if(!empty($row['combo_3'])){   echo  $row['combo_3'].' : Rs '.$row['combo_3_price'];echo '<br>';}
                                //                     if(!empty($row['combo_4'])){     echo  $row['combo_4'].' : Rs '.$row['combo_4_price'];echo '<br>';}
        						                    
        						                    
        						                ?>
        						            <!--</td>-->
        						            <td>
        						                
        						                <?php 
        						                $center = $this->db->get_where('exam_centers',array('comp_id'=>$row['id']))->result_array();
        						                
        						                $center1 = $this->db->get_where('closing_competition_details',array('competition_id'=>$row['id']))->result_array();
        						                
        						                $date='';
        						                if(!empty($center[0]['exam_date'] && $center[0]['exam_date']!='0000-00-00')){
        						                    $date=$center[0]['exam_date'];
        						                }
        						                if(!empty($center1[0]['exam_date'] && $center1[0]['exam_date']!='0000-00-00')){
        						                    $date=$center1[0]['exam_date'];
        						                }
        						                if(!empty($row['close_date']) &&  $row['close_date']!='0000-00-00'){
        						                    $date=$row['close_date'];
        						                }
        						                if(!empty($date)){
        						                    echo 'Competition Close Date: '.$date.'<br>';
        						                }else{
        						                    echo 'No Closing Date <br>';
        						                }
        						                
        						                
        						                if (!empty($row['crm_fix'])) {
        						                    echo 'CRM Fix Amount: '.$row['crm_fix'].'<br>';
        						                }
        						                elseif(!empty($revenue_setting['crm_fix'])) {
        						                    echo 'CRM Fix Amount: '.$revenue_setting['crm_fix'].'<br>';
        						
        						                }
        						                
        						                else{
        						                    echo 'No CRM Fix Amount <br>';
        						                }
            						                    
            						                echo 'IT : '.$revenue_setting['it_fix'].'%'.'<br>';
        						                    echo 'CRM %: '.$revenue_setting['crm_per'].'<br>';
        						                    echo 'Competition Status'.' => '.$row['status'];
        						                    
        						                ?>
        						                
        						                <button name='status' value='<?php echo $row['id']; ?>' <?php if($row['status']=='Closed'){?>class='btn btn-danger' <?}else{?>class='btn btn-success' <?php } ?> >
            						                <?php 
            						                    
            						                    echo 'Change Status';
            						                    
            						                ?>
        						                </button>
        						                
        						                <button name='delete' value='<?php echo $row['id']; ?>' class='btn btn-primary'>
            						                <?php 
            						                    
            						                    echo 'Delete';
            						                    
            						                ?>
        						                </button><br>
        						                
        						                <button name='com_edit' value='<?php echo $row['id']; ?>' class='btn btn-dark'>
            						                <?php 
            						                    
            						                    echo 'Edit Competition';
            						                    
            						                ?>
        						                </button><br>
        						                
        						            </td>
        						            <td>
        						                <?php
        						                 $stat = $this->db->get_where('closing_competition_details',array('competition_id'=>$row['id']))->row();
        						                if(empty($stat)){?>
        						                <!--<button name='close' class='btn btn-warning' value='<?php echo $row['id']; ?>'>Add closing details for admit card release</button>-->
        						                
        						                <a href='<?php echo base_url(); ?>manage/competitionshedule/close_exam/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-warning' >Close Cart Item Manually</a><br>
        						                
        						                
        						                
        						                <?php }else{ 
        						                   
        						                   
        						                    
        						                  //  echo '<b>'.'Orientation'.'</b><br>';
        						                  //  echo ' A Date :'.$stat->orientation_a_date.'<br>';echo ' A Time :'.$stat->orientation_a_time.'<br>';
        						                  //  echo ' B Date :'.$stat->orientation_b_date.'<br>';echo ' B Time :'.$stat->orientation_b_time.'<br>';
        						                  //  echo ' C Date :'.$stat->orientation_c_date.'<br>';echo ' C Time :'.$stat->orientation_c_time.'<br>';
        						                    
        						                  //  echo '<b>'.'Mock Test'.'</b><br>';
        						                  //  echo ' Date :'.$stat->mocktest_a_date;echo ' Time :'.$stat->mocktest_a_time;
        						                    
        						                    
        						              //  print_r($stat);
        						                ?>
        						                 <!--<button name='edit_closing' class='btn btn-success' value='<?php echo $row['id']; ?>'>Edit closing details</button>-->
        						                 
        						                 <a href='<?php echo base_url(); ?>manage/competitionshedule/close_exam/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-warning' >Close Cart Item Manually</a><br>
        						                
        						                 
        						                <?php
        						                } ?>
        						                
        						            </td>
        						            
        						            <td>
        						               
        						                <a href='<?php echo base_url(); ?>manage/competitionshedule/cin_upload/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-warning' >Upload CIN List To Appear</a><br>
        						                   <br>
        						                
        						                       <button name='add_center' class='btn btn-warning' value='<?php echo $row['id']; ?>'>Add Exam Center</button>
        						                 
        						                   <button name='center' class='btn btn-info' value='<?php echo $row['id']; ?>'>Edit Center details</button><br>
        						                    <!--<button name='edit_center' class='btn btn-success' value='<?php echo $row['id']; ?>'>Edit Center details</button>-->
        						                   
        						                   <br>
        						                   <form method="POST">
        						                       
        						                        <button value='<?php echo $row['id']; ?>' name="export" class='btn btn-primary' >Unregistered CIN List</button>
        						                
        						                   </form>
        						                   
        						                  <!--</br>-->
        						                  <br>
        						                  <a href='<?php echo base_url(); ?>manage/competitionshedule/cin_upload_list/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-success' >Active CIN List</a><br>
        						                   
        						                  <br>
        						                  <?php if(empty($row['pemplate'])){ ?>
        						                    <a href='<?php echo base_url(); ?>manage/competitionshedule/pemplate/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-primary' >Upload Circular</a><br>
        						                  <?php }else{ ?>
        						                    <a href='<?php echo base_url(); ?>manage/competitionshedule/edit_pemplate/<?php echo $row['id']; ?>' target="_BLANK" class='btn btn-primary' >Edit Circular</a><br>
        						                  
        						                    <a href="<?php echo base_url(); ?>uploads/<?php echo $row['pemplate']; ?>" target="_BLANK" class='btn btn-warning' >View Circular</a><br><br>
        						                    <?php if($row['id'] == '521'){ ?>
        						                    
                                                            <a href="<?php echo base_url(); ?>manage/competitionshedule/reminderEmail/<?php echo $row['id'];?>"  class='btn btn-warning'>Reminder Email</a><br>
                                                            
                                                        <?php } ?>
        						                  <?php } ?>
        						                  
        						                  
        						                  
        						                  
                                                <a href="<?php echo base_url(); ?>manage/franchise/student_result_upload_/<?php echo $row['id']; ?>" target="_blank" class="btn btn-warning">Result Upload</a>
                                                
                                                <a href="<?php echo base_url(); ?>manage/franchise/student_result_export_/<?php echo $row['id']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-download"></i> Export Result</a>
                                            
        						                   
        						            </td>
        						               <!-- ===== CIN / REGISTRATION MODE TOGGLE ===== -->
                                            <td>
                                              <div class="slim-wrap">
                                                <label class="slim-toggle">
                                                  <input
                                                    type="checkbox"
                                                    <?php echo $regOnline ? 'checked' : ''; ?>
                                                    data-school-code="<?php echo $value['school_code']; ?>"
                                                    onchange="toggleCinMode(<?php echo $value['id']; ?>, this)">
                                                  <span class="slim-slider"></span>
                                                </label>
                                                <span class="slim-lbl <?php echo $regOnline ? 'on' : 'off'; ?>" id="cin-lbl-<?php echo $value['id']; ?>">
                                                  <span class="dot <?php echo $regOnline ? 'dot-on' : 'dot-off'; ?>" id="cin-dot-<?php echo $value['id']; ?>"></span>
                                                  <?php echo $regOnline ? 'Online' : 'Offline'; ?>
                                                </span>
                                              </div>
                                            </td> 
        						          </tr>
        						          <?php 
						                $i=$i+1;
						                } ?>
						          </table>
						      
						        </form>

					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			



<!-- =========================
     CART ITEMS MODAL
========================= -->

<div class="modal fade"
     id="popupModal"
     tabindex="-1"
     aria-labelledby="popupModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">

                <h5 class="modal-title" id="popupModalLabel">
                    Cart Items
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th style="width: 50%;">
                                    Item
                                </th>

                                <th style="width: 25%;"
                                    class="text-end">
                                    Price
                                </th>

                                <th style="width: 25%;"
                                    class="text-end">
                                    Royalty
                                </th>
                            </tr>

                        </thead>

                        <tbody id="cartItemsBody">

                            <tr>
                                <td colspan="3"
                                    class="text-center text-muted">
                                    No cart items found.
                                </td>
                            </tr>

                        </tbody>

                        <tfoot id="cartItemsFooter">
                            <tr>
                                <th>
                                    Total
                                </th>

                                <th class="text-end"
                                    id="cartTotalPrice">
                                    0
                                </th>

                                <th class="text-end"
                                    id="cartTotalRoyalty">
                                    0
                                </th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>

            </div>

        </div>

    </div>

</div>

			



<script>

$(document).on('click', '.popup-checkbox, .popup-label', function (e) {

    var checkbox = $(this).hasClass('popup-checkbox')
        ? $(this)
        : $(this).closest('td').find('.popup-checkbox');

    var cartItems = [];

    try {
        cartItems = JSON.parse(
            checkbox.attr('data-cart-items') || '[]'
        );
    } catch (error) {
        console.error('Invalid cart items JSON:', error);
        cartItems = [];
    }

    var tbody = $('#cartItemsBody');

    tbody.empty();

    var totalPrice = 0;
    var totalRoyalty = 0;

    if (cartItems.length === 0) {

        tbody.append(`
            <tr>
                <td colspan="3"
                    class="text-center text-muted">
                    No cart items found.
                </td>
            </tr>
        `);

    } else {

        $.each(cartItems, function (index, item) {

            var price = parseFloat(item.price) || 0;
            var royalty = parseFloat(item.royalty) || 0;

            totalPrice += price;
            totalRoyalty += royalty;

            tbody.append(`
                <tr>
                    <td>
                        ${item.item}
                    </td>

                    <td class="text-end">
                        ${item.price === '-' ? '-' : price.toFixed(2)}
                    </td>

                    <td class="text-end">
                        ${item.royalty === '-' ? '-' : royalty.toFixed(2)}
                    </td>
                </tr>
            `);
        });
    }

    $('#cartTotalPrice').text(totalPrice.toFixed(2));
    $('#cartTotalRoyalty').text(totalRoyalty.toFixed(2));

    var modalElement = document.getElementById('popupModal');

    var modal = bootstrap.Modal.getOrCreateInstance(modalElement);

    modal.show();

});


$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Bundle A Checkbox
    |--------------------------------------------------------------------------
    */

    $(document).on('change', '#bundle_a', function () {

        var checkbox = $(this);

        if (checkbox.is(':checked')) {

            var modalElement = document.getElementById('bundleModal');

            var modal = bootstrap.Modal.getOrCreateInstance(modalElement);

            modal.show();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Confirm Bundle
    |--------------------------------------------------------------------------
    |
    | Keep checkbox checked after confirmation.
    |
    */

    $(document).on('click', '#confirmBundle', function () {

        var modalElement = document.getElementById('bundleModal');

        var modal = bootstrap.Modal.getInstance(modalElement);

        if (modal) {
            modal.hide();
        }

        // Keep checkbox checked
        $('#bundle_a').prop('checked', true);

    });


    /*
    |--------------------------------------------------------------------------
    | Cancel Button
    |--------------------------------------------------------------------------
    |
    | Uncheck bundle when user cancels.
    |
    */

    $(document).on('click', '#cancelBundle', function () {

        $('#bundle_a').prop('checked', false);

    });


    /*
    |--------------------------------------------------------------------------
    | Modal Closed
    |--------------------------------------------------------------------------
    |
    | This handles:
    | - X button
    | - Escape key
    | - Clicking outside modal
    | - Cancel
    |
    | But NOT Confirm.
    |
    */

    $('#bundleModal').on('hidden.bs.modal', function () {

        /*
         * If bundle was confirmed, don't uncheck it.
         */
        if ($('#bundleModal').data('confirmed') === true) {

            $('#bundleModal').removeData('confirmed');

            return;
        }

        /*
         * Otherwise modal was cancelled/closed.
         */
        $('#bundle_a').prop('checked', false);

    });


    /*
    |--------------------------------------------------------------------------
    | Confirm Flag
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '#confirmBundle', function () {

        $('#bundleModal').data('confirmed', true);

    });

});


</script>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->


<script type="text/javascript">
    
// helper to update label + dot
function setCinLabel(schoolId, isOnline) {
    var lbl = document.getElementById('cin-lbl-' + schoolId);
    var dot = document.getElementById('cin-dot-' + schoolId);
    if (isOnline) {
        lbl.className = 'slim-lbl on';
        dot.className = 'dot dot-on';
        lbl.childNodes[lbl.childNodes.length - 1].textContent = 'Online';
    } else {
        lbl.className = 'slim-lbl off';
        dot.className = 'dot dot-off';
        lbl.childNodes[lbl.childNodes.length - 1].textContent = 'Offline';
    }
}

// In saveCinMode() success — replace the old label line:
// document.getElementById('cin-lbl-' + _cin_schoolId).textContent = 'Online';
setCinLabel(_cin_schoolId, true);

// In saveCinOfflineMode() success — replace the old label line:
// document.getElementById('cin-lbl-' + _cin_schoolId).textContent = 'Offline';
setCinLabel(_cin_schoolId, false);
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
 
 <script>
 
    
 
    $("#country").change(function(){
        var country_id =this.value;
         //alert(franchise_id);
         var BASE_URL="https://marrs.in/admin/";
        $.ajax({
        url:"https://marrs.in/admin/manage/ajax/getstateAjax_",
        data:{country_id:country_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#state").html(result);
        	 
        
        }});
    });
 
    $("#product").change(function(){
        var product_id =this.value;
         //alert(franchise_id);
         var BASE_URL="https://marrs.in/admin/";
        $.ajax({
        url:"https://marrs.in/admin/manage/ajax/productwiselevelwithNameSch",
        data:{product_id:product_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#level").html(result);
        	 
        
        }});
    });
    
    
</script>

<?php include('footer.php'); ?>
