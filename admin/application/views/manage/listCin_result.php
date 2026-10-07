
<?php 
include('header.php'); 
//echo '<pre>===========';
//echo "--------------------------------------------------";print_r($studentDetails);

?>

<div>
	<ul class="breadcrumb">
		<li> <a href="<?php echo SITE_URL?>manage/">View/Edit CIN Wise Result</a> <span class="divider">/</span> </li>
<!--		<li> <a href="<?php //echo SITE_URL?>manage/<?php //echo ($list['']>0)?'edit':'add';?>/"><?php// echo ($list['']>0)?'Edit':'Add';?></a></li>
-->	</ul>
</div>
<?php echo $this->notifications->display_html();?> 
			
<div class="row-fluid sortable">
	 <div class="box span12">
     
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>View/Edit CIN Wise Result </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
           
		  <div class="box-content">
          
			   <form class="form-horizontal" method="POST">
					 <fieldset>
							<div class="page-header">
							     <h1><small>Student CIN wise result</small></h1>
							</div>
<!--    #####################################################################	Service	###################-->					  
  
<!-- ................................ Search Options Starts...................................  -->
					
			<div >
			Enter CIN :	<?php
					$data = array(
						  'name'        => 'cin',
						  'id'          => 'cin',
						  'value'       => $cin
						);

					echo form_input($data);
					?>
					<input type="submit" class="btn btn-primary" id="view" name="view" value="Search"/>
					<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>result/'">Reset</button>
				
			</div>
					
<!-- ................................ Search Options Ends...................................  -->						
  
  <?php 
  
  if(!empty($studentDetails)){ ?>
  			  <div id="show_cinDiv">
              <?php
					
					$cinDetails=$studentDetails[0];
					//echo '<pre>';print_r($cinDetails);

					$results=$studentDetails[1];
					//echo '<pre>';print_r($results);exit;

					$student_id=$studentDetails[2];
					//echo '<pre>';print_r($student_id);exit;


					if(!empty($cinDetails))
					{
					?>
			   <h1><small>Student Info</small></h1>
				<div >
					<table width="80%" cellspacing="20px">
					<tr>
						<td>Name </td>
						<td>:</td>
						<td><?php echo $cinDetails['first_name']." ".$cinDetails['middle_name']." ".$cinDetails['last_name'];?> </td>
              	 	<td>CIN </td>
               	<td>:</td>
               	<td><?php echo $cinDetails['cin'];  ?> </td>
              </tr>

					<tr>
						<td>Period </td>
						<td>:</td>
						<td><?php echo $cinDetails['period_name'];  ?> </td>
						<td>Franchise Code </td>
						<td>:</td>
						<td><?php echo $cinDetails['franchise_code'];  ?>  </td>
					</tr>
					
					<tr>
					<td>Category </td>
					<td>:</td>
					<td><?php echo $cinDetails['categoryKey'];  ?>   </td>
					<td>Service</td>
					<td>:</td>
					<td><?php echo $cinDetails['service_name'];  ?>   </td>
					</tr>
					
					<tr>
					<td>School</td>
					<td>:</td>
					<td><?php echo $cinDetails['school_address'];  ?>    </td>
					<td colspan="3"></td>
                      
                     </tr>
                     
                     <?php if(!empty($results)) { ?>
                      <tr>
                      		<td colspan="6">
                                <div>
                                    <table width="80%" border="1">
                                       <tr>
                                          <th>SI.NO.</th>
                                       	   <th>Competition level</th>
                                           <th>Result Status</th>
                                           <th>Actions</th>
                                       </tr>
                                     <?php 
									 $i=0; 
									   foreach($results as $val):
									   $i++;
									 ?> 
                                       <tr>
                                           <td><?php echo $i;?></td>
                                          <td><?php echo $val['competition_level_name'];  ?></td>
                                          <td>
										  <?php 
										  	switch($val['status']):
												 case "Q" : echo "Qualified";
												 break;
												 case "NQ" : echo "Not Qualified";
												 break;
												 case "ABS" : echo "Absent";
												 break;
												
										    endswitch;
										   ?>
                                          </td>
                                          <td>
                                          <a class="btn btn-info" 
                                             href="<?php echo SITE_URL?>result/cin_result/aim/change/cin/<?php echo trim($cinDetails['cin']);?>/cmp_id/<?php echo trim($val['competion_schedule_id']);?>/level_id/<?php echo trim($val['competition_level_id']);?>/stud_id/<?php echo trim($cinDetails['student_id']);?>" title="Edit">
										  <i class="icon-edit icon-white"></i>Edit
                                          </a>  
                                       </tr>
                                   <?php endforeach; ?>    
                                       
                                    </table>
                                
                                </div>
                            </td>
                      </tr>                         
                     <?php }//end if
					 else
					 {
					 }//end else?>
                      
  
					
					
					</table>
					<?php   
					} 
					else
					 {  
					   /*if(isset())
					   {
						   echo "No Records Found"; 
					   }*/
				     }  ?>
					</div>  
					
					<?php } ?>
			  </div>
			  
			</fieldset>
		</form>
	 </div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
