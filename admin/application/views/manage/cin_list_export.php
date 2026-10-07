<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();     
	
?> 


<style>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  margin-left:42%;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
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

    <div class="container-fluid px-0">

        <!-- First Row -->
        <div class="row g-3 align-items-end">

            <!-- From Date -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="from_date" class="form-label fw-semibold">
                    From Date:
                </label>
                <input
                    type="date"
                    id="from_date"
                    name="from_date"
                    class="form-control"
                    required
                    value="<?php if(isset($fro)){echo date('Y-m-d', strtotime($fro));}else{ echo date('Y-m-d');} ?>"
                >
            </div>

            <!-- Country -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="country" class="form-label fw-semibold">
                    Country:
                </label>

                <select
                    name="country"
                    id="country"
                    class="form-select"
                    required
                >
                    <option style="display:none;">Select Country</option>

                    <?php

                    $query = $this->db->query("SELECT * FROM countries;");

                    foreach ($query->result() as $row)
                    {
                    ?>
                        <option
                            value="<?php echo $row->country_id;?>"
                            <?php if($row->country_id=='105'){ echo 'selected="selected"';}?>
                        >
                            <?php echo $row->country_name;?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- State -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="state_id" class="form-label fw-semibold">
                    State:
                </label>

                <select
                    name="state_id"
                    id="state_id"
                    class="form-select"
                    required
                >
                    <?php

                    $query = $this->db
                        ->order_by('state_subdivision_name','ASC')
                        ->get_where(
                            'states',
                            array('country_id'=>'105')
                        )
                        ->result();

                    foreach ($query as $row)
                    {
                    ?>
                        <option
                            value="<?php echo $row->state_subdivision_id;?>"
                            <?php if($row->state_subdivision_id==$sta_id){ echo 'selected="selected"';} ?>
                        >
                            <?php echo $row->state_subdivision_name;?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Class -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="class" class="form-label fw-semibold">
                    Class:
                </label>

                <select
                    name="class"
                    id="class"
                    class="form-select"
                >
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
            </div>

        </div>


        <!-- Second Row -->
        <div class="row g-3 align-items-end mt-1">

            <!-- Franchise -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="franchise_id" class="form-label fw-semibold">
                    Franchise:
                </label>

                <select
                    name="franchise_id"
                    id="franchise_id"
                    class="form-select"
                >
                    <option value="All">All Franchise</option>
                </select>
            </div>

            <!-- Product -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="product" class="form-label fw-semibold">
                    Product:
                </label>

                <select
                    name="product"
                    id="product"
                    class="form-select"
                    required
                >
                    <?php

                    $query = $this->db->query(
                        "SELECT * FROM products
                         where status='Active'
                         ORDER BY product_name "
                    );

                    foreach ($query->result() as $row)
                    {
                    ?>
                        <option value="<?php echo $row->product_name;?>">
                            <?php echo $row->product_id;?> -
                            <?php echo $row->product_name;?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Area Code -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="area" class="form-label fw-semibold">
                    Area Code:
                </label>

                <select
                    name="area"
                    id="area"
                    class="form-select"
                    required
                >
                    <option value="All">All Area</option>
                </select>
            </div>

            <!-- To Date -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="to_date" class="form-label fw-semibold">
                    To Date:
                </label>

                <input
                    type="date"
                    id="to_date"
                    name="to_date"
                    class="form-control"
                    required
                    value="<?php if(isset($tofrom)){echo date('Y-m-d', strtotime($tofrom));}else{ echo date('Y-m-d');} ?>"
                >
            </div>

        </div>


        <!-- Third Row -->
        <div class="row g-3 align-items-end mt-1">

            <!-- School -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="school" class="form-label fw-semibold">
                    School:
                </label>

                <select
                    name="school"
                    id="school"
                    class="form-select"
                >
                    <option value="All">All School</option>
                </select>
            </div>

            <!-- Period -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="period" class="form-label fw-semibold">
                    Period:
                </label>

                <select
                    name="period"
                    id="period"
                    class="form-select"
                >
                    <option value="13">23/24</option>
                    <option value="14">24/25</option>

                    <?php
                    /*
                    $query = $this->db->query("SELECT * FROM period;");

                    foreach ($query->result() as $row)
                    {
                        echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                    }
                    */
                    ?>
                </select>
            </div>

            <!-- Level -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="level" class="form-label fw-semibold">
                    LEVEL:
                </label>

                <select
                    name="level"
                    id="level"
                    class="form-select"
                >
                    <option value="All">All Level</option>
                </select>
            </div>

            <!-- Select Extract -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <label for="status_extract" class="form-label fw-semibold">
                    Select Extract:
                </label>

                <select
                    name="status_extract"
                    id="status_extract"
                    class="form-select"
                    required
                >
                    <option
                        value="mocktest"
                        <?php if($extract=='mocktest'){ echo 'selected="selected"';}?>
                    >
                        School Level Mock Test
                    </option>

                    <option
                        value="online"
                        <?php if($extract=='online'){ echo 'selected="selected"';}?>
                    >
                        Registration_Online
                    </option>

                    <option
                        value="offline_extract"
                        <?php if($extract=='offline_extract'){ echo 'selected="selected"';}?>
                    >
                        Registration_Offline
                    </option>

                    <option
                        value="orientation"
                        <?php if($extract=='orientation'){ echo 'selected="selected"';}?>
                    >
                        Orientation -All
                    </option>

                    <option
                        value="studymaterial"
                        <?php if($extract=='studymaterial'){ echo 'selected="selected"';}?>
                    >
                        Learning Material
                    </option>

                    <!--<option
                        value="competation"
                        <?php if($extract=='competation'){ echo 'selected="selected"';}?>
                    >
                        Competition
                    </option>-->
                </select>
            </div>

        </div>


        <!-- Submit Row -->
        <div class="row g-3 mt-1">

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <button
                    type="submit"
                    id="Btnsubmit"
                    name="submit"
                    value="Submit"
                    class="search btn btn-primary w-100"
                >
                    Submit
                </button>
            </div>

        </div>

    </div>


    <br>

    <!-------------->
    <div id="csvResult_uploadLog_div"></div>
    <!-------------->

</form>	
  </div>	
  <?php if(!empty($student)){
 
  ?>
   <div id="loader" class="loader" style="display: none;text-align:center">
    <!-- Loading spinner or animation here -->
    Loading...
</div>
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
                 
<table id="example" class="table table-striped table-bordered bootstrap-datatable datatable">
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
                                  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $student as $value ) { //print_r($value);die;
							 $state_subdivision_name = $this->db->get_where('states',array('state_subdivision_id'=>$value['state_id']))->row()->state_subdivision_name;
                               $franchise_name = $this->db->get_where('franchise',array('franchise_id'=>$value['franchise_id']))->row()->username;
                             
							
							?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['student_name']; ?></td>
                                  <td><?php echo $value['cin']; ?></td>
								    <td><?php echo $franchise_name;
								    ?>
								    
								   
                                    <td><?php echo $value['area_code']; ?></td>
                                     <td><?php  echo $value['amount'];
								    ?>
								    </td>
                                  <td><?php echo $value['class']; ?></td>
                                  <td >
								<?php echo $state_subdivision_name; ?>
								</td>
								 <td >
								<?php echo $value['product_name']; ?>
								</td>
								 <td >
								<?php echo $value['school_name']; ?>
								</td>
								<td><?php if(!empty($value['time'])) { echo $value['time'];}else{ echo $value['insert_date']; } ?></td>
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
								<td><?php 
								      $query = $this->db->get_where('cin_list',array('cin' => $value['cin']));
                                      $res = $query->row_array();
                                      $id = $res['id'];
								    
								    ?>
								    
								    <a href='<?php echo base_url();?>manage/franchise/editcin/<?php echo $id; ?>' class='btn btn-primary'>Edit</a></td></td>
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					
				
				
				
			
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>

    <?php }else{ ?>
				<!--<img src="<?php echo base_url();?>public/giphy.gif"> -->
				
			
    <div style='text-align:center;'>
     <h3 style='color:crimson;'><?php  echo 'Not student is found with selected parameters !!!';?></h3> </div>
  <?php  }
    ?>    
 </div><!--/span-->
 
 
</div><!--/row-->

<script>new DataTable('#example');</script>
 <script>
        $(document).ready(function(){
            
            $('#Btnsubmit').click(function(){
               // alert('sasasas');
        $('#loader').show(); 
         setTimeout(function() {
            $('#loader').hide(); // Hide loader after specified duration
        }, 60000);
    });
            
            var state_id =$('#state_id').val();
           
            $.ajax({
            url:"<?php echo base_url();?>manage/ajax/franchiseList",
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


$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_listassign",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#school").html(result);
	 

}});

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
$("#product").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/franchiselogin/";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/productwiselevelwithName",
data:{product_id:product_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#level").html(result);
	 

}});
});

</script><?php include('footer.php'); ?>
