<?php include('header.php');

/* ---------- Data ---------- */
$cin = $_SESSION['cin'];

$result       = $this->db->get_where('cin_result', ['cin' => $cin])->row();
$product_name = $result->product_name;
$level        = $result->clevel;

$student = $this->db->get_where('cin_list', ['cin' => $cin])->row_array();

/* Same values the original page used ($clevel / $product), falling back to the cin_result row */
$q_level   = isset($clevel)  ? $clevel  : $level;
$q_product = isset($product) ? $product : $product_name;

$level_row  = $this->db->select('level_name')
                       ->get_where('competition_level_byproduct', [
                           'level_id'     => $q_level,
                           'product_name' => $q_product,
                       ])->row_array();
$level_name = isset($level_row['level_name']) ? $level_row['level_name'] : '';

$slip_no = $type . $result->id;

/* Product name => logo path (relative to base_url) */
$logos = [
    'MaRRS Play 2 Learn'                       => 'images/logo_p2l.png',
    'MaRRS International Spelling Bee Junior'  => 'images/junior_logo.png',
    'MaRRS International Spelling Bee'         => 'images/misb_logo.jpg',
    'MaRRS International Math Bee'             => 'product_logo/mathbee.jpg',
    'MaRRS Scientia Exertus'                   => 'product_logo/scienceex.jpg',
    'MaRRS Primary Colors - Science'           => 'images/international/pc_science.png',
    'MaRRS Primary Colors - Math'              => 'images/international/pc_math.png',
    'MaRRS Primary Colors - English'           => 'images/international/pc_english.png',
    'MaRRS Primary Colors - Humanities'        => 'images/international/pc_humanities.png',
    'MaRRS Preschool Bee Humanities'           => 'images/psb_humanities.png',
    'MaRRS Preschool Bee Science'              => 'images/psb_science.png',
    'MaRRS Preschool Bee Math'                 => 'images/psb_math.png',
    'MaRRS Preschool Bee English'              => 'images/psb_english.png',
];
$logo = isset($logos[$product_name]) ? base_url($logos[$product_name]) : '';

$pdf_name = 'Orientation-Slip-' . preg_replace('/[^A-Za-z0-9_-]/', '', $slip_no) . '.pdf';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    .slip-page {
        --ink: #0e5695;            /* brand blue */
        --ink-dark: #0b4677;
        --accent: #fd4105;         /* brand orange */
        --accent-soft: #fff1eb;    /* stub tint */
        --perforation: #f3b6a2;
        --text: #16283b;
        --muted: #5b6b7c;
        --rule: #dbe4ee;
        --green: #1c7a4a;
        --green-soft: #e3f4ea;
        --backdrop: #ffffff;       /* must match the page background behind the ticket (notches) */

        color: var(--text);
        font-family: 'DM Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
        padding: 40px 16px 56px;
    }
    .slip-wrap { max-width: 780px; margin: 0 auto; }
    .slip-capture { padding: 20px; }

    /* ---------- Ticket ---------- */
    .slip {
        position: relative;
        isolation: isolate;
        display: grid;
        grid-template-columns: minmax(0, 1fr) 230px;
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(14, 86, 149, .14);
    }
    .slip::before {           /* top band (blue) */
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 8px;
        background: var(--ink);
        z-index: 1;
    }
    .slip::after {            /* orange segment on the band */
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 96px; height: 8px;
        background: var(--accent);
        z-index: 1;
    }

    /* ---------- Main section ---------- */
    .slip-main { padding: 36px 32px 30px; }

    .slip-head {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 22px;
        border-bottom: 1px solid var(--rule);
    }
    .slip-logo {
        flex: none;
        width: 72px; height: 72px;
        border-radius: 50%;
        object-fit: cover;
        background: #fff;
        border: 3px solid var(--accent);
    }
    .slip-product {
        margin: 0 0 4px;
        font-size: 15px;
        font-weight: 500;
        color: var(--muted);
    }
    .slip-title {
        margin: 0;
        font-family: 'Bricolage Grotesque', 'DM Sans', system-ui, sans-serif;
        font-size: 26px;
        line-height: 1.15;
        font-weight: 700;
        letter-spacing: -.01em;
        color: var(--ink);
    }

    .slip-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 24px;
        margin: 0;
    }
    .slip-details > div {
        padding: 14px 0;
        border-bottom: 1px solid var(--rule);
        min-width: 0;
    }
    .slip-details .wide { grid-column: 1 / -1; }
    .slip-details dt {
        margin: 0 0 3px;
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
    }
    .slip-details dd {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        line-height: 1.3;
        overflow-wrap: anywhere;
        color: var(--text);
    }
    .slip-details .wide.name dd { font-size: 22px; }

    .slip-note {
        margin: 18px 0 0;
        font-size: 15px;
        line-height: 1.65;
    }
    .slip-note + .slip-note { margin-top: 4px; }

    /* ---------- Stub ---------- */
    .slip-stub {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 36px 20px 28px;
        text-align: center;
        background: var(--accent-soft);
        border-left: 2px dashed var(--perforation);
    }
    .slip-stub::before,
    .slip-stub::after {       /* punched notches */
        content: "";
        position: absolute;
        left: -14px;
        width: 26px; height: 26px;
        border-radius: 50%;
        background: var(--backdrop);
        z-index: 2;
    }
    .slip-stub::before { top: -13px; }
    .slip-stub::after  { bottom: -13px; }

    .slip-label { margin: 0; font-size: 13px; font-weight: 500; color: var(--muted); }
    .slip-number {
        margin: 0;
        font-family: 'Bricolage Grotesque', 'DM Sans', system-ui, sans-serif;
        font-size: 34px;
        line-height: 1.1;
        font-weight: 700;
        letter-spacing: .01em;
        font-variant-numeric: tabular-nums;
        overflow-wrap: anywhere;
        color: var(--ink);
    }
    .slip-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: var(--green-soft);
        color: var(--green);
        font-size: 14px;
        font-weight: 600;
    }
    .slip-keep { margin: 8px 0 0; font-size: 13px; line-height: 1.5; color: var(--muted); }

    /* ---------- Actions ---------- */
    .slip-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 22px;
    }
    .slip-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        border: 2px solid var(--ink);
        border-radius: 10px;
        font: 600 15px/1.2 'DM Sans', system-ui, sans-serif;
        text-decoration: none;
        cursor: pointer;
    }
    .slip-btn-primary { background: var(--ink); color: #fff; }
    .slip-btn-primary:hover { background: var(--ink-dark); border-color: var(--ink-dark); color: #fff; }
    .slip-btn-secondary { background: transparent; color: var(--ink); }
    .slip-btn-secondary:hover { background: rgba(14, 86, 149, .08); color: var(--ink); }
    .slip-btn:focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }
    .slip-btn[disabled] { opacity: .65; cursor: progress; }

    /* ---------- Small screens: stub drops below ---------- */
    @media (max-width: 600px) {
        .slip-page { padding: 24px 8px 40px; }
        .slip-capture { padding: 12px; }
        .slip { grid-template-columns: 1fr; }
        .slip-main { padding: 34px 20px 22px; }
        .slip-title { font-size: 22px; }
        .slip-logo { width: 60px; height: 60px; }
        .slip-stub { border-left: 0; border-top: 2px dashed var(--perforation); padding: 28px 20px; }
        .slip-stub::before { top: -14px; left: -13px; }
        .slip-stub::after  { top: -14px; bottom: auto; left: auto; right: -13px; }
    }
</style>
<section class="slip-page">
    <div class="slip-wrap">

        <div id="content" class="slip-capture">
            <article class="slip" aria-label="Orientation participation slip">

                <div class="slip-main">
                    <header class="slip-head">
                        <?php if ($logo): ?>
                            <img class="slip-logo" src="<?php echo $logo; ?>" alt="<?php echo html_escape($product_name); ?> logo">
                        <?php endif; ?>
                        <div>
                            <p class="slip-product"><?php echo html_escape($product_name); ?></p>
                            <h1 class="slip-title">Orientation Participation Slip</h1>
                        </div>
                    </header>

                    <dl class="slip-details">
                        <div class="wide name">
                            <dt>Participant</dt>
                            <dd><?php echo html_escape($student['student_name']); ?></dd>
                        </div>
                        <div>
                            <dt>CIN</dt>
                            <dd><?php echo html_escape($student['cin']); ?></dd>
                        </div>
                        <div>
                            <dt>Category</dt>
                            <dd><?php echo html_escape($student['class']); ?></dd>
                        </div>
                    </dl>

                    <p class="slip-note">Thank you for registering for the Orientation program<?php if ($level_name !== ''): ?> for <b><?php echo html_escape($level_name); ?></b><?php endif; ?>.</p>
                    <p class="slip-note">The schedule of your session will be communicated to you shortly.</p>
                </div>

                <aside class="slip-stub">
                    <p class="slip-label">Slip number</p>
                    <p class="slip-number"><?php echo html_escape($slip_no); ?></p>
                    <span class="slip-status">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <circle cx="8" cy="8" r="8" fill="currentColor"/>
                            <path d="M4.5 8.3l2.4 2.4 4.6-4.9" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Participation confirmed
                    </span>
                    <p class="slip-keep">Keep this slip for your records.</p>
                </aside>

            </article>
        </div>

        <div class="slip-actions">
            <button type="button" id="print" class="slip-btn slip-btn-primary">
                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M10 3v9m0 0l-3.5-3.5M10 12l3.5-3.5M4 16h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="slip-btn-label">Download slip</span>
            </button>
            <a href="<?php echo base_url('Cin_login/enroll'); ?>" class="slip-btn slip-btn-secondary">Close</a>
        </div>

    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* Data for the PDF (the PDF is drawn as vector graphics, not a screenshot of the page) */
    var SLIP = <?php echo json_encode([
        'product'     => $product_name,
        'participant' => isset($student['student_name']) ? $student['student_name'] : '',
        'cin'         => isset($student['cin']) ? $student['cin'] : '',
        'category'    => isset($student['class']) ? $student['class'] : '',
        'level'       => $level_name,
        'slip'        => $slip_no,
        'logo'        => $logo,
        'filename'    => $pdf_name,
    ]); ?>;

   function buildSlipPdf(JsPDF, d, logoDataUrl) {
    var doc = new JsPDF({ unit: 'mm', format: 'a4', orientation: 'portrait' });
 
    var C = {
        ink: [14, 86, 149],          // brand blue  #0e5695
        accent: [253, 65, 5],        // brand orange #fd4105
        accentSoft: [255, 241, 235], // stub tint
        perf: [243, 182, 162],       // perforation line
        text: [22, 40, 59],
        muted: [91, 107, 124], rule: [219, 228, 238], edge: [201, 213, 226],
        green: [28, 122, 74], white: [255, 255, 255]
    };
    function fill(c)   { doc.setFillColor(c[0], c[1], c[2]); }
    function stroke(c) { doc.setDrawColor(c[0], c[1], c[2]); }
    function ink(c)    { doc.setTextColor(c[0], c[1], c[2]); }
 
    // Shrink text to fit a width; ellipsize as a last resort
    function fit(str, style, maxSize, minSize, width) {
        str = String(str == null ? '' : str);
        doc.setFont('helvetica', style);
        var s = maxSize;
        doc.setFontSize(s);
        while (s > minSize && doc.getTextWidth(str) > width) { s -= 0.5; doc.setFontSize(s); }
        if (doc.getTextWidth(str) > width) {
            while (str.length > 1 && doc.getTextWidth(str + '...') > width) { str = str.slice(0, -1); }
            str += '...';
        }
        return str;
    }
 
    /* ---------- Geometry (mm) ---------- */
    var X = 20, Y = 26, W = 170, R = 5, BAND = 2.5, STUB = 52, PAD = 9, NOTCH = 3.2;
    var stubX = X + W - STUB;
    var mainL = X + PAD, mainR = stubX - PAD, mainW = mainR - mainL;
 
    var ruleHead = Y + 37;
    var pLabel = ruleHead + 7.5,  pValue = ruleHead + 14.5, rule2 = ruleHead + 20;
    var cLabel = rule2 + 7,       cValue = rule2 + 13.5,    rule3 = rule2 + 19.5;
    var lastRule = rule3;
 
    // Note paragraphs, laid out word by word so the level name can be bold
    function words(str, bold) {
        return str.split(/\s+/).filter(Boolean).map(function (w) { return { t: w, bold: bold, glue: false }; });
    }
    function layout(tokens, width) {
        var lines = [[]], x = 0;
        doc.setFontSize(9);
        doc.setFont('helvetica', 'normal');
        var sp = doc.getTextWidth(' ');
        tokens.forEach(function (tk) {
            doc.setFont('helvetica', tk.bold ? 'bold' : 'normal');
            var w = doc.getTextWidth(tk.t);
            var cur = lines[lines.length - 1];
            var gap = (tk.glue || !cur.length) ? 0 : sp;
            if (!tk.glue && cur.length && x + gap + w > width) {
                cur = []; lines.push(cur); x = 0; gap = 0;
            }
            cur.push({ t: tk.t, bold: tk.bold, x: x + gap });
            x += gap + w;
        });
        return lines;
    }
    var p1 = words('Thank you for registering for the Orientation program', false);
    if (d.level) { p1 = p1.concat(words('for', false), words(d.level, true)); }
    p1.push({ t: '.', bold: false, glue: true });
    var para1 = layout(p1, mainW);
    var para2 = layout(words('The schedule of your session will be communicated to you shortly.', false), mainW);
 
    var LH = 4.6, PGAP = 1.8;
    var noteY = lastRule + 8;
    var H = (noteY + (para1.length + para2.length - 1) * LH + PGAP + 7.5) - Y;
 
    /* ---------- Ticket shape ---------- */
    fill(C.edge);  doc.roundedRect(X - 0.3, Y - 0.3, W + 0.6, H + 0.6, R + 0.3, R + 0.3, 'F');
    fill(C.ink);   doc.roundedRect(X, Y, W, BAND + R * 3, R, R, 'F');              // top band
    fill(C.accent);                                                                // orange segment on the band
    doc.roundedRect(X, Y, 40, BAND + R * 3, R, R, 'F');
    fill(C.ink);   doc.rect(X + 26, Y, 14, BAND + 0.2, 'F');
    fill(C.white); doc.roundedRect(X, Y + BAND, W, H - BAND, R, R, 'F');           // body
    fill(C.accentSoft);
    doc.roundedRect(stubX - R, Y + BAND, STUB + R, H - BAND, R, R, 'F');           // stub
    fill(C.white);
    doc.rect(stubX - R - 0.2, Y + BAND, R + 0.2, H - BAND, 'F');                   // square off stub's left side
 
    // Punched notches on the perforation
    function notch(cx, cy, top) {
        fill(C.edge);  doc.circle(cx, cy, NOTCH + 0.3, 'F');
        fill(C.white); doc.circle(cx, cy, NOTCH, 'F');
        if (top) { doc.rect(cx - NOTCH - 1, cy - NOTCH - 2, NOTCH * 2 + 2, NOTCH + 2 - 0.3, 'F'); }
        else     { doc.rect(cx - NOTCH - 1, cy + 0.3, NOTCH * 2 + 2, NOTCH + 2, 'F'); }
    }
    notch(stubX, Y, true);
    notch(stubX, Y + H, false);
 
    // Perforation line
    stroke(C.perf);
    doc.setLineWidth(0.4);
    doc.setLineDashPattern([1.6, 1.4], 0);
    doc.line(stubX, Y + BAND + NOTCH + 2.5, stubX, Y + H - NOTCH - 2.5);
    doc.setLineDashPattern([], 0);
 
    /* ---------- Header ---------- */
    var textX = mainL;
    if (logoDataUrl) {
        doc.addImage(logoDataUrl, 'PNG', mainL, Y + 11, 20, 20);
        textX = mainL + 25;
    }
    var headW = mainR - textX;
 
    ink(C.muted);
    doc.text(fit(d.product, 'normal', 9.5, 7, headW), textX, Y + 15.5);
 
    ink(C.ink);
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(16);
    doc.text('Orientation', textX, Y + 22.5);
    doc.text('participation slip', textX, Y + 29.5);
 
    stroke(C.rule);
    doc.setLineWidth(0.25);
    doc.line(mainL, ruleHead, mainR, ruleHead);
 
    /* ---------- Details ---------- */
    function label(str, x, y) {
        doc.setFont('helvetica', 'normal'); doc.setFontSize(8.5); ink(C.muted);
        doc.text(str, x, y);
    }
 
    label('Participant', mainL, pLabel);
    ink(C.text);
    doc.text(fit(d.participant, 'bold', 15, 9, mainW), mainL, pValue);
    doc.line(mainL, rule2, mainR, rule2);
 
    var colW = mainW / 2 - 4;
    var col2X = mainL + mainW / 2 + 4;
    label('CIN', mainL, cLabel);
    ink(C.text);
    doc.text(fit(d.cin, 'bold', 12, 8, colW), mainL, cValue);
    label('Category', col2X, cLabel);
    ink(C.text);
    doc.text(fit(d.category, 'bold', 12, 8, colW), col2X, cValue);
    stroke(C.rule);
    doc.line(mainL, rule3, mainR, rule3);
 
    ink(C.text);
    doc.setFontSize(9);
    var ny = noteY;
    function drawPara(lines) {
        lines.forEach(function (ln) {
            ln.forEach(function (tk) {
                doc.setFont('helvetica', tk.bold ? 'bold' : 'normal');
                doc.text(tk.t, mainL + tk.x, ny);
            });
            ny += LH;
        });
    }
    drawPara(para1);
    ny += PGAP;
    drawPara(para2);
 
    /* ---------- Stub ---------- */
    var cx = stubX + STUB / 2;
    var yc = Y + BAND / 2 + H / 2;
 
    doc.setFont('helvetica', 'normal'); doc.setFontSize(8.5); ink(C.muted);
    doc.text('Slip number', cx, yc - 14, { align: 'center' });
 
    ink(C.ink);
    doc.text(fit(d.slip, 'bold', 22, 12, STUB - 10), cx, yc - 5, { align: 'center' });
 
    // Status pill
    var pillText = 'Participation confirmed';
    doc.setFont('helvetica', 'bold'); doc.setFontSize(7.5);
    var pw = doc.getTextWidth(pillText) + 11, ph = 6.6;
    var px = cx - pw / 2, py = yc + 1;
    fill([227, 244, 234]);
    doc.roundedRect(px, py, pw, ph, ph / 2, ph / 2, 'F');
    fill(C.green);
    doc.circle(px + 4, py + ph / 2, 1.7, 'F');
    stroke(C.white);
    doc.setLineWidth(0.35);
    doc.lines([[0.7, 0.75], [1.25, -1.4]], px + 3.05, py + ph / 2 + 0.05, [1, 1], 'S');
    ink(C.green);
    doc.text(pillText, px + 7.2, py + ph / 2 + 1);
 
    doc.setFont('helvetica', 'normal'); doc.setFontSize(7.5); ink(C.muted);
    doc.text(doc.splitTextToSize('Keep this slip for your records.', STUB - 12), cx, yc + 15, { align: 'center' });
 
    doc.setProperties({ title: 'Orientation participation slip - ' + d.slip });
    return doc;
}
 
/* Crop the logo to a circle with an orange ring, so it matches the on-screen slip */
function loadLogo(url, done) {
    if (!url) { done(null); return; }
    var img = new Image();
    img.onload = function () {
        try {
            var s = 400, c = document.createElement('canvas');
            c.width = c.height = s;
            var g = c.getContext('2d');
            g.fillStyle = '#fff';
            g.beginPath(); g.arc(s / 2, s / 2, s / 2, 0, Math.PI * 2); g.fill();
            g.save();
            g.beginPath(); g.arc(s / 2, s / 2, s / 2 - 14, 0, Math.PI * 2); g.clip();
            var r = Math.max((s - 28) / img.width, (s - 28) / img.height);
            var w = img.width * r, h = img.height * r;
            g.drawImage(img, (s - w) / 2, (s - h) / 2, w, h);
            g.restore();
            g.lineWidth = 14; g.strokeStyle = '#fd4105';
            g.beginPath(); g.arc(s / 2, s / 2, s / 2 - 7, 0, Math.PI * 2); g.stroke();
            done(c.toDataURL('image/png'));
        } catch (e) { done(null); }
    };
    img.onerror = function () { done(null); };
    img.src = url;
}
 

    document.getElementById('print').addEventListener('click', function () {
        var btn = this;
        var label = btn.querySelector('.slip-btn-label');
        btn.disabled = true;
        label.textContent = 'Preparing PDF…';

        loadLogo(SLIP.logo, function (logoData) {
            try {
                buildSlipPdf(window.jspdf.jsPDF, SLIP, logoData).save(SLIP.filename);
            } catch (e) {
                console.error(e);
                alert('Sorry, the PDF could not be created. Please try again.');
            }
            btn.disabled = false;
            label.textContent = 'Download slip';
        });
    });
</script>
</body>
</html>