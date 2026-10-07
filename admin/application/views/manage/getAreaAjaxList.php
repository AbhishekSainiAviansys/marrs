
<?php 

foreach($res as $value){  ?>
	 
	<input type="checkbox" name="area[]" value="<?php echo $value['id'];?>"> <?php echo $value['area_code'].' -> '.$value['city_name'];?>
	
	
	
	<?php 
        }


?>