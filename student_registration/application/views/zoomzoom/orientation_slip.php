<!DOCTYPE html>
<html>
<head>
    <title>Marrs.in</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="custom.css?update">
</head>
<body>
<style>
*{
    margin:0;
    padding:0;
}

section{
    padding:0% 5%;
}
 table th{
        font-size:18px;
    }
    table td{
        font-size:18px;
            color: #fbf3f3;
            font-weight:600;
    }
    p{
        font-weight:500;
    }
</style>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card text-center my-2" id="content" style="background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);">
            <div class="card-body">
                <?php //$pname = $product->product_name;
                if($result=='MaRRS International Math Bee'){
                    $logo='mathbee.jpg';
                }
                if($result=='MaRRS ZoomZoom'){
                    $logo='zoom.png';
                }
                if($result=='MaRRS Play2Learn'){
                    $logo='p2l.jpg';
                }
                if($result=='MaRRS Scientia Exertus'){
                    $logo='scienceex.jpg';
                }
                if($result=='MaRRS International Math Bee'){
                    $logo='mathbee.jpg';
                }
                ?>
                <image src="<?php echo BASE_URL(); ?>product_logo/<?php echo $logo;?> " alt="Logo" width="100px" height="100px" class="text-start" style="border-radius:100px;" />
                <h2 class="card-title text-danger mb-4">Orientation Slip </h2>
                
                <table class="table table-borderless mx-auto me-auto w-75 mb-4 text-start">
                <tbody>
                    <tr>
                    <th>CIN Number :</th>
                    <td><?php echo $cin;?></td>
                    </tr>
                    <tr>
                    <th>Name of the participant : </th>
                    <td><?php echo $student_data['first_name'];?></td>
                    </tr>
                    <tr>
                    <th>Category : </th>
                    <td><?php echo $student_data['class'];?></td>
                    </tr>
                    <tr>
                    <th>Product Name : </th>
                    <td><?php echo $product->product_name;?></td>
                    </tr>
                    <tr>
                    <th>Slip Number :</th>
                    <td> <?php 
                    
                    $numbers = ['M','R','E','G','Z'];

                
                    $result = str_replace($numbers, "", $student_data['zoomzoom_prid']);
                    
                    echo $result;?></td>
                    </tr>
                </tbody>
                </table>
                <p class="card-text">Thank you for registering for the mocktest program for<br/> <br/> <?php echo $product->product_name;?> National Prelims Championship 2022/23.</p><p class="card-text"><b> Your participation is confirmed. </b></p>
                <p class="card-text">The schedule of your session will be communicated to you shortly.</p>
            </div>
            </div>
            <a href="#" id="print" class="btn btn-outline-success">PRINT </a>
                <a href="<?php echo base_url();?>/zoomzoom/products" class="btn btn-outline-danger">CLOSE </a>
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
