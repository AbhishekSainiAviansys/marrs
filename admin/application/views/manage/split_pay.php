<?php include('header.php');

// print_r($franchise2);
?>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>School List</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> School List</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
    <h3 style='color:crimson;'>
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
					
						<td >
						 School : <br>
						 
                                 <select name="school"  id='school' style='width: 220px;'  required>
                                 
                                      <option value="">-- Select School --</option>
                                      <?php if(isset($result['school']) && $result['school']=='All'){?>
                                      
                                     <option value="All" selected=selected> All School </option>
                                      
                                      <?php
                                      }
                                      foreach($schoolload as $row){
                                     ?>
                                    <option value='<?php echo $row['id'];?>'<?php  if($result['school']==$row['id']) { echo 'selected="selected"'; } ?>><?php echo $row['school_name'];?></option>
                                
                                  <?php  }
                                    
                                    ?>
                                </select>
                              
                               
					 </td>
					 
					 </tr> 
			    <tr>       
				
				    <td> <br /><input type="submit" class='btn btn-primary' name="submit" value="Search" /> </td>
			
				</tr>
			   	
				
		</table>	
						   <!-----------------Submit /Cancel button ------------------->       
                    
        				   <!--<div class="form-actions">-->
        							<!--	<input type="submit" class="btn btn-primary" id="submit" value="Generate" name="submit" >-->
        								<!--<button class="btn">Cancel</button>-->
        				   <!--</div>-->
				    
    </form>
 
 <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
        			}?>
			</h4></div>
				 <?php  if(!empty($pay_list)){ ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <!--<tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Last 10 Papers Uploaded.</td></tr>-->
							 <tr>
								<th>SI No</th> 
								<th>PRID</th>
								<th>Date</th>
								<th>School</th> 
								<th>Franchise</th> 
								<th>Razorpay Charges</th>
								<th>Total Amount</th>	
								<th>Franchise Cut</th>
								<th>Franchise GST</th>
								
								<th>Aviansys Cut</th> 
								<th>Aviansys GST</th>
								<th>MaRRS Balance</th>
								<th>Management Pay</th>
								<th>School Pay</th>
							 </tr>
							<?php    
							  $i=0;  
							  $razpay_service=0;
							  $total_amount=0;
							  $franchise_amount=0;
							  $aviansys_amount=0;
							  $MaRRS_bal=0;
							  $management_amount=0;
							  $school_amount=0;
							  $avi_gst=0;
							  $fra_gst=0;
							  //print_r($list_materials);die;
							  foreach($pay_list as $details){ 
							     //print_r($details);die;
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php   
								echo $details->prid;
									?> </td>
									<td align="CENTER"> <?php   
								echo $details->date_of_payment;
									?> </td>
									<td align="CENTER"> <?php   
								echo $details->school_name;
									?> </td>
									<td align="CENTER">
									    <?php 
									    if(!empty($details->franchise_id)){
									     $query = $this->db->query("SELECT franchise_first_name,franchise_last_name FROM franchise where franchise_id='{$details->franchise_id}'; ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['franchise_first_name'].' '.$result['franchise_last_name']; 
									    }
									    ?>
									</td>
									<td align="CENTER"> <?php  echo $details->razpay_service;
									$razpay_service=$razpay_service+$details->razpay_service;
									?> </td>
									<td align="CENTER"> <?php  echo $details->total_amount;
									$total_amount=$total_amount+$details->total_amount;
									?> </td>
									<td align="CENTER"> <?php  echo $details->franchise_amount;  
									$franchise_amount=$franchise_amount+$details->franchise_amount;
									
									?> </td>
									
									<td align="CENTER">
									    <?php echo $details->franchise_gst;
									        $fra_gst=$fra_gst+$details->franchise_gst;
									    ?>
									</td>
									
									<td align="CENTER"> <?php  echo $details->aviansys_amount;  
									$aviansys_amount=$aviansys_amount+$details->aviansys_amount;
								?>
									</td>
									<td align="CENTER">
									    <?php echo $details->aviansys_gst;
									        $avi_gst=$avi_gst+$details->aviansys_gst;
									    ?>
									</td>
									
									<td align="CENTER"> <?php 
									$mrs_bal=abs($details->MaRRS_bal);
									echo $mrs_bal;   
									$MaRRS_bal=$MaRRS_bal+$mrs_bal;
								
									?> </td>
									<td align="CENTER"> <?php  echo $details->management_amount;  
									$management_amount=$management_amount+$details->management_amount;
									
									?> </td>
									<td align="CENTER"> <?php  echo $details->school_amount;  
									$school_amount=$school_amount+$details->school_amount;
									
									?> </td>
							 </tr>
							<?php  } ?>
							<tr>
							    
							    <th>Total Amounts</th> 
								<th>=></th>
								<th></th>
								<th></th> 
								<th></th> 
								<th><?php echo $razpay_service; ?></th>
								<th><?php echo $total_amount; ?> </th>	
								<th><?php echo $franchise_amount ?></th>
								<th><?php echo $fra_gst ?></th>
								
								<th><?php echo $aviansys_amount ?></th> 
								<th><?php echo $avi_gst ?></th> 
								<th><?php echo $MaRRS_bal ?></th> 
								<th><?php echo $management_amount; ?></th>
								<th><?php echo $school_amount; ?></th>
							</tr>
				</TABLE>
				<?php }else{ ?>
				<h4>
				<?php echo 'No Data Found..';?>
				</h4>
				<?php  } ?>
			</div>
	<!-------------->
	</form> 

 

 
					</div>
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
url:"<?php echo base_url();?>manage/ajax/franchiseList__",
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
