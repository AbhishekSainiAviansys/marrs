<?php
$tabIndex=0; 
$students_list=$returned_list[1];
$round_list=$returned_list[0];				
/*echo "<pre>";echo "<br>";	print_r($returned_list);*/
	if(!empty($students_list))
	{
			$i=1;
			foreach($students_list as $val => $key ):
            $total_mark=0;
					$comp_id=$key['competition_schedule_id'];
					$stud_id=$key['student_id'];
					if($i%2 == 0)
					{  $trStyle='style="background:#E6E6FA;"'; }
					else
					{   $trStyle='style="background:#E6E6FA;"'; }
					?>
					   
					<tr <?php echo $trStyle; ?> >
						<td align="center"><?php echo $i;  ?></td>
						<td><?php echo $key['first_name']." ".$key['middle_name']." ".$key['last_name'];  ?></td>
						<td align="center"><?php echo $key['categoryKey']; ?></td>			
                        <td align="center"><?php echo $key['cin']; ?></td>
						<?php
							for($j=0;$j<count($round_list);$j++):
							  $competition_round_id=$round_list[$j]['competition_round_id'];
							  if( count($key['mark'])!= count($round_list) &&  count($key['mark'])!= 0 ) 
								{
						 			for($k=0;$k<count($key['mark']);$k++):
										if( $key["mark"][$k]["comp_round_id"] == $competition_round_id)
										{ 
												$value= $key["mark"][$k]["mark"];
												$total_mark=$total_mark+$value;
												$txt_color="background-color:#D1DFF4;font-size:14px;font-weight:bold;;color:#606"; 
												$k=count($key['mark']);
										}
										else 
										{ 
                                               $value='';
											   $txt_color="background-color:#FFFFFF;font-size:14px;font-weight:normal;;color:#000"; 
										} 
							      endfor;											
							 }/*End if*/
							 else
							 {  
								$value=$key["mark"][$j]["mark"];
								$total_mark=$total_mark+$value;
								if($key["mark"][$j]["mark"] == '')
									$txt_color="background-color:#FFFFFF;font-size:14px;font-weight:bold;;color:#000"; 
								else 
									$txt_color="background-color:#D1DFF4;font-size:14px;font-weight:bold;;color:#606"; 
							 }/*End else*/
					?>							  
					<td align="center"> 
                               <input type="text"  class="txtround_mark_class" maxlength="4"  tabindex="<?php echo ++$tabIndex;  ?>" 
                                      id="<?php echo  "students[".$stud_id."][".$comp_id."][".$competition_round_id."]"; ?>"
                                      name="<?php echo  "students[".$stud_id."][".$comp_id."][".$competition_round_id."]"; ?>"
                                      value="<?php echo $value;  ?>" style="width:50px; height:25px; <?php echo $txt_color; ?>" > 							  
                    </td>
					<?php endfor; ?>
                    <td><input type="text" class="txt_total" style="width:55px; height:25px;font-size:14px;font-weight:bold;color:#606; text-align:center; alignment-adjust:central" readonly="readonly"
                                    name="<?php echo  "total[".$stud_id."][".$comp_id."]"; ?>" value="<?php if($total_mark !=0) echo $total_mark; ?>"></td>		
					<td><?php echo $key['school_name']; ?></td>	
                    	
				  </tr>
			<?php	$i++;	endforeach;    }/*End if*/  ?>