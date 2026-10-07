<?php include('header.php');?>
<?php echo $this->notifications->display_html();?> 
<div>
 <ul class="breadcrumb">
	<li><a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span></li>
	<li><a href="<?php echo SITE_URL?>content/">List</a></li>
 </ul>
</div>
<form method="POST">
 <div>		
	<div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Manage RouteMap</h2>
            <div class="box-icon">
               <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
               <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
	   <div class="box-content">
       <!--......................SEARCH CODE.......................................-->                    
           <div class="control-group">
                <div class="controls">
                        
                         <!--......................SERVICE.......................................-->                    
                           Period
						   <?php
                              $options=array(""=>"Select");
                              foreach($period as $periodval):
									$names=$periodval['period_name'];
									$id=$periodval['period_id'];
									$options[$id] = $names;
                              endforeach;
                              echo form_dropdown('period_id', $options,isset( $period_id )?$period_id: '');
                            ?>
                            
                          <!--......................FRANCHISE.......................................-->                    
                            Level  
						 <?php
                                $options=array(""=>"Select");
                                foreach($level as $levelval):
                                    $names=$levelval['competition_level_name'];
                                    $id=$levelval['competition_level_id'];
                                    $options[$id] = $names;
                               endforeach;
                               echo form_dropdown('competition_level_id', $options,isset( $competition_level_id )?$competition_level_id: '');
                        ?>
                             
                           <!--......................FRANCHISE.......................................-->                    
                             Franchise Code  
                             <?php
								 $options=array(""=>"Select");
							     foreach($franchise as $franchiseval):
                                      $names=$franchiseval['franchise_code'];
                                      $id=$franchiseval['franchise_id'];
								      $options[$id] = $names;
	                             endforeach;
								 echo form_dropdown('franchise_id', $options,isset( $franchise_id )?$franchise_id: '');
								?>
                                   
                          <!--......................FRANCHISE.......................................--> 
                           <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                           <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>franchise/'">Reset</button>
                 </div>
           </div>
                              
       <!--......................SEARCH CODE ED....................................-->                    
                              
           <?php if(empty($list)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
			<?php } else{ ?>
					<table class="table table-bordered" width="100%">
					  <thead>
					    <tr>
                            <th>Sno</th>
 							<th>Fanchisee</th>
							<th>Period</th>
                            <th>Level</th>
							<th>Description</th>
							<th>Path</th>
                            <th>Actions</th>
						</tr>
					 </thead>   
				     <tbody>
						<?php  $i=1;foreach( $list as $value ) { ?>
						<tr>
                            <td><?php echo $i; ?></td>
							<td><?php echo $value['franchise_code']; ?></td>
                            <td><?php echo $value['period_name']; ?></td>
                            <td><?php echo $value['competition_level_name']; ?></td>
                            <td><?php echo $value['description']; ?></td>
                            <td><?php echo $value['file_path']; ?></td>        
                            <td class="center">
							<a class="btn btn-info" href="<?php echo SITE_URL?>downloads/routemap_edit/id/<?php echo $value['routemap_id']; ?>" title="Edit">
								<i class="icon-edit icon-white"></i>  
								</a>
								<a class="btn btn-danger" href="<?php echo SITE_URL?><?php echo $value['routemap_id']; ?>"title="Delete">
								<i class="icon-trash icon-white"></i> 
								</a>
							</td>
						</tr> 
						<?php  $i=$i+1;} ?>	
					</tbody>
			   </table> 
		<?php } ?>
	</div>
</div><!--/span-->
</div><!--/row-->
			
</form>
		
<?php include('footer.php'); ?>
