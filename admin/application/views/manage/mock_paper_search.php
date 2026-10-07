<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	    // print_r($result);
	 
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
	

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

<div class="container-fluid">

    <!-- SEARCH SECTION -->
    <div class="card mb-4">
        <div class="card-body">

            <div class="row g-3">

                <!-- Product -->
                <div class="col-md-4">
                    <label class="form-label">Product</label>
                    <select name="product_id" id="product" class="form-select" required>
                        <option value="">-- Select Product --</option>
                        <?php foreach ($productload as $row) { ?>
                            <option value='<?php echo $row['product_id']; ?>'
                                <?php if(isset($result['product_id']) && $result['product_id']==$row['product_id']){ ?> selected <?php } ?>>
                                <?php echo $row['product_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Level -->
                <div class="col-md-4">
                    <label class="form-label">Competition Level</label>
                    <select name="clevel" id="level" class="form-select" required>
                        <option>Select level</option>
                        <?php foreach ($levelload as $row) { ?>
                            <option value='<?php echo $row['level_id']; ?>'
                                <?php if(isset($result['clevel']) && $result['clevel']==$row['level_id']){ ?> selected <?php } ?>>
                                <?php echo $row['level_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Class -->
                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <select name="class" id="class" class="form-select">
                        <option value=''>All Class</option>
                        <option value='Nursery'>Nursery</option>
                        <option value='LKG'>LKG</option>
                        <option value='UKG'>UKG</option>
                        <option value='Class-1'>Class-1</option>
                        <option value='Class-2'>Class-2</option>
                        <option value='Class-3'>Class-3</option>
                        <option value='Class-4'>Class-4</option>
                        <option value='Class-5'>Class-5</option>
                        <option value='Class-6'>Class-6</option>
                        <option value='Class-7'>Class-7</option>
                        <option value='Class-8'>Class-8</option>
                        <option value='Class-9'>Class-9</option>
                        <option value='Class-10'>Class-10</option>
                        <option value='Class-11'>Class-11</option>
                        <option value='Class-12'>Class-12</option>
                    </select>
                </div>

                <!-- Subject -->
                <div class="col-md-3" id="subjectdiv">
                    <label class="form-label">Subject</label>
                    <select name='subject' id='subject' class="form-select">
                        <option>-- select subject --</option>
                        <?php foreach($subjects as $subject){ ?>
                            <option value="<?php echo $subject->subject_key; ?>">
                                <?php echo $subject->subject_key; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Variant -->
                <div class="col-md-3" id="varientdiv">
                    <label class="form-label">Variant</label>
                    <select name='varient' id='varient' class="form-select"></select>
                </div>

                <!-- Series -->
                <div class="col-md-3" id="seriesdiv">
                    <label class="form-label">Series</label>
                    <select name='series' id='series' class="form-select"></select>
                </div>

                <!-- Button -->
                <div class="col-md-3 d-flex align-items-end">
                    <input type="submit" name="submit" value="Search" class="btn btn-primary w-100">
                </div>

            </div>

        </div>
    </div>

    <!-- SUCCESS MESSAGE -->
    <div class="text-center mb-3">
        <h5 class="text-success">
            <?php if(!empty($this->session->flashdata('success'))){
                echo $this->session->flashdata('success');
            }?>
        </h5>
    </div>

    <!-- RESULT TABLE -->
    <?php if(!empty($list_materials)): ?>
    <div class="card">
        <div class="card-header text-center fw-bold text-primary">
            Showing Searched Mock Papers
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                
                <thead class="table-dark text-center">
                    <tr>
                        <th>SI no</th>
                        <th>Product Name</th>
                        <th>Period</th>
                        <th>Level</th>
                        <th>Class / Type / Module</th>
                        <th>Maker</th>
                        <th>File 1</th>
                        <th>File 2</th>
                        <th>File 3</th>
                        <th>File 4</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php  
                $i=0;
                foreach($list_materials as $details){ 
                ?>
                    <tr class="text-center">

                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $details['product_name']; ?></td>

                        <td>
                            <?php
                            $query = $this->db->query("SELECT academic_year FROM period where period_id='{$details['period_id']}' ");
                            $result=$query->row_array();
                            echo $result['academic_year'];
                            ?>
                        </td>

                        <td>
                            <?php 
                            $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where product_name='{$details['product_name']}' and level_id='{$details['clevel']}' ");
                            $result=$query->row_array();
                            echo $result['level_name'].'<br>';

                            if($details['product_name'] == 'Lunar Skill Test'){
                                echo 'Subject: '.$details['subject'].'<br>';
                                echo 'Series: '.$details['series'].'<br>';
                                echo 'Variant: '.$details['sub_type'];
                            }
                            ?>
                        </td>

                        <td>
                            <?php  
                            echo $details['class'];
                            echo '<br><b>'.$details['type'].'</b>';
                            echo '<br><b>'.$details['pay_status'].'</b>';
                            ?>
                        </td>

                        <td>
                            <?php 
                            if(!empty($details['mock_paper_maker_id'])){
                                $query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$details['mock_paper_maker_id']}' ");
                                $result=$query->row_array();
                                echo $result['name'];
                            } else {
                                echo 'Not Assigned';
                            }
                            ?>
                        </td>

                        <!-- Files -->
                        <?php for($f=1;$f<=4;$f++){ 
                            $file = $details["folder".$f]; ?>
                            <td>
                                <?php echo $file; ?>
                                <?php if(!empty($file)){ ?>
                                    <br>
                                    <a href='https://marrs.in/mock_papers/<?php echo $file;?>'
                                       class="btn btn-sm btn-outline-warning" target="_blank">View</a>
                                <?php } ?>
                            </td>
                        <?php } ?>

                        <td><?php echo $details['status']; ?></td>

                        <td>
                            <button name="delete"
                                value="<?php echo $details['paper_id']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?');">
                                Delete
                            </button>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
    <?php endif; ?>

</div>
</form>  
</div>	
 </div><!--/span-->
</div><!--/row-->


<script>

$(document).ready(function() {
    
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
            url:"<?php echo base_url();?>manage/ajax/productwiselevel",
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


<script>
//     $("#product").change(function(){
// var product_id =this.value;
//  //alert(franchise_id);
//  var BASE_URL="https://marrs.in/franchiselogin/";
// $.ajax({
// url:"https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
// data:{product_id:product_id},
// type: 'post',
// success:function(result)
// {
// 	//alert(result);
// 	 $("#level").html(result);
	 

// }});
// });
    
 </script>


<?php include('footer.php'); ?>