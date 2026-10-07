<?php include('header.php');

// print_r($franchise2);
?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>School List</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> School List</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
    <h3 style='color:green;'>
        <?php
            if(!empty($message)){
                echo $message;
            }
        ?>
    </h3>
    <form method='post' class='table-responsive'>
                        <!----------------- Franchise ------------------->       
        <table  cellpadding="5px" >
				<tr>
				    
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option value=''>-- Select Country --</option>
                                    <option value='105'>INDIA</option>
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <!--<option value="<?php echo $row->country_id;?>" <?php  if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>-->
                                  <?php
                                    // }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 220px;"  required>
                                    <option value=''>-- Select State --</option>
                                    
                                     <?php
                                       
                                     foreach ($stateload as $row)
                                    { 
                                    ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>
                                  
                                  <?php   
                                        
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					  
					  <td>Period:<br />
                                <select name="period" id="period" style="width: 220px;"  required>
                                    <option value=''>-- Select Period --</option>
                                    
                                    
                                     <?php
                                     
                                    $query = $this->db->query("SELECT * FROM period where period_id > 14;");
                                    
                                    foreach ($query->result() as $row)
                                    {
                                        // echo "<option value='{$row->period_id}'   >{$row->period_name}</option>";
                                        ?>
                                    <option value="<?php echo $row->period_id;?>" <?php  if($result['period']==$row->period_id) { echo 'selected="selected"'; } ?> > <?php echo $row->period_name;?></option>
                                    <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					  
                        <td>
                            Difficulty Level:</br>
                            <select name="level" id="level" style="width: 220px;"  required>
                                    <option value=''>-- Select Level --</option>
                                   
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `competition_level_byproduct` WHERE product_name='MaRRS Math Zoom Zoom Challenge';"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->level_id;?>" <?php  if($result['level']==$row->level_id) { echo 'selected="selected"'; } ?> > <?php echo $row->level_name;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                            
                        </td>
					 
				       
				    <!--<td>-->
        <!--                    Subject:</br>-->
        <!--                    <select name="subject" id="subject" style="width: 220px;"  required>-->
        <!--                        <option value=''>-- Select Subject --</option>-->
                                   
                                <?php
                                     
                                    // $query = $this->db->query("SELECT * FROM `lunar_subjects` where status= 'Active';"); 
                                    
                                    // foreach ($query->result() as $row)
                                    // {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                    ?>
                                    <!--<option value="<?php echo $row->subject_key;?>" <?php  if($result['subject']==$row->subject_key) { echo 'selected="selected"'; } ?> > <?php echo $row->subject_key;?></option>-->
                                    
                                    <?php
                                        
                                    // }
                                    
                                    ?>
                                <!--</select>-->
                            
                        <!--</td>-->
					  
					    
				    <td> <input type="submit" class='btn btn-primary btn-lg' name="submit" value="Search" /> </td>
			
				</tr>
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
    </form>
 
<?php
					if(!empty($list)){
					   // print_r($list);
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
							        <th>Sr. no</th>
							        <th>Registration ID</th>
							        <th>Registration Code</th>
								    <th>Period</th>
								  
								    <th>Competition Level / Class</th>
    								<th>Product Name</th>
    								  <!--<th>Class</th>-->
								    <th>Associate</th>
                                    <th>Registration Date</th>
                                    <th>Active Classes</th>
                                    <th>School</th>
                                    <th>Assigned Parts</th>
                                    <th>Pricing</th>
								    <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>		  							
							
						<?php 
						$i=1;
						foreach($list as $value){ //print_r($value); ?>	
							<tr>
							    <td><?php echo $i; ?></td>
							    
							    <td><?php echo $value['zoomzoom_schedule_id']; ?></td>
							    
                                <td>
                                    <?php 
                                    
                                    $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE  clevel='" . $value['level_id'] . "' and product_name='" . $value['product_name'] . "'  and period_id='" . $value['period_id'] . "' ;");
                                        // echo $this->db->last_query();
                                    $res=$query->row();
                                        
                                    if(empty($res)){
                                        echo 'Not Assigned, Please Assigned First.';
                                    }else{
                                        echo $value['registration_code'];
                                    }
                                    
                                    ?>
                                    
                                    
                                    
                                    <!--<div id="qrcode" value='<?php echo $value['registration_code']; ?>'></div>-->
                                                    
                                        <!--<div id="qrcodePreview" style='padding-top:10px;'></div>-->
                                        <!--<div  class="">-->
                                        <!--        <button id="downloadButton" value='<?php echo 'https://marrs.in/student_registration/welcome/scanner/'.$value['registration_code']; ?>' class="btn btn-primary">Download QR Code</button>-->
                                                
                                        <!--</div>-->
                                </td>




                                <td><?php echo $value['period_name']; ?></td>
								
                                <td>
                                    <?php echo $value['level_name']; ?>
                                    <br>
                                    
                                </td>
								 <td>
								     
								    <?php echo $value['product_name'];?>
								    <br/><b>Franchise :</b> <?php echo $value['company_name'];?>
								    <br/><b>Franchise% :</b> <?php echo $value['franchise_percentage'];?>%
								    <br/><b>Associate% :</b> <?php echo $value['associate_cut'];?>%
                                    
								 </td>
                                 <td>
                                     <?php 
                                        echo $value['first_name'].' '.$value['last_name']; ?>
                                        
                                        <br/><b>Management:</b> <?php echo $value['management_percentage'];?> %
                                        <br/><b>Aviansys:</b> <?php echo $value['aviansys_percentage'];?> %
                                        <br/><b>CRM Fix:</b> <?php echo $value['crm_fix'];?>
                                    </td>
                                    <!--<td><?php echo $value['franchise_code'] ?></td>-->
                                    <td>
                                        <?php echo 'Start Date: '.$value['start_date'] ?> 
                                        <?php echo 'End Date: '.$value['end_date'] ?>
                                    </td>
                                    <td>
                                    <?php
                                         
                                        // $i=1;
                                        $query = $this->db->query("SELECT * FROM `zoomzoom_schedule_class`  WHERE sch_id='" . $value['zoomzoom_schedule_id'] . "';");
    
                                        foreach ($query->result() as $row)
                                        {
                                         echo $row->class;
                                         echo '<br>';
                                        //  $i=$i+1;
                                        }
                                        
                                    ?>
                                    <a class="delete btn btn-success" href="<?php echo SITE_URL?>zoomzoom/class_update/<?php echo $value['zoomzoom_schedule_id']; ?>" target="_BLANK" > Update Class </a>
                                    
                                    
                                    </td>
                                    <td>
                                        <b>School Fix: Rs.</b> <?php echo $value['school_amount'];?> 
                                        <br>
                                        <?php
                                         
                                         $i=1;
                                        $query = $this->db->query("SELECT * FROM `lunar_schedule_school`  join school_new on school_new.id=lunar_schedule_school.school_id   WHERE sch_id='" . $value['zoomzoom_schedule_id'] . "';");
    
                                        foreach ($query->result() as $row)
                                        {
                                         echo $i.'. '.$row->school_name;
                                         echo '<br>';
                                         $i=$i+1;
                                        }
                                        
                                        ?>
                                    </td>
                                    <td>
                                        <?php  
                                        
                                        $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE id='" . $value['comp_id'] . "';");
                                        // echo $this->db->last_query();
                                        $res=$query->row();
                                        
                                        if(empty($res)){
                                            echo 'Not Assigned, Go to assign to cart tab inside Math ZoomZoom Menu.';
                                        }
                                        else
                                        {
                                            // $this->db->select('*');
                                            // $this->db->from('active_materials');
                                            // $this->db->join('study_material','study_material.id=active_materials.mat_id');
                                            // $this->db->where('active_materials.comp_id',$res->id);
                                            // $query=$this->db->get();
                                            
                                            // $i=1;
                                            // foreach($query->result() as $row){
                                            //     echo $i.': Title : '.$row->title.' Type: '.$row->type.' Status: '.$row->status;
                                            //     echo '<br>';
                                            //     $i=$i+1;
                                            // }
                                            
                                            
                                            $i=1;
                                            foreach($res as $row){
                                                if(!empty($row)){
                                                    print_r($row);
                                                    echo '<br>';
                                                    $i=$i+1;
                                                }
                                                
                                            }
                                        }
                                    
                                        
                                        
                                        ?>
                                        
                                        
                                    </td>
                                    
                                    
                                    <td>
                                        <?php echo 'Product Price = Rs '.$value['amount'] ?><br/>
                                        
									</td> 
                                
                                        
                                    
							
								    <td class="center">
								    <?php 
    								    $query = $this->db->query("SELECT * FROM `competition_product_state` WHERE  id='" . $value['comp_id'] . "' ;");
                                            // echo $this->db->last_query();
                                        $res=$query->row();
                                            
                                        if(empty($res)){
                                            echo 'Not Assigned, Please Assigned First.';
                                        }else{ ?>
                                            <a class="delete btn btn-success" href="<?php echo SITE_URL?>zoomzoom/payments/<?php echo $value['zoomzoom_schedule_id']; ?>" target="_BLANK" >
                                            <?php    
                                        }
    								
    								?>
    									<!--<a class="btn btn-info" href="<?php echo SITE_URL?>lunar/edit/id/<?php echo $value['lunar_schedule_id']; ?>" title="Edit">-->
    										<!--<i class="icon-edit icon-white"></i>  -->
    										                                           
    									<!--</a>-->
									
									
									<!--</td><td class="center">-->
									<!--<a class="delete btn btn-success" href="<?php echo SITE_URL?>lunar/payments/<?php echo $value['lunar_schedule_id']; ?>" target="_BLANK" >-->
										<!--<i class="icon-trash icon-white"></i> -->
										Payment Split
									</a>
									
									<!--title="Delete"  onclick="return confirm('Are you sure you want to delete?')"-->
									<br>
    								<br>
    									<a class="btn btn-info" href="<?php echo SITE_URL?>zoomzoom/zoomzoom_schedule_update/<?php echo $value['zoomzoom_schedule_id']; ?>" target="_BLANK" title="Edit">
    										<i class="icon-edit icon-white"></i>  
    										                                           
    									</a>
									<br>
                                    <br>
                                    <a class="btn btn-danger" 
                                       href="<?php echo SITE_URL?>zoomzoom/zoomzoom_schedule_delete/<?php echo $value['zoomzoom_schedule_id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this schedule?');" 
                                       title="Delete">
                                        <i class="icon-trash icon-white"></i>
                                    </a>
									
									
								</td>
							</tr>
						<?php $i=$i+1;} ?>	
						  </tbody>
					  </table> 
					<?php }else{ ?> <h4 style='color:crimson'>'Error: No Schedule Found. Add schedule'</h4><?php }?>  
					

 

 
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
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>  
// $(document).ready(function() {
//     var variableValue = $("#downloadButton").val();
//     var schoolName = "<?php echo $schoolList['school_name']; ?>";
//     var schoolCode = "<?php echo $schoolList['school_code']; ?>";
//     var qrCodeSize = 200; // Increased size of the QR code
//     var padding = 30; // Adjust the padding size as needed
//     var textHeight = 100; // Increased height for the text to accommodate multiple lines and heading

//     // Create QR code
//     var qrcode = new QRCode(document.getElementById("qrcode"), {
//         text: variableValue,
//         width: qrCodeSize,
//         height: qrCodeSize,
//         correctLevel: QRCode.CorrectLevel.H
//     });

//     // Generate the QR code
//     qrcode.makeCode(variableValue);

//     $("#downloadButton").click(function() {
//         var canvas = $("#qrcode canvas")[0];

//         // Create a new canvas to add padding and text
//         var paddedCanvas = document.createElement("canvas");
//         var context = paddedCanvas.getContext("2d");

//         // Set the new canvas size
//         paddedCanvas.width = canvas.width + padding * 4;
//         paddedCanvas.height = canvas.height + padding * 4 + textHeight;

//         // Fill the new canvas with white background
//         context.fillStyle = "#ffffff";
//         context.fillRect(0, 0, paddedCanvas.width, paddedCanvas.height);

//         // Draw the heading at the top
//         var heading = "MaRRS Registration 2024-25";
//         context.fillStyle = "#FF9933"; // Saffron color
//         context.font = "bold 20px Arial"; // Font size and type
//         context.textAlign = "center"; // Center align
//         context.fillText(heading, paddedCanvas.width / 2, 30); 
        

//         // Split school name into lines if necessary
//         var lines = [];
//         var maxLineLength = 30; // Maximum characters per line
//         while (schoolName.length > maxLineLength) {
//             var lastSpace = schoolName.lastIndexOf(' ', maxLineLength);
//             var splitIndex = lastSpace > 0 ? lastSpace : maxLineLength;
//             lines.push(schoolName.substring(0, splitIndex));
//             schoolName = schoolName.substring(splitIndex).trim();
//         }
//         lines.push(schoolName);

//         // Draw the school name below the heading
//         context.fillStyle = "#0d6efd"; // Text color
//         context.font = "bold 18px Arial"; // Font size and type
//         context.textAlign = "center"; // Center align
//         for (var i = 0; i < lines.length; i++) {
//             context.fillText(lines[i], paddedCanvas.width / 2, 60 + (i * 20)); // Adjust the position as needed
//         }

//          context.fillText(schoolCode, paddedCanvas.width / 2, 60 + (lines.length * 20) + 20);

//         // Draw the original QR code onto the new canvas with padding
//         var qrX = (paddedCanvas.width - canvas.width) / 2;
//         var qrY = padding + textHeight;
//         context.drawImage(canvas, qrX, qrY);
        
//         paddedCanvas.toBlob(function(blob) {
//             saveAs(blob, "qrcode.jpg");
//         });
//     });
// });
</script>

<script>
$(document).ready(function() {
    var variableValue = $("#downloadButton").val();
    var schoolName = "<?php echo $schoolList['school_name']; ?>";
    var schoolCode = "<?php echo 'Access Code - '.$value['registration_code']; ?>";
    var qrCodeSize = 200; // Increased size of the QR code
    var padding = 30; // Adjust the padding size as needed
    var textHeight = 100; // Increased height for the text to accommodate multiple lines and heading
    var schoolLogo = "<?php echo !empty($schoolList['profile']) ? 'https://marrs.in/images/school/' . $schoolList['profile'] : ''; ?>";
    
    // Create QR code
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: variableValue,
        width: qrCodeSize,
        height: qrCodeSize,
        correctLevel: QRCode.CorrectLevel.H
    });

    // Generate the QR code
    qrcode.makeCode(variableValue);

    $("#downloadButton").click(function() {
        var canvas = $("#qrcode canvas")[0];

        // Create a new canvas to add padding, text, and logo
        var paddedCanvas = document.createElement("canvas");
        var context = paddedCanvas.getContext("2d");

        // Set the new canvas size
        paddedCanvas.width = canvas.width + padding * 4;
        paddedCanvas.height = canvas.height + padding * 4 + textHeight + 100; // Additional space for the logo

        // Fill the new canvas with white background
        context.fillStyle = "#ffffff";
        context.fillRect(0, 0, paddedCanvas.width, paddedCanvas.height);

        // Draw the heading at the top
        var heading = "Cambridge Registration 2024-25";
        context.fillStyle = "#FF9933"; // Saffron color
        context.font = "bold 18px Arial"; // Font size and type
        context.textAlign = "center"; // Center align
        context.fillText(heading, paddedCanvas.width / 2, 25); // Adjust the position as needed
        
        context.fillStyle = "#24478f";
        context.font = "bold 14px Arial";
        context.fillText(schoolCode, paddedCanvas.width / 2, 40); 
        // Split school name into lines if necessary
        var lines = [];
        var maxLineLength = 30; // Maximum characters per line
        while (schoolName.length > maxLineLength) {
            var lastSpace = schoolName.lastIndexOf(' ', maxLineLength);
            var splitIndex = lastSpace > 0 ? lastSpace : maxLineLength;
            lines.push(schoolName.substring(0, splitIndex));
            schoolName = schoolName.substring(splitIndex).trim();
        }
        lines.push(schoolName);

        // Draw the school name below the heading
        context.fillStyle = "#0d6efd"; // Text color
        context.font = "bold 18px Arial"; // Font size and type
        context.textAlign = "center"; // Center align
        for (var i = 0; i < lines.length; i++) {
            context.fillText(lines[i], paddedCanvas.width / 2, 60 + (i * 20)); // Adjust the position as needed
        }

        // Load the school logo if it exists
        if (schoolLogo !== '') {
            var logo = new Image();
            logo.src = schoolLogo;
            logo.onload = function() {
                var logoSize = 150;
                var logoX = (paddedCanvas.width - logoSize) / 2; // Centering the logo horizontally
                var logoY = 60 + (lines.length * 20) + 20; // Position below the school name
                context.drawImage(logo, logoX, logoY, logoSize, logoSize);

                // Draw the original QR code onto the new canvas with padding
                var qrX = (paddedCanvas.width - canvas.width) / 2;
                var qrY = logoY + logoSize + padding; // Position below the logo
                context.drawImage(canvas, qrX, qrY);

                // Save the padded QR code with text and logo
                paddedCanvas.toBlob(function(blob) {
                    saveAs(blob, "qrcode.jpg");
                });
            };
        } else {
            // Draw the original QR code onto the new canvas with padding
            var qrX = (paddedCanvas.width - canvas.width) / 2;
            var qrY = 60 + (lines.length * 20) + padding; // Position below the school name
            context.drawImage(canvas, qrX, qrY);

            // Save the padded QR code with text
            paddedCanvas.toBlob(function(blob) {
                saveAs(blob, "qrcode.jpg");
            });
        }
    });
});
</script>