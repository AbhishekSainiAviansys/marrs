<?php include('header.php'); 

//echo "<pre>";print_r($title_list);exit;

?>
<form method="POST">
<?php echo $this->notifications->display_html();?> 
<div>
<ul class="breadcrumb">
<li>
<a href="<?php echo SITE_URL?>content/">Title</a> <span class="divider">/</span>
</li>
<li>
  <a href="<?php echo SITE_URL?>content/">List</a>
</li>
</ul>
</div>

<div >		
<div class="box span12">
<div class="box-header well" data-original-title>
<h2><i class="icon-user"></i> TItle</h2>
<div class="box-icon">
  <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
  <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>

</div>
<br/>

<div class="box-content">
<?php if(empty($title_list)){?>
<div class="alert">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Information!</strong> No record(s) found.
</div>
<?php
}
else{
?>

<table class="table table-bordered">
<thead>
<tr>
<th>SI.NO</th>
<th>Title</th>
<th>Actions</th>
</tr>
</thead>   
<tbody>

<?php  $i=0; foreach($title_list as $value) {   $i++; ?>
<tr>
<td><?php echo $i; ?></td>
<td class="center"><?php echo $value['title_desc']; ?></td>
<td class="center">

<a class="btn btn-info" href="<?php echo SITE_URL?>downloads_materials/title_edit/id/<?php echo trim($value['title_id']); ?>" target="_blank">
<i class="icon-edit icon-white"></i>  
Edit                                            
</a>

</td>
</tr>
<?php } ?>	
</tbody>
</table> 
<?php } ?>
<div class="pagination pagination-left">
<ul>


<?php  foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div>





</div>
</div><!--/span-->

</div><!--/row-->

</form>

<?php include('footer.php'); ?>
<?php 
$this->confirmation->confirm('delete');
?>
