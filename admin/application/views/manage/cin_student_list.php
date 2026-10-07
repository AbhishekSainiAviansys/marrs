<?php include('header.php'); 
//echo $franchise;
//print_r($result);
//print_r($student);
?>
<style>
body{
    /*background-color:#f2f2f2;*/
}
    #corner{
        border: 1px solid #fff;
        /*border-radius:20px;*/
        background-color:#fff;
        margin-left:10px;
        margin-right:10px;
        margin-top:20px;
    }
    @media (max-width:767px){
 #corner {
    /*border-radius: 20px;*/
    
    margin-left: 40px;
    margin-right: 40px;
 }
 #corner div{
     display:block;
     
 }
 #div{
    padding-left:0px;
    padding-left:0px;
    padding-top:0px;
}
}
#div{
    padding-left:30px;
    padding-left:30px;
    padding-top:30px;
}
.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}

@media screen and (max-width: 767px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: 1px solid #ddd;
    }
    .table-responsive > .table {
        margin-bottom: 0;
    }
    .table-responsive > .table > thead > tr > th,
    .table-responsive > .table > tbody > tr > th,
    .table-responsive > .table > tfoot > tr > th,
    .table-responsive > .table > thead > tr > td,
    .table-responsive > .table > tbody > tr > td,
    .table-responsive > .table > tfoot > tr > td {
        white-space: nowrap;
    }
}
#div-but{
    padding-top:50px;
    padding-left:130px;
}
#div-sel{
    padding-top:30px;
    padding-left:30px;
}
</style>
<body>
<div id='corner' style='background-color:#f4f4f4;'>
    <div id='div' >
        <h4>Search Students </h4>
        <!--<marquee>Only Paid Status is working for now.</marquee>-->
    </div> 
   
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
			<table  cellpadding="5px" class='container'>
				<tr>
            <td>
                Products: *<br>
                <select name="product" id="product_name" style="width: 220px;" >
                   <option  value=''>select Product</option>
                    <?php foreach($productload as $periodval) : ?>
                                    <option value="<?php echo $periodval['product_name'] ?>" <?php if(isset($result['product']) && $result['product'] == $periodval['product_name']) { echo "selected"; } ?>><?php echo $periodval['product_name'] ?></option>
                                    <?php endforeach; ?>

                </select>
            </td>
            <td>
                Competition Level: *<br>
                <select name="level" id="competition_level_id" style="width: 220px;" required>
                    <?php foreach($levelload as $periodval) : ?>
                                    <option value="<?php echo $periodval['level_id'] ?>" <?php if(isset($result['level']) && $result['level'] == $periodval['level_id']) { echo "selected"; } ?>><?php echo $periodval['level_name'] ?></option>
                                    <?php endforeach; ?>
                </select>
            </td>
            
            <td>
                Class: *<br>
                <select name="class" id="class" style="width: 220px;">
                    <option value=''>All Class</option>
                    <?php foreach($classload as $periodval) : ?>
                                    <option value="<?php echo $periodval['class_name'] ?>" <?php if(isset($result['class']) && $result['class'] == $periodval['class_name']) { echo "selected"; } ?>><?php echo $periodval['class_name'] ?></option>
                                    <?php endforeach; ?>
                </select>
            </td>
            
            
            
            <td>
                State: *</br>
                <select name="state" id="state" style="width: 220px;" required>
                     <option value='All' <?php  if($result['state_id']=='All') { echo 'selected="selected"'; } ?>>All state</option>
                    <?php foreach($stateload as $periodval) : ?>
                                    <option value="<?php echo $periodval['state_subdivision_id'] ?>" <?php if(isset($result['state']) && $result['state'] == $periodval['state_subdivision_id']) { echo "selected"; } ?>><?php echo $periodval['state_subdivision_name'] ?></option>
                                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                    Area: *<br>
                            <select name="area" id="area" style="width: 220px;" >
                            <option value=''>All Areas</option>
                      <?php foreach($areaload as $periodval) : ?>
                                    <option value="<?php echo $periodval['area_code'] ?>" <?php if(isset($result['area']) && $result['area'] == $periodval['area_code']) { echo "selected"; } ?>><?php echo $periodval['area_code'] ?></option>
                                    <?php endforeach; ?>
                     
                            </select>
                            
            </td>
            
            </tr>
            <tr>
            <td>
                       
                      School: *<br>
                            <select name="school" id="school" style="width: 220px;" >
                            <option value='All'>All school</option>
                     <?php foreach($schoolload as $periodval) : ?>
                                    <option value="<?php echo $periodval['school_name'] ?>" <?php if(isset($result['school']) && $result['school'] == $periodval['school_name']) { echo "selected"; } ?>><?php echo $periodval['school_name'].', '.$periodval['school_address1']; ?></option>
                                    <?php endforeach; ?>
                     
                            </select>
                            
            </td>
                                      
            
            <td><br>
                <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-warning btn-sm" >
            </td>
            
        </tr>
        </table>
        </div>
                          
            
        </div>
        
            
    <!--</form>-->
</div>
    
    <!--      ==============  ok  ================      -->

    <?php
    
    if(!empty($student)){  $i=1;?>
    
    <div id='corner' class='table-responsive' id='pad'>
         <div>
             <h5 style='color:green;'>
                 <?php 
                // print_r($result);
                 
                 ?>
             </h5>
         </div>
       <!--<form method='POST'>-->
            <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>
        
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">CIN</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Student Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">School_Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
                    <th  style="text-indent:15px; padding-top:10px; padding-bottom:10px;">Mobile Number</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Email</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Payment Status</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">State Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <body>
     
            <?php 
            //echo 'ok';
            
            foreach($student as $stud){  //print_r($stud);die;?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $stud['student_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_phone'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['level_name']; ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo 'Paid';?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['state_subdivision_name'];?></td>
                    
                    <td><a href='<?php echo base_url();?>manage/franchise/editcin/<?php echo $stud['id']; ?>' class='btn btn-primary'>Edit</a></td>
                    
                </tr>
                
            <?php $i=$i+1; } ?>
               </form>
            </body>
        </table>
    </div>
    <?php } ?>
    <?php if(!empty($message)){ ?>
    <div style='text-align:center;'><h4><?php echo $message; ?></h4></div>
    <?php } ?>
</div >    
</div>		
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src='<?php echo base_url();?>public/library/select2.min.js' type='text/javascript'></script>
		
<script type="text/javascript">		
    $("#state").change(function(){
        var state_id = this.value;
       // alert(franchise_id);
        $.ajax({
            url: "<?php echo base_url();?>manage/ajax/getAreaAjax__",
            data: {state_id: state_id},
            type: 'post',
            success: function(result) {
               // alert(result);
                $("#area").html(result);
            }
        });
    });
    
    $("#area").change(function(){
        var area_code = this.value;
       // alert(franchise_id);
        $.ajax({
            url: "<?php echo base_url();?>manage/ajax/school_list_",
            data: {area_code: area_code},
            type: 'post',
            success: function(result) {
               // alert(result);
                $("#school").html(result);
            }
        });
    });
    
    
    $("#product_name").change(function(){
        var product_id=this.value;
		//alert(state_id);
		var BASE_URL = "<?php echo base_url();?>";
        $.ajax({
            url:BASE_URL+"manage/ajax/productwiselevel_/",
            data:{product_id:product_id},
            type: 'post',
            success:function(result){
                 $("#competition_level_id").html(result);
        }});
    }); 
</script>
		
		
			
</body>





<?php include('footer.php');?>