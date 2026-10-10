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
tr.row-bad td{ background:rgba(217,67,79,.10); }
tr.row-warn td{ background:rgba(180,83,9,.08); }
tr.row-ok td{ background:rgba(47,125,79,.07); }
.empty{ padding:16px; color:var(--muted); }
.keys{ display:flex; gap:24px; padding:6px 14px 14px; flex-wrap:wrap; }
.keys b{ font-family:ui-monospace,Menlo,Consolas,monospace; }
.tabs{ display:flex; flex-wrap:wrap; gap:4px; padding:10px 16px 0; background:var(--card); border-bottom:1px solid var(--line); position:sticky; top:57px; z-index:4; }
.tabs button{ background:transparent; color:var(--muted); border:0; border-bottom:2px solid transparent; border-radius:6px 6px 0 0; padding:8px 14px; font-weight:600; }
.tabs button.active{ color:var(--primary); border-bottom-color:var(--primary); }
.tabs button .cnt{ background:var(--line); color:var(--text); border-radius:999px; padding:0 7px; font-size:11px; margin-left:4px; }
.tabs button.active .cnt{ background:rgba(47,107,240,.15); color:var(--primary); }
.tab{ display:none; }
.tab.active{ display:block; }
h2.sec{ font-size:15px; margin:18px 4px 8px; }
</style>
</head>
<body>
<header>
    <div>
        <h1>Webhook &amp; Split Monitor <span class="badge">last 24 hours</span></h1>
        <div class="meta">Webhook &amp; split simulator · no auth · auto-refresh 30s</div>
    </div>
    <div class="meta" id="generated_at">loading…</div>
    <div>
        <button onclick="load()">Refresh</button>
        <button class="ghost" onclick="testPush()">Test push</button>
        <button class="ghost" onclick="document.body.dataset.theme=document.body.dataset.theme==='light'?'dark':'light'">Theme</button>
    </div>
</header>
<nav class="tabs">
    <button data-tab="overview" class="active" onclick="showTab('overview')">Overview</button>
    <button data-tab="webhook" onclick="showTab('webhook')">Webhook Calls <span class="cnt" id="t-wc">0</span></button>
    <button data-tab="splits" onclick="showTab('splits')">Splits <span class="cnt" id="t-sp">0</span></button>
    <button data-tab="makers" onclick="showTab('makers')">Maker Splits <span class="cnt" id="t-mk">0</span></button>
    <button data-tab="cins" onclick="showTab('cins')">CIN &amp; Registration <span class="cnt" id="t-cin">0</span></button>
    <button data-tab="errors" onclick="showTab('errors')">Errors <span class="cnt" id="t-err">0</span></button>
    <button data-tab="keys" onclick="showTab('keys')">Keys</button>
</nav>
<main>
    <section id="tab-overview" class="tab active">
        <div class="cards" id="cards"></div>
        <h2 class="sec">Webhook activity (last 24h) &amp; notifications</h2>
        <section><div class="keys" id="activity"></div></section>
        <h2 class="sec">Errors &amp; webhook setup problems</h2>
        <section><div id="errors"></div></section>
        <h2 class="sec">Razorpay keys</h2>
        <section><div class="keys" id="keys"></div></section>
    </section>

    <section id="tab-webhook" class="tab">
        <h2 class="sec">Webhook calls (webhook_calls) — trace shows which split tables hold each order</h2>
        <section><div class="tablewrap"><table id="wc-table"></table></div></section>
    </section>

    <section id="tab-splits" class="tab">
        <h2 class="sec">Split records — payment_split_prid</h2>
        <section><div class="tablewrap"><table id="sp-table"></table></div></section>
        <h2 class="sec">Split records — payment_split</h2>
        <section><div class="tablewrap"><table id="s-table"></table></div></section>
    </section>

    <section id="tab-makers" class="tab">
        <h2 class="sec">Maker splits (makers_splits) — unpaid rows show the exact reason</h2>
        <section><div class="tablewrap"><table id="mk-table"></table></div></section>
    </section>

    <section id="tab-cins" class="tab">
        <h2 class="sec">CIN &amp; registration (created from the webhook after payment) — 🟢 CIN + notified · 🟠 CIN, no device token · 🔴 paid but NO CIN</h2>
        <section><div class="tablewrap"><table id="cin-table"></table></div></section>
    </section>

    <section id="tab-errors" class="tab">
        <div id="errors-full"></div>
    </section>

    <section id="tab-keys" class="tab">
        <h2 class="sec">Razorpay keys (from credentials table)</h2>
        <section><div class="keys" id="keys-full"></div></section>
    </section>
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
        card(s.makers_unpaid, 'makers UNPAID', s.makers_unpaid?'bad':'') +
        card(s.cins_total, 'CINs created', s.cins_total?'ok':'') +
        card(s.paid_no_cin, 'paid but NO CIN', s.paid_no_cin?'bad':'');

    // webhook activity strip
    document.getElementById('activity').innerHTML =
        '<div>payment.captured: <b>'+esc(s.ev_captured)+'</b></div>' +
        '<div>order.paid: <b>'+esc(s.ev_order_paid)+'</b></div>' +
        '<div>transfer.processed: <b>'+esc(s.ev_transfer)+'</b></div>' +
        '<div>payment.authorized: <b>'+esc(s.ev_authorized)+'</b></div>' +
        '<div>payment.failed: <b>'+esc(s.ev_failed)+'</b></div>' +
        '<div>admin push sent: <b>'+esc(s.notify_sent)+'</b></div>' +
        '<div>admin push failed: <b>'+esc(s.notify_failed)+'</b></div>';

    var totalErr = s.splitpay_errors + s.invalid_signature + s.no_signature + s.delegate_failed + s.on_hold_errors + s.php_errors;

    var errHtml = errBlock('Splitpay engine errors (logs/splitpay.log)', false, d.logs.splitpay.errors) +
        errBlock('Webhook delivery problems (logs/webhook.log)', true, d.logs.webhook.errors) +
        errBlock('PHP errors (error_log)', false, d.logs.php.errors);
    var emptyErr = '<div class="empty">no errors in the last 24h</div>';
    document.getElementById('errors').innerHTML = errHtml || emptyErr;
    document.getElementById('errors-full').innerHTML = errHtml || emptyErr;
    document.getElementById('t-err').textContent = totalErr;

    document.getElementById('t-wc').textContent = d.webhook_calls.length;
    document.getElementById('t-sp').textContent = (d.split_prid.length + d.split.length);
    document.getElementById('t-mk').textContent = d.makers.length + (s.makers_unpaid ? ' !'+s.makers_unpaid : '');
    document.getElementById('t-cin').textContent = d.cins.length + (s.paid_no_cin ? ' !'+s.paid_no_cin : '');

    // CIN & registration table (color-coded)
    table('cin-table', [
        {l:'order id', f:function(r){return r.order_id;}},
        {l:'prid', f:function(r){return r.prid;}},
        {l:'name', f:function(r){return r.name;}},
        {l:'total', f:function(r){return r.total;}},
        {l:'status', f:function(r){return ['PENDING','PROCESSING','DONE'][r.status]||r.status;}},
        {l:'CINs', f:function(r){return r.cin_count;}},
        {l:'CIN numbers', wrap:true, f:function(r){return (r.cins&&r.cins.length)?r.cins.join(', '):'-';}},
        {l:'device token', f:function(r){return r.has_token?'yes':'no';}},
        {l:'notify', f:function(r){
            if (r.status!==1) return '-';
            if (r.cin_count===0) return 'no CIN';
            return r.has_token ? 'sent' : 'no token';
        }},
        {l:'split', f:function(r){return r.recon_ok?'Balanced':'Gap '+r.recon_gap;}}
    ], d.cins, function(r){
        if (r.status===1 && r.cin_count===0) return 'row-bad';      // paid but no CIN
        if (r.status===1 && !r.recon_ok) return 'row-warn';          // split gap
        if (r.status===1 && !r.has_token) return 'row-warn';         // CIN but no token
        if (r.status===1) return 'row-ok';                           // CIN + balanced (+token)
        return '';
    });

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
        {l:'status', f:function(r){return ['PENDING','PROCESSING','DONE'][parseInt(r.status)||0];}},
        {l:'trace', f:function(r){
            var t=['wc'];
            if (r.in_split_prid) t.push('split_prid');
            if (r.in_split) t.push('split');
            return t.join(' + ');
        }},
        {l:'inserted', f:function(r){return (r.inserted_date||'')+' '+(r.inserted_time||'');}},
        {l:'paid at', f:function(r){return r.date_of_payment;}},
        {l:'CINs', f:function(r){return r.cin_count;}},
        {l:'split', f:function(r){return r.recon_ok?'Balanced':'Gap '+r.recon_gap;}}
    ], d.webhook_calls, function(r){
        if (parseInt(r.status)===1 && r.cin_count===0) return 'row-bad';
        if (parseInt(r.status)===0) return 'row-warn';
        return '';
    });

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
    table('sp-table', spCols, d.split_prid, function(r){ return r.maker_transfer_id?'':'row-warn'; });
    var sCols = spCols.filter(function(c){ return c.l !== 'prid'; });
    sCols.splice(1, 0, {l:'cin', f:function(r){return r.cin||'-';}});
    table('s-table', sCols, d.split, function(r){ return r.maker_transfer_id?'':'row-warn'; });

    table('mk-table', [
        {l:'id', f:function(r){return r.id;}}, {l:'order id', f:function(r){return r.order_id||'-';}},
        {l:'title', f:function(r){return r.title;}}, {l:'maker id', f:function(r){return r.maker_id;}},
        {l:'price', f:function(r){return r.price;}},
        {l:'transaction_id', f:function(r){return r.transaction_id||'-';}},
        {l:'state', f:function(r){ return r.state==='paid' ? 'PAID' : 'UNPAID'; }},
        {l:'reason (why not transferred)', wrap:true, f:function(r){return r.reason||'';}}
    ], d.makers, function(r){ return r.state==='paid' ? '' : 'row-bad'; });

    var k = d.keys;
    var keysHtml = '<div>source: <b>'+esc(k.source)+'</b> '+(k.in_credentials?'<span class="badge ok">credentials table</span>':'<span class="badge bad">FALLBACK (row missing!)</span>')+'</div>' +
        '<div>key id: <b>'+esc(k.key_id_masked)+'</b></div>' +
        '<div>secret: <b>'+esc(k.secret_masked)+'</b></div>';
    document.getElementById('keys').innerHTML = keysHtml;
    document.getElementById('keys-full').innerHTML = keysHtml;
}

function showTab(name){
    var tabs = document.querySelectorAll('.tab');
    for (var i=0;i<tabs.length;i++){ tabs[i].classList.remove('active'); }
    var btns = document.querySelectorAll('.tabs button');
    for (var j=0;j<btns.length;j++){ btns[j].classList.remove('active'); }
    document.getElementById('tab-'+name).classList.add('active');
    document.querySelector('.tabs button[data-tab="'+name+'"]').classList.add('active');
}

function testPush(){
    fetch(BASE.replace('/splitmonitor','') + '/index.php/splitpay/testPush').then(function(r){ return r.json(); }).then(function(d){
        var ok = d && d.result && d.result.success;
        alert(ok ? 'Test push sent OK' : 'Test push failed: ' + JSON.stringify(d.result));
    }).catch(function(e){ alert('Test push error: ' + e); });
}
function load(){
    fetch(BASE + '/data').then(function(r){
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


