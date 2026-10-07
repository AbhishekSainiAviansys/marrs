<?php include('header.php');

// print_r($payments->franchise_split);

?>

<h4><?php if(isset($message)){echo $message;} ?> </h4>

	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Payments</a> <span class="divider">/</span>
			</li>
			<li>
					<a href="<?php echo SITE_URL?>content/">List</a>
			</li>
		</ul>
	</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Payments</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="POST" enctype= "multipart/form-data">
							<fieldset>
							<div id='cash'>
							    <label>Split To Franchise</label>
							    <select name='choice' >
							        <option value=''>-- select split choice --</option>
							        <option value='yes' <?php if($payments->franchise_split=='yes'){  ?> selected="selected" <?php } ?> >Payment Split To franchise</option>
							        <option value='no' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?> >No Split</option>
							    </select>
							    
							    <select name='com_per' id='com_per' style='width:130px;'>
							        <option value=''>- farnchise % -</option>
							        <option value='40' <?php if($payments->com_per=='40'){  ?> selected="selected" <?php } ?>>40%</option>
							        <option value='45' <?php if($payments->com_per=='45'){  ?> selected="selected" <?php } ?>>45%</option>
							        <option value='50' <?php if($payments->com_per=='50'){  ?> selected="selected" <?php } ?>>50%</option>
							        <option value='55' <?php if($payments->com_per=='55'){  ?> selected="selected" <?php } ?>>55%</option>
							        <option value='60' <?php if($payments->com_per=='60'){  ?> selected="selected" <?php } ?>>60%</option>
							        <option value='65' <?php if($payments->com_per=='65'){  ?> selected="selected" <?php } ?>>65%</option>
							        <option value='70' <?php if($payments->com_per=='70'){  ?> selected="selected" <?php } ?>>70%</option>
							        <option value='75' <?php if($payments->com_per=='75'){  ?> selected="selected" <?php } ?>>75%</option>
							        <option value='80' <?php if($payments->com_per=='80'){  ?> selected="selected" <?php } ?>>80%</option>
							    </select>   
							</div>
							
							<div id='cash1'>
							    <label>Split To Aviansys</label>
							    <select name='avianchoice' id='choiceavian' disabled>
							        <!--<option value=''>-- select split choice --</option>-->
							        <option value='yes' <?php if($payments->avianchoice=='yes'){  ?> selected="selected" <?php } ?>>Payment Split To Aviansys </option>
							        <!--<option value='no'>No Split</option>-->
							    </select>
							
							     
							    <select name='com_peravian' id='' style='width:130px;' required>
							        <!--<option value=''>- aviansys % -</option>-->
							        <option value='10' <?php if($payments->com_peravian=='10'){  ?> selected="selected" <?php } ?>>10%</option>
							        <option value='15' <?php if($payments->com_peravian=='15'){  ?> selected="selected" <?php } ?>>15%</option>
							        <option value='20' <?php if($payments->com_peravian=='20'){  ?> selected="selected" <?php } ?>>20%</option>
							        <option value='25' <?php if($payments->com_peravian=='25'){  ?> selected="selected" <?php } ?>>25%</option>
							        <option value='30' <?php if($payments->com_peravian=='30'){  ?> selected="selected" <?php } ?>>30%</option>
							        <option value='35' <?php if($payments->com_peravian=='35'){  ?> selected="selected" <?php } ?>>35%</option>
							        <option value='40' <?php if($payments->com_peravian=='40'){  ?> selected="selected" <?php } ?>>40%</option>
							        <option value='45' <?php if($payments->com_peravian=='45'){  ?> selected="selected" <?php } ?>>45%</option>
							        <option value='50' <?php if($payments->com_peravian=='50'){  ?> selected="selected" <?php } ?>>50%</option>
							        <option value='55' <?php if($payments->com_peravian=='55'){  ?> selected="selected" <?php } ?>>55%</option>
							        <option value='60' <?php if($payments->com_peravian=='60'){  ?> selected="selected" <?php } ?>>60%</option>
							        <option value='65' <?php if($payments->com_peravian=='65'){  ?> selected="selected" <?php } ?>>65%</option>
							        <option value='70' <?php if($payments->com_peravian=='70'){  ?> selected="selected" <?php } ?>>70%</option>
							        <option value='75' <?php if($payments->com_peravian=='75'){  ?> selected="selected" <?php } ?>>75%</option>
							        <option value='75' <?php if($payments->com_peravian=='75'){  ?> selected="selected" <?php } ?>>80%</option>
							     </select>
							</div>
							
							<div>
							    <label>Management %</label>
							    
							     
							    <select name='manageper' id='' style='width:140px;' required>
							        <!--<option value=''>- management % -</option>-->
							        <option value='5' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>5%</option>
							        <option value='10' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>10%</option>
							        <option value='15' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>15%</option>
							        <option value='20' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>20%</option>
							        <option value='25' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>25%</option>
							        <option value='30' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>30%</option>
							        <option value='35' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>35%</option>
							        <option value='40' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>40%</option>
							        <option value='45' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>45%</option>
							        <option value='50' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>50%</option>
							        <option value='55' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>55%</option>
							        <option value='60' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>60%</option>
							        <option value='65' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>65%</option>
							        <option value='70' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>70%</option>
							        <option value='75' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>75%</option>
							        <option value='80' <?php if($payments->franchise_split=='no'){  ?> selected="selected" <?php } ?>>80%</option>
							     </select>
							</div>

							 
							</fieldset>
							
							<div class="form-actions">
							    <button type="submit" class="btn btn-primary" id="submit" name="submit" >Update</button>
							</div>
							
						  </form>
					
					</div>
					
					
					<div class="box-content">
					
				
				
					
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentTable').DataTable({
                "pageLength": 10
            });
        });
    </script>
<?php 
	$this->confirmation->confirm('delete');
?>