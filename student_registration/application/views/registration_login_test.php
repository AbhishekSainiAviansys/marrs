<?php include('header1.php'); 
$name=$student->first_name.' '.$student->middle_name.' '.$student->last_name;
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --purple-dark:   #4a1fa8;
    --purple-mid:    #6c3fc5;
    --purple-light:  #9b6fe8;
    --blue-bright:   #3b82f6;
    --blue-soft:     #dbeafe;
    --green-bright:  #22c55e;
    --green-soft:    #dcfce7;
    --orange:        #f97316;
    --orange-soft:   #ffedd5;
    --yellow:        #eab308;
    --yellow-soft:   #fef9c3;
    --bg:            #f0eefc;
    --card-bg:       #ffffff;
    --text-dark:     #1e1b4b;
    --text-mid:      #4c4980;
    --text-light:    #7c7aab;
    --radius-lg:     20px;
    --radius-md:     14px;
    --radius-sm:     8px;
    --shadow-card:   0 4px 24px rgba(74,31,168,0.10);
    --shadow-btn:    0 4px 14px rgba(74,31,168,0.25);
  }

  body {
    font-family: 'Nunito Sans', sans-serif;
    background: var(--bg);
    color: var(--text-dark);
    min-height: 100vh;
  }

  a { text-decoration: none; }

  .dash-wrapper {
    max-width: 1160px;
    margin: 0 auto;
    padding: 1.75rem 1.25rem 3rem;
    display: grid;
    grid-template-columns: 290px 1fr;
    gap: 1.5rem;
    align-items: start;
  }
  @media (max-width: 780px) { .dash-wrapper { grid-template-columns: 1fr; } }

  .card-m {
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
    overflow: hidden;
  }
  .card-m + .card-m { margin-top: 1.25rem; }

  /* ══ PROFILE SIDEBAR ══ */
  .profile-banner {
    background: linear-gradient(135deg, var(--purple-dark) 0%, var(--purple-light) 100%);
    padding: 2rem 1.5rem 1.5rem;
    text-align: center;
    position: relative;
  }
  .profile-banner::after {
    content: '';
    position: absolute; bottom: -18px; left: 0; right: 0;
    height: 36px;
    background: var(--card-bg);
    border-radius: 50% 50% 0 0 / 100% 100% 0 0;
  }
  .profile-avatar {
    width: 84px; height: 84px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    border: 3px solid rgba(255,255,255,0.6);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
  }
  .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .profile-name {
    font-family: 'Nunito', sans-serif;
    font-weight: 800; font-size: 17px; color: #fff;
    letter-spacing: 0.5px; margin-bottom: 4px;
  }
  .profile-cin {
    font-size: 12px; color: rgba(255,255,255,0.75);
    font-weight: 600; letter-spacing: 0.4px;
  }

  .profile-info { padding: 1.75rem 1.25rem 0.5rem; }
  .info-item {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: var(--radius-sm);
    margin-bottom: 6px; transition: background 0.15s;
  }
  .info-item:hover { background: var(--bg); }
  .info-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; flex-shrink: 0;
  }
  .icon-purple { background: #ede9fe; }
  .icon-blue   { background: var(--blue-soft); }
  .icon-green  { background: var(--green-soft); }
  .info-label  { font-size: 10px; font-weight: 700; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px; }
  .info-value  { font-size: 13px; font-weight: 700; color: var(--text-dark); }
  .info-sub    { font-size: 11px; color: var(--text-light); margin-top: 1px; }

  .btn-edit-profile {
    display: block; margin: 0.75rem 1.25rem 1.25rem;
    background: linear-gradient(135deg, var(--purple-dark), var(--purple-mid));
    color: #fff; border: none; border-radius: 30px;
    font-family: 'Nunito', sans-serif; font-weight: 700; font-size: 13px;
    padding: 9px 0; width: calc(100% - 2.5rem);
    cursor: pointer; transition: opacity 0.15s;
    box-shadow: var(--shadow-btn);
  }
  .btn-edit-profile:hover { opacity: 0.88; }

  /* ══ RIGHT COLUMN ══ */
  .right-col { display: flex; flex-direction: column; gap: 1.25rem; }

  /* ── Promo banner ── */
  .promo-banner {
    background: linear-gradient(120deg, #1e1b4b 0%, var(--purple-mid) 60%, var(--purple-light) 100%);
    border-radius: var(--radius-lg);
    padding: 1.5rem 2rem;
    display: flex; align-items: center; justify-content: space-between;
    gap: 1rem; flex-wrap: wrap;
    box-shadow: var(--shadow-btn);
    position: relative; overflow: hidden;
  }
  .promo-banner::before {
    content: '✦'; position: absolute; top: -10px; right: 60px;
    font-size: 60px; color: rgba(255,255,255,0.07);
  }
  .promo-banner::after {
    content: '✦'; position: absolute; bottom: -20px; right: 20px;
    font-size: 90px; color: rgba(255,255,255,0.05);
  }
  .promo-text { flex: 1; }
  .promo-title {
    font-family: 'Nunito', sans-serif;
    font-weight: 900; font-size: 18px; color: #fff; margin-bottom: 4px;
  }
  .promo-sub { font-size: 13px; color: rgba(255,255,255,0.80); }
  .promo-sub strong { color: #fff; }

  /* ── Status pill ── */
  .status-pill {
    display: inline-flex; align-items: center; gap: 6px;
    font-family: 'Nunito', sans-serif;
    font-size: 12px; font-weight: 800;
    padding: 5px 14px; border-radius: 30px;
    letter-spacing: 0.3px;
  }
  .pill-open   { background: var(--green-soft); color: #15803d; }
  .pill-soon   { background: var(--yellow-soft); color: #92400e; }
  .pill-closed { background: #f3f0ff; color: var(--text-mid); }
  .status-pill .dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: currentColor; animation: blink 1.4s infinite;
  }
  @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

  /* ── Products table ── */
  .section-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.5rem; border-bottom: 1px solid #f0eefc;
  }
  .section-title {
    font-family: 'Nunito', sans-serif; font-weight: 800;
    font-size: 15px; color: var(--text-dark);
    display: flex; align-items: center; gap: 8px;
  }

  .products-table { width: 100%; border-collapse: collapse; }
  .products-table thead tr { background: #f9f8ff; }
  .products-table th {
    padding: 10px 16px;
    font-size: 10px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.6px; color: var(--text-light);
    border-bottom: 1px solid #f0eefc; text-align: left;
  }
  .products-table td {
    padding: 14px 16px;
    border-bottom: 1px solid #f9f8ff;
    vertical-align: middle;
  }
  .products-table tbody tr:last-child td { border-bottom: none; }
  .products-table tbody tr { transition: background 0.15s; }
  .products-table tbody tr:hover td { background: #faf9ff; }

  .prod-name  { font-weight: 700; font-size: 13px; color: var(--text-dark); }
  .about-link {
    display: inline-flex; align-items: center; gap: 3px;
    font-size: 11px; font-weight: 700; color: var(--purple-mid); margin-top: 3px;
  }
  .about-link:hover { text-decoration: underline; }

  .price-tag {
    display: inline-flex; align-items: center; gap: 2px;
    font-family: 'Nunito', sans-serif;
    font-weight: 800; font-size: 14px; color: var(--text-dark);
  }
  .price-tag .currency { font-size: 11px; color: var(--text-light); font-weight: 700; }

  .btn-add-cart {
    font-family: 'Nunito', sans-serif; font-weight: 700; font-size: 12px;
    padding: 7px 18px; border-radius: 30px;
    background: linear-gradient(135deg, var(--purple-dark), var(--purple-light));
    color: #fff; border: none; cursor: pointer;
    transition: opacity 0.15s, transform 0.12s;
    box-shadow: 0 3px 10px rgba(74,31,168,0.22);
    white-space: nowrap;
  }
  .btn-add-cart:hover { opacity: 0.88; transform: translateY(-1px); }

  .registered-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--green-soft); color: #15803d;
    font-size: 12px; font-weight: 700;
    padding: 5px 12px; border-radius: 30px;
  }
  .cin-code {
    font-size: 10px; font-weight: 700; color: #15803d;
    margin-top: 3px; font-family: monospace;
  }

  /* ── Cart footer ── */
  .cart-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.5rem;
    background: #f9f8ff; border-top: 1px solid #f0eefc;
  }
  .cart-count-txt { font-size: 12px; color: var(--text-light); font-weight: 600; }

  .btn-buy-now {
    font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 14px;
    padding: 10px 24px; border-radius: 30px;
    background: linear-gradient(135deg, var(--purple-dark) 0%, var(--purple-mid) 100%);
    color: #fff; border: none; cursor: pointer;
    display: inline-flex; align-items: center; gap: 8px;
    transition: opacity 0.15s, transform 0.12s;
    box-shadow: var(--shadow-btn); position: relative;
  }
  .btn-buy-now:hover { opacity: 0.88; transform: translateY(-1px); }
  #cart-count {
    position: absolute; top: -8px; right: -8px;
    background: var(--orange); color: #fff;
    font-size: 10px; font-weight: 800;
    width: 20px; height: 20px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  }

  /* ── CIN result list (exam closed) ── */
  .cin-result { padding: 1.25rem 1.5rem; }
  .cin-result-title { font-size: 13px; font-weight: 700; color: var(--text-dark); margin-bottom: 10px; }
  .cin-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px; border-radius: 12px;
    background: #f9f8ff; margin-bottom: 6px;
  }
  .cin-pill {
    font-size: 11px; font-weight: 800; font-family: monospace;
    background: var(--green-soft); color: #15803d;
    padding: 3px 10px; border-radius: 6px;
  }
  .cin-prod-name { font-size: 13px; font-weight: 600; color: var(--text-dark); }

    
  /* ── Toaster ── */
  #toaster-container {
      margin-bottom: 12px;
    }
  .toaster {
    /*position: fixed; right: 24px; top: 24px; */
    z-index: 9999;
    background: linear-gradient(135deg, var(--purple-dark), var(--purple-mid));
    color: #fff; padding: 12px 20px; border-radius: 12px;
    font-size: 13px; font-weight: 700;
    box-shadow: 0 8px 30px rgba(74,31,168,0.3);
    display: none; align-items: center; gap: 8px;
  }

  /* ── Empty state ── */
  .empty-state {
    padding: 2.5rem 1.5rem; text-align: center;
    color: var(--text-light); font-size: 13px;
  }
  .empty-state .emoji { font-size: 36px; display: block; margin-bottom: 10px; }

  /* ══ MODAL ══ */
  .modal {
    display: none; position: fixed; z-index: 1050;
    left: 0; top: 0; width: 100%; height: 100%;
    overflow: auto; background: rgba(30,27,75,0.55);
    backdrop-filter: blur(4px);
  }
  .modal-content {
    background: #fff; margin: 5% auto; padding: 0;
    border-radius: 24px; width: 92%; max-width: 580px;
    box-shadow: 0 30px 80px rgba(74,31,168,0.22);
    overflow: hidden; animation: slideUp 0.25s ease;
  }
  @keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
  }
  .modal-header-bar {
    background: linear-gradient(135deg, var(--purple-dark), var(--purple-mid));
    padding: 1.1rem 1.5rem;
    display: flex; align-items: center; justify-content: space-between;
  }
  .modal-header-bar h5 {
    font-family: 'Nunito', sans-serif; font-weight: 800;
    font-size: 15px; color: #fff; margin: 0;
  }
  .close {
    color: rgba(255,255,255,0.8); font-size: 26px; font-weight: 300;
    cursor: pointer; background: none; border: none; line-height: 1;
    transition: color 0.15s;
  }
  .close:hover { color: #fff; }

  #cart-products { padding: 0 1.5rem; }
  #cart-products table { width: 100%; border-collapse: collapse; font-size: 13px; }
  #cart-products th {
    padding: 10px 0; text-align: left;
    font-size: 10px; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.6px; color: var(--text-light);
    border-bottom: 1px solid #f0eefc;
  }
  #cart-products td { padding: 12px 0; border-bottom: 1px solid #f9f8ff; vertical-align: middle; }
  #cart-products tr:last-child td { border-bottom: none; }

  .btn-remove-item {
    font-family: 'Nunito', sans-serif; font-weight: 700; font-size: 11px;
    padding: 5px 14px; border-radius: 30px;
    background: #fff0f0; color: #dc2626;
    border: 1px solid #fecaca; cursor: pointer; transition: background 0.15s;
  }
  .btn-remove-item:hover { background: #fee2e2; }

  .cart-total-bar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.5rem;
    background: #f9f8ff; border-top: 1px solid #f0eefc;
  }
  .cart-total-bar .label { font-size: 13px; font-weight: 700; color: var(--text-dark); }
  .cart-total-bar .amount {
    font-family: 'Nunito', sans-serif; font-weight: 900;
    font-size: 18px; color: var(--purple-dark);
  }

  .modal-pay-area { padding: 1rem 1.5rem 1.5rem; }

  /* Pay Now button */
  #checkout-button {
    width: 100%; font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 15px;
    padding: 13px; border-radius: 14px; border: none;
    background: linear-gradient(135deg, var(--purple-dark), var(--purple-mid));
    color: #fff; cursor: pointer; transition: opacity 0.15s;
    box-shadow: var(--shadow-btn); display: none;
  }
  #checkout-button:hover { opacity: 0.88; }

  /* Free register button */
  #payment-form-free .btn-free {
    width: 100%; font-family: 'Nunito', sans-serif; font-weight: 800; font-size: 15px;
    padding: 13px; border-radius: 14px; border: none;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: #fff; cursor: pointer; transition: opacity 0.15s;
    box-shadow: 0 4px 14px rgba(22,163,74,0.3); display: none;
  }
  #payment-form-free .btn-free:hover { opacity: 0.88; }

  /* ── Sibling modal ── */
  #id02 .modal-content { max-width: 620px; }
  #id02 form { padding: 1.25rem 1.5rem; }
  #id02 .form-label {
    font-size: 11px; font-weight: 800; color: var(--text-mid);
    text-transform: uppercase; letter-spacing: 0.5px;
  }
  #id02 .form-control, #id02 .form-select {
    border: 1.5px solid #e8e4ff; border-radius: 10px;
    font-size: 13px; font-family: 'Nunito Sans', sans-serif;
    padding: 9px 12px; transition: border-color 0.15s;
  }
  #id02 .form-control:focus, #id02 .form-select:focus {
    border-color: var(--purple-mid);
    box-shadow: 0 0 0 3px rgba(108,63,197,0.12);
  }
  .modal-footer-bar {
    padding: 1rem 1.5rem; background: #f9f8ff;
    border-top: 1px solid #f0eefc;
    display: flex; justify-content: flex-end;
  }
  .btn-exit-modal {
    font-family: 'Nunito', sans-serif; font-weight: 700; font-size: 13px;
    padding: 8px 20px; border-radius: 30px;
    background: #fff; color: #dc2626;
    border: 1.5px solid #fecaca; cursor: pointer; transition: background 0.15s;
  }
  .btn-exit-modal:hover { background: #fff0f0; }

  #child-products { padding: 0 1.5rem 1rem; }
  .alert { display: none; border-radius: 12px; font-size: 13px; font-weight: 600; }

  @media (max-width: 480px) {
    .btn-add-cart, .btn-buy-now { font-size: 12px; padding: 8px 16px; }
    .promo-title { font-size: 15px; }
    .promo-banner { padding: 1.25rem; }
  }
  .btn-add-cart.bg-success {
  background: #16a34a !important;   /* green */
  color: #fff !important;
  border-color: #16a34a !important;
  cursor: not-allowed;
  opacity: 1;
}
</style>

<!-- Alerts -->
<div style="max-width:1160px;margin:0.75rem auto;padding:0 1.25rem">
  <div class="alert alert-success" id="success-alert">✅ Successfully added!</div>
  <div class="alert alert-danger"  id="error-alert">❌ Product removed!</div>
</div>

<div class="dash-wrapper">

  <!-- ══ PROFILE SIDEBAR ══ -->
  <div class="card-m">
    <div class="profile-banner">
      <div class="profile-avatar">
        <img src="https://img.icons8.com/bubbles/100/000000/writer-female.png" alt="Student Photo">
      </div>
      <div class="profile-name"><?php echo strtoupper($name); ?></div>
      <?php
        $purchases_check = $this->db->get_where('product_purchase', array('prid' => $student->PRID))->row();
        if (!empty($purchases_check)):
      ?>
        <div class="profile-cin">CIN: <?php echo $purchases_check->cin; ?></div>
      <?php endif; ?>
    </div>

    <div class="profile-info">
      <div class="info-item">
        <div class="info-icon icon-purple">🎓</div>
        <div>
          <div class="info-label">Class</div>
          <div class="info-value"><?php echo $student->class; ?></div>
        </div>
      </div>
      <div class="info-item">
        <div class="info-icon icon-blue">✉️</div>
        <div>
          <div class="info-label">Email</div>
          <div class="info-value" style="font-size:12px;word-break:break-all"><?php echo $student->email; ?></div>
        </div>
      </div>
      <div class="info-item">
        <div class="info-icon icon-green">📱</div>
        <div>
          <div class="info-label">Mobile</div>
          <div class="info-value"><?php echo $student->mobile; ?></div>
        </div>
      </div>
      <?php
        $school = $this->db->get_where('school_new', array('id' => $student->school_id))->row();
      ?>
      <div class="info-item">
        <div class="info-icon" style="background:#fff3d6">🏫</div>
        <div>
          <div class="info-label">School</div>
          <div class="info-value"><?php echo $school->school_name; ?></div>
          <div class="info-sub"><?php echo $school->school_code; ?></div>
        </div>
      </div>
    </div>

    <form method="POST" style="display:block">
      <button class="btn-edit-profile" name="Edit" type="submit">✏️ Edit Profile</button>
    </form>
  </div>

  <!-- ══ RIGHT COLUMN ══ -->
  <div class="right-col">

    <?php
      $current_date = date('Y-m-d');
      $start_date   = $school_dates->start_date;
      $end_date     = $school_dates->end_date;

      if ($current_date < $start_date):
    ?>

      <!-- Opening soon -->
      <div class="promo-banner">
        <div class="promo-text">
          <div class="promo-title">⏳ Registration Opening Soon!</div>
          <div class="promo-sub">
            Exam window opens on <strong><?php echo $start_date; ?></strong> — stay tuned!
          </div>
        </div>
        <span class="status-pill pill-soon">⏳ Opening soon</span>
      </div>

    <?php elseif ($current_date > $end_date): ?>

      <!-- Exam closed -->
      <div class="promo-banner">
        <div class="promo-text">
          <div class="promo-title">✅ Registration Closed</div>
          <div class="promo-sub">
            Exam window was <strong><?php echo $start_date; ?></strong>
            <strong> To </strong><?php echo $end_date; ?>
          </div>
        </div>
        <span class="status-pill pill-closed">✓ Exam closed</span>
      </div>

      <div class="card-m">
        <div class="cin-result">
          <div class="cin-result-title">Your registered products:</div>
          <?php
            $purchases = $this->db->get_where('product_purchase', array('prid' => $student->PRID))->result();
            if (!empty($purchases)):
              foreach ($purchases as $row):
          ?>
            <div class="cin-item">
              <span class="cin-pill"><?php echo $row->cin; ?></span>
              <span class="cin-prod-name"><?php echo $row->product_name; ?></span>
            </div>
          <?php
              endforeach;
            else:
          ?>
            <div class="empty-state">
              <span class="emoji">📭</span>
              No products registered.
            </div>
          <?php endif; ?>
        </div>
      </div>

    <?php else: ?>

      <!-- ══ EXAM WINDOW OPEN ══ -->

      <!-- Promo banner -->
      <div class="promo-banner">
        <div class="promo-text">
          <div class="promo-title"> Registration Active Date</div>
          <div class="promo-sub">
            <strong><?php echo $start_date; ?></strong>
            &nbsp;To&nbsp;
            <strong><?php echo $end_date; ?></strong>
          </div>
        </div>
        <span class="status-pill pill-open"><span class="dot"></span> Registration open</span>
      </div>
      <!-- Toaster-->
      <div id="toaster-container"></div>

      <!-- Products table -->
      <div class="card-m">
        <div class="section-head">
          <span class="section-title"><span>🛍️</span> Available Products</span>
        </div>
        <?php if (!empty($product_list)): ?>
        <div class="table-responsive">
          <table class="products-table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th style="text-align:center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($product_list as $row):

                /* ── FIX: clean variable names to avoid collision with outer $row ── */
                $purchase = $this->db->get_where('product_purchase', array(
                  'product_name' => $row,
                  'prid'         => $student->PRID
                ))->row();

                $pro = $this->db->get_where('product_to_school', array('product_name' => $row))->row();

                $pre = '';
                if (!empty($pro) && !empty($pro->subject)) {
                  $lev = $this->db->get_where('competition_level_byproduct',
                           array('level_id' => $pro->level_id))->row();
                  $pre = ' ' . $pro->subject . '-Series-' . $pro->series . ' ' . $lev->level_name;
                }

                $price_row = $this->db->get_where('product_to_school', array(
                  'product_name' => $row,
                  'school_id'    => $student->school_id,
                  'period_id'    => $student->period_id
                ))->row();
              ?>
              <tr>
                <td>
                  <div class="prod-name"><?php echo $row . $pre; ?></div>
                  <?php if ($row == 'MaRRS Math Zoom Zoom Challenge'): ?>
                    <a href="https://www.marrs.in/mathzoomzoom.php" class="about-link" target="_blank">About product ↗</a>
                  <?php endif; ?>
                  <?php if ($row == 'MaRRS Word Chase'): ?>
                    <a href="https://www.marrs.in/marrswordchase.php" class="about-link" target="_blank">About product ↗</a>
                  <?php endif; ?>
                </td>

                <td>
                  <span class="price-tag">
                    <span class="currency">₹</span><?php echo $price_row->amount; ?>
                  </span>
                </td>

                <td style="text-align:center">
                  <?php
                    /* ── FIX: was "empty($price) && $price->student_name != $name"
                       which crashes when $price is NULL (empty returns true but
                       then tries to access property on null).
                       Correct logic: show Add button if NOT yet purchased. ── */
                    if (empty($purchase)):
                  ?>
                    <!--<button class="btn-add-cart product-button"-->
                    <!--  value="<?php //echo $price_row->amount.'+'.$row.'+'.$name.'+'.$student->class; ?>">-->
                    <!--  + Add to Cart-->
                    <!--</button>-->
                    <button class="btn-add-cart product-button"
                      data-product="<?php echo $row . $pre; ?>"
                      value="<?php echo $price_row->amount.'+'.$row.'+'.$name.'+'.$student->class; ?>">
                      + Add to Cart
                    </button>
                  <?php else: ?>
                    <div style="display:inline-flex;flex-direction:column;align-items:center;gap:4px">
                      <span class="registered-badge">✅ Registered</span>
                      <span class="cin-code"><?php echo $purchase->cin; ?></span>
                    </div>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Cart footer -->
        <div class="cart-footer">
          <span class="cart-count-txt" id="cart-label">0 items in cart</span>
          <button class="btn-buy-now" id="myBtn">
            🛒 Buy Now
            <span id="cart-count">0</span>
          </button>
        </div>

        <?php else: ?>
          <div class="empty-state">
            <span class="emoji">🏫</span>
            No products assigned to your school. Please contact your school administration.
          </div>
        <?php endif; ?>
      </div>

    <?php endif; ?>
  </div><!-- /right-col -->
</div><!-- /dash-wrapper -->


<!-- ══════════════════════════════════════
     MODAL 1 — Cart & Checkout
══════════════════════════════════════ -->
<div id="id01" class="modal">
  <div class="modal-content">
    <div class="modal-header-bar">
      <h5>🛒 Cart &amp; Checkout</h5>
      <button onclick="document.getElementById('id01').style.display='none'" class="close">&times;</button>
    </div>

    <!-- Cart rows injected here by JS -->
    <div id="cart-products"></div>

    <!-- Total bar -->
    <div class="cart-total-bar">
      <span class="label">Total Amount</span>
      <span class="amount">₹<span id="total-amount">0.00</span></span>
    </div>

    <div class="modal-pay-area">

      <!-- ── FIX: Pay Now button — amount injected by JS before submit ── -->
      <button type="button" id="checkout-button">💳 Pay Now</button>
      <!--<p>Will Back Soon !!</p>-->

      <!-- Razorpay paid form (hidden, submitted by JS) -->
      <form id="payment-form" method="POST" action="<?php echo base_url('Razorpay/pay3'); ?>">
        <input type="hidden" name="prid"    value="<?php echo $student->PRID; ?>">
        <input type="hidden" name="contact" value="<?php echo $student->mobile; ?>">
        <input type="hidden" name="email"   value="<?php echo $student->email; ?>">
        <!-- ── FIX: amount field populated dynamically by JS ── -->
        <input type="hidden" name="amount"  id="razorpay-amount" value="0">
      </form>

      <!-- Free registration form -->
      <form id="payment-form-free" method="POST" action="<?php echo base_url('Razorpay/success3_test_free'); ?>">
        <input type="hidden" name="prid"    value="<?php echo $student->PRID; ?>">
        <input type="hidden" name="contact" value="<?php echo $student->mobile; ?>">
        <input type="hidden" name="email"   value="<?php echo $student->email; ?>">
        <button type="button" class="btn-free"
          onclick="document.getElementById('payment-form-free').submit();">
          🎉 Register for Free
        </button>
      </form>

    </div>
  </div>
</div>


<!-- ══════════════════════════════════════
     MODAL 2 — Register Siblings
══════════════════════════════════════ -->
<div id="id02" class="modal">
  <div class="modal-content">
    <div class="modal-header-bar">
      <h5>👨‍👩‍👧 Add Products for Siblings</h5>
      <button onclick="document.getElementById('id02').style.display='none'" class="close">&times;</button>
    </div>

    <form method="POST">
      <div class="row mb-3" style="padding:1.25rem 1.5rem 0">
        <div class="col-6 mt-2">
          <label for="child_name" class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="child_name" placeholder="Enter name" name="name" required>
        </div>
        <div class="col-6 mt-2">
          <label for="child_class" class="form-label">Class <span class="text-danger">*</span></label>
          <select class="form-select" id="child_class" name="class" required>
            <option value="">-- select class --</option>
            <option value="Nursery">Nursery</option>
            <option value="LKG">LKG</option>
            <option value="UKG">UKG</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
              <option value="Class-<?php echo $i; ?>">Class-<?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
      <div id="child-products" style="margin-top:1rem"></div>
    </form>

    <div class="modal-footer-bar">
      <button onclick="document.getElementById('id02').style.display='none'" class="btn-exit-modal">
        ← Exit to Checkout
      </button>
    </div>
  </div>
</div>

<?php
  $purchased_names = $this->db->get_where('product_purchase', array('prid' => $student->PRID))->result();
  $purchased_list = array_map(function($p) { return $p->product_name; }, $purchased_names);
?>
<script>
  var purchasedProducts = <?php echo json_encode($purchased_list); ?>;
</script>
<!-- ══════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════ -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    // Load cart on page load and update UI
    loadCart(function () {
      syncCartButtons();
    });

  /* ══════════════════════════════
     SIBLING — class dropdown change
  ══════════════════════════════ */
  $('#child_class').change(function () {
    var class_name = this.value;
    if (!class_name) return;
    $.ajax({
      url:  '<?php echo base_url('/welcome/class_product'); ?>',
      type: 'POST',
      data: { class_name: class_name },
      success: function (r) {
        try { childCartData(JSON.parse(r)); }
        catch(e) { console.error('Parse error', e); }
      }
    });
  });

  function childCartData(cartData) {
    var div = document.getElementById('child-products');
    if (cartData.length === 0) {
      div.innerHTML = '<p style="font-size:13px;color:#7c7aab;padding:1rem 1.5rem">No product assigned to this class. Contact school.</p>';
      return;
    }
    var html = '<div class="table-responsive" style="padding:0 1.5rem">'
      + '<table class="products-table"><thead>'
      + '<tr><th>Product</th><th>Amount</th><th>Action</th></tr>'
      + '</thead><tbody>';

    cartData.forEach(function (p) {
      html += '<tr>'
        + '<td class="prod-name">' + p.product_name + '</td>'
        + '<td><span class="price-tag"><span class="currency">₹</span>' + p.amount + '</span></td>'
        + '<td><button class="btn-add-cart product-button-child"'
        + ' data-amount="'       + p.amount       + '"'
        + ' data-product-name="' + p.product_name + '">'
        + '+ Add</button></td>'
        + '</tr>';
    });
    html += '</tbody></table></div>';
    div.innerHTML = html;

    /* bind click after render */
    $('#child-products .product-button-child').on('click', function (e) {
      e.preventDefault();
      var childName  = $('#child_name').val().trim();
      var childClass = $('#child_class').val();
      if (!childName) { alert('Please enter child name.'); return; }

      var v = $(this).data('amount') + '+'
            + $(this).data('product-name') + '+'
            + childName + '+' + childClass;

      $.ajax({
        url:  '<?php echo base_url('/welcome/add_rem'); ?>',
        type: 'POST',
        data: { value: v },
        success: function (r) {
          if (r) {
            var count = parseInt(r.trim()) || 0;
            $('#cart-count').text(count);
            updateCartLabel(count);
            showToaster('✅ Product added! Click Buy Now.');
          } else {
            alert('No response from server.');
          }
        },
        error: function (x, s, e) { console.error('AJAX Error:', s, e); }
      });
    });
  }
    function syncCartButtons() {
      $.ajax({
        url: '<?php echo base_url('/welcome/get_cart'); ?>',
        type: 'GET',
        success: function (r) {
          try {
            var cartData = JSON.parse(r);
    
            if (!cartData || cartData.length === 0) return;
    
            cartData.forEach(function (item) {
              // match product name
              var btn = $('.product-button[data-product="' + item.product + '"]');
    
              if (btn.length) {
                btn.html('<i class="fa-solid fa-circle-check"></i> Added to Cart');
                btn.addClass('bg-success');
                btn.prop('disabled', true);
              }
            });
    
          } catch (e) {
            console.error('Cart sync error', e);
          }
        }
      });
    }
  /* ══════════════════════════════
     MAIN PRODUCTS — Add to cart
  ══════════════════════════════ */
//   $(document).on('click', '.product-button', function () {
//     var value = $(this).val();
//     $.ajax({
//       url:  '<?php //echo base_url('/welcome/add_rem'); ?>',
//       type: 'POST',
//       data: { value: value },
//       success: function (r) {
//         var count = parseInt(r.trim()) || 0;
//         $('#cart-count').text(count);
//         updateCartLabel(count);
//         showToaster('✅ Product added! Click Buy Now.');
//       },
//       error: function (x, s, e) { console.error('AJAX Error:', s, e); }
//     });
//   });
$(document).on('click', '.product-button', function () {
  var btn = $(this);
  var value = btn.val();

  $.ajax({
    url:  '<?php echo base_url('/welcome/add_rem'); ?>',
    type: 'POST',
    data: { value: value },
    success: function (r) {
      var count = parseInt(r.trim()) || 0;

      $('#cart-count').text(count);
      updateCartLabel(count);

      // ✅ IMPORTANT FIX
      btn.html('<i class="fa-solid fa-circle-check"></i> Added to Cart');
      btn.addClass('bg-success');
      btn.prop('disabled', true);

      showToaster('Product added! Click Buy Now.');
    }
  });
});
  /* ══════════════════════════════
     BUY NOW — open cart modal
  ══════════════════════════════ */
  $('#myBtn').on('click', function () {
    loadCart(function () {
      document.getElementById('id01').style.display = 'block';
    });
  });

  /* close modal on outside click */
  window.addEventListener('click', function (e) {
    if (e.target === document.getElementById('id01')) {
      document.getElementById('id01').style.display = 'none';
    }
    if (e.target === document.getElementById('id02')) {
      document.getElementById('id02').style.display = 'none';
    }
  });

  /* ══════════════════════════════
     LOAD CART from server
  ══════════════════════════════ */
//   function loadCart(callback) {
//     $.ajax({
//       url:  '<?php //echo base_url('/welcome/get_cart'); ?>',
//       type: 'GET',
//       success: function (r) {
//         try {
//           displayCartData(JSON.parse(r));
//           if (typeof callback === 'function') callback();
//         } catch(e) { console.error('Cart parse error', e); }
//       },
//       error: function (x, s, e) { console.error('AJAX Error:', s, e); }
//     });
//   }
function loadCart(callback) {
  $.ajax({
    url:  '<?php echo base_url('/welcome/get_cart'); ?>',
    type: 'GET',
    success: function (r) {
      try {
        var cartData = JSON.parse(r);
        var filtered = cartData.filter(function (p) {
          return purchasedProducts.indexOf(p.product) === -1;
        });
        $('#cart-count').text(filtered.length);
        updateCartLabel(filtered.length);

        displayCartData(cartData); // displayCartData does its own filtering too
        if (typeof callback === 'function') callback();
      } catch(e) { console.error('Cart parse error', e); }
    },
    error: function (x, s, e) { console.error('AJAX Error:', s, e); }
  });
}
  /* ══════════════════════════════
     DISPLAY CART in modal
  ══════════════════════════════ */
  function displayCartData(cartData) {
    var div = document.getElementById('cart-products');
    var totalAmount = 0;
    div.innerHTML = '';
    // ✅ NEW: remove already-purchased items from cart display
      cartData = cartData.filter(function (p) {
        return purchasedProducts.indexOf(p.product) === -1;
      });
    if (!cartData || cartData.length === 0) {
      div.innerHTML = '<div style="font-size:13px;color:#7c7aab;padding:1.5rem;text-align:center">🛒 Your cart is empty.</div>';
      /* hide both pay buttons */
      $('#checkout-button').hide();
      $('#payment-form-free .btn-free').hide();
      $('#total-amount').text('0.00');
      return;
    }

    var html = '<table><thead>'
      + '<tr><th>Name</th><th>Product</th><th>Price</th><th></th></tr>'
      + '</thead><tbody>';

    cartData.forEach(function (p) {
      html += '<tr>'
        + '<td style="font-weight:700;font-size:13px;color:#1e1b4b">' + p.name + '</td>'
        + '<td style="font-size:12px;color:#4c4980">'                 + p.product + '</td>'
        + '<td><span class="price-tag"><span class="currency">₹</span>' + p.amount + '</span></td>'
        + '<td><button class="btn-remove-item product-button-remove" data-item-id="' + p.id + '">Remove</button></td>'
        + '</tr>';
      totalAmount += parseFloat(p.amount) || 0;
    });

    html += '</tbody></table>';
    div.innerHTML = html;

    var totalStr = totalAmount.toFixed(2);
    $('#total-amount').text(totalStr);

    /* ── FIX: inject amount into Razorpay hidden field ── */
    $('#razorpay-amount').val(totalStr);

    /*
     * ── PAYMENT ROUTING ──
     * totalAmount > 0  →  show "Pay Now"  (Razorpay)
     * totalAmount == 0 →  show "Register for Free"
     */
    if (totalAmount > 0) {
      $('#checkout-button').show();
      $('#payment-form-free .btn-free').hide();
    } else {
      $('#checkout-button').hide();
      $('#payment-form-free .btn-free').show();
    }
  }
    function revertCartButton(productName) {
      $('.product-button').each(function () {
        var btn = $(this);
        var btnProduct = btn.data('product');
    
        if (btnProduct && btnProduct.trim() === productName.trim()) {
          btn.text('+ Add to Cart');
          btn.prop('disabled', false);
          btn.removeClass('bg-success');  // if you added custom class
        }
      });
    }
  /* ══════════════════════════════
     PAY NOW — submit Razorpay form
     FIX: amount already in hidden field; just submit
  ══════════════════════════════ */
  $('#checkout-button').on('click', function () {
    var amount = parseFloat($('#total-amount').text());
    if (!amount || amount <= 0) {
      alert('Cart total is zero. Cannot proceed to payment.');
      return;
    }
    /* ensure hidden field is up-to-date */
    $('#razorpay-amount').val(amount.toFixed(2));
    $('#payment-form').submit();
  });

  /* ══════════════════════════════
     REMOVE item from cart
  ══════════════════════════════ */
//   $(document).on('click', '.product-button-remove', function (e) {
//     e.preventDefault();
//     var itemId = $(this).data('item-id');
//     $.ajax({
//       url:  '<?php //echo base_url('/welcome/add_rem_pro'); ?>',
//       type: 'POST',
//       data: { value: itemId },
//       success: function (r) {
//         var count = parseInt(r.trim()) || 0;
//         $('#cart-count').text(count);
//         updateCartLabel(count);
//         showToaster('🗑️ Product removed.');
//         /* reload cart; close modal if empty */
//         loadCart(function () {
//           if (count === 0) document.getElementById('id01').style.display = 'none';
//         });
//       },
//       error: function (x, s, e) { console.error('AJAX Error:', s, e); }
//     });
//   });
    $(document).on('click', '.product-button-remove', function (e) {
      e.preventDefault();
    
      var itemId = $(this).data('item-id');
      var row = $(this).closest('tr');
    
      // ✅ Get product name BEFORE removing
      var productName = row.find('td:nth-child(2)').text().trim();
    
      $.ajax({
        url:  '<?php echo base_url('/welcome/add_rem_pro'); ?>',
        type: 'POST',
        data: { value: itemId },
        success: function (r) {
          var count = parseInt(r.trim()) || 0;
    
          $('#cart-count').text(count);
          updateCartLabel(count);
          showToaster('🗑️ Product removed.');
    
          // ✅ IMPORTANT: revert button
          revertCartButton(productName);
    
          // reload cart
          loadCart(function () {
            if (count === 0) {
              document.getElementById('id01').style.display = 'none';
            }
          });
        }
      });
    });
  /* ══════════════════════════════
     HELPERS
  ══════════════════════════════ */
  function updateCartLabel(n) {
    n = n || 0;
    $('#cart-label').text(n + ' item' + (n !== 1 ? 's' : '') + ' in cart');
  }

//   function showToaster(message) {
//     var t = $('<div class="toaster" style="display:flex">' + message + '</div>');
//     $('body').append(t);
//     t.delay(3000).fadeOut(400, function () { $(this).remove(); });
//   }
    function showToaster(message) {
      var t = $('<div class="toaster">' + message + '</div>');
    
      // ✅ append inside container instead of body
      $('#toaster-container').append(t);
    
      t.fadeIn(200);
    
      setTimeout(function () {
        t.fadeOut(400, function () {
          $(this).remove();
        });
      }, 3000);
    }
    });
</script>

<?php include('footer.php'); ?>