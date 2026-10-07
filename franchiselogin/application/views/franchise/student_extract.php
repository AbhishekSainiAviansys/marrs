<?php include('header.php'); 
///echo $franchise_id;
//print_r($franchise_id);
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
                              Period : <br>
                                <select name="period" id="period" style="width: 220px;" required>
                                    <option value=''>select Period</option>
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM period;");
                                    
                                     foreach ($loadperiod as $row)
                                    {
                                  //  echo "<option value='{$row->period_id}'>{$row->period_name}</option>";
                                  
                                  ?>
                                   <option value="<?php echo $row['period_id'] ?>" <?php if(isset($result['period']) && $result['period'] == $row['period_id']) { echo "selected"; } ?>><?php echo $row['academic_year'] ?></option>
                                
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                            </td>
                            
                            <td id='period13'>
                               School : <br>
                                <select name="school13" id="school" style="width: 220px;"  >
                                    <option value=''>All School</option>
                                    
                                     <?php
                                     
                                   //  $query = $this->db->query("SELECT * FROM schools where franchise_id='$franchise_id';");
                                    
                                     foreach ($schoolload13 as $row)
                                    {
                                //    echo "<option value='{$row->school_code}'>{$row->school_name}</option>"; ?>
                                
                                <option value="<?php echo $row['school_name'] ?>" <?php if(isset($result['school_name']) && $result['school_name'] == $row['school_name']) { echo "selected"; } ?>><?php echo $row['school_name'] ?></option>
                                   <?php
                                    }
                                    
                                    ?>
                                </select>
                            </td>
                            
                            <td id='period12'>
                               School : <br>
                               <?php //print_r($schoolload12); ?>
                                <select name="school12" id="school" style="width: 220px;"  >
                                    <option value=''>All School</option>
                                    
                                     <?php
                                     
                                   //  $query = $this->db->query("SELECT * FROM schools where franchise_id='$franchise_id';");
                                    
                                     foreach ($schoolload12 as $row)
                                    {
                                //    echo "<option value='{$row->school_code}'>{$row->school_name}</option>"; ?>
                                
                                <option value="<?php echo $row['school_name'] ?>" <?php if(isset($result['school']) && $result['school'] == $row['school_name']) { echo "selected"; } ?>><?php echo $row['school_name'] ?></option>
                                   <?php
                                    }
                                    
                                    ?>
                                </select>
                            </td>
                            
                            <!--<div id='div'>-->
                            <!--    <input type="text" name="prid" style="height:40px;" placeholder='Enter PRID' required>-->
                            <!--</div>-->
                            
                             <td>
                                 Class : <br>
                                <select name="class" id="class" style="width: 220px;"  >
                                    <!--<option style='display:none;'>Select Class</option>-->
                                    
                                     <option value=''>All Class</option>
                                     
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `class`;");
                                    
                                     foreach ($classload as $row)
                                    {
                                    //echo "<option value='{$row->class_name}'>{$row->class_name}</option>";
                                     ?>
                                   <option value="<?php echo $row['class_name'] ?>" <?php if(isset($result['class']) && $result['class'] == $row['class_name']) { echo "selected"; } ?>><?php echo $row['class_name'] ?></option>
                                
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                            </td>
                            
                            </tr>
                            <tr> 
                            <td>
                                Products: <br>
                                <select name="product" id="product" style="width: 220px;"  >
                                   <option style='display:none;'>Select Product</option>
                                    <!--<option style='display:none;'><?php //if(!empty($period)){echo $period; }?></option>-->
                                    
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY `product_id` DESC ;");
                                    
                                     foreach ($productload as $row)
                                    {
                                   // echo "<option value='{$row->product_name}'>{$row->nomen}</option>";
                                     ?>
                                   <option value="<?php echo $row['product_name'] ?>" <?php if(isset($result['product']) && $result['product'] == $row['product_name']) { echo "selected"; } ?>><?php echo $row['product_name'] ?></option>
                                
                                  <?php
                                    }
                                    
                                    ?>
                                </select>
                            </td>
                            
                            <td>
                            <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-danger btn-sm" >
                            </td>
                         </tr>
        </table>   
        
    </div>
    <?php if(!empty($student)){ ?>
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
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Payment Status</th>-->
                </tr>
            </thead>
            <body>
     
            <?php 
            $i=1;
            foreach($student as $stud){ // print_r($stud);die;?>
                <tr>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style=" padding-bottom:10px; padding-top:10px;"><?php echo $stud['student_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php
                    if(!empty($stud['school_name'])){
                    echo $stud['school_name']; }else{
                        $ini13=$this->db->get_where('school_new',array('id'=>$stud['school_id']))->row_array();
                        echo $ini13['school_name'].' '.$ini13['city'];
                    }
                    
                    ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_mobile'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_address']; ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result['product'];?></td>
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