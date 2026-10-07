<?php include('header.php');

?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<style>
select {
    width: 300px;
    border: 1px solid #bbb;
    /* padding: 10px; */
}

select, input[type="file"] {
    height: 40px;
    *: ;
    margin-top: 4px; 
}
select.span4 {
    position: relative;
    top: -16px;
    left: 303px;
}
input.chk {
    margin-left: 20px;
    margin-top:10px;
}  
.form-horizontal .controls {
   
    margin-left: 150px;
  
}
input[type="text"] {
    width: 80%;
	    height: 30px;
}
.section-divider {
    border-top: 2px solid #ddd;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
    margin-left: 20px;
    margin-right: 20px;
}
span.info {
    display: inline-block;
    position: relative;
    padding: 1px 30px 2px 30px;
    top: -11px;
    font-size: 18px;
    color: #4B4B4B;
    background-color: #fff;
}
    
  .multipleSelection {
      width: 240px;
      background-color: #eaeaea;
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      font-weight: bold;
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    #checkBoxes {
      display: none;
      border: 1px #8DF5E4 solid;
    }

    #checkBoxes label {
      display: block;
    }

    #checkBoxes label:hover {
      background-color: #4F615E;
    }
</style>
    <div>
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>franchise/">Area</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>franchise/Addarea">Addarea</a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="row-fluid sortable">
    
	<div class="box span12">
    
		<div class="box-header well" data-original-title>
			 <h2><i class="icon-edit"></i> Area Code <?php echo ($studentID>0)?'Edit':'Add';?></h2>
					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
					</div>
		</div>
	    <div class="box-content">
	       
			       <?php echo form_open_multipart('manage/franchise/genrateAreaCode');?>
				    
					<div class="section-divider"> <span class="info">Addarea Code</span></div>
							 <!-----------------Country-------------------> 
							 <div class="col-lg-12" style="padding: 40px;
    margin: 20px;">
							     
							       <div class="span4">
								<label class="control-label" for="focusedInput">Country
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								    
								    <select name="country_id" id="country_id" required>
								        
								        <?php 
								        $this->db->select('*');
								        $this->db->from('countries');
								        $resc = $this->db->get();
								       $coun = $resc->result_array();
								        foreach($coun as $val){ ?>
								      <option value="<?php echo $val['country_id'];?>" <?php  if( isset( $val['country_code_char2'] ) ) if($val['country_code_char2']=='IN') {  ?> selected="selected" <?php } ?>><?php echo $val['country_name'];?></option>
								       
								        <?php }?>
								    </select>
								   
								</div>
						   </div>
							    
							 
				             
                         <div class="span4">
								<label class="control-label" for="focusedInput">State ID
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="form-controls">  
								    
								    <select name="state_id" id="state_id" required>
								          <?php 
								        $this->db->select('*');
								        $this->db->from('states');
								        $this->db->where('country_id','105');
								        $resc = $this->db->get();
								       $coun = $resc->result_array();
								        foreach($coun as $val){ ?>
								      <option value="<?php echo $val['state_subdivision_id'];?>" <?php  if( isset( $val['state_subdivision_id'] ) ) if($val['state_subdivision_id']==$state_id) {  ?> selected="selected" <?php } ?>><?php echo $val['state_subdivision_name'];?></option>
								        <?php }?>
								        
								    </select>  
								  
								</div>
						   </div>
							 

                         <div class="span4">
								<label class="control-label" for="focusedInput">District
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="form-controls">
								   <select name="district_id" id="district_id" required>
								       
								 </select>
								    
								</div>
						   </div>
						</div>    							 
							 
				    
					
					 <div class="col-lg-12" style="padding: 40px;
    margin: 20px;">
							     
							       <div class="span4" style="margin-top:50px">
								<label class="control-label" for="focusedInput">Add Area 
                                <span style="color:#F00; font-size:15px;"><b>*</b></span>
                                </label>
								<div class="controls">
								   <input type="text" name="area" placeholder="Enter Area" required >
								</div>
						   </div>
							    
							 
				             
                         
						
						</div> 
				   
				  
				   
				   
                    <!-----------------Submit /Cancel button ------------------->       
                    <div class="span12" style="margin-left: 120px;
    padding: 24px;margin-top: 30px;"> 
				   
								<input type="submit" class="btn btn-primary" id="submit" value="submit" name="submit" >
								<button class="btn">Cancel</button>
				  
				  
				  </div>  
              
	       <?php  echo form_close();?>
			 
			 
			 
			 
	     </div><!-- END OF  class- box-content -->  
	 </div><!--END of class- box span12 DIV--> 
  </div><!--END OF class- row-fluid sortable" DIV-->

 <script type="text/javascript">
$("#state_id").change(function(){
var state_id =this.value;
 //alert(state_id);
 var BASE_URL="https://marrs.in/franchiselogin/"; 
$.ajax({
url:"https://marrs.in/franchiselogin/manage/ajax/districtlist",
data:{state_id:state_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#district_id").html(result);
}});
});
</script>
 
<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>

<?php include('footer.php'); ?>
  <!-- Modal -->
 