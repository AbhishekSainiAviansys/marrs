<?php //include('header.php'); ?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Marrs Payment</title>
  <!-- MDB icon -->
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
   <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="<?php echo base_url()?>custom.css" />
	<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      rel="stylesheet"
    />
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<style>
body {
    background-color: #ccebff;
    font-family: 'Roboto', sans-serif;
}
.container {
    margin-top: 20px;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
}
</style>
<?php //echo $this->notifications->display_html();?> 
		
			
			      	
				    <div class="container text-center mt-4">
    <h2><i class="fas fa-money-bill-alt"></i> Payments</h2>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
    					    <form method="POST">
    					    <div class='col-4 m-2'>
                                <label class='form-label'>Start Date</label>
                                <input type="date" name="start_date" class="form-control" value='<?php if(isset($result['start_date'])){ echo $result['start_date'];} ?>'  required>
                            </div>
                            <div class='col-4 m-2'>
                                <label class='form-label'>End Date</label>
                                <input type="date" name="end_date" class="form-control" value='<?php if(isset($result['end_date'])){ echo $result['end_date'];} ?>' required>
                            </div>
    					    <div class='col-4 m-2'>
                                <input type='submit' name='submit' value='Search' class='btn btn-primary mt-4'>
                            </div>
    					    </form>
    					
        </div>
    </div>
</div>

<div class="container mb-5 border bg-white">

						<?php if(empty($payments)){?>
					<div class="alert ">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No Payment(s) Received.
					</div>
					<?php
					}
					else{
					
					?>
					
					<table id="paymentTable" class="table table-bordered table-striped mt-5">
    <thead>
        <tr>
           <th colspan="12" class='text-success'><?php echo $message; ?></th> 
        </tr>
        <tr>
            <th>Sr. No</th>
            <th>Date</th>
            <th>CIN</th>
            <th>Total Pay Amount</th>
            <th>Franchise Amount</th>
            <th>GST Amount</th>
            <th>Razorpay Cut</th>
            <th>Management Cut</th>
            <th>MaRRs Left</th>
            <th>Aviansys Amount</th>
            <th>Franchise GST</th>
            <th>Aviansys GST</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_amount = 0;
        $franchise_amount = 0;
        $gst_amount = 0;
        $razpay_service = 0;
        $MaRRS_bal = 0;
        $aviansys_amount = 0;
        $manage_amount = 0;
        $franchise_gst=0;
        $aviansys_gst=0;
        $i = 1;
        foreach ($payments as $value) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $value['date_of_payment']; ?></td>
            <td><?php echo $value['cin']; ?></td>
            <td><?php echo $value['total_amount']; $total_amount += $value['total_amount']; ?></td>
            <td><?php echo $value['franchise_amount']; $franchise_amount += $value['franchise_amount']; ?></td>
            <td><?php echo $value['gst_amount']; $gst_amount += $value['gst_amount']; ?></td>
            <td><?php echo $value['razpay_service']; $razpay_service += $value['razpay_service']; ?></td>
            <td><?php echo $value['management_amount']; $manage_amount += $value['management_amount']; ?></td>
            <td><?php echo $value['MaRRS_bal']; $MaRRS_bal += $value['MaRRS_bal']; ?></td>
            <td><?php echo $value['aviansys_amount']; $aviansys_amount += $value['aviansys_amount']; ?></td>
            <td><?php echo $value['franchise_gst']; $franchise_gst += $value['franchise_gst']; ?></td>
            <td><?php echo $value['aviansys_gst']; $aviansys_gst += $value['aviansys_gst']; ?></td>
        </tr>
        <?php
            $i++;
        }
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total Amount: <?php echo $total_amount; ?></b></td>
            <td><b>Franchise Total Cut: <?php echo $franchise_amount; ?></b></td>
            <td><b>GST Total Cut: <?php echo $gst_amount; ?></b></td>
            <td><b>Razorpay Total Cut: <?php echo $razpay_service; ?></b></td>
            <td><b>Management Total Cut : <?php echo $manage_amount; ?></b></td>
            <td><b>MaRRS Balance: <?php echo $MaRRS_bal; ?></b></td>
            <td><b>Aviansys Total Cut: <?php echo $aviansys_amount; ?></b></td>
            <td><b>Franchise GST: <?php echo $franchise_gst; ?></b></td>
            <td><b>Aviansys GST: <?php echo $aviansys_gst; ?></b></td>
        </tr>
    </tbody>
</table>

					  
					  
					  
					  <?php } ?>
				
					
					
					</div>
				
			
			
		
<?php //include('footer.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
       $(document).ready(function() {
    $('#paymentTable').DataTable({
        "pageLength": 10
    });

    // Initialize date pickers
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
    </script>
<?php 
	$this->confirmation->confirm('delete');
?>