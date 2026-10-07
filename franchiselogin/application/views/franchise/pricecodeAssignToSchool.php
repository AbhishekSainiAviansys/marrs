<?php include('header.php');
?>
<style>
     @keyframes glowing {
        0% {
          background-color: red;
          box-shadow: 0 0 5px #2ba805;
        }
        50% {
          background-color: red;
          box-shadow: 0 0 20px #49e819;
        }
        100% {
          background-color: red;
          box-shadow: 0 0 5px #2ba805;
        }
      }
      .button {
        animation: glowing 1300ms infinite;
      }
</style>
			<?php //echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo SITE_URL?>content/">Content</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="">List</a>
					</li>
				</ul>
			</div>
			
				<?php if($this->session->flashdata('success')){ ?>
         <div><?php echo $this->session->flashdata('success'); ?></div>
         <?php } ?>
      <form action="" method="POST">
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i>Direct Assign Link For Open Registration</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<form>
						<table class="table table-bordered" width="100%">
						  <thead>
							  <tr>
								  <td>Franchise:<select name="franchise" id="franchise">
								      <?php $fr = $this->db->get_where('franchise')->result_array();
								       foreach($fr as $value){  ?>
								      <option value="<?php echo $value['franchise_id'];?>"> <?php echo $value['username'];?></option>
								      
								      <?php } ?>
								  </select></td>
								  <td>
						    Select Product :<select name="product_name" id="product_name">
						             <option value="1"> All Product</option>
								      <?php $fr = $this->db->order_by('product_name')->get_where('products',array('status'=>'Active'))->result_array();
								       foreach($fr as $value){  ?>
								      <option value="<?php echo $value['product_id'];?>"> <?php echo $value['product_name'];?></option>
								      
								      <?php } ?>
								  </select>
					
							</td>	<td>
						
						    Select Level :<select  name="level" id="level">
						         <option value="0">All Level</option>
								      
								  </select>
						</td>
						
							  </tr>
							 
							 
						  </tdead>   
						 
						 
					  </table> 
				
                 
					
						
					<div class="span3" style="padding-bottom: 30px;">
			        	<input style="padding: 10px;width: 100%;background: blue;color: #fff;
" type="submit" name="submit" value="submit" class="btn-btn-priamry">
		        	</div>
				</form>	
					
					
					<br>
					<table class="table table-bordered">
					    
					    <thead><tr>
					        
					        <th>Sr NO.</th>
					        <th>Share Link & Copy</th>
					       
					        <th>Registration Link</th>
					        
					        <th>Product Name</th>
					        <th>Franchise Name</th>
					        <th>Price Code</th>
					         <th>Status</th>
					         <th>Delete</th>
					    </tr></thead>
					    <tbody>
					        
					        <?php $i=1; foreach($link as $value){ 
					           $data ="https://marrs.in/student_registration/welcome/directregistration/fid/".$value['franchise_id']."/pid/".$value['product_id'];
					           $whatsappLink = 'https://wa.me/?text=' .$data;
					        ?>
					            
					            
					       
					        <tr>
					            
					            <td><?php echo $i; ?></td>
					            <td> <a id="url" href="<?php echo $whatsappLink;?>"><img src="<?php echo base_url();?>public/logo/whatsapp.png" width="40px"></a> &nbsp; &nbsp;<a href="<?php echo $data;?>"  class="copy-link""> <img src="<?php echo base_url();?>public/logo/copy.png" width="20px" ></a></td>
					            <td> <a class="" href="/student_registration/welcome/directregistration/fid/<?php echo $value['franchise_id'];?>/pid/<?php echo $value['product_id'];?>" >Click For Registration </a></td>
					            <td><?php echo $value['product_name'];?></td>
					            <td><?php echo $value['username'];?></td>
					            <td><?php echo $value['price_code'];?></td>
					            <td><?php echo $value['status'];?> </td>
					            <td class="center">
								
									<a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url();?>manage/franchise/deletelink/<?php echo $value['id'];?>" title="Delete">
										Delete                              
									</a>
								</td>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
					
				</div><!--/span-->
			
			</div><!--/row-->
			
</form>
<script>
$(document).ready(function() {
    // Add a click event handler to the anchor tag with the class "copy-link"
    $('.copy-link').click(function(event) {
        event.preventDefault(); // Prevent the link from navigating to its href

        // Get the URL from the href attribute of the clicked anchor
        var urlToCopy = $(this).attr('href');

        // Create a temporary input element to copy the URL to the clipboard
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(urlToCopy).select();
        document.execCommand('copy');
        tempInput.remove();

        // Provide a visual indication to the user that the link has been copied
        alert('URL copied to clipboard: ' + urlToCopy);
    });
});
</script>
<script type="text/javascript">
$("#franchise").change(function(){
var franchise_id =this.value;
 //alert(state_id);
 var BASE_URL="https://marrs.in/franchiselogin/"; 
$.ajax({
url:"<?php echo base_url();?>manage/ajax/AreaCode",
data:{franchise_id:franchise_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#area_code").html(result);
}});
});
</script>
<script>
    $("#product_name").change(function(){
var product_id =this.value;
 //alert(franchise_id);
 var BASE_URL="https://marrs.in/franchiselogin/";
$.ajax({
url:"https://marrs.in/franchiselogin/manage/ajax/productwiselevel",
data:{product_id:product_id},
type: 'post',
success:function(result)
{
	//alert(result);
	 $("#level").html(result);
	 

}});
});
    
    
</script>
<?php include('footer.php'); ?>
