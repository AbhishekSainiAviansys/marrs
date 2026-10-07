<option value=""> --select school--</option>
<?php 
foreach($school as $result)
      {
		?>
		<option value="<?php echo $result['school_id'] ?>"> <?php echo $result['school_name'].' '.$result['location']; ?></option>
<?php } ?>