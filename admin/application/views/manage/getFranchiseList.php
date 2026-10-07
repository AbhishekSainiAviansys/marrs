<option value="All">All Franchise</option>

<?php 

foreach($franchise as $value){  ?>
	 
	<option value="<?php echo $value['franchise_id'];?>"> <?php echo $value['username'];?></option>
	
	
	
	<?php 
        }


?>