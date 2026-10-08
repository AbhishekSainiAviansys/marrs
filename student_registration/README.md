# Student registration

CodeIgniter **3.1.11** application for student CIN login, registration,
orders, Razorpay payments, and webhook processing.

## Local URL

With the repository root configured as the web-server document root, open
`http://localhost/student_registration/`. Apache rewrite rules route requests
to the app's `index.php`.

## Configuration

The application's `index.php` loads the root environment loader. Configure
`APP_BASE_URL`, `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE` in
the root `.env.development`; `application/config/config.php` appends
`/student_registration`.

For local payment testing, use Razorpay test keys and a test webhook secret.
Check `application/config/mathtab.php` before deploying: it expects
`keys/private.pem`, which must be provisioned securely and is intentionally
not tracked by Git.

## Compatibility and validation

The application targets the existing PHP 7.4 environment. Use an isolated
database and verify login, cart/order activation, webhook retries, and payment
reconciliation without live payment credentials.
