<?php include('header.php');
//print_r($student);
?>


 <script type = "text/JavaScript">
         <!--
            function AutoRefresh() {
               setTimeout("location.reload(true);",'10000');
            }
         //-->
         
      </script>
      <!--onload="AutoRefresh('10000')"-->
      <style>
          #profileWrapper h3{
              
          }
          #profileWrapper h4{
              font-size: 18px;
          }
          .reg_button .btn {
                color: #FFFFFF;
              -webkit-animation: glowing 1500ms infinite;
              -moz-animation: glowing 1500ms infinite;
              -o-animation: glowing 1500ms infinite;
              animation: glowing 1500ms infinite;
            }
            @-webkit-keyframes glowing {
              0% { background-color: #B20000; -webkit-box-shadow: 0 0 2px #B20000; }
              50% { background-color: #FF0000; -webkit-box-shadow: 0 0 30px #FF0000; }
              100% { background-color: #B20000; -webkit-box-shadow: 0 0 2px #B20000; }
            }
            
            @-moz-keyframes glowing {
              0% { background-color: #B20000; -moz-box-shadow: 0 0 2px #B20000; }
              50% { background-color: #FF0000; -moz-box-shadow: 0 0 30px #FF0000; }
              100% { background-color: #B20000; -moz-box-shadow: 0 0 2px #B20000; }
            }
            
            @-o-keyframes glowing {
              0% { background-color: #B20000; box-shadow: 0 0 2px #B20000; }
              50% { background-color: #FF0000; box-shadow: 0 0 30px #FF0000; }
              100% { background-color: #B20000; box-shadow: 0 0 2px #B20000; }
            }
            
            @keyframes glowing {
              0% { background-color: #B20000; box-shadow: 0 0 2px #B20000; }
              50% { background-color: #FF0000; box-shadow: 0 0 30px #FF0000; }
              100% { background-color: #B20000; box-shadow: 0 0 2px #B20000; }
            }
          }
      </style>
<body >

    <section>
        <div class="container">
           <div class="row">
              <?php  if($this->session->flashdata('success')) { ?>
                            <h3><?php echo $this->session->flashdata('error'); ?></h3>
                <?php } ?>   
               <div class="col-12">
               <!--<marquee>-->
               <!--    <div style="display:flex;">-->
               <!--        <div><h3 style='font-weight:700;margin: 3px;'>Registration are open now -- </h3>-->
               <!--        </div>-->
               <!--        <div>-->
               <!--        <form method='post' style="padding:2%;">-->
               <!--            <div id='register'><input type="submit" class="btn btn-danger btn-sm"  value="Click Here" name='register',href="https://marrs.in/student_registration/Cin_login/play_learn" >-->
               <!--            </div>-->
               <!--        </form>-->
               <!--        </div>-->
               <!--    </div>-->
               <!-- </marquee>-->
                <div>
            </div>
        </div>
    </section>
    <section style="background-color:#ffffff;">
        <div class="container">
            <div class="row" id="namecard">
                <div class="col-md-12">
                    <div class="card my-2 p-0" style="background-color:#fff;border: none;">
                        <div class="row g-0">
                            <div class="col-sm-12 col-md-12 col-lg-3 mb-2">
                                <div class="card" style="border: none;">
                                <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" class="card-image-top img-fluid" alt="Profile Pic"/>
                                <div class="card-body">
                                        <h2 class="card-title"><?php echo $student[0]['student_name']; ?></h2>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-9" id="profile">
                                            <h2 class="my-4 text-success">Click <span class="text-dark">Below To</span></h2>
                                
                                <?php $cin= $this->session->userdata('cin');
 //echo $cin;
$query = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='1';");
$query1 = $this->db->query("SELECT * FROM `cin_result` WHERE `cin` LIKE '{$cin}' and clevel='3' and period_id='11';");
$queryState = $this->db->query("SELECT * FROM `cin_list` WHERE `cin` LIKE '{$cin}' and state_id='14686'")->row();
//$array1=array();
 foreach ($query->result_array() as $row)
{
 
  $product_name=$row['product_name'];
 
}
 foreach ($query1->result_array() as $row)
{
 
  $product_name_national=$row['product_name'];
 
}



//echo $product_name;die;
?>
<div class="reg_button my-3" style='text-align:center;'>
                          <?php
                         
                           if($product_name=='MaRRS International Spelling Bee' ) { ;?>
                            <?php if($product_name=='MaRRS International Spelling Bee' && $queryState->state_id=='14686' ) {  ?>
                            <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
							<?php }else{  ?>
							 <!--<a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
							<?php } ?>
					
                   <?php } elseif($product_name=='MaRRS International Math Bee'){ ?>
							 <?php if($product_name=='MaRRS International Math Bee' && $queryState->state_id=='14686' ) {  ?>
						   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
							 <?php }else{ ?>
							  <!--<a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
							 <?php } ?> 
                    <?php } elseif($product_name=='MaRRS Scientia Exertus'){ ?>
                          
                              <?php if($product_name=='MaRRS Scientia Exertus' && $queryState->state_id=='14686' ) {  ?>
						   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
							 <?php }else{ ?>
							  <!--<a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
							 <?php } ?> 
                    
                     <?php }elseif($product_name=='MaRRS International Spelling Bee Junior'){ ?>
                           
                            <?php if($product_name=='MaRRS International Spelling Bee Junior' && $queryState->state_id=='14686' ) {  ?>
						   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
							 <?php }else{ ?>
							  <!--<a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
							 <?php } ?> 
                   
                   <?php }elseif($product_name=='MaRRS Play 2 Learn'){ ?>
                           
                             <?php if($product_name=='MaRRS Play 2 Learn' && $queryState->state_id=='14686' ) {  ?>
						   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
							 <?php }else{ ?>
							  <!--<a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
							 <?php } ?> 
                   
                   <?php }elseif($product_name=='MaRRS Preschool Bee English'){ ?>
                   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
                   
				   <?php }elseif($product_name=='MaRRS Preschool Bee Math'){ ?>
                   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
				   <?php }elseif($product_name=='MaRRS Preschool Bee Science'){ ?>
                   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
				   
				   <?php }elseif($product_name=='MaRRS Preschool Bee Humanities'){ ?>
                   <a class=" btn btn-lg btn-outline-danger" href="<?php echo base_url();?>Cin_login/competition_statewise">Register & Download</a>
				   
				   <?php }elseif($product_name=='MaRRS International Spelling Bee Junior'){ ?>
                           
                    <!--<a class= "btn btn-outline-danger" href="<?php echo base_url();?>Cin_login/play_learn">Register & Download</a>-->
               <?php    }else{ ?>
               <a class=" btn btn-lg btn-outline-danger close" href="#">Register & Download</a>
              <?php } ?>

 <br>
 <?php// echo $this->session->flashdata('message');?>
			 

</div>




                            </div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="profileWrapper" style="background-color:#ffff;">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 mb-2 mb-lg-0">
                    <div class="mb-2"><i class="fa-solid fa-hashtag" style="color: #000;"></i></div>
                    <h3>CIN</h3>
                    <h4><?php echo $student[0]['cin']; ?></h4>
                </div>
                <div class="col-lg-3">
                    <div class="mb-2"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <h3>Class</h3>
                    <h4><?php echo $student[0]['class']; ?></h4>
                </div>
                <div class="col-lg-3 mb-2 mb-lg-0">
                    <div class="mb-2"><i class="fa-solid fa-envelope-circle-check"></i></div>
                    <h3>Email</h3>
                    <h4><?php echo $student[0]['stud_email']; ?></h4>
                </div>
                <div class="col-lg-3">
                    <div class="mb-2"><i class="fa-solid fa-square-phone"></i></div>
                    <h3>Mobile Number</h3>
                    <h4><?php echo $student[0]['stud_phone']; ?></h4>
                </div>                   
            </div>
        </div>
        <div class="svg-border-rounded text-white">
        <!-- Rounded SVG Border-->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="#0c305e"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0"></path></svg>
        </div>
    </section>
                
    <section id="otherDetails" style="background-color:#0c305e;">
        <div class="container mb-5">
            <div class="row">
			  <div class="col-md-6 my-3">
                   <div class="card h-100 text-center">
                   <form action="" method="POST">
                   <div class="card-header"> 
<!--             <button type="button" class="btn btn-sm btn-danger" id="edit_guard" onClick="AutoRefresh();"><i class="fa-regular fa-pen-to-square"></i></button> -->
<!--<button type="submit" class="btn btn-sm btn-success me-2 update" style="display:none;" id="button_submit" name="submit"><i class="fa-regular fa-square-check"></i></button>-->

                       
                        
                    </div>
                    <img src="https://img.icons8.com/bubbles/100/000000/family.png" class="img-fluid" alt=".."/>                    
                    <h4>Guardian Details</h4>
                    <div class="card-body">
                        <div class="table-responsive"  id="info2" style="overflow-x:auto;">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Father Name</th>
                                        <td><input type="text" class="form-control guardetail" name="father_name" id='father_name' disabled="disabled"  value="<?php echo $student[0]['father_name']; ?>"/></td>
                                        
                                    </tr>
                                    <tr>
                                        <th scope="row">Mother Name</th>
                                        <td><input type="text" class="form-control guardetail" name="mother_name" id='mother_name' disabled="disabled"  value="<?php echo $student[0]['mother_name']; ?>"/></td>
                                    </tr>
                                       
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td><input type="text" class="form-control guardetail" name="address1" id='address1' disabled="disabled"  value="<?php echo $student[0]['address1']; ?>" rows="1" ></td>
                                    </tr>
                                    
                                    <tr>
                                        <div style='text-align:center;' >
                                        </div>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                       </div>
                    </form>
                   </div>
                </div>
                <div class="col-md-6 my-3">
                   <div class="card h-100 text-center ">
                    <div class="card-header">                    
                    <!--    <button type="button" class="btn btn-sm btn-danger" id="edit_school"><i class="fa-regular fa-pen-to-square"></i></button>-->
                    </div>
                    <img src="https://img.icons8.com/external-victoruler-flat-victoruler/64/000000/external-school-education-and-school-victoruler-flat-victoruler-2.png" class="img-fluid" style="
                    padding: 18px;"/>                    
                    <h4>School Details</h4>
                    <div class="card-body">
                        <div class="table-responsive"  id="info2" style="overflow-x:auto;">
                            <table class="table">
                                <tbody>
                                <form action="" method="POST">
                                    <!--<tr>-->
                                    <!--    <th scope="row">School Code.</th>-->
                                    <!--    <td><input type="text" class="form-control schooldetail" name="class" disabled="disabled"  value="<?php echo $student[0]['school_code']; ?>"/></td>  -->
                                    <!--</tr>-->
                                    <tr>
                                        <th scope="row">School Name</th>
                                        <td><input type="text" class="form-control schooldetail" name="school_name" disabled="disabled" value="<?php echo $student[0]['school_name']; ?>"/></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">School Address</th>
                                        <td><p class="p-2 schooldetail"><?php echo $student[0]['school_address1']; ?></p></td>
                                    </tr>
                                    
                                </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>


    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script>
    
$(document).ready(function(){
        
   $("#edit_guard").change(function(){
      window.location.reload(true);
   });
   $("#edit_guard").click(function(event){
       event.preventDefault();
       if($('.update').is(':hidden')){
           $('.update').show();
       }else{
           $('.update').hide();
       }                                                                                                                
       return false;
   })
   
   
        
            
   
   
   
   
});





</script>



   
    
<?php include("footer.php");?>

<?php $cin = $this->session->userdata('cin');

 $studentdatablank =  $this->db->get_where('cin_list',array('cin'=>$cin))->row();
if(empty($studentdatablank)){  ?>
<script>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#exampleModal').modal('show');
    });
</script>
    
</script>
<?php } ?>

<<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>