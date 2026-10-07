<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html(); 
	 $fr_id = $this->session->userdata('franchise_id');
	 $frd = $this->db->get_where('franchise',array('franchise_id'=>$franchise_id))->row();
		$state_id= $frd->state_id;
		$country_id = $frd->country_id;
?> 
			
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV file </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" >
				<tr>
				
				<td>
			   			 Choose your CIN CSV file <span style='color:red;'>*</span> <br />  <input name="csv" type="file" id="csv" required  />
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit"  class='btn btn-primary' /> </td>
				</tr> 
				<tr>
				    <td>
				        Enter Only CINs in single column. File Should be CSV Format
				    </td>
				</tr>
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<?php if (!empty($csvResult_upload_logArray)) { ?>
					<div id="csvResult_uploadLog_div">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>CIN</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($csvResult_upload_logArray as $log) { ?>
									<tr>
										<td><?php echo $log[0]; ?></td>
										<td><?php echo $log[1]; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<div id="csvResult_uploadLog_div">
						<!-- No results to display -->
					</div>
				<?php } ?>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>

<script type="text/javascript">
$("#area_code").change(function(){
    var area_code =this.value;
     //alert(franchise_id);
    //  var BASE_URL="https://marrs.in/franchiselogin/";
    $.ajax({
        url:"<?php echo base_url();?>franchise/ajax/school_list",
        data:{area_code:area_code},
        type: 'post',
        success:function(result)
        {
        	//alert(result);
        	 $("#school").html(result);
        	 
        
        }
        
    });
});
</script>