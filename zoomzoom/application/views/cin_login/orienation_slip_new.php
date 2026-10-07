<?php include('header.php');?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card text-center my-2" id="content" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
              <?php 
               $cin = $_SESSION['cin'];
               $this->db->select('*');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $result =$this->db->get()->row();
             $product_name = $result->product_name;
               $level = $result->clevel;
              if($product_name=='MaRRS Play 2 Learn' ) { ;?>
                         
                      <img src="<?php echo base_url();?>images/logo_p2l.png"  alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"   /> 
                   <?php } elseif($product_name=='MaRRS International Spelling Bee Junior'){ ?>
                         
                         
                   <img src="<?php echo base_url();?>images/junior_logo.png"  alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                    <?php } elseif($product_name=='MaRRS International Spelling Bee'){ ?>
                          
                   <img src="<?php echo base_url();?>images/misb_logo.jpg" alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />  
                    
                     <?php }elseif($product_name=='MaRRS International Math Bee'){ ?> 
                           
                    <img src="<?php echo base_url();?>product_logo/mathbee.jpg" alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
                   <?php }elseif($product_name=='MaRRS Scientia Exertus'){ ?>  
                           
                     <img src="<?php echo base_url();?>product_logo/scienceex.jpg"  alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  /> 
                   <?php }elseif($product_name=='MaRRS Preschool Bee English'){ ?>
                           
                     <img src="<?php echo base_url();?>images/international/pc_english.png"    alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   <?php }elseif($product_name=='MaRRS Primary Colors - Science'){ ?>
                           
                     <img src="<?php echo base_url();?>images/international/pc_science.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Math'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_math.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - English'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_english.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Humanities'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_humanities.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                     <?php }elseif($product_name=='MaRRS International Spelling Bee'){ ?>
					
                    <img src="<?php echo base_url();?>images/misb_logo.jpg"  alt="Product Logo" class="text-start" style="border-radius:100px;width:150px;height:150px"  />
					<?php }elseif($product_name=='MaRRS Scientia Exertus'){ ?>  
					
					  <?php } elseif($product_name=='MaRRS Preschool Bee Humanities'){ ?>
                         
                    <img src="<?php echo base_url();?>images/psb_humanities.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                    <?php } elseif($product_name=='MaRRS Preschool Bee Science'){ ?>
                          
                   <img src="<?php echo base_url();?>images/psb_science.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                    
                     <?php }elseif($product_name=='MaRRS Preschool Bee Math'){ ?>
                           
                    <img src="<?php echo base_url();?>images/psb_math.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
                   <?php }elseif($product_name=='MaRRS Preschool Bee English'){ ?>
                           
                     <img src="<?php echo base_url();?>images/psb_english.png"   alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;"  />
                   
					<?php } ?>  
             
               
                <h2 class="card-title text-danger mb-4">Participation Slip-Orientation <?php echo $type; ?></h2>
                <?php 
                   $this->db->select('*');
                   $this->db->from('cin_list');
                   $this->db->where('cin',$cin);
                   $student_data = $this->db->get()->row_array(); ?>
                <table class="table table-borderless mx-auto me-auto w-75 mb-4 text-start">
                <tbody>
                    <tr>
                    <th>CIN Number :</th>
                    <td><?php echo $student_data['cin'];?></td>
                    </tr>
                    <tr>
                    <th>Name of the participant : </th>
                    <td><?php echo $student_data['student_name'];?></td>
                    </tr>
                    <tr>
                    <th>Category : </th>
                    <td><?php echo $student_data['class'];?></td>
                    </tr>
                    <tr>
                    <th>Product Name : </th>
                    <td><?php echo $product_name;?></td>
                    </tr>
                    <tr>
                    <th>Slip Number :</th>
                    <td> <?php 
                    echo $type.$result->id; 
                    
                    ?></td>
                    </tr>
                </tbody>
                </table>
                <p class="card-text">Thank you for registering for the Orientation program for <b><?php 
                                    $this->db->select('level_name');
                                    $this->db->from('competition_level_byproduct');
                                    $this->db->where("level_id",$clevel);
                                    $this->db->where("product_name",$product);
                                    $query = $this->db->get();
                                    //echo $this->db->last_query();
                                    $res= $query->row_array();
                                    print_r($res['level_name']);
                    //echo $clevel;
                ?>.</b></p><p class="card-text"><b> Your participation is confirmed. </b></p>
                <p class="card-text">The schedule of your session will be communicated to you shortly.</p>
            </div>
            </div>
            <a href="#" id="print" class="btn btn-outline-success">PRINT </a>
                <a href="<?php echo base_url();?>/Cin_login/enroll" class="btn btn-outline-danger">CLOSE </a>
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
        document.getElementById("print").addEventListener("click", (event)=>{
      let element = this.document.getElementById("content");
      let opt = {
        margin:       0.1,
        filename:     'Registration Slip.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 3 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

      html2pdf().set(opt).from(element).save();
     
       
    });
</script>
</body>
</html>