<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span>
					</li>
					<li>
						<?php if($type=='request'){?>
							<a href="<?php echo SITE_URL?>student/requests/">Requests List</a>
						<?php }else{?>
							<a href="<?php echo SITE_URL?>student/">List</a>
						<?php }?>

					</li>
				</ul>
			</div>
			
		<form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> School <?php if($type=='request'){?> Requests<?php }?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<div class="control-group">
						<div class="controls">
				
						 
			     	Country
							<?php
							$js = 'id="country_id"';
								$options=array(""=>"Select");
							foreach($countries as $countriesval) {
                        $name=$countriesval['country_name'];
                          $id=$countriesval['country_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('country_id', $options, isset( $country_id )?$country_id: '',$js);
						
								?>
									State
							<?php
							$js = 'id="stateID"';
							
								$options=array(""=>"Select");
							foreach($stateatload as $stateval) {
                        $name=$stateval['state_subdivision_name'];
                          $id=$stateval['state_subdivision_id'];
							
								
								$options[$id] = $name;
	}
							
								echo form_dropdown('stateID', $options, isset( $stateID )?$stateID: '',$js);
						
								?>
								  School:<input class="input-large focused" id="school_name" name="school_name" type="text" style="width: 170px; padding: 4px" value="<?php if( isset( $school_name ) )echo $school_name; ?>"  > 
								 
							<button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
								<!--<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>school/'">Reset</button>-->
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
								  <th>
									<label class="checkbox inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1" class="listCheckBoxAll"> 
									</label>
									</th>
								  <th>School Name</th>
								  <th>school Code</th>
								   <th>School Phone</th>
								  <th>School Email</th>
                         </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($list as $value){ ?>
							<tr>
								<td>
									<label class="checkbox inline">
                                    <input name="schoolID[]"  type="checkbox" class="listCheckBoxEach commonLeftCheck" value="<?php echo $value['school_id'] ?>"/>
									</label>
								</td>
								   <td class="center"><?php echo $value['school_name']; ?></td>
									<td class="center"><?php echo $value['school_code']; ?></td>
									<td class="center"><?php echo $value['school_phone']; ?></td>
									<td class="center"><?php echo $value['school_email']; ?></td>
                       								
							   </td>
							</tr>
						<?php } ?>	
					  </tbody>
                     
					  </table> 
					
					  <button type="submit" class="btn btn-primary" id="submit" name="submit" >Submit</button>
			<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
		
		
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
	<script type="text/javascript">
       $(document).ready(function(){

	   $("#country_id").change(function(){
      
        var data=new Object();
        data.id=this.value;
        $.ajax({
            url:"<?php echo base_url();?>franchise/students/getstate/",
            data:data,
            type: 'post',
            success:function(result){
                 $("#stateID").html(result);
        }});
    }); 
	 });
	
 </script>
