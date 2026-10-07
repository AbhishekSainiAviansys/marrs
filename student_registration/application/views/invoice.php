<?php include('student_header.php'); 
//print_r($cart);
//echo base_url();
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
                    <img src="<?php echo base_url();?>/images/marrs-logo.png"   alt="Logo" class="text-start" style="padding-top:20px;width: 140px;margin-right: 5%;border-radius: 10px;
    margin-bottom: 0%;"  />
                </div>
                <div>
                <table class="invoice-table" width='50%'>
                    <thead>
                    <tr>
                        <td>Name:</td><td><b> <?php echo $student['first_name'].' '.$student['middle_name'].' '.$student['last_name']; ?></b></td>
                        
                        <td>Email:</td><td><b><?php echo $student['email']; ?></b></td>
                        <td>Mobile:</td><td><b><?php echo $student['mobile']; ?></b></td>
                    </tr>
                    <tr>
                        <th>Reg. :</th>
                        <!--<th>Sr. No</th>-->
                        <th>Products Invoice</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Level Name:</th>
                        <th> Online</th>
                    </tr>
                      <tr>
                        
                        <th>Sr. No</th>
                        <th>Product Enrolled</th>
                        <th>CIN</th>
                        <th>Date</th>
                        <th>Payment Mode</th>
                        <th>Payment Id</th>
                        <!--<th>Unit Price</th>-->
                        <th>Price</th>
                
                      </tr>
                </thead>
                 <tbody>
                     
                     <?php $i=1;$total=0; foreach($cart as $row){?>
                       <tr>
                            <td><?php echo $i.'.'; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['cin']; ?></td>
                            <td><?php 
                            
                            echo substr($row['time'], 0, -8); ?></td>
                            <td>
                                <?php
                                $this->db->Select('*');
                                $this->db->from('competition_level_byproduct');
                                //$this->db->join('','');
                                $this->db->where('product_name',$row['product_name']);
                                $query=$this->db->get()->row_array();
                                echo $query['level_name'];
                                ?>
                            </td>
                            <td><?php echo $row['rozarpay_payment_id']; ?></td>
                            <td>Rs.<?php echo $row['amount']; ?>/-</td>
                        </tr>
                       <?php $i=$i+1;$total=$total+$row['amount']; } ?>
                       
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
                            <td></td>
                             <td></td>
                            <td>Total=</td>
                            
                            <td>Rs.<?php echo $total;  ?>.00/-</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr style='text-align:left;'>
                            <td colspan="3">Thanks For Registration.</td>
                            
                           
                            <td></td><td colspan="3" style='text-align:right;'>Marrs Intellectual Services Pvt. Ltd.</td>
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
            <a href="<?php echo base_url();?>welcome/product_purchase" class="btn btn-outline-danger my-2">Back </a>
   
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
         margin:       0.5,
        filename:     'Registration Slip.pdf',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 5 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
    };
    html2pdf().set(opt).from(pdfgenWrapper).save('Payment Invoice');
  });
};

  </script> 
