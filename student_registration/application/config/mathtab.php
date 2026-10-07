<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['mathtab'] = [
    'issuer' => 'marrs',
    'audience' => 'mathtab',
    'expire_time' => 300, // seconds

    'private_key' => APPPATH . '../keys/private.pem',
    'public_key'  => APPPATH . '../keys/public.pem',
];