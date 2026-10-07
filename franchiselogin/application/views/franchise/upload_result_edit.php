<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
// 	 print_R($result);
// 	 print_R($level_load);
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV Result file </h2>
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

					<td>Product:<br />
						 
                        <select name="product_name" id="product_name" style="width: 220px;"  required>
                            <option >-- Select Product --</option>
                            
                            <?php
                            
                            foreach ($product_load as $row)
                            {
                                ?>
                                
                                    <option value='<?php echo $row->product_id; ?>' <?php if(isset($result['product_name']) && $result['product_name'] == $row->product_id ){ echo 'selected';} ?> ><?php echo $row->product_id.' - '.$row->product_name; ?></option>
                                
                                <?php
                            }
                            
                            ?>
                        </select>
					</td>
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                        <select name="level" id="competition_level_id" style="width: 220px;"  required>
                            <option >-- Select Level --</option>
                            
                            <?php
                            if(isset($level_load)){ 
                                foreach ($level_load as $row)
                                {   
                                ?>
                                
                                    <option value='<?php echo $row->level_id; ?>' <?php if(isset($result['level']) && $result['level'] == $row->level_id ){ echo 'selected';} ?> ><?php echo $row->level_id.' - '.$row->level_name; ?></option>
                                
                                <?php
                                }
                            }
                            ?>
                        </select>
					</td>
					
				    <td>
			   			 Choose your CIN result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			        </td>
			        <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
			        <td></td>
                    <td></td>
                    <td></td>
                    
				</tr> 
				<!--<tr>-->
				<!--    <td> Help!! result upload template format help consists of following column attributes for your information.</td>-->
				<!--</tr>-->
				<tr>
				    
				    <td>1. CIN</td>
				    <td>2. status 'Q/NQ'</td>
				    <td>3. Grade </td>
				    <td>4. Rank </td>
				    <td>5. Marks </td>
				    <td>6. Performer </td>
				    <td>7. Speller </td>
				    
				</tr>
		   </table>		 
		 
		   				
		<br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
				 <table border="1" width="80%" cellpadding="10px">

                        <tr>
                            <td colspan="5" style="color:#00F; font-weight:bold; font-size:14px;" align="center">
                                RESULT UPLOAD - ERROR LOG
                            </td>
                        </tr>
                        
                        <tr>
                            <th>SI No</th>
                            <th>CIN</th>
                            <th>Product Name</th>
                            <th>Level</th>
                            <th>Upload Report</th>
                        </tr>
                        
                        <?php    
                        $i = 0;  
                        
                        foreach($csvResult_upoload_logArray as $details):
                        
                            $message = $details[3] ?? '';
                        
                            // ✅ Set background color
                            $bgColor = '';
                        
                            if (stripos($message, 'error') !== false) {
                                $bgColor = '#f8d7da'; // light red
                            }
                            elseif (stripos($message, 'success') !== false) {
                                $bgColor = '#d4edda'; // light green
                            }
                        ?>
                        
                        <tr>
                            <td align="center"><?php echo ++$i; ?></td>
                            <td align="center"><?php echo $details[0] ?? ''; ?></td>
                            <td align="center"><?php echo $details[1] ?? ''; ?></td>
                            <td align="center"><?php echo $details[2] ?? ''; ?></td>
                        
                            <td align="center" style="background-color: <?php echo $bgColor; ?>">
                                <?php echo $message; ?>
                            </td>
                        </tr>
                        
                        <?php endforeach; ?>
                        
                    </table>

				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<script type="text/javascript">
	$(document).ready(function(e) {
        $("#product_name").change(function(){
            var product_id=this.value;
    		//alert(state_id);
    		var BASE_URL = "<?php echo base_url();?>";
            $.ajax({
                url:BASE_URL+"manage/ajax/productwiselevel/",
                data:{product_id:product_id},
                type: 'post',
                success:function(result){
                     $("#competition_level_id").html(result);
            }});
        }); 
    });

</script>
