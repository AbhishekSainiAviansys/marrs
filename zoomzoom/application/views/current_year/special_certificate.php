<?php 
 $level_name = str_replace('_', ' ', $level_name);
// echo '<br>';
 $nex_level=str_replace('_', ' ', $nex_level);



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate</title>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
      integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <style>
    .certi{
        font-family: 'Dancing Script', cursive;font-family: 'Pacifico', cursive;
        letter-spacing:1.5px;
        font-weight:800;
        font-size:190px;
        
    }
    body{
        padding:0;
        margin:0;
        overflow-x: hidden;
        /*letter-spacing: 1.2px !important;*/
    }
      #certificateWrapper h1 {
        font-size: 50px;
        font-weight: 500;
        color:#4b4479;;
      }
      .sign {
        
        font-weight: 700;
        color: #676b6d;
      }
      
      th {
        white-space: nowrap;
        font-size: 13px;
        font-weight: 600;
        color: #707475;
        text-align:center;
      }
      td {
        font-size: 15px;
        font-weight: 700;
        color: #676b6d;
        white-space: wrap;
        text-align:center;
      }
      .partcip-detail b {
        color: #5c5d60;
      }
      #certificateWrapper {
        align-items: center;
        /*min-height: 100vh;*/
      }
      #certificateWrapper .card {
        background-image: url("<?php echo base_url();?>/certificate_logo/card.jpg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: none;
     
      }
      #certificateWrapper .card .card-body {
        border: 4px solid #f8c913;
      }
      .logo-bg{
        background-image: url("<?php echo base_url();?>images/logo.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        width: 250px;
        height:250px;
        margin:0 auto;
      }
      p{
          margin-bottom:0.5rem !important;
      }
      
      .row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: nowrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(-.5 * var(--bs-gutter-x));
    margin-left: calc(-.5 * var(--bs-gutter-x));
}

.parent {
  /*position: relative;*/
  top: 0;
  left: 0;
}
/*.image1 {*/
/*  position: relative;*/
/*  top: 0;*/
/*  left: 0;*/
  /*border: 1px red solid;*/
/*}*/
/*.image2 {*/
/*  position: absolute;*/
/*  top: 25px;*/
/*  left: 25px;*/
  /*border: 1px green solid;*/
/*}*/

.border-gradient {
  border: 10px solid;
  border-image-slice: 1;
  border-width: 5px;
}
.border-gradient-purple {
  border-image-source: linear-gradient(to left, #743ad5, #d53a9d);
}

.btn-gradient-2 {
  background: linear-gradient(white, white) padding-box,
              linear-gradient(to right, darkblue, darkorchid) border-box;
  border-radius: 50em;
  border: 4px solid transparent;
}
.bottomright {
  position: absolute;
  bottom: 8px;
  right: 16px;
  font-size: 18px;
}

    </style>
    
              
  </head>
  <body>
    <section id="content">
        
      <div class="container" id="certificateWrapper" style='padding-top:15px;bottom:0;'>
        <div class="row"  style='padding-bottom:20px;'>
          <div class="col-sm-12">
            <div class="card w-100">
              <div class="card-body">
                   <div class="row">
                    <div class='col-12' >
                            
                            <div class="parent" class='my-0 ms-5 ' style='padding-right: 7em;float: right;'>
                               <?php   $res = $this->db->get_where('certificate_image',array('product_name'=>$result['product_name']))->row(); //echo $res->image_name;?>
                      
                              <img class="image2 " src="https://marrs.in/student_registration/certificate_logo/<?php echo $res->image_name; ?>" style="max-width: 120px;max-height:120px;border: 3px solid #f1d615; border-radius: 60px;"      />
                            </div>
                            
                          
                   
                        </div>

                </div>
                <div class="row">
                    <div class="col-12" style=' text-align:center;    margin-top: -11.5%;'>
                        <?php if($stat=='BEST PERFORMER'){
                                $im='bp2.png';?>
                                <img class="image1" src="https://marrs.in/student_registration/certificate_logo/<?php echo $im; ?>" style="width: 210px;max-height:160px;"  />
                            <?php 
                            }else{
                               $im='sp2.png';?>
                               <img class="image1" src="https://marrs.in/student_registration/certificate_logo/<?php echo $im; ?>" style="width: 160px;max-height:102px;"  />
                            <?php 
                            }?>
                              
                    
                        <h1 class='certi' style='padding-top:4px;padding-bottom:5px;font-size: 2.5rem;'> Certificate</h1>
                        <h4  style="color: #7a7d81; font-weight: 700;padding-top:0px;font-size: 1.2rem;">PROUDLY PRESENTED TO</h4>
                            <h4  style="color: #4b4479; font-weight: 700;font-size: 1.2rem; "> <?php echo $student['student_name'];?></h4>
                            <p style="color: #7a7d81;padding-top:0px;">OF</p>
                            <h5 style="color: #4b4479; font-weight: 700;"><?php echo $student['school_name'];?> </h5>
                            
                            <p style="color: #7a7d81;padding-top:0px;font-size: 1.2rem;">FOR BEING <h4  style="color: #4b4479; font-weight: 700;font-size: 1.2rem;"> <?php echo $stat;?></h4></p>
                            
                    </div>
                    </div>
                    <div class="row" style="padding: 0% 3% ;" >
                    <div class='col-12'>
                            <table class="table table-borderless my-1 " >
                                  <thead>
                                    <tr>
                                      <!--<th scope="col">RANK</th>-->
                                      <th scope="col">COMPETITION DATE</th>
                                      <th scope="col">COMPETITION LEVEL</th>
                                      <th scope="col">COMPETITION GRADE</th>
                                      <th scope="col">STUDENT CLASS</th>
                                    </tr>
                                  </thead>
                                <tbody>
                            <tr>
                              <!--<td>-->
                              <!--    <?php echo $result['rank'];?></td>-->
                              <td>
                                  <?php 
                                    if($result['competition_schedule_id']){
                                      //echo 'ok';
                                      $res = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$result['competition_schedule_id']))->row(); 
                                      
                                      $dateStr= $res->competition_date;
                                      //$dateStr = "2023-10-05 00:00:00";
                                        $timestamp = strtotime($dateStr);
                                        $formattedDate = date("j F Y", $timestamp);
                                        
                                        echo $formattedDate;
                                    }else{
                                    echo $result['competition_date'];
                                      
                                    }
                                  ?>
                              </td>
                              <td> 
                              <?php 
                              echo $level_name;
                              ?>
                                  </td>
                              <td> <?php if(empty($result['grade'])){
                                  echo '-';
                              }else{
                              
                              echo $result['grade'];
                              
                              }?></td>
                              <td><?php echo $student['class'];?></td>
                            </tr>
                          </tbody>
                          <thead>
                        <tr>
                          <th scope="col">CIN</th>
                          <th scope="col">ACADEMIC YEAR</th>
                          <th scope='col'>RANK</th>
                          <th scope="col">VENUE</th>
                          <!--<th scope="col"></th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> <?php echo $student['cin'];?></td>
                          <td><?php $res = $this->db->get_where('period',array('period_id'=>$result['period_id']))->row(); echo $res->academic_year;?></td>
                          <td scope='col'><?php 
                          if(empty($rank)){
                              echo  ' - ';
                          }else{
                          echo $rank;} ?></td>
                         <td scop="col">
                              <?php 
                              
                              if($result['competition_schedule_id']){
                                  $res = $this->db->get_where('competition_schedule',array('competition_schedule_id'=>$result['competition_schedule_id']))->row(); 
                                  //echo $res->center_address;
                                  $school=$res->center_address;
                                   $school = explode(' ',$school);
                            // print_r($school);
                             
      // Print the remaining elements in the second row
for ($i = 0; $i < 4; $i++) {
    echo $school[$i] . " ";
}
// echo "<br>";
                     
if($school[4]!=''){
    echo '<br>';
    for ($i = 4; $i < 7; $i++) {
            echo $school[$i] . " ";
    }


}else{
    ?>
    <div style='padding-top:20px;'></div>
    <?php
}
                              }else{
                                  
                             //  echo $student['school_name'];
                             $school = explode(' ',$student['school_name']);
                            // print_r($school);
                             
      // Print the remaining elements in the second row
for ($i = 0; $i < 4; $i++) {
    echo $school[$i] . " ";
}
// echo "<br>";
                     
// Print the elements starting from index 4 in one row

if($school[4]!=''){
    echo '<br>';
    for ($i = 4; $i < 7; $i++) {
            echo $school[$i] . " ";
    }


}else{
    ?>
    <div style='padding-top:20px;'></div>
    <?php
}


                             
                              } ?>
                            
                          </td>
                         
                        </tr>
                        <!--<tr>-->
                        <!--  <td style="padding: 1%" scope="row" colspan="5">-->
                             
                        <!--  </td>-->
                        <!--</tr>-->
                      </tbody>
                            </table>
                            
                    </div>
                    </div>
                    <!--<div class="row"  style="padding: 0% 10% ;">-->
                    <!--<div class='col-12'>-->
                    <!--    <table class="table my-2 table-borderless my-1">-->
                      
                    <!--</table>-->
                    <!--</div>-->
                    <!--</div>-->
                   
                <div class='row'  style="padding: 0% 7% ;    ">
                      <div class='col-6'>
                          <div style='padding-top:7rem;'>
                          <p class=' ms-4 my-4'>
                              <b>
                          DATE ISSUED: <?php $date =date('Y-m-d');
							echo date('jS F Y', strtotime($date));?>
							</b>
                          </p>
                         
                      </div>
                          
                           
                          
                      </div>
                      <div class='col-6' >
                         
                      <div class="d-flex justify-content-around sign" style='flex-direction:column; padding: 0% 16% 5% 10%; float: right;'>
                        <img src="<?php echo base_url();?>images/sign1.png" class="img-fluid" style="max-width: 80px;margin-bottom: -7%;transform: rotate(30deg);" alt="sign" /> 
                        <h6>
                            P.Suresh Kumar<br />
                            Director, MaRRS Intellectual<br />
                            Services (P) Ltd.
                          </h6>
                      </div>
                  </div>
                  </div>
                  
                    
                </div>
                
                
                </div>
                
                    
                  
                   
                    
                    
                    </div>
                   
                  </div>
                  
                  
                  
                  <!--<div class="col-4">-->
                    <!--<div class="logo-bg d-flex justify-content-center align-items-center">-->
                        
                      <?php  
                    //   $res = $this->db->get_where('certificate_image',array('product_name'=>$result['product_name']))->row(); 
                      //echo $res->image_name;
                      ?> 
                      
                    <!--<img src="https://devavian.marrs.in/student_registration/certificate_logo/<?php echo $res->image_name; ?>" class="img-fluid" style="max-width: 150px;max-height:150px;" alt="sign"  />-->
                   
                   
                 
                    <!--</div>-->
                    
                      <!--<div class="float-right sign" style='padding-bottom:20px;'>-->
                      <!--  <img src="<?php echo base_url();?>images/sign.png" class="img-fluid" style="max-width: 110px;margin-bottom: -14%;" alt="sign"/> -->
                      <!--  <h6>-->
                      <!--      P.Suresh Kumar<br />-->
                      <!--      Director, MaRRS Intellectual<br />-->
                      <!--      Services (P) Ltd.-->
                      <!--    </h6>-->
                      <!--</div>-->
                  <!--</div>-->
                </div>
     
      
    </section>
    <div style='display:flex;margin-auto;' class='container'>
        <button type="submit" id="cmd" class="btn btn-outline-primary my-2"><i class="fa fa-download"></i> Download</button>
	<!--<form method='POST' style='padding-left:20px;'>-->
	<!--    <button type="submit" id="" class="btn btn-outline-danger my-2" name='back'>👉 Result View</button>-->
	
	<!--</form>-->
	<form method='POST' style='padding-left:20px;'>
	    <button type="submit" id="" class="btn btn-outline-warning my-2" name='profile'><i class="fa fa-user" style="font-size:20px;color:yellow;"></i> Your Profle</button>
	
	</form>
        
    </div>
    		
 <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    
  <!--  <script>   -->
  <!--  document.getElementById("cmd").addEventListener("click", () => {-->
  <!--  const pdfgenWrapper = this.document.getElementById("content");-->
  <!--  let opt = {-->
  <!--      filename:     'Certificate.pdf',-->
  <!--      jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }-->
  <!--    };-->
  <!--  html2pdf().set(opt).from(pdfgenWrapper).save('certificates');-->
  <!--});-->
      
      
  <!--  </script>-->
  
  <script>
 document.getElementById("cmd").addEventListener("click", () => {
  const pdfgenWrapper = this.document.getElementById("content");

  // Increase the pixel size (height) of the content
  pdfgenWrapper.style.height = ''; // Set the desired fixed height in pixels

  let opt = {
    filename: 'Certificate.pdf',
    jsPDF: {
      unit: 'in',
      format: 'letter',
      orientation: 'landscape',
      // Increase DPI for better quality
      precision: 900, // Set a higher DPI (e.g., 600) for better quality
      // Enable compression to reduce PDF size
      compress: true,
      // Add margins to reduce height from the bottom
      marginLeft: 0,
      marginRight: 0,
      marginTop: 0,
      marginBottom: 0,
    }
  };
  html2pdf().set(opt).from(pdfgenWrapper).save('certificate');
});


</script>
  </body>
</html>