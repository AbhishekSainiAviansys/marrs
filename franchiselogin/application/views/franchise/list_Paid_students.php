<?php include('header.php');  /*echo" <pre>";print_r($list);*/ ?>
<div><?php echo $this->notifications->display_html();?> </div>

<div>
		<ul class="breadcrumb">
			<li>
					<a href="<?php echo SITE_URL?>registration/">Registration</a> <span class="divider">/</span>
			</li>
			<li>
					<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>registration/requests/">Requests List</a>
					<?php }else{?>
							<a href="<?php echo SITE_URL?>registration/">List</a>
					<?php }?>

			</li>
		</ul>
</div>
			
<form method="POST">
	<div>		
          <div class="box span12">
          <div class="box-header well" data-original-title>
             <h2><i class="icon-user"></i> Registration <?php if($type=='request'){?> Requests<?php }?></h2>
              <div class="box-icon">
                     <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                     <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
              </div>
			 </div>
			  <?php echo $this->notifications->display_html();?> 
			 </div>
  </div>
<!--..............................................................SEARCH CODE............................................................................-->                    
	<div class="box-content">
      <div class="control-group">
			 <div class="controls">
               <table  cellpadding="5px" >
                    <tr>
                         <td>Service:<br />
                             <?php
								           $options=array(""=>"Select");
							              foreach($services as $servicesval)
								           {
                                       $names=$servicesval['service_name'];
                                       $id=$servicesval['service_id'];
								               $options[$id] = $names;
	                                }
								           $js = 'onChange="list_details(this.value)"';
								           echo form_dropdown('service_id', $options,isset( $service_id )?$service_id: '',$js);
								     ?>
                             </td>
                      </tr>
                             
                      <tr id="tr_details">  <?php include('pid_list.php');?>  </tr> 
                      
                </table>
               
                <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>assign_cin/'">Reset</button>		
			</div> <!--END OF <div class="controls">-->
			<?php  if(isset($aim) && ($aim =='view_cin'&& !empty($list))){ ?> 
			<div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>
	 <?php }?>
	 
	 </div><!--END OF <div class="control-group">-->
                              
<!--..............................................................SEARCH CODE END............................................................................--> 
<?php if($info=="empty")
{ ?>
	
    <div class="notifications">
      <div class="alert alert-info " id="notification-bar">
		    <button type="button" class="close" data-dismiss="alert">x</button>
		    <h4 class="alert-heading">Information!</h4>
		    <p style="color:#F00">The fields Service & Period are mandatory</p>
      </div>
   </div>
   
<?php
} ?><!-- END OF if($info=="empty") -->


<?php if(empty($list) || isset($_POST['Search']))
{?>

   <div class="notifications">
     <div class="alert alert-info " id="notification-bar">
		   <button type="button" class="close" data-dismiss="alert">&times;</button>
		   <h4 class="alert-heading">Information!</h4>
		   <strong>No record(s) found.</strong> 
    </div>
  </div>
<?php
} /* End of if(empty($list) || isset($_POST['Search'])) */


else
{
?>
	<table class="table table-bordered">
		 <thead>
				 <tr>
					         <?php if(isset($aim) && ($aim =='list'|| $aim =='list')){ ?> 
						      <th>
								     <label class="checkbox inline">
								       <input type="checkbox" id="inlineCheckbox1" value="option1" class="listCheckBoxAll"> 
								     </label>
						      </th>
					         <?php }?>
							   <th>Serial No</th>
                              
							   <th>Name</th>
							   <?php if(isset($aim) && ($aim =='view_cin'|| $aim =='view_cin')){ ?>  <th>CIN</th>  <?php }?> 
                        <th>Category</th>
                        <th>School</th> 
                        <th>Franchise Code</th>      
                        <th>State</th>
                        <?php if(isset($aim) && ($aim =='view_cin'|| $aim =='view_cin')){ ?>  <th>CIN Alloted Date</th>  <?php }?> 
                        <?php if(isset($aim) && ($aim =='list'|| $aim =='list')){ ?>  <th>Student Register Date</th>  <?php }?>             
			  </tr>
		</thead>   
	   <tbody> 			  
			 <?php 
			       $i=1;
					 foreach($list as $value)
					 {  ?>    
			          <tr>
							 <?php if(isset($aim) && ($aim =='list'|| $aim =='list')){ ?> 
						 	     <td> 
						 	         <label class="checkbox inline"> 
                                 <input name="student_id[][<?php echo $value['franchise_code']; ?>]"  type="checkbox" class="listCheckBoxEach commonLeftCheck" value="<?php echo $value['student_id'] ?>"<?php if(in_array($value['student_id'],$student_id)) echo 'checked="checked"';?>/>
									   </label>
								  </td>
			         	 <?php }?>
			         	
					       
					           <td><?php echo $i++; ?></td>
                               	 
                                <td class="center"><?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td> 
                          
                          <?php if(isset($aim) && ($aim =='view_cin'&& $aim !=''))
                               { ?> 
                                 <td class="center"><?php echo $value['cin']; ?></td>
                          <?php }?>
                          <td class="center"><?php echo $value['categoryKey']; ?></td>
                          <td class="center"><?php echo $value['school_name'].$value['school_address']; ?></td>
                          <td class="center"><?php echo $value['franchise_code']; ?></td>   
                          <td class="center"><?php echo $value['state_subdivision_name']; ?></td>
                          <?php if(isset($aim) && ($aim =='view_cin'|| $aim =='view_cin')){ ?>  
                              <td class="center"><?php echo $value['cin_assign_date']; ?></td> 
                          <?php }?> 
                          <?php if(isset($aim) && ($aim =='list'|| $aim =='list'))
                               { ?> 
                                   <td class="center"><?php echo $value['created_date']; ?></td>
                          <?php }?>
                          
                          
       
                    
                     <?php if(isset($aim) && ($aim =='list'|| $aim =='list')){ ?> 
                         <td class="center">
									   <span 
									           <?php  if($value['pid_status']=='Assign')
									             { ?> class="label label-success" <?php } ?>
									           <?php if($value['pid_status']=='Notassign')
									            { ?>  class="label label-info" <?php } ?>  >
									            <?php echo $value['pid_status'] ?>
									   </span>		  
					         </td>
					        <?php }?>
                     <?php if(isset($aim) && ($aim =='view_pid'|| $aim =='view_pid')){ ?>
                         <td class="center">  <?php echo $value['pid']; ?>  </td>
                     <?php }?>
                 </tr>
           <?php }?> 
       </tbody>
 </table> 
 
 <!-- START HIDDEN FIELS FOR SAVE SCHOOL CODE & PERIOD ID-->
 


<!-- END  HIDDEN FIELS FOR SAVE SCHOOL CODE & PERIOD ID-->

 <?php if(isset($aim) && ($aim =='list'|| $aim =='list')){ ?> 		  
		 <center>
					 <button type="submit" class="btn btn-primary" id="Assign_cin" name="Assign_cin">Assign Cin</button>
                     <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>assign_pid/'">Reset</button>
					 
		 </center>
 <?php }?>
  
 <!-- START  DIV  FOR PAGINATION-->
<div class="pagination pagination-left">
						 <ul>
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">Next</a></li>
						 </ul>
</div>
 <!-- END   DIV  FOR PAGINATION-->
<?php }?> <!-- END OF ELSE -->
</div></div><!--/span--></div></div></div>
</form>

 <!-- START OF SCRIPTING CODE -->
 
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
			
	function list_details(id)
	{	
	   	/*alert("88888888888");*/
			var service_id=$("#service_id").val();
			var service_id=id;
			var data=new Object();
			data.service_id=service_id;
			/*alert(data.service_id);*/	
						
				$.ajax({
															
						   	url:BASE_URL+"manage/assign_cin/listDetails/",
								data:data,
								type: 'POST',
								success:function(result)
								{
									/*lert("xchjhfv"+result);*/
									$("#tr_details").html("");
									$("#tr_details").html(result);
								},/*end success*/																		
														
								error:function()
									{
										alert("Failed to load ajax noregistered_listDetails");	
									}/*end error*/																	
						
						});/*end ajax*/
   } /*END OF FUNCTION LIST DETAILS*/
			
</script>
<?php include('footer.php'); ?>
<?php $this->confirmation->confirm('delete');?>