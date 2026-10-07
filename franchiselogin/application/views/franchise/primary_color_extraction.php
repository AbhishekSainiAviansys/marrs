<?php include('header.php'); 
//echo $franchise;
//print_r($student);
 //print_r($cla);
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
        <h2>Primary Colors Students </h2>
    </div> 
    <form method='post' class='table-responsive'>
        <div>
            <div style='display:flex;'>
                <div id='div-sel' style='display:flex;'>
                    <h4><b>Franchise: </b></h4>
                        <select name="franchise" id="franchise" style="width: 100px; "  required>
                            <!--<option style='display:none;'>Select Franchise</option>-->
                            <option value='All' >All Franchise</option>
                           <?php
                           
                           
                           $query1 = $this->db->query("SELECT * FROM `franchise_to_zoomzoom`;");
                    
                            foreach ($query1->result() as $row)
                                { ?> 
                              
                                        
                                      <option value='<?php echo $row->franchise_code;?>'<?php  if($fra==$row->franchise_code) { echo 'selected="selected"'; } ?>><?php echo $row->franchise_code.'-'.$row->franchise_name;?></option>
                                      
                                      
                                <?php } ?>
                        </select>
                </div>
                
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
                        <option value='All'>All Class</option>
                         
                         <?php
                         
                         $query = $this->db->query("SELECT * FROM `class`;");
                        
                         foreach ($query->result() as $row)
                        {//print_r($row);?>
                            
                        <option value='<?php echo $row->class_name; ?>' <?php if($cla==$row->class_name){echo 'selected="selected"';} ?>><?php echo $row->class_name; ?></option>
                        
                        <?php }
                        
                        ?>
                    </select>
                </div>
             </div>
           <div> 
                <div id='div-sel' style='display:flex;'>
                    
                    <h4><b>Competition : </b></h4>
                    <select name="status" id="status" style="width: 150px;"   required>
                        <option style='display:none;'>Select Level</option>
                        <option value='Paid' <?php if($status=='Paid'){echo 'selected="selected"';} ?>>Paid</option>
                        <!--<option value='2' <?php //if($sta==2){echo 'selected="selected"';} ?>>Level-2</option>-->
                       
                    </select>
                    
                    <div style='padding-left:50px;'>
                        <input type="submit" id="submit" value="Competition Student Extract" name="competition" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:26px;">
                    </div>
                    <div style='padding-left:50px;'> <input type="submit" class="btn btn-primary" id="Export" name="Export" value='CompetitionExport'>  </div>
                </div>
                                
                <div id='div-sel' style='display:flex;'>
                    <h4><b>Study Material: </b></h4>
                    <select name="study_material" id="study_material" style="width: 150px;" >
                        <option value='Yes' <?php if($study_material=='Yes'){echo 'selected="selected"';} ?> >Yes</option>
                        <!--<option value='No' <?php if($study_material=='No'){echo 'selected="selected"';} ?>>No</option>-->
                       
                    </select>
                    
                    <div style='padding-left:50px;'>
                        <input type="submit" id="submit" value="Study Material Student Extract" name="study_material" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:26px;">
                    </div> 
                    <div style='padding-left:50px;'> <input type="submit" class="btn btn-primary" id="Export" name="Export" value='StudyMAterialExport'>  </div>
                </div>
                
                <div id='div-sel' style='display:flex;'>
                    <h4><b>Orientation: </b></h4>
                    <select name="orientation" id="orientation" style="width: 150px;" >
                        <option value='Yes' <?php if($orientation=='Yes'){echo 'selected="selected"';} ?> >Yes</option>
                        <!--<option value='No' <?php if($orientation=='No'){echo 'selected="selected"';} ?>>No</option>-->
                       
                    </select>
                    
                     <div style='padding-left:50px;'>
                        <input type="submit" id="submit" value="Orientation Student Extract" name="orientation" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:26px;">
                    </div> 
                    <div style='padding-left:50px;'> <input type="submit" class="btn btn-primary" id="Export" name="Export" value='OrientationExport'>  </div>
                </div>
                
                <div id='div-sel' style='display:flex;'>
                    <h4><b>Mock Test: </b></h4>
                    <select name="mock_test" id="mock_test" style="width: 150px;" >
                        <option value='Yes' <?php if($mock_test=='Yes'){echo 'selected="selected"';} ?> >Yes</option>
                        <!--<option value='No' <?php if($mock_test=='No'){echo 'selected="selected"';} ?>>No</option>-->
                       
                    </select>
                    
                     <div style='padding-left:50px;'>
                        <input type="submit" id="submit" value="Mock Test Student Extract" name="mock_test" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:26px;">
                    </div> 
                    <div style='padding-left:50px;'> <input type="submit" class="btn btn-primary" id="Export" name="Export" value='MockExport'>  </div>
                </div>
                
                
                <!--<div id='div-but' >-->
                <!--    <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:40px;">-->
                <!--</div>-->
            </div>
        </div>
            
    </form>
</div>
    
    <!--      ==============  ok  ================      -->

    <?php if(!empty($student)){ ?>
    <div id='corner' class='table-responsive' id='pad'>
        <div style='color:black;padding-left:10px;'><h3>Students List</h3></div>
        <!--<form method='post' action='<?php echo base_url();?>manage/franchise/export_student_data'>-->
             <input name="sta" type="text" value="<?php echo $sta; ?>" style='display:none;'>
             <input name="per" type="text" value="<?php echo $per; ?>" style='display:none;'>
             <input name="cla" type="text" value="<?php echo $cla; ?>" style='display:none;'>
             <input name="le" type="text" value="<?php echo $le; ?>" style='display:none;'>
             <input name="fra" type="text" value="<?php echo $fra; ?>" style='display:none;'>
            <!--<div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>-->
        </form>
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">CIN</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Student </th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Franchise Code</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">School </th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
                    <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Mobile </th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Email</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Address</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product </th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Competition</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Study Material</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Orientation</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Mock Test</th>
                </tr>
            </thead>
            <body>
     
            <?php
            $i=1;
            foreach($student as $stud){  //print_r($stud);die;?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['cin'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $stud['student_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['franchise_code'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['class'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_phone'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['stud_email'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['address1']; ?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $status;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $study_material;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $orientation;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $mock_test;?></td>
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