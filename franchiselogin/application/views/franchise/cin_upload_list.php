<?php include('header.php');

// print_r($cin_list);
?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo SITE_URL?>category_new/">Upload CIN</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
        </li>
    </ul>
</div>

<?php if(!empty($message)){?><h3 style='color:green;'><?php echo $message; ?> </h3><?php } ?>
<div class="row-fluid sortable">
    
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> CIN <?php echo ($blogID>0)?'Edit':'Upload';?></h2>
            
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div>
            <?php 
            $id=$this->uri->segment(4);
            $exam_center = $this->db->get_where('exam_centers', array('comp_id' => $id))->result(); 
            
            if($exam_center){?>
                    <div class='col-sm-12'>    
                        <h4 class='text-primary'>Assessment Schedule</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <!--<th>Sr No.</th>-->
                                        <th>Center Name</th>
                                        <th>Address</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    foreach($exam_center as $row){ //print_r($row); ?>
                                    <tr>
                                        <!--<td><?php echo $i; ?></td>-->
                                        <td><?php echo $row->center_name; ?></td>
                                        <td><?php echo $row->center_address; ?></td>
                                        <td><?php echo $row->exam_date; ?></td>
                                        <td><?php echo $row->exam_time; ?></td>
                                    </tr>
                                    <?php $i=$i+1;} ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div> 
                   
                <?php } ?>   
                   
        </div>
        
        
        
            <div class="container mt-4">
                <h4>Upload File</h4>
                 <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
            			<table  cellpadding="5px" >
            				<tr>
            				<td>
            			   			 Choose your result CSV file  <br />  <input name="csv" type="file" id="csv" /> 
            			   </td>
            			   <td> <br /><input type="submit" name="submit" value="Submit" /> </td>
            				</tr> 
            		   </table>	
                </form>

            </div>
            
            
            
        <div class="box-content">
            <?php //if(!empty($message) && isset($message)){ echo $message; } ?>
            <div class="container mt-4">
                <form method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)"> Select All <br><button type="submit" name="delete_selected" class="btn btn-danger mt-2" onclick="return confirmDelete();">Delete Selected</button></th>
                                    <th>Sr No</th>
                                    <th>CIN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($cin_list as $row) { ?>
                                <tr>
                                    <td><input type="checkbox" class="cin-checkbox" name="delete_ids[]" value="<?php echo $row->cin; ?>"></td>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->cin; ?></td>
                                    <td>
                                        <button type="submit" name="delete" value="<?php echo $row->cin; ?>" class="btn btn-warning btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table> 
                    </div>
                    
                </form>

            </div>
            <!--</div>-->
                          
        
        </div>
    </div><!--/span-->
    
</div><!--/row-->
<?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
<script type="text/javascript">
  
$("#product_name").change(function(){
    var product_id=this.value;
    //alert(state_id);
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
        url:BASE_URL+"manage/ajax/class_category/",
        data:{product_id:product_id},
        type: 'post',
        success:function(result){
             $("#category_id_").html(result);
    }});
}); 

</script>
<script>
    function toggleSelectAll(source) {
        let checkboxes = document.querySelectorAll('.cin-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = source.checked);
    }

    function confirmDelete() {
        let selected = document.querySelectorAll('.cin-checkbox:checked');
        if (selected.length === 0) {
            alert("Please select at least one CIN to delete.");
            return false;
        }
        return confirm("Are you sure you want to delete the selected CINs?");
    }
</script>

<style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>