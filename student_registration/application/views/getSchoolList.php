<?php

if(empty($schools)){ ?>
<option value="0">Select School</option>
<?php }else{
    foreach($schools as $result)
      {
		?>
	
		<option value="<?php echo $result['school_code'] ?>"> <?php echo $result['school_name']; ?></option>

<?php } ?>

	<option value="1"> Add Your School, if not listed here. </option>



<?php } ?>
