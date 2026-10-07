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
<h3 style='color:crimson;'>
 <?php
 if(!empty($message)){
     echo $message;
 }
 ?>
 </h3>
 <form method='post'>
                        <!----------------- Franchise ------------------->       
                        <table  cellpadding="5px" >
				<tr>
				    
				    <td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period_id" id="period_id" style="width: 220px;"  required>
                                    <option value=''>-- Select Period --</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period where period_id > '12';"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->period_id;?>" <?php  if($result['period_id']==$row->period_id) { echo 'selected="selected"'; } ?> > <?php echo $row->academic_year;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
                 
                 
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option value=''>-- Select Country --</option>
                                    <option value='105'>INDIA</option>
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->country_id;?>" <?php  if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 220px;"  required>
                                    <option value=''>-- Select State --</option>
                                    
                                     <?php
                                       
                                     foreach ($stateload as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					  <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 220px;"  required>
                                    <option value=''>-- Select Franchise --</option>
                                     <?php
                                     
                                    
                                     foreach ($franchise2 as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['franchise_id'];?>" <?php  if($result['franchise_id']==$row['franchise_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['franchise_code'].' '.$row['franchise_first_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                        
                                </select>
					 </td>
					 
					 
				
			                <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 220px;"  required>
                                    <option value=''>-- Select Area --</option>
                                    <?php
                                     
                                     foreach ($areaload as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row['area_code'];?>'<?php  if($result['area']==$row['area_code']) { echo 'selected="selected"'; } ?>><?php echo $row['area_code'];?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select>  
					 </td>
					
						<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="school"  id='school' style='width: 220px;'  >
                                    <?php if(isset($result['school'])){ ?>    
                                        <option value="">-- Error: Select One School --</option>
                                    <?php }else{ ?>    
                                        <option >-- Select School --</option>
                                    <?php } ?>
                                    
                                      <?php
                                      foreach($schoolload as $row){
                                     ?>
                                    <option value='<?php echo $row['id'];?>'<?php  if($result['school']==$row['id']) { echo 'selected="selected"'; } ?>><?php echo $row['school_name'];?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                </select>
                              
                               
					 </td>
					 
					 </tr> 
					
			   <td> <br /><input type="submit" class='btn btn-primary' name="submit" value="Search" /> </td>
				
				
		   </table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
 </form>
 
 <?php if(!empty($schoolList)){?>
	   <table class="table table-bordered" width="100%" id='content'>
        <thead>
          <tr>
              <!--<th>Slno</th>-->
              <th>School Code</th>
              <th>QR Code</th>
              <th>Access Code</th>
              <th>School Name</th>
              
              <th>School Address</th>
              <th>State</th>
              <th>City</th>
              <th>School Area</th>
              <th>Contact</th>
              <th>Products Assigned</th>
              <!--<td>Delete</td>-->
          </tr>
          </thead>   
          <tbody>
           
            <?php   
                foreach($schoolList as $row){ 
                // print_r($row);die;
            ?>           
                <tr>
                <!--<td width="5%"><?php echo $i; ?></td>-->
                <td  width="10%" class="center"><?php echo $row->school_code; ?>
               
                <br>
                    <b>School Logo</b>
                    <?php if(!empty($row->profile)){ ?>
                        <img src='https://marrs.in/images/school/<?php echo $row->profile; ?>' style=''> 
                        <?php }else{ ?>
                        <form  method="post" enctype="multipart/form-data">
                            <p>JPG/PNG/JPEG Only</p><br>
                            <input type="file" name="file1" class="text-primary" required><br>
                            <button type="submit" name="upload" class="btn btn-warning" value='<?php echo $row->id;?>'>Upload</button>
                        </form>
                    <?php  } ?>
                </td>
                	</form>
                <td  width="10%" class="center">
                   
                   
                        <div id="qrcode" value='<?php echo $row->school_code; ?>'></div>
                        
                        
                        
                        <div id="qrcodePreview" style='padding-top:10px;'></div>
                        <div  class="">
                            <button id="downloadButton" value='<?php echo 'https://marrs.in/student_registration/welcome/scanner/'.$row->access_code; ?>' class="btn btn-primary">Download QR Code</button>
                    
                        </div>
                        


                   </td>
               
                <td  width="15%">
                    <?php echo $row->access_code; ?>
                </td>
                <td  width="15%"><?php echo $row->school_name; ?></td>
                <td  width="10%"><?php echo $row->school_address."".$row->city; ?></td>
                <td  width="15%">
                    
                    <?php 
                    
                    $res=$this->db->get_where('states',array('state_subdivision_id'=>$row->state))->row();    
                    echo $res->state_subdivision_name;
                    
                    ?>
                    
                </td>
                <td  width="10%"><?php echo $row->city; ?></td>
                <td  width="15%"><?php echo $row->area_code; ?></td>
                <td  width="15%"><?php echo 'Principal : '.$row->school_principal_name.' '.$row->principal_email.' '.$row->principal_phone; ?>
                
                <br>
                <?php echo 'Cordinator : '.$row->school_coordinator_name.' '.$row->school_coordinator_email.' '.$row->coordinator_phone; ?>
                <br>
                <?php echo 'School : '.$row->school_email.' - '.$row->school_phone.' - '.$row->school_mobile; ?>
                
                </td>
                <td>
                    <?php 
                    $this->db->select('product_name');
                    $this->db->from('product_to_school_mid');
                    $this->db->where('school_id',$row->id);
                    $this->db->where('period_id !=','');
                    $this->db->where('school_amount !=','');
                    $this->db->group_by('product_name');
                    $query=$this->db->get();
                    // echo $this->db->last_query();
                    $schoollist=$query->result(); 
                    // print_r($schoollist);
                    $i=1;
                    foreach($schoollist as $row){
                        echo $i.' - '.$row->product_name;
                        echo '<br>';
                        $i=$i+1;
                    }
                    
                    ?>
			    
                    
                </td>
                
                <!--<td  width="25%"><a href="<?php echo base_url();?>manage/franchise/school_assign_product/<?php echo $schoolList['id'];?>" class="btn btn-primary" target="_BLANK">Assign Product/Price Code</a></td>-->
                 
            </tr>

            <?php } ?>
            
            
        </tbody>
    </table>
<?php } ?>

 

 
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
    var schoolCode = "<?php echo 'Access Code - '.$schoolList['access_code']; ?>";
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
        var heading = "MaRRS Registration";
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
url:"<?php echo base_url();?>manage/ajax/school_list_active1",
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
url:"<?php echo base_url();?>manage/ajax/franchiseList_",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});

$("#franchise_id").change(function(){
var franchise_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/AreaCode_",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>