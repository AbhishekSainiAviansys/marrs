<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
// print_r($result['choice']);	 
	     
	 
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

<div class="container">

    <!-- ROW 1 -->
    <div class="row g-3">

        <!-- Product -->
        <div class="col-md-3">
            <label class="form-label">Product <span class="text-danger">*</span></label>
            <select name="product_id" id="product" class="form-select" required>
                <option style='display:none;'>Select product</option>
                <?php foreach($load_product as $val){ ?>
                    <option value="<?php echo $val['product_id'];?>"
                        <?php if($val['product_id']==$result['product_id']) { echo 'selected="selected"';} ?>>
                        <?php echo $val['product_name'];?>
                    </option>
                <?php }?>
            </select>
        </div>

        <!-- Competition Level -->
        <div class="col-md-3">
            <label class="form-label">Competition Level <span class="text-danger">*</span></label>
            <select name="clevel" id="clevel" class="form-select" required>
                <option value=''>-- Select level --</option>
                <?php if(isset($load_level)){
                    foreach($load_level as $val){ ?>
                    <option value="<?php echo $val['level_id'];?>"
                        <?php if($val['level_id']==$result['clevel']) { echo 'selected="selected"';} ?>>
                        <?php echo $val['level_name'];?>
                    </option>
                <?php }} ?>
            </select>
        </div>

        <!-- Status -->
        <div class="col-md-2">
            <label class="form-label">Status</label>
            <select name='status' class="form-select">
                <option value='' <?php if(isset($result['status']) && $result['status']==''){ echo 'selected="selected"'; } ?>>-- All Status --</option>
                <option value='Free' <?php if(isset($result['status']) && $result['status']=='Free'){ echo 'selected="selected"'; } ?>>Free</option>
                <option value='Paid' <?php if(isset($result['status']) && $result['status']=='Paid'){ echo 'selected="selected"'; } ?>>Paid</option>
            </select>
        </div>

        <!-- Type -->
        <div class="col-md-2">
            <label class="form-label">Type</label>
            <select name='type' class="form-select">
                <option value='' <?php if(isset($result['type']) && $result['type']==''){ echo 'selected="selected"'; } ?>>-- All Type --</option>
                <?php foreach(['A','B','C','D','E','F'] as $t){ ?>
                    <option value="<?php echo $t; ?>" <?php if(isset($result['type']) && $result['type']==$t){ echo 'selected="selected"'; } ?>>
                        <?php echo $t; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

    </div>

    <!-- ROW 2 -->
    <div class="row g-3 mt-1">

        <!-- Subject -->
        <div class="col-md-3" id="subjectdiv">
            <label class="form-label">Subject</label>
            <select name='subject' id='subject' class="form-select">
                <option value=''>-- select subject --</option>
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

        <!-- Period -->
        <div class="col-md-3">
            <label class="form-label">Select To Assign Period <span class="text-danger">*</span></label>
            <select name="period_id" id="period_id" class="form-select" required>
                <option value=''>-- select period --</option>
                <?php foreach($load_period as $val){ ?>
                    <option value="<?php echo $val['period_id'];?>"
                        <?php if($val['period_id']==$result['period_id']) { echo 'selected="selected"';} ?>>
                        <?php echo $val['academic_year'];?>
                    </option>
                <?php } ?>
            </select>
        </div>

    </div>

    <!-- ROW 3 -->
    <div class="row g-3 mt-1 align-items-end">

        <!-- Choice -->
        <div class="col-md-3">
            <label class="form-label">Choice</label>
            <select name='choice' class="form-select">
                <option value='Mat' <?php if(isset($result['choice']) && $result['choice']=='Mat'){ echo 'selected="selected"'; } ?>>Material</option>
                <option value='Moc' <?php if(isset($result['choice']) && $result['choice']=='Moc'){ echo 'selected="selected"'; } ?>>Mock</option>
            </select>
        </div>

        <!-- Button -->
        <div class="col-md-2">
            <button type="submit" name="search" class="btn btn-primary w-100">Search</button>
        </div>

    </div>

</div>

</form>  </div>	
 </div><!--/span-->
 
 <?php if(!empty($list_materials) or !empty($list_mock)){ ?>
 
    <div class="row-fluid sortable">
   
        
			<div>		
				<div class="box span12">
					
					<div class="box-content" style="margin:10px">
					   
	                    <?php if($result['choice'] == 'Mat'){ ?>
	                    <form method="POST">
                              <table class="table table-bordered">
                                <thead>
                                <tr>
        	                        <div class="box-header well" data-original-title>
                						<h2><i class="icon-user"></i> Study Material List</h2>
                						<div class="box-icon">
                							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                						</div>
                						
                					</div>
        	                    </tr>
                                  <tr>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Added Year</th>
                                    <th>Class</th>
                                    <th>Title</th>
                                    <th>View Material</th>
                                    <th>Status</th>
                                    <!--<th>Price</th>-->
                                    <th>Content Maker</th>
                                    <th>Assign</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($list_materials as $row): ?>
                                    <?php
                                    $assigned = $this->db->get_where('assigned_materials', [
                                      'period_id' => $result['period_id'],
                                      'mat_id'    => $row['id']
                                    ])->row();
                                    ?>
                                    <tr>
                                      <td><?= $row['product_name'] ?></td>
                                      <td><?= $row['type'] ?></td>
                                      <td>
                                        <?php
                                        $q = $this->db->query("SELECT level_name FROM competition_level_byproduct WHERE level_id='{$row['clevel']}' AND product_name='{$row['product_name']}'")->row();
                                        echo $q->level_name ?? '';
                                        if ($row['product_name'] == 'Lunar Skill Test') {
                                          echo "<br>Subject: {$row['subject']}<br>Series: {$row['series']}<br>Variant: {$row['sub_type']}";
                                        }
                                        ?>
                                      </td>
                                      <td>
                                            <?php 
                                            
                                                $period = $this->db->get_where('period', array('period_id' => $row['period']))->row();
                                              
                                                echo $period->academic_year;
                                          
                                            ?>
                                      </td>
                                      
                                      <td><?= $row['class']; ?></td>
                                      <td><?= $row['title']; ?></td>
                                      
                                      <td>
                    	                    <?php  if($row['status']=='Free'){
                    	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
                    	                  }else if($row['status']=='Paid'){
                    	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
                    	                <a target='blank' href="<?php echo $filepath; ?>" class="btn btn-outline-warning" >View</a>
                    	                    
                    	                </td>
                                      <td><?= $row['status'] ?></td>
                                        <!--<td>-->
                                        <!--      <input -->
                                        <!--        type="text" -->
                                        <!--        name="price[<?= $row['id'] ?>]" -->
                                        <!--        value="<?= ($row['status'] === 'Free') ? 0 : ($assigned->price ?? '') ?>" -->
                                        <!--        <?= ($row['status'] === 'Free') ? 'readonly style="background-color:#f1f1f1;"' : '' ?>-->
                                        <!--      >-->
                                        <!--</td>-->

                                      
                                      <td>
                                        <select name="maker_id[<?= $row['id'] ?>]">
                                          <option value="">-- select maker --</option>
                                          <?php
                                          $makers = $this->db->get_where('material_maker', ['status' => 'Active'])->result();
                                          foreach ($makers as $maker) {
                                            $selected = (isset($assigned->maker_id) && $maker->material_maker_id == $assigned->maker_id) ? 'selected' : '';
                                            echo "<option value='{$maker->material_maker_id}' $selected>{$maker->name}</option>";
                                          }
                                          ?>
                                        </select>
                                      </td>
                                      <td>
                                        
                                        <?php 
                                        
                                            $this->db->select('*');  
                                            $this->db->from('assigned_materials');
                                            $this->db->where('mat_id',$row['id']);  
                                            $this->db->where('period_id',$result['period_id']); 
                                            $query = $this->db->get();   
                                            $asss=$query->row();
                                            
                                        ?>  
                                          
                                        <?php if (!$assigned): ?>
                                          <input type="checkbox" name="assign_mat[]" value="<?= $row['id'] ?>">
                                        <?php else: ?>
                                          Already Assigned
                                          
                                            <a 
                                              href="javascript:void(0);" 
                                              class="btn btn-warning unassign-btn" 
                                              data-id="<?php echo $asss->id; ?>"
                                            >
                                              Unassign
                                            </a>
                                          
                                        <?php endif; ?>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                              
                                    <input type='hidden' name='period_id' value='<?php echo $result['period_id']; ?>' > 
                                    <input type='hidden' name='clevel' value='<?php echo $result['clevel']; ?>' > 
                                    <input type='hidden' name='product_id' value='<?php echo $result['product_id']; ?>' > 
                                    <input type='hidden' name='choice' value='<?php echo $result['choice']; ?>' > 
                                    
                                <button type="submit" name="submit_assign" class="btn btn-primary">Assign Materials</button>
                                
                            </form>

	                    <?php }else{ ?>
	                    
	                    <!--<br><br>-->
	                    
	                    <form method="POST">
                          <table id="example" class="table table-striped table-bordered" style="width:100%;">
                            <thead>
                                <tr>
        	                        <div class="box-header well" data-original-title>
                						<h2><i class="icon-user"></i> Mock Test List</h2>
                						<div class="box-icon">
                							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                						</div>
                						
                					</div>
        	                    </tr>
                              <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Level</th>
                                <th>Added Year</th>
                                <th>Class</th>
                                <th>Title</th>
                                <th>View</th>
                                <th>Status</th>
                                <!--<th>Price</th>-->
                                <th>Content Maker</th>
                                <th>Assign</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($list_mock as $row): ?>
                                <?php
                                $dd = $this->db->get_where('assigned_mock', [
                                  'period_id' => $result['period_id'],
                                  'mat_id'    => $row['paper_id']
                                ])->row();
                                ?>
                                <tr>
                                  <td><?= $row['product_name']; ?></td>
                                  <td><?= $row['type']; ?></td>
                                  <td>
                                    <?php
                                    $query = $this->db->query("SELECT level_name FROM competition_level_byproduct WHERE level_id='{$row['clevel']}' AND product_name='{$row['product_name']}'")->row();
                                    echo $query->level_name ?? '';
                                    if ($row['product_name'] == 'Lunar Skill Test') {
                                      echo "<br>Subject: {$row['subject']}<br>Series: {$row['series']}<br>Variant: {$row['sub_type']}";
                                    }
                                    ?>
                                  </td>
                                   <td>
                                       
                                            <?php 
                                            
                                                $period = $this->db->get_where('period', array('period_id' => $row['period_id']))->row();
                                              
                                                echo $period->academic_year;
                                          
                                            ?>
                                      </td>
                                  <td><?= $row['class']; ?></td>
                                  <td><?= $row['paper_name']; ?></td>
                                  <td align="CENTER">
                                   <?php  echo $row['folder1'];  
                                  
									if(!empty($row['folder1'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $row['folder1'];?>' class="btn btn-outline-warning" target='blank' >View File-1</a>
									    
									    <?php
									}
									
									 
									if(!empty($row['folder2'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $row['folder2'];?>' class="btn btn-outline-warning" target='blank' >View File-2</a>
									    
									    <?php
									}
									
									if(!empty($row['folder3'])){ ?>
									    <a href='https://marrs.in/mock_papers/<?php echo $row['folder3'];?>' class="btn btn-outline-warning" target='blank' >View File-3</a>
									    
									    <?php
									}
									
									if(!empty($row['folder4'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $row['folder4'];?>'class="btn btn-outline-warning" target='blank' >View File-4</a>
									    
									    <?php
									}
									?> 
								    </td>
								    
								    <td><?= $row['pay_status']; ?></td>
                                    <!--<td>-->
                                    <!--    <input -->
                                    <!--      type="text" -->
                                    <!--      name="price[<?= $row['paper_id']; ?>]" -->
                                    <!--      value="<?= ($row['pay_status'] === 'Free') ? 0 : ($dd->price ?? '') ?>" -->
                                    <!--      <?= ($row['pay_status'] === 'Free') ? 'readonly' : '' ?>-->
                                    <!--    >-->
                                    <!--</td>-->
                        
                                  <td>
                                    <select name="maker_id[<?= $row['paper_id']; ?>]">
                                      <option value="">-- select maker --</option>
                                      <?php
                                      $makers = $this->db->get_where('material_maker', ['status' => 'Active'])->result();
                                      foreach ($makers as $res) {
                                        $selected = (isset($dd->maker_id) && $res->material_maker_id == $dd->maker_id) ? 'selected' : '';
                                        echo "<option value='{$res->material_maker_id}' $selected>{$res->name}</option>";
                                      }
                                      ?>
                                    </select>
                                  </td>
                        
                                  <td>
                                      
                                        <?php 
                                        
                                            $this->db->select('*');  
                                            $this->db->from('assigned_mock');
                                            $this->db->where('mat_id',$row['paper_id']);  
                                            $this->db->where('period_id',$result['period_id']); 
                                            $query = $this->db->get();   
                                            $asss=$query->row();
                                            
                                        ?>  
                                      
                                    <?php if (!$dd): ?>
                                      <input type="checkbox" name="assign_mock[]" value="<?= $row['paper_id']; ?>">
                                    <?php else: ?>
                                      Already Assigned
                                      
                                            <a 
                                              href="javascript:void(0);" 
                                              class="btn btn-warning unassign1-btn" 
                                              data-id="<?php echo $asss->id; ?>"
                                            >
                                              Unassign
                                            </a>
                                      
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                        
                              <tr>
                                <td colspan="9">
                                  <input type="hidden" name="period_id" value="<?= $result['period_id']; ?>">
                                  <input type="hidden" name="clevel" value="<?= $result['clevel']; ?>">
                                  <input type="hidden" name="product_id" value="<?= $result['product_id']; ?>">
                                  <input type='hidden' name='choice' value='<?php echo $result['choice']; ?>' > 
                                  
                                  <input type="submit" name="assign_mocktest" value="Assign MockTest" class="btn btn-primary">
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </form>

	                    <?php } ?>
	                    
    			    </div>
    			    
    		    </div><!--/span-->
    	`
    	    </div><!--/row-->
			
        

  
    </div>
 
<?php  }else{  ?>

<div class="text-center"><h5>        Please select filters and click <b>Search</b> to view data. </h5></div>

	        <?php } ?>
</div><!--/row-->

<script>
$(document).on('click', '.unassign-btn', function() {
    if (!confirm('Are you sure you want to unassign this material?')) return;

    const id = $(this).data('id');

    $.ajax({
        url: "https://marrs.in/franchiselogin/manage/franchise/delete_assign_mat",
        type: "POST",
        data: { id: id },
        success: function(response) {
            // You can optionally show a success message here
            location.reload(); // reloads page after success
        },
        error: function(xhr) {
            alert('Something went wrong while unassigning.');
        }
    });
});


$(document).on('click', '.unassign1-btn', function() {
    if (!confirm('Are you sure you want to unassign this material?')) return;

    const id = $(this).data('id');

    $.ajax({
        url: "https://marrs.in/franchiselogin/manage/franchise/delete_assign_mock",
        type: "POST",
        data: { id: id },
        success: function(response) {
            // You can optionally show a success message here
            location.reload(); // reloads page after success
        },
        error: function(xhr) {
            alert('Something went wrong while unassigning.');
        }
    });
});

</script>


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