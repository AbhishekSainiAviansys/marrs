<?php 
require_once(APPPATH."libraries/phpqrcode/qrlib.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>pdfgen</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="pdfgen.css?update3" rel="stylesheet" />
  </head>

  <style>
  a{text-decoration: none;}
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
        font-size:12px;
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
    margin-left: 120px;
    position: relative;
    top: 0px;
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
             
             $this->db->select('product_name');
             $this->db->from('cin_result');
             $this->db->where('cin',$cin);
             $datalogo = $this->db->get()->row()->product_name;
             //echo $datalogo;die;
             $logo='';
             
             if($datalogo=='MaRRS International Spelling Bee'){?>
                <img src="<?php echo base_url();?>images/misb_logo.jpg"  alt="Product Logo" id='logo'style='width:25%;'  /><?php 
             }
             if($datalogo=='MaRRS Preschool Bee Math'){
                 ?>
                <img src="<?php echo base_url();?>images/math_logo.png"  alt="Product Logo" id='logo' /><?php 
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                 ?>
                <img src="<?php echo base_url();?>images/english_logo.png"  alt="Product Logo" id='logo' /><?php 
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                ?>
                <img src="<?php echo base_url();?>images/science_logo.png"  alt="Product Logo" id='logo' /><?php 
                
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 ?>
                <img src="<?php echo base_url();?>images/humanities_logo.png"  alt="Product Logo" id='logo' /><?php
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                 ?>
                <img src="<?php echo base_url();?>images/junior_logo.png"  alt="Product Logo" id='logo' /><?php
                 
             }
             
             ?>
                </div>
                
                 <?php 
             //$cin = $_SESSION['cin'];
             
             $this->db->select('*');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
        
             ?>
                <div style="text-align: right;padding:0% 1%;">
                    <label for="cin">CIN:</label>
                    <input type="text" name="cin" value="<?php echo $data->cin;?>" id="class" />
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
               
              <div class="sin">
                <label for="fullname">Name of the Participant : </label>
               <span> <?php echo $data->student_name;?> </span>
              </div>
              
              <div class="sin">
                <label for="nosch_add">Name of School : </label>
                <span> <?php echo $data->school_name ;?></span>
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
      
         <div class="details">
          <div class="left">
            <h2 style="border-bottom: 1px solid #000;font-weight:500;">
              DETAILS OF THE COMPETITION
            </h2>
            <div>
              <label for="category">Date : </label>
             <span 
                style="height: 40px; width: 80%;    border: solid 1px #000;line-height: 1.5;font-weight: 600;"
              >Saturday, 5th November - 2022 </span>
            </div>
          </div>
          <div class="right">
            <div style="margin-top: 4%">
              <label for="prog_sch">VENUE : </label>
              <span 
                style="height: 100px; width: 100%;    border: solid 1px #000;
   
    line-height: 1.5;
    font-weight: 600;
   "
              > <a href="https://g.page/gccinternationalschool?share">GCC International SChool
Behind GCC Hotel and Club,

Off. Mira Bhayander Road,

Mira Road (East), Thane - 401107 </a></span>
            </div>
          </div>
        </div>
        
        
        
        
        
        
        
        </form>
      </div>
      
          
          
      
     
      <div class="other_info">
        <div class="prog_info">
        <fieldset style="padding: 0px 20px 10px 20px;margin-bottom: 1%;">          
             
            <!--<div class="sincom">-->
            <!--<label for="reg">REGISTRATION : </label>-->
            <!--<span><?php echo $datalogo;?> </span>-->
            <!--</div>-->
            <div class="sincom"> 
          <label for="compt">COMPETITION : </label>
         <span> National Championship (2021-22)</span>
          </div>
           <div class="sincom">
            
             
              <?php   if($datalogo=='MaRRS International Spelling Bee'){?>
               <label for="ptime">Reporting Time : </label>
                <span> 11:30 AM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 12:00 PM </span>
                <?php }
             if($datalogo=='MaRRS Preschool Bee Math'){
                 ?>
              <label for="ptime">Reporting Time : </label>
                <span> 01:30 PM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 02:00 PM </span>
               
               <?php 
                
             }
             if($datalogo=='MaRRS Preschool Bee English'){
                 ?>
                 <label for="ptime">Reporting Time : </label>
                <span> 08:30 AM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 09:00 AM </span>
                <?php 
                 
             }
             if($datalogo=='MaRRS Preschool Bee Science'){
                ?>
               <label for="ptime">Reporting Time : </label>
                <span> 08:30 AM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 09:00 AM </span>
               <?php 
                
             }
             if($datalogo=='MaRRS Preschool Bee Humanities'){
                 ?>
                 <label for="ptime">Reporting Time : </label>
                <span> 01:30 PM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 02:00 PM </span>
                 <?php
                  
             }
             if($datalogo=='MaRRS International Spelling Bee Junior'){
                 ?>
                 <label for="ptime">Reporting Time : </label>
                <span> 11:30 PM </span>
                
              <label for="ptime">Competition Start Time : </label>
               <span> 12:00 Noon</span>
                 
                 <?php
                 
             }
             
             ?>
            
            </div>
         </fieldset>    
</div>
      

      </div>
      
       <div class="other_info">
          
          <div class="program-info">
            <!--<p>-->
            <!-- An programme will be conducted for the students qualified for MaRRS Preschool Bee National Championship.</p>-->
             <!--<p>The orientation program is for students only.</p>-->
            <!-- <p>Parents interested in registering may log on to <a href="https://marrs.in">www.marrs.in</a>-->
            <!--</p>--> 
          </div>
          <div class="reg_info">
            <h4 style="margin-top:2%;text-align:center;">RULES FOR THE COMPETITION</h4>
            <ul>
                <li>This admit card is mandatory to participate in the competition. It should always be with the participant and shown whenever  requested for.</li>
             <li>The participants should wear their school uniform at the competition.</li>
             <li>The participants are requested to carry their own crayons and writing materials.</li>
              <li>Participants are requested to be present at the venue only at the registration/competition date and time fixed for the respective category. They will be allowed into the premises only half an hour before the registration/competition time of their category.</li>
              <li>Pre School Bee, being a competition with multiple rounds, may last the entire day.</li>
              <li><b>Making return travel arrangements on the same day of the competition before 10 PM is not advisable.</b></li>
             
              <li>The competition will be postponed if unforeseen circumstances like harthal, terrorist attack or natural calamities occur on the declared day of the competition.</li>
               
            
            </ul>
             <br>
              <p style="float:left">Download Time : <?php $datetime = new DateTime( "now", new DateTimeZone( "Asia/Calcutta" ) );

            echo $datetime->format( 'd F Y,H:i:s' );?></p>
          </div>
          <div style="text-align: right;">
              <br>
            <p style="margin-top:1%;">I hereby agree to adhere to the rules of the competition.</p>
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
	$codeContents = 'Cin - '.$cin.' Student Name = '.$stud_data->student_name.'Grade = '.$stud_result->grade; 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
?>
   <div><img src="<?php echo base_url('qrcode/').$filename;?>.png" style="width:100px;margin-top: -80px;
    margin-left: 100px;"></div>
    </section>
      <button class="btn btn-primary" id="pdfgen">Download Admitcard</button>

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
    html2pdf().from(pdfgenWrapper).save('Admit-Card-National');
  });
};

  </script>
</body>
</html>

