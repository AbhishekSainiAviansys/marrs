<?php 
require_once(APPPATH."libraries/phpqrcode/qrlib.php");

//echo $com_id;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admit Card</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="pdfgen.css?update3" rel="stylesheet" />

  </head>

  <style>
 
.table {
    --bs-table-bg: transparent;
    --bs-table-accent-bg: transparent;
    --bs-table-striped-color: #212529;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: #212529;
    --bs-table-active-bg: rgba(0, 0, 0, 0.1);
    --bs-table-hover-color: #212529;
    --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
   
}
table {
    caption-side: bottom;
    border-collapse: collapse;
}
*, ::after, ::before {
    box-sizing: border-box;
}
user agent stylesheet
table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 2px;
    border-color: gray;
}
.table>thead {
    vertical-align: bottom;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
*, ::after, ::before {
    box-sizing: border-box;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
.table>:not(:last-child)>:last-child>* {
    border-bottom-color: currentColor;
}

.table-bordered>:not(caption)>*>* {
    border-width: 0 1px;
}
.table>:not(caption)>*>* {
    padding: 0.5rem 0.5rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}
tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
th {
    text-align: inherit;
    text-align: -webkit-match-parent;
}
*, ::after, ::before {
    box-sizing: border-box;
}
.table-bordered>:not(caption)>* {
    border-width: 1px 0;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
} 


  
  
      * {
        margin: 0;
        padding: 0;
      }
      body {
        font-family: Arial, Helvetica, sans-serif;
      }
      *:focus {
        outline: none;
      }
      ul{
        margin-top: 1%;
      }
      ul li{
        line-height: 1.5;
      }
      section {
        margin: 0% 3%;
      }
      .logo_pic_cin {
        display: flex;
        flex-direction: row;
        padding: 0% 1%;
      }
      .logo_pic_cin div {
        width: 100%;
      }
      .logo_pic_cin input {
        border-style: inset;
        border: 1px solid rgb(60, 54, 54);
        padding: 5px;
        margin-bottom: 0.8%;
      }
      .logo_pic_cin div:nth-child(1) {
        width: auto;
      }

      .logo_pic_cin div:nth-child(2) {
        width: 70%;
      }
      .logo_pic_cin div:nth-child(3) {
        width: auto;
      }
      .pdfgenForm {
  display: flex;
  flex-direction: row;
}
      .pdfgenForm form {
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 2px solid #000;
        border-style: inset;
        padding: 0.8%;
      }
      .participant_details,
      .guardian_details {
        padding: 0% 1%;
        width: 100%;
      }
      .sin,
      .mul {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        margin-bottom: 1rem !important;
      }
      .sin textarea,
      .mul textarea {
        width: 100%;
      }
      .sin input,
      .mul input {
        width: 100%;
      }
      h1 {
        white-space: nowrap;
        font-size: 18px;
      }
      input,
      textarea {
        border-style: dotted;
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        color: rgb(60, 54, 54);
      }
      label {
        white-space: nowrap;
        color: rgb(60, 54, 54);
        font-weight: 400;
        font-size: 16px;
            margin-top: 20px;
      }
      span {
    border-bottom: dashed 1px #000;
    width: 100%;
    padding: 5px 10px 1px 10px;
    font-weight: 600;
    margin-top: 10px;
}
      
      img {
        width: 150px;
        height: auto;
      }
      .details {
        display: flex;
        flex-direction: row;
      }
      .left h2 {
        font-weight: 300;
        font-size: 18px;
        margin-bottom: 0.8%;
      }
      .details input,
      textarea {
        border-style: inset;
        border: 1px solid #000;
        width: 100%;
      }
      .details label {
        margin-bottom: 1.5%;
        margin-top: 1.5%;
        font-weight: bolder;
        color: #000;
        margin-right: 5px;
      }
      .left,
      .right {
        padding: 10px;
        width: 100%;
      }
      .left div {
        flex-wrap: nowrap;
        display: flex;
      }
      .right div {
        flex-wrap: nowrap;
        display: flex;
      }
      .list_of_info {
        display: flex;
        flex-direction: row;
      }
      .list_of_info ol {
        padding: 3%;
      }
      
      .list_of_info ol li {
        font-size: 12px;
        padding: 1%;
        margin-left: 6%;
        font-weight: 400;
      }
      .program-info {
        background-color: lightgray;
        padding: 10px;
      }
      .other_info {
        padding: 0% 1%;
      }
      .program-info p {
        text-align: center;
        font-weight: bolder;
        font-size:14px;
      }
      .reg_info p {
        text-align: center;
        padding: 1%;
      }
      .reg_info ul li{
        font-size:15px;
      }
      .prog_info div {
        flex-wrap: nowrap;
        display: flex;
      }
      .prog_info input {
        width: 100%;
        margin-top: 0.8%;
      }
      .prog_info label {
        margin-top: 2%;
        font-weight: 400;
        color: #000;
        margin-right: 5px;
        font-size:14px;
      }
      #pdfgen {
        width: 160px;
        height: 40px;
        background-color: darkslateblue;
        color: #ffff;
        font-weight: 400;
        font-size: medium;
              border-radius: 10px; 
    margin-left: 200px;
    position: relative;
    top: -10px;
      }
      #pdfgen:hover {
        background-color: orange;
        color: #000;
        border: 1px solid blue;
      }
      .sincom {
    line-height: 1.5;
}
.sincom span {
    margin-top:0.5%;
}
    </style>
  <body>
    <section id="pdfgenWrapper">
      <div class="pdfgenApp">
      <form method="post" action="">
        <div style="width:100%;text-align:center;padding:2%;">
                    <h1>ADMIT CARD</h1>
        </div>      
      <div class="logo_pic_cin">
                <div>
                    <?php 
             //$cin = $_SESSION['cin'];
             
             $this->db->select('*');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             //$this->db->order_by('clevel','DESC');
             $res = $this->db->get()->row();
             $product_name = $res->product_name;
            //   $clevel = $res->clevel+1;
               if($product_name=='MaRRS Play 2 Learn' ) { ;?>
                         
                     <img src="<?php echo base_url();?>images/logo_p2l.png"  alt="Product Logo" id='logo'style='width:50%;'  /> 
                   <?php } elseif($product_name=='MaRRS International Spelling Bee Junior'){ ?>
                         
                   <img src="<?php echo base_url();?>images/junior_logo.png"   alt="Product Logo" id='logo'style='width:50%;height:150px'  />
                    <?php } elseif($product_name=='MaRRS International Spelling Bee'){ ?>
                          
                   <img src="<?php echo base_url();?>images/misb_logo.jpg"  alt="Product Logo" id='logo'style='width:50%;height:140px' />  
                    
                     <?php }elseif($product_name=='MaRRS International Math Bee'){ ?>
                           
                    <img src="<?php echo base_url();?>product_logo/mathbee.jpg"  alt="Product Logo" id='logo'style='height:150px;height:150px'  />
                   
                   <?php }elseif($product_name=='MaRRS Scientia Exertus'){ ?>
                           
                     <img src="<?php echo base_url();?>product_logo/scienceex.jpg"   alt="Product Logo" id='logo'style='width:50%;height:150px'  /> 
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Science'){ ?>
                           
                     <img src="<?php echo base_url();?>images/international/pc_science.png"  alt="Product Logo" id='logo'style='width:50%;'  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Math'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_math.png"  alt="Product Logo" id='logo'style='width:50%;'  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - English'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_english.png"  alt="Product Logo" id='logo'style='width:50%;'  />
                   
                   <?php }elseif($product_name=='MaRRS Primary Colors - Humanities'){ ?>
                           
                    <img src="<?php echo base_url();?>images/international/pc_humanities.png"  alt="Product Logo" id='logo'style='width:50%;'  />
                    <?php }elseif($product_name=='MaRRS International Spelling Bee'){ ?>
					
                    <img src="<?php echo base_url();?>images/misb_logo.jpg"  alt="Product Logo" id='logo'style='width:50%;'  />
					<?php }elseif($product_name=='MaRRS Scientia Exertus'){ ?>
					
					 <img src="<?php echo base_url();?>product_logo/scienceex.jpg"  alt="Product Logo" id='logo'style='width:50%;'  />
					<?php }elseif($product_name=='MaRRS International Math Bee'){  ?>
					<img src="<?php echo base_url();?>images/misb_logo.jpg"  alt="Product Logo" id='logo'style='width:50%;'  />
					
					<?php }elseif($product_name=='MaRRS Preschool Bee Math'){  ?>
					<img src="<?php echo base_url();?>images/psb_math.png"  alt="Product Logo" id='logo'  />
					
					<?php }elseif($product_name=='MaRRS Preschool Bee English'){  ?>
					<img src="<?php echo base_url();?>images/psb_english.png"  alt="Product Logo" id='logo'  />
					
					<?php }elseif($product_name=='MaRRS Preschool Bee Science'){  ?>
					<img src="<?php echo base_url();?>images/psb_science.png"  alt="Product Logo" id='logo' />
					
						<?php }elseif($product_name=='MaRRS Preschool Bee Humanities'){  ?>
					<img src="<?php echo base_url();?>images/psb_humanities.png"  alt="Product Logo" id='logo'  />
					
					
					<?php } ?>  
			  
                </div>
                
              
			  
                <div style="text-align: right;padding:0% 1%;">
                    <label for="cin">CIN:</label>
                    <input type="text" name="cin" value="<?php echo $cin;?>" id="class" />
                    <br/>
                    <label for="ccn">CHEST CARD NUMBER:</label>
                    <input type="text" name="ccn" id="ccn"/>                
                </div>
                <div>
                    <img src="<?php echo base_url();?>images/affix_pic.png" alt="Photo" width="150" height="auto" style="border:1px solid #000;">
                </div>
        </div>
        <div class="pdfgenForm">
            <div class="participant_details">
               <?php 
               $this->db->select('*');
             $this->db->from('cin_list');
            // $this->db->join('school_new','school_new.id=cin_list.school_id');
             $this->db->where('cin',$cin);
              $data = $this->db->get()->row(); 
              //echo $this->db->last_query();
             //print_r($data); ?>
              <div class="sin">
                <label for="fullname">Name of the Participant : </label>
               <span> <?php echo $data->student_name;?> </span>
              </div>
               <div class="sin">
                <label for="fullname">Category : </label>
               <span> <?php echo $data->class;
                  ?> </span>
              </div>
              <div class="sin">
                <label for="nosch_add">Name of School : </label>
                <span> <?php
                if(!empty($data->school_name)){
                echo $data->school_name;
                }else{
                    $this->db->select('school_new.school_name');
                    $this->db->from('cin_list');
                    $this->db->join('school_new','school_new.id=cin_list.school_id');
                    $this->db->where('cin',$cin);
                    $data_ = $this->db->get()->row(); 
                    echo $data_->school_name;
                }?></span>
              </div>
              <div class="sin">
                   <label for="nosch_add">School Address : </label>
               <span> <?php echo $data->school_address1;?> </span>
              </div>
              <div class="mul">
                <label for="telno">Tel. No.:</label>
                 <span> <?php echo $data->stud_phone;?> </span>
              </div>
              <div class="sin">
                <label for="pemail">E-mail:</label>
                <span> <?php echo $data->stud_email;?> </span>
              </div>
              
            
               
               
            </div>
          
        </div>
      <br>
        <!-- <div class="details">
          <div class="left">
            <h2 style="border-bottom: 1px solid #000;font-weight:500;font-weight:700;padding-bottom:20px">
              DETAILS OF THE COMPETITION
            </h2>
            <div>
              <label for="category">Date : </label>
             <span 
                style="height: 40px; width: 80%;    border: solid 1px #000;line-height: 1.5;font-weight: 600;"
              > 8th April - 2023 </span> 
            </div>
          </div>
          
        </div>-->
        
        
        
        
        
        
        
        </form>
      </div>
      
          
          
      
     
      <div class="other_info">
        <div class="prog_info">
      <fieldset style="    padding: 10px 20px 10px 20px;margin-bottom: 1%;">          
              <!--<div class="sincom">
             <label for="ptime">COMPETITION TIME : </label>
           
              <span> 10:0 A.M </span>
                   
            </div>-->
            <div class="sincom">
            <label for="reg">REGISTRATION : </label>
            <span>Marrs Registration </span>
            </div>
            <div class="sincom"> 
          <label for="compt">COMPETITION : </label>
         <span> 
         <?php 
         $res = $this->db->get_where('competition_level_byproduct',array('level_id' =>$clevel,'product_name'=>$product))->row();
        
         $str = str_replace('_', ' ', $res->level_name);echo $str;
         ?>
         
         
         </span>
          </div>
         </fieldset>  
</div>
      

      </div>
      
       <div class="other_info">
          
          <!--<div class="program-info">
            <p>
             An optional orientation programme will be conducted for the students qualified for MaRRS Primary Colors International Championship.</p>
             <p>The orientation program is for students only.</p>
             <p>Parents interested in registering may log on to www.marrs.in
            </p>
          </div>-->
		  <br>
          <div class="reg_info">
            <h4 style="margin-top:2%;text-align:center;">RULES FOR THE COMPETITION</h4>
            <ul>
			<li> Carry 2 copies of the Admit Card.</li>
            <li>   CARRY:  Compass Box with Pencil, Eraser, Water, Snacks. </li>
            <li>  Wear School Uniform & School ID.
</li>
              <li>Please bring a copy of this admit card duly signed, to be handed over at the time of registration.</li>
              <li>MaRRS Interschool Championship arrangements on the same day of the competition before 10 p.m. is not advisable.</b></li>
              <li>Participants are requested to be present at the venue only at the registration date and time fixed for the respective category. They will be allowed into the premises only half an hour before the registration time of their category.</li> 
              <li>The competition will be postponed if unforeseen circumstances like harthal, terrorist attack or natural calamities occur on the declared day of the competition.</li>
            </ul>
          </div>
          <div style="text-align: right;">
            <p style="margin-top:5%;">I hereby agree to adhere to the rules of the competition.</p>
            <p style="margin-top:5%;">Signature of the Guardian</p>
          </div>
        </div>
      
      </form>
      <div style="text-align:center;">
    
</div>
<?php   $cin = $this->session->userdata('cin');
    $stud_data = $this->db->get_where('cin_list',array('cin'=> $cin))->row();
     $stud_result = $this->db->get_where('cin_result',array('cin'=> $cin))->row();
   // print_r($stud_data->student_name);
     'marrs registration';
	$tempDir = $_SERVER['DOCUMENT_ROOT'].'/student_registration/qrcode/'; 
	$email = $stud_data->student_name;
	$subject =  'marrs registration';
	$filename = $cin;
	//$filename =  uniqid();
	$body =  $cin;
	$codeContents = 'Cin - '.$cin.' Student Name = '.$stud_data->student_name. ' Grade = '.$stud_result->grade; 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
?>
   <div><img src="<?php echo base_url('qrcode/').$filename;?>.png" style="width:120px;margin-top: -80px;
    margin-left: 100px;"></div>
	
	<br><br>
	    <div class="">
          <div class="">
            <h4 style="border-bottom: 1px solid #000;font-weight:500;font-weight:700;padding-bottom:20px;padding-top:20px;font-family: serif;">
              DETAILS OF THE COMPETITION : 
            </h4>
			<h4 style="padding:10px;"> Schedule And Venue For - <?php echo $product; ?></h4>    

             
                
									<table class="table table-bordered">
									 <thead>
									     <tr>
									         <th>Sr. No.</th>
								   <th>Date</th>
								   <!--<th width="15%" > Class</th>-->
								   <th >Class / Time</th>     
								   <th> Venue</th> 
								   <th> Address</th> 
								   </tr>
								   </thead>
								   <tbody>  
								   
								   <?php   
								    $res = $this->db->get_where('exam_centers',array('comp_id' =>$com_id))->result_array();
								    // print_r($res);
								    $i=1;
								    foreach($res as $row){
								   ?>
								    <tr>
								       <td><?php echo $i; ?></td>
    								   <td style='width:120px;'><?php echo $row['exam_date'];?></td>
    								   <!--<td>All Classes</td> -->
    								   <td><?php echo $row['exam_time']; ?></td> 
    								   <td><?php echo $row['center_name']; ?></td>    
                                       <td><?php echo $row['center_address'];?> </td>								   
								    </tr>
									
								   
									<?php $i=$i+1;} ?> 
								   </tbody>
								   </table>
								 
								   
                   
				   
          
          </div>
        </div>
	 
    </section>
      <button class="btn btn-primary" id="pdfgen">Download PDF</button>

<!--<button class="btn btn-primary" id="pdfgen">BACK</button>-->

  




 <script
      src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
      integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
 <script>
      window.onload = function () {
  document.getElementById("pdfgen").addEventListener("click", () => {
    const pdfgenWrapper = this.document.getElementById("pdfgenWrapper");
    html2pdf().from(pdfgenWrapper).save('admit card');
  });
};

  </script> 
</body>
</html>
