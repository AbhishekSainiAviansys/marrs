<?php 

if(!empty($level)){

    foreach($level as $value){  ?>
	 
	    <option value="<?php echo $value['category_id'];?>"> <?php echo $value['category_name'];?></option>
	
	
	
	<?php 
        }
}else{ ?>
    <option value="">No Category Found, Select Another Product.</option>

<?php
}

?>