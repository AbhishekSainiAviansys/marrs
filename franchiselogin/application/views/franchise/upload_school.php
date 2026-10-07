<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 echo $this->notifications->display_html();      
?> 
	<style>
	    .row-fluid [class*="span"] {
    display: block;
    width: 100%;
    min-height: 28px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    box-sizing: border-box;
    float: left;
    margin-left: -0.127659574%;
    /*margin-left: 2.0744680846382977%;*/
}
	</style>		
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload CSV School file </h2>
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
				        Area*<br>
				        <select name='area_code'>
				            <option>select area</option>
				            <?php 
				            foreach($areaload as $val){?>
				                <option value="<?php echo $val['area_code'];?>" <?php if(isset($result['area_code']) && $val['area_code'] == $result['area_code']) { echo "selected"; } ?>><?php echo $val['city_name'];?></option>

				            <?php }
				            ?>
				        </select>
				    </td>
				<td>
			   			 Choose your School CSV file  <br />  <input name="csv" type="file" id="csv" /> 
			   </td>
			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
				</tr> 
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">				 
				 <?php  if(!empty($csvResult_upoload_logArray)): ?>
				 <TABLE border="1" width="80%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="5"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">SCHOOL UPLOAD-ERROR LOG</td></tr>
							 <tr>
								<th>SI no</th> 
								<th>School Name</th>
								<th>School Addess</th> 
								<th>Upload Report</th> 
							 </tr>
							<?php    
							  $i=0;  
							  foreach($csvResult_upoload_logArray as $details): 
/*array($period_id,$state_id,$school_id,$state_id,$class_id,$category_id,$next_competition_level_name,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);*/							?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details[0];  ?> </td>
									<td align="CENTER"> <?php  echo $details[1];  ?> </td>
									<td align="CENTER"> <?php  echo $details[2];  ?> </td>
									
							 </tr>
							<?php  endforeach; ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->
<?php include('footer.php'); ?>