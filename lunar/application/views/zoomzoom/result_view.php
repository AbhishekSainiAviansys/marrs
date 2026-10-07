 <style> 
.over{
    overflow-x:hidden;
}
	 </style>
	 
	 <?php include "header_profile.php";
//print_r($zoomzoom);
if($student[0]['class_key']==1){
    $state='Kinder Garten Products';
}else{
    $state='Class-1 to Class-12 Products';
}

$array1=array();
$array2=array();
$array3=array();
$array1=$purchase[0];$array2=$purchase[1];$array3=$purchase[2];

 //print_r($array2);
?>
<div class='over' class='container'>
    <centre style='text-align: center;'>
       <b><h1 style='font-weight:700;color:#004de6;padding-top:30px;'>SCHOOL LEVEL RESULT  <?php print_r($student['period_name']);?></h1></b> 
       
    </centre>
    <div class='row' style='padding-top:30px;'>        
        <div class='col-sm-4' style="padding-left:20px;padding-right:20px;" >
             
             
               <table  class="table table-bordered" >
                   <thead>
                       <tr style=" background:#333; color:#FFF;">  
                           <th style="width:30%"> </th>
                           <th>Student Profile</th>
                       </tr>
                   </thead>
                   
                    <body>
                    
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>PRID</th><th><?php echo $student_data['zoomzoom_prid']; ?> </th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>Student Name</th><th><?php echo $student_data['first_name'].' '.$student_data['middle_name'].''.$student_data['last_name'];?></th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>Class</th><th><?php echo $student_data['class'];?></th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>Father Name</th><th><?php echo $student_data['father_name'];?></th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>Mother Name</th><th><?php echo $student_data['mother_name'];?></th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>DOB</th><Th><?php echo $student_data['dob'];?></Th></tr>
                        <tr style=" background:#1a1aff; color:#ccffff;">    <th>Address</th><th><?php echo $student_data['address_line'].' '.$student_data['city'].' '.$student_data['state'];?></th></tr>

                        
                    </body>
            
            </table>
              
        </div>
        
        
        <div class='col-sm-8' style="padding-left:20px;padding-right:20px;overflow-x: auto;">
            
            
             
        <!--<h4 style="padding-bottom: 10px;">Congratulations, you are qualified to participate in the MaRRS Zoom Zoom National Championship.</h4>-->
            <table  class="table table-bordered" >
                    <thead>
                        <tr style=" background:#333; color:#FFF;">
                            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Level Name</th>
                            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">CIN</th>
                            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
                             <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Status</th>
                           <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Grade</th>
                           <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Marks</th>
                           <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Rank</th>
                           <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; "> Certificate</th>
                        </tr>
                    </thead>
            <body>
                <!--  =========================================================  -->
               
                <?php if(!empty($array1)){
                   //  print_r($array1);
                 $result = $this->db->get_where('zoomzoom_result',array('cin' =>$array1['cin'],'clevel'=>$array1['level_id']))->result_array();
                 //echo $this->db->last_query();
                 
                 //print_r($result);
                 if(!empty($result)){
                     if($result[0]['clevel']==1){$lv= 'School Championship';$nl='National Championship.';}
                ?>
                <?php if($result[0]['status']=='Q'){
               ?>
                  <!--<h4 style="padding-bottom: 10px;">Congratulations!!! you are qualified to participate in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> </h4>-->
                  
                  <tr style='background-color:#eeffcc;'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/zoomcertificate/<?php echo $result[0]['cin'];?>">Certificate</a></td>
                
                 </tr>
                  
                  <?php }else{ ?>
                    <h4 style="padding-bottom: 10px;color:crimson;">Thanks for participating in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> <span style='color:crimson'>Better Luck Next Time.</span> </h4>
                    <tr style='background-color:#eeffcc;'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/zoomcertificate/<?php echo $result[0]['cin'];?>">Certificate</a></td>
                
                 </tr>
                  <?php } ?>
                 
               
             
              <?php } }?>
              
              
              
               <!--  =========================================================  -->
                <?php if(!empty($array2)){
                    
                 $result = $this->db->get_where('zoomzoom_result',array('cin' =>$array2['cin'],'clevel'=>'1'))->result_array();
                 $result = $this->db->get_where('cin_result',array('cin' =>$cin,'clevel'=>'15'))->result_array();
                 
                 $level = $this->db->get_where('competition_level_byproduct',array('level_id'=>'15'))->row_array();
                 $lv=$level['level_name'];
                 
                 
                 
                // print_R($level);
                 if(!empty($result)){
                     if($result[0]['clevel']==1){$lv= 'School Championship';$nl='National Championship.';}
                ?>
                <?php if($result[0]['status']=='Q'){
               ?>
                  <!--<h4 style="padding-bottom: 10px;">Congratulations!!! you are qualified to participate in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> </h4>-->
                  
                  <tr style='background-color:#eeffcc;'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/download_certificate/<?php echo '15'?>">Certificate</a></td>
                
                 </tr>
                  
                  <?php }else{ ?>
                    <h4 style="padding-bottom: 10px;color:crimson;">Thanks for participating in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> <span style='color:crimson'>Better Luck Next Time.</span> </h4>
                    <tr style='background-color:#eeffcc;'>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/zoomcertificate/<?php echo $result[0]['cin'];?>">Certificate</a></td>
                
                 </tr>
                  <?php } ?>
                 
               
             
              <?php } }?>
              
               <!--  =========================================================  -->
                <?php if(!empty($array3)){
                    
                 $result = $this->db->get_where('zoomzoom_result',array('cin' =>$array3['cin'],'clevel'=>'1'))->result_array();
                 
                 if($result[0]['clevel']==1){$lv= 'School Championship';$nl='National Championship.';}
                 
                 if(!empty($result)){
                ?>
                <?php if($result[0]['status']=='Q'){?>
                  <!--<h4 style="padding-bottom: 10px;">Congratulations!!! you are qualified to participate in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> </h4>-->
                   <tr style='background-color:#ffcce6;'>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                   <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/zoomcertificate/<?php echo $result[0]['cin'];?>">Certificate</a></td>
                
                 </tr>
                  
                  <?php }else{ 
                  
                  ?>
                   <h4 style="padding-bottom: 10px;color:crimson;">Thanks for participating in the <span style='color:#33cc33;'><?php echo $result[0]['product_name'].' '.$nl; ?></span> <span style='color:crimson'>Better Luck Next Time.</span> </h4>
                   
                  <tr style='background-color:#ffcce6;'>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $lv;?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['cin'];?></td>
                    <td style="padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['product_name'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['status'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['grade'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['marks'];?></td>
                    <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $result[0]['rank'];?></td>
                   <td style=" padding-top:10px; padding-bottom:10px;"><a class="btn btn-primary" href="<?php echo base_url();?>zoomzoom/zoomcertificate/<?php echo $result[0]['cin'];?>">Certificate</a></td>
                
                 </tr>
                  <?php } ?>
                
                
                 
                
              <?php } }?>
             
                
                
            </body>
        </table>
      <form method='POST'>
                    <button name='back' class='btn btn-warning'>← To Profile</button>
                </form>
              
        </div>         
                
    </div>        
</div>
          
<?php include "footer.php"?>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          