<?php include('header1.php');

$payid=$session['razorpay_order_id'];
$tid=$session['razorpay_order_id'];
?>

<style>
body {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.receipt-wrapper {
    padding: 40px 15px;
    min-height: calc(100vh - 100px);
}

.receipt-container {
    max-width: 800px;
    margin: 0 auto;
}

.receipt-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    overflow: hidden;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.receipt-header {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    padding: 50px 30px;
    text-align: center;
    position: relative;
}

.receipt-header::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 20px;
    background: white;
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
}

.success-icon {
    width: 90px;
    height: 90px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    animation: scaleIn 0.5s ease-out 0.3s both;
    font-size: 45px;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

.receipt-title {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
}

.receipt-subtitle {
    font-size: 16px;
    opacity: 0.9;
    margin-top: 10px;
}

.receipt-body {
    padding: 50px 30px;
}

.amount-section {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    padding: 35px;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 40px;
    box-shadow: 0 10px 30px rgba(17, 153, 142, 0.3);
}

.amount-label {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.amount-value {
    font-size: 52px;
    font-weight: 700;
    margin: 10px 0;
}

.status-badge {
    display: inline-block;
    padding: 10px 25px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    font-weight: 600;
    font-size: 14px;
    margin-top: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.info-item {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    border-left: 4px solid #11998e;
    transition: all 0.3s ease;
}

.info-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.info-label {
    font-size: 12px;
    text-transform: uppercase;
    color: #6c757d;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-value {
    font-size: 16px;
    color: #212529;
    font-weight: 600;
    word-break: break-word;
}

.receipt-footer {
    text-align: center;
    padding: 40px 30px;
    background: #f8f9fa;
}

.btn-profile {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    border: none;
    color: white;
    padding: 16px 45px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 16px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(17, 153, 142, 0.3);
}

.btn-profile:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(17, 153, 142, 0.5);
    color: white;
    text-decoration: none;
}

.icon-circle {
    width: 24px;
    height: 24px;
    background: rgba(17, 153, 142, 0.1);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: #11998e;
}

@media (max-width: 768px) {
    .receipt-wrapper {
        padding: 20px 10px;
    }
    
    .receipt-header {
        padding: 40px 20px;
    }
    
    .receipt-title {
        font-size: 24px;
    }
    
    .amount-value {
        font-size: 42px;
    }
    
    .receipt-body {
        padding: 30px 20px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .receipt-footer {
        padding: 30px 20px;
    }
}

@media print {
    body {
        background: white;
    }
    
    .receipt-wrapper {
        padding: 0;
    }
    
    .btn-profile {
        display: none;
    }
}
</style>

<div class="receipt-wrapper">
    <div class="receipt-container">
        <div class="receipt-card">
            <!-- Header -->
            <div class="receipt-header">
                <div class="success-icon">
                    ✓
                </div>
                <h1 class="receipt-title">Payment Successful!</h1>
                <p class="receipt-subtitle">Thank you for your purchase</p>
            </div>
            
            <!-- Body -->
            <div class="receipt-body">
                <!-- Amount Section -->
                
                <?php //print_r($cins[0]); ?>
                
                <div class="amount-section">
                    <div class="amount-label">Total Amount Paid</div>
                    <div class="amount-value">₹<?php echo number_format($cins[0]->amount, 2); ?></div>
                    <div class="status-badge">
                        ✓ <?php echo $cins->status; ?>
                    </div>
                </div>
                
                <!-- Information Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">👤</span>
                            Student Name
                        </div>
                        <div class="info-value"><?php echo $cins[0]->student_name; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">🎓</span>
                            Class
                        </div>
                        <div class="info-value"><?php echo $cins[0]->class; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">📦</span>
                            Item
                        </div>
                        <div class="info-value"><?php echo 'Product'; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">#</span>
                            Purchase ID
                        </div>
                        <div class="info-value"><?php echo $cins[0]->prid; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">🧾</span>
                            Payment ID
                        </div>
                        <div class="info-value"><?php echo $cins[0]->payment_id; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">💳</span>
                            Order ID
                        </div>
                        <div class="info-value"><?php echo $cins[0]->order_id; ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">📅</span>
                            Date
                        </div>
                        <div class="info-value"><?php echo date('d M Y', strtotime($cins->date)); ?></div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <span class="icon-circle">🕐</span>
                            Time
                        </div>
                        <div class="info-value"><?php echo $cins[0]->time; ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="receipt-footer">
                <a href="<?php echo base_url();?>welcome/registration_log" class="btn-profile">
                    <span>👤</span>
                    Back to Profile
                </a>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");?>