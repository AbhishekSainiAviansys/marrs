<?php $this->load->view('checkout_nav');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Cart — Lunar Assessments</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root{
        --blue:#3B5BFE; --blue-deep:#2B46D6; --blue-soft:#EAF0FF;
        --bg:#F4F6FB; --card:#FFFFFF;
        --ink:#16213E; --muted:#8A93A6; --line:#E9ECF3;
        --green:#16A34A; --green-soft:#E3F8EA;
        --danger:#DC3545; --danger-soft:#FDECEE;
        --font:'Inter',system-ui,-apple-system,sans-serif;
    }
    *{box-sizing:border-box;}
    body{margin:0;font-family:var(--font);background:var(--bg);color:var(--ink);}


    .page-head{margin-bottom:22px;}
    .page-head h1{font-size:24px;font-weight:800;margin:0 0 6px;}
    .page-head p{color:var(--muted);margin:0;font-size:14px;}
    .page-head .cin-pill{
        display:inline-flex;align-items:center;gap:6px;margin-top:10px;background:var(--blue-soft);color:var(--blue);
        padding:6px 12px;border-radius:20px;font-size:12.5px;font-weight:700;
    }

     /* ---- Top bar / brand ---- */
    
    .login-link{font-size:12px;color:var(--muted);}
    .login-link a{color:var(--blue);font-weight:700;text-decoration:none;}

    .wrap{margin:0 auto;padding:10px 50px;flex:1 1 auto;min-height:0;display:flex;flex-direction:column;width:100%;}

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

    /* ---- Two column layout ---- */
    .cart-layout{display:flex;gap:24px;align-items:flex-start;margin-top:24px;}
    .cart-main{flex:1 1 auto;min-width:0;}
    .cart-side{width:340px;flex:none;}
    @media (max-width:860px){
        .cart-layout{flex-direction:column;}
        .cart-side{width:100%;}
    }

    .cart-card{background:var(--card);border:1px solid var(--line);border-radius:16px;box-shadow:0 1px 2px rgba(16,24,40,.04);overflow:hidden;}
    .cart-card-head{display:flex;justify-content:space-between;align-items:center;padding:18px 22px;border-bottom:1px solid var(--line);}
    .cart-card-head h2{font-size:16px;font-weight:800;margin:0;}
    .cart-card-head .count-pill{font-size:12.5px;font-weight:700;color:var(--muted);}

    .col-labels{display:grid;grid-template-columns:1fr 110px 110px;gap:12px;padding:12px 22px;font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);font-weight:700;border-bottom:1px solid var(--line);}
    @media (max-width:600px){.col-labels{display:none;}}

    .cart-item{
        display:grid;grid-template-columns:1fr 110px 110px;gap:12px;align-items:center;
        padding:18px 22px;border-bottom:1px solid var(--line);
    }
    .cart-item:last-child{border-bottom:none;}
    @media (max-width:600px){
        .cart-item{grid-template-columns:1fr;gap:8px;}
        .item-meta-row{display:flex;justify-content:space-between;align-items:center;}
    }

    .item-details{display:flex;align-items:center;gap:14px;}
    .item-thumb{width:56px;height:56px;border-radius:10px;background:var(--blue-soft);color:var(--blue);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;flex:none;}
    .item-name{font-weight:700;font-size:15px;margin-bottom:3px;color:var(--ink);}
    .item-qty{font-weight:600;font-size:12.5px;color:var(--muted);}
    .item-category{font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:var(--blue);font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:2px;}
    .type-badge{font-size:9.5px;letter-spacing:.03em;font-weight:800;padding:2px 7px;border-radius:999px;text-transform:none;}
    .type-badge.type-plan{background:var(--blue-soft);color:var(--blue);}
    .type-badge.type-component{background:var(--green-soft);color:var(--green);}
    .item-remove{margin-top:6px;}
    .remove-btn{
        background:none;border:none;color:var(--danger);
        padding:0;font-size:12.5px;font-weight:600;cursor:pointer;font-family:var(--font);text-decoration:underline;
    }
    .remove-btn:hover{color:#a3202c;}

    .item-price, .item-total{font-size:14.5px;font-weight:700;color:var(--ink);text-align:right;white-space:nowrap;}
    .item-total{color:var(--blue-deep);}

    .empty-cart{color:var(--muted);text-align:center;padding:48px 20px;font-size:14px;}
    .empty-cart a{color:var(--blue);font-weight:700;text-decoration:none;}

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
    float: right;}
    .back-link:hover{color:#fff;}
   

    /* ---- Order summary sidebar ---- */
    .summary-card{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:22px 24px;box-shadow:0 1px 2px rgba(16,24,40,.04);}
    .summary-card h2{font-size:16px;font-weight:800;margin:0 0 18px;}
    .summary-row{display:flex;justify-content:space-between;align-items:center;font-size:13.5px;color:var(--ink);padding:9px 0;}
    .summary-row .label{color:var(--muted);font-weight:600;}
    .summary-row .value{font-weight:700;}
    .summary-divider{height:1px;background:var(--line);margin:8px 0;}

    .total-row{
        display:flex;justify-content:space-between;align-items:center;
        font-size:16px;font-weight:700;padding-top:6px;
    }
    .total-row span.amount{color:var(--blue);font-size:22px;font-weight:800;}

    .checkout-row{margin-top:18px;}
    .checkout-btn{
        display:flex;align-items:center;justify-content:center;gap:8px;width:100%;background:var(--blue);color:#fff;border:none;
        padding:14px;border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;text-align:center;text-decoration:none;font-family:var(--font);
    }
    .checkout-btn:hover{background:var(--blue-deep);}
    .secure-note{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:12px;font-size:11.5px;color:var(--muted);font-weight:600;}
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
            <div class="phase-connector"></div>
            <div class="phase-step done">
                <span class="phase-icon">2</span>
                <span class="phase-text"><span class="phase-name">Choose Plan</span><br><span class="phase-status">Completed</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step active">
                <span class="phase-icon">3</span>
                <span class="phase-text"><span class="phase-name">Cart</span><br><span class="phase-status">In Progress</span></span>
            </div>
            <div class="phase-connector"></div>
             <div class="phase-step locked">
                <span class="phase-icon">3</span>
                <span class="phase-text"><span class="phase-name">Checkout</span><br><span class="phase-status">Upcoming</span></span>
            </div>
            <div class="phase-connector"></div>
            <div class="phase-step locked">
                <span class="phase-icon">4</span>
                <span class="phase-text"><span class="phase-name">Pay</span><br><span class="phase-status">Upcoming</span></span>
            </div>
        </div>
    </div>

    <div class="cart-layout">

        <!-- Main: item list -->
        <div class="cart-main">
            <div class="cart-card">
                <div class="cart-card-head">
                    <h2>Shopping Cart</h2>
                    <span class="count-pill"><?php echo count($cart); ?> Item<?php echo count($cart) == 1 ? '' : 's'; ?></span>
                </div>

                <?php if (!empty($cart)): ?>
                <div class="col-labels">
                    <span>Item Details</span>
                    <span style="text-align:right;">Price</span>
                    <span style="text-align:right;">Total</span>
                </div>
                <?php endif; ?>

                <div id="cartItems">
                    <?php if (empty($cart)): ?>
                        <div class="empty-cart" id="emptyCartMsg">
                            Your cart is empty. <a href="<?php echo site_url('student_registration/select_plan/' . $student['PRID']); ?>">Browse plans</a>
                        </div>
                    <?php else: ?>
                        <?php foreach ($cart as $item): ?>
                            <div class="cart-item" data-cart-item-id="<?php echo $item['cart_item_id']; ?>">
                                <div class="item-details">
                                    <div class="item-thumb"><?php echo strtoupper(substr($item['category_name'], 0, 2)); ?></div>
                                    <div>
                                        <div class="item-category">
                                            <?php echo htmlspecialchars($item['category_name']); ?>
                                            <span class="type-badge type-<?php echo htmlspecialchars($item['item_type']); ?>">
                                                <?php echo $item['item_type'] === 'component' ? 'Component' : 'Plan'; ?>
                                            </span>
                                        </div>
                                        <div class="item-name">
                                            <?php echo htmlspecialchars($item['name']); ?>
                                            <?php if ($item['quantity'] > 1): ?>
                                                <span class="item-qty">× <?php echo (int) $item['quantity']; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="item-remove">
                                            <button type="button" class="remove-btn" data-remove data-cart-item-id="<?php echo $item['cart_item_id']; ?>">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-price">₹<?php echo number_format($item['price'], 2); ?></div>
                                <div class="item-total">₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?php echo site_url('student_registration/select_plan/' . $student['PRID']); ?>" class="back-link">
                <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 8H4M7 4L3 8l4 4" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Continue Shopping
            </a>
        </div>

        <!-- Sidebar: order summary -->
        <div class="cart-side">
            <div class="summary-card">
                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span class="label">Items</span>
                    <span class="value"><?php echo count($cart); ?></span>
                </div>
                <div class="summary-row">
                    <span class="label">Subtotal</span>
                    <span class="value">₹<?php echo number_format($cart_total, 2); ?></span>
                </div>

                <div class="summary-divider"></div>

                <div class="total-row">
                    <span>Total Cost</span>
                    <span class="amount">₹<span id="cartTotal"><?php echo number_format($cart_total, 2); ?></span></span>
                </div>

                <div class="checkout-row">
                    <a href="<?php echo site_url('student_registration/checkout/' . $student['PRID']); ?>" class="checkout-btn" id="checkoutBtn"
                       <?php echo empty($cart) ? 'style="pointer-events:none;opacity:.5;"' : ''; ?>>
                        Proceed to Pay
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 8h8M9 4l4 4-4 4" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="secure-note">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="7" width="10" height="7" rx="1.5" stroke="#8A93A6" stroke-width="1.3"/><path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="#8A93A6" stroke-width="1.3"/></svg>
                    Secure checkout
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    var CIN = <?php echo json_encode($student['PRID']); ?>;
    var removeUrl = "<?php echo site_url('student_registration/ajax_remove_from_cart'); ?>";
    var itemCount = <?php echo count($cart); ?>;

    function updateItemCountUI(n) {
        var pill = document.querySelector('.count-pill');
        if (pill) { pill.textContent = n + (n === 1 ? ' Item' : ' Items'); }
        var summaryItems = document.querySelectorAll('.summary-row .value')[0];
        if (summaryItems) { summaryItems.textContent = n; }
    }

    document.querySelectorAll('[data-remove]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var cartItemId = btn.getAttribute('data-cart-item-id');
            btn.disabled = true;
            btn.textContent = 'Removing...';

            fetch(removeUrl, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'cin=' + encodeURIComponent(CIN) + '&cart_item_id=' + encodeURIComponent(cartItemId)
            })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (res.success) {
                    var row = document.querySelector('.cart-item[data-cart-item-id="' + cartItemId + '"]');
                    if (row) { row.remove(); }
                    document.getElementById('cartTotal').textContent = Number(res.total).toFixed(2);
                    document.querySelectorAll('.summary-row .value')[1].textContent = '₹' + Number(res.total).toFixed(2);

                    itemCount = res.cart.length;
                    updateItemCountUI(itemCount);

                    if (!res.cart.length) {
                        document.getElementById('cartItems').innerHTML =
                            '<div class="empty-cart">Your cart is empty. <a href="<?php echo site_url('student_registration/select_plan/' . $student['PRID']); ?>">Browse plans</a></div>';
                        var colLabels = document.querySelector('.col-labels');
                        if (colLabels) { colLabels.style.display = 'none'; }
                        var checkoutBtn = document.getElementById('checkoutBtn');
                        checkoutBtn.style.pointerEvents = 'none';
                        checkoutBtn.style.opacity = '.5';
                    }
                } else {
                    btn.disabled = false;
                    btn.textContent = 'Remove';
                    alert(res.message || 'Could not remove item.');
                }
            })
            .catch(function () {
                btn.disabled = false;
                btn.textContent = 'Remove';
                alert('Network error — please try again.');
            });
        });
    });
</script>
</body>
</html>