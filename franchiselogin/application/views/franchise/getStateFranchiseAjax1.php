
<?php
if(!empty($res)){
    
?>
<option value="">-- select franchise --</option>
<?php
foreach($res as $result)
      {
		?>
		<option value="<?php echo $result['franchise_id'] ?>"> <?php echo $result['franchise_code']." ( ".$result['username']." - ".$result['place']." ) "; ?></option>

<?php }
    
}else{
    ?>
    
   <option value="">Error:No franchise account</option> 
    
    <?php
}
?>