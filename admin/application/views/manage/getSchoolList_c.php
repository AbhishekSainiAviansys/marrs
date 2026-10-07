
<?php if(!empty($res)){?>
<option value="All">All School</option>
<?php
foreach($res as $result)
      {
		?>
	<option value="<?php echo $result['school_name'] ?>"> <?php echo $result['school_name'].' '.$result['school_address'];; ?></option>

<?php }}else{ ?>
        <option > <?php echo 'No School in this area.'; ?></option>

<?php } ?>