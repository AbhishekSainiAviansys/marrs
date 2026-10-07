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
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" width='100%'>
				<tr>
				    	<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option style='display:none;'>Select period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `period`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					</td>
					
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product_id" id="product" style="width: 220px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_id}'>{$row->product_id} - {$row->product_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>

				
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="clevel" id="level" style="width: 220px;"  required>
                                    <option style='display:none;'>Select level</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_levels`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
                                
                               
				
					 <td>Class <br>
                            <?php
                            $query = $this->db->query("SELECT * FROM `class`;");
                            foreach ($query->result() as $row) {
                            ?>
                                <?php echo $row->class_name; ?> -> <input type="checkbox" id="<?php echo $row->class_name; ?>" name="class[]" value="<?php echo $row->class_name; ?>"> &nbsp &nbsp
                                
                            <?php
                            }
                            ?>
                        </td>

			
				</tr> 
				<tr>
				    
				   
				    <td> Title <br>
				        <input type='text' name='title' style="width: 220px;" required>
				    </td>
				    <td>Status <br>
				        <select name='status' style="width: 220px;" require>
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
				             <!--<option value='module_b_free'> Module B Free</option>-->
				             <!--<option value='module_a_paid'> Module A Paid</option>-->
				             <!--<option value='module_b_paid'>Module B Paid</option>-->
				             <!--<option value='module_c_paid'>Module C Paid</option>-->
				        </select>
				    </td>
				    
				    <!--<td></td>-->
				    <!--<td> Price :<br>-->
				    <!--    <input type='number' name='price' style="width: 220px;" required>-->
				    <!--</td>-->
				    
				    
				    
				    	
			           
				</tr>
				
				<tr>
				    <td>Study Material Maker:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="material_maker_id" id="material_maker_id" style="width: 220px;"  >
                                    <option value=''>-- Select Maker --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `material_maker` where status='Active'");
                                    
                                     foreach ($query->result_array() as $row)
                                    {
                                    ?>
                                   <option value="<?php echo $row['material_maker_id'];?>" <?php if($row['material_maker_id']==$result['material_maker_id']){ echo  'selected="selected"' ;} ?> ><?php echo $row['name'];?></option>
                                     <?php  
                                    }
                                    
                                    ?>
                                </select> 
					</td>
					
					<!--<td>Material Maker Price :<br>-->
				 <!--       <input type='number' name='maker_price' style="width: 220px;" required>-->
				 <!--   </td>-->
				    
				    
				    <td id='subjectdiv'>
				        Subject :<br>
				        <select name='subject' id='subject' style="width: 200px;" >
				            <option value=''>-- select subject --</option>
				            <?php foreach($subjects as $subject){ ?>
				            
				            <option value="<?php echo $subject->subject_key; ?>"><?php echo $subject->subject_key; ?></option>
				            <?php } ?>
				        </select>
				    </td>
				    
				    <td id='varientdiv'>
				        Varient :<br>
				        <select name='varient' id='varient' style="width: 200px;" >
				            
				        </select>
				    </td>
				    
				    <td id='seriesdiv'>
				        Series :<br>
				        <select name='series' id='series' style="width: 200px;" >
				            
				        </select>
				    </td>
				    
				    
				</tr>
				
				
				<tr>
				        <td>
			   			 Choose your file<br />  <input name="folder" type="file" id="csv" /> 
			            </td>
			            
				     <td> <br /><input type="submit" name="submit" value="Submit" class='btn btn-info btn-lg' /> </td>
				    
				</tr>
				<tr>
				    
			            <!--<input type="submit" name="ok" value="" />-->
				</tr>
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>
							 <tr>
								<th>SI no</th> <th>PRID</th> <th>PERIOD</th> 
								<!--<th>LEVEL</th> -->
								<th>Upload Report</th> <th>Current level in Student to CIN</th>
							 </tr>
							<?php    
							  $i=0;  
							  foreach($csvResult_upoload_logArray as $details): 
                                array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);							?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
									<td align="CENTER"> <?php  echo $details[2];  ?> </td>
									<td align="CENTER"> <?php  echo $details[3];  ?> </td>
									<!--<td align="CENTER"> <?php  //echo $details[4];  ?> </td>-->
									<!--<td align="CENTER"> <?php  //echo $details[7];  ?> </td>-->
									<!--<td align="CENTER"> <?php  //echo $details[5]."( ".$details[6]." )"; ?> </td>-->
							 </tr>
							<?php  endforeach; ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
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
                  
					<table  id="example" class="table table-striped table-bordered" style="width:100%;"
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
        var period = $('#period').val();


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