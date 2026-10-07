<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Successful</title>
<style>
    :root{
        --ink:#1b2430; --muted:#5b6675; --line:#e2e6ea;
        --accent:#2f6f4f; --accent-soft:#e7f2ec; --bg:#f7f8f9;
        --blue:#2f5fe0; --blue-soft:#eaf0ff;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:'Segoe UI',Roboto,Arial,sans-serif;background:var(--bg);color:var(--ink);}
    .wrap{max-width:520px;margin:0 auto;padding:60px 20px;}
    .card{background:#fff;border:1px solid var(--line);border-radius:12px;padding:32px 24px;text-align:center;}
    .check{
        width:56px;height:56px;border-radius:50%;background:var(--accent-soft);color:var(--accent);
        display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto 16px;
    }
    h1{font-size:22px;margin:0 0 6px;}
    p.muted{color:var(--muted);font-size:14px;}
    p.lead{font-size:15px;margin:4px 0;}

    /* CIN / login credentials box */
    .cin-box{
        margin-top:22px;background:var(--blue-soft);border:1px solid #cfdcfb;border-radius:10px;
        padding:18px 16px;text-align:center;
    }
    .cin-box .label{font-size:12px;font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;}
    .cin-box .cin-value{font-size:26px;font-weight:800;letter-spacing:2px;color:var(--ink);}
    .cin-box .hint{font-size:12.5px;color:var(--muted);margin-top:8px;}

    .items{text-align:left;margin-top:24px;border-top:1px dashed var(--line);padding-top:16px;}
    .item-row{display:flex;justify-content:space-between;font-size:14px;margin-bottom:8px;}
    .item-row .name{font-weight:600;}
    .total-row{display:flex;justify-content:space-between;font-size:16px;font-weight:700;margin-top:12px;padding-top:12px;border-top:1px solid var(--line);}
    .total-row .amount{color:var(--accent);}

    .first-login-section{margin-top:28px;padding-top:20px;border-top:1px solid var(--line);}
    .first-login-section .step-label{font-size:12px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.6px;margin-bottom:10px;}

    .login-btn{
        display:inline-block;margin-top:6px;background:var(--accent);color:#fff;text-decoration:none;
        padding:13px 28px;border-radius:8px;font-size:15px;font-weight:700;
    }
    .login-btn:hover{background:#255d40;}

    .note{font-size:12px;color:var(--muted);margin-top:14px;line-height:1.6;}
</style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <div class="check">✓</div>
        <h1>Registration Successful!</h1>

        <?php
            $programName = $order_items[0]['plan_name'] ?? ($program_name ?? 'your program');
        ?>
        <p class="lead">Thank you for registering for <strong><?php echo htmlspecialchars($programName); ?></strong>.</p>

        <?php if (!empty($purchase_cin)): ?>
        <div class="cin-box">
            <div class="label">Your Candidate Identification Number (CIN)</div>
            <div class="cin-value"><?php echo htmlspecialchars($purchase_cin); ?></div>
            <div class="hint">You may access your profile using your CIN as both your <strong>Username</strong> and <strong>Password</strong>.</div>
        </div>
        <?php endif; ?>

        <p class="muted" style="margin-top:16px;">Payment ID: <?php echo htmlspecialchars($order['razorpay_payment_id']); ?></p>

        <div class="items">
            <?php foreach ($order_items as $item): ?>
                <div class="item-row">
                    <span class="name"><?php echo htmlspecialchars($item['plan_name']); ?></span>
                    <span>₹<?php echo number_format($item['price'], 2); ?></span>
                </div>
            <?php endforeach; ?>
            <div class="total-row">
                <span>Total Paid</span>
                <span class="amount">₹<?php echo number_format($order['amount'], 2); ?></span>
            </div>
        </div>

        <div class="first-login-section">
            <div class="step-label">First-Time Login</div>
            <a href="<?php echo base_url('welcome/first_login/' . urlencode($purchase_cin)); ?>" class="login-btn">
                Click Here to Log In for the First Time
            </a>
            <p class="note">
                You've already verified your identity using your email and OTP, so you won't need to log in again —
                this will take you straight to your profile.
            </p>
        </div>
    </div>
</div>
</body>
</html>