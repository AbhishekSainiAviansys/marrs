<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	     
	 
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
			   <h2><i class="icon-edit"></i>Upload Mock Paper </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" id="form1">

<div class="card">
<div class="card-body">

<div class="row g-3">

    <!-- Title -->
    <div class="col-md-2">
        <label class="form-label">Title</label>
        <input type="text" name="paper_name" class="form-control">
    </div>

    <!-- Product -->
    <div class="col-md-2">
        <label class="form-label">Product</label>
        <select name="product_id" id="product" class="form-select" required>
            <option value="">-- Select Product --</option>
            <?php
            $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name");
            foreach ($query->result() as $row){
                echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Period -->
    <div class="col-md-2">
        <label class="form-label">Period</label>
        <select name="period" id="period" class="form-select" required>
            <option value="">-- Select Period --</option>
            <?php
            $query = $this->db->query("SELECT * FROM `period`;");
            foreach ($query->result() as $row){
                echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Level -->
    <div class="col-md-2">
        <label class="form-label">Competition Level</label>
        <select name="clevel" id="level" class="form-select" required>
            <option value="">-- Select level --</option>
            <?php
            $query = $this->db->query("SELECT * FROM `competition_levels`;");
            foreach ($query->result() as $row){
                echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
            }
            ?>
        </select>
    </div>

    <!-- Class (INLINE) -->
    <div class="col-md-12">
        <label class="form-label">Class</label><br>
        <?php
        $query = $this->db->query("SELECT * FROM `class`;");
        foreach ($query->result() as $row) {
        ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input mx-2"
                       type="checkbox"
                       name="class[]"
                       id="<?php echo $row->class_name; ?>"
                       value="<?php echo $row->class_name; ?>">
                <label class="form-check-label"
                       for="<?php echo $row->class_name; ?>">
                    <?php echo $row->class_name; ?>
                </label>
            </div>
        <?php } ?>
    </div>

    <!-- Mock Paper Maker -->
    <div class="col-md-3">
        <label class="form-label">Mock Paper Maker</label>
        <select name="mock_paper_maker_id" class="form-select">
            <option value="">-- Select Maker --</option>
            <?php
            $query = $this->db->query("SELECT * FROM `material_maker` where status='Active'");
            foreach ($query->result_array() as $row){ ?>
                <option value="<?php echo $row['material_maker_id'];?>"
                    <?php if($row['material_maker_id']==$result['mock_paper_maker']){ echo 'selected="selected"'; } ?>>
                    <?php echo $row['name'];?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- Files -->
    <div class="col-md-2">
        <label class="form-label">File 1</label>
        <input type="file" name="folder1" class="form-control">
    </div>

    <div class="col-md-2">
        <label class="form-label">File 2</label>
        <input type="file" name="folder2" class="form-control">
    </div>

    <div class="col-md-2">
        <label class="form-label">File 3</label>
        <input type="file" name="folder3" class="form-control">
    </div>

    <div class="col-md-2">
        <label class="form-label">File 4</label>
        <input type="file" name="folder4" class="form-control">
    </div>

    <!-- Module -->
    <div class="col-md-3">
        <label class="form-label">Module</label>
        <select name="status" class="form-select" required>
            <option value="">Select-status</option>
            <option value="Free-A">Free Module A</option>
            <option value="Free-B">Free Module B</option>
            <option value="Free-C">Free Module C</option>
            <option value="Free-D">Free Module D</option>
            <option value="Free-E">Free Module E</option>
            <option value="Free-F">Free Module F</option>
            <option value="Paid-A">Paid Module A</option>
            <option value="Paid-B">Paid Module B</option>
            <option value="Paid-C">Paid Module C</option>
            <option value="Paid-D">Paid Module D</option>
            <option value="Paid-E">Paid Module E</option>
            <option value="Paid-F">Paid Module F</option>
        </select>
    </div>

    <!-- Subject -->
    <div class="col-md-3" id="subjectdiv">
        <label class="form-label">Subject</label>
        <select name="subject" id="subject" class="form-select">
            <option value="">-- select subject --</option>
            <?php foreach($subjects as $subject){ ?>
                <option value="<?php echo $subject->subject_key; ?>">
                    <?php echo $subject->subject_key; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- Varient -->
    <div class="col-md-3" id="varientdiv">
        <label class="form-label">Varient</label>
        <select name="varient" id="varient" class="form-select"></select>
    </div>

    <!-- Series -->
    <div class="col-md-3" id="seriesdiv">
        <label class="form-label">Series</label>
        <select name="series" id="series" class="form-select"></select>
    </div>

    <!-- Submit -->
    <div class="col-12">
        <button type="submit" name="submit" class="btn btn-success">
            Submit
        </button>
    </div>

</div>

</div>
</div>

</form>
			<!--------------> 	
			
	<form  method="post" >		
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
        			}?>
			</h4></div>
				 <?php  if(!empty($list_materials)): ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Last 10 Papers Uploaded.</td></tr>
							 <tr>
								<th>SI no</th> <th>Product Name</th> <th>PERIOD</th> 
								<th>LEVEL</th> 	<th>Class / Type / Module</th><th>Maker Name / Price</th>
								<th>Upload File 1</th>	<th>Upload File 2</th>	<th>Upload File 3</th>	<th>Upload File 4</th> 
								<th>Status</th><th>Action</th>
							 </tr>
							<?php    
							  $i=0;  
							  //print_r($list_materials);die;
							  foreach($list_materials as $details){ 
							     //print_r($details);die;
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									
									
									<td align="CENTER"> <?php   
									$query = $this->db->query("SELECT academic_year FROM period where period_id='{$details['period_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['academic_year'];
									?> </td>
									
									<td align="CENTER">
									    <?php 
									     $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where product_name='{$details['product_name']}' and  level_id='{$details['clevel']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['level_name'].'<br><b>'; 
    									    if($details['product_name'] ==  'Lunar Skill Test'){
        									    echo 'Subject: '.$details['subject'].'<br>';
        									    echo 'Series: '.$details['series'].'<br>';
        									    echo 'Variant: '.$details['sub_type'].'</b>';
    									    }
									    ?>
									</td>
									<td align="CENTER"> 
									
									    <?php  echo $details['class']; 
									            echo '<br>Module: <b>'.$details['type'].'</b>'; 
									            echo '<br>Status: <b>'.$details['pay_status'].'</b>'; 
									    ?> 
									    
									</td>
									<td align="CENTER"> <?php 
									if(!empty($details['mock_paper_maker_id'])){
									$query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$details['mock_paper_maker_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['name'].' / '.$details['maker_price']; 
									}else{
									echo 'Not Assigned to any maker.';  
									}
									
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['folder1'];  
									if(!empty($details['folder1'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder1'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder2'];  
									if(!empty($details['folder2'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder2'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['folder3'];
									if(!empty($details['folder3'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder3'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder4'];
									if(!empty($details['folder4'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder4'];?>'class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['status']; ?> </td>
									<td align="CENTER">
									    <button name='delete' value='<?php  echo $details['paper_id']; ?>'
									     class='btn btn-danger' >Delete</button>
									</td>
							 </tr>
							<?php  } ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->

<script>

$(document).ready(function() {

    $('#subjectdiv').hide();
    $('#varientdiv').hide();
    $('#seriesdiv').hide();
    
    

    $("#product").change(function(){
        
        var product_id =this.value;
         //alert(franchise_id);
         var BASE_URL="https://marrs.in/admin/";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/productwiselevel",
        data:{product_id:product_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#level").html(result);
        	 
        
        }});
    
    
    
    

        if (product_id === '8') {  // Compare as string
            $('#subjectdiv').show();
            $('#varientdiv').show();
            $('#seriesdiv').show();
        } else {
            $('#subjectdiv').hide();
            $('#varientdiv').hide();
            $('#seriesdiv').hide();
        }

       
    });
    
    
    
    $("#subject").change(function() {
        var subject_key = this.value;

        

        $.ajax({
            url:"<?php echo base_url();?>manage/ajax/getlunar_subject_key",
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
        // var period = $('#period').val();
        
        var period = 15;
        
        $.ajax({
            url:"<?php echo base_url();?>manage/ajax/getlunar_series",
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