<?php if(empty($lunar_series)){ ?>
<option value="">ERROR: No Type Found</option>
<?php 
}else{
    ?>
    <option value="">-- Select Type --</option>
    <?php
    
    foreach($lunar_series as $result)
    { ?>
	
		<option value="<?php echo $result['type']; ?>"> <?php echo $result['type']; ?></option>

    <?php
    }
} ?>