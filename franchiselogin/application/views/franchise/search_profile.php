<?php include('header.php'); 
///echo $franchise_id;
// print_r($result['type']);
?>
<style>
body{
    /*background-color:#f2f2f2;*/
}
    #corner{
        border:2px solid #fff;
        /*border-radius:20px;*/
        background-color:#fff;
        margin-left:30px;
        margin-right:30px;
        margin-top:20px;
    }
    @media (max-width:767px){
 #corner {
   width: 100%; 
   height: 200px; 
   margin-left:0;
   margin-top:20px;
   padding-bottom:20px;
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
    padding-top:25px;
    padding-left:30px;
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
                            </div> 
        <form method='post' class='table-responsive' style='display:flex;'>
            
            <table  cellpadding="5px" class='container'>
				<tr>
                            <td>
                              Type : <br>
                                <select name="type" id="type" style="width: 220px;" required>
                                    <option value='' >Select Type</option>
                                    <option value='cin' <?php if(isset($result) && $result['type']=='cin' ){?> selected=selected <?php } ?>>CIN</option>
                                    <option value='mobile' <?php if(isset($result) && $result['type']=='mobile' ){?> selected=selected <?php } ?>>Mobile</option>
                                    <option value='email' <?php if(isset($result) && $result['type']=='email' ){?> selected=selected <?php } ?>>Email</option>
                                </select>
                            </td>
                            
                            <td >
                                Enter Value : <br>
                                <input type="text" id="" value="<?php if(isset($result['value'])){echo $result['value'];} ?>" name="value" style="width: 220px;"  required>
                            </td>
                            
                            <td>
                            <input type="submit" id="submit" value="Search" name="submit" class="btn btn-danger btn-sm" >
                            </td>
                         </tr>
        </table>   
        
    </div>
    <?php if(!empty($cin_list)){ ?>
    <div id='corner' class='table-responsive' id='pad'>
        <div style='color:black;padding-left:10px;'><h3>Students List</h3></div>
        <input type='hidden' name='12school' value='<?php echo $result['school12']; ?>' >
        <input type='hidden' name='13school' value='<?php echo $result['school13']; ?>' >
        <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>
        </form>
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">CIN</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Student Name</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">School Name</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
                  <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Mobile Number</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Email</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Address</th>
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>-->
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Payment Status</th>-->
                </tr>
            </thead>
            <body>
     
            <?php 
            $i=1;
            foreach($cin_list as $stud){ //print_r($stud);die;?>
                <tr>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style=" padding-bottom:10px; padding-top:10px;"><?php echo $stud['student_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php
                    // if(!empty($stud['school_name'])){
                    echo $stud['school_name']; 
                        
                    // }else{
                    //     $ini13=$this->db->get_where('school_new',array('id'=>$stud['school_id']))->row_array();
                        // echo $ini13['school_name'].' '.$ini13['city'];
                    // }
                    
                    ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_phone'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['address1']; ?></td>
                    <!--<td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result['product_name'];?></td>-->
                    <!--<td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['payment_status'];?></td>-->
                </tr>
                
            <?php $i=$i+1;} ?>
               
            </body>
        </table>
    </div>
    <?php } ?>
    <?php if(!empty($message)){ ?>
    <div style='text-align:center;'><h4><?php echo $message; ?></h4></div>
    <?php } ?>
</div >    
			
</body>
		
		
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#period12').hide();
    $('#period13').hide();

    $('#period').change(function() {
        var periodValue = $(this).val();
        
        if (periodValue > 12) {
            $('#period13').show();
            $('#period12').hide();
        } else if (periodValue == 12) {
            $('#period12').show();
            $('#period13').hide();
        } else {
            $('#period12').hide();
            $('#period13').hide();
        }
    });
});
</script>

	
		
<?php include('footer.php');?>