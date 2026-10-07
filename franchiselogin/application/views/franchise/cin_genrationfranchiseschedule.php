<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	echo $this->notifications->display_html(); 
	$fr_id = $this->session->userdata('franchise_id');
	$frd = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
	$state_id= $frd->state_id;
	$country_id = $frd->country_id;
	$product_id = $schedule->product_id;
	$period_id = $schedule->period_id;
// 	print_r($schedule);
	
?> 
			
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
				    
				    	
				    	<td>Product:<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                            <select name="product" id="product" style="width: 180px;"  required>
                                <option value=''>-- Select product --</option>
                                
                                <?php
                                 
                                $query = $this->db->query("SELECT * FROM products where product_id='$product_id'");
                                
                                foreach ($query->result() as $row)
                                {
                                ?>
                                
                                    <option value='<?php echo $row->product_id;?>' selected > <?php echo $row->product_name;?></option>";
                                    
                                <?php
                                }
                                
                                ?>
                            </select>
					 </td>
				    <td>Country:<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                            <select name="country" id="country_id" style="width: 180px;"  required>
                                <!--<option value=''>-- Select Country --</option>-->
                                
                                 <?php
                                 
                                 $query = $this->db->query("SELECT * FROM countries where country_id='$country_id'"); 
                                
                                 foreach ($query->result() as $row)
                                { ?>
                               <option value='<?php echo $row->country_id;?>' selected> <?php echo $row->country_name;?></option>";
                               <?php  }
                                
                                ?>
                            </select>
					 </td>
				
				<td>State ID :<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 180px;"  required>
                                    <option style='display:none;'>Select State</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM states where state_subdivision_id='$state_id';");
                                    
                                     foreach ($query->result() as $row)
                                    {  ?>
                                   <option value='<?php echo $row->state_subdivision_id;?>' selected><?php echo $row->state_subdivision_name;?></option>
                                   <?php  }
                                    
                                    ?>
                                </select>
					 </td>
					 	<td>Period ID:<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period_id" id="period_id" style="width: 180px;"  required>
                                    <option style='display:none;'>Select Period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period where period_id ='$period_id';");
                                    
                                     foreach ($query->result() as $row)
                                    { ?>
                                    <option value='<?php echo $row->period_id;?>' selected><?php echo $row->academic_year;?></option>
                                   <?php  } 
                                    
                                    ?>
                                </select>
					 </td>
					
					
					 <td>Area Code :<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area_code" id="area_code" style="width: 180px;"  required>
                                    <option style='display:none;'>Select Area Code</option>
                                    
                                     <?php
                                     
                                     $row = $this->db->get_where('areas',array('state_id'=>$state_id))->result();
                                     foreach($row as $value){ 
                                    ?>
                                    <option value='<?php echo $value->area_code;?>' ><?php echo $value->city_name?></option>
                                  <?php } ?>
                                </select>
					 </td>
					
                  <td>School:<span style='color:red;'>*</span><br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="school" id="school" style="width: 180px;"  required>
                                    <option style='display:none;'>Select School</option>
                                    
                                     
                                </select>
					 </td>
					
						</tr> 
						<tr>
				
				<td>
			   			 Choose your PRID result CSV file <span style='color:red;'>*</span> <br />  <input name="csv" type="file" id="csv" required  />
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit"  class='btn btn-primary' /> </td>
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
<?php include('footer.php'); ?>

<script type="text/javascript">
$("#area_code").change(function(){
var area_code =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/franchiselogin/";
$.ajax({
url:"<?php echo base_url();?>franchise/ajax/school_list_active",
data:{area_code:area_code},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

}});
});
</script>