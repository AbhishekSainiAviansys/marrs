<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
	 
	     
	 
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
			   <h2><i class="icon-edit"></i>Upload study material </h2>
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
				    <td>Period ID<br>
        				<select name='period_id' style="width: 220px;" required>
    						<?php //$period = $this->db->get_where('period')->result(); 
    						foreach($loadperiod as $val){ ;?>
    				           <option value='<?php echo $val['period_id'];?>' <?php  if($val['period_id']==$result['period_id']) { echo 'selected="selected"'; } ?>><?php echo $val['period_name'];?></option>
    						<?php }?>
        				</select>
        			</td>
        				    
        				    
					<td>Product:<br />
                        <select name="product" id="product" style="width: 220px;"  required>
                            <option value=''>-- Select Product --</option>
                                
                             <?php
                             
                            // $query = $this->db->query("SELECT * FROM products;");
                            foreach ($load_product as $row)
                            { ?>
                             <option value='<?php echo $row['product_name'];?>'<?php  if($result['product']==$row['product_name']) { echo 'selected="selected"'; } ?>><?php echo $row['product_name'];?></option>
                            <?php  } ?>
                        </select>
                    </td>
                                        
        				    
				    <td>Level <br>
				        <select name='level' id='competition_level_id' style="width: 220px;" >
				            <?php if(isset($result)){ ?>
				            <option value=''>-- All level --</option>
				            <?php }else{ ?>
				             <option >-- Select level --</option>
                            <?php } ?>
                            
						<?php //$level = $this->db->get_where('competition_levels')->result(); 
						foreach($load_level as $val){ ;?>
				           <option value='<?php echo $val['level_id'];?>' <?php  if($val['level_id']==$result['level']) { echo 'selected="selected"'; } ?>><?php echo $val['level_name'];?> </option>
						<?php } ?>
				        </select>
				    </td>   
				
					<td>Class <br>
				        <select name="class" id="class" style="width: 220px;"  >
				            <option value='All'>All Class</option>
				            <option value='PlaySchool' <?php if(isset($result['class']) && $result['class']=='PlaySchool'){ echo 'selected="selected"'; }  ?>>Play School</option>

				            <option value='Nursery' <?php if(isset($result['class']) && $result['class']=='Nursery'){ echo 'selected="selected"'; }  ?> >Nursery</option>
				            <option value='LKG' <?php if(isset($result['class']) && $result['class']=='LKG'){ echo 'selected="selected"'; }  ?> >LKG</option>
                            <option value='UKG' <?php if(isset($result['class']) && $result['class']=='UKG'){ echo 'selected="selected"'; }  ?> >UKG</option>
                            <option value='Class-1' <?php if(isset($result['class']) && $result['class']=='Class-1'){ echo 'selected="selected"'; }  ?> >Class-1</option>
                            <option value='Class-2' <?php if(isset($result['class']) && $result['class']=='Class-2'){ echo 'selected="selected"'; }  ?> >Class-2</option>      
                            <option value='Class-3' <?php if(isset($result['class']) && $result['class']=='Class-3'){ echo 'selected="selected"'; }  ?> >Class-3</option>
                            <option value='Class-4' <?php if(isset($result['class']) && $result['class']=='Class-4'){ echo 'selected="selected"'; }  ?> >Class-4</option>
                            <option value='Class-5' <?php if(isset($result['class']) && $result['class']=='Class-5'){ echo 'selected="selected"'; }  ?> >Class-5</option>
                            <option value='Class-6' <?php if(isset($result['class']) && $result['class']=='Class-6'){ echo 'selected="selected"'; }  ?> >Class-6</option>
                            <option value='Class-7' <?php if(isset($result['class']) && $result['class']=='Class-7'){ echo 'selected="selected"'; }  ?> >Class-7</option>
                            <option value='Class-8' <?php if(isset($result['class']) && $result['class']=='Class-8'){ echo 'selected="selected"'; }  ?> >Class-8</option>
                            <option value='Class-9' <?php if(isset($result['class']) && $result['class']=='Class-9'){ echo 'selected="selected"'; }  ?> >Class-9</option>
                            <option value='Class-10' <?php if(isset($result['class']) && $result['class']=='Class-10'){ echo 'selected="selected"'; }  ?> >Class-10</option>
                            <option value='Class-11' <?php if(isset($result['class']) && $result['class']=='Class-11'){ echo 'selected="selected"'; }  ?> >Class-11</option>
                            <option value='Class-12' <?php if(isset($result['class']) && $result['class']=='Class-12'){ echo 'selected="selected"'; }  ?> >Class-12</option>
                        </select>
                    </td>
			
    			    <td>Type<br>
        			    <select name='type' id='' style="width: 220px;">
        			        <option value='' <?php if(isset($result['type']) && $result['type']==''){ echo 'selected="selected"'; }  ?> >All Types</option>
        			        <option value='A' <?php if(isset($result['type']) && $result['type']=='A'){ echo 'selected="selected"'; }  ?> >A</option>
        			        <option value='B' <?php if(isset($result['type']) && $result['type']=='B'){ echo 'selected="selected"'; }  ?> >B</option>
        			        <option value='C' <?php if(isset($result['type']) && $result['type']=='C'){ echo 'selected="selected"'; }  ?> >C</option>
        			        <option value='D' <?php if(isset($result['type']) && $result['type']=='D'){ echo 'selected="selected"'; }  ?> >D</option>
        			        <option value='E' <?php if(isset($result['type']) && $result['type']=='E'){ echo 'selected="selected"'; }  ?> >E</option>
        			        <option value='F' <?php if(isset($result['type']) && $result['type']=='F'){ echo 'selected="selected"'; }  ?> >F</option>
        			        
        			    </select>
        			</td>
        			
				</tr> 
		
		   </table>		 
		 
		    <br />
			<!--------------> 				
				<tr>
				    
			            <input type="submit" name="search" value="search" class='btn btn-primary' />
				</tr>
	<!-------------->
	</form> 
  </div>	
 </div><!--/span-->
 
 <?php if(!empty($list_materials)){ ?>
 
 <div class="row-fluid sortable">
   
 <form method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Study Material List</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
						
					</div>
					<div class="box-content" style="margin:10px">
                  <!--<tr><button name='Delete' class='btn btn-primary' id='del'>Delete Selected</button></tr>-->
					<table  id="example" class="table table-striped table-bordered" style="width:100%;"
	       <thead><tr>
	           <!--<th><input type='checkbox' id='checkAll'>Select All</th>-->
	            <th>Sr. No.</th>
	            <th> Product </th>
	            <th> Type </th>
	            <th> Level </th>
	            <th> Period </th>
	            <th> Class </th>
	            <th>Maker</th>
	            <th> Title </th>
	            <th> Status </th>
	            <th> Price </th>
	            <th>View</th>
	            <th> Download </th>
	             <!--<th> Option</th>-->
	        </tr>
	          </thead>   
				<tbody>
	        <?php 
	            //print_r($list_materials);
	           
	            $i=1;
	            foreach($list_materials as $row){ 
	               // print_r($row);die;
	            ?>
	           
	            <tr>
	                <!--<td><input type="checkbox" id="" name="ids[]" value="<?php echo $row['id']; ?>"></td>-->
	                <td><?php echo $i;?></td>
	                <td><?php echo $row['product_name']; ?></td>
	                <td><?php echo $row['type']; ?></td>
	                <td><?php echo $row['level_name']; ?></td>
	                <td><?php echo $row['academic_year']; ?></td>
	                <td><?php echo $row['class']; ?></td>
	                
	                <td><?php
	                    if(!empty($details['maker_id'])){
							$query = $this->db->query("SELECT name FROM material_maker where material_maker_id='{$row['maker_id']}' ");
							    $result=$query->row_array();
							   // print_r($result);
							    echo $result['name'];
						}else{
						    echo 'Not Assigned to any maker.';  
						}
						?>
	                </td>
	                
	                <td><?php echo $row['title']; ?></td>
	                 <td><?php echo $row['status']; ?></td>
	                <td><?php 
	                    if(!empty($row['price'])){
	                        echo $row['price'];
	                    }else{
	                        echo '0';
	                    }
	                    
	                ?></td>
	                
	                <td>
	                    <?php  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }else if($row['status']=='Paid'){
	                     $filepath="https://marrs.in/study_material_paid/".$row['folder'];} ?>
	                <a target='blank' href="<?php echo $filepath; ?>" >View</a>
	                    
	                </td>
	                  <td>
	                  <?php  
	                  if($row['status']=='Free'){
	                      $filepath="https://marrs.in/study_material_free/".$row['folder'];
	                  }
	                  else 
	                  
	                    if($row['status']=='Paid'){
	                        $filepath="https://marrs.in/study_material_paid/".$row['folder'];
	                    } ?>
	                    
	                    <a download="<?php echo $row['folder'];?>.pdf" href="<?php echo $filepath; ?>">Download</a></td>
	                
					  
	            </tr>
	           <?php 
	           $i++; } ?>
	       
	    </tbody>
	    </table>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>

  
</div>
 
<?php  }else{  ?>

<h3>Data Not Found...</h3>
	        <?php } ?>
</div><!--/row-->

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>public/library/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#product").change(function() {
        var product_id = this.value;
        var BASE_URL = "<?php echo base_url();?>";
        
        $.ajax({
            url: "<?php echo base_url(); ?>franchise/ajax/productwiselevel_/",
            data: {product_id: product_id},
            type: 'post',
            success: function(result) {
                $("#competition_level_id").html(result);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>


<?php include('footer.php'); ?>