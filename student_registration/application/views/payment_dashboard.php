<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Payment Split Dashboard</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

<style>
:root{
    box-sizing:border-box;
    padding-top:env(safe-area-inset-top,0px);
    padding-bottom:env(safe-area-inset-bottom,0px);

    --bg:#f4f6fb;
    --card:#fff;
    --text:#1f2937;
    --muted:#6b7280;
    --line:#e5e7eb;
    --primary:#2f6bf0;
    --side:#111827;
    --sidetext:#d1d5db;
    --ok:#2f7d4f;
    --danger:#d9434f;
}

@media (prefers-color-scheme:dark){
    :root:not([data-theme="light"]){
        --bg:#0f1420;
        --card:#171d2b;
        --text:#e5e7eb;
        --muted:#9ca3af;
        --line:#2a3345;
        --side:#0a0e17;
    }
}

:root[data-theme="dark"]{
    --bg:#0f1420;
    --card:#171d2b;
    --text:#e5e7eb;
    --muted:#9ca3af;
    --line:#2a3345;
    --side:#0a0e17;
}

html{
    scroll-padding-top:env(safe-area-inset-top,0px);
}

*,*:before,*:after{
    box-sizing:inherit;
}

body{
    margin:0;
    background:var(--bg);
    color:var(--text);
    font:15px/1.4 system-ui,-apple-system,Segoe UI,Roboto,sans-serif;
    display:flex;
    min-height:100vh;
}

aside{
    width:250px;
    background:var(--side);
    color:var(--sidetext);
    padding:16px 10px;
    flex-shrink:0;
    overflow-y:auto;
}

aside h2{
    color:#fff;
    font-size:17px;
    margin:4px 10px 14px;
}

.brand{
    margin-bottom:6px;
}

.brand>button{
    width:100%;
    text-align:left;
    background:none;
    border:0;
    color:#fff;
    font-size:15px;
    font-weight:600;
    padding:9px 10px;
    border-radius:8px;
    cursor:pointer;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.brand>button:hover{
    background:#ffffff14;
}

.dot{
    display:inline-block;
    width:9px;
    height:9px;
    border-radius:50%;
    margin-right:8px;
}

.sub{
    display:none;
    margin:2px 0 8px 18px;
    border-left:1px solid #ffffff22;
}

.brand.open .sub{
    display:block;
}

.sub button{
    display:flex;
    justify-content:space-between;
    width:100%;
    background:none;
    border:0;
    color:var(--sidetext);
    text-align:left;
    padding:7px 12px;
    font-size:14px;
    cursor:pointer;
    border-radius:6px;
}

.sub button:hover:not(:disabled){
    background:#ffffff14;
}

.sub button.active{
    background:var(--primary);
    color:#fff;
}

.sub button:disabled{
    opacity:.4;
    cursor:not-allowed;
}

main{
    flex:1;
    min-width:0;
    padding:18px 22px;
}

header{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    align-items:center;
    justify-content:space-between;
    margin-bottom:14px;
}

header h1{
    margin:0;
    font-size:22px;
    color:var(--primary);
}

.who{
    display:flex;
    gap:8px;
    align-items:center;
    font-size:13px;
    color:var(--muted);
}

select,
input{
    background:var(--card);
    color:var(--text);
    border:1px solid var(--line);
    border-radius:8px;
    padding:8px 10px;
    font:inherit;
    max-width:100%;
}

.btn{
    border:0;
    border-radius:8px;
    padding:9px 16px;
    color:#fff;
    font:inherit;
    cursor:pointer;
    text-decoration:none;
    display:inline-block;
}

.menu{
    display:none;
    background:var(--card);
    color:var(--text);
    border:1px solid var(--line);
    border-radius:8px;
    padding:6px 10px;
}

.card{
    background:var(--card);
    border:1px solid var(--line);
    border-radius:14px;
    padding:16px;
    margin-bottom:16px;
}

.crumb{
    color:var(--muted);
    font-size:13px;
    margin-bottom:8px;
}

.filters{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(150px,1fr));
    gap:10px;
    align-items:end;
}

.filters label{
    display:block;
    font-size:12px;
    color:var(--muted);
    margin-bottom:4px;
}

.filters select,
.filters input{
    width:100%;
}

.actions{
    display:flex;
    gap:8px;
    margin-top:12px;
}

.actions .btn{
    flex:1;
}

.chartbox{
    position:relative;
    height:300px;
}

.tools{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    justify-content:space-between;
    align-items:center;
    margin-bottom:10px;
}

.scroll{
    overflow-x:auto;
}

table{
    border-collapse:collapse;
    width:100%;
    font-size:13.5px;
    white-space:nowrap;
}

th,
td{
    padding:9px 10px;
    border-bottom:1px solid var(--line);
    text-align:left;
}

th{
    font-weight:600;
    cursor:pointer;
    user-select:none;
}

tr.tot td{
    font-weight:700;
    background:#2f6bf010;
}

.pager{
    display:flex;
    gap:8px;
    align-items:center;
    justify-content:flex-end;
    margin-top:10px;
    color:var(--muted);
}

.pager button{
    border:1px solid var(--line);
    background:var(--card);
    color:var(--text);
    border-radius:6px;
    padding:5px 12px;
    cursor:pointer;
}

.pager button:disabled{
    opacity:.4;
}

.denied{
    text-align:center;
    padding:40px;
    color:var(--muted);
}

@media(max-width:800px){
    aside{
        position:fixed;
        inset:0 auto 0 0;
        z-index:9;
        transform:translateX(-100%);
        transition:.2s;
        padding-top:calc(16px + env(safe-area-inset-top,0px));
    }

    aside.show{
        transform:none;
    }

    .menu{
        display:inline-block;
    }

    main{
        padding:14px;
    }
}
</style>
</head>

<body>

<aside id="side">
    <h2>Payment Split</h2>
    <div id="nav"></div>
</aside>

<main>

<header>
    <div style="display:flex;gap:10px;align-items:center">

        <button
            class="menu"
            onclick="side.classList.toggle('show')"
            aria-label="Open menu"
        >
            &#9776;
        </button>

        <h1>Payment Split Dashboard</h1>
    </div>

    <div class="who">
        <span>
            <?= htmlspecialchars($account->name) ?>
            (<?= htmlspecialchars($account->role) ?>)
        </span>

        <a
            class="btn"
            style="background:var(--danger)"
            href="<?= site_url('dash_login/logout') ?>"
        >
            Logout
        </a>
    </div>
</header>

<div class="card">

    <div class="crumb" id="crumb"></div>

    <div
        id="note"
        style="display:none;background:#fff4d6;color:#7a5b00;border-radius:8px;padding:8px 12px;margin-bottom:10px;font-size:13px"
    ></div>

    <div class="filters">

        <div>
            <label>Payment Status</label>

            <select id="fStatus">
                <option value="">All</option>
                <option>Successful</option>
                <option>Failed</option>
            </select>
        </div>

        <div>
            <label>Payment Type</label>

            <select id="fFor">
                <option value="">All</option>
                <option>School</option>
                <option>Competition</option>
            </select>
        </div>

        <div>
            <label>Start Date</label>
            <input type="date" id="fFrom">
        </div>

        <div>
            <label>End Date</label>
            <input type="date" id="fTo">
        </div>

    </div>

    <div class="actions">
        <button
            class="btn"
            style="background:var(--primary)"
            onclick="reload()"
        >
            Search
        </button>

        <button
            class="btn"
            style="background:#6b7280"
            onclick="resetF()"
        >
            Reset
        </button>
    </div>

</div>

<div id="body">

    <div class="card">
        <div style="font-weight:600;margin-bottom:8px">
            Revenue Chart
        </div>

        <div class="chartbox">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <div class="card">

        <div class="tools">
            <b>Payment List</b>

            <button
                class="btn"
                style="background:var(--ok)"
                onclick="exportCsv()"
            >
                Export CSV
            </button>
        </div>

        <div class="tools">

            <span>
                Show

                <select
                    id="size"
                    onchange="page=1;render()"
                >
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>

                entries
            </span>

            <span>
                Search:
                <input
                    id="q"
                    oninput="page=1;render()"
                >
            </span>

        </div>

        <div class="scroll">
            <table id="tbl"></table>
        </div>

        <div class="pager">
            <span id="info"></span>

            <button
                id="prev"
                onclick="page--;render()"
            >
                Prev
            </button>

            <button
                id="next"
                onclick="page++;render()"
            >
                Next
            </button>
        </div>

    </div>

</div>

<div
    class="card denied"
    id="denied"
    style="display:none"
>
    &#128274; Your login can only access its own sub-list.
</div>

</main>

<script>

/* =========================================================
   SERVER / ACCOUNT
========================================================= */

const ROLE = <?= json_encode($account->role) ?>;
const BASE = <?= json_encode(site_url('payment_dashboard')) ?>;
const LOGIN = <?= json_encode(site_url('dash_login')) ?>;


/* =========================================================
   BRANDS
========================================================= */

const ALL_BRANDS = {
    marrs: {
        n: 'MaRRS',
        c: '#2f6bf0'
    },

    lunar: {
        n: 'Lunar',
        c: '#6b7280'
    },

    zoomzoom: {
        n: 'ZoomZoom',
        c: '#e8a317'
    }
};

const BRANDS = ALL_BRANDS;


/* =========================================================
   ROLES
========================================================= */

const SUBS = {
    all: 'All',
    franchise: 'Franchise',
    crm: 'CRM',
    it: 'IT',
    management: 'Management',
    aviansys: 'Aviansys',
    maker: 'Maker'
};


/* =========================================================
   TABLE COLUMNS
========================================================= */

const COLS = {
    franchise: 'Franchise Pay',
    franchiseG: 'Franchise GST',

    marrs: 'MaRRS GST Pay',

    crm: 'CRM Kochi Pay',
    crmG: 'CRM Kochi GST',

    it: 'IT Pay',
    itG: 'IT GST',

    razor: 'Razorpay Charges',

    mgmt: 'Management Pay',
    mgmtG: 'Management GST',

    balance: 'Balance(Coral Venture)',

    avian: 'Aviansys Pay',
    avianG: 'Aviansys GST',

    crmAv: 'CRM Aviansys',
    crmAvG: 'CRM Aviansys GST',

    maker: 'Maker Pay',
    makerG: 'Maker GST'
};

const SHOW = {
    all: Object.keys(COLS),

    franchise: [
        'franchise',
        'franchiseG'
    ],

    crm: [
        'crm',
        'crmG',
        'crmAv',
        'crmAvG'
    ],

    it: [
        'it',
        'itG'
    ],

    management: [
        'mgmt',
        'mgmtG'
    ],

    aviansys: [
        'avian',
        'avianG',
        'crmAv',
        'crmAvG'
    ],

    maker: [
        'maker',
        'makerG'
    ]
};

const DATA = {
    marrs: [],
    lunar: [],
    zoomzoom: []
};


/* =========================================================
   STATE
========================================================= */

let role = ROLE;

let brand = Object.keys(BRANDS)[0];

let sub = role === 'admin'
    ? 'all'
    : role;

let page = 1;
let sortK = null;
let sortD = 1;
let chart;

const $ = id => document.getElementById(id);


/*
 * Admin:
 *   only "All" is allowed.
 *
 * Other roles:
 *   only their own role is allowed.
 */
const allowed = s => {
    if (role === 'admin') {
        return s === 'all';
    }

    return s === role;
};


/* =========================================================
   SIDEBAR
========================================================= */

function nav(){

    $('nav').innerHTML = Object.entries(BRANDS).map(([k,b]) => {

        return `
            <div class="brand ${k === brand ? 'open' : ''}">

                <button onclick="toggle('${k}')">

                    <span>
                        <i
                            class="dot"
                            style="background:${b.c}"
                        ></i>

                        ${b.n}
                    </span>

                    <span>
                        ${k === brand ? '&#9662;' : '&#9656;'}
                    </span>

                </button>

                <div class="sub">

                    ${
                        Object.entries(SUBS).map(([s,l]) => {

                            /*
                             * Admin can only select All.
                             * Other roles can only select themselves.
                             */
                            const ok = role === 'admin'
                                ? s === 'all'
                                : s === role;

                            return `
                                <button
                                    ${ok ? '' : 'disabled'}
                                    class="${k === brand && s === sub ? 'active' : ''}"
                                    onclick="${ok ? `go('${k}','${s}')` : 'return false;'}"
                                >

                                    <span>${l}</span>

                                    ${
                                        ok
                                            ? ''
                                            : '<span>&#128274;</span>'
                                    }

                                </button>
                            `;

                        }).join('')
                    }

                </div>

            </div>
        `;

    }).join('');
}


/* =========================================================
   BRAND / ROLE NAVIGATION
========================================================= */

function toggle(k){

    brand = k;

    if(!allowed(sub)){

        sub = role === 'admin'
            ? 'all'
            : role;
    }

    nav();

    reload(false);
}


function go(b,s){

    brand = b;
    sub = s;

    page = 1;
    sortK = null;

    nav();

    reload(false);

    side.classList.remove('show');
}


/* =========================================================
   FILTER RESET
========================================================= */

function resetF(){

    [
        'fStatus',
        'fFor',
        'fFrom',
        'fTo',
        'q'
    ].forEach(i => $(i).value = '');

    page = 1;

    render();
}


/* =========================================================
   FILTERED ROWS
========================================================= */

function rows(){

    const f = {
        t: $('fStatus').value,
        c: $('fFor').value,
        a: $('fFrom').value,
        z: $('fTo').value,
        q: $('q').value.toLowerCase()
    };

    let r = DATA[brand].filter(x =>

        (!f.t || x.status === f.t) &&

        (!f.c || x.payFor === f.c) &&

        (!f.a || x.date.slice(0,10) >= f.a) &&

        (!f.z || x.date.slice(0,10) <= f.z) &&

        (
            !f.q ||
            (
                x.cin +
                (x.cins || []).join(" ") +
                x.status +
                x.payFor +
                x.date
            )
            .toLowerCase()
            .includes(f.q)
        )

    );

    if(sortK){

        r = [...r].sort(
            (a,b) =>
                (a[sortK] > b[sortK] ? 1 : -1) * sortD
        );
    }

    return r;
}


/* =========================================================
   TABLE COLUMNS
========================================================= */

function cols(){

    return [
        ['date','Date'],
        ['cin','CIN'],
        ['payFor','Payment For'],
        ['status','Status'],
        ['total','Total'],

        ...SHOW[sub].map(k => [
            k,
            COLS[k]
        ])
    ];
}


/* =========================================================
   SORT
========================================================= */

function sortBy(k){

    sortD = sortK === k
        ? -sortD
        : 1;

    sortK = k;

    render();
}


/* =========================================================
   RENDER TABLE
========================================================= */

function render(){

    const ok = allowed(sub);

    $('denied').style.display =
        ok ? 'none' : 'block';

    $('body').style.display =
        ok ? 'block' : 'none';

    if(!ok){
        return;
    }


    $('crumb').textContent =
        BRANDS[brand].n +
        ' ' +
        '\u203A' +
        ' ' +
        SUBS[sub] +
        (
            role === 'admin'
                ? ' (Admin view)'
                : ' (restricted to ' + SUBS[role] + ')'
        );


    const r = rows();

    const C = cols();

    const size = +$('size').value;

    const pages =
        Math.max(
            1,
            Math.ceil(r.length / size)
        );

    page =
        Math.min(
            Math.max(1,page),
            pages
        );


    const num = C
        .filter(c =>
            ![
                'date',
                'cin',
                'payFor',
                'status'
            ].includes(c[0])
        )
        .map(c => c[0]);


    const ok2 =
        r.filter(
            x => x.status === 'Successful'
        );


    const sum = k =>
        ok2.reduce(
            (a,x) => a + (+x[k] || 0),
            0
        );


    $('tbl').innerHTML =

        '<thead><tr>' +

        '<th>#</th>' +

        C.map(c => `
            <th onclick="sortBy('${c[0]}')">
                ${c[1]}
                ${
                    sortK === c[0]
                        ? (
                            sortD > 0
                                ? ' &#9650;'
                                : ' &#9660;'
                        )
                        : ''
                }
            </th>
        `).join('') +

        '</tr></thead>' +

        '<tbody>' +

        '<tr class="tot">' +

        '<td></td>' +

        C.map(c => `
            <td>
                ${
                    num.includes(c[0])
                        ? '&#8377; ' +
                          sum(c[0]).toLocaleString('en-IN')
                        : ''
                }
            </td>
        `).join('') +

        '</tr>' +

        r
            .slice(
                (page-1) * size,
                page * size
            )
            .map((x,i) => `

                <tr>

                    <td>
                        ${(page-1)*size+i+1}
                    </td>

                    ${
                        C.map(c => `
                            <td>
                                ${cell(x,c[0])}
                            </td>
                        `).join('')
                    }

                </tr>

            `)
            .join('') +

        '</tbody>';


    $('info').textContent =
        r.length
            ? `Showing ${(page-1)*size+1}\u2013${Math.min(page*size,r.length)} of ${r.length}`
            : 'No records';


    $('prev').disabled =
        page <= 1;

    $('next').disabled =
        page >= pages;


    drawChart(
        ok2,
        num.filter(k => !/G$/.test(k))
    );
}


/* =========================================================
   CHART
========================================================= */

function drawChart(r,num){

    const m = {};

    r.forEach(x => {

        const k = x.date.slice(0,7);

        m[k] = m[k] || {};

        num.forEach(n => {

            m[k][n] =
                (m[k][n] || 0) +
                (+x[n] || 0);

        });

    });


    const labels =
        Object.keys(m).sort();


    const pal = [
        '#4f9de8',
        '#ef6b85',
        '#f29a4b',
        '#f3cf6b',
        '#5fc0b8',
        '#9b7bf0',
        '#9ca3af',
        '#6fcf97',
        '#e07bd0',
        '#8c6d4f'
    ];


    const txt =
        getComputedStyle(document.body).color;


    const sets = num.map((n,i) => ({

        label:
            n === 'total'
                ? 'Revenue'
                : COLS[n],

        data:
            labels.map(
                l => m[l][n] || 0
            ),

        borderColor:
            pal[i % 10],

        backgroundColor:
            pal[i % 10],

        tension:.25

    }));


    if(chart){
        chart.destroy();
    }


    chart = new Chart(
        $('chart'),
        {
            type:'line',

            data:{
                labels,
                datasets:sets
            },

            options:{
                maintainAspectRatio:false,
                color:txt,

                plugins:{
                    legend:{
                        labels:{
                            color:txt
                        }
                    }
                },

                scales:{
                    x:{
                        ticks:{
                            color:txt
                        }
                    },

                    y:{
                        ticks:{
                            color:txt
                        },

                        grid:{
                            color:'#8883'
                        }
                    }
                }
            }
        }
    );
}


/* =========================================================
   EXPORT CSV
========================================================= */

function exportCsv(){

    const C = cols();

    const r = rows();

    const csv = [

        [
            '#',
            ...C.map(c => c[1])
        ].join(','),

        ...r.map((x,i) => [

            i + 1,

            ...C.map(c =>
                '"' +
                String(x[c[0]] ?? '')
                    .replace(/"/g,'""') +
                '"'
            )

        ].join(','))

    ].join('\n');


    const a =
        document.createElement('a');

    a.href =
        URL.createObjectURL(
            new Blob(
                [csv],
                {type:'text/csv'}
            )
        );

    a.download =
        `${brand}-${sub}.csv`;

    a.click();
}


/* =========================================================
   API SOURCES
========================================================= */

const SOURCES = {

    marrs:
        BASE + '/get_marrs_split',

    lunar:
        BASE + '/get_lunar_split',

    zoomzoom:
        BASE + '/get_zoomzoom_split'

};


const PAYS = [

    [
        'franchise',
        'franchise_tranfer_id',
        'franchise_amount'
    ],

    [
        'crm',
        'crm_fix_tranfer_id',
        'crm_fix'
    ],

    [
        'it',
        'it_fix_tranfer_id',
        'it_fix'
    ],

    [
        'mgmt',
        'management_tranfer_id',
        'management_amount'
    ],

    [
        'avian',
        'aviansys_tranfer_id',
        'aviansys_amount'
    ]

];


/* =========================================================
   API DATA ADAPTER
========================================================= */

function fromSplit(v){

    const r = {

        date:
            v.date_of_payment,

        cin:
            v.cin ||
            v.prid ||
            '',

        cins:
            v.cins || [],

        total:
            +v.total_amount || 0,

        payFor:
            v.type === 'school'
                ? 'School'
                : 'Competition',

        status:
            (
                v.status == null ||
                String(v.status) === '1'
            )
                ? 'Successful'
                : 'Failed',

        marrs:
            v.gst_tranfer_id
                ? +v.gst_amount || 0
                : 0,

        razor:
            +v.razpay_service || 0,

        balance:
            +v.MaRRS_bal || 0,

        crmAv:
            +v.crm_aviansys || 0,

        maker:
            +v.maker || 0

    };


    PAYS.forEach(
        ([k,t,a]) => {

            r[k] =
                v[t]
                    ? +v[a] || 0
                    : 0;

        }
    );


    [
        'franchise',
        'crm',
        'it',
        'mgmt',
        'avian',
        'crmAv',
        'maker'
    ].forEach(k => {

        r[k+'G'] =
            Math.round(
                r[k] * 18 / 118
            );

    });


    return r;
}


const ADAPT = {
    marrs: fromSplit,
    lunar: fromSplit,
    zoomzoom: fromSplit
};


const loaded = {};


/* =========================================================
   LOAD API
========================================================= */

async function load(b){

    const q =
        new URLSearchParams({

            type:
                $('fFor').value.toLowerCase(),

            start_date:
                $('fFrom').value,

            end_date:
                $('fTo').value

        });


    const url =
        SOURCES[b] +
        '?' +
        q.toString();


    try{

        const res =
            await fetch(
                url,
                {
                    credentials:'same-origin',

                    headers:{
                        'Accept':
                            'application/json'
                    }
                }
            );


        const contentType =
            res.headers.get('content-type') || '';


        const responseText =
            await res.text();


        console.log(
            'API URL:',
            url
        );

        console.log(
            'HTTP STATUS:',
            res.status
        );

        console.log(
            'CONTENT TYPE:',
            contentType
        );

        console.log(
            'RESPONSE:',
            responseText
        );


        if(res.status === 401){

            location.href = LOGIN;

            return;
        }


        if(
            !contentType.includes(
                'application/json'
            )
        ){

            throw new Error(
                'API returned HTML instead of JSON. HTTP ' +
                res.status +
                '. Check the API URL/routing.'
            );

        }


        let j;


        try{

            j = JSON.parse(
                responseText
            );

        }catch(e){

            throw new Error(
                'Invalid JSON returned by server.'
            );

        }


        if(!res.ok){

            throw new Error(
                j.error ||
                'Request failed'
            );

        }


        if(!Array.isArray(j)){

            throw new Error(
                j.error ||
                'Invalid API response'
            );

        }


        DATA[b] =
            j.map(
                ADAPT[b]
            );


        $('note').style.display =
            'none';


    }catch(e){

        console.error(e);

        DATA[b] = [];

        $('note').textContent =
            e.message ||
            'Could not load data.';

        $('note').style.display =
            'block';

    }


    loaded[b] = 1;
}


/* =========================================================
   RELOAD
========================================================= */

async function reload(force=true){

    if(
        force ||
        !loaded[brand]
    ){

        await load(brand);

    }

    page = 1;

    render();
}


/* =========================================================
   ESCAPE HTML
========================================================= */

const esc = v =>
    String(v ?? '')
        .replace(
            /[&<>"]/g,
            c => ({
                '&':'&amp;',
                '<':'&lt;',
                '>':'&gt;',
                '"':'&quot;'
            }[c])
        );


/* =========================================================
   TABLE CELL
========================================================= */

function cell(x,k){

    return k === 'cin'

        ? esc(x.cin) +
          '<br>CIN:' +
          (x.cins || [])
              .map(
                  c =>
                      '<br>' +
                      esc(c)
              )
              .join('')

        : esc(x[k]);
}


/* =========================================================
   START
========================================================= */

nav();
reload();

</script>

</body>
</html>