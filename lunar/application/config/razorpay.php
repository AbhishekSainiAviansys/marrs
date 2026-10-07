<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Razorpay API credentials.
 * Get these from https://dashboard.razorpay.com/app/keys
 *
 * IMPORTANT:
 *   - Use the *Test* keys while developing (they start with
 *     rzp_test_...) and switch to Live keys only in production.
 *   - Never commit real keys to version control — pull them from
 *     environment variables in production if possible instead of
 *     hardcoding below.
 */
$config['razorpay_key_id']     = 'rzp_live_kG7f8nF6sKGPhx';
$config['razorpay_key_secret'] = '68nusLbguizulOSBn47VpfmS';

// Optional: only needed if you set up a Razorpay webhook
// (recommended — see README for why).
$config['razorpay_webhook_secret'] = 'REPLACE_WITH_YOUR_WEBHOOK_SECRET';
define('RAZOR_KEY_ID', 'rzp_live_kG7f8nF6sKGPhx');
define('RAZOR_KEY_SECRET', '68nusLbguizulOSBn47VpfmS');
