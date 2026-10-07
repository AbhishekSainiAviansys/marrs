<?php include('header.php');

// print_r($franchise2);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Check if the message element exists
    if ($('#message').length) {
        // Set a timeout to remove the message after 3 seconds
        setTimeout(function() {
            $('#message').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
    }
});
</script>
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>Product List</li>
		</ul>
	</div>

<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Product Assign</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
<?php if(!empty($message)){ ?>
    <h3 id="message" style="background-color:green;color:white;">
        <?php echo $message; ?>
    </h3>
<?php } ?>
            <form method='post'>
                <div>
                    <label>Price Code</label>
                    <select name="price" class="form-comtrol" required>
                        <option value="">-- Select Price Code --</option>
                        <?php
                        foreach($price_codes as $code){
                        ?>
                        <option value="<?php echo $code['amount']; ?>"><?php echo $code['price_code']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                        <!----------------- Franchise ------------------->       
                <table  cellpadding="5px" >
				    <?php
				        foreach($productlist as $row){
				    ?>
				    <tr>
				    <td>
				        <input type="checkbox" id="" name="products[]" value="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?><br>
					</td>
				</tr>
				
				<?php } ?>
    			    <td> 
    			        <br /><input type="submit" class='btn btn-primary' name="submit" value="Submit" />
    			    </td>
				
				
		        </table>	
				    
            </form>
 


 
					</div>
				</div>
</div>
	

<?php include("footer.php");?>



