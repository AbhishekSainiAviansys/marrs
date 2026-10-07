<?php include('header.php'); 
//echo $franchise;
//print_r($student);
// print_r($per);
//  $cla;
// 	        $per;
// 	        $sta;
// 	         $fra;
?>
<style>
body{
    /*background-color:#f2f2f2;*/
}
    #corner{
        border:2px solid #fff;
        border-radius:20px;
        background-color:#fff;
        margin-left:10px;
        margin-right:10px;
        margin-top:20px;
    }
    @media (max-width:767px){
 #corner {
    border-radius: 20px;
    
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
        <h2>Search Students Purchased Mock Test</h2>
    </div> 
    <form method='post' class='table-responsive'>
        <div style='display:flex;'>
            <div id='div-sel' style='display:flex;'>
                <h4><b>Franchise: </b></h4>
                    <select name="franchise" id="franchise" style="width: 120px; "  required>
                        <option value='All'>All Franchise</option>
                        
                       <?php
                       
                       
                       $query1 = $this->db->query("SELECT * FROM `franchise_to_zoomzoom`;");
                
                        foreach ($query1->result() as $row)
                            { ?> 
                          
                                    
                                  <option value='<?php echo $row->franchise_id;?>'<?php  if($fra==$row->franchise_id) { echo 'selected="selected"'; } ?>><?php echo $row->franchise_code.'-'.$row->franchise_name;?></option>
                                  
                                  
                            <?php } ?>
                    </select>
            </div>
            
            
            <!--<div id='div-sel' style='display:flex;'>-->
            <!--    <h4><b>School: </b></h4>-->
            <!--    <select name="school[]" id="school"  multiple='multiple' style="width: 260px;" required>-->
                   
            <!--    </select>-->
            <!--</div>-->
            
            
            <div id='div-sel' style='display:flex;'>
                <h4><b>Period: </b></h4>
                <select name="period" id="period" style="width: 100px; height:25px;" required>
                    <option style='display:none;'>Select Period</option>
                    <?php
                     $query = $this->db->query("SELECT * FROM period;");
                    
                     foreach ($query->result() as $row)
                     {?>
                         
                     <option value='<?php echo $row->period_id; ?>' <?php if($per==$row->period_id){echo 'selected="selected"';} ?>> <?php echo $row->period_name; ?></option>
                     
                     <?php }
                    ?>
                </select>
            </div>
            <div id='div-sel' style='display:flex;'>
                <h4><b>Class: </b></h4>
                <select name="class" id="class" style="width: 100px; " >
                    <option value=''>All Class</option>
                     
                     <?php
                     
                     $query = $this->db->query("SELECT * FROM `class`;");
                    
                     foreach ($query->result() as $row)
                    {?>
                        
                    <option value='<?php echo $row->class_id; ?>' <?php if($cla==$row->class_id){echo 'selected="selected"';} ?>><?php echo $row->class_name; ?></option>
                    
                    <?php }
                    
                    ?>
                </select>
            </div>
        
        
            <div id='div-sel' style='display:flex;'>
                <h4><b>Competition Level: </b></h4>
                <select name="level" id="level" style="width: 80px;"   required>
                   <!--<option style='display:none;'>Select Level</option>-->
                    <option value='1' <?php if($cl==1){echo 'selected="selected"';} ?>>Level-1</option>
                    <option value='2' <?php if($cl==2){echo 'selected="selected"';} ?>>Level-2</option>
                     <?php
                     
                    //  $query = $this->db->query("SELECT * FROM competition_levels where status='Active';");
                    
                    //  foreach ($query->result() as $row)
                    // {
                    // echo "<option value='{$row->id}'>{$row->level_name}</option>";
                    // }
                    
                    ?>
                </select>
            </div>
                            
            <div id='div-sel' style='display:flex;'>
                <h4><b>Product: </b></h4>
                <select name="product" id="product" style="width: 180px;" >
                    <!--<option value='Paid' <?php if($pro=='Paid'){echo 'selected="selected"';} ?> >Paid</option>-->
                    <!--<option value='Un Paid' <?php if($pro=='Un Paid'){echo 'selected="selected"';} ?>>Un Paid</option>-->
                   
                    
                     <?php
                     
                     $query = $this->db->query("SELECT * FROM products where status='Active' ORDER BY `product_id` DESC;");
                    
                     foreach ($query->result() as $row)
                    { ?>
                         <option value='<?php echo $row->zoomzoom_product_name;?>'<?php  if($pro==$row->zoomzoom_product_name) { echo 'selected="selected"'; } ?>><?php echo $row->zoomzoom_product_name;?></option>
                                  <?php
                   // echo "<option value='{$row->zoomzoom_product_name}' >{$row->zoomzoom_product_name}</option>";
                    }
                    
                    ?>
                </select>
            </div>
            <div id='div-but' >
                <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:40px;">
            </div>
        </div>
        
            
    <!--</form>-->
<!--</div>-->
    
    <!--      ==============  ok  ================      -->

    <?php if(!empty($student)){ ?>
    <div id='corner' class='table-responsive' id='pad'>
        <div style='color:black;padding-left:10px;'><h3>Students List</h3></div>
        <!--<form method='post' action='<?php echo base_url();?>manage/franchise/export_student_data'>-->
             <input name="pro" type="text" value="<?php echo $pro; ?>" style='display:none;'>
             <input name="per" type="text" value="<?php echo $per; ?>" style='display:none;'>
             <input name="cla" type="text" value="<?php echo $cla; ?>" style='display:none;'>
             <input name="le" type="text" value="<?php echo $le; ?>" style='display:none;'>
             <input name="fra" type="text" value="<?php echo $fra; ?>" style='display:none;'>
            <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>
        </form>
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">PRID</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Student Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Franchise Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
                    <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Mobile Number</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Email</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Address</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">CIN</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Payment Status</th>
                </tr>
            </thead>
            <body>
     
            <?php
            $i=1;
            foreach($student as $stud){  //print_r($stud);?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['zoomzoom_prid'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $stud['first_name'].' '.$stud['middle_name'].' '.$stud['last_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['franchise_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['mobile'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['address_line']; ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo "Paid";?></td>
                </tr>
                
            <?php $i=$i+1; } ?>
               
            </body>
        </table>
    </div>
    <?php } ?>
    <?php if(empty($student)){ ?>
    <div style='text-align:center;'><h4>No Student found ...</h4></div>
    <?php } ?>
</div >    
			
</body>

<?php include('footer.php');?>