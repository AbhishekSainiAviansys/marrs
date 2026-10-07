<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
	<style>input.description {
    width: 500px;
}</style>		
    <div class="row-fluid sortable">
	    <div class="box span12">
	<!-------------->          
		    <div class="box-header well" data-original-title>
			   <h2>
			       <i class="icon-edit"></i>Upload CSV Result file </h2>
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
            			   			 Choose your Syllabus CSV file  <br />  <input name="csv" type="file" id="csv" /> 
            			    </td>
            			    <td> 
            			        <br />
            			        <input type="submit" name="submit" value="Submit" class="btn btn-primary" /> 
            			    </td>
            			    
        				</tr> 
        				
        				<!--<tr>-->
        				<!--    <td> Help!! result upload template format help consists of following column attributes for your information.</td>-->
        				<!--</tr>-->
        				<tr>
        				   
        				    <td> Class</td>
        				    <td>Test Number</td>
        				    <td>Topic</td>
        				    <td>Description</td>
        				    <td>Edit</td>
        				     <td>Delete</td>
        				    
        				</tr>
        		     <?php $i=1; foreach($test_descrption as $value){ ?>
                        <tr>
                        
                        <form action="" method="POST">
                        
                        <td>
                            <input type="hidden" name="id" value="<?=$value->id?>">
                            <input type="text" name="class" value="<?=$value->class?>" class="form-control">
                        </td>
                        
                        <td>
                            <input type="text" name="title" value="<?=$value->title?>" class="form-control">
                        </td>
                        
                        <td>
                            <input type="text" name="title" value="<?=$value->topic?>" class="form-control">
                        </td>
                        
                        <td>
                            <input type="text" name="description" value="<?=$value->description?>" class="form-control" style="width:500px;">
                        </td>
                        
                        <td>
                           <input type="submit" name="submittest" value="Update" class="btn btn-primary">
                        </td>
                        
                      
                        
                        </form>
                          <td>
                            <a href="<?=base_url('manage/lunar/classdeletetest/'.$value->id)?>/<?=$value->sch_id?>" 
   class="btn btn-danger"
   onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                        </td>
                        </tr>
                        <?php } ?>
        		    </table>		 
        		</form>
        		   				
        		<br />
        			<!--------------> 				
        			<div id="csvResult_uploadLog_div">				 
        				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
        				 <TABLE border="1" width="80%" cellpadding="10px" >
        								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
        							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">RANK UPLOAD LIST</td></tr>
        							 <tr>
        								<th>SI no</th> <th>Schedule ID</th> <th>Class</th> 
        								  <th>Title - Description</th><th>STATUS</th>
        							 </tr>
        							<?php    
        							  $i=0;  
        							  foreach($csvResult_upoload_logArray as $details): 
        						    ?>
        							 <tr>
        									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
        									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
        									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
        									<td align="CENTER"> <?php  echo $details[3];  ?> </td>
        									
        									<td align="CENTER"  style="background-color: <?php echo $details[5]; ?>; color:#fff; font-weight:bold;" > <?php  echo $details[2];  ?> </td>
        									
        									<!--<td align="CENTER"> <?php  //echo $details[7];  ?> </td>-->
        									<!--<td align="CENTER"> <?php  //echo $details[5]."( ".$details[6]." )"; ?> </td>-->
        							 </tr>
        							<?php  endforeach; ?>
        				</TABLE>
        				<?php endif;/* End of if*/ ?>
        			</div>
        	<!-------------->
        	 
            </div>	
        </div><!--/span-->
    </div><!--/row-->

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<script type="text/javascript">
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
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
	
</script>



<?php include('footer.php'); ?>