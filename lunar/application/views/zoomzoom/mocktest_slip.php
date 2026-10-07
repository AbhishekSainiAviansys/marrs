<?php include('header.php');?>
<section style="padding: 0% 20%;">
    <div class="container">
        <div class="row" id="certificateWrapper">
            <div class="col-sm-12 col-md-12 col-lg-12 mx-auto">
            <div class="card text-center my-5" id="content" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
                <image src="marrszoomzoom.png" alt="Logo" width="200px"/>
                <h5 class="card-title text-danger mb-5">Participation Slip - Mock Test </h5>
                <table class="table table-borderless mx-auto w-50 mb-5 text-start">
                <tbody>
                    <tr>
                    <th>CIN Number :</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>Name of the participant :</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>Category:</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>Product Name:</th>
                    <td></td>
                    </tr>
                    <tr>
                    <th>Slip Number:</th>
                    <td></td>
                    </tr>
                </tbody>
                </table>
                <p class="card-text">Thank you for registering for the mocktest program for<br/> <br/> MaRRS Preschool Bee English National Level Championship 2021/22.</p><p class="card-text"><b> Your participation is confirmed. </b></p>
                <p class="card-text">The schedule of your session will be communicated to you shortly.</p>
            </div>
            </div>
            <a href="#" id="print" class="btn btn-outline-success">PRINT </a>
                <a href="#" class="btn btn-outline-danger">CLOSE </a>
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
        margin:       0.2,
        filename:     'myfile.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 3 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

      html2pdf().set(opt).from(element).save();
      setTimeout(
        function(){
            window.location = "reg&download.php"; 
        },
    100);
    });
</script>
<?php include('footer.php');?>