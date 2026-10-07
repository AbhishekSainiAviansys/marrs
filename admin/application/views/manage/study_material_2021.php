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
			   <h2><i class="icon-edit"></i>Upload study material </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="border rounded"> 

<div class="container-fluid">
<div class="row g-3">


<!-- Period -->
<div class="col-md-2">
    <label class="form-label">Period</label>
    <select name="period" id="period" class="form-select" required>
        <option hidden>Select period</option>
        <?php
        $query = $this->db->query("SELECT * FROM `period`;");
        foreach ($query->result() as $row){
            echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
        }
        ?>
    </select>
</div>

<!-- Product -->
<div class="col-md-2">
    <label class="form-label">Product</label>
    <select name="product_id" id="product" class="form-select" required>
        <option hidden>Select product</option>
        <?php
        $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name");
        foreach ($query->result() as $row){
            echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
        }
        ?>
    </select>
</div>

<!-- Level -->
<div class="col-md-2">
    <label class="form-label">Competition Level</label>
    <select name="clevel" id="level" class="form-select" required>
        <option hidden>Select level</option>
        <?php
        $query = $this->db->query("SELECT * FROM `competition_levels`;");
        foreach ($query->result() as $row){
            echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
        }
        ?>
    </select>
</div>

<!-- Title -->
<div class="col-md-2">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" required>
</div>

<!-- Status -->
<div class="col-md-2">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        <option>Select-status</option>
        <option value='Free-A'>Free Module A</option>
        <option value='Free-B'>Free Module B</option>
        <option value='Free-C'>Free Module C</option>
        <option value='Free-D'>Free Module D</option>
        <option value='Free-E'>Free Module E</option>
        <option value='Free-F'>Free Module F</option>
        <option value='Paid-A'>Paid Module A</option>
        <option value='Paid-B'>Paid Module B</option>
        <option value='Paid-C'>Paid Module C</option>
        <option value='Paid-D'>Paid Module D</option>
        <option value='Paid-E'>Paid Module E</option>
        <option value='Paid-F'>Paid Module F</option>
    </select>
</div>

<!-- Maker -->
<div class="col-md-2">
    <label class="form-label">Study Material Maker</label>
    <select name="material_maker_id" class="form-select">
        <option value=''>-- Select Maker --</option>
        <?php
        $query = $this->db->query("SELECT * FROM `material_maker` where status='Active'");
        foreach ($query->result_array() as $row){
        ?>
        <option value="<?php echo $row['material_maker_id'];?>" 
        <?php if($row['material_maker_id']==$result['material_maker_id']) echo 'selected'; ?>>
        <?php echo $row['name'];?>
        </option>
        <?php } ?>
    </select>
</div>

</div>

<!-- Class Section -->

<div class="mt-4">
    <label class="form-label fw-semibold">Class</label>
    <div class="row">
        <?php
        $query = $this->db->query("SELECT * FROM `class`;");
        foreach ($query->result() as $row) {
        ?>
        <div class="col-md-2 mb-2">
            <input type="checkbox"
                   class="btn-check"
                   name="class[]"
                   value="<?php echo $row->class_name; ?>"
                   id="class_<?php echo $row->class_name; ?>">


        <label class="btn btn-outline-danger w-100"
               for="class_<?php echo $row->class_name; ?>">
            <?php echo $row->class_name; ?>
        </label>
    </div>
    <?php } ?>
</div>


</div>

<!-- File Upload + Submit -->

<div class="row mt-4 align-items-end">
    <!-- Subject -->
<div class="col-md-2">
    <label class="form-label">Subject</label>
    <select name="subject" id="subject" class="form-select">
        <option value=''>-- select subject --</option>
        <?php foreach($subjects as $subject){ ?>
        <option value="<?php echo $subject->subject_key; ?>">
            <?php echo $subject->subject_key; ?>
        </option>
        <?php } ?>
    </select>
</div>

<!-- Variant -->
<div class="col-md-2">
    <label class="form-label">Variant</label>
    <select name="varient" id="varient" class="form-select"></select>
</div>

<!-- Series -->
<div class="col-md-2">
    <label class="form-label">Series</label>
    <select name="series" id="series" class="form-select"></select>
</div>

    <div class="col-md-4">
        <label class="form-label">Choose your file</label>
        <input name="folder" type="file" id="csv" class="form-control">
    </div>


<div class="col-md-2">
    <button type="submit" name="submit" class="btn btn-success w-100">
        Submit
    </button>
</div>


</div>

</div>
</form>
  </div>	
 </div><!--/span-->
</div><!--/row-->
<div class="row-fluid sortable">
   
 <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Study Material Last 10 Added List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content" style="margin:10px">
                  
					<table  id="example" class="table table-striped table-bordered" style="width:100%;">
	       <thead><tr>
	            <th>Sr. No.</th>
	            <th> Product </th>
	            <th> Period </th>
	            <th> Level </th>
	            <th> Class </th>
	            <th>Maker Name</th>
	            <th> Title </th>
	            <th> Status </th>
	            <th> Price </th>
	            <th> View/Download </th>
	             <th> Option</th>
	        </tr>
	          </thead>   
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
	                <td><?php echo $row['academic_year']; ?></td>
	                <td><?php 
	                
	                    $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where level_id='{$row['clevel']}' and product_name='{$row['product_name']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['level_name'].'<br>';
									    
	                   // echo $row['clevel']; 
	                
	                ?></td>
	                <td><?php echo $row['class']; ?></td>
	                <td>
	                    <?php 
	                    
	                   // print_r($row);
	                    
	                    
									if(!empty($row['material_maker_id'])){
									    
									    $query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$row['material_maker_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['name'].'<br>';
									   // if(empty($row['maker_price'])){
									   //     echo '/ 0';
									   // }else{
									   //     echo ' / '.$row['maker_price'];
									   // }
									    
									}
									else{
									    echo 'Not Assigned to any maker.';  
									}
									
									?>
	                </td>
	                
	                <td><?php echo $row['title']; ?></td>
	                 <td><?php echo $row['status'].'-'.$row['type']; ?></td>
	                <td><?php echo $row['price']; ?></td>
	                
	                
	                  <td>
	                  
	                  <?php  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }else if($row['status']=='Paid'){
	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
	                <a download="<?php echo $row['folder'];?>.pdf" href="<?php echo $filepath; ?>">Download</a>
	                /
	                
	                <?php  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }else if($row['status']=='Paid'){
	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
	                     
	                <a  href="<?php echo $filepath; ?>" target='_blank'>View</a>
	                
	                
	                </td>
	                
	                
	                 <td><a href="<?php echo base_url().'manage/franchise/studymat_delete/';?><?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" >Delete | </a> <a href="<?php echo base_url().'manage/franchise/studymat_edit/';?><?php echo $row['id']; ?>" >Edit </a></td>
					
					  
	            </tr>
	        <?php 
	           $i++; }
	       }?>
	       	</tbody>
	    </table>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>








    
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
    
    
    
    
});
</script>




<script>
//     $("#product").change(function(){
        
//         if (this.value === 8) {
//             $('#subjectdiv').show();
//             $('#varientdiv').show();
//             $('#seriesdiv').show();
//         } else {
//             $('#subjectdiv').hide();
//             $('#varientdiv').hide();
//             $('#seriesdiv').hide();
//         }
        
        
//         var product_id =this.value;
//          //alert(franchise_id);
//          var BASE_URL="https://marrs.in/franchiselogin/";
//         $.ajax({
//         url:"https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
//         data:{product_id:product_id},
//         type: 'post',
//         success:function(result)
//         {
//         	//alert(result);
//         	 $("#level").html(result);
        	 
        
//         }});
//     });
//     $('#subjectdiv').hide();
//     $('#varientdiv').hide();
//     $('#seriesdiv').hide();
    
    
    
    
 </script>


<?php include('footer.php'); ?>