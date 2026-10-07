<?php include('header.php');?>
<div>
	<ul class="breadcrumb">
			<li><a href="<?php echo SITE_URL?>student/">Student</a> <span class="divider">/</span></li>
	</ul>
</div>
<form method="POST">
 <div>
 <div class="box span12">
   <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Students List</h2>
         <div class="box-icon">
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
          </div><!--ENd of class="box-icon" DIV-->
	</div><!--ENd of class="box-header well" DIV-->
	<div class="box-content">
        <div class="control-group">
           <div class="controls">
<!-- #####################  SCHOOL  ###################-->			     		
             School
                   <?php 
                        $options=array(""=>"Select");
                        foreach($schools as $schoolval)
                         {
                           $names=$schoolval['school_name'];
                           $id=$schoolval['school_id'];
                           $options[$id] = $names;
                         }
                         echo form_dropdown('school_id', $options, isset( $school_id )?$school_id: '');
                     ?>
  <!-- ################### CIN   #######################-->			     		
             Cin:
                <input class="input-large focused" id="cin" name="cin" type="text" value="<?php if( isset( $cin ) )echo $cin; ?>"  >
             
 <!-- ###################  NAME ########################-->			     		
              Name:
                <input class="input-large focused" id="name" name="name" type="text"   value="<?php if( isset( $name ) )echo $name; ?>"  >
            
 <!-- ######################  SUBMIT AND CANCEL BUTON  ###########################-->			     		
                <button type="submit" class="btn btn-primary" id="Search" name="Search" >Search</button>
                 <button class="btn" type="reset" onclick="window.location='<?php echo SITE_URL?>students/'">Reset</button>
         </div><!-- ENd of class="controls" DIV-->
     </div><!-- ENd of class="control-group" DIV-->

	<?php if(empty($list)){?>
		   <div class="alert">
				 <button type="button" class="close" data-dismiss="alert">&times;</button>
				 <strong>Information!</strong> No record(s) found.
		   </div><!-- ENd of class="alert" DIV-->
	<?php }else{ ?>
				<table class="table table-bordered">
					<thead>
					  <tr>
						 <th>Sno</th><th>CIN</th><th>Name</th><th>Category</th><th>School</th><th>Student Status</th>
					  </tr>
					</thead>   
				    <tbody>
						  <?php $i=1; foreach($list as $value){ ?>
							<tr>
                                <td class="center"><?php echo $i;?></td>
                            	<td class="center"><?php echo $value['cin']; ?></td>
								<td class="center"><?php echo $value['first_name']." " .$value['middle_name']." ".$value['last_name']; ?></td>
								<td class="center"><?php echo $value['categoryKey']; ?></td>
								<td class="center"><?php echo $value['school_name']."<br> " .$value['school_address']; ?></td>
                                <td class="center">
									<span <?php if($value['status']=='Active') { ?> class="label label-success" <?php } ?> <?php if($value['status']=='Inactive') { ?> class="label label-info" <?php } ?>  ><?php echo $value['status'] ?></span>
                               </td>
								<td class="center">
									 <a class="btn btn-success" href="<?php echo SITE_URL?>students/view/id/<?php echo $value['student_id']; ?>"  title="View">
										<i class="icon-zoom-in icon-white"></i>
									</a>
									 <a class="btn btn-info" href="<?php echo SITE_URL?>students/edit/id/<?php echo $value['student_id']; ?>" title="Edit">
									   <i class="icon-edit icon-white"></i>  
									 </a>
								</td>
							</tr>
						<?php $i=$i+1; } /* end foreach*/ ?>	
					 </tbody>
			  </table> 
			<?php }?>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>
