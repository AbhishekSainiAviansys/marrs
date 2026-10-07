<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
<style>
    div#example_filter {
    float: right;
    position: relative;
    right: 20px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
div#example_paginate {
    margin-left: 15px;
}
    
    div#example_info {
    padding-left: 15px;
}
</style>
  
  
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
	
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <!--<h2><i class="icon-edit"></i>Upload CSV file </h2>-->
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
				    <!--<td>From Date:<br>-->
				    <!--   <input type="date" id="from_date" name="from_date" >-->
        <!--                <br>-->

        <!--                <label for="to_date">To Date:</label>-->
        <!--                <input type="date" id="to_date" name="to_date" >-->
        <!--                <br>-->
				    <!--</td>-->
				    
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 150px;"  required>
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
                                <select name="state_id" id="state_id" style="width: 150px;"  required>
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
					 <td >Class:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="class"   style='width: 150px;'  >
                                 
                                      <option value="All">All Class</option>
                                        <option value="Nursery">Nursery</option>
                                        <option value="LKG">LKG</option>
                                        <option value="UKG">UKG</option>
                                        <option value="Class-1">Class-1</option>
                                        <option value="Class-2">Class-2</option>
                                        <option value="Class-3">Class-3</option>
                                        <option value="Class-4">Class-4</option>
                                        <option value="Class-5">Class-5</option>
                                        <option value="Class-6">Class-6</option>
                                        <option value="Class-7">Class-7</option>
                                        <option value="Class-8">Class-8</option>
                                        
                                        
                                </select>
                                
                                </td>
			        	<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product" id="product" style="width: 150px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                      echo "<option value='All Products'>All Products</option>";
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name ");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					  <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 150px;"  >
                                   
                                    
                                </select>
					 </td>
					 
					  <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 150px;"  >
                                    
                                </select>  
					 </td>
				
				
					</tr>
				<tr>
					    	<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="school"  id='school' style='width: 180px;'  >
                                 
                                      <option value="">select School</option>
                                     
                                </select>
                              
                               
					 </td>
						<td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 100px;"  >
                                    <option value='13'>23/24</option>
                                    <option value='14'>24/25</option>
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM period;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                                    // }
                                    
                                    ?>
                                </select>
					 </td>
				    <td> <br /><input type="submit" name="submit" value="Submit" class='btn btn-primary' /> </td>
				
				</tr> 
				
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">		  		 
				
			</div>
	<!-------------->
	</form> 
  </div>	
  <?php if(!empty($student)){ ?>
   <form method="POST">
			<div class="row">		
			<input type='hidden' name='sta_id' value='<?php echo $sta_id; ?>'>
			<input type='hidden' name='pro' value='<?php echo $pro; ?>'>
			<input type='hidden' name='ar' value='<?php echo $ar; ?>'>
			<input type='hidden' name='fra_id' value='<?php echo $fra_id; ?>'>
			<input type='hidden' name='per' value='<?php echo $per; ?>'>
			<input type='hidden' name='sch' value='<?php echo $sch; ?>'>
			<input type='hidden' name='cla' value='<?php echo $cla; ?>'>
			<input type='hidden' name='fro' value='<?php echo $fro; ?>'>
			<input type='hidden' name='too' value='<?php echo $too; ?>'>
			
			<button name='export'  class='btn btn-primary'>Export Excel</button>
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> CIN</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                  
						<table id="example" class="table table-striped table-bordered dt-responsive" style="width:98%;margin-left:10px">
						  <thead>
							  <tr>
								  <th>SL No.</th>
								  <th>Student Name</th>
								  <th>CIN</th>
								  <th>Franchise</th>
                                  <th>Area</th>
                                 
                                  <th>Class</th>
                                   <th>State</th>
                                  <th>Product</th>
                                  <th>School Name</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $student as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['student_name']; ?></td>
                                  <td><?php echo $value['cin']; ?></td>
								    <td><?php if(empty($fra_id)){echo $value['franchise_first_name'].' '.$value['franchise_last_name'].' - '.$value['franchise_code'];}else{echo $fra_id;} ?></td>
                                    <td><?php echo $value['area_code']; ?></td>
                                  <td><?php echo $value['class']; ?></td>
                                  <td >
								<?php echo $value['state_subdivision_name']; ?>
								</td>
								 <td >
								<?php echo $value['product_name']; ?>
								</td>
								 <td >
								<?php echo $value['school_name']; ?>
								</td>
								<!--<td class="center">-->
								
								<!--	<a class="btn btn-info" href="" title="Edit">-->
								<!--		Edit                              -->
								<!--	</a>-->
								<!--</td>-->
								<!--	<td class="center">-->
								
								<!--	<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletecin/<?php echo $value['id'];?>" title="Delete">-->
								<!--		Delete                              -->
								<!--	</a>-->
								<!--</td>-->
								
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					
					<!--<div class="pagination pagination-left">-->
					<!--	 <ul>-->
					<!--		<li><a href="#">Prev</a></li>-->
					<!--		<li><a href="#">1</a></li>-->
					<!--		<li><a href="#">2</a></li>-->
					<!--		<li><a href="#">3</a></li>-->
					<!--		<li><a href="#">4</a></li>-->
					<!--		<li><a href="#">5</a></li>-->
					<!--		<li><a href="#">Next</a></li>-->
					<!--	  </ul>-->
					<!--</div>-->
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>

    <?php }else{?>
    <div style='text-align:center;'>
     <h3 style='color:crimson;'><?php  echo 'Not student is found with selected parameters !!!';?></h3> </div>
  <?php  }
    ?>    
 </div><!--/span-->
</div><!--/row-->

<script>new DataTable('#example');</script>
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