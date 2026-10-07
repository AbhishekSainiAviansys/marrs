<?php if(empty($lunar_series)){ ?>
<option value="">ERROR: No Series Found</option>
<?php 
}else{
    ?>
    <option value="">-- Select Series --</option>
    <?php
    
    foreach($lunar_series as $result)
    { ?>
	
		<option value="<?php echo $result['series']; ?>"> <?php echo $result['series']; ?></option>

    <?php
    }
} ?>