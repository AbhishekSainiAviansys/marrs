<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
	
	
	
	
		  <div class="box-header well" data-original-title>
			   <!--<h2><i class="icon-edit"></i>Upload CSV Result file </h2>-->
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
			        <lable style='padding-left:10px;'>Country:</lable>
			            
			            <select name='country_id' id='country_id'>
			                <option>select country</option>
			                 <option value="105">India</option>
								        
			            </select>
			           
			        <lable style='padding-left:20px;'>State:</lable>
			      
			            <select name='state_id' id='state_id'>
			                <option>select state</option>
			            
			            </select>
			           
			        <lable style='padding-left:20px;'>Franchise:</lable>
			       
			            <select name='franchise' id='franchise'>
			                <option>select franchise</option>
			            
			            </select>
			           
			        <lable style='padding-left:20px;'>Area:</lable>
			        
			            <select name='area' id='area'>
			                <option>select area</option>
			            
			            </select>
			          
			    </tr>
				<tr>
				<td>
			   			 <!--Choose your result CSV file  <br />  <input name="csv" type="file" id="csv" /> -->
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($result)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RESULT UPLOAD-ERROR LOG</td></tr>
							 <tr>
								<th>SI no</th> <th>SChool Name</th><th>School_code</th> <th>Status</th> 
							 </tr>
							<?php    
							  $i=0;  
							  foreach($result as $details){
							      
/*array($period_id,$state_id,$school_id,$state_id,$class_id,$category_id,$next_competition_level_name,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);*/							?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['school_name'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['school_code'];  ?> </td>
									<td align="CENTER"> <?php  echo $details['status'];  ?> </td>
									<!--<td align="CENTER"> <?php  echo $details[3];  ?> </td>-->
									<!--<td align="CENTER"> <?php  echo $details[4];  ?> </td>-->
									<!--<td align="CENTER"> <?php  echo $details[5];  ?> </td>-->
         <!--                           <td align="CENTER"> <?php  echo $details[6];  ?> </td>-->
         <!--                           <td align="CENTER"> <?php  echo $details[7];  ?> </td>-->
									<!--<td align="CENTER"> <?php  echo $details[8]; ?> </td>-->
         <!--                           <td align="CENTER"> <?php  echo $details[9]; ?> </td>-->
							 </tr>
							<?php  } ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->


<script>

$("#country_id").change(function(){
		   
		//alert(this.value);
        var country_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/getstateAjax/",
            data:{country_id:country_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#state_id").html(result);
        }});
    }); 
	
	$("#franchise").change(function(){
		   
		//alert(this.value);
        var franchise_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/AreaCode/",
            data:{franchise_id:franchise_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#area").html(result);
        }});
    }); 
	
	$("#state_id").change(function(){
		   
	//	alert(this.value);
        var state_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/franchiseList/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#franchise").html(result);
        }});
    });
</script>
 
<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                var id = $(this).val();
               var dataid = $('#fid').val();
               //alert(dataid);
                	$.ajax({
                           	url:BASE_URL+"manage/franchise/productActiveDeactive/",
                            type:'post',
                            data:{ 'id' : id, 'fid' : dataid },
                            success:function(data){
                            			
                             }
                        	}); 
                
            }
            else if($(this).prop("checked") == false){
               var id = $(this).val();
               var dataid = $('#fid').val();
               //alert(dataid);
                	$.ajax({
                           	url:BASE_URL+"manage/franchise/productActiveDeactive/",
                            type:'post',
                            data:{ 'id' : id, 'fid' : dataid },
                            success:function(data){
                            			
                             }
                        	}); 
            }
        });
    });
</script>
<?php include('footer.php'); ?>