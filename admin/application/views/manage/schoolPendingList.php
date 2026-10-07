<?php include('header.php'); ?>
  <div>
  <ul class="breadcrumb">
        <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
        <li>
            <?php if($type=='request'){?><a href="<?php echo SITE_URL?>school/requests/">Requests List</a>
            <?php }else{?><a href="<?php echo SITE_URL?>school/">List</a><?php }?>
       </li>
  </ul>
  </div>
  <form method="POST">
   <div>		
	  <div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> School <?php if($type=='request'){?> Requests<?php }?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
			</div>
		</div>
		<div class="box-content">
		    <?php if(empty($plist)){?>
			     <div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No record(s) found.
				 </div>
			<?php } else{ ?>
				  <table class="table table-bordered">
					<thead>
					  <tr>
						 <th>
							<label class="checkbox inline"><input type="checkbox" id="inlineCheckbox1" value="option1" class="listCheckBoxAll"></label>
						 </th>
						 <th>School Name</th>
                         <th>City</th>
						 <th>Principal Name</th>
						 <th>School Phone</th>
						 <th>School Email</th>
						 <th>Actions</th>
					  </tr>
					</thead>   
					<tbody>
				<?php foreach($plist as $value){ ?>
					<tr>
                          <td>
                            <label class="checkbox inline"><input name="school_id[]"  type="checkbox" class="listCheckBoxEach commonLeftCheck" value="<?php echo $value['school_id'] ?>"<?php if(in_array($value['school_id'],$school_id)) 
									   echo 'checked="checked"';?>/></label>
                          </td>
                          <td><?php echo $value['school_name']."<br>".$value['school_address']; ?></td>
                          <td class="center"><?php echo $value['school_city']; ?></td>
                          <td class="center"><?php echo $value['school_principal_name']; ?></td>
                          <td class="center"><?php echo $value['school_phone']; ?></td>
                          <td class="center"><?php echo $value['school_email']; ?></td>
                          <td class="center">
                                        <a  href="<?php echo SITE_URL?>school/approve/id/<?php echo $value['school_id']; ?>" <?php if($value['status']=='Pending') { ?> class="label label-info" <?php } ?>  >Approve Now</a>
                          </td>
                          <td class="center">
                                <a class="btn btn-danger" href="<?php echo SITE_URL?>school/delete/id/<?php echo $value['school_id']; ?>" title="Delete">
                                   <i class="icon-trash icon-white"></i> 
                                </a>
                          </td>
					</tr>
				<?php } ?>	
				 </tbody>
				</table> 
  		<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>

