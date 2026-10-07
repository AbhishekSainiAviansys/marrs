<td>Period:<br />
             
<?php
		$options=array(""=>"Select");
		foreach($period as $periodval):
		 {
             $names=$periodval['period_name'];
             $id=$periodval['period_id'];
				 $options[$id] = $names;
	    }
	    endforeach;
	     echo form_dropdown('period_id', $options,isset( $period_id )?$period_id: '');
?>
  </td>
<td>Franchise<br />
                             <?php
								$options=array(""=>"Select");
							     foreach($franchise as $franchiseval)
								  {
                                      $names=$franchiseval['franchise_code'];
                                      $id=$franchiseval['franchise_id'];
								              $options[$id] = $names;
	                       }
	                          $js = 'onChange="list_schooldetails(this.value)"';
								  echo form_dropdown('franchise_id', $options,isset( $franchise_id )?$franchise_id: '',$js);
								?>
</td>


<td id="school_td">School<br />
                             <?php
								$options=array(""=>"Select");
								
							     foreach($schools as $schoolseval)
								  {
                                      $names=$schoolseval['school_name'];
                                      $id=$schoolseval['school_id'];
								              $options[$id] = $names;
	                              }
								  echo form_dropdown('school_id', $options,isset( $school_id )?$school_id: '');
								?>
</td>


  <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
			<script type="text/javascript">
			
			function list_schooldetails(id)
			{	
			
						/*alert("88888888888");*/
						
						var franchise_id=$("#franchise_id").val();
						var franchise_id=id;
						
							var data=new Object();
							data.franchise_id=franchise_id;
							
							
							
							$.ajax({
															
								url:BASE_URL+"manage/assign_cin/list_schoolDetails/",
								data:data,
								type: 'POST',
								success:function(result){
									
									
									
									
									$("#school_td").html("");
									$("#school_td").html(result);
									
									},/*end success*/																		
														
								error:function()
									{
										alert("Failed to load ajax ");	
									}/*end error*/																	
						
							});/*end ajax*/
	          }
			
            </script>                           