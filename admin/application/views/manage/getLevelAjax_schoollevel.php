<?php 

if(!empty($level)){

    foreach($level as $value){  ?>
	 
	    <option value="<?php echo $value['level_id'];?>"> <?php echo $value['level_name'];?></option>
	
	
	
	<?php 
        }
}else{ ?>
    <option value="">No School Level Select Another Product.</option>

<?php
}

?>