
<td>School<br />
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


  