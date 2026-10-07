<!DOCTYPE html>
<html>
  <head>
    <title>orntslip</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      body {
        font-family: Arial, Helvetica, sans-serif;
      }
      #orntslipWrapper {
        margin: 2% 20% 2% 20%;
        text-align: left;
      }
      #orntslipWrapper img {
        width: 150px;
        height: auto;
        margin: 1% 0%;
      }
      #orntslipWrapper h1 {
        text-align: left;
        color: #23b9ea;
        margin: 3% 0%;
        font-size: 18px;
      }
      #orntslipWrapper p {
        line-height: 2.5;
      }
      .orntslip table {
        text-align: center;
        margin: 0 auto;
        width: 100%;
        padding: 2% 0% 5% 0%;
        border-top: 1px solid #343434;
        border-bottom: 1px solid #343434;
      }
      .orntslip th,
      td {
        padding: 1%;
      }
      .orntslip th {
        color: orange;
      }
      .orntslip td {
        color: #343434;
        font-weight: bold;
      }
      .cong {
        width: 100%;
      }
      .cong input,
      select {
        border: none;
      }
      .cong table {
        color: #343434;
        display: inline-table;
      }
      .cong th,
      td {
        padding: 0px;
      }
      #pdfgen {
        margin-top: 2%;
        width: 200px;
        height: 50px;
        background-color: #343434;
        color: #ffff;
        font-weight: 500;
        font-size: medium;
      }
      #back{
        margin-top: 2%;
        width: 200px;
        height: 50px;
        background-color: #343434;
        color: #ffff;
        font-weight: 500;
        font-size: medium; 
      }
      #logo{
          width:50%;
      }
    </style>
  </head>
  <body>
     
    <section id="orntslipWrapper">
      <div style='text-align:center;'>
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
             
             
        <!--<img src="<?php echo base_url();?>images/<?php $logo;?>"  alt="Product Logo" />-->
            <h1> Orientation Participant Slip</h1>
      </div>
      <div class="orntslip">
        <div>
          <table class="slip_info">
            <tr>
              <th>CIN Number:</th>
              <th>Name of the participant:</th>
              <th>Class:</th>
              <th>Orientation Receipt No:</th>
            </tr>
             <?php 
             //$cin = $_SESSION['cin'];
             
             $this->db->select('cin,class,student_name');
             $this->db->from('cin_list');
             $this->db->where('cin',$cin);
             $data = $this->db->get()->row();
        
             ?>
            <tr>
              <td><?php echo $data->cin;?></td>
              <td><?php echo $data->student_name;?></td>
              <td><?php echo 'Class- '.$data->class;?></td>
              <td><?php echo 'OR-'.$data->cin;?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="cong">
        <p>
          Thank you for registering for the orientation program for<br />
          <table>
          <td>“<?php echo $datalogo;?>”</td
          ><td> National Level Championship</td><td> 2021/22.</td>
        </table>
        </p>
        <p><b>Your participation is confirmed.</b></p>
       

      </div>
    </section>
     
     <form method='post'>
         <div style='display:flex;'>
             <button id="pdfgen" style="margin-left: 300px;">Generate PDF</button>
             <button name="back" style="margin-left: 300px;" id='back'>BACK</button>
         </div>
         
     </form>
     
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
    const orntslipWrapper = this.document.getElementById("orntslipWrapper");
    html2pdf().from(orntslipWrapper).save();
  });
};
  </script>
  </body>
</html>
