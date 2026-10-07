<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('checkout_nav');

$subtotal = 0;
foreach ($order_items as $it) { $subtotal += $it['price'] * $it['quantity']; }
// $order['amount'] already includes GST (added in the model's
// create_order()), so the tax shown here is derived, not re-calculated,
// to guarantee it always matches what's actually charged.
$gst_amount = round($order['amount'] - $subtotal, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout — Lunar Assessments</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
    :root{
        --blue:#3B5BFE; --blue-deep:#2B46D6; --blue-soft:#EAF0FF;
        --bg:#F4F6FB; --card:#FFFFFF;
        --ink:#16213E; --muted:#8A93A6; --line:#E9ECF3;
        --green:#16A34A;
        --danger:#DC3545; --danger-soft:#FDECEE;
        --font:'Inter',system-ui,-apple-system,sans-serif;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:var(--font);background:var(--bg);color:var(--ink);}

   
    .wrap{margin:0 auto;padding:10px 50px 80px;flex:1 1 auto;min-height:0;display:flex;flex-direction:column;width:100%;}

    .head-row{display:flex;align-items:baseline;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:8px;flex:none;}
    .hero-title{font-size:17px;font-weight:800;margin:0;color:var(--ink);}
    .hero-sub{font-size:11.5px;color:var(--muted);margin:0;max-width:520px;line-height:1.4;}

    /* ---- Progress card (dashboard-style stepper) ---- */
    .progress-card{
        background:var(--card);border:1px solid var(--line);border-radius:12px;
        padding:10px 18px;box-shadow:0 1px 2px rgba(16,24,40,.04);
        display:flex;align-items:center;gap:18px;flex-wrap:wrap;margin-bottom:8px;flex:none;
    }
    .progress-title{font-size:12.5px;font-weight:800;color:var(--ink);white-space:nowrap;flex:none;}
    .phase-stepper{display:flex;align-items:center;flex:1 1 auto;flex-wrap:wrap;gap:0;}
    .phase-step{display:flex;align-items:center;gap:8px;flex:none;}
    .phase-icon{
        width:26px;height:26px;border-radius:50%;border:2px solid var(--line);background:#fff;
        display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:var(--muted);
        flex:none;
    }
    .phase-step.done .phase-icon{background:var(--green);border-color:var(--green);color:#fff;}
    .phase-step.active .phase-icon{background:var(--card);border:2px solid var(--blue);color:var(--blue);}
    .phase-step.locked .phase-icon{color:#C3C9D6;border-color:var(--line);}
    .phase-text{line-height:1.2;}
    .phase-name{font-size:11.5px;font-weight:700;color:var(--ink);white-space:nowrap;}
    .phase-status{font-size:9.5px;font-weight:600;color:var(--muted);white-space:nowrap;}
    .phase-step.active .phase-status{color:var(--blue);}
    .phase-step.done .phase-status{color:var(--green);}
    .phase-step.locked .phase-name{color:#A7AEBD;}
    .phase-connector{width:110px;height:0;border-top:2px dashed var(--line);margin:0 10px;flex:none;}
    .phase-connector.filled{border-top-color:var(--green);}
    @media (max-width:520px){.phase-status{display:none;}}

    /* ---- Checkout layout ---- */
    .checkout-grid{display:grid;grid-template-columns:1fr 380px;gap:24px;margin-top:16px;}
    @media (max-width:760px){.checkout-grid{grid-template-columns:1fr;}}

    .card{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:24px;box-shadow:0 1px 2px rgba(16,24,40,.04);}
    .card h2{font-size:15px;font-weight:800;margin:0 0 16px;}

    .order-item{display:flex;justify-content:space-between;align-items:flex-start;padding:12px 0;border-bottom:1px solid var(--line);}
    .order-item:last-child{border-bottom:none;}
    .oi-name{font-weight:700;font-size:14px;color:var(--ink);}
    .oi-qty{font-size:12px;color:var(--muted);margin-top:2px;}
    .oi-price{font-weight:700;font-size:14px;white-space:nowrap;}

    .totals-row{display:flex;justify-content:space-between;font-size:13.5px;color:var(--muted);padding:6px 0;}
    .totals-row.grand{color:var(--ink);font-weight:800;font-size:16px;border-top:1px solid var(--line);margin-top:8px;padding-top:14px;}
    .totals-row.grand span:last-child{color:var(--blue);}

    .cin-note{font-size:13px;color:var(--muted);margin-bottom:18px;}
    .cin-note strong{color:var(--ink);}

    .pay-btn{
        margin-top:8px;width:100%;background:var(--blue);color:#fff;border:none;padding:14px;
        border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;
    }
    .pay-btn:hover{background:var(--blue-deep);}
    .pay-btn[disabled]{opacity:.6;cursor:default;}

    .status-msg{margin-top:14px;font-size:13.5px;text-align:center;}
    .secure-note{margin-top:16px;font-size:12px;color:var(--muted);text-align:center;}

    .back-link{    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 16px;
    font-size: 16px;
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    border: 2px solid #F44336;
    padding: 0.5rem;
    border-radius: 5px;
    background: #F44336;
    width:155px;
    }
    .back-link:hover{color:#fff;}
</style>
</head>
<body>



<div class="wrap">
    <div class="progress-card">
        <span class="progress-title">Your Progress</span>
        <div class="phase-stepper">
            <div class="phase-step done">
                <span class="phase-icon">1</span>
                <span class="phase-text"><span class="phase-name">Register</span><br><span class="phase-status">Completed</span></span>
            </div>
            <div class="phase-connector filled"></div>
            <div class="phase-step done">
                <span class="phase-icon">2</span>
                <span class="phase-text"><span class="phase-name">Choose Plan</span><br><span class="phase-status">Completed</span></span>
            </div>
            <div class="phase-connector filled"></div>
            <div class="phase-step done">
                <span class="phase-icon">3</span>
                <span class="phase-text"><span class="phase-name">Cart</span><br><span class="phase-status">Completed</span></span>
            </div>
            <div class="phase-connector filled"></div>
            <div class="phase-step active">
                <span class="phase-icon">4</span>
                <span class="phase-text"><span class="phase-name">Checkout</span><br><span class="phase-status">In Progress</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step locked">
                <span class="phase-icon">5</span>
                <span class="phase-text"><span class="phase-name">Pay</span><br><span class="phase-status">Upcoming</span></span>
            </div>
        </div>
    </div>

    <div class="checkout-grid">
        <div class="card">
            <h2>Review your order</h2>
            <div class="cin-note">Checking out for <strong><?php echo htmlspecialchars($student['first_name']); ?></strong> — CIN: <strong><?php echo htmlspecialchars($student['PRID']); ?></strong></div>

            <?php foreach ($order_items as $item): ?>
                <div class="order-item">
                    <div>
                        <div class="oi-name"><?php echo htmlspecialchars($item['plan_name']); ?></div>
                        <div class="oi-qty">Qty: <?php echo (int) $item['quantity']; ?></div>
                    </div>
                    <div class="oi-price">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                </div>
            <?php endforeach; ?>

            <div class="totals-row">
                <span>Subtotal</span>
                <span>₹<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="totals-row">
                <span>GST (18%)</span>
                <span>₹<?php echo number_format($gst_amount, 2); ?></span>
            </div>
            <div class="totals-row grand">
                <span>Total</span>
                <span>₹<?php echo number_format($order['amount'], 2); ?></span>
            </div>
        </div>

        <div class="card">
            <h2>Payment</h2>
            <button id="payBtn" class="pay-btn">Pay ₹<?php echo number_format($order['amount'], 2); ?></button>
            <div id="statusMsg" class="status-msg"></div>
            <div class="secure-note">🔒 Secure checkout — payments processed by Razorpay</div>
        </div>
    </div>

    <a href="<?php echo site_url('student_registration/cart/' . $student['PRID']); ?>" class="back-link">
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 8H4M7 4L3 8l4 4" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Back to Cart
    </a>
</div>

<script>
    var options = {
        "key": <?php echo json_encode($razorpay_key_id); ?>,
        "amount": <?php echo (int) round($order['amount'] * 100); ?>,
        "currency": "INR",
        "name": "Lunar Skill Test",
        "description": "Study Pack purchase",
        "order_id": <?php echo json_encode($razorpay_order['id']); ?>,
        "prefill": {
            "name": <?php echo json_encode($student['first_name']); ?>,
            "email": <?php echo json_encode($student['email'] ?? ''); ?>,
            "contact": <?php echo json_encode($student['mobile'] ?? ''); ?>
        },
        "handler": function (response) {
            var btn = document.getElementById('payBtn');
            btn.disabled = true;
            var msg = document.getElementById('statusMsg');
            msg.style.color = '#3B5BFE';
            msg.textContent = 'Payment received, confirming...';

            fetch("<?php echo site_url('student_registration/razorpay_verify'); ?>", {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'razorpay_order_id=' + encodeURIComponent(response.razorpay_order_id)
                    + '&razorpay_payment_id=' + encodeURIComponent(response.razorpay_payment_id)
                    + '&razorpay_signature=' + encodeURIComponent(response.razorpay_signature)
            })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (res.success) {
                    window.location.href = res.redirect_url;
                } else {
                    // verify said no (or errored) — before giving up,
                    // ask Razorpay directly whether this payment_id was
                    // actually captured. It often was: verify can fail
                    // for reasons that have nothing to do with whether
                    // money moved (network blip, our server hiccup,
                    // etc). reconcile_payment() re-checks with Razorpay
                    // itself rather than trusting the client.
                    attemptReconcile(response.razorpay_payment_id);
                }
            })
            .catch(function () {
                // Network/parse failure during verify. The payment may
                // still have gone through on Razorpay's side even though
                // we couldn't confirm it here — never let the user retry
                // this same order (reopening rzp would retry the SAME
                // already-paid order_id and Razorpay declines it
                // outright). Ask Razorpay directly instead.
                attemptReconcile(response.razorpay_payment_id);
            });
        },
        "modal": {
            "ondismiss": function () {
                document.getElementById('statusMsg').textContent = 'Payment cancelled.';
            }
        }
    };

    // Asks our server to re-check this payment_id directly with
    // Razorpay and, if it really was captured, finalize the order
    // and send back a redirect — same idempotent endpoint whether
    // this is the automatic first attempt or a manual re-check click.
    function attemptReconcile(paymentId) {
        var msg = document.getElementById('statusMsg');
        msg.style.color = '#3B5BFE';
        msg.textContent = 'Payment received, confirming...';

        fetch("<?php echo site_url('student_registration/reconcile_payment'); ?>", {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'razorpay_payment_id=' + encodeURIComponent(paymentId)
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                window.location.href = res.redirect_url;
            } else {
                showVerifyFailureUI(paymentId, res.message || 'Could not confirm payment.');
            }
        })
        .catch(function () {
            showVerifyFailureUI(paymentId, 'Could not confirm payment.');
        });
    }

    function showVerifyFailureUI(paymentId, message) {
        var btn = document.getElementById('payBtn');
        btn.disabled = true; // permanently — this order is spent

        var msg = document.getElementById('statusMsg');
        msg.style.color = '#DC3545';
        msg.innerHTML = message
            + ' Your payment ID is <strong>' + paymentId + '</strong> — please save this.'
            + ' <a href="#" id="recheckLink">Check payment status again</a>'
            + ' &middot; <a href="<?php echo site_url('student_registration/checkout/' . $student['PRID']); ?>">Start a new checkout attempt</a>'
            + ' or contact support with your payment ID.';

        var recheck = document.getElementById('recheckLink');
        if (recheck) {
            recheck.addEventListener('click', function (e) {
                e.preventDefault();
                attemptReconcile(paymentId);
            });
        }
    }

    var rzp = new Razorpay(options);
    document.getElementById('payBtn').addEventListener('click', function () {
        rzp.open();
    });
</script>
</body>
</html>