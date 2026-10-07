

<?php 

foreach($product as $value){  ?>
	  
 <input type="checkbox" name="product_id[]" id="product_id" value="<?php  echo $value['product_id']; ?>"> <span style="font-size:16px;position: relative;
    top: 5px;left:10px"><?php echo $value['product_name']; ?></span><span><select name="product_price[]" class="span4" style="">  
								       
								   
								   <?php  $this->db->select('*');
                                    $this->db->from('price_codegenration');
                                    $this->db->where('status','Active');
                                    
								    $res = $this->db->get();
								    $result = $res->result_array();
								   foreach($result as $value){ ?>
								       
								       <option value="<?php echo $value['price_code'];?>"><?php echo $value['price_code'];?></option>
								       <? }?>
								   </select> </span><br>
	
	
	
	<?php 
        } 


?>