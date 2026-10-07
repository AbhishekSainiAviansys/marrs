<?php include('header.php');

?>
<div>
  <ul class="breadcrumb">
	  <li><a href="<?php echo SITE_URL?>registration/">View</a> <span class="divider">/</span></li>
  </ul>
</div><!--End of class="breadcrumb" DIV-->
<?php echo $this->notifications->display_html();?> 
 <div class="row-fluid sortable">
  <div class="box span12">
      <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i>Registration Deatails</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div><!--End of class="box-icon" DIV-->
       </div><!--End of class="box-header well" DIV-->
    <div class="box-content">
		 <form class="form-horizontal" method="POST" enctype= "multipart/form-data">
		 <fieldset>
                <div class="page-header"><h1><small><?php if($mode=='View'){?>Registration View<?php } if($mode=='Edit'){?>Registration Edit<?php } ?> </small></h1></div><!--End of class="page-header" DIV-->
                
<!-- __________________ START DIV FOR SHOW DATA ___________________ -->   
                <div class="control-group">
                      <label class="control-label" for="focusedInput"> CIN </label>
                      <div class="controls"><strong><?php echo $registration_details['cin']; ?></strong></div> <!--<!--END OF  class="controls" DIV -->
                </div><!--END OF class="control-group" DIV --> 
                   
                <div class="control-group">
                     <label class="control-label" for="focusedInput"> Name </label>
                     <div class="controls">
                          <strong><?php echo $registration_details['first_name'].$registration_details['middle_name'].$registration_details['last_name']; ?></strong>     
                      </div> <!--END OF div class="controls" -->
                </div><!--END OF DIV class="control-group"" -->
                
                <div class="control-group">
                     <label class="control-label" for="focusedInput"> Competition Level </label>
                     <div class="controls"><strong><?php echo $registration_details['competition_level_key']; ?></strong></div> <!--<!--END OF div class="controls" -->
                </div><!--END OF DIV class="control-group"" -->
      <?php if(isset($registration_details['permenent_registration_number']) ||($registration_details['temperory_registration_number'] ))
	  {?>										
                   <div class="control-group">
                        <label class="control-label" for="focusedInput">Permanent Registration Number </label>
                        <div class="controls"><strong> <?php echo $registration_details['permenent_registration_number']; ?></strong></div> <!--END OF div class="controls" -->
                   </div><!--END OF DIV class="control-group"" -->
                   <div class="control-group">
                        <label class="control-label" for="focusedInput">Temporary Registration Number </label>
                        <div class="controls"><strong><?php echo $registration_details['temperory_registration_number']; ?></strong></div><!--END OF div class="controls" -->
                   </div><!--<!--END OF DIV class="control-group"" -->
         <?php }?>
                   <div class="control-group">
                       <label class="control-label" for="focusedInput">Competition Center</label>
                        <div class="controls"><strong><?php echo $registration_details['center_name']; ?></strong></div><!--END OF div class="controls" -->
                   </div><!--END OF DIV class="control-group"" -->
                   
                   <div class="control-group">
                        <label class="control-label" for="focusedInput">Competition Date</label>
                        <div class="controls"><strong><?php echo $registration_details['competition_date']; ?></strong></div><!--END OF div class="controls" -->
                   </div><!--<!--END OF DIV class="control-group"" -->
                   
                   <div class="control-group">
                         <label class="control-label" for="focusedInput">Reporting Time</label>
                         <div class="controls"><strong><?php echo $registration_details['reporting_time']; ?></strong></div><!--END OF div class="controls" -->
                   </div><!--<!--END OF DIV class="control-group"" -->
                   
         <?php if(isset($registration_details['receipt_number']) && ($registration_details['branch_name'])&& ($registration_details['receipt_date'] ))
		  {?>
                <div class="control-group">
                      <label class="control-label" for="focusedInput">Reciept Number</label>
                      <div class="controls"> 
                          <?php if($mode=='Edit')
                               { $data = array(
                                                'name'        => 'receipt_number',
                                                 'id'          => 'receipt_number',
                                                 'value'       => $registration_details['receipt_number']
                                                );
                                 echo form_input($data);
                               } else {?> <strong><?php echo $registration_details['receipt_number']; ?></strong> <?php } ?>    
                          </div> <!--<!--END OF div class="controls" -->
                  </div><!--<!--END OF DIV class="control-group"" -->
                  <div class="control-group">
                        <label class="control-label" for="focusedInput">Branch Name</label>
                        <div class="controls">
                            <?php if($mode=='Edit')
								{  $data = array(
                                                'name'        => 'branch_name',
                                                'id'          => 'branch_name',
                                                'value'       => $registration_details['branch_name']
                                              );
                                   echo form_input($data);
                                 } else {?> <strong><?php echo $registration_details['branch_name']; ?></strong> <?php } ?>    
                          </div> <!--<!--END OF div class="controls" -->
                   </div><!--<!--END OF DIV class="control-group"" -->
                   <div class="control-group">
                         <label class="control-label" for="focusedInput">Reciept Date</label>
                         <div class="controls">
                              <?php if($mode=='Edit')
                                   { $data = array(
                                                   'name'        => 'receipt_date',
                                                    'id'          => 'receipt_date',
                                                    'value'       => $registration_details['receipt_date']
                                                 );
                                      echo form_input($data);
                                    } else {?><strong><?php echo $registration_details['receipt_date']; ?></strong> <?php } ?>   
                           </div> <!--<!--END OF div class="controls" -->
                  </div><!--<!--END OF DIV class="control-group"" -->
             <?php } /* END OF IF(isset($registration_details['receipt_number']) && */   
              if($mode=='Edit'){?>
                     <div class="form-actions">
                          <button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
                          <button class="btn">Cancel</button>
                     </div>
              <?php }?>
		</fieldset>
	  </form>
	</div> <!--<!--END OF DIv class="box-content" -->
</div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>
