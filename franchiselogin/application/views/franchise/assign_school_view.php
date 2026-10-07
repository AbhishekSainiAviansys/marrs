	<?php 
    if(count($school_list) == 0)
    {
         echo "empty";
     }/*End of if*/ 
     else 
     { ?>

<form id="school_list_form" method="post">
        <table class="table table-bordered" style="font-size:12px;">
         <?php if($aim == "update"){ ?><caption style="color:#B43104"> To remove the schedule,Please uncheck the checkbox of corresponding schools & press<b> the Update </b> button</caption> <?php }?> 
                                  <thead style="background-color: #C0C0C0;">
                                    <tr>
                                      <th>SI.No</th>
                                          <th>
                                            <label class="checkbox inline">
                                            <input type="checkbox" id="chkSchool_all" value="option1" class="listCheckBoxAll" 
                                                   <?php if($aim == "update"){ ?> checked="checked" <?php }?> > 
                                            </label>
                                            </th>
                                          <th>School Name</th>
                                          <th>School Address</th>
                                          <th>School Code</th>
                                      </tr>
                                  </thead>   
                                  <tbody>
                                  <?php 
                                  $index=1;  
                                  foreach($school_list as $value)
                                  { ?>
                                    <tr>
                                        <td><?php  echo $index; ?></td>                        
                                        <td>
                                            <label class="checkbox inline">
                                            <input name="schoolID[]"  type="checkbox" class="chkSchools" 
                                                   value="<?php echo $value['school_id']; ?>" 
                                                   <?php if($aim == "update"){ ?> checked="checked" <?php }?>/>
                                            </label> 
                                        </td>
                                        <td><?php echo $value['school_name']; ?></td>
                                        <td><?php echo $value['school_address'].$value['school_address1']; ?></td>
                                        <td class="center"><?php echo $value['school_code']; ?></td>
                                    </tr>
                                    
                                <?php $index+=1; } ?>	
                              </tbody>
         </table>
   </form>
   <?php }/* End of else*/ ?>
