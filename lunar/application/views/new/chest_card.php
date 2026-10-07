<!DOCTYPE html>
<html>
<head>
    <title>Marrs.in</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>chestcard/custom.css">
</head>
<body>
<section>
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card certificate p-0 my-3" id="content">
                    <div class="card-body p-0">
                        <div class="row">
                            <?php
                         $cin = $this->session->userdata('cin');
                         $this->db->select('product_name');
                         $this->db->from('cin_result');
                         $this->db->where('cin',$cin);
                         $datalogo = $this->db->get()->row()->product_name;
                         //echo $datalogo;die;
                       
                            $this->db->select('*');
                         $this->db->from('cin_list');
                         $this->db->where('cin',$cin);
                         $student_data = $this->db->get()->row();
                         $student = $student_data->class;
                        
                            if($student=='UKG'){
                             $class = 'SENIOR KG';
                             $class_img ='SENIOR_KG';  
                             $bg_color = '#D01379';
                            }elseif($student=='LKG'){
                                $class = 'JUNIOR KG';
                                 $class_img ='JUNIOR_KG';
                                  $bg_color = '#0078D3';
                            }elseif($student=='NURSERY'){
                                $class = 'NURSERY';
                                $class_img ='NURSERY';
                                 $bg_color = '#4d1287';
                            }elseif($student=='Class-1'){
                                $class = 'GRADE 1';
                                 $class_img ='GRADE_1';
                                   $bg_color = '#874312';
                                 
                            }
                            
                            ?>
                        <div class="col-sm-4 col-md-4 col-lg-4 left" style="background:<?php echo $bg_color;?>;">
                            <div class="" style="margin-top:220px;">
                                <h2 class="text-white text-end" style="font-size:45px;"><?php echo $class;?></h2>
                                
                               <?php if($datalogo=='MaRRS International Spelling Bee'){?>
                            <img src="<?php echo base_url();?>chestcard/misb_logo.jpg"  alt="Product Logo" id='logo'   />
                            <?php 
                         }elseif($datalogo=='MaRRS Preschool Bee Math'){
                             ?>
                            <img src="<?php echo base_url();?>chestcard/math_logo.png"  alt="Product Logo" id='logo' /><?php 
                            
                         }
                        else if($datalogo=='MaRRS Preschool Bee English'){
                             ?>
                            <img src="<?php echo base_url();?>chestcard/english_logo.png"  alt="Product Logo" id='logo'  /><?php 
                             
                         }
                         elseif($datalogo=='MaRRS Preschool Bee Science'){
                            ?>
                                 <img src="<?php echo base_url();?>chestcard/english_logo.png"  alt="Product Logo" id='logo'  />        
                          <?php } 
                           elseif($datalogo=='MaRRS Preschool Bee Humanities'){
                            ?>
                            <img src="<?php echo base_url();?>chestcard/humanities_logo.png"  alt="Product Logo" id='logo' /><?php
                              
                         }
                         if($datalogo=='MaRRS International Spelling Bee Junior'){
                             ?>
                            <img src="<?php echo base_url();?>chestcard/junior_logo.png"  alt="Product Logo" id='logo'  /><?php
                             
                         }
                         
                         ?>
                          
                               
                                <form>
                                <div class="row">
                                    <label for="cin" class="col-sm-4 col-form-label text-white text-end p-0 my-1" style="font-size: x-large;font-weight: 600;">
                                    CIN</label>
                                    <div class="col-sm-8 p-0">
                                    <input type="text" class="form-control form-control-lg mb-5" id="cin" value="<?php echo $cin;?>" readonly>
                                    </div>
                                </div>
                                </form>
                            </div>
                            </div>
                            
                            <div class="col-sm-8 col-md-8 col-lg-8 right" style="background-image: url(<?php echo base_url();?>chestcard/<?php echo $class_img;?>.jpg);">
                                <div class="text-end me-4 my-4">                                
                                    <img src="<?php echo base_url();?>chestcard/marrs-logo.jpg" alt="logo" width="100px" />
                                </div>
                                <div class="certi_title">
                                <h1 class="text-center">NATIONAL</h1>
                                </div>
                                <div class="certi_title2">
                                <h2 class="text-center">CHAMPIONSHIP</h2>
                                </div>
                                <h4 class="text-center">GCC INTERNATIONAL SCHOOOL</h4>
                                <h4 class="text-center">MIRA ROAD, THANE</h4>
                                <h4 class="text-center" >2022 NOVEMBER 5</h4>
                                <h1 class="text-center" style="color: #fff;">
                                    <?php echo $chestnumber;?>
                                    </h1>
                                <h3 class="text-center "><?php echo $student_data->student_name;?></h3>
                                <h4 class="text-center  mb-4">THANE, PUBLIC SCHOOL</h4>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</section>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script
  src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
  integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  window.addEventListener("load", (event) => {
      let element = this.document.getElementById("content");
      let opt = {
        margin: 0,
        filename: "ChestCard.pdf",
        image: { type: "jpeg", quality: 100 },
        html2canvas: { scale: 1 },
        jsPDF: { unit: "in", format: "letter", orientation: "landscape" },
      };

      html2pdf().set(opt).from(element).save();
      setTimeout(
        function(){
            window.location = "<?php echo base_url();?>cin_login"; 
        },
    100);
    });
</script>
</body>
</html>