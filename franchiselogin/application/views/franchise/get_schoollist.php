<!--<option value="All">All School</option>-->
<?php
foreach($res as $result)
      {
		?>
	<option value="<?php echo $result['id'] ?>"> <?php echo $result['school_name'].' '.$result['location']; ?></option>

<?php } ?>