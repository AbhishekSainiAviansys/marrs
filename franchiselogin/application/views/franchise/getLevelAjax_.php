<?php 
echo '<option value="">-- All level --</option>';
foreach($level as $value){  ?>
	 
	<option value="<?php echo $value['level_id'];?>"> <?php echo $value['level_name'];?></option>
	
	
	
	<?php 
        }


?>