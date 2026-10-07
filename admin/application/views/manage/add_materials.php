<?php include('header.php');

?>
<style>
 
/* ===== Layout fixes — pure CSS/JS, no PHP logic touched ===== */
 
.form-horizontal .control-group{
    display:block;
    margin-bottom:22px;
    overflow:hidden; /* clear floats so rows actually stack */
}
 
.form-horizontal .control-label{
    display:block;
    float:none;
    width:auto;
    text-align:left;
    font-weight:600;
    margin-bottom:6px;
}
 
.form-horizontal .controls{
    margin-left:0;
}
 
input[type="text"],
input[type="file"],
select#Status{
    width:100%;
    max-width:420px;
    box-sizing:border-box;
    padding:6px 8px;
    border:1px solid #ccc;
    border-radius:4px;
}
 
textarea#product_content{
    width:100%;
    max-width:420px;
    min-height:110px;
    box-sizing:border-box;
    padding:6px 8px;
    border:1px solid #ccc;
    border-radius:4px;
}
 
/* ---- Category block ---- */
 
.category-block{
    margin-left:0 !important;
}
 
.category-list{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    list-style:none;
    padding:0;
    margin:8px 0 0 0;
}
 
.category{
    margin-left:0 !important;
    border:1px solid #ddd;
    border-radius:6px;
    padding:10px 14px;
    background:#fafafa;
    min-width:180px;
}
 
.category > label{
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:600;
    cursor:pointer;
    margin:0;
}
 
.category > label input.category-checkbox{
    width:16px;
    height:16px;
    margin:0;
}
 
.sub-options{
    display:none; /* JS adds .open to reveal as flex */
    margin-left:0;
    margin-top:10px;
    padding-top:10px;
    border-top:1px dashed #ddd;
    flex-wrap:wrap;
    gap:4px 14px;
}
 
.sub-options.open{
    display:flex;
}
 
label.level_class{
    padding:0;
    display:flex;
    align-items:center;
    gap:6px;
    font-weight:normal;
    white-space:nowrap;
}
 
label.level_class input{
    margin:0;
}
 
/* ---- Product level rows ---- */
 
#levelWrapper{
    max-width:420px;
}
 
.level-row{
    display:flex;
    align-items:center;
    gap:6px;
    margin-bottom:8px;
}
 
.level-row input[type="text"]{
    max-width:none;
    flex:1;
}
 
.level-row .btn-add-level,
.level-row .btn-remove-level{
    flex:0 0 auto;
    padding:4px 12px;
    line-height:1.4;
    border-radius:4px;
    border:none;
    cursor:pointer;
    color:#fff;
    font-weight:bold;
}
 
.level-row .btn-add-level{ background:#2f8f4e; }
.level-row .btn-remove-level{ background:#d9534f; }
 
.form-actions{
    margin-top:26px;
}
 
</style>
 
<div class="container-fluid mx-3">
 
<ul class="breadcrumb">
 
    <li>
 
        <a href="<?php echo SITE_URL?>downloads/">Add Product</a> <span class="divider">/</span>
 
    </li>
 
    <li>
 
        <a href="#"><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?></a>
 
    </li>
 
</ul>
 
</div>
 

 
	
 
<div class="row-fluid sortable">
 

<div class="box span12">
 
  <div class="box-header well" data-original-title>
 
      <h2><i class="icon-edit"></i> <?php if($mode=='Edit'){echo "Edit";} else{ echo "Add";}?> Product</h2>
 
      
 
      <div class="box-icon">
 
          <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
 
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
 
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
 
      </div>
 
  </div>
 
  <div class="box-content">
      <div> <label><span style="color:#F00; font-weight:bold;">*</span> Mandatory Fileds</label>
 
<?php echo $this->notifications->display_html();?>
 </div>
 
      <form class="form-horizontal border shadow rounded my-5" method="POST" enctype="multipart/form-data" >
 
 
          <div class="page-header">
 
            <h4><small><?php if($mode=='Edit'){echo "Edit";} else{ echo "Add New";}?> Product</small></h1>
 
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
 
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>CIN Product Indentification (in capital 2 letter)</label>
 
<div class="controls">
 
  <input type="text" name="in13" id="in13" required>
 
       <span  style="color:#F00; font-weight:bold"><?php  $this->validation->show_error('in13',"Please enter CIN indentification.") ?></span>
 
      </div> <!-- DIV FOR class="controls" -->
 
</div><!-- DIV FOR class="control-group" -->
  
 
<div class="control-group">
 
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Description</label>
 
<div class="controls">
 
  <textarea name="product_content" id="product_content" class="form-control"></textarea>
 
       <span  style="color:#F00; font-weight:bold"><?php  $this->validation->show_error('title_id',"Please select the Tiltle.") ?></span>
 
      </div> <!-- DIV FOR class="controls" -->
 
</div><!-- DIV FOR class="control-group" -->
 
 
 
<div class="control-group">
 
<label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Logo</label>
 
<div class="controls">
 
  <input type="file" name="product_logo" id="product_logo" class="form-control">
 
      
 
      </div>
 
</div>
 
 
 
<div class="control-group category-block">
 
    <label><span style="color:#F00; font-weight:bold;">*</span>Category( Class) </label>
 
   
 
    <div class="category-list">
 
      <?php $cat = $this->db->get_where('category')->result_array(); foreach($cat as $value){ ?>
 
   <div class="category">
 
        <label><input type="checkbox" class="category-checkbox form-control" data-sub-options-id="sub-options<?php echo $value['category_id'];?>">  <?php echo $value['category_name'];?></label>
 
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
 
   
 
</div>
 
 
 
 
 
 <div class="control-group">
 
    <label class="control-label" for="focusedInput"><span style="color:#F00; font-weight:bold;">*</span>Product Level</label>
 
    <div class="controls">
 
        <div id="levelWrapper">
 
            <div class="level-row">
 
                <input type="text" name="level_name[]" placeholder="Enter level name" class="form-control">
 
                <button type="button" class="btn-add-level">+</button>
 
            </div>
 
        </div>
 
        <span style="color:#F00; font-weight:bold"></span>
 
    </div>
 
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
 
              <button type="submit" class="btn btn-success btn-lg" id="submit" name="submit" > Add </button>
 
              <button class="btn btn-danger btn-lg" type="button">Cancel</button>
 
  </div>
 
 
 
 
 

</form>
 
</div>
 
</div><!--/span-->
 
</div><!--/row-->
 

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<script type="text/javascript">

</script> 
<?php include('footer.php'); ?>








<script>


document.getElementById('levelWrapper').addEventListener('click', function (e) {

    // Add a new level row
    if (e.target.classList.contains('btn-add-level')) {
        var row = document.createElement('div');
        row.className = 'level-row';
        row.style.cssText = 'margin-bottom:6px; display:flex; align-items:center; gap:6px;';
        row.innerHTML =
            '<input type="text" name="level_name[]" placeholder="Enter level name" style="width:240px;">' +
            '<button type="button" class="btn btn-danger btn-remove-level" style="padding:2px 10px; line-height:1;">-</button>';
        this.appendChild(row);
    }

    // Remove a level row (always keep at least one)
    if (e.target.classList.contains('btn-remove-level')) {
        var rows = this.querySelectorAll('.level-row');
        if (rows.length > 1) {
            e.target.closest('.level-row').remove();
        }
    }
});
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

