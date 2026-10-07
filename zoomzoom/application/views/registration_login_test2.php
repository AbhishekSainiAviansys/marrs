<?php include('header1.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaRRS Math Zoom Zoom Challenge</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/font-awesome.min.css">
    
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            /*padding: 20px 0;*/
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .profile-details table {
            width: 100%;
            margin: 0;
        }

        .profile-details th {
            background-color: #f8f9fa;
            padding: 12px;
            font-weight: 600;
            color: #495057;
            width: 40%;
        }

        .profile-details td {
            padding: 12px;
            color: #6c757d;
        }

        .profile-details tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Registration Card */
        .registration-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .registration-header {
            background: linear-gradient(135deg, var(--success-color) 0%, #1e7e34 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .registration-body {
            padding: 25px;
        }

        .item-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .item-table thead {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .item-table th {
            padding: 15px;
            font-weight: 600;
            color: #495057;
            border: none;
        }

        .item-table td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .item-table tr:last-child td {
            border-bottom: none;
        }

        /* Buttons */
        .btn-custom {
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
        }

        .btn-add-cart:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,123,255,0.4);
        }

        .btn-copy-cin {
            background: linear-gradient(135deg, var(--success-color) 0%, #1e7e34 100%);
            color: white;
        }

        .btn-copy-cin:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(40,167,69,0.4);
        }

        /* Floating Cart Button */
        .floating-cart {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--danger-color) 0%, #bd2130 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(220,53,69,0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .floating-cart:hover {
            transform: scale(1.1);
            box-shadow: 0 15px 40px rgba(220,53,69,0.6);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: white;
            color: var(--danger-color);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid var(--danger-color);
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 10px 30px rgba(220,53,69,0.4);
            }
            50% {
                box-shadow: 0 15px 40px rgba(220,53,69,0.7);
            }
        }

        /* Modal Styles */
        .modal-custom {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
        }

        .modal-content-custom {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border-radius: 20px;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0056b3 100%);
            color: white;
            padding: 25px;
            border-radius: 20px 20px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-btn {
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
            line-height: 1;
        }

        .close-btn:hover {
            transform: rotate(90deg);
        }

        .modal-body-custom {
            padding: 30px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-footer-custom {
            background: #f8f9fa;
            padding: 20px 30px;
            border-radius: 0 0 20px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        /* Toaster */
        .toaster {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--success-color) 0%, #1e7e34 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            z-index: 3000;
            display: none;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Logo Section */
        .logo-section {
            text-align: center;
            /*padding: 20px;*/
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            margin-top: 20px;
        }

        .logo-section img {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-card {
                margin-bottom: 20px;
            }

            .floating-cart {
                width: 60px;
                height: 60px;
                bottom: 20px;
                right: 20px;
                font-size: 20px;
            }

            .cart-badge {
                width: 25px;
                height: 25px;
                font-size: 12px;
            }

            .modal-content-custom {
                width: 95%;
                margin: 10% auto;
            }

            .profile-details th,
            .profile-details td {
                padding: 8px;
                font-size: 14px;
            }

            .item-table th,
            .item-table td {
                padding: 10px;
                font-size: 14px;
            }

            .registration-header {
                flex-direction: column;
                text-align: center;
            }

            .btn-custom {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .modal-content-custom {
                width: 98%;
            }

            .profile-pic {
                width: 80px;
                height: 80px;
            }

            .profile-header {
                padding: 20px 15px;
            }

            .registration-body {
                padding: 15px;
            }
        }

        /* Custom Scrollbar */
        .modal-body-custom::-webkit-scrollbar {
            width: 8px;
        }

        .modal-body-custom::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .modal-body-custom::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .modal-body-custom::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        /* Link Styles */
        .view-details-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .view-details-link:hover {
            color: #0056b3;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Profile Section -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="Student Photo" class="profile-pic">
                    <h5 class="mb-0">Student Profile</h5>
                </div>
                <div class="profile-details">
                    <table>
                        <tbody>
                            <tr>
                                <th><i class="fa fa-user me-2"></i>Student Name</th>
                                <td><?php echo $student->name; ?></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-graduation-cap me-2"></i>Class</th>
                                <td><?php echo $student->class; ?></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-envelope me-2"></i>Email</th>
                                <td><?php echo $student->email; ?></td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-id-card me-2"></i>Registration Code</th>
                                <td>
                                    <?php
                                    $school = $this->db->get_where('zoomzoom_schedule_cin', array('zoomzoom_schedule_id'=>$student->sch_id))->row();
                                    echo $school->registration_code;
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Registration Items Section -->
        <div class="col-lg-8 col-md-12">
            <div class="registration-card">
                <?php 
                $current_date = date('Y-m-d');
                $start_date = $school->start_date;
                $end_date = $school->end_date;
                
                if ($current_date < $start_date) {
                    echo "<div class='alert alert-custom alert-info'><i class='fa fa-info-circle me-2'></i>Exam opens soon. Exam Date: " . $start_date . "</div>";
                } elseif ($current_date > $end_date) {
                    echo "<div class='alert alert-custom alert-warning'><i class='fa fa-exclamation-triangle me-2'></i>Exam over. Exam ended: " . $end_date . "</div>";
                } else {
                ?>
                    <div class="registration-header">
                        <div>
                            <h4 class="mb-0"><i class="fa fa-list-alt me-2"></i>Registration Items</h4>
                        </div>
                        <div>
                            <?php 
                            $price = $this->db->get_where('cin_list', array(
                                'stud_email'=>$student->email,
                                'sch_id'=>$schedule->zoomzoom_schedule_id,
                                'prid'=>$this->session->userdata('prid')
                            ))->row();
                            ?>
                        </div>
                    </div>
                    
                    <div class="registration-body">
                        <div class="table-responsive">
                            <table class="item-table">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-box me-2"></i>Item</th>
                                        <th><i class="fa fa-rupee me-2"></i>Price</th>
                                        <th class="text-center"><i class="fa fa-shopping-cart me-2"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($product_sho == 'yes'): ?>
                                    <tr>
                                        <td>
                                            <strong>MaRRS Math Zoom Zoom Challenge</strong><br>
                                            <a href="https://marrs.in/zoomzoom.php" target="_blank" class="view-details-link">
                                                View Details <i class="fa fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <strong class="text-success">
                                                <?php 
                                                if($product_pur == 'yes') {
                                                    echo '<span class="badge bg-success">Paid</span>';
                                                } else {
                                                    echo 'Rs. ' . $schedule->amount;
                                                }
                                                ?>
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            <?php if($product_pur == 'yes'): ?>
                                                <div class="mb-2">
                                                    <small class="text-muted">Click CIN to copy and download material</small>
                                                </div>
                                                <button onclick="copyToClipboard('<?php echo $price->cin; ?>')" class="btn btn-copy-cin btn-custom">
                                                    <i class="fa fa-copy me-2"></i><?php echo $price->cin; ?>
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-add-cart btn-custom product-button" value='<?php echo $schedule->amount.'+'.'product'.'+'.$student->name.'+'.$student->class.'+'.$schedule->zoomzoom_schedule_id; ?>'>
                                                    <i class="fa fa-cart-plus me-2"></i>Add to Cart
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    
                                    <?php if($schedule->syllabus): ?>
                                    <tr>
                                        <td colspan='3' class="text-center">
                                            <a href="https://marrs.in/zoomzoom/product_logo/<?php echo $schedule->syllabus; ?>" target="_blank" class="view-details-link">
                                                <i class="fa fa-file-pdf me-2"></i>View Syllabus <i class="fa fa-external-link-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="logo-section">
                            <img src='https://marrs.in/student_registration/certificate_logo/zoom.png' alt="MaRRS Logo">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Floating Cart Button -->
<div class="floating-cart" onclick="openCartModal()">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-badge" id="cart-count">0</span>
</div>

<!-- Cart Modal -->
<div id="cartModal" class="modal-custom">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h4 class="mb-0"><i class="fa fa-shopping-cart me-2"></i>Your Cart</h4>
            <span class="close-btn" onclick="closeCartModal()">&times;</span>
        </div>
        <div class="modal-body-custom" id="cart-products">
            <!-- Cart items will be loaded here -->
        </div>
        <div class="modal-footer-custom">
            <div>
                <strong style="font-size: 1.2rem;">Total Amount: <span class="text-success">Rs. <span id="total-amount">0</span></span></strong>
            </div>
            <button type="button" id="checkout-button" class="btn btn-success btn-custom" style="display: none;">
                <i class="fa fa-credit-card me-2"></i>Pay Now
            </button>
        </div>
    </div>
</div>

<!-- Child Products Modal -->
<div id="childModal" class="modal-custom">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h4 class="mb-0"><i class="fa fa-users me-2"></i>Add Products for Siblings</h4>
            <span class="close-btn" onclick="closeChildModal()">&times;</span>
        </div>
        <div class="modal-body-custom">
            <form method="POST" id="childForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="child_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="child_name" placeholder="Enter Name" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="class" class="form-label">Class <span class="text-danger">*</span></label>
                        <select class="form-select" id="class" name="class" required>
                            <option value="">-- Select Class --</option>
                            <option value="LKG">LKG</option>
                            <option value="UKG">UKG</option>
                            <option value="Class-1">Class-1</option>
                            <option value="Class-2">Class-2</option>
                            <option value="Class-3">Class-3</option>
                            <option value="Class-4">Class-4</option>
                            <option value="Class-5">Class-5</option>
                            <option value="Class-6">Class-6</option>
                            <option value="Class-7">Class-7</option>
                            <option value="Class-8">Class-8</option>
                            <option value="Class-9">Class-9</option>
                            <option value="Class-10">Class-10</option>
                        </select>
                    </div>
                </div>
                <div id="child-products"></div>
            </form>
        </div>
        <div class="modal-footer-custom">
            <button class="btn btn-danger btn-custom" onclick="closeChildModal()">
                <i class="fa fa-times me-2"></i>Exit to Checkout
            </button>
        </div>
    </div>
</div>

<!-- Hidden Payment Form -->
<form id="payment-form" method="POST" action="<?php echo base_url('Razorpay/pay3'); ?>" style="display: none;">
    <input type="hidden" name="prid" value="<?php echo $student->prid; ?>">
    <input type="hidden" name="contact" value="<?php echo $student->mobile; ?>">
    <input type="hidden" name="email" value="<?php echo $student->email; ?>">
    <input type="hidden" name="sch_id" value="<?php echo $schedule->zoomzoom_schedule_id; ?>">
</form>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Add to cart functionality
    $(document).on('click', '.product-button', function(e) {
        e.preventDefault();
        var value = $(this).val();
        $.ajax({
            url: '<?php echo base_url('/welcome/add_rem'); ?>',
            type: 'POST',
            data: { value: value },
            success: function(response) {
                $('#cart-count').text(response.trim());
                showToaster("Product added successfully! Click 'Buy Now' to checkout.");
            },
            error: function() {
                showToaster("Error adding product to cart.", "error");
            }
        });
    });

    // Remove from cart
    $(document).on('click', '.product-button-remove', function(e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        $.ajax({
            url: '<?php echo base_url('/welcome/add_rem_pro'); ?>',
            type: 'POST',
            data: { value: itemId },
            success: function(response) {
                $('#cart-count').text(response.trim());
                showToaster("Product removed successfully.");
                refreshCart();
            },
            error: function() {
                showToaster("Error removing product.", "error");
            }
        });
    });

    // Child product add to cart
    $(document).on('click', '.product-button-child', function(e) {
        e.preventDefault();
        var amount = $(this).data('amount');
        var productName = $(this).data('product-name');
        var childName = $('#child_name').val();
        var childClass = $('#class').val();
        
        if(!childName || !childClass) {
            showToaster("Please enter name and select class.", "error");
            return;
        }
        
        var value = `${amount}+${productName}+${childName}+${childClass}`;
        $.ajax({
            url: '<?php echo base_url('/welcome/add_rem'); ?>',
            type: 'POST',
            data: { value: value },
            success: function(response) {
                $('#cart-count').text(response.trim());
                showToaster("Product added successfully!");
            },
            error: function() {
                showToaster("Error adding product.", "error");
            }
        });
    });

    // Class change for child products
    $("#class").change(function() {
        var class_name = this.value;
        $.ajax({
            url: "<?php echo base_url('/welcome/class_product'); ?>",
            data: { class_name: class_name },
            type: 'post',
            success: function(response) {
                var cartData = JSON.parse(response);
                displayChildProducts(cartData);
            }
        });
    });

    // Checkout button
    $('#checkout-button').on('click', function() {
        $('#payment-form').submit();
    });
    
    function displayChildProducts(cartData) {
        var container = $('#child-products');
        container.html('');
        
        if (cartData.length === 0) {
            container.html('<div class="empty-state"><i class="fa fa-inbox"></i><p>No products assigned to this class.</p></div>');
        } else {
            var html = '<div class="table-responsive"><table class="item-table"><thead><tr><th>Product</th><th>Amount</th><th>Action</th></tr></thead><tbody>';
            
            cartData.forEach(function(product) {
                html += `
                    <tr>
                        <td>${product.product_name}</td>
                        <td>Rs. ${product.amount}</td>
                        <td>
                            <button class="btn btn-add-cart btn-custom product-button-child" 
                                    data-amount="${product.amount}" 
                                    data-product-name="${product.product_name}">
                                <i class="fa fa-cart-plus me-2"></i>Add to Cart
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table></div>';
            container.html(html);
        }
    }
});

function openCartModal() {
    $.ajax({
        url: '<?php echo base_url('/welcome/get_cart'); ?>',
        type: 'GET',
        success: function(response) {
            var cartData = JSON.parse(response);
            displayCartData(cartData);
            document.getElementById('cartModal').style.display = 'block';
        }
    });
}

function closeCartModal() {
    document.getElementById('cartModal').style.display = 'none';
}

function closeChildModal() {
    document.getElementById('childModal').style.display = 'none';
}

function displayCartData(cartData) {
    var container = $('#cart-products');
    var totalAmount = 0;
    container.html('');
    
    if (cartData.length === 0) {
        container.html('<div class="empty-state"><i class="fa fa-shopping-cart"></i><h5>Your cart is empty</h5><p>Add some items to get started!</p></div>');
        $('#checkout-button').hide();
    } else {
        var html = '<div class="table-responsive"><table class="item-table"><thead><tr><th>Name</th><th>Item</th><th>Price</th><th>Action</th></tr></thead><tbody>';
        
        cartData.forEach(function(product) {
            html += `
                <tr>
                    <td>${product.student_name}</td>
                    <td>${product.item}</td>
                    <td>Rs. ${product.amount}</td>
                    <td>
                        <button class="btn btn-danger btn-sm product-button-remove" data-item-id="${product.zoomzoom_purchase_id}">
                            <i class="fa fa-trash me-1"></i>Remove
                        </button>
                    </td>
                </tr>
            `;
            totalAmount += parseFloat(product.amount);
        });
        
        html += '</tbody></table></div>';
        container.html(html);
        $('#total-amount').text(totalAmount.toFixed(2));
        $('#checkout-button').show();
    }
}

function refreshCart() {
    $.ajax({
        url: '<?php echo base_url('/welcome/get_cart'); ?>',
        type: 'GET',
        success: function(response) {
            var cartData = JSON.parse(response);
            displayCartData(cartData);
            if (cartData.length === 0) {
                closeCartModal();
            }
        }
    });
}

function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(function() {
            showToaster("CIN copied successfully! Redirecting to download page...");
            setTimeout(function() {
                window.location.href = "https://marrs.in/";
            }, 2000);
        }, function(err) {
            // Fallback for older browsers
            fallbackCopyTextToClipboard(text);
        });
    } else {
        fallbackCopyTextToClipboard(text);
    }
}

function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.width = "2em";
    textArea.style.height = "2em";
    textArea.style.padding = "0";
    textArea.style.border = "none";
    textArea.style.outline = "none";
    textArea.style.boxShadow = "none";
    textArea.style.background = "transparent";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        var successful = document.execCommand('copy');
        if (successful) {
            showToaster("CIN copied successfully! Redirecting to download page...");
            setTimeout(function() {
                window.location.href = "https://marrs.in/";
            }, 2000);
        } else {
            showToaster("Failed to copy CIN. Please copy manually.", "error");
        }
    } catch (err) {
        showToaster("Failed to copy CIN. Please copy manually.", "error");
    }
    
    document.body.removeChild(textArea);
}

function showToaster(message, type = "success") {
    var toaster = $('<div class="toaster"></div>');
    toaster.html('<i class="fa fa-' + (type === "success" ? 'check-circle' : 'exclamation-circle') + ' me-2"></i>' + message);
    
    if (type === "error") {
        toaster.css('background', 'linear-gradient(135deg, #dc3545 0%, #bd2130 100%)');
    }
    
    $('body').append(toaster);
    toaster.fadeIn(300).delay(3000).fadeOut(300, function() {
        $(this).remove();
    });
}

// Close modals when clicking outside
window.onclick = function(event) {
    var cartModal = document.getElementById('cartModal');
    var childModal = document.getElementById('childModal');
    
    if (event.target == cartModal) {
        closeCartModal();
    }
    if (event.target == childModal) {
        closeChildModal();
    }
}

// Load cart count on page load
$(document).ready(function() {
    $.ajax({
        url: '<?php echo base_url('/welcome/get_cart'); ?>',
        type: 'GET',
        success: function(response) {
            var cartData = JSON.parse(response);
            $('#cart-count').text(cartData.length);
        }
    });
});
</script>

</body>
</html>

<?php include('footer.php'); ?>