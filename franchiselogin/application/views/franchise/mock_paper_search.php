<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	    // print_r($result);
	 
 if(!empty($this->session->flashdata('updated'))){?>
<div style="background: green;
    padding: 10px;">
    <h3 style='color:#fff;'><?php echo $this->session->flashdata('updated'); ?></h3>
</div>
<?php
}
?>
<style>
    div#example_filter {
    float: right;
    position: relative;
    right: 0px;
}
div#example_length {
    position: absolute;
    padding-left: 20px;
}
    
</style>
  
 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<div class="row-fluid sortable">
	<div class="box span12">
	<!-------------->          
		  <div class="box-header well" data-original-title>
			   <h2><i class="icon-edit"></i>Upload Mock Paper </h2>
    			   <div class="box-icon">
						<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				   </div>
		  </div>
	<!-------------->          
	<div class="box-content">
	
		 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" width='100%'>
				<tr>
				    	<!--<td>Period:<br />-->
						<!--<h3><b>School : </b></h3>-->
                                <!--<select name="period" id="period" style="width: 220px;"  >-->
                                <!--    <option style='display:none;'>Select period</option>-->
                                    
                                     <?php
                                     
                                    //  $query = $this->db->query("SELECT * FROM `period`;");
                                    
                                    //  foreach ($query->result() as $row)
                                    // {
                                    // echo "<option value='{$row->period_id}'>{$row->period_id} - {$row->period_name}</option>";
                                    // }
                                    
                                    ?>
                                <!--</select>-->
					<!--</td>-->
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product_id" id="product" style="width: 220px;"  required>
                                    <option value=''>-- Select Product --</option>
                                <?php
                                    foreach ($productload as $row)
                                    { ?>
                                    
                                    <option value='<?php echo $row['product_id']; ?>' <?php if(isset($result['product_id']) && $result['product_id']==$row['product_id']){ ?> selected=selected <?php } ?> ><?php echo $row['product_name']; ?></option>
                                    
                                    <?php    
                                        
                                     }
                                    
                                    ?>
                                </select>
					 </td>

				
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="clevel" id="level" style="width: 220px;"  required>
                                    <option style='display:none;'>Select level</option>
                                    
                                    <?php
                                    foreach ($levelload as $row)
                                    { ?>
                                    
                                    <option value='<?php echo $row['level_id']; ?>' <?php if(isset($result['clevel']) && $result['clevel']==$row['level_id']){ ?> selected=selected <?php } ?> ><?php echo $row['level_name']; ?></option>
                                    
                                    <?php    
                                        
                                     }
                                    
                                    ?>
                                </select>
                                
                                
					 <td>Class <br>
				        <select name="class" id="class" style="width: 220px;"  >
				            <option value='' <?php if(isset($result['class']) && $result['class']==''){ ?>selected=selected<?php } ?> >All Class</option>
				            <option value='Nursery' <?php if(isset($result['class']) && $result['class']=='Nursery'){ ?>selected=selected<?php } ?>>Nursery</option>
				            <option value='LKG' <?php if(isset($result['class']) && $result['class']=='LKG'){ ?>selected=selected<?php } ?>>LKG</option>
                            <option value='UKG' <?php if(isset($result['class']) && $result['class']=='UKG'){ ?>selected=selected<?php } ?>>UKG</option>
                            <option value='Class-1' <?php if(isset($result['class']) && $result['class']=='Class-1'){ ?>selected=selected<?php } ?>>Class-1</option>
                            <option value='Class-2' <?php if(isset($result['class']) && $result['class']=='Class-2'){ ?>selected=selected<?php } ?>>Class-2</option>      
                            <option value='Class-3' <?php if(isset($result['class']) && $result['class']=='Class-3'){ ?>selected=selected<?php } ?>>Class-3</option>
                            <option value='Class-4' <?php if(isset($result['class']) && $result['class']=='Class-4'){ ?>selected=selected<?php } ?>>Class-4</option>
                            <option value='Class-5' <?php if(isset($result['class']) && $result['class']=='Class-5'){ ?>selected=selected<?php } ?>>Class-5</option>
                            <option value='Class-6' <?php if(isset($result['class']) && $result['class']=='Class-6'){ ?>selected=selected<?php } ?>>Class-6</option>
                            <option value='Class-7' <?php if(isset($result['class']) && $result['class']=='Class-7'){ ?>selected=selected<?php } ?>>Class-7</option>
                            <option value='Class-8' <?php if(isset($result['class']) && $result['class']=='Class-8'){ ?>selected=selected<?php } ?>>Class-8</option>
                            <option value='Class-9' <?php if(isset($result['class']) && $result['class']=='Class-9'){ ?>selected=selected<?php } ?>>Class-9</option>
                            <option value='Class-10' <?php if(isset($result['class']) && $result['class']=='Class-10'){ ?>selected=selected<?php } ?>>Class-10</option>
                            <option value='Class-11' <?php if(isset($result['class']) && $result['class']=='Class-11'){ ?>selected=selected<?php } ?>>Class-11</option>
                            <option value='Class-12' <?php if(isset($result['class']) && $result['class']=='Class-12'){ ?>selected=selected<?php } ?>>Class-12</option>
                        </select>
                    </td>
			
				</tr> 
				<br>
				<tr>
				    <td id='subjectdiv'><br>
				        Subject :<br>
				        <select name='subject' id='subject' style="width: 200px;" >
				            <option >-- select subject --</option>
				            <?php foreach($subjects as $subject){ ?>
				            
				            <option value="<?php echo $subject->subject_key; ?>"><?php echo $subject->subject_key; ?></option>
				            <?php } ?>
				        </select>
				    </td>
				    
				    <td id='varientdiv'><br>
				        Varient :<br>
				        <select name='varient' id='varient' style="width: 200px;" >
				            
				        </select>
				    </td>
				    
				    <td id='seriesdiv'><br>
				        Series :<br>
				        <select name='series' id='series' style="width: 200px;" >
				            
				        </select>
				    </td>
				    
				    <td>
				        <input type="submit" name="submit" value="search" class='btn btn-primary' />
				    </td>
			            
				</tr>
			
				<tr>
				    
				    
				</tr>
				<tr>
				    
			            <!--<input type="submit" name="ok" value="" />-->
				</tr>
		   </table>		 
		 
		    <br />
			<!--------------> 				
			<div id="csvResult_uploadLog_div">	
			<div style='text-align:center;'><h4>
        			<?php if(!empty($this->session->flashdata('success'))){
        			    echo $this->session->flashdata('success');
        			}?>
			</h4></div>
				 <?php  if(!empty($list_materials)): ?>
				 <TABLE border="1" width="100%" cellpadding="10px" >
								<!--<CAPTION align="left" valign="TOP"><input type="submit" name="submit" value="Export" /> </CAPTION>-->
							 <tr> <td colspan="11"  style="color:#00F; font-weight:bold; font-size:14px;" align="center">Showing Searched Mock Papers.</td></tr>
							 <tr>
								<th>SI no</th> <th>Product Name</th> <th>PERIOD</th> 
								<th>LEVEL</th> 	<th>Class / Tpe / Module</th><th>Maker/Price</th>
								<th>Upload File 1</th>	<th>Upload File 2</th>	<th>Upload File 3</th>	<th>Upload File 4</th> 
								<th>Status</th><th>Action</th>
							 </tr>
							<?php    
							  $i=0;  
							  //print_r($list_materials);die;
							  foreach($list_materials as $details){ 
							     //print_r($details);die;
//array($prid,$period_id,$result,$product_id,$clevel,"Error : QUIT( is NOT a Qualifier to the next level)".$next_competition_level_name);	
?>
							 <tr>
									<td align="CENTER"> <?php  echo $i=$i+1;      ?> </td> 
									<td align="CENTER"> <?php  echo $details['product_name'];  ?> </td>
									<td align="CENTER"> <?php   
									$query = $this->db->query("SELECT academic_year FROM period where period_id='{$details['period_id']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['academic_year'];
									?> </td>
									<td align="CENTER">
									    <?php 
									     $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where product_name='{$details['product_name']}' and  level_id='{$details['clevel']}' ");
									    $result=$query->row_array();
									   // print_r($result);
									    echo $result['level_name'].'<br><b>'; 
									    
									    if($details['product_name'] == 'Lunar Skill Test'){
                    	                    echo 'Subject: '.$details['subject'].'<br>';
                    	                    echo 'Series: '.$details['series'].'<br>';
                    	                    echo 'Variant: '.$details['sub_type'].'<b>';
                	                    }
									    
									    ?>
									</td>
									<td align="CENTER"> <?php  echo $details['class']; 
									    echo '<br>Module: <b>'.$details['type'].'</b>'; 
									            echo '<br>Status: <b>'.$details['pay_status'].'</b>'; 
									
									?> </td>
									
									<td align="CENTER"> <?php 
    									if(!empty($details['mock_paper_maker_id'])){
    									    $query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$details['mock_paper_maker_id']}' ");
    									    $result=$query->row_array();
    									   // print_r($result);
    									    echo $result['name'];
    									}else{
    									    echo 'Not Assigned to any maker.';  
    									}
									
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['folder1'];  
									if(!empty($details['folder1'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder1'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder2'];  
									if(!empty($details['folder2'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder2'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									
									<td align="CENTER"> <?php  echo $details['folder3'];
									if(!empty($details['folder3'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder3'];?>' class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['folder4'];
									if(!empty($details['folder4'])){?>
									    <a href='https://marrs.in/mock_papers/<?php echo $details['folder4'];?>'class="btn btn-outline-warning" target='blank' >View</a>
									    
									    <?php
									}
									?> </td>
									<td align="CENTER"> <?php  echo $details['status']; ?> </td>
									<td align="CENTER">
                                        <button 
                                            name="delete" 
                                            value="<?php echo $details['paper_id']; ?>" 
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this mock paper?');"
                                        >
                                            Delete
                                        </button>
                                    </td>

							 </tr>
							<?php  } ?>
				</TABLE>
				<?php endif;/* End of if*/ ?>
			</div>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->


<script>

$(document).ready(function() {
    
    $('#subjectdiv').hide();
    $('#varientdiv').hide();
    $('#seriesdiv').hide();

    $("#product").change(function() {
        var product_id = this.value;

        if (product_id === '8') {  // Compare as string
            $('#subjectdiv').show();
            $('#varientdiv').show();
            $('#seriesdiv').show();
        } else {
            $('#subjectdiv').hide();
            $('#varientdiv').hide();
            $('#seriesdiv').hide();
        }

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
            data: { product_id: product_id },
            type: 'POST',
            success: function(result) {
                $("#level").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#subject").change(function() {
        var subject_key = this.value;

        

        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_subject_key",
            data: { subject_key: subject_key },
            type: 'POST',
            success: function(result) {
                $("#varient").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    $("#varient").change(function() {
        var varient = this.value;
        var subject_key = $('#subject').val();
        var period = 15;


        $.ajax({
            url: "https://marrs.in/franchiselogin/manage/ajax/getlunar_series",
            data: { subject_key: subject_key,varient:varient,period:period },
            type: 'POST',
            success: function(result) {
                $("#series").html(result);
            },
            error: function() {
                alert("An error occurred while fetching data.");
            }
        });
    });
    
    
    
    
});


</script>


<script>
    $("#product").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/franchiselogin/";
$.ajax({
url:"https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
data:{product_id:product_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#level").html(result);
	 

}});
});
    
    
</script>


<?php include('footer.php'); ?>