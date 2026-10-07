<?php include('header.php');   /*print_r($list); */?>
<!--<div>
<ul class="breadcrumb">
<li> </li>
</ul>
</div>-->
<?php echo $this->notifications->display_html();?> 

<div class="row-fluid sortable">
<div class="box span12">

<div class="box-header well" data-original-title>
<h2><i class="icon-edit"></i><?php if($mode=='Add') { echo "Add Title"; } if($mode=='Edit') { echo "Edit Title"; }?></h2>
<div class="box-icon">
<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>

<div class="box-content">
<form class="form-horizontal" method="POST">
<fieldset>
<div class="page-header">
 <h1><small>
</small></h1>
</div>

<div class="control-group">
<label class="control-label" for="focusedInput">Title /Heading <span style="color:#F00;">*</span></label>
<div class="controls">
<input class="input-xlarge focused" id="title_desc" name="title_desc" type="text" value="<?php if( isset( $result['title_desc'] ) )echo $result['title_desc']; ?>" >
<span style="color:#F00;"><?php  $this->validation->show_error('title_desc',"Please enter the title.") ?></span>							 
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary" id="submit" name="submit" >Save changes</button>
<button class="btn">Cancel</button>
</div>
</fieldset>
</form>
</div>
  </div><!--/span-->
</div><!--/row-->
            
<?php include('footer.php'); ?>
