<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();   
	 
	 //print_r($result);
?> 

        <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
	
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV file </h2>
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
			            <td>
			                <label>Uploade Template Structure:-</label>
			                <td>
			                    CIN |
			                </td>
			                <td>Student Name |</td>
			                <td>Class |</td>
			                <td>Mobile |</td>
			                <td>Email |</td>
			                <td>School Code</td>
			            </td>  
			            
			            </tr>
			                <tr>
					 	<td>
			   			 Choose your Profile Update CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			            </td>
					 
					
			   <td> <br /><input type="submit" class='btn btn-primary' name="submit" value="Submit" /> </td>
				</tr> 
				
		   </table>		 
		 
		    <br />
			<!--------------> 
			
			
			<div id="csvResult_uploadLog_div">				 
				 <?php  
				 
				 
				 //print_r($csvResult_upoload_logArray);die;
				 
				 
				 if(!empty($csvResult_upoload_logArray)): ?>
				 <h4><?php echo $count; ?></h4>
				 <TABLE border="1" width="80%" cellpadding="10px" >
							
							<tr> <td colspan="8"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Profile Update - Status</td></tr>
						    <tr>
								<th>SI no</th><th>CIN</th><th>STUDENT NAME</th> <th>CLASS </th> <th>Mobile</th> 
								<th>Email</th> 
								<!--<th>Grademarker</th>-->
								
								<th>Upload Report</th> 
								
							</tr>
							<?php    
							$i=0;  
							foreach($csvResult_upoload_logArray as $details): 
                                ?>
							    <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
									<td align="CENTER"> <?php  echo $details[2];  ?> </td>
									<td align="CENTER"> <?php  echo $details[3];  ?> </td>
									<td align="CENTER"> <?php  echo $details[4];  ?> </td>
									<!--<td align="CENTER"  style="background-color: <?php echo $details[7]; ?>; color:#fff; font-weight:bold;" > <?php  echo $details[5];  ?> </td>-->
									
									<!--<td align="CENTER" style="background-color: <?php //echo $details[8]; ?>; color:#fff; font-weight:bold;" >-->
                                       
                                        <?php //echo $details[6]; ?>
                                        
                                        <!--Updated Fields-->
                                        
                                        <?php 
                                        //echo '<pre>';
                                        //print_r($details[9]); ?>
                                        
                                    <!--</td>-->
                                    
                                    <td align="center"
                                        style="
                                            background-color: <?php echo $details[8]; ?>;
                                            color: #fff;
                                            font-weight: 600;
                                            padding: 10px;
                                            line-height: 1.4;
                                        ">
                                    
                                        <!-- Status -->
                                        <div style="font-size:14px; margin-bottom:6px;">
                                            <?php echo $details[6]; ?>
                                        </div>
                                    
                                        <!-- Label -->
                                        <div style="font-size:12px; opacity:0.9; margin-bottom:6px;">
                                            Updated Fields
                                        </div>
                                    
                                        <!-- Updated fields list -->
                                        <?php if (!empty($details[9]) && is_array($details[9])): ?>
                                            <div style="
                                                background: rgba(255,255,255,0.15);
                                                border-radius: 4px;
                                                padding: 6px;
                                                font-size: 11px;
                                                text-align: left;
                                                max-height: 120px;
                                                overflow-y: auto;
                                            ">
                                                <ul style="margin:0; padding-left:15px;">
                                                    <?php foreach ($details[9] as $field => $value): ?>
                                                        <li>
                                                            <strong><?php echo ucfirst(str_replace('_',' ',$field)); ?>:</strong>
                                                            <?php echo htmlspecialchars($value); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <div style="font-size:11px; opacity:0.8;">
                                                No fields updated
                                            </div>
                                        <?php endif; ?>
                                    
                                    </td>



							    </tr>
							<?php  
							endforeach; 
							?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
			
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->

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
$("#area").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>franchise/ajax/school_list",
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
url:"<?php echo base_url();?>franchise/ajax/franchiseList",
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
url:"<?php echo base_url();?>franchise/ajax/AreaCode",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>