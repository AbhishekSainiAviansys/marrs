<?php 
echo '<option value=""> select Area</option>';
foreach($level as $value){  ?>
	 
	<option value="<?php echo $value['area_code'];?>"> <?php echo $value['area_code'];?></option>
	
	
	
	<?php 
        }


?>