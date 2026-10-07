<?php 
include('header.php'); ?>

<div>
	<ul class="breadcrumb">
  <?php  if($resultEdit=="true") { ?>
  	<li> <a href="<?php echo SITE_URL?>manage/">Edit CIN Wise Result</a> <span class="divider"></span> </li>
  <?php }/*End if*/else{ ?>
  	<li> <a href="<?php echo SITE_URL?>manage/">Add CIN Wise Result</a> <span class="divider">/</span> </li>
  <?php }/*End else*/ ?>
<!--		<li> <a href="<?php //echo SITE_URL?>manage/<?php //echo ($list['']>0)?'edit':'add';?>/"><?php// echo ($list['']>0)?'Edit':'Add';?></a></li>
-->	</ul>
</div>
<?php echo $this->notifications->display_html();?> 
			
<div class="row-fluid sortable">
	 <div class="box span12">
     
		  <div class="box-header well" data-original-title>
  <?php  if($resultEdit=="true") { ?>
			   <h2><i class="icon-edit"></i>Edit <?php // echo ($list['']>0)?'Edit':'Add';?></h2>
  <?php }/*End if*/else{ ?>
			   <h2><i class="icon-edit"></i>Add <?php // echo ($list['']>0)?'Edit':'Add';?></h2>
  <?php }/*End else*/ ?>
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
							    <!-- <h1><small>Student CIN wise result</small></h1>-->
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
					<input type="submit" class="btn btn-primary" id="cin_search" name="cin_search" value="View Student"/>
					<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>result/'">Reset</button>
				
			</div>
					
<!-- ................................ Search Options Ends...................................  -->						
  
  <?php
  
  /*echo '<pre>';print_r($result);*/
  if(!empty($result)){ ?>
  			  <div id="cin_detailsDiv">
              <?php
					
					$cinDetails=$result[0];
					$cinLevels=$result[1];
					$student_id=$result[2];
					
				   /*echo '<pre>';print_r($cinLevels);echo "<br>";
					echo '<pre>';print_r($getResult);echo "<br>";
					echo '<pre>';print_r($cinDetails);echo "<br>";
					echo '<pre>';print_r($student_id);exit;*/

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
                    </tr>
                    
					<tr>
                        <td>CIN </td>
                        <td>:</td>
                        <td><?php echo $cinDetails['cin'];  ?> </td>
                    </tr>

					<tr>
                        <td>Period </td>
                        <td>:</td>
                        <td><?php echo $cinDetails['period_name'];  ?> </td>
                    </tr>
                    
					<tr>
                        <td>Franchise Code </td>
                        <td>:</td>
                        <td><?php echo $cinDetails['franchise_code'];  ?>  </td>
                    </tr>
					<tr>
                        <td>Category </td>
                        <td>:</td>
                        <td><?php echo $cinDetails['categoryKey'];  ?>   </td>
                    </tr>
                    
					<tr>
                        <td>Service</td>
                        <td>:</td>
                        <td><?php echo $cinDetails['service_name'];  ?>   </td>
                    </tr>
                    
					<tr>
                        <td>School</td>
                        <td>:</td>
                        <td><?php echo $cinDetails['school_address'];  ?>    </td>
                    </tr>
                    

<?php if(!empty($cinLevels)){  ?>
					<tr>
                        <td>Competition Level</td>
                        <td>:</td>
                        <td>
                        <b> 
						<?php 
						 /* 
						 if($resultEdit=="true")
							{   echo $resultEdit_level; }
						  else
							{
						*/   
							echo $cinLevels[0]['competition_level_name'];  
							
						/*}/*end else*/
						?>
                        </b>
                        
                        
                        </td>
                    </tr>
					<tr>
                        <td>Result Status </td>
                        <td>:</td>
                        <td> 
                         <?php
                                $options = array(
                                                  ''  => 'select',
                                                  'Q'    => 'Qualified',
                                                  'NQ'   => 'Non-Qualified',
                                                  'ABS'   => 'Absent'
								                );
								if($resultEdit=="true")
								 { echo form_dropdown('result_status', $options, isset($result[0]['status'])?$cinLevels[0]['status']:'' ); }
								else
								 { echo form_dropdown('result_status', $options, isset($getResult[0]['status'])?$getResult[0]['status']:'' ); }
                        ?>
    
                        </td>
                    </tr>
<?php } else { ?>
<tr><td colspan="3" align="center"><font color="#FF0000"><b>Not registered</b></font></td></tr>
<?php } ?>
					</table>
					<div class="form-actions">
                    <?php  if($resultEdit=="true") { ?>
						<input type="submit" class="btn btn-primary" id="cin_result_edit" name="cin_result_edit" value="Edit Result"/>
                    <?php }else{  ?>
                    	<input type="submit" class="btn btn-primary" id="cin_result_submit" name="cin_result_submit" value="Save Result"/>
					<?php } ?>
                    </div>
					<?php   
					} 
					else
					 {  
					   //if(isset())
					   //{
						   echo "No Records Found"; 
					  // }
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
