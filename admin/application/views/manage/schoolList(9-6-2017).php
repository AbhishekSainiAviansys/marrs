<?php include('header.php');//echo"<pre>"; print_r($state_wise_schools);exit;?>
<?php echo $this->notifications->display_html();?> 
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>
			 <?php if($type=='request'){?> <a href="<?php echo SITE_URL?>school/requests/">Requests List</a>
			 <?php }else{?> <a href="<?php echo SITE_URL?>School/">List</a> <?php }?>
           </li>
		</ul>
	</div>
<form method="POST">
<div>		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> School<?php if($type=='request'){?> Requests<?php }?></h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	  <div class="control-group">
	  <div class="controls">
              
       <!--    -----------  STATE ---------------    -->            
			 State <span style="color:#F00">*</span>
				<?php
							$js = 'id="stateID"';
							$options=array(""=>"Select");
							foreach($stateatload as $stateval) :
                                $name=$stateval['state_subdivision_name'];
                                $id=$stateval['state_subdivision_id'];
							    $options[$id] = $name;
	                        endforeach;
							echo form_dropdown('stateID', $options, isset( $stateID )?$stateID: '',$js);
				?>
       
              
              
<!--    -----------  FRANCHISE ---------------    -->            
                  Franchise
                    <?php
					   $js = 'id="fr_id"';
                         $options=array(""=>"Select");
                         foreach($franchise as $franchiseval) :
                              $name=$franchiseval['franchise_code'];
                              $id=$franchiseval['franchise_id'];
                              $options[$id] = $name;
                         endforeach;
                         echo form_dropdown('fr_id', $options, isset( $fr_id )?$fr_id: '',$js);
                    ?>
                    
							
<!--    -----------  SCHOOL ---------------    -->            
                         
                         School:<input class="input-large focused" id="school_name" name="school_name" type="text" style="width: 170px; padding: 4px" value="<?php if( isset( $school_name ) )echo $school_name; ?>"  > 
								
<!--    -----------  BUTTON ---------------    -->            
                        <br>         
						<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
						<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>school/'">Reset</button>
				</div> <!--End DIV for class="controls" -->
			 </div><!--End DIV for class="control-group"-->
<br> 

<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
 
 <?php if($info=="empty"){?>
			<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong> State is Mandatory</strong>
			</div>
	<?php }?>
 
 
 
 
     <?php if(empty($state_wise_schools)){?>
			<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Information!</strong> No record(s) found.
			</div>
	<?php } else{?>
    
               <div align="right"><button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
				 <table class="table table-bordered">
				  <thead>
					 <tr>
                        <th>Slno</th>
						<th>School Name</th>
                        <th>School Address</th>
						<th>Franchisee Code</th>
                        <th>State Name</th>
						<th>School Accesscode</th>
						<th>Status</th>
						<th>Actions</th>
					 </tr>
				   </thead>   
				  <tbody>
				<?php $i=1;foreach($state_wise_schools as $value){ ?>
					 <tr>
                        <td><?php echo $i; ?></td>
						<td style="width:15%"><?php echo $value['school_name']; ?></td>
						<td style="width:15%"><?php echo $value['school_address'].$value['address1']."<br>".$value['school_city']."-".$value['school_pincode']; ?></td>
						<td><?php echo $value['franchise_code']; ?></td>
						<td><?php echo $value['state_subdivision_name']; ?></td>
                        <td><?php echo $value['access_code']; ?></td>
						<td><span <?php if($value['school_status']=='Active') { ?> class="label label-success" <?php } ?> <?php if($value['school_status']=='Inactive') { ?> class="label label-info" <?php } ?>  ><?php echo $value['school_status'] ?></span>
						</td>
						<td class="center">
							<a class="btn btn-success" href="<?php echo SITE_URL?>school/view/id/<?php echo $value['school_id']; ?>" title="View">
									<i class="icon-zoom-in icon-white"></i> 
							</a> 
							<!--<a class="btn btn-info" href="<?php echo SITE_URL?>school/edit/id/<?php echo $value['school_id']; ?>" title="Edit">
									<i class="icon-edit icon-white"></i>  
							</a>
							<a class="delete btn btn-danger" href="<?php echo SITE_URL?>school/delete/id/<?php echo $value['school_id']; ?>" title="Delete">
									<i class="icon-trash icon-white"></i> 
							</a>-->
						 </td>
						</tr>
				<?php  $i=$i+1; } ?>	
					  </tbody>
				    </table> 
			<?php }?>
					</div><!--End DIV for class="box-content"--> 
				</div><!--/span-->
			</div><!--/row-->
		</form>

<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
		<script type="text/javascript">
       $("#stateID").change(function(){
        var data=new Object();
        data.state_id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getStateFranchise/",
            data:data,
            type: 'post',
            success:function(result)
			{
               // alert(result);
				 $("#fr_id").html(result);
        }});
    }); 
 </script>