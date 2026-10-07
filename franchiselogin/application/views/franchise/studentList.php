<?php include('header.php');//echo $flag;exit;//echo"<pre>";echo $schools[0]['school_code'];
//print_r($schools);die;//echo"<pre>"; echo $flag;exit;?>
<?php echo $this->notifications->display_html();?> 
	<div>
		<ul class="breadcrumb">
		   <li><a href="<?php echo SITE_URL?>school/">School</a> <span class="divider">/</span></li>
		   <li>Student List</li>
		</ul>
	</div>
<form method="POST">
<div>
		
  <div class="box span12">
	<div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> Student List</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
	 </div>
	<div class="box-content">
	 
<!--    -----------  ---------------    ---------------   ---------------   ---------------   ---------------   -->            
 

      <!-- <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	-->
	   <table class="table table-bordered" width="75%">
        <thead>
          <tr>
              <th>Slno</th>
              <th>Student Code</th>
              <th>Accss Code</th>
              <th>Student Name</th>
              <th>Student Address</th>
              <th>State</th>
              <th>Student Status</th>
          </tr>
          </thead>   
          <tbody>
           <?php  $i=1;foreach($studentList as $value){  ?>
            <tr>
                <td width="5%"><?php echo $i; ?></td>
                <td  width="15%" class="center"><?php echo $value['school_code']; ?></td>
                <td  width="15%" class="center"><?php echo $value['school_name']; ?></td>
                <td width="15%"><?php echo $value['school_name']; ?></td>
                <td  width="20%"><?php echo $value['school_address']."".$value['school_address1']; ?></td>
                <td  width="20%"><?php echo $value['state_subdivision_name']; ?></td>
                <td  width="20%"><?php echo $value['school_status']; ?></td>
            </tr>
<?php $i++;} ?>	
</tbody>
</table>


 

 
					</div><!--End DIV for class="box-content"--> 
				</div><!--/span-->
			</div><!--/row-->
		</form>
<?php include('footer.php'); ?>
<?php 
	//$this->confirmation->confirm('delete');
?>
		<script type="text/javascript">
       $("#state_subdivision_id").change(function()
	   {
		   /*alert(this.value);*/
        var data=new Object();
        data.state_id=this.value;
        $.ajax({
           url:"<?php echo base_url(); ?>franchise/ajax/getStateFranchise/",
            data:data,
            type: 'post',
            success:function(result)
			{
               // alert(result);
				 $("#franchise_id").html(result);
        }});
    }); 
 </script>