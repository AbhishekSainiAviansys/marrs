<!DOCTYPE html>
<html>
<head>
    <title>Marrs.in</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <style>
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
        text-align:justify;
        font-size: 14px;
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
        text-align: right;
      }
      .logo_pic_cin input {
        border-style: inset;
        border: 1px solid rgb(60, 54, 54);
        padding: 5px;
        margin-bottom: 1%;
      }
      .logo_pic_cin div:nth-child(1) {
        text-align: left;
      }
    
      .logo_pic_cin div:nth-child(4) {
        text-align: right;
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
        padding: 1%;
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
        margin-bottom: 0.3rem !important;
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
        background: none;
      }
      label {
        white-space: nowrap;
        color: rgb(60, 54, 54);
        font-weight: 400;
        font-size: 15px;
      }
      img {
        width: 100px;
        height: auto;
      }
      .details {
        display: flex;
        flex-direction: row;
        padding: 0% 1.5%;
      }
      .left h2 {
        font-weight: 300;
        font-size: 16px;
        margin-bottom: 1%;
        text-align: left;
      }
      .details input,
      textarea {
        border-style: inset;
        border: 1px solid #000;
        width: 100%;
      }
      .details label {
        margin-bottom: 2%;
        margin-top: 0%;
        font-weight: 600;
        color: #000;
        margin-right: 5px;
        font-size: 13px;
      }
      .left,
      .right {
        padding:0px 10px;
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
      .list_of_info ol h4 {
        font-family: "Times New Roman", Times, serif;
      }
      .list_of_info ol li {
        font-size: 12px;
        padding: 1%;
        margin-left: 6%;
        font-weight: 400;
        font-family: "Times New Roman", Times, serif;
      }
      .program-info {
        background-color: #ffff;
        padding: 8px;
        border-radius: 10px;
      }
      .other_info {
        padding: 0% 1%;
      }
      .program-info p {
        text-align: center;
        font-weight: bolder;
        margin-bottom:0px;
        font-size: 12px;
      }
      .reg_info p {
        text-align: center;
        padding: 1%;
      }
      .prog_info div {
        flex-wrap: nowrap;
        display: flex;
      }
      .prog_info input {
        width: 100%;
        margin-top: 0.2%;
      }
      .prog_info label {
        margin-top: 0.2%;
        font-weight: bolder;
        color: #000;
        margin-right: 5px;
        font-size: 13px;
      }
      .reg_info h4{
        font-size:16px;
      }
      #pdfgen {
        width: 160px;
        height: 40px;
        background-color: darkslateblue;
        color: #ffff;
        font-weight: 400;
        font-size: medium;
      }
      #pdfgen:hover {
        background-color: orange;
        color: #000;
        border: 1px solid blue;
      }
    </style>
</head>
<body>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="card text-center" id="content" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
           
            <form method="post" action="">
          <div class="logo_pic_cin">
            <div>
              <img
                src="<?php echo base_url();?>images/marrszoomzoom.png"
                alt="Logo"
                style="border: none; width: 100px; height: auto"
              />
            </div>
            <div>
              <h1 style="margin-bottom:0px;text-align: center;">ADMIT CARD</h1>
            </div>
            <!-- <div style="text-align: right; padding: 0% 1%">
              <label for="cin">CIN:</label>
              <input type="text" name="cin" id="class" />
              <br />
              <label for="ccn">CHEST CARD NUMBER:</label>
              <input type="text" name="ccn" id="ccn" />
            </div> -->
            <div>
              <img
                src="<?php echo base_url();?>images/affix_pic.png"
                alt="Photo"
                width="150"
                height="auto"
                style="border: 1px solid #000"
              />
            </div>
          </div>
          <div class="pdfgenForm">
            <div class="participant_details">
              <div class="sin">
                <label for="fullname">Name of the Participant:</label>
                <input type="text" name="fullname" id="fullname" />
              </div>
              <div class="mul">
                <label for="class">Std&Div:</label>
                <input type="text" name="class" id="class" />
                <label for="dob">Age & Date of Birth:</label>
                <input type="text" name="dob" id="dob" />
              </div>
              <div class="sin">
                <label for="nosch_add">Name of School & Address:</label>
                <input type="text" name="nosch_add" id="nosch_add" />
              </div>
              <div class="mul">
                <label for="telno">Tel. No.:</label>
                <input type="tel" name="telno" id="telno" />
              </div>
              <div class="sin">
                <label for="pemail">E-mail:</label>
                <input type="email" name="pemail" id="pemail" />
              </div>
              <div class="sin">
                <label for="noprincipal">Name of the Principal:</label>
                <input type="text" name="noprincipal" id="noprincipal" />
              </div>
              </div>
              
          </div>
        </form>
      </div>
      <form>
        <div class="details">
          <div class="left">
            <h2 >
              DETAILS OF THE COMPETITION
            </h2>
            <div>
              <label for="category">CATEGORY:</label>
              <input type="text" name="category" id="category" style="height: 30px;" />
            </div>
          </div>
          <div class="right">
            <div style="margin-top: 3.5%">
              <label for="prog_sch">VENU:</label>
              <textarea
                type="text"
                name="prog_sch"
                id="prog_sch"
                style="height: 50px; width: 100%"
              ></textarea>
            </div>
          </div>
        </div>
        <div class="other_info">
          <div class="prog_info">
            <fieldset style="padding:0% 1.5%;margin-bottom:1%;">
              <div>
                <label for="ptime">TIME:</label>
                <input type="text" name="ptime" id="ptime" />
              </div>
              <div>
                <label for="reg">REGISTRATION:</label>
                <input type="text" name="reg" id="reg" />
              </div>
              <div>
                <label for="compt">COMPETITION:</label>
                <input type="text" name="compt" id="compt" />
              </div>
            </fieldset>
          </div>
          <div class="program-info">
            <p>
             An optional orientation programme will be conducted for the students qualified for MaRRS Preschool Bee National Championship.</p>
             <p>The orientation program is for students only.
             Parents interested in registering may log on to www.marrs.in
            </p>
          </div>
          <div class="reg_info">
            <h4 style="margin-top:1%;text-align:center;margin-bootom:0%;">RULES FOR THE COMPETITION</h4>
            <ul style="margin-bottom:0%;">
              <li>Pre School Bee, being a competition with multiple rounds, may last the entire day.</li>
              <li><b>Making travel arrangements on the same day of the competition before 10 p.m. is not advisable.</b></li>
              <li>Participants are requested to be present at the venue only at the registration date and time fixed for the respective category. They will be allowed into the premises only half an hour before the registration time of their category.</li>
              <li>The competition will be postponed if unforeseen circumstances like harthal, terrorist attack or natural calamities occur on the declared day of the competition.</li>
            </ul>
          </div>
          <div style="text-align: right;">
            <p style="text-align: left;padding: 0% 2%;margin-bottom:0%;">I hereby agree to adhere to the rules of the competition.</p>
            <p style="margin-top:0%;">Signature of the Guardian</p>
          </div>
        </div>
      </form>
           </div>
            </div>
            <a href="#" id="print" class="btn btn-primary">PRINT </a>
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
    document.getElementById("print").addEventListener("click", (event) => {
        let element = document.getElementById("content");
        let opt = {
            margin: 0,
            filename: 'myfile.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 4 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
        setTimeout(function () {
            // Optionally, you can add code to redirect or perform other actions after saving the PDF.
        }, 100);
    });
</script>


</body>
</html>