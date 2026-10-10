<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Webhook &amp; Split Monitor (last 24h)</title>
<style>
:root{
    --bg:#f4f6fb; --card:#fff; --text:#1f2937; --muted:#6b7280;
    --line:#e5e7eb; --primary:#2f6bf0; --ok:#2f7d4f; --danger:#d9434f; --warn:#b45309;
}
@media (prefers-color-scheme:dark){
    :root{ --bg:#0f1420; --card:#171d2b; --text:#e5e7eb; --muted:#9ca3af; --line:#2a3345; }
}
*,*:before,*:after{ box-sizing:border-box; }
body{ margin:0; background:var(--bg); color:var(--text); font:14px/1.5 -apple-system,Segoe UI,Roboto,Arial,sans-serif; }
header{ display:flex; flex-wrap:wrap; gap:10px; align-items:center; justify-content:space-between; padding:14px 18px; background:var(--card); border-bottom:1px solid var(--line); position:sticky; top:0; z-index:5; }
header h1{ margin:0; font-size:18px; }
header .meta{ color:var(--muted); font-size:12px; }
button{ background:var(--primary); color:#fff; border:0; border-radius:8px; padding:8px 14px; cursor:pointer; font-size:13px; }
button.ghost{ background:transparent; color:var(--primary); border:1px solid var(--primary); }
main{ padding:16px; max-width:1500px; margin:0 auto; }
.cards{ display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:10px; margin-bottom:16px; }
.card{ background:var(--card); border:1px solid var(--line); border-radius:10px; padding:12px 14px; }
.card .v{ font-size:22px; font-weight:700; }
.card .l{ color:var(--muted); font-size:11px; text-transform:uppercase; letter-spacing:.04em; }
.card.ok .v{ color:var(--ok); } .card.bad .v{ color:var(--danger); } .card.warn .v{ color:var(--warn); }
section{ background:var(--card); border:1px solid var(--line); border-radius:10px; margin-bottom:14px; overflow:hidden; }
section>summary{ padding:12px 14px; cursor:pointer; font-weight:600; list-style:none; display:flex; justify-content:space-between; align-items:center; }
section>summary::-webkit-details-marker{ display:none; }
section>summary:after{ content:'▾'; color:var(--muted); }
section:not([open])>summary:after{ content:'▸'; }
.badge{ background:var(--line); color:var(--text); border-radius:999px; padding:2px 10px; font-size:12px; font-weight:500; }
.badge.bad{ background:rgba(217,67,79,.15); color:var(--danger); }
.badge.ok{ background:rgba(47,125,79,.15); color:var(--ok); }
.badge.warn{ background:rgba(180,83,9,.15); color:var(--warn); }
.tablewrap{ overflow-x:auto; }
table{ border-collapse:collapse; width:100%; font-size:12.5px; }
th,td{ border-top:1px solid var(--line); padding:7px 10px; text-align:left; white-space:nowrap; }
th{ color:var(--muted); font-weight:600; position:sticky; top:0; background:var(--card); }
td.wrap{ white-space:normal; min-width:320px; font-family:ui-monospace,Menlo,Consolas,monospace; font-size:11.5px; }
tr.row-bad td{ background:rgba(217,67,79,.07); }
tr.row-warn td{ background:rgba(180,83,9,.07); }
.empty{ padding:16px; color:var(--muted); }
.keys{ display:flex; gap:24px; padding:6px 14px 14px; flex-wrap:wrap; }
.keys b{ font-family:ui-monospace,Menlo,Consolas,monospace; }
</style>
</head>
<body>
<header>
    <div>
        <h1>Webhook &amp; Split Monitor <span class="badge">last 24 hours</span></h1>
        <div class="meta">logged in: <?php echo htmlspecialchars($account->username ?? ($account->email ?? 'dashboard')); ?> · auto-refresh 30s</div>
    </div>
    <div class="meta" id="generated_at">loading…</div>
    <div>
        <button onclick="load()">Refresh</button>
        <button class="ghost" onclick="document.body.dataset.theme=document.body.dataset.theme==='light'?'dark':'light'">Theme</button>
    </div>
</header>
<main>
    <div class="cards" id="cards"></div>

    <details open>
        <summary>Errors &amp; webhook setup problems <span class="badge" id="err-badge">…</span></summary>
        <div id="errors"></div>
    </details>

    <details open>
        <summary>Webhook calls (webhook_calls) <span class="badge" id="wc-badge">…</span></summary>
        <div class="tablewrap"><table id="wc-table"></table></div>
    </details>

    <details>
        <summary>Split records — payment_split_prid <span class="badge" id="sp-badge">…</span></summary>
        <div class="tablewrap"><table id="sp-table"></table></div>
    </details>

    <details>
        <summary>Split records — payment_split <span class="badge" id="s-badge">…</span></summary>
        <div class="tablewrap"><table id="s-table"></table></div>
    </details>

    <details open>
        <summary>Maker splits (makers_splits) <span class="badge" id="mk-badge">…</span></summary>
        <div class="tablewrap"><table id="mk-table"></table></div>
    </details>

    <details>
        <summary>Razorpay keys (from credentials table) <span class="badge" id="keys-badge">…</span></summary>
        <div class="keys" id="keys"></div>
    </details>
</main>
<script>
var BASE = <?php echo json_encode(rtrim(base_url(), '/').'/index.php/splitmonitor'); ?>;

function esc(v){
    if (v === null || v === undefined) return '';
    return String(v).replace(/[&<>"']/g, function(c){
        return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
    });
}
function table(elId, cols, rows, rowClass){
    var t = document.getElementById(elId);
    if (!rows || !rows.length){ t.innerHTML = '<tr><td class="empty">no rows in last 24h</td></tr>'; return; }
    var h = '<tr>' + cols.map(function(c){ return '<th>'+esc(c.l)+'</th>'; }).join('') + '</tr>';
    h += rows.map(function(r){
        var cls = rowClass ? rowClass(r) : '';
        return '<tr'+(cls?' class="'+cls+'"':'')+'>' + cols.map(function(c){
            return '<td'+(c.wrap?' class="wrap"':'')+'>'+esc(c.f(r))+'</td>';
        }).join('') + '</tr>';
    }).join('');
    t.innerHTML = h;
}
function errBlock(title, kind, list){
    if (!list || !list.length) return '';
    var h = '<div style="padding:0 14px 10px"><div style="margin:8px 0 4px;font-weight:600">'+esc(title)+' <span class="badge bad">'+list.length+'</span></div><table><tr><th>time</th><th>'+(kind?'type':'')+'</th><th>line</th></tr>';
    h += list.map(function(e){
        return '<tr><td>'+esc(e.ts)+'</td><td>'+(kind?esc(e.kind):'')+'</td><td class="wrap">'+esc(e.line)+'</td></tr>';
    }).join('');
    return h + '</table></div>';
}
function card(v, l, cls){ return '<div class="card '+(cls||'')+'"><div class="v">'+esc(v)+'</div><div class="l">'+esc(l)+'</div></div>'; }

function render(d){
    var s = d.summary;
    document.getElementById('generated_at').textContent = 'generated ' + d.generated_at;
    document.getElementById('cards').innerHTML =
        card(s.deliveries, 'webhook deliveries') +
        card(s.verified, 'signatures verified', 'ok') +
        card(s.invalid_signature, 'invalid signature', s.invalid_signature?'bad':'') +
        card(s.no_signature, 'missing signature hdr', s.no_signature?'bad':'') +
        card(s.on_hold_errors, 'on_hold rejections (legacy)', s.on_hold_errors?'bad':'') +
        card(s.delegate_failed, 'delegate failures', s.delegate_failed?'bad':'') +
        card(s.splitpay_errors, 'splitpay errors', s.splitpay_errors?'bad':'') +
        card(s.php_errors, 'PHP errors', s.php_errors?'bad':'') +
        card(s.wc_pending, 'orders pending', s.wc_pending?'warn':'') +
        card(s.wc_processing, 'orders processing', s.wc_processing?'warn':'') +
        card(s.wc_done, 'orders done', 'ok') +
        card(s.splits_prid, 'split_prid rows') +
        card(s.splits, 'payment_split rows') +
        card(s.makers_paid, 'makers paid', 'ok') +
        card(s.makers_unpaid, 'makers UNPAID', s.makers_unpaid?'bad':'');

    var totalErr = s.splitpay_errors + s.invalid_signature + s.no_signature + s.delegate_failed + s.on_hold_errors + s.php_errors;
    document.getElementById('err-badge').textContent = totalErr + ' errors';
    document.getElementById('err-badge').className = 'badge ' + (totalErr ? 'bad' : 'ok');
    document.getElementById('errors').innerHTML =
        errBlock('Splitpay engine errors (logs/splitpay.log)', false, d.logs.splitpay.errors) +
        errBlock('Webhook delivery problems (logs/webhook.log)', true, d.logs.webhook.errors) +
        errBlock('PHP errors (error_log)', false, d.logs.php.errors) ||
        '<div class="empty">no errors in the last 24h</div>';

    document.getElementById('wc-badge').textContent = (s.wc_pending+s.wc_processing+s.wc_done) + ' rows';
    table('wc-table', [
        {l:'id', f:function(r){return r.id;}}, {l:'order id', f:function(r){return r.payment_id;}},
        {l:'prid', f:function(r){return r.prid;}}, {l:'name', f:function(r){return r.name;}},
        {l:'total', f:function(r){return r.total_amount;}},
        {l:'franchise', f:function(r){return r.franchise_amount+' +gst '+r.franchise_gst+' +school '+r.school_amount;}},
        {l:'associate', f:function(r){return r.associate_amount+' +gst '+r.associate_gst;}},
        {l:'crm / it', f:function(r){return r.crm_fix+' / '+r.it_fix;}},
        {l:'aviansys', f:function(r){return r.aviansys_amount+' +gst '+r.aviansys_gst;}},
        {l:'mgmt / gst', f:function(r){return r.management_amount+' / '+r.marrs_gst;}},
        {l:'maker total', f:function(r){return r.total_maker_amount;}},
        {l:'MaRRS bal', f:function(r){return r.MaRRS_bal;}},
        {l:'status', f:function(r){return ['PENDING','PROCESSING','DONE'][parseInt(r.status)||0];}},
        {l:'inserted', f:function(r){return (r.inserted_date||'')+' '+(r.inserted_time||'');}},
        {l:'paid at', f:function(r){return r.date_of_payment;}}
    ], d.webhook_calls, function(r){ return parseInt(r.status)===0?'row-warn':''; });

    var spCols = [
        {l:'pay_id', f:function(r){return r.pay_id;}}, {l:'order id', f:function(r){return r.payment_id;}},
        {l:'prid', f:function(r){return r.prid;}}, {l:'total', f:function(r){return r.total_amount;}},
        {l:'franchise trf', f:function(r){return r.franchise_tranfer_id||'-';}},
        {l:'associate trf', f:function(r){return r.associate_tranfer_id||'-';}},
        {l:'crm trf', f:function(r){return r.crm_fix_tranfer_id||'-';}},
        {l:'it trf', f:function(r){return r.it_fix_tranfer_id||'-';}},
        {l:'aviansys trf', f:function(r){return r.aviansys_tranfer_id||'-';}},
        {l:'mgmt trf', f:function(r){return r.management_tranfer_id||'-';}},
        {l:'gst trf', f:function(r){return r.gst_tranfer_id||'-';}},
        {l:'maker trf', f:function(r){return r.maker_transfer_id||'-';}},
        {l:'paid at', f:function(r){return r.date_of_payment;}}
    ];
    document.getElementById('sp-badge').textContent = d.split_prid.length + ' rows';
    table('sp-table', spCols, d.split_prid, function(r){ return r.maker_transfer_id?'':'row-warn'; });
    document.getElementById('s-badge').textContent = d.split.length + ' rows';
    var sCols = spCols.filter(function(c){ return c.l !== 'prid'; });
    sCols.splice(1, 0, {l:'cin', f:function(r){return r.cin||'-';}});
    table('s-table', sCols, d.split, function(r){ return r.maker_transfer_id?'':'row-warn'; });

    document.getElementById('mk-badge').textContent = d.makers.length + ' rows / ' + s.makers_unpaid + ' unpaid';
    table('mk-table', [
        {l:'id', f:function(r){return r.id;}}, {l:'order id', f:function(r){return r.order_id||'-';}},
        {l:'title', f:function(r){return r.title;}}, {l:'maker id', f:function(r){return r.maker_id;}},
        {l:'price', f:function(r){return r.price;}},
        {l:'transaction_id', f:function(r){return r.transaction_id||'-';}},
        {l:'state', f:function(r){
            if (r.transaction_id) return 'PAID';
            return (parseFloat(r.price)>0 && r.order_id) ? 'UNPAID' : 'n/a';
        }}
    ], d.makers, function(r){
        if (r.transaction_id) return '';
        return (parseFloat(r.price)>0 && r.order_id) ? 'row-bad' : '';
    });

    var k = d.keys;
    document.getElementById('keys-badge').textContent = k.in_credentials ? 'from credentials table' : 'FALLBACK (row missing!)';
    document.getElementById('keys-badge').className = 'badge ' + (k.in_credentials ? 'ok' : 'bad');
    document.getElementById('keys').innerHTML =
        '<div>source: <b>'+esc(k.source)+'</b></div>' +
        '<div>key id: <b>'+esc(k.key_id_masked)+'</b></div>' +
        '<div>secret: <b>'+esc(k.secret_masked)+'</b></div>';
}

function load(){
    fetch(BASE + '/data').then(function(r){
        if (r.status === 401){ location.href = <?php echo json_encode(base_url('dash_login')); ?>; return null; }
        return r.json();
    }).then(function(d){ if (d) render(d); }).catch(function(e){
        document.getElementById('generated_at').textContent = 'load failed: ' + e;
    });
}
load();
setInterval(load, 30000);
</script>
</body>
</html>


