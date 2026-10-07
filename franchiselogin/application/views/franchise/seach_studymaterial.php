<?php
	 include('header.php'); 
	 /*$this->session->userdata('session_csvResult_upoload_logArray')*/;
	 
//print_r($search);die;
	     
	 
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
			<table  cellpadding="5px" >
				<tr>
					<td>Product:<br />
						 <!--<h3><b>School : </b></h3>-->
                                <select name="product_id" id="product" style="width: 180px;"  required>
                                    <option style='display:none;'>Select product</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY product_name");
                                    
                                     foreach ($query->result() as $row)
                                    { ?>
                                    <option value='<?php echo $row->product_id;?>' <?php if($row->product_id==$_POST['product_id']){ echo 'selected="selected"'; } ?>><?php echo $row->product_name;?></option>
                                  <?php   }
                                    
                                    ?>
                                </select>
					 </td>

					<td>Period:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="period" id="period" style="width: 180px;"  required>
                                    <option style='display:none;'>Select period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `period`;");
                                    
                                     foreach ($query->result() as $row)
                                    { ?>
                                  <option value='<?php echo $row->period_id;?>' <?php if($row->period_id==$_POST['period']){ echo 'selected="selected"'; } ?>><?php echo $row->period_id.' - '.$row->period_name;?></option>";
                                  <?php  }
                                    
                                    ?>
                                </select>
					</td>
					
					<td>Competition Level:<br />
						<!--<h3><b>School : </b></h3>-->
                                <select name="clevel" id="level" style="width: 180px;"  required>
                            
                                    
                                </select>
					</td>
					
			
				</tr> 
				<tr>
				  
			            <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
			          
				</tr>
		   </table>		 
		 
	</form> 
  </div>	
 </div><!--/span-->
</div><!--/row-->
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
                  
				
						<table id="example" class="table table-striped table-bordered dt-responsive" style="width:98%;margin-left:10px">
						  <thead>
							  <tr>
								  <th>Sr. No.</th>
                	            <th> Product </th>
                	            <th> Period </th>
                	            <th> Level </th>
                	            <th> Class </th>
                	            
                	            <th> Status </th>
                	            <th> Price </th>
                	           
                	             <th> Option</th>
							  </tr>
						  </thead>   
						  <tbody>
							
							<?php $i=1;foreach( $list_materials as $value ) { ?>
							<tr>
                                <td><?php echo $i; ?></td>
								
                              <td><?php echo $value['product_name']; ?></td>
                                  <td><?php echo $value['period']; ?></td>
								    <td><?php echo $value['clevel']; ?></td>
                                    <td><?php echo $value['class']; ?></td>
                                  <td><?php echo $value['status']; ?></td>
                                  <td >
								<?php echo $value['price']; ?>
								</td>
								
								 <td >
								<a href="">Edit</a> | <a href="">Delete</a>
								</td>
							
								
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>

    
</div>

<script>
    $("#product").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 //var BASE_URL="https://marrs.in/franchiselogin/";
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
<script>new DataTable('#example');</script>


<?php include('footer.php'); ?>