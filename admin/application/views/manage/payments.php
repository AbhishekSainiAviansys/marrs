<?php include('header.php'); ?>

<?php echo $this->notifications->display_html();?> 
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Payments</a> <span class="divider">/</span>
					</li>
					<li>
							<a href="<?php echo SITE_URL?>content/">List</a>
					</li>
				</ul>
			</div>
			
			<div >		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Payments</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					
					
					<div class="box-content">
					
						<?php if(empty($payments)){?>
					<div class="alert">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Information!</strong> No Payment(s) Received.
					</div>
					<?php
					}
					else{
					
					?>
					<form method="POST">
                           
                            <button type="submit" name="Export" class="btn btn-primary">Export CSV</button>
                        </form>
					<table id="paymentTable" class="table table-bordered">
					   
					    


                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Date</th>
                                <th>Payment ID</th>
                                <th>CIN</th>
                                <th>Total Pay Amount</th>
                                <th>Franchise Amount</th>
                                <th>Franchise GST</th>
                                <th>CRM Fix Amount</th>
                                <th>GST Amount</th>
                                <th>Management Amount</th>
                                <th>Razorpay Cut</th>
                                <th>MaRRs Left</th>
                                <th>Aviansys Amount</th>
                                <th>Aviansys GST</th>
                                <th>Makers Split</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            
                            $total_amount = 0;
                            $franchise_amount = 0;
                            $franchise_gst = 0;
                            $gst_amount = 0;
                            $razpay_service = 0;
                            $MaRRS_bal = 0;
                            $aviansys_amount = 0;
                            $aviansys_gst = 0;
                            $management_amount=0;
                            $crm_fix=0;
                            $maker_price=0;
                            
                            $i = 1;
                            foreach ($payments as $value) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['date_of_payment']; ?></td>
                                <td>
                                    <?php $payment_id = $value['payment_id']; ?>  
                                    <span data-copy="<?php echo $payment_id; ?>"><?php echo $payment_id; ?></span>
                                    <button class="btn btn-sm btn-outline-primary ms-2" onclick="copyToClipboard(this)" data-copy="<?php echo $payment_id; ?>">Copy</button>
                                </td>
                                <td><?php echo $value['cin']; ?></td>
                                <td><?php echo $value['total_amount']; $total_amount += $value['total_amount']; ?></td>
                                <td><?php echo $value['franchise_amount']; $franchise_amount += $value['franchise_amount']; ?></td>
                                <td><?php echo $value['franchise_gst']; $franchise_gst += $value['franchise_gst']; ?></td>
                                <td><?php echo $value['crm_fix']; $crm_fix += $value['crm_fix']; ?></td>
                                <td><?php echo $value['gst_amount']; $gst_amount += $value['gst_amount']; ?></td>
                                <td><?php echo $value['management_amount']; $management_amount += $value['management_amount']; ?></td>
                                <td><?php echo $value['razpay_service']; $razpay_service += $value['razpay_service']; ?></td>
                                <td><?php echo $value['MaRRS_bal']; $MaRRS_bal += $value['MaRRS_bal']; ?></td>
                                <td><?php echo $value['aviansys_amount']; $aviansys_amount += $value['aviansys_amount']; ?></td>
                                <td><?php echo $value['aviansys_gst']; $aviansys_gst += $value['aviansys_gst']; ?></td>
                                
                                <td>
                                    <?php
                                        $this->db->select('*');
                                        $this->db->from('makers_splits');
                                        $this->db->where('comp_id', $value['comp_id']);
                                        $this->db->where('order_id',$value['payment_id']);
                                        $query = $this->db->get();
                                        if(!empty($query->result())){
                                            foreach($query->result() as $row){
                                                echo 'Price: '.$row->price.'Rs. <br>';
                                                
                                                $maker_price += $row->price;
                                                
                                                $this->db->select('name');
                                                $this->db->from('material_maker');
                                                $this->db->where('material_maker_id', $row->maker_id);
                                                $query = $this->db->get();
                                                
                                                echo 'Maker: '.$query->row()->name;
                                            } 
                                        }else{
                                            echo 'No maker split in this transaction.';
                                        }
                                        
                                    ?>
                                </td>
                                
                            </tr>
                            <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total Amount: <?php echo $total_amount; ?></b></td>
                                <td><b>Franchise Total Cut: <?php echo $franchise_amount; ?></b></td>
                                <td><b>Franchise GST: <?php echo $franchise_gst; ?></b></td>
                                <td><b>CRM Total Cut: <?php echo $crm_fix; ?></b></td>
                                <td><b>GST Total Cut: <?php echo $gst_amount; ?></b></td>
                                <td><b>Management Total Cut:<?php echo $management_amount; ?></b></td>
                                <td><b>Razorpay Total Cut: <?php echo $razpay_service; ?></b></td>
                                <td><b>MaRRS Balance: <?php echo $MaRRS_bal; ?></b></td>
                                <td><b>Aviansys Total Cut: <?php echo $aviansys_amount; ?></b></td>
                                <td><b>Aviansys GST: <?php echo $aviansys_gst; ?></b></td>
                                <td><b>Makers Total Cut: <?php echo $maker_price; ?></b></td>
                            </tr>
                        </tbody>
                        
                    </table>

					  
					  
					  
				  <?php } ?>
			
				
				
				</div>
			</div><!--/span-->
		
		</div><!--/row-->
			
			
		
<?php include('footer.php'); ?>


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
        });
    </script>
    
    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">-->
    <script>
        function copyToClipboard(element) {
            // Create a temporary input element
            let tempInput = document.createElement("input");
            tempInput.value = element.getAttribute("data-copy");
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Change button text to indicate copying
            element.innerText = "Copied!";
            setTimeout(() => { element.innerText = "Copy"; }, 1500);
        }
    </script>
    
<?php 
	$this->confirmation->confirm('delete');
?>