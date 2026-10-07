<!DOCTYPE html>

<html>

<head>

  <title>Invoice Template</title>

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

    <div class="bett">

        <div>

            <img style="height:50px;margin:25px" src="<?php echo base_url();?>images/marrs_logo.png" alt="">


        </div>

        

        <div class="invoice-header">

            <h1>Invoice</h1>

            <p>Invoice Number: 12345</p>

            <p>Date: 2023-07-19</p>

        </div>

    </div>

<hr>

  <div class="billing-info">

    <h2>Customer Information</h2>

    <p>Customer Name: <?php echo $data->student_name;?></p>

    <p>Address: <?php echo $data->address1.$data->address2;?></p>

    <p>Email: <?php echo $data->stud_email;?></p>

  </div>



  <table class="invoice-table">

    <thead>

      <tr>

        
         <th>Sr.No</th>
        <th>Product Purchase</th>

        <th>Quantity</th>

        <th>Unit Price</th>

        <th>Total</th>

      </tr>

    </thead>

    <tbody>
   <?php $i=1; foreach($payment as $value){ ?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value->product_name;?></td>
        <?php if($value->study_material='Yes') { ?><td> <?php echo 'Study Material'; ?></td><?php } ?>
        <td><?php if($value->orientation='Yes'){ echo 'Orientation';} ?></td>
        <td><?php if($value->study_material='Yes'){ echo 'Mock Test';} ?></td>
        <td><?php echo $value->amount;?></td>
        
      </tr>
    <?php $i++; } ?>
     

    </tbody>

  </table>



  <div class="invoice-total">

    <p><strong>Total Amount: <?php echo $payment[0]->amount;?></strong></p>

  </div>

  <hr>

 



</body>

</html>
