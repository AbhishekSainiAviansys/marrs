<?php
$c = new mysqli('127.0.0.1','root','','marrscor_marrs');
if ($c->connect_error) { echo "CONN FAIL: ".$c->connect_error."\n"; exit(1); }
foreach (array('webhook_calls_cin','amount_cart','new_cart','makers_splits','payment_split') as $t) {
    echo "==$t==\n";
    $r = $c->query("DESCRIBE $t");
    if (!$r) { echo $c->error."\n"; continue; }
    while ($row = $r->fetch_assoc()) {
        echo $row['Field'].'|'.$row['Type'].'|'.$row['Null'].'|'.$row['Default']."\n";
    }
}
