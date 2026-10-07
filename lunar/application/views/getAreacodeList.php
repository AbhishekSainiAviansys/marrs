<option value="">Select Area</option>
<?php
foreach($area as $result)
      {
		?>
	<option value="<?php echo $result['area_code'] ?>"> <?php echo $result['city_name']; ?></option>

<?php } ?>
