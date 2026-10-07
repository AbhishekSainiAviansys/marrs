<?php include('header.php');//echo"<pre>"; print_r($state_wise_schools);exit;?>
<?php echo $this->notifications->display_html();?> 
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>Shool List</li>
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
	  <div class="control-group">
	  <div class="controls">
        
<table  cellpadding="5px" >
<tr>

 <td valign="top">Status <span style="color:#F00">*</span><br />
      
<!--    -----------  STATE ---------------    -->   
<select name="school_status"  id="school_status"   style="width:200px;"  >
  <option value="">-  select status  -</option>
  <option value="Active" <?php if( isset( $result['school_status'] )) if($result['school_status']== "Active") {?> selected="selected" <?php }?>>Active</option>  <option value="Deleted" <?php if( isset( $result['school_status'] )) if($result['school_status']== "Deleted") {?> selected="selected" <?php }?>>Deleted</option>  
<option value="All" <?php if( isset( $result['school_status'] )) if($result['school_status']== "All") {?> selected="selected" <?php }?>>All</option>     
    </select>
    <span style="color:#F00"><?php echo $this->validation->show_error('school_status',"Status Required.");?></span>

  </td>




 <td valign="top">State <span style="color:#F00">*</span><br />
      
<!--    -----------  STATE ---------------    -->   
    <select name="state_subdivision_id"  id="state_subdivision_id"  title="First Select State" style="width:200px;"  >
<option value="">select state</option>
<?php 	foreach($stateatload as $stateval): ?>
<option value="<?php echo $stateval['state_subdivision_id']; ?>"
<?php if( isset( $result['state_subdivision_id'] ) ){ if($result['state_subdivision_id'] == $stateval['state_subdivision_id']) {  ?> selected="selected" <?php }} ?>>
<?php echo $stateval['state_subdivision_name']; ?></option>
<?php  endforeach;  ?>


</select>
    <span style="color:#F00"><?php echo $this->validation->show_error('stateID',"state Required.");?></span>

  </td>
<!--    -----------  FRANCHISE ---------------    -->  

   <td valign="top" >Franchise<br />
       <select name="franchise_id" id="franchise_id" style="width:200px;"> 
          <option value="">select</option>
              <?php 	foreach($franchise as $val): ?>
          <option value="<?php echo $val['franchise_id']; ?>"<?php if( isset( $result['franchise_id'] ) )
             { if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php }} ?>>
              <?php echo $val['franchise_code']; ?>
          </option>
          <?php  endforeach;  ?>
        </select>
        
        
   </td>

							
<!--    -----------  SCHOOL ---------------    -->            
   <td>  School:<input class="input-large focused" id="school_name" name="school_name" type="text" style="width: 170px; padding: 4px" 
   value="<?php if( isset( $result['school_name'] ) )echo $result['school_name']; ?>"  >
    </td>
 </tr>
 </table>
        
              
								
<!--    -----------  BUTTON ---------------    -->            
                        <br>         
						<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
						<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>school/'">Reset</button>
				</div> <!--End DIV for class="controls" -->
			 </div><!--End DIV for class="control-group"-->
<br> 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
 
 <?php $status = $school['status'];
      $list = $school['schools'];
	 /* echo "<pre>";print_r($school);exit;*/

       switch($status):
	   
	   case "No_data_found":?>
       
	   <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Information!</strong> No record(s) found.
       </div>

	  <?php  break;
	   
	   case "Data_found" : ?>
       <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
	   <table class="table table-bordered" width="75%">
        <thead>
          <tr>
              <th>Slno</th>
              <th>School Code</th>
             
              <th>School Name</th>
              <th>School Address</th>
              <th>State Name</th>
              <th>Franchisee Code</th>
              <th>School Status</th>
              <th>Actions</th>
          </tr>
          </thead>   
          <tbody>
           <?php  $i=1; foreach($list as $value){  ?>
            <tr>
                <td width="5%"><?php echo $i; ?></td>
                <td  width="15%" class="center"><?php echo $value['school_code']; ?></td>
                <!--<td  width="15%" class="center"><?php echo $value['access_code']; ?></td>-->
                <td width="15%"><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ', $value['school_name']); ?></td>
                <td  width="20%"><?php echo preg_replace('/[^A-Za-z0-9\-]/', ' ', $value['school_address']); ?></td>
                <td  width="20%"><?php echo $value['state_subdivision_name']; ?></td>
                <td  width="20%"><?php echo $value['franchise_code']; ?></td>
                <td  width="20%"><?php echo $value['school_status']; ?></td>
                
                <!--<td  width="20%"class="center">
                    <a class="btn btn-success" href="<?php echo SITE_URL?>school/view/id/<?php echo $value['school_id']; ?>" title="View" target="_blank">
                       VIEW <i class="icon-zoom-in icon-white"></i> 
                                                                    
                    </a> 
                    <a class="btn btn-info" href="<?php echo SITE_URL?>school/edit/id/<?php echo $value['school_id']; ?>" title="Edit" target="_blank">
                       EDIT <i class="icon-edit icon-white"></i>  
                                                                    
                    </a>
                        
                </td>-->
            </tr>
<?php $i=$i+1; } ?>	
</tbody>
</table>
<?php break; endswitch;?>

 

 
					</div><!--End DIV for class="box-content"--> 
				</div><!--/span-->
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>
<?php 
	//$this->confirmation->confirm('delete');
?>
		<script type="text/javascript">
       $("#state_subdivision_id").change(function()
	   {
		   /*alert(this.value);*/
        var data=new Object();
        data.state_id=this.value;
        $.ajax({
           url:"<?php echo base_url();?>manage/ajax/getStateFranchise/",
            data:data,
            type: 'post',
            success:function(result)
			{
               // alert(result);
				 $("#franchise_id").html(result);
        }});
    }); 
 </script>