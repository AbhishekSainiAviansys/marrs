<?php include('header.php'); ?>


<div>
<ul class="breadcrumb">
  <li>
      <a href="#">Announcement</a> <span class="divider">/</span>
  </li>
  <li>
      <a href="#">List</a>
  </li>
</ul>
</div>
<?php echo $this->notifications->display_html();?>
<div >
<form method="POST">		
<div class="box span12">
<div class="box-header well" data-original-title>
	<h2><i class="icon-user"></i> Announcement List</h2>
	<div class="box-icon">
		<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
		<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
	</div>
</div>					
<div class="box-content">
<div class="control-group"><br/>

<?php if(empty($announcements)){?>

<div class="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Information!</strong> No record(s) found.
</div>

<?php } else{ ?>

<table class="table table-bordered">
   <thead>
      <tr><th>SI.No</th><th>Content</th><th>Status</th><th>Created Date</th> </tr>
   </thead>   
   <tbody>									
          <?php $i=1; foreach($announcements as $value){ ?>	
       <tr>
          <th><?php echo $i ?></th>
          <td>  <?php echo $value['content'] ?> </td>
          <td>  <span <?php if($value['status']=='Active') { ?> class="label label-success" 
			        <?php } if($value['status']=='Inactive') { ?> class="label label-info" 
                    <?php } if($value['status']=='Deleted') { ?> class="label label-danger" <?php } ?>>
                    <?php echo $value['status'] ?>
                </span> 
          </td>   
          <td class="center"><?php echo date("F d, Y",strtotime($value['created_date'])); ?></td>
           <td class="center">
               <a class="btn btn-info" href="<?php echo SITE_URL?>announcement/edit_announcement/id/<?php echo $value['id']; ?>" title="Edit">
               <i class="icon-edit icon-white"></i>  
               </a>
               <a class="btn btn-danger" href="<?php echo SITE_URL?>announcement/changeStatus/id/<?php echo $value['id']; ?>" title="Delete">
               <i class="icon-trash icon-white"></i> 
               </a>
            </td>
       </tr>
      <?php $i=$i+1; } ?>	
  </tbody>
</table> 
<?php } ?>  
</div>
</div><!--/span-->
</div><!--/row-->
		
<?php include('footer.php'); 

	$this->confirmation->confirm('delete');

?>
