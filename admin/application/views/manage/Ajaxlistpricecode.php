
<?php 

foreach($product as $value){  ?>
	  <level id="product_id">
	<input type="checkbox" name="product_id[]" id="product_id" value="<?php echo $value['product_id'];?>"> <?php echo $value['product_name'];?></level><span>
	     <select name="product_price[]" id="price_id" class="span4" style="">
	         <option value="">Select Price</option>
	         <?php  $result = $this->db->get_where('price_codegenration')->result_array(); 
	         foreach($result as $value){
	         ?>
	         <option value=" <?php echo $value['id'];?>"><?php echo $value['price_code'];?></option>
	         <?php } ?>
	         </select></span><br>

	<?php } ?>
