<?php
// One-shot patch for Razorpay::verify2() (CRLF-safe). Run once then delete.
$f = 'c:/Users/AbhishekSaini/Desktop/marrs-payments/student_registration/application/controllers/Razorpay.php';
$c = file_get_contents($f);
$orig = $c;

$a = "\$makers_split = \$this->db->get_where('makers_splits', array('order_id' => \$order_id))->result();";
$b = "// Unified engine: single idempotent split + cart activation.\n"
  . "            // Same user flow (signature -> redirect); execution now lives in\n"
  . "            // Splitpay::process() so webhook + browser return cannot double-pay.\n"
  . "            // Old inline methods (processCartItems/processPaymentSplits) are\n"
  . "            // kept below for rollback.\n"
  . "            try {\n"
  . "                require_once(APPPATH.'controllers/Splitpay.php');\n"
  . "                \$engine = new Splitpay();\n"
  . "                \$engine->process(\$order_id); // split + activation, idempotent\n"
  . "            } catch (\\Throwable \$e) {\n"
  . "                // Fall back to the legacy inline path if the engine is unavailable.\n"
  . "                \$makers_split = \$this->db->get_where('makers_splits', array('order_id' => \$order_id))->result();\n"
  . "                \$this->processCartItems(\$webhook_calls_cin, \$makers_split);\n"
  . "                \$this->processPaymentSplitsEndpoint(\$order_id);\n"
  . "            }\n"
  . "            if (false) { \$makers_split = \$this->db->get_where('makers_splits', array('order_id' => \$order_id))->result(); }";
if (strpos($c, $a) === false) { echo "ANCHOR MISSING\n"; exit(1); }
$c = str_replace($a, $b, $c);

// Comment out the two legacy direct calls (now handled by the engine;
// the fallback above still calls them if the engine throws).
$a2 = "\$this->processCartItems(\$webhook_calls_cin, \$makers_split);";
$b2 = "// \$this->processCartItems(\$webhook_calls_cin, \$makers_split); // via engine";
if (strpos($c, $a2) === false) { echo "ANCHOR2 MISSING\n"; exit(1); }
$c = str_replace($a2, $b2, $c);

$a3 = "\$this->processPaymentSplitsEndpoint(\$order_id);";
$b3 = "// \$this->processPaymentSplitsEndpoint(\$order_id); // via engine";
if (strpos($c, $a3) === false) { echo "ANCHOR3 MISSING\n"; exit(1); }
$c = str_replace($a3, $b3, $c);

if ($c === $orig) { echo "NO CHANGES\n"; exit(1); }
file_put_contents($f, $c);
echo "PATCHED OK\n";
