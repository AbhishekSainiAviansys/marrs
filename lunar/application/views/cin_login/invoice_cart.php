<?php //print_r($payment);
$va=$this->db->get_where('cin_result',array('cin'=>$cin))->row();
   
?>

<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Invoice Template</title>

  <style>

    /* Add CSS styles for your invoice here */

    body {

      font-family: Arial, sans-serif;

      padding: 5px;
overflow-x:hidden;
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

      border: 1px solid #ccc;

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

</head>

<body>
    
    
<div class='container my-5 border border-bottom-0' id='content'>    

    <div class="  bett " >

        <div>

            <img style="height:50px;margin:25px" src="<?php echo base_url();?>images/marrs_logo.png" alt="">


        </div>

        

        <div class="invoice-header">

            <h1>Invoice</h1>

            <p>Invoice Number: <?php echo $payment[0]['id']; ?></p>

            <p>Date: <?php 
            $dateString = $payment['Time'];

// Create a DateTime object from the string
$dateTime = new DateTime($dateString);

// Format the DateTime as a more readable date
$formattedDate = $dateTime->format('F j, Y');

echo $formattedDate;

            
          //  echo $payment['Time']; 
          ?></p>

        </div>

    </div>

<hr>

  <div class="billing-info">

    <h2>Customer Information</h2>
    <p>CIN: <?php echo $va->cin;?></p>
    <p>Customer Name: <?php echo $data->student_name;?></p>

    <p>Address: <?php echo $data->address1.$data->address2;?></p>

    <p>Email: <?php echo $data->stud_email;?></p>
<p>Competition Level: <?php echo $nlev->level_name; ?></p>
  </div>



  <table class="invoice-table">

    <thead>

      <tr>

        <th>Sr.No</th>
        <th>Product</th>
        <th>Competition</th>
        <th>Study Material A</th>

        <th>Orientation A</th>
        <th>Study Material B</th>

        <th>Orientation B</th>
        <th>Mock Test</th>
        <th>Total Amount</th>
      </tr>

    </thead>

    <tbody>
   <?php $i=1; $amount=0;
   foreach($payment as $value){ 
   ?>
      <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $va->product_name; ?></td>
            
            <td>
                <?php 
                if($value['clevel']=='1'){
                    echo 'Purchased';
                }else{
                    echo $value['status'];
                }
                
                ?>
            </td>
            
            <td>
                <?php 
                if($value['study_material']=='Yes' or $value['study_material']=='yes') { 
                  echo 'Purchased';
                        }
                else{
                  echo 'No'; }
                  ?>
            </td>
            
              
            <td>
            <?php 
            if($value['orientation']=='Yes' or $value['orientation']=='yes'){ 
                echo 'Purchased';
                
            }else{
                echo 'No';
            
            }
            ?>
            </td>
            
            <td>
                <?php 
                if($value['study_material_b']=='Yes' or $value['study_material_b']=='yes') { 
                  echo 'Purchased';
                        }
                else{
                  echo 'No'; }
                  ?>
            </td>
            
              
            <td>
            <?php 
            if($value['orientation_b']=='Yes' or $value['orientation_b']=='yes' ){ 
                echo 'Purchased';
                
            }else{
                echo 'No';
            
            }
            ?>
            </td>
            
            <td>
                <?php if($value['mock_test']=='Yes' or $value['mock_test']=='yes'){ echo 'Purchased';
                }
                else{
                echo 'No';
                } ?>
            </td>
            <td>
                <?php echo 'Rs '.$value['amount'].'.00';?>
            </td>
            
      </tr>
      
    <?php $i++; 
    $amount=$amount+$value['amount'];
    } ?>
     
    
    </tbody>

  </table>



  <div class="invoice-total">

    <p><strong>Total Amount: Rs.<?php echo $amount;?>/-</strong></p>

  </div>

  <hr>

 
</div>
<div class='container d-flex my-2' >
    <!--<button class='btn btn-primary' name='download' id='download'>Downlaod</button>-->
     <button type="submit" id="cmd" class="btn btn-outline-primary "><i class="fa fa-download"></i> Download</button>
     <form method='POST' class='mx-2'>
         <button name='back' class="btn btn-outline-success ">👉 Back</button>
     </form>
</div>

</body>

</html>
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"
      integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

<script>
    document.getElementById("cmd").addEventListener("click", () => {
  const pdfgenWrapper = this.document.getElementById("content");

  // Increase the pixel size (height) of the content
  pdfgenWrapper.style.height = ''; // Set the desired fixed height in pixels

  let opt = {
    filename: 'invoice.pdf',
    jsPDF: {
      unit: 'in',
      format: 'letter',
      orientation: 'portrait',
      // Increase DPI for better quality
      precision: 900, // Set a higher DPI (e.g., 600) for better quality
      // Enable compression to reduce PDF size
      compress: true,
      // Add margins to reduce height from the bottom
      marginLeft: 2,
      marginRight: 2,
      marginTop: 2,
      marginBottom: 2,
    }
  };
  html2pdf().set(opt).from(pdfgenWrapper).save('invoice');
});
</script>