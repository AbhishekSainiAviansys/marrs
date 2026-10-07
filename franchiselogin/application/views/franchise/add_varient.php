<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
// 	print_r($result);
	 echo $this->notifications->display_html();      
?> 
 <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>
 <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
<style>
    #on_3{
        display:none;
    }
    #o1_8{
        display:none;
    }
</style>	
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Add Varient</h2>
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
				    <td>Subject:<br/>
					    <select name='sub_id'  style="width: 220px;"  required>
					        <option value=''>-- select subject --</option>
					        <?php foreach($subjects as $subject){ ?>
					            <option value='<?php echo $subject->sub_id; ?>'><?php echo $subject->subject_key; ?></option>
					            
					        <?php } ?>
					    </select>        
					</td>
					
					<td>Varient Name:<br />
						<!--<h3><b>School : </b></h3>-->
                        <input type='text' name="varient_name" id="varient_name" style="width: 220px;"  required>
                           
					</td>
					
				
			        <td> 
			            <br /><input type="submit" class='btn btn-info' name="submit" value="Submit" />
			        </td>
			        
				</tr> 
				
		   </table>		 
		 </form>
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">		
			 <form action="" method="post"  > 
				 <?php  if(!empty($lunar_varient)){ 
				 
				 ?>
				 
				 <TABLE border="1" width="100%" cellpadding="10px" >
								
							 <tr style='background-color:green;color:white;'>
								<th>Sr No</th>
								<th>Varient Name</th>
								<th>
								    Subject Name
								</th>
								<th>
								    Action
								</th>
							 </tr>
							<?php    
							  $i=1;  
							  foreach($lunar_varient as $details){ 
							 // print_r($details);
							  ?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i;      ?> </td> 
								    <td align="CENTER"> <?php  echo $details->varient_name;  ?> </td>
									<td align="CENTER"> <?php  echo $details->subject_key;  ?> </td>
									
									<td align="CENTER"> 
									
								    	<?php  //echo $details->varient_id;  ?>
								    	
									    <button type='submit' name='delete' value='<?php  echo $details->varient_id;  ?>' class='btn btn-danger' >   Delete   </button>
									   
									</td>
									
							 </tr>
							<?php $i=$i+1;  } ?>
				</TABLE>
				<?php }if(!empty($message)){ ?>
				
				<h3 style="text-align:center"><?php echo $message; ?></h3>
				
				
				<?php }?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->

<script>
//     $("#product").change(function(){
// var product_id =this.value;
//  //alert(product_id);
// $.ajax({
// url:"<?php echo base_url();?>manage/ajax/productwiselevel",
// data:{product_id:product_id},
// type: 'post',
// success:function(result)
// {
// 	//alert(result);
// 	 $("#level").html(result);
	 

// }});
// });
    
    
</script>

<?php include('footer.php'); ?>
<script>
        $(document).ready(function(){
            
            
           
           $("#product").change(function(){
        
        var product=this.value;
// 		alert(product_id);
		if (product == 'MaRRS Lunar Olympiads') {
            jQuery("#series").show();
                 
        }else{
            jQuery("#series").hide();  
        }
		
		
    }); 
         jQuery("#series").hide();    
           
        });
        </script>
<script type="text/javascript">
 $("#school_list").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
$("#categ").change(function(){
		   
		//alert(this.value);
        var categ=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/get_product_list/",
            data:{categ:categ},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#product").html(result);
        }});
    });

$("#product").change(function(){
		   
		//alert(this.value);
        var product_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/productwiselevel_/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#level").html(result);
        }});
    });


$(document).ready(function(){
    
    $("#period").change(function(){
        // Check if the selected value is '12'
        if (this.value > '12') {
            
            $("#school").show();
            $("#area").show();
            //var state_id=this.value;
            var state_id = $('#state').val();

            $.ajax({
                url: "<?php echo base_url();?>"+"manage/ajax/getAreaAjax_/",
                data:{state_id:state_id},
                type: 'post',
                success:function(result){
    				// alert(result);
                     $("#area_list").html(result);
            }});
        
            
        
        } else {
            // Hide the 'school' div
            $("#school").hide();
            $("#area").hide();
        }
    });
});     

$("#area_list").change(function(){
    var area_code = $('#area_list').val();

            $.ajax({
                url: "<?php echo base_url();?>"+"manage/ajax/school_list/",
                data:{area_code:area_code},
                type: 'post',
                success:function(result){
    				// alert(result);
                     $("#school_list").html(result);
            }});
}); 

$("#state").change(function(){
		   
		//alert(this.value);
        var state_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/statewisearea_/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#area_list").html(result);
        }});
    });
 </script>