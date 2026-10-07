<option value="All">All Product</option>

<?php 

foreach($franchise as $value){  ?>
	 
	<option value="<?php echo $value['product_name'];?>"> <?php echo $value['product_name'];?></option>
	
	
	
	<?php 
        }


?>