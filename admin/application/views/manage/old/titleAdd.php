<?php include('header.php');   /*print_r($list); */?>


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
			   <h2><i class="icon-edit"></i><?php if($mode=='Add') { echo "Add Title"; } if($mode=='Edit') { echo "Edit Title"; }?></h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
           
		  <div class="box-content">
			   <form class="form-horizontal" method="POST">
					 <fieldset>
							<div class="page-header">
							     <h1><small>
</small></h1>
							</div>
							
<!--    #####################################################################	Select Service	###################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">Service </label>
                                        <div class="controls">
											<?php
                                            $options = array();
                                            $options['']='Select Service';
                                               foreach($services as $val):
                                                 $options[$val['service_id']]=$val['service_name'];
                                               endforeach;
                                                
                                              echo form_dropdown('service_id', $options,$list[0]['service_id']);
                                            ?>
                                            <span class="help-inline">
                                            <?php  echo form_error('service_id'); ?></span>
                                        
                                            
                                       </div>
							</div>
<!--    #####################################################################	Heading/Title	###################-->					  
							<div class="control-group">
                            
                                 <label class="control-label" for="focusedInput">Title /Heading </label>
                                        <div class="controls">
                                             <?php
                                                $data = array(
                                                      'name'        => 'title',
                                                      'id'          => 'title',
                                                      'value'       => $list[0]['title']
                                                    );
                                                echo form_input($data);
                                             ?>
                                            <span class="help-inline"><?php  echo form_error('title'); ?></span>
                                       </div>
							</div>
<!--    ##################################################################### ############## ##################-->					  

							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
								<button class="btn">Cancel</button>
							  </div>
			</fieldset>
		</form>
	 </div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
