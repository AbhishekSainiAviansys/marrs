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
        border-radius:20px;
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
                            <h2>Search Students for Paid Study Material</h2>
                            </div> 
        <form method='post' class='table-responsive' >
                        <div style='display:flex;'>
                            <div id='div-sel' >
                                <h3><b>Area : </b></h3>
                                <select name="area" id="area" style="width: 130px;" >
                                    <option value=''>All Area</option>
                                    <?php
                                     foreach ($area as $row)
                                        {
                                        echo "<option value='{$row['area_code']}'>{$row['area_code']} - {$row['city_name']}</option>";
                                        
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            
                            <div id='div-sel' >
                                <h3><b>School : </b></h3>
                                <select name="school" id="school" style="width: 180px;" >
                                    <option value=''>All School</option>
                                    <?php
                    //                  foreach ($schools as $row)
                    // {
                    // echo "<option value='{$row['school_name']}'>{$row['school_name']}</option>";
                    
                    // }
                                    ?>
                                    
                                </select>
                            </div>
                            
                            <div id='div-sel' >
                                 <h3><b>Class : </b></h3>
                                <select name="class" id="class" style="width: 110px;"  required>
                                    <option style='display:none;'>Select Class</option>
                                    
                                     <option >All Class</option>
                                     
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM `class`;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->class_name}'>{$row->class_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
                            </div>
                            
                            <div id='div-sel' >
                                <h3><b>Products: </b></h3>
                                <select name="product" id="product" style="width: 200px;"  >
                                   <option style='display:none;'>Select Product</option>
                                    <!-- <option style='display:none;'><?php //if(!empty($period)){echo $period; }?></option>-->
                                   
                                     <?php
                                     
                                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY `product_id` DESC ;");
                                    
                                     foreach ($query->result() as $row)
                                    {
                                    echo "<option value='{$row->product_name}'>{$row->product_name}</option>";
                                    }
                                    
                                    ?>
                                </select>
                            </div>
                            
                            <div id='div-sel' >
                                <h3><b>Competition Level : </b></h3>
                                <select name="level" id="level" style="width: 130px;" >
                                   
                                </select>
                            </div>
                            
                        </div>  
                        <div style='display:flex;'>
                            <div id='div-sel' >
                                <h3><b>Material : </b></h3>
                                <select name="type" id="type" style="width: 130px;" >
                                   <option value='A'>Material-A</option>
                                   <option value='B'>Material-B</option>
                                   <option value='C'>Material-C</option>
                                </select>
                            </div>
                            
                            <div id='div-but' >
                            <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:40px;">
                            </div>
                        </div>    
        
    </div>
    <?php if(!empty($student)){ ?>
    <div id='corner' class='table-responsive' id='pad'>
        
        <div style='padding-left:10px;'><h3 style='color:green;'>Students List
        <?php
        $query = $this->db->query("SELECT level_name FROM competition_level_byproduct where level_id='{$result['level']}';");
        $l=$query->result()[0]->level_name;                            
        echo '- Level: '.$l.' School: '.$result['school'].' Product: '.$result['product']; ?>
        </h3></div>
        
        <input type='hidden' name='pro' value='<?php echo $result['product'];?>'>
        <input type='hidden' name='lev' value='<?php echo $result['level'];?>'>
        <input type='hidden' name='cla' value='<?php echo $result['class'];?>'>
        <input type='hidden' name='sch' value='<?php echo $result['school'];?>'>
        <input type='hidden' name='typ' value='<?php echo $result['type'];?>'>
        <input type='hidden' name='are' value='<?php echo $result['area'];?>'>
        <input type='hidden' name='l' value='<?php echo $l;?>'>
        
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
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level Name</th>
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Mother Name</th>-->
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Material Type</th>
                </tr>
            </thead>
            <body>
     
            <?php $i=1; foreach($student as $stud){  //print_r($stud);?>
                <tr>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['student_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_phone'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $l; ?></td>
                     <!--<td style="padding-top:10px; padding-bottom:10px;"><?php echo $stud['mother_name'];?></td>-->
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result['type'];?></td>
                </tr>
                
            <?php $i=$i+1;} ?>
               
            </body>
        </table>
    </div>
    <?php } ?>
    <?php if(empty($student)){ ?>
    <div style='text-align:center;'><h4>No Student found ...</h4></div>
    <?php } ?>
</div >   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">	

    $(document).ready(function() {
       // alert('ok');
        $("#area").change(function(){
            var area_code = this.value;
           // alert(this.value);
            $.ajax({
                url: "<?php echo base_url(); ?>franchise/ajax/school_list_",
                data: {area_code: area_code},
                type: 'post',
                success: function(result) {
                   $("#school").html(result);
                }
            });
        });
        
        $("#product").change(function(){
            var period_id = this.value;
           // alert(this.value);
            $.ajax({
                url: "<?php echo base_url(); ?>franchise/ajax/level_list_productwise_",
                data: {period_id: period_id},
                type: 'post',
                success: function(result) {
                   $("#level").html(result);
                }
            });
        });
        
        
    });


    

</script>		
		
			
</body>
		
		
<?php include('footer.php');?>