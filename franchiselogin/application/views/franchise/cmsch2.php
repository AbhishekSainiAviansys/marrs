<?php include('header.php'); 

// error_reporting(E_ALL);
// ini_set('display_errors', 1);


?>
<div>
    <ul class="breadcrumb">
       <li><a href="<?php echo SITE_URL ?>school/">School</a> <span class="divider">/</span></li>
       <li>School List</li>
    </ul>
</div>

<form method="POST">
<div class="box span12">
    <div class="box-header well" data-original-title>
       <h2><i class="icon-user"></i> School List</h2>
       <div class="box-icon">
          <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
          <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
       </div>
     </div>
    <div class="box-content">

        <h3 style='color:green;'>
            <?php if (!empty($message)) echo $message; ?>
        </h3>

        <div class='table-responsive'>
            <table cellpadding="5px">
                <tr>
                    <td>Period: <span style='color:red;'>*</span><br />
                        <select name="period" id="period" style="width: 200px;" required>
                            <option value=''>-- Select Period --</option>
                            <?php
                            $query = $this->db->query("SELECT * FROM period WHERE period_id > '13';");
                            foreach ($query->result() as $row) {
                            ?>
                            <option value="<?php echo $row->period_id; ?>" <?php if(isset($result['period']) && $result['period'] == $row->period_id){ echo 'selected="selected"'; } ?>>
                                <?php echo $row->academic_year; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>

                    <td>Country:<span style='color:red;'>*</span><br />
                        <select name="country" id="country" style="width: 200px;" required>
                            <option value=''>-- Select Country --</option>
                            <option value='105'>INDIA</option>
                            <?php
                            $query = $this->db->query("SELECT * FROM countries;");
                            foreach ($query->result() as $row) {
                            ?>
                            <option value="<?php echo $row->country_id; ?>" <?php if(isset($result['country']) && $result['country'] == $row->country_id) echo 'selected="selected"'; ?>>
                                <?php echo $row->country_name; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>

                    <td>State:<span style='color:red;'>*</span><br />
                        <select name="state_id" id="state_id" style="width: 200px;" required>
                            <option value=''>-- Select State --</option>
                            <?php
                            foreach ($stateload as $row) {
                            ?>
                            <option value="<?php echo $row['state_subdivision_id']; ?>" <?php if(isset($result['state_id']) && $result['state_id'] == $row['state_subdivision_id']) echo 'selected="selected"'; ?>>
                                <?php echo $row['state_subdivision_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>

                    <td>Franchise:<span style='color:red;'>*</span><br />
                        <select name="franchise_id" id="franchise_id" style="width: 200px;" required>
                            <option value=''>-- Select Franchise --</option>
                            <?php foreach ($franchise2 as $row) { ?>
                            <option value="<?php echo $row['franchise_id']; ?>" <?php if(isset($result['franchise_id']) && $result['franchise_id'] == $row['franchise_id']) echo 'selected="selected"'; ?>>
                                <?php echo $row['franchise_code'] . ' ' . $row['franchise_first_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    
                    <td>Product:<span style='color:red;'>*</span><br />
                        <select name="product_name" id="product_name" style="width: 200px;" required>
                            <option value=''>-- Select Product --</option>
                            <?php foreach ($productload as $row) { ?>
                            <option value='<?php echo $row['product_name']; ?>' <?php if(isset($result['product_name']) && $result['product_name'] == $row['product_name']) echo 'selected="selected"'; ?>>
                                <?php echo $row['product_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    
                    <td>Competition Level:<span style='color:red;'>*</span><br />
                        <select name="clevel" id="clevel" style="width: 200px;" required>
                            <option value=''>-- Select Level --</option>
                            <?php foreach ($levelload as $row) { ?>
                            <option value='<?php echo $row['level_id']; ?>' <?php if(isset($result['clevel']) && $result['clevel'] == $row['level_id']) echo 'selected="selected"'; ?>>
                                <?php echo $row['level_name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td>Area Code:<span style='color:red;'>*</span><br />
                        <select name="area" id="area" style="width: 200px;" required>
                            <option value=''>-- Select Area --</option>
                            <?php foreach ($areaload as $row) { ?>
                            <option value='<?php echo $row['area_code']; ?>' <?php if(isset($result['area']) && $result['area'] == $row['area_code']) echo 'selected="selected"'; ?>>
                                <?php echo $row['area_code']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    
                    <td>School:<span style='color:red;'>*</span><br />
                        <!--<div id='school'></div>-->
                        <select name="school" id="school" style="width: 200px;" required>
                            <option value=''>-- Select School --</option>
                        </select>
                    </td>

                    <td>School Fix Amount:<span style='color:red;'>*</span><br>
                        <input name='school_amount' type='text' class='form-control' style='width: 180px;' required>
                    </td>

                    <td>Registration Start Date:<span style='color:red;'>*</span><br />
                        <input type='date' name='start_date' class='form-control' value="<?php if(isset($result['start_date'])){ echo $row['start_date'];} ?>" style='width: 180px;' required>
                    </td>

                    <td>Registration End Date:<span style='color:red;'>*</span><br />
                        <input type='date' name='end_date' class='form-control' value="<?php if(isset($result['end_date'])){ echo $row['end_date']; } ?>" style='width: 180px;' required>
                    </td>
                    
                    <!--<td>Competition Date:<span style='color:red;'>*</span><br />-->
                    <!--    <input type='date' name='comp_date' class='form-control' value="<?php if(isset($result['comp_date'])){ echo $row['comp_date']; } ?>" style='width: 180px;' required>-->
                    <!--</td>-->

                    
                </tr>
                <tr>
                    <div id="revenue_setting">
                       
                    </div>
                    <td><br /><input type="submit" class='btn btn-primary' name="submit" value="Launch" /></td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
</form>

<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $("#area").change(function () {
        var area_code = this.value;
        var period = $("#period").val();
        var franchise_id = $("#franchise_id").val();

        $.post("<?php echo base_url(); ?>manage/ajax/getProductCompetition", {
            area_code: area_code,
            period: period,
            franchise_id: franchise_id
        }, function (result) {
            $("#product").html(result);
        });

        $.post("<?php echo base_url(); ?>manage/ajax/school_list_checkboxnotactive", {
            area_code: area_code
        }, function (result) {
            $("#school").html(result);
        });
    });
    
    

    $("#country").change(function () {
        var country_id = this.value;
        $.post("<?php echo base_url(); ?>manage/ajax/getstateAjax", {
            country_id: country_id
        }, function (result) {
            $("#state_id").html(result);
        });
    });

    $("#state_id").change(function () {
        var state_id = this.value;
        $.post("<?php echo base_url(); ?>manage/ajax/franchiseList__", {
            state_id: state_id
        }, function (result) {
            $("#franchise_id").html(result);
        });

        $.post("<?php echo base_url(); ?>manage/ajax/statewisearea", {
            state_id: state_id
        }, function (result) {
            $("#area").html(result);
        });
    });
    
    
    
    $("#product_name").change(function(){
        var product_name=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevelname/",
            data:{product_name:product_name},
            type: 'post',
            success:function(result){
                 $("#clevel").html(result);
        }});
    }); 
    
    
    $("#clevel").change(function(){
        var clevel=this.value;
        var product_name = $("#product_name").val();
        var period = $("#period").val();
        var franchise_id = $("#franchise_id").val();
        
        
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/getrevenuesettingcompetition/",
            data:{product_name:product_name,clevel:clevel,period:period,franchise_id:franchise_id},
            type: 'post',
            success:function(result){
                 $("#revenue_setting").html(result);
        }});
    }); 
    
});
</script>
