<?php
// One-shot patch for Splitmonitor.php (CRLF-safe). Run once then delete.
$f = 'c:/Users/AbhishekSaini/Desktop/marrs-payments/student_registration/application/controllers/Splitmonitor.php';
$c = file_get_contents($f);
$orig = $c;

// 1. enrich webhook_calls rows: split/action flags + flow marker
$a = "\$row['in_split_prid'] = !empty(\$sp_by_order[\$r->payment_id]);";
$b = "\$row['in_split_prid'] = !empty(\$sp_by_order[\$r->payment_id]);\n            \$row['flow'] = 'prid';\n            \$row['needs_split'] = empty(\$sp_by_order[\$r->payment_id]) && empty(\$split_by_order[\$r->payment_id]);";
if (strpos($c, $a) === false) { echo "ANCHOR1 MISSING\n"; exit(1); }
$c = str_replace($a, $b, $c);

// 2. enrich webhook_calls_cin rows (append after the wc loop, before cin summary)
$a2 = "        \$summary = [";
$b2 = "        // enrich CIN rows: split/activation/action flags\n"
  . "        \$wc_cin_rows = [];\n"
  . "        foreach (\$webhook_cin as \$r) {\n"
  . "            \$row = (array)\$r;\n"
  . "            \$row['flow'] = 'cin';\n"
  . "            \$row['in_split'] = !empty(\$split_by_order[\$r->payment_id]);\n"
  . "            \$row['needs_split'] = empty(\$split_by_order[\$r->payment_id]);\n"
  . "            \$row['activated'] = isset(\$active_map[\$r->payment_id]) ? \$active_map[\$r->payment_id] : 0;\n"
  . "            \$row['pending_items'] = isset(\$pending_map[\$r->payment_id]) ? \$pending_map[\$r->payment_id] : 0;\n"
  . "            \$row['needs_activation'] = (\$row['pending_items'] > 0 && \$row['activated'] == 0);\n"
  . "            \$wc_cin_rows[] = \$row;\n"
  . "        }\n\n"
  . "        \$summary = [";
if (strpos($c, $a2) === false) { echo "ANCHOR2 MISSING\n"; exit(1); }
$c = str_replace($a2, $b2, $c);

// 3. summary: CIN counts + needs-action counts
$a3 = "            'makers_paid'       => \$makers_paid,";
$b3 = "            'cin_orders'        => count(\$webhook_cin),\n"
  . "            'cin_done'          => count(array_filter(\$webhook_cin, function (\$r) { return (int)\$r->status === 1; })),\n"
  . "            'needs_split'       => count(array_filter(\$wc_rows, function (\$r) { return !empty(\$r['needs_split']) && (int)\$r['status'] !== 1; }))\n"
  . "                                + count(array_filter(\$wc_cin_rows, function (\$r) { return !empty(\$r['needs_split']) && (int)\$r['status'] !== 1; })),\n"
  . "            'needs_activation'  => count(array_filter(\$wc_cin_rows, function (\$r) { return !empty(\$r['needs_activation']); })),\n"
  . "            'makers_paid'       => \$makers_paid,";
if (strpos($c, $a3) === false) { echo "ANCHOR3 MISSING\n"; exit(1); }
$c = str_replace($a3, $b3, $c);

// 4. output: add new sections
$a4 = "            'makers'        => \$maker_rows,";
$b4 = "            'makers'        => \$maker_rows,\n"
  . "            'webhook_cin'   => \$wc_cin_rows,\n"
  . "            'amount_cart'   => \$amount_cart,";
if (strpos($c, $a4) === false) { echo "ANCHOR4 MISSING\n"; exit(1); }
$c = str_replace($a4, $b4, $c);

if ($c === $orig) { echo "NO CHANGES\n"; exit(1); }
file_put_contents($f, $c);
echo "PATCHED OK\n";
