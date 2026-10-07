<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lunar – Select Products</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
    background: radial-gradient(ellipse 60% 40% at 10% 10%, rgba(232,83,26,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 50% at 90% 90%, rgba(26,62,138,0.06) 0%, transparent 60%);
    pointer-events: none;
  }

  .container { max-width: 1000px; margin: 0 auto; }

  header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 2.0rem;
  }

  .logo {
    font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--ink);
  }
  .logo span { color: var(--accent); }

  .cart-btn {
    display: flex; align-items: center; gap: 8px;
    background: var(--ink); color: #fff;
    border: none; border-radius: 10px; padding: 10px 20px;
    font-family: 'Syne', sans-serif; font-size: 0.85rem; font-weight: 700;
    cursor: pointer; text-decoration: none; transition: background 0.2s;
  }
  .cart-btn:hover { background: var(--accent); }
  .cart-count {
    background: var(--accent); color: #fff; border-radius: 50%;
    width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 700;
  }

  .steps { display: flex; gap: 6px; margin-bottom: 2rem; }
  .step { height: 4px; flex: 1; border-radius: 10px; background: var(--border); }
  .step.done { background: var(--success); }
  .step.active { background: #5084c4; }

  h1 { font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800; color: var(--ink); margin-bottom: 0.3rem; }
  .subtitle { color: var(--muted); font-size: 0.9rem; margin-bottom: 2rem; }

  .filter-bar {
    background: var(--card); border: 1px solid var(--border); border-radius: 14px;
    padding: 1.5rem; margin-bottom: 1.5rem;
    display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;
  }

  .filter-group label {
    display: block; font-size: 0.75rem; font-weight: 500; letter-spacing: 0.06em;
    text-transform: uppercase; color: var(--muted); margin-bottom: 6px;
  }

  select {
    width: 100%; padding: 10px 14px; border: 1.5px solid var(--border); border-radius: 8px;
    font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--ink);
    background: var(--paper); outline: none; cursor: pointer;
    transition: border-color 0.2s;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238a8278' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;
  }
  select:focus { border-color: var(--accent); }

  .schedule-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.2rem;
  }

  .schedule-card {
    background: var(--card); border: 1.5px solid var(--border); border-radius: 16px;
    padding: 1.5rem; transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    position: relative; overflow: hidden;
  }
  .schedule-card:hover { border-color: var(--accent); box-shadow: 0 4px 20px rgba(232,83,26,0.1); transform: translateY(-2px); }
  .schedule-card.in-cart { border-color: var(--success); background: #f4fbf7; }

  .card-badge {
    position: absolute; top: 14px; right: 14px;
    background: var(--accent2); color: #fff; border-radius: 6px;
    font-family: 'Syne', sans-serif; font-size: 0.7rem; font-weight: 700;
    padding: 3px 8px; letter-spacing: 0.06em;
  }

  .card-series { font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 700; color: var(--ink); margin-bottom: 4px; }
  .card-subject { font-size: 0.85rem; color: var(--muted); margin-bottom: 1rem; }

  .card-meta { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 1.2rem; }
  .chip {
    background: var(--paper); border: 1px solid var(--border); border-radius: 100px;
    font-size: 0.75rem; color: var(--ink); padding: 3px 10px;
  }

  .card-price { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--ink); margin-bottom: 1rem; }
  .card-price span { font-size: 0.85rem; font-weight: 400; color: var(--muted); }

  .add-btn {
    width: 100%; padding: 11px; background: var(--ink); color: #fff;
    border: none; border-radius: 8px; font-family: 'Syne', sans-serif;
    font-size: 0.85rem; font-weight: 700; cursor: pointer; transition: background 0.2s;
  }
  .add-btn:hover { background: var(--accent); }
  .add-btn.in-cart { background: var(--success); cursor: default; }

  .empty-state {
    text-align: center; padding: 4rem 2rem; color: var(--muted);
    grid-column: 1/-1;
  }
  .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; }

  .alert {
    padding: 12px 16px; border-radius: 10px; font-size: 0.88rem;
    margin-bottom: 1rem; display: none;
  }
  .alert.error   { background: #fdf0ef; color: var(--error); border: 1px solid #f5c6c3; }
  .alert.success { background: #edf7f2; color: var(--success); border: 1px solid #b8e6cc; }
  .alert.show    { display: block; }
</style>
</head>
<body>
<div class="container">

  <header>
    <div class="logo"> <span><img src="https://marrs.in/images/Lunar_logo.png" width="100"></span></div>
    <a href="<?= site_url('Lunar/cart') ?>" class="cart-btn">
      🛒 Cart <span class="cart-count" id="cart-count">0</span>
    </a>
  </header>

  <div class="steps">
    <div class="step done"></div>
    <div class="step active"></div>
    <div class="step"></div>
    <div class="step"></div>
  </div>

  <h1>Select Products</h1>
  <p class="subtitle">Hi <?= htmlspecialchars($name) ?> (<?= htmlspecialchars($email) ?>), choose your Lunar exam packages below.</p>

  <div id="alert" class="alert"></div>

  <div class="filter-bar">
    <div class="filter-group">
      <label>Class</label>
      <select id="filter-class" onchange="filterSchedules()">
        <option value="">All Classes</option>
        <?php for($c=1; $c<=12; $c++): ?>
        <option value="<?=$c?>"><?=$c?></option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="filter-group">
      <label>Subject</label>
      <select id="filter-subject" onchange="filterSchedules()">
        <option value="">All Subjects</option>
        <?php
          $subjects = array_unique(array_column($schedules, 'subject'));
          foreach($subjects as $s): ?>
          <option value="<?= htmlspecialchars($s) ?>"><?= htmlspecialchars($s) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="filter-group">
      <label>Type</label>
      <select id="filter-type" onchange="filterSchedules()">
        <option value="">All Types</option>
        <?php
          $types = array_unique(array_column($schedules, 'type'));
          foreach($types as $t): ?>
          <option value="<?= htmlspecialchars($t) ?>"><?= htmlspecialchars($t) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="schedule-grid" id="schedule-grid">
    <?php if(empty($schedules)): ?>
      <div class="empty-state">
        <div class="icon">📭</div>
        <p>No schedules available at this time.</p>
      </div>
    <?php else: ?>
      <?php foreach($schedules as $s): ?>
      <div class="schedule-card"
           data-id="<?= $s->lunar_schedule_id ?>"
           data-series="<?= htmlspecialchars($s->series) ?>"
           data-subject="<?= htmlspecialchars($s->subject) ?>"
           data-type="<?= htmlspecialchars($s->type) ?>">
        <div class="card-badge"><?= htmlspecialchars($s->series) ?></div>
        <div class="card-series"><?= htmlspecialchars($s->series) ?> Series</div>
        <div class="card-subject"><?= htmlspecialchars($s->subject) ?></div>
        <div class="card-meta">
          <span class="chip">Level <?= htmlspecialchars($s->level_id) ?></span>
          <span class="chip"><?= htmlspecialchars($s->type) ?></span>
        </div>
        <div class="card-price">₹<?= number_format($s->price_amount, 0) ?> <span>/ exam</span></div>
        <button class="add-btn" onclick="addToCart(<?= $s->lunar_schedule_id ?>, this)">
          + Add to Cart
        </button>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</div>

<script>
const BASE = '<?= base_url() ?>';
let cartIds = new Set();

function showAlert(msg, type) {
  const el = document.getElementById('alert');
  el.textContent = msg; el.className = 'alert ' + type + ' show';
  setTimeout(() => el.className = 'alert', 3000);
}

function addToCart(scheduleId) {
    fetch(BASE + 'Lunar/add_to_cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'lunar_schedule_id=' + scheduleId
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // Update cart count badge in UI
            document.getElementById('cart-count').innerText = data.cart_count;
            alert('Added to cart!');
        } else {
            alert(data.message); // "Already in cart." or "Invalid schedule."
        }
    })
    .catch(err => {
        console.error('Cart error:', err);
        alert('Something went wrong. Please try again.');
    });
}

function filterSchedules() {
  const cls     = document.getElementById('filter-class').value.toLowerCase();
  const subject = document.getElementById('filter-subject').value.toLowerCase();
  const type    = document.getElementById('filter-type').value.toLowerCase();

  document.querySelectorAll('.schedule-card').forEach(card => {
    const cSeries  = card.dataset.series.toLowerCase();
    const cSubject = card.dataset.subject.toLowerCase();
    const cType    = card.dataset.type.toLowerCase();

    const match =
      (!subject || cSubject === subject) &&
      (!type    || cType === type);

    card.style.display = match ? '' : 'none';
  });
}
</script>
</body>
</html>
