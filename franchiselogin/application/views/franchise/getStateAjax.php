<?php 
foreach($res as $result)
      {
		?>
		<option value="<?php echo $result['state_subdivision_id'] ?>"> <?php echo $result['state_subdivision_name'] ?></option>
<?php } ?>