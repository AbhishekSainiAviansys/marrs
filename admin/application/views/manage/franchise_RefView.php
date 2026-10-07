<option value="">Select Main Franchise</option>
<?php
foreach($franchise_ref as $result)
      {
		?>
		<option value="<?php echo $result['franchise_code'] ?>"> <?php echo $result['franchise_code'] ?></option>

<?php } ?>








