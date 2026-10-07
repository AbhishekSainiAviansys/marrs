
<?php
    if(!empty($res)){
    foreach($res as $result)
    { ?>
	<option value="<?php echo $result['id'] ?>"> <?php echo $result['school_name'].' '.$result['school_address']; ?></option>

<?php }}else{ ?>
    <option value=''>Error: No school found</option>
<?php } ?>