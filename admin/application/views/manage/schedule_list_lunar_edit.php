<?php include('header.php');

// print_r($list);
?>

<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>lunar/schedule_list">Schedule</a> <span class="divider">/</span></li>
		   <li>Edit</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Schedule Edit</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<form method="POST" >
    <input type="hidden" name="schedule_id" value="<?php echo $result['schedule_id']; ?>"> <!-- Hidden field for ID -->

    <table cellpadding="5px">
        <tr>
            <!--<td>Country:<br />-->
            <!--    <select name="country" id="country" style="width: 220px;" required>-->
                    <!--<option value="">-- Select Country --</option>-->
                    <!--<option value="105" >INDIA</option>-->
                    <?php
                    // $query = $this->db->query("SELECT * FROM countries;");
                    // foreach ($query->result() as $row) {
                    ?>
                    <!--    <option value="<?php echo $row->country_id; ?>" <?php if ($result['country'] == $row->country_id) echo 'selected'; ?>><?php echo $row->country_name; ?></option>-->
                    <?php
                    // }
                    ?>
            <!--    </select>-->
            <!--</td>-->
            <!--<td>State:<br />-->
            <!--    <select name="state_id" id="state_id" style="width: 220px;" required>-->
            <!--        <option value="">-- Select State --</option>-->
                    <?php //foreach ($stateload as $row) { ?>
                        <!--<option value="<?php echo $row['state_subdivision_id']; ?>" <?php if ($list->state_id == $row['state_subdivision_id']) echo 'selected'; ?>><?php echo $row['state_subdivision_name']; ?></option>-->
                    <?php //} ?>
            <!--    </select>-->
            <!--</td>-->
            <td>Associates:<br />
                <select name="associate_id" id="associate_id" style="width: 220px;" required>
                    <option value="">-- Select Associate --</option>
                    <?php foreach ($associates as $row) { ?>
                        <option value="<?php echo $row['associate_id']; ?>" <?php if ($list->associate_id == $row['associate_id']) echo 'selected'; ?>><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <!--<td>Area Code:<br />-->
            <!--    <select name="area" id="area" style="width: 220px;" required>-->
            <!--        <option value="">-- Select Area --</option>-->
                    <?php //foreach ($areaload as $row) { ?>
                        <!--<option value="<?php echo $row['area_code']; ?>" <?php if ($list->area == $row['area_code']) echo 'selected'; ?>><?php echo $row['area_code']; ?></option>-->
                    <?php //} ?>
            <!--    </select>-->
            <!--</td>-->
        </tr>
        <tr>
            <td>Subject:<br />
                <select name="subject" id="subject" style="width: 200px;"  required>
                                    <option value=''>-- Select Subject --</option>
                                   
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `subjects`;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->Subject_key;?>" <?php  if($list->subject==$row->Subject_key) { echo 'selected="selected"'; } ?> > <?php echo $row->Subject_key;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                                <br>
                                Varient:<br>
                            <input type='text' name='type' class='form-control' style="width: 200px;" value="<?php echo $list->type; ?>">
            </td>
            <td>
                
                Series:<br />
                <input type="text" name="series" class="form-control" value="<?php echo $list->series; ?>" readonly>
            </td>
            <td>Difficulty Level:<br />
                <select name="level" id="level" style="width: 220px;" required>
                    <option value="">-- Select Level --</option>
                    <?php
                    $query = $this->db->query("SELECT * FROM `competition_level_byproduct` WHERE product_name='Lunar Skill Test';");
                    foreach ($query->result() as $row) {
                    ?>
                        <option value="<?php echo $row->level_id; ?>" <?php if ($list->level_id == $row->level_id) echo 'selected'; ?>><?php echo $row->level_name; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
            <td>Price Code:<br />
                <select name="amount" class="form-control" required>
                    <option value="">-- Select Price Code --</option>
                    <?php foreach ($pricecodes as $code) { ?>
                        <option value="<?php echo $code['amount']; ?>" <?php if ($list->amount == $code['amount']) echo 'selected'; ?>><?php echo $code['price_code']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Associate %:<br />
                <select name="franchise_cut" required>
                    <option value="">-- Select Associate Cut --</option>
                    <option value="30" <?php if ($list->associate_cut == '30') echo 'selected'; ?>>30%</option>
                    <option value="35" <?php if ($list->associate_cut == '35') echo 'selected'; ?>>35%</option>
                    <option value="40" <?php if ($list->associate_cut == '40') echo 'selected'; ?>>40%</option>
                    <option value="45" <?php if ($list->associate_cut == '45') echo 'selected'; ?>>45%</option>
                    <option value="40" <?php if ($list->associate_cut == '50') echo 'selected'; ?>>50%</option>
                    <option value="45" <?php if ($list->associate_cut == '55') echo 'selected'; ?>>55%</option>
                    <option value="40" <?php if ($list->associate_cut == '60') echo 'selected'; ?>>60%</option>
                    <option value="45" <?php if ($list->associate_cut == '65') echo 'selected'; ?>>65%</option>
                    <option value="40" <?php if ($list->associate_cut == '70') echo 'selected'; ?>>70%</option>
                    <option value="45" <?php if ($list->associate_cut == '75') echo 'selected'; ?>>75%</option>
                    
                </select>
            </td>
            <td>Start Date:<br />
                <input type="date" name="start_date" class="form-control" value="<?php echo $list->start_date; ?>" required>
            </td>
            <td>End Date:<br />
                <input type="date" name="end_date" class="form-control" value="<?php echo $list->end_date; ?>" required>
            </td>
            <td>School:<br />
                <input type="text" name="school" class="form-control" value="<?php echo $list->school; ?>" required>
            </td>
            
            
        </tr>
        
        <tr>
            <!--<td>Material Amount:<br />-->
            <!--    <input type="text" name="material" class="form-control" value="<?php echo $list->material; ?>" required>-->
            <!--</td>-->
            <!--<td>Orientation Amount:<br />-->
            <!--    <input type="text" name="orientation" class="form-control" value="<?php echo $list->orientation; ?>" required>-->
            <!--</td>-->
            <!--<td>Mock Amount:<br />-->
            <!--    <input type="text" name="mock" class="form-control" value="<?php echo $list->mock; ?>" required>-->
            <!--</td>-->
            
            
            <td>
				        Management %<br>
				        <select name='management_percentage' required>
				            <option value=''>-- select management cut --</option>
				            <option value='5' <?php if ($list->management_percentage == '5') echo 'selected'; ?>>5%</option> 
				            <option value='6' <?php if ($list->management_percentage == '6') echo 'selected'; ?>>6%</option> 
				            <option value='7' <?php if ($list->management_percentage == '7') echo 'selected'; ?>>7%</option> 
				            <option value='8' <?php if ($list->management_percentage == '8') echo 'selected'; ?>>8%</option> 
				            <option value='9' <?php if ($list->management_percentage == '0') echo 'selected'; ?>>9%</option> 
				            <option value='10' <?php if ($list->management_percentage == '10') echo 'selected'; ?>>10%</option> 
				            <option value='12' <?php if ($list->management_percentage == '12') echo 'selected'; ?>>12%</option> 
				            <option value='14' <?php if ($list->management_percentage == '14') echo 'selected'; ?>>14%</option> 
				            <option value='15' <?php if ($list->management_percentage == '15') echo 'selected'; ?>>15%</option> 
				            <option value='16' <?php if ($list->management_percentage == '16') echo 'selected'; ?>>16%</option> 
				            <option value='18' <?php if ($list->management_percentage == '18') echo 'selected'; ?>>18%</option> 
				            <option value='20' <?php if ($list->management_percentage == '20') echo 'selected'; ?>>20%</option> 
				            <option value='22' <?php if ($list->management_percentage == '22') echo 'selected'; ?>>22%</option>
				        </select>
				    </td>
				    <td>
				        Aviansys %<br>
				        <select name='aviansys_percentage' required>
				            <option value=''>-- select aviansys cut --</option>
				            <option value='5' <?php if ($list->aviansys_percentage == '5') echo 'selected'; ?>>5%</option> 
				            <option value='6' <?php if ($list->aviansys_percentage == '6') echo 'selected'; ?>>6%</option> 
				            <option value='7' <?php if ($list->aviansys_percentage == '7') echo 'selected'; ?>>7%</option> 
				            <option value='8' <?php if ($list->aviansys_percentage == '8') echo 'selected'; ?>>8%</option> 
				            <option value='9' <?php if ($list->aviansys_percentage == '0') echo 'selected'; ?>>9%</option> 
				            <option value='10' <?php if ($list->aviansys_percentage == '10') echo 'selected'; ?>>10%</option> 
				            <option value='12' <?php if ($list->aviansys_percentage == '12') echo 'selected'; ?>>12%</option> 
				            <option value='14' <?php if ($list->aviansys_percentage == '14') echo 'selected'; ?>>14%</option> 
				            <option value='15' <?php if ($list->aviansys_percentage == '15') echo 'selected'; ?>>15%</option> 
				            <option value='16' <?php if ($list->aviansys_percentage == '16') echo 'selected'; ?>>16%</option> 
				            <option value='18' <?php if ($list->aviansys_percentage == '18') echo 'selected'; ?>>18%</option> 
				            <option value='20' <?php if ($list->aviansys_percentage == '20') echo 'selected'; ?>>20%</option> 
				            <option value='22' <?php if ($list->aviansys_percentage == '22') echo 'selected'; ?>>22%</option>
				        </select>
				    </td>
			</tr>
       <tr>	    
    			<td>
                    <?php 
                    
                    $schedule_id = $list->lunar_schedule_id; 
                    $assigned_classes_query = $this->db->select('class')
                        ->from('lunar_schedule_class')
                        ->where('sch_id', $schedule_id)
                        ->get();
                    $assigned_classes = array_column($assigned_classes_query->result_array(), 'class'); // Replace 'class' with the correct column name if needed
                
                    // Fetch all classes
                    $query = $this->db->get('class'); 
                    $classes = $query->result_array(); // Ensure this query is present to populate $classes
                
                    // Loop through classes and generate checkboxes
                    foreach ($classes as $class): ?>
                        <div>
                            <input 
                                type="checkbox" 
                                name="classes[]" 
                                value="<?= htmlspecialchars($class['class_name']); ?>" 
                                <?= in_array($class['class_name'], $assigned_classes) ? 'checked' : ''; ?>> 
                            <?= htmlspecialchars($class['class_name']); ?>
                        </div>
                    <?php endforeach; ?>
                </td>
       
            <td>
                <input type="submit" class="btn btn-primary btn-lg" name="submit" value="Update">
            </td>
        </tr>
    </table>
</form>



</div>
				</div>
			</div>
<script
      src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
      integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
<?php include('footer.php'); ?>


<script type="text/javascript">
$("#country").change(function(){
var country_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/getstateAjax",
data:{country_id:country_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#state_id").html(result);
	 

}});
});


$("#area").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_list_checkbox",
data:{area_code:area_code},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

}});
});

$("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/franchiseList__",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});

$("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/statewisearea",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>