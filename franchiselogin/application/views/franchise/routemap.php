<?php include('header.php'); ?>
<!--<div>
  <ul class="breadcrumb">
	<li><a href="#">Routemap</a> <span class="divider">/</span></li>
	<li><a href="#"</a></li>
  </ul>
</div>
--><?php echo $this->notifications->display_html();?> 

<div class="row-fluid sortable">

     <div class="box span12">
     
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php if($mode=='Add'){echo 'Add';} else {echo 'Edit';}?>Routemap</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <fieldset>
                        <div class="page-header"><h1><small><?php if($mode=='Add'){echo 'Add';} else {echo 'Edit';}?> Routemap</small></h1></div>
                        
                      <!--********************  DIV FOR PERIOD ******************** -->
                         <div class="control-group">
                                <label class="control-label" for="focusedInput">Period</label>
                                <div class="controls">
                                    <select class="span2" name="period_id" id="period_id">
                                    <option value="">Select</option>
                                    <?php foreach($period as $periodval) { ?>
                                    <option value="<?php echo $periodval['period_id'] ?>"<?php if( isset( $result[0]['period_id'] ) ) if($result[0]['period_id']==$periodval['period_id']){ ?> selected="selected"<?php } ?> ><?php echo $periodval['period_name'] ?></option>
                                    
                                    <?php } ?>
                                    </select>
                                    <span class="help-inline"><?php  $this->validation->show_error('period_id',"Please enter the Period.") ?></span>
                                </div>
                         </div>
                         
                          <!--********************  DIV FOR COMPETITON LEVEL ******************** -->
                         <div class="control-group">
                              <label class="control-label" for="focusedInput">Level</label>
                              <div class="controls">
                                  <select class="span2" name="competition_level_id" id="competition_level_id">
                                  <option value="">Select</option>
                                  <?php foreach($level as $val) { ?>
                                  <option value="<?php echo $val['competition_level_id'] ?>"
                                  <?php if(isset($result[0]['competition_level_id']))
								  if($result[0]['competition_level_id'] == $val['competition_level_id']) {  ?> selected="selected" <?php } ?> ><?php echo $val['competition_level_name'] ?></option>
                                  <?php } ?>
                                  </select>
                                  <span class="help-inline">
								  <?php $this->validation->show_error('competition_level_id',"Please enter the competition level.") ?></span>
                             </div>
                         </div>
                         
                         
                         
                         <!--********************  DIV FOR FRANCHISE ******************** -->
                         
                         <div class="control-group">
							  <label class="control-label" for="focusedInput">Franchise</label>
							  <div class="controls">
                                  <select class="span2" name="franchise_id" id="franchise_id">
                                  <option value="">Select</option>
                                   <?php foreach($franchise as $franchiseval) { ?>
                                  <option value="<?php echo $franchiseval['franchise_id'] ?>" 
                                   <?php if( isset( $result[0]['franchise_id'] ) )
                                   if($result[0]['franchise_id'] == $franchiseval['franchise_id']) {  ?> selected="selected" <?php } ?> >
                                    <?php echo $franchiseval['franchise_code'] ?></option><?php } ?>
                                   </select>
                                   <span class="help-inline"><?php  $this->validation->show_error('franchise_id',"Please enter the franchise.") ?></span>
						      </div>
					     </div>
                         
                          <!--********************  DIV FOR DESCRIPTION ******************** -->
                         <div class="control-group">
							  <label class="control-label" for="event"> Description</label>
							  <div class="controls">
                                  <input class="input-xlarge focused" id="description" name="description" type="text" 
                                  value="<?php if( isset( $result[0]['description'] ) )echo $result[0]['description']; ?>" >
                                  <span class="help-inline">
                                  <?php  $this->validation->show_error('description',"Please enter the communication address.") ?></span>
						      </div>
					    </div>
                        
      <!--    ######################## Upload File	#########################-->					  
                    <div class="control-group">
                      <label class="control-label">Add Material</label>
                      <div class="controls">
                          <div class="uploader" id="uniform-undefined">
                              <input type="file" name="file_path"  id="file_path" size="19" style="opacity: 0;">
                              <span class="filename">No file selected</span><span class="action">Choose Image</span>
                          </div>
                          <span class="help-inline"><?php  $this->validation->show_error('file_path',"please browse routemap.") ?></span>
                      </div>
                    </div>                            
                      
        <!--********************  DIV FOR SUBMIT BUTTON ******************** -->
                     <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="submit_routemap" name="submit_routemap" >Save changes</button>
                        <button class="btn">Cancel</button>
                    </div>

                </fieldset>
            </form>
        </div>
        
     </div><!--/span-->
 
</div><!--/row-->
<?php include('footer.php'); ?>

