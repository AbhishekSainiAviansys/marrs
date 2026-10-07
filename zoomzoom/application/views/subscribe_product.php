<?php include('student_left_menu.php'); 
// print_r($student_cart);die;
//  $query2 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Paid' ;");

?>
<style>
body{
    background-color:#fff0b3;
margin:0;
padding:0;
}

td{
    background-color:#6600ff;
    color:#fff;
}
#corner{
    background-color:white;
    border-radius:20px;
    margin-left:250px;
    margin-right:250px;
    padding-top:0px;
    /*padding-bottom:20px;*/
    font-size:18px;
    color:#3385ff;
}
@media (max-width:767px){
    #product h1{
       font-size:15x; 
    }
    #corner{
        margin:0;
        padding:0;
        width:100%;
    }
    #product{
        width:100%;
    }
}
</style>

<div style='padding-top:20px;'>
    <div id='product' id='h' >
        <h3>Subscribed Learning programmes</h3>
    </div>
</div>
<DIV style='padding-top:20px;'></DIV>
<div id='corner' >
    <table  class="table table-bordered" style="border:none; font-family:Verdana, Geneva, sans-serif; width:100%;">
        <thead>
        <tr style=" background:#333; color:#FFF;">
            <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Sr. No.</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px; ">Product Name</th>
          <th  style=" text-indent:15px;padding-top:10px; padding-bottom:10px;">Class</th>
          <th  style=" text-indent:15px; padding-top:10px; padding-bottom:10px;">Status</th>
        </tr>
      </thead>
      <body>
         
          <?php $i=0; foreach($student_cart as $row){ 
        //   print_r($row);die;
          $i=$i+1?>
            <tr>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php echo $i;?></td>
                <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;"><?php print_r($row->product_name);?></td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->class_name);?></td>
                <td style=" padding-top:10px; padding-bottom:10px;"><?php print_r($row->payment_status);?></td>
            </tr>
            <?php } ?>
           
           
            
      </body>
    </table>
    
</div>