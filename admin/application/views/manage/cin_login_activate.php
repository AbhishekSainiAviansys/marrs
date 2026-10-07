<?php include('header.php');
///print_r($active);

if($active[0]['clevel']==1){
    $cl='School Level';
}
if($active[0]['clevel']==2){
    $cl='Interschool Level';
}
if($active[0]['clevel']==3){
    $cl='State Level';
}
if($active[0]['clevel']==4){
    $cl='National Level';
}
if($active[0]['clevel']==5){
    $cl='International Level';
}

if($active[0]['period_id']==11){
    $period='2021-22';
}
if($active[0]['period_id']==12){
    $period='2022-23';
}
if($active[0]['period_id']==13){
    $period='2023-24';
}

/*
echo $this->encrypt->encode('anitta', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('deepa', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('hima', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('chinju', ENC_KEY) ;echo "<br>";
echo $this->encrypt->encode('reshma', ENC_KEY) ;echo "<br>";echo "<br>";
echo $this->encrypt->encode('ashima', ENC_KEY) ;echo "<br>";
*/
 ?>
 
 <head>
  <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
  <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
 </head>
 
			<div class="container-fluid mx-3">
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>student/"></a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php //echo ($studentID>0)?'Edit':'Add';?></a>
					</li>
				</ul>
			</div>
						<?php echo $this->notifications->display_html();?> 
						<?php //print_r($result); ?>
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Activate add price <?php //echo ($studentID>0)?'Edit':'Add';?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
                        
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
    							 <div class="page-header" >
    							  <h1><small><input type="button" name="answer" value="Activate Product " onclick="showDiv()" /></small></h1>
    							 </div>
						
						         <div class='row-fluid sortable'>
						    
						            <div id="welcomeDiv"  style="display:none;" class="answer_list" > 
                                        <h3><small>Select Product</small></h3>
                                            <select name="product_name" id="product_name" required onchange="getval(this);">
        								        <option>select product</option>
        								        <?php 
        								        $this->db->select('*');
        								        $this->db->from('products');
        								        $resc = $this->db->get();
        								       $coun = $resc->result_array();
        								        foreach($coun as $val){ ?>
        								            <option value="<?php echo $val['product_name'];?>"> <?php echo $val['product_name'];?> </option>
        								       
        								        <?php }?>
        								    </select>
        								    Enter Amount for competition
        								    <input type="text" name="product_price" id='product_price' placeholder='Product Price' />
        								    
                                    </div>
						       
						            <div id="period"  style="display:none;" class="answer_list" > 
                                        <div class="page-header" >
            							  <h3><small>Select Period</small></h3>
            							</div>
                                        
                                            <select name="period_id" id="period_id" required onchange="getval(this);">
        								        <option>select period</option>
        								        <?php 
        								        $this->db->select('*');
        								        $this->db->from('period');
        								        $resc = $this->db->get();
        								       $coun = $resc->result_array();
        								        foreach($coun as $val){ ?>
        								            <option value="<?php echo $val['period_id'];?>"> <?php echo $val['period_name'];?> </option>
        								       
        								        <?php }?>
        								    </select>
                                    </div>
						        
						            <div id="competition_levels"  style="display:none;" class="answer_list"> 
                                        <div class="page-header" >
            							  <h3><small>Select Competition Level</small></h3>
            							</div>
                                        
                                        <select name="clevel" id="competition_levels" required onchange="showDiv1()">
        								        <option>select competition level</option>
        								        <?php 
        								        $this->db->select('*');
        								        $this->db->from('competition_levels');
        								        $resc = $this->db->get();
        								       $coun = $resc->result_array();
        								        foreach($coun as $val){ ?>
        								            <option value="<?php echo $val['id'];?>"> <?php echo $val['level_key'];?> </option>
        								       
        								        <?php }?>
        								    </select>
        								    
                                 </div>
						            
						            <div id="inputss"  style="display:none;" > 
                                        <div class="page-header" >
                                            
                                            <input type="checkbox" value="checked" id="check1"> Study Material
            							    <input type="text" name="study_material" id='study_material' placeholder='Price' style='display:none' />
            							    <input type="checkbox" value="checked" id="check2"> Orientation
                                            <input type="text" name="orientation" id='orientation' placeholder='Price' style='display:none' />
                                            <input type="checkbox" value="checked" id="check3"> Revision
                                            <input type="text" name="rivision" id='rivision' placeholder='Price' style='display:none' />
                                            <input type="checkbox" value="checked" id="check4"> Mock Test
                                            <input type="text" name="mock_test" id='mock_test' placeholder='Price' style='display:none' />
            							</div>
                                        <button type="submit" class="btn btn-primary" id="Search" name="Search">Submit</button>
                                        
                                    </div>
						            
						 </div>
						        
						            
                                
							</fieldset>
							
							<fieldset>
							    
							    
							<div class="page-header">
							  <h1><small>Active Product Information</small></h1>
							  <h1><small>Please send result for level and product your are activating competition.</small></h1>
							</div>
							
						<!--// ==================== // 	-->
						<button type='submit' id='refresh'>Refresh to See List</button>
						
						
						
                            <div class="control-group">
                                <table class="table table-bordered">
            						  <thead>
            							  <tr>
            								  <th>Sr. Number</th>
            								  <th>Product Name</th>
            								  <th>Study Material</th>
            								  <th>Orientation</th>
            								  <th>Revision</th>
            								  <th>Mock Test</th>
            								  <th>Competition Level</th>
            								  <th>Period</th>
            								  <th>Deactiate</th>
            								  
            								  
            							  </tr>
            						  </thead>   
            						  <tbody>
            						  <?php 
            						  
            						  foreach($active as $row){ 
            							$i=1;
            						  ?>
            						  
            						  
                                            
            							<tr>
            							    
            							    <!--<input type="text" name="" value='Price' style='display:none' />-->
                                            <!--<input type="text" name='level' value="<?php echo $cl;?>" style='display:none'>-->
                                            <!--<input type="text" name="period" value='<?php echo $period;?>' style='display:none' />-->
            							    
            								<td><?php echo $i;?></td>
            								<td><?php echo $row['product'].' - '.$row['product_price'];?></td>
            								<td><?php echo $row['material_status'].' - '.$row['material_price'];?></td>
            								<td><?php echo $row['orientation_status'].' - '.$row['orientation_price'];?></td>
            								<td><?php echo $row['revision_status'].' - '.$row['revision_price'];?></td>
            								<td><?php echo $row['mock_test_status'].' - '.$row['mock_test_price'];?></td>
            								<td><?php echo $cl;?></td>
            								<td><?php echo $period;?></td>
            								
            								<td><button type="submit" name="deactiate" value='<?php echo $row['product']; ?>' class="btn btn-danger btn-sl " >Deactivate</button></td>
            							
            							</tr>
            							<?php 
            								$i=$i+1;
            							}
            							?>
            						</tbody>
            					</table>
							</div>
							
							
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			</div><!--/row-->
			
			

<?php include('footer.php'); ?>

<script type="text/javascript">
function getval(sel)
{document.getElementById('competition_levels').style.display = "block";
    document.getElementById('period').style.display = "block";
}


function showDiv() {
   document.getElementById('welcomeDiv').style.display = "block";
   
}

function showDiv1() {
   document.getElementById('inputss').style.display = "block";
   
}    
	

 $("#check1").click(function(){
 if($(this).is(":checked")) {
    //  alert($(this).val());
    document.getElementById('study_material').style.display = "block";    
   }
   if (!$(this).is(':checked')) {
      document.getElementById('study_material').style.display = "none";    
    }
});
$("#check2").click(function(){
 if($(this).is(":checked")) {
    //  alert($(this).val());
    document.getElementById('orientation').style.display = "block";    
   }if (!$(this).is(':checked')) {
      document.getElementById('orientation').style.display = "none";
    }
});
$("#check3").click(function(){
 if($(this).is(":checked")) {
    //  alert($(this).val());
    document.getElementById('rivision').style.display = "block";    
   }if (!$(this).is(':checked')) {
      document.getElementById('rivision').style.display = "none";
    }
});
$("#check4").click(function(){
 if($(this).is(":checked")) {
    //  alert($(this).val());
    document.getElementById('mock_test').style.display = "block";    
   }if (!$(this).is(':checked')) {
      document.getElementById('mock_test').style.display = "none";
    }
});

setTimeout(function(){
     $('#alert-success').slideUp('slow').fadeOut(function() {
         window.location.reload();
         /* or window.location = window.location.href; */
     });
}, 5000);
$("#refresh").click(function(){
     window.location.reload();
});


 </script>