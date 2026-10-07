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
				    <td>Level:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="level" id="level" style="width: 150px;"  required>
                                    <option style='display:none;'>Select level</option>
                                    <option value='1'>SCHOOL LEVEL</option>
                                    <!--<option value='2'>NATIONAL PRELIMS Q1</option>-->
                                    <option value='2'>NATIONAL FINALS </option>
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    // }
                                    
                                     ?>
                                </select>
					 </td>
					
						<td >School:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="school"  id='' style='width: 180px;'  >
                                 
                                      <option value="">All School</option>
                                     <?php
                                     
                                     $query = $this->db->query("SELECT school_name FROM student_to_zoomzoom group by school_name;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->school_name}'> {$row->school_name}{$row->school_address}</option>";
                                    }
                                    
                                     ?>
                                </select>
                              
                               
					 </td>
					
					
					
				<td >Class:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="class"  id='' style='width: 150px;'  >
                                 
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
  <?php if(!empty($student)){ ?>
   <form method="POST">
			<div class="row">		
		
			<input type='hidden' name='lev' value='<?php echo $lev; ?>'>
			<input type='hidden' name='sch' value='<?php echo $sch; ?>'>
			<input type='hidden' name='cla' value='<?php echo $cla; ?>'>
			
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
								  <th>PRID</th>
								  <th>Email</th>
                                  <th>Phone</th>
                                 
                                  <th>Class</th>
                                   <th>State</th>
                                  <!--<th>Product</th>-->
                                  <th>School Name</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $student as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['first_name'].' '.$value['middle_name'].' '.$value['last_name']; ?></td>
                                  <td><?php echo $value['zoomzoom_prid']; ?></td>
								    <td><?php echo $value['email']; ?></td>
                                    <td><?php echo $value['mobile']; ?></td>
                                  <td><?php echo $value['class']; ?></td>
                                  <td >
								<?php echo $value['state']; ?>
								</td>
								 <td >
								<?php echo $value['school_name']; ?>
								</td>
								 <td >
								<?php echo $value['level']; ?>
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

    <?php } ?>    
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
// $("#area").change(function(){
// var area_code =this.value;
//  //alert(franchise_id);
//  var BASE_URL="<?php echo base_url();?>";
// $.ajax({
// url:"<?php echo base_url();?>manage/ajax/school_list",
// data:{area_code:area_code},
// type: 'post',
// success:function(result)
// {
// 	//alert(result);
// 	 $("#school").html(result);
	 

// }});
// });

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