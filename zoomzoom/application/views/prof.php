
 <style>
      a.btn.btn-danger.Reg_proceed {
        background-color: #dc3545;
        -webkit-border-radius: 60px;
        border-radius: 60px;
        
        cursor: pointer;
        display: inline-block;
        
        text-decoration: none;
		animation: glowing 1300ms infinite;
      }
      @keyframes glowing {
        0% {
          background-color: #dc3545;
          box-shadow: 0 0 5px #dc3545;
        } 
        50% {
          background-color: #dc3545;
          box-shadow: 0 0 20px #dc3545;
        }
        100% {
          background-color: #dc3545;
          box-shadow: 0 0 5px #dc3545;
        }
      }
      .a.btn.btn-danger.Reg_proceed {
        animation: glowing 1300ms infinite;
      }
    </style>
<?php include('student_header.php');
//$pri=$this->session->userdata('cart');
//print_r($pri);
foreach ($student as $row){
    $prid=$row->PRID;
    $name=$row->first_name.' '.$row->middle_name.' '.$row->last_name;
    $mname=$row->mother_name;
    $fname=$row->father_name;
    $address=$row->class;
    $school=$row->school_code;
    $prid=$row->PRID;
}
$query2 = $this->db->query("select school_name,school_address FROM school_new where school_code='$school' ;");
    
     foreach ($query2->result() as $row)
    {
    $school_name=$row->school_name;
    $school_address=$row->school_address;
    }
    $query = $this->db->query("select * FROM period WHERE status='Active' ;");
    
     foreach ($query->result() as $row)
    {
    $period=$row->period_id;
    }
    $query1 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Unpaid';");
    $query2 = $this->db->query("select * FROM cart WHERE prid='$prid' and payment_status ='Paid' ;");
                          
?>

<body>

<!--<div style='padding-top:20px;display:flex;'>-->
<!--    <div id='product' >-->
<!--        <h1>Student Profile View</h1>-->
<!--    </div>-->
    
<!--</div>-->
    <!-- =================== Form Start ===================== -->
  <?php $this->db->select('*');
            $this->db->from('student_result');
            $this->db->where('PRID', $_SESSION['prid']);
             $this->db->where('clevel','1');
            $query = $this->db->get();
			//echo current_url();exit;  
            $arrrr=$query->row();
          if($arrrr->result=='Q'){
            ?>
            
<div class='col-md-3 sidenav' style="margin-top: 10px;font-size: 18px; margin-left: 20px;"><a href="<?php echo base_url();?>welcome/not/id/<?php echo $prid; ?>"> Registration Inter-School Level  </a></div>
<?php } ?>
<!--<div style='text-align:center;color:#ff9900;padding-bottom:20px;'><h2><?php $this->session->flashdata('message');?></h2>-->
<!--        <marquee><h4>Please note down your PRID (Participent Registration Number) for student login. Also PRID has been sent to your e-mailbox.</h4></marquee> -->
<!--    </div>-->
<!--<div style='font-size:18px;' id='corner'>-->
<!--    <form method='post' action=''>    -->
<!--    <table class="table table-bordered" style=" width:100%;">-->
<!--      <thead>-->
<!--        <tr style=" background:#333; color:#FFF;text-align-center;">-->
      
<!--          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Student Details</th>-->
<!--          <th colspan="1" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;"><div style='' >-->
<!--                                    <button type="submit" name="edit" id="submit" class="btn btn-primary" style='width:35%;height:40px;background-color:#ff6600;font-size:20px;' value='<?php echo $prid; ?>'>Edit Profile</button> -->
<!--                            </div>-->
<!--        </tr></th>-->
          
<!--      </thead>-->
<!--      <tbody>-->
        
<!--        <tr style="background:#f6e2ff;">-->
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">PRID</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $prid; ?></td>-->
<!--        </tr>-->
<!--        <tr style="background:#fee5b9;">-->
       
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Name</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $name; ?></td>-->
<!--        </tr>-->
<!--        <tr style="background:#effeb9;">-->
         
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Class</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $address; ?></td>-->
<!--        </tr>-->
<!--      <tr style="background: #C7D1FA;">-->
         
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">School Code</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $school; ?></td>-->
<!--       </tr>-->

<!-- <tr style="background: #8FDAAA;">-->
         
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Father Name</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:  </td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $fname; ?></td>-->
<!--       </tr>-->
<!--<tr style="background:#e2f4ff; border-left:none;">-->
         
<!--          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Mother Name</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
<!--          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $mname; ?></td>-->
<!--        </tr>-->

<!--      </tbody>-->
<!--     </table>-->

    <!--<from method='post' >-->
    
<!--    </from>-->


<!--</div>-->
<!--<div id='outer'>    -->
<!--    <div id='inner'>-->
<!--        <a href="<?php echo base_url();?>welcome/product_purchase/id/<?php echo $prid; ?>" style='text-decoration:none;font-size:26px;'>PROCEED TO REGISTER</a>-->
<!--    </div>-->
<!--</div>-->

<div style='font-size:18px;' id='corner'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12 col-md-12 col-lg-12'>
                <form method='post' action='' style=''>  
        
    <table class="table table-bordered table-responsive table-striped col-12" style=" width:100%;">
      <thead>
        <tr style="border:0px;border-width: 0px;">
             <th colspan="1" class="text-end" style="border-width: 0px;position: absolute;
    right: 5px;">
                                
<a href="<?php echo base_url();?>product_purchase" style="position: relative;left: 2%;top:-10px" class="btn btn-danger Reg_proceed"><span>PROCEED TO REGISTER</span> </a>      
             </th>    
              <th colspan="1" class="text-end" style="border-width: 0px;"> 
        <button type="submit" name="edit" id="submit" class="btn btn-outline-danger" value='<?php echo $prid; ?>' style="position: relative;top: 50px;color: #fff;"><i class="fa-solid fa-user-pen"></i>&nbsp;Edit Profile</button> 
</th>
</tr><tr style=" background:#333; color:#FFF;">
          <th colspan="2" style=" text-indent:15px; padding-bottom:10px; padding-top:10px;">Student Details</th>
        </tr>
          
      </thead>
      <tbody>
        
        <!--<tr >-->
        <!--  <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">PRID</td>-->
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
        <!--  <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $prid; ?></td>-->
        <!--</tr>-->
        <!--<tr >-->
       
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Name</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $name; ?></td>
        </tr>
        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Class</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $address; ?></td>
        </tr>
        

        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Father Name</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:  </td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $fname; ?></td>
        </tr>
        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">Mother Name</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $mname; ?></td>
        </tr>
        
        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">School Code</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $school; ?></td>
        </tr>
        
        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">School Name</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $school_name; ?></td>
        </tr>
        
        <tr>
         
          <td style="border-left:none; padding-top:10px; padding-bottom:10px; text-indent:15px;">School Address</td>
          <!--<td style=" padding-top:10px; padding-bottom:10px;">:</td>-->
          <td style=" padding-top:10px; padding-bottom:10px;"><?php echo $school_address; ?></td>
        </tr>
        
      </tbody>
     </table>

    <!--<from method='post' >-->
    
    </from>
            </div>
            
        </div>
    </div>
</div>

<div id='pad'></div>
</body>
<style>
#pad{
    padding-top:50px;
    
}
#second{
    margin-top:13%;
    text-align:center;
    color:black;
}
@media only screen and (max-width: 600px) {
  #second{
    margin-bottom:35%;
    }
    #inner{
        width:100%;
    }
    #submit{
        width:80%;
        font-size:20px;
    }
}

</style>
<script type="text/javascript">
      $("#product_id").change(function(){
         var BASE_URL='https://marrs.in/student_registration';
        var catg=this.value;
        
        $.ajax({
           url:BASE_URL+"/welcome/ajax/",
            data:{id:catg},
            type: 'post',
            success:function(result)
			{
			    console.log(result);
				//alert(result);
                 $("#category").html(result);
        }});
    }); 
 </script>

<?php include("student_footer.php");?>