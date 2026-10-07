<?php include('header.php');


// print_r($competition);

?>




<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo SITE_URL?>category_new/">Upload CIN</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="<?php echo SITE_URL?>blog/<?php echo ($blogID>0)?'edit':'Activate';?>/"><?php echo ($blogID>0)?'Edit':'Activate';?></a>
        </li>
    </ul>
</div>


<div class="box span12" style="background:#f4f6f9; padding:15px; border-radius:10px;">

    <!-- HEADER -->
    <div class="box-header well" data-original-title 
         style="display:flex; justify-content:space-between; align-items:center; border-radius:8px;">
        
        <h2 style="margin:0; font-weight:600;">
            <i class="icon-edit"></i> 
            CIN <?php echo ($blogID>0)?'Edit':'Upload';?>
        </h2>
        
        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
        </div>
    </div>

    <div class="box-content" style="background:#fff; padding:20px; border-radius:10px; margin-top:10px;">

        <!-- TITLE -->
        <div class="page-header" style="display:flex; align-items:center; gap:15px; margin-bottom:20px;">
            <h3 style="margin:0; color:#6c757d;">
                <small>CIN upload for Competition Registration</small>
            </h3>
        </div>

        <div class="row-fluid">

            <!-- LEFT -->
            <div class="span8">
                <div class="well">

                    <h5 style="margin-top:0; font-weight:600;">Competition Details</h5>
<?php
$this->db->where('product_name', $competition->product_name);
$this->db->where('level_id', $competition->clevel);
$levelData = $this->db->get('competition_level_byproduct')->row();

$levelName = !empty($levelData->level_name) ? $levelData->level_name : '';
?>
                    <table class="table table-bordered table-striped" 
                           style="margin-top:10px; border-radius:8px; overflow:hidden;">
                        <tr>
                            <th width="180" style="background:#f8f9fa;">Product Name</th>
                            <td><?= $competition->product_name ?></td>
                        </tr>
                         <tr>
        <th style="background:#f8f9fa;">Competition Level</th>
        <td style="text-transform: capitalize;">
            <?= $competition->clevel ?>
        </td>
    </tr>

    <tr>
        <th style="background:#f8f9fa;">Level Name</th>
        <td style="text-transform: capitalize;">
            <?= !empty($levelName) ? $levelName : 'N/A' ?>
        </td>
    </tr>

                        <tr>
                            <th style="background:#f8f9fa;">State Name</th>
                            <td><?= $competition->state_subdivision_name ?></td>
                        </tr>
                    </table>

                </div>
            </div>

            <!-- RIGHT -->
            <div class="span4">
                <div class="well">

                    <h5 style="margin-top:0; font-weight:600;">Upload CIN CSV</h5>

                    <form method="post" enctype="multipart/form-data" id="form1">

                        <label class="checkbox" style="display:flex; align-items:center; gap:8px; margin-bottom:15px; cursor:pointer;">
                            <input type="checkbox" name="competition" style="height:18px; width:18px; margin:0;">
                            <b style="margin:0;">Use CoFee</b>
                        </label>
                        
                        <div>                        
                            <label style="font-weight:600;">Select CSV File</label>
                        </div>
                        <!-- Styled File Input -->
                        <div style="border:2px dashed #ccc; padding:15px; border-radius:8px; text-align:center; margin:10px 0; background:#fafafa;">
                            <input
                                type="file"
                                name="csv"
                                id="csv"
                                accept=".csv"
                                class="input-block-level"
                                style="border:none; background:none; width:100%;">
                            <small style="color:#999;">Upload only CSV file</small>
                        </div>

                        <button
                            type="submit"
                            name="submit"
                            class="btn btn-primary btn-large btn-block mt-4"
                            style="padding:10px; font-weight:600; border-radius:8px;">
                            <i class="icon-upload icon-white"></i>
                            Upload CSV
                        </button>

                    </form>

                </div>
            </div>

        </div>

        <!-- MESSAGE -->
        <div style="margin-top:20px;">
            <?php if(!empty($message)){ ?>
                <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; font-weight:500;">
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </div>

        <!-- RESULT TABLE -->
        <div style="margin-top:20px;">
            <?php if(!empty($ar)){ ?>

                <div style="overflow-x:auto;">
                    <table class="table table-bordered" style="border-radius:10px; overflow:hidden;">
                        <thead style="background:#343a40; color:#fff;">
                            <tr>
                                <th>Sr.No.</th>
                                <th>CIN</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        $i=1;
                        foreach($ar as $value){ 
                            $isError = stripos($value['message'], 'error') !== false;
                        ?>  
                            <tr style="transition:0.2s;">
                                <td><?php echo $i; ?></td>
                                <td style="font-weight:500;"><?php echo $value['cin']; ?></td>

                                <td style="
                                    background-color: <?= $isError ? '#f8d7da' : '#d4edda'; ?>;
                                    font-weight:500;
                                    border-radius:4px;">
                                    <?= htmlspecialchars($value['message']) ?>
                                </td>
                            </tr>
                        <?php $i++; } ?>  

                        </tbody>
                    </table>
                </div>

            <?php } else { ?>

                <div style="background:#fff3cd; color:#856404; padding:12px; border-radius:8px; text-align:center;">
                    No file selected or CIN already uploaded.
                </div>

            <?php } ?>
        </div>

    </div>
</div><?php include('footer.php'); ?>

<script src="<?php echo VIEW_SCRIPT;?>jquery-1.9.1.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>-->
<script type="text/javascript">
  
$("#product_name").change(function(){
    var product_id=this.value;
    //alert(state_id);
    var BASE_URL = "<?php echo base_url();?>";
    $.ajax({
        url:BASE_URL+"manage/ajax/class_category/",
        data:{product_id:product_id},
        type: 'post',
        success:function(result){
             $("#category_id_").html(result);
    }});
}); 

</script>

<style>
.vl {
  border-left: 2px solid gray;
  height: 80px;
}
</style>