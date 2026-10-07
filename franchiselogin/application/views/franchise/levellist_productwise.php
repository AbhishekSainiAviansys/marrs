<!--<option value="All">All School</option>-->
<?php
foreach($res as $result)
      {
		?>
	<option value="<?php echo $result['level_id'] ?>"> <?php echo $result['level_name']; ?></option>

<?php } ?>