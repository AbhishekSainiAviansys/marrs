<?php 
echo '<option value="1197"> MaRRS Open Champtionship</option>';
foreach($area as $value){  ?>
	 
	<option value="<?php echo $value['id'];?>"> <?php echo $value['school_name'];?></option>
	
	
	
	<?php 
        }


?>