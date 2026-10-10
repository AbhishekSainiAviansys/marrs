<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Webhook &amp; Split Monitor</title>
<style>
:root{
    --bg:#f2f6ff; --card:#fff; --text:#17233d; --muted:#68758f;
    --line:#dce5f2; --primary:#4568f5; --ok:#16845b; --danger:#d54759; --warn:#bc7100;
    --navy:#14264b; --soft-blue:#edf2ff;
}
body[data-theme="dark"]{
    --bg:#101827; --card:#192438; --text:#e8eefc; --muted:#a5b2cb;
    --line:#2c3a53; --primary:#8da6ff; --ok:#57d2a0; --danger:#ff8290; --warn:#ffbd58;
    --navy:#0d1729; --soft-blue:#202e4b;
}
*,*:before,*:after{ box-sizing:border-box; }
body{ margin:0; background:var(--bg); color:var(--text); font:14px/1.5 -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif; }
header{ display:flex; flex-wrap:wrap; gap:14px; align-items:center; justify-content:space-between; padding:16px 22px; color:#fff; background:linear-gradient(115deg,#12254a,#3455b5 62%,#4777db); box-shadow:0 8px 24px rgba(20,38,75,.2); position:sticky; top:0; z-index:5; }
header h1{ margin:0; font-size:20px; letter-spacing:.2px; }
header .meta{ color:rgba(255,255,255,.78); font-size:12px; }
header .badge{ background:rgba(255,255,255,.18); color:#fff; }
button{ background:var(--primary); color:#fff; border:0; border-radius:9px; padding:9px 14px; cursor:pointer; font-size:13px; font-weight:650; transition:transform .15s,filter .15s; }
button:hover{ filter:brightness(1.08); transform:translateY(-1px); }
button:disabled{ cursor:wait; opacity:.6; transform:none; }
button.ghost{ background:rgba(255,255,255,.12); color:#fff; border:1px solid rgba(255,255,255,.35); }
main{ padding:20px; max-width:1600px; margin:0 auto; }
.toolbar{ display:flex; flex-wrap:wrap; gap:9px; align-items:center; justify-content:flex-end; }
.days{ display:flex; flex-wrap:wrap; gap:4px; }
.days button{ background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.25); padding:7px 10px; }
.days button.active{ background:#fff; color:#24449f; }
.search{ width:min(230px,65vw); border:1px solid rgba(255,255,255,.35); border-radius:9px; padding:9px 11px; color:#fff; background:rgba(255,255,255,.12); outline:none; }
.search::placeholder{ color:rgba(255,255,255,.72); }
.cards{ display:grid; grid-template-columns:repeat(auto-fill,minmax(155px,1fr)); gap:11px; margin-bottom:16px; }
.card{ background:var(--card); border:1px solid var(--line); border-left:4px solid #7d91b6; border-radius:12px; padding:13px 15px; box-shadow:0 4px 14px rgba(30,50,90,.05); }
.card.clickable{ cursor:pointer; }
.card.clickable:hover{ transform:translateY(-2px); }
.card.ok{ border-left-color:var(--ok); }
.card.bad{ border-left-color:var(--danger); }
.card.warn{ border-left-color:var(--warn); }
.card.info{ border-left-color:var(--primary); }
.card .v{ font-size:23px; font-weight:750; }
.card .l{ color:var(--muted); font-size:10px; text-transform:uppercase; letter-spacing:.07em; }
.card.ok .v{ color:var(--ok); } .card.bad .v{ color:var(--danger); } .card.warn .v{ color:var(--warn); }
section{ background:var(--card); border:1px solid var(--line); border-radius:12px; margin-bottom:14px; overflow:hidden; box-shadow:0 4px 14px rgba(30,50,90,.04); }
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
.tabs{ display:flex; flex-wrap:wrap; gap:4px; padding:10px 16px 0; background:var(--card); border-bottom:1px solid var(--line); }
.tabs button{ background:transparent; color:var(--muted); border:0; border-bottom:2px solid transparent; border-radius:6px 6px 0 0; padding:8px 14px; font-weight:600; }
.tabs button.active{ color:var(--primary); border-bottom-color:var(--primary); }
.tabs button .cnt{ background:var(--line); color:var(--text); border-radius:999px; padding:0 7px; font-size:11px; margin-left:4px; }
.tabs button.active .cnt{ background:rgba(47,107,240,.15); color:var(--primary); }
.tab{ display:none; }
.tab.active{ display:block; }
h2.sec{ font-size:15px; margin:18px 4px 8px; }
.lookup{ margin:0 0 18px; padding:18px; background:linear-gradient(125deg,var(--card),var(--soft-blue)); border:1px solid var(--line); border-radius:14px; box-shadow:0 7px 22px rgba(40,70,140,.08); }
.lookup-head{ display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:8px; margin-bottom:12px; }
.lookup-head h2{ margin:0; font-size:17px; }
.lookup-head p{ margin:0; color:var(--muted); font-size:12px; }
.lookup-warning{ margin:0 0 12px; padding:8px 11px; border-radius:8px; color:var(--warn); background:rgba(180,83,9,.10); font-size:12px; }
.lookup-form{ display:flex; flex-wrap:wrap; gap:9px; }
.lookup-form input{ flex:1 1 270px; min-width:0; padding:11px 13px; border:1px solid var(--line); border-radius:9px; color:var(--text); background:var(--card); font:14px ui-monospace,Consolas,monospace; }
.lookup-form input:focus{ outline:2px solid rgba(69,104,245,.25); border-color:var(--primary); }
.lookup-results{ display:none; margin-top:15px; }
.lookup-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:10px; }
.lookup-card{ min-width:0; padding:13px; border:1px solid var(--line); border-radius:10px; background:var(--card); }
.lookup-card h3{ margin:0 0 9px; font-size:13px; color:var(--primary); }
.lookup-card p{ margin:4px 0; overflow-wrap:anywhere; }
.lookup-card b{ color:var(--muted); font-weight:600; }
.lookup-note{ color:var(--muted); font-size:12px; }
.lookup-message{ margin:10px 0; padding:10px 12px; border-radius:9px; background:var(--soft-blue); }
.toast{ display:none; position:fixed; right:18px; bottom:18px; z-index:20; max-width:min(480px,calc(100vw - 36px)); padding:12px 16px; border-radius:10px; background:#17233d; color:#fff; box-shadow:0 8px 25px rgba(0,0,0,.25); }
.toast.show{ display:block; }
.toast.error{ background:#a62d42; }
@media(max-width:760px){ header{position:relative;padding:15px;} .toolbar{justify-content:flex-start;} main{padding:12px;} }
</style>
</head>
<body>
<header>
    <div>
        <h1>Webhook &amp; Split Monitor <span class="badge" id="window-label">last 24 hours</span></h1>
        <div class="meta">Payment flow health · refreshes every 30 seconds</div>
    </div>
    <div class="meta" id="generated_at">loading…</div>
    <div class="toolbar">
        <div class="days" aria-label="Time range">
            <button class="active" data-days="1" onclick="setDays(1)">24h</button>
            <button data-days="2" onclick="setDays(2)">2d</button>
            <button data-days="3" onclick="setDays(3)">3d</button>
            <button data-days="4" onclick="setDays(4)">4d</button>
            <button data-days="5" onclick="setDays(5)">5d</button>
            <button data-days="6" onclick="setDays(6)">6d</button>
            <button data-days="7" onclick="setDays(7)">7d</button>
        </div>
        <input class="search" id="global-search" type="search" placeholder="Filter visible tables…">
        <button onclick="load()">Refresh</button>
        <button class="ghost" onclick="testPush()">Test push</button>
        <button class="ghost" onclick="toggleTheme()">Theme</button>
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
    <section class="lookup">
        <div class="lookup-head">
            <h2>Order lookup</h2>
            <p>Read-only split, registration/contact, and Razorpay payment details</p>
        </div>
        <p class="lookup-warning">Temporary: this monitor has no login. Order lookups expose customer contact details; add access control before production use.</p>
        <form class="lookup-form" id="order-lookup-form" onsubmit="lookupOrder(event)">
            <input id="order-id-input" name="order_id" type="text" maxlength="110" placeholder="Razorpay order ID (order_…)" autocomplete="off" required>
            <button id="order-lookup-button" type="submit">Fetch order</button>
        </form>
        <div class="lookup-results" id="order-results" aria-live="polite"></div>
    </section>

    <section id="tab-overview" class="tab active">
        <div class="cards" id="cards"></div>
        <h2 class="sec">Webhook activity (selected range) &amp; notifications</h2>
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
<div class="toast" id="toast" role="status" aria-live="polite"></div>
<script>
var BASE = <?php echo json_encode(rtrim(base_url(), '/').'/index.php/splitmonitor'); ?>;
var API_ROOT = BASE.replace(/\/splitmonitor\/?$/, '');
var selectedDays = 1;
var loadInFlight = false;
var otherRequestsInFlight = 0;
var toastTimer = null;

function esc(v){
    if (v === null || v === undefined) return '';
    return String(v).replace(/[&<>"']/g, function(c){
        return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c];
    });
}
function table(elId, cols, rows, rowClass){
    var t = document.getElementById(elId);
    if (!rows || !rows.length){ t.innerHTML = '<tr><td class="empty">no rows in selected range</td></tr>'; return; }
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
function card(v, l, cls, action){ return '<div class="card '+(cls||'')+(action?' clickable':'')+(action?' onclick="'+action+'"':'')+'"><div class="v">'+esc(v)+'</div><div class="l">'+esc(l)+'</div></div>'; }
function showToast(message, isError){
    var toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = 'toast show' + (isError ? ' error' : '');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function(){ toast.className = 'toast'; }, 5000);
}
function requestJson(url, options){
    otherRequestsInFlight++;
    return fetch(url, options || {}).then(function(response){
        return response.text().then(function(body){
            var contentType = response.headers.get('content-type') || '';
            if (contentType.toLowerCase().indexOf('application/json') === -1) {
                var snippet = body.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim().slice(0, 220);
                throw new Error('Expected JSON (HTTP '+response.status+'). '+(snippet || 'The server returned an empty response.'));
            }
            var data;
            try { data = JSON.parse(body); }
            catch (error) { throw new Error('The server returned invalid JSON (HTTP '+response.status+').'); }
            if (!response.ok) {
                throw new Error((data && (data.message || data.error)) || ('Request failed (HTTP '+response.status+').'));
            }
            return data;
        });
    }).finally(function(){ otherRequestsInFlight--; });
}
function setDays(days){
    selectedDays = Math.max(1, Math.min(7, parseInt(days, 10) || 1));
    document.querySelectorAll('.days button').forEach(function(button){
        button.classList.toggle('active', parseInt(button.getAttribute('data-days'), 10) === selectedDays);
    });
    load();
}
function toggleTheme(){
    document.body.dataset.theme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
}
function filterTables(){
    var query = document.getElementById('global-search').value.trim().toLowerCase();
    document.querySelectorAll('table').forEach(function(tableElement){
        tableElement.querySelectorAll('tr').forEach(function(row, index){
            if (index === 0) { row.style.display = ''; return; }
            row.style.display = !query || row.textContent.toLowerCase().indexOf(query) !== -1 ? '' : 'none';
        });
    });
}
document.getElementById('global-search').addEventListener('input', filterTables);

function render(d){
    var s = d.summary;
    document.getElementById('generated_at').textContent = 'generated ' + d.generated_at;
    document.getElementById('window-label').textContent = 'last ' + (d.window_days || 1) + ((d.window_days || 1) === 1 ? ' day' : ' days');
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
        card((s.needs_split || 0) + (s.needs_activation || 0) + (s.makers_unpaid || 0), 'needs action · open details', 'warn', "showTab('webhook')") +
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
    var emptyErr = '<div class="empty">no errors in selected range</div>';
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
        {l:'flow', f:function(r){return r.flow||'UNKNOWN';}},
        {l:'product', f:function(r){return r.product_name||r.title||'-';}},
        {l:'time', f:function(r){return r.time||'-';}},
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
    filterTables();
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
    var button = document.querySelector('button[onclick="testPush()"]');
    if (button) button.disabled = true;
    requestJson(API_ROOT + '/splitpay/testPush').then(function(d){
        var ok = d && d.result && d.result.success;
        showToast(ok ? 'Test push sent successfully.' : 'Test push failed: ' + ((d.result && (d.result.error || d.result.message)) || JSON.stringify(d.result)), !ok);
    }).catch(function(e){ showToast('Test push failed: ' + e.message, true); }).finally(function(){
        if (button) button.disabled = false;
    });
}
function load(){
    if (loadInFlight) return;
    loadInFlight = true;
    requestJson(BASE + '/data?days=' + selectedDays).then(function(d){ if (d) render(d); }).catch(function(e){
        document.getElementById('generated_at').textContent = 'load failed: ' + e.message;
        showToast('Monitor refresh failed: ' + e.message, true);
    }).finally(function(){
        loadInFlight = false;
    });
}
load();
setInterval(function(){ if (!loadInFlight && otherRequestsInFlight === 0) load(); }, 30000);

function money(value){
    var amount = parseFloat(value);
    return isFinite(amount) ? '₹' + amount.toFixed(2) : '—';
}
function lookupOrder(event){
    event.preventDefault();
    var orderId = document.getElementById('order-id-input').value.trim();
    var button = document.getElementById('order-lookup-button');
    var results = document.getElementById('order-results');
    if (!/^order_[A-Za-z0-9_-]{1,100}$/.test(orderId)) {
        results.style.display = 'block';
        results.innerHTML = '<div class="lookup-message">Enter a valid Razorpay order ID beginning with <b>order_</b>.</div>';
        return;
    }
    button.disabled = true;
    results.style.display = 'block';
    results.innerHTML = '<div class="lookup-message">Fetching payment and split details…</div>';
    var body = new URLSearchParams();
    body.set('order_id', orderId);
    requestJson(BASE + '/order_detail', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
        body: body.toString()
    }).then(function(data){
        renderOrderDetails(data);
    }).catch(function(error){
        results.innerHTML = '<div class="lookup-message">'+esc(error.message)+'</div>';
        showToast('Order lookup failed: ' + error.message, true);
    }).finally(function(){ button.disabled = false; });
}
function renderOrderDetails(data){
    var results = document.getElementById('order-results');
    var webhook = (data.webhook_calls && data.webhook_calls[0]) || (data.webhook_calls_cin && data.webhook_calls_cin[0]) || {};
    var razorpay = data.razorpay || {};
    var contact = data.contact || {};
    var paymentStatus = razorpay.razorpay_status || 'unavailable';
    var localStatus = webhook.status === undefined ? 'no webhook record' : (parseInt(webhook.status, 10) === 1 ? 'processed' : (parseInt(webhook.status, 10) === 2 ? 'processing' : 'pending'));
    var html = '<div class="lookup-grid">' +
        '<div class="lookup-card"><h3>Payment status</h3>' +
        '<p><b>Order:</b> '+esc(data.order_id)+'</p>' +
        '<p><b>Razorpay:</b> '+esc(paymentStatus)+'</p>' +
        '<p><b>Our webhook:</b> '+esc(localStatus)+'</p>' +
        '<p><b>Flow:</b> '+esc(data.flow)+'</p>' +
        '<p><b>Amount:</b> '+esc(money(razorpay.amount !== undefined && razorpay.amount !== null ? razorpay.amount : webhook.total_amount))+'</p>' +
        '<p><b>Paid:</b> '+esc(money(razorpay.amount_paid))+'</p>' +
        '<p><b>Due:</b> '+esc(money(razorpay.amount_due))+'</p>' +
        '<p><b>Method:</b> '+esc(razorpay.method || '—')+'</p>' +
        (razorpay.error ? '<p class="lookup-note"><b>Razorpay lookup:</b> '+esc(razorpay.error)+'</p>' : '') +
        '</div>' +
        '<div class="lookup-card"><h3>Contact / registration</h3>' +
        '<p><b>Name:</b> '+esc(contact.name || webhook.name || '—')+'</p>' +
        '<p><b>Phone:</b> '+esc(contact.phone || razorpay.contact || '—')+'</p>' +
        '<p><b>Email:</b> '+esc(contact.email || razorpay.email || '—')+'</p>' +
        '<p><b>CIN:</b> '+esc(contact.cin || webhook.cin || '—')+'</p>' +
        '<p><b>PRID:</b> '+esc(contact.prid || webhook.prid || '—')+'</p>' +
        '</div></div>';

    var contacts = data.contacts || [];
    if (contacts.length) {
        html += '<h3 class="sec">Related contact records</h3><div class="tablewrap"><table><tr><th>Source</th><th>Name</th><th>CIN</th><th>Phone</th><th>Email</th></tr>';
        contacts.forEach(function(row){
            html += '<tr><td>'+esc(row.source)+'</td><td>'+esc(row.name)+'</td><td>'+esc(row.cin)+'</td><td>'+esc(row.phone)+'</td><td>'+esc(row.email)+'</td></tr>';
        });
        html += '</table></div>';
    }

    var splitGroups = [
        ['payment_split_prid', data.split_prid || []],
        ['payment_split', data.split || []]
    ];
    var legs = [
        ['Franchise', 'franchise_amount', 'franchise_tranfer_id'],
        ['Franchise GST', 'franchise_gst', 'franchise_tranfer_id'],
        ['School', 'school_amount', ''],
        ['Associate', 'associate_amount', 'associate_tranfer_id'],
        ['Associate GST', 'associate_gst', 'associate_tranfer_id'],
        ['CRM', 'crm_fix', 'crm_fix_tranfer_id'],
        ['IT', 'it_fix', 'it_fix_tranfer_id'],
        ['Aviansys', 'aviansys_amount', 'aviansys_tranfer_id'],
        ['Aviansys GST', 'aviansys_gst', 'aviansys_tranfer_id'],
        ['Management', 'management_amount', 'management_tranfer_id'],
        ['GST', 'gst_amount', 'gst_tranfer_id'],
        ['Makers', 'total_maker_amount', 'maker_transfer_id']
    ];
    html += '<h3 class="sec">Split breakdown</h3><div class="tablewrap"><table><tr><th>Source</th><th>Payee / leg</th><th>Amount</th><th>Transfer ID</th><th>Recorded</th></tr>';
    var splitCount = 0;
    splitGroups.forEach(function(group){
        group[1].forEach(function(record){
            splitCount++;
            legs.forEach(function(leg){
                if (parseFloat(record[leg[1]]) > 0 || record[leg[2]]) {
                    html += '<tr><td>'+esc(group[0])+'</td><td>'+esc(leg[0])+'</td><td>'+esc(money(record[leg[1]]))+'</td><td>'+esc(leg[2] ? (record[leg[2]] || '—') : '—')+'</td><td>'+esc(record.date_of_payment || '—')+'</td></tr>';
                }
            });
        });
    });
    if (!splitCount) html += '<tr><td colspan="5">No split records found in either split table.</td></tr>';
    html += '</table></div>';

    var makers = data.makers || [];
    html += '<h3 class="sec">Maker splits</h3><div class="tablewrap"><table><tr><th>Title</th><th>Maker ID</th><th>Amount</th><th>Transfer ID</th><th>Status</th></tr>';
    if (!makers.length) html += '<tr><td colspan="5">No maker split rows found.</td></tr>';
    makers.forEach(function(row){
        html += '<tr><td>'+esc(row.title)+'</td><td>'+esc(row.maker_id)+'</td><td>'+esc(money(row.price))+'</td><td>'+esc(row.transaction_id || '—')+'</td><td>'+esc(row.transaction_id ? 'PAID' : 'UNPAID')+'</td></tr>';
    });
    html += '</table></div>';

    var products = data.products || [];
    if (products.length) {
        html += '<h3 class="sec">Purchased products / CINs</h3><div class="tablewrap"><table><tr><th>Product</th><th>Student</th><th>CIN</th><th>Amount</th></tr>';
        products.forEach(function(row){
            html += '<tr><td>'+esc(row.product_name)+'</td><td>'+esc(row.student_name)+'</td><td>'+esc(row.cin)+'</td><td>'+esc(money(row.amount))+'</td></tr>';
        });
        html += '</table></div>';
    }
    html += '<p class="lookup-note">'+(data.found ? 'Internal payment records found.' : 'No internal records found; showing Razorpay lookup result only.')+' This lookup does not create or retry transfers.</p>';
    results.innerHTML = html;
    showToast('Order details loaded for ' + data.order_id, false);
}
</script>
</body>
</html>
