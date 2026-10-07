<?php include('header.php');

// print_r($franchise2);
?>
	<div class="container-fluid mx-3 ">
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
                <table cellpadding="5px">
                    <tr>
                        <td>Country:<br />
                            <select name="country" id="country" class="form-control" required>
                                <option value=''>-- Select Country --</option>
                                <option value='105'>INDIA</option>
                                <?php
                                $query = $this->db->query("SELECT * FROM countries;");
                                foreach ($query->result() as $row) {
                                ?>
                                    <option value="<?php echo $row->country_id; ?>" <?php if($result['country'] == $row->country_id) { echo 'selected="selected"'; } ?>>
                                        <?php echo $row->country_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                
                        <td>State:<br />
                            <select name="state_id" id="state_id" class="form-control" required>
                                <option value=''>-- Select State --</option>
                                <?php
                                foreach ($stateload as $row) {
                                ?>
                                    <option value="<?php echo $row['state_subdivision_id']; ?>" <?php if($result['state_id'] == $row['state_subdivision_id']) { echo 'selected="selected"'; } ?>>
                                        <?php echo $row['state_subdivision_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                
                        <td>School:<br />
                            <select name="school" id='school' class="form-control" required>
                                <option value="">-- Select School --</option>
                                <?php
                                foreach ($schoolload as $row) {
                                ?>
                                    <option value='<?php echo $row['id']; ?>' <?php if($result['school'] == $row['id']) { echo 'selected="selected"'; } ?>>
                                        <?php echo $row['school_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                
                        <td>Product:<br />
                            <select name="product" id="product" class="form-control" required>
                                <option value="">-- Select Product --</option>
                                <?php
                                $query = $this->db->query("SELECT * FROM products WHERE status='Active' ORDER BY product_name");
                                foreach ($query->result() as $row) {
                                ?>
                                    <option value="<?php echo $row->product_name; ?>"><?php echo $row->product_id; ?> - <?php echo $row->product_name; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                
                        <td>Start Date:<br />
                            <input type='date' name='start_date' class="form-control" required>
                        </td>
                
                        <td>End Date:<br />
                            <input type='date' name='end_date' class="form-control" required>
                        </td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        
                        <td>Period:<br />
                            <select name="period" id="peirod" class="form-control" required>
                                
                                <?php
                                $query = $this->db->query("SELECT * FROM period where status='Active';");
                                foreach ($query->result() as $row) {
                                ?>
                                    <option value="<?php echo $row->period_id; ?>" <?php if($result['period'] == $row->period_id) { echo 'selected="selected"'; } ?>>
                                        <?php echo $row->academic_year; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        
                        <td colspan="6" style="white-space: nowrap;">
                            Class:<br />
                            <?php
                            $query = $this->db->query("SELECT class_id, class_name FROM class;");
                            $classes = $query->result_array();
                            foreach ($classes as $row) {
                            ?>
                                <label style="display: inline-block; margin-right: 10px;">
                                    <input type="checkbox" name="class_id[]" class="form-control" value="<?php echo $row['class_name']; ?>" <?php if (in_array($row['class_name'], $result['class_id'])) { echo 'checked'; } ?>>
                                    <?php echo $row['class_name']; ?>
                                </label>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <br /><input type="submit" class='btn btn-primary' name="submit" value="Assign" />
                        </td>
                    </tr>
                </table>
                	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
            </form>
     
 <?php if(!empty($schoolList)){ 
 

 ?>
	<table class="table table-bordered" width="100%" id='content'>
        <thead>
            <tr>
                <th>Sl No</th>
                <th>School Code</th>
                <th>QR Code</th>
                <th>School Name</th>
                <th>School Address</th>
                <th>State</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Product Name</th>
                <th>Classes Assigned</th>
                <td>Action</td>
            </tr>
        </thead>   
        <tbody>
            <?php
            $i=1;
            foreach($schoolList as $school){ 
            // print_R($school['open_school_assign_id']);die;
            ?>
                <tr>
                <td width="5%"><?php echo $i; ?></td>
               <td width="10%" class="center">
                    <?php echo $school['school_code']; ?>
                    
                </td>

                <!-- QR Code and Download Button -->
                <td width="10%" class="center">
                    <div id="qrcode" value='<?php echo $school['school_code']; ?>'></div>
                    <div id="qrcodePreview" style='padding-top:10px;'></div>
                    <button id="downloadButton" value='<?php echo 'https://marrs.in/student_registration/welcome/scanner/'.$school['school_code']; ?>' class="btn btn-primary">Download QR Code</button>
                </td>

                <!-- School Information -->
                <td width="15%"><?php echo $school['school_name']; ?></td>
                <td width="10%"><?php echo $school['school_address'] . " " . $school['city']; ?></td>
                <td width="15%"><?php echo $school['state_subdivision_name']; ?></td>
                <td width="10%"><?php echo $school['start_date']; ?></td>
                <td width="10%"><?php echo $school['end_date']; ?></td>
                <!-- Product Names -->
                <td width="15%">
                   <?php echo $school['product']; ?>
                </td>

                <!-- Contact Details -->
                <td width="15%">
                    <?php 
                    $this->db->select('class');
                    $this->db->from('open_school_assign_class');
                    $this->db->where('open_school_assign_id',$school['open_school_assign_id']);
                    $query=$this->db->get();
                    $res=$query->result_array();
                    foreach($res as $re){
                    ?>
                        <lable><?php echo $re['class']; ?></lable><br>
                    <?php } ?>
                    
                </td>

                <!-- Delete Action -->
                <td width="10%">
                    <!-- Add delete functionality if needed, e.g., link or button -->
                        <form method="post" action="<?php echo base_url('manage/franchise/assign_product'); ?>">
                            <input type="hidden" name="school_id" value="<?php echo $school['open_school_assign_id']; ?>">
                            <input type="hidden" name="delete" value="1">
                            <button type="button" class="btn btn-danger delete-btn" data-id="<?php echo $school['open_school_assign_id']; ?>">Delete</button>
                            
                            <!--<button type='button' class='btn btn-warning edit-btn' data-id="<?php echo $school['open_school_assign_id']; ?>">Edit</button>-->
                        </form>
                        
                        
                </td>
            </tr>
            <?php $i=$i+1; } ?>    
        </tbody>
    </table>
<?php } ?>

 

 
					</div>
				</div>
			</div>
	


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="path/to/select2.min.js"></script>

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
// $(document).ready(function() {
//     var variableValue = $("#downloadButton").val();
//     var schoolName = "<?php echo $schoolList['school_name']; ?>";
//     var schoolCode = "<?php echo 'Access Code - '.$school['school_code']; ?>";
//     var qrCodeSize = 200; // Increased size of the QR code
//     var padding = 30; // Adjust the padding size as needed
//     var textHeight = 100; // Increased height for the text to accommodate multiple lines and heading
//     var schoolLogo = "<?php echo !empty($schoolList['profile']) ? 'https://marrs.in/images/school/' . $schoolList['profile'] : ''; ?>";
    
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

//         // Create a new canvas to add padding, text, and logo
//         var paddedCanvas = document.createElement("canvas");
//         var context = paddedCanvas.getContext("2d");

//         // Set the new canvas size
//         paddedCanvas.width = canvas.width + padding * 4;
//         paddedCanvas.height = canvas.height + padding * 4 + textHeight + 100; // Additional space for the logo

//         // Fill the new canvas with white background
//         context.fillStyle = "#ffffff";
//         context.fillRect(0, 0, paddedCanvas.width, paddedCanvas.height);

//         // Draw the heading at the top
//         var heading = "MaRRS Registration";
//         context.fillStyle = "#FF9933"; // Saffron color
//         context.font = "bold 18px Arial"; // Font size and type
//         context.textAlign = "center"; // Center align
//         context.fillText(heading, paddedCanvas.width / 2, 25); // Adjust the position as needed
        
//         context.fillStyle = "#24478f";
//         context.font = "bold 14px Arial";
//         context.fillText(schoolCode, paddedCanvas.width / 2, 40); 
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

//         // Load the school logo if it exists
//         if (schoolLogo !== '') {
//             var logo = new Image();
//             logo.src = schoolLogo;
//             logo.onload = function() {
//                 var logoSize = 150;
//                 var logoX = (paddedCanvas.width - logoSize) / 2; // Centering the logo horizontally
//                 var logoY = 60 + (lines.length * 20) + 20; // Position below the school name
//                 context.drawImage(logo, logoX, logoY, logoSize, logoSize);

//                 // Draw the original QR code onto the new canvas with padding
//                 var qrX = (paddedCanvas.width - canvas.width) / 2;
//                 var qrY = logoY + logoSize + padding; // Position below the logo
//                 context.drawImage(canvas, qrX, qrY);

//                 // Save the padded QR code with text and logo
//                 paddedCanvas.toBlob(function(blob) {
//                     saveAs(blob, "qrcode.jpg");
//                 });
//             };
//         } else {
//             // Draw the original QR code onto the new canvas with padding
//             var qrX = (paddedCanvas.width - canvas.width) / 2;
//             var qrY = 60 + (lines.length * 20) + padding; // Position below the school name
//             context.drawImage(canvas, qrX, qrY);

//             // Save the padded QR code with text
//             paddedCanvas.toBlob(function(blob) {
//                 saveAs(blob, "qrcode.jpg");
//             });
//         }
//     });
// });
</script>


<script>
$(document).ready(function() {
    var variableValue = $("#downloadButton").val();
    var schoolName = "<?php echo addslashes($schoolList['school_name']); ?>";
    var schoolCode = "<?php echo 'Access Code - '.$school['school_code']; ?>";
    var qrCodeSize = 200; // QR code size
    var padding = 30; // Padding around the QR code
    var textHeight = 100; // Height for text sections
    var schoolLogo = "<?php echo !empty($schoolList['profile']) ? 'https://marrs.in/images/school/' . $schoolList['profile'] : ''; ?>";

    // Generate the QR code
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: variableValue,
        width: qrCodeSize,
        height: qrCodeSize,
        correctLevel: QRCode.CorrectLevel.H
    });

    qrcode.makeCode(variableValue);

    $("#downloadButton").click(function() {
        var canvas = $("#qrcode canvas")[0];

        // Create a new canvas with additional space for padding, text, and logo
        var paddedCanvas = document.createElement("canvas");
        var context = paddedCanvas.getContext("2d");

        paddedCanvas.width = canvas.width + padding * 4;
        paddedCanvas.height = canvas.height + padding * 4 + textHeight + 100;

        // Fill the background with white color
        context.fillStyle = "#ffffff";
        context.fillRect(0, 0, paddedCanvas.width, paddedCanvas.height);

        // Draw heading and school details
        context.fillStyle = "#FF9933"; // Heading color
        context.font = "bold 18px Arial";
        context.textAlign = "center";
        context.fillText("MaRRS Registration", paddedCanvas.width / 2, 25);

        context.fillStyle = "#24478f"; // School code color
        context.font = "bold 14px Arial";
        context.fillText(schoolCode, paddedCanvas.width / 2, 45);

        // Prepare school name in multiple lines if necessary
        var lines = [];
        var maxLineLength = 30;
        while (schoolName.length > maxLineLength) {
            var lastSpace = schoolName.lastIndexOf(' ', maxLineLength);
            var splitIndex = lastSpace > 0 ? lastSpace : maxLineLength;
            lines.push(schoolName.substring(0, splitIndex));
            schoolName = schoolName.substring(splitIndex).trim();
        }
        lines.push(schoolName);

        // Draw the school name below the code
        context.fillStyle = "#0d6efd";
        context.font = "bold 18px Arial";
        for (var i = 0; i < lines.length; i++) {
            context.fillText(lines[i], paddedCanvas.width / 2, 65 + (i * 20));
        }

        // Draw logo if available
        if (schoolLogo !== '') {
            var logo = new Image();
            logo.src = schoolLogo;
            logo.onload = function() {
                var logoSize = 150;
                var logoX = (paddedCanvas.width - logoSize) / 2;
                var logoY = 65 + (lines.length * 20) + 20;
                context.drawImage(logo, logoX, logoY, logoSize, logoSize);

                // Place QR code below the logo
                var qrX = (paddedCanvas.width - canvas.width) / 2;
                var qrY = logoY + logoSize + padding;
                context.drawImage(canvas, qrX, qrY);

                // Save the final canvas as an image file
                paddedCanvas.toBlob(function(blob) {
                    saveAs(blob, "qrcode.jpg");
                });
            };
        } else {
            // Draw QR code below the school name if no logo
            var qrX = (paddedCanvas.width - canvas.width) / 2;
            var qrY = 65 + (lines.length * 20) + padding;
            context.drawImage(canvas, qrX, qrY);

            // Save the canvas as an image file
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
url:"<?php echo base_url();?>manage/ajax/school_list",
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

    $("#state_id").change(function(){
        var state_id =this.value;
         //alert(franchise_id);
        var BASE_URL="<?php echo base_url();?>";
        $.ajax({
        url:"<?php echo base_url();?>manage/ajax/open_schools",
        data:{state_id:state_id},
        type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#school").html(result);
            	 
            
            }});
    });
$(document).ready(function() {
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();

        // Confirmation popup
        if (confirm("Are you sure you want to delete this record?")) {
            // Submit the form if confirmed
            $(this).closest('form').submit();
        }
    });
});


$(document).ready(function() {
    $('.edit-btn').on('click', function(e) {
        e.preventDefault();

        // Confirmation popup
        if (confirm("Are you sure you want to edit this record?")) {
            // Submit the form if confirmed
            $(this).closest('form').submit();
        }
    });
});

</script>