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
	
	
	<form action="" method="post" enctype="multipart/form-data" id="form1">

<div class="card mb-4">
    <div class="card-body">

        <div class="row g-3">

            <!-- Product -->
            <div class="col-md-3">
                <label class="form-label">Product</label>
                <select name="product_id" id="product" class="form-select" required>
                    <option hidden>Select product</option>

                    <?php foreach($load_product as $val){ ?>
                        <option value="<?php echo $val['product_id'];?>"
                            <?php if($val['product_id']==$result['product_id']) { echo 'selected="selected"';} ?>>
                            <?php echo $val['product_name'];?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Competition Level -->
            <div class="col-md-3">
                <label class="form-label">Competition Level</label>
                <select name="clevel" id="clevel" class="form-select" required>
                    <option value="">-- Select level --</option>

                    <?php if(isset($load_level)){
                        foreach($load_level as $val){ ?>
                            <option value="<?php echo $val['level_id'];?>"
                                <?php if($val['level_id']==$result['clevel']) { echo 'selected="selected"';} ?>>
                                <?php echo $val['level_name'];?>
                            </option>
                    <?php }} ?>
                </select>
            </div>

            <!-- Class -->
            <div class="col-md-3">
                <label class="form-label">Class</label>
                <select name="class" id="class" class="form-select">
                    <option value="All">All Class</option>

                    <option value="PlaySchool" <?php if(isset($result['class']) && $result['class']=='PlaySchool'){ echo 'selected="selected"'; } ?>>Play School</option>
                    <option value="Nursery" <?php if(isset($result['class']) && $result['class']=='Nursery'){ echo 'selected="selected"'; } ?>>Nursery</option>
                    <option value="LKG" <?php if(isset($result['class']) && $result['class']=='LKG'){ echo 'selected="selected"'; } ?>>LKG</option>
                    <option value="UKG" <?php if(isset($result['class']) && $result['class']=='UKG'){ echo 'selected="selected"'; } ?>>UKG</option>

                    <option value="Class-1" <?php if(isset($result['class']) && $result['class']=='Class-1'){ echo 'selected="selected"'; } ?>>Class-1</option>
                    <option value="Class-2" <?php if(isset($result['class']) && $result['class']=='Class-2'){ echo 'selected="selected"'; } ?>>Class-2</option>
                    <option value="Class-3" <?php if(isset($result['class']) && $result['class']=='Class-3'){ echo 'selected="selected"'; } ?>>Class-3</option>
                    <option value="Class-4" <?php if(isset($result['class']) && $result['class']=='Class-4'){ echo 'selected="selected"'; } ?>>Class-4</option>
                    <option value="Class-5" <?php if(isset($result['class']) && $result['class']=='Class-5'){ echo 'selected="selected"'; } ?>>Class-5</option>
                    <option value="Class-6" <?php if(isset($result['class']) && $result['class']=='Class-6'){ echo 'selected="selected"'; } ?>>Class-6</option>
                    <option value="Class-7" <?php if(isset($result['class']) && $result['class']=='Class-7'){ echo 'selected="selected"'; } ?>>Class-7</option>
                    <option value="Class-8" <?php if(isset($result['class']) && $result['class']=='Class-8'){ echo 'selected="selected"'; } ?>>Class-8</option>
                    <option value="Class-9" <?php if(isset($result['class']) && $result['class']=='Class-9'){ echo 'selected="selected"'; } ?>>Class-9</option>
                    <option value="Class-10" <?php if(isset($result['class']) && $result['class']=='Class-10'){ echo 'selected="selected"'; } ?>>Class-10</option>
                    <option value="Class-11" <?php if(isset($result['class']) && $result['class']=='Class-11'){ echo 'selected="selected"'; } ?>>Class-11</option>
                    <option value="Class-12" <?php if(isset($result['class']) && $result['class']=='Class-12'){ echo 'selected="selected"'; } ?>>Class-12</option>
                </select>
            </div>

            <!-- Type -->
            <div class="col-md-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select">
                    <option value="" <?php if(isset($result['type']) && $result['type']==''){ echo 'selected="selected"'; } ?>>All Types</option>
                    <option value="A" <?php if(isset($result['type']) && $result['type']=='A'){ echo 'selected="selected"'; } ?>>A</option>
                    <option value="B" <?php if(isset($result['type']) && $result['type']=='B'){ echo 'selected="selected"'; } ?>>B</option>
                    <option value="C" <?php if(isset($result['type']) && $result['type']=='C'){ echo 'selected="selected"'; } ?>>C</option>
                    <option value="D" <?php if(isset($result['type']) && $result['type']=='D'){ echo 'selected="selected"'; } ?>>D</option>
                    <option value="E" <?php if(isset($result['type']) && $result['type']=='E'){ echo 'selected="selected"'; } ?>>E</option>
                    <option value="F" <?php if(isset($result['type']) && $result['type']=='F'){ echo 'selected="selected"'; } ?>>F</option>
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
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" name="search" class="btn btn-primary w-100 text-capitalize">
                    Search
                </button>
            </div>

        </div>

    </div>
</div>

</form>
  </div>	
 </div><!--/span-->
 
 <?php if(!empty($list_materials)){ ?>
 
 <div class="row-fluid sortable">
   
 <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Study Material List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
						
					</div>
					<div class="box-content" style="margin:10px">
                  <tr><button name='Delete' class='btn btn-primary' id='del'>Delete Selected</button></tr>
					<table  id="example" class="table table-striped table-bordered" style="width:100%;"
	       <thead><tr>
	           <th class="text-center"><span><input type='checkbox' style="height:15px;" id='checkAll'></span><span>Select All</span></th>
	            <th>Sr. No.</th>
	            <th> Product </th>
	            <th> Type </th>
	            <th> Level </th>
	            <th> Period </th>
	            <th> Class </th>
	            <!--<th>Maker</th>-->
	            <th> Title </th>
	            <th> Status </th>
	            <th> Price </th>
	            <th>View</th>
	            <th> Download </th>
	             <th> Option</th>
	        </tr>
	          </thead>   
				<tbody>
	        <?php 
	            //print_r($list_materials);
	           
	            $i=1;
	            foreach($list_materials as $row){ 
	               // print_r($row);die;
	            ?>
	           
	            <tr>
	                <td><input type="checkbox" style="height:15px;" id="" name="ids[]" value="<?php echo $row['id']; ?>"></td>
	                <td><?php echo $i;?></td>
	                <td><?php echo $row['product_name']; ?></td>
	                <td><?php echo $row['type']; ?></td>
	                <td><?php
	                
    	                   // $query = $this->db->query("SELECT level_name FROM `competition_level_byproduct` where level_id='{$row['clevel']}' and product_name='{$row['product_name']}';");
                        //     $a=$query->result()[0]; 
    	                   // echo $a->level_name.'<br>';
    	                
    	                
    	                echo $row['level_name'];
    	                    if($row['product_name'] == 'Lunar Skill Test'){
        	                    echo 'Subject: '.$row['subject'].'<br>';
        	                    echo 'Series: '.$row['series'].'<br>';
        	                    echo 'Variant: '.$row['sub_type'];
    	                    }
    	                    
    	                    
    	                ?>
	                
	                </td>
	                <td><?php 
	               // $query = $this->db->query("SELECT academic_year FROM `period` where period_id='{$row['period']}';");
                //      $a=$query->result()[0];               
	               // echo $a->academic_year; 
	                        
	                    echo $row['academic_year'];
	                ?></td>
	                <td><?php echo $row['class']; ?></td>
	                
	                <!--<td>-->
	                <?php
	                
	                
	       //             if(!empty($row['material_maker_id'])){
								// 	$query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$row['material_maker_id']}' ");
								// 	    $result=$query->row_array();
								// 	   // print_r($result);
								// 	    echo $result['name'];
								// 	}else{
								// 	echo 'Not Assigned to any maker.';  
								// 	}
									?>
	                <!--</td>-->
	                
	                <td><?php echo $row['title']; ?></td>
	                 <td><?php echo $row['status']; ?></td>
	                <td><?php echo $row['price']; ?></td>
	                
	                <td>
	                    <?php  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }else if($row['status']=='Paid'){
	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
	                <a target='blank' href="<?php echo $filepath; ?>" >View</a>
	                    
	                </td>
	                  <td><?php  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }else if($row['status']=='Paid'){
	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
	                <a download="<?php echo $row['folder'];?>.pdf" href="<?php echo $filepath; ?>">Download</a></td>
	                 <td><a href="<?php echo base_url().'manage/franchise/studymat_delete/';?><?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');" >Delete | </a> <a href="<?php echo base_url().'manage/franchise/studymat_edit/';?><?php echo $row['id']; ?>" >Edit </a></td>
					
					  
	            </tr>
	           <?php 
	           $i++; } ?>
	       
	    </tbody>
	    </table>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>

  
</div>
 
<?php  }else{  ?>
<div class="text-center"><h5>Please select filters and click <b>Search</b> to view data.</h5></div>

	        <?php } ?>
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
        var period = 15;


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



<script>
 $("#product").change(function(){
		   
		//alert(this.value);
        var period_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/level_list_productwise/",
            data:{period_id:period_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#clevel").html(result);
        }});
    });

    
    
</script>

<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});


$("#del").click(function(){
    if(confirm("Are you sure you want to delete this?")){
        $("#del").attr("href", "query.php?ACTION=delete&ID='1'");
    }
    else{
        return false;
    }
});





</script>

<?php include('footer.php'); ?>