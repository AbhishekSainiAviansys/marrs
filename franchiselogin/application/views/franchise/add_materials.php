<?php include('header.php');

?>
<style>
input[type="text"] {
	width:240px;
}
textarea#product_content{
	width:240px;
} 
  .sub-options {
            display: none;
            margin-left: 20px;
        }
        label.level_class {
    padding-left: 10px;
    padding-right: 10px;
}

</style>
<div>
<ul class="breadcrumb">
    <li>
        <a href="<?php echo SITE_URL?>downloads/">Add Product</a> <span class="divider">/</span>
    </li>
    <li>
        <a href="#"><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?></a>
    </li>
</ul>
</div>
<label><span style="color:#F00; font-weight:bold;">*</span> Mandatory Fileds</label>
<?php echo $this->notifications->display_html();?>
	
<div class="row-fluid sortable">

<div class="box span12">
  <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i> Product <?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?></h2>
      
      <div class="box-icon">
          <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
      </div>
  </div>
  <div class="box-content">
      <form class="form-horizontal" method="POST" enctype="multipart/form-data">
          <fieldset>
          <div class="page-header">
            <h1><small><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add New";}?> Product</small></h1>
          </div>
          
<!-- ==============================================================================================================================-->  


<div class="control-group">
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Name</label>
<div class="controls">
  <input type="text" name="product_title" id="product_title">
       <span  style="color:#F00; font-weight:bold"><?php  $this->validation->show_error('title_id',"Please select the Tiltle.") ?></span>
      </div> <!-- DIV FOR class="controls" -->
</div><!-- DIV FOR class="control-group" -->

<div class="control-group">
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Description</label>
<div class="controls">
  <textarea name="product_content" id="product_content"></textarea>
       <span  style="color:#F00; font-weight:bold"><?php  $this->validation->show_error('title_id',"Please select the Tiltle.") ?></span>
      </div> <!-- DIV FOR class="controls" -->
</div><!-- DIV FOR class="control-group" -->

<div class="control-group">
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Logo</label>
<div class="controls">
  <input type="file" name="product_logo" id="product_logo">
      
      </div>
</div>

<div class="control-group " style="margin-left:40px">
    <label ><span style="color:#F00; font-weight:bold;">*</span>Category( Class) </label>
   
      <?php $cat = $this->db->get_where('category')->result_array(); foreach($cat as $value){ ?>
   <div class="category" style="margin-left:120px">
        <label><input type="checkbox" class="category-checkbox" data-sub-options-id="sub-options<?php echo $value['category_id'];?>">  <?php echo $value['category_name'];?></label>
        <div class="sub-options" id="sub-options<?php echo $value['category_id'];?>" >
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Nursery"> Nursery</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="LKG"> LKG</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="UKG"> UKG</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-1"> Class-1</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-2"> Class-2</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-3"> Class-3</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-4"> Class-4</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-5"> Class-5</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-6"> Class-6</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-7"> Class-7</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-8"> Class-8</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-9"> Class-9</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-10"> Class-10</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-11"> Class-11</label>
            <label class="level_class"><input type="checkbox" name="category<?php echo $value['category_id'];?>_options[]" value="Class-12"> Class-12</label>
        </div>
    </div>
     <?php } ?>   
   
   
</div>


 
 
<div class="control-group">
    <label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Status</label>
    <div class="controls">
         <select class="span3" name="status" id="Status">
           
          
            <option value="Active">Active</option>
            <option value="Deactive">Deactive</option>
          
          </select>
           <span  style="color:#F00; font-weight:bold"></span>
   </div>              
</div> 
<!-- ==============================================================================================================================-->      




<div class="form-actions">
              <button type="submit" class="btn btn-primary" id="submit" name="submit" > Add </button>
              <button class="btn">Cancel</button>
  </div>


</fieldset>
</form>
</div>
</div><!--/span-->
</div><!--/row-->

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">

</script> 
<?php include('footer.php'); ?>








<script>
    document.querySelectorAll('.category-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var subOptionsId = this.getAttribute('data-sub-options-id');
            var subOptions = document.getElementById(subOptionsId);
            if (this.checked) {
                subOptions.style.display = 'flex';
            } else {
                subOptions.style.display = 'none';
                // Uncheck all sub-options if category checkbox is unchecked
                subOptions.querySelectorAll('input[type="checkbox"]').forEach(function(subCheckbox) {
                    subCheckbox.checked = false;
                });
            }
        });
    });
</script>

</body>
</html>

