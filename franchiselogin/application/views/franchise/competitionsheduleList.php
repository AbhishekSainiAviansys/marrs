<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
                <?php echo $this->notifications->display_html(); ?>
					<li>
						<!--<a href="<?php //echo SITE_URL?>blog/">Post</a> <span class="divider">/</span>-->
					</li>
					<li>
							<!--<a href="<?php //echo SITE_URL?>blog/">List</a>-->
					</li>
				</ul>
			</div>
			<?php echo $this->notifications->display_html();?> 
			<div>		
				<div class="box span12">
                
					<div class="box-header well" data-original-title>
						<h2></i>  Competition Schedule List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					
					<form method="POST">
					<div class="box-content">
					<div class="control-group">
						<div class="controls">
				  <!-- Franchise
							<?php
								$options=array(""=>"Select");
							foreach($franchise as $franchiseval) {
                        $name=$franchiseval['franchise_code'];
                          $id=$franchiseval['franchise_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('fr_id', $options, isset( $fr_id )?$fr_id: '');
						
								?> -->
						 
			     	Period
							<?php
							$js = 'id="period_id"';
							$options=array(""=>"Select");
							foreach($period as $periodsval):
                               $name=$periodsval['period_name'];
                               $id=$periodsval['period_id'];
							   $options[$id] = $name;
	                        endforeach;
							
								echo form_dropdown('period_id', $options, isset( $period_id )?$period_id: '',$js);
						
								?>
									Level
							<?php
							$js = 'id="competition_level_id"';
							
								$options=array(""=>"Select");
							foreach($level as $clevelval) {
                        $name=$clevelval['competition_level_name'];
                          $id=$clevelval['competition_level_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('competition_level_id', $options, isset( $competition_level_id )?$competition_level_id: '',$js);
						
								?>
								
							<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
								<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>competitionshedule/'">Reset</button>
						</div>
						
							
								
							  </div>
					<?php if(empty($list)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else{
					
					?>
						<table class="table table-bordered">
						  <thead>
							  <tr>
                                  <th>SI NO</th>
								  <th>Period</th>
								  <th>Center</th>
								  <th>Competition Level</th>
								  <th>Category</th>
								  <th>competition Date & Time</th>
                                  <th align="center">Manage School-wise Schedule</th>
								  <th>Edit</th>
							  </tr>
						  </thead>   
						  <tbody>									
							
						<?php $sino=1; foreach($list as $value): ?>	
							<tr>
                                    <th><?php echo $sino; ?></th>
                                    <td><?php echo $value['period_name'] ?></td>
                                    <td><?php echo $value['center_name'] ?></td>
                                    <td><?php echo $value['competition_level_name'] ?></td>
                                    <td><?php echo $value['categoryKey'] ?></td>
                                    <td><?php echo $value['competition_date']." & ".$value['reporting_time'] ?></td>
                                    <td>
                                        <a href="#" title="Assign Schedule"> 
                                          <button class="assign_btn" value="assign"  title="Click here to assign this schedule to schools"
                                                  data-scheduleId="<?php echo $value['competition_schedule_id']; ?>"
                                                 style="background-color:#CCF;font-weight:bold; color:#008000" >Assign </button>
                                         </a>
                                       <a href="#"	title="Update Schedule"> 
                                          <button class="assign_btn"  value="update"  title="Click here to View/Remove this schedule from already assigned schools"
                                           data-scheduleId="<?php echo $value['competition_schedule_id']; ?>"  
                                                   style="background-color:#CCF;font-weight:bold; color: #FF8000";>
                                                  View/Remove  </button>
                                       </a>

                                    </td>
   
                                
							
								<td class="center">
								
									<a class="btn btn-info" href="<?php echo SITE_URL?>competitionshedule/edit/id/<?php echo $value['competition_schedule_id']; ?>" title="Edit this competitiion schedule details">
										<i class="icon-edit icon-white"></i>  
										                                           
									</a>
									<!--<a class="delete btn btn-danger" href="<?php //echo SITE_URL?>competitionshedule/delete/id/<?php //echo $value['competition_schedule_id']; ?>" title="Delete this competitiion schedule">
										<i class="icon-trash icon-white"></i> 
										
									</a>-->
									
								</td>
							</tr>
						<?php   $sino+=1; endforeach; ?>	
						  </tbody>
					  </table> 
					<?php } ?>  
                    <!-- Message div when no schools have the schedule-->
                    <div id="list_schedule_school_empty">      </div>

                    <!-- div to list schools having the selected schedule-->
                    <div id="list_schedule_school">    </div>
                    
				
				
                    <div id="errorDiv">--    </div>
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
<script type="text/javascript">
       $("#country_id").change(function()
	   {
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:"<?php echo base_url();?>franchise/students/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
            }
		  });/*End ajax*/
    });/* end $("#country_id").change(function()*/ 
	
$(".assign_btn").live("click",function(){
	
        var data=new Object();
        data.aim=$(this).val();
		var dialog_title;
		var button_name;
		var empty_msg;
		if(data.aim == "assign")
		   {
			   dialog_title="Assign competition schedule to the following schools";
		       button_name = "Assign";
			   empty_msg='<div id="assign_school_list_errorDiv" style="color:red; font-size:14px; font-weight:bold; text-align:center; padding:50px;">This competition schedule already assignd to all schools. For any updation click the View/Remove button  !... </div>';
			   
		   }
		   else
		   {
			    dialog_title="List of already assigned schools";
		        button_name = "Update";
			    empty_msg='<div id="assign_school_list_errorDiv" style="color:red; font-size:14px; font-weight:bold; text-align:center; padding:50px;">Sorry.. No Schools Found under this competition schedule!... </div>';
				
		   }
		data.compId=$(this).attr("data-scheduleId");
        $.ajax({
				url:"<?php echo base_url();?>franchise/ajax/listSchools_to_assignSchedule",
				data:data,
				type: 'POST',
				success:function(result)
				{
					 if(jQuery.trim(result)== "empty")
					 {
						 $("#list_schedule_school_empty").html(empty_msg); 
						 
					  $("#list_schedule_school_empty").dialog({
						          title : "No Schools",
							      autoOpen: true,
								  height: 200,
								  width: 940,
								  modal: true});
					 }
					 else
					 {
					 $("#list_schedule_school").html(result);
					 dialog = $("#list_schedule_school").dialog({
						          title : dialog_title,
							      autoOpen: true,
								  height: 500,
								  width: 980,
								  modal: true,
								  buttons: 
									     [  
										   { text: button_name, click: function() { assign_schedule();dialog.dialog( "close" );} }, 
										   { text: "Cancel", click: function() { dialog.dialog( "close" );} } 
										 ], 
								  close: function() { dialog.dialog( "close" );	  }	/*end close*/		     
								  });/*End dialog*/
						/*----------------------------------------------------------------------------------*/  
								function assign_schedule()
								{
									var setData=new Object();
									var school_array =new Array();
									if(data.aim == "assign")
									{
										$("input[name='schoolID[]']:checked").each(function() {
											school_array.push(this.value);
										});/*End each */
									}
									else
									{
										$("input[name='schoolID[]']:not(:checked").each(function() {
											school_array.push(this.value);
										});/*End each */
									}
									setData.aim=data.aim;
									setData.compId=data.compId;
									setData.schoolID = school_array;
											$.ajax({
													url:"<?php echo base_url();?>franchise/ajax/insertSchedule_to_schools",
													data:setData,
													type: 'POST',
													async: false,
													success:function(ins_status)
													{
														ins_status=jQuery.trim(ins_status);
													/*	alert(ins_status);*/
														$("#errorDiv").html(ins_status);
														if(ins_status == "true")
														{
															if(data.aim=="assign"){alert("successfully assign schedule to selected schools ");}
															else{   alert("successfully Remove schedule from the selected schools ");  }
															dialog.dialog("close");
														}/*end of if*/
														else if(ins_status == "false")
														{
															if(data.aim=="assign"){   alert("Failed Assign schedule !!....");  }
															else {  alert("Failed Remove schedule !!....");  }
															dialog.dialog("close");
														}
														else if(ins_status == "null")
														{
															alert("No schools selected"); 
														}/*End of else*/
														/*else
														{ alert("Unknown Error"+ins_status); }*/
													},/*inner ajax success*/
													error:function(xhr, status, error) 
													{$("#errorDiv").html(xhr.responseText);
														   alert("Failed to Load Ajax insertSchedule"+xhr.responseText);
													}/*inner ajax error*/
										});/*End ajax*/	
										
								}/*function assign_schedule()*/	
						/*----------------------------------------------------------------------------------*/  
								
				}/*end else*/},/*End success function*/
				error: function(xhr, status, error) 
				{
				    alert("Failed to Load Ajax "+xhr.responseText);
				}		  
});/*End ajax*/

/*----------------------------------------------------------------------------------*/ 
 
$("#chkSchool_all").live("click",function(){

    if($(this).is(":checked"))
	{ 
	  $(".chkSchools").attr('checked',true);
    }/*End if*/
	else
	{
	$(".chkSchools").attr('checked',false);
	}/*End else*/

});/*end of ("#chkSchool_all").live("click",function()*/

	
});/*end Ready function*/

/*------------------------------------------------------------------------------------------------------------*/
	  /* switch(aim)
	   {
			   case "assign" :
			        
			   break;
			   case "update" :
			   
			   break;
	   }/* End switch (aim)*/
	   
	/*}/*End function show_schools*/
 </script>
