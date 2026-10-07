<?php include('header.php'); 
//echo $franchise;
?>
<style>
body{
    /*background-color:#f2f2f2;*/
}
    #corner{
        border:2px solid #fff;
        border-radius:20px;
        background-color:#fff;
        margin-left:90px;
        margin-right:90px;
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
    padding-left:50px;
}
#div-sel{
    padding-top:30px;
    padding-left:30px;
}
</style>
<body>
    <div id='corner' style='background-color:#f4f4f4;'>
        <div id='div' >
                            <h2>Schools List Search</h2>
                            </div> 
        <form method='post' class='table-responsive' style='display:flex;'>
                           <div id='div-sel' style='display:flex;'>
                                <h3><b>School Status : </b></h3>
                                <select name='status' id='status'>
                                    <option value=''>All</option>
                                    <option value='Dective'>De-Active</option>
                                    <option value='Active'>Active</option>
                                    
                                </select>
                            </div>
                            <div id='div-but' >
                            <input type="submit" id="submit" value="Submit" name="submit" class="btn btn-danger" style="color:#FFF;background: #0a3e6e; height:40px;">
                            </div>
                            
        
    </div>
    <?php if(!empty($school)){ 
   // print_r($school);
    ?>
    <div id='corner' class='table-responsive' id='pad'>
        <div style='color:black;padding-left:10px;'><h3>Students List</h3></div>
        
        <div align="right"> <button type="submit" class="btn btn-primary" id="Export" name="Export" >Export Excel</button></div>
        </form>
        <table  class="table table-bordered" style="">
            <thead>
                <tr style=" background:#333; color:#FFF;">
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
                    <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">School Name</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">School Code</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Username / Password</th>
                  <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Mobile Number</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Email</th>
                  <!--<th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Principal</th>-->
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">School Address</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Medium</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Board</th>
                  <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Status</th>
                  
                </tr>
            </thead>
            <body>
     
            <?php $i=1;foreach($school as $stud){   ?>
                <tr>
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_code'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['username'];?></td>
                      <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_mobile'];?></td>
                        <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_email'];?></td>
                    <!--<td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $stud['principal_first_name'].' '.$stud['principal_middle_name'];?></td>-->
                    <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $stud['school_address'].' '.$stud['school_address1'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_medium'];?></td>
                  
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_board'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $stud['school_status']; ?></td>
                </tr>
                
            <?php $i=$i+1;} ?>
               
            </body>
        </table>
    </div>
    <?php } ?>
    <?php if(empty($school)){ ?>
    <div style='text-align:center;'><h4>No School found ...</h4></div>
    <?php } ?>
</div >    
			
</body>
		
		
<?php include('footer.php');?>