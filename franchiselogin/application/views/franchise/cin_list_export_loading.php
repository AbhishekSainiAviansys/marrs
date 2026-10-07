<?php include('header.php');
// print_R($result);
?>
<style>
    .total{
        display: flex;
        justify-content: space-between;
        /*flex-wrap: wrap;*/
    /*align-content: center;*/
        /*align-items: flex-end;*/
    }
</style>
 <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>

        <link href='<?php echo base_url();?>public/library/select2.min.css' rel='stylesheet' type='text/css'>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Extract CIN List </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
		  
			<table  cellpadding="" >
			    
				<tr>
				    
				    <td>Period:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="period_id" id="period_id" style="width: 220px;"  required>
                                    <option value=''>Select period</option>
                                    <?php 
                                    foreach ($period_load as $row)
                                    { ?>
                                <option value="<?php echo $row['period_id'];?>" <?php if($row['period_id']==$result['period_id']){ echo 'selected="selected"';} ?> > <?php echo $row['academic_year'];?></option>
                                  <?php   } 
                                  
                                  ?>
                                 </select>
					 </td>

				    
				
					<td>Country:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="country_id" id="country_id" style="width: 220px;"  required>
                                    <option value=''>Select country</option>
                                    <option value='105' selected>INDIA</option>
                                </select>
					</td>
					
					<td>State:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="state_id" id="state_id" style="width: 220px;"  required>
                                    <?php 
                                    foreach ($state_load as $row)
                                    { ?>
                                <option value="<?php echo $row['state_subdivision_id'];?>" <?php if($row['state_subdivision_id']==$result['state_id']){ echo 'selected="selected"';} ?> > <?php echo $row['state_subdivision_name'];?></option>
                                  <?php   } 
                                  
                                  ?>
                                                                   </select>
					</td>
					
			        
                	<td>Franchise:<br />
                						<!--<h3><b>School : </b></h3>-->
                						
                                                <select name="franchise" id="franchise" style="width: 220px;" required>
                                                    <option value=''>-- select franchise --</option>
                                                    <?php 
                                    foreach ($franchise_load as $row)
                                    { ?>
                                <option value="<?php echo $row['franchise_id'];?>" <?php if($row['franchise_id']==$result['franchise']){ echo 'selected="selected"';} ?> > <?php echo $row['username'];?></option>
                                  <?php   } 
                                  
                                  ?>
                                                </select>
                                                
                					</td>
                					
                					
                	<td>Product:<br />
						
                                <select name="product" id="product" style="width: 250px;"  required>
                                  
                                       <option value=''>Select Product</option> 
                                      <?php 
                                    foreach ($product_load as $row)
                                    { ?>
                                <option value="<?php echo $row['product_name'];?>" <?php if($row['product_name']==$result['product']){ echo 'selected="selected"';} ?> > <?php echo $row['product_name'];?></option>
                                  <?php   } 
                                  
                                  ?>
                                </select>
					</td>
                	<td>
					        <div id='series'>
							    <label>Lunar Series</label>
							        <select name='series' style='width:150px;' >
							            <?php foreach($series as $res){ ?>
							                <option value='<?php echo $res->series; ?>' <?php  if($res->series==$result['series']) { echo 'selected="selected"'; } ?>><?php echo $res->series; ?></option>
							            <?php } ?>
							        </select>
							    <label>Subject</label>
							    <select name='subject' style='width:150px;' >
						        <?php foreach($subject as $res){ ?>
						                <option value='<?php echo $res->subject; ?>' <?php  if($res->subject==$result['subject']) { echo 'selected="selected"'; } ?>><?php echo $res->subject; ?></option>
						            <?php } ?>
						        </select>
							</div> 
					 </td>				    
                					
                				
                </tr>                      
				
				<tr>
				    
				           	<td >Area:<br />
                					<select name="area"  id='area' style='width: 220px;'  >
                					    <?php if(isset($result['area'])){?>
                                        <option value="All" <?php if($result['area']=='All'){echo 'selected="selected"';} ?>>All Area</option>
                                        <?php }else{ ?>
                                        <option value=''>-- select area --</option>
                                        <option value="All" >All Area</option>
                                        <?php } ?>
                                         <?php 
                                    foreach ($area_load as $row)
                                    { ?>
                                <option value="<?php echo $row['area_code'];?>" <?php if($row['area_code']==$result['area']){ echo 'selected="selected"';} ?> > <?php echo $row['city_name'];?></option>
                                  <?php   } 
                                  
                                  ?>             
                                    </select>
                            </td>  
				    
			            	<td >
			            	    School:<br>
                					<select name="school_id"  id='school' style='width: 220px;'  >
                                      <?php if(isset($result['area'])){?>
                                        <option value="All" <?php if($result['school']=='All'){echo 'selected="selected"';} ?>>All School</option>
                                        <?php }else{ ?>
                                        <option value=''>-- select school --</option>
                                        <option value="All" >All School</option>
                                        <?php } ?>
                                         <?php 
                                    foreach ($school_load as $row)
                                    { ?>
                                <option value="<?php echo $row['id'];?>" <?php if($row['id']==$result['school']){ echo 'selected="selected"';} ?> > <?php echo $row['school_name'];?></option>
                                  <?php   } 
                                  
                                  ?>             
                                    </select>
                                      </td>  
                     
                                                
                                      
			            <td> <br /><input type="submit" name="submit" value="Submit" class='btn btn-primary' /> </td>
			            <!--<input type="submit" name="ok" value="" />-->
				</tr>
		    </table>		 
		
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			 <?php if(!empty($student)){
 
  ?>
        <div class="total">		
			    <h4><?php echo 'Total Students: '.count($student); ?></h4>  
			    <button name='export' style="margin-left: 30px;" class='btn btn-primary'>Export Excel</button>
			    <input type='hidden' name="school_id" value="<?php echo $school_id;?>">
			    <input type='hidden' name="state" value="<?php echo $state;?>">
			    <input type='hidden' name="franchise" value="<?php echo $franchise;?>">
			     <input type='hidden' name="area" value="<?php echo $area;?>">
			    </form>
		</div>	    
		<TABLE border="1" width="100%" cellpadding="10px" >
									
			
			<br>
			
			
							 <tr>
							     
								<th>SI no</th>
								<th>CIN</th> 
								<th>Student Name</th>
								<th>Class</th> 
								<th>Period</th> 
								<th>Product Name</th>
								<th>State</th> 
								<th>School</th>
								<th>Area Code</th>
							 </tr>
											<?php $i=1; foreach($student as $value) {
											
											 $state_subdivision_name = $this->db->get_where('states',array('state_subdivision_id'=>$value['state_id']))->row()->state_subdivision_name;
                               $franchise_name = $this->db->get_where('franchise',array('franchise_id'=>$value['franchise_id']))->row()->username;
                               if($value['school_name']==''){
                                $school_name = $this->db->get_where('school_new',array('id'=>$value['school_id']))->row()->school_name;
                               }else{
                                  $school_name= $value['school_name'];
                               }
											?>
											
											
											<tr>
									<td><?php echo $i; ?></td>
								    <td align='CENTER'><?php echo $value['cin']; ?></td>
                                    <td align='CENTER'><?php echo $value['student_name']; ?></td>
								    <td align='CENTER'><?php echo $value['class'];?></td>
								    <td align='CENTER'><?php  echo $academic_year;?></td>
								    <td align='CENTER'><?php echo $result['product'] ?></td>
								    <td align='CENTER'><?php echo $state_name; ?></td>
                                    <td align='CENTER'><?php echo $school_name; ?></td>
                                    <td align='CENTER'><?php echo $value['franchise_code']; ?></td>
								   	
							 </tr>
						<?php $i++; } ?>		
				</TABLE>
				
				<?php }
				if(!empty($message)){
				?>
			
    <div style='text-align:center;'>
     <h3 style='color:crimson;'><?php  echo $message;?></h3> </div>
  <?php  } ?>    
		</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div>



	<style>
    footer p {
    text-align: center;
    
}
 footer {
    padding: 10px;
    background-color: DarkSalmon;
 }
</style>

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


<script>





    $("#school").select2();
        var username = $('#school option:selected').text();
        var userid = $('#school').val();
           
     
        $("#state_id").change(function(){
            var state_id =this.value;
            //alert(franchise_id);
            var BASE_URL="<?php echo base_url();?>";
            $.ajax({
            url:"<?php echo base_url();?>manage/ajax/franchiseList_",
            data:{state_id:state_id},
            type: 'post',
            success:function(result)
            {
            	//alert(result);
            	 $("#franchise").html(result);
            	 
            
        }});
    });

$("#area").change(function(){
    var area_code =this.value;
    var period_id = $('#period_id').val();
 //alert(franchise_id);
    var BASE_URL="<?php echo base_url();?>";
    $.ajax({
    url:"<?php echo base_url();?>manage/ajax/school_list_period",
    data:{area_code:area_code,period_id:period_id},
    type: 'post',
    success:function(result)
    {
    	//alert(result);
    	 $("#school").html(result);
    	 
    
    }});
});



$("#franchise").change(function(){
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



$("#franchise").change(function(){
    var franchise_id =this.value;
    // alert(franchise_id);
    var BASE_URL="<?php echo base_url();?>";
    $.ajax({
        url:"<?php echo base_url();?>manage/ajax/school_list_franchisewise",
        data:{franchise_id:franchise_id},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
    
    }});
});




$(document).ready(function(){
    var value = $('select#period_id option:selected').val();
     if(value === '12'){
                // Show competition price dropdown
                $('[id="hide"]').hide();
            } 
    $("#period_id").change(function(){
        
         var selectedValue = $(this).val();
            if(selectedValue === '12'){
                // Show competition price dropdown
                $('[id="hide"]').hide();
            } 
            if(selectedValue === '13' || selectedValue === '14'){
                $('[id="hide"]').show();
            }else{
             $('[id="hide"]').hide();   
            }
    });
    
});
</script>	
 </body>
 <?php include('footer.php');?>