<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lunar – Registration Complete</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --ink: #0d1117; --paper: #f7f3ed; --accent: #e8531a; --accent2: #1a3e8a;
    --muted: #8a8278; --card: #ffffff; --border: #e2ddd7;
    --success: #1a7a4a; --error: #c0392b;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'DM Sans', sans-serif; background: var(--paper); min-height: 100vh; padding: 2rem; display: grid; place-items: center; }
  body::before {
    content: ''; position: fixed; inset: 0;
    background:
      radial-gradient(ellipse 60% 50% at 50% 0%, rgba(26,122,74,0.1) 0%, transparent 60%),
      radial-gradient(ellipse 40% 40% at 90% 90%, rgba(232,83,26,0.06) 0%, transparent 60%);
    pointer-events: none;
  }

  .container { max-width: 600px; width: 100%; }

  .check-circle {
    width: 72px; height: 72px; background: var(--success); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; margin: 0 auto 1.5rem;
    animation: pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
  }
  @keyframes pop { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }

  h1 { font-family: 'Syne', sans-serif; font-size: 2rem; font-weight: 800; color: var(--ink); text-align: center; margin-bottom: 0.5rem; }
  .subtitle { text-align: center; color: var(--muted); margin-bottom: 2rem; line-height: 1.6; }

  .steps { display: flex; gap: 6px; margin-bottom: 2.5rem; }
  .step { height: 4px; flex: 1; border-radius: 10px; background: var(--success); }

  .cin-card {
    background: var(--card); border: 1.5px solid var(--border); border-radius: 16px;
    margin-bottom: 1rem; overflow: hidden;
    animation: slideUp 0.4s ease forwards;
    animation-delay: calc(var(--i) * 0.1s); opacity: 0;
  }
  @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

  .cin-header {
    background: linear-gradient(135deg, var(--accent2), #2a5dd4);
    padding: 1rem 1.5rem; color: #fff;
    display: flex; justify-content: space-between; align-items: center;
  }
  .cin-subject { font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; }
  .cin-series  { font-size: 0.8rem; opacity: 0.8; }

  .cin-body { padding: 1.5rem; }

  .cin-number {
    font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800;
    color: var(--ink); letter-spacing: 0.08em; margin-bottom: 0.5rem;
    background: var(--paper); border: 1.5px dashed var(--border);
    border-radius: 10px; padding: 12px 16px; text-align: center;
    cursor: pointer; transition: background 0.2s;
    position: relative;
  }
  .cin-number:hover { background: #ede9e2; }

  .copy-hint { font-size: 0.72rem; color: var(--muted); text-align: center; margin-bottom: 1rem; }

  .cin-meta { display: flex; gap: 8px; flex-wrap: wrap; }
  .chip {
    background: var(--paper); border: 1px solid var(--border); border-radius: 100px;
    font-size: 0.75rem; color: var(--muted); padding: 4px 12px;
  }

  .prid-row { font-size: 0.8rem; color: var(--muted); margin-top: 8px; }
  .prid-row strong { color: var(--ink); font-family: monospace; font-size: 0.85rem; }

  .actions { display: flex; gap: 10px; margin-top: 2rem; }
  .btn {
    flex: 1; padding: 14px; border-radius: 10px; text-align: center;
    font-family: 'Syne', sans-serif; font-size: 0.9rem; font-weight: 700;
    cursor: pointer; text-decoration: none; border: none; transition: all 0.2s;
  }
  .btn-primary { background: var(--ink); color: #fff; }
  .btn-primary:hover { background: var(--accent); }
  .btn-outline { background: transparent; color: var(--ink); border: 1.5px solid var(--border); }
  .btn-outline:hover { border-color: var(--ink); }

  .toast {
    position: fixed; bottom: 2rem; left: 50%; transform: translateX(-50%) translateY(100px);
    background: var(--ink); color: #fff; padding: 12px 24px; border-radius: 100px;
    font-size: 0.88rem; font-weight: 500; transition: transform 0.3s;
    z-index: 999;
  }
  .toast.show { transform: translateX(-50%) translateY(0); }

  .email-note {
    background: #edf7f2; border: 1px solid #b8e6cc; border-radius: 10px;
    padding: 12px 16px; font-size: 0.85rem; color: var(--success);
    margin-bottom: 1.5rem; text-align: center;
  }
</style>
</head>
<body>
<div class="container">

  <div class="steps">
    <div class="step"></div><div class="step"></div><div class="step"></div><div class="step"></div>
  </div>

  <div class="check-circle">✓</div>
  <h1>You're Registered!</h1>
  <p class="subtitle">
    Congratulations <strong><?= htmlspecialchars($name) ?></strong>!<br>
    Your Lunar exam registration is complete.
  </p>

  <div class="email-note">
    📧 Your CIN(s) have been sent to <strong><?= htmlspecialchars($email) ?></strong>
  </div>

  <?php foreach($cins as $i => $c): ?>
  <div class="cin-card" style="--i:<?=$i?>">
    <div class="cin-header">
      <div>
        <div class="cin-subject"><?= htmlspecialchars($c['subject']) ?></div>
        <div class="cin-series"><?= htmlspecialchars($c['series']) ?> Series &bull; ₹<?= number_format($c['amount'], 0) ?></div>
      </div>
      <div style="font-size:1.5rem">🎓</div>
    </div>
    <div class="cin-body">
      <div class="cin-number" onclick="copyCIN('<?= $c['cin'] ?>')" title="Click to copy">
        <?= htmlspecialchars($c['cin']) ?>
      </div>
      <p class="copy-hint">👆 Click to copy your CIN</p>
      <div class="cin-meta">
        <span class="chip">CIN: <?= htmlspecialchars($c['cin']) ?></span>
      </div>
      <div class="prid-row">PRID: <strong><?= htmlspecialchars($c['prid']) ?></strong></div>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="actions">
    <a href="<?= site_url('Cin_login/index') ?>" class="btn btn-primary">→ Go to Login</a>
    <button class="btn btn-outline" onclick="window.print()">🖨 Print</button>
  </div>

</div>

<div class="toast" id="toast">Copied to clipboard!</div>

<script>
function copyCIN(cin) {
  navigator.clipboard.writeText(cin).then(() => {
    const toast = document.getElementById('toast');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2500);
  });
}
</script>
</body>
</html>
