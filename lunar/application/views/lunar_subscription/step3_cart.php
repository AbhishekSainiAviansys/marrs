<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lunar – Checkout</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
  :root {
    --ink: #0d1117; --paper: #f7f3ed; --accent: #e8531a; --accent2: #1a3e8a;
    --muted: #8a8278; --card: #ffffff; --border: #e2ddd7;
    --success: #1a7a4a; --error: #c0392b;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'DM Sans', sans-serif; background: var(--paper); min-height: 100vh; padding: 2rem; }
  body::before {
    content: ''; position: fixed; inset: 0;
    background: radial-gradient(ellipse 60% 40% at 80% 10%, rgba(232,83,26,0.06) 0%, transparent 60%);
    pointer-events: none;
  }
  .container { max-width: 800px; margin: 0 auto; }
  header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem; }
  .logo { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--ink); }
  .logo span { color: var(--accent); }
  .back-link { color: var(--muted); font-size: 0.88rem; text-decoration: none; }
  .back-link:hover { color: var(--accent); }
  .steps { display: flex; gap: 6px; margin-bottom: 2rem; }
  .step { height: 4px; flex: 1; border-radius: 10px; background: var(--border); }
  .step.done   { background: var(--success); }
  .step.active { background: var(--accent); }
  h1 { font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800; color: var(--ink); margin-bottom: 0.3rem; }
  .subtitle { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }
  .cart-list { display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1.5rem; }
  .cart-item {
    background: var(--card); border: 1.5px solid var(--border); border-radius: 14px;
    padding: 1.2rem 1.5rem; display: flex; align-items: center; justify-content: space-between;
    gap: 1rem; transition: opacity 0.3s;
  }
  .item-info { flex: 1; }
  .item-name { font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--ink); }
  .item-meta { font-size: 0.8rem; color: var(--muted); margin-top: 3px; }
  .item-price { font-family: 'Syne', sans-serif; font-size: 1.2rem; font-weight: 800; color: var(--ink); margin-right: 1rem; }
  .remove-btn {
    background: none; border: 1.5px solid var(--border); color: var(--muted);
    border-radius: 8px; padding: 6px 12px; cursor: pointer; font-size: 0.8rem; transition: all 0.2s;
  }
  .remove-btn:hover    { border-color: var(--error); color: var(--error); background: #fdf0ef; }
  .remove-btn:disabled { opacity: 0.5; cursor: not-allowed; }
  .summary {
    background: var(--card); border: 1.5px solid var(--border); border-radius: 14px;
    padding: 1.5rem; margin-bottom: 1.5rem;
  }
  .summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 0.9rem; color: var(--muted); }
  .summary-row.total {
    border-top: 1.5px solid var(--border); margin-top: 8px; padding-top: 16px;
    font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.2rem; color: var(--ink);
  }
  .pay-btn {
    width: 100%; padding: 16px; background: var(--accent); color: #fff;
    border: none; border-radius: 12px; font-family: 'Syne', sans-serif;
    font-size: 1rem; font-weight: 700; cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center; gap: 10px;
  }
  .pay-btn:hover    { background: #c94410; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(232,83,26,0.25); }
  .pay-btn:disabled { background: var(--muted); cursor: not-allowed; transform: none; box-shadow: none; }
  .secure-note {
    text-align: center; color: var(--muted); font-size: 0.78rem; margin-top: 1rem;
    display: flex; align-items: center; justify-content: center; gap: 6px;
  }
  .spinner {
    display: inline-block; width: 18px; height: 18px;
    border: 2px solid rgba(255,255,255,0.4); border-top-color: #fff;
    border-radius: 50%; animation: spin 0.7s linear infinite;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
  .alert {
    padding: 12px 16px; border-radius: 10px; font-size: 0.88rem;
    margin-bottom: 1rem; display: none;
  }
  .alert.error   { background: #fdf0ef; color: var(--error); border: 1px solid #f5c6c3; }
  .alert.success { background: #edf7f2; color: var(--success); border: 1px solid #b8e6cc; }
  .alert.show    { display: block; }
  .empty-cart { text-align: center; padding: 4rem 2rem; color: var(--muted); }
  .empty-cart .icon { font-size: 3rem; margin-bottom: 1rem; }
  .empty-cart a { color: var(--accent); }
</style>
</head>
<body>

<div class="container">

  <header>
    <div class="logo">🌙 <span>Lunar</span></div>
    <a href="<?= base_url('Lunar/products') ?>" class="back-link">← Back to Products</a>
  </header>

  <div class="steps">
    <div class="step done"></div>
    <div class="step done"></div>
    <div class="step active"></div>
    <div class="step"></div>
  </div>

  <h1>Review & Pay</h1>
  <p class="subtitle">
    Confirm your selection for
    <?= htmlspecialchars($name) ?> (<?= htmlspecialchars($email) ?>)
  </p>

  <!-- Alert — always present, outside if/else -->
  <div id="alert" class="alert"></div>

  <?php if (empty($cart)): ?>

    <div class="empty-cart">
      <div class="icon">🛒</div>
      <p>Your cart is empty. <a href="<?= site_url('Lunar/products') ?>">Browse products</a></p>
    </div>

  <?php else: ?>

    <div class="cart-list" id="cart-list">
      <?php foreach ($cart as $item): ?>
      <div class="cart-item" id="item-<?= (int)$item['lunar_schedule_id'] ?>">
        <div class="item-info">
          <div class="item-name">
            <?= htmlspecialchars($item['subject']) ?> – <?= htmlspecialchars($item['series']) ?> Series
          </div>
          <div class="item-meta">
            Level <?= htmlspecialchars($item['level']) ?>
            &bull; <?= htmlspecialchars($item['type']) ?>
            &bull; Code: <?= htmlspecialchars($item['registration_code']) ?>
          </div>
        </div>
        <div class="item-price">₹<?= number_format($item['amount'], 0) ?></div>
        <button
          class="remove-btn"
          onclick="removeItem(<?= (int)$item['lunar_schedule_id'] ?>, this)"
        >✕ Remove</button>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="summary">
      <div class="summary-row">
        <span id="subtotal-label">Subtotal (<?= count($cart) ?> item<?= count($cart) > 1 ? 's' : '' ?>)</span>
        <span id="subtotal-amount">₹<?= number_format($total, 0) ?></span>
      </div>
      <div class="summary-row">
        <span>GST / Taxes</span>
        <span>Included</span>
      </div>
      <div class="summary-row total">
        <span>Total</span>
        <span id="grand-total">₹<?= number_format($total, 0) ?></span>
      </div>
    </div>

    <button class="pay-btn" id="pay-btn" onclick="initiatePayment()">
      🔒 Pay ₹<?= number_format($total, 0) ?> Securely
    </button>

    <div class="secure-note">
      🔐 Powered by Razorpay &nbsp;|&nbsp; 256-bit SSL Encrypted &nbsp;|&nbsp; PCI-DSS Compliant
    </div>

  <?php endif; ?>

</div><!-- /.container -->

<!-- ✅ Hidden form — always OUTSIDE if/else -->
<form id="payment-form" action="<?= site_url('Lunar/payment_success') ?>" method="POST" style="display:none">
  <input type="hidden" name="razorpay_order_id"   id="rp_order_id">
  <input type="hidden" name="razorpay_payment_id" id="rp_payment_id">
  <input type="hidden" name="razorpay_signature"  id="rp_signature">

</form>

<?php
  // ✅ Safely get CSRF values in PHP before outputting to JS
  $csrf_name = $this->security->get_csrf_token_name();
  $csrf_hash = $this->security->get_csrf_hash();
?>

<!-- ✅ Script always OUTSIDE if/else — functions are global -->
<script>

  var BASE      = '<?= base_url() ?>';
  var CSRF_NAME = '<?= $csrf_name ?>';
  var CSRF_HASH = '<?= $csrf_hash ?>';

  /* ── Alert ───────────────────────────────────────────────────────────────── */
  function showAlert(msg, type) {
    var el = document.getElementById('alert');
    if (!el) return;
    el.textContent   = msg;
    el.className     = 'alert ' + type + ' show';
    el.style.display = 'block';
    setTimeout(function () {
      el.className     = 'alert';
      el.style.display = 'none';
    }, 5000);
  }

  /* ── Update totals after remove ──────────────────────────────────────────── */
  function updateTotals(count, newTotal) {
    var label = document.getElementById('subtotal-label');
    if (label) label.textContent = 'Subtotal (' + count + ' item' + (count > 1 ? 's' : '') + ')';

    var formatted = '₹' + Number(newTotal).toLocaleString('en-IN', { maximumFractionDigits: 0 });

    var sub    = document.getElementById('subtotal-amount');
    var grand  = document.getElementById('grand-total');
    var payBtn = document.getElementById('pay-btn');

    if (sub)    sub.textContent   = formatted;
    if (grand)  grand.textContent = formatted;
    if (payBtn && !payBtn.disabled) payBtn.textContent = '🔒 Pay ' + formatted + ' Securely';
  }

  /* ── Remove item ─────────────────────────────────────────────────────────── */
  function removeItem(id, btn) {
    btn.disabled    = true;
    btn.textContent = '...';

    var fd = new FormData();
    fd.append('lunar_schedule_id', id);
    fd.append(CSRF_NAME, CSRF_HASH);

    fetch(BASE + 'Lunar/remove_from_cart', { method: 'POST', body: fd })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (data.status === 'success') {
          var el = document.getElementById('item-' + id);
          if (el) el.style.opacity = '0';
          setTimeout(function () {
            if (el) el.remove();
            if (data.cart_count === 0) {
              location.reload();
            } else {
              updateTotals(data.cart_count, data.new_total);
            }
          }, 300);
        } else {
          showAlert(data.message || 'Could not remove item.', 'error');
          btn.disabled    = false;
          btn.textContent = '✕ Remove';
        }
      })
      .catch(function (err) {
        console.error('Remove error:', err);
        showAlert('Network error. Please try again.', 'error');
        btn.disabled    = false;
        btn.textContent = '✕ Remove';
      });
  }

  /* ── Initiate payment ────────────────────────────────────────────────────── */
  function initiatePayment() {
    var btn = document.getElementById('pay-btn');
    btn.innerHTML = '<span class="spinner"></span> Creating order...';
    btn.disabled  = true;

    var fd = new FormData();
    fd.append(CSRF_NAME, CSRF_HASH);

    fetch(BASE + 'Lunar/create_razorpay_order', { method: 'POST', body: fd })
      .then(function (res) { return res.json(); })
      .then(function (data) {
        if (data.status !== 'success') {
          showAlert('Could not initiate payment: ' + (data.message || 'Unknown error'), 'error');
          btn.innerHTML = '🔒 Pay Securely';
          btn.disabled  = false;
          return;
        }

        var options = {
          key:         data.key_id,
          amount:      data.amount,
          currency:    'INR',
          name:        'Lunar Examination',
          description: 'Exam Registration',
          order_id:    data.order_id,
          prefill:     { name: data.name, email: data.email },
          theme:       { color: '#e8531a' },
          handler: function (response) {
            document.getElementById('rp_order_id').value   = response.razorpay_order_id;
            document.getElementById('rp_payment_id').value = response.razorpay_payment_id;
            document.getElementById('rp_signature').value  = response.razorpay_signature;
            document.getElementById('payment-form').submit();
          },
          modal: {
            ondismiss: function () {
              showAlert('Payment cancelled. You can try again.', 'error');
              btn.innerHTML = '🔒 Pay Securely';
              btn.disabled  = false;
            }
          }
        };

        new Razorpay(options).open();
      })
      .catch(function (err) {
        console.error('Payment error:', err);
        showAlert('Something went wrong. Please try again.', 'error');
        btn.innerHTML = '🔒 Pay Securely';
        btn.disabled  = false;
      });
  }

</script>
</body>
</html>