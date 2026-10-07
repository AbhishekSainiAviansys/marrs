<?php 
echo '<option value="">-- select level --</option>';
foreach($level as $value){  ?>
	 
	<option value="<?php echo $value['level_id'];?>"> <?php echo $value['level_name'];?></option>
	
	
	
	<?php 
        }


?>