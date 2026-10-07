<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
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
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 180px;"  required>
                                    <option style='display:none;'>Select Country</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 180px;"  required>
                                    <option style='display:none;'>Select State</option>
                                    
                                     <?php
                                       $query = $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('country_id'=>'105'))->result();
                                     
                                    
                                     foreach ($query as $row)
                                    { ?>
                                <option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					  <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 180px;"  required>
                                   
                                    
                                </select>
					 </td>
					 
					  <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 180px;"  required>
                                    
                                </select>  
					 </td>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 180px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name ");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 
					 	<td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 180px;"  required>
                                    <option style='display:none;'>Select Period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>
                 
					
					
					
					</tr><tr>
					    	<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="school"  id='school' style='width: 200px;'  required>
                                 
                                      <option value="">Select School</option>
                                     
                                </select>
                              
                               
					 </td>
				<td>
			   			 Choose your PRID result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
				
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">		  		 
				
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
url:"<?php echo base_url();?>manage/ajax/franchiseList",
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
url:"<?php echo base_url();?>manage/ajax/AreaCode",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>