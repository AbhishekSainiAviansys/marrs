<?php include('header.php'); ?>
<style>
    .checks input, select {
    height: 15px;
} 
</style>

    <div class="container-fluid mx-3">
        <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL?>student/">Franchise</a> <span class="divider">/</span></li>
            <li><a href="<?php echo SITE_URL?>student/<?php echo ($studentID>0)?'edit':'add';?>/"><?php echo ($studentID>0)?'Edit':'Add';?></a></li>
        </ul>
    </div>
<?php echo $this->notifications->display_html();?>


<div class="container-fluid">

<div class="box span12 mb-5">

    <div class="box-header well">
        <h2><i class="icon-edit"></i> Franchise <?php echo ($studentID>0)?'Edit':'Add';?></h2>
    </div>

    <div class="box-content">

        <form class="form-horizontal border rounded" method="POST" enctype="multipart/form-data">

                <!-- ================= CONTACT DETAILS ================= -->
                <div class="row section-divider">
                    <div class="col-12 info text-danger">Contact Details</div>
                </div>

                <div class="row">

                    <!-- Country -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Country <span style="color:red">*</span></label>
                        <select name="country_id" id="country_id" class="form-control">
                            <?php foreach($country as $val){ ?>
                                <option value="<?php echo $val['country_id'];?>"
                                    <?php if($val['country_id']==$result['country_id']) echo 'selected'; ?>>
                                    <?php echo $val['country_name'];?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- State -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>State/Province <span style="color:red">*</span></label>
                        <select name="state_id" id="state_id" class="form-control">
                            <option value="">Select State</option>
                        </select>
                    </div>

                    <!-- Area -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
    <label class="fw-semibold mb-1">Area</label>

    <div id="area" class="border rounded p-3 bg-light checks" style="max-height:220px; overflow-y:auto;">

     <?php foreach($areas as $val){ ?>

    <div class="form-check d-flex align-items-center mb-2">
        
        <input 
            type="checkbox" 
            name="area[]" 
            class="form-check-input me-2"
            value="<?php echo $val['id']; ?>"
            id="area_<?php echo $val['id']; ?>"
        >

        <label class="form-check-label" for="area_<?php echo $val['id']; ?>">
            <?php echo $val['area_code']; ?> -> <?php echo $val['area_name']; ?>
        </label>
        <br>
        <hr>

    </div>

<?php } ?>

    </div>
</div>

                    <!-- Address 1 -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Address Line1 <span style="color:red">*</span></label>
                        <input class="form-control" id="school_address" name="address" type="text"
                            value="<?php if(isset($result['company_address'])) echo $result['company_address']; ?>">
                    </div>

                </div>


                <!-- ================= ROW 2 ================= -->
                <div class="row">

                    <!-- Address 2 -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Address Line2</label>
                        <input class="form-control" name="address1" type="text"
                            value="<?php if(isset($result['company_address1'])) echo $result['company_address1']; ?>">
                    </div>

                    <!-- Franchise Type -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Franchise Type</label>
                        <select class="form-control" name="franchise_type">
                            <option value="1">Super Franchise</option>
                            <option value="2">National Franchise</option>
                            <option value="3">State Franchise</option>
                            <option value="4">District Franchise</option>
                        </select>
                    </div>

                    <!-- Franchise Ref -->
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Franchise Ref</label>
                        <input class="form-control" name="franchise_ref" type="text"
                            value="<?php if(isset($result['franchise_ref'])) echo $result['franchise_ref']; ?>">
                    </div>

                </div>


                <!-- ================= PERSONAL INFO ================= -->
                <div class="row section-divider">
                    <div class="col-12 info text-danger">Personal Information</div>
                </div>

                <div class="row">

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="frenchise_first_name"
                            value="<?php if(isset($result['franchise_first_name'])) echo $result['franchise_first_name']; ?>">
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="frenchise_last_name"
                            value="<?php if(isset($result['franchise_last_name'])) echo $result['franchise_last_name']; ?>">
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Mobile Number</label>
                        <input class="form-control" name="mobile_number" type="text"
                            value="<?php if(isset($result['mobile_number'])) echo $result['mobile_number']; ?>">
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Company Email</label>
                        <input class="form-control" name="company_email_id" type="email"
                            value="<?php if(isset($result['company_email_id'])) echo $result['company_email_id']; ?>">
                    </div>

                </div>


                <!-- ================= COMPANY ================= -->
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label>Company Name</label>
                        <input class="form-control" name="company_name" type="text"
                            value="<?php if(isset($result['company_name'])) echo $result['company_name']; ?>">
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <label>Franchise Status</label>
                        <select class="form-control" name="franchise_status">
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>

                </div>


                <!-- ================= PRODUCTS ================= -->
                <div class="row section-divider">
                    <div class="col-12 info text-danger">MaRRS Learning Programs</div>
                </div>

                <div class="row">

                    <div class="col-12">

                        <input type="hidden" value="<?php echo $result['franchise_id'];?>" id="fid">

                        <div class="row">

                            <?php
                            $fid = $result['franchise_id'];

                            $this->db->select('*');
                            $this->db->from('products');
                            $this->db->join('product_allotted_fr','product_allotted_fr.product_id=products.product_id');
                            $this->db->where('product_allotted_fr.franchise_id',$result['franchise_id']);
                            $this->db->where('product_allotted_fr.status','Active');
                            $res = $this->db->get();
                            $products = $res->result_array();

                            foreach($products as $val){
                            ?>

                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">

                                <label>
                                    <input type="checkbox" name="product_id[]" value="<?php echo $val['product_id'];?>">
                                    <?php echo $val['product_name'];?>
                                </label>

                                <select name="product_price[]" class="form-control mt-2">
                                    <?php
                                    $this->db->select('price_codegenration.id,price_codegenration.price_code');
                                    $this->db->from('price_codegenration');
                                    $this->db->join('franchise_to_pricecode','franchise_to_pricecode.pricecode_id=price_codegenration.id');
                                    $this->db->where('franchise_to_pricecode.franchise_id',$fid);
                                    $this->db->where('franchise_to_pricecode.product_id',$val['product_id']);
                                    $price = $this->db->get()->result_array();

                                    foreach($price as $value){ ?>
                                        <option value="<?php echo $value['id'];?>">
                                            <?php echo $value['price_code'];?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <!-- ================= BUTTONS ================= -->
               <div class="row">
    <div class="col-12 d-flex gap-2 mt-3">
        <input type="submit" class="btn btn-primary w-50" value="Submit" name="submit">
        <a href="https://marrs.in/admin/manage/index/" class="btn btn-secondary w-50" type="button">Cancel</a>
    </div>
</div>

        </form>

    </div>
</div>

</div>
  <!--END OF class- row-fluid sortable" DIV-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$("#country_id").change(function(){
		   
		//alert(this.value);
        var country_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/getstateAjax/",
            data:{country_id:country_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#state_id").html(result);
        }});
    }); 
	
	$("#state_id").change(function(){
		   
		//alert(this.value);
        var state_id=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/getAreaAjax/",
            data:{state_id:state_id},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#area").html(result);
        }});
    }); 
	
	$("#district").change(function(){
		   
		//alert(this.value);
        var district=this.value;
        $.ajax({
            url: "<?php echo base_url();?>"+"manage/ajax/getAreaAjax/",
            data:{district:district},
            type: 'post',
            success:function(result){
				// alert(result);
                 $("#district").html(result);
        }});
    });
</script>
 
<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                var id = $(this).val();
               var dataid = $('#fid').val();
               //alert(dataid);
                	$.ajax({
                           	url:BASE_URL+"manage/franchise/productActiveDeactive/",
                            type:'post',
                            data:{ 'id' : id, 'fid' : dataid },
                            success:function(data){
                            			
                             }
                        	}); 
                
            }
            else if($(this).prop("checked") == false){
               var id = $(this).val();
               var dataid = $('#fid').val();
               //alert(dataid);
                	$.ajax({
                           	url:BASE_URL+"manage/franchise/productActiveDeactive/",
                            type:'post',
                            data:{ 'id' : id, 'fid' : dataid },
                            success:function(data){
                            			
                             }
                        	}); 
            }
        });
    });
</script>

<?php include('footer.php'); ?>
