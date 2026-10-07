<?php include('header.php');  /* print_r($list);*/ ?>

<script type="text/javascript">
$(document).ready(function() {
	

});
    function get_details(service_id) {
	  $("#display_div").html('');
		var data=new Object();
		data.service_id=service_id; 
		
		$.ajax({
			url:BASE_URL+"manage/downloads/listDetails",
			data:data,
			type: 'POST',
			success:function(result)
			{
				
				/*var str = result.split("-");
				var title=  str[0];
				var category = str[1];
				var levels = str[2];*/
				
				
				$("#display_div").html(result);
				
			},
			error:function(){
				alert("Failed to load ajax ");	
			}/*end error*/																	
		});/*end ajax*/
	}/*end functiomn*/
</script>
<div>
	<ul class="breadcrumb">
		<li>  <span class="divider">/</span> </li>
		<li> </li>
	</ul>
</div>
<?php echo $this->notifications->display_html();?> 
			
<div class="row-fluid sortable">
	 <div class="box span12">
     
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Add Title</h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
          
          
           
		  <div class="box-content">
			   <form class="form-horizontal" method="POST" enctype="multipart/form-data">
					 <fieldset>
							<div class="page-header">
							     <h1><small>
</small></h1>
							</div>
<!--    #####################################################################	Select Service  #####################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">Service </label>
                                        <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='Select Service';
                                               foreach($services as $val):
                                                 $options[$val['service_id']]=$val['service_name'];
                                               endforeach;
                                                $js = 'id="service_id" onChange="get_details(this.value);"';
                                              echo form_dropdown('service_id', $options,'',$js);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('service_id'); ?></span>
                                        
                                            <span class="help-inline"><?php  echo form_error('service_id'); ?></span>
                                       </div>
							</div>
<!--    #####################################################################	Select Title based on Service	###################-->	
<div id="display_div">
                      
</div>

 <!--  end of display div -->             
<!--    ##################################################################### Upload File	###################-->					  
<div class="control-group">
								<label class="control-label">Add Material</label>
								<div class="controls">
								  <div class="uploader" id="uniform-undefined">
                                      <input type="file" name="file_path"  id="file_path" size="19" style="opacity: 0;">
                                      <span class="filename">No file selected</span><span class="action">Choose Image</span>
                                  </div>
									<div><?php //if(isset($studentID) && $studentID != "a"){ ?>
                                    <img src="<?php // echo BASE_URL.$result['photo']; ?>" width="50" height="60"/><?php // } ?></div>
		 <span class="help-inline"><?php // $this->validation->show_error('photo',"Choose  photo.") ?></span>								
								</div>
							  </div>                            
<!--    ##################################################################### ############## ##################-->					  

							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit_upload" name="submit_upload" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
			</fieldset>
		</form>
	 </div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
