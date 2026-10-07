<?php include('header.php');

// print_r($schedule);

$period_id = $schedule->period_id;
$product_id = $schedule->product_id;


?>
<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
     <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> CIN</h2>
						<div class="box-icon">  
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
                  
						<form method="POST">
                            <table class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        <h4><b>Area: <span style="color:red;">*</span></b></h4>
                                        <select name="area_code" id="area_code" style="width: 180px;" required>
                                            <option>-- Select Area --</option>
                                            <?php
                                            foreach ($area as $row) { ?>
                                                <option value="<?php echo $row['area_code']; ?>" 
                                                <?php if (isset($result['area_code']) && $result['area_code'] == $row['area_code']) { ?> selected="selected" <?php } ?>>
                                                <?php echo $row['city_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </th>
                    
                                   
                    
                                    <th>
                                        <h3><b>School: <span style="color:red;">*</span></b></h3>
                                        <select name="school" id="school" style="width: 180px;" required>
                                            <?php if (isset($result['school'])) { ?>
                                                <option value="All" <?php if ($result['school'] == 'All') { echo 'selected="selected"'; } ?>> All School </option>
                                                <?php foreach ($school as $row) { ?>
                                                    <option value="<?php echo $row['id']; ?>" 
                                                    <?php if (isset($result['school']) && $result['school'] == $row['id']) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $row['school_name']; ?></option>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <option>-- Select School --</option>
                                            <?php } ?>
                                        </select>
                                    </th>
                    
                                    <th>
                                        <h3><b>Period: <span style="color:red;">*</span></b></h3>
                                        <select name="period_id" id="period" style="width: 180px;" required disabled>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM `period` WHERE period_id >= '13';");
                                            foreach ($query->result_array() as $row) { ?>
                                                <option value="<?php echo $row['period_id']; ?>" 
                                                <?php if (isset($period_id) && $period_id == $row['period_id']) { ?> selected="selected" <?php } ?>>
                                                <?php echo $row['period_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </th>
                    
                                    <th>
                                        <h3><b>Class:</b></h3>
                                        <select name="class" id="class" style="width: 180px;">
                                            <option value="">All Class</option>
                                            <?php
                                            $query = $this->db->query("SELECT * FROM `class`;");
                                            foreach ($query->result_array() as $row) { ?>
                                                <option value="<?php echo $row['class_name']; ?>" 
                                                <?php if (isset($result['class']) && $result['class'] == $row['class_name']) { ?> selected="selected" <?php } ?>>
                                                <?php echo $row['class_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </th>
                                     <th>
                                        <h4><b>Products:</b></h4>
                                        <select name="product" id="product" style="width: 220px;" disabled>
                                            
                                            <?php
                                            
                                            foreach($productload as $row){ ?>
                                            
                                                <option value="<?php echo $row['in13']; ?>"  <?php if(isset($product_id) && $product_id == $row['product_id']) { ?> selected="selected" <?php } ?>> <?php echo $row['product_name']; ?></option>
                                           
                                            <?php } ?>
                                        </select>
                                    </th>
                                    <th>
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                                    </th>
                                </tr>
                            </thead>
                        </table>
					</div>
					
					
					<div class="box-content">
                  
						<div class="box-content">
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>CIN</th>
                                        <th>Student Name</th>
                                        <th>School</th>
                                        <th>Area Code</th>
                                        <th>Area Name</th>
                                        <th>Mobile</th>
                                        <th>Class</th>
                                        <th>Product Name</th>
                                        <!--<th>Delete</th>-->
                                    </tr>
                                </thead>   
                                <tbody>
                                    <?php if (!empty($cin_list)) { ?>
                                        <form method="post">
                                            <input type="submit" name="export" value="export" class='btn btn-primary' />
                                        </form>
                                        
                                        <?php
                                        $i = 1;
                                        foreach ($cin_list as $value) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value['cin']; ?></td>
                                                <td><?php echo $value['student_name']; ?></td>
                                                <td><?php echo $value['school_name']; ?></td>
                                                <td><?php echo $value['area_code']; ?></td>
                                                <td><?php echo $value['city_name']; ?></td>
                                                <td><?php echo $value['stud_phone']; ?></td>
                                                <td><?php echo $value['class']; ?></td>
                        
                                                <td>
                                                    <?php
                                                    if (empty($result['product'])) {
                                                        // Extract a part of the CIN for product lookup
                                                        $cin_part = substr($value['cin'], 2, 2);
                                                        $cin_part = $this->db->escape($cin_part);
                                                        
                                                        // Query to get the product name based on CIN part
                                                        $query = $this->db->query("SELECT product_name FROM `products` WHERE in13 = $cin_part;");
                                                        $product_result = $query->row();
                                                        
                                                        if (!empty($product_result)) {
                                                            echo $product_result->product_name;
                                                        } else {
                                                            echo 'N/A'; // Handle case when no product is found
                                                        }
                                                    } else {
                                                        // Fetch product name based on the selected product in the form
                                                        $per = $this->db->get_where('products', array('in13' => $this->input->post('product')))->row();
                                                        echo !empty($per->product_name) ? $per->product_name : 'N/A';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php $i++; } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="9">No data available.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

			
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
    $("#area_code").change(function(){
    var area_code =this.value;
    //  alert('area_code');
        var BASE_URL="https://marrs.in/franchiselogin/";
        $.ajax({
        url:"<?php echo base_url();?>franchise/ajax/school_list",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
        
        }});
    });
</script>


<?php include('footer.php');?>