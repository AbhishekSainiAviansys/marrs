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
        font-size: 11px;
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
        width: 250px;
        height:250px;
        margin:0 auto;
      }
    </style>
    
                   <?php 
             $cin = $this->session->userdata('cin');
            // print_r($cin);exit;
             $this->db->select('*');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $result_data = $this->db->get()->row();
             $datalogo = $result_data->product_name;
           
           
           
             $this->db->select('*');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $student_data = $this->db->get()->row();
             ?>
  </head>
  <body>
    <section>
      <div class="container" id="content">
        <div class="row" id="certificateWrapper">
          <div class="col-sm-12">
            <div class="card w-100">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h1>Provisional Certificate</h1>
                    <h4 class="mb-5 ms-2 text-white">OF APPRECIATION <?php for ($i = 0; $i < $result_data->clevel; $i++){ ?><img style="width:44px; margin-right: -20px;" src="<?php echo base_url();?>images/medal.png"> <?php } ?></h4>
                    <h4
                      class="my-4 ms-2"
                      style="color: #7a7d81; font-weight: 700"
                    >
                      PROUDLY PRESENTED TO
                    </h4>
                    <h3
                      class="my-4 ms-2"
                      style="color: #4b4479; font-weight: 700"
                    >
                     <?php echo $student_data->student_name;?>
                    </h3>
                    <p
                      class="partcip-detail"
                      style="padding:2% 1%"
                      colspan="5"
                    >
                      of <b> <?php echo $student_data->school_name;?></b> , for being
                      the <b> <?php echo $result_data->rank;?></b> at the
                      <b><?php echo $datalogo ;?></b>.
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
                          <!--    <?php echo $result_data->rank;?></td>-->
                          <td>05 November 2022</td>
                          <td> <?php $level= $result_data->clevel;
                             $this->db->select('*');
                             $this->db->from('competition_levels');
                             $this->db->where('id',$level);
                             echo $this->db->get()->row()->level_name;
                                      
                          ?>
                              </td>
                          <td> <?php echo $result_data->grade;?></td>
                          <td><?php echo $student_data->class;?></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table my-4 table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">CIN</th>
                          <th scope="col">ACADEMIC YEAR</th>
                          <th scope="col">VENUE</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> <?php echo $student_data->cin;?></td>
                          <td>2021-22</td>
                          <td colspan="3">
                            GCC International School, Mira Road, Thane
                          </td>
                        </tr>
                        <tr>
                          <td style="padding: 1%" scope="row" colspan="5">
                            DATE ISSUED: 20-November-2022
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="logo-bg d-flex justify-content-center align-items-center">
                        
                        <?php 
            
             
             if($datalogo=='MaRRS International Spelling Bee'){?>
                <img src="<?php echo base_url();?>images/misb_logo.jpg" class="img-fluid" style="max-width: 110px;max-height:110px;"  /><?php 
             }
             elseif($datalogo=='MaRRS Preschool Bee Math'){
                 ?>
                <img src="<?php echo base_url();?>images/math_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" /><?php 
                
             }
             elseif($datalogo=='MaRRS Preschool Bee English'){
                 ?>
                <img src="<?php echo base_url();?>images/english_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php 
                 
             }
             elseif($datalogo=='MaRRS Preschool Bee Science'){
                ?>
                <img src="<?php echo base_url();?>images/science_logo.png" class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php 
                
             }
             elseif($datalogo=='MaRRS Preschool Bee Humanities'){
                 ?>
                <img src="<?php echo base_url();?>images/humanities_logo.png"  class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php
                  
             }
             elseif($datalogo=='MaRRS International Spelling Bee Junior'){
                 ?>
                <img src="<?php echo base_url();?>images/junior_logo.png" class="img-fluid" style="max-width: 110px;max-height:110px;" alt="sign" /><?php
                 
             }
              elseif($datalogo=='MaRRS Play 2 Learn'){
                 ?>
                <img src="<?php echo base_url();?>images/logo_p2l.png"  class="img-fluid" style="max-width: 110px;max-height:140px;"  alt="sign" /><?php
                 
              }elseif($product_name=='MaRRS Primary Colors - Science'){ ?>
                           
                     <img src="<?php echo base_url();?>images/international/pc_science.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"  />
                   
                   <?php }elseif($datalogo=='MaRRS Primary Colors - Math'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_math.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - English'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_english.png" class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"   />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Humanities'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_humanities.png"  class="img-fluid" style="max-width: 140px;max-height:110px;" alt="sign"   />
                    <?php } ?>
                        
                        
                        
                        
                        
                        
                 
                    </div>
                    
                      <div class="float-right sign">
                        <img src="<?php echo base_url();?>images/sign.png" class="img-fluid" style="max-width: 110px;margin-bottom: -10%;" alt="sign"/> 
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
    <button type="submit" id="cmd" class="btn btn-primary">Download</button>
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
        filename:     'Certificate.pdf',
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
      };
    html2pdf().set(opt).from(pdfgenWrapper).save('certificates');
  });
      
      
    </script>
  </body>
</html>
