<?php include('header.php'); 

?>
<style>
    .table th, .table td {
    padding: 0rem;
}
.logo_title{
        display: flex;
    flex-wrap: nowrap;
    align-items: center;
    padding: 0% 20% 0% 20%;
}
</style>

<style>
    /* Add CSS styles for your invoice here */
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    .invoice-header {
      text-align: right;
    }
    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .invoice-table th, .invoice-table td {
      /*border: 1px solid #ccc;*/
      padding: 8px;
    }
    .invoice-table th {
      background-color: #f2f2f2;
    }
    .invoice-total {
      margin-top: 20px;
      text-align: right;
    }
    .bett{
        display: flex;
        justify-content: space-between;
    }
  </style>

<section>
    <div class="container">
        
        
        <div class="row">
            
            <div class="card text-center my-0 mx-auto container" id="content" >
                <div>
                    <img src="https://marrs.in/student_registration/images/marrszoomzoom.png"   alt="Logo" class="text-start" style="padding-top:20px;width: 140px;margin-right: 5%;border-radius: 10px;
    margin-bottom: 0%;"  />
                </div>
                <div>
                    <table class="invoice-table">
                <thead>
                    <tr>
                        <td>Name:</td><td><b> <?php echo $student['first_name'].' '.$student['middle_name'].' '.$student['last_name']; ?></b></td>
                        
                        <td>PRID:</td><td><b><?php echo $student['zoomzoom_prid']; ?></b></td>
                        <td>Level:</td><td><b><?php echo 'National Zoom Zoom'; ?></b></td>
                    </tr>
                      <tr>
                        
                        <!--<th>Sr. No</th>-->
                        <th> Enrolled</th>
                        <th> PRID</th>
                        <th>Date</th>
                        <th>Payment Mode</th>
                        <th>Payment Id</th>
                        <!--<th>Unit Price</th>-->
                        <th>Price</th>
                
                      </tr>
                </thead>
                 <tbody>
                     
                     <?php //if(){
                     
                   //  } ?>
                     
                     <?php $i=1;$total=0; 
                     
                     if(!empty($zoomzoom)){
                     
                     ?>
                
                       <tr>
                            <!--<td><?php echo $i; ?></td>-->
                            <td><?php echo 'Competition'; ?></td>
                            <td><?php echo $zoomzoom['prid']; ?></td>
                            <td><?php 
                            
                            echo substr($zoomzoom['Time'],0,-9); ?></td>
                            <td>Online</td>
                            <td><?php echo $zoomzoom['razorpay_payment_id']; ?></td>
                            <td>Rs.<?php echo $zoomzoom['amount']; ?>/-</td>
                        </tr>
                        
                        
                        
                        
                       <?php $i=$i+1;$total=$total+$zoomzoom['amount']; }
                       
                       if(!empty($mocktest)){
                     
                     ?>
                
                       <tr>
                            <!--<td><?php echo $i; ?></td>-->
                            <td><?php echo 'Mock Test'; ?></td>
                            <td><?php echo $mocktest['prid']; ?></td>
                            <td><?php 
                            
                            echo substr($mocktest['time'],0,-9); ?></td>
                            <td>Online</td>
                            <td><?php echo $mocktest['razorpay_payment_id']; ?></td>
                            <td>Rs.<?php echo $mocktest['amount']; ?>/-</td>
                        </tr>
                        
                        
                        
                        
                       <?php $i=$i+1;$total=$total+$mocktest['amount']; } 
                       
                       if(!empty($orientatition)){
                     
                     ?>
                
                       <tr>
                            <!--<td><?php echo $i; ?></td>-->
                            <td><?php echo 'Orientation'; ?></td>
                            <td><?php echo $orientatition['prid']; ?></td>
                            <td><?php 
                            
                            echo substr($orientatition['time'],0,-9); ?></td>
                            <td>Online</td>
                            <td><?php echo $orientatition['razorpay_payment_id']; ?></td>
                            <td>Rs.<?php echo $orientatition['amount']; ?>/-</td>
                        </tr>
                        
                        
                        
                        
                       <?php $i=$i+1;$total=$total+$orientatition['amount']; } ?>
                       
                       
                       
                       
                       <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <!--<td></td>-->
                             <td></td>
                            <td>Total=</td>
                            
                            <td>Rs.<?php echo $total;  ?>.00/-</td>
                        </tr>
                        <!--<tr>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--</tr>-->
                        <tr style='text-align:left;'>
                            <td colspan="2">Thanks For Registration.</td>
                            
                           
                            <td></td><td colspan="3" style='text-align:right;'>MaRRS Intellectual Services (P) Ltd.</td>
                        </tr>
                        
                        
                        <!--<tr style='border-style: outset;'> -->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--    <td></td>-->
                        <!--</tr>-->
                        
                 </tbody>
                </table>
                </div>
            </div>
            
            <?php //echo $cart[0]['id']; ?>
        
        
        </div>
        <div>
            
        
            <a href="#" id="print" class="btn btn-outline-success my-2">Download </a>
            <a href="<?php echo base_url();?>/zoomzoom/new_levelzoomzoom" class="btn btn-outline-danger my-2">Back </a>
   
        </div>
    </div>
    
</section>

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
  document.getElementById("print").addEventListener("click", () => {
    const pdfgenWrapper = this.document.getElementById("content");
       let opt = {
         margin:       1,
        filename:     'Registration Slip.pdf',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 5 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
    };
    html2pdf().set(opt).from(pdfgenWrapper).save('Payment Invoice');
  });
};

  </script> 
