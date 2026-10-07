<option value=""> select Class</option>
<?php 

foreach($catego as $res){  ?>
	 
	<option value="<?php echo $res['category_id'];?>"> <?php echo $res['class'];?></option>
	
	<!--<input type="checkbox" id="all" name="category_id[]" value="<?php echo $res['category_id'];?>"> <?php echo $res['class'];?>-->
	
	
	<?php 
        }


?>


<?php
//foreach($catego as $result)
  //    {
		?>
		
        <!--<input type="checkbox" name="category_id[]" value="<?php echo $result['category_id'] ?>" >   <?php echo $result['class']; ?>-->
        <!--<br>-->
<?php 
//} 
?>