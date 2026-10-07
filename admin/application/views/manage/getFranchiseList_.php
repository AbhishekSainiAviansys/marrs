<option value="All">All Franchise</option>

<?php 
if(!empty($franchise)){
    ?>
    <option value="">-- select franchise --</option>
    <?php
foreach($franchise as $value){  ?>
	 
	<option value="<?php echo $value['franchise_id'];?>"> <?php echo $value['franchise_first_name'].' - '.$value['franchise_last_name'];?></option>
	
	
	
	<?php 
        }
}else{
    ?>
    <!--<option>Error: No franchise</option>-->
    <?php
}

?>