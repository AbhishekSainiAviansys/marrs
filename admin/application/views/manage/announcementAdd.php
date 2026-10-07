<?php 
	include('header.php');
	/*print_r($result);*/
	echo $this->notifications->display_html();
?>
	
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Add Announcements</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
                    
<div class="box-content">
   <form class="form-horizontal" method="POST">
   
   
	  <fieldset>
       <div class="control-group">
			<label class="control-label" for="focusedInput"><span class="help-inline">*</span>Content</label>
			<div class="controls">
              <textarea class="cleditor"  id="content" name="content" required="required"  >
                    <?php if( isset( $result['content'])){ echo $result['content']; } ?>
              </textarea>
            <span class="help-inline"> <?php  $this->validation->show_error('content',"Please enter the Content.") ?> </span>									
		   </div>
       </div> 
 <!-- ==============================================================================================================================--> 
       <div class="control-group">
         <label class="control-label" for="focusedInput"><span class="help-inline">*</span>Status</label>
           <div class="controls">
			<select  id="status" name="status" style="width:500px;" >
            <option value="">--Select--</option>
       <option value="Active" <?php if( isset( $result['status'] ) ) if($result['status']=='Active') {  ?> selected="selected" <?php } ?>>Active</option>
       <option value="Inactive" <?php if( isset( $result['status'] ) ) if($result['status']=='Inactive') {  ?> selected="selected" <?php } ?>>Inactive</option>
           </select>
           <span class="help-inline"><?php  $this->validation->show_error('status',"Please select Status.") ?></span>
		</div> <!-- DIV FOR class="controls" -->
       </div> 
 <!-- ==============================================================================================================================--> 
       <div class="control-group">
                 <div class="controls">
<!--                  <button type="submit" value="Submit" id="announce_submit" name="announce_submit">Submit</button> -->
                      <button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
				
</div> <!-- DIV FOR class="controls" -->
       </div> 
 <!-- ==============================================================================================================================--> 
      <span class="help-inline">*Mandatory field </span>
      
      </fieldset>
      
    </form>
   </div>
  </div><!--/span-->
</div><!--/row-->

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript"></script> 
<?php include('footer.php'); ?>
