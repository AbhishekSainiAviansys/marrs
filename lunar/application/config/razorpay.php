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
$config['razorpay_key_id']     = (getenv('RAZOR_KEY_ID') !== FALSE ? getenv('RAZOR_KEY_ID') : '');
$config['razorpay_key_secret'] = (getenv('RAZOR_KEY_SECRET') !== FALSE ? getenv('RAZOR_KEY_SECRET') : '');

// Optional: only needed if you set up a Razorpay webhook
// (recommended — see README for why).
$config['razorpay_webhook_secret'] = (getenv('RAZOR_WEBHOOK_SECRET') !== FALSE ? getenv('RAZOR_WEBHOOK_SECRET') : '');
define('RAZOR_KEY_ID', (getenv('RAZOR_KEY_ID') !== FALSE ? getenv('RAZOR_KEY_ID') : ''));
define('RAZOR_KEY_SECRET', (getenv('RAZOR_KEY_SECRET') !== FALSE ? getenv('RAZOR_KEY_SECRET') : ''));
