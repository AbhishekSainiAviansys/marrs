<?php include('header.php');/*echo"<pre>"; print_r($list);exit;*/ ?>
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
              
<!--    -----------  FRANCHISE ---------------    -->            
                  Franchise
                    <?php
                         $options=array(""=>"Select");
                         foreach($franchise as $franchiseval) :
                              $name=$franchiseval['franchise_code'];
                              $id=$franchiseval['franchise_id'];
                              $options[$id] = $name;
                         endforeach;
                         echo form_dropdown('fr_id', $options, isset( $fr_id )?$fr_id: '');
                    ?>
                    
<!--    -----------  COUNTRY ---------------    -->            
				Country
				   <?php
						$js = 'id="country_id"';
						$options=array(""=>"Select");
						foreach($countries as $countriesval) :
                            $name=$countriesval['country_name'];
                            $id=$countriesval['country_id'];
							$options[$id] = $name;
	                    endforeach;
						echo form_dropdown('country_id', $options, isset( $country_id )?$country_id: '',$js);
				 ?>
                 
<!--    -----------  STATE ---------------    -->            
					  State
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
 
     <?php if(empty($list)){?>
			<div class="alert">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Information!</strong> No record(s) found.
			</div>
	<?php } else{?>
    
               <div align="right"><button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
				 <table class="table table-bordered">
				  <thead>
					 <tr>
						<th>School Name</th>
                        <th>City</th>
						<th>Franchisee Code</th>
						<th>School Code</th>
						<th>School Accesscode</th>
						<th>Status</th>
						<th>Actions</th>
					 </tr>
				   </thead>   
				  <tbody>
				<?php foreach($list as $value){ ?>
					 <tr>
						<td style="width:15%"><?php echo $value['school_name']."<br>".$value['school_address']; ?></td>
						<td style="width:15%"><?php echo $value['school_city']; ?></td>
						<td><?php echo $value['franchise_code']; ?></td>
						<td><?php echo $value['school_code']; ?></td>
                        <td><?php echo $value['access_code']; ?></td>
						<td><span <?php if($value['school_status']=='Active') { ?> class="label label-success" <?php } ?> <?php if($value['school_status']=='Inactive') { ?> class="label label-info" <?php } ?>  ><?php echo $value['school_status'] ?></span>
						</td>
						<td class="center">
							<a class="btn btn-success" href="<?php echo SITE_URL?>school/view/id/<?php echo $value['school_id']; ?>" title="View">
									<i class="icon-zoom-in icon-white"></i> 
							</a> 
							<a class="btn btn-info" href="<?php echo SITE_URL?>school/edit/id/<?php echo $value['school_id']; ?>" title="Edit">
									<i class="icon-edit icon-white"></i>  
							</a>
							<a class="delete btn btn-danger" href="<?php echo SITE_URL?>school/delete/id/<?php echo $value['school_id']; ?>" title="Delete">
									<i class="icon-trash icon-white"></i> 
							</a>
						 </td>
						</tr>
				<?php } ?>	
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
       $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
           url:BASE_URL+"manage/ajax/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
 </script>