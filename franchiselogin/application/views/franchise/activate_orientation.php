<?php include('header.php');

// print_r($franchise2);
?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">Activate</a> <span class="divider">/</span></li>
		   <li>School Level</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Orientation</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
    <h3 style='color:green;'>
        <?php
            if(!empty($message)){
                echo $message;
            }
        ?>
    </h3>
    <form method='post' class='table-responsive'>
                        <!----------------- Franchise ------------------->       
        <table  cellpadding="5px" >
				<tr>
				    
                 
				    <td>Country:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="country" id="country" style="width: 220px;"  required>
                                    <option value=''>-- Select Country --</option>
                                    <option value='105'>INDIA</option>
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM countries;"); 
                                    
                                     foreach ($query->result() as $row)
                                    {
                                   // echo "<option value='{$row->country_id}'> {$row->country_name}</option>";
                                    
                                     ?>
                                <option value="<?php echo $row->country_id;?>" <?php  if($result['country']==$row->country_id) { echo 'selected="selected"'; } ?> > <?php echo $row->country_name;?></option>
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
					 </td>
			
					<td>State:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 220px;"  required>
                                    <option value=''>-- Select State --</option>
                                    
                                     <?php
                                       
                                     foreach ($stateload as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['state_subdivision_id'];?>" <?php  if($result['state_id']==$row['state_subdivision_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['state_subdivision_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>
					 
					<td>Franchise:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="franchise_id" id="franchise_id" style="width: 220px;"  required>
                                    <option value=''>-- Select Franchise --</option>
                                     <?php
                                     
                                    
                                     foreach ($franchise2 as $row)
                                    { ?>
                                <!--<option value="<?php echo $row->state_subdivision_id;?>"> <?php echo $row->state_subdivision_name;?></option>-->
                                
                            
                                <option value="<?php echo $row['franchise_id'];?>" <?php  if($result['franchise_id']==$row['franchise_id']) { echo 'selected="selected"'; } ?> > <?php echo $row['franchise_code'].' '.$row['franchise_first_name'];?></option>
                                  
                                  <?php   }
                                    
                                    ?>
                                        
                                </select>
					 </td>
					 
			        <td>Area Code:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="area" id="area" style="width: 220px;"  required>
                                    <option value=''>-- Select Area --</option>
                                    <?php
                                     
                                     foreach ($areaload as $row)
                                    {
                                    //  echo "<option value='{$row->product_name}'>{$row->product_id} - {$row->product_name}</option>";
                                     
                                     ?>
                                    <option value='<?php echo $row['area_code'];?>'<?php  if($result['area']==$row['area_code']) { echo 'selected="selected"'; } ?>><?php echo $row['area_code'];?></option>
                                 
                                  <?php  }
                                    
                                    ?>
                                    
                                </select>  
					 </td>
					 
					<td>
					    School :</br>
						 
                                <select name="school" id="school" style="width: 220px;" required>
                                    <option value="">-- Select School --</option>
                                    <?php
                                    foreach ($schoolload as $row) {
                                        // Check if $result['school'] is set and not empty before comparing
                                        $selected = (isset($result['school']) && $result['school'] == $row['id']) ? 'selected="selected"' : '';
                                    ?>
                                        <option value='<?php echo $row['id']; ?>' <?php echo $selected; ?>><?php echo $row['school_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                              
					</td>
					
					
					 
				</tr> 
				
				<tr>
				    
				    <td>Orientation Price<br>
				        
				        <input name='price' type='text' class='form-control' required>
				    </td>
				    <td>Mock Price<br>
				        
				        <input name='mock_price' type='text' class='form-control' required>
				    </td>
				    <td>
				        Franchise %<br>
				        <select name='franchise_cut' required>
				            <option value=''>-- select franchise cut --</option>
				            <option value='40'>40%</option> 
				            <option value='45'>45%</option> 
				            <option value='50'>50%</option> 
				            <option value='55'>55%</option> 
				            <option value='60'>60%</option> 
				            <option value='65'>65%</option> 
				            <option value='70'>70%</option> 
				        </select>
				    </td>
				    <td>School Fix Amount<br>
				        <input name='school_amount' type='text' class='form-control' required>
				    </td>
				    <td>Product List:<br />
						 <!--<h3><b>School : </b></h3>-->
						 
                                 <select name="product"  id='product' style='width: 220px;'  required>
                                 
                                      <option value="">-- Select Product --</option>
                                      <?php
                                      foreach($productload as $row){
                                     ?>
                                    <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                                 <!--<input type='checkbox' name='products[]' class='form-control' value="<?php echo $row['product_name']; ?>" &nbsp => <?php echo $row['product_name']; ?><br>-->

                                  <?php  }
                                    
                                    ?>
                                </select>
                              
                               
					 </td>
				   
					
                
                <tr>
                    
                <td> 
				    Closing Date: <br/>
					     <input type='date' name='end_date' class='form-control' value="<?php echo $row['end_date']; ?>" required >

					</td>
					 
				    <td> 
				    <br /><input type="submit" class='btn btn-primary' name="submit" value="Launch" />
				    </td>
			
				</tr>
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
    </form>
 


 

 
					</div>
				</div>
			</div>
			
	
                    <div class="box-content" style="margin:10px">
                 
						<table  id="example" class="table table-striped table-bordered" style="width:100%;">
						    
						  <thead>
						      <!--<tr><button name='Delete' class='btn btn-primary' id='del'>Delete Selected</button></tr>-->
							  <tr>
							       
							      <!--<th><input type='checkbox' id='checkAll'>Select All</th>-->
								  <th>SL No.</th>
								  <th>School Name</th>
								  <th>Orientation Price</th>
								  <h>Mock Price</h>
								  <th>Franchise / Per</th>
                                  <th>School Amount</th>
                                  <th>Product Name</th>
                                   <!--<th>Categoery</th>-->
                                  <!--<th>School</th>-->
                                  <th>Period</th>
                                  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
						     
							
							<?php $i=1;foreach( $dataload as $value ) { //print_r($value);die;
							?>
							<tr>
							    <!--<td><input type="checkbox" id="" name="cins[]" value="<?php echo $value['cin']; ?>"></td>-->
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['school_name']; ?></td>
                                  <td><?php echo $value['price']; ?></td>
								    <td><?php echo $value['franchise_name'].'  '.$value['franchise_per']; ?></td>
                                    <td><?php echo $value['school_amount']; ?></td>
                                  <td><?php echo $value['product']; ?></td>
                                  <td >
								<?php echo $value['academic_year']; ?>
								</td>
								
								<!--<td class="center">-->
								
									<!--<a class="btn btn-info" href="" title="Edit">-->
									<!--	Edit                              -->
									<!--</a>-->
								<!--</td>-->
									<td class="center">
								<!--<a class="btn btn-info"  href="<?php echo base_url();?>manage/franchise/editcin/<?php echo $value['id'];?>" title="Edit">-->
										Edit                              
									<!--</a>-->
									<!--<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletecin/<?php echo $value['id'];?>" title="Delete">-->
										Delete                              
									<!--</a>-->
								</td>
								
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					 
					</div>
					</div>


<script
      src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
      integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
$("#country").change(function(){
var country_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/getstateAjax",
data:{country_id:country_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#state_id").html(result);
	 

}});
});


$("#area").change(function(){
var franchise_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/school_list_areawis",
data:{franchise_id:franchise_id},
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
url:"<?php echo base_url();?>manage/ajax/franchiseList__",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#franchise_id").html(result);
	 

}});
});

$("#state_id").change(function(){
var state_id =this.value;
 //alert(franchise_id);
 var BASE_URL="<?php echo base_url();?>";
$.ajax({
url:"<?php echo base_url();?>manage/ajax/statewisearea",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area").html(result);
	 

}});
});


</script>