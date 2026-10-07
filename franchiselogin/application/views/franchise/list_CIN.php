<?php include('header.php');
//echo "<pre>";print_r($cin_list);exit;
 ?>
<div><?php echo $this->notifications->display_html();?> </div>
<form method="POST">
<div>		
<div class="box span12">
<div class="box-header well" data-original-title>
<h2><i class="icon-user"></i>View And Export CIN</h2>
<div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
</div>
</div>
<div class="box-content">
<div class="controls">
<table width="100%">
<tr>
<td valign="top">Period<span style="color:#F00">*</span><br />
<select name="period_id" id="period_id" style="width:200px;">
  <option value="">-- Select Period --</option>
  <?php 	foreach($period as $val): ?>
  <option value="<?php echo $val['period_id']; ?>"<?php if( isset( $result['period_id'] ) )
    { if($result['period_id']== $val['period_id']) {  ?> selected="selected" <?php }} ?>>
  <?php echo $val['period_name']; ?>
  </option>
  <?php  endforeach;  ?>
</select>
<span style="color:#F00"><?php  $this->validation->show_error('period_id',"Please select the PERIOD.") ?></span>

</td>
  
<td valign="top">State<span style="color:#F00">*</span><br />

<select name="state_subdivision_id"  id="state_subdivision_id"  title="First Select Country" style="width:200px;" onchange="get_state_franchise(this.value);">
  <option value="">-- Select State --</option>
<?php 	foreach($stateatload as $stateval): ?>
<option value="<?php echo $stateval['state_subdivision_id']; ?>"
<?php if( isset( $result['state_subdivision_id'] ) )
{ if($result['state_subdivision_id'] == $stateval['state_subdivision_id']) 
{  ?> selected="selected" <?php }} ?>>
<?php echo $stateval['state_subdivision_name']; ?></option>
<?php  endforeach;  ?>
</select>

<span style="color:#F00"><?php  $this->validation->show_error('state_subdivision_id',"Please select the STATE.") ?></span>
</td>

<td  valign="top">Franchise<br />

<select name="franchise_id" id="franchise_id" style="width:200px;"  title="First Select Country & State">
  <option value="">-- Select Franchise --</option>
    <?php 	foreach($res as $val): ?>
<option value="<?php echo $val['franchise_id']; ?>"<?php if( isset( $result['franchise_id'] ) )
                { if($result['franchise_id'] == $val['franchise_id']) {  ?> selected="selected" <?php }} ?>>
<?php echo $val['franchise_code']."-".$val['place']; ?>
</option>
<?php  endforeach;  ?>
</select>
</td>
</tr>

<tr>		 
<td>
<button type="submit" class="btn btn-primary" id="Search" name="Search">Search</button>
<button class="btn" type="reset" onclick="franchise/pid/view_cin'">Reset</button>
</td>
</tr>
</table>

<?php 

$status=$cin_list['status'];
//echo $status;exit;
switch($status):

case "No_data_found" :?>

<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Information!</strong> No record(s) found.
</div>

<?php break;

case "Data_found" :

$cin_list=$cin_list['cin'];
?>

<div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>	
<table class="table table-bordered" width="75%">
<thead>
<tr>
  <th>SlNo</th><th>Period</th> <th>CIN</th><th>Student Name</th>
  <th>Class</th><th>Category</th><th>School</th><th>Franchise Code</th><th>State</th>
</tr>
</thead>   
<tbody>
<?php $i=0;foreach($cin_list as $value){
	 
   $i++;?>
<tr>

<td width="5%">  <?php echo $i; ?></td>
<td width="5%" class="center">  <?php echo $value['period_name']; ?></td>
<td width="10%" class="center">  <?php echo $value['cin']; ?> </td>
<td width="10%" class="center">  <?php echo $value['first_name']." ".$value['middle_name']." ".$value['last_name']; ?></td>
<td width="10%" class="center">  <?php echo $value['class_key']; ?> </td>
<td width="10%" class="center">  <?php echo $value['categoryKey']; ?></td>
<td width="10%" class="center">  <?php echo $value['school_name']."<br>".$value['school_address']; ?></td> 
<td width="10%" class="center">  <?php echo $value['franchise_code']; ?> </td>
<td width="10%" class="center">  <?php echo $value['state_subdivision_name']; ?> </td>
</tr>
 <?php }/*End foreach */ ?>	
</tbody>
</table>
<?php break;


endswitch;

?>

</div>
</div><!--/span-->
</div><!--/row-->
		</form>
		 <script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<?php include('footer.php'); ?>
<?php 
	$this->confirmation->confirm('delete');
?>
<script type="text/javascript">
function get_state_franchise(state_id){
  var data=new Object();
  data.state_id=state_id;
  $.ajax({
	  url:BASE_URL+"manage/ajax/getStateFranchise/",
	  data:data,
	  type: 'post',
	  success:function(result){
		  //alert(result);
		   $("#franchise_id").html(result);
  }});
 
}/*End of get_state_franchise()*/
 </script>