<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
	 
	 
// 	 print_r($result);
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-search"></i> Search Rank List</h2>
    			   
			   <div class="box-icon">
					<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" >
				<tr>
					

					<td>Period:<br />
						<select name="period" id="period" style="width:220px;" required>
                            <option value="" disabled>Select period</option>
                        
                            <?php foreach ($period as $row): ?>
                                <option value="<?= $row->period_id ?>"
                                    <?= (!empty($result['period']) && $result['period'] == $row->period_id) ? 'selected' : '' ?>>
                                    <?= $row->period_id ?> - <?= $row->period_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

					</td>
					
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                        <select name="product" id="product_name" style="width: 220px;"  required>
                            <option style='display:none;'>Select product</option>
                            
                            <?php
                                $query = $this->db->query("SELECT * FROM products;");
                                
                                foreach ($query->result() as $row)
                                {
                                    $selected = ($result['product'] == $row->product_id) ? 'selected' : '';
                                
                                    echo "<option value='{$row->product_id}' $selected>
                                            {$row->product_id} - {$row->product_name}
                                          </option>";
                                }
                            ?>

                        </select>
					</td>
					
					<!--<td>Competition Level:<br />-->
						<!--<h3><b>School : </b></h3>-->
     <!--                           <select name="level" id="competition_level_id" style="width: 220px;"  required>-->
     <!--                               <option style='display:none;'>Select level</option>-->
                                    
                                     <?php
                                     
                                    // $query = $this->db->query("SELECT * FROM `competition_levels`;");
                                    
                                    //foreach ($level as $row)
                                    //{
     //                               echo "<option value='{$row->id}'>{$row->id} - {$row->level_name}</option>";-->
     //                               }
                                    
                                    ?>
     <!--                           </select>-->
					<!--</td>-->
					
					<td>Class:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="class" style="width: 220px;"  >
                                    <option value='' >-- All Class --</option>
                                    
                                     <?php
                                     
                                    $query = $this->db->query("SELECT * FROM `class`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->class_name}'>{$row->class_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					</td>
				
			        <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
			
		   </table>		 
		 
		   				
		<br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			    <?php if(isset($message) && !empty($message)){ ?>
			        <h3><?php echo $message; ?></h3>
			    <?php } ?>
			
			
				 <?php  if(!empty($ranklist)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
							<button onclick="downloadPDF()" class="btn btn-primary">Download PDF</button>
                            <tr>
                                <th colspan='11'> Rank List </th>
                            </tr>    
							<tr>
							    <th>SI no</th> <th>CIN</th> <th>NAME</th> <th>EMAIL</th> <th>PHONE</th> <th>CLASS</th> <th>SCHOOL</th> <th>RANK</th>  <th>Speller</th> 
								 <th>Perfomer</th> <th>Level Name</th><th>Action</th>
							</tr>
							 
							<?php
							
							
						    $i=0;  
							foreach($ranklist as $details){
				// 			print_R($details);
							?>
							    
							
							    <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details->cin;  ?> </td>
									<td align="CENTER"> <?php  echo $details->student_name;  ?> </td>
									<td align="CENTER"> <?php  echo $details->stud_email;  ?> </td>
									<td align="CENTER"> <?php  echo $details->stud_phone;  ?> </td>
									<td align="CENTER"> <?php  echo $details->class;  ?> </td>
									<td align="CENTER"> <?php  echo $details->school;  ?> </td>
									<td align="CENTER"> <?php  echo $details->rank;  ?> </td>
									<td align="CENTER"> <?php  echo $details->performer;  ?> </td>
									<td align="CENTER"> <?php  echo $details->speller;  ?> </td>
									<td align="CENTER"> <?php  echo $details->level_name;  ?> </td>
									<td align="center">

                                    
                                        <button class="btn btn-danger btn-sm deleteBtn" 
                                                data-id="<?= $details->id; ?>">
                                            Delete
                                        </button>
                                    
                                    </td>

							    </tr>
							<?php  
							      
							  }
							
						 ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->




<script src="jquery-1.8.3.min.js"></script>

<script src="jquery.uniform.min.js"></script>
<script src="jquery.cleditor.min.js"></script>
<script src="jquery.elfinder.min.js"></script>
<script src="charisma.js"></script>

<script>

$(document).ready(function(){

    $('.deleteBtn').click(function(e){

        e.preventDefault(); // stop form submit

        var id  = $(this).data('id');
        var row = $(this).closest('tr');

        //alert(id); // tracking id

        if(confirm('Are you sure you want to delete this record?'))
        {
            $.ajax({
                url: "<?= base_url('manage/lunar/delete') ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(response){

                    console.log(response);

                    if(response.status == 'success'){
                        row.fadeOut();
                    }else{
                        alert('Delete failed');
                    }

                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }

    });


    $("#country_id").change(function(){
        $.post(BASE_URL+"manage/ajax/getstate/", {id:this.value}, function(result){
            $("#stateID").html(result);
        });
    });

    $("#product_name").change(function(){
        $.post(BASE_URL+"manage/ajax/productwiselevel/", 
            {product_id:this.value}, 
            function(result){
                $("#competition_level_id").html(result);
        });
    });

});
</script>


<?php //print_r($result); ?>

<script>
const pdfMeta = {
    product_name: "<?= addslashes($result['product_name'] ?? '') ?>",
    level_name: "<?= addslashes($result['level_name'] ?? '') ?>",
    logo_url: "<?= addslashes($result['logo_url'] ?? '') ?>",
    period: "<?= addslashes($result['period'] ?? '') ?>"
    
};
</script>



<script>
// function downloadPDF() {

//     const content = document.getElementById("csvResult_uploadLog_div").innerHTML;

//     const win = window.open('', '_blank');

//     win.document.open();
//     win.document.write(`
//         <!DOCTYPE html>
//         <html>
//         <head>
//             <title>Rank List</title>
//             <style>
//                 body { font-family: Arial, sans-serif; }
//                 table { width:100%; border-collapse: collapse; font-size:12px; }
//                 th, td { border:1px solid #000; padding:5px; text-align:center; }
//                 th { background:#f2f2f2; }
//                 @media print {
//                     button { display:none; }
//                 }
//             </style>
//         </head>
//         <body>


function downloadPDF() {

    const content = document.getElementById("csvResult_uploadLog_div").innerHTML;

    const header = `
        <div style="text-align:center; margin-bottom:20px;">
            ${pdfMeta.logo_url ? `<img src="${pdfMeta.logo_url}" style="max-height:150px;"><br>` : ''}
            <h2 style="margin:5px 0;">${pdfMeta.product_name}</h2>
            <h4 style="margin:5px 0;">${pdfMeta.level_name} - ${pdfMeta.period}</h4>
            <hr>
        </div>
    `;

    const win = window.open('', '_blank');

    win.document.open();
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            
            <style>
                body { font-family: Arial, sans-serif; }
                table { width:100%; border-collapse: collapse; font-size:12px; }
                th, td { border:1px solid #000; padding:5px; text-align:center; }
                th { background:#f2f2f2; }
                h2, h4 { margin: 0; }
                @media print {
                    button { display:none; }
                }
            </style>
        </head>
        <body>
        
        
            ${header}


            ${content}
            <script>
                window.onload = function () {
                    window.print();
                };
            <\/script>
        </body>
        </html>
    `);
    win.document.close();
}
</script>



<?php include('footer.php'); ?>