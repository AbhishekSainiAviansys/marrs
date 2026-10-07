<?php 
    if(empty($area)){
        ?>
        <option value=''> Error: No Area Found</option>
        <?php
    }


else{
    ?>
    <option value='All'> All Area </option>
    <?php
    foreach($area as $value){  ?>
	 
	<option value="<?php echo $value['area_code'];?>"> <?php echo $value['area_code'].' - '.$value['city_name'];?></option>
	
	
	
	<?php 
        }
}

?>