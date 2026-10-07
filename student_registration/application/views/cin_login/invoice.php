<!DOCTYPE html>
<html>
<head>
  <title>Invoice</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f7fb;
      padding: 30px;
      color: #333;
    }

    .invoice-box {
      max-width: 900px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #f0f0f0;
      padding-bottom: 15px;
    }

    .logo img {
      height: 55px;
      margin-right: 10px;
    }

    .invoice-title {
      text-align: right;
    }

    .invoice-title h1 {
      margin: 0;
      font-size: 28px;
      color: #F57C35;
    }

    .invoice-title p {
      margin: 2px 0;
      font-size: 13px;
    }

    .info {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
    }

    .info-box {
      width: 48%;
      background: #fafafa;
      padding: 15px;
      border-radius: 10px;
    }

    .info-box h3 {
      margin-top: 0;
      font-size: 16px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      overflow: hidden;
      border-radius: 10px;
    }

    table th {
      background: #F57C35;
      color: #fff;
      padding: 12px;
      font-size: 14px;
    }

    table td {
      padding: 12px;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }

    table tr:hover {
      background: #f9f9f9;
    }

    .total {
      text-align: right;
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
    }

    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      margin-right: 5px;
      background: #eee;
    }

    .badge.orange {
      background: #F57C35;
      color: #fff;
    }
  </style>
</head>

<body>

<div class="invoice-box">

  <!-- HEADER -->
  <div class="header">

    <div class="logo">
      <img src="https://marrs.in/newassets/MaRRS.png" alt="logo">
    </div>

    <div class="invoice-title">
      <h1>INVOICE</h1>
      <p>Invoice No: 12345</p>
      <p>Date: 2023-07-19</p>
    </div>

  </div>

  <!-- CUSTOMER INFO -->
<div class="info">

  <div class="info-box">
    <h3>Customer Details</h3>
    <!-- NEW -->
    <p><strong>CIN:</strong> <?php echo $data->cin; ?></p>
    <p><strong>Competition Level:</strong> -</p>
    <p><strong>Name:</strong> <?php echo $data->student_name; ?></p>
    <p><strong>Email:</strong> <?php echo $data->stud_email; ?></p>

    <!-- NEW -->
    <p><strong>Class/Category:</strong> <?php echo $data->class; ?></p>
    <p><strong>Mobile:</strong> <?php echo $data->stud_phone; ?></p>
    <p><strong>Alternate Email:</strong> <?php echo $data->stud_email; ?></p>
  </div>

  <div class="info-box">
    <h3>Address</h3>
    <p><?php echo $data->address1 . ' ' . $data->address2; ?></p>

    
  </div>

</div>

  <!-- TABLE -->
  <table>
    <thead>
      <tr>
        <th>Sr No</th>
        <th>Product</th>
        <th>Type</th>
        <th>Amount</th>
      </tr>
    </thead>

    <tbody>
      <?php $i = 1; foreach($payment as $value){ ?>
      <tr>
        <td><?php echo $i; ?></td>

        <td><?php echo $value->product_name; ?></td>

        <td>
          <?php if($value->competition == 'Yes') { ?>
            <span class="badge orange">Competition</span>
          <?php } ?>
          <?php if($value->study_material == 'Yes') { ?>
            <span class="badge orange">Study Material</span>
          <?php } ?>

          <?php if($value->orientation == 'Yes') { ?>
            <span class="badge">Orientation</span>
          <?php } ?>

          <?php if($value->mock_test == 'Yes') { ?>
            <span class="badge">Mock Test</span>
          <?php } ?>
        </td>

        <td>₹ <?php echo $value->amount; ?></td>
      </tr>
      <?php $i++; } ?>
    </tbody>
  </table>

<?php
  $totalAmount = 0;
  foreach($payment as $value){
      $totalAmount += $value->amount;
  }

  // ✅ Correct GST Inclusive Calculation
  $baseAmount = round($totalAmount / 1.18, 2);
  $igst = round($totalAmount - $baseAmount, 2);
?>
<!-- TAX SUMMARY (Clean Invoice Style) -->
<div style="margin-top:20px; padding:15px; background:#fafafa; border-radius:10px; font-size:14px;">

  <div style="font-weight:bold; color:#F57C35; margin-bottom:10px;">
    Amount Summary
  </div>

  <div style="display:flex; justify-content:space-between; padding:5px 0;">
    <span>Total Base Amount (Excl. IGST)</span>
    <span>Rs. <?php echo number_format($baseAmount,2); ?>/-</span>
  </div>

  <div style="padding:6px 0; font-weight:bold;">
    Add: Statutory Levies
  </div>

  <div style="display:flex; justify-content:space-between; padding:5px 0;">
    <span>IGST (18%)</span>
    <span>Rs. <?php echo number_format($igst,2); ?>/-</span>
  </div>

  <div style="border-top:1px solid #ccc; margin:10px 0;"></div>

  <div style="display:flex; justify-content:space-between; font-weight:bold; font-size:16px;">
    <span>Total Amount</span>
    <span style="color:#F57C35;">Rs. <?php echo number_format($totalAmount,2); ?>/-</span>
  </div>

</div>


</div>

</body>
</html>