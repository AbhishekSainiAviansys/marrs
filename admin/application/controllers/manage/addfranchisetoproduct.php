<?php include('header.php'); //print_r($productlist);die;?>
    <div>
        <ul class="breadcrumb">
            <li><a>Product</a><span class="divider">/</span></li>
            <li><a>Upload Request File</a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>
<div class="row-fluid sortable">
	<div class="box span12">
    
		<div class="box-header well" data-original-title>
			 <h2><i class="icon-edit"></i> Upload Request File</h2>
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
						<div class="page-header">  <h1><small>Basic Information</small></h1></div>
                     
                      <!-----------------Product------------------->       
                           <div class="control-group">
								<label class="control-label" for="focusedInput">Product
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								     <select class="span2" name="productname" id="productname" >
									      <option value="" selected="selected">Select</option>
                                          <?php foreach($productlist as $productlistval) {  ?>
									      <option value="<?php echo $productlistval['service_name'] ?>"><?php echo $productlistval['service_name'] ?></option>
								          <?php } ?>
                                     </select>
								</div>
						   </div>
                    <!-----------------Request Type------------------->       
						   <div class="control-group">
								   <label class="control-label" for="focusedInput">Request Type
                                   <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                   </label>
								    <div class="controls">
                                      <select class="span2" name="requesttype" id="requesttype" >
									      <option value="" selected="selected">Select</option>
									      <option value="CIN">CIN</option>
                                          <option value="Result">Result</option>
                                     </select>
								   </div>
							 </div>
                   
                    <!-----------------FR Code------------------->       
                     
                           <div class="control-group">
							    <label class="control-label" for="focusedInput">FR Code
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								       <div class="controls">
								            <input class="input-xlarge focused" id="frcode" name="frcode" type="text" value="<?php echo $franchisefrcode[0]['franchise_code'] ?>" readonly>
								       </div>
						   </div>
                   
                   
                    <!-----------------Upload File------------------->       
                            
						 <div class="control-group">
								  <label class="control-label" for="focusedInput">File(in xlsx)
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								       <input type= "file" name="photo" size="20" id="photo"/>
                                       <?php  $this->validation->show_error('photo',"Choose  File.") ?>
								  </div>
						  </div>
                          
                     <!-----------------File Name------------------->       
                            
						 <div class="control-group">
								  <label class="control-label" for="focusedInput">File Name
                                  <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                  </label>
								  <div class="controls">
								       <input class="input-xlarge focused" id="file_name" name="file_name" type="text" value="" >
								  </div>
						  </div>
                          
                          
                    <!-----------------Remarks------------------->       
                            
						 <div class="control-group">
								  <label class="control-label" for="focusedInput">Remarks
                                  <span style="color:#F00; font-size:15px;"><b></b></span>
                                  </label>
								  <div class="controls">
                                       <textarea rows='10' cols='12' class="input-xlarge focused" name="remarks" id="remarks"></textarea>
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