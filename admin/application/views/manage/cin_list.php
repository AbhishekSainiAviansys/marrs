<?php include('header.php');
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
<?php echo $this->notifications->display_html();?> 
<div>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php //echo SITE_URL?>content/">CIN</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php //echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
     <form method="POST" action='<?php echo base_url()?>manage/franchise/delete_all'>
          <input type="hidden" name="comp_id" value="<?php echo $comp_id;?>">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> CIN</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					<div class="box-header well" data-original-title>
						<h4><?php echo $schedule->center_address; ?></h4>
						<div class="box-icon"><h4>	<?php echo $schedule->product_name; ?></h4>
						
						</div>
					</div>
					
					
					
					<div style='margin-left:20px;margin-bottom:20px;'>
					    
					    
					<div class="box-content" style="margin:10px">
       
						<table  id="example" class="table table-striped table-bordered" style="width:100%;">
						    
						  <thead>
						      
						        <tr class="bg-light border-0">
						            <td><button name='Delete' class='btn btn-primary' id='del'>Delete Selected</button></td>
						            <td><a href="<?php echo base_url('manage/franchise/export_cin/'.$comp_id); ?>"class="btn btn-success btn-sm">Export</a></td>
                                </tr>
                              
							    <tr>
							       
							      <th><input type='checkbox' id='checkAll'>Select All</th>
								  <th>SL No.</th>
								  <th>Student Name</th>
								  <th>CIN</th>
								   <th>Product Name</th>
								  <th>Franchise ID</th>
                                  <th>Area code</th>
                                 
                                  <th>Class</th>
                                   <th>Categoery</th>
                                  <!--<th>School</th>-->
                                  <th>Delete</th>
							    </tr>
						  </thead>   
						  <tbody>
						     
							
							<?php $i=1;foreach( $cin_list as $value ) { //print_r($value);die;
							?>
							<tr>
							    <td><input type="checkbox" id="" name="cins[]" value="<?php echo $value['cin']; ?>"></td>
                                <td><?php echo $i; ?></td>
								
                                    <td><?php echo $value['student_name']; ?></td>
                                    <td><?php echo $value['cin']; ?></td>
                                    <td><?php echo $value['product_name']; ?></td>
								    <td><?php echo $value['franchise_id']; ?></td>
                                    <td><?php echo $value['franchise_code']; ?></td>
                                    <td><?php echo $value['class']; ?></td>
                                  <td >
								<?php echo $value['category_id']; ?>
								</td>
								
								<!--<td class="center">-->
								
									<!--<a class="btn btn-info" href="" title="Edit">-->
									<!--	Edit                              -->
									<!--</a>-->
								<!--</td>-->
								
								<td class="center">
								    
								    <a class="btn btn-info"  href="<?php echo base_url();?>manage/franchise/editcin/<?php echo $value['cin'].'/'.$schedule->competition_schedule_id;?>" title="Edit">
										Edit                              
									</a>
									
									<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletecin/<?php echo $value['cin'].'/'.$schedule->competition_schedule_id;?>" title="Delete">
										Delete                              
									</a>
									
								</td>
								
							</tr>
						<?php $i++; } ?>	
						  </tbody>
					  </table> 
					 
					</div>
					</div>
					
					
				</div><!--/span-->
			
			</div><!--/row-->
			
			
			
</form>
</div>

<script>new DataTable('#example');</script>
<script>
$("#del").click(function(){
  setTimeout(function(){
      location.reload(true);
  }, 5000);
});

    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});


$("#del").click(function(){
    if(confirm("Are you sure you want to delete this?")){
        $("#del").attr("href", "query.php?ACTION=delete&ID='1'");
         setTimeout(function(){
      location.reload(true);
   }, 5000);
  
    }
    else{
        return false;
    }
});

</script>

  <?php 
  //echo 'footer';
  include('footer.php');
?>