<?php include('header.php');
/*echo '<pre>';
print_r($bulk_students);
*/?>
<script type="text/javascript">


//----------------------Get datils of Franchise , Competition level & school Based on SERVICE------------------------------------------
//$("#service_id").change(function(){
function list_details(id)
{	
	//alert("hilllll");
	//var service_id=$("#service_id").val();
	var service_id=id;
	//alert(service_id);
        var data=new Object();
        data.service_id=service_id;
        $.ajax({
            url:BASE_URL+"manage/result/listDetails/",
            data:data,
            type: 'post',
            success:function(result){
				//alert(result);
                $("#tr_details").html("");
                $("#tr_details").html(result);
				$("#tr_bttn").css("display","block");
				},//end success
			error:function()
				{
					alert("Failed to load ajax listDetails");	
				}//end error
		});//end ajax
}
//});//end function



//------------------------------------------
function get_student_details(){
	
	
	    if($("#period_id").val()=='' || $("#service_id").val()=='' || $("#competition_level_id").val()=='')
		 {
	        alert("Period,service and Level are mandatory");
		 }
	
		 else
		 {
	
        var data=new Object();
        data.period_id=$("#period_id").val();
        data.service_id=$("#service_id").val();
        data.competition_level_id=$("#competition_level_id").val();
        data.franchise_id=$("#franchise_id").val();
        data.school_id=$("#school_id").val();
        data.category_id=$("#category_id").val();
        $.ajax({
            url:BASE_URL+"manage/result/getBULK_details/",
            data:data,
            type: 'post',
            success:function(result){
				//alert(result);
                 $("#bulk_detailsDiv").html(result);
				},//end success
			error:function()
				{
					alert("Failed to load ajax get_student_details");	
				}//end error
		});//end ajax
		 }
}//end get_details function

//----------------------------------------------------------------------------------------------------------------------
///---------------------------------------------------------------------------------
</script>

<div>
	<ul class="breadcrumb">
		<li> <a href="<?php echo SITE_URL?>manage/">Edit Bulk Result</a> <span class="divider">/</span> </li>
<!--		<li> <a href="<?php //echo SITE_URL?>manage/<?php //  echo ($aim=='edit')?'Edit':'Add'; ?>/">
<?php// echo ($list['']>0)?'Edit':'Add';?></a></li>
-->	</ul>
</div>
						<?php echo $this->notifications->display_html();?> 
			
<div class="row-fluid sortable">
	 <div class="box span12">
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Bulk Result <?php //  echo ($aim=='edit')?'Edit':'Add'; ?></h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
           
		  <div class="box-content">
			   <form class="form-horizontal" method="POST">
					 <fieldset>
<!--    #####################################################################	Service	###################-->					  
  
<!-- ................................ Search Options Starts...................................  -->

					<div class="control-group">
					<input type="hidden" id="hidden_aim" name="hidden_aim" value="" />
   <table  cellpadding="5px" >
                            <tr>

                                <td>Service:<br />
                     <select name="service_id" id="service_id" onChange="list_details(this.value)">
                                                                <option value="">select</option>
                                            <?php 	foreach($services as $val): ?>
                                            <option value="<?php echo $val['service_id']; ?>"
                                            <?php if( isset( $service_id ) )
											         { if($service_id == $val['service_id']) {  ?> 
                                            selected="selected" 
											<?php }} ?>>
											<?php echo $val['service_name']; ?></option>
                                            <?php  endforeach;  ?>
                     </select>
                                            <span class="help-inline" style="color: #F00; font-size:12px;">
											<?php 
											 $this->validation->show_error('service_id',"Service required."); ?>
											</span>
                                </td>
     </tr>
     <tr id="tr_details" >
               <?php include('detailView.php');?>
             </tr>  
     <tr id="tr_bttn">
                                <td colspan="9" align="center">
<!--                  <button  type="button" class="btn" onclick="get_student_details();" id="Search" name="Search" >Search</button>-->
					<input type="submit" class="btn btn-primary" id="bulk_view" name="bulk_view" value="View Students"/>
                   <button class="btn" type="reset" >Reset</button>
                                </td>
                            </tr>
                        </table>
						
						 
					</div>
<!-- ................................ Search Options Ends...................................  -->						
  
  
  <div id="bulk_detailsDiv">
  <?php if(isset($info) && $info!='' ) { ?>
						<div class="notifications">

	<div class="alert alert-info " id="notification-bar">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<h4 class="alert-heading">Information!</h4>
							<p>The fields Service , Period  & Competition Levels are mandatory</p>
						</div>
                        
                        
					
</div>
<?php } ?>
<?php if(!empty($bulk_students)){ ?>
<div>
<table width="80%" border="1"  align="center">
<tr>
<th>SI No</th>
<th>Name</th>
<th>CIN</th>
<th>Category</th>
<th>School</th>

<th >Result</th>
<th >Action</th>
</tr>
 <?php
$i=1;
if(isset($_POST['students'])){ $students= $_POST['students'];}
foreach($bulk_students as $val => $key ):

$comp_id=$key['competion_schedule_id'];
$stud_id=$key['student_id'];

?>
<tr>
    <td align="center"><?php echo $i;  ?></td>
    <td align="center"><?php echo $key['first_name']." ".$key['middle_name']." ".$key['last_name'];  ?></td>
    <td align="center"><?php echo $key['cin']; ?></td>
    <td align="center"><?php echo $key['categoryKey']; ?></td>
    <td align="center"><?php echo $key['school_name']; ?></td>
    <td>
    <?php echo $key['status']; ?>
    </td>
    <td>
        <a class="btn btn-info" href="<?php echo SITE_URL?>result/list_cin_results/aim/change/cin/<?php echo trim($key['cin']);?>/cmp_id/<?php echo $comp_id;?>/level_id/<?php echo trim($key['competition_level_id']);?>/stud_id/<?php echo $stud_id;?>" title="Edit">
          <i class="icon-edit icon-white"></i>Edit
        </a>  
   </td>
</tr>
<?php	
	$i++;		
endforeach;
 ?>
</table>


</div>

<?php   } else {echo "No Records Found"; }  ?>
  </div>
  
			</fieldset>
		</form>
	 </div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
