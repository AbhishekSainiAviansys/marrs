<?php if(empty($res)){
    ?>
    <option value=''>Error: No School in Area</option>
<?php } 

else{
?>

<option value="All">All School</option>
<?php
foreach($res as $result)
      {
		?>
	<option value="<?php echo $result['id'] ?>"> <?php echo $result['school_name'].' '.$result['location']; ?></option>

<?php 
}
} ?>
