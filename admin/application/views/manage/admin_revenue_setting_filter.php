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
    
  
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


<div class="row-fluid sortable">
    
	<div class="box span12">
	<!-------------->          
		<div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Revenue-Price Filter</h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
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
    
    
            
				<div class="box span12">
				    
				    <form  method="POST">
            
                
    					
    		        <table  cellpadding="5px" width='100%'>
        			    <tr>
        			    	<td>Period: <span style='color:red;'>*</span><br />
                                <select name="period" id="period" style="width: 220px;" required>
                                    <option value="" >-- select period --</option>
                                    
                                    <?php
                                    $query = $this->db->query("SELECT * FROM `period`;");
                                    foreach ($query->result() as $row) {
                                        $selected = (isset($result) && $result['period'] == $row->period_id) ? 'selected' : '';
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
        			
        				   
        			
        			        <td> <br /><input type="submit" name="search" value="search" class='btn btn-warning btn-lg' /> </td>
        		           
        			    </tr>
    			    
    	            </table>		 
    		 
    		    <!--</div>  -->
    		
    	            </form>
				    
				    
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Revenue Setting Last 10 Added List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content" style="margin:10px">
                  
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
                        	            <th> Material Price </th>
                        	            <th> MockTest Price</th>
                        	            <th> Orientation Price</th>
                        	            <th> Option</th>
                        	        </tr>
                	          </thead> 
                	          
                	        <form method="POST">
                	            
    				            <tbody>
            	                <?php if(!empty($list_materials)){
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
                            	                <td><?php echo $row['crm_fix'].' Rs'.'<br>'.'IT :'.$row['crm_fix'].'%'; ?></td>
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
                                                        href="https://marrs.in/franchiselogin/manage/franchise/admin_revenue_setting_edit/<?php echo $row['id']; ?>" 
                                                        class="btn btn-primary"
                                                        
                                                    >
                                                        Edit
                                                    </a>
                                                    
                                                </td>
                            
                            					  
                            	            </tr>
                            	        <?php 
                            	           $i++; }
                            	       }?>
    	       	                </tbody>
    	       	            
    	       	            </form>
    	       	            
    	                </table>
    	                
				    </div><!--/span-->
			
			    </div>
		
    

    
        </div>


<?php include('footer.php'); ?>