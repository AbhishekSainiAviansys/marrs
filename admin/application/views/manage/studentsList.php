<?php include('header.php');
	//echo"====================". "<pre>";print_r($stud_list);
?>


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
<?php echo $this->notifications->display_html();?> 
		<form id="search_form" method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Students <?php if($type=='request'){?> Requests<?php }?></h2>
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
                                 <td>Period:<br />
                                    <?php
                                            $options=array(""=>"Select");
                                            foreach($period as $periodval):
                                             {
                                                 $names=$periodval['period_name'];
                                                 $id=$periodval['period_id'];
                                                 $options[$id] = $names;
												 $attributes =' id="period_id"   ';
                                            }
                                            endforeach;
                                            echo form_dropdown('period_id', $options,isset( $period_id )?$period_id: '',$attributes);
                                    ?>
                                 </td>
                             </tr>
                             <tr>
                             <td> Franchise:<br />
								<?php
                                         $options=array(""=>"Select");
                                         foreach($franchise as $franchiseval) :
                                              $fr_name=$franchiseval['franchise_code'];
                                              $id=$franchiseval['franchise_id'];
                                              $options[$id] = $fr_name;
                                         endforeach;
                                         $js = ' id="franchise_id" onChange="list_schooldetails(this.value)"';
                                         echo form_dropdown('franchise_id', $options, isset( $franchise_id )?$franchise_id: '',$js);
                                ?>
                             </td>
                             <td> School:<br />
								<select id="school_id" name="school_id">
								<?php if(isset($post_schools) && !empty($post_schools) ){?>
                                    <option value=""> --select school--</option>
                                         <?php foreach($post_schools as $result): ?>
                                    <option value="<?php echo $result['school_id'] ?>"
                                     <?php if($result['school_id'] == $school_id){?> selected="selected" <?php }  ?>> 
                                           <?php echo $result['school_name'] ?>
                                    </option>
                                 <?php endforeach;  }/*End of if*/?>
                               </select>
                           </td>
                          <td> cin:<br />
							  <input class="input-large focused" id="cin" name="cin" type="text" value="<?php if( isset( $cin ) )echo $cin; ?>"  > 
                          </td>      
                          <td> Name:<br />
						     <input class="input-large focused" id="stud_name" name="stud_name" type="text"   value="<?php if( isset( $stud_name ) )echo $stud_name; ?>"  >
                         </td>      
                     </tr> 
                  </table>
                        
                        
                        
                        
                       <!--    -----------  PERIOD ---------------    --> 
                        
                        <!--    -----------  FRANCHISE ---------------    -->            
							<br><br><center><button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
							<button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>students/'">Reset</button></center>
						</div>
						</div>
					<?php if(empty($stud_list)){?>
					
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
					</div>
					<?php
					}
					else{
					$i=1;
					?>
                      <div align="right"> 
                      <button type="submit" class="btn btn-primary" id="Export" name="Export"> Export Excel</button></div>
                      <!--onclick="get_csv();--->
						<table class="table table-bordered">
						  <thead>
							  <tr>
                                 <th>SNo</th>
								  <th>CIN</th>
								  <th>Name</th>
								  <th>Category</th>
                                  <th>Contact Info</th>
								  <th>School</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php foreach($stud_list as $value){ ?>
							<tr>
                            <td><?php echo $i; ?></td>
								<td style="width:10%"><?php echo $value['cin']; ?></td>
								<td><?php echo $value['first_name']." " .$value['middle_name']." ".$value['last_name']; ?></td>
								<td><?php echo $value['categoryKey']; ?></td>
                                <td style="width:15%">
                                  Email Id : <?php echo $value['father_email'].",".$value['mother_email']; ?>
                                  <br />
                                  Mobile Phone : <?php   echo $value['father_p_code']."-".$value['father_phone'].",".$value['mother_p_code']."-".$value['mother_phone']; ?>
                                  <br />
                                  Land Phone :   <?php   echo $value['std_code']."-".$value['phone']; ?>
                                </td>
                                
								<td  style="width:15%"><?php echo $value['school_name']."<br>".$value['school_address']; ?></td>
								
                                <td class="center">
                                 <a class="btn btn-success" href="<?php echo SITE_URL?>students/view/id/<?php echo $value['student_id']; ?>" title="View" target="_blank">
										<i class="icon-zoom-in icon-white"></i> 
								 </a>
									
								 <a class="btn btn-info" href="<?php echo SITE_URL?>students/edit/id/<?php echo $value['student_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>  
								 </a>
								
                                <a class="delete btn btn-danger" href="<?php echo SITE_URL?>students/delete/id/<?php echo $value['student_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i> 
								</a>
								</td>
							</tr>
						<?php $i=$i+1;} ?>	
					  </tbody>
					  </table> 
					
			<?php }?>
            <div id="error_div"></div>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
  <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			<script type="text/javascript">
/*		$(document).ready(function(e) {
            $("#Export").click(function(e) {
                alert($("#franchise_id").val());
            });
        });
			
*/			
			function list_schooldetails(id)
			{	
						/*alert("88888888888");*/
						var franchise_id=$("#franchise_id").val();
						var franchise_id=id;
						
						var data=new Object();
						data.franchise_id=franchise_id;
						$("#school_id").find('option').remove();
						$.ajax({
															
								url:BASE_URL+"manage/ajax/franchise_schoolDetails/",
								data:data,
								type: 'POST',
								success:function(result)
								{
									/*alert(result);							*/
									$("#school_id").append(result);
									/*$("#error_div").html(result);*/
									},/*end success*/																		
														
								error:function()
									{
										alert("Failed to load ajax ");	
									}/*end error*/																	
						
							});/*end ajax*/
	          }
			
			
			
			function get_csv()
			{
				
						var franchise_id=$("#franchise_id").val();
						var period_id=$("#period_id").val();
						var school_id=$("#school_id").val();
						var cin=$("#cin").val();
						var stud_name=$("#stud_name").val();
						
						var data=new Object();
						data.franchise_id=franchise_id;
						data.period_id=period_id;
						data.school_id=school_id;
						data.cin=cin;
						data.stud_name=stud_name;
						
						$.ajax({
							
							      url:BASE_URL+"manage/ajax/export_studentlist/",
								  data:data,
								  type: 'POST',
								  success:function(result)
								  {
									  	
									  
									  alert(result);					
									 // $("#school_id").append(result);
									  /*$("#error_div").html(result);*/
									  },/*end success*/																		
														  
								  error:function()
									  {
										  alert("Failed to load ajax ");	
									  }/*end error*/	
							
						      });
				        
			}
            </script>                           