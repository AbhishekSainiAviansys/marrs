<?php

$config = [
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];

$res = openssl_pkey_new($config);

// Get private key
openssl_pkey_export($res, $privateKey);

// Get public key
$publicKey = openssl_pkey_get_details($res)['key'];

// Save files
file_put_contents('private.pem', $privateKey);
file_put_contents('public.pem', $publicKey);

echo "Keys generated!";