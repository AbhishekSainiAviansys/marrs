<?php
$c = new mysqli('127.0.0.1','root','','marrscor_marrs');
if ($c->connect_error) { echo "CONN FAIL ".$c->connect_error."\n"; exit(1); }
foreach (array('makers_splits','webhook_calls','webhook_calls_cin','payment_split','payment_split_prid','amount_cart','new_cart','students','cin_list','product_purchase') as $t) {
    echo "===$t===\n";
    $r = $c->query("SHOW COLUMNS FROM `$t`");
    if (!$r) { echo $c->error."\n"; continue; }
    while ($row = $r->fetch_assoc()) { echo $row['Field'].'|'.$row['Type']."\n"; }
}
