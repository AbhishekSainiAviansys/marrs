<?php
	 include('header.php'); 
	 
	
	 echo $this->notifications->display_html();      
?> 

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
				    <td>From Date:<br>
				       <input type="date" id="from_date" name="from_date" required value="<?php if(isset($fro)){echo date('Y-m-d', strtotime($fro));}else{ echo date('Y-m-d');} ?>">
                       
				    </td>
				    
				    <td>Country:<br />
						
                                <select name="country" id="country" style="width: 180px;"  required>
                                    <option style='display:none;'>Select Country</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    { ?>
                                    <option value='<?php echo $row->country_id;?>' <?php if($row->country_id=='105'){ echo 'selected="selected"';}?>><?php echo $row->country_name;?></option>
                                   <?php 
                                   
                                        
                                    }
                                    
                                    ?>
                                </select>
					 </td>
					 
					 <td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 180px;"  >
                                   
                                     <?php
                                     
                                     $state = $this->db->get_where('franchise',array('franchise_id'=>$this->session->userdata('franchise_id')))->row()->state_id;
                                       $query = $this->db->order_by('state_subdivision_name','ASC')->get_where('states',array('state_subdivision_id'=>$state))->result();
                                     
                                    
                                     foreach ($query as $row)
                                    { ?>
                                <option value="<?php echo $row->state_subdivision_id;?>" <?php if($row->state_subdivision_id==$sta_id){ echo 'selected="selected"';} ?> > <?php echo $row->state_subdivision_name;?></option>
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					 <td >Class:<br />
						 <!--<h3><b>School : </b></h3>-->
                                 <select name="class"   style='width: 180px;'  >
                                 
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
                                         <option value="Class-9">Class-9</option>
                                        <option value="Class-10">Class-10</option>
                                        <option value="Class-11">Class-11</option>
                                        <option value="Class-12">Class-12</option>
                                        
                                        
                                </select>
                                
                                </td>
                                <td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 180px;"  >
                                   
                                    <?php  $franchise = $this->db->get_where('franchise',array('franchise_id'=>$this->session->userdata('franchise_id')))->row();?>
                                    <option value="<?php echo $franchise->franchise_id;?>"><?php echo $franchise->username;?></option>
                                </select>
					 </td>
			        	<td>Product:<br />
						
                                <select name="product" id="product" style="width: 200px;"  required>
                                  
                                       <option value="All">All Products</option>
                                      <?php
                                      $state_id= $this->session->userdata('franchise_id');
                                      $query = $this->db->join('products','products.product_id=product_allotted_fr.product_id')->group_by('products.product_name')->get_where('product_allotted_fr',array('franchise_id'=>$state_id))->result();
		
                                    
                                      foreach ($query as $row)
                                     {
                                     echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     }
                                    
                                     ?>
                                </select>
					 </td>
				
				
					</tr>
				<tr> <td>

                        <label for="to_date">To Date:</label>
                        <input type="date" id="to_date" name="to_date" required  value="<?php if(isset($tofrom)){echo date('Y-m-d', strtotime($tofrom));}else{ echo date('Y-m-d');} ?>">
                        <br>
				    </td>
					    	<td >School:<br />
						
                                 <select name="school"  id='school' style='width: 180px;'  >
                                 
                                      <option value="All">All School</option>
                                     
                                </select>
                              
                               
					 </td>
						<td>Period:<br />
					
                                <select name="period" id="period" style="width: 180px;"  >
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
					 <td>LEVEL:<br />
					
                                <select name="level" id="level" style="width: 180px;"  >
                                    <option value='All'>All Level</option>
                                </select>
					 </td>
					 
					 
					 	<td>Select Extract:<br />
						 
                                <select name="status_extract" style="width: 180px;"  required>
                                    <option value='mocktest' <?php if($extract=='mocktest'){ echo 'selected="selected"';}?> >School Level Mock Test</option>
                                    <option value='online' <?php if($extract=='online'){ echo 'selected="selected"';}?>>Registration_Online </option>
                                    <option value='offline_extract' <?php if($extract=='offline_extract'){ echo 'selected="selected"';}?> >Registration_Offline </option>
                                    <!--<option value='competation' <?php if($extract=='competation'){ echo 'selected="selected"';}?>> Competition </option>-->
                                    <option value='orientation' <?php if($extract=='orientation'){ echo 'selected="selected"';}?>>Orientation -All </option>
                                    <option value='studymaterial' <?php if($extract=='studymaterial'){ echo 'selected="selected"';}?>>Learning Material</option>
                                   
                                </select>
					 </td>
					 
					 
				    <td> <br /><input type="submit"  name="submit" value="Submit" class='btn btn-primary' /> </td>
				
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
			<input type='hidden' name='too' value='<?php echo $tofrom; ?>'>
			<input type='hidden' name='extract' value='<?php echo $extract; ?>'>
			<input type='hidden' name='level' value='<?php echo $level; ?>'>
			<button name='export' style="margin-left: 30px;" class='btn btn-primary'>Export Excel</button>
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
								  <th>Franchise ID</th>
                                  <th>Area Code</th>
                                 <th>Amount</th>
                                  <th>Class</th>
                                   <th>State</th>
                                  <th>Product</th>
                                  <th>School Name</th>
                                  <th>Date Time</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $student as $value ) { //print_r($value);die;
							?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['student_name']; ?></td>
                                  <td><?php echo $value['cin']; ?></td>
								    <td><?php echo $value['username'];
								    ?>
								    
								   
                                    <td><?php echo $value['area_code']; ?></td>
                                     <td><?php  echo $value['amount'];
								    ?>
								    </td>
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
								<td><?php echo $value['time']; ?></td>
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
            
            var state_id =$('#state_id').val();
           
            $.ajax({
            url:"<?php echo base_url();?>franchise/ajax/franchiseList",
            data:{state_id:state_id},
            type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#franchise_id").html(result);
            	 
            
            }});
            
           
            
            // Initialize select2
            $("#school").select2();
             var username = $('#school option:selected').text();
                var userid = $('#school').val();
           
        });
        </script>
        
<?php include('footer.php'); ?>


<script type="text/javascript">

$(document).ready(function(){
var franchise_id =$('#franchise_id').val();
//alert(franchise_id);
$.ajax({
url:"<?php echo base_url();?>franchise/ajax/school_listassign",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

}});

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

$("#product").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/franchiselogin/";
$.ajax({
url:"<?php echo base_url();?>franchise/ajax/productwiselevelwithName",
data:{product_id:product_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#level").html(result);
	 

}});
});

</script>