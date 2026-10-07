
<?php if(empty($lunar_varient)){ ?>
<option value="">ERROR: No Varient Found</option>
<?php 
}else{
    ?>
    <option value="">-- Select Varient --</option>
    <?php
    
    foreach($lunar_varient as $result)
    { ?>
	
		<option value="<?php echo $result['varient_name']; ?>"> <?php echo $result['varient_name']; ?></option>

    <?php
    }
} ?>