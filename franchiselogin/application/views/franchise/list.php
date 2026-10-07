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
<td>Competition Level:<br />
 <?php
        $options=array(""=>"Select");
		foreach($level as $levelval):
		{
            $names=$levelval['competition_level_name'];
            $id=$levelval['competition_level_id'];
				$options[$id] = $names;
	   }
	   endforeach;
		echo form_dropdown('competition_level_id', $options,isset( $competition_level_id )?$competition_level_id: '');
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
								  echo form_dropdown('franchise_id', $options,isset( $franchise_id )?$franchise_id: '');
								?>
</td>
                   
                
<td>CIN:<br />
           <input class="input-large focused" id="cin" name="cin" type="text" style="width: 170px; padding: 4px" value="<?php if( isset( $cin ) )echo $cin; ?>"  > 
</td>
                   
