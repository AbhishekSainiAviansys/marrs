<?php include('header.php');   //echo $mode; ?>

<script type="text/javascript">
$(document).ready(function() {
	

});
  function get_details(service_id)
  {
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
					error:function(){ alert("Failed to load ajax "); }/*end error*/																	
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
                    <div class="page-header"><h1><small></small></h1></div>
                                
      <!--   #######################	CIN  #####################-->					  
        <div class="control-group">
                <label class="control-label" for="focusedInput">CIN</label>
                <div class="controls">
                <input class="input-xlarge focused" id="cin" name="cin" type="text" value="<?php if( isset( $result['cin'] ) )echo $result['cin']; ?>" >
                <span class="help-inline"><?php  $this->validation->show_error('cin',"Please enter the CIN.") ?></span>
                </div>
		</div>
      <!--   #######################	NAME  #####################-->	
      
        <div class="control-group">
                <label class="control-label" for="focusedInput">Student Name</label>
                <div class="controls">
                <input class="input-xlarge focused" id="name" name="name" type="text" value="<?php if( isset( $result['name'] ) )echo $result['name']; ?>" >
                <span class="help-inline"><?php  $this->validation->show_error('name',"Please enter the student Name.") ?></span>
                </div>
		</div>
      <!--    #### ####################	 SCHOOL NAME  ########-->	
        <div class="control-group">
                <label class="control-label" for="focusedInput">School Name</label>
                <div class="controls">
                <input class="input-xlarge focused" id="school" name="school" type="text" value="<?php if(isset($result['school']))echo $result['school']; ?>" >
                <span class="help-inline"><?php  $this->validation->show_error('school',"Please enter the School Name.") ?></span>
                </div>
		</div>
      <!--    #### ####################	 CATEGORY  ########-->	
        <div class="control-group">
			<label class="control-label" for="focusedInput">Category</label>
			<div class="controls">
			<input class="input-xlarge focused" id="category" name="category" type="text" 
            value="<?php if( isset( $result['category'] ) )echo $result['category']; ?>" >
			<span class="help-inline"><?php  $this->validation->show_error('category',"Please enter the category.") ?></span>
			</div>
		</div>
                 
      <!--    ######################## CONTACT NUMBER	#########################-->					  
        <div class="control-group">
			<label class="control-label" for="focusedInput">Contact Number</label>
			<div class="controls">
			<input class="input-xlarge focused" id="contact_no" name="contact_no" type="text" 
            value="<?php if( isset( $result['contact_no'] ) )echo $result['contact_no']; ?>" >
			<span class="help-inline"><?php  $this->validation->show_error('contact_no',"Please enter the First Name.") ?></span>
			</div>
		</div>
      <!--    ########################## EMAIL ID ##############-->
      
        <div class="control-group">
			<label class="control-label" for="focusedInput">Email Id</label>
			<div class="controls">
			<input class="input-xlarge focused" id="email_id" name="email_id" type="text" value="<?php if( isset( $result['email_id'] ) )echo $result['email_id']; ?>" >
			<span class="help-inline"><?php  $this->validation->show_error('email_id',"Please enter the First Name.") ?></span>
			</div>
		</div>
      <!--    ########################## CONTACT ADDRESS ##############-->
        <div class="control-group">
			<label class="control-label" for="focusedInput">Contact Address</label>
			<div class="controls">
			<input class="input-xlarge focused" id="contact_address" name="contact_address" type="text" value="<?php if( isset( $result['contact_address'] ) )echo $result['contact_address']; ?>" >
			<span class="help-inline"><?php  $this->validation->show_error('contact_address',"Please enter the Address.") ?></span>
			</div>
		</div>
      <!--    ##########################  STATE ##############-->
        <div class="control-group">
			<label class="control-label" for="focusedInput">State</label>
			<div class="controls">
			<input class="input-xlarge focused" id="state" name="state" type="text" value="<?php if( isset( $result['state'] ) )echo $result['state']; ?>" >
			<span class="help-inline"><?php  $this->validation->show_error('state',"Please enter the state.") ?></span>
			</div>
		</div>
        
      <!--    ######################## UPLOAD FILES	#########################-->					  
              <?php if($mode=='Add') { ?>     
                   
                    <div class="control-group">
                      <label class="control-label">Select Selfie</label>
                      <div class="controls">
                          <div class="uploader" id="uniform-undefined">
                              <input type="file" name="file_path"  id="file_path" size="19" style="opacity: 0;" >
                              <span class="filename">No file selected</span><span class="action">Choose Image</span>
                          </div>
                      </div>
                    </div> 
             <?php } ?>                           
      <!--    ######################## SUBMIT & CANCEL BUTTON	#########################-->					  
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="submit_selfie" name="submit_selfie" >Save changes</button>
                        <button class="btn">Cancel</button>
                   </div>
            </fieldset>
          </form>
        </div>
      </div><!--/class="box span12-->
</div><!--/class="row-fluid sortable-->
            
<?php include('footer.php'); ?>
