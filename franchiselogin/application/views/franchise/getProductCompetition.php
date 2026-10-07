<?php if(!empty($res)){ 
foreach($res as $res){
?>

<input type='checkbox' name='products[]' class='form-control' value="<?php echo $res->product_name; ?>"  => <?php echo $res->product_name; ?> &ensp; &ensp;

<?php }}else{ 
    echo 'Error: No Competition Product Found or no revenue setting added or no competition active for this level & period & franchise.';
}
?>