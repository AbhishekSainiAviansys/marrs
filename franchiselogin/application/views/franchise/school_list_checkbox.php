<?php if(!empty($res)){ 
foreach($res as $res){
?>

<input type='checkbox' name='schools[]' class='form-control' value="<?php echo $res['id']; ?>"  => <?php echo $res['school_name']; ?> &ensp; &ensp;<br>

<?php }}else{ 
    echo 'Error: No School in this area.';
}
?>