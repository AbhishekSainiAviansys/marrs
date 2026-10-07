<?php 

if(!empty($level)){
echo '<option value="All">-- All Area --</option>';
foreach($level as $value){  ?>
	 
	<option value="<?php echo $value['area_code'];?>"> <?php echo $value['area_code'];?></option>
	
	
	
	<?php 
        }
}else{
    echo '<option value="">Error: No Area Found.</option>';
}

?>