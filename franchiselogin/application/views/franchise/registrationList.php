<?php include('header.php');
//echo "<pre>";print_r($list);//echo $status;exit;
$status=$list['status'];

 ?>
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
<h2><i class="icon-user"></i> Registration</h2>
<div class="box-icon">
    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<?php echo $this->notifications->display_html();?> 
<div class="box-content">
 <!--.....................SEARCH CODE..................................................... -->
 
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
                             <tr id="tr_details" >
                                <?php include('service_based_details.php');?>
                             </tr> 

                                </table>
                                    
                                    <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                                    <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>franchise/'">Reset</button>
							
					</div>
<?php  // if(isset($list) && (!empty($list)) ||((isset($aim) &&($aim =='approved_list'&& (!empty($aim)))))) { ?> 
		 <!-- <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export"> Export Excel</button></div>-->
 <?php //} ?>
</div>
                              
<!--...............................SEARCH CODE END...................--> 
<?php /* if(isset($info) && $info!='' )*/

if($info=="empty"){ ?>
 <div class="notifications">
 <div class="alert alert-info " id="notification-bar">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<h4 class="alert-heading">Information!</h4>
		<p style="color:#F00">The fields Service , Period  & Competition Levels are mandatory</p>
</div>
</div>
<?php } ?>

<?php if(empty($list['reg_list']) || isset($_POST['Search']))
{?>
<div class="notifications">
 <div class="alert alert-info " id="notification-bar">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4 class="alert-heading">Information!</h4>
		 <strong>No record(s) found.</strong> 
</div>
</div>
<?php
}
else
{
?>
   <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export"> Export Excel</button></div>
	<table  width="100%" border="1" cellspacing="5px" cellpadding="2px">
	<thead>
		<tr>
			<th>Serial No</th><th>CIN</th><th>Name</th><th>Category</th><th>School</th><th>TRN</th><th>PRN</th><th>Action</th> 
	   </tr>
	</thead>   
	<tbody>
       <?php $i=1;foreach($list['reg_list'] as $value){ ?>
               <tr>
                    <td><?php echo $i++; ?></td>
                    <td ><?php echo $value['cin']; ?></td>
                    <td ><?php echo $value['first_name'].$value['middle_name'].$value['last_name']; ?></td>
                    <td ><?php echo $value['categoryKey']; ?></td>
                    <td ><?php echo $value['school_name']; ?></td>
                    <td class="center"> <?php echo $value['temperory_registration_number']; ?></td>
                    <td class="center"> <?php echo $value['permenent_registration_number']; ?></td>
                    
                    <td> <a  target="_blank" class="btn btn-success" href="<?php echo SITE_URL?>registration/view/reg_id/<?php echo trim($value['competition_registration_id']);  ?>" title="View">
                          <i class="icon-zoom-in icon-white"></i> </a>
                          
                    </td>
               </tr>
	 <?php } ?>	
       </tbody>
    </table> 
    <?php }?>
    </div>
   </div><!--/span-->
   </div>
  </div>	
 </div>
</form>


		<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			<script type="text/javascript">
			function list_details(id)
			{	
						//alert("88888888888");
						var service_id=$("#service_id").val();
						var service_id=id;
						
							var data=new Object();
							data.service_id=service_id;
							//alert(data.service_id);
							
							$.ajax({
								url:"<?php echo base_url();?>franchise/registration/get_service_complevel/",
								data:data,
								type: 'POST',
								success:function(result){
									
									//alert("xchjhfv"+result);
									
									$("#tr_details").html("");
									$("#tr_details").html(result);
									},//end success*/
									
								error:function()
									{
										alert("Failed to load ajax noregistered_listDetails");	
									}//end error
									
							});//end ajax*/
	          }
					//});//end function
					
					
	
            </script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>