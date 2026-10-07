<option value=''> All Area</option>
<?php 

foreach($res as $value){  ?>
	 
	<option value="<?php echo $value['area_code'];?>"> <?php echo $value['area_code'].' - '.$value['city_name'];?></option>
	
	
	
	<?php 
        }


?>