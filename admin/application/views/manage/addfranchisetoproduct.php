<?php include('header.php'); //print_r($service);die;?>
    <div>
        <ul class="breadcrumb">
            <li><a>Product</a><span class="divider">/</span></li>
            <li><a>Add Franchise To Product</a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>
<div class="row-fluid sortable">
	<div class="box span12">
    
		<div class="box-header well" data-original-title>
			 <h2><i class="icon-edit"></i> Franchise To Product</h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
		</div>
	    <div class="box-content">
			<form class="form-horizontal" method="POST" action="" enctype= "multipart/form-data">
				  <fieldset>
                     <legend><span style="color:#F00; font-size:14px;">The fields maked '<b>*</b>' are  mandatory fiedls</span></legend>
						<div class="page-header">  <h1><small></small></h1></div>
                     
                      <!-----------------Product------------------->       
                           <div class="control-group">
								<label class="control-label" for="focusedInput">Product
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								     <select class="span2" name="productname" id="productname" >
									      <option value="" selected="selected">Select</option>
                                          <?php foreach($service as $servicelistval) {  ?>
									      <option value="<?php echo $servicelistval['service_id'] ?>"><?php echo $servicelistval['service_name'] ?></option>
								          <?php } ?>
                                     </select>
								</div>
						   </div>
                    <!-----------------Request Type------------------->       
						   <div class="control-group">
								   <label class="control-label" for="focusedInput">Franchise
                                   <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                   </label>
								    <div class="controls">
                                      <select class="span2" name="requesttype" id="requesttype" >
									       <option value="" selected="selected">Select</option>
                                          <?php foreach($franchise as $franchiselistval) {  ?>
									      <option value="<?php echo $franchiselistval['franchise_id'] ?>"><?php echo $franchiselistval['username'] ?></option>
								          <?php } ?>
                                     </select>
								   </div>
							 </div>
                   
                    <!-----------------Submit /Cancel button ------------------->       
                    
				   <div class="form-actions">
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit" >
								<button class="btn">Cancel</button>
				  </div>
               </fieldset>
	         </form>
	     </div><!-- END OF  class- box-content -->  
	 </div><!--END of class- box span12 DIV--> 
  </div><!--END OF class- row-fluid sortable" DIV-->


 <style>
 .help-inline{color:#F00;}
 </style>
 
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script type="text/javascript">
$(document).ready(function(e) {
	
$("#school_created_date").datepicker();	
$('#school_created_date').datepicker('setDate',new Date());
});
        $("#country_id").change(function(){
			var data=new Object();
			data.id=this.value;
			$.ajax({
						url:BASE_URL+"franchise/students/getstate/",
						data:data,
						type: 'post',
						success:function(result)
						        {			 $("#stateID").html(result);	 }/*End of success*/
			      });/*END of ajax */
        });/* End of country_id change function*/
 </script>
<?php include('footer.php'); ?>