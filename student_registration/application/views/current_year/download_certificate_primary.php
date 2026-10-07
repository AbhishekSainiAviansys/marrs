<?php 
  $level_name = str_replace('_', ' ', $level_name);
 //echo '<br>';
 //$nex_level=str_replace('_', ' ', $nex_level);
 //print_r($_SESSION);
// echo '<br>';
// print_r($medal);
// echo '<br>';
// print_r($student['subject']);
// echo '<br>';
//print_r($rank);die;
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
        font-weight:700;
        font-size:190px;
    }
    body{
        padding:0;
        margin:0;
        overflow-x: hidden;
    }
      #certificateWrapper h1 {
        font-size: 50px;
        font-weight: 500;
        color: #ffffff;
      }
      .sign {
        position: absolute;
        bottom: 0;
        padding: 5% 1% 0% 5%;
        right: 0;
        font-weight: 700;
        color: #676b6d;
      }
      th {
        white-space: nowrap;
        font-size: 13px;
        font-weight: 700;
        color: #707475;
      }
      td {
        font-size: 13px;
        font-weight: 700;
        color: #676b6d;
        white-space: nowrap;
      }
      .partcip-detail b {
        color: #5c5d60;
      }
      #certificateWrapper {
        align-items: center;
        /*min-height: 100vh;*/
      }
      #certificateWrapper .card {
        background-image: url("<?php echo base_url();?>images/bg.jpg");
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
        width: 278px;
        height: 277px;
        margin:0 auto;
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

p {
    padding-top: 5px;
    /*padding-left: 35px;*/
    font-size: 20px;
}
    </style>
    
              
  </head>
  <body>
    <section>
        
      <div class="container" id="content" style='padding-top:15px;bottom:0;'>
        <div class="row" id="certificateWrapper" style='padding-bottom:20px;' style='padding-top:20px;'>
          <div class="col-sm-12">
            <div class="card w-100">
              <div class="card-body" style='padding-top:20px;'>
                <div class="row">
                  <div class="col-8">
                    <h1 class='certi' style='padding-top:0px;padding-left:35px;font-size: 60px;'> Certificate</h1>
                    
                    <h4 class="mb-5 ms-3 my-3 text-white" >OF APPRECIATION <?php for($x = 1; $x <= $medal; $x++){ ?> <img style="height:85px;width:55px;" src="https://marrs.in/student_registration/images/medal.png"> <?php } ?></h4>
                    <h3
                      class="my-4 ms-2"
                      style="color: #7a7d81; font-weight: 700;padding-top:0px;"
                    >
                      PROUDLY PRESENTED TO
                    </h3>
                    <h2
                      class="my-3 ms-2"
                      style="color: #4b4479; font-weight: 700"
                    >
                     <?php if(!empty($student['student_name'])){
                     echo $student['student_name'];
                     }else{
                     echo $student['first_name'].' '.$student['middle_name'].' '.$student['last_name'];
                     } ?>
                    </h2>
                    <p
                      class="partcip-detail"
                      style="padding:2% 1%;padding-top:20px;"
                      colspan="5"
                      
                    >
                      of <b> <?php 
                      //print_r($student);die;
                      $res = $this->db->get_where('cin_list', array('cin' => $student['cin']))->row();
                    //   print_r($res->school_name);die;
                        // $nschool = explode(' ',$res->school_name);
                      if(empty($res->school_name)){ 
                            
                             $res = $this->db->get_where('school_new', array('id' => $student['school_id']))->row();
                            $school = explode(' ',$res->school_name);    
                   // print_r($res->cin);die;
                      }
                      
                      else{
                          $school = explode(' ',$res->school_name);
                      }
                       
                            // print_r($school);die;
                             
      // Print the remaining elements in the second row
for ($i = 0; $i < 5; $i++) {
    echo $school[$i] . " ";
}
                      
                      ?></b>
                      <?php 
                      
                      $rank=strtoupper($rank);
                      //echo $rank.'pk';
                      $array1=array('RANK-1','RANK-2','RANK-3','RANK-4','RANK 1','RANK 2','RANK 3','RANK-4');
                      $array2=array('RANK-5','RANK-6','RANK-7','RANK-8','RANK-9','RANK-10','RANK 5','RANK 6','RANK 7','RANK 8','RANK 9','RANK 10');
                      $array3=array('RANK-11','RANK-12','RANK-13','RANK-14','RANK-15','RANK-16','RANK-17','RANK-18','RANK-19','RANK-20', 'RANK 11','RANK 12','RANK 13','RANK 14','RANK 15','RANK 16','RANK 17','RANK 18','RANK 19','RANK 20');
                      
                      if($status=='Q'){
                          
                          if(in_array($rank, $array1)){ 
                              ?>
                              , for being the <b>WINNER </b>at the <b><?php echo $level_name; ?> </b><?php if($nex_level!=''){ ?>
                              and <b>QUALIFIED</b> to participate at the <b><?php echo $nex_level; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></b>.
                              
                              <?php } ?>
                              <?php 
                          }
                          elseif(in_array($rank, $array2)){
                             ?>
                              , for being the <b>BUDDING STAR </b>at the <b><?php echo $level_name; ?> 
                              <?php if($nex_level!=''){ ?>
                              and <b>QUALIFIED</b> to participate at the <b><?php echo $nex_level; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></b>.
                              
                              <?php } ?>
                              <?php 
                          }
                          elseif(in_array($rank, $array3)){
                             ?>
                              , for being the <b>RANK HOLDER </b>at the <b><?php echo $level_name; ?>
                              <?php if($nex_level!=''){ ?>
                              and <b>QUALIFIED</b> to participate at the <b><?php echo $nex_level; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></br>.
                              
                              <?php } ?>
                              <?php 
                          }else{
                          ?>
                          <?php if($nex_level!=''){ 
                          ?>
                          
                          , for having <b>QUALIFIED</b> to participate at the <b><?php echo $nex_level; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></b>.
                         
                         
                          
                           <?php }else{ ?>
                           , for having  <b> PARTICIPATED </b> at the <br> <b><?php echo $level_name; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></b>. <br>
                           <?php }
                          }
                      }else{ ?>
                       
                     , for having <b> PARTICIPATED </b> at the  <b><?php echo $level_name; ?></b> of <b><?php echo $result['product_name'];if($student['subject']!=''){echo ' -Series-'.$student['series'].'-';echo $student['subject'];}?></b>.
                      
                      <?php } ?>
                    </p>
                    <div >
                    <table class="table table-borderless my-3" style='padding-top:50px;'>
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
                                    $formattedDate = date("l, j F Y", $timestamp);
                                    
                                    echo $formattedDate;
                                }else{
                                    
                                  
                                $dateStr= $result['competition_date'];
                                 if(!empty($dateStr)){
                                echo $dateStr;
                                 }else{
                                  echo  $competition_date ; 
                                 }
                                }
                              ?>
                          </td>
                          <td> 
                          <?php 
                          echo $level_name;
                          ?>
                              </td>
                          <td> <?php if(!empty($result['grade'])){ echo $result['grade']; } else { echo $grade; } ?></td>
                          <td><?php echo $student['class'];?></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table my-3 table-borderless">
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
                          <td> <?php if(!empty($student['cin'])){
                          echo $student['cin'];}else{echo $student['zoomzoom_prid'];}?></td>
                          <td><?php $res = $this->db->get_where('period',array('period_id'=>$result['period_id']))->row(); echo $res->academic_year;?></td>
                         <td scope='col'><?php echo $rank; ?></td>
                         <td colspan="3">
                              <?php 
                              
                              if(!empty($venue)){ echo $venue;}
                              ?>
 
                    <div style='padding-top:20px;'></div>        
                          </td>
                         
                        </tr>
                        <tr  >
                          <td style="padding: 2.1%" scope="row" colspan="5">
                            DATE ISSUED: <?php $date =date('Y-m-d');
							echo date('jS F Y', strtotime($date));?>  
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="col-4" style='padding-top:40px;'>
                    <div class="logo-bg d-flex justify-content-center align-items-center"  >
                        
                      <?php  
                      $res = $this->db->get_where('certificate_image',array('product_name'=>$result['product_name']))->row(); 
                      //echo $res->image_name;
                      ?> 
                      
                    <img src="https://marrs.in/student_registration/certificate_logo/<?php echo $res->image_name; ?>" class="img-fluid" style="max-width: 150px;max-height:150px;" alt="sign"  />
                   
                   
                 
                    </div>
                    
                      <div class="float-right sign" style='padding-bottom:20px;'>
                        <img src="<?php echo base_url();?>images/sign.png" class="img-fluid" style="max-width: 110px;margin-bottom: -14%;" alt="sign"/> 
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
      </div>
      
    </section>
    <div style='display:flex;margin-auto;' class='container'>
        <button type="submit" id="cmd" class="btn btn-outline-primary my-2"><i class="fa fa-download"></i> Download</button>
	<!--<form method='POST' style='padding-left:20px;'>-->
	<!--    <button type="submit" id="" class="btn btn-outline-danger my-2" name='back'>ðŸ‘‰ Result View</button>-->
	
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
      precision: 600, // Set a higher DPI (e.g., 600) for better quality
      // Enable compression to reduce PDF size
      compress: true,
      // Add margins to reduce height from the bottom
      marginLeft: 0.5,
      marginRight: 0.5,
      marginTop: 0.5,
      marginBottom: 0.5,
    }
  };
  html2pdf().set(opt).from(pdfgenWrapper).save('certificate');
});


</script>
  </body>
</html>