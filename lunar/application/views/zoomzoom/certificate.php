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
    <style>
    body{
        padding:0;
        margin:0;
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
        font-size: 12px;
        font-weight: 700;
        color: #707475;
      }
      td {
        font-size: 13px;
        font-weight: 900;
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
        width: 250px;
        height:250px;
        margin:0 auto;
      }
    </style>
    
                   <?php 
            $prid = $_SESSION['id']; 
            
           
             $this->db->select('*');
             $this->db->from('student_to_zoomzoom');
             $this->db->where('zoomzoom_prid',$prid);
              $student_data = $this->db->get()->row();
              //print_r($data);exit;
               $this->db->select('*');
             $this->db->from('zoomzoom_result');
             $this->db->where('cin',$cin);
             $this->db->order_by('id','DESC');
              $student_result = $this->db->get()->row();
              //print_r($student_result);die;
              
              if($student_result->clevel==1){
                  $lv='School Championship';
                  $nl='National Championship';
              }
              if($student_result->clevel==2){
                  $lv='National Championship';
                  $nv='The Jumbo National Championship';
              }
              
             ?>
  </head>
  <body>
    <section>
      <div class="container" id="content">
        <div class="row" id="certificateWrapper">
          <div class="col-sm-12">
            <div class="card w-100">
              <div class="card-body">
                <div class="row" style="padding:20px">
                  <div class="col-8">
                    <h1><img src="/images/ceftificates_img.png"></h1>
                   <div style='display:flex;'> <h4 class="mb-5 ms-2 text-white">OF APPRECIATION <?php for ($i = 0; $i < $student_result->clevel; $i++){ ?><img style="width:50px; margin-right: -20px;" src="<?php echo base_url();?>images/medal.png"> <?php } ?> <?php  if(!empty($student_result->rank)){?> <h4 style='padding-top:19px;padding-left:20px;' class="mb-5 ms-2 text-white"><?php echo 'RANK HOLDER'; ?></h4><img style="width:70px; height: 74px;" src="<?php echo base_url();?>images/rank.png"> <?php } ?></h4></div>
                    <h3
                      class="my-3 ms-2"
                      style="color: #7a7d81; font-weight: 700"
                    >
                      PROUDLY PRESENTED TO
                    </h3>
                    <h2
                      class="my-3 ms-2"
                      style="color: #4b4479; font-weight: 700"
                    >
                     <?php echo $student_data->first_name.' '.$student_data->last_name;?> 
                    </h2>
                    <p
                      class="partcip-detail"
                      style="padding:2% 1%"
                      colspan="5"
                    >
                      of <b> <?php if(!empty($student_data->school_name)) { echo $student_data->school_name;}else{ echo '---------------------------------------------------------';} ?></b> , for having 
                      
                      <?php if($student_result->status=='Q'){ ?>
                      <b> QUALIFIED </b> to participate in the
                      <?php }else{?>
                      <b> PATICIPATED </b> in the
                      <?php }?>
                      
                      
<b><?php echo $nl; ?> </b> of the
                      <b><?php echo $student_result->product_name ;?></b>.
                    </p>
                    <div >
                    <table class="table table-borderless my-4">
                      <thead>
                        <tr>
                          <!--<th scope="col">RANK</th>-->
                          <th scope="col">COMPETITION DATE</th>
                          <th scope="col">COMPETITION LEVEL</th>
                          <th scope="col">COMPETITION GRADE</th>
                          <th scope="col">COMPETITION CATEGORY</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!--<td>-->
                          <!--    <?php echo $student_result->rank;?></td>-->
                          <td> 11 May 2023 </td>
                          <td> <?php //$res = $this->db->get_where('competition_levels',array('id'=>$student_result->clevel))->row();
                             //echo $res->level_key ;
                                echo $lv;      
                          ?>
                              </td>
                          <td> <?php echo $student_result->grade;?></td>
                          <td><?php echo $student_data->class;?></td>
                        </tr>
                      </tbody>
                        <thead>
                        <tr>
                          <th scope="col"> CIN</th>
                           <th scope="col"> RANK </th>
                          <th scope="col">ACADEMIC YEAR</th>
                         
                          <th scope="col">COMPETITION VENUE</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> <?php echo $cin;?></td>
                          <td> <?php if(!empty($student_result->rank)){ echo $student_result->rank;}else{ echo '-';}?></td>
                          <td><?php $res = $this->db->get_where('period',array('period_id'=>$student_data->period_id))->row(); echo $res->period_name ;?></td>
                          <td>
                           Online
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 1%" scope="row" colspan="5">
                            DATE ISSUED: 21-JULY-2023
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="logo-bg d-flex justify-content-center align-items-center">
                        
                        <?php 
            
             
             if($student_result->product_name=='MaRRS International Spelling Bee'){?>
                <img src="<?php echo base_url();?>images/misb_logo.jpg" class="img-fluid" style="max-width: 110px;max-height:110px;"  /><?php 
             }
             elseif($student_result->product_name=='MaRRS Preschool Bee Math'){
                 ?>
                <img src="<?php echo base_url();?>images/math_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" /><?php 
                
             }
             elseif($student_result->product_name=='MaRRS Preschool Bee English'){
                 ?>
                <img src="<?php echo base_url();?>images/english_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php 
                 
             }
             elseif($student_result->product_name=='MaRRS Preschool Bee Science'){
                ?>
                <img src="<?php echo base_url();?>images/science_logo.png" class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php 
                
             }
             elseif($student_result->product_name=='MaRRS Preschool Bee Humanities'){
                 ?>
                <img src="<?php echo base_url();?>images/humanities_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php
                  
             }
             elseif($student_result->product_name=='MaRRS International Spelling Bee Junior'){
                 ?>
                <img src="<?php echo base_url();?>images/junior_logo.png" class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php
                 
             }
              elseif($student_result->product_name=='MaRRS Play2Learn'){
                 ?>
                <img src="<?php echo base_url();?>images/logo_p2l.png"  class="img-fluid" style="max-width: 110px;max-height:140px;"  alt="sign" /><?php
                 
              }elseif($student_result->product_name=='MaRRS Primary Colors - Science'){ ?>
                           
                     <img src="<?php echo base_url();?>images/international/pc_science.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"  />
                   
                   <?php }elseif($student_result->product_name=='MaRRS Primary Colors - Math'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_math.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"  />
                   
                   <?php }elseif($student_result->product_name=='MaRRS Primary Colors - English'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_english.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"   />
                   
                   <?php }elseif($student_result->product_name=='MaRRS Primary Colors - Humanities'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_humanities.png"  class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"   />
                    <?php } elseif($student_result->product_name=='MaRRS International Math Bee'){ ?>
                    
                     <?php }elseif($student_result->product_name=='MaRRS ZoomZoom'){ ?>
                           
                    <img src="<?php echo base_url();?>product_logo/zoom-bg.png"  class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"   />
                          
                    
                    <?php } ?>
                        
                        
                        
                        
                        
                        
                 
                    </div>
                    
                      <div class="float-right sign">
                        <img src="<?php echo base_url();?>images/sign.png" class="img-fluid" style="max-width: 110px;margin-bottom: -15%;-webkit-transform: rotate(66deg);" alt="sign"/> 
                        <h6>
                            P.Suresh Kumar<br>
                            Director, <br>
                           MaRRS Intellectual Services (P) Ltd.
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
    <button type="submit" id="cmd" class="btn btn-primary">Download</button>
    <form method='POST'>
                    <button name='back' class='btn btn-warning'>← To Result</button>
                </form>
 <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    
    <script>   
    document.getElementById("cmd").addEventListener("click", () => {
    const pdfgenWrapper = this.document.getElementById("content");
    
    let opt = {
        margin:0.3,
        filename:     'Certificate.pdf',
        image: {
            type: 'png',
            quality: 0.98
        },
        html2canvas: {
            scale:2
        },
        
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape'},
       
      };
    html2pdf().set(opt).from(pdfgenWrapper).save('certificates');
  });
      
      
    </script>
  </body>
</html>
